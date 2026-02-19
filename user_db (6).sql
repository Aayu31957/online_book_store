-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2025 at 04:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(10, 13, 'economic', 200, 1, 'economic.jpg'),
(13, 0, 'economic', 200, 1, 'economic.jpg'),
(14, 0, 'ramayan', 100, 1, 'ramayan.jpg'),
(15, 14, 'economic', 200, 1, 'economic.jpg'),
(16, 13, 'bash_and_lucy-2', 150, 1, 'bash_and_lucy-2.jpg'),
(17, 15, 'economic', 300, 1, 'economic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(2, 13, 'aayu', 'dabhiaayushi148@gmail.com', '8401246520', 'hello testing message');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(100) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(6, 3, 'asa', '7894561230', 'a@gmail.com', 'case on delivery', 'kok', '2', 500, '30 jan 2025', ''),
(7, 13, 'aayushi', '8401246520', 'dabhiaayushi148@gmail.com', 'cash on delivery', 'flat no. 2, Shandaar society, Rajkot, India - 360022', ', economic (1) , Bhagavad Gita (5) , darknet (2) ', 900, '29-Sep-2025', 'completed'),
(8, 14, '1234', '08401246520', 'dabhiaayushi148@gmail.com', 'cash on delivery', 'flat no. 1, Shandaar society, Rajkot, India - 360022', ', economic (1) , bash_and_lucy-2 (1) ', 350, '03-Oct-2025', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `author`, `description`) VALUES
(21, 'economic', 300, 'economic.jpg', 'Andrew Barkley & Paul W. Barkley', 'This book deals with the principles of agricultural economics, explaining how economic concepts and methods can be applied to agriculture and farming systems. It usually covers topics like production, consumption, distribution, resource use, farm management, and policy issues related to agriculture.'),
(22, 'bash_and_lucy-2', 150, 'bash_and_lucy-2.jpg', 'Lisa & Michael Cohn', 'The book \"Bash and Lucy Fetch Confidence\" features a boy and his dog Lucy. The illustration shows the boy standing next to Lucy, who is sitting beside a soccer ball. The story seems to revolve around themes of confidence, possibly through the adventures of Bash and his dog Lucy.'),
(23, 'darknet', 100, 'darknet.jpg', 'Matthew Mather', 'Not available in the image. The image shows the book cover of \"DARKNET\" by Matthew Mather, indicating it\'s from the bestselling author of \"CYBERSTORM\".'),
(24, 'Bhagavad Gita', 100, 'bhagvad-gita.jpg', 'A.C. Bhaktivedanta Swami Prabhupāda', 'Not explicitly given in the image, but the book is titled \"BHAGAVAD GITA as it is\". The cover depicts a scene with Krishna and Arjuna, indicating it\'s a version of the Bhagavad Gita translated or interpreted by A.C. Bhaktivedanta Swami Prabhupāda.'),
(25, 'ramayan', 100, 'ramayan.jpg', 'Ralph T. H. Griffith', '\"The Ramayan of Valmiki Book II TRANSLATED INTO ENGLISH VERSE\".'),
(27, 'Harry Potter', 850, 'harry.jpg', 'J.K. Rowling', 'The book is the first novel in the Harry Potter series. It follows Harry Potter, a young boy who discovers on his eleventh birthday that he is a wizard and is invited to attend Hogwarts School of Witchcraft and Wizardry. At Hogwarts, he makes new friends, learns about magic, and uncovers a plot involving a mysterious stone.');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(12, 'aayu12', 'aayushi@gmail.com', '804919a0cc9ba5eef9a810d4291227c0', 'admin'),
(13, 'aayu', 'aayu@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'user'),
(14, 'aa', 'aa12@gmil.com', 'c6f057b86584942e415435ffb1fa93d4', 'user'),
(15, 'aayushi dabhi ', 'aayu0305@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
