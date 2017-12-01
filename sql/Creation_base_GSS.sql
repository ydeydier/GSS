-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 02 déc. 2017 à 00:18
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

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `idArticle` int(11) NOT NULL,
  `idStock` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prixCourant` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`idArticle`, `idStock`, `nom`, `prixCourant`) VALUES
(1, 1, 'Crayon bleu', '5.00'),
(2, 1, 'Chapeau rouge 999', '6.00'),
(4, 1, 'chapeau vert', '7.00'),
(5, 1, 'voiture rouge', '8.00'),
(6, 1, 'casquette bleue', '9.00'),
(7, 1, 'clavier', '10.00'),
(8, 1, 'avion', '11.00');

-- --------------------------------------------------------

--
-- Structure de la table `lignesortie`
--

DROP TABLE IF EXISTS `lignesortie`;
CREATE TABLE `lignesortie` (
  `idSortie` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `prixSortie` decimal(10,2) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lignesortie`
--

INSERT INTO `lignesortie` (`idSortie`, `idArticle`, `prixSortie`, `quantite`) VALUES
(2, 1, '5.00', 5),
(8, 1, '2.00', 1),
(9, 1, '5.00', 12),
(10, 1, '5.20', 100),
(11, 1, '5.20', 10),
(12, 1, '5.00', 3),
(13, 1, '10.00', 1),
(14, 1, '5.00', 9),
(15, 1, '5.00', 2),
(16, 1, '5.00', 2),
(17, 1, '5.00', 1),
(18, 1, '5.00', 1),
(19, 1, '5.00', 1),
(20, 1, '10.00', 1),
(7, 2, NULL, 44),
(8, 2, '4.00', 3),
(10, 2, '2.33', 200),
(11, 2, '2.33', 2),
(13, 2, '20.00', 2),
(14, 2, '9999.00', 8),
(15, 2, '9999.00', 3),
(17, 2, '9999.00', 2),
(18, 2, '9999.00', 2),
(19, 2, '9999.00', 2),
(20, 2, '100.00', 2),
(7, 3, NULL, 44),
(9, 3, '2.10', 21),
(10, 3, '9.30', 0),
(2, 4, '996.00', 6),
(8, 4, '996.00', 55),
(11, 4, '5.25', 99),
(13, 4, '30.00', 3),
(14, 4, '996.00', 7),
(16, 4, '996.00', 3),
(17, 4, '996.00', 3),
(18, 4, '996.00', 3),
(19, 4, '996.00', 3),
(20, 4, '1000.00', 3),
(8, 5, '99.00', 66),
(9, 5, '3.10', 30),
(10, 5, '99.00', 1),
(11, 5, '99.00', 3),
(13, 5, NULL, 4),
(14, 5, NULL, 6),
(18, 5, NULL, 4),
(19, 5, NULL, 4),
(20, 5, '10000.00', 4),
(13, 6, NULL, 5),
(20, 6, '100000.00', 5),
(13, 7, NULL, 6),
(20, 7, NULL, 7),
(13, 8, NULL, 7),
(20, 8, NULL, 6),
(11, 10, '9.00', 3);

-- --------------------------------------------------------

--
-- Structure de la table `lignestock`
--

DROP TABLE IF EXISTS `lignestock`;
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
(1, 1, 50, 55),
(1, 2, 60, 999),
(1, 4, 70, NULL),
(1, 5, 80, NULL),
(1, 6, 90, NULL),
(1, 7, 100, NULL),
(1, 8, 110, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sortie`
--

DROP TABLE IF EXISTS `sortie`;
CREATE TABLE `sortie` (
  `idSortie` int(11) NOT NULL,
  `idStock` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `coutTotal` decimal(10,2) NOT NULL,
  `nbreArticles` int(11) NOT NULL,
  `etat` enum('VIRTUELLE','REELLE') NOT NULL,
  `corbeille` enum('O','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sortie`
--

INSERT INTO `sortie` (`idSortie`, `idStock`, `nom`, `coutTotal`, `nbreArticles`, `etat`, `corbeille`) VALUES
(1, 1, 'Conseil municipal n°22', '0.00', 0, 'VIRTUELLE', 'O'),
(2, 1, 'Fï¿½te des mï¿½res', '6001.00', 2, 'VIRTUELLE', 'N'),
(7, 1, '', '0.00', 0, 'REELLE', 'O'),
(8, 1, 'coucou', '0.00', 0, 'REELLE', 'O'),
(9, 1, 'aaaaaaaaa 299', '0.00', 0, 'VIRTUELLE', 'O'),
(10, 1, 'Conseil Municipal du 20 aout 2017', '1085.00', 3, 'VIRTUELLE', 'N'),
(11, 1, 'wwwwwww9', '0.00', 0, 'VIRTUELLE', 'O'),
(12, 1, 'trtre', '15.00', 1, 'VIRTUELLE', 'N'),
(13, 1, 'qqq111', '140.00', 7, 'VIRTUELLE', 'N'),
(14, 1, 'WWWWWW11', '87009.00', 4, 'VIRTUELLE', 'N'),
(15, 1, 'qqq', '30007.00', 0, 'VIRTUELLE', 'O'),
(16, 1, 'tryytyryry', '2998.00', 0, 'VIRTUELLE', 'O'),
(17, 1, 'aazaze', '22991.00', 0, 'VIRTUELLE', 'O'),
(18, 1, 'dqsdsqdsqds', '22991.00', 0, 'VIRTUELLE', 'O'),
(19, 1, 'dqsdsqdsqds', '22991.00', 4, 'VIRTUELLE', 'O'),
(20, 1, 'sss', '543210.00', 7, 'VIRTUELLE', 'N');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
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

DROP TABLE IF EXISTS `utilisateur`;
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
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `sortie`
--
ALTER TABLE `sortie`
  MODIFY `idSortie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
