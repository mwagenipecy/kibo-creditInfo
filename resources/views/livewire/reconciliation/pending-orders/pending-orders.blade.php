
<div>
    <div class="grid grid-cols-12 ">



       <div class="col-span-3 w-full h-full pt-2 pl-2 pr-2 border-r border-gray-200 pb-10 no-scrollbar overflow-auto" style="height:90vh;">

                    <p class="text-lg text-gray-600 font-semibold">Sessions List</p>

                    @foreach($this->orders as $order)


                        <div class="bg-gray-200 bg-opacity-25 my-4 pb-px">
                            <div class="p-3">
                                <div class="col-span-6 sm:col-span-4">

                                    <div class="flex justify-end">
                                        @if($order->session_status == 'Unreconciled')
                                            <div>
                                                <span align="right" class="bg-red-100 text-red-800  text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">Unreconciled </span>
                                            </div>
                                        @endif

                                        @if($order->session_status == 'Irreconcilable')
                                            <div>
                                                <span align="right" class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">Irreconcilable</span>
                                            </div>
                                        @endif

                                        @if($order->session_status == 'Reconciled')
                                            <div>
                                                <span align="right" class="bg-green-100 text-white-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-white-900">Reconciled</span>
                                            </div>
                                        @endif


                                    </div>

                                    <table class="table-auto">

                                        <tbody>
                                        <tr>
                                            <td><x-jet-label value="{{ __('Session ID') }}" /></td>
                                            <td >
                                                <p class="ml-4 text-sm text-gray-700 dark:text-gray-500">
                                                    {{$order->session_id}}
                                                </p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td><x-jet-label value="{{ __('Third Part') }}" /></td>
                                            <td >
                                                <p class="ml-4 text-sm text-gray-700 dark:text-gray-500">
                                                    {{$order->third_part}}
                                                </p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td><x-jet-label for="or" value="{{ __('Session Date') }}" /></td>
                                            <td >
                                                <p class="ml-4 text-sm text-gray-700 dark:text-gray-500">
                                                    {{$order->created_at}}
                                                </p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td><x-jet-label for="or" value="{{ __('Value Date Range') }}" /></td>
                                            <td >
                                                <p class="ml-4 text-sm text-gray-700 dark:text-gray-500">
                                                    {{$order->start_date}} to {{$order->end_date}}
                                                </p>
                                            </td>

                                        </tr>


                                        </tbody>
                                    </table>
                                    <div class="hidden sm:block">
                                        <div class="py-2">
                                            <div class="border-t border-gray-200"></div>
                                        </div>
                                    </div>

                                    <table class="table-auto">

                                        <tbody>
                                        <tr>
                                            <td><x-jet-label value="Cash book non-matching transactions" /></td>
                                            <td >
                                                <p class="ml-4 text-sm text-gray-700 dark:text-gray-500">
                                                    {{\App\Models\cashbooknonmatchingstore::where('order_number' ,$order->session_id)->where('payment_status' ,'Pending')->count()}}
                                                </p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td><x-jet-label value="{{$order->third_part}} non-matching transactions" /></td>
                                            <td >
                                                <p class="ml-4 text-sm text-gray-700 dark:text-gray-500">
                                                    @if($order->third_part == 'CRDB')
                                                        {{\App\Models\crdbtransactionsnonmatchingstore::where('order_number' ,$order->session_id)->where('payment_status' ,'Pending')->count()}}
                                                    @endif
                                                    @if($order->third_part == 'NMB')
                                                        {{\App\Models\nmbtransactionsnonmatchingstore::where('order_number' ,$order->session_id)->where('payment_status' ,'Pending')->count()}}
                                                    @endif
                                                    @if($order->third_part == 'UCHUMI')
                                                        {{\App\Models\uchumitransactionsnonmatchingstore::where('order_number' ,$order->session_id)->where('payment_status' ,'Pending')->count()}}
                                                    @endif
                                                </p>
                                            </td>

                                        </tr>


                                        </tbody>
                                    </table>

                                    <div class="hidden sm:block">
                                        <div class="py-2">
                                            <div class="border-t border-gray-200"></div>
                                        </div>
                                    </div>

                                    <div class="flex justify-end" >

                                        <div class="flex items-center justify-center" >
                                            <div class="inline-flex " role="group" >

                                                @if($order->session_status == 'Unreconciled')
                                                    <div wire:loading.remove wire:target="getOrderDetails({{$order->id}},'{{$order->third_part}}')">
                                                        <button wire:click="getOrderDetails({{$order->id}},'{{$order->third_part}}')" class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" >
                                                            View
                                                        </button>
                                                    </div>
                                                    <div wire:loading wire:target="getOrderDetails({{$order->id}},'{{$order->third_part}}')">
                                                        <button type="button" class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" disabled>

                                                            <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-6 w-6 mr-3 stroke-gray-700" fill="gray-700" viewBox="0 0 24 24" stroke="gray-700" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                                            </svg>

                                                            Processing...
                                                        </button>
                                                    </div>

                                                    @if($this->orderToDeleteId ==$order->session_id )

                                                        <div wire:loading.remove wire:target="deleteOrderConfirmed({{$order->id}})">
                                                            <button wire:click='deleteOrderConfirmed' class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md
                                                                font-semibold text-xs text-gray uppercase tracking-widest focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4
                                                                focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 disabled:opacity-25 transition" >
                                                                Confirm Delete
                                                            </button>
                                                        </div>
                                                        <div wire:loading wire:target="deleteOrderConfirmed({{$order->id}})">
                                                            <button type="button" class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" disabled>

                                                                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-6 w-6 mr-3 stroke-gray-700" fill="gray-700" viewBox="0 0 24 24" stroke="gray-700" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                                                </svg>

                                                                Processing...
                                                            </button>
                                                        </div>
                                                    @else

                                                        <div wire:loading.remove wire:target="confirmDeleteOrder({{$order->id}})">
                                                            <button wire:click='confirmDeleteOrder({{$order->id}})' class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" >
                                                                Delete
                                                            </button>
                                                        </div>
                                                        <div wire:loading wire:target="confirmDeleteOrder({{$order->id}})">
                                                            <button type="button" class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" disabled>

                                                                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-6 w-6 mr-3 stroke-gray-700" fill="gray-700" viewBox="0 0 24 24" stroke="gray-700" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                                                </svg>

                                                                Processing...
                                                            </button>
                                                        </div>
                                                    @endif


                                                @endif
                                                @if($order->session_status == 'Reconciled')
                                                    <div wire:loading.remove wire:target="getOrderDetails({{$order->id}})">
                                                        <button wire:click='getOrderDetails({{$order->id}})' class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" >
                                                            View
                                                        </button>
                                                    </div>
                                                    <div wire:loading wire:target="getOrderDetails({{$order->id}})">
                                                        <button type="button" class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" disabled>

                                                            <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-6 w-6 mr-3 stroke-gray-700" fill="gray-700" viewBox="0 0 24 24" stroke="gray-700" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                                            </svg>

                                                            Processing...
                                                        </button>
                                                    </div>

                                                @endif
                                                @if($order->session_status == 'Irreconcilable')


                                                    <button wire:click="getOrderDetails({{$order->id}})"
                                                            type="button" class="rounded-r inline-block inline-flex items-center px-4 py-2 bg-white border font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                                                        View
                                                    </button>
                                                    <button wire:click="getOrderDetails({{$order->id}})"
                                                            type="button" class="rounded-r inline-block inline-flex items-center px-4 py-2 bg-white border font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                                                        Write Off
                                                    </button>
                                                @endif


                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>


                        </div>
                    @endforeach


       </div>


        <div class="col-span-9 p-2">

                <table class="table-auto m-2">

                    <tbody>
                    <tr>
                        <td><x-jet-label value="{{ __('Session ID') }}" /></td>
                        <td >
                            <p class="ml-4 text-sm text-gray-700 dark:text-gray-500">
                                {{$this->session_id}}
                            </p>
                        </td>

                    </tr>
                    <tr>
                        <td><x-jet-label value="{{ __('Third Part') }}" /></td>
                        <td >
                            <p class="ml-4 text-sm text-gray-700 dark:text-gray-500">
                                {{$this->third_part}}
                            </p>
                        </td>

                    </tr>


                    </tbody>
                </table>

                <div class="flex justify-between">
                    <div class="flex items-center justify-center">

                        @if($this->showSideBar)  @else
                            <div wire:loading.remove wire:target="backup">
                                <button wire:click='backup' class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" >
                                    BACK
                                </button>
                            </div>
                            <div wire:loading wire:target="backup">
                                <button type="button" class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" disabled>

                                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-6 w-6 mr-3 stroke-gray-700" fill="gray-700" viewBox="0 0 24 24" stroke="gray-700" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>

                                    please wait...
                                </button>
                            </div>

                        @endif




                        <div wire:loading.remove wire:target="exportUsers" hidden>
                            <button wire:click='exportUsers' class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" >
                                CASHBOOK FILE
                            </button>
                        </div>
                        <div wire:loading wire:target="exportUsers">
                            <button type="button" class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" disabled>

                                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-6 w-6 mr-3 stroke-gray-700" fill="gray-700" viewBox="0 0 24 24" stroke="gray-700" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>

                                Processing...
                            </button>
                        </div>



                        <div wire:loading.remove wire:target="exportUsersx" hidden>
                            <button wire:click='exportUsersx' class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" >
                                {{$this->third_part}} FILE
                            </button>
                        </div>
                        <div wire:loading wire:target="exportUsersx">
                            <button type="button" class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" disabled>

                                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-6 w-6 mr-3 stroke-gray-700" fill="gray-700" viewBox="0 0 24 24" stroke="gray-700" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>

                                Processing...
                            </button>
                        </div>


                    </div>

                    <div class="flex items-center justify-center" hidden>


                    </div>

                </div>



                    @if($this->showSideBar)

                        <div class="flex items-center justify-center min-h-screen" >

                            <div class="w-1/5" >
                                <p class="text-gray-400">Awaiting data, Please select a session to analyze...</p>

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-60 w-60 align-middle  stroke-gray-100" fill="gray-100" viewBox="0 0 24 24" stroke="gray-100" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                            </div>



                        </div>

                    @else

                    <div class="bg-white border-b border-gray-200 ">


                        <div class="flex gap-1   fixed h-screen">
                            <div class="w-1/2 fixed  relative md:flex h-screen overflow-hidden">

                                <div class="flex-1 h-screen overflow-y-auto  disable-scrollbars">
                                    <livewire:reconciliation.cb.new-cb-table
                                            exportable
                                            searchable="description, transaction_amount, value_date"
                                    />
                                   <div style="height: 300px"></div>
                                </div>

                            </div>
                            <div class="w-1/2 fixed  relative md:flex h-screen overflow-hidden mr-4">
                                <div class="flex-1 h-screen overflow-y-auto  disable-scrollbars">
                                <livewire:reconciliation.crdb.new-crdb-table
                                        exportable
                                        searchable="debit, credit,value_date,details"
                                />
                                <div style="height: 300px"></div>
                                </div>
                            </div>

                        </div>


                    </div>

                    @endif


        </div>

    </div>

</div>

