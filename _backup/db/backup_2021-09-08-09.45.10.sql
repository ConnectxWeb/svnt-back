-- MySQL dump 10.19  Distrib 10.3.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: svntfrkroot.mysql.db    Database: svntfrkroot
-- ------------------------------------------------------
-- Server version	5.6.50-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `assoc`
--

DROP TABLE IF EXISTS `assoc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assoc` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ville_id` int(10) unsigned NOT NULL,
  `nom` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `telephone` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homme` tinyint(1) DEFAULT NULL,
  `femme` tinyint(1) DEFAULT NULL,
  `chien` tinyint(1) DEFAULT NULL,
  `handicap` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7B9337116C6E55B5` (`nom`),
  KEY `fk_assoc_ville` (`ville_id`),
  CONSTRAINT `FK_7B933711A73F0036` FOREIGN KEY (`ville_id`) REFERENCES `ville` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assoc`
--

LOCK TABLES `assoc` WRITE;
/*!40000 ALTER TABLE `assoc` DISABLE KEYS */;
INSERT INTO `assoc` VALUES (90,4,'ISSUE CORUS SAO (Service d\'Accueil et d\'Orientation)','<div>Accueil en urgence, orientation et accompagnement des personnes sans hébergement stable</div>','04 67 58 14 00','7 rue louise guiraud, 34000 Montpellier','3.873499996901245','43.6051999934042',NULL,NULL,0,0,'2021-09-07 09:56:07','2021-09-07 11:37:00'),(91,4,'ISSUE CORUS Point Courrier','<div>Domiciliation postale</div>','04 67 58 14 00','7 Rue Louise Guiraud, 34000, Montpellier','3.873499996901245','43.6051999934042',NULL,NULL,0,0,'2021-09-07 10:02:42','2021-09-07 10:02:42'),(92,4,'ISSUE CORUS P.A.U.S.E','<div>Petits-déjeuners, douches et machines et laver : du lundi au vendredi, 8h30-12h/ dimanche, 8h30-10h30<br>Lieu de repos/ jeux/ animations : lundi et mercredi, 14h-18h/ mardi, jeudi, vendredi, 13h-18h</div>','0467581400','19 rue saint claude, 34000 Montpellier','3.8728199730966253','43.60523000061755',NULL,NULL,1,1,'2021-09-07 10:28:02','2021-09-07 11:21:19'),(93,4,'Croix Rouge','<div>Petits-déjeuners, douches (0,2€), machines à laver (1€) : Du lundi au dimanche, 8h30-10h30<br>Sandwichs/ fruits à emporter : Samedi et dimanche : 12h-12h45</div>','0467400197','3 boulevard henri IV, 34000 Montpellier','3.873499996901245','43.61458001360975',NULL,NULL,0,0,'2021-09-07 10:34:27','2021-09-07 11:15:44'),(94,4,'Secours Catholique (Halte Solidarité)','<div>Petits-déjeuners (0,1€), douches (0,5€), bagagerie, accès ordinateur, kits d\'hygiène : Du lundi au vendredi, 8h30-11h<br>Petits déjeuners le weekend (gratuit) : Samedi : 9h-11h (Secours Catholique et Ordre de Malte)<br>Permanence chiens (Gamelles pleines) : mardi et jeudi, 9h-10h30</div>',NULL,'45 Quai du verdanson, 34000 Montpellier','3.8821799605536285','43.61507001966939',NULL,NULL,1,1,'2021-09-07 11:14:53','2021-09-07 12:51:30'),(97,3,'Test',NULL,NULL,'dkkd',NULL,NULL,NULL,NULL,0,0,'2021-09-07 11:45:08','2021-09-07 11:45:08');
/*!40000 ALTER TABLE `assoc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assoc_has_ouverture`
--

DROP TABLE IF EXISTS `assoc_has_ouverture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assoc_has_ouverture` (
  `assoc_id` int(10) unsigned NOT NULL,
  `ouverture_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`assoc_id`,`ouverture_id`),
  KEY `IDX_8A467FFC82A46EC6` (`assoc_id`),
  KEY `IDX_8A467FFCF892AC88` (`ouverture_id`),
  CONSTRAINT `FK_8A467FFC82A46EC6` FOREIGN KEY (`assoc_id`) REFERENCES `assoc` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_8A467FFCF892AC88` FOREIGN KEY (`ouverture_id`) REFERENCES `ouverture` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assoc_has_ouverture`
--

LOCK TABLES `assoc_has_ouverture` WRITE;
/*!40000 ALTER TABLE `assoc_has_ouverture` DISABLE KEYS */;
INSERT INTO `assoc_has_ouverture` VALUES (90,433),(90,434),(90,435),(90,436),(90,437),(90,438),(90,439),(90,440),(90,441),(90,442),(91,443),(91,444),(91,445),(91,446),(91,447),(92,448),(92,449),(92,450),(92,451),(92,452),(92,453),(92,454),(92,455),(92,456),(92,457),(93,458),(93,459),(93,460),(93,461),(93,462),(93,463),(93,464),(93,465),(93,466),(94,467),(94,468),(94,469),(94,470),(94,471),(94,472);
/*!40000 ALTER TABLE `assoc_has_ouverture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assoc_id` int(10) unsigned DEFAULT NULL,
  `ordre` int(10) unsigned NOT NULL DEFAULT '999',
  PRIMARY KEY (`id`),
  KEY `IDX_497DD63482A46EC6` (`assoc_id`),
  CONSTRAINT `FK_497DD63482A46EC6` FOREIGN KEY (`assoc_id`) REFERENCES `assoc` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` VALUES (10,'Accueil de jour',94,999),(11,'Alimentation',94,999),(12,'Hygiène',94,999),(13,'Vêtements',97,999),(14,'Santé/ soin',97,999),(15,'Stocker ses affaires',94,999),(16,'Animaux',94,999),(17,'Accès internet',94,999),(18,'Administratif',94,999),(19,'Apprendre',NULL,999),(20,'Accompagnement social',90,999);
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maraude`
--

DROP TABLE IF EXISTS `maraude`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maraude` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `assoc_id` int(10) unsigned NOT NULL,
  `nom` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `telephone` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_debut` datetime DEFAULT NULL,
  `date_fin` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_DA5E9CA26C6E55B5` (`nom`),
  KEY `fk_assoc_copy1_assoc1` (`assoc_id`),
  CONSTRAINT `FK_DA5E9CA282A46EC6` FOREIGN KEY (`assoc_id`) REFERENCES `assoc` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maraude`
--

LOCK TABLES `maraude` WRITE;
/*!40000 ALTER TABLE `maraude` DISABLE KEYS */;
/*!40000 ALTER TABLE `maraude` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maraude_has_ouverture`
--

DROP TABLE IF EXISTS `maraude_has_ouverture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maraude_has_ouverture` (
  `maraude_id` int(10) unsigned NOT NULL,
  `ouverture_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`maraude_id`,`ouverture_id`),
  KEY `IDX_D4A79C46ED9AF501` (`maraude_id`),
  KEY `IDX_D4A79C46F892AC88` (`ouverture_id`),
  CONSTRAINT `FK_D4A79C46ED9AF501` FOREIGN KEY (`maraude_id`) REFERENCES `maraude` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_D4A79C46F892AC88` FOREIGN KEY (`ouverture_id`) REFERENCES `ouverture` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maraude_has_ouverture`
--

LOCK TABLES `maraude_has_ouverture` WRITE;
/*!40000 ALTER TABLE `maraude_has_ouverture` DISABLE KEYS */;
/*!40000 ALTER TABLE `maraude_has_ouverture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ouverture`
--

DROP TABLE IF EXISTS `ouverture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ouverture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jour_index` smallint(6) NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=479 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ouverture`
--

LOCK TABLES `ouverture` WRITE;
/*!40000 ALTER TABLE `ouverture` DISABLE KEYS */;
INSERT INTO `ouverture` VALUES (433,1,'08:30:00','11:45:00','2021-09-07 09:56:07','2021-09-07 09:56:07'),(434,1,'14:00:00','16:45:00','2021-09-07 09:56:07','2021-09-07 09:56:07'),(435,2,'08:30:00','11:45:00','2021-09-07 09:56:07','2021-09-07 09:56:07'),(436,2,'14:00:00','16:45:00','2021-09-07 09:56:07','2021-09-07 09:56:07'),(437,3,'08:30:00','11:45:00','2021-09-07 09:56:07','2021-09-07 09:56:07'),(438,3,'14:00:00','16:45:00','2021-09-07 09:56:07','2021-09-07 09:56:07'),(439,4,'08:30:00','11:45:00','2021-09-07 09:56:07','2021-09-07 09:56:07'),(440,4,'14:00:00','16:45:00','2021-09-07 09:56:07','2021-09-07 09:56:07'),(441,5,'08:30:00','11:45:00','2021-09-07 09:56:07','2021-09-07 09:56:07'),(442,5,'14:00:00','16:45:00','2021-09-07 09:56:07','2021-09-07 09:56:07'),(443,1,'08:30:00','12:00:00','2021-09-07 10:02:42','2021-09-07 10:02:42'),(444,2,'08:30:00','12:00:00','2021-09-07 10:02:42','2021-09-07 10:02:42'),(445,3,'08:30:00','12:00:00','2021-09-07 10:02:42','2021-09-07 10:02:42'),(446,4,'08:30:00','12:00:00','2021-09-07 10:02:42','2021-09-07 10:02:42'),(447,5,'08:30:00','12:00:00','2021-09-07 10:02:42','2021-09-07 10:02:42'),(448,1,'08:30:00','12:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(449,1,'14:00:00','18:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(450,2,'08:30:00','12:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(451,2,'13:00:00','18:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(452,3,'08:30:00','12:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(453,3,'14:00:00','18:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(454,4,'08:30:00','12:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(455,4,'13:00:00','18:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(456,5,'08:30:00','12:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(457,5,'13:00:00','18:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(458,1,'08:30:00','10:30:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(459,2,'08:30:00','10:30:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(460,3,'08:30:00','10:30:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(461,4,'08:30:00','10:30:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(462,5,'08:30:00','10:30:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(463,6,'08:30:00','10:30:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(464,6,'12:00:00','12:45:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(465,7,'08:30:00','10:30:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(466,7,'12:00:00','12:45:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(467,1,'08:30:00','11:00:00','2021-09-07 11:14:53','2021-09-07 11:14:53'),(468,2,'08:30:00','11:00:00','2021-09-07 11:14:53','2021-09-07 11:14:53'),(469,3,'08:30:00','11:00:00','2021-09-07 11:14:53','2021-09-07 11:14:53'),(470,4,'08:30:00','11:00:00','2021-09-07 11:14:53','2021-09-07 11:14:53'),(471,5,'08:30:00','11:00:00','2021-09-07 11:14:53','2021-09-07 11:14:53'),(472,6,'09:00:00','11:00:00','2021-09-07 11:14:53','2021-09-07 11:14:53');
/*!40000 ALTER TABLE `ouverture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sous_categorie`
--

DROP TABLE IF EXISTS `sous_categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sous_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) NOT NULL,
  `assoc_id` int(10) unsigned DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordre` int(10) unsigned NOT NULL DEFAULT '999',
  PRIMARY KEY (`id`),
  KEY `IDX_52743D7BBCF5E72D` (`categorie_id`),
  KEY `IDX_52743D7B82A46EC6` (`assoc_id`),
  CONSTRAINT `FK_52743D7B82A46EC6` FOREIGN KEY (`assoc_id`) REFERENCES `assoc` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_52743D7BBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sous_categorie`
--

LOCK TABLES `sous_categorie` WRITE;
/*!40000 ALTER TABLE `sous_categorie` DISABLE KEYS */;
INSERT INTO `sous_categorie` VALUES (7,11,NULL,'Repas midi',999),(9,11,NULL,'Colis',999),(10,11,NULL,'Epicerie sociale',999),(11,12,94,'Toilettes',999),(12,12,94,'Douche',999),(13,12,NULL,'Tampons/ Serviettes',999),(14,12,94,'Produits d\'hygiène',999),(15,12,NULL,'Contraception (pilule, préservatif, etc.)',999),(16,12,NULL,'Masque',999),(17,12,NULL,'Gel hydroalcoolique',999),(18,12,NULL,'Machine à laver',999),(19,14,NULL,'Consultations gratuites',999),(20,14,NULL,'Psychologues gratuits',999),(21,14,NULL,'Pharmacies (de gardes)',999),(22,14,NULL,'Dépistage/ Vaccination',999),(23,14,NULL,'Addictions/ Toxicomanie',999),(24,16,94,'Permanences',999),(25,16,94,'Croquettes',999),(26,16,NULL,'Chenil',999),(27,17,NULL,'Wifi gratuite',999),(28,17,94,'Accès à un ordinateur',999),(29,18,NULL,'Refaire sa carte d\'identité',999),(30,18,91,'Domiciliation',999),(31,18,NULL,'Demande de RSA',999),(32,18,NULL,'Demande VISA/ Asile/ Titre de séjour',999),(33,19,NULL,'Cours de français',999),(34,19,NULL,'Cours d\'alphabétisation',999),(35,10,92,'Accueil de jour',999),(36,15,94,'Bagagerie',999);
/*!40000 ALTER TABLE `sous_categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `lastname` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT 'NULL',
  `firstname` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT 'NULL',
  `age` int(10) unsigned DEFAULT NULL,
  `gender` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT 'NULL',
  `region` int(11) DEFAULT NULL,
  `newsletter` tinyint(1) DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'admin','admin','info@connectx.fr','info@connectx.fr',1,'JbwdZzOI2hWcYPOfvX1lzaTLIBOE..DvhKKw.oMNA2w','$2y$13$QqYYJ8Jma1Lik/5KwRSgnOBAdHLDTIZdl0i9Bg.GRmoaWTcywCPje','2021-09-08 11:26:43',NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}',NULL,NULL,NULL,NULL,NULL,NULL,'2021-01-07 16:56:20','2021-09-08 11:26:43');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ville`
--

DROP TABLE IF EXISTS `ville`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ville` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_43C3D9C36C6E55B5` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ville`
--

LOCK TABLES `ville` WRITE;
/*!40000 ALTER TABLE `ville` DISABLE KEYS */;
INSERT INTO `ville` VALUES (3,'Toulouse','2021-01-07 16:58:56','2021-01-07 16:58:56'),(4,'Montpellier','2021-01-07 16:58:56','2021-01-07 16:58:56');
/*!40000 ALTER TABLE `ville` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-09-08  9:45:10
