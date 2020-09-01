-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 01, 2020 at 07:13 AM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stacyDb`
--

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `levelId` int(11) NOT NULL,
  `levelDescription` text NOT NULL,
  `levelName` varchar(50) NOT NULL,
  `passingRate` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`levelId`, `levelDescription`, `levelName`, `passingRate`, `status`, `dateCreated`, `dateModified`) VALUES
(1, 'Just a level', 'level1', 40, 1, '2020-08-31 00:00:00', '2020-09-01 11:10:46'),
(2, '2nd', '2nd', 0, 1, '2020-08-31 19:25:43', '2020-08-31 19:25:43'),
(3, '3nd', '3nd', 80, 1, '2020-09-01 06:49:51', '2020-09-01 06:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `quizes`
--

CREATE TABLE `quizes` (
  `QId` int(11) NOT NULL,
  `levelId` int(11) NOT NULL,
  `type` enum('multiChoices') NOT NULL,
  `question` varchar(100) NOT NULL,
  `answer` varchar(50) NOT NULL,
  `response` varchar(50) NOT NULL,
  `marks` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizes`
--

INSERT INTO `quizes` (`QId`, `levelId`, `type`, `question`, `answer`, `response`, `marks`, `status`, `dateCreated`, `dateModified`) VALUES
(1, 1, 'multiChoices', 's', 's', 's', 10, 1, '2020-08-31 19:15:43', '2020-08-31 19:15:43'),
(2, 1, 'multiChoices', 'b', 'b', 'b', 10, 1, '2020-09-01 00:00:00', '2020-09-01 11:11:01');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stdId` int(11) NOT NULL,
  `stdFname` varchar(50) NOT NULL,
  `stdLname` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `levelId` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stdId`, `stdFname`, `stdLname`, `age`, `levelId`, `status`, `dateCreated`, `dateModified`) VALUES
(1, 'Axel', 'SHEMA Romeo', 23, 2, 1, '2020-08-31 19:00:41', '2020-09-01 11:11:20'),
(2, 'Axel', 'SHEMA Romeo', 23, 1, 1, '2020-08-31 19:00:56', '2020-08-31 19:00:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`levelId`);

--
-- Indexes for table `quizes`
--
ALTER TABLE `quizes`
  ADD PRIMARY KEY (`QId`),
  ADD KEY `levelId` (`levelId`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`stdId`),
  ADD KEY `levelId` (`levelId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `levelId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `quizes`
--
ALTER TABLE `quizes`
  MODIFY `QId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `stdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `quizes`
--
ALTER TABLE `quizes`
  ADD CONSTRAINT `quizes_ibfk_1` FOREIGN KEY (`levelId`) REFERENCES `levels` (`levelId`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`levelId`) REFERENCES `levels` (`levelId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
