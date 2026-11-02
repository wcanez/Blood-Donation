-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 02, 2026 at 06:41 AM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_donation_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`) VALUES
(1, 'admin@example.com', '$2y$10$iJ5esEw9C34VFtrLqyXySeiiFt5je/S534a3WXGUy1pmp3X.SNj4e');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

DROP TABLE IF EXISTS `donors`;
CREATE TABLE IF NOT EXISTS `donors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_group` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donation_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `name`, `address`, `blood_group`, `age`, `phone`, `donation_date`, `created_at`) VALUES
(1, 'Appus', 'Parli', 'O+', 25, '8920384792', '2002-09-29', '2026-10-26 14:27:37'),
(2, 'xyz', 'Kerala', 'B+', 20, '9374892247', '2026-09-14', '2026-10-27 07:11:56'),
(3, 'Abc', 'Kochi', 'A-', 27, '6704469839', '2026-10-06', '2026-11-01 05:16:51'),
(5, 'Akku', 'XYZ', 'B-', 27, '8946730560', '2026-09-28', '2026-11-01 14:08:13'),
(6, 'Jack', 'Nagar', 'AB+', 32, '8039447897', '2026-10-10', '2026-11-01 14:39:39');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
