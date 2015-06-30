-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Jun 2015 um 08:19
-- Server Version: 5.5.32
-- PHP-Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `dbproject`
--
CREATE DATABASE IF NOT EXISTS `dbproject` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dbproject`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblbenutzer`
--

CREATE TABLE IF NOT EXISTS `tblbenutzer` (
  `Benutzer_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  `Passwort` varchar(60) NOT NULL,
  PRIMARY KEY (`Benutzer_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `tblbenutzer`
--

INSERT INTO `tblbenutzer` (`Benutzer_ID`, `Name`, `Passwort`) VALUES
(1, 'Admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'Sekretariat', '593277eb017ecbe3d5bc8e552d68ff53'),
(3, 'Lehrer', '18a90f2c2b4484de555feb4b02904a7a');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblkomponent`
--

CREATE TABLE IF NOT EXISTS `tblkomponent` (
  `Komponent_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Lieferant_ID` int(11) NOT NULL,
  `Raum_ID` int(11) NOT NULL,
  `Art_ID` int(11) NOT NULL,
  `Hersteller` varchar(45) DEFAULT NULL,
  `Notiz` varchar(45) DEFAULT NULL,
  `Einkaufsdatum` date DEFAULT NULL,
  `Gewaehrleistungsdauer` int(11) DEFAULT NULL,
  PRIMARY KEY (`Komponent_ID`),
  KEY `fk_tblKomponent_tblLieferant_idx` (`Lieferant_ID`),
  KEY `fk_tblKomponent_tblRaum1_idx` (`Raum_ID`),
  KEY `fk_tblKomponent_tblKomponentenart1_idx` (`Art_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `tblkomponent`
--

INSERT INTO `tblkomponent` (`Komponent_ID`, `Lieferant_ID`, `Raum_ID`, `Art_ID`, `Hersteller`, `Notiz`, `Einkaufsdatum`, `Gewaehrleistungsdauer`) VALUES
(1, 1, 1, 1, 'Chinaware', 'Deluxe', '2015-06-01', 3),
(2, 2, 1, 2, 'Mercedes Benz', 'M3', '2015-06-01', 9999999);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblkomponentenart`
--

CREATE TABLE IF NOT EXISTS `tblkomponentenart` (
  `Art_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Bezeichnung` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Art_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `tblkomponentenart`
--

INSERT INTO `tblkomponentenart` (`Art_ID`, `Bezeichnung`) VALUES
(1, 'Computer'),
(2, 'Beamer'),
(3, 'Drucker'),
(4, 'Dokumentenkamera');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblkomponentenattribut`
--

CREATE TABLE IF NOT EXISTS `tblkomponentenattribut` (
  `Attribut_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Bezeichnung` varchar(45) DEFAULT NULL,
  `Einheit` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Attribut_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `tblkomponentenattribut`
--

INSERT INTO `tblkomponentenattribut` (`Attribut_ID`, `Bezeichnung`, `Einheit`) VALUES
(1, 'Leistung', 'Watt'),
(2, 'Spannung', 'Volt'),
(3, 'Arbeitsspeicher', 'Megabyte'),
(4, 'Volumen', 'Gigabyte');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbllieferant`
--

CREATE TABLE IF NOT EXISTS `tbllieferant` (
  `Lieferant_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `Strasse` varchar(45) DEFAULT NULL,
  `PLZ` int(11) DEFAULT NULL,
  `Ansprechpartner` varchar(45) DEFAULT NULL,
  `URL` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Lieferant_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `tbllieferant`
--

INSERT INTO `tbllieferant` (`Lieferant_ID`, `Name`, `Strasse`, `PLZ`, `Ansprechpartner`, `URL`) VALUES
(1, 'Hanns Enterprise', 'Hans Strasse 4', 76548, 'Herr Hanswurst', 'www.hanns-enterprise.com'),
(2, 'IT', 'Keine strasse', 1, 'Herr Niemand', 'www._.de');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblraum`
--

CREATE TABLE IF NOT EXISTS `tblraum` (
  `Raum_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Bezeichnung` varchar(45) DEFAULT NULL,
  `Notiz` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Raum_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `tblraum`
--

INSERT INTO `tblraum` (`Raum_ID`, `Bezeichnung`, `Notiz`) VALUES
(1, '001', 'IT Labor 1'),
(2, '002', 'IT Labor 2'),
(3, '106', 'Klassenzimmer'),
(4, '666', 'Schulungsraum');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblvorgansart`
--

CREATE TABLE IF NOT EXISTS `tblvorgansart` (
  `Vorgang_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Bezeichnung` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Vorgang_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `tblvorgansart`
--

INSERT INTO `tblvorgansart` (`Vorgang_ID`, `Bezeichnung`) VALUES
(1, 'Einbau'),
(2, 'Ausbau'),
(3, 'Reperatur'),
(4, 'Neubeschaffung');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblzulaessiger_wert`
--

CREATE TABLE IF NOT EXISTS `tblzulaessiger_wert` (
  `Wert_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Von` decimal(11,0) DEFAULT NULL,
  `Bis` decimal(11,0) DEFAULT NULL,
  `Schrittweite` decimal(11,0) DEFAULT NULL,
  `Attribut_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Wert_ID`),
  KEY `fk_tblZulaessiger_Wert_tblKomponentenattribut1_idx` (`Attribut_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblzuordnung_art_attr`
--

CREATE TABLE IF NOT EXISTS `tblzuordnung_art_attr` (
  `Art_ID` int(11) NOT NULL,
  `Attribut_ID` int(11) NOT NULL,
  PRIMARY KEY (`Art_ID`,`Attribut_ID`),
  KEY `fk_tblKomponentenart_has_tblKomponentenattribut_tblKomponen_idx` (`Attribut_ID`),
  KEY `fk_tblKomponentenart_has_tblKomponentenattribut_tblKomponen_idx1` (`Art_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tblzuordnung_art_attr`
--

INSERT INTO `tblzuordnung_art_attr` (`Art_ID`, `Attribut_ID`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblzuordnung_attr_komp`
--

CREATE TABLE IF NOT EXISTS `tblzuordnung_attr_komp` (
  `Attribut_ID` int(11) NOT NULL,
  `Komponent_ID` int(11) NOT NULL,
  `Wert` decimal(45,0) DEFAULT NULL,
  PRIMARY KEY (`Attribut_ID`,`Komponent_ID`),
  KEY `fk_tblKomponentenattribut_has_tblKomponent_tblKomponent1_idx` (`Komponent_ID`),
  KEY `fk_tblKomponentenattribut_has_tblKomponent_tblKomponentenat_idx` (`Attribut_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tblzuordnung_attr_komp`
--

INSERT INTO `tblzuordnung_attr_komp` (`Attribut_ID`, `Komponent_ID`, `Wert`) VALUES
(1, 1, '450'),
(2, 1, '230');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblzuordnung_komp_vorgang`
--

CREATE TABLE IF NOT EXISTS `tblzuordnung_komp_vorgang` (
  `Komponent_ID` int(11) NOT NULL,
  `Vorgang_ID` int(11) NOT NULL,
  `Datum` date NOT NULL,
  `Teilkomponenten_ID` int(11) NOT NULL,
  PRIMARY KEY (`Komponent_ID`,`Teilkomponenten_ID`),
  KEY `fk_tblKomponent_has_tblVorgansart_tblVorgansart1_idx` (`Vorgang_ID`),
  KEY `fk_tblKomponent_has_tblVorgansart_tblKomponent1_idx` (`Komponent_ID`),
  KEY `fk_tblZuordnung_Komp_Vorgang_tblKomponent1_idx` (`Teilkomponenten_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tblkomponent`
--
ALTER TABLE `tblkomponent`
  ADD CONSTRAINT `fk_tblKomponent_tblKomponentenart1` FOREIGN KEY (`Art_ID`) REFERENCES `tblkomponentenart` (`Art_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblKomponent_tblLieferant` FOREIGN KEY (`Lieferant_ID`) REFERENCES `tbllieferant` (`Lieferant_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblKomponent_tblRaum1` FOREIGN KEY (`Raum_ID`) REFERENCES `tblraum` (`Raum_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tblzulaessiger_wert`
--
ALTER TABLE `tblzulaessiger_wert`
  ADD CONSTRAINT `fk_tblZulaessiger_Wert_tblKomponentenattribut1` FOREIGN KEY (`Attribut_ID`) REFERENCES `tblkomponentenattribut` (`Attribut_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tblzuordnung_art_attr`
--
ALTER TABLE `tblzuordnung_art_attr`
  ADD CONSTRAINT `fk_tblKomponentenart_has_tblKomponentenattribut_tblKomponente1` FOREIGN KEY (`Art_ID`) REFERENCES `tblkomponentenart` (`Art_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblKomponentenart_has_tblKomponentenattribut_tblKomponente2` FOREIGN KEY (`Attribut_ID`) REFERENCES `tblkomponentenattribut` (`Attribut_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tblzuordnung_attr_komp`
--
ALTER TABLE `tblzuordnung_attr_komp`
  ADD CONSTRAINT `fk_tblKomponentenattribut_has_tblKomponent_tblKomponent1` FOREIGN KEY (`Komponent_ID`) REFERENCES `tblkomponent` (`Komponent_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblKomponentenattribut_has_tblKomponent_tblKomponentenattr1` FOREIGN KEY (`Attribut_ID`) REFERENCES `tblkomponentenattribut` (`Attribut_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tblzuordnung_komp_vorgang`
--
ALTER TABLE `tblzuordnung_komp_vorgang`
  ADD CONSTRAINT `fk_tblKomponent_has_tblVorgansart_tblKomponent1` FOREIGN KEY (`Komponent_ID`) REFERENCES `tblkomponent` (`Komponent_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblKomponent_has_tblVorgansart_tblVorgansart1` FOREIGN KEY (`Vorgang_ID`) REFERENCES `tblvorgansart` (`Vorgang_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblZuordnung_Komp_Vorgang_tblKomponent1` FOREIGN KEY (`Teilkomponenten_ID`) REFERENCES `tblkomponent` (`Komponent_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
