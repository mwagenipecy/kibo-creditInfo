<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class VehicleInsuranceCalculator extends Component
{
    // Basic inputs
    public $insurableValue = '';
    public $vehicleClass = '';
    public $typeOfCover = '';
    public $carryingPassengers = 'No';

    // Results
    public $calculationResults = null;
    public $showResults = false;

    // Contact Form
    public $customerName = '';
    public $customerPhone = '';
    public $customerEmail = '';
    public $showContactForm = false;

    // Vehicle Classes from Excel
    public $vehicleClasses = [
        'Private Cars' => 'Private Cars',
        'Motorcycle Wheelers 2' => 'Motorcycle Wheelers 2',
        'Motorcycle Wheelers 3' => 'Motorcycle Wheelers 3',
        'Commercial Vehicles' => 'Commercial Vehicles',
        'Special Type of Vehicle' => 'Special Type of Vehicle'
    ];

    // Coverage types based on vehicle class
    public $coverageOptions = [
        'Private Cars' => [
            'Comprehensive Free Vehicle' => ['rate' => 0.035, 'min_premium' => 250000, 'type' => 'CC'],
            'Comprehensive Claim Record' => ['rate' => 0.04, 'min_premium' => 250000, 'type' => 'CC'],
            'Third Party Fire Theft' => ['rate' => 0.02, 'min_premium' => 200000, 'type' => 'TPFT'],
            'Third Party Only' => ['rate' => 0, 'min_premium' => 100000, 'type' => 'TPO']
        ],
        'Motorcycle Wheelers 2' => [
            'Comprehensive Free Vehicle' => ['rate' => 0.05, 'min_premium' => 0, 'additional' => 15000, 'type' => 'CC'],
            'Comprehensive Claim Record' => ['rate' => 0.06, 'min_premium' => 0, 'additional' => 15000, 'type' => 'CC'],
            'Third Party Fire Theft' => ['rate' => 0.035, 'min_premium' => 100000, 'additional' => 15000, 'type' => 'TPFT'],
            'Third Party Only' => ['rate' => 0, 'min_premium' => 50000, 'additional' => 15000, 'type' => 'TPO']
        ],
        'Motorcycle Wheelers 3' => [
            'Comprehensive Free Vehicle' => ['rate' => 0.06, 'min_premium' => 125000, 'additional' => 45000, 'type' => 'CC'],
            'Comprehensive Claim Record' => ['rate' => 0.07, 'min_premium' => 125000, 'additional' => 45000, 'type' => 'CC'],
            'Third Party Fire Theft' => ['rate' => 0.035, 'min_premium' => 100000, 'additional' => 45000, 'type' => 'TPFT'],
            'Third Party Only' => ['rate' => 0, 'min_premium' => 75000, 'additional' => 45000, 'type' => 'TPO']
        ],
        'Commercial Vehicles' => [
            'Own Goods Comprehensive Free Vehicle' => ['rate' => 0.0425, 'min_premium' => 500000, 'type' => 'CC'],
            'Own Goods Comprehensive Claim Record' => ['rate' => 0.0475, 'min_premium' => 500000, 'type' => 'CC'],
            'Own Goods Third Party Fire Theft' => ['rate' => 0.025, 'min_premium' => 350000, 'type' => 'TPFT'],
            'General Cartage Comprehensive Free Vehicle' => ['rate' => 0.05, 'min_premium' => 500000, 'type' => 'CC'],
            'General Cartage Third Party Fire Theft' => ['rate' => 0.03, 'min_premium' => 350000, 'type' => 'TPFT'],
            'Third Party Only (up to 2 tonnes)' => ['rate' => 0, 'min_premium' => 150000, 'type' => 'TPO'],
            'Third Party Only (5-10 tonnes)' => ['rate' => 0, 'min_premium' => 250000, 'type' => 'TPO'],
            'Third Party Only (above 10 tonnes)' => ['rate' => 0, 'min_premium' => 300000, 'type' => 'TPO']
        ],
        'Special Type of Vehicle' => [
            'Comprehensive (Farm Tractors, Forklifts, etc.)' => ['rate' => 0.02, 'min_premium' => 250000, 'type' => 'CC']
        ]
    ];

    protected $rules = [
        'insurableValue' => 'required|numeric|min:500000',
        'vehicleClass' => 'required',
        'typeOfCover' => 'required',
        'customerName' => 'required_if:showContactForm,true|string|max:255',
        'customerPhone' => 'required_if:showContactForm,true|string|max:20',
        'customerEmail' => 'nullable|email|max:255'
    ];

    public function mount()
    {
        $this->insurableValue = 5000000; // Default value from Excel
    }

    public function updatedVehicleClass()
    {
        $this->typeOfCover = '';
        $this->calculationResults = null;
        $this->showResults = false;
    }

    public function getAvailableCoverageOptions()
    {
        if (!$this->vehicleClass || !isset($this->coverageOptions[$this->vehicleClass])) {
            return [];
        }
        
        return $this->coverageOptions[$this->vehicleClass];
    }

    public function calculateInsurance()
    {
        $this->validate([
            'insurableValue' => 'required|numeric|min:500000',
            'vehicleClass' => 'required',
            'typeOfCover' => 'required'
        ]);

        try {
            $this->calculationResults = $this->performCalculation();
            $this->showResults = true;
            
            $this->emit('notify', [
                'type' => 'success',
                'message' => 'Insurance premium calculated successfully!'
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
        $insurableValue = (float) $this->insurableValue;
        $coverageData = $this->coverageOptions[$this->vehicleClass][$this->typeOfCover];
        
        // Calculate base premium
        $basePremium = 0;
        if ($coverageData['rate'] > 0) {
            $basePremium = $insurableValue * $coverageData['rate'];
        }
        
        // Apply minimum premium
        if (isset($coverageData['min_premium']) && $basePremium < $coverageData['min_premium']) {
            $basePremium = $coverageData['min_premium'];
        }
        
        // Add additional charges (for motorcycles with passengers)
        $additionalCharge = 0;
        if (isset($coverageData['additional']) && $this->carryingPassengers === 'Yes') {
            $additionalCharge = $coverageData['additional'];
        }
        
        $premiumExclVat = $basePremium + $additionalCharge;
        
        // Calculate VAT (18%)
        $vatRate = 0.18;
        $vatAmount = $premiumExclVat * $vatRate;
        $totalPremium = $premiumExclVat + $vatAmount;
        
        return [
            'insurable_value' => $insurableValue,
            'vehicle_class' => $this->vehicleClass,
            'type_of_cover' => $this->typeOfCover,
            'coverage_type' => $coverageData['type'],
            'premium_rate' => $coverageData['rate'],
            'base_premium' => round($basePremium),
            'additional_charge' => round($additionalCharge),
            'premium_excl_vat' => round($premiumExclVat),
            'vat_rate' => $vatRate,
            'vat_amount' => round($vatAmount),
            'total_premium' => round($totalPremium),
            'monthly_premium' => round($totalPremium / 12),
            'excess_info' => $this->getExcessInfo($coverageData['type'])
        ];
    }

    private function getExcessInfo($coverageType)
    {
        $excessInfo = [
            'CC' => 'For Comprehensive Cover: 5% of claim amount, minimum TZS 350,000 (double for total theft)',
            'TPFT' => 'NIL for Third Party claims',
            'TPO' => 'NIL for Third Party claims'
        ];
        
        return $excessInfo[$coverageType] ?? 'Please contact us for excess details';
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
            Log::info('Insurance inquiry submitted', [
                'customer_name' => $this->customerName,
                'customer_phone' => $this->customerPhone,
                'customer_email' => $this->customerEmail,
                'vehicle_class' => $this->vehicleClass,
                'type_of_cover' => $this->typeOfCover,
                'insurable_value' => $this->insurableValue,
                'calculated_premium' => $this->calculationResults['total_premium'] ?? null
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
    }

    public function resetCalculator()
    {
        $this->reset([
            'insurableValue', 'vehicleClass', 'typeOfCover', 'carryingPassengers',
            'calculationResults', 'showResults'
        ]);
        
        $this->mount();
    }

    public function render()
    {
        return view('livewire.vehicle-insurance-calculator');
    }
}







