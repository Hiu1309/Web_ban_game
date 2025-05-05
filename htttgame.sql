-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 04:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

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
  `Password` varchar(100) NOT NULL,
  `RoleID` varchar(10) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1 COMMENT '1: hoạt động, 0: bị khóa',
  `Lock` int(11) NOT NULL DEFAULT 1 COMMENT '1: mở, 0: khóa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`Username`, `Password`, `RoleID`, `Status`, `Lock`) VALUES
('Cao Nam', '$2y$10$PZa.Nok8eP8uJR0gE3UqJeiKu0eGgMDixZTdAj893HWI5b7S/Dlp2', 'R4', 1, 1),
('Công Phượng', '$2y$10$lzOO7uxHwyi4AoGtxcqyj.xm5cRq3RMsrQJWRZtTmUiaOmb/u6K2C', 'R3', 1, 1),
('Hiếu Lê', '$2y$10$CB0M3HsH0Tcmyjf7hwVswuz2DzpayJf9w.wsrE22wXAzc3my57MaG', 'R0', 1, 1),
('Hưng Thịnh', '$2y$10$MeBRrmt153ABGqV.9xfu5.3r6fTyb7TRF1MHDdJFpOCuDGb2hSiKC', 'R4', 1, 1),
('Huyền Nữ', '$2y$10$BUb91yTT3eXOGyCynJG7.OJtjspGFOEcRt9ivxjN5z4MGkl4Xi0gW', 'R4', 1, 1),
('Messi Lionel', '$2y$10$5DLnkgSHp/bO7VPZMxRJEuFWB28ZsKgi2uo2BzXN.JdttGqOoiaZS', 'R4', 1, 1),
('Minh Long', '$2y$10$KLWglgMcpiOrUDjPT57Oi.WEMigTSUmXaiGL/GwFOVUW1XxagY1ei', 'R4', 1, 1),
('Minh Vương', '$2y$10$EwaN6O6CzDt4EXcQ2vfrbe3D1t4jfMdtWMSVbRD84WRNx.1dQRIlS', 'R4', 1, 1),
('My Nơ', '$2y$10$6r/vzhlkX1DIWgiDYJJK2eWqjmu/E8/66shjYsxvGdUY8X4g8uMF.', 'R2', 1, 1),
('ngo hiu', '$2y$10$iM1fTwUt8yAyL1d554nVCuZH2RndeyOhVwwZzepTPfXno.2Towdze', 'R4', 1, 1),
('Ngọc Nhi', '$2y$10$biyEf3V4sNFqwfIXj5O5ZOL5v0yaTCQI/mcVmV04LyhtfRNUE6PPK', 'R4', 1, 1),
('Nguyễn Vũ', '$2y$10$LkXb00SmCfWyJbNhCnWTJ.f.KbmaDjk51JWDdbLhDZgkPQXVeAWbq', 'R4', 1, 1),
('Quốc Khánh', '$2y$10$qgePwbHqo9B7WTDMq6vsDuDA9RgDwI99.0E6TdBmnOTmehwer1Ss.', 'R0', 1, 1),
('Trần My', '$2y$10$2/0VYiuzqqZWqNYNPOwPjOSrqAjcRVaUxb4boKHgt6.D1RuoAIeIi', 'R4', 1, 1),
('van a', '$2y$10$DH6G4q8VvOvcL5y6RAgNUerqxX6fOhIZRDr5dT3oGf/ZhjFkr0OHS', 'R4', 1, 1),
('Đom Đóm', '$2y$10$FndH.CaC/jc8NbaMit5wAOP8gKTVhSkAlPLuMpPFgyNStsAGX7Kyu', 'R1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` varchar(10) NOT NULL,
  `CustomerID` varchar(10) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CartID`, `CustomerID`, `CreatedDate`) VALUES
('CART680eb0', 'MT3H00001', '2025-04-28 05:31:21'),
('CART680eb4', 'MT3H00002', '2025-04-28 05:47:37'),
('CART680eb5', 'MT3H00003', '2025-04-28 05:51:50'),
('CART680eb7', 'MT3H00014', '2025-04-28 06:02:31'),
('CART68138f', 'MT3H00016', '2025-05-01 22:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `CartItemID` int(11) NOT NULL,
  `CartID` varchar(10) NOT NULL,
  `ProductID` varchar(10) NOT NULL,
  `Quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`CartItemID`, `CartID`, `ProductID`, `Quantity`) VALUES
