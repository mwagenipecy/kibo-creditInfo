-- Additional Models for Existing Makes
-- This file adds more models for makes that already exist in the database

-- Get existing make IDs
SET @toyota_id = (SELECT id FROM makes WHERE name = 'Toyota');
SET @honda_id = (SELECT id FROM makes WHERE name = 'Honda');
SET @bmw_id = (SELECT id FROM makes WHERE name = 'BMW');
SET @mercedes_id = (SELECT id FROM makes WHERE name = 'Mercedes-Benz');
SET @audi_id = (SELECT id FROM makes WHERE name = 'Audi');
SET @volkswagen_id = (SELECT id FROM makes WHERE name = 'Volkswagen');
SET @ford_id = (SELECT id FROM makes WHERE name = 'Ford');
SET @nissan_id = (SELECT id FROM makes WHERE name = 'Nissan');
SET @hyundai_id = (SELECT id FROM makes WHERE name = 'Hyundai');
SET @kia_id = (SELECT id FROM makes WHERE name = 'Kia');
SET @mazda_id = (SELECT id FROM makes WHERE name = 'Mazda');
SET @subaru_id = (SELECT id FROM makes WHERE name = 'Subaru');
SET @mitsubishi_id = (SELECT id FROM makes WHERE name = 'Mitsubishi');
SET @suzuki_id = (SELECT id FROM makes WHERE name = 'Suzuki');
SET @volvo_id = (SELECT id FROM makes WHERE name = 'Volvo');
SET @jaguar_id = (SELECT id FROM makes WHERE name = 'Jaguar');
SET @land_rover_id = (SELECT id FROM makes WHERE name = 'Land Rover');
SET @porsche_id = (SELECT id FROM makes WHERE name = 'Porsche');
SET @mini_id = (SELECT id FROM makes WHERE name = 'MINI');
SET @smart_id = (SELECT id FROM makes WHERE name = 'Smart');
SET @fiat_id = (SELECT id FROM makes WHERE name = 'Fiat');
SET @alfa_romeo_id = (SELECT id FROM makes WHERE name = 'Alfa Romeo');
SET @opel_id = (SELECT id FROM makes WHERE name = 'Opel');
SET @peugeot_id = (SELECT id FROM makes WHERE name = 'Peugeot');
SET @renault_id = (SELECT id FROM makes WHERE name = 'Renault');
SET @citroen_id = (SELECT id FROM makes WHERE name = 'Citroën');
SET @skoda_id = (SELECT id FROM makes WHERE name = 'Škoda');
SET @seat_id = (SELECT id FROM makes WHERE name = 'Seat');
SET @dacia_id = (SELECT id FROM makes WHERE name = 'Dacia');
SET @chevrolet_id = (SELECT id FROM makes WHERE name = 'Chevrolet');
SET @dodge_id = (SELECT id FROM makes WHERE name = 'Dodge');
SET @chrysler_id = (SELECT id FROM makes WHERE name = 'Chrysler');
SET @jeep_id = (SELECT id FROM makes WHERE name = 'Jeep');
SET @infiniti_id = (SELECT id FROM makes WHERE name = 'Infiniti');
SET @lexus_id = (SELECT id FROM makes WHERE name = 'Lexus');
SET @daewoo_id = (SELECT id FROM makes WHERE name = 'Daewoo');
SET @rover_id = (SELECT id FROM makes WHERE name = 'Rover');
SET @saab_id = (SELECT id FROM makes WHERE name = 'Saab');
SET @hummer_id = (SELECT id FROM makes WHERE name = 'Hummer');

-- Insert additional models for existing makes
INSERT IGNORE INTO vehicle_models (make_id, name, created_at, updated_at) VALUES

