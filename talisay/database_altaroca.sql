-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2016 at 11:24 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `database_altaroca`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE IF NOT EXISTS `amenities` (
  `id` int(11) NOT NULL,
  `amenityName` varchar(30) NOT NULL,
  `amenityRate` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `amenityName`, `amenityRate`, `description`, `quantity`) VALUES
(1, 'Videoke Room', 400, 'hour', 1),
(2, 'Billiards', 250, 'hour', 1),
(3, 'Darts', 50, 'hour', 1),
(5, 'Pillow', 50, 'item', 1);

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE IF NOT EXISTS `billing` (
  `id` int(255) NOT NULL,
  `transactionNo` varchar(255) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `totalAmount` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `transactionNo`, `paid`, `balance`, `totalAmount`) VALUES
(1, '56bf4a93ccdeb', '23400', '0', '23400'),
(2, '56bf50aba26dc', '4200', '0', '4200'),
(3, '56bf50bc4c239', '7200', '7200', '14400'),
(4, '56bf4ffd27b0b', '33050', '0', '33050'),
(5, '572552ec0268a', '38400', '0', '38400'),
(6, '5750e0d6f077e', '12600', '0', '12600'),
(7, '5750e1b611adb', '4200', '0', '4200'),
(8, '5750e2ff12fa2', '21000', '0', '21000'),
(9, '5750e468d77e0', '3700', '0', '3700'),
(10, '5750e57291c41', '3200', '0', '3200'),
(11, '5750e6591b573', '16800', '0', '16800'),
(12, '57552f157aa77', '8400', '0', '8400'),
(13, '575530f6d41f7', '21000', '0', '21000'),
(14, '5755319d1693b', '16800', '0', '16800'),
(15, '5755352761fd5', '4200', '0', '4200');

-- --------------------------------------------------------

--
-- Table structure for table `cottagecategory`
--

