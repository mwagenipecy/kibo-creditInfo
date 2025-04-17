<button style="background-color: #005A06" {{ $attributes->merge(['type' => 'submit', 'class' => 'btn p-2 mx-2 rounded-lg  bg-black hover:bg-red-500 text-white whitespace-nowrap']) }}>
    {{ $slot }}
</button>
