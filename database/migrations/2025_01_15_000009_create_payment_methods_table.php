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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('requires_online')->default(false);
            $table->json('config')->nullable(); // Store payment method specific configuration
            $table->timestamps();
        });

        // Insert default payment methods
        DB::table('payment_methods')->insert([
            [
                'name' => 'Cash',
                'code' => 'CASH',
                'description' => 'Cash payment',
                'icon' => 'fas fa-money-bill',
                'is_active' => true,
                'requires_online' => false,
                'config' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bank Transfer',
                'code' => 'BANK_TRANSFER',
                'description' => 'Direct bank transfer',
                'icon' => 'fas fa-university',
                'is_active' => true,
                'requires_online' => true,
                'config' => json_encode(['requires_account_number' => true]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mobile Money',
                'code' => 'MOBILE_MONEY',
                'description' => 'Mobile money payment (M-Pesa, Tigo Pesa, Airtel Money)',
                'icon' => 'fas fa-mobile-alt',
                'is_active' => true,
                'requires_online' => true,
                'config' => json_encode(['providers' => ['M-Pesa', 'Tigo Pesa', 'Airtel Money']]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Credit Card',
                'code' => 'CREDIT_CARD',
                'description' => 'Credit card payment',
                'icon' => 'fas fa-credit-card',
                'is_active' => true,
                'requires_online' => true,
                'config' => json_encode(['accepted_cards' => ['Visa', 'Mastercard', 'American Express']]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cheque',
                'code' => 'CHEQUE',
                'description' => 'Cheque payment',
                'icon' => 'fas fa-file-invoice',
                'is_active' => true,
                'requires_online' => false,
                'config' => json_encode(['requires_clearing' => true]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bank Draft',
                'code' => 'BANK_DRAFT',
                'description' => 'Bank draft payment',
                'icon' => 'fas fa-file-invoice-dollar',
                'is_active' => true,
                'requires_online' => false,
                'config' => json_encode(['requires_clearing' => true]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Online Payment Gateway',
                'code' => 'ONLINE_GATEWAY',
                'description' => 'Online payment gateway (PayPal, Stripe, etc.)',
                'icon' => 'fas fa-globe',
                'is_active' => true,
                'requires_online' => true,
                'config' => json_encode(['gateways' => ['PayPal', 'Stripe', 'Razorpay']]),
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
        Schema::dropIfExists('payment_methods');
    }
};
