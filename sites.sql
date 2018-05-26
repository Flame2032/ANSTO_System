-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 22, 2018 at 07:29 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ansto`
--

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

DROP TABLE IF EXISTS `sites`;
CREATE TABLE IF NOT EXISTS `sites` (
  `SiteID` int(11) NOT NULL,
  `siteName` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`SiteID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`SiteID`, `siteName`, `type`) VALUES
(1, 'Lucas Heights', 'ASP'),
(8, 'Warrawong', 'ASP'),
(10, 'Mayfield', 'ASP'),
(18, 'Richmond', 'ASP'),
(23, 'Rockdale', 'ASP'),
(25, 'Cape Grim', 'ASP'),
(31, 'Liverpool', 'ASP'),
(33, 'Liverpool', 'GAS'),
(35, 'Lucas Heights', 'GAS'),
(40, 'Muswellbrook', 'ASP'),
(65, 'Vietnam', 'ASP'),
(81, 'Broome', 'ASP'),
(89, 'Stockton', 'ASP');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
