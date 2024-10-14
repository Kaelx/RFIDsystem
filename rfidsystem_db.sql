-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2024 at 05:43 PM
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
(5, 'Computer Studies Department', '#1ba79d'),
(8, 'Engineering Department', '#e6b400'),
(20, 'Industrial Technology Department', '#0065d1'),
(21, 'Business and Management Department', '#1ca037');

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

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fname`, `mname`, `lname`, `bdate`, `gender`, `address`, `cellnum`, `email`, `employee_type_id`, `employee_lvl_id`, `employee_dept_id`, `school_id`, `role_id`, `rfid`, `img_path`, `status`) VALUES
(1, 'John', 'Ophelia', 'Stehr', '2006-05-12', 'male', '78893 DuBuque Villag', '09910218554', 'dwisoky@example.net', 2, 0, 21, '2021-75723', 1, '0037969829', '1728261287JohnStehr.png', 0),
(2, 'Callie', 'Cruz', 'Walsh', '2003-07-01', 'female', '45681 West SquaresN', '09041876007', 'grosenbaum@example.com', 3, 2, 21, '2021-97385', 1, '0036769237', '1728261350CallieWalsh.png', 0),
(3, 'Cierra', 'Geo', 'Herman', '2014-08-06', 'female', '29638 Estrella Vista', '09384617464', 'murazik.gloria@example.org', 1, 1, 0, '2024-28485', 1, '0037646525', '1728261388CierraHerman.png', 0),
(4, 'Stella', 'Jimmie', 'Oberbrunner', '1982-07-26', 'female', '77368 Witting Fields', '09573365375', 'zemlak.hector@example.net', 1, 1, 0, '2023-74592', 1, '0036595314', '1728261415StellaOberbrunner.png', 0),
(5, 'Vergie', 'Cyril', 'Roberts', '2004-02-04', 'female', '25344 Brent StreetN', '09867169260', 'harmon.smith@example.org', 4, 2, 0, '2023-90108', 1, '6456456456', '1728258099VergieRoberts.png', 1),
(6, 'Kelsi', 'Demetris', 'Muller', '1982-05-18', 'female', '5572 Lueilwitz Shoal', '09906792742', 'okeefe.finn@example.com', NULL, NULL, 0, '2023-13015', 1, NULL, NULL, 1),
(7, 'Jaren', 'Lambert', 'Howe', '2001-11-08', 'male', '84836 Oral Parks\nLak', '09538706362', 'ikonopelski@example.com', NULL, NULL, 0, '2024-12636', 1, NULL, NULL, 1),
(8, 'Isaac', 'Drew', 'Ankunding', '1994-11-15', 'female', '804 Anderson Highway', '09105627815', 'seamus43@example.org', NULL, NULL, 0, '2021-49418', 1, NULL, NULL, 1),
(9, 'Maximo', 'Demetrius', 'Johnson', '1998-09-21', 'male', '7517 Brekke Mountain', '09667564325', 'keshawn.ortiz@example.org', NULL, NULL, 0, '2022-82083', 1, NULL, NULL, 1),
(10, 'Zander', 'Cassie', 'Weimann', '1983-09-13', 'female', '55470 Beatty Well\nFl', '09970430830', 'shad80@example.org', NULL, NULL, 0, '2023-35204', 1, NULL, NULL, 1),
(11, 'Shanna', 'Margie', 'Klocko', '2000-03-26', 'male', '562 Keebler Overpass', '09288511624', 'prutherford@example.net', NULL, NULL, 0, '2023-91661', 1, NULL, NULL, 1),
(12, 'Glenda', 'Jules', 'Donnelly', '1994-05-22', 'male', '173 Imogene Extensio', '09243397994', 'xcollier@example.org', NULL, NULL, 0, '2022-33621', 1, NULL, NULL, 1),
(13, 'wew', 'wew', 'wew', '2014-12-03', 'female', 'wew', '23142342342', 'wew@wew.ew', 1, 1, 0, '213123123', 1, '0037939526', NULL, 1),
(14, 'jm', 'jm', 'jm', '2000-07-17', 'male', 'Albuera, Tabgas, Zone 4', '32423423423', 'jm@asd.asd', 2, 2, 8, '23423423', 1, '4234234234', '1728727064jmjm.png', 1),
(15, 'wew', 'ewe', 'wew', '2014-12-10', 'male', 'kekek, brgy. Tambulilid, Ormoc City', '09345345345', 'wew@gmail.asd', 3, 2, 0, '5345345', 1, '2432423423', '1728727323wewwew.png', 1);

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
(1, 'Administrative Staff (Admin)'),
(2, 'Administrative Staff (Faculty)'),
(3, 'Designated Faculty'),
(4, 'Teacher/Instructor'),
(5, 'Teacher/Instructor (Part time)'),
(7, 'COS');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `action`, `timestamp`) VALUES
(1, 1, ' has logged out', '2024-10-12 13:40:13'),
(2, 1, ' has logged in', '2024-10-12 13:40:20'),
(3, 1, ' generate a report with the Reference ID of report_id = \'', '2024-10-12 13:41:27'),
(4, 1, 'generate a report with the Reference ID of ', '2024-10-12 13:42:28'),
(5, 1, 'generate a report with the Reference ID of 836662449763', '2024-10-12 13:45:01'),
(6, 1, 'generate a report with the Reference ID of 150879935055', '2024-10-12 13:45:53'),
(7, 1, 'generate a report with the Reference ID of 363353521772', '2024-10-12 13:47:34'),
(8, 1, 'generate a report with the Reference ID of 425554809131', '2024-10-12 13:48:16'),
(9, 1, 'generate a report with the Reference ID of 915930683244', '2024-10-12 13:50:24'),
(10, 1, 'generate a report with the Reference ID of 915930683244', '2024-10-12 13:50:29'),
(11, 1, 'generate a report with the Reference ID of 915930683244', '2024-10-12 13:50:37'),
(12, 1, 'generate a report with the Reference ID of 915930683244', '2024-10-12 13:52:49'),
(13, 1, 'generate a report with the Reference ID of 915930683244', '2024-10-12 13:54:17'),
(14, 1, 'generate a report with the Reference ID of 915930683244', '2024-10-12 13:54:19'),
(15, 1, 'generate a report with the Reference ID of 362274611549', '2024-10-12 13:54:50'),
(16, 1, 'generate a report with the Reference ID of 362274611549', '2024-10-12 13:54:54'),
(17, 1, 'generate a report with the Reference ID of 950513037988', '2024-10-12 13:55:41'),
(18, 1, 'generate a report with the Reference ID of 125189868814', '2024-10-12 13:56:36'),
(19, 1, 'generate a report with the Reference ID of 572153657124', '2024-10-12 13:57:09'),
(20, 1, 'generate a report with the Reference ID of 871005487940', '2024-10-12 13:57:37'),
(21, 1, 'generate a report with the Reference ID of 874354215605', '2024-10-12 13:58:53'),
(22, 1, 'generate a report with the Reference ID of 874354215605', '2024-10-12 13:59:01'),
(23, 1, 'generate a report with the Reference ID of 981163135949', '2024-10-12 14:15:10'),
(24, 1, 'generate a report with the Reference ID of 981163135949', '2024-10-12 14:15:21'),
(25, 1, 'generate a report with the Reference ID of 524414779226', '2024-10-12 14:15:51'),
(26, 1, 'generate a report with the Reference ID of 264469141850', '2024-10-12 14:16:47'),
(27, 1, 'generate a report with the Reference ID of 515500366442', '2024-10-12 14:17:03'),
(28, 1, ' has logged in', '2024-10-12 14:18:06'),
(29, 1, 'generate a report with the Reference ID of 742581327774', '2024-10-12 14:18:24'),
(30, 1, ' has logged in', '2024-10-12 14:19:54'),
(31, 1, 'generate a report with the Reference ID of 627904214979', '2024-10-12 14:20:33'),
(32, 1, 'generate a report with the Reference ID of 804183752124', '2024-10-12 14:31:57'),
(33, 1, 'generate a report with the Reference ID of 804183752124', '2024-10-12 14:32:07'),
(34, 1, 'generate a report with the Reference ID of 960584546118', '2024-10-12 14:33:04'),
(35, 1, 'generate a report with the Reference ID of 960584546118', '2024-10-12 14:33:34'),
(36, 1, 'generate a report with the Reference ID of 507744801164', '2024-10-12 14:46:33'),
(37, 1, 'generate a report with the Reference ID of 507744801164', '2024-10-12 14:47:43'),
(38, 1, 'generate a report with the Reference ID of ', '2024-10-12 15:04:51'),
(39, 1, 'generate a report with the Reference ID of ', '2024-10-12 15:04:55'),
(40, 1, 'generate a report with the Reference ID of 880586673', '2024-10-12 15:09:05'),
(41, 1, 'generate a report with the Reference ID of 418071948', '2024-10-12 15:09:20'),
(42, 1, 'generate a report with the Reference ID of 845186382', '2024-10-12 15:09:43'),
(43, 1, 'generate a report with the Reference ID of 845186382', '2024-10-12 15:09:48'),
(44, 1, 'generate a report with the Reference ID of 848780070', '2024-10-12 15:11:10'),
(45, 1, 'generate a report with the Reference ID of 444504213', '2024-10-12 15:14:48'),
(46, 1, 'generate a report with the Reference ID of 653666057', '2024-10-12 15:15:19'),
(47, 1, 'generate a report with the Reference ID of 175710425', '2024-10-12 15:15:45'),
(48, 1, 'generate a report with the Reference ID of 175846271', '2024-10-12 15:17:51'),
(49, 1, 'generate a report with the Reference ID of 573639991', '2024-10-12 15:18:08'),
(50, 1, 'generate a report with the Reference ID of 438439874', '2024-10-12 15:18:54'),
(51, 1, 'generate a report with the Reference ID of 840311154', '2024-10-12 15:19:51'),
(52, 1, 'generate a report with the Reference ID of 667160247', '2024-10-12 15:21:09'),
(53, 1, 'generate a report with the Reference ID of 366896726', '2024-10-12 15:21:18'),
(54, 1, 'generate a report with the Reference ID of 244367597', '2024-10-12 15:21:59'),
(55, 1, 'generate a report with the Reference ID of 200971619', '2024-10-12 15:22:44'),
(56, 1, 'generate a report with the Reference ID of 276479336', '2024-10-12 15:23:38'),
(57, 1, 'generate a report with the Reference ID of 548562853', '2024-10-12 15:24:18'),
(58, 1, 'generate a report with the Reference ID of 168369034', '2024-10-12 15:24:27'),
(59, 1, 'generate a report with the Reference ID of 994688958', '2024-10-12 15:25:34'),
(60, 1, 'generate a report with the Reference ID of 770165859', '2024-10-12 15:35:54'),
(61, 1, ' has updated the Teacher Education Department category', '2024-10-12 15:36:19'),
(62, 1, 'generate a report with the Reference ID of 592669202', '2024-10-12 15:51:45'),
(63, 1, 'generate a report with the Reference ID of 525531191', '2024-10-12 15:53:04'),
(64, 1, 'generate a report with the Reference ID of 566428046', '2024-10-12 16:00:55'),
(65, 1, 'generate a report with the Reference ID of 268857706', '2024-10-12 16:01:03'),
(66, 1, 'generate a report with the Reference ID of 837756155', '2024-10-12 16:37:57'),
(67, 1, 'generate a report with the Reference ID of 611134579', '2024-10-12 16:38:14'),
(68, 1, 'generate a report with the Reference ID of 555541926', '2024-10-12 16:40:12'),
(69, 1, 'generate a report with the Reference ID of 267065502', '2024-10-12 16:40:30'),
(70, 1, 'generate a report with the Reference ID of 959880609', '2024-10-12 16:42:50'),
(71, 1, 'generate a report with the Reference ID of 885032091', '2024-10-12 16:43:23'),
(72, 1, 'generate a report with the Reference ID of 714545079', '2024-10-12 16:43:41'),
(73, 1, 'generate a report with the Reference ID of 757107166', '2024-10-12 16:44:20'),
(74, 1, 'generate a report with the Reference ID of 599118813', '2024-10-12 16:45:18'),
(75, 1, 'generate a report with the Reference ID of 266609884', '2024-10-12 16:45:49'),
(76, 1, 'generate a report with the Reference ID of 962753869', '2024-10-12 16:51:28'),
(77, 1, ' has updated the Business and Management Department category', '2024-10-12 16:52:28'),
(78, 1, ' has logged out', '2024-10-12 17:03:59'),
(79, 1, ' has logged in', '2024-10-12 17:08:40'),
(80, 1, ' has registered new employee jm jm', '2024-10-12 17:57:44'),
(81, 1, ' has archived an employee jm jm', '2024-10-12 18:01:04'),
(82, 1, ' has registered new employee wew wew', '2024-10-12 18:02:03'),
(83, 1, 'generate a report with the Reference ID of 384108786', '2024-10-12 18:18:25'),
(84, 1, 'generate a report with the Reference ID of 899043669', '2024-10-12 18:18:41'),
(85, 1, ' has logged in', '2024-10-13 02:05:55'),
(86, 1, 'generate a report with the Reference ID of 197014627', '2024-10-13 02:06:36'),
(87, 1, ' has updated the visitor information of Opal Nicolas', '2024-10-13 02:07:48'),
(88, 1, 'generate a report with the Reference ID of 289138079', '2024-10-13 02:13:04'),
(89, 1, ' has logged out', '2024-10-13 02:14:14'),
(90, 1, ' has logged in', '2024-10-13 12:16:41'),
(91, 1, ' has logged in', '2024-10-13 19:44:57'),
(92, 1, ' has updated the employee information of John Stehr', '2024-10-13 22:51:47'),
(93, 1, ' has updated the employee information of John Stehr', '2024-10-13 22:52:33'),
(94, 1, 'generate a report with the Reference ID of 200332581', '2024-10-13 23:02:00'),
(95, 1, 'generate a report with the Reference ID of 239781308', '2024-10-13 23:03:48'),
(96, 1, 'generate a report with the Reference ID of 718496243', '2024-10-13 23:03:59'),
(97, 1, 'generate a report with the Reference ID of 481991625', '2024-10-13 23:04:29'),
(98, 1, 'generate a report with the Reference ID of 531552192', '2024-10-13 23:04:44'),
(99, 1, 'generate a report with the Reference ID of 783369608', '2024-10-13 23:05:06'),
(100, 1, 'generate a report with the Reference ID of 640705344', '2024-10-13 23:07:20'),
(101, 1, 'generate a report with the Reference ID of 132538822', '2024-10-13 23:07:46'),
(102, 1, 'generate a report with the Reference ID of 148149952', '2024-10-13 23:07:58'),
(103, 1, 'generate a report with the Reference ID of 431473432', '2024-10-13 23:08:06'),
(104, 1, 'generate a report with the Reference ID of 284331108', '2024-10-13 23:13:20'),
(105, 1, 'generate a report with the Reference ID of 314854406', '2024-10-13 23:13:32'),
(106, 1, 'generate a report with the Reference ID of 450740547', '2024-10-13 23:14:01'),
(107, 1, 'generate a report with the Reference ID of 848933915', '2024-10-13 23:14:51'),
(108, 1, 'generate a report with the Reference ID of 661734585', '2024-10-13 23:15:04'),
(109, 1, 'generate a report with the Reference ID of 787908808', '2024-10-13 23:16:00'),
(110, 1, 'generate a report with the Reference ID of 478542158', '2024-10-13 23:16:10'),
(111, 1, 'generate a report with the Reference ID of 461836072', '2024-10-13 23:16:20'),
(112, 1, 'generate a report with the Reference ID of 328402007', '2024-10-13 23:16:30'),
(113, 1, 'generate a report with the Reference ID of 550916321', '2024-10-13 23:16:38'),
(114, 1, ' has logged out', '2024-10-13 23:25:24'),
(115, 2, ' has logged in', '2024-10-13 23:25:29'),
(116, 2, ' has logged out', '2024-10-13 23:27:47'),
(117, 3, ' has logged in', '2024-10-13 23:27:51'),
(118, 3, ' has archived an employee wew wew', '2024-10-13 23:28:51'),
(119, 3, ' has logged out', '2024-10-13 23:30:06'),
(120, 1, ' has logged in', '2024-10-13 23:30:11'),
(121, 1, ' has logged out', '2024-10-13 23:33:54'),
(122, 1, ' has logged in', '2024-10-13 23:34:11'),
(123, 1, ' has logged in', '2024-10-13 23:40:55');

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

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `record_id`, `record_table`, `record_date`, `timein`, `timeout`) VALUES
(1, 3, 'employee', '2024-10-14', '21:37:46', '21:39:16'),
(2, 1, 'employee', '2024-10-14', '21:37:47', '21:39:15'),
(3, 1, 'student', '2024-10-13', '21:37:49', '21:39:14'),
(4, 2, 'employee', '2024-10-13', '21:37:50', '21:39:12'),
(5, 1, 'visitor', '2024-10-13', '21:37:51', '21:39:11'),
(6, 4, 'employee', '2024-10-13', '21:37:52', '21:39:10'),
(7, 16, 'student', '2024-10-13', '21:37:54', '21:39:09'),
(8, 3, 'employee', '2024-10-13', '21:54:14', '21:54:43'),
(9, 1, 'employee', '2024-10-15', '21:54:20', '21:54:43'),
(10, 1, 'student', '2024-10-15', '21:54:21', '00:00:00'),
(11, 1, 'student', '2024-10-15', '21:54:25', '21:54:42'),
(12, 2, 'employee', '2024-10-13', '21:54:27', '21:54:41'),
(13, 1, 'visitor', '2024-10-13', '21:54:28', '21:54:40'),
(14, 4, 'employee', '2024-10-15', '21:54:29', '21:54:39'),
(15, 16, 'student', '2024-10-13', '21:54:30', '21:54:38'),
(16, 16, 'student', '2024-10-13', '21:59:04', '21:59:26'),
(17, 4, 'employee', '2024-10-12', '21:59:06', '21:59:25'),
(18, 1, 'visitor', '2024-10-12', '21:59:07', '21:59:24'),
(19, 2, 'employee', '2024-10-12', '21:59:08', '21:59:23'),
(20, 1, 'student', '2024-10-12', '21:59:09', '21:59:22'),
(21, 1, 'employee', '2024-10-12', '21:59:10', '21:59:21'),
(22, 3, 'employee', '2024-10-12', '21:59:12', '21:59:20'),
(23, 16, 'student', '2024-10-13', '22:00:41', '22:01:00'),
(24, 4, 'employee', '2024-10-13', '22:00:42', '22:00:59'),
(25, 1, 'visitor', '2024-10-13', '22:00:44', '22:00:58'),
(26, 2, 'employee', '2024-10-14', '22:00:45', '22:00:57'),
(27, 1, 'student', '2024-10-12', '22:00:46', '22:00:56'),
(28, 1, 'employee', '2024-10-12', '22:00:47', '22:00:54'),
(29, 3, 'employee', '2024-10-12', '22:00:48', '22:00:53'),
(30, 3, 'employee', '2024-10-13', '22:03:20', '22:03:32'),
(31, 1, 'employee', '2024-10-11', '22:03:21', '22:03:33'),
(32, 1, 'student', '2024-10-11', '22:03:22', '22:03:35'),
(33, 2, 'employee', '2024-10-11', '22:03:24', '22:03:36'),
(34, 1, 'visitor', '2024-10-11', '22:03:25', '22:03:37'),
(35, 4, 'employee', '2024-10-11', '22:03:26', '22:03:38'),
(36, 16, 'student', '2024-10-11', '22:03:27', '22:03:39'),
(37, 16, 'student', '2024-10-13', '22:53:18', NULL),
(38, 4, 'employee', '2024-10-13', '22:53:19', '22:55:26'),
(39, 1, 'visitor', '2024-10-13', '22:53:26', NULL),
(40, 2, 'employee', '2024-10-13', '22:53:29', '22:55:29'),
(41, 1, 'student', '2024-10-13', '22:53:32', NULL),
(42, 1, 'employee', '2024-10-13', '22:53:34', '22:55:31'),
(43, 3, 'employee', '2024-10-13', '22:53:36', NULL),
(44, 4, 'employee', '2024-10-13', NULL, '22:55:36'),
(45, 1, 'employee', '2024-10-13', NULL, '22:55:39'),
(46, 2, 'employee', '2024-10-13', NULL, '22:55:43'),
(47, 4, 'employee', '2024-10-13', NULL, '22:55:45'),
(48, 1, 'employee', '2024-10-13', NULL, '22:55:47'),
(49, 4, 'employee', '2024-10-13', NULL, '22:55:53'),
(50, 1, 'employee', '2024-10-13', NULL, '22:55:54'),
(51, 4, 'employee', '2024-10-13', NULL, '22:55:57'),
(52, 1, 'employee', '2024-10-13', '22:57:38', '22:57:50'),
(53, 4, 'employee', '2024-10-13', '22:57:39', '22:57:49'),
(54, 4, 'employee', '2024-10-13', NULL, '22:58:11'),
(55, 1, 'employee', '2024-10-13', NULL, '22:58:13');

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
  `school_id` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `prog_id` int(11) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `rfid` varchar(255) DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0= active, 1=archived'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fname`, `mname`, `lname`, `bdate`, `gender`, `address`, `cellnum`, `email`, `parent_name`, `parent_num`, `school_id`, `role_id`, `prog_id`, `dept_id`, `rfid`, `img_path`, `status`) VALUES
