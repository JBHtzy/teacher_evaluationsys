-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2024 at 05:49 AM
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
-- Database: `teachereval`
--

-- --------------------------------------------------------

--
-- Table structure for table `activate_day`
--

CREATE TABLE `activate_day` (
  `id` int(11) NOT NULL,
  `opening_day` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activate_day`
--

INSERT INTO `activate_day` (`id`, `opening_day`) VALUES
(29, '2024-07-24');

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `id` int(11) NOT NULL,
  `feels` enum('outstanding','very satisfactory','satisfactory','needs improvements','poor') NOT NULL,
  `comments` text NOT NULL,
  `stud_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `teacherid` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reactions`
--

INSERT INTO `reactions` (`id`, `feels`, `comments`, `stud_id`, `subject`, `teacherid`, `date`) VALUES
(10, 'outstanding', 'sdas sad ased w eawe wadsad', 2, 'Capstone2', 10, '2024-03-19'),
(11, 'very satisfactory', 'sad sad as dsadsa dsdsa', 2, 'Capstone1', 10, '2024-03-19'),
(12, 'satisfactory', 'sadsa sad asd asdas das  sad asd sds ', 2, 'Capstone1', 10, '2024-03-19'),
(13, 'needs improvements', 'asd aew ea wewads aew e', 2, 'Capstone1', 10, '2024-03-19'),
(14, 'satisfactory', 'sdasdsd', 2, 'subject1', 11, '2024-03-19'),
(15, 'poor', 'sdsa sd asdsd sdsads s dsdsd', 15, 'subject1', 11, '2024-03-20'),
(16, 'poor', 'asdasdas sad asd as sa dsdas dsdsds', 15, 'subject1', 11, '2024-03-20'),
(17, 'very satisfactory', 'sadsad sa dsad asdsad sadsa dsadsd', 2, 'Capstone1', 10, '2024-03-21'),
(18, 'satisfactory', 'sad asd asdsad sadsa dsdsd', 2, 'Capstone1', 10, '2024-03-21'),
(19, 'needs improvements', 'sdsdsd', 2, 'Capstone1', 10, '2024-03-21'),
(20, 'poor', 'sadsa sad asd sd sds dsdsd', 2, 'Capstone2', 10, '2024-03-21'),
(21, 'outstanding', 'sadaew waeaweaw', 17, 'subject1', 11, '2024-03-22'),
(22, 'needs improvements', 'katulog', 18, 'subject1', 11, '2024-03-23'),
(23, 'poor', 'wako kaila', 2, 'php', 12, '2024-03-23'),
(24, 'very satisfactory', 'sadsad sad as dsads dssd sdd', 2, 'php', 12, '2024-03-23'),
(25, 'outstanding', 'asdas das dsadsads sdasds', 20, 'php', 12, '2024-03-23'),
(26, 'poor', 'ez to underrstand', 2, 'subject1', 11, '2024-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `proof_img` text NOT NULL,
  `age` int(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `course` varchar(255) NOT NULL,
  `yearlvl` varchar(255) NOT NULL,
  `is_enrolled` varchar(255) NOT NULL,
  `form_filled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `stud_id`, `firstname`, `lastname`, `email`, `proof_img`, `age`, `gender`, `course`, `yearlvl`, `is_enrolled`, `form_filled`) VALUES
(1, 2, 'bron', 'doe', 'brondoe@gmail.com', 'oms1.jpg', 22, 'male', 'DIST', '2nd year', 'enrolled', 1),
(3, 13, 'test', 'test', 'test@gmail.com', '423454802_806095301359424_8729809541945027037_n.png', 22, 'male', 'DIST', '2nd year', 'enrolled', 1),
(4, 14, 'daboy', 'doe', 'daboy@gmail.com', 'oms1.jpg', 20, 'male', 'Bachelor of Science in Information Technology', '1st year', 'enrolled', 1),
(5, 15, 'anica', 'loew', 'anica@gmail.com', 'kini ra.jpg', 22, 'male', 'DIST', '2nd year', 'pending', 1),
(6, 16, '', '', '', '', 0, '', '', '', 'pending', 0),
(7, 17, 'sung', 'lee', 'sunglee@gmail.com', 'visit-philippines.jpg', 23, 'male', 'DIST', '2nd year', 'enrolled', 1),
(8, 18, 'ars', 'destura', 'ars123@gmail.com', 'pngimg.com - teacher_PNG32 (1).png', 39, 'female', 'Bachelor of Science in Information Technology', '2nd year', 'enrolled', 1),
(9, 20, 'First Lee', 'Obedencio', 'lee@gmail.com', '343156697_200247689428285_3878878437206972590_n.jpg', 12, 'male', 'Bachelor of Science in Computer Science', '4th year', 'enrolled', 1),
(10, 21, '', '', '', '', 0, '', '', '', 'pending', 0),
(11, 22, '', '', '', '', 0, '', '', '', 'pending', 0),
(12, 23, 'dsdad', 'sdsads', 'daboy@gmail.com', '67827640_2368955946725423_2445611918019264512_o.jpg', 42, 'male', 'DIST', '2nd year', 'pending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_desc` varchar(255) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_desc`, `teacher_id`) VALUES
(1, 'Capstone1', 1),
(2, 'Capstone2', 1),
(3, 'Subject3', 2),
(4, 'Subject4', 2),
(5, 'fere', 5),
(6, 'sadsds', 7),
(7, 'sdsawe2', 7),
(8, 'ssdsd', 9),
(9, 'Capstone1', 10),
(10, 'Capstone2', 10),
(11, 'subject1', 11),
(12, 'php', 12);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `prof_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `name`, `prof_img`) VALUES
(10, 11, 'Kebin', '84c001481641bcade490f57aaa62a1b0b71da7f8.jpg'),
(11, 12, 'adam', 'doctor.png'),
(12, 19, 'arse', '423777794_357110580427150_8860570768271500495_n.jpg'),
(14, 25, 'zxfczsd', '67827640_2368955946725423_2445611918019264512_o.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'bron12@DIST.ascb', 'Aw12345', 'student'),
(11, 'Kebin@asc.bislig ', 'ascb@1995', 'teacher'),
(12, 'adam@asc.bislig ', 'ascb@1995', 'teacher'),
(13, 'alvin12@DIST.ascb', 'alvin', 'student'),
(14, 'q28RYgCt@DIST.ascb', 'boJWJ76h', 'student'),
(15, 'janna@DIST.ascb', 'jan123', 'student'),
(16, 'qVPruzCN@DIST.ascb', 'O85yHtCk', 'student'),
(17, 'xoLQ2Ctj@DIST.ascb', 'UMEIpN@c', 'student'),
(18, 'ars@DIST.ascb', 'MqyhGapb', 'student'),
(19, 'arsecola@ascb.bislig', '12345', 'teacher'),
(20, 'lee@DIST.ascb', '1234', 'student'),
(21, 'Wg8gVHE1@DIST.ascb', 'hl60rXM6', 'student'),
(22, 'ir3vlDnd@DIST.ascb', 'yVGp5NPB', 'student'),
(23, 'jPvjgnuU@DIST.ascb', '!NX1Ln7F', 'student'),
(24, 'zxfczsd@asc.bislig ', 'ascb@1995', 'teacher'),
(25, 'zxfczsd@asc.bislig ', 'ascb@1995', 'teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activate_day`
--
ALTER TABLE `activate_day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stud_id` (`stud_id`,`teacherid`),
  ADD KEY `teacherid` (`teacherid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stud_id` (`stud_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activate_day`
--
ALTER TABLE `activate_day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
