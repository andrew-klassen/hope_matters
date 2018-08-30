--
-- Table structure for table `medication_order`
--

DROP TABLE IF EXISTS `medication_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medication_order` (
  `medication_order_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `medication` varchar(50) DEFAULT NULL,
  `dosage` varchar(50) DEFAULT NULL,
  `frequency` varchar(50) DEFAULT NULL,
  `administration_method` enum('oral','buccal','enteral','inhalable','infused','intramuscular','intrathecal','intravenous','nasal','ophthalmic','otic','rectal','subcutaneous','sublingual','topical','transdermal') DEFAULT 'oral',
  `notes` tinytext,
  `open` enum('yes','no') DEFAULT 'yes',
  `finished_by` varchar(20) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`medication_order_id`),
  UNIQUE KEY `referral_form_id_UNIQUE` (`medication_order_id`),
  KEY `client_id_refferal_form_idx` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `medication_order_dose`
--

DROP TABLE IF EXISTS `medication_order_dose`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medication_order_dose` (
  `medication_order_dose_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `medication_order_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`medication_order_dose_id`),
  UNIQUE KEY `referral_form_id_UNIQUE` (`medication_order_dose_id`),
  KEY `client_id_refferal_form_idx` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `medication_order_history`
--

DROP TABLE IF EXISTS `medication_order_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medication_order_history` (
  `medication_order_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `medication_order_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `medication` varchar(50) DEFAULT NULL,
  `dosage` varchar(50) DEFAULT NULL,
  `frequency` varchar(50) DEFAULT NULL,
  `administration_method` enum('oral','buccal','enteral','inhalable','infused','intramuscular','intrathecal','intravenous','nasal','ophthalmic','otic','rectal','subcutaneous','sublingual','topical','transdermal') DEFAULT 'oral',
  `notes` tinytext,
  `open` enum('yes','no') DEFAULT 'yes',
  `finished_by` varchar(20) DEFAULT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`medication_order_history_id`),
  UNIQUE KEY `referral_form_id_UNIQUE` (`medication_order_history_id`),
  KEY `client_id_refferal_form_idx` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;





--
-- Table structure for table `vital_signs`
--

DROP TABLE IF EXISTS `vital_signs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vital_signs` (
  `vital_signs_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `t` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `hr` varchar(10) DEFAULT NULL,
  `sao2` varchar(10) DEFAULT NULL,
  `pain` enum('none','mild','moderate','severe') DEFAULT 'none',
  `notes` tinytext,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`vital_signs_id`),
  UNIQUE KEY `referral_form_id_UNIQUE` (`vital_signs_id`),
  KEY `client_id_refferal_form_idx` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;




