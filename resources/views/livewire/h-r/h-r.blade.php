<div class="p-4">
    <!-- sidebar 2 -->
{{--    welcome top bar --}}

    <div class="relative p-4 mb-2 overflow-hidden rounded-lg bg-white" >

        <!-- Background illustration -->
        <div class="absolute right-0 top-0 -mt-4 mr-16 pointer-events-none hidden xl:block" aria-hidden="true">
            <svg width="319" height="198" xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                    <path id="welcome-a" d="M64 0l64 128-64-20-64 20z" />
                    <path id="welcome-e" d="M40 0l40 80-40-12.5L0 80z" />
                    <path id="welcome-g" d="M40 0l40 80-40-12.5L0 80z" />
                    <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="welcome-b">
                        <stop stop-color="#e63b3d" offset="0%" /> <!-- Dark red -->
                        <stop stop-color="#e63b3d" offset="100%" /> <!-- Light red -->
                    </linearGradient>
                    <linearGradient x1="50%" y1="24.537%" x2="50%" y2="100%" id="welcome-c">
                        <stop stop-color="#e63b3d" offset="0%" /> <!-- Light red -->
                        <stop stop-color="#e63b3d" stop-opacity="0" offset="100%" /> <!-- Dark red -->
                    </linearGradient>
                </defs>
                <g fill="none" fill-rule="evenodd">
                    <g transform="rotate(64 36.592 105.604)">
                        <mask id="welcome-d" fill="#fff">
                            <use xlink:href="#welcome-a" />
                        </mask>
                        <use fill="url(#welcome-b)" xlink:href="#welcome-a" />
                        <path fill="url(#welcome-c)" mask="url(#welcome-d)" d="M64-24h80v152H64z" />
                    </g>
                    <g transform="rotate(-51 91.324 -105.372)">
                        <mask id="welcome-f" fill="#fff">
                            <use xlink:href="#welcome-e" />
                        </mask>
                        <use fill="url(#welcome-b)" xlink:href="#welcome-e" />
                        <path fill="url(#welcome-c)" mask="url(#welcome-f)" d="M40.333-15.147h50v95h-50z" />
                    </g>
                    <g transform="rotate(44 61.546 392.623)">
                        <mask id="welcome-h" fill="#fff">
                            <use xlink:href="#welcome-g" />
                        </mask>
                        <use fill="url(#welcome-b)" xlink:href="#welcome-g" />
                        <path fill="url(#welcome-c)" mask="url(#welcome-h)" d="M40.333-15.147h50v95h-50z" />
                    </g>
                </g>
            </svg>
        </div>

        <!-- Content -->
        <div class="relative w-full">
            <div class="min-w-full text-center text-sm font-light">
                <div class="text-xl text-slate-400 font-bold mb-1 ">
                    HUMAN RESOURCES MANAGEMENT

                </div>

            </div>
            <div>

                <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                    <li class="flex items-center">
                        <svg class="w-3.5 h-3.5 mr-2 text-red-400 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        Total employees: {{ App\Models\Employee::count() }}
                    </li>
                    <li class="flex items-center">
                        <svg class="w-3.5 h-3.5 mr-2 text-red-400 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        Total department: {{  App\Models\departmentsList::count() }}
                    </li>
                    <li class="flex items-center">
                        <svg class="w-3.5 h-3.5 mr-2 text-red-400 dark:text-gray-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        Pending department:  <span>
                                <span class="ml-2 bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400"> {{  App\Models\departmentsList::where('status','!=','ACTIVE')->count() }}</span>
                            </span>
                    </li>
                </ul>
            </div>

        </div>

    </div>



    <div class="bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-lg">

        <div class="grid grid-cols-6 gap-2 p-2">
            @php
                $menuItems = [
                    ['id' => 1, 'label' => ' Employees'],
                    ['id' => 3, 'label' => 'Departments'],
                    ['id' => 4, 'label' => 'PayRoll Management'],
                    ['id' => 5, 'label' => 'Leave'],
                    ['id' => 6, 'label' => 'Fiscal Policy'],
//                    ['id' => 7, 'label' => 'Employee Report'],

                ];
            @endphp

            @foreach ($menuItems as $menuItem)
                <button
                        wire:click="menuItemClicked({{ $menuItem['id'] }})"
                        class="flex hover:text-white text-center items-center w-full
            @if ($this->tab_id == $menuItem['id']) bg-red-500 @else bg-gray-100 @endif
                        @if ($this->tab_id == $menuItem['id']) text-white font-bold @else text-gray-400 font-semibold @endif
                                py-2 px-4 rounded-lg"

                        onmouseover="this.style.backgroundColor='#e63b3d'; this.style.color='#333333';"
                        onmouseout="this.style.backgroundColor=''; this.style.color='';"
                >

                    <div wire:loading wire:target="menuItemClicked({{ $menuItem['id'] }})">
                        <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-900 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                    </div>
                    <div wire:loading.remove wire:target="menuItemClicked({{ $menuItem['id'] }})">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red"
                             class="w-4 h-4 mr-2 fill-current">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>

                    </div>



                    {{ $menuItem['label'] }}
                </button>
            @endforeach
        </div>


        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

        <div class="tab-pane fade " id="tabs-homeJustify"
             role="tabpanel" aria-labelledby="tabs-home-tabJustify">
            <div class="mt-2"></div>
            <div class="w-full flex items-center justify-center">
                <div wire:loading wire:target="setView">
                    <div class="h-96 m-auto flex items-center justify-center">
                        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-white"></div>
                    </div>
                </div>
            </div>





        </div>




        <div class="h-16 border-b flex justify-between items-center w-full px-5 py-2 shadow-sm">
            <div class="flex items-center">
                <div wire:loading wire:target="menuItemClicked" >
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-gray-400" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                        </svg>
                        <p>Please wait...</p>
                    </div>
                </div>

                <div wire:loading.remove wire:target="menuItemClicked">
                    @if($this->tab_id==1)
                        @if (in_array( "Create and View employee" , session()->get('permission_items')))


                            <div class="grid grid-cols-6 gap-2 p-1">
                                @if (in_array( "Create and manage branches" , session()->get('permission_items')))

                                    @php
                                        $menuItems = [
                                            ['id' => 10, 'label' => ' New Employee'],];
                                    @endphp

                                    @foreach ($menuItems as $menuItem)
                                        <button
                                                wire:click="menuItemClicked({{ $menuItem['id'] }})"
                                                class="flex hover:text-white text-center items-center w-full
            @if ($this->tab_id == $menuItem['id']) bg-red-500 @else bg-gray-100 @endif
                                                @if ($this->tab_id == $menuItem['id']) text-white font-bold @else text-gray-400 font-semibold @endif
                                                        py-2 px-4 rounded-lg"

                                                onmouseover="this.style.backgroundColor='#e63b3d'; this.style.color='#333333';"
                                                onmouseout="this.style.backgroundColor=''; this.style.color='';"
                                        >

                                            <div wire:loading wire:target="menuItemClicked({{ $menuItem['id'] }})">
                                                <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-900 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                                </svg>
                                            </div>
                                            <div wire:loading.remove wire:target="menuItemClicked({{ $menuItem['id'] }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red"
                                                     class="w-4 h-4 mr-2 fill-current">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>

                                            </div>



                                            {{ $menuItem['label'] }}
                                        </button>
                                    @endforeach

                                @endif
                            </div>



