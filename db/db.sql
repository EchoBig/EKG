-- --------------------------------------------------------
-- Host:                         192.168.10.12
-- Server version:               5.7.31-log - MySQL Community Server (GPL)
-- Server OS:                    Linux
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for ekg
CREATE DATABASE IF NOT EXISTS `ekg` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `ekg`;

-- Dumping structure for table ekg.pb_ekg
CREATE TABLE IF NOT EXISTS `pb_ekg` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id auto run',
  `hn` int(7) unsigned zerofill DEFAULT '0000000' COMMENT 'hn patien',
  `visit` int(1) DEFAULT '1' COMMENT 'hn',
  `filename` text COMMENT 'files name ekg',
  `create_at` datetime DEFAULT NULL COMMENT 'on create',
  PRIMARY KEY (`id`),
  KEY `hn` (`hn`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
