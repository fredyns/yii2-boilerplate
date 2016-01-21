-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 18, 2016 at 11:53 AM
-- Server version: 5.6.27-0ubuntu1
-- PHP Version: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2_old`
--

--
-- Dumping data for table `rgn_province`
--

INSERT INTO `rgn_province` (`id`, `status`, `number`, `name`, `abbreviation`, `country_id`, `created_at`, `updated_at`, `deleted_at`, `createdBy_id`, `updatedBy_id`, `deletedBy_id`) VALUES
(1, 'active', '11', 'Aceh', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'active', '12', 'Sumatera Utara', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'active', '13', 'Sumatera Barat', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'active', '14', 'Riau', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'active', '15', 'Jambi', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'active', '16', 'Sumatera Selatan', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'active', '17', 'Bengkulu', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'active', '18', 'Lampung', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'active', '19', 'Kepulauan Bangka Belitung', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'active', '21', 'Kepulauan Riau', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'active', '31', 'DKI Jakarta', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'active', '32', 'Jawa Barat', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'active', '33', 'Jawa Tengah', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'active', '34', 'DI Yogyakarta', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'active', '35', 'Jawa Timur', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'active', '36', 'Banten', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'active', '51', 'Bali', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'active', '52', 'Nusa Tenggara Barat', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'active', '53', 'Nusa Tenggara Timur', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'active', '61', 'Kalimantan Barat', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'active', '62', 'Kalimantan Tengah', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'active', '63', 'Kalimantan Selatan', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'active', '64', 'Kalimantan Timur', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'active', '65', 'Kalimantan Utara', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'active', '71', 'Sulawesi Utara', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'active', '72', 'Sulawesi Tengah', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'active', '73', 'Sulawesi Selatan', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'active', '74', 'Sulawesi Tenggara', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'active', '75', 'Gorontalo', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'active', '76', 'Sulawesi Barat', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'active', '81', 'Maluku', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'active', '82', 'Maluku Utara', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'active', '91', 'Papua Barat', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'active', '92', 'Papua', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
