-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: road_signs
-- ------------------------------------------------------
-- Server version	5.1.73-community

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
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `idcustomers` int(11) NOT NULL AUTO_INCREMENT,
  `customers_name` varchar(255) NOT NULL,
  `customers_INN` bigint(10) NOT NULL,
  `customers_KPP` bigint(9) NOT NULL,
  PRIMARY KEY (`idcustomers`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'GAY TEST',7200256400,310020091),(2,'TRUE GAY TEST',7256891841,859073891),(3,'ULTIMATE GAY TEST',3847049847,864397643);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materials`
--

DROP TABLE IF EXISTS `materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materials` (
  `idmaterials` int(11) NOT NULL AUTO_INCREMENT,
  `materials_name` varchar(255) NOT NULL,
  `materials_price` float NOT NULL COMMENT '//what we buy and sell',
  `materials_quantity` float DEFAULT NULL,
  PRIMARY KEY (`idmaterials`),
  UNIQUE KEY `materials_name_UNIQUE` (`materials_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materials`
--

LOCK TABLES `materials` WRITE;
/*!40000 ALTER TABLE `materials` DISABLE KEYS */;
INSERT INTO `materials` VALUES (1,'SQUARE BLUE MASK',90,100),(2,'TRIANGLE WHITE MASK',90,100),(3,'ROUND BLUE MASK',90,100),(4,'PIPES 53MM',390,100),(5,'PIPES 76MM',470,100),(6,'BALLS OF STEEL',10000,100);
/*!40000 ALTER TABLE `materials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `road_signs_catalog`
--

DROP TABLE IF EXISTS `road_signs_catalog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `road_signs_catalog` (
  `idroad_signs_catalog` int(11) NOT NULL AUTO_INCREMENT,
  `road_signs_catalog_name` varchar(45) NOT NULL,
  `road_signs_catalog_price` float NOT NULL,
  `road_signs_catalog_masks` int(11) DEFAULT NULL,
  PRIMARY KEY (`idroad_signs_catalog`),
  UNIQUE KEY `road_signs_catalog_name_UNIQUE` (`road_signs_catalog_name`),
  KEY `FK_masks_idx` (`road_signs_catalog_masks`),
  CONSTRAINT `FK_masks` FOREIGN KEY (`road_signs_catalog_masks`) REFERENCES `materials` (`idmaterials`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `road_signs_catalog`
--

LOCK TABLES `road_signs_catalog` WRITE;
/*!40000 ALTER TABLE `road_signs_catalog` DISABLE KEYS */;
INSERT INTO `road_signs_catalog` VALUES (1,'SQUARE BLUE SIGN 1',1000,1),(2,'SQUARE BLUE SIGN 2',1000,1),(3,'TRAINGLE WHITE SIGN',790,2),(4,'RECTANGLE RED SIGN',1600,NULL);
/*!40000 ALTER TABLE `road_signs_catalog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zakaz`
--

DROP TABLE IF EXISTS `zakaz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zakaz` (
  `idzakaz` int(11) NOT NULL AUTO_INCREMENT,
  `zakaz_name` varchar(45) NOT NULL,
  `zakaz_date` date NOT NULL,
  `zakaz_customer` int(11) NOT NULL,
  `zakaz_sum` float NOT NULL COMMENT '//zdes dolzhen byt'' SUM poziciy is "sostav_zakaza", sovpadauischikh po id_zakaza',
  PRIMARY KEY (`idzakaz`),
  UNIQUE KEY `zakaz_name_UNIQUE` (`zakaz_name`),
  KEY `FK_customer_idx` (`zakaz_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zakaz`
--

LOCK TABLES `zakaz` WRITE;
/*!40000 ALTER TABLE `zakaz` DISABLE KEYS */;
INSERT INTO `zakaz` VALUES (1,'Т-1-16','2002-02-20',1,225000),(2,'Т-2-16','2003-03-20',1,48000),(3,'Т-3-16','2003-03-20',2,0);
/*!40000 ALTER TABLE `zakaz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zakaz_contents`
--

DROP TABLE IF EXISTS `zakaz_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zakaz_contents` (
  `idzakaz_contents` int(11) NOT NULL AUTO_INCREMENT,
  `zakaz_contents_idzakaza` int(11) NOT NULL,
  `zakaz_contents_id_road_signs` int(11) unsigned zerofill DEFAULT NULL,
  `zakaz_contents_id_materials` int(11) unsigned zerofill DEFAULT NULL,
  `zakaz_contents_quantity` int(11) NOT NULL,
  PRIMARY KEY (`idzakaz_contents`),
  KEY `FK_zakaz_idx` (`zakaz_contents_idzakaza`),
  KEY `FK_road_sign_idx` (`zakaz_contents_id_road_signs`),
  KEY `FK_materials_idx` (`zakaz_contents_id_materials`),
  CONSTRAINT `FK_zakaz` FOREIGN KEY (`zakaz_contents_idzakaza`) REFERENCES `zakaz` (`idzakaz`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zakaz_contents`
--

LOCK TABLES `zakaz_contents` WRITE;
/*!40000 ALTER TABLE `zakaz_contents` DISABLE KEYS */;
INSERT INTO `zakaz_contents` VALUES (1,1,00000000001,NULL,3),(2,1,00000000002,NULL,2),(3,1,NULL,00000000006,4),(4,2,00000000004,NULL,6);
/*!40000 ALTER TABLE `zakaz_contents` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-05 20:26:07
