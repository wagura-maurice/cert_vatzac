-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2017 at 10:06 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cert_vatzac`
--

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE IF NOT EXISTS `business` (
  `id` int(11) NOT NULL,
  `sector` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`id`, `sector`, `category`) VALUES
(1, 'ict', 'single'),
(2, 'medical', 'multiple'),
(3, NULL, 'duo'),
(9, NULL, 'kubahatisha'),
(10, 'black market', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permit`
--

CREATE TABLE IF NOT EXISTS `permit` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `estDate` date NOT NULL,
  `requestDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permit`
--

INSERT INTO `permit` (`id`, `username`, `sector`, `category`, `name`, `estDate`, `requestDate`, `status`) VALUES
(1, 'montanabay', 'medical', 'single', 'iouyt', '2017-07-04', '2017-07-08 04:23:17', 'Yes'),
(2, 'montanabay', 'ict', 'single', 'infortex ict solutions', '2013-03-23', '2017-07-08 19:45:39', 'Yes'),
(3, 'montanabay', 'medical', 'multiple', 'civic', '2017-07-10', '2017-07-08 21:49:44', 'No'),
(5, 'montanabay', 'medical', 'multiple', 'testing', '2010-11-17', '2017-07-09 23:46:03', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'default_user.png',
  `password` varchar(255) NOT NULL,
  `joinDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `occp` varchar(255) NOT NULL DEFAULT 'Client'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fname`, `lname`, `email`, `phone`, `avatar`, `password`, `joinDate`, `occp`) VALUES
(7, 'montanabay', 'maurice', 'wagura', 'wagura465@gmail.com', '0718837808', '552947-montanabay.jpg', 'c3824a8ca82898716bdb6628ca96234c', '2017-07-06 03:34:38', 'Client'),
(9, 'demouser', 'John', 'Doe', 'doe@example.com', '0717123455', '880208-demouser.jpg', 'e10adc3949ba59abbe56e057f20f883e', '2017-07-08 02:07:21', 'Client'),
(10, 'admin', 'dennis', 'vatzac', 'vatzac@gmail.com', '0728588326', '787245-admin.jpg', 'e10adc3949ba59abbe56e057f20f883e', '2017-07-09 01:34:35', 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permit`
--
ALTER TABLE `permit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `permit`
--
ALTER TABLE `permit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
