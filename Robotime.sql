-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 20, 2017 at 04:03 AM
-- Server version: 10.1.25-MariaDB
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
-- Database: `Robotime`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `cve_cat` int(1) NOT NULL,
  `nom_cat` varchar(20) COLLATE utf32_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci COMMENT='Categoria de los robots porejemplo siguelineas y drones';

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`cve_cat`, `nom_cat`) VALUES
(1, 'Siguelineas'),
(2, 'Drones');

-- --------------------------------------------------------

--
-- Table structure for table `competidor`
--

CREATE TABLE `competidor` (
  `cve_com` int(5) NOT NULL,
  `nom_com` varchar(30) COLLATE utf32_spanish2_ci NOT NULL,
  `apmat_com` varchar(30) COLLATE utf32_spanish2_ci NOT NULL,
  `appat_com` varchar(30) COLLATE utf32_spanish2_ci NOT NULL,
  `cve_equ` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Dumping data for table `competidor`
--

INSERT INTO `competidor` (`cve_com`, `nom_com`, `apmat_com`, `appat_com`, `cve_equ`) VALUES
(1, '\n				gdfsg', 'sdfgsdf', 'gsdfgsdf', 1),
(2, '\n				david', 'torres ', 'moreno ', 2),
(3, '\n				doris sara', 'montes', 'incin', 2),
(4, '\n				bonnie', 'hermosa', 'bonita', 2);

-- --------------------------------------------------------

--
-- Table structure for table `equipo`
--

CREATE TABLE `equipo` (
  `cve_equ` int(5) NOT NULL,
  `pag_equ` bit(1) NOT NULL,
  `mail_equ` varchar(30) COLLATE utf32_spanish2_ci NOT NULL,
  `tel_equ` int(12) NOT NULL,
  `nom_equ` varchar(25) COLLATE utf32_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Dumping data for table `equipo`
--

INSERT INTO `equipo` (`cve_equ`, `pag_equ`, `mail_equ`, `tel_equ`, `nom_equ`) VALUES
(1, b'0', 'teslado@gmail.com', 51664000, 'los del php'),
(2, b'1', 'teslado@gmail.com', 51664000, 'Tu,bonnie y yo');

-- --------------------------------------------------------

--
-- Table structure for table `ranking`
--

CREATE TABLE `ranking` (
  `cve_rob` int(5) NOT NULL,
  `pun_ran` int(5) NOT NULL DEFAULT '0',
  `time_ran` time NOT NULL,
  `paso_ran` bit(1) NOT NULL DEFAULT b'0',
  `pena_ran` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Dumping data for table `ranking`
--

INSERT INTO `ranking` (`cve_rob`, `pun_ran`, `time_ran`, `paso_ran`, `pena_ran`) VALUES
(1, 0, '00:00:00', b'0', 0),
(2, 0, '00:00:00', b'0', 0),
(3, 0, '00:00:00', b'0', 0),
(4, 0, '00:00:00', b'0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `robot`
--

CREATE TABLE `robot` (
  `cve_cat` int(1) NOT NULL,
  `cve_equ` int(5) NOT NULL,
  `nom_rob` varchar(25) COLLATE utf32_spanish2_ci NOT NULL,
  `cve_rob` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Dumping data for table `robot`
--

INSERT INTO `robot` (`cve_cat`, `cve_equ`, `nom_rob`, `cve_rob`) VALUES
(2, 1, 'sdfgsdf', 1),
(1, 1, 'sfdgsdfgsdf', 2),
(1, 2, 'robobonnie', 3),
(2, 2, 'botsss', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cve_cat`);

--
-- Indexes for table `competidor`
--
ALTER TABLE `competidor`
  ADD PRIMARY KEY (`cve_com`),
  ADD KEY `cve_equ_conts` (`cve_equ`);

--
-- Indexes for table `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`cve_equ`);

--
-- Indexes for table `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`cve_rob`);

--
-- Indexes for table `robot`
--
ALTER TABLE `robot`
  ADD PRIMARY KEY (`cve_rob`),
  ADD KEY `cve_cat_conts` (`cve_cat`),
  ADD KEY `cve_equ1_conts` (`cve_equ`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `competidor`
--
ALTER TABLE `competidor`
  MODIFY `cve_com` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `equipo`
--
ALTER TABLE `equipo`
  MODIFY `cve_equ` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `robot`
--
ALTER TABLE `robot`
  MODIFY `cve_rob` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `competidor`
--
ALTER TABLE `competidor`
  ADD CONSTRAINT `cve_equ_conts` FOREIGN KEY (`cve_equ`) REFERENCES `equipo` (`cve_equ`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ranking`
--
ALTER TABLE `ranking`
  ADD CONSTRAINT `cve_rob_conts` FOREIGN KEY (`cve_rob`) REFERENCES `robot` (`cve_rob`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `robot`
--
ALTER TABLE `robot`
  ADD CONSTRAINT `cve_cat_conts` FOREIGN KEY (`cve_cat`) REFERENCES `categoria` (`cve_cat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cve_equ1_conts` FOREIGN KEY (`cve_equ`) REFERENCES `equipo` (`cve_equ`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
