<x-authentication-layout>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

        <livewire:verify-otp/>

    <x-jet-validation-errors class="mt-4" />
    <!-- Footer -->

    
</x-authentication-layout>