(1, 'John Mark', 'Fabon', 'Cuyos', '2000-07-17', 'male', '6457 Dewayne Groves', '09262256870', 'trisha08@example.org', 'Zoila Koss', '09399148460', '2024-25142', 2, 7, 5, '0045444797', '1728261478John MarkCuyos.png', 0),
(2, 'Twila', 'Bernie', 'McClure', '1998-11-29', 'male', '803 Beier Terrace Ap', '09228605728', 'stevie72@example.org', 'Jaqueline Rosenbaum', '09467151373', '2021-40850', 2, NULL, NULL, NULL, NULL, 1),
(3, 'Alejandrin', 'Kailey', 'Rippin', '2001-07-19', 'female', '1731 Willms Flat Sui', '09470865021', 'pshanahan@example.com', 'Brannon Williamson III', '09849927876', '2024-20960', 2, 8, 4, '56767567567', NULL, 1),
(4, 'Trisha', 'Randal', 'OHara', '1998-03-29', 'female', '4594 Ledner PortsSo', '09828998069', 'iferry@example.net', 'Ernestina Cronin', '09355775406', '2023-95968', 2, 8, 4, '55345345345', NULL, 1),
(5, 'Lane', 'Janick', 'Deckow', '1995-04-05', 'male', '818 Leonel Harbors\nR', '09880077363', 'jjerde@example.org', 'Clara Walter', '09096202828', '2024-55096', 2, NULL, NULL, NULL, NULL, 1),
(6, 'Hilton', 'Daija', 'Murazik', '1996-01-29', 'male', '407 Antonette Fort S', '09490587061', 'yost.shania@example.net', 'Elliott Dickens', '09802183315', '2022-31710', 2, NULL, NULL, NULL, NULL, 1),
(7, 'Lysanne', 'Brown', 'Grimes', '1976-10-04', 'male', '716 Miguel Square Ap', '09142735084', 'terry.shanna@example.net', 'Alfred Bins', '09996809013', '2022-51210', 2, NULL, NULL, NULL, NULL, 1),
(8, 'Emilia', 'Pamela', 'Will', '2016-02-16', 'female', '4299 Sauer Spurs Apt', '09434487479', 'jayce24@example.com', 'Randall Hill', '09509224325', '2024-78841', 2, NULL, NULL, NULL, NULL, 1),
(9, 'Josianne', 'Deon', 'Feil', '2024-04-11', 'male', '59813 Cierra Plains ', '09081525960', 'ehamill@example.net', 'Yvonne Anderson', '09955008625', '2021-80500', 2, NULL, NULL, NULL, NULL, 1),
(10, 'Bethany', 'Theresia', 'Mueller', '1990-11-12', 'male', '241 Schultz Mountain', '09094587525', 'lenny.schroeder@example.org', 'Dr. Linwood Stanton', '09225401176', '2022-89771', 2, NULL, NULL, NULL, NULL, 1),
(11, 'Frida', 'Yoshiko', 'Mueller', '2023-01-19', 'male', '1448 Gerhold Knolls ', '09344504916', 'gregorio28@example.org', 'Jaunita Smitham II', '09647166937', '2021-20132', 2, NULL, NULL, NULL, NULL, 1),
(12, 'Declan', 'Tad', 'Kling', '1995-12-04', 'female', '9591 Rhoda Green Sui', '09028391004', 'zetta50@example.net', 'Trisha Bogisich DVM', '09032471766', '2023-39428', 2, NULL, NULL, NULL, NULL, 1),
(13, 'Ulises', 'Alfonso', 'Roberts', '1993-10-14', 'male', '37761 Russel Canyon\n', '09397790737', 'malcolm37@example.net', 'Frida Wunsch', '09665815123', '2022-88706', 2, NULL, NULL, NULL, NULL, 1),
(14, 'Josie', 'Cecile', 'Mante', '1977-02-01', 'female', '69722 Heathcote Oval', '09204153917', 'felicity40@example.net', 'Dr. Rosendo Turner', '09947221925', '2021-99443', 2, NULL, NULL, NULL, NULL, 1),
(15, 'Leilani', 'Malvina', 'Dicki', '1980-10-18', 'male', '93177 Schulist Walk ', '09798251023', 'rhiannon.auer@example.com', 'Chelsea Kertzmann', '09774508871', '2021-32842', 2, NULL, NULL, NULL, NULL, 1),
(16, 'Brint', 'Weh', 'Aranez', '2014-07-02', 'female', 'Ormoc', '09234782342', 'brint@gmail.com', 'jahduyiasda', '09234234234', '2021-234234', 2, 13, 8, '0037804295', '1728261500BrintAranez.png', 0),
(17, 'Anjelyn', 'Weh', 'Romo', '2009-06-18', 'female', 'me', '09344353453', 'me@me.me', 'mememe', '09346354353', '3455345345', 2, 8, 4, '000000', '1728261522AnjelynRomo.png', 0);

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
(1, 'John Mark', 'Fabon', 'Cuyos', '2000-07-17', 'male', 'Albuera, Leyte', '09751407146', 'j0hnm4rkcuyos@gmail.com', '2021-30174', 'admin', '$2y$10$GOkY/GJnmRlKkM0livQ33u9KuukXE3CW8LOe1hg9l4hn8WrhnfURK', 1, '1728262268John MarkCuyos.png', 0),
(2, 'Caloy', 'Weh', 'Tijas', '2005-02-18', 'male', 'asdasd', '09226101018', 'caloy@gmail.com', '2021-784376', 'guard', '$2y$10$pwjibdyKKp76j.K2cR0tFeTbEG0zPqsmzlrEOhzN/Q./D07xPEVvi', 3, '1728262295CaloyTijas.png', 0),
(3, 'Nathalie Grace', 'Punay', 'Poticar', '2002-11-05', 'female', 'Ormoc, City', '09751407146', 'natnat@gmail.com', '2021-32529', 'staff', '$2y$10$mQmeVV0G1yqTiWfKp5i8V.cMuXqyRPEx/Na8gmoiN5rQXMkqkZOmW', 2, '1728262311Nathalie GracePoticar.png', 0),
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
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cellnum` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `rfid` varchar(255) DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0= active, 1=archived'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `fname`, `mname`, `lname`, `gender`, `address`, `cellnum`, `role_id`, `rfid`, `img_path`, `status`) VALUES
(1, 'Opal', 'Shyanne', 'Nicolas', 'male', '1459 Fay Road Suite ', '09409217045', 3, '0036528715', '1728756468OpalNicolas.png', 0),
(2, 'Ferne', 'Magnolia', 'Lowe', 'male', '4205 Rosanna Passage', '09663757282', 3, NULL, NULL, 1),
(3, 'Blanca', 'Alycia', 'Howe', 'female', '159 Augustine Mounta', '09168793351', 3, NULL, NULL, 1),
(4, 'Mable', 'Flavie', 'Goyette', 'female', '27531 Reichel Locks ', '09910339748', 3, NULL, NULL, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `employee_type`
--
ALTER TABLE `employee_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
