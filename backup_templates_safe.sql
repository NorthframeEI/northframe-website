-- MySQL dump 10.13  Distrib 9.6.0, for macos14.8 (x86_64)
--
-- Host: localhost    Database: northframe
-- ------------------------------------------------------
-- Server version	9.6.0

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
-- Table structure for table `templates`
--

DROP TABLE IF EXISTS `templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `templates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_description` text COLLATE utf8mb4_unicode_ci,
  `thumbnail_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `html_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `js_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `position` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `templates_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `templates`
--

LOCK TABLES `templates` WRITE;
/*!40000 ALTER TABLE `templates` DISABLE KEYS */;
INSERT INTO `templates` VALUES (7,'saas-flow','SaaSFlow','Landing Page SaaS','Une landing page SaaS moderne et premium pensée pour convertir les visiteurs en utilisateurs.','SaaSFlow est une landing page premium conçue pour les entreprises SaaS, startups et produits digitaux souhaitant présenter leur offre de manière claire et convaincante.\r\n\r\nLa structure du template met l\'accent sur la proposition de valeur dès les premières secondes, avec un hero impactant, des preuves sociales, une présentation détaillée des fonctionnalités, un parcours utilisateur simplifié et des appels à l\'action stratégiquement positionnés.\r\n\r\nPensé pour maximiser les conversions, SaaSFlow permet de mettre en avant les bénéfices de votre produit tout en rassurant vos visiteurs grâce à des témoignages, des indicateurs de performance et une FAQ complète.\r\n\r\nLe template est entièrement responsive et peut être personnalisé facilement afin de s\'adapter à votre identité visuelle, votre contenu et vos objectifs commerciaux.','templates/saas-flow/card.webp','templates/saas-flow/hero.webp','templates/saas-flow/source/index.html','templates/saas-flow/source/style.css','templates/saas-flow/source/script.js',NULL,0,1,0,'2026-06-15 09:45:34','2026-06-16 10:37:27'),(8,'event-flow','Event Flow','Landing Page Événement','Une landing page immersive conçue pour présenter un événement, lancer un produit ou réunir une communauté autour d\'une expérience mémorable.','EventFlow est une landing page premium pensée pour les conférences, événements professionnels, lancements de produits et expériences immersives.\r\n\r\nInspiré des présentations modernes et des événements à fort impact visuel, ce template met l\'accent sur la narration, les chiffres clés et les appels à l\'action stratégiques.\r\n\r\nSa structure minimaliste permet de capter l\'attention dès les premières secondes grâce à un hero imposant, de présenter une vision forte, de détailler le déroulement de l\'événement et de guider naturellement les visiteurs vers l\'inscription.\r\n\r\nEntièrement responsive et facilement personnalisable, EventFlow constitue une base solide pour promouvoir un événement moderne avec une image professionnelle et haut de gamme.','templates/event-flow/card.webp','templates/event-flow/hero.webp','templates/event-flow/source/index.html','templates/event-flow/source/style.css','templates/event-flow/source/script.js',NULL,0,1,0,'2026-06-15 10:33:22','2026-06-16 10:37:35');
/*!40000 ALTER TABLE `templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_sections`
--

DROP TABLE IF EXISTS `template_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `template_sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `template_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `template_sections_template_id_foreign` (`template_id`),
  CONSTRAINT `template_sections_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template_sections`
--

