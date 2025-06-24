<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Application;
use App\Models\BillingConfiguration;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BillingService
{
    public function generateMonthlyBills($month = null, $year = null)
    {
        $month = $month ?: Carbon::now()->month;
        $year = $year ?: Carbon::now()->year;
        
        $periodStart = Carbon::create($year, $month, 1);
        $periodEnd = $periodStart->copy()->endOfMonth();

        // Get all active billing configurations
        $configs = BillingConfiguration::where('is_active', true)->get();

        foreach ($configs as $config) {
            $this->generateBillForEntity($config, $periodStart, $periodEnd);
        }
    }

    public function generateBillForEntity($config, $periodStart, $periodEnd)
    {
        // Check if bill already exists for this period
        $existingBill = Bill::where('entity_type', $config->entity_type)
            ->where('entity_id', $config->entity_id)
            ->where('billing_period_start', $periodStart->format('Y-m-d'))
            ->where('billing_period_end', $periodEnd->format('Y-m-d'))
            ->first();

        if ($existingBill) {
            return $existingBill;
        }

        // Get applications for this entity in the billing period
        $applications = $this->getApplicationsForPeriod(
            $config->entity_type, 
            $config->entity_id, 
            $periodStart, 
            $periodEnd
        );

        if ($applications->isEmpty()) {
            return null;
        }

        return DB::transaction(function () use ($config, $applications, $periodStart, $periodEnd) {
            // Create bill
            $bill = Bill::create([
                'entity_type' => $config->entity_type,
                'entity_id' => $config->entity_id,
                'billing_period_start' => $periodStart->format('Y-m-d'),
                'billing_period_end' => $periodEnd->format('Y-m-d'),
                'subtotal' => 0,
                'tax_amount' => 0,
                'total_amount' => 0,
                'status' => 'pending',
                'due_date' => $periodEnd->addDays(30)->format('Y-m-d'),
                'issued_date' => Carbon::now()->format('Y-m-d'),
                'currency' => $config->currency,
            ]);

            $subtotal = 0;

            // Create bill items
            foreach ($applications as $application) {
                $itemTotal = $this->calculateItemTotal($config, $application);
                
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

            // Calculate tax (18% VAT)
            $taxAmount = $subtotal * 0.18;
            $totalAmount = $subtotal + $taxAmount;

            // Update bill totals
            $bill->update([
                'subtotal' => $subtotal,
                'tax_amount' => $taxAmount,
                'total_amount' => $totalAmount,
            ]);

            return $bill;
        });
    }

    private function getApplicationsForPeriod($entityType, $entityId, $periodStart, $periodEnd)
    {
        $column = $entityType === 'lender' ? 'lender_id' : 'car_dealer_id';
        
        return Application::where($column, $entityId)
            ->whereBetween('created_at', [
                $periodStart->startOfDay(),
                $periodEnd->endOfDay()
            ])
            ->get();
    }

    private function calculateItemTotal($config, $application)
    {
        switch ($config->billing_type) {
            case 'per_application':
                return $config->rate;
                
            case 'commission_based':
                // Calculate percentage of loan amount
                $loanAmount = $application->loan_amount ?? $application->amount ?? 0;
                return ($loanAmount * $config->rate) / 100;
                
            case 'monthly_subscription':
                // Fixed monthly rate regardless of applications
                return $config->rate;
                
            default:
                return $config->rate;
        }
    }

    private function generateItemDescription($config, $application)
    {
        $entityType = ucfirst(str_replace('_', ' ', $config->entity_type));
        $applicantName = trim($application->first_name . ' ' . $application->last_name);
        
        switch ($config->billing_type) {
            case 'per_application':
                return "Application processing fee for {$applicantName} (ID: {$application->id})";
                
            case 'commission_based':
                return "Commission for loan facilitation - {$applicantName} (ID: {$application->id})";
                
            case 'monthly_subscription':
                return "Monthly subscription fee for {$entityType} services";
                
            default:
                return "Service fee for {$applicantName} (ID: {$application->id})";
        }
    }

    public function markOverdueBills()
    {
        $overdueBills = Bill::where('status', 'pending')
            ->where('due_date', '<', Carbon::now()->format('Y-m-d'))
            ->get();

        foreach ($overdueBills as $bill) {
            $bill->update(['status' => 'overdue']);
        }

        return $overdueBills->count();
    }

    public function getBillingReport($entityType = null, $entityId = null, $startDate = null, $endDate = null)
    {
        $query = Bill::with(['entity', 'billItems', 'payments']);

        if ($entityType) {
            $query->where('entity_type', $entityType);
        }

        if ($entityId) {
            $query->where('entity_id', $entityId);
        }

        if ($startDate && $endDate) {
            $query->whereBetween('issued_date', [$startDate, $endDate]);
        }

        $bills = $query->get();

        return [
            'total_bills' => $bills->count(),
            'total_amount' => $bills->sum('total_amount'),
            'total_paid' => $bills->sum('total_paid'),
            'pending_amount' => $bills->where('status', 'pending')->sum('total_amount'),
            'overdue_amount' => $bills->where('status', 'overdue')->sum('total_amount'),
            'bills_by_status' => $bills->groupBy('status')->map->count(),
            'bills_by_entity_type' => $bills->groupBy('entity_type')->map->count(),
        ];
    }
}