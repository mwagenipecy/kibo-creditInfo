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
        Schema::create('models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('make_id')->constrained('makes')->onDelete('cascade');
            $table->string('name');
            $table->string('year_range')->nullable(); // e.g., "2010-2020"
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert default vehicle models
        DB::table('models')->insert([
            // Toyota models
            ['make_id' => 1, 'name' => 'Corolla', 'year_range' => '1966-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 1, 'name' => 'Camry', 'year_range' => '1982-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 1, 'name' => 'Hilux', 'year_range' => '1968-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 1, 'name' => 'Land Cruiser', 'year_range' => '1951-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 1, 'name' => 'RAV4', 'year_range' => '1994-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 1, 'name' => 'Prius', 'year_range' => '1997-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 1, 'name' => 'Avalon', 'year_range' => '1994-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Honda models
            ['make_id' => 2, 'name' => 'Civic', 'year_range' => '1972-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 2, 'name' => 'Accord', 'year_range' => '1976-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 2, 'name' => 'CR-V', 'year_range' => '1995-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 2, 'name' => 'Fit', 'year_range' => '2001-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 2, 'name' => 'City', 'year_range' => '1981-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 2, 'name' => 'Pilot', 'year_range' => '2002-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Nissan models
            ['make_id' => 3, 'name' => 'Sentra', 'year_range' => '1982-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 3, 'name' => 'Altima', 'year_range' => '1992-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 3, 'name' => 'Maxima', 'year_range' => '1981-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 3, 'name' => 'X-Trail', 'year_range' => '2000-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 3, 'name' => 'Navara', 'year_range' => '1997-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 3, 'name' => 'Patrol', 'year_range' => '1951-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // BMW models
            ['make_id' => 9, 'name' => '3 Series', 'year_range' => '1975-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 9, 'name' => '5 Series', 'year_range' => '1972-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 9, 'name' => '7 Series', 'year_range' => '1977-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 9, 'name' => 'X3', 'year_range' => '2003-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 9, 'name' => 'X5', 'year_range' => '1999-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Mercedes-Benz models
            ['make_id' => 10, 'name' => 'C-Class', 'year_range' => '1993-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 10, 'name' => 'E-Class', 'year_range' => '1993-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 10, 'name' => 'S-Class', 'year_range' => '1972-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 10, 'name' => 'GLC', 'year_range' => '2015-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => 10, 'name' => 'GLE', 'year_range' => '1997-present', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('models');
    }
};
