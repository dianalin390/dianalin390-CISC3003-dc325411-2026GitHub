-- A.09: Create Database using phpMyAdmin
CREATE DATABASE IF NOT EXISTS cisc3003_scenarioA;
USE cisc3003_scenarioA;

-- Create submissions table
CREATE TABLE IF NOT EXISTS submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NULL,
    department VARCHAR(100) NULL,
    gender VARCHAR(20) NOT NULL,
    interests VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);