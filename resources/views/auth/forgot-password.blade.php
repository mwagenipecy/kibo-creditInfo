<x-authentication-layout>
    <h1 class="text-3xl text-slate-800 font-bold mb-6">{{ __('Reset your Password') }}</h1>
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-red-600">
            {{ session('status') }}
        </div>
    @endif
    <!-- Form -->
    <form method="POST" action="{{ route('password-reset') }}">
        @csrf
        <div>
            <x-jet-label for="email">{{ __('Email Address') }} <span class="text-rose-500">*</span></x-jet-label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm text-xs"/>
        </div>
        <div class="flex justify-end mt-6">
            <x-jet-button>
                {{ __('Request Password Reset') }}
            </x-jet-button>
        </div>
    </form>
    <x-jet-validation-errors class="mt-4" />
</x-authentication-layout>
