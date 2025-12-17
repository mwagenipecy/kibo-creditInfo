<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Rules\NidaNumberRule;
use Laravel\Jetstream\Jetstream;

class ClientRegistrationController extends Controller
{
    /**
     * Handle the registration form submission
     * Validates data and stores in session, then redirects to OTP page
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nida_number' => ['required', 'string', 'unique:users', new NidaNumberRule()],
            'phone_number' => ['required', 'string', 'regex:/^\+255[0-9]{9}$/', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);

        if ($validator->fails()) {
            return redirect()->route('client.registration')
                ->withErrors($validator)
                ->withInput();
        }

        // Store registration data in session
        Session::put('registration_data', [
            'name' => $request->name,
            'email' => $request->email,
            'nida_number' => $request->nida_number,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'password' => $request->password,
            'department_id' => $request->department_id ?? 4,
        ]);
        
        // Ensure session is saved
        Session::save();

        // Redirect to OTP page
        return redirect()->route('otp-page')->with('registration_success', 'Please verify your email with the OTP code we sent.');
    }
}

