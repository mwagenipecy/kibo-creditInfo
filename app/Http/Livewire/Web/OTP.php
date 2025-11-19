<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTP as OTPMail;
use App\Models\User;
use Carbon\Carbon;
use App\Services\SMSService;

class OTP extends Component
{
    public $otp1 = '';
    public $otp2 = '';
    public $otp3 = '';
    public $otp4 = '';
    public $otp5 = '';
    public $otp6 = '';
    public $full_otp = '';
    public $email;
    public $phone;
    public $otpExpiry = 0;
    public $maskedEmail;
    
    protected $rules = [
        'otp1' => 'nullable|string|max:1',
        'otp2' => 'nullable|string|max:1',
        'otp3' => 'nullable|string|max:1',
        'otp4' => 'nullable|string|max:1',
        'otp5' => 'nullable|string|max:1',
        'otp6' => 'nullable|string|max:1',
        'full_otp' => 'nullable|string|max:6',
    ];
    
    protected $listeners = ['clearOtpFields', 'refreshTimer'];
    
    // Updated methods for each OTP field to handle paste
    public function updatedOtp1($value)
    {
        $this->handleOtpUpdate($value, 1);
    }
    
    public function updatedOtp2($value)
    {
        $this->handleOtpUpdate($value, 2);
    }
    
    public function updatedOtp3($value)
    {
        $this->handleOtpUpdate($value, 3);
    }
    
    public function updatedOtp4($value)
    {
        $this->handleOtpUpdate($value, 4);
    }
    
    public function updatedOtp5($value)
    {
        $this->handleOtpUpdate($value, 5);
    }
    
    public function updatedOtp6($value)
    {
        $this->handleOtpUpdate($value, 6);
    }
    
    public function updatedFullOtp($value)
    {
        $digits = preg_replace('/\D/', '', $value ?? '');
        $this->full_otp = substr($digits, 0, 6);

        if (strlen($this->full_otp) === 6) {
            $this->verifyOTP();
        }
    }

    // Handle OTP field updates (including paste)
    private function handleOtpUpdate($value, $fieldNumber)
    {
        // If value is longer than 1 character, it's likely a paste
        if (strlen($value) > 1) {
            $this->handlePaste($value, $fieldNumber);
            return;
        }
        
        // Single character input
        if ($value && $fieldNumber < 6) {
            $this->dispatchBrowserEvent('focus-field', ['field' => $fieldNumber + 1]);
        }
        
        // Check if all fields are filled for auto-verification
        $this->checkAutoVerification();
    }
    
    // Handle paste operation
    private function handlePaste($pastedValue, $startField)
    {
        // Extract only numbers
        $numbers = preg_replace('/\D/', '', $pastedValue);
        
        if (strlen($numbers) >= 6) {
            // Fill all fields with pasted numbers
            $this->otp1 = substr($numbers, 0, 1);
            $this->otp2 = substr($numbers, 1, 1);
            $this->otp3 = substr($numbers, 2, 1);
            $this->otp4 = substr($numbers, 3, 1);
            $this->otp5 = substr($numbers, 4, 1);
            $this->otp6 = substr($numbers, 5, 1);
            
            // Focus last field
            $this->dispatchBrowserEvent('focus-field', ['field' => 6]);
            
            // Auto-verify
            $this->dispatchBrowserEvent('auto-verify');
        }
    }
    
    // Check if all fields are filled and trigger auto-verification
    private function checkAutoVerification()
    {
        $allFilled = !empty($this->otp1) && !empty($this->otp2) && !empty($this->otp3) && 
                    !empty($this->otp4) && !empty($this->otp5) && !empty($this->otp6);
        
        if ($allFilled) {
            $this->dispatchBrowserEvent('auto-verify');
        }
    }
    
    // When component initializes
    public function mount()
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $user = Auth::user();
        $this->email = $user->email;
        $this->phone = $user->phone;

        // Prepare masked email like `sh****.com`
        try {
            [$local, $domain] = explode('@', $this->email);
            $prefix = substr($local, 0, 2);
            $tld = '';
            if (strpos($domain, '.') !== false) {
                $tld = substr(strrchr($domain, '.'), 1); // part after last dot
            }
            $this->maskedEmail = $prefix . '****' . ($tld ? ('.' . $tld) : '');
        } catch (\Throwable $e) {
            $this->maskedEmail = '****';
        }

        // If this session is already OTP verified, redirect forward (prevents page from disappearing unexpectedly)
        if (Session::get('otp_verified', false)) {
            if ($user->department == 4) {
                return redirect()->route('application.list');
            }
            return redirect()->intended(route('CyberPoint-Pro'));
        }

        // Always generate and send OTP when component mounts
       $this->generateAndSendOTP();
        
