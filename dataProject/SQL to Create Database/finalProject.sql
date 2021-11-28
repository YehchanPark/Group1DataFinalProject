CREATE DATABASE  IF NOT EXISTS `finalproject` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `finalproject`;
-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: finalproject
-- ------------------------------------------------------
-- Server version	8.0.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movies` (
  `movieID` int NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `genre` varchar(45) DEFAULT NULL,
  `running_time` int DEFAULT NULL,
  `start_time` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`movieID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movies`
--

LOCK TABLES `movies` WRITE;
/*!40000 ALTER TABLE `movies` DISABLE KEYS */;
INSERT INTO `movies` VALUES (1160419,'Dune','Sci-Fi',120,'10:00AM'),(1216475,'Cars 2','Animation, Adventure, Comedy',106,'3:45 pm'),(2382320,'No time to die','Spy',120,'8:00PM'),(2953050,'Encanto','Animation, Adventure, Comedy',0,'7:45PM'),(5433138,'F9','Racing',120,'5:30PM'),(6264654,'Free Guy','Action, Adventure, Comedy',115,'6:45PM'),(7097896,'Venom','Action',120,'3:00PM'),(9032400,'Eternals','Action',120,'12:30PM'),(9376612,'Shang-Chi','Action',120,'10:30PM');
/*!40000 ALTER TABLE `movies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation` (
  `reservationID` int NOT NULL AUTO_INCREMENT,
  `userid` int DEFAULT NULL,
  `roomid` int DEFAULT NULL,
  `theatreid` int DEFAULT NULL,
  `movieid` int DEFAULT NULL,
  `purchasedate` date DEFAULT NULL,
  `amountSeats` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  `seatNum` int DEFAULT NULL,
  PRIMARY KEY (`reservationID`),
  KEY `userID_idx` (`userid`),
  KEY `roomID_idx` (`roomid`),
  KEY `theatreID_idx` (`theatreid`),
  KEY `movieID_idx` (`movieid`),
  CONSTRAINT `movieID` FOREIGN KEY (`movieid`) REFERENCES `movies` (`movieID`),
  CONSTRAINT `roomID` FOREIGN KEY (`roomid`) REFERENCES `room` (`roomid`),
  CONSTRAINT `theatreID` FOREIGN KEY (`theatreid`) REFERENCES `theatre` (`theatreID`),
  CONSTRAINT `userID` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (1,1,1,1,1160419,'2021-11-06',2,24,305),(2,2,2,1,1160419,'2021-11-06',3,36,405),(3,3,1,2,9032400,'2021-11-06',4,48,505),(4,4,2,2,9032400,'2021-11-06',5,60,605),(5,1,1,3,9376612,'2021-11-06',1,12,405),(6,6,2,3,9376612,'2021-11-06',2,24,305),(7,3,1,1,1160419,'2021-11-06',1,12,605),(8,4,2,1,1160419,'2021-11-07',5,60,105),(15,6,1,1,1160419,'2021-11-29',1,12,560),(16,1,1,1,1160419,'2021-11-27',1,12,580),(17,1,1,1,1160419,'2021-11-29',1,12,305);
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `room` (
  `roomid` int NOT NULL,
  `theatreid` int NOT NULL,
  PRIMARY KEY (`roomid`,`theatreid`),
  KEY `theatreidroom_idx` (`theatreid`),
  CONSTRAINT `theatreidroom` FOREIGN KEY (`theatreid`) REFERENCES `theatre` (`theatreID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (1,1),(2,1),(1,2),(2,2),(1,3),(2,3),(1,4),(1,5),(1,6),(1,11);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theatre`
--

DROP TABLE IF EXISTS `theatre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `theatre` (
  `theatreID` int NOT NULL,
  `city` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`theatreID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theatre`
--

LOCK TABLES `theatre` WRITE;
/*!40000 ALTER TABLE `theatre` DISABLE KEYS */;
INSERT INTO `theatre` VALUES (1,'Whitby'),(2,'Oshawa'),(3,'Oshawa'),(4,'Ajax'),(5,'Ajax'),(6,'Toronto'),(11,'Toronto');
/*!40000 ALTER TABLE `theatre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `userid` int NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `email` varchar(95) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John','Doe','john@email.ca','password'),(2,'Mary','Jane','mary@email.ca','password'),(3,'Yehchan','Park','yehchan@email.ca','password'),(4,'Cyrus','Lee','cyrus@email.ca','password'),(5,'Peter','Parker','peter@email.ca','password'),(6,'Banujan','Sutheswaran','banujan@email.ca','password'),(7,'Lorenzo','Caguimbal','lorenzo@email.ca','password'),(8,'Deepak','Thangella','email@email.ca','password'),(9999,'admin','admin','admin@email.ca','admin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-28 15:49:25
