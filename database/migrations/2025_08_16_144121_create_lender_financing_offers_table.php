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
        Schema::create('lender_financing_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lender_id')->nullable();
            $table->foreignId('loan_application_id')->nullable();
            $table->string('offer_number')->unique();
            $table->decimal('loan_amount', 10, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->integer('tenure_months');
            $table->decimal('monthly_payment', 10, 2);
            $table->decimal('down_payment', 10, 2);
            $table->decimal('processing_fee', 10, 2)->default(0.00);
            $table->decimal('insurance_fee', 10, 2)->default(0.00);
            $table->decimal('total_cost', 10, 2);
            $table->string('status')->default('pending'); // pending, accepted, rejected, expired
            $table->date('valid_until');
            $table->text('terms_conditions')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('lender_financing_offers');
    }
};
