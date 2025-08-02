<?php

namespace App\Http\Livewire\Web;

use App\Mail\OTP as OTPMail;
use App\Models\User;
use App\Services\SMSService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class OTP extends Component
{
    public $otp1;

    public $otp2;

    public $otp3;

    public $otp4;

    public $otp5;

    public $otp6;

    public $full_otp;

    public $email;

    public $phone;

    public $otpExpiry = 0;

    protected $listeners = ['clearOtpFields', 'refreshTimer'];

    // When component initializes
    public function mount()
    {
        // Check if user is logged in
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $this->email = $user->email;
        $this->phone = $user->phone;

        // Check if user is already verified
        if (! is_null($user->email_verified_at)) {
            return redirect()->route('CyberPoint-Pro');
        }

        // If no OTP exists, generate one
        if (! Session::has('otp_code')) {
            $this->generateAndSendOTP();
        }

        // Initialize timer
        $this->updateOtpExpiry();
    }

    // Update OTP expiry time
    public function updateOtpExpiry()
    {
        if (! Session::has('otp_expiry')) {
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

        // Store OTP in session with expiry time (10 minutes from now)
        $expiry = Carbon::now()->addMinutes(10);
        Session::put('otp_code', $otp);
        Session::put('otp_expiry', $expiry);

        // Update component expiry
        $this->updateOtpExpiry();

        try {
            // Send OTP via email
            $link = route('otp-page');
            Mail::to($user->email)->send(new OTPMail($link, $user->name, $otp));
        } catch (\Exception $e) {
            \Log::error('Failed to send OTP email: '.$e->getMessage());
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
            'message' => 'A verification code has been sent to your email'.($this->phone ? ' and phone' : '').'.',
        ]);
    }

    // Handle the form submission
    public function verifyOTP()
    {
        // Combine OTP

        $this->full_otp = $this->otp1.$this->otp2.$this->otp3.$this->otp4.$this->otp5.$this->otp6;

        // dd($this->full_otp); reach here very fine
        // Validate inputs
        $this->validate([
            'otp1' => 'required|numeric|digits:1',
            'otp2' => 'required|numeric|digits:1',
            'otp3' => 'required|numeric|digits:1',
            'otp4' => 'required|numeric|digits:1',
            'otp5' => 'required|numeric|digits:1',
            'otp6' => 'required|numeric|digits:1',
        ]);

        // dd("here also");

        // Check session
        if (! Session::has('otp_code') || ! Session::has('otp_expiry')) {
            $this->addError('otp', 'OTP session has expired. Please request a new code.');
            $this->clearOtpInputs();

            return;
        }

        // dd("test"); // code run fine here

        $stored_otp = Session::get('otp_code');
        $expiry = Session::get('otp_expiry');

        // dd($stored_otp, $expiry, $this->full_otp); // run fine to here

        if (Carbon::now()->isAfter($expiry)) {

            $this->addError('otp', 'OTP has expired. Please request a new code.');
            $this->clearOtpInputs();

        } else {

            if ($this->full_otp !== $stored_otp) {
                $this->addError('otp', 'Invalid verification code. Please try again.');
                $this->clearOtpInputs();

            } else {

                // Mark verified
                $user = Auth::user();
                $user->email_verified_at = Carbon::now();
                $user->save();
                Session::forget(['otp_code', 'otp_expiry']);
                session()->flash('success', 'Your account has been successfully verified!');

                return redirect()->route('CyberPoint-Pro');

            }

        }

    }

    // Clear OTP input fields
    public function clearOtpInputs()
    {
        $this->reset(['otp1', 'otp2', 'otp3', 'otp4', 'otp5', 'otp6', 'full_otp']);
        // $this->dispatchBrowserEvent('clear-otp-fields');
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

        // Clear input fields
        $this->clearOtpInputs();

        // Generate new OTP and send
        $this->generateAndSendOTP();

        $this->dispatchBrowserEvent('otp-resent', [
            'message' => 'A new verification code has been sent to your email'.($this->phone ? ' and phone' : '').'.',
            'timeLeft' => 600, // 10 minutes
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
        $this->updateOtpExpiry();

        return view('livewire.web.o-t-p', [
            'otpExpiry' => $this->otpExpiry,
        ]);
    }
}
