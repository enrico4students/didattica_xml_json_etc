-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              10.1.35-MariaDB - mariadb.org binary distribution
-- S.O. server:                  Win32
-- HeidiSQL Versione:            9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dump della struttura del database provajson
CREATE DATABASE IF NOT EXISTS `provajson` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `provajson`;


-- Dump della struttura di tabella provajson.vincitori
CREATE TABLE IF NOT EXISTS `Vincitori` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `NAZIONALI` tinytext,
  `VITTORIE` int(3) DEFAULT NULL,information_schemaprovajsonprovajson
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='per i collaudi in JSON';

-- Dump dei dati della tabella provajson.vincitori: ~8 rows (circa)
/*!40000 ALTER TABLE `vincitori` DISABLE KEYS */;
INSERT INTO `vincitori` (`ID`, `NAZIONALI`, `VITTORIE`) VALUES
	(1, 'Brasile', 5),
	(2, 'Italia', 4),
	(3, 'Francia', 2),
	(4, 'Germania', 4),
	(5, 'Argentina', 2),
	(6, 'Spagna', 1),
	(7, 'Inghilterra', 1),
	(8, 'Uruguay', 2);
/*!40000 ALTER TABLE `vincitori` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
provajson