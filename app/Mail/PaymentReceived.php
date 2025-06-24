<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Bill;

class PaymentReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $bill;
    public $paymentAmount;

    public function __construct(Bill $bill, $paymentAmount)
    {
        $this->bill = $bill;
        $this->paymentAmount = $paymentAmount;
    }

    public function build()
    {
        return $this->subject('Payment Received - ' . $this->bill->bill_number)
                    ->view('emails.payment-received')
                    ->with([
                        'bill' => $this->bill,
                        'paymentAmount' => $this->paymentAmount,
                        'entity' => $this->bill->entity,
                        'entityType' => ucfirst(str_replace('_', ' ', $this->bill->entity_type))
                    ]);
    }
}