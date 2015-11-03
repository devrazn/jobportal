-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2015 at 08:12 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_jobportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_email_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mailtype` varchar(50) NOT NULL,
  `protocol` varchar(50) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_port` int(50) DEFAULT NULL,
  `smtp_user` varchar(255) DEFAULT NULL,
  `smtp_pass` varchar(255) DEFAULT NULL,
  `receive_email` varchar(255) NOT NULL,
  `charset` varchar(50) NOT NULL,
  `newline` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `del_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_email_settings`
--

INSERT INTO `tbl_email_settings` (`id`, `mailtype`, `protocol`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `receive_email`, `charset`, `newline`, `status`, `del_flag`) VALUES
(1, 'html', 'smtp', 'ssl://smtp.gmail.com', 465, 'neetupradhan96@gmail.com', '', 'enquiry@jobportal.com', 'utf-8', '\\r\\n', '1', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
