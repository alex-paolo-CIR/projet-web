-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 12 avr. 2024 à 11:57
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
-- Base de données : `jart`
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
  `dateNaissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `compteclient`
--

INSERT INTO `compteclient` (`ID`, `Nom`, `Prenom`, `numTel`, `email`, `password`, `genre`, `dateNaissance`) VALUES
(1, 'Lempereur', 'Théo', '0771084458', 'theo.lempereur@student.junia.com', '1104Theo', 0, '2005-04-11');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `compteclient`
--
ALTER TABLE `compteclient`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `compteclient`
--
ALTER TABLE `compteclient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
