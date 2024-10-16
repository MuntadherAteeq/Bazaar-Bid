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
  `uid` int(11) NOT NULL, 
  PRIMARY KEY (`pid`),
  KEY `cid` (`cid`),
  KEY `uid` (`uid`)
);


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
);


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
);

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

INSERT INTO `admin` (`id`, `username`, `password`) VALUES (NULL, 'admin', 'admin');
--
-- Relationships for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_has_category` FOREIGN KEY (`cid`) REFERENCES `category` (`id`);

ALTER TABLE `product`
  ADD CONSTRAINT `user_has_products` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);

ALTER TABLE `bid`
  ADD CONSTRAINT `product_has_bids` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`);

-- Inserting data into the `user` table
INSERT INTO `user` (`Email`, `FirstName`, `LastName`, `Mob`, `password`) VALUES
('ahmed.hassan@email.com', 'Ahmed', 'Hassan', '0501234567', 'pass123'),
('fatima.ali@email.com', 'Fatima', 'Ali', '0559876543', 'securepass456'),
('mohammed.ibrahim@email.com', 'Mohammed', 'Ibrahim', '0561112222', 'ibrahimpass789'),
('layla.omar@email.com', 'Layla', 'Omar', '0503334444', 'laylapass321'),
('yousef.nasser@email.com', 'Yousef', 'Nasser', '0555556666', 'yousef987'),
('amira.saeed@email.com', 'Amira', 'Saeed', '0507778888', 'amira654'),
('kareem.abdel@email.com', 'Kareem', 'Abdel', '0569990000', 'kareempass'),
('nour.mahmoud@email.com', 'Nour', 'Mahmoud', '0501112233', 'nourpass123'),
('hassan.ahmed@email.com', 'Hassan', 'Ahmed', '0554445555', 'hassan456'),
('sara.khalid@email.com', 'Sara', 'Khalid', '0566667777', 'sarapass789'),
('ali.mohamed@email.com', 'Ali', 'Mohamed', '0508889999', 'alipass321'),
('zainab.hussein@email.com', 'Zainab', 'Hussein', '0552223333', 'zainabpass'),
('omar.fawzi@email.com', 'Omar', 'Fawzi', '0564445555', 'omarfawzi123'),
('rana.saleh@email.com', 'Rana', 'Saleh', '0506667777', 'ranapass456'),
('tarek.abdelrahman@email.com', 'Tarek', 'Abdelrahman', '0558889999', 'tarekpass789'),
('mariam.elshamy@email.com', 'Mariam', 'El-Shamy', '0560001111', 'mariampass'),
('khaled.gamal@email.com', 'Khaled', 'Gamal', '0502223333', 'khaledpass123'),
('dalia.hamdy@email.com', 'Dalia', 'Hamdy', '0554445555', 'daliahamdy456'),
('mustafa.sayed@email.com', 'Mustafa', 'Sayed', '0566667777', 'mustafapass'),
('hoda.farouk@email.com', 'Hoda', 'Farouk', '0508889999', 'hodapass321');

