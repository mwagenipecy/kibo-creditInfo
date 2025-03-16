<div>






    <div class="mt-2"></div>


    <div class="w-full ">


    @php
    $member = DB::table('clients')->where('id', 32)->first();
    $member_category = 22;
    @endphp

    </div>


    <div class="w-full flex gap-4 p-2">

        <div class="w-1/3">




            <p for="stability" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">CREDIT SCORE</p>

            <div id="stability" class="w-full bg-gray-50 rounded rounded-lg shadow-sm   p-1 mb-4" >
                <div class="w-full bg-white rounded-lg shadow-sm p-2 flex flex-col items-center justify-center">
                    <canvas id="demo" width="400" height="200"></canvas>
                    <div id="preview-textfield" class="text-center mt-2 font-bold"></div>
                </div>

            </div>




    

            <hr class="boder-b-0 my-6"/>



                <p for="stability" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"> EXCEPTIONS </p>
                <div id="stability" class="w-full bg-gray-50 rounded rounded-lg shadow-sm   p-1 mb-4" >
                    <div class="w-full bg-white rounded rounded-lg shadow-sm" >


                    <div id="imageGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2 p-2">
                    @forelse($images as $image)
                    <img src="{{ asset($image->url) }}" alt="Image {{ $loop->iteration }}" class="w-full h-auto rounded-lg shadow-lg cursor-pointer">
                @empty
                    No image found 
                @endforelse


                       
                    </div>



                   </div>
                </div>


            <hr class="boder-b-0 my-6"/>



            <div class="mt-2"></div>



        </div>




        <div class="w-2/3">




            <p for="stability" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 mt-4">ASSESSMENT</p>
            <div id="stability" class="w-full bg-gray-50 rounded rounded-lg shadow-sm   p-1 " >
                <div class="w-full bg-white rounded rounded-lg shadow-sm   p-2 " >
                    <table class="w-full">



                        @php

                            $monthsDifference = 3;
                        @endphp
                        @php

                            // Subtract 3 months from the difference
                            $monthsDifferencex = 3;
                        @endphp

                        <tr>
                            <td colspan="4" class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2 text-xs">Take home Salary/ Sales Proceeds (from Salary slip)</td>
                            <td class="border border-gray-300 p-2">
                                <input wire:model="take_home" type="number" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs
                        focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                        dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    </td>
                        </tr>

                        <tr class="bg-blue-100">
                            <td colspan="6" class="border border-gray-300 p-2 font-bold"></td>
                        </tr>


                        <tr>
                            <td colspan="5" class="border border-gray-300 p-2 text-xs">Interest Rate applicable Monthly</td>
                            <td colspan="1" class="border border-gray-300 p-2 text-right text-xs">7 %</td>
                        </tr>

                        <tr>
                            <td colspan="5" class="border border-gray-300 p-2 text-xs">Interest Rate Per Annum</td>
                            <td colspan="1" class="border border-gray-300 p-2 text-right text-xs">2 %</td>
                        </tr>

                        <tr>
                            <td colspan="5" class="border border-gray-300 p-2 text-xs">Maximum Repayment Term  Per Product</td>
                            <td colspan="1" class="border border-gray-300 p-2 text-right text-xs">12</td>
                        </tr>

