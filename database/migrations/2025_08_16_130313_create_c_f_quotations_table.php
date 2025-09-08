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
        Schema::create('c_f_quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clearing_forwarding_company_id')->constrained('clearing_forwarding_companies')->onDelete('cascade');
            $table->foreignId('user_id')->nullable();
            $table->string('quotation_number')->unique();
            $table->string('vehicle_make');
            $table->string('vehicle_model');
            $table->string('vehicle_year');
            $table->string('chassis_number');
            $table->string('port_of_origin');
            $table->string('port_of_destination');
            $table->decimal('vehicle_value', 10, 2);
            $table->decimal('clearing_fee', 10, 2);
            $table->decimal('forwarding_fee', 10, 2);
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
        Schema::dropIfExists('c_f_quotations');
    }
};
