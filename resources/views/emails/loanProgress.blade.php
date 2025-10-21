@extends('emails.layouts.base')

@section('title', 'Loan Application Progress Update - KiboAuto Finance')

@section('promo-banner')
💰 Your loan application is being processed! Stay updated with the latest progress and next steps.
@endsection

@section('content')
<div class="text-center">
    <h2>📈 Loan Application Progress Update</h2>
    <p>Dear <strong>{{ $name }}</strong>,</p>
    <p>Thank you for choosing KiboAuto Finance for your automotive financing needs. We're pleased to provide you with an update on your loan application progress.</p>
</div>

<div class="info-box success">
    <h3 style="margin-top: 0; color: #155724;">📋 Application Status Update</h3>
    <div style="background: #ffffff; border: 2px solid #28a745; padding: 20px; border-radius: 8px; margin: 15px 0;">
        <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; border-left: 4px solid #28a745;">
            <p style="margin: 0; font-size: 16px; color: #155724; line-height: 1.6;">
                {{ $loan_progress }}
            </p>
        </div>
    </div>
    <p style="margin: 0; color: #155724; text-align: center;"><strong>🔄 Your application is actively being reviewed</strong></p>
</div>

<div class="info-box">
    <h4>📞 Contact Information</h4>
    <table class="table">
        <tr>
            <td style="font-weight: bold;">👤 Loan Officer:</td>
            <td>Available for assistance</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">📞 Contact Number:</td>
            <td style="color: #667eea; font-weight: bold;">{{ $officer_phone_number }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">📧 Email Support:</td>
            <td>finance@kiboauto.com</td>
        </tr>
    </table>
</div>

<div class="info-box warning">
    <h4>⏰ What Happens Next?</h4>
    <ul style="margin: 0; padding-left: 20px;">
        <li><strong>Document Review:</strong> Our team is carefully reviewing your submitted documents</li>
        <li><strong>Credit Assessment:</strong> Your creditworthiness is being evaluated</li>
        <li><strong>Vehicle Verification:</strong> The vehicle details are being confirmed</li>
        <li><strong>Final Decision:</strong> You'll receive a decision within 2-3 business days</li>
    </ul>
</div>

<div class="info-box">
    <h4>🎯 Why Choose KiboAuto Finance?</h4>
    <div style="background: rgba(102, 126, 234, 0.1); padding: 15px; border-radius: 8px; margin: 15px 0;">
        <ul style="margin: 0; padding-left: 20px;">
            <li>✅ Competitive interest rates</li>
            <li>🚗 Specialized automotive financing</li>
            <li>⚡ Quick approval process</li>
            <li>🛡️ Flexible repayment options</li>
            <li>📞 Dedicated customer support</li>
        </ul>
    </div>
</div>

<div class="btn-center">
    <a href="tel:{{ $officer_phone_number }}" class="btn btn-success">📞 Call Loan Officer</a>
    <a href="#" class="btn">📄 View Application</a>
</div>

<div class="info-box danger">
    <h4>⚠️ Important Reminders</h4>
    <ul style="margin: 0; padding-left: 20px;">
        <li>Keep your contact information updated</li>
        <li>Respond promptly to any requests for additional documentation</li>
        <li>Don't hesitate to contact us with any questions</li>
        <li>Check your email regularly for updates</li>
    </ul>
</div>

<div class="text-center mt-20">
    <p style="color: #666; font-size: 14px;">
        Thank you for trusting KiboAuto Finance with your automotive financing needs!<br>
        Our team is committed to providing you with the best possible service and support.
    </p>
</div>
@endsection