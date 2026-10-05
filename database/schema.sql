-- =============================================================================
-- Cyber Help India - Initial Database Schema
-- Charset: utf8mb4 (Full Unicode support including emojis)
-- Collation: utf8mb4_unicode_ci
-- =============================================================================

CREATE DATABASE IF NOT EXISTS `cyber_help_db`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `cyber_help_db`;

-- Note: The application does not require database tables to run the homepage.
-- The tables below provide a ready-to-use template for upcoming authentication
-- and content management modules.

-- -----------------------------------------------------------------------------
-- Users Table (Template for future authentication)
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('user', 'admin') DEFAULT 'user',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
