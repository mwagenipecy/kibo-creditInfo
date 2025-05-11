<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatementAnalysis extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_number',
        'full_name',
        'is_verified',
        'special_id',
        'provider',
        'statement_start_date',
        'statement_end_date',
        'total_transactions',
        'total_turnover',
        'wallet_balance',
        'affordability_score_high',
        'affordability_score_moderate',
        'affordability_score_low',
        'affordability_rank',
        'raw_response',
        'analysis_summary',
        'user_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_verified' => 'boolean',
        'statement_start_date' => 'date',
        'statement_end_date' => 'date',
        'total_transactions' => 'integer',
        'total_turnover' => 'decimal:2',
        'wallet_balance' => 'decimal:2',
        'affordability_score_high' => 'decimal:2',
        'affordability_score_moderate' => 'decimal:2',
        'affordability_score_low' => 'decimal:2',
        'affordability_rank' => 'integer',
        'raw_response' => 'array',
        'analysis_summary' => 'array',
    ];

    /**
     * Get the user that owns the statement analysis.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the cash inflow summary from the analysis.
     *
     * @return array|null
     */
    public function getCashInflowAttribute()
    {
        return $this->analysis_summary['cash_inflow'] ?? null;
    }

    /**
     * Get the cash outflow summary from the analysis.
     *
     * @return array|null
     */
    public function getCashOutflowAttribute()
    {
        return $this->analysis_summary['cash_outflow'] ?? null;
    }

    /**
     * Get the loan activity from the analysis.
     *
     * @return array|null
     */
    public function getLoanActivityAttribute()
    {
        return $this->analysis_summary['loan_activity'] ?? null;
    }

    /**
     * Get the affordability scores as an array.
     *
     * @return array
     */
    public function getAffordabilityScoresAttribute()
    {
        return [
            'rank' => $this->affordability_rank,
            'high' => $this->affordability_score_high,
            'moderate' => $this->affordability_score_moderate,
            'low' => $this->affordability_score_low,
        ];
    }

    /**
     * Scope a query to only include verified statements.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope a query to filter by provider.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $provider
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByProvider($query, $provider)
    {
        return $query->where('provider', $provider);
    }

    /**
     * Scope a query to filter by account number.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $accountNumber
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByAccount($query, $accountNumber)
    {
        return $query->where('account_number', $accountNumber);
    }
}