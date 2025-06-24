<?php

// app/Mail/BillGenerated.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Bill;

class BillGenerated extends Mailable
{
    use Queueable, SerializesModels;

    public $bill;
    public $entity;

    public function __construct(Bill $bill, $entity)
    {
        $this->bill = $bill;
        $this->entity = $entity;
    }

    public function build()
    {
        return $this->subject('New Bill Generated - ' . $this->bill->bill_number)
                    ->view('emails.bill-generated')
                    ->with([
                        'bill' => $this->bill,
                        'entity' => $this->entity,
                        'entityType' => ucfirst(str_replace('_', ' ', $this->bill->entity_type))
                    ]);
    }
}