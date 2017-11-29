-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 30 nov. 2017 à 00:13
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gss`
--
CREATE DATABASE IF NOT EXISTS `gss` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gss`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `idArticle` int(11) NOT NULL,
  `idStock` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prix` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`idArticle`, `idStock`, `nom`, `prix`) VALUES
(1, 1, 'Crayon bleu', '5.00'),
(2, 1, 'Chapeau rouge 999', '9999.00'),
(4, 1, 'dddd', '996.00'),
(5, 1, 'eer ', NULL),
(6, 1, 'gggg 99', NULL),
(7, 1, 'azerty\'tt99', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `lignesortie`
--

CREATE TABLE `lignesortie` (
  `idSortie` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lignesortie`
--

INSERT INTO `lignesortie` (`idSortie`, `idArticle`, `prix`, `quantite`) VALUES
(8, 1, NULL, 50),
(10, 1, '5.20', 100),
(11, 1, '5.20', 10),
(7, 2, NULL, 44),
(8, 2, NULL, 30),
(10, 2, '2.33', 200),
(11, 2, '2.33', 2),
(7, 3, NULL, 44),
(9, 3, '2.10', 21),
(10, 3, '9.30', 0),
(11, 4, '5.25', 99),
(9, 5, '3.10', 30),
(10, 5, '99.00', 1),
(11, 5, '99.00', 3),
(11, 10, '9.00', 3);

-- --------------------------------------------------------

--
-- Structure de la table `lignestock`
--

CREATE TABLE `lignestock` (
  `idStock` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `quantiteReelle` int(11) DEFAULT NULL,
  `quantiteVirtuelle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lignestock`
--

INSERT INTO `lignestock` (`idStock`, `idArticle`, `quantiteReelle`, `quantiteVirtuelle`) VALUES
(1, 1, 5, 55),
(1, 2, 999, 999),
(1, 4, 99, NULL),
(1, 5, 0, NULL),
(1, 6, 0, NULL),
(1, 7, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sortie`
--

CREATE TABLE `sortie` (
  `idSortie` int(11) NOT NULL,
  `idStock` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `etat` enum('VIRTUEL','REEL') NOT NULL COMMENT '''VIRTUEL'' ou ''REEL'''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sortie`
--

INSERT INTO `sortie` (`idSortie`, `idStock`, `nom`, `etat`) VALUES
(1, 1, 'Conseil municipal n°22', 'VIRTUEL'),
(2, 1, 'Fête des mères', 'REEL'),
(7, 1, '', 'VIRTUEL'),
(8, 1, 'coucou', 'VIRTUEL'),
(9, 1, 'aaaaaaaaa 299', 'VIRTUEL'),
(10, 1, 'Conseil Municipal du 20 aout 2017', 'VIRTUEL'),
(11, 1, 'wwwwwww9', 'VIRTUEL');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `idStock` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`idStock`, `nom`) VALUES
(1, 'Cadeaux MVA'),
(2, 'Alimentation fetes');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `login` varchar(15) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `stocks` varchar(255) NOT NULL COMMENT 'idStock séparés par des virgules. Ex: 1,5'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `login`, `nom`, `prenom`, `stocks`) VALUES
(1, 'ydeydier', 'DEYDIER', 'Yann', '1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`idArticle`);

--
-- Index pour la table `lignesortie`
--
ALTER TABLE `lignesortie`
  ADD PRIMARY KEY (`idArticle`,`idSortie`);

--
-- Index pour la table `lignestock`
--
ALTER TABLE `lignestock`
  ADD PRIMARY KEY (`idStock`,`idArticle`);

--
-- Index pour la table `sortie`
--
ALTER TABLE `sortie`
  ADD PRIMARY KEY (`idSortie`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idStock`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `sortie`
--
ALTER TABLE `sortie`
  MODIFY `idSortie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `idStock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
