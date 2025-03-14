<div>

    <button wire:click="runJob">run job</button>
    
    <div class="p-2 w-full  rounded-lg">
        <div class="w-full rounded-lg flex bg-white p-8 ">

            <ol class="items-center w-full flex space-x-4">

                <li class="relative w-full mb-6 sm:mb-0">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Current Loans</h3>
                        <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">0-4 Days</time>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{$this->currentLoans['count']}} loans</p>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{number_format($this->currentLoans['amount'],2)}}TZS</p>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Reserve 1%</p>
                    </div>
                </li>
                <li class="relative w-full mb-6 sm:mb-0">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Especially Mentioned</h3>
                        <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">5 Days</time>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{ $this->especialLoans['count']}} loans</p>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{number_format( $this->especialLoans['amount'],2)}} TZS</p>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Reserve 1%</p>
                    </div>
                </li>
                <li class="relative w-full mb-6 sm:mb-0">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Substandard</h3>
                        <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">30 Days</time>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{$this->substandard['count']}} loans</p>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{number_format($this->substandard['amount'],2)}} TZS</p>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Reserve 15%</p>
                    </div>
                </li>
                <li class="relative w-full mb-6 sm:mb-0">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Doubtful</h3>
                        <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">60 Days</time>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{$this->doubtful['count']}} loans</p>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{number_format($this->doubtful['amount'],2)}}TZS</p>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Reserve 50%</p>
                    </div>
                </li>

                <li class="relative w-full mb-6 sm:mb-0">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Loss</h3>
                        <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">90 Days</time>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{$this->loss['count']}} loans</p>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{number_format($this->loss['amount'],2)}}TZS</p>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Reserve 100%</p>
                    </div>
                </li>

            </ol>


        </div>
    </div>

</div>
