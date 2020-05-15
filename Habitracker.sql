-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2020 at 11:48 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Habitracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_chat_message`
--

CREATE TABLE `activity_chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `activity_table`
--

CREATE TABLE `activity_table` (
  `activity_name` varchar(256) NOT NULL,
  `activity_repetition` int(1) NOT NULL DEFAULT 0,
  `activity_one_off_datetime` datetime DEFAULT NULL,
  `activity_recurring_date_0` enum('MON','TUE','WED','THU','FRI','SAT','SUN') DEFAULT NULL,
  `activity_recurring_time_0` time DEFAULT NULL,
  `activity_recurring_date_1` enum('MON','TUE','WED','THU','FRI','SAT','SUN') DEFAULT NULL,
  `activity_recurring_time_1` time DEFAULT NULL,
  `activity_recurring_date_2` enum('MON','TUE','WED','THU','FRI','SAT','SUN') DEFAULT NULL,
  `activity_recurring_time_2` time DEFAULT NULL,
  `activity_time_remark` varchar(256) DEFAULT NULL,
  `activity_location` enum('Islands','Kwai Tsing','North','Sai Kung','Sha Tin','Tai Po','Tsuen Wan','Tuen Mun','Yuen Long','Kowloon City','Kwun Tong','Sham Shui Po','Wong Tai Sin','Yau Tsim Mong','Central & Western','Eastern','Southern','Wan Chai','Online','Others') NOT NULL,
  `activity_remark` varchar(256) DEFAULT NULL,
  `activity_status_open` int(1) NOT NULL DEFAULT 0,
  `activity_id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_table`
--

INSERT INTO `activity_table` (`activity_name`, `activity_repetition`, `activity_one_off_datetime`, `activity_recurring_date_0`, `activity_recurring_time_0`, `activity_recurring_date_1`, `activity_recurring_time_1`, `activity_recurring_date_2`, `activity_recurring_time_2`, `activity_time_remark`, `activity_location`, `activity_remark`, `activity_status_open`, `activity_id`, `username`) VALUES
('handicraft interest group', 1, NULL, 'TUE', '18:30:00', NULL, NULL, NULL, NULL, '', 'Sham Shui Po', '', 1, 2, 'George'),
('calligraphy class', 2, NULL, 'MON', '20:45:00', 'WED', '19:15:00', NULL, NULL, 'time can be negotiated', 'Kowloon City', '', 1, 4, 'Amy'),
('bicycle tour', 2, NULL, 'SAT', '09:15:00', 'SUN', '08:00:00', NULL, NULL, 'whole day', 'Sha Tin', 'Please bring enough water', 1, 5, 'Henry'),
('Weekly hike tour', 1, NULL, 'TUE', '08:00:00', NULL, NULL, NULL, NULL, '', 'North', 'will be cancelled if the weather is bad ', 1, 6, 'George'),
('Chess gathering', 0, '2020-04-29 12:30:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Sham Shui Po', '', 1, 7, 'Chriswong'),
('camping and riding bicycle ', 0, '2020-05-20 08:15:00', NULL, NULL, NULL, NULL, NULL, NULL, 'whole day', 'Others', 'location differs every time', 1, 8, 'Iris'),
('Band practise', 1, NULL, 'MON', '11:00:00', NULL, NULL, NULL, NULL, '', 'Wong Tai Sin', '', 1, 9, 'Amy'),
('Coding gathering', 3, NULL, 'MON', '19:30:00', 'FRI', '20:00:00', 'SAT', '08:00:00', '', 'Online', 'You can leave whenever you want ', 1, 10, 'Iris'),
('Hike', 0, '2020-07-16 07:15:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Tuen Mun', 'Bring sun lotion', 1, 11, 'George'),
('go to gym', 1, NULL, 'SUN', '18:30:00', NULL, NULL, NULL, NULL, '', 'Sha Tin', '', 1, 13, 'Chriswong'),
('online computer game ', 3, NULL, 'TUE', '16:45:00', 'THU', '17:45:00', 'SAT', '18:45:00', '', 'Online', '', 1, 15, 'Amy'),
('hike and draw the natural scenery', 1, NULL, 'SAT', '09:15:00', NULL, NULL, NULL, NULL, '', 'Tai Po', '', 1, 16, 'Fanny'),
('ride bicycle around the island ', 2, NULL, 'MON', '10:00:00', 'SAT', '08:00:00', NULL, NULL, 'last for 1.5 hours ', 'Islands', '', 0, 17, 'Chriswong'),
('Chinese oral practise', 0, '2020-05-08 20:15:00', NULL, NULL, NULL, NULL, NULL, NULL, 'last for 2 hours ', 'Wan Chai', '', 1, 18, 'Chriswong');

-- --------------------------------------------------------

--
-- Table structure for table `activity_users_list`
--

CREATE TABLE `activity_users_list` (
  `entry_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_users_list`
--

INSERT INTO `activity_users_list` (`entry_id`, `user_id`, `activity_id`) VALUES
(2, 7, 2),
(4, 2, 4),
(5, 8, 5),
(6, 7, 6),
(7, 1, 7),
(8, 9, 8),
(10, 2, 9),
(11, 9, 10),
(12, 7, 11),
(13, 7, 5),
(16, 1, 13),
(19, 2, 15),
(20, 2, 5),
(21, 6, 16),
(23, 1, 10),
(24, 1, 9),
(25, 1, 17),
(26, 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `username` varchar(150) NOT NULL,
  `goal_id` int(11) NOT NULL,
  `goal_name` varchar(255) NOT NULL,
  `goal_description` varchar(255) DEFAULT NULL,
  `goal_subtask` varchar(255) DEFAULT NULL,
  `goal_enddate` date NOT NULL,
  `goal_starttime` time DEFAULT NULL,
  `goal_endtime` time DEFAULT NULL,
  `goal_public` tinyint(1) NOT NULL,
  `goal_completed` tinyint(1) NOT NULL DEFAULT 0,
  `streak` int(11) NOT NULL DEFAULT 0,
  `streak_lastSun` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`username`, `goal_id`, `goal_name`, `goal_description`, `goal_subtask`, `goal_enddate`, `goal_starttime`, `goal_endtime`, `goal_public`, `goal_completed`, `streak`, `streak_lastSun`) VALUES
('Amy', 1, 'learn Spanish', 'have Spanish online lesson ', '', '2020-05-10', '20:00:00', '21:00:00', 1, 0, 1, 0),
('George', 2, 'maintain regular sleeping pattern', '', 'Sleep before 11pm, wake up at 7am', '2020-06-02', NULL, NULL, 1, 0, 1, 0),
('Emily', 3, 'eat healthily', '', '', '2020-05-14', NULL, NULL, 1, 0, 1, 0),
('Chriswong', 4, 'practise calligraphy', '', '', '2020-08-01', '16:30:00', '17:00:00', 1, 0, 15, 10),
('Fanny', 5, 'learn piano', 'pop songs!', '', '2020-11-09', '08:00:00', '09:00:00', 1, 0, 1, 0),
('Emily', 6, 'improve English reading skills', 'esp. with political topics', 'read the newspaper everyday', '2020-07-17', '18:00:00', '18:30:00', 1, 0, 1, 0),
('Chriswong', 8, 'Get good grades in the coming exam', '', 'do revision everyday', '2020-05-20', '09:00:00', '19:00:00', 1, 0, 7, 2),
('Amy', 9, 'Practise the piano', '', '', '2020-07-05', '12:00:00', '12:45:00', 1, 0, 1, 0),
('Dennis', 10, 'Beat my running personal best', 'now 12s for 100m, aim 11s', '', '2020-05-30', NULL, NULL, 1, 0, 1, 0),
('Dennis', 11, 'Learn a new programming language', '', 'Take online programming courses', '2020-06-22', NULL, NULL, 1, 0, 1, 0),
('Chriswong', 13, 'Master video editing', '', '', '2020-07-14', '22:00:00', '23:00:00', 1, 0, 0, 0),
('Amy', 14, 'improve Chinese oral skills', '', '', '2020-05-05', '13:00:00', '13:15:00', 1, 0, 1, 0),
('Fanny', 15, 'Learn to swim', 'freestyle', 'join swimming lessons', '2020-09-05', '17:30:00', '18:30:00', 1, 0, 1, 0),
('Chriswong', 16, 'Join piano class ', '', '', '2020-08-01', '16:15:00', '17:15:00', 0, 0, 2, 30),
('Amy', 17, 'Pass Japanese N2 exams', '', 'do pastpapers', '2020-07-01', '19:00:00', '21:30:00', 1, 0, 1, 0),
('Fanny', 18, 'run in the mountains ', 'medium difficulty', '', '2020-09-07', NULL, NULL, 1, 0, 1, 0),
('Amy', 19, 'run at the gym', '', '', '2020-07-30', '18:45:00', '19:15:00', 1, 0, 1, 0),
('Amy', 21, 'Keep fit ', '', 'Go to the gym three times a week', '2020-05-13', '20:00:00', '20:45:00', 1, 0, 1, 0),
('Chriswong', 22, 'Learn Japanese', '150 days till N1 exam!', 'listen to radio programmes in Japanese', '2020-09-20', '12:00:00', '13:00:00', 1, 0, 55, 50);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image_status` int(11) NOT NULL DEFAULT 1,
  `first_name` text DEFAULT NULL,
  `last_name` text DEFAULT NULL,
  `welcome_message` longtext DEFAULT NULL,
  `receive_dailyreminder` tinyint(1) NOT NULL DEFAULT 0,
  `receive_weeklyreport` tinyint(1) NOT NULL DEFAULT 0,
  `score` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `username`, `email`, `password`, `image_status`, `first_name`, `last_name`, `welcome_message`, `receive_dailyreminder`, `receive_weeklyreport`, `score`) VALUES
(1, 'Chriswong', 'chriswong.cuhk.csci@gmail.com', '$2y$10$UrWcvBi7hwrM5aYYoCmA4Op8FrtFm0ZtSCsleiQsNxVTf86c0kTy6', 1, NULL, NULL, NULL, 1, 1, 157700),
(2, 'Amy', 'amy0001@gmail.com', '$2y$10$3Av2ILXcwNjuttMHR/dBb.CXC.NGp5blUy5QNP1FHoaqh3XpVUL.y', 1, NULL, NULL, NULL, 0, 0, 172900),
(4, 'Dennis', 'dennischan@gmail.com', '$2y$10$Dz/dFMR0n7ZLxDpbzjOfVenWcWA98omAY4PbaM2mNnIZqFrOm2Kmi', 1, NULL, NULL, NULL, 0, 0, 148900),
(5, 'Emily', 'emily@gmail.com', '$2y$10$1OvSqF6HKIr1PSEvZyZ63usTrcG/CpWHYPmmnHE9oholegEvV29Pi', 1, NULL, NULL, NULL, 0, 0, 112000),
(6, 'Fanny', 'fanny@gmail.com', '$2y$10$NP3Hly0d4WCQMAJ0yO.tEe.nHgY5YnmKZFi3hppBCGl9F0qWk9DZW', 1, NULL, NULL, NULL, 0, 0, 99900),
(7, 'George', 'george@gmail.com', '$2y$10$euVkNszF9UJDG9L1XUFz9OzOkUFMq4fjYvG6eXiKiaKXVdz9TVZti', 1, NULL, NULL, NULL, 0, 0, 148900),
(8, 'Henry', 'henry@gmail.com', '$2y$10$jODRCaa/ZW8siqnhZdNa9eKaIhVTLT.eaN6RDU9HXdxZ7J3SI.LUS', 1, NULL, NULL, NULL, 0, 0, 105500),
(9, 'Iris', 'iris@gmail.com', '$2y$10$oSyccRx4QOo/K/Y4.AUSgeHkRJ.vdRL66Qbl/9jilApspk7fRGXgy', 1, NULL, NULL, NULL, 0, 0, 51900),
(10, 'Jack', 'jack@gmail.com', '$2y$10$YACcHweK0Fi4pb6z0.127u8VJ5kDiJHW74.PiIseIyQfwxgUu6TUO', 1, NULL, NULL, NULL, 0, 0, 88300);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`login_details_id`, `user_id`, `last_activity`, `is_type`) VALUES
(1, 2, '2020-04-23 15:46:40', 'no'),
(2, 7, '2020-04-23 15:47:26', 'no'),
(3, 5, '2020-04-23 15:48:38', 'no'),
(4, 1, '2020-04-23 15:49:53', 'no'),
(5, 6, '2020-04-23 15:51:46', 'no'),
(6, 5, '2020-04-23 15:53:26', 'no'),
(8, 1, '2020-04-23 15:56:18', 'no'),
(9, 2, '2020-04-23 15:57:30', 'no'),
(10, 4, '2020-04-23 16:13:22', 'no'),
(12, 1, '2020-04-23 16:14:48', 'no'),
(13, 2, '2020-04-23 16:15:36', 'no'),
(14, 6, '2020-04-23 16:16:28', 'no'),
(15, 1, '2020-04-23 16:17:56', 'no'),
(16, 2, '2020-04-23 16:20:11', 'no'),
(17, 6, '2020-04-23 16:21:46', 'no'),
(18, 2, '2020-04-23 16:22:26', 'no'),
(20, 2, '2020-04-23 16:26:34', 'no'),
(21, 1, '2020-04-23 16:29:21', 'no'),
(22, 7, '2020-04-23 16:30:04', 'no'),
(24, 2, '2020-04-23 16:34:58', 'no'),
(25, 8, '2020-04-23 16:35:57', 'no'),
(26, 7, '2020-04-23 16:36:55', 'no'),
(27, 1, '2020-04-23 16:37:40', 'no'),
(28, 9, '2020-04-23 16:39:38', 'no'),
(29, 2, '2020-04-23 16:40:29', 'no'),
(30, 9, '2020-04-23 16:41:25', 'no'),
(31, 7, '2020-04-23 16:42:29', 'no'),
(33, 1, '2020-04-23 16:44:39', 'no'),
(35, 2, '2020-04-23 16:46:58', 'no'),
(36, 6, '2020-04-23 16:48:56', 'no'),
(37, 1, '2020-04-23 16:50:05', 'no'),
(38, 1, '2020-04-23 17:43:17', 'no'),
(39, 2, '2020-04-23 17:44:40', 'no'),
(40, 1, '2020-04-23 17:44:50', 'no'),
(41, 1, '2020-04-23 20:45:54', 'no'),
(42, 1, '2020-04-23 20:47:09', 'no'),
(43, 1, '2020-04-23 22:18:27', 'no'),
(44, 6, '2020-04-23 22:18:45', 'no'),
(45, 6, '2020-04-23 22:22:17', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `report_type` varchar(8) NOT NULL,
  `goal_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `reason` text NOT NULL,
  `report_time` datetime NOT NULL DEFAULT current_timestamp(),
  `resolved` tinyint(1) NOT NULL DEFAULT 0,
  `goal_name` varchar(255) DEFAULT NULL,
  `activity_name` varchar(256) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `dismissed` tinyint(1) NOT NULL DEFAULT 0,
  `reporter` varchar(150) NOT NULL,
  `owner` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `report_type`, `goal_id`, `activity_id`, `reason`, `report_time`, `resolved`, `goal_name`, `activity_name`, `deleted`, `dismissed`, `reporter`, `owner`) VALUES
(1, 'activity', NULL, 3, 'Meaningless', '2020-04-23 17:43:05', 1, NULL, 'I have no idea ', 1, 0, 'Chriswong', 'Ben'),
(2, 'activity', NULL, 14, 'Random', '2020-04-23 17:43:43', 0, NULL, 'i feel so bored', 1, 0, 'Amy', 'Ben'),
(3, 'goal', 7, NULL, 'Not a goal.', '2020-04-23 17:44:36', 0, 'I lost my pencil', NULL, 1, 0, 'Amy', 'Ben'),
(4, 'goal', 12, NULL, 'This goal is inappropriate.', '2020-04-23 17:45:38', 0, 'Eat nothing for a week', NULL, 1, 0, 'Chriswong', 'Ben'),
(5, 'activity', NULL, 12, 'not related.', '2020-04-23 22:16:04', 0, NULL, 'i am so happy', 1, 0, 'Chriswong', 'Ben'),
(6, 'goal', 20, NULL, 'This is weird', '2020-04-23 22:16:31', 1, 'breathe everyday', NULL, 1, 0, 'Chriswong', 'Ben'),
(7, 'goal', 8, NULL, 'i don\'t like this', '2020-04-23 22:19:08', 1, 'Get good grades in the coming exam', NULL, 0, 1, 'Fanny', 'Chriswong'),
(8, 'activity', NULL, 11, 'zzz......', '2020-04-23 22:19:57', 1, NULL, 'Hike', 0, 1, 'Fanny', 'George');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_chat_message`
--
ALTER TABLE `activity_chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `activity_table`
--
ALTER TABLE `activity_table`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `activity_users_list`
--
ALTER TABLE `activity_users_list`
  ADD PRIMARY KEY (`entry_id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`goal_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_chat_message`
--
ALTER TABLE `activity_chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activity_table`
--
ALTER TABLE `activity_table`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `activity_users_list`
--
ALTER TABLE `activity_users_list`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
