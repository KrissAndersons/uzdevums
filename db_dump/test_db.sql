-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 15, 2018 at 02:25 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.1.15-1+ubuntu16.04.1+deb.sury.org+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `answer` varchar(200) COLLATE utf8_general_mysql500_ci NOT NULL,
  `is_correct` enum('0','1') COLLATE utf8_general_mysql500_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer`, `is_correct`) VALUES
(1, 1, '5', '0'),
(2, 1, '4', '1'),
(3, 2, '16', '0'),
(4, 2, '8', '0'),
(5, 2, '9', '1'),
(6, 3, '180&deg;', '1'),
(7, 3, '160&deg;', '0'),
(8, 3, '360&deg;', '0'),
(9, 3, '300&deg;', '0'),
(10, 4, 'dažādi', '0'),
(11, 4, 'platleņķa', '0'),
(12, 4, 'vienādi', '1'),
(13, 4, 'taisni', '0'),
(14, 4, 'šāds trijstūris neeksistē', '0'),
(15, 5, '14', '0'),
(16, 5, '-25', '0'),
(17, 5, '25', '1'),
(18, 5, '40', '0'),
(19, 5, '24', '0'),
(20, 5, '-14', '0'),
(21, 5, 'Šim skaitlim nav moduļa.', '0');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `question` varchar(500) COLLATE utf8_general_mysql500_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `test_id`, `question`) VALUES
(1, 1, '2+2= ?'),
(2, 1, '3*3= ?'),
(3, 2, 'Kāda ir trijstūra visu leņķu summa?'),
(4, 2, 'Vienādmalu trijstura visi leņķi ir?'),
(5, 1, 'Skaitļa -25 modulis ir?');

-- --------------------------------------------------------

--
-- Table structure for table `question_history`
--

DROP TABLE IF EXISTS `question_history`;
CREATE TABLE `question_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `test_history_id` int(10) UNSIGNED NOT NULL,
  `answer_id` int(10) UNSIGNED NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `question_history`
--

INSERT INTO `question_history` (`id`, `test_history_id`, `answer_id`, `added`) VALUES
(4, 6, 2, '2018-05-14 13:59:32'),
(5, 6, 5, '2018-05-14 13:59:36'),
(6, 8, 2, '2018-05-14 15:04:24'),
(7, 8, 3, '2018-05-14 15:04:27'),
(8, 9, 8, '2018-05-14 15:07:53'),
(9, 9, 13, '2018-05-14 15:08:01'),
(10, 10, 2, '2018-05-14 15:25:29'),
(11, 10, 5, '2018-05-14 15:25:31'),
(12, 11, 6, '2018-05-14 15:34:19'),
(13, 11, 12, '2018-05-14 15:34:22'),
(14, 12, 2, '2018-05-15 07:02:16'),
(15, 12, 4, '2018-05-15 07:02:18'),
(16, 13, 2, '2018-05-15 07:08:48'),
(17, 13, 4, '2018-05-15 07:08:48'),
(18, 14, 2, '2018-05-15 07:09:00'),
(19, 14, 4, '2018-05-15 07:09:00'),
(20, 15, 2, '2018-05-15 07:15:05'),
(21, 15, 3, '2018-05-15 07:35:08'),
(22, 16, 6, '2018-05-15 07:56:27'),
(23, 16, 12, '2018-05-15 07:57:07'),
(24, 17, 8, '2018-05-15 07:57:19'),
(25, 17, 12, '2018-05-15 07:57:36'),
(26, 18, 8, '2018-05-15 07:57:47'),
(27, 18, 14, '2018-05-15 07:57:50'),
(28, 19, 1, '2018-05-15 07:58:24'),
(29, 19, 5, '2018-05-15 07:58:28'),
(30, 20, 8, '2018-05-15 07:59:43'),
(31, 20, 14, '2018-05-15 07:59:53'),
(32, 21, 6, '2018-05-15 08:34:28'),
(33, 21, 13, '2018-05-15 08:34:30'),
(34, 22, 1, '2018-05-15 08:39:02'),
(35, 22, 5, '2018-05-15 08:39:05'),
(36, 23, 6, '2018-05-15 08:39:50'),
(37, 23, 12, '2018-05-15 08:39:57'),
(38, 23, 17, '2018-05-15 08:40:03'),
(39, 24, 2, '2018-05-15 08:40:30'),
(40, 24, 5, '2018-05-15 08:40:31'),
(41, 24, 17, '2018-05-15 08:40:44'),
(42, 25, 2, '2018-05-15 08:41:05'),
(43, 25, 5, '2018-05-15 08:41:07'),
(44, 25, 21, '2018-05-15 08:43:48'),
(45, 26, 2, '2018-05-15 08:44:11'),
(46, 26, 4, '2018-05-15 08:44:13'),
(47, 26, 21, '2018-05-15 08:46:52'),
(48, 27, 2, '2018-05-15 09:00:58'),
(49, 27, 5, '2018-05-15 09:01:01'),
(50, 27, 17, '2018-05-15 09:01:04'),
(51, 28, 6, '2018-05-15 09:02:11'),
(52, 28, 12, '2018-05-15 09:02:15'),
(53, 29, 2, '2018-05-15 09:02:32'),
(54, 29, 5, '2018-05-15 09:02:40'),
(55, 29, 17, '2018-05-15 09:04:09'),
(56, 30, 6, '2018-05-15 09:04:19'),
(57, 30, 12, '2018-05-15 09:04:21'),
(58, 31, 2, '2018-05-15 09:06:38'),
(59, 31, 5, '2018-05-15 09:06:41'),
(60, 31, 17, '2018-05-15 09:11:12'),
(61, 32, 2, '2018-05-15 09:11:26'),
(62, 32, 5, '2018-05-15 09:11:32'),
(63, 32, 17, '2018-05-15 09:12:40'),
(64, 33, 2, '2018-05-15 09:12:57'),
(65, 33, 5, '2018-05-15 09:13:36'),
(66, 33, 17, '2018-05-15 09:13:43'),
(67, 34, 2, '2018-05-15 09:15:20'),
(68, 34, 5, '2018-05-15 09:15:27'),
(69, 34, 19, '2018-05-15 09:15:43'),
(70, 35, 2, '2018-05-15 11:17:01'),
(71, 35, 5, '2018-05-15 11:17:05'),
(72, 35, 17, '2018-05-15 11:17:11');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
CREATE TABLE `tests` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8_general_mysql500_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `title`) VALUES
(1, 'Matemātikas tests'),
(2, 'Trijstūru tests ');

