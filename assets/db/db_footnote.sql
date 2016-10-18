-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 18, 2016 at 03:21 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_footnote`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment_text`, `comment_created`) VALUES
(1, '18_14761119271476111927.0878', 18, 'test comment...', '2016-10-11 00:21:48'),
(2, '18_14761119271476111927.0878', 18, 'test comment 2', '2016-10-11 01:52:53'),
(3, '18_14761110621476111062.2666', 18, 'Test comment din', '2016-10-11 02:08:55'),
(4, '18_14761237591476123759.4153', 18, 'The titles of Washed Out''s breakthrough song and the first single from Paracosm share the two most important words in Ernest Greene''s musical language: feel it. It''s a simple request, as well...', '2016-10-11 02:24:20'),
(5, '18_14761238891476123889.5239', 18, 'The titles of Washed Out''s breakthrough song and the first single from Paracosm share the two most important words in Ernest Greene''s musical language: feel it', '2016-10-11 02:46:56'),
(6, '18_14761238891476123889.5239', 18, 'It''s a simple request, as well...', '2016-10-11 02:47:28'),
(7, '18_14761238891476123889.5239', 18, 'the first single from Paracosm share the two most important words', '2016-10-11 02:50:31'),
(8, '18_14761103141476110314.4506', 18, 'the first single from Paracosm share the two most important words', '2016-10-11 02:54:01'),
(9, '18_14761110621476111062.2666', 18, 'the first single from Paracosm share the two most important words', '2016-10-11 02:54:17'),
(10, '18_14761238891476123889.5239', 18, 'Loves kittens, snowboarding, and can type at 130 WPM.', '2016-10-11 03:02:58'),
(11, '18_14761237591476123759.4153', 18, 'Loves kittens, snowboarding, and can type at 130 WPM.', '2016-10-11 03:04:12'),
(12, '18_14761238891476123889.5239', 18, 'The titles of Washed Out''s breakthrough song and the first single from Paracosm share the two most important words in Ernest Greene''s musical language: feel it', '2016-10-11 03:06:12'),
(13, '18_14761110621476111062.2666', 18, 'The titles of Washed Out''s breakthrough song and the first single from Paracosm share the two most important words in Ernest Greene''s musical language: feel it', '2016-10-11 03:06:46'),
(14, '18_14753402581475340258.9592', 18, 'The titles of Washed Out''s breakthrough song and the first single from Paracosm share the two most important words in Ernest Greene''s musical language: feel it', '2016-10-11 03:07:07'),
(15, '18_14761237591476123759.4153', 18, 'two most important words in Ernest Greene''s', '2016-10-11 03:13:45'),
(16, '18_14761237591476123759.4153', 18, 'The titles of Washed Out''s breakthrough song and the first single from Paracosm share the two most important words in Ernest Greene''s musical language: feel it', '2016-10-11 03:15:33'),
(17, '18_14761105801476110580.6906', 18, 'and a beautiful lake', '2016-10-11 08:32:55'),
(18, '18_14761998691476199869.6616', 18, 'Test comment din', '2016-10-14 20:36:50'),
(19, '18_14761998691476199869.6616', 18, 'The titles of Washed Out''s breakthrough song and the first single from Paracosm share the two most important words in Ernest Greene''s musical language: feel it', '2016-10-15 00:02:28'),
(20, '18_14766001741476600174.5839', 18, 'blah blah', '2016-10-16 15:34:15'),
(21, '18_14766001741476600174.5839', 18, 'test comment', '2016-10-16 15:39:51'),
(22, '18_14765987971476598797.7157', 18, 'commento de gato', '2016-10-16 15:40:19'),
(23, '18_14766001741476600174.5839', 18, 'test comment again', '2016-10-16 15:44:43'),
(24, '18_14766001741476600174.5839', 18, 'test', '2016-10-16 15:49:12'),
(25, '18_14766042721476604272.9516', 18, 'test comment', '2016-10-16 15:51:38'),
(26, '18_14766042721476604272.9516', 18, 'blah blah blah', '2016-10-16 15:52:19'),
(27, '18_14766001741476600174.5839', 18, 'test test test', '2016-10-16 15:53:09'),
(28, '18_14766042721476604272.9516', 18, 'test', '2016-10-16 15:53:28'),
(29, '18_14766042721476604272.9516', 18, 'test comment fix ', '2016-10-16 15:55:22'),
(30, '18_14766042721476604272.9516', 18, 'test', '2016-10-16 16:10:00'),
(31, '39_14766119401476611940.1697', 39, 'test comment', '2016-10-16 17:59:21'),
(32, '39_14766119401476611940.1697', 18, 'nice place!', '2016-10-16 18:00:27'),
(33, '18_14765946581476594658.4796', 39, 'nice!', '2016-10-16 18:47:00'),
(34, '10_14766307311476630731.8907', 18, 'will come and visit.', '2016-10-16 23:13:26'),
(35, '39_14766148901476614890.9179', 39, 'up!', '2016-10-17 00:51:18'),
(36, '39_14766119401476611940.1697', 18, 'test', '2016-10-17 00:52:00'),
(37, '10_14766307311476630731.8907', 18, 'test', '2016-10-17 00:52:47'),
(38, '39_14766148901476614890.9179', 18, 'Up!', '2016-10-17 00:57:23'),
(39, '10_14766307311476630731.8907', 10, 'Up!', '2016-10-17 02:22:16'),
(40, '18_14767139631476713963.8043', 18, 'yes a triangle.', '2016-10-17 22:19:59'),
(41, '41_14767866551476786655.7892', 18, 'Nice place!', '2016-10-18 19:36:33');

