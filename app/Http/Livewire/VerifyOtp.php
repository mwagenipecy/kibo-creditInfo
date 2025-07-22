<?php

namespace App\Http\Livewire;

use App\Http\Traits\MailSender;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Mail\OTP;
use Carbon\Carbon;

class VerifyOtp extends Component
{
    use MailSender;

    protected $listeners = ['submitOTP'];

    public bool $error = false;
    public string $errorMessage = '';
    public $remainingSeconds = 120;
    public bool $isResending = false;
    public int $maxAttempts = 5;
    public int $attemptCount = 0;

    protected $rules = [
        'otp' => 'required|numeric|digits:6'
    ];

    public function boot(): void
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            redirect()->route('login')->send();
        }

        // Initialize attempt counter
        $this->attemptCount = Cache::get($this->getAttemptKey(), 0);
        
        // Check if user is locked out
        if ($this->attemptCount >= $this->maxAttempts) {
            $this->handleLockout();
            return;
        }

        $this->error = false;
        $this->errorMessage = '';
    }

    public function mount(): void
    {
        $user = Auth::user();
        $user->email_verified_at = Carbon::now();
        $user->save();

        if (!$user) {
            redirect()->route('login')->send();
        }



        // Generate new OTP if none exists or expired
        $this->generateAndSendOTP($user);
    }

    private function generateAndSendOTP(User $user): void
    {
        try {
            // Generate secure 6-digit OTP
            $otp = random_int(100000, 999999);
            
            // Store OTP with expiration (5 minutes)
            Cache::put($this->getOTPKey($user->id), [
                'otp' => $otp,
                'created_at' => now(),
                'expires_at' => now()->addMinutes(5)
            ], now()->addMinutes(5));

            // Update user verification status
            $user->update([
                'email_verified_at' => null,
                'otp' => $otp // Keep for backward compatibility if needed
            ]);

            // Send OTP email
            $this->sendOTPEmail($user, $otp);
            
        } catch (\Exception $e) {
            Log::error('Failed to generate/send OTP', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            
            $this->error = true;
            $this->errorMessage = 'Failed to send OTP. Please try again.';
        }
    }

    private function sendOTPEmail(User $user, int $otp): void
    {
        $link = url('/');
        Mail::to($user->email)->send(new OTP($link, $user->name, $otp));
    }

    public function resendOTP(): void
    {
        // Prevent spam resending
        $resendKey = "resend_otp_{$this->getUserId()}";
        
        if (Cache::has($resendKey)) {
            $this->error = true;
            $this->errorMessage = 'Please wait before requesting another OTP.';
            return;
        }

        // Set cooldown period (30 seconds)
        Cache::put($resendKey, true, now()->addSeconds(30));
        
        $this->isResending = true;
        $user = Auth::user();
        
        if ($user) {
            $this->generateAndSendOTP($user);
            $this->remainingSeconds = 120; // Reset timer
        }
        
        $this->isResending = false;
    }

    public function onCountdownFinished(): void
    {
        $this->handleTimeout();
    }

    private function handleTimeout()
    {
        // Clear OTP cache
        Cache::forget($this->getOTPKey($this->getUserId()));
        
        Auth::guard('web')->logout();
        Session::flush();
        
        return redirect()->route('login')->with('message', 'Session expired. Please login again.');
    }

    public function logout()
    {
        // Clean up cache entries
        Cache::forget($this->getOTPKey($this->getUserId()));
        Cache::forget($this->getAttemptKey());
        
        Auth::guard('web')->logout();
        Session::flush();
        
        return redirect()->route('login');
    }

    public function submitOTP($value): ?\Illuminate\Http\RedirectResponse
    {
        $userId = $this->getUserId();
        
        // Check lockout status
        if ($this->attemptCount >= $this->maxAttempts) {
            $this->handleLockout();
            return null;
        }

        // Validate input
        if (!is_numeric($value) || strlen($value) !== 6) {
            $this->handleInvalidOTP();
            return null;
        }

        // Get stored OTP data
        $otpData = Cache::get($this->getOTPKey($userId));
        
        if (!$otpData) {
            $this->error = true;
            $this->errorMessage = 'OTP expired. Please request a new one.';
            return null;
        }

        // Check if OTP is expired
        if (Carbon::parse($otpData['expires_at'])->isPast()) {
            Cache::forget($this->getOTPKey($userId));
            $this->error = true;
            $this->errorMessage = 'OTP expired. Please request a new one.';
            return null;
        }

        // Verify OTP
        if ((int)$otpData['otp'] === (int)$value) {
            return $this->handleValidOTP($userId);
        } else {
            $this->handleInvalidOTP();
            return null;
        }
    }

    private function handleValidOTP(int $userId): \Illuminate\Http\RedirectResponse
    {
        try {
            DB::beginTransaction();
            
            // Update user verification
            DB::table('users')
                ->where('id', $userId)
                ->update([
                    'verification_status' => 1,
                    'email_verified_at' => Carbon::now(),
                    'otp' => null // Clear OTP from database
                ]);
            
            // Clean up cache
            Cache::forget($this->getOTPKey($userId));
            Cache::forget($this->getAttemptKey());
            
            DB::commit();
            
            Log::info('User successfully verified OTP', ['user_id' => $userId]);
            
            return redirect('System');
            
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update user verification status', [
                'user_id' => $userId,
                'error' => $e->getMessage()
            ]);
            
            $this->error = true;
            $this->errorMessage = 'Verification failed. Please try again.';
            return null;
        }
    }

    private function handleInvalidOTP(): void
    {
        $this->attemptCount++;
        Cache::put($this->getAttemptKey(), $this->attemptCount, now()->addMinutes(15));
        
        $remainingAttempts = $this->maxAttempts - $this->attemptCount;
        
        $this->error = true;
        $this->errorMessage = $remainingAttempts > 0 
            ? "Invalid OTP. You have {$remainingAttempts} attempts remaining."
            : "Too many invalid attempts. Please try again later.";
        
        if ($remainingAttempts <= 0) {
            $this->handleLockout();
        }
    }

    private function handleLockout(): void
    {
        // Lock user for 15 minutes
        Cache::put($this->getLockoutKey(), true, now()->addMinutes(15));
        
        Log::warning('User locked out due to too many OTP attempts', [
            'user_id' => $this->getUserId()
        ]);
        
        $this->error = true;
        $this->errorMessage = 'Too many failed attempts. Account locked for 15 minutes.';
    }

    private function getUserId(): int
    {
        return Auth::id();
    }

    private function getOTPKey(int $userId): string
    {
        return "otp_verification_{$userId}";
    }

    private function getAttemptKey(): string
    {
        return "otp_attempts_{$this->getUserId()}";
    }

    private function getLockoutKey(): string
    {
        return "otp_lockout_{$this->getUserId()}";
    }

    public function render()
    {
        return view('livewire.verify-otp', [
            'isLockedOut' => Cache::has($this->getLockoutKey()),
            'attemptsRemaining' => max(0, $this->maxAttempts - $this->attemptCount)
        ]);
    }
}