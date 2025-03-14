<button style="background-color: #005A06" {{ $attributes->merge(['type' => 'submit', 'class' => 'btn bg-black hover:bg-red-500 text-white whitespace-nowrap']) }}>
    {{ $slot }}
</button>
