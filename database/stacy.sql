-- MySQL dump 10.14  Distrib 5.5.65-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: stacy
-- ------------------------------------------------------
-- Server version	5.5.65-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `levels`
--

DROP TABLE IF EXISTS `levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `levels` (
  `levelId` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) NOT NULL,
  `levelDescription` text NOT NULL,
  `levelName` varchar(50) NOT NULL,
  `passingRate` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`levelId`),
  UNIQUE KEY `level` (`level`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `levels`
--

LOCK TABLES `levels` WRITE;
/*!40000 ALTER TABLE `levels` DISABLE KEYS */;
INSERT INTO `levels` VALUES (4,1,'First level,\r\nFor P1 students.','First Level',40,1,'2020-09-05 00:00:00','2020-09-05 14:43:31'),(5,2,'1st level','1st',50,1,'2020-09-05 15:27:49','2020-09-05 15:27:49'),(8,4,'1st level','1st',50,1,'2020-09-06 08:01:29','2020-09-06 08:01:29'),(12,6,'This is the sixth level','Sixth Level',100,1,'2020-09-06 08:27:48','2020-09-06 08:27:48'),(15,7,'Sixth Level','Sixth Level',50,1,'2020-09-06 08:30:47','2020-09-06 08:30:47');
/*!40000 ALTER TABLE `levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outboundsms`
--

DROP TABLE IF EXISTS `outboundsms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `outboundsms` (
  `outboundSMSID` int(11) NOT NULL AUTO_INCREMENT,
  `MSISDN` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`outboundSMSID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outboundsms`
--

LOCK TABLES `outboundsms` WRITE;
/*!40000 ALTER TABLE `outboundsms` DISABLE KEYS */;
INSERT INTO `outboundsms` VALUES (8,'+250788594828','Your PIN is : 5727',0,'2020-09-05 15:23:00','2020-09-05 15:23:00'),(9,'+250788594000','Your PIN is : 5318',0,'2020-09-06 04:14:32','2020-09-06 04:14:32'),(10,'+250788594001','Your PIN is : 9316',0,'2020-09-06 04:34:55','2020-09-06 04:34:55'),(11,'+250788594002','Your PIN is : 2195',0,'2020-09-06 05:07:40','2020-09-06 05:07:40'),(12,'+250784657837','Your PIN is : 2953',0,'2020-09-06 05:09:51','2020-09-06 05:09:51'),(13,'+250788888888','Your PIN is : 9615',0,'2020-09-06 05:11:14','2020-09-06 05:11:14'),(14,'+250785678498','Your PIN is : 4071',0,'2020-09-06 05:12:00','2020-09-06 05:12:00'),(15,'+250788864545','Your PIN is : 3437',0,'2020-09-06 07:32:37','2020-09-06 07:32:37'),(16,'+250788202020','Your PIN is : 6033',0,'2020-09-06 10:03:02','2020-09-06 10:03:02');
/*!40000 ALTER TABLE `outboundsms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizes`
--

DROP TABLE IF EXISTS `quizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quizes` (
  `QId` int(11) NOT NULL AUTO_INCREMENT,
  `levelId` int(11) NOT NULL,
  `type` enum('multiChoice','singleChoice') NOT NULL,
  `question` varchar(100) NOT NULL,
  `answer` varchar(50) NOT NULL,
  `response` varchar(50) NOT NULL,
  `marks` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`QId`),
  KEY `levelId` (`levelId`),
  CONSTRAINT `quizes_ibfk_1` FOREIGN KEY (`levelId`) REFERENCES `levels` (`levelId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizes`
--

LOCK TABLES `quizes` WRITE;
/*!40000 ALTER TABLE `quizes` DISABLE KEYS */;
INSERT INTO `quizes` VALUES (3,4,'singleChoice','east african countries','[\'Rwanda\',\'Kenya\']','Rwanda',10,1,'2020-09-05 15:22:37','2020-09-05 15:22:37'),(4,4,'singleChoice','east african countries','[\'Rwanda\',\'Kenya\']','Rwanda',10,1,'2020-09-06 06:02:44','2020-09-06 06:02:44'),(5,4,'singleChoice','african countries','[\'Rwanda\']','Rwanda',10,1,'2020-09-06 06:03:24','2020-09-06 06:03:24'),(6,4,'multiChoice','african countries','[\'Rwanda\']','Rwanda',10,1,'2020-09-06 06:06:09','2020-09-06 06:06:09'),(7,4,'multiChoice','african countries','[Rwanda, Congo, Tanzania]','Rwanda',10,1,'2020-09-06 06:11:05','2020-09-06 06:11:05'),(9,4,'singleChoice','african countries','[\'Rwanda\']','Rwanda',10,1,'2020-09-06 06:16:59','2020-09-06 06:16:59'),(10,4,'singleChoice','Question 1','[\"Response 1\"]','Response 1',50,1,'2020-09-06 06:19:28','2020-09-06 06:19:28'),(11,4,'multiChoice','Question 1','[Response 1]','Response 1, Response 2, Response 3, Response 4',50,1,'2020-09-06 06:19:46','2020-09-06 06:19:46'),(12,4,'multiChoice','Question 1','[Response 1, Response 2, Response 3, Response 4]','Response 1',50,1,'2020-09-06 06:20:05','2020-09-06 06:20:05'),(13,4,'singleChoice','Question here','[\"Answer here\"]','Answer here',50,1,'2020-09-06 07:45:56','2020-09-06 07:45:56'),(14,4,'multiChoice','Question here','[Answer here 1, Answer here2, Answer here3]','Answer here 1',100,1,'2020-09-06 07:46:33','2020-09-06 07:46:33'),(15,4,'multiChoice','what are the most sensible part of the body to pain','[the front knee,the back]','the front knee',15,1,'2020-09-06 07:50:32','2020-09-06 07:50:32'),(16,4,'multiChoice','how old is the president of Rwanda','[56,57,58]','56',10,1,'2020-09-06 10:04:51','2020-09-06 10:04:51');
/*!40000 ALTER TABLE `quizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `stdId` int(11) NOT NULL AUTO_INCREMENT,
  `stdFname` varchar(50) NOT NULL,
  `stdLname` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `MSISDN` varchar(50) NOT NULL,
  `levelId` int(11) NOT NULL,
  `passwordHash` varchar(100) NOT NULL,
  `type` enum('students','admin') NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`stdId`),
  KEY `levelId` (`levelId`),
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`levelId`) REFERENCES `levels` (`level`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Stacy','Kayihura',23,'+250788594828',1,'$argon2i$v=19$m=65536,t=4,p=1$OD1GMhL8RyFr56XLWPBBqw$D7dwpl+Dp7phElWcmfWNms8rA0S5unca4TqOOk+6R58','students',1,'2020-09-05 15:23:00','2020-09-05 15:23:00'),(3,'System','Admin',50,'+250788594000',1,'$argon2i$v=19$m=65536,t=4,p=1$jA57rRKEY2KOUhqCD4VwxQ$k7J/6IFXhoy8bvVFh66i8JdvZlbGsQAv7aizlmWv68E','admin',1,'2020-09-06 04:14:32','2020-09-06 04:14:32'),(4,'Harerimana','Jean',30,'+250788594001',1,'$argon2i$v=19$m=65536,t=4,p=1$tfCsWRZfXtRGrOdwQ6LxWg$UDy2CLFjlfjkIsGzqqbKPCDVr1u9u7GH6OnjSewl1C8','admin',1,'2020-09-06 04:34:55','2020-09-06 04:34:55'),(5,'Abayo','Jean Claude',30,'+250788594002',1,'$argon2i$v=19$m=65536,t=4,p=1$Y6SkV2wZX4QCZLsAx+bsNw$k1hOHUNR3uDVv0Wigm/RWGpYWe9urWK4w1qKW603nj0','admin',1,'2020-09-06 05:07:40','2020-09-06 05:07:40'),(6,'Uwamariya','Jeanne',29,'+250784657837',1,'$argon2i$v=19$m=65536,t=4,p=1$OapbrIw9MA/2bkj/eLCY0Q$MdY1AR1pA3lzhZSteAx2/BxONnQwV76vCnBeFQf7I/w','students',1,'2020-09-06 05:09:51','2020-09-06 05:09:51'),(7,'Byusa','Jean Claude',25,'+250788888888',1,'$argon2i$v=19$m=65536,t=4,p=1$BDKevZhzNwBEt2F5bsaAxQ$AJobADKOCQenIndLUlpr9HFrrUrX3DJotXjCISVF3co','students',1,'2020-09-06 05:11:14','2020-09-06 05:11:14'),(8,'Nuwayo','Jean Damascene',25,'+250785678498',1,'$argon2i$v=19$m=65536,t=4,p=1$A6TzE+OU7PtwDsWiJ+rOvg$4NwSs8r6vfbh5BCAQyCc9ujO5jn/Ok3zzoB3II0w010','admin',1,'2020-09-06 05:12:00','2020-09-06 05:12:00'),(10,'Gaella ','KAYIHURA',11,'+250788864545',1,'$argon2i$v=19$m=65536,t=4,p=1$5zpf8BdRAFCyacVNHTbigw$0SgzOphs29VOJaWsv//h5F3tIWj1wEBtbn/h7gN2JLI','students',1,'2020-09-06 07:32:37','2020-09-06 07:32:37'),(11,'Angelique ','Uwamahoro',21,'+250788202020',1,'$argon2i$v=19$m=65536,t=4,p=1$NbZNCJQsVWBgpX35dBf4bA$hFr/GQYUWT85kMdGEOXI2mh63ok1+aJljPz0j3BR8sU','students',1,'2020-09-06 10:03:02','2020-09-06 10:03:02');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-07 11:19:09
