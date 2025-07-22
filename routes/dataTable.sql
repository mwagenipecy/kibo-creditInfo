-- Drop the table if it exists
DROP TABLE IF EXISTS garages;

-- Create the table
CREATE TABLE garages (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    zip_code VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL DEFAULT 'Tanzania',
    latitude DECIMAL(10, 8) NULL,
    longitude DECIMAL(11, 8) NULL,
    phone VARCHAR(255) NOT NULL,
    email VARCHAR(255) NULL,
    website VARCHAR(255) NULL,
    opening_hours VARCHAR(255) NULL,
    services JSON NULL,
    image VARCHAR(255) NULL,
    rating DECIMAL(3, 2) NOT NULL DEFAULT 0,
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    featured BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    deleted_at TIMESTAMP NULL DEFAULT NULL,

    -- Indexes
    INDEX idx_lat_long (latitude, longitude),
    INDEX idx_is_active (is_active),
    INDEX idx_featured (featured),
    INDEX idx_rating (rating),
    INDEX idx_city_state (city, state)
);
