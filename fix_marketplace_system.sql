-- Fix Marketplace System - Complete Database Setup
-- Run this SQL script to ensure all tables exist and have proper data

-- 1. Add status column to shops table if not exists
ALTER TABLE shops ADD COLUMN IF NOT EXISTS status VARCHAR(20) DEFAULT 'active';

-- 2. Create spare_part_requests table if not exists
CREATE TABLE IF NOT EXISTS spare_part_requests (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    make_id BIGINT UNSIGNED NOT NULL,
    model_id BIGINT UNSIGNED NOT NULL,
    year INT NOT NULL,
    part_name VARCHAR(255) NOT NULL,
    part_number VARCHAR(100) NULL,
    part_size VARCHAR(100) NULL,
    description TEXT NULL,
    customer_name VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    additional_notes TEXT NULL,
    status VARCHAR(20) DEFAULT 'pending',
    expires_at TIMESTAMP NULL,
    location VARCHAR(255) NULL,
    latitude DECIMAL(10, 8) NULL,
    longitude DECIMAL(11, 8) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_expires_at (expires_at),
    INDEX idx_make_model (make_id, model_id)
);

-- 3. Create spare_part_quotes table if not exists
CREATE TABLE IF NOT EXISTS spare_part_quotes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    request_id BIGINT UNSIGNED NOT NULL,
    shop_id BIGINT UNSIGNED NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    delivery_time VARCHAR(100) NULL,
    delivery_cost DECIMAL(10, 2) DEFAULT 0.00,
    warranty_info TEXT NULL,
    additional_info TEXT NULL,
    status VARCHAR(20) DEFAULT 'pending',
    expires_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (request_id) REFERENCES spare_part_requests(id) ON DELETE CASCADE,
    FOREIGN KEY (shop_id) REFERENCES shops(id) ON DELETE CASCADE,
    INDEX idx_request_status (request_id, status),
    INDEX idx_shop_status (shop_id, status)
);

-- 4. Ensure makes table exists
CREATE TABLE IF NOT EXISTS makes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 5. Ensure vehicle_models table exists
CREATE TABLE IF NOT EXISTS vehicle_models (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    make_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (make_id) REFERENCES makes(id) ON DELETE CASCADE,
    UNIQUE KEY unique_make_model (make_id, name)
);

-- 6. Insert sample makes if not exists
INSERT IGNORE INTO makes (name) VALUES 
('Toyota'),
('Honda'),
('Nissan'),
('Mazda'),
('Subaru'),
('Mitsubishi'),
('Suzuki'),
('Daihatsu'),
('BMW'),
('Mercedes-Benz'),
('Audi'),
('Volkswagen'),
('Ford'),
('Chevrolet'),
('Hyundai'),
('Kia');

-- 7. Insert sample vehicle models if not exists
INSERT IGNORE INTO vehicle_models (make_id, name) VALUES 
(1, 'Corolla'), (1, 'Camry'), (1, 'Hilux'), (1, 'Land Cruiser'), (1, 'RAV4'),
(2, 'Civic'), (2, 'Accord'), (2, 'CR-V'), (2, 'Fit'), (2, 'City'),
(3, 'Sentra'), (3, 'Altima'), (3, 'Maxima'), (3, 'X-Trail'), (3, 'Navara'),
(4, '3'), (4, '6'), (4, 'CX-5'), (4, 'CX-30'), (4, 'MX-5'),
(5, 'Impreza'), (5, 'Forester'), (5, 'Outback'), (5, 'Legacy'), (5, 'XV'),
(6, 'Lancer'), (6, 'Outlander'), (6, 'Pajero'), (6, 'Triton'), (6, 'ASX'),
(7, 'Swift'), (7, 'Vitara'), (7, 'Jimny'), (7, 'Baleno'), (7, 'Ignis'),
(8, 'Terios'), (8, 'Xenia'), (8, 'Ayla'), (8, 'Sigra'), (8, 'Rocky');

