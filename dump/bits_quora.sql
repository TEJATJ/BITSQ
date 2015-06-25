-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2015 at 05:56 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bits_quora`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'GATE preparations', 'Added by:2,TEJATJK,f2013034@pilani.bits-pilani.ac.in'),
(2, 'student problens', 'Added by:2,TEJATJK,f2013034@pilani.bits-pilani.ac.in'),
(3, 'social life', 'Added by:1,TEJATJ,f2013034@pilani.bits-pilani.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `val` int(11) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `link` text NOT NULL,
  `seen` smallint(6) NOT NULL,
  `last_activity` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE IF NOT EXISTS `replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `t_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `body` text NOT NULL,
  `last_activity` datetime NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `category_id`, `user_id`, `title`, `body`, `last_activity`, `create_date`) VALUES
(1, 1, 1, 'What are the other ways to prepare for GATE in BITS ?', 'are there any others ways to prepare for GATE without compromising on the acads.', '2015-02-24 05:41:08', '2015-02-24 05:41:08'),
(2, 2, 1, 'What are the changes that a student would like to see in the facultty at BITS-pilani?', '', '2015-02-24 05:42:09', '2015-02-24 05:42:09'),
(3, 3, 1, 'What are some interesting club/department interaction stories', '', '2015-02-24 05:54:58', '2015-02-24 05:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `upvotes`
--

CREATE TABLE IF NOT EXISTS `upvotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `t_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `vote` int(11) NOT NULL DEFAULT '0',
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `upvotes`
--

INSERT INTO `upvotes` (`id`, `t_id`, `r_id`, `u_id`, `vote`, `last_activity`) VALUES
(1, 3, 0, 1, 1, '2015-02-24 00:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(55) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(64) NOT NULL,
  `about` text NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_activity` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `username`, `password`, `about`, `join_date`, `last_activity`) VALUES
(1, 'TEJATJ', 'f2013034@pilani.bits-pilani.ac.in', 'DSC_0181.JPG', 'TEJATJ', '14e1b600b1fd579f47433b88e8d85291', 'zsdjbfkjabsdfkjnk', '2015-02-24 05:51:31', '2015-02-24 05:51:31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
