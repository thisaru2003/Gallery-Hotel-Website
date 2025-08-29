-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 26, 2024 at 03:59 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery_cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(55) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT '0',
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `username`, `email`, `phone`, `address`, `profile_photo`, `is_verified`, `password`) VALUES
(1, 'thisaru jayawickrama', 'admin', 'thisarujayawickramaqw@gmail.com', '0776281645', '“Nimal”, Beach Road, Gandara , Sri Lanka123', 'managefood2.jpg', 1, '$2y$10$Ahzsu9o9iqao/vT5c4rwM.NA5gKKBKpOyzLXwRCHoA7lkewfBDY9e'),
(2, 'thisaru', 'admin2', 'thisarujayawickrama349@gmail.com', '0776281645', '“Nimal”, Beach Road, Gandara , Sri Lanka', 'Addfood2.jpg', 1, '$2y$10$j7TrpAPP.a3Q.bCGv7NQ3ecYUyOXI6RzjkzvS.qkuDrA5c9XOzVeG'),
(5, 'thinu', 'thinuadmin', 'thinu111@gmail.com', '12345', 'matara', NULL, 1, '$2y$10$DJ3L5sPyNi4FxihONF5wSupzrypeQY6LMKxvKVhNGX9w0/v9zrbYm');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`,`item_name`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_name`, `item_name`, `quantity`, `image_url`) VALUES
(29, '', 'MILKSHAKES', 1, '../Images/milkshake.jpg'),
(28, '', 'Hot Chocolate', 3, '../Images/hotchoclate.jpg'),
(27, '', 'Black Pork Curry', 11, '../Images/srilankan2.jpeg'),
(26, '', 'Tamarind Beef Curry', 39, '../Images/srilankan1.jpeg'),
(30, '', 'Prawn Curry', 1, '../Images/srilankan3.jpeg'),
(31, '', 'Mustard Fish Curry', 1, '../Images/srilankan4.jpeg'),
(32, '', 'Neapolitan Pizza', 1, '../Images/italian3.jpg'),
(33, '', 'Cappuccino ', 2, '../Images/cappuccino.jpg'),
(34, '', 'Coca Cola ', 1, '../Images/cocacola.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `celebrations`
--

DROP TABLE IF EXISTS `celebrations`;
CREATE TABLE IF NOT EXISTS `celebrations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `celebrations`
--

INSERT INTO `celebrations` (`id`, `title`, `description`, `image_url`) VALUES
(1, 'Mother’s Day ', '<p><em>Living overseas and looking for something special to get Mum back home this Mother&rsquo;s Day? We&rsquo;ve curated a special Paradise Road lunch and included a gift for Mum, which we&rsquo;ll deliver straight home to her. Pre-order before noon on 8th May for deliveries on 9th May | Direct message or WhatsApp +94 76 054 3388 for menu</em></p>', '../Images/mothersday.jpg'),
(2, 'Christmas at Paradise Road The Gallery Café', '<p>Enjoy our seasonal menu, hampers, private dining options and so much more in our alfresco spaces, with a new exhibition by Jagath Ravindra adorning our walls. WhatsApp +94760543388 for more information and for reservations! Join us to dine, in the privacy of a private function space or we\'ll deliver to you to enjoy at home.</p>', '../Images/naththal.jpg'),
(3, 'Father’s Day!', 'Treat your Father to afternoon tea and a slice of our signature cake or share a special meal at The Gallery Café this Father’s Day! Enjoy our signature dishes in Paradise Road style at our tropically modern open-air restaurant or from the comfort of your home 🍃 OPENING HOURS 10 AM – 11 PM | Last order 10.30 PM For reservations or delivery please call +94 (11) 258 2162 or WhatsApp us +94 (76) 054 3388', '../Images/fathersday.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `event_date` date DEFAULT NULL,
  `contact_info` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `image_url`, `event_date`, `contact_info`) VALUES
(1, 'Live Jazz by Brown Sugar', '<p>The festive season is finally upon us! Our latest seasonal menu launches at The Gallery Caf&eacute; on Wednesday, 1 December featuring Live Jazz by Brown Sugar from 7 PM onwards 💫. Inspired by all things Christmas, enjoy our specially curated starters, mains, desserts, and cocktails! 🥂🎄 For reservations or further enquiries please call +94 (11) 258 2162 or WhatsApp +94 (76) 054 3388 #EatParadiseRoad #TheGalleryCaf&eacute; #FestiveMenu #SeasonEntertainment</p>', '../Images/party.jpg', '2023-12-14', '+94 (11) 258 2162, +94 (76) 054 3388'),
(2, 'Reminiscence', '<p>Paradise Road Galleries presents &lsquo;Reminiscence&rsquo;, an exhibition and sale of paintings by local artist Susiman Nirmalavasan. Due to Covid-19 restrictions an Open Day Preview will be held on 29th April 2021 from 10AM-Midnight at Paradise Road Galleries, The Gallery Café, No. 2 Alfred House Road, Colombo 03. Connect with us on +94 (11) 258 2162 or email art@paradiseroad.lk for the e-catalogue and further information.</p>', '../Images/party2.jpg', '2021-04-29', '+94 (11) 258 2162, art@paradiseroad.lk');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `price` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `category`, `name`, `description`, `price`, `image_url`) VALUES
(13, 'Sri Lankan', 'Tamarind Beef Curry', '<p><span style=\"background-color: rgb(45, 194, 107);\">With rice, lentil curry, brinjal pahi, cucumber raita and gotukola sambol.</span></p>', 2050.00, '../Images/srilankan1.jpeg'),
(29, 'Beverages', 'Hot Chocolate', '....', 5000.00, '../Images/hotchoclate.jpg'),
(28, 'Beverages', 'MILKSHAKES', 'vanilla/chocolate/banana', 1500.00, '../Images/milkshake.jpg'),
(17, 'Special', 'Paradise Road Super Burger ', 'Beef burger with bacon, fried egg, cheddar \r\nand parmesan cheese, caramelised onions, \r\nlettuce, mayonnaise and hand cut fries.', 3600.00, '../Images/special1.jpg'),
(27, 'Italian', 'Neapolitan Pizza', 'Pizza made with tomatoes and mozzarella cheese. ', 4500.00, '../Images/italian3.jpg'),
(14, 'Sri Lankan', 'Black Pork Curry', 'With rice, lentil curry, brinjal pahi, cucumber raita \r\nand gotukola sambol.', 2750.00, '../Images/srilankan2.jpeg'),
(15, 'Sri Lankan', 'Prawn Curry', 'With rice, sautéed kang kung, cucumber raita \r\nand onion sambol. ', 2350.00, '../Images/srilankan3.jpeg'),
(16, 'Sri Lankan', 'Mustard Fish Curry', 'With rice, lentil curry, brinjal pahi, cucumber raita \r\nand gotukola sambo.', 2500.00, '../Images/srilankan4.jpeg'),
(18, 'Special', 'Grilled Fillet Steak ', 'With choice of \r\npotato mash / hand cut fries \r\ngreen salad / steamed vegetables \r\nbéarnaise / hollandaise / green pepper / \r\ngarlic butter sauce.', 4500.00, '../Images/special2.jpg'),
(19, 'Special', 'Grilled Lamb Cutlets ', 'With choice of \r\npotato mash / hand cut fries \r\ngreen salad / steamed vegetables \r\nbéarnaise / hollandaise / green pepper / \r\ngarlic butter sauce.', 4750.00, '../Images/special3.jpg'),
(20, 'Special', 'Twister + Cheese', 'Crispy chicken, cheese, Onion, lettuce, Tomato mixed with our delicious sauce wrapped in a warm.', 1250.00, '../Images/special4.jpg'),
(21, 'Special', 'Submarine', 'Boneless breaded chicken cubes, Our Special Charger Devil, Pepper mayo in-between two toasted buns.', 2500.00, '../Images/special5.jpg'),
(22, 'Chinese', 'Chinese Sticky Rice', 'Rice with fillings.', 2400.00, '../Images/chinese1.jpeg'),
(23, 'Chinese', 'Chinese Hamburger', 'Pork-filled bun', 4000.00, '../Images/chinese2.jpeg'),
(24, 'Chinese', 'Spring Roll', 'Fried vegitable rolls.', 2300.00, '../Images/chinese3.jpeg'),
(25, 'Italian', 'Cabonara', 'With fatty cured pork, hard cheese, eggs, salt, and black pepper.', 4500.00, '../Images/italian1.jpg'),
(26, 'Italian', 'Risotto', 'Made by cooking a starchy, short grain rice like arborio with stock until it becomes creamy.', 3250.00, '../Images/italian2.jpg'),
(30, 'Beverages', 'Cappuccino ', '<p>..<strong>12</strong></p>', 600.00, '../Images/cappuccino.jpg'),
(31, 'Beverages', 'Coca Cola ', '..', 400.00, '../Images/cocacola.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `dine_takeaway` enum('Dine In','Take Away') NOT NULL,
  `order_date` date NOT NULL,
  `order_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `payment` enum('Pending','Complete') NOT NULL DEFAULT 'Pending',
  `status` enum('Pending','Confirmed','Declined') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=150 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_name`, `dine_takeaway`, `order_date`, `order_time`, `created_at`, `payment`, `status`) VALUES
(111, 'thisaru', 'Dine In', '2024-10-28', '11:00:00', '2024-10-13 17:30:48', 'Pending', 'Pending'),
(110, 'admin', 'Dine In', '2024-10-29', '11:00:00', '2024-10-12 18:19:59', 'Pending', 'Pending'),
(109, 'admin', 'Take Away', '2024-10-16', '11:00:00', '2024-10-12 18:19:27', 'Pending', 'Pending'),
(108, 'Staff', 'Dine In', '2024-10-29', '11:00:00', '2024-10-12 18:15:44', 'Pending', 'Pending'),
(107, 'thisaru', 'Take Away', '2024-10-20', '11:00:00', '2024-10-12 18:12:38', 'Pending', 'Pending'),
(106, 'Staff', 'Dine In', '2024-10-17', '11:00:00', '2024-10-12 18:11:59', 'Pending', 'Pending'),
(105, 'Staff', 'Take Away', '2024-10-17', '11:00:00', '2024-10-12 18:11:36', 'Pending', 'Pending'),
(104, 'Staff', 'Dine In', '2024-10-12', '11:36:40', '2024-10-12 18:06:40', 'Pending', 'Pending'),
(103, 'thisaru', 'Take Away', '2024-10-24', '11:00:00', '2024-10-12 18:04:29', 'Pending', 'Pending'),
(102, 'thisaru', 'Dine In', '2024-10-18', '11:00:00', '2024-10-12 18:03:55', 'Pending', 'Pending'),
(101, 'thisaru', 'Take Away', '2024-10-24', '12:30:00', '2024-10-12 08:53:15', 'Pending', 'Pending'),
(100, 'thisaru', 'Dine In', '2024-10-29', '11:00:00', '2024-10-12 08:47:14', 'Pending', 'Pending'),
(99, 'thisaru', 'Dine In', '2024-10-17', '05:00:00', '2024-10-12 08:41:17', 'Pending', 'Pending'),
(98, 'thisaru', 'Dine In', '2024-10-24', '11:00:00', '2024-10-12 08:26:42', 'Pending', 'Pending'),
(97, 'thisaru', 'Dine In', '2024-10-22', '11:00:00', '2024-10-12 08:06:47', 'Pending', 'Pending'),
(96, 'admin', 'Dine In', '2024-10-18', '11:00:00', '2024-10-12 07:25:52', 'Pending', 'Pending'),
(95, 'thisaru', 'Dine In', '2024-10-22', '11:00:00', '2024-10-12 07:22:45', 'Pending', 'Pending'),
(94, 'Staff', 'Take Away', '2024-10-17', '04:30:00', '2024-10-12 07:16:42', 'Pending', 'Pending'),
(93, 'Staff', 'Dine In', '2024-10-24', '11:00:00', '2024-10-12 07:14:16', 'Pending', 'Pending'),
(92, 'Staff', 'Dine In', '2024-10-18', '11:00:00', '2024-10-12 07:12:46', 'Pending', 'Pending'),
(91, 'Staff', 'Dine In', '2024-10-17', '11:00:00', '2024-10-12 07:04:56', 'Pending', 'Pending'),
(90, 'Staff', 'Dine In', '2024-10-17', '12:30:00', '2024-10-12 06:28:11', 'Pending', 'Pending'),
(89, 'Staff', 'Dine In', '2024-10-30', '11:00:00', '2024-10-12 06:22:27', 'Pending', 'Pending'),
(88, 'Staff', 'Take Away', '2024-10-24', '11:00:00', '2024-10-12 06:21:09', 'Pending', 'Pending'),
(87, 'Staff', 'Dine In', '2024-10-17', '11:00:00', '2024-10-12 06:20:04', 'Pending', 'Pending'),
(86, 'Staff', 'Dine In', '2024-10-23', '11:00:00', '2024-10-12 06:06:52', 'Pending', 'Pending'),
(85, 'Staff', 'Dine In', '2024-10-16', '11:00:00', '2024-10-12 06:06:06', 'Pending', 'Pending'),
(84, 'Staff', 'Take Away', '2024-10-18', '11:00:00', '2024-10-12 05:59:27', 'Complete', 'Pending'),
(83, 'Staff', 'Dine In', '2024-10-30', '11:00:00', '2024-10-12 05:58:45', 'Pending', 'Pending'),
(82, 'Staff', 'Take Away', '2024-10-16', '11:00:00', '2024-10-12 05:57:14', 'Pending', 'Pending'),
(81, 'Staff', 'Take Away', '2024-10-30', '11:00:00', '2024-10-12 05:56:33', 'Pending', 'Pending'),
(80, 'Staff', 'Dine In', '2024-10-15', '12:00:00', '2024-10-12 05:55:16', 'Complete', 'Confirmed'),
(112, 'admin', 'Dine In', '2024-10-13', '11:00:00', '2024-10-13 18:46:00', 'Pending', 'Pending'),
(113, 'thisaru', 'Dine In', '2024-10-26', '12:00:00', '2024-10-14 17:24:23', 'Pending', 'Pending'),
(114, 'thinu', 'Dine In', '2024-10-23', '11:00:00', '2024-10-14 17:25:34', 'Pending', 'Pending'),
(115, 'Staff', 'Dine In', '2024-10-24', '11:00:00', '2024-10-15 08:11:56', 'Pending', 'Pending'),
(116, 'Staff', 'Dine In', '2024-10-15', '01:43:52', '2024-10-15 08:13:52', 'Pending', 'Pending'),
(117, 'Staff', 'Dine In', '2024-10-16', '11:55:29', '2024-10-16 06:25:29', 'Pending', 'Pending'),
(118, 'thisaru', 'Take Away', '2024-10-31', '11:00:00', '2024-10-16 07:22:30', 'Pending', 'Pending'),
(119, 'thisaru', 'Dine In', '2024-10-22', '01:30:00', '2024-10-18 08:57:19', 'Pending', 'Pending'),
(120, 'Staff', 'Dine In', '2024-10-22', '12:41:40', '2024-10-22 19:11:40', 'Pending', 'Pending'),
(121, 'Staff', 'Dine In', '2024-10-22', '02:22:57', '2024-10-22 20:52:57', 'Pending', 'Pending'),
(122, 'Staff', 'Dine In', '2024-10-22', '02:36:19', '2024-10-22 21:06:19', 'Pending', 'Pending'),
(123, 'Staff', 'Dine In', '2024-10-22', '02:37:35', '2024-10-22 21:07:35', 'Pending', 'Pending'),
(124, 'Staff', 'Dine In', '2024-10-24', '03:14:34', '2024-10-24 09:44:34', 'Pending', 'Pending'),
(125, 'thisaru', 'Dine In', '2024-10-30', '12:00:00', '2024-10-27 06:05:34', 'Pending', 'Pending'),
(126, 'thisaru', 'Take Away', '2024-10-31', '01:30:00', '2024-10-27 06:11:15', 'Pending', 'Pending'),
(127, 'thisaru', 'Dine In', '2024-10-29', '11:00:00', '2024-10-27 06:11:40', 'Pending', 'Pending'),
(128, 'thisaru', 'Dine In', '2024-11-02', '11:00:00', '2024-10-27 06:18:19', 'Pending', 'Pending'),
(129, 'thisaru', 'Take Away', '2024-11-03', '11:00:00', '2024-10-27 06:31:28', 'Pending', 'Pending'),
(130, 'thisaru', 'Dine In', '2024-10-31', '01:30:00', '2024-10-27 06:47:32', 'Pending', 'Pending'),
(131, 'thisaru', 'Take Away', '2024-10-30', '01:30:00', '2024-10-27 07:35:25', 'Pending', 'Pending'),
(132, 'thisaru', 'Dine In', '2024-10-29', '11:00:00', '2024-10-27 08:15:22', 'Pending', 'Pending'),
(133, 'thisaru', 'Dine In', '2024-11-05', '11:00:00', '2024-10-31 08:43:34', 'Pending', 'Pending'),
(134, 'admin', 'Dine In', '2024-10-31', '02:15:31', '2024-10-31 08:45:31', 'Pending', 'Pending'),
(135, 'thisaru', 'Dine In', '2024-11-19', '11:00:00', '2024-11-10 05:51:56', 'Pending', 'Pending'),
(136, 'thisaru', 'Take Away', '2024-12-01', '11:00:00', '2024-11-10 05:54:24', 'Pending', 'Pending'),
(137, 'thisaru', 'Dine In', '2024-11-10', '11:00:00', '2024-11-10 05:55:09', 'Pending', 'Pending'),
(138, 'admin', 'Dine In', '2024-11-10', '11:25:52', '2024-11-10 05:55:52', 'Pending', 'Confirmed'),
(139, 'thisaru', 'Take Away', '2024-12-02', '11:00:00', '2024-11-14 17:21:51', 'Pending', 'Pending'),
(140, 'Staff', 'Dine In', '2024-11-14', '11:08:06', '2024-11-14 17:38:06', 'Complete', 'Pending'),
(141, 'thisaru', 'Dine In', '2024-11-27', '04:00:00', '2024-11-14 17:42:39', 'Pending', 'Pending'),
(142, 'thisaru', 'Dine In', '2024-12-02', '01:00:00', '2024-11-14 17:46:42', 'Complete', 'Pending'),
(143, 'thisaru', 'Dine In', '2024-11-26', '02:00:00', '2024-11-14 17:50:38', 'Complete', 'Pending'),
(144, 'admin', 'Dine In', '2024-11-20', '09:47:21', '2024-11-20 04:17:21', 'Complete', 'Pending'),
(145, 'admin', 'Dine In', '2024-11-20', '09:47:57', '2024-11-20 04:17:57', 'Pending', 'Pending'),
(146, 'admin', 'Dine In', '2024-11-20', '09:48:09', '2024-11-20 04:18:09', 'Complete', 'Pending'),
(147, 'admin', 'Dine In', '2024-11-20', '09:50:47', '2024-11-20 04:20:47', 'Complete', 'Pending'),
(148, 'admin', 'Dine In', '2024-11-20', '10:03:14', '2024-11-20 04:33:14', 'Complete', 'Pending'),
(149, 'thisaru', 'Dine In', '2024-11-26', '11:00:00', '2024-11-20 04:36:47', 'Complete', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=230 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_name`, `quantity`, `price`) VALUES
(161, 100, 'Black Pork Curry', 2, 2750.00),
(160, 99, 'Black Pork Curry', 1, 2750.00),
(159, 99, 'Tamarind Beef Curry', 1, 2050.00),
(157, 98, 'Cappuccino ', 1, 600.00),
(158, 98, 'Coca Cola ', 1, 400.00),
(156, 97, 'Cappuccino ', 1, 600.00),
(154, 96, 'Black Pork Curry', 1, 2750.00),
(155, 97, 'Hot Chocolate', 1, 5000.00),
(153, 95, 'Tamarind Beef Curry', 1, 2050.00),
(152, 94, 'Neapolitan Pizza', 1, 4500.00),
(151, 93, 'Black Pork Curry', 1, 2750.00),
(150, 93, 'Tamarind Beef Curry', 1, 2050.00),
(149, 92, 'Black Pork Curry', 1, 2750.00),
(148, 92, 'Tamarind Beef Curry', 1, 2050.00),
(147, 91, 'Tamarind Beef Curry', 1, 2050.00),
(146, 90, 'Hot Chocolate', 1, 5000.00),
(145, 90, 'Mustard Fish Curry', 1, 2500.00),
(144, 90, 'Prawn Curry', 1, 2350.00),
(143, 89, 'Tamarind Beef Curry', 1, 2050.00),
(142, 88, 'Tamarind Beef Curry', 1, 2050.00),
(141, 87, 'Tamarind Beef Curry', 1, 2050.00),
(140, 86, 'Black Pork Curry', 1, 2750.00),
(139, 85, 'Black Pork Curry', 1, 2750.00),
(138, 84, 'Black Pork Curry', 1, 2750.00),
(137, 84, 'Tamarind Beef Curry', 1, 2050.00),
(136, 83, 'Tamarind Beef Curry', 1, 2050.00),
(135, 82, 'Black Pork Curry', 1, 2750.00),
(134, 81, 'Black Pork Curry', 1, 2750.00),
(133, 80, 'Tamarind Beef Curry', 1, 2050.00),
(162, 100, 'Prawn Curry', 1, 2350.00),
(163, 101, 'Tamarind Beef Curry', 1, 2050.00),
(164, 102, 'Tamarind Beef Curry', 1, 2050.00),
(165, 103, 'Tamarind Beef Curry', 1, 2050.00),
(166, 104, 'Tamarind Beef Curry', 1, 2050.00),
(167, 105, 'Tamarind Beef Curry', 1, 2050.00),
(168, 105, 'Black Pork Curry', 1, 2750.00),
(169, 106, 'Tamarind Beef Curry', 1, 2050.00),
(170, 107, 'Tamarind Beef Curry', 1, 2050.00),
(171, 108, 'Tamarind Beef Curry', 1, 2050.00),
(172, 109, 'Black Pork Curry', 1, 2750.00),
(173, 110, 'Tamarind Beef Curry', 1, 2050.00),
(174, 111, 'MILKSHAKES', 1, 1500.00),
(175, 112, 'Tamarind Beef Curry', 1, 2050.00),
(176, 113, 'Coca Cola ', 1, 400.00),
(177, 114, 'Mustard Fish Curry', 1, 2500.00),
(178, 115, 'Black Pork Curry', 1, 2750.00),
(179, 116, 'Black Pork Curry', 1, 2750.00),
(180, 116, 'Prawn Curry', 1, 2350.00),
(181, 117, 'Tamarind Beef Curry', 1, 2050.00),
(182, 118, 'Tamarind Beef Curry', 1, 2050.00),
(183, 118, 'Black Pork Curry', 1, 2750.00),
(184, 118, 'Prawn Curry', 1, 2350.00),
(185, 118, 'Mustard Fish Curry', 1, 2500.00),
(186, 118, 'Hot Chocolate', 1, 5000.00),
(187, 118, 'Cappuccino ', 1, 600.00),
(188, 118, 'Coca Cola ', 1, 400.00),
(189, 118, 'Paradise Road Super Burger ', 1, 3600.00),
(190, 118, 'Grilled Fillet Steak ', 2, 4500.00),
(191, 118, 'Grilled Lamb Cutlets ', 1, 4750.00),
(192, 119, 'Tamarind Beef Curry', 1, 2050.00),
(193, 120, 'Tamarind Beef Curry', 2, 2050.00),
(194, 120, 'Prawn Curry', 1, 2350.00),
(195, 121, 'Tamarind Beef Curry', 1, 2050.00),
(196, 122, 'Tamarind Beef Curry', 1, 2050.00),
(197, 123, 'Tamarind Beef Curry', 1, 2050.00),
(198, 124, 'Tamarind Beef Curry', 1, 2050.00),
(199, 125, 'Tamarind Beef Curry', 1, 2050.00),
(200, 126, 'Black Pork Curry', 1, 2750.00),
(201, 127, 'Black Pork Curry', 1, 2750.00),
(202, 127, 'Prawn Curry', 1, 2350.00),
(203, 128, 'Black Pork Curry', 1, 2750.00),
(204, 128, 'Prawn Curry', 1, 2350.00),
(205, 129, 'Tamarind Beef Curry', 1, 2050.00),
(206, 130, 'Black Pork Curry', 1, 2750.00),
(207, 131, 'Black Pork Curry', 1, 2750.00),
(208, 132, 'Tamarind Beef Curry', 1, 2050.00),
(209, 133, 'Tamarind Beef Curry', 1, 2050.00),
(210, 134, 'Tamarind Beef Curry', 1, 2050.00),
(211, 135, 'Tamarind Beef Curry', 1, 2050.00),
(212, 135, 'Black Pork Curry', 1, 2750.00),
(213, 136, 'Tamarind Beef Curry', 1, 2050.00),
(214, 136, 'Black Pork Curry', 1, 2750.00),
(215, 137, 'Tamarind Beef Curry', 1, 2050.00),
(216, 138, 'Tamarind Beef Curry', 1, 2050.00),
(217, 139, 'Tamarind Beef Curry', 1, 2050.00),
(218, 140, 'Coca Cola ', 1, 400.00),
(219, 141, 'Prawn Curry', 1, 2350.00),
(220, 142, 'Black Pork Curry', 1, 2750.00),
(221, 143, 'Grilled Fillet Steak ', 2, 4500.00),
(222, 144, 'Tamarind Beef Curry', 1, 2050.00),
(223, 145, 'Prawn Curry', 1, 2350.00),
(224, 146, 'Hot Chocolate', 1, 5000.00),
(225, 147, 'MILKSHAKES', 1, 1500.00),
(226, 148, 'Tamarind Beef Curry', 1, 2050.00),
(227, 148, 'Prawn Curry', 1, 2350.00),
(228, 149, 'Black Pork Curry', 1, 2750.00),
(229, 149, 'Prawn Curry', 1, 2350.00);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `reservation_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `guests` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','confirmed','declined') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`reservation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `user_name`, `table_name`, `reservation_date`, `reservation_time`, `guests`, `created_at`, `status`) VALUES
(114, 'Staff', 'Table 4', '2024-10-15', '13:00:00', 2, '2024-10-15 08:09:36', 'pending'),
(113, 'Staff', 'Table 100', '2024-10-15', '13:00:00', 2, '2024-10-15 08:09:06', 'pending'),
(112, 'Staff', 'Table 100', '2024-10-16', '19:00:00', 2, '2024-10-15 08:08:36', 'pending'),
(111, 'admin', 'Table 100', '2024-11-02', '16:00:00', 2, '2024-10-14 17:30:07', 'pending'),
(110, 'thisaru', 'Table 100', '2024-10-14', '06:00:00', 2, '2024-10-13 18:41:47', 'pending'),
(109, 'thisaru', 'Table 8', '2024-10-18', '12:00:00', 2, '2024-10-12 08:45:30', 'pending'),
(108, 'admin', 'Table 100', '2024-10-24', '18:00:00', 2, '2024-10-02 06:06:43', 'pending'),
(107, 'thisaru', 'Table 100', '2024-10-01', '22:00:00', 2, '2024-10-01 17:07:14', 'confirmed'),
(105, 'Staff', 'Table 100', '2024-10-01', '17:00:00', 2, '2024-10-01 11:07:25', 'pending'),
(106, 'admin', 'Table 100', '2024-10-01', '18:00:00', 2, '2024-10-01 11:19:19', 'pending'),
(104, 'admin', 'Table 100', '2024-10-17', '18:00:00', 2, '2024-10-01 09:46:07', 'confirmed'),
(103, 'thisaru', 'Table 100', '2024-10-02', '17:00:00', 2, '2024-10-01 06:32:04', 'declined'),
(115, 'thisaru', 'Table 100', '2024-10-31', '17:00:00', 2, '2024-10-21 05:19:38', 'pending'),
(116, 'admin', 'Table 100', '2024-10-25', '22:00:00', 5, '2024-10-21 09:10:40', 'pending'),
(117, 'admin', 'Table 100', '2024-10-21', '14:00:00', 24, '2024-10-21 09:12:43', 'pending'),
(118, 'admin', 'Table 7', '2024-11-02', '11:00:00', 4, '2024-10-21 09:28:09', 'confirmed'),
(119, 'admin', 'Table 6', '2024-11-02', '11:00:00', 3, '2024-10-21 09:28:44', 'pending'),
(120, 'thisaru', 'Table 10', '2024-10-30', '22:00:00', 1, '2024-10-22 06:28:01', 'pending'),
(121, 'thisaru', 'Table 8', '2024-11-26', '15:00:00', 4, '2024-11-25 06:08:33', 'pending'),
(122, 'thisaru', 'Table 8', '2024-11-25', '17:00:00', 3, '2024-11-25 07:31:01', 'pending'),
(123, 'thisaru', 'Table 10', '2024-11-25', '17:00:00', 6, '2024-11-25 07:31:27', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` int NOT NULL AUTO_INCREMENT,
  `room_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `availability_status` enum('available','reserved') DEFAULT 'available',
  `price` decimal(10,2) NOT NULL,
  `description` text,
  `capacity` int NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`room_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`, `category`, `availability_status`, `price`, `description`, `capacity`, `image_url`, `created_at`) VALUES
