-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2018 at 03:17 AM
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
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `integration_code` varchar(20) NOT NULL,
  `placeholders` text NOT NULL,
  `email_subject` varchar(150) NOT NULL,
  `email_body` text NOT NULL,
  `status` tinyint(4) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `integration_code`, `placeholders`, `email_subject`, `email_body`, `status`) VALUES
(2, 'Change Password for Admin', 'CPA', '#NAME#,#USERNAME#, #PASSWORD#,#DATETIME#,#LOGINPATH#', 'Password reset successfully.', '<p>Hello #NAME#,</p>\r\n\r\n<p>Your Password Reset Successfully with following Details ::-</p>\r\n\r\n<table border="0" cellpadding="5" cellspacing="8" style="width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td>Username</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#USERNAME#</td>\r\n		</tr>\r\n		<tr>\r\n			<td>New Password</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#PASSWORD#</td>\r\n		</tr>\r\n		\r\n		<tr>\r\n			<td>DateTime</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#DATETIME#</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Login URL&nbsp;</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#LOGINPATH#</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n', 1),
(4, 'Change Password for Client', 'CPC', '#NAME#,#USERNAME#, #PASSWORD#,#DATETIME#,#LOGINPATH#', 'Password reset successfully.', '<p>Hello #NAME#,</p>\r\n\r\n<p>Your Password Reset Successfully with following Details ::-</p>\r\n\r\n<table border="0" cellpadding="5" cellspacing="8" style="width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td>Username</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#USERNAME#</td>\r\n		</tr>\r\n		<tr>\r\n			<td>New Password&nbsp;â€‹</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#PASSWORD#</td>\r\n		</tr>\r\n		\r\n		<tr>\r\n			<td>DateTime</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#DATETIME#</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Login URL&nbsp;</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#LOGINPATH#</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n', 1),
(5, 'FORGOT PASSWORD for Admin', 'FP', '#NAME#,#PASSWORD#,#USERNAME#, #DATETIME#,#LOGINPATH#', 'Password Reset Info.....', '<p>Hello #NAME#,</p>\r\n\r\n<p>Your Password Reset Successfully with following Details ::-</p>\r\n\r\n<table border="0" cellpadding="5" cellspacing="8" style="width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td>Username</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#USERNAME#</td>\r\n		</tr>\r\n		<tr>\r\n			<td>New Password&nbsp;â€‹</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#PASSWORD#</td>\r\n		</tr>\r\n		<tr>\r\n			<td>DateTime</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#DATETIME#</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Login URL&nbsp;</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#LOGINPATH#</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n', 1),
(18, 'Remark message', 'REMARK', '#NAME#,#MOBILE#,#EMAIL#,#DATETIME#', 'Your passenger passport info', '<p>Hello #NAME#,</p>\r\n\r\n<p>Congratulations. You have successfully cleared the examination named #EXAM#. Your interview will be scheduled within 45 days.</p>\r\n\r\n<p>The information for the Interview will be sent to your registered Mobile via Text Message and Email ID.</p>\r\n\r\n<p>Thank You.<br />\r\nKrishi Vikas Kalyan</p>\r\n', 1),
(7, 'Client registration by admin', 'CREG', '#NAME#,#USERNAME#,#PASSWORD#,#EMAIL#,#MOBILE#,#GENDER#,#COUNTRY#,#DATETIME#,#CLIENT_SITEURL#', 'Registration details', '<div style="margin:5px;padding:10px; font:15px ''arial'';"> <!--arial-->\r\n<p>Hello #NAME#,</p>\r\n\r\n<p>Your registration has been successful with following Details :: -</p>\r\n\r\n<table border="0" cellpadding="5" cellspacing="8" style="width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td>Name</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#NAME#</td>\r\n		</tr>\r\n		<tr>\r\n			<td>User Name</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#USERNAME#</td>\r\n		</tr>\r\n		\r\n		<tr>\r\n			<td>Password</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#PASSWORD#</td>\r\n		</tr>\r\n		\r\n		<tr>\r\n			<td>Login URL</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#CLIENT_SITEURL#</td>\r\n		</tr>\r\n		\r\n		<tr>\r\n			<td>Email ID</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#EMAIL#</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mobile No.</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#MOBILE#</td>\r\n		</tr>\r\n		\r\n		<tr>\r\n			<td>DateTime</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#DATETIME#</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>If you need any further help please contact us on below details.<br />\r\nhr@xyz.com +91-9584296764</p>\r\n\r\n<p align="center" style="text-align:center"><a href="#ADMIN_SITEURL#" style="text-decoration:none;color:#565656" target="_blank" title="xyz_admin.com"><span style="color:#565656;font-size:13px">www.xyz_admin.com</span></a></p>\r\n </div>', 1),
(6, 'FORGOT PASSWORD for Client', 'FPC', '#NAME#,#PASSWORD#,#USERNAME#, #DATETIME#,#LOGINPATH#', 'Password Reset Info.....', '<p>Hello #NAME#,</p>\r\n\r\n<p>Your Password Reset Successfully with following Details ::-</p>\r\n\r\n<table border="0" cellpadding="5" cellspacing="8" style="width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td>Username</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#USERNAME#</td>\r\n		</tr>\r\n		<tr>\r\n			<td>New Password&nbsp;â€‹</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#PASSWORD#</td>\r\n		</tr>\r\n		<tr>\r\n			<td>DateTime</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#DATETIME#</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Login URL&nbsp;</td>\r\n			<td>:</td>\r\n			<td style="border:1px solid #dbdbdb;padding-top: 6px;padding-bottom: 6px;padding-left: 5px;">#LOGINPATH#</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
