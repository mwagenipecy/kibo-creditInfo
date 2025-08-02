<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatementAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statement_analyses', function (Blueprint $table) {
            $table->id();
            $table->string('account_number')->index();
            $table->string('full_name')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->string('special_id')->nullable()->index();
            $table->string('provider')->nullable()->comment('The service provider (e.g., Vodacom, Airtel)');
            $table->date('statement_start_date')->nullable();
            $table->date('statement_end_date')->nullable();
            $table->integer('total_transactions')->nullable();
            $table->decimal('total_turnover', 15, 2)->nullable();
            $table->decimal('wallet_balance', 15, 2)->nullable();
            $table->decimal('affordability_score_high', 15, 2)->nullable();
            $table->decimal('affordability_score_moderate', 15, 2)->nullable();
            $table->decimal('affordability_score_low', 15, 2)->nullable();
            $table->integer('affordability_rank')->nullable();
            $table->json('raw_response')->nullable()->comment('Full JSON response from the API');
            $table->json('analysis_summary')->nullable()->comment('Processed summary of the analysis');
            $table->unsignedBigInteger('user_id')->nullable()->index()->comment('Related user if applicable');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statement_analyses');
    }
}