(33, 'Deluxe King Room', 'Single Rooms', 'available', 7000.00, '<p>Experience luxury in our Deluxe King Room, featuring a spacious king-sized bed, a cozy seating area, and modern amenities. Ideal for a relaxing getaway or business trips.</p>', 1, '../images/room105.jpeg', '2024-09-11 17:39:05'),
(32, 'Superior Queen Room', 'Dpuble Rooms', 'available', 10000.00, '<p>Relax in our Superior Queen Room, equipped with a comfortable queen-sized bed, stylish decor, and a private balcony offering stunning views of the surroundings.</p>', 2, '../images/room104.jpeg', '2024-09-11 17:38:35'),
(30, 'Family Suite', 'Master Bed Rooms', 'available', 13000.00, '<p>Perfect for families, a shared living space, and a kitchenette. A home away from home for your entire family.</p>', 6, '../images/room103.jpeg', '2024-09-10 10:16:04'),
(28, 'Executive Suite', 'AC Master Bed Rooms', 'available', 15000.00, '<p>Indulge in elegance with our Executive Suite, complete with a plush king-sized bed, an executive desk, and exclusive access to premium services.</p>', 6, '../images/room102.jpeg', '2024-09-10 05:44:56'),
(31, 'Honeymoon Suite', 'AC Double Rooms', 'available', 9000.00, '<p>Celebrate romance in our Honeymoon Suite, featuring a luxurious canopy bed, a private hot tub, and breathtaking panoramic views to make your stay unforgettable.</p>', 2, '../images/room101.jpeg', '2024-09-11 04:23:48');

