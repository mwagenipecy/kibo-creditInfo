<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        // Custom register view
        Fortify::registerView(function () {
            return view('auth.register');
        });


        // Custom login response - redirect to OTP if email not verified
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                $user = Auth::user();

                
                
                // If user's email is not verified, redirect to OTP page
               // if (is_null($user->email_verified_at)) {
                    return redirect()->route('otp-page');
               // }
                
                // Otherwise redirect to intended location or dashboard
              //  return redirect()->intended(route('CyberPoint-Pro'));
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
