-- Test data for marketplace functionality
-- Run this after the main spare_part_request_system.sql

-- Ensure shops table has status column
ALTER TABLE `shops` ADD COLUMN IF NOT EXISTS `status` enum('active','inactive','suspended') DEFAULT 'active' AFTER `address`;

-- Insert test shop if not exists
INSERT IGNORE INTO `shops` (`id`, `name`, `owner_name`, `phone_number`, `email`, `shop_type`, `latitude`, `longitude`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Test Auto Parts Shop', 'John Doe', '+255123456789', 'shop@example.com', 'spare_parts', -6.8235, 39.2695, 'Dar es Salaam, Tanzania', 'active', NOW(), NOW());

-- Insert test spare parts if not exists
INSERT IGNORE INTO `spare_parts` (`id`, `shop_id`, `spare_category_id`, `spare_brand_id`, `spare_model_id`, `unit`, `price_type`, `price`, `preview_image`, `additional_image_1`, `additional_image_2`, `description`, `stock_quantity`, `minimum_stock`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'Car Battery N70', 'per_unit', 150000.00, NULL, NULL, NULL, 'High quality car battery for various vehicles', 10, 2, 'available', NOW(), NOW()),
(2, 1, 2, 9, 11, 'Michelin Energy Saver Tyre 195/65R15', 'per_unit', 85000.00, NULL, NULL, NULL, 'Fuel efficient tyre with excellent grip', 8, 2, 'available', NOW(), NOW()),
(3, 1, 3, 2, NULL, 'Bosch Oil Filter', 'per_unit', 25000.00, NULL, NULL, NULL, 'Premium oil filter for better engine protection', 15, 3, 'available', NOW(), NOW()),
(4, 1, 4, 2, NULL, 'Bosch Air Filter', 'per_unit', 15000.00, NULL, NULL, NULL, 'High performance air filter', 12, 2, 'available', NOW(), NOW()),
(5, 1, 5, 2, NULL, 'Bosch Brake Pads', 'per_unit', 35000.00, NULL, NULL, NULL, 'Premium brake pads for safety', 20, 5, 'available', NOW(), NOW());

-- Test query to verify data
SELECT 'Test data inserted successfully!' as message;
SELECT COUNT(*) as total_shops FROM shops;
SELECT COUNT(*) as total_spare_parts FROM spare_parts;
SELECT COUNT(*) as total_categories FROM spare_categories;
