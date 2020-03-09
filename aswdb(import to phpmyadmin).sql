-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2020 at 06:35 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aswdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `Id` int(11) NOT NULL,
  `StudentId` int(11) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `Entry` int(11) NOT NULL,
  `ScanTime` datetime NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `Id` int(11) NOT NULL,
  `SectionId` int(11) NOT NULL,
  `ClassDate` date NOT NULL,
  `ClassType` int(11) NOT NULL,
  `StartTimeId` int(11) NOT NULL,
  `EndTimeId` int(11) NOT NULL,
  `RoomNo` text NOT NULL,
  `QRCode` text NOT NULL,
  `QRDisplayStartTime` datetime NOT NULL,
  `QRDisplayEndTime` datetime NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `classtimes`
--

CREATE TABLE `classtimes` (
  `Id` int(11) NOT NULL,
  `ClassTimeText` text NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classtimes`
--

INSERT INTO `classtimes` (`Id`, `ClassTimeText`, `CreatedAt`) VALUES
(0, '8:00', '2020-03-09 13:44:25'),
(1, '8:30', '2020-03-09 13:45:04'),
(2, '9:00', '2020-03-09 13:47:38'),
(3, '9:30', '2020-03-09 13:47:38'),
(4, '10:00', '2020-03-09 13:47:38'),
(5, '10:30', '2020-03-09 13:47:38'),
(6, '11:00', '2020-03-09 13:47:38'),
(7, '11:30', '2020-03-09 13:47:38'),
(8, '12:00', '2020-03-09 13:47:38'),
(9, '12:30', '2020-03-09 13:47:38'),
(10, '1:00', '2020-03-09 13:47:38'),
(11, '1:30', '2020-03-09 13:47:38'),
(12, '2:00', '2020-03-09 13:47:38'),
(13, '2:30', '2020-03-09 13:47:38'),
(14, '3:00', '2020-03-09 13:47:38'),
(15, '3:30', '2020-03-09 13:47:38'),
(16, '4:00', '2020-03-09 13:47:38'),
(17, '4:30', '2020-03-09 13:47:38'),
(18, '5:00', '2020-03-09 13:47:38'),
(19, '5:30', '2020-03-09 13:47:38'),
(20, '6:00', '2020-03-09 13:47:38'),
(21, '6:30', '2020-03-09 13:47:38'),
(22, '7:00', '2020-03-09 13:47:38'),
(23, '7:30', '2020-03-09 13:47:38'),
(24, '8:00', '2020-03-09 13:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `Id` int(11) NOT NULL,
  `SectionName` text NOT NULL,
  `FacultyId` int(11) NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sectionstudents`
--

CREATE TABLE `sectionstudents` (
  `SectionId` int(11) NOT NULL,
  `StudentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sectiontimes`
--

CREATE TABLE `sectiontimes` (
  `Id` int(11) NOT NULL,
  `StartTimeId` int(11) NOT NULL,
  `EndTimeId` int(11) NOT NULL,
  `WeekDayId` int(11) NOT NULL,
  `ClassType` int(11) NOT NULL,
  `RoomNo` text NOT NULL,
  `SectionId` int(11) NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `AcademicId` text NOT NULL,
  `FirstName` text NOT NULL,
  `LastName` text NOT NULL,
  `Email` text DEFAULT NULL,
  `Password` text DEFAULT NULL,
  `Salt` int(11) DEFAULT NULL,
  `UserType` int(11) NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `weekdays`
--

CREATE TABLE `weekdays` (
  `Id` int(11) NOT NULL,
  `WeekDayText` text NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weekdays`
--

INSERT INTO `weekdays` (`Id`, `WeekDayText`, `CreatedAt`) VALUES
(0, 'Sunday', '2020-03-09 13:42:40'),
(1, 'Monday', '2020-03-09 13:43:49'),
(2, 'Tuesday', '2020-03-09 13:43:49'),
(3, 'Wednesday', '2020-03-09 13:43:49'),
(4, 'Thursday', '2020-03-09 13:43:49'),
(5, 'Friday', '2020-03-09 13:43:49'),
(6, 'Saturday', '2020-03-09 13:43:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `classtimes`
--
ALTER TABLE `classtimes`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `sectionstudents`
--
ALTER TABLE `sectionstudents`
  ADD PRIMARY KEY (`SectionId`,`StudentId`);

--
-- Indexes for table `sectiontimes`
--
ALTER TABLE `sectiontimes`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `ux_academicid` (`AcademicId`) USING HASH,
  ADD UNIQUE KEY `ux_email` (`Email`) USING HASH;

--
-- Indexes for table `weekdays`
--
ALTER TABLE `weekdays`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sectiontimes`
--
ALTER TABLE `sectiontimes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
