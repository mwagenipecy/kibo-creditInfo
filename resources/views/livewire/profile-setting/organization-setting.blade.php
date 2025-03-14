<div class="accordion-body py-4 px-5">

    <div class="flex justify-between">
        <div class="flex justify-between gap-4">

        </div>

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

{{--        @endforeach--}}
        <div>
            <label class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Settings Status</label>
            <label for="sub_product_status" class="relative inline-flex items-center mb-2 cursor-pointer">
                <input type="checkbox" wire:modal="settings_status" id="sub_product_status" class="sr-only peer" >
                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300
                                         dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full
                                         peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5
                                         after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full
                                          after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Active</span>
            </label>

        </div>
    </div>


    <x-jet-section-border />

    <div class="flex gap-2">
        <div class="w-1/3" >
            <label for="currency" class="block mb-2 sm:text-xs  font-medium text-gray-900 dark:text-gray-400">Currency</label>
            <input disabled value="{{('TZS')}}" id="currency" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <x-jet-section-border />

            <div>
                <label for="disbursement_account" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300"> Client Registration Fees</label>
                <input wire:model="registration_fees" id="disbursement_account" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('registration_fees')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Registration fees is mandatory</p>
                </div>
                @enderror
            </div>
            <x-jet-section-border />
            <div>
                <label for="collection_account_loan_interest" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Allocated shares</label>
                <input wire:model="allocated_shares" id="collection_account_loan_interest" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('allocated_shares')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>allocated share  is mandatory</p>
                </div>
                @enderror
            </div>

            <x-jet-section-border />


            <div>
                <label for="collection_account_loan_principle" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Available shares</label>
                <input wire:model="available_shares" id="collection_account_loan_principle" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            </div>

            <x-jet-section-border />

            <div>
                <label for="collection_account_loan_charges" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Minimum shares</label>
                <input wire:model="min_shares" id="collection_account_loan_charges" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('min_shares')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Min value share  is mandatory</p>
                </div>
                @enderror
            </div>

            <x-jet-section-border />

            <div>
                <label for="collection_account_loan_penalties" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Value per shares</label>
                <input wire:model="value_per_share" id="collection_account_loan_penalties" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                @error('value_per_share')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Value per share  is mandatory</p>
                </div>
                @enderror
            </div>

            <x-jet-section-border />

        </div>

        <div class="w-1/3 border-l pl-2">

            <div>
                <label for="collection_account_loan_charges" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Institution Name</label>
                <input wire:model="institution_name" id="collection_account_loan_charges" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('institution_name')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Institution name  is mandatory</p>
                </div>
                @enderror
            </div>

            <x-jet-section-border />

            <div>
                <label for="collection_account_loan_charges" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Email</label>
                <input wire:model="email"  type="email" id="collection_account_loan_charges" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('email')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Email  is mandatory</p>
                </div>
                @enderror
            </div>

            <x-jet-section-border />
            <div>
                <label for="collection_account_loan_charges" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Phone Number</label>
                <input wire:model="phone_number" id="collection_account_loan_charges" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('phone_number')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Phone number  is mandatory</p>
                </div>
                @enderror
            </div>

            <x-jet-section-border />
            <div>
                <label for="collection_account_loan_charges" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Region</label>
                <input wire:modeldefer="institution.region" id="collection_account_loan_charges" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                @error('region')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>region  is mandatory</p>
                </div>
                @enderror
            </div>
            <x-jet-section-border />

            <div>
                <label for="collection_account_loan_charges" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Wilaya</label>
                <input wire:model="wilaya" id="collection_account_loan_charges" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-xs   rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('wilaya')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Wilaya  is mandatory</p>
                </div>
                @enderror
            </div>

            <x-jet-section-border />



            <label for="repayment_frequency" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Repayment Frequency</label>

            <div class="flex items-center mb-4">
                <input wire:model="repayment_frequency" id="create_during_registration" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
                <label for="create_during_registration" class="ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Monthly</label>
            </div>
            @error('repayment_frequency')
            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                <p>Repayment frequency  is mandatory</p>
            </div>
            @enderror



        </div>

        <div class="w-1/3 border-l pl-2">
            <x-jet-section-border />

            <label for="small-input" class="block mb-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">Set  Client inactive after</label>
            <fieldset>


                <div class="flex items-center mb-4">
                    <input wire:model="inactivity" id="inactivity_six_months"
                           type="radio" name="inactivity" value="6" class="w-4 h-4 border-gray-300 focus:ring-2
                                                    focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                    <label for="country-option-1" class="block ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">
                        6 month of inactivity
                    </label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model="inactivity" id="inactivity_twelve_months"
                           type="radio" name="inactivity" value="12" class="w-4 h-4 border-gray-300 focus:ring-2
                                                   focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="country-option-2" class="block ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">
                        12 months of inactivity
                    </label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model.defer="inactivity" id="inactivity_eighteen_months"
                           type="radio" name="inactivity" value="18" class="w-4 h-4 border-gray-300 focus:ring-2
                                                   focus:ring-blue-300 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="country-option-3" class="block ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">
                        18 months of inactivity
                    </label>
                </div>

                <div class="flex items-center mb-4">
                    <input wire:model.defer="inactivity" id="inactivity_twenty_four_months"
                           type="radio" name="inactivity" value="24" class="w-4 h-4 border-gray-300 focus:ring-2
                                                   focus:ring:blue-300 dark:focus-ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="country-option-4" class="block ml-2 sm:text-xs font-medium text-gray-900 dark:text-gray-300">
                        24 month of inactivity
                    </label>
                </div>

                @error('inactivity')
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                    <p>Client inactivation is mandatory</p>
                </div>
                @enderror


            </fieldset>


        </div>

    </div>

    <x-jet-section-border />

    <div class="mt-2"></div>


    <x-jet-label for="notes" value="{{ __('Notes') }}" />
    <textarea id="notes" name="notes" wire:model.defer="notes" rows="5" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your notes..."></textarea>
    @error('notes')
    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
        <p>Notes is mandatory, it should be more than three characters and unique.</p>
    </div>
    @enderror

    <div class="mt-2"></div>

    <div class="flex justify-end">
        <div >
            <div wire:loading.remove wire:target="institutionSetting">
                <button wire:click='institutionSetting' class="bg-red-500 text-white inline-flex items-center px-4 py-1 border border-solid rounded-md font-semibold transition" >
                    Save Product
                </button>
            </div>

            <div wire:loading wire:target="institutionSetting">
                <button type="button" class="bg-red-500 text-white inline-flex items-center px-4 py-1 border border-solid rounded-md font-semibold transition" disabled>

                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-6 w-6 mr-3 stroke-white" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>

                    Processing...
                </button>
            </div>


        </div>
    </div>

</div>
