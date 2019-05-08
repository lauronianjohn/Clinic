-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2016 at 01:15 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clinic`
--
CREATE DATABASE IF NOT EXISTS `kyle` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `kyle`;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
  `app_id` int(200) NOT NULL AUTO_INCREMENT,
  `doc_id` int(200) NOT NULL,
  `a_name` varchar(50) NOT NULL,
  `a_contact` varchar(50) NOT NULL,
  `a_gender` varchar(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `a_address` text NOT NULL,
  `job` varchar(50) NOT NULL,
  `doa` varchar(50) NOT NULL,
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field` varchar(50) NOT NULL,
  `prc` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `contact` bigint(11) NOT NULL,
  `image` longblob NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `prc` (`prc`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `field`, `prc`, `name`, `address`, `email`, `password`, `contact`, `image`) VALUES
(15, 'dentist', 0, 'Michelle Ann Capacio', 'Pardo Cebu City', 'capacio143@yahoo.com', 'capacio143', 9254986233, 0x3930333933362e706e67),
(16, ' Anesthesiology', 2147483647, 'Alwenn Antona', 'Cebu City', 'antona@yahoo.com', 'antona', 96538263527, 0x33323931392e676966),
(17, 'Dentist', 8752983, 'Rhea Sagayno', 'Cebu City', 'sagayno@yahoo.com', 'sagayno', 9234297654, 0x3837353234372e676966),
(18, 'Dermatologist', 34239754, 'John Cyril Pescadero', 'Cebu City', 'pescadero@yahoo.com', 'pescadero', 9325739847, 0x3230333334322e6a7067),
(19, 'Geologist', 324678, 'Chen Delacuesta', 'Cebu City', 'chendelacusta@gmail.com', 'lovelydonna', 9236233705, 0x3837363136322e6a7067),
(20, 'Dentist', 54647747, 'Jhondrey Taylor', 'Cebu City', 'Jhon243@yahoo.com', 'lovelydonana', 9336344276, 0x3538343030342e6a7067),
(21, 'Eurologist', 22, 'James Carnable', 'Carreta Cebu City', 'jamescarnable@gmail.com', 'july191993', 9432751468, 0x3637343838362e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `status` enum('admin','user') NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`email`, `password`, `name`, `address`, `contact`, `status`, `id`, `image`) VALUES
('leo@gmail.com', 'leonard', 'Leonard Donatello', 'Cebu City', 9254986233, 'admin', 1, ''),
('james@gmail.com', 'carnable', 'James Carnable', 'Carreta Cebu City', 9432751468, 'user', 3, 0x757365722e676966);

-- --------------------------------------------------------

--
-- Table structure for table `specialty`
--

CREATE TABLE IF NOT EXISTS `specialty` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`field_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `specialty`
--

INSERT INTO `specialty` (`field_id`, `name`) VALUES
(7, ' Anesthesiology'),
(2, 'Dentist'),
(8, 'Dermatologist'),
(3, 'Eurologist'),
(5, 'Geologist'),
(10, 'Neurologist'),
(9, 'Opthalmologist'),
(6, 'Psychiatrist');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