(232, 'CART680eb7', 'GAME029', 1),
(233, 'CART680eb5', 'GAME028', 1);

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

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Fullname`, `Username`, `Email`, `Address`, `Phone`, `TotalSpending`) VALUES
('MT3H00001', 'ngo hiu', 'ngo hiu', 'ngohiu@gmail.com', '36 Lê Lợi, phường Bến Nghé, quận 1', '0878985119', NULL),
('MT3H00002', 'Trần My', 'Trần My', 'tranmy@gmail.com', NULL, NULL, NULL),
('MT3H00003', 'Cao Nam', 'Cao Nam', 'caonam@gmail.com', '71 Đinh Tiên Hoàng', '0900011111', NULL),
('MT3H00004', 'Nguyễn Vũ', 'Nguyễn Vũ', 'nguyenvu@gmail.com', NULL, NULL, NULL),
('MT3H00005', 'Minh Long', 'Minh Long', 'minhlong@gmail.com', NULL, NULL, NULL),
('MT3H00006', 'Hưng Thịnh', 'Hưng Thịnh', 'hungthinh@gmail.com', NULL, NULL, NULL),
('MT3H00007', 'Minh Vương', 'Minh Vương', 'minhvuong@gmail.com', NULL, NULL, NULL),
('MT3H00008', 'Messi Lionel', 'Messi Lionel', 'messi@gmail.com', NULL, NULL, NULL),
('MT3H00009', 'Huyền Nữ', 'Huyền Nữ', 'huyennu@gmail.com', NULL, NULL, NULL),
('MT3H00010', 'Ngọc Nhi', 'Ngọc Nhi', 'ngocnhi@gmail.com', NULL, NULL, NULL),
('MT3H00011', 'Quốc Khánh', 'Quốc Khánh', 'khanhr0@gmail.com', NULL, NULL, NULL),
('MT3H00012', 'Đom Đóm', 'Đom Đóm', 'domr1@gmail.com', NULL, NULL, NULL),
('MT3H00013', 'My Nơ', 'My Nơ', 'nor2@gmail.com', NULL, NULL, NULL),
('MT3H00014', 'Công Phượng', 'Công Phượng', 'phuongr3@gmail.com', NULL, NULL, NULL),
('MT3H00015', 'van a', 'van a', 'vana@gmail.com', NULL, NULL, NULL),
('MT3H00016', 'Hiếu Lê', 'Hiếu Lê', 'hjuiihy67@gmail.com', 'sdadadasdadadsa', '0842498241', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_import_invoice`
--

