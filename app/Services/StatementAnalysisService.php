<?php

namespace App\Services;

use App\Models\StatementAnalysis;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class StatementAnalysisService
{
    /**
     * Process and store the statement analysis JSON response.
     *
     * @param array $response The JSON response from the API
     * @param int|null $userId The ID of the user this analysis belongs to (optional)
     * @return StatementAnalysis
     */
    public function processAndStore(array $response, $userId = null)
    {
        // Extract relevant data from the response
        $profileData = $response['profile'] ?? [];
        $analysis1d = $response['1d_analysis'] ?? [];
        $analysis2d = $response['2d_analysis'] ?? [];
        $analysis3d = $response['3d_analysis'] ?? [];
        $affordabilityScores = $response['affordability_scores'] ?? [];

        // Extract main account details
        $accountNumber = $profileData['account'] ?? $profileData['name'] ?? null;
        $provider = $profileData['company'] ?? null;
        
        // Parse dates
        $startDate = null;
        $endDate = null;
        
        if (!empty($profileData['start_date'])) {
            $startDate = Carbon::parse($profileData['start_date'])->toDateString();
        }
        
        if (!empty($profileData['end_date'])) {
            $endDate = Carbon::parse($profileData['end_date'])->toDateString();
        }

        // Extract transaction metrics
        $totalTransactions = $profileData['no_of_transactions'] ?? null;
        $walletBalance = $analysis1d['customer_profile']['wallet_balance'] ?? null;
        $totalTurnover = $analysis1d['customer_profile']['total_turnover'] ?? null;

        // Create analysis summary for more efficient querying
        $analysisSummary = $this->createAnalysisSummary($analysis1d, $analysis2d, $analysis3d);

        // Save to database
        $statementAnalysis = StatementAnalysis::create([
            'account_number' => $accountNumber,
            'provider' => $provider,
            'statement_start_date' => $startDate,
            'statement_end_date' => $endDate,
            'total_transactions' => $totalTransactions,
            'wallet_balance' => $walletBalance,
            'total_turnover' => $totalTurnover,
            'affordability_score_high' => $affordabilityScores['high'] ?? null,
            'affordability_score_moderate' => $affordabilityScores['moderate'] ?? null,
            'affordability_score_low' => $affordabilityScores['low'] ?? null,
            'affordability_rank' => $affordabilityScores['rank'] ?? null,
            'raw_response' => $response,
            'analysis_summary' => $analysisSummary,
            'user_id' => $userId,
        ]);

        return $statementAnalysis;
    }

    /**
     * Create a summary of the analysis for better query performance.
     *
     * @param array $analysis1d
     * @param array $analysis2d
     * @param array $analysis3d
     * @return array
     */
    protected function createAnalysisSummary(array $analysis1d, array $analysis2d, array $analysis3d)
    {
        $summary = [
            'cash_flow' => [
                'total_turnover' => $analysis1d['cash_flow_summary']['total_turnover'] ?? 0,
                'total_cashin' => $analysis1d['cash_flow_summary']['total_cashin'] ?? 0,
                'total_cashout' => $analysis1d['cash_flow_summary']['total_cashout'] ?? 0,
            ],
            'cash_inflow' => $analysis2d['cash_inflow'] ?? [],
            'cash_outflow' => $analysis2d['cash_outflow'] ?? [],
            'monthly_analysis' => [
                'inflow' => $analysis3d['cash_flow_analysis']['cash_inflow'] ?? [],
                'outflow' => $analysis3d['cash_flow_analysis']['cash_outflow'] ?? []
            ],
            'loan_activity' => []
        ];

        // Extract loan information from 1d analysis
        $loanTypes = ['songesha', 'mpawa', 'chomoka', 'mgodi'];
        foreach ($loanTypes as $loanType) {
            $loanInfo = $analysis1d["{$loanType}_info"] ?? [];
            if (!empty($loanInfo)) {
                $summary['loan_activity'][$loanType] = [
                    'disbursed' => [
                        'total' => $loanInfo["total_amount_{$loanType}_disbursed"] ?? 0,
                        'count' => $loanInfo["number_of_{$loanType}_disbursements"] ?? 0,
                        'average' => $loanInfo["average_{$loanType}_disbursement_amount"] ?? 0,
                        'max' => $loanInfo["max_amount_{$loanType}_disbursed"] ?? 0,
                        'last_date' => $loanInfo["last_day_of_{$loanType}_disbursement"] ?? null,
                        'last_amount' => $loanInfo["last_{$loanType}_disbursement_amount"] ?? 0,
                    ],
                    'repaid' => [
                        'total' => $loanInfo["total_amount_{$loanType}_repaid"] ?? 0,
                        'count' => $loanInfo["number_of_{$loanType}_repayments"] ?? 0,
                        'average' => $loanInfo["average_{$loanType}_repayment_amount"] ?? 0,
                        'max' => $loanInfo["max_amount_{$loanType}_repaid"] ?? 0,
                        'last_date' => $loanInfo["last_day_of_{$loanType}_repayment"] ?? null,
                        'last_amount' => $loanInfo["last_{$loanType}_repayment_amount"] ?? 0,
                    ]
                ];
            }
        }

        return $summary;
    }

    /**
     * Verify a statement analysis based on criteria.
     *
     * @param StatementAnalysis $analysis
     * @param array $criteria Optional criteria to use for verification
     * @return bool
     */
    public function verifyStatement(StatementAnalysis $analysis, array $criteria = [])
    {
        // Default criteria if none provided
        $defaultCriteria = [
            'min_transactions' => 5,
            'min_turnover' => 100000,
            'min_days' => 7,
        ];

        $criteria = array_merge($defaultCriteria, $criteria);
        
        // Get 1d analysis from raw response
        $analysis1d = $analysis->raw_response['1d_analysis'] ?? [];
        
        // Check total transactions
        $totalTransactions = $analysis->total_transactions;
        if ($totalTransactions < $criteria['min_transactions']) {
            return false;
        }
        
        // Check total turnover
        $totalTurnover = $analysis->total_turnover;
        if ($totalTurnover < $criteria['min_turnover']) {
            return false;
        }
        
        // Check statement duration
        $startDate = Carbon::parse($analysis->statement_start_date);
        $endDate = Carbon::parse($analysis->statement_end_date);
        $days = $startDate->diffInDays($endDate);
        
        if ($days < $criteria['min_days']) {
            return false;
        }
        
        // Check if statement is valid according to the API
        $isValid = $analysis1d['statement_check']['isvalid'] ?? false;
        if (!$isValid) {
            return false;
        }
        
        // Update verification status
        $analysis->is_verified = true;
        $analysis->save();
        
        return true;
    }
}