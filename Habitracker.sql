-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 13, 2020 at 10:32 AM
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
('Golf', 0, '2020-04-15 16:37:50', NULL, NULL, NULL, NULL, NULL, NULL, 'THIS IS ONE OFF', 'Sha Tin', 'This is a free event', 1, 1, 'pikachu'),
('Bike', 1, NULL, 'TUE', '14:25:00', NULL, NULL, NULL, NULL, 'THIS IS RECURRING OFF', 'Sha Tin', 'This is a free event', 1, 2, 'pikachu'),
('Bike SECRET', 1, NULL, 'TUE', '14:35:00', NULL, NULL, NULL, NULL, 'THIS IS RECURRING OFF', 'Sha Tin', 'This is a free event', 0, 3, 'pikachu'),
('sPANISHH', 2, NULL, 'MON', '14:50:00', 'FRI', '18:00:22', NULL, NULL, 'THIS IS lan', 'Online', 'This is nottt a free event', 1, 4, 'pikachu'),
('german', 3, NULL, 'MON', '14:50:00', 'FRI', '18:00:22', 'SAT', '18:00:22', 'THIS IS boreing', 'Online', 'This is nottt a free event', 1, 5, 'pikachu');

-- --------------------------------------------------------

--
-- Table structure for table `activity_users_list`
--

CREATE TABLE `activity_users_list` (
  `entry_id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `activity_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `timestamp`, `status`) VALUES
