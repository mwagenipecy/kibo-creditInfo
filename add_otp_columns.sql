-- Add OTP columns to users table if they don't exist
-- Run this SQL script to ensure OTP columns are available

-- Check and add 'otp' column if it doesn't exist
ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `otp` VARCHAR(10) NULL COMMENT 'One-time password for verification' AFTER `email_verified_at`;

-- Check and add 'otp_time' column if it doesn't exist  
ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `otp_time` TIMESTAMP NULL COMMENT 'OTP expiration time' AFTER `otp`;

-- Create index on otp for faster lookups
CREATE INDEX IF NOT EXISTS `idx_users_otp` ON `users` (`otp`);

-- Success message
SELECT 'OTP columns added successfully to users table!' as message;

