-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 01, 2024 at 06:01 AM
-- Server version: 10.11.9-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u260856940_rfidsystem_db`
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
(25, 'Computer Studies Department', '#009ceb'),
(26, 'Engineering Department', '#940000'),
(27, 'Teacher Education Department', '#0006b8'),
(28, 'Business and Management Department', '#06a709'),
(29, 'Industrial Technology Department', '#b89000');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `sname` varchar(255) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cellnum` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `employee_type_id` int(11) DEFAULT NULL,
  `school_id` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `dept_id` int(11) NOT NULL,
  `rfid` varchar(255) DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0= active, 1=archived'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fname`, `mname`, `lname`, `sname`, `bdate`, `gender`, `address`, `cellnum`, `email`, `employee_type_id`, `school_id`, `role_id`, `dept_id`, `rfid`, `img_path`, `status`) VALUES
(2, 'Wilferd Jude', 'A', 'Perante', '', '1989-05-06', 'male', NULL, NULL, NULL, 3, 'PO6032013WJA', 1, 25, '2347684869', '1730295097Wilferd JudePerante.png', 0),
(3, 'Jamirah', 'L', 'Abdullah', '', '2002-03-19', 'female', NULL, NULL, NULL, 5, 'A081924JL', 1, 25, '2333456901', '1730256360JamirahAbdullah.png', 0),
(4, 'Sedrick Razeal', 'R', 'Arcenal', '', '2001-05-16', 'male', NULL, NULL, NULL, 5, 'A081924SRR', 1, 25, '2341876485', '1730256257Sedrick RazealArcenal.png', 0),
(5, 'Albern Nathaniel', 'C', 'Barbac', '', '2000-01-05', 'male', NULL, NULL, NULL, 1, 'B100124ANC', 1, 25, '2347709717', NULL, 0),
(6, 'Rose Belle', 'D', 'Esolana', '', '1995-04-28', 'female', NULL, NULL, NULL, 1, 'E020722RBD', 1, 25, '2337971733', '1730256107Rose BelleEsolana.png', 0),
(7, 'Joseph Jaymel', 'S', 'Morpos', '', '1975-02-20', 'male', NULL, NULL, NULL, 3, 'M071000JJS', 1, 25, '2348245253', NULL, 0),
(9, 'Angel', 'H', 'Lopez', '', '2001-11-23', 'female', NULL, NULL, NULL, 2, 'L1001224AH', 1, 25, '2334437381', NULL, 0);

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
-- Table structure for table `gen_reports`
--

