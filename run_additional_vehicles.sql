-- Execute Additional Vehicle Data
-- Run this file to add missing vehicle makes and models to your database

-- Execute the additional vehicle makes and models
SOURCE additional_vehicle_data.sql;
SOURCE additional_models_for_existing_makes.sql;
SOURCE african_regional_vehicles.sql;

-- Verify the additions
SELECT 'Total Makes:' as Info, COUNT(*) as Count FROM makes
UNION ALL
SELECT 'Total Models:', COUNT(*) FROM vehicle_models;

-- Show some sample new makes
SELECT 'New Makes Added:' as Info, name as Make_Name FROM makes 
WHERE created_at >= DATE_SUB(NOW(), INTERVAL 1 HOUR)
ORDER BY name
LIMIT 10;