-- --------------------------------------------------------

--
-- Table structure for table `test_history`
--

DROP TABLE IF EXISTS `test_history`;
CREATE TABLE `test_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `started` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `finished` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_history`
--

INSERT INTO `test_history` (`id`, `user_id`, `test_id`, `started`, `finished`) VALUES
(1, 29, 1, '2018-05-14 10:59:38', NULL),
(2, 30, 1, '2018-05-14 11:54:08', NULL),
(3, 31, 1, '2018-05-14 11:57:05', NULL),
(4, 32, 1, '2018-05-14 11:57:37', NULL),
(5, 33, 1, '2018-05-14 15:58:32', NULL),
(6, 34, 1, '2018-05-14 16:37:00', NULL),
(7, 35, 1, '2018-05-14 17:21:41', NULL),
(8, 36, 1, '2018-05-14 18:04:18', '2018-05-14 18:05:56'),
(9, 37, 2, '2018-05-14 18:07:49', '2018-05-14 18:25:17'),
(10, 38, 1, '2018-05-14 18:25:28', '2018-05-14 18:25:31'),
(11, 39, 2, '2018-05-14 18:34:17', '2018-05-14 18:34:32'),
(12, 40, 1, '2018-05-15 10:02:15', '2018-05-15 10:02:18'),
(13, 41, 1, '2018-05-15 10:08:46', '2018-05-15 10:08:48'),
(14, 42, 1, '2018-05-15 10:08:58', '2018-05-15 10:09:00'),
(15, 43, 1, '2018-05-15 10:13:54', '2018-05-15 10:35:08'),
(16, 44, 2, '2018-05-15 10:35:19', '2018-05-15 10:57:07'),
(17, 45, 2, '2018-05-15 10:57:18', '2018-05-15 10:57:36'),
(18, 46, 2, '2018-05-15 10:57:46', '2018-05-15 10:57:50'),
(19, 47, 1, '2018-05-15 10:58:11', '2018-05-15 10:58:28'),
(20, 48, 2, '2018-05-15 10:59:41', '2018-05-15 10:59:53'),
(21, 49, 2, '2018-05-15 11:33:57', '2018-05-15 11:34:30'),
(22, 50, 1, '2018-05-15 11:39:00', '2018-05-15 11:39:05'),
(23, 51, 2, '2018-05-15 11:39:35', '2018-05-15 11:40:03'),
(24, 52, 1, '2018-05-15 11:40:28', '2018-05-15 11:40:44'),
(25, 53, 1, '2018-05-15 11:40:56', '2018-05-15 11:43:48'),
(26, 54, 1, '2018-05-15 11:44:09', '2018-05-15 11:46:52'),
(27, 55, 1, '2018-05-15 11:54:05', '2018-05-15 12:01:04'),
(28, 56, 2, '2018-05-15 12:02:05', '2018-05-15 12:02:15'),
(29, 57, 1, '2018-05-15 12:02:29', '2018-05-15 12:04:09'),
(30, 58, 2, '2018-05-15 12:04:18', '2018-05-15 12:05:16'),
(31, 59, 1, '2018-05-15 12:06:37', '2018-05-15 12:11:12'),
(32, 60, 1, '2018-05-15 12:11:21', '2018-05-15 12:12:40'),
(33, 61, 1, '2018-05-15 12:12:53', '2018-05-15 12:13:43'),
(34, 62, 1, '2018-05-15 12:15:18', '2018-05-15 12:15:43'),
(35, 63, 1, '2018-05-15 14:16:58', '2018-05-15 14:17:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8_general_mysql500_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`) VALUES
(1, 'xcv'),
(2, '&lt;/script&gt;'),
(3, '&quot;&quot;&quot;&quot;/ &lt;script&gt;'),
(4, 'marija'),
(5, 'cxvbcvb'),
(6, 'cxx'),
(7, ''),
(8, 'xcccxcvx'),
(9, 'kriss'),
(10, 'dfghdfg'),
(11, 'dfghdfg'),
(12, 'dfghdfg'),
(13, 'dfghdfg'),
(14, 'fghdf'),
(15, 'vcxbcv'),
(16, 'jkl;kj'),
(17, 'sdfgsdf'),
(18, 'dfghdfghf'),
(19, 'fghdfg'),
(20, 'fgjhgh'),
(21, 'dfghdfg'),
(22, 'fgh'),
(23, 'zcxzv'),
(24, 'dfghdfg'),
(25, 'dfghdfg'),
(26, 'dfgsdfg'),
(27, 'dfgsdfg'),
(28, 'fgdh'),
(29, 'dfsgdf'),
(30, 'fg'),
(31, 'dfgh'),
(32, 'hjkh'),
(33, 'dfg'),
(34, 'cvzxc'),
(35, 'sdfd'),
(36, 'Krišs'),
(37, 'Krišs'),
(38, 'jānis'),
(39, 'Krišs'),
(40, 'ksjdh'),
(41, 'ghj'),
(42, 'hakcjhvsadjvhksjdfhvkljadfhvksdhfvjhd'),
(43, 'ziimo'),
(44, 'Krišs'),
(45, 'Krišs'),
(46, 'Krišs'),
(47, 'Krišs'),
(48, 'Krišs'),
(49, 'Krišs'),
(50, 'Krišs'),
(51, 'Krišs'),
(52, 'Krišs'),
(53, 'Krišs'),
(54, 'krišs'),
(55, 'Krišs'),
(56, 'Krišs'),
(57, 'Krišs'),
(58, 'Krišs'),
(59, 'Krišs'),
(60, 'Krišs'),
(61, 'Krišs'),
(62, 'Krišs'),
(63, 'Krišs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `is_correct` (`is_correct`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `question_history`
--
ALTER TABLE `question_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_history_id` (`test_history_id`),
  ADD KEY `answer_id` (`answer_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_history`
--
ALTER TABLE `test_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `question_history`
--
ALTER TABLE `question_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `test_history`
--
ALTER TABLE `test_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `FK_answers_question_id_questions_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `FK_questions_test_id_tests_id` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `question_history`
--
ALTER TABLE `question_history`
  ADD CONSTRAINT `FK_question_answer_id_answers_id` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_question_history_test_history_id_test_history_id` FOREIGN KEY (`test_history_id`) REFERENCES `test_history` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `test_history`
--
ALTER TABLE `test_history`
  ADD CONSTRAINT `FK_test_history_test_id_tests_id` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_test_history_user_id_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
