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
        Schema::create('lender_financing_criterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lender_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('min_loan_amount', 10, 2)->nullable();
            $table->decimal('max_loan_amount', 10, 2)->nullable();
            $table->integer('min_tenure_months')->nullable();
            $table->integer('max_tenure_months')->nullable();
            $table->decimal('min_interest_rate', 5, 2)->nullable();
            $table->decimal('max_interest_rate', 5, 2)->nullable();
            $table->decimal('min_down_payment_percent', 5, 2)->nullable();
            $table->decimal('max_down_payment_percent', 5, 2)->nullable();
            $table->integer('min_credit_score')->nullable();
            $table->integer('min_employment_months')->nullable();
            $table->decimal('min_monthly_income', 10, 2)->nullable();
            $table->json('vehicle_criteria')->nullable(); // Age, mileage, condition requirements
            $table->json('document_requirements')->nullable();
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
        Schema::dropIfExists('lender_financing_criterias');
    }
};
