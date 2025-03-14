<div>
           <div class="p-4">
            <button wire:click="menuItemClick" class="mr-4 p-4  flex text-center items-center  text-blue-400 font-bold  bg-gray-100  text-gray-400 font-semibold   py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                 New Budget Item
            </button>
           </div>

    @if($this->new_budget_item)

        <div class="fixed z-10 inset-0 overflow-y-auto intro-y "  >
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-0"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle max-w-3/4  sm:max-w-lg sm:w-full">
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
                                CREATE CURRENT YEAR BUDGET
                            </h3>
                        </div>
                        <x-jet-label for="source_account_number" value="{{ __('Budget name') }}" />
                        <x-jet-input id="source_account_number" wire:model="budget_name" name="source_account_number"  type="text"  class="mt-1 block w-full"  autofocus />
                        @error('department_name')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p> Name is mandatory.</p>
                        </div>
                        @enderror
                        <x-jet-label for="source_account_number" value="{{ __('Revenue Projections') }}" />
                            <x-jet-input id="source_account_number" wire:model="revenue" name="source_account_number"  type="text"  class="mt-1 block w-full"  autofocus />
                            @error('department_name')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p> Name is mandatory.</p>
                            </div>
                            @enderror

                        <div class="mt-2"></div>
                        <x-jet-label for="destination_type" value="{{ __('Expenses') }}" />
                        <x-jet-input id="destination_account_number" wire:model=" " name="amount"  type="text"  class="mt-1 block w-full"  autofocus />
                        {{--                        <select wire:model=" " name="destination_type" id="destination_type" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--                            <option value=""  unselected >Select ....</option>--}}
{{--                            <option  value="BANK" >BANK</option>--}}
{{--                            <option  value="ACCOUNT" > Member Account</option>--}}
{{--                            <option  value="MOBILE" >MOBILE</option>--}}
{{--                        </select>--}}
                        @error('destination_type')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p> Amount is mandatory.</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>



                        <x-jet-label for="leave_description" value="{{ __('Loan Loss Provisions') }}" />
                        <x-jet-input id="destination_account_number" wire:model=" " name="amount"  type="text"  class="mt-1 block w-full"  autofocus />
                        @error('destination_account_number')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Account is mandatory </p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>


                        <x-jet-label for="leave_description" value="{{ __('Capital Expenditures') }}" />
                        <x-jet-input id="amount" wire:model="capital_expenditure" name="amount"  type="text"  class="mt-1 block w-full"  autofocus />
                        @error('amount')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p> Amount is mandatory.</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>

                        <x-jet-label for="leave_description" value="{{ __('Customer Acquisition and Retention:') }}" />
                        <x-jet-input id="action_date" wire:model=" " name="action_date"  type="text"  class="mt-1 block w-full"  autofocus />
                        @error('action_date')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p> date is required.</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>

                        <x-jet-label for="end_date" value="{{ __('Profitability Targets') }}" />
                        <x-jet-input id="end_date" wire:model=" " name="end_date"  type="text"  class="mt-1 block w-full"  autofocus />
                        @error('end_date')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>End date is required.</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>


                        <x-jet-label for="leave_description" value="{{ __('Description') }}" />
                        <textarea id="description" name="description" type="text" class="mt-1 block w-full" wire:model="notes" autofocus >
                            </textarea>
                        @error('description')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p> Description  is mandatory</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>
                    </div>
                    <!-- Add more form fields as needed -->
                    <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                        <button type="button" wire:click="$toggle('new_budget_item')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                            Cancel
                        </button>
                        <button type="submit" wire:click="save()" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                            Proceed
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="h-n10">
        <livewire:budjet-management.budget-item-table />

    </div>



    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
</div>