CREATE TABLE `detail_import_invoice` (
  `DetailImportID` varchar(20) NOT NULL,
  `ImportID` varchar(20) DEFAULT NULL,
  `ProductID` varchar(10) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `TotalPrice` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_import_invoice`
--

INSERT INTO `detail_import_invoice` (`DetailImportID`, `ImportID`, `ProductID`, `Quantity`, `Price`, `TotalPrice`) VALUES
('D289334', 'IMP20250428050415', 'GAME007', 34, 1019745, 34671330),
('D483519', 'IMP20250428050502', 'GAME005', 10, 764745, 7647450),
('D548595', 'IMP20250428050629', 'GAME017', 20, 1019745, 20394900);

-- --------------------------------------------------------

--
-- Table structure for table `detail_sales_invoice`
--

CREATE TABLE `detail_sales_invoice` (
  `DetailSalesID` int(11) NOT NULL,
  `SalesID` int(11) NOT NULL,
  `ProductID` varchar(10) DEFAULT NULL,
  `Order_status` varchar(50) DEFAULT '''Chờ xử lý''',
  `Quantity` int(11) DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `TotalPrice` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_sales_invoice`
--

INSERT INTO `detail_sales_invoice` (`DetailSalesID`, `SalesID`, `ProductID`, `Order_status`, `Quantity`, `Price`, `TotalPrice`) VALUES
(114, 7, 'GAME035', 'Đã duyệt', 1, 0, 0),
(115, 7, 'GAME015', 'Đã duyệt', 1, 1019745, 1019745),
(116, 7, 'GAME037', 'Đã duyệt', 1, 1529745, 1529745),
(117, 8, 'GAME037', 'Đã duyệt', 1, 1529745, 1529745),
(118, 8, 'GAME032', 'Đã duyệt', 2, 382245, 764490),
(119, 8, 'GAME040', 'Đã duyệt', 1, 1529745, 1529745),
(120, 9, 'GAME016', 'Đã duyệt', 1, 1529745, 1529745),
(121, 9, 'GAME017', 'Đã duyệt', 2, 1019745, 2039490),
(122, 9, 'GAME006', 'Đã duyệt', 1, 1499099, 1499099),
(123, 9, 'GAME002', 'Đã duyệt', 1, 1274000, 1274000),
(124, 10, 'GAME038', 'Đã duyệt', 3, 1274000, 3822000),
(125, 10, 'GAME040', 'Đã duyệt', 1, 1529745, 1529745),
(126, 11, 'GAME003', 'Đã hủy', 5, 1020000, 5100000),
(127, 11, 'GAME004', 'Đã hủy', 3, 1274000, 3822000),
(128, 11, 'GAME028', 'Đã hủy', 1, 0, 0),
(129, 11, 'GAME035', 'Đã hủy', 1, 0, 0),
(130, 12, 'GAME040', 'Đã duyệt', 1, 1529745, 1529745),
(131, 12, 'GAME038', 'Đã duyệt', 1, 1274000, 1274000);

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
-- Table structure for table `import_invoice`
--

CREATE TABLE `import_invoice` (
  `ImportID` varchar(20) NOT NULL,
  `EmployeeID` varchar(10) DEFAULT NULL,
  `SupplierID` varchar(10) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `TotalPrice` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `import_invoice`
--

INSERT INTO `import_invoice` (`ImportID`, `EmployeeID`, `SupplierID`, `Date`, `TotalPrice`) VALUES
('IMP20250428050415', NULL, 'SUP002', '2025-04-28', 34671330),
('IMP20250428050502', NULL, 'SUP005', '2025-05-09', 7647450),
('IMP20250428050629', NULL, 'SUP002', '2025-06-07', 20394900);

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
  `Status` int(11) NOT NULL DEFAULT 1 COMMENT '1: hoạt động, 0: ngưng bán',
  `DownloadLink` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `ProductImg`, `Author`, `Publisher`, `Quantity`, `Price`, `Description`, `SupplierID`, `Status`, `DownloadLink`) VALUES
('GAME001', 'Cyberpunk 2077', '/Assets/Images/Game/cyberpunk.jpg', 'CD Projekt Red', 'CD Projekt', 100, 1499099, 'Game nhập vai thế giới mở', 'SUP001', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME002', 'Red Dead Redemption', '/Assets/Images/Game/red_dead.jpg', 'Rockstar Games', 'Rockstar Games', 200, 1274000, 'Game phiêu lưu hành động thế giới mở', 'SUP002', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME003', 'Skyrim', '/Assets/Images/Game/skyrim.jpg', 'Bethesda Softworks', 'Bethesda Softworks', 150, 1020000, 'Game nhập vai thế giới mở với nhiều lựa chọn', 'SUP003', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME004', 'The Last of Us', '/Assets/Images/Game/last_of_us.jpg', 'Naughty Dog', 'Sony Computer Entertainment', 120, 1274000, 'Game hành động phiêu lưu với cốt truyện cảm động', 'SUP004', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME005', 'Half-Life ', '/Assets/Images/Game/half_life.jpg', 'Valve Corporation', 'Valve Corporation', 140, 764745, 'Game bắn súng góc nhìn thứ nhất với cốt truyện hấp dẫn', 'SUP005', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME006', 'The Witcher 3', '/Assets/Images/Game/witcher_3.jpg', 'CD Projekt Red', 'CD Projekt', 80, 1499099, 'Game nhập vai với thế giới mở rộng lớn', 'SUP001', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME007', 'GTA V', '/Assets/Images/Game/gta_v.jpg', 'Rockstar Games', 'Rockstar Games', 284, 1019745, 'Game hành động phiêu lưu trong thế giới mở', 'SUP002', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME008', 'Fallout 4', '/Assets/Images/Game/fallout_4.jpg', 'Bethesda Softworks', 'Bethesda Softworks', 90, 1147009, 'Game nhập vai thế giới mở trong bối cảnh hậu tận thế', 'SUP003', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME009', 'ARK: Survival Ascended', '/Assets/Images/Game/ark.jpg', ' Studio Wildcard', ' Studio Wildcard', 110, 1274000, 'Game hành động phiêu lưu thế giới mở với đồ họa tuyệt vời', 'SUP004', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME010', 'Portal 2', '/Assets/Images/Game/portal_2.jpg', 'Valve Corporation', 'Valve Corporation', 95, 509745, 'Game giải đố với cơ chế cổng không gian', 'SUP005', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME011', 'Assassin\'s Creed Valhalla', '/Assets/Images/Game/acvalhalla.jpg', 'Ubisoft', 'Ubisoft', 100, 1529745, 'Game hành động thế giới mở', 'SUP001', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME012', 'Watch Dogs: Legion', '/Assets/Images/Game/watchdogslegion.jpg', 'Ubisoft', 'Ubisoft', 80, 1274000, 'Game hành động phiêu lưu trong thế giới mở', 'SUP002', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME013', 'Far Cry 6', '/Assets/Images/Game/farcry6.jpg', 'Ubisoft', 'Ubisoft', 90, 1529745, 'Game hành động thế giới mở', 'SUP003', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME014', 'Hitman 3', '/Assets/Images/Game/hitman3.jpg', 'IO Interactive', 'IO Interactive', 70, 1274000, 'Game hành động lén lút', 'SUP004', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME015', 'Far Cry 5', '/Assets/Images/Game/farcry5.jpg', 'Ubisoft', 'Ubisoft', 100, 1019745, 'Game hành động phiêu lưu', 'SUP005', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME016', 'TEKKEN 8', '/Assets/Images/Game/tekken8.jpg', 'Sucker Punch Productions', 'Sony Interactive Entertainment', 60, 1529745, 'Game hành động phiêu lưu trong thế giới mở', 'SUP001', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME017', 'Final Fantasy XV', '/Assets/Images/Game/ffxv.jpg', 'Square Enix', 'Square Enix', 105, 1019745, 'Game nhập vai thế giới mở', 'SUP002', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME018', 'Kingdom Come: Deliverance', '/Assets/Images/Game/kingdomcome.jpg', 'Warhorse Studios', 'Deep Silver', 50, 1274000, 'Game nhập vai hành động', 'SUP003', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME019', 'Monster Hunter: Wild', '/Assets/Images/Game/mhw.jpg', 'Capcom', 'Capcom', 120, 1529745, 'Game nhập vai hành động', 'SUP004', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME020', 'Elden Ring', '/Assets/Images/Game/eldenring.jpg', 'FromSoftware', 'Bandai Namco Entertainment', 75, 1529745, 'Game nhập vai thế giới mở', 'SUP005', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME021', 'Dying Light 2', '/Assets/Images/Game/dyinglight2.jpg', 'Techland', 'Techland', 100, 1274000, 'Game hành động thế giới mở', 'SUP001', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME022', 'Horizon Zero Dawn', '/Assets/Images/Game/horizonzerodawn.jpg', 'Guerrilla Games', 'Sony Interactive Entertainment', 110, 1274000, 'Game hành động nhập vai', 'SUP002', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME023', 'No Man\'s Sky', '/Assets/Images/Game/nms.jpg', 'Hello Games', 'Hello Games', 130, 1019745, 'Game phiêu lưu thế giới mở', 'SUP003', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME024', 'Cyber Hunter', '/Assets/Images/Game/cyberhunter.jpg', 'Nexon', 'Nexon', 100, 0, 'Game free-to-play nhập vai hành động', 'SUP004', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME025', 'PUBG', '/Assets/Images/Game/pubg.jpg', 'PUBG Corporation', 'PUBG Corporation', 200, 764745, 'Game sinh tồn', 'SUP005', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME026', 'Apex Legends', '/Assets/Images/Game/apexlegends.jpg', 'Respawn Entertainment', 'Electronic Arts', 150, 0, 'Game free-to-play bắn súng', 'SUP001', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME027', 'Infestation: Battle Royale', '/Assets/Images/Game/infestation.jpg', 'Epic Games', 'Epic Games', 250, 0, 'Game free-to-play sinh tồn', 'SUP002', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME028', 'Warframe', '/Assets/Images/Game/warframe.jpg', '\nDigital Extremes', '\nDigital Extremes', 500, 0, 'Game MOBA free-to-play', 'SUP003', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME029', 'Minecraft', '/Assets/Images/Game/minecraft.jpg', 'Mojang Studios', 'Mojang Studios', 300, 0, 'Game phiêu lưu xây dựng', 'SUP004', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME030', 'Rocket League', '/Assets/Images/Game/rocketleague.jpg', 'Psyonix', 'Psyonix', 200, 0, 'Game thể thao online', 'SUP005', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME031', 'The Sims 4', '/Assets/Images/Game/thesims4.jpg', 'Riot Games', 'Riot Games', 400, 0, 'Game bắn súng chiến thuật free-to-play', 'SUP001', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME032', 'Hogwarts Legacy', '/Assets/Images/Game/hogwartslegacy.jpg', 'Blizzard Entertainment', 'Blizzard Entertainment', 100, 382245, 'Game nhập vai trực tuyến', 'SUP002', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME033', 'The Division 2', '/Assets/Images/Game/division2.jpg', 'Ubisoft', 'Ubisoft', 150, 1529745, 'Game hành động thế giới mở', 'SUP003', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME034', 'Borderlands 3', '/Assets/Images/Game/borderlands3.jpg', 'Gearbox Software', '2K Games', 180, 1274000, 'Game hành động nhập vai', 'SUP004', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME035', 'Call of Duty: Warzone', '/Assets/Images/Game/codwarzone.jpg', 'Activision', 'Activision', 500, 0, 'Game bắn súng free-to-play', 'SUP005', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME036', 'Shadow of the Tomb Raider', '/Assets/Images/Game/shadowoftombraider.jpg', 'Crystal Dynamics', 'Square Enix', 80, 1274000, 'Game hành động phiêu lưu', 'SUP001', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME037', 'Dragon Age: Inquisition', '/Assets/Images/Game/dragonageinquisition.jpg', 'BioWare', 'Electronic Arts', 60, 1529745, 'Game nhập vai thế giới mở', 'SUP002', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME038', 'Divinity: Original Sin 2', '/Assets/Images/Game/divinityoriginalsin2.jpg', 'Larian Studios', 'Larian Studios', 55, 1274000, 'Game nhập vai chiến thuật', 'SUP003', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME039', 'Star Wars Jedi: Fallen Order', '/Assets/Images/Game/starwarsjedi.jpg', 'Respawn Entertainment', 'Electronic Arts', 90, 1529745, 'Game hành động phiêu lưu', 'SUP004', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing'),
('GAME040', 'Enshrouded', '/Assets/Images/Game/enshrouded.jpg', 'Cpcom', 'Cpcom', 120, 1529745, 'Game nhập vai hành động', 'SUP005', 1, 'https://docs.google.com/document/d/1tgRyQthtW6_qwUVwCK4LA1t_HQF4WkZqNoREpdyD69o/edit?usp=sharing');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `RoleID` varchar(10) NOT NULL,
  `RoleName` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`RoleID`, `RoleName`, `Description`) VALUES
('R0', 'BusinessMa', 'Quản lý doanh nghiệp'),
('R1', 'Admin', 'Quản trị viên phân quyền'),
('R2', 'InventoryControlle', 'Quản lý kho'),
('R3', 'SalesStaff', 'Nhân viên bán hàng'),
('R4', 'Customer', 'Người mua hàng');

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoice`
--

CREATE TABLE `sales_invoice` (
  `SalesID` int(11) NOT NULL,
  `CustomerID` varchar(10) NOT NULL,
  `EmployeeID` varchar(10) DEFAULT NULL,
  `PaymentMethod` varchar(50) DEFAULT NULL,
  `ShippingAddress` text DEFAULT NULL,
  `TotalPrice` double DEFAULT NULL,
  `Note` text DEFAULT NULL,
  `Date` datetime DEFAULT current_timestamp(),
  `Status` varchar(50) NOT NULL DEFAULT 'chờ xử lý'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_invoice`
--

INSERT INTO `sales_invoice` (`SalesID`, `CustomerID`, `EmployeeID`, `PaymentMethod`, `ShippingAddress`, `TotalPrice`, `Note`, `Date`, `Status`) VALUES
(7, 'MT3H00001', NULL, 'payment-option-1', '36 Lê Lợi, phường Bến Nghé, quận 1', 2569490, '', '2025-03-19 00:31:50', 'chờ xử lý'),
(8, 'MT3H00001', NULL, 'payment-option-1', '36 Lê Lợi, phường Bến Nghé, quận 1', 3843980, '', '2025-04-28 00:35:16', 'chờ xử lý'),
(9, 'MT3H00002', NULL, 'payment-option-1', '50 Trần Khánh Dư', 6362334, '', '2025-02-28 00:48:00', 'chờ xử lý'),
(10, 'MT3H00003', NULL, 'payment-option-1', '71 Đinh Tiên Hoàng', 5371745, '', '2025-01-10 00:52:32', 'chờ xử lý'),
(11, 'MT3H00016', NULL, 'payment-option-2', 'sdadadasdadadsa', 8942000, '', '2025-05-01 17:17:28', 'Đã hủy'),
(12, 'MT3H00016', NULL, 'payment-option-1', 'sdadadasdadadsa', 2823745, '', '2025-05-05 04:02:38', 'Đã duyệt');

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
('AC001', 'GAME025'),
('AC001', 'GAME039'),
('F2P001', 'GAME024'),
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
  ADD PRIMARY KEY (`Username`),
  ADD KEY `fk_account_role` (`RoleID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`CartItemID`),
  ADD KEY `CartID` (`CartID`),
  ADD KEY `ProductID` (`ProductID`);

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
-- Indexes for table `import_invoice`
--
ALTER TABLE `import_invoice`
  ADD PRIMARY KEY (`ImportID`),
  ADD KEY `EmployeeID` (`EmployeeID`),
  ADD KEY `SupplierID` (`SupplierID`);

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
-- Indexes for table `sales_invoice`
--
ALTER TABLE `sales_invoice`
  ADD PRIMARY KEY (`SalesID`),
  ADD KEY `CustomerID` (`CustomerID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `CartItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `detail_sales_invoice`
--
ALTER TABLE `detail_sales_invoice`
  MODIFY `DetailSalesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `sales_invoice`
--
ALTER TABLE `sales_invoice`
  MODIFY `SalesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `fk_account_role` FOREIGN KEY (`RoleID`) REFERENCES `role` (`RoleID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`CartID`) REFERENCES `cart` (`CartID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `detail_import_invoice_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `detail_sales_invoice`
--
ALTER TABLE `detail_sales_invoice`
  ADD CONSTRAINT `detail_sales_invoice_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sales` FOREIGN KEY (`SalesID`) REFERENCES `sales_invoice` (`SalesID`) ON DELETE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `account` (`Username`);

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
-- Constraints for table `sales_invoice`
--
ALTER TABLE `sales_invoice`
  ADD CONSTRAINT `sales_invoice_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`),
  ADD CONSTRAINT `sales_invoice_ibfk_2` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`);

--
-- Constraints for table `type_product`
--
ALTER TABLE `type_product`
  ADD CONSTRAINT `type_product_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