-- 8. Insert sample shops if not exists
INSERT IGNORE INTO shops (name, email, phone, address, latitude, longitude, status, created_at, updated_at) VALUES 
('Auto Parts Pro', 'info@autopartspro.com', '+255123456789', 'Dar es Salaam, Tanzania', -6.8235, 39.2695, 'active', NOW(), NOW()),
('Spare Parts Hub', 'contact@sparepartshub.com', '+255123456790', 'Nairobi, Kenya', -1.2921, 36.8219, 'active', NOW(), NOW()),
('Car Parts Express', 'sales@carpartsexpress.com', '+255123456791', 'Kampala, Uganda', 0.3476, 32.5825, 'active', NOW(), NOW()),
('Quality Auto Parts', 'info@qualityautoparts.com', '+255123456792', 'Mombasa, Kenya', -4.0435, 39.6682, 'active', NOW(), NOW()),
('Reliable Spares', 'contact@reliablespares.com', '+255123456793', 'Arusha, Tanzania', -3.3731, 36.6823, 'active', NOW(), NOW());

-- 9. Insert sample spare parts if not exists
INSERT IGNORE INTO spare_parts (shop_id, spare_category_id, unit, price, price_type, preview_image, description, stock_quantity, minimum_stock, status, created_at, updated_at) VALUES 
(1, 1, 'Toyota Corolla Brake Pads', 45000.00, 'fixed', NULL, 'High quality brake pads for Toyota Corolla 2010-2020', 50, 10, 'active', NOW(), NOW()),
(1, 2, 'Honda Civic Oil Filter', 15000.00, 'fixed', NULL, 'Genuine oil filter for Honda Civic', 100, 20, 'active', NOW(), NOW()),
(2, 3, 'Nissan Altima Air Filter', 12000.00, 'fixed', NULL, 'Premium air filter for Nissan Altima', 75, 15, 'active', NOW(), NOW()),
(2, 4, 'Mazda 3 Spark Plugs', 25000.00, 'fixed', NULL, 'Iridium spark plugs for Mazda 3', 60, 12, 'active', NOW(), NOW()),
(3, 5, 'Subaru Forester Timing Belt', 85000.00, 'fixed', NULL, 'Timing belt kit for Subaru Forester', 25, 5, 'active', NOW(), NOW()),
(3, 1, 'BMW 3 Series Brake Discs', 120000.00, 'fixed', NULL, 'Front brake discs for BMW 3 Series', 30, 8, 'active', NOW(), NOW()),
(4, 2, 'Mercedes-Benz Oil Filter', 18000.00, 'fixed', NULL, 'Original oil filter for Mercedes-Benz', 80, 15, 'active', NOW(), NOW()),
(4, 3, 'Audi A4 Air Filter', 14000.00, 'fixed', NULL, 'Performance air filter for Audi A4', 65, 12, 'active', NOW(), NOW()),
(5, 4, 'Volkswagen Golf Spark Plugs', 22000.00, 'fixed', NULL, 'NGK spark plugs for Volkswagen Golf', 70, 14, 'active', NOW(), NOW()),
(5, 5, 'Ford Ranger Timing Belt', 95000.00, 'fixed', NULL, 'Timing belt kit for Ford Ranger', 20, 4, 'active', NOW(), NOW());

-- 10. Update existing shops to have status if they don't have it
UPDATE shops SET status = 'active' WHERE status IS NULL;

-- 11. Ensure spare_categories table has proper data
INSERT IGNORE INTO spare_categories (name, description, created_at, updated_at) VALUES 
('Brake System', 'Brake pads, discs, calipers, and related components', NOW(), NOW()),
('Engine Parts', 'Oil filters, air filters, spark plugs, and engine components', NOW(), NOW()),
('Air & Fuel System', 'Air filters, fuel filters, and fuel system components', NOW(), NOW()),
('Ignition System', 'Spark plugs, ignition coils, and ignition components', NOW(), NOW()),
('Timing System', 'Timing belts, timing chains, and related components', NOW(), NOW()),
('Suspension', 'Shock absorbers, springs, and suspension components', NOW(), NOW()),
('Electrical', 'Batteries, alternators, starters, and electrical components', NOW(), NOW()),
('Body Parts', 'Bumpers, mirrors, lights, and body components', NOW(), NOW());

-- 12. Add spare_brand_id and spare_model_id to spare_parts if not exists
ALTER TABLE spare_parts ADD COLUMN IF NOT EXISTS spare_brand_id BIGINT UNSIGNED NULL;
ALTER TABLE spare_parts ADD COLUMN IF NOT EXISTS spare_model_id BIGINT UNSIGNED NULL;

