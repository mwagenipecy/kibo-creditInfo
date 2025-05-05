<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = storage_path('app/public/car-list.json');
        
        // Read the JSON data from the file
        $jsonData = File::get($jsonPath);
        $carData = json_decode($jsonData, true);
        
        // Process each car brand
        foreach ($carData as $carBrand) {
            // Insert the make (brand) first
            $makeId = DB::table('makes')->insertGetId([
                'name' => $carBrand['brand']
            ]);
            
            // Then insert all models for this make
            foreach ($carBrand['models'] as $modelName) {
                DB::table('vehicle_models')->insert([
                    'make_id' => $makeId,
                    'name' => $modelName
                ]);
            }
        }
       
        
        $this->command->info('Car makes and models imported successfully!');    }
}
