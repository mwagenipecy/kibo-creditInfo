
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
                        CLIENT MANAGEMENT

                    </div>

                </div>
                <div>

                    <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-green-400 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            Total Clients: {{ App\Models\ClientsModel::count() }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-green-400 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            Active Clients: {{ App\Models\LoansModel::where('status',"ACTIVE")->distinct('client_number')->count() }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-green-400 dark:text-gray-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            New Clients  <span>
                                <span class="ml-2 bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400"> {{ App\Models\ClientsModel::where('client_status','NEW CLIENT')->count() }}</span>
                            </span>
                        </li>
                    </ul>
                </div>

            </div>

        </div>

        <!-- Dashboard actions -->
        <div class="bg-white p-4 sm:p-6 overflow-hidden mb-2 rounded-lg shadow-md shadow-gray-200">

            @if($this->viewClientDetails)


                @if($this->viewClientLoanData)
                    <nav class="bg-green-100   rounded-lg pl-2 pr-2 shadow-2xl">
                        <div class="relative flex h-16 items-center justify-between">
                            <div class="flex flex-1 items-center justify-between">
                                <div class="flex flex-shrink-0 items-start">
                                    <div class="flex items-center justify-between">
                                        <div wire:loading wire:target="menuItemClicked" >
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-gray-400" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                                </svg>
                                                <p>Please wait...</p>
                                            </div>

                                        </div>
                                        <div wire:loading.remove wire:target="menuItemClicked">

                                            <div class="flex items-center ">
                                                <div>
                                                    <button type="button" class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                                        <?php
                                                        $urlValue=  \App\Models\ClientsModel::where('client_number',Session::get('viewMemberLoan'))->value('profile_photo_path');
                                                        ?>
                                                        @if( $urlValue)
                                                            <img src="{{$urlValue}}">
                                                        @else
                                                            <img class="h-8 w-8 rounded-full" src="{{asset('/images/download-1.png')}}" alt="">
                                                        @endif

                                                    </button>

                                                </div>
                                                <p class="font-semibold ml-3 text-slate-600 text-green-900">{{App\Models\ClientsModel::where('client_number',Session::get('viewMemberLoan'))->value('first_name').' '.App\Models\ClientsModel::where('client_number',Session::get('viewMemberLoan'))->value('middle_name').' '.App\Models\ClientsModel::where('client_number',Session::get('viewMemberLoan'))->value('last_name')}}</p>

                                            </div>
                                            <div class="text-green-400 ml-4 mr-5 ">
                                                <div class="ml-6 text-blue-900 font-bold">
                                                    {{ strtoupper(App\Models\LoansModel::where('id',Session::get('currentloanID'))->value('status'))}}
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class="flex ">

                                    <button type="button" class="rounded-full bg-white p-1 text-gray-400 hover:text-blue-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                                        <svg wire:click="closeLoanData" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>

                                </div>
                            </div>

                        </div>

                    </nav>

                    <livewire:loans.client-table />


                @else



                <div>{{-- In work, do what you enjoy. --}}
                    <div>
                        <nav class="bg-green-100   rounded-lg pl-2 pr-2 shadow-2xl">
                            <div class="relative flex h-16 items-center justify-between">
                                <div class="flex flex-1 items-center justify-between">
                                    <div class="flex flex-shrink-0 items-start">
                                        <div class="flex items-center justify-between">
                                            <div wire:loading wire:target="menuItemClicked" >
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-gray-400" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                                    </svg>
                                                    <p>Please wait...</p>
                                                </div>

                                            </div>
                                            <div wire:loading.remove wire:target="menuItemClicked">

                                                <div class="flex items-center justify-between">
                                                    <div>
                                                        <button type="button" class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                                            <?php
                                                            $urlValue=  \App\Models\ClientsModel::where('id',Session::get('viewClientId'))->value('profile_photo_path');
                                                            ?>
                                                            @if($urlValue)
{{--                                                                <img class="mb-3 w-32 h-32 rounded-full shadow-lg" src="{{$urlValue}}">--}}
                                                            @else
                                                                <img class="h-8 w-8 rounded-full" src="{{asset('/images/download-1.png')}}" alt="">
                                                            @endif

                                                        </button>

                                                    </div>
                                                    <p class="font-semibold ml-3 text-slate-600 text-green-900"> {{App\Models\ClientsModel::where('id',Session::get('viewClientId'))->value('first_name').' '.App\Models\ClientsModel::where('id',Session::get('viewClientId'))->value('middle_name').' '.App\Models\ClientsModel::where('id',Session::get('viewClientId'))->value('last_name')}}</p>

                                                </div>


                                            </div>

                                        </div>

                                    </div>
                                    <div class="flex">
                                        <div class="flex space-x-4">
                                            <!-- Current: "bg-gray-900 text-white", Default:"text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                        </div>

                                        <button type="button" class="rounded-full bg-white p-1 text-gray-400 hover:text-blue-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">

                                            <svg wire:click="$toggle('viewClientDetails')" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </button>



                                    </div>
                                </div>

                            </div>

                        </nav>



                        <div class="w-full h-full p-2 ">
                            <?php        $employees=\App\Models\ClientsModel::where('id',session()->get('viewClientId'))->get();                      ?>
                            @foreach($employees as $employee)
                                <div class="w-full justify-items-center">

                                    <div class="w-full bg-gray-200 rounded-lg pl-2 pr-2 pt-2 pb-2 ">
                                        <!-- message container -->
                                        <div>

                                        <div class="flex w-full gap-2 mb-2">


                                                            <div class="metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4 w-1/3" >


                                                                <table>
                                                                    <tbody class="bg-white">
                                                                    @for ($i = 0; $i < 17; $i++)
                                                                        @if (isset($variables[$i]))
                                                                            <tr class="whitespace-nowrap">
                                                                                <td class="px-2 mr-2 py-4 text-sm text-gray-500 font-semibold">
                                                                                    <p>{{ $variables[$i]['label'] }}</p>
                                                                                </td>
                                                                                <td class="px-6 py-4">
                                                                                    <p class="text-sm text-gray-900">
                                                                                        {{ DB::table('clients')->where('id', Session::get('viewClientId'))->value($variables[$i]['name']) }}
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endfor
                                                                    </tbody>
                                                                </table>

                                                            </div>


                                                            <div class="metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4 w-1/3" >
                                                                <!-- Second Table -->
                                                                <table>
                                                                    <tbody class="bg-white">
                                                                    @for ($i = 17; $i < 34; $i++)
                                                                        @if (isset($variables[$i]))
                                                                            <tr class="whitespace-nowrap">
                                                                                <td class="px-2 mr-2 py-4 text-sm text-gray-500 font-semibold">
                                                                                    <p>{{ $variables[$i]['label'] }}</p>
                                                                                </td>
                                                                                <td class="px-6 py-4">
                                                                                    <p class="text-sm text-gray-900">
                                                                                        {{ DB::table('clients')->where('id', Session::get('viewClientId'))->value($variables[$i]['name']) }}
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endfor
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <div class=" metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4 w-1/3" >
                                                                <!-- Second Table -->
                                                                <table>
                                                                    <tbody class="bg-white">
                                                                    @for ($i = 34; $i < count($variables); $i++)
                                                                        @if (isset($variables[$i]))
                                                                            <tr class="whitespace-nowrap">
                                                                                <td class="px-2 mr-2 py-4 text-sm text-gray-500 font-semibold">
                                                                                    <p>{{ $variables[$i]['label'] }}</p>
                                                                                </td>
                                                                                <td class="px-6 py-4">
                                                                                    <p class="text-sm text-gray-900">
                                                                                        {{ DB::table('clients')->where('id', Session::get('viewClientId'))->value($variables[$i]['name']) }}
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endfor
                                                                    </tbody>
                                                                </table>
                                                            </div>



                                        </div>

                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                @endif

                @elseif($this->viewpaid)
                <div>
                    <livewire:dashboard.client-portfolio-table/>
                </div>
                @elseif($this->viewnotpaid)
                <div>
                    <livewire:dashboard.client-portfolio-table/>
                </div>

{{--            <livewire:clients.clients-table/>--}}
                @elseif($this->allMembers)
                    <livewire:clients.clients-table/>
            @endif



        </div>
    </div>




<!-- Log Out Other Devices Confirmation Modal -->
<x-jet-dialog-modal wire:model="showCreateNewClient">
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
            @endif

                <div class="w-full bg-white  p-4">

                    <div class="w-full">
                        <div class="mb-4">
                            <h5 >
                                CREATE Client
                            </h5>
                        </div>


                        <div class="col-span-6 sm:col-span-4 mb-4">


                            <p for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Client Name</p>
                            <x-jet-input id="name" type="text" name="name" class="mt-1 block w-full" wire:model.defer="name" autofocus />
                            @error('name')
                            <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                <p>The name is mandatory and should be more than three characters.</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>


                            <p for="region" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Region</p>
                            <x-jet-input id="region" name="region" type="text" class="mt-1 block w-full" wire:model.defer="region" autofocus />
                            @error('region')
                            <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                <p>The region is mandatory and should be more than three characters.</p>
                            </div>
                            @enderror

                            <div class="mt-2"></div>

                            <p for="wilaya" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Wilaya</p>
                            <x-jet-input id="wilaya" name="wilaya" type="text" class="mt-1 block w-full" wire:model.defer="wilaya" autofocus />
                            @error('wilaya')
                            <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                <p>The wilaya is mandatory and should be more than three characters.</p>
                            </div>
                            @enderror

                            <div class="mt-2"></div>

                            <p for="membershipNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Clientship Number</p>
                            <x-jet-input id="membershipNumber" name="membershipNumber" type="text" class="mt-1 block w-full" wire:model.defer="membershipNumber" autofocus />
                            @error('membershipNumber')
                            <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                <p>The membership number is mandatory, it should be more than three characters and unique.</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>


                            <p for="parentClient" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Parent Client</p>
                            <select wire:model.bounce="parentClient" name="parentClient" id="parentClient" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Select</option>
                                @foreach(App\Models\ClientsModel::all() as $Client)
                                <option value="{{$Client->id}}">{{$Client->name}}</option>
                                @endforeach

                            </select>
                            @error('parentClient')
                            <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                <p>The Parent Client is mandatory.</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>

                        </div>






                    </div>




                </div>



        </div>



    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showCreateNewClient')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
        <div wire:loading.remove>
        <x-jet-button class="ml-3"
                      wire:click="submit"
                      wire:loading.attr="disabled">
            {{ __('Create user') }}
        </x-jet-button>
        </div>
        <div wire:loading>
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








    <div class="w-full container-fluid">

        @if($this->showDeleteClient)

            <div class="fixed z-10 inset-0 overflow-y-auto"  >
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                    <div class="fixed inset-0 transition-opacity">
                        <div class="absolute inset-0 bg-gray-500 opacity-0"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <!-- Your form elements go here -->
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
                                    @if($this->clientSelected)
                                        <p  class="block mb-1 text-sm capitalize text-slate-400 dark:text-white ">Client Selected</p>
                                        <div class="flex items-center mb-2 text-sm spacing-sm text-slate-600 mt-2" >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <p>{{ App\Models\ClientsModel::where('id', $this->clientSelected)->value('first_name') }}</p>
                                        </div>
                                        <div class="mt-4 w-full">
                                            <p for="ClientSelected" class="block mb-1 text-sm capitalize text-slate-400 dark:text-white ">SELECT ACTION</p>
                                            <div class="flex gap-4 items-center text-center">
                                                <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="BLOCKED" checked  > Block Client
                                                <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="ACTIVE" /> Activate Client
                                                <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="DELETED" /> Delete Client
                                            </div>
                                            @if($this->permission=="DELETED")
                                                <div class="active:text-inherit p-4 mt-4">
                                                    <label> Upload exit  document</label>
                                                    <x-jet-input type="file" wire:model="member_exit_document"  requigreen></x-jet-input>
                                                </div>
                                            @endif
                                        </div>
                                        <p for="password" class="block mb-1 mt-4 text-sm capitalize text-slate-400 dark:text-white ">ENTER PASSWORD TO CONFIRM</p>
                                        <input wire:model.defer="password" id="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                                        <x-jet-input-error for="current_password" class="mt-2" />
                                    @endif
                                </div>
                            </div>
                            <div class="mt-8"></div>
                        </div>


                        <!-- Add more form fields as needed -->
                        <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                            <button type="button" wire:click="$toggle('showDeleteClient')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                                Cancel
                            </button>
                            {{--                            <button type="submit" wire:click="addBranch" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">--}}
                            {{--                                Proceed--}}
                            {{--                            </button>--}}
                            <button wire:click="confirmPassword" wire:loading.attr="disabled" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-400 border border-transparent rounded-md focus-visible:ring-2 focus-visible:ring-offset-2">
                                <span wire:loading wire:target="confirmPassword">Loading...</span>
                                <span wire:loading.remove>Proceed</span>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>


<x-jet-dialog-modal wire:model="showAddClient">
    <x-slot name="title">

    </x-slot>

    <x-slot name="content">











        <div>


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

                    @if (session()->has('message_fail'))

                        <div class="bg-green-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                    <p class="font-bold">The process fail</p>
                                    <p class="text-sm">{{ session('message_fail') }} </p>
                                </div>
                            </div>
                        </div>
                @endif
            </div>


            <div class="justify-center">


                <section class=" w-full bg-white-300 flex flex-col items-center justify-center">
                    @if ($this->photo)
                        <img class="object-fill w-5/5 rounded-l-lg" src="{{ $photo->temporaryUrl() }}">
                    @else
                        @if ($this->profile_photo_path)
                            <img class="object-fill w-5/5 rounded-l-lg" src="{{$this->profile_photo_path}}">
                        @else

                        @endif

                    @endif
                </section>




                <div class="  w-full  flex items-center justify-center hover:bg-gray-100 hover:border-gray-300">



                    <label class="flex flex-col w-full h-19 cursor-pointer">
                        <div class="flex flex-col items-center justify-center pt-7">

                            <div wire:loading wire:target="photo" class="" >

                                <svg style="width: 50%; margin: 0 auto;" xmlns="http://www.w3.org/2000/svg" class="animate-spin  w-8 h-8 text-gray-400 group-hover:text-gray-600" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                </svg>
                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">Please wait...</p>

                            </div>

                            <div wire:loading.remove wire:target="photo" class="flex flex-col items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400 group-hover:text-gray-600"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                    Select new image</p>

                            </div>

                        </div>



                        <input type="file" class="opacity-0" wire:model="photo"/>
                    </label>
                </div>
                    @error('photo') <span class="error">{{ $message }}</span> @enderror
            </div>
            <x-jet-section-border />

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="phone_number" value="{{ __('Phone Number (Reference Number)') }}" />
                <x-jet-input id="phone_number" type="text" class="mt-1 block w-full" wire:model="phone_number" />
                <x-jet-input-error for="phone_number" class="mt-2" />
            </div>

            @if($this->phone_number)
                <div class="font-bold mb-4">
                    <div class="flex space-x-4 space-y-1">
                        <div class="p-1">Registration fees:  {{number_format(DB::table('pending_registrations')->where('phone_number',$this->phone_number)->where('status','INITIAL PAY')->value('amount'))}} TZS
                        </div>
                    </div>
                    <div class="space-x-4 flex space-y-1">
                        <div class="p-1"> Allocated shares:
                            {{ number_format(DB::table('pending_registrations')->where('phone_number',$this->phone_number)->where('status','ACTIVE')->value('amount'))}}TZS
                        </div>
                    </div>
                </div>
        @endif
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="first_name" value="{{ __('First Name') }}" />
                <x-jet-input id="first_name" type="text" class="mt-1 block w-full" wire:model.defer="first_name" autocomplete="first_name" />

                <x-jet-input-error for="first_name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="middle_name" value="{{ __('Middle Name') }}" />
                <x-jet-input id="middle_name" type="text" class="mt-1 block w-full" wire:model.defer="middle_name" autocomplete="middle_name" />
                <x-jet-input-error for="middle_name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
                <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="last_name" autocomplete="last_name" />
                <x-jet-input-error for="last_name" class="mt-2" />
            </div>


            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="incorporation_number" value="{{ __('Incorporation Number') }}" />
                <x-jet-input id="incorporation_number" type="text" class="mt-1 block w-full" wire:model.defer="incorporation_number" />
                <x-jet-input-error for="incorporation_number" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="next_of_kin_name" value="{{ __('Next of Kin Full Name') }}" />
                <x-jet-input id="next_of_kin_name" type="text" class="mt-1 block w-full" wire:model.defer="next_of_kin_name" />
                <x-jet-input-error for="next_of_kin_full_name" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="next_of_kin_phone" value="{{ __('Next of Kin Phone Number') }}" />
                <x-jet-input id="next_of_kin_phone" type="text" class="mt-1 block w-full" wire:model.defer="next_of_kin_phone" />
                <x-jet-input-error for="next_of_kin_phone" class="mt-2" />
            </div>




            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="business_name" value="{{ __('Business Name') }}" />

                <x-jet-input id="business_name" name="business_name" type="text" class="mt-1 block w-full" wire:model.defer="business_name" />
                @error('business_name')
                <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                    <p>Business Name is mandatory, it should be more than three characters.</p>
                </div>
                @enderror
            </div>









            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="nationarity" value="{{ __('Nationarity') }}" />
                <x-jet-input id="nationarity" type="text" class="mt-1 block w-full" wire:model.defer="nationarity" />
                <x-jet-input-error for="nationarity" class="mt-2" />
            </div>


            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="date_of_birth" value="{{ __('Date Of Birth') }}" />
                <x-jet-input id="date_of_birth" type="date" class="mt-1 block w-full" wire:model.defer="date_of_birth" />
                <x-jet-input-error for="date_of_birth" class="mt-2" />
            </div>



            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="gender" value="{{ __('Gender') }}" />
                <select wire:model.defer="gender" name="gender" id="gender" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>

                </select>
                @error('gender')
                <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                    <p>Gender is mandatory.</p>
                </div>
                @enderror

            </div>


            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="marital_status" value="{{ __('Marital Status') }}" />
                <select wire:model.defer="marital_status" name="marital_status" id="marital_status" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    <option  value="Married">Married</option>
                    <option  value="Single">Single</option>
                    <option  value="Divorced">Divorced</option>
                    <option  value="Widow">Widow</option>

                </select>
                @error('marital_status')
                <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                    <p>Marital Status is mandatory.</p>
                </div>
                @enderror

            </div>


            <div class="col-span-6 sm:col-span-4">

                <div class="mt-3 max-w-xl text-sm text-gray-600">
                    <p>
                        {{ __('By changing the branch of the member, you are transferring the member from the previous branch to newly selected branch. A new Account will be created for this member .') }}
                    </p>
                </div>
            </div>
            <br>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <label for="branch" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Branch</label>
                <select wire:model.bounce="branch" name="branch" id="branch" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    @foreach(App\Models\BranchesModel::all() as $branch)
                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                    @endforeach

                </select>
                @error('branch')
                <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                    <p>Branch is mandatory.</p>
                </div>
                @enderror

            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <label for="membership_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Clientship Type</label>
                <select wire:model.bounce="membership_type" name="membership_type" id="membership_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    <option value="Individual">Individual</option>
                    <option value="Group">Group</option>
                    <option value="Business">Business</option>


                </select>
                @error('membership_type')
                <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                    <p>Clientship Type is mandatory.</p>
                </div>
                @enderror

            </div>


            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="street" value="{{ __('Street') }}" />
                <x-jet-input id="street" name="street" type="text" class="mt-1 block w-full" wire:model.defer="street" />
                @error('street')
                <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                    <p>Street is mandatory, it should be more than three characters and unique.</p>
                </div>
                @enderror
            </div>



            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="address" value="{{ __('Residential Address') }}" />
                <x-jet-input id="address" name="address" type="text" class="mt-1 block w-full" wire:model.defer="address" />
                @error('address')
                <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                    <p>Address is mandatory, it should be more than three characters.</p>
                </div>
                @enderror
            </div>


            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="notes" value="{{ __('Notes') }}" />
                <textarea id="notes" name="notes" wire:model.defer="notes" rows="4" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your notes..."></textarea>
                @error('notes')
                <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                    <p>Notes is mandatory, it should be more than three characters.</p>
                </div>
                @enderror
            </div>






        </div>





    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showAddClient')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
        <div wire:loading.remove wire:target="addClient" >
            <x-jet-button class="ml-3"
                          wire:click="addClient"
                          wire:loading.attr="disabled">
                {{ __('Proceed') }}
            </x-jet-button>
        </div>
        <div wire:loading wire:target="addClient">
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


    <div class="w-full container-fluid">

        @if($this->showEditClient)

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



                            <div class="bg-white p-4">

                                <div class="mb-4">
                                    <h5 >
                                        EDIT CLIENT : {{$this->pendingClientname}}
                                    </h5>
                                </div>


                                @if($this->client)



                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="membership_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Client Type</label>
                                        <select wire:model="membership_type"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="" selected >select</option>
                                            <option value="individual" >Individual</option>
                                            <option value="company">Company</option>


                                        </select>
                                        @error('membership_type')
                                        <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                            <p>Client Type is mandatory.</p>
                                        </div>
                                        @enderror

                                    </div>
                                    @if($this->membership_type == "individual")
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Gender</label>
                                            <select wire:model.defer="gender"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="" selected >select</option>
                                                <option value="Male" >Male</option>
                                                <option value="Female">Female</option>


                                            </select>
                                            @error('gender')
                                            <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                                <p>Gender is mandatory.</p>
                                            </div>
                                            @enderror

                                        </div>
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="marital_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Marital Status</label>
                                            <select wire:model.defer="marital_status"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="" selected >select</option>
                                                <option value="Single" >Single</option>
                                                <option value="Married" >Married</option>
                                                <option value="Widow" >Widow</option>
                                                <option value="Widower" >Widower</option>
                                                <option value="Divorced" >Divorced</option>



                                            </select>
                                            @error('marital_status')
                                            <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                                <p>Marital Status is mandatory.</p>
                                            </div>
                                            @enderror

                                        </div>
                                    @endif


                                    @foreach ($this->variables as $variable)
                                        @if($this->membership_type == $variable['for'] or $variable['for'] == 'both')
                                            <div class="col-span-6 sm:col-span-4">
                                                <x-jet-label for="{{ $variable['name'] }}" value="{{ __($variable['label']) }}" />
                                                <x-jet-input id="{{ $variable['name'] }}" type="{{ $variable['type'] }}" class="mt-1 block w-full" wire:model.defer="{{ $variable['name'] }}" />
                                                <x-jet-input-error for="{{ $variable['name'] }}" class="mt-2" />
                                            </div>

                                        @endif


                                    @endforeach

                                @endif

                            </div>




                            <div class="mt-2"></div>

                        </div>

                        <!-- Add more form fields as needed -->
                        <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                            <button type="button" wire:click="$toggle('showEditClient')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                                Cancel
                            </button>
                            {{--                            <button type="submit" wire:click="addBranch" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">--}}
                            {{--                                Proceed--}}
                            {{--                            </button>--}}
                            <button wire:click="updateClient" wire:loading.attr="disabled" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-400 border border-transparent rounded-md focus-visible:ring-2 focus-visible:ring-offset-2">
                                <span wire:loading wire:target="updateClient">Loading...</span>
                                <span wire:loading.remove>Proceed</span>
                            </button>

                        </div>
                    </div>
                </div>
            </div>

        @endif

    </div>







</div>




