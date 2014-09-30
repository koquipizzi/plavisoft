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
-- Table structure for table `Log`
--

DROP TABLE IF EXISTS `Log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  `user` varchar(45) DEFAULT NULL,
  `log_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Log`
--

LOCK TABLES `Log` WRITE;
/*!40000 ALTER TABLE `Log` DISABLE KEYS */;
INSERT INTO `Log` VALUES (1,'imputacion_AINS INICIO','root@localhost','2014-09-24 02:47:54'),(2,'imputacion_AINS no','root@localhost','2014-09-24 02:47:54'),(3,'imputacion_AINS fin','root@localhost','2014-09-24 02:47:54'),(4,'imputacion_AINS INICIO','root@localhost','2014-09-24 02:50:42'),(5,'imputacion_AINS si','root@localhost','2014-09-24 02:50:42'),(6,'imputacion_AINS fin','root@localhost','2014-09-24 02:50:42'),(7,'imputacion_AINS INICIO','root@localhost','2014-09-25 14:45:06'),(8,'imputacion_AINS si','root@localhost','2014-09-25 14:45:06'),(9,'imputacion_AINS fin','root@localhost','2014-09-25 14:45:06'),(22,'imputacion_AINS INICIO','root@localhost','2014-09-25 14:56:39'),(23,'imputacion_AINS no','root@localhost','2014-09-25 14:56:39'),(24,'imputacion_AINS fin','root@localhost','2014-09-25 14:56:39'),(25,'imputacion_AINS INICIO','root@localhost','2014-09-25 14:56:47'),(26,'imputacion_AINS no','root@localhost','2014-09-25 14:56:47'),(27,'imputacion_AINS fin','root@localhost','2014-09-25 14:56:47'),(28,'imputacion_AINS INICIO','root@localhost','2014-09-25 15:18:48'),(29,'imputacion_AINS no','root@localhost','2014-09-25 15:18:48'),(30,'imputacion_AINS fin','root@localhost','2014-09-25 15:18:48'),(31,'imputacion_AINS INICIO','root@localhost','2014-09-25 15:19:56'),(32,'imputacion_AINS no','root@localhost','2014-09-25 15:19:56'),(33,'imputacion_AINS fin','root@localhost','2014-09-25 15:19:56'),(34,'imputacion_AINS INICIO','root@localhost','2014-09-25 22:00:02'),(35,'imputacion_AINS no','root@localhost','2014-09-25 22:00:02'),(36,'imputacion_AINS fin','root@localhost','2014-09-25 22:00:02'),(37,'imputacion_AINS INICIO','root@localhost','2014-09-25 22:07:37'),(38,'imputacion_AINS no','root@localhost','2014-09-25 22:07:37'),(39,'imputacion_AINS fin','root@localhost','2014-09-25 22:07:37'),(40,'imputacion_AINS INICIO','root@localhost','2014-09-25 22:18:06'),(41,'imputacion_AINS no','root@localhost','2014-09-25 22:18:06'),(42,'imputacion_AINS fin','root@localhost','2014-09-25 22:18:06');
/*!40000 ALTER TABLE `Log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banco`
--

DROP TABLE IF EXISTS `banco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Banco` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banco`
--

