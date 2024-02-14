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
CREATE DATABASE IF NOT EXISTS `meteocube` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `meteocube`;

-- --------------------------------------------------------

--
-- Structure de la table `relevés`
--

DROP TABLE IF EXISTS `relevés`;
CREATE TABLE IF NOT EXISTS `relevés` (
  `id_releves` int NOT NULL AUTO_INCREMENT,
  `Température` int NOT NULL,
  `Humidité` int NOT NULL,
  `Pression` int NOT NULL,
  `Date` date NOT NULL,
  `#id_sonde` int NOT NULL,
  PRIMARY KEY (`id_releves`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `relevés`
--

INSERT INTO `relevés` (`id_releves`, `Température`, `Humidité`, `Pression`, `Date`, `#id_sonde`) VALUES
(1, 10, 5, 2, '0000-00-00', 2);

-- --------------------------------------------------------

--
-- Structure de la table `sonde`
--

DROP TABLE IF EXISTS `sonde`;
CREATE TABLE IF NOT EXISTS `sonde` (
  `id_sonde` int NOT NULL AUTO_INCREMENT,
  `Temps_d_allumage` datetime NOT NULL,
  `Temps_de_mise_en_route` datetime NOT NULL,
  `Nbre_de_releves` int NOT NULL,
  `Date_d_allumage` datetime NOT NULL,
  PRIMARY KEY (`id_sonde`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sonde`
--

INSERT INTO `sonde` (`id_sonde`, `Temps_d_allumage`, `Temps_de_mise_en_route`, `Nbre_de_releves`, `Date_d_allumage`) VALUES
(2, '2023-12-13 09:28:11', '2023-12-13 09:28:11', 1, '2023-12-13 09:28:11');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mot_de_passe` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `login`, `email`, `Mot_de_passe`, `Role`) VALUES
(1, '', 'jK9$%sLpQ!2&cR5*uP8@vT3#mN1^wX6qO7yZ4djK9$%sLpQ!2&cR5*uP8@vT3#mN1^wX6qO7yZ4djK9$%sLpQ!2&cR5*uP8@vT3#', 'jK9$%sLpQ!2&cR5*uP8@vT3#mN1^wX6qO7yZ4ddddddd', 'jK9$%sLpQ!2&cR5*jK9$%sLpQ!2&cR5*uP8@vT3#mN1^wX6qO7yZ4djK9$%sLpQ!2&cR5*uP8@vT3#mN1^wX6qO7yZ4djK9$%sLp'),
(2, 'jK9$%sLpQ!2&cR5*jK9$%sLpQ!2&cR5*uP8@vT3#mN1^wX6qO7', '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
