-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: localhost    Database: spgb
-- ------------------------------------------------------
-- Server version	5.6.14

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
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `published` tinyint(4) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_posts_users_idx` (`author_id`),
  CONSTRAINT `fk_posts_users` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (46,14,'Submitbuttons?','It seemed proper for a restless team making a big mess at Research & Develompent Department\'s labs, that doing a full-scale test was the simplest way to learn if the rumours about our submit button really were as clearly idiotic as we told everyone they were. Admittedly, the amount of  times there would be an unlikely new discovery was how we finally concluded that we had to have a live test to really know wheter aur submit button was better than the others. That for some reason ended up raising more questions than answers.',0,'2014-10-18 07:10:47',NULL),(47,14,'Development Team','A group of impeccably-dressed representatives working at Steampilot Software Development Corporation felt clearly sure abut whether while cleaning up afte a possibly not-that-bad software glitch, the intern was pretty much out of options back in his broom cabinet there. We did get some good information on how quickly the coffee gets cold when the mug is filled with hot water instead. Granted, the terrible frequency at which we\'d find ourselfs disproving dubious theories on how some developers don\'t seem eager to take part in our projects as others do was how we got into that situation in the first place. However the case may be, this is where your coffee is spilled.',0,'2014-10-18 07:10:42',NULL),(48,15,'Demonstration Purposes','Originally built as a placeholder for a demonstration mock-up of a hand painted admin panel, the SPGB or Steampilot Guest Book was heralded as a far better and more reliable solution that its predecessors by webdeveloper throughout the comunity. It is now commonly seen in active service.',0,'2014-10-18 07:10:01',NULL),(49,15,'Twittr Bootstrap?','The bootstrap plugin was initially received with some skepticism by web developer amongs the board at Steampilot software science departement. as it defied the long-standing convention tat \"Complex-CODE!\" is always better. Despite this, the bootstrap plugin has found its place in the version controll system of any good developer who actually call him self a genious, being particulary useful at least for coloring the edges of a not over used table.',0,'2014-10-18 08:10:55',NULL),(50,15,'One Page Layout','After an intensive search for an web developer intern wit at least 23 years of not over used experience crazy enough to plan and build a revolutionary new website design, managers turned to renowned developer Jorgun Gwartop, a leader in the fealds of cheating and defying the second law of thermodynamics in his own personal ought to be washed coffe cup, as a last resort. He failed miserably at the job, and this is what we ended up with.',0,'2014-10-18 08:10:54',NULL);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,3,'Administrator','info@steampilot.ch','$2y$10$.K45qikSIM8s47a7E4PZQ.pRXvpEYIlEX.nJyinANqRVsRZFRxS3G','2014-10-18 07:10:15','0000-00-00 00:00:00'),(14,3,'Jérôme Röthlisberger','jerome.roethlisberger@gibmit.ch','$2y$10$jVqm.WM6vDhHiip1PSCAleZd0uFXTlkqJf52ujb5N4z0eU6pRBKXK','2014-10-18 07:10:26','0000-00-00 00:00:00'),(15,3,'Cindy Sterling','cindy2501@steampilot.ch','$2y$10$QH877IRBnYUFdCuRw5B5X.qxBUFS9JwFyfhvffUqcwRyhGCulGMWu','2014-10-18 07:10:45','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-26 21:35:04
