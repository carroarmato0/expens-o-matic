-- MySQL Script generated by MySQL Workbench
-- di 01 okt 2019 22:04:48 CEST
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema expens-o-matic
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `expens-o-matic` ;

-- -----------------------------------------------------
-- Schema expens-o-matic
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `expens-o-matic` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `expens-o-matic` ;

-- -----------------------------------------------------
-- Table `expens-o-matic`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `expens-o-matic`.`user` ;

CREATE TABLE IF NOT EXISTS `expens-o-matic`.`user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `surname` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `expens-o-matic`.`expense_claim`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `expens-o-matic`.`expense_claim` ;

CREATE TABLE IF NOT EXISTS `expens-o-matic`.`expense_claim` (
  `expense_claim_id` INT NOT NULL AUTO_INCREMENT,
  `user_user_id` INT NOT NULL,
  `submission_date` DATETIME NULL,
  PRIMARY KEY (`expense_claim_id`),
  INDEX `fk_expense_claim_user1_idx` (`user_user_id` ASC),
  CONSTRAINT `fk_expense_claim_user1`
    FOREIGN KEY (`user_user_id`)
    REFERENCES `expens-o-matic`.`user` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `expens-o-matic`.`expense`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `expens-o-matic`.`expense` ;

CREATE TABLE IF NOT EXISTS `expens-o-matic`.`expense` (
  `expense_id` INT NOT NULL AUTO_INCREMENT,
  `expense_claim_expense_claim_id` INT NOT NULL,
  `date` DATE NOT NULL,
  `description` TINYTEXT NOT NULL,
  `amount` FLOAT NOT NULL,
  `approved` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`expense_id`),
  INDEX `fk_expense_expense_claim1_idx` (`expense_claim_expense_claim_id` ASC),
  CONSTRAINT `fk_expense_expense_claim1`
    FOREIGN KEY (`expense_claim_expense_claim_id`)
    REFERENCES `expens-o-matic`.`expense_claim` (`expense_claim_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci
COMMENT = 'Expense table';


-- -----------------------------------------------------
-- Table `expens-o-matic`.`expense_item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `expens-o-matic`.`expense_item` ;

CREATE TABLE IF NOT EXISTS `expens-o-matic`.`expense_item` (
  `expense_item_id` INT NOT NULL AUTO_INCREMENT,
  `expense_expense_id` INT NOT NULL,
  `path` TINYTEXT NOT NULL,
  PRIMARY KEY (`expense_item_id`, `expense_expense_id`),
  INDEX `fk_expense_item_expense1_idx` (`expense_expense_id` ASC),
  CONSTRAINT `fk_expense_item_expense1`
    FOREIGN KEY (`expense_expense_id`)
    REFERENCES `expens-o-matic`.`expense` (`expense_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `expens-o-matic`.`role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `expens-o-matic`.`role` ;

CREATE TABLE IF NOT EXISTS `expens-o-matic`.`role` (
  `role_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`role_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `expens-o-matic`.`role_assignment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `expens-o-matic`.`role_assignment` ;

CREATE TABLE IF NOT EXISTS `expens-o-matic`.`role_assignment` (
  `role_assignment_id` INT NOT NULL AUTO_INCREMENT,
  `user_user_id` INT NOT NULL,
  `role_role_id` INT NOT NULL,
  PRIMARY KEY (`role_assignment_id`, `user_user_id`, `role_role_id`),
  INDEX `fk_role_assignment_user1_idx` (`user_user_id` ASC),
  INDEX `fk_role_assignment_role1_idx` (`role_role_id` ASC),
  CONSTRAINT `fk_role_assignment_user1`
    FOREIGN KEY (`user_user_id`)
    REFERENCES `expens-o-matic`.`user` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_role_assignment_role1`
    FOREIGN KEY (`role_role_id`)
    REFERENCES `expens-o-matic`.`role` (`role_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `expens-o-matic`.`role`
-- -----------------------------------------------------
START TRANSACTION;
USE `expens-o-matic`;
INSERT INTO `expens-o-matic`.`role` (`role_id`, `name`, `description`) VALUES (1, 'user', 'Normal user privileges');
INSERT INTO `expens-o-matic`.`role` (`role_id`, `name`, `description`) VALUES (2, 'approver', 'Expense approval role');

COMMIT;

