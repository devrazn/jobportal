-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2015 at 05:48 PM
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
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob_estd` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `company_type` varchar(255) NOT NULL,
  `profile` longtext NOT NULL,
  `benefits` longtext NOT NULL,
  `website` varchar(255) NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `newsletter_subscription` tinyint(4) NOT NULL,
  `pw_reset_key` varchar(255) NOT NULL,
  `del_flag` tinyint(4) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `email`, `password`, `f_name`, `l_name`, `gender`, `dob_estd`, `address`, `company_type`, `profile`, `benefits`, `website`, `marital_status`, `phone`, `user_type`, `newsletter_subscription`, `pw_reset_key`, `del_flag`, `status`) VALUES
(1, 'neetupradhan96@gmail.com', '12345', 'Neetu123', 'Pradhan', 'F', '2015-10-20', 'Sanepa', 'qaz', 'qaz', 'qaz', 'aa', 'single', '565454365465', '1', 1, 'aa', 0, '1'),
(2, 'acharya.rajanpkr@gmail.com', '111111', 'Rajan', 'Acharya', 'M', '2015-10-21', 'Kathmandu', 'asd', 'asd', 'asd', 'asd', 'S', '9867554567', '1', 1, 'aa', 0, '2'),
(3, 'neetupradhan96@hotmail.com', '111111', 'Neetu', 'Pradhan', 'f', '2014-12-12', 'Lalitpur', '', '', '', '', '1', '1111111', '2', 0, '', 0, '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
