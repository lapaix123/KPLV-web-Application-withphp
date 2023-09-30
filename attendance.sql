-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2023 at 01:51 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kplv_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceNo` int(11) NOT NULL,
  `vistor` int(11) NOT NULL,
  `reason` int(11) NOT NULL,
  `belongs` varchar(300) NOT NULL,
  `enterTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `exitTime` timestamp NULL DEFAULT NULL,
  `session` int(11) NOT NULL,
  `VistorAttendanceCode` int(11) NOT NULL,
  `bookOut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceNo`, `vistor`, `reason`, `belongs`, `enterTime`, `exitTime`, `session`, `VistorAttendanceCode`, `bookOut`) VALUES
(52, 2023464, 12, 'ewe', '2023-08-27 20:21:04', NULL, 31, 26514, 0),
(53, 2023516, 12, 'ghg', '2023-08-27 22:00:27', '2023-08-27 22:51:42', 61, 56818, 0),
(54, 2023516, 12, 'ewana', '2023-08-27 22:02:36', '2023-08-27 23:21:30', 61, 45327, 5),
(55, 2023516, 12, 'ewana', '2023-08-27 22:03:11', '2023-08-27 23:47:52', 61, 69879, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceNo`),
  ADD KEY `attendance_ibfk_2` (`vistor`),
  ADD KEY `reason` (`reason`),
  ADD KEY `session` (`session`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`vistor`) REFERENCES `vistors` (`vistorCode`),
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`reason`) REFERENCES `event` (`eCode`),
  ADD CONSTRAINT `attendance_ibfk_4` FOREIGN KEY (`session`) REFERENCES `session` (`sCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
