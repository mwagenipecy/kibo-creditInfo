<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
        <link rel="icon" href="{{ asset('/InstitutionLogo/carLogo.png') }}" type="image/png">

        <title>{{ config('app.name', 'KIBO') }}</title>

        <!-- Styles -->
        @livewireStyles






    </head>
    <body
        class="font-inter antialiased bg-slate-100 text-slate-600"
        :class="{ 'sidebar-expanded': sidebarExpanded }"
        x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }"
        x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))"
    >


        <script>
            if (localStorage.getItem('sidebar-expanded') == 'true') {
                document.querySelector('body').classList.add('sidebar-expanded');
            } else {
                document.querySelector('body').classList.remove('sidebar-expanded');
            }
        </script>

        <!-- Page wrapper -->
        <!-- Page wrapper -->
        <div class="flex h-screen overflow-hidden">

            @if(auth()->user()->current_team_id == 1)
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="bg-gray-50 p-2 rounded-xl mb-4">
                        <div class="bg-white p-4 rounded-xl">
                            @livewire('profile.update-password-form')
                        </div>
                    </div>
                @endif
            @else

                <livewire:sidebar.sidebar/>
                <!-- Content area -->
                <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden @if($attributes['background']){{ $attributes['background'] }}@endif" x-ref="contentarea">
                    <x-app.header />
                    <main>
                        {{ $slot }}
                    </main>

                </div>

            @endif
        </div>
        @livewireScripts

        @livewire('livewire-ui-modal')

<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

        <script src="{{ asset('assets/js/gauge.min.js') }}"></script>


    </body>
</html>
