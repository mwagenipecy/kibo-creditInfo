<?php

namespace Database\Seeders;
use App\Models\SpareCategory;
use App\Models\SpareBrand;
use App\Models\SpareModel;
use Illuminate\Database\Seeder;

class SpareCategoryBrandModelSeeder extends Seeder
{
    public function run()
    {
        // -------------------------
        // BATTERY CATEGORY
        // -------------------------
        $battery = SpareCategory::create(['name' => 'Battery']);

        $batteryBrands = [
            'Exide' => ['N70', 'N100', 'N120', '35Ah', '55Ah'],
            'Bosch' => ['S3', 'S4', 'S5', 'SM Mega Power', 'Hightec Silver'],
            'Amaron' => ['GO', 'HiLife', 'Black', 'Pro'],
            'Rocket' => ['SMF', 'MF', 'ES70L'],
            'Panasonic' => ['75D23L', '80D26L', '95D31R'],
            'Solite' => ['NS60', 'NS70', 'N50'],
            'Furukawa' => ['FTZ5S', 'FTX7L-BS'],
            'Delkor' => ['55B24L', '80D26L', '95D31L']
        ];

        foreach ($batteryBrands as $brand => $models) {
            $brandModel = SpareBrand::create([
                'name' => $brand,
                'spare_category_id' => $battery->id,
            ]);

            foreach ($models as $model) {
                SpareModel::create([
                    'name' => $model,
                    'spare_brand_id' => $brandModel->id,
                ]);
            }
        }

        // -------------------------
        // TYRE CATEGORY
        // -------------------------
        $tyre = SpareCategory::create(['name' => 'Tyre']);

        $tyreBrands = [
            'Michelin' => ['Energy Saver', 'Pilot Sport 4', 'Primacy 4'],
            'Dunlop' => ['SP Sport LM705', 'Grandtrek AT3', 'AT20', 'SP Touring R1'],
            'Bridgestone' => ['Dueler H/T', 'Ecopia EP150', 'Potenza RE003'],
            'Yokohama' => ['Geolandar A/T', 'BluEarth AE01', 'Advan Fleva'],
            'Hankook' => ['Dynapro AT2', 'Kinergy Eco2', 'Ventus Prime'],
            'Continental' => ['ContiCrossContact', 'EcoContact 6', 'PremiumContact 6'],
            'Goodyear' => ['Wrangler AT', 'EfficientGrip', 'Eagle F1'],
            'Pirelli' => ['Scorpion Verde', 'Cinturato P6', 'P Zero']
        ];

        foreach ($tyreBrands as $brand => $models) {
            $brandModel = SpareBrand::create([
                'name' => $brand,
                'spare_category_id' => $tyre->id,
            ]);

            foreach ($models as $model) {
                SpareModel::create([
                    'name' => $model,
                    'spare_brand_id' => $brandModel->id,
                ]);
            }
        }
    }
}

