<?php

namespace App\Http\Livewire\Report;

use App\Models\Application;
use App\Models\Bill;
use App\Models\BillItem;
use App\Models\CarDealer;
use App\Models\Lender;
use App\Models\Payment;
use App\Services\BillingService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class BillingManagement extends Component
{
    use WithPagination;

    // Tab and filter states
    public $selectedTab = 'bills';

    public $selectedEntityType = '';

    public $selectedEntityId = '';

    public $dateFrom = '';

    public $dateTo = '';

    public $statusFilter = '';

    public $searchTerm = '';

    // Bill creation modal
    public $showBillModal = false;

    public $newBillEntityType = 'lender';

    public $newBillEntityId = '';

    public $newBillPeriodStart = '';

    public $newBillPeriodEnd = '';

    public $sendEmailOnGenerate = true;

    // Payment recording modal
    public $showPaymentModal = false;

    public $selectedBillId = '';

    public $paymentAmount = '';

    public $paymentMethod = 'bank_transfer';

    public $paymentReference = '';

    public $paymentDate = '';

    public $paymentNotes = '';

    public $sendEmailOnPayment = true;

    // Bill details modal
    public $showBillDetailsModal = false;

    public $selectedBillForDetails = null;

    // Payment receipt modal
    public $showPaymentReceiptModal = false;

    public $selectedPaymentForReceipt = null;

    // Loading states
    public $isGeneratingBill = false;

    public $isRecordingPayment = false;

    protected $billingService;

    public function boot(BillingService $billingService)
    {
        $this->billingService = $billingService;
    }

    public function mount()
    {
        $this->initializeDefaults();
    }

    public function render()
    {
        $data = $this->prepareRenderData();

        return view('livewire.report.billing-management', $data);
    }

    private function initializeDefaults()
    {
        $this->dateFrom = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->dateTo = Carbon::now()->endOfMonth()->format('Y-m-d');
        $this->paymentDate = Carbon::now()->format('Y-m-d');
        $this->newBillPeriodStart = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->newBillPeriodEnd = Carbon::now()->endOfMonth()->format('Y-m-d');
    }

    private function prepareRenderData()
    {
        return [
            'bills' => $this->getBills(),
            'payments' => $this->getPayments(),
            'statistics' => $this->getStatistics(),
            'lenders' => $this->getActiveLenders(),
            'carDealers' => $this->getActiveCarDealers(),
        ];
    }

    private function getBills()
    {
        $query = Bill::with(['entity', 'billItems', 'payments'])
            ->when($this->selectedEntityType, fn ($q) => $q->where('entity_type', $this->selectedEntityType))
            ->when($this->selectedEntityId, fn ($q) => $q->where('entity_id', $this->selectedEntityId))
            ->when($this->statusFilter, fn ($q) => $q->where('status', $this->statusFilter))
            ->when($this->dateFrom, fn ($q) => $q->where('issued_date', '>=', $this->dateFrom))
            ->when($this->dateTo, fn ($q) => $q->where('issued_date', '<=', $this->dateTo))
            ->when($this->searchTerm, function ($q) {
                $q->where(function ($query) {
                    $query->where('bill_number', 'like', '%'.$this->searchTerm.'%')
                        ->orWhereHas('entity', function ($entityQuery) {
                            $entityQuery->where('name', 'like', '%'.$this->searchTerm.'%');
                        });
                });
            })
            ->orderBy('created_at', 'desc');

        return $query->paginate(15);
    }

    private function getPayments()
    {
        return Payment::with(['bill.entity'])
            ->when($this->dateFrom, fn ($q) => $q->where('payment_date', '>=', $this->dateFrom))
            ->when($this->dateTo, fn ($q) => $q->where('payment_date', '<=', $this->dateTo))
            ->when($this->searchTerm, function ($q) {
                $q->where(function ($query) {
                    $query->where('payment_number', 'like', '%'.$this->searchTerm.'%')
                        ->orWhere('payment_reference', 'like', '%'.$this->searchTerm.'%')
                        ->orWhereHas('bill.entity', function ($entityQuery) {
                            $entityQuery->where('name', 'like', '%'.$this->searchTerm.'%');
                        });
                });
            })
            ->orderBy('payment_date', 'desc')
            ->paginate(15);
    }

    private function getStatistics()
    {
        $startDate = $this->dateFrom ?: Carbon::now()->startOfMonth();
        $endDate = $this->dateTo ?: Carbon::now()->endOfMonth();

        $billsQuery = Bill::whereBetween('issued_date', [$startDate, $endDate]);
        $paymentsQuery = Payment::where('status', 'completed')
            ->whereBetween('payment_date', [$startDate, $endDate]);

        return [
            'total_bills' => $billsQuery->count(),
            'total_amount_billed' => $billsQuery->sum('total_amount'),
            'total_paid' => $paymentsQuery->sum('amount'),
            'pending_bills' => Bill::where('status', 'pending')->count(),
            'overdue_bills' => Bill::where('status', 'overdue')->count(),
            'lender_bills_count' => $billsQuery->where('entity_type', 'lender')->count(),
            'dealer_bills_count' => $billsQuery->where('entity_type', 'car_dealer')->count(),
        ];
    }

    private function getActiveLenders()
    {
        return Lender::where('status', 'APPROVED')
            ->orderBy('name')
            ->get(['id', 'name', 'email']);
    }

    private function getActiveCarDealers()
    {
        return CarDealer::where('status', 'APPROVED')
            ->orderBy('name')
            ->get(['id', 'name', 'email']);
    }

    public function generateBill()
    {
        $this->validate([
            'newBillEntityType' => 'required|in:lender,car_dealer',
            'newBillEntityId' => 'required|integer|exists:'.($this->newBillEntityType === 'lender' ? 'lenders' : 'car_dealers').',id',
            'newBillPeriodStart' => 'required|date|before_or_equal:newBillPeriodEnd',
            'newBillPeriodEnd' => 'required|date|after_or_equal:newBillPeriodStart',
        ]);

        $this->isGeneratingBill = true;

        try {
            DB::transaction(function () {
                $entity = $this->getEntityById($this->newBillEntityType, $this->newBillEntityId);

                if (! $entity) {
                    throw new Exception('Entity not found or inactive.');
                }

                // Check for existing bill in this period
                $existingBill = $this->checkExistingBill();
                if ($existingBill) {
                    throw new Exception('A bill already exists for this entity and period.');
                }

                // Get billable applications
                $applications = $this->getBillableApplications();

                if ($applications->isEmpty()) {
                    throw new Exception('No approved applications found for this billing period.');
                }

                // Create the bill
                $bill = $this->createBillWithItems($entity, $applications);

                // Send email notification if requested
                if ($this->sendEmailOnGenerate) {
                    $this->sendBillNotificationEmail($bill, $entity);
                }

                $this->emit('bill-generated', 'Bill generated successfully! '.
                    ($this->sendEmailOnGenerate ? 'Email notification sent.' : ''));
            });

            $this->resetBillForm();
            $this->showBillModal = false;

        } catch (Exception $e) {
            $this->addError('newBillEntityId', $e->getMessage());
            Log::error('Bill generation failed: '.$e->getMessage());
        } finally {
            $this->isGeneratingBill = false;
        }
    }

    private function checkExistingBill()
    {
        return Bill::where('entity_type', $this->newBillEntityType)
            ->where('entity_id', $this->newBillEntityId)
            ->where('billing_period_start', $this->newBillPeriodStart)
            ->where('billing_period_end', $this->newBillPeriodEnd)
            ->first();
    }

    private function getBillableApplications()
    {
        $entityColumn = $this->newBillEntityType === 'lender' ? 'lender_id' : 'car_dealer_id';

        return Application::where($entityColumn, $this->newBillEntityId)
            ->whereBetween('created_at', [
                $this->newBillPeriodStart.' 00:00:00',
                $this->newBillPeriodEnd.' 23:59:59',
            ])
            ->whereIn('application_status', ['APPROVED', 'COMPLETED', 'DISBURSED', 'ACCEPTED'])
            ->whereDoesntHave('billItems') // Exclude already billed applications
            ->with(['lender', 'carDealer'])
            ->get();
    }

    private function createBillWithItems($entity, $applications)
    {
        // Create bill
        $bill = Bill::create([
            'entity_type' => $this->newBillEntityType,
            'entity_id' => $this->newBillEntityId,
            'billing_period_start' => $this->newBillPeriodStart,
            'billing_period_end' => $this->newBillPeriodEnd,
            'subtotal' => 0,
            'tax_amount' => 0,
            'total_amount' => 0,
            'currency' => 'TZS',
            'status' => 'pending',
            'due_date' => Carbon::parse($this->newBillPeriodEnd)->addDays(30),
            'issued_date' => Carbon::now()->format('Y-m-d'),
        ]);

        $subtotal = 0;
        $billingConfig = $entity->billingConfiguration;
        $defaultRate = $this->newBillEntityType === 'lender' ? 50000 : 30000;
        $rate = $billingConfig ? $billingConfig->rate : $defaultRate;

        // Create bill items
        foreach ($applications as $application) {
            $itemTotal = $this->calculateItemAmount($billingConfig, $application, $rate);

            BillItem::create([
                'bill_id' => $bill->id,
                'application_id' => $application->id,
                'description' => $this->generateItemDescription($application),
                'quantity' => 1,
                'unit_price' => $itemTotal,
                'total_price' => $itemTotal,
                'item_date' => $application->created_at->format('Y-m-d'),
            ]);

            $subtotal += $itemTotal;
        }

        // Calculate totals
        $taxAmount = $subtotal * 0.18; // 18% VAT
        $totalAmount = $subtotal + $taxAmount;

        // Update bill with totals
        $bill->update([
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
        ]);

        return $bill;
    }

    private function calculateItemAmount($billingConfig, $application, $defaultRate)
    {
        if (! $billingConfig) {
            return $defaultRate;
        }

        switch ($billingConfig->billing_type) {
            case 'per_application':
                return $billingConfig->rate;

            case 'commission_based':
                $loanAmount = $application->loan_amount
                    ?? $application->amount
                    ?? $application->purchase_price
                    ?? 0;

                if ($loanAmount <= 0) {
                    return $billingConfig->rate; // Use rate as minimum fee
                }

                return ($loanAmount * $billingConfig->rate) / 100;

            case 'monthly_subscription':
                // For subscription, divide monthly rate by applications count
                $monthlyApps = $this->getMonthlyApplicationCount($application);

                return $monthlyApps > 0 ? $billingConfig->rate / $monthlyApps : $billingConfig->rate;

            default:
                return $billingConfig->rate;
        }
    }

    private function getMonthlyApplicationCount($application)
    {
        $startOfMonth = $application->created_at->startOfMonth();
        $endOfMonth = $application->created_at->endOfMonth();
        $entityColumn = $this->newBillEntityType === 'lender' ? 'lender_id' : 'car_dealer_id';

        return Application::where($entityColumn, $this->newBillEntityId)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->whereIn('application_status', ['APPROVED', 'COMPLETED', 'DISBURSED'])
            ->count();
    }

    private function generateItemDescription($application)
    {
        $applicantName = trim(($application->first_name ?? '').' '.($application->last_name ?? ''));
        $vehicle = $application->make_and_model ?? 'Vehicle';
        $loanAmount = $application->loan_amount ?? $application->amount ?? 0;

        $serviceType = $this->newBillEntityType === 'lender'
            ? 'Loan Processing Service'
            : 'Vehicle Financing Facilitation';

        $details = [];
        if (! empty($applicantName)) {
            $details[] = "for {$applicantName}";
        }
        if (! empty($vehicle)) {
            $details[] = "Vehicle: {$vehicle}";
        }
        if ($loanAmount > 0) {
            $details[] = 'Amount: '.number_format($loanAmount, 0).' TZS';
        }
        $details[] = "App ID: {$application->id}";

        return $serviceType.' '.implode(' - ', $details);
    }

    public function recordPayment()
    {
        $this->validate([
            'selectedBillId' => 'required|exists:bills,id',
            'paymentAmount' => 'required|numeric|min:0.01',
            'paymentMethod' => 'required|string|max:50',
            'paymentDate' => 'required|date|before_or_equal:today',
            'paymentReference' => 'nullable|string|max:100',
            'paymentNotes' => 'nullable|string|max:500',
        ]);

        $this->isRecordingPayment = true;

        try {
            $bill = Bill::with('entity')->find($this->selectedBillId);

            if (! $bill) {
                throw new Exception('Bill not found.');
            }

            if ($this->paymentAmount > $bill->remaining_balance) {
                throw new Exception('Payment amount cannot exceed remaining balance of '.
                    number_format($bill->remaining_balance, 0).' TZS');
            }

            DB::transaction(function () use ($bill) {
                // Create payment record
                $payment = Payment::create([
                    'bill_id' => $this->selectedBillId,
                    'amount' => $this->paymentAmount,
                    'currency' => $bill->currency ?? 'TZS',
                    'payment_method' => $this->paymentMethod,
                    'payment_reference' => $this->paymentReference,
                    'payment_date' => $this->paymentDate,
                    'status' => 'completed',
                    'processed_by' => auth()->user()->name ?? 'System',
                    'notes' => $this->paymentNotes,
                ]);

                // Update bill status if fully paid
                $newBalance = $bill->remaining_balance - $this->paymentAmount;
                if ($newBalance <= 0) {
                    $bill->update([
                        'status' => 'paid',
                        'paid_date' => $this->paymentDate,
                    ]);
                }

                // Send email notification if requested
                if ($this->sendEmailOnPayment) {
                    $this->sendPaymentNotificationEmail($bill, $payment);
                }
            });

            $this->emit('payment-recorded', 'Payment recorded successfully! '.
                ($this->sendEmailOnPayment ? 'Confirmation email sent.' : ''));

            $this->resetPaymentForm();
            $this->showPaymentModal = false;

        } catch (Exception $e) {
            $this->addError('paymentAmount', $e->getMessage());
            Log::error('Payment recording failed: '.$e->getMessage());
        } finally {
            $this->isRecordingPayment = false;
        }
    }

    public function openPaymentModal($billId)
    {
        $bill = Bill::find($billId);
        if ($bill && $bill->remaining_balance > 0) {
            $this->selectedBillId = $billId;
            $this->paymentAmount = $bill->remaining_balance; // Pre-fill with remaining balance
            $this->showPaymentModal = true;
        }
    }

    public function viewBillDetails($billId)
    {
        $this->selectedBillForDetails = Bill::with([
            'entity',
            'billItems.application',
            'payments' => function ($query) {
                $query->orderBy('payment_date', 'desc');
            },
        ])->find($billId);

        if ($this->selectedBillForDetails) {
            $this->showBillDetailsModal = true;
        }
    }

    public function viewPaymentReceipt($paymentId)
    {
        $this->selectedPaymentForReceipt = Payment::with(['bill.entity'])->find($paymentId);

        if ($this->selectedPaymentForReceipt) {
            $this->showPaymentReceiptModal = true;
        }
    }

    private function getEntityById($entityType, $entityId)
    {
        $model = $entityType === 'lender' ? Lender::class : CarDealer::class;

        return $model::where('id', $entityId)
            ->where('status', 'APPROVED')
            ->first();
    }

    private function sendBillNotificationEmail($bill, $entity)
    {
        try {

            Mail::to($entity->email)
                ->send(new \App\Mail\BillGenerated($bill, $entity));

            // Update bill status to 'sent'
            $bill->update(['status' => 'sent']);

            Log::info("Bill notification email sent to {$entity->email} for bill {$bill->bill_number}");

        } catch (Exception $e) {
            Log::error('Failed to send bill notification email: '.$e->getMessage());
            // Don't throw exception, just log it
        }
    }

    private function sendPaymentNotificationEmail($bill, $payment)
    {
        try {
            Mail::to($bill->entity->email)
                ->send(new \App\Mail\PaymentReceived($bill, $payment->amount));

            Log::info("Payment notification email sent to {$bill->entity->email} for payment {$payment->payment_number}");

        } catch (Exception $e) {
            Log::error('Failed to send payment notification email: '.$e->getMessage());
            // Don't throw exception, just log it
        }
    }

    public function markAsOverdue($billId)
    {
        try {
            $bill = Bill::find($billId);
            if ($bill && $bill->status !== 'paid') {
                $bill->update(['status' => 'overdue']);
                $this->emit('status-updated', 'Bill marked as overdue.');
            }
        } catch (Exception $e) {
            Log::error('Failed to mark bill as overdue: '.$e->getMessage());
        }
    }

    public function exportBills()
    {
        try {
            $this->emit('export-started', 'Export started...');
            // Export functionality will be handled by the route
        } catch (Exception $e) {
            Log::error('Export failed: '.$e->getMessage());
        }
    }

    public function resetBillForm()
    {
        $this->newBillEntityType = 'lender';
        $this->newBillEntityId = '';
        $this->newBillPeriodStart = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->newBillPeriodEnd = Carbon::now()->endOfMonth()->format('Y-m-d');
        $this->sendEmailOnGenerate = true;
    }

    public function resetPaymentForm()
    {
        $this->selectedBillId = '';
        $this->paymentAmount = '';
        $this->paymentMethod = 'bank_transfer';
        $this->paymentReference = '';
        $this->paymentDate = Carbon::now()->format('Y-m-d');
        $this->paymentNotes = '';
        $this->sendEmailOnPayment = true;
    }

    public function resetFilters()
    {
        $this->selectedEntityType = '';
        $this->selectedEntityId = '';
        $this->statusFilter = '';
        $this->searchTerm = '';
        $this->dateFrom = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->dateTo = Carbon::now()->endOfMonth()->format('Y-m-d');
        $this->resetPage();
    }

    // Close modal methods
    public function closeBillModal()
    {
        $this->showBillModal = false;
        $this->resetBillForm();
    }

    public function closePaymentModal()
    {
        $this->showPaymentModal = false;
        $this->resetPaymentForm();
    }

    public function closeBillDetailsModal()
    {
        $this->showBillDetailsModal = false;
        $this->selectedBillForDetails = null;
    }

    public function closePaymentReceiptModal()
    {
        $this->showPaymentReceiptModal = false;
        $this->selectedPaymentForReceipt = null;
    }

    // Computed properties for better performance
    public function getSelectedBillProperty()
    {
        return $this->selectedBillId ? Bill::find($this->selectedBillId) : null;
    }

    // Real-time validation rules
    protected function rules()
    {
        return [
            'newBillEntityType' => 'required|in:lender,car_dealer',
            'newBillEntityId' => 'required|integer',
            'newBillPeriodStart' => 'required|date',
            'newBillPeriodEnd' => 'required|date|after_or_equal:newBillPeriodStart',
            'paymentAmount' => 'required|numeric|min:0.01',
            'paymentMethod' => 'required|string',
            'paymentDate' => 'required|date|before_or_equal:today',
        ];
    }

    // Custom validation messages
    protected function messages()
    {
        return [
            'newBillEntityId.required' => 'Please select a lender or car dealer.',
            'newBillPeriodEnd.after_or_equal' => 'End date must be on or after the start date.',
            'paymentAmount.min' => 'Payment amount must be greater than zero.',
            'paymentDate.before_or_equal' => 'Payment date cannot be in the future.',
        ];
    }
}
