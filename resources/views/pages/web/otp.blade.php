@extends('layouts.main')
@section('main-section')

<div class="min-h-screen bg-gray-100 flex">
    <!-- Left side - Image Section -->
    <div class="hidden lg:block lg:w-1/2 relative">
        <div class="absolute inset-0 bg-gradient-to-r from-green-600 to-green-800 opacity-90"></div>
        <img src="{{ asset('/cars/image.png') }}" alt="Vehicle Financing" class="w-full h-full object-cover">
        <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-12">
            <div class="max-w-md text-center">
                <h1 class="text-4xl font-bold mb-6">Verify Your Account</h1>
                <p class="text-xl mb-8">Complete your account verification to access all features.</p>
                <ul class="text-left space-y-4 mb-8">
                    <li class="flex items-center">
                        <svg class="h-6 w-6 mr-2 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Secure account verification
                    </li>
                    <li class="flex items-center">
                        <svg class="h-6 w-6 mr-2 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Quick and easy process
                    </li>
                    <li class="flex items-center">
                        <svg class="h-6 w-6 mr-2 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Access to all platform features
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Right side - OTP Verification Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-12">
        <div class="w-full max-w-md">
            

                <livewire:web.o-t-p />

            <!-- Mobile Version Banner (only shown on small screens) -->
          
        </div>
    </div>
</div>

@endsection