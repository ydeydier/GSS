SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

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
(7, 1, 'SUCRE MORCEAUX 5KG', '9.227');

DROP TABLE IF EXISTS `ligne_sortie`;
CREATE TABLE `ligne_sortie` (
  `idSortie` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `prixSortie` decimal(10,3) DEFAULT NULL,
  `quantite` decimal(9,2) DEFAULT NULL,
  `beneficiaire` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `ligne_stock`;
CREATE TABLE `ligne_stock` (
  `idStock` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `quantiteReelle` decimal(9,2) DEFAULT NULL,
  `quantiteVirtuelle` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ligne_stock` (`idStock`, `idArticle`, `quantiteReelle`, `quantiteVirtuelle`) VALUES
(1, 1, '86.00', '86.00'),
(1, 2, '-10.00', '-10.00'),
(1, 4, '10.00', '10.00'),
(1, 5, '-5.00', '-5.00'),
(1, 6, '4.00', '4.00'),
(1, 7, '-1.00', '-1.00');

DROP TABLE IF EXISTS `sortie`;
CREATE TABLE `sortie` (
  `idSortie` int(11) NOT NULL,
  `idStock` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `commentaire` varchar(500) DEFAULT NULL,
  `coutTotal` decimal(10,2) NOT NULL,
  `nbreArticles` int(11) NOT NULL,
  `etat` enum('VIRTUELLE','REELLE') NOT NULL,
  `corbeille` enum('O','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `idStock` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `utiliseBeneficiaire` enum('O','N') NOT NULL DEFAULT 'N' COMMENT '''O'' si la colonne "bénéficiaire" doit être utilisée sur les sorties. ''N'' sinon.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `stock` (`idStock`, `nom`, `utiliseBeneficiaire`) VALUES
(1, 'Stock Epicerie', 'N'),
(2, 'Stock MVA', 'O');

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
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `sortie`
  MODIFY `idSortie` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `stock`
  MODIFY `idStock` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT;


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
