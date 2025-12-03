<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Integration\Selcom\SelcomSMSController;
use Illuminate\Support\Facades\Log;

class SendSelcomSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public $backoff = 60;

    protected $phone;
    protected $message;
    protected $client_id;
    protected $report_id;

    /**
     * Create a new job instance for single SMS.
     *
     * @param string $phone Phone number
     * @param string $message Message content
     * @param int|null $client_id Optional client ID
     * @param int|null $report_id Optional report ID
     */
    public function __construct($phone, $message, $client_id = null, $report_id = null)
    {
        $this->phone = $phone;
        $this->message = $message;
        $this->client_id = $client_id;
        $this->report_id = $report_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Log::info('Processing SendSelcomSMS job', [
                'phone' => $this->phone,
                'client_id' => $this->client_id,
                'report_id' => $this->report_id
            ]);

            $result = SelcomSMSController::send(
                $this->phone,
                $this->message,
                $this->client_id,
                $this->report_id
            );

            if ($result['success']) {
                Log::info('Selcom SMS sent successfully via job', [
                    'phone' => $this->phone,
                    'client_id' => $this->client_id,
                    'report_id' => $this->report_id
                ]);
            } else {
                Log::error('Selcom SMS failed via job', [
                    'phone' => $this->phone,
                    'error' => $result['error'] ?? 'Unknown error',
                    'client_id' => $this->client_id,
                    'report_id' => $this->report_id
                ]);
                
                // Throw exception to trigger retry mechanism
                throw new \Exception($result['error'] ?? 'SMS sending failed');
            }
        } catch (\Exception $e) {
            Log::error('Exception in SendSelcomSMS job', [
                'phone' => $this->phone,
                'error' => $e->getMessage(),
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
        Log::error('SendSelcomSMS job failed after all retries', [
            'phone' => $this->phone,
            'error' => $exception->getMessage(),
            'client_id' => $this->client_id,
            'report_id' => $this->report_id,
            'attempts' => $this->attempts()
        ]);
    }
}

