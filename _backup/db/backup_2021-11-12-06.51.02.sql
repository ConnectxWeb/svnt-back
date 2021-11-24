-- MySQL dump 10.19  Distrib 10.3.31-MariaDB, for debian-linux-gnu (x86_64)
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
  `logo_filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7B9337116C6E55B5` (`nom`),
  KEY `fk_assoc_ville` (`ville_id`),
  CONSTRAINT `FK_7B933711A73F0036` FOREIGN KEY (`ville_id`) REFERENCES `ville` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assoc`
--

LOCK TABLES `assoc` WRITE;
/*!40000 ALTER TABLE `assoc` DISABLE KEYS */;
INSERT INTO `assoc` VALUES (90,4,'ISSUE CORUS SAO (Service d\'Accueil et d\'Orientation)','<div>Accueil en urgence, orientation et accompagnement des personnes sans hébergement stable<br><br>Tram 3 et 4, Saint Denis</div>','04 67 58 14 00','7 Rue Louise Guiraud, 34000 Montpellier, France','3.8734948','43.6051963',NULL,NULL,0,0,'2021-09-07 09:56:07','2021-11-05 14:38:42','7b91866ee9d63334a567c057f31f94cce2ae0179.png'),(91,4,'ISSUE CORUS Point Courrier','<div>Domiciliation postale pour les personnes suivies au SAO<br><br>Tram 3 et 4, Saint Denis</div>','04 67 58 14 00','7 Rue Louise Guiraud, 34000, Montpellier','3.873499996901245','43.6051999934042',NULL,NULL,0,0,'2021-09-07 10:02:42','2021-11-05 14:38:58','56758926d90215abc7e6097c7645ca9bf5287ee9.png'),(92,4,'ISSUE CORUS P.A.U.S.E','<div>Petits-déjeuners, douches et machines et laver : du lundi au vendredi, 8h30-12h/ dimanche, 8h30-10h30<br>Lieu de repos/ jeux/ animations : lundi et mercredi, 14h-18h/ mardi, jeudi, vendredi, 13h-18h<br>Permanence soin/ santé gratuite : mardi et jeudi, 9h-12h (voir catégorie \"soin/santé\")<br>Permanence psychologique gratuite : lundi, jeudi et vendredi, 9h-12h (voir catégorie \"soin/santé\")<br><br>Tram 3 et 4, Saint Denis</div>','0467581400','19 rue saint claude, 34000 Montpellier','3.8728199730966253','43.60523000061755',NULL,NULL,1,1,'2021-09-07 10:28:02','2021-11-05 14:39:13','872d3cd6b6f7c73c4634c6a79a4f414a571667dc.png'),(93,4,'Croix Rouge','<div>Petits-déjeuners, douches (0,2€), machines à laver (1€), kits d\'hygiène : Du lundi au dimanche, 8h30-10h30<br>Sandwichs/ fruits à emporter : Samedi et dimanche : 12h-12h45<br><br>Tram 4, Albert 1e Cathédrale&nbsp;</div>','0467400197','3 boulevard henri IV, 34000 Montpellier','3.873499996901245','43.61458001360975',NULL,NULL,0,0,'2021-09-07 10:34:27','2021-11-05 14:39:32','015fe2f00722c6317b2a98ac1237bc7040604b46.jpeg'),(94,4,'Secours Catholique (Halte Solidarité)','<div>Petits-déjeuners (0,1€), douches (0,5€), bagagerie, accès ordinateur, kits d\'hygiène : Du lundi au vendredi, 8h30-11h<br>Petits déjeuners le weekend (gratuit) : Samedi : 9h-11h (Secours Catholique et Ordre de Malte)<br>Permanence animaux (Gamelles pleines) : mardi et jeudi, 9h-10h30<br>Permanence soin/ santé gratuite : lundi, mardi, jeudi, vendredi, 8h30-11h (voir catégorie \"soin/santé\")<br><br>Tram 1, 2 et 3, Corum</div>',NULL,'45 Quai du verdanson, 34000 Montpellier','3.8821799605536285','43.61507001966939',NULL,NULL,1,1,'2021-09-07 11:14:53','2021-11-05 14:39:51','1d2bfd075ed7871d9a81e9e30461137ba1d019f1.jpeg'),(98,4,'Saint-Vincent-De-Paul (Halte Solidarité)','<div>Repas complets (entrée, plat, dessert) à 2€.<br><br>Tram 1, 2, 3, Corum<br><br></div>',NULL,'45 Quai du Verdanson, Montpellier, France','3.8823018','43.61513619999999',NULL,NULL,0,0,'2021-09-08 14:12:23','2021-11-05 14:40:10','8e57a0bf663a2fd38898e68384d73abff7915e8f.jpeg'),(101,4,'Camions du Coeur (Restos du Coeur)','<div>Repas midi : du lundi au vendredi, 11h45-12h30<br>Repas soir : lundi, 19h-19h45&nbsp;<br><br>-&gt; Parking des Arceaux (Tram 3, Saint Denis - 10 minutes à pied)</div>',NULL,'Place Max-Rouquette, 34000 Montpellier, France','3.8672449','43.6117522',NULL,NULL,0,0,'2021-09-08 15:10:03','2021-11-05 14:54:59','e9c1593b01b8f0cd91fffd03aab011fe4eaee80c.svg'),(102,4,'Association Humanitaire de Montpellier (AHM)','<div>Distribution repas et dépannage vêtements et produits d\'hygiène<br><br>Tram 1, 3 et 4, Rives du Lez</div>',NULL,'349 Rue Vendémiaire, Montpellier, France','3.898383','43.6043448',NULL,NULL,0,0,'2021-09-08 15:13:13','2021-11-05 14:40:43','63ec5af80d730fc4c3ac86706b0c0a5b1a790acf.png'),(103,4,'Projet Citoyen 34','<div>Repas soir : Du lundi au vendredi, 19h-20h30<br>Maraudes : 20h30-21h30<br><br>-&gt; Sous les Arceaux (Tram 3, Saint Denis - 8 minutes à pied)</div>',NULL,'31 Bd des Arceaux, 34000 Montpellier, France','3.8640788','43.6114722',NULL,NULL,0,0,'2021-09-08 15:17:18','2021-10-05 11:07:00',NULL),(104,4,'Saint-Vincent-De-Paul (SSVP) - Plan Cabane','<div>Tram 3, Saint Denis</div>',NULL,'Plan Cabannes, Montpellier, France','3.8687683','43.6083171',NULL,NULL,0,0,'2021-09-08 15:20:38','2021-11-05 14:41:09','3ed5dc33486a58c49bb4d861ac1807efce4bd073.jpeg'),(105,4,'La Table d\'Anouk','<div>Tram 1, Antigone</div>',NULL,'Place Paul Bec, Montpellier, France','3.8864525','43.6082994',NULL,NULL,0,0,'2021-09-08 15:27:32','2021-11-05 14:42:53','705fe765b767839f049bffc6b3040bf4bf9471f2.png'),(106,4,'Secours Populaire antenne La Pompignane','<div>Sur RDV uniquement. Prise de rendez-vous par téléphone les lundis, 14h-16h30, les mardis et jeudis, 10h-12h, 14h-16h30<br><br>Tram 4, Les Aubes</div>','04 67 72 66 45','119 Avenue Saint-André de Novigens, Montpellier, France','3.8952256','43.6185818',NULL,NULL,0,0,'2021-09-08 16:04:58','2021-11-05 14:43:09','0332646dad091aedfe02c7538d00d920a5840c32.png'),(107,4,'Secours Populaire antenne La Paillade','<div>Soutien alimentaire sans-rendez-vous<br><br>Aide aux papiers administratifs sans rendez-vous aux heures de la permanence<br><br>Tram 1, Halles de La Paillade</div>','04 67 75 70 57','140 Rue de Cambridge, Montpellier, France','3.819762','43.62588959999999',NULL,NULL,0,0,'2021-09-08 16:07:38','2021-11-05 14:43:21','409049677fecaa68544729914bf8e1c457e6ffea.png'),(108,4,'Secours Populaire antenne St Martin','<div>Soutien alimentaire (sans RDV)<br>Aide administrative (sur RDV au 04 99 74 23 80)<br><br>Tram 4, Restanques</div>','04 99 74 23 80','3 Rue des Catalpas, Montpellier, France','3.884243100000001','43.5922744',NULL,NULL,0,0,'2021-09-08 16:12:43','2021-11-05 14:43:32','05a9c41ebc28531590ba1a926189563645650d19.png'),(109,4,'Secours Populaire antenne Paul Valéry','<div>Sans RDV pour le premier rendez-vous, mercredi et jeudi, 10h-12h, 13h-16h<br>Ou sur RDV au 04 67 69 58 41<br><br>Bus 11 ou 6, Pas du loup</div>','04 67 69 58 41','24 Rue Robespierre, Montpellier, France','3.845404199999999','43.60046679999999',NULL,NULL,0,0,'2021-09-08 16:14:42','2021-11-05 14:43:43','587baa4631398f33e590735e22db5c61dc44c2d0.png'),(110,4,'Restos du Coeur Centre Soldanelles','<div>Paniers au choix<br>Les horaires et périodes de fermeture sont à consulter sur : https://restosducoeur34.fr/les-restos-du-coeur/l-association-de-l-herault/ou-nous-trouver/15-centres-de-distribution-de-montpellier<br><br>Bus 10 Petit Bard<br>Tram 3 Pergola</div>','04 67 75 68 70','4 Rue des Aconits, Montpellier, France','3.8366271','43.6165335',NULL,NULL,0,0,'2021-09-08 16:38:28','2021-11-05 14:54:38','164900cf4968d18f0a64f3203348f370c3d8d52d.svg'),(114,4,'Restos du Coeur Centre Centrayrargues','<div>Paniers au choix<br>Les horaires et périodes de fermeture sont à consulter sur : https://restosducoeur34.fr/les-restos-du-coeur/l-association-de-l-herault/ou-nous-trouver/15-centres-de-distribution-de-montpellier <br><br>Bus 16 Lucullus<strong><br></strong>Bus 12 Razéteurs<strong><br></strong>Tram 4 Garcia Lorca ou Saint Martin</div>','04 99 51 80 91','370 Rue de Centrayrargues, Montpellier, France','3.885410799999999','43.59610899999999',NULL,NULL,0,0,'2021-09-16 11:48:10','2021-11-05 14:55:18','f9cb2313d0174c9a50adbaaea61cceda8f746fa4.svg'),(115,4,'Restos du Coeur COS','<div>Paniers au choix<br>Les horaires et périodes de fermeture sont à consulter sur : https://restosducoeur34.fr/les-restos-du-coeur/l-association-de-l-herault/ou-nous-trouver/15-centres-de-distribution-de-montpellier<br><br>Tram 1 et 3, Mosson</div>','04 67 45 38 21','61 Rue de Cos, 34080 Montpellier, France','3.8184026','43.6215185',NULL,NULL,0,0,'2021-09-16 11:51:29','2021-11-05 14:55:35','91d0c7851bb750d6fd1674d77eae433953d2ad6a.svg'),(116,4,'Restos du Coeur Danton','<div>Paniers au choix<br>Les horaires et périodes de fermeture sont à consulter sur : https://restosducoeur34.fr/les-restos-du-coeur/l-association-de-l-herault/ou-nous-trouver/15-centres-de-distribution-de-montpellier<br><br>Porte 9, rue Robespierre, face école.&nbsp;<br>Bus 6 ou 11 Pas du Loup<br>Bus 38 Georges Danton</div>','04 67 27 36 28','115 Rue Danton, Montpellier, France','3.845306699999999','43.599676',NULL,NULL,0,0,'2021-09-16 11:54:36','2021-11-05 14:55:50','23145522455b21255c1ff9b3ec2f82be773ad52f.svg'),(117,4,'Restos du Coeur Montassinos','<div>Paniers au choix<br>Les horaires et périodes de fermeture sont à consulter sur : https://restosducoeur34.fr/les-restos-du-coeur/l-association-de-l-herault/ou-nous-trouver/15-centres-de-distribution-de-montpellier<br><br>Résidence Aiguelongue - Batiment 1, escalier A<br><br>Bus La Ronde Aiguelongue<br>Bus 10 Clolus<br>Tram 2 Aiguelongue</div>','04 67 02 46 12','675 Rue de Montasinos, Montpellier, France','3.881443399999999','43.6278877',NULL,NULL,0,0,'2021-09-16 11:55:27','2021-11-05 14:56:05','85b6de66cf7f5344ee74cb94d34b87ae8d3c9ad8.svg'),(118,4,'Restos BB du Coeur Soldanelles','<div>Paniers au choix de produits \"bébés\"<br>Les horaires et périodes de fermeture sont à consulter sur : https://restosducoeur34.fr/les-restos-du-coeur/l-association-de-l-herault/ou-nous-trouver/16-restos-bebes-de-l-herault<br><br><br>Bus 10 Petit Bard<br>Tram 3 Pergola</div>','07 68 04 21 58','2 Rue des Soldanelles, Montpellier, France','3.8370556','43.6165679',NULL,NULL,0,0,'2021-09-16 12:12:06','2021-11-05 14:56:21','0b9ba6624dc2aab82b4cf70b84a709a839550907.jpeg'),(119,4,'Restos BB du Coeur Centrayrargues','<div>Paniers au choix de produits \"bébés\"<br>Les horaires et périodes de fermeture sont à consulter sur : https://restosducoeur34.fr/les-restos-du-coeur/l-association-de-l-herault/ou-nous-trouver/16-restos-bebes-de-l-herault<br><br>Bus 16 Lucullus<strong><br></strong>Bus 12 Razéteurs<strong><br></strong>Tram 4 Garcia Lorca ou Saint Martin</div>','04 67 65 88 19','370 Rue de Centrayrargues, Montpellier, France','3.885410799999999','43.59610899999999',NULL,NULL,0,0,'2021-09-16 12:13:48','2021-11-05 14:56:33','ce9aa5baa12943c025ea1662393967caf85769e4.jpeg'),(120,4,'Fringuerie Saint-Vincent-De-Paul','<div>Vestiaire adulte à bas prix<br><br>Tram 2 et 4, Rondelet</div>',NULL,'12 Rue Saint-Denis, Montpellier, France','3.8744589','43.6038174',NULL,NULL,0,0,'2021-09-16 12:21:29','2021-11-05 14:57:09','d8cb760ad3ce5cb6b224d2b61d971d474ac39a11.jpeg'),(121,4,'Vestiaire enfant Saint-Vincent-De-Paul','<div>Vêtements à bas prix pour les enfants.<br><br>Tram 2 et 4, Rondelet</div>',NULL,'4 Rue de Belfort, Montpellier, France','3.873457600000001','43.603962',NULL,NULL,0,0,'2021-09-16 12:22:53','2021-11-05 14:58:55','abeeecedc00d0281babdd7365f452dd6c4c7784a.jpeg'),(122,4,'Secours Populaire antenne Figuerolles','<div>vestimentaires, uniquement sur RDV. Prise de rendez-vous au : 04 34 11 47 28 (laisser un message en cas d\'absence, les personnes sont rappelées).<br><br>Tram 3, Plan Cabane</div>','04 34 11 47 28','78 Rue du Faubourg Figuerolles, Montpellier, France','3.8633816','43.606321',NULL,NULL,0,0,'2021-09-16 12:24:22','2021-11-05 15:00:53','ae6e6ba76a72e1fe4303af76f468b2840c66ec1c.png'),(123,4,'Vestiboutique Croix Rouge','<div>Vêtements à bas prix ou gratuité possible sur orientation d\'un travailleur social.<br><br>Tram 2, Beaux Arts</div>',NULL,'4 Rue de la Poésie, Montpellier, France','3.882843200000001','43.61705689999999',NULL,NULL,0,0,'2021-09-16 12:30:00','2021-11-05 15:01:13','54f6375ff1eef60c171226b7aa0e77ed12794542.jpeg'),(124,4,'CASO Médecins du Monde (Centre','<div>Le Centre d\'Accueil, de Soin et d\'Orientation (CASO) permet d\'accéder à une consultation médico-sociale, avec ou sans droits ouverts. Sans rendez-vous.<br><br>Tram 1, Saint Eloi</div>','04 99 23 27 17','18 Rue Henri Dunant, Montpellier, France','3.869192000000001','43.626729',NULL,NULL,0,0,'2021-09-16 12:33:58','2021-11-05 15:01:32','8624b7e1696c19f3a53bafdc1fe95ecaa9b137a2.png'),(125,4,'CASO dentaire Médecins du Monde','<div>Le Centre d\'Accueil, de Soin et d\'Orientation (CASO) dentaire permet d\'accéder à des soins dentaires, avec ou sans droits ouverts. Sur rendez-vous<br><br>Tram 1, Saint Eloi</div>','04 99 23 27 17','18 Rue Henri Dunant, Montpellier, France','3.869192000000001','43.626729',NULL,NULL,0,0,'2021-09-16 12:43:55','2021-11-05 15:01:46','85a75f71596f1b416973a96d8402161d1ab3aefc.png'),(126,4,'Santé Solidarité (Halte Solidarité)','<div>Consultations médicales gratuites sans rendez-vous.<br><br>Tram 1, 2, 3, Corum</div>',NULL,'45 Quai du Verdanson, Montpellier, France','3.8823018','43.61513619999999',NULL,NULL,0,0,'2021-09-16 12:46:41','2021-11-05 15:02:32','1d98ba833eea9eae3113eee0527a033dd5b3a942.jpeg'),(127,4,'Permanence santé CORUS','<div>Consultations santé gratuites et sans rendez-vous<br><br>Tram 3, Saint Denis</div>',NULL,'19 Rue Saint-Claude, Montpellier, France','3.873329','43.605113',NULL,NULL,0,0,'2021-09-16 12:50:02','2021-11-05 15:02:48','1698f626e1e87aaefc62ba97ff45f98819801799.png'),(128,4,'Permanence d\'Accès au Soins de Santé (PASS)','<div>Permanence d\'accès aux soins pour les personnes sans ou dans l\'attente de droits. Sur RDV<br><br>Hôpital St Eloi<br>Tram 1, Université des sciences et des lettres</div>','04 67 33 71 55','80 Avenue Augustin Fliche, Montpellier, France','3.8623413','43.6301844',NULL,NULL,0,0,'2021-09-16 12:52:34','2021-11-05 15:03:50','c88b7bb2ebc8935c90d4e3d6765d8c92a1bbb588.jpeg'),(129,4,'La PASS (Permanence d\'Accès aux Soins de Santé) Psy','<div>Permanence d\'Accès aux Soins psychologiques pour les personnes dans ou dans l\'attente de droit. Sur rendez-vous au 04 67 33 98 83<br><br>Hôpital La Colombière<br>Tram 1, Université des sciences et des lettres</div>','04 67 33 98 83','39 Avenue Charles Flahault, Montpellier, France','3.855460900000001','43.6288985',NULL,NULL,0,0,'2021-09-16 12:56:58','2021-11-05 15:04:27','d56f35d835b84fe652d67a06418bda00adef233f.jpeg'),(130,4,'SOS SDF 34','<div>Ouvert d\'Octobre à Avril<br>Repas distribué dans la rue jeudi soir, 19h-20h30, parvis St Denis (Tram 3, Saint Denis)<br>Maraudes dans le centre-ville le jeudi soir, 18h30-20h30</div>',NULL,'34000 Pl. Saint-Denis, Montpellier, France','3.874569','43.6052412',NULL,NULL,0,0,'2021-09-16 15:05:00','2021-11-05 15:05:37','fd70df8f8e66588106499f1c3d66bfa8756d761f.png'),(131,4,'CEGIDD','<div>Le Centre de Dépistage IST (CEGIDD) du CHU de Montpelier permet d\'accéder gratuitement au dépistage VIH/ SIDA, hépatites virales, au traitement IST, à la vaccination pour les maladités liées à la sexualité et, à des consultations PrEP (Prévention médicamenteuses VIH/ SIDA).&nbsp;<br>Sur rendez-vous sauf pour les personnes sans-abris et/ ou en grande difficulté sociales et pour les travailleurs du sexe.<br><br>Bureaux du Polygone (Tram 1, Antigone)</div>','04 67 33 69 50','265 Avenue des États du Languedoc, Montpellier, France','3.8848213','43.6078678',NULL,NULL,0,0,'2021-09-16 15:19:48','2021-11-05 15:07:32','a065db53285bb243cd267769795cb6825af7b2e9.webp'),(132,4,'Centre municipal de vaccination','<div>Le centre municipal de vaccination est accessible uniquement sur RDV au 04 48 18 62 00 ou sur vaccinations@ville-montpellier.fr<strong> </strong>&nbsp;<br>Les séances de vaccination <strong>(hors COVID19)</strong> sont proposées lundi, mercredi et jeudi de 14h à 16h.<br><br>Le Centre proposer un accueil physique et téléphonique du Lundi au Vendredi de 8h30 à 12h et de 13h30 à 17h - <strong>04 48 18 62 00<br><br></strong>Informations mises à jour sur le site : https://www.montpellier.fr/1226-vaccinations.htm.</div><div><br>Tram 1, Antigone</div>','04 48 18 62 00','2 Place Paul Bec, Montpellier, France','3.886333100000001','43.6087155',NULL,NULL,0,0,'2021-09-16 15:44:50','2021-11-05 15:08:38','e7a228fdfb05a68a7c3affbe222570a3387fa71d.png'),(133,4,'CAARUD Axess accueil collectif','<div>Le Centre d\'Accueil et d\'Accompagnement à la Réduction des risques des Usagers de Drogues (CAARUD) proposent un accueil collectif et individuel :<br><br><strong>Accueil collectif le matin</strong> : Du lundi au vendredi, 9h-13h (sans douches actuellement)<br>=&gt; Distribution de matériel de prévention des infections (VHB, VHC, VIH), domiciliation postale pour les personnes suivies par le CAARUD, soutien admin sur rendez-vous.<br><br><strong>Accueil individuel l\'après-midi sur rendez-vous</strong> : Du lundi au vendredi, 14h-17h<br><br>Tram 1, Université des sciences et des lettres</div>','0467586223','66 Avenue Charles Flahault, Montpellier, France','3.8588298','43.6275649',NULL,NULL,1,1,'2021-09-16 16:18:45','2021-11-05 15:09:29','77d54a7c9402947881bfc7a258747db5bcb816a7.jpeg'),(134,4,'Antenne Méthadone à seuil facilité - CAARUD Axess','<div>Soin de première intention et d\'urgence/ inclusion et dispensation Antenne Méthadone à seuil facilité</div>','+33467586223','66 Avenue Charles Flahault, Montpellier, France','3.8588298','43.6275649',NULL,NULL,0,0,'2021-09-16 16:22:46','2021-11-05 15:10:40','9b40815f473252ddd6b3128f56b572831e0676b4.jpeg'),(135,4,'CAARUD FEMMES - Réduire les Risques','<div>Le Centre d\'Accueil et d\'Accompagnement à la Réduction des risques des Usagers de Drogues (CAARUD) proposent un accueil collectif et individuel.<strong> L\'accueil est réservé aux femmes, à l\'exception de l\'accueil mixte des 18-25 ans les mardis matin.</strong><br><br><strong>Accueil collectif le matin</strong> : Du lundi au vendredi, 9h-13h (sans douches actuellement)<br>=&gt; Distribution de matériel de prévention des infections (VHB, VHC, VIH), domiciliation postale pour les personnes suivies par le CAARUD, soutien admin sur rendez-vous.<br><br><strong>Accueil individuel sur rendez-vous</strong> : Domiciliation postale, colis de dépannage et distribution de matériel d\'injection<br><br></div>','0467580101','5 Rue Fouques, Montpellier, France','3.8684739','43.6023291',NULL,1,1,1,'2021-09-16 16:31:17','2021-11-05 15:11:12','1e643d8c02f0b545f908f430e03c49ee6777b706.png'),(136,4,'CORUS Permanence santé psychologique (UMIPPP)','<div>Permanence gratuite et sans rendez-vous</div>',NULL,'19 Rue Saint-Claude, Montpellier, France','3.873329','43.605113',NULL,NULL,0,0,'2021-10-05 11:33:23','2021-11-05 15:12:25','252584ccdfa83aa44c5986d7a28b7eb3fbf9064c.webp');
/*!40000 ALTER TABLE `assoc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assoc_has_category`
--

DROP TABLE IF EXISTS `assoc_has_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assoc_has_category` (
  `assoc_id` int(10) unsigned NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`assoc_id`,`category_id`),
  KEY `IDX_A0DC8B282A46EC6` (`assoc_id`),
  KEY `IDX_A0DC8B212469DE2` (`category_id`),
  CONSTRAINT `FK_A0DC8B212469DE2` FOREIGN KEY (`category_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A0DC8B282A46EC6` FOREIGN KEY (`assoc_id`) REFERENCES `assoc` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assoc_has_category`
