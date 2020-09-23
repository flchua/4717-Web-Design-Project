-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 03, 2018 at 03:18 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `f31im`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `showtime_id` int(100) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `email`, `showtime_id`, `total_price`) VALUES
(59, 'valishru@hotmail.com', 284, '39.50'),
(58, 'valishru@hotmail.com', 281, '49.00'),
(57, 'valishru@hotmail.com', 280, '11.00'),
(56, 'valishru@hotmail.com', 283, '30.00'),
(55, 'valishru@hotmail.com', 279, '27.50'),
(54, 'valishru@hotmail.com', 282, '49.00');

-- --------------------------------------------------------

--
-- Table structure for table `cinemas`
--

DROP TABLE IF EXISTS `cinemas`;
CREATE TABLE IF NOT EXISTS `cinemas` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `location` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cinemas`
--

INSERT INTO `cinemas` (`id`, `name`, `location`) VALUES
(1, 'Jurong Point', '1 Jurong West Central, #03-25B/26, Jurong Point, Singapore 648886'),
(2, 'NEX', '23 Serangoon Central, #04-64, NEX, Singapore 556083'),
(3, 'Plaza Singapura', '68 Orchard Road, #07-01, Plaza Singapura, Singapore 238839'),
(4, 'Tampines Mall', '4 Tampines Central, #04-17/18, Tampines Mall, Singapore 529510'),
(5, 'Junction 8', '9 Bishan Place, #04-03, Junction 8 Shopping Centre, Singapore 579837');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `releaseDate` date NOT NULL,
  `cast` varchar(200) NOT NULL,
  `director` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `genre` varchar(200) NOT NULL,
  `language` varchar(200) NOT NULL,
  `stars` float DEFAULT NULL,
  `rating` varchar(10) DEFAULT NULL,
  `runtime` int(11) DEFAULT NULL,
  `poster` varchar(100) NOT NULL,
  `trailer` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `releaseDate`, `cast`, `director`, `description`, `genre`, `language`, `stars`, `rating`, `runtime`, `poster`, `trailer`) VALUES
(1, 'First Man', '2018-10-18', 'Ryan Gosling, Jason Clarke, Ciaran Hinds, Kyle Chandler, Shea Whigham, Corey Stoll, Lukas Haas, Patrick Fugit, Pablo Schreiber, Claire Foy', 'Damien Chazelle', 'This biography-drama film follows the story of Neil Armstrong and his journey to becoming the first human being to ever step on the Moon. It focuses on the years leading up to Armstrong\'s Apollo 11 mission in 1969.', 'Biography, Drama', 'English', 4, 'PG13', 120, 'firstman.jpg', 'PSoRx87OO6k'),
(2, 'Bohemian Rhapsody', '2018-11-01', 'Rami Malek, Lucy Boynton, Gwilym Lee, Ben Hardy, Joseph Mazzello', 'Bryan Singer', 'Based on the life of British rock legends Queen, the movie chronicles 15 years of the band\'s life, starting from the band\'s formation up until their legendary performance at the Live Aid in 1985. The movie also centres on Freddie Mercury, the lead singer of the band who faced his untimely death in 1991.', 'Biography', 'English', 5, 'PG13', 136, 'bohemian.jpg', 'mP0VHJYFOAU'),
(8, 'Aquaman', '2018-12-20', 'Jason Momoa, Amber Heard, Willem Dafoe, Patrick Wilson, Dolph Lundgren, Temuera Morrison', 'James Wan', 'Following the events of Justice League, Arthur Curry, the reluctant ruler of the underwater kingdom of Atlantis, is caught in a battle between surface dwellers that threaten his oceans and his own people, who are ready to lash out and invade the surface.', 'Action, Adventure', 'English', NULL, NULL, NULL, 'aquaman.jpg', 'pm0RIOQvbhI'),
(5, 'Halloween', '2018-10-25', 'Will Patton, Jamie Lee Curtis', 'David Gordon Green', 'This sequel follows the events that take place 40 years after 1978\'s \"Halloween\". Laurie Strode, a survivor of masked psychopath Michael Myers\' killing spree, will have to face him once again in one final showdown.', 'Horror, Thriller', 'English', 3.5, 'M18', 106, 'halloween.jpg', 'ek1ePFp-nBI'),
(6, 'Venom', '2018-11-04', '\r\nTom Hardy, Michelle Williams, Riz Ahmed, Reid Scott, Jenny Slate', 'Ruben Fleischer', 'Tom Hardy stars in the lead role in this \"Spider-Man\" spinoff, which focuses on the titular anti-hero, Venom.', 'Action, Science Fiction', 'English', 3.5, 'PG13', 112, 'venom.jpg', 'u9Mv98Gr5pY'),
(4, 'A Star is Born', '2018-10-04', 'Bradley Cooper, Sam Elliott, Lady Gaga', 'Bradley Cooper', 'Jackson Maine (Bradley Cooper) is a fading country music star who discovers a talented unknown, Ally (Lady Gaga), and helps catapult her to stardom. The two also begin a passionate love affair. But with Ally\'s career now bigger and brighter than his, Jack finds it harder to handle losing the glory he once had.', 'Drama, Musical, Romance', 'English', 4, 'M18', 135, 'star.jpg', 'nSbzyEJ8X9E'),
(3, 'Kung Fu League', '2018-11-01', 'Andy On, Vincent Zhao, Dennis To Yu-Hang, Danny Chan Kwok-kwan', 'Jeffrey Lau', 'Fei Ying Xiong is a young comic artist who wishes that the heroes in his work would come to life and help him. His wish comes true when Wong Fei-hung, Huo Yuan Jia, Ip Man and Chen Zhen appear in the modern era and agree to train him for a martial arts competition. He is hoping that with their help he will be able to win the competition and at the same time, the heart of his crush, Bao`er.', 'Action, Comedy', 'Mandarin', 2.5, 'PG', 102, 'kungfu.jpg', '2pDF8ec4Nzg'),
(9, 'Bumblebee: The Movie', '2018-12-20', 'Hailee Steinfeld, Kenneth Choi, John Cena, John Ortiz, Jorge Lendeborg Jr.', 'Travis Knight', 'Twenty years before the events of the first film, in 1987, Bumblebee takes refuge in a small California beach town junkyard, where a teenage girl named Charlie Watson takes him in. However, the two of them soon find themselves hunted by a government agency known as Sector 7, led by Agent Burns. As they run from society, the two learn that Bee isn\'t the only Transformer on Earth, and that the others might not be as friendly.', 'Action, Adventure', 'English', NULL, NULL, NULL, 'bumblebee.jpg', 'lcwmDAYt22k'),
(7, 'Fantastic Beasts: The Crimes Of Grindelwald', '2018-11-15', 'Johnny Depp, Jude Law, Eddie Redmayne, Zoe Kravitz, Dan Fogler, Carmen Ejogo, Ezra Miller, Claudia Kim, Katherine Waterston', 'David Yates', 'The devious Gellert Grindelwald plans to raise pure-blood wizards so that he can rule over all non-magical beings. To stop him, Magizoologist Newt Scamander will need to join forces with young Albus Dumbledore.', 'Adventure, Fantasy', 'English', NULL, NULL, NULL, 'fb.jpg', '8bYBOVWLNIs');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `size` varchar(50) NOT NULL,
  `qty` int(10) NOT NULL,
  `amt` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `product_id`, `size`, `qty`, `amt`, `date`) VALUES
