<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('make_id')->constrained('makes')->onDelete('cascade');
            $table->foreignId('model_id')->constrained('vehicle_models')->onDelete('cascade');
            $table->foreignId('dealer_id')->nullable();
            $table->foreignId('body_type_id')->constrained('body_types')->onDelete('cascade');
            $table->foreignId('fuel_type_id')->constrained('fuel_types')->onDelete('cascade');
            $table->foreignId('transmission_id')->constrained('transmissions')->onDelete('cascade');
            $table->integer('year');
            $table->integer('price');
            $table->integer('mileage');
            $table->string('color');
            $table->string('vin')->unique();
            $table->string('engine_size');
            $table->string('engine_type');
            $table->integer('horsepower');
            $table->string('drivetrain');
            $table->integer('length');
            $table->integer('width');
            $table->integer('height');
            $table->integer('wheelbase');
            $table->integer('seating_capacity');
            $table->integer('cargo_volume');
            $table->string('condition');
            $table->text('description')->nullable();
            $table->string('trim');
            $table->integer('owners');
            $table->string('location');
            $table->boolean('is_featured')->default(false);
            $table->string('vehicle_condition');
            $table->decimal('downPaymentPercent', 5, 2)->nullable();
            $table->string('status')->default('available');
            $table->decimal('rent_price', 10, 2)->nullable();
            $table->boolean('is_for_sale')->default(true);
            $table->boolean('is_wedding_car')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
