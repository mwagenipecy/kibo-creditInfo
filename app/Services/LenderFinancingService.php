<?php

namespace App\Services;

use App\Models\Make;
use App\Models\Vehicle;
use App\Models\LenderFinancingCriteria;
use App\Models\Lender;
use App\Models\VehicleModel;

class LenderFinancingService
{
    public function getLendersForVehicle($vehicleId)
    {
        $vehicle = Vehicle::with(['make', 'model'])->findOrFail($vehicleId);

        $lenderIds = LenderFinancingCriteria::query()
            ->where(function ($query) use ($vehicle) {
                $query->where('make_id', $vehicle->make_id)
                      ->where(function ($q) use ($vehicle) {
                          $q->where('model_id', $vehicle->model_id)
                            ->orWhereNull('model_id');
                      })
                      ->where('min_year', '<=', $vehicle->year)
                      ->where('max_year', '>=', $vehicle->year);
            })
            ->where(function ($query) use ($vehicle) {
                $query->where('max_mileage', '>=', $vehicle->mileage)
                      ->orWhereNull('max_mileage');
            })
            ->where(function ($query) use ($vehicle) {
                $query->where('max_price', '>=', $vehicle->price)
                      ->orWhereNull('max_price');
            })
            ->pluck('lender_id')
            ->unique();

        return Lender::whereIn('id', $lenderIds)->get();
    }

    public function getLendersForVehicleSpecs($makeId, $modelId, $vehiclePrice, $vehicleYear = null)
    {
        return Lender::where('status', 'active')
            ->whereHas('financingCriteria', function($query) use ($makeId, $modelId, $vehiclePrice, $vehicleYear) {
                $query->where('make_id', $makeId)
                      ->where('model_id', $modelId)
                      ->where('min_loan_amount', '<=', $vehiclePrice)
                      ->where('max_loan_amount', '>=', $vehiclePrice);

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

    public function getFinancingCriteria($lenderId, $makeId, $modelId)
    {
        return LenderFinancingCriteria::where('lender_id', $lenderId)
            ->where('make_id', $makeId)
            ->where('model_id', $modelId)
            ->first();
    }

    public function calculateMinimumDownPayment($lenderId, $makeId, $modelId, $vehiclePrice)
    {
        $criteria = $this->getFinancingCriteria($lenderId, $makeId, $modelId);

        if (!$criteria) {
            return 0;
        }

        return ($criteria->min_down_payment_percent / 100) * $vehiclePrice;
    }

    public function calculateLoanAmount($vehiclePrice, $downPayment)
    {
        return max(0, $vehiclePrice - $downPayment);
    }

    public function calculateMonthlyPayment($loanAmount, $interestRate, $tenureMonths, $interestMethod = 'reducing')
    {
        if ($loanAmount <= 0 || $tenureMonths <= 0) {
            return 0;
        }

        if ($interestMethod === 'flat') {
            $totalInterest = ($loanAmount * $interestRate * $tenureMonths) / (100 * 12);
            return ($loanAmount + $totalInterest) / $tenureMonths;
        } else {
            $monthlyRate = $interestRate / (100 * 12);
            if ($monthlyRate == 0) {
                return $loanAmount / $tenureMonths;
            }

            $emi = $loanAmount * ($monthlyRate * pow(1 + $monthlyRate, $tenureMonths)) /
                   (pow(1 + $monthlyRate, $tenureMonths) - 1);

            return $emi;
        }
    }

    public function getAvailableMakes()
    {
        return Make::whereHas('financingCriteria')
            ->orderBy('name')
            ->get();
    }

    public function getAvailableModels($makeId)
    {
        return VehicleModel::where('make_id', $makeId)
            ->whereHas('financingCriteria')
            ->orderBy('name')
            ->get();
    }

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

        usort($comparison, function($a, $b) {
            return $a['monthly_payment'] <=> $b['monthly_payment'];
        });

        return $comparison;
    }

    public function validateLoanApplication($applicationData)
    {
        $errors = [];

        if (!$this->canLenderFinanceVehicle(
            $applicationData['lender_id'],
            $applicationData['make_id'],
            $applicationData['model_id'],
            $applicationData['vehicle_price'],
            $applicationData['vehicle_year'] ?? null
        )) {
            $errors[] = 'Selected lender cannot finance this vehicle';
        }

        $minDownPayment = $this->calculateMinimumDownPayment(
            $applicationData['lender_id'],
            $applicationData['make_id'],
            $applicationData['model_id'],
            $applicationData['vehicle_price']
        );

        if ($applicationData['down_payment'] < $minDownPayment) {
            $errors[] = "Minimum down payment required: " . number_format($minDownPayment);
        }

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
