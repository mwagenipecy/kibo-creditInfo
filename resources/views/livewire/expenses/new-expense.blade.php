<div>
    {{-- Success is as dangerous as failure. --}}



        <div class=" bg-white rounded-lg">

        <div class="inline-flex p-2" >

            @if (in_array(22, session()->get('permissions')))
                <button wire:click="addExpensesModal" class="mr-4 flex text-center items-center @if($this->selected == 2) bg-red-600 @else bg-gray-100  @endif @if($this->selected == 2) text-red-400 font-bold  @else  text-gray-400 font-semibold   @endif  py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#f3f4f5'; this.style.color='#f3144f';" onmouseout="this.style.backgroundColor=''; this.style.color='';">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    New Expenses
                </button>
            @endif
        </div>

        <div class="mx-2 my-2">
            <livewire:expenses.expenses-table />
        </div>

    </div>


        <!-- Log Out Other Devices Confirmation Modal -->
        <x-jet-dialog-modal wire:model="showDeleteExpense">
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


                <p for="password" class="block mb-1 mt-4 text-sm capitalize text-slate-400 dark:text-white ">PLEASE CONFIRM</p>


        </div>

    </div>


                    <div class="mt-8"></div>






                </div>


            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('showDeleteExpense')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <div wire:loading.remove wire:target="confirmDeleteExpense" >
                    <x-jet-button class="ml-3"
                                  wire:click="confirmDeleteExpense"
                                  wire:loading.attr="disabled">
                        {{ __('CONFIRM') }}
                    </x-jet-button>
                </div>
                <div wire:loading wire:target="confirmDeleteExpense">
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
        <x-jet-dialog-modal wire:model="showAddExpense">
            <x-slot name="title">
            </x-slot>
            <x-slot name="content">
                <div>

                    <div>
                        @php
                            $unusedBudgetValue = 0;
                        @endphp
                        @if (session()->has('message'))
                            @if (session('alert-class') == 'alert-success')
                                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                    <div class="flex">
                                        <div class="py-1">
                                            <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-bold">The process is completed</p>
                                            <p class="text-sm">{{ session('message') }} </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                    <x-jet-section-border />

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="expense_category" value="{{ __('Expenses Category') }}" />

                        <select id="expense_category" wire:model="expense_category" class="form-input rounded-md shadow-sm mt-1 block w-full">
                            <option value="">Select a category...</option>

                              @foreach($this->category as $category)
                            <option value="{{ $category->category_name }}">
                                    <div class="py-3 sm:py-4">
                                        <div class="items-center space-x-4">

                                            <div class="min-w-0">
                                                <div class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    {{ $category->category_name }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </option>
                            @endforeach

                        </select>
                        <x-jet-input-error for="expense_category" class="mt-2" />
                    </div>
                    @if($this->expense_category)
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="expense_sub_category" value="{{ __('Expenses Category') }}" />
                            <select id="expense_sub_category" wire:model="expense_sub_category" class="form-input rounded-md shadow-sm mt-1 block w-full">
                                <option value="">Select a category...</option>
                                @foreach(DB::table($this->expense_category)->get() as $sub_category)
                                    <option value="{{ $sub_category->sub_category_code }}">
                                        <div class="py-3 sm:py-4">
                                            <div class="items-center space-x-4">
                                                <div class="min-w-0">
                                                    <div class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                        {{ str_replace('_',' ',$sub_category->sub_category_name )}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="expense_sub_category" class="mt-2" />
                        </div>
                        <div>
                            @if($this->expense_sub_category)
                                @php
                                    $currentMonth = date('n');
                                    $unusedBudget = DB::table('main_budget')->where('sub_category_code', $this->expense_sub_category)
                                        ->selectRaw('
                                    SUM(
                                        CASE
                                            WHEN ? = 1 THEN january
                                            WHEN ? = 2 THEN january + february
                                            WHEN ? = 3 THEN january + february + march
                                            WHEN ? = 4 THEN january + february + march + april
                                            WHEN ? = 5 THEN january + february + march + april + may
                                            WHEN ? = 6 THEN january + february + march + april + may + june
                                            WHEN ? = 7 THEN january + february + march + april + may + june + july
                                            WHEN ? = 8 THEN january + february + march + april + may + june + july + august
                                            WHEN ? = 9 THEN january + february + march + april + may + june + july + august + september
                                            WHEN ? = 10 THEN january + february + march + april + may + june + july + august + september + october
                                            WHEN ? = 11 THEN january + february + march + april + may + june + july + august + september + october + november
                                            ELSE january + february + march + april + may + june + july + august + september + october + november + december
                                        END
                                    ) AS unused_budget',
                                            [$currentMonth, $currentMonth, $currentMonth, $currentMonth, $currentMonth, $currentMonth, $currentMonth, $currentMonth, $currentMonth, $currentMonth, $currentMonth]
                                        )
                                        ->first();

                                    $unusedBudgetValue = $unusedBudget->unused_budget;
                                    $this->availableBudget = $unusedBudgetValue;

                                @endphp

                            <div class="p-2">
                                <p class="text-sm font-medium font-bold text-red-900 truncate dark:text-white">
                                    Available Budget : {{number_format($unusedBudgetValue, 2)}} TZS
                                </p>
                            </div>


                            @endif
                        </div>
                      @endif
                        <!-- Vendor -->
                       <div class="col-span-6 sm:col-span-4">
                         <x-jet-label for="member_number" value="{{ __('Enter Membership Number') }}" />
                           <x-jet-input id="member_number" type="text" class="mt-1 block w-full" wire:model.defer="member_number" autocomplete="member_number" />
                         <x-jet-input-error for="member_number" class="mt-2" />
                      </div>
                    @if($this->member_number)


                            <div class="p-2">
                                <p class="text-sm font-medium font-bold text-red-900 truncate dark:text-white">
                                    Initiator : {{DB::table('members')
                  ->where('membership_number', $this->member_number)
                ->selectRaw('CONCAT(first_name ,  middle_name,   last_name) as name')
                ->first()
                    ->name}}
                                </p>
                            </div>


                    @endif

                    <!-- Amount -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="amount" value="{{ __('Amount') }}" />
                        <x-jet-input min="1" max="{{$unusedBudgetValue}}" step="any" id="amount" type="text" class="mt-1 block w-full" wire:model="amount" autocomplete="amount" />
                        <x-jet-input-error for="amount" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="notes" value="{{ __('Notes') }}" />
                        <textarea id="notes" name="notes" wire:model.defer="notes" rows="4" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Your notes..."></textarea>
                        @error('notes')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Notes is mandatory, it should be more than three characters.</p>
                        </div>
                        @enderror
                    </div>

                </div>


            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('showAddExpense')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                <div wire:loading.remove wire:target="addExpenses" >
                    <x-jet-button class="ml-3"
                                  wire:click="addExpenses"
                                  wire:loading.attr="disabled">
                        {{ __('Proceed') }}
                    </x-jet-button>
                </div>
                <div wire:loading wire:target="addExpenses">
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
