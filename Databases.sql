-- --------------------------------------------------------
-- 主機:                           127.0.0.1
-- 伺服器版本:                        10.4.13-MariaDB - mariadb.org binary distribution
-- 伺服器作業系統:                      Win64
-- HeidiSQL 版本:                  11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- 傾印 ebus 的資料庫結構
CREATE DATABASE IF NOT EXISTS `ebus` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `ebus`;

-- 傾印  資料表 ebus.bus 結構
CREATE TABLE IF NOT EXISTS `bus` (
  `manufacturer` varchar(10) NOT NULL,
  `model` varchar(20) NOT NULL,
  `class` tinyint(3) unsigned zerofill DEFAULT NULL,
  `energy_source` tinyint(4) unsigned zerofill DEFAULT NULL,
  `battery_type` tinyint(4) unsigned zerofill DEFAULT NULL,
  `require_energy` double(22,0) DEFAULT NULL,
  `body_price` int(11) unsigned DEFAULT NULL,
  `battery_price` int(11) DEFAULT NULL,
  `battery_capacity` int(11) DEFAULT NULL,
  `battery_unit_price` int(11) DEFAULT NULL,
  `charge_station_price` int(11) DEFAULT NULL,
  `battery_warranty` int(11) DEFAULT NULL,
  `charge_method` bit(1) DEFAULT NULL,
  `charge_time_min` varchar(50) DEFAULT NULL,
  `charge_time_max` varchar(50) DEFAULT NULL,
  `charge_power1` decimal(10,0) DEFAULT NULL,
  `charge_power2` decimal(10,0) DEFAULT NULL,
  `cooperation` varchar(10) DEFAULT NULL,
  `length` decimal(10,0) DEFAULT NULL,
  `width` decimal(10,0) DEFAULT NULL,
  `height` decimal(10,0) DEFAULT NULL,
  `net_weight` decimal(10,0) DEFAULT NULL,
  `load_weight` decimal(10,0) DEFAULT NULL,
  `num_seat` int(11) DEFAULT NULL,
  `num_stand` int(11) DEFAULT NULL,
  `num_wheelchair` int(11) DEFAULT NULL,
  `durability` decimal(10,0) DEFAULT NULL,
  `maxspeed` int(11) DEFAULT NULL,
  `gradeability` int(11) DEFAULT NULL,
  `motor_power` int(11) DEFAULT NULL,
  `motor_torque` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 正在傾印表格  ebus.bus 的資料：~6 rows (近似值)
DELETE FROM `bus`;
/*!40000 ALTER TABLE `bus` DISABLE KEYS */;
INSERT INTO `bus` (`manufacturer`, `model`, `class`, `energy_source`, `battery_type`, `require_energy`, `body_price`, `battery_price`, `battery_capacity`, `battery_unit_price`, `charge_station_price`, `battery_warranty`, `charge_method`, `charge_time_min`, `charge_time_max`, `charge_power1`, `charge_power2`, `cooperation`, `length`, `width`, `height`, `net_weight`, `load_weight`, `num_seat`, `num_stand`, `num_wheelchair`, `durability`, `maxspeed`, `gradeability`, `motor_power`, `motor_torque`) VALUES
	('凱勝綠能', 'K9A', 000, 0001, 0000, 121, 7800000, 5800000, 324, 17901, 700000, 8, b'1', '4', '5', 0, 0, '中國比亞迪', 12, 3, 3, 14100, 18300, 29, 0, 0, 250, 70, 20, 180, 700),
	('創奕能源', '12米低地板', 000, 0001, 0000, 93, 6420000, 2880000, 240, 12000, 620000, 5, b'1', '3', '6', 60, 80, '廈門金旅', 12, 3, 3, 13600, 16300, 27, 15, 2, 150, 90, 20, 230, 3400),
	('華德動能', 'RAC-700', 000, 0001, 0001, 98, 7000000, 2300000, 282, 8156, 620000, 6, b'1', '4', '6', 30, 60, '自行研發', 12, 3, 3, 12140, 15350, 27, 30, 0, 240, 110, 30, 213, 887),
	('總盈汽車', 'KL5850L', 000, 0001, 0001, 69, 6400000, 1200000, 72, 16667, 620000, 8, b'0', '0.25', '0.25', 0, 0, '廈門金龍', 9, 3, 3, 12000, 14590, 16, 10, 2, 70, 70, 0, 0, 2500),
	('迪吉亞', 'HFF6708KBEV', 001, 0001, 0000, 0, 6800000, 0, 75, 0, 0, 8, b'0', '1', '2', 60, 120, '自行研發', 7, 2, 3, 4980, 8000, 19, 0, 0, 150, 90, 25, 0, 0),
	('創奕能源', '12米低地板', 000, 0001, 0000, 93, 6420000, 2880000, 240, 12000, 620000, 5, b'1', '2', '4', 60, 80, '廈門金旅', 12, 3, 3, 13600, 16300, 27, 15, 2, 150, 90, 20, 230, 3400);
/*!40000 ALTER TABLE `bus` ENABLE KEYS */;


-- 傾印 ebusproject 的資料庫結構
CREATE DATABASE IF NOT EXISTS `ebusproject` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `ebusproject`;

-- 傾印  資料表 ebusproject.oilprice 結構
CREATE TABLE IF NOT EXISTS `oilprice` (
  `transportation` varchar(50) NOT NULL,
  `apikey` varchar(50) DEFAULT NULL,
  `y2019` decimal(12,8) unsigned DEFAULT NULL,
  `y2020` decimal(12,8) unsigned DEFAULT NULL,
  `y2021` decimal(12,8) unsigned DEFAULT NULL,
  `y2022` decimal(12,8) unsigned DEFAULT NULL,
  `y2023` decimal(12,8) unsigned DEFAULT NULL,
  `y2024` decimal(12,8) unsigned DEFAULT NULL,
  `y2025` decimal(12,8) unsigned DEFAULT NULL,
  `y2026` decimal(12,8) unsigned DEFAULT NULL,
  `y2027` decimal(12,8) unsigned DEFAULT NULL,
  `y2028` decimal(12,8) unsigned DEFAULT NULL,
  `y2029` decimal(12,8) unsigned DEFAULT NULL,
  `y2030` decimal(12,8) unsigned DEFAULT NULL,
  `growth` decimal(7,4) DEFAULT NULL,
  PRIMARY KEY (`transportation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 正在傾印表格  ebusproject.oilprice 的資料：~2 rows (近似值)
DELETE FROM `oilprice`;
/*!40000 ALTER TABLE `oilprice` DISABLE KEYS */;
INSERT INTO `oilprice` (`transportation`, `apikey`, `y2019`, `y2020`, `y2021`, `y2022`, `y2023`, `y2024`, `y2025`, `y2026`, `y2027`, `y2028`, `y2029`, `y2030`, `growth`) VALUES
	('E85', '3-AEO2020.27.ref2020-d112119a', 24.53794700, 24.24386400, 29.90951500, 28.42676900, 28.61809900, 28.52007500, 27.86269200, 27.93661100, 28.16201000, 28.42508300, 28.71360800, 30.05789600, 1.9000),
	('Motor_Gasoline', '3-AEO2020.28.ref2020-d112119a', 22.17087200, 21.95442400, 21.97848100, 21.98358000, 21.89487500, 21.60294700, 21.84707500, 22.03165400, 22.30040400, 22.41212100, 22.70756500, 23.41048800, 0.8000),
	('Propane', '3-AEO2020.26.ref2020-d112119a', 16.63491800, 15.56014900, 16.02073100, 16.71264600, 17.15149300, 17.63664400, 18.32980300, 18.99862900, 19.33251800, 19.53301000, 19.62401200, 20.09750200, 1.2000);
/*!40000 ALTER TABLE `oilprice` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
