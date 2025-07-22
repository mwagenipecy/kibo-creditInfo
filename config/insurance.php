<?php

// config/insurance.php - Insurance configuration file

return [
    /*
    |--------------------------------------------------------------------------
    | Tanzania Insurance Settings
    |--------------------------------------------------------------------------
    |
    | Configuration for Tanzania vehicle insurance calculations
    |
    */

    'company' => [
        'name' => 'Tanzania Premier Insurance',
        'license_number' => 'IRA/001/2024',
        'phone' => '+255-22-211-8888',
        'whatsapp' => '+255-753-123-456',
        'email' => 'info@tanzaniainsurance.co.tz',
        'website' => 'https://tanzaniainsurance.co.tz',
        'address' => 'Insurance House, Dar es Salaam, Tanzania',
    ],

    'rates' => [
        'third_party' => [
            'private_car' => [
                '0-1000' => 80000,
                '1001-1500' => 120000,
                '1501-2000' => 160000,
                '2001+' => 200000,
            ],
            'commercial_vehicle' => [
                '0-1000' => 150000,
                '1001-1500' => 200000,
                '1501-2000' => 250000,
                '2001+' => 300000,
            ],
            'motorcycle' => [
                '0-250' => 50000,
                '251-500' => 70000,
                '501+' => 90000,
            ],
            'taxi' => [
                '0-1500' => 250000,
                '1501-2000' => 300000,
                '2001+' => 350000,
            ],
            'bus' => 400000,
            'truck' => 350000,
        ],

        'comprehensive' => [
            'private_car' => 0.04, // 4% of vehicle value
            'commercial_vehicle' => 0.06, // 6%
            'motorcycle' => 0.05, // 5%
            'taxi' => 0.08, // 8%
            'bus' => 0.07, // 7%
            'truck' => 0.06, // 6%
        ],
    ],

    'multipliers' => [
        'age' => [
            'under_25' => 1.3,
            '25_35' => 1.0,
            '36_65' => 0.9,
            'over_65' => 1.2,
        ],
        'experience' => [
            'under_2_years' => 1.4,
            '2_5_years' => 1.0,
            'over_5_years' => 0.9,
        ],
        'location' => [
            'high_risk' => ['Dar es Salaam', 'Arusha', 'Mwanza'],
            'high_risk_multiplier' => 1.2,
            'low_risk_multiplier' => 0.9,
        ],
        'usage' => [
            'private' => 1.0,
            'commercial' => 1.3,
            'taxi' => 1.5,
            'public_transport' => 1.4,
            'government' => 0.9,
            'diplomatic' => 0.8,
        ],
        'vehicle_age' => [
            'under_5_years' => 1.0,
            '5_10_years' => 1.1,
            'over_10_years' => 1.3,
        ],
        'claims' => [
            'no_claims_discount' => 0.9,
            'per_claim_penalty' => 0.2,
        ],
    ],

    'taxes_and_fees' => [
        'government_levy' => 0.04, // 4%
        'service_tax' => 0.18, // 18% VAT
        'stamp_duty' => 2000, // Fixed TSh 2,000
    ],

    'add_ons' => [
        'windscreen' => 0.005, // 0.5% of vehicle value
        'radio' => 0.002, // 0.2% of vehicle value, max TSh 200,000
        'radio_max' => 200000,
        'personal_accident' => 50000, // Fixed TSh 50,000
        'personal_accident_coverage' => 2000000, // TSh 2,000,000 coverage
    ],

    'coverage_limits' => [
        'third_party_injury_death' => 30000000, // TSh 30,000,000
        'third_party_property' => 5000000, // TSh 5,000,000
        'passenger_liability' => 10000000, // TSh 10,000,000 per person
    ],

    'excess_options' => [
        50000 => 'TSh 50,000 (Higher premium)',
        100000 => 'TSh 100,000 (Standard)',
        200000 => 'TSh 200,000 (Lower premium)',
        300000 => 'TSh 300,000 (Lowest premium)',
    ],

    'regions' => [
        'high_risk' => [
            'Dar es Salaam',
            'Arusha',
            'Mwanza',
        ],
        'medium_risk' => [
            'Dodoma',
            'Mbeya',
            'Morogoro',
            'Tanga',
        ],
        'low_risk' => [
            'Iringa', 'Mtwara', 'Tabora', 'Kigoma', 'Shinyanga',
            'Kagera', 'Kilimanjaro', 'Manyara', 'Lindi', 'Ruvuma',
            'Rukwa', 'Pwani', 'Singida', 'Katavi', 'Simiyu',
            'Geita', 'Njombe', 'Songwe'
        ],
    ],

    'validation' => [
        'min_vehicle_value' => 500000, // Minimum TSh 500,000
        'max_vehicle_value' => 500000000, // Maximum TSh 500,000,000
        'min_driver_age' => 18,
        'max_driver_age' => 80,
        'min_year' => 1980,
        'max_year' => 2025,
        'min_engine_cc' => 50,
        'max_engine_cc' => 8000,
    ],

    'notifications' => [
        'email' => [
            'quote_request' => env('INSURANCE_QUOTE_EMAIL', 'quotes@tanzaniainsurance.co.tz'),
            'claims' => env('INSURANCE_CLAIMS_EMAIL', 'claims@tanzaniainsurance.co.tz'),
        ],
        'sms' => [
            'enabled' => env('INSURANCE_SMS_ENABLED', true),
            'provider' => env('SMS_PROVIDER', 'africas_talking'),
        ],
    ],

    'integration' => [
        'payment_gateway' => [
            'enabled' => env('INSURANCE_PAYMENTS_ENABLED', true),
            'provider' => env('PAYMENT_PROVIDER', 'selcom'),
            'currencies' => ['TZS'],
        ],
        'crm' => [
            'enabled' => env('INSURANCE_CRM_ENABLED', false),
            'webhook_url' => env('INSURANCE_CRM_WEBHOOK'),
        ],
    ],
];
