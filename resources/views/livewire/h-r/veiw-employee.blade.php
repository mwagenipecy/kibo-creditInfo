<div>{{-- In work, do what you enjoy. --}}
    <div>
        <nav class="bg-red-200  rounded-lg pl-2 pr-2 shadow-2xl">
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
                                            $urlValue=  DB::table('clients')->where('client_number',Session::get('currentloanMember'))->value('profile_photo_path');
                                            ?>
                                            @if($urlValue)
                                                <img src="{{$urlValue}}">
                                            @else
                                                <img class="h-8 w-8 rounded-full" src="{{asset('/images/download-1.png')}}" alt="">
                                            @endif

                                        </button>

                                    </div>
                                    <p class="font-semibold ml-3 text-slate-600 text-white"> {{App\Models\Employee::where('id',Session::get('memberToViewId'))->value('first_name').' '.App\Models\Employee::where('id',Session::get('memberToViewId'))->value('middle_name').' '.App\Models\Employee::where('id',Session::get('memberToViewId'))->value('last_name')}}</p>

                                </div>
                                <div class="text-red-400 ml-4 mr-5 ">
                                    <div class="ml-12">
                                        {{App\Models\Employee::where('id',Session::get('memberToViewId'))->value('employee_status')}}
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="flex">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default:"text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        </div>

                        <button type="button" class="rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">

                            <svg wire:click="close()" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>

                    </div>
                </div>

            </div>

        </nav>

        <div class="relative flex py-5 items-center">
            <div class="flex-grow border-t border-gray-400"></div>
            <span class="flex-shrink mx-4 text-gray-400">Employee Data</span>
            <div class="flex-grow border-t border-gray-400"></div>
        </div>
        <div class="w-full h-full grid justify-items-center">
            <?php        $employees=\App\Models\Employee::where('id',session()->get('memberToViewId'))->get();                      ?>
            @foreach($employees as $employee)
                <div class="w-fit m-auto grid justify-items-center">
                    <div class="w-fit text-center m-4" >
                        @if($employee->profile_photo_path)
                            <div style="display: flex; justify-content: center;">
                                <img class="mb-3 w-32 h-32 rounded-full shadow-lg"
                                     src="{{$employee->profile_photo_path}}"
                                     alt="{{$employee->first_name}}"/>
                            </div>
                        @else
                            <div style="display: flex; justify-content: center;">
                                <img class="mb-3 w-32 h-32 rounded-full shadow-lg"
                                     src="{{asset('/images/download-1.png')}}"
                                     alt="{{$employee->first_name}}"/>
                            </div>
                        @endif
                        <p class="text-2xl mt-4 border-b-2 border-b-red-400 ">{{$employee->first_name}} {{$employee->middle_name}} {{$employee->last_name}}</p>
                        <p class="m-4">{{$employee->address}}</p>
                    </div>
                    <div class="w-fit bg-gray-200 rounded-lg pl-2 pr-2 pt-2 pb-2 ">
                        <!-- message container -->
                        <div>

                            <div class="flex">

                                <div class="container mx-auto ">
                                    <div class="flex flex-col w-full" >

                                        <div class="grid gap-2 grid-cols-1 sm:grid-cols-2 mb-2">


                                            <div class="metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72 w-full" >


                                                <table>

                                                    <tbody class="bg-white">
                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p> Gender</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900">
                                                                {{$employee->gender}}
                                                            </p>
                                                        </td>

                                                    </tr>
                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p> Marital status</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900">
                                                                {{$employee->marital_status}}
                                                            </p>
                                                        </td>

                                                    </tr>

                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p>Date of birth</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900">
                                                                {{$employee->date_of_birth}}
                                                            </p>
                                                        </td>

                                                    </tr>


                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p>Next of the kin phone number</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900">
                                                                {{$employee->next_of_kin_phone}}
                                                            </p>
                                                        </td>

                                                    </tr>


                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p>Email</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900">
                                                                {{$employee->email}}
                                                            </p>
                                                        </td>

                                                    </tr>

                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p> Membership Number</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900">
                                                                {{$employee->employee_number}}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72 w-full" >
                                                <table>
                                                    <tbody class="bg-white">
                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p> Employee  Type</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900">
                                                                {{$employee->Employement_type}}
                                                            </p>
                                                        </td>

                                                    </tr>
                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p>Next Kin Full Name</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900 whitespace-normal">
                                                                {{$employee->next_of_kin_name}}
                                                            </p>
                                                        </td>

                                                    </tr>

                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p> Incorporation Number</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900">
                                                                {{--                                                                    {{$currentMember->incorporation_number}}--}}
                                                            </p>
                                                        </td>

                                                    </tr>

                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p> Address</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900 whitespace-normal">
                                                                {{$employee->address}}
                                                            </p>
                                                        </td>

                                                    </tr>

                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p> Street</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900 whitespace-normal">
                                                                {{--                                                                    {{$currentMember->street}}--}}
                                                            </p>
                                                        </td>

                                                    </tr>

                                                    <tr class="whitespace-nowrap">
                                                        <td class="px-6 py-4 text-sm text-gray-500 font-semibold">
                                                            <p> Notes</p>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <p class="text-sm text-gray-900 whitespace-normal">
                                                                {{--                                                                    {{$currentMember->notes}}--}}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-1 w-full">
                                            <div class="metric-card  dark:bg-gray-900 border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4 max-w-72 w-full" >
                                                <div class="flex justify-between items-center w-full">
                                                    <div class="flex items-center">
                                                        <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