(17, 1, 'endless', 5, 10.1, '2018-10-16 17:50:44'),
(16, 3, 'dbl', 1, 5.75, '2018-10-16 17:27:30'),
(15, 3, 'single', 3, 14.25, '2018-10-16 16:33:44'),
(14, 2, 'single', 1, 2, '2018-10-16 16:33:44'),
(11, 1, 'endless', 1, 2.02, '2018-10-15 16:21:54'),
(13, 1, 'endless', 1, 2.02, '2018-10-15 16:33:44'),
(12, 2, 'single', 1, 2, '2018-10-15 16:21:54'),
(18, 2, 'dbl', 2, 6, '2018-10-22 03:11:46'),
(19, 3, 'single', 1, 4.75, '2018-10-22 03:11:46'),
(20, 1, 'endless', 3, 6, '2018-10-22 03:21:32'),
(21, 2, 'single', 1, 2, '2018-10-22 05:19:48'),
(22, 1, 'endless', 1, 2, '2018-10-22 05:19:57'),
(23, 2, 'dbl', 1, 3, '2018-10-22 05:20:09'),
(24, 2, 'dbl', 1, 3, '2018-10-22 05:21:11'),
(25, 2, 'dbl', 1, 3, '2018-10-22 05:21:48'),
(26, 2, 'dbl', 1, 3, '2018-10-22 05:22:07'),
(27, 2, 'dbl', 1, 3, '2018-10-22 05:22:16'),
(28, 2, 'dbl', 1, 3, '2018-10-22 05:22:21'),
(29, 2, 'dbl', 1, 3, '2018-10-22 05:22:29'),
(30, 2, 'dbl', 1, 3, '2018-10-22 05:22:46'),
(31, 2, 'dbl', 1, 3, '2018-10-22 05:23:08'),
(32, 2, 'dbl', 1, 3, '2018-10-22 05:23:32'),
(33, 2, 'dbl', 1, 3, '2018-10-22 05:23:56'),
(34, 2, 'dbl', 1, 3, '2018-10-22 05:24:06'),
(35, 1, 'endless', 1, 2, '2018-10-22 05:31:23'),
(36, 3, 'dbl', 6, 34.5, '2018-10-22 05:31:23'),
(37, 1, 'endless', 1, 2, '2018-10-22 05:32:01'),
(38, 3, 'dbl', 6, 34.5, '2018-10-22 05:32:01'),
(39, 2, 'single', 5, 10, '2018-10-22 05:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `reserved_seats`
--

DROP TABLE IF EXISTS `reserved_seats`;
CREATE TABLE IF NOT EXISTS `reserved_seats` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `booking_id` int(100) NOT NULL,
  `row_no` int(1) NOT NULL,
  `seat_no` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reserved_seats`
--

INSERT INTO `reserved_seats` (`id`, `booking_id`, `row_no`, `seat_no`) VALUES
(98, 58, 4, 4),
(97, 58, 4, 3),
(96, 58, 4, 2),
(95, 58, 4, 1),
(94, 57, 1, 6),
(93, 56, 4, 8),
(92, 56, 4, 7),
(91, 56, 4, 6),
(90, 55, 4, 5),
(89, 55, 4, 4),
(88, 54, 5, 10),
(87, 54, 5, 9),
(86, 54, 5, 8),
(85, 54, 5, 7),
(84, 54, 5, 6),
(83, 53, 5, 8),
(82, 53, 5, 7),
(81, 53, 5, 6),
(80, 53, 4, 8),
(79, 53, 4, 7),
(78, 53, 4, 6),
(77, 52, 4, 8),
(76, 52, 4, 7),
(75, 52, 4, 6),
(74, 51, 5, 5),
(73, 51, 5, 4),
(72, 51, 5, 3),
(71, 51, 5, 2),
(70, 51, 5, 1),
(69, 50, 5, 3),
(68, 50, 5, 2),
(67, 50, 5, 1),
(66, 49, 5, 7),
(65, 49, 5, 6),
(64, 48, 5, 9),
(63, 48, 5, 8),
(99, 58, 4, 5),
(100, 59, 4, 4),
(101, 59, 4, 5),
(102, 59, 5, 4),
(103, 59, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

DROP TABLE IF EXISTS `showtimes`;
CREATE TABLE IF NOT EXISTS `showtimes` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `cinema_id` int(100) NOT NULL,
  `movie_id` int(100) NOT NULL,
  `showtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=285 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`id`, `cinema_id`, `movie_id`, `showtime`) VALUES
