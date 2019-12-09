-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: is371-db.cnykv8ixtpod.us-west-2.rds.amazonaws.com    Database: is371_db
-- ------------------------------------------------------
-- Server version	5.5.46

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
-- Table structure for table `fac_courses`
--

DROP TABLE IF EXISTS `fac_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fac_courses` (
  `fac_id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `index` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fac_courses_FK` (`fac_id`),
  CONSTRAINT `fac_courses_FK` FOREIGN KEY (`fac_id`) REFERENCES `faculty` (`fac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fac_courses`
--

LOCK TABLES `fac_courses` WRITE;
/*!40000 ALTER TABLE `fac_courses` DISABLE KEYS */;
INSERT INTO `fac_courses` VALUES (2,'IS371',1,0);
/*!40000 ALTER TABLE `fac_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fac_degrees`
--

DROP TABLE IF EXISTS `fac_degrees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fac_degrees` (
  `fac_id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `index` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fac_degrees_FK` (`fac_id`),
  CONSTRAINT `fac_degrees_FK` FOREIGN KEY (`fac_id`) REFERENCES `faculty` (`fac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fac_degrees`
--

LOCK TABLES `fac_degrees` WRITE;
/*!40000 ALTER TABLE `fac_degrees` DISABLE KEYS */;
INSERT INTO `fac_degrees` VALUES (2,'M.S. Computer Science',7,0);
/*!40000 ALTER TABLE `fac_degrees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faculty` (
  `fac_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `position` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`fac_id`),
  KEY `faculty_FK` (`uid`),
  CONSTRAINT `faculty_FK` FOREIGN KEY (`uid`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculty`
--

LOCK TABLES `faculty` WRITE;
/*!40000 ALTER TABLE `faculty` DISABLE KEYS */;
INSERT INTO `faculty` VALUES (1,2,'Professor Emeritus of Marketing'),(2,6,'Professor'),(3,7,'Professor');
/*!40000 ALTER TABLE `faculty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fac_publications`
--

DROP TABLE IF EXISTS `fac_publications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fac_publications` (
  `fac_id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `index` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fac_degrees_FK` (`fac_id`) USING BTREE,
  CONSTRAINT `fac_degrees_FK_copy` FOREIGN KEY (`fac_id`) REFERENCES `faculty` (`fac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fac_publications`
--

LOCK TABLES `fac_publications` WRITE;
/*!40000 ALTER TABLE `fac_publications` DISABLE KEYS */;
INSERT INTO `fac_publications` VALUES (2,'Business Driven Technology by Paige Baltzan, Stephen Haag, Amy Phillips',2,1),(2,'Introduction to Project Management  by Mark Cotteleer',3,2),(2,'Health Information Management Technology: An Applied Approach  by Peter R',4,0);
/*!40000 ALTER TABLE `fac_publications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `student_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fac_id` int(10) unsigned NOT NULL,
  `student_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointments_FK` (`fac_id`),
  CONSTRAINT `appointments_FK` FOREIGN KEY (`fac_id`) REFERENCES `faculty` (`fac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (9,'2019-12-10 17:00:00','2019-12-10 17:30:00',NULL,2,NULL),(10,'2019-12-10 17:30:00','2019-12-10 18:00:00',NULL,2,NULL);
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(20) NOT NULL DEFAULT '',
  `admin` char(3) NOT NULL DEFAULT 'NO',
  `prefix` varchar(5) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL DEFAULT '',
  `last_name` varchar(50) NOT NULL DEFAULT '',
  `street` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zip` int(5) DEFAULT '0',
  `phone` int(10) DEFAULT '0',
  `cell` int(10) DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '',
  `active` char(3) NOT NULL DEFAULT 'YES',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','password','YES',NULL,'Administrator','','','','',0,0,0,'','YES'),(2,'jonny','integra','NO','Mr.','Jonathan','Ogden','1327 W. Kilbourn Ave','Milwaukee','WI',53233,419,123,'JOgden@buckeye-express.com','YES'),(6,'username','password','NO','Dr.','John','Doe','1327 W. Kilbourn Ave','Milwaukee','WI',53233,5498,0,'test@wisc.edu','YES'),(7,'username2','password','NO','Dr.','Doe','John','1327 W. Kilbourn Ave','Milwaukee','WI',53233,5498,0,'test2@wisc.edu','YES');
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

-- Dump completed on 2019-12-09  3:16:07
