-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2016 at 02:19 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `transactionNo`, `paid`, `balance`, `totalAmount`) VALUES
(20, '57562b0674d9f', '5500', '0', '5500'),
(21, '57562ba1aa100', '4200', '0', '4200'),
(22, '57562d3dbd7d8', '9600', '0', '9600'),
(23, '57562df6d3982', '5402', '0', '5402'),
(24, '575935e1e4512', '4500', '0', '4500'),
(25, '575a6e530c6f4', '16800', '0', '16800'),
(26, '575a726441961', '3200', '0', '3200'),
(27, '575a72f439459', '4000', '0', '4000'),
(28, '575a73e708e2b', '8200', '0', '8200'),
(29, '577cb3642a39c', '8400', '0', '8400'),
(30, '578e1b5ab57e9', '8400', '0', '8400');

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
  `email` varchar(40) CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `lname`, `email`, `mobile`, `password`) VALUES
(22, 'Renzo', 'Pangyarihan', 'renzogpangyarihan@gmail.com', '09062052979', '123'),
(23, '', '', '', '', '575ab'),
(24, 'asdasd', 'asdasd', '131231', '12123', '577cb'),
(25, 'qwe', 'qwe', 'qwe', '123', '578e1');

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
('575abcff0e43e', '', 'Renzo Pangyarihan', '2016-06-10 21:13:51', '2016-06-10', '2016-06-11', '9600', 'Family Room B', '2', '2', '101,102 ', '', '', '', 'renzogpangyarihan@gmail.com', '09062052979', 'Full Payment', 'Online Reservation', '', 'Cancelled'),
('576a70cabced2', '', '', '2016-06-22 19:04:42', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Cancelled'),
('577cb3642a39c', '', 'asdasd asdasd', '2016-07-06 15:29:40', '2016-07-06', '2016-07-07', '8400', 'Family Room A', '2', '1', '206,207 ', '', '', '', '131231', '12123', 'Full Payment', 'Walk-in', 'Cash', 'Check Out'),
('578e1b5ab57e9', '', 'qwe qwe', '2016-07-19 20:21:46', '2016-07-19', '2016-07-20', '8400', 'Family Room A', '2', '12', '206,207 ', '', '', '', 'qwe', '123', 'Full Payment', 'Walk-in', 'Cash', 'Check In');

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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

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
(41, '211', 1, 'NO VIEW'),
(42, '123', 13, 'NO VIEW');

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
(12, 'Renzo', 'Pangyarihan', 'admin', '123', 'Admin'),
(8, 'Ian', 'Miranda', 'marketing', '123', 'Marketing'),
(7, 'Ian', 'Miranda', 'receptionist', '123', 'Receptionist');

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
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
  MODIFY `roomID` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