CREATE TABLE IF NOT EXISTS `cottagecategory` (
  `id` int(5) NOT NULL,
  `cottageType` varchar(30) NOT NULL,
  `cottageRate` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cottagecategory`
--

INSERT INTO `cottagecategory` (`id`, `cottageType`, `cottageRate`) VALUES
(1, 'Kubo', '1500'),
(2, 'Cabana', '2200'),
(4, 'Lanai', '6500'),
(5, 'Upper Treehouse', '6500'),
(6, 'Lower Treehouse', '5500');

-- --------------------------------------------------------

--
-- Table structure for table `cottages`
--

CREATE TABLE IF NOT EXISTS `cottages` (
  `catID` int(255) NOT NULL,
  `cottageID` varchar(20) NOT NULL,
  `id` int(5) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cottages`
--

INSERT INTO `cottages` (`catID`, `cottageID`, `id`, `status`) VALUES
(1, 'Cabana1', 2, ''),
(2, 'Cabana2', 2, ''),
(3, 'Cabana3', 2, ''),
(4, 'Cabana4', 2, ''),
(5, 'Kubo1', 1, ''),
(6, 'Kubo2', 1, ''),
(7, 'Kubo3', 1, ''),
(8, 'Kubo4', 1, ''),
(9, 'Kubo5', 1, ''),
(10, 'Kubo6', 1, ''),
(11, 'Lanai', 4, ''),
(12, 'Lower Treehouse', 6, ''),
(13, 'Upper Treehouse', 5, ''),
(14, 'Yellow Bell', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `lname` varchar(20) CHARACTER SET utf8 NOT NULL,
  `email` varchar(20) CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `lname`, `email`, `mobile`, `password`) VALUES
(1, 'Ian', 'Miranda', 'iaansanity@yahoo.com', '09153259490', '123'),
(2, 'Renzo', 'Pangyarihan', 'renzogpangyarihan@gm', '09157644906', '123'),
(3, 'Renzo', 'Pangyarihan', 'renzogpangyarihan@gm', '09062052979', '57255'),
(4, 'DEF', 'ABC', 'zxcasdqwe@yahoo.com', '12312312312', '5750e'),
(5, 'qweasd', 'qweasd', 'zzczx2', '123123', '5750e'),
(6, 'Pangyarihan', 'Renzo', 'renzogpangyarihan@gm', '09062052979', '5750e'),
(7, 'Pangyarihan', 'Ronnel', 'ronnelpangyarihan@gm', '123456489', '5750e'),
(8, 'Rowel', 'Pangyarihan', 'rowelrowelrowel@yaho', '987654', '5750e'),
(9, 'Connie', 'Pangyarihan', 'qweashhhsd', '23165543', '5750e'),
(10, 'Renzo', 'Pangyarihan', 'renzogpangyarihan@gm', '09062052979', '57552'),
(11, 'ako', 'panget', 'qweqwe', '123123', '57553'),
(12, 'dfgdfg', 'dfgdfg', '33333', 'ertert', '57553'),
(13, 'jy', 'tyty', 'eryeryeryery', '333434', '57553');

-- --------------------------------------------------------

--
-- Table structure for table `functionroom`
--

CREATE TABLE IF NOT EXISTS `functionroom` (
  `id` int(11) NOT NULL,
  `frname` varchar(30) NOT NULL,
  `frRate` int(11) NOT NULL,
  `perHour` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `functionroom`
--

INSERT INTO `functionroom` (`id`, `frname`, `frRate`, `perHour`) VALUES
(1, 'Function Room A', 12000, 4),
(2, 'Function Room B', 12000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `grandballroom`
--

CREATE TABLE IF NOT EXISTS `grandballroom` (
  `id` int(11) NOT NULL,
  `gbrName` varchar(50) NOT NULL,
  `gbrRate` decimal(10,0) NOT NULL,
  `perHour` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grandballroom`
--

INSERT INTO `grandballroom` (`id`, `gbrName`, `gbrRate`, `perHour`) VALUES
(1, 'Grandball Room', '25000', '4');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `transactionNo` varchar(255) NOT NULL,
  `referenceno` varchar(255) NOT NULL,
  `guestName` varchar(255) NOT NULL,
  `reservationDate` datetime NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `rate` varchar(255) NOT NULL,
  `roomType` varchar(255) NOT NULL,
  `numberofRooms` varchar(255) NOT NULL,
  `numberofperson` varchar(255) NOT NULL,
  `roomName` varchar(255) NOT NULL,
  `cottageName` varchar(255) NOT NULL,
  `amenity` varchar(255) NOT NULL,
  `amenitycount` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobileNumber` varchar(255) NOT NULL,
  `paymentType` varchar(255) NOT NULL,
  `process` varchar(255) NOT NULL,
  `modeofpayment` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`transactionNo`, `referenceno`, `guestName`, `reservationDate`, `checkin`, `checkout`, `rate`, `roomType`, `numberofRooms`, `numberofperson`, `roomName`, `cottageName`, `amenity`, `amenitycount`, `email`, `mobileNumber`, `paymentType`, `process`, `modeofpayment`, `status`) VALUES
('575530f6d41f7', '', 'ako panget', '2016-06-06 16:14:46', '2016-06-06', '2016-06-07', '21000', 'Family Room A', '5', '1', '206,207,208,210,300 ', '', '', '', 'qweqwe', '123123', 'Full Payment', 'Walk-in', 'Cash', 'Check Out'),
('5755319d1693b', '', 'dfgdfg dfgdfg', '2016-06-06 16:17:33', '2016-06-06', '2016-06-07', '16800', 'Family Room A', '4', '5', '206,207,208,210 ', '', '', '', '33333', 'ertert', 'Full Payment', 'Walk-in', 'Cash', 'Check Out'),
('5755352761fd5', '', 'jy tyty', '2016-06-06 16:32:39', '2016-06-06', '2016-06-07', '4200', 'Family Room A', '1', '1', '206 ', '', '', '', 'eryeryeryery', '333434', 'Full Payment', 'Walk-in', 'Cash', 'Check Out');

-- --------------------------------------------------------

--
-- Table structure for table `roomcategory`
--

CREATE TABLE IF NOT EXISTS `roomcategory` (
  `id` int(5) NOT NULL,
  `roomType` varchar(30) NOT NULL,
  `bedConfiguration` varchar(50) NOT NULL,
  `capacity` int(10) NOT NULL,
  `roomRate` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomcategory`
--

INSERT INTO `roomcategory` (`id`, `roomType`, `bedConfiguration`, `capacity`, `roomRate`) VALUES
(1, 'Family Room A', '4 Single Bed, 1 Queen Size Bed', 6, 4200),
(2, 'Family Room B', '5 Single Bed, 1 Queen Size Bed', 7, 4800),
(3, 'Standard Room A', '1 Single Bed, 1 Queen Size Bed', 3, 3200),
(4, 'Standard Room B', '2 Queen Size Bed', 5, 3200),
(5, 'Standard Room C', '1 Single Bed, 1 Queen Size Bed', 5, 3200),
(6, 'Deluxe Room', '3 Single Bed, 1 Queen Size Bed', 5, 3700),
(7, 'Suite Room A', '3 Single Bed', 2, 4000),
(8, 'Suite Room B', '1 Queen Size Bed', 2, 4000),
(9, 'Maharlika Room', '2 Queen Size Bed', 5, 4500),
(10, 'Large Suite', '1 Queen Size Bed', 2, 4000),
(11, 'Junior Suite', '1 Queen Size Bed', 2, 4000),
(12, 'Dorm Type', '5 Double Decks', 10, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `roomID` int(255) NOT NULL,
  `roomNum` varchar(6) NOT NULL,
  `id` int(5) NOT NULL,
  `view` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`roomID`, `roomNum`, `id`, `view`) VALUES
(1, '206', 1, 'NO VIEW'),
(2, '207', 1, 'NO VIEW'),
(3, '208', 1, 'NO VIEW'),
(4, '210', 1, 'NO VIEW'),
(5, '300', 1, 'NO VIEW'),
(6, '101', 2, 'POOL'),
(7, '102', 2, 'POOL'),
(8, '103', 2, 'POOL'),
(9, '104', 2, 'POOL'),
(10, '202', 3, 'BALCONY'),
(11, '205', 3, 'BALCONY'),
(12, '204', 3, 'BALCONY'),
(13, '203', 3, 'BALCONY'),
(14, '303', 3, 'NO VIEW'),
(15, '201', 3, 'BALCONY'),
(16, '302', 3, 'NO VIEW'),
(17, '301', 3, 'NO VIEW'),
(18, '305', 3, 'NO VIEW'),
(19, '304', 3, 'NO VIEW'),
(20, '111', 4, 'NO VIEW'),
(21, '114', 4, 'NO VIEW'),
(22, '113', 4, 'NO VIEW'),
(23, '112', 4, 'NO VIEW'),
(24, '110', 4, 'NO VIEW'),
(25, '211', 5, 'NO VIEW'),
(26, '212', 5, 'NO VIEW'),
(27, '213', 5, 'NO VIEW'),
(28, '105', 6, 'NO VIEW'),
(29, '107', 6, 'NO VIEW'),
(30, '108', 6, 'NO VIEW'),
(31, '109', 6, 'NO VIEW'),
(32, '106', 6, 'NO VIEW'),
(33, '306', 7, 'NO VIEW'),
(34, '308', 8, 'NO VIEW'),
(35, '401', 9, 'NO VIEW'),
(36, '403', 10, 'NO VIEW'),
(37, '404', 11, 'NO VIEW'),
(38, '402', 11, 'NO VIEW'),
(39, 'DORMA', 12, 'PARKING'),
(40, 'DORMB', 12, 'PARKING'),
(41, '211', 1, 'NO VIEW');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `lname`, `username`, `password`, `usertype`) VALUES
(12, 'Ian', 'Miranda', 'iaansanity', '123', 'Admin'),
(8, 'Ian', 'Miranda', 'ian', '123', 'Marketing'),
(7, 'Ian', 'Miranda', 'yan', '123', 'Receptionist');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cottagecategory`
--
ALTER TABLE `cottagecategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cottages`
--
ALTER TABLE `cottages`
  ADD PRIMARY KEY (`catID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `functionroom`
--
ALTER TABLE `functionroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grandballroom`
--
ALTER TABLE `grandballroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`transactionNo`);

--
-- Indexes for table `roomcategory`
--
ALTER TABLE `roomcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`roomID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `cottagecategory`
--
ALTER TABLE `cottagecategory`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cottages`
--
ALTER TABLE `cottages`
  MODIFY `catID` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `functionroom`
--
ALTER TABLE `functionroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `grandballroom`
--
ALTER TABLE `grandballroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `roomcategory`
--
ALTER TABLE `roomcategory`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `roomID` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
