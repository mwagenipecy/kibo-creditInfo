<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployerVerification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class EmployerVerificationController extends Controller
{
    public function showForm($token)
    {
        // Get verification request by token
        $verification = EmployerVerification::where('token', $token)->first();
        
        // Check if token exists
        if (!$verification) {
            return view('employer.verification-invalid', ['error' => 'The verification link is invalid.']);
        }
        
        // Check if already completed
        if ($verification->status === 'completed') {
            return view('employer.verification-completed');
        }
        
        // Check if expired
        if ($verification->isExpired()) {
            $verification->update(['status' => 'expired']);
            return view('employer.verification-invalid', ['error' => 'The verification link has expired.']);
        }
        
        // Get application details
        $application = $verification->application;
        
        return view('employer.verification-form', [
            'verification' => $verification,
            'application' => $application
        ]);
    }
    
    public function submitForm(Request $request, $token)
    {
        // Get verification request by token
        $verification = EmployerVerification::where('token', $token)->first();
        
        // Check if token exists
        if (!$verification) {
            return redirect()->route('employer.verification.invalid');
        }
        
        // Check if already completed
        if ($verification->status === 'completed') {
            return redirect()->route('employer.verification.completed');
        }
        
        // Check if expired
        if ($verification->isExpired()) {
            $verification->update(['status' => 'expired']);
            return redirect()->route('employer.verification.invalid');
        }
        
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'knows_employee' => 'required|in:yes,no',
            'employment_status' => 'required_if:knows_employee,yes',
            'position' => 'required_if:knows_employee,yes',
            'employment_length' => 'required_if:knows_employee,yes',
            'recommend' => 'required_if:knows_employee,yes|in:yes,no,unsure',
            'comments' => 'nullable|string|max:1000',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // Record the response
        $verification->update([
            'status' => 'completed',
            'employer_response' => $request->except('_token'),
            'responded_at' => Carbon::now(),
            'ip_address' => $request->ip(),
        ]);
        
        // Update application status
        $verification->application->update([
            'employer_verified' => true,
            'employer_verified_at' => Carbon::now(),
            'employer_verification_status' => $request->knows_employee === 'yes' ? 'confirmed' : 'denied',
        ]);
        
        return redirect()->route('employer.verification.thank-you');
    }
    
    public function thankYou()
    {
        return view('employer.verification.thank-you');
    }
    
    public function invalid()
    {
        return view('employer.verification-invalid');
    }
    
    public function completed()
    {
        return view('employer.verification-completed');
    }
}