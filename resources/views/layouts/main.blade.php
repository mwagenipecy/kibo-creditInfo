<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vehicle Marketplace') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">

    <link rel="icon" href="{{ asset('/InstitutionLogo/carLogo.png') }}" type="image/png">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Additional Styles for Fixed Navbar -->
    <style>
        /* Add padding to body equal to navbar height to prevent content from hiding behind fixed navbar */
        body {
            padding-top: 4rem;
            scroll-behavior: smooth;
        }
        
        /* Fixed navbar styling */
        .navbar-fixed {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1030;
            transition: all 0.3s ease;
        }
        
        /* Shadow for navbar on scroll */
        .navbar-shadow {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        /* Mobile menu overlay */
        .mobile-menu-overlay {
            background-color: rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1029;
        }
        
        /* Smooth transitions */
        .transition-300 {
            transition: all 0.3s ease;
        }
        
        /* Improve button hover interactions */
        .hover-effect:hover {
            transform: translateY(-2px);
        }

        /* Fix for content behind navbar on anchor links */
        :target {
            scroll-margin-top: 5rem;
        }

        /* Improved dropdown animation */
        @keyframes dropdown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .dropdown-animation {
            animation: dropdown 0.2s ease forwards;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
   
        <header class="bg-white w-full fixed top-0 left-0 right-0 z-50" 
        x-data="{ scrolled: false, mobileMenuOpen: false }" 
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
        :class="{ 'shadow-lg backdrop-blur-sm bg-white/95': scrolled, 'py-1': scrolled, 'py-2': !scrolled }">
    <div class="container mx-auto transition-all duration-300" :class="{ 'py-2': scrolled, 'py-2': !scrolled }">
        <div class="flex justify-between items-center px-2 md:px-6">
            <!-- Logo - Enhanced & Optimized -->
            <div class="flex-shrink-0 transition-all duration-300" :class="{ 'scale-95': scrolled }">
                <a href="{{ route('home.page') }}" class="flex items-center hover:opacity-90 transition-opacity duration-300 group">
                    <div class="relative">
                        <img 
                            src="{{ asset('/InstitutionLogo/carLogo.png') }}" 
                            alt="KiboMarket Logo" 
                            class="h-10 w-auto sm:h-12 object-contain transition-transform duration-300 transform group-hover:scale-105" 
                        />
                        <span class="absolute -top-1 -right-1 h-3 w-3 bg-green-500 rounded-full shadow-lg shadow-green-500/30 hidden sm:block"></span>
                    </div>
                    <div class="ml-2.5 flex flex-col leading-none">
                    <span class="text-xl sm:text-2xl font-bold text-green-700 tracking-tight" style="text-shadow: 0 1px 1px rgba(0,0,0,0.1)">KiboMarket</span>
                    <span class="text-xs text-gray-500 font-medium hidden sm:block">Premium Vehicle Marketplace</span>
                    </div>
                </a>
            </div>

            <!-- Navigation Links - Enhanced Desktop/Tablet -->
            <nav class="hidden md:flex items-center space-x-1 lg:space-x-5">
                <a href="{{ route('home.page') }}" class="group relative text-gray-700 @if(Route::is('home.page')) text-green-600 @endif hover:text-green-600 px-3 py-2 rounded-md text-sm lg:text-base font-medium transition-colors duration-300">
                    <span>Home</span>
                    <span class="absolute -bottom-[2px] left-1/2 w-0 h-[3px] bg-green-500 group-hover:w-4/5 group-hover:-translate-x-1/2 transition-all duration-300 ease-out rounded-full @if(Route::is('home.page')) w-4/5 -translate-x-1/2 @endif"></span>
                </a>
                
                <a href="{{ route('vehicle.list') }}" class="group relative text-gray-700 @if(Route::is('vehicle.list')) text-green-600 @endif hover:text-green-600 px-3 py-2 rounded-md text-sm lg:text-base font-medium transition-colors duration-300">
                    <span>Vehicles</span>
                    <span class="absolute -bottom-[2px] left-1/2 w-0 h-[3px] bg-green-500 group-hover:w-4/5 group-hover:-translate-x-1/2 transition-all duration-300 ease-out rounded-full @if(Route::is('vehicle.list')) w-4/5 -translate-x-1/2 @endif"></span>
                </a>
                
                <a href="{{ route('about.us') }}" class="group relative text-gray-700 @if(Route::is('about.us')) text-green-600 @endif hover:text-green-600 px-3 py-2 rounded-md text-sm lg:text-base font-medium transition-colors duration-300">
                    <span>About Us</span>
                    <span class="absolute -bottom-[2px] left-1/2 w-0 h-[3px] bg-green-500 group-hover:w-4/5 group-hover:-translate-x-1/2 transition-all duration-300 ease-out rounded-full @if(Route::is('about.us')) w-4/5 -translate-x-1/2 @endif"></span>
                </a>
                
                <a href="{{ route('contact.page') }}" class="group relative text-gray-700 @if(Route::is('contact.page')) text-green-600 @endif hover:text-green-600 px-3 py-2 rounded-md text-sm lg:text-base font-medium transition-colors duration-300">
                    <span>Contact</span>
                    <span class="absolute -bottom-[2px] left-1/2 w-0 h-[3px] bg-green-500 group-hover:w-4/5 group-hover:-translate-x-1/2 transition-all duration-300 ease-out rounded-full @if(Route::is('contact.page')) w-4/5 -translate-x-1/2 @endif"></span>
                </a>
            </nav>

            <!-- Enhanced Auth Buttons - Desktop/Tablet -->
            <div class="hidden md:flex items-center space-x-3">
                @guest
                    <a href="{{ route('login') }}" class="relative inline-flex items-center px-4 py-2 border border-green-600 rounded-lg text-sm lg:text-base font-medium text-green-600 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300 overflow-hidden group">
                        <span class="relative z-10">Login</span>
                        <span class="absolute inset-0 bg-green-100 transform scale-x-0 origin-left group-hover:scale-x-100 transition-transform duration-300"></span>
                    </a>
                    <a href="{{ route('client.registration') }}" class="relative inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-sm lg:text-base font-medium text-white transition-all duration-300 shadow-md overflow-hidden group">
                        <span class="relative z-10">Register</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-green-600 to-green-500"></span>
                        <span class="absolute inset-0 bg-gradient-to-r from-green-700 to-green-600 transform scale-x-0 origin-left group-hover:scale-x-100 transition-transform duration-300"></span>
                    </a>
                @else
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center space-x-2 px-3 py-1.5 rounded-lg border border-gray-200 hover:border-green-500 transition-colors duration-300 group focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            <!-- User Avatar -->
                            <div class="relative">
                                <div class="h-8 w-8 rounded-full flex items-center justify-center bg-green-600 text-white font-medium text-sm transition-all duration-300 group-hover:shadow-md group-hover:shadow-green-500/30">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="absolute bottom-0 right-0 h-2.5 w-2.5 bg-green-500 border-2 border-white rounded-full"></div>
                            </div>
                            
                            <div class="flex flex-col items-start leading-tight">
                                <span class="text-sm font-medium text-gray-700 group-hover:text-green-600 transition-colors duration-300">{{ Auth::user()->name }}</span>
                                <span class="text-xs text-gray-500">My Account</span>
                            </div>
                            
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 group-hover:text-green-500 transition-transform duration-200" :class="{'rotate-180': open}" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="origin-top-right absolute right-0 mt-2 w-52 rounded-xl shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-20 border border-gray-100" 
                            style="display: none;">
                            
                            <!-- User Info Section -->
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm text-gray-500">Signed in as</p>
                                <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <!-- Dashboard Link -->
                            <a href="{{ route('application.list') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-green-600 transition-colors duration-300">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400 group-hover:text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Dashboard
                                </div>
                            </a>

                            <!-- Profile Settings -->
                            <a href="{{ route('account.setting') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-green-600 transition-colors duration-300">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Account Settings
                                </div>
                            </a>

                            <!-- Logout -->
                            <div class="border-t border-gray-100 mt-1 pt-1">
                                <a href="{{ route('logout') }}" 
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                    class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-300">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Logout
                                    </div>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Enhanced Mobile Menu Button -->
            <button 
                type="button" 
                @click="mobileMenuOpen = !mobileMenuOpen" 
                class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-700 hover:text-green-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500 transition-colors duration-300"
                aria-expanded="false"
                :aria-expanded="mobileMenuOpen.toString()">
                <span class="sr-only">Toggle menu</span>
                <svg 
                    x-show="!mobileMenuOpen" 
                    class="h-6 w-6" 
                    xmlns="http://www.w3.org/2000/svg" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke="currentColor" 
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg 
                    x-show="mobileMenuOpen" 
                    class="h-6 w-6" 
                    xmlns="http://www.w3.org/2000/svg" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke="currentColor" 
                    aria-hidden="true"
                    style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Enhanced Mobile Menu Container -->
    <div 
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-200" 
        x-transition:enter-start="opacity-0 transform -translate-y-2" 
        x-transition:enter-end="opacity-100 transform translate-y-0" 
        x-transition:leave="transition ease-in duration-150" 
        x-transition:leave-start="opacity-100 transform translate-y-0" 
        x-transition:leave-end="opacity-0 transform -translate-y-2"
        class="md:hidden bg-white border-t border-gray-100 shadow-lg"
        style="display: none;">
        
        <nav class="px-4 pt-3 pb-4 space-y-1">
            <a href="{{ route('home.page') }}" @click="mobileMenuOpen = false" class="flex items-center py-3 px-4 text-base font-medium rounded-lg text-gray-900 hover:bg-gray-50 hover:text-green-600 @if(Route::is('home.page')) bg-green-50 text-green-600 @endif transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 @if(Route::is('home.page')) text-green-500 @else text-gray-400 @endif" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Home
            </a>
            
            <a href="{{ route('vehicle.list') }}" @click="mobileMenuOpen = false" class="flex items-center py-3 px-4 text-base font-medium rounded-lg text-gray-900 hover:bg-gray-50 hover:text-green-600 @if(Route::is('vehicle.list')) bg-green-50 text-green-600 @endif transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 @if(Route::is('vehicle.list')) text-green-500 @else text-gray-400 @endif" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Vehicles
            </a>
            
            <a href="{{ route('about.us') }}" @click="mobileMenuOpen = false" class="flex items-center py-3 px-4 text-base font-medium rounded-lg text-gray-900 hover:bg-gray-50 hover:text-green-600 @if(Route::is('about.us')) bg-green-50 text-green-600 @endif transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 @if(Route::is('about.us')) text-green-500 @else text-gray-400 @endif" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                About Us
            </a>
            
            <a href="{{ route('contact.page') }}" @click="mobileMenuOpen = false" class="flex items-center py-3 px-4 text-base font-medium rounded-lg text-gray-900 hover:bg-gray-50 hover:text-green-600 @if(Route::is('contact.page')) bg-green-50 text-green-600 @endif transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 @if(Route::is('contact.page')) text-green-500 @else text-gray-400 @endif" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Contact
            </a>
        </nav>
        
        <!-- Enhanced Mobile Auth Section -->
        <div class="border-t border-gray-200 pt-4 pb-5 px-4 bg-gray-50">
            @guest
                <div class="space-y-3">
                    <div class="flex justify-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="flex items-center justify-center w-full py-2.5 px-4 border border-green-600 rounded-lg text-center font-medium text-green-600 bg-white hover:bg-green-50 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Login
                    </a>
                    <a href="{{ route('client.registration') }}" @click="mobileMenuOpen = false" class="flex items-center justify-center w-full py-2.5 px-4 border border-transparent rounded-lg text-center font-medium text-white bg-green-600 hover:bg-green-700 transition-colors duration-300 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Register as Client
                    </a>
                </div>
            @else
                <div class="flex items-center px-3 py-3 bg-white rounded-lg shadow-sm">
                    <div class="flex-shrink-0">
                        <div class="h-11 w-11 rounded-full bg-green-600 flex items-center justify-center text-white font-semibold shadow-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="ml-3 truncate">
                        <div class="text-base font-medium text-gray-800 truncate">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500 truncate">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-4 space-y-2">
                    <a href="{{ route('application.list') }}" @click="mobileMenuOpen = false" class="flex items-center px-4 py-2.5 rounded-lg text-base font-medium bg-white shadow-sm text-gray-900 hover:text-green-600 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('account.setting') }}" @click="mobileMenuOpen = false" class="flex items-center px-4 py-2.5 rounded-lg text-base font-medium bg-white shadow-sm text-gray-900 hover:text-green-600 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Account Settings
                    </a>
                    
                    <a href="{{ route('logout') }}" 
                        onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" 
                        @click="mobileMenuOpen = false"
                        class="flex items-center px-4 py-2.5 rounded-lg text-base font-medium bg-white shadow-sm text-gray-900 hover:text-red-600 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            @endguest
        </div>
    </div>
</header>

<!-- Add necessary padding to body to prevent content from being hidden under fixed header -->
<style>
    body {
        padding-top: 5rem; /* Adjust based on your header height */
    }
    
    @media (min-width: 768px) {
        body {
            padding-top: 5.5rem; /* Slightly larger for desktop */
        }
    }
    
    /* Glow effect for green elements */
    .shadow-green {
        box-shadow: 0 0 15px rgba(16, 185, 129, 0.5);
    }
</style>





        <!-- Page Content -->
        <main>
            @yield('main-section')
        </main>

        
        <!-- Footer -->
        <footer class="bg-gray-900 text-white">
            <div class="container mx-auto px-4 py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div>
                        <div class="flex items-center mb-4">
                        <img 
                            src="{{ asset('/InstitutionLogo/carLogo.png') }}" 
                            alt="KiboMarket Logo" 
                            class="h-10 w-auto sm:h-12 object-contain transition-transform duration-300 transform group-hover:scale-105" 
                        />
                            <span class="ml-2 text-2xl font-bold">KiboMarket</span>
                        </div>
                        <p class="text-gray-400 mb-4">Your trusted platform for finding the perfect vehicle. We connect buyers with verified dealers across the country.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('home.page') }}" class="text-gray-400 hover:text-white">Home</a></li>
                            <li><a href="{{ route('vehicle.list') }}" class="text-gray-400 hover:text-white">Browse Vehicles</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Dealers</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Financing</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                        </ul>
                    </div>
                    
                    <!-- Vehicle Categories -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Vehicle Categories</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white">Sedans</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">SUVs</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Trucks</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Luxury Cars</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Electric Vehicles</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Commercial Vehicles</a></li>
                        </ul>
                    </div>
                    
                    <!-- Contact Information -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                        <ul class="space-y-2">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-gray-400">123 Main Street, Dar es Salaam, Tanzania</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                <span class="text-gray-400">+255 123 456 789</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                <span class="text-gray-400">info@automarket.com</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-gray-400">Mon-Fri: 8:00 AM - 6:00 PM<br>Sat: 9:00 AM - 5:00 PM<br>Sun: Closed</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Newsletter Subscription -->
                <div class="mt-10 pt-8 border-t border-gray-800">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="mb-6 md:mb-0">
                            <h3 class="text-lg font-semibold mb-2">Subscribe to our Newsletter</h3>
                            <p class="text-gray-400">Stay updated with new vehicles and exclusive offers.</p>
                        </div>
                        <div class="w-full md:w-1/3">
                            <form class="flex">
                                <input type="email" placeholder="Your email address" class="w-full px-4 py-2 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-r-lg transition duration-300">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Copyright -->
                <div class="mt-10 pt-6 border-t border-gray-800 text-center text-gray-400 text-sm">
                    <p>&copy; {{ date('Y') }} KiboMarket. All rights reserved.</p>
                    <div class="mt-2 space-x-4">
                        <a href="#" class="hover:text-white">Privacy Policy</a>
                        <a href="#" class="hover:text-white">Terms of Service</a>
                        <a href="#" class="hover:text-white">Sitemap</a>
                    </div>
                </div>
            </div>
        </footer>
        
        <!-- Flash Messages -->
        <div x-data="{ show: false, message: '' }" 
             x-on:flash-message.window="message = $event.detail.message; show = true; setTimeout(() => { show = false }, 5000)"
             x-show="show"
             x-transition:enter="transform ease-out duration-300 transition"
             x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
             x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed bottom-0 right-0 mb-6 mr-6 z-50"
             style="display: none;">
            <div class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto border-l-4 border-green-600">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p x-text="message" class="text-sm font-medium text-gray-900"></p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button @click="show = false" class="inline-flex text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Close</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
    
    <script>
        // Default Alpine.js and Livewire initialization
        document.addEventListener('livewire:load', function () {
            Livewire.on('flashMessage', function(message) {
                window.dispatchEvent(new CustomEvent('flash-message', { detail: { message: message } }));
            });
        });
    </script>
</body>
</html>