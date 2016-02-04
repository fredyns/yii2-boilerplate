# make it compatible with default yii2-user
ALTER TABLE `user` ADD `status` SMALLINT UNSIGNED NOT NULL DEFAULT '10' AFTER `id`;
ALTER TABLE `user` ADD `password_reset_token` VARCHAR(255) NULL DEFAULT NULL AFTER `password_hash`, ADD UNIQUE (`password_reset_token`);