-- Toyota Additional Models
(@toyota_id, 'Prius', NOW(), NOW()),
(@toyota_id, 'Prius C', NOW(), NOW()),
(@toyota_id, 'Prius V', NOW(), NOW()),
(@toyota_id, 'Mirai', NOW(), NOW()),
(@toyota_id, 'Avalon', NOW(), NOW()),
(@toyota_id, 'C-HR', NOW(), NOW()),
(@toyota_id, 'Venza', NOW(), NOW()),
(@toyota_id, 'Sequoia', NOW(), NOW()),
(@toyota_id, 'Tundra', NOW(), NOW()),
(@toyota_id, 'Tacoma', NOW(), NOW()),
(@toyota_id, '4Runner', NOW(), NOW()),
(@toyota_id, 'Land Cruiser', NOW(), NOW()),
(@toyota_id, 'Highlander', NOW(), NOW()),
(@toyota_id, 'RAV4', NOW(), NOW()),
(@toyota_id, 'Sienna', NOW(), NOW()),
(@toyota_id, 'Yaris', NOW(), NOW()),
(@toyota_id, 'Yaris iA', NOW(), NOW()),
(@toyota_id, '86', NOW(), NOW()),
(@toyota_id, 'Supra', NOW(), NOW()),

-- Honda Additional Models
(@honda_id, 'Civic Type R', NOW(), NOW()),
(@honda_id, 'Civic Si', NOW(), NOW()),
(@honda_id, 'Insight', NOW(), NOW()),
(@honda_id, 'Clarity', NOW(), NOW()),
(@honda_id, 'Passport', NOW(), NOW()),
(@honda_id, 'Ridgeline', NOW(), NOW()),
(@honda_id, 'Pilot', NOW(), NOW()),
(@honda_id, 'HR-V', NOW(), NOW()),
(@honda_id, 'CR-V', NOW(), NOW()),
(@honda_id, 'Odyssey', NOW(), NOW()),
(@honda_id, 'Fit', NOW(), NOW()),
(@honda_id, 'NSX', NOW(), NOW()),

-- BMW Additional Models
(@bmw_id, 'i3', NOW(), NOW()),
(@bmw_id, 'i8', NOW(), NOW()),
(@bmw_id, 'iX', NOW(), NOW()),
(@bmw_id, 'i4', NOW(), NOW()),
(@bmw_id, 'X1', NOW(), NOW()),
(@bmw_id, 'X2', NOW(), NOW()),
(@bmw_id, 'X3', NOW(), NOW()),
(@bmw_id, 'X4', NOW(), NOW()),
(@bmw_id, 'X5', NOW(), NOW()),
(@bmw_id, 'X6', NOW(), NOW()),
(@bmw_id, 'X7', NOW(), NOW()),
(@bmw_id, 'Z4', NOW(), NOW()),
(@bmw_id, '8 Series', NOW(), NOW()),
(@bmw_id, 'M2', NOW(), NOW()),
(@bmw_id, 'M3', NOW(), NOW()),
(@bmw_id, 'M4', NOW(), NOW()),
(@bmw_id, 'M5', NOW(), NOW()),
(@bmw_id, 'M8', NOW(), NOW()),

-- Mercedes-Benz Additional Models
(@mercedes_id, 'A-Class', NOW(), NOW()),
(@mercedes_id, 'B-Class', NOW(), NOW()),
(@mercedes_id, 'C-Class', NOW(), NOW()),
(@mercedes_id, 'E-Class', NOW(), NOW()),
(@mercedes_id, 'S-Class', NOW(), NOW()),
(@mercedes_id, 'CLA-Class', NOW(), NOW()),
(@mercedes_id, 'CLS-Class', NOW(), NOW()),
(@mercedes_id, 'GLA-Class', NOW(), NOW()),
(@mercedes_id, 'GLB-Class', NOW(), NOW()),
(@mercedes_id, 'GLC-Class', NOW(), NOW()),
(@mercedes_id, 'GLE-Class', NOW(), NOW()),
(@mercedes_id, 'GLS-Class', NOW(), NOW()),
(@mercedes_id, 'G-Class', NOW(), NOW()),
(@mercedes_id, 'SL-Class', NOW(), NOW()),
(@mercedes_id, 'SLC-Class', NOW(), NOW()),
(@mercedes_id, 'AMG GT', NOW(), NOW()),
(@mercedes_id, 'EQC', NOW(), NOW()),
(@mercedes_id, 'EQS', NOW(), NOW()),