--

LOCK TABLES `assoc_has_category` WRITE;
/*!40000 ALTER TABLE `assoc_has_category` DISABLE KEYS */;
INSERT INTO `assoc_has_category` VALUES (90,20),(91,18),(92,10),(92,11),(92,12),(92,15),(92,17),(93,10),(93,11),(93,12),(93,21),(94,10),(94,11),(94,12),(94,15),(94,16),(94,17),(98,11),(101,11),(102,11),(102,16),(103,11),(104,11),(105,11),(106,11),(107,11),(107,18),(108,11),(108,18),(109,11),(110,11),(110,24),(114,11),(114,19),(114,24),(115,11),(115,19),(116,11),(117,11),(118,11),(118,24),(119,11),(119,24),(120,22),(121,22),(122,22),(123,22),(124,21),(125,21),(126,21),(127,21),(128,21),(129,21),(130,11),(131,21),(132,21),(133,25),(134,25),(135,25),(136,21);
/*!40000 ALTER TABLE `assoc_has_category` ENABLE KEYS */;
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
INSERT INTO `assoc_has_ouverture` VALUES (90,433),(90,434),(90,435),(90,436),(90,437),(90,438),(90,439),(90,440),(90,441),(90,442),(91,443),(91,444),(91,445),(91,446),(91,447),(92,448),(92,449),(92,450),(92,451),(92,452),(92,453),(92,454),(92,455),(92,456),(92,457),(93,458),(93,459),(93,460),(93,461),(93,462),(93,463),(93,464),(93,465),(93,466),(94,467),(94,468),(94,469),(94,470),(94,471),(94,472),(98,479),(98,480),(98,481),(98,482),(98,483),(101,487),(101,488),(101,489),(101,490),(101,491),(101,492),(102,493),(102,494),(102,495),(102,496),(102,497),(102,498),(102,499),(103,500),(103,501),(103,502),(103,503),(103,504),(103,505),(104,506),(104,507),(105,508),(106,512),(106,513),(106,514),(106,515),(106,595),(107,509),(107,510),(107,511),(108,596),(108,597),(108,598),(108,599),(108,600),(109,601),(109,602),(109,603),(109,604),(110,516),(110,517),(110,518),(110,519),(114,524),(114,525),(115,526),(115,527),(115,528),(116,529),(116,530),(117,531),(117,532),(117,533),(118,534),(118,535),(118,536),(118,537),(119,538),(119,539),(120,540),(120,541),(120,542),(120,543),(121,544),(123,545),(123,546),(123,547),(123,548),(123,549),(124,550),(124,551),(124,552),(125,553),(125,554),(126,555),(126,556),(126,557),(126,558),(127,559),(127,560),(128,561),(128,562),(128,563),(128,564),(128,565),(129,566),(129,567),(129,568),(129,569),(129,570),(130,571),(131,572),(131,573),(131,574),(131,575),(131,576),(133,577),(133,578),(133,579),(133,580),(133,581),(134,582),(134,583),(134,584),(134,585),(134,586),(134,587),(134,588),(135,589),(135,590),(135,591),(135,592),(135,593),(135,594);
/*!40000 ALTER TABLE `assoc_has_ouverture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assoc_has_sousCategory`
--

DROP TABLE IF EXISTS `assoc_has_sousCategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assoc_has_sousCategory` (
  `assoc_id` int(10) unsigned NOT NULL,
  `sousCategory_id` int(11) NOT NULL,
  PRIMARY KEY (`assoc_id`,`sousCategory_id`),
  KEY `IDX_BD6E80BD82A46EC6` (`assoc_id`),
  KEY `IDX_BD6E80BD11E9B7A7` (`sousCategory_id`),
  CONSTRAINT `FK_BD6E80BD11E9B7A7` FOREIGN KEY (`sousCategory_id`) REFERENCES `sous_categorie` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_BD6E80BD82A46EC6` FOREIGN KEY (`assoc_id`) REFERENCES `assoc` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assoc_has_sousCategory`
--

LOCK TABLES `assoc_has_sousCategory` WRITE;
/*!40000 ALTER TABLE `assoc_has_sousCategory` DISABLE KEYS */;
INSERT INTO `assoc_has_sousCategory` VALUES (90,30),(91,30),(92,11),(92,12),(92,16),(92,17),(92,18),(92,28),(92,36),(92,37),(93,11),(93,12),(93,14),(93,16),(93,18),(93,37),(93,41),(94,11),(94,12),(94,13),(94,14),(94,16),(94,24),(94,25),(94,28),(94,36),(94,37),(98,7),(101,7),(101,38),(102,25),(102,38),(103,38),(104,38),(105,38),(106,9),(107,9),(107,49),(108,9),(108,49),(109,9),(110,9),(110,48),(114,9),(114,34),(114,48),(115,9),(115,34),(116,9),(117,9),(118,9),(118,48),(119,9),(119,48),(123,57),(124,39),(124,55),(125,42),(126,39),(127,39),(128,39),(128,55),(129,40),(130,38),(131,43),(132,43),(133,44),(133,46),(133,47),(133,50),(133,51),(133,52),(133,54),(134,46),(135,44),(135,47),(135,50),(135,51),(135,52),(135,53),(135,54),(136,40);
/*!40000 ALTER TABLE `assoc_has_sousCategory` ENABLE KEYS */;
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
  `ordre` int(10) unsigned DEFAULT '999',
  `logo_filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `html` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` VALUES (10,'Accueil de jour',2,'57fcc816b74bfd22ad333eb8173ece7b00c39034.png',''),(11,'Manger',1,'4869729665b58f8d89b44962d37ec6a2f809696a.png',''),(12,'Hygiène',3,'b622722940d9852392bd1481a96e9df23aff88df.png',''),(15,'Bagagerie',999,NULL,''),(16,'Animaux',999,NULL,''),(17,'Internet',999,NULL,''),(18,'Administratif',999,NULL,''),(19,'Apprendre',999,NULL,''),(20,'Etre accompagné',999,NULL,''),(21,'Me soigner',5,NULL,''),(22,'Vêtements à bas prix',999,NULL,''),(23,'Apprendre',NULL,NULL,''),(24,'Enfant / Famille',999,NULL,''),(25,'Addictions',999,NULL,''),(26,'WC / Douche',NULL,NULL,''),(27,'Couvertures',NULL,NULL,'');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=605 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ouverture`
--

LOCK TABLES `ouverture` WRITE;
/*!40000 ALTER TABLE `ouverture` DISABLE KEYS */;
INSERT INTO `ouverture` VALUES (433,1,'08:30:00','11:45:00','2021-09-07 09:56:07','2021-09-17 22:44:13'),(434,1,'14:00:00','16:45:00','2021-09-07 09:56:07','2021-09-07 09:56:07'),(435,2,'08:30:00','11:45:00','2021-09-07 09:56:07','2021-09-07 09:56:07'),(436,2,'14:00:00','16:45:00','2021-09-07 09:56:07','2021-09-07 09:56:07'),(437,3,'08:30:00','11:45:00','2021-09-07 09:56:07','2021-09-07 09:56:07'),(438,3,'14:00:00','16:45:00','2021-09-07 09:56:07','2021-09-07 09:56:07'),(439,4,'08:30:00','11:45:00','2021-09-07 09:56:07','2021-09-07 09:56:07'),(440,4,'14:00:00','16:45:00','2021-09-07 09:56:07','2021-09-07 09:56:07'),(441,5,'08:30:00','11:45:00','2021-09-07 09:56:07','2021-09-17 22:50:28'),(442,5,'14:00:00','16:45:00','2021-09-07 09:56:07','2021-09-17 23:10:13'),(443,1,'08:30:00','12:00:00','2021-09-07 10:02:42','2021-09-07 10:02:42'),(444,2,'08:30:00','12:00:00','2021-09-07 10:02:42','2021-09-07 10:02:42'),(445,3,'08:30:00','12:00:00','2021-09-07 10:02:42','2021-09-07 10:02:42'),(446,4,'08:30:00','12:00:00','2021-09-07 10:02:42','2021-09-07 10:02:42'),(447,5,'08:30:00','12:00:00','2021-09-07 10:02:42','2021-09-07 10:02:42'),(448,1,'08:30:00','12:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(449,1,'14:00:00','18:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(450,2,'08:30:00','12:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(451,2,'13:00:00','18:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(452,3,'08:30:00','12:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(453,3,'14:00:00','18:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(454,4,'08:30:00','12:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(455,4,'13:00:00','18:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(456,5,'08:30:00','12:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(457,5,'13:00:00','18:00:00','2021-09-07 10:28:02','2021-09-07 10:28:02'),(458,1,'08:30:00','10:30:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(459,2,'08:30:00','10:30:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(460,3,'08:30:00','10:30:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(461,4,'08:30:00','10:30:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(462,5,'08:30:00','10:30:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(463,6,'08:30:00','10:30:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(464,6,'12:00:00','12:45:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(465,7,'08:30:00','10:30:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(466,7,'12:00:00','12:45:00','2021-09-07 10:34:27','2021-09-07 10:34:27'),(467,1,'08:30:00','11:00:00','2021-09-07 11:14:53','2021-09-07 11:14:53'),(468,2,'08:30:00','11:00:00','2021-09-07 11:14:53','2021-09-07 11:14:53'),(469,3,'08:30:00','11:00:00','2021-09-07 11:14:53','2021-09-07 11:14:53'),(470,4,'08:30:00','11:00:00','2021-09-07 11:14:53','2021-09-07 11:14:53'),(471,5,'08:30:00','11:00:00','2021-09-07 11:14:53','2021-09-07 11:14:53'),(472,6,'09:00:00','11:00:00','2021-09-07 11:14:53','2021-09-07 11:14:53'),(479,1,'11:45:00','12:30:00','2021-09-08 14:14:16','2021-09-08 14:14:16'),(480,2,'11:45:00','12:30:00','2021-09-08 14:14:16','2021-09-08 14:14:16'),(481,3,'11:45:00','12:30:00','2021-09-08 14:14:16','2021-09-08 14:14:16'),(482,4,'11:45:00','12:30:00','2021-09-08 14:14:16','2021-09-08 14:14:16'),(483,5,'11:45:00','12:30:00','2021-09-08 14:14:16','2021-09-08 14:14:16'),(487,1,'11:45:00','12:30:00','2021-09-08 15:10:03','2021-09-08 15:10:03'),(488,1,'19:00:00','19:45:00','2021-09-08 15:10:03','2021-09-08 15:10:03'),(489,2,'11:45:00','12:30:00','2021-09-08 15:10:03','2021-09-08 15:10:03'),(490,3,'11:45:00','12:30:00','2021-09-08 15:10:03','2021-09-08 15:10:03'),(491,4,'11:45:00','12:30:00','2021-09-08 15:10:03','2021-09-08 15:10:03'),(492,5,'11:45:00','12:30:00','2021-09-08 15:10:03','2021-09-08 15:10:03'),(493,1,'19:00:00','21:00:00','2021-09-08 15:13:13','2021-09-08 15:13:13'),(494,2,'19:00:00','21:00:00','2021-09-08 15:13:13','2021-09-08 15:13:13'),(495,3,'19:00:00','21:00:00','2021-09-08 15:13:13','2021-09-08 15:13:13'),(496,4,'19:00:00','21:00:00','2021-09-08 15:13:13','2021-09-08 15:13:13'),(497,5,'19:00:00','21:00:00','2021-09-08 15:13:13','2021-09-08 15:13:13'),(498,6,'19:00:00','21:00:00','2021-09-08 15:13:13','2021-09-08 15:13:13'),(499,7,'19:00:00','21:00:00','2021-09-08 15:13:13','2021-09-08 15:13:13'),(500,2,'19:00:00','20:30:00','2021-09-08 15:17:18','2021-09-08 15:17:18'),(501,3,'19:00:00','20:30:00','2021-09-08 15:17:18','2021-09-08 15:17:18'),(502,4,'19:00:00','20:30:00','2021-09-08 15:17:18','2021-09-08 15:17:18'),(503,4,'19:00:00','20:30:00','2021-09-08 15:17:18','2021-09-08 15:17:18'),(504,5,'19:00:00','20:30:00','2021-09-08 15:17:18','2021-09-08 15:17:18'),(505,6,'19:00:00','20:30:00','2021-09-08 15:17:18','2021-09-08 15:17:18'),(506,2,'19:00:00','20:30:00','2021-09-08 15:20:38','2021-09-08 15:20:38'),(507,4,'19:00:00','20:30:00','2021-09-08 15:20:38','2021-09-08 15:20:38'),(508,1,'18:00:00','20:00:00','2021-09-08 15:27:57','2021-09-08 15:27:57'),(509,2,'13:00:00','16:00:00','2021-09-08 16:07:38','2021-09-17 14:24:48'),(510,4,'13:00:00','16:00:00','2021-09-08 16:07:38','2021-09-17 14:24:48'),(511,5,'13:00:00','16:00:00','2021-09-08 16:07:38','2021-09-17 14:24:48'),(512,1,'14:00:00','16:30:00','2021-09-08 16:09:49','2021-09-17 14:23:05'),(513,2,'10:00:00','12:30:00','2021-09-08 16:09:49','2021-09-17 14:23:05'),(514,2,'14:00:00','16:30:00','2021-09-08 16:09:49','2021-09-17 14:23:05'),(515,4,'10:00:00','12:00:00','2021-09-08 16:09:49','2021-09-17 14:23:05'),(516,2,'08:30:00','12:30:00','2021-09-08 16:38:28','2021-09-08 16:38:28'),(517,2,'13:30:00','16:30:00','2021-09-08 16:38:28','2021-09-08 16:38:28'),(518,4,'08:30:00','12:30:00','2021-09-08 16:38:28','2021-09-08 16:38:28'),(519,4,'13:30:00','16:30:00','2021-09-08 16:38:28','2021-09-08 16:38:28'),(524,1,'13:30:00','16:00:00','2021-09-16 11:48:10','2021-09-16 11:48:10'),(525,2,'09:00:00','11:30:00','2021-09-16 11:48:10','2021-09-16 11:48:10'),(526,1,'14:00:00','17:00:00','2021-09-16 11:51:29','2021-09-16 11:51:29'),(527,2,'09:00:00','12:00:00','2021-09-16 11:51:29','2021-09-16 11:51:29'),(528,2,'14:00:00','17:00:00','2021-09-16 11:51:29','2021-09-16 11:51:29'),(529,4,'09:00:00','11:30:00','2021-09-16 11:54:36','2021-09-16 11:54:36'),(530,5,'09:00:00','11:30:00','2021-09-16 11:54:36','2021-09-16 11:54:36'),(531,3,'08:30:00','11:30:00','2021-09-16 11:57:19','2021-09-16 11:57:19'),(532,5,'08:30:00','11:30:00','2021-09-16 11:58:02','2021-09-16 11:58:02'),(533,6,'08:30:00','11:30:00','2021-09-16 11:58:02','2021-09-16 11:58:02'),(534,2,'08:30:00','12:30:00','2021-09-16 12:12:06','2021-09-16 12:12:06'),(535,2,'13:30:00','16:30:00','2021-09-16 12:12:06','2021-09-16 12:12:06'),(536,4,'08:30:00','12:30:00','2021-09-16 12:12:06','2021-09-16 12:12:06'),(537,4,'13:30:00','16:30:00','2021-09-16 12:12:06','2021-09-16 12:12:06'),(538,1,'13:30:00','16:00:00','2021-09-16 12:13:48','2021-09-16 12:13:48'),(539,4,'13:30:00','16:00:00','2021-09-16 12:13:48','2021-09-16 12:13:48'),(540,2,'09:30:00','12:00:00','2021-09-16 12:21:29','2021-09-16 12:21:29'),(541,3,'14:00:00','17:00:00','2021-09-16 12:21:29','2021-09-16 12:21:29'),(542,4,'14:00:00','17:00:00','2021-09-16 12:21:29','2021-09-16 12:21:29'),(543,5,'09:30:00','12:00:00','2021-09-16 12:21:29','2021-09-16 12:21:29'),(544,3,'14:00:00','17:00:00','2021-09-16 12:22:53','2021-09-16 12:22:53'),(545,1,'14:00:00','17:00:00','2021-09-16 12:30:00','2021-09-16 12:30:00'),(546,2,'14:00:00','17:00:00','2021-09-16 12:30:00','2021-09-16 12:30:00'),(547,4,'14:00:00','17:00:00','2021-09-16 12:30:00','2021-09-16 12:30:00'),(548,5,'10:00:00','12:00:00','2021-09-16 12:30:00','2021-09-16 12:30:00'),(549,5,'14:00:00','17:00:00','2021-09-16 12:30:00','2021-09-16 12:30:00'),(550,1,'14:00:00','17:30:00','2021-09-16 12:33:58','2021-09-16 12:33:58'),(551,3,'14:00:00','17:30:00','2021-09-16 12:33:58','2021-09-16 12:33:58'),(552,5,'14:00:00','17:30:00','2021-09-16 12:33:58','2021-09-16 12:33:58'),(553,1,'09:00:00','12:00:00','2021-09-16 12:43:55','2021-09-16 12:43:55'),(554,3,'09:00:00','12:00:00','2021-09-16 12:43:55','2021-09-16 12:43:55'),(555,1,'08:30:00','11:00:00','2021-09-16 12:46:41','2021-09-16 12:46:41'),(556,2,'08:30:00','11:00:00','2021-09-16 12:46:41','2021-09-16 12:46:41'),(557,4,'08:30:00','11:00:00','2021-09-16 12:46:41','2021-09-16 12:46:41'),(558,5,'08:30:00','11:00:00','2021-09-16 12:46:41','2021-09-16 12:46:41'),(559,2,'09:00:00','12:00:00','2021-09-16 12:50:02','2021-09-16 12:50:02'),(560,4,'09:00:00','12:00:00','2021-09-16 12:50:02','2021-09-16 12:50:02'),(561,1,'09:00:00','16:00:00','2021-09-16 12:52:34','2021-09-16 12:52:34'),(562,2,'09:00:00','16:00:00','2021-09-16 12:52:34','2021-09-16 12:52:34'),(563,3,'09:00:00','16:00:00','2021-09-16 12:52:34','2021-09-16 12:52:34'),(564,4,'09:00:00','12:00:00','2021-09-16 12:52:34','2021-09-16 12:52:34'),(565,5,'09:00:00','16:00:00','2021-09-16 12:52:34','2021-09-16 12:52:34'),(566,1,'09:00:00','16:00:00','2021-09-16 12:56:58','2021-09-16 12:56:58'),(567,2,'09:00:00','16:00:00','2021-09-16 12:56:58','2021-09-16 12:56:58'),(568,3,'09:00:00','12:00:00','2021-09-16 12:56:58','2021-09-16 12:56:58'),(569,4,'09:00:00','16:00:00','2021-09-16 12:56:58','2021-09-16 12:56:58'),(570,5,'09:00:00','16:00:00','2021-09-16 12:56:58','2021-09-16 12:56:58'),(571,4,'19:00:00','20:30:00','2021-09-16 15:05:00','2021-09-16 15:05:00'),(572,1,'09:00:00','16:30:00','2021-09-16 15:19:48','2021-09-16 15:19:48'),(573,2,'09:00:00','16:30:00','2021-09-16 15:19:48','2021-09-16 15:19:48'),(574,3,'09:00:00','16:30:00','2021-09-16 15:19:48','2021-09-16 15:19:48'),(575,4,'09:00:00','19:00:00','2021-09-16 15:19:48','2021-09-16 15:19:48'),(576,5,'09:00:00','16:30:00','2021-09-16 15:19:48','2021-09-16 15:19:48'),(577,1,'09:00:00','13:00:00','2021-09-16 16:18:45','2021-09-16 16:18:45'),(578,2,'09:00:00','13:00:00','2021-09-16 16:18:45','2021-09-16 16:18:45'),(579,3,'09:00:00','13:00:00','2021-09-16 16:18:45','2021-09-16 16:18:45'),(580,4,'09:00:00','13:00:00','2021-09-16 16:18:45','2021-09-16 16:18:45'),(581,5,'09:00:00','13:00:00','2021-09-16 16:18:45','2021-09-16 16:18:45'),(582,1,'09:30:00','12:30:00','2021-09-16 16:22:46','2021-09-16 16:22:46'),(583,2,'09:30:00','12:30:00','2021-09-16 16:22:46','2021-09-16 16:22:46'),(584,3,'09:30:00','12:30:00','2021-09-16 16:22:46','2021-09-16 16:22:46'),(585,4,'09:30:00','12:30:00','2021-09-16 16:22:46','2021-09-16 16:22:46'),(586,5,'09:30:00','12:30:00','2021-09-16 16:22:46','2021-09-16 16:22:46'),(587,6,'10:30:00','13:00:00','2021-09-16 16:22:46','2021-09-16 16:22:46'),(588,7,'10:30:00','13:00:00','2021-09-16 16:22:46','2021-09-16 16:22:46'),(589,1,'09:30:00','12:00:00','2021-09-16 16:31:17','2021-09-16 16:31:17'),(590,2,'09:00:00','12:00:00','2021-09-16 16:31:17','2021-09-16 16:31:17'),(591,2,'13:30:00','17:00:00','2021-09-16 16:31:17','2021-09-16 16:31:17'),(592,3,'13:30:00','17:00:00','2021-09-16 16:31:17','2021-09-16 16:31:17'),(593,4,'13:30:00','17:00:00','2021-09-16 16:31:17','2021-09-16 16:31:17'),(594,5,'13:30:00','17:00:00','2021-09-16 16:31:17','2021-09-16 16:31:17'),(595,4,'14:00:00','16:30:00','2021-09-17 14:23:05','2021-09-17 14:23:05'),(596,2,'09:00:00','11:30:00','2021-09-17 14:29:14','2021-09-17 14:29:14'),(597,2,'13:30:00','16:00:00','2021-09-17 14:29:14','2021-09-17 14:29:14'),(598,3,'13:30:00','16:00:00','2021-09-17 14:29:14','2021-09-17 14:29:14'),(599,5,'09:00:00','11:30:00','2021-09-17 14:29:14','2021-09-17 14:29:14'),(600,5,'13:30:00','16:00:00','2021-09-17 14:29:14','2021-09-17 14:29:14'),(601,3,'10:00:00','12:30:00','2021-09-17 14:31:01','2021-09-17 14:31:01'),(602,3,'13:00:00','16:00:00','2021-09-17 14:31:01','2021-09-17 14:31:01'),(603,4,'10:00:00','12:30:00','2021-09-17 14:31:01','2021-09-17 14:31:01'),(604,4,'13:00:00','16:00:00','2021-09-17 14:31:01','2021-09-17 14:31:01');
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
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordre` int(10) unsigned DEFAULT '999',
  `logo_filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_52743D7BBCF5E72D` (`categorie_id`),
  CONSTRAINT `FK_52743D7BBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sous_categorie`
