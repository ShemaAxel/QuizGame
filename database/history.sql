-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 14, 2020 at 09:49 AM
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
(2, 1, 100, 100, '[{\"QId\":17,\"levelId\":1,\"type\":\"multiChoice\",\"question\":\"east african countries\",\"answer\":\"[\'Rwanda\',\'Kenya\']\",\"response\":\"[\'Rwanda\',\'Kenya\']\",\"marks\":10,\"status\":1,\"dateCreated\":\"2020-09-07T11:40:50.000000Z\",\"dateModified\":\"2020-09-15T20:18:38.000000Z\",\"passed\":true,\"answered\":\"[\'Rwanda\',\'Kenya\']\"},{\"QId\":18,\"levelId\":1,\"type\":\"singleChoice\",\"question\":\"\",\"answer\":\"s\",\"response\":\"s\",\"marks\":90,\"status\":1,\"dateCreated\":\"2020-09-11T00:00:00.000000Z\",\"dateModified\":\"2020-09-15T20:19:29.000000Z\",\"passed\":true,\"answered\":\"s\"}]', 2, '2020-10-14 13:43:29', '2020-10-14 13:43:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`historyId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `historyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
