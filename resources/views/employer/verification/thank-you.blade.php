@extends('layouts.employer')

@section('content')
<div class="max-w-4xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-green-600 px-6 py-4">
            <h1 class="text-white text-xl font-semibold">Thank You for Your Response</h1>
        </div>
        
        <div class="p-6 text-center">
            <div class="rounded-full h-16 w-16 bg-green-100 mx-auto flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            
            <h2 class="mt-4 text-lg font-medium text-gray-900">Verification Completed Successfully</h2>
            
            <p class="mt-2 text-gray-600">
                Thank you for verifying the employment information. Your response has been recorded and will help us process the application appropriately.
            </p>
            
            <div class="mt-8">
                <p class="text-sm text-gray-500">
                    You can now close this window. No further action is required.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection