-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 30 Août 2010 à 22:43
-- Version du serveur: 5.1.41
-- Version de PHP: 5.3.2-1ubuntu4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `devisenligne`
--

-- --------------------------------------------------------

--
-- Structure de la table `delcli`
--

CREATE TABLE IF NOT EXISTS `delcli` (
  `cliidcli` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant',
  `clilbnom` varchar(255) NOT NULL COMMENT 'nom / enseigne',
  `clilbaf1` varchar(255) NOT NULL COMMENT 'adresse factu 1',
  `clilbaf2` varchar(255) NOT NULL COMMENT 'adresse factu 2',
  `clilbcpf` char(5) NOT NULL COMMENT 'CP factu',
  `clilbvif` varchar(255) NOT NULL COMMENT 'ville factu',
  `clilbal1` varchar(255) NOT NULL COMMENT 'adresse liv 1',
  `clilbal2` varchar(255) NOT NULL COMMENT 'adresse liv 2',
  `clilbcpl` char(5) NOT NULL COMMENT 'CP liv',
  `clilbvil` varchar(255) NOT NULL COMMENT 'ville',
  `clilbtel` varchar(14) NOT NULL COMMENT 'telephone',
  `ctclbmai` varchar(255) NOT NULL COMMENT 'mail',
  `ctclbres` varchar(255) NOT NULL COMMENT 'nom du responsable',
  PRIMARY KEY (`cliidcli`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table des clients' AUTO_INCREMENT=2 ;

--
-- Contenu de la table `delcli`
--

INSERT INTO `delcli` (`cliidcli`, `clilbnom`, `clilbaf1`, `clilbaf2`, `clilbcpf`, `clilbvif`, `clilbal1`, `clilbal2`, `clilbcpl`, `clilbvil`, `clilbtel`, `ctclbmai`, `ctclbres`) VALUES
(1, 'Robert et Fils', '55, rue du bosquet', '', '73100', 'Aix-les-Bains', '', '', '', '', '01.02.03.04.05', 'contact@robetfils.com', 'Robert Dubois');

-- --------------------------------------------------------

--
-- Structure de la table `deldet`
--

CREATE TABLE IF NOT EXISTS `deldet` (
  `detiddet` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant',
  `famidfam` int(11) NOT NULL COMMENT 'famille',
  `detlblib` varchar(255) NOT NULL COMMENT 'libelle',
  `detnbmou` int(11) NOT NULL COMMENT 'montant unitaire',
  `detnbqtt` int(11) NOT NULL COMMENT 'quantite',
  `detnbmar` int(11) NOT NULL COMMENT 'marge',
  `dvsiddvs` int(11) NOT NULL COMMENT 'id devis',
  `dettxdcl` text NOT NULL COMMENT 'description client',
  PRIMARY KEY (`detiddet`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Table des lignes de detail' AUTO_INCREMENT=1 ;

--
-- Contenu de la table `deldet`
--


-- --------------------------------------------------------

--
-- Structure de la table `deldvs`
--

CREATE TABLE IF NOT EXISTS `deldvs` (
  `dvsiddvs` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant',
  `dvsnbmgl` int(11) NOT NULL COMMENT 'marge globale',
  `dvsdtcre` date NOT NULL COMMENT 'date creation',
  `dvsidusr` int(11) NOT NULL COMMENT 'utilisateur',
  `dvsdtexp` date NOT NULL COMMENT 'date expiration',
  `cliidcli` int(11) NOT NULL COMMENT 'id client',
  `dvslblib` varchar(255) NOT NULL COMMENT 'libelle',
  `dvstxdcl` text NOT NULL COMMENT 'description client',
  `dvstxdpr` text NOT NULL COMMENT 'description privée',
  `dvsdtecl` date NOT NULL COMMENT 'date engagement client',
  `dvsdtlcl` date NOT NULL COMMENT 'date livraison client',
  `dvsdtefc` date NOT NULL COMMENT 'date envoi facture',
  `dvsdtrfc` date NOT NULL COMMENT 'date reception facture',
  PRIMARY KEY (`dvsiddvs`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Table des devis' AUTO_INCREMENT=1 ;

--
-- Contenu de la table `deldvs`
--


-- --------------------------------------------------------

--
-- Structure de la table `delfam`
--

CREATE TABLE IF NOT EXISTS `delfam` (
  `famidfam` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant',
  `famidpar` int(11) NOT NULL COMMENT 'id parent',
  `famlblib` varchar(255) NOT NULL COMMENT 'libelle',
  `famlbuni` varchar(32) NOT NULL COMMENT 'unite',
  PRIMARY KEY (`famidfam`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table des familles' AUTO_INCREMENT=4 ;

--
-- Contenu de la table `delfam`
--

INSERT INTO `delfam` (`famidfam`, `famidpar`, `famlblib`, `famlbuni`) VALUES
(1, 0, 'Papier', '500 feuilles'),
(2, 0, 'Livraison', ''),
(3, 0, 'Main d''oeuvre', '1 heure');

-- --------------------------------------------------------

--
-- Structure de la table `delusr`
--

CREATE TABLE IF NOT EXISTS `delusr` (
  `usridusr` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant',
  `usrlbnom` varchar(255) NOT NULL COMMENT 'nom',
  `usrlblgn` varchar(32) NOT NULL COMMENT 'login',
  `usrlbpwd` varchar(32) NOT NULL COMMENT 'mot de passe',
  PRIMARY KEY (`usridusr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='table des utilisateurs' AUTO_INCREMENT=4 ;

--
-- Contenu de la table `delusr`
--

INSERT INTO `delusr` (`usridusr`, `usrlbnom`, `usrlblgn`, `usrlbpwd`) VALUES
(0, 'Administrateur', 'admin', 'admin'),
(2, 'Julien C.', 'julien', 'julien'),
(3, 'Olivier C.', 'oliv', 'oliv');
