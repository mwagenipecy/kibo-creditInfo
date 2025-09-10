<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_policies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('min_length')->default(8);
            $table->integer('max_length')->default(128);
            $table->boolean('require_uppercase')->default(true);
            $table->boolean('require_lowercase')->default(true);
            $table->boolean('require_numbers')->default(true);
            $table->boolean('require_symbols')->default(false);
            $table->integer('max_age_days')->nullable(); // Password expiration in days
            $table->integer('min_age_days')->default(0); // Minimum days before password can be changed
            $table->integer('history_count')->default(0); // Number of previous passwords to remember
            $table->integer('max_attempts')->default(5); // Max failed login attempts
            $table->integer('lockout_duration_minutes')->default(30); // Lockout duration in minutes
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert default password policies
        DB::table('password_policies')->insert([
            [
                'name' => 'Standard Policy',
                'description' => 'Standard password policy for regular users',
                'min_length' => 8,
                'max_length' => 128,
                'require_uppercase' => true,
                'require_lowercase' => true,
                'require_numbers' => true,
                'require_symbols' => false,
                'max_age_days' => 90,
                'min_age_days' => 1,
                'history_count' => 5,
                'max_attempts' => 5,
                'lockout_duration_minutes' => 30,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'High Security Policy',
                'description' => 'High security password policy for admin users',
                'min_length' => 12,
                'max_length' => 128,
                'require_uppercase' => true,
                'require_lowercase' => true,
                'require_numbers' => true,
                'require_symbols' => true,
                'max_age_days' => 60,
                'min_age_days' => 1,
                'history_count' => 10,
                'max_attempts' => 3,
                'lockout_duration_minutes' => 60,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Basic Policy',
                'description' => 'Basic password policy for low-risk users',
                'min_length' => 6,
                'max_length' => 128,
                'require_uppercase' => false,
                'require_lowercase' => true,
                'require_numbers' => true,
                'require_symbols' => false,
                'max_age_days' => 180,
                'min_age_days' => 0,
                'history_count' => 3,
                'max_attempts' => 10,
                'lockout_duration_minutes' => 15,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_policies');
    }
};
