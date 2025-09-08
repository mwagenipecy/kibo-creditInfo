<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spare_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert default spare categories
        DB::table('spare_categories')->insert([
            ['name' => 'Brake System', 'description' => 'Brake pads, discs, calipers, and related components', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Engine Parts', 'description' => 'Oil filters, air filters, spark plugs, and engine components', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Air & Fuel System', 'description' => 'Air filters, fuel filters, and fuel system components', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ignition System', 'description' => 'Spark plugs, ignition coils, and ignition components', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Timing System', 'description' => 'Timing belts, timing chains, and related components', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Suspension', 'description' => 'Shock absorbers, springs, and suspension components', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Electrical', 'description' => 'Batteries, alternators, starters, and electrical components', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Body Parts', 'description' => 'Bumpers, mirrors, lights, and body components', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spare_categories');
    }
};
