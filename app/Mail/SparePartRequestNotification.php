<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\SparePartRequest;
use App\Models\Shop;

class SparePartRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $request;
    public $shop;
    public $quoteUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(SparePartRequest $request, Shop $shop)
    {
        $this->request = $request;
        $this->shop = $shop;
        $this->quoteUrl = route('shop.spare-part-quote', ['requestId' => $request->id, 'shopId' => $shop->id]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Spare Part Request - ' . $this->request->part_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.spare-part-request',
            with: [
                'request' => $this->request,
                'shop' => $this->shop,
                'quoteUrl' => $this->quoteUrl,
            ],
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
