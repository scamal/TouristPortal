-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 08, 2020 at 04:43 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beogradsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `location_ID` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_picture` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longt` double DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `map_embed` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`location_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_ID`, `location_name`, `location_picture`, `location_description`, `longt`, `lat`, `map_embed`) VALUES
(4, 'Vračar historycal', 'https://q-xx.bstatic.com/xdata/images/hotel/max500/155537457.jpg?k=a37f8d2f4d25368d19f5c45c0ba7aa155a252ad3e51d334ece067c659ad79fbb&o=', 'Oldest and the richest part of Belgrade', 20.468902587890625, 44.800108785305724, NULL),
(6, 'Belgrade Waterfront', 'https://live.staticflickr.com/4305/36124324151_9a8ff9449d_b.jpg', 'Newest part of Belgrade with new buildings, parks and pathways located on the left bank of river Sava', 20.450191497802734, 44.80534619095382, NULL),
(9, 'National Assembly of Serbia', 'locationIMG/skupstina-srbije-zgrada-foto-shutterstock11.jpg', 'National assembly of Serbia build in around 1930, it has 250 seats for Serbian political representativs.', 20.466156005859375, 44.811557381269765, NULL),
(10, 'Main bus station Belgrade', 'locationIMG/beograd-as-248-740x4931.jpg', 'Main bus station in Belgrade, hundreds of buses daily leave Belgrade bus station to cities in Serbia and abroad. There are lines in all directions.', 20.453109741210938, 44.80994375397913, NULL),
(11, 'Great War Island', 'locationIMG/beograd-061.jpg', 'Great War Island is located on the confluence of river Sava in the river Danube, famous for untouched nature and beaches. on the ', 20.432510375976562, 44.82884776001609, NULL),
(12, 'Fk Red Star Stadium', 'locationIMG/unnamed1.jpg', 'Most famous stadion in Serbia, home to Red Star footbalers it has 55,000 seats and modern football pitch.', 20.465126037597656, 44.78256610416343, NULL),
(13, 'National Museum', 'locationIMG/photo_1-2-11x1.jpg', 'Museum of Serbian history and culture, recently renovated', 20.459675788879395, 44.816611091590914, NULL),
(15, 'Slavija Square', 'locationIMG/slavija1.jpg', 'Slavija square, modern square with traffic roundabout, park and modern fountain that makes lightshow and sings classic music.', 20.46649932861328, 44.80230124552821, NULL),
(19, 'Church of Saint Sava', 'locationIMG/featured-st_sava_kirche1.jpg', 'Church of Saint Sava is the biggest church in the Balkans , build in the honour of the biggest Serbian religious person in the history who fought for Serbian church independence and for the crown for his brother Stefan', 20.469202995300293, 44.79788578918731, NULL),
(20, 'Avala tower', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Avala_Tower.jpg/450px-Avala_Tower.jpg', 'Avala tower is a tv tower located in the mountain Avala near by Belgrade and it is one of the main tourist attraction because of view of Belgeade from the top of tower', 20.5169677734375, 44.68476556953855, NULL),
(21, 'Skadarlija street', 'locationIMG/c-15237122411.jpg', 'Famous street with a lot of restaurants and pubs where local Serb food is served with musicians', 20.46305537223816, 44.81620772435046, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `location_in_tour`
--

DROP TABLE IF EXISTS `location_in_tour`;
CREATE TABLE IF NOT EXISTS `location_in_tour` (
  `location_in_tour_ID` int(11) NOT NULL AUTO_INCREMENT,
  `tour_ID` int(11) NOT NULL,
  `location_ID` int(11) NOT NULL,
  PRIMARY KEY (`location_in_tour_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location_in_tour`
--

INSERT INTO `location_in_tour` (`location_in_tour_ID`, `tour_ID`, `location_ID`) VALUES
(1, 31, 1),
(2, 31, 2),
(3, 45, 1),
(4, 45, 2),
(5, 46, 1),
(6, 46, 2),
(7, 46, 3),
(8, 47, 20),
(9, 47, 19),
(10, 48, 20),
(11, 48, 21),
(12, 49, 21),
(13, 50, 1),
(14, 50, 13),
(15, 51, 1),
(16, 51, 13),
(17, 52, 21),
(18, 52, 20),
(19, 53, 15),
(20, 53, 19),
(21, 54, 15),
(22, 54, 19),
(23, 55, 20),
(24, 55, 21),
(25, 56, 20),
(26, 56, 21),
(27, 57, 1),
(28, 57, 13),
(29, 58, 20),
(30, 58, 9),
(31, 58, 10),
(32, 59, 21),
(33, 60, 1),
(34, 60, 21),
(35, 61, 13),
(36, 61, 4),
(37, 62, 20),
(38, 62, 21),
(39, 63, 20),
(40, 63, 21),
(41, 64, 1),
(42, 64, 13),
(43, 65, 1),
(44, 65, 4),
(45, 65, 5),
(46, 66, 6),
(47, 66, 9);

-- --------------------------------------------------------

--
-- Table structure for table `scan_stats`
--

DROP TABLE IF EXISTS `scan_stats`;
CREATE TABLE IF NOT EXISTS `scan_stats` (
  `scanID` int(11) NOT NULL AUTO_INCREMENT,
  `scanned` tinyint(1) NOT NULL,
  `device_type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `operating_system` varchar(255) CHARACTER SET latin1 NOT NULL,
  `browser` varchar(255) CHARACTER SET latin1 NOT NULL,
  `country` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown country',
  PRIMARY KEY (`scanID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scan_stats`
--

INSERT INTO `scan_stats` (`scanID`, `scanned`, `device_type`, `operating_system`, `browser`, `country`) VALUES
(1, 0, 'other', 'computer', 'other', 'unknown country'),
(2, 0, 'other', 'computer', 'other', 'unknown country'),
(3, 0, 'Android', 'phone', 'Chrome', 'unknown country'),
(4, 1, 'Android', 'phone', 'Chrome', 'unknown country'),
(5, 1, 'Android', 'phone', 'Chrome', 'unknown country'),
(6, 1, 'Android', 'phone', 'Chrome', 'unknown country'),
(7, 1, 'Android', 'phone', 'Chrome', 'unknown country'),
(8, 0, 'other', 'computer', 'other', 'unknown country'),
(9, 0, 'other', 'computer', 'other', 'unknown country'),
(10, 0, 'other', 'computer', 'other', 'unknown country'),
(11, 0, 'other', 'computer', 'other', 'unknown country'),
(12, 0, 'other', 'computer', 'other', 'unknown country'),
(13, 0, 'other', 'computer', 'other', 'unknown country'),
(14, 0, 'other', 'computer', 'other', 'unknown country'),
(15, 0, 'other', 'computer', 'other', 'unknown country'),
(16, 0, 'other', 'computer', 'other', 'unknown country'),
(17, 0, 'other', 'computer', 'other', 'unknown country'),
(18, 0, 'Android', 'phone', 'Chrome', 'unknown country'),
(19, 0, 'Android', 'phone', 'Chrome', 'unknown country'),
(20, 0, 'Android', 'phone', 'Chrome', 'unknown country'),
(21, 0, 'Android', 'phone', 'Chrome', 'unknown country'),
(22, 1, 'Android', 'phone', 'Chrome', 'unknown country'),
(23, 1, 'Android', 'phone', 'Chrome', 'unknown country'),
(24, 0, 'Android', 'phone', 'Chrome', 'unknown country'),
(25, 0, 'Android', 'phone', 'Chrome', 'unknown country'),
(26, 0, 'Android', 'phone', 'Chrome', 'unknown country');

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

DROP TABLE IF EXISTS `tour`;
CREATE TABLE IF NOT EXISTS `tour` (
  `tour_ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_ID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_IDs` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tour_public` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`tour_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`tour_ID`, `name`, `user_ID`, `location_IDs`, `description`, `tour_public`) VALUES
(66, 'dfdsfsd', 'adm', '6, 9, ', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `user_verified` tinyint(1) DEFAULT NULL,
  `ver_link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `name`, `last_name`, `email`, `admin`, `user_verified`, `ver_link`) VALUES
('adm', '$2y$10$qQcY11OHHzHxq6bxlszzyusjyg2WAmALdhRbPdwl9gfx78HBipH1i', 'adm', 'adm', 'adm@fsdaf.com', 1, 1, ''),
('Belgrade', '$2y$10$Fq5g0yby4M0EBNVjg89H.edkcBcAIiIvKAT4DsckuXcpooVfqRaP.', 'belgrade', 'Tourist', 'TouristPortalBelgrade@gmail.com', NULL, 1, 'localhost/TouristPortal/verifyAccount.php?code=Odq7JPod86MVJ'),
('dsf', '$2y$10$KPK0IBsIe5YUQU9kiZIFB.Vf7j2aV/L5GAO9OG.gynWjQsT5/F1Gq', 'grgs', 'asdfasdf', 'dfds@asdfsd.com', 0, NULL, ''),
('dsfdfds', '$2y$10$Bb6NdkwFT7QwS5D9gshGOOO20/zlklvrnxwPTTef/VN1mD9FsASDy', 'werwer', 'werwer', 'qwerwre@fef.cdsc', 0, NULL, ''),
('gregor', '$2y$10$3k9/mevP5EV.aGgii/3/AOFkJEL9hmHpLwSrgDLD3wVAi4H3XUvM.', 'sdff', 'sdfsd', 'lulic@yahoo.comasdf', NULL, NULL, ''),
('grgo', '$2y$10$khqRaiw1pKbkfMaLx5yKkeU/LXe2bUby8ofuCk4cgvenz6Xn1ylPW', 'greg', 'grego', 'grgo@gmail.com', NULL, NULL, ''),
('grgo1', '$2y$10$tbqK3zC2jgGA9NFum7XiFeTxDMD3wTvydqsmFPNyqeSNTdbgZbWJq', 'gregor', 'sdfsfd', 'lulic.gregor.sdfsdf@gmail.com', NULL, NULL, ''),
('grgo198', '$2y$10$F0bNT4iovZUTwWhA9319jeat../IX9mzx.ZWfeXLX7u7EtTX.0.oW', 'gregor', 'grege', 'gregor@gma.coms', NULL, NULL, ''),
('grgo2', '$2y$10$iyWpm1qXk0egKUcpLLalye.WeH0ZLBF3IizO4jPJJN9kLDnn3Obi6', 'gregor', 'sdfsfd', 'lulic.gregor.sdfsdfs@gmail.com', NULL, NULL, ''),
('grgo3', '$2y$10$SRJWA6qtZFo/vcL6PD0IdOT/AInZEZqsivNcuDqBSwNaF/jNTN4Ou', 'gregor', 'sdfsfd', 'lulic.gregor.sdfsd@gmail.com', NULL, NULL, ''),
('grgor', '$2y$10$TzOg1.UspEubn2Pi327wxu6bwfrZTjNTXDdzZS4mh/AcvqpmzJasW', 'greg', 'greg', 'sdfsdaf@gmail.com', NULL, NULL, ''),
('grgur', '$2y$10$xgshvo5pABRWMKRpcX16X.x/Pb03kciEN8XLIl452PHytJN4XD57e', 'grgo', 'grg', 'grgur@gmail.com', NULL, NULL, ''),
('luk98', '$2y$10$4Sub2fy/a3DVu08KHXpr4O9WiD.3EYYAQ8cNYNrySL2FEkwpQX3YS', 'dsfsdf', 'safdsfa', 'lukacs@gmail.coms', NULL, NULL, ''),
('luka', '$2y$10$rlOuAp8rxuQj9RDpk1.uuuRO8M7VzY5Qs8U2TMt/4PBkefAfG0p/S', 'sdfdsf', 'sdfsdf', 'fsadsadfd@sgdfg.com', NULL, NULL, ''),
('luka1', '$2y$10$SZx7M/aMHFVN2Hwk3r711eh/W.nu60iZqrtzMipEDvYTtA2E9ldde', 'sdfdsf', 'sdfsdf', 'fsadsafd@sgdfg.com', NULL, NULL, ''),
('luka123', '$2y$10$c17FqDV2dcKCLzostciOae.k.wNVXsfMzsnj7S1JpxriRKsA0yv7G', 'luka', 'adam', 'lukacs1@gmail.com', NULL, NULL, ''),
('luka2', '$2y$10$Sm26RYojLQSQeLLIr4TUb.EuuG4ewZu86xgdYeJbR2kbwrdlZFzXm', 'safdasf', 'Adamovic', 'luka@gmail.com', NULL, NULL, ''),
('luka22', '$2y$10$YnJv3nengClEVmeohkUoBOJTD4QGJkYSQy1U5s6iOk3sx7jy3TPIG', 'sdfsf', 'dfd', 'luka22@fds.com', NULL, NULL, ''),
('luka3', '$2y$10$dqjhHM5STjeWH34NaO2PuOlV4INRlVFDwV06g0gvraO0q3Bj1GHNi', 'safdasf', 'Adamovic', 'luka1@gmail.com', NULL, NULL, ''),
('lukaAdm', '$2y$10$F4NbCUYT4DuRhnPf0/AujOzNqeC/PSHvgwZgUWyAoabWmKoawEp4m', 'Luka', 'Adamovic', 'email@gmail.com', 1, NULL, ''),
('lukacs98', '$2y$10$zumE72CV9WClvEP.l5sflu/FCWUJ6YAla6yFxVf2kdW9.EJybGGH.', 'safdasf', 'Adamovic', 'lulic.gregor@gmail.com', NULL, NULL, ''),
('lukasdfsdfsdf', '$2y$10$teV/GemX7pfK7gMaephBtebrLG1NmF5RzdaKyN8qJTpqKkNuP7ifC', 'jjf', 'dsgsdfsdf', 'lukacs@gmail.comsdfsfds', NULL, NULL, ''),
('lukaxs', '$2y$10$J9Mwwa1Pg65ReJHoZSh6L.9IZpvxFdWBGFHEqM1Gxg..SybNaZ09K', 'sdfsf', 'dfsdf', 'lulicg@yahoo.com', NULL, NULL, ''),
('lukcss', '$2y$10$qXieyHNAAgHuMtjfv.EmWe5SLR2nmTf3YypFmGljeqeamWBGHVHG6', 'zxzx', 'xczcx', 'lukacss@gmail.com', NULL, NULL, ''),
('lulic', '$2y$10$bw6pYl3fMg0uqFW7d4GZHuyoP1SjoAb2tTAM3FyYa3pCH3e36/dG.', 'sdfsfsdfs', 'sfsdf', 'lulic.grg@dfdf.com', NULL, NULL, ''),
('lulic1', '$2y$10$wldYTWPuHNRPcuNafEnqretsLXh7yf8ApK/AHQopooFsvcKe2QHx2', 'sdfsf', 'dsfsdf', 'lulic@yahoo.comaxx', NULL, NULL, ''),
('oooo', '$2y$10$rdPl9ycuSnURcSgZIk9vSep1EsQWyPI/NeeJRAFTbkXLc0V7XRupe', 'werew', 'sdfsdf', 'sdffsdf@dsffsdf.oo', NULL, NULL, ''),
('sdfsd', '$2y$10$N6xHPSYRnBnTm5r0Ok0Ua.zpVcg4iUk/grNCtcoRUz5Fv2kcLa4LK', 'dfsd', 'sdfs', 'lulic@yahoo.com', NULL, NULL, ''),
('sdfsddsf', '$2y$10$8zYtfa1UBY6RjafDUwLwlekLRq5EsCI9mCGFIQNJIeWjNlPJ05eIq', 'dfsd', 'sdfs', 'lulic@yahoo.coma', NULL, NULL, ''),
('sdfsddsff', '$2y$10$QJAJ6/1H6FPD/eendI5VYO0izmpfKVg/jgdgtPbbOIn/DElipJCpC', 'dfsd', 'sdfs', 'lulic@yahoo.comas', NULL, NULL, ''),
('sdfsddsfff', '$2y$10$22/UX/W1wOjHaEzR9wCdj.Vy6p.obtPPVMDQ0f69XiB8B84rl4B.y', 'dfsd', 'sdfs', 'lulic@yahoo.comass', 0, NULL, ''),
('sdfsds', '$2y$10$cGqWSVvfSfCGn5V0zMjdouY6W/mJgI3k/5AvNLxXMcNoD1th9pkJS', 'dfsd', 'sdfs', 'lulic@yahoo.comm', NULL, NULL, ''),
('sfdsdfsf', '$2y$10$Fh9U3fmWbpREoCFOMbY4..i5c0D/Hi9nhiq9wIoYkdiJb3iz/6XFC', 'ss', 'dfd', 'sl@lsdf.com', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_tour`
--

DROP TABLE IF EXISTS `user_tour`;
CREATE TABLE IF NOT EXISTS `user_tour` (
  `user_tour_ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_ID` int(11) NOT NULL,
  PRIMARY KEY (`user_tour_ID`),
  KEY `username_2` (`username`),
  KEY `tour_ID` (`tour_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_tour`
--
ALTER TABLE `user_tour`
  ADD CONSTRAINT `user_tour_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `user_tour_ibfk_2` FOREIGN KEY (`tour_ID`) REFERENCES `tour` (`tour_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
