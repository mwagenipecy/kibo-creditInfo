<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="flex flex-col w-full">

        <div>
            @if (session()->has('message_2'))

                {{--                                @if (session()->has('alert-class'))--}}
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8"
                     role="alert">
                    <div class="flex">
                        <div class="py-1">
                            <svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">The process is
                                completed</p>
                            <p class="text-sm">{{ session('message_2') }} </p>
                        </div>
                    </div>
                </div>
                {{--                                @endif--}}
            @endif
        </div>




        <div class="w-full flex justify-center space-x-1">

            <div class="w-1/2 metric-card  border bg-white  border-gray-200 dark:border-gray-800 rounded-lg p-4">
                <div>
                    <p class="flex items-center text-l font-semibold spacing-sm text-green-800">
                        Client Information
                    </p>
                    <div>
                        @if (session()->has('message1'))
                            {{--                                @if (session()->has('alert-class'))--}}
                            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8"
                                 role="alert">
                                <div class="flex">
                                    <div class="py-1">
                                        <svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold">The process is
                                            completed</p>
                                        <p class="text-sm">{{ session('message1') }} </p>
                                    </div>
                                </div>
                            </div>
                            {{--                                @endif--}}
                        @endif

                        @if (session()->has('message_fail'))
                            {{--                                                            @if (session()->has('alert-class'))--}}
                            <div class="bg-green-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8"
                                 role="alert">
                                <div class="flex">
                                    <div class="py-1">
                                        <svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold">The process has failed
                                        </p>
                                        <p class="text-sm">{{ session('message_fail') }} </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <hr class="boder-b-0 my-4"/>



                            <p for="firstname"
                               class="block mb-2 mt-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                First Name</p>
                            <input id="firstname" type="text"
                                         name="firstname" class="w-full border-gray-300  focus:border-green-500 focus:ring rounded-lg focus:ring-green-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm"
                                         wire:model.bounce="firstname" autofocus/>

                            @error('firstname')
                            <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                <p>National Id is mandatory.</p>
                            </div>
                            @enderror


                            <p for="middlename"
                               class="block mb-2 mt-2  text-sm font-medium text-slate-600 dark:text-gray-400">
                                Middle Name</p>
                            <input id="middlename" type="text"
                                         name="middlename" class="w-full border-gray-300  focus:border-green-500 focus:ring rounded-lg focus:ring-green-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm"
                                         wire:model.bounce="middlename" autofocus/>

                            @error('middlename')
                            <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                <p>National Id is mandatory.</p>
                            </div>
                            @enderror



                            <p for="lastname"
                               class="block mb-2 mt-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                First Name</p>
                            <input id="lastname" type="text"
                                         name="lastname" class="w-full border-gray-300  focus:border-green-500 focus:ring rounded-lg focus:ring-green-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm"
                                         wire:model.bounce="lastname" autofocus/>

                            @error('lastname')
                            <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                <p>National Id is mandatory.</p>
                            </div>
                            @enderror


                    <div class="mt-2"></div>


                        <div class="w-full">
                            <p for="nidanumber"
                               class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                Nida Number</p>
                            <input id="nidanumber" type="text"
                                         name="nidanumber" class="w-full border-gray-300  focus:border-green-500 focus:ring rounded-lg focus:ring-green-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm"
                                         wire:model.bounce="nidanumber" autofocus/>

                            @error('nidanumber')
                            <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                <p>National Id is mandatory.</p>
                            </div>
                            @enderror

                            <div class="mt-2"></div>

                            <p for="phonenumber"
                               class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                Phone Number</p>
                            <input id="phonenumber" type="text"
                                         name="phonenumber" class="w-full border-gray-300  focus:border-green-500 focus:ring rounded-lg focus:ring-green-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm"
                                         wire:model.bounce="phonenumber" autofocus/>

                            @error('phonenumber')
                            <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                <p>Phone Number is mandatory.</p>
                            </div>
                            @enderror

                            <div class="mt-2"></div>

                            <p for="region"
                               class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                Region</p>
                            <input id="region" type="text"
                                         name="region" class="w-full border-gray-300  focus:border-green-500 focus:ring rounded-lg focus:ring-green-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm"
                                         wire:model.bounce="region" autofocus/>

                            @error('region')
                            <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                <p>Region is mandatory.</p>
                            </div>
                            @enderror

                            <div class="mt-2"></div>

                            <p for="district"
                               class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                District</p>
                            <input id="district" type="text"
                                         name="district" class="w-full border-gray-300  focus:border-green-500 focus:ring rounded-lg focus:ring-green-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm"
                                         wire:model.bounce="district" autofocus/>

                            @error('district')
                            <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                <p>District is mandatory.</p>
                            </div>
                            @enderror

                            <div class="mt-2"></div>

                            <p for="ward"
                               class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                Ward</p>
                            <input id="ward" type="text"
                                         name="ward" class="w-full border-gray-300  focus:border-green-500 focus:ring rounded-lg focus:ring-green-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm"
                                         wire:model.bounce="ward" autofocus/>

                            @error('ward')
                            <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                <p>Ward is mandatory.</p>
                            </div>
                            @enderror

                            <div class="mt-2"></div>

                            <p for="email"
                               class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">
                                E-mail</p>
                            <input id="email" type="email"
                                         name="email" class="w-full border-gray-300  focus:border-green-500 focus:ring rounded-lg focus:ring-green-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm"
                                         wire:model.bounce="email" autofocus/>

                            @error('email')
                            <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                                <p>Ward is mandatory.</p>
                            </div>
                            @enderror



                        </div>











                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @error('images')
                    <div class="border border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 mt-1">
                        <p>National Id is mandatory.</p>
                    </div>
                    @enderror

                    <div class="p-6 bg-white rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold mb-4">Upload Multiple Images</h2>

                        <!-- File Input -->
                        <input type="file" multiple wire:model="images" id="imageInput" class="hidden">

                        <!-- Select Images Button -->
                        <label for="imageInput" class="cursor-pointer px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                            Select Images
                        </label>

                        <!-- Image Previews -->
                        <div class="mt-4 grid grid-cols-3 gap-4">
                            @foreach ($imagePreviews as $index => $preview)
                                <div class="relative">
                                    <img src="{{ $preview['url'] }}" alt="Image Preview" class="w-full h-32 object-cover rounded-lg">
                                    <!-- Delete Button -->
                                    <button wire:click="removeImage({{ $index }})" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <!-- Upload Button -->
                        @if ($images)
                            <button wire:click="save" class="mt-4 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">
                                Upload Images
                            </button>
                        @endif

                        <!-- Uploaded Images -->
                        @if ($uploadedImages)
                            <h3 class="mt-6 text-lg font-semibold">Uploaded Images:</h3>
                            <div class="grid grid-cols-3 gap-4 mt-4">
                                @foreach ($uploadedImages as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Uploaded Image" class="w-full h-32 object-cover rounded-lg">
                                @endforeach
                            </div>
                        @endif
                    </div>







                </div>

                <div class="mt-2"></div>

            </div>

            <div class="w-1/2 metric-card  border bg-white  border-gray-200 rounded-lg p-4 ">
                <div class="h-full ">


                    <p class="flex items-center text-l font-semibold spacing-sm text-green-800">
                        Car Details
                    </p>

                    <hr class="border-b-0 my-4"/>



                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">Make and Model</label>
                        <input type="text" wire:model="make_and_model" class="w-full border-gray-300  focus:border-green-500 focus:ring rounded-lg focus:ring-green-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">Year of Manufacture</label>
                        <input type="text" wire:model="year_of_manufacture" class="w-full border-gray-300  focus:border-green-500 focus:ring rounded-lg focus:ring-green-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">VIN</label>
                        <input type="text" wire:model="vin" class="w-full border-gray-300  focus:border-green-500 focus:ring rounded-lg focus:ring-green-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">Color</label>
                        <input type="text" wire:model="color" class="w-full border-gray-300  focus:border-green-500 focus:ring rounded-lg focus:ring-green-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">Mileage</label>
                        <input type="text" wire:model="mileage" class="w-full border-gray-300  focus:border-green-500 focus:ring rounded-lg focus:ring-green-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm">
                    </div>


                    <p class="flex items-center text-l font-semibold spacing-sm text-slate-600">
                        Purchase Information
                    </p>
                    <hr class="border-b-0 my-4"/>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">Purchase Price</label>
                        <input type="text" wire:model="purchase_price" class="w-full border-gray-300  focus:border-green-500 focus:ring rounded-lg focus:ring-green-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">Down Payment</label>
                        <input type="text" wire:model="down_payment" class="w-full border-gray-300  focus:border-green-500 focus:ring rounded-lg focus:ring-green-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-medium text-slate-600 dark:text-gray-400">Loan Amount</label>
                        <input type="text" wire:model="loan_amount" class="w-full border-gray-300  focus:border-green-500 focus:ring rounded-lg focus:ring-green-200 focus:ring-opacity-50 p-2.5 rounded-md shadow-sm text-sm">
                    </div>




                    <div class="mt-80">.</div>

                    <div class="">
                        <div wire:loading wire:target="process1">
                            <x-jet-button  disabled>
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
                            </x-jet-button>
                        </div>

                    </div>


                    <div class="">
                        <div wire:loading.remove wire:target="process1">
                            <x-jet-button wire:click="process1"
                                    class="text-white bg-green-400 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">
                                <p class="text-white">Apply Loan</p>
                            </x-jet-button>

                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>



</div>
