<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\SparePartRequest;
use App\Models\Shop;
use App\Mail\SparePartRequestNotification;
use Illuminate\Support\Facades\Log;

class SendSparePartRequestEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;
    protected $shops;

    /**
     * Create a new job instance.
     */
    public function __construct(SparePartRequest $request, $shops)
    {
        $this->request = $request;
        $this->shops = $shops;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->shops as $shop) {
            try {
                Mail::to($shop->email)->send(new SparePartRequestNotification($this->request, $shop));
                
                Log::info('Spare part request email sent successfully', [
                    'shop_email' => $shop->email,
                    'request_id' => $this->request->id
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to send spare part request email', [
                    'shop_email' => $shop->email,
                    'request_id' => $this->request->id,
                    'error' => $e->getMessage()
                ]);
            }
        }
    }
}
