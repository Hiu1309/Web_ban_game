-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2025 at 04:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_ban_game_mt3h`
--

-- --------------------------------------------------------

--
-- Table structure for table `type_product`
--

CREATE TABLE `type_product` (
  `TypeID` varchar(10) NOT NULL,
  `ProductID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_product`
--

INSERT INTO `type_product` (`TypeID`, `ProductID`) VALUES
('AC001', 'GAME001'),
('AC001', 'GAME010'),
('AC001', 'GAME015'),
('AC001', 'GAME016'),
('AC001', 'GAME017'),
('AC001', 'GAME039'),
('F2P001', 'GAME024'),
('F2P001', 'GAME025'),
('F2P001', 'GAME026'),
('F2P001', 'GAME027'),
('F2P001', 'GAME028'),
('F2P001', 'GAME029'),
('F2P001', 'GAME030'),
('F2P001', 'GAME031'),
('F2P001', 'GAME035'),
('OW001', 'GAME002'),
('OW001', 'GAME003'),
('OW001', 'GAME004'),
('OW001', 'GAME005'),
('OW001', 'GAME006'),
('OW001', 'GAME007'),
('OW001', 'GAME008'),
('OW001', 'GAME009'),
('OW001', 'GAME011'),
('OW001', 'GAME012'),
('OW001', 'GAME013'),
('OW001', 'GAME014'),
('OW001', 'GAME018'),
('OW001', 'GAME019'),
('OW001', 'GAME020'),
('OW001', 'GAME021'),
('OW001', 'GAME022'),
('OW001', 'GAME023'),
('OW001', 'GAME033'),
('OW001', 'GAME036'),
('RPG001', 'GAME032'),
('RPG001', 'GAME034'),
('RPG001', 'GAME037'),
('RPG001', 'GAME038'),
('RPG001', 'GAME040');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `type_product`
--
ALTER TABLE `type_product`
  ADD PRIMARY KEY (`TypeID`,`ProductID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `type_product`
--
ALTER TABLE `type_product`
  ADD CONSTRAINT `type_product_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
