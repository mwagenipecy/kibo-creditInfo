<div>

    <style>
        .app-color{
            color:#005A06;
        }
        .app-bg-color{
            background: #005A06;
        }
        .app-bg-hover{
            background: #005A06;
        }
        .onhover :hover{
            text-decoration-color: whitesmoke;
        }
    </style>

    <div>
        <!-- Sidebar backdrop (mobile only) -->
        <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200 "
            :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'"
            aria-hidden="true"
            x-cloak
        ></div>
        <!-- Sidebar -->
        <div
            id="sidebar"
            class=" flex flex-col absolute z-40 left-0 top-0 lg:static
            lg:left-auto lg:top-auto lg:translate-x-0 h-screen
            overflow-y-scroll lg:overflow-y-auto no-scrollbar
            w-74 lg:w-30 lg:sidebar-expanded:!w-74 2xl:!w-74
            shrink-0 bg-white p-4 transition-all duration-200 ease-in-out border-r-2 border-gray-100"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'"
            @click.outside="sidebarOpen = false"
            @keydown.escape.window="sidebarOpen = false"
            x-cloak="lg">

            
            <!-- Sidebar header -->
            <div class="flex justify-between items-center pr-3 sm:px-2 items-center pr-3 sm:px-2 ">
                <!-- Close button -->
                <button class="lg:hidden text-slate-500 hover:text-slate-400" @click.stop="sidebarOpen = !sidebarOpen" aria-controls="sidebar" :aria-expanded="sidebarOpen">
                    <span class="sr-only">Close sidebar</span>
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
                    </svg>
                </button>
                <!-- Logo -->
                <a class="block  flex items-center " href="{{ route('CyberPoint-Pro') }}">
                    <img class="" src="{{ asset('/logo2.png') }}"
                         height="10" width="140" alt="logo" /> <!-- Set height to desigreen size, e.g. 30 pixels -->
                </a>
            </div>
            <!-- Links -->
            <div class="space-y-8">
                <!-- Pages group -->
                <div>
                    <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
                        <span class="lg:hidden lg:sidebar-expanded:block 2xl:block"></span>
                    </h3>
                    <ul class="mt-3">
                        <!-- Dashboard -->
                        <li id="reloadAll" class="px-3 py-2  onhover   rounded-lg mb-2 @if($this->tab_id == 0) app-bg-color text-white  hover:text-white @else  @endif cursor-pointer "  onmouseover="this.style.backgroundColor='#005A06'; this.style.color='#ffffff';" onmouseout="this.style.backgroundColor=''; this.style.color='';">
                                <div wire:click="menuItemClicked(0)" wire:loading.attr="disabled"  class="flex items-center justify-between block text-slate-200 hover:text-white truncate transition duration-150">
                                    <div class="flex items-center">
                                        <div wire:loading wire:target="menuItemClicked(0)">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6 spin">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                                            </svg>
                                        </div>
                                        <div wire:loading.remove wire:target="menuItemClicked(0)">
                                        <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                            <path class="fill-current @if($this->tab_id == 0) {{ 'text-white-200' }}@else{{ 'text-gray-100' }}@endif" d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0z" />
                                            <path class="fill-current @if($this->tab_id == 0){{ 'text-green-800' }}@else{{ 'text-green-800' }}@endif" d="M12 3c-4.963 0-9 4.037-9 9s4.037 9 9 9 9-4.037 9-9-4.037-9-9-9z" />
                                            <path class="fill-current @if($this->tab_id == 0){{ 'text-white-200' }}@else{{ 'text-gray-100' }}@endif" d="M12 15c-1.654 0-3-1.346-3-3 0-.462.113-.894.3-1.285L6 6l4.714 3.301A2.973 2.973 0 0112 9c1.654 0 3 1.346 3 3s-1.346 3-3 3z" />
                                        </svg>
                                        </div>
                                        <span class="text-sm hover:text-white  @if($this->tab_id == 0) text-white font-bold  @else  text-green-800 font-semibold   @endif  ml-3 ">Reception</span>
                                    </div>
                                    <!-- Icon -->
                                    <div class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    </div>
                                </div>
                        </li>


                        @foreach($this->menuItems as $item)

                            <li  class="px-3 py-2 rounded-lg mb-4 last:mb-0 @if($this->tab_id == $item) app-bg-color text-white  hover:text-white @else  @endif cursor-pointer " onmouseover="this.style.backgroundColor='#80ad83'; this.style.color='#ffffff';" onmouseout="this.style.backgroundColor=''; this.style.color='';" >
                                <div wire:click="menuItemClicked({{$item}})" wire:loading.attr="disabled" class="flex items-center justify-between text-slate-200 hover:text-white truncate transition duration-150">
                                    <div class="flex items-center">
                                        <div wire:loading wire:target="menuItemClicked({{$item}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6 spin">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                                            </svg>
                                        </div>

                                        <div wire:loading.remove wire:target="menuItemClicked({{$item}})" class="hover:text-white">



                                        @if($item == "1" )

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path class="@if($this->tab_id == $item) {{ 'text-white-500' }}@else{{ 'text-green-800 hover:text-white' }}@endif" stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                                </svg>

                                        @endif

                                        @if($item == "2" )
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    @if($this->tab_id == $item)
                                                    <path class="@if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-800' }}@endif" stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                    @else
                                                    <path class="text-green-800" stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                    @endif
                                                </svg>


                                            @endif

                                        @if($item == "3" )


                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 stroke-gray-400" width="24" height="24" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path class="@if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-600' }}@endif"  d="m20.749 12 1.104-1.908a1 1 0 0 0-.365-1.366l-1.91-1.104v-2.2a1 1 0 0 0-1-1h-2.199l-1.103-1.909a1.008 1.008 0 0 0-.607-.466.993.993 0 0 0-.759.1L12 3.251l-1.91-1.105a1 1 0 0 0-1.366.366L7.62 4.422H5.421a1 1 0 0 0-1 1v2.199l-1.91 1.104a.998.998 0 0 0-.365 1.367L3.25 12l-1.104 1.908a1.004 1.004 0 0 0 .364 1.367l1.91 1.104v2.199a1 1 0 0 0 1 1h2.2l1.104 1.91a1.01 1.01 0 0 0 .866.5c.174 0 .347-.046.501-.135l1.908-1.104 1.91 1.104a1.001 1.001 0 0 0 1.366-.365l1.103-1.91h2.199a1 1 0 0 0 1-1v-2.199l1.91-1.104a1 1 0 0 0 .365-1.367L20.749 12zM9.499 6.99a1.5 1.5 0 1 1-.001 3.001 1.5 1.5 0 0 1 .001-3.001zm.3 9.6-1.6-1.199 6-8 1.6 1.199-6 8zm4.7.4a1.5 1.5 0 1 1 .001-3.001 1.5 1.5 0 0 1-.001 3.001z"></path>
                                                </svg>

                                            @endif
                                        @if($item == "4" )

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 mr-2 ">
                                                    <path class="@if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-800' }}@endif" stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                </svg>


                                            @endif

                                        @if($item == "5" )


                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 ">
                                                    <path class="@if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-800' }}@endif" stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                </svg>



                                            @endif

                                        @if($item == "6" )

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 ">
                                                    <path class="@if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-800' }}@endif" stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                                                </svg>


                                            @endif
                                        @if($item == "7" )


                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                                    <path class="@if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-800' }}@endif" stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>



                                            @endif

                                        @if($item == "8" )

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 ">
                                                    <path class="@if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-800' }}@endif" stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>


                                            @endif

                                             @if($item == "9" )


                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                                    <path class="@if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-800' }}@endif" stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                </svg>



                                            @endif

                                             @if($item == "10" )


                                                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="inline-flex items-center justify-center h-6 w-6 text-lg @if( $tab_id == 15 ) text-blue-400 font-semibold @else text-gray-400 @endif ">
                                                    <path   class="fill-current @if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-600' }}@endif"   stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                                </svg>



                                            @endif

                                             @if($item == "11" )
                                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="inline-flex items-center justify-center h-6 w-6 text-lg @if( $tab_id == 11 ) text-blue-400 font-semibold @else text-gray-400 @endif ">
                                                    <path   class="fill-current @if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-600' }}@endif"   stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                                </svg>


                                            @endif

                                             @if($item == "12" )


                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 mr-2 @if( $tab_id == 11 ) stroke-blue-400 @else stroke-gray-400 @endif ">
                                                    <path  class="fill-current @if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-600' }}@endif"  stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                                                </svg>

                                            @endif
                                             @if($item == "13" )
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="inline-flex items-center justify-center h-6 w-6 text-lg @if( $tab_id == 14 ) text-blue-400 font-semibold @else text-gray-400 @endif ">
                                                    <path   class="fill-current @if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-600' }}@endif"   stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>


                                            @endif
                                             @if($item == "49" )
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 @if( $tab_id == 12 ) stroke-blue-400 @else stroke-gray-400 @endif " fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path   class="fill-current @if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-600' }}@endif"   d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V5h7v14H4zm9 0V5h7l.001 14H13z">
                                                    </path>
                                                    <path d="M15 7h3v2h-3zm0 4h3v2h-3z"></path>
                                                </svg>
                                            @endif


                                            @if($item == "16" )
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 @if( $tab_id == 16 ) stroke-blue-400 @else stroke-gray-400 @endif " fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path   class="fill-current @if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-600' }}@endif"
                                                            d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z">
                                                    </path>
                                                    <path d="M15 7h3v2h-3zm0 4h3v2h-3z"></path>
                                                </svg>
                                            @endif

                                            @if($item == "17" )
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 @if( $tab_id == 17 ) stroke-blue-400 @else stroke-gray-400 @endif " fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path   class="fill-current @if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-600' }}@endif"
                                                            d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125z">
                                                    </path>
                                                    <path d="M15 7h3v2h-3zm0 4h3v2h-3z"></path>
                                                </svg>
                                            @endif

                                            @if($item == "21" )
                                                <svg fill="none" class="h-5 w-5 mr-2 @if( $tab_id == 18 ) stroke-blue-400 @else stroke-gray-400 @endif "  stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <path class="fill-current  @if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-600' }}@endif " stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>

                                                </svg>
                                            @endif



                                            @if($item == "14" )
                                                <svg fill="none" class="h-5 w-5 mr-2 @if( $tab_id == 18 ) stroke-blue-400 @else stroke-gray-400 @endif "  stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <path class="fill-current    @if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-600' }}@endif  " stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>

                                                </svg>
                                            @endif

                                            @if($item == "18" )

                                                <svg    class="h-5 w-5 mr-2 @if( $tab_id == 18 ) stroke-blue-400 @else stroke-gray-400 @endif "  fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <path    class="fill-current @if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-600' }}@endif"   stroke-linecap="round" stroke-linejoin="round" d="M21.75 17.25v-.228a4.5 4.5 0 00-.12-1.03l-2.268-9.64a3.375 3.375 0 00-3.285-2.602H7.923a3.375 3.375 0 00-3.285 2.602l-2.268 9.64a4.5 4.5 0 00-.12 1.03v.228m19.5 0a3 3 0 01-3 3H5.25a3 3 0 01-3-3m19.5 0a3 3 0 00-3-3H5.25a3 3 0 00-3 3m16.5 0h.008v.008h-.008v-.008zm-3 0h.008v.008h-.008v-.008z"></path>
                                                </svg>
                                            @endif
                                            @if($item == "19" )
                                                <svg fill="none" class="h-5 w-5 mr-2 @if( $tab_id == 18 ) stroke-blue-400 @else stroke-gray-400 @endif "  stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <path  class="fill-current @if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-600' }}@endif" stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z"></path>
                                                </svg>
                                            @endif
                                             @if($item == "50" )
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 mr-2 @if( $tab_id == 13 ) stroke-blue-400 @else stroke-gray-400 @endif ">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                                                    <path   class="fill-current @if($this->tab_id == $item){{ 'text-white-500' }}@else{{ 'text-green-600' }}@endif"   stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <span class="text-sm   @if($this->tab_id == $item) text-white font-bold  @else  text-green-800 font-semibold  @endif ml-3  "  >{{ \App\Models\menus::where('ID', $item)->first()->menu_name  }} {{ $item }}  </span>
                                    </div>
                                    <!-- Icon -->
                                    <div class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">

                                    </div>
                                </div>


                            </li>

                       @endforeach



                    </ul>
                </div>

            </div>

            <!-- Expand / collapse button -->
            <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
                <div class="px-3 py-2">
                    <button @click="sidebarExpanded = !sidebarExpanded">
                        <span class="sr-only">Expand / collapse sidebar</span>
                        <svg class="w-6 h-6 fill-current sidebar-expanded:rotate-180" viewBox="0 0 24 24">
                            <path class="text-slate-400" d="M19.586 11l-5-5L16 4.586 23.414 12 16 19.414 14.586 18l5-5H7v-2z" />
                            <path class="text-slate-600" d="M3 23H1V1h2z" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>

</div>
