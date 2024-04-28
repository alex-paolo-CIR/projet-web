-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 28 avr. 2024 à 15:17
-- Version du serveur : 5.7.24
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_jart`
--

-- --------------------------------------------------------

--
-- Structure de la table `compteclient`
--

CREATE TABLE `compteclient` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(64) NOT NULL,
  `Prenom` text NOT NULL,
  `numTel` varchar(10) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(24) NOT NULL,
  `genre` int(1) NOT NULL,
  `dateNaissance` date NOT NULL,
  `photoProfil` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `compteclient`
--

INSERT INTO `compteclient` (`ID`, `Nom`, `Prenom`, `numTel`, `email`, `password`, `genre`, `dateNaissance`, `photoProfil`) VALUES
(1, 'admin', 'admin', '0', 'admin@isen.x', 'admin', 0, '2001-01-01', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `date_depart` date NOT NULL,
  `duree` int(11) NOT NULL,
  `nb_voyageurs` int(11) NOT NULL,
  `nb_bagages` int(11) NOT NULL,
  `date_reservation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_reservation` varchar(8) DEFAULT NULL,
  `montant_total` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `compteclient`
--
ALTER TABLE `compteclient`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `compteclient`
--
ALTER TABLE `compteclient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`id`) REFERENCES `compteclient` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
