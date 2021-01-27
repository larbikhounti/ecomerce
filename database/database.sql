-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2021 at 12:26 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eco`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'tops'),
(2, 'buttom'),
(3, 'hats'),
(4, 'shoes'),
(5, 'glasses');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  `zip` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`) VALUES
(1, 'black'),
(2, 'white'),
(3, 'pink'),
(4, 'red'),
(5, 'yellow');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descreption` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `primary_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `title`, `descreption`, `price`, `quantity`, `date_added`, `primary_image`) VALUES
(1, 'new shoes 2020 vans', '100% plastic free environment protected original ', 99, 12, '2021-01-10 15:57:20', 'https://pngimg.com/uploads/running_shoes/running_shoes_PNG5816.png'),
(2, 'new shoes 2020 vans', '100% plastic free environment protected original ', 99.99, 12, '2021-01-10 15:57:30', 'https://pngimg.com/uploads/running_shoes/running_shoes_PNG5816.png'),
(3, 'my products 1', 'fezfzef', 0.01, 1, '2021-01-27 22:34:07', 'C:/xampp2/htdocs/ecomerce/uploads/1611786847fefe.PNG'),
(4, 'my products 1', 'fezfzef', 0.01, 1, '2021-01-27 22:38:22', 'localhost/ecomerce/uploads/1611787102fefe.PNG'),
(5, 'my products 1', 'fezfzef', 0.01, 1, '2021-01-27 22:39:16', 'http://localhost/ecomerce/uploads/1611787156fefe.PNG'),
(6, 'my products 1', 'fezfzef', 0.01, 1, '2021-01-27 22:46:11', 'http://localhost/ecomerce/uploads/1611787571fefe.PNG'),
(7, 'my products 1', 'fezfzef', 0.01, 1, '2021-01-27 22:50:33', 'http://localhost/ecomerce/uploads/1611787833fefe.PNG'),
(8, 'my products 1', 'fezfzef', 0.01, 1, '2021-01-27 22:56:02', 'http://localhost/ecomerce/uploads/1611788162fefe.PNG'),
(9, 'my products 1', 'fezfzef', 0.01, 1, '2021-01-27 22:58:52', 'http://localhost/ecomerce/uploads/1611788332fefe.PNG'),
(10, 'my products 1', 'fezfzef', 0.01, 1, '2021-01-27 22:59:53', 'http://localhost/ecomerce/uploads/1611788393fefe.PNG'),
(11, 'my products 1', 'fezfzef', 0.01, 1, '2021-01-27 23:03:11', 'http://localhost/ecomerce/uploads/1611788591fefe.PNG'),
(12, 'my products 1', 'fezfzef', 0.01, 1, '2021-01-27 23:10:36', 'http://localhost/ecomerce/uploads/1611789036fefe.PNG'),
(13, 'my products 1', 'fezfzef', 0.01, 1, '2021-01-27 23:12:18', 'http://localhost/ecomerce/uploads/1611789138fefe.PNG'),
(14, 'my products 1', 'fezfzef', 0.01, 1, '2021-01-27 23:14:46', 'http://localhost/ecomerce/uploads/1611789286fefe.PNG'),
(15, 'my products 1', 'fezfzef', 0.01, 1, '2021-01-27 23:16:16', 'http://localhost/ecomerce/uploads/1611789376fefe.PNG'),
(16, 'my products 1', 'fezfzef', 0.01, 1, '2021-01-27 23:17:30', 'http://localhost/ecomerce/uploads/1611789450fefe.PNG'),
(17, 'my products 1', 'fzefzefzef', 1.5, 1, '2021-01-27 23:18:28', 'http://localhost/ecomerce/uploads/1611789508f.jpeg'),
(18, 'my products 1', 'fzefzefzef', 1.5, 1, '2021-01-27 23:20:40', 'http://localhost/ecomerce/uploads/1611789640f.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `id` int(11) NOT NULL,
  `items_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `items_id`, `category_id`) VALUES
(3, 18, 1),
(4, 18, 2),
(5, 18, 3);

-- --------------------------------------------------------

--
-- Table structure for table `item_color`
--

CREATE TABLE `item_color` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_color`
--

INSERT INTO `item_color` (`id`, `item_id`, `color_id`) VALUES
(3, 13, 1),
(4, 13, 2),
(5, 13, 3),
(6, 14, 1),
(7, 14, 2),
(8, 14, 3),
(9, 15, 1),
(10, 15, 2),
(11, 15, 3),
(12, 16, 1),
(13, 16, 2),
(14, 16, 3),
(15, 17, 1),
(16, 17, 2),
(17, 17, 3),
(18, 17, 4),
(19, 18, 1),
(20, 18, 2),
(21, 18, 3),
(22, 18, 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `orderdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `url`, `product_id`) VALUES
(5, 'http://localhost/ecomerce/uploads/1611788393f.jpeg', 10),
(6, 'http://localhost/ecomerce/uploads/1611788393flat-running-man-athletic-boy-run-animation-frames-sequence-runner-male-tracksuit-legs-animations-cartoon-vector-flat-running-122492103.jpg', 10),
(7, 'http://localhost/ecomerce/uploads/1611788591f.jpeg', 11),
(8, 'http://localhost/ecomerce/uploads/1611788591flat-running-man-athletic-boy-run-animation-frames-sequence-runner-male-tracksuit-legs-animations-cartoon-vector-flat-running-122492103.jpg', 11),
(9, 'http://localhost/ecomerce/uploads/1611789036f.jpeg', 12),
(10, 'http://localhost/ecomerce/uploads/1611789036flat-running-man-athletic-boy-run-animation-frames-sequence-runner-male-tracksuit-legs-animations-cartoon-vector-flat-running-122492103.jpg', 12),
(11, 'http://localhost/ecomerce/uploads/1611789138f.jpeg', 13),
(12, 'http://localhost/ecomerce/uploads/1611789138flat-running-man-athletic-boy-run-animation-frames-sequence-runner-male-tracksuit-legs-animations-cartoon-vector-flat-running-122492103.jpg', 13),
(13, 'http://localhost/ecomerce/uploads/1611789286f.jpeg', 14),
(14, 'http://localhost/ecomerce/uploads/1611789286flat-running-man-athletic-boy-run-animation-frames-sequence-runner-male-tracksuit-legs-animations-cartoon-vector-flat-running-122492103.jpg', 14),
(15, 'http://localhost/ecomerce/uploads/1611789376f.jpeg', 15),
(16, 'http://localhost/ecomerce/uploads/1611789376flat-running-man-athletic-boy-run-animation-frames-sequence-runner-male-tracksuit-legs-animations-cartoon-vector-flat-running-122492103.jpg', 15),
(17, 'http://localhost/ecomerce/uploads/1611789450f.jpeg', 16),
(18, 'http://localhost/ecomerce/uploads/1611789450flat-running-man-athletic-boy-run-animation-frames-sequence-runner-male-tracksuit-legs-animations-cartoon-vector-flat-running-122492103.jpg', 16),
(19, 'http://localhost/ecomerce/uploads/1611789508fefe.PNG', 17),
(20, 'http://localhost/ecomerce/uploads/1611789508flat-running-man-athletic-boy-run-animation-frames-sequence-runner-male-tracksuit-legs-animations-cartoon-vector-flat-running-122492103.jpg', 17),
(21, 'http://localhost/ecomerce/uploads/1611789640fefe.PNG', 18),
(22, 'http://localhost/ecomerce/uploads/1611789640flat-running-man-athletic-boy-run-animation-frames-sequence-runner-male-tracksuit-legs-animations-cartoon-vector-flat-running-122492103.jpg', 18);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `password`, `privilege`) VALUES
(23, 'zawjal2', 'fullname', 'Abdellatiflabrari@gmail.com', 'zawjal', 1),
(25, 'simokhounti25', 'mohamed khounti', 'larbikhounti@gmail.com', 'simo', 0),
(27, 'test24', 'my test', 'mytest@gmail.com', 'test', 0),
(29, 'admin', 'mr.admin', 'larbkhounti@gmail.com', '$2y$10$Q7j4cegXjIabFyesAFFENOxrz98XoFiXAylVgOhbMyH5MkrdcvSBS', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_id` (`items_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `item_color`
--
ALTER TABLE `item_color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `color_id` (`color_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itemo` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `item_color`
--
ALTER TABLE `item_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item_category`
--
ALTER TABLE `item_category`
  ADD CONSTRAINT `item_category_ibfk_1` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_color`
--
ALTER TABLE `item_color`
  ADD CONSTRAINT `item_color_ibfk_1` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `item_color_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `itemo` FOREIGN KEY (`product_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
