<?php

namespace App\Jobs;

use App\Models\Application;
use App\Models\Lender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyLenderNewApplication implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Lender $lender;
    protected Application $application;

    /**
     * Create a new job instance.
     */
    public function __construct(Lender $lender, Application $application)
    {
        $this->lender = $lender;
        $this->application = $application;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Example logic: Send email or internal notification
        // Here’s a placeholder email example:

       //  \Mail::to($this->lender->email)->send(new \App\Mail\NewApplicationNotification($this->application));
    }
}
