<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__.'/../autoload.php';

$connection = \App\MysqlPDOConnection::getInstance()->getConnection();

$str = "CREATE TABLE `post` (
          `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
          `title` VARCHAR(255) NOT NULL,
          `body` TEXT(600) NOT NULL,
          `created_at` DATETIME NOT NULL,
          PRIMARY KEY (`id`)
        )
        COLLATE=`utf8_general_ci`
        ENGINE=InnoDB
;";

$str .= "CREATE TABLE `category` (
	      `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	      `name` VARCHAR(255) NOT NULL,
	      `created_at` DATETIME NOT NULL,
	      PRIMARY KEY (`id`)
        )
        COLLATE=`utf8_general_ci`
        ENGINE=InnoDB
;";

$str .= "ALTER TABLE `post`
	ADD COLUMN `category_id` INT UNSIGNED NOT NULL AFTER `created_at`,
	ADD CONSTRAINT `FK_post_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
;";

$connection->exec($str);