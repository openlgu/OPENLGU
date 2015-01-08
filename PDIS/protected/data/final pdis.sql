SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `final pdis` DEFAULT CHARACTER SET latin1 ;
USE `final pdis` ;

-- -----------------------------------------------------
-- Table `final pdis`.`tbl_service`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `final pdis`.`tbl_service` (
  `service` VARCHAR(100) NOT NULL ,
  `title` VARCHAR(300) NOT NULL ,
  `availability` TEXT NOT NULL ,
  `customers` TEXT NOT NULL ,
  PRIMARY KEY (`service`) ,
  UNIQUE INDEX `title_UNIQUE` (`title` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final pdis`.`tbl_request`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `final pdis`.`tbl_request` (
  `code` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_general_cs' NOT NULL ,
  `service` VARCHAR(100) NOT NULL ,
  `first_name` VARCHAR(45) NOT NULL ,
  `middle_name` VARCHAR(45) NULL DEFAULT NULL ,
  `last_name` VARCHAR(45) NOT NULL ,
  `mailing_address` TEXT NOT NULL ,
  `email` VARCHAR(45) NULL DEFAULT NULL ,
  `company_name` VARCHAR(300) NULL DEFAULT NULL ,
  `company_address` TEXT NULL DEFAULT NULL ,
  `designation` VARCHAR(200) NULL DEFAULT NULL ,
  `status` INT(1) NOT NULL DEFAULT '4' ,
  `remarks` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`code`, `service`) ,
  INDEX `fk_tbl_request_tbl_service_service_idx` (`service` ASC) ,
  CONSTRAINT `fk_tbl_request_tbl_service_service`
    FOREIGN KEY (`service` )
    REFERENCES `final pdis`.`tbl_service` (`service` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final pdis`.`tbl_request_fees_checklist`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `final pdis`.`tbl_request_fees_checklist` (
  `code` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_general_cs' NOT NULL ,
  `service` VARCHAR(100) NOT NULL ,
  `_number` INT(11) NOT NULL ,
  `accomplished` BINARY(1) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`code`, `service`, `_number`) ,
  INDEX `fk_tbl_request_fees_checklist_code_idx` (`code` ASC) ,
  INDEX `fk_tbl_request_fees_checklist_service_idx` (`service` ASC) ,
  CONSTRAINT `fk_tbl_request_fees_checklist_code`
    FOREIGN KEY (`code` )
    REFERENCES `final pdis`.`tbl_request` (`code` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_request_fees_checklist_service`
    FOREIGN KEY (`service` )
    REFERENCES `final pdis`.`tbl_request` (`service` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final pdis`.`tbl_request_files`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `final pdis`.`tbl_request_files` (
  `service` VARCHAR(100) NOT NULL ,
  `code` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_general_cs' NOT NULL ,
  `filename` VARCHAR(200) NOT NULL ,
  `_number` INT(11) NOT NULL ,
  `extension` VARCHAR(5) NOT NULL ,
  PRIMARY KEY (`service`, `code`, `filename`, `extension`) ,
  INDEX `fk_tbl_request_files_code_idx` (`code` ASC) ,
  INDEX `fk_tbl_request_files_service_idx` (`service` ASC) ,
  CONSTRAINT `fk_tbl_request_files_code`
    FOREIGN KEY (`code` )
    REFERENCES `final pdis`.`tbl_request` (`code` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_request_files_service`
    FOREIGN KEY (`service` )
    REFERENCES `final pdis`.`tbl_request` (`service` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final pdis`.`tbl_request_requirements_checklist`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `final pdis`.`tbl_request_requirements_checklist` (
  `code` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_general_cs' NOT NULL ,
  `service` VARCHAR(100) NOT NULL ,
  `_number` INT(11) NOT NULL ,
  `accomplished` BINARY(1) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`code`, `service`, `_number`) ,
  INDEX `fk_tbl_request_requirements_checklist_code_idx` (`code` ASC) ,
  INDEX `fk_tbl_request_requirements_checklist_service_idx` (`service` ASC) ,
  CONSTRAINT `fk_tbl_request_requirements_checklist_code`
    FOREIGN KEY (`code` )
    REFERENCES `final pdis`.`tbl_request` (`code` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_request_requirements_checklist_service`
    FOREIGN KEY (`service` )
    REFERENCES `final pdis`.`tbl_request` (`service` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final pdis`.`tbl_service_fees`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `final pdis`.`tbl_service_fees` (
  `service` VARCHAR(100) NOT NULL ,
  `fee` VARCHAR(300) NOT NULL ,
  `_number` INT(11) NOT NULL ,
  PRIMARY KEY (`service`, `fee`) ,
  INDEX `fk_tbl_service_fees_idx` (`service` ASC) ,
  CONSTRAINT `fk_tbl_service_fees`
    FOREIGN KEY (`service` )
    REFERENCES `final pdis`.`tbl_service` (`service` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final pdis`.`tbl_service_requirements`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `final pdis`.`tbl_service_requirements` (
  `service` VARCHAR(100) NOT NULL ,
  `requirement` VARCHAR(300) NOT NULL ,
  `_number` INT(11) NOT NULL ,
  `optional` BINARY(1) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`service`, `requirement`) ,
  CONSTRAINT `fk_tbl_service_requirements`
    FOREIGN KEY (`service` )
    REFERENCES `final pdis`.`tbl_service` (`service` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final pdis`.`tbl_user_account`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `final pdis`.`tbl_user_account` (
  `employee_number` VARCHAR(11) NOT NULL ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(64) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `first_name` VARCHAR(45) NOT NULL ,
  `middle_name` VARCHAR(45) NULL DEFAULT NULL ,
  `last_name` VARCHAR(45) NOT NULL ,
  `designation` VARCHAR(45) NOT NULL ,
  `sex` INT(1) NOT NULL ,
  `role` INT(1) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`employee_number`) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final pdis`.`tbl_user_account_administers_tbl_request`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `final pdis`.`tbl_user_account_administers_tbl_request` (
  `employee_number` VARCHAR(11) NOT NULL ,
  `code` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_general_cs' NOT NULL ,
  `service` VARCHAR(100) NOT NULL ,
  `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`employee_number`, `code`, `service`) ,
  INDEX `fk_tbl_user_account_has_tbl_request_tbl_request1_idx` (`code` ASC, `service` ASC) ,
  INDEX `fk_tbl_user_account_has_tbl_request_tbl_user_account1_idx` (`employee_number` ASC) ,
  INDEX `fk_tbl_administers_service_idx` (`service` ASC) ,
  CONSTRAINT `fk_tbl_administers_code`
    FOREIGN KEY (`code` )
    REFERENCES `final pdis`.`tbl_request` (`code` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_administers_employee_number`
    FOREIGN KEY (`employee_number` )
    REFERENCES `final pdis`.`tbl_user_account` (`employee_number` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_administers_service`
    FOREIGN KEY (`service` )
    REFERENCES `final pdis`.`tbl_request` (`service` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `final pdis`.`tbl_service_forms`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `final pdis`.`tbl_service_forms` (
  `service` VARCHAR(100) NOT NULL ,
  `name` VARCHAR(200) NOT NULL ,
  `filename` VARCHAR(200) NOT NULL ,
  `extension` VARCHAR(5) NOT NULL ,
  `isonline` BINARY(1) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`service`, `name`) ,
  UNIQUE INDEX `filename_UNIQUE` (`filename` ASC) ,
  UNIQUE INDEX `extension_UNIQUE` (`extension` ASC) ,
  INDEX `fk_tbl_service_forms_service_idx` (`service` ASC) ,
  CONSTRAINT `fk_tbl_service_forms_service`
    FOREIGN KEY (`service` )
    REFERENCES `final pdis`.`tbl_service` (`service` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `final pdis` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
