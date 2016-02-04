-- MySQL Workbench Synchronization
-- Generated: 2016-02-04 11:38
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Fredy

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `religion`
DROP COLUMN `status`,
CHANGE COLUMN `name` `name` VARCHAR(64) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL COMMENT 'nama agama' AFTER `deletedBy_id`,
ADD COLUMN `recordStatus` ENUM('used', 'deleted') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT 'used' COMMENT 'status data' AFTER `id`;

ALTER TABLE `rgn_city`
DROP COLUMN `status`,
CHANGE COLUMN `number` `number` VARCHAR(32) NULL DEFAULT NULL COMMENT '' AFTER `deletedBy_id`,
CHANGE COLUMN `name` `name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL COMMENT '' AFTER `number`,
CHANGE COLUMN `abbreviation` `abbreviation` VARCHAR(64) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL COMMENT '' AFTER `name`,
CHANGE COLUMN `province_id` `province_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT '' AFTER `abbreviation`,
ADD COLUMN `recordStatus` ENUM('used', 'deleted') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT 'used' COMMENT 'status data' AFTER `id`;

ALTER TABLE `rgn_country`
DROP COLUMN `status`,
CHANGE COLUMN `name` `name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL COMMENT 'nama negara' AFTER `deletedBy_id`,
CHANGE COLUMN `abbreviation` `abbreviation` VARCHAR(32) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL COMMENT 'nama singkat' AFTER `name`,
ADD COLUMN `recordStatus` ENUM('used', 'deleted') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT 'used' COMMENT 'status data' AFTER `id`;

ALTER TABLE `rgn_district`
DROP COLUMN `status`,
CHANGE COLUMN `number` `number` VARCHAR(32) NULL DEFAULT NULL COMMENT '' AFTER `deletedBy_id`,
CHANGE COLUMN `name` `name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL COMMENT '' AFTER `number`,
CHANGE COLUMN `city_id` `city_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT '' AFTER `name`,
ADD COLUMN `recordStatus` ENUM('used', 'deleted') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT 'used' COMMENT 'status data' AFTER `id`;

ALTER TABLE `rgn_postcode`
CHARACTER SET = utf8mb4 , COLLATE = utf8mb4_unicode_ci ,
DROP COLUMN `status`,
ADD COLUMN `recordStatus` ENUM('used', 'deleted') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT 'used' COMMENT 'status data' AFTER `id`,
CHANGE COLUMN `created_at` `created_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu insert' AFTER `recordStatus`,
CHANGE COLUMN `updated_at` `updated_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu update terakhir' AFTER `created_at`,
CHANGE COLUMN `deleted_at` `deleted_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu dihapus' AFTER `updated_at`,
CHANGE COLUMN `createdBy_id` `createdBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan insert terakhir' AFTER `deleted_at`,
CHANGE COLUMN `updatedBy_id` `updatedBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan update terakhir' AFTER `createdBy_id`,
CHANGE COLUMN `deletedBy_id` `deletedBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan delete' AFTER `updatedBy_id`;

ALTER TABLE `rgn_province`
DROP COLUMN `status`,
ADD COLUMN `recordStatus` ENUM('used', 'deleted') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT 'used' COMMENT 'status data' AFTER `id`;

ALTER TABLE `rgn_subdistrict`
DROP COLUMN `status`,
ADD COLUMN `recordStatus` ENUM('used', 'deleted') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT 'used' COMMENT 'status data' AFTER `id`;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
