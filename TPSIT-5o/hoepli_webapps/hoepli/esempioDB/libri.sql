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


-- Dump della struttura di tabella provejava.libri
CREATE TABLE IF NOT EXISTS `libri` (
  `ID_LIBRO` int(4) NOT NULL AUTO_INCREMENT,
  `argomento` char(20) NOT NULL,
  `titolo` char(50) NOT NULL,
  `ISBN` char(17) NOT NULL,
  `lingua` char(50) NOT NULL,
  PRIMARY KEY (`ID_LIBRO`),
  KEY `FK_libri_lingue` (`lingua`),
  KEY `FK_libri_argomenti` (`argomento`),
  CONSTRAINT `FK_libri_argomenti` FOREIGN KEY (`argomento`) REFERENCES `argomenti` (`argomento`),
  CONSTRAINT `FK_libri_lingue` FOREIGN KEY (`lingua`) REFERENCES `lingue` (`lingua`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dump dei dati della tabella provejava.libri: ~24 rows (circa)
/*!40000 ALTER TABLE `libri` DISABLE KEYS */;
INSERT INTO `libri` (`ID_LIBRO`, `argomento`, `titolo`, `ISBN`, `lingua`) VALUES
	(1, 'informatica', 'Informatica in Java', '978-88-203-9999-9', 'italiano'),
	(2, 'linguaggi', 'Il linguaggio in Python', '978-88-203-9998-4', 'italiano'),
	(4, 'hardware', 'Arduino base', '978-88-203-9998-5', 'italiano'),
	(5, 'hardware', 'progettiamo con Arduino', '978-88-203-9998-6', 'italiano'),
	(6, 'hardware', 'Hard Arduino', '978-88-203-9998-7', 'inglese'),
	(7, 'hardware', 'Arduino Easy', '978-88-203-9998-8', 'inglese'),
	(8, 'informatica', 'Il linguaggio in C++', '978-88-203-9999-3', 'italiano'),
	(10, 'hardware', 'Informatica in Visual Basic', '978-88-203-9999-1', 'italiano'),
	(11, 'linguaggi', 'Il linguaggio in Java', '978-88-203-9999-2', 'italiano'),
	(12, 'linguaggi', 'Programming in C', '978-88-203-9998-9', 'inglese'),
	(13, 'linguaggi', 'Le Mind Mapping', '978-88-203-5998-8', 'francese'),
	(14, 'linguaggi', 'Le Mind Mapping vol1', '978-88-203-9698-8', 'francese'),
	(15, 'linguaggi', 'Le Mind Mapping vol2', '978-88-203-9998-5', 'francese'),
	(16, 'linguaggi', 'Le Mind Mapping vol3', '978-88-203-2998-8', 'francese'),
	(17, 'informatica', 'Travailler avec un ipad', '978-88-203-9498-8', 'francese'),
	(18, 'informatica', 'Travailler avec un iphone', '978-88-203-2998-8', 'francese'),
	(19, 'linguaggi', 'Travaux pratiques avec WordPress', '978-88-203-9498-8', 'francese'),
	(20, 'informatica', 'Travaux pratiques avec DreamShow', '978-88-203-9298-8', 'francese'),
	(21, 'linguaggi', 'Programming in C++', '978-88-203-9398-8', 'inglese'),
	(22, 'linguaggi', 'Informatica in C++', '978-88-203-9299-9', 'italiano'),
	(23, 'hardware', 'Programming in Java', '978-88-203-9948-8', 'inglese'),
	(24, 'cucina', 'gateau flan magique', '978-88-203-9238-8', 'francese'),
	(25, 'cucina', 'resep magic flan cake', '978-88-203-9228-8', 'inglese'),
	(26, 'cucina', 'pizze e focacce', '978-88-203-9128-8', 'italiano');
/*!40000 ALTER TABLE `libri` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
