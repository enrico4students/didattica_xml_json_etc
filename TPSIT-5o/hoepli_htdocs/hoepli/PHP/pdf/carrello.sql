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

-- Dump della struttura del database provephp
CREATE DATABASE IF NOT EXISTS `provephp` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `provephp`;


-- Dump della struttura di tabella provephp.carrello
CREATE TABLE IF NOT EXISTS `carrello` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `Quantita` int(6) unsigned NOT NULL DEFAULT '0',
  `Prezzo` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `Nome` varchar(50) DEFAULT NULL,
  `CodiceArticolo` varchar(30) DEFAULT NULL,
  `Marca` varchar(30) DEFAULT NULL,
  `Descrizione` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dump dei dati della tabella provephp.carrello: ~3 rows (circa)
/*!40000 ALTER TABLE `carrello` DISABLE KEYS */;
INSERT INTO `carrello` (`ID`, `Quantita`, `Prezzo`, `Nome`, `CodiceArticolo`, `Marca`, `Descrizione`) VALUES
	(1, 1, 123.00, 'Stampante laser ', 'EPS_12', 'EPSILON', 'Stampante colori 12pp minuto'),
	(2, 2, 20.20, 'Memoria USB', 'USB_12', 'AZZMEMORY', 'Penna USB 64 GB'),
	(3, 5, 1.15, 'Connettori 15 poli', 'CNS12', 'CBSS', 'Connettori per cablaggio internet');
/*!40000 ALTER TABLE `carrello` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
