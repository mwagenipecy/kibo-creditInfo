<x-authentication-layout>
    <h1 class="text-3xl text-slate-800 font-bold mb-6">{{ __('Confirm your Password') }} ✨</h1>
    <!-- Form -->
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div>
            <x-jet-label for="password" value="{{ __('Password') }}" />
            <input id="password" type="password" name="password" required autocomplete="current-password" autofocus  class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm text-xs"/>
        </div>
        <div class="flex justify-end mt-6">
            <x-jet-button>
                {{ __('Confirm') }}
            </x-jet-button>
        </div>
    </form>
    <x-jet-validation-errors class="mt-4" />
</x-authentication-layout>