LOCK TABLES `banco` WRITE;
/*!40000 ALTER TABLE `banco` DISABLE KEYS */;
INSERT INTO `banco` VALUES (1,'Provincia de Buenos Aires'),(2,'Nacion Argentina'),(3,'Frances'),(4,'Hipotecario');
/*!40000 ALTER TABLE `banco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cheque`
--

DROP TABLE IF EXISTS `cheque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cheque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nro_cheque` varchar(45) DEFAULT NULL,
  `Cta_cte` varchar(45) DEFAULT NULL,
  `valor` decimal(15,2) DEFAULT NULL,
  `pago_id` int(11) NOT NULL,
  `NombreTitular` varchar(100) DEFAULT NULL,
  `banco_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cheque_pago1_idx` (`pago_id`),
  KEY `fk_cheque_banco1_idx` (`banco_id`),
  CONSTRAINT `fk_cheque_banco1` FOREIGN KEY (`banco_id`) REFERENCES `banco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cheque_pago1` FOREIGN KEY (`pago_id`) REFERENCES `pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cheque`
--

LOCK TABLES `cheque` WRITE;
/*!40000 ALTER TABLE `cheque` DISABLE KEYS */;
INSERT INTO `cheque` VALUES (1,'das','asd',200.00,38,'dsa',1);
/*!40000 ALTER TABLE `cheque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cheque_runtime`
--

DROP TABLE IF EXISTS `cheque_runtime`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cheque_runtime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nro_cheque` varchar(45) DEFAULT NULL,
  `Cta_cte` varchar(45) DEFAULT NULL,
  `valor` decimal(15,2) DEFAULT NULL,
  `NombreTitular` varchar(100) DEFAULT NULL,
  `banco_id` int(11) NOT NULL,
  `ins_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_cheque_banco1_idx` (`banco_id`),
  CONSTRAINT `fk_cheque_banco10` FOREIGN KEY (`banco_id`) REFERENCES `banco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cheque_runtime`
--

LOCK TABLES `cheque_runtime` WRITE;
/*!40000 ALTER TABLE `cheque_runtime` DISABLE KEYS */;
INSERT INTO `cheque_runtime` VALUES (1,'2020','',200.00,'Juan Perez',1,'2014-09-25 14:45:02'),(2,'das','asd',200.00,'dsa',1,'2014-09-27 15:56:51'),(3,'das','asd',200.00,'dsa',1,'2014-09-27 19:05:22'),(4,'das','asd',200.00,'dsa',1,'2014-09-27 19:05:22');
/*!40000 ALTER TABLE `cheque_runtime` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuota`
--

DROP TABLE IF EXISTS `cuota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuota` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `suscripcion_id` int(11) NOT NULL,
  `nro_cuota` int(11) DEFAULT NULL,
  `valor` decimal(15,2) DEFAULT NULL,
  `valorLetras` varchar(255) DEFAULT NULL,
  `mes_id` tinyint(4) NOT NULL,
  `anio` int(11) DEFAULT NULL,
  `saldada` varchar(2) DEFAULT 'No',
  PRIMARY KEY (`id`),
  KEY `fk_cuota_suscripcion1_idx` (`suscripcion_id`),
  KEY `fk_cuota_mes1_idx` (`mes_id`),
  CONSTRAINT `fk_cuota_mes1` FOREIGN KEY (`mes_id`) REFERENCES `mes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cuota_suscripcion1` FOREIGN KEY (`suscripcion_id`) REFERENCES `suscripcion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=323 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuota`
--

LOCK TABLES `cuota` WRITE;
/*!40000 ALTER TABLE `cuota` DISABLE KEYS */;
INSERT INTO `cuota` VALUES (29,34,0,2500.00,'dos mil quinientos  pesos',1,2014,'No'),(30,34,1,2500.00,'dos mil quinientos  pesos',2,2014,'No'),(31,34,2,2500.00,'dos mil quinientos  pesos',3,2014,'No'),(32,34,3,2500.00,'dos mil quinientos  pesos',4,2014,'No'),(33,34,4,2500.00,'dos mil quinientos  pesos',5,2014,'No'),(34,34,5,2500.00,'dos mil quinientos  pesos',6,2014,'No'),(35,34,6,2500.00,'dos mil quinientos  pesos',7,2014,'No'),(36,34,7,2500.00,'dos mil quinientos  pesos',8,2014,'No'),(37,34,8,2500.00,'dos mil quinientos  pesos',9,2014,'No'),(38,34,9,2500.00,'dos mil quinientos  pesos',10,2014,'No'),(39,34,10,2500.00,'dos mil quinientos  pesos',11,2014,'No'),(40,34,11,2500.00,'dos mil quinientos  pesos',12,2014,'No'),(41,34,12,2500.00,'dos mil quinientos  pesos',1,2015,'No'),(42,34,13,2500.00,'dos mil quinientos  pesos',2,2015,'No'),(43,34,14,2500.00,'dos mil quinientos  pesos',3,2015,'No'),(44,34,15,2500.00,'dos mil quinientos  pesos',4,2015,'No'),(45,34,16,2500.00,'dos mil quinientos  pesos',5,2015,'No'),(46,34,17,2500.00,'dos mil quinientos  pesos',6,2015,'No'),(47,34,18,2500.00,'dos mil quinientos  pesos',7,2015,'No'),(48,34,19,2500.00,'dos mil quinientos  pesos',8,2015,'No'),(49,34,20,2500.00,'dos mil quinientos  pesos',9,2015,'No'),(50,34,21,2500.00,'dos mil quinientos  pesos',10,2015,'No'),(51,34,22,2500.00,'dos mil quinientos  pesos',11,2015,'No'),(52,34,23,2500.00,'dos mil quinientos  pesos',12,2015,'No'),(59,43,0,1500.00,'mil quinientos  pesos',1,2014,'No'),(60,43,1,1500.00,'mil quinientos  pesos',2,2014,'No'),(61,43,2,1500.00,'mil quinientos  pesos',3,2014,'No'),(62,43,3,1500.00,'mil quinientos  pesos',4,2014,'No'),(63,43,4,1500.00,'mil quinientos  pesos',5,2014,'No'),(64,43,5,1500.00,'mil quinientos  pesos',6,2014,'No'),(65,43,6,1500.00,'mil quinientos  pesos',7,2014,'No'),(66,43,7,1500.00,'mil quinientos  pesos',8,2014,'No'),(67,43,8,1500.00,'mil quinientos  pesos',9,2014,'No'),(68,43,9,1500.00,'mil quinientos  pesos',10,2014,'No'),(69,43,10,1500.00,'mil quinientos  pesos',11,2014,'No'),(70,43,11,1500.00,'mil quinientos  pesos',12,2014,'No'),(71,43,12,1500.00,'mil quinientos  pesos',1,2015,'No'),(72,43,13,1500.00,'mil quinientos  pesos',2,2015,'No'),(73,43,14,1500.00,'mil quinientos  pesos',3,2015,'No'),(74,43,15,1500.00,'mil quinientos  pesos',4,2015,'No'),(75,43,16,1500.00,'mil quinientos  pesos',5,2015,'No'),(76,43,17,1500.00,'mil quinientos  pesos',6,2015,'No'),(77,43,18,1500.00,'mil quinientos  pesos',7,2015,'No'),(78,43,19,1500.00,'mil quinientos  pesos',8,2015,'No'),(79,43,20,1500.00,'mil quinientos  pesos',9,2015,'No'),(80,43,21,1500.00,'mil quinientos  pesos',10,2015,'No'),(81,43,22,1500.00,'mil quinientos  pesos',11,2015,'No'),(82,43,23,1500.00,'mil quinientos  pesos',12,2015,'No'),(83,44,0,1.70,'mil setecientos  pesos',1,2014,'Si'),(84,44,1,1.70,'mil setecientos  pesos',2,2014,'Si'),(85,44,2,1700.00,'mil setecientos  pesos',3,2014,'No'),(86,44,3,1700.00,'mil setecientos  pesos',4,2014,'No'),(87,44,4,1700.00,'mil setecientos  pesos',5,2014,'No'),(88,44,5,1700.00,'mil setecientos  pesos',6,2014,'No'),(89,44,6,1700.00,'mil setecientos  pesos',7,2014,'No'),(90,44,7,1700.00,'mil setecientos  pesos',8,2014,'No'),(91,44,8,1700.00,'mil setecientos  pesos',9,2014,'No'),(92,44,9,1700.00,'mil setecientos  pesos',10,2014,'No'),(93,44,10,1700.00,'mil setecientos  pesos',11,2014,'No'),(94,44,11,1700.00,'mil setecientos  pesos',12,2014,'No'),(95,44,12,1700.00,'mil setecientos  pesos',1,2015,'No'),(96,44,13,1700.00,'mil setecientos  pesos',2,2015,'No'),(97,44,14,1700.00,'mil setecientos  pesos',3,2015,'No'),(98,44,15,1700.00,'mil setecientos  pesos',4,2015,'No'),(99,44,16,1700.00,'mil setecientos  pesos',5,2015,'No'),(100,44,17,1700.00,'mil setecientos  pesos',6,2015,'No'),(101,44,18,1700.00,'mil setecientos  pesos',7,2015,'No'),(102,44,19,1700.00,'mil setecientos  pesos',8,2015,'No'),(103,44,20,1700.00,'mil setecientos  pesos',9,2015,'No'),(104,44,21,1700.00,'mil setecientos  pesos',10,2015,'No'),(105,44,22,1700.00,'mil setecientos  pesos',11,2015,'No'),(106,44,23,1700.00,'mil setecientos  pesos',12,2015,'No'),(107,45,0,1500.00,'mil quinientos  pesos',1,2014,'No'),(108,45,1,1500.00,'mil quinientos  pesos',2,2014,'No'),(109,45,2,1500.00,'mil quinientos  pesos',3,2014,'No'),(110,45,3,1500.00,'mil quinientos  pesos',4,2014,'No'),(111,45,4,1500.00,'mil quinientos  pesos',5,2014,'No'),(112,45,5,1500.00,'mil quinientos  pesos',6,2014,'No'),(113,45,6,1500.00,'mil quinientos  pesos',7,2014,'No'),(114,45,7,1500.00,'mil quinientos  pesos',8,2014,'No'),(115,45,8,1500.00,'mil quinientos  pesos',9,2014,'No'),(116,45,9,1500.00,'mil quinientos  pesos',10,2014,'No'),(117,45,10,1500.00,'mil quinientos  pesos',11,2014,'No'),(118,45,11,1500.00,'mil quinientos  pesos',12,2014,'No'),(119,45,12,1500.00,'mil quinientos  pesos',1,2015,'No'),(120,45,13,1500.00,'mil quinientos  pesos',2,2015,'No'),(121,45,14,1500.00,'mil quinientos  pesos',3,2015,'No'),(122,45,15,1500.00,'mil quinientos  pesos',4,2015,'No'),(123,45,16,1500.00,'mil quinientos  pesos',5,2015,'No'),(124,45,17,1500.00,'mil quinientos  pesos',6,2015,'No'),(125,45,18,1500.00,'mil quinientos  pesos',7,2015,'No'),(126,45,19,1500.00,'mil quinientos  pesos',8,2015,'No'),(127,45,20,1500.00,'mil quinientos  pesos',9,2015,'No'),(128,45,21,1500.00,'mil quinientos  pesos',10,2015,'No'),(129,45,22,1500.00,'mil quinientos  pesos',11,2015,'No'),(130,45,23,1500.00,'mil quinientos  pesos',12,2015,'No'),(131,46,0,1500.00,'mil quinientos  pesos',1,2014,'No'),(132,46,1,1500.00,'mil quinientos  pesos',2,2014,'No'),(133,46,2,1500.00,'mil quinientos  pesos',3,2014,'No'),(134,46,3,1500.00,'mil quinientos  pesos',4,2014,'No'),(135,46,4,1500.00,'mil quinientos  pesos',5,2014,'No'),(136,46,5,1500.00,'mil quinientos  pesos',6,2014,'No'),(137,46,6,1500.00,'mil quinientos  pesos',7,2014,'No'),(138,46,7,1500.00,'mil quinientos  pesos',8,2014,'No'),(139,46,8,1500.00,'mil quinientos  pesos',9,2014,'No'),(140,46,9,1500.00,'mil quinientos  pesos',10,2014,'No'),(141,46,10,1500.00,'mil quinientos  pesos',11,2014,'No'),(142,46,11,1500.00,'mil quinientos  pesos',12,2014,'No'),(143,46,12,1500.00,'mil quinientos  pesos',1,2015,'No'),(144,46,13,1500.00,'mil quinientos  pesos',2,2015,'No'),(145,46,14,1500.00,'mil quinientos  pesos',3,2015,'No'),(146,46,15,1500.00,'mil quinientos  pesos',4,2015,'No'),(147,46,16,1500.00,'mil quinientos  pesos',5,2015,'No'),(148,46,17,1500.00,'mil quinientos  pesos',6,2015,'No'),(149,46,18,1500.00,'mil quinientos  pesos',7,2015,'No'),(150,46,19,1500.00,'mil quinientos  pesos',8,2015,'No'),(151,46,20,1500.00,'mil quinientos  pesos',9,2015,'No'),(152,46,21,1500.00,'mil quinientos  pesos',10,2015,'No'),(153,46,22,1500.00,'mil quinientos  pesos',11,2015,'No'),(154,46,23,1500.00,'mil quinientos  pesos',12,2015,'No'),(155,47,0,1500.00,'mil quinientos  pesos',1,2014,'Si'),(156,47,1,1500.00,'mil quinientos  pesos',2,2014,'No'),(157,47,2,1500.00,'mil quinientos  pesos',3,2014,'No'),(158,47,3,1500.00,'mil quinientos  pesos',4,2014,'No'),(159,47,4,1500.00,'mil quinientos  pesos',5,2014,'No'),(160,47,5,1500.00,'mil quinientos  pesos',6,2014,'No'),(161,47,6,1500.00,'mil quinientos  pesos',7,2014,'No'),(162,47,7,1500.00,'mil quinientos  pesos',8,2014,'No'),(163,47,8,1500.00,'mil quinientos  pesos',9,2014,'No'),(164,47,9,1500.00,'mil quinientos  pesos',10,2014,'No'),(165,47,10,1500.00,'mil quinientos  pesos',11,2014,'No'),(166,47,11,1500.00,'mil quinientos  pesos',12,2014,'No'),(167,47,12,1500.00,'mil quinientos  pesos',1,2015,'No'),(168,47,13,1500.00,'mil quinientos  pesos',2,2015,'No'),(169,47,14,1500.00,'mil quinientos  pesos',3,2015,'No'),(170,47,15,1500.00,'mil quinientos  pesos',4,2015,'No'),(171,47,16,1500.00,'mil quinientos  pesos',5,2015,'No'),(172,47,17,1500.00,'mil quinientos  pesos',6,2015,'No'),(173,47,18,1500.00,'mil quinientos  pesos',7,2015,'No'),(174,47,19,1500.00,'mil quinientos  pesos',8,2015,'No'),(175,47,20,1500.00,'mil quinientos  pesos',9,2015,'No'),(176,47,21,1500.00,'mil quinientos  pesos',10,2015,'No'),(177,47,22,1500.00,'mil quinientos  pesos',11,2015,'No'),(178,47,23,1500.00,'mil quinientos  pesos',12,2015,'No'),(179,48,0,2500.00,'dos mil quinientos  pesos',1,2014,'No'),(180,48,1,2500.00,'dos mil quinientos  pesos',2,2014,'No'),(181,48,2,2500.00,'dos mil quinientos  pesos',3,2014,'No'),(182,48,3,2500.00,'dos mil quinientos  pesos',4,2014,'No'),(183,48,4,2500.00,'dos mil quinientos  pesos',5,2014,'No'),(184,48,5,2500.00,'dos mil quinientos  pesos',6,2014,'No'),(185,48,6,2500.00,'dos mil quinientos  pesos',7,2014,'No'),(186,48,7,2500.00,'dos mil quinientos  pesos',8,2014,'No'),(187,48,8,2500.00,'dos mil quinientos  pesos',9,2014,'No'),(188,48,9,2500.00,'dos mil quinientos  pesos',10,2014,'No'),(189,48,10,2500.00,'dos mil quinientos  pesos',11,2014,'No'),(190,48,11,2500.00,'dos mil quinientos  pesos',12,2014,'No'),(191,48,12,2500.00,'dos mil quinientos  pesos',1,2015,'No'),(192,48,13,2500.00,'dos mil quinientos  pesos',2,2015,'No'),(193,48,14,2500.00,'dos mil quinientos  pesos',3,2015,'No'),(194,48,15,2500.00,'dos mil quinientos  pesos',4,2015,'No'),(195,48,16,2500.00,'dos mil quinientos  pesos',5,2015,'No'),(196,48,17,2500.00,'dos mil quinientos  pesos',6,2015,'No'),(197,48,18,2500.00,'dos mil quinientos  pesos',7,2015,'No'),(198,48,19,2500.00,'dos mil quinientos  pesos',8,2015,'No'),(199,48,20,2500.00,'dos mil quinientos  pesos',9,2015,'No'),(200,48,21,2500.00,'dos mil quinientos  pesos',10,2015,'No'),(201,48,22,2500.00,'dos mil quinientos  pesos',11,2015,'No'),(202,48,23,2500.00,'dos mil quinientos  pesos',12,2015,'No'),(203,49,0,1500.00,'mil quinientos  pesos',1,2014,'No'),(204,49,1,1500.00,'mil quinientos  pesos',2,2014,'No'),(205,49,2,1500.00,'mil quinientos  pesos',3,2014,'No'),(206,49,3,1500.00,'mil quinientos  pesos',4,2014,'No'),(207,49,4,1500.00,'mil quinientos  pesos',5,2014,'No'),(208,49,5,1500.00,'mil quinientos  pesos',6,2014,'No'),(209,49,6,1500.00,'mil quinientos  pesos',7,2014,'No'),(210,49,7,1500.00,'mil quinientos  pesos',8,2014,'No'),(211,49,8,1500.00,'mil quinientos  pesos',9,2014,'No'),(212,49,9,1500.00,'mil quinientos  pesos',10,2014,'No'),(213,49,10,1500.00,'mil quinientos  pesos',11,2014,'No'),(214,49,11,1500.00,'mil quinientos  pesos',12,2014,'No'),(215,49,12,1500.00,'mil quinientos  pesos',1,2015,'No'),(216,49,13,1500.00,'mil quinientos  pesos',2,2015,'No'),(217,49,14,1500.00,'mil quinientos  pesos',3,2015,'No'),(218,49,15,1500.00,'mil quinientos  pesos',4,2015,'No'),(219,49,16,1500.00,'mil quinientos  pesos',5,2015,'No'),(220,49,17,1500.00,'mil quinientos  pesos',6,2015,'No'),(221,49,18,1500.00,'mil quinientos  pesos',7,2015,'No'),(222,49,19,1500.00,'mil quinientos  pesos',8,2015,'No'),(223,49,20,1500.00,'mil quinientos  pesos',9,2015,'No'),(224,49,21,1500.00,'mil quinientos  pesos',10,2015,'No'),(225,49,22,1500.00,'mil quinientos  pesos',11,2015,'No'),(226,49,23,1500.00,'mil quinientos  pesos',12,2015,'No'),(227,50,0,1700.00,'mil setecientos  pesos',1,2014,'No'),(228,50,1,1700.00,'mil setecientos  pesos',2,2014,'No'),(229,50,2,1700.00,'mil setecientos  pesos',3,2014,'No'),(230,50,3,1700.00,'mil setecientos  pesos',4,2014,'No'),(231,50,4,1700.00,'mil setecientos  pesos',5,2014,'No'),(232,50,5,1700.00,'mil setecientos  pesos',6,2014,'No'),(233,50,6,1700.00,'mil setecientos  pesos',7,2014,'No'),(234,50,7,1700.00,'mil setecientos  pesos',8,2014,'No'),(235,50,8,1700.00,'mil setecientos  pesos',9,2014,'No'),(236,50,9,1700.00,'mil setecientos  pesos',10,2014,'No'),(237,50,10,1700.00,'mil setecientos  pesos',11,2014,'No'),(238,50,11,1700.00,'mil setecientos  pesos',12,2014,'No'),(239,50,12,1700.00,'mil setecientos  pesos',1,2015,'No'),(240,50,13,1700.00,'mil setecientos  pesos',2,2015,'No'),(241,50,14,1700.00,'mil setecientos  pesos',3,2015,'No'),(242,50,15,1700.00,'mil setecientos  pesos',4,2015,'No'),(243,50,16,1700.00,'mil setecientos  pesos',5,2015,'No'),(244,50,17,1700.00,'mil setecientos  pesos',6,2015,'No'),(245,50,18,1700.00,'mil setecientos  pesos',7,2015,'No'),(246,50,19,1700.00,'mil setecientos  pesos',8,2015,'No'),(247,50,20,1700.00,'mil setecientos  pesos',9,2015,'No'),(248,50,21,1700.00,'mil setecientos  pesos',10,2015,'No'),(249,50,22,1700.00,'mil setecientos  pesos',11,2015,'No'),(250,50,23,1700.00,'mil setecientos  pesos',12,2015,'No'),(251,51,0,1500.00,'mil quinientos  pesos',1,2014,'No'),(252,51,1,1500.00,'mil quinientos  pesos',2,2014,'No'),(253,51,2,1500.00,'mil quinientos  pesos',3,2014,'No'),(254,51,3,1500.00,'mil quinientos  pesos',4,2014,'No'),(255,51,4,1500.00,'mil quinientos  pesos',5,2014,'No'),(256,51,5,1500.00,'mil quinientos  pesos',6,2014,'No'),(257,51,6,1500.00,'mil quinientos  pesos',7,2014,'No'),(258,51,7,1500.00,'mil quinientos  pesos',8,2014,'No'),(259,51,8,1500.00,'mil quinientos  pesos',9,2014,'No'),(260,51,9,1500.00,'mil quinientos  pesos',10,2014,'No'),(261,51,10,1500.00,'mil quinientos  pesos',11,2014,'No'),(262,51,11,1500.00,'mil quinientos  pesos',12,2014,'No'),(263,51,12,1500.00,'mil quinientos  pesos',1,2015,'No'),(264,51,13,1500.00,'mil quinientos  pesos',2,2015,'No'),(265,51,14,1500.00,'mil quinientos  pesos',3,2015,'No'),(266,51,15,1500.00,'mil quinientos  pesos',4,2015,'No'),(267,51,16,1500.00,'mil quinientos  pesos',5,2015,'No'),(268,51,17,1500.00,'mil quinientos  pesos',6,2015,'No'),(269,51,18,1500.00,'mil quinientos  pesos',7,2015,'No'),(270,51,19,1500.00,'mil quinientos  pesos',8,2015,'No'),(271,51,20,1500.00,'mil quinientos  pesos',9,2015,'No'),(272,51,21,1500.00,'mil quinientos  pesos',10,2015,'No'),(273,51,22,1500.00,'mil quinientos  pesos',11,2015,'No'),(274,51,23,1500.00,'mil quinientos  pesos',12,2015,'No'),(275,52,0,2500.00,'dos mil quinientos  pesos',1,2014,'No'),(276,52,1,2500.00,'dos mil quinientos  pesos',2,2014,'No'),(277,52,2,2500.00,'dos mil quinientos  pesos',3,2014,'No'),(278,52,3,2500.00,'dos mil quinientos  pesos',4,2014,'No'),(279,52,4,2500.00,'dos mil quinientos  pesos',5,2014,'No'),(280,52,5,2500.00,'dos mil quinientos  pesos',6,2014,'No'),(281,52,6,2500.00,'dos mil quinientos  pesos',7,2014,'No'),(282,52,7,2500.00,'dos mil quinientos  pesos',8,2014,'No'),(283,52,8,2500.00,'dos mil quinientos  pesos',9,2014,'No'),(284,52,9,2500.00,'dos mil quinientos  pesos',10,2014,'No'),(285,52,10,2500.00,'dos mil quinientos  pesos',11,2014,'No'),(286,52,11,2500.00,'dos mil quinientos  pesos',12,2014,'No'),(287,52,12,2500.00,'dos mil quinientos  pesos',1,2015,'No'),(288,52,13,2500.00,'dos mil quinientos  pesos',2,2015,'No'),(289,52,14,2500.00,'dos mil quinientos  pesos',3,2015,'No'),(290,52,15,2500.00,'dos mil quinientos  pesos',4,2015,'No'),(291,52,16,2500.00,'dos mil quinientos  pesos',5,2015,'No'),(292,52,17,2500.00,'dos mil quinientos  pesos',6,2015,'No'),(293,52,18,2500.00,'dos mil quinientos  pesos',7,2015,'No'),(294,52,19,2500.00,'dos mil quinientos  pesos',8,2015,'No'),(295,52,20,2500.00,'dos mil quinientos  pesos',9,2015,'No'),(296,52,21,2500.00,'dos mil quinientos  pesos',10,2015,'No'),(297,52,22,2500.00,'dos mil quinientos  pesos',11,2015,'No'),(298,52,23,2500.00,'dos mil quinientos  pesos',12,2015,'No'),(300,53,2,1.50,'mil quinientos  pesos',2,2014,'Si'),(301,53,3,1.50,'mil quinientos  pesos',3,2014,'Si'),(302,53,4,1500.00,'mil quinientos  pesos',4,2014,'Si'),(303,53,5,1.50,'mil quinientos  pesos',5,2014,'Si'),(304,53,6,1.50,'mil quinientos  pesos',6,2014,'Si'),(305,53,7,1.50,'mil quinientos  pesos',7,2014,'Si'),(306,53,8,2500.00,'dos mil quinientos  pesos',8,2014,'Si'),(307,53,9,1500.00,'mil quinientos  pesos',9,2014,'Si'),(308,53,10,1500.00,'mil quinientos  pesos',10,2014,'Si'),(309,53,11,1500.00,'mil quinientos  pesos',11,2014,'Si'),(310,53,12,1500.00,'mil quinientos  pesos',12,2014,'Si'),(311,53,13,1500.00,'mil quinientos  pesos',1,2015,'Si'),(312,53,14,1500.00,'mil quinientos  pesos',2,2015,'No'),(313,53,15,1500.00,'mil quinientos  pesos',3,2015,'No'),(314,53,16,1500.00,'mil quinientos  pesos',4,2015,'No'),(315,53,17,1500.00,'mil quinientos  pesos',5,2015,'No'),(316,53,18,1500.00,'mil quinientos  pesos',6,2015,'No'),(317,53,19,1500.00,'mil quinientos  pesos',7,2015,'No'),(318,53,20,1500.00,'mil quinientos  pesos',8,2015,'No'),(319,53,21,1500.00,'mil quinientos  pesos',9,2015,'No'),(320,53,22,1500.00,'mil quinientos  pesos',10,2015,'No'),(321,53,23,1500.00,'mil quinientos  pesos',11,2015,'No'),(322,53,24,1500.00,'mil quinientos  pesos',12,2015,'No');
/*!40000 ALTER TABLE `cuota` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `cuota_BUPD` BEFORE UPDATE ON `cuota` FOR EACH ROW
BEGIN
/*
 IF (Select SUM(valor) From imputacion where cuota_id = NEW.id) = new.valor THEN
	SET new.saldada = 'Si';
 else
	SET new.saldada = 'No';
 END IF;
*/
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

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
INSERT INTO `financiacion` VALUES (7,'Monoambiente 1  - SOCIO',1,12014,24,1,1),(8,'Dúplex 1  - ADHERENTE',1,22014,24,2,1),(9,'Monoambiente 1  - ADHERENTE',1,32014,24,1,1),(10,'Dúplex 1  - SOCIO',1,22014,24,2,1);
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
-- Table structure for table `forma_pago_pago`
--