-- --------------------------------------------------------

--
-- Table structure for table `hearts`
--

CREATE TABLE `hearts` (
  `hearts_id` int(11) NOT NULL,
  `post_id` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hearts_rating` int(11) NOT NULL,
  `hearts_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hearts`
--

INSERT INTO `hearts` (`hearts_id`, `post_id`, `user_id`, `hearts_rating`, `hearts_created`) VALUES
(21, '18_14749874681474987468.9437', 18, 3, '2016-09-28 01:36:34'),
(22, '18_14749058321474905832.1782', 19, 3, '2016-09-28 01:40:18'),
(23, '18_14749874681474987468.9437', 19, 3, '2016-09-28 01:40:21'),
(24, '19_14749980851474998085.8841', 18, 3, '2016-09-28 01:42:11'),
(25, '18_14750765521475076552.6074', 18, 5, '2016-09-29 00:25:59'),
(26, '18_14750805371475080537.2544', 19, 3, '2016-09-29 00:38:21'),
(27, '19_14750814551475081455.879', 18, 4, '2016-09-29 00:52:58'),
(28, '18_14750805371475080537.2544', 18, 4, '2016-09-29 01:03:23'),
(29, '19_14750814551475081455.879', 19, 5, '2016-09-30 00:07:04'),
(30, '18_14750765021475076502.387', 18, 1, '2016-10-01 20:45:42'),
(31, '18_14749058321474905832.1782', 18, 5, '2016-10-01 20:48:45'),
(32, '10_14747320541474732054.0771', 18, 5, '2016-10-01 20:57:06'),
(33, '10_14747320541474732054.0771', 18, 5, '2016-10-01 20:58:04'),
(35, '10_14747319771474731977.9832', 18, 1, '2016-10-01 22:07:31'),
(36, '19_14750814551475081455.879', 24, 4, '2016-10-01 23:39:10'),
(37, '24_14753366241475336624.5116', 24, 4, '2016-10-02 00:00:42'),
(38, '18_14750805371475080537.2544', 25, 5, '2016-10-02 00:36:24'),
(39, '24_14753384261475338426.4292', 18, 4, '2016-10-02 00:42:19'),
(40, '24_14753383461475338346.7111', 18, 5, '2016-10-02 00:42:39'),
(41, '18_14753402581475340258.9592', 10, 5, '2016-10-05 01:30:40'),
(42, '18_14753402581475340258.9592', 18, 3, '2016-10-05 01:31:19'),
(43, '18_14761238891476123889.5239', 18, 5, '2016-10-11 02:32:06'),
(44, '18_14761237591476123759.4153', 18, 5, '2016-10-11 02:32:50'),
(46, '18_14761110621476111062.2666', 18, 5, '2016-10-11 02:54:14'),
(47, '18_14761119271476111927.0878', 18, 5, '2016-10-13 22:47:52'),
(48, '18_14761998691476199869.6616', 18, 5, '2016-10-13 22:49:19'),
(49, '18_14761105801476110580.6906', 18, 5, '2016-10-13 22:49:47'),
(50, '10_14747320381474732038.6533', 18, 5, '2016-10-13 22:54:40'),
(51, '10_14747303121474730312.0723', 18, 5, '2016-10-13 22:55:10'),
(52, '10_14747311861474731186.9669', 18, 5, '2016-10-13 22:55:44'),
(53, '10_14747318041474731804.3625', 18, 5, '2016-10-13 22:57:50'),
(54, '10_14747318591474731859.2145', 18, 5, '2016-10-13 22:58:27'),
(64, '18_14765987971476598797.7157', 18, 5, '2016-10-16 15:12:46'),
(65, '18_14766001741476600174.5839', 18, 5, '2016-10-16 15:35:43'),
(66, '18_14765941181476594118.2959', 18, 5, '2016-10-16 16:00:33'),
(67, '18_14766042721476604272.9516', 18, 5, '2016-10-16 16:10:03'),
(68, '18_14766042721476604272.9516', 39, 5, '2016-10-16 16:11:45'),
(70, '18_14765974521476597452.9501', 18, 5, '2016-10-16 17:56:43'),
(71, '39_14766119401476611940.1697', 39, 5, '2016-10-16 17:59:03'),
(73, '39_14766119401476611940.1697', 18, 5, '2016-10-16 18:00:18'),
(74, '18_14765946581476594658.4796', 39, 5, '2016-10-16 18:46:56'),
(75, '39_14766148901476614890.9179', 18, 5, '2016-10-16 18:53:10'),
(76, '18_14761103141476110314.4506', 18, 5, '2016-10-16 20:28:07'),
(77, '18_14765968791476596879.8358', 10, 5, '2016-10-16 23:04:24'),
(78, '10_14766307311476630731.8907', 18, 5, '2016-10-16 23:13:08'),
(79, '39_14766148901476614890.9179', 39, 5, '2016-10-17 00:51:08'),
(80, '10_14766307311476630731.8907', 10, 5, '2016-10-17 02:22:07'),
(83, '18_14767139631476713963.8043', 18, 5, '2016-10-18 19:36:03'),
(84, '41_14767866551476786655.7892', 18, 5, '2016-10-18 19:36:20'),
(85, '10_14767054221476705422.8042', 18, 5, '2016-10-18 21:07:28'),
(86, '41_14767866551476786655.7892', 10, 5, '2016-10-18 21:11:43');

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

CREATE TABLE `medias` (
  `media_id` int(11) NOT NULL,
  `post_id` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `media_hash` varchar(250) NOT NULL,
  `media_ext` varchar(100) NOT NULL,
  `media_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medias`
--

INSERT INTO `medias` (`media_id`, `post_id`, `user_id`, `media_hash`, `media_ext`, `media_created`) VALUES
(1, '18_14750765521475076552.6074', 18, '1475076552_18_e48d6b9354f17c4db1f0cd3c5bfd9fd5', 'jpg', '2016-09-28 23:29:12'),
(3, '18_14750805371475080537.2544', 18, '1475080537_18_2785d18f424e85c61fe161be8cb69d23', 'jpg', '2016-09-29 00:35:37'),
(4, '19_14750814551475081455.879', 19, '1475081455_19_eb0d8a889d5c98011ebbeb281b6101c6', 'jpg', '2016-09-29 00:50:55'),
(5, '24_14753366241475336624.5116', 0, '1475336624_24_37e78fc2eb19c3b40d9ea752a24cdc69', 'jpg', '2016-10-01 23:43:44'),
(6, '24_14753383461475338346.7111', 0, '1475338346_24_8e01287dd571b466c11a21eb0d23d4dc', 'jpg', '2016-10-02 00:12:26'),
(7, '24_14753384261475338426.4292', 0, '1475338426_24_0aa49f16f378247954a6281cecfcfbb4', 'jpg', '2016-10-02 00:13:46'),
(8, '18_14753402581475340258.9592', 0, '1475340258_18_a1d3f4f4add81a754fbbbc9e3313d87e', 'png', '2016-10-02 00:44:18'),
(9, '18_14756802951475680295.4327', 0, '1475680295_18_487b79eac8011d57ac384dfd1aa960ca', 'jpg', '2016-10-05 23:11:35'),
(10, '18_14761064091476106409.8669', 0, '1476106409_18_d52e25a46c1dec6364de69cc9f80ced9', 'jpg', '2016-10-10 21:33:29'),
(11, '18_14761065061476106506.9227', 0, '1476106506_18_e48d6b9354f17c4db1f0cd3c5bfd9fd5', 'jpg', '2016-10-10 21:35:06'),
(12, '18_14761065071476106507.051', 0, '1476106507_18_e48d6b9354f17c4db1f0cd3c5bfd9fd5', 'jpg', '2016-10-10 21:35:07'),
(13, '18_14761066161476106616.159', 0, '1476106615_18_fe04aa3b50ce355de9ed3a78636e1471', 'png', '2016-10-10 21:36:56'),
(14, '18_14761066161476106616.3812', 0, '1476106616_18_fe04aa3b50ce355de9ed3a78636e1471', 'png', '2016-10-10 21:36:56'),
(15, '18_14761068441476106844.2147', 0, '1476106844_18_e48d6b9354f17c4db1f0cd3c5bfd9fd5', 'jpg', '2016-10-10 21:40:44'),
(16, '18_14761086151476108615.5556', 0, '1476108615_18_e48d6b9354f17c4db1f0cd3c5bfd9fd5', 'jpg', '2016-10-10 22:10:15'),
(17, '18_14761096621476109662.8813', 0, '1476109662_18_e48d6b9354f17c4db1f0cd3c5bfd9fd5', 'jpg', '2016-10-10 22:27:42'),
(18, '18_14761098031476109803.7875', 0, '1476109803_18_e48d6b9354f17c4db1f0cd3c5bfd9fd5', 'jpg', '2016-10-10 22:30:03'),
(19, '18_14761098421476109842.1996', 0, '1476109842_18_e48d6b9354f17c4db1f0cd3c5bfd9fd5', 'jpg', '2016-10-10 22:30:42'),
(20, '18_14761099051476109905.0464', 0, '1476109904_18_e48d6b9354f17c4db1f0cd3c5bfd9fd5', 'jpg', '2016-10-10 22:31:45'),
(21, '18_14761100521476110052.3954', 0, '1476110052_18_e48d6b9354f17c4db1f0cd3c5bfd9fd5', 'jpg', '2016-10-10 22:34:12'),
(22, '18_14761103141476110314.4506', 0, '1476110314_18_e48d6b9354f17c4db1f0cd3c5bfd9fd5', 'jpg', '2016-10-10 22:38:34'),
(23, '18_14761105801476110580.6906', 0, '1476110580_18_e48d6b9354f17c4db1f0cd3c5bfd9fd5', 'jpg', '2016-10-10 22:43:00'),
(24, '18_14761110621476111062.2666', 0, '1476111062_18_9b898f2215212d1871aca8a36590970d', 'jpg', '2016-10-10 22:51:02'),
(25, '18_14761119271476111927.0878', 0, '1476111926_18_9b898f2215212d1871aca8a36590970d', 'jpg', '2016-10-10 23:05:27'),
(26, '18_14761138811476113881.4807', 0, '1476113881_18_eb0d8a889d5c98011ebbeb281b6101c6', 'jpg', '2016-10-10 23:38:01'),
(27, '18_14761139481476113948.5945', 0, '1476113948_18_2785d18f424e85c61fe161be8cb69d23', 'jpg', '2016-10-10 23:39:08'),
(28, '18_14761139921476113992.9287', 0, '1476113992_18_eb0d8a889d5c98011ebbeb281b6101c6', 'jpg', '2016-10-10 23:39:52'),
(29, '18_14761142161476114216.2874', 0, '1476114216_18_eb0d8a889d5c98011ebbeb281b6101c6', 'jpg', '2016-10-10 23:43:36'),
(30, '18_14761142851476114285.6795', 0, '1476114285_18_2785d18f424e85c61fe161be8cb69d23', 'jpg', '2016-10-10 23:44:45'),
(31, '18_14761143391476114339.2176', 0, '1476114339_18_eb0d8a889d5c98011ebbeb281b6101c6', 'jpg', '2016-10-10 23:45:39'),
(32, '18_14761237591476123759.4153', 0, '1476123759_18_2785d18f424e85c61fe161be8cb69d23', 'jpg', '2016-10-11 02:22:39'),
(33, '18_14761238891476123889.5239', 0, '1476123889_18_9b898f2215212d1871aca8a36590970d', 'jpg', '2016-10-11 02:24:49'),
(34, '18_14761998691476199869.6616', 0, '1476199869_18_f074ea2202732e548e1f9e7b0dfaa873', 'png', '2016-10-11 23:31:09'),
(35, '18_14765940631476594063.603', 0, '1476594063_18_6e54e79bb66566f1d4498e0916f6011c', 'jpg', '2016-10-16 13:01:03'),
(36, '18_14765941181476594118.2959', 0, '1476594118_18_6e54e79bb66566f1d4498e0916f6011c', 'jpg', '2016-10-16 13:01:58'),
(37, '18_14765946581476594658.4796', 0, '1476594658_18_0cdd74c11e980c362d7407df3f8c8efa', 'jpg', '2016-10-16 13:10:58'),
(38, '18_14765947891476594789.8176', 0, '1476594789_18_37e6142c97602b38d1370172f05ef2a5', 'jpg', '2016-10-16 13:13:10'),
(39, '18_14765952581476595258.9507', 0, '1476595258_18_0cdd74c11e980c362d7407df3f8c8efa', 'jpg', '2016-10-16 13:20:58'),
(40, '18_14765952971476595297.3258', 0, '1476595297_18_37e6142c97602b38d1370172f05ef2a5', 'jpg', '2016-10-16 13:21:37'),
(41, '18_14765955771476595577.1499', 0, '1476595577_18_37e6142c97602b38d1370172f05ef2a5', 'jpg', '2016-10-16 13:26:17'),
(42, '18_14765956681476595668.5543', 0, '1476595668_18_e36e7d9397fec8cd360976b1986189e4', 'jpg', '2016-10-16 13:27:48'),
(43, '18_14765968791476596879.8358', 0, '1476596879_18_8e6cfdb47d7fe87399641b67f7972561', 'jpg', '2016-10-16 13:47:59'),
(44, '18_14765971661476597166.2927', 0, '1476597166_18_8e6cfdb47d7fe87399641b67f7972561', 'jpg', '2016-10-16 13:52:46'),
(45, '18_14765972191476597219.9424', 0, '1476597219_18_e36e7d9397fec8cd360976b1986189e4', 'jpg', '2016-10-16 13:53:39'),
(46, '18_14765973561476597356.9881', 0, '1476597356_18_e36e7d9397fec8cd360976b1986189e4', 'jpg', '2016-10-16 13:55:57'),
(47, '18_14765974521476597452.9501', 0, '1476597452_18_013546143615198869c7066f8160f8bd', 'jpg', '2016-10-16 13:57:32'),
(48, '18_14765975191476597519.0875', 0, '1476597519_18_521d2c51184f6a4a918d1322077ba5a3', 'jpg', '2016-10-16 13:58:39'),
(49, '18_14765987971476598797.7157', 0, '1476598797_18_521d2c51184f6a4a918d1322077ba5a3', 'jpg', '2016-10-16 14:19:57'),
(50, '18_14766001741476600174.5839', 0, '1476600174_18_e36e7d9397fec8cd360976b1986189e4', 'jpg', '2016-10-16 14:42:54'),
(51, '18_14766042721476604272.9516', 0, '1476604272_18_2785d18f424e85c61fe161be8cb69d23', 'jpg', '2016-10-16 15:51:12'),
(52, '39_14766119401476611940.1697', 0, '1476611940_39_fe2b3f0b30ea362ce5187453f06d5f5d', 'jpg', '2016-10-16 17:59:00'),
(53, '39_14766148901476614890.9179', 0, '1476614890_39_3fb2db6cccf4a23383383394b28b2b31', 'jpg', '2016-10-16 18:48:10'),
(54, '10_14766305891476630589.0086', 0, '1476630589_10_17f67b7cb120caaf03a9516574cdf061', 'jpg', '2016-10-16 23:09:49'),
(55, '10_14766307311476630731.8907', 0, '1476630731_10_41ac10d332a3375c4ebbabeb05610a05', 'jpg', '2016-10-16 23:12:12'),
(56, '10_14767054221476705422.8042', 0, '1476705422_10_6e54e79bb66566f1d4498e0916f6011c', 'jpg', '2016-10-17 19:57:02'),
(57, '18_14767133871476713387.9111', 0, '1476713387_18_fa0e4a9a83a0ba9c64bad7bce6be3cc4', 'jpg', '2016-10-17 22:09:48'),
(58, '18_14767135521476713552.9777', 0, '1476713552_18_1ca10041c928acdf42c211c8a7d87d61', 'jpg', '2016-10-17 22:12:33'),
(59, '18_14767138491476713849.0691', 0, '1476713849_18_7fdc1a630c238af0815181f9faa190f5', 'jpg', '2016-10-17 22:17:29'),
(60, '18_14767139631476713963.8043', 0, '1476713963_18_83112dfc918fb3dc0b4703a5c94724ed', 'jpg', '2016-10-17 22:19:23'),
(61, '41_14767866551476786655.7892', 0, '1476786655_41_b2dcf1ff260611753945739922bfc1c0', 'jpg', '2016-10-18 18:30:55'),
(62, '10_14767964951476796495.5093', 0, '1476796495_10_9e31dcdfe6b5ebe9bbe7c715d5ebeae7', 'jpg', '2016-10-18 21:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_text` text NOT NULL,
  `post_images` varchar(250) NOT NULL,
  `post_metas` text NOT NULL,
  `location` text NOT NULL,
  `lat` text NOT NULL,
  `lng` text NOT NULL,
  `post_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_text`, `post_images`, `post_metas`, `location`, `lat`, `lng`, `post_created`) VALUES
