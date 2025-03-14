<div>
    <div class="p-2">

        <!-- Welcome banner -->
        <div class="relative p-4 mb-2 overflow-hidden rounded-lg bg-white" >

            <!-- Background illustration -->
            <div class="absolute right-0 top-0 -mt-4 mr-16 pointer-events-none hidden xl:block" aria-hidden="true">
                <svg width="319" height="198" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <path id="welcome-a" d="M64 0l64 128-64-20-64 20z" />
                        <path id="welcome-e" d="M40 0l40 80-40-12.5L0 80z" />
                        <path id="welcome-g" d="M40 0l40 80-40-12.5L0 80z" />
                        <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="welcome-b">
                            <stop stop-color="#005A06" offset="0%" /> <!-- Dark Blue -->
                            <stop stop-color="#005A06" offset="100%" /> <!-- Light Blue -->
                        </linearGradient>
                        <linearGradient x1="50%" y1="24.537%" x2="50%" y2="100%" id="welcome-c">
                            <stop stop-color="#005A06" offset="0%" /> <!-- Light Blue -->
                            <stop stop-color="#005A06" stop-opacity="0" offset="100%" /> <!-- Dark Blue -->
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
                    <div class="text-xl text-green-800 font-bold mb-1 ">
                        SYSTEM USERS MANAGEMENT

                    </div>

                </div>
                <div>

                    <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-green-400 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            Total Registegreen Users: {{ App\Models\User::count() }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-green-400 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            Active Users:  {{App\Models\User::where('status',"ACTIVE")->count()}}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-green-400 dark:text-gray-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            Inactive Users:  <span>
                                <span class="ml-2 bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400"> {{App\Models\User::where('status','!=',"ACTIVE")->count()}} </span>
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
                        ['id' => 6, 'label' => '  Users'],
                        ['id' => 2, 'label' => 'Roles'],
                        ['id' => 1, 'label' => 'User Profile'],
                        ['id' => 10, 'label' => 'Password Policy'],

                    ];
                @endphp

                @foreach ($menuItems as $menuItem)
                    <button
                            wire:click="setView({{ $menuItem['id'] }})"
                            class="flex hover:text-white text-center items-center w-full
            @if ($this->tab_id == $menuItem['id']) bg-green-600 @else bg-gray-100 @endif
                            @if ($this->tab_id == $menuItem['id']) text-white font-bold @else text-gray-400 font-semibold @endif
                                    py-2 px-4 rounded-lg"

                            onmouseover="this.style.backgroundColor='#80ad83'; this.style.color='#333333';"
                            onmouseout="this.style.backgroundColor=''; this.style.color='';"
                    >

                        <div wire:loading wire:target="setView({{ $menuItem['id'] }})">
                            <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-900 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                        </div>
                        <div wire:loading.remove wire:target="setView({{ $menuItem['id'] }})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green"
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


                    @switch($this->tab_id)
                        @case('1')
                            <livewire:settings.profile/>
                            @break
                        @case('2')
                            <livewire:settings.user-groups/>
                            @break
                        @case('3')
                            <livewire:settings.create-user/>
                            @break
                        @case('4')
                            <livewire:settings.roles/>
                            @break
                        @case('5')
                            <livewire:settings.delete-user/>
                            @break

                         @case('10')
                <livewire:settings.password-policy/>
                           @break
                        @case('6')

                            <button wire:click="createNewUser" wire:loading.attr="disabled" class="bg-green-600 hover:bg-green-400 text-white font-bold py-2 px-4 rounded my-3">New User</button>

                            <livewire:settings.users/>
                            @break

                        @default
                            <livewire:settings.users/>
                    @endswitch
                </div>

            </div>





    <!-- Log Out Other Devices Confirmation Modal -->
    <x-jet-dialog-modal wire:model="showCreateNewUser">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">








            <div>
                @if (session()->has('message'))

                    @if (session('alert-class') == 'alert-success')
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
                @endif

                    <div class="w-full bg-white  p-4">

                        <div class="w-full">
                            <div class="mb-4">
                                <h5 >
                                    CREATE USER
                                </h5>
                            </div>


                            <div >
                                <div class="mb-4">
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-jet-label for="name" value="{{ __('Name') }}" />
                                        <input id="name" type="text" class="mt-1 block w-full " wire:model="name" autocomplete="name" />
                                        <x-jet-input-error for="name" class="mt-2" />
                                    </div>


                                </div>

                                <div class="mb-4">

                                    <div class="col-span-6 sm:col-span-4">
                                        <x-jet-label for="email" value="{{ __('E-Mail Address') }}" />
                                        <input id="email" type="email" class="mt-1 block w-full " wire:model="email" requigreen />
                                        <x-jet-input-error for="email" class="mt-2" />
                                    </div>


                                </div>

                                <div class="mb-4">

                                    <div class="col-span-6 sm:col-span-4">
                                        <x-jet-label for="phone_number" value="{{ __('Phone Number') }}" />
                                        <input id="phone_number" type="text" class="mt-1 block w-full " wire:model="phone_number" requigreen />
                                        <x-jet-input-error for="phone_number" class="mt-2" />
                                    </div>

                                </div>


                                <div class="form-group col-span-6 sm:col-span-4 mb-4">

                                    <x-jet-label for="department" value="{{ __('Select role') }}" />

                                    <select id="department" wire:model="department" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm sm:px-3 sm:text-sm h-10" requigreen>
                                        <option value="" selected>{{$this->departmentName}}</option>

                                        @foreach($this->departmentList as $department)
                                            <option value="{{$department->id}}">{{$department->department_name}}</option>

                                        @endforeach
                                    </select>
                                    @error('department')
                                    <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                        <p>Please select a role first.</p>
                                    </div>
                                    @enderror

                                </div>





                            </div>
                        </div>




                    </div>



            </div>



        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showCreateNewUser')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <div wire:loading.remove>
            <x-jet-button class="ml-3"
                          wire:click="createUser"
                          wire:loading.attr="disabled">
                {{ __('Create user') }}
            </x-jet-button>
            </div>
            <div wire:loading>
            <x-jet-button class="ml-3 "  >
                <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                </svg>
                Please wait...
            </x-jet-button>
            </div>

        </x-slot>
    </x-jet-dialog-modal>



    <!-- Log Out Other Devices Confirmation Modal -->
    <x-jet-dialog-modal wire:model="showDeleteUser">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">








            <div>
                @if (session()->has('message'))

                    @if (session('alert-class') == 'alert-success')
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
                    @if (session('alert-class') == 'alert-warning')
                        <div class="bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-yellow-900 px-4 py-3 shadow-md mb-8" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-yellow-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                    <p class="font-bold">Error</p>
                                    <p class="text-sm">{{ session('message') }} </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                <div class="flex w-full">
                    <!-- message container -->


                    <div class="w-full p-4 ">




                        @if($this->userSelected)




                            <p  class="block mb-1 text-sm capitalize text-slate-400 dark:text-white ">USER SELECTED</p>
                            <div class="flex items-center mb-2 text-sm spacing-sm text-slate-600 mt-2" >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <p>{{ App\Models\User::where('id', $this->userSelected)->value('name') }}</p>

                            </div>

                            <div class="mt-4 w-full">
                                <p for="userSelected" class="block mb-1 text-sm capitalize text-slate-400 dark:text-white ">SELECT ACTION</p>

                                <div class="flex gap-4 items-center text-center">
                                    <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="BLOCKED" checked  > Block
                                    <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="ACTIVE" /> Activate
                                    <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="DELETED" /> Delete
                                </div>



                            </div>



                            <p for="password" class="block mb-1 mt-4 text-sm capitalize text-slate-400 dark:text-white ">ENTER PASSWORD TO CONFIRM</p>
                            <input wire:model.defer="password" id="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                            <x-jet-input-error for="current_password" class="mt-2" />
                        @endif
                    </div>
                </div>
                <div class="mt-8"></div>
            </div>


        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showDeleteUser')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <div wire:loading.remove wire:target="confirmPassword" >
                <x-jet-button class="ml-3"
                              wire:click="confirmPassword"
                              wire:loading.attr="disabled">
                    {{ __('Proceed') }}
                </x-jet-button>
            </div>
            <div wire:loading wire:target="confirmPassword">
                <x-jet-button class="ml-3 "  >
                    <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    Please wait...
                </x-jet-button>
            </div>

        </x-slot>
    </x-jet-dialog-modal>




    <!-- Log Out Other Devices Confirmation Modal -->
    <x-jet-dialog-modal wire:model="showEditUser">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">











            <div>
                @if (session()->has('message'))

                    @if (session('alert-class') == 'alert-success')
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
                @endif


                    <div class="bg-white p-4">

                        <div class="mb-4">
                            <h5 >
                                ASSIGN NEW ROLE TO USER : {{\App\Models\User::where('id',$this->pendinguser)->value('name')}}
                            </h5>
                        </div>




                        @if($this->pendinguser)

                                <div class="form-group col-span-6 sm:col-span-4 mb-4">

                                    <x-jet-label for="department" value="{{ __('User Role') }}" />

                                    <select id="department" wire:model="department" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm sm:px-3 sm:text-sm h-10" requigreen>
                                        <option value="" selected>{{$this->department}}</option>

                                        @foreach($this->departmentList as $department)
                                            <option value="{{$department->id}}">{{$department->department_name}}</option>

                                        @endforeach
                                    </select>
                                    @error('department')
                                    <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                        <p>Please select a department first.</p>
                                    </div>
                                    @enderror

                                </div>

                        @endif

                    </div>
            </div>

















        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showEditUser')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <div wire:loading.remove wire:target="saveRole" >
                <x-jet-button class="ml-3"
                              wire:click="saveRole"
                              wire:loading.attr="disabled">
                    {{ __('Proceed') }}
                </x-jet-button>
            </div>
            <div wire:loading wire:target="saveRole">
                <x-jet-button class="ml-3 "  >
                    <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    Please wait...
                </x-jet-button>
            </div>

        </x-slot>
    </x-jet-dialog-modal>


</div>


