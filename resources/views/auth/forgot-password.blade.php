@extends('layouts.main')
@section('main-section')

<div class="min-h-screen bg-gray-100 flex">
    <!-- Left side - Image Section -->
    <div class="hidden lg:block lg:w-1/2 relative">
        <div class="absolute inset-0 bg-gradient-to-r from-green-600 to-green-800 opacity-90"></div>
        <img src="{{ asset('/cars/image.png') }}" alt="Vehicle Financing" class="w-full h-full object-cover">
        <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-12">
            <div class="max-w-md text-center">
                <h1 class="text-4xl font-bold mb-6">Reset Your Password</h1>
                <p class="text-xl mb-8">Enter your email address and we'll send you a link to reset your password.</p>
                <ul class="text-left space-y-4 mb-8">
                    <li class="flex items-center">
                        <svg class="h-6 w-6 mr-2 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Secure password reset process
                    </li>
                    <li class="flex items-center">
                        <svg class="h-6 w-6 mr-2 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Quick email verification
                    </li>
                    <li class="flex items-center">
                        <svg class="h-6 w-6 mr-2 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Easy account recovery
                    </li>
                </ul>
                <div class="inline-flex rounded-md shadow">
                    <a href="{{ route('about.us') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-green-700 bg-white hover:bg-gray-50">
                        Learn More
                        <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Right side - Password Reset Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-12">
        <div class="w-full max-w-md">
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900">
                    Reset your password
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Remember your password? 
                    <a href="{{ route('login') }}" class="font-medium text-green-600 hover:text-green-500">
                        Sign in here
                    </a>
                </p>
            </div>

            <div class="bg-white py-8 px-6 shadow-xl rounded-2xl border border-gray-100">
                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        @php
                            $emailValue = old('email', request('email', ''));
                            $isEmailLocked = request()->has('email') && request('email');
                        @endphp
                        <input id="email" type="email" name="email" value="{{ $emailValue }}" required autofocus autocomplete="email" 
                            @if($isEmailLocked) readonly @endif
                            class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 @if($isEmailLocked) bg-gray-50 text-gray-700 cursor-not-allowed @else bg-white @endif focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        @if($isEmailLocked)
                            <p class="mt-1 text-xs text-gray-500">
                                <svg class="inline h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                </svg>
                                Email is locked. If this is not your email, please <a href="{{ route('password.request') }}" class="text-green-600 hover:text-green-700 font-medium">start over</a>.
                            </p>
                        @endif
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Request Password Reset
                        </button>
                    </div>
                </form>

                <x-jet-validation-errors class="mt-4" />
            </div>

            <!-- Mobile Version Banner (only shown on small screens) -->
            <div class="mt-10 lg:hidden bg-green-600 text-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold mb-3">Reset Your Password</h3>
                <p class="mb-4">Enter your email address and we'll send you a link to reset your password.</p>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center w-full px-4 py-2 border border-transparent text-sm font-medium rounded-md text-green-600 bg-white hover:bg-gray-50">
                    Back to Sign In
                    <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
