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
        Schema::create('spare_brands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spare_category_id')->constrained('spare_categories')->onDelete('cascade');
            $table->string('name');
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert default spare brands
        DB::table('spare_brands')->insert([
            // Brake System brands
            ['spare_category_id' => 1, 'name' => 'Brembo', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_category_id' => 1, 'name' => 'Bosch', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_category_id' => 1, 'name' => 'NGK', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_category_id' => 1, 'name' => 'Denso', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Engine Parts brands
            ['spare_category_id' => 2, 'name' => 'Mann', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_category_id' => 2, 'name' => 'Mahle', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_category_id' => 2, 'name' => 'Fram', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_category_id' => 2, 'name' => 'K&N', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Air & Fuel System brands
            ['spare_category_id' => 3, 'name' => 'K&N', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_category_id' => 3, 'name' => 'AEM', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_category_id' => 3, 'name' => 'Injen', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_category_id' => 3, 'name' => 'HKS', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Ignition System brands
            ['spare_category_id' => 4, 'name' => 'NGK', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_category_id' => 4, 'name' => 'Denso', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_category_id' => 4, 'name' => 'Bosch', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_category_id' => 4, 'name' => 'Champion', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Timing System brands
            ['spare_category_id' => 5, 'name' => 'Gates', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_category_id' => 5, 'name' => 'Continental', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_category_id' => 5, 'name' => 'Dayco', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_category_id' => 5, 'name' => 'Bando', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spare_brands');
    }
};
