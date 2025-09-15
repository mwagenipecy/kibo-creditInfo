<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Contracts\LoginResponse;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $attempRequest=DB::table("password_policies")->where('id',1)->first();
            $email = (string) $request->email;

            return Limit::perMinute($attempRequest->limiter)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            $attempRequest=DB::table("password_policies")->where('id',1)->first();
            return Limit::perMinute($attempRequest->limiter)->by($request->session()->get('login.id'));
        });


        Fortify::loginView(function () {
            return view('auth.login');
        });

        // Block login for users marked as DELETED
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                if (strtoupper((string)($user->status ?? '')) === 'DELETED') {
                    return null; // prevent authentication
                }
                return $user;
            }
            return null;
        });

        // Disable default Fortify register view (we use client-registration instead)
        Fortify::registerView(function () {
            return redirect()->route('client.registration');
        });


        // Custom login response - always redirect to OTP after successful login
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                // Always go to OTP page to require OTP for every login
                return redirect()->route('otp-page');
            }
        });

        // Custom register response - redirect to OTP page after registration
        $this->app->instance(RegisterResponse::class, new class implements RegisterResponse {
            public function toResponse($request)
            {
                // After registration, redirect to OTP page
                return redirect()->route('otp-page');
            }
        });


    }

}