(1, 2, 1, 'hi\n', '2020-03-25 14:20:18', 1),
(2, 2, 1, 'hello', '2020-03-26 17:39:51', 1),
(3, 4, 1, 'hello', '2020-03-26 17:44:10', 0),
(4, 1, 4, 'hi', '2020-03-26 17:47:29', 0),
(5, 4, 1, 'hey', '2020-03-26 17:58:28', 1),
(6, 6, 1, 'Lets go to gym tgt xd!!!!', '2020-04-13 08:27:46', 0),
(7, 1, 6, 'Go!!! Where do you live???', '2020-04-13 08:27:46', 0),
(8, 1, 6, 'I am in MongKok let\'s go to the public gym!', '2020-04-13 08:27:46', 0),
(9, 2, 7, 'Let\'s learn spanish tgt?!', '2020-04-13 08:27:46', 0),
(10, 7, 2, 'Good I need someone to motivate me', '2020-04-13 08:27:46', 0),
(11, 2, 7, 'I will be on Zoom!', '2020-04-13 08:27:46', 0);

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
  `goal_completed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`username`, `goal_id`, `goal_name`, `goal_description`, `goal_subtask`, `goal_enddate`, `goal_starttime`, `goal_endtime`, `goal_public`, `goal_completed`) VALUES
('wck', 4, 'Make a database', 'goal_description', '', '2020-04-12', NULL, NULL, 0, 0),
('wck', 5, 'Make a chat box', 'goal_description', '', '0000-00-00', NULL, NULL, 0, 0),
('wck', 6, 'Make a nice looking interface', '', '', '0000-00-00', NULL, NULL, 1, 0),
('wck', 7, 'I guess this should be correct', 'a description that is not blank', 'a sub-task', '2020-04-29', NULL, NULL, 0, 1),
('wck', 8, 'Public goal', '', '', '0000-00-00', NULL, NULL, 0, 0),
('wck', 9, 'public goal', '', '', '0000-00-00', NULL, NULL, 1, 0),
('wck', 13, 'breakfast', '', '', '2020-04-29', '08:00:00', '09:30:00', 0, 0),
('wck', 14, '3100', '3100', '', '2020-04-23', '22:00:00', '23:00:00', 0, 1),
('wck', 16, '3100', '', '', '2020-04-14', '05:00:00', '06:00:00', 0, 1),
('wck', 17, '3100', '', '', '2020-04-14', '10:00:00', '20:20:00', 1, 0),
('PikachuMaster', 46, 'Espanolll', 'Spainish netflix everyday', '', '2020-03-06', '20:00:00', '21:00:00', 1, 0),
('PikachuMaster', 47, 'Cook', 'Everyday cook breakfast', '', '2020-03-07', NULL, NULL, 0, 0),
('CaptainAmerica', 48, 'DC plan', 'Everyday watch one Batman Movie', '', '2020-02-14', '00:14:07', '00:23:04', 1, 0),
('CaptainAmerica', 49, 'Biceps plan', 'Everyday go to gym', 'Help girlfriend with errands', '2020-02-15', '00:00:07', '00:12:24', 1, 0),
('CaptainAmerica', 50, 'Learn to use Swift', 'Watch YT tutorial', 'Write notes', '2020-02-12', '00:00:07', '00:27:24', 0, 0),
('AndyTsang', 51, 'Travel plan', 'Everyday go to the Victoria Harbour', 'Find a girlfriend asap', '2020-02-14', NULL, NULL, 0, 0),
('AndyTsang', 52, 'Biceps training', 'Everyday go to gym', 'Help mama with errands', '2020-01-23', NULL, NULL, 1, 0),
('Ivan118', 53, 'Sleeping plan', 'Everyday sleep for 4 hours or more', 'Read Kindle before sleep', '2020-02-25', NULL, NULL, 1, 0),
('Mary223', 54, 'Lose weight', 'Go to gym', 'Not eat cakes', '2020-01-15', NULL, NULL, 1, 0),
('Mary223', 55, 'Get a boyfriend', 'Practise makeup', '', '2020-02-14', NULL, NULL, 0, 0),
('PeterLol', 56, 'Write a novel', 'ONe week 6 pages', '', '2020-03-04', '00:00:17', '00:22:24', 1, 0),
('PeterLol', 57, 'Learn spanish', 'Go to duolinguo', '', '2020-02-19', '00:00:47', '00:12:34', 1, 0),
('John23', 58, 'Biceps!!!', 'Everyday go to gym', 'You need a gf next year', '2020-02-13', '00:00:01', '00:04:24', 1, 0);

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
  `welcome_message` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `username`, `email`, `password`, `image_status`, `first_name`, `last_name`, `welcome_message`) VALUES
(1, 'wck', 'wongchika@ymail.com', '$2y$10$UOyrRT.86mhGtI9wqqJL.OhZeD/uFiz2Lfnv.eyRd9XuKOFIsYaw.', 1, 'Chi Ka', 'Wong', 'Hello!!!'),
(2, 'phoebe', 'phoebechan0209@gmail.com', '$2y$10$sT2rf8RkA663a6TkLnYfiOr8JLybofKP4rQ0tojMXrjNgAuJYD.la', 1, NULL, NULL, NULL),
(3, 'chika', 'wongchika26@gmail.com', '$2y$10$FlFTxLUMIl2LtTSPMqzVbe/5nM1ynVQrqoOm/M9v2XXCMJto8Xlyq', 1, NULL, NULL, NULL),
(4, 'cst', 'phoebe@gmail.com', '$2y$10$1s/oPYE2nNcjBTtCRXGX3.r35S.ui6dymZ4L2/Oh1gAiiwnuiqIGu', 1, NULL, NULL, NULL),
(5, 'John23', 'john234@gmail.com', '2347893john', 1, 'John', 'Chan', 'Welcome to my page!'),
(6, 'PeterLol', 'peterrwong@gmail.com', '2n3rfpeter', 1, 'Peter', 'Wong', 'Nice to meet you all!'),
(7, 'Mary223', 'marychan@gmail.com', 'h3n4corona', 1, 'Mary', 'Lee', 'Let\'s reach our goals together!'),
(8, 'Ivan118', 'ivan1144@gmail.com', '135ivan345', 1, 'Ivan', 'Lai', 'Nice to meet you!'),
(9, 'AndyTsang', 'andy667t4@gmail.com', 'andyyts114', 1, 'Andy', 'Tsang', 'Keep going!'),
(10, 'CaptainAmerica', 'capa2020@gmail.com', 'tonystark3000', 1, 'Captain', 'America', 'Captain Cmerica is the best!'),
(11, 'PikachuMaster', 'ashhketchamp@gmail.com', 'iwannacatchtemall23', 1, 'Pikachu', 'Master', 'Let\'s go catch pikachu!');

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
(1, 1, '2020-03-26 18:14:26', 'no'),
(2, 4, '2020-03-26 17:52:28', 'no'),
(3, 4, '2020-03-26 17:54:26', 'no'),
(4, 4, '2020-03-26 17:56:17', 'no'),
(5, 4, '2020-03-26 18:06:34', 'no'),
(6, 1, '2020-03-26 18:19:51', 'no'),
(7, 1, '2020-03-26 18:23:04', 'no'),
(8, 1, '2020-03-26 18:26:10', 'no'),
(9, 1, '2020-03-26 19:16:02', 'no'),
(10, 1, '2020-03-27 04:01:50', 'no'),
(11, 1, '2020-04-09 11:23:47', 'no'),
(12, 1, '2020-04-09 11:23:52', 'no'),
(13, 1, '2020-04-11 05:33:43', 'no'),
(14, 1, '2020-04-12 10:47:27', 'no'),
(15, 1, '2020-04-12 10:48:04', 'no'),
(16, 1, '2020-04-12 14:32:41', 'no'),
(17, 4, '2020-04-12 14:33:52', 'no'),
(18, 1, '2020-04-12 17:05:27', 'no'),
(19, 1, '2020-04-13 06:22:47', 'no'),
(20, 1, '2020-04-13 07:15:02', 'no'),
(21, 1, '2020-04-13 07:18:42', 'no'),
(22, 1, '2020-04-13 07:38:45', 'no'),
(23, 1, '2020-04-13 07:39:06', 'no'),
(24, 1, '2020-04-13 07:41:26', 'no');

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

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_table`
--
ALTER TABLE `activity_table`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `activity_users_list`
--
ALTER TABLE `activity_users_list`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
