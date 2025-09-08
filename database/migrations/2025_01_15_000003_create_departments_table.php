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
        Schema::create('departments', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('department_code', 50)->unique();
            $table->string('department_name', 100);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        // Insert default departments data for 6 user types
        DB::table('departments')->insert([
            [
                'id' => 1,
                'department_code' => 'ADMIN',
                'department_name' => 'Administration',
                'description' => 'Administrative department handling general management and operations',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'department_code' => 'LENDER',
                'department_name' => 'Lender',
                'description' => 'Financial institutions and lenders providing vehicle financing',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'department_code' => 'CAR_DEALER',
                'department_name' => 'Car Dealer',
                'description' => 'Vehicle dealerships and car sellers',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'department_code' => 'CLIENT_BORROWER',
                'department_name' => 'Client/Borrower',
                'description' => 'Individual clients and borrowers seeking vehicle financing',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'department_code' => 'SHOP_OWNER',
                'department_name' => 'Shop Owner',
                'description' => 'Spare parts shop owners and automotive parts suppliers',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'department_code' => 'CLEARANCE_FORWARDING',
                'department_name' => 'Clearance and Forwarding Company',
                'description' => 'Companies providing vehicle import/export clearance and forwarding services',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
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
        Schema::dropIfExists('departments');
    }
};
