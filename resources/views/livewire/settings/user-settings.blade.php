<div class="m-12">

        <!-- Add Team Client -->
        <div class="mt-10 sm:mt-0">


            <div >

                <div class="col-span-6">
                    <div class="max-w-xl text-sm text-gray-600">
                        {{ __('Please select a user, among pending un assigned users.') }}
                    </div>
                </div>



                <div class="form-group col-span-6 sm:col-span-4">

                    <x-jet-label for="pendinguser" value="{{ __('Select a user') }}" />
                    <select id="pendinguser" wire:model="pendinguser" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm sm:px-3 sm:text-sm h-10" required>
                        <option value="" selected>Select</option>

                        @foreach($this->pendingUsers as $pendingUser)
                            <option value="{{$pendingUser->id}}">{{$pendingUser->name}} : {{$pendingUser->email}}</option>

                        @endforeach
                    </select>

                </div>



                <div class="form-group col-span-6 sm:col-span-4">

                    <x-jet-label for="department" value="{{ __('Select department') }}" />
                    <select id="department" wire:model="department" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm sm:px-3 sm:text-sm h-10" required>
                        <option value="" selected>Select</option>

                        @foreach($this->departmentList as $department)
                            <option value="{{$department->id}}">{{$department->department_name}}</option>

                        @endforeach
                    </select>

                </div>


                <div class="form-group col-span-6 sm:col-span-4">

                    <x-jet-label for="userrole" value="{{ __('Select user role') }}" />
                    <select id="userrole" wire:model="userrole" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm sm:px-3 sm:text-sm h-10" required>
                        <option value="" selected>Select</option>
                        <option value="Teller" >Teller</option>
                        <option value="Officer" >Officer / In putter</option>
                        <option value="Authorizer" >Authorizer</option>

                    </select>

                </div>


                <button wire:click='save' class="mt-4 inline-flex items-center px-4 py-2 border border-solid rounded-md font-semibold text-xs text-gray uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" >
                    SAVE
                </button>

            </div>


        </div>



</div>
