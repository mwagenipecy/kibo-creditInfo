<?php

namespace App\Services;

<<<<<<< HEAD
use App\Models\Lender;
use App\Models\LenderFinancingCriteria;
use App\Models\Vehicle;
=======
use App\Models\Make;
use App\Models\Vehicle;
use App\Models\LenderFinancingCriteria;
use App\Models\Lender;
use App\Models\VehicleModel;
>>>>>>> 59d41d23d1256611580c443c5208e25e5c4964a7

class LenderFinancingService
{
    /**
     * Get lenders that will finance a specific vehicle
     *
     * @param  int  $vehicleId  The ID of the vehicle
     * @return \Illuminate\Database\Eloquent\Collection Lenders that will finance the vehicle
     */
    public function getLendersForVehicle($vehicleId)
    {
        // Get the vehicle details
        $vehicle = Vehicle::with(['make', 'model'])->findOrFail($vehicleId);

        // Query lenders that match the vehicle criteria
        $lenderIds = LenderFinancingCriteria::query()
            ->where(function ($query) use ($vehicle) {
                // Match by make
                $query->where('make_id', $vehicle->make_id)
                    // Match by model if specified, otherwise any model for this make
                    ->where(function ($q) use ($vehicle) {
                        $q->where('model_id', $vehicle->model_id)
                            ->orWhereNull('model_id');
                    })
                    // Match by year range
                    ->where('min_year', '<=', $vehicle->year)
                    ->where('max_year', '>=', $vehicle->year);
            })
            // Check additional criteria like mileage, price, etc. if they are set
            ->where(function ($query) use ($vehicle) {
                $query->where('max_mileage', '>=', $vehicle->mileage)
                    ->orWhereNull('max_mileage');
            })
            ->where(function ($query) use ($vehicle) {
                $query->where('max_price', '>=', $vehicle->price)
                    ->orWhereNull('max_price');
            })
            // ->where(function($query) use ($vehicle) {
            //     if (isset($vehicle->downPaymentPercent)) {
            //         $query->where('min_down_payment_percent', '<=', $vehicle->downPaymentPercent)
            //               ->orWhereNull('min_down_payment_percent');
            //     } else {
            //         $query->whereNull('min_down_payment_percent');
            //     }
            // })
            ->pluck('lender_id')
            ->unique();

        // Get the lender details

        return Lender::whereIn('id', $lenderIds)->get();
    }
<<<<<<< HEAD
}
=======






    /**
     * Get qualified lenders based on vehicle specifications
     *
     * @param int $makeId
     * @param int $modelId
     * @param float $vehiclePrice
     * @param int $vehicleYear
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLendersForVehicleSpecs($makeId, $modelId, $vehiclePrice, $vehicleYear = null)
    {
        return Lender::where('status', 'active')
            ->whereHas('financingCriteria', function($query) use ($makeId, $modelId, $vehiclePrice, $vehicleYear) {
                $query->where('make_id', $makeId)
                      ->where('model_id', $modelId)
                      ->where('min_loan_amount', '<=', $vehiclePrice)
                      ->where('max_loan_amount', '>=', $vehiclePrice);
                      
                // Optional: Filter by vehicle year if criteria exists
                if ($vehicleYear) {
                    $query->where(function($q) use ($vehicleYear) {
                        $q->whereNull('min_vehicle_year')
                          ->orWhere('min_vehicle_year', '<=', $vehicleYear);
                    })
                    ->where(function($q) use ($vehicleYear) {
                        $q->whereNull('max_vehicle_year')
                          ->orWhere('max_vehicle_year', '>=', $vehicleYear);
                    });
                }
            })
            ->with(['financingCriteria' => function($query) use ($makeId, $modelId) {
                $query->where('make_id', $makeId)
                      ->where('model_id', $modelId);
            }])
            ->orderBy('name')
            ->get();
    }

    /**
     * Check if a lender can finance a specific vehicle
     *
     * @param int $lenderId
     * @param int $makeId
     * @param int $modelId
     * @param float $vehiclePrice
     * @param int $vehicleYear
     * @return bool
     */
    public function canLenderFinanceVehicle($lenderId, $makeId, $modelId, $vehiclePrice, $vehicleYear = null)
    {
        $criteria = LenderFinancingCriteria::where('lender_id', $lenderId)
            ->where('make_id', $makeId)
            ->where('model_id', $modelId)
            ->where('min_loan_amount', '<=', $vehiclePrice)
            ->where('max_loan_amount', '>=', $vehiclePrice);

        if ($vehicleYear) {
            $criteria->where(function($q) use ($vehicleYear) {
                $q->whereNull('min_vehicle_year')
                  ->orWhere('min_vehicle_year', '<=', $vehicleYear);
            })
            ->where(function($q) use ($vehicleYear) {
                $q->whereNull('max_vehicle_year')
                  ->orWhere('max_vehicle_year', '>=', $vehicleYear);
            });
        }

        return $criteria->exists();
    }

    /**
     * Get financing criteria for a specific lender and vehicle
     *
     * @param int $lenderId
     * @param int $makeId
     * @param int $modelId
     * @return LenderFinancingCriteria|null
     */
    public function getFinancingCriteria($lenderId, $makeId, $modelId)
    {
        return LenderFinancingCriteria::where('lender_id', $lenderId)
            ->where('make_id', $makeId)
            ->where('model_id', $modelId)
            ->first();
    }

    /**
     * Calculate minimum down payment for a vehicle with a specific lender
     *
     * @param int $lenderId
     * @param int $makeId
     * @param int $modelId
     * @param float $vehiclePrice
     * @return float
     */
    public function calculateMinimumDownPayment($lenderId, $makeId, $modelId, $vehiclePrice)
    {
        $criteria = $this->getFinancingCriteria($lenderId, $makeId, $modelId);
        
        if (!$criteria) {
            return 0;
        }

        return ($criteria->min_down_payment_percent / 100) * $vehiclePrice;
    }

    /**
     * Calculate loan amount after down payment
     *
     * @param float $vehiclePrice
     * @param float $downPayment
     * @return float
     */
    public function calculateLoanAmount($vehiclePrice, $downPayment)
    {
        return max(0, $vehiclePrice - $downPayment);
    }

    /**
     * Calculate estimated monthly payment
     *
     * @param float $loanAmount
     * @param float $interestRate (annual percentage)
     * @param int $tenureMonths
     * @param string $interestMethod ('reducing' or 'flat')
     * @return float
     */
    public function calculateMonthlyPayment($loanAmount, $interestRate, $tenureMonths, $interestMethod = 'reducing')
    {
        if ($loanAmount <= 0 || $tenureMonths <= 0) {
            return 0;
        }

        if ($interestMethod === 'flat') {
            // Flat rate calculation
            $totalInterest = ($loanAmount * $interestRate * $tenureMonths) / (100 * 12);
            return ($loanAmount + $totalInterest) / $tenureMonths;
        } else {
            // Reducing balance calculation
            $monthlyRate = $interestRate / (100 * 12);
            
            if ($monthlyRate == 0) {
                return $loanAmount / $tenureMonths;
            }
            
            $emi = $loanAmount * ($monthlyRate * pow(1 + $monthlyRate, $tenureMonths)) / 
                   (pow(1 + $monthlyRate, $tenureMonths) - 1);
            
            return $emi;
        }
    }

    /**
     * Get all makes that have financing options available
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAvailableMakes()
    {
        return Make::whereHas('financingCriteria')
            ->orderBy('name')
            ->get();

            
    }

    /**
     * Get all models for a make that have financing options
     *
     * @param int $makeId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAvailableModels($makeId)
    {
        return VehicleModel::where('make_id', $makeId)
            ->whereHas('financingCriteria')
            ->orderBy('name')
            ->get();


            
    }

    /**
     * Get lender comparison data for a specific vehicle
     *
     * @param int $makeId
     * @param int $modelId
     * @param float $vehiclePrice
     * @param float $downPayment
     * @param int $tenureMonths
     * @return array
     */
    public function getLenderComparison($makeId, $modelId, $vehiclePrice, $downPayment, $tenureMonths)
    {
        $lenders = $this->getLendersForVehicleSpecs($makeId, $modelId, $vehiclePrice);
        $loanAmount = $this->calculateLoanAmount($vehiclePrice, $downPayment);
        $comparison = [];

        foreach ($lenders as $lender) {
            $criteria = $lender->financingCriteria->first();
            
            if ($criteria) {
                $monthlyPayment = $this->calculateMonthlyPayment(
                    $loanAmount,
                    $criteria->interest_rate,
                    $tenureMonths,
                    $criteria->interest_method ?? 'reducing'
                );

                $totalPayment = $monthlyPayment * $tenureMonths;
                $totalInterest = $totalPayment - $loanAmount;

                $comparison[] = [
                    'lender' => $lender,
                    'criteria' => $criteria,
                    'monthly_payment' => $monthlyPayment,
                    'total_payment' => $totalPayment,
                    'total_interest' => $totalInterest,
                    'min_down_payment' => $this->calculateMinimumDownPayment(
                        $lender->id, $makeId, $modelId, $vehiclePrice
                    )
                ];
            }
        }

        // Sort by monthly payment (lowest first)
        usort($comparison, function($a, $b) {
            return $a['monthly_payment'] <=> $b['monthly_payment'];
        });

        return $comparison;
    }

    /**
     * Validate loan application data
     *
     * @param array $applicationData
     * @return array ['valid' => bool, 'errors' => array]
     */
    public function validateLoanApplication($applicationData)
    {
        $errors = [];

        // Check if lender can finance this vehicle
        if (!$this->canLenderFinanceVehicle(
            $applicationData['lender_id'],
            $applicationData['make_id'],
            $applicationData['model_id'],
            $applicationData['vehicle_price'],
            $applicationData['vehicle_year'] ?? null
        )) {
            $errors[] = 'Selected lender cannot finance this vehicle';
        }

        // Check minimum down payment
        $minDownPayment = $this->calculateMinimumDownPayment(
            $applicationData['lender_id'],
            $applicationData['make_id'],
            $applicationData['model_id'],
            $applicationData['vehicle_price']
        );

        if ($applicationData['down_payment'] < $minDownPayment) {
            $errors[] = "Minimum down payment required: " . number_format($minDownPayment);
        }

        // Check loan amount limits
        $loanAmount = $this->calculateLoanAmount(
            $applicationData['vehicle_price'],
            $applicationData['down_payment']
        );

        $criteria = $this->getFinancingCriteria(
            $applicationData['lender_id'],
            $applicationData['make_id'],
            $applicationData['model_id']
        );

        if ($criteria) {
            if ($loanAmount < $criteria->min_loan_amount) {
                $errors[] = "Loan amount too low. Minimum: " . number_format($criteria->min_loan_amount);
            }

            if ($loanAmount > $criteria->max_loan_amount) {
                $errors[] = "Loan amount too high. Maximum: " . number_format($criteria->max_loan_amount);
            }

            // Check tenure limits
            if (isset($applicationData['tenure'])) {
                if ($applicationData['tenure'] < $criteria->min_tenure) {
                    $errors[] = "Minimum tenure: {$criteria->min_tenure} months";
                }

                if ($applicationData['tenure'] > $criteria->max_tenure) {
                    $errors[] = "Maximum tenure: {$criteria->max_tenure} months";
                }
            }
        }

        return [
            'valid' => empty($errors),
            'errors' => $errors
        ];
    }





}
>>>>>>> 59d41d23d1256611580c443c5208e25e5c4964a7
