<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Quote for Your Spare Part Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
        }
        .header h1 {
            color: #28a745;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #6c757d;
            margin: 10px 0 0 0;
        }
        .quote-details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #28a745;
        }
        .price {
            font-size: 24px;
            font-weight: bold;
            color: #28a745;
            margin: 10px 0;
        }
        .shop-info {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .request-details {
            background-color: #fff3cd;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #ffc107;
        }
        .cta-button {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
        }
        .cta-button:hover {
            background-color: #218838;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            color: #6c757d;
            font-size: 14px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
        }
        .info-label {
            font-weight: bold;
            color: #495057;
        }
        .info-value {
            color: #6c757d;
        }
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            .container {
                padding: 20px;
            }
            .info-row {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚗 New Quote Received!</h1>
            <p>Great news! A shop has submitted a quote for your spare part request.</p>
        </div>

        <div class="request-details">
            <h3>📋 Your Request Details</h3>
            <div class="info-row">
                <span class="info-label">Part Name:</span>
                <span class="info-value">{{ $request->part_name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Vehicle:</span>
                <span class="info-value">{{ $request->year }} {{ $request->make->name }} {{ $request->model->name }}</span>
            </div>
            @if($request->part_number)
            <div class="info-row">
                <span class="info-label">Part Number:</span>
                <span class="info-value">{{ $request->part_number }}</span>
            </div>
            @endif
            @if($request->part_condition)
            <div class="info-row">
                <span class="info-label">Condition:</span>
                <span class="info-value">{{ ucfirst($request->part_condition) }}</span>
            </div>
            @endif
        </div>

        <div class="quote-details">
            <h3>💰 Quote Details</h3>
            <div class="price">{{ number_format($quote->price, 2) }} {{ $quote->currency }}</div>
            
            @if($quote->delivery_time)
            <div class="info-row">
                <span class="info-label">🚚 Delivery Time:</span>
                <span class="info-value">{{ $quote->delivery_time }}</span>
            </div>
            @endif
            
            @if($quote->warranty_info)
            <div class="info-row">
                <span class="info-label">🛡️ Warranty:</span>
                <span class="info-value">{{ $quote->warranty_info }}</span>
            </div>
            @endif
            
            @if($quote->additional_notes)
            <div class="info-row">
                <span class="info-label">📝 Additional Notes:</span>
                <span class="info-value">{{ $quote->additional_notes }}</span>
            </div>
            @endif
        </div>

        <div class="shop-info">
            <h3>🏪 Shop Information</h3>
            <div class="info-row">
                <span class="info-label">Shop Name:</span>
                <span class="info-value">{{ $shop->name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Location:</span>
                <span class="info-value">{{ $shop->address }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Contact:</span>
                <span class="info-value">{{ $shop->email }}</span>
            </div>
            @if($shop->phone)
            <div class="info-row">
                <span class="info-label">Phone:</span>
                <span class="info-value">{{ $shop->phone }}</span>
            </div>
            @endif
        </div>

        @if($quote->payment_link)
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $quote->payment_link }}" class="cta-button">
                💳 Pay Now & Complete Order
            </a>
            <p style="font-size: 14px; color: #6c757d; margin-top: 10px;">
                Click the button above to proceed with payment and complete your order.
            </p>
        </div>
        @else
        <div style="text-align: center; margin: 30px 0;">
            <p style="color: #6c757d;">
                <strong>Next Steps:</strong> Contact the shop directly to arrange payment and delivery.
            </p>
            <p style="font-size: 14px; color: #6c757d; margin-top: 10px;">
                You can reach them at: <strong>{{ $shop->email }}</strong>
            </p>
        </div>
        @endif

        <div class="footer">
            <p><strong>Quote Expires:</strong> {{ $quote->expires_at ? $quote->expires_at->format('M d, Y H:i') : 'No expiration' }}</p>
            <p>This quote is valid for 7 days from the date of submission.</p>
            <p style="margin-top: 20px;">
                Thank you for using our spare parts marketplace!<br>
                If you have any questions, please don't hesitate to contact us.
            </p>
        </div>
    </div>
</body>
</html>
