<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Rules\NidaNumberRule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nida_number' => ['required', 'string', new NidaNumberRule()],
            'phone_number'=>['required'],
            'address'=>['required'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'address'=>$input['address'],
            'department'=>4,
            'phone_number'=>$input['phone_number'],
            'nida_number'=>$input['nida_number'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
