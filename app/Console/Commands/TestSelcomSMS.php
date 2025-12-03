<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Integration\Selcom\SelcomSMSController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TestSelcomSMS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:test {phone=255624451311} {message?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test sending SMS via Selcom gateway';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $phone = $this->argument('phone');
        $message = $this->argument('message') ?? 'Test SMS from Selcom Gateway. This is a test message.';

        $this->info("Testing SMS sending to: {$phone}");
        $this->info("Message: {$message}");
        $this->newLine();

        // Check if table exists
        $this->info("Checking database setup...");
        try {
            $tableExists = DB::getSchemaBuilder()->hasTable('selcom_sms_logs');
            if ($tableExists) {
                $this->info("✓ selcom_sms_logs table exists");
                $count = DB::table('selcom_sms_logs')->count();
                $this->info("  Current records: {$count}");
            } else {
                $this->error("✗ selcom_sms_logs table does NOT exist!");
                $this->warn("  Please run: selcom_sms_logs.sql");
                return 1;
            }
        } catch (\Exception $e) {
            $this->error("Error checking database: " . $e->getMessage());
            return 1;
        }

        $this->newLine();
        $this->info("Sending SMS...");
        $this->line("----------------------------------------");

        // Send SMS
        $result = SelcomSMSController::send($phone, $message, 999, null);

        $this->newLine();
        
        if ($result['success']) {
            $this->info("✓ SMS sent successfully!");
            $this->line("Request ID: " . ($result['request_id'] ?? 'N/A'));
        } else {
            $this->error("✗ SMS sending failed!");
            $this->error("Error: " . ($result['error'] ?? 'Unknown error'));
            if (isset($result['http_code'])) {
                $this->line("HTTP Code: " . $result['http_code']);
            }
        }

        $this->newLine();
        $this->info("Checking database logs...");

        // Check if record was logged
        try {
            $latest = DB::table('selcom_sms_logs')
                ->where('phone', $phone)
                ->orWhere('phone', 'like', '%' . substr($phone, -9))
                ->orderBy('id', 'desc')
                ->first();

            if ($latest) {
                $this->info("✓ Record found in database:");
                $this->line("  ID: {$latest->id}");
                $this->line("  Phone: {$latest->phone}");
                $this->line("  Status: {$latest->status}");
                $this->line("  Created: {$latest->created_at}");
                
                if ($latest->error_message) {
                    $this->line("  Error: {$latest->error_message}");
                }
            } else {
                $this->warn("⚠ No record found in database for this phone number");
                $this->line("  Checking latest records...");
                
                $allLatest = DB::table('selcom_sms_logs')
                    ->orderBy('id', 'desc')
                    ->limit(5)
                    ->get();
                
                if ($allLatest->count() > 0) {
                    $this->line("  Latest 5 records:");
                    foreach ($allLatest as $rec) {
                        $this->line("    - ID: {$rec->id}, Phone: {$rec->phone}, Status: {$rec->status}");
                    }
                } else {
                    $this->error("  No records in database at all!");
                }
            }
        } catch (\Exception $e) {
            $this->error("Error checking logs: " . $e->getMessage());
        }

        $this->newLine();
        $this->info("Check Laravel logs for detailed information:");
        $this->line("tail -f storage/logs/laravel.log");

        return $result['success'] ? 0 : 1;
    }
}

