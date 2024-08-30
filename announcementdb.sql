-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 30, 2024 at 02:52 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `announcementdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `email`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'gab 23', 'gab@gmail.com', 'gab', '$2y$10$n/g9kN5yI2ZBNdj2aTbgCuk2eCaEAgdGLLun38JzrKcm4uwOwgnNK', '2024-07-13 12:44:02', '2024-07-13 14:11:15'),
(2, 'admin', 'admin@gg', 'admin', 'admin', '2024-07-13 13:32:31', '2024-07-13 13:32:31'),
(4, '', '', 'gg', '$2y$10$9iJXCW51ZuOLDiWkcT/Y.uulGBBXcDeAuZ4EGeICL/73Syiea1M8u', '2024-07-19 07:37:55', '2024-07-19 07:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fullname`, `username`, `email`, `password`, `ip_address`, `login_time`) VALUES
(1, 'Gg', 'Gg', 'whathe201@gmail.com', '$2y$10$cYUloh6VsMP9bfsdh95bd.vFQZyP.PlsYVRud1GGiugT407SrIEj6', '192.168.1.95', '2024-08-30 14:23:22'),
(3, '', 'Nigga', '', '$2y$10$b4AvKQ1BB/QSI1V1AtiP4uS.hut42wUtXJOL5vx6uK0Gr4p6c7Cge', '192.168.100.202', '2024-08-09 13:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(8) NOT NULL,
  `date` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `announcement_content` text NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `publish_date` date NOT NULL,
  `expiration_date` date NOT NULL,
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `date`, `title`, `announcement_content`, `image_path`, `publish_date`, `expiration_date`, `Status`) VALUES
(1, '2024-08-23 04:11:09', 'ggg', 'ggg', '../image/anime website.JPG', '2024-08-23', '2024-08-24', 2);

-- --------------------------------------------------------

--
-- Table structure for table `login_activity`
--

CREATE TABLE `login_activity` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login_time` datetime NOT NULL,
  `days_since_last_login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_activity`
--

INSERT INTO `login_activity` (`id`, `user_id`, `ip_address`, `login_time`, `days_since_last_login`) VALUES
(1, 2, '::1', '2024-07-13 07:26:26', 0),
(2, 2, '127.0.0.1', '2024-07-13 07:30:54', 0),
(3, 2, '127.0.0.1', '2024-07-13 07:40:18', 0),
(4, 1, '127.0.0.1', '2024-07-13 07:44:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `content`, `created_at`) VALUES
(5, 'supot kaba? oo supot ka', '2024-08-30 04:39:40'),
(6, 'gab', '2024-08-30 04:40:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'gab', '$2y$10$u0DKbNL0AKROF.xS.stNpeUyQwOfL6nF2/UFMY8owGO32eHYy3K9u', 'gab@gmail.com', '2024-07-13 13:23:19'),
(2, 'test', '$2y$10$YuW7pD//ZCp8Tf41ybKVO.rOrUvtAnEOSq3rZ6/WHVcB5dS1T43di', 'dab@gmail.com', '2024-07-13 13:26:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_activity`
--
ALTER TABLE `login_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_activity`
--
ALTER TABLE `login_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_activity`
--
ALTER TABLE `login_activity`
  ADD CONSTRAINT `login_activity_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