-- Audi Additional Models
(@audi_id, 'A1', NOW(), NOW()),
(@audi_id, 'A3', NOW(), NOW()),
(@audi_id, 'A4', NOW(), NOW()),
(@audi_id, 'A5', NOW(), NOW()),
(@audi_id, 'A6', NOW(), NOW()),
(@audi_id, 'A7', NOW(), NOW()),
(@audi_id, 'A8', NOW(), NOW()),
(@audi_id, 'Q2', NOW(), NOW()),
(@audi_id, 'Q3', NOW(), NOW()),
(@audi_id, 'Q4 e-tron', NOW(), NOW()),
(@audi_id, 'Q5', NOW(), NOW()),
(@audi_id, 'Q7', NOW(), NOW()),
(@audi_id, 'Q8', NOW(), NOW()),
(@audi_id, 'TT', NOW(), NOW()),
(@audi_id, 'R8', NOW(), NOW()),
(@audi_id, 'e-tron', NOW(), NOW()),
(@audi_id, 'e-tron GT', NOW(), NOW()),

-- Volkswagen Additional Models
(@volkswagen_id, 'Golf', NOW(), NOW()),
(@volkswagen_id, 'Golf GTI', NOW(), NOW()),
(@volkswagen_id, 'Golf R', NOW(), NOW()),
(@volkswagen_id, 'Jetta', NOW(), NOW()),
(@volkswagen_id, 'Passat', NOW(), NOW()),
(@volkswagen_id, 'Arteon', NOW(), NOW()),
(@volkswagen_id, 'Tiguan', NOW(), NOW()),
(@volkswagen_id, 'Atlas', NOW(), NOW()),
(@volkswagen_id, 'ID.3', NOW(), NOW()),
(@volkswagen_id, 'ID.4', NOW(), NOW()),
(@volkswagen_id, 'ID.Buzz', NOW(), NOW()),
(@volkswagen_id, 'Beetle', NOW(), NOW()),
(@volkswagen_id, 'CC', NOW(), NOW()),

-- Ford Additional Models
(@ford_id, 'Mustang', NOW(), NOW()),
(@ford_id, 'Mustang Mach-E', NOW(), NOW()),
(@ford_id, 'F-150', NOW(), NOW()),
(@ford_id, 'F-250', NOW(), NOW()),
(@ford_id, 'F-350', NOW(), NOW()),
(@ford_id, 'Ranger', NOW(), NOW()),
(@ford_id, 'Explorer', NOW(), NOW()),
(@ford_id, 'Expedition', NOW(), NOW()),
(@ford_id, 'Edge', NOW(), NOW()),
(@ford_id, 'Escape', NOW(), NOW()),
(@ford_id, 'Bronco', NOW(), NOW()),
(@ford_id, 'Bronco Sport', NOW(), NOW()),
(@ford_id, 'EcoSport', NOW(), NOW()),
(@ford_id, 'Transit', NOW(), NOW()),
(@ford_id, 'Transit Connect', NOW(), NOW()),

-- Nissan Additional Models
(@nissan_id, 'Altima', NOW(), NOW()),
(@nissan_id, 'Maxima', NOW(), NOW()),
(@nissan_id, 'Sentra', NOW(), NOW()),
(@nissan_id, 'Versa', NOW(), NOW()),
(@nissan_id, 'Rogue', NOW(), NOW()),
(@nissan_id, 'Murano', NOW(), NOW()),
(@nissan_id, 'Pathfinder', NOW(), NOW()),
(@nissan_id, 'Armada', NOW(), NOW()),
(@nissan_id, 'Frontier', NOW(), NOW()),
(@nissan_id, 'Titan', NOW(), NOW()),
(@nissan_id, '370Z', NOW(), NOW()),
(@nissan_id, 'GT-R', NOW(), NOW()),
(@nissan_id, 'Leaf', NOW(), NOW()),
(@nissan_id, 'Ariya', NOW(), NOW()),

