-- MySQL Workbench Synchronization
-- Generated: 2016-01-24 20:31
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Fredy

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE TABLE IF NOT EXISTS `yii`.`rgn_city` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `status` ENUM('active','deleted') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT 'active' COMMENT 'status data',
  `number` VARCHAR(32) NULL DEFAULT NULL COMMENT '',
  `name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL COMMENT '',
  `abbreviation` VARCHAR(64) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL COMMENT '',
  `province_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `created_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu insert',
  `updated_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu update terakhir',
  `deleted_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu dihapus',
  `createdBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan insert terakhir',
  `updatedBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan update terakhir',
  `deletedBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan delete',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `index2` (`province_id` ASC)  COMMENT '',
  INDEX `index3` (`abbreviation` ASC)  COMMENT '',
  INDEX `index4` (`number` ASC)  COMMENT '',
  CONSTRAINT `fk_province_city`
    FOREIGN KEY (`province_id`)
    REFERENCES `yii`.`rgn_province` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'kota/kabupaten';

CREATE TABLE IF NOT EXISTS `yii`.`rgn_country` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id entry',
  `status` ENUM('active','deleted') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT 'active' COMMENT 'status data',
  `name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL COMMENT 'nama negara',
  `abbreviation` VARCHAR(32) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL COMMENT 'nama singkat',
  `created_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu insert',
  `updated_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu update terakhir',
  `deleted_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu dihapus',
  `createdBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan insert terakhir',
  `updatedBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan update terakhir',
  `deletedBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan delete',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `index2` (`abbreviation` ASC)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Negara';

CREATE TABLE IF NOT EXISTS `yii`.`rgn_district` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `status` ENUM('active','deleted') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT 'active' COMMENT 'status data',
  `number` VARCHAR(32) NULL DEFAULT NULL COMMENT '',
  `name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL COMMENT '',
  `city_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `created_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu insert',
  `updated_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu update terakhir',
  `deleted_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu dihapus',
  `createdBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan insert terakhir',
  `updatedBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan update terakhir',
  `deletedBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan delete',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `index2` (`city_id` ASC)  COMMENT '',
  INDEX `index3` (`number` ASC)  COMMENT '',
  CONSTRAINT `fk_city_district`
    FOREIGN KEY (`city_id`)
    REFERENCES `yii`.`rgn_city` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'kecamatan';

CREATE TABLE IF NOT EXISTS `yii`.`rgn_postcode` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `status` ENUM('active','deleted') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT 'active' COMMENT 'status data',
  `postcode` INT(10) UNSIGNED NOT NULL COMMENT '',
  `subdistrict_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `district_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `city_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `province_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `country_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `created_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu insert',
  `updated_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu update terakhir',
  `deleted_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu dihapus',
  `createdBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan insert terakhir',
  `updatedBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan update terakhir',
  `deletedBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan delete',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `index2` (`postcode` ASC)  COMMENT '',
  INDEX `index3` (`subdistrict_id` ASC)  COMMENT '',
  INDEX `index4` (`district_id` ASC)  COMMENT '',
  INDEX `index5` (`city_id` ASC)  COMMENT '',
  INDEX `index6` (`province_id` ASC)  COMMENT '',
  INDEX `index7` (`country_id` ASC)  COMMENT '',
  CONSTRAINT `fk_country_postcode`
    FOREIGN KEY (`country_id`)
    REFERENCES `yii`.`rgn_country` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_province_postcode`
    FOREIGN KEY (`province_id`)
    REFERENCES `yii`.`rgn_province` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_city_postcode`
    FOREIGN KEY (`city_id`)
    REFERENCES `yii`.`rgn_city` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_district_postcode`
    FOREIGN KEY (`district_id`)
    REFERENCES `yii`.`rgn_district` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_subdistrict_postcode`
    FOREIGN KEY (`subdistrict_id`)
    REFERENCES `yii`.`rgn_subdistrict` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'kodepos';

CREATE TABLE IF NOT EXISTS `yii`.`rgn_province` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `status` ENUM('active','deleted') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT 'active' COMMENT 'status data',
  `number` VARCHAR(32) NULL DEFAULT NULL COMMENT '',
  `name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL COMMENT '',
  `abbreviation` VARCHAR(32) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL COMMENT '',
  `country_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `created_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu insert',
  `updated_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu update terakhir',
  `deleted_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu dihapus',
  `createdBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan insert terakhir',
  `updatedBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan update terakhir',
  `deletedBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan delete',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `index2` (`country_id` ASC)  COMMENT '',
  INDEX `index3` (`abbreviation` ASC)  COMMENT '',
  INDEX `index4` (`number` ASC)  COMMENT '',
  CONSTRAINT `fk_country_province`
    FOREIGN KEY (`country_id`)
    REFERENCES `yii`.`rgn_country` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'provinsi';

CREATE TABLE IF NOT EXISTS `yii`.`rgn_subdistrict` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `status` ENUM('active','deleted') CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT 'active' COMMENT 'status data',
  `number` VARCHAR(32) NULL DEFAULT NULL COMMENT '',
  `name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL COMMENT '',
  `district_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `created_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu insert',
  `updated_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu update terakhir',
  `deleted_at` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'waktu dihapus',
  `createdBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan insert terakhir',
  `updatedBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan update terakhir',
  `deletedBy_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'id user yg melakukan delete',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `index2` (`district_id` ASC)  COMMENT '',
  INDEX `index3` (`number` ASC)  COMMENT '',
  CONSTRAINT `fk_district_subdistrict`
    FOREIGN KEY (`district_id`)
    REFERENCES `yii`.`rgn_district` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'kelurahan';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