{{--                        <tr>--}}
{{--                            <td colspan="5" class="border border-gray-300 p-2 text-xs">Maximum Repayment Term  for the  Customer  - according to board meeting approval</td>--}}
{{--                            <td colspan="1" class="border border-gray-300 p-2 text-right text-xs">--}}
{{--                                <input wire:model="tenure" type="number" id="small" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs--}}
{{--                        focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white--}}
{{--                        dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--                            </td>--}}
{{--                        </tr>--}}

                        @php
                            // Use the min() function to find the smallest value
                        $minValue = 3;

                        @endphp

                        <tr>
                            <td colspan="5" class="border border-gray-300 p-2 font-bold text-xs">Repayment term  </td>
                            <td colspan="1" class="border border-gray-300 p-2 text-right text-xs">

                                <input wire:model="approved_term" type="number" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs
                                focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </td>
                        </tr>


                        <tr>
                            <td colspan="5" class="border border-gray-300 p-2 text-xs">Grace Period </td>
                            <td colspan="1" class="border border-gray-300 p-2 text-right text-xs">
                                7 Months
                            </td>
                        </tr>



                        @php
                            $max_dsr = 0;
                            function calculateTotalLoanAmount($interestRate, $tenure, $takeHome) {
                                    // Convert the annual interest rate to a monthly interest rate
                                    $monthlyInterestRate = $interestRate / 12;

                                    // Calculate the present value (principal + interest) based on the installment amount
                                    if ($monthlyInterestRate == 0) {
                                        // If the interest rate is zero, PV is simply the total payments
                                        $presentValue = $takeHome * $tenure;
                                    } else {
                                        // Formula for Present Value of an annuity (Loan Principal)
                                        $presentValue = ($takeHome * (1 - pow(1 + $monthlyInterestRate, -$tenure))) / $monthlyInterestRate;
                                    }

                                    // Round down to the nearest 10,000
                                    $roundedDownValue = floor($presentValue / 10000) * 10000;

                                    $max_dsr = $roundedDownValue;
                                    return $roundedDownValue;
                                    }

                                    $theInt = 12;

                            $loanAmt = calculateTotalLoanAmount( 12, 6, 2000000);




                            // Calculate the monthly interest rate
                            $monthlyInterestRate = 2;

                            // The principal is the loan amount
                            //$principal = $loan->principle;
                            $principal = 20000000;

                            //dd($principal);

                            $member_category = 22;
                            $dayOfMonth = 22;

                            // Calculate the first installment interest amount
                            $firstInstallmentInterestAmount = $this->calculateFirstInterestAmount($principal, $monthlyInterestRate,$dayOfMonth);


                            function calculateEMI($principal, $monthlyInterestRate, $tenure) {
                                if ($monthlyInterestRate == 0) {
                                    // If interest rate is 0, it's simply the principal divided by tenure
                                    return $principal / $tenure;
                                } else {
                                    return ($principal * $monthlyInterestRate * pow(1 + $monthlyInterestRate, $tenure)) / (pow(1 + $monthlyInterestRate, $tenure) - 1);
                                }
                            }

                            $monthlyInstallment = calculateEMI((float)$this->approved_loan_value, $monthlyInterestRate, (float)$this->approved_term);
                             $this->monthlyInstallmentValue=$monthlyInstallment;



                        @endphp

                        @if($this->isPhysicalCollateral)
                        <tr>
                            <td colspan="3" class="border border-gray-300 p-2 text-xs">Security value (Forced Sale Value)</td>
                            <td colspan="1" class="border border-gray-300 p-2 text-right text-xs">Policy


                            </td>
                            <td colspan="1" class="border border-gray-300 p-2 text-right text-xs">80%</td>
                            <td colspan="1" class="border border-gray-300 p-2 text-right text-xs">

                               400000 TZS

                            </td>
                        </tr>
                        @endif

                        <tr>
                            <td colspan="5" class="border border-gray-300 p-2 text-xs">Maximum Qualifying amount per take home</td>
                            <td colspan="1" class="border border-gray-300 p-2 text-right text-xs">{{number_format(7000000,2)}}</td>
                        </tr>

                        <tr>
                            <td colspan="5" class="border border-gray-300 p-2 text-xs">Maximum Loan Amount Per Product</td>
                            <td colspan="1" class="border border-gray-300 p-2 text-right text-xs">{{number_format(7900000,2)}}</td>
                        </tr>

                        <tr>
                            <td colspan="5" class="border border-gray-300 p-2 font-bold text-xs">Amount requested by the customer(Loan value)-Capital amount</td>
                            <td colspan="1" class="border border-gray-300 p-2 text-right font-bold text-xs">


                                <input wire:model="approved_loan_value" type="number" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs
                                focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                            </td>
                        </tr>


                        @php


                        // Initialize Loan Schedule Service and generate schedule data
                        $loanId = 111;
                        $approvedTerm = 12;
                        $approvedLoanValue = 8000000;

                        // Additional parameters for loan scheduling
                        $member_category = 22;
                        //$dayOfMonth = DB::table('member_categories')->where('id', $member_category)->value('repayment_date');
                        $dayOfMonth = "18";


                        //$updatedPrinciple = (float)$approvedLoanValue - (float)$firstInstallmentInterestAmount;
                        $updatedPrinciple = (float)$approvedLoanValue;

                        $repaymentSchedule = new App\Services\LoanRepaymentSchedule($loanId, $approvedTerm, $updatedPrinciple, $dayOfMonth, $monthlyInterestRate*12,1,22);

                        // $disbursementDate = date('Y-m-d');  // Example disbursement date
                         $disbursementDate = date('Y-m-d');
                          // dd($disbursementDatex,$disbursementDate);

                        $data = $repaymentSchedule->generateSchedule($disbursementDate);
                        //dd($data);

                        $schedule = $data['schedule'];



                        $footer = $data['footer'];
                        $graceData=$data['graceData'];



                    @endphp





                        <tr>
                            <td colspan="5" class="border border-gray-300 p-2 text-xs">{{$graceData[0]['days']}} Days First Interest  ( Deducted upfront)</td>
                            <td colspan="1" class="border border-gray-300 p-2 text-right text-xs">{{number_format($graceData[0]['balance'],2)}}</td>
                        </tr>

                        <tr>
                            <td colspan="4" class="border border-gray-300 p-2 text-xs">Charges</td>

                            <td colspan="1" class="border border-gray-300 p-2 text-xs ">

                                <table class="w-full">
                                        @php
                                            $totalCharges = 0; // Initialize total charges
                                        @endphp

                                        @if($this->charges)

                                        @foreach($this->charges as $charge)

                                                <tr class="bg-white dark:bg-gray-800 dark:border-white ">
                                                    <th scope="row" class="py-1 px-0 sm:text-xs font-medium text-gray-900 whitespace-nowrap dark:text-white text-start ">
                                                        {{ $charge->name }}
                                                    </th>
                                                    <td class="py-1 px-0 sm:text-xs text-end ">

                                                        @if($charge->calculating_type === "Fixed")
                                                            @php
                                                                $chargeAmount = $charge->value; // Fixed charge

                                                             $chargeAmount = ($this->approved_loan_value * 0.3 / 100);

                                                             if($chargeAmount > 30000){
                                                                $chargeAmount = 30000;
                                                             }elseif($chargeAmount < 10000){
                                                                 $chargeAmount = 10000;
                                                             }else{
                                                                 $chargeAmount = $chargeAmount;
                                                             }
                                                            @endphp
                                                            {{ number_format($chargeAmount, 2) }} TZS
                                                        @else
                                                            @php
                                                                $chargeAmount = ($this->approved_loan_value * $charge->value / 100); // Percentage-based charge
                                                            @endphp
                                                            {{ number_format($chargeAmount, 2) }} TZS
                                                        @endif

                                                        @php
                                                            $totalCharges += $chargeAmount; // Add the charge amount to the total
                                                        @endphp
                                                    </td>
                                                </tr>

                                            @endforeach
                                        @endif

                                </table>


                            </td>

                            <td colspan="1" class="border border-gray-300 p-2 text-right text-xs">{{number_format($totalCharges,2)}}</td>
                        </tr>


                        <tr>
                            <td colspan="4" class="border border-gray-300 p-2 text-xs">Insurances</td>

                            <td colspan="1" class="border border-gray-300 p-2 text-xs ">


                                <table class="w-full">
                                @php
                                    $totalInsurance = 0; // Initialize total charges
                                @endphp

                                @if($this->insurance_list)

                                @foreach($this->insurance_list as $insurance)

                                        <tr class="bg-white dark:bg-gray-800 dark:border-white ">
                                            <th scope="row" class="py-1 px-0 sm:text-xs font-medium text-gray-900 whitespace-nowrap dark:text-white text-start ">
                                                {{ $insurance->name }} - {{$insurance->calculating_type}}
                                            </th>
                                            <td class="py-1 px-0 sm:text-xs text-end ">
                                                @if($insurance->calculating_type === "Fixed")
                                                    @php
                                                        $insuranceAmount = $insurance->value; // Fixed charge
                                                    @endphp
                                                    {{ number_format($insuranceAmount, 2) }} TZS
                                                @else
                                                    @php
                                                        $insuranceAmount = ($this->approved_loan_value * $insurance->value / 100); // Percentage-based charge
                                                    @endphp
                                                    {{ number_format($insuranceAmount, 2) }} TZS
                                                @endif

                                                @php
                                                    $totalInsurance += $insuranceAmount; // Add the charge amount to the total
                                                @endphp
                                            </td>
                                        </tr>

                                    @endforeach
                                @endif

                                  </table>


                            </td>

                            <td colspan="1" class="border border-gray-300 p-2 text-right text-xs">{{number_format($totalInsurance,2)}}</td>
                        </tr>




                        <!-- Additional rows and data here as per the original table -->
                        <tr class="bg-yellow-100">
                            <td colspan="3" class="border border-gray-300 p-2 font-bold text-xs">Total to be repaid</td>
                            <td colspan="1" class="border border-gray-300 p-2 text-right text-xs"> {{number_format((float)$monthlyInstallment * (float)$this->approved_term,2)}}</td>
                            <td colspan="1" class="border border-gray-300 p-2 text-right text-xs">Monthly loan instalment</td>
                            <td colspan="1" class="border border-gray-300 p-2 text-right font-bold text-xs">{{number_format($monthlyInstallment,2)}}</td>
                        </tr>
                        <tr class="bg-blue-100">
                            <td colspan="5" class="border border-gray-300 p-2 text-xs">Amount to be credited into customer’s account</td>

                            @php
                            $this->ClosedLoanBalance = 0;
                            $topUpAmount = 0;
                            if($this->selectedLoan){
                               $this->ClosedLoanBalance =  Illuminate\Support\Facades\DB::table('sub_accounts')->where('account_number', $loan->loan_account_number)->value('balance');
                            }
                                @endphp
                            <td class="border border-gray-300 p-2 text-right text-xs">{{number_format((float)$this->approved_loan_value - $totalCharges -$totalInsurance - $firstInstallmentInterestAmount - $this->totalAmount - $this->ClosedLoanBalance - $topUpAmount,2)}}</td>
                        </tr>

                    </table>
                </div>
            </div>

                @php
                $amount_to_be_credited = (float)$this->approved_loan_value - $totalCharges - $firstInstallmentInterestAmount - $this->totalAmount;
                    DB::table('loans')
                        ->where('id', Session::get('currentloanID'))
                        ->update(['amount_to_be_credited' => $amount_to_be_credited]);
                @endphp

                <hr class="boder-b-0 my-6"/>

           

        </div>


        


    </div>



    <p for="stability3" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-400">LOAN REPAYMENT SCHEDULE</p>
                <div id="stability3" class="w-full bg-gray-50 rounded rounded-lg shadow-sm   p-1 " >
                    <div class="w-full bg-white rounded rounded-lg shadow-sm   p-2 " >












                    <div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">Loan Calculator</h2>
        
        <!-- Input Form -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
            <div>
                <label for="principal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Principal Amount</label>
                <input wire:model.defer="principal" type="number" min="1" id="principal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            
            <div>
                <label for="interestRate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Interest Rate (%)</label>
                <input wire:model.defer="interestRate" type="number" min="0" step="0.01" id="interestRate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            
            <div>
                <label for="tenure" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tenure (Months/Periods)</label>
                <input wire:model.defer="tenure" type="number" min="1" id="tenure" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            
            <div>
                <label for="interestMethod" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Interest Method</label>
                <select wire:model.defer="interestMethod" id="interestMethod" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="reducing">Reducing Balance</option>
                    <option value="flat">Flat Rate</option>
                </select>
            </div>
            
            <div>
                <label for="paymentFrequency" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Frequency</label>
                <select wire:model.defer="paymentFrequency" id="paymentFrequency" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="monthly">Monthly</option>
                    <option value="daily">Daily</option>

                    <!-- <option value="quarterly">Quarterly</option>
                    <option value="semi_annual">Semi-Annual</option>
                    <option value="annual">Annual</option> -->
                </select>
            </div>
            
            <div>
                <label for="startDate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
                <input wire:model.defer="startDate" type="date" id="startDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            
            <div>
                <label for="gracePeriod" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Grace Period (Months)</label>
                <input wire:model.defer="gracePeriod" type="number" min="0" id="gracePeriod" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
        </div>
        
        <div class="mt-4">
            <button wire:click="calculateSchedule" type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Calculate
            </button>
        </div>
    </div>
    


    <!-- Success Message - Green theme with Tailwind -->
