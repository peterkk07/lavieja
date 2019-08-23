-- --------------------------------------------------------
-- Host:                         localhost
-- Mysql version:                 5.7.27
-- Server OS:                    Ubuntu 16.04
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for lavieja
DROP DATABASE IF EXISTS `lavieja`;
CREATE DATABASE IF NOT EXISTS `lavieja` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `lavieja`;

-- Dumping structure for table lavieja.match
DROP TABLE IF EXISTS `match`;
CREATE TABLE IF NOT EXISTS `match` (
                                     `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                     `match_round` tinyint(3) unsigned NOT NULL DEFAULT '1',
                                     `match_status` varchar(50) DEFAULT 'IN_PROGRESS',
                                     `current_player` char(1) DEFAULT 'X',
                                     `match_winner` char(1) DEFAULT NULL,
                                     `a1` char(1) DEFAULT NULL,
                                     `a2` char(1) DEFAULT NULL,
                                     `a3` char(1) DEFAULT NULL,
                                     `b1` char(1) DEFAULT NULL,
                                     `b2` char(1) DEFAULT NULL,
                                     `b3` char(1) DEFAULT NULL,
                                     `c1` char(1) DEFAULT NULL,
                                     `c2` char(1) DEFAULT NULL,
                                     `c3` char(1) DEFAULT NULL,
                                     `colour` varchar(50) DEFAULT NULL,
                                     `updated` DATETIME,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- Dumping structure for table config match
DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
                                      `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                      `colour` varchar(50) DEFAULT NULL,
                                      PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


INSERT INTO config (colour)
VALUES ('#000');

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;