        // Initialize timer
        $this->updateOtpExpiry();
    }
    
    // Update OTP expiry time
    public function updateOtpExpiry()
    {
        if (!Session::has('otp_expiry')) {
            $this->otpExpiry = 0;
            return;
        }
        
        $expiry = Session::get('otp_expiry');
        $secondsLeft = Carbon::now()->diffInSeconds($expiry, false);
        $this->otpExpiry = max(0, $secondsLeft);
    }
    
    // Generate a 6-digit OTP, store it in session with expiry time, and send via email and SMS
    public function generateAndSendOTP()
    {
        $user = Auth::user();
        
        // Generate 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store OTP in session with expiry time (10 minutes)
        $expiry = Carbon::now()->addMinutes(10);
        Session::put('otp_code', $otp);
        Session::put('otp_expiry', $expiry);

        // Persist OTP to database (users table)
        $user->otp = $otp;
        $user->otp_time = $expiry; // reuse existing column for expiry time
        $user->save();
        
        // Update component expiry
        $this->updateOtpExpiry();
        
        try {
            // Send OTP via email
            $link = route('otp-page');
            Mail::to($user->email)->send(new OTPMail($link, $user->name, $otp));
            \Log::info('OTP email sent successfully to: ' . $user->email . ' with OTP: ' . $otp);
        } catch (\Exception $e) {
            \Log::error('Failed to send OTP email: ' . $e->getMessage());
            // Still show the OTP in test mode even if email fails
            if (app()->environment('local', 'testing')) {
                Session::flash('test_otp', $otp);
            }
        }

        // Uncomment when SMS service is ready
        // try {
        //     $smsService = new SMSService();
        //     $smsService->send($user->phone, "Your verification code is: $otp. It will expire in 10 minutes.");
        // } catch (\Exception $e) {
        //     \Log::error('Failed to send SMS: ' . $e->getMessage());
        // }

        // Flash message for test environments
        if (app()->environment('local', 'testing')) {
            Session::flash('test_otp', $otp);
        }
        
        $this->dispatchBrowserEvent('otp-sent', [
            'message' => 'A verification code has been sent to your email' . ($this->phone ? ' and phone' : '') . '.'
        ]);
    }
    
    // Handle the form submission
    public function verifyOTP()
    {
        // Normalize OTP input
        if (!$this->full_otp) {
            $this->full_otp = trim(($this->otp1 ?? '') . ($this->otp2 ?? '') . ($this->otp3 ?? '') . ($this->otp4 ?? '') . ($this->otp5 ?? '') . ($this->otp6 ?? ''));
        }
        $this->full_otp = preg_replace('/\D/', '', $this->full_otp ?? '');

        // Validate inputs
        if (strlen($this->full_otp) !== 6 || !ctype_digit($this->full_otp)) {
            $this->addError('otp', 'Please enter a valid 6-digit code.');
            return;
        }


        // Prefer session but fall back to database if needed
        $stored_otp = Session::get('otp_code');
        $expiry = Session::get('otp_expiry');
        $user = Auth::user();
        if (!$stored_otp || !$expiry) {
            $stored_otp = $user->otp;
            $expiry = $user->otp_time ? Carbon::parse($user->otp_time) : null;
            if (!$stored_otp || !$expiry) {
                $this->addError('otp', 'OTP session has expired. Please request a new code.');
                // Don't clear inputs on session expiry - let user retry
                return;
            }
        }

        if (Carbon::now()->isAfter($expiry)) {
            $this->addError('otp', 'OTP has expired. Please request a new code.');
            // Don't clear inputs on expiry - let user retry
            return;
        }

        if ($this->full_otp !== $stored_otp) {
            $this->addError('otp', 'Invalid verification code. Please try again.');
            // Don't clear inputs on invalid OTP - let user correct
            return;
        }

        // Mark verified
        $user = Auth::user();
        // Mark this session as OTP verified (mandatory each login)
        Session::put('otp_verified', true);
        
        // Keep legacy email verification if you still want to set it for new accounts
        if (is_null($user->email_verified_at)) {
            $user->email_verified_at = Carbon::now();
            $user->save();
        }
        
        // Clear OTP values from session and database
        Session::forget(['otp_code', 'otp_expiry']);
        $user->otp = null;
        $user->otp_time = null;
        $user->save();
        session()->flash('success', 'OTP verified successfully.');

        // Redirect to appropriate page based on user department
        if ($user->department == 4) {
            return redirect()->route('application.list');
        }
        
        return redirect()->route('CyberPoint-Pro');
    }
    
    
    // Clear OTP input fields (only used when explicitly needed)
    public function clearOtpInputs()
    {
        $this->otp1 = '';
        $this->otp2 = '';
        $this->otp3 = '';
        $this->otp4 = '';
        $this->otp5 = '';
        $this->otp6 = '';
        $this->full_otp = '';
    }
    
    // Override to prevent clearing form on validation errors
    public function resetErrorBag($field = null)
    {
        // Don't reset the form when clearing errors
        if ($field) {
            $this->resetValidation($field);
        } else {
            $this->resetValidation();
        }
    }
    
    // Logout user
    public function logout()
    {
        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();
        return redirect()->route('login');
    }

    // Resend OTP
    public function resendOTP()
    {
        // Check if we can resend (not too frequent)
        if (Session::has('otp_expiry')) {
            $lastSent = Session::get('otp_expiry')->subMinutes(10);
            if (Carbon::now()->diffInSeconds($lastSent) < 60) {
                $this->addError('otp', 'Please wait at least 1 minute before requesting a new code.');
                return;
            }
        }

        // Clear previous OTP
        Session::forget(['otp_code', 'otp_expiry']);
        
        // Don't clear input fields - let user keep their input
        
        // Generate new OTP and send
        $this->generateAndSendOTP();
        
        $this->dispatchBrowserEvent('otp-resent', [
            'message' => 'A new verification code has been sent to your email' . ($this->phone ? ' and phone' : '') . '.',
            'timeLeft' => 600 // 10 minutes
        ]);
    }
    
    // Refresh timer method for periodic updates
    public function refreshTimer()
    {
        $this->updateOtpExpiry();
        return $this->otpExpiry;
    }
    
    public function render()
    {
        // Only update expiry if it's not already set or if it's expired
        if ($this->otpExpiry <= 0) {
            $this->updateOtpExpiry();
        }
        
        return view('livewire.web.otp', [
            'otpExpiry' => $this->otpExpiry
        ]);
    }





}