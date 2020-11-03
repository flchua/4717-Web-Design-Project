-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2020 at 11:02 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `f35ee`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `ctt_id` int(11) NOT NULL AUTO_INCREMENT,
  `ctt_salulation` char(3) DEFAULT NULL,
  `ctt_name` varchar(30) DEFAULT NULL,
  `ctt_email` varchar(30) DEFAULT NULL,
  `ctt_comment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ctt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `eventBooking_transactions`
--

CREATE TABLE IF NOT EXISTS `eventBooking_transactions` (
  `trans_id` int(10) NOT NULL AUTO_INCREMENT,
  `trans_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trans_dollars` float NOT NULL,
  `user_email` varchar(20) NOT NULL,
  `delivery_name` varchar(20) NOT NULL,
  `delivery_phone` varchar(10) NOT NULL,
  `delivery_email` varchar(20) NOT NULL,
  `delivery_address` varchar(50) NOT NULL,
  `delivery_postcode` varchar(20) NOT NULL,
  `events_booked` varchar(60) NOT NULL,
  PRIMARY KEY (`trans_id`),
  KEY `eventBooking_transactions_FK` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `foodDelivery_transactions`
--

CREATE TABLE IF NOT EXISTS `foodDelivery_transactions` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trans_dollars` float NOT NULL,
  `user_email` varchar(20) NOT NULL,
  `delivery_name` varchar(20) NOT NULL,
  `delivery_phone` varchar(10) NOT NULL,
  `delivery_email` varchar(20) NOT NULL,
  `delivery_address` varchar(50) NOT NULL,
  `delivery_postcode` varchar(20) NOT NULL,
  `order_id` int(150) NOT NULL,
  PRIMARY KEY (`trans_id`),
  UNIQUE KEY `food_ordered_id` (`order_id`),
  KEY `foodDelivery_transactions_FK` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_price` float DEFAULT NULL,
  `product_cat` varchar(20) DEFAULT NULL,
  `img` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`product_id`, `product_name`, `product_price`, `product_cat`, `img`) VALUES
(0, 'Sliced Beef with Black Pepper Sauce', 20, 'meat', 0),
(1, 'Double Cooked Pork with Chinese Leek', 16, 'meat', 0),
(2, 'Spicy Chicken', 18, 'meat', 0),
(3, 'Fish Filets in Hot Chili Oil', 22, 'meat', 0),
(4, 'Egg Plant with Minced Chicken and Sichuan Chilli S', 10, 'vege', 0),
(5, 'Lettuce in Oyster Sauce', 8, 'vege', 0),
(6, 'Bai Mu Dan White Peony Tea', 5, 'drink', 0),
(7, 'Oolong Tea', 4.5, 'drink', 0),
(8, 'Sweet-sour Plum Juice', 3.5, 'drink', 0),
(9, 'Traditional Chinese Liquor', 11, 'drink', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_review`
--

CREATE TABLE IF NOT EXISTS `order_review` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `order_review`
--

INSERT INTO `order_review` (`order_id`, `name`, `price`, `qty`) VALUES
(1, 'coke', 10, 1),
(3, 'A', 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE IF NOT EXISTS `reserve` (
  `rsv_id` int(11) NOT NULL AUTO_INCREMENT,
  `rsv_salulation` char(3) DEFAULT NULL,
  `rsv_name` varchar(30) DEFAULT NULL,
  `rsv_phone` varchar(15) DEFAULT NULL,
  `rsv_email` varchar(30) DEFAULT NULL,
  `rsv_date` date DEFAULT NULL,
  `rsv_time` varchar(10) DEFAULT NULL,
  `rsv_pax` int(1) DEFAULT NULL,
  `rsv_comment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rsv_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `reserve`
--

INSERT INTO `reserve` (`rsv_id`, `rsv_salulation`, `rsv_name`, `rsv_phone`, `rsv_email`, `rsv_date`, `rsv_time`, `rsv_pax`, `rsv_comment`) VALUES
(1, 'Mr.', 'sd', '211', 'sdas@sad', '2020-11-12', '12:00', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_firstName` varchar(20) DEFAULT NULL,
  `user_lastName` varchar(20) DEFAULT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_email`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_firstName`, `user_lastName`, `user_email`, `user_password`) VALUES
('Nannan', 'Chen', '123@123', '202cb962ac59075b964b07152d234b70');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eventBooking_transactions`
--
ALTER TABLE `eventBooking_transactions`
  ADD CONSTRAINT `eventBooking_transactions_FK` FOREIGN KEY (`user_email`) REFERENCES `users` (`user_email`);

--
-- Constraints for table `foodDelivery_transactions`
--
ALTER TABLE `foodDelivery_transactions`
  ADD CONSTRAINT `foodDelivery_transactions_FK` FOREIGN KEY (`user_email`) REFERENCES `users` (`user_email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
