-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 26 déc. 2017 à 00:14
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


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
  `prixCourant` decimal(10,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`idArticle`, `idStock`, `nom`, `prixCourant`) VALUES
(1, 1, 'ASSORTIMENT SUCRE CLUB 350G', '5.568'),
(2, 1, 'CAFE MOULU 100Â % ARABICA 1KG', '5.544'),
(4, 1, 'STICK CAFE/25', '4.167'),
(5, 1, 'STICK CAFE DECA/25', '4.167'),
(6, 1, 'SPECULOS/300', '14.243'),
(7, 1, 'SUCRE MORCEAUX 5KG', '9.227'),
(8, 1, 'THE LIPTON YELLOW/100', '6.830'),
(9, 1, 'EAU DE SOURCE EN 1L5', '0.311'),
(10, 1, 'EAU DE SOURCE EN 0,5L', '0.150'),
(11, 1, 'ASSORTIMENT BELIN 720G TRADITION', '7.174'),
(12, 1, 'ORLEANS ROSE/cubi', '12.600'),
(13, 1, 'ORLEANS ROUGE/cubi', '12.600'),
(14, 1, 'ORLEANS BLANC/cubi', '12.600'),
(15, 1, 'FLUTES JETABLE/100', '2.000'),
(16, 1, 'GOBELET CRISTAL 20CL/50', '1.860'),
(17, 1, 'GOBELET CARTON 15CL/100', '2.000'),
(18, 2, 'Truc 1', '20.000'),
(19, 2, 'Truc 2', '30.000'),
(20, 2, 'Truc 3', '40.000'),
(21, 2, 'Truc 4', '50.000'),
(22, 2, 'Truc 5', '90.000'),
(23, 2, 'Truc 6', '100.000'),
(24, 1, 'ASSIETTES PLASTIQUE(grande)/100', '6.203'),
(25, 1, 'ASSIETTES PLASTIQUES(petite)', NULL),
(26, 1, 'JUS D\'ORANGE PLEIN FRUIT EN 1L', '1.403'),
(27, 1, 'COCA COLA EN 1L5', NULL),
(28, 1, 'ECLAT DE VIGNE', '7.697'),
(29, 1, 'CIDRE BRUT 75CL', '1.860'),
(30, 1, 'JUS DE POMMES', NULL),
(31, 1, 'SUROTIN', NULL),
(32, 1, 'LASAGNE', NULL),
(33, 1, 'LINGOTIN', NULL),
(34, 5, 'AAA', '20.000'),
(35, 1, '', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_sortie`
--

DROP TABLE IF EXISTS `ligne_sortie`;
CREATE TABLE `ligne_sortie` (
  `idSortie` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `prixSortie` decimal(10,3) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `beneficiaire` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ligne_sortie`
--

INSERT INTO `ligne_sortie` (`idSortie`, `idArticle`, `prixSortie`, `quantite`, `beneficiaire`) VALUES
(27, 1, '5.568', 5, NULL),
(28, 1, '5.568', 50, NULL),
(29, 1, '5.568', 50, 'jean6'),
(30, 1, '5.568', 50, NULL),
(29, 2, '5.544', 30, 'gerard 99'),
(27, 4, '4.167', 100, NULL),
(23, 18, '20.000', 3, NULL),
(23, 19, '30.000', 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_stock`
--

DROP TABLE IF EXISTS `ligne_stock`;
CREATE TABLE `ligne_stock` (
  `idStock` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `quantiteReelle` int(11) DEFAULT NULL,
  `quantiteVirtuelle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ligne_stock`
--

INSERT INTO `ligne_stock` (`idStock`, `idArticle`, `quantiteReelle`, `quantiteVirtuelle`) VALUES
(1, 1, 122, -33),
(1, 2, 198, 168),
(1, 4, 213, 113),
(1, 5, 11, 11),
(1, 6, 5, 5),
(1, 7, 8, 8),
(1, 8, 11, 11),
(1, 9, 240, 240),
(1, 10, 264, 264),
(1, 11, 4, 4),
(1, 12, 0, 0),
(1, 13, 0, 0),
(1, 14, 0, 0),
(1, 15, 40, 40),
(1, 16, 13, 13),
(1, 17, 24, 24),
(1, 24, 6, 6),
(1, 25, 1000, 1000),
(1, 26, 53, 53),
(1, 27, 0, 0),
(1, 28, 78, 78),
(1, 29, 21, 21),
(1, 30, 0, 0),
(1, 31, 8, 8),
(1, 32, 8, 8),
(1, 33, 0, 0),
(1, 35, 0, 0),
(2, 18, 2, 2),
(2, 19, 8, 8),
(2, 20, 15, 15),
(2, 21, 20, 20),
(2, 22, 30, 30),
(2, 23, 40, 40),
(5, 34, 3, 3);

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
(23, 2, 'Test Sortie 1', '120.00', 2, 'REELLE', 'N'),
(27, 1, 'Conseil municipal nÂ°22', '444.54', 2, 'VIRTUELLE', 'N'),
(28, 1, 'wwwwww', '278.40', 1, 'VIRTUELLE', 'N'),
(29, 1, 'yyyyyyyyy', '444.72', 2, 'VIRTUELLE', 'N'),
(30, 1, '99', '278.40', 1, 'VIRTUELLE', 'N');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `idStock` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `utiliseBeneficiaire` enum('O','N') NOT NULL DEFAULT 'N' COMMENT '''O'' si la colonne "bénéficiaire" doit être utilisée sur les sorties. ''N'' sinon.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`idStock`, `nom`, `utiliseBeneficiaire`) VALUES
(1, 'Stock \'Epicerie', 'N'),
(2, 'Alimentation fetes', 'N'),
(3, 'tutu2', 'N'),
(4, 'tata3', 'N'),
(5, 'aaaaaaaa', 'N'),
(6, 'r\'r', 'N');

-- --------------------------------------------------------

--
-- Structure de la table `stock_autorise`
--

DROP TABLE IF EXISTS `stock_autorise`;
CREATE TABLE `stock_autorise` (
  `idStock` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `defaut` enum('O','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stock_autorise`
--

INSERT INTO `stock_autorise` (`idStock`, `idUtilisateur`, `defaut`) VALUES
(1, 1, 'O'),
(1, 16, 'N'),
(1, 21, 'N'),
(2, 1, 'N'),
(3, 19, 'O'),
(4, 19, 'N'),
(5, 1, 'N');

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
  `prenom` varchar(30) NOT NULL,
  `administrateur` enum('O','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `login`, `password`, `nom`, `prenom`, `administrateur`) VALUES
(1, 'ydeydier', 'test', 'DEYDIER', 'Yann', 'N'),
(2, 'admin', 'admin', 'Administrateur', '', 'O'),
(3, 'c', 'c\'c', 'a\'\'\'a', 'b\'b', 'N'),
(4, 'cc', 'dd', 'aa', 'bb', 'N'),
(5, '', '', 'a\"a', '', 'N'),
(6, '', '', 'mysqlEscape(zzz)', '', 'N'),
(7, '', '', 'dd', '', 'N'),
(8, '', '', 'dd\'rr', '', 'N'),
(9, '', '', '', '', 'N'),
(10, '', '', '', '', 'N'),
(11, '', '', 'dqsqsd', '', 'N'),
(12, 'qsdqsd', '', 'qsdqsd', '', 'N'),
(13, 'ggf dfgdf', '', 'fdggd', '', 'N'),
(14, 'qsd qsdqs', '', 'qsddqs', '', 'N'),
(15, 'fsdsdfsdf', '', 'sfdsdf', '', 'N'),
(16, 'njousset', 'aa', 'JOUSSET', 'Nathalie', 'N'),
(17, 'www', '', 'www', '', 'N'),
(18, 'hh', 'hh', 'hhhh', '', 'N'),
(19, 'zeze', 'zeze', 'zezezezez', 'ezeze', 'N'),
(20, 'gfhgfh', 'hgf', 'hfghgfh', 'gfgf', 'N'),
(21, 'ppp', 'ppp', 'ppp', 'ppp', 'N'),
(22, 'c', 'd', 'a', 'b', 'N'),
(23, 'c\'c', 'd(d', 'a\'a', 'b\'b', 'N');

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
-- Index pour la table `ligne_sortie`
--
ALTER TABLE `ligne_sortie`
  ADD PRIMARY KEY (`idArticle`,`idSortie`),
  ADD KEY `idSortie` (`idSortie`);

--
-- Index pour la table `ligne_stock`
--
ALTER TABLE `ligne_stock`
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
-- Index pour la table `stock_autorise`
--
ALTER TABLE `stock_autorise`
  ADD PRIMARY KEY (`idStock`,`idUtilisateur`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

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
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `sortie`
--
ALTER TABLE `sortie`
  MODIFY `idSortie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `idStock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`idStock`) REFERENCES `stock` (`idStock`);

--
-- Contraintes pour la table `ligne_sortie`
--
ALTER TABLE `ligne_sortie`
  ADD CONSTRAINT `ligne_sortie_ibfk_1` FOREIGN KEY (`idSortie`) REFERENCES `sortie` (`idSortie`),
  ADD CONSTRAINT `ligne_sortie_ibfk_2` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`);

--
-- Contraintes pour la table `ligne_stock`
--
ALTER TABLE `ligne_stock`
  ADD CONSTRAINT `ligne_stock_ibfk_1` FOREIGN KEY (`idStock`) REFERENCES `stock` (`idStock`),
  ADD CONSTRAINT `ligne_stock_ibfk_2` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`);

--
-- Contraintes pour la table `sortie`
--
ALTER TABLE `sortie`
  ADD CONSTRAINT `sortie_ibfk_1` FOREIGN KEY (`idStock`) REFERENCES `stock` (`idStock`);

--
-- Contraintes pour la table `stock_autorise`
--
ALTER TABLE `stock_autorise`
  ADD CONSTRAINT `stock_autorise_ibfk_1` FOREIGN KEY (`idStock`) REFERENCES `stock` (`idStock`),
  ADD CONSTRAINT `stock_autorise_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);
COMMIT;
