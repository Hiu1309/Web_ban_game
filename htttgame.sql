-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2025 at 08:48 AM
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
-- Database: `htttgame`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `RoleID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` varchar(10) NOT NULL,
  `Fullname` varchar(50) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(25) DEFAULT NULL,
  `TotalSpending` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_import_invoice`
--

CREATE TABLE `detail_import_invoice` (
  `DetailImportID` varchar(10) NOT NULL,
  `ImportID` varchar(10) DEFAULT NULL,
  `ProductID` varchar(10) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `TotalPrice` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_sales_invoice`
--

CREATE TABLE `detail_sales_invoice` (
  `DetailSalesID` varchar(10) NOT NULL,
  `SalesID` varchar(10) DEFAULT NULL,
  `ProductID` varchar(10) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `TotalPrice` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` varchar(10) NOT NULL,
  `Fullname` varchar(50) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `BirthDay` date DEFAULT NULL,
  `Phone` varchar(10) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Gender` enum('Nam','Nữ') DEFAULT NULL,
  `Salary` double DEFAULT NULL,
  `StartDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `GenreID` varchar(10) NOT NULL,
  `GenreName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genre_detail`
--

CREATE TABLE `genre_detail` (
  `ProductID` varchar(10) NOT NULL,
  `GenreID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `import_invoice`
--

CREATE TABLE `import_invoice` (
  `ImportID` varchar(10) NOT NULL,
  `EmployeeID` varchar(10) DEFAULT NULL,
  `SupplierID` varchar(10) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `TotalPrice` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `Permission_id` varchar(10) NOT NULL,
  `Permission_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` varchar(10) NOT NULL,
  `ProductName` varchar(50) DEFAULT NULL,
  `ProductImg` varchar(255) DEFAULT NULL,
  `Author` varchar(50) DEFAULT NULL,
  `Publisher` varchar(50) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `SupplierID` varchar(10) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `ProductImg`, `Author`, `Publisher`, `Quantity`, `Price`, `Description`, `SupplierID`, `Status`) VALUES
('GAME001', 'Cyberpunk 2077', '/Assets/Images/Game/cyberpunk.jpg', 'CD Projekt Red', 'CD Projekt', 100, 1499099, 'Game nhập vai thế giới mở', 'SUP001', 'Available'),
('GAME002', 'Red Dead Redemption', '/Assets/Images/Game/red_dead.jpg', 'Rockstar Games', 'Rockstar Games', 200, 1274000, 'Game phiêu lưu hành động thế giới mở', 'SUP002', 'Available'),
('GAME003', 'Skyrim', '/Assets/Images/Game/skyrim.jpg', 'Bethesda Softworks', 'Bethesda Softworks', 150, 1020000, 'Game nhập vai thế giới mở với nhiều lựa chọn', 'SUP003', 'Available'),
('GAME004', 'The Last of Us', '/Assets/Images/Game/last_of_us.jpg', 'Naughty Dog', 'Sony Computer Entertainment', 120, 1274000, 'Game hành động phiêu lưu với cốt truyện cảm động', 'SUP004', 'Available'),
('GAME005', 'Half-Life ', '/Assets/Images/Game/half_life.jpg', 'Valve Corporation', 'Valve Corporation', 130, 764.745, 'Game bắn súng góc nhìn thứ nhất với cốt truyện hấp dẫn', 'SUP005', 'Available'),
('GAME006', 'The Witcher 3', '/Assets/Images/Game/witcher_3.jpg', 'CD Projekt Red', 'CD Projekt', 80, 1499099, 'Game nhập vai với thế giới mở rộng lớn', 'SUP001', 'Available'),
('GAME007', 'GTA V', '/Assets/Images/Game/gta_v.jpg', 'Rockstar Games', 'Rockstar Games', 250, 1019745, 'Game hành động phiêu lưu trong thế giới mở', 'SUP002', 'Available'),
('GAME008', 'Fallout 4', '/Assets/Images/Game/fallout_4.jpg', 'Bethesda Softworks', 'Bethesda Softworks', 90, 1147009, 'Game nhập vai thế giới mở trong bối cảnh hậu tận thế', 'SUP003', 'Available'),
('GAME009', 'Uncharted ', '/Assets/Images/Games/uncharted.jpg', 'Naughty Dog', 'Sony Computer Entertainment', 110, 1274000, 'Game hành động phiêu lưu với đồ họa tuyệt vời', 'SUP004', 'Available'),
('GAME010', 'Portal 2', '/Assets/Images/Game/portal_2.jpg', 'Valve Corporation', 'Valve Corporation', 95, 509745, 'Game giải đố với cơ chế cổng không gian', 'SUP005', 'Available'),
('GAME011', 'Assassin\'s Creed Valhalla', '/Assets/Images/Game/acvalhalla.jpg', 'Ubisoft', 'Ubisoft', 100, 1529745, 'Game hành động thế giới mở', 'SUP001', 'Available'),
('GAME012', 'Watch Dogs: Legion', '/Assets/Images/Game/watchdogslegion.jpg', 'Ubisoft', 'Ubisoft', 80, 1274000, 'Game hành động phiêu lưu trong thế giới mở', 'SUP002', 'Available'),
('GAME013', 'Far Cry 6', '/Assets/Images/Game/farcry6.jpg', 'Ubisoft', 'Ubisoft', 90, 1529745, 'Game hành động thế giới mở', 'SUP003', 'Available'),
('GAME014', 'Hitman 3', '/Assets/Images/Game/hitman3.jpg', 'IO Interactive', 'IO Interactive', 70, 1274000, 'Game hành động lén lút', 'SUP004', 'Available'),
('GAME015', 'Far Cry 5', '/Assets/Images/Game/farcry5.jpg', 'Ubisoft', 'Ubisoft', 100, 1019745, 'Game hành động phiêu lưu', 'SUP005', 'Available'),
('GAME016', 'TEKKEN 8', '/Assets/Images/Game/tekken8.jpg', 'Sucker Punch Productions', 'Sony Interactive Entertainment', 60, 1529745, 'Game hành động phiêu lưu trong thế giới mở', 'SUP001', 'Available'),
('GAME017', 'Final Fantasy XV', '/Assets/Images/Game/ffxv.jpg', 'Square Enix', 'Square Enix', 85, 1019745, 'Game nhập vai thế giới mở', 'SUP002', 'Available'),
('GAME018', 'Kingdom Come: Deliverance', '/Assets/Images/Game/kingdomcome.jpg', 'Warhorse Studios', 'Deep Silver', 50, 1274000, 'Game nhập vai hành động', 'SUP003', 'Available'),
('GAME019', 'Monster Hunter: World', '/Assets/Images/Game/mhw.jpg', 'Capcom', 'Capcom', 120, 1529745, 'Game nhập vai hành động', 'SUP004', 'Available'),
('GAME020', 'Elden Ring', '/Assets/Images/Game/eldenring.jpg', 'FromSoftware', 'Bandai Namco Entertainment', 75, 1529745, 'Game nhập vai thế giới mở', 'SUP005', 'Available'),
('GAME021', 'Dying Light 2', '/Assets/Images/Game/dyinglight2.jpg', 'Techland', 'Techland', 100, 1274000, 'Game hành động thế giới mở', 'SUP001', 'Available'),
('GAME022', 'Horizon Zero Dawn', '/Assets/Images/Game/horizonzerodawn.jpg', 'Guerrilla Games', 'Sony Interactive Entertainment', 110, 1274000, 'Game hành động nhập vai', 'SUP002', 'Available'),
('GAME023', 'No Man\'s Sky', '/Assets/Images/Game/nms.jpg', 'Hello Games', 'Hello Games', 130, 1019745, 'Game phiêu lưu thế giới mở', 'SUP003', 'Available'),
('GAME024', 'Cyber Hunter', '/Assets/Images/Game/cyberhunter.jpg', 'Nexon', 'Nexon', 100, 0, 'Game free-to-play nhập vai hành động', 'SUP004', 'Available'),
('GAME025', 'PUBG', '/Assets/Images/Game/pubg.jpg', 'PUBG Corporation', 'PUBG Corporation', 200, 764.745, 'Game sinh tồn', 'SUP005', 'Available'),
('GAME026', 'Apex Legends', '/Assets/Images/Game/apexlegends.jpg', 'Respawn Entertainment', 'Electronic Arts', 150, 0, 'Game free-to-play bắn súng', 'SUP001', 'Available'),
('GAME027', 'Infestation: Battle Royale', '/Assets/Images/Game/infestation.jpg', 'Epic Games', 'Epic Games', 250, 0, 'Game free-to-play sinh tồn', 'SUP002', 'Available'),
('GAME028', 'Warframe', '/Assets/Images/Game/warframe.jpg', '\nDigital Extremes', '\nDigital Extremes', 500, 0, 'Game MOBA free-to-play', 'SUP003', 'Available'),
('GAME029', 'Minecraft', '/Assets/Images/Game/minecraft.jpg', 'Mojang Studios', 'Mojang Studios', 300, 509745, 'Game phiêu lưu xây dựng', 'SUP004', 'Available'),
('GAME030', 'Rocket League', '/Assets/Images/Game/rocketleague.jpg', 'Psyonix', 'Psyonix', 200, 509745, 'Game thể thao online', 'SUP005', 'Available'),
('GAME031', 'The Sims 4', '/Assets/Images/Game/thesims4.jpg', 'Riot Games', 'Riot Games', 400, 0, 'Game bắn súng chiến thuật free-to-play', 'SUP001', 'Available'),
('GAME032', 'Hogwarts Legacy', '/Assets/Images/Game/hogwartslegacy.jpg', 'Blizzard Entertainment', 'Blizzard Entertainment', 100, 382245, 'Game nhập vai trực tuyến', 'SUP002', 'Available'),
('GAME033', 'The Division 2', '/Assets/Images/Game/division2.jpg', 'Ubisoft', 'Ubisoft', 150, 1529745, 'Game hành động thế giới mở', 'SUP003', 'Available'),
('GAME034', 'Borderlands 3', '/Assets/Images/Game/borderlands3.jpg', 'Gearbox Software', '2K Games', 180, 1274000, 'Game hành động nhập vai', 'SUP004', 'Available'),
('GAME035', 'Call of Duty: Warzone', '/Assets/Images/Game/codwarzone.jpg', 'Activision', 'Activision', 500, 0, 'Game bắn súng free-to-play', 'SUP005', 'Available'),
('GAME036', 'Shadow of the Tomb Raider', '/Assets/Images/Game/shadowoftombraider.jpg', 'Crystal Dynamics', 'Square Enix', 80, 1274000, 'Game hành động phiêu lưu', 'SUP001', 'Available'),
('GAME037', 'Dragon Age: Inquisition', '/Assets/Images/Game/dragonageinquisition.jpg', 'BioWare', 'Electronic Arts', 60, 1529745, 'Game nhập vai thế giới mở', 'SUP002', 'Available'),
('GAME038', 'Divinity: Original Sin 2', '/Assets/Images/Game/divinityoriginalsin2.jpg', 'Larian Studios', 'Larian Studios', 55, 1274000, 'Game nhập vai chiến thuật', 'SUP003', 'Available'),
('GAME039', 'Star Wars Jedi: Fallen Order', '/Assets/Images/Game/starwarsjedi.jpg', 'Respawn Entertainment', 'Electronic Arts', 90, 1529745, 'Game hành động phiêu lưu', 'SUP004', 'Available'),
('GAME040', 'Enshrouded', '/Assets/Images/Game/enshrouded.jpg', 'Capcom', 'Capcom', 120, 1529745, 'Game nhập vai hành động', 'SUP005', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `RoleID` varchar(10) NOT NULL,
  `RoleName` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rolepermissions`
--

CREATE TABLE `rolepermissions` (
  `RoleID` varchar(10) NOT NULL,
  `Permission_id` varchar(10) NOT NULL,
  `Prop` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoice`
--

CREATE TABLE `sales_invoice` (
  `SalesID` varchar(10) NOT NULL,
  `EmployeeID` varchar(10) DEFAULT NULL,
  `CustomerID` varchar(10) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `TotalPrice` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SupplierID` varchar(10) NOT NULL,
  `SupplierName` varchar(50) DEFAULT NULL,
  `Phone` varchar(10) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `Phone`, `Email`, `Address`) VALUES
('SUP001', 'CD Projekt Red', '123456789', 'contact@cdprojekt.com', 'Poland'),
('SUP002', 'Rockstar Games', '987654321', 'info@rockstargames.com', 'USA'),
('SUP003', 'Bethesda Softworks', '654987321', 'support@bethesda.com', 'USA'),
('SUP004', 'Naughty Dog', '321654987', 'hello@naughtydog.com', 'USA'),
('SUP005', 'Valve Corporation', '123123123', 'help@valve.com', 'USA');

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
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `detail_import_invoice`
--
ALTER TABLE `detail_import_invoice`
  ADD PRIMARY KEY (`DetailImportID`),
  ADD KEY `ImportID` (`ImportID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `detail_sales_invoice`
--
ALTER TABLE `detail_sales_invoice`
  ADD PRIMARY KEY (`DetailSalesID`),
  ADD KEY `SalesID` (`SalesID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`GenreID`);

--
-- Indexes for table `genre_detail`
--
ALTER TABLE `genre_detail`
  ADD PRIMARY KEY (`ProductID`,`GenreID`),
  ADD KEY `GenreID` (`GenreID`);

--
-- Indexes for table `import_invoice`
--
ALTER TABLE `import_invoice`
  ADD PRIMARY KEY (`ImportID`),
  ADD KEY `EmployeeID` (`EmployeeID`),
  ADD KEY `SupplierID` (`SupplierID`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`Permission_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `SupplierID` (`SupplierID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `rolepermissions`
--
ALTER TABLE `rolepermissions`
  ADD PRIMARY KEY (`RoleID`,`Permission_id`),
  ADD KEY `Permission_id` (`Permission_id`);

--
-- Indexes for table `sales_invoice`
--
ALTER TABLE `sales_invoice`
  ADD PRIMARY KEY (`SalesID`),
  ADD KEY `EmployeeID` (`EmployeeID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierID`);

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
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `account` (`Username`);

--
-- Constraints for table `detail_import_invoice`
--
ALTER TABLE `detail_import_invoice`
  ADD CONSTRAINT `detail_import_invoice_ibfk_1` FOREIGN KEY (`ImportID`) REFERENCES `import_invoice` (`ImportID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_import_invoice_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_sales_invoice`
--
ALTER TABLE `detail_sales_invoice`
  ADD CONSTRAINT `detail_sales_invoice_ibfk_1` FOREIGN KEY (`SalesID`) REFERENCES `sales_invoice` (`SalesID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_sales_invoice_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `account` (`Username`);

--
-- Constraints for table `genre_detail`
--
ALTER TABLE `genre_detail`
  ADD CONSTRAINT `genre_detail_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `genre_detail_ibfk_2` FOREIGN KEY (`GenreID`) REFERENCES `genre` (`GenreID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `import_invoice`
--
ALTER TABLE `import_invoice`
  ADD CONSTRAINT `import_invoice_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`),
  ADD CONSTRAINT `import_invoice_ibfk_2` FOREIGN KEY (`SupplierID`) REFERENCES `supplier` (`SupplierID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`SupplierID`) REFERENCES `supplier` (`SupplierID`);

--
-- Constraints for table `rolepermissions`
--
ALTER TABLE `rolepermissions`
  ADD CONSTRAINT `rolepermissions_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `role` (`RoleID`),
  ADD CONSTRAINT `rolepermissions_ibfk_2` FOREIGN KEY (`Permission_id`) REFERENCES `permissions` (`Permission_id`);

--
-- Constraints for table `sales_invoice`
--
ALTER TABLE `sales_invoice`
  ADD CONSTRAINT `sales_invoice_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`),
  ADD CONSTRAINT `sales_invoice_ibfk_2` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`);

--
-- Constraints for table `type_product`
--
ALTER TABLE `type_product`
  ADD CONSTRAINT `type_product_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
