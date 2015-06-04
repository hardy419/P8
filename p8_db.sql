-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 02, 2015 at 09:44 AM
-- Server version: 5.1.73
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `p8_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `p8_category`
--

CREATE TABLE IF NOT EXISTS `p8_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `type` enum('項目','備用1','備用2') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `p8_category`
--

INSERT INTO `p8_category` (`id`, `name`, `type`) VALUES
(1, 'General', '項目');

-- --------------------------------------------------------

--
-- Table structure for table `p8_project`
--

CREATE TABLE IF NOT EXISTS `p8_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `cid` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `preview` varchar(256) NOT NULL,
  `images` varchar(4096) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `p8_project`
--

INSERT INTO `p8_project` (`id`, `title`, `cid`, `date`, `description`, `preview`, `images`) VALUES
(1, 'Project1', 1, '2015-04-16', 'Project1 Description', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `p8_projectphoto`
--

CREATE TABLE IF NOT EXISTS `p8_projectphoto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `infor` varchar(255) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(64) NOT NULL,
  `sid` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `p8_user`
--

CREATE TABLE IF NOT EXISTS `p8_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(50) NOT NULL,
  `login_count` varchar(50) NOT NULL,
  `last_login_time` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `nickname` varchar(255) NOT NULL,
  `last_login_ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `p8_user`
--

INSERT INTO `p8_user` (`id`, `account`, `login_count`, `last_login_time`, `password`, `status`, `nickname`, `last_login_ip`) VALUES
(1, 'admin', '164', '1432001401', 'b59c67bf196a4758191e42f76670ceba', 1, '', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `p8_userb`
--

CREATE TABLE IF NOT EXISTS `p8_userb` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `pass` char(32) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `current` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `p8_userb`
--

INSERT INTO `p8_userb` (`id`, `user`, `pass`, `created`, `current`, `last`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2012-10-10 00:22:02', '2014-12-22 15:28:41', '2014-11-23 15:32:38');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
