<div>
    {{-- The Master doesn't talk, he acts. --}}

    <div>
        {{-- In work, do what you enjoy. --}}


            <div wire:loading.remove wire:target="menuItemClicked" class="mt-4   rounded-lg flex  ">
                <button wire:click="subMenuItemClicked" class="mr-4 ml-4 mt-4 flex text-center items-center @if( $this->tab_id == 4 ) very-light-shade text-blue-400 font-bold @else bg-gray-100  text-gray-400 font-semibold @endif  py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    New Inventory
                </button>
            </div>

            <div class="mt-2     mt-4   w-full  ">
                <livewire:procurement.inventory-table/>

            </div>




        {{--CREATE INVENTORY MANAGEMENT--}}
        <div class="w-full container-fluid">
            @if($this->createInventoryModal)
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
                                        CREATE INVENTORY
                                    </h3>
                                </div>

                                <x-jet-label for="item_name" value="{{ __('Inventory Name') }}" />
                                <x-jet-input id="item_name" name="item_name" type="text" class="mt-1 block w-full" wire:model="item_name"  autofocus />
                                @error('item_name')
                                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                    <p>Inventory name is mandatory.</p>
                                </div>
                                @enderror

                                <div class="mt-2"></div>
                                <x-jet-label for="item_amount" value="{{ __('Inventory Amount') }}" />
                                <x-jet-input id="item_amount" name="item_amount" type="text" class="mt-1 block w-full" wire:model.defer="item_amount" autofocus />
                                @error('item_amount')
                                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                    <p> Amount is mandatory</p>
                                </div>
                                @enderror

                                <div class="mt-2"></div>
                                <x-jet-label for="item_expiration_date" value="{{ __('Expiration Date') }}" />
                                <x-jet-input id="item_expiration_date" name="item_expiration_date" type="date" class="mt-1 block w-full" wire:model.defer="item_expiration_date" autofocus />
                                @error('item_expiration_date')
                                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                    <p> Expiration date  is mandatory</p>
                                </div>
                                @enderror


                                <div class="mt-2"></div>
                                <x-jet-label for="item_description" value="{{ __('Inventory Description') }}" />
                                <textarea id="item_description" name="leave_description" type="text" class="mt-1 block w-full" wire:model.defer="item_description" autofocus >
                                                </textarea>

                                <div class="mt-2"></div>
                            </div>
                            <!-- Add more form fields as needed -->
                            <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                                <button type="button" wire:click="$toggle('createInventoryModal')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                                    Cancel
                                </button>
                                <button type="submit" wire:click="createInventory" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                                    Proceed
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{--                                            <livewire:procurement.create-vendor/>--}}
            @endif
        </div>
        {{--  END OF INVENTORY MANAGEMENT--}}












        {{--Contract EDIT MODAL--}}

        <div class="w-full container-fluid">
            @if($this->editInventoryModalBoolean)
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
                                        EDIT INVENTORY
                                    </h3>
                                </div>
                                <div class="mt-2"></div>
                                <x-jet-label for="item_name" value="{{ __('Inventory Name') }}" />
                                <x-jet-input id="item_name" name="item_name" type="text" class="mt-1 block w-full" wire:model="item_name"  autofocus />
                                @error('item_name')
                                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                    <p>Inventory name is mandatory.</p>
                                </div>
                                @enderror
                                <div class="mt-2"></div>
                                <x-jet-label for="item_amount" value="{{ __('Inventory Amount') }}" />
                                <x-jet-input id="item_amount" name="item_amount" type="text" class="mt-1 block w-full" wire:model.defer="item_amount" autofocus />
                                @error('item_amount')
                                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                    <p> Amount is mandatory</p>
                                </div>
                                @enderror
                                <div class="mt-2"></div>
                                <x-jet-label for="item_expiration_date" value="{{ __('Expiration Date') }}" />
                                <x-jet-input id="item_expiration_date" name="item_expiration_date" type="date" class="mt-1 block w-full" wire:model.defer="item_expiration_date" autofocus />
                                @error('item_expiration_date')
                                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                    <p> Expiration date  is mandatory</p>
                                </div>
                                @enderror
                                <div class="mt-2"></div>
                                <x-jet-label for="item_description" value="{{ __('Inventory Description') }}" />
                                <textarea id="item_description" name="leave_description" type="text" class="mt-1 block w-full" wire:model.defer="item_description" autofocus >
                                                </textarea>
                                <div class="mt-2"></div>
                            </div>
                            <!-- Add more form fields as needed -->
                            <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                                <button type="button" wire:click="$toggle('editInventoryModalBoolean')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                                    Cancel
                                </button>
                                <button type="submit" wire:click="editInventory" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                                    Proceed
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{--                                            <livewire:procurement.create-vendor/>--}}
            @endif

        </div>

        {{--                            END EDIT MODAL--}}




        {{--delete  modal--}}
        <div class="w-full container-fluid">
            @if($this->deleteInventoryModal)
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

                                    @if (session()->has('message_fail'))
                                        <div class="bg-red-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                            <div class="flex">
                                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                                <div>
                                                    <p class="font-bold">The process is uncompleted</p>
                                                    <p class="text-sm">{{ session('message_fail') }} </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="header-elements text-center justify-center font-bold  stroke-current">
                                    <h3 class="fw-bold">
                                        DELETE INVENTORY
                                    </h3>
                                </div>
                                <div class="mt-5"> </div>
                                <div class="p-4 m-4">
                                    <div class="flex gap-4 items-center text-center">
                                        <input  wire:model="permission" name="setSubMenuPermission" type="checkbox" value="DELETE" class="
                                                       mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                    " /> Accept End
                                    </div>
                                </div>
                                @error('permission')
                                <div class="text-red-500">
                                    Accept before you proceed
                                </div>
                                @enderror
                                <div class="mt-2"></div>
                            </div>
                            <!-- Add more form fields as needed -->
                            <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                                <button type="button" wire:click="$toggle('deleteInventoryModal')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                                    Cancel
                                </button>
                                <button type="submit" wire:click="action" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                                    Proceed
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{--end delete  modal--}}

    </div>

</div>
