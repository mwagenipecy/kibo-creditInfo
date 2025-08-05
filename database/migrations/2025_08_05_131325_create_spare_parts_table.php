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
        Schema::create('spare_parts', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->foreignId('shop_id')->constrained()->onDelete('cascade');
            $table->foreignId('spare_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('spare_brand_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('spare_model_id')->nullable()->constrained()->onDelete('set null');

            // Part details
            $table->string('unit'); // e.g., piece, set, box
            $table->enum('price_type', ['per_unit', 'per_bundle']);
            $table->decimal('price', 10, 2);

            // Images
            $table->string('preview_image'); // Required
            $table->string('additional_image_1')->nullable();
            $table->string('additional_image_2')->nullable();

            // Optional description
            $table->text('description')->nullable();

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
        Schema::dropIfExists('spare_parts');
    }
};
