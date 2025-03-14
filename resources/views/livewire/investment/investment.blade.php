
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
                                <th>INSTITUTION INVESTMENT</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>




        </div>



        <!-- Dashboard actions -->
        <div class="flex w-full mb-4 gap-2">

            <!-- Left: Avatars -->

            @if (in_array( "Create New Investment" , session()->get('permission_items')))
            <div class="bg-white rounded-2xl shadow-md shadow-gray-200 w-full p-1 flex  items-center " style="height: 70px">


                <div class="inline-flex p-2" >


                        <button wire:click="showAddClientModal(2)" class="mr-4 flex text-center items-center @if($this->selected == 2) very-light-shade @else bg-gray-100  @endif @if($this->selected == 2) text-blue-400 font-bold  @else  text-gray-400 font-semibold   @endif  py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#B4E4FC'; this.style.color='#60A5FA';" onmouseout="this.style.backgroundColor=''; this.style.color='';">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>

                            Register New
                        </button>

                </div>
            </div>
            @endif




            <!-- Right: Actions -->


        </div>
        <div class="bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-2xl shadow-md shadow-gray-200">

                <livewire:investment.investment-table/>
{{--            @endif--}}

        </div>


    </div>




    <x-jet-dialog-modal wire:model="showCreateInvestmentModal">
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
                                CREATE NEW INVESTMENT
                            </h5>
                        </div>


                        <div class="col-span-6 sm:col-span-4 mb-4">


                            <p for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Investment Name</p>
                            <x-jet-input id="investment_name" type="text" name="investment_name" class="mt-1 block w-full" wire:model.defer="investment_name" autofocus />
                            @error('investment_name')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>The name is mandatory </p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>


                            <p for="region" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Investment Type</p>
                            <select id="investment_type" name="investment_type" type="text" class="mt-1 block w-full" wire:model.defer="investment_type" autofocus />
                               <option unselected> select here ...</option>
                                @foreach(DB::table('investment_types')->get() as $investment)
                                    <option value="{{$investment->id}}"> {{$investment->investment_type .'   ('.  $investment->investment_name .')'}}</option>
                                @endforeach
                            </select>
                            @error('investment_type')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>investment type is mandatory</p>
                            </div>
                            @enderror

                                <div class="mt-2"></div>


                            <p for="region" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Expense Account</p>
                            <select id="expense_account" name="expense_account" type="text" class="mt-1 block w-full" wire:model.defer="expense_account" autofocus />
                               <option unselected> select expense account ...</option>
                                @foreach(DB::table('Business_Expenses')->get() as $expense_account)
                                    <option value="{{$expense_account->account_code}}"> {{$expense_account->name}}</option>
                                @endforeach
                            </select>
                            @error('investment_type')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>investment type is mandatory</p>
                            </div>
                            @enderror

                            <div class="mt-2"></div>

                            <p for="investment_amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Investment Amount</p>
                            <x-jet-input id="investment_amount" name="investment_amount" type="text" class="mt-1 block w-full" wire:model.defer="investment_amount" autofocus />
                            @error('investment_amount')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Investment Amount</p>
                            </div>
                            @enderror
                                <div class="mt-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showCreateInvestmentModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            <div wire:loading.remove>
                <x-jet-button class="ml-3"
                              wire:click="createInvestment"
                              wire:loading.attr="disabled">
                    {{ __('Create Now') }}
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
</div>
