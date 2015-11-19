-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2015 at 12:41 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`) VALUES
(1, 'Cipaganti'),
(2, 'Pasteur'),
(3, 'Asia Afrika');

-- --------------------------------------------------------

--
-- Table structure for table `mytweets`
--

CREATE TABLE IF NOT EXISTS `mytweets` (
  `id` bigint(20) NOT NULL,
  `author` varchar(20) NOT NULL,
  `tweet` varchar(140) NOT NULL,
  `statusProcess` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mytweets`
--

INSERT INTO `mytweets` (`id`, `author`, `tweet`, `statusProcess`, `created_at`) VALUES
(1, 'pascalalfadian', 'testing twitter seberapa hebat ini program yang dibuat oleh steven daniel sebagai apa yah lupa gw', 0, '2015-10-31 13:01:54'),
(2, 'danielrow', 'testing twitter kemacetan', 0, '2015-10-31 13:43:42'),
(3, 'testing', 'asdf asfd', -1, '2015-10-31 14:20:17');

-- --------------------------------------------------------

--
-- Table structure for table `nninputs`
--

CREATE TABLE IF NOT EXISTS `nninputs` (
  `id` int(11) NOT NULL,
  `tweet` bigint(20) NOT NULL,
  `location` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL,
  `information` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `information`) VALUES
(1, 'Lancar'),
(2, 'Ramai Lancar'),
(3, 'Padat Merayap'),
(4, 'Padat'),
(5, 'Tersendat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mytweets`
--
ALTER TABLE `mytweets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nninputs`
--
ALTER TABLE `nninputs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mytweets` (`tweet`),
  ADD KEY `locations` (`location`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `nninputs`
--
ALTER TABLE `nninputs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `nninputs`
--
ALTER TABLE `nninputs`
  ADD CONSTRAINT `locations` FOREIGN KEY (`location`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `nninputs_ibfk_1` FOREIGN KEY (`tweet`) REFERENCES `mytweets` (`id`),
  ADD CONSTRAINT `status` FOREIGN KEY (`status`) REFERENCES `status` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
