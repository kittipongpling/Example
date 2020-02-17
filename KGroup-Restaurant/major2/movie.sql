-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jan 03, 2014 at 10:41 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `movie`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `cinema`
-- 

CREATE TABLE `cinema` (
  `c_id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `cinema`
-- 

INSERT INTO `cinema` VALUES (1, 'โรงที่1');
INSERT INTO `cinema` VALUES (2, 'โรงที่22');

-- --------------------------------------------------------

-- 
-- Table structure for table `movie`
-- 

CREATE TABLE `movie` (
  `m_id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  PRIMARY KEY  (`m_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `movie`
-- 

INSERT INTO `movie` VALUES (1, 'Dragonball', 'http://www.hdwallpapersbank.com/wp-content/uploads/2013/08/Son-Goku-Goku-Dragon-Ball-Z-Fresh-New-hd-Wallpapers.jpg');
INSERT INTO `movie` VALUES (2, 'Doremon', 'http://2.bp.blogspot.com/-qwXiNm_81VA/S6x0YWWG9XI/AAAAAAAAAx0/zG_KT4WvqsQ/s1600/029832.jpg');

-- --------------------------------------------------------

-- 
-- Table structure for table `orders`
-- 

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL auto_increment,
  `c_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `seat_name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  PRIMARY KEY  (`o_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- 
-- Dumping data for table `orders`
-- 

INSERT INTO `orders` VALUES (11, 1, 1, 1, 'I004', '500');
INSERT INTO `orders` VALUES (10, 1, 1, 1, 'E0013', '150');
INSERT INTO `orders` VALUES (9, 1, 1, 1, 'A008', '90');
INSERT INTO `orders` VALUES (12, 1, 3, 1, 'D0014', '103');
INSERT INTO `orders` VALUES (13, 1, 1, 1, 'G0012', '300');
INSERT INTO `orders` VALUES (14, 1, 1, 1, 'G0015', '300');
INSERT INTO `orders` VALUES (15, 1, 3, 1, 'K001', '700');
INSERT INTO `orders` VALUES (16, 1, 2, 2, 'J0013', '600');
INSERT INTO `orders` VALUES (17, 1, 1, 1, 'K0020', '700');
INSERT INTO `orders` VALUES (18, 1, 1, 1, 'I0020', '500');
INSERT INTO `orders` VALUES (19, 1, 1, 1, 'F0018', '200');
INSERT INTO `orders` VALUES (20, 1, 1, 1, 'K0012', '700');
INSERT INTO `orders` VALUES (21, 1, 1, 1, 'D0016', '103');
INSERT INTO `orders` VALUES (22, 1, 1, 1, 'I0017', '500');
INSERT INTO `orders` VALUES (23, 1, 1, 1, 'G0017', '300');
INSERT INTO `orders` VALUES (24, 1, 2, 2, 'D0012', '103');

-- --------------------------------------------------------

-- 
-- Table structure for table `screen`
-- 

CREATE TABLE `screen` (
  `s_id` int(11) NOT NULL auto_increment,
  `m_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY  (`s_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `screen`
-- 

INSERT INTO `screen` VALUES (1, 1, 1, '2014-01-03', '23:00:00');
INSERT INTO `screen` VALUES (2, 2, 1, '2014-01-05', '18:00:00');
INSERT INTO `screen` VALUES (3, 1, 1, '2014-05-01', '10:00:00');
