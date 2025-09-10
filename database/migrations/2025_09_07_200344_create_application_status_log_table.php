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
        Schema::create('application_status_log', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('application_id');
            $table->string('old_status', 50)->nullable();
            $table->string('new_status', 50);
            $table->string('changed_by', 255);
            $table->timestamp('changed_at');
            $table->text('comments')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_status_log');
    }
};
