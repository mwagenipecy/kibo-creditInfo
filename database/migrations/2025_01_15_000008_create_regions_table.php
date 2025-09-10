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
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert default regions in Tanzania
        DB::table('regions')->insert([
            ['name' => 'Dar es Salaam', 'code' => 'DSM', 'latitude' => -6.7924, 'longitude' => 39.2083, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Arusha', 'code' => 'ARU', 'latitude' => -3.3869, 'longitude' => 36.6830, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mwanza', 'code' => 'MWZ', 'latitude' => -2.5164, 'longitude' => 32.9176, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dodoma', 'code' => 'DOD', 'latitude' => -6.1630, 'longitude' => 35.7516, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tanga', 'code' => 'TAN', 'latitude' => -5.0694, 'longitude' => 39.0997, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Morogoro', 'code' => 'MOR', 'latitude' => -6.8207, 'longitude' => 37.6612, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mbeya', 'code' => 'MBY', 'latitude' => -8.9094, 'longitude' => 33.4608, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tabora', 'code' => 'TAB', 'latitude' => -5.0167, 'longitude' => 32.8000, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Iringa', 'code' => 'IRI', 'latitude' => -7.7667, 'longitude' => 35.7000, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mtwara', 'code' => 'MTW', 'latitude' => -10.2667, 'longitude' => 40.1833, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kigoma', 'code' => 'KIG', 'latitude' => -4.8769, 'longitude' => 29.6267, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kilimanjaro', 'code' => 'KIL', 'latitude' => -3.3434, 'longitude' => 37.3406, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mara', 'code' => 'MAR', 'latitude' => -1.5000, 'longitude' => 33.8000, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Shinyanga', 'code' => 'SHI', 'latitude' => -3.6619, 'longitude' => 33.4231, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Singida', 'code' => 'SIN', 'latitude' => -4.8167, 'longitude' => 34.7500, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rukwa', 'code' => 'RUK', 'latitude' => -8.0000, 'longitude' => 31.5000, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ruvuma', 'code' => 'RUV', 'latitude' => -10.6879, 'longitude' => 35.3163, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lindi', 'code' => 'LIN', 'latitude' => -9.9967, 'longitude' => 39.7142, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pwani', 'code' => 'PWA', 'latitude' => -7.0000, 'longitude' => 39.0000, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Manyara', 'code' => 'MAN', 'latitude' => -4.3150, 'longitude' => 36.9544, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }
};
