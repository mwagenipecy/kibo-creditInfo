<div>





        <!--Tabs navigation-->

        <div class="border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                <li class="mr-2" wire:click="setView(1)">
                    <a href="#" class="inline-flex p-4 @if($selected == 1) text-green-600 border-b-2 border-green-600
                    active dark:text-green-500 dark:border-green-500 @else border-transparent hover:text-gray-600
                    hover:border-gray-300 dark:hover:text-gray-300 @endif rounded-t-lg
                      group" @if($selected == 1) aria-current="page" @endif>
                        <svg aria-hidden="true" class="w-5 h-5 mr-2 @if($selected == 1) text-green-600 dark:text-green-500
                        @else text-gray-400 group-hover:text-gray-500
                        dark:text-gray-500 dark:group-hover:text-gray-300 @endif " fill="currentColor"
                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd"
                             d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5
                             5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0
                             0010 11z" clip-rule="evenodd"></path></svg>Roles List
                    </a>
                </li>

                <li class="mr-2" wire:click="setView(2)">
                    <a href="#" class="inline-flex p-4 @if($selected == 2) text-green-600 border-b-2 border-green-600
                    active dark:text-green-500 dark:border-green-500 @else border-transparent hover:text-gray-600
                    hover:border-gray-300 dark:hover:text-gray-300 @endif rounded-t-lg
                      group" @if($selected == 2) aria-current="page" @endif >
                        <svg aria-hidden="true" class="w-5 h-5 mr-2 @if($selected == 2) text-green-600 dark:text-green-500
                        @else text-gray-400 group-hover:text-gray-500
                        dark:text-gray-500 dark:group-hover:text-gray-300 @endif "
                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5
                            11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0
                            012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2
                            2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>Create Roles
                    </a>
                </li>

                <li class="mr-2" wire:click="setView(3)">
                    <a href="#" class="inline-flex p-4 @if($selected == 3) text-green-600 border-b-2 border-green-600
                    active dark:text-green-500 dark:border-green-500 @else border-transparent hover:text-gray-600
                    hover:border-gray-300 dark:hover:text-gray-300 @endif rounded-t-lg
                      group" @if($selected == 3) aria-current="page" @endif >
                        <svg aria-hidden="true" class="w-5 h-5 mr-2 @if($selected == 3) text-green-600 dark:text-green-500
                        @else text-gray-400 group-hover:text-gray-500
                        dark:text-gray-500 dark:group-hover:text-gray-300 @endif "
                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5
                            11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0
                            012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2
                            2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>Edit Roles
                    </a>
                </li>


            </ul>
        </div>








    <div class="bg-gray-100 p-2 rounded-2xl mt-4">




        @if($selected == 1)

            <div class="w-full bg-white p-4 sm:p-6 overflow-hidden rounded-2xl shadow-md shadow-gray-200" >

                    <h5 class="mb-4">ROLES LIST</h5>

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

                    <livewire:settings.department-list/>
                    <div class="mt-4"></div>

            </div>
        @endif

        @if($selected == 2)
                <div class="w-full bg-white p-4 sm:p-6 overflow-hidden rounded-2xl shadow-md shadow-gray-200" >
                    <h5 class="mb-4">CREATE A NEW ROLE</h5>

                    <livewire:settings.create-role/>
                    <div class="mt-4"></div>

                </div>
        @endif

        @if($selected == 3)


                <div class="w-full bg-white p-4 sm:p-6 overflow-hidden rounded-2xl shadow-md shadow-gray-200" >
                    <h5 class="mb-4">EDIT A ROLES</h5>

                    <livewire:settings.edit-department/>
                    <div class="mt-4"></div>

                </div>
        @endif






    </div>





</div>


