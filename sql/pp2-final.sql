-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pp2-final` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema pp2-final
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema pp2-final
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pp2-final` DEFAULT CHARACTER SET utf8mb3 ;
USE `pp2-final` ;

-- -----------------------------------------------------
-- Table `mydb`.`horario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pp2-final`.`horario` (
  `id_bloque` INT NOT NULL AUTO_INCREMENT,
  `bloque_horario` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_bloque`))
ENGINE = InnoDB;

USE `pp2-final` ;

-- -----------------------------------------------------
-- Table `pp2-final`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pp2-final`.`roles` (
  `id_rol` INT NOT NULL,
  `Descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_rol`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `pp2-final`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pp2-final`.`usuario` (
  `DNI` INT NOT NULL,
  `Nombre` VARCHAR(25) NOT NULL,
  `Apellido` VARCHAR(20) NOT NULL,
  `Email` VARCHAR(50) NOT NULL,
  `Usuario` VARCHAR(20) NOT NULL,
  `Telefono` VARCHAR(20) NOT NULL,
  `Contrasenia` VARCHAR(50) NOT NULL,
  `Roles_id_rol` INT NOT NULL,
  PRIMARY KEY (`DNI`),
  INDEX `Roles_id_rol` (`Roles_id_rol` ASC) VISIBLE,
  CONSTRAINT `usuario_ibfk_1`
    FOREIGN KEY (`Roles_id_rol`)
    REFERENCES `pp2-final`.`roles` (`id_rol`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `pp2-final`.`disponibilidad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pp2-final`.`disponibilidad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `dia` VARCHAR(10) NOT NULL,
  `bloque` INT NOT NULL,
  `disponibilidad` TINYINT NOT NULL,
  `dni_docente` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `bloque_idx` (`bloque` ASC) VISIBLE,
  INDEX `dni_idx` (`dni_docente` ASC) VISIBLE,
  CONSTRAINT `bloque`
    FOREIGN KEY (`bloque`)
    REFERENCES `pp2-final`.`horario` (`id_bloque`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `dni_docente`
    FOREIGN KEY (`dni_docente`)
    REFERENCES `pp2-final`.`usuario` (`DNI`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `roles`(`id_rol`, `Descripcion`) VALUES (1,'Regente'),(2,'Profesor'),(3,'Ambos');
INSERT INTO `horario`(`bloque_horario`) VALUES ('19:20 - 20:00'),('20:00 - 20:40'),('20:40 - 21:20'),('21:30 - 22:10'),('22:10 - 22:50'), ('22:50 - 23:30');