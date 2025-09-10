<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\SparePartQuote;
use App\Models\SparePartRequest;

class SparePartQuoteNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $quote;
    public $request;
    public $shop;

    /**
     * Create a new message instance.
     */
    public function __construct(SparePartQuote $quote)
    {
        $this->quote = $quote;
        $this->request = $quote->sparePartRequest;
        $this->shop = $quote->shop;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Quote for Your Spare Part Request - ' . $this->request->part_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.spare-part-quote',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
