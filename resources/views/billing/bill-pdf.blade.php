<!DOCTYPE html>
<html>
<head>
    <title>Bill {{ $bill->bill_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .bill-info { margin-bottom: 20px; }
        .entity-info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .totals { text-align: right; margin-top: 20px; }
        .footer { margin-top: 30px; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>INVOICE</h1>
        <h2>{{ $bill->bill_number }}</h2>
    </div>

    <div class="bill-info">
        <strong>Bill Information:</strong><br>
        Issue Date: {{ $bill->issued_date->format('F d, Y') }}<br>
        Due Date: {{ $bill->due_date->format('F d, Y') }}<br>
        Billing Period: {{ $bill->billing_period_start->format('F d, Y') }} - {{ $bill->billing_period_end->format('F d, Y') }}<br>
        Status: {{ ucfirst($bill->status) }}
    </div>

    <div class="entity-info">
        <strong>Bill To:</strong><br>
        {{ $bill->entity->name }}<br>
        {{ $bill->entity->address ?? '' }}<br>
        {{ $bill->entity->city ?? '' }}, {{ $bill->entity->region ?? '' }}<br>
        {{ $bill->entity->email ?? '' }}<br>
        {{ $bill->entity->phone_number ?? '' }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Date</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bill->billItems as $item)
            <tr>
                <td>{{ $item->description }}</td>
                <td>{{ $item->item_date->format('M d, Y') }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->unit_price, 2) }} {{ $bill->currency }}</td>
                <td>{{ number_format($item->total_price, 2) }} {{ $bill->currency }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <table style="width: 300px; margin-left: auto;">
            <tr>
                <td><strong>Subtotal:</strong></td>
                <td>{{ number_format($bill->subtotal, 2) }} {{ $bill->currency }}</td>
            </tr>
            <tr>
                <td><strong>Tax (18%):</strong></td>
                <td>{{ number_format($bill->tax_amount, 2) }} {{ $bill->currency }}</td>
            </tr>
            <tr style="border-top: 2px solid #000;">
                <td><strong>Total:</strong></td>
                <td><strong>{{ number_format($bill->total_amount, 2) }} {{ $bill->currency }}</strong></td>
            </tr>
            @if($bill->total_paid > 0)
            <tr>
                <td><strong>Paid:</strong></td>
                <td>{{ number_format($bill->total_paid, 2) }} {{ $bill->currency }}</td>
            </tr>
            <tr>
                <td><strong>Balance Due:</strong></td>
                <td><strong>{{ number_format($bill->remaining_balance, 2) }} {{ $bill->currency }}</strong></td>
            </tr>
            @endif
        </table>
    </div>

    @if($bill->payments->count() > 0)
    <div style="margin-top: 30px;">
        <h3>Payment History</h3>
        <table>
            <thead>
                <tr>
                    <th>Payment Date</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Reference</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bill->payments as $payment)
                <tr>
                    <td>{{ $payment->payment_date->format('M d, Y') }}</td>
                    <td>{{ number_format($payment->amount, 2) }} {{ $payment->currency }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
                    <td>{{ $payment->payment_reference ?? 'N/A' }}</td>
                    <td>{{ ucfirst($payment->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="footer">
        <p>Thank you for your business!</p>
        <p>For questions about this bill, please contact our billing department.</p>
    </div>
</body>
</html>