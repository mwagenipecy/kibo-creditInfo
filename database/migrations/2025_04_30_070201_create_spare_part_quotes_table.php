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
        Schema::create('spare_part_quotes', function (Blueprint $table) {
            $table->id();
            
            // Foreign Keys
            $table->foreignId('spare_part_request_id')->constrained()->onDelete('cascade');
            $table->foreignId('shop_id')->constrained()->onDelete('cascade');
            
            // Quote Information
            $table->decimal('price', 10, 2);
            $table->string('currency', 3)->default('TZS');
            $table->text('description')->nullable();
            $table->string('brand')->nullable();
            $table->string('part_number')->nullable();
            $table->integer('quantity_available')->default(1);
            $table->integer('delivery_time_days')->nullable();
            $table->decimal('delivery_cost', 10, 2)->default(0);
            
            // Quote Status
            $table->enum('status', ['pending', 'accepted', 'rejected', 'expired'])->default('pending');
            $table->timestamp('expires_at')->nullable();
            
            // Shop Notes
            $table->text('shop_notes')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index(['spare_part_request_id', 'shop_id']);
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
        Schema::dropIfExists('spare_part_quotes');
    }
};
