{{-- resources/views/emails/bill-generated.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Bill Generated</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header { text-align: center; border-bottom: 2px solidrgba(0, 255, 30, 0.64); padding-bottom: 20px; margin-bottom: 30px; }
        .logo { font-size: 24px; font-weight: bold; color:rgba(26, 255, 0, 0.63); margin-bottom: 10px; }
        .bill-info { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .amount { font-size: 28px; font-weight: bold; color: #28a745; text-align: center; margin: 20px 0; }
        .details-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .details-table th, .details-table td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        .details-table th { background-color:rgb(30, 119, 3); color: white; }
        .footer { text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; color: #666; }
        .btn { display: inline-block; padding: 12px 24px; background:rgba(5, 200, 76, 0.6); color: white; text-decoration: none; border-radius: 5px; margin: 10px 0; }
        .btn:hover { background:rgba(21, 179, 0, 0.81); }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Kibo Finance</div>
            <h2>New Bill Generated</h2>
        </div>

        <div class="content">
            <p>Dear {{ $entity->name }},</p>
            
            <p>We hope this email finds you well. A new bill has been generated for your account for the billing period {{ $bill->billing_period_start->format('F d, Y') }} to {{ $bill->billing_period_end->format('F d, Y') }}.</p>

            <div class="bill-info">
                <h3>Bill Summary</h3>
                <table class="details-table">
                    <tr>
                        <th>Bill Number</th>
                        <td>{{ $bill->bill_number }}</td>
                    </tr>
                    <tr>
                        <th>{{ $entityType }}</th>
                        <td>{{ $entity->name }}</td>
                    </tr>
                    <tr>
                        <th>Billing Period</th>
                        <td>{{ $bill->billing_period_start->format('F d, Y') }} - {{ $bill->billing_period_end->format('F d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Issue Date</th>
                        <td>{{ $bill->issued_date->format('F d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Due Date</th>
                        <td>{{ $bill->due_date->format('F d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Applications Processed</th>
                        <td>{{ $bill->billItems->count() }} applications</td>
                    </tr>
                </table>
            </div>

            <div class="amount">
                Total Amount: {{ number_format($bill->total_amount, 0) }} TZS
            </div>

            <div style="background: #e3f2fd; padding: 20px; border-radius: 8px; margin: 20px 0;">
                <h4 style="margin-top: 0; color: #1565c0;">Amount Breakdown:</h4>
                <table style="width: 100%;">
                    <tr>
                        <td>Subtotal:</td>
                        <td style="text-align: right; font-weight: bold;">{{ number_format($bill->subtotal, 0) }} TZS</td>
                    </tr>
                    <tr>
                        <td>VAT (18%):</td>
                        <td style="text-align: right; font-weight: bold;">{{ number_format($bill->tax_amount, 0) }} TZS</td>
                    </tr>
                    <tr style="border-top: 2px solid #1565c0;">
                        <td><strong>Total Amount:</strong></td>
                        <td style="text-align: right; font-weight: bold; color: #1565c0;">{{ number_format($bill->total_amount, 0) }} TZS</td>
                    </tr>
                </table>
            </div>

            <p><strong>Payment Instructions:</strong></p>
            <ul>
                <li>Payment is due by <strong>{{ $bill->due_date->format('F d, Y') }}</strong></li>
                <li>Please reference bill number <strong>{{ $bill->bill_number }}</strong> when making payment</li>
                <li>For payment inquiries, please contact our billing department</li>
            </ul>

           

            <p>Thank you for your continued partnership with Kibo Finance. We appreciate your business and look forward to serving you.</p>

            <p>Best regards,<br>
            The Kibo Finance Billing Team</p>
        </div>

        <div class="footer">
            <p>This is an automated email. Please do not reply directly to this message.</p>
            <p>If you have any questions about this bill, please contact us at billing@kibofinance.com</p>
            <p>&copy; {{ date('Y') }} Kibo Finance. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

