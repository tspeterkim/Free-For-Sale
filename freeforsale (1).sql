-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2014 at 07:53 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `freeforsale`
--

-- --------------------------------------------------------

--
-- Table structure for table `feeds`
--

CREATE TABLE IF NOT EXISTS `feeds` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ipID` int(11) NOT NULL,
  `message` text NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `feeds`
--

INSERT INTO `feeds` (`ID`, `ipID`, `message`, `latitude`, `longitude`, `likes`, `timestamp`) VALUES
(1, 1, 'message 1', 37.5665, 126.978, 2, '2014-07-21 04:29:15'),
(2, 1, 'message 2', 37.5665, 126.978, 1, '2014-07-21 04:29:15'),
(3, 1, 'message 3', 37.5665, 126.978, 0, '2014-07-21 04:29:15'),
(4, 1, 'message 4', 37.5665, 126.978, 1, '2014-07-22 04:58:59'),
(5, 1, 'message 5', 37.5665, 126.978, 1, '2014-07-22 05:10:38'),
(6, 1, 'message 6', 37.5665, 126.978, 1, '2014-07-21 04:29:15'),
(7, 1, 'message 7', 37.5665, 126.978, 1, '2014-07-22 05:05:50'),
(8, 1, 'message 8', 37.5665, 126.978, 0, '2014-07-21 04:29:15'),
(9, 1, 'message 9', 37.5665, 126.978, 1, '2014-07-22 05:09:36'),
(10, 1, 'message 10', 37.5665, 126.978, 1, '2014-07-21 04:29:15'),
(11, 1, 'sdsds', 37.5665, 126.978, 1, '2014-07-22 05:17:03'),
(12, 1, 'sss', 37.5665, 126.978, 0, '2014-07-21 04:29:15'),
(13, 1, 'new message', 37.5665, 126.978, 0, '2014-07-21 04:29:15'),
(14, 1, 'this is a new word', 37.5665, 126.978, 1, '2014-07-22 05:08:44'),
(15, 1, 'something new is always good, don''t you agree!', 37.5665, 126.978, 1, '2014-07-22 05:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `ips`
--

CREATE TABLE IF NOT EXISTS `ips` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `ip` varchar(20) NOT NULL,
  `user_likes` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ips`
--

INSERT INTO `ips` (`ID`, `latitude`, `longitude`, `ip`, `user_likes`) VALUES
(1, 37.5665, 126.978, '::1', 1502);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `feedID` int(11) NOT NULL,
  `ipID` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`ID`, `feedID`, `ipID`, `timestamp`) VALUES
(1, 1, 1, '2014-07-16 04:19:23'),
(2, 2, 1, '2014-07-16 07:52:56'),
(3, 6, 1, '2014-07-21 00:34:23'),
(4, 10, 1, '2014-07-21 00:38:39'),
(5, 4, 1, '2014-07-22 04:58:59'),
(6, 7, 1, '2014-07-22 05:05:50'),
(7, 14, 1, '2014-07-22 05:08:44'),
(8, 9, 1, '2014-07-22 05:09:36'),
(9, 5, 1, '2014-07-22 05:10:38'),
(10, 11, 1, '2014-07-22 05:17:03'),
(11, 15, 1, '2014-07-22 05:39:36');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
