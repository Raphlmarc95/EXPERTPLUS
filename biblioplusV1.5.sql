-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: biblioplus
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.16.04.1

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
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorie` (
  `idcategorie` int(11) NOT NULL AUTO_INCREMENT,
  `idouvrage` int(11) DEFAULT NULL,
  `nomCategorie` varchar(15) NOT NULL,
  PRIMARY KEY (`idcategorie`,`nomCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `edition`
--

DROP TABLE IF EXISTS `edition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `edition` (
  `idedition` int(11) NOT NULL AUTO_INCREMENT,
  `idouvrage` int(11) DEFAULT NULL,
  `nomEdition` varchar(15) DEFAULT NULL,
  `periodeEdition` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idedition`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edition`
--

LOCK TABLES `edition` WRITE;
/*!40000 ALTER TABLE `edition` DISABLE KEYS */;
/*!40000 ALTER TABLE `edition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evenement` (
  `photo` varchar(100) DEFAULT NULL,
  `titre` varchar(100) NOT NULL,
  `idevenement` int(11) NOT NULL AUTO_INCREMENT,
  `idmembre` int(11) DEFAULT NULL,
  `lieuEvenement` text,
  `description` text,
  `date_creation` date NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `activite` int(11) DEFAULT '0',
  `prix` int(11) NOT NULL DEFAULT '0',
  `point_de_vente` varchar(255) NOT NULL,
  PRIMARY KEY (`idevenement`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evenement`
--

LOCK TABLES `evenement` WRITE;
/*!40000 ALTER TABLE `evenement` DISABLE KEYS */;
/*!40000 ALTER TABLE `evenement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `f_categorie`
--

DROP TABLE IF EXISTS `f_categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `f_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu_c` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `f_categorie`
--

LOCK TABLES `f_categorie` WRITE;
/*!40000 ALTER TABLE `f_categorie` DISABLE KEYS */;
INSERT INTO `f_categorie` VALUES (9,'Roman'),(10,'Histoire'),(11,'Religions'),(12,'Sciences');
/*!40000 ALTER TABLE `f_categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `f_messages`
--

DROP TABLE IF EXISTS `f_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `f_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sujet` int(11) DEFAULT NULL,
  `idmembre` int(11) NOT NULL,
  `date_hres_edition` datetime DEFAULT NULL,
  `contenu_m` text,
  `pseudo_poster` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `msg_sujet` (`id_sujet`),
  KEY `msg_membre` (`idmembre`),
  CONSTRAINT `msg_membre` FOREIGN KEY (`idmembre`) REFERENCES `membre` (`idmembre`),
  CONSTRAINT `msg_sujet` FOREIGN KEY (`id_sujet`) REFERENCES `f_sujets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `f_messages`
--

LOCK TABLES `f_messages` WRITE;
/*!40000 ALTER TABLE `f_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `f_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `f_sujets`
--

DROP TABLE IF EXISTS `f_sujets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `f_sujets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idmembre` int(11) DEFAULT NULL,
  `id_categorie` int(11) NOT NULL,
  `contenu_s` text,
  `sujet` varchar(255) DEFAULT NULL,
  `date_hres_creation` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sujet_membre` (`idmembre`),
  KEY `sujet_categories` (`id_categorie`),
  CONSTRAINT `sujet_categories` FOREIGN KEY (`id_categorie`) REFERENCES `f_categorie` (`id`),
  CONSTRAINT `sujet_membre` FOREIGN KEY (`idmembre`) REFERENCES `membre` (`idmembre`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `f_sujets`
--

LOCK TABLES `f_sujets` WRITE;
/*!40000 ALTER TABLE `f_sujets` DISABLE KEYS */;
/*!40000 ALTER TABLE `f_sujets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscription` (
  `idinscription` int(11) NOT NULL AUTO_INCREMENT,
  `nom_prenom` varchar(50) DEFAULT NULL,
  `sexe` varchar(10) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `pseudo` varchar(15) DEFAULT NULL,
  `mot_de_passe` varchar(90) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `description` text NOT NULL,
  `token_confirmed` datetime DEFAULT NULL,
  `confirm_token` varchar(90) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idinscription`),
  UNIQUE KEY `pseudo_UNIQUE` (`pseudo`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `idinscription` (`idinscription`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscription`
--

LOCK TABLES `inscription` WRITE;
/*!40000 ALTER TABLE `inscription` DISABLE KEYS */;
/*!40000 ALTER TABLE `inscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `l_categories`
--

DROP TABLE IF EXISTS `l_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `l_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_nom` varchar(70) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `l_categories`
--

LOCK TABLES `l_categories` WRITE;
/*!40000 ALTER TABLE `l_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `l_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lecture`
--

DROP TABLE IF EXISTS `lecture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lecture` (
  `idlecture` int(11) NOT NULL AUTO_INCREMENT,
  `idouvrage` int(11) DEFAULT NULL,
  `idmembre` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`idlecture`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lecture`
--

LOCK TABLES `lecture` WRITE;
/*!40000 ALTER TABLE `lecture` DISABLE KEYS */;
/*!40000 ALTER TABLE `lecture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `idlke` int(11) NOT NULL AUTO_INCREMENT,
  `idevenement` int(11) NOT NULL,
  `nombre` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idlke`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membre`
--

DROP TABLE IF EXISTS `membre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membre` (
  `idmembre` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(100) DEFAULT NULL,
  `pseudo` varchar(30) DEFAULT NULL,
  `mot_de_passe` varchar(90) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `reset_token_at` datetime DEFAULT NULL,
  `reset_token` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`idmembre`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membre`
--

LOCK TABLES `membre` WRITE;
/*!40000 ALTER TABLE `membre` DISABLE KEYS */;
/*!40000 ALTER TABLE `membre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `idNotification` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(150) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idNotification`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ouvrage`
--

DROP TABLE IF EXISTS `ouvrage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ouvrage` (
  `idouvrage` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(40) NOT NULL,
  `isbn` varchar(25) NOT NULL,
  `edition` varchar(40) NOT NULL,
  `pages` int(11) NOT NULL,
  `point_de_vente` text,
  `description` text,
  `images` varchar(90) NOT NULL,
  `livre_path` varchar(90) NOT NULL,
  `date_a_jour` datetime NOT NULL,
  `id_membre` int(11) NOT NULL,
  `id_l_cat` int(11) NOT NULL,
  `langue` varchar(40) NOT NULL,
  PRIMARY KEY (`idouvrage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ouvrage`
--

LOCK TABLES `ouvrage` WRITE;
/*!40000 ALTER TABLE `ouvrage` DISABLE KEYS */;
/*!40000 ALTER TABLE `ouvrage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `redaction`
--

DROP TABLE IF EXISTS `redaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `redaction` (
  `idredaction` int(11) NOT NULL AUTO_INCREMENT,
  `idmembre` int(11) DEFAULT NULL,
  `idouvrage` int(11) DEFAULT NULL,
  `periode` date DEFAULT NULL,
  PRIMARY KEY (`idredaction`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `redaction`
--

LOCK TABLES `redaction` WRITE;
/*!40000 ALTER TABLE `redaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `redaction` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-13 16:27:06
