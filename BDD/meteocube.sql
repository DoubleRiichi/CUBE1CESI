-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 15, 2024 at 01:09 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meteocube`
--

-- --------------------------------------------------------

--
-- Table structure for table `measures`
--

DROP TABLE IF EXISTS `measures`;
CREATE TABLE IF NOT EXISTS `measures` (
  `id_measures` int NOT NULL AUTO_INCREMENT,
  `temperature` int NOT NULL,
  `humidity` int NOT NULL,
  `pressure` int NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `#id_sensor` int NOT NULL,
  PRIMARY KEY (`id_measures`),
  KEY `sensor` (`#id_sensor`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `measures`
--

INSERT INTO `measures` (`id_measures`, `temperature`, `humidity`, `pressure`, `date`, `time`, `#id_sensor`) VALUES
(1, 32, 15, 100, '2024-02-13', '00:00:00', 2),
(2, 21, 47, 78, '2024-02-02', '00:00:00', 2),
(3, 0, 0, 0, '2021-01-02', '00:00:00', 2),
(4, 60, 100, 52, '2024-02-13', '10:49:55', 2),
(5, 32, 14, 52, '2024-01-04', '10:49:20', 2),
(6, 24, 43, 43, '2024-03-14', '00:00:01', 12),
(7, 24, 43, 43, '2024-03-14', '00:00:01', 12),
(8, 24, 42, 42, '2024-03-14', '00:00:01', 12),
(9, 24, 43, 43, '2024-03-14', '00:00:01', 12),
(10, 24, 42, 42, '2024-03-14', '00:00:01', 12),
(11, 24, 42, 42, '2024-03-14', '00:00:01', 12),
(12, 24, 43, 43, '2024-03-14', '00:00:01', 12),
(13, 24, 43, 43, '2024-03-14', '00:00:01', 12),
(14, 25, 37, 988, '2024-03-14', '00:00:01', 14),
(15, 25, 38, 988, '2024-03-14', '00:00:01', 14),
(16, 24, 36, 988, '2024-03-14', '00:00:01', 14),
(17, 24, 37, 988, '2024-03-14', '00:00:01', 14),
(18, 24, 37, 988, '2024-03-14', '00:00:01', 14),
(19, 24, 36, 988, '2024-03-14', '00:00:01', 14),
(20, 24, 37, 988, '2024-03-14', '00:00:01', 14),
(21, 24, 37, 988, '2024-03-14', '00:00:01', 14),
(22, 23, 45, 992, '2024-03-15', '13:35:34', 1),
(23, 23, 45, 992, '2024-03-15', '13:36:48', 1),
(24, 23, 45, 992, '2024-03-15', '13:38:02', 1),
(25, 23, 44, 992, '2024-03-15', '13:39:16', 1),
(26, 23, 44, 992, '2024-03-15', '13:40:29', 1),
(27, 24, 43, 993, '2024-03-15', '14:05:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

DROP TABLE IF EXISTS `sensor`;
CREATE TABLE IF NOT EXISTS `sensor` (
  `id_sensor` int NOT NULL AUTO_INCREMENT,
  `last_boot_date` date NOT NULL,
  `last_boot_time` time NOT NULL,
  `location` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `measures_count` int NOT NULL,
  PRIMARY KEY (`id_sensor`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sensor`
--

INSERT INTO `sensor` (`id_sensor`, `last_boot_date`, `last_boot_time`, `location`, `measures_count`) VALUES
(1, '2024-02-01', '10:00:00', NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int NOT NULL AUTO_INCREMENT,
  `login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `login`, `email`, `password`, `role`) VALUES
(1, 'Admin', 'admin@meteocube', 'admin', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