LOCK TABLES `template_sections` WRITE;
/*!40000 ALTER TABLE `template_sections` DISABLE KEYS */;
INSERT INTO `template_sections` VALUES (45,7,'Hero','Présente immédiatement votre proposition de valeur avec un titre impactant, un sous-titre clair et un appel à l\'action orienté conversion.','templates/saas-flow/sections/0-hero.webp',0,'2026-06-16 10:37:27','2026-06-16 10:37:27'),(46,7,'Fonctionnalités','Mettez en avant les fonctionnalités clés de votre produit grâce à des cartes visuelles faciles à parcourir.','templates/saas-flow/sections/1-fonctionnalites.webp',1,'2026-06-16 10:37:27','2026-06-16 10:37:27'),(47,7,'Tarifs','Présentez votre offre de manière claire avec une section tarifaire conçue pour faciliter la prise de décision.','templates/saas-flow/sections/2-tarifs.webp',2,'2026-06-16 10:37:27','2026-06-16 10:37:27'),(48,7,'Faq','Présentez votre offre de manière claire avec une section tarifaire conçue pour faciliter la prise de décision.','templates/saas-flow/sections/3-faq.webp',3,'2026-06-16 10:37:27','2026-06-16 10:37:27'),(49,8,'Hero','Présentez votre événement avec un message fort, une date mise en avant et un appel à l\'action immédiat.','templates/event-flow/sections/0-hero.webp',0,'2026-06-16 10:37:35','2026-06-16 10:37:35'),(50,8,'Impact','Mettez en avant vos chiffres clés grâce à une section conçue pour attirer immédiatement l\'attention.','templates/event-flow/sections/1-impact.webp',1,'2026-06-16 10:37:35','2026-06-16 10:37:35'),(51,8,'Experience','Partagez la vision et les objectifs de votre événement à travers une présentation immersive et engageante.','templates/event-flow/sections/2-experience.webp',2,'2026-06-16 10:37:35','2026-06-16 10:37:35'),(52,8,'Présentation','Valorisez les points forts de votre événement avec des blocs visuels modernes et facilement compréhensibles.','templates/event-flow/sections/3-presentation.webp',3,'2026-06-16 10:37:35','2026-06-16 10:37:35'),(53,8,'Programme','Présentez les différentes étapes de la journée dans une timeline élégante et facile à consulter.','templates/event-flow/sections/4-programme.webp',4,'2026-06-16 10:37:35','2026-06-16 10:37:35'),(54,8,'Chiffres clés','Renforcez la crédibilité de votre événement grâce à des statistiques mises en avant de manière impactante.','templates/event-flow/sections/5-chiffres-cles.webp',5,'2026-06-16 10:37:35','2026-06-16 10:37:35'),(55,8,'CTA','Terminez la page avec un appel à l\'action fort encourageant les visiteurs à réserver leur place.','templates/event-flow/sections/6-cta.webp',6,'2026-06-16 10:37:35','2026-06-16 10:37:35');
/*!40000 ALTER TABLE `template_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_benefits`
--

DROP TABLE IF EXISTS `template_benefits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `template_benefits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `template_id` bigint unsigned NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `position` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `template_benefits_template_id_foreign` (`template_id`),
  CONSTRAINT `template_benefits_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template_benefits`
--

LOCK TABLES `template_benefits` WRITE;
/*!40000 ALTER TABLE `template_benefits` DISABLE KEYS */;
INSERT INTO `template_benefits` VALUES (39,7,NULL,'Conçu pour convertir','Une structure optimisée pour guider naturellement les visiteurs vers l\'inscription ou la prise de contact.',0,'2026-06-16 10:37:27','2026-06-16 10:37:27'),(40,7,NULL,'Présentation claire du produit','Chaque section est pensée pour mettre en avant la valeur de votre solution sans surcharger l\'utilisateur.',1,'2026-06-16 10:37:27','2026-06-16 10:37:27'),(41,7,NULL,'Responsive et moderne','Une expérience fluide sur ordinateur, tablette et mobile avec un design actuel inspiré des meilleurs SaaS.',2,'2026-06-16 10:37:27','2026-06-16 10:37:27'),(42,7,NULL,'Facile à personnaliser','Couleurs, textes, visuels et sections peuvent être adaptés rapidement à votre marque.',3,'2026-06-16 10:37:27','2026-06-16 10:37:27'),(43,7,NULL,'Prêt à être déployé','Une base solide permettant de lancer rapidement une landing page professionnelle sans repartir de zéro.',4,'2026-06-16 10:37:27','2026-06-16 10:37:27'),(44,8,NULL,'Impact visuel immédiat','Des titres imposants et une mise en page immersive conçus pour capter l\'attention dès les premières secondes.',0,'2026-06-16 10:37:35','2026-06-16 10:37:35'),(45,8,NULL,'Pensé pour les événements','Une structure optimisée pour présenter une conférence, un lancement produit ou une expérience professionnelle.',1,'2026-06-16 10:37:35','2026-06-16 10:37:35'),(46,8,NULL,'Expérience premium','Un design moderne inspiré des événements technologiques et des présentations haut de gamme.',2,'2026-06-16 10:37:35','2026-06-16 10:37:35'),(47,8,NULL,'Responsive sur tous les écrans','Une expérience fluide et élégante sur mobile, tablette et ordinateur.',3,'2026-06-16 10:37:35','2026-06-16 10:37:35'),(48,8,NULL,'Facile à personnaliser','Modifiez rapidement les contenus, couleurs et sections afin d\'adapter le template à votre événement.',4,'2026-06-16 10:37:35','2026-06-16 10:37:35');
/*!40000 ALTER TABLE `template_benefits` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-17 13:41:41
