-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: Recettes_DB
-- ------------------------------------------------------
-- Server version	5.5.5-10.6.12-MariaDB-0ubuntu0.22.04.1

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
-- Table structure for table `Categorie`
--

DROP TABLE IF EXISTS `Categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Categorie` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categorie`
--

LOCK TABLES `Categorie` WRITE;
/*!40000 ALTER TABLE `Categorie` DISABLE KEYS */;
INSERT INTO `Categorie` VALUES (1,'Viande'),(2,'Poisson'),(3,'Burger'),(4,'Entrée'),(5,'Dessert'),(6,'plat principal');
/*!40000 ALTER TABLE `Categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Etape`
--

DROP TABLE IF EXISTS `Etape`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Etape` (
  `idEtape` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `idRecette` int(11) NOT NULL,
  PRIMARY KEY (`idEtape`),
  KEY `Etape_FK` (`idRecette`),
  CONSTRAINT `Etape_FK` FOREIGN KEY (`idRecette`) REFERENCES `Recette` (`idRecette`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Etape`
--

LOCK TABLES `Etape` WRITE;
/*!40000 ALTER TABLE `Etape` DISABLE KEYS */;
INSERT INTO `Etape` VALUES (31,'Faire cuire le chocolat, ajouter les oeuf mélanger ect...',32),(32,'Faire cuire le steak',33);
/*!40000 ALTER TABLE `Etape` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ingredient`
--

DROP TABLE IF EXISTS `Ingredient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Ingredient` (
  `idIngredient` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`idIngredient`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ingredient`
--

LOCK TABLES `Ingredient` WRITE;
/*!40000 ALTER TABLE `Ingredient` DISABLE KEYS */;
INSERT INTO `Ingredient` VALUES (1,'farine'),(2,'sucre'),(3,'sel'),(4,'oeufs'),(5,'entrecote'),(6,'saumon'),(7,'boeuf'),(8,'huile'),(9,'lait'),(10,'salade'),(11,'tomate'),(12,'oignon'),(13,'ail'),(14,'levure'),(15,'chocolat'),(16,'pates');
/*!40000 ALTER TABLE `Ingredient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Recette`
--

DROP TABLE IF EXISTS `Recette`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Recette` (
  `idRecette` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `tempsCuisson` time NOT NULL,
  `cheminPhoto` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`idRecette`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Recette`
--

LOCK TABLES `Recette` WRITE;
/*!40000 ALTER TABLE `Recette` DISABLE KEYS */;
INSERT INTO `Recette` VALUES (32,'Gateau chocolat','00:30:00','bg36555e600eca25.jpg'),(33,'Burger','01:40:00','bg16555e644ca5c7.jpg');
/*!40000 ALTER TABLE `Recette` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RecetteCategorie`
--

DROP TABLE IF EXISTS `RecetteCategorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RecetteCategorie` (
  `idRecette` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  KEY `RecetteCategorie_FK_1` (`idCategorie`),
  KEY `RecetteCategorie_FK` (`idRecette`),
  CONSTRAINT `RecetteCategorie_FK` FOREIGN KEY (`idRecette`) REFERENCES `Recette` (`idRecette`),
  CONSTRAINT `RecetteCategorie_FK_1` FOREIGN KEY (`idCategorie`) REFERENCES `Categorie` (`idCategorie`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RecetteCategorie`
--

LOCK TABLES `RecetteCategorie` WRITE;
/*!40000 ALTER TABLE `RecetteCategorie` DISABLE KEYS */;
INSERT INTO `RecetteCategorie` VALUES (32,5),(33,1),(33,3),(33,6);
/*!40000 ALTER TABLE `RecetteCategorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RecetteIngredient`
--

DROP TABLE IF EXISTS `RecetteIngredient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RecetteIngredient` (
  `idRecette` int(11) NOT NULL,
  `idIngredient` int(11) NOT NULL,
  PRIMARY KEY (`idRecette`,`idIngredient`),
  KEY `RecetteIngredient_FK` (`idIngredient`),
  CONSTRAINT `RecetteIngredient_FK` FOREIGN KEY (`idIngredient`) REFERENCES `Ingredient` (`idIngredient`),
  CONSTRAINT `RecetteIngredient_FK_1` FOREIGN KEY (`idRecette`) REFERENCES `Recette` (`idRecette`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RecetteIngredient`
--

LOCK TABLES `RecetteIngredient` WRITE;
/*!40000 ALTER TABLE `RecetteIngredient` DISABLE KEYS */;
INSERT INTO `RecetteIngredient` VALUES (32,1),(32,2),(32,4),(32,8),(32,9),(32,14),(32,15),(33,1),(33,2),(33,3),(33,7),(33,10),(33,11),(33,12),(33,14),(33,15);
/*!40000 ALTER TABLE `RecetteIngredient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'Recettes_DB'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-16 10:53:07
