# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 8.0.20)
# Database: MyBookData
# Generation Time: 2020-07-14 21:19:53 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table followers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `followers`;

CREATE TABLE `followers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `follower_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `followers` WRITE;
/*!40000 ALTER TABLE `followers` DISABLE KEYS */;

INSERT INTO `followers` (`id`, `user_id`, `follower_id`)
VALUES
	(2,2,1),
	(3,9,7);

/*!40000 ALTER TABLE `followers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table login_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `login_tokens`;

CREATE TABLE `login_tokens` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `token` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `user_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Token` (`token`),
  KEY `User_ID` (`user_id`),
  CONSTRAINT `login_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `login_tokens` WRITE;
/*!40000 ALTER TABLE `login_tokens` DISABLE KEYS */;

INSERT INTO `login_tokens` (`id`, `token`, `user_id`)
VALUES
	(1,'a360bbd132b20fcff1162acedf323f2fe8f12738',7),
	(2,'7d5c21731ded21a8c8ebba74994158b37265d063',7),
	(3,'476d555ae89f668bc26fd78659946180489ca3cf',7),
	(4,'5c7e064cb9069c8c638bcd5d0d8372e7cce39205',7),
	(5,'80e0781bd241d2635a823dc357cf00f654d41341',7),
	(6,'8368b775d90e1ece7418347e35868a407efdb035',7),
	(7,'93fe274120c07c3ec5dc2832494ab3f0c0827a64',7),
	(8,'9702eec028fa35bffd8a287a383f9beff148425a',7),
	(9,'d84117d68e223afe62df8a93fd8d5a7c34d3cec7',7),
	(10,'ffbedd61bc5cc9181a16a477d24afb465c9cc4fa',7),
	(11,'b76a50c453d496aef06f92f9c655371b24098dd9',7),
	(12,'fb7f705a236fdfdd6376a1ebdf0951349987a81a',7),
	(13,'719a11c6ac1c4185688166c2eb3fd99adcbe174b',7),
	(15,'c569e3af0c672d6c7304b16581a022c8fbdd072c',7),
	(17,'7afe626fb3ec1af6ba5073d1a5a208dc940fd2a3',9),
	(18,'b73288eaf8886fbacb2253f2f8fe5bf26a1d6a9d',7),
	(19,'e42af96827dd1c787dbdf770b6f440ff4ea95ae8',7),
	(20,'9a7f9b64ef2196c73005b7b66503fd3bf7d58619',7),
	(21,'7e56951dd2c98f046c5cb7989860b3d9bf49cfcc',7),
	(22,'b0ce776801694429eeb7c55078f5b2912e766317',7),
	(23,'1c3cc75d7b26b7562aa4fccbbd4d934097b2b1ab',7),
	(24,'9d625aea00be10b199aa1cd9bad7f253741d5463',7),
	(26,'5ff60d58d92141fa4a414df068e283ed35c9864e',7),
	(27,'5f42fb2e6ed7552351445fb0810ba15b691df66e',7),
	(30,'5c176e32fbfd2b3499d1d48ef900835d0ed9b055',7),
	(31,'b053e5550b694cd14510e227290e3ae1cf75d19a',7);

/*!40000 ALTER TABLE `login_tokens` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table messages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sender` int unsigned NOT NULL,
  `receiver` int unsigned NOT NULL,
  `read` tinyint unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



# Dump of table notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `type` int unsigned NOT NULL,
  `receiver` int unsigned NOT NULL,
  `sender` int unsigned NOT NULL,
  `extra` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



# Dump of table post_upvotes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_upvotes`;

CREATE TABLE `post_upvotes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `post_upvotes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `post_upvotes` WRITE;
/*!40000 ALTER TABLE `post_upvotes` DISABLE KEYS */;

INSERT INTO `post_upvotes` (`id`, `post_id`, `user_id`)
VALUES
	(144,16,7),
	(146,11,7),
	(150,17,7);

/*!40000 ALTER TABLE `post_upvotes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table post_upvotes_day
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_upvotes_day`;

CREATE TABLE `post_upvotes_day` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `post_upvotes_day_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `post_upvotes_day` WRITE;
/*!40000 ALTER TABLE `post_upvotes_day` DISABLE KEYS */;

INSERT INTO `post_upvotes_day` (`id`, `post_id`, `user_id`)
VALUES
	(4,17,7);

/*!40000 ALTER TABLE `post_upvotes_day` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table post_upvotes_month
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_upvotes_month`;

CREATE TABLE `post_upvotes_month` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `post_upvotes_month_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `post_upvotes_month` WRITE;
/*!40000 ALTER TABLE `post_upvotes_month` DISABLE KEYS */;

INSERT INTO `post_upvotes_month` (`id`, `post_id`, `user_id`)
VALUES
	(4,17,7);

/*!40000 ALTER TABLE `post_upvotes_month` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table post_upvotes_week
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_upvotes_week`;

CREATE TABLE `post_upvotes_week` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `post_upvotes_week_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `post_upvotes_week` WRITE;
/*!40000 ALTER TABLE `post_upvotes_week` DISABLE KEYS */;

