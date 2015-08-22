-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Aug 2015 um 16:07
-- Server Version: 5.6.21
-- PHP-Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE SCHEMA IF NOT EXISTS `fh_2015_scm4_1310307036` ;
USE `fh_2015_scm4_1310307036` ;
--
-- Datenbank: `fh_2015_scm4_1310307036`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `channel`
--

CREATE TABLE IF NOT EXISTS `Channel` (
`idChannel` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY(`idChannel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `Person` (
`idUser` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `passwordHash` varchar(128) NOT NULL,
  PRIMARY KEY(`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `message`
--

CREATE TABLE IF NOT EXISTS `Message` (
`idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `idPerson` int(11) NOT NULL,
  `idChannel` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `content` text NOT NULL,
  `important` tinyint(1) NOT NULL,
  PRIMARY KEY(`idMessage`),
  CONSTRAINT `fk_user_`
    FOREIGN KEY (`idPerson`)
    REFERENCES `Person` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_channel_`
    FOREIGN KEY (`idChannel`)
    REFERENCES `Channel` (`idChannel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `register`
--

CREATE TABLE IF NOT EXISTS `Register` (
`idReg` int(11) NOT NULL AUTO_INCREMENT,
  `person` int(11) NOT NULL,
  `channel` int(11) NOT NULL,
  PRIMARY KEY(`idReg`),
  CONSTRAINT `fk_user`
    FOREIGN KEY (`person`)
    REFERENCES `fh_2015_scm4_1310307036`.`Person` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_channel`
    FOREIGN KEY (`channel`)
    REFERENCES `fh_2015_scm4_1310307036`.`Channel` (`idChannel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
