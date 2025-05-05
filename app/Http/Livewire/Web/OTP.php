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
    public $otp1;
    public $otp2;
    public $otp3;
    public $otp4;
    public $otp5;
    public $otp6;
    public $full_otp;
    public $email;
    public $phone;
    
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
        
        // If no OTP exists, generate one
        if (!Session::has('otp_code')) {
            $this->generateAndSendOTP();
        }
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
        
        // Send OTP via email
        $link = route('login');

        Mail::to($user->email)->send(new OTPMail($link, $user->name, $otp));
        
       

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
            'message' => 'A verification code has been sent to your phone and email.'
        ]);
    }
    
    // Handle the form submission
    public function verifyOTP()
    {
        // Combine the OTP digits
        $this->full_otp = $this->otp1 . $this->otp2 . $this->otp3 . $this->otp4 . $this->otp5 . $this->otp6;
        
        // Validate all fields are filled
        $this->validate([
            'otp1' => 'required|numeric|digits:1',
            'otp2' => 'required|numeric|digits:1',
            'otp3' => 'required|numeric|digits:1',
            'otp4' => 'required|numeric|digits:1',
            'otp5' => 'required|numeric|digits:1',
            'otp6' => 'required|numeric|digits:1',
        ], [
            'required' => 'All OTP fields are required',
            'numeric' => 'OTP can only contain numbers',
            'digits' => 'Each field must contain exactly one digit',
        ]);
        
        // Check if OTP is valid and not expired
        if (!Session::has('otp_code') || !Session::has('otp_expiry')) {
            $this->addError('otp', 'OTP session has expired. Please request a new code.');
            return;
        }
        
        $stored_otp = Session::get('otp_code');
        $expiry = Session::get('otp_expiry');
        
        // Check if OTP has expired
        if (Carbon::now()->isAfter($expiry)) {

            $this->addError('otp', 'OTP has expired. Please request a new code.');
        }elseif ($this->full_otp != $stored_otp) {

          

            $this->addError('otp', 'Invalid verification code. Please try again.');
            return redirect()->back();
        }else{

            // OTP is valid - Mark user as verified
            $user = Auth::user();
            $user->email_verified_at = Carbon::now();
            $user->save();
            
            // Clear session OTP data
            Session::forget(['otp_code', 'otp_expiry']);
            
            // Redirect to dashboard or intended page
            Session::flash('success', 'Your account has been successfully verified!');
            return redirect()->route('CyberPoint-Pro');


        }
        
       
    }
    
    // Resend OTP
    public function resendOTP()
    {

        // Clear previous OTP
        Session::forget(['otp_code', 'otp_expiry']);
        
        // Generate new OTP and send
        $this->generateAndSendOTP();
        
        // Reset input fields
        $this->reset(['otp1', 'otp2', 'otp3', 'otp4', 'otp5', 'otp6', 'full_otp']);
        
        $this->dispatchBrowserEvent('otp-resent', [
            'message' => 'A new verification code has been sent to your phone and email.'
        ]);
    }
    
    // Check if OTP is expired for the timer
    public function getOTPExpiryProperty()
    {
        if (!Session::has('otp_expiry')) {
            return 0;
        }
        
        $expiry = Session::get('otp_expiry');
        return Carbon::now()->diffInSeconds($expiry, false);
    }
    
    public function render()
    {
        return view('livewire.web.o-t-p', [
            'otpExpiry' => $this->OTPExpiry
        ]);
    }
}