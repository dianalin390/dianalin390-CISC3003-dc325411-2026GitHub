-- CISC3003 Final Exam Paper 02 - Scenario C Database
-- Create database if not exists
CREATE DATABASE IF NOT EXISTS cisc3003_final_c CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cisc3003_final_c;

-- Create users table for signup, login, email verification, password reset
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    token VARCHAR(100) DEFAULT NULL,        -- For email verification
    is_verified TINYINT(1) DEFAULT 0,       -- 0 = not verified, 1 = verified
    reset_token VARCHAR(100) DEFAULT NULL,  -- For password reset
    reset_expires DATETIME DEFAULT NULL,    -- Reset token expiry
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- End of SQL