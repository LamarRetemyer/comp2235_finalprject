-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 03:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(16) NOT NULL,
  `title` varchar(128) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(128) NOT NULL,
  `company` varchar(255) NOT NULL,
  `type` varchar(128) NOT NULL,
  `assigned_to` int(16) NOT NULL,
  `created_by` int(16) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `title`, `firstname`, `lastname`, `email`, `telephone`, `company`, `type`, `assigned_to`, `created_by`, `created_at`, `updated_at`) VALUES
(3, '', 'Lamar', 'Retemyer', 'lilrete123@gmail.com', '777-7777', 'Group 1', 'SalesLead', 25, 25, '2023-12-11 01:36:18.000000', '2023-12-11 01:36:18.000000'),
(4, '', 'Jalique', 'Gordon', 'jgordon@gmail.com', '888-8888', 'Group 1', 'SalesLead', 25, 25, '2023-12-11 01:36:31.000000', '2023-12-11 01:36:31.000000'),
(5, '', 'June', 'Douglas', 'junedouglas@gmail.com', '999-9999', 'Group 1', 'SalesLead', 25, 25, '2023-12-11 01:36:51.000000', '2023-12-11 01:36:51.000000'),
(6, '', 'Abigail', 'Skepple', 'abigail@gmail.com', '555-5555', 'Group 1', 'SalesLead', 25, 25, '2023-12-11 01:38:30.000000', '2023-12-11 01:38:30.000000');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(16) NOT NULL,
  `contact_id` int(16) NOT NULL,
  `comment` text NOT NULL,
  `created_by` int(16) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `contact_id`, `comment`, `created_by`, `created_at`) VALUES
(17, 3, 'Lamar was here', 0, '2023-12-10 20:37:18'),
(18, 4, 'Jalique was here', 0, '2023-12-10 20:37:42'),
(19, 5, 'June was here', 0, '2023-12-10 20:37:53');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `Role` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password_hash`, `Role`, `created_at`) VALUES
(25, 'admin', 'comp2245', 'admin@project2.com', '$2y$10$v5UXFLB/F8dQ2bqhinklPOJwEWUPHwziyig3BQM2zA3nkWIjwplk.', 'admin', '2023-12-11 01:34:17'),
(26, 'Tester', '1', 'tester@gmail.com', '$2y$10$vbtxjRsyWTa2ejgR4GMV4u7j2ObL2FNeovkjkpPwNfnMdFRXLtNUi', 'admin', '2023-12-11 02:34:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
