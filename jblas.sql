-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 03:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jblas`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `service` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `firstname`, `lastname`, `email`, `phonenumber`, `service`, `address`) VALUES
(1, 'Boruto', 'Uzumaki', 'borutouzumaki200@gmail.com', '09099440253', 'electrical', 'mangss');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `message`) VALUES
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'hello'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'ello'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'ello'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'ello'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'hehe'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'hehe'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'hihih'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'ds'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'hello'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'asad'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'ddsd'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'dsd'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'hello\r\n'),
('Aokiji Kuzan', 'aldrinrosales428@gmail.com', 'hello'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'dsdf'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'dsdf'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'asdas'),
('Aokiji Kuzan', 'aldrinrosales428@gmail.com', 'hello'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'asdas'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'dsfsd'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'fdgsdf'),
('Aokiji Kuzan', 'aldrinrosales428@gmail.com', 'hello'),
('Aldrin V Rosales', 'aldrinrosales428@gmail.com', 'thabjs'),
('Canda', 'aldrinrosales428@gmail.com', 'gasd'),
('Canda', 'aldrinrosales428@gmail.com', 'adsd');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `homevisit` date NOT NULL,
  `repairvisit` date NOT NULL,
  `materials` varchar(500) NOT NULL,
  `cash` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `firstname`, `lastname`, `phonenumber`, `address`, `homevisit`, `repairvisit`, `materials`, `cash`, `email`) VALUES
(3, 'Aldrin', 'Rosales', '09089523553', 'Manggalang 1, Sariaya Quezon', '2024-02-28', '2024-03-01', 'sdfds', '', 'aldrinrosales428@gmail.com'),
(4, 'Aldrin', 'Rosales', '09089523553', 'Manggalang 1, Sariaya Quezon', '2024-02-16', '2024-02-07', 'ef', '', 'aldrinrosales428@gmail.com'),
(5, 'Aldrin', 'Rosales', '09089523553', 'Manggalang 1, Sariaya Quezon', '2024-02-16', '2024-02-07', 'ef', '', 'aldrinrosales428@gmail.com'),
(6, 'Aldrin', 'Rosales', '09089523553', 'Manggalang 1, Sariaya Quezon', '2024-02-28', '2024-02-01', 'sdfds', '', 'aldrinrosales428@gmail.com'),
(7, 'Aldrin', 'Rosales', '09089523553', 'Manggalang 1, Sariaya Quezon', '2024-02-28', '2024-02-01', '	\r\nsdfds', '', 'aldrinrosales428@gmail.com'),
(8, 'Aldrin', 'Rosales', '09089523553', 'Manggalang 1, Sariaya Quezon', '2024-02-28', '2024-02-01', 'dfssdf', '', 'aldrinrosales428@gmail.com'),
(9, 'Aldrin', 'Rosales', '09089523553', 'Manggalang 1, Sariaya Quezon', '2024-02-08', '2024-01-31', 'sdasdsaf', '', 'aldrinrosales428@gmail.com'),
(10, 'Aldrin', 'Rosales', '09089523553', 'Manggalang 1, Sariaya Quezon', '2024-02-21', '2024-02-22', 'yhfgfgdfg', '', 'aldrinrosales428@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `repairproblem` varchar(200) NOT NULL,
  `homevisit` varchar(20) NOT NULL,
  `visitrepair` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `action` int(1) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phonenumber`, `repairproblem`, `homevisit`, `visitrepair`, `status`, `action`, `username`) VALUES
(33, 'Jose', 'Manalo', 'josemanalo01@gmail.com', '09099440253', 'asda', '02/26/2024', '03/2/2024', 1, 0, 'hakdog');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
