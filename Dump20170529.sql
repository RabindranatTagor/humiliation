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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `INN` bigint(10) NOT NULL,
  `KPP` bigint(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'ООО «ТюменьМегаСтрой»',7203346790,720301001),(2,'ООО «РЕГИОНЗНАК»  ',326519916,32601001),(3,'ОАО «Тюменьоблснабсбыт» ',7202007851,720201001),(4,'ЗАО «Массивстрой» ',7203053667,720201001),(5,'ЗАО «2МЕН ГРУПП девелопмент»',7701651356,720401001),(6,'ООО КА «Пионер»',7202194055,720201001),(7,'ООО «Лавада» ',7202131270,720201001),(8,'ООО «Афганец Плюс»',8905053123,890501001),(9,'ООО «Магистраль» ',720334466,720301001),(10,'ООО «АТЭК»  ',7002016873,700201001),(11,'ООО «АрктикСтройМост»',8904066627,891450001);
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
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL COMMENT '//what we buy and sell',
  `quantity` float DEFAULT NULL,
  PRIMARY KEY (`idmaterials`),
  UNIQUE KEY `materials_name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materials`
--

LOCK TABLES `materials` WRITE;
/*!40000 ALTER TABLE `materials` DISABLE KEYS */;
INSERT INTO `materials` VALUES (1,'Маска квадратная синяя',90,90),(2,'Маска треугольная белая',90,96),(3,'Маска круглая синяя',90,91),(4,'Труба стальная d53мм l1м',390,90),(5,'Труба стальная d76мм д1м',470,100),(6,'Лист стальной оцинкованный',10000,92),(7,'Хомут для крепления',50,100);
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
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `masks` int(11) DEFAULT NULL,
  PRIMARY KEY (`idroad_signs_catalog`),
  UNIQUE KEY `road_signs_catalog_name_UNIQUE` (`name`),
  KEY `FK_masks_idx` (`masks`),
  CONSTRAINT `FK_masks` FOREIGN KEY (`masks`) REFERENCES `materials` (`idmaterials`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `road_signs_catalog`
--

LOCK TABLES `road_signs_catalog` WRITE;
/*!40000 ALTER TABLE `road_signs_catalog` DISABLE KEYS */;
INSERT INTO `road_signs_catalog` VALUES (1,'Знак дорожный 6.4 \"Парковка\"',1000,1),(2,'Знак дорожный 2.7 \"Преимущество перед встречным движением\"',1000,1),(3,'Знак дорожный 2.4 \"Уступите дорогу\"',790,2),(4,'Знак дорожный 4.8.1 \"Направление движения транспортных средств с опасным грузом\"',1600,NULL),(5,'Знак дорожный 5.8 \"Реверсивное движение\"',1200,1),(7,'Знак дорожный 5.15.1 \"Направление движения по полосам\"',1200,NULL);
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
  `name` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `customer` int(11) NOT NULL,
  `sum` float NOT NULL COMMENT '//zdes dolzhen byt'' SUM poziciy is "sostav_zakaza", sovpadauischikh po id_zakaza',
  PRIMARY KEY (`idzakaz`),
  UNIQUE KEY `zakaz_name_UNIQUE` (`name`),
  KEY `FK_customer_idx` (`customer`),
  CONSTRAINT `customer_id` FOREIGN KEY (`customer`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zakaz`
--

LOCK TABLES `zakaz` WRITE;
/*!40000 ALTER TABLE `zakaz` DISABLE KEYS */;
INSERT INTO `zakaz` VALUES (1,'Т-1-16','2002-02-20',1,45000),(2,'Т-2-16','2003-03-20',1,105600),(3,'Т-3-16','2003-03-20',2,0),(8,'Т-5-16','2017-03-01',4,7180),(10,'Т-4-16','2017-03-01',4,7180),(11,'Т-6-16','2017-03-01',3,30090),(12,'Т-7-16','2017-03-01',6,2670),(13,'Т-8-16','2017-03-01',5,1530),(14,'Т-9-16','2017-03-01',5,630),(15,'Т-10-16','2017-03-14',5,450),(16,'Т-12-16','2017-03-15',2,360),(17,'Т-11-16','2017-03-15',2,360);
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
  `idzakaza` int(11) NOT NULL,
  `id_road_signs` int(11) unsigned zerofill DEFAULT NULL,
  `id_materials` int(11) unsigned zerofill DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`idzakaz_contents`),
  KEY `FK_zakaz_idx` (`idzakaza`),
  KEY `FK_road_sign_idx` (`id_road_signs`),
  KEY `FK_materials_idx` (`id_materials`),
  CONSTRAINT `FK_zakaz` FOREIGN KEY (`idzakaza`) REFERENCES `zakaz` (`idzakaz`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zakaz_contents`
--

LOCK TABLES `zakaz_contents` WRITE;
/*!40000 ALTER TABLE `zakaz_contents` DISABLE KEYS */;
INSERT INTO `zakaz_contents` VALUES (1,1,00000000001,NULL,3),(2,1,00000000002,NULL,2),(3,1,NULL,00000000006,4),(4,2,00000000004,NULL,6),(5,14,NULL,00000000003,3),(6,14,NULL,00000000007,4),(7,15,NULL,00000000003,5),(8,16,NULL,00000000003,4),(9,17,NULL,00000000002,4);
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

-- Dump completed on 2017-05-29 17:37:51
