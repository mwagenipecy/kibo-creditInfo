<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('insurance_quote_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            // Customer info
            $table->string('customer_name');
            $table->string('customer_phone', 30);
            $table->string('customer_email')->nullable();
            // Vehicle and quote context
            $table->decimal('insurable_value', 15, 2)->nullable();
            $table->integer('year')->nullable();
            $table->date('start_date')->nullable();
            $table->string('vehicle_class')->nullable();
            $table->string('type_of_cover')->nullable();
            $table->string('claim_status')->nullable();
            $table->integer('no_passengers')->nullable();
            // Calculated totals snapshot
            $table->decimal('total_premium', 15, 2)->nullable();
            $table->json('premium_breakdown')->nullable();
            // Uploaded filled proposal document
            $table->string('document_path')->nullable();
            // Status
            $table->string('status')->default('submitted'); // submitted | in_review | completed | rejected
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('insurance_quote_requests');
    }
};


