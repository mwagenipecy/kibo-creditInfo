<?php
// Simple test script to verify marketplace functionality
// Run this in your browser or via command line

require_once 'vendor/autoload.php';

use App\Models\SparePart;
use App\Models\SpareCategory;
use App\Models\SpareBrand;
use App\Models\Shop;

// Test database connections
try {
    echo "Testing database connections...\n";
    
    // Test shops
    $shops = Shop::count();
    echo "Shops found: {$shops}\n";
    
    // Test categories
    $categories = SpareCategory::count();
    echo "Categories found: {$categories}\n";
    
    // Test brands
    $brands = SpareBrand::count();
    echo "Brands found: {$brands}\n";
    
    // Test spare parts
    $parts = SparePart::count();
    echo "Spare parts found: {$parts}\n";
    
    // Test relationships
    if ($parts > 0) {
        $part = SparePart::with(['spareCategory', 'spareBrand', 'spareModel', 'shop'])->first();
        echo "Sample part: {$part->unit}\n";
        echo "Category: {$part->spareCategory->name}\n";
        echo "Shop: {$part->shop->name}\n";
    }
    
    echo "All tests passed!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