-- 13. Create spare_brands table if not exists
CREATE TABLE IF NOT EXISTS spare_brands (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    spare_category_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (spare_category_id) REFERENCES spare_categories(id) ON DELETE CASCADE
);

-- 14. Create spare_models table if not exists
CREATE TABLE IF NOT EXISTS spare_models (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    spare_brand_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (spare_brand_id) REFERENCES spare_brands(id) ON DELETE CASCADE
);

-- 15. Insert sample spare brands
INSERT IGNORE INTO spare_brands (spare_category_id, name) VALUES 
(1, 'Brembo'), (1, 'Bosch'), (1, 'NGK'), (1, 'Denso'),
(2, 'Mann'), (2, 'Mahle'), (2, 'Fram'), (2, 'K&N'),
(3, 'K&N'), (3, 'AEM'), (3, 'Injen'), (3, 'HKS'),
(4, 'NGK'), (4, 'Denso'), (4, 'Bosch'), (4, 'Champion'),
(5, 'Gates'), (5, 'Continental'), (5, 'Dayco'), (5, 'Bando');

-- 16. Insert sample spare models
INSERT IGNORE INTO spare_models (spare_brand_id, name) VALUES 
(1, 'Sport'), (1, 'GT'), (1, 'Racing'), (1, 'Street'),
(2, 'Premium'), (2, 'Standard'), (2, 'Performance'), (2, 'Economy'),
(3, 'Performance'), (3, 'Street'), (3, 'Racing'), (3, 'Off-road'),
(4, 'Iridium'), (4, 'Platinum'), (4, 'Copper'), (4, 'Silver'),
(5, 'PowerGrip'), (5, 'Micro-V'), (5, 'Poly Chain'), (5, 'Synchronous');

-- 16. Update spare parts with brand and model IDs
UPDATE spare_parts SET spare_brand_id = 1, spare_model_id = 1 WHERE id = 1;
UPDATE spare_parts SET spare_brand_id = 5, spare_model_id = 5 WHERE id = 2;
UPDATE spare_parts SET spare_brand_id = 9, spare_model_id = 9 WHERE id = 3;
UPDATE spare_parts SET spare_brand_id = 13, spare_model_id = 13 WHERE id = 4;
UPDATE spare_parts SET spare_brand_id = 17, spare_model_id = 17 WHERE id = 5;

-- 17. Add indexes for better performance
CREATE INDEX IF NOT EXISTS idx_spare_parts_shop_status ON spare_parts(shop_id, status);
CREATE INDEX IF NOT EXISTS idx_spare_parts_category ON spare_parts(spare_category_id);
CREATE INDEX IF NOT EXISTS idx_spare_parts_brand ON spare_parts(spare_brand_id);
CREATE INDEX IF NOT EXISTS idx_spare_parts_model ON spare_parts(spare_model_id);

-- 18. Add location columns to shops if not exists
ALTER TABLE shops ADD COLUMN IF NOT EXISTS latitude DECIMAL(10, 8) NULL;
ALTER TABLE shops ADD COLUMN IF NOT EXISTS longitude DECIMAL(11, 8) NULL;

-- 19. Update shop locations with realistic coordinates
UPDATE shops SET 
    latitude = -6.8235, 
    longitude = 39.2695 
WHERE id = 1;

UPDATE shops SET 
    latitude = -1.2921, 
    longitude = 36.8219 
WHERE id = 2;

UPDATE shops SET 
    latitude = 0.3476, 
    longitude = 32.5825 
WHERE id = 3;

UPDATE shops SET 
    latitude = -4.0435, 
    longitude = 39.6682 
WHERE id = 4;

UPDATE shops SET 
    latitude = -3.3731, 
    longitude = 36.6823 
WHERE id = 5;

-- 20. Final verification
SELECT 'Database setup completed successfully!' as status;
SELECT COUNT(*) as total_shops FROM shops WHERE status = 'active';
SELECT COUNT(*) as total_spare_parts FROM spare_parts WHERE status = 'active';
SELECT COUNT(*) as total_makes FROM makes;
SELECT COUNT(*) as total_models FROM vehicle_models;
