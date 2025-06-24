{{-- resources/views/billing/payment-receipt-pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Payment Receipt {{ $payment->payment_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px solid #28a745; padding-bottom: 20px; }
        .company-name { font-size: 24px; font-weight: bold; color: #28a745; margin-bottom: 5px; }
        .receipt-title { font-size: 20px; color: #666; margin-bottom: 10px; }
        .receipt-number { font-size: 16px; color: #28a745; font-weight: bold; }
        
        .success-banner { background: #d4edda; border: 2px solid #28a745; border-radius: 8px; padding: 20px; text-align: center; margin-bottom: 30px; }
        .success-banner h2 { margin: 0; color: #155724; font-size: 22px; }
        .success-banner p { margin: 5px 0 0 0; color: #155724; }
        
        .info-grid { display: table; width: 100%; margin-bottom: 30px; }
        .info-section { display: table-cell; width: 50%; vertical-align: top; padding: 0 10px; }
        .info-section h3 { color: #28a745; border-bottom: 2px solid #28a745; padding-bottom: 5px; margin-bottom: 15px; }
        .info-row { margin-bottom: 8px; }
        .info-label { font-weight: bold; color: #666; }
        .info-value { color: #333; }
        
        .amount-highlight { background: #f8f9fa; border: 2px solid #28a745; border-radius: 10px; padding: 20px; text-align: center; margin: 30px 0; }
        .amount-highlight .amount { font-size: 36px; font-weight: bold; color: #28a745; margin-bottom: 5px; }
        .amount-highlight .label { color: #666; font-size: 14px; }
        
        .bill-summary { background: #f8f9fa; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .bill-summary h3 { margin-top: 0; color: #333; }
        .summary-table { width: 100%; border-collapse: collapse; }
        .summary-table td { padding: 8px 0; border-bottom: 1px solid #ddd; }
        .summary-table .label { font-weight: bold; color: #666; width: 40%; }
        .summary-table .value { text-align: right; color: #333; }
        .summary-table .total { border-top: 2px solid #28a745; font-weight: bold; color: #28a745; }
        
        .footer { margin-top: 40px; text-align: center; border-top: 1px solid #ddd; padding-top: 20px; }
        .footer p { margin: 5px 0; color: #666; font-size: 12px; }
        
        .status-badge { display: inline-block; padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase; }
        .status-completed { background: #d4edda; color: #155724; }
        .watermark { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) rotate(-45deg); font-size: 100px; color: rgba(40, 167, 69, 0.1); font-weight: bold; z-index: -1; }
    </style>
</head>
<body>
    <div class="watermark">PAID</div>
    
    <div class="header">
        <div class="company-name">KIBO FINANCE</div>
        <div class="receipt-title">PAYMENT RECEIPT</div>
        <div class="receipt-number">{{ $payment->payment_number }}</div>
    </div>

    <div class="success-banner">
        <h2>✓ PAYMENT RECEIVED</h2>
        <p>This receipt confirms that your payment has been successfully processed</p>
    </div>

    <div class="amount-highlight">
        <div class="amount">{{ number_format($payment->amount, 0) }} {{ $payment->currency }}</div>
        <div class="label">Amount Received</div>
    </div>

    <div class="info-grid">
        <div class="info-section">
            <h3>Payment Information</h3>
            <div class="info-row">
                <span class="info-label">Receipt Number:</span><br>
                <span class="info-value">{{ $payment->payment_number }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Payment Date:</span><br>
                <span class="info-value">{{ $payment->payment_date->format('F d, Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Payment Method:</span><br>
                <span class="info-value">{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Reference Number:</span><br>
                <span class="info-value">{{ $payment->payment_reference ?: 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status:</span><br>
                <span class="status-badge status-completed">{{ ucfirst($payment->status) }}</span>
            </div>
        </div>

        <div class="info-section">
            <h3>Bill Information</h3>
            <div class="info-row">
                <span class="info-label">Bill Number:</span><br>
                <span class="info-value">{{ $payment->bill->bill_number }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Entity Name:</span><br>
                <span class="info-value">{{ $payment->bill->entity->name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Entity Type:</span><br>
                <span class="info-value">{{ ucfirst(str_replace('_', ' ', $payment->bill->entity_type)) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Billing Period:</span><br>
                <span class="info-value">{{ $payment->bill->billing_period_start->format('M d') }} - {{ $payment->bill->billing_period_end->format('M d, Y') }}</span>
            </div>
        </div>
    </div>

    <div class="bill-summary">
        <h3>Bill Summary</h3>
        <table class="summary-table">
            <tr>
                <td class="label">Original Bill Amount:</td>
                <td class="value">{{ number_format($payment->bill->total_amount, 0) }} TZS</td>
            </tr>
            <tr>
                <td class="label">Total Payments Made:</td>
                <td class="value">{{ number_format($payment->bill->total_paid, 0) }} TZS</td>
            </tr>
            <tr>
                <td class="label">This Payment:</td>
                <td class="value">{{ number_format($payment->amount, 0) }} TZS</td>
            </tr>
            <tr class="total">
                <td class="label">Remaining Balance:</td>
                <td class="value">{{ number_format($payment->bill->remaining_balance, 0) }} TZS</td>
            </tr>
        </table>
    </div>

    @if($payment->notes)
        <div class="bill-summary">
            <h3>Payment Notes</h3>
            <p>{{ $payment->notes }}</p>
        </div>
    @endif

    @if($payment->bill->remaining_balance <= 0)
        <div style="background: #d4edda; border: 2px solid #28a745; border-radius: 8px; padding: 20px; text-align: center; margin: 20px 0;">
            <h3 style="margin: 0; color: #155724;">✓ BILL FULLY PAID</h3>
            <p style="margin: 5px 0 0 0; color: #155724;">This bill has been paid in full. Thank you!</p>
        </div>
    @else
        <div style="background: #fff3cd; border: 2px solid #ffc107; border-radius: 8px; padding: 20px; text-align: center; margin: 20px 0;">
            <h3 style="margin: 0; color: #856404;">OUTSTANDING BALANCE</h3>
            <p style="margin: 5px 0 0 0; color: #856404;">Remaining balance: {{ number_format($payment->bill->remaining_balance, 0) }} TZS</p>
        </div>
    @endif

    <div class="footer">
        <p><strong>Thank you for your payment!</strong></p>
        <p>This receipt is computer generated and serves as proof of payment.</p>
        <p>For any inquiries regarding this payment, please contact our billing department.</p>
        <p>Email: billing@kibofinance.com | Phone: +255 XXX XXX XXX</p>
        <p>Generated on: {{ now()->format('F d, Y \a\t g:i A') }}</p>
        <p>&copy; {{ date('Y') }} Kibo Finance. All rights reserved.</p>
    </div>
</body>
</html>