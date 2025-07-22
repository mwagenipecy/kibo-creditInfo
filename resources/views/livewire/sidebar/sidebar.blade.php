<div class="flex h-screen bg-gray-50">
    <style>
        .app-color { color: #005A06; }
        .app-bg-color { background: #005A06; }
        .app-bg-hover:hover { background: #005A06; }
        
        /* Custom scrollbar */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Smooth transitions */
        .sidebar-transition { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        
        /* Loading animation */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .spin { animation: spin 1s linear infinite; }
        
        /* Mobile first approach */
        .sidebar-mobile { 
            width: 100vw; 
            max-width: 320px;
        }
        
        /* Tablet styles */
        @media (min-width: 640px) {
            .sidebar-tablet { 
                width: 280px; 
            }
        }
        
        /* Desktop styles */
        @media (min-width: 1024px) {
            .sidebar-desktop { 
                width: 280px; 
            }
            .sidebar-collapsed { 
                width: 80px; 
            }
            .sidebar-collapsed .sidebar-text {
                opacity: 0;
                pointer-events: none;
            }
            .sidebar-collapsed .logo-text {
                display: none;
            }
        }
        
        /* Ultra-wide screens */
        @media (min-width: 1536px) {
            .sidebar-ultrawide { 
                width: 320px; 
            }
        }
        
        /* Menu item states */
        .menu-item {
            transition: all 0.2s ease-in-out;
            color: #005A06;
        }
        
        .menu-item:hover {
            background: #80ad83 !important;
            color: white !important;
            transform: translateX(4px);
        }
        
        .menu-item:hover svg {
            color: white !important;
        }
        
        .menu-item:hover svg path {
            fill: white !important;
            stroke: white !important;
        }
        
        .menu-item:hover span {
            color: white !important;
        }
        
        /* Active menu item */
        .menu-item.active {
            background: #005A06 !important;
            color: white !important;
        }
        
        .menu-item.active svg {
            color: white !important;
        }
        
        .menu-item.active svg path {
            fill: white !important;
            stroke: white !important;
        }
        
        .menu-item.active span {
            color: white !important;
            font-weight: bold;
        }
        
        /* Logo responsiveness - Much bigger and more visible */
        .logo-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 8px 12px;
        }
        
        .logo-responsive {
            height: 64px;
            width: auto;
            max-width: 100%;
            object-fit: contain;
            transition: all 0.3s ease;
            min-height: 64px;
        }
        
        @media (max-width: 639px) {
            .logo-responsive {
                height: 56px;
                min-height: 56px;
            }
            .logo-section {
                padding: 6px 8px;
            }
        }
        
        @media (min-width: 640px) and (max-width: 1023px) {
            .logo-responsive {
                height: 60px;
                min-height: 60px;
            }
        }
        
        @media (min-width: 1024px) {
            .logo-responsive {
                height: 68px;
                min-height: 68px;
            }
            
            .sidebar-collapsed .logo-responsive {
                height: 48px;
                min-height: 48px;
            }
        }
        
        /* Increase header height to accommodate larger logo */
        .sidebar .flex.items-center.p-4.border-b {
            min-height: 80px;
            padding: 12px 16px;
        }
        
        /* Text hiding for collapsed sidebar */
        .sidebar-text {
            opacity: 1;
            transition: opacity 0.3s ease;
        }
        
        /* Backdrop */
        .sidebar-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 40;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .sidebar-backdrop.show {
            opacity: 1;
            visibility: visible;
        }
        
        /* Sidebar positioning - Fixed mobile view */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 50;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        
        .sidebar.open {
            transform: translateX(0);
        }
        
        @media (min-width: 1024px) {
            .sidebar {
                position: static;
                transform: translateX(0) !important;
            }
        }
        
        /* Collapse button rotation */
        .collapse-icon {
            transition: transform 0.3s ease;
        }
        
        .collapse-icon.rotated {
            transform: rotate(180deg);
        }
        
        /* Mobile menu button - Fixed z-index */
        .mobile-menu-btn {
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 60;
            display: block;
        }
        
        @media (min-width: 1024px) {
            .mobile-menu-btn {
                display: none;
            }
        }

        /* Force text colors for non-active items */
        .menu-item:not(.active) span {
            color: #005A06 !important;
        }

        .menu-item:not(.active) svg path {
            fill: #005A06 !important;
            stroke: #005A06 !important;
        }
    </style>

    <!-- Sidebar backdrop (mobile only) -->
    <div id="sidebarBackdrop" class="sidebar-backdrop lg:hidden" onclick="closeSidebar()"></div>

    <!-- Mobile menu button -->
    <button id="mobileMenuBtn" class="mobile-menu-btn p-2 rounded-md bg-white shadow-md text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-600" onclick="openSidebar()">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar flex flex-col sidebar-mobile sm:sidebar-tablet lg:sidebar-desktop xl:sidebar-ultrawide sidebar-transition no-scrollbar bg-white border-r border-gray-200 shadow-lg lg:shadow-none overflow-y-auto">
        
        <!-- Sidebar header - Fixed logo layout -->
        <div class="flex items-center p-4 border-b border-gray-100">
            <!-- Mobile close button -->
            <button class="lg:hidden p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-600 mr-2" onclick="closeSidebar()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <!-- Logo section - Now takes full width -->
            <div class="logo-section">
                <a href="{{ route('CyberPoint-Pro') }}" class="flex items-center justify-center">
                    <img class="logo-responsive h-16 w-auto max-w-full object-contain" src="{{ asset('/logo2.png') }}" alt="Kibo Pro Logo" />
                </a>
            </div>
            
            <!-- Desktop expand/collapse button -->
            <button id="collapseBtn" class="hidden lg:flex p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-600 ml-2" onclick="toggleSidebar()">
                <svg id="collapseIcon" class="collapse-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-3 py-4 space-y-2 overflow-y-auto">
            <!-- Dashboard - Fixed color handling -->
            <div id="menu-0" class="menu-item px-3 py-3 rounded-lg cursor-pointer group @if($this->tab_id == 0) active @endif" onclick="menuItemClicked(0)" wire:loading.attr="disabled">
                <div class="flex items-center space-x-3">
                    <!-- Loading spinner -->
                    <div id="loading-0" class="flex-shrink-0 hidden" wire:loading wire:target="menuItemClicked(0)">
                        <svg class="w-6 h-6 spin text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                        </svg>
                    </div>
                    
                    <!-- Dashboard icon -->
                    <div id="icon-0" class="flex-shrink-0" wire:loading.remove wire:target="menuItemClicked(0)">
                        <svg class="w-6 h-6 text-current" viewBox="0 0 24 24">
                            <path class="fill-current" d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0z" />
                            <path class="fill-current opacity-75" d="M12 3c-4.963 0-9 4.037-9 9s4.037 9 9 9 9-4.037 9-9-4.037-9-9-9z" />
                            <path class="fill-current opacity-50" d="M12 15c-1.654 0-3-1.346-3-3 0-.462.113-.894.3-1.285L6 6l4.714 3.301A2.973 2.973 0 0112 9c1.654 0 3 1.346 3 3s-1.346 3-3 3z" />
                        </svg>
                    </div>
                    
                    <span class="sidebar-text text-sm font-medium truncate">
                        Dashboard
                    </span>
                </div>
            </div>

            <!-- Dynamic Menu Items -->
            @foreach($this->menuItems as $item)
            <div id="menu-{{ $item }}" class="menu-item px-3 py-3 rounded-lg cursor-pointer group @if($this->tab_id == $item) active @endif" onclick="menuItemClicked({{ $item }})" wire:loading.attr="disabled">
                <div class="flex items-center space-x-3">
                    <!-- Loading spinner -->
                    <div id="loading-{{ $item }}" class="flex-shrink-0 hidden" wire:loading wire:target="menuItemClicked({{ $item }})">
                        <svg class="w-6 h-6 spin text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                        </svg>
                    </div>
                    
                    <!-- Menu icons -->
                    <div id="icon-{{ $item }}" class="flex-shrink-0" wire:loading.remove wire:target="menuItemClicked({{ $item }})">
                        @switch($item)
                            @case(1)
                                <svg class="w-6 h-6 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                </svg>
                                @break
                            @case(2)
                                <svg class="w-6 h-6 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                                @break
                            @case(3)
                                <svg class="w-6 h-6 text-current" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="m20.749 12 1.104-1.908a1 1 0 0 0-.365-1.366l-1.91-1.104v-2.2a1 1 0 0 0-1-1h-2.199l-1.103-1.909a1.008 1.008 0 0 0-.607-.466.993.993 0 0 0-.759.1L12 3.251l-1.91-1.105a1 1 0 0 0-1.366.366L7.62 4.422H5.421a1 1 0 0 0-1 1v2.199l-1.91 1.104a.998.998 0 0 0-.365 1.367L3.25 12l-1.104 1.908a1.004 1.004 0 0 0 .364 1.367l1.91 1.104v2.199a1 1 0 0 0 1 1h2.2l1.104 1.91a1.01 1.01 0 0 0 .866.5c.174 0 .347-.046.501-.135l1.908-1.104 1.91 1.104a1.001 1.001 0 0 0 1.366-.365l1.103-1.91h2.199a1 1 0 0 0 1-1v-2.199l1.91-1.104a1 1 0 0 0 .365-1.367L20.749 12zM9.499 6.99a1.5 1.5 0 1 1-.001 3.001 1.5 1.5 0 0 1 .001-3.001zm.3 9.6-1.6-1.199 6-8 1.6 1.199-6 8zm4.7.4a1.5 1.5 0 1 1 .001-3.001 1.5 1.5 0 0 1-.001 3.001z"/>
                                </svg>
                                @break
                            @case(4)
                                <svg class="w-6 h-6 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                @break
                            @case(5)
                                <svg class="w-6 h-6 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                @break
                            @case(6)
                                <svg class="w-6 h-6 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                                </svg>
                                @break
                            @case(7)
                                <svg class="w-6 h-6 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                                @break
                            @case(8)
                                <svg class="w-6 h-6 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                @break
                            @case(9)
                                <svg class="w-6 h-6 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                @break


                                @case(14)
                                <svg class="w-6 h-6 text-current"  data-slot="icon" fill="none" stroke-width="1.5" stroke="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke="white" fill="white" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                                </svg>
                                @break

                                @case(15)


                                <svg  class="w-6 h-6 text-current" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"></path>
                                </svg>

                                @break


                                @case(16)
                                <svg  class="w-6 h-6 text-current"  data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z"></path>
                                </svg>

                                @break
                            @default
                                <svg class="w-6 h-6 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                </svg>
                        @endswitch
                    </div>
                    
                    <span class="sidebar-text text-sm font-medium truncate">
                        {{ \App\Models\menus::where('ID', $item)->first()->menu_name ?? 'Menu Item' }}   
                    </span>
                </div>
            </div>
            @endforeach
        </nav>
        

        <!-- Footer/User section -->
        <div class="p-4 border-t border-gray-100">
            <div class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
                <div class="sidebar-text min-w-0 flex-1">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name ?? 'User' }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar state
        let sidebarOpen = false;
        let sidebarExpanded = true;
        let currentActiveTab = {{ $this->tab_id ?? 0 }};

        // DOM elements
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        const collapseIcon = document.getElementById('collapseIcon');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');

        // Open sidebar (mobile) - Fixed
        function openSidebar() {
            console.log('Opening sidebar'); // Debug log
            sidebarOpen = true;
            sidebar.classList.add('open');
            backdrop.classList.add('show');
            document.body.style.overflow = 'hidden';
            
            // Force styles for mobile
            if (window.innerWidth < 1024) {
                sidebar.style.transform = 'translateX(0)';
                sidebar.style.position = 'fixed';
                sidebar.style.zIndex = '50';
            }
        }

        // Close sidebar (mobile) - Fixed
        function closeSidebar() {
            console.log('Closing sidebar'); // Debug log
            sidebarOpen = false;
            sidebar.classList.remove('open');
            backdrop.classList.remove('show');
            document.body.style.overflow = '';
            
            // Force styles for mobile
            if (window.innerWidth < 1024) {
                sidebar.style.transform = 'translateX(-100%)';
            }
        }

        // Toggle sidebar collapse (desktop)
        function toggleSidebar() {
            sidebarExpanded = !sidebarExpanded;
            
            if (sidebarExpanded) {
                sidebar.classList.remove('sidebar-collapsed');
                collapseIcon.classList.remove('rotated');
            } else {
                sidebar.classList.add('sidebar-collapsed');
                collapseIcon.classList.add('rotated');
            }
        }

        // Menu item clicked - Fixed color updates
        function menuItemClicked(itemId) {
            console.log('Menu item clicked:', itemId); // Debug log
            
            // Remove active class from all menu items
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Add active class to clicked item
            const clickedItem = document.getElementById(`menu-${itemId}`);
            if (clickedItem) {
                clickedItem.classList.add('active');
                console.log('Active class added to:', itemId); // Debug log
            }
            
            // Update current active tab
            currentActiveTab = itemId;
            
            // Force update colors
            updateMenuColors();
            
            // Close mobile sidebar after selection
            if (window.innerWidth < 1024) {
                setTimeout(() => {
                    closeSidebar();
                }, 300);
            }
            
            // Call Livewire method
            if (typeof Livewire !== 'undefined') {
                Livewire.emit('menuItemClicked', itemId);
            } else if (typeof window.livewire !== 'undefined') {
                window.livewire.call('menuItemClicked', itemId);
            }
        }

        // Force update menu colors
        function updateMenuColors() {
            document.querySelectorAll('.menu-item').forEach(item => {
                const spans = item.querySelectorAll('span');
                const svgPaths = item.querySelectorAll('svg path');
                
                if (item.classList.contains('active')) {
                    // Active item - white text
                    spans.forEach(span => {
                        span.style.color = 'white';
                        span.style.fontWeight = 'bold';
                    });
                    svgPaths.forEach(path => {
                        path.style.fill = 'white';
                        path.style.stroke = 'white';
                    });
                } else {
                    // Inactive item - green text
                    spans.forEach(span => {
                        span.style.color = '#005A06';
                        span.style.fontWeight = 'normal';
                    });
                    svgPaths.forEach(path => {
                        path.style.fill = '#005A06';
                        path.style.stroke = '#005A06';
                    });
                }
            });
        }

        // Handle window resize
        function handleResize() {
            if (window.innerWidth >= 1024) {
                // Desktop view
                closeSidebar();
                document.body.style.overflow = '';
                sidebar.style.position = 'static';
                sidebar.style.transform = 'translateX(0)';
            } else {
                // Mobile/tablet view
                sidebar.style.position = 'fixed';
                if (!sidebarOpen) {
                    sidebar.style.transform = 'translateX(-100%)';
                }
            }
        }

        // Handle escape key
        function handleEscape(event) {
            if (event.key === 'Escape' && sidebarOpen) {
                closeSidebar();
            }
        }

        // Handle clicks outside sidebar
        function handleClickOutside(event) {
            if (sidebarOpen && !sidebar.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                closeSidebar();
            }
        }

        // Set active menu item
        function setActiveMenuItem(itemId) {
            // Remove active class from all items
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Add active class to specified item
            const activeItem = document.getElementById(`menu-${itemId}`);
            if (activeItem) {
                activeItem.classList.add('active');
            }
            
            // Force update colors
            updateMenuColors();
        }

        // Initialize event listeners
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing sidebar'); // Debug log
            
            // Set initial active state
            setActiveMenuItem(currentActiveTab);
            
            // Window resize
            window.addEventListener('resize', handleResize);
            
            // Escape key
            document.addEventListener('keydown', handleEscape);
            
            // Click outside
            document.addEventListener('click', handleClickOutside);
            
            // Initial screen size setup
            handleResize();
            
            // Handle touch events for mobile swipe
            let touchStartX = 0;
            let touchEndX = 0;
            
            sidebar.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            });
            
            sidebar.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            });
            
            function handleSwipe() {
                const swipeDistance = touchStartX - touchEndX;
                const minSwipeDistance = 100;
                
                // Swipe left to close
                if (swipeDistance > minSwipeDistance && sidebarOpen) {
                    closeSidebar();
                }
            }
        });

        // Update active state when Livewire updates
        document.addEventListener('livewire:load', function () {
            Livewire.hook('message.processed', (message, component) => {
                // Update active state after Livewire processes
                const newTabId = component.data.tab_id;
                if (newTabId !== undefined) {
                    setActiveMenuItem(newTabId);
                    currentActiveTab = newTabId;
                }
            });
        });

        // Responsive behavior
        function updateSidebarForScreenSize() {
            const isDesktop = window.innerWidth >= 1024;
            
            if (isDesktop) {
                // Desktop behavior
                sidebar.style.position = 'static';
                sidebar.style.transform = 'translateX(0)';
                backdrop.style.display = 'none';
                mobileMenuBtn.style.display = 'none';
            } else {
                // Mobile/tablet behavior
                sidebar.style.position = 'fixed';
                backdrop.style.display = 'block';
                mobileMenuBtn.style.display = 'block';
                
                if (!sidebarOpen) {
                    sidebar.style.transform = 'translateX(-100%)';
                }
            }
        }

        // Call on load and resize
        window.addEventListener('load', updateSidebarForScreenSize);
        window.addEventListener('resize', updateSidebarForScreenSize);

        // Smooth scroll to top when switching pages
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Add loading state management
        function showLoading(itemId) {
            const loadingElement = document.getElementById(`loading-${itemId}`);
            const iconElement = document.getElementById(`icon-${itemId}`);
            
            if (loadingElement && iconElement) {
                loadingElement.classList.remove('hidden');
                iconElement.classList.add('hidden');
            }
        }

        function hideLoading(itemId) {
            const loadingElement = document.getElementById(`loading-${itemId}`);
            const iconElement = document.getElementById(`icon-${itemId}`);
            
            if (loadingElement && iconElement) {
                loadingElement.classList.add('hidden');
                iconElement.classList.remove('hidden');
            }
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            // Alt + M to toggle mobile menu
            if (e.altKey && e.key === 'm') {
                e.preventDefault();
                if (window.innerWidth < 1024) {
                    if (sidebarOpen) {
                        closeSidebar();
                    } else {
                        openSidebar();
                    }
                }
            }
            
            // Alt + C to toggle collapse (desktop)
            if (e.altKey && e.key === 'c') {
                e.preventDefault();
                if (window.innerWidth >= 1024) {
                    toggleSidebar();
                }
            }
        });

        // Auto-hide mobile menu on orientation change
        window.addEventListener('orientationchange', function() {
            setTimeout(() => {
                if (window.innerWidth >= 1024) {
                    closeSidebar();
                }
                updateSidebarForScreenSize();
            }, 100);
        });

        // Focus management for accessibility
        function manageFocus() {
            const firstMenuItem = sidebar.querySelector('.menu-item');
            if (firstMenuItem && sidebarOpen) {
                firstMenuItem.focus();
            }
        }

        // Performance optimization: throttle resize events
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(handleResize, 100);
        });

        // Add visual feedback for touch devices
        if ('ontouchstart' in window) {
            document.querySelectorAll('.menu-item').forEach(item => {
                item.addEventListener('touchstart', function() {
                    this.style.transform = 'scale(0.98)';
                });
                
                item.addEventListener('touchend', function() {
                    this.style.transform = 'scale(1)';
                });
            });
        }

        // Debug function to check sidebar state
        function debugSidebarState() {
            console.log('Sidebar open:', sidebarOpen);
            console.log('Sidebar classes:', sidebar.className);
            console.log('Sidebar transform:', sidebar.style.transform);
            console.log('Current active tab:', currentActiveTab);
        }

        // Make debug function available globally
        window.debugSidebarState = debugSidebarState;
    </script>
</div>