CREATE TABLE `gen_reports` (
  `id` int(11) NOT NULL,
  `report_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gen_reports`
--

INSERT INTO `gen_reports` (`id`, `report_id`) VALUES
(1, '981876113'),
(2, '455864855'),
(3, '296743475'),
(4, '911179655'),
(5, '599167912'),
(6, '126798781'),
(7, '190827795'),
(8, '682427804'),
(9, '898188474'),
(10, '973561690'),
(11, '671730479'),
(12, '724142216'),
(13, '725517523'),
(14, '422401949'),
(15, '345632805'),
(16, '198975246');

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
(1, 1, ' has logged in', '2024-10-17 02:04:33'),
(2, 1, ' has logged out', '2024-10-17 02:06:23'),
(3, 1, ' has logged in', '2024-10-17 02:11:08'),
(4, 1, ' has logged out', '2024-10-17 02:12:40'),
(5, 3, ' has logged in', '2024-10-17 09:00:42'),
(6, 3, ' has logged in', '2024-10-17 09:15:46'),
(7, 3, ' has registered a new student Nancy Castillo', '2024-10-17 09:17:09'),
(8, 3, ' has registered a new student Jackylyn Miro', '2024-10-17 09:19:07'),
(9, 3, ' has registered a new student Sharon Rose Ballera', '2024-10-17 09:25:19'),
(10, 3, ' has logged out', '2024-10-17 09:32:49'),
(11, 1, ' has logged in', '2024-10-17 09:32:55'),
(12, 1, ' has registered a new student Johanna Nicole Bacalso', '2024-10-17 09:39:48'),
(13, 1, ' has registered a new student April Sheen Pinar', '2024-10-17 09:41:32'),
(14, 1, ' has registered a new student Daniela  Tabique', '2024-10-17 09:43:18'),
(15, 1, ' has registered a new student Ruelene  Labiste', '2024-10-17 09:45:44'),
(16, 1, ' has registered a new student Angelita Torres', '2024-10-17 09:53:32'),
(17, 1, ' has registered a new student Xyron Balasabas', '2024-10-17 10:00:22'),
(18, 1, ' has logged out', '2024-10-17 10:02:03'),
(19, 3, ' has logged in', '2024-10-17 10:02:11'),
(20, 3, ' has created the Business and Management Department in category', '2024-10-17 10:03:33'),
(21, 3, ' has registered a new student Izza Jhoy Ugbamin', '2024-10-17 10:07:05'),
(22, 3, ' has registered a new student Anjelyn Romo', '2024-10-17 10:14:46'),
(23, 3, ' has registered a new student Piolo Barcos', '2024-10-17 10:23:34'),
(24, 3, ' has registered a new student Angel Lyn Movilla', '2024-10-17 10:26:32'),
(25, 3, ' has registered a new student Cressiah Dacal', '2024-10-17 10:32:23'),
(26, 3, ' has updated the student information of Cressiah Dacal', '2024-10-17 10:32:45'),
(27, 3, ' has registered a new student John Brint Arañez', '2024-10-17 10:45:53'),
(28, 3, ' has registered a new student Princess Valerie Codilla', '2024-10-17 10:47:54'),
(29, 3, ' has logged out', '2024-10-17 10:58:14'),
(30, 1, ' has logged in', '2024-10-17 10:59:34'),
(31, 0, ' has registered a new student Mark Joseph  Humbid', '2024-10-17 11:05:04'),
(32, 1, ' has logged in', '2024-10-17 11:05:30'),
(33, 1, ' has registered a new student Rafael Malinao ', '2024-10-17 11:08:19'),
(34, 1, ' has registered a new student Bernard Glenn Casera', '2024-10-17 11:14:33'),
(35, 1, ' has registered a new student Joel Jr Cuavo', '2024-10-17 11:19:43'),
(36, 1, ' has registered a new student James Humphry Manilag', '2024-10-17 11:23:57'),
(37, 1, ' has registered a new student Angel Roldan', '2024-10-17 11:32:55'),
(38, 1, ' has registered a new student Ayegee Contridas', '2024-10-17 11:35:27'),
(39, 1, ' has created the Bachelor of Science in Civil Engineering program', '2024-10-17 11:41:42'),
(40, 1, ' has created the Bachelor of Science in Electronics Engineering program', '2024-10-17 11:42:06'),
(41, 1, ' has registered a new student Jury Mae Catingub', '2024-10-17 11:58:56'),
(42, 1, ' has registered a new student Lovely Jean Mabini', '2024-10-17 12:09:17'),
(43, 1, ' has registered a new student Haide Parilla', '2024-10-17 12:12:37'),
(44, 1, ' has logged in', '2024-10-17 16:06:27'),
(45, 1, ' has updated the account security personnel name SecurityPersonnel', '2024-10-17 16:17:06'),
(46, 1, ' has updated the account staff name StaffOffice', '2024-10-17 16:17:21'),
(47, 1, ' has updated the account admin name adminadmin', '2024-10-17 16:17:37'),
(48, 1, ' has updated the account admin name adminadmin', '2024-10-17 16:17:44'),
(49, 1, ' has logged out', '2024-10-17 16:20:10'),
(50, 1, ' has logged in', '2024-10-17 16:22:25'),
(51, 1, ' has updated the Business and Management Department in category', '2024-10-17 16:34:31'),
(52, 1, ' has updated the Teacher Education Department in category', '2024-10-17 16:34:41'),
(53, 1, ' has updated the Engineering Department in category', '2024-10-17 16:34:47'),
(54, 1, ' has created an account admin name John Mark Cuyos', '2024-10-17 16:38:34'),
(55, 1, ' has updated the account admin name adminadmin', '2024-10-17 16:39:13'),
(56, 1, ' has logged in', '2024-10-17 17:43:10'),
(57, 1, ' has logged out', '2024-10-17 17:57:47'),
(58, 1, ' has logged in', '2024-10-17 19:46:25'),
(59, 1, ' has updated the Computer Studies Department in category', '2024-10-17 19:47:22'),
(60, 1, ' has logged out', '2024-10-17 22:31:06'),
(61, 3, ' has logged in', '2024-10-17 22:31:18'),
(62, 3, ' has logged out', '2024-10-18 00:09:41'),
(63, 7, ' has logged in', '2024-10-18 00:11:49'),
(64, 7, ' has logged in', '2024-10-18 01:36:44'),
(65, 7, ' has updated the account admin name John Mark Cuyos', '2024-10-18 01:41:09'),
(66, 7, ' has logged out', '2024-10-18 01:43:30'),
(67, 1, ' has logged in', '2024-10-18 09:18:39'),
(68, 1, ' has registered a new student Johannes June Celedio', '2024-10-18 09:34:52'),
(69, 1, ' has registered a new student Queennie Escala', '2024-10-18 09:37:17'),
(70, 1, ' has registered a new student Jandy Arpon', '2024-10-18 09:39:42'),
(71, 1, ' has registered a new student Johnny Campomanes', '2024-10-18 09:49:45'),
(72, 1, ' has registered a new student Hezekiah Rebato', '2024-10-18 09:56:19'),
(73, 1, ' has registered a new student Shanny Flores', '2024-10-18 10:02:30'),
(74, 1, ' has registered a new student Ruby Tinunga', '2024-10-18 10:05:51'),
(75, 1, ' has registered a new student Monico Caoctoy', '2024-10-18 10:14:12'),
(76, 1, ' has registered a new student Almackie Andrew Bangalao', '2024-10-18 10:18:39'),
(77, 1, ' has registered a new student Justine Peter Ariño', '2024-10-18 10:23:35'),
(78, 1, ' has registered a new student Mark Joseph Talle', '2024-10-18 10:29:59'),
(79, 1, ' has registered a new student Marichelle Luistro', '2024-10-18 10:33:09'),
(80, 1, ' has updated the student information of Mark Gerald Talle', '2024-10-18 10:39:55'),
(81, 1, ' has registered a new student Jomarey Dacuyan', '2024-10-18 10:57:36'),
(82, 1, ' has registered a new student Christine Alolor', '2024-10-18 10:59:07'),
(83, 1, ' has logged in', '2024-10-18 11:02:28'),
(84, 1, ' has registered a new student Rizzamae Solis', '2024-10-18 11:02:47'),
(85, 1, ' has registered a new student John Lloyd Rivera', '2024-10-18 11:08:32'),
(86, 1, ' has registered a new student Jake Sergida', '2024-10-18 11:12:31'),
(87, 1, ' has registered a new student Reymark Costorio', '2024-10-18 11:23:20'),
(88, 1, ' has registered a new student Stephanie Angel Nudalo', '2024-10-18 11:28:02'),
(89, 1, ' has registered a new student Tinzo Charles Apuya', '2024-10-18 11:28:48'),
(90, 1, ' has registered a new student Reymart Magallanes', '2024-10-18 11:33:08'),
(91, 1, ' has registered a new student John Mark Cuyos', '2024-10-18 11:53:13'),
(92, 1, ' has registered a new student Loren Capuyan', '2024-10-18 11:53:51'),
(93, 1, ' has registered a new student Niño Boholst', '2024-10-18 11:57:30'),
(94, 1, ' has logged in', '2024-10-18 13:12:37'),
(95, 7, ' has logged in', '2024-10-18 16:28:31'),
(96, 1, ' has logged in', '2024-10-18 20:52:22'),
(97, 7, ' has logged in', '2024-10-18 22:54:00'),
(98, 7, ' has logged in', '2024-10-19 17:26:26'),
(99, 7, ' has logged in', '2024-10-19 18:15:33'),
(100, 7, ' has logged in', '2024-10-19 19:01:19'),
(101, 1, ' has logged in', '2024-10-20 06:18:32'),
(102, 1, ' has logged in', '2024-10-21 09:17:23'),
(103, 1, ' has registered a new student Edmon Flores', '2024-10-21 09:19:44'),
(104, 1, ' has registered a new student Jessamae Ugbamen', '2024-10-21 09:25:24'),
(105, 1, ' has registered a new student Jade Kenneth Pacañot', '2024-10-21 09:31:47'),
(106, 1, ' has registered a new student Christian Alain Apatt', '2024-10-21 09:43:17'),
(107, 1, ' has registered a new student Shane Del Moira Mantua', '2024-10-21 09:47:48'),
(108, 1, ' has registered a new student Dielu Bilas', '2024-10-21 09:53:11'),
(109, 1, ' has registered a new student Rovie Jhen Casimong', '2024-10-21 09:58:58'),
(110, 1, ' has registered a new student Cristine Jane Pagalan', '2024-10-21 10:10:44'),
(111, 1, ' has registered a new student Anne Sophia Silvano', '2024-10-21 10:12:30'),
(112, 1, ' has registered a new student Ritzmond Manzo', '2024-10-21 10:16:19'),
(113, 1, ' has registered a new student Mecaella Managbanag', '2024-10-21 10:29:26'),
(114, 1, ' has registered a new student Ivan Earl Ocampo', '2024-10-21 10:32:48'),
(115, 1, ' has registered a new student Jemaica Sicad', '2024-10-21 10:34:40'),
(116, 1, ' has registered a new student Rochelle Arabejo', '2024-10-21 10:46:44'),
(117, 1, ' has registered a new student Christian Rey Alegre', '2024-10-21 10:52:24'),
(118, 1, ' has registered a new student Perdito Parilla', '2024-10-21 11:04:56'),
(119, 1, ' has updated the student information of Pedrito Parilla', '2024-10-21 11:05:29'),
(120, 1, ' has registered a new student Ferly Ann Samson', '2024-10-21 11:07:13'),
(121, 1, ' has registered new employee Ariel Morilla', '2024-10-21 11:16:25'),
(122, 1, ' has registered a new student Russel Jhon Dasigan', '2024-10-21 11:21:33'),
(123, 1, ' has registered a new student Jelian Mae Morga', '2024-10-21 11:26:47'),
(124, 1, ' has registered a new student Klenth Joseph Cañedo', '2024-10-21 11:41:23'),
(125, 1, ' has registered a new student Paul Joseph Teves', '2024-10-21 11:43:41'),
(126, 7, ' has logged in', '2024-10-21 15:07:11'),
(127, 7, 'generate a report with the Reference ID of 470181588', '2024-10-21 15:15:57'),
(128, 7, 'generate a report with the Reference ID of 621136799', '2024-10-21 15:18:06'),
(129, 7, ' has logged in', '2024-10-21 16:49:11'),
(130, 3, ' has logged in', '2024-10-21 19:48:08'),
(131, 3, 'generate a report with the Reference ID of 235453879', '2024-10-21 19:48:44'),
(132, 3, ' has logged out', '2024-10-21 19:52:25'),
(133, 2, ' has logged in', '2024-10-21 19:52:41'),
(134, 7, 'generate a report with the Reference ID of 284443264', '2024-10-21 20:29:25'),
(135, 7, ' has logged out', '2024-10-21 21:00:06'),
(136, 7, ' has logged in', '2024-10-21 21:11:04'),
(137, 7, ' has logged out', '2024-10-21 21:21:48'),
(138, 1, ' has logged in', '2024-10-22 08:38:53'),
(139, 1, ' has registered a new student John Carlo Tijas', '2024-10-22 08:40:30'),
(140, 1, ' has registered a new student Jorge Mikhael Gubantes', '2024-10-22 08:44:20'),
(141, 1, ' has registered a new student Khim Arradaza', '2024-10-22 08:47:30'),
(142, 1, ' has registered a new student Aphrodite Payod', '2024-10-22 08:53:00'),
(143, 1, ' has registered a new student Trisha Mhay Lonzaga', '2024-10-22 08:58:12'),
(144, 7, ' has logged in', '2024-10-22 08:59:31'),
(145, 1, ' has registered a new student Nathalie Grace Poticar', '2024-10-22 09:03:23'),
(146, 1, ' has registered a new student Aj Myco Estor', '2024-10-22 09:05:25'),
(147, 7, ' has updated the student information of Nathalie Grace Poticar', '2024-10-22 09:06:32'),
(148, 1, ' has registered a new student Gishner Santianez', '2024-10-22 09:08:43'),
(149, 1, ' has registered a new student Uriel Dan Carlobos', '2024-10-22 09:16:28'),
(150, 1, ' has registered a new student Jenbert Duazo', '2024-10-22 09:24:09'),
(151, 1, ' has registered a new student Franzin Dalumpines', '2024-10-22 09:30:27'),
(152, 1, ' has registered a new student Rhenah May Cabudlay', '2024-10-22 09:36:00'),
(153, 7, ' has archived a student John Mark Cuyos', '2024-10-22 09:39:58'),
(154, 1, ' has registered a new student EarlJohn Sicsic', '2024-10-22 09:42:09'),
(155, 1, ' has registered a new student Aexel Peguera', '2024-10-22 09:45:49'),
(156, 7, ' has unarchived a student John Mark Cuyos', '2024-10-22 09:46:21'),
(157, 1, ' has registered a new student Irish Angel Galo', '2024-10-22 09:49:55'),
(158, 1, ' has registered a new student Leah Mae Tuburan', '2024-10-22 09:54:11'),
(159, 1, ' has registered a new student Tobby Aligway', '2024-10-22 09:57:38'),
(160, 1, ' has registered a new student Shanarya Elise Calub', '2024-10-22 10:04:32'),
(161, 7, 'generate a report with the Reference ID of 777071260', '2024-10-22 10:07:40'),
(162, 1, ' has registered a new student Khea Cyrielle Moral', '2024-10-22 10:09:00'),
(163, 1, ' has registered a new student Arvin Clark Bioc', '2024-10-22 10:11:37'),
(164, 1, ' has registered a new student Elsie Garciano', '2024-10-22 10:16:51'),
(165, 7, ' has logged out', '2024-10-22 10:17:54'),
(166, 2, ' has logged in', '2024-10-22 10:18:06'),
(167, 1, ' has registered a new student Ariane Jean Ocenar', '2024-10-22 10:22:08'),
(168, 1, ' has registered a new student Regine Pales', '2024-10-22 10:31:42'),
(169, 1, ' has registered a new student Ianna Jade Tilan', '2024-10-22 10:34:38'),
(170, 1, ' has registered a new student Reyna Mae Dolores', '2024-10-22 10:47:22'),
(171, 1, ' has registered a new student Ely Christian Bucasas', '2024-10-22 10:59:16'),
(172, 1, ' has registered a new student Antonio Jose Torrevillas', '2024-10-22 11:08:19'),
(173, 7, ' has logged in', '2024-10-22 16:41:38'),
(174, 7, ' has logged in', '2024-10-22 19:52:22'),
(175, 1, ' has logged in', '2024-10-23 07:37:36'),
(176, 1, ' has updated the student information of Shanny Flores', '2024-10-23 08:05:07'),
(177, 1, ' has updated the student information of Anjelyn Romo', '2024-10-23 08:07:21'),
(178, 1, ' has updated the student information of Dielu Bilas', '2024-10-23 08:14:42'),
(179, 1, ' has updated the student information of Piolo Barcos', '2024-10-23 08:17:09'),
(180, 1, ' has updated the student information of Johanna Nicole Bacalso', '2024-10-23 08:17:53'),
(181, 1, ' has updated the student information of Cressiah Dacal', '2024-10-23 08:21:05'),
(182, 1, ' has updated the student information of Paul Joseph Teves', '2024-10-23 08:22:49'),
(183, 1, ' has updated the student information of Jackylyn Miro', '2024-10-23 08:42:59'),
(184, 1, ' has updated the student information of Jessamae Ugbamen', '2024-10-23 08:50:57'),
(185, 1, ' has updated the student information of Reymart Magallanes', '2024-10-23 09:12:23'),
(186, 1, ' has logged in', '2024-10-23 14:25:40'),
(187, 7, ' has logged in', '2024-10-23 14:25:58'),
(188, 1, ' has updated the student information of Khim Arradaza', '2024-10-23 14:26:57'),
(189, 7, ' has logged in', '2024-10-23 19:24:58'),
(190, 7, ' has logged out', '2024-10-23 19:30:28'),
(191, 1, ' has logged in', '2024-10-24 10:15:26'),
(192, 1, ' has logged in', '2024-10-24 23:33:24'),
(193, 7, ' has logged in', '2024-10-25 09:49:53'),
(194, 1, ' has logged in', '2024-10-26 05:27:43'),
(195, 1, 'generate a report with the Reference ID of 193989708', '2024-10-26 05:28:01'),
(196, 1, 'generate a report with the Reference ID of 377992894', '2024-10-26 05:29:31'),
(197, 7, ' has logged in', '2024-10-26 09:16:12'),
(198, 7, ' has logged in', '2024-10-27 18:43:19'),
(199, 1, ' has logged in', '2024-10-27 20:02:37'),
(200, 1, ' has updated the student information of Anjelyn Romo', '2024-10-27 20:06:38'),
(201, 1, ' has updated the student information of Anjelyn Romo', '2024-10-27 20:06:50'),
(202, 1, ' has updated the student information of Elsie Garciano', '2024-10-27 20:10:19'),
(203, 1, ' has updated the student information of Jandy Arpon', '2024-10-27 20:12:15'),
(204, 1, ' has updated the student information of Cristine Jane Pagalan', '2024-10-27 20:14:08'),
(205, 1, ' has updated the student information of Aexel Peguera', '2024-10-27 20:15:56'),
(206, 1, ' has updated the student information of Gishner Santianez', '2024-10-27 20:18:01'),
(207, 1, ' has updated the student information of Leah Mae Tuburan', '2024-10-27 20:20:40'),
(208, 1, ' has logged out', '2024-10-27 20:24:00'),
(209, 1, ' has logged in', '2024-10-28 09:54:11'),
(210, 1, ' has updated the student information of Xyron Balasabas', '2024-10-28 10:43:27'),
(211, 1, ' has updated the student information of Ely Christian Bucasas', '2024-10-28 10:44:46'),
(212, 1, 'generate a report with the Reference ID of 329138257', '2024-10-28 10:48:34'),
(213, 1, ' has archived an employee Ariel Morilla', '2024-10-28 11:02:43'),
(214, 1, ' has unarchived an employee Ariel Morilla', '2024-10-28 11:03:04'),
(215, 1, 'generate a report with the Reference ID of 662920520', '2024-10-28 11:29:44'),
(216, 1, ' has logged in', '2024-10-28 12:35:41'),
(217, 1, ' has registered a new student Geraldine  Valenzona', '2024-10-28 12:50:19'),
(218, 1, ' has registered a new student Johnny Andrew Teleron', '2024-10-28 12:55:27'),
(219, 1, ' has registered a new student Bezaleel  Degillo', '2024-10-28 12:57:12'),
(220, 1, ' has registered a new student John Paul  Vasquez', '2024-10-28 13:00:52'),
(221, 1, ' has registered a new student Randy Endolos', '2024-10-28 13:10:43'),
(222, 1, ' has registered a new student Shamie Jean Maaghop', '2024-10-28 13:57:05'),
(223, 7, ' has logged in', '2024-10-28 15:16:35'),
(224, 7, ' has logged in', '2024-10-28 15:18:10'),
(225, 7, 'generate a report with the Reference ID of 981876113', '2024-10-28 15:22:34'),
(226, 7, 'generate a report with the Reference ID of 455864855', '2024-10-28 15:22:46'),
(227, 7, 'generate a report with the Reference ID of 296743475', '2024-10-28 15:23:13'),
(228, 7, 'generate a report with the Reference ID of 911179655', '2024-10-28 15:23:51'),
(229, 7, 'generate a report with the Reference ID of 599167912', '2024-10-28 15:24:03'),
(230, 7, 'generate a report with the Reference ID of 126798781', '2024-10-28 15:24:16'),
(231, 7, 'generate a report with the Reference ID of 190827795', '2024-10-28 15:24:35'),
(232, 7, 'generate a report with the Reference ID of 682427804', '2024-10-28 17:14:41'),
(233, 7, ' has updated the employee information of Ariel Morilla', '2024-10-28 17:25:54'),
(234, 7, ' has logged out', '2024-10-28 17:53:21'),
(235, 7, ' has logged in', '2024-10-28 17:53:49'),
(236, 7, ' has logged out', '2024-10-28 17:53:56'),
(237, 7, ' has logged in', '2024-10-28 18:01:52'),
(238, 7, 'generate a report with the Reference ID of 898188474', '2024-10-28 18:04:29'),
(239, 7, 'generate a report with the Reference ID of 973561690', '2024-10-28 18:05:45'),
(240, 7, ' has logged out', '2024-10-28 18:08:39'),
(241, 1, ' has logged in', '2024-10-28 18:18:17'),
(242, 1, ' has updated the student information of Geraldine  Valenzona', '2024-10-28 18:19:50'),
(243, 1, ' has updated the student information of Jelian Mae Morga', '2024-10-28 18:20:34'),
(244, 7, ' has logged in', '2024-10-29 08:50:36'),
(245, 7, 'generate a report with the Reference ID of 671730479', '2024-10-29 08:57:08'),
(246, 7, ' has logged out', '2024-10-29 08:57:18'),
(247, 1, ' has logged in', '2024-10-29 09:49:06'),
(248, 1, 'generate a report with the Reference ID of 724142216', '2024-10-29 09:50:01'),
(249, 1, 'generate a report with the Reference ID of 725517523', '2024-10-29 09:51:07'),
(250, 1, 'generate a report with the Reference ID of 422401949', '2024-10-29 09:51:53'),
(251, 1, ' has registered a new student Gian  Racile Corilla', '2024-10-29 10:33:06'),
(252, 1, ' has registered a new student Richard Jhon Maraasin', '2024-10-29 10:40:32'),
(253, 1, ' has registered a new student Jerson Jr Donasco', '2024-10-29 10:43:55'),
(254, 1, ' has logged out', '2024-10-29 10:46:46'),
(255, 2, ' has logged in', '2024-10-29 10:46:58'),
(256, 2, ' has logged out', '2024-10-29 10:49:19'),
(257, 1, ' has logged in', '2024-10-29 10:49:29'),
(258, 1, ' has registered a new student Christopher Samuel Abadiano', '2024-10-29 11:00:37'),
(259, 1, ' has registered a new student Samantha  Salvar', '2024-10-29 11:06:04'),
(260, 1, ' has registered a new student Princess  Elisan', '2024-10-29 11:10:59'),
(261, 1, 'generate a report with the Reference ID of 345632805', '2024-10-29 11:20:39'),
(262, 1, ' has registered a new student John Kent Canales', '2024-10-29 11:27:31'),
(263, 1, ' has logged in', '2024-10-29 11:58:09'),
(264, 1, ' has registered a new student Jonas Redfz Abejar', '2024-10-29 12:40:00'),
(265, 1, ' has registered a new student Rachel Carrillo', '2024-10-29 12:47:43'),
(266, 7, ' has logged in', '2024-10-29 20:01:40'),
(267, 1, ' has logged in', '2024-10-29 20:29:20'),
(268, 1, ' has updated the student information of Trisha Mhay Lonzaga', '2024-10-29 20:52:04'),
(269, 1, ' has updated the student information of Daniela  Tabique', '2024-10-29 20:52:50'),
(270, 1, ' has updated the student information of Jonas Redfz Abejar', '2024-10-29 20:53:49'),
(271, 1, ' has updated the student information of April Sheen Pinar', '2024-10-29 20:54:32'),
(272, 1, ' has updated the student information of Rhenah May Cabudlay', '2024-10-29 20:55:25'),
(273, 1, ' has updated the student information of Angelita Torres', '2024-10-29 20:57:29'),
(274, 1, ' has updated the student information of Christian Alain Apatt', '2024-10-29 20:58:17'),
(275, 1, ' has updated the student information of Jenbert Duazo', '2024-10-29 20:59:26'),
(276, 1, ' has updated the student information of Bezaleel  Degillo', '2024-10-29 21:00:28'),
(277, 1, ' has updated the student information of Johnny Andrew Teleron', '2024-10-29 21:02:46'),
(278, 7, ' has updated the student information of John Mark Cuyos', '2024-10-29 21:14:26'),
(279, 7, ' has updated the account staff name Staff Office', '2024-10-29 21:54:15'),
(280, 7, ' has updated the account staff name Staff Office', '2024-10-29 21:54:26'),
(281, 7, ' has updated the account admin name John Mark Cuyos', '2024-10-29 21:54:48'),
(282, 7, ' has updated the account staff name Staff Office', '2024-10-29 21:55:25'),
(283, 7, ' has archived the account 2 name Staff Office', '2024-10-29 22:17:10'),
(284, 7, ' has unarchived the account 2 name Staff Office', '2024-10-29 22:17:21'),
(285, 7, ' has logged out', '2024-10-29 22:18:28'),
(286, 7, ' has logged in', '2024-10-29 22:23:03'),
(287, 7, ' has archived a student John Mark Cuyos', '2024-10-29 22:38:03'),
(288, 7, ' has unarchived a student John Mark Cuyos', '2024-10-29 22:38:14'),
(289, 7, ' has updated the student information of John Mark Cuyos', '2024-10-29 22:38:28'),
(290, 7, ' has archived a student John Mark Cuyos', '2024-10-29 22:38:43'),
(291, 7, ' has archived an employee Ariel Morilla', '2024-10-29 22:39:15'),
(292, 7, ' has unarchived an employee Ariel Morilla', '2024-10-29 22:39:43'),
(293, 7, ' has unarchived a student John Mark Cuyos', '2024-10-29 22:39:49'),
(294, 7, ' has updated the student information of John Mark Cuyos', '2024-10-29 22:40:02'),
(295, 7, ' has logged out', '2024-10-29 22:40:37'),
(296, 3, ' has logged in', '2024-10-29 22:40:48'),
(297, 3, ' has logged out', '2024-10-29 22:42:31'),
(298, 1, ' has logged in', '2024-10-29 23:19:44'),
(299, 2, ' has logged in', '2024-10-30 08:31:25'),
(300, 2, ' has logged out', '2024-10-30 08:32:03'),
(301, 7, ' has logged in', '2024-10-30 08:32:19'),
(302, 1, ' has logged in', '2024-10-30 09:35:12'),
(303, 1, ' has registered new employee Wilferd Jude Perante', '2024-10-30 09:39:56'),
(304, 1, ' has updated the employee information of Wilferd Jude Perante', '2024-10-30 09:47:33'),
(305, 1, ' has updated the student information of Jackylyn Miro', '2024-10-30 09:50:15'),
(306, 1, ' has registered new employee Jamirah Abdullah', '2024-10-30 10:09:13'),
(307, 1, ' has registered new employee Sedrick Razeal Arcenal', '2024-10-30 10:10:21'),
(308, 1, ' has registered new employee Albern Nathaniel Barbac', '2024-10-30 10:13:33'),
(309, 1, ' has registered new employee Rose Belle Esolana', '2024-10-30 10:21:06'),
(310, 1, ' has created the Industrial Technology Department in category', '2024-10-30 10:29:42'),
(311, 1, ' has updated the employee information of Rose Belle Esolana', '2024-10-30 10:41:47'),
(312, 1, ' has updated the employee information of Sedrick Razeal Arcenal', '2024-10-30 10:44:17'),
(313, 1, ' has updated the employee information of Jamirah Abdullah', '2024-10-30 10:46:00'),
(314, 1, ' has logged in', '2024-10-30 19:44:59'),
(315, 1, ' has updated the employee information of Wilferd Jude Perante', '2024-10-30 21:31:37'),
(316, 1, ' has updated the employee information of Wilferd Jude Perante', '2024-10-31 00:40:41'),
(317, 1, ' has updated the employee information of Rose Belle Esolana', '2024-10-31 00:40:56'),
(318, 1, ' has updated the employee information of Albern Nathaniel Barbac', '2024-10-31 00:41:19'),
(319, 1, ' has updated the employee information of Sedrick Razeal Arcenal', '2024-10-31 00:41:29'),
(320, 1, ' has updated the employee information of Jamirah Abdullah', '2024-10-31 00:41:37'),
(321, 1, ' has updated the employee information of Ariel Morilla', '2024-10-31 00:41:49'),
(322, 1, ' has updated the Industrial Technology Department in category', '2024-10-31 00:42:55'),
(323, 1, 'generate a report with the Reference ID of 198975246', '2024-10-31 00:44:30'),
(324, 1, ' has logged out', '2024-10-31 01:26:38'),
(325, 1, ' has registered new employee Joseph Jaymel Morpos', '2024-10-31 09:07:01'),
(326, 1, ' has registered new employee Angel Lopez', '2024-10-31 09:33:57'),
(327, 1, ' has registered new employee Angel Lopez', '2024-10-31 09:33:57'),
(328, 1, ' has registered new vendor Glenda Gariando', '2024-10-31 10:36:36'),
(329, 1, ' has registered new vendor Joseph Gariando', '2024-10-31 10:39:37'),
(330, 1, ' has logged out', '2024-10-31 10:53:51'),
(331, 1, ' has logged in', '2024-10-31 10:54:20'),
(332, 1, ' has updated the employee information of Joseph Jaymel Morpos', '2024-10-31 10:54:54'),
(333, 1, ' has updated the employee information of Angel Lopez', '2024-10-31 10:57:20'),
(334, 1, ' has registered new vendor Marika Villena', '2024-10-31 11:01:55'),
(335, 1, ' has registered new vendor Imelda Bermejo', '2024-10-31 11:07:18'),
(336, 1, ' has archived an employee Ariel Morilla', '2024-10-31 11:11:23'),
(337, 1, ' has registered new vendor Celerine Merequillo', '2024-10-31 11:14:12'),
(338, 1, ' has logged in', '2024-10-31 23:25:33'),
(339, 1, ' has updated the account admin name admin admin', '2024-10-31 23:25:52'),
(340, 1, ' has archived a vendor Celerine Merequillo', '2024-10-31 23:29:27'),
(341, 1, ' has unarchived a vendor Celerine Merequillo', '2024-10-31 23:29:40');

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
(20, 25, 'Bachelor of Science in Information Technology'),
(21, 26, 'Bachelor of Science in Mechanical Engineering'),
(22, 25, 'Bachelor of Science in Industrial Engineering'),
(23, 26, 'Bachelor of Science in Civil Engineering'),
(24, 26, 'Bachelor of Science in Electronics Engineering');

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
(1, 77, 'student', '2024-10-22', '09:06:18', '09:06:38'),
(2, 82, 'student', '2024-10-22', '09:06:59', '09:07:15'),
(3, 77, 'student', '2024-10-22', '09:27:06', '09:27:11'),
(4, 77, 'student', '2024-10-22', '09:27:36', NULL),
(5, 52, 'student', '2024-10-22', '09:34:05', '09:35:47'),
(6, 82, 'student', '2024-10-22', '09:35:54', NULL),
(7, 52, 'student', '2024-10-22', '09:39:42', '10:04:32'),
(8, 102, 'student', '2024-10-22', '11:00:16', '11:00:21'),
(9, 82, 'student', '2024-10-23', '08:15:16', NULL),
(10, 82, 'student', '2024-10-23', '08:15:56', NULL),
(11, 52, 'student', '2024-10-28', '10:14:30', '10:28:17'),
(12, 82, 'student', '2024-10-28', '10:14:42', '10:28:29'),
(13, 52, 'student', '2024-10-28', '15:18:41', '15:18:47'),
(14, 52, 'student', '2024-10-28', '15:20:56', '17:12:55'),
(15, 1, 'employee', '2024-10-28', '17:26:11', '17:26:36'),
(16, 1, 'employee', '2024-10-29', '08:50:58', '08:55:15'),
(17, 75, 'student', '2024-10-29', '10:41:56', NULL),
(18, 52, 'student', '2024-10-29', '10:42:05', '11:54:58'),
(19, 75, 'student', '2024-10-29', '10:42:12', NULL),
(20, 113, 'student', '2024-10-29', '10:45:36', NULL),
(21, 75, 'student', '2024-10-29', '10:46:31', NULL),
(22, 75, 'student', '2024-10-29', '10:49:00', NULL),
(23, 70, 'student', '2024-10-29', '10:51:58', NULL),
(24, 70, 'student', '2024-10-29', '11:00:50', NULL),
(25, 52, 'student', '2024-10-29', '11:04:31', '11:54:58'),
(26, 115, 'student', '2024-10-29', '11:06:11', NULL),
(27, 39, 'student', '2024-10-29', '11:24:35', '12:02:37'),
(28, 82, 'student', '2024-10-29', '11:25:38', '00:00:00'),
(29, 117, 'student', '2024-10-29', '11:27:47', '12:02:41'),
(30, 117, 'student', '2024-10-29', '11:27:57', '12:02:41'),
(31, 39, 'student', '2024-10-29', '11:28:09', '12:02:37'),
(32, 82, 'student', '2024-10-29', '11:28:27', '11:28:37'),
(33, 82, 'student', '2024-10-29', '11:28:53', '11:58:53'),
(34, 82, 'student', '2024-10-29', '11:28:56', '11:58:53'),
(35, 82, 'student', '2024-10-29', '11:28:59', '11:58:53'),
(36, 52, 'student', '2024-10-29', '11:56:45', '11:57:03'),
(37, 82, 'student', '2024-10-29', '12:00:17', NULL),
(38, 39, 'student', '2024-10-29', '12:02:47', '12:03:41'),
(39, 117, 'student', '2024-10-29', '12:03:16', NULL),
(40, 39, 'student', '2024-10-29', '12:03:48', '12:04:43'),
(41, 39, 'student', '2024-10-29', '12:05:02', NULL),
(42, 71, 'student', '2024-10-29', '12:05:24', NULL),
(43, 52, 'student', '2024-10-29', '12:43:17', '12:50:55'),
(44, 52, 'student', '2024-10-29', '20:50:22', '21:13:49'),
(45, 1, 'employee', '2024-10-29', '20:59:39', '21:16:16'),
(46, 52, 'student', '2024-10-29', '21:14:47', '21:15:05'),
(47, 52, 'student', '2024-10-29', '21:30:02', '21:30:16'),
(48, 1, 'employee', '2024-10-30', '08:32:44', '08:32:51'),
(49, 52, 'student', '2024-10-30', '10:25:12', '10:25:35'),
(50, 52, 'student', '2024-10-30', '10:25:39', NULL),
(51, 1, 'employee', '2024-10-31', '00:45:23', '00:45:41');

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
(1, 'Employee'),
(2, 'Student'),
(4, 'Vendor'),
(3, 'Visitor');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `mode` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `mode`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `sname` varchar(255) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cellnum` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
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

INSERT INTO `students` (`id`, `fname`, `mname`, `lname`, `sname`, `bdate`, `gender`, `address`, `cellnum`, `email`, `school_id`, `role_id`, `prog_id`, `dept_id`, `rfid`, `img_path`, `status`) VALUES
(1, 'Nancy', 'G', 'Castillo', NULL, '1994-08-04', 'female', 'Curva Ormoc City', '09927832788', NULL, '2020-31580', 2, 20, 25, '2345964309', NULL, 0),
(2, 'Jackylyn', 'C', 'Miro', 'JR.', '2005-10-27', 'female', 'Brgy. Liloan-an Ormoc City', '09944581995', NULL, '2024-30352', 2, 20, 25, '2334053381', '1729644179JackylynMiro.png', 0),
(3, 'Sharon Rose', 'B', 'Ballera', NULL, '2006-04-30', 'female', 'Albuera, Leyte', '09387308058', NULL, '2024-30450', 2, 20, 25, '2334003989', NULL, 0),
(4, 'Johanna Nicole', 'C', 'Bacalso', '', '2005-11-10', 'female', 'Brgy. Don Felipe Larrazabal', '09650565877', NULL, '2024-30474', 2, 20, 25, '2344430613', '1729642673Johanna NicoleBacalso.png', 0),
(5, 'April Sheen', 'P', 'Pinar', '', '2003-04-12', 'female', 'Libertad, Isabel', '09513664440', NULL, '2022-31453', 2, 20, 25, '2332673301', '1730206472April SheenPinar.png', 0),
(6, 'Daniela ', 'B', 'Tabique', '', '2003-11-11', 'female', 'Brgy. Sant Antonio, Ormoc City', '09709957836', NULL, '2022-30781', 2, 20, 25, '2332175365', '1730206370Daniela Tabique.png', 0),
(7, 'Ruelene ', 'M', 'Labiste', NULL, '2004-04-20', 'female', 'Brgy. Margen, Ormoc City', '09654278124', NULL, '2022-31481', 2, 20, 25, '2335024917', NULL, 0),
(8, 'Angelita', 'L', 'Torres', '', '2001-01-28', 'female', 'Brgy. San Antonio, Ormoc City', '09659448912', NULL, '2022-30731', 2, 20, 25, '2344116245', '1730206649AngelitaTorres.png', 0),
(9, 'Xyron', 'J', 'Balasabas', '', '2005-05-12', 'male', 'Brgy. San Antonio, Ormoc City', '09567323587', NULL, '2023-33259', 2, 20, 25, '2341931797', '1730083407XyronBalasabas.png', 0),
(10, 'Izza Jhoy', 'G', 'Ugbamin', NULL, '2004-09-30', 'female', 'Brgy. San Antonio', '09466593482', NULL, '2022-32552', 2, 20, 25, '2332905749', NULL, 0),
(11, 'Anjelyn', 'G', 'Romo', '', '2003-07-15', 'female', 'Bgry. San Vicente, Ormoc City', '09950288855', NULL, '2021-30948', 2, 20, 25, '2332322325', '1729642041AnjelynRomo.png', 0),
(12, 'Piolo', 'O', 'Barcos', '', '2003-02-03', 'male', 'Brgy. Cabintan, Ormoc City', '09853335504', NULL, '2021-30464', 2, 20, 25, '2348073749', '1729642629PioloBarcos.png', 0),
(13, 'Angel Lyn', 'M', 'Movilla', NULL, '2003-10-20', 'female', 'Brgy. Salvacion, Ormoc City', '09944808350', NULL, '2022-32332', 2, 20, 25, '2337442325', NULL, 0),
(15, 'Cressiah', 'M', 'Dacal', '', '2002-09-23', 'female', 'Tabgas, Albuera, Leyte', '09174545872', NULL, '2021-30163', 2, 20, 25, '2333230357', '1729642865CressiahDacal.png', 0),
(16, 'John Brint', 'L', 'Arañez', NULL, '2001-06-28', 'male', 'Villaba, Leyte', '09154897112', NULL, '2021-32193', 2, 20, 25, '2332723205', NULL, 0),
(17, 'Princess Valerie', 'A', 'Codilla', NULL, '2004-09-25', 'female', 'Kanangga, Leyte', '09057169711', NULL, '2022-31268', 2, 20, 25, '2346622741', NULL, 0),
(18, 'Mark Joseph ', '', 'Humbid', NULL, '2004-04-24', 'male', 'Linao, Ormoc City', '09681192186', NULL, '2022-30927', 2, 20, 25, '2346484245', NULL, 0),
(19, 'Rafael', 'B', 'Malinao ', NULL, '1992-07-25', 'male', 'Brgy. Sabang Bao, Ormoc City', '09350536592', NULL, '2009-40346', 2, 20, 25, '2342415381', NULL, 0),
(20, 'Bernard Glenn', 'B', 'Casera', NULL, '2004-07-21', 'male', 'Albuera, Leyte', '09533505871', NULL, '2022-31167', 2, 20, 25, '2338478357', NULL, 0),
(22, 'Joel Jr', 'C', 'Cuavo', NULL, '2004-03-28', 'male', 'Brgy. Curva , Ormoc City', '0992684408', NULL, '2022-30894', 2, 20, 25, '2344845317', NULL, 0),
(23, 'James Humphry', 'B', 'Manilag', NULL, '2004-04-06', 'male', 'Brgy. Alta Vista, Ormoc City', '09218018870', NULL, '2022-30107', 2, 20, 25, '2333264405', NULL, 0),
(24, 'Angel', 'B', 'Roldan', NULL, '2001-01-20', 'female', 'Brgy. Milagro, Ormoc City ', '09772687247', NULL, '2022-31382', 2, 20, 25, '2344824581', NULL, 0),
(25, 'Ayegee', 'M', 'Contridas', NULL, '2004-07-02', 'female', 'Brgy. North, Ormoc City', '09632668829', NULL, '2022-31312', 2, 20, 25, '2345072901', NULL, 0),
(26, 'Jury Mae', '', 'Catingub', NULL, '2003-07-08', 'female', 'Brgy. Sto. Niño, Ormoc City', '09273511128', NULL, '2022-30961', 2, 20, 25, '2341410325', NULL, 0),
(27, 'Lovely Jean', 'M', 'Mabini', NULL, '2003-10-12', 'female', 'Villaba, Leyte', '09631152066', NULL, '2022-30256', 2, 20, 25, '2340210949', NULL, 0),
(28, 'Haide', 'M', 'Parilla', NULL, '2000-07-07', 'female', 'Brgy. Gaas, ormoc City', '09096580217', NULL, '2022-33146', 2, 20, 25, '2340116501', NULL, 0),
(29, 'Johannes June', 'B', 'Celedio', '', '2002-06-30', 'male', 'Albuera, Leyte', '09983454974', NULL, '2020-32805', 2, 20, 25, '2336901397', NULL, 0),
(30, 'Queennie', 'E', 'Escala', '', '1992-09-06', 'female', 'Brgy. East, Ormoc City', '09604438060', NULL, '2021-40001', 2, 20, 25, '2346476549', NULL, 0),
(31, 'Jandy', 'S', 'Arpon', '', '2003-02-09', 'male', 'Brgy. Alta Vista, Ormoc City', '09690195230', NULL, '2021-31484', 2, 20, 25, '2348503045', '1730031135JandyArpon.png', 0),
(32, 'Johnny', 'T', 'Campomanes', '', '2002-10-26', 'male', 'Brgy. Dayhagan, Ormoc City', '09651568658', NULL, '2021-31053', 2, 20, 25, '2336451349', NULL, 0),
(33, 'Hezekiah', 'B', 'Rebato', '', '2001-03-24', 'female', 'Purok 2, Sto. Niño, Ormoc City', '0992759428', NULL, '2021-32299', 2, 20, 25, '2338377221', NULL, 0),
(34, 'Shanny', 'C', 'Flores', '', '2002-09-26', 'female', 'Brgy. Camp Downs, Ormoc City', '09654065889', NULL, '2021-30331', 2, 20, 25, '2341515285', '1729641907ShannyFlores.png', 0),
(35, 'Ruby', 'T', 'Tinunga', '', '1996-07-23', 'female', 'Maybog Baybay CIty', '09056863072', NULL, '2022-30222', 2, 20, 25, '2348504069', NULL, 0),
(37, 'Monico', 'D', 'Caoctoy', 'Jr.', '2001-12-27', 'male', 'San Jose, Ormoc City', '09563793843', NULL, '2021-31865', 2, 20, 25, '2340853269', NULL, 0),
(38, 'Almackie Andrew', 'J', 'Bangalao', '', '2003-10-27', 'male', 'Albuera, Leyte', '09677017482', NULL, '2022-30424', 2, 20, 25, '2332391685', NULL, 0),
(39, 'Justine Peter', '', 'Ariño', '', '2002-06-23', 'male', 'Merida, Leyte', '09216564288', NULL, '2021-31409', 2, 20, 25, '2343008005', NULL, 0),
(40, 'Mark Gerald', 'C', 'Talle', '', '2001-03-18', 'male', 'Brgy. Cogon, Ormoc City', '09947115032', NULL, '2021-32394', 2, 20, 25, '2343134981', NULL, 0),
(41, 'Marichelle', 'P', 'Luistro', '', '2002-03-27', 'female', 'Brgy. Linao, Ormoc City', '09105236545', NULL, '2020-30901', 2, 20, 25, '2335923477', NULL, 0),
(42, 'Jomarey', 'Z', 'Dacuyan', '', '2001-03-22', 'male', 'Brgy. Cogon, Ormoc City', '09095395716', NULL, '2020-31685', 2, 20, 25, '2344757269', NULL, 0),
(43, 'Christine', 'B', 'Alolor', '', '2002-10-26', 'female', 'Albuera, Leyte', '09050299815', NULL, '2021-31083', 2, 20, 25, '2340037141', NULL, 0),
(45, 'Rizzamae', 'A', 'Solis', '', '2003-01-21', 'female', 'Brgy. Sto Niño, Ormoc City', '09630746832', NULL, '2021-31743', 2, 20, 25, '2342418693', NULL, 0),
(46, 'John Lloyd', 'D', 'Rivera', '', '2003-11-23', 'male', 'Brgy.Luna Ormoc City', '09924837263', NULL, '2023-31502', 2, 20, 25, '2344202245', NULL, 0),
(47, 'Jake', 'D', 'Sergida', '', '2000-12-29', 'male', 'Brgy. Naungan, Ormoc City', '09514646369', NULL, '2019-31611', 2, 20, 25, '2341382661', NULL, 0),
(48, 'Reymark', 'O', 'Costorio', '', '1996-10-05', 'male', 'Cagbuhangin, Ormoc City', '09518514704', NULL, '2020-31608', 2, 20, 25, '2336532229', NULL, 0),
(49, 'Stephanie Angel', 'A', 'Nudalo', '', '2004-10-30', 'female', 'Brgy. Matica-a, Ormoc City', '09661653048', NULL, '2022-31997', 2, 20, 25, '2336243973', NULL, 0),
(50, 'Tinzo Charles', 'V', 'Apuya', '', '2003-09-30', 'male', 'Brgy.Patag Ormoc City', '09927826207', NULL, '2022-31913', 2, 20, 25, '2341780245', NULL, 0),
(51, 'Reymart', 'T', 'Magallanes', '', '2002-05-16', 'male', 'Brgy. Salvacion, Ormoc City', '09774584746', NULL, '2021-31804', 2, 20, 25, '2342043653', '1729645943ReymartMagallanes.png', 0),
(52, 'John Mark', '', 'Cuyos', '', '2000-07-17', 'male', 'Albuera, Leyte', '09751407146', NULL, '2021-30174', 2, 20, 25, '2333056533', '1729223593John MarkCuyos.png', 0),
(53, 'Loren', '', 'Capuyan', '', '2003-10-07', 'male', 'World Vision Linao Ormoc City', '09505884231', NULL, '2022-31888', 2, 20, 25, '2342046469', NULL, 0),
(54, 'Niño', 'M', 'Boholst', '', '2004-01-09', 'male', 'Tambulilid, Ormoc City', '09120877665', NULL, '2022-31138', 2, 20, 25, '2342046485', NULL, 0),
(55, 'Edmon', 'C', 'Flores', '', '2001-09-26', 'male', 'Brgy. Kadaohan, Ormoc City', '09125104834', NULL, '2022-30471', 2, 20, 25, '2343159829', NULL, 0),
(56, 'Jessamae', 'P', 'Ugbamen', '', '2002-04-21', 'female', 'Brgy. San Antonio, Ormoc City', '09774515694', NULL, '2020-30492', 2, 20, 25, '2346932501', '1729644657JessamaeUgbamen.png', 0),
(57, 'Jade Kenneth', 'M', 'Pacañot', '', '2002-11-27', 'male', 'Brgy. Luna. Ormoc City', '09706812007', NULL, '2023-33280', 2, 20, 25, '2338309637', NULL, 0),
(59, 'Christian Alain', 'L', 'Apatt', '', '2003-12-19', 'male', 'Brgy. Dolores, Ormoc City', '09267137747', NULL, '2022-32193', 2, 20, 25, '23349458132334945813', '1730206697Christian AlainApatt.png', 0),
(60, 'Shane Del Moira', 'S', 'Mantua', '', '2005-02-14', 'female', 'Baybay City, Leyte', '09603060875', NULL, '2023-30495', 2, 20, 25, '2345474069', NULL, 0),
(61, 'Dielu', 'M', 'Bilas', '', '2002-09-25', 'male', 'Brgy. Salvacion, Ormoc City', '09937604658', NULL, '2021-31426', 2, 20, 25, '2341449749', '1729642482DieluBilas.png', 0),
(62, 'Rovie Jhen', 'S', 'Casimong', '', '2006-08-22', 'female', 'Brgy. Catmon, ormoc City', '09272485348', NULL, '2024-10936', 2, 20, 25, '2340505365', NULL, 0),
(63, 'Cristine Jane', 'S', 'Pagalan', '', '2002-10-02', 'female', 'Isabel, Leyte', '09563594366', NULL, '2020-32662', 2, 20, 25, '2338051589', '1730031248Cristine JanePagalan.png', 0),
(64, 'Anne Sophia', 'L', 'Silvano', '', '2003-11-20', 'female', 'Albuera, Leyte', '09512457313', NULL, '2022-31097', 2, 20, 25, '2338652437', NULL, 0),
(65, 'Ritzmond', 'E', 'Manzo', '', '1997-01-18', 'male', 'Brgy. Tambulilid, ormoc City', '09456847868', NULL, '2022-32564', 2, 20, 25, '2344800005', NULL, 0),
(66, 'Mecaella', 'R', 'Managbanag', '', '2004-03-15', 'female', 'San Isidro Owak, Ormoc City', '09568872443', NULL, '2022-30155', 2, 20, 25, '2345454869', NULL, 0),
(67, 'Ivan Earl', 'N', 'Ocampo', '', '2003-09-11', 'male', 'Don Felipe Larrazabal, Ormoc City', '09164825116', NULL, '2022-31973', 2, 20, 25, '2342028821', NULL, 0),
(68, 'Jemaica', 'C', 'Sicad', '', '2005-04-12', 'female', 'Brgy. Rizal, Kananga, Leyte', '09552194473', NULL, '2023-30416', 2, 20, 25, '2344505365', NULL, 0),
(69, 'Rochelle', 'A', 'Arabejo', '', '2003-10-05', 'female', 'Brgy. Tambulilid, Ormoc City', '09635660415', NULL, '2022-30967', 2, 20, 25, '2338694149', NULL, 0),
(70, 'Christian Rey', 'Y', 'Alegre', '', '2003-03-09', 'male', 'Brgy. San Isidro Owak, Ormoc City', '09918431792', NULL, '2022-32745', 2, 20, 25, '2340705557', NULL, 0),
(71, 'Pedrito', 'M', 'Parilla', 'III', '2000-05-25', 'male', 'Agua Dulce Street, Ormoc City', '09382152553', NULL, '2022-30600', 2, 20, 25, '2333866501', NULL, 0),
(72, 'Ferly Ann', 'A', 'Samson', '', '2004-02-18', 'female', 'Brgy. Linao, Ormoc City', '09317609172', NULL, '2022-30670', 2, 20, 25, '2343871253', NULL, 0),
(73, 'Russel Jhon', 'C', 'Dasigan', '', '2002-10-04', 'male', 'Brgy. aguiting, Kanangga Leyte', '09709260570', NULL, '2020-30041', 2, 20, 25, '2342974725', NULL, 0),
(74, 'Jelian Mae', 'T', 'Morga', '', '2003-12-04', 'female', 'Kanangga, Leyte', '09512543531', NULL, '2022-32273', 2, 20, 25, '2341117973', '1730110834Jelian MaeMorga.png', 0),
(75, 'Klenth Joseph', 'D', 'Cañedo', '', '2004-09-08', 'male', 'Brgy. Manlilinao, Ormoc City', '09951623', NULL, '2022-31872', 2, 20, 25, '2332317701', NULL, 0),
(76, 'Paul Joseph', 'M', 'Teves', '', '2005-11-11', 'male', 'Brgy. Nasunugan, Ormoc City', '09667463862', NULL, '2024-30057', 2, 20, 25, '2333376773', '1729642969Paul JosephTeves.png', 0),
(77, 'John Carlo', 'C', 'Tijas', '', '2002-02-24', 'male', 'Brgy.Gaas Ormoc City', '09099562048', NULL, '2021-30132', 2, 20, 25, '2342731013', NULL, 0),
(78, 'Jorge Mikhael', 'R', 'Gubantes', '', '2004-09-27', 'male', 'Pob.Albuera Leyte', '09278859285', NULL, '2023-30930', 2, 20, 25, '2343642133', NULL, 0),
(79, 'Khim', 'D', 'Arradaza', '', '1997-12-19', 'male', 'Brgy.San Vicente Ormoc City', '09534767061', NULL, '2014-40013', 2, 20, 25, '2346369541', '1729664817KhimArradaza.png', 0),
(80, 'Aphrodite', 'C', 'Payod', '', '2002-12-13', 'female', 'Brgy.Conception Ormoc City', '09853319362', NULL, '2021-32388', 2, 20, 25, '2333997573', NULL, 0),
(81, 'Trisha Mhay', 'A', 'Lonzaga', '', '2004-12-09', 'female', 'Kananga Leyte', '09380359111', NULL, '2022-31680', 2, 20, 25, '2348566037', '1730206324Trisha MhayLonzaga.png', 0),
(82, 'Nathalie Grace', 'P', 'Poticar', '', '2002-11-05', 'female', 'Brgy. Patag, Ormoc City', '09928240096', NULL, '2021-32529', 2, 20, 25, '2335149589', '1729559192Nathalie GracePoticar.png', 0),
(83, 'Aj Myco', 'S', 'Estor', '', '2004-08-03', 'male', 'Brgy.Alta Vista Ormoc City', '09928479018', NULL, '2023-30515', 2, 20, 25, '2341403397', NULL, 0),
(84, 'Gishner', 'S', 'Santianez', '', '2004-05-14', 'male', 'Brgy.Alta Vista Ormoc City', '09162323353', NULL, '2023-30194', 2, 20, 25, '2347518981', '1730031481GishnerSantianez.png', 0),
(85, 'Uriel Dan', '', 'Carlobos', '', '2004-09-18', 'male', 'Brgy.Sto.Rosario Matag-ob Leyte', '09685490725', NULL, '2022-30937', 2, 20, 25, '2332531989', NULL, 0),
(86, 'Jenbert', 'L', 'Duazo', '', '2003-09-19', 'male', 'Brgy.Punta Ormoc City', '09619800304', NULL, '2022-31690', 2, 20, 25, '2344530965', '1730206766JenbertDuazo.png', 0),
(87, 'Franzin', 'P', 'Dalumpines', '', '2004-05-18', 'female', 'Brgy.Bagong Buhay Ormoc City', '09859998147', NULL, '2023-30881', 2, 20, 25, '2338632965', NULL, 0),
(88, 'Rhenah May', 'V', 'Cabudlay', '', '2003-11-16', 'female', 'Brgy.Boroc Ormoc City', '09503592172', NULL, '2022-31908', 2, 20, 25, '2332263957', '1730206525Rhenah MayCabudlay.png', 0),
(89, 'EarlJohn', 'L', 'Sicsic', '', '2004-07-25', 'male', 'Brgy.Alegria Ormoc City', '09078445692', NULL, '2022-30640', 2, 20, 25, '2347647253', NULL, 0),
(90, 'Aexel', '', 'Peguera', '', '2008-02-16', 'female', 'Brgy.Tambubulilid Ormoc City', '09262331424', NULL, '2024-30010', 2, 20, 25, '2348130069', '1730031356AexelPeguera.png', 0),
(91, 'Irish Angel', 'M', 'Galo', '', '2006-04-08', 'female', 'Brgy.Macabug Ormoc City', '09755240042', NULL, '2024-30136', 2, 20, 25, '2340190229', NULL, 0),
(92, 'Leah Mae', 'M', 'Tuburan', '', '2006-02-12', 'female', 'Valencia Ormoc City', '09355057482', NULL, '2024-30974', 2, 20, 25, '2339482133', '1730031640Leah MaeTuburan.png', 0),
(93, 'Tobby', 'A', 'Aligway', '', '2005-11-23', 'male', 'Brgy.Kadaohan Ormoc City', '09774074284', NULL, '2024-31074', 2, 20, 25, '2346203413', NULL, 0),
(94, 'Shanarya Elise', 'M', 'Calub', '', '2006-04-30', 'female', 'Benolho Albuera Leyte', '09537085081', NULL, '2024-30975', 2, 20, 25, '2334621189', NULL, 0),
(95, 'Khea Cyrielle', 'O', 'Moral', '', '2004-08-01', 'female', 'Brgy.Tambubulilid Ormoc City', '0948230319', NULL, '2024-30275', 2, 20, 25, '2345917445', NULL, 0),
(96, 'Arvin Clark', 'T', 'Bioc', '', '2005-12-23', 'male', 'Poblacion Albuera Leyte', '09094911735', NULL, '2024-31484', 2, 20, 25, '2341572373', NULL, 0),
(97, 'Elsie', 'S', 'Garciano', '', '2006-09-18', 'female', 'Aguiting Kananga Leyte', '09537163700', NULL, '2024-30528', 2, 20, 25, '2337708821', '1730031019ElsieGarciano.png', 0),
(98, 'Ariane Jean', 'C', 'Ocenar', '', '2006-01-25', 'female', 'Montebello Kananga Leyte', '09537092263', NULL, '2024-30742', 2, 20, 25, '2334868229', NULL, 0),
(99, 'Regine', 'M', 'Pales', '', '2001-03-21', 'female', 'Brgy.Cagbuhangin Ormoc City', '09163215842', NULL, '2021-30556', 2, 20, 25, '2333994501', NULL, 0),
(100, 'Ianna Jade', 'D', 'Tilan', '', '2004-10-13', 'female', 'Carigara Leyte', '09120914200', NULL, '2023-07245', 2, 20, 25, '2342621205', NULL, 0),
(101, 'Reyna Mae', '', 'Dolores', '', '2004-04-12', 'female', 'Brgy. Rufina M. Tan Ormoc City', '09265362997', NULL, '2022-31075', 2, 20, 25, '2338281733', NULL, 0),
(102, 'Ely Christian', 'G', 'Bucasas', '', '2004-07-17', 'male', 'Brgy.West Ormoc City', '09912554649', NULL, '2022-32197', 2, 20, 25, '2335386373', '1730083486Ely ChristianBucasas.png', 0),
(103, 'Antonio Jose', 'D', 'Torrevillas', '', '2001-07-31', 'male', 'Brgy.West Ormoc City', '09155025710', NULL, '2020-30296', 2, 20, 25, '2348320277', NULL, 0),
(104, 'Geraldine ', 'C', 'Valenzona', '', '2003-06-27', 'female', 'Brgy. Tambulilid, Ormoc City', '09317619843', NULL, '2022-30698', 2, 20, 25, '2342151941', '1730110790Geraldine Valenzona.png', 0),
(105, 'Johnny Andrew', '', 'Teleron', '', '2005-12-30', 'male', '124 Rizal St. Ormoc City', '09538201179', NULL, '2023-36593', 2, 20, 25, '2343864581', '1730206966Johnny AndrewTeleron.png', 0),
(106, 'Bezaleel ', 'A', 'Degillo', '', '2005-08-31', 'male', 'Brgy. Margen, Ormoc City', '09533500185', NULL, '2023-37990', 2, 20, 25, '2344381701', '1730206828Bezaleel Degillo.png', 0),
(107, 'John Paul ', 'S', 'Vasquez', '', '2002-01-03', 'male', 'Brgy. Tambulilid, Ormoc City', '09096546908', NULL, '2022-30654', 2, 20, 25, '2347406613', NULL, 0),
(108, 'Randy', 'D', 'Endolos', '', '2001-11-12', 'male', 'Brgy. Green Valley, Ormoc City', '09164265413', NULL, '2022-30390', 2, 20, 25, '2347579157', NULL, 0),
(109, 'Shamie Jean', 'L', 'Maaghop', '', '2004-03-07', 'female', 'Real street Ormoc City', '09812624097', NULL, '2022-31165', 2, 20, 25, '2338995989', NULL, 0),
(110, 'Gian  Racile', 'P', 'Corilla', '', '2003-12-29', 'male', 'Brgy. Campdownes, ormoc City', '09099701218', NULL, '2022-31791', 2, 20, 25, '2340331013', NULL, 0),
(112, 'Richard Jhon', 'S', 'Maraasin', '', '2001-10-28', 'male', 'Brgy. Cagbuhangin. Ormoc City', '09944810075', NULL, '2022-31336', 2, 20, 25, '2337981445', NULL, 0),
(113, 'Jerson Jr', 'L', 'Donasco', '', '2003-11-18', 'male', 'Brgy. Tambulilid, ormoc City', '09757012851', NULL, '2022-32079', 2, 20, 25, '2346787349', NULL, 0),
(114, 'Christopher Samuel', 'C', 'Abadiano', '', '2003-11-01', 'male', 'Brgy. Tambulilid, Ormoc City', '09269060911', NULL, '2022-31978', 2, 20, 25, '2333354757', NULL, 0),
(115, 'Samantha ', '', 'Salvar', '', '2003-04-02', 'female', 'Brgy. Rufina M. Tan, Ormoc City', '09700683871', NULL, '2022-30651', 2, 20, 25, '2342109205', NULL, 0),
(116, 'Princess ', 'C', 'Elisan', '', '2004-01-26', 'male', 'Brgy. Catmon, Oroc City', '09485949552', NULL, '2022-31352', 2, 20, 25, '2340986645', NULL, 0),
(117, 'John Kent', 'C', 'Canales', '', '2001-08-04', 'male', 'Kadaohan Ormoc City', '0995575079', NULL, '2020-30320', 2, 20, 25, '2346160133', NULL, 0),
(118, 'Jonas Redfz', 'C', 'Abejar', '', '2003-08-10', 'male', 'San Isidro Leyte', '09991713083', NULL, '2022-31668', 2, 20, 25, '2340388613', '1730206429Jonas RedfzAbejar.png', 0),
(119, 'Rachel', 'F', 'Carrillo', '', '2002-11-01', 'female', 'Brgy.Sumangga Ormoc City', '09945972405', NULL, '2023-33212', 2, 20, 25, '2343960069', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `sname` varchar(255) NOT NULL,
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

INSERT INTO `users` (`id`, `fname`, `mname`, `lname`, `sname`, `bdate`, `gender`, `address`, `cellnum`, `email`, `school_id`, `username`, `password`, `account_type`, `img_path`, `status`) VALUES
(1, 'admin', '', 'admin', '', '2000-01-01', 'male', 'EVSU OC', '09000000000', 'changem3@gmail.com', '0000-00000', 'admin', '$2y$10$WfGZaFrvZopdsQ7NvN9wJOn6IIfeIbC3PMnB.v3/GtBaHaEbVInYq', 1, '', 0),
(2, 'Security', '', 'Personnel', '', '2000-01-01', 'male', 'changeME', '09000000000', 'changeME@gmail.com', '0000-00000', 'security', '$2y$10$os.N1JYQ4jBx6EaQLAAqn.ImcCVy8RkuJBpxBm5cvx6/6.W1rmC8m', 3, '', 0),
(3, 'Staff', 'S', 'Office', 'III', '2000-01-01', 'female', 'change This', '09090000000', 'changeME@evsu.edu.ph', '0000-00000', 'staff', '$2y$10$H2JhT0dPzzxejlmgUe/3kOfG4JE9JXqf/vCihGXe3hPaPr2BG17D.', 2, '', 0),
(7, 'John Mark', 'F', 'Cuyos', 'Jr.', '2000-07-17', 'male', 'Tabgas, Albuera, Leyte', '09751407146', 'johnmark.cuyos@evsu.edu.ph', '2021-30174', 'evsuoc_jm', '$2y$10$5BtTtmLFQ9mhP7VNjV7YbOOpJm37NlBVdHZqVQYcllTg/Y9q5MvZe', 1, '1729186869John MarkCuyos.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `sname` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cellnum` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `rfid` varchar(255) DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0= active, 1=archived'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `fname`, `mname`, `lname`, `sname`, `gender`, `address`, `cellnum`, `role_id`, `rfid`, `img_path`, `status`) VALUES
(1, 'Glenda', 'A', 'Gariando', '', 'female', 'EVSU', '0909000000', 4, '0045444797', NULL, 0),
(2, 'Joseph', 'A', 'Gariando', '', 'male', 'EVSU', '09090000000', 4, '0036595314', NULL, 0),
(3, 'Marika', 'V', 'Villena', '', 'female', 'EVSU', '09000000000', 4, '0045481893', NULL, 0),
(4, 'Imelda', '', 'Bermejo', '', 'female', 'EVSU', '09000000000', 4, '0036528715', NULL, 0),
(5, 'Celerine', '', 'Merequillo', '', 'female', 'EVSU', '09000000000', 4, '0037952426', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `sname` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cellnum` varchar(255) DEFAULT NULL,
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
-- Indexes for table `employee_type`
--
ALTER TABLE `employee_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gen_reports`
--
ALTER TABLE `gen_reports`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_program_department` (`dept_id`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rfid` (`rfid`),
  ADD KEY `fk_students_department` (`dept_id`),
  ADD KEY `fk_students_program` (`prog_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employee_type`
--
ALTER TABLE `employee_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gen_reports`
--
ALTER TABLE `gen_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=342;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `fk_program_department` FOREIGN KEY (`dept_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_students_department` FOREIGN KEY (`dept_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `fk_students_program` FOREIGN KEY (`prog_id`) REFERENCES `program` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
