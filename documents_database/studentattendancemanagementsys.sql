-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2021 at 10:44 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentattendancemanagementsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `courseId` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `userId`, `courseId`, `date`) VALUES
(5, 15, 21, '2021-09-05'),
(8, 15, 7, '2021-09-04'),
(9, 15, 7, '2021-09-05'),
(10, 15, 18, '2021-09-05'),
(12, 15, 17, '2021-09-05'),
(13, 15, 20, '2021-09-05'),
(14, 15, 5, '2021-09-05'),
(15, 15, 5, '2021-09-06'),
(38, 15, 5, '2021-08-01'),
(39, 15, 6, '2021-08-10'),
(40, 15, 12, '2021-08-04'),
(41, 15, 11, '2021-08-11'),
(42, 15, 10, '2021-07-01'),
(43, 15, 14, '2021-07-10'),
(44, 15, 20, '2021-07-11'),
(45, 15, 17, '2021-07-10'),
(46, 15, 22, '2021-07-10'),
(47, 15, 7, '2021-09-03'),
(48, 15, 5, '2021-09-03'),
(49, 15, 14, '2021-09-10'),
(50, 15, 8, '2021-09-10'),
(51, 15, 6, '2021-08-10'),
(52, 15, 15, '2021-08-10'),
(53, 15, 14, '2021-07-10'),
(54, 15, 10, '2021-09-10'),
(55, 15, 11, '2021-08-03'),
(56, 15, 14, '2021-09-04'),
(57, 15, 20, '2021-09-04');

-- --------------------------------------------------------

--
-- Table structure for table `attendanceinstance`
--

CREATE TABLE `attendanceinstance` (
  `studentId` varchar(20) NOT NULL,
  `attendanceId` int(11) NOT NULL,
  `createdTime` datetime DEFAULT current_timestamp(),
  `createdDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendanceinstance`
--

INSERT INTO `attendanceinstance` (`studentId`, `attendanceId`, `createdTime`, `createdDate`) VALUES
('4001', 9, '2021-09-05 15:45:11', '2021-09-05');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `courseCode` varchar(10) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `courseCode`, `title`) VALUES
(5, 'CSE 245', 'Intro to Algorithms'),
(6, 'CSE 364', 'Artificial Intelligence'),
(7, 'CSE 375', 'Compiler Design'),
(8, 'CSE 411', 'Software Engineering'),
(10, 'CSE 301', 'Database Management Systems'),
(11, 'CSE 251', 'Electrical Circuits'),
(12, 'CSE 345', 'Digital Logic Design'),
(14, 'BUS 101', 'Business Studies'),
(15, 'GEN 226', 'Emergence Of Bangladesh'),
(16, 'GEN 211', 'Media and Journalism'),
(17, 'PHY 209', 'Quantum Physics'),
(18, 'PHY 109', 'Fluid Mechanics'),
(20, 'GEB 109', 'Introduction to Genetic Engineering'),
(21, 'MATH 101', 'Differential Equation and Calculus'),
(22, 'MATH 102', 'Vector Alzebra'),
(26, 'CSE 207', 'Data Structure'),
(27, 'CSE 245', 'Intro to Algorithms');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentId` varchar(20) NOT NULL,
  `userId` int(11) NOT NULL,
  `fullName` varchar(30) DEFAULT NULL,
  `personalEmail` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentId`, `userId`, `fullName`, `personalEmail`) VALUES
('2001', 60, NULL, NULL),
('2002', 63, 'Akib Ahmed', 'akib@gmail.com'),
('2003', 64, 'Shakil Hassan', 'shakil99@gmail.com'),
('2004', 65, 'Rifa Ahmed', 'rifa12@gmail.com'),
('2005', 67, 'Karib Abrar', ''),
('2006', 68, 'Zahin Abid', 'Zahin.12@gmail.com'),
('2007', 69, 'Hasib Nibir', 'Hasib.nibir48@gmail.com'),
('2008', 70, '', 'limon.ali@gmail.com'),
('2009', 71, '', ''),
('2010', 72, 'libu Hassan', 'libuhassan12@gmail.com'),
('4001', 58, 'Nafis Nawal Nahiyan', 'nafisnahiyan321@gmail.com'),
('4002', 73, 'Abrar Shahriar', '');

-- --------------------------------------------------------

--
-- Table structure for table `studentsenrolled`
--

