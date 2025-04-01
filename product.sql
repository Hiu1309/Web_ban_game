-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2025 at 04:03 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `SupplierID` (`SupplierID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`SupplierID`) REFERENCES `supplier` (`SupplierID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
