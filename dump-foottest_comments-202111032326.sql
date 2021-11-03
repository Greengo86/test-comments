-- MySQL dump 10.13  Distrib 8.0.25, for macos11 (x86_64)
--
-- Host: localhost    Database: test_comments
-- ------------------------------------------------------
-- Server version	8.0.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `test_comments`
--

DROP TABLE IF EXISTS `test_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test_comments` (
  `topic_id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT NULL,
  `body` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_comments`
--

LOCK TABLES `test_comments` WRITE;
/*!40000 ALTER TABLE `test_comments` DISABLE KEYS */;
INSERT INTO `test_comments` VALUES (1,NULL,'Комментарииииий','2021-10-30 11:39:02'),(2,NULL,'Комментарииииий444','2021-10-30 11:40:42'),(3,NULL,'Комментарииииий666','2021-10-30 11:41:32'),(4,3,'Комментарииииий7','2021-10-30 11:42:02'),(5,3,'Комментарииииий8','2021-10-30 11:41:29'),(6,3,'Комментарииииий9','2021-10-30 11:41:49'),(7,3,'Комментарииииий10','2021-10-30 11:42:11'),(8,4,'Комментарииииий11','2021-10-30 11:42:42'),(9,4,'Комментарииииий12','2021-10-30 11:43:05'),(10,7,'Комментарииииий1345','2021-10-30 11:43:05'),(21,10,'Comments','2021-10-30 11:43:05'),(22,21,'Reply Comments','2021-11-03 20:25:19');
/*!40000 ALTER TABLE `test_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'test_comments'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-03 23:26:28
