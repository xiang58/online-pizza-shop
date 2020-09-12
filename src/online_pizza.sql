-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2018 at 09:04 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_pizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_contents`
--

CREATE DATABASE online_pizza;
USE online_pizza;

CREATE TABLE `order_contents` (
  `order_id` int(11) NOT NULL,
  `pizza_id` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_contents`
--

INSERT INTO `order_contents` (`order_id`, `pizza_id`, `size`, `quantity`) VALUES
(1, 1, 16, 2),
(1, 2, 10, 1),
(2, 1, 12, 1),
(3, 2, 14, 1),
(4, 2, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `userid` int(10) NOT NULL,
  `order_id` int(11) NOT NULL,
  `total_price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`userid`, `order_id`, `total_price`) VALUES
(1, 4, 15.99),
(2, 1, 26.98),
(2, 2, 12.99),
(2, 3, 13.99);

-- --------------------------------------------------------

--
-- Table structure for table `pizza`
--

CREATE TABLE `pizza` (
  `pizza_id` int(10) NOT NULL,
  `pizza_name` tinytext NOT NULL,
  `description` mediumtext NOT NULL,
  `base_price` decimal(6,2) NOT NULL,
  `inventory` int(10) NOT NULL,
  `category` tinytext NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pizza`
--

INSERT INTO `pizza` (`pizza_id`, `pizza_name`, `description`, `base_price`, `inventory`, `category`, `deleted`) VALUES
(1, 'ExtravaganZZa', 'Pepperoni, ham, Italian sausage, beef, fresh onions, fresh green peppers, fresh mushrooms and black olives, all sandwiched between two layers of cheese made with 100% real mozzarella.', 10.99, 56, 'meat', 0),
(2, 'MeatZZa', 'Pepperoni, ham, Italian sausage and beef, all sandwiched between two layers of cheese made with 100% real mozzarella.', 9.99, 60, 'meat', 0),
(3, 'VeganZZa', 'Onions, green peppers, mushrooms, black olives and spinach, all sandwiched between two layers of cheese made with 100% real mozzarella.', 8.99, 69, 'veggie', 0),
(4, 'CheeZZa', 'Too much cheeses for even a cheese head to handle', 7.99, 100, 'veggie', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `userid` int(10) NOT NULL,
  `pizza_id` int(10) NOT NULL,
  `size` int(11) NOT NULL,
  `final_price` decimal(6,2) NOT NULL,
  `quantity` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `size` int(10) UNSIGNED NOT NULL,
  `price_added` decimal(6,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`size`, `price_added`) VALUES
(10, 0.00),
(12, 2.00),
(14, 4.00),
(16, 6.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` mediumtext NOT NULL,
  `address` mediumtext,
  `is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `email`, `name`, `password`, `address`, `is_admin`) VALUES
(1, 'jas160430@utdallas.edu', 'John Scalley', '2ac9cb7dc02b3c0083eb70898e549b63', '2801 Rutford ave', 1),
(2, 'email@gmail.com', 'Test', '2ac9cb7dc02b3c0083eb70898e549b63', '101 Street', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_contents`
--
ALTER TABLE `order_contents`
  ADD PRIMARY KEY (`order_id`,`pizza_id`,`size`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`userid`,`order_id`);

--
-- Indexes for table `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`pizza_id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`userid`,`pizza_id`,`size`) USING BTREE,
  ADD KEY `pizza_id` (`pizza_id`,`size`) USING BTREE;

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`size`,`price_added`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pizza`
--
ALTER TABLE `pizza`
  MODIFY `pizza_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_history`
--
ALTER TABLE `order_history`
  ADD CONSTRAINT `order_history_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`),
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`pizza_id`) REFERENCES `pizza` (`pizza_id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
