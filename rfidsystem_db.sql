-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 04:30 PM
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
-- Database: `rfidsystem_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `dept_name` varchar(255) DEFAULT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `dept_name`, `color`) VALUES
(4, 'Teacher Education Department', '#9c8fff'),
(5, 'Computer Studies Department', '#3cbeb5'),
(8, 'Engineering Department', '#e6b400'),
(20, 'Industrial Technology Department', '#0065d1'),
(21, 'Business and Management Department', '#00b324');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `bdate` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cellnum` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `employee_type_id` int(11) DEFAULT NULL,
  `employee_lvl_id` int(11) DEFAULT NULL,
  `employee_dept_id` int(11) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `rfid` varchar(255) DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0= active, 1=archived'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_lvl`
--

CREATE TABLE `employee_lvl` (
  `id` int(11) NOT NULL,
  `employee_lvl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_lvl`
--

INSERT INTO `employee_lvl` (`id`, `employee_lvl`) VALUES
(1, 'Admin'),
(2, 'Faculty');

-- --------------------------------------------------------

--
-- Table structure for table `employee_type`
--

CREATE TABLE `employee_type` (
  `id` int(11) NOT NULL,
  `employee_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_type`
--

INSERT INTO `employee_type` (`id`, `employee_type`) VALUES
(1, 'Administrative Staff'),
(2, 'Designated Faculty'),
(3, 'Teacher/Instructor'),
(4, 'Part Time Staff');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `device_info` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `prog_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `dept_id`, `prog_name`) VALUES
(7, 5, 'Bachelor of Science in Information Technology'),
(8, 4, 'Bachelor of Science in Hospitality Management'),
(9, 8, 'Bachelor of Science in Mechanical Engineering'),
(13, 8, 'Bachelor of Science in Electrical Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `record_table` varchar(255) NOT NULL,
  `record_date` date DEFAULT NULL,
  `timein` time DEFAULT NULL,
  `timeout` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`) VALUES
(4, 'Canteen Vendor'),
(1, 'Employee'),
(2, 'Student'),
(3, 'Visitor');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `bdate` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cellnum` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `parent_name` varchar(255) DEFAULT NULL,
  `parent_num` varchar(255) DEFAULT NULL,
  `parent_address` varchar(255) DEFAULT NULL,
  `school_id` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `prog_id` int(11) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `rfid` varchar(255) DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0= active, 1=archived'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `bdate` date DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `cellnum` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` longtext NOT NULL,
  `account_type` int(11) NOT NULL DEFAULT 0 COMMENT '1=admin, 2=staff, 3=security personnel',
  `img_path` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `mname`, `lname`, `bdate`, `gender`, `address`, `cellnum`, `email`, `school_id`, `username`, `password`, `account_type`, `img_path`, `status`) VALUES
(1, 'John Mark', 'Fabon', 'Cuyos', '2000-07-17', 'male', 'Albuera, Leyte', '09108825534', 'j0hnm4rkcuyos@gmail.com', '2021-30174', 'admin', '$2y$10$3bySCKE6V6xUrtOGMTugaea.cb5ALxlk3fH8uL6MRJ0VX9JR7XM1O', 1, '1727780760John Mark.png', 0),
(2, 'Caloy', 'wew', 'Tijas', '2024-09-04', 'male', 'asdasd', '09226101018', 'caloy@gmail.com', 'asd21123123', 'guard', '$2y$10$pwjibdyKKp76j.K2cR0tFeTbEG0zPqsmzlrEOhzN/Q./D07xPEVvi', 3, '1728128400Caloy.png', 0),
(3, 'Natnat', 'wew', 'Poticar', '2002-11-05', 'female', 'adasdaada', '09751407146', 'natnat@gmail.com', 'asd21312312asd', 'staff', '$2y$10$mQmeVV0G1yqTiWfKp5i8V.cMuXqyRPEx/Na8gmoiN5rQXMkqkZOmW', 2, '1727800980Natnat.png', 0),
(4, 'wew', 'wew', 'wew', '2024-09-11', 'female', 'wew', '23123123', 'wew@sada.com', '3213123', 'wew', '$2y$10$/n4q9PMhVAxy78.i8WtAPe3dI8QI3XLRt2t6wN3u0dnMqNQKlkrrW', 2, '1727592660wew.png', 1),
(5, 'gege', 'eaweaw', 'eaweawe', '2024-09-12', 'female', 'aweaw', '123123', 'aeaew@sasd.com', '23123123', 'wew', '$2y$10$jBpvNseWhS4IUl9Yvst7quKMQM2GeBxJ2vPQC1llo1SwFTrsBWfh.', 2, '1728128513gegeeaweawe.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `bdate` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cellnum` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `parent_name` varchar(255) DEFAULT NULL,
  `parent_num` varchar(255) DEFAULT NULL,
  `parent_address` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `rfid` varchar(255) DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=active, 1=archive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `bdate` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cellnum` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `parent_name` varchar(255) DEFAULT NULL,
  `parent_num` varchar(255) DEFAULT NULL,
  `parent_address` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `rfid` varchar(255) DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0= active, 1=archived'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dept_name` (`dept_name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rfid` (`rfid`);

--
-- Indexes for table `employee_lvl`
--
ALTER TABLE `employee_lvl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_type`
--
ALTER TABLE `employee_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cat_name` (`role_name`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rfid` (`rfid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rfid` (`rfid`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rfid` (`rfid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_lvl`
--
ALTER TABLE `employee_lvl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_type`
--
ALTER TABLE `employee_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
