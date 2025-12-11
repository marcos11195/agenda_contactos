-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema agenda
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `agenda` ;

-- -----------------------------------------------------
-- Schema agenda
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `agenda` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci ;
USE `agenda` ;

-- -----------------------------------------------------
-- Table `agenda`.`contactos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `agenda`.`contactos` ;

CREATE TABLE IF NOT EXISTS `agenda`.`contactos` (
  `contacto_id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `telefono` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `direccion` TEXT NULL,
  `fecha_creacion` TIMESTAMP NULL DEFAULT NOW(),
  PRIMARY KEY (`contacto_id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
