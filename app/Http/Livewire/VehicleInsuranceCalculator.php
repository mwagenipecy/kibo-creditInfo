<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class VehicleInsuranceCalculator extends Component
{
    // Vehicle Information
    public $vehicleType = '';
    public $vehicleMake = '';
    public $vehicleModel = '';
    public $yearOfManufacture = '';
    public $engineCapacity = '';
    public $vehicleValue = '';
    public $vehicleUsage = '';
    public $registrationNumber = '';

    // Driver Information
    public $driverAge = '';
    public $drivingExperience = '';
    public $location = '';
    public $hasClaimsHistory = false;
    public $claimsCount = 0;

    // Coverage Options
    public $coverageType = 'third_party';
    public $excessAmount = 100000;
    public $includeWindscreen = false;
    public $includeRadio = false;
    public $includePersonalAccident = false;

    // Results
    public $calculationResults = null;
    public $showResults = false;
    public $showContactForm = false;

    // Contact Form
    public $customerName = '';
    public $customerPhone = '';
    public $customerEmail = '';
    public $preferredContact = 'phone';
    public $additionalNotes = '';

    public $vehicleTypes = [
        'private_car' => 'Private Car',
        'commercial_vehicle' => 'Commercial Vehicle',
        'motorcycle' => 'Motorcycle',
        'bus' => 'Bus/Public Transport',
        'truck' => 'Truck/Heavy Vehicle',
        'taxi' => 'Taxi'
    ];

    public $vehicleMakes = [
        'Toyota' => 'Toyota',
        'Honda' => 'Honda',
        'Nissan' => 'Nissan',
        'Mitsubishi' => 'Mitsubishi',
        'Suzuki' => 'Suzuki',
        'Isuzu' => 'Isuzu',
        'Mazda' => 'Mazda',
        'Subaru' => 'Subaru',
        'Mercedes-Benz' => 'Mercedes-Benz',
        'BMW' => 'BMW',
        'Volkswagen' => 'Volkswagen',
        'Ford' => 'Ford',
        'Hyundai' => 'Hyundai',
        'Kia' => 'Kia',
        'Other' => 'Other'
    ];

    public $vehicleUsages = [
        'private' => 'Private Use',
        'commercial' => 'Commercial Use',
        'taxi' => 'Taxi/Hire',
        'public_transport' => 'Public Transport',
        'government' => 'Government',
        'diplomatic' => 'Diplomatic'
    ];

    public $tanzanianRegions = [
        'Dar es Salaam' => 'Dar es Salaam',
        'Arusha' => 'Arusha',
        'Mwanza' => 'Mwanza',
        'Dodoma' => 'Dodoma',
        'Mbeya' => 'Mbeya',
        'Morogoro' => 'Morogoro',
        'Tanga' => 'Tanga',
        'Iringa' => 'Iringa',
        'Mtwara' => 'Mtwara',
        'Tabora' => 'Tabora',
        'Kigoma' => 'Kigoma',
        'Shinyanga' => 'Shinyanga',
        'Kagera' => 'Kagera',
        'Kilimanjaro' => 'Kilimanjaro',
        'Manyara' => 'Manyara',
        'Lindi' => 'Lindi',
        'Ruvuma' => 'Ruvuma',
        'Rukwa' => 'Rukwa',
        'Pwani' => 'Pwani (Coast)',
        'Singida' => 'Singida',
        'Katavi' => 'Katavi',
        'Simiyu' => 'Simiyu',
        'Geita' => 'Geita',
        'Njombe' => 'Njombe',
        'Songwe' => 'Songwe'
    ];

    protected $rules = [
        'vehicleType' => 'required',
        'vehicleMake' => 'required',
        'vehicleModel' => 'required',
        'yearOfManufacture' => 'required|integer|min:1980|max:2025',
        'engineCapacity' => 'required|integer|min:50|max:8000',
        'vehicleValue' => 'required|numeric|min:500000',
        'vehicleUsage' => 'required',
        'driverAge' => 'required|integer|min:18|max:80',
        'drivingExperience' => 'required|integer|min:0|max:60',
        'location' => 'required',
        'customerName' => 'required_if:showContactForm,true|string|max:255',
        'customerPhone' => 'required_if:showContactForm,true|string|max:20',
        'customerEmail' => 'nullable|email|max:255'
    ];

    public function mount()
    {
        $this->yearOfManufacture = date('Y');
        $this->location = 'Dar es Salaam';
        $this->driverAge = 25;
        $this->drivingExperience = 3;
    }

    public function updatedHasClaimsHistory()
    {
        if (!$this->hasClaimsHistory) {
            $this->claimsCount = 0;
        }
    }

    public function updatedCoverageType()
    {
        // Reset add-ons for third party
        if ($this->coverageType === 'third_party') {
            $this->includeWindscreen = false;
            $this->includeRadio = false;
        }
    }

    public function calculateInsurance()
    {
        $this->validate([
            'vehicleType' => 'required',
            'vehicleMake' => 'required',
            'vehicleModel' => 'required',
            'yearOfManufacture' => 'required|integer|min:1980|max:2025',
            'engineCapacity' => 'required|integer|min:50|max:8000',
            'vehicleValue' => 'required|numeric|min:500000',
            'vehicleUsage' => 'required',
            'driverAge' => 'required|integer|min:18|max:80',
            'drivingExperience' => 'required|integer|min:0|max:60',
            'location' => 'required'
        ]);

        try {
            $this->calculationResults = $this->performCalculation();
            $this->showResults = true;
            
            $this->emit('notify', [
                'type' => 'success',
                'message' => 'Insurance premium calculated successfully!'
            ]);

            // Log the calculation for analytics
            Log::info('Insurance calculation performed', [
                'vehicle_type' => $this->vehicleType,
                'vehicle_value' => $this->vehicleValue,
                'coverage_type' => $this->coverageType,
                'location' => $this->location,
                'calculated_premium' => $this->calculationResults['total_premium']
            ]);

        } catch (\Exception $e) {
            Log::error('Insurance calculation error: ' . $e->getMessage());
            
            $this->emit('notify', [
                'type' => 'error',
                'message' => 'Error calculating insurance. Please try again.'
            ]);
        }
    }

    private function performCalculation()
    {
        $basePremium = 0;
        $vehicleAge = date('Y') - $this->yearOfManufacture;
        $vehicleValue = (float) $this->vehicleValue;

        // Base premium calculation based on coverage type
        if ($this->coverageType === 'third_party') {
            $basePremium = $this->calculateThirdPartyPremium();
        } else {
            $basePremium = $this->calculateComprehensivePremium($vehicleValue, $vehicleAge);
        }

        // Apply multipliers
        $multipliers = $this->calculateMultipliers($vehicleAge);
        $adjustedPremium = $basePremium * $multipliers['total_multiplier'];

        // Add-ons (only for comprehensive)
        $addOns = [];
        $addOnsCost = 0;

        if ($this->coverageType === 'comprehensive') {
            if ($this->includeWindscreen) {
                $windscreenCost = $vehicleValue * 0.005; // 0.5% of vehicle value
                $addOns['windscreen'] = $windscreenCost;
                $addOnsCost += $windscreenCost;
            }

            if ($this->includeRadio) {
                $radioCost = min(200000, $vehicleValue * 0.002); // Max TSh 200,000
                $addOns['radio'] = $radioCost;
                $addOnsCost += $radioCost;
            }
        }

        if ($this->includePersonalAccident) {
            $personalAccidentCost = 50000; // Fixed TSh 50,000
            $addOns['personal_accident'] = $personalAccidentCost;
            $addOnsCost += $personalAccidentCost;
        }

        // Government levy and taxes
        $governmentLevy = ($adjustedPremium + $addOnsCost) * 0.04; // 4% levy
        $stampDuty = 2000; // Fixed TSh 2,000
        $serviceTax = ($adjustedPremium + $addOnsCost) * 0.18; // 18% VAT

        $totalPremium = $adjustedPremium + $addOnsCost + $governmentLevy + $stampDuty + $serviceTax;

        return [
            'base_premium' => round($basePremium),
            'multipliers' => $multipliers,
            'adjusted_premium' => round($adjustedPremium),
            'add_ons' => $addOns,
            'add_ons_total' => round($addOnsCost),
            'government_levy' => round($governmentLevy),
            'stamp_duty' => round($stampDuty),
            'service_tax' => round($serviceTax),
            'total_premium' => round($totalPremium),
            'monthly_premium' => round($totalPremium / 12),
            'excess_amount' => $this->excessAmount,
            'coverage_details' => $this->getCoverageDetails()
        ];
    }

    private function calculateThirdPartyPremium()
    {
        $basePremiums = [
            'private_car' => [
                '0-1000' => 80000,
                '1001-1500' => 120000,
                '1501-2000' => 160000,
                '2001+' => 200000
            ],
            'commercial_vehicle' => [
                '0-1000' => 150000,
                '1001-1500' => 200000,
                '1501-2000' => 250000,
                '2001+' => 300000
            ],
            'motorcycle' => [
                '0-250' => 50000,
                '251-500' => 70000,
                '501+' => 90000
            ],
            'taxi' => [
                '0-1500' => 250000,
                '1501-2000' => 300000,
                '2001+' => 350000
            ],
            'bus' => 400000,
            'truck' => 350000
        ];

        $vehicleCategory = $this->vehicleType;
        $engineCC = (int) $this->engineCapacity;

        if (isset($basePremiums[$vehicleCategory])) {
            if (is_array($basePremiums[$vehicleCategory])) {
                foreach ($basePremiums[$vehicleCategory] as $range => $premium) {
                    if (strpos($range, '-') !== false) {
                        [$min, $max] = explode('-', $range);
                        if ($engineCC >= (int)$min && $engineCC <= (int)$max) {
                            return $premium;
                        }
                    } elseif (strpos($range, '+') !== false) {
                        $min = (int) str_replace('+', '', $range);
                        if ($engineCC >= $min) {
                            return $premium;
                        }
                    }
                }
                // Default to highest premium if no match
                return end($basePremiums[$vehicleCategory]);
            } else {
                return $basePremiums[$vehicleCategory];
            }
        }

        return 120000; // Default premium
    }

    private function calculateComprehensivePremium($vehicleValue, $vehicleAge)
    {
        // Base rate as percentage of vehicle value
        $baseRates = [
            'private_car' => 0.04, // 4%
            'commercial_vehicle' => 0.06, // 6%
            'motorcycle' => 0.05, // 5%
            'taxi' => 0.08, // 8%
            'bus' => 0.07, // 7%
            'truck' => 0.06 // 6%
        ];

        $baseRate = $baseRates[$this->vehicleType] ?? 0.04;
        return $vehicleValue * $baseRate;
    }

    private function calculateMultipliers($vehicleAge)
    {
        $multipliers = [
            'age_multiplier' => 1.0,
            'experience_multiplier' => 1.0,
            'location_multiplier' => 1.0,
            'usage_multiplier' => 1.0,
            'claims_multiplier' => 1.0,
            'vehicle_age_multiplier' => 1.0
        ];

        // Driver age multiplier
        if ($this->driverAge < 25) {
            $multipliers['age_multiplier'] = 1.3;
        } elseif ($this->driverAge >= 25 && $this->driverAge <= 35) {
            $multipliers['age_multiplier'] = 1.0;
        } elseif ($this->driverAge > 65) {
            $multipliers['age_multiplier'] = 1.2;
        } else {
            $multipliers['age_multiplier'] = 0.9; // Discount for experienced drivers
        }

        // Driving experience multiplier
        if ($this->drivingExperience < 2) {
            $multipliers['experience_multiplier'] = 1.4;
        } elseif ($this->drivingExperience >= 5) {
            $multipliers['experience_multiplier'] = 0.9;
        }

        // Location multiplier
        $riskAreas = ['Dar es Salaam', 'Arusha', 'Mwanza'];
        if (in_array($this->location, $riskAreas)) {
            $multipliers['location_multiplier'] = 1.2;
        } else {
            $multipliers['location_multiplier'] = 0.9;
        }

        // Usage multiplier
        $usageMultipliers = [
            'private' => 1.0,
            'commercial' => 1.3,
            'taxi' => 1.5,
            'public_transport' => 1.4,
            'government' => 0.9,
            'diplomatic' => 0.8
        ];
        $multipliers['usage_multiplier'] = $usageMultipliers[$this->vehicleUsage] ?? 1.0;

        // Claims history multiplier
        if ($this->hasClaimsHistory) {
            $multipliers['claims_multiplier'] = 1.0 + ($this->claimsCount * 0.2);
        } else {
            $multipliers['claims_multiplier'] = 0.9; // No claims discount
        }

        // Vehicle age multiplier
        if ($vehicleAge > 10) {
            $multipliers['vehicle_age_multiplier'] = 1.3;
        } elseif ($vehicleAge > 5) {
            $multipliers['vehicle_age_multiplier'] = 1.1;
        }

        // Calculate total multiplier
        $multipliers['total_multiplier'] = array_product($multipliers);

        return $multipliers;
    }

    private function getCoverageDetails()
    {
        if ($this->coverageType === 'third_party') {
            return [
                'Third Party Injury/Death' => 'Up to TSh 30,000,000',
                'Third Party Property Damage' => 'Up to TSh 5,000,000',
                'Passenger Liability' => 'Up to TSh 10,000,000 per person',
                'Legal Costs' => 'Covered',
                'Own Vehicle Damage' => 'Not Covered',
                'Theft/Fire' => 'Not Covered'
            ];
        } else {
            return [
                'Third Party Injury/Death' => 'Up to TSh 30,000,000',
                'Third Party Property Damage' => 'Up to TSh 5,000,000',
                'Own Vehicle Damage' => 'Market Value less excess',
                'Theft & Hijacking' => 'Market Value less excess',
                'Fire & Lightning' => 'Covered',
                'Flood & Storm Damage' => 'Covered',
                'Windscreen' => $this->includeWindscreen ? 'Covered' : 'Not Covered',
                'Radio/Accessories' => $this->includeRadio ? 'Covered up to limit' : 'Not Covered',
                'Personal Accident' => $this->includePersonalAccident ? 'TSh 2,000,000' : 'Not Covered',
                'Towing Services' => 'Covered',
                'Emergency Repairs' => 'Covered'
            ];
        }
    }

    public function showContactModal()
    {
        $this->showContactForm = true;
    }

    public function closeContactForm()
    {
        $this->showContactForm = false;
        $this->resetContactForm();
    }

    public function submitContactForm()
    {
        $this->validate([
            'customerName' => 'required|string|max:255',
            'customerPhone' => 'required|string|max:20',
            'customerEmail' => 'nullable|email|max:255'
        ]);

        try {
            // Here you would typically save to database or send email
            // For now, we'll just log the inquiry
            Log::info('Insurance inquiry submitted', [
                'customer_name' => $this->customerName,
                'customer_phone' => $this->customerPhone,
                'customer_email' => $this->customerEmail,
                'vehicle_details' => [
                    'type' => $this->vehicleType,
                    'make' => $this->vehicleMake,
                    'model' => $this->vehicleModel,
                    'value' => $this->vehicleValue
                ],
                'calculated_premium' => $this->calculationResults['total_premium'] ?? null,
                'preferred_contact' => $this->preferredContact,
                'notes' => $this->additionalNotes
            ]);

            $this->emit('notify', [
                'type' => 'success',
                'message' => 'Your inquiry has been submitted! Our team will contact you within 24 hours.'
            ]);

            $this->closeContactForm();

        } catch (\Exception $e) {
            Log::error('Contact form submission error: ' . $e->getMessage());
            
            $this->emit('notify', [
                'type' => 'error',
                'message' => 'Error submitting your inquiry. Please try again or call us directly.'
            ]);
        }
    }

    private function resetContactForm()
    {
        $this->customerName = '';
        $this->customerPhone = '';
        $this->customerEmail = '';
        $this->preferredContact = 'phone';
        $this->additionalNotes = '';
    }

    public function resetCalculator()
    {
        $this->reset([
            'vehicleType', 'vehicleMake', 'vehicleModel', 'yearOfManufacture',
            'engineCapacity', 'vehicleValue', 'vehicleUsage', 'registrationNumber',
            'driverAge', 'drivingExperience', 'hasClaimsHistory', 'claimsCount',
            'coverageType', 'includeWindscreen', 'includeRadio', 'includePersonalAccident',
            'calculationResults', 'showResults'
        ]);
        
        $this->mount(); // Reset to default values
    }

    public function render()
    {
        return view('livewire.vehicle-insurance-calculator');
    }
}