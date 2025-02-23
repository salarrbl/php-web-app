/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.6.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: notes
-- ------------------------------------------------------
-- Server version	11.6.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `completed` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES
(7,8,'rebel','I will become Omniscience','2025-02-23 17:32:46','2025-02-23 17:32:54',1),
(9,8,'rebel','Omniscient','2025-02-23 17:57:01','2025-02-23 17:57:01',0),
(10,8,'rebel','Knowledge is Power','2025-02-23 18:30:00','2025-02-23 18:30:05',1),
(11,8,'rebel','The Path of Enlightenment','2025-02-23 18:45:10','2025-02-23 21:47:08',1),
(12,8,'rebel','Breaking Boundaries','2025-02-23 19:00:30','2025-02-23 19:00:40',1),
(13,8,'rebel','The Pursuit of Knowledge','2025-02-23 19:15:50','2025-02-23 19:15:55',0),
(14,8,'rebel','Unlocking the Secrets','2025-02-23 19:30:00','2025-02-23 19:30:10',1),
(15,8,'rebel','The Infinite Journey','2025-02-23 19:45:20','2025-02-23 19:45:30',0),
(16,8,'rebel','Beyond the Horizon','2025-02-23 20:00:40','2025-02-23 20:00:50',1),
(17,8,'rebel','The Quest for Truth','2025-02-23 20:15:55','2025-02-23 20:16:05',0),
(18,8,'rebel','The Power of Wisdom','2025-02-23 20:30:10','2025-02-23 20:30:20',1),
(19,8,'rebel','The Light of Understanding','2025-02-23 20:45:30','2025-02-23 20:45:40',0),
(20,8,'rebel','The Edge of Reality','2025-02-23 21:00:50','2025-02-23 21:01:00',1),
(21,8,'rebel','The Dawn of Clarity','2025-02-23 21:15:05','2025-02-23 21:15:15',0),
(22,8,'rebel','The Essence of Being','2025-02-23 21:30:20','2025-02-23 21:30:30',1),
(23,8,'rebel','The Core of Existence','2025-02-23 21:45:40','2025-02-23 21:45:50',0),
(24,8,'rebel','The Fabric of Reality','2025-02-23 22:00:55','2025-02-23 22:01:05',1),
(25,8,'rebel','The Threads of Time','2025-02-23 22:15:10','2025-02-23 22:15:20',0),
(26,8,'rebel','The Weave of Destiny','2025-02-23 22:30:30','2025-02-23 22:30:40',1),
(27,8,'rebel','The Tapestry of Life','2025-02-23 22:45:50','2025-02-23 22:46:00',0),
(28,8,'rebel','The Symphony of the Universe','2025-02-23 23:00:05','2025-02-23 23:00:15',1),
(29,8,'rebel','The Harmony of Existence','2025-02-23 23:15:20','2025-02-23 23:15:30',0),
(30,8,'rebel','The Rhythm of Creation','2025-02-23 23:30:40','2025-02-23 23:30:50',1),
(31,8,'rebel','The Pulse of the Cosmos','2025-02-23 23:45:55','2025-02-23 23:46:05',0),
(32,8,'rebel','The Breath of the Infinite','2025-02-24 00:00:10','2025-02-24 00:00:20',1),
(33,8,'rebel','The Echo of Eternity','2025-02-24 00:15:30','2025-02-24 00:15:40',0),
(34,8,'rebel','The Whisper of the Stars','2025-02-24 00:30:50','2025-02-24 00:31:00',1),
(35,8,'rebel','The Silence of the Void','2025-02-24 00:45:05','2025-02-24 00:45:15',0),
(36,8,'rebel','The Song of the Spheres','2025-02-24 01:00:20','2025-02-24 01:00:30',1),
(37,8,'rebel','The Dance of the Planets','2025-02-24 01:15:40','2025-02-24 01:15:50',0),
(38,8,'rebel','The Flow of the Cosmos','2025-02-24 01:30:55','2025-02-24 01:31:05',1),
(39,8,'rebel','The Cycle of Time','2025-02-24 01:45:10','2025-02-24 01:45:20',0),
(40,8,'rebel','The Wheel of Fortune','2025-02-24 02:00:30','2025-02-24 02:00:40',1),
(41,8,'rebel','The Spiral of Destiny','2025-02-24 02:15:50','2025-02-24 02:16:00',0),
(42,8,'rebel','The Circle of Life','2025-02-24 02:30:05','2025-02-24 02:30:15',1),
(43,8,'rebel','The Path of the Wise','2025-02-24 02:45:20','2025-02-24 02:45:30',0),
(44,8,'rebel','The Journey of the Soul','2025-02-24 03:00:40','2025-02-24 03:00:50',1),
(45,8,'rebel','The Voyage of the Mind','2025-02-24 03:15:55','2025-02-23 21:47:10',1),
(46,8,'rebel','The Exploration of the Unknown','2025-02-24 03:30:10','2025-02-24 03:30:20',1),
(47,8,'rebel','The Discovery of Truth','2025-02-24 03:45:30','2025-02-23 21:47:09',1),
(48,8,'rebel','The Revelation of Wisdom','2025-02-24 04:00:50','2025-02-24 04:01:00',1),
(49,8,'rebel','The Awakening of Consciousness','2025-02-24 04:15:05','2025-02-24 04:15:15',0),
(50,8,'rebel','The Enlightenment of the Spirit','2025-02-24 04:30:20','2025-02-24 04:30:30',1);
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'sa','rbl@gmail.com','$2y$12$LrfzgGeGdEU8f94Q4BfuQuJ1rr5jjqtKkAjGccPUwv7Fp7bkC90ty',NULL,'2025-02-16 23:22:53'),
(7,'sas','rbl1@gmail.com','$2y$12$/kDIu6q819siQA4yoC5g1.xHubo9Aw00hmUKMeGEN21Tn8aGgiOle',NULL,'2025-02-16 23:31:18'),
(8,'sasa','sasa@gmail.com','$2y$12$nofFYb5jKTN6K4thrulyF.w111.VAWvmOW4OFwnILD7qx7k5kq.Ju',NULL,'2025-02-23 19:32:38');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-02-24  1:18:09
