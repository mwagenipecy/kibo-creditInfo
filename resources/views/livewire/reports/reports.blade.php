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
                            <stop stop-color="#e63b3d" offset="0%" /> <!-- Dark red -->
                            <stop stop-color="#e63b3d" offset="100%" /> <!-- Light red -->
                        </linearGradient>
                        <linearGradient x1="50%" y1="24.537%" x2="50%" y2="100%" id="welcome-c">
                            <stop stop-color="#e63b3d" offset="0%" /> <!-- Light red -->
                            <stop stop-color="#e63b3d" stop-opacity="0" offset="100%" /> <!-- Dark red -->
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
                    <div class="text-xl text-slate-400 font-bold mb-1 ">
                        REPORTS  MANAGEMENT

                    </div>

                </div>
                <div>

                    <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-red-400 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            Total Transactions ({{DB::table('general_ledger')->distinct('reference_number')->count()}}): {{number_format(DB::table('general_ledger')->distinct('reference_number')->sum('debit'))}} TZS
                        </li>
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-red-400 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            Total Clients accounts: {{ App\Models\ClientsModel::count() }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-red-400 dark:text-gray-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
{{--                            Pending activities:  <span>--}}
{{--                                <span class="ml-2 bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400"> {{ App\Models\AccountsModel::count() }}</span>--}}
{{--                            </span>--}}
                        </li>
                    </ul>
                </div>

            </div>

        </div>






        <!-- Dashboard actions -->

        <div class="bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-2xl shadow-md shadow-gray-200">
            <div class="w-full border-b border-gray-200 dark:border-gray-700">
            </div>

            <div class="grid grid-cols-6 gap-2 p-2">
                @php
                    $menuItems = [
                        ['id' => 1, 'label' => 'Daily  Report'],
                        ['id' => 2, 'label' => 'Clients Details Report'],
                        ['id' => 3, 'label' => 'Client Loan Accounts'],
                        ['id' => 4, 'label' => 'Client Repayment History'],
                        ['id' => 5, 'label' => 'Loan Portfolio Report'],
                        ['id' => 6, 'label' => 'Loan Application Report'],
                        ['id' => 7, 'label' => 'Loan Delinquency Report'],
                        ['id' => 8, 'label' => 'Loan Disbursement and Repayment History'],

                        ['id' => 9, 'label' => 'Financial Ratios and Metrics'],

                        ['id' => 10, 'label' => 'Loan Approval and Rejection Report'],
                        ['id' => 11, 'label' => 'Loan Committee Meeting Minutes'],
                        ['id' => 12, 'label' => 'Compliance CheckList Report'],
                        ['id' => 13, 'label' => 'Compliance  Report'],


                    ];
                @endphp

                @foreach ($menuItems as $menuItem)
                    <button
                            wire:click="menuItemClicked({{ $menuItem['id'] }})"
                            class="flex hover:text-white text-center items-center w-full
            @if ($this->tab_id == $menuItem['id']) bg-red-500 @else bg-gray-100 @endif
                            @if ($this->tab_id == $menuItem['id']) text-white font-bold @else text-gray-400 font-semibold @endif
                                    py-2 px-4 rounded-lg"

                            onmouseover="this.style.backgroundColor='#e63b3d'; this.style.color='#333333';"
                            onmouseout="this.style.backgroundColor=''; this.style.color='';"
                    >

                        <div wire:loading wire:target="menuItemClicked({{ $menuItem['id'] }})">
                            <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-900 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                        </div>
                        <div wire:loading.remove wire:target="menuItemClicked({{ $menuItem['id'] }})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red"
                                 class="w-4 h-4 mr-2 fill-current">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>

                        </div>



                        {{ $menuItem['label'] }}
                    </button>
                @endforeach
            </div>


            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">



            <div class="w-full flex items-center justify-center p-4">
                <div wire:loading wire:target="setView">
                    <div class="h-96 m-auto flex items-center justify-center">
                        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-red-500"></div>
                    </div>
                </div>
            </div>
            <div wire:loading.remove wire:target="setView">
                {{--                <livewire:reports.main-report />--}}


















                <div class="p-1">
                    {{--                    <h1 class="text-3xl font-semibold mb-4">General Report</h1>--}}
{{--                    <div class="flex w-full mb-4 gap-2 ">--}}
{{--                        <!-- Left: Avatars -->--}}
{{--                        @if($this->tab_id==1)--}}

{{--                        <div class="bg-white flex justify-end  shadow-md shadow-gray-200 w-full p-2 flex  gap-2 items-center " style="height: 100px">--}}
{{--                               @if(auth()->user()->branch == DB::table('branches')->where('name','HQ')->value('id'))--}}
{{--                                <div class="ml-2">--}}
{{--                                    <label for="sortByBranch" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">--}}
{{--                                        sort by branch--}}
{{--                                    </label>--}}
{{--                                    <div class="relative ">--}}
{{--                                        <select wire:model.bounce="sortByBranch" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">--}}
{{--                                            <option value='' >select</option>--}}
{{--                                            @foreach(DB::table('branches')->get() as $branch)--}}
{{--                                                <option value={{ $branch->id }} >{{ $branch->name }}</option>--}}
{{--                                            @endforeach--}}

{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                               @endif--}}

{{--                            <div class="ml-2">--}}
{{--                                <label for="category1" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">--}}
{{--                                    sort category--}}
{{--                                </label>--}}
{{--                                <div class="relative ">--}}

{{--                                    --}}{{--                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">--}}
{{--                                    --}}{{--                                    </div>--}}
{{--                                    <select wire:model.bounce="ReportCategory" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">--}}
{{--                                        <option  value="1">All Transaction Records</option>--}}
{{--                                        <option  value="2">New Clients</option>--}}
{{--                                        <option value="3">OnProgress</option>--}}
{{--                                        <option value="4">Awaiting For Approval</option>--}}
{{--                                        <option  value="5">Awaiting Disbursement</option>--}}
{{--                                        <option value="6">Client Rejected</option>--}}
{{--                                        <option value="7">Active Loans</option>--}}
{{--                                        <option value="8">Arrears</option>--}}
{{--                                        <option  value="9">PAR 1 - 10 (Days)</option>--}}
{{--                                        <option  value="10">PAR 10 - 30 (Days)</option>--}}
{{--                                        <option  value="11">PAR 30 - 90 (Days)</option>--}}
{{--                                        <option  value="12">PAR Above 90 (Days)</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="ml-2">--}}
{{--                                <label for="category2" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">--}}
{{--                                    Start Date--}}
{{--                                </label>--}}
{{--                                <div class="relative ">--}}
{{--                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">--}}
{{--                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>--}}
{{--                                        </svg>--}}
{{--                                    </div>--}}
{{--                                    <input datepicker datepicker-autohide wire:model="startDate"  type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Select date">--}}
{{--                                </div>--}}
{{--                                {{$this->startDate}}--}}
{{--                            </div>--}}

{{--                            <div class="ml-2">--}}
{{--                                <label for="category" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">--}}
{{--                                    End Date--}}
{{--                                </label>--}}
{{--                                <div class="relative ">--}}
{{--                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">--}}
{{--                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>--}}
{{--                                        </svg>--}}
{{--                                    </div>--}}
{{--                                    <input datepicker datepicker-autohide wire:model="endDate"  type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Select date">--}}
{{--                                </div>--}}
{{--                            </div>--}}



{{--                        </div>--}}
{{--                        @endif--}}

{{--                        @if($this->tab_id==2)--}}

{{--                            <div class="bg-white  shadow-md shadow-gray-200 w-full p-2 flex  gap-2 items-center " style="height: 100px">--}}
{{--                                <table>--}}
{{--                                    <tr>--}}
{{--                                        <td class="text-left  p-2"><h6>Total Issued Loan ({{Carbon\Carbon::now()->year}}) </h6></td>--}}
{{--                                        <td class="text-left p-2"><h6> Active Loan  </h6></td>--}}
{{--                                        <td class="text-left  p-2"><h6> Loan At Risk (PAR 20 days ..) </h6></td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <th class="uppercase text-left p-2" > <h3>{{DB::table('loans')->count()}} </h3> </th>--}}
{{--                                        <th class="uppercase text-left p-2"> <h3>{{number_format(DB::table('loans')->where('status','ACTIVE')->sum('principle'))}} TZS</h3> </th>--}}
{{--                                        <th class="uppercase text-left p-2"> <h3> {{number_format(DB::table('loans')->where('days_in_arrears','>',0)->sum('principle'))}} TZS</h3> </th>--}}
{{--                                    </tr>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                            <div class="bg-white flex justify-end  shadow-md shadow-gray-200 w-full p-2 flex  gap-2 items-center " style="height: 100px">--}}
{{--                                @if(auth()->user()->branch == DB::table('branches')->where('name','HQ')->value('id'))--}}
{{--                                <div class="ml-2">--}}
{{--                                    <label for="" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">--}}
{{--                                        sort by branch--}}
{{--                                    </label>--}}
{{--                                    <div class="relative ">--}}
{{--                                        <select  wire:model="changeBranch"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">--}}
{{--                                            <option value="" >select</option>--}}
{{--                                            @foreach(DB::table('branches')->get() as $branch)--}}
{{--                                                <option value="{{json_encode($branch->id)}}" >{{ $branch->name }}</option>--}}
{{--                                            @endforeach--}}

{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                @endif--}}
{{--                                <div class="ml-2">--}}
{{--                                    <label for="category1" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">--}}
{{--                                        sort category--}}
{{--                                    </label>--}}
{{--                                    <div class="relative ">--}}

{{--                                        --}}{{--                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">--}}
{{--                                        --}}{{--                                    </div>--}}
{{--                                        <select wire:model="loanItems" wire:change="LoanItems"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">--}}

{{--                                            <option  value="All">All Loans</option>--}}
{{--                                            <option  value="COMPLETED">Completed Loans</option>--}}
{{--                                            <option value="ACTIVE">Active Loans </option>--}}
{{--                                            <option value="4">Loans with Arrears</option>--}}
{{--                                            <option  value="5"> Loan With Penalties </option>--}}
{{--                                            <option value="6">Non-performing Loans </option>--}}
{{--                                            <option value="7">Top Up Loans</option>--}}
{{--                                            <option value="SECURED">Secured Loans</option>--}}
{{--                                            <option  value="UNSECURED">Unsecured Loans</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="ml-2">--}}
{{--                                    <label for="category2" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">--}}
{{--                                        Start Date--}}
{{--                                    </label>--}}
{{--                                    <div class="relative ">--}}
{{--                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">--}}
{{--                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>--}}
{{--                                            </svg>--}}
{{--                                        </div>--}}
{{--                                        <input datepicker datepicker-autohide wire:model="startDate"  type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Select date">--}}
{{--                                    </div>--}}
{{--                                    --}}{{--                                {{$this->startDate}}--}}
{{--                                </div>--}}
{{--                                <div class="ml-2">--}}
{{--                                    <label for="category" class="block mb-2 dark:text-gray-400 space-x-2 text-sm font-semibold spacing-sm text-slate-600">--}}
{{--                                        End Date--}}
{{--                                    </label>--}}
{{--                                    <div class="relative ">--}}
{{--                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">--}}
{{--                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>--}}
{{--                                            </svg>--}}
{{--                                        </div>--}}
{{--                                        <input datepicker datepicker-autohide wire:model="endDate"  type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Select date">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        @endif--}}

{{--                    </div>--}}

                    @switch($this->tab_id)

                        @case('1')
                        <livewire:reports.daily-report />
{{--                            @switch($this->ReportCategory)--}}
{{--                               @case('1')--}}
{{--                            <livewire:reports.general-report  />--}}
{{--                                   @break--}}
{{--                               @case('2')--}}
{{--                              <livewire:reports.loan-reports />--}}
{{--                               @break   @case('3')--}}

{{--                               @break   @case('4')--}}
{{--                              <livewire:reports.loan-reports />--}}
{{--                               @break   @case('5')--}}
{{--                              <livewire:reports.loan-reports />--}}
{{--                               @break   @case('6')--}}
{{--                              <livewire:reports.loan-reports />--}}
{{--                               @break   @case('7')--}}
{{--                              <livewire:reports.loan-reports />--}}
{{--                               @break--}}
{{--                        @endswitch--}}

                        @break

                        @case('2')
                            <livewire:reports.clients-details-report />
{{--                            <livewire:reports.general-loan-report />--}}
                        @break
                     @case('3')
                        <livewire:reports.client-loan-account />
                    @break
                        @case('4')
                        <livewire:reports.client-loan-account />
                    @break

                        @case('5')
                        <livewire:reports.client-repayment-history />
                    @break

                        @case('6')
                        <livewire:reports.loan-portifolio-report />
                    @break

                        @case('7')
                    
                        <livewire:reports.loan-delinquency-report />
                    @break

                        @case('13')
                        <div class="bg-gray-200 p-1 rounded-2xl">


                            <div class="bg-white p-4 rounded-2xl mb-1">

                                <div class="flex gap-4 w-full ">

                                    <div>
                                        <div>
                                            From Date
                                            <input wire:model="reportStartDate" type="date" class="mb-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                                            @error('reportStartDate')
                                            <div class="text-red-500 text-xs"> start date is required</div>
                                            @enderror
                                            To

                                            <input wire:model="reportEndDate" type="date" class="mb-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">


                                            @error('reportEndDate')
                                            <div class="text-red-500 text-xs"> end date is required</div>
                                            @enderror
                                        </div>


                                    </div>

                                    <div class=" mt-10">
                                        <div class="inline-flex rounded-md shadow-sm mb-4" role="group">
                                            <button wire:click="downloadExcelFile" type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-2 focus:ring-red-700 focus:text-red-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-red-500 dark:focus:text-white">
                                                <svg class="w-3 h-3 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"></path>
                                                    <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"></path>
                                                </svg>
                                                Download Excel
                                            </button>

                                            <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-2 focus:ring-red-700 focus:text-red-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-red-500 dark:focus:text-white">
                                                <svg class="w-3 h-3 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"></path>
                                                    <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"></path>
                                                </svg>
                                                Downloads PDF
                                            </button>

                                        </div>
                                    </div>

                                    <div class=" mt-10">


                                        <div class="flex items-center mb-4">
                                            <input wire:model="customize" id="default-checkbox" type="radio"  name="radion" value="NO" class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Default settings</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input wire:model="customize" checked id="checked-checkbox" name="radion" type="radio" value="YES" class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checked-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Custom settings</label>
                                        </div>

                                    </div>
                                    <div class=" flex ">
                                        @if($this->customize=="YES")
{{--                                            <div>--}}
{{--                                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Client Number</label>--}}
{{--                                                <label for="first_name" class="block mb-2 text-xs font-medium text-gray-900 dark:text-white">for more than one client put a comma in between</label>--}}
{{--                                                <input wire:model="custome_client_number" type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="eg. 0001" required>--}}
{{--                                            </div>--}}



                                        @else

                                        @endif
                                    </div>

                                </div>



                            </div>

                        </div>

                        @break

                        @default
                        @if($this->ReportCategory==1)
                            <livewire:reports.general-report  />
                        @elseif($this->ReportCategory > 1 && $this->ReportCategory < 8 )
                            <livewire:reports.loan-reports />
                        @endif
                    @endswitch
                </div>
            </div>
        </div>
    </div>
    <!-- Log Out Other Devices Confirmation Modal -->

{{--    <script>--}}
{{--        flatpickr('[datepicker]', {--}}
{{--            dateFormat: "Y-m-d"--}}
{{--            , autoHide: true--}}
{{--            , allowInput: true--}}
{{--            , minDate: "2000-01-01"--}}
{{--            , maxDate: new Date().fp_incr(14)--}}
{{--        });--}}
{{--    </script>--}}
</div>
