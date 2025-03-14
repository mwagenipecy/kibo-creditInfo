<div>
    <!-- Form -->
    <div class=" py-3 rounded text-center">
        <h1 class="text-2xl font-bold">OTP Verification</h1>

        <div class="flex flex-col mt-4 mb-4">
            <span>Enter the OTP you received at</span>
            <span class="font-bold">{{auth()->user()->email}}</span>
        </div>

        <div id="countdown"></div>
        <button wire:click="onCountdownFinished" id="finish-btn" style="display:none;">Finish</button>



        <div id="wrong">
            @if($this->error)
                <span class="text-red-400 " >Wrong OTP</span>
            @endif
        </div>

        <span class="text-red-400 hidden"  id="wait">Please wait...</span>


        <div id="otp" class="flex flex-row justify-center text-center px-2 mt-5">
            <input  class="m-2 border border-gray-300 focus:outline-none focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50  h-10 w-10 text-center form-control rounded" type="text" id="otp1" maxlength="1" />
            <input  class="m-2 border border-gray-300 focus:outline-none focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 h-10 w-10 text-center form-control rounded" type="text" id="otp2" maxlength="1" />
            <input  class="m-2 border border-gray-300 focus:outline-none focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 h-10 w-10 text-center form-control rounded" type="text" id="otp3" maxlength="1" />
            <input class="m-2 border border-gray-300 focus:outline-none focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 h-10 w-10 text-center form-control rounded" type="text" id="otp4" maxlength="1" />
            <input  class="m-2 border border-gray-300 focus:outline-none focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 h-10 w-10 text-center form-control rounded" type="text" id="otp5" maxlength="1" />
            <input  class="m-2 border border-gray-300 focus:outline-none focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 h-10 w-10 text-center form-control rounded" type="text" id="otp6" maxlength="1" />
        </div>


        <div class="flex justify-center text-center mt-5 mb-5">
            <div wire:loading wire:target="resendOTP" >
                <a class="flex items-center text-blue-700 hover:text-blue-900 cursor-pointer">
                    <span class="font-bold">Please wait...</span>
                    <i class='bx bx-caret-right ml-1'></i>
                </a>
            </div>
            <div wire:loading.remove wire:target="resendOTP" >
            <a wire:click="resendOTP" class="flex items-center text-blue-700 hover:text-blue-900 cursor-pointer">
                <span class="font-bold" style="color:#c40f11;">Resend OTP</span>
                <i class='bx bx-caret-right ml-1'></i>
            </a>
            </div>
        </div>

        <div class="flex justify-center text-center mt-5 mb-5">
            <div wire:loading wire:target="logout" >
                <a class="flex items-center text-blue-700 hover:text-blue-900 cursor-pointer">
                    <span class="font-bold">Please wait...</span>
                    <i class='bx bx-caret-right ml-1'></i>
                </a>
            </div>
            <div wire:loading.remove wire:target="logout" >
                <button wire:click="logout" type="button" class="p-2 text-sm font-medium text-gray-900 focus:outline-none
         bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4
         focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600
         dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
            </div>
        </div>



    </div>



    <script>
        // Get the countdown element
        const countdown = document.getElementById("countdown");
        // Get the finish button element
        const finishBtn = document.getElementById("finish-btn");

        // Set the countdown time to 2 minutes (in seconds)
        const countdownTime = 120;

        // Get the current time
        let currentTime = countdownTime;

        // Update the countdown every second
        const timerId = setInterval(() => {
            // Format the time remaining as mm:ss
            const minutes = Math.floor(currentTime / 60).toString().padStart(2, "0");
            const seconds = (currentTime % 60).toString().padStart(2, "0");
            const timeRemaining = `${minutes}:${seconds}`;

            // Update the countdown text
            countdown.textContent = timeRemaining;

            // Decrease the current time by 1 second
            currentTime--;

            // If the countdown is finished, clear the interval
            if (currentTime === 0) {
                clearInterval(timerId);
                finishBtn.click();
            }
        }, 1000);


    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

            function OTPInput() {
                const myDiv3 = document.getElementById("wrong");
                myDiv3.classList.remove("hidden");

                const inputs = document.querySelectorAll('#otp > *[id]');
                for (let i = 0; i < inputs.length; i++) {
                    inputs[i].addEventListener('keyup', function(event) {
                        if (event.key === "Backspace") {
                            inputs[i].value = '';
                            if (i !== 0) inputs[i - 1].focus();
                        } else {



                            if (i === inputs.length - 1 && inputs[i].value !== '') {

                                let otpValue = '';
                                for (let j = 0; j < inputs.length; j++) {
                                    otpValue += inputs[j].value;

                                }
                                if(i === 5){
                                    const myDiv2 = document.getElementById("wait");
                                    myDiv2.classList.remove("hidden");
                                    const myDiv3 = document.getElementById("wrong");
                                    myDiv3.classList.add("hidden");
                                }
                                if(i === 5){


                                    Livewire.emit('submitOTP', otpValue);
                                }
                                // Call Livewire component method to submit OTP value
                                return true;
                            } else if (event.keyCode > 47 && event.keyCode < 58) {
                                inputs[i].value = event.key;
                                if (inputs[i].nextElementSibling) inputs[i].nextElementSibling.focus(); // Check if next sibling exists before focusing on it
                                event.preventDefault();
                            } else if (event.keyCode > 64 && event.keyCode < 91) {
                                inputs[i].value = String.fromCharCode(event.keyCode);
                                if (inputs[i].nextElementSibling) inputs[i].nextElementSibling.focus(); // Check if next sibling exists before focusing on it
                                event.preventDefault();
                            }
                        }
                    });
                }
            }
            OTPInput();
        });

    </script>

</div>
