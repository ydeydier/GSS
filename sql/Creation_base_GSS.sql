-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 19 déc. 2017 à 22:34
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
-- /*!40101 SET NAMES utf8mb4 */;

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
(1, 1, 'Crayon bleu', '6.00'),
(2, 1, 'Chapeau rouge 999', '9.00'),
(4, 1, 'chapeau vert', '7.00'),
(5, 1, 'voiture rouge', '8.00'),
(6, 1, 'casquette bleue', '9.00'),
(7, 1, 'clavier', '12.00'),
(8, 1, 'avion', '11.00'),
(9, 1, 'voiture', '15.00'),
(10, 1, 'casquette rouge', '10.00'),
(11, 1, 'stylo vert', '6.00'),
(12, 1, 'stylo bleu', '6.00'),
(13, 1, 'stylo violet', '9.00'),
(14, 1, 'stylo jaune', '7.00'),
(15, 1, 'stylo noir', '8.00'),
(16, 1, 'stylo blanc', '3.00'),
(17, 1, 'feutre rouge', '1.00'),
(18, 2, 'Truc 1', '20.00'),
(19, 2, 'Truc 2', '30.00'),
(20, 2, 'Truc 3', '40.00'),
(21, 2, 'Truc 4', '50.00'),
(22, 2, 'Truc 5', '90.00'),
(23, 2, 'Truc 6', '100.00');

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
(20, 1, '10.00', 10),
(21, 1, '5.00', 10),
(22, 1, '5.00', 20),
(24, 1, '6.00', 5),
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
(21, 2, '9.00', 15),
(22, 2, '9.00', 25),
(24, 2, '9.00', 90),
(2, 4, '996.00', 7),
(8, 4, '996.00', 55),
(11, 4, '5.25', 99),
(13, 4, '30.00', 3),
(14, 4, '996.00', 7),
(16, 4, '996.00', 3),
(17, 4, '996.00', 3),
(18, 4, '996.00', 3),
(19, 4, '996.00', 3),
(20, 4, '1000.00', 3),
(24, 4, '7.00', 10),
(8, 5, '99.00', 66),
(9, 5, '3.10', 30),
(10, 5, '99.00', 1),
(11, 5, '99.00', 3),
(13, 5, NULL, 4),
(14, 5, NULL, 6),
(18, 5, NULL, 4),
(19, 5, NULL, 4),
(20, 5, '10000.00', 4),
(24, 5, '8.00', 50),
(13, 6, NULL, 5),
(20, 6, '100000.00', 5),
(13, 7, NULL, 6),
(20, 7, NULL, 7),
(13, 8, NULL, 7),
(20, 8, NULL, 6),
(11, 10, '9.00', 3),
(23, 18, '20.00', 3),
(23, 19, '30.00', 2);

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
(1, 1, 127, 102),
(1, 2, 109, 2),
(1, 4, 120, 107),
(1, 5, 134, 80),
(1, 6, 145, 140),
(1, 7, 157, 150),
(1, 8, 166, 160),
(1, 9, 170, 170),
(1, 10, 180, 180),
(1, 11, 190, 190),
(1, 12, 200, 200),
(1, 13, 210, 210),
(1, 14, 220, 220),
(1, 15, 230, 230),
(1, 16, 240, 240),
(1, 17, 2, 2),
(2, 18, 2, 2),
(2, 19, 8, 8),
(2, 20, 15, 15),
(2, 21, 20, 20),
(2, 22, 30, 30),
(2, 23, 40, 40);

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
(2, 1, 'FÃªte des mÃ¨res', '6997.00', 2, 'REELLE', 'N'),
(7, 1, '', '0.00', 0, 'REELLE', 'O'),
(8, 1, 'coucou', '0.00', 0, 'REELLE', 'O'),
(9, 1, 'aaaaaaaaa 299', '0.00', 0, 'VIRTUELLE', 'O'),
(10, 1, 'Conseil Municipal du 20 aout 2017', '1085.00', 3, 'REELLE', 'N'),
(11, 1, 'wwwwwww9', '0.00', 0, 'VIRTUELLE', 'O'),
(12, 1, 'trtre', '15.00', 1, 'REELLE', 'N'),
(13, 1, 'qqq111', '140.00', 7, 'REELLE', 'N'),
(14, 1, 'WWWWWW11', '87009.00', 4, 'REELLE', 'N'),
(15, 1, 'qqq', '30007.00', 2, 'REELLE', 'N'),
(16, 1, 'tryytyryry', '2998.00', 2, 'REELLE', 'N'),
(17, 1, 'aazaze', '22991.00', 0, 'VIRTUELLE', 'O'),
(18, 1, 'dqsdsqdsqds', '22991.00', 4, 'REELLE', 'N'),
(19, 1, 'dqsdsqdsqds', '22991.00', 4, 'VIRTUELLE', 'O'),
(20, 1, 'sss', '543300.00', 7, 'VIRTUELLE', 'N'),
(21, 1, 'Test SUPPR', '185.00', 2, 'VIRTUELLE', 'N'),
(22, 1, 'test 99', '325.00', 2, 'VIRTUELLE', 'O'),
(23, 2, 'Test Sortie 1', '120.00', 2, 'REELLE', 'N'),
(24, 1, 'tutu', '1310.00', 4, 'VIRTUELLE', 'N');

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
  `password` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `login`, `password`, `nom`, `prenom`) VALUES
(1, 'ydeydier', 'test', 'DEYDIER', 'Yann');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`idArticle`),
  ADD KEY `idStock` (`idStock`);

--
-- Index pour la table `lignesortie`
--
ALTER TABLE `lignesortie`
  ADD PRIMARY KEY (`idArticle`,`idSortie`),
  ADD KEY `idSortie` (`idSortie`);

--
-- Index pour la table `lignestock`
--
ALTER TABLE `lignestock`
  ADD PRIMARY KEY (`idStock`,`idArticle`),
  ADD KEY `idArticle` (`idArticle`);

--
-- Index pour la table `sortie`
--
ALTER TABLE `sortie`
  ADD PRIMARY KEY (`idSortie`),
  ADD KEY `idStock` (`idStock`);

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
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `sortie`
--
ALTER TABLE `sortie`
  MODIFY `idSortie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`idStock`) REFERENCES `stock` (`idStock`);

--
-- Contraintes pour la table `lignesortie`
--
ALTER TABLE `lignesortie`
  ADD CONSTRAINT `lignesortie_ibfk_1` FOREIGN KEY (`idSortie`) REFERENCES `sortie` (`idSortie`),
  ADD CONSTRAINT `lignesortie_ibfk_2` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`);

--
-- Contraintes pour la table `lignestock`
--
ALTER TABLE `lignestock`
  ADD CONSTRAINT `lignestock_ibfk_1` FOREIGN KEY (`idStock`) REFERENCES `stock` (`idStock`),
  ADD CONSTRAINT `lignestock_ibfk_2` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`);

--
-- Contraintes pour la table `sortie`
--
ALTER TABLE `sortie`
  ADD CONSTRAINT `sortie_ibfk_1` FOREIGN KEY (`idStock`) REFERENCES `stock` (`idStock`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
