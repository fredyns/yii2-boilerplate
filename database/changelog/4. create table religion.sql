-- MySQL Workbench Synchronization
-- Generated: 2016-01-24 20:30
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Fredy

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE TABLE IF NOT EXISTS `yii`.`religion` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id entry',
  `status` ENUM('active','deleted') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT 'active' COMMENT 'status data',
  `name` VARCHAR(64) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL COMMENT 'nama agama',
  `created_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu insert',
  `updated_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu update terakhir',
  `deleted_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu dihapus',
  `createdBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan insert terakhir',
  `updatedBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan update terakhir',
  `deletedBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan delete',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'master data agama';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
