<div>
    {{-- Success is as dangerous as failure. --}}



    {{--    edit fiscal policy modal--}}

    @if($this->editFiscalPolicyModal)
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
                                Edit
                            </h3>
                        </div>
                        <x-jet-label for="category_name" value="{{ __('Category Name') }}" />
                        <x-jet-input id="department_name" wire:model="category_name" name="category_name"  type="text"  class="mt-1 block w-full"  autofocus />
                        @error('department_name')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p> Name is mandatory.</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>

                        <x-jet-label for="category_amount" value="{{ __('Category Amount') }}" />
                        <x-jet-input id="category_amount" wire:model="category_amount" name="category_amount"  type="text"  class="mt-1 block w-full"  autofocus />
                        @error('category_amount')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p> Amount is mandatory.</p>
                        </div>
                        @enderror
                        <div class="mt-2"></div>

                        <x-jet-label for="leave_description" value="{{ __('Description') }}" />
                        <textarea id="description" name="description" type="text" class="mt-1 block w-full" wire:model="description" autofocus >
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
                        <button type="button" wire:click="editFiscalPolicy()" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                            Cancel
                        </button>
                        <button type="submit" wire:click="editPolicy()" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                            Proceed
                        </button>
                    </div>
                </div>
            </div>
        </div>




    @endif





    <div class="lg:w-2/3">
        <!-- message container -->


        @if($this->fiscalModal==True)

            <!-- Modal -->
            <div class="fixed z-10 inset-0 overflow-y-auto"  >
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                    <div class="fixed inset-0 transition-opacity">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
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
                                    ADD NEW FISCAL CATEGORY POLICY
                                </h3>
                            </div>

                            <x-jet-label for="fiscal_policy" value="{{ __('Fiscal   Policy') }}" />
                            <select wire:model.bounce="fiscal_policy" name="fiscal_policy" id="fiscal_policy" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                                <option selected value="">Select ....</option>
                                <option  value="1">Contributions</option>
                                <option  value="2">Benefits</option>
                                <option  value="3">Taxes</option>

                            </select>
                            @error('fiscal_policy')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Fiscal policy is mandatory.</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>


                            <div class="mt-2"></div>
                            <x-jet-label for="category_amount" value="{{ __('Category Amount') }}" />
                            <x-jet-input id="category_amount" name="category_amount" type="text" class="mt-1 block w-full" wire:model.defer="category_amount" autofocus />
                            @error('category_amount')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p> Category Amount is mandatory</p>
                            </div>
                            @enderror

                            <div class="mt-2"></div>


                            <x-jet-label for="category_name" value="{{ __('Category Name') }}" />
                            <x-jet-input id="category_name" name="category_name" type="text" class="mt-1 block w-full" wire:model.defer="category_name" autofocus />
                            @error('category_name')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p> Category name  is mandatory</p>
                            </div>
                            @enderror

                            <div class="mt-2"></div>

                        </div>



                        <!-- Add more form fields as needed -->
                        <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                            <button type="button" wire:click="closeModal()" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                                Cancel
                            </button>
                            <button type="submit" wire:click="addPolicy()" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                                Proceed
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <div>
            <div class="flex">

                <div class="container mx-auto ">
                    <div class="flex flex-col w-full" >
                        <div class="grid gap-4 grid-cols-1 sm:grid-cols-3 my-2 w-full">
                            <div  class="metric-card  dark:bg-gray-900 border @if($this->selected_policy== 1) bg-red-200 border-red-200 dark:border-red-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >
                                <div class="flex justify-between items-center w-full">
                                    <div class="flex items-center">
                                        <div wire:loading wire:target="selectedPolicyCategory(1)" >
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-gray-400" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                                <p>Please wait...</p>
                                            </div>
                                        </div>
                                        <div wire:loading.remove wire:target="selectedPolicyCategory(1)">
                                            <div class="flex items-center text-l font-semibold spacing-sm text-slate-600">Contributions
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-5" >
                                        <svg wire:click="selectedPolicyCategory(1)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>


                                    </div>
                                </div>


                                <table>

                                    <tr>
                                        <td class="mt-2 text-sm font-semibold   @if($this->selected_policy == 1) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total available Contributions</td>
                                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->selected_policy == 1) text-white @else text-slate-400 @endif  dark:text-white  text-right">

                                            {{DB::table('Contributions')->get()->count()}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="mt-2 text-sm font-semibold   @if($this->selected_policy== 1) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total available beneficiaries</td>
                                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->selected_policy == 1) text-white @else text-slate-400 @endif  dark:text-white  text-right">

                                            {{count(App\Models\Employee::where('contribution','1')->get())}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="mt-2 text-sm font-semibold   @if($this->selected_policy == 1) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Highest Contribution </td>
                                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->selected_policy == 1) text-white @else text-slate-400 @endif  dark:text-white  text-right">

                                            {{ number_format(  DB::table('Contributions')->max('amount'),2)}}TZS
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="mt-2 text-sm font-semibold   @if($this->selected_policy == 1) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Lowest Contribution</td>
                                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->selected_policy == 1) text-white @else text-slate-400 @endif  dark:text-white text-right">
                                            {{ number_format(  DB::table('Contributions')->min('amount'),2)}}TZS
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            {{--                             benefits--}}
                            <div  class="metric-card  dark:bg-gray-900 border @if($this->selected_policy == 2) bg-red-200 border-red-200 dark:border-red-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >
                                <div class="flex justify-between items-center w-full">
                                    <div class="flex items-center">
                                        <div wire:loading wire:target="selectedPolicyCategory(2)" >
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-gray-400" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                                <p>Please wait...</p>
                                            </div>
                                        </div>
                                        <div wire:loading.remove wire:target="selectedPolicyCategory(2)">
                                            <div class="flex items-center text-l font-semibold spacing-sm text-slate-600">Benefits
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-5" >
                                        <svg wire:click="selectedPolicyCategory(2)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <table>

                                    <tr>
                                        <td class="mt-2 text-sm font-semibold   @if($this->selected_policy == 2) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Number of accounts</td>
                                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->selected_policy == 2) text-white @else text-slate-400 @endif  dark:text-white  text-right">

                                            {{count(DB::table('benefits')->get())}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="mt-2 text-sm font-semibold   @if($this->selected_policy == 2) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total Available Beneficiaries</td>
                                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->selected_policy == 2) text-white @else text-slate-400 @endif  dark:text-white  text-right">
                                            {{count(App\Models\Employee::where('benefits','2')->get())}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="mt-2 text-sm font-semibold   @if($this->selected_policy== 2) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Highest Benefit</td>
                                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->selected_policy == 2) text-white @else text-slate-400 @endif  dark:text-white  text-right">
                                            {{ number_format(  DB::table('benefits')->max('amount'),2)}}TZS
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="mt-2 text-sm font-semibold   @if($this->selected_policy == 2) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Lowest Benefit</td>
                                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->selected_policy == 2) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                            {{ number_format(  DB::table('benefits')->min('amount'),2)}}TZS
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            {{--                             for tax --}}
                            <div  class="metric-card  dark:bg-gray-900 border @if($this->selected_policy == 3) bg-red-200 border-red-200 dark:border-red-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >
                                <div class="flex justify-between items-center w-full">
                                    <div class="flex items-center">
                                        <div wire:loading wire:target="selectedPolicyCategory(3)" >
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-gray-400" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                                </svg>


                                                <p>Please wait...</p>
                                            </div>

                                        </div>
                                        <div wire:loading.remove wire:target="selectedPolicyCategory(3)">


                                            <div class="flex items-center text-l font-semibold spacing-sm text-slate-600">Organization Taxes

                                            </div>

                                        </div>

                                    </div>
                                    <div class="flex items-center space-x-5" >

                                        <svg wire:click="selectedPolicyCategory(3)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <table>
                                    <tr>
                                        <td class="mt-2 text-sm font-semibold   @if($this->selected_policy == 3) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total Available Taxes </td>
                                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->selected_policy== 3) text-white @else text-slate-400 @endif  dark:text-white text-right">
                                                <?php $type_of_taxes_available=DB::table('taxes')->get() ?>
                                            {{count($type_of_taxes_available)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="mt-2 text-sm font-semibold   @if($this->selected_policy == 3) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total taxpayers</td>
                                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->selected_policy== 3) text-white @else text-slate-400 @endif  dark:text-white text-right">
                                            {{count(DB::table('employees')->where('taxes','3')->get())}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="mt-2 text-sm font-semibold   @if($this->selected_policy == 3) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Highest Tax </td>
                                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->selected_policy == 3) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                            {{ number_format(  DB::table('taxes')->max('amount'),2)}}TZS
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="mt-2 text-sm font-semibold   @if($this->selected_policy == 3) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Lowest Tax </td>
                                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->selected_policy == 3) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                            {{ number_format(  DB::table('taxes')->min('amount'),2)}}TZS
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="boder-b-0 my-4"/>
        </div>
    </div>
    <div>
        <livewire:h-r.fiscal-policy/>
    </div>


</div>