CREATE TABLE `studentsenrolled` (
  `studentId` varchar(20) NOT NULL,
  `courseId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentsenrolled`
--

INSERT INTO `studentsenrolled` (`studentId`, `courseId`) VALUES
('4001', 17),
('4001', 7),
('4001', 21),
('2001', 5),
('2001', 14),
('2001', 8),
('2001', 7),
('2002', 5),
('2002', 6),
('2002', 17),
('2003', 14),
('2003', 16),
('2003', 17),
('2004', 5),
('2004', 6),
('2004', 17),
('2004', 15),
('2006', 10),
('2006', 16),
('2006', 17),
('2006', 20),
('2007', 6),
('2007', 7),
('2008', 5),
('2008', 16),
('2009', 14),
('2009', 20),
('2009', 6),
('2010', 17),
('2010', 26);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(10) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `is_admin` tinyint(4) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `is_admin`, `pass`) VALUES
(15, 'admin', 'admin@ewu.com', 1, '$2y$10$96m/2u9YJSWJevNLDnC0Ee8Om8VK4wldsSKBRkIVC1uiBJs.wg35S'),
(58, 'N3AN', '4001@ewu.com', 0, '$2y$10$Mw.PShKkWJbdfDfnV/vQW.M687GNDRwuzqRtNe.xAxhWu247HnOAO'),
(60, NULL, '2001@ewu.com', 0, '$2y$10$uj8yGAZiUVkSbUXW3.AEsON8vVifiKN8LQB2vE0.7UqusUEqD1xEC'),
(63, 'Akib', '2002@ewu.com', 0, '$2y$10$VRyGEcF44H9xSZW0yWdebecfMajsWH9b3yeRJWTKr2FL.iYGrNVjW'),
(64, '', '2003@ewu.com', 0, '$2y$10$np/6XlZqqw2OAzua0qWWfeiqCOVSEjcuBtT4nYZIyAgZjdpsI08HS'),
(65, 'Rifa', '2004@ewu.com', 0, '$2y$10$3f4K5KBESKfrYwXWSZ/EQuM..JtNtlHiGw9sOoIr0Dm44GNqaYpOO'),
(67, 'Karib', '2005@ewu.com', 0, '$2y$10$Kg2dWXkuySKo.gZDdsyIMOHsUaRB8oTF4R2w7MH6yONyLTlD3LmTS'),
(68, 'Zahin', '2006@ewu.com', 0, '$2y$10$7aj5.kn4uRT4vPNPf6XTReZtJhnAa4RuL2ScA.tp.dEmw1Z1IJhne'),
(69, 'Nibir', '2007@ewu.com', 0, '$2y$10$876itUzoPc5XL/i5uQ1ECOJaMB4jgZUj1KZKYCkFONRP5ruP3G1AK'),
(70, 'Limon', '2008@ewu.com', 0, '$2y$10$rDuJl.2ekc6.tBBrbXvtDeF7151AWQ.bKIcVFRzIZ5snfkzAHC1RK'),
(71, '', '2009@ewu.com', 0, '$2y$10$NefBsNPpEXrnzkOvlc.kqO9fWqFPOC2ITCdP6rZItc5PF65dOOBDW'),
(72, 'Ibu', '2010@ewu.com', 0, '$2y$10$RzHHrSdh8iYmbeVA05hJ.eU0zBFDbzfHBlLokSOYtGJ9qTr2mQezS'),
(73, 'Niloy', '4002@ewu.com', 0, '$2y$10$4kpxEuQB48ZnVRiDLpz.PeWFS1lwuDZVTxm0p4u0EUsbzysw7ijqu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_ibfk_1` (`userId`),
  ADD KEY `attendance_ibfk_2` (`courseId`);

--
-- Indexes for table `attendanceinstance`
--
ALTER TABLE `attendanceinstance`
  ADD KEY `attendanceinstance_ibfk_2` (`attendanceId`),
  ADD KEY `attendanceinstance_ibfk_1` (`studentId`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentId`),
  ADD KEY `student_ibfk_1` (`userId`);

--
-- Indexes for table `studentsenrolled`
--
ALTER TABLE `studentsenrolled`
  ADD KEY `studentsenrolled_ibfk_1` (`studentId`),
  ADD KEY `studentsenrolled_ibfk_2` (`courseId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`courseId`) REFERENCES `course` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attendanceinstance`
--
ALTER TABLE `attendanceinstance`
  ADD CONSTRAINT `attendanceinstance_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `student` (`studentId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `attendanceinstance_ibfk_2` FOREIGN KEY (`attendanceId`) REFERENCES `attendance` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `studentsenrolled`
--
ALTER TABLE `studentsenrolled`
  ADD CONSTRAINT `studentsenrolled_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `student` (`studentId`) ON DELETE CASCADE,
  ADD CONSTRAINT `studentsenrolled_ibfk_2` FOREIGN KEY (`courseId`) REFERENCES `course` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