DROP TABLE IF EXISTS `forma_pago_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_pago_pago` (
  `forma_pago_id` int(11) NOT NULL,
  `pago_id` int(11) NOT NULL,
  `valor` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`forma_pago_id`,`pago_id`),
  KEY `fk_forma_pago_has_pago_pago1_idx` (`pago_id`),
  KEY `fk_forma_pago_has_pago_forma_pago1_idx` (`forma_pago_id`),
  CONSTRAINT `fk_forma_pago_has_pago_forma_pago1` FOREIGN KEY (`forma_pago_id`) REFERENCES `forma_pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_forma_pago_has_pago_pago1` FOREIGN KEY (`pago_id`) REFERENCES `pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_pago_pago`
--

LOCK TABLES `forma_pago_pago` WRITE;
/*!40000 ALTER TABLE `forma_pago_pago` DISABLE KEYS */;
INSERT INTO `forma_pago_pago` VALUES (1,12,0.00),(1,14,0.00),(1,15,0.00),(1,16,0.00),(1,21,1.50),(1,22,1.50),(1,23,1.50),(1,24,1.50),(1,25,1.50),(1,26,1.50),(1,27,1.50),(1,28,1.50),(1,29,1.50),(1,30,1.50),(1,31,1.50),(1,35,1.50),(1,36,1.50),(1,37,1.70),(1,38,500.00),(1,39,0.00),(1,40,1500.00),(1,41,1500.00),(1,43,1500.00),(1,44,1500.00),(1,45,1500.00),(1,46,1500.00),(1,47,1500.00),(1,48,1500.00),(2,38,200.00);
/*!40000 ALTER TABLE `forma_pago_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imputacion`
--

DROP TABLE IF EXISTS `imputacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imputacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pago_id` int(11) NOT NULL,
  `valor` decimal(15,2) DEFAULT NULL,
  `cuota_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_couta_has_pago_pago1_idx` (`pago_id`),
  KEY `fk_imputacion_cuota1_idx` (`cuota_id`),
  CONSTRAINT `fk_couta_has_pago_pago1` FOREIGN KEY (`pago_id`) REFERENCES `pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_imputacion_cuota1` FOREIGN KEY (`cuota_id`) REFERENCES `cuota` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imputacion`
--

LOCK TABLES `imputacion` WRITE;
/*!40000 ALTER TABLE `imputacion` DISABLE KEYS */;
INSERT INTO `imputacion` VALUES (1,12,1.50,300),(2,14,1.50,300),(3,15,1500.00,302),(4,16,2500.00,306),(5,21,1500.00,300),(6,22,1500.00,300),(7,23,1500.00,300),(8,24,1500.00,300),(9,25,1500.00,300),(10,26,1500.00,300),(11,27,1500.00,300),(12,28,1500.00,300),(13,29,1500.00,300),(14,30,1500.00,301),(15,31,1500.00,300),(16,35,1500.00,300),(17,36,1500.00,301),(18,37,1700.00,83),(19,38,1700.00,84),(20,39,1500.00,303),(21,40,1500.00,304),(22,41,1500.00,305),(23,43,1500.00,307),(24,44,1500.00,308),(25,45,1500.00,309),(26,46,1500.00,310),(27,47,1500.00,311),(28,48,1500.00,155);
/*!40000 ALTER TABLE `imputacion` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `imputacion_AINS` AFTER INSERT ON `imputacion` FOR EACH ROW
BEGIN
/*
INSERT INTO Log(descripcion,user) values ('imputacion_AINS INICIO',user());
 IF 
	(Select SUM(valor) From imputacion where cuota_id = NEW.cuota_id) 
	= 
	(Select valor From cuota where id = NEW.cuota_id) 
THEN
	update cuota set saldada = 'Si' where id = NEW.cuota_id;
INSERT INTO Log(descripcion,user) values ('imputacion_AINS si',user());
 else
	update cuota set saldada = 'No' where id = NEW.cuota_id;
INSERT INTO Log(descripcion,user) values ('imputacion_AINS no',user());
 END IF;
INSERT INTO Log(descripcion,user) values ('imputacion_AINS fin',user());
*/
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `imputacion_AUPD` AFTER UPDATE ON `imputacion` FOR EACH ROW
BEGIN
/*
INSERT INTO Log(descripcion,user) values ('imputacion_AUPD INICIO',user());
 IF 
	(Select SUM(valor) From imputacion where cuota_id = NEW.cuota_id) 
	= 
	(Select valor From cuota where id = NEW.cuota_id) 
THEN
	update cuota set saldada = 'Si' where id = NEW.cuota_id;
INSERT INTO Log(descripcion,user) values ('imputacion_AUPD si',user());
ELSE
	update cuota set saldada = 'No' where id = NEW.cuota_id;
INSERT INTO Log(descripcion,user) values ('imputacion_AUPD no',user());
 END IF;
INSERT INTO Log(descripcion,user) values ('imputacion_AUPD fin',user());
*/
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `imputacion_ADEL` AFTER DELETE ON `imputacion` FOR EACH ROW
BEGIN
/*
INSERT INTO Log(descripcion,user) values ('imputacion_ADEL INICIO',user());
IF 
	(Select SUM(valor) From imputacion where cuota_id = OLD.cuota_id) 
	= 
	(Select valor From cuota where id = OLD.cuota_id) 
THEN
	update cuota set saldada = 'Si' where id = OLD.cuota_id;
	INSERT INTO Log(descripcion,user) values ('imputacion_ADEL SI',user());
ELSE
	update cuota set saldada = 'No' where id = OLD.cuota_id;
	INSERT INTO Log(descripcion,user) values ('imputacion_ADEL NO',user());
 END IF;
	INSERT INTO Log(descripcion,user) values ('imputacion_ADEL FIN',user());
*/
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `mes`
--

