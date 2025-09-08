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
        Schema::create('makes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('country')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert comprehensive vehicle makes from around the world
        DB::table('makes')->insert([
            // Japanese Manufacturers
            ['name' => 'Toyota', 'country' => 'Japan', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Honda', 'country' => 'Japan', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nissan', 'country' => 'Japan', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mazda', 'country' => 'Japan', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Subaru', 'country' => 'Japan', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mitsubishi', 'country' => 'Japan', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Suzuki', 'country' => 'Japan', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Daihatsu', 'country' => 'Japan', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lexus', 'country' => 'Japan', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Infiniti', 'country' => 'Japan', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Acura', 'country' => 'Japan', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Isuzu', 'country' => 'Japan', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // German Manufacturers
            ['name' => 'BMW', 'country' => 'Germany', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mercedes-Benz', 'country' => 'Germany', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Audi', 'country' => 'Germany', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Volkswagen', 'country' => 'Germany', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Porsche', 'country' => 'Germany', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Opel', 'country' => 'Germany', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Smart', 'country' => 'Germany', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Maybach', 'country' => 'Germany', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // American Manufacturers
            ['name' => 'Ford', 'country' => 'USA', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chevrolet', 'country' => 'USA', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cadillac', 'country' => 'USA', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Buick', 'country' => 'USA', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'GMC', 'country' => 'USA', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chrysler', 'country' => 'USA', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dodge', 'country' => 'USA', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jeep', 'country' => 'USA', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ram', 'country' => 'USA', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lincoln', 'country' => 'USA', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tesla', 'country' => 'USA', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Korean Manufacturers
            ['name' => 'Hyundai', 'country' => 'South Korea', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kia', 'country' => 'South Korea', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Genesis', 'country' => 'South Korea', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // French Manufacturers
            ['name' => 'Peugeot', 'country' => 'France', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Renault', 'country' => 'France', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Citroën', 'country' => 'France', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'DS', 'country' => 'France', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alpine', 'country' => 'France', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Italian Manufacturers
            ['name' => 'Fiat', 'country' => 'Italy', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ferrari', 'country' => 'Italy', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lamborghini', 'country' => 'Italy', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Maserati', 'country' => 'Italy', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alfa Romeo', 'country' => 'Italy', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lancia', 'country' => 'Italy', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Swedish Manufacturers
            ['name' => 'Volvo', 'country' => 'Sweden', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Saab', 'country' => 'Sweden', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Koenigsegg', 'country' => 'Sweden', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // British Manufacturers
            ['name' => 'Jaguar', 'country' => 'UK', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Land Rover', 'country' => 'UK', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Range Rover', 'country' => 'UK', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Aston Martin', 'country' => 'UK', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bentley', 'country' => 'UK', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rolls-Royce', 'country' => 'UK', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'McLaren', 'country' => 'UK', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mini', 'country' => 'UK', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Chinese Manufacturers
            ['name' => 'BYD', 'country' => 'China', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Geely', 'country' => 'China', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Great Wall', 'country' => 'China', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chery', 'country' => 'China', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'JAC', 'country' => 'China', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MG', 'country' => 'China', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Indian Manufacturers
            ['name' => 'Tata', 'country' => 'India', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mahindra', 'country' => 'India', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Maruti Suzuki', 'country' => 'India', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Russian Manufacturers
            ['name' => 'Lada', 'country' => 'Russia', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'UAZ', 'country' => 'Russia', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Brazilian Manufacturers
            ['name' => 'Troller', 'country' => 'Brazil', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Australian Manufacturers
            ['name' => 'Holden', 'country' => 'Australia', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Czech Manufacturers
            ['name' => 'Škoda', 'country' => 'Czech Republic', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Romanian Manufacturers
            ['name' => 'Dacia', 'country' => 'Romania', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Spanish Manufacturers
            ['name' => 'SEAT', 'country' => 'Spain', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Malaysian Manufacturers
            ['name' => 'Proton', 'country' => 'Malaysia', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Perodua', 'country' => 'Malaysia', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Thai Manufacturers
            ['name' => 'Mazda Thailand', 'country' => 'Thailand', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Indonesian Manufacturers
            ['name' => 'Toyota Indonesia', 'country' => 'Indonesia', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('makes');
    }
};
