-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 14 déc. 2023 à 13:22
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `meteocube`
--
CREATE DATABASE IF NOT EXISTS `meteocube`  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
USE `meteocube`;

-- --------------------------------------------------------

--
-- Structure de la table `relevés`
--

DROP TABLE IF EXISTS `measures`;
CREATE TABLE IF NOT EXISTS `measures` (
  `id_measures` int NOT NULL AUTO_INCREMENT,
  `temperature` int NOT NULL,
  `humidity` int NOT NULL,
  `pressure` int NOT NULL,
  `date` date NOT NULL,
  `#id_sensor` int NOT NULL,
  PRIMARY KEY (`id_measures`)
) ENGINE=MyISAM AUTO_INCREMENT=2  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `relevés`
--

INSERT INTO `measures` (`id_measures`, `temperature`, `humidity`, `pressure`, `date`, `#id_sensor`) VALUES
(1, 10, 5, 2, '0000-00-00', 2);

-- --------------------------------------------------------

--
-- Structure de la table `sonde`
--

DROP TABLE IF EXISTS `sensor`;
CREATE TABLE IF NOT EXISTS `sensor` (
  `id_sensor` int NOT NULL AUTO_INCREMENT,
  `last_boot` datetime NOT NULL,
  `time_powered` datetime NOT NULL,
  `measures_count` int NOT NULL,
  PRIMARY KEY (`id_sensor`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `sonde`
--

INSERT INTO `sensor` (`id_sensor`, `last_boot`, `time_powered`, `measures_count`) VALUES
(2, '2023-12-13 09:28:11', '2023-12-13 09:28:11', 1);


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
