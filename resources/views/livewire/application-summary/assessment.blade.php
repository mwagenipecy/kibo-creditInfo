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



  

            
        <div class="mt-8 flex gap-4 justify-end items-right">


       
       



        @php
    $applicationStatus = DB::table('applications')
        ->where('id', session('applicationId'))
        ->value('application_status');
@endphp

@if(in_array($applicationStatus, ['ACCEPTED', 'REJECTED']))
    {{-- Application has already been processed --}}
    <div class="px-4 py-2 text-sm text-gray-600 italic">
        Application {{ strtolower($applicationStatus) }} on {{ 
            DB::table('applications')
                ->where('id', session('applicationId'))
                ->value('updated_at') 
        }}
    </div>
@else 
    <div class="flex space-x-4">
        <button 
            wire:click="rejectApplication" 
            class="px-4 py-2 bg-red-900 text-white rounded-lg hover:bg-red-700 transition-colors"
        >
            Reject Application
        </button>

        <button 
            wire:click="acceptApplication" 
            class="px-4 py-2 bg-green-900 text-white rounded-lg hover:bg-green-700 transition-colors"
        >
            Accept Application
        </button>
    </div>
@endif



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



</div>