-- Hyundai Additional Models
(@hyundai_id, 'Elantra', NOW(), NOW()),
(@hyundai_id, 'Sonata', NOW(), NOW()),
(@hyundai_id, 'Accent', NOW(), NOW()),
(@hyundai_id, 'Veloster', NOW(), NOW()),
(@hyundai_id, 'Tucson', NOW(), NOW()),
(@hyundai_id, 'Santa Fe', NOW(), NOW()),
(@hyundai_id, 'Palisade', NOW(), NOW()),
(@hyundai_id, 'Kona', NOW(), NOW()),
(@hyundai_id, 'Venue', NOW(), NOW()),
(@hyundai_id, 'Nexo', NOW(), NOW()),
(@hyundai_id, 'Ioniq', NOW(), NOW()),
(@hyundai_id, 'Ioniq 5', NOW(), NOW()),

-- Kia Additional Models
(@kia_id, 'Forte', NOW(), NOW()),
(@kia_id, 'Optima', NOW(), NOW()),
(@kia_id, 'Rio', NOW(), NOW()),
(@kia_id, 'Stinger', NOW(), NOW()),
(@kia_id, 'Sportage', NOW(), NOW()),
(@kia_id, 'Sorento', NOW(), NOW()),
(@kia_id, 'Telluride', NOW(), NOW()),
(@kia_id, 'Seltos', NOW(), NOW()),
(@kia_id, 'Soul', NOW(), NOW()),
(@kia_id, 'Niro', NOW(), NOW()),
(@kia_id, 'EV6', NOW(), NOW()),

-- Mazda Additional Models
(@mazda_id, 'Mazda2', NOW(), NOW()),
(@mazda_id, 'Mazda3', NOW(), NOW()),
(@mazda_id, 'Mazda6', NOW(), NOW()),
(@mazda_id, 'CX-3', NOW(), NOW()),
(@mazda_id, 'CX-5', NOW(), NOW()),
(@mazda_id, 'CX-9', NOW(), NOW()),
(@mazda_id, 'CX-30', NOW(), NOW()),
(@mazda_id, 'MX-5 Miata', NOW(), NOW()),
(@mazda_id, 'MX-30', NOW(), NOW()),

-- Subaru Additional Models
(@subaru_id, 'Impreza', NOW(), NOW()),
(@subaru_id, 'Legacy', NOW(), NOW()),
(@subaru_id, 'Outback', NOW(), NOW()),
(@subaru_id, 'Forester', NOW(), NOW()),
(@subaru_id, 'Crosstrek', NOW(), NOW()),
(@subaru_id, 'Ascent', NOW(), NOW()),
(@subaru_id, 'WRX', NOW(), NOW()),
(@subaru_id, 'BRZ', NOW(), NOW()),

-- Mitsubishi Additional Models
(@mitsubishi_id, 'Mirage', NOW(), NOW()),
(@mitsubishi_id, 'Lancer', NOW(), NOW()),
(@mitsubishi_id, 'Outlander', NOW(), NOW()),
(@mitsubishi_id, 'Outlander Sport', NOW(), NOW()),
(@mitsubishi_id, 'Eclipse Cross', NOW(), NOW()),
(@mitsubishi_id, 'i-MiEV', NOW(), NOW()),

-- Suzuki Additional Models
(@suzuki_id, 'Swift', NOW(), NOW()),
(@suzuki_id, 'Baleno', NOW(), NOW()),
(@suzuki_id, 'Celerio', NOW(), NOW()),
(@suzuki_id, 'Ignis', NOW(), NOW()),
(@suzuki_id, 'Vitara', NOW(), NOW()),
(@suzuki_id, 'S-Cross', NOW(), NOW()),
(@suzuki_id, 'Jimny', NOW(), NOW()),

