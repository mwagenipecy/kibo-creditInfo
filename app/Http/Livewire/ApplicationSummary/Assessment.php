<?php

namespace App\Http\Livewire\ApplicationSummary;

use App\Models\Application;
use App\Models\LoanProduct;
use App\Services\LoanScheduleService;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Assessment extends Component
{
    public $schedule2;

    public $scheduleData;

    public $graceData;

    public $monthlyInstallment;

    public $firstInstallmentInterestAmount;

    public $photo;

    public $futureInterest = false;

    public $collateral_type;

    public $collateral_description;

    public $daily_sales;

    public $loan;

    public $collateral_value;

    public $loan_sub_product;

    public $principle = 0;

    public $member;

    public $guarantor;

    public $disbursement_account;

    public $collection_account_loan_interest;

    public $collection_account_loan_principle;

    public $collection_account_loan_charges;

    public $collection_account_loan_penalties;

    public $principle_min_value;

    public $principle_max_value;

    public $min_term;

    public $max_term;

    public $interest_value;

    public $principle_grace_period;

    public $interest_grace_period;

    public $amortization_method;

    public $days_in_a_month = 30;

    public $loan_id;

    public $loan_account_number;

    public $member_number;

    public $topUpBoolena;

    public $new_principle;

    public $interest = 0;

    public $business_licence_number;

    public $business_tin_number;

    public $business_inventory;

    public $cash_at_hand;

    public $cost_of_goods_sold;

    public $operating_expenses;

    public $monthly_taxes;

    public $other_expenses;

    public $monthly_sales;

    public $gross_profit;

    public $table = [];

    public $tablefooter = [];

    public $recommended_tenure;

    public $recommended_installment;

    public $totalAmount;

    public $recommended = true;

    public $monthlyInstallmentValue;

    public $business_age;

    public $bank1 = 123456;

    public $available_funds;

    public $interest_method;

    public $loan_is_settled = false;

    public $approved_term = 12;

    public $approved_loan_value = 0;

    public $future_interests;

    public $futureInsteresAmount;

    public $valueAmmount;

    public $net_profit;

    public $status;

    public $products;

    public $coverage;

    public $idx;

    public $sub_product_id;

    public $product;

    public $account;

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

    // /////////////
    public $non_permanent_income_non_taxable = 0;

    public $non_permanent_income_taxable = 0;

    public $take_home = 0;

    public $totalInstallment = 0;

    public $max_loan;

    public $selectedContracts = [];

    public $x;

    public $isPhysicalCollateral = false;

    public $account1;

    public $insurance_list = [];

    public $account2;

    public $images = [];

    public $selectedLoan;

    public $ClosedLoanBalance;

    public $appllicationId;

    protected $listeners = ['refresh' => '$refresh'];

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
    public function calculateFirstInterestAmount($principal, $monthlyInterestRate, $dayOfTheMonth)
    {
        // Get the current date (disbursement date)

        $disbursementDate = new DateTime; // current date

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

    public function loadData()
    {

        $applicationId = session('applicationId');

        $application = Application::find($applicationId);
        if ($application === null) {
            return;
        }

        $loanId = $application->loan_id;
        $loan = DB::table('loans')->where('id', $loanId)->first();
        $loanProduct = LoanProduct::find($application->loanProductId);

        $this->principal = $loan->principle ?? 0;
        $this->interestRate = $loan->interest ?? 0;
        $this->tenure = $loan->tenure ?? 0;
        $this->interestMethod = $loanProduct->interest_method ?? 'flat';
        $this->gracePeriod = 0;
        $this->paymentFrequency = $loanProduct->repayment_strategy ?? 'monthly';
        $this->startDate = Carbon::today()->format('Y-m-d');

        // load imahe

        $this->images = DB::table('images')->where('loan_id', $loanId)->get();
    }

    public function rejectApplication()
    {

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
        if (! $application) {
            session()->flash('error', 'Application not found');
        }
        // Don't do anything if loan is already ACTIVE or REJECTED
        if (in_array($application->application_status, ['ACCEPTED', 'REJECTED'])) {
            session()->flash('message', 'No action needed. Application is '.$application->application_status);
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

            return session()->flash('message', 'Application accepted successfully');
        } catch (\Exception $e) {
            // Rollback transaction if any operation fails
            DB::rollBack();

            dd($e->getMessage());

            // Log the error for debugging
            \Log::error('Error accepting application: '.$e->getMessage());

            session()->flash('error', 'Failed to accept application');
        }
    }

    public function generateSchedule()
    {

        $scheduleCalculator = new LoanScheduleService;
        $schedule = $scheduleCalculator->generateLoanRepaymentSchedule(
            $this->principle ?? 1000000,
            $this->interest_value ?? 4,
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

        $service = new LoanScheduleService;
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

        $this->appllicationId = null;

        $this->appllicationId = $applicationId;
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
