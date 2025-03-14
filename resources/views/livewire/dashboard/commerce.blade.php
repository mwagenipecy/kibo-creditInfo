<div>
    {{-- The Master doesn't talk, he acts. --}}

    <div class="flex flex-col w-full" >
        <div class="grid gap-4 grid-cols-1 sm:grid-cols-3 my-2 w-full">
            <div  class="metric-card  dark:bg-gray-900 border @if($this->item == 1) bg-red-200 border-red-200 dark:border-red-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >

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


                            <div class="flex items-center text-l font-semibold spacing-sm text-green-800">New Applications

                            </div>

                        </div>

                    </div>
                    <div class="flex items-center space-x-5" >

                        <svg wire:click="visit(1)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full bg-green p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>


                    </div>
                </div>



                <table>

                    <tr>
                        <td class="mt-2 text-sm font-semibold   @if($this->item == 1) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total Number</td>
                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 1) text-white @else text-slate-400 @endif  dark:text-white  text-right">

                           {{$this->newClients}}
                        </td>
                    </tr>

                    <tr>
                        <td class="mt-2 text-sm font-semibold   @if($this->item == 1) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total Amount</td>
                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 1) text-white @else text-slate-400 @endif  dark:text-white  text-right">
                            {{$this->TotalNewClientsAmount}} TZS
                        </td>
                    </tr>


                </table>


            </div>


            <div  class="metric-card  dark:bg-gray-900 border @if($this->item == 2) bg-red-200 border-red-200 dark:border-red-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >

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


                            <div class="flex items-center text-l font-semibold spacing-sm text-green-800">OnProgress

                            </div>

                        </div>

                    </div>
                    <div class="flex items-center space-x-5" >

                        <svg wire:click="visit(2)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full bg-green p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>


                    </div>
                </div>



                <table>

                    <tr>
                        <td class="mt-2 text-sm font-semibold   @if($this->item == 2) text-white @else text-slate-400 @endif dark:text-white capitalize  ">OnProgress Clients</td>
                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 2) text-white @else text-slate-400 @endif  dark:text-white  text-right">
                         {{$this->onprogress}}
                        </td>
                    </tr>

                    <tr>
                        <td class="mt-2 text-sm font-semibold   @if($this->item == 2) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total Amount</td>
                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 2) text-white @else text-slate-400 @endif  dark:text-white  text-right">

                           {{number_format($this->totalOnprogress)}} TZS
                        </td>
                    </tr>




                </table>

            </div>

            <div  class="metric-card  dark:bg-gray-900 border @if($this->item == 3) bg-red-200 border-red-200 dark:border-red-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >
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


                            <div class="flex items-center text-l font-semibold spacing-sm text-green-800">Awaiting For Approval

                            </div>

                        </div>

                    </div>
                    <div class="flex items-center space-x-5" >

                        <svg wire:click="visit(3)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full bg-green p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>


                    </div>
                </div>



                <table>

                    <tr>
                        <td class="mt-2 text-sm font-semibold   @if($this->item == 3) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total Number Of Clients</td>
                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 3) text-white @else text-slate-400 @endif  dark:text-white text-right">

                            {{$this->awaitingForApproval}}
                        </td>
                    </tr>

                    <tr>
                        <td class="mt-2 text-sm font-semibold   @if($this->item == 3) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total Amount</td>
                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 3) text-white @else text-slate-400 @endif  dark:text-white text-right">

                            {{ number_format($this->totalAwaitingApproval)}} TZS
                        </td>
                    </tr>




                </table>

            </div>


        </div>


        <div class="grid gap-4 grid-cols-1 sm:grid-cols-3 my-2 w-full">

            <div class="metric-card  dark:bg-gray-900 border @if($this->item == 4) bg-red-200 border-red-200 dark:border-red-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >

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


                            <div class="flex items-center text-l font-semibold spacing-sm text-green-800">Awaiting Disbursement

                            </div>

                        </div>

                    </div>
                    <div class="flex items-center space-x-5" >

                        <svg wire:click="visit(4)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full bg-green p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>


                    </div>
                </div>



                <table>

                    <tr>
                        <td class="mt-2 text-sm font-semibold   @if($this->item == 4) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total Number Of Clients</td>
                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 4) text-white @else text-slate-400 @endif  dark:text-white text-right">

                            {{$this->awaitingDis}}
                        </td>
                    </tr>

                    <tr>
                        <td class="mt-2 text-sm font-semibold   @if($this->item == 4) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total Amount</td>
                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 4) text-white @else text-slate-400 @endif  dark:text-white text-right">

                            {{number_format($this->totalAwaitingDis)}} TZS
                        </td>
                    </tr>


                </table>

            </div>




            <div  class="metric-card  dark:bg-gray-900 border @if($this->item == 5) bg-red-200 border-red-200 dark:border-red-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >
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


                            <div class="flex items-center text-l font-semibold spacing-sm text-green-800">Client Rejected

                            </div>

                        </div>

                    </div>
                    <div class="flex items-center space-x-5" >

                        <svg wire:click="visit(5)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full bg-green p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>


                    </div>
                </div>
                <table>

                    <tr>
                        <td class="mt-2 text-sm font-semibold   @if($this->item == 5) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Number Of Rejected Clients</td>
                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 5) text-white @else text-slate-400 @endif  dark:text-white text-right">

                            6666
                        </td>
                    </tr>

                    <tr>
                        <td class="mt-2 text-sm font-semibold   @if($this->item == 5) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total Amount</td>
                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 5) text-white @else text-slate-400 @endif  dark:text-white text-right">

                            900 TZS
                        </td>
                    </tr>



                </table>

            </div>


            <div  class="metric-card  dark:bg-gray-900 border @if($this->item == 6) bg-red-200 border-red-200 dark:border-red-800  @else bg-white  border-gray-200 dark:border-gray-800 @endif rounded-lg p-4 max-w-72 w-full" >
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


                            <div class="flex items-center text-l font-semibold spacing-sm text-green-800">Active Loans

                            </div>

                        </div>

                    </div>
                    <div class="flex items-center space-x-5" >

                        <svg wire:click="visit(6)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-9 bg-slate-50 rounded-full bg-green p-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>


                    </div>
                </div>



                <table>

                    <tr>
                        <td class="mt-2 text-sm font-semibold   @if($this->item == 6) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total Active Loan</td>
                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 6) text-white @else text-slate-400 @endif  dark:text-white text-right">

                            {{$this->activeLoan}}
                        </td>
                    </tr>

                    <tr>
                        <td class="mt-2 text-sm font-semibold   @if($this->item == 6) text-white @else text-slate-400 @endif dark:text-white capitalize  ">Total Amount</td>
                        <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  @if($this->item == 6) text-white @else text-slate-400 @endif  dark:text-white text-right">

                            {{number_format($this->totalActive)}} TZS
                        </td>
                    </tr>


                </table>
            </div>

        </div>


    </div>

</div>
