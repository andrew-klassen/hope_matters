USE hope_matters;



ALTER TABLE `hope_matters`.`accounts_history` 
CHANGE COLUMN `password` `password` CHAR(60) CHARACTER SET 'latin1' NULL DEFAULT NULL ;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory` (
  `inventory_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `barcode` varchar(50) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `type` enum('equipment','supplies','medicine') DEFAULT NULL,
  `count` int(11) NOT NULL,
  `value` int(11) unsigned DEFAULT NULL,
  `notes` tinytext,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`inventory_id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `barcode_UNIQUE` (`barcode`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventory_change`
--

DROP TABLE IF EXISTS `inventory_change`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_change` (
  `inventory_change_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `inventory_id` int(11) unsigned NOT NULL,
  `barcode` varchar(50) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `type` enum('equipment','supplies','medicine') DEFAULT NULL,
  `value` int(11) unsigned DEFAULT NULL,
  `notes` tinytext,
  `amount` int(11) NOT NULL,
  `timestamp` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`inventory_change_id`),
  UNIQUE KEY `inventory_history_id_UNIQUE` (`inventory_change_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventory_history`
--

DROP TABLE IF EXISTS `inventory_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_history` (
  `inventory_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `inventory_id` int(11) unsigned NOT NULL,
  `barcode` varchar(50) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `type` enum('equipment','supplies','medicine') DEFAULT NULL,
  `count` int(11) NOT NULL,
  `value` int(11) unsigned DEFAULT NULL,
  `notes` tinytext,
  `timestamp` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`inventory_history_id`),
  UNIQUE KEY `inventory_history_id_UNIQUE` (`inventory_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `secret_values`
--

DROP TABLE IF EXISTS `secret_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secret_values` (
  `secret_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `secret_id` int(11) NOT NULL,
  `encrypted_value` varbinary(5016) DEFAULT NULL,
  `initialization_vector` binary(16) NOT NULL,
  `value_hash` char(60) NOT NULL,
  `privilege` enum('admin','read') DEFAULT 'read',
  PRIMARY KEY (`secret_value_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1365 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `secret_values_temp`
--

DROP TABLE IF EXISTS `secret_values_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secret_values_temp` (
  `secret_value_temp_id` int(11) NOT NULL AUTO_INCREMENT,
  `secret_id` int(11) DEFAULT NULL,
  `encrypted_value` varbinary(5016) DEFAULT NULL,
  `initialization_vector` binary(16) NOT NULL,
  `value_hash` char(60) NOT NULL,
  `privilege` enum('admin','read') DEFAULT 'read',
  PRIMARY KEY (`secret_value_temp_id`)
) ENGINE=MEMORY AUTO_INCREMENT=233 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `secrets`
--

DROP TABLE IF EXISTS `secrets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secrets` (
  `secret_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`secret_id`),
  UNIQUE KEY `label_UNIQUE` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


GRANT DELETE ON hope_matters.secret_values_temp TO 'php'@'localhost';
GRANT DELETE ON hope_matters.secret_values TO 'php'@'localhost';
GRANT DELETE ON hope_matters.secrets TO 'php'@'localhost';


