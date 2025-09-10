<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('import_duty_applications', function (Blueprint $table) {
            $table->enum('application_type', ['PURCHASED', 'WANT_TO_BUY'])->default('PURCHASED')->after('status');
            $table->string('car_listing_url')->nullable()->after('application_type');
            $table->string('extracted_car_image')->nullable()->after('car_listing_url');
            $table->json('extracted_car_details')->nullable()->after('extracted_car_image');
      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('import_duty_applications', function (Blueprint $table) {
            $table->dropColumn(['application_type', 'car_listing_url', 'extracted_car_image', 'extracted_car_details']);
        });
    }
};