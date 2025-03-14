<?php

namespace App\Http\Livewire\ApplicationSummary;

use Livewire\Component;
use DateTime;

class Assessment extends Component
{

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


    ///////////////
    public $non_permanent_income_non_taxable = 0;
    public $non_permanent_income_taxable = 0;
    public $take_home = 0;
    public $totalInstallment = 0;
    public $tenure = 12;
    public $max_loan, $selectedContracts=[];
    public $x ;
    public $isPhysicalCollateral = false;
    public $account1,$insurance_list=[];
    public $account2;

    public $selectedLoan;
    public $ClosedLoanBalance;



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


    public function render()
    {
        return view('livewire.application-summary.assessment');
    }
}
