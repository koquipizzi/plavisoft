CREATE DATABASE  IF NOT EXISTS `plavisoft` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `plavisoft`;
-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: plavisoft
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1

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
-- Table structure for table `adelanto`
--

DROP TABLE IF EXISTS `adelanto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adelanto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `persona_id` int(11) NOT NULL,
  `forma_pago_id` int(11) DEFAULT NULL,
  `importe` int(11) NOT NULL,
  `pago_id` int(11) DEFAULT NULL,
  `adelanto_id` int(11) NOT NULL,
  `importe_imputado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `persona_id` (`persona_id`),
  KEY `forma_pago_id` (`forma_pago_id`),
  CONSTRAINT `adelanto_ibfk_1` FOREIGN KEY (`forma_pago_id`) REFERENCES `forma_pago` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adelanto`
--

LOCK TABLES `adelanto` WRITE;
/*!40000 ALTER TABLE `adelanto` DISABLE KEYS */;
/*!40000 ALTER TABLE `adelanto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_adjudicacion`
--

DROP TABLE IF EXISTS `estado_adjudicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_adjudicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_adjudicacion`
--

LOCK TABLES `estado_adjudicacion` WRITE;
/*!40000 ALTER TABLE `estado_adjudicacion` DISABLE KEYS */;
INSERT INTO `estado_adjudicacion` VALUES (1,'No Adjudicado'),(2,'Adjudicado');
/*!40000 ALTER TABLE `estado_adjudicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `financiacion`
--

DROP TABLE IF EXISTS `financiacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `financiacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) DEFAULT NULL,
  `tipo_vivienda_id` int(11) NOT NULL,
  `Tipo_Financiacion` int(11) NOT NULL,
  `Importe` decimal(10,0) DEFAULT NULL,
  `ImporteLetras` varchar(255) NOT NULL,
  `cant_cuotas` int(11) DEFAULT NULL,
  `posicion` int(11) DEFAULT NULL,
  `tipo_persona_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_financiacion_tipo_vivienda1_idx` (`tipo_vivienda_id`),
  KEY `fk_financiacion_tipo_persona` (`tipo_persona_id`),
  CONSTRAINT `fk_financiacion_tipo_persona` FOREIGN KEY (`tipo_persona_id`) REFERENCES `tipo_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_financiacion_tipo_vivienda1` FOREIGN KEY (`tipo_vivienda_id`) REFERENCES `tipo_vivienda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `financiacion`
--

LOCK TABLES `financiacion` WRITE;
/*!40000 ALTER TABLE `financiacion` DISABLE KEYS */;
INSERT INTO `financiacion` VALUES (7,'Monoambiente 1  - SOCIO',1,12014,550000,'Quinientos Cincuenta Mil Pesos',85,1,1),(8,'Dúplex 1  - ADHERENTE',1,22014,650000,'Seiscientos Cincuenta Mil Pesos',85,2,1),(9,'Monoambiente 1  - ADHERENTE',1,32014,550000,'Quinientos Cincuenta Mil Pesos',85,1,1),(10,'Dúplex 1  - SOCIO',1,22014,650000,'Seiscientos Cincuenta Mil Pesos',85,2,1);
/*!40000 ALTER TABLE `financiacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forma_pago`
--

DROP TABLE IF EXISTS `forma_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_pago`
--

LOCK TABLES `forma_pago` WRITE;
/*!40000 ALTER TABLE `forma_pago` DISABLE KEYS */;
INSERT INTO `forma_pago` VALUES (1,'Contado'),(2,'Cheque'),(3,'Depósito');
/*!40000 ALTER TABLE `forma_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pago`
--

DROP TABLE IF EXISTS `pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FechaPago` date DEFAULT NULL,
  `suscripcion_id` int(11) NOT NULL,
  `financiacion_id` int(11) NOT NULL,
  `NroDeposito` int(11) DEFAULT NULL,
  `forma_pago_id` int(11) NOT NULL,
  `Importe` decimal(15,2) DEFAULT NULL,
  `ImporteLetras` varchar(255) NOT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `Anio` int(11) DEFAULT NULL,
  `Mes` varchar(50) DEFAULT NULL,
  `planpago_id` int(11) NOT NULL,
  `NroCuota` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pago_suscripcion1_idx` (`suscripcion_id`),
  KEY `fk_pago_financiacion1_idx` (`financiacion_id`),
  KEY `fk_pago_forma_pago1_idx` (`forma_pago_id`),
  KEY `planpago_id` (`planpago_id`),
  CONSTRAINT `fk_pago_financiacion1` FOREIGN KEY (`financiacion_id`) REFERENCES `financiacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pago_forma_pago1` FOREIGN KEY (`forma_pago_id`) REFERENCES `forma_pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pago_suscripcion1` FOREIGN KEY (`suscripcion_id`) REFERENCES `suscripcion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`planpago_id`) REFERENCES `planpago` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pago`
