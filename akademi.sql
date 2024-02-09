-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2024 at 10:24 AM
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
-- Database: `akademi`
--

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `batches_name` varchar(50) DEFAULT NULL,
  `no_student` int(11) DEFAULT NULL,
  `start_date` varchar(50) DEFAULT NULL,
  `end_date` varchar(50) DEFAULT NULL,
  `batche_desc` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `session_id`, `course_id`, `batches_name`, `no_student`, `start_date`, `end_date`, `batche_desc`, `status`, `added_by`, `date`, `modified_by`, `modified_date`) VALUES
(1, 1, 2, 'GNM 2024-2027', 40, '2024-01-22', '2024-01-22', '', 1, 1, '2024-01-22 10:57:04', 1, '2024'),
(2, 2, 1, 'B.Sc 2024-2028', 40, '2024-01-22', '2024-01-22', '', 1, 1, '2024-01-22 10:57:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `id` int(11) NOT NULL,
  `stu_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`id`, `stu_id`) VALUES
(1, 'ATT001'),
(2, 'ATT002'),
(3, 'ATT003');

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
  `status` int(11) NOT NULL DEFAULT 1,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `courses`, `course_duration`, `course_prefix`, `sem_parttern`, `course_des`, `status`, `date`, `added_by`, `modified_by`, `modified_date`) VALUES
(1, 'BSC', '48', 'BSC', 'Yearly', '', 1, '2024-01-21 20:10:00', 0, NULL, NULL),
(2, 'GNM', '36', 'GNM', 'Yearly', '', 1, '2024-01-21 20:10:16', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fees_head`
--

CREATE TABLE `fees_head` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees_head`
--

INSERT INTO `fees_head` (`id`, `title`, `status`, `added_by`, `date`, `modified_by`, `modified_date`) VALUES
(1, 'Admission fees', 1, 1, '2024-01-21 20:00:18', NULL, NULL),
(2, 'Tuition fees', 1, 1, '2024-01-21 20:00:32', NULL, NULL),
(3, 'Caution Money', 1, 1, '2024-01-21 20:00:45', NULL, NULL),
(4, 'Library fees', 1, 1, '2024-01-21 20:00:54', NULL, NULL),
(5, 'Affiliation fees', 1, 1, '2024-01-21 20:01:53', NULL, NULL),
(6, 'Celebration', 1, 1, '2024-01-21 20:02:09', NULL, NULL),
(7, 'Computer fee', 1, 1, '2024-01-21 20:02:22', NULL, NULL),
(8, 'Development fees', 1, 1, '2024-01-21 20:02:30', NULL, NULL),
(9, 'Lamp Lighting fee', 1, 1, '2024-01-21 20:02:39', NULL, NULL),
(10, 'Hostel Rent', 1, 1, '2024-01-21 20:02:46', NULL, NULL),
(11, 'Bus fees', 1, 1, '2024-01-21 20:02:54', NULL, NULL),
(12, 'Electricity', 1, 1, '2024-01-21 20:03:03', NULL, NULL),
(13, 'Fooding', 1, 1, '2024-01-21 20:03:19', NULL, NULL),
(14, 'Annual fees', 1, 1, '2024-01-21 20:03:28', NULL, NULL),
(15, 'Hostel Rent 1st Month', 1, 1, '2024-01-21 20:03:36', NULL, NULL),
(16, 'Celebration etc', 1, 1, '2024-01-21 20:03:45', NULL, NULL),
(17, 'Bus fees 1st Month', 1, 1, '2024-01-21 20:03:55', NULL, NULL),
(18, 'Electricity 1st month', 1, 1, '2024-01-21 20:04:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_fees`
--

CREATE TABLE `monthly_fees` (
  `id` int(11) NOT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `year` int(50) DEFAULT NULL,
  `month` varchar(50) DEFAULT NULL,
  `late_fine_due_date` varchar(50) DEFAULT NULL,
  `late_fine_amount` varchar(50) DEFAULT NULL,
  `total_fees` varchar(50) DEFAULT NULL,
  `pay_status` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` int(11) NOT NULL DEFAULT 1,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monthly_fees`
--

INSERT INTO `monthly_fees` (`id`, `batch_id`, `year`, `month`, `late_fine_due_date`, `late_fine_amount`, `total_fees`, `pay_status`, `status`, `added_by`, `date`, `modified_by`, `modified_date`) VALUES
(2, 1, 2024, 'Jan', '2024-01-22', '', '6000', 0, 1, 1, '2024-01-22 10:59:19', NULL, NULL),
(3, 1, 2024, 'Feb', '2024-01-22', '', '6000', 0, 1, 1, '2024-01-22 11:00:42', NULL, NULL),
(4, 2, 2024, 'Jan', '2024-01-22', '', '8000', 0, 1, 1, '2024-01-22 12:19:43', NULL, NULL),
(5, 1, 2024, 'Mar', '2024-01-22', '', '6000', 0, 1, 1, '2024-01-22 16:06:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_fees_menu`
--

CREATE TABLE `monthly_fees_menu` (
  `id` int(11) NOT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `month` varchar(50) DEFAULT NULL,
  `fees_head_id` int(50) DEFAULT NULL,
  `amount` varchar(50) DEFAULT NULL,
  `pay_status` int(11) NOT NULL DEFAULT 0,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monthly_fees_menu`
--

INSERT INTO `monthly_fees_menu` (`id`, `batch_id`, `month`, `fees_head_id`, `amount`, `pay_status`, `status`) VALUES
(4, 1, 'Jan', 1, '2000', 0, 1),
(5, 1, 'Jan', 13, '1500', 0, 1),
(6, 1, 'Jan', 2, '1500', 0, 1),
(7, 1, 'Jan', 11, '1000', 0, 1),
(8, 1, 'Feb', 1, '2000', 0, 1),
(9, 1, 'Feb', 13, '1500', 0, 1),
(10, 1, 'Feb', 12, '1500', 0, 1),
(11, 1, 'Feb', 10, '1000', 0, 1),
(12, 2, 'Jan', 1, '500', 0, 1),
(13, 2, 'Jan', 10, '1500', 0, 1),
(14, 2, 'Jan', 14, '2000', 0, 1),
(15, 2, 'Jan', 2, '2000', 0, 1),
(16, 2, 'Jan', 13, '2000', 0, 1),
(17, 1, 'Mar', 1, '500', 0, 1),
(18, 1, 'Mar', 14, '1500', 0, 1),
(19, 1, 'Mar', 10, '1500', 0, 1),
(20, 1, 'Mar', 12, '500', 0, 1),
(21, 1, 'Mar', 10, '1500', 0, 1),
(22, 1, 'Mar', 4, '500', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `session` varchar(50) DEFAULT NULL,
  `prefix` varbinary(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `session`, `prefix`, `description`, `status`, `added_by`, `date`, `modified_by`, `modified_date`) VALUES
(1, '2024-2027', 0x32342d3237, '', 1, 1, '2024-01-21 20:11:27', NULL, NULL),
(2, '2024-2028', 0x32342d3238, '', 1, 1, '2024-01-21 20:11:55', NULL, NULL),
(3, '2025-2028', 0x32352d3238, '', 1, 1, '2024-01-21 20:12:18', NULL, NULL),
(4, '2025-2029', 0x32352d3239, '', 1, 1, '2024-01-21 20:12:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `stu_id` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `batch_id` varchar(50) DEFAULT NULL,
  `img` varchar(50) DEFAULT NULL,
  `f_name` varchar(50) DEFAULT NULL,
  `m_name` varchar(50) DEFAULT NULL,
  `age` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `f_mobile` varchar(50) DEFAULT NULL,
  `m_mobile` varchar(50) DEFAULT NULL,
  `po` varchar(50) DEFAULT NULL,
  `ps` varchar(50) DEFAULT NULL,
  `vill` varchar(50) DEFAULT NULL,
  `dist` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `pin` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `stu_id`, `name`, `batch_id`, `img`, `f_name`, `m_name`, `age`, `gender`, `mobile`, `email`, `f_mobile`, `m_mobile`, `po`, `ps`, `vill`, `dist`, `state`, `pin`, `address`, `status`, `added_by`, `date`, `modified_by`, `modified_date`) VALUES
(1, 'ATT001', 'DIPIKA ROY', '1', 'upload/65ae05e1da1d5.png', 'DEBARU ROY', 'BHAGABATI ROY', '24', 'Female', '8101202074', 'admin@gmail.com', '9832939292', '9832939292', 'RAIGANJ', 'RAIGANJ', 'SUDARSANPUR,RAIGANJ', NULL, 'West Bengal', '733134', NULL, 1, 1, '2024-01-22 11:36:25', NULL, NULL),
(2, 'ATT002', 'PREETI DAS', '1', 'upload/65ae06e85efb9.png', 'TAPAN KUMAR DAS', 'KAMALA DAS', '24', 'Female', '7407032089', 'preetidas2660@gmail.com', '9474161938', '6297280080', 'MALDA', 'MALDA', 'MALDA', NULL, 'west Bengal', '732101', NULL, 1, 1, '2024-01-22 11:40:48', NULL, NULL),
(3, 'ATT003', 'PEYALI MODAK', '2', 'upload/65ae120920378.png', 'KANAI SARKAR', 'PURNIMA CHOUDHURY SARKAR', '24', 'Female', '7364022181', 'sarkartanima54@gmail.com', '9474435467', '9382624935', 'BATUN', 'Balurghat', 'PATIRAM', NULL, 'west Bengal', '733134', NULL, 1, 1, '2024-01-22 12:28:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_upload_document`
--

CREATE TABLE `student_upload_document` (
  `id` int(11) NOT NULL,
  `student_id` varchar(50) DEFAULT NULL,
  `stu_id` varchar(50) DEFAULT NULL,
  `10th_admit` varchar(50) DEFAULT NULL,
  `10th_marksheet` varchar(50) DEFAULT NULL,
  `12th_admit` varchar(50) DEFAULT NULL,
  `12th_marksheet` varchar(50) DEFAULT NULL,
  `12th_pass_cert` varchar(50) DEFAULT NULL,
  `cast_cert` varchar(50) DEFAULT NULL,
  `transfer_cert` varchar(50) DEFAULT NULL,
  `birth_cert` varchar(50) DEFAULT NULL,
  `character_cert` varchar(50) DEFAULT NULL,
  `leaving_cert` varchar(50) DEFAULT NULL,
  `migration_cert` varchar(50) DEFAULT NULL,
  `phy_dis_cert` varchar(50) DEFAULT NULL,
  `category_cert` varchar(50) DEFAULT NULL,
  `aadhar` varchar(50) DEFAULT NULL,
  `voter` varchar(50) DEFAULT NULL,
  `pan` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `added_by` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_upload_document`
--

INSERT INTO `student_upload_document` (`id`, `student_id`, `stu_id`, `10th_admit`, `10th_marksheet`, `12th_admit`, `12th_marksheet`, `12th_pass_cert`, `cast_cert`, `transfer_cert`, `birth_cert`, `character_cert`, `leaving_cert`, `migration_cert`, `phy_dis_cert`, `category_cert`, `aadhar`, `voter`, `pan`, `status`, `added_by`, `date`, `modified_by`, `modified_date`) VALUES
(1, NULL, 'ATT001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-01-22 11:36:25', NULL, NULL),
(2, NULL, 'ATT001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-01-22 11:36:25', NULL, NULL),
(3, NULL, 'ATT002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-01-22 11:40:48', NULL, NULL),
(4, NULL, 'ATT002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-01-22 11:40:48', NULL, NULL),
(5, NULL, 'ATT003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-01-22 12:28:17', NULL, NULL),
(6, NULL, 'ATT003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-01-22 12:28:17', NULL, NULL);

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
(14, 'asdf', 'asdf@gmail.com', '$2y$10$y7FSROMpgnnpOPCk0sa7qOamacHQfab9m1y/kHoGMRqjE6u2MfiWS', 'aasdfasf', 'teacher', 1, '2023-10-07 15:52:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_head`
--
ALTER TABLE `fees_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_fees`
--
ALTER TABLE `monthly_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_fees_menu`
--
ALTER TABLE `monthly_fees_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_upload_document`
--
ALTER TABLE `student_upload_document`
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
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fees_head`
--
ALTER TABLE `fees_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `monthly_fees`
--
ALTER TABLE `monthly_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `monthly_fees_menu`
--
ALTER TABLE `monthly_fees_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_upload_document`
--
ALTER TABLE `student_upload_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
