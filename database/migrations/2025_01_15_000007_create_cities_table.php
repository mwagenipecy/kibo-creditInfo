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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('region');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert default cities in Tanzania
        DB::table('cities')->insert([
            ['name' => 'Dar es Salaam', 'region' => 'Dar es Salaam', 'latitude' => -6.7924, 'longitude' => 39.2083, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Arusha', 'region' => 'Arusha', 'latitude' => -3.3869, 'longitude' => 36.6830, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mwanza', 'region' => 'Mwanza', 'latitude' => -2.5164, 'longitude' => 32.9176, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dodoma', 'region' => 'Dodoma', 'latitude' => -6.1630, 'longitude' => 35.7516, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tanga', 'region' => 'Tanga', 'latitude' => -5.0694, 'longitude' => 39.0997, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Morogoro', 'region' => 'Morogoro', 'latitude' => -6.8207, 'longitude' => 37.6612, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mbeya', 'region' => 'Mbeya', 'latitude' => -8.9094, 'longitude' => 33.4608, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tabora', 'region' => 'Tabora', 'latitude' => -5.0167, 'longitude' => 32.8000, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Iringa', 'region' => 'Iringa', 'latitude' => -7.7667, 'longitude' => 35.7000, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mtwara', 'region' => 'Mtwara', 'latitude' => -10.2667, 'longitude' => 40.1833, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kigoma', 'region' => 'Kigoma', 'latitude' => -4.8769, 'longitude' => 29.6267, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Moshi', 'region' => 'Kilimanjaro', 'latitude' => -3.3434, 'longitude' => 37.3406, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tanga', 'region' => 'Tanga', 'latitude' => -5.0694, 'longitude' => 39.0997, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Musoma', 'region' => 'Mara', 'latitude' => -1.5000, 'longitude' => 33.8000, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Shinyanga', 'region' => 'Shinyanga', 'latitude' => -3.6619, 'longitude' => 33.4231, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
