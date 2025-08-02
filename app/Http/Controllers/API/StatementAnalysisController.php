<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\StatementAnalysis;
use App\Services\StatementAnalysisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class StatementAnalysisController extends Controller
{
    /**
     * The statement analysis service instance.
     *
     * @var \App\Services\StatementAnalysisService
     */
    protected $statementService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(StatementAnalysisService $statementService)
    {
        $this->statementService = $statementService;
    }

    /**
     * Store a newly received statement analysis.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'response' => 'required|array',
                'full_name' => 'nullable|string|max:255',
                'special_id' => 'nullable|string|max:255',
                'user_id' => 'nullable',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            Log::info('manka call back');
            // Process the statement analysis JSON
            $response = $request->input('response');
            $fullName = $request->input('full_name');
            $specialId = $request->input('special_id');
            $userId = $request->input('user_id');

            Log::info('Create the statement analysis record');
            // Create the statement analysis record
            $analysis = $this->statementService->processAndStore($response, $userId);

            // Update the optional fields
            if ($fullName) {
                $analysis->full_name = $fullName;
            }

            if ($specialId) {
                $analysis->special_id = $specialId;
            }

            $analysis->save();

            Log::info('Verify the statement based on default criteria');

            // Verify the statement based on default criteria
            $isVerified = $this->statementService->verifyStatement($analysis);

            Log::info($isVerified);

            return response()->json([
                'success' => true,
                'message' => 'Statement analysis processed successfully',
                'data' => [
                    'id' => $analysis->id,
                    'account_number' => $analysis->account_number,
                    'provider' => $analysis->provider,
                    'is_verified' => $analysis->is_verified,
                    'affordability_scores' => $analysis->affordabilityScores,
                ],
            ], 201);

        } catch (\Exception $e) {
            Log::error('Failed to process statement analysis: '.$e->getMessage(), [
                'exception' => $e,
                'request' => $request->except(['response']),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to process statement analysis',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get statement analysis by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $analysis = StatementAnalysis::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $analysis->id,
                    'account_number' => $analysis->account_number,
                    'full_name' => $analysis->full_name,
                    'provider' => $analysis->provider,
                    'is_verified' => $analysis->is_verified,
                    'special_id' => $analysis->special_id,
                    'statement_start_date' => $analysis->statement_start_date,
                    'statement_end_date' => $analysis->statement_end_date,
                    'total_transactions' => $analysis->total_transactions,
                    'total_turnover' => $analysis->total_turnover,
                    'wallet_balance' => $analysis->wallet_balance,
                    'affordability_scores' => $analysis->affordabilityScores,
                    'analysis_summary' => $analysis->analysis_summary,
                    'created_at' => $analysis->created_at,
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Statement analysis not found',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Get statement analysis by account number.
     *
     * @return \Illuminate\Http\Response
     */
    public function getByAccount(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'account_number' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $accountNumber = $request->input('account_number');
            $analysis = StatementAnalysis::byAccount($accountNumber)
                ->latest()
                ->first();

            if (! $analysis) {
                return response()->json([
                    'success' => false,
                    'message' => 'No statement analysis found for this account number',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $analysis->id,
                    'account_number' => $analysis->account_number,
                    'full_name' => $analysis->full_name,
                    'provider' => $analysis->provider,
                    'is_verified' => $analysis->is_verified,
                    'special_id' => $analysis->special_id,
                    'statement_start_date' => $analysis->statement_start_date,
                    'statement_end_date' => $analysis->statement_end_date,
                    'affordability_scores' => $analysis->affordabilityScores,
                    'created_at' => $analysis->created_at,
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve statement analysis',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get statement analysis by special ID.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBySpecialId(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'special_id' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $specialId = $request->input('special_id');
            $analysis = StatementAnalysis::where('special_id', $specialId)
                ->latest()
                ->first();

            if (! $analysis) {
                return response()->json([
                    'success' => false,
                    'message' => 'No statement analysis found for this special ID',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $analysis->id,
                    'account_number' => $analysis->account_number,
                    'full_name' => $analysis->full_name,
                    'provider' => $analysis->provider,
                    'is_verified' => $analysis->is_verified,
                    'special_id' => $analysis->special_id,
                    'statement_start_date' => $analysis->statement_start_date,
                    'statement_end_date' => $analysis->statement_end_date,
                    'affordability_scores' => $analysis->affordabilityScores,
                    'created_at' => $analysis->created_at,
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve statement analysis',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get multiple statement analyses by user ID.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function getByUser($userId)
    {
        try {
            $analyses = StatementAnalysis::where('user_id', $userId)
                ->latest()
                ->get();

            if ($analyses->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No statement analyses found for this user',
                ], 404);
            }

            $data = $analyses->map(function ($analysis) {
                return [
                    'id' => $analysis->id,
                    'account_number' => $analysis->account_number,
                    'provider' => $analysis->provider,
                    'is_verified' => $analysis->is_verified,
                    'statement_start_date' => $analysis->statement_start_date,
                    'statement_end_date' => $analysis->statement_end_date,
                    'affordability_scores' => $analysis->affordabilityScores,
                    'created_at' => $analysis->created_at,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $data,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve statement analyses',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