@if(session('success'))
    <div class="flex items-center p-4 mb-4 rounded-lg bg-green-50 border-l-4 border-green-600">
        <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full bg-green-500 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <div class="ml-4 flex-1">
            <h4 class="text-lg font-medium text-green-800">Success!</h4>
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
        <button type="button" class="text-green-500 hover:text-green-800" onclick="this.parentElement.style.display='none'">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif

<!-- Error Message with Tailwind CSS -->
@if(session('error'))
    <div class="flex items-center p-4 mb-4 rounded-lg bg-red-50 border-l-4 border-red-600">
        <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full bg-red-500 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <div class="ml-4 flex-1">
            <h4 class="text-lg font-medium text-red-800">Error</h4>
            <p class="text-red-700">{{ session('error') }}</p>
        </div>
        <button type="button" class="text-red-500 hover:text-red-800" onclick="this.parentElement.style.display='none'">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif



    <!-- Results Summary -->
    @if($scheduleData)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
        <h3 class="text-lg font-semibold mb-3 dark:text-white">Loan Summary</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                <p class="text-sm text-gray-500 dark:text-gray-400">Principal Amount</p>
                <p class="text-lg font-semibold dark:text-white">{{ number_format($this->principal, 2) }}</p>
            </div>
            
            <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Interest</p>
                <p class="text-lg font-semibold dark:text-white">{{ number_format($scheduleData['footer']['total_interest'], 2) }}</p>
            </div>
            
            <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Payment</p>
                <p class="text-lg font-semibold dark:text-white">
                {{ number_format($scheduleData['footer']['total_payment'], 2) }}
            
            </p>
            </div>
            
            <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                <p class="text-sm text-gray-500 dark:text-gray-400">Interest Method</p>
                <p class="text-lg font-semibold dark:text-white capitalize"> {{"Monthly" }} </p>
            </div>
        </div>
    </div>
    
    <!-- Repayment Schedule Table -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 overflow-x-auto">
        <h3 class="text-lg font-semibold mb-3 dark:text-white">Repayment Schedule</h3>
        
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700">
                    <th class="text-left py-2 px-3 text-xs">Payment #</th>
                    <th class="text-left py-2 px-3 text-xs">Date</th>
                    <th class="text-right py-2 px-3 text-xs">Opening Balance</th>
                    <th class="text-right py-2 px-3 text-xs">Payment</th>
                    <th class="text-right py-2 px-3 text-xs">Principal</th>
                    <th class="text-right py-2 px-3 text-xs">Interest</th>
                    <th class="text-right py-2 px-3 text-xs">Closing Balance</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($scheduleData['schedule'] as $index => $installment)
                    <tr class="border-b dark:border-gray-600">
                        <td class="text-xs text-slate-400 dark:text-white text-left py-1 px-2">
                            {{ $index + 1 }}
                        </td>
                        <td class="text-xs text-slate-400 dark:text-white text-left py-1 px-2">
                            {{ $installment['installment_date'] ?? '-' }}
                        </td>
                        <td class="text-xs text-slate-400 dark:text-white text-right py-1 px-2">
                            {{ number_format((float)$installment['opening_balance'] ?? 0, 2) }}
                        </td>
                        <td class="text-xs text-slate-400 dark:text-white text-right py-1 px-2">
                            {{ number_format((float)$installment['payment'] ?? 0, 2) }}
                        </td>
                        <td class="text-xs text-slate-400 dark:text-white text-right py-1 px-2">
                            {{ number_format((float)$installment['principal'] ?? 0, 2) }}
                        </td>
                        <td class="text-xs text-slate-400 dark:text-white text-right py-1 px-2">
                            {{ number_format((float)$installment['interest'] ?? 0, 2) }}
                        </td>
                        <td class="text-xs text-slate-400 dark:text-white text-right py-1 px-2">
                            {{ number_format((float)$installment['closing_balance'] ?? 0, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-slate-400 dark:text-white py-2">
                            No schedule available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
            
            <!-- Footer with totals -->
            @if(isset($scheduleData['footer']))
                <tfoot>
                    <tr class="dark:bg-gray-800 font-bold text-xs bg-blue-100">
                        <td class="text-sm text-black dark:text-white text-left py-2 px-3 text-xs">Total</td>
                        <td class="text-sm text-black dark:text-white text-right py-2 px-3"></td>
                        <td class="text-sm text-black dark:text-white text-right py-2 px-3"></td>
                        <td class="text-sm text-black dark:text-white text-right py-2 px-3 text-xs">
                            {{ number_format((float)$scheduleData['footer']['total_payment'] ?? 0, 2) }}
                        </td>
                        <td class="text-sm text-black dark:text-white text-right py-2 px-3 text-xs">
                            {{ number_format((float)$scheduleData['footer']['total_principal'] ?? 0, 2) }}
                        </td>
                        <td class="text-sm text-black dark:text-white text-right py-2 px-3 text-xs">
                            {{ number_format((float)$scheduleData['footer']['total_interest'] ?? 0, 2) }}
                        </td>
                        <td class="text-sm text-black dark:text-white text-right py-2 px-3 text-xs">
                            {{ number_format((float)$scheduleData['footer']['final_closing_balance'] ?? 0, 2) }}
                        </td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
    @endif
</div>




                    </div>
                </div>

            
                <div class="mt-8 flex gap-4 justify-end items-right">
                      <button wire:click="rejectApplication" class="px-4 py-2 bg-red-900 text-white rounded-lg hover:bg-red-700">Reject</button>

                            <button wire:click="acceptApplication" class="px-4 py-2 bg-green-900 text-white rounded-lg hover:bg-green-700">Accept</button>
                        </div>




    <script>


        var opts = {
            angle: 0.15,
            lineWidth: 0.44,
            radiusScale: 1.0,
            pointer: {
                length: 0.6,
                strokeWidth: 0.035,
                iconScale: 1.0
            },
            staticLabels: {
                font: "10px sans-serif",
                labels: [250, 530, 574, 641, 689, 743, 900],
                fractionDigits: 0
            },
            staticZones: [
                {strokeStyle: "#FF0000", min: 250, max: 573},  // Very High Risk (E)
                {strokeStyle: "#FFA500", min: 574, max: 640},  // High Risk (D)
                {strokeStyle: "#FFFF00", min: 641, max: 676},  // Average Risk (C)
                {strokeStyle: "#00FF7F", min: 677, max: 712},  // Low Risk (B)
                {strokeStyle: "#00FF00", min: 713, max: 900}   // Very Low Risk (A)
            ],
            renderTicks: {
                divisions: 15,
                divWidth: 1.1,
                divLength: 0.7,
                divColor: "#333333",
                subDivisions: 3,
                subLength: 0.5,
                subWidth: 0.6,
                subColor: "#666666"
            },
            colorStart: "#6fadcf",
            colorStop: "#8cf",
            strokeColor: "#e0e0e0",
            generateGradient: true,
            highDpiSupport: true
        };

        var target = document.getElementById('demo');
        var gauge = new Gauge(target).setOptions(opts);

        document.getElementById("preview-textfield").className = "preview-textfield";
        gauge.setTextField(document.getElementById("preview-textfield"));

        gauge.maxValue = 900;
        gauge.setMinValue(250);
        gauge.set(640); // Set an initial value, e.g., 640 for D1 - High Risk
        gauge.animationSpeed = 32;
    </script>



<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-80 hidden items-center justify-center z-50">
    <button onclick="closeModal()" class="absolute top-4 right-4 text-white text-4xl">&times;</button>
    <img id="modalImage" src="" alt="Enlarged Image" class="max-w-4xl max-h-[90vh] rounded-lg shadow-2xl">
</div>

<script>
           const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');

        // Open Modal Listener (Using Event Delegation)
        document.getElementById('imageGrid').addEventListener('click', (event) => {
            if (event.target.tagName === 'IMG') {
                modalImage.src = event.target.src;
                modal.classList.remove('hidden');
            }else{
            alert('fff');
            }
        });

        // Close Modal Listener
        document.getElementById('imageModal').addEventListener('click', () => {
            modal.classList.add('hidden');
        });
</script>



</div>
