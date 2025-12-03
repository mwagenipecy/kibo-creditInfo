-- Selcom SMS Logs Table
-- This table records every SMS message sent via Selcom gateway with its status
-- Run this SQL script directly in your database

CREATE TABLE IF NOT EXISTS `selcom_sms_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) NOT NULL COMMENT 'Recipient phone number (format: 255XXXXXXXXX)',
  `message` text NOT NULL COMMENT 'SMS message content',
  `status` enum('success','failed','pending') NOT NULL DEFAULT 'pending' COMMENT 'Status of SMS sending',
  `error_message` text DEFAULT NULL COMMENT 'Error message if status is failed',
  `http_code` int(11) DEFAULT NULL COMMENT 'HTTP response code from API',
  `response_data` json DEFAULT NULL COMMENT 'Full API response data in JSON format',
  `client_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Optional client ID for tracking',
  `campaign_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Optional campaign/report ID for tracking',
  `request_id` varchar(255) DEFAULT NULL COMMENT 'Request ID from Selcom API response if available',
  `sent_at` timestamp NULL DEFAULT NULL COMMENT 'Timestamp when SMS was sent',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Record creation timestamp',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record update timestamp',
  PRIMARY KEY (`id`),
  KEY `idx_selcom_sms_logs_phone` (`phone`),
  KEY `idx_selcom_sms_logs_status` (`status`),
  KEY `idx_selcom_sms_logs_client_id` (`client_id`),
  KEY `idx_selcom_sms_logs_campaign_id` (`campaign_id`),
  KEY `idx_selcom_sms_logs_sent_at` (`sent_at`),
  KEY `idx_selcom_sms_logs_created_at` (`created_at`),
  KEY `idx_selcom_sms_logs_status_created_at` (`status`, `created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Logs for all SMS messages sent via Selcom gateway';

-- Success message
SELECT 'Selcom SMS logs table created successfully!' as message;

