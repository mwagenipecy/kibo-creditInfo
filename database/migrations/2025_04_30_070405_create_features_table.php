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
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->nullable();
            $table->timestamps();
        });

        // Insert default vehicle features
        DB::table('features')->insert([
            // Safety Features
            ['name' => 'Airbags', 'category' => 'Safety', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ABS Brakes', 'category' => 'Safety', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Electronic Stability Control', 'category' => 'Safety', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lane Departure Warning', 'category' => 'Safety', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Blind Spot Monitoring', 'category' => 'Safety', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rear View Camera', 'category' => 'Safety', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Parking Sensors', 'category' => 'Safety', 'created_at' => now(), 'updated_at' => now()],
            
            // Comfort Features
            ['name' => 'Air Conditioning', 'category' => 'Comfort', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Heated Seats', 'category' => 'Comfort', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Leather Seats', 'category' => 'Comfort', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Power Windows', 'category' => 'Comfort', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Power Steering', 'category' => 'Comfort', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cruise Control', 'category' => 'Comfort', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sunroof', 'category' => 'Comfort', 'created_at' => now(), 'updated_at' => now()],
            
            // Technology Features
            ['name' => 'Bluetooth', 'category' => 'Technology', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'GPS Navigation', 'category' => 'Technology', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'USB Ports', 'category' => 'Technology', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Touchscreen Display', 'category' => 'Technology', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Apple CarPlay', 'category' => 'Technology', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Android Auto', 'category' => 'Technology', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Wireless Charging', 'category' => 'Technology', 'created_at' => now(), 'updated_at' => now()],
            
            // Performance Features
            ['name' => 'Turbo Engine', 'category' => 'Performance', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'All-Wheel Drive', 'category' => 'Performance', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sport Mode', 'category' => 'Performance', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Paddle Shifters', 'category' => 'Performance', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Limited Slip Differential', 'category' => 'Performance', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('features');
    }
};
