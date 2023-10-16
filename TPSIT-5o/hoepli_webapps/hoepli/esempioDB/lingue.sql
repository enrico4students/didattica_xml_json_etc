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

-- Dump della struttura del database provejava
CREATE DATABASE IF NOT EXISTS `provejava` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `provejava`;


-- Dump della struttura di tabella provejava.lingue
CREATE TABLE IF NOT EXISTS `lingue` (
  `lingua` char(20) NOT NULL,
  PRIMARY KEY (`lingua`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dump dei dati della tabella provejava.lingue: ~3 rows (circa)
/*!40000 ALTER TABLE `lingue` DISABLE KEYS */;
INSERT INTO `lingue` (`lingua`) VALUES
	('francese'),
	('inglese'),
	('italiano');
/*!40000 ALTER TABLE `lingue` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
