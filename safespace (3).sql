-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2025 at 08:52 PM
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
-- Database: `safespace`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(4, 'admin', '$2y$10$8QztuWoJdTrDs9HJ.IjsMe0Q33j5PgrV.eDtbWTW9.xiPHZ0Ge5Wa', '2025-03-04 06:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `user_ip` varchar(45) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `first_name`, `last_name`, `phone`, `email`, `message`, `user_ip`, `submitted_at`) VALUES
(4, 'Ange', 'Carelle', '671319479', 'Ange@gmail.com', 'i need to talk to a personal therapist', '::1', '2025-03-12 11:30:21'),
(5, 'Ange', 'Carelle', '671319479', 'Ange@gmail.com', 'i need to talk to a personal therapist', '::1', '2025-03-12 11:38:29'),
(9, 'Blaise', 'Nfor', '671319479', 'blaise@gmail.com', 'i want to talk to a professional face_to_face', '::1', '2025-03-12 11:53:41'),
(10, 'Daniel', 'Ray', '671319479', 'daniel@gmail.com', 'i have contacted a therapist here and no response', '::1', '2025-03-13 14:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `professional_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Unread','Read') DEFAULT 'Unread',
  `professional_response` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `professional_id`, `message`, `created_at`, `status`, `professional_response`) VALUES
(5, 1, 2, 'New session booking request from user ID 1.', '2025-03-13 14:02:56', 'Unread', NULL),
(7, 1, 4, 'New session booking request from user ID 1.', '2025-03-14 10:59:43', 'Unread', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professionals`
--

CREATE TABLE `professionals` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(255) NOT NULL,
  `status` enum('active','banned','pending') DEFAULT 'active',
  `profile_picture` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professionals`
--

INSERT INTO `professionals` (`id`, `username`, `email`, `phone`, `password`, `created_at`, `role`, `status`, `profile_picture`) VALUES
(2, 'Anebom Odette', 'anebom@gmail.com', '+237-671-319-479', '$2y$10$UsRSz/RTsTSEgih3v5OPNeu5ELPaonW8TpOOYupk1O262OqVdCWuC', '2025-03-05 11:05:01', 'professional', 'active', ''),
(3, 'Dr Chenwi Blaise', 'blaise@gmail.com', '+237-671-319-479', '$2y$10$OYA.GmGosFdXLWZUJiRukeMqDVRVDxJU3qF8Nv0ttYs8GkuMQmr/i', '2025-03-05 11:07:02', 'professional', 'active', ''),
(4, 'Dr Che Linda', 'linda@gmail.com', '+237-671-319-479', '$2y$10$Sd3eFk/vbfQn0G12BLeBee6pBu4u1UnOommDQD4iIVRN029YB//4.', '2025-03-05 11:08:24', 'professional', 'active', '');

-- --------------------------------------------------------

--
-- Table structure for table `session_requests`
--

CREATE TABLE `session_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `professional_id` int(11) NOT NULL,
  `session_type` varchar(50) NOT NULL,
  `session_date` date NOT NULL,
  `session_time` time NOT NULL,
  `user_message` text DEFAULT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` enum('Pending','Confirmed','Completed','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session_requests`
--

INSERT INTO `session_requests` (`id`, `user_id`, `professional_id`, `session_type`, `session_date`, `session_time`, `user_message`, `payment_method`, `status`, `created_at`) VALUES
(2, 1, 2, 'Phone Session', '2025-03-24', '19:35:00', 'i want to talk to a therapist am going through alot', 'MTN Mobile Money', 'Cancelled', '2025-03-13 14:02:56'),
(4, 1, 3, 'Phone Session', '2025-03-24', '15:30:00', '', 'MTN Mobile Money', 'Pending', '2025-03-14 11:02:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`, `created_at`, `role`) VALUES
(1, 'colette', 'colette@gmail.com', '6729397462', '$2y$10$9jfhawYI/J/fxvplYA2DCeYFuct6l920TK5FC0T.LXqZeXRM9Vvz6', '2025-03-04 13:23:37', ''),
(3, 'ange', 'Ange@gmail.com', '6994513789', '$2y$10$K2ZhcVGkU0UITapF3wl1x.cQJCr5xeZv7T0j4u1GxS8sFjXC1b/tG', '2025-03-04 13:26:15', ''),
(6, 'quin', 'quinngwina@gmail.com', '+237-671-319-479', '$2y$10$oRvk4010CmodUhkgbivf1.iAxwjmVEQDTT4P5AyecQhcHmGrvGtJq', '2025-03-04 13:37:05', 'user'),
(7, 'joy', 'joy@gmail.com', '6713333677', '$2y$10$lq3fTVW0JyfTujkxHVm3u..iTINg3ZoCFvxWKg5qgCu2bnts/53A2', '2025-03-12 15:56:27', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `professional_id` (`professional_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professionals`
--
ALTER TABLE `professionals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `session_requests`
--
ALTER TABLE `session_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `professionals`
--
ALTER TABLE `professionals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `session_requests`
--
ALTER TABLE `session_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`professional_id`) REFERENCES `professionals` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
