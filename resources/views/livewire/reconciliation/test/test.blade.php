<div>

    <div>
        <div class="grid grid-cols-4 grid-rows-3 gap-2 ">
            <div class="row-span-3 col-span-1">

                <div class="py-4 lg:px-4">

                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                        <style>
                            @layer utilities {
                                /* Chrome, Safari and Opera */
                                .no-scrollbar::-webkit-scrollbar {
                                    display: none;
                                }

                                .no-scrollbar {
                                    -ms-overflow-style: none; /* IE and Edge */
                                    scrollbar-width: none; /* Firefox */
                                }
                            }
                        </style>

                        <div class="p-6 sm:px-4 bg-white border-b border-gray-200 no-scrollbar overflow-auto" style="height:90vh;">
                            <div class="text-lg text-gray-600 font-semibold">Sessions List</div>


                            <div class="flex justify-between">

                                <div wire:loading.remove wire:target="exportUsersAll">
                                    <button wire:click='exportUsersAll' class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" >
                                        FULL CASHBOOK FILE
                                    </button>
                                </div>
                                <div wire:loading wire:target="exportUsersAll">
                                    <button type="button" class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" disabled>

                                        <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-6 w-6 mr-3 stroke-gray-700" fill="gray-700" viewBox="0 0 24 24" stroke="gray-700" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>

                                        Processing...
                                    </button>
                                </div>



                                <div wire:loading.remove wire:target="exportUsersxAll">
                                    <button wire:click='exportUsersxAll' class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" >
                                        FULL THIRD PARTIES FILE
                                    </button>
                                </div>
                                <div wire:loading wire:target="exportUsersxAll">
                                    <button type="button" class="m-2 inline-flex items-center px-2 py-2 border border-solid rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" disabled>

                                        <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-6 w-6 mr-3 stroke-gray-700" fill="gray-700" viewBox="0 0 24 24" stroke="gray-700" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>

                                        Processing...
                                    </button>
                                </div>


                            </div>


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
                                                            {{\App\Models\crdbtransactionsnonmatchingstore::where('order_number' ,$order->session_id)->where('payment_status' ,'Pending')->count()}}
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






                    </div>

                </div>

            </div>
            <div class="row-span-1 col-span-3">

                <div class="py-4 lg:px-4 ">

                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-4" >


                        <div class="bg-white border-b border-gray-200 ">


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
                                <tr>
                                    <td><x-jet-label for="or" value="{{ __('Session Date') }}" /></td>
                                    <td >
                                        <p class="ml-4 text-sm text-gray-700 dark:text-gray-500">
                                            {{$this->created_at}}
                                        </p>
                                    </td>

                                </tr>
                                <tr>
                                    <td><x-jet-label for="or" value="{{ __('Value Date Range') }}" /></td>
                                    <td >
                                        <p class="ml-4 text-sm text-gray-700 dark:text-gray-500">
                                            {{$this->start_date}} to {{$this->end_date}}
                                        </p>
                                    </td>

                                </tr>


                                </tbody>
                            </table>

                            <div class="flex justify-between">
                                <div class="flex items-center justify-center">

                                    <div wire:loading.remove wire:target="exportUsers">
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



                                    <div wire:loading.remove wire:target="exportUsersx">
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
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg " >


                        <div class="bg-white border-b border-gray-200 ">
                            <p class="text-xl text-gray-700 dark:text-gray-500 m-4">
                                CASH BOOK NON MATCHING TRANSACTIONS
                            </p>

                            <livewire:cb.cb-table-store/>





                        </div>






                    </div>

                </div>




                <div class="py-4 lg:px-4 ">

                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg " >


                        <div class="bg-white border-b border-gray-200 ">
                            <p class="text-xl text-gray-700 dark:text-gray-500 m-4">
                                CRDB NON MATCHING TRANSACTIONS
                            </p>




                            <livewire:crdb.non-matching-store/>





                        </div>






                    </div>

                </div>

            </div>

        </div>

    </div>



</div>
