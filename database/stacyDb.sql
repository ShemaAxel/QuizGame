-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 26, 2020 at 06:06 AM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

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
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `historyId` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `average` double NOT NULL,
  `points` double NOT NULL,
  `data` text NOT NULL,
  `level` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`historyId`, `studentId`, `average`, `points`, `data`, `level`, `dateCreated`, `dateModified`) VALUES
(1, 1, 100, 100, 'Ok', 2, '2020-10-14 13:37:09', '2020-10-14 13:37:09'),
(2, 1, 100, 100, '[{\"QId\":17,\"levelId\":1,\"type\":\"multiChoice\",\"question\":\"east african countries\",\"answer\":\"[\'Rwanda\',\'Kenya\']\",\"response\":\"[\'Rwanda\',\'Kenya\']\",\"marks\":10,\"status\":1,\"dateCreated\":\"2020-09-07T11:40:50.000000Z\",\"dateModified\":\"2020-09-15T20:18:38.000000Z\",\"passed\":true,\"answered\":\"[\'Rwanda\',\'Kenya\']\"},{\"QId\":18,\"levelId\":1,\"type\":\"singleChoice\",\"question\":\"\",\"answer\":\"s\",\"response\":\"s\",\"marks\":90,\"status\":1,\"dateCreated\":\"2020-09-11T00:00:00.000000Z\",\"dateModified\":\"2020-09-15T20:19:29.000000Z\",\"passed\":true,\"answered\":\"s\"}]', 2, '2020-10-14 13:43:29', '2020-10-14 13:43:29'),
(3, 1, 50, 50, '[{\"QId\":17,\"levelId\":1,\"type\":\"multiChoice\",\"question\":\"east african countries\",\"answer\":\"[\'Rwanda\',\'Kenya\']\",\"response\":\"[\'Rwanda\',\'Kenya\']\",\"marks\":50,\"status\":1,\"dateCreated\":\"2020-09-07T11:40:50.000000Z\",\"dateModified\":\"2020-10-14T14:13:23.000000Z\",\"passed\":true,\"answered\":\"[\'Rwanda\',\'Kenya\']\"},{\"QId\":18,\"levelId\":1,\"type\":\"singleChoice\",\"question\":\"\",\"answer\":\"s\",\"response\":\"s\",\"marks\":50,\"status\":1,\"dateCreated\":\"2020-09-11T00:00:00.000000Z\",\"dateModified\":\"2020-10-14T14:13:17.000000Z\",\"passed\":false,\"answered\":\"t\"}]', 2, '2020-10-14 14:13:26', '2020-10-14 14:13:26'),
(4, 1, 54.545454545455, 60, '[{\"QId\":17,\"levelId\":1,\"type\":\"multiChoice\",\"question\":\"east african countries\",\"answer\":\"[\'Rwanda\',\'Kenya\']\",\"response\":\"[\'Rwanda\',\'Kenya\']\",\"marks\":50,\"status\":1,\"dateCreated\":\"2020-09-07T11:40:50.000000Z\",\"dateModified\":\"2020-10-14T14:13:23.000000Z\",\"passed\":true,\"answered\":\"[\'Rwanda\',\'Kenya\']\"},{\"QId\":18,\"levelId\":1,\"type\":\"singleChoice\",\"question\":\"\",\"answer\":\"s\",\"response\":\"s\",\"marks\":50,\"status\":1,\"dateCreated\":\"2020-09-11T00:00:00.000000Z\",\"dateModified\":\"2020-10-14T14:13:17.000000Z\",\"passed\":false,\"answered\":\"t\"},{\"QId\":19,\"levelId\":1,\"type\":\"multiChoice\",\"question\":\"east african countries\",\"answer\":\"[\'Rwanda\',\'Kenya\']\",\"response\":\"Rwanda\",\"marks\":10,\"status\":1,\"dateCreated\":\"2020-10-14T12:48:27.000000Z\",\"dateModified\":\"2020-10-14T12:48:27.000000Z\",\"passed\":true,\"answered\":\"Rwanda\"}]', 2, '2020-10-14 14:14:57', '2020-10-14 14:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `levelId` int(11) NOT NULL,
  `level` int(11) NOT NULL,
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

INSERT INTO `levels` (`levelId`, `level`, `levelDescription`, `levelName`, `passingRate`, `status`, `dateCreated`, `dateModified`) VALUES
(4, 1, 'This level is for P1 students. Includes (Geography,Math etc)', 'Newbies', 40, 1, '2020-09-05 00:00:00', '2020-09-07 09:29:27'),
(5, 2, 'Test', 'test', 10, 1, '2020-10-14 00:00:00', '2020-10-14 11:26:01');

-- --------------------------------------------------------

--
-- Table structure for table `outboundsms`
--

CREATE TABLE `outboundsms` (
  `outboundSMSID` int(11) NOT NULL,
  `MSISDN` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outboundsms`
--

INSERT INTO `outboundsms` (`outboundSMSID`, `MSISDN`, `message`, `status`, `dateCreated`, `dateModified`) VALUES
(8, '+250788594828', 'Your PIN is : 5727', 0, '2020-09-05 15:23:00', '2020-09-05 15:23:00'),
(9, '+250788594000', 'Your PIN is : 5318', 0, '2020-09-06 04:14:32', '2020-09-06 04:14:32'),
(10, '+250788594001', 'Your PIN is : 9316', 0, '2020-09-06 04:34:55', '2020-09-06 04:34:55'),
(11, '+250788594002', 'Your PIN is : 2195', 0, '2020-09-06 05:07:40', '2020-09-06 05:07:40'),
(12, '+250784657837', 'Your PIN is : 2953', 0, '2020-09-06 05:09:51', '2020-09-06 05:09:51'),
(13, '+250788888888', 'Your PIN is : 9615', 0, '2020-09-06 05:11:14', '2020-09-06 05:11:14'),
(14, '+250785678498', 'Your PIN is : 4071', 0, '2020-09-06 05:12:00', '2020-09-06 05:12:00'),
(15, '+250788864545', 'Your PIN is : 3437', 0, '2020-09-06 07:32:37', '2020-09-06 07:32:37'),
(16, '+250788202020', 'Your PIN is : 6033', 0, '2020-09-06 10:03:02', '2020-09-06 10:03:02');

-- --------------------------------------------------------

--
-- Table structure for table `quizes`
--

CREATE TABLE `quizes` (
  `QId` int(11) NOT NULL,
  `levelId` int(11) NOT NULL,
  `type` enum('multiChoice','singleChoice') NOT NULL,
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
(17, 1, 'multiChoice', 'east african countries', '[\'Rwanda\',\'Kenya\']', '[\'Rwanda\',\'Kenya\']', 50, 1, '2020-09-07 11:40:50', '2020-10-14 14:13:23'),
(18, 1, 'singleChoice', '', 's', 's', 50, 1, '2020-09-11 00:00:00', '2020-10-14 14:13:17'),
(19, 1, 'multiChoice', 'east african countries', '[\'Rwanda\',\'Kenya\']', 'Rwanda', 10, 1, '2020-10-14 12:48:27', '2020-10-14 12:48:27');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stdId` int(11) NOT NULL,
  `stdFname` varchar(50) NOT NULL,
  `stdLname` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `MSISDN` varchar(50) NOT NULL,
  `levelId` int(11) NOT NULL,
  `passwordHash` varchar(100) NOT NULL,
  `type` enum('students','admin') NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stdId`, `stdFname`, `stdLname`, `age`, `MSISDN`, `levelId`, `passwordHash`, `type`, `status`, `dateCreated`, `dateModified`) VALUES
(1, 'Stacy', 'Kayihura', 23, '+250788594828', 2, '$argon2i$v=19$m=65536,t=4,p=1$OD1GMhL8RyFr56XLWPBBqw$D7dwpl+Dp7phElWcmfWNms8rA0S5unca4TqOOk+6R58', 'students', 1, '2020-09-05 15:23:00', '2020-10-14 14:14:57'),
(3, 'System', 'Admin', 50, '+250788594000', 1, '$argon2i$v=19$m=65536,t=4,p=1$jA57rRKEY2KOUhqCD4VwxQ$k7J/6IFXhoy8bvVFh66i8JdvZlbGsQAv7aizlmWv68E', 'admin', 1, '2020-09-06 04:14:32', '2020-09-06 04:14:32'),
(4, 'Harerimana', 'Jean', 30, '+250788594001', 1, '$argon2i$v=19$m=65536,t=4,p=1$tfCsWRZfXtRGrOdwQ6LxWg$UDy2CLFjlfjkIsGzqqbKPCDVr1u9u7GH6OnjSewl1C8', 'admin', 1, '2020-09-06 04:34:55', '2020-09-06 04:34:55'),
(5, 'Abayo', 'Jean Claude', 30, '+250788594002', 1, '$argon2i$v=19$m=65536,t=4,p=1$Y6SkV2wZX4QCZLsAx+bsNw$k1hOHUNR3uDVv0Wigm/RWGpYWe9urWK4w1qKW603nj0', 'admin', 1, '2020-09-06 05:07:40', '2020-09-06 05:07:40'),
(6, 'Uwamariya', 'Jeanne', 29, '+250784657837', 1, '$argon2i$v=19$m=65536,t=4,p=1$OapbrIw9MA/2bkj/eLCY0Q$MdY1AR1pA3lzhZSteAx2/BxONnQwV76vCnBeFQf7I/w', 'students', 1, '2020-09-06 05:09:51', '2020-09-06 05:09:51'),
(7, 'Byusa', 'Jean Claude', 25, '+250788888888', 1, '$argon2i$v=19$m=65536,t=4,p=1$BDKevZhzNwBEt2F5bsaAxQ$AJobADKOCQenIndLUlpr9HFrrUrX3DJotXjCISVF3co', 'students', 1, '2020-09-06 05:11:14', '2020-09-06 05:11:14'),
(8, 'Nuwayo', 'Jean Damascene', 25, '+250785678498', 1, '$argon2i$v=19$m=65536,t=4,p=1$A6TzE+OU7PtwDsWiJ+rOvg$4NwSs8r6vfbh5BCAQyCc9ujO5jn/Ok3zzoB3II0w010', 'admin', 1, '2020-09-06 05:12:00', '2020-09-06 05:12:00'),
(10, 'Gaella ', 'KAYIHURA', 11, '+250788864545', 1, '$argon2i$v=19$m=65536,t=4,p=1$5zpf8BdRAFCyacVNHTbigw$0SgzOphs29VOJaWsv//h5F3tIWj1wEBtbn/h7gN2JLI', 'students', 1, '2020-09-06 07:32:37', '2020-09-06 07:32:37'),
(11, 'Angelique ', 'Uwamahoro', 21, '+250788202020', 1, '$argon2i$v=19$m=65536,t=4,p=1$NbZNCJQsVWBgpX35dBf4bA$hFr/GQYUWT85kMdGEOXI2mh63ok1+aJljPz0j3BR8sU', 'students', 1, '2020-09-06 10:03:02', '2020-09-06 10:03:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`historyId`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`levelId`),
  ADD UNIQUE KEY `level` (`level`);

--
-- Indexes for table `outboundsms`
--
ALTER TABLE `outboundsms`
  ADD PRIMARY KEY (`outboundSMSID`);

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
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `historyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `levelId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `outboundsms`
--
ALTER TABLE `outboundsms`
  MODIFY `outboundSMSID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `quizes`
--
ALTER TABLE `quizes`
  MODIFY `QId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `stdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `quizes`
--
ALTER TABLE `quizes`
  ADD CONSTRAINT `quizes_ibfk_1` FOREIGN KEY (`levelId`) REFERENCES `levels` (`level`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`levelId`) REFERENCES `levels` (`level`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
