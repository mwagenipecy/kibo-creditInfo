<?php

namespace Database\Seeders;

use App\Models\Garage;
use Illuminate\Database\Seeder;

class GarageSeeder extends Seeder
{
    public function run()
    {
        $garages = [
            [
                'name' => 'AutoCare Plus',
                'description' => 'Full-service automotive repair and maintenance center with certified technicians.',
                'address' => '123 Main Street',
                'city' => 'Springfield',
                'state' => 'IL',
                'zip_code' => '62701',
                'latitude' => 39.7817,
                'longitude' => -89.6501,
                'phone' => '(555) 123-4567',
                'email' => 'info@autocareplus.com',
                'services' => ['Oil Change', 'Brake Service', 'Tire Service', 'Engine Repair'],
                'rating' => 4.5,
                'opening_hours' => 'Mon-Fri 8AM-6PM, Sat 8AM-4PM',
                'website' => 'https://autocareplus.com',
                'is_active' => true,
            ],
            [
                'name' => 'Quick Lube Express',
                'description' => 'Fast and efficient oil change and basic maintenance services.',
                'address' => '456 Oak Avenue',
                'city' => 'Springfield',
                'state' => 'IL',
                'zip_code' => '62702',
                'latitude' => 39.7901,
                'longitude' => -89.6440,
                'phone' => '(555) 987-6543',
                'email' => 'service@quicklube.com',
                'services' => ['Oil Change', 'Battery Service', 'Inspection'],
                'rating' => 4.2,
                'opening_hours' => 'Mon-Sat 7AM-7PM, Sun 9AM-5PM',
                'website' => 'https://quicklubeexpress.com',
                'is_active' => true,
            ],
            [
                'name' => 'European Auto Specialists',
                'description' => 'Specialized in BMW, Mercedes, Audi, and other European vehicles.',
                'address' => '789 Elm Street',
                'city' => 'Springfield',
                'state' => 'IL',
                'zip_code' => '62703',
                'latitude' => 39.7985,
                'longitude' => -89.6379,
                'phone' => '(555) 456-7890',
                'email' => 'contact@euroauto.com',
                'services' => ['Engine Repair', 'Transmission Service', 'Air Conditioning', 'Brake Service'],
                'rating' => 4.8,
                'opening_hours' => 'Mon-Fri 8AM-5PM',
                'website' => 'https://europeanautospecs.com',
                'is_active' => true,
            ],
        ];

        foreach ($garages as $garage) {
            Garage::create($garage);
        }
    }
}
