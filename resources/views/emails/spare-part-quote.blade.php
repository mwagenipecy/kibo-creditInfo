@extends('emails.layouts.base')

@section('title', 'New Quote Received - KiboAuto Marketplace')

@section('promo-banner')
🔧 Great News! A trusted shop has submitted a competitive quote for your spare part request.
@endsection

@section('content')
<div class="text-center">
    <h2>🚗 New Quote Received!</h2>
    <p>Excellent news! A verified shop in our marketplace has submitted a quote for your spare part request. Review the details below and take action.</p>
</div>

<div class="info-box warning">
    <h3 style="margin-top: 0; color: #856404;">📋 Your Request Details</h3>
    <table class="table">
        <tr>
            <td style="font-weight: bold;">🔧 Part Name:</td>
            <td><strong>{{ $request->part_name }}</strong></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">🚙 Vehicle:</td>
            <td>{{ $request->year }} {{ $request->make->name }} {{ $request->model->name }}</td>
        </tr>
        @if($request->part_number)
        <tr>
            <td style="font-weight: bold;">🔢 Part Number:</td>
            <td>{{ $request->part_number }}</td>
        </tr>
        @endif
        @if($request->part_condition)
        <tr>
            <td style="font-weight: bold;">⚡ Condition:</td>
            <td>{{ ucfirst($request->part_condition) }}</td>
        </tr>
        @endif
    </table>
</div>

<div class="info-box success">
    <h3 style="margin-top: 0; color: #155724;">💰 Quote Details</h3>
    <div style="background: #ffffff; border: 3px solid #28a745; padding: 25px; border-radius: 15px; margin: 20px 0; text-align: center;">
        <div style="font-size: 36px; font-weight: bold; color: #28a745; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            {{ number_format($quote->price, 2) }} {{ $quote->currency }}
        </div>
        <p style="margin: 10px 0 0 0; color: #155724; font-size: 16px;"><strong>Competitive Market Price</strong></p>
    </div>
    
    @if($quote->delivery_time)
    <table class="table" style="margin: 20px 0 0 0;">
        <tr>
            <td style="font-weight: bold;">🚚 Delivery Time:</td>
            <td>{{ $quote->delivery_time }}</td>
        </tr>
        @if($quote->warranty_info)
        <tr>
            <td style="font-weight: bold;">🛡️ Warranty:</td>
            <td>{{ $quote->warranty_info }}</td>
        </tr>
        @endif
        @if($quote->additional_notes)
        <tr>
            <td style="font-weight: bold;">📝 Additional Notes:</td>
            <td>{{ $quote->additional_notes }}</td>
        </tr>
        @endif
    </table>
    @endif
</div>

<div class="info-box">
    <h3 style="margin-top: 0;">🏪 Shop Information</h3>
    <table class="table">
        <tr>
            <td style="font-weight: bold;">🏢 Shop Name:</td>
            <td><strong>{{ $shop->name }}</strong></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">📍 Location:</td>
            <td>{{ $shop->address }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">📧 Contact:</td>
            <td>{{ $shop->email }}</td>
        </tr>
        @if($shop->phone)
        <tr>
            <td style="font-weight: bold;">📞 Phone:</td>
            <td>{{ $shop->phone }}</td>
        </tr>
        @endif
    </table>
    
    <div style="background: rgba(102, 126, 234, 0.1); padding: 15px; border-radius: 8px; margin: 15px 0;">
        <h5 style="margin: 0 0 10px 0; color: #667eea;">⭐ Shop Rating & Verification</h5>
        <ul style="margin: 0; padding-left: 20px;">
            <li>✅ Verified and trusted shop</li>
            <li>⭐ High customer satisfaction rating</li>
            <li>🛡️ Quality guarantee on all parts</li>
            <li>🚚 Reliable delivery service</li>
        </ul>
    </div>
</div>

@if($quote->payment_link)
    <div class="btn-center">
        <a href="{{ $quote->payment_link }}" class="btn btn-success">💳 Pay Now & Complete Order</a>
        <a href="#" class="btn">📞 Contact Shop Directly</a>
    </div>
    
    <div class="info-box">
        <h4>💳 Secure Payment Process</h4>
        <ul style="margin: 0; padding-left: 20px;">
            <li>🔒 Secure payment processing</li>
            <li>📧 Instant order confirmation</li>
            <li>📦 Tracking information provided</li>
            <li>🛡️ Buyer protection guaranteed</li>
        </ul>
    </div>
@else
    <div class="btn-center">
        <a href="#" class="btn btn-success">📞 Contact Shop Directly</a>
        <a href="#" class="btn">💬 Send Message</a>
    </div>
    
    <div class="info-box warning">
        <h4>📞 Next Steps</h4>
        <p>Contact the shop directly to arrange payment and delivery:</p>
        <ul style="margin: 0; padding-left: 20px;">
            <li><strong>Email:</strong> {{ $shop->email }}</li>
            @if($shop->phone)
            <li><strong>Phone:</strong> {{ $shop->phone }}</li>
            @endif
            <li>Discuss payment terms and delivery options</li>
            <li>Confirm availability and timeline</li>
        </ul>
    </div>
@endif

<div class="info-box">
    <h4>⏰ Important Timing Information</h4>
    <p><strong>Quote Expires:</strong> {{ $quote->expires_at ? $quote->expires_at->format('M d, Y H:i') : 'No expiration' }}</p>
    <p>This quote is valid for 7 days from the date of submission. Act quickly to secure this competitive price!</p>
    
    <div style="background: #fff3cd; padding: 15px; border-radius: 8px; margin: 15px 0; border-left: 4px solid #ffc107;">
        <h5 style="margin: 0 0 10px 0; color: #856404;">💡 Pro Tip</h5>
        <p style="margin: 0; color: #856404;">Shop around but don't wait too long - quality parts at competitive prices sell quickly!</p>
    </div>
</div>

<div class="text-center mt-20">
    <p style="color: #666; font-size: 14px;">
        Thank you for using KiboAuto Marketplace!<br>
        Need help? Contact our support team: 📧 support@kiboauto.com
    </p>
</div>
@endsection