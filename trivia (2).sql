-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 29 Avril 2015 à 10:01
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `trivia`
--
CREATE DATABASE IF NOT EXISTS `trivia` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `trivia`;

-- --------------------------------------------------------

--
-- Structure de la table `domaine`
--

CREATE TABLE IF NOT EXISTS `domaine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idmonde` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `description` text,
  `icon` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_appartenir` (`idmonde`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `domaine`
--

INSERT INTO `domaine` (`id`, `idmonde`, `libelle`, `description`, `icon`) VALUES
(1, 1, 'Cuisine', NULL, 'cuisine.png'),
(2, 1, 'Matériel', NULL, 'materiel.png'),
(3, 2, 'Cinéma', NULL, 'cinema.png'),
(4, 2, 'Jeux vidéos', NULL, 'jeux_video.png'),
(5, 2, 'Livres', 'Domaine des livres, BD, etc.', 'livre.png'),
(6, 1, 'Couronne', NULL, 'couronne.png'),
(7, 2, 'Couronne', NULL, 'couronne.png');

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE IF NOT EXISTS `joueur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idMonde` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(250) NOT NULL,
  `niveau` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_travailler` (`idMonde`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `joueur`
--

INSERT INTO `joueur` (`id`, `idMonde`, `nom`, `prenom`, `mail`, `login`, `password`, `niveau`) VALUES
(1, 1, 'Bouchard', 'Gerard', 'Gerard.Bouchard@tel.rose', 'El Cuistot', 'tacru', NULL),
(2, 2, 'Nanmého', 'C''estyoloswag', 'tacruouquoi@noob.gg', 'xXxKevynxXx', 'ctrololol', 9000),
(3, 2, 'TEST', 'Random', 'Random@Test.com', 'Testeur', '123456', 1),
(15, 2, 'Noris', 'Marc', 'mnoris.xeno@gmail.com', 'Xaerys', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', NULL),
(16, 2, 'dd', 'dd', 'dd', 'rr', '2e7a6da42cf3171444a64824700221bf50c6926bd334e403b54d8ef05645ebec10eeb51c22bcf2c950e00a3d25797d7ce69a2237d4d5c4d60c95937582af666d', NULL),
(17, 2, 'ii', 'ii', 'ii', 'ii', '3bae7400ab3bf3ce4657060253c393e06cbed140fd3867d920d725ee16b769073fa7440558f4e8bd8ff6c8b720d6cd772f8d2b0c846ac70cc6be6f3499d51a80', NULL),
(18, 2, 'aa', 'aa', 'aa', 'aa', 'f6c5600ed1dbdcfdf829081f5417dccbbd2b9288e0b427e65c8cf67e274b69009cd142475e15304f599f429f260a661b5df4de26746459a3cef7f32006e5d1c1', NULL),
(19, 1, 'uu', 'uu', 'uu', 'uu', '2911f5ead711fc5f048e9d9b36f66b298b52f00a0adc1fad561d5197d9d47bebc4f57a4fc47d894144a1ad1d4eabecb69c495a559faff95ce79bbe139705469b', NULL),
(20, 1, 'ss', 'ss', 'ss', 'ss', 'd97887cbaa130018995163b36ddd8b012cde65f020f4324e9babf96aa7f9b162876d7ce128447ca77e05d22974cefce0141fef199c973137dc699f966fd2dba4', NULL),
(21, 1, 'ss', 'ss', 'ss', 'ss', 'd97887cbaa130018995163b36ddd8b012cde65f020f4324e9babf96aa7f9b162876d7ce128447ca77e05d22974cefce0141fef199c973137dc699f966fd2dba4', NULL),
(22, 2, 'ww', 'ww', 'ww', 'ww', '7e7246cbaa79f710fe57ba338f684064a416198270db19b4a0c509c83755a9a307c87b21736c99a7dbff5da96a6191ec89ce9fbace919a6d8455f51d78e0313f', NULL),
(23, 2, 'lklk', 'lklk', 'lklk', 'lklk', '126b6d2f259bee541ebdd60fb319fd4553a8859c48ef6b327417d96358101f5aec98cdef85ed536c0c30f5a7e6e6b5de953ae36554dcdddcbc5bd0da42dcd6dd', NULL),
(24, 1, 'kk', 'kk', 'kk', 'kk', 'de32c32b4fae693f807da208dc86dcf20fa2f620e20d9edcc17d4c7311b54972273e241b162c1ef8dfa89ad2fa210536eac0228d82840cf10b0cdecf39337ba0', NULL),
(25, 1, 'mm', 'mm', 'mm', 'mm', '3e5703709259d1aad1ee12bf4de25c6e1ac48ad1cddc5e0c600ec9b764fb23a28b4745f82dbe38ad236ce2ffa51ee71f1aa007632e3c78ad928879574d534a7c', NULL),
(26, 1, 'oo', 'oo', 'oo', 'oo', '61e4b8aab8fa9c9f32cd74a2f4e378c1fbbe6da817f2939a1ea0d5e2b84de48430eb559ee809c105ddef5668f96eb8540398797213caf132543f2ba227e4bc49', NULL),
(27, 1, 'oo', 'oo', 'oo', 'oo', '61e4b8aab8fa9c9f32cd74a2f4e378c1fbbe6da817f2939a1ea0d5e2b84de48430eb559ee809c105ddef5668f96eb8540398797213caf132543f2ba227e4bc49', NULL),
(28, 2, 'hh', 'hh', 'hh@hhh.gt', 'hh', '7de896b588a8efaf14ecf59bcf17e883194ecbc7115e259b435551d69dbaf17741f13aaab0a759567d9b6ff361b5354edb35204d41c651bb944d2d5405e5b1de', NULL),
(29, 1, 'ff', 'ff', 'ff', 'ff', 'b94c896d0bcea31196f6ddedad3aa57ae3ec45cfe54f633da5a1b73425931649b5d2cbd0f17e590234c9f8325ddffa3cf9c469df5f018cdb9474f9fdbcb031e4', NULL),
(30, 2, 'ssstte', 'etttssss', 'sddfdfs@cs.de', 'el cuisoo', 'sdqsdsq', NULL),
(31, 2, 'je', 'je', 'je@gmail.com', 'je', 'c11c66b5e92dce18ce4e6c7c9d956d09afd5a734c046f8fe645653931de1db0ef639567724e65e48f05bd922a78fa1547c86996fd5de1a62573c4cc2f46d2300', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `monde`
--

CREATE TABLE IF NOT EXISTS `monde` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `monde`
--

INSERT INTO `monde` (`id`, `libelle`) VALUES
(1, 'Cuisine'),
(2, 'Divertissement');

-- --------------------------------------------------------

--
-- Structure de la table `partie`
--

CREATE TABLE IF NOT EXISTS `partie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idJoueurEnCours` int(11) DEFAULT NULL,
  `idJoueur1` int(11) NOT NULL,
  `idJoueur2` int(11) DEFAULT NULL,
  `dernierCoup` datetime DEFAULT NULL,
  `manche` int(2) NOT NULL DEFAULT '1',
  `finished` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_doitJouer` (`idJoueur1`),
  KEY `FK_participer1` (`idJoueur2`),
  KEY `FK_participer2` (`idJoueurEnCours`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=235 ;

--
-- Contenu de la table `partie`
--

INSERT INTO `partie` (`id`, `idJoueurEnCours`, `idJoueur1`, `idJoueur2`, `dernierCoup`, `manche`, `finished`) VALUES
(231, 16, 16, 16, '2014-11-26 19:09:02', 15, 0),
(232, 16, 16, 16, '2014-11-26 19:32:54', 12, 0),
(233, 16, 16, 16, '2015-02-23 08:47:17', 1, 0),
(234, 16, 16, 29, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `point`
--

CREATE TABLE IF NOT EXISTS `point` (
  `idpartie` int(11) NOT NULL,
  `idjoueur` int(11) NOT NULL,
  `nbpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idpartie`,`idjoueur`),
  KEY `idjoueur` (`idjoueur`),
  KEY `idpartie` (`idpartie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `point`
--

INSERT INTO `point` (`idpartie`, `idjoueur`, `nbpoint`) VALUES
(231, 16, 2),
(232, 16, 2),
(233, 16, 0);

-- --------------------------------------------------------

--
-- Structure de la table `probleme`
--

CREATE TABLE IF NOT EXISTS `probleme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=210 ;

--
-- Contenu de la table `probleme`
--

INSERT INTO `probleme` (`id`, `libelle`) VALUES
(207, 'Incomprehensible'),
(208, 'Réponse(s) incorrect'),
(209, 'Mauvais domaine');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iddomaine` int(11) NOT NULL,
  `idjoueur` int(11) NOT NULL,
  `libelle` text,
  `validation` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_definir` (`iddomaine`),
  KEY `FK_soumettre` (`idjoueur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`id`, `iddomaine`, `idjoueur`, `libelle`, `validation`) VALUES
(1, 1, 1, 'Lequel de ces légumes est en fait un fruit ?', 1),
(2, 4, 2, 'Quel est le nom du frère de Mario, dans la série éponyme ?', 1),
(3, 3, 2, 'Lequel de ces films se déroule dans l''espace ?', 1),
(4, 3, 2, 'Lequel de ces acteurs a joué dans Pirates des Caraïbes ?', 1),
(5, 5, 1, 'Qui est Astérix ?', 1),
(18, 3, 16, 'Charlie chaplin etait un ?', 1),
(48, 3, 16, 'un', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idquestion` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `estBonne` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_correspondre` (`idquestion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Contenu de la table `reponse`
--

INSERT INTO `reponse` (`id`, `idquestion`, `libelle`, `estBonne`) VALUES
(1, 1, 'Tomate', 1),
(2, 2, 'Luigi', 1),
(3, 3, 'Star Wars', 1),
(4, 4, 'Johnny Depp', 1),
(5, 1, 'La réponse D', 0),
(6, 1, 'Obi Wan Kennobi', 0),
(7, 1, 'Haricots verts', 0),
(8, 2, 'Georgio', 0),
(9, 2, 'Leorio', 0),
(10, 2, 'Katy Perry', 0),
(11, 3, 'Le Seigneur des Anneaux', 0),
(12, 3, 'Pirates des Caraïbes', 0),
(13, 3, 'Titanic', 0),
(14, 4, 'Dany Boon', 0),
(15, 4, 'Chuck Norris', 0),
(20, 4, 'Charlie Beaugrand', 0),
(21, 5, 'Romain', 0),
(22, 5, 'Astronaute', 0),
(23, 5, 'Gaulois', 1),
(24, 5, 'Femme de Hollande', 0),
(29, 18, 'Chandelier', 0),
(30, 18, 'Chanteur', 0),
(31, 18, 'Peintre', 0),
(32, 18, 'Acteur', 1),
(49, 48, 'undeux', 0),
(50, 48, 'untrois', 0),
(51, 48, 'unquatre', 0),
(52, 48, 'uncinq', 1);

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

CREATE TABLE IF NOT EXISTS `score` (
  `idpartie` int(11) NOT NULL,
  `idjoueur` int(11) NOT NULL,
  `iddomaine` int(11) NOT NULL,
  PRIMARY KEY (`idpartie`,`idjoueur`,`iddomaine`),
  KEY `FK_score` (`iddomaine`),
  KEY `idjoueur` (`idjoueur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `score`
--

INSERT INTO `score` (`idpartie`, `idjoueur`, `iddomaine`) VALUES
(231, 16, 3),
(232, 16, 3),
(231, 16, 4),
(232, 16, 4),
(233, 16, 5);

-- --------------------------------------------------------

--
-- Structure de la table `signalement`
--

CREATE TABLE IF NOT EXISTS `signalement` (
  `idprobleme` int(11) NOT NULL,
  `idjoueur` int(11) NOT NULL,
  `idquestion` int(11) NOT NULL,
  `dateS` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idprobleme`,`idjoueur`,`idquestion`,`dateS`),
  KEY `FK_signalement` (`idjoueur`),
  KEY `idquestion` (`idquestion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `signalement`
--

INSERT INTO `signalement` (`idprobleme`, `idjoueur`, `idquestion`, `dateS`) VALUES
(209, 16, 2, '2014-11-26 19:32:59'),
(209, 16, 5, '2014-11-26 19:31:53'),
(209, 16, 5, '2014-11-26 19:32:20');

-- --------------------------------------------------------

--
-- Structure de la table `statistiques`
--

CREATE TABLE IF NOT EXISTS `statistiques` (
  `idDomaine` int(11) NOT NULL,
  `idJoueur` int(11) NOT NULL,
  `nbBonnesReponses` smallint(6) DEFAULT '0',
  `nbReponses` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idDomaine`,`idJoueur`),
  KEY `idjoueur` (`idJoueur`,`idDomaine`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `statistiques`
--

INSERT INTO `statistiques` (`idDomaine`, `idJoueur`, `nbBonnesReponses`, `nbReponses`) VALUES
(1, 31, 1, 1),
(3, 16, 25, 100),
(3, 17, 4, 6),
(3, 28, 15, 32),
(3, 31, 13, 29),
(4, 16, 35, 119),
(4, 17, 2, 5),
(4, 28, 13, 23),
(4, 31, 14, 30),
(5, 16, 23, 101),
(5, 17, 1, 5),
(5, 28, 22, 34),
(5, 31, 11, 15),
(7, 16, 34, 35),
(7, 17, 3, 3),
(7, 28, 2, 2),
(7, 31, 8, 8);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `domaine`
--
ALTER TABLE `domaine`
  ADD CONSTRAINT `FK_appartenir` FOREIGN KEY (`idmonde`) REFERENCES `monde` (`id`);

--
-- Contraintes pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD CONSTRAINT `FK_travailler` FOREIGN KEY (`idMonde`) REFERENCES `monde` (`id`);

--
-- Contraintes pour la table `partie`
--
ALTER TABLE `partie`
  ADD CONSTRAINT `FK_doitJouer` FOREIGN KEY (`idJoueur1`) REFERENCES `joueur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_participer1` FOREIGN KEY (`idJoueur2`) REFERENCES `joueur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_participer2` FOREIGN KEY (`idJoueurEnCours`) REFERENCES `joueur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `point`
--
ALTER TABLE `point`
  ADD CONSTRAINT `point_ibfk_1` FOREIGN KEY (`idpartie`) REFERENCES `partie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `point_ibfk_2` FOREIGN KEY (`idjoueur`) REFERENCES `joueur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_definir` FOREIGN KEY (`iddomaine`) REFERENCES `domaine` (`id`),
  ADD CONSTRAINT `FK_soumettre` FOREIGN KEY (`idjoueur`) REFERENCES `joueur` (`id`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_correspondre` FOREIGN KEY (`idquestion`) REFERENCES `question` (`id`);

--
-- Contraintes pour la table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`idpartie`) REFERENCES `partie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `score_ibfk_2` FOREIGN KEY (`idjoueur`) REFERENCES `joueur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `score_ibfk_3` FOREIGN KEY (`iddomaine`) REFERENCES `domaine` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `statistiques`
--
ALTER TABLE `statistiques`
  ADD CONSTRAINT `statistiques_ibfk_1` FOREIGN KEY (`iddomaine`) REFERENCES `domaine` (`id`),
  ADD CONSTRAINT `statistiques_ibfk_2` FOREIGN KEY (`idjoueur`) REFERENCES `joueur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
