-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 25, 2024 at 02:58 PM
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
-- Database: `contest`
--

-- --------------------------------------------------------

--
-- Table structure for table `contbl`
--

CREATE TABLE `contbl` (
  `id` int(2) NOT NULL,
  `firstName` varchar(55) NOT NULL,
  `lastName` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `conNum` bigint(15) NOT NULL,
  `streetAddress` varchar(55) NOT NULL,
  `city` varchar(55) NOT NULL,
  `province` varchar(55) NOT NULL,
  `zipCode` int(7) NOT NULL,
  `country` varchar(55) NOT NULL,
  `appLetter` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `valId` varchar(255) NOT NULL,
  `date` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contbl`
--

INSERT INTO `contbl` (`id`, `firstName`, `lastName`, `email`, `conNum`, `streetAddress`, `city`, `province`, `zipCode`, `country`, `appLetter`, `cv`, `picture`, `valId`, `date`, `status`) VALUES
(50, 'df', '', 'gab@gmail.com', 657457, 'jyfjfg', 'jgfj', 'gj', 111, '', './application_form/appLetter/anime website.JPG', './application_form/cv/anime website.JPG', './application_form/picture/anime website.JPG', './application_form/valId/anime website.JPG', '2024-08-08', 0),
(52, 'df', '', 'gab@gmail.com', 657457, 'jyfjfg', 'jgfj', 'gj', 111, '', './application_form/appLetter/anime website.JPG', './application_form/cv/anime website.JPG', './application_form/picture/anime website.JPG', './application_form/valId/anime website.JPG', '2024-08-08', 0),
(53, 'gab', '', 'gab@gmail.com', 657457, 'jyfjfg', 'jgfj', 'gj', 111, '', './application_form/appLetter/anime website.JPG', './application_form/cv/anime website.JPG', './application_form/picture/c1.JPG', './application_form/valId/capybarra.JPG', '2024-08-23', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contbl`
--
ALTER TABLE `contbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contbl`
--
ALTER TABLE `contbl`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
