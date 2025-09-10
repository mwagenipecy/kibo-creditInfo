<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTP;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class TestOTP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:otp {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test OTP functionality by sending OTP to specified email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        // Find user by email
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User with email {$email} not found.");
            return 1;
        }
        
        $this->info("Found user: {$user->name} ({$user->email})");
        
        // Generate OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiry = Carbon::now()->addMinutes(10);
        
        // Store in session
        Session::put('otp_code', $otp);
        Session::put('otp_expiry', $expiry);
        
        $this->info("Generated OTP: {$otp}");
        $this->info("OTP expires at: {$expiry}");
        
        // Send email
        try {
            $link = route('otp-page');
            Mail::to($user->email)->send(new OTP($link, $user->name, $otp));
            $this->info("OTP email sent successfully to {$user->email}");
        } catch (\Exception $e) {
            $this->error("Failed to send email: " . $e->getMessage());
            return 1;
        }
        
        $this->info("OTP test completed successfully!");
        return 0;
    }
}