--

LOCK TABLES `pago` WRITE;
/*!40000 ALTER TABLE `pago` DISABLE KEYS */;
/*!40000 ALTER TABLE `pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Apellido` varchar(100) DEFAULT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Domicilio` varchar(100) DEFAULT NULL,
  `DNI` varchar(10) DEFAULT NULL,
  `Mail` varchar(45) DEFAULT NULL,
  `Telefono` varchar(50) NOT NULL,
  `TelefonoCelular` varchar(50) NOT NULL,
  `IngresosMensuales` int(11) DEFAULT NULL,
  `CantHijos` int(11) DEFAULT NULL,
  `FechaAlta` date DEFAULT NULL,
  `Borrado` varchar(45) DEFAULT NULL,
  `Nota` varchar(255) DEFAULT NULL,
  `IdSocio` int(11) DEFAULT NULL,
  `tipo_persona_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_persona_tipo_persona1_idx` (`tipo_persona_id`),
  CONSTRAINT `fk_persona_tipo_persona1` FOREIGN KEY (`tipo_persona_id`) REFERENCES `tipo_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='Personas Titulares al Plan de Vivienda';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (6,'Pizzi','Alejandra','11 de Septiembre 241','26254665','koquipizzi@gmail.com','','',6000,NULL,'2014-06-06',NULL,'',NULL,2),(7,'Castellano','Horacio','','','','','',NULL,NULL,'2014-06-06',NULL,'',3,1),(8,'Gonzalez Guerra','Oscar','','','','','154581293',NULL,NULL,'2014-06-06',NULL,'109 - A',NULL,2),(9,'Farina','Susana','','','','','',NULL,NULL,'2014-06-06',NULL,'110 - A',NULL,2),(10,'Torres','Marcelo','','','','','',NULL,NULL,'2014-06-06',NULL,'',6,1),(11,'Alia','Julio','','','','','',NULL,NULL,'2014-06-06',NULL,'',69,1),(12,'Gorozo','Marcelo','','','','','',NULL,NULL,'2014-06-06',NULL,'',81,1),(13,'Cambronera','Juan','','','','','154338478',NULL,NULL,'2014-06-06',NULL,'',84,1),(14,'Pellizari','Alberto José','','','','','',NULL,NULL,'2014-06-06',NULL,'',87,1),(15,'López','Mario','','','','','',NULL,NULL,'2014-06-06',NULL,'',105,1),(16,'Heit','Francisco','','','','','154348083',NULL,NULL,'2014-06-06',NULL,'',86,1),(17,'Alabart','Alberto','','','','','154351147',NULL,NULL,'2014-06-06',NULL,'',45,1),(18,'Peralta','Diego','','','','','',NULL,NULL,'2014-06-06',NULL,'',73,1),(19,'Martinez','José Luis','','','','','154646661',NULL,NULL,'2014-06-06',NULL,'',91,1),(20,'Calvo','José Luis','','','','4429592','',NULL,NULL,'2014-06-06',NULL,'',92,1),(21,'Cicopiedi','Alfredo','','','','','154210203',NULL,NULL,'2014-06-06',NULL,'',116,1),(22,'Mestelan','Adrián','','','','','154686266',NULL,NULL,'2014-06-06',NULL,'',40,1),(23,'Ferraro','Natalio','','','','','',NULL,NULL,'2014-06-06',NULL,'',97,1),(24,'Rodriguez','Pablo Daniel','','','','','154009526',NULL,NULL,'2014-06-06',NULL,'',98,1),(25,'Gonzalez','Pedro','','','','','154509356',NULL,NULL,'2014-06-06',NULL,'',99,1),(26,'Paredes','Simón','','','','','154354993',NULL,NULL,'2014-06-06',NULL,'',104,1),(27,'Borges','Gustavo Fabián','','','','','154307991',NULL,NULL,'2014-06-06',NULL,'',102,1),(28,'Diaz','Jorge Alberto','','','','4434996','',NULL,NULL,'2014-06-06',NULL,'',101,1),(29,'Marcos','Alejandra','','','','','154475568',NULL,NULL,'2014-06-06',NULL,'106 - A',NULL,2),(30,'Di Candiilo','Alfredo','','','','','154536474',NULL,NULL,'2014-06-06',NULL,'',115,1),(31,'Platz','José','','','','','154678461',NULL,NULL,'2014-06-06',NULL,'',9999,1),(32,'Siri','Laura','','','','','154645035',NULL,NULL,'2014-06-06',NULL,'',7,1),(33,'De Negri','Abel','','','','','',NULL,NULL,'2014-06-06',NULL,'',1,1),(34,'Pasolini','Eduardo','','','','','154380084',NULL,NULL,'2014-06-09',NULL,'78 - A',NULL,2),(35,'Dell Oso','Jorge','','','','4421930','',NULL,NULL,'2014-06-09',NULL,'114 - A',NULL,2),(36,'Alabart','Jorge','','','','','154632985',NULL,NULL,'2014-06-09',NULL,'',NULL,2),(37,'Olaz','Julio Esteban','','','','','',NULL,NULL,'2014-06-09',NULL,'',NULL,2),(38,'Ghironi','Marcelo','','','','','',NULL,NULL,'2014-06-09',NULL,'',NULL,2),(39,'Martin','Nicola','','','','','',NULL,NULL,'2014-06-09',NULL,'',NULL,2),(40,'Lara','Julián','','','','','154541378',NULL,NULL,'2014-06-09',NULL,'82 - A',NULL,2),(41,'Casanova','Federico','','','','','11- 65042336',NULL,NULL,'2014-06-09',NULL,'83 - A',NULL,2),(42,'Cañada','Cristian','','','','','154601678',NULL,NULL,'2014-06-09',NULL,'95 - A',NULL,2),(43,'Pereyra','Noelia Soledad','','','','','154507170',NULL,NULL,'2014-06-09',NULL,'111 - A',NULL,2),(44,'Pereyra','Sheila','','','','','154599279',NULL,NULL,'2014-06-09',NULL,'112 - A',NULL,2),(45,'Buceta','Patricio Alejandro','','','','','154306081',NULL,NULL,'2014-06-09',NULL,'113 - A',NULL,2),(46,'Llanos','Alejandro','','','','','154357936',NULL,NULL,'2014-06-09',NULL,'94 - A',NULL,2),(47,'Lauge','Emilio','','','','','',NULL,NULL,'2014-06-09',NULL,'117 - A',NULL,2),(48,'Christensen','Cristina','','','','','154615682',NULL,NULL,'2014-06-09',NULL,'',NULL,2),(49,'Echenique','Jorge','','','','','154016176',NULL,NULL,'2014-06-09',NULL,'',NULL,2),(50,'Etchepare','Jorge','','','','','154545445',NULL,NULL,'2014-06-09',NULL,'',NULL,2),(51,'Perez','Ana María','','','','','154632378',NULL,NULL,'2014-06-09',NULL,'',NULL,2),(52,'Gancedo','Marina','','','','','154673259',NULL,NULL,'2014-06-09',NULL,'',NULL,2),(53,'socio adherente','prueba','Paz 930','20204560','prueba@gmail.com','4429877','',11500,NULL,'2014-08-28',NULL,'',NULL,2);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planpago`
--

DROP TABLE IF EXISTS `planpago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planpago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `financiacion_id` int(11) NOT NULL,
  `nro_cuota` int(11) NOT NULL,
  `mes` varchar(50) NOT NULL,
  `anio` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planpago`
--

LOCK TABLES `planpago` WRITE;
/*!40000 ALTER TABLE `planpago` DISABLE KEYS */;
INSERT INTO `planpago` VALUES (9,10,1,'ENERO',2014),(10,10,2,'FEBRERO',2014),(11,10,3,'MARZO',2014),(12,10,4,'ABRIL',2014),(13,10,5,'MAYO',2014),(14,10,6,'JUNIO',2014),(15,10,4,'ABRIL',2014),(16,10,5,'MAYO',2014),(17,10,6,'JUNIO',2014),(18,10,7,'JULIO',2014),(19,10,8,'AGOSTO',2014),(20,10,9,'SEPTIEMBRE',2014),(21,9,1,'ENERO',2014),(22,9,2,'FEBRERO',2014),(23,9,3,'MARZO',2014),(24,9,4,'ABRIL',2014),(25,9,5,'MAYO',2014),(26,9,6,'JUNIO',2014),(27,9,4,'ABRIL',2014),(28,9,5,'MAYO',2014),(29,9,6,'JUNIO',2014),(30,9,7,'JULIO',2014),(31,9,8,'AGOSTO',2014),(32,9,9,'SEPTIEMBRE',2014),(33,8,1,'ENERO',2014),(34,8,2,'FEBRERO',2014),(35,8,3,'MARZO',2014),(36,8,4,'ABRIL',2014),(37,8,5,'MAYO',2014),(38,8,6,'JUNIO',2014),(39,8,4,'ABRIL',2014),(40,8,5,'MAYO',2014),(41,8,6,'JUNIO',2014),(42,8,7,'JULIO',2014),(43,8,8,'AGOSTO',2014),(44,8,9,'SEPTIEMBRE',2014);
/*!40000 ALTER TABLE `planpago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suscripcion`
--

DROP TABLE IF EXISTS `suscripcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suscripcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FechaAlta` date DEFAULT NULL,
  `Activo` tinyint(1) DEFAULT NULL,
  `persona_id` int(11) NOT NULL,
  `Borrado` tinyint(1) DEFAULT NULL,
  `financiacion_id` int(11) NOT NULL,
  `Nota` varchar(255) DEFAULT NULL,
  `estado_adjudicacion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_suscripcion_persona1_idx` (`persona_id`),
  KEY `fk_suscripcion_financiacion1_idx` (`financiacion_id`),
  KEY `fk_suscripcion_estado_adjudicacion1_idx` (`estado_adjudicacion_id`),
  CONSTRAINT `fk_suscripcion_estado_adjudicacion1` FOREIGN KEY (`estado_adjudicacion_id`) REFERENCES `estado_adjudicacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_suscripcion_financiacion1` FOREIGN KEY (`financiacion_id`) REFERENCES `financiacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_suscripcion_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Suscripción de una Persona en un Plan\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suscripcion`
--

LOCK TABLES `suscripcion` WRITE;
/*!40000 ALTER TABLE `suscripcion` DISABLE KEYS */;
/*!40000 ALTER TABLE `suscripcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_cuota`
--

DROP TABLE IF EXISTS `tipo_cuota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_cuota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) DEFAULT NULL,
  `Importe` decimal(15,2) NOT NULL,
  `ImporteLetras` varchar(255) NOT NULL,
  `financiacion_id` int(11) DEFAULT NULL,
  `Adjudicado` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `financiacion_id` (`financiacion_id`),
  CONSTRAINT `tipo_cuota_ibfk_1` FOREIGN KEY (`financiacion_id`) REFERENCES `financiacion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_cuota`
--

LOCK TABLES `tipo_cuota` WRITE;
/*!40000 ALTER TABLE `tipo_cuota` DISABLE KEYS */;
INSERT INTO `tipo_cuota` VALUES (4,'M S Cuota especial',5000.00,'Cinco mil pesos',7,NULL),(5,'M S Cuota',1500.00,'Mil quinientos pesos',7,1),(6,'M S Cuota Adjudicada',3000.00,'Tres mil',7,2),(7,'M Ad Cuota especial',30000.00,'Treinta mil pesos',9,NULL),(8,'M Ad Cuota',2500.00,'Mil quinientos pesos',9,1),(9,'M Ad Cuota Adjudicada',4500.00,'Cuatro Mil quinientos pesos',9,2),(10,'Duplex S Cuota especial',5000.00,'Cinco mil pesos',10,NULL),(11,'Duplex S Cuota',1700.00,'Mil quinientos pesos',10,1),(12,'Duplex S Cuota Adjudicada',3000.00,'Tres mil',10,2),(13,'Duplex S Cuota especial',5000.00,'Cinco mil pesos',8,NULL),(14,'Duplex S Cuota',1500.00,'Mil quinientos pesos',8,1),(15,'Duplex S Cuota Adjudicada',3000.00,'Tres mil',8,2);
/*!40000 ALTER TABLE `tipo_cuota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_persona`
--

DROP TABLE IF EXISTS `tipo_persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;f
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_persona`
--

LOCK TABLES `tipo_persona` WRITE;
/*!40000 ALTER TABLE `tipo_persona` DISABLE KEYS */;
INSERT INTO `tipo_persona` VALUES (1,'Socio'),(2,'Adherente');
/*!40000 ALTER TABLE `tipo_persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_vivienda`
--

DROP TABLE IF EXISTS `tipo_vivienda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_vivienda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) DEFAULT NULL,
  `Valor` int(11) DEFAULT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `MtrosCubiertos` int(11) DEFAULT NULL,
  `MtrosDescubiertos` int(11) DEFAULT NULL,
  `CantHabitaciones` int(11) DEFAULT NULL,
  `CantPisos` int(11) DEFAULT NULL,
  `SobreCalle` tinyint(1) DEFAULT NULL,
  `Fotos` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_vivienda`
--

LOCK TABLES `tipo_vivienda` WRITE;
/*!40000 ALTER TABLE `tipo_vivienda` DISABLE KEYS */;
INSERT INTO `tipo_vivienda` VALUES (1,'Dúplex 1 Ambiente',NULL,'Dúplex 1 Ambiente',40,12,1,2,NULL,'');
/*!40000 ALTER TABLE `tipo_vivienda` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-14 14:52:07
