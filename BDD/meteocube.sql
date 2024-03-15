-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 15, 2024 at 12:21 PM
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
  KEY `#id_sensor` (`#id_sensor`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `measures`
--

INSERT INTO `measures` (`id_measures`, `temperature`, `humidity`, `pressure`, `date`, `time`, `#id_sensor`) VALUES
(6, 25, 50, 988, '2024-03-14', '15:45:27', 1),
(13, 25, 50, 988, '2024-01-02', '12:11:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

DROP TABLE IF EXISTS `sensor`;
CREATE TABLE IF NOT EXISTS `sensor` (
  `id_sensor` int NOT NULL AUTO_INCREMENT,
  `last_boot_date` date NOT NULL,
  `last_boot_time` time NOT NULL,
  `location` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `measures_count` int NOT NULL,
  PRIMARY KEY (`id_sensor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `sensor`
--

INSERT INTO `sensor` (`id_sensor`, `last_boot_date`, `last_boot_time`, `location`, `measures_count`) VALUES
(1, '2024-03-14', '15:29:30', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(500) COLLATE utf8mb4_bin NOT NULL,
  `role` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `measures`
--
ALTER TABLE `measures`
  ADD CONSTRAINT `measures_ibfk_1` FOREIGN KEY (`#id_sensor`) REFERENCES `sensor` (`id_sensor`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
