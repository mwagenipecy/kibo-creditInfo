
<div>

    @if (session()->has('message'))

        {{--        @if (session('alert-class') == 'alert-success')--}}
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-8" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div>
                    <p class="font-bold">The process is completed</p>
                    <p class="text-sm">{{ session('message') }} </p>
                </div>
            </div>
        </div>
        {{--        @endif--}}
    @endif
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Select password policy  </label>
    <div class="flex flex-wrap mt-4 max-w-64">
        <div class="mt-1 flex-shrink-0 w-1/2">
            <label class="inline-flex items-center">
                <input type="checkbox" value="1" wire:model="requireSpecialCharacter"
                       class="form-checkbox h-6 w-6 text-red-500 bg-gray-100
                       rounded border-gray-300 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <span class="ml-3 text-sm">
                        Require Special Character
                    </span>
            </label>
        </div>
        <div class="mt-1 flex-shrink-0 w-1/2">
            <label class="inline-flex items-center">
                <input type="checkbox" value="1" wire:model="requireUppercase"
                       class="form-checkbox h-6 w-6 text-red-500 bg-gray-100
                       rounded border-gray-300 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <span class="ml-3 text-sm">
                                           Require Uppercase
                    </span>
            </label>
        </div>
        <div class="mt-1 flex-shrink-0 w-1/2">
            <label class="inline-flex items-center">
                <input type="checkbox" value="1" wire:model="requireNumeric"
                       class="form-checkbox h-6 w-6 text-red-500 bg-gray-100
                       rounded border-gray-300 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <span class="ml-3 text-sm">
                                                Require Numeric

                    </span>
            </label>

        </div>


        <div class="mt-1 flex-shrink-0 w-1/2">
            <label class="inline-flex items-center">
                <input type="checkbox" value="passwordExpire" wire:model="passwordExpire"
                       class="form-checkbox h-6 w-6 text-red-500 bg-gray-100
                       rounded border-gray-300 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <span class="ml-3 text-sm">
                                           Password Expiry
                    </span>
            </label><br>

            @if($this->passwordExpire)

                <label class="inline-flex items-center">
                    <input id=" "  type="number"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                    rounded-lg focus:ring-red-500 focus:border-red-500 block w-full  dark:bg-gray-700
                    dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 "
                           wire:model="passwordExpire1" required />
                    <span class="inline mt-4 ml-2 flex text-sm">
                        Time(days)
                    </span>
                </label>
                @error('passwordExpire1')
                <div class="text-sm text-red-500">Invalid input value days</div>
                @enderror




            @endif
        </div>


        <div class="mt-1 flex-shrink-0 w-1/2 mt-4 ">
            <label class="inline-flex items-center">
                <input id="length" type="number"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                    rounded-lg focus:ring-red-500 focus:border-red-500 block w-full  dark:bg-gray-700
                    dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 "

                       wire:model="length" required />
                <span class="ml-3 text-sm">
                        Length
                    </span>
            </label>
        </div>

        <div class="mt-1 flex-shrink-0 w-1/2 mt-4  flex">
            <label class="inline-flex items-center">
                <input id="length" type="number"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                    rounded-lg focus:ring-red-500 focus:border-red-500 block w-full  dark:bg-gray-700
                    dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 "
                       wire:model="limiter" required />

            </label>
            <span class="inline mt-4 ml-2 flex text-sm">
                        Attempt Limit
                    </span>
        </div> <br>







    </div>





    <div class="flex justify-end w-auto" >
        <div wire:loading wire:target="save" >
            <button class="text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400" disabled>
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
            <button wire:click="save" class="text-white bg-red-400 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-400 dark:hover:bg-red-400 dark:focus:ring-red-400">
                save policy
            </button>
        </div>
    </div>
</div>
