-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2016 at 03:43 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


--
-- Database: `bazaar`
--
CREATE DATABASE IF NOT EXISTS `bazaar`;
USE `bazaar`;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `descri` text NOT NULL,
  `price` int(20) NOT NULL,
  `btime` datetime NOT NULL,
  `cid` int(11) NOT NULL,
  `image` text NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `mob` text NOT NULL,
  `uid` int(11) NOT NULL, 
  PRIMARY KEY (`pid`),
  KEY `cid` (`cid`),
  KEY `uid` (`uid`)
);

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `title`, `descri`, `price`, `btime`, `cid`, `image`, `name`, `email`, `mob`,`uid`) VALUES
(1, 'Red Car', 'Sport Racing Car', 89499, '2025-12-31 00:00:00', 5, 'assets/redcar.jpeg', 'Alex', 'alex123@hotmail.com', '46852325',1);


-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE IF NOT EXISTS `bid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Price` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`id`, `Name`, `Price`, `pid`) VALUES
(24, 'mohamed', 90000, 1),
(25, 'sara', 600000, 1),
(26, 'fatima', 600500, 1),
(27, 'ali', 610000, 1),
(28, 'mohamed', 620000, 1),
(29, 'Jassem', 620500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `Email` text NOT NULL,
  `FirstName` text NOT NULL,
  `LastName` text NOT NULL,
  `Mob` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `Email`, `FirstName`, `LastName`, `Mob`, `password`) VALUES
(1, 'wewe', 'qwq', 'wqw', 'sa', '123');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL DEFAULT '',
  `link` varchar(100) NOT NULL DEFAULT '#',
  `parent` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `label`, `link`, `parent`, `sort`) VALUES
(1, 'Jewelry', '#', 0, 0),
(2, 'Furniture', '#', 0, 0),
(3, 'Books', '#', 0, 0),
(4, 'Electronics', '#', 0, 0),
(5, 'Cars', '#', 0, 0),
(6, 'Clothes', '#', 0, 0),
(7, 'Games', '#', 0, 0),
(8, 'Animals', '#', 0, 0);

--
-- Admin Table structure for table `admin`
--

Create table admin(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Relationships for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_has_category` FOREIGN KEY (`cid`) REFERENCES `category` (`id`);

ALTER TABLE `product`
  ADD CONSTRAINT `user_has_products` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);

ALTER TABLE `bid`
  ADD CONSTRAINT `product_has_bids` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`);

