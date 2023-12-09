-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2023 at 09:42 AM
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
-- Database: `sai`
--

-- --------------------------------------------------------

--
-- Table structure for table `approved_rejected_cv`
--

CREATE TABLE `approved_rejected_cv` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `education` text NOT NULL,
  `experience` text NOT NULL,
  `teaching_subjects` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approved_rejected_cv`
--

INSERT INTO `approved_rejected_cv` (`id`, `name`, `email`, `education`, `experience`, `teaching_subjects`, `status`, `feedback`) VALUES
(1, 'abc', 'abc@gmail.com', 'HS', '2 Years', 'Computer', 'approved', 'Good'),
(3, 'new', 'new@gmail.com', 'Graduated', 'no', 'English', 'pending', 'Ok Good'),
(4, 'check', 'check@gmail.com', 'HS', 'no', 'chemistry', 'rejected', 'good');

-- --------------------------------------------------------

--
-- Table structure for table `emp_table`
--

CREATE TABLE `emp_table` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user` varchar(200) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_table`
--

INSERT INTO `emp_table` (`id`, `username`, `email`, `password`, `user`) VALUES
(1, 'abcd', 'abcd@admin.com', 'abcd', 'admin'),
(2, '1234', '1234@gmail.com', '1234', 'user'),
(3, '154', '154@admin.com', '154', 'admin'),
(4, 'qq', 'abc@gmail.com', 'abcd', 'TA_commite'),
(0, 'insturctor', 'instructor@gmail.com', '123', 'user'),
(0, 'insturctor1', '123@gmail.com', '123', 'Instructor'),
(0, 'check', 'check@gmail.com', '1234', 'user'),
(0, 'new', 'new@gmail.com', '123', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `form_status`
--

CREATE TABLE `form_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_status`
--

INSERT INTO `form_status` (`id`, `name`, `email`, `status`) VALUES
(1, 'new', 'new@gmail.com', 'accepted'),
(8, 'check', 'check@gmail.com', 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `instructor_approve_reject`
--

CREATE TABLE `instructor_approve_reject` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `education` text NOT NULL,
  `experience` text NOT NULL,
  `teaching_subjects` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor_approve_reject`
--

INSERT INTO `instructor_approve_reject` (`id`, `name`, `email`, `education`, `experience`, `teaching_subjects`, `status`, `feedback`) VALUES
(1, 'abc', 'abc@gmail.com', 'HS', '2 Years', 'Computer', 'approved', 'Accepted'),
(3, 'new', 'new@gmail.com', 'Graduated', 'no', 'English', 'accepted', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `ta_commitee_approve_reject`
--

CREATE TABLE `ta_commitee_approve_reject` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `education` text NOT NULL,
  `experience` text NOT NULL,
  `teaching_subjects` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ta_commitee_approve_reject`
--

INSERT INTO `ta_commitee_approve_reject` (`id`, `name`, `email`, `education`, `experience`, `teaching_subjects`, `status`, `feedback`) VALUES
(1, 'abc', 'abc@gmail.com', 'HS', '2 Years', 'Computer', 'approved', 'Very Good'),
(3, 'new', 'new@gmail.com', 'Graduated', 'no', 'English', 'accepted', 'Good'),
(4, 'check', 'check@gmail.com', 'HS', 'no', 'chemistry', 'rejected', '');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_cv`
--

CREATE TABLE `teacher_cv` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `education` text NOT NULL,
  `experience` text NOT NULL,
  `teaching_subjects` text NOT NULL,
  `status` varchar(50) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_cv`
--

INSERT INTO `teacher_cv` (`id`, `name`, `email`, `education`, `experience`, `teaching_subjects`, `status`) VALUES
(1, 'abc', 'abc@gmail.com', 'HS', '2 Years', 'Computer', 'approved'),
(3, 'new', 'new@gmail.com', 'Graduated', 'no', 'English', 'pending'),
(4, 'check', 'check@gmail.com', 'HS', 'no', 'chemistry', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approved_rejected_cv`
--
ALTER TABLE `approved_rejected_cv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_status`
--
ALTER TABLE `form_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor_approve_reject`
--
ALTER TABLE `instructor_approve_reject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ta_commitee_approve_reject`
--
ALTER TABLE `ta_commitee_approve_reject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_cv`
--
ALTER TABLE `teacher_cv`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approved_rejected_cv`
--
ALTER TABLE `approved_rejected_cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `form_status`
--
ALTER TABLE `form_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `instructor_approve_reject`
--
ALTER TABLE `instructor_approve_reject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ta_commitee_approve_reject`
--
ALTER TABLE `ta_commitee_approve_reject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teacher_cv`
--
ALTER TABLE `teacher_cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