-- Volvo Additional Models
(@volvo_id, 'S60', NOW(), NOW()),
(@volvo_id, 'S90', NOW(), NOW()),
(@volvo_id, 'V60', NOW(), NOW()),
(@volvo_id, 'V90', NOW(), NOW()),
(@volvo_id, 'XC40', NOW(), NOW()),
(@volvo_id, 'XC60', NOW(), NOW()),
(@volvo_id, 'XC90', NOW(), NOW()),
(@volvo_id, 'C30', NOW(), NOW()),
(@volvo_id, 'C70', NOW(), NOW()),

-- Jaguar Additional Models
(@jaguar_id, 'XE', NOW(), NOW()),
(@jaguar_id, 'XF', NOW(), NOW()),
(@jaguar_id, 'XJ', NOW(), NOW()),
(@jaguar_id, 'F-PACE', NOW(), NOW()),
(@jaguar_id, 'E-PACE', NOW(), NOW()),
(@jaguar_id, 'I-PACE', NOW(), NOW()),
(@jaguar_id, 'F-TYPE', NOW(), NOW()),

-- Land Rover Additional Models
(@land_rover_id, 'Defender', NOW(), NOW()),
(@land_rover_id, 'Discovery', NOW(), NOW()),
(@land_rover_id, 'Discovery Sport', NOW(), NOW()),
(@land_rover_id, 'Range Rover', NOW(), NOW()),
(@land_rover_id, 'Range Rover Evoque', NOW(), NOW()),
(@land_rover_id, 'Range Rover Sport', NOW(), NOW()),
(@land_rover_id, 'Range Rover Velar', NOW(), NOW()),

-- Porsche Additional Models
(@porsche_id, '911', NOW(), NOW()),
(@porsche_id, 'Boxster', NOW(), NOW()),
(@porsche_id, 'Cayman', NOW(), NOW()),
(@porsche_id, 'Panamera', NOW(), NOW()),
(@porsche_id, 'Macan', NOW(), NOW()),
(@porsche_id, 'Cayenne', NOW(), NOW()),
(@porsche_id, 'Taycan', NOW(), NOW()),

-- MINI Additional Models
(@mini_id, 'Cooper', NOW(), NOW()),
(@mini_id, 'Cooper S', NOW(), NOW()),
(@mini_id, 'Cooper SE', NOW(), NOW()),
(@mini_id, 'Countryman', NOW(), NOW()),
(@mini_id, 'Clubman', NOW(), NOW()),
(@mini_id, 'Convertible', NOW(), NOW()),

-- Smart Additional Models
(@smart_id, 'Fortwo', NOW(), NOW()),
(@smart_id, 'Forfour', NOW(), NOW()),
(@smart_id, 'EQ Fortwo', NOW(), NOW()),
(@smart_id, 'EQ Forfour', NOW(), NOW()),

-- Fiat Additional Models
(@fiat_id, '500', NOW(), NOW()),
(@fiat_id, '500L', NOW(), NOW()),
(@fiat_id, '500X', NOW(), NOW()),
(@fiat_id, 'Panda', NOW(), NOW()),
(@fiat_id, 'Tipo', NOW(), NOW()),
(@fiat_id, 'Doblo', NOW(), NOW()),

-- Alfa Romeo Additional Models
(@alfa_romeo_id, 'Giulia', NOW(), NOW()),
(@alfa_romeo_id, 'Stelvio', NOW(), NOW()),
(@alfa_romeo_id, '4C', NOW(), NOW()),
(@alfa_romeo_id, 'Tonale', NOW(), NOW()),

-- Opel Additional Models
(@opel_id, 'Corsa', NOW(), NOW()),
(@opel_id, 'Astra', NOW(), NOW()),
(@opel_id, 'Insignia', NOW(), NOW()),
(@opel_id, 'Crossland', NOW(), NOW()),
(@opel_id, 'Grandland', NOW(), NOW()),
(@opel_id, 'Mokka', NOW(), NOW()),

