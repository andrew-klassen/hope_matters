CREATE DATABASE  IF NOT EXISTS `hope_matters` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `hope_matters`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 192.168.1.3    Database: hope_matters
-- ------------------------------------------------------
-- Server version	5.7.17

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
-- Table structure for table `current_clients`
--

DROP TABLE IF EXISTS `current_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `current_clients` (
  `current_clients_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `check_in` datetime DEFAULT NULL,
  `check_out` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`current_clients_id`),
  UNIQUE KEY `current_clients_id_UNIQUE` (`current_clients_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `expense_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `tag` varchar(45) DEFAULT NULL,
  `amount` int(11) unsigned DEFAULT NULL,
  `notes` tinytext,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `expenses_history`
--

DROP TABLE IF EXISTS `expenses_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses_history` (
  `expense_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `expense_id` int(11) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `tag` varchar(45) DEFAULT NULL,
  `amount` int(11) unsigned DEFAULT NULL,
  `notes` tinytext,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`expense_history_id`),
  UNIQUE KEY `expense_history_id_UNIQUE` (`expense_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `master_log_change`
--

DROP TABLE IF EXISTS `master_log_change`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_log_change` (
  `change_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payment_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `department` enum('dental','inquiry','laboratory','mch_anc','mch_cwc','mch_delivery','mch_fp','optometry','payment_rec','pharmacy','referral','screening/dm','screening/gyn','screening/htn','screening/other','tb_injection','treatment','vct','ultrasound','general') DEFAULT 'general',
  `payment_method` enum('unknown','cash','m-pesa') DEFAULT 'unknown',
  `revisit` enum('yes','no') DEFAULT 'no',
  `notes` varchar(150) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`change_id`),
  UNIQUE KEY `payment_history_id_UNIQUE` (`change_id`),
  KEY `client_id_master_log_idx` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
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

-- Dump completed on 2017-04-27 22:02:34

-- Table changes

ALTER TABLE `hope_matters`.`treatment_temp` 
CHANGE COLUMN `history` `history` VARCHAR(5000) NULL DEFAULT NULL ,
CHANGE COLUMN `physical_examination` `physical_examination` VARCHAR(5000) NULL DEFAULT NULL ,
CHANGE COLUMN `impression` `impression` VARCHAR(5000) NULL DEFAULT NULL ,
CHANGE COLUMN `plan` `plan` VARCHAR(5000) NULL DEFAULT NULL ,
CHANGE COLUMN `health_education` `health_education` VARCHAR(5000) NULL DEFAULT NULL ;

ALTER TABLE `hope_matters`.`treatment` 
CHANGE COLUMN `history` `history` TEXT NULL DEFAULT NULL ,
CHANGE COLUMN `physical_examination` `physical_examination` TEXT NULL DEFAULT NULL ,
CHANGE COLUMN `impression` `impression` TEXT NULL DEFAULT NULL ,
CHANGE COLUMN `plan` `plan` TEXT NULL DEFAULT NULL ,
CHANGE COLUMN `health_education` `health_education` TEXT NULL DEFAULT NULL ;

ALTER TABLE `hope_matters`.`treatment_history` 
CHANGE COLUMN `history` `history` TEXT NULL DEFAULT NULL ,
CHANGE COLUMN `physical_examination` `physical_examination` TEXT NULL DEFAULT NULL ,
CHANGE COLUMN `impression` `impression` TEXT NULL DEFAULT NULL ,
CHANGE COLUMN `plan` `plan` TEXT NULL DEFAULT NULL ,
CHANGE COLUMN `health_education` `health_education` TEXT NULL DEFAULT NULL ;

ALTER TABLE `hope_matters`.`return_treatment` 
CHANGE COLUMN `notes` `notes` TEXT NULL DEFAULT NULL ,
CHANGE COLUMN `plan` `plan` TEXT NULL DEFAULT NULL ;

ALTER TABLE `hope_matters`.`return_treatment_history` 
CHANGE COLUMN `notes` `notes` TEXT NULL DEFAULT NULL ,
CHANGE COLUMN `plan` `plan` TEXT NULL DEFAULT NULL ;

ALTER TABLE `hope_matters`.`master_log` 
ADD COLUMN `payment_method` ENUM('unknown', 'cash', 'm-pesa') NULL DEFAULT 'unknown' AFTER `department`;

ALTER TABLE `hope_matters`.`master_log_history` 
ADD COLUMN `payment_method` ENUM('unknown', 'cash', 'm-pesa') NULL DEFAULT 'unknown' AFTER `department`;

ALTER TABLE `hope_matters`.`current_clients`  AUTO_INCREMENT=1;
ALTER TABLE `hope_matters`.`expenses`  AUTO_INCREMENT=1;
ALTER TABLE `hope_matters`.`expenses_history`  AUTO_INCREMENT=1;
ALTER TABLE `hope_matters`.`master_log_change`  AUTO_INCREMENT=1;