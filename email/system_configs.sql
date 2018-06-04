-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2018 at 04:15 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `system_configs`
--

CREATE TABLE IF NOT EXISTS `system_configs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `system_name` varchar(100) NOT NULL,
  `pass_len_min` tinyint(3) NOT NULL,
  `pass_len_max` tinyint(3) NOT NULL,
  `mobile_len_min` tinyint(3) NOT NULL,
  `mobile_len_max` tinyint(3) NOT NULL,
  `support_email` varchar(50) NOT NULL,
  `no_reply_email` varchar(40) NOT NULL,
  `support_phone` varchar(20) NOT NULL,
  `logo` varchar(150) NOT NULL,
  `facebook_url` varchar(80) NOT NULL,
  `twitter_url` varchar(80) NOT NULL,
  `gplus_url` varchar(80) NOT NULL,
  `linkdin_url` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `system_configs`
--

INSERT INTO `system_configs` (`id`, `system_name`, `pass_len_min`, `pass_len_max`, `mobile_len_min`, `mobile_len_max`, `support_email`, `no_reply_email`, `support_phone`, `logo`, `facebook_url`, `twitter_url`, `gplus_url`, `linkdin_url`) VALUES
(4, 'GingerComm School Management System', 6, 0, 0, 0, 'info@gingercomm.com', '', '9252060919', 'https://docs.google.com/uc?id=0B9-Pe7o9soesR3dMSDJ6TXVKNjg', 'https://www.facebook.com/electionxpress', 'https://twitter.com/jacksmithe820', 'https://plus.google.com/', 'https://www.linkedin.com/');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