{{--                            <button wire:click="menuItemClicked(10)" class="mr-4 flex text-center items-center bg-gray-100    py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />--}}
{{--                            </svg>--}}
{{--                            New Employee--}}
{{--                        </button>--}}


                        @endif

                    @endif
                    @if($this->tab_id==3)
                            @if (in_array( "Create and edit department" , session()->get('permission_items')))

                                <div class="grid grid-cols-6 gap-2 p-2">
                                    @if (in_array( "Create and manage branches" , session()->get('permission_items')))

                                        @php
                                            $menuItems = [
                                                ['id' => 30, 'label' => ' New Department'],];
                                        @endphp

                                        @foreach ($menuItems as $menuItem)
                                            <button
                                                    wire:click="menuItemClicked({{ $menuItem['id'] }})"
                                                    class="flex hover:text-white text-center items-center w-full
            @if ($this->tab_id == $menuItem['id']) bg-red-500 @else bg-gray-100 @endif
                                                    @if ($this->tab_id == $menuItem['id']) text-white font-bold @else text-gray-400 font-semibold @endif
                                                            py-2 px-4 rounded-lg"

                                                    onmouseover="this.style.backgroundColor='#e63b3d'; this.style.color='#333333';"
                                                    onmouseout="this.style.backgroundColor=''; this.style.color='';"
                                            >

                                                <div wire:loading wire:target="menuItemClicked({{ $menuItem['id'] }})">
                                                    <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-900 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                                    </svg>
                                                </div>
                                                <div wire:loading.remove wire:target="menuItemClicked({{ $menuItem['id'] }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red"
                                                         class="w-4 h-4 mr-2 fill-current">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                    </svg>

                                                </div>



                                                {{ $menuItem['label'] }}
                                            </button>
                                        @endforeach

                                    @endif
                                </div>



{{--                                <button wire:click="menuItemClicked(30)" class="mr-4 flex text-center items-center bg-gray-100    py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />--}}
{{--                            </svg>--}}
{{--                            --}}
{{--                        </button>--}}
                            @endif
                    @endif
                    @if($this->tab_id==6)
                            @if (in_array( "Create Fiscal" , session()->get('permission_items')))

                                <div class="grid grid-cols-6 gap-2 p-2">
                                    @if (in_array( "Create and manage branches" , session()->get('permission_items')))

                                        @php
                                            $menuItems = [
                                                ['id' => 60, 'label' => '   New'],];
                                        @endphp

                                        @foreach ($menuItems as $menuItem)
                                            <button
                                                    wire:click="menuItemClicked({{ $menuItem['id'] }})"
                                                    class="flex hover:text-white text-center items-center w-full
            @if ($this->tab_id == $menuItem['id']) bg-red-500 @else bg-gray-100 @endif
                                                    @if ($this->tab_id == $menuItem['id']) text-white font-bold @else text-gray-400 font-semibold @endif
                                                            py-2 px-4 rounded-lg"

                                                    onmouseover="this.style.backgroundColor='#e63b3d'; this.style.color='#333333';"
                                                    onmouseout="this.style.backgroundColor=''; this.style.color='';"
                                            >

                                                <div wire:loading wire:target="menuItemClicked({{ $menuItem['id'] }})">
                                                    <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-900 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                                    </svg>
                                                </div>
                                                <div wire:loading.remove wire:target="menuItemClicked({{ $menuItem['id'] }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red"
                                                         class="w-4 h-4 mr-2 fill-current">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                    </svg>

                                                </div>



                                                {{ $menuItem['label'] }}
                                            </button>
                                        @endforeach

                                    @endif
                                </div>


{{--                                <div class="flex justify-end  p-1 ">--}}
{{--                            <button wire:click="menuItemClicked(60)" class="mr-4 flex text-center items-center bg-gray-100    py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />--}}
{{--                                </svg>--}}
{{--                                New--}}
{{--                            </button>--}}
{{--                        </div>--}}
                            @endif
                    @endif

                    @if($this->tab_id==5)

                            <div class="grid grid-cols-6 gap-2 p-2">
                                @if (in_array( "Create and manage branches" , session()->get('permission_items')))

                                    @php
                                        $menuItems = [
                                            ['id' => 50, 'label' => '    Assign Selected'],];
                                    @endphp

                                    @foreach ($menuItems as $menuItem)
                                        <button
                                                wire:click="menuItemClicked({{ $menuItem['id'] }})"
                                                class="flex hover:text-white text-center items-center w-full
            @if ($this->tab_id == $menuItem['id']) bg-red-500 @else bg-gray-100 @endif
                                                @if ($this->tab_id == $menuItem['id']) text-white font-bold @else text-gray-400 font-semibold @endif
                                                        py-2 px-4 rounded-lg"

                                                onmouseover="this.style.backgroundColor='#e63b3d'; this.style.color='#333333';"
                                                onmouseout="this.style.backgroundColor=''; this.style.color='';"
                                        >

                                            <div wire:loading wire:target="menuItemClicked({{ $menuItem['id'] }})">
                                                <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-900 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                                </svg>
                                            </div>
                                            <div wire:loading.remove wire:target="menuItemClicked({{ $menuItem['id'] }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red"
                                                     class="w-4 h-4 mr-2 fill-current">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>

                                            </div>



                                            {{ $menuItem['label'] }}
                                        </button>
                                    @endforeach

                                @endif
                            </div>


{{--                            <div class="flex justify-end  p-1 ">--}}
{{--                            <button wire:click="menuItemClicked(50)" class="mr-4 flex text-center items-center bg-gray-100    py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />--}}
{{--                                </svg>--}}
{{--                                Assign Selected--}}
{{--                            </button>--}}
{{--                        </div>--}}
                    @endif



                </div>
                <p class="font-semibold ml-3 text-slate-600">{{$this->title}}</p>
            </div>
            @if($this->tab_id==4)

                <div class="grid grid-cols-6 gap-2 p-2">
                    @if (in_array( "Create and manage branches" , session()->get('permission_items')))

                        @php
                            $menuItems = [
                                ['id' => 40, 'label' => 'Pay All'],];
                        @endphp

                        @foreach ($menuItems as $menuItem)
                            <button
                                    wire:click="menuItemClicked({{ $menuItem['id'] }})"
                                    class="flex hover:text-white text-center items-center w-full
            @if ($this->tab_id == $menuItem['id']) bg-red-500 @else bg-gray-100 @endif
                                    @if ($this->tab_id == $menuItem['id']) text-white font-bold @else text-gray-400 font-semibold @endif
                                            py-2 px-4 rounded-lg"

                                    onmouseover="this.style.backgroundColor='#e63b3d'; this.style.color='#333333';"
                                    onmouseout="this.style.backgroundColor=''; this.style.color='';"
                            >

                                <div wire:loading wire:target="menuItemClicked({{ $menuItem['id'] }})">
                                    <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-900 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                    </svg>
                                </div>
                                <div wire:loading.remove wire:target="menuItemClicked({{ $menuItem['id'] }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red"
                                         class="w-4 h-4 mr-2 fill-current">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>

                                </div>



                                {{ $menuItem['label'] }}
                            </button>
                        @endforeach

                    @endif
                </div>


{{--                <div class="flex justify-end ">--}}
{{--                    <button wire:click="menuItemClicked(40)" class="mr-4 flex text-center items-center bg-gray-100    py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />--}}
{{--                        </svg>--}}
{{--                        Pay All--}}
{{--                    </button>--}}
{{--                </div>--}}


            @endif
        </div>


                @if($this->tab_id == 1 )
                    @switch($this->sub_menu_id)
                        @case('1')
                            <livewire:h-r.employees-list/>
                            @break
                        @case('2')
                <div>
                    {{-- Nothing in the world is as soft and yielding as water. --}}
                    <div class=" p-4">
                        <div class="flex items-center space-x-5" hidden>

                            <svg xmlns="http://www.w3.org/2000/svg" wire:click="homeButton()" class="cursor-pointer h-12 bg-slate-50 rounded-full stroke-red-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                            <div class="text-uppercase fw-bold">
                                Back
                            </div>
                        </div>
                    </div>
                    <div class="w-4/6 flex">

                        <div class="w-full">
                            <!-- message container -->
                            <div>
                                @if (session()->has('message'))

                                    {{--                    @if (session('alert-class') == 'alert-success')--}}
                                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                        <div class="flex">
                                            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                            <div>
                                                <p class="font-bold">The process is completed</p>
                                                <p class="text-sm">{{ session('message') }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                    @endif--}}
                                @endif
                            </div>


                            <div class="bg-gray-100 rounded px-6 rounded-lg shadow-sm  pt-4 pb-4 ">




                                <form wire:submit.prevent="save">


                                    <div class="flex justify-center m-8">
                                        <div class="max-w-2xl rounded-lg shadow-sm bg-gray-50">
                                            <div class="m-4">

                                                <section class="bg-white-300 flex flex-col items-center justify-center">
                                                    @if ($photo)
                                                        <img class="object-fill w-2/9  max-h-20 " src="{{ $photo->temporaryUrl() }}">
                                                    @endif
                                                </section>




                                                <div class="flex items-center justify-center w-full">



                                                    <label class="flex flex-col w-full h-19 hover:bg-gray-100 hover:border-gray-300">
                                                        <div class="flex flex-col items-center justify-center pt-7">

                                                            <div wire:loading wire:target="photo" class="" >

                                                                <svg style="width: 50%; margin: 0 auto;" xmlns="http://www.w3.org/2000/svg" class="animate-spin  w-8 h-8 text-gray-400 group-hover:text-gray-600" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                                                </svg>
                                                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">Please wait...</p>

                                                            </div>

                                                            <div wire:loading.remove wire:target="photo" class="flex flex-col items-center justify-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400 group-hover:text-gray-600"
                                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                                </svg>
                                                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                                    Attach member image</p>

                                                            </div>

                                                        </div>
                                                        <input type="file" class="opacity-0" wire:model="photo"/>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    @error('photo') <span class="error">{{ $message }}</span> @enderror
                                </form>
                                <div class="flex items-stretch">
                                    <div class="w-1/2 mr-2" >
                                        <p for="branch" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Branch</p>
                                        <select wire:model="branch" name="branch" id="branch" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                                            <option value="" selected>Select</option>
                                            @foreach(DB::table('branches')->get() as $branch)
                                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('branch')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>Branch is mandatory.</p>
                                        </div>
                                        @enderror
                                        <div class="mt-2"></div>

                                        <p for="branch" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Department</p>
                                        <select wire:model="department" name="branch" id="branch" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                                            <option value="" selected>Select</option>
                                            @foreach(DB::table('departments')->get() as $branch)
                                                <option value="{{$branch->id}}">{{$branch->department_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('branch')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>Branch is mandatory.</p>
                                        </div>
                                        @enderror
                                        <div class="mt-2"></div>
                                        <p for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">First Name</p>
                                        <x-jet-input id="first_name" type="text" name="first_name" class="mt-1 block w-full" wire:model.defer="first_name" autofocus />
                                        @error('first_name')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>The first name is mandatory and should be more than three characters.</p>
                                        </div>
                                        @enderror
                                        <div class="mt-2"></div>
                                        <p for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Job Title</p>
                                        <x-jet-input id="job_title" type="text" name="job_title" class="mt-1 block w-full" wire:model.defer="job_title" autofocus />
                                        @error('job_title')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>The first name is mandatory and should be more than three characters.</p>
                                        </div>
                                        @enderror
                                        <div class="mt-2"></div>

                                        <x-jet-label for="middle_name" value="{{ __('Middle Name') }}" />
                                        <x-jet-input id="middle_name" name="middle_name" type="text" class="mt-1 block w-full" wire:model.defer="middle_name" autofocus />
                                        @error('middle_name')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>The middle name is mandatory and should be more than three characters.</p>
                                        </div>
                                        @enderror

                                        <div class="mt-2"></div>
                                        <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
                                        <x-jet-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" wire:model.defer="last_name" autofocus />
                                        @error('last_name')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>The last name is mandatory and should be more than three characters.</p>
                                        </div>
                                        @enderror

                                        <div class="mt-2"></div>
                                        <x-jet-label for="address" value="{{ __('Address') }}" />
                                        <x-jet-input id="address" name="address" type="text" class="mt-1 block w-full" wire:model.defer="address" autofocus />
                                        @error('address')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>Address is mandatory, it should be more than three characters and unique.</p>
                                        </div>
                                        @enderror
                                        <div class="mt-2"></div>

                                        <x-jet-label for="street" value="{{ __('Street') }}" />
                                        <x-jet-input id="street" name="street" type="text" class="mt-1 block w-full" wire:model.defer="street" autofocus />
                                        @error('street')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>Street is mandatory, it should be more than three characters and unique.</p>
                                        </div>
                                        @enderror
                                        <div class="mt-2"></div>



                                        <x-jet-label for="next_of_kin_name" value="{{ __('Next of kin full name') }}" />
                                        <x-jet-input id="next_of_kin_name" type="text" name="next_of_kin_name" class="mt-1 w-full" wire:model.defer="next_of_kin_name" autofocus />
                                        @error('next_of_kin_name')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>Date of birth is mandatory.</p>
                                        </div>
                                        @enderror
                                        <div class="mt-2"></div>

                                        <x-jet-label for="next_of_kin_phone" value="{{ __('Next of kin phone number') }}" />
                                        <x-jet-input id="next_of_kin_phone" type="text" name="next_of_kin_phone" class="mt-1 w-full" wire:model.defer="next_of_kin_phone" autofocus />
                                        @error('next_of_kin_phone')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>Date of birth is mandatory.</p>
                                        </div>
                                        @enderror
                                        <div class="mt-2"></div>
                                    </div>
                                    <div class="w-1/2 ml-2" >

                                        <x-jet-label for="gender" value="{{ __('Gender') }}" />
                                        <select wire:model.bounce="gender" name="gender" id="gender" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                                            <option selected value="">Select</option>
                                            <option  value="Male">Male</option>
                                            <option  value="Female">Female</option>
                                            <option  value="Other">Other</option>

                                        </select>
                                        @error('gender')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>Gender is mandatory.</p>
                                        </div>
                                        @enderror
                                        <div class="mt-2"></div>

                                        <x-jet-label for="marital_status" value="{{ __('Marital status') }}" />
                                        <select wire:model.bounce="marital_status" name="marital_status" id="marital_status" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                                            <option selected value="">Select</option>
                                            <option  value="Married">Married</option>
                                            <option  value="Single">Single</option>
                                            <option  value="Divorced">Divorced</option>
                                            <option  value="Widow">Widow</option>

                                        </select>
                                        @error('marital_status')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>Marital status is mandatory.</p>
                                        </div>
                                        @enderror
                                        <div class="mt-2"></div>

                                        <x-jet-label for="date_of_birth" value="{{ __('Date of birth') }}" />
                                        <x-jet-input id="date_of_birth" type="date" name="date_of_birth" class="mt-1 w-full" wire:model.defer="date_of_birth" autofocus />
                                        @error('date_of_birth')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>Date of birth is mandatory.</p>
                                        </div>
                                        @enderror
                                        <div class="mt-2"></div>

                                        <x-jet-label for="place_of_birth" value="{{ __('Place of birth') }}" />
                                        <x-jet-input id="place_of_birth" type="text" name="place_of_birth" class="mt-1 w-full" wire:model.defer="place_of_birth" autofocus />
                                        @error('place_of_birth')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>Place of birth is mandatory.</p>
                                        </div>
                                        @enderror
                                        <div class="mt-2"></div>

                                        <x-jet-label for="tin_number" value="{{ __('TIN Number') }}" />
                                        <x-jet-input id="tin_number" type="text" name="tin_number" class="mt-1 w-full" wire:model.defer="tin_number" autofocus />
                                        @error('tin_number')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>TIN Number is mandatory.</p>
                                        </div>
                                        @enderror
                                        <div class="mt-2"></div>

                                        <x-jet-label for="nida_number" value="{{ __('NIDA Number') }}" />
                                        <x-jet-input id="nida_number" type="text" name="nida_number" class="mt-1 w-full" wire:model.defer="nida_number" autofocus />
                                        @error('nida_number')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>NIDA Number is mandatory.</p>
                                        </div>
                                        @enderror




                                        <div class="mt-2"></div>


                                        <x-jet-label for="phone_number" value="{{ __('Phone number') }}" />
                                        <x-jet-input id="phone_number" type="text" name="phone_number" class="mt-1 w-full" wire:model.defer="phone_number" autofocus />
                                        @error('phone_number')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>Phone number is mandatory and should be more than three characters.</p>
                                        </div>
                                        @enderror
                                        <div class="mt-2"></div>
                                        <x-jet-label for="notes" value="{{ __('Notes') }}" />
                                        <textarea id="notes" name="notes" wire:model.defer="notes" rows="5" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Your notes..."></textarea>
                                        @error('notes')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>Notes is mandatory, it should be more than three characters and unique.</p>
                                        </div>
                                        @enderror
                                        <div class="mt-2"></div>
                                    </div>
                                </div>
                                <div class="flex justify-end w-auto" >
                                    <div wire:loading wire:target="editEmployeeData" >
                                        <button class="text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400" disabled>
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-white-800" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                                </svg>
                                                <p>Please wait...</p>
                                            </div>
                                        </button>
                                    </div>

                                </div>


                                <div class="flex justify-end w-auto" >
                                    <div wire:loading.remove wire:target="editEmployeeData" >
                                        <button wire:click="editEmployeeData" class="text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400">
                                            <p class="text-white">Proceed</p>
                                        </button>

                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>


                </div>


                @break
                        @case('3')
                            <livewire:h-r.veiw-employee/>
                            @break
                        @case('4')
                            <livewire:h-r.new-employee/>
                            @break
                    @endswitch


                    {{--            @if($this->employesRegisterModel==false)--}}
                    {{--                     @if($this->viewMemberDitails==false)--}}
                    {{--                           @if($this->editEmployeeStatus==false)--}}

                    {{--                              @else--}}
                    {{--                                  @endif--}}
                    {{--                            @else--}}

                    {{--                      @endif--}}
                    {{--                @else--}}

                    {{--                @endif--}}


                @endif


                @if($this->tab_id == 3 )
                    @if($this->employesRegisterModel==false)
                        <livewire:h-r.departments/>
                    @else
                        <livewire:h-r.register-department/>
                    @endif
                @endif

                @if($this->tab_id==4)
                    <livewire:h-r.pay-roll/>
                @endif
                @if($this->tab_id== 6)
                    <livewire:h-r.fiscal-category />
                @endif

                @if($this->tab_id==5)
                    <livewire:h-r.leave />
                @endif
                @if($this->tab_id==7)
                    <livewire:h-r.employee-report/>
                @endif


    @if($this->leave_register==true)
        <!-- Modal -->
        <div class="fixed z-10 inset-0 overflow-y-auto"  >
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-0"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <!-- Your form elements go here -->
                    <div class="p-4">
                        <div>
                            @if (session()->has('message'))
                                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                    <div class="flex">
                                        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                        <div>
                                            <p class="font-bold">The process is completed</p>
                                            <p class="text-sm">{{ session('message') }} </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="header-elements text-center justify-center font-bold  stroke-current">
                            <h3 class="fw-bold">
                                EDIT DEPARTMENT
                            </h3>
                        </div>

                        <x-jet-label for="leave_type" value="{{ __('Name ') }}" />
                        <x-jet-input id="category_amount" name="category_amount" type="text" class="mt-1 block w-full" value="{{ DB::table('employees')->where('employee_number',session()->get('employee_number_id'))->value('first_name') .'   '.DB::table('employees')->where('employee_number',session()->get('employee_number_id'))->value('last_name')}}" disabled autofocus />

                        <x-jet-label for="leave_type" value="{{ __('Leave  Type') }}" />
                        <select wire:model.defer="leave_type" name="leave_type" id="leave_type" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                            <option selected value="">Select ....</option>
                            <option  value="Maternity Leave">Maternity Leave</option>
                            <option  value="Annual Leave">Annual Leave</option>
                            <option  value="Paternity Leave">Paternity Leave</option>
                            <option  value="Sick Leave">Sick Leave</option>
                            <option  value="Special Leave<">Special Leave</option>
                        </select>

                        @error('leave_type')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Leave Type is mandatory.</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>
                        <x-jet-label for="start_date" value="{{ __('Start Date') }}" />
                        <x-jet-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" wire:model.defer="start_date" autofocus />
                        @error('start_date')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p> Start date is mandatory</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>

                        <x-jet-label for="end_date" value="{{ __('End Date') }}" />
                        <x-jet-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" wire:model.defer="end_date" autofocus />
                        @error('end_date')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p> End date  is mandatory</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>


                        <x-jet-label for="leave_description" value="{{ __('Description') }}" />
                        <textarea id="leave_description" name="leave_description" type="text" class="mt-1 block w-full" wire:model.defer="leave_description" autofocus >
                            </textarea>
                        @error('leave_description')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p> Description  is mandatory</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>


                    </div>
                    <!-- Add more form fields as needed -->
                    <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                        <button type="button" wire:click="register_modal()" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                            Cancel
                        </button>
                        <button type="submit" wire:click="assignLeave()" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                            Proceed
                        </button>
                    </div>
                </div>
            </div>
        </div>

    @endif


    {{--   start of editing modal--}}


    @if($this->openEditDepartmentModal==true)


        <div class="fixed z-10 inset-0 overflow-y-auto"  >
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-0"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <!-- Your form elements go here -->
                    <div class="p-4">
                        <div>
                            @if (session()->has('message'))
                                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                    <div class="flex">
                                        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                        <div>
                                            <p class="font-bold">The process is completed</p>
                                            <p class="text-sm">{{ session('message') }} </p>
                                        </div>
                                    </div>
                                </div>
                            @endif  @if (session()->has('message_fail'))
                                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                    <div class="flex">
                                        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                        <div>
                                            <p class="font-bold">The process has failed</p>
                                            <p class="text-sm">{{ session('message_fail') }} </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="header-elements text-center justify-center font-bold  stroke-current">
                            <h3 class="fw-bold">
                                ASSIGN EMPLOYEE LEAVE
                            </h3>
                        </div>



                        <x-jet-label for="Department_name" value="{{ __('Department_name') }}" />
                        <x-jet-input id="Department_name" name="Department_name" type="text" class="mt-1 block w-full"  wire:model.defer="department_name" autofocus />
                        @error('Department_name')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p> End date  is mandatory</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>


                    </div>
                    <!-- Add more form fields as needed -->
                    <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                        <button type="button" wire:click="$toggle('openEditDepartmentModal')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                            Cancel
                        </button>
                        <button type="submit" wire:click="assignLeave()" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                            Proceed
                        </button>
                    </div>
                </div>
            </div>
        </div>

    @endif
    {{--    end  of editing modal--}}



    {{--    start of  department delete modal--}}

    @if($this->deleteDepartmentModal==true)


        <div class="fixed z-10 inset-0 overflow-y-auto"  >
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-0"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <!-- Your form elements go here -->
                    <div class="p-4">
                        <div>
                            @if (session()->has('message'))
                                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                    <div class="flex">
                                        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                        <div>
                                            <p class="font-bold">The process is completed</p>
                                            <p class="text-sm">{{ session('message') }} </p>
                                        </div>
                                    </div>
                                </div>
                            @endif @if (session()->has('message_fail'))
                                <div class="bg-red-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                    <div class="flex">
                                        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                        <div>
                                            <p class="font-bold">The process is completed</p>
                                            <p class="text-sm">{{ session('message_fail') }} </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="header-elements text-center justify-center font-bold  stroke-current">
                            <h3 class="fw-bold">
                                ACTION DEPARTMENT
                            </h3>
                        </div>
                        <div class="p-4 m-4">
                            <div class="flex gap-4 items-center text-center">
                                <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="BLOCKED" checked  > Block
                                <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="ACTIVE" /> Activate
                                <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="DELETED" /> Delete
                            </div>
                        </div>

                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" name="password" type="password" class="mt-1 block w-full" wire:model.defer="password" autofocus />
                        @error('password')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p> Password  is mandatory</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>

                    </div>






                    <!-- Add more form fields as needed -->
                    <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                        <button type="button" wire:click="$toggle('deleteDepartmentModal')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                            Cancel
                        </button>
                        <button type="submit" wire:click="departmentAction()" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                            Proceed
                        </button>
                    </div>
                </div>
            </div>
        </div>

    @endif




    @if($this->deleteEmployeeModal==true)


        <div class="fixed z-10 inset-0 overflow-y-auto"  >
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-0"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <!-- Your form elements go here -->
                    <div class="p-4">
                        <div>
                            @if (session()->has('message'))
                                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                    <div class="flex">
                                        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                        <div>
                                            <p class="font-bold">The process is completed</p>
                                            <p class="text-sm">{{ session('message') }} </p>
                                        </div>
                                    </div>
                                </div>
                            @endif @if (session()->has('message_fail'))
                                <div class="bg-red-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                    <div class="flex">
                                        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                        <div>
                                            <p class="font-bold">The process is completed</p>
                                            <p class="text-sm">{{ session('message_fail') }} </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="header-elements text-center justify-center font-bold  stroke-current">
                            <h3 class="fw-bold">
                                ACTION EMPLOYEE
                            </h3>
                        </div>

                        <div class="border-teal-500 rounded-b text-teal-900 px-4 py-3  mt-4 ">
                            <tr>
                                <td class="font-light"> Name</td>
                            </tr>
                            <tr>
                                <td class="ml-8 font-bold"> {{DB::table('employees')->where('id',session()->get('deleteEmployeeModal'))->value('first_name')}}</td>
                            </tr>
                        </div>

                        <div class="p-4 m-4">
                            <div class="flex gap-4 items-center text-center">
                                <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="BLOCKED" checked  > Block
                                <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="ACTIVE" /> Activate
                                <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="DELETED" /> Delete
                            </div>
                        </div>

                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" name="password" type="password" class="mt-1 block w-full" wire:model.defer="password" autofocus />
                        @error('password')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p> Password  is mandatory</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>

                    </div>






                    <!-- Add more form fields as needed -->
                    <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                        <button type="button" wire:click="$toggle('deleteEmployeeModal')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                            Cancel
                        </button>
                        <button type="submit" wire:click="employeeAction()" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                            Proceed
                        </button>
                    </div>
                </div>
            </div>
        </div>

    @endif

    {{--    end of department modal--}}





</div>

</div>
