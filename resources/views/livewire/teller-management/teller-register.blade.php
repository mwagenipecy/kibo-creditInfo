
<div>
    {{-- Do your work, then step back. --}}
    <div class="">
        <div class="bg-white  mb-3 ">
            <button wire:click="showRegisterTellerModal()" class="mr-4 flex text-center items-center    bg-gray-100   text-gray-400 font-semibold    py-2 px-4 rounded-lg" onmouseover="this.style.backgroundColor='#e63b3d'; this.style.color='#333333';" onmouseout="this.style.backgroundColor=''; this.style.color='';">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 fill-current">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                New Till
            </button>
        </div>
        <livewire:teller-management.teller-table/>
    </div>



    <div class="w-full container-fluid">

        @if($this->createNewTeller)
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
                            </div>
                            <div class="header-elements text-center justify-center font-bold  stroke-current">
                                <h3 class="fw-bold">
                                    CREATE NEW TELLER
                                </h3>
                            </div>

                            <div class="mt-5"> </div>
                            <div class="mt-5"> </div>
                            <x-jet-label for="branch_id" value="{{ __('Select Branch') }}" />
                            <select wire:model="branch_id" name="branch_id" id="branch_id" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected unselected >Select ....</option>
                                @foreach(DB::table('branches')->get() as $employee)
                                    <option  value=" {{$employee->id}}">{{$employee->name}}</option>
                                @endforeach
                            </select>
                            @error('branch_id')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Branch is mandatory.</p>
                            </div>
                            @enderror
                            <x-jet-label for="max_amount" value="{{ __('Max Amount ') }}" />
                            <input id="max_amount" name="max_amount" type="text" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="max_amount" autofocus >
                            </input>
                            @error('max_amount')
                            <div class="border border-red-400 rounded-b text-red-100 px-4 py-3 text-red-700 mt-1">
                                <p> Amount  is mandatory</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>

                            <div class="mt-2">

                            </div><div class="mt-2"></div>

                        </div>
                        <!-- Add more form fields as needed -->
                        <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">

                            {{--                            <button type="button" wire:click="$toggle('createNewTeller')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">--}}
                            {{--                                Cancel--}}
                            {{--                            </button>--}}

                            <button wire:click="$toggle('createNewTeller')"  class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                                <span>Cancel</span>
                            </button>


                            <button
                                    wire:click="createTeller"
                                    wire:loading.attr="disabled"
                                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 "
                            >
                                <span wire:loading.remove>Proceed</span>
                                <span wire:loading>Loading...</span>
                            </button>



                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="w-full container-fluid">

        @if($this->editTellerInfomation)
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
                                @if (session()->has('message_fail'))
                                    <div class="bg-red-100 border-t-4 border-yellow-500 rounded-b text-yellow-900 px-4 py-3 shadow-md mb-8" role="alert">
                                        <div class="flex">
                                            <div class="py-1"><svg class="fill-current h-6 w-6 text-yellow-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                            <div>
                                                <p class="font-bold">Error</p>
                                                <p class="text-sm">{{ session('message_fail') }} </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="header-elements text-center justify-center font-bold  stroke-current">
                                <h3 class="fw-bold">
                                    EDIT NEW TELLER
                                </h3>
                            </div>

                            <div class="mt-5"> </div>


                            <div class="mt-5"> </div>
                            <x-jet-label for="branch_id" value="{{ __('Select Branch') }}" />
                            <select wire:model="branch_id" name="branch_id" id="branch_id" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach(DB::table('branches')->get() as $employee)
                                    <option  value="{{$employee->id}}">{{$employee->name}}</option>
                                @endforeach
                            </select>

                            @error('branch_id')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Branch is mandatory.</p>
                            </div>
                            @enderror

                            <x-jet-label for="max_amount" value="{{ __('Max transaction ') }}" />
                            <input id="max_amount" name="max_amount" type="text" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   wire:model="max_amount" autofocus >
                            @error('max_amount')
                            <div class="border border-red-400 rounded-b text-red-100 px-4 py-3 text-red-700 mt-1">
                                <p> Amount  is mandatory</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>

                            <div class="mt-2"></div>

                            <div class="mt-2">

                            </div><div class="mt-2"></div>

                        </div>
                        <!-- Add more form fields as needed -->
                        <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                            <button type="button" wire:click="$toggle('editTellerInfomation')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                                Cancel
                            </button>
                            <button type="submit" wire:click="updateTeller" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                                Proceed
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>






    <div class="w-full container-fluid">

        @if($this->deleteTellerModal)
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

                                @if (session()->has('message_fail'))
                                    <div class="bg-red-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                        <div class="flex">
                                            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                            <div>
                                                <p class="font-bold">The process is uncompleted</p>
                                                <p class="text-sm">{{ session('message_fail') }} </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="header-elements text-center justify-center font-bold  stroke-current">
                                <h3 class="fw-bold">
                                    TELLER ACTION
                                </h3>
                            </div>
                            <div class="mt-5"> </div>
                            <div class="p-4 m-4">
                                <div class="flex gap-4 items-center text-center">
                                    <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="BLOCKED" checked  > Block
                                    <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="ACTIVE" /> Activate
                                    <input  wire:model="permission" name="setSubMenuPermission" type="radio" value="REMOVE" /> Remove Teller
                                </div>
                            </div>

                            <x-jet-label for="Password" value="{{ __('Password ') }}" />
                            <input id="password" name="password" type="password"  class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                                   wire:model="password" autofocus >

                            @error('password')
                            <div class="border border-red-400 rounded-b text-red-100 px-4 py-3 text-red-700 mt-1">
                                <p> password  is mandatory</p>
                            </div>
                            @enderror
                            <div class="mt-2"></div>

                            <div class="mt-2">

                            </div><div class="mt-2"></div>

                        </div>
                        <!-- Add more form fields as needed -->
                        <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                            <button type="button" wire:click="$toggle('deleteTellerModal')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                                Cancel
                            </button>
                            <button type="submit" wire:click="deletetellerAction" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                                Proceed
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>




    <div class="w-full container-fluid">

        @if($this->assignNewTellerModal)
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

                                @if (session()->has('message_fail'))
                                    <div class="bg-red-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
                                        <div class="flex">
                                            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                            <div>
                                                <p class="font-bold">The process is uncompleted</p>
                                                <p class="text-sm">{{ session('message_fail') }} </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="header-elements text-center justify-center font-bold  stroke-current">
                                <h3 class="fw-bold">
                                    ASSIGN  TELLER
                                </h3>
                            </div>
                            <div class="mt-5"> </div>

                            <x-jet-label for="branch_id" value="{{ __('Assign to Employee') }}" />
                            <select wire:model="employee_details" name="employee_details" id="employee_details" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value=""  unselected >Select ....</option>
                                @foreach(DB::table('employees')->get() as $employee)
                                    <option  value=" {{$employee->id}}" >{{$employee->first_name}} {{$employee->last_name}} </option>
                                @endforeach
                            </select>
                            @error('employee_details')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Employee is mandatory.</p>
                            </div>
                            @enderror

                            @if($this->employee_details)
                                <div class="mt-1 mx-2">
                                    <div class="fw-bold">

                                        <div class="max-w-md mx-auto bg-white p-4 rounded-lg shadow">
                                            <table class="w-full">
                                                <thead>
                                                <tr>
                                                    <td class="py-2">Full Name :</td>
                                                    <td class="py-2 fw-light">{{DB::table('employees')->where('id',$this->employee_details)->value('first_name') .' '.DB::table('employees')->where('id',$this->employee_details)->value('middle_name') .' '.DB::table('employees')->where('id',$this->employee_details)->value('last_name')}}</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr class="border-t-2">
                                                    <td class="py-2">Branch  :</td>
                                                    <td class="py-2">{{DB::table('branches')->where('id',DB::table('employees')->where('id',$this->employee_details)->value('branch'))->value('name'). '  '.DB::table('branches')->where('id',DB::table('employees')->where('id',$this->employee_details)->value('branch'))->value('region').'  '.DB::table('branches')->where('id',DB::table('employees')->where('id',$this->employee_details)->value('branch'))->value('wilaya')}}</td>
                                                </tr>
                                                <tr class="border-t-2">
                                                    <td class="py-2">Department :</td>
                                                    <td class="py-2">{{DB::table('departments')->where('id',DB::table('employees')->where('id',$this->employee_details)->value('department'))->value('department_name')}}</td>
                                                </tr>
                                                @if(DB::table('tellers')->where('employee_id',$this->employee_details )->first()!=null)
                                                    <tr class="border-t-2">
                                                        <td class="py-2"> :Currently</td>
                                                        <td class="py-2">{{ DB::table('accounts')->where('id',DB::table('tellers')->where('employee_id',$this->employee_details)->value('account_id'))->value('account_name')}}</td>
                                                    </tr>
                                                @endif

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="mt-2"></div>

                            <div class="mt-2">

                            </div><div class="mt-2"></div>

                        </div>
                        <!-- Add more form fields as needed -->
                        <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                            <button type="button" wire:click="$toggle('assignNewTellerModal')" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                                Cancel
                            </button>
                            <button type="submit" wire:click="assignEmployeeToTellerPosition" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                                Proceed
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>



</div>
