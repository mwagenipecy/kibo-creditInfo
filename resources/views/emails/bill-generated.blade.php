@extends('emails.layouts.base')

@section('title', 'New Bill Generated - KiboAuto Finance')

@section('promo-banner')
 Your monthly service bill is ready! View details and make payment to continue enjoying our premium services.
@endsection

@section('content')
<div class="text-center">
    <h2>📄 New Bill Generated</h2>
    <p>Dear <strong>{{ $entity->name }}</strong>,</p>
    <p>Thank you for using KiboAuto services! We've generated your monthly bill for the period <strong>{{ $bill->billing_period_start->format('F d, Y') }}</strong> to <strong>{{ $bill->billing_period_end->format('F d, Y') }}</strong>.</p>
</div>

<div class="info-box success">
    <h3 style="margin-top: 0; color: #155724;"> Bill Summary</h3>
    <table class="table">
        <tr>
            <td style="font-weight: bold;"> Bill Number:</td>
            <td><strong>{{ $bill->bill_number }}</strong></td>
        </tr>
        <tr>
            <td style="font-weight: bold;"> {{ $entityType }}:</td>
            <td>{{ $entity->name }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Billing Period:</td>
            <td>{{ $bill->billing_period_start->format('F d, Y') }} - {{ $bill->billing_period_end->format('F d, Y') }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;"> Issue Date:</td>
            <td>{{ $bill->issued_date->format('F d, Y') }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;"> Due Date:</td>
            <td style="color: #dc3545; font-weight: bold;">{{ $bill->due_date->format('F d, Y') }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;"> Applications Processed:</td>
            <td>{{ $bill->billItems->count() }} applications</td>
        </tr>
    </table>
</div>

<div class="info-box" style="border-left-color: #28a745; background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
    <h3 style="margin-top: 0; color: #155724; text-align: center;"> Amount Breakdown</h3>
    <table style="width: 100%; margin: 0;">
        <tr style="border-bottom: 1px solid #28a745;">
            <td style="padding: 12px; font-weight: bold;"> Subtotal:</td>
            <td style="padding: 12px; text-align: right; font-weight: bold; color: #28a745;">{{ number_format($bill->subtotal, 0) }} TZS</td>
        </tr>
        <tr style="border-bottom: 1px solid #28a745;">
            <td style="padding: 12px; font-weight: bold;"> VAT (18%):</td>
            <td style="padding: 12px; text-align: right; font-weight: bold; color: #28a745;">{{ number_format($bill->tax_amount, 0) }} TZS</td>
        </tr>
        <tr style="border-top: 3px solid #28a745; background: rgba(255,255,255,0.5);">
            <td style="padding: 15px; font-weight: bold; font-size: 18px; color: #155724;"> Total Amount:</td>
            <td style="padding: 15px; text-align: right; font-weight: bold; font-size: 18px; color: #155724;">{{ number_format($bill->total_amount, 0) }} TZS</td>
        </tr>
    </table>
</div>

<div class="info-box warning">
    <h4> Payment Instructions:</h4>
    <ul style="margin: 0; padding-left: 20px;">
        <li><strong>Payment Due:</strong> {{ $bill->due_date->format('F d, Y') }}</li>
        <li><strong>Reference Number:</strong> {{ $bill->bill_number }}</li>
        <li><strong>Payment Methods:</strong> Bank transfer, mobile money, or online payment</li>
        <li><strong>Late Payment:</strong> May incur additional charges</li>
    </ul>
</div>

<div class="btn-center">
    <a href="#" class="btn btn-success"> Make Payment Now</a>
    <a href="#" class="btn"> Download Invoice</a>
</div>

<div class="info-box">
    <h4> Thank You for Your Partnership!</h4>
    <p>We appreciate your continued trust in KiboAuto services. Your prompt payment helps us maintain the high-quality automotive solutions you've come to expect.</p>
    
    <div style="background: rgba(102, 126, 234, 0.1); padding: 15px; border-radius: 8px; margin: 15px 0;">
        <h5 style="margin: 0 0 10px 0; color: #667eea;"> What's Next?</h5>
        <ul style="margin: 0; padding-left: 20px;">
            <li>Complete your payment by the due date</li>
            <li>Continue enjoying our premium automotive services</li>
            <li>Contact us if you have any billing questions</li>
        </ul>
    </div>
</div>

<div class="text-center mt-20">
    <p style="color: #666; font-size: 14px;">
        Need help with payment or have questions about this bill?<br>
         Email: billing@kiboauto.com | Phone: +255 XXX XXX XXX
    </p>
</div>
@endsection

