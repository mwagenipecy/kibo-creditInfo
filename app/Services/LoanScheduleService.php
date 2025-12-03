<?php

namespace App\Services;

use DateTime;

class LoanScheduleService
{
    /**
     * Generate a loan repayment schedule
     * 
     * @param float $loanAmount The principal amount of the loan
     * @param float $interestRate Annual interest rate (as a percentage, e.g., 4 for 4%)
     * @param int $term Number of installments
     * @param string $startDate Start date in 'Y-m-d' format
     * @param string $interestType 'reducing' or 'flat'
     * @param int $gracePeriod Number of months in the grace period
     * @param string $paymentFrequency 'daily', 'monthly', 'quarterly', 'semi_annual', or 'annual'
     * @return array Schedule and summary data
     */
    public function generateLoanRepaymentSchedule(
        float $loanAmount,
        float $interestRate,
        int $term,
        string $startDate,
        string $interestType = 'reducing',
        int $gracePeriod = 0,
        string $paymentFrequency = 'monthly'
    ) {
        // Validate inputs
        if ($loanAmount <= 0 || $interestRate < 0 || $term <= 0) {
            return [
                'schedule' => [],
                'footer' => [
                    'total_payment' => 0,
                    'total_principal' => 0,
                    'total_interest' => 0,
                    'final_closing_balance' => 0
                ]
            ];
        }
    
        // Convert annual interest rate and date increments based on payment frequency
        $frequencyMultiplier = [
            'daily' => 365,
            'monthly' => 12,
            'quarterly' => 4,
            'semi_annual' => 2,
            'annual' => 1
        ];

        // How many calendar months one payment spans (used to translate term/grace)
        $monthsPerPayment = [
            'daily' => 1 / 30,   // approximate 30 days per month
            'monthly' => 1,
            'quarterly' => 3,
            'semi_annual' => 6,
            'annual' => 12
        ];

        // How far to move the calendar per installment
        $frequencyIntervals = [
            'daily' => ['value' => 1, 'unit' => 'day'],
            'monthly' => ['value' => 1, 'unit' => 'month'],
            'quarterly' => ['value' => 3, 'unit' => 'month'],
            'semi_annual' => ['value' => 6, 'unit' => 'month'],
            'annual' => ['value' => 12, 'unit' => 'month'],
        ];

        $multiplier = $frequencyMultiplier[$paymentFrequency] ?? 12; // Default to monthly
        $monthsStep = $monthsPerPayment[$paymentFrequency] ?? 1;
        $intervalMeta = $frequencyIntervals[$paymentFrequency] ?? ['value' => 1, 'unit' => 'month'];

        // Translate provided term (months) into actual installments count
        $installmentCount = (int) ceil($term / $monthsStep);
        $installmentCount = max(1, $installmentCount);

        // Translate grace period (months) into installments as well
        $graceInstallments = (int) ceil($gracePeriod / $monthsStep);
        $graceInstallments = max(0, $graceInstallments);
        
        // Calculate periodic interest rate
        $periodicInterestRate = $interestRate / ($multiplier * 100);
    
        // Initialize variables
        $schedule = [];
        $totalPayment = 0;
        $totalPrincipal = 0;
        $totalInterest = 0;
        $remainingBalance = $loanAmount;
        $startDateTime = new DateTime($startDate);
        
        // Calculate fixed installment amount
        $installmentAmount = 0;
        if ($interestType === 'reducing') {
            // Formula for reducing balance: PMT = P * r * (1+r)^n / ((1+r)^n - 1)
            if ($periodicInterestRate > 0) {
                $installmentAmount = $loanAmount * $periodicInterestRate * pow(1 + $periodicInterestRate, $installmentCount) / (pow(1 + $periodicInterestRate, $installmentCount) - 1);
            } else {
                // If interest rate is 0, simple division
                $installmentAmount = $loanAmount / $installmentCount;
            }
        } else { // flat rate
            // For flat rate: total interest = principal * rate * term
            $totalFlatInterest = $loanAmount * $periodicInterestRate * $installmentCount;
            $installmentAmount = ($loanAmount + $totalFlatInterest) / $installmentCount;
        }
    
        // Generate schedule
        for ($i = 0; $i < $installmentCount; $i++) {
            $currentDate = clone $startDateTime;
            $intervalValue = $intervalMeta['value'] * $i;
            $intervalUnit = $intervalMeta['unit'];
            $currentDate->modify("+{$intervalValue} {$intervalUnit}");
            
            // Format installment date
            $installmentDate = $currentDate->format('Y-m-d');
            
            $interest = 0;
            $principal = 0;
            $payment = 0;
            $openingBalance = $remainingBalance;
            
            // Check if we're still in grace period
            $inGracePeriod = $i < $graceInstallments;
            
            if ($inGracePeriod) {
                // During grace period, only interest is paid, no principal
                $interest = $interestType === 'reducing' 
                    ? $remainingBalance * $periodicInterestRate
                    : $loanAmount * $periodicInterestRate;
                    
                $payment = $interest;
                $principal = 0;
            } else {
                if ($interestType === 'reducing') {
                    // Calculate interest for reducing balance
                    $interest = $remainingBalance * $periodicInterestRate;
                    $payment = $installmentAmount;
                    
                    // Ensure we don't overpay in the final installment
                    if ($remainingBalance + $interest < $payment) {
                        $payment = $remainingBalance + $interest;
                    }
                    
                    $principal = $payment - $interest;
                } else { // flat rate
                    // For flat rate, interest is calculated on the original principal always
                    $interest = $loanAmount * $periodicInterestRate;
                    $principal = $installmentAmount - $interest;
                    $payment = $installmentAmount;
                }
            }
            
            // Update remaining balance
            $remainingBalance -= $principal;
            
            // Round to 2 decimal places for display
            $remainingBalance = round($remainingBalance, 2);
            if ($remainingBalance < 0.01) $remainingBalance = 0; // Fix floating point issues
            
            // Add to schedule
            $schedule[] = [
                'installment_date' => $installmentDate,
                'opening_balance' => round($openingBalance, 2),
                'payment' => round($payment, 2),
                'principal' => round($principal, 2),
                'interest' => round($interest, 4),
                'closing_balance' => $remainingBalance
            ];
            
            // Update totals
            $totalPayment += $payment;
            $totalPrincipal += $principal;
            $totalInterest += $interest;
        }
        
        // Create footer with summary totals
        $footer = [
            'total_payment' => round($totalPayment, 2),
            'total_principal' => round($totalPrincipal, 2),
            'total_interest' => round($totalInterest, 2),
            'final_closing_balance' => $remainingBalance
        ];
        
        return [
            'schedule' => $schedule,
            'footer' => $footer
        ];
    }
}