-- Peugeot Additional Models
(@peugeot_id, '208', NOW(), NOW()),
(@peugeot_id, '308', NOW(), NOW()),
(@peugeot_id, '508', NOW(), NOW()),
(@peugeot_id, '2008', NOW(), NOW()),
(@peugeot_id, '3008', NOW(), NOW()),
(@peugeot_id, '5008', NOW(), NOW()),
(@peugeot_id, 'Partner', NOW(), NOW()),
(@peugeot_id, 'Expert', NOW(), NOW()),

-- Renault Additional Models
(@renault_id, 'Clio', NOW(), NOW()),
(@renault_id, 'Megane', NOW(), NOW()),
(@renault_id, 'Talisman', NOW(), NOW()),
(@renault_id, 'Captur', NOW(), NOW()),
(@renault_id, 'Kadjar', NOW(), NOW()),
(@renault_id, 'Koleos', NOW(), NOW()),
(@renault_id, 'Kangoo', NOW(), NOW()),
(@renault_id, 'Master', NOW(), NOW()),
(@renault_id, 'Zoe', NOW(), NOW()),

-- Citroën Additional Models
(@citroen_id, 'C1', NOW(), NOW()),
(@citroen_id, 'C3', NOW(), NOW()),
(@citroen_id, 'C4', NOW(), NOW()),
(@citroen_id, 'C5', NOW(), NOW()),
(@citroen_id, 'C3 Aircross', NOW(), NOW()),
(@citroen_id, 'C4 Cactus', NOW(), NOW()),
(@citroen_id, 'C5 Aircross', NOW(), NOW()),
(@citroen_id, 'Berlingo', NOW(), NOW()),
(@citroen_id, 'Jumper', NOW(), NOW()),

-- Škoda Additional Models
(@skoda_id, 'Fabia', NOW(), NOW()),
(@skoda_id, 'Rapid', NOW(), NOW()),
(@skoda_id, 'Octavia', NOW(), NOW()),
(@skoda_id, 'Superb', NOW(), NOW()),
(@skoda_id, 'Kamiq', NOW(), NOW()),
(@skoda_id, 'Karoq', NOW(), NOW()),
(@skoda_id, 'Kodiaq', NOW(), NOW()),
(@skoda_id, 'Citigo', NOW(), NOW()),

-- Seat Additional Models
(@seat_id, 'Mii', NOW(), NOW()),
(@seat_id, 'Ibiza', NOW(), NOW()),
(@seat_id, 'Leon', NOW(), NOW()),
(@seat_id, 'Toledo', NOW(), NOW()),
(@seat_id, 'Arona', NOW(), NOW()),
(@seat_id, 'Ateca', NOW(), NOW()),
(@seat_id, 'Tarraco', NOW(), NOW()),

-- Dacia Additional Models
(@dacia_id, 'Sandero', NOW(), NOW()),
(@dacia_id, 'Logan', NOW(), NOW()),
(@dacia_id, 'Duster', NOW(), NOW()),
(@dacia_id, 'Lodgy', NOW(), NOW()),
(@dacia_id, 'Dokker', NOW(), NOW()),

-- Chevrolet Additional Models
(@chevrolet_id, 'Camaro', NOW(), NOW()),
(@chevrolet_id, 'Corvette', NOW(), NOW()),
(@chevrolet_id, 'Malibu', NOW(), NOW()),
(@chevrolet_id, 'Cruze', NOW(), NOW()),
(@chevrolet_id, 'Sonic', NOW(), NOW()),
(@chevrolet_id, 'Spark', NOW(), NOW()),
(@chevrolet_id, 'Equinox', NOW(), NOW()),
(@chevrolet_id, 'Traverse', NOW(), NOW()),
(@chevrolet_id, 'Tahoe', NOW(), NOW()),
(@chevrolet_id, 'Suburban', NOW(), NOW()),
(@chevrolet_id, 'Silverado', NOW(), NOW()),
(@chevrolet_id, 'Colorado', NOW(), NOW()),
(@chevrolet_id, 'Bolt', NOW(), NOW()),

