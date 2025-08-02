<?php

namespace App\Http\Livewire;

use App\Http\Traits\MailSender;
use App\Mail\OTP;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

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
        'otp' => 'required|numeric|digits:6',
    ];

    public function boot(): void
    {
        if (! Auth::check()) {
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

        if (! $user) {
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
                'expires_at' => now()->addMinutes(5),
            ], now()->addMinutes(5));

            $user->update([
                'email_verified_at' => null,
                'otp' => $otp,
            ]);

            $this->sendOTPEmail($user, $otp);

        } catch (\Exception $e) {
            Log::error('Failed to generate/send OTP', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
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

        if (! is_numeric($value) || strlen($value) !== 6) {
            $this->handleInvalidOTP();

            return;
        }

        $otpData = Cache::get($this->getOTPKey($userId));

        if (! $otpData) {
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

        if ((int) $otpData['otp'] === (int) $value) {
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
                    'otp' => null,
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
                'error' => $e->getMessage(),
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
            : 'Too many invalid attempts. Please try again later.';

        if ($remainingAttempts <= 0) {
            $this->handleLockout();
        }
    }

    private function handleLockout(): void
    {
        Cache::put($this->getLockoutKey(), true, now()->addMinutes(15));

        Log::warning('User locked out due to too many OTP attempts', [
            'user_id' => $this->getUserId(),
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
            'attemptsRemaining' => max(0, $this->maxAttempts - $this->attemptCount),
        ]);
    }
}
