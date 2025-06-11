-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: laboratorio
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paciente` (
  `registro` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `periodo` varchar(50) DEFAULT NULL,
  `nomeMae` varchar(255) DEFAULT NULL,
  `exames_solicitados` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
INSERT INTO `paciente` VALUES (NULL,NULL,'Noturno',NULL,NULL),(NULL,NULL,'Noturno',NULL,NULL),(NULL,NULL,'Noturno',NULL,NULL),(NULL,NULL,'Noturno',NULL,NULL);
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;

--
-- Table structure for table `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `Data_Nascimento` date DEFAULT NULL,
  `exames_solicitados` varchar(255) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa`
--

/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` VALUES (1,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(2,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(3,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(4,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(5,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(6,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(7,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(8,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(9,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(10,'oi','2004-08-02',NULL,'43984092304','kleberu2r@gmail.com'),(11,'oi','2004-08-02',NULL,'43984092304','kleberu2r@gmail.com');
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;

--
-- Dumping routines for database 'laboratorio'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-10 22:33:01
