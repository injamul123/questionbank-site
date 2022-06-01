-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2020 at 09:22 PM
-- Server version: 8.0.19-0ubuntu0.19.10.3
-- PHP Version: 7.3.11-0ubuntu0.19.10.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `questionbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE `papers` (
  `id` int NOT NULL,
  `paper_code` varchar(50) NOT NULL,
  `paper_name` varchar(150) NOT NULL,
  `year` varchar(50) NOT NULL,
  `degree` varchar(50) NOT NULL,
  `paper_image` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `papers`
--

INSERT INTO `papers` (`id`, `paper_code`, `paper_name`, `year`, `degree`, `paper_image`, `status`, `created_at`) VALUES
(8, 'ITC 2014', 'Web Technology', '2021', 'MTECH', '951102f1e4abb418fb9934edd1c1e9c5.pdf', 1, '2020-05-01 10:14:00'),
(9, 'ITC 2234 DIPR', 'Digital Image Processing', '2019', 'MTECH', 'd2c0367a0c4bec6739e7fe1774cd88e4.pdf', 0, '2020-05-01 10:22:50'),
(10, 'ITC 2246 CRCS', 'Crypography and Computer Security', '2019', 'MTECH', 'ea2ceaa7a2c5cd0b083186d6a6eb62de.pdf', 0, '2020-05-01 10:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'admin',
  `password` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `role`, `password`, `created_at`) VALUES
(1, 'Atiqul ahmed', 'admin', 'admin', '$2y$10$YJjQMwYLBWkEPgJu0xS8quNHFU5uCmBkFJsvsX5cF4U2gp1SsmNGe', '2020-04-27 16:57:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
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
-- AUTO_INCREMENT for table `papers`
--
ALTER TABLE `papers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
