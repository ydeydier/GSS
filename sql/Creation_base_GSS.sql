SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `gss` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gss`;

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `idArticle` int(11) NOT NULL,
  `idStock` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prixCourant` decimal(10,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(18, 2, 'Truc 1', '20.000'),
(19, 2, 'Truc 2', '30.000'),
(27, 1, 'COCA COLA EN 1L5', NULL),
(28, 1, 'ECLAT DE VIGNE', '7.697');

DROP TABLE IF EXISTS `ligne_sortie`;
CREATE TABLE `ligne_sortie` (
  `idSortie` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `prixSortie` decimal(10,3) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `beneficiaire` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ligne_sortie` (`idSortie`, `idArticle`, `prixSortie`, `quantite`, `beneficiaire`) VALUES
(31, 1, '5.568', 10, NULL),
(34, 1, '5.568', 20, NULL),
(31, 2, '5.544', 5, NULL),
(34, 2, '5.544', 30, NULL),
(31, 4, '4.167', 10, NULL),
(31, 5, '4.167', 5, NULL),
(32, 9, '0.311', 20, NULL),
(23, 18, '20.000', 3, NULL),
(23, 19, '30.000', 2, NULL),
(35, 27, NULL, 5, NULL),
(35, 28, '7.697', 10, NULL);

DROP TABLE IF EXISTS `ligne_stock`;
CREATE TABLE `ligne_stock` (
  `idStock` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `quantiteReelle` int(11) DEFAULT NULL,
  `quantiteVirtuelle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ligne_stock` (`idStock`, `idArticle`, `quantiteReelle`, `quantiteVirtuelle`) VALUES
(1, 1, 112, 92),
(1, 2, 193, 163),
(1, 4, 203, 203),
(1, 5, 6, 6),
(1, 6, 5, 5),
(1, 7, 8, 8),
(1, 8, 11, 11),
(1, 9, 240, 240),
(1, 10, 264, 264),
(1, 11, 4, 4),
(1, 12, 0, 0),
(1, 13, 0, 0),
(1, 14, 0, 0);

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

INSERT INTO `sortie` (`idSortie`, `idStock`, `nom`, `coutTotal`, `nbreArticles`, `etat`, `corbeille`) VALUES
(23, 2, 'Test Sortie 1', '120.00', 2, 'REELLE', 'N'),
(31, 1, 'Noel des enfants', '145.91', 4, 'REELLE', 'O'),
(32, 1, 'Conseil municipal nÂ°22', '6.22', 1, 'VIRTUELLE', 'O'),
(34, 1, 'test', '277.68', 2, 'VIRTUELLE', 'N'),
(35, 1, 'aaa', '76.97', 2, 'VIRTUELLE', 'N');

DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `idStock` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `utiliseBeneficiaire` enum('O','N') NOT NULL DEFAULT 'N' COMMENT '''O'' si la colonne "bénéficiaire" doit être utilisée sur les sorties. ''N'' sinon.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `stock` (`idStock`, `nom`, `utiliseBeneficiaire`) VALUES
(1, 'Stock Epicerie', 'N'),
(2, 'Alimentation fetes', 'N');

DROP TABLE IF EXISTS `stock_autorise`;
CREATE TABLE `stock_autorise` (
  `idStock` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `defaut` enum('O','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `stock_autorise` (`idStock`, `idUtilisateur`, `defaut`) VALUES
(1, 24, 'O'),
(2, 24, 'N');

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `login` varchar(15) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `administrateur` enum('O','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `utilisateur` (`idUtilisateur`, `login`, `password`, `nom`, `prenom`, `administrateur`) VALUES
(2, 'admin', 'admin', 'Administrateur', '', 'O'),
(24, 'sdurant', 'sdurant', 'Durant', 'Sylvain', 'N');


ALTER TABLE `article`
  ADD PRIMARY KEY (`idArticle`),
  ADD KEY `idStock` (`idStock`);

ALTER TABLE `ligne_sortie`
  ADD PRIMARY KEY (`idArticle`,`idSortie`),
  ADD KEY `idSortie` (`idSortie`);

ALTER TABLE `ligne_stock`
  ADD PRIMARY KEY (`idStock`,`idArticle`),
  ADD KEY `idArticle` (`idArticle`);

ALTER TABLE `sortie`
  ADD PRIMARY KEY (`idSortie`),
  ADD KEY `idStock` (`idStock`);

ALTER TABLE `stock`
  ADD PRIMARY KEY (`idStock`);

ALTER TABLE `stock_autorise`
  ADD PRIMARY KEY (`idStock`,`idUtilisateur`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);


ALTER TABLE `article`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

ALTER TABLE `sortie`
  MODIFY `idSortie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

ALTER TABLE `stock`
  MODIFY `idStock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;


ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`idStock`) REFERENCES `stock` (`idStock`);

ALTER TABLE `ligne_sortie`
  ADD CONSTRAINT `ligne_sortie_ibfk_1` FOREIGN KEY (`idSortie`) REFERENCES `sortie` (`idSortie`),
  ADD CONSTRAINT `ligne_sortie_ibfk_2` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`);

ALTER TABLE `ligne_stock`
  ADD CONSTRAINT `ligne_stock_ibfk_1` FOREIGN KEY (`idStock`) REFERENCES `stock` (`idStock`),
  ADD CONSTRAINT `ligne_stock_ibfk_2` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`);

ALTER TABLE `sortie`
  ADD CONSTRAINT `sortie_ibfk_1` FOREIGN KEY (`idStock`) REFERENCES `stock` (`idStock`);

ALTER TABLE `stock_autorise`
  ADD CONSTRAINT `stock_autorise_ibfk_1` FOREIGN KEY (`idStock`) REFERENCES `stock` (`idStock`),
  ADD CONSTRAINT `stock_autorise_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
