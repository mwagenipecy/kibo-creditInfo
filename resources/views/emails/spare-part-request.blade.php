<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Spare Part Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #10B981;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 0 0 8px 8px;
        }
        .request-details {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 4px solid #10B981;
        }
        .vehicle-info {
            background: #e8f5e8;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .customer-info {
            background: #f0f8ff;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .cta-button {
            display: inline-block;
            background: #10B981;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 15px 0;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 12px;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🚗 New Spare Part Request</h1>
        <p>A customer is looking for a spare part that you might have!</p>
    </div>

    <div class="content">
        <h2>Request Details</h2>
        
        <div class="request-details">
            <div class="label">Part Name:</div>
            <div>{{ $request->part_name }}</div>
            
            @if($request->part_number)
                <div class="label">Part Number:</div>
                <div>{{ $request->part_number }}</div>
            @endif
            
            @if($request->part_size)
                <div class="label">Part Size:</div>
                <div>{{ $request->part_size }}</div>
            @endif
            
            <div class="label">Part Condition:</div>
            <div>
                @if($request->part_condition == 'all')
                    All (New & Used)
                @elseif($request->part_condition == 'new')
                    New Only
                @elseif($request->part_condition == 'used')
                    Used Only
                @else
                    Not specified
                @endif
            </div>
            
            @if($request->additional_notes)
                <div class="label">Additional Notes:</div>
                <div>{{ $request->additional_notes }}</div>
            @endif
        </div>

        <div class="vehicle-info">
            <div class="label">Vehicle Information:</div>
            <div>{{ $request->year }} {{ $request->make->name }} {{ $request->model->name }}</div>
        </div>

        <div class="customer-info">
            <div class="label">Customer Information:</div>
            <div>Name: {{ $request->customer_name }}</div>
            <div>Email: {{ $request->customer_email }}</div>
            
            @if($request->additional_notes)
                <div class="label">Additional Notes:</div>
                <div>{{ $request->additional_notes }}</div>
            @endif
        </div>

        <p><strong>This request expires on:</strong> {{ $request->formatted_expires_at }}</p>

        <div style="text-align: center;">
            <a href="{{ $quoteUrl }}" class="cta-button">
                📋 Submit Quote
            </a>
        </div>

        <p style="margin-top: 20px;">
            <strong>Instructions:</strong><br>
            1. Click the "Submit Quote" button above<br>
            2. Enter your price and availability details<br>
            3. Add any additional notes for the customer<br>
            4. Submit your quote
        </p>

        <p style="background: #fff3cd; padding: 10px; border-radius: 5px; border-left: 4px solid #ffc107;">
            <strong>💡 Tip:</strong> Quick response increases your chances of winning the customer's business!
        </p>
    </div>

    <div class="footer">
        <p>This email was sent from {{ config('app.name') }}</p>
        <p>If you have any questions, please contact our support team.</p>
    </div>
</body>
</html>
