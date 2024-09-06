-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Sep 06, 2024 at 07:14 PM
-- Server version: 9.0.1
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `created_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `content`, `created_at`, `completed_at`) VALUES
(2, 'Test task 2 - Urgent task', 'This is the content of test task 2.', '2024-05-19 13:06:17', '2024-03-08 20:28:51'),
(4, 'Test task 4 - Optional task', 'This is the content of test task 4.', '2023-05-12 07:29:15', '2023-06-07 02:54:43'),
(5, 'Test task 5 - Urgent task', 'This is the content of test task 5.', '2023-09-01 12:11:04', '2023-01-05 17:20:12'),
(6, 'Test task 6 - General task', 'This is the content of test task 6.', '2023-01-13 15:34:05', '2023-11-13 09:44:26'),
(8, 'Test task 8 - Optional task', 'This is the content of test task 8.', '2023-01-30 00:49:30', '2023-06-18 07:32:01'),
(9, 'Test task 9 - Urgent task', 'This is the content of test task 9.', '2023-07-02 21:25:06', '2024-04-07 18:26:42'),
(10, 'Test task 10 - General task', 'This is the content of test task 10.', '2023-12-24 06:39:05', '2024-09-06 19:11:22'),
(11, 'Test task 11 - Optional task', 'This is the content of test task 11.', '2023-09-07 11:21:17', '2023-05-29 02:04:24'),
(12, 'Test task 12 - Urgent task', 'This is the content of test task 12.', '2024-03-30 13:12:59', '2024-09-06 19:11:59'),
(13, 'Test task 13 - Optional task', 'This is the content of test task 13.', '2024-04-29 01:56:22', '2024-09-06 19:12:04'),
(15, 'Test task 15 - Important task', 'This is the content of test task 15.', '2023-05-02 18:36:25', NULL),
(16, 'Test task 16 - General task', 'This is the content of test task 16.', '2024-03-20 19:33:00', NULL),
(17, 'Test task 17 - Optional task', 'This is the content of test task 17.', '2023-12-26 23:13:09', NULL),
(18, 'Test task 18 - Optional task', 'This is the content of test task 18.', '2024-05-19 21:52:11', NULL),
(19, 'Test task 19 - General task', 'This is the content of test task 19.', '2024-03-10 13:21:03', NULL),
(22, 'Test task 22 - Urgent task', 'This is the content of test task 22.', '2023-01-13 21:41:19', '2023-04-18 10:11:35'),
(23, 'Test task 23 - Optional task', 'This is the content of test task 23.', '2024-01-23 04:04:05', '2024-05-26 14:55:22'),
(24, 'Test task 24 - Urgent task', 'This is the content of test task 24.', '2024-06-06 06:03:40', NULL),
(25, 'Test task 25 - Important task', 'This is the content of test task 25.', '2024-04-01 11:41:55', '2024-05-17 12:11:24'),
(26, 'Test task 26 - Urgent task', 'This is the content of test task 26.', '2023-02-04 11:19:00', NULL),
(27, 'Test task 27 - Optional task', 'This is the content of test task 27.', '2023-05-17 12:40:04', '2024-04-25 03:06:27'),
(28, 'Test task 28 - Urgent task', 'This is the content of test task 28.', '2024-08-25 00:11:05', NULL),
(29, 'Test task 29 - General task', 'This is the content of test task 29.', '2024-09-03 03:18:52', NULL),
(30, 'Test task 30 - General task', 'This is the content of test task 30.', '2024-05-16 22:41:57', NULL),
(31, 'Test task 31 - Urgent task', 'This is the content of test task 31.', '2024-04-17 05:24:49', NULL),
(32, 'Test task 32 - General task', 'This is the content of test task 32.', '2023-11-30 04:41:02', '2023-02-13 07:25:13'),
(33, 'Test task 33 - General task', 'This is the content of test task 33.', '2023-07-26 11:56:08', NULL),
(34, 'Test task 34 - Urgent task', 'This is the content of test task 34.', '2024-05-06 16:55:27', '2023-10-18 07:52:00'),
(35, 'Test task 35 - General task', 'This is the content of test task 35.', '2024-05-21 13:24:18', '2023-09-29 15:55:53'),
(36, 'Test task 36 - Optional task', 'This is the content of test task 36.', '2024-05-08 08:59:31', NULL),
(37, 'Test task 37 - Important task', 'This is the content of test task 37.', '2023-05-28 02:45:34', '2023-08-26 23:17:16'),
(38, 'Test task 38 - General task', 'This is the content of test task 38.', '2023-04-16 00:18:30', '2024-01-03 09:27:54'),
(39, 'Test task 39 - Urgent task', 'This is the content of test task 39.', '2024-08-20 03:39:58', NULL),
(41, 'Test task 41 - Optional task', 'This is the content of test task 41.', '2023-07-06 17:34:35', NULL),
(42, 'Test task 42 - Optional task', 'This is the content of test task 42.', '2024-06-12 01:11:52', '2023-08-26 01:20:49'),
(43, 'Test task 43 - Optional task', 'This is the content of test task 43.', '2024-02-23 11:45:16', '2024-06-11 20:27:21'),
(44, 'Test task 44 - General task', 'This is the content of test task 44.', '2023-01-16 07:55:10', '2023-06-06 03:00:51'),
(45, 'Test task 45 - Optional task', 'This is the content of test task 45.', '2023-12-12 19:55:36', NULL),
(47, 'Test task 47 - Optional task', 'This is the content of test task 47.', '2023-09-24 14:26:25', NULL),
(48, 'Test task 48 - Urgent task', 'This is the content of test task 48.', '2024-02-26 16:37:06', '2024-01-11 20:50:39'),
(49, 'Test task 49 - Important task', 'This is the content of test task 49.', '2023-11-24 00:53:00', '2024-03-01 03:44:46'),
(50, 'Test task 50 - Urgent task', 'This is the content of test task 50.', '2023-09-05 23:29:04', '2023-10-07 22:56:41'),
(51, 'Test task 51 - Important task', 'This is the content of test task 51.', '2024-06-20 21:40:07', '2024-03-19 13:24:32'),
(52, 'Test task 52 - Urgent task', 'This is the content of test task 52.', '2023-05-02 11:33:20', '2024-06-30 20:59:28'),
(53, 'Test task 53 - General task', 'This is the content of test task 53.', '2024-08-22 17:58:55', NULL),
(54, 'Test task 54 - Urgent task', 'This is the content of test task 54.', '2024-03-16 02:37:50', NULL),
(55, 'Test task 55 - Important task', 'This is the content of test task 55.', '2023-12-06 02:56:04', NULL),
(56, 'Test task 56 - General task', 'This is the content of test task 56.', '2023-04-01 18:42:37', NULL),
(57, 'Test task 57 - Urgent task', 'This is the content of test task 57.', '2023-05-14 07:31:35', NULL),
(58, 'Test task 58 - Urgent task', 'This is the content of test task 58.', '2023-06-25 18:02:19', NULL),
(59, 'Test task 59 - Optional task', 'This is the content of test task 59.', '2024-02-22 12:44:27', '2024-04-29 09:42:55'),
(60, 'Test task 60 - Optional task', 'This is the content of test task 60.', '2024-01-03 12:13:28', '2024-07-18 17:09:47'),
(61, 'Test task 61 - Important task', 'This is the content of test task 61.', '2023-01-19 00:08:59', NULL),
(62, 'Test task 62 - Urgent task', 'This is the content of test task 62.', '2023-02-12 07:50:28', '2023-12-04 22:47:48'),
(63, 'Test task 63 - General task', 'This is the content of test task 63.', '2024-01-07 12:51:07', NULL),
(64, 'Test task 64 - Optional task', 'This is the content of test task 64.', '2024-01-19 00:46:34', '2024-02-23 08:59:22'),
(65, 'Test task 65 - Important task', 'This is the content of test task 65.', '2024-02-13 10:13:54', NULL),
(66, 'Test task 66 - Important task', 'This is the content of test task 66.', '2024-03-18 05:53:13', '2023-08-27 01:03:34'),
(67, 'Test task 67 - General task', 'This is the content of test task 67.', '2023-08-23 03:37:34', NULL),
(68, 'Test task 68 - Urgent task', 'This is the content of test task 68.', '2024-06-22 14:28:58', NULL),
(69, 'Test task 69 - Urgent task', 'This is the content of test task 69.', '2023-06-24 07:59:02', '2023-07-27 17:55:02'),
(70, 'Test task 70 - General task', 'This is the content of test task 70.', '2023-07-14 01:19:21', '2023-11-19 12:48:57'),
(71, 'Test task 71 - Urgent task', 'This is the content of test task 71.', '2023-01-30 06:51:17', '2023-02-11 12:02:53'),
(72, 'Test task 72 - General task', 'This is the content of test task 72.', '2023-11-12 10:21:38', NULL),
(73, 'Test task 73 - Important task', 'This is the content of test task 73.', '2024-07-03 01:38:41', NULL),
(74, 'Test task 74 - Optional task', 'This is the content of test task 74.', '2023-12-09 04:51:46', '2023-09-28 00:09:32'),
(75, 'Test task 75 - Urgent task', 'This is the content of test task 75.', '2023-04-04 00:34:10', NULL),
(76, 'Test task 76 - General task', 'This is the content of test task 76.', '2023-03-06 05:48:27', '2023-10-10 21:10:52'),
(77, 'Test task 77 - Important task', 'This is the content of test task 77.', '2024-04-14 18:02:14', '2024-08-29 09:46:28'),
(78, 'Test task 78 - Optional task', 'This is the content of test task 78.', '2024-05-20 02:56:28', NULL),
(79, 'Test task 79 - Important task', 'This is the content of test task 79.', '2023-01-15 17:00:30', NULL),
(80, 'Test task 80 - Important task', 'This is the content of test task 80.', '2023-03-22 18:01:59', '2023-12-16 11:21:27'),
(81, 'Test task 81 - General task', 'This is the content of test task 81.', '2023-11-11 18:20:47', '2023-12-12 06:31:10'),
(82, 'Test task 82 - General task', 'This is the content of test task 82.', '2024-04-11 04:46:59', NULL),
(83, 'Test task 83 - Important task', 'This is the content of test task 83.', '2023-02-16 04:36:43', NULL),
(84, 'Test task 84 - General task', 'This is the content of test task 84.', '2024-07-30 21:29:06', NULL),
(85, 'Test task 85 - Urgent task', 'This is the content of test task 85.', '2023-03-03 00:47:27', NULL),
(86, 'Test task 86 - Optional task', 'This is the content of test task 86.', '2024-06-13 07:35:43', NULL),
(87, 'Test task 87 - Optional task', 'This is the content of test task 87.', '2023-12-08 19:40:25', NULL),
(88, 'Test task 88 - Urgent task', 'This is the content of test task 88.', '2023-10-17 18:18:45', NULL),
(89, 'Test task 89 - Optional task', 'This is the content of test task 89.', '2024-04-26 11:47:58', NULL),
(90, 'Test task 90 - Urgent task', 'This is the content of test task 90.', '2024-05-13 00:27:22', NULL),
(91, 'Test task 91 - Important task', 'This is the content of test task 91.', '2024-04-29 04:09:34', '2024-05-06 06:53:40'),
(92, 'Test task 92 - Important task', 'This is the content of test task 92.', '2023-12-03 04:53:23', '2023-03-15 09:49:36'),
(93, 'Test task 93 - Urgent task', 'This is the content of test task 93.', '2023-11-22 13:10:32', '2023-02-28 10:36:57'),
(94, 'Test task 94 - Optional task', 'This is the content of test task 94.', '2023-11-11 07:09:27', NULL),
(95, 'Test task 95 - Important task', 'This is the content of test task 95.', '2023-10-27 18:27:21', NULL),
(96, 'Test task 96 - Optional task', 'This is the content of test task 96.', '2023-07-12 20:44:19', NULL),
(97, 'Test task 97 - Optional task', 'This is the content of test task 97.', '2024-06-26 11:38:07', NULL),
(98, 'Test task 98 - Urgent task', 'This is the content of test task 98.', '2023-02-25 16:42:38', NULL),
(99, 'Test task 99 - Urgent task', 'This is the content of test task 99.', '2023-09-11 21:28:49', '2024-06-01 21:31:59'),
(100, 'Test task 100 - Important task', 'This is the content of test task 100.', '2023-12-19 13:34:36', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `completed_at` (`completed_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
