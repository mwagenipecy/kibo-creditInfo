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
        Schema::create('vehicle_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('make_id')->constrained('makes')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });

        // Insert comprehensive vehicle models from around the world
        // Get make IDs dynamically to avoid hardcoded ID issues
        $toyotaId = DB::table('makes')->where('name', 'Toyota')->value('id');
        $hondaId = DB::table('makes')->where('name', 'Honda')->value('id');
        $nissanId = DB::table('makes')->where('name', 'Nissan')->value('id');
        $bmwId = DB::table('makes')->where('name', 'BMW')->value('id');
        $mercedesId = DB::table('makes')->where('name', 'Mercedes-Benz')->value('id');
        $audiId = DB::table('makes')->where('name', 'Audi')->value('id');
        $fordId = DB::table('makes')->where('name', 'Ford')->value('id');
        $teslaId = DB::table('makes')->where('name', 'Tesla')->value('id');
        $hyundaiId = DB::table('makes')->where('name', 'Hyundai')->value('id');
        $kiaId = DB::table('makes')->where('name', 'Kia')->value('id');
        $lexusId = DB::table('makes')->where('name', 'Lexus')->value('id');
        $infinitiId = DB::table('makes')->where('name', 'Infiniti')->value('id');
        $acuraId = DB::table('makes')->where('name', 'Acura')->value('id');
        $isuzuId = DB::table('makes')->where('name', 'Isuzu')->value('id');
        $porscheId = DB::table('makes')->where('name', 'Porsche')->value('id');
        $opelId = DB::table('makes')->where('name', 'Opel')->value('id');
        $smartId = DB::table('makes')->where('name', 'Smart')->value('id');
        $maybachId = DB::table('makes')->where('name', 'Maybach')->value('id');
        $chevroletId = DB::table('makes')->where('name', 'Chevrolet')->value('id');
        $cadillacId = DB::table('makes')->where('name', 'Cadillac')->value('id');
        $genesisId = DB::table('makes')->where('name', 'Genesis')->value('id');
        $peugeotId = DB::table('makes')->where('name', 'Peugeot')->value('id');
        $renaultId = DB::table('makes')->where('name', 'Renault')->value('id');
        $citroenId = DB::table('makes')->where('name', 'Citroën')->value('id');
        $fiatId = DB::table('makes')->where('name', 'Fiat')->value('id');
        $ferrariId = DB::table('makes')->where('name', 'Ferrari')->value('id');
        $lamborghiniId = DB::table('makes')->where('name', 'Lamborghini')->value('id');
        $maseratiId = DB::table('makes')->where('name', 'Maserati')->value('id');
        $alfaRomeoId = DB::table('makes')->where('name', 'Alfa Romeo')->value('id');
        $volvoId = DB::table('makes')->where('name', 'Volvo')->value('id');
        $jaguarId = DB::table('makes')->where('name', 'Jaguar')->value('id');
        $landRoverId = DB::table('makes')->where('name', 'Land Rover')->value('id');
        $rangeRoverId = DB::table('makes')->where('name', 'Range Rover')->value('id');
        $astonMartinId = DB::table('makes')->where('name', 'Aston Martin')->value('id');
        $bentleyId = DB::table('makes')->where('name', 'Bentley')->value('id');
        $rollsRoyceId = DB::table('makes')->where('name', 'Rolls-Royce')->value('id');
        $mclarenId = DB::table('makes')->where('name', 'McLaren')->value('id');
        $miniId = DB::table('makes')->where('name', 'Mini')->value('id');
        $bydId = DB::table('makes')->where('name', 'BYD')->value('id');
        $geelyId = DB::table('makes')->where('name', 'Geely')->value('id');
        $tataId = DB::table('makes')->where('name', 'Tata')->value('id');
        $mahindraId = DB::table('makes')->where('name', 'Mahindra')->value('id');
        $ladaId = DB::table('makes')->where('name', 'Lada')->value('id');
        $skodaId = DB::table('makes')->where('name', 'Škoda')->value('id');
        $daciaId = DB::table('makes')->where('name', 'Dacia')->value('id');
        $seatId = DB::table('makes')->where('name', 'SEAT')->value('id');

        DB::table('vehicle_models')->insert([
            // Toyota models
            ['make_id' => $toyotaId, 'name' => 'Corolla', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'Camry', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'Hilux', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'Land Cruiser', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'RAV4', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'Prius', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'Avalon', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'Yaris', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'Highlander', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => '4Runner', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'Tacoma', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'Tundra', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'Sequoia', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'Sienna', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'C-HR', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'Venza', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'Mirai', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'GR Supra', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'GR86', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $toyotaId, 'name' => 'GR Corolla', 'created_at' => now(), 'updated_at' => now()],
            
            // Honda models
            ['make_id' => $hondaId, 'name' => 'Civic', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hondaId, 'name' => 'Accord', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hondaId, 'name' => 'CR-V', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hondaId, 'name' => 'Fit', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hondaId, 'name' => 'City', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hondaId, 'name' => 'Pilot', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hondaId, 'name' => 'Passport', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hondaId, 'name' => 'Ridgeline', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hondaId, 'name' => 'HR-V', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hondaId, 'name' => 'Insight', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hondaId, 'name' => 'Odyssey', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hondaId, 'name' => 'Element', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hondaId, 'name' => 'S2000', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hondaId, 'name' => 'NSX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hondaId, 'name' => 'Civic Type R', 'created_at' => now(), 'updated_at' => now()],
            
            // Nissan models
            ['make_id' => $nissanId, 'name' => 'Sentra', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => 'Altima', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => 'Maxima', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => 'X-Trail', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => 'Navara', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => 'Patrol', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => 'Rogue', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => 'Murano', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => 'Pathfinder', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => 'Armada', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => 'Titan', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => 'Frontier', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => 'Versa', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => 'Kicks', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => 'Leaf', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => 'Ariya', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => 'GT-R', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => '370Z', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $nissanId, 'name' => '400Z', 'created_at' => now(), 'updated_at' => now()],
            
            // BMW models
            ['make_id' => $bmwId, 'name' => '3 Series', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => '5 Series', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => '7 Series', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => 'X3', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => 'X5', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => 'X1', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => 'X7', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => 'X6', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => 'X4', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => '2 Series', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => '4 Series', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => '6 Series', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => '8 Series', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => 'Z4', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => 'i3', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => 'i4', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => 'iX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => 'M3', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => 'M5', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bmwId, 'name' => 'M8', 'created_at' => now(), 'updated_at' => now()],
            
            // Mercedes-Benz models (ID: 14)
            ['make_id' => $mercedesId, 'name' => 'C-Class', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'E-Class', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'S-Class', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'GLC', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'GLE', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'A-Class', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'B-Class', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'CLA', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'CLS', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'GLA', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'GLB', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'GLS', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'G-Class', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'SL', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'SLC', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'AMG GT', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'EQS', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'EQA', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'EQB', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mercedesId, 'name' => 'EQC', 'created_at' => now(), 'updated_at' => now()],
            
            // Audi models (ID: 15)
            ['make_id' => $audiId, 'name' => 'A3', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $audiId, 'name' => 'A4', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $audiId, 'name' => 'A6', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $audiId, 'name' => 'A8', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $audiId, 'name' => 'Q3', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $audiId, 'name' => 'Q5', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $audiId, 'name' => 'Q7', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $audiId, 'name' => 'Q8', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $audiId, 'name' => 'TT', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $audiId, 'name' => 'R8', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $audiId, 'name' => 'e-tron', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $audiId, 'name' => 'e-tron GT', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $audiId, 'name' => 'RS3', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $audiId, 'name' => 'RS4', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $audiId, 'name' => 'RS6', 'created_at' => now(), 'updated_at' => now()],
            
            // Ford models (ID: 21)
            ['make_id' => $fordId, 'name' => 'F-150', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fordId, 'name' => 'Mustang', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fordId, 'name' => 'Explorer', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fordId, 'name' => 'Escape', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fordId, 'name' => 'Edge', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fordId, 'name' => 'Expedition', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fordId, 'name' => 'Focus', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fordId, 'name' => 'Fiesta', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fordId, 'name' => 'Bronco', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fordId, 'name' => 'Ranger', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fordId, 'name' => 'Transit', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fordId, 'name' => 'EcoSport', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fordId, 'name' => 'Fusion', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fordId, 'name' => 'Taurus', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fordId, 'name' => 'GT', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fordId, 'name' => 'Mach-E', 'created_at' => now(), 'updated_at' => now()],
            
            // Tesla models (ID: 31)
            ['make_id' => $teslaId, 'name' => 'Model S', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $teslaId, 'name' => 'Model 3', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $teslaId, 'name' => 'Model X', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $teslaId, 'name' => 'Model Y', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $teslaId, 'name' => 'Roadster', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $teslaId, 'name' => 'Cybertruck', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $teslaId, 'name' => 'Semi', 'created_at' => now(), 'updated_at' => now()],
            
            // Hyundai models (ID: 33)
            ['make_id' => $hyundaiId, 'name' => 'Elantra', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hyundaiId, 'name' => 'Sonata', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hyundaiId, 'name' => 'Tucson', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hyundaiId, 'name' => 'Santa Fe', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hyundaiId, 'name' => 'Palisade', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hyundaiId, 'name' => 'Accent', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hyundaiId, 'name' => 'Veloster', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hyundaiId, 'name' => 'Kona', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hyundaiId, 'name' => 'Venue', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hyundaiId, 'name' => 'Ioniq', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hyundaiId, 'name' => 'Ioniq 5', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hyundaiId, 'name' => 'Ioniq 6', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hyundaiId, 'name' => 'Nexo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hyundaiId, 'name' => 'Genesis', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $hyundaiId, 'name' => 'Equus', 'created_at' => now(), 'updated_at' => now()],
            
            // Kia models (ID: 34)
            ['make_id' => $kiaId, 'name' => 'Forte', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $kiaId, 'name' => 'Optima', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $kiaId, 'name' => 'Sportage', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $kiaId, 'name' => 'Sorento', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $kiaId, 'name' => 'Telluride', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $kiaId, 'name' => 'Rio', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $kiaId, 'name' => 'Soul', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $kiaId, 'name' => 'Niro', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $kiaId, 'name' => 'Stinger', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $kiaId, 'name' => 'EV6', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $kiaId, 'name' => 'EV9', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $kiaId, 'name' => 'Carnival', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $kiaId, 'name' => 'Sedona', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $kiaId, 'name' => 'Cadenza', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $kiaId, 'name' => 'K900', 'created_at' => now(), 'updated_at' => now()],
            
            // Lexus models (ID: 9)
            ['make_id' => $lexusId, 'name' => 'ES', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lexusId, 'name' => 'IS', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lexusId, 'name' => 'GS', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lexusId, 'name' => 'LS', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lexusId, 'name' => 'RX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lexusId, 'name' => 'GX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lexusId, 'name' => 'LX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lexusId, 'name' => 'NX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lexusId, 'name' => 'UX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lexusId, 'name' => 'CT', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lexusId, 'name' => 'RC', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lexusId, 'name' => 'LC', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lexusId, 'name' => 'LFA', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lexusId, 'name' => 'SC', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lexusId, 'name' => 'HS', 'created_at' => now(), 'updated_at' => now()],
            
            // Infiniti models (ID: 10)
            ['make_id' => $infinitiId, 'name' => 'Q50', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $infinitiId, 'name' => 'Q60', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $infinitiId, 'name' => 'Q70', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $infinitiId, 'name' => 'QX50', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $infinitiId, 'name' => 'QX60', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $infinitiId, 'name' => 'QX80', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $infinitiId, 'name' => 'G35', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $infinitiId, 'name' => 'G37', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $infinitiId, 'name' => 'M35', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $infinitiId, 'name' => 'M45', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $infinitiId, 'name' => 'FX35', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $infinitiId, 'name' => 'FX45', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $infinitiId, 'name' => 'EX35', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $infinitiId, 'name' => 'JX35', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $infinitiId, 'name' => 'I30', 'created_at' => now(), 'updated_at' => now()],
            
            // Acura models (ID: 11)
            ['make_id' => $acuraId, 'name' => 'ILX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $acuraId, 'name' => 'TLX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $acuraId, 'name' => 'RLX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $acuraId, 'name' => 'RDX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $acuraId, 'name' => 'MDX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $acuraId, 'name' => 'NSX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $acuraId, 'name' => 'Integra', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $acuraId, 'name' => 'RSX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $acuraId, 'name' => 'TSX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $acuraId, 'name' => 'TL', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $acuraId, 'name' => 'RL', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $acuraId, 'name' => 'CL', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $acuraId, 'name' => 'CSX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $acuraId, 'name' => 'ZDX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $acuraId, 'name' => 'SLX', 'created_at' => now(), 'updated_at' => now()],
            
            // Isuzu models (ID: 12)
            ['make_id' => $isuzuId, 'name' => 'D-Max', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $isuzuId, 'name' => 'MU-X', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $isuzuId, 'name' => 'Trooper', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $isuzuId, 'name' => 'Rodeo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $isuzuId, 'name' => 'Ascender', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $isuzuId, 'name' => 'i-Series', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $isuzuId, 'name' => 'Axiom', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $isuzuId, 'name' => 'VehiCROSS', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $isuzuId, 'name' => 'Amigo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $isuzuId, 'name' => 'Hombre', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $isuzuId, 'name' => 'Impulse', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $isuzuId, 'name' => 'Stylus', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $isuzuId, 'name' => 'I-Mark', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $isuzuId, 'name' => 'Piazza', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $isuzuId, 'name' => 'Gemini', 'created_at' => now(), 'updated_at' => now()],
            
            // Porsche models (ID: 17)
            ['make_id' => $porscheId, 'name' => '911', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $porscheId, 'name' => 'Cayenne', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $porscheId, 'name' => 'Macan', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $porscheId, 'name' => 'Panamera', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $porscheId, 'name' => 'Taycan', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $porscheId, 'name' => 'Boxster', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $porscheId, 'name' => 'Cayman', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $porscheId, 'name' => '718', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $porscheId, 'name' => 'Carrera', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $porscheId, 'name' => 'Turbo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $porscheId, 'name' => 'GT3', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $porscheId, 'name' => 'GT2', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $porscheId, 'name' => 'Spyder', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $porscheId, 'name' => 'Targa', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $porscheId, 'name' => 'Speedster', 'created_at' => now(), 'updated_at' => now()],
            
            // Opel models (ID: 18)
            ['make_id' => $opelId, 'name' => 'Corsa', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $opelId, 'name' => 'Astra', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $opelId, 'name' => 'Insignia', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $opelId, 'name' => 'Mokka', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $opelId, 'name' => 'Crossland', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $opelId, 'name' => 'Grandland', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $opelId, 'name' => 'Combo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $opelId, 'name' => 'Vivaro', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $opelId, 'name' => 'Movano', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $opelId, 'name' => 'Zafira', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $opelId, 'name' => 'Meriva', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $opelId, 'name' => 'Adam', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $opelId, 'name' => 'Karl', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $opelId, 'name' => 'Vectra', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $opelId, 'name' => 'Omega', 'created_at' => now(), 'updated_at' => now()],
            
            // Smart models (ID: 19)
            ['make_id' => $smartId, 'name' => 'Fortwo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $smartId, 'name' => 'Forfour', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $smartId, 'name' => 'Roadster', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $smartId, 'name' => 'Crossblade', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $smartId, 'name' => 'Brabus', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $smartId, 'name' => 'Electric Drive', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $smartId, 'name' => 'EQ', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $smartId, 'name' => 'Cabrio', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $smartId, 'name' => 'Coupe', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $smartId, 'name' => 'Passion', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $smartId, 'name' => 'Pure', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $smartId, 'name' => 'Pulse', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $smartId, 'name' => 'Prime', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $smartId, 'name' => 'Proxy', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $smartId, 'name' => 'Tridion', 'created_at' => now(), 'updated_at' => now()],
            
            // Maybach models (ID: 20)
            ['make_id' => $maybachId, 'name' => 'S-Class', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maybachId, 'name' => 'GLS', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maybachId, 'name' => '57', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maybachId, 'name' => '62', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maybachId, 'name' => 'Landaulet', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maybachId, 'name' => 'Zeppelin', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maybachId, 'name' => 'Exelero', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maybachId, 'name' => 'Vision 6', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maybachId, 'name' => 'Vision Ultimate Luxury', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maybachId, 'name' => 'Vision Mercedes-Maybach 6', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maybachId, 'name' => 'Vision Mercedes-Maybach Ultimate Luxury', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maybachId, 'name' => 'Concept', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maybachId, 'name' => 'Pullman', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maybachId, 'name' => 'Guard', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maybachId, 'name' => 'Edition 1', 'created_at' => now(), 'updated_at' => now()],
            
            // Chevrolet models (ID: 22)
            ['make_id' => $chevroletId, 'name' => 'Silverado', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Equinox', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Tahoe', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Suburban', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Traverse', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Trax', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Blazer', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Camaro', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Corvette', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Malibu', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Cruze', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Sonic', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Spark', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Impala', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Volt', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Bolt', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Colorado', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Express', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'Avalanche', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $chevroletId, 'name' => 'HHR', 'created_at' => now(), 'updated_at' => now()],
            
            // Cadillac models (ID: 23)
            ['make_id' => $cadillacId, 'name' => 'Escalade', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'XT4', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'XT5', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'XT6', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'CT4', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'CT5', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'CT6', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'ATS', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'CTS', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'XTS', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'SRX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'ELR', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'DTS', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'STS', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'DeVille', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'Seville', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'Eldorado', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'Allante', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'Catera', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $cadillacId, 'name' => 'Brougham', 'created_at' => now(), 'updated_at' => now()],
            
            // Genesis models (ID: 35)
            ['make_id' => $genesisId, 'name' => 'G90', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $genesisId, 'name' => 'G80', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $genesisId, 'name' => 'G70', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $genesisId, 'name' => 'GV80', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $genesisId, 'name' => 'GV70', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $genesisId, 'name' => 'Electrified G80', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $genesisId, 'name' => 'Electrified GV70', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $genesisId, 'name' => 'Coupe', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $genesisId, 'name' => 'Sedan', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $genesisId, 'name' => 'SUV', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $genesisId, 'name' => 'Luxury', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $genesisId, 'name' => 'Sport', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $genesisId, 'name' => 'Ultimate', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $genesisId, 'name' => 'Prestige', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $genesisId, 'name' => 'Signature', 'created_at' => now(), 'updated_at' => now()],
            
            // Peugeot models (ID: 36)
            ['make_id' => $peugeotId, 'name' => '208', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $peugeotId, 'name' => '308', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $peugeotId, 'name' => '508', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $peugeotId, 'name' => '2008', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $peugeotId, 'name' => '3008', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $peugeotId, 'name' => '5008', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $peugeotId, 'name' => 'Partner', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $peugeotId, 'name' => 'Expert', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $peugeotId, 'name' => 'Boxer', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $peugeotId, 'name' => 'Traveller', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $peugeotId, 'name' => 'Rifter', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $peugeotId, 'name' => 'e-208', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $peugeotId, 'name' => 'e-2008', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $peugeotId, 'name' => 'e-308', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $peugeotId, 'name' => 'e-Expert', 'created_at' => now(), 'updated_at' => now()],
            
            // Renault models (ID: 37)
            ['make_id' => $renaultId, 'name' => 'Clio', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $renaultId, 'name' => 'Megane', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $renaultId, 'name' => 'Talisman', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $renaultId, 'name' => 'Captur', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $renaultId, 'name' => 'Kadjar', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $renaultId, 'name' => 'Koleos', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $renaultId, 'name' => 'Kangoo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $renaultId, 'name' => 'Master', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $renaultId, 'name' => 'Trafic', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $renaultId, 'name' => 'Twingo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $renaultId, 'name' => 'Zoe', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $renaultId, 'name' => 'Fluence', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $renaultId, 'name' => 'Laguna', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $renaultId, 'name' => 'Scenic', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $renaultId, 'name' => 'Espace', 'created_at' => now(), 'updated_at' => now()],
            
            // Citroën models (ID: 38)
            ['make_id' => $citroenId, 'name' => 'C1', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $citroenId, 'name' => 'C3', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $citroenId, 'name' => 'C4', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $citroenId, 'name' => 'C5', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $citroenId, 'name' => 'C3 Aircross', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $citroenId, 'name' => 'C4 Cactus', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $citroenId, 'name' => 'C5 Aircross', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $citroenId, 'name' => 'Berlingo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $citroenId, 'name' => 'Jumper', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $citroenId, 'name' => 'Dispatch', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $citroenId, 'name' => 'e-C4', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $citroenId, 'name' => 'e-Berlingo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $citroenId, 'name' => 'e-Dispatch', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $citroenId, 'name' => 'Grand C4 Picasso', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $citroenId, 'name' => 'C4 Picasso', 'created_at' => now(), 'updated_at' => now()],
            
            // Fiat models (ID: 39)
            ['make_id' => $fiatId, 'name' => '500', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fiatId, 'name' => 'Panda', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fiatId, 'name' => 'Punto', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fiatId, 'name' => 'Tipo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fiatId, 'name' => '500X', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fiatId, 'name' => '500L', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fiatId, 'name' => 'Doblo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fiatId, 'name' => 'Ducato', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fiatId, 'name' => 'Talento', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fiatId, 'name' => 'Fullback', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fiatId, 'name' => 'e-500', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fiatId, 'name' => '124 Spider', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fiatId, 'name' => 'Bravo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fiatId, 'name' => 'Linea', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $fiatId, 'name' => 'Sedici', 'created_at' => now(), 'updated_at' => now()],
            
            // Ferrari models (ID: 40)
            ['make_id' => $ferrariId, 'name' => '488', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ferrariId, 'name' => 'F8', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ferrariId, 'name' => 'SF90', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ferrariId, 'name' => 'Roma', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ferrariId, 'name' => 'Portofino', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ferrariId, 'name' => '812', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ferrariId, 'name' => 'LaFerrari', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ferrariId, 'name' => 'Enzo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ferrariId, 'name' => 'F40', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ferrariId, 'name' => 'F50', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ferrariId, 'name' => 'California', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ferrariId, 'name' => '458', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ferrariId, 'name' => '599', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ferrariId, 'name' => '612', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ferrariId, 'name' => 'FF', 'created_at' => now(), 'updated_at' => now()],
            
            // Lamborghini models (ID: 41)
            ['make_id' => $lamborghiniId, 'name' => 'Huracan', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lamborghiniId, 'name' => 'Aventador', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lamborghiniId, 'name' => 'Urus', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lamborghiniId, 'name' => 'Gallardo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lamborghiniId, 'name' => 'Murcielago', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lamborghiniId, 'name' => 'Diablo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lamborghiniId, 'name' => 'Countach', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lamborghiniId, 'name' => 'Miura', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lamborghiniId, 'name' => 'Espada', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lamborghiniId, 'name' => 'Jarama', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lamborghiniId, 'name' => 'Islero', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lamborghiniId, 'name' => '400GT', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lamborghiniId, 'name' => '350GT', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lamborghiniId, 'name' => 'Reventon', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $lamborghiniId, 'name' => 'Sesto Elemento', 'created_at' => now(), 'updated_at' => now()],
            
            // Maserati models (ID: 42)
            ['make_id' => $maseratiId, 'name' => 'Ghibli', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maseratiId, 'name' => 'Quattroporte', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maseratiId, 'name' => 'Levante', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maseratiId, 'name' => 'GranTurismo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maseratiId, 'name' => 'GranCabrio', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maseratiId, 'name' => 'MC20', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maseratiId, 'name' => 'Coupe', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maseratiId, 'name' => 'Spyder', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maseratiId, 'name' => '3200 GT', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maseratiId, 'name' => 'Biturbo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maseratiId, 'name' => 'Shamal', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maseratiId, 'name' => 'Karif', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maseratiId, 'name' => 'Chrysler TC', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maseratiId, 'name' => 'Khamsin', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $maseratiId, 'name' => 'Bora', 'created_at' => now(), 'updated_at' => now()],
            
            // Alfa Romeo models (ID: 43)
            ['make_id' => $alfaRomeoId, 'name' => 'Giulia', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $alfaRomeoId, 'name' => 'Stelvio', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $alfaRomeoId, 'name' => 'Tonale', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $alfaRomeoId, 'name' => '4C', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $alfaRomeoId, 'name' => 'Giulietta', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $alfaRomeoId, 'name' => 'MiTo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $alfaRomeoId, 'name' => '159', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $alfaRomeoId, 'name' => '147', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $alfaRomeoId, 'name' => '156', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $alfaRomeoId, 'name' => '166', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $alfaRomeoId, 'name' => 'Spider', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $alfaRomeoId, 'name' => 'GTV', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $alfaRomeoId, 'name' => 'Brera', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $alfaRomeoId, 'name' => 'GT', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $alfaRomeoId, 'name' => '8C', 'created_at' => now(), 'updated_at' => now()],
            
            // Volvo models (ID: 44)
            ['make_id' => $volvoId, 'name' => 'S60', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $volvoId, 'name' => 'S90', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $volvoId, 'name' => 'V60', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $volvoId, 'name' => 'V90', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $volvoId, 'name' => 'XC40', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $volvoId, 'name' => 'XC60', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $volvoId, 'name' => 'XC90', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $volvoId, 'name' => 'C30', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $volvoId, 'name' => 'C70', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $volvoId, 'name' => 'S40', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $volvoId, 'name' => 'S80', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $volvoId, 'name' => 'V40', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $volvoId, 'name' => 'V70', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $volvoId, 'name' => 'XC70', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $volvoId, 'name' => '240', 'created_at' => now(), 'updated_at' => now()],
            
            // Jaguar models (ID: 45)
            ['make_id' => $jaguarId, 'name' => 'XE', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $jaguarId, 'name' => 'XF', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $jaguarId, 'name' => 'XJ', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $jaguarId, 'name' => 'F-PACE', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $jaguarId, 'name' => 'E-PACE', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $jaguarId, 'name' => 'I-PACE', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $jaguarId, 'name' => 'F-TYPE', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $jaguarId, 'name' => 'XK', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $jaguarId, 'name' => 'S-TYPE', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $jaguarId, 'name' => 'X-TYPE', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $jaguarId, 'name' => 'XJS', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $jaguarId, 'name' => 'XJ6', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $jaguarId, 'name' => 'XJ8', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $jaguarId, 'name' => 'XKR', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $jaguarId, 'name' => 'XFR', 'created_at' => now(), 'updated_at' => now()],
            
            // Land Rover models (ID: 46)
            ['make_id' => $landRoverId, 'name' => 'Defender', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $landRoverId, 'name' => 'Discovery', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $landRoverId, 'name' => 'Discovery Sport', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $landRoverId, 'name' => 'Freelander', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $landRoverId, 'name' => 'Range Rover', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $landRoverId, 'name' => 'Range Rover Evoque', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $landRoverId, 'name' => 'Range Rover Sport', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $landRoverId, 'name' => 'Range Rover Velar', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $landRoverId, 'name' => 'Series I', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $landRoverId, 'name' => 'Series II', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $landRoverId, 'name' => 'Series III', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $landRoverId, 'name' => '90', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $landRoverId, 'name' => '110', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $landRoverId, 'name' => '130', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $landRoverId, 'name' => 'Classic', 'created_at' => now(), 'updated_at' => now()],
            
            // Range Rover models (ID: 47)
            ['make_id' => $rangeRoverId, 'name' => 'Evoque', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rangeRoverId, 'name' => 'Velar', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rangeRoverId, 'name' => 'Sport', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rangeRoverId, 'name' => 'Vogue', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rangeRoverId, 'name' => 'Autobiography', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rangeRoverId, 'name' => 'SVAutobiography', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rangeRoverId, 'name' => 'SVR', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rangeRoverId, 'name' => 'PHEV', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rangeRoverId, 'name' => 'LWB', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rangeRoverId, 'name' => 'Classic', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rangeRoverId, 'name' => 'P38', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rangeRoverId, 'name' => 'L322', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rangeRoverId, 'name' => 'L405', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rangeRoverId, 'name' => 'L460', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rangeRoverId, 'name' => 'Hybrid', 'created_at' => now(), 'updated_at' => now()],
            
            // Aston Martin models (ID: 48)
            ['make_id' => $astonMartinId, 'name' => 'DB11', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $astonMartinId, 'name' => 'Vantage', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $astonMartinId, 'name' => 'DBS', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $astonMartinId, 'name' => 'DBX', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $astonMartinId, 'name' => 'Valhalla', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $astonMartinId, 'name' => 'Valkyrie', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $astonMartinId, 'name' => 'DB9', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $astonMartinId, 'name' => 'V8 Vantage', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $astonMartinId, 'name' => 'V12 Vantage', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $astonMartinId, 'name' => 'Rapide', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $astonMartinId, 'name' => 'Vanquish', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $astonMartinId, 'name' => 'DB7', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $astonMartinId, 'name' => 'Virage', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $astonMartinId, 'name' => 'Cygnet', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $astonMartinId, 'name' => 'One-77', 'created_at' => now(), 'updated_at' => now()],
            
            // Bentley models (ID: 49)
            ['make_id' => $bentleyId, 'name' => 'Continental GT', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bentleyId, 'name' => 'Flying Spur', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bentleyId, 'name' => 'Bentayga', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bentleyId, 'name' => 'Mulsanne', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bentleyId, 'name' => 'Azure', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bentleyId, 'name' => 'Brooklands', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bentleyId, 'name' => 'Arnage', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bentleyId, 'name' => 'Turbo R', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bentleyId, 'name' => 'Continental R', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bentleyId, 'name' => 'Continental T', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bentleyId, 'name' => 'Continental SC', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bentleyId, 'name' => 'Eight', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bentleyId, 'name' => 'Turbo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bentleyId, 'name' => 'T2', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bentleyId, 'name' => 'T1', 'created_at' => now(), 'updated_at' => now()],
            
            // Rolls-Royce models (ID: 50)
            ['make_id' => $rollsRoyceId, 'name' => 'Phantom', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rollsRoyceId, 'name' => 'Ghost', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rollsRoyceId, 'name' => 'Wraith', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rollsRoyceId, 'name' => 'Dawn', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rollsRoyceId, 'name' => 'Cullinan', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rollsRoyceId, 'name' => 'Silver Shadow', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rollsRoyceId, 'name' => 'Silver Spirit', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rollsRoyceId, 'name' => 'Silver Seraph', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rollsRoyceId, 'name' => 'Corniche', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rollsRoyceId, 'name' => 'Silver Cloud', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rollsRoyceId, 'name' => 'Silver Dawn', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rollsRoyceId, 'name' => 'Silver Wraith', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rollsRoyceId, 'name' => 'Silver Ghost', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rollsRoyceId, 'name' => 'Park Ward', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $rollsRoyceId, 'name' => 'Boat Tail', 'created_at' => now(), 'updated_at' => now()],
            
            // McLaren models (ID: 51)
            ['make_id' => $mclarenId, 'name' => '720S', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mclarenId, 'name' => '570S', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mclarenId, 'name' => '600LT', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mclarenId, 'name' => '650S', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mclarenId, 'name' => '675LT', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mclarenId, 'name' => 'P1', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mclarenId, 'name' => 'Senna', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mclarenId, 'name' => 'Artura', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mclarenId, 'name' => 'GT', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mclarenId, 'name' => '540C', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mclarenId, 'name' => '12C', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mclarenId, 'name' => '650S Spider', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mclarenId, 'name' => '675LT Spider', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mclarenId, 'name' => '720S Spider', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mclarenId, 'name' => 'Elva', 'created_at' => now(), 'updated_at' => now()],
            
            // Mini models (ID: 52)
            ['make_id' => $miniId, 'name' => 'Cooper', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $miniId, 'name' => 'Countryman', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $miniId, 'name' => 'Clubman', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $miniId, 'name' => 'Convertible', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $miniId, 'name' => 'Hardtop', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $miniId, 'name' => 'Paceman', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $miniId, 'name' => 'Roadster', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $miniId, 'name' => 'Coupe', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $miniId, 'name' => 'John Cooper Works', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $miniId, 'name' => 'Electric', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $miniId, 'name' => 'SE', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $miniId, 'name' => 'Cooper S', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $miniId, 'name' => 'Cooper SE', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $miniId, 'name' => 'One', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $miniId, 'name' => 'D', 'created_at' => now(), 'updated_at' => now()],
            
            // BYD models (ID: 53)
            ['make_id' => $bydId, 'name' => 'Tang', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bydId, 'name' => 'Song', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bydId, 'name' => 'Qin', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bydId, 'name' => 'Yuan', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bydId, 'name' => 'Han', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bydId, 'name' => 'Dolphin', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bydId, 'name' => 'Seal', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bydId, 'name' => 'Atto 3', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bydId, 'name' => 'e6', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bydId, 'name' => 'F3', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bydId, 'name' => 'G3', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bydId, 'name' => 'L3', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bydId, 'name' => 'S6', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bydId, 'name' => 'S7', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $bydId, 'name' => 'T3', 'created_at' => now(), 'updated_at' => now()],
            
            // Geely models (ID: 54)
            ['make_id' => $geelyId, 'name' => 'Emgrand', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $geelyId, 'name' => 'Vision', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $geelyId, 'name' => 'Atlas', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $geelyId, 'name' => 'Coolray', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $geelyId, 'name' => 'Okavango', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $geelyId, 'name' => 'Tugella', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $geelyId, 'name' => 'Geometry A', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $geelyId, 'name' => 'Geometry C', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $geelyId, 'name' => 'Geometry E', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $geelyId, 'name' => 'Lynk & Co 01', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $geelyId, 'name' => 'Lynk & Co 02', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $geelyId, 'name' => 'Lynk & Co 03', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $geelyId, 'name' => 'Lynk & Co 05', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $geelyId, 'name' => 'Lynk & Co 06', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $geelyId, 'name' => 'Lynk & Co 09', 'created_at' => now(), 'updated_at' => now()],
            
            // Tata models (ID: 55)
            ['make_id' => $tataId, 'name' => 'Nexon', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $tataId, 'name' => 'Harrier', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $tataId, 'name' => 'Safari', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $tataId, 'name' => 'Tiago', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $tataId, 'name' => 'Tigor', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $tataId, 'name' => 'Altroz', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $tataId, 'name' => 'Punch', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $tataId, 'name' => 'Indica', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $tataId, 'name' => 'Indigo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $tataId, 'name' => 'Sumo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $tataId, 'name' => 'Vista', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $tataId, 'name' => 'Manza', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $tataId, 'name' => 'Aria', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $tataId, 'name' => 'Nano', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $tataId, 'name' => 'Zest', 'created_at' => now(), 'updated_at' => now()],
            
            // Mahindra models (ID: 56)
            ['make_id' => $mahindraId, 'name' => 'XUV700', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mahindraId, 'name' => 'XUV300', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mahindraId, 'name' => 'Thar', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mahindraId, 'name' => 'Scorpio', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mahindraId, 'name' => 'Bolero', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mahindraId, 'name' => 'Xylo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mahindraId, 'name' => 'Quanto', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mahindraId, 'name' => 'Verito', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mahindraId, 'name' => 'KUV100', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mahindraId, 'name' => 'TUV300', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mahindraId, 'name' => 'Marazzo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mahindraId, 'name' => 'Alturas G4', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mahindraId, 'name' => 'eKUV100', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mahindraId, 'name' => 'eXUV300', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $mahindraId, 'name' => 'eVerito', 'created_at' => now(), 'updated_at' => now()],
            
            // Lada models (ID: 57)
            ['make_id' => $ladaId, 'name' => 'Vesta', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ladaId, 'name' => 'Granta', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ladaId, 'name' => 'Largus', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ladaId, 'name' => 'XRAY', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ladaId, 'name' => 'Niva', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ladaId, 'name' => 'Kalina', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ladaId, 'name' => 'Priora', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ladaId, 'name' => 'Samara', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ladaId, 'name' => '2107', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ladaId, 'name' => '2106', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ladaId, 'name' => '2105', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ladaId, 'name' => '2104', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ladaId, 'name' => '2103', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ladaId, 'name' => '2102', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $ladaId, 'name' => '2101', 'created_at' => now(), 'updated_at' => now()],
            
            // Škoda models (ID: 58)
            ['make_id' => $skodaId, 'name' => 'Octavia', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $skodaId, 'name' => 'Superb', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $skodaId, 'name' => 'Fabia', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $skodaId, 'name' => 'Kodiaq', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $skodaId, 'name' => 'Karoq', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $skodaId, 'name' => 'Kamiq', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $skodaId, 'name' => 'Scala', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $skodaId, 'name' => 'Enyaq', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $skodaId, 'name' => 'Rapid', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $skodaId, 'name' => 'Yeti', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $skodaId, 'name' => 'Roomster', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $skodaId, 'name' => 'Citigo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $skodaId, 'name' => 'Praktik', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $skodaId, 'name' => 'Felicia', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $skodaId, 'name' => 'Favorit', 'created_at' => now(), 'updated_at' => now()],
            
            // Dacia models (ID: 59)
            ['make_id' => $daciaId, 'name' => 'Duster', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $daciaId, 'name' => 'Sandero', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $daciaId, 'name' => 'Logan', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $daciaId, 'name' => 'Lodgy', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $daciaId, 'name' => 'Dokker', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $daciaId, 'name' => 'Spring', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $daciaId, 'name' => 'Jogger', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $daciaId, 'name' => 'Bigster', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $daciaId, 'name' => 'Manifesto', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $daciaId, 'name' => 'Stepway', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $daciaId, 'name' => 'Pickup', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $daciaId, 'name' => 'MCV', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $daciaId, 'name' => 'Van', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $daciaId, 'name' => '1300', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $daciaId, 'name' => '1310', 'created_at' => now(), 'updated_at' => now()],
            
            // SEAT models (ID: 60)
            ['make_id' => $seatId, 'name' => 'Ibiza', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $seatId, 'name' => 'Leon', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $seatId, 'name' => 'Ateca', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $seatId, 'name' => 'Tarraco', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $seatId, 'name' => 'Arona', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $seatId, 'name' => 'Alhambra', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $seatId, 'name' => 'Toledo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $seatId, 'name' => 'Altea', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $seatId, 'name' => 'Exeo', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $seatId, 'name' => 'Cordoba', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $seatId, 'name' => 'Marbella', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $seatId, 'name' => 'Malaga', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $seatId, 'name' => 'Ronda', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $seatId, 'name' => 'Fura', 'created_at' => now(), 'updated_at' => now()],
            ['make_id' => $seatId, 'name' => 'Mii', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_models');
    }
};
