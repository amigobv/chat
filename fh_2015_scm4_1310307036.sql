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
`channelId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY(`channelId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `Person` (
`userId` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `passwordHash` varchar(128) NOT NULL,
  PRIMARY KEY(`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `message`
--

CREATE TABLE IF NOT EXISTS `Message` (
`messageId` int(11) NOT NULL AUTO_INCREMENT,
  `authorId` int(11) NOT NULL,
  `channelId` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `content` text NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY(`messageId`),
  CONSTRAINT `fk_user_`
    FOREIGN KEY (`authorId`)
    REFERENCES `Person` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_channel_`
    FOREIGN KEY (`channelId`)
    REFERENCES `Channel` (`channelId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `register`
--

CREATE TABLE IF NOT EXISTS `Register` (
`regId` int(11) NOT NULL AUTO_INCREMENT,
  `personId` int(11) NOT NULL,
  `channelId` int(11) NOT NULL,
  PRIMARY KEY(`regId`),
  CONSTRAINT `fk_user`
    FOREIGN KEY (`personId`)
    REFERENCES `fh_2015_scm4_1310307036`.`Person` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_channel`
    FOREIGN KEY (`channelId`)
    REFERENCES `fh_2015_scm4_1310307036`.`Channel` (`channelId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Person` (`firstName`, `lastName`, `username`, `passwordHash`) VALUES ("scm4", "scm4", "scm4", "a8af855d47d091f0376664fe588207f334cdad22");
INSERT INTO `Person` (`firstName`, `lastName`, `username`, `passwordHash`) VALUES ("Sam", "Sample", "Guest", "4e518eab8cf96bffa9e0c66add29c3c0b5a7bad1");

INSERT INTO `Channel` (`name`)  VALUES ("General");
INSERT INTO `Channel` (`name`)  VALUES ("Backend");
INSERT INTO `Channel` (`name`)  VALUES ("Frontend");

INSERT INTO `Register` (`personId`, `channelId`) VALUES (1, 1);
INSERT INTO `Register` (`personId`, `channelId`) VALUES (2, 1);
INSERT INTO `Register` (`personId`, `channelId`) VALUES (2, 2);
INSERT INTO `Register` (`personId`, `channelId`) VALUES (2, 3);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
