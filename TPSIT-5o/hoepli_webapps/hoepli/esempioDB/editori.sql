-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              10.4.8-MariaDB - mariadb.org binary distribution
-- S.O. server:                  Win64
-- HeidiSQL Versione:            9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dump della struttura del database provajson
CREATE DATABASE IF NOT EXISTS `provejava` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `provejavaprovejavaprovajsonprovejavaamicilibri`;


-- Dump della struttura di tabella provajson.editori
CREATE TABLE IF NOT EXISTS `editori` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Citta` varchar(50) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dump dei dati della tabella provajson.editori: ~0 rows (circa)
/*!40000 ALTER TABLE `editori` DISABLE KEYS */;
INSERT INTO `editori` (`ID`, `Citta`, `Nome`) VALUES
	(1, 'Milano', 'Hoepli'),
	(2, 'Milano', 'Mondadori'),
	(3, 'Bergamo', 'Atlas'),
	(4, 'Zanichelli', 'Bologna');
/*!40000 ALTER TABLE `editori` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
