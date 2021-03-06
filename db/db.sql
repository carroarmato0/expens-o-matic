-- MySQL Script generated by MySQL Workbench
-- vr 04 okt 2019 17:08:20 CEST
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
  `enabled` TINYINT NULL DEFAULT 1,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `expens-o-matic`.`expense`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `expens-o-matic`.`expense` ;

CREATE TABLE IF NOT EXISTS `expens-o-matic`.`expense` (
  `expense_id` INT NOT NULL AUTO_INCREMENT,
  `user_user_id` INT NOT NULL,
  `submit_date` DATETIME NOT NULL,
  `date` DATE NOT NULL,
  `name` VARCHAR(60) NOT NULL,
  `description` TINYTEXT NOT NULL,
  `amount` FLOAT NOT NULL,
  `approved` TINYINT NULL DEFAULT NULL,
  `reimbursed` TINYINT NULL DEFAULT 0,
  PRIMARY KEY (`expense_id`, `user_user_id`),
  INDEX `fk_expense_user1_idx` (`user_user_id` ASC),
  CONSTRAINT `fk_expense_user1`
    FOREIGN KEY (`user_user_id`)
    REFERENCES `expens-o-matic`.`user` (`user_id`)
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
-- Data for table `expens-o-matic`.`user`
-- -----------------------------------------------------
START TRANSACTION;
USE `expens-o-matic`;
INSERT INTO `expens-o-matic`.`user` (`user_id`, `name`, `surname`, `email`, `password`, `enabled`) VALUES (1, 'admin', 'admin', 'admin@localhost', 'admin', NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `expens-o-matic`.`role`
-- -----------------------------------------------------
START TRANSACTION;
USE `expens-o-matic`;
INSERT INTO `expens-o-matic`.`role` (`role_id`, `name`, `description`) VALUES (1, 'admin', 'Admin account');
INSERT INTO `expens-o-matic`.`role` (`role_id`, `name`, `description`) VALUES (2, 'user', 'Normal user privileges');
INSERT INTO `expens-o-matic`.`role` (`role_id`, `name`, `description`) VALUES (3, 'approver', 'Expense approval role');

COMMIT;


-- -----------------------------------------------------
-- Data for table `expens-o-matic`.`role_assignment`
-- -----------------------------------------------------
START TRANSACTION;
USE `expens-o-matic`;
INSERT INTO `expens-o-matic`.`role_assignment` (`role_assignment_id`, `user_user_id`, `role_role_id`) VALUES (1, 1, 1);

COMMIT;

