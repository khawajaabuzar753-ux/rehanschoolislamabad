-- Database setup for Rehan School Management System
-- Database: abuz_abuzar
-- User: abuz_farhan1
-- Password: 1234

USE abuz_abuzar;

-- Table for referral codes
CREATE TABLE IF NOT EXISTS referral_codes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_email VARCHAR(150) NOT NULL,
    referral_code VARCHAR(50) NOT NULL UNIQUE,
    referral_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_referral_code (referral_code),
    INDEX idx_user_email (user_email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table for feedback submissions
CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL,
    feedback_type VARCHAR(50) NOT NULL,
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table for referral tracking
CREATE TABLE IF NOT EXISTS referral_tracking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    referrer_code VARCHAR(50) NOT NULL,
    referred_email VARCHAR(150) NOT NULL,
    status ENUM('pending', 'completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_referrer_code (referrer_code),
    INDEX idx_referred_email (referred_email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


