-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 11 juil. 2018 à 07:28
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `data_beer`
--

-- --------------------------------------------------------

--
-- Structure de la table `beer`
--

DROP TABLE IF EXISTS `beer`;
CREATE TABLE IF NOT EXISTS `beer` (
  `id_BEE` int(11) NOT NULL,
  `name_BEE` varchar(255) DEFAULT NULL,
  `style_BEE` varchar(255) DEFAULT NULL,
  `cat_BEE` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_BEE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_CAT` int(11) NOT NULL,
  `name_CAT` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_CAT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `style`
--

DROP TABLE IF EXISTS `style`;
CREATE TABLE IF NOT EXISTS `style` (
  `id_STY` int(11) NOT NULL,
  `cat_id_STY` int(11) DEFAULT NULL,
  `name_STY` varchar(255) DEFAULT NULL,
  `beer_id_BEE` int(11) NOT NULL,
  PRIMARY KEY (`id_STY`),
  KEY `oui_idx` (`cat_id_STY`),
  KEY `fk_style_beer1_idx` (`beer_id_BEE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `style`
--
ALTER TABLE `style`
  ADD CONSTRAINT `fk_style_beer1` FOREIGN KEY (`beer_id_BEE`) REFERENCES `beer` (`id_BEE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `oui` FOREIGN KEY (`cat_id_STY`) REFERENCES `categories` (`id_CAT`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
