<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Integration\Selcom\SelcomSMSController;
use Illuminate\Support\Facades\Log;

class SendSelcomBatchSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 2;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public $backoff = 120;

    protected $message;
    protected $recipients;
    protected $campaign_id;

    /**
     * Create a new job instance for batch SMS.
     *
     * @param string $message Message content
     * @param array $recipients Array of phone numbers or array of ['phone' => '...', 'client_id' => ...]
     * @param int|null $campaign_id Optional campaign ID
     */
    public function __construct($message, $recipients, $campaign_id = null)
    {
        $this->message = $message;
        $this->recipients = $recipients;
        $this->campaign_id = $campaign_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Log::info('Processing SendSelcomBatchSMS job', [
                'recipient_count' => count($this->recipients),
                'campaign_id' => $this->campaign_id
            ]);

            $result = SelcomSMSController::sendToMany(
                $this->message,
                $this->recipients,
                $this->campaign_id
            );

            Log::info('Selcom batch SMS job completed', [
                'summary' => $result['summary'] ?? [],
                'campaign_id' => $this->campaign_id,
                'success' => $result['success'] ?? false
            ]);

            // If no messages were sent at all, throw exception for retry
            if (!($result['success'] ?? false) && ($result['summary']['total_sent'] ?? 0) === 0) {
                throw new \Exception('Batch SMS failed: No messages were sent');
            }
        } catch (\Exception $e) {
            Log::error('Exception in SendSelcomBatchSMS job', [
                'recipient_count' => count($this->recipients),
                'error' => $e->getMessage(),
                'campaign_id' => $this->campaign_id,
                'trace' => $e->getTraceAsString()
            ]);
            
            // Re-throw to trigger retry
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     *
     * @param \Throwable $exception
     * @return void
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('SendSelcomBatchSMS job failed after all retries', [
            'recipient_count' => count($this->recipients),
            'error' => $exception->getMessage(),
            'campaign_id' => $this->campaign_id,
            'attempts' => $this->attempts()
        ]);
    }
}

