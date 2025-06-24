{{-- resources/views/emails/payment-received.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Received</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header { text-align: center; border-bottom: 2px solid #28a745; padding-bottom: 20px; margin-bottom: 30px; }
        .logo { font-size: 24px; font-weight: bold; color: #28a745; margin-bottom: 10px; }
        .success-badge { background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; text-align: center; margin: 20px 0; border: 1px solid #c3e6cb; }
        .payment-info { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .amount { font-size: 28px; font-weight: bold; color: #28a745; text-align: center; margin: 20px 0; }
        .details-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .details-table th, .details-table td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        .details-table th { background-color: #28a745; color: white; }
        .footer { text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; color: #666; }
        .btn { display: inline-block; padding: 12px 24px; background: #28a745; color: white; text-decoration: none; border-radius: 5px; margin: 10px 0; }
        .btn:hover { background: #1e7e34; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Kibo Finance</div>
            <h2>Payment Received Confirmation</h2>
        </div>

        <div class="success-badge">
            <h3 style="margin: 0;">✅ Payment Successfully Received!</h3>
            <p style="margin: 5px 0 0 0;">Thank you for your payment</p>
        </div>

        <div class="content">
            <p>Dear {{ $entity->name }},</p>
            
            <p>We are pleased to confirm that we have received your payment for bill {{ $bill->bill_number }}. Thank you for your prompt payment.</p>

            <div class="amount">
                Payment Received: {{ number_format($paymentAmount, 0) }} TZS
            </div>

            <div class="payment-info">
                <h3>Payment Details</h3>
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
                        <th>Payment Amount</th>
                        <td><strong>{{ number_format($paymentAmount, 0) }} TZS</strong></td>
                    </tr>
                    <tr>
                        <th>Payment Date</th>
                        <td>{{ now()->format('F d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Bill Total</th>
                        <td>{{ number_format($bill->total_amount, 0) }} TZS</td>
                    </tr>
                    <tr>
                        <th>Remaining Balance</th>
                        <td>{{ number_format($bill->remaining_balance, 0) }} TZS</td>
                    </tr>
                </table>
            </div>

            @if($bill->remaining_balance > 0)
                <div style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 8px; margin: 20px 0;">
                    <h4 style="margin-top: 0; color: #856404;">Outstanding Balance</h4>
                    <p style="margin-bottom: 0;">You still have an outstanding balance of <strong>{{ number_format($bill->remaining_balance, 0) }} TZS</strong> on this bill. Please arrange for the remaining payment at your earliest convenience.</p>
                </div>
            @else
                <div style="background: #d4edda; border: 1px solid #c3e6cb; padding: 15px; border-radius: 8px; margin: 20px 0;">
                    <h4 style="margin-top: 0; color: #155724;">✅ Bill Fully Paid</h4>
                    <p style="margin-bottom: 0;">Congratulations! This bill has been paid in full. Thank you for your complete payment.</p>
                </div>
            @endif

          

            <p>This payment confirmation serves as your receipt. Please keep this email for your records.</p>

            <p>We appreciate your partnership and timely payments. If you have any questions about this payment or your account, please don't hesitate to contact our billing department.</p>

            <p>Best regards,<br>
            The Kibo Finance Billing Team</p>
        </div>

        <div class="footer">
            <p>This is an automated confirmation email. Please do not reply directly to this message.</p>
            <p>For billing inquiries, please contact us at billing@kibofinance.com</p>
            <p>&copy; {{ date('Y') }} Kibo Finance. All rights reserved.</p>
        </div>
    </div>
</body>
</html>