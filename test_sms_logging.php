<?php
/**
 * Test script to verify SMS logging functionality
 * Run this from command line: php test_sms_logging.php
 * 
 * Or access via browser if placed in public folder
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

echo "=== Testing SMS Logging Setup ===\n\n";

// Test 1: Check if table exists
echo "1. Checking if 'selcom_sms_logs' table exists...\n";
try {
    $tableExists = DB::getSchemaBuilder()->hasTable('selcom_sms_logs');
    if ($tableExists) {
        echo "   ✓ Table exists!\n";
        
        // Get table columns
        $columns = DB::getSchemaBuilder()->getColumnListing('selcom_sms_logs');
        echo "   Columns: " . implode(', ', $columns) . "\n";
    } else {
        echo "   ✗ Table does NOT exist!\n";
        echo "   → Please run: selcom_sms_logs.sql\n";
    }
} catch (\Exception $e) {
    echo "   ✗ Error checking table: " . $e->getMessage() . "\n";
}

echo "\n";

// Test 2: Try to insert a test record
echo "2. Testing database insert...\n";
try {
    $testData = [
        'phone' => '255758238772',
        'message' => 'Test SMS message',
        'status' => 'pending',
        'error_message' => null,
        'http_code' => null,
        'response_data' => null,
        'client_id' => 999,
        'campaign_id' => null,
        'request_id' => null,
        'sent_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ];
    
    $inserted = DB::table('selcom_sms_logs')->insert($testData);
    
    if ($inserted) {
        echo "   ✓ Test record inserted successfully!\n";
        
        // Get the inserted record
        $record = DB::table('selcom_sms_logs')
            ->where('client_id', 999)
            ->orderBy('id', 'desc')
            ->first();
        
        if ($record) {
            echo "   Record ID: {$record->id}\n";
            echo "   Phone: {$record->phone}\n";
            echo "   Status: {$record->status}\n";
            
            // Clean up test record
            DB::table('selcom_sms_logs')->where('id', $record->id)->delete();
            echo "   → Test record cleaned up\n";
        }
    } else {
        echo "   ✗ Insert failed (returned false)\n";
    }
} catch (\Exception $e) {
    echo "   ✗ Error inserting test record: " . $e->getMessage() . "\n";
    echo "   Error Code: " . $e->getCode() . "\n";
    if (method_exists($e, 'getSql')) {
        echo "   SQL: " . $e->getSql() . "\n";
    }
}

echo "\n";

// Test 3: Check existing records
echo "3. Checking existing records...\n";
try {
    $count = DB::table('selcom_sms_logs')->count();
    echo "   Total records: {$count}\n";
    
    if ($count > 0) {
        $latest = DB::table('selcom_sms_logs')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();
        
        echo "   Latest 5 records:\n";
        foreach ($latest as $record) {
            echo "   - ID: {$record->id}, Phone: {$record->phone}, Status: {$record->status}, Created: {$record->created_at}\n";
        }
    }
} catch (\Exception $e) {
    echo "   ✗ Error checking records: " . $e->getMessage() . "\n";
}

echo "\n";

// Test 4: Database connection
echo "4. Testing database connection...\n";
try {
    $connection = DB::connection()->getPdo();
    echo "   ✓ Database connection successful!\n";
    echo "   Database: " . DB::connection()->getDatabaseName() . "\n";
} catch (\Exception $e) {
    echo "   ✗ Database connection failed: " . $e->getMessage() . "\n";
}

echo "\n=== Test Complete ===\n";

