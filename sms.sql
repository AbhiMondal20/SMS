-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2023 at 02:18 PM
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
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `courses` varchar(255) DEFAULT NULL,
  `course_duration` varchar(255) DEFAULT NULL,
  `course_prefix` varchar(255) DEFAULT NULL,
  `sem_parttern` char(255) DEFAULT NULL,
  `course_des` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `mobile`, `role`, `status`, `date`) VALUES
(1, 'Admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '8101202074', '0', 1, '2023-10-07 12:17:16'),
(2, 'Abhi', 'abhi@gmail.com', '$2y$10$vP940gaE7j1pcZlAk/YjTeQ6a2XnCK6m8b9tMrQtN/gHao320j95m', '8101202074', 'teacher', 1, '2023-10-07 15:11:24'),
(3, 'sa', 'abhi12@gmail.com', '$2y$10$l4uBpKICGHHFW3Vylm9bhea8HTnA5.YMk8mvBbq5tzG99vMgRafp2', '8116596584', 'admin', 1, '0000-00-00 00:00:00'),
(4, 'demo', 'demo@gmail.com', '$2y$10$xmuj8yTCT4dme49feLW5b.GpIfzqNCnU0n.w0CevOf8.aANE/Duea', '8101202074', '0', 1, '0000-00-00 00:00:00'),
(5, 'Test', 'test@gmail.com', '$2y$10$SiRhMJSL6KoQGQDpplY3iuxDQxpPiCGwtNnsCwmVOyqBZMDTYu4Ru', '8101202074', 'admin', 1, '2023-10-07 15:21:38'),
(6, 'sa', 'ab12hi@gmail.com', '$2y$10$EhaRsegR/TCP5vg3aF.i5uBnv5k63hunPGpfA8NkXI2nLPs8aiNyu', 'asfsafsafsaf', 'admin', 0, '2023-10-07 15:21:36'),
(7, 'asdas', '12121221@gmail.com', '$2y$10$ghDcWWFeTT2etFVbYtI/xON6QV50rlHiSh9NQitnDyGoKdhqGOYk.', '8101202074', 'admin', 1, '2023-10-07 15:21:30'),
(8, 'ADmin', 'abhi111@gmail.com', '$2y$10$cPIxYWxE2a9Bac78p0s/meqs4PBnvX31XADOlWfOpI387TAOEUbkK', '8101202074', 'admin', 0, '2023-10-07 15:40:59'),
(9, 'asfasd', 's.chatterjee@gmail.com', '$2y$10$KNbCZZgTSvS6mZy4jIalWe6r9MdeZNcfYcT7FwVIG0tNHX1.UIYFa', '8101202074', 'admin', 1, '2023-10-07 15:42:27'),
(10, 'Test', 'adm31in@gmail.com', '$2y$10$bfP8Xf5WXqOhuqaDx62LIuAJ0.ZMtXAhST0KbpX4OMYxTR4F3lGSi', '8116596584', 'teacher', 1, '2023-10-07 15:45:47'),
(11, 'Test', 'abhi121@gmail.com', '$2y$10$s7IHDOZuAMQaxpomDLtdT.wpG9.EfWVwPIG1RflvbrmaXk9KCUht6', '8116596584', 'teacher', 1, '2023-10-07 15:48:05'),
(12, 'sa', 'admin1155@gmail.com', '$2y$10$c3c4Sh4s0QnmM31PYMqYOOyoxPQLhbO5yyvrnB4exzi6GaGTot.VK', '8116596584', 'teacher', 1, '2023-10-07 15:49:00'),
(13, 'sa', 'abh154i@gmail.com', '$2y$10$R/j97YUrEciO4l//vlKR4uQRqcDh2RDT/.LDpcHoey0LxaK2HYZRW', '8101202074', 'teacher', 1, '2023-10-07 15:51:04'),
(14, 'asdf', 'asdf@gmail.com', '$2y$10$y7FSROMpgnnpOPCk0sa7qOamacHQfab9m1y/kHoGMRqjE6u2MfiWS', 'aasdfasf', 'teacher', 1, '2023-10-07 15:52:43'),
(15, 'sa', 'admin12@gmail.com', '$2y$10$vftBxLW0xaNenMZ8IOSf8u//M53ft9O8RkmbOMCWPpeSvbbE8KEi.', '8787877458', 'admin', 1, '2023-10-07 16:24:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
