-- Spare Part Request System Database Tables
-- Run these SQL statements directly in your database

-- 1. Create spare_part_requests table
CREATE TABLE `spare_part_requests` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `make_id` bigint(20) UNSIGNED NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `part_number` varchar(100) DEFAULT NULL,
  `part_size` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `additional_notes` text DEFAULT NULL,
  `status` enum('pending','in_progress','completed','cancelled') NOT NULL DEFAULT 'pending',
  `expires_at` timestamp NULL DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spare_part_requests_make_id_model_id_year_index` (`make_id`,`model_id`,`year`),
  KEY `spare_part_requests_status_index` (`status`),
  KEY `spare_part_requests_expires_at_index` (`expires_at`),
  CONSTRAINT `spare_part_requests_make_id_foreign` FOREIGN KEY (`make_id`) REFERENCES `makes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spare_part_requests_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `vehicle_models` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Create spare_part_quotes table
CREATE TABLE `spare_part_quotes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `spare_part_request_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'TZS',
  `description` text DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `part_number` varchar(255) DEFAULT NULL,
  `quantity_available` int(11) NOT NULL DEFAULT 1,
  `delivery_time_days` int(11) DEFAULT NULL,
  `delivery_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','accepted','rejected','expired') NOT NULL DEFAULT 'pending',
  `expires_at` timestamp NULL DEFAULT NULL,
  `shop_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spare_part_quotes_spare_part_request_id_shop_id_index` (`spare_part_request_id`,`shop_id`),
  KEY `spare_part_quotes_status_index` (`status`),
  KEY `spare_part_quotes_expires_at_index` (`expires_at`),
  CONSTRAINT `spare_part_quotes_spare_part_request_id_foreign` FOREIGN KEY (`spare_part_request_id`) REFERENCES `spare_part_requests` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spare_part_quotes_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Add missing columns to existing spare part tables if they don't exist
-- Check if name column exists in spare_categories table, if not add it
ALTER TABLE `spare_categories` ADD COLUMN IF NOT EXISTS `name` varchar(255) NOT NULL AFTER `id`;

-- Check if name column exists in spare_brands table, if not add it
ALTER TABLE `spare_brands` ADD COLUMN IF NOT EXISTS `name` varchar(255) NOT NULL AFTER `id`;
ALTER TABLE `spare_brands` ADD COLUMN IF NOT EXISTS `spare_category_id` bigint(20) UNSIGNED NOT NULL AFTER `name`;
ALTER TABLE `spare_brands` ADD CONSTRAINT IF NOT EXISTS `spare_brands_spare_category_id_foreign` FOREIGN KEY (`spare_category_id`) REFERENCES `spare_categories` (`id`) ON DELETE CASCADE;

-- Check if name column exists in spare_models table, if not add it
ALTER TABLE `spare_models` ADD COLUMN IF NOT EXISTS `name` varchar(255) NOT NULL AFTER `id`;
ALTER TABLE `spare_models` ADD COLUMN IF NOT EXISTS `spare_brand_id` bigint(20) UNSIGNED NOT NULL AFTER `name`;
ALTER TABLE `spare_models` ADD CONSTRAINT IF NOT EXISTS `spare_models_spare_brand_id_foreign` FOREIGN KEY (`spare_brand_id`) REFERENCES `spare_brands` (`id`) ON DELETE CASCADE;

-- 4. Add missing columns to spare_parts table if they don't exist
ALTER TABLE `spare_parts` ADD COLUMN IF NOT EXISTS `stock_quantity` int(11) DEFAULT 0 AFTER `description`;
ALTER TABLE `spare_parts` ADD COLUMN IF NOT EXISTS `minimum_stock` int(11) DEFAULT 0 AFTER `stock_quantity`;
ALTER TABLE `spare_parts` ADD COLUMN IF NOT EXISTS `status` enum('available','out_of_stock','discontinued') DEFAULT 'available' AFTER `minimum_stock`;

-- 5. Insert sample data for spare categories, brands, and models
INSERT IGNORE INTO `spare_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Battery', NOW(), NOW()),
(2, 'Tyre', NOW(), NOW()),
(3, 'Oil Filter', NOW(), NOW()),
(4, 'Air Filter', NOW(), NOW()),
(5, 'Brake Pads', NOW(), NOW()),
(6, 'Spark Plugs', NOW(), NOW()),
(7, 'Belts', NOW(), NOW()),
(8, 'Hoses', NOW(), NOW());