DROP TABLE IF EXISTS `mes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mes` (
  `id` tinyint(4) NOT NULL,
  `mes` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mes`
--

LOCK TABLES `mes` WRITE;
/*!40000 ALTER TABLE `mes` DISABLE KEYS */;
INSERT INTO `mes` VALUES (1,'Enero'),(2,'Febrero'),(3,'Marzo'),(4,'Abril'),(5,'Mayo'),(6,'Junio'),(7,'Julio'),(8,'Agosto'),(9,'Septiembre'),(10,'Octubre'),(11,'Noviembre'),(12,'Diciembre');
/*!40000 ALTER TABLE `mes` ENABLE KEYS */;
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
  `valor` decimal(15,2) DEFAULT NULL,
  `ImporteLetras` varchar(255) NOT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `NroDeposito` varchar(20) DEFAULT NULL,
  `persona_id` int(11) NOT NULL,
  `talonario` char(4) DEFAULT '0001',
  `nro_formulario` char(8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pago_persona1_idx` (`persona_id`),
  CONSTRAINT `fk_pago_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pago`
--

LOCK TABLES `pago` WRITE;
/*!40000 ALTER TABLE `pago` DISABLE KEYS */;
INSERT INTO `pago` VALUES (12,'0000-00-00',1.50,'mil quinientos  pesos','','',12,'0001',NULL),(14,'0000-00-00',1.50,'mil quinientos  pesos','','',12,'0001',NULL),(15,'0000-00-00',1.50,'mil quinientos  pesos','','',12,'0001',NULL),(16,'0000-00-00',2.50,'dos mil quinientos  pesos','','',12,'0001',NULL),(21,'0000-00-00',1.50,'mil quinientos  pesos','','',12,'0001',NULL),(22,'0000-00-00',1.50,'mil quinientos  pesos','','',12,'0001',NULL),(23,'0000-00-00',1.50,'mil quinientos  pesos','','',12,'0001',NULL),(24,'0000-00-00',1.50,'mil quinientos  pesos','','',12,'0001',NULL),(25,'0000-00-00',1.50,'mil quinientos  pesos','','',12,'0001',NULL),(26,'0000-00-00',1.50,'mil quinientos  pesos','','',12,'0001',NULL),(27,'0000-00-00',1.50,'mil quinientos  pesos','','',12,'0001',NULL),(28,'0000-00-00',1.50,'mil quinientos  pesos','','',12,'0001',NULL),(29,'0000-00-00',1.50,'mil quinientos  pesos','','',12,'0001',NULL),(30,'0000-00-00',1.50,'mil quinientos  pesos','','',12,'0001',NULL),(31,'0000-00-00',1.50,'mil quinientos  pesos','','',12,'0001',NULL),(35,'0000-00-00',1.50,'mil quinientos  pesos','','',12,'0001',NULL),(36,'0000-00-00',1.50,'mil quinientos  pesos','','',12,'0001',NULL),(37,'0000-00-00',1.70,'mil setecientos  pesos','','',7,'0001',NULL),(38,'0000-00-00',1.70,'mil setecientos  pesos','','',7,'0001',NULL),(39,'0000-00-00',1500.00,'mil quinientos  pesos','','',12,'0001',NULL),(40,'0000-00-00',1500.00,'mil quinientos  pesos','','',12,'0001',NULL),(41,'0000-00-00',1500.00,'mil quinientos  pesos','','',12,'0001',NULL),(43,'0000-00-00',1500.00,'mil quinientos  pesos','','',12,'0001',NULL),(44,'0000-00-00',1500.00,'mil quinientos  pesos','','',12,'0001',NULL),(45,'0000-00-00',1500.00,'mil quinientos  pesos','','',12,'0001',NULL),(46,'0000-00-00',1500.00,'mil quinientos  pesos','','',12,'0001',NULL),(47,'0000-00-00',1500.00,'mil quinientos  pesos','','',12,'0001',NULL),(48,'0000-00-00',1500.00,'mil quinientos  pesos','','',13,'0001',NULL);
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
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_suscripcion_persona1_idx` (`persona_id`),
  KEY `fk_suscripcion_financiacion1_idx` (`financiacion_id`),
  KEY `fk_suscripcion_estado_adjudicacion1_idx` (`estado_adjudicacion_id`),
  CONSTRAINT `fk_suscripcion_estado_adjudicacion1` FOREIGN KEY (`estado_adjudicacion_id`) REFERENCES `estado_adjudicacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_suscripcion_financiacion1` FOREIGN KEY (`financiacion_id`) REFERENCES `financiacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_suscripcion_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='Suscripción de una Persona en un Plan\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suscripcion`
--

LOCK TABLES `suscripcion` WRITE;
/*!40000 ALTER TABLE `suscripcion` DISABLE KEYS */;
INSERT INTO `suscripcion` VALUES (34,'2014-09-17',NULL,10,NULL,7,'',1,NULL),(43,'2014-09-17',NULL,10,NULL,7,'',1,NULL),(44,'2014-09-17',NULL,7,NULL,10,'',1,NULL),(45,'2014-09-17',NULL,11,NULL,7,'',1,NULL),(46,'2014-09-18',NULL,7,NULL,8,'',1,'2014-09-18 13:44:35'),(47,'2014-09-18',NULL,13,NULL,7,'',1,'2014-09-18 19:54:42'),(48,'2014-09-18',NULL,7,NULL,9,'',1,'2014-09-18 21:42:37'),(49,'2014-09-18',NULL,7,NULL,7,'',1,'2014-09-18 22:23:14'),(50,'2014-09-18',NULL,10,NULL,10,'',1,'2014-09-18 23:11:05'),(51,'2014-09-18',NULL,10,NULL,8,'',1,'2014-09-18 23:11:10'),(52,'2014-09-18',NULL,10,NULL,9,'',1,'2014-09-18 23:11:16'),(53,'2014-09-19',NULL,12,NULL,7,'',1,'2014-09-19 17:06:41');
/*!40000 ALTER TABLE `suscripcion` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `suscripcion_BINS` BEFORE INSERT ON `suscripcion` FOR EACH ROW
BEGIN
	# El tipo de persona de la persona tiene que ser el mismo de la financiacion
	IF (
		(SELECT tipo_persona_id FROM plavisoft.persona WHERE id = NEW.persona_id)
		<>
		(SELECT tipo_persona_id FROM plavisoft.financiacion WHERE id = NEW.financiacion_id)
	) THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Tipo de Persona de Personas y Financiacion son distintos';
	END IF;
	# Comprueba que la persona no tenga una suscripcion de la misma financiacion
	IF EXISTS (
		Select 1 From plavisoft.suscripcion where persona_id = NEW.persona_id and financiacion_id = NEW.financiacion_id
	) THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Existe una suscripción para la Persona y Financiacion dados';
	END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tipo_cuota`
--

DROP TABLE IF EXISTS `tipo_cuota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_cuota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) DEFAULT NULL,
  `valor` decimal(15,2) NOT NULL,
  `ImporteLetras` varchar(255) NOT NULL,
  `financiacion_id` int(11) DEFAULT NULL,
  `tipo_cuota` varchar(45) DEFAULT NULL,
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
INSERT INTO `tipo_cuota` VALUES (4,'M S Cuota especial',5000.00,'Cinco mil pesos',7,'INICIAL'),(5,'M S Cuota',1500.00,'Mil quinientos pesos',7,'MENSUAL'),(6,'M S Cuota Adjudicada',3000.00,'Tres mil',7,'ADJUDICADO'),(7,'M Ad Cuota especial',30000.00,'Treinta mil pesos',9,'INICIAL'),(8,'M Ad Cuota',2500.00,'Mil quinientos pesos',9,'MENSUAL'),(9,'M Ad Cuota Adjudicada',4500.00,'Cuatro Mil quinientos pesos',9,'ADJUDICADO'),(10,'Duplex S Cuota especial',5000.00,'Cinco mil pesos',10,'INICIAL'),(11,'Duplex S Cuota',1700.00,'Mil quinientos pesos',10,'MENSUAL'),(12,'Duplex S Cuota Adjudicada',3000.00,'Tres mil',10,'ADJUDICADO'),(13,'Duplex S Cuota especial',5000.00,'Cinco mil pesos',8,'INICIAL'),(14,'Duplex S Cuota',1500.00,'Mil quinientos pesos',8,'MENSUAL'),(15,'Duplex S Cuota Adjudicada',3000.00,'Tres mil',8,'ADJUDICADO');
/*!40000 ALTER TABLE `tipo_cuota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_persona`
--

DROP TABLE IF EXISTS `tipo_persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
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
  `Valor` decimal(15,2) DEFAULT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `MtrosCubiertos` int(11) DEFAULT NULL,
  `MtrosDescubiertos` int(11) DEFAULT NULL,
  `CantHabitaciones` int(11) DEFAULT NULL,
  `CantPisos` int(11) DEFAULT NULL,
  `SobreCalle` tinyint(1) DEFAULT NULL,
  `Fotos` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_vivienda`
--

LOCK TABLES `tipo_vivienda` WRITE;
/*!40000 ALTER TABLE `tipo_vivienda` DISABLE KEYS */;
INSERT INTO `tipo_vivienda` VALUES (1,'Dúplex 1 Ambiente',NULL,'Tipo A',40,12,1,2,NULL,''),(2,'Tipo B',NULL,'Tipo B',NULL,NULL,NULL,NULL,NULL,''),(3,'Tipo C',NULL,'Tipo C',NULL,NULL,NULL,NULL,NULL,'');
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

-- Dump completed on 2014-09-29 20:19:23
