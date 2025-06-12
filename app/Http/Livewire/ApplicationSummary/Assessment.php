<?php

namespace App\Http\Livewire\ApplicationSummary;

use App\Models\Application;
use App\Models\CarDealer;
use App\Models\LoanProduct;
use App\Models\User;
use Livewire\Component;
use DateTime;
use App\Services\LoanScheduleService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class Assessment extends Component
{
    public $schedule2,$scheduleData,$graceData,$monthlyInstallment,$firstInstallmentInterestAmount ;


    public $photo, $futureInterest = false, $collateral_type, $collateral_description, $daily_sales, $loan, $collateral_value, $loan_sub_product;
    public $principle = 0, $member, $guarantor, $disbursement_account, $collection_account_loan_interest;
    public $collection_account_loan_principle, $collection_account_loan_charges, $collection_account_loan_penalties;
    public $principle_min_value, $principle_max_value, $min_term, $max_term, $interest_value;
    public $principle_grace_period, $interest_grace_period, $amortization_method;
    public $days_in_a_month = 30, $loan_id, $loan_account_number, $member_number, $topUpBoolena, $new_principle;
    public $interest = 0, $business_licence_number, $business_tin_number, $business_inventory, $cash_at_hand;
    public $cost_of_goods_sold, $operating_expenses, $monthly_taxes, $other_expenses, $monthly_sales;
    public $gross_profit, $table = [], $tablefooter = [], $recommended_tenure, $recommended_installment;
    public $totalAmount, $recommended = true,$monthlyInstallmentValue, $business_age, $bank1 = 123456, $available_funds;
    public $interest_method, $loan_is_settled=false, $approved_term = 12, $approved_loan_value = 0, $future_interests, $futureInsteresAmount, $valueAmmount, $net_profit, $status, $products;
    public $coverage;
    public $idx;
    public $sub_product_id;
    public $product, $account;
    public $charges;

    public $institution1;
    public $institutionAmount;

    public $institution2;
    public $institutionAmount2;
    public $daysBetweenx = 0;


    public $principal = 0;
    public $interestRate = 0;
    public $tenure = 0;
    public $interestMethod = 'reducing';
    public $startDate;
    public $gracePeriod = 0;
    public $paymentFrequency = 'monthly';



    ///////////////
    public $non_permanent_income_non_taxable = 0;
    public $non_permanent_income_taxable = 0;
    public $take_home = 0;
    public $totalInstallment = 0;
    public $max_loan, $selectedContracts=[];
    public $x ;
    public $isPhysicalCollateral = false;
    public $account1,$insurance_list=[];
    public $account2,$images=[];

    public $selectedLoan;
    public $ClosedLoanBalance;

    public $appllicationId;
    protected $listeners = ['refresh'=>'$refresh'];


    protected $rules = [
        'principal' => 'required|numeric|min:1',
        'interestRate' => 'required|numeric|min:0',
        'tenure' => 'required|integer|min:1',
        'interestMethod' => 'required|in:reducing,flat',
        'startDate' => 'required|date',
        'gracePeriod' => 'integer|min:0',
        'paymentFrequency' => 'required|in:monthly,daily,quarterly,semi_annual,annual',
  
  
    ];


  


    /**
     * @throws \DateMalformedStringException
     */
    public function calculateFirstInterestAmount($principal, $monthlyInterestRate, $dayOfTheMonth) {
        // Get the current date (disbursement date)


        $disbursementDate = new DateTime(); // current date

        // Clone the current date to calculate the next drawdown date
        $nextDrawdownDate = clone $disbursementDate;

        // Set the day of the month for the drawdown date in the current month
        $nextDrawdownDate->setDate($disbursementDate->format('Y'), $disbursementDate->format('m'), $dayOfTheMonth);

        // Check if today's date equals the drawdown date, if yes, set daysBetween to 0
        if ($disbursementDate->format('Y-m-d') === $nextDrawdownDate->format('Y-m-d')) {
            $daysBetween = 0;
        } else {
            // If the drawdown date for this month has already passed, move to the next month
            if ($disbursementDate > $nextDrawdownDate) {
                $nextDrawdownDate->modify('first day of next month');
                $nextDrawdownDate->setDate($nextDrawdownDate->format('Y'), $nextDrawdownDate->format('m'), $dayOfTheMonth);
            }

            // Calculate the number of days between the disbursement date and the next drawdown date
            $daysBetween = $disbursementDate->diff($nextDrawdownDate)->days;
        }

        // Store the days between for debugging or further use
        $this->daysBetweenx = $daysBetween;

        // Get the number of days in the current month
        $daysInMonth = (int) $disbursementDate->format('t');





        // Calculate the daily interest rate based on the monthly interest rate
        $dailyInterestRate = $monthlyInterestRate / $daysInMonth;

        // Calculate the interest accrued for the days between
        return $principal * $dailyInterestRate * $daysBetween;
    }


    public function loadData(){


        $applicationId=session('applicationId');

        $application= Application::find($applicationId);
        if ($application === null) {
            return;
        }
       
        $loanId=$application->loan_id;
        $loan=DB::table('loans')->where('id',$loanId)->first();
        $loanProduct=LoanProduct::find($application->loanProductId);

        $this->principal=$loan->principle??0;
        $this->interestRate=$loan->interest ??0;
        $this->tenure=$loan->tenure ?? 0;
        $this->interestMethod=$loanProduct->interest_method ??'flat';
        $this->gracePeriod=0;
        $this->paymentFrequency=$loanProduct->repayment_strategy??'monthly';
        $this->startDate = Carbon::today()->format('Y-m-d');




        //load imahe 

        $this->images=DB::table('images')->where('loan_id',$loanId)->get();
    }


    public function rejectApplication(){

        $applicationId = session('applicationId');
        $application = Application::find($applicationId);

        $loanId = $application->loan_id;


        $application->application_status = 'REJECTED';
        $application->save();
        
        // Update loan status
        DB::table('loans')->where('id', $loanId)->update(['status' => 'REJECTED']);
        


    }


    public function acceptApplication()
    {
        $applicationId = session('applicationId');
        $application = Application::find($applicationId);
        
        // Check if application exists
        if (!$application) {
          session()->flash('error' , 'Application not found' );
        }
        // Don't do anything if loan is already ACTIVE or REJECTED
        if (in_array($application->application_status, ['ACCEPTED', 'REJECTED'])) {
            session()->flash('message' ,'No action needed. Application is ' . $application->application_status );
        }
        
        $loanId = $application->loan_id;


        
        // Use transaction to handle errors and prevent partial operations
        try {

            DB::beginTransaction();
            
            // Update application status
            $application->application_status = 'ACCEPTED';
            $application->save();
            
            // Update loan status
           // DB::table('loans')->where('id', $loanId)->update(['status' => 'ACTIVE']);
            
            // Commit transaction if everything succeeded
            DB::commit();
            
            return session()->flash('message' , 'Application accepted successfully');
        } catch (\Exception $e) {
            // Rollback transaction if any operation fails
            DB::rollBack();


            dd($e->getMessage());
            
            // Log the error for debugging
            \Log::error('Error accepting application: ' . $e->getMessage());
            
            session()->flash('error' , 'Failed to accept application' );
        }
    }



    public function generateSchedule(){


        $scheduleCalculator=new LoanScheduleService();
        $schedule = $scheduleCalculator->generateLoanRepaymentSchedule(
            $this->principle?? 1000000,
            $this->interest_value??4,
            $this->tenure,
            Carbon::today()->format('Y-m-d'),
            $this->interest_method ?? 'reducing',
            0,
            'monthly'
        );



        return $schedule;

    }



    public function calculateSchedule()
    {


        $this->loadData();
        $this->validate();
        
        $service = new LoanScheduleService();
        $this->scheduleData = $service->generateLoanRepaymentSchedule(
            $this->principal,
            $this->interestRate,
            $this->tenure,
            $this->startDate,
            $this->interestMethod,
            $this->gracePeriod,
            $this->paymentFrequency
        );
    }



    public function mount($applicationId)
    {

        $this->appllicationId=null;

        $this->appllicationId=$applicationId;
         $this->loadData();

         echo $this->appllicationId;
        // Set default start date to today
        $this->startDate = Carbon::today()->format('Y-m-d');
        
        // Calculate schedule on initial load
        $this->calculateSchedule();
    }






    public function render()
    {

        
    //  $this->scheduleData =$this->generateSchedule();

        return view('livewire.application-summary.assessment');
    }


}
