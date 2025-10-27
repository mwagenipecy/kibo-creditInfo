@extends('layouts.main')
@section('main-section')

<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full text-center">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Coming Soon</h1>
        <p class="text-sm md:text-base text-gray-700 mb-4">
            We're working hard to bring you a revolutionary way to sell your car fast and for free.
        </p>
        
        <div class="space-y-1 text-sm text-gray-600 mb-4">
            <p>• Phone: +255 123 456 789</p>
            <p>• Email: info@vehiclefinance.co.tz</p>
        </div>

        <div class="mt-4">
            <a href="{{ route('sell.your.car') }}" class="inline-flex items-center px-8 py-4 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Go Back
            </a>
        </div>
    </div>
</div>

@endsection

