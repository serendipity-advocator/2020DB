-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for testDataBase
CREATE DATABASE IF NOT EXISTS `testdatabase` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `testDataBase`;

-- Dumping structure for table testDataBase.bus
CREATE TABLE IF NOT EXISTS `bus` (
  `製造車廠` varchar(10) NOT NULL,
  `車輛型號` varchar(20) NOT NULL,
  `車輛分類` tinyint(3) unsigned zerofill DEFAULT NULL,
  `能量來源` tinyint(4) unsigned zerofill DEFAULT NULL,
  `電池種類` tinyint(4) unsigned zerofill DEFAULT NULL,
  `100Km能源需求` double DEFAULT NULL,
  `車體售價` int(11) unsigned DEFAULT NULL,
  `電池售價` int(11) DEFAULT NULL,
  `電池度數` int(11) DEFAULT NULL,
  `電池單價` int(11) DEFAULT NULL,
  `充電站售價` int(11) DEFAULT NULL,
  `電池保固` int(11) DEFAULT NULL,
  `充電方式` bit(1) DEFAULT NULL,
  `充電時間下限` varchar(50) DEFAULT NULL,
  `充電時間上限` varchar(50) DEFAULT NULL,
  `充電功率1` decimal(10,0) DEFAULT NULL,
  `充電功率2` decimal(10,0) DEFAULT NULL,
  `技術合作` varchar(10) DEFAULT NULL,
  `長` decimal(10,0) DEFAULT NULL,
  `寬` decimal(10,0) DEFAULT NULL,
  `高` decimal(10,0) DEFAULT NULL,
  `空重` decimal(10,0) DEFAULT NULL,
  `滿載重量` decimal(10,0) DEFAULT NULL,
  `座位數` int(11) DEFAULT NULL,
  `站位數` int(11) DEFAULT NULL,
  `輪椅數` int(11) DEFAULT NULL,
  `續航力` decimal(10,0) DEFAULT NULL,
  `最高車速` int(11) DEFAULT NULL,
  `爬坡能力` int(11) DEFAULT NULL,
  `馬達功率` int(11) DEFAULT NULL,
  `馬達扭力` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table testDataBase.bus: ~6 rows (approximately)
DELETE FROM `bus`;
/*!40000 ALTER TABLE `bus` DISABLE KEYS */;
INSERT INTO `bus` (`製造車廠`, `車輛型號`, `車輛分類`, `能量來源`, `電池種類`, `100Km能源需求`, `車體售價`, `電池售價`, `電池度數`, `電池單價`, `充電站售價`, `電池保固`, `充電方式`, `充電時間下限`, `充電時間上限`, `充電功率1`, `充電功率2`, `技術合作`, `長`, `寬`, `高`, `空重`, `滿載重量`, `座位數`, `站位數`, `輪椅數`, `續航力`, `最高車速`, `爬坡能力`, `馬達功率`, `馬達扭力`) VALUES
	('凱勝綠能', 'K9A', 000, 0001, 0000, 121, 7800000, 5800000, 324, 17901, 700000, 8, b'1', '4', '5', 0, 0, '中國比亞迪', 12, 3, 3, 14100, 18300, 29, 0, 0, 250, 70, 20, 180, 700),
	('創奕能源', '12米低地板', 000, 0001, 0000, 93, 6420000, 2880000, 240, 12000, 620000, 5, b'1', '3', '6', 60, 80, '廈門金旅', 12, 3, 3, 13600, 16300, 27, 15, 2, 150, 90, 20, 230, 3400),
	('華德動能', 'RAC-700', 000, 0001, 0001, 98, 7000000, 2300000, 282, 8156, 620000, 6, b'1', '4', '6', 30, 60, '自行研發', 12, 3, 3, 12140, 15350, 27, 30, 0, 240, 110, 30, 213, 887),
	('總盈汽車', 'KL5850L', 000, 0001, 0001, 69, 6400000, 1200000, 72, 16667, 620000, 8, b'0', '0.25', '0.25', 0, 0, '廈門金龍', 9, 3, 3, 12000, 14590, 16, 10, 2, 70, 70, 0, 0, 2500),
	('迪吉亞', 'HFF6708KBEV', 001, 0001, 0000, 0, 6800000, 0, 75, 0, 0, 8, b'0', '1', '2', 60, 120, '自行研發', 7, 2, 3, 4980, 8000, 19, 0, 0, 150, 90, 25, 0, 0),
	('創奕能源', '12米低地板', 000, 0001, 0000, 93, 6420000, 2880000, 240, 12000, 620000, 5, b'1', '2', '4', 60, 80, '廈門金旅', 12, 3, 3, 13600, 16300, 27, 15, 2, 150, 90, 20, 230, 3400);
/*!40000 ALTER TABLE `bus` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
