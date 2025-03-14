<div class="w-full">
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
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
                            REGISTER NEW DEPARTMENT
                        </h3>
                    </div>
                    <x-jet-label for="department_name" value="{{ __('Department Name ') }}" />
                    <x-jet-input id="department_name" wire:model.bounce="department_name" name="department_name" type="text" class="mt-1 block w-full"  autofocus />

                    @error('department_name')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p>Department Name is mandatory.</p>
                    </div>
                    @enderror
                    <div class="mt-2"></div>

                    <x-jet-label for="leave_description" value="{{ __('Description') }}" />
                    <textarea id="description" name="description" type="text" class="mt-1 block w-full" wire:model.defer="description" autofocus >
                            </textarea>
                    @error('description')
                    <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mt-1">
                        <p> Description  is mandatory</p>
                    </div>
                    @enderror
                    <div class="mt-2"></div>
                </div>
                <!-- Add more form fields as needed -->
                <div class="flex items-center bg-gray-200 justify-end py-3 sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                    <button type="button" wire:click="closeModal()" class="mr-4 inline-flex justify-center px-4 py-2 text-sm font-medium   border border-transparent rounded-md  focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2  bg-white">
                        Cancel
                    </button>
                    <button type="submit" wire:click="addDepartment()" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-400 border border-transparent rounded-md  focus-visible:ring-2 focus-visible:ring-offset-2 ">
                        Proceed
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>
