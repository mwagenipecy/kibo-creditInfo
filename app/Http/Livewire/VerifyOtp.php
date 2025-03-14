<?php

namespace App\Http\Livewire;

use App\Http\Traits\MailSender;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Mail\OTP;


class VerifyOtp extends Component
{
    // Using the MailSender trait to send email
    use MailSender;


    // Array of events that this component can listen to
    protected $listeners = ['submitOTP'];

    // Private property to hold the actual OTP generated
    private $otp;

    // Public property to indicate if there was an error in the OTP validation
    public bool $error;

    // Public property to hold the remaining time before the OTP expires
    public $remainingSeconds = 120;

    // Function to be called when the component boots up
    public function boot(): void
    {
        // Set error flag to false by default
        $this->error = false;

        // Get the OTP for the currently logged in user
        $this->otp = User::where('id',auth()->user()->id)->value('otp');

        // Compose an email with the OTP and send it to the user

    }

    public function mount(){

        $link=url('/');
        $name=auth()->user()->name;
        $otp=$this->otp;

        Mail::to(auth()->user()->email)->send(new OTP($link,$name,$otp));

    }


    // Function to be called when the OTP countdown timer finishes
    public function onCountdownFinished()
    {
        // Log out the user and flush the session data
        Auth::guard('web')->logout();
        Session::flush();

        // Redirect the user to the login page
        return redirect()->route('login');
    }

    // Function to resend the OTP
    public function resendOTP(): void
    {
        // Get the OTP for the currently logged in user
        $this->otp = User::where('id',auth()->user()->id)->value('otp');

        // Compose an email with the OTP and send it to the user
        $link=url('/');
        $name=auth()->user()->name;
        $otp=$this->otp;
        Mail::to(auth()->user()->email)->send(new OTP($link,$name,$otp));

    }

    // Function to log out the user
    public function logout()
    {
        // Log out the user and flush the session data
        Auth::guard('web')->logout();
        Session::flush();

        // Redirect the user to the login page
        return redirect()->route('login');
    }

    // Function to handle OTP submission
    public function submitOTP($value): \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application|\Illuminate\Routing\Redirector|null
    {
        // Check if the entered OTP value is correct
        if ($this->otp == $value) {
            // Update the user's verification status to 1 (verified)
            DB::table('users')->where('id', auth()->user()->id)->update(['verification_status' => 1]);

            // Redirect the user to the dashboard
            return redirect('System');
        } else {
            // Set the error flag to true
            $this->error = true;

            // Return null to indicate that no action needs to be taken
            return null;
        }
    }

    // Function to render the Livewire component
    public function render()
    {
        // Return the view for the verify-otp component
        return view('livewire.verify-otp');
    }
}
