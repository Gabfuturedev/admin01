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
-- Database: `course_creation`
--

-- --------------------------------------------------------

--
-- Table structure for table `achivevids`
--

CREATE TABLE `achivevids` (
  `AchiveVidsID` int(11) NOT NULL,
  `videoId` int(8) NOT NULL,
  `instructor_email` varchar(50) NOT NULL,
  `course_id` int(8) NOT NULL,
  `lessonNumber` int(11) NOT NULL,
  `videoPath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `achivevids`
--

INSERT INTO `achivevids` (`AchiveVidsID`, `videoId`, `instructor_email`, `course_id`, `lessonNumber`, `videoPath`) VALUES
(1, 35, 'gab@sdasd', 11, 23, '0'),
(2, 35, 'gab@sdasd', 11, 23, '0'),
(3, 0, 'gab@sdasd', 11, 23, '0'),
(4, 0, 'gab@sdasd', 11, 23, '0'),
(5, 35, 'gab@sdasd', 11, 23, '0'),
(6, 35, 'gab@sdasd', 11, 23, '0'),
(7, 35, 'gab@sdasd', 11, 23, '0'),
(8, 35, 'gab@sdasd', 11, 23, '0'),
(9, 35, 'gab@sdasd', 11, 23, '0'),
(10, 35, 'gab@sdasd', 11, 23, 'uploads/TEST.mp4'),
(11, 35, 'gab@sdasd', 11, 23, 'uploads/TEST.mp4'),
(12, 39, 'gab@sdasd', 0, 3, 'uploads/TEST.mp4'),
(13, 41, 'gab@sdasd', 44, 44, 'uploads/TEST.mp4'),
(14, 43, 'gab@sdasd', 69, 43324, 'uploads/TEST.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `archivevideos`
--

CREATE TABLE `archivevideos` (
  `archive_id` int(11) NOT NULL,
  `videoId` int(11) NOT NULL,
  `instructor_email` varchar(128) NOT NULL,
  `course_Id` int(11) NOT NULL,
  `lessonNumber` varchar(11) NOT NULL,
  `videoPath` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseId` int(11) NOT NULL,
  `instructor_email` varchar(128) NOT NULL,
  `courseName` varchar(128) NOT NULL,
  `lessons` int(6) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseId`, `instructor_email`, `courseName`, `lessons`, `description`) VALUES
(13, 'John@example.com', 'Paano mag Palaki ng Talong', 2, 'sdadasd');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `instructor_name` varchar(80) NOT NULL,
  `email` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `contact_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`instructor_name`, `email`, `address`, `contact_no`) VALUES
('John', 'John@example.com', 'USA', '09765407546');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `correct_answer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question_text`, `correct_answer`) VALUES
(29, 33, 'Ideal Size of Eggplant', 2);

-- --------------------------------------------------------

--
-- Table structure for table `question_choices`
--

CREATE TABLE `question_choices` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `choice_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_choices`
--

INSERT INTO `question_choices` (`id`, `question_id`, `choice_text`) VALUES
(109, 29, '4inch'),
(110, 29, '8inch'),
(111, 29, '12inch'),
(112, 29, '16inch');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `timer` int(11) NOT NULL,
  `passing_grade` int(11) NOT NULL,
  `course_Id` int(11) NOT NULL,
  `lessonNumber` varchar(20) NOT NULL,
  `instructor_email` varchar(128) NOT NULL,
  `num_questions` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `timer`, `passing_grade`, `course_Id`, `lessonNumber`, `instructor_email`, `num_questions`) VALUES
