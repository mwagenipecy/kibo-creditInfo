<div class="lg:w-2/3">
    <!-- message container -->

        <div>

            <div class="flex">

                <div class="container mx-auto ">
                    <div class="flex flex-col w-full" style="cursor: auto;">
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


                                            <p class="flex items-center text-l font-semibold spacing-sm text-slate-600" >Number of products

                                            </p>

                                        </div>

                                    </div>
                                    <div class="flex items-center space-x-5" >

                                        <svg wire:click="visit(1)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>


                                    </div>
                                </div>


                                <p class="mt-2 text-sm font-semibold @if($this->item == 1) text-white @else text-slate-400 @endif  dark:text-white" >{{$this->numberOfProducts}}</p>
                            </div>




                            <div class="metric-card  dark:bg-gray-900 border @if($this->item == 2) bg-blue-200 border-blue-200 dark:border-blue-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >


                                <div class="flex justify-between items-center w-full">
                                    <div class="flex items-center">
                                        <div wire:loading wire:target="visit(24)" >
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-gray-400" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                                </svg>


                                                <p>Please wait...</p>
                                            </div>

                                        </div>
                                        <div wire:loading.remove wire:target="visit(24)">


                                            <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">Total value

                                            </p>

                                        </div>

                                    </div>

                                </div>



                                <table>
                                    @foreach($this->products as $product)
                                        <tr>
                                            <td class="mt-2 text-sm font-semibold   @if($this->item == 2) text-white @else text-slate-400 @endif dark:text-white capitalize  ">
                                                <p>{{strtolower($product -> sub_product_name)}}</p>
                                            </td>
                                            <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 2) text-white @else text-slate-400 @endif  dark:text-white">

                                                <p>{{number_format(App\Models\AccountsModel::where('sub_product_number',$product->sub_product_id)->sum('balance'),2)}} TZS</p>
                                            </td>
                                        </tr>
                                    @endforeach
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


                                            <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">Active accounts

                                            </p>

                                        </div>

                                    </div>
                                    <div class="flex items-center space-x-5" >

                                        <svg wire:click="visit(3)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>


                                    </div>
                                </div>



                                <table>
                                    @foreach($this->products as $product)
                                        <tr>
                                            <td class="mt-2 text-sm font-semibold   @if($this->item == 3) text-white @else text-slate-400 @endif dark:text-white capitalize  ">
                                                <p>{{strtolower($product -> sub_product_name)}}</p>
                                            </td>
                                            <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 3) text-white @else text-slate-400 @endif  dark:text-white">

                                                <p>{{App\Models\AccountsModel::where('sub_product_number',$product->sub_product_id)->where('account_status','Active')->count()}}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>




                        </div>
                        <div class="grid gap-4 grid-cols-1 sm:grid-cols-3 my-2 w-full">

                            <div class="metric-card  dark:bg-gray-900 border @if($this->item == 7) bg-blue-200 border-blue-200 dark:border-blue-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >

                                <div class="flex justify-between items-center w-full">
                                    <div class="flex items-center">
                                        <div wire:loading wire:target="visit(7)" >
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-gray-400" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                                </svg>


                                                <p>Please wait...</p>
                                            </div>

                                        </div>
                                        <div wire:loading.remove wire:target="visit(7)">


                                            <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">Inactive accounts

                                            </p>

                                        </div>

                                    </div>
                                    <div class="flex items-center space-x-5" >

                                        <svg wire:click="visit(7)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>


                                    </div>
                                </div>



                                <table>
                                    @foreach($this->products as $product)
                                        <tr>
                                            <td class="mt-2 text-sm font-semibold   @if($this->item == 7) text-white @else text-slate-400 @endif dark:text-white capitalize  ">
                                                <p>{{strtolower($product -> sub_product_name)}}</p>
                                            </td>
                                            <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 7) text-white @else text-slate-400 @endif  dark:text-white">
                                                <p>{{App\Models\AccountsModel::where('sub_product_number',$product->sub_product_id)->where('account_status','Inactive')->count()}}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>


                            <div  class="metric-card  dark:bg-gray-900 border @if($this->item == 4) bg-blue-200 border-blue-200 dark:border-blue-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >

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


                                            <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">Blocked accounts

                                            </p>

                                        </div>

                                    </div>
                                    <div class="flex items-center space-x-5" >

                                        <svg wire:click="visit(4)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>


                                    </div>
                                </div>


                                <table>
                                    @foreach($this->products as $product)
                                        <tr>
                                            <td class="mt-2 text-sm font-semibold   @if($this->item == 4) text-white @else text-slate-400 @endif dark:text-white capitalize  ">
                                                <p>{{strtolower($product -> sub_product_name)}}</p>
                                            </td>
                                            <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 4) text-white @else text-slate-400 @endif  dark:text-white">
                                                <p>{{App\Models\AccountsModel::where('sub_product_number',$product->sub_product_id)->where('account_status','Blocked')->count()}}</p>
                                            </td>
                                        </tr>
                                    @endforeach
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


                                            <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">Accounts awaiting activation

                                            </p>

                                        </div>

                                    </div>
                                    <div class="flex items-center space-x-5" >

                                        <svg wire:click="visit(5)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full stroke-slate-400 p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>


                                    </div>
                                </div>



                                <table>
                                    @foreach($this->products as $product)
                                        <tr>
                                            <td class="mt-2 text-sm font-semibold   @if($this->item == 5) text-white @else text-slate-400 @endif dark:text-white capitalize  ">
                                                <p>{{strtolower($product -> sub_product_name)}}</p>
                                            </td>
                                            <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 5) text-white @else text-slate-400 @endif  dark:text-white">
                                                <p>{{App\Models\AccountsModel::where('sub_product_number',$product->sub_product_id)->where('account_status','Pending')->count()}}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>

                        </div>



                    </div>
                </div>


            </div>

            <hr class="boder-b-0 my-4"/>

            <div class="bg-white rounded rounded-lg shadow-sm p-4">

                @if($this->item == 1)
                    <livewire:savings.number-of-products
                            exportable
                            searchable="sub_product_name"
                    />
                @else
                    <livewire:savings.other-data
                            exportable
                            searchable="member,account_number,status"
                    />
                @endif


            </div>
        </div>

</div>