-- Inserting data into the `product` table
INSERT INTO `product` (`title`, `descri`, `price`, `btime`, `cid`, `image`, `uid`) VALUES
('Antique Arabic Coffee Pot', 'Beautiful brass dallah from the 19th century', 500, '2025-05-01 10:00:00', 1, 'assets/arabic_coffee_pot.jpg', 1),
('Handmade Persian Rug', 'Exquisite silk Persian rug with intricate designs', 2000, '2025-05-15 14:30:00', 2, 'assets/persian_rug.jpg', 2),
('Vintage Arabic Calligraphy Set', 'Complete set of traditional calligraphy tools', 300, '2025-06-01 11:45:00', 3, 'assets/calligraphy_set.jpg', 3),
('Moroccan Leather Pouf', 'Handcrafted leather pouf with embroidery', 150, '2025-06-15 09:30:00', 4, 'assets/moroccan_pouf.jpg', 4),
('Bedouin Silver Jewelry Box', 'Ornate silver jewelry box with pearl inlays', 800, '2025-07-01 13:15:00', 1, 'assets/jewelry_box.jpg', 5),
('Dodge Charger', 'Professional-grade oud made from premium wood', 1200, '2025-07-15 16:00:00', 5, 'assets/oud.jpg', 6),
('Damascene Mosaic Table', 'Intricate mother-of-pearl inlaid table', 600, '2025-08-01 10:30:00', 2, 'assets/mosaic_table.jpg', 7),
('Antique Islamic Manuscript', 'Rare 17th-century Quran manuscript', 5000, '2025-08-15 14:45:00', 3, 'assets/islamic_manuscript.jpg', 8),
('Egyptian Cotton Bedding Set', 'Luxury 1000 thread count bedding set', 250, '2025-09-01 11:00:00', 4, 'assets/cotton_bedding.jpg', 9),
('Moroccan Ceramic Tagine', 'Hand-painted ceramic cooking tagine', 80, '2025-09-15 09:15:00', 6, 'assets/ceramic_tagine.jpg', 10),
('Arabic Perfume Oil Set', 'Collection of traditional Arabic perfume oils', 180, '2025-10-01 15:30:00', 7, 'assets/perfume_oils.jpg', 11),
('Antique Brass Astrolabe', 'Functional replica of a medieval Arabic astrolabe', 350, '2025-10-15 12:45:00', 1, 'assets/astrolabe.jpg', 12),
('Embroidered Arabic Thobe', 'High-quality men''s thobe with gold embroidery', 200, '2025-11-01 10:00:00', 6, 'assets/thobe.jpg', 13),
('Moroccan Mosaic Fountain', 'Handcrafted indoor/outdoor mosaic fountain', 900, '2025-11-15 14:15:00', 2, 'assets/mosaic_fountain.jpg', 14),
('Arabic Majlis Seating Set', 'Complete traditional majlis seating arrangement', 1500, '2025-12-01 11:30:00', 4, 'assets/majlis_set.jpg', 15),
('Antique Omani Khanjar', 'Ceremonial Omani dagger with silver details', 700, '2025-12-15 09:45:00', 1, 'assets/omani_khanjar.jpg', 16),
('Syrian Mother-of-Pearl Mirror', 'Ornate wall mirror with intricate inlay work', 400, '2026-01-01 13:00:00', 2, 'assets/syrian_mirror.jpg', 17),
('Arabic Geometric Wall Art', 'Large-scale geometric art piece in gold leaf', 550, '2026-01-15 16:30:00', 3, 'assets/geometric_art.jpg', 18),
('Antique Bedouin Jewelry', 'Collection of authentic Bedouin silver jewelry', 1200, '2026-02-01 10:15:00', 1, 'assets/bedouin_jewelry.jpg', 19),
('Hand-Painted Arabic Pottery Set', 'Set of 6 hand-painted ceramic plates and bowls', 300, '2026-02-15 14:45:00', 6, 'assets/arabic_pottery.jpg', 20),
('Ferrari SR-7', 'Sport Racing Car', 89499, '2025-12-31 00:00:00', 5, 'assets/redcar.jpeg',1);


-- Inserting data into the `bid` table
INSERT INTO `bid` (`Name`, `Price`, `pid`) VALUES
('Fatima', 550, 1),
('Hassan', 580, 1),
('Layla', 600, 1),
('Mohammed', 2100, 2),
('Amira', 2200, 2),
('Yousef', 2300, 2),
('Nour', 320, 3),
('Kareem', 350, 3),
('Sara', 380, 3),
('Ali', 160, 4),
('Zainab', 180, 4),
('Omar', 200, 4),
('Rana', 850, 5),
('Tarek', 900, 5),
('Mariam', 950, 5),
('Khaled', 1250, 6),
('Dalia', 1300, 6),
('Mustafa', 1350, 6),
('Hoda', 650, 7),
('Ahmed', 700, 7);
