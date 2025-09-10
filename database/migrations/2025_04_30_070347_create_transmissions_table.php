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
        Schema::create('transmissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Insert default transmission types
        DB::table('transmissions')->insert([
            ['name' => 'Manual', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Automatic', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CVT', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Semi-Automatic', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dual Clutch', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sequential', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transmissions');
    }
};
