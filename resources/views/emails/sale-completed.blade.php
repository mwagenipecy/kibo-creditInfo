<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Completed</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
        <!-- Header -->
        <div style="background-color: #059669; padding: 30px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 24px;">Vehicle Sale Completed</h1>
        </div>
        
        <!-- Content -->
        <div style="padding: 40px 30px;">
            <p style="font-size: 16px; line-height: 1.6; color: #333333; margin-bottom: 20px;">
                A vehicle sale has been completed on the Kibo platform.
            </p>
            
            <div style="background-color: #f9fafb; border-left: 4px solid #059669; padding: 20px; margin: 20px 0;">
                <h2 style="color: #059669; margin-top: 0; font-size: 18px;">Sale Details</h2>
                
                <p style="margin: 10px 0;"><strong>Vehicle:</strong> {{ $vehicle->year }} {{ $vehicle->make->name ?? 'N/A' }} {{ $vehicle->model->name ?? 'N/A' }}</p>
                <p style="margin: 10px 0;"><strong>VIN:</strong> {{ $vehicle->vin }}</p>
                <p style="margin: 10px 0;"><strong>Listed Price:</strong> TSh {{ number_format($vehicle->price) }}</p>
                <p style="margin: 10px 0;"><strong>Final Sale Price:</strong> TSh {{ number_format($offeredPrice) }}</p>
                
                <h3 style="color: #333; font-size: 16px; margin-top: 20px;">Buyer Information</h3>
                <p style="margin: 5px 0;"><strong>Name:</strong> {{ $buyer->name }}</p>
                <p style="margin: 5px 0;"><strong>Email:</strong> {{ $buyer->email }}</p>
                @if($buyer->phone)
                <p style="margin: 5px 0;"><strong>Phone:</strong> {{ $buyer->phone }}</p>
                @endif
                
                <h3 style="color: #333; font-size: 16px; margin-top: 20px;">Seller Information</h3>
                <p style="margin: 5px 0;"><strong>Name:</strong> {{ $seller->name }}</p>
                <p style="margin: 5px 0;"><strong>Email:</strong> {{ $seller->email }}</p>
            </div>
            
            <p style="font-size: 14px; line-height: 1.6; color: #666666;">
                The vehicle has been marked as <strong>"On Hold"</strong> in the system pending final completion of the sale.
            </p>
        </div>
        
        <!-- Footer -->
        <div style="background-color: #f9fafb; padding: 20px; text-align: center; border-top: 1px solid #e5e7eb;">
            <p style="font-size: 12px; color: #666666; margin: 0;">
                © {{ date('Y') }} Kibo Platform. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
