-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: localhost    Database: todo_db
-- ------------------------------------------------------
-- Server version	8.0.27

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
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20211121142738','2021-11-21 14:29:23',260);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lists`
--

DROP TABLE IF EXISTS `lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lists` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `list_number` int NOT NULL,
  `list_title` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `is_public` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8269FA5A76ED395` (`user_id`),
  CONSTRAINT `FK_8269FA5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lists`
--

LOCK TABLES `lists` WRITE;
/*!40000 ALTER TABLE `lists` DISABLE KEYS */;
INSERT INTO `lists` VALUES (1,1,1,'list 1','2021-06-22 23:00:01',1),(2,2,2,'list 2','2021-06-23 00:00:01',1),(3,1,3,'list 3','2021-06-23 02:00:01',0),(4,2,4,'list 4','2021-06-23 05:00:01',0),(5,3,5,'list 5','2021-11-24 18:24:09',1),(6,2,6,'list 6','2021-11-25 18:44:42',1);
/*!40000 ALTER TABLE `lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `task` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `list_id` int DEFAULT NULL,
  `task_number` int NOT NULL,
  `task_title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `is_public` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_527EDB25A76ED395` (`user_id`),
  KEY `IDX_527EDB253DAE168B` (`list_id`),
  CONSTRAINT `FK_527EDB253DAE168B` FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`),
  CONSTRAINT `FK_527EDB25A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,1,NULL,1,'task 1','task 1 text','2021-06-22 16:00:00',1),(2,2,NULL,2,'task 2','task 2 text','2021-06-22 17:00:00',1),(3,3,NULL,3,'task 3','task 3 text','2021-06-22 18:00:00',1),(4,1,NULL,4,'task 4','task 4 text','2021-06-22 19:00:00',0),(5,2,NULL,5,'task 5','task 5 text','2021-06-22 20:00:00',0),(6,3,NULL,6,'task 6','task 6 text','2021-06-22 21:00:00',0),(7,1,1,7,'task 7','task 7 text','2021-06-22 22:00:00',1),(8,1,1,8,'task 8','task 8 text','2021-06-22 23:00:00',1),(9,2,2,9,'task 9','task 9 text','2021-06-23 00:00:00',1),(10,1,3,10,'task 10','task 10 text','2021-06-23 01:00:00',0),(11,1,3,11,'task 11','task 11 text','2021-06-23 02:00:00',0),(12,2,4,12,'task 12','task 12 text','2021-06-23 03:00:00',0),(13,2,4,13,'task 13','task 13 text','2021-06-23 04:00:00',0),(14,2,4,14,'task 14','task 14 text','2021-06-23 05:00:00',0),(15,1,NULL,15,'task 15','task 15 text','2021-11-23 23:33:27',1),(16,3,5,16,'task 16','task 16 text','2021-11-24 23:18:02',1),(17,3,5,17,'task 17','task 17 text','2021-11-24 23:30:30',1),(18,3,5,18,'task 18','task 18 text','2021-11-24 23:30:53',1),(19,3,5,19,'task 19','task 19 text','2021-11-24 23:37:57',1),(20,3,NULL,20,'task 20','task 20 text','2021-11-25 17:58:58',1),(21,2,NULL,21,'task 21','task 21 text','2021-11-25 18:06:40',1),(22,3,NULL,22,'task 22','task 22 text','2021-11-26 12:11:20',1),(23,3,NULL,23,'task 23','task 23 text','2021-11-26 12:21:38',1);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin_s','$2y$13$YvPnnCR16gcM1d8xZpY9h.fhWvIUlGKhbOypfWILaRKW69wcJ.wIa','admin.super@php.com','Admin','Super','ROLE_ADMIN',1),(2,'user_one','$2y$13$PemJRIkyQ4WROBtRjJ0LrOrY/M/BkfyYC2VchEOeXE8jIAnThZRv2','user.one@php.com','User','One','ROLE_USER',1),(3,'user_two','$2y$13$vSJP6K7GNZZYvfWkz8I.3.yGwENq.53t.4TlXDWv83.U9xX3ZiFFG','user.two@php.com','User','Two','ROLE_USER',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-26 17:18:54
