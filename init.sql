-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2016 at 11:46 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `livre_d_or`
--

CREATE TABLE `livre_d_or` (
  `id_livre` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `titre_livre` varchar(254) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `livre_d_or`
--

INSERT INTO `livre_d_or` (`id_livre`, `id_utilisateur`, `titre_livre`) VALUES
(3, 3, 'Livre de David'),
(1, 1, 'Livre d''or d''Aurélien'),
(2, 2, 'Livre de Johan'),
(4, 4, 'Livre de Dominique');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `id_livre` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `contenu` varchar(254) DEFAULT NULL,
  `date_message` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id_message`, `id_livre`, `id_utilisateur`, `contenu`, `date_message`) VALUES
(1, 1, 1, 'Bonjour !', '2016-01-21 15:34:21'),
(2, 1, 2, 'Message de Johan', '2016-01-21 17:56:16'),
(3, 1, 1, 'Ceci est un test !', '2016-01-22 19:09:57'),
(7, 2, 2, 'Ceci est un nouveau message !!! :)', '2016-01-22 19:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `login_utilisateur` varchar(254) DEFAULT NULL,
  `mdp_utilisateur` varchar(254) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `login_utilisateur`, `mdp_utilisateur`) VALUES
(2, 'johan', '250cf8b51c773f3f8dc8b4be867a9a02'),
(1, 'aure', '202cb962ac59075b964b07152d234b70'),
(3, 'david', '202cb962ac59075b964b07152d234b70'),
(4, 'dominique', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `livre_d_or`
--
ALTER TABLE `livre_d_or`
  ADD PRIMARY KEY (`id_livre`),
  ADD KEY `FK_possede` (`id_utilisateur`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `FK_ecrit` (`id_utilisateur`),
  ADD KEY `FK_esr_consigne_dans` (`id_livre`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
