
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


    <div class="w-full bg-gray-100 p-2 rounded-2xl shadow-md shadow-gray-200">

            <div class="flex w-full gap-2">



                <div class="bg-white w-1/3 rounded-2xl shadow-md shadow-gray-200 p-4">

                    <div class="mb-4">
                        <h5 >
                            ASSIGN ROLES TO A USER
                        </h5>
                    </div>


                    <div class="form-group col-span-6 sm:col-span-4 mb-4">

                        <x-jet-label for="pendinguser" value="{{ __('Select a user') }}" />
                        <select id="pendinguser" wire:model="pendinguser" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm sm:px-3 sm:text-sm h-10" required>
                            <option value="" selected>Select</option>

                            @foreach($this->pendingUsers as $pendingUser)
                                <option value="{{$pendingUser->id}}">{{$pendingUser->name}} : {{$pendingUser->email}}</option>

                            @endforeach
                        </select>

                        @error('pendinguser')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Please select a user first.</p>
                        </div>
                        @enderror

                    </div>

                    @if($this->pendinguser)
                        @if($this->department)
                    <div class="form-group col-span-6 sm:col-span-4 mb-4">

                        <x-jet-label for="department" value="{{ __('User department') }}" />

                        <select id="department" wire:model="department" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm sm:px-3 sm:text-sm h-10" required>
                            <option value="" selected>{{$this->department}}</option>

                            @foreach($this->departmentList as $department)
                                <option value="{{$department->id}}">{{$department->department_name}}</option>

                            @endforeach
                        </select>
                        @error('department')
                        <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                            <p>Please select a department first.</p>
                        </div>
                        @enderror

                    </div>
                        @endif


                    <div class="flex justify-end w-auto" >
                        <div wire:loading wire:target="save" >
                            <button class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400" disabled>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin  h-5 w-5 mr-2 stroke-white-800" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />

                                    </svg>
                                    <p>Please wait...</p>
                                </div>
                            </button>
                        </div>

                    </div>


                    <div class="flex justify-end w-auto" >
                        <div wire:loading.remove wire:target="save" >
                            <button wire:click="save" class="text-white bg-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                Save
                            </button>

                        </div>
                    </div>
                    @endif

                </div>


                <div class="w-2/3 bg-white rounded-2xl shadow-md shadow-gray-200 p-4">

                @if($this->department)
                <div class="mb-4">
                        <h5 >
                            ASSIGN ROLES TO A USER
                        </h5>
                    </div>

                <div class="flex flex-wrap mt-4 max-w-64">

                    @foreach($this->menusArray as $sub_menu)

                        <div class="flex-shrink-0 w-1/3 border-2 border-gray-200 m-2 p-2 rounded-2xl">
                        <div class="text-l font-semibold">{{$sub_menu->user_action}}</div>
                        <input wire:click="setPermission('0-{{$sub_menu->ID}}-{{$sub_menu->menu_id}}')" name="setSubMenuPermission{{$sub_menu->ID}}" type="radio" value="0-{{$sub_menu->ID}}" @if($sub_menu->permission == 0) checked @endif > Allow
                        <input wire:click="setPermission('1-{{$sub_menu->ID}}-{{$sub_menu->menu_id}}')" name="setSubMenuPermission{{$sub_menu->ID}}" type="radio" value="1-{{$sub_menu->ID}}" @if($sub_menu->permission == 1) checked @endif/> Disallow

                        </div>
                    @endforeach

                </div>
                @endif
                </div>


            </div>


    </div>
</div>
