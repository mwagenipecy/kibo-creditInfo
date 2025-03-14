@props([
    'align' => 'right'
])

{{--<div class="relative inline-flex" x-data="{ open: false }">--}}
{{--    <button--}}
{{--        class="inline-flex justify-center items-center group"--}}
{{--        aria-haspopup="true"--}}
{{--        @click.prevent="open = !open"--}}
{{--        :aria-expanded="open"--}}
{{--    >--}}
{{--        <img class="w-8 h-8 rounded-full" src="{{ asset('images/avatar.png')  }}" width="32" height="32" alt="{{ Auth::user()->name }}" />--}}
{{--        <div class="flex items-center truncate">--}}
{{--            <span class="truncate ml-2 text-sm font-medium group-hover:text-slate-800">{{ Auth::user()->name }}</span>--}}
{{--            <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" viewBox="0 0 12 12">--}}
{{--                <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />--}}
{{--            </svg>--}}
{{--        </div>--}}
{{--    </button>--}}


{{--    <div--}}
{{--        class="origin-top-right z-10 absolute top-full min-w-44 bg-white border border-slate-200 py-1.5 rounded shadow-lg overflow-hidden mt-1 {{$align === 'right' ? 'right-0' : 'left-0'}}"--}}
{{--        @click.outside="open = false"--}}
{{--        @keydown.escape.window="open = false"--}}
{{--        x-show="open"--}}

{{--        x-transition:enter="transition ease-out duration-200 transform"--}}
{{--        x-transition:enter-start="opacity-0 -translate-y-2"--}}
{{--        x-transition:enter-end="opacity-100 translate-y-0"--}}
{{--        x-transition:leave="transition ease-out duration-200"--}}
{{--        x-transition:leave-start="opacity-100"--}}
{{--        x-transition:leave-end="opacity-0"--}}
{{--        x-cloak--}}
{{--    >--}}
{{--        <div class="pt-0.5 pb-2 px-3 mb-1 border-b border-slate-200">--}}
{{--            <div class="font-medium text-slate-800">{{ Auth::user()->name }}</div>--}}
{{--            <div class="text-xs text-slate-500 italic">Authorized User</div>--}}
{{--        </div>--}}
{{--        <ul>--}}
{{--            <li>--}}
{{--                <form method="POST" action="{{ route('logout') }}" x-data >--}}
{{--                    @csrf--}}

{{--                    <a class="font-medium text-sm text-indigo-500 hover:text-indigo-600 flex items-center py-1 px-3"--}}
{{--                        href="{{ route('logout') }}"--}}
{{--                        @click.prevent="$root.submit();"--}}
{{--                        @focus="open = true"--}}
{{--                        @focusout="open = false"--}}
{{--                    >--}}
{{--                        {{ __('Sign Out') }}--}}
{{--                    </a>--}}
{{--                </form>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--</div>--}}


<div>
    <div class="relative inline-block text-left">
{{--        <button id="dropdown-btn" type="button" class="inline-flex items-center justify-center w-32 h-12 px-4 text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">--}}
            <button  id="dropdown-btn"
                     class="inline-flex justify-center items-center group"
                    aria-haspopup="true"
                    @click.prevent="open = !open"
                    :aria-expanded="open"
            >
                <img class="w-8 h-8 rounded-full" src="{{ asset('images/avatar.png')  }}" width="32" height="32" alt="{{ Auth::user()->name }}" />
                <div class="flex items-center truncate">
                    <span class="truncate ml-2 text-sm font-medium group-hover:text-slate-800">{{ Auth::user()->name }}</span>
                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" viewBox="0 0 12 12">
                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                    </svg>
                </div>
            </button>

{{--        </button>--}}
        <div id="dropdown-menu" class="hidden absolute z-50  bg-white border border-gray-300 rounded shadow-lg">
            <div class="pt-0.5 pb-2 px-3 mb-1 border-b border-slate-200">
                <div class="font-medium text-slate-800">{{ Auth::user()->name }}</div>
                <div class="text-xs text-slate-500 italic">Authorized User</div>
            </div>

            <li>
                <form method="POST" action="{{ route('logout') }}" x-data >
                    @csrf

                    <a class="font-medium text-sm text-indigo-500 hover:text-indigo-600 flex items-center py-1 mb-2 px-3"
                       href="{{ route('logout') }}"
                       @click.prevent="$root.submit();"
                       @focus="open = true"
                       @focusout="open = false"
                    >
                        {{ __('Sign Out') }}
                    </a>
                </form>
            </li>

             </div>
    </div>

    <script>
        const dropdownBtn = document.getElementById('dropdown-btn');
        const dropdownMenu = document.getElementById('dropdown-menu');

        dropdownBtn.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', (event) => {
            if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</div>