-- --------------------------------------------------------

--
-- Table structure for table `room_reservations`
--

DROP TABLE IF EXISTS `room_reservations`;
CREATE TABLE IF NOT EXISTS `room_reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `room_name` varchar(255) DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `reservation_time` time DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `number_of_guests` int DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `total_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `room_reservations`
--

INSERT INTO `room_reservations` (`id`, `username`, `room_name`, `reservation_date`, `reservation_time`, `duration`, `number_of_guests`, `status`, `total_price`) VALUES
(70, 'thisaru', 'room 1', '2025-03-19', '08:00:00', 2, 2, 'Pending', 180.00),
(69, 'thisaru', 'room 18', '2024-12-04', '08:00:00', 2, 2, 'Pending', 1400.00),
(68, 'thisaru', 'room 1', '2026-11-05', '08:00:00', 2, 2, 'Pending', 180.00),
(67, 'thisaru', 'room 5', '2024-10-30', '08:00:00', 1, 1, 'Pending', 123.00),
(66, 'thisaru', 'room 18', '2025-03-08', '12:00:00', 1, 1, 'Pending', 700.00),
(65, 'thisaru', 'room 1', '2024-11-29', '08:00:00', 2, 2, 'Pending', 180.00),
(64, 'thisaru', 'room 19', '2024-12-18', '08:00:00', 1, 1, 'Pending', 1300.00),
(63, 'thisaru', 'room 18', '2024-11-07', '17:00:00', 3, 4, 'Pending', 2100.00),
(62, 'thisaru', 'room 19', '2024-11-08', '08:00:00', 2, 2, 'Pending', 2600.00),
(61, 'thisaru', 'room 1', '2024-10-29', '17:00:00', 2, 3, 'Pending', 180.00),
(60, 'thisaru', 'room 1', '2024-11-07', '08:00:00', 4, 3, 'Pending', 360.00),
(59, 'thisaru', 'room 18', '2024-10-30', '12:00:00', 2, 2, 'Pending', 1400.00),
(58, 'thisaru', 'room 19', '2024-10-23', '17:00:00', 2, 2, 'Pending', 0.00),
(57, 'thisaru', 'room 19', '2024-10-27', '08:00:00', 5, 2, 'Pending', 0.00),
(56, 'thisaru', 'room 1', '2024-10-22', '17:00:00', 2, 2, 'Pending', 0.00),
(71, 'thisaru', 'room 19', '2024-11-28', '17:00:00', 3, 2, 'Pending', 3900.00);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(55) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT '0',
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `full_name`, `username`, `email`, `phone`, `address`, `profile_photo`, `is_verified`, `password`) VALUES
(1, 'thisaru', 'Staff', 'thisarujayawickrama222@gmail.com', '0776281645', '0asdfggfdsa,', '../Images/7e4c842e26575da7d06944e1ae6532cb.jpg', 1, '$2y$10$iWL3VKAEZALNEOykIlnH5e0u8lLDad0nQLVANcNblwqudOx4.cC7q'),
(2, 'thisaru', 'staff2', 'thisarujayawickrama35@gmail.com', '0776281645', '“Nimal”, Beach Road, Gandara , Sri Lanka12345', 'addevent2.jpg', 1, '$2y$10$j9nHWI17rTwz23nVp9e0jeeqglu7ssQ9dzwRfBrWGHlHeVq8vVaxO');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

