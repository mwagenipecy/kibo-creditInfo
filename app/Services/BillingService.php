<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Application;
use App\Models\BillingConfiguration;
use App\Models\Lender;
use App\Models\CarDealer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class BillingService
{
    /**
     * Generate monthly bills for all active entities
     */
    public function generateMonthlyBills($month = null, $year = null)
    {
        $month = $month ?: Carbon::now()->month;
        $year = $year ?: Carbon::now()->year;
        
        $periodStart = Carbon::create($year, $month, 1);
        $periodEnd = $periodStart->copy()->endOfMonth();

        Log::info("Starting monthly bill generation for {$month}/{$year}");

        // Get all active billing configurations
        $configs = BillingConfiguration::where('is_active', true)
            ->with(['entity'])
            ->get();

        $generatedBills = [];
        $errors = [];

        foreach ($configs as $config) {
            try {
                $bill = $this->generateBillForEntity($config, $periodStart, $periodEnd);
                if ($bill) {
                    $generatedBills[] = $bill;
                    Log::info("Generated bill {$bill->bill_number} for {$config->entity_type} ID: {$config->entity_id}");
                }
            } catch (Exception $e) {
                $errors[] = [
                    'entity_type' => $config->entity_type,
                    'entity_id' => $config->entity_id,
                    'error' => $e->getMessage()
                ];
                Log::error("Failed to generate bill for {$config->entity_type} ID: {$config->entity_id} - " . $e->getMessage());
            }
        }

        return [
            'generated_bills' => $generatedBills,
            'errors' => $errors,
            'total_generated' => count($generatedBills),
            'total_errors' => count($errors)
        ];
    }

    /**
     * Generate bill for a specific entity
     */
    public function generateBillForEntity($config, $periodStart, $periodEnd)
    {
        // Validate entity exists and is active
        if (!$this->validateEntity($config)) {
            throw new Exception("Entity not found or inactive");
        }

        // Check if bill already exists for this period
        $existingBill = $this->checkExistingBill($config, $periodStart, $periodEnd);
        if ($existingBill) {
            Log::info("Bill already exists for period: {$existingBill->bill_number}");
            return $existingBill;
        }

        // Get billable applications for this entity and period
        $applications = $this->getBillableApplications($config, $periodStart, $periodEnd);

        if ($applications->isEmpty()) {
            Log::info("No billable applications found for {$config->entity_type} ID: {$config->entity_id}");
            return null;
        }

        return DB::transaction(function () use ($config, $applications, $periodStart, $periodEnd) {
            return $this->createBillWithItems($config, $applications, $periodStart, $periodEnd);
        });
    }

    /**
     * Validate that the entity exists and is approved
     */
    private function validateEntity($config)
    {
        if ($config->entity_type === 'lender') {
            $entity = Lender::find($config->entity_id);
            return $entity && $entity->status === 'APPROVED';
        } else {
            $entity = CarDealer::find($config->entity_id);
            return $entity && $entity->status === 'APPROVED';
        }
    }

    /**
     * Check if bill already exists for the given period
     */
    private function checkExistingBill($config, $periodStart, $periodEnd)
    {
        return Bill::where('entity_type', $config->entity_type)
            ->where('entity_id', $config->entity_id)
            ->where('billing_period_start', $periodStart->format('Y-m-d'))
            ->where('billing_period_end', $periodEnd->format('Y-m-d'))
            ->first();
    }

    /**
     * Get applications that should be billed for this entity and period
     */
    private function getBillableApplications($config, $periodStart, $periodEnd)
    {
        $query = Application::query();

        // Filter by entity
        if ($config->entity_type === 'lender') {
            $query->where('lender_id', $config->entity_id);
        } else {
            $query->where('car_dealer_id', $config->entity_id);
        }

        // Filter by billing period
        $query->whereBetween('created_at', [
            $periodStart->startOfDay(),
            $periodEnd->endOfDay()
        ]);

        // Only bill applications that are processed/approved
        $query->whereIn('application_status', ['APPROVED', 'COMPLETED', 'DISBURSED']);

        // Exclude applications that have already been billed
        $query->whereDoesntHave('billItems');

        // Include related data for descriptions
        $query->with(['lender', 'carDealer']);

        $applications = $query->get();

        Log::info("Found {$applications->count()} billable applications for {$config->entity_type} ID: {$config->entity_id}");

        return $applications;
    }

    /**
     * Create bill with all items and calculate totals
     */
    private function createBillWithItems($config, $applications, $periodStart, $periodEnd)
    {
        // Create the bill
        $bill = Bill::create([
            'entity_type' => $config->entity_type,
            'entity_id' => $config->entity_id,
            'billing_period_start' => $periodStart->format('Y-m-d'),
            'billing_period_end' => $periodEnd->format('Y-m-d'),
            'subtotal' => 0,
            'tax_amount' => 0,
            'total_amount' => 0,
            'currency' => $config->currency ?? 'TZS',
            'status' => 'pending',
            'due_date' => $periodEnd->copy()->addDays(30)->format('Y-m-d'),
            'issued_date' => Carbon::now()->format('Y-m-d'),
        ]);

        $subtotal = 0;

        // Create bill items for each application
        foreach ($applications as $application) {
            $itemTotal = $this->calculateItemAmount($config, $application);
            
            BillItem::create([
                'bill_id' => $bill->id,
                'application_id' => $application->id,
                'description' => $this->generateItemDescription($config, $application),
                'quantity' => 1,
                'unit_price' => $itemTotal,
                'total_price' => $itemTotal,
                'item_date' => $application->created_at->format('Y-m-d'),
            ]);

            $subtotal += $itemTotal;
        }

        // Calculate tax and total
        $taxRate = 0.18; // 18% VAT
        $taxAmount = $subtotal * $taxRate;
        $totalAmount = $subtotal + $taxAmount;

        // Update bill with calculated totals
        $bill->update([
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
        ]);

        Log::info("Created bill {$bill->bill_number} with {$applications->count()} items, total: {$totalAmount} {$bill->currency}");

        return $bill;
    }

    /**
     * Calculate billing amount for each application based on billing type
     */
    private function calculateItemAmount($config, $application)
    {
        switch ($config->billing_type) {
            case 'per_application':
                // Fixed rate per application
                return $config->rate;
                
            case 'commission_based':
                // Percentage of loan amount
                $loanAmount = $this->getLoanAmount($application);
                if ($loanAmount <= 0) {
                    Log::warning("Zero loan amount for application {$application->id}, using minimum rate");
                    return $config->rate; // Use rate as minimum fee
                }
                return ($loanAmount * $config->rate) / 100;
                
            case 'monthly_subscription':
                // Fixed monthly subscription divided by number of applications
                $monthlyApps = $this->getMonthlyApplicationCount($config, $application);
                return $monthlyApps > 0 ? $config->rate / $monthlyApps : $config->rate;
                
            default:
                return $config->rate;
        }
    }

    /**
     * Get loan amount from application with fallbacks
     */
    private function getLoanAmount($application)
    {
        return $application->loan_amount 
            ?? $application->amount 
            ?? $application->purchase_price 
            ?? 0;
    }

    /**
     * Get number of applications for monthly subscription calculation
     */
    private function getMonthlyApplicationCount($config, $application)
    {
        $startOfMonth = $application->created_at->startOfMonth();
        $endOfMonth = $application->created_at->endOfMonth();

        $query = Application::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->whereIn('application_status', ['APPROVED', 'COMPLETED', 'DISBURSED']);

        if ($config->entity_type === 'lender') {
            $query->where('lender_id', $config->entity_id);
        } else {
            $query->where('car_dealer_id', $config->entity_id);
        }

        return $query->count();
    }

    /**
     * Generate descriptive text for bill item
     */
    private function generateItemDescription($config, $application)
    {
        $applicantName = trim(($application->first_name ?? '') . ' ' . ($application->last_name ?? ''));
        $vehicle = $application->make_and_model ?? 'Vehicle';
        $loanAmount = $this->getLoanAmount($application);

        $baseDescription = '';
        
        if ($config->entity_type === 'lender') {
            $baseDescription = "Loan Processing Service";
            $serviceType = "for {$applicantName}";
        } else {
            $baseDescription = "Vehicle Financing Facilitation";
            $serviceType = "for {$applicantName}";
        }

        $details = [];
        if (!empty($vehicle)) {
            $details[] = "Vehicle: {$vehicle}";
        }
        if ($loanAmount > 0) {
            $details[] = "Amount: " . number_format($loanAmount, 0) . " TZS";
        }
        $details[] = "App ID: {$application->id}";

        $description = "{$baseDescription} {$serviceType}";
        if (!empty($details)) {
            $description .= " - " . implode(', ', $details);
        }

        return $description;
    }

    /**
     * Mark bills as overdue if past due date
     */
    public function markOverdueBills()
    {
        $today = Carbon::now()->format('Y-m-d');
        
        $overdueBills = Bill::where('status', 'pending')
            ->where('due_date', '<', $today)
            ->get();

        $count = 0;
        foreach ($overdueBills as $bill) {
            $bill->update(['status' => 'overdue']);
            $count++;
            Log::info("Marked bill {$bill->bill_number} as overdue");
        }

        return $count;
    }

    /**
     * Generate comprehensive billing report
     */
    public function getBillingReport($filters = [])
    {
        $query = Bill::with(['entity', 'billItems', 'payments']);

        // Apply filters
        if (!empty($filters['entity_type'])) {
            $query->where('entity_type', $filters['entity_type']);
        }

        if (!empty($filters['entity_id'])) {
            $query->where('entity_id', $filters['entity_id']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query->whereBetween('issued_date', [$filters['start_date'], $filters['end_date']]);
        }

        $bills = $query->get();

        // Calculate statistics
        $stats = [
            'summary' => [
                'total_bills' => $bills->count(),
                'total_amount_billed' => $bills->sum('total_amount'),
                'total_amount_paid' => $bills->sum('total_paid'),
                'total_outstanding' => $bills->sum('remaining_balance'),
            ],
            'by_status' => [
                'pending' => $bills->where('status', 'pending')->count(),
                'sent' => $bills->where('status', 'sent')->count(),
                'paid' => $bills->where('status', 'paid')->count(),
                'overdue' => $bills->where('status', 'overdue')->count(),
                'cancelled' => $bills->where('status', 'cancelled')->count(),
            ],
            'by_entity_type' => [
                'lenders' => [
                    'count' => $bills->where('entity_type', 'lender')->count(),
                    'total_amount' => $bills->where('entity_type', 'lender')->sum('total_amount'),
                ],
                'car_dealers' => [
                    'count' => $bills->where('entity_type', 'car_dealer')->count(),
                    'total_amount' => $bills->where('entity_type', 'car_dealer')->sum('total_amount'),
                ],
            ],
            'financial' => [
                'subtotal' => $bills->sum('subtotal'),
                'tax_amount' => $bills->sum('tax_amount'),
                'total_applications_billed' => $bills->sum(function($bill) {
                    return $bill->billItems->count();
                }),
            ]
        ];

        return [
            'bills' => $bills,
            'statistics' => $stats,
            'filters_applied' => $filters
        ];
    }

    /**
     * Get billing summary for a specific entity
     */
    public function getEntityBillingSummary($entityType, $entityId, $months = 12)
    {
        $startDate = Carbon::now()->subMonths($months)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $bills = Bill::where('entity_type', $entityType)
            ->where('entity_id', $entityId)
            ->whereBetween('issued_date', [$startDate, $endDate])
            ->with(['billItems', 'payments'])
            ->orderBy('issued_date', 'desc')
            ->get();

        return [
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'period' => [
                'start' => $startDate->format('Y-m-d'),
                'end' => $endDate->format('Y-m-d'),
                'months' => $months
            ],
            'summary' => [
                'total_bills' => $bills->count(),
                'total_billed' => $bills->sum('total_amount'),
                'total_paid' => $bills->sum('total_paid'),
                'outstanding_balance' => $bills->sum('remaining_balance'),
                'applications_processed' => $bills->sum(function($bill) {
                    return $bill->billItems->count();
                }),
            ],
            'recent_bills' => $bills->take(10),
            'monthly_breakdown' => $this->getMonthlyBreakdown($bills)
        ];
    }

    /**
     * Get monthly breakdown of billing data
     */
    private function getMonthlyBreakdown($bills)
    {
        return $bills->groupBy(function($bill) {
            return $bill->issued_date->format('Y-m');
        })->map(function($monthlyBills) {
            return [
                'bills_count' => $monthlyBills->count(),
                'total_amount' => $monthlyBills->sum('total_amount'),
                'applications_count' => $monthlyBills->sum(function($bill) {
                    return $bill->billItems->count();
                }),
            ];
        });
    }

    /**
     * Validate billing configuration
     */
    public function validateBillingConfiguration($entityType, $entityId)
    {
        $config = BillingConfiguration::where('entity_type', $entityType)
            ->where('entity_id', $entityId)
            ->where('is_active', true)
            ->first();

        if (!$config) {
            return [
                'valid' => false,
                'message' => 'No active billing configuration found'
            ];
        }

        if ($config->rate <= 0) {
            return [
                'valid' => false,
                'message' => 'Invalid billing rate'
            ];
        }

        return [
            'valid' => true,
            'config' => $config,
            'message' => 'Billing configuration is valid'
        ];
    }
}