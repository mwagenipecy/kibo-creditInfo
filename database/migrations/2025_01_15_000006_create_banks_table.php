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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('swift_code')->nullable();
            $table->string('country')->default('Tanzania');
            $table->string('currency')->default('TZS');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert default banks
        DB::table('banks')->insert([
            ['name' => 'CRDB Bank', 'code' => 'CRDB', 'swift_code' => 'CRDBTZTZ', 'country' => 'Tanzania', 'currency' => 'TZS', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'NMB Bank', 'code' => 'NMB', 'swift_code' => 'NMBTTZTZ', 'country' => 'Tanzania', 'currency' => 'TZS', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Equity Bank', 'code' => 'EQUITY', 'swift_code' => 'EQBLTZTZ', 'country' => 'Tanzania', 'currency' => 'TZS', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Exim Bank', 'code' => 'EXIM', 'swift_code' => 'EXIMTZTZ', 'country' => 'Tanzania', 'currency' => 'TZS', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Stanbic Bank', 'code' => 'STANBIC', 'swift_code' => 'SBICTZTZ', 'country' => 'Tanzania', 'currency' => 'TZS', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'KCB Bank', 'code' => 'KCB', 'swift_code' => 'KCBLTZTZ', 'country' => 'Tanzania', 'currency' => 'TZS', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'I&M Bank', 'code' => 'IMB', 'swift_code' => 'IMBLTZTZ', 'country' => 'Tanzania', 'currency' => 'TZS', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ABSA Bank', 'code' => 'ABSA', 'swift_code' => 'ABSAFZTZ', 'country' => 'Tanzania', 'currency' => 'TZS', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Diamond Trust Bank', 'code' => 'DTB', 'swift_code' => 'DTBLTZTZ', 'country' => 'Tanzania', 'currency' => 'TZS', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bank of Africa', 'code' => 'BOA', 'swift_code' => 'BOAFTZTZ', 'country' => 'Tanzania', 'currency' => 'TZS', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
    }
};
