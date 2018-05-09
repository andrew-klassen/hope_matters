
ALTER TABLE `hope_matters`.`lab` 
ADD COLUMN `hba1c` ENUM('yes', 'no') NULL DEFAULT 'no' AFTER `blood_sugar_results`;

ALTER TABLE `hope_matters`.`lab` 
ADD COLUMN `hba1c_results` VARCHAR(45) NULL DEFAULT NULL AFTER `hba1c`;


ALTER TABLE `hope_matters`.`lab` 
ADD COLUMN `bun` ENUM('yes', 'no') NULL DEFAULT 'no' AFTER `hba1c_results`;

ALTER TABLE `hope_matters`.`lab` 
ADD COLUMN `bun_results` VARCHAR(45) NULL DEFAULT NULL AFTER `bun`;


ALTER TABLE `hope_matters`.`lab` 
ADD COLUMN `hematocrit` ENUM('yes', 'no') NULL DEFAULT 'no' AFTER `bun_results`;

ALTER TABLE `hope_matters`.`lab` 
ADD COLUMN `hematocrit_results` VARCHAR(45) NULL DEFAULT NULL AFTER `hematocrit`;


ALTER TABLE `hope_matters`.`lab` 
ADD COLUMN `creatinine` ENUM('yes', 'no') NULL DEFAULT 'no' AFTER `hematocrit_results`;

ALTER TABLE `hope_matters`.`lab` 
ADD COLUMN `creatinine_results` VARCHAR(45) NULL DEFAULT NULL AFTER `creatinine`;


ALTER TABLE `hope_matters`.`lab` 
ADD COLUMN `electrolytes` ENUM('yes', 'no') NULL DEFAULT 'no' AFTER `creatinine_results`;

ALTER TABLE `hope_matters`.`lab` 
ADD COLUMN `electrolytes_results` VARCHAR(45) NULL DEFAULT NULL AFTER `electrolytes`;


ALTER TABLE `hope_matters`.`lab` 
ADD COLUMN `pylori_stool` ENUM('yes', 'no') NULL DEFAULT 'no' AFTER `electrolytes_results`;

ALTER TABLE `hope_matters`.`lab` 
ADD COLUMN `pylori_stool_results` ENUM('positive', 'negative', '') NULL DEFAULT '' AFTER `pylori_stool`;

ALTER TABLE `hope_matters`.`lab` 
ADD COLUMN `pylori_blood` ENUM('yes', 'no') NULL DEFAULT 'no' AFTER `pylori_stool_results`;

ALTER TABLE `hope_matters`.`lab` 
ADD COLUMN `pylori_blood_results` ENUM('positive', 'negative', '') NULL DEFAULT '' AFTER `pylori_blood`;


ALTER TABLE `hope_matters`.`lab` 
ADD COLUMN `rheumatoid_factor` ENUM('yes', 'no') NULL DEFAULT 'no' AFTER `pylori_blood_results`;

ALTER TABLE `hope_matters`.`lab` 
ADD COLUMN `rheumatoid_factor_results` ENUM('reactive', 'non_reactive', '') NULL DEFAULT '' AFTER `rheumatoid_factor`;






ALTER TABLE `hope_matters`.`lab_history` 
ADD COLUMN `hba1c` ENUM('yes', 'no') NULL DEFAULT 'no' AFTER `blood_sugar_results`;

ALTER TABLE `hope_matters`.`lab_history` 
ADD COLUMN `hba1c_results` VARCHAR(45) NULL DEFAULT NULL AFTER `hba1c`;


ALTER TABLE `hope_matters`.`lab_history` 
ADD COLUMN `bun` ENUM('yes', 'no') NULL DEFAULT 'no' AFTER `hba1c_results`;

ALTER TABLE `hope_matters`.`lab_history` 
ADD COLUMN `bun_results` VARCHAR(45) NULL DEFAULT NULL AFTER `bun`;


ALTER TABLE `hope_matters`.`lab_history` 
ADD COLUMN `hematocrit` ENUM('yes', 'no') NULL DEFAULT 'no' AFTER `bun_results`;

ALTER TABLE `hope_matters`.`lab_history` 
ADD COLUMN `hematocrit_results` VARCHAR(45) NULL DEFAULT NULL AFTER `hematocrit`;


ALTER TABLE `hope_matters`.`lab_history` 
ADD COLUMN `creatinine` ENUM('yes', 'no') NULL DEFAULT 'no' AFTER `hematocrit_results`;

ALTER TABLE `hope_matters`.`lab_history` 
ADD COLUMN `creatinine_results` VARCHAR(45) NULL DEFAULT NULL AFTER `creatinine`;


ALTER TABLE `hope_matters`.`lab_history` 
ADD COLUMN `electrolytes` ENUM('yes', 'no') NULL DEFAULT 'no' AFTER `creatinine_results`;

ALTER TABLE `hope_matters`.`lab_history` 
ADD COLUMN `electrolytes_results` VARCHAR(45) NULL DEFAULT NULL AFTER `electrolytes`;


ALTER TABLE `hope_matters`.`lab_history` 
ADD COLUMN `pylori_stool` ENUM('yes', 'no') NULL DEFAULT 'no' AFTER `electrolytes_results`;

ALTER TABLE `hope_matters`.`lab_history` 
ADD COLUMN `pylori_stool_results` ENUM('positive', 'negative', '') NULL DEFAULT '' AFTER `pylori_stool`;

ALTER TABLE `hope_matters`.`lab_history` 
ADD COLUMN `pylori_blood` ENUM('yes', 'no') NULL DEFAULT 'no' AFTER `pylori_stool_results`;

ALTER TABLE `hope_matters`.`lab_history` 
ADD COLUMN `pylori_blood_results` ENUM('positive', 'negative', '') NULL DEFAULT '' AFTER `pylori_blood`;


ALTER TABLE `hope_matters`.`lab_history` 
ADD COLUMN `rheumatoid_factor` ENUM('yes', 'no') NULL DEFAULT 'no' AFTER `pylori_blood_results`;

ALTER TABLE `hope_matters`.`lab_history` 
ADD COLUMN `rheumatoid_factor_results` ENUM('reactive', 'non_reactive', '') NULL DEFAULT '' AFTER `rheumatoid_factor`;