-- Insert sample brands for Battery category
INSERT IGNORE INTO `spare_brands` (`id`, `name`, `spare_category_id`, `created_at`, `updated_at`) VALUES
(1, 'Exide', 1, NOW(), NOW()),
(2, 'Bosch', 1, NOW(), NOW()),
(3, 'Amaron', 1, NOW(), NOW()),
(4, 'Rocket', 1, NOW(), NOW()),
(5, 'Panasonic', 1, NOW(), NOW()),
(6, 'Solite', 1, NOW(), NOW()),
(7, 'Furukawa', 1, NOW(), NOW()),
(8, 'Delkor', 1, NOW(), NOW());

-- Insert sample brands for Tyre category
INSERT IGNORE INTO `spare_brands` (`id`, `name`, `spare_category_id`, `created_at`, `updated_at`) VALUES
(9, 'Michelin', 2, NOW(), NOW()),
(10, 'Dunlop', 2, NOW(), NOW()),
(11, 'Bridgestone', 2, NOW(), NOW()),
(12, 'Yokohama', 2, NOW(), NOW()),
(13, 'Hankook', 2, NOW(), NOW()),
(14, 'Continental', 2, NOW(), NOW()),
(15, 'Goodyear', 2, NOW(), NOW()),
(16, 'Pirelli', 2, NOW(), NOW());

-- Insert sample models for Battery brands
INSERT IGNORE INTO `spare_models` (`id`, `name`, `spare_brand_id`, `created_at`, `updated_at`) VALUES
(1, 'N70', 1, NOW(), NOW()),
(2, 'N100', 1, NOW(), NOW()),
(3, 'N120', 1, NOW(), NOW()),
(4, '35Ah', 1, NOW(), NOW()),
(5, '55Ah', 1, NOW(), NOW()),
(6, 'S3', 2, NOW(), NOW()),
(7, 'S4', 2, NOW(), NOW()),
(8, 'S5', 2, NOW(), NOW()),
(9, 'SM Mega Power', 2, NOW(), NOW()),
(10, 'Hightec Silver', 2, NOW(), NOW());

-- Insert sample models for Tyre brands
INSERT IGNORE INTO `spare_models` (`id`, `name`, `spare_brand_id`, `created_at`, `updated_at`) VALUES
(11, 'Energy Saver', 9, NOW(), NOW()),
(12, 'Pilot Sport 4', 9, NOW(), NOW()),
(13, 'Primacy 4', 9, NOW(), NOW()),
(14, 'SP Sport LM705', 10, NOW(), NOW()),
(15, 'Grandtrek AT3', 10, NOW(), NOW()),
(16, 'AT20', 10, NOW(), NOW()),
(17, 'SP Touring R1', 10, NOW(), NOW()),
(18, 'Dueler H/T', 11, NOW(), NOW()),
(19, 'Ecopia EP150', 11, NOW(), NOW()),
(20, 'Potenza RE003', 11, NOW(), NOW());

-- 6. Create indexes for better performance
CREATE INDEX IF NOT EXISTS `spare_part_requests_customer_email_index` ON `spare_part_requests` (`customer_email`);
CREATE INDEX IF NOT EXISTS `spare_part_requests_customer_phone_index` ON `spare_part_requests` (`customer_phone`);
CREATE INDEX IF NOT EXISTS `spare_part_quotes_price_index` ON `spare_part_quotes` (`price`);
CREATE INDEX IF NOT EXISTS `spare_part_quotes_created_at_index` ON `spare_part_quotes` (`created_at`);

-- 7. Insert a sample shop if shops table exists but is empty
INSERT IGNORE INTO `shops` (`id`, `name`, `email`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sample Auto Parts Shop', 'shop@example.com', '+255123456789', 'Dar es Salaam, Tanzania', 'active', NOW(), NOW());

-- 8. Insert sample spare parts if spare_parts table exists but is empty
INSERT IGNORE INTO `spare_parts` (`id`, `shop_id`, `spare_category_id`, `spare_brand_id`, `spare_model_id`, `unit`, `price_type`, `price`, `preview_image`, `additional_image_1`, `additional_image_2`, `description`, `stock_quantity`, `minimum_stock`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'Car Battery N70', 'per_unit', 150000.00, 'battery1.jpg', NULL, NULL, 'High quality car battery for various vehicles', 10, 2, 'available', NOW(), NOW()),
(2, 1, 2, 9, 11, 'Michelin Energy Saver Tyre 195/65R15', 'per_unit', 85000.00, 'tyre1.jpg', NULL, NULL, 'Fuel efficient tyre with excellent grip', 8, 2, 'available', NOW(), NOW()),
(3, 1, 3, 2, NULL, 'Bosch Oil Filter', 'per_unit', 25000.00, 'filter1.jpg', NULL, NULL, 'Premium oil filter for better engine protection', 15, 3, 'available', NOW(), NOW());

-- Success message
SELECT 'Spare Part Request System tables created successfully!' as message;
