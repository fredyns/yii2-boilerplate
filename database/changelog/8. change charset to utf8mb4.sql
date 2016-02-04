-- MySQL Workbench Synchronization
-- Generated: 2016-02-04 13:52
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Fredy

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `migration`
CHARACTER SET = utf8mb4 , COLLATE = utf8mb4_unicode_ci ;

ALTER TABLE `profile`
CHARACTER SET = utf8mb4 , COLLATE = utf8mb4_unicode_ci ;

ALTER TABLE `religion`
CHARACTER SET = utf8mb4 , COLLATE = utf8mb4_unicode_ci ;

ALTER TABLE `rgn_city`
CHARACTER SET = utf8mb4 , COLLATE = utf8mb4_unicode_ci ,
CHANGE COLUMN `number` `number` VARCHAR(32) NULL DEFAULT NULL COMMENT '' ;

ALTER TABLE `rgn_country`
CHARACTER SET = utf8mb4 , COLLATE = utf8mb4_unicode_ci ;

ALTER TABLE `rgn_district`
CHARACTER SET = utf8mb4 , COLLATE = utf8mb4_unicode_ci ,
CHANGE COLUMN `number` `number` VARCHAR(32) NULL DEFAULT NULL COMMENT '' ;

ALTER TABLE `rgn_province`
CHARACTER SET = utf8mb4 , COLLATE = utf8mb4_unicode_ci ,
CHANGE COLUMN `number` `number` VARCHAR(32) NULL DEFAULT NULL COMMENT '' ;

ALTER TABLE `rgn_subdistrict`
CHARACTER SET = utf8mb4 , COLLATE = utf8mb4_unicode_ci ,
CHANGE COLUMN `number` `number` VARCHAR(32) NULL DEFAULT NULL COMMENT '' ;

ALTER TABLE `social_account`
CHARACTER SET = utf8mb4 , COLLATE = utf8mb4_unicode_ci ;

ALTER TABLE `token`
CHARACTER SET = utf8mb4 , COLLATE = utf8mb4_unicode_ci ;

ALTER TABLE `user`
CHARACTER SET = utf8mb4 , COLLATE = utf8mb4_unicode_ci ,
DROP COLUMN `password_reset_token`,
DROP COLUMN `status`,
DROP INDEX `password_reset_token` ;

ALTER TABLE `yii_session`
CHARACTER SET = utf8mb4 , COLLATE = utf8mb4_unicode_ci ;

ALTER TABLE `profile`
ADD CONSTRAINT `fk_profile_1`
  FOREIGN KEY (`user_id`)
  REFERENCES `user` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
