<div class="w-2/3">
    <div>



        <div class="bg-gray-100 rounded px-6 rounded-lg shadow-sm  pt-4 pb-4 ">

            @foreach($this->approvals as $approval)


                <div class="flex items-center justify-between ">

                    <div class="flex-1 pl-2">
                        <p class="text-gray-700 font-semibold">
                            {{App\Models\User::where('id',$approval->user_id)->value('name')}}
                            {{$approval->process_description}}.
                        </p>

                        @if( $approval->process_code == '01')
                        @foreach(App\Models\Branches::where('id',$approval->process_id)->get() as $branch)
                            <div class="flex-1">
                                <p class="text-gray-700 font-semibold">
                                    {{$branch->name}}
                                </p>
                                <p class="text-gray-600 font-thin">
                                    {{$branch->region}} - {{$branch->wilaya}} : Clientship No {{$branch->membershipNumber}}
                                </p>
                            </div>
                                <div class="w-full md:flex mt-2 flex justify-end" >
                                    <div class="flex mr-4" >
                                    <div wire:loading wire:target="rejectCreateBranch({{$branch->id}},'{{$approval->id}}')">
                                        <button class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400"
                                                disabled>
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="animate-spin  h-5 w-5 mr-2 stroke-white-800"
                                                     fill="white" viewBox="0 0 24 24"
                                                     stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                </svg>
                                                <p>Please wait...</p>
                                            </div>
                                        </button>
                                    </div>
                                    <div wire:loading.remove wire:target="rejectCreateBranch({{$branch->id}},'{{$approval->id}}')">
                                        <button wire:click="rejectCreateBranch({{$branch->id}},'{{$approval->id}}')"
                                                class="text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400">
                                            <p class="text-white">Reject</p>
                                        </button>

                                    </div>

                                </div>

                                <div class="flex">
                                    <div wire:loading wire:target="approveCreateBranch({{$branch->id}},'{{$approval->id}}')">
                                        <button class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400"
                                                disabled>
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="animate-spin  h-5 w-5 mr-2 stroke-white-800"
                                                     fill="white" viewBox="0 0 24 24"
                                                     stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                </svg>
                                                <p>Please wait...</p>
                                            </div>
                                        </button>
                                    </div>
                                    <div wire:loading.remove wire:target="approveCreateBranch({{$branch->id}},'{{$approval->id}}')">
                                        <button wire:click="approveCreateBranch({{$branch->id}},'{{$approval->id}}')"
                                                class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                            <p class="text-white">Approve</p>
                                        </button>

                                    </div>

                                </div>


                            </div>

                        @endforeach
                        @endif


                        @if( $approval->process_code == '02')
                            @foreach(App\Models\Branches::where('id',$approval->process_id)->get() as $branch)
                                <div class="flex-1 mb-4">
                                    <p class="text-gray-700 font-semibold">
                                        {{$branch->name}}
                                    </p>
                                    <p class="text-gray-600 font-thin">
                                        {{$branch->region}} - {{$branch->wilaya}} : Clientship No {{$branch->membershipNumber}}
                                    </p>
                                    @php

                                            $changes = json_decode($approval->edit_package, true);


                                    @endphp
                                    <div class="w-full rounded bg-white pt-1 pb-1 mt-4 ">
                                    @foreach($changes as $key => $value)
                                        @php
                                            $dbValue = App\Models\Branches::where('id',$approval->process_id)->value($key);
                                        @endphp

                                        @if($dbValue != $value)

                                                <div class="flex bg-gray-100 rounded rounded-lg shadow-sm  m-2 p-4">
                                                    <p class="text-gray-700 font-semibold mr-2">
                                                        {{ucwords($key)}}
                                                    </p>
                                                    <p class="text-gray-600 font-thin mr-2">
                                                        :
                                                    </p>
                                                    <p class="text-gray-600 font-thin mr-2">
                                                        {{$dbValue}}
                                                    </p>
                                                    <p class="text-gray-700 font-semibold mr-2">
                                                         to
                                                    </p>
                                                    <p class="text-gray-600 font-thin mr-2">
                                                        {{$value}}
                                                    </p>
                                                </div>

                                        @endif

                                    @endforeach
                                    </div>


                                </div>

                                <div class="w-full md:flex mt-2 flex justify-end" >

                                    <div class="flex mr-4" >
                                        <div wire:loading wire:target="rejectEditBranch({{$approval->id}})">
                                            <button class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400"
                                                    disabled>
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="animate-spin  h-5 w-5 mr-2 stroke-white-800"
                                                         fill="white" viewBox="0 0 24 24"
                                                         stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                    </svg>
                                                    <p>Please wait...</p>
                                                </div>
                                            </button>
                                        </div>
                                        <div wire:loading.remove wire:target="rejectEditBranch({{$approval->id}})">
                                            <button wire:click="rejectEditBranch({{$approval->id}})"
                                                    class="text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400">
                                                <p class="text-white">Reject</p>
                                            </button>

                                        </div>

                                    </div>

                                    <div class="flex">
                                        <div wire:loading wire:target="approveEditBranch({{$branch->id}},'{{$approval->id}}','{{$approval->edit_package}}')">
                                            <button class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400"
                                                    disabled>
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="animate-spin  h-5 w-5 mr-2 stroke-white-800"
                                                         fill="white" viewBox="0 0 24 24"
                                                         stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                    </svg>
                                                    <p>Please wait...</p>
                                                </div>
                                            </button>
                                        </div>
                                        <div wire:loading.remove wire:target="approveEditBranch({{$branch->id}},'{{$approval->id}}','{{$approval->edit_package}}')">
                                            <button wire:click="approveEditBranch({{$branch->id}},'{{$approval->id}}','{{$approval->edit_package}}')"
                                                    class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                                <p class="text-white">Approve</p>
                                            </button>

                                        </div>

                                    </div>


                                </div>

                            @endforeach
                        @endif


                        @if( $approval->process_code == '03')
                            @foreach(App\Models\Branches::where('id',$approval->process_id)->get() as $branch)
                                <div class="flex-1">
                                    <p class="text-gray-700 font-semibold">
                                        {{$branch->name}}
                                    </p>
                                    <p class="text-gray-600 font-thin">
                                        {{$branch->region}} - {{$branch->wilaya}} : Clientship No {{$branch->membershipNumber}}
                                    </p>
                                </div>

                                <div class="w-full md:flex mt-2 flex justify-end" >

                                    <div class="flex mr-4" >
                                        <div wire:loading wire:target="rejectDeleteBranch({{$branch->id}},'{{$approval->id}}')">
                                            <button class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400"
                                                    disabled>
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="animate-spin  h-5 w-5 mr-2 stroke-white-800"
                                                         fill="white" viewBox="0 0 24 24"
                                                         stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                    </svg>
                                                    <p>Please wait...</p>
                                                </div>
                                            </button>
                                        </div>
                                        <div wire:loading.remove wire:target="rejectDeleteBranch({{$branch->id}},'{{$approval->id}}')">
                                            <button wire:click="rejectCreateBranch({{$branch->id}},'{{$approval->id}}')"
                                                    class="text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400">
                                                <p class="text-white">Reject</p>
                                            </button>

                                        </div>

                                    </div>

                                    <div class="flex">
                                        <div wire:loading wire:target="approveDeleteBranch({{$branch->id}},'{{$approval->id}}')">
                                            <button class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400"
                                                    disabled>
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="animate-spin  h-5 w-5 mr-2 stroke-white-800"
                                                         fill="white" viewBox="0 0 24 24"
                                                         stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                    </svg>
                                                    <p>Please wait...</p>
                                                </div>
                                            </button>
                                        </div>
                                        <div wire:loading.remove wire:target="approveDeleteBranch({{$branch->id}},'{{$approval->id}}')">
                                            <button wire:click="approveDeleteBranch({{$branch->id}},'{{$approval->id}}')"
                                                    class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                                <p class="text-white">Approve</p>
                                            </button>

                                        </div>

                                    </div>


                                </div>

                            @endforeach
                        @endif


                        @if( $approval->process_code == '09')
                            @foreach(App\Models\AccountsModel::where('id',$approval->process_id)->get() as $accounts)
                                <div class="flex-1">
                                    <p class="text-gray-700 font-semibold">
                                        Client Name : {{App\Models\Clients::where('membership_number',$accounts->member_number)->value('first_name')}}
                                        {{App\Models\Clients::where('membership_number',$accounts->member_number)->value('middle_name')}}
                                        {{App\Models\Clients::where('membership_number',$accounts->member_number)->value('last_name')}}
                                        {{App\Models\Clients::where('membership_number',$accounts->member_number)->value('business_name')}}
                                    </p>
                                    <p class="text-gray-700 font-semibold">
                                        Clientship Type : {{App\Models\Clients::where('membership_number',$accounts->member_number)->value('membership_type')}}
                                    </p>
                                    <p class="text-gray-700 font-semibold">
                                        Clientship Number : {{$accounts->member_number}}
                                    </p>
                                    <p class="text-gray-700 font-semibold">
                                        Branch : {{App\Models\Branches::where(
                                                'id',
                                                App\Models\Clients::where('membership_number',$accounts->member_number)->value('branch')
                                                )->value('name')}}
                                    </p>
                                    <p class="text-gray-600 font-thin">
                                        Account Product : {{App\Models\sub_products::where('sub_product_id',$accounts->sub_product_number)->value('sub_product_name')}}
                                    </p>
                                    <p class="text-gray-600 font-thin">
                                        Account Number : {{$accounts->account_number}}
                                    </p>
                                </div>

                                <div class="w-full md:flex mt-2 flex justify-end" >

                                    <div class="flex mr-4" >
                                        <div wire:loading wire:target="rejectCreateAccount({{$accounts->id}},'{{$approval->id}}')">
                                            <button class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400"
                                                    disabled>
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="animate-spin  h-5 w-5 mr-2 stroke-white-800"
                                                         fill="white" viewBox="0 0 24 24"
                                                         stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                    </svg>
                                                    <p>Please wait...</p>
                                                </div>
                                            </button>
                                        </div>
                                        <div wire:loading.remove wire:target="rejectCreateAccount({{$accounts->id}},'{{$approval->id}}')">
                                            <button wire:click="rejectCreateAccount({{$accounts->id}},'{{$approval->id}}')"
                                                    class="text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400">
                                                <p class="text-white">Reject</p>
                                            </button>

                                        </div>

                                    </div>

                                    <div class="flex">
                                        <div wire:loading wire:target="approveCreateAccount({{$accounts->id}},'{{$approval->id}}')">
                                            <button class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400"
                                                    disabled>
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="animate-spin  h-5 w-5 mr-2 stroke-white-800"
                                                         fill="white" viewBox="0 0 24 24"
                                                         stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                    </svg>
                                                    <p>Please wait...</p>
                                                </div>
                                            </button>
                                        </div>
                                        <div wire:loading.remove wire:target="approveCreateAccount({{$accounts->id}},'{{$approval->id}}')">
                                            <button wire:click="approveCreateAccount({{$accounts->id}},'{{$approval->id}}')"
                                                    class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                                <p class="text-white">Approve</p>
                                            </button>

                                        </div>

                                    </div>


                                </div>

                            @endforeach
                        @endif

                        @if( $approval->process_code == '12')
                            @foreach(App\Models\Clients::where('id',$approval->process_id)->get() as $member)
                                <div class="w-full flex">

                                    <div class="w-3/4">
                                        <p class="text-gray-700 font-semibold">
                                            Client Name : {{ $member->first_name }} {{$member->middle_name  }} {{$member->last_name  }} {{$member->business_name}}

                                        </p>
                                        <p class="text-gray-700 font-semibold">
                                            Clientship Type : {{$member->membership_type}}
                                        </p>
                                        <p class="text-gray-700 font-semibold">
                                            Clientship Number : {{$member->membership_number}}
                                        </p>
                                        <p class="text-gray-700 font-semibold">
                                            Date of birth : {{$member->date_of_birth}}
                                        </p>
                                        <p class="text-gray-700 font-semibold">
                                            Branch : {{App\Models\Branches::where(
                                                'id',
                                                $member->branch
                                                )->value('name')}}
                                        </p>


                                        <div class="mt-4"></div>

                                        <table class="w-full" >


                                            <tr >
                                                <td class="mt-2 text-sm font-semibold  text-slate-400 dark:text-white capitalize  ">
                                                    <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">
                                                        Clientship application payment
                                                    </p>

                                                    <div class="flex-grow border-t border-gray-400"></div>
                                                </td>


                                            </tr>

                                            <tr >
                                                <td class="mt-2 text-sm font-semibold  text-slate-400 dark:text-white capitalize  ">
                                                    <p> {{App\Models\general_ledger::where('partner_bank_transaction_reference_number',$member->ref_number)->value('narration')}}</p>
                                                </td>
                                                <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  text-slate-400 dark:text-white">

                                                    <p>{{strtolower(App\Models\general_ledger::where('partner_bank_transaction_reference_number',$member->ref_number)->value('record_on_account_number'))}}</p>
                                                </td>
                                                <td class="pl-2 mt-2 text-l font-bold font-semibold spacing-sm  text-black dark:text-white text-right">

                                                    <p>{{number_format(App\Models\general_ledger::where('partner_bank_transaction_reference_number',$member->ref_number)->value('credit'),2)}} TZS</p>
                                                </td>
                                            </tr>


                                            <tr class="mt-4">
                                                <td class="mt-2 text-sm font-semibold  text-slate-400 dark:text-white capitalize  ">
                                                    <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">
                                                        Mandatory Shares Payment
                                                    </p>

                                                    <div class="flex-grow border-t border-gray-400"></div>
                                                </td>


                                            </tr>

                                            <tr >
                                                <td class="mt-2 text-sm font-semibold  text-slate-400 dark:text-white capitalize  ">
                                                    <p> {{App\Models\general_ledger::where('partner_bank_transaction_reference_number',$member->shares_ref_number)->value('narration')}}</p>
                                                </td>
                                                <td class="pl-2 mt-2 text-sm font-semibold spacing-sm  text-slate-400 dark:text-white">

                                                    <p>{{strtolower(App\Models\general_ledger::where('partner_bank_transaction_reference_number',$member->shares_ref_number)->value('record_on_account_number'))}}</p>
                                                </td>
                                                <td class="pl-2 mt-2 text-l font-bold font-semibold spacing-sm  text-black dark:text-white text-right">

                                                    <p>{{number_format(App\Models\general_ledger::where('partner_bank_transaction_reference_number',$member->shares_ref_number)->value('credit'),2)}} TZS</p>
                                                </td>
                                            </tr>


                                        </table>




                                    </div>

                                    <div class="w-1/4">
                                        <div style="display: flex; justify-content: center;">
                                            <img class="mb-3 w-32 h-32 rounded-full shadow-lg"
                                                 src="https://zima.services/pamojacbs/storage/app/public/{{$member->profile_photo_path}}"
                                                 alt="{{$member->first_name}}"/>
                                        </div>
                                    </div>


                                </div>

                                <div class="w-full md:flex mt-2 flex justify-end" >

                                    <div class="flex mr-4" >
                                        <div wire:loading wire:target="rejectCreateClient({{$member->id}},'{{$approval->id}}')">
                                            <button class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400"
                                                    disabled>
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="animate-spin  h-5 w-5 mr-2 stroke-white-800"
                                                         fill="white" viewBox="0 0 24 24"
                                                         stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                    </svg>
                                                    <p>Please wait...</p>
                                                </div>
                                            </button>
                                        </div>
                                        <div wire:loading.remove wire:target="rejectCreateClient({{$member->id}},'{{$approval->id}}')">

                                            @php

                                            @endphp
                                            <button wire:click="rejectCreateClient({{$member->id}},'{{$approval->id}}')"
                                                    class="text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400">
                                                <p class="text-white">Reject</p>
                                            </button>

                                        </div>

                                    </div>

                                    <div class="flex">
                                        <div wire:loading wire:target="approveCreateClient({{$member->id}},'{{$approval->id}}')">
                                            <button disabled class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400"
                                                    >
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="animate-spin  h-5 w-5 mr-2 stroke-white-800"
                                                         fill="white" viewBox="0 0 24 24"
                                                         stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                    </svg>
                                                    <p>Please wait...</p>
                                                </div>
                                            </button>
                                        </div>



                                        <div wire:loading.remove wire:target="approveCreateClient({{$member->id}},'{{$approval->id}}')">
                                            <button @if(
                                                        $this->validateAge($member->date_of_birth)
                                                         &&
                                                        App\Models\general_ledger::where('partner_bank_transaction_reference_number',$member->ref_number)->value('credit') >=
                                                        App\Models\institutions::where('institution_id',Session::get('institution'))->value('application_fee')
                                                        &&
                                                        App\Models\general_ledger::where('partner_bank_transaction_reference_number',$member->shares_ref_number)->value('credit') >=
                                                        (
                                                            App\Models\institutions::where('institution_id',Session::get('institution'))->value('value_per_share') *
                                                            App\Models\institutions::where('institution_id',Session::get('institution'))->value('initial_shares')
                                                        )
                                                        ) @else disabled @endif
                                            wire:click="approveCreateClient({{$member->id}},'{{$approval->id}}')"
                                                    class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                                <p class="text-white">Approve</p>
                                            </button>

                                        </div>

                                    </div>


                                </div>

                            @endforeach
                        @endif

                        @if( $approval->process_code == '14')
                            @foreach(App\Models\institutions::where('id',$approval->process_id)->get() as $institution)
                                <div class="flex-1 mb-4">
                                    <p class="text-gray-700 font-semibold">
                                        {{$institution->name}}
                                    </p>
                                    <p class="text-gray-600 font-thin">
                                        {{$institution->region}} - {{$institution->wilaya}} : Clientship No {{$institution->membershipNumber}}
                                    </p>
                                    @php

                                        $changes = json_decode($approval->edit_package, true);


                                    @endphp
                                    <div class="w-full rounded bg-white pt-1 pb-1 mt-4 ">
                                        @foreach($changes as $key => $value)

                                            @php

                                               $dbValue = App\Models\institutions::where('id',$approval->process_id)->value($key);
                                            @endphp

                                            @if($dbValue != $value)

                                                <div class="flex bg-gray-100 rounded rounded-lg shadow-sm  m-2 p-4">
                                                    <p class="text-gray-700 font-semibold mr-2">
                                                        {{ucwords($key)}}
                                                    </p>
                                                    <p class="text-gray-600 font-thin mr-2">
                                                        :
                                                    </p>
                                                    <p class="text-gray-600 font-thin mr-2">
                                                        {{$dbValue}}
                                                    </p>
                                                    <p class="text-gray-700 font-semibold mr-2">
                                                        to
                                                    </p>
                                                    <p class="text-gray-600 font-thin mr-2">
                                                        {{$value}}
                                                    </p>
                                                </div>

                                            @endif

                                        @endforeach
                                    </div>


                                </div>

                                <div class="w-full md:flex mt-2 flex justify-end" >

                                    <div class="flex mr-4" >
                                        <div wire:loading wire:target="rejectEditInstitution({{$approval->id}})">
                                            <button class=" text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400"
                                                    >
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="animate-spin  h-5 w-5 mr-2 stroke-white-800"
                                                         fill="white" viewBox="0 0 24 24"
                                                         stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                    </svg>
                                                    <p>Please wait...</p>
                                                </div>
                                            </button>
                                        </div>
                                        <div wire:loading.remove wire:target="rejectEditInstitution({{$approval->id}})">
                                            <button wire:click="rejectEditInstitution({{$approval->id}})"
                                                    class="text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400">
                                                <p class="text-white">Reject</p>
                                            </button>

                                        </div>

                                    </div>

                                    <div class="flex">
                                        <div wire:loading wire:target="approveEditInstitution({{$institution->id}},'{{$approval->id}}','{{$approval->edit_package}}')">
                                            <button class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400"
                                                    disabled>
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="animate-spin  h-5 w-5 mr-2 stroke-white-800"
                                                         fill="white" viewBox="0 0 24 24"
                                                         stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>

                                                    </svg>
                                                    <p>Please wait...</p>
                                                </div>
                                            </button>
                                        </div>
                                        <div wire:loading.remove wire:target="approveEditInstitution({{$institution->id}},'{{$approval->id}}','{{$approval->edit_package}}')">
                                            <button wire:click="approveEditInstitution({{$institution->id}},'{{$approval->id}}','{{$approval->edit_package}}')"
                                                    class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                                <p class="text-white">Approve</p>
                                            </button>

                                        </div>

                                    </div>


                                </div>

                            @endforeach
                        @endif


                    </div>




                    </div>

                    <hr class="boder-b-0 my-4"/>
                    @endforeach

                    </div>
                    </div>
                    </div>