INSERT INTO `post_upvotes_week` (`id`, `post_id`, `user_id`)
VALUES
	(4,17,7);

/*!40000 ALTER TABLE `post_upvotes_week` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `body` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `posted_time` datetime NOT NULL,
  `user_id` int unsigned NOT NULL,
  `upvotes` int unsigned NOT NULL,
  `postimg` varchar(255) DEFAULT NULL,
  `public` text,
  `upvotesdays` int unsigned NOT NULL,
  `upvotesweeks` int unsigned NOT NULL,
  `upvotesmonths` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `body`, `posted_time`, `user_id`, `upvotes`, `postimg`, `public`, `upvotesdays`, `upvotesweeks`, `upvotesmonths`)
VALUES
	(7,'fvfsfvs','2020-06-09 17:42:31',2,2,NULL,NULL,0,0,0),
	(8,'sfdvsfvss','2020-06-09 17:42:34',2,0,NULL,'yes',0,0,0),
	(11,'sdgadgadasdg','2020-07-06 14:37:41',7,1,NULL,NULL,0,0,0),
	(12,'sdgadgadasdg','2020-07-06 14:38:27',7,0,NULL,NULL,0,0,0),
	(13,'hk','2020-07-06 14:38:33',7,0,NULL,NULL,0,0,0),
	(14,'dsfsfvs','2020-07-06 14:41:19',9,0,NULL,NULL,0,0,0),
	(15,'hello my name is lauren','2020-07-06 14:41:25',9,0,NULL,NULL,0,0,0),
	(16,'the world ','2020-07-06 14:41:29',9,1,NULL,NULL,0,0,0),
	(17,'Aliens!!!','2020-07-06 14:41:36',9,1,NULL,NULL,0,0,0),
	(18,'dadfadfadfadf','2020-07-06 16:08:46',7,0,NULL,NULL,0,0,0),
	(19,'my day is todayyyyy','2020-07-06 16:08:57',7,0,NULL,NULL,0,0,0),
	(20,'hello world','2020-07-09 16:25:17',7,0,NULL,NULL,0,0,0),
	(21,'wfwwfw','2020-07-09 16:25:26',7,0,NULL,NULL,0,0,0),
	(22,'wfwwfw','2020-07-09 16:30:05',7,0,NULL,NULL,0,0,0),
	(23,'wvvwvwv','2020-07-09 16:30:10',7,0,NULL,NULL,0,0,0),
	(24,'wvvwvwv','2020-07-09 16:33:13',7,0,NULL,'public',0,0,0),
	(25,'wvwvwvvvttttt','2020-07-09 16:33:19',7,0,NULL,'public',0,0,0),
	(26,'wvwwttteeeee','2020-07-09 16:33:38',7,0,NULL,'private',0,0,0),
	(27,'wvwvw','2020-07-09 16:45:09',7,0,NULL,'public',0,0,0),
	(28,'wvwvw','2020-07-09 16:47:50',7,0,NULL,'public',0,0,0),
	(29,'wvwvw','2020-07-09 16:47:52',7,0,NULL,'public',0,0,0),
	(30,'wvwvw','2020-07-09 16:47:54',7,0,NULL,'public',0,0,0),
	(31,'wvwvw','2020-07-09 16:48:31',7,0,NULL,'public',0,0,0),
	(32,'wvwvw','2020-07-09 16:51:51',7,0,NULL,'public',0,0,0),
	(33,'wvwvw','2020-07-09 16:53:23',7,0,NULL,'public',0,0,0),
	(34,'wvwvw','2020-07-09 16:57:30',7,0,NULL,'public',0,0,0),
	(35,'wvww','2020-07-09 16:57:34',7,0,NULL,'public',0,0,0),
	(36,'wvww','2020-07-09 16:57:43',7,0,NULL,'public',0,0,0),
	(37,'wvww','2020-07-09 16:58:27',7,0,NULL,'public',0,0,0),
	(38,'helllllll','2020-07-09 16:58:32',7,0,NULL,'public',0,0,0);

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `FirstName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `LastName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `UserDescription` varchar(255) DEFAULT NULL,
  `UserPass` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `Country` text,
  `Birthday` text,
  `verified` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `FirstName`, `LastName`, `UserDescription`, `UserPass`, `Email`, `Country`, `Birthday`, `verified`)
VALUES
	(2,'tomret','tom','ret','tom','$2y$10$AnYUWQb14XzL4S6WvBCJ2uvfigNJCCFKHi0FT86U9X2dfBAwNseou','key1966@me.com','america','1997-11-21',0),
	(7,'kbittner','kyle','bittner','kbittner','$2y$10$BKeC1Lb1WG4DGo/fzNJ6qe/4TOQCh9wDYLdmqQ.bErUPnOI0YQ2.S','kylebittner0@gmail.com','merica','1997-11-21',0),
	(9,'Laurenn','Lauren','Cotner','Lauren','$2y$10$BYWTRuD5v6Tw1WSGIWBnv.g2c8tBuhvhDRhaomqFbQjWC3DeW0lnm','kylebittnerr@gmail.com','Maerica','2020-07-06',0);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
