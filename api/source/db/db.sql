-- #####
-- Create database
-- #####
DROP DATABASE IF EXISTS `sampledb`;
CREATE DATABASE `sampledb`;
USE `sampledb`;

-- #####
-- Create user
-- #####
DROP USER IF EXISTS 'sampleuser'@'localhost';
CREATE USER 'sampleuser'@'localhost' IDENTIFIED BY 'samplepassword';
GRANT DELETE, INSERT, SELECT, UPDATE ON `sampledb`.* TO 'sampleuser'@'localhost';
FLUSH PRIVILEGES;

-- #####
-- Crate tables
-- #####
CREATE TABLE `tbSamples`
(
    `id` INT UNSIGNED AUTO_INCREMENT,
    `createdAt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `description` VARCHAR(50),
    PRIMARY KEY (`id`),
    UNIQUE (`description`)
);