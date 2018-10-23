-- MySQL dump 10.16  Distrib 10.3.8-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: d_task_tracker_adv
-- ------------------------------------------------------
-- Server version	10.3.8-MariaDB-1:10.3.8+maria~bionic-log

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
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('admin',1,'Admin','whichUserGroupAndTeam',NULL,1530616321,1530616321),('assignee',1,'Assignee','whichUserGroupAndTeam',NULL,1530616322,1530616322),('createProfile',2,'Create profile',NULL,NULL,1530616321,1530616321),('createTask',2,'Create task',NULL,NULL,1530616321,1530616321),('createUser',2,'Create user',NULL,NULL,1530616321,1530616321),('deleteProfile',2,'Delete profile',NULL,NULL,1530616321,1530616321),('deleteTask',2,'Delete task',NULL,NULL,1530616321,1530616321),('deleteUser',2,'Delete user',NULL,NULL,1530616321,1530616321),('readProfile',2,'Read user`s profile',NULL,NULL,1530616321,1530616321),('readTask',2,'Read task description',NULL,NULL,1530616321,1530616321),('readUser',2,'Read user`s data',NULL,NULL,1530616321,1530616321),('teamlead',1,'Teamlead','whichUserGroupAndTeam',NULL,1530616321,1530616321),('updateOwnProfile',2,'Update own profile','isProfileOwner',NULL,1530616321,1530616321),('updateProfile',2,'Update profile',NULL,NULL,1530616321,1530616321),('updateTask',2,'Update task',NULL,NULL,1530616321,1530616321),('updateUser',2,'Update user`s data',NULL,NULL,1530616321,1530616321),('user',1,'User','whichUserGroupAndTeam',NULL,1530616322,1530616322);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('admin','createProfile'),('admin','createTask'),('admin','createUser'),('admin','deleteProfile'),('admin','deleteTask'),('admin','deleteUser'),('admin','readProfile'),('admin','readTask'),('admin','readUser'),('admin','updateProfile'),('admin','updateTask'),('admin','updateUser'),('assignee','createProfile'),('assignee','readProfile'),('assignee','readTask'),('assignee','readUser'),('assignee','updateOwnProfile'),('teamlead','createProfile'),('teamlead','createTask'),('teamlead','createUser'),('teamlead','deleteProfile'),('teamlead','deleteTask'),('teamlead','deleteUser'),('teamlead','readProfile'),('teamlead','readTask'),('teamlead','readUser'),('teamlead','updateProfile'),('teamlead','updateTask'),('teamlead','updateUser'),('updateOwnProfile','updateProfile'),('user','readTask');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
INSERT INTO `auth_rule` VALUES ('isProfileOwner','O:23:\"common\\rbac\\ProfileRule\":3:{s:4:\"name\";s:14:\"isProfileOwner\";s:9:\"createdAt\";i:1530616321;s:9:\"updatedAt\";i:1530616321;}',1530616321,1530616321),('whichUserGroupAndTeam','O:25:\"common\\rbac\\UserGroupRule\":3:{s:4:\"name\";s:21:\"whichUserGroupAndTeam\";s:9:\"createdAt\";i:1530616321;s:9:\"updatedAt\";i:1530616321;}',1530616321,1530616321);
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(3) DEFAULT 10,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comment__task_idx` (`task_id`),
  CONSTRAINT `fk_comment__task` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,6,'Hello!\r\nI made it - `Introduce new local schema for project`.\r\n\r\nNel',10,'2018-06-29 13:01:10','2018-06-29 13:01:10'),(2,6,'Hello!\r\n  This is a difficult task can you make a clue for me.\r\nDarn Nel',10,'2018-06-29 13:44:10','2018-06-29 13:44:10');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` VALUES (1,'admin','Powerful admin','2018-07-03 10:23:33','2018-07-03 10:23:36'),(2,'teamlead','Powerful teamlead','2018-07-03 10:25:58','2018-07-03 10:26:00'),(3,'assignee','Professional assignee','2018-07-03 10:27:42','2018-07-03 10:27:45'),(4,'user','Simple user','2018-07-03 10:28:17','2018-07-03 10:28:20');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('common\\migrations\\m180626_174523_create_task_table',1530027016),('common\\migrations\\M180629112806_create_users_profile_table',1530273973),('common\\migrations\\M180629142010Add_column_status_to_users_profile_table',1530283378),('common\\migrations\\M180703064257Create_group_table',1530602035),('common\\migrations\\M180703064324Create_team_table',1530602035),('common\\migrations\\M180703064403Create_user_team_group_table',1530602037),('frontend\\migrations\\M180628180246_create_comment_table',1530209573),('m000000_000000_base',1529754323),('m130524_201442_init',1529754332),('m140506_102106_rbac_init',1530552867),('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1530552868);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `assignee_id` int(11) DEFAULT NULL,
  `teamlead_id` int(11) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `status` tinyint(3) DEFAULT 0,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_task__user_assignee_idx` (`assignee_id`),
  KEY `fk_task__user_teamlead_idx` (`teamlead_id`),
  CONSTRAINT `fk_task__user_assignee` FOREIGN KEY (`assignee_id`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_task__user_teamlead` FOREIGN KEY (`teamlead_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,'Reintermediate front-end web services',11,2,'2018-06-20 10:00:00','2018-07-20 10:00:00',NULL,10,'Energize compelling paradigms. Start new level web services. Search new paradigms.','2018-06-19 19:45:48','2018-06-26 19:45:52'),(2,'	Innovate B2C platforms',10,2,'2018-06-10 10:00:00','2018-08-10 10:00:00',NULL,10,'Unleash user-centric relationships. New relationships. Invent some new.','2018-06-09 19:45:48','2018-06-26 19:45:52'),(3,'Maximize open-source niches',9,2,'2018-06-11 10:00:00','2018-09-11 10:00:00',NULL,10,'Maximize front-end ROI','2018-06-09 19:45:48','2018-06-26 19:45:52'),(4,'Aggregate synergistic vortals',8,2,'2018-06-12 10:00:00','2018-08-12 10:00:00',NULL,10,'Brand e-business synergies','2018-06-09 19:45:48','2018-06-26 19:45:52'),(5,'Evolve global schemas',7,3,'2018-05-13 10:00:00','2018-06-28 10:00:00',NULL,10,'Enable leading-edge technologies','2018-06-09 19:45:48','2018-06-26 19:45:52'),(6,'Intreduce local schemas',7,3,'2018-06-23 10:00:00','2018-07-23 10:00:00',NULL,10,'Intreduce local schemas with new future','2018-06-09 19:45:48','2018-06-26 19:45:52'),(7,'Disintermediate world-class experiences',6,3,'2018-06-24 10:00:00','2018-08-24 10:00:00',NULL,10,'Utilize dynamic e-services','2018-06-09 19:45:48','2018-06-26 19:45:52'),(8,'Engineer rich interfaces',5,4,'2018-06-25 10:00:00','2018-08-25 10:00:00',NULL,10,'Exploit back-end partnerships','2018-06-09 19:45:48','2018-06-26 19:45:52'),(9,'Mesh enterprise e-markets',12,4,'2018-06-24 10:00:00','2018-08-24 10:00:00',NULL,10,'Syndicate ubiquitous paradigms','2018-06-09 19:45:48','2018-06-26 19:45:52'),(10,'Strategize seamless metrics',12,4,'2018-08-24 10:00:00','2018-09-24 10:00:00',NULL,10,'Leverage one-to-one bandwidth','2018-06-09 19:45:48','2018-06-26 19:45:52'),(11,'Monetize transparent paradigms',13,4,'2018-06-20 10:00:00','2018-09-20 10:00:00',NULL,10,'Drive transparent partnerships','2018-06-09 19:45:48','2018-06-26 19:45:52'),(12,'Clean mass',14,4,'2018-06-20 10:00:00','2018-07-20 10:00:00',NULL,10,'Drive partnerships','2018-06-09 19:45:48','2018-06-26 19:45:52');
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` VALUES (1,'Big web','Web developers','2018-07-03 10:18:44','2018-07-03 10:18:59'),(2,'Intelligent soft','Soft developers','2018-07-03 10:21:30','2018-07-03 10:21:33'),(3,'Driving mobile','Mobile developres','2018-07-03 10:22:19','2018-07-03 10:22:22'),(4,'Administrators','Administrators','2018-07-03 10:31:51','2018-07-03 10:31:54'),(5,'Newcomers','Default for new users','2018-07-04 17:46:43','2018-07-04 17:46:45');
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','tfDMWhI4zoMaeLZcCudZJPEGeM6B57w5','$2y$13$p9/2VJsBO8mjTvMaLwEF9.lp5EDTRQSG4YueQEtGQV30tYdOX29mu',NULL,'admin@tt.com',10,1530723505,1530723505),(2,'adlai_ludovici','OWxUPCLXPSx4mAxkh4qJ7rOJYq0pJUpj','$2y$13$sXc0F0pZ41vIJ3lumomYPuE57s1/T.9dOF7.MsF5BtO39X1lJ2CJu',NULL,'aludovici0@tt.org',10,1530724575,1530724575),(3,'valle_tetford','58qJ9ayK0bR8iAOS6uJfbzgrD__qDOvD','$2y$13$fIJiIWeFb8TDiW98lnKOEONB6j5.b2vSqg7IeBGhxLiJNtKkcgVme',NULL,'vtetford1@umich.edu',10,1530725076,1530725076),(4,'valencia_sewell','B8UTx2T3Me66mcvXsT3vlcXhjDrew3Y-','$2y$13$uvULtoFLQiwhKfkiICgxX.tW15zs5K5b7Nu9O/ze0GCS6UUPN/DKS',NULL,'vsewell2@google.com.br',10,1530729422,1530729422),(5,'nonna_axup','uTI2YsAZ4AvhiYxRPbyoaFnMS9U8HEmV','$2y$13$yBS7jPK2Uwn2/dCe.fUmNO7Op7gNWctMTSYYDbgceZO2T5Eeyjsb.',NULL,'naxup3@fda.org',10,1530731475,1530731475),(6,'darn_nel','lLb40zqYndUYIVyn-RREAnBUZxYDaeCA','$2y$13$7ROJXpb6mWj.rO.IFktoCeJ3gCJ9Zxz5sSBC0I6Xyjnd6rFS4OonK',NULL,'dnel4@adobe.com',10,1530733282,1530733282),(7,'tiffany_clace','7crXzkNhu1nv22QAi1SD8OkXO5NmRjYh','$2y$13$/CQgEWghaKPHnV7eH.JlkeSFPumF6/XJ8/sDsxwq33Pq6hB.Y/sHO',NULL,'tclace5@mayoclinic.com',10,1530735345,1530735345),(8,'rafaello_coe','nnHDUpU4iza9L45wCyJCPlQau-QzVa5e','$2y$13$PjAZS6ya1AQNUg7xedReduvlo5UHBiXXHFP/XEC5kQNzLf3Qk1BTe',NULL,'rcoe6@paypal.com',10,1530735481,1530735481),(9,'emalia_wattam','uSBkyWk9gXEYaZU1cJ_7XQIYgVZS__kd','$2y$13$1Kdtks6KphyNTf7.Lu04bekTrbYXNIFKH4h/S4DHgf2Se7QzDYgRm',NULL,'ewattam7@google.cn',10,1530769773,1530769773),(10,'marjie_laurant','3mbCDA6JRhA4BUR9nQvGDbqE3bw2evbW','$2y$13$LBxPi8i66NqISiFN605Rru6vDtvcvtWGpxFEuq192m8qyy50l/WgC',NULL,'mlaurant8@microsoft.com',10,1530770013,1530770013),(11,'benita_kindred','5X67RxCsm8xWQKN49pGmLb8YBNNdTvqZ','$2y$13$T8Itul.3.Gti.n7tWixpyOd29QwUaCUbuAZywrBLcGJvvOSuEV3xK',NULL,'bkindred9@bing.com',10,1530770476,1530770476),(12,'kylan_bennett','RRZF3ZYtYUnogIEaczTPuQfm8s4M2_tc','$2y$13$r/uo2bV5hHyOczixEF.Fq.lNTVwoIFbRWbh823xm.//uAm.uYy4Xi',NULL,'kylan_bennett@tt.org',10,1530772502,1530772502),(13,'martina_shepard','2bMsWZGOSGWV4ESFl8ShKLB_o9E-SBZU','$2y$13$NoRpugBk1YkiiPmJ1dQiyubww84e54D6LNj7HQEmqWx6R6T.ZJcFW',NULL,'martina_shepard@tt.org',10,1530772628,1530772628),(14,'cade_mcguire','SeZ1dfPZj5BpwHliEZ8nIQiuWHsga_rD','$2y$13$6hgFldkIeMqwhcp9MeQsTepaP3bf.K3ZoV6zQmGxgR/OFDZUtYWUC',NULL,'cade_mcguire@tt.org',10,1530772720,1530772720),(15,'alfonso_brennan','PKs6WCjKfl5ud7ZNkifXWPaHPkgrq3pr','$2y$13$l98msct6c9VL9Ic8UM5jvO3nIR96jO5BrfNwJR04793oddGZ7KpGC',NULL,'alfonso_brennan@tt.org',10,1530773470,1530773470);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_team_group`
--

DROP TABLE IF EXISTS `user_team_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_team_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user__user_team_group_idx` (`user_id`),
  KEY `fk_group__user_team_group_idx` (`group_id`),
  KEY `fk_team__user_team_group_idx` (`team_id`),
  CONSTRAINT `fk_group__user_team_group` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`),
  CONSTRAINT `fk_team__user_team_group` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`),
  CONSTRAINT `fk_user__user_team_group` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_team_group`
--

LOCK TABLES `user_team_group` WRITE;
/*!40000 ALTER TABLE `user_team_group` DISABLE KEYS */;
INSERT INTO `user_team_group` VALUES (1,1,1,4),(2,2,1,4),(3,3,2,1),(4,4,2,2),(5,5,2,3),(6,6,3,1),(7,7,3,1),(8,8,3,1),(9,9,3,2),(10,10,3,2),(11,11,3,2),(12,12,3,3),(13,13,3,3),(14,14,3,3),(15,9,4,5),(16,10,4,5),(17,11,4,5),(18,12,4,5),(19,13,4,5),(20,14,4,5),(21,15,4,5);
/*!40000 ALTER TABLE `user_team_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_profile`
--

DROP TABLE IF EXISTS `users_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(124) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(124) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specialization` varchar(124) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` tinyint(3) DEFAULT 1,
  `birthday` date DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(64) COLLATE utf8_unicode_ci DEFAULT 'Russia',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(3) DEFAULT 10,
  PRIMARY KEY (`id`),
  KEY `fk_user__users_profile_idx` (`user_id`),
  CONSTRAINT `fk_user__users_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_profile`
--

LOCK TABLES `users_profile` WRITE;
/*!40000 ALTER TABLE `users_profile` DISABLE KEYS */;
INSERT INTO `users_profile` VALUES (1,2,'Benita','Kindred','Web developer',0,'1970-05-12','+11-810-452-45-78','01_women.jpg','UK','2018-06-29 20:04:04','2018-06-29 20:04:59',10),(2,3,' Marjie','Laurant','Web developer. Frontend',0,'1978-06-17','+4-510-752-41-72','05_women.jpg','Czech Republic','2018-07-01 15:59:06','2018-07-01 15:59:08',10),(3,14,'Cade','Mcguire','Not set',1,'3000-01-01','+00-000-000-00-01','10_man.jpg','Not set','2018-07-05 09:38:40','2018-07-05 09:38:40',10),(4,15,'Alfonso','Brennan','Not set',1,'3000-01-01','+00-000-000-00-01','10_man.jpg','Not set','2018-07-05 09:51:10','2018-07-05 09:51:10',10);
/*!40000 ALTER TABLE `users_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'd_task_tracker_adv'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-05 12:47:36
