<?php
/**
 * Script to add missing vehicle makes and models to the database
 * Run this script to populate additional vehicle data
 */

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Starting to add missing vehicle makes and models...\n";

try {
    // Read and execute the SQL files
    $sqlFiles = [
        'additional_vehicle_data.sql',
        'additional_models_for_existing_makes.sql', 
        'african_regional_vehicles.sql'
    ];
    
    foreach ($sqlFiles as $file) {
        if (file_exists($file)) {
            echo "Executing $file...\n";
            $sql = file_get_contents($file);
            
            // Split by semicolon and execute each statement
            $statements = array_filter(array_map('trim', explode(';', $sql)));
            
            foreach ($statements as $statement) {
                if (!empty($statement) && !preg_match('/^(--|\/\*)/', $statement)) {
                    try {
                        DB::statement($statement);
                    } catch (Exception $e) {
                        // Skip duplicate key errors and other non-critical errors
                        if (strpos($e->getMessage(), 'Duplicate entry') === false) {
                            echo "Warning: " . $e->getMessage() . "\n";
                        }
                    }
                }
            }
            echo "Completed $file\n";
        } else {
            echo "File $file not found, skipping...\n";
        }
    }
    
    // Get final counts
    $makeCount = DB::table('makes')->count();
    $modelCount = DB::table('vehicle_models')->count();
    
    echo "\n=== SUMMARY ===\n";
    echo "Total Makes: $makeCount\n";
    echo "Total Models: $modelCount\n";
    
    // Show some recent additions
    echo "\n=== RECENT MAKES ADDED ===\n";
    $recentMakes = DB::table('makes')
        ->where('created_at', '>=', now()->subHour())
        ->orderBy('name')
        ->limit(10)
        ->get();
        
    foreach ($recentMakes as $make) {
        echo "- {$make->name}\n";
    }
    
    echo "\nVehicle data addition completed successfully!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
