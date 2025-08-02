<?php

namespace App\Services;

use App\Models\Lender;
use App\Models\LenderFinancingCriteria;
use App\Models\Vehicle;

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
}
