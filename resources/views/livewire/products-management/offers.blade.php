
<div>
    <div class="p-2">

        <!-- Welcome banner -->
        <div class="relative p-4 mb-2 overflow-hidden rounded-lg bg-white" >

            <!-- Background illustration -->
            <div class="absolute right-0 top-0 -mt-4 mr-16 pointer-events-none hidden xl:block" aria-hidden="true">
                <svg width="319" height="198" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <path id="welcome-a" d="M64 0l64 128-64-20-64 20z" />
                        <path id="welcome-e" d="M40 0l40 80-40-12.5L0 80z" />
                        <path id="welcome-g" d="M40 0l40 80-40-12.5L0 80z" />
                        <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="welcome-b">
                            <stop stop-color="#005A06" offset="0%" /> <!-- Dark Blue -->
                            <stop stop-color="#005A06" offset="100%" /> <!-- Light Blue -->
                        </linearGradient>
                        <linearGradient x1="50%" y1="24.537%" x2="50%" y2="100%" id="welcome-c">
                            <stop stop-color="#005A06" offset="0%" /> <!-- Light Blue -->
                            <stop stop-color="#005A06" stop-opacity="0" offset="100%" /> <!-- Dark Blue -->
                        </linearGradient>
                    </defs>
                    <g fill="none" fill-rule="evenodd">
                        <g transform="rotate(64 36.592 105.604)">
                            <mask id="welcome-d" fill="#fff">
                                <use xlink:href="#welcome-a" />
                            </mask>
                            <use fill="url(#welcome-b)" xlink:href="#welcome-a" />
                            <path fill="url(#welcome-c)" mask="url(#welcome-d)" d="M64-24h80v152H64z" />
                        </g>
                        <g transform="rotate(-51 91.324 -105.372)">
                            <mask id="welcome-f" fill="#fff">
                                <use xlink:href="#welcome-e" />
                            </mask>
                            <use fill="url(#welcome-b)" xlink:href="#welcome-e" />
                            <path fill="url(#welcome-c)" mask="url(#welcome-f)" d="M40.333-15.147h50v95h-50z" />
                        </g>
                        <g transform="rotate(44 61.546 392.623)">
                            <mask id="welcome-h" fill="#fff">
                                <use xlink:href="#welcome-g" />
                            </mask>
                            <use fill="url(#welcome-b)" xlink:href="#welcome-g" />
                            <path fill="url(#welcome-c)" mask="url(#welcome-h)" d="M40.333-15.147h50v95h-50z" />
                        </g>
                    </g>
                </svg>
            </div>

            <!-- Content -->
            <div class="relative w-full">
                <div class="min-w-full text-center text-sm font-light">
                    <div class="text-xl text-green-800 font-bold mb-1 ">
                        OFFER MANAGEMENT

                    </div>

                </div>
                <div>

                    <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-green-400 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            Total Offers: {{ App\Models\OffersModel::count() }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-green-400 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            Active Offers: {{ App\Models\OffersModel::count() }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-green-400 dark:text-gray-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            New Offers  <span>
                                <span class="ml-2 bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400"> {{ App\Models\OffersModel::where('offer_status','NEW OFFER')->count() }}</span>
                            </span>
                        </li>
                    </ul>
                </div>

            </div>

        </div>

        <!-- Dashboard actions -->
        <div class="bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-lg shadow-md shadow-gray-200">

            <livewire:products-management.offers-table />

        </div>
    </div>

    {{-- Modal Section --}}
    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            Offer
        </x-slot>

        <x-slot name="content">





            <div class="w-full" >

                <!-- message container -->
                <div>
                    @if (session()->has('loan_commit'))

                        @if (session('alert-class') == 'alert-success')
                            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                <div class="flex">
                                    <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                    <div>
                                        <p class="font-bold">The process is completed</p>
                                        <p class="text-sm">{{ session('loan_commit') }} </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>

                <div class="w-full " >

                    <hr class="boder-b-0 my-2"/>



                    <div class="w-full   rounded rounded-lg shadow-sm   p-1 " >
                        <div class="w-full bg-white rounded rounded-lg shadow-sm   p-2 " >
                            <table class="w-full">

                                <tr>
                                    <td class="text-xs text-slate-400 dark:text-white capitalize  text-left">
                                        <p>Requested Amount</p>
                                    </td>
                                    <td class="text-xs text-slate-400 dark:text-white text-right">
                                        <p> {{number_format($this->principle,2)}} TZS</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-xs text-slate-400 dark:text-white capitalize  text-left">
                                        <p>Interest</p>
                                    </td>
                                    <td class="text-xs text-slate-400 dark:text-white text-right">
                                        <p> {{$this->interest}} %</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-xs text-slate-400 dark:text-white capitalize  text-left">
                                        <p> Tenure </p>
                                    </td>
                                    <td class="text-xs text-slate-400 dark:text-white text-right">
                                        <p>{{$this->tenure}} Months</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-xs text-slate-400 dark:text-white capitalize  text-left">
                                        <p>Installment</p>
                                    </td>
                                    <td class="text-xs text-slate-400 dark:text-white text-right">
                                        <p>As per schedule</p>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>

                </div>


                <div class="w-full bg-white rounded px-6 rounded-lg shadow-sm  " >


                    <div id="stability3" class="w-full bg-gray-50 rounded rounded-lg shadow-sm  p-1 " >
                        <div class="w-full bg-white rounded rounded-lg shadow-sm   p-2 " >

                            <table class="w-full">
                                <thead>
                                <tr>
                                    <th>INSTALLMENT</th>
                                    <th>INTEREST</th>
                                    <th>PRINCIPLE</th>
                                    <th>BALANCE</th>

                                </tr>
                                </thead>
                                <tbody>


                                @if($this->table )
                                    @foreach($this->table as $tr)
                                        <tr>
                                            <td class="text-xs text-slate-400 dark:text-white text-right">
                                                <p>{{number_format($tr['Payment'],2)}}</p>
                                            </td>

                                            <td class="text-xs text-slate-400 dark:text-white text-right">
                                                <p>{{number_format($tr['Interest'],2)}}</p>
                                            </td>

                                            <td class="text-xs text-slate-400 dark:text-white text-right">
                                                <p>{{number_format($tr['Principle'],2)}}</p>
                                            </td>

                                            <td class="text-xs text-slate-400 dark:text-white text-right">
                                                <p>{{number_format($tr['balance'],2)}}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif


                                </tbody>

                                <tfoot>
                                @if($this->table )
                                @foreach($this->tablefooter as $tr)
                                    <tr>
                                        <td class="text-sm font-bold text-black dark:text-white text-right">
                                            <p class="text-sm font-bold text-black">{{number_format($tr['Payment'],2)}}</p>
                                        </td>
                                        <td class="text-xs text-slate-400 dark:text-white text-right">
                                            <p class="text-sm font-bold text-black">{{number_format($tr['Interest'],2)}}</p>
                                        </td>
                                        <td class="text-xs text-slate-400 dark:text-white text-right">
                                            <p class="text-sm font-bold text-black">{{number_format($tr['Principle'],2)}}</p>
                                        </td>
                                        <td class="text-xs text-slate-400 dark:text-white text-right">
                                            <p class="text-sm font-bold text-black">{{number_format($tr['balance'],2)}}</p>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                                </tfoot>

                            </table>


                        </div>
                    </div>


                </div>

            </div>







        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="decline()" wire:loading.attr="disabled">
                {{ __('Decline') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="accept()" wire:loading.attr="disabled">
                {{ __('Accept') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>


</div>




