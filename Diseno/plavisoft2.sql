SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `plavisoft` ;
CREATE SCHEMA IF NOT EXISTS `plavisoft` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `plavisoft` ;

-- -----------------------------------------------------
-- Table `plavisoft`.`tipo_persona`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `plavisoft`.`tipo_persona` ;

CREATE TABLE IF NOT EXISTS `plavisoft`.`tipo_persona` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plavisoft`.`persona`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `plavisoft`.`persona` ;

CREATE TABLE IF NOT EXISTS `plavisoft`.`persona` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Apellido` VARCHAR(100) NULL,
  `Nombre` VARCHAR(45) NULL,
  `Domicilio` VARCHAR(100) NULL,
  `DNI` VARCHAR(10) NULL,
  `Mail` VARCHAR(45) NULL,
  `IngresosMensules` INT NULL,
  `CantHijos` INT NULL,
  `FechaAlta` DATE NULL,
  `Borrado` VARCHAR(45) NULL,
  `Nota` VARCHAR(255) NULL,
  `IdSocio` INT NULL,
  `tipo_persona_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_persona_tipo_persona1_idx` (`tipo_persona_id` ASC),
  CONSTRAINT `fk_persona_tipo_persona1`
    FOREIGN KEY (`tipo_persona_id`)
    REFERENCES `plavisoft`.`tipo_persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Personas Titulares al Plan de Vivienda';


-- -----------------------------------------------------
-- Table `plavisoft`.`tipo_vivienda`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `plavisoft`.`tipo_vivienda` ;

CREATE TABLE IF NOT EXISTS `plavisoft`.`tipo_vivienda` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(45) NULL,
  `Valor` INT NULL,
  `Nombre` VARCHAR(45) NULL,
  `MtrosCubiertos` INT NULL,
  `MtrosDescubiertos` INT NULL,
  `CantHabitaciones` INT NULL,
  `CantPisos` INT NULL,
  `SobreCalle` TINYINT(1) NULL,
  `tipo_viviendacol` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plavisoft`.`estado_adjudicacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `plavisoft`.`estado_adjudicacion` ;

CREATE TABLE IF NOT EXISTS `plavisoft`.`estado_adjudicacion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(50) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plavisoft`.`tipo_cuota`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `plavisoft`.`tipo_cuota` ;

CREATE TABLE IF NOT EXISTS `plavisoft`.`tipo_cuota` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(45) NULL,
  `Mes` INT NULL,
  `Tipo` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plavisoft`.`financiacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `plavisoft`.`financiacion` ;

CREATE TABLE IF NOT EXISTS `plavisoft`.`financiacion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(100) NULL,
  `tipo_vivienda_id` INT NOT NULL,
  `Tipo_Financiacion` INT NOT NULL,
  `Importe` DECIMAL NULL,
  `cant_coutas` INT NULL,
  `posicion` INT NULL,
  `estado_adjudicacion_id` INT NOT NULL,
  `tipo_cuota_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_financiacion_tipo_vivienda1_idx` (`tipo_vivienda_id` ASC),
  INDEX `fk_financiacion_estado_adjudicacion1_idx` (`estado_adjudicacion_id` ASC),
  INDEX `fk_financiacion_tipo_cuota1_idx` (`tipo_cuota_id` ASC),
  CONSTRAINT `fk_financiacion_tipo_vivienda1`
    FOREIGN KEY (`tipo_vivienda_id`)
    REFERENCES `plavisoft`.`tipo_vivienda` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_financiacion_estado_adjudicacion1`
    FOREIGN KEY (`estado_adjudicacion_id`)
    REFERENCES `plavisoft`.`estado_adjudicacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_financiacion_tipo_cuota1`
    FOREIGN KEY (`tipo_cuota_id`)
    REFERENCES `plavisoft`.`tipo_cuota` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plavisoft`.`suscripcion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `plavisoft`.`suscripcion` ;

CREATE TABLE IF NOT EXISTS `plavisoft`.`suscripcion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `FechaAlta` DATE NULL,
  `Activo` TINYINT(1) NULL,
  `persona_id` INT NOT NULL,
  `Borrado` TINYINT(1) NULL,
  `financiacion_id` INT NOT NULL,
  `Nota` VARCHAR(255) NULL,
  `estado_adjudicacion_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_suscripcion_persona1_idx` (`persona_id` ASC),
  INDEX `fk_suscripcion_financiacion1_idx` (`financiacion_id` ASC),
  INDEX `fk_suscripcion_estado_adjudicacion1_idx` (`estado_adjudicacion_id` ASC),
  CONSTRAINT `fk_suscripcion_persona1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `plavisoft`.`persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_suscripcion_financiacion1`
    FOREIGN KEY (`financiacion_id`)
    REFERENCES `plavisoft`.`financiacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_suscripcion_estado_adjudicacion1`
    FOREIGN KEY (`estado_adjudicacion_id`)
    REFERENCES `plavisoft`.`estado_adjudicacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Suscripción de una Persona en un Plan\n';


