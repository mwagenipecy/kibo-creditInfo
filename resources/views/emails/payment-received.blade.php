@extends('emails.layouts.base')

@section('title', 'Payment Confirmation - KiboAuto Finance')

@section('promo-banner')
✅ Payment Successfully Received! Thank you for your prompt payment and continued trust in KiboAuto.
@endsection

@section('content')
<div class="text-center">
    <h2>🎉 Payment Confirmation</h2>
    <p>Dear <strong>{{ $entity->name }}</strong>,</p>
    <p>We're delighted to confirm that we have successfully received your payment for bill <strong>{{ $bill->bill_number }}</strong>. Thank you for your prompt payment!</p>
</div>

<div class="info-box success text-center">
    <h3 style="margin-top: 0; color: #155724;">💰 Payment Received</h3>
    <div style="background: #ffffff; border: 3px solid #28a745; padding: 25px; border-radius: 15px; margin: 20px 0; font-size: 36px; font-weight: bold; color: #28a745; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        {{ number_format($paymentAmount, 0) }} TZS
    </div>
    <p style="margin: 0; color: #155724; font-size: 16px;"><strong>✅ Payment Processed Successfully</strong></p>
</div>

<div class="info-box">
    <h3 style="margin-top: 0;">📋 Payment Details</h3>
    <table class="table">
        <tr>
            <td style="font-weight: bold;">📄 Bill Number:</td>
            <td><strong>{{ $bill->bill_number }}</strong></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">🏢 {{ $entityType }}:</td>
            <td>{{ $entity->name }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">💵 Payment Amount:</td>
            <td style="color: #28a745; font-weight: bold;">{{ number_format($paymentAmount, 0) }} TZS</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">📅 Payment Date:</td>
            <td>{{ now()->format('F d, Y') }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">💳 Bill Total:</td>
            <td>{{ number_format($bill->total_amount, 0) }} TZS</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">⚖️ Remaining Balance:</td>
            <td style="color: {{ $bill->remaining_balance > 0 ? '#dc3545' : '#28a745' }}; font-weight: bold;">{{ number_format($bill->remaining_balance, 0) }} TZS</td>
        </tr>
    </table>
</div>

@if($bill->remaining_balance > 0)
    <div class="info-box warning">
        <h4 style="margin-top: 0; color: #856404;">⚠️ Outstanding Balance</h4>
        <p style="margin-bottom: 0;">You still have an outstanding balance of <strong style="color: #dc3545;">{{ number_format($bill->remaining_balance, 0) }} TZS</strong> on this bill. Please arrange for the remaining payment at your earliest convenience to avoid any service interruptions.</p>
        
        <div class="btn-center" style="margin-top: 20px;">
            <a href="#" class="btn btn-warning">💳 Pay Remaining Balance</a>
        </div>
    </div>
@else
    <div class="info-box success">
        <h4 style="margin-top: 0; color: #155724;">🎊 Bill Fully Paid!</h4>
        <p style="margin-bottom: 0;">Congratulations! This bill has been paid in full. Thank you for your complete payment and continued partnership with KiboAuto.</p>
        
        <div style="background: rgba(40, 167, 69, 0.1); padding: 15px; border-radius: 8px; margin: 15px 0; text-align: center;">
            <h5 style="margin: 0; color: #155724;">🎁 You're All Set!</h5>
            <p style="margin: 5px 0 0 0; color: #155724;">Continue enjoying our premium automotive services without any interruptions.</p>
        </div>
    </div>
@endif

<div class="info-box">
    <h4>📄 Receipt Information</h4>
    <p>This payment confirmation serves as your official receipt. Please keep this email for your records and tax purposes.</p>
    
    <div style="background: rgba(102, 126, 234, 0.1); padding: 15px; border-radius: 8px; margin: 15px 0;">
        <h5 style="margin: 0 0 10px 0; color: #667eea;">🔍 Transaction Summary</h5>
        <ul style="margin: 0; padding-left: 20px;">
            <li>Payment processed successfully</li>
            <li>Receipt generated automatically</li>
            <li>Account updated in real-time</li>
            <li>Service access maintained</li>
        </ul>
    </div>
</div>

<div class="btn-center">
    <a href="#" class="btn btn-success">📄 Download Receipt</a>
    <a href="#" class="btn">📊 View Account Summary</a>
</div>

<div class="text-center mt-20">
    <p style="color: #666; font-size: 14px;">
        Thank you for your continued trust in KiboAuto services!<br>
        For any payment-related questions, contact us at: 📧 billing@kiboauto.com
    </p>
</div>
@endsection