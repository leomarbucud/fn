-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 04, 2016 at 05:07 PM
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
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `airline_id` int(11) NOT NULL,
  `airline_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `outcome_code` int(11) NOT NULL,
  `status_code` int(11) NOT NULL DEFAULT '1',
  `travel_agency_id` int(11) NOT NULL DEFAULT '1',
  `note` text NOT NULL,
  `date_of_booking` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `package_id`, `user_id`, `outcome_code`, `status_code`, `travel_agency_id`, `note`, `date_of_booking`, `date_created`) VALUES
(2, 5, 18, 0, 3, 1, 'Test note', '2016-11-02', '2016-10-31 13:26:45'),
(3, 5, 18, 0, 1, 1, 'Test note', '2016-11-03', '2016-10-31 13:26:45'),
(4, 4, 46, 0, 2, 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.', '2016-11-05', '2016-10-31 13:26:45'),
(5, 5, 46, 0, 4, 1, 'None', '2016-11-26', '2016-10-31 13:26:45'),
(6, 5, 10, 0, 2, 1, 'Pareserve po. bayad ako kalahati', '2016-12-23', '2016-10-31 23:19:14'),
(7, 4, 10, 0, 1, 1, '', '2016-11-25', '2016-11-02 00:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `car_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(41, '41_14767866551476786655.7892', 18, 'Nice place!', '2016-10-18 19:36:33'),
(42, '18_14768409551476840955.8957', 18, 'Nice elephants!', '2016-10-19 09:40:01'),
(43, '18_14767975091476797509.1456', 0, 'test', '2016-10-29 21:48:11'),
(44, '18_14761105801476110580.6906', 18, 'test', '2016-10-30 12:20:08'),
(45, '45_14777543391477754339.0815', 45, 'test', '2016-10-31 15:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `flight_schedules`
--

CREATE TABLE `flight_schedules` (
  `flight_id` int(11) NOT NULL,
  `flight_number` varchar(20) NOT NULL,
  `flight_from` varchar(50) NOT NULL,
  `flight_to` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `depart` time NOT NULL,
  `arrive` time NOT NULL,
  `airline` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flight_schedules`
--

INSERT INTO `flight_schedules` (`flight_id`, `flight_number`, `flight_from`, `flight_to`, `date`, `depart`, `arrive`, `airline`, `date_created`) VALUES
(2, '5J2345', 'Manila', 'Cebu', '2016-12-09', '05:00:00', '13:04:00', 'Cebu Pacific', '2016-12-04 23:36:34');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `gallery_id` int(11) NOT NULL,
  `gallery_name` varchar(250) NOT NULL,
  `gallery_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`gallery_id`, `gallery_name`, `gallery_description`) VALUES
(1, 'Boracay', 'Summer Capital of the Philippines'),
(2, 'Davao City', 'Davao City, on the southern Philippine island of Mindanao'),
(3, 'Baguio City', 'Baguio, on the Philippines’ Luzon island, is a mountain town of universities and resorts.'),
(5, 'Palawan', 'Hmmm');

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
(86, '41_14767866551476786655.7892', 10, 5, '2016-10-18 21:11:43'),
(87, '18_14768409551476840955.8957', 18, 5, '2016-10-19 09:39:26'),
(88, '10_14767973001476797300.5805', 18, 5, '2016-10-19 09:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `hotel_id` int(11) NOT NULL,
  `hotel_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `image_hash` varchar(250) NOT NULL,
  `gallery_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_hash`, `gallery_id`) VALUES
(4, '1477236277_023e8da5298a2dc479d378154d73f8bb.jpg', 1),
(5, '1477237924_24a312b8e223c3e1a54b7e2b171f3a6e.jpg', 2),
(6, '1477237925_6c3ecd94b01602bc580b0d666237eeef.jpg', 2),
(7, '1477237925_bca5bff1b24fc9b3a0c3f920e070589a.png', 2),
(8, '1477396621_50cfe1138f170f2174db66ebbe33787e.jpg', 1),
(9, '1477749504_7819c564b66d3035443e751efb48de0a.jpg', 3),
(10, '1477749504_7e9844f3d7942e4b208898d3571d6526.jpg', 3),
(11, '1477749504_c07108fc9392cc6ab7b9491b4e7f0515.jpg', 3),
(12, '1477921274_7fdc1a630c238af0815181f9faa190f5.jpg', 1),
(13, '1477921274_3fb2db6cccf4a23383383394b28b2b31.jpg', 1),
(14, '1477923412_56c0657c1544a269714cb6ef3fa3cf35.jpg', 5),
(15, '1477923413_e0ade40aca238a1a2507bbc84635c178.jpg', 5),
(16, '1477923413_ed8013a299e9c4b6c79aab6e25622656.jpg', 5),
(17, '1477923413_68d5535b971d558f594f10a5affd0a71.jpeg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `inquiry_id` int(11) NOT NULL,
  `place_from` text NOT NULL,
  `place_togo` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `contact` varchar(20) NOT NULL,
  `type` varchar(30) NOT NULL,
  `additional_note` text NOT NULL,
  `status` varchar(20) DEFAULT 'New',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`inquiry_id`, `place_from`, `place_togo`, `name`, `email`, `contact`, `type`, `additional_note`, `status`, `date_created`) VALUES
(1, 'Manila', 'Davao', 'Leomar Bucud', 'leomarbucud@gmail.com', '092637517871', 'Flight only', 'Note note note....', 'Responded', '2016-12-04 19:57:02'),
(2, 'Manila', 'Davao', 'Leomar Bucud', 'leomarbucud@gmail.com', '092637517871', 'Flight only', 'Test note', 'Responded', '2016-12-04 19:57:02'),
(3, 'Manila', 'Davao', 'Test', 'test101@mailinator.com', '091239090', 'Flight only', 'Test', 'Responded', '2016-12-04 19:57:02');

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
(62, '10_14767964951476796495.5093', 0, '1476796495_10_9e31dcdfe6b5ebe9bbe7c715d5ebeae7', 'jpg', '2016-10-18 21:14:55'),
(63, '10_14767973001476797300.5805', 0, '1476797300_10_32f1dfffe1445788f0a530bf32c9c232', 'jpg', '2016-10-18 21:28:20'),
(64, '18_14767975091476797509.1456', 0, '1476797509_18_be62b8b8f645b66664cc3e85539abaf5', 'jpg', '2016-10-18 21:31:49'),
(65, '18_14767990921476799092.2157', 0, '1476799092_18_7fdc1a630c238af0815181f9faa190f5', 'jpg', '2016-10-18 21:58:12'),
(66, '18_14768409551476840955.8957', 0, '1476840955_18_7a0acabe4a81b794668ec180ee3af888', 'jpg', '2016-10-19 09:35:55'),
(67, '45_14773170451477317045.2356', 0, '1477317045__24a312b8e223c3e1a54b7e2b171f3a6e', 'jpg', '2016-10-24 21:50:45'),
(68, '45_14773171291477317129.7963', 0, '1477317129__6c3ecd94b01602bc580b0d666237eeef', 'jpg', '2016-10-24 21:52:09'),
(69, '45_14773187061477318706.2032', 0, '1477318705__bca5bff1b24fc9b3a0c3f920e070589a', 'png', '2016-10-24 22:18:26'),
(70, '18_14773193131477319313.6754', 0, '1477319313_18_41e0f82a57b4880db8df0cd3fc8e3d13', 'jpg', '2016-10-24 22:28:33'),
(71, '45_14773207061477320706.1327', 0, '1477320705__eb0d8a889d5c98011ebbeb281b6101c6', 'jpg', '2016-10-24 22:51:46'),
(72, '45_14777543391477754339.0815', 0, '1477754338__7819c564b66d3035443e751efb48de0a', 'jpg', '2016-10-29 23:18:59'),
(73, '45_14780171421478017142.7644', 0, '1478017142__68d5535b971d558f594f10a5affd0a71', 'jpeg', '2016-11-02 00:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `package_name` varchar(250) NOT NULL,
  `package_price` double NOT NULL,
  `package_days` int(11) NOT NULL,
  `package_details` text NOT NULL,
  `package_person` int(11) NOT NULL DEFAULT '1',
  `package_accomodation` text NOT NULL,
  `package_transportation` text NOT NULL,
  `package_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `place_id`, `package_name`, `package_price`, `package_days`, `package_details`, `package_person`, `package_accomodation`, `package_transportation`, `package_created`) VALUES
(2, 1, 'Boracay Vacation Package for 2016', 4999.99, 2, 'Boracay hotel/resort accommodation\r\nEXPRESS Roundtrip Transfers Airport to Boracay Resorts - Station 1, 2, 3 (All Inclusive)\r\nExtension nights allowed', 1, 'Hotel', 'Airplane', '2016-10-25 21:24:26'),
(4, 2, 'Everyday trip to Davao', 8999.99, 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.', 1, '', '', '2016-10-25 22:32:30'),
(5, 3, 'Baguio City 3 days and 2 nights package', 3999.99, 3, 'Other details here\r\nnew details', 1, 'Guest house', 'Van', '2016-10-29 22:43:13');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `payment_amount` float NOT NULL,
  `payment_quantity` int(11) NOT NULL,
  `payment_total` double NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `booking_id`, `payment_amount`, `payment_quantity`, `payment_total`, `payment_date`) VALUES
(2, 2, 3999, 2, 7998, '0000-00-00'),
(3, 3, 3999, 2, 7998, '0000-00-00'),
(4, 4, 8999.99, 2, 17999.98, '0000-00-00'),
(5, 5, 3999, 2, 7998, '0000-00-00'),
(6, 6, 3999.99, 1, 3999.99, '0000-00-00'),
(7, 7, 8999.99, 2, 17999.98, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(250) NOT NULL,
  `place_address` varchar(250) NOT NULL,
  `place_details` text NOT NULL,
  `place_image` varchar(250) NOT NULL,
  `gallery_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`place_id`, `place_name`, `place_address`, `place_details`, `place_image`, `gallery_id`) VALUES
(1, 'Boracay', 'Boracay, Plawan, Philippines', 'Summer capital of the Philipines', '1477396257_50cfe1138f170f2174db66ebbe33787e.jpg', 1),
(2, 'Davao City', 'Davao City, Philippines', 'Davao River cuts through the city.', '1477237651_24a312b8e223c3e1a54b7e2b171f3a6e.jpg', 2),
(3, 'Baguio City', 'Baguio City, Philippines', 'Baguio, on the Philippines’ Luzon island, is a mountain town of universities and resorts. ', '1477749213_97d0c53bd53b3e5d394db398bcbe34a0.jpg', 3),
(5, 'Palawan', 'Palawan', 'Vacation', '1477923481_ee369cdfc05818ed472904e6ddbc226e.jpg', 5);

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
  `post_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isApproved` tinyint(4) NOT NULL DEFAULT '0',
  `aName` varchar(50) NOT NULL DEFAULT 'Anonymous'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_text`, `post_images`, `post_metas`, `location`, `lat`, `lng`, `post_created`, `isApproved`, `aName`) VALUES
('10_14766305891476630589.0086', 10, 'Laguna Beach is a small coastal city in Orange County, California. It’s known for its many art galleries, coves and beaches. Main Beach features tide pools and a boardwalk leading to the paths and gardens of nearby Heisler Park. Aliso Beach Park is a popular surf spot. The waters off Crystal Cove State Park are designated as an underwater park. Trails meander through coastal canyons in Laguna Coast Wilderness Park.', '', '', '', '', '0', '2016-10-16 23:09:49', 0, 'Anonymous'),
('10_14766307311476630731.8907', 10, 'Laguna Beach is a small coastal city in Orange County, California. It’s known for its many art galleries, coves and beaches. Main Beach features tide pools and a boardwalk leading to the paths and gardens of nearby Heisler Park. Aliso Beach Park is a popular surf spot. The waters off Crystal Cove State Park are designated as an underwater park. Trails meander through coastal canyons in Laguna Coast Wilderness Park.', '', '', '', '', '0', '2016-10-16 23:12:11', 0, 'Anonymous'),
('10_14767054221476705422.8042', 10, 'I Love Davao!', '', '', 'Bel-Air, Makati, Metro Manila, Philippines', '14.562844', '121', '2016-10-17 19:57:02', 0, 'Anonymous'),
('10_14767964951476796495.5093', 10, 'The province has an area of 1,372.98 square kilometres (530.11 sq mi),?[6] ? and covers the entire Bataan Peninsula, a rocky extension of the Zambales Mountains jutting out into the South China Sea, enclosing the Manila Bay. At the northern portion of the peninsula is Mount Natib (elevation 1,253 metres (4,111 ft)) and its surrounding mountains, separated from Mount Samat and the Mariveles Mountains in the south by a pass.[4]\r\n\r\nA narrow coastline plain characterizes the eastern portion of the province, while the western coast features many ridges, cliffs and headlands.[4]', '', '', 'Bel-Air, Makati, Metro Manila, Philippines', '14.5628179', '121.020359', '2016-10-18 21:14:55', 1, 'Anonymous'),
('10_14767973001476797300.5805', 10, '\r\nPalawan is composed of the long and narrow Palawan Island, plus a number of other smaller islands surrounding the main island. The Calamianes Group of Islands to the Northeast consists of Busuanga Island, Coron Island and Culion Island. Durangan Island (Dulangan) almost touches the westernmost part of Palawan Island, while Balabac Island is located off the southern tip, separated from Borneo by the Balabac Strait. In addition, Palawan covers the Cuyo Islands in the Sulu Sea. The disputed Spratly Islands, located a few hundred kilometres to the west, are considered part of Palawan by the Philippines, and is locally called the "Kalayaan Group of Islands".\r\n\r\n\r\n\r\n\r\nPalawan''s almost 2,000 kilometres (1,200 mi) of irregular coastline are dotted with roughly 1,780 islands and islets, rocky coves, and sugar-white sandy beaches. It also harbors a vast stretch of virgin forests that carpet its chain of mountain ranges. The mountain heights average 3,500 feet (1,100 m) in altitude, with the highest peak rising to 6,843 feet (2,086 m)[9] at Mount Mantalingahan. The vast mountain areas are the source of valuable timber. The terrain is a mix of coastal plain, craggy foothills, valley deltas, and heavy forest interspersed with riverine arteries that serve as irrigation', '', '', 'Bel-Air, Makati, Metro Manila, Philippines', '14.562835999999999', '121.02036460000001', '2016-10-18 21:28:20', 1, 'Anonymous'),
('18_14750805371475080537.2544', 18, 'This place is a must in every traveler''s bucket list when traveling Baguo.', '', '', '', '', '0', '2016-09-29 00:35:37', 1, 'Anonymous'),
('18_14753402581475340258.9592', 18, 'Death Note', '', '', '', '', '0', '2016-10-02 00:44:18', 0, 'Anonymous'),
('18_14761103141476110314.4506', 18, 'Test', '', '', '', '', '0', '2016-10-10 22:38:34', 0, 'Anonymous'),
('18_14761105801476110580.6906', 18, 'Mountain', '', '', '', '', '0', '2016-10-10 22:43:00', 0, 'Anonymous'),
('18_14761110621476111062.2666', 18, 'Test', '', '', '', '', '0', '2016-10-10 22:51:02', 0, 'Anonymous'),
('18_14761119271476111927.0878', 18, 'Nature at its finest!', '', '', '', '', '0', '2016-10-10 23:05:27', 0, 'Anonymous'),
('18_14761237591476123759.4153', 18, '', '', '', '', '', '0', '2016-10-11 02:22:39', 0, 'Anonymous'),
('18_14761238891476123889.5239', 18, 'The titles of Washed Out''s breakthrough song and the first single from Paracosm share the two most important words in Ernest Greene''s musical language: feel it. It''s a simple request, as well...', '', '', '', '', '0', '2016-10-11 02:24:49', 0, 'Anonymous'),
('18_14761998691476199869.6616', 18, 'Bean!', '', '', '', '', '0', '2016-10-11 23:31:09', 0, 'Anonymous'),
('18_14765941181476594118.2959', 18, 'Davao is great!', '', '', '', '', '0', '2016-10-16 13:01:58', 0, 'Anonymous'),
('18_14765946581476594658.4796', 18, '', '', '', '', '', '0', '2016-10-16 13:10:58', 0, 'Anonymous'),
('18_14765947891476594789.8176', 18, 'zambales is gorgeous!!!', '', '', '', '', '0', '2016-10-16 13:13:09', 0, 'Anonymous'),
('18_14765952581476595258.9507', 18, 'morong is <3', '', '', '', '', '0', '2016-10-16 13:20:58', 0, 'Anonymous'),
('18_14765955771476595577.1499', 18, 'Zambales is <3', '', '', '', '', '0', '2016-10-16 13:26:17', 0, 'Anonymous'),
('18_14765956681476595668.5543', 18, 'Zambales is <3', '', '', '', '', '0', '2016-10-16 13:27:48', 0, 'Anonymous'),
('18_14765971661476597166.2927', 18, 'Zambales is <3', '', '', '', '', '0', '2016-10-16 13:52:46', 0, 'Anonymous'),
('18_14765972191476597219.9424', 18, 'Zambales', '', '', '', '', '0', '2016-10-16 13:53:39', 0, 'Anonymous'),
('18_14765973561476597356.9881', 18, 'Test', '', '', '', '', '0', '2016-10-16 13:55:56', 0, 'Anonymous'),
('18_14765975191476597519.0875', 18, 'Japan japan!', '', '', '', '', '0', '2016-10-16 13:58:39', 0, 'Anonymous'),
('18_14765987971476598797.7157', 18, 'test like', '', '', '', '', '0', '2016-10-16 14:19:57', 0, 'Anonymous'),
('18_14766001741476600174.5839', 18, '', '', '', '', '', '0', '2016-10-16 14:42:54', 0, 'Anonymous'),
('18_14766042721476604272.9516', 18, 'Burnham park is love!!! <3', '', '', '', '', '0', '2016-10-16 15:51:12', 0, 'Anonymous'),
('18_14767133871476713387.9111', 18, 'Makati Mahalin Natin Atin Ito.', '', '', 'Manila, Metro Manila, Philippines', '14.5629489', '121.0206108', '2016-10-17 22:09:47', 0, 'Anonymous'),
('18_14767135521476713552.9777', 18, 'Lights of Ayala Triangle.', '', '', 'Bel-Air, Makati, Metro Manila, Philippines', '14.562787499999999', '121.0202724', '2016-10-17 22:12:32', 0, 'Anonymous'),
('18_14767139631476713963.8043', 18, 'A triangle indeed.', '', '', 'Manila, Metro Manila, Philippines', '14.563088400000002', '121.02086299999998', '2016-10-17 22:19:23', 0, 'Anonymous'),
('18_14767975091476797509.1456', 18, 'Palawan is composed of the long and narrow Palawan Island, plus a number of other smaller islands surrounding the main island. The Calamianes Group of Islands to the Northeast consists of Busuanga Island, Coron Island and Culion Island. Durangan Island (Dulangan) almost touches the westernmost part of Palawan Island, while Balabac Island is located off the southern tip, separated from Borneo by the Balabac Strait. In addition, Palawan covers the Cuyo Islands in the Sulu Sea. The disputed Spratly Islands, located a few hundred kilometres to the west, are considered part of Palawan by the Philippines, and is locally called the "Kalayaan Group of Islands".\r\n\r\nPalawan''s almost 2,000 kilometres (1,200 mi) of irregular coastline are dotted with roughly 1,780 islands and islets, rocky coves, and sugar-white sandy beaches. It also harbors a vast stretch of virgin forests that carpet its chain of mountain ranges. The mountain heights average 3,500 feet (1,100 m) in altitude, with the highest peak rising to 6,843 feet (2,086 m)[9] at Mount Mantalingahan. The vast mountain areas are the source of valuable timber. The terrain is a mix of coastal plain, craggy foothills, valley deltas, and heavy forest interspersed with riverine arteries that serve as irrigation', '', '', 'Bel-Air, Makati, Metro Manila, Philippines', '14.5627702', '121.02026579999999', '2016-10-18 21:31:49', 1, 'Anonymous'),
('18_14767990921476799092.2157', 18, 'The MATCH function is used to specify the column names that identify your FULLTEXT collection. The column list inside the MATCH function must exactly match that of the FULLTEXT index definition, unless your search in boolean mode (see below).\r\n\r\n#ok', '', '', 'Bel-Air, Makati, Metro Manila, Philippines', '14.5627787', '121.0202939', '2016-10-18 21:58:12', 1, 'Anonymous'),
('18_14768409551476840955.8957', 18, 'Africa is the world''s second-largest and second-most-populous continent. At about 30.3 million km² including adjacent islands, it covers six per cent of Earth''s total surface area and 20.4 per cent of its total land area.', '', '', 'Pinagsama, Taguig, Metro Manila, Philippines', '14.5176184', '121.0508645', '2016-10-19 09:35:55', 1, 'Anonymous'),
('18_14773193131477319313.6754', 18, 'Not so white sand beach!', '', '', 'Manila, Metro Manila, Philippines', '14.562888599999999', '121.02038680000001', '2016-10-24 22:28:33', 1, 'Anonymous'),
('19_14750814551475081455.879', 19, 'Seems like a UFO resting at the edge of this cliff.\r\nIt''s Mine''s View.', '', '', '', '', '0', '2016-09-29 00:50:55', 0, 'Anonymous'),
('24_14753366241475336624.5116', 24, 'Blue lake!\r\nHad wonderful day in this place.', '', '', '', '', '0', '2016-10-01 23:43:44', 0, 'Anonymous'),
('24_14753383461475338346.7111', 24, 'Test', '', '', '', '', '0', '2016-10-02 00:12:26', 0, 'Anonymous'),
('24_14753384261475338426.4292', 24, 'Test 2', '', '', '', '', '0', '2016-10-02 00:13:46', 0, 'Anonymous'),
('39_14766119401476611940.1697', 39, 'I love palawan!', '', '', '', '', '0', '2016-10-16 17:59:00', 0, 'Anonymous'),
('39_14766148901476614890.9179', 39, 'Come and visit this place.', '', '', '', '', '0', '2016-10-16 18:48:10', 0, 'Anonymous'),
('41_14767866551476786655.7892', 41, 'I love Samal!', '', '', 'Bel-Air, Makati, Metro Manila, Philippines', '14.562804399999997', '121.02029529999999', '2016-10-18 18:30:55', 0, 'Anonymous'),
('45_14773170451477317045.2356', 45, 'I Love Davao!', '', '', 'Bel-Air, Makati, Metro Manila, Philippines', '14.562849', '121.0203612', '2016-10-24 21:50:45', 1, 'Anonymous'),
('45_14773171291477317129.7963', 45, 'Kadayawan festival!', '', '', 'Manila, Metro Manila, Philippines', '14.562945999999998', '121.02045759999999', '2016-10-24 21:52:09', 1, 'Leomar Bucud'),
('45_14773187061477318706.2032', 45, 'Pearl Farm at Davao City!', '', '', 'Makati, Metro Manila, Philippines', '14.562865700000001', '121.02033259999997', '2016-10-24 22:18:26', 1, 'The Janitor'),
('45_14773207061477320706.1327', 45, 'Mines view!', '', '', 'Baguio City, Philippines', '14.562998099999998', '121.0206314', '2016-10-24 22:51:46', 1, 'Anonymous'),
('45_14777543391477754339.0815', 45, 'Baguio City is love.', '', '', 'Baguio City, Philippines', '14.6760413', '121.0437003', '2016-10-29 23:18:59', 1, 'Anonymous'),
('45_14780171421478017142.7644', 45, 'Test', '', '', 'Bel-Air, Makati, Metro Manila, Philippines', '14.562809099999999', '121.02021769999998', '2016-11-02 00:19:02', 1, 'Cherry');

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `promo_id` int(11) NOT NULL,
  `promo_name` int(11) NOT NULL,
  `promo_discount_percent` float NOT NULL,
  `promo_discount_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ref_booking_outcome`
--

CREATE TABLE `ref_booking_outcome` (
  `outcome_code` int(11) NOT NULL,
  `outcome_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ref_booking_status`
--

CREATE TABLE `ref_booking_status` (
  `status_code` int(11) NOT NULL,
  `status_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_booking_status`
--

INSERT INTO `ref_booking_status` (`status_code`, `status_description`) VALUES
(1, 'Pending'),
(2, 'Reserved'),
(3, 'Booked'),
(4, 'Cancelled');

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
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `restaurant_id` int(11) NOT NULL,
  `restaurant_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_booking`
--

CREATE TABLE `service_booking` (
  `service_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `booking_start_date` date NOT NULL,
  `booking_end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `travel_agencies`
--

CREATE TABLE `travel_agencies` (
  `travel_agency_id` int(11) NOT NULL,
  `travel_agency_name` varchar(250) NOT NULL,
  `travel_agency_address` varchar(250) NOT NULL,
  `travel_agency_contact` varchar(50) NOT NULL
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
(10, 'janebrook', 'janebrook@mailinator.com', '$2y$10$vZf/rCI6P98MGlobhCDs/uvXIdVQDB4phozsN1M5qfPwbsViWjCaK', '', '2016-09-20 22:14:32', '0', 1, '5ef059938ba799aaa845e1c2e8a762bd', 0),
(18, 'leomar', 'leomarbucud@gmail.com', '$2y$10$NKLtRWq8Y39GFAf6eGbjO.0mUxxXZRuIGThuCWXV2CraznHbRGENq', '', '2016-09-26 21:44:42', '0', 1, '5ef059938ba799aaa845e1c2e8a762bd', 1),
(19, 'luvley', 'luvley@email.com', '$2y$10$pZSxbzrsfvcNwZdRhRe94.sKykOvPLjsm.s.MA/EAEJYpbQ0fTYgy', '', '2016-09-28 01:37:56', '0', 1, '47d1e990583c9c67424d369f3414728e', 0),
(25, 'chichi', 'che_alfonso711@yahoo.com', '$2y$10$NkXQIu77gmuxN.k0jRpKAuKIU3aXKM.cWT1NxMoG27IQIa93ha.Tu', '', '2016-10-02 00:31:35', '0', 1, 'ec8956637a99787bd197eacd77acce5e', 0),
(39, 'johndoe', 'leomar101@mailinator.com', '$2y$10$M4M7iQ0Hz6StAV2yj6oXK.ESMYR00mqko/Cd5.oNQmixzLBxObfHe', '', '2016-10-15 21:43:45', '0', 1, '274ad4786c3abca69fa097b85867d9a4', 0),
(40, 'crazybastard', 'crazybastard@mailinator.com', '$2y$10$2wmn1ivv/MrhwK8lPubKUecLNo0ahH4tf0lKY5mWxz7yn.S0Ln1ka', '', '2016-10-16 23:40:33', '0', 1, '2f2b265625d76a6704b08093c652fd79', 0),
(41, 'footnotetest', 'footnotetest@mailinator.com', '$2y$10$tHcJT87C6Km0OECXOojOM.Gb800A63p/kPwQ6AnsyO9MibaVoGOjq', '', '2016-10-18 18:22:45', '0', 1, 'addfa9b7e234254d26e9c7f2af1005cb', 0),
(42, 'admin', 'footnoteadmin@mailinator.com', '$2y$10$MilDufbtzoEroS32MZ8.J.pvEYjkMchP2SRUNPjnfnHbrquUwPfOq', '', '2016-10-18 18:39:33', '0', 1, '819f46e52c25763a55cc642422644317', 1),
(43, 'cubework', 'cubework@mailinator.com', '$2y$10$Kb7YENvwr0UmJEYwR15TS.DOaRsjX.U5AvHn9CJQo.JYP64PNf44e', '', '2016-10-19 11:02:58', '0', 1, 'fc8001f834f6a5f0561080d134d53d29', 0),
(44, 'leomaryahoo', 'leomarbucud@yahoo.com', '$2y$10$lWbiQGycjHdjmrFl7Giqy.V/Aqxdix0FAIvHFiQxeAU6WxmWLiWzK', '', '2016-10-19 11:17:26', '0', 1, 'd554f7bb7be44a7267068a7df88ddd20', 0),
(45, '', '', '', '', '2016-10-24 21:33:57', '0', 0, '', 0),
(46, 'electricity', 'electricity@mailinator.com', '$2y$10$w4iXFiqMdteYxSFg57JKhepP.n7GLDQLkqYy6ueZm.a0s/uv4OnBq', '', '2016-10-30 20:09:37', '0', 1, '918317b57931b6b7a7d29490fe5ec9f9', 0);

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
  `contact` varchar(50) NOT NULL,
  `gender` int(1) NOT NULL DEFAULT '0',
  `bio` text NOT NULL,
  `profile` varchar(250) NOT NULL DEFAULT '1476196571_18_41b586905e6233e72b076191f8bf9512.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `lastname`, `firstname`, `middlename`, `address`, `birthdate`, `contact`, `gender`, `bio`, `profile`) VALUES
(10, 'Brook', 'Jane', 'Willies', 'Makati City, Ph', '10/18/1987', '', 1, 'Enjoying life to the fullest....', '1476630244_10_71577389ec229d59da26cc2252f92bc4.jpg'),
(18, 'Bucud', 'Leomar', 'San Buenaventura', 'Makati City', '04/10/1993', '092637517871', 1, 'Because they change things. They push the human race forward.', '1476627600_18_8b63b3c993ac334116d1a50c404fec5d.jpg'),
(19, 'Amouguiz', 'Luvley Mae', 'Moldes', 'Davo City', '0000-00-00', '', 1, 'Love to travel with my boyfirend.', '1476196571_18_41b586905e6233e72b076191f8bf9512.png'),
(20, '', '', '', '', '0000-00-00', '', 0, '', ''),
(21, '', '', '', '', '0000-00-00', '', 0, '', ''),
(22, '', '', '', '', '0000-00-00', '', 0, '', ''),
(23, '', '', '', '', '0000-00-00', '', 0, '', ''),
(25, 'Alfonso', 'Cherry Ann', 'Gaviola', 'Guagua, Pampanga', '0000-00-00', '', 1, 'I love Dubai!', '1476196571_18_41b586905e6233e72b076191f8bf9512.png'),
(36, '', '', '', '', '0000-00-00', '', 0, '', '1476196571_18_41b586905e6233e72b076191f8bf9512.png'),
(37, '', '', '', '', '0000-00-00', '', 0, '', '1476196571_18_41b586905e6233e72b076191f8bf9512.png'),
(38, '', '', '', '', '0000-00-00', '', 0, '', '1476196571_18_41b586905e6233e72b076191f8bf9512.png'),
(39, 'Doe', 'John', '', 'Makati City', '1993-04-10', '', 0, 'Life is short.', '1476614782_39_f022714c3adea4629d6b7042a2590a34.jpg'),
(40, 'Bastard', 'Crazy', '', 'Manila', '10/27/2016', '', 0, '', '1476196571_18_41b586905e6233e72b076191f8bf9512.png'),
(41, 'Test', 'Footnote', '', 'Davao City', '07/28/2011', '', 0, 'I love gathering memories through my travels.', '1476786365_41_82b83e49e702e2d8cd7c49a6b16ff5fd.jpg'),
(42, 'Footnote', 'Admin', '', 'Makati City', '02/23/2016', '', 0, 'I''m an admin', '1476196571_18_41b586905e6233e72b076191f8bf9512.png'),
(43, '', '', '', '', '', '', 0, '', '1476196571_18_41b586905e6233e72b076191f8bf9512.png'),
(44, 'Yahoo', 'Leomar', '', 'Pampanga', '10/20/1996', '', 0, 'I love SR.', '1476196571_18_41b586905e6233e72b076191f8bf9512.png'),
(45, '', 'Anonymous', '', '', '', '', 0, '', '1476196571_18_41b586905e6233e72b076191f8bf9512.png'),
(46, 'Tricity', 'Elec', '', '', '', '09261234567', 0, '', '1476196571_18_41b586905e6233e72b076191f8bf9512.png');

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
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`airline_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `flight_schedules`
--
ALTER TABLE `flight_schedules`
  ADD PRIMARY KEY (`flight_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `hearts`
--
ALTER TABLE `hearts`
  ADD PRIMARY KEY (`hearts_id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`inquiry_id`);

--
-- Indexes for table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`media_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`place_id`),
  ADD KEY `place_id` (`place_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);
ALTER TABLE `posts` ADD FULLTEXT KEY `post_text` (`post_text`);
ALTER TABLE `posts` ADD FULLTEXT KEY `location` (`location`);
ALTER TABLE `posts` ADD FULLTEXT KEY `post_text_2` (`post_text`,`location`);

--
-- Indexes for table `ref_booking_outcome`
--
ALTER TABLE `ref_booking_outcome`
  ADD PRIMARY KEY (`outcome_code`);

--
-- Indexes for table `ref_booking_status`
--
ALTER TABLE `ref_booking_status`
  ADD PRIMARY KEY (`status_code`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`restaurant_id`);

--
-- Indexes for table `travel_agencies`
--
ALTER TABLE `travel_agencies`
  ADD PRIMARY KEY (`travel_agency_id`);

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
ALTER TABLE `user_details` ADD FULLTEXT KEY `name` (`lastname`,`firstname`);

--
-- Indexes for table `user_devices`
--
ALTER TABLE `user_devices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `airline_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `flight_schedules`
--
ALTER TABLE `flight_schedules`
  MODIFY `flight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `hearts`
--
ALTER TABLE `hearts`
  MODIFY `hearts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `inquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `medias`
--
ALTER TABLE `medias`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ref_booking_outcome`
--
ALTER TABLE `ref_booking_outcome`
  MODIFY `outcome_code` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ref_booking_status`
--
ALTER TABLE `ref_booking_status`
  MODIFY `status_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `travel_agencies`
--
ALTER TABLE `travel_agencies`
  MODIFY `travel_agency_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `user_devices`
--
ALTER TABLE `user_devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
