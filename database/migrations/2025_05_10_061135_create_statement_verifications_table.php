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
        Schema::create('statement_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('loan_application_id')->nullable();
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('statement_period');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_size');
            $table->string('file_type');
            $table->string('status')->default('pending'); // pending, verified, rejected
            $table->text('verification_notes')->nullable();
            $table->json('verification_data')->nullable(); // Store parsed statement data
            $table->decimal('average_balance', 10, 2)->nullable();
            $table->decimal('total_income', 10, 2)->nullable();
            $table->decimal('total_expenses', 10, 2)->nullable();
            $table->foreignId('verified_by')->nullable();
            $table->timestamp('verified_at')->nullable();
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
        Schema::dropIfExists('statement_verifications');
    }
};
