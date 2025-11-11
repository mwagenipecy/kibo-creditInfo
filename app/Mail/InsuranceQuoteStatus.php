<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\InsuranceQuoteRequest;

class InsuranceQuoteStatus extends Mailable
{
    use Queueable, SerializesModels;

    public string $customerName;
    public string $status;
    public InsuranceQuoteRequest $requestModel;

    public function __construct(string $customerName, string $status, InsuranceQuoteRequest $requestModel)
    {
        $this->customerName = $customerName;
        $this->status = $status;
        $this->requestModel = $requestModel;
    }

    public function build()
    {
        $subject = 'KiboAuto - Insurance Quote Status: ' . ucfirst(str_replace('_', ' ', $this->status));
        return $this->view('emails.insurance-quote-status')
            ->with([
                'name' => $this->customerName,
                'status' => $this->status,
                'req' => $this->requestModel,
                'logo' => asset('images/kiboauto.png'),
            ])
            ->subject($subject);
    }
}


