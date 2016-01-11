-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 11 Janvier 2016 à 10:22
-- Version du serveur: 5.1.73
-- Version de PHP: 

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `p1407659`
--

-- --------------------------------------------------------

--
-- Structure de la table `Livre_d_or`
--

DROP TABLE IF EXISTS `Livre_d_or`;
CREATE TABLE IF NOT EXISTS `Livre_d_or` (
  `id_livre` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `titre_livre` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id_livre`),
  KEY `FK_possede` (`id_utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Livre_d_or`
--


-- --------------------------------------------------------

--
-- Structure de la table `Message`
--

DROP TABLE IF EXISTS `Message`;
CREATE TABLE IF NOT EXISTS `Message` (
  `id_message` int(11) NOT NULL,
  `id_livre` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `contenu` varchar(254) DEFAULT NULL,
  `date_message` datetime DEFAULT NULL,
  PRIMARY KEY (`id_message`),
  KEY `FK_ecrit` (`id_utilisateur`),
  KEY `FK_esr_consigne_dans` (`id_livre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Message`
--


-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

DROP TABLE IF EXISTS `Utilisateur`;
CREATE TABLE IF NOT EXISTS `Utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `login_utilisateur` varchar(254) DEFAULT NULL,
  `mdp_utilisateur` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Utilisateur`
--