(15, 1, 1, '2018-11-05 15:30:00'),
(16, 1, 1, '2018-11-05 19:00:00'),
(17, 1, 1, '2018-11-05 20:20:00'),
(18, 1, 1, '2018-11-06 10:30:00'),
(19, 1, 1, '2018-11-06 13:00:00'),
(20, 1, 1, '2018-11-06 16:00:00'),
(21, 1, 1, '2018-11-06 21:00:00'),
(22, 1, 1, '2018-11-07 14:45:00'),
(23, 1, 1, '2018-11-07 17:30:00'),
(24, 1, 1, '2018-11-07 22:00:00'),
(25, 2, 1, '2018-11-05 09:30:00'),
(26, 2, 1, '2018-11-05 14:34:00'),
(27, 2, 1, '2018-11-05 18:00:00'),
(28, 2, 1, '2018-11-05 19:20:00'),
(29, 2, 1, '2018-11-06 12:45:00'),
(30, 2, 1, '2018-11-06 14:10:00'),
(31, 2, 1, '2018-11-06 20:00:00'),
(32, 2, 1, '2018-11-07 12:45:00'),
(33, 2, 1, '2018-11-07 16:30:00'),
(34, 2, 1, '2018-11-07 21:05:00'),
(35, 3, 1, '2018-11-05 12:30:00'),
(36, 3, 1, '2018-11-05 15:55:00'),
(37, 3, 1, '2018-11-05 20:20:00'),
(38, 3, 1, '2018-11-06 13:20:00'),
(39, 3, 1, '2018-11-06 16:50:00'),
(40, 3, 1, '2018-11-07 14:45:00'),
(41, 3, 1, '2018-11-07 17:30:00'),
(42, 3, 1, '2018-11-07 22:15:00'),
(43, 4, 1, '2018-11-05 11:30:00'),
(44, 4, 1, '2018-11-05 18:05:00'),
(45, 4, 1, '2018-11-05 20:25:00'),
(46, 4, 1, '2018-11-06 10:35:00'),
(47, 4, 1, '2018-11-06 13:10:00'),
(48, 4, 1, '2018-11-06 16:15:00'),
(49, 4, 1, '2018-11-06 21:50:00'),
(50, 4, 1, '2018-11-07 17:30:00'),
(51, 4, 1, '2018-11-07 20:00:00'),
(52, 5, 1, '2018-11-05 15:35:00'),
(53, 5, 1, '2018-11-05 20:25:00'),
(54, 5, 1, '2018-11-06 13:35:00'),
(55, 5, 1, '2018-11-06 16:40:00'),
(56, 5, 1, '2018-11-06 21:15:00'),
(57, 5, 1, '2018-11-07 17:30:00'),
(58, 5, 1, '2018-11-07 19:50:00'),
(59, 1, 2, '2018-11-05 15:30:00'),
(60, 1, 2, '2018-11-05 19:00:00'),
(61, 1, 2, '2018-11-05 20:20:00'),
(62, 1, 2, '2018-11-06 10:30:00'),
(63, 1, 2, '2018-11-06 13:00:00'),
(64, 1, 2, '2018-11-06 16:00:00'),
(65, 1, 2, '2018-11-06 21:00:00'),
(66, 1, 2, '2018-11-07 14:45:00'),
(67, 1, 2, '2018-11-07 17:30:00'),
(68, 1, 2, '2018-11-07 22:00:00'),
(69, 2, 2, '2018-11-05 09:30:00'),
(70, 2, 2, '2018-11-05 14:34:00'),
(71, 2, 2, '2018-11-05 18:00:00'),
(72, 2, 2, '2018-11-05 19:20:00'),
(73, 2, 2, '2018-11-06 12:45:00'),
(74, 2, 2, '2018-11-06 14:10:00'),
(75, 2, 2, '2018-11-06 20:00:00'),
(76, 2, 2, '2018-11-07 12:45:00'),
(77, 2, 2, '2018-11-07 16:30:00'),
(78, 2, 2, '2018-11-07 21:05:00'),
(79, 3, 2, '2018-11-05 12:30:00'),
(80, 3, 2, '2018-11-05 15:55:00'),
(81, 3, 2, '2018-11-05 20:20:00'),
(82, 3, 2, '2018-11-06 13:20:00'),
(83, 3, 2, '2018-11-06 16:50:00'),
(84, 3, 2, '2018-11-07 14:45:00'),
(85, 3, 2, '2018-11-07 17:30:00'),
(86, 3, 2, '2018-11-07 22:15:00'),
(87, 4, 2, '2018-11-05 11:30:00'),
(88, 4, 2, '2018-11-05 18:05:00'),
(89, 4, 2, '2018-11-05 20:25:00'),
(90, 4, 2, '2018-11-06 10:35:00'),
(91, 4, 2, '2018-11-06 13:10:00'),
(92, 4, 2, '2018-11-06 16:15:00'),
(93, 4, 2, '2018-11-06 21:50:00'),
(94, 4, 2, '2018-11-07 17:30:00'),
(95, 4, 2, '2018-11-07 20:00:00'),
(96, 5, 2, '2018-11-05 15:35:00'),
(97, 5, 2, '2018-11-05 20:25:00'),
(98, 5, 2, '2018-11-06 13:35:00'),
(99, 5, 2, '2018-11-06 16:40:00'),
(100, 5, 2, '2018-11-06 21:15:00'),
(101, 5, 2, '2018-11-07 17:30:00'),
(102, 5, 2, '2018-11-07 19:50:00'),
(103, 1, 3, '2018-11-05 15:30:00'),
(104, 1, 3, '2018-11-05 19:00:00'),
(105, 1, 3, '2018-11-05 20:20:00'),
(106, 1, 3, '2018-11-06 10:30:00'),
(107, 1, 3, '2018-11-06 13:00:00'),
(108, 1, 3, '2018-11-06 16:00:00'),
(109, 1, 3, '2018-11-06 21:00:00'),
(110, 1, 3, '2018-11-07 14:45:00'),
(111, 1, 3, '2018-11-07 17:30:00'),
(112, 1, 3, '2018-11-07 22:00:00'),
(113, 2, 3, '2018-11-05 09:30:00'),
(114, 2, 3, '2018-11-05 14:34:00'),
(115, 2, 3, '2018-11-05 18:00:00'),
(116, 2, 3, '2018-11-05 19:20:00'),
(117, 2, 3, '2018-11-06 12:45:00'),
(118, 2, 3, '2018-11-06 14:10:00'),
(119, 2, 3, '2018-11-06 20:00:00'),
(120, 2, 3, '2018-11-07 12:45:00'),
(121, 2, 3, '2018-11-07 16:30:00'),
(122, 2, 3, '2018-11-07 21:05:00'),
(123, 3, 3, '2018-11-05 12:30:00'),
(124, 3, 3, '2018-11-05 15:55:00'),
(125, 3, 3, '2018-11-05 20:20:00'),
(126, 3, 3, '2018-11-06 13:20:00'),
(127, 3, 3, '2018-11-06 16:50:00'),
(128, 3, 3, '2018-11-07 14:45:00'),
(129, 3, 3, '2018-11-07 17:30:00'),
(130, 3, 3, '2018-11-07 22:15:00'),
(131, 4, 3, '2018-11-05 11:30:00'),
(132, 4, 3, '2018-11-05 18:05:00'),
(133, 4, 3, '2018-11-05 20:25:00'),
(134, 4, 3, '2018-11-06 10:35:00'),
(135, 4, 3, '2018-11-06 13:10:00'),
(136, 4, 3, '2018-11-06 16:15:00'),
(137, 4, 3, '2018-11-06 21:50:00'),
(138, 4, 3, '2018-11-07 17:30:00'),
(139, 4, 3, '2018-11-07 20:00:00'),
(140, 5, 3, '2018-11-05 15:35:00'),
(141, 5, 3, '2018-11-05 20:25:00'),
(142, 5, 3, '2018-11-06 13:35:00'),
(143, 5, 3, '2018-11-06 16:40:00'),
(144, 5, 3, '2018-11-06 21:15:00'),
(145, 5, 3, '2018-11-07 17:30:00'),
(146, 5, 3, '2018-11-07 19:50:00'),
(147, 1, 4, '2018-11-05 15:30:00'),
(148, 1, 4, '2018-11-05 19:00:00'),
(149, 1, 4, '2018-11-05 20:20:00'),
(150, 1, 4, '2018-11-06 10:30:00'),
(151, 1, 4, '2018-11-06 13:00:00'),
(152, 1, 4, '2018-11-06 16:00:00'),
(153, 1, 4, '2018-11-06 21:00:00'),
(154, 1, 4, '2018-11-07 14:45:00'),
(155, 1, 4, '2018-11-07 17:30:00'),
(156, 1, 4, '2018-11-07 22:00:00'),
(157, 2, 4, '2018-11-05 09:30:00'),
(158, 2, 4, '2018-11-05 14:34:00'),
(159, 2, 4, '2018-11-05 18:00:00'),
(160, 2, 4, '2018-11-05 19:20:00'),
(161, 2, 4, '2018-11-06 12:45:00'),
(162, 2, 4, '2018-11-06 14:10:00'),
(163, 2, 4, '2018-11-06 20:00:00'),
(164, 2, 4, '2018-11-07 12:45:00'),
(165, 2, 4, '2018-11-07 16:30:00'),
(166, 2, 4, '2018-11-07 21:05:00'),
(167, 3, 4, '2018-11-05 12:30:00'),
(168, 3, 4, '2018-11-05 15:55:00'),
(169, 3, 4, '2018-11-05 20:20:00'),
(170, 3, 4, '2018-11-06 13:20:00'),
(171, 3, 4, '2018-11-06 16:50:00'),
(172, 3, 4, '2018-11-07 14:45:00'),
(173, 3, 4, '2018-11-07 17:30:00'),
(174, 3, 4, '2018-11-07 22:15:00'),
(175, 4, 4, '2018-11-05 11:30:00'),
(176, 4, 4, '2018-11-05 18:05:00'),
(177, 4, 4, '2018-11-05 20:25:00'),
(178, 4, 4, '2018-11-06 10:35:00'),
(179, 4, 4, '2018-11-06 13:10:00'),
(180, 4, 4, '2018-11-06 16:15:00'),
(181, 4, 4, '2018-11-06 21:50:00'),
(182, 4, 4, '2018-11-07 17:30:00'),
(183, 4, 4, '2018-11-07 20:00:00'),
(184, 5, 4, '2018-11-05 15:35:00'),
(185, 5, 4, '2018-11-05 20:25:00'),
(186, 5, 4, '2018-11-06 13:35:00'),
(187, 5, 4, '2018-11-06 16:40:00'),
(188, 5, 4, '2018-11-06 21:15:00'),
(189, 5, 4, '2018-11-07 17:30:00'),
(190, 5, 4, '2018-11-07 19:50:00'),
(191, 1, 5, '2018-11-05 15:30:00'),
(192, 1, 5, '2018-11-05 19:00:00'),
(193, 1, 5, '2018-11-05 20:20:00'),
(194, 1, 5, '2018-11-06 10:30:00'),
(195, 1, 5, '2018-11-06 13:00:00'),
(196, 1, 5, '2018-11-06 16:00:00'),
(197, 1, 5, '2018-11-06 21:00:00'),
(198, 1, 5, '2018-11-07 14:45:00'),
(199, 1, 5, '2018-11-07 17:30:00'),
(200, 1, 5, '2018-11-07 22:00:00'),
(201, 2, 5, '2018-11-05 09:30:00'),
(202, 2, 5, '2018-11-05 14:34:00'),
(203, 2, 5, '2018-11-05 18:00:00'),
(204, 2, 5, '2018-11-05 19:20:00'),
(205, 2, 5, '2018-11-06 12:45:00'),
(206, 2, 5, '2018-11-06 14:10:00'),
(207, 2, 5, '2018-11-06 20:00:00'),
(208, 2, 5, '2018-11-07 12:45:00'),
(209, 2, 5, '2018-11-07 16:30:00'),
(210, 2, 5, '2018-11-07 21:05:00'),
(211, 3, 5, '2018-11-05 12:30:00'),
(212, 3, 5, '2018-11-05 15:55:00'),
(213, 3, 5, '2018-11-05 20:20:00'),
(214, 3, 5, '2018-11-06 13:20:00'),
(215, 3, 5, '2018-11-06 16:50:00'),
(216, 3, 5, '2018-11-07 14:45:00'),
(217, 3, 5, '2018-11-07 17:30:00'),
(218, 3, 5, '2018-11-07 22:15:00'),
(219, 4, 5, '2018-11-05 11:30:00'),
(220, 4, 5, '2018-11-05 18:05:00'),
(221, 4, 5, '2018-11-05 20:25:00'),
(222, 4, 5, '2018-11-06 10:35:00'),
(223, 4, 5, '2018-11-06 13:10:00'),
(224, 4, 5, '2018-11-06 16:15:00'),
(225, 4, 5, '2018-11-06 21:50:00'),
(226, 4, 5, '2018-11-07 17:30:00'),
(227, 4, 5, '2018-11-07 20:00:00'),
(228, 5, 5, '2018-11-05 15:35:00'),
(229, 5, 5, '2018-11-05 20:25:00'),
(230, 5, 5, '2018-11-06 13:35:00'),
(231, 5, 5, '2018-11-06 16:40:00'),
(232, 5, 5, '2018-11-06 21:15:00'),
(233, 5, 5, '2018-11-07 17:30:00'),
(234, 5, 5, '2018-11-07 19:50:00'),
(235, 1, 6, '2018-11-05 15:30:00'),
(236, 1, 6, '2018-11-05 19:00:00'),
(237, 1, 6, '2018-11-05 20:20:00'),
(238, 1, 6, '2018-11-06 10:30:00'),
(239, 1, 6, '2018-11-06 13:00:00'),
(240, 1, 6, '2018-11-06 16:00:00'),
(241, 1, 6, '2018-11-06 21:00:00'),
(242, 1, 6, '2018-11-07 14:45:00'),
(243, 1, 6, '2018-11-07 17:30:00'),
(244, 1, 6, '2018-11-07 22:00:00'),
(245, 2, 6, '2018-11-05 09:30:00'),
(246, 2, 6, '2018-11-05 14:34:00'),
(247, 2, 6, '2018-11-05 18:00:00'),
(248, 2, 6, '2018-11-05 19:20:00'),
(249, 2, 6, '2018-11-06 12:45:00'),
(250, 2, 6, '2018-11-06 14:10:00'),
(251, 2, 6, '2018-11-06 20:00:00'),
(252, 2, 6, '2018-11-07 12:45:00'),
(253, 2, 6, '2018-11-07 16:30:00'),
(254, 2, 6, '2018-11-07 21:05:00'),
(255, 3, 6, '2018-11-05 12:30:00'),
(256, 3, 6, '2018-11-05 15:55:00'),
(257, 3, 6, '2018-11-05 20:20:00'),
(258, 3, 6, '2018-11-06 13:20:00'),
(259, 3, 6, '2018-11-06 16:50:00'),
(260, 3, 6, '2018-11-07 14:45:00'),
(261, 3, 6, '2018-11-07 17:30:00'),
(262, 3, 6, '2018-11-07 22:15:00'),
(263, 4, 6, '2018-11-05 11:30:00'),
(264, 4, 6, '2018-11-05 18:05:00'),
(265, 4, 6, '2018-11-05 20:25:00'),
(266, 4, 6, '2018-11-06 10:35:00'),
(267, 4, 6, '2018-11-06 13:10:00'),
(268, 4, 6, '2018-11-06 16:15:00'),
(269, 4, 6, '2018-11-06 21:50:00'),
(270, 4, 6, '2018-11-07 17:30:00'),
(271, 4, 6, '2018-11-07 20:00:00'),
(272, 5, 6, '2018-11-05 15:35:00'),
(273, 5, 6, '2018-11-05 20:25:00'),
(274, 5, 6, '2018-11-06 13:35:00'),
(275, 5, 6, '2018-11-06 16:40:00'),
(276, 5, 6, '2018-11-06 21:15:00'),
(277, 5, 6, '2018-11-07 17:30:00'),
(278, 5, 6, '2018-11-07 19:50:00'),
(279, 1, 1, '2018-11-03 11:10:00'),
(280, 2, 2, '2018-11-02 12:25:00'),
(281, 3, 3, '2018-11-01 13:30:00'),
(282, 4, 4, '2018-10-30 14:45:00'),
(283, 5, 5, '2018-10-29 15:50:00'),
(284, 1, 6, '2018-10-28 16:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `password`, `email`) VALUES
('Varick Lim', '17d3aa09841fef5c40c1c54267d7dd0a3903c7b1', 'valishru@hotmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
