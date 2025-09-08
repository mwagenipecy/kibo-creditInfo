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
        Schema::create('users', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('id_number')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('phone_number');
            $table->string('region')->nullable();
            $table->string('district')->nullable();
            $table->string('ward')->nullable();
            $table->string('street')->nullable();
            $table->string('education_level')->nullable();
            $table->string('proffession')->nullable();
            $table->string('password');
            $table->string('user_type');
            $table->string('address_duration')->nullable();
            $table->string('address_status')->nullable();
            $table->string('status')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('refresh_token')->nullable();
            $table->string('created_at')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('approved_at')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('rejected_at')->nullable();
            $table->string('rejected_by')->nullable();
            $table->string('disabled_at')->nullable();
            $table->string('disabled_by')->nullable();
            $table->string('company_id')->nullable();
            $table->string('branch_id')->nullable();
            $table->string('role')->nullable();
            $table->string('email_verified')->default('No');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamp('email_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