--

LOCK TABLES `sous_categorie` WRITE;
/*!40000 ALTER TABLE `sous_categorie` DISABLE KEYS */;
INSERT INTO `sous_categorie` VALUES (7,11,'Repas midi',999,'00b43497560b5f0f7296a2594e6258489ebea793.jpeg','0000-00-00 00:00:00','2021-11-05 15:17:18'),(9,11,'Colis alimentaire',999,NULL,'0000-00-00 00:00:00','2021-10-29 23:34:53'),(10,11,'Epicerie sociale',999,NULL,'0000-00-00 00:00:00','2021-10-22 17:04:18'),(11,26,'Toilettes gratuites',999,NULL,'0000-00-00 00:00:00','2021-10-29 23:33:02'),(12,26,'Douche',999,NULL,'0000-00-00 00:00:00','2021-10-29 23:46:39'),(13,12,'Tampons / Serviettes',999,NULL,'0000-00-00 00:00:00','2021-10-28 22:10:21'),(14,12,'Produits d\'hygiène',999,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,21,'Contraception (pilule, préservatif, etc.)',999,NULL,'0000-00-00 00:00:00','2021-10-20 15:39:54'),(16,12,'Masque',999,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,12,'Gel hydroalcoolique',999,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,12,'Machine à laver',999,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,16,'être accompagné',999,NULL,'0000-00-00 00:00:00','2021-10-29 23:33:57'),(25,16,'Croquettes',999,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,16,'Chenil',999,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,17,'Wifi gratuite',999,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,17,'Accès ordinateur',999,NULL,'0000-00-00 00:00:00','2021-11-05 15:18:16'),(29,18,'Refaire sa carte d\'identité',999,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(30,18,'Domiciliation postale',999,NULL,'0000-00-00 00:00:00','2021-10-22 17:05:28'),(31,18,'Demande de RSA',999,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,18,'Demande d\'asile/ Titre de séjour',999,NULL,'0000-00-00 00:00:00','2021-10-25 12:23:31'),(33,19,'Cours de français',999,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(34,19,'Cours d\'alphabétisation',999,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(36,15,'Bagagerie',999,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(37,11,'Petit-déjeuner',999,NULL,'0000-00-00 00:00:00','2021-10-28 22:08:10'),(38,11,'Repas soir',999,NULL,'0000-00-00 00:00:00','2021-11-05 15:18:39'),(39,21,'Soin gratuit',999,NULL,'0000-00-00 00:00:00','2021-10-25 12:19:24'),(40,21,'Psychologue gratuit',999,NULL,'0000-00-00 00:00:00','2021-10-29 23:36:00'),(41,21,'Ostéopathe gratuit',999,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(42,21,'Soin dentaire',999,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(43,21,'Dépistage / Vaccination',1,NULL,'0000-00-00 00:00:00','2021-10-29 23:36:57'),(44,25,'Distribution de matériel',NULL,NULL,'2021-10-22 16:20:04','2021-10-28 22:13:04'),(45,25,'Matériel d\'injection en pharmacie',NULL,NULL,'2021-10-22 16:20:41','2021-10-29 23:44:42'),(46,25,'Antenne méthadone',NULL,NULL,'2021-10-22 16:21:08','2021-10-29 23:45:13'),(47,25,'Etre accompagné',NULL,NULL,'2021-10-22 16:21:22','2021-10-22 16:21:22'),(48,24,'Produits bébés',NULL,NULL,'2021-10-22 16:23:08','2021-10-29 23:37:31'),(49,18,'Aide administrative',1,NULL,'2021-10-22 16:30:11','2021-10-26 16:49:12'),(50,25,'Accueil de jour',NULL,NULL,'2021-10-22 16:48:11','2021-10-29 23:36:29'),(51,25,'Petits-déjeuners',NULL,NULL,'2021-10-22 16:48:34','2021-10-22 16:48:34'),(52,25,'Aide administrative',NULL,NULL,'2021-10-22 16:49:58','2021-10-28 22:14:49'),(53,25,'Colis alimentaire',NULL,NULL,'2021-10-22 16:52:01','2021-10-29 23:45:30'),(54,25,'Domiciliation postale',NULL,NULL,'2021-10-22 16:52:21','2021-10-22 16:52:21'),(55,21,'Avoir une sécurité sociale',NULL,NULL,'2021-10-22 17:03:23','2021-10-22 17:03:23'),(56,17,'Point WiFi',NULL,NULL,'2021-10-29 23:53:44','2021-10-29 23:53:44'),(57,22,'Vestiboutique',NULL,NULL,'2021-10-31 12:07:00','2021-10-31 12:07:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'admin','admin','info@connectx.fr','info@connectx.fr',0,'JbwdZzOI2hWcYPOfvX1lzaTLIBOE..DvhKKw.oMNA2w','$2y$13$QqYYJ8Jma1Lik/5KwRSgnOBAdHLDTIZdl0i9Bg.GRmoaWTcywCPje','2021-09-17 16:26:51',NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}',NULL,NULL,NULL,NULL,NULL,0,'2021-01-07 16:56:20','2021-09-17 16:28:01'),(4,'admin2','admin2','connectx.fr','connectx.fr',1,'AXC0kCxtye72884VYOQEj.OM9b4rYupCn/WY0IjLaeE','$2y$13$ltrynAdySvTeo9Pl4/CdJumttjXjr9tTPQJcXL3vrI0EW6hc2Dxt.','2021-11-12 07:39:24',NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}',NULL,NULL,NULL,NULL,NULL,0,'2021-09-17 16:23:50','2021-11-12 07:39:24');
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

-- Dump completed on 2021-11-12  6:51:02
