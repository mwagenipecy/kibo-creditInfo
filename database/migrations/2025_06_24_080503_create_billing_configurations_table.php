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
        Schema::create('billing_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('tax_rate', 5, 2)->default(0.00);
            $table->decimal('service_charge', 5, 2)->default(0.00);
            $table->string('currency', 3)->default('TZS');
            $table->string('invoice_prefix')->default('INV');
            $table->integer('invoice_number_start')->default(1);
            $table->integer('payment_terms_days')->default(30);
            $table->text('terms_conditions')->nullable();
            $table->text('footer_text')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('billing_configurations');
    }
};
