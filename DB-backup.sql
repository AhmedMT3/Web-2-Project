-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2025 at 01:41 PM
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
-- Database: `user_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `user_name`, `email`, `phone`, `whatsapp`, `address`, `password`, `user_image`) VALUES
(1, 'Ahmed', 'Ahmed_fcai', 'ahmed@fcai.com', '011', '012', 'Cairo', '$2y$10$9RYLCBQvAnvIDqhWFVM3A.olDzawlFENMQPDdK507gTgyVnFxYXAW', ''),
(2, 'Samer', 'Samer _fcai', 'samer@fcai.com', '012', '0123', 'Cairo', '$2y$10$cg0Px/0lioav8xukB/8CcORUNGZzdKEPHqVHV9AH/DA9f/atK.p5i', ''),
(3, 'Moneeb', 'Moneeb _fcai', 'moneeb@fcai.com', '013', '01234', 'Cairo', '$2y$10$S7cYsC9yrXn96JIlfSspJOdfM9XV209t.r0/eTDuKuOqXbXx1lsAK', ''),
(4, 'Hassan', 'Hassan_fcai', 'hassan@fcai.com', '014', '012345', 'Cairo', '$2y$10$TEF2cPdQxG6lq3Wt19Mln.4ZV2JtPagKfGzGs8VU9E26m2IQZQ./y', ''),
(5, 'Tong ', 'Tong _fcai', 'tong@fcai.com', '015', '0123456', 'Cairo', '$2y$10$ACjyumv8QxpqXdZV7wr1Ie3P0L2Xy3hpTW8JPy60iVsbv.3y.JSj.', ''),
(6, 'Noureddine', 'Noureddine  _fcai', 'noureddine@fcai.com', '016', '01234567', 'Cairo', '$2y$10$YS7xnMhqkOPvrHjUeFCPDe5Us4hMBqrVosjc.KZ3u6lOQzFEvXOMG', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
