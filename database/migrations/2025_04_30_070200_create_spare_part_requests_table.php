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
        Schema::create('spare_part_requests', function (Blueprint $table) {
            $table->id();
            
            // Vehicle Information
            $table->foreignId('make_id')->constrained('makes')->onDelete('cascade');
            $table->foreignId('model_id')->constrained('vehicle_models')->onDelete('cascade');
            $table->integer('year');
            
            // Part Information
            $table->string('part_name');
            $table->string('part_number')->nullable();
            $table->string('part_size')->nullable();
            $table->text('description')->nullable();
            
            // User Information
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->text('additional_notes')->nullable();
            
            // Request Status
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->timestamp('expires_at')->nullable();
            
            // Location (optional for future use)
            $table->string('location')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index(['make_id', 'model_id', 'year']);
            $table->index('status');
            $table->index('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spare_part_requests');
    }
};