('10_14766305891476630589.0086', 10, 'Laguna Beach is a small coastal city in Orange County, California. It’s known for its many art galleries, coves and beaches. Main Beach features tide pools and a boardwalk leading to the paths and gardens of nearby Heisler Park. Aliso Beach Park is a popular surf spot. The waters off Crystal Cove State Park are designated as an underwater park. Trails meander through coastal canyons in Laguna Coast Wilderness Park.', '', '', '', '', '0', '2016-10-16 23:09:49'),
('10_14766307311476630731.8907', 10, 'Laguna Beach is a small coastal city in Orange County, California. It’s known for its many art galleries, coves and beaches. Main Beach features tide pools and a boardwalk leading to the paths and gardens of nearby Heisler Park. Aliso Beach Park is a popular surf spot. The waters off Crystal Cove State Park are designated as an underwater park. Trails meander through coastal canyons in Laguna Coast Wilderness Park.', '', '', '', '', '0', '2016-10-16 23:12:11'),
('10_14767054221476705422.8042', 10, 'I Love Davao!', '', '', 'Bel-Air, Makati, Metro Manila, Philippines', '14.562844', '121', '2016-10-17 19:57:02'),
('10_14767964951476796495.5093', 10, 'The province has an area of 1,372.98 square kilometres (530.11 sq mi),?[6] ? and covers the entire Bataan Peninsula, a rocky extension of the Zambales Mountains jutting out into the South China Sea, enclosing the Manila Bay. At the northern portion of the peninsula is Mount Natib (elevation 1,253 metres (4,111 ft)) and its surrounding mountains, separated from Mount Samat and the Mariveles Mountains in the south by a pass.[4]\r\n\r\nA narrow coastline plain characterizes the eastern portion of the province, while the western coast features many ridges, cliffs and headlands.[4]', '', '', 'Bel-Air, Makati, Metro Manila, Philippines', '14.5628179', '121.020359', '2016-10-18 21:14:55'),
('18_14750765521475076552.6074', 18, 'Great place.\r\nWe''ll see you soon!', '', '', '', '', '0', '2016-09-28 23:29:12'),
('18_14750805371475080537.2544', 18, 'This place is a must in every traveler''s bucket list when traveling Baguo.', '', '', '', '', '0', '2016-09-29 00:35:37'),
('18_14753402581475340258.9592', 18, 'Death Note', '', '', '', '', '0', '2016-10-02 00:44:18'),
('18_14761103141476110314.4506', 18, 'Test', '', '', '', '', '0', '2016-10-10 22:38:34'),
('18_14761105801476110580.6906', 18, 'Mountain', '', '', '', '', '0', '2016-10-10 22:43:00'),
('18_14761110621476111062.2666', 18, 'Test', '', '', '', '', '0', '2016-10-10 22:51:02'),
('18_14761119271476111927.0878', 18, 'Nature at its finest!', '', '', '', '', '0', '2016-10-10 23:05:27'),
('18_14761237591476123759.4153', 18, '', '', '', '', '', '0', '2016-10-11 02:22:39'),
('18_14761238891476123889.5239', 18, 'The titles of Washed Out''s breakthrough song and the first single from Paracosm share the two most important words in Ernest Greene''s musical language: feel it. It''s a simple request, as well...', '', '', '', '', '0', '2016-10-11 02:24:49'),
('18_14761998691476199869.6616', 18, 'Bean!', '', '', '', '', '0', '2016-10-11 23:31:09'),
('18_14765941181476594118.2959', 18, 'Davao is great!', '', '', '', '', '0', '2016-10-16 13:01:58'),
('18_14765946581476594658.4796', 18, '', '', '', '', '', '0', '2016-10-16 13:10:58'),
('18_14765947891476594789.8176', 18, 'zambales is gorgeous!!!', '', '', '', '', '0', '2016-10-16 13:13:09'),
('18_14765952581476595258.9507', 18, 'morong is <3', '', '', '', '', '0', '2016-10-16 13:20:58'),
('18_14765955771476595577.1499', 18, 'Zambales is <3', '', '', '', '', '0', '2016-10-16 13:26:17'),
('18_14765956681476595668.5543', 18, 'Zambales is <3', '', '', '', '', '0', '2016-10-16 13:27:48'),
('18_14765971661476597166.2927', 18, 'Zambales is <3', '', '', '', '', '0', '2016-10-16 13:52:46'),
('18_14765972191476597219.9424', 18, 'Zambales', '', '', '', '', '0', '2016-10-16 13:53:39'),
('18_14765973561476597356.9881', 18, 'Test', '', '', '', '', '0', '2016-10-16 13:55:56'),
('18_14765975191476597519.0875', 18, 'Japan japan!', '', '', '', '', '0', '2016-10-16 13:58:39'),
('18_14765987971476598797.7157', 18, 'test like', '', '', '', '', '0', '2016-10-16 14:19:57'),
('18_14766001741476600174.5839', 18, '', '', '', '', '', '0', '2016-10-16 14:42:54'),
('18_14766042721476604272.9516', 18, 'Burnham park is love!!! <3', '', '', '', '', '0', '2016-10-16 15:51:12'),
('18_14767133871476713387.9111', 18, 'Makati Mahalin Natin Atin Ito.', '', '', 'Manila, Metro Manila, Philippines', '14.5629489', '121.0206108', '2016-10-17 22:09:47'),
('18_14767135521476713552.9777', 18, 'Lights of Ayala Triangle.', '', '', 'Bel-Air, Makati, Metro Manila, Philippines', '14.562787499999999', '121.0202724', '2016-10-17 22:12:32'),
('18_14767138491476713849.0691', 18, 'View from the top.', '', '', 'Manila, Metro Manila, Philippines', '14.56291', '121.02061330000001', '2016-10-17 22:17:29'),
('18_14767139631476713963.8043', 18, 'A triangle indeed.', '', '', 'Manila, Metro Manila, Philippines', '14.563088400000002', '121.02086299999998', '2016-10-17 22:19:23'),
('19_14749980851474998085.8841', 19, 'Japan is very nice place.\r\nTry it guys!\r\n', '', '', '', '', '0', '2016-09-28 01:41:25'),
('19_14750814551475081455.879', 19, 'Seems like a UFO resting at the edge of this cliff.\r\nIt''s Mine''s View.', '', '', '', '', '0', '2016-09-29 00:50:55'),
('24_14753366241475336624.5116', 24, 'Blue lake!\r\nHad wonderful day in this place.', '', '', '', '', '0', '2016-10-01 23:43:44'),
('24_14753383461475338346.7111', 24, 'Test', '', '', '', '', '0', '2016-10-02 00:12:26'),
('24_14753384261475338426.4292', 24, 'Test 2', '', '', '', '', '0', '2016-10-02 00:13:46'),
('39_14766119401476611940.1697', 39, 'I love palawan!', '', '', '', '', '0', '2016-10-16 17:59:00'),
('39_14766148901476614890.9179', 39, 'Come and visit this place.', '', '', '', '', '0', '2016-10-16 18:48:10'),
('41_14767866551476786655.7892', 41, 'I love Samal!', '', '', 'Bel-Air, Makati, Metro Manila, Philippines', '14.562804399999997', '121.02029529999999', '2016-10-18 18:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `resetTokens`
--

CREATE TABLE `resetTokens` (
  `token` varchar(40) NOT NULL COMMENT 'The Unique Token Generated',
  `uid` int(11) NOT NULL COMMENT 'The User Id',
  `requested` varchar(20) NOT NULL COMMENT 'The Date when token was created'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` tinytext NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `attempt` varchar(15) NOT NULL DEFAULT '0',
  `active` int(2) NOT NULL DEFAULT '0',
  `hash` varchar(332) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `name`, `created`, `attempt`, `active`, `hash`, `level`) VALUES
(10, 'janebrook', 'janebrook@mailinator.com', '$2y$10$vZf/rCI6P98MGlobhCDs/uvXIdVQDB4phozsN1M5qfPwbsViWjCaK', '', '2016-09-20 22:14:32', '0', 1, '', 0),
(18, 'leomar', 'leomarbucud@gmail.com', '$2y$10$vZf/rCI6P98MGlobhCDs/uvXIdVQDB4phozsN1M5qfPwbsViWjCaK', '', '2016-09-26 21:44:42', '0', 1, '5ef059938ba799aaa845e1c2e8a762bd', 1),
(19, 'luvley', 'luvley@email.com', '$2y$10$pZSxbzrsfvcNwZdRhRe94.sKykOvPLjsm.s.MA/EAEJYpbQ0fTYgy', '', '2016-09-28 01:37:56', '0', 1, '47d1e990583c9c67424d369f3414728e', 0),
(25, 'chichi', 'che_alfonso711@yahoo.com', '$2y$10$NkXQIu77gmuxN.k0jRpKAuKIU3aXKM.cWT1NxMoG27IQIa93ha.Tu', '', '2016-10-02 00:31:35', '0', 1, 'ec8956637a99787bd197eacd77acce5e', 0),
(39, 'johndoe', 'leomar101@mailinator.com', '$2y$10$M4M7iQ0Hz6StAV2yj6oXK.ESMYR00mqko/Cd5.oNQmixzLBxObfHe', '', '2016-10-15 21:43:45', '0', 1, '274ad4786c3abca69fa097b85867d9a4', 0),
(40, 'crazybastard', 'crazybastard@mailinator.com', '$2y$10$2wmn1ivv/MrhwK8lPubKUecLNo0ahH4tf0lKY5mWxz7yn.S0Ln1ka', '', '2016-10-16 23:40:33', '0', 1, '2f2b265625d76a6704b08093c652fd79', 0),
(41, 'footnotetest', 'footnotetest@mailinator.com', '$2y$10$1hI8D8CrcP0F9vnlP5Pa8uZY49pK5EO4WvHlTyxuXx.iVUbAQ0yeC', '', '2016-10-18 18:22:45', '0', 1, 'addfa9b7e234254d26e9c7f2af1005cb', 0),
(42, 'admin', 'footnoteadmin@mailinator.com', '$2y$10$MilDufbtzoEroS32MZ8.J.pvEYjkMchP2SRUNPjnfnHbrquUwPfOq', '', '2016-10-18 18:39:33', '0', 1, '819f46e52c25763a55cc642422644317', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `birthdate` text NOT NULL,
  `gender` int(1) NOT NULL DEFAULT '0',
  `bio` text NOT NULL,
  `profile` varchar(250) NOT NULL DEFAULT '1476196571_18_41b586905e6233e72b076191f8bf9512.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `lastname`, `firstname`, `middlename`, `address`, `birthdate`, `gender`, `bio`, `profile`) VALUES
(10, 'Brook', 'Jane', 'Willies', 'Makati City, Ph', '10/18/1987', 1, 'Enjoying life to the fullest....', '1476630244_10_71577389ec229d59da26cc2252f92bc4.jpg'),
(18, 'Bucud', 'Leomar', 'San Buenaventura', 'Makati City', '04/10/1993', 1, 'Because they change things. They push the human race forward.', '1476627600_18_8b63b3c993ac334116d1a50c404fec5d.jpg'),
(19, 'Amouguiz', 'Luvley Mae', 'Moldes', 'Davo City', '0000-00-00', 1, 'Love to travel with my boyfirend.', '1476196571_18_41b586905e6233e72b076191f8bf9512.png'),
(20, '', '', '', '', '0000-00-00', 0, '', ''),
(21, '', '', '', '', '0000-00-00', 0, '', ''),
(22, '', '', '', '', '0000-00-00', 0, '', ''),
(23, '', '', '', '', '0000-00-00', 0, '', ''),
(25, 'Alfonso', 'Cherry Ann', 'Gaviola', 'Guagua, Pampanga', '0000-00-00', 1, 'I love Dubai!', '1476196571_18_41b586905e6233e72b076191f8bf9512.png'),
(36, '', '', '', '', '0000-00-00', 0, '', '1476196571_18_41b586905e6233e72b076191f8bf9512.png'),
(37, '', '', '', '', '0000-00-00', 0, '', '1476196571_18_41b586905e6233e72b076191f8bf9512.png'),
(38, '', '', '', '', '0000-00-00', 0, '', '1476196571_18_41b586905e6233e72b076191f8bf9512.png'),
(39, 'Doe', 'John', '', 'Makati City', '1993-04-10', 0, 'Life is short.', '1476614782_39_f022714c3adea4629d6b7042a2590a34.jpg'),
(40, 'Bastard', 'Crazy', '', 'Manila', '10/27/2016', 0, '', '1476196571_18_41b586905e6233e72b076191f8bf9512.png'),
(41, 'Test', 'Footnote', '', 'Davao City', '07/28/2011', 0, 'I love gathering memories through my travels.', '1476786365_41_82b83e49e702e2d8cd7c49a6b16ff5fd.jpg'),
(42, 'Footnote', 'Admin', '', 'Makati City', '02/23/2016', 0, 'I''m an admin', '1476196571_18_41b586905e6233e72b076191f8bf9512.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_devices`
--

CREATE TABLE `user_devices` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT 'The user''s ID',
  `token` varchar(15) NOT NULL COMMENT 'A unique token for the user''s device',
  `last_access` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `hearts`
--
ALTER TABLE `hearts`
  ADD PRIMARY KEY (`hearts_id`);

--
-- Indexes for table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`media_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);
ALTER TABLE `posts` ADD FULLTEXT KEY `post_text` (`post_text`);
ALTER TABLE `posts` ADD FULLTEXT KEY `location` (`location`);
ALTER TABLE `posts` ADD FULLTEXT KEY `post_text_2` (`post_text`,`location`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);
ALTER TABLE `user_details` ADD FULLTEXT KEY `lastname` (`lastname`);
ALTER TABLE `user_details` ADD FULLTEXT KEY `firstname` (`firstname`);
ALTER TABLE `user_details` ADD FULLTEXT KEY `middlename` (`middlename`);

--
-- Indexes for table `user_devices`
--
ALTER TABLE `user_devices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `hearts`
--
ALTER TABLE `hearts`
  MODIFY `hearts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `medias`
--
ALTER TABLE `medias`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `user_devices`
--
ALTER TABLE `user_devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
