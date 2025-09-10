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
        Schema::create('fuel_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Insert default fuel types
        DB::table('fuel_types')->insert([
            ['name' => 'Petrol', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Diesel', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hybrid', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Electric', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'LPG', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CNG', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Biofuel', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hydrogen', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuel_types');
    }
};
