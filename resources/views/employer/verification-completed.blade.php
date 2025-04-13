@extends('layouts.employer')

@section('content')
<div class="max-w-4xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue-600 px-6 py-4">
            <h1 class="text-white text-xl font-semibold">Verification Already Completed</h1>
        </div>
        
        <div class="p-6 text-center">
            <div class="rounded-full h-16 w-16 bg-blue-100 mx-auto flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            
            <h2 class="mt-4 text-lg font-medium text-gray-900">This Verification Has Already Been Completed</h2>
            
            <p class="mt-2 text-gray-600">
                You have already submitted your response to this verification request. No further action is required.
            </p>
            
            <div class="mt-8">
                <p class="text-sm text-gray-500">
                    Thank you for your cooperation. You can now close this window.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection