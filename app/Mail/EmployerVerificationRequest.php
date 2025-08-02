<?php

namespace App\Mail;

use App\Models\Application;
use App\Models\EmployerVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployerVerificationRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    public $verification;

    public $messageContent;

    public $verificationUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Application $application, EmployerVerification $verification, string $messageContent)
    {
        $this->application = $application;
        $this->verification = $verification;
        $this->messageContent = $messageContent;
        $this->verificationUrl = route('employer.verification', ['token' => $verification->token]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Employee Verification Request - '.config('app.name'))
            ->markdown('emails.employer-verification-request');
    }
}
