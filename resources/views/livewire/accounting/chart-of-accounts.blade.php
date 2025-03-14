<div class="lg:w-2/3">
    <!-- message container -->

    <div>

        <div class="flex">

            <div class="container mx-auto ">

                @if($this->createNewAccount)

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

                            <div class="flex items-center text-sm mb-2 font-semibold spacing-sm text-slate-600" >CREATE INTERNAL ACCOUNT

                            </div>
                            <div class="flex items-stretch">

                                <div class="w-1/2 mr-2" >

                                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select Category</label>
                                    <select wire:model.bounce="category" name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected value="">Select</option>
                                        @foreach(DB::table('GL_accounts')->get() as $account)
                                            <option  value="{{$account->account_code}}">{{$account->account_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                        <p>Branch is mandatory.</p>
                                    </div>
                                    @enderror
                                    <div class="mt-2"></div>

                                    @if($this->category)

                                        {{--                                    @if($this->category==1000)--}}

                                        <label for="sub_category_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select Sub Category</label>
                                        <select wire:model.bounce="sub_category_name" name="sub_category_name" id="sub_category_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option selected value="">Select</option>
                                            @foreach(DB::table($account->account_name)->get() as $account)
                                                <option  value="{{$account->category_name}}">{{$account->category_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('sub_category_name')
                                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>Branch is mandatory.</p>
                                        </div>
                                        @enderror
                                        <div class="mt-2"></div>

                                        {{--                                    @endif--}}
                                        @if($this->sub_category_name)

                                            <x-jet-label for="account_name" value="{{ __('Account Name') }}" />
                                            <x-jet-input id="account_name" type="text" name="account_name" class="mt-1 block w-full" wire:model.bounce="account_name" autofocus />
                                            @error('account_name')
                                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                                <p>Notes is mandatory and should be more than two characters.</p>
                                            </div>
                                            @enderror


                                            <div class="mt-2"></div>
                                            <x-jet-label for="account_code" value="{{ __('Account code') }}" />
                                            <x-jet-input id="account_code" type="text" name="notes" class="mt-1 block w-full" wire:model.bounce="account_code" autofocus />
                                            @error('account_code')
                                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                                <p>Notes is mandatory and should be more than two characters.</p>
                                            </div>
                                            @enderror

                                            <div class="mt-2"></div>
                                            <x-jet-label for="notes" value="{{ __('Enter Notes') }}" />
                                            <x-jet-input id="notes" type="text" name="notes" class="mt-1 block w-full" wire:model.bounce="notes" autofocus />
                                            @error('notes')
                                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                                <p>Notes is mandatory and should be more than two characters.</p>
                                            </div>
                                            @enderror

                                        @endif





                                    @endif
                                    <div class="mt-2"></div>

                                    @if($this->notes && $this->account_name && $this->category)

                                        <div class="flex items-center justify-between text-sm mb-2 font-semibold spacing-sm text-slate-600
                                    border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                            <p>Account Number</p>
                                            <p>{{$this->account_number}}</p>
                                        </div>

                                    @endif
                                    <div class="mt-2"></div>

                                </div>


                                <div class="w-1/2 ml-2" >


                                </div>



                            </div>


                            <div class="flex justify-end w-auto" >
                                <div wire:loading wire:target="save" >
                                    <button class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400" disabled>
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
                                <div wire:loading.remove wire:target="save" >
                                    <button wire:click="save" class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                        Save
                                    </button>

                                </div>
                            </div>

                        </div>


                    </div>

                @endif


                <div class="flex flex-col w-full" >
                    <div class="grid gap-4 grid-cols-1 sm:grid-cols-3 my-2 w-full">

                        <div  class="metric-card  dark:bg-gray-900 border @if($this->item == 1) bg-blue-200 border-blue-200 dark:border-blue-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >


                            <div class="flex justify-between items-center w-full">
                                <div class="flex items-center">
                                    <div wire:loading wire:target="visit(1)" >
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-gray-400" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                            </svg>


                                            <p>Please wait...</p>
                                        </div>

                                    </div>
                                    <div wire:loading.remove wire:target="visit(1)">


                                        <div class="flex items-center text-l font-semibold spacing-sm text-slate-600" >General ledger accounts

                                        </div>

                                    </div>

                                </div>
                                <div class="flex items-center space-x-5" >

                                    <svg wire:click="visit(1)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>

                                    <svg wire:click="showDiv"  xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>

                                </div>
                            </div>


                            <p class="mt-2 text-xl font-semibold @if($this->item == 1) text-white @else text-slate-400 @endif  dark:text-white" >
                                {{App\Models\AccountsModel::where('product_number','10')->count()}}
                            </p>
                        </div>




                        <div  class="metric-card  dark:bg-gray-900 border @if($this->item == 2) bg-blue-200 border-blue-200 dark:border-blue-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >

                            <div class="flex justify-between items-center w-full">
                                <div class="flex items-center">
                                    <div wire:loading wire:target="visit(2)" >
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-gray-400" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                            </svg>


                                            <p>Please wait...</p>
                                        </div>

                                    </div>
                                    <div wire:loading.remove wire:target="visit(2)">


                                        <div class="flex items-center text-l font-semibold spacing-sm text-slate-600">Revenue accounts

                                        </div>

                                    </div>

                                </div>
                                <div class="flex items-center space-x-5" >

                                    <svg wire:click="visit(2)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>


                                </div>
                            </div>



                            <table>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 2) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Number of accounts</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 2) text-white @else text-slate-400 @endif  dark:text-white  text-right">

                                        {{App\Models\AccountsModel::where('sub_product_number','101')->count()}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 2) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total available balance</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 2) text-white @else text-slate-400 @endif  dark:text-white  text-right">

                                        {{number_format(App\Models\AccountsModel::where('sub_product_number','101')->sum('balance'),2)}} TZS
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 2) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Active accounts</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 2) text-white @else text-slate-400 @endif  dark:text-white  text-right">

                                        {{App\Models\AccountsModel::where('sub_product_number','101')->where('account_status','Active')->count()}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 2) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Inactive accounts</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 2) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                        {{App\Models\AccountsModel::where('sub_product_number','101')->where('account_status','Inactive')->count()}}
                                    </td>
                                </tr>


                            </table>
                        </div>



                        <div  class="metric-card  dark:bg-gray-900 border @if($this->item == 3) bg-blue-200 border-blue-200 dark:border-blue-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >

                            <div class="flex justify-between items-center w-full">
                                <div class="flex items-center">
                                    <div wire:loading wire:target="visit(3)" >
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-gray-400" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                            </svg>


                                            <p>Please wait...</p>
                                        </div>

                                    </div>
                                    <div wire:loading.remove wire:target="visit(3)">


                                        <div class="flex items-center text-l font-semibold spacing-sm text-slate-600">Expenses accounts

                                        </div>

                                    </div>

                                </div>
                                <div class="flex items-center space-x-5" >

                                    <svg wire:click="visit(3)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>


                                </div>
                            </div>



                            <table>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 3) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Number of accounts</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 3) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                        {{App\Models\AccountsModel::where('sub_product_number','102')->count()}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 3) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total available balance</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 3) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                        {{number_format(App\Models\AccountsModel::where('sub_product_number','102')->sum('balance'),2)}} TZS
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 3) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Active accounts</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 3) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                        {{App\Models\AccountsModel::where('sub_product_number','102')->where('account_status','Active')->count()}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 3) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Inactive accounts</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 3) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                        {{App\Models\AccountsModel::where('sub_product_number','102')->where('account_status','Inactive')->count()}}
                                    </td>
                                </tr>


                            </table>
                        </div>




                    </div>
                    <div class="grid gap-4 grid-cols-1 sm:grid-cols-3 my-2 w-full">

                        <div class="metric-card  dark:bg-gray-900 border @if($this->item == 4) bg-blue-200 border-blue-200 dark:border-blue-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >

                            <div class="flex justify-between items-center w-full">
                                <div class="flex items-center">
                                    <div wire:loading wire:target="visit(4)" >
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-gray-400" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                            </svg>


                                            <p>Please wait...</p>
                                        </div>

                                    </div>
                                    <div wire:loading.remove wire:target="visit(4)">


                                        <div class="flex items-center text-l font-semibold spacing-sm text-slate-600">Assets accounts

                                        </div>

                                    </div>

                                </div>
                                <div class="flex items-center space-x-5" >

                                    <svg wire:click="visit(4)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>


                                </div>
                            </div>



                            <table>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 4) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Number of accounts</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 4) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                        {{App\Models\AccountsModel::where('sub_product_number','103')->count()}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 4) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total available balance</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 4) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                        {{number_format(App\Models\AccountsModel::where('sub_product_number','103')->sum('balance'),2)}} TZS
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 4) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Active accounts</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 4) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                        {{App\Models\AccountsModel::where('sub_product_number','103')->where('account_status','Active')->count()}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 4) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Inactive accounts</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 4) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                        {{App\Models\AccountsModel::where('sub_product_number','103')->where('account_status','Inactive')->count()}}
                                    </td>
                                </tr>


                            </table>
                        </div>


                        <div  class="metric-card  dark:bg-gray-900 border @if($this->item == 5) bg-blue-200 border-blue-200 dark:border-blue-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >

                            <div class="flex justify-between items-center w-full">
                                <div class="flex items-center">
                                    <div wire:loading wire:target="visit(5)" >
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-gray-400" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                            </svg>


                                            <p>Please wait...</p>
                                        </div>

                                    </div>
                                    <div wire:loading.remove wire:target="visit(5)">


                                        <div class="flex items-center text-l font-semibold spacing-sm text-slate-600">Liabilities accounts

                                        </div>

                                    </div>

                                </div>
                                <div class="flex items-center space-x-5" >

                                    <svg wire:click="visit(5)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>


                                </div>
                            </div>


                            <table>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 5) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Number of accounts</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 5) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                        {{App\Models\AccountsModel::where('sub_product_number','104')->count()}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 5) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total available balance</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 5) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                        {{number_format(App\Models\AccountsModel::where('sub_product_number','104')->sum('balance'),2)}} TZS
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 5) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Active accounts</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 5) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                        {{App\Models\AccountsModel::where('sub_product_number','104')->where('account_status','Active')->count()}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 5) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Inactive accounts</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 5) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                        {{App\Models\AccountsModel::where('sub_product_number','104')->where('account_status','Inactive')->count()}}
                                    </td>
                                </tr>


                            </table>
                        </div>

                        <div  class="metric-card  dark:bg-gray-900 border @if($this->item == 6) bg-blue-200 border-blue-200 dark:border-blue-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >

                            <div class="flex justify-between items-center w-full">
                                <div class="flex items-center">
                                    <div wire:loading wire:target="visit(6)" >
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-gray-400" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                            </svg>


                                            <p>Please wait...</p>
                                        </div>

                                    </div>
                                    <div wire:loading.remove wire:target="visit(6)">


                                        <div class="flex items-center text-l font-semibold spacing-sm text-slate-600">Equity accounts

                                        </div>

                                    </div>

                                </div>
                                <div class="flex items-center space-x-5" >

                                    <svg wire:click="visit(6)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>


                                </div>
                            </div>



                            <table>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 6) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Number of accounts</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 6) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                        {{App\Models\AccountsModel::where('sub_product_number','105')->count()}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 6) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total available balance</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 6) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                        {{number_format(App\Models\AccountsModel::where('sub_product_number','105')->sum('balance'),2)}} TZS
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 6) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Active accounts</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 6) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                        {{App\Models\AccountsModel::where('sub_product_number','105')->where('account_status','Active')->count()}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mt-2 text-sm font-semibold   @if($this->item == 6) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Inactive accounts</td>
                                    <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 6) text-white @else text-slate-400 @endif  dark:text-white text-right">

                                        {{App\Models\AccountsModel::where('sub_product_number','105')->where('account_status','Inactive')->count()}}
                                    </td>
                                </tr>


                            </table>
                        </div>

                    </div>

                </div>
            </div>


        </div>

        <hr class="border-b-0 my-4"/>

        <div class="bg-white rounded rounded-lg shadow-sm">

{{--            @if($this->item == 1)--}}
{{--                <livewire:accounting.number-of-products--}}
{{--                        exportable--}}
{{--                        searchable="sub_product_name"--}}
{{--                />--}}
{{--            @else--}}
{{--                <livewire:accounting.other-data--}}
{{--                        exportable--}}
{{--                        searchable="member,account_number,status"--}}
{{--                />--}}
{{--            @endif--}}


        </div>
    </div>

</div>
