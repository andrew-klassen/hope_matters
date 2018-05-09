CREATE DATABASE  IF NOT EXISTS `hope_matters` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `hope_matters`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 192.168.1.15    Database: hope_matters
-- ------------------------------------------------------
-- Server version	5.7.18

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
-- Table structure for table `return_treatment_temp`
--

DROP TABLE IF EXISTS `return_treatment_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `return_treatment_temp` (
  `t` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `pr` varchar(10) DEFAULT NULL,
  `rr` varchar(10) DEFAULT NULL,
  `sao2` varchar(10) DEFAULT NULL,
  `pain` enum('none','mild','moderate','severe') DEFAULT 'none',
  `notes` varchar(5000) DEFAULT NULL,
  `plan` varchar(5000) DEFAULT NULL,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL
) ENGINE=MEMORY DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'hope_matters'
--

--
-- Dumping routines for database 'hope_matters'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-22 19:08:11

ALTER TABLE `hope_matters`.`diagnoses_temp` 
ADD COLUMN `form_type` ENUM('treatment', 'return_treatment') NULL DEFAULT 'treatment' AFTER `created_by`;

ALTER TABLE `hope_matters`.`diagnoses` 
ADD COLUMN `form_type` ENUM('treatment', 'return_treatment') NULL DEFAULT 'treatment' AFTER `created_by`;

ALTER TABLE `hope_matters`.`diagnoses_history` 
ADD COLUMN `form_type` ENUM('treatment', 'return_treatment') NULL DEFAULT 'treatment' AFTER `created_by`;

ALTER TABLE `hope_matters`.`diagnoses` 
CHANGE COLUMN `treatment_id` `form_id` INT(11) NULL DEFAULT NULL ;

ALTER TABLE `hope_matters`.`diagnoses_history` 
CHANGE COLUMN `treatment_id` `form_id` INT(11) NULL DEFAULT NULL ;