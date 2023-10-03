CREATE DATABASE  IF NOT EXISTS `ceumh` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ceumh`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 74.208.191.226    Database: ceumh
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acceso_admin`
--

DROP TABLE IF EXISTS `acceso_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acceso_admin` (
  `id_Admin` int NOT NULL,
  `password` varchar(16) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_Admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acceso_admin`
--

LOCK TABLES `acceso_admin` WRITE;
/*!40000 ALTER TABLE `acceso_admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `acceso_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acceso_alumno`
--

DROP TABLE IF EXISTS `acceso_alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acceso_alumno` (
  `id_Alumno` int NOT NULL,
  `password` varchar(16) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_Alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acceso_alumno`
--

LOCK TABLES `acceso_alumno` WRITE;
/*!40000 ALTER TABLE `acceso_alumno` DISABLE KEYS */;
INSERT INTO `acceso_alumno` VALUES (354481,'1234');
/*!40000 ALTER TABLE `acceso_alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acceso_docente`
--

DROP TABLE IF EXISTS `acceso_docente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acceso_docente` (
  `id_Docente` int NOT NULL,
  `password` varchar(16) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_Docente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acceso_docente`
--

LOCK TABLES `acceso_docente` WRITE;
/*!40000 ALTER TABLE `acceso_docente` DISABLE KEYS */;
INSERT INTO `acceso_docente` VALUES (420957,'9399');
/*!40000 ALTER TABLE `acceso_docente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrativo`
--

DROP TABLE IF EXISTS `administrativo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrativo` (
  `id_Admin` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido_Pat` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido_Mat` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `activo` tinyint NOT NULL DEFAULT '1',
  `top_Level_Acc` tinyint NOT NULL DEFAULT '0',
  `fecha_Ingreso` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_Admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrativo`
--

LOCK TABLES `administrativo` WRITE;
/*!40000 ALTER TABLE `administrativo` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrativo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno_materia`
--

DROP TABLE IF EXISTS `alumno_materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumno_materia` (
  `id_Alum_Materia` int NOT NULL AUTO_INCREMENT,
  `id_Alumno` int NOT NULL,
  `id_Materia` int NOT NULL,
  PRIMARY KEY (`id_Alum_Materia`),
  KEY `FK__alumnos` (`id_Alumno`),
  KEY `FK_alumno_materia_materia` (`id_Materia`),
  CONSTRAINT `FK__alumnos` FOREIGN KEY (`id_Alumno`) REFERENCES `alumnos` (`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_alumno_materia_materia` FOREIGN KEY (`id_Materia`) REFERENCES `materia` (`id_Materia`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_materia`
--

LOCK TABLES `alumno_materia` WRITE;
/*!40000 ALTER TABLE `alumno_materia` DISABLE KEYS */;
INSERT INTO `alumno_materia` VALUES (1,354481,1),(2,354481,2);
/*!40000 ALTER TABLE `alumno_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno_materia_calif_cuatri`
--

DROP TABLE IF EXISTS `alumno_materia_calif_cuatri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumno_materia_calif_cuatri` (
  `id_Alum_Mat_Calif` int NOT NULL AUTO_INCREMENT,
  `id_Alumno_Materia` int NOT NULL,
  `parcial` int NOT NULL,
  `calificacion` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_Alum_Mat_Calif`),
  KEY `FK__alumno_materia` (`id_Alumno_Materia`),
  CONSTRAINT `FK__alumno_materia` FOREIGN KEY (`id_Alumno_Materia`) REFERENCES `alumno_materia` (`id_Alum_Materia`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_materia_calif_cuatri`
--

LOCK TABLES `alumno_materia_calif_cuatri` WRITE;
/*!40000 ALTER TABLE `alumno_materia_calif_cuatri` DISABLE KEYS */;
INSERT INTO `alumno_materia_calif_cuatri` VALUES (1,1,1,5),(2,1,2,5),(3,1,3,10),(4,2,1,8);
/*!40000 ALTER TABLE `alumno_materia_calif_cuatri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno_materia_final`
--

DROP TABLE IF EXISTS `alumno_materia_final`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumno_materia_final` (
  `id_Alum_Mat_Final` int NOT NULL AUTO_INCREMENT,
  `id_Alumno_Materia` int NOT NULL,
  `calificacion` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_Alum_Mat_Final`),
  KEY `FK_alumno_materia_final_alumno_materia` (`id_Alumno_Materia`),
  CONSTRAINT `FK_alumno_materia_final_alumno_materia` FOREIGN KEY (`id_Alumno_Materia`) REFERENCES `alumno_materia` (`id_Alum_Materia`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_materia_final`
--

LOCK TABLES `alumno_materia_final` WRITE;
/*!40000 ALTER TABLE `alumno_materia_final` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumno_materia_final` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumnos` (
  `id_alumno` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido_Pat` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido_Mat` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nivel_Educativo` enum('Secundaria','Preparatoria','Universidad','Posgrado') COLLATE utf8mb4_spanish_ci NOT NULL,
  `carrera` int DEFAULT NULL,
  `cuatrimestre` int NOT NULL,
  `grupo` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `activo` tinyint NOT NULL DEFAULT '1',
  `fecha_Ingreso` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_alumno`),
  KEY `FK_alumnos_carrera` (`carrera`),
  CONSTRAINT `FK_alumnos_carrera` FOREIGN KEY (`carrera`) REFERENCES `carrera` (`id_Carrera`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=354482 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos`
--

LOCK TABLES `alumnos` WRITE;
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
INSERT INTO `alumnos` VALUES (354481,'Gamaliel Abejito','Rios','Serrano','Universidad',NULL,9,'4',1,'2023-08-16 02:08:46');
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrera`
--

DROP TABLE IF EXISTS `carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrera` (
  `id_Carrera` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `cant_Cuatri` int NOT NULL,
  `cant_Materia` int NOT NULL,
  PRIMARY KEY (`id_Carrera`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrera`
--

LOCK TABLES `carrera` WRITE;
/*!40000 ALTER TABLE `carrera` DISABLE KEYS */;
INSERT INTO `carrera` VALUES (1,'Ciencias Computacionales',9,52);
/*!40000 ALTER TABLE `carrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docentes`
--

DROP TABLE IF EXISTS `docentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `docentes` (
  `id_Docente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido_Pat` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido_Mat` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `activo` tinyint NOT NULL DEFAULT '1',
  `horas_Por_Dia` int DEFAULT NULL,
  `fecha_Ingreso` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_Docente`)
) ENGINE=InnoDB AUTO_INCREMENT=420958 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docentes`
--

LOCK TABLES `docentes` WRITE;
/*!40000 ALTER TABLE `docentes` DISABLE KEYS */;
INSERT INTO `docentes` VALUES (420957,'Oscar Abejito','Morales','Cruz',1,5,'2023-09-28 20:07:25');
/*!40000 ALTER TABLE `docentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarios`
--

DROP TABLE IF EXISTS `horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horarios` (
  `id_Horario` int NOT NULL AUTO_INCREMENT,
  `id_Materia` int NOT NULL,
  `dia_Semana` enum('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado') COLLATE utf8mb4_spanish_ci NOT NULL,
  `horario` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_Horario`),
  KEY `FK_horarios_materia` (`id_Materia`),
  CONSTRAINT `FK_horarios_materia` FOREIGN KEY (`id_Materia`) REFERENCES `materia` (`id_Materia`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materia` (
  `id_Materia` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nivel_Educativo` enum('Secundaria','Preparatoria','Universidad','Posgrado') COLLATE utf8mb4_spanish_ci NOT NULL,
  `carrera` int DEFAULT NULL,
  `cuatrimestre` int NOT NULL,
  `creditos` float NOT NULL,
  PRIMARY KEY (`id_Materia`),
  KEY `FK_materia_carrera` (`carrera`),
  CONSTRAINT `FK_materia_carrera` FOREIGN KEY (`carrera`) REFERENCES `carrera` (`id_Carrera`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES (1,'Artes malignas II','Universidad',1,6,5.5),(2,'Programación Orientada a Objetos','Universidad',1,3,6.1);
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia_docente`
--

DROP TABLE IF EXISTS `materia_docente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materia_docente` (
  `id_Mat_Doc` int NOT NULL AUTO_INCREMENT,
  `id_Materia` int NOT NULL,
  `id_Docente` int NOT NULL,
  PRIMARY KEY (`id_Mat_Doc`),
  KEY `FK__materia` (`id_Materia`),
  KEY `FK_materia_docente_docentes` (`id_Docente`),
  CONSTRAINT `FK__materia` FOREIGN KEY (`id_Materia`) REFERENCES `materia` (`id_Materia`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_materia_docente_docentes` FOREIGN KEY (`id_Docente`) REFERENCES `docentes` (`id_Docente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia_docente`
--

LOCK TABLES `materia_docente` WRITE;
/*!40000 ALTER TABLE `materia_docente` DISABLE KEYS */;
INSERT INTO `materia_docente` VALUES (1,1,420957),(3,2,420957);
/*!40000 ALTER TABLE `materia_docente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ceumh'
--

--
-- Dumping routines for database 'ceumh'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-02 20:25:02