DROP TABLE IF EXISTS `tables`;
CREATE TABLE IF NOT EXISTS `tables` (
  `id` int NOT NULL AUTO_INCREMENT,
  `table_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `capacity` int NOT NULL,
  `image_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `table_name` (`table_name`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `table_name`, `description`, `capacity`, `image_path`) VALUES
(1, 'Balcony View Table', '<p><span style=\"background-color: rgb(236, 202, 250);\">Set on the balcony with panoramic views of the surroundings, this table is ideal for those who love dining al fresco.</span></p>', 2, '../Images/Table2.jpg'),
(4, 'Garden View Table', '<p>Nestled near the window with a stunning view of the lush garden, this table offers a serene and picturesque dining experience.</p>', 4, '../Images/Table4.jpg'),
(5, 'Party Table', '<p>Perfect for celebrations, this large table is designed to host groups, featuring ample seating and festive arrangements.</p>', 6, '../Images/Table5.jpg'),
(11, 'Romantic Candlelight Table', '<p>A cozy, intimate table for two, set with soft candlelight and elegant decor&mdash;perfect for romantic dinners and special occasions.</p>', 2, '../Images/Table9.jpg'),
(9, 'Family Dining Table', '<p>A spacious table designed to comfortably accommodate families, with enough room for laughter, bonding, and delicious meals.</p>', 10, '../Images/Table10.jpg'),
(12, 'Chef\'s Special Table', '<p>Located near the open kitchen, this table lets you witness the culinary magic as chefs prepare your favorite dishes.</p>', 5, '../images/eb623c9f5aea6a3b6cd6488cfd4d00c2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `otp_expiration` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_verified` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `phone`, `address`, `password`, `profile_photo`, `otp`, `otp_expiration`, `created_at`, `is_verified`) VALUES
(18, 'thisaru nadishka', 'thisaru', 'thisarujayawickrama22@gmail.com', '0776281646511', '“Nimal”, Beach Road, Gandara , Sri Lanka12356', '$2y$10$aR0VTM.Mzl/i.G0OFUZpeePo.5onS5rwIU/c0p0B/ovrMH22Ftv.m', '../Images/addevent2.jpg', NULL, NULL, '2024-09-21 11:29:13', 1),
(30, 'siril', 'siril', 'siril@gmail.com', '077123457', 'matara', '$2y$10$hcmlJm5Mw92pmXbgGOW6Mu2Gklsh02mDiJXWfAvbtChbQhH6kmBY.', 'Screenshot (243).png', '189858', '2024-11-24 23:27:42', '2024-11-25 04:47:42', 0),
(28, 'thisaru', 'thinu034', 'kanilgeethanjanakumara2000@gmail.com', '077123457', 'matara', '$2y$10$tnrfM4GzRE.miQVYed/GwuQKMLkXfVYeudI5drZpwI.7hlqsIl1Ji', 'Screenshot (124).png', '401784', '2024-11-19 23:32:17', '2024-11-20 04:52:17', 0),
(26, 'Thisaru Jayawickrama', 'thinu', 'thisarujayawickrama@gmail.com', '0779364782', 'No 2/4, Ranaviru Udhara Wasana Mwatha,', '$2y$10$r/OEbsIzRyO8SUn30CxpK.fZcPlPI71QfO2BnAlolroLJ3Rsmp6cS', '6802b49bb4ea20a798823ba95be25577.jpg', NULL, NULL, '2024-10-12 19:13:27', 1),
(27, 'thisaru', 'thinu03', 'kanilgeethanjana.122@gmail.com', '077123457', 'matara', '$2y$10$KAEX3E4vxuUOVLP4929UtOoMsSSfndjEMfvJDdDOR6kQyAXBMamPe', 'Screenshot (124).png', '525259', '2024-11-19 23:28:48', '2024-11-20 04:48:48', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
