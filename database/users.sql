-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2021 at 07:09 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nasa`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(16) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'Screen_namdssdd', 'd405e12e4bef0ef0b7e6f79d8bb6193341ddd981', 'desdsmdddo@demo.com'),
(2, 'Screen_namdddd', 'd405e12e4bef0ef0b7e6f79d8bb6193341ddd981', 'desdsmddddo@demo.com'),
(3, 'Screen_namddd', 'd405e12e4bef0ef0b7e6f79d8bb6193341ddd981', 'desdsmddo@demo.com'),
(4, 'Screedn_namddd', 'd405e12e4bef0ef0b7e6f79d8bb6193341ddd981', 'desdsdmddo@demo.com'),
(5, 'Screen_name', 'd405e12e4bef0ef0b7e6f79d8bb6193341ddd981', 'demo@demo.com'),
(6, 'Screen_name1', 'd405e12e4bef0ef0b7e6f79d8bb6193341ddd981', 'demo2@demo.com'),
(7, 'Screen_name2', 'd405e12e4bef0ef0b7e6f79d8bb6193341ddd981', 'demo2@demo.com3'),
(8, 'wsdfff', 'd405e12e4bef0ef0b7e6f79d8bb6193341ddd981', 'def@g.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