(33, 'Multiple Choice Quiz for Paano mag Palaki ng Talong Lesson 2', 1, 1, 13, 'Lesson 2', 'John@example.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `videolessons`
--

CREATE TABLE `videolessons` (
  `videoId` int(11) NOT NULL,
  `instructor_email` varchar(128) NOT NULL,
  `course_Id` int(11) NOT NULL,
  `lessonNumber` varchar(10) NOT NULL,
  `videoPath` varchar(128) NOT NULL,
  `status` int(1) NOT NULL COMMENT '0-pending 1-approve 2-warning'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videolessons`
--

INSERT INTO `videolessons` (`videoId`, `instructor_email`, `course_Id`, `lessonNumber`, `videoPath`, `status`) VALUES
(36, 'gab@sdasd', 69, '1212', 'uploads/TEST.mp4', 1),
(37, 'gab@sdasd', 69, '12', 'uploads/TEST.mp4', 3),
(38, 'gab@sdasd', 69, '1212', 'uploads/TEST.mp4', 3),
(40, 'gab@sdasd', 0, '22', 'uploads/TEST.mp4', 1),
(41, 'gab@sdasd', 77, '77', 'uploads/TEST.mp4', 1),
(42, 'dasdadasdasd@g.com', 0, '99999999', 'uploads/bandicam 2024-03-03 18-58-12-809.mp4', 3);

-- --------------------------------------------------------

--
-- Table structure for table `video_reports`
--

CREATE TABLE `video_reports` (
  `reportId` int(11) NOT NULL,
  `videoId` int(11) DEFAULT NULL,
  `timestamp` varchar(255) DEFAULT NULL,
  `reportTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reason` varchar(250) NOT NULL,
  `status` int(1) NOT NULL COMMENT '0-pending 1-approve 2-warning 3-delete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video_reports`
--

INSERT INTO `video_reports` (`reportId`, `videoId`, `timestamp`, `reportTime`, `reason`, `status`) VALUES
(1, 36, '0:02', '2024-08-07 09:39:22', '', 1),
(2, 42, '0:5', '2024-08-07 09:43:13', '', 3),
(3, 40, '0:02', '2024-08-07 09:47:19', '', 3),
(4, 36, '0:02', '2024-08-07 11:37:17', '', 1),
(5, 36, '0:02', '2024-08-07 11:41:07', 'Copyright Violation', 1),
(6, 42, '0:04', '2024-08-07 12:06:51', 'Inappropriate Content', 3),
(7, 36, '0:02', '2024-08-07 13:35:07', 'Inappropriate Content', 1),
(8, 43, '0:02', '2024-08-07 13:38:45', 'Other', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achivevids`
--
ALTER TABLE `achivevids`
  ADD PRIMARY KEY (`AchiveVidsID`);

--
-- Indexes for table `archivevideos`
--
ALTER TABLE `archivevideos`
  ADD PRIMARY KEY (`archive_id`),
  ADD KEY `videoId` (`videoId`,`course_Id`),
  ADD KEY `course_Id` (`course_Id`),
  ADD KEY `instructor_email` (`instructor_email`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseId`),
  ADD KEY `instructor_email` (`instructor_email`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `question_choices`
--
ALTER TABLE `question_choices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_email` (`instructor_email`),
  ADD KEY `courseId` (`course_Id`);

--
-- Indexes for table `videolessons`
--
ALTER TABLE `videolessons`
  ADD PRIMARY KEY (`videoId`),
  ADD KEY `instructor_email` (`instructor_email`,`course_Id`);

--
-- Indexes for table `video_reports`
--
ALTER TABLE `video_reports`
  ADD PRIMARY KEY (`reportId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achivevids`
--
ALTER TABLE `achivevids`
  MODIFY `AchiveVidsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `archivevideos`
--
ALTER TABLE `archivevideos`
  MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `courseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `question_choices`
--
ALTER TABLE `question_choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `videolessons`
--
ALTER TABLE `videolessons`
  MODIFY `videoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `video_reports`
--
ALTER TABLE `video_reports`
  MODIFY `reportId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archivevideos`
--
ALTER TABLE `archivevideos`
  ADD CONSTRAINT `archivevideos_ibfk_1` FOREIGN KEY (`instructor_email`) REFERENCES `instructor` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `archivevideos_ibfk_2` FOREIGN KEY (`course_Id`) REFERENCES `courses` (`courseId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `archivevideos_ibfk_3` FOREIGN KEY (`videoId`) REFERENCES `videolessons` (`videoId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_choices`
--
ALTER TABLE `question_choices`
  ADD CONSTRAINT `question_choices_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`instructor_email`) REFERENCES `instructor` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quizzes_ibfk_2` FOREIGN KEY (`course_Id`) REFERENCES `courses` (`courseId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
