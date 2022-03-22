-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 26 Mai 2018 à 10:47
-- Version du serveur :  5.6.20
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `scolarite1`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE IF NOT EXISTS `absence` (
`ida` int(11) NOT NULL,
  `ljr` date NOT NULL,
  `etud` varchar(60) NOT NULL,
  `cour` varchar(80) NOT NULL,
  `dure` int(11) NOT NULL,
  `statut` varchar(30) NOT NULL,
  `mtfa` varchar(60) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `absence`
--

INSERT INTO `absence` (`ida`, `ljr`, `etud`, `cour`, `dure`, `statut`, `mtfa`) VALUES
(1, '0000-00-00', 'AKAKPO sabine Dorcass', '', 0, 'Absent(e)', ''),
(2, '2018-05-20', 'AKAKPO sabine Dorcass', '', 0, 'Absent(e)', ''),
(3, '2018-05-20', 'AKAKPO sabine Dorcass', '', 0, 'Absent(e)', ''),
(4, '2018-05-22', 'AFATCHAO Kokou maxwell', '', 0, 'Absent(e)', ''),
(5, '2018-05-22', 'AFATCHAO Kokou maxwell', 'ATO', 0, '', ''),
(6, '2018-05-22', 'AFATCHAO Kokou maxwell', 'ATO', 0, 'Absent(e)', ''),
(7, '2018-05-22', 'Array', 'Array', 0, 'Array', ''),
(8, '2018-05-22', 'Array', 'Array', 0, 'Array', ''),
(9, '2018-05-22', 'AFATCHAO Kokou maxwell', 'ATO', 0, 'Malade', '');

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

CREATE TABLE IF NOT EXISTS `etablissement` (
`id` int(11) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mail` varchar(60) NOT NULL,
  `motdepasse` varchar(90) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `etablissement`
--

INSERT INTO `etablissement` (`id`, `pseudo`, `mail`, `motdepasse`) VALUES
(1, 'defi', 'def@defitech.tg', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE IF NOT EXISTS `etudiant` (
`idp` int(11) NOT NULL,
  `nom_e` varchar(30) NOT NULL,
  `pren` varchar(40) NOT NULL,
  `preno` varchar(30) NOT NULL,
  `sexe` varchar(8) NOT NULL,
  `contact_e` int(8) NOT NULL,
  `code_f` varchar(20) NOT NULL,
  `etu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`idp`, `nom_e`, `pren`, `preno`, `sexe`, `contact_e`, `code_f`, `etu`) VALUES
(1, 'AKAKPO', 'sabine', 'Dorcass', 'FEMININ', 98526557, 'ARLE', 'AKAKPO sabine Dorcass'),
(2, 'SEMONDJI', 'christophe', 'Charles', 'MASCULIN', 90164793, 'DA', 'SEMONDJI christophe Charles'),
(4, 'TEKOE', 'loic', 'Roland', 'MASCULIN', 91564893, 'TLCOM', 'TEKOE loic Roland'),
(5, 'ALOPE', 'nufafa', 'Ronald', 'MASCULIN', 70164932, 'DA', 'ALOPE nufafa Ronald'),
(6, 'AFFAMBI', 'jean', 'Prisco', 'MASCULIN', 70569182, 'ARLE', 'AFFAMBI jean Prisco'),
(9, 'ATTIDOKPO', 'dubois', 'Vivien', 'MASCULIN', 96351627, 'TLCOM', 'ATTIDOKPO dubois Vivien'),
(11, 'AMEKOUDI', 'abla', 'josephine', 'FEMININ', 93167895, 'TLCOM', 'AMEKOUDI abla josephine'),
(12, 'AMDEOME', 'joly', 'florent', 'MASCULIN', 91647854, 'DA', 'AMDEOME joly florent'),
(13, 'DJREKE', 'Eddy', 'Kossivi', 'MASCULIN', 93167852, 'DA', 'DJREKE Eddy Kossivi'),
(14, 'DJOSSOU', 'Schalom', 'Florent', 'MASCULIN', 93168574, 'TLCOM', 'DJOSSOU Schalom Florent'),
(15, 'SOROFINO', 'kpakpatrou', 'koliko', 'Masculin', 96321585, 'DA', 'SOROFINO kpakpatrou koliko'),
(16, 'AFATCHAO', 'Kokou', 'maxwell', 'Masculin', 92035684, 'ARLE', 'AFATCHAO Kokou maxwell');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE IF NOT EXISTS `filiere` (
`CodeFil` int(11) NOT NULL,
  `NomFil` varchar(100) DEFAULT NULL,
  `Desc_f` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `filiere`
--

INSERT INTO `filiere` (`CodeFil`, `NomFil`, `Desc_f`) VALUES
(1, 'DA', 'Developpement d''application'),
(2, 'ARLE', 'Resaux'),
(4, 'TLCOM', 'telecommunication');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE IF NOT EXISTS `matiere` (
`idm` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `libelle` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `matiere`
--

INSERT INTO `matiere` (`idm`, `nom`, `libelle`) VALUES
(1, 'ECO ORGA', 'Economie Organisationnelle'),
(2, 'CISCO', 'Cour de reseaux'),
(3, 'MS OFFICE ACCESS', 'Cour de microsoft'),
(4, 'ATO', 'Architecture et Technologie des Ordinateurs'),
(5, 'RESEAUX', 'Cour de reseaux'),
(6, 'ANGLAIS', 'Cour linguistique'),
(7, 'JAVA', 'Cour de programmation'),
(8, 'FRANCAIS', 'Cour de langue'),
(9, 'MERISE', 'Cour d''analyse'),
(10, 'ALGORITHME', 'Cour de programmation'),
(11, 'DELPHI', 'Langage de programmation'),
(12, 'PHP', 'Cour de programmation web'),
(13, 'SQL', 'Langage de Mysql'),
(14, 'MATHEMATIQUES', 'Mathematique generale'),
(15, 'STATISTIQUES', 'Mathematique generale'),
(16, 'PROJET', 'Suivi de projet'),
(17, 'DROIT', 'Notion de droit civil des affaires de travail'),
(18, 'ECO GENE', 'Economie generale'),
(20, 'COMPTABILITE', 'Cour de gestion'),
(21, 'LINUX', 'Cour sur OS');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE IF NOT EXISTS `professeur` (
`idpo` int(11) NOT NULL,
  `no` varchar(35) NOT NULL,
  `p1` varchar(15) NOT NULL,
  `p2` varchar(15) NOT NULL,
  `sx` varchar(10) NOT NULL,
  `ct` int(20) NOT NULL,
  `pop` varchar(200) DEFAULT NULL,
  `motdepasse` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `professeur`
--

INSERT INTO `professeur` (`idpo`, `no`, `p1`, `p2`, `sx`, `ct`, `pop`, `motdepasse`, `pseudo`) VALUES
(1, 'AMEGNIADAN', 'kafui', 'victoire', 'FEMININ', 2147483647, 'AMEGNIADAN kafui victoire', '123', 'Victoire'),
(4, 'KPELLY', 'Abalo', 'Samuel', 'MASCULIN', 90055016, 'KPELLY Abalo Samuel', '51eac6b471a284d3341d8c0c63d0f1a286262a18', 'Samuel'),
(5, 'AMUZUN', 'Eric', 'donatien', 'Masculin', 2147483647, 'AMUZUN Paul donatien', '789', 'Eric');

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

CREATE TABLE IF NOT EXISTS `seance` (
`ids` int(11) NOT NULL,
  `pro` varchar(90) NOT NULL,
  `mat` varchar(30) NOT NULL,
  `fil` varchar(30) NOT NULL,
  `jr` varchar(90) NOT NULL,
  `hf` time NOT NULL,
  `dur` int(11) NOT NULL,
  `idpro` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `seance`
--

INSERT INTO `seance` (`ids`, `pro`, `mat`, `fil`, `jr`, `hf`, `dur`, `idpro`) VALUES
(15, 'AMEGNIADAN kafui victoire', 'FRANCAIS', 'DA', 'Mardi', '00:00:00', 0, 1),
(18, 'AMUZUN Paul donatien', 'CISCO', 'ARLE', 'Lundi', '00:00:00', 0, 5),
(19, 'KPELLY Abalo Samuel', 'ATO', 'ARLE', 'Mardi', '00:00:00', 0, 4);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `absence`
--
ALTER TABLE `absence`
 ADD PRIMARY KEY (`ida`), ADD KEY `idet` (`etud`), ADD KEY `idse` (`cour`);

--
-- Index pour la table `etablissement`
--
ALTER TABLE `etablissement`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
 ADD PRIMARY KEY (`idp`), ADD KEY `code_f` (`code_f`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
 ADD PRIMARY KEY (`CodeFil`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
 ADD PRIMARY KEY (`idm`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
 ADD PRIMARY KEY (`idpo`);

--
-- Index pour la table `seance`
--
ALTER TABLE `seance`
 ADD PRIMARY KEY (`ids`), ADD KEY `idj` (`pro`), ADD KEY `idf` (`fil`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `absence`
--
ALTER TABLE `absence`
MODIFY `ida` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `etablissement`
--
ALTER TABLE `etablissement`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
MODIFY `CodeFil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `professeur`
--
ALTER TABLE `professeur`
MODIFY `idpo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `seance`
--
ALTER TABLE `seance`
MODIFY `ids` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
