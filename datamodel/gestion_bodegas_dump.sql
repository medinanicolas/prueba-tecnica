-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: gestion_bodegas
-- ------------------------------------------------------
-- Server version	8.0.22-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `gestion_bodegas`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `gestion_bodegas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `gestion_bodegas`;

--
-- Table structure for table `bodega`
--

DROP TABLE IF EXISTS `bodega`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bodega` (
  `id_bodega` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre_bodega` varchar(60) NOT NULL,
  `direccion_bodega` varchar(100) NOT NULL,
  PRIMARY KEY (`id_bodega`),
  UNIQUE KEY `nombre_bodega` (`nombre_bodega`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bodega`
--

LOCK TABLES `bodega` WRITE;
/*!40000 ALTER TABLE `bodega` DISABLE KEYS */;
INSERT INTO `bodega` VALUES (100,'Bodega #1','Bodega #1');
/*!40000 ALTER TABLE `bodega` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id_categoria` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(60) NOT NULL,
  PRIMARY KEY (`id_categoria`),
  UNIQUE KEY `nombre_categoria` (`nombre_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (100,'TECNOLOGIA');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marca` (
  `id_marca` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre_marca` varchar(60) NOT NULL,
  PRIMARY KEY (`id_marca`),
  UNIQUE KEY `nombre_marca` (`nombre_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca`
--

LOCK TABLES `marca` WRITE;
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
INSERT INTO `marca` VALUES (101,'APPLE'),(100,'NIKE');
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `id_producto` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(60) NOT NULL,
  `precio_producto` int unsigned NOT NULL,
  `descripcion_producto` varchar(200) NOT NULL,
  `stock_producto` int unsigned NOT NULL,
  `id_marca` int unsigned NOT NULL,
  `id_categoria` int unsigned NOT NULL,
  `id_bodega` int unsigned NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_marca` (`id_marca`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_bodega` (`id_bodega`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`),
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`id_bodega`) REFERENCES `bodega` (`id_bodega`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (100,'iPAD',99999999,'Tableta ligera y de alto rendimiento',2730,101,100,100);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro_entrega`
--

DROP TABLE IF EXISTS `registro_entrega`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registro_entrega` (
  `id_registro` int unsigned NOT NULL AUTO_INCREMENT,
  `id_producto` int unsigned NOT NULL,
  `stock_antes` int unsigned NOT NULL,
  `stock_saliente` int unsigned NOT NULL,
  `stock_despues` int unsigned NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_registro`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `registro_entrega_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro_entrega`
--

LOCK TABLES `registro_entrega` WRITE;
/*!40000 ALTER TABLE `registro_entrega` DISABLE KEYS */;
INSERT INTO `registro_entrega` VALUES (104,100,2710,10,2720,'2021-01-09 20:33:48'),(105,100,2720,10,2730,'2021-01-09 21:49:55'),(106,100,2730,30,2700,'2021-01-09 21:50:08');
/*!40000 ALTER TABLE `registro_entrega` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro_stock`
--

DROP TABLE IF EXISTS `registro_stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registro_stock` (
  `id_registro` int unsigned NOT NULL AUTO_INCREMENT,
  `id_producto` int unsigned NOT NULL,
  `stock_antes` int unsigned NOT NULL,
  `stock_entrante` int unsigned NOT NULL,
  `stock_despues` int unsigned NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_registro`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `registro_stock_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro_stock`
--

LOCK TABLES `registro_stock` WRITE;
/*!40000 ALTER TABLE `registro_stock` DISABLE KEYS */;
INSERT INTO `registro_stock` VALUES (100,100,2700,30,2730,'2021-01-09 21:54:23');
/*!40000 ALTER TABLE `registro_stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre_tipo_usuario` varchar(15) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`),
  UNIQUE KEY `nombre_tipo_usuario` (`nombre_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (102,'Administrador');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `rut_usuario` varchar(8) NOT NULL,
  `dv_usuario` char(1) NOT NULL,
  `alias_usuario` varchar(25) NOT NULL,
  `password_usuario` varchar(32) NOT NULL,
  `nombre_usuario` varchar(25) NOT NULL,
  `p_apellido_usuario` varchar(25) NOT NULL,
  `s_apellido_usuario` varchar(25) DEFAULT NULL,
  `id_tipo_usuario` int unsigned NOT NULL,
  PRIMARY KEY (`rut_usuario`),
  UNIQUE KEY `alias_usuario` (`alias_usuario`),
  KEY `id_tipo_usuario` (`id_tipo_usuario`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('11111111','1','admin','5f4dcc3b5aa765d61d8327deb882cf99','Admin','Admin',NULL,102);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-09 18:55:02
