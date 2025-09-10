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
        Schema::create('body_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Insert default body types
        DB::table('body_types')->insert([
            ['name' => 'Sedan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'SUV', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hatchback', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Coupe', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Convertible', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Wagon', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pickup Truck', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Van', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Crossover', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sports Car', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Luxury Car', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Compact Car', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('body_types');
    }
};
