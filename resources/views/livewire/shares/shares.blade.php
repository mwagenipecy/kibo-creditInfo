
<div>
    <div class="p-4">

        <!-- Welcome banner -->
        <div class="relative bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-2xl shadow-md shadow-gray-200">

            <!-- Content -->
            <div class="">
                <div class="flex items-center mb-2 space-x-2 text-sm font-semibold spacing-sm text-slate-600 h-auto">

                    <div>

                        <table class="min-w-full text-center text-sm font-light">
                            <thead>
                                <tr>
                                    <th>SHARES MANAGEMENT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="whitespace-nowrap font-medium text-left">Active Shares</td>
                                    <td class="whitespace-nowrap text-left">{{ $this->activeSharesCount }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap font-medium text-left">Inactive Shares</td>
                                    <td class="whitespace-nowrap text-left">{{ $this->inactiveSharesCount }}</td>
                                </tr>
                            </tbody>
                        </table>


                    </div>







                </div>



            </div>




        </div>



        <!-- Dashboard actions -->
        <div class="flex w-full mb-4 gap-2">

            <!-- Left: Avatars -->


            <div class="bg-white rounded-2xl shadow-md shadow-gray-200 w-full p-1 flex  items-center " style="height: 70px">


                <div class="inline-flex p-2" >

                        @if (in_array(23, session()->get('permissions')))
                            <button wire:click="showIssueNewSharesModal(2)" class="mr-4 flex text-center items-center @if($this->selected == 1) very-light-shade @else bg-gray-100  @endif @if($this->selected == 1) text-blue-400 font-bold  @else  text-gray-400 font-semibold   @endif  py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>

                                Issue new shares
                            </button>
                        @endif

                        @if (in_array(23, session()->get('permissions')))
                            <button wire:click="showAddSharesAccountModal(1) " class="mr-4 flex text-center items-center @if($this->selected == 2) very-light-shade @else bg-gray-100  @endif @if($this->selected == 2) text-blue-400 font-bold  @else  text-gray-400 font-semibold   @endif  py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>

                                New shares account
                            </button>
                        @endif







                </div>



            </div>





            <!-- Right: Actions -->


        </div>


        <div class="bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-2xl shadow-md shadow-gray-200">

            <div class="tab-pane fade " id="tabs-homeJustify"
                 role="tabpanel" aria-labelledby="tabs-home-tabJustify">
                <div class="mt-2"></div>
                <div class="w-full flex items-center justify-center">
                    <div wire:loading wire:target="setView">
                        <div class="h-96 m-auto flex items-center justify-center">
                            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
                        </div>
                    </div>
                </div>



                <livewire:shares.shares-list-by-product/>

            </div>



        </div>


    </div>










<!-- Log Out Other Devices Confirmation Modal -->
<x-jet-dialog-modal wire:model="showCreateNewSharesAccount">
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
                                CREATE SharesAccount
                            </h5>
                        </div>


                        <div class="col-span-6 sm:col-span-4 mb-4">


                            <p for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">SharesAccount Name</p>
                            <x-jet-input id="name" type="text" name="name" class="mt-1 block w-full" wire:model.defer="name" autofocus />
                            @error('name')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>The name is mandatory and should be more than three characters.</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>


                            <p for="region" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Region</p>
                            <x-jet-input id="region" name="region" type="text" class="mt-1 block w-full" wire:model.defer="region" autofocus />
                            @error('region')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>The region is mandatory and should be more than three characters.</p>
                            </div>
                            @enderror

                            <div class="mt-2"></div>

                            <p for="wilaya" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Wilaya</p>
                            <x-jet-input id="wilaya" name="wilaya" type="text" class="mt-1 block w-full" wire:model.defer="wilaya" autofocus />
                            @error('wilaya')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>The wilaya is mandatory and should be more than three characters.</p>
                            </div>
                            @enderror

                            <div class="mt-2"></div>

                            <p for="membershipNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Clientship Number</p>
                            <x-jet-input id="membershipNumber" name="membershipNumber" type="text" class="mt-1 block w-full" wire:model.defer="membershipNumber" autofocus />
                            @error('membershipNumber')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>The membership number is mandatory, it should be more than three characters and unique.</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>


                            <p for="parentSharesAccount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Parent SharesAccount</p>
                            <select wire:model.bounce="parentSharesAccount" name="parentSharesAccount" id="parentSharesAccount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Select</option>
                                @foreach(App\Models\SharesModel::all() as $SharesAccount)
                                <option value="{{$SharesAccount->id}}">{{$SharesAccount->name}}</option>
                                @endforeach

                            </select>
                            @error('parentSharesAccount')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>The Parent SharesAccount is mandatory.</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>

                        </div>






                    </div>




                </div>



        </div>



    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showCreateNewSharesAccount')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
        <div wire:loading.remove>
        <x-jet-button class="ml-3"
                      wire:click="submit"
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
<x-jet-dialog-modal wire:model="showDeleteSharesAccount">
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




                    @if($this->SharesAccountSelected)




                        <p  class="block mb-1 text-sm capitalize text-slate-400 dark:text-white ">SharesAccount SELECTED</p>
                        <div class="flex items-center mb-2 text-sm spacing-sm text-slate-600 mt-2" >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <p>{{ App\Models\SharesModel::where('id', $this->SharesAccountSelected)->value('name') }}</p>

                        </div>

                        <div class="mt-4 w-full">
                            <p for="SharesAccountSelected" class="block mb-1 text-sm capitalize text-slate-400 dark:text-white ">SELECT ACTION</p>

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
        <x-jet-secondary-button wire:click="$toggle('showDeleteSharesAccount')" wire:loading.attr="disabled">
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
<x-jet-dialog-modal wire:model="showEditSharesAccount">
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
                            EDIT SharesAccount : {{$this->pendingSharesAccountname}}
                        </h5>
                    </div>



                    @if($this->SharesAccount)

                    <div >

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="membershipNumber" value="{{ __('Clientship Number') }}" />
                            <x-jet-input id="membershipNumber" type="text" class="mt-1 block w-full" wire:model.defer="membershipNumber" disabled/>
                            <x-jet-input-error for="membershipNumber" class="mt-2" />
                        </div>
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="name" value="{{ __('SharesAccount Name') }}" />
                            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autocomplete="name" />

                            <x-jet-input-error for="name" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="region" value="{{ __('Region') }}" />
                            <x-jet-input id="region" type="text" class="mt-1 block w-full" wire:model.defer="region" autocomplete="region" />
                            <x-jet-input-error for="region" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="wilaya" value="{{ __('Wilaya') }}" />
                            <x-jet-input id="wilaya" type="text" class="mt-1 block w-full" wire:model.defer="wilaya" autocomplete="wilaya" />
                            <x-jet-input-error for="wilaya" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email" />
                            <x-jet-input-error for="email" class="mt-2" />
                        </div>



                    </div>


                    @endif

                </div>
        </div>



    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showEditSharesAccount')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
        <div wire:loading.remove wire:target="updateSharesAccount" >
            <x-jet-button class="ml-3"
                          wire:click="updateSharesAccount"
                          wire:loading.attr="disabled">
                {{ __('Proceed') }}
            </x-jet-button>
        </div>
        <div wire:loading wire:target="updateSharesAccount">
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
<x-jet-dialog-modal wire:model="showAddSharesAccount">
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
                           CREATE NEW SHARES ACCOUNT
                        </h5>
                    </div>



                    <div class="w-full">
                        <!-- message container -->
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
                        </div>


                        <div class="bg-gray-100 rounded px-6 rounded-lg shadow-sm  pt-4 pb-4 ">


                            <div class="flex items-stretch">

                                <div class="w-1/2 mr-2" >

                                    <p for="member" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select Client</p>
                                    <select wire:model.bounce="member" name="member" id="member" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected value="">Select</option>
                                        @foreach(App\Models\ClientsModel::all() as $members)
                                            <option value="{{$members->membership_number}}">{{$members->first_name}} {{$members->middle_name}} {{$members->last_name}}</option>
                                        @endforeach

                                    </select>
                                    @error('member')
                                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                        <p>Branch is mandatory.</p>
                                    </div>
                                    @enderror
                                    <div class="mt-2"></div>

                                    @if($this->member)
                                        <div class="flex justify-between">
                                            <p for="member" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Existing shares accounts</p>
                                            <div>
                                                @foreach(App\Models\AccountsModel::where('member_number',$this->member)->where('product_number','11')->get() as $account)
                                                    @php
                                                        $this->account_number = $account->account_number;
                                                    @endphp
                                                    <p class="block mb-2 text-sm font-medium text-red-500 dark:text-gray-400">{{$account->account_number}}</p>
                                                @endforeach
                                            </div>


                                        </div>

                                        <div class="mt-2"></div>
                                    @endif


                                    <p for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Product</p>
                                    <select wire:model.bounce="product" name="product" id="product" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected value="">Select</option>
                                        @foreach(App\Models\sub_products::where('product_id','11')->get() as $product)
                                            <option value="{{$product->sub_product_id}}">{{$product->sub_product_name}}</option>
                                        @endforeach

                                    </select>
                                    @error('product')
                                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                        <p>Branch is mandatory.</p>
                                    </div>
                                    @enderror
                                    <div class="mt-2"></div>


                                </div>



                            </div>



                        </div>


                    </div>




                </div>
        </div>



    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showAddSharesAccount')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
        <div wire:loading.remove wire:target="addSharesAccount" >
            <x-jet-button class="ml-3"
                          wire:click="addSharesAccount"
                          wire:loading.attr="disabled">
                {{ __('Proceed') }}
            </x-jet-button>
        </div>
        <div wire:loading wire:target="addSharesAccount">
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
<x-jet-dialog-modal wire:model="showIssueNewShares">
    <x-slot name="title">

    </x-slot>

    <x-slot name="content">











        <div class="w-full">
            <!-- message container -->
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
            </div>


            <div class="bg-gray-100 rounded px-6 rounded-lg shadow-sm  pt-4 pb-4 ">


                <div class="flex items-stretch">

                    <div class="w-1/2 mr-2" >

                        <p for="member" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select Client</p>
                        <select wire:model.bounce="member" name="member" id="member" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Select</option>
                            @foreach(App\Models\Clients::all() as $members)
                                <option value="{{$members->membership_number}}">{{$members->first_name}} {{$members->middle_name}} {{$members->last_name}}</option>
                            @endforeach

                        </select>
                        @error('member')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Branch is mandatory.</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>

                        @if($this->member)





                            <p for="member" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Share Account</p>


                            <table class="w-full">

                                @foreach(App\Models\AccountsModel::where('member_number',$this->member)->where('product_number','11')->get() as $account)
                                    @php
                                        $this->account_number = $account->account_number;
                                    @endphp

                                    <tr>
                                        <td class="text-left">
                                            <p class="block text-sm font-medium text-red-500 dark:text-gray-400 capitalize">
                                                {{strtolower(App\Models\sub_products::where('sub_product_id',$account->sub_product_number)->value('sub_product_name')) }}
                                            </p>
                                        </td>
                                        <td class="pl-4 text-right"><p class="block text-sm font-medium text-red-500 dark:text-gray-400"><p>{{$account->account_number}}</p></td>
                                        <td class="text-right">



                                            <div wire:loading wire:target="setAccount({{$account->account_number}})" >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-9 w-9 stroke-gray-400 rounded-full p-2" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                                </svg>
                                            </div>

                                            @if($this->accountSelected == $account->account_number)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-green-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                </svg>
                                            @else
                                                <div wire:loading.remove wire:target="setAccount({{$account->account_number}})">
                                                    <svg wire:click="setAccount({{$account->account_number}})" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                </div>
                                            @endif

                                        </td>
                                    </tr>

                                @endforeach



                            </table>


                        @endif

                        <div class="mt-2"></div>

                        @if($this->product)
                            <div class="flex justify-between">
                                <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Price per share</p>
                                @foreach(App\Models\sub_products::where('sub_product_id',$this->product)->get() as $product)
                                    @php
                                        $this->nominal_price = $product->nominal_price;
                                    @endphp
                                    <p class="block mb-2 text-sm font-medium text-red-500 dark:text-gray-400">{{number_format($product->nominal_price,2)}}</p>
                                @endforeach

                            </div>
                            <div class="flex justify-between">
                                {{--                                            $minimum_shares = App\Models\institutions::where('id',Session::get('institution_id'))->value('minimum_shares');--}}

                                <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Available shares for this user</p>
                                @php
                                            $minimum_shares = 200;
                                            $institution_total_shares = App\Models\issured_shares::where('institution_id',Session::get('institution_id'))->sum('number_of_shares');
                                            $user_number_of_shares = App\Models\issured_shares::where('member',$this->member)->sum('number_of_shares');


                                            if($user_number_of_shares > $minimum_shares ){

                                            $percent = $institution_total_shares/$user_number_of_shares *100;


                                            if($percent > 20 ){
                                                $this->sharesAvailable = 0;
                                            }else{
                                               $this->sharesAvailable = $percent;
                                            }

                                            }else{

                                               $this->sharesAvailable = $minimum_shares - $user_number_of_shares;
                                            }



                                @endphp
                                    <p class="block mb-2 text-sm font-medium text-red-500 dark:text-gray-400">
                                        {{$this->sharesAvailable }}


                                    </p>


                            </div>

                            <div class="mt-2"></div>


                        <x-jet-label for="number_of_shares" value="{{ __('Number of shares') }}" />
                        <x-jet-input id="number_of_shares" type="number" name="number_of_shares" class="mt-1 block w-full" wire:model="number_of_shares" autofocus />
                        @error('number_of_shares')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Number of shares is mandatory and should be more than two characters.</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>
                        @if($this->number_of_shares)
                            <div class="flex justify-between">
                                <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Total price</p>

                                <p class="block mb-2 text-sm font-medium text-red-500 dark:text-gray-400">{{number_format($this->number_of_shares * 20000,2)}}</p>
                            </div>

                            <div class="mt-2"></div>
                        @endif



                        <p for="linked_savings_account" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Purchase from linked Savings Account</p>
                        <select wire:model.bounce="linked_savings_account" name="linked_savings_account" id="linked_savings_account" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Select</option>

                            @foreach(App\Models\AccountsModel::where('member_number',$this->member)->where('product_number','12')->get() as $account)

                                <option value="{{$account->account_number}}">{{$account->account_number}}</option>
                            @endforeach

                        </select>
                        @error('product')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Linked Savings Account is mandatory.</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>


                        @if($this->linked_savings_account)
                            <div class="flex justify-between">
                                <p for="member" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Account balance</p>
                                @foreach(App\Models\AccountsModel::where('account_number',$this->linked_savings_account)->get() as $account)
                                    @php
                                        $this->balance = $account->balance;
                                    @endphp
                                    <p class="block mb-2 text-sm font-medium text-red-500 dark:text-gray-400">{{number_format($account->balance,2)}}</p>
                                @endforeach

                            </div>

                            <div class="mt-2"></div>
                        @endif


                    </div>



                </div>




                @endif

            </div>


        </div>









    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showIssueNewShares')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
        <div wire:loading.remove wire:target="issueShares" >
            <x-jet-button class="ml-3"
                          wire:click="issueShares"
                          wire:loading.attr="disabled">
                {{ __('Proceed') }}
            </x-jet-button>
        </div>
        <div wire:loading wire:target="issueShares">
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

