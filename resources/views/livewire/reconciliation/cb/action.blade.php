<div>

    <div wire:loading.remove wire:target="resolve({{$id}})">
        <button wire:click='resolve({{$id}})' class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" >
            RESOLVED
        </button>
    </div>
    <div wire:loading wire:target="resolve({{$id}})">
        <button type="button" class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" disabled>

            <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-6 w-6 mr-3 stroke-gray-700" fill="gray-700" viewBox="0 0 24 24" stroke="gray-700" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>

            Processing...
        </button>
    </div>
</div>
