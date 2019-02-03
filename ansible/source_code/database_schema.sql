-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: 10.0.0.205    Database: custom_forms
-- ------------------------------------------------------
-- Server version	5.7.25

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
-- Current Database: `custom_forms`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `custom_forms` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `custom_forms`;

--
-- Table structure for table `clinic_psychosocial_assessment`
--

DROP TABLE IF EXISTS `clinic_psychosocial_assessment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinic_psychosocial_assessment` (
  `clinic_psychosocial_assessment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `diagnosis` varchar(50) DEFAULT NULL,
  `understood_diagnosis` enum('yes','no') DEFAULT NULL,
  `diagnosis_questions` tinytext,
  `address` varchar(50) DEFAULT NULL,
  `primary_contact_phone_number` varchar(50) DEFAULT NULL,
  `if_not_patient's_number_list_their_relationship_to_patient` varchar(50) DEFAULT NULL,
  `emergency_contact#` varchar(50) DEFAULT NULL,
  `name_of_contact` varchar(50) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL,
  `head_of_household` varchar(50) DEFAULT NULL,
  `relation_(household_head)` varchar(50) DEFAULT NULL,
  `resides_with` text,
  `employment` enum('yes','no') DEFAULT NULL,
  `religious_preference` varchar(50) DEFAULT NULL,
  `recreational_drugs` enum('yes','no') DEFAULT NULL,
  `drug_list` varchar(50) DEFAULT NULL,
  `smoke` enum('yes','no') DEFAULT NULL,
  `smoke_frequency` varchar(50) DEFAULT NULL,
  `alcohol` enum('yes','no') DEFAULT NULL,
  `alcohol_frequency` varchar(50) DEFAULT NULL,
  `children_(male)` enum('yes','no') DEFAULT NULL,
  `number_of_children_(male)` int(11) DEFAULT NULL,
  `children` enum('yes','no') DEFAULT NULL,
  `number_of_children_(females)` int(11) DEFAULT NULL,
  `currently_pregnant` enum('yes','no') DEFAULT NULL,
  `past_miscarriages(s)` enum('yes','no') DEFAULT NULL,
  `abortions(s)` enum('yes','no') DEFAULT NULL,
  `past_pregnancy_complications` enum('yes','no') DEFAULT NULL,
  `current_prescribed_medications` enum('yes','no') DEFAULT NULL,
  `name_1._med_array_1` varchar(25) DEFAULT NULL,
  `reason_1._med_array_1` varchar(25) DEFAULT NULL,
  `name_2._med_array_2` varchar(25) DEFAULT NULL,
  `reason_2._med_array_2` varchar(25) DEFAULT NULL,
  `name_3._med_array_3` varchar(25) DEFAULT NULL,
  `reason_3._med_array_3` varchar(25) DEFAULT NULL,
  `patient's_current_concerns` text,
  `impression_comment` text,
  `additional_service_needed` text,
  `progress_note_ids` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`clinic_psychosocial_assessment_id`),
  UNIQUE KEY `clinic_psychosocial_assessment_id_UNIQUE` (`clinic_psychosocial_assessment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `clinic_psychosocial_assessment_history`
--

DROP TABLE IF EXISTS `clinic_psychosocial_assessment_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinic_psychosocial_assessment_history` (
  `clinic_psychosocial_assessment_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `clinic_psychosocial_assessment_id` int(11) unsigned NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `diagnosis` varchar(50) DEFAULT NULL,
  `understood_diagnosis` enum('yes','no') DEFAULT NULL,
  `diagnosis_questions` tinytext,
  `address` varchar(50) DEFAULT NULL,
  `primary_contact_phone_number` varchar(50) DEFAULT NULL,
  `if_not_patient's_number_list_their_relationship_to_patient` varchar(50) DEFAULT NULL,
  `emergency_contact#` varchar(50) DEFAULT NULL,
  `name_of_contact` varchar(50) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL,
  `head_of_household` varchar(50) DEFAULT NULL,
  `relation_(household_head)` varchar(50) DEFAULT NULL,
  `resides_with` text,
  `employment` enum('yes','no') DEFAULT NULL,
  `religious_preference` varchar(50) DEFAULT NULL,
  `recreational_drugs` enum('yes','no') DEFAULT NULL,
  `drug_list` varchar(50) DEFAULT NULL,
  `smoke` enum('yes','no') DEFAULT NULL,
  `smoke_frequency` varchar(50) DEFAULT NULL,
  `alcohol` enum('yes','no') DEFAULT NULL,
  `alcohol_frequency` varchar(50) DEFAULT NULL,
  `children_(male)` enum('yes','no') DEFAULT NULL,
  `number_of_children_(male)` int(11) DEFAULT NULL,
  `children` enum('yes','no') DEFAULT NULL,
  `number_of_children_(females)` int(11) DEFAULT NULL,
  `currently_pregnant` enum('yes','no') DEFAULT NULL,
  `past_miscarriages(s)` enum('yes','no') DEFAULT NULL,
  `abortions(s)` enum('yes','no') DEFAULT NULL,
  `past_pregnancy_complications` enum('yes','no') DEFAULT NULL,
  `current_prescribed_medications` enum('yes','no') DEFAULT NULL,
  `name_1._med_array_1` varchar(25) DEFAULT NULL,
  `reason_1._med_array_1` varchar(25) DEFAULT NULL,
  `name_2._med_array_2` varchar(25) DEFAULT NULL,
  `reason_2._med_array_2` varchar(25) DEFAULT NULL,
  `name_3._med_array_3` varchar(25) DEFAULT NULL,
  `reason_3._med_array_3` varchar(25) DEFAULT NULL,
  `patient's_current_concerns` text,
  `impression_comment` text,
  `additional_service_needed` text,
  `progress_note_ids` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`clinic_psychosocial_assessment_history_id`),
  UNIQUE KEY `clinic_psychosocial_assessment_history_id_UNIQUE` (`clinic_psychosocial_assessment_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `clinic_psychosocial_assessment_meta`
--

DROP TABLE IF EXISTS `clinic_psychosocial_assessment_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinic_psychosocial_assessment_meta` (
  `clinic_psychosocial_assessment_meta_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attribute` varchar(100) DEFAULT NULL,
  `value` varchar(1000) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`clinic_psychosocial_assessment_meta_id`),
  UNIQUE KEY `clinic_psychosocial_assessment_meta_id_UNIQUE` (`clinic_psychosocial_assessment_meta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cpa_progress_notes`
--

DROP TABLE IF EXISTS `cpa_progress_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cpa_progress_notes` (
  `cpa_progress_notes_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `diagnosis` varchar(50) DEFAULT NULL,
  `today's_date` date DEFAULT NULL,
  `understanding_of_diagnosis` enum('yes','no') DEFAULT NULL,
  `diagnosis_question` tinytext,
  `address_change` enum('yes','no') DEFAULT NULL,
  `continued_medication` enum('yes','no') DEFAULT NULL,
  `taking_medication` enum('yes','no') DEFAULT NULL,
  `location_of_visit` enum('inpatient','outpatient','home') DEFAULT NULL,
  `medication_concerns/problems` tinytext,
  `clinic_follow_up_request` enum('yes','no') DEFAULT NULL,
  `reason` tinytext,
  `impression_comments` text,
  `additional_services_needed` text,
  `future_follow_up_plan` text,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cpa_progress_notes_id`),
  UNIQUE KEY `cpa_progress_notes_id_UNIQUE` (`cpa_progress_notes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cpa_progress_notes_history`
--

DROP TABLE IF EXISTS `cpa_progress_notes_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cpa_progress_notes_history` (
  `cpa_progress_notes_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cpa_progress_notes_id` int(11) unsigned NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `diagnosis` varchar(50) DEFAULT NULL,
  `today's_date` date DEFAULT NULL,
  `understanding_of_diagnosis` enum('yes','no') DEFAULT NULL,
  `diagnosis_question` tinytext,
  `address_change` enum('yes','no') DEFAULT NULL,
  `continued_medication` enum('yes','no') DEFAULT NULL,
  `taking_medication` enum('yes','no') DEFAULT NULL,
  `location_of_visit` enum('inpatient','outpatient','home') DEFAULT NULL,
  `medication_concerns/problems` tinytext,
  `clinic_follow_up_request` enum('yes','no') DEFAULT NULL,
  `reason` tinytext,
  `impression_comments` text,
  `additional_services_needed` text,
  `future_follow_up_plan` text,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cpa_progress_notes_history_id`),
  UNIQUE KEY `cpa_progress_notes_history_id_UNIQUE` (`cpa_progress_notes_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cpa_progress_notes_meta`
--

DROP TABLE IF EXISTS `cpa_progress_notes_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cpa_progress_notes_meta` (
  `cpa_progress_notes_meta_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attribute` varchar(100) DEFAULT NULL,
  `value` varchar(1000) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cpa_progress_notes_meta_id`),
  UNIQUE KEY `cpa_progress_notes_meta_id_UNIQUE` (`cpa_progress_notes_meta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inpatient_chart`
--

DROP TABLE IF EXISTS `inpatient_chart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inpatient_chart` (
  `inpatient_chart_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `t____vital_array_1` varchar(25) DEFAULT NULL,
  `rr___vital_array_1` varchar(25) DEFAULT NULL,
  `br___vital_array_2` varchar(25) DEFAULT NULL,
  `sao2_vital_array_2` varchar(25) DEFAULT NULL,
  `pain` enum('moderate','mild','severe','none') DEFAULT NULL,
  `today's_date` date DEFAULT NULL,
  `cardiovascular` enum('yes','no') DEFAULT NULL,
  `cardiovascular_details` text,
  `respiratory` enum('yes','no') DEFAULT NULL,
  `respiratory_details` text,
  `musculoskeletal` enum('yes','no') DEFAULT NULL,
  `musculoskeletal_details` text,
  `integumentary` enum('yes','no') DEFAULT NULL,
  `integumentary_details` text,
  `gi` enum('yes','no') DEFAULT NULL,
  `gi_details` text,
  `gu` enum('yes','no') DEFAULT NULL,
  `gu_details` text,
  `other` text,
  `interventions_performed_(dressing_changes,_etc.)` text,
  `provider_progress_note` text,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`inpatient_chart_id`),
  UNIQUE KEY `inpatient_chart_id_UNIQUE` (`inpatient_chart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inpatient_chart_history`
--

DROP TABLE IF EXISTS `inpatient_chart_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inpatient_chart_history` (
  `inpatient_chart_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `inpatient_chart_id` int(11) unsigned NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `t____vital_array_1` varchar(25) DEFAULT NULL,
  `rr___vital_array_1` varchar(25) DEFAULT NULL,
  `br___vital_array_2` varchar(25) DEFAULT NULL,
  `sao2_vital_array_2` varchar(25) DEFAULT NULL,
  `pain` enum('moderate','mild','severe','none') DEFAULT NULL,
  `today's_date` date DEFAULT NULL,
  `cardiovascular` enum('yes','no') DEFAULT NULL,
  `cardiovascular_details` text,
  `respiratory` enum('yes','no') DEFAULT NULL,
  `respiratory_details` text,
  `musculoskeletal` enum('yes','no') DEFAULT NULL,
  `musculoskeletal_details` text,
  `integumentary` enum('yes','no') DEFAULT NULL,
  `integumentary_details` text,
  `gi` enum('yes','no') DEFAULT NULL,
  `gi_details` text,
  `gu` enum('yes','no') DEFAULT NULL,
  `gu_details` text,
  `other` text,
  `interventions_performed_(dressing_changes,_etc.)` text,
  `provider_progress_note` text,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`inpatient_chart_history_id`),
  UNIQUE KEY `inpatient_chart_history_id_UNIQUE` (`inpatient_chart_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inpatient_chart_meta`
--

DROP TABLE IF EXISTS `inpatient_chart_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inpatient_chart_meta` (
  `inpatient_chart_meta_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attribute` varchar(100) DEFAULT NULL,
  `value` varchar(1000) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`inpatient_chart_meta_id`),
  UNIQUE KEY `inpatient_chart_meta_id_UNIQUE` (`inpatient_chart_meta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `labor_and_delivery_chart`
--

DROP TABLE IF EXISTS `labor_and_delivery_chart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `labor_and_delivery_chart` (
  `labor_and_delivery_chart_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `t__vital_array_1` varchar(25) DEFAULT NULL,
  `rr_vital_array_1` varchar(25) DEFAULT NULL,
  `br_vital_array_2` varchar(25) DEFAULT NULL,
  `pr_vital_array_2` varchar(25) DEFAULT NULL,
  `sao2_vital_array_3` varchar(25) DEFAULT NULL,
  `pain` enum('moderate','mild','severe','none') DEFAULT NULL,
  `today's_date` date DEFAULT NULL,
  `time_labor_began_labor_time_array` varchar(25) DEFAULT NULL,
  `bloody_show` enum('yes','no') DEFAULT NULL,
  `bloody_show_details` varchar(50) DEFAULT NULL,
  `rupture_of_membranes` enum('yes','no') DEFAULT NULL,
  `rupture_of_membranes_details` varchar(50) DEFAULT NULL,
  `presentation` enum('yes','no') DEFAULT NULL,
  `presentation_details` varchar(50) DEFAULT NULL,
  `hiv_status` enum('+','-','unknown') DEFAULT NULL,
  `dilation_of_cervix` varchar(1000) DEFAULT NULL,
  `fetal_heart` varchar(1000) DEFAULT NULL,
  `1_liquor_array_1` varchar(25) DEFAULT NULL,
  `2_liquor_array_1` varchar(25) DEFAULT NULL,
  `3_liquor_array_1` varchar(25) DEFAULT NULL,
  `4_liquor_array_1` varchar(25) DEFAULT NULL,
  `5_liquor_array_1` varchar(25) DEFAULT NULL,
  `6_liquor_array_2` varchar(25) DEFAULT NULL,
  `7_liquor_array_2` varchar(25) DEFAULT NULL,
  `8_liquor_array_2` varchar(25) DEFAULT NULL,
  `9_liquor_array_2` varchar(25) DEFAULT NULL,
  `10_liquor_array_2` varchar(25) DEFAULT NULL,
  `1_oxytocin_array_1` varchar(25) DEFAULT NULL,
  `2_oxytocin_array_1` varchar(25) DEFAULT NULL,
  `3_oxytocin_array_1` varchar(25) DEFAULT NULL,
  `4_oxytocin_array_1` varchar(25) DEFAULT NULL,
  `5_oxytocin_array_1` varchar(25) DEFAULT NULL,
  `6_oxytocin_array_2` varchar(25) DEFAULT NULL,
  `7_oxytocin_array_2` varchar(25) DEFAULT NULL,
  `8_oxytocin_array_2` varchar(25) DEFAULT NULL,
  `9_oxytocin_array_2` varchar(25) DEFAULT NULL,
  `10_oxytocin_array_2` varchar(25) DEFAULT NULL,
  `1_analgesia_array_1` varchar(25) DEFAULT NULL,
  `2_analgesia_array_1` varchar(25) DEFAULT NULL,
  `3_analgesia_array_1` varchar(25) DEFAULT NULL,
  `4_analgesia_array_1` varchar(25) DEFAULT NULL,
  `5_analgesia_array_1` varchar(25) DEFAULT NULL,
  `6_analgesia_array_2` varchar(25) DEFAULT NULL,
  `7_analgesia_array_2` varchar(25) DEFAULT NULL,
  `8_analgesia_array_2` varchar(25) DEFAULT NULL,
  `9_analgesia_array_2` varchar(25) DEFAULT NULL,
  `10_analgesia_array_2` varchar(25) DEFAULT NULL,
  `time_of_delivery_partogram_bottom` varchar(25) DEFAULT NULL,
  `method_partogram_bottom` varchar(25) DEFAULT NULL,
  `duration_partogram_bottom` varchar(25) DEFAULT NULL,
  `locia_normal` enum('yes','no') DEFAULT NULL,
  `locia_details` varchar(50) DEFAULT NULL,
  `fundus_normal` enum('yes','no') DEFAULT NULL,
  `fundus_details` varchar(50) DEFAULT NULL,
  `breastfeeding` enum('yes','no') DEFAULT NULL,
  `birth_time` date DEFAULT NULL,
  `1_minute_apgar_array` varchar(25) DEFAULT NULL,
  `5_minute_apgar_array` varchar(25) DEFAULT NULL,
  `10_minute_(optional)_apgar_array` varchar(25) DEFAULT NULL,
  `progress_note_ids` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`labor_and_delivery_chart_id`),
  UNIQUE KEY `labor_and_delivery_chart_id_UNIQUE` (`labor_and_delivery_chart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `labor_and_delivery_chart_history`
--

DROP TABLE IF EXISTS `labor_and_delivery_chart_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `labor_and_delivery_chart_history` (
  `labor_and_delivery_chart_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `labor_and_delivery_chart_id` int(11) unsigned NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `t__vital_array_1` varchar(25) DEFAULT NULL,
  `rr_vital_array_1` varchar(25) DEFAULT NULL,
  `br_vital_array_2` varchar(25) DEFAULT NULL,
  `pr_vital_array_2` varchar(25) DEFAULT NULL,
  `sao2_vital_array_3` varchar(25) DEFAULT NULL,
  `pain` enum('moderate','mild','severe','none') DEFAULT NULL,
  `today's_date` date DEFAULT NULL,
  `time_labor_began_labor_time_array` varchar(25) DEFAULT NULL,
  `bloody_show` enum('yes','no') DEFAULT NULL,
  `bloody_show_details` varchar(50) DEFAULT NULL,
  `rupture_of_membranes` enum('yes','no') DEFAULT NULL,
  `rupture_of_membranes_details` varchar(50) DEFAULT NULL,
  `presentation` enum('yes','no') DEFAULT NULL,
  `presentation_details` varchar(50) DEFAULT NULL,
  `hiv_status` enum('+','-','unknown') DEFAULT NULL,
  `dilation_of_cervix` varchar(1000) DEFAULT NULL,
  `fetal_heart` varchar(1000) DEFAULT NULL,
  `1_liquor_array_1` varchar(25) DEFAULT NULL,
  `2_liquor_array_1` varchar(25) DEFAULT NULL,
  `3_liquor_array_1` varchar(25) DEFAULT NULL,
  `4_liquor_array_1` varchar(25) DEFAULT NULL,
  `5_liquor_array_1` varchar(25) DEFAULT NULL,
  `6_liquor_array_2` varchar(25) DEFAULT NULL,
  `7_liquor_array_2` varchar(25) DEFAULT NULL,
  `8_liquor_array_2` varchar(25) DEFAULT NULL,
  `9_liquor_array_2` varchar(25) DEFAULT NULL,
  `10_liquor_array_2` varchar(25) DEFAULT NULL,
  `1_oxytocin_array_1` varchar(25) DEFAULT NULL,
  `2_oxytocin_array_1` varchar(25) DEFAULT NULL,
  `3_oxytocin_array_1` varchar(25) DEFAULT NULL,
  `4_oxytocin_array_1` varchar(25) DEFAULT NULL,
  `5_oxytocin_array_1` varchar(25) DEFAULT NULL,
  `6_oxytocin_array_2` varchar(25) DEFAULT NULL,
  `7_oxytocin_array_2` varchar(25) DEFAULT NULL,
  `8_oxytocin_array_2` varchar(25) DEFAULT NULL,
  `9_oxytocin_array_2` varchar(25) DEFAULT NULL,
  `10_oxytocin_array_2` varchar(25) DEFAULT NULL,
  `1_analgesia_array_1` varchar(25) DEFAULT NULL,
  `2_analgesia_array_1` varchar(25) DEFAULT NULL,
  `3_analgesia_array_1` varchar(25) DEFAULT NULL,
  `4_analgesia_array_1` varchar(25) DEFAULT NULL,
  `5_analgesia_array_1` varchar(25) DEFAULT NULL,
  `6_analgesia_array_2` varchar(25) DEFAULT NULL,
  `7_analgesia_array_2` varchar(25) DEFAULT NULL,
  `8_analgesia_array_2` varchar(25) DEFAULT NULL,
  `9_analgesia_array_2` varchar(25) DEFAULT NULL,
  `10_analgesia_array_2` varchar(25) DEFAULT NULL,
  `time_of_delivery_partogram_bottom` varchar(25) DEFAULT NULL,
  `method_partogram_bottom` varchar(25) DEFAULT NULL,
  `duration_partogram_bottom` varchar(25) DEFAULT NULL,
  `locia_normal` enum('yes','no') DEFAULT NULL,
  `locia_details` varchar(50) DEFAULT NULL,
  `fundus_normal` enum('yes','no') DEFAULT NULL,
  `fundus_details` varchar(50) DEFAULT NULL,
  `breastfeeding` enum('yes','no') DEFAULT NULL,
  `birth_time` date DEFAULT NULL,
  `1_minute_apgar_array` varchar(25) DEFAULT NULL,
  `5_minute_apgar_array` varchar(25) DEFAULT NULL,
  `10_minute_(optional)_apgar_array` varchar(25) DEFAULT NULL,
  `progress_note_ids` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`labor_and_delivery_chart_history_id`),
  UNIQUE KEY `labor_and_delivery_chart_history_id_UNIQUE` (`labor_and_delivery_chart_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `labor_and_delivery_chart_meta`
--

DROP TABLE IF EXISTS `labor_and_delivery_chart_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `labor_and_delivery_chart_meta` (
  `labor_and_delivery_chart_meta_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attribute` varchar(100) DEFAULT NULL,
  `value` varchar(1000) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`labor_and_delivery_chart_meta_id`),
  UNIQUE KEY `labor_and_delivery_chart_meta_id_UNIQUE` (`labor_and_delivery_chart_meta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ld_progress_notes`
--

DROP TABLE IF EXISTS `ld_progress_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ld_progress_notes` (
  `ld_progress_notes_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `diagnosis` varchar(50) DEFAULT NULL,
  `today's_date` date DEFAULT NULL,
  `understanding_of_diagnosis` enum('yes','no') DEFAULT NULL,
  `diagnosis_question` tinytext,
  `address_change` enum('yes','no') DEFAULT NULL,
  `continued_medication` enum('yes','no') DEFAULT NULL,
  `taking_medication` enum('yes','no') DEFAULT NULL,
  `location_of_visit` enum('inpatient','outpatient','home') DEFAULT NULL,
  `medication_concerns/problems` tinytext,
  `clinic_follow_up_request` enum('yes','no') DEFAULT NULL,
  `reason` tinytext,
  `impression_comments` text,
  `additional_services_needed` text,
  `future_follow_up_plan` text,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ld_progress_notes_id`),
  UNIQUE KEY `ld_progress_notes_id_UNIQUE` (`ld_progress_notes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ld_progress_notes_history`
--

DROP TABLE IF EXISTS `ld_progress_notes_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ld_progress_notes_history` (
  `ld_progress_notes_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ld_progress_notes_id` int(11) unsigned NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `diagnosis` varchar(50) DEFAULT NULL,
  `today's_date` date DEFAULT NULL,
  `understanding_of_diagnosis` enum('yes','no') DEFAULT NULL,
  `diagnosis_question` tinytext,
  `address_change` enum('yes','no') DEFAULT NULL,
  `continued_medication` enum('yes','no') DEFAULT NULL,
  `taking_medication` enum('yes','no') DEFAULT NULL,
  `location_of_visit` enum('inpatient','outpatient','home') DEFAULT NULL,
  `medication_concerns/problems` tinytext,
  `clinic_follow_up_request` enum('yes','no') DEFAULT NULL,
  `reason` tinytext,
  `impression_comments` text,
  `additional_services_needed` text,
  `future_follow_up_plan` text,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ld_progress_notes_history_id`),
  UNIQUE KEY `ld_progress_notes_history_id_UNIQUE` (`ld_progress_notes_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ld_progress_notes_meta`
--

DROP TABLE IF EXISTS `ld_progress_notes_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ld_progress_notes_meta` (
  `ld_progress_notes_meta_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attribute` varchar(100) DEFAULT NULL,
  `value` varchar(1000) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ld_progress_notes_meta_id`),
  UNIQUE KEY `ld_progress_notes_meta_id_UNIQUE` (`ld_progress_notes_meta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `newborn_assessment`
--

DROP TABLE IF EXISTS `newborn_assessment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newborn_assessment` (
  `newborn_assessment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `t____vital_array_1` varchar(25) DEFAULT NULL,
  `rr___vital_array_1` varchar(25) DEFAULT NULL,
  `br___vital_array_2` varchar(25) DEFAULT NULL,
  `sao2_vital_array_2` varchar(25) DEFAULT NULL,
  `pain` enum('moderate','mild','severe','none') DEFAULT NULL,
  `today's_date` date DEFAULT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `length` varchar(50) DEFAULT NULL,
  `patient_information` tinytext,
  `head` enum('yes','no') DEFAULT NULL,
  `head_details` text,
  `neurological` enum('yes','no') DEFAULT NULL,
  `neurological_details` text,
  `cardiovascular` enum('yes','no') DEFAULT NULL,
  `cardiovascular_details` text,
  `respiratory` enum('yes','no') DEFAULT NULL,
  `respiratory_details` text,
  `musculoskeletal` enum('yes','no') DEFAULT NULL,
  `musculoskeletal_details` text,
  `integumentary` enum('yes','no') DEFAULT NULL,
  `integumentary_details` text,
  `gi` enum('yes','no') DEFAULT NULL,
  `gi_details` text,
  `gu` enum('yes','no') DEFAULT NULL,
  `gu_details` text,
  `other` text,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`newborn_assessment_id`),
  UNIQUE KEY `newborn_assessment_id_UNIQUE` (`newborn_assessment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `newborn_assessment_history`
--

DROP TABLE IF EXISTS `newborn_assessment_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newborn_assessment_history` (
  `newborn_assessment_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `newborn_assessment_id` int(11) unsigned NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `t____vital_array_1` varchar(25) DEFAULT NULL,
  `rr___vital_array_1` varchar(25) DEFAULT NULL,
  `br___vital_array_2` varchar(25) DEFAULT NULL,
  `sao2_vital_array_2` varchar(25) DEFAULT NULL,
  `pain` enum('moderate','mild','severe','none') DEFAULT NULL,
  `today's_date` date DEFAULT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `length` varchar(50) DEFAULT NULL,
  `patient_information` tinytext,
  `head` enum('yes','no') DEFAULT NULL,
  `head_details` text,
  `neurological` enum('yes','no') DEFAULT NULL,
  `neurological_details` text,
  `cardiovascular` enum('yes','no') DEFAULT NULL,
  `cardiovascular_details` text,
  `respiratory` enum('yes','no') DEFAULT NULL,
  `respiratory_details` text,
  `musculoskeletal` enum('yes','no') DEFAULT NULL,
  `musculoskeletal_details` text,
  `integumentary` enum('yes','no') DEFAULT NULL,
  `integumentary_details` text,
  `gi` enum('yes','no') DEFAULT NULL,
  `gi_details` text,
  `gu` enum('yes','no') DEFAULT NULL,
  `gu_details` text,
  `other` text,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`newborn_assessment_history_id`),
  UNIQUE KEY `newborn_assessment_history_id_UNIQUE` (`newborn_assessment_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `newborn_assessment_meta`
--

DROP TABLE IF EXISTS `newborn_assessment_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newborn_assessment_meta` (
  `newborn_assessment_meta_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attribute` varchar(100) DEFAULT NULL,
  `value` varchar(1000) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`newborn_assessment_meta_id`),
  UNIQUE KEY `newborn_assessment_meta_id_UNIQUE` (`newborn_assessment_meta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'custom_forms'
--

--
-- Dumping routines for database 'custom_forms'
--

--
-- Current Database: `hope_matters`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `hope_matters` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `hope_matters`;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `account_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `job_title` varchar(45) DEFAULT NULL,
  `work_location` varchar(45) DEFAULT NULL,
  `normal_work_hours` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `message_to_everyone` tinytext,
  `image_path` varchar(1000) DEFAULT 'no_image',
  `master_log_access` enum('yes','no') DEFAULT 'no',
  `server_admin` enum('yes','no') DEFAULT 'no',
  `password` varchar(96) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `account_id_UNIQUE` (`account_id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `accounts_history`
--

DROP TABLE IF EXISTS `accounts_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts_history` (
  `accounts_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(11) unsigned NOT NULL,
  `username` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `first_name` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `last_name` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `job_title` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `work_location` varchar(45) COLLATE latin1_bin DEFAULT NULL,
  `normal_work_hours` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `phone_number` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `message_to_everyone` tinytext CHARACTER SET latin1,
  `image_path` varchar(1000) CHARACTER SET latin1 DEFAULT 'no_image',
  `master_log_access` enum('yes','no') CHARACTER SET latin1 DEFAULT 'no',
  `server_admin` enum('yes','no') COLLATE latin1_bin DEFAULT 'no',
  `password` varchar(96) CHARACTER SET latin1 DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `created_by` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`accounts_history_id`),
  UNIQUE KEY `accounts_history_id_UNIQUE` (`accounts_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `baby`
--

DROP TABLE IF EXISTS `baby`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `baby` (
  `baby_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ultrasound_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `baby_number` enum('1','2','3','4') DEFAULT NULL,
  `presentation` enum('cephalic','breech','transverse') DEFAULT NULL,
  `placenta` varchar(45) DEFAULT NULL,
  `fetal_movement` varchar(45) DEFAULT NULL,
  `fetal_heartbeat` varchar(45) DEFAULT NULL,
  `amniotic_fluid` varchar(45) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`baby_id`),
  UNIQUE KEY `baby_id_UNIQUE` (`baby_id`),
  KEY `client_id_baby_idx` (`client_id`),
  CONSTRAINT `client_id_baby` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `baby_history`
--

DROP TABLE IF EXISTS `baby_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `baby_history` (
  `baby_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `baby_id` int(11) unsigned NOT NULL,
  `ultrasound_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `baby_number` enum('1','2','3','4') DEFAULT NULL,
  `presentation` enum('cephalic','breech','transverse') DEFAULT NULL,
  `placenta` varchar(45) DEFAULT NULL,
  `fetal_movement` varchar(45) DEFAULT NULL,
  `fetal_heartbeat` varchar(45) DEFAULT NULL,
  `amniotic_fluid` varchar(45) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`baby_history_id`),
  UNIQUE KEY `baby_history_id_UNIQUE` (`baby_history_id`),
  KEY `client_id_baby_history_idx` (`client_id`),
  CONSTRAINT `client_id_baby_history` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `child_growth`
--

DROP TABLE IF EXISTS `child_growth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `child_growth` (
  `child_growth_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `child_welfare_care_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `weight` decimal(6,3) unsigned DEFAULT NULL,
  `weight_percentile` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `height_percentile` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`child_growth_id`),
  UNIQUE KEY `child_growth_id_UNIQUE` (`child_growth_id`),
  KEY `client_id_child_growth_idx` (`client_id`),
  CONSTRAINT `client_id_child_growth` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `child_growth_history`
--

DROP TABLE IF EXISTS `child_growth_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `child_growth_history` (
  `child_growth_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `child_growth_id` int(11) unsigned NOT NULL,
  `child_welfare_care_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `weight` decimal(6,3) unsigned DEFAULT NULL,
  `weight_percentile` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `height_percentile` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`child_growth_history_id`),
  UNIQUE KEY `child_growth_history_id_UNIQUE` (`child_growth_history_id`),
  KEY `client_id_child_growth_history_idx` (`client_id`),
  CONSTRAINT `client_id_child_growth_history` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `child_welfare_care`
--

DROP TABLE IF EXISTS `child_welfare_care`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `child_welfare_care` (
  `child_welfare_care_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `child_particulars` date DEFAULT NULL,
  `child_name` varchar(45) DEFAULT NULL,
  `child_gender` enum('male','female') DEFAULT NULL,
  `child_date_of_birth` date DEFAULT NULL,
  `birth_weight` decimal(6,3) unsigned DEFAULT NULL,
  `birth_length` int(11) DEFAULT NULL,
  `birth_characteristics` varchar(45) DEFAULT NULL,
  `birth_order` int(11) DEFAULT NULL,
  `first_seen` date DEFAULT NULL,
  `birth_place` enum('health_facility','home','other') DEFAULT NULL,
  `other_birth_place` varchar(45) DEFAULT NULL,
  `notification_number` varchar(45) DEFAULT NULL,
  `notification_date` date DEFAULT NULL,
  `register_number` varchar(45) DEFAULT NULL,
  `child_welfare_clinic` varchar(45) DEFAULT NULL,
  `health_facility` varchar(45) DEFAULT NULL,
  `master_facility_list_number` varchar(45) DEFAULT NULL,
  `birth_certificate_number` varchar(45) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `registration_place` varchar(45) DEFAULT NULL,
  `abnormalities` tinytext,
  `father_name` varchar(45) DEFAULT NULL,
  `father_phone_number` varchar(45) DEFAULT NULL,
  `mother_name` varchar(45) DEFAULT NULL,
  `mother_phone_number` varchar(45) DEFAULT NULL,
  `guardian_name` varchar(45) DEFAULT NULL,
  `guardian_phone_number` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `district` varchar(45) DEFAULT NULL,
  `division` varchar(45) DEFAULT NULL,
  `child_location` varchar(45) DEFAULT NULL,
  `town` varchar(45) DEFAULT NULL,
  `village` varchar(45) DEFAULT NULL,
  `post_address` varchar(45) DEFAULT NULL,
  `age_first_contact` int(11) DEFAULT NULL,
  `weight` decimal(6,3) unsigned DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `physical_features` varchar(45) DEFAULT NULL,
  `colouration` varchar(45) DEFAULT NULL,
  `head_circumference` int(11) DEFAULT NULL,
  `eyes` varchar(45) DEFAULT NULL,
  `mouth` varchar(45) DEFAULT NULL,
  `chest` varchar(45) DEFAULT NULL,
  `heart` varchar(45) DEFAULT NULL,
  `abdomen` varchar(45) DEFAULT NULL,
  `umbilicus` varchar(45) DEFAULT NULL,
  `spine` varchar(45) DEFAULT NULL,
  `arms_and_hands` varchar(45) DEFAULT NULL,
  `legs_and_feet` varchar(45) DEFAULT NULL,
  `genitalia` varchar(45) DEFAULT NULL,
  `anus` varchar(45) DEFAULT NULL,
  `breastfeeding` enum('well','poorly','unable') DEFAULT NULL,
  `feeds` enum('yes','no') DEFAULT NULL,
  `feeds_age` int(11) DEFAULT NULL,
  `other_foods_introduced` enum('yes','no') DEFAULT NULL,
  `indigestion` varchar(45) DEFAULT NULL,
  `sleep_cycle` varchar(45) DEFAULT NULL,
  `irritability` enum('yes','no') DEFAULT NULL,
  `finger_sucking` enum('yes','no') DEFAULT NULL,
  `others` enum('yes','no') DEFAULT NULL,
  `mis_05_given` date DEFAULT NULL,
  `mis_05_next_visit` date DEFAULT NULL,
  `mis_1_given` date DEFAULT NULL,
  `mis_1_next_visit` date DEFAULT NULL,
  `present_checked` date DEFAULT NULL,
  `present_repeated` date DEFAULT NULL,
  `absent_checked` date DEFAULT NULL,
  `absent_repeated` date DEFAULT NULL,
  `birth_dose_given` date DEFAULT NULL,
  `birth_does_next_visit` date DEFAULT NULL,
  `pollo_first_dose_given` date DEFAULT NULL,
  `pollo_first_does_next_visit` date DEFAULT NULL,
  `pollo_second_dose_given` date DEFAULT NULL,
  `pollo_second_does_next_visit` date DEFAULT NULL,
  `pollo_third_dose_given` date DEFAULT NULL,
  `pollo_third_does_next_visit` date DEFAULT NULL,
  `dphtheria_first_dose_given` date DEFAULT NULL,
  `dphtheria_first_dose_next_visit` date DEFAULT NULL,
  `dphtheria_second_dose_given` date DEFAULT NULL,
  `dphtheria_second_does_next_visit` date DEFAULT NULL,
  `dphtheria_third_dose_given` date DEFAULT NULL,
  `dphtheria_third_does_next_visit` date DEFAULT NULL,
  `pneumococcal_first_dose_given` date DEFAULT NULL,
  `pneumococcal_first_does_next_visit` date DEFAULT NULL,
  `pneumococcal_second_dose_given` date DEFAULT NULL,
  `pneumococcal_second_does_next_visit` date DEFAULT NULL,
  `pneumococcal_third_dose_given` date DEFAULT NULL,
  `pneumococcal_third_does_next_visit` date DEFAULT NULL,
  `rota_first_dose_given` date DEFAULT NULL,
  `rota_first_does_next_visit` date DEFAULT NULL,
  `rota_second_dose_given` date DEFAULT NULL,
  `rota_second_does_next_visit` date DEFAULT NULL,
  `measles_6_months_date` date DEFAULT NULL,
  `measles_9_months_date` date DEFAULT NULL,
  `measles_18_months_date` date DEFAULT NULL,
  `yellow_fever_date` date DEFAULT NULL,
  `other_vaccine` tinytext,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  `form_type` enum('child welfare care') GENERATED ALWAYS AS ('child welfare care') VIRTUAL,
  PRIMARY KEY (`child_welfare_care_id`),
  UNIQUE KEY `child_welfare_care_id_UNIQUE` (`child_welfare_care_id`),
  KEY `client_id_child_welfare_care_idx` (`client_id`),
  CONSTRAINT `client_id_child_welfare_care` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `child_welfare_care_history`
--

DROP TABLE IF EXISTS `child_welfare_care_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `child_welfare_care_history` (
  `child_welfare_care_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `child_welfare_care_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `child_particulars` date DEFAULT NULL,
  `child_name` varchar(45) DEFAULT NULL,
  `child_gender` enum('male','female') DEFAULT NULL,
  `child_date_of_birth` date DEFAULT NULL,
  `birth_weight` decimal(6,3) unsigned DEFAULT NULL,
  `birth_length` int(11) DEFAULT NULL,
  `birth_characteristics` varchar(45) DEFAULT NULL,
  `birth_order` int(11) DEFAULT NULL,
  `first_seen` date DEFAULT NULL,
  `birth_place` enum('health_facility','home','other') DEFAULT NULL,
  `other_birth_place` varchar(45) DEFAULT NULL,
  `notification_number` varchar(45) DEFAULT NULL,
  `notification_date` date DEFAULT NULL,
  `register_number` varchar(45) DEFAULT NULL,
  `child_welfare_clinic` varchar(45) DEFAULT NULL,
  `health_facility` varchar(45) DEFAULT NULL,
  `master_facility_list_number` varchar(45) DEFAULT NULL,
  `birth_certificate_number` varchar(45) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `registration_place` varchar(45) DEFAULT NULL,
  `abnormalities` tinytext,
  `father_name` varchar(45) DEFAULT NULL,
  `father_phone_number` varchar(45) DEFAULT NULL,
  `mother_name` varchar(45) DEFAULT NULL,
  `mother_phone_number` varchar(45) DEFAULT NULL,
  `guardian_name` varchar(45) DEFAULT NULL,
  `guardian_phone_number` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `district` varchar(45) DEFAULT NULL,
  `division` varchar(45) DEFAULT NULL,
  `child_location` varchar(45) DEFAULT NULL,
  `town` varchar(45) DEFAULT NULL,
  `village` varchar(45) DEFAULT NULL,
  `post_address` varchar(45) DEFAULT NULL,
  `age_first_contact` int(11) DEFAULT NULL,
  `weight` decimal(6,3) unsigned DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `physical_features` varchar(45) DEFAULT NULL,
  `colouration` varchar(45) DEFAULT NULL,
  `head_circumference` int(11) DEFAULT NULL,
  `eyes` varchar(45) DEFAULT NULL,
  `mouth` varchar(45) DEFAULT NULL,
  `chest` varchar(45) DEFAULT NULL,
  `heart` varchar(45) DEFAULT NULL,
  `abdomen` varchar(45) DEFAULT NULL,
  `umbilicus` varchar(45) DEFAULT NULL,
  `spine` varchar(45) DEFAULT NULL,
  `arms_and_hands` varchar(45) DEFAULT NULL,
  `legs_and_feet` varchar(45) DEFAULT NULL,
  `genitalia` varchar(45) DEFAULT NULL,
  `anus` varchar(45) DEFAULT NULL,
  `breastfeeding` enum('well','poorly','unable') DEFAULT NULL,
  `feeds` enum('yes','no') DEFAULT NULL,
  `feeds_age` int(11) DEFAULT NULL,
  `other_foods_introduced` enum('yes','no') DEFAULT NULL,
  `indigestion` varchar(45) DEFAULT NULL,
  `sleep_cycle` varchar(45) DEFAULT NULL,
  `irritability` enum('yes','no') DEFAULT NULL,
  `finger_sucking` enum('yes','no') DEFAULT NULL,
  `others` enum('yes','no') DEFAULT NULL,
  `mis_05_given` date DEFAULT NULL,
  `mis_05_next_visit` date DEFAULT NULL,
  `mis_1_given` date DEFAULT NULL,
  `mis_1_next_visit` date DEFAULT NULL,
  `present_checked` date DEFAULT NULL,
  `present_repeated` date DEFAULT NULL,
  `absent_checked` date DEFAULT NULL,
  `absent_repeated` date DEFAULT NULL,
  `birth_dose_given` date DEFAULT NULL,
  `birth_does_next_visit` date DEFAULT NULL,
  `pollo_first_dose_given` date DEFAULT NULL,
  `pollo_first_does_next_visit` date DEFAULT NULL,
  `pollo_second_dose_given` date DEFAULT NULL,
  `pollo_second_does_next_visit` date DEFAULT NULL,
  `pollo_third_dose_given` date DEFAULT NULL,
  `pollo_third_does_next_visit` date DEFAULT NULL,
  `dphtheria_first_dose_given` date DEFAULT NULL,
  `dphtheria_first_dose_next_visit` date DEFAULT NULL,
  `dphtheria_second_dose_given` date DEFAULT NULL,
  `dphtheria_second_does_next_visit` date DEFAULT NULL,
  `dphtheria_third_dose_given` date DEFAULT NULL,
  `dphtheria_third_does_next_visit` date DEFAULT NULL,
  `pneumococcal_first_dose_given` date DEFAULT NULL,
  `pneumococcal_first_does_next_visit` date DEFAULT NULL,
  `pneumococcal_second_dose_given` date DEFAULT NULL,
  `pneumococcal_second_does_next_visit` date DEFAULT NULL,
  `pneumococcal_third_dose_given` date DEFAULT NULL,
  `pneumococcal_third_does_next_visit` date DEFAULT NULL,
  `rota_first_dose_given` date DEFAULT NULL,
  `rota_first_does_next_visit` date DEFAULT NULL,
  `rota_second_dose_given` date DEFAULT NULL,
  `rota_second_does_next_visit` date DEFAULT NULL,
  `measles_6_months_date` date DEFAULT NULL,
  `measles_9_months_date` date DEFAULT NULL,
  `measles_18_months_date` date DEFAULT NULL,
  `yellow_fever_date` date DEFAULT NULL,
  `other_vaccine` tinytext,
  `timestamp` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`child_welfare_care_history_id`),
  UNIQUE KEY `child_welfare_care_history_id_UNIQUE` (`child_welfare_care_history_id`),
  KEY `client_id_child_welfare_care_idx` (`client_id`),
  CONSTRAINT `client_id_child_welfare_care_history` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dental_form`
--

DROP TABLE IF EXISTS `dental_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dental_form` (
  `dental_form_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `pain` enum('none','mild','moderate','severe') DEFAULT 'none',
  `t` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `pr` varchar(10) DEFAULT NULL,
  `rr` varchar(10) DEFAULT NULL,
  `wt` varchar(10) DEFAULT NULL,
  `latex_glove_allergy` enum('yes','no') DEFAULT 'no',
  `ulcers` enum('yes','no') DEFAULT 'no',
  `diabetes` enum('yes','no') DEFAULT 'no',
  `epilepsy` enum('yes','no') DEFAULT 'no',
  `hemophilia_bleeding` enum('yes','no') DEFAULT 'no',
  `pregnant` enum('yes','no') DEFAULT 'no',
  `herbs` enum('yes','no') DEFAULT 'no',
  `heart_problems` enum('yes','no') DEFAULT 'no',
  `hepatitis_liver_problem` enum('yes','no') DEFAULT 'no',
  `cough` enum('yes','no') DEFAULT 'no',
  `tuberculosis` enum('yes','no') DEFAULT 'no',
  `asthma` enum('yes','no') DEFAULT 'no',
  `fainting` enum('yes','no') DEFAULT 'no',
  `family_planning_pills` enum('yes','no') DEFAULT 'no',
  `blood_thinners` enum('yes','no') DEFAULT 'no',
  `high_blood_presure` enum('yes','no') DEFAULT 'no',
  `anemia` enum('yes','no') DEFAULT 'no',
  `penicillin` enum('yes','no') DEFAULT 'no',
  `codeine` enum('yes','no') DEFAULT 'no',
  `local_anesthesia` enum('yes','no') DEFAULT 'no',
  `sulfur` enum('yes','no') DEFAULT 'no',
  `aspirin` enum('yes','no') DEFAULT 'no',
  `other_allergie` varchar(20) DEFAULT NULL,
  `teeth_sensitive_hot` enum('yes','no') DEFAULT 'no',
  `teeth_sensitive_cold` enum('yes','no') DEFAULT 'no',
  `teeth_sensitive_biting` enum('yes','no') DEFAULT 'no',
  `teeth_sensitive_sweets` enum('yes','no') DEFAULT 'no',
  `gums_bleeding` enum('yes','no') DEFAULT 'no',
  `gums_painful` enum('yes','no') DEFAULT 'no',
  `loose_teeth` enum('yes','no') DEFAULT 'no',
  `jaw_not_opening_closing` enum('yes','no') DEFAULT 'no',
  `pain_jaw_ear_face` enum('yes','no') DEFAULT 'no',
  `teeth_grinding` enum('yes','no') DEFAULT 'no',
  `previous_extractions` enum('yes','no') DEFAULT 'no',
  `previous_periodontic_treatment` enum('yes','no') DEFAULT 'no',
  `current_medications` tinytext,
  `findings` tinytext,
  `treatment` tinytext,
  `notes` tinytext,
  `image_path` varchar(1000) DEFAULT 'no_image',
  `dental_provider` varchar(20) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`dental_form_id`),
  UNIQUE KEY `dental_form_id_UNIQUE` (`dental_form_id`),
  KEY `test_idx` (`client_id`),
  CONSTRAINT `client_id_dental` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dental_form_history`
--

DROP TABLE IF EXISTS `dental_form_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dental_form_history` (
  `dental_form_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dental_form_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `pain` enum('none','mild','moderate','severe') DEFAULT 'none',
  `t` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `pr` varchar(10) DEFAULT NULL,
  `rr` varchar(10) DEFAULT NULL,
  `wt` varchar(10) DEFAULT NULL,
  `latex_glove_allergy` enum('yes','no') DEFAULT 'no',
  `ulcers` enum('yes','no') DEFAULT 'no',
  `diabetes` enum('yes','no') DEFAULT 'no',
  `epilepsy` enum('yes','no') DEFAULT 'no',
  `hemophilia_bleeding` enum('yes','no') DEFAULT 'no',
  `pregnant` enum('yes','no') DEFAULT 'no',
  `herbs` enum('yes','no') DEFAULT 'no',
  `heart_problems` enum('yes','no') DEFAULT 'no',
  `hepatitis_liver_problem` enum('yes','no') DEFAULT 'no',
  `cough` enum('yes','no') DEFAULT 'no',
  `tuberculosis` enum('yes','no') DEFAULT 'no',
  `asthma` enum('yes','no') DEFAULT 'no',
  `fainting` enum('yes','no') DEFAULT 'no',
  `family_planning_pills` enum('yes','no') DEFAULT 'no',
  `blood_thinners` enum('yes','no') DEFAULT 'no',
  `high_blood_presure` enum('yes','no') DEFAULT 'no',
  `anemia` enum('yes','no') DEFAULT 'no',
  `penicillin` enum('yes','no') DEFAULT 'no',
  `codeine` enum('yes','no') DEFAULT 'no',
  `local_anesthesia` enum('yes','no') DEFAULT 'no',
  `sulfur` enum('yes','no') DEFAULT 'no',
  `aspirin` enum('yes','no') DEFAULT 'no',
  `other_allergie` varchar(20) DEFAULT NULL,
  `teeth_sensitive_hot` enum('yes','no') DEFAULT 'no',
  `teeth_sensitive_cold` enum('yes','no') DEFAULT 'no',
  `teeth_sensitive_biting` enum('yes','no') DEFAULT 'no',
  `teeth_sensitive_sweets` enum('yes','no') DEFAULT 'no',
  `gums_bleeding` enum('yes','no') DEFAULT 'no',
  `gums_painful` enum('yes','no') DEFAULT 'no',
  `loose_teeth` enum('yes','no') DEFAULT 'no',
  `jaw_not_opening_closing` enum('yes','no') DEFAULT 'no',
  `pain_jaw_ear_face` enum('yes','no') DEFAULT 'no',
  `teeth_grinding` enum('yes','no') DEFAULT 'no',
  `previous_extractions` enum('yes','no') DEFAULT 'no',
  `previous_periodontic_treatment` enum('yes','no') DEFAULT 'no',
  `current_medications` tinytext,
  `findings` tinytext,
  `treatment` tinytext,
  `notes` tinytext,
  `image_path` varchar(1000) DEFAULT NULL,
  `dental_provider` varchar(20) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`dental_form_history_id`),
  UNIQUE KEY `dental_form_history_id_UNIQUE` (`dental_form_history_id`),
  KEY `test_idx` (`client_id`),
  KEY `created_by_idx` (`created_by`),
  CONSTRAINT `client_id_dental_form_history` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `diagnoses`
--

DROP TABLE IF EXISTS `diagnoses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diagnoses` (
  `diagnosis_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `form_id` int(11) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `diagnosis` varchar(45) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `form_type` enum('treatment','return_treatment') DEFAULT 'treatment',
  PRIMARY KEY (`diagnosis_id`),
  UNIQUE KEY `diagnoses_id_UNIQUE` (`diagnosis_id`),
  KEY `client_id_diagnoses_idx` (`client_id`),
  CONSTRAINT `client_id_diagnoses` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `diagnoses_history`
--

DROP TABLE IF EXISTS `diagnoses_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diagnoses_history` (
  `diagnosis_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `diagnosis_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `form_id` int(11) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `diagnosis` varchar(45) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `form_type` enum('treatment','return_treatment') DEFAULT 'treatment',
  PRIMARY KEY (`diagnosis_history_id`),
  UNIQUE KEY `diagnosis_history_id_UNIQUE` (`diagnosis_history_id`),
  KEY `client_id_diagnoses_history_idx` (`client_id`),
  CONSTRAINT `client_id_diagnoses_history` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `diagnoses_temp`
--

DROP TABLE IF EXISTS `diagnoses_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diagnoses_temp` (
  `diagnosis` varchar(45) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `form_type` enum('treatment','return_treatment') DEFAULT 'treatment'
) ENGINE=MEMORY DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `diagnosis_types`
--

DROP TABLE IF EXISTS `diagnosis_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diagnosis_types` (
  `diagnosis_types_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `diagnosis_type` varchar(45) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`diagnosis_types_id`),
  UNIQUE KEY `diagnoses_id_UNIQUE` (`diagnosis_types_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `discharge_form`
--

DROP TABLE IF EXISTS `discharge_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discharge_form` (
  `discharge_form_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `t` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `pr` varchar(10) DEFAULT NULL,
  `sao2` varchar(10) DEFAULT NULL,
  `pain` enum('none','moderate','mild','severe') DEFAULT NULL,
  `doa` date DEFAULT NULL,
  `dod` date DEFAULT NULL,
  `history` tinytext,
  `physical_examination` tinytext,
  `impression` tinytext,
  `plan` tinytext,
  `discharge_summary` tinytext,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`discharge_form_id`),
  UNIQUE KEY `discharge_form_id_UNIQUE` (`discharge_form_id`),
  KEY `client_id_discharge_idx` (`client_id`),
  CONSTRAINT `client_id_discharge` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `discharge_form_history`
--

DROP TABLE IF EXISTS `discharge_form_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discharge_form_history` (
  `discharge_form_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `discharge_form_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `t` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `pr` varchar(10) DEFAULT NULL,
  `sao2` varchar(10) DEFAULT NULL,
  `pain` enum('none','moderate','mild','severe') DEFAULT NULL,
  `doa` date DEFAULT NULL,
  `dod` date DEFAULT NULL,
  `history` tinytext,
  `physical_examination` tinytext,
  `impression` tinytext,
  `plan` tinytext,
  `discharge_summary` tinytext,
  `timestamp` datetime DEFAULT NULL,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`discharge_form_history_id`),
  UNIQUE KEY `discharge_form_history_id_UNIQUE` (`discharge_form_history_id`),
  KEY `client_id_discharge_idx` (`client_id`),
  KEY `created_by_discharge_idx` (`created_by`),
  CONSTRAINT `client_id_discharge_history` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `error`
--

DROP TABLE IF EXISTS `error`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `error` (
  `error_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(11) unsigned NOT NULL,
  `error_location` varchar(50) DEFAULT NULL,
  `query` text,
  `database_error` text,
  `browser` enum('Internet Explorer','Mozilla Firefox','Opera','Google Chrome','Apple Safari','Netscape','Unknown') DEFAULT 'Unknown',
  `version` varchar(30) DEFAULT NULL,
  `platform` enum('linux','mac','windows','unknown') DEFAULT 'unknown',
  `time_of_error` datetime DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `issue_resolved` enum('yes','no') DEFAULT 'no',
  `notes` tinytext,
  PRIMARY KEY (`error_id`),
  UNIQUE KEY `error_id_UNIQUE` (`error_id`),
  KEY `account_id_error_idx` (`account_id`),
  CONSTRAINT `account_id_error` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `general_info`
--

DROP TABLE IF EXISTS `general_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `general_info` (
  `client_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `national_id` varchar(30) DEFAULT NULL,
  `guardian_name` varchar(45) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `occupation` varchar(45) DEFAULT NULL,
  `education` varchar(45) DEFAULT NULL,
  `emergency_contact` varchar(50) DEFAULT NULL,
  `allergies` varchar(45) DEFAULT NULL,
  `hiv_status` enum('unknown','positive','negitive') DEFAULT 'unknown',
  `alcohol_use` enum('never','sometimes','often','unknown') DEFAULT 'never',
  `medical_history` tinytext,
  `regular_medications` tinytext,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `client_id_UNIQUE` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `general_info_history`
--

DROP TABLE IF EXISTS `general_info_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `general_info_history` (
  `client_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `national_id` varchar(30) DEFAULT NULL,
  `guardian_name` varchar(45) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `occupation` varchar(45) DEFAULT NULL,
  `education` varchar(45) DEFAULT NULL,
  `emergency_contact` varchar(20) DEFAULT NULL,
  `allergies` varchar(45) DEFAULT NULL,
  `hiv_status` enum('unknown','positive','negitive') DEFAULT 'unknown',
  `alcohol_use` enum('never','sometimes','often','unknown') DEFAULT 'never',
  `medical_history` tinytext,
  `regular_medications` tinytext,
  `timestamp` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`client_history_id`),
  UNIQUE KEY `client_history_id_UNIQUE` (`client_history_id`),
  KEY `created_by_general_info_idx` (`created_by`),
  KEY `client_id_general_info_history_idx` (`client_id`),
  CONSTRAINT `client_id_general_info_history` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lab`
--

DROP TABLE IF EXISTS `lab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab` (
  `lab_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `bs_for_mps` enum('yes','no') DEFAULT 'no',
  `bs_for_mps_results` enum('no mps seen','mps+1','mps+2','mps+3','') DEFAULT '',
  `pbf` enum('yes','no') DEFAULT 'no',
  `pbf_results` varchar(45) DEFAULT NULL,
  `widal` enum('yes','no') DEFAULT 'no',
  `th1` varchar(10) DEFAULT NULL,
  `th0` varchar(10) DEFAULT NULL,
  `brucella` enum('yes','no') DEFAULT 'no',
  `bm1` varchar(10) DEFAULT NULL,
  `ba1` varchar(10) DEFAULT NULL,
  `vdrl_rpr` enum('yes','no') DEFAULT 'no',
  `vdrl_rpr_results` enum('reactive','non_reactive','') DEFAULT '',
  `p24_hiv` enum('yes','no') DEFAULT 'no',
  `reactive_p24_hiv` enum('reactive','non_reactive','') DEFAULT '',
  `blood_sugar` enum('yes','no') DEFAULT 'no',
  `blood_sugar_results` varchar(30) DEFAULT NULL,
  `hba1c` enum('yes','no') DEFAULT 'no',
  `hba1c_results` varchar(45) DEFAULT NULL,
  `bun` enum('yes','no') DEFAULT 'no',
  `bun_results` varchar(45) DEFAULT NULL,
  `hematocrit` enum('yes','no') DEFAULT 'no',
  `hematocrit_results` varchar(45) DEFAULT NULL,
  `creatinine` enum('yes','no') DEFAULT 'no',
  `creatinine_results` varchar(45) DEFAULT NULL,
  `electrolytes` enum('yes','no') DEFAULT 'no',
  `electrolytes_results` varchar(45) DEFAULT NULL,
  `pylori_stool` enum('yes','no') DEFAULT 'no',
  `pylori_stool_results` enum('positive','negative','') DEFAULT '',
  `pylori_blood` enum('yes','no') DEFAULT 'no',
  `pylori_blood_results` enum('positive','negative','') DEFAULT '',
  `rheumatoid_factor` enum('yes','no') DEFAULT 'no',
  `rheumatoid_factor_results` enum('reactive','non_reactive','') DEFAULT '',
  `stool` enum('yes','no') DEFAULT 'no',
  `app` varchar(45) DEFAULT NULL,
  `mic` varchar(45) DEFAULT NULL,
  `blood_group` enum('yes','no') DEFAULT 'no',
  `blood_group_rh` enum('rh-ve','rh+ve','') DEFAULT '',
  `blood_group_type` enum('a','b','o','ab','') DEFAULT NULL,
  `du_test` varchar(45) DEFAULT NULL,
  `pregnancy_test` enum('yes','no') DEFAULT 'no',
  `pregnancy_test_results` enum('hcg_detected','no_hcg_detected','') DEFAULT '',
  `hb` enum('yes','no') DEFAULT 'no',
  `hb_results` varchar(30) DEFAULT NULL,
  `urinalysis` enum('yes','no') DEFAULT 'no',
  `urinalysis_urobilinogen` enum('neg','+-','+','++','+++','') DEFAULT '',
  `urinalysis_glucose` enum('neg','+-','+','++','+++','') DEFAULT '',
  `urinalysis_bilirubin` enum('neg','+-','++','+++','') DEFAULT '',
  `urinalysis_ketones` enum('neg','+-','+','++','+++','') DEFAULT '',
  `urinalysis_specific_gravity` enum('1.000','1.005','1.010','1.015','1.020','1.025','1.030','') DEFAULT '',
  `urinalysis_blood` enum('neg','+','++','+++','non_hemolysis','') DEFAULT '',
  `urinalysis_ph` enum('5','6','6.5','7','8','9','') DEFAULT '',
  `urinalysis_protein` enum('neg','trace','+','++','+++','++++','') DEFAULT '',
  `urinalysis_nitrite` enum('neg','trace','pos','') DEFAULT '',
  `urinalysis_leukocytes` enum('neg','+','++','+++','') DEFAULT '',
  `urinalysis_microscopy` varchar(45) DEFAULT NULL,
  `hvs` enum('yes','no') DEFAULT 'no',
  `hvs_macroscopy` varchar(45) DEFAULT NULL,
  `hvs_microscopy` varchar(45) DEFAULT NULL,
  `hvs_gram_stain` tinytext,
  `culture` tinytext,
  `blood_count` enum('yes','no') DEFAULT 'no',
  `rbc` varchar(45) DEFAULT NULL,
  `arterial_blood` enum('yes','no') DEFAULT 'no',
  `pao2_text` varchar(45) DEFAULT NULL,
  `paco2_text` varchar(45) DEFAULT NULL,
  `blood_ph_text` varchar(45) DEFAULT NULL,
  `sao2_text` varchar(45) DEFAULT NULL,
  `hco3_text` varchar(45) DEFAULT NULL,
  `liver` enum('yes','no') DEFAULT 'no',
  `alt_text` varchar(45) DEFAULT NULL,
  `ast_text` varchar(45) DEFAULT NULL,
  `albumin_text` varchar(45) DEFAULT NULL,
  `prothrombin` enum('yes','no') DEFAULT 'no',
  `prothrombin_text` varchar(45) DEFAULT NULL,
  `inr` enum('yes','no') DEFAULT 'yes',
  `inr_text` varchar(45) DEFAULT NULL,
  `tft` enum('yes','no') DEFAULT 'yes',
  `tsh_text` varchar(45) DEFAULT NULL,
  `freet3_text` varchar(45) DEFAULT NULL,
  `freet4_text` varchar(45) DEFAULT NULL,
  `cholesterol` enum('yes','no') DEFAULT 'yes',
  `total_text` varchar(45) DEFAULT NULL,
  `hdl_text` varchar(45) DEFAULT NULL,
  `ldl_text` varchar(45) DEFAULT NULL,
  `cardiac` enum('yes','no') DEFAULT 'yes',
  `troponin_text` varchar(45) DEFAULT NULL,
  `ck_text` varchar(45) DEFAULT NULL,
  `hct_text` varchar(45) DEFAULT NULL,
  `mcv_text` varchar(45) DEFAULT NULL,
  `rdw_text` varchar(45) DEFAULT NULL,
  `wbc_text` varchar(45) DEFAULT NULL,
  `platelet_text` varchar(45) DEFAULT NULL,
  `neutrophils_text` varchar(45) DEFAULT NULL,
  `lymphocytes_text` varchar(45) DEFAULT NULL,
  `monocytes_text` varchar(45) DEFAULT NULL,
  `eosinophils_text` varchar(45) DEFAULT NULL,
  `basophils_text` varchar(45) DEFAULT NULL,
  `blood_chemistry` enum('yes','no') DEFAULT 'yes',
  `sodium_text` varchar(45) DEFAULT NULL,
  `chloride_text` varchar(45) DEFAULT NULL,
  `potassium_text` varchar(45) DEFAULT NULL,
  `calcium_text` varchar(45) DEFAULT NULL,
  `bicarbonate_text` varchar(45) DEFAULT NULL,
  `glucose_fasting_text` varchar(45) DEFAULT NULL,
  `random_text` varchar(45) DEFAULT NULL,
  `bun_text` varchar(45) DEFAULT NULL,
  `creatinine_text` varchar(45) DEFAULT NULL,
  `hba1c_text` varchar(45) DEFAULT NULL,
  `lab_order_id` int(11) unsigned DEFAULT NULL,
  `clinician` varchar(20) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`lab_id`),
  UNIQUE KEY `lab_id_UNIQUE` (`lab_id`),
  KEY `lab_client_id_idx` (`client_id`),
  CONSTRAINT `client_id_lab` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lab_history`
--

DROP TABLE IF EXISTS `lab_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_history` (
  `lab_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `lab_id` int(11) unsigned DEFAULT NULL,
  `client_id` int(11) unsigned DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `bs_for_mps` enum('yes','no') DEFAULT 'no',
  `bs_for_mps_results` enum('no mps seen','mps+1','mps+2','mps+3','') DEFAULT '',
  `pbf` enum('yes','no') DEFAULT 'no',
  `pbf_results` varchar(45) DEFAULT NULL,
  `widal` enum('yes','no') DEFAULT 'no',
  `th1` varchar(10) DEFAULT NULL,
  `th0` varchar(10) DEFAULT NULL,
  `brucella` enum('yes','no') DEFAULT 'no',
  `bm1` varchar(10) DEFAULT NULL,
  `ba1` varchar(10) DEFAULT NULL,
  `vdrl_rpr` enum('yes','no') DEFAULT 'no',
  `vdrl_rpr_results` enum('reactive','non_reactive','') DEFAULT '',
  `p24_hiv` enum('yes','no') DEFAULT 'no',
  `reactive_p24_hiv` enum('reactive','non_reactive','') DEFAULT '',
  `blood_sugar` enum('yes','no') DEFAULT 'no',
  `blood_sugar_results` varchar(30) DEFAULT NULL,
  `hba1c` enum('yes','no') DEFAULT 'no',
  `hba1c_results` varchar(45) DEFAULT NULL,
  `bun` enum('yes','no') DEFAULT 'no',
  `bun_results` varchar(45) DEFAULT NULL,
  `hematocrit` enum('yes','no') DEFAULT 'no',
  `hematocrit_results` varchar(45) DEFAULT NULL,
  `creatinine` enum('yes','no') DEFAULT 'no',
  `creatinine_results` varchar(45) DEFAULT NULL,
  `electrolytes` enum('yes','no') DEFAULT 'no',
  `electrolytes_results` varchar(45) DEFAULT NULL,
  `pylori_stool` enum('yes','no') DEFAULT 'no',
  `pylori_stool_results` enum('positive','negative','') DEFAULT '',
  `pylori_blood` enum('yes','no') DEFAULT 'no',
  `pylori_blood_results` enum('positive','negative','') DEFAULT '',
  `rheumatoid_factor` enum('yes','no') DEFAULT 'no',
  `rheumatoid_factor_results` enum('reactive','non_reactive','') DEFAULT '',
  `stool` enum('yes','no') DEFAULT 'no',
  `app` varchar(45) DEFAULT NULL,
  `mic` varchar(45) DEFAULT NULL,
  `blood_group` enum('yes','no') DEFAULT 'no',
  `blood_group_rh` enum('rh-ve','rh+ve','') DEFAULT '',
  `blood_group_type` enum('a','b','o','ab','') DEFAULT NULL,
  `du_test` varchar(45) DEFAULT NULL,
  `pregnancy_test` enum('yes','no') DEFAULT 'no',
  `pregnancy_test_results` enum('hcg_detected','no_hcg_detected','') DEFAULT '',
  `hb` enum('yes','no') DEFAULT 'no',
  `hb_results` varchar(30) DEFAULT NULL,
  `urinalysis` enum('yes','no') DEFAULT 'no',
  `urinalysis_urobilinogen` enum('neg','+-','+','++','+++','') DEFAULT '',
  `urinalysis_glucose` enum('neg','+-','+','++','+++','') DEFAULT '',
  `urinalysis_bilirubin` enum('neg','+-','++','+++','') DEFAULT '',
  `urinalysis_ketones` enum('neg','+-','+','++','+++','') DEFAULT '',
  `urinalysis_specific_gravity` enum('1.000','1.005','1.010','1.015','1.020','1.025','1.030','') DEFAULT '',
  `urinalysis_blood` enum('neg','+','++','+++','non_hemolysis','') DEFAULT '',
  `urinalysis_ph` enum('5','6','6.5','7','8','9','') DEFAULT '',
  `urinalysis_protein` enum('neg','trace','+','++','+++','++++','') DEFAULT '',
  `urinalysis_nitrite` enum('neg','trace','pos','') DEFAULT '',
  `urinalysis_leukocytes` enum('neg','+','++','+++','') DEFAULT '',
  `urinalysis_microscopy` varchar(45) DEFAULT NULL,
  `hvs` enum('yes','no') DEFAULT 'no',
  `hvs_macroscopy` varchar(45) DEFAULT NULL,
  `hvs_microscopy` varchar(45) DEFAULT NULL,
  `hvs_gram_stain` tinytext,
  `culture` tinytext,
  `blood_count` enum('yes','no') DEFAULT 'no',
  `rbc` varchar(45) DEFAULT NULL,
  `arterial_blood` enum('yes','no') DEFAULT 'no',
  `pao2_text` varchar(45) DEFAULT NULL,
  `paco2_text` varchar(45) DEFAULT NULL,
  `blood_ph_text` varchar(45) DEFAULT NULL,
  `sao2_text` varchar(45) DEFAULT NULL,
  `hco3_text` varchar(45) DEFAULT NULL,
  `liver` enum('yes','no') DEFAULT 'no',
  `alt_text` varchar(45) DEFAULT NULL,
  `ast_text` varchar(45) DEFAULT NULL,
  `albumin_text` varchar(45) DEFAULT NULL,
  `prothrombin` enum('yes','no') DEFAULT 'no',
  `prothrombin_text` varchar(45) DEFAULT NULL,
  `inr` enum('yes','no') DEFAULT 'yes',
  `inr_text` varchar(45) DEFAULT NULL,
  `tft` enum('yes','no') DEFAULT 'yes',
  `tsh_text` varchar(45) DEFAULT NULL,
  `freet3_text` varchar(45) DEFAULT NULL,
  `freet4_text` varchar(45) DEFAULT NULL,
  `cholesterol` enum('yes','no') DEFAULT 'yes',
  `total_text` varchar(45) DEFAULT NULL,
  `hdl_text` varchar(45) DEFAULT NULL,
  `ldl_text` varchar(45) DEFAULT NULL,
  `cardiac` enum('yes','no') DEFAULT 'yes',
  `troponin_text` varchar(45) DEFAULT NULL,
  `ck_text` varchar(45) DEFAULT NULL,
  `hct_text` varchar(45) DEFAULT NULL,
  `mcv_text` varchar(45) DEFAULT NULL,
  `rdw_text` varchar(45) DEFAULT NULL,
  `wbc_text` varchar(45) DEFAULT NULL,
  `platelet_text` varchar(45) DEFAULT NULL,
  `neutrophils_text` varchar(45) DEFAULT NULL,
  `lymphocytes_text` varchar(45) DEFAULT NULL,
  `monocytes_text` varchar(45) DEFAULT NULL,
  `eosinophils_text` varchar(45) DEFAULT NULL,
  `basophils_text` varchar(45) DEFAULT NULL,
  `blood_chemistry` enum('yes','no') DEFAULT 'yes',
  `sodium_text` varchar(45) DEFAULT NULL,
  `chloride_text` varchar(45) DEFAULT NULL,
  `potassium_text` varchar(45) DEFAULT NULL,
  `calcium_text` varchar(45) DEFAULT NULL,
  `bicarbonate_text` varchar(45) DEFAULT NULL,
  `glucose_fasting_text` varchar(45) DEFAULT NULL,
  `random_text` varchar(45) DEFAULT NULL,
  `bun_text` varchar(45) DEFAULT NULL,
  `creatinine_text` varchar(45) DEFAULT NULL,
  `hba1c_text` varchar(45) DEFAULT NULL,
  `lab_order_id` int(11) unsigned DEFAULT NULL,
  `clinician` varchar(20) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`lab_history_id`),
  UNIQUE KEY `lab_id_UNIQUE` (`lab_history_id`),
  KEY `lab_client_id_idx` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lab_order`
--

DROP TABLE IF EXISTS `lab_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_order` (
  `lab_order_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `bs_for_mps` enum('yes','no') DEFAULT 'no',
  `pbf` enum('yes','no') DEFAULT 'no',
  `widal` enum('yes','no') DEFAULT 'no',
  `brucella` enum('yes','no') DEFAULT 'no',
  `vdrl_rpr` enum('yes','no') DEFAULT 'no',
  `p24_hiv` enum('yes','no') DEFAULT 'no',
  `blood_sugar` enum('yes','no') DEFAULT 'no',
  `stool` enum('yes','no') DEFAULT 'no',
  `blood_group` enum('yes','no') DEFAULT 'no',
  `pregnancy_test` enum('yes','no') DEFAULT 'no',
  `hb` enum('yes','no') DEFAULT 'no',
  `urinalysis` enum('yes','no') DEFAULT 'no',
  `hvs` enum('yes','no') DEFAULT 'no',
  `completed_by` varchar(20) DEFAULT NULL,
  `h_pylori_stool` enum('yes','no') DEFAULT 'no',
  `h_pylori_blood` enum('yes','no') DEFAULT NULL,
  `rheumatoid_factor` enum('yes','no') DEFAULT NULL,
  `cholesterol` enum('yes','no') DEFAULT NULL,
  `culture` enum('yes','no') DEFAULT NULL,
  `blood_count` enum('yes','no') DEFAULT NULL,
  `blood_chemistry` enum('yes','no') DEFAULT NULL,
  `arterial_blood` enum('yes','no') DEFAULT NULL,
  `liver_function_test` enum('yes','no') DEFAULT NULL,
  `prothrombin_time` enum('yes','no') DEFAULT NULL,
  `inr` enum('yes','no') DEFAULT NULL,
  `thyroid_function_test` enum('yes','no') DEFAULT NULL,
  `gram_stain` enum('yes','no') DEFAULT NULL,
  `cardiac` enum('yes','no') DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_completed` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`lab_order_id`),
  UNIQUE KEY `lab_order_id_UNIQUE` (`lab_order_id`),
  KEY `client_id_lab_order_idx` (`client_id`),
  CONSTRAINT `client_id_lab_order` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lab_order_history`
--

DROP TABLE IF EXISTS `lab_order_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_order_history` (
  `lab_order_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lab_order_id` int(11) unsigned DEFAULT NULL,
  `client_id` int(11) unsigned DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `bs_for_mps` enum('yes','no') DEFAULT 'no',
  `pbf` enum('yes','no') DEFAULT 'no',
  `widal` enum('yes','no') DEFAULT 'no',
  `brucella` enum('yes','no') DEFAULT 'no',
  `vdrl_rpr` enum('yes','no') DEFAULT 'no',
  `p24_hiv` enum('yes','no') DEFAULT 'no',
  `blood_sugar` enum('yes','no') DEFAULT 'no',
  `stool` enum('yes','no') DEFAULT 'no',
  `blood_group` enum('yes','no') DEFAULT 'no',
  `pregnancy_test` enum('yes','no') DEFAULT 'no',
  `hb` enum('yes','no') DEFAULT 'no',
  `urinalysis` enum('yes','no') DEFAULT 'no',
  `hvs` enum('yes','no') DEFAULT 'no',
  `completed_by` varchar(20) DEFAULT NULL,
  `h_pylori_stool` enum('yes','no') DEFAULT 'no',
  `h_pylori_blood` enum('yes','no') DEFAULT NULL,
  `rheumatoid_factor` enum('yes','no') DEFAULT NULL,
  `cholesterol` enum('yes','no') DEFAULT NULL,
  `culture` enum('yes','no') DEFAULT NULL,
  `blood_count` enum('yes','no') DEFAULT NULL,
  `blood_chemistry` enum('yes','no') DEFAULT NULL,
  `arterial_blood` enum('yes','no') DEFAULT NULL,
  `liver_function_test` enum('yes','no') DEFAULT NULL,
  `prothrombin_time` enum('yes','no') DEFAULT NULL,
  `inr` enum('yes','no') DEFAULT NULL,
  `thyroid_function_test` enum('yes','no') DEFAULT NULL,
  `gram_stain` enum('yes','no') DEFAULT NULL,
  `cardiac` enum('yes','no') DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `time_completed` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`lab_order_history_id`),
  UNIQUE KEY `lab_order_id_UNIQUE` (`lab_order_history_id`),
  KEY `client_id_lab_order_idx` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `master_log`
--

DROP TABLE IF EXISTS `master_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_log` (
  `payment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `department` enum('dental','inquiry','laboratory','mch_anc','mch_cwc','mch_delivery','mch_fp','optometry','payment_rec','pharmacy','referral','screening_dm','screening_gyn','screening_htn','screening_other','tb_injection','treatment','vct','ultrasound','general') DEFAULT 'general',
  `payment_method` enum('unknown','cash','m-pesa') DEFAULT 'unknown',
  `revisit` enum('yes','no') DEFAULT 'no',
  `notes` varchar(150) DEFAULT NULL,
  `billed` int(10) DEFAULT NULL,
  `paid` int(10) DEFAULT NULL,
  `owes` int(10) GENERATED ALWAYS AS ((`billed` - `paid`)) STORED,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  UNIQUE KEY `payment_id_UNIQUE` (`payment_id`),
  KEY `client_id_master_log_idx` (`client_id`),
  KEY `client_id_master_log` (`client_id`),
  CONSTRAINT `client_id_master_log` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `master_log_history`
--

DROP TABLE IF EXISTS `master_log_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_log_history` (
  `payment_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `billed` int(10) DEFAULT NULL,
  `paid` int(10) DEFAULT NULL,
  `owes` int(10) GENERATED ALWAYS AS ((`billed` - `paid`)) STORED,
  `timestamp` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`payment_history_id`),
  UNIQUE KEY `payment_history_id_UNIQUE` (`payment_history_id`),
  KEY `client_id_master_log_idx` (`client_id`),
  CONSTRAINT `client_id_master_log_history` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `optometry_form`
--

DROP TABLE IF EXISTS `optometry_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `optometry_form` (
  `optometry_form_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `occupation` varchar(45) DEFAULT NULL,
  `screening_site` varchar(45) DEFAULT NULL,
  `far_vision` enum('yes','no') DEFAULT 'no',
  `near_vision` enum('yes','no') DEFAULT 'no',
  `hypertension` enum('yes','no') DEFAULT 'no',
  `diabetes` enum('yes','no') DEFAULT 'no',
  `allergy` enum('yes','no') DEFAULT 'no',
  `other` varchar(45) DEFAULT NULL,
  `comment` tinytext,
  `no_lenses_right_far` varchar(5) DEFAULT NULL,
  `no_lenses_right_pinhole` varchar(5) DEFAULT NULL,
  `no_lenses_right_near` varchar(5) DEFAULT NULL,
  `no_lenses_left_far` varchar(5) DEFAULT NULL,
  `no_lenses_left_pinhole` varchar(5) DEFAULT NULL,
  `no_lenses_left_near` varchar(5) DEFAULT NULL,
  `with_lenses_right_far` varchar(5) DEFAULT NULL,
  `with_lenses_right_near` varchar(5) DEFAULT NULL,
  `with_lenses_left_far` varchar(5) DEFAULT NULL,
  `with_lenses_left_near` varchar(5) DEFAULT NULL,
  `screening_results_acceptable` enum('yes','no') DEFAULT 'yes',
  `externals_right` enum('yes','no') DEFAULT 'no',
  `externals_left` enum('yes','no') DEFAULT 'no',
  `externals_comment` varchar(100) DEFAULT NULL,
  `pupils_right` enum('yes','no') DEFAULT 'no',
  `pupils_left` enum('yes','no') DEFAULT 'no',
  `pupils_comment` varchar(100) DEFAULT NULL,
  `opthalmoscopy_right` varchar(100) DEFAULT NULL,
  `opthalmoscopy_left` varchar(100) DEFAULT NULL,
  `ar1` varchar(45) DEFAULT NULL,
  `ar2` varchar(45) DEFAULT NULL,
  `ar3` varchar(45) DEFAULT NULL,
  `al1` varchar(45) DEFAULT NULL,
  `al2` varchar(45) DEFAULT NULL,
  `al3` varchar(45) DEFAULT NULL,
  `br1` varchar(45) DEFAULT NULL,
  `br2` varchar(45) DEFAULT NULL,
  `br3` varchar(45) DEFAULT NULL,
  `bl1` varchar(45) DEFAULT NULL,
  `bl2` varchar(45) DEFAULT NULL,
  `bl3` varchar(45) DEFAULT NULL,
  `cr1` varchar(45) DEFAULT NULL,
  `cr2` varchar(45) DEFAULT NULL,
  `cr3` varchar(45) DEFAULT NULL,
  `cl1` varchar(45) DEFAULT NULL,
  `cl2` varchar(45) DEFAULT NULL,
  `cl3` varchar(45) DEFAULT NULL,
  `tonometry_right` varchar(100) DEFAULT NULL,
  `tonometry_left` varchar(100) DEFAULT NULL,
  `plan` tinytext,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`optometry_form_id`),
  UNIQUE KEY `optometry_form_id_UNIQUE` (`optometry_form_id`),
  KEY `client_id_optometry_idx` (`client_id`),
  CONSTRAINT `client_id_optometry` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `optometry_form_history`
--

DROP TABLE IF EXISTS `optometry_form_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `optometry_form_history` (
  `optometry_form_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `optometry_form_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `occupation` varchar(45) DEFAULT NULL,
  `screening_site` varchar(45) DEFAULT NULL,
  `far_vision` enum('yes','no') DEFAULT 'no',
  `near_vision` enum('yes','no') DEFAULT 'no',
  `hypertension` enum('yes','no') DEFAULT 'no',
  `diabetes` enum('yes','no') DEFAULT 'no',
  `allergy` enum('yes','no') DEFAULT 'no',
  `other` varchar(45) DEFAULT NULL,
  `comment` tinytext,
  `no_lenses_right_far` varchar(5) DEFAULT NULL,
  `no_lenses_right_pinhole` varchar(5) DEFAULT NULL,
  `no_lenses_right_near` varchar(5) DEFAULT NULL,
  `no_lenses_left_far` varchar(5) DEFAULT NULL,
  `no_lenses_left_pinhole` varchar(5) DEFAULT NULL,
  `no_lenses_left_near` varchar(5) DEFAULT NULL,
  `with_lenses_right_far` varchar(5) DEFAULT NULL,
  `with_lenses_right_near` varchar(5) DEFAULT NULL,
  `with_lenses_left_far` varchar(5) DEFAULT NULL,
  `with_lenses_left_near` varchar(5) DEFAULT NULL,
  `screening_results_acceptable` enum('yes','no') DEFAULT 'yes',
  `externals_right` enum('yes','no') DEFAULT 'no',
  `externals_left` enum('yes','no') DEFAULT 'no',
  `externals_comment` varchar(100) DEFAULT NULL,
  `pupils_right` enum('yes','no') DEFAULT 'no',
  `pupils_left` enum('yes','no') DEFAULT 'no',
  `pupils_comment` varchar(100) DEFAULT NULL,
  `opthalmoscopy_right` varchar(100) DEFAULT NULL,
  `opthalmoscopy_left` varchar(100) DEFAULT NULL,
  `ar1` varchar(45) DEFAULT NULL,
  `ar2` varchar(45) DEFAULT NULL,
  `ar3` varchar(45) DEFAULT NULL,
  `al1` varchar(45) DEFAULT NULL,
  `al2` varchar(45) DEFAULT NULL,
  `al3` varchar(45) DEFAULT NULL,
  `br1` varchar(45) DEFAULT NULL,
  `br2` varchar(45) DEFAULT NULL,
  `br3` varchar(45) DEFAULT NULL,
  `bl1` varchar(45) DEFAULT NULL,
  `bl2` varchar(45) DEFAULT NULL,
  `bl3` varchar(45) DEFAULT NULL,
  `cr1` varchar(45) DEFAULT NULL,
  `cr2` varchar(45) DEFAULT NULL,
  `cr3` varchar(45) DEFAULT NULL,
  `cl1` varchar(45) DEFAULT NULL,
  `cl2` varchar(45) DEFAULT NULL,
  `cl3` varchar(45) DEFAULT NULL,
  `tonometry_right` varchar(100) DEFAULT NULL,
  `tonometry_left` varchar(100) DEFAULT NULL,
  `plan` tinytext,
  `timestamp` datetime DEFAULT NULL,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`optometry_form_history_id`),
  UNIQUE KEY `optometry_form_history_id_UNIQUE` (`optometry_form_history_id`),
  KEY `client_id_optometry_idx` (`client_id`),
  KEY `clinician_optometry` (`clinician`),
  CONSTRAINT `client_id_optometry_history` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `referral_form`
--

DROP TABLE IF EXISTS `referral_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referral_form` (
  `referral_form_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `referred_to` varchar(45) DEFAULT NULL,
  `t` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `pr` varchar(10) DEFAULT NULL,
  `rr` varchar(10) DEFAULT NULL,
  `sao2` varchar(10) DEFAULT NULL,
  `pain` enum('none','mild','moderate','severe') DEFAULT 'none',
  `history` tinytext,
  `treatment` tinytext,
  `reason_for_referral` tinytext,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`referral_form_id`),
  UNIQUE KEY `referral_form_id_UNIQUE` (`referral_form_id`),
  KEY `client_id_refferal_form_idx` (`client_id`),
  CONSTRAINT `client_id_refferal_form` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `referral_form_history`
--

DROP TABLE IF EXISTS `referral_form_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referral_form_history` (
  `referral_form_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `referral_form_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `referred_to` varchar(45) DEFAULT NULL,
  `t` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `pr` varchar(10) DEFAULT NULL,
  `rr` varchar(10) DEFAULT NULL,
  `sao2` varchar(10) DEFAULT NULL,
  `pain` enum('none','mild','moderate','severe') DEFAULT 'none',
  `history` tinytext,
  `treatment` tinytext,
  `reason_for_referral` tinytext,
  `timestamp` datetime DEFAULT NULL,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`referral_form_history_id`),
  UNIQUE KEY `referral_form_history_id_UNIQUE` (`referral_form_history_id`),
  KEY `client_id_refferal_form_idx` (`client_id`),
  CONSTRAINT `client_id_refferal_form_history` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `report_bug`
--

DROP TABLE IF EXISTS `report_bug`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report_bug` (
  `report_bug_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(11) unsigned NOT NULL,
  `severity_level` enum('1','2','3') DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `description` tinytext,
  `browser` enum('Internet Explorer','Mozilla Firefox','Opera','Edge','Google Chrome','Apple Safari','Netscape','Unknown') DEFAULT 'Unknown',
  `version` varchar(30) DEFAULT NULL,
  `platform` enum('linux','mac','windows','unknown') DEFAULT 'unknown',
  `snapshot` varchar(1000) DEFAULT 'no_image',
  `time_of_error` datetime DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_error` enum('not determined','yes','no') DEFAULT 'not determined',
  `issue_resolved` enum('yes','no') DEFAULT 'no',
  `notes` tinytext,
  PRIMARY KEY (`report_bug_id`),
  UNIQUE KEY `error_id_UNIQUE` (`report_bug_id`),
  KEY `client_id_report_bug_idx` (`account_id`),
  CONSTRAINT `client_id_report_bug` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `return_treatment`
--

DROP TABLE IF EXISTS `return_treatment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `return_treatment` (
  `return_treatment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned DEFAULT NULL,
  `first_name` varchar(15) DEFAULT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `t` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `pr` varchar(10) DEFAULT NULL,
  `rr` varchar(10) DEFAULT NULL,
  `sao2` varchar(10) DEFAULT NULL,
  `pain` enum('none','mild','moderate','severe') DEFAULT 'none',
  `notes` text,
  `plan` text,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`return_treatment_id`),
  UNIQUE KEY `return_treatment_id_UNIQUE` (`return_treatment_id`),
  KEY `client_id_return_treatment_idx` (`client_id`),
  CONSTRAINT `client_id_return_treatment` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `return_treatment_history`
--

DROP TABLE IF EXISTS `return_treatment_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `return_treatment_history` (
  `return_treatment_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `return_treatment_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(15) DEFAULT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `t` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `pr` varchar(10) DEFAULT NULL,
  `rr` varchar(10) DEFAULT NULL,
  `sao2` varchar(10) DEFAULT NULL,
  `pain` enum('none','mild','moderate','severe') DEFAULT 'none',
  `notes` text,
  `plan` text,
  `timestamp` datetime DEFAULT NULL,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`return_treatment_history_id`),
  UNIQUE KEY `return_treatment_history_id_UNIQUE` (`return_treatment_history_id`),
  KEY `client_id_return_treatment_idx` (`client_id`),
  CONSTRAINT `client_id_return_treatment_history` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `secret_api_tokens`
--

DROP TABLE IF EXISTS `secret_api_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secret_api_tokens` (
  `secret_api_tokens_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token_hash` varchar(96) NOT NULL,
  `active` enum('yes','no') DEFAULT 'no',
  `description` tinyint(255) DEFAULT NULL,
  PRIMARY KEY (`secret_api_tokens_id`),
  UNIQUE KEY `secret_api_tokens_id_UNIQUE` (`secret_api_tokens_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
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
  `key_hash` varchar(96) NOT NULL,
  `privilege` enum('admin','read') DEFAULT 'read',
  PRIMARY KEY (`secret_value_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
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
  `key_hash` varchar(96) NOT NULL,
  `privilege` enum('admin','read') DEFAULT 'read',
  PRIMARY KEY (`secret_value_temp_id`)
) ENGINE=MEMORY DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `treatment`
--

DROP TABLE IF EXISTS `treatment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `treatment` (
  `treatment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `t` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `pr` varchar(10) DEFAULT NULL,
  `rr` varchar(10) DEFAULT NULL,
  `sao2` varchar(10) DEFAULT NULL,
  `pain` enum('none','mild','moderate','severe') DEFAULT 'none',
  `history` text,
  `physical_examination` text,
  `impression` text,
  `plan` text,
  `health_education` text,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL,
  `clinician` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`treatment_id`),
  UNIQUE KEY `treatment_id_UNIQUE` (`treatment_id`),
  KEY `client_id_treatment_idx` (`client_id`),
  CONSTRAINT `client_id_treatment` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `treatment_history`
--

DROP TABLE IF EXISTS `treatment_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `treatment_history` (
  `treatment_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `treatment_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `t` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `pr` varchar(10) DEFAULT NULL,
  `rr` varchar(10) DEFAULT NULL,
  `sao2` varchar(10) DEFAULT NULL,
  `pain` enum('none','mild','moderate','severe') DEFAULT 'none',
  `history` text,
  `physical_examination` text,
  `impression` text,
  `plan` text,
  `health_education` text,
  `timestamp` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `clinician` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`treatment_history_id`),
  UNIQUE KEY `treatment_history_id_UNIQUE` (`treatment_history_id`),
  KEY `client_id_treatment_history_idx` (`client_id`),
  CONSTRAINT `client_id_treatment_history` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `treatment_temp`
--

DROP TABLE IF EXISTS `treatment_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `treatment_temp` (
  `t` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `pr` varchar(10) DEFAULT NULL,
  `rr` varchar(10) DEFAULT NULL,
  `sao2` varchar(10) DEFAULT NULL,
  `pain` enum('none','mild','moderate','severe') DEFAULT 'none',
  `history` varchar(5000) DEFAULT NULL,
  `physical_examination` varchar(5000) DEFAULT NULL,
  `impression` varchar(5000) DEFAULT NULL,
  `plan` varchar(5000) DEFAULT NULL,
  `health_education` varchar(5000) DEFAULT NULL,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL
) ENGINE=MEMORY DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ultrasound`
--

DROP TABLE IF EXISTS `ultrasound`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ultrasound` (
  `ultrasound_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `t` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `pr` varchar(10) DEFAULT NULL,
  `rr` varchar(10) DEFAULT NULL,
  `sao2` varchar(10) DEFAULT NULL,
  `pain` enum('none','mild','moderate','severe') DEFAULT 'none',
  `lmp` date DEFAULT NULL,
  `weeks_pregnant` int(5) DEFAULT NULL,
  `days_pregnant` int(5) DEFAULT NULL,
  `edd_per_lmp` varchar(45) DEFAULT NULL,
  `g_lmp` varchar(45) DEFAULT NULL,
  `t_lmp` varchar(45) DEFAULT NULL,
  `p_lmp` varchar(45) DEFAULT NULL,
  `l_lmp` varchar(45) DEFAULT NULL,
  `significant_history` tinytext,
  `ultrasound_findings` varchar(45) DEFAULT NULL,
  `fetal_number` varchar(45) DEFAULT NULL,
  `edd_per_ultrasound` varchar(45) DEFAULT NULL,
  `other_findings` text,
  `package_path` varchar(1000) DEFAULT 'no_image',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ultrasound_id`),
  UNIQUE KEY `ultrasound_id_UNIQUE` (`ultrasound_id`),
  KEY `client_id_ultrasound_idx` (`client_id`),
  CONSTRAINT `client_id_ultrasound` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ultrasound_history`
--

DROP TABLE IF EXISTS `ultrasound_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ultrasound_history` (
  `ultrasound_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ultrasound_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `t` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `pr` varchar(10) DEFAULT NULL,
  `rr` varchar(10) DEFAULT NULL,
  `sao2` varchar(10) DEFAULT NULL,
  `pain` enum('none','mild','moderate','severe') DEFAULT 'none',
  `lmp` date DEFAULT NULL,
  `weeks_pregnant` int(5) DEFAULT NULL,
  `days_pregnant` int(5) DEFAULT NULL,
  `edd_per_lmp` varchar(45) DEFAULT NULL,
  `g_lmp` varchar(45) DEFAULT NULL,
  `t_lmp` varchar(45) DEFAULT NULL,
  `p_lmp` varchar(45) DEFAULT NULL,
  `l_lmp` varchar(45) DEFAULT NULL,
  `significant_history` tinytext,
  `ultrasound_findings` varchar(45) DEFAULT NULL,
  `fetal_number` varchar(45) DEFAULT NULL,
  `edd_per_ultrasound` varchar(45) DEFAULT NULL,
  `other_findings` text,
  `package_path` varchar(1000) DEFAULT 'no_image',
  `timestamp` datetime DEFAULT NULL,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ultrasound_history_id`),
  UNIQUE KEY `ultrasound_id_UNIQUE` (`ultrasound_history_id`),
  KEY `client_id_ultrasound_history_idx` (`client_id`),
  CONSTRAINT `client_id_ultrasound_history` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `women_health`
--

DROP TABLE IF EXISTS `women_health`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `women_health` (
  `women_health_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `t` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `pr` varchar(10) DEFAULT NULL,
  `rr` varchar(10) DEFAULT NULL,
  `sao2` varchar(10) DEFAULT NULL,
  `pain` enum('none','mild','moderate','severe') DEFAULT 'none',
  `lmp` date DEFAULT NULL,
  `menarche` varchar(10) DEFAULT NULL,
  `g_lmp` varchar(10) DEFAULT NULL,
  `t_lmp` varchar(10) DEFAULT NULL,
  `p_lmp` varchar(10) DEFAULT NULL,
  `l_lmp` varchar(10) DEFAULT NULL,
  `family_planning` varchar(45) DEFAULT NULL,
  `past_cancer_screening` varchar(45) DEFAULT NULL,
  `life_sex_partners` varchar(10) DEFAULT NULL,
  `year_sex_partners` varchar(10) DEFAULT NULL,
  `cd4_count` varchar(10) DEFAULT NULL,
  `history` tinytext,
  `via_preformed` enum('yes','no') DEFAULT NULL,
  `cryo_preformed` enum('yes','no') DEFAULT NULL,
  `colpo_preformed` enum('yes','no') DEFAULT NULL,
  `biopsies` enum('yes','no') DEFAULT NULL,
  `biopsies_comment` tinytext,
  `physical_exam_continued` tinytext,
  `plan` varchar(45) DEFAULT NULL,
  `metronidazole_400mg` enum('yes','no') DEFAULT NULL,
  `metronidazole_2gm` enum('yes','no') DEFAULT NULL,
  `azithromycin` enum('yes','no') DEFAULT NULL,
  `ceftriaxone` enum('yes','no') DEFAULT NULL,
  `fluconazole` enum('yes','no') DEFAULT NULL,
  `clotrimazole` enum('yes','no') DEFAULT NULL,
  `lbuprofen` enum('yes','no') DEFAULT NULL,
  `paracetamol` enum('yes','no') DEFAULT NULL,
  `pyridium` enum('yes','no') DEFAULT NULL,
  `septrim` enum('yes','no') DEFAULT NULL,
  `amoxil` enum('yes','no') DEFAULT NULL,
  `family_planning_bottom` enum('yes','no') DEFAULT 'no',
  `family_planning_comment` tinytext,
  `via_months` enum('yes','no') DEFAULT NULL,
  `via_months_count` varchar(10) DEFAULT NULL,
  `colposcopy` enum('yes','no') DEFAULT NULL,
  `colposcopy_month_count` varchar(10) DEFAULT NULL,
  `biopsy_results` enum('yes','no') DEFAULT NULL,
  `biopsy_results_count` varchar(10) DEFAULT NULL,
  `referral` varchar(20) DEFAULT NULL,
  `return_visit` date DEFAULT NULL,
  `vigina_path` varchar(1000) DEFAULT 'no_image',
  `breast_path` varchar(1000) DEFAULT 'no_image',
  `circle_path` varchar(1000) DEFAULT 'no_image',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `form_type` enum('women_health') GENERATED ALWAYS AS ('women_health') VIRTUAL,
  PRIMARY KEY (`women_health_id`),
  UNIQUE KEY `women_health_id_UNIQUE` (`women_health_id`),
  KEY `client_id_women_health_idx` (`client_id`),
  CONSTRAINT `client_id_women_health` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `women_health_history`
--

DROP TABLE IF EXISTS `women_health_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `women_health_history` (
  `women_health_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `women_health_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `t` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `pr` varchar(10) DEFAULT NULL,
  `rr` varchar(10) DEFAULT NULL,
  `sao2` varchar(10) DEFAULT NULL,
  `pain` enum('none','mild','moderate','severe') DEFAULT 'none',
  `lmp` date DEFAULT NULL,
  `menarche` varchar(10) DEFAULT NULL,
  `g_lmp` varchar(10) DEFAULT NULL,
  `t_lmp` varchar(10) DEFAULT NULL,
  `p_lmp` varchar(10) DEFAULT NULL,
  `l_lmp` varchar(10) DEFAULT NULL,
  `family_planning` varchar(45) DEFAULT NULL,
  `past_cancer_screening` varchar(45) DEFAULT NULL,
  `life_sex_partners` varchar(10) DEFAULT NULL,
  `year_sex_partners` varchar(10) DEFAULT NULL,
  `cd4_count` varchar(10) DEFAULT NULL,
  `history` tinytext,
  `via_preformed` enum('yes','no') DEFAULT NULL,
  `cryo_preformed` enum('yes','no') DEFAULT NULL,
  `colpo_preformed` enum('yes','no') DEFAULT NULL,
  `biopsies` enum('yes','no') DEFAULT NULL,
  `biopsies_comment` tinytext,
  `physical_exam_continued` tinytext,
  `plan` varchar(45) DEFAULT NULL,
  `metronidazole_400mg` enum('yes','no') DEFAULT NULL,
  `metronidazole_2gm` enum('yes','no') DEFAULT NULL,
  `azithromycin` enum('yes','no') DEFAULT NULL,
  `ceftriaxone` enum('yes','no') DEFAULT NULL,
  `fluconazole` enum('yes','no') DEFAULT NULL,
  `clotrimazole` enum('yes','no') DEFAULT NULL,
  `lbuprofen` enum('yes','no') DEFAULT NULL,
  `paracetamol` enum('yes','no') DEFAULT NULL,
  `pyridium` enum('yes','no') DEFAULT NULL,
  `septrim` enum('yes','no') DEFAULT NULL,
  `amoxil` enum('yes','no') DEFAULT NULL,
  `family_planning_bottom` enum('yes','no') DEFAULT 'no',
  `family_planning_comment` tinytext,
  `via_months` enum('yes','no') DEFAULT NULL,
  `via_months_count` varchar(10) DEFAULT NULL,
  `colposcopy` enum('yes','no') DEFAULT NULL,
  `colposcopy_month_count` varchar(10) DEFAULT NULL,
  `biopsy_results` enum('yes','no') DEFAULT NULL,
  `biopsy_results_count` varchar(10) DEFAULT NULL,
  `referral` varchar(20) DEFAULT NULL,
  `return_visit` date DEFAULT NULL,
  `vigina_path` varchar(1000) DEFAULT 'no_image',
  `breast_path` varchar(1000) DEFAULT 'no_image',
  `circle_path` varchar(1000) DEFAULT 'no_image',
  `timestamp` datetime DEFAULT NULL,
  `clinician` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`women_health_history_id`),
  UNIQUE KEY `women_health_history_id_UNIQUE` (`women_health_history_id`),
  KEY `client_id_women_health_history_idx` (`client_id`),
  CONSTRAINT `client_id_women_health_history` FOREIGN KEY (`client_id`) REFERENCES `general_info` (`client_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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

-- Dump completed on 2019-02-03  3:14:06