-- Dodge Additional Models
(@dodge_id, 'Challenger', NOW(), NOW()),
(@dodge_id, 'Charger', NOW(), NOW()),
(@dodge_id, 'Durango', NOW(), NOW()),
(@dodge_id, 'Journey', NOW(), NOW()),
(@dodge_id, 'Grand Caravan', NOW(), NOW()),
(@dodge_id, 'Ram 1500', NOW(), NOW()),
(@dodge_id, 'Ram 2500', NOW(), NOW()),
(@dodge_id, 'Ram 3500', NOW(), NOW()),

-- Chrysler Additional Models
(@chrysler_id, '300', NOW(), NOW()),
(@chrysler_id, 'Pacifica', NOW(), NOW()),
(@chrysler_id, 'Voyager', NOW(), NOW()),

-- Jeep Additional Models
(@jeep_id, 'Wrangler', NOW(), NOW()),
(@jeep_id, 'Grand Cherokee', NOW(), NOW()),
(@jeep_id, 'Cherokee', NOW(), NOW()),
(@jeep_id, 'Compass', NOW(), NOW()),
(@jeep_id, 'Renegade', NOW(), NOW()),
(@jeep_id, 'Gladiator', NOW(), NOW()),

-- Infiniti Additional Models
(@infiniti_id, 'Q50', NOW(), NOW()),
(@infiniti_id, 'Q60', NOW(), NOW()),
(@infiniti_id, 'Q70', NOW(), NOW()),
(@infiniti_id, 'QX30', NOW(), NOW()),
(@infiniti_id, 'QX50', NOW(), NOW()),
(@infiniti_id, 'QX60', NOW(), NOW()),
(@infiniti_id, 'QX80', NOW(), NOW()),

-- Lexus Additional Models
(@lexus_id, 'IS', NOW(), NOW()),
(@lexus_id, 'ES', NOW(), NOW()),
(@lexus_id, 'GS', NOW(), NOW()),
(@lexus_id, 'LS', NOW(), NOW()),
(@lexus_id, 'CT', NOW(), NOW()),
(@lexus_id, 'UX', NOW(), NOW()),
(@lexus_id, 'NX', NOW(), NOW()),
(@lexus_id, 'RX', NOW(), NOW()),
(@lexus_id, 'GX', NOW(), NOW()),
(@lexus_id, 'LX', NOW(), NOW()),
(@lexus_id, 'LC', NOW(), NOW()),
(@lexus_id, 'RC', NOW(), NOW()),

-- Daewoo Additional Models
(@daewoo_id, 'Matiz', NOW(), NOW()),
(@daewoo_id, 'Lanos', NOW(), NOW()),
(@daewoo_id, 'Nubira', NOW(), NOW()),
(@daewoo_id, 'Leganza', NOW(), NOW()),
(@daewoo_id, 'Tacuma', NOW(), NOW()),
(@daewoo_id, 'Rezzo', NOW(), NOW()),

-- Rover Additional Models
(@rover_id, '25', NOW(), NOW()),
(@rover_id, '45', NOW(), NOW()),
(@rover_id, '75', NOW(), NOW()),
(@rover_id, 'Streetwise', NOW(), NOW()),

-- Saab Additional Models
(@saab_id, '9-3', NOW(), NOW()),
(@saab_id, '9-5', NOW(), NOW()),
(@saab_id, '9-7X', NOW(), NOW()),

-- Hummer Additional Models
(@hummer_id, 'H1', NOW(), NOW()),
(@hummer_id, 'H2', NOW(), NOW()),
(@hummer_id, 'H3', NOW(), NOW());
