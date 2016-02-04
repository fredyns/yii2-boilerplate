-- MySQL Workbench Synchronization
-- Generated: 2016-01-24 20:24
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Fredy

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `yii`.`profile` 
DROP FOREIGN KEY `fk_user_profile`;

ALTER TABLE `yii`.`social_account` 
DROP FOREIGN KEY `fk_user_account`;

ALTER TABLE `yii`.`token` 
DROP FOREIGN KEY `fk_user_token`;

ALTER TABLE `yii`.`profile` 
CHANGE COLUMN `user_id` `user_id` INT(10) UNSIGNED NOT NULL COMMENT '' ;

ALTER TABLE `yii`.`social_account` 
CHANGE COLUMN `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '' ,
CHANGE COLUMN `user_id` `user_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT '' ;

ALTER TABLE `yii`.`token` 
CHANGE COLUMN `user_id` `user_id` INT(10) UNSIGNED NOT NULL COMMENT '' ;

ALTER TABLE `yii`.`user` 
CHANGE COLUMN `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '' ;

ALTER TABLE `yii`.`profile` 
ADD CONSTRAINT `fk_user_profile`
  FOREIGN KEY (`user_id`)
  REFERENCES `yii`.`user` (`id`)
  ON DELETE CASCADE
  ON UPDATE RESTRICT;

ALTER TABLE `yii`.`social_account` 
ADD CONSTRAINT `fk_user_account`
  FOREIGN KEY (`user_id`)
  REFERENCES `yii`.`user` (`id`)
  ON DELETE CASCADE;

ALTER TABLE `yii`.`token` 
ADD CONSTRAINT `fk_user_token`
  FOREIGN KEY (`user_id`)
  REFERENCES `yii`.`user` (`id`)
  ON DELETE CASCADE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
