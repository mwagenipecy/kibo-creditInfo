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
use App\Http\Integration\Selcom\SelcomSMSController;

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
        if (!Auth::check()) {
            redirect()->route('login')->send();
        }

        $this->attemptCount = Cache::get($this->getAttemptKey(), 0);

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

        if (!$user) {
            redirect()->route('login')->send();
        }

        $user->email_verified_at = Carbon::now();
        $user->save();

        $this->generateAndSendOTP($user);
    }

    private function generateAndSendOTP(User $user): void
    {
        try {
            $otp = random_int(100000, 999999);

            Cache::put($this->getOTPKey($user->id), [
                'otp' => $otp,
                'created_at' => now(),
                'expires_at' => now()->addMinutes(5)
            ], now()->addMinutes(5));

            $user->update([
                'email_verified_at' => null,
                'otp' => $otp
            ]);

            // Send email - wrap in try-catch to ensure SMS can still be sent if email fails
            try {
                $this->sendOTPEmail($user, $otp);
            } catch (\Exception $e) {
                Log::error('Failed to send OTP email (non-critical for SMS)', [
                    'user_id' => $user->id,
                    'error' => $e->getMessage()
                ]);
            }

            // Send SMS - wrap in try-catch to ensure process continues even if SMS fails
            try {
                $this->sendOTPSMS($user, $otp);
            } catch (\Exception $e) {
                Log::warning('Failed to send OTP SMS (non-critical)', [
                    'user_id' => $user->id,
                    'error' => $e->getMessage()
                ]);
                // Don't throw - SMS failure should not stop the OTP process
            }

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

    private function sendOTPSMS(User $user, int $otp): void
    {
        $userPhone = $user->phone_number ?? $user->phone ?? null;
        
        if (!$userPhone) {
            Log::info('User does not have a phone number for OTP SMS', [
                'user_id' => $user->id,
                'email' => $user->email,
                'phone_number_field' => $user->phone_number ?? 'null',
                'phone_field' => $user->phone ?? 'null'
            ]);
            return;
        }

        try {
            $smsMessage = "Your verification code is: {$otp}. It will expire in 5 minutes.";
            
            // Log SMS attempt start
            Log::info('Attempting to send OTP via SMS (VerifyOtp)', [
                'user_id' => $user->id,
                'phone' => $userPhone,
                'otp' => $otp
            ]);
            
            // Use @ operator to suppress warnings and wrap in try-catch for maximum safety
            try {
                $smsResult = @SelcomSMSController::send($userPhone, $smsMessage, $user->id, null);
                
                // Log SMS result in detail
                if (isset($smsResult['success']) && $smsResult['success']) {
                    Log::info('OTP SMS sent successfully via VerifyOtp', [
                        'user_id' => $user->id,
                        'phone' => $userPhone,
                        'otp' => $otp,
                        'request_id' => $smsResult['request_id'] ?? null,
                        'response' => $smsResult['response'] ?? null
                    ]);
                } else {
                    Log::warning('OTP SMS sending failed in VerifyOtp (non-critical)', [
                        'user_id' => $user->id,
                        'phone' => $userPhone,
                        'otp' => $otp,
                        'error' => $smsResult['error'] ?? 'Unknown error',
                        'response' => $smsResult['response'] ?? null,
                        'http_code' => $smsResult['http_code'] ?? null
                    ]);
                }
            } catch (\Throwable $smsException) {
                // Catch any exceptions from SMS controller (PHP 7+ compatible)
                Log::error('OTP SMS sending encountered an exception in VerifyOtp (non-critical)', [
                    'user_id' => $user->id,
                    'phone' => $userPhone,
                    'otp' => $otp,
                    'error' => $smsException->getMessage(),
                    'file' => $smsException->getFile(),
                    'line' => $smsException->getLine(),
                    'trace' => $smsException->getTraceAsString()
                ]);
                // Don't re-throw - this should not interrupt the OTP process
            }
        } catch (\Exception $e) {
            // Final safety net - catch any unexpected errors
            Log::error('Unexpected error in OTP SMS sending (non-critical)', [
                'user_id' => $user->id,
                'phone' => $userPhone,
                'otp' => $otp,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            // Don't re-throw - SMS failure should never stop the OTP process
        }
    }

    public function resendOTP(): void
    {
        $resendKey = "resend_otp_{$this->getUserId()}";

        if (Cache::has($resendKey)) {
            $this->error = true;
            $this->errorMessage = 'Please wait before requesting another OTP.';
            return;
        }

        Cache::put($resendKey, true, now()->addSeconds(30));

        $this->isResending = true;
        $user = Auth::user();

        if ($user) {
            $this->generateAndSendOTP($user);
            $this->remainingSeconds = 120;
        }

        $this->isResending = false;
    }

    public function onCountdownFinished(): void
    {
        $this->handleTimeout();
    }

    private function handleTimeout()
    {
        Cache::forget($this->getOTPKey($this->getUserId()));

        Auth::guard('web')->logout();
        Session::flush();

        return redirect()->route('login')->with('message', 'Session expired. Please login again.');
    }

    public function logout()
    {
        Cache::forget($this->getOTPKey($this->getUserId()));
        Cache::forget($this->getAttemptKey());

        Auth::guard('web')->logout();
        Session::flush();

        return redirect()->route('login');
    }

    // ❌ FIXED: Removed return type declaration
    public function submitOTP($value)
    {
        $userId = $this->getUserId();

        if ($this->attemptCount >= $this->maxAttempts) {
            $this->handleLockout();
            return;
        }

        if (!is_numeric($value) || strlen($value) !== 6) {
            $this->handleInvalidOTP();
            return;
        }

        $otpData = Cache::get($this->getOTPKey($userId));

        if (!$otpData) {
            $this->error = true;
            $this->errorMessage = 'OTP expired. Please request a new one.';
            return;
        }

        if (Carbon::parse($otpData['expires_at'])->isPast()) {
            Cache::forget($this->getOTPKey($userId));
            $this->error = true;
            $this->errorMessage = 'OTP expired. Please request a new one.';
            return;
        }

        if ((int)$otpData['otp'] === (int)$value) {
            return $this->handleValidOTP($userId);
        } else {
            $this->handleInvalidOTP();
            return;
        }
    }

    // ❌ FIXED: Removed return type declaration
    private function handleValidOTP(int $userId)
    {
        try {
            DB::beginTransaction();

            DB::table('users')
                ->where('id', $userId)
                ->update([
                    'verification_status' => 1,
                    'email_verified_at' => Carbon::now(),
                    'otp' => null
                ]);

            Cache::forget($this->getOTPKey($userId));
            Cache::forget($this->getAttemptKey());

            DB::commit();

            Log::info('User successfully verified OTP', ['user_id' => $userId]);

            return redirect()->route('System');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update user verification status', [
                'user_id' => $userId,
                'error' => $e->getMessage()
            ]);

            $this->error = true;
            $this->errorMessage = 'Verification failed. Please try again.';
            return;
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
