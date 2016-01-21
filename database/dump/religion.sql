-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 18, 2016 at 11:37 AM
-- Server version: 5.6.27-0ubuntu1
-- PHP Version: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2advanced`
--

--
-- Dumping data for table `religion`
--

INSERT INTO 
	`religion`
	(`id`, `status`, `name`, `created_at`, `updated_at`, `deleted_at`, `createdBy_id`, `updatedBy_id`, `deletedBy_id`) 

VALUES
	(1, 'active', 'Islam', NULL, 1435291646, NULL, 1, 1, NULL),
	(2, 'active', 'Kristen', NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 'active', 'Katolik', NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 'active', 'Hindu', NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 'active', 'Budha', NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 'deleted', 'Kong hu cu', 1447809613, 1449847990, 1449586273, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
