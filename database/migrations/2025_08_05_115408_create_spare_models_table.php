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
        Schema::create('spare_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spare_brand_id')->constrained('spare_brands')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert default spare models
        DB::table('spare_models')->insert([
            // Brembo models
            ['spare_brand_id' => 1, 'name' => 'Sport', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_brand_id' => 1, 'name' => 'GT', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_brand_id' => 1, 'name' => 'Racing', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_brand_id' => 1, 'name' => 'Street', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Bosch models
            ['spare_brand_id' => 2, 'name' => 'Premium', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_brand_id' => 2, 'name' => 'Standard', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_brand_id' => 2, 'name' => 'Performance', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_brand_id' => 2, 'name' => 'Economy', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // NGK models
            ['spare_brand_id' => 3, 'name' => 'Iridium', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_brand_id' => 3, 'name' => 'Platinum', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_brand_id' => 3, 'name' => 'Copper', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_brand_id' => 3, 'name' => 'Silver', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Gates models
            ['spare_brand_id' => 17, 'name' => 'PowerGrip', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_brand_id' => 17, 'name' => 'Micro-V', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_brand_id' => 17, 'name' => 'Poly Chain', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['spare_brand_id' => 17, 'name' => 'Synchronous', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spare_models');
    }
};