-- -----------------------------------------------------
-- Table `plavisoft`.`forma_pago`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `plavisoft`.`forma_pago` ;

CREATE TABLE IF NOT EXISTS `plavisoft`.`forma_pago` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plavisoft`.`pago`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `plavisoft`.`pago` ;

CREATE TABLE IF NOT EXISTS `plavisoft`.`pago` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `FechaPago` DATE NULL,
  `FormaPago` VARCHAR(45) NULL,
  `NroCuota` INT NULL,
  `suscripcion_id` INT NOT NULL,
  `financiacion_id` INT NOT NULL,
  `Pagado` TINYINT(1) NULL,
  `NroDeposito` INT NULL,
  `forma_pago_id` INT NOT NULL,
  `Importe` INT NULL,
  `Descripcion` VARCHAR(100) NULL,
  `Anio` INT NULL,
  `Mes` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pago_suscripcion1_idx` (`suscripcion_id` ASC),
  INDEX `fk_pago_financiacion1_idx` (`financiacion_id` ASC),
  INDEX `fk_pago_forma_pago1_idx` (`forma_pago_id` ASC),
  CONSTRAINT `fk_pago_suscripcion1`
    FOREIGN KEY (`suscripcion_id`)
    REFERENCES `plavisoft`.`suscripcion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pago_financiacion1`
    FOREIGN KEY (`financiacion_id`)
    REFERENCES `plavisoft`.`financiacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pago_forma_pago1`
    FOREIGN KEY (`forma_pago_id`)
    REFERENCES `plavisoft`.`forma_pago` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `plavisoft`.`tipo_persona`
-- -----------------------------------------------------
START TRANSACTION;
USE `plavisoft`;
INSERT INTO `plavisoft`.`tipo_persona` (`id`, `Descripcion`) VALUES (1, 'Socio');
INSERT INTO `plavisoft`.`tipo_persona` (`id`, `Descripcion`) VALUES (2, 'Adherente');

COMMIT;


-- -----------------------------------------------------
-- Data for table `plavisoft`.`estado_adjudicacion`
-- -----------------------------------------------------
START TRANSACTION;
USE `plavisoft`;
INSERT INTO `plavisoft`.`estado_adjudicacion` (`id`, `Descripcion`) VALUES (1, 'No Adjudicado');
INSERT INTO `plavisoft`.`estado_adjudicacion` (`id`, `Descripcion`) VALUES (2, 'Adjudicado');

COMMIT;


-- -----------------------------------------------------
-- Data for table `plavisoft`.`tipo_cuota`
-- -----------------------------------------------------
START TRANSACTION;
USE `plavisoft`;
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (1, 'Cuota Inicial', 0, 1);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (2, 'Enero', 1, 2);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (3, 'Febrero', 2, 2);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (4, 'Marzo', 3, 2);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (5, 'Abril', 4, 2);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (6, 'Mayo', 5, 2);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (7, 'Junio', 6, 2);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (8, 'Julio', 7, 2);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (9, 'Agosto', 8, 2);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (10, 'Septiembre', 9, 2);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (11, 'Octubre', 10, 2);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (12, 'Noviembre', 11, 2);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (13, 'Diciembre', 12, 2);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (14, 'Cuota Ag. Enero', 1, 3);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (15, 'Febrero', 2, 4);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (16, 'Marzo ', 3, 4);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (17, 'Abril', 4, 4);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (18, 'Mayo', 5, 4);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (19, 'Junio', 6, 4);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (20, 'Julio', 7, 4);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (21, 'Agosto', 8, 4);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (22, 'Septiembre', 9, 4);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (23, 'Octubre', 10, 4);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (24, 'Noviembre', 11, 4);
INSERT INTO `plavisoft`.`tipo_cuota` (`id`, `Descripcion`, `Mes`, `Tipo`) VALUES (25, 'Cuota Ag.Diciembre', 12, 3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `plavisoft`.`forma_pago`
-- -----------------------------------------------------
START TRANSACTION;
USE `plavisoft`;
INSERT INTO `plavisoft`.`forma_pago` (`id`, `Descripcion`) VALUES (1, 'Contado');
INSERT INTO `plavisoft`.`forma_pago` (`id`, `Descripcion`) VALUES (2, 'Cheque');
INSERT INTO `plavisoft`.`forma_pago` (`id`, `Descripcion`) VALUES (3, 'Depósito');

COMMIT;

