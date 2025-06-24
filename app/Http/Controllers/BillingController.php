<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Payment;
use App\Services\BillingService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BillsExport;

class BillingController extends Controller
{
    protected $billingService;

    public function __construct(BillingService $billingService)
    {
        $this->billingService = $billingService;
    }

    public function generatePDF(Bill $bill)
    {
        $bill->load(['entity', 'billItems.application', 'payments']);
        
        $pdf = Pdf::loadView('billing.bill-pdf', compact('bill'));
        
        return $pdf->download("bill-{$bill->bill_number}.pdf");
    }

    public function generatePaymentReceipt(Payment $payment)
    {
        $payment->load(['bill.entity']);
        
        $pdf = Pdf::loadView('billing.payment-receipt-pdf', compact('payment'));
        
        return $pdf->download("receipt-{$payment->payment_number}.pdf");
    }

    public function export(Request $request)
    {
        $filters = $request->only([
            'entity_type', 'entity_id', 'status', 
            'date_from', 'date_to', 'search_term'
        ]);

        return Excel::download(new BillsExport($filters), 'bills-export.xlsx');
    }
}