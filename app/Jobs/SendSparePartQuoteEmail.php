<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\SparePartQuote;
use App\Mail\SparePartQuoteNotification;

class SendSparePartQuoteEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $quote;

    /**
     * Create a new job instance.
     */
    public function __construct(SparePartQuote $quote)
    {
        $this->quote = $quote;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Send email to customer
            Mail::to($this->quote->sparePartRequest->customer_email)
                ->send(new SparePartQuoteNotification($this->quote));

            Log::info('Spare part quote email sent successfully', [
                'quote_id' => $this->quote->id,
                'customer_email' => $this->quote->sparePartRequest->customer_email,
                'shop_name' => $this->quote->shop->name
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send spare part quote email', [
                'quote_id' => $this->quote->id,
                'customer_email' => $this->quote->sparePartRequest->customer_email,
                'error' => $e->getMessage()
            ]);
        }
    }
}
