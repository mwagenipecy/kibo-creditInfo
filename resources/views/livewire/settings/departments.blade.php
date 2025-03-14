
<div class="w-4/6 flex">

    <div class="w-full">
        <!-- message container -->
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


        <div class="bg-gray-100 rounded px-6 rounded-lg shadow-sm  pt-4 pb-4 ">


            <div class="flex items-stretch">









                <div class="mr-2" >

                    <ul class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-b-0 pl-0 mb-4" id="tabs-tab" role="tablist">
                        <li class="nav-item" role="presentation" >
                            <a  href="#tabs-home" class="nav-link block font-medium text-xs leading-tight uppercase border-x-0 border-t-0 border-b-2 border-transparent px-6 py-3 my-2 hover:border-transparent hover:bg-gray-100 focus:border-transparent active" id="tabs-home-tab" data-bs-toggle="pill" data-bs-target="#tabs-home" role="tab" aria-controls="tabs-home" aria-selected="true">
                                New
                            </a>
                        </li>
                        <li class="nav-item" role="presentation" >
                            <a href="#tabs-profile" class="nav-link block font-medium text-xs leading-tight uppercase border-x-0 border-t-0 border-b-2 border-transparent px-6 py-3 my-2 hover:border-transparent hover:bg-gray-100 focus:border-transparent" id="tabs-profile-tab" data-bs-toggle="pill" data-bs-target="#tabs-profile" role="tab" aria-controls="tabs-profile" aria-selected="false">
                                Edit Existing
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content" id="tabs-tabContent">
                        <div class="tab-pane fade show active" id="tabs-home" role="tabpanel" aria-labelledby="tabs-home-tab">


                            <x-jet-label for="department_name" value="{{ __('Enter Department name') }}" />
                            <div class="mt-2"></div>
                            <x-jet-input id="department_name" type="department_name" name="department_name" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                         wire:model.bounce="department_name" autofocus />
                            @error('department_name')
                            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                                <p>Department name is mandatory and should be more than two characters.</p>
                            </div>
                            @enderror


                            <div class="" >
                                <x-jet-label value="{{ __('Select associated modules') }}" />
                                <div class="mt-2"></div>
                                @foreach($this->departmentsList as $department)
                                    <div class="mt-1">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" value="{{ $department->id }}" wire:model="departments"
                                                   class="form-checkbox h-6 w-6 text-green-500 bg-gray-100
                                        rounded border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <span class="ml-3 text-sm">{{ $department->name }}</span>
                                        </label>
                                    </div>


                                @endforeach

                            </div>


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
                                        Save Department
                                    </button>

                                </div>
                            </div>

                        </div>




                        <div class="tab-pane fade" id="tabs-profile" role="tabpanel" aria-labelledby="tabs-profile-tab">


                            <livewire:settings.edit-department/>


                        </div>


                    </div>



                </div>






            </div>




        </div>



    </div>

</div>

