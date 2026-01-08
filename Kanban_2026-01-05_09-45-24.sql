# ************************************************************
# Antares - SQL Client
# Version 0.7.35
# 
# https://antares-sql.app/
# https://github.com/antares-sql/antares
# 
# Host: localhost (-- Please help get to 10k stars at https://github.com/MariaDB/Server 11.8.3)
# Database: Kanban
# Generation time: 2026-01-05T09:45:41-03:00
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table atividades
# ------------------------------------------------------------

DROP TABLE IF EXISTS `atividades`;

CREATE TABLE `atividades` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `tarefa` varchar(100) NOT NULL,
  `dataHoraCadastro` varchar(50) NOT NULL DEFAULT '',
  `todo` char(1) DEFAULT '0',
  `ongoing` char(1) DEFAULT '0',
  `done` char(1) DEFAULT '0',
  `gone` char(1) DEFAULT '0',
  `userID` int(11) DEFAULT NULL,
  `comentarios` mediumtext DEFAULT NULL,
  `git` varchar(191) DEFAULT NULL,
  `aproved` char(1) DEFAULT '0',
  `projetos_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





# Dump of table grupos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `grupos`;

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text NOT NULL,
  `codigo` varchar(60) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` char(1) DEFAULT '0',
  `nome` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `grupos` WRITE;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;

INSERT INTO `grupos` (`id`, `descricao`, `codigo`, `created_at`, `ativo`, `nome`) VALUES
	(11, "dev bugs e correcoes", "c145468c303d3f5f6a90b627b07da76f", "2026-01-04 17:29:26", "1", "Dev test");

/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table projetos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projetos`;

CREATE TABLE `projetos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(191) DEFAULT NULL,
  `data_inicio` timestamp NULL DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `ativo` char(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

LOCK TABLES `projetos` WRITE;
/*!40000 ALTER TABLE `projetos` DISABLE KEYS */;

INSERT INTO `projetos` (`id`, `titulo`, `data_inicio`, `status_id`, `grupo_id`, `descricao`, `ativo`) VALUES
	(1, "xf", "2026-01-04 19:28:24", 6, 11, "dfc", "1");

/*!40000 ALTER TABLE `projetos` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessid` varchar(200) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `user` varchar(200) DEFAULT NULL,
  `data_criacao` timestamp NULL DEFAULT NULL,
  `ativo` char(1) DEFAULT '0',
  `uagent` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;

INSERT INTO `sessions` (`id`, `sessid`, `user_id`, `user`, `data_criacao`, `ativo`, `uagent`) VALUES
	(101, "b4655b13ae60b419efa1ce2ccd52acdd", 110, "Pedro Henrique", "2026-01-02 20:30:17", "1", "d461feb79e0f2f935997bfbb636d39af98f2ec91270e1f99f88aa122"),
	(102, "31793b362c5c1a63f6778a8b40d8615e", 110, "Pedro Henrique", "2026-01-03 12:19:35", "1", "d461feb79e0f2f935997bfbb636d39af98f2ec91270e1f99f88aa122"),
	(103, "fd002b14fd904467f014b87ee84e66aa", 110, "Pedro Henrique", "2026-01-03 13:10:12", "1", "d461feb79e0f2f935997bfbb636d39af98f2ec91270e1f99f88aa122"),
	(104, "35430ca2e9c8438487f6541caff8bdf2", 110, "Pedro Henrique", "2026-01-03 15:05:09", "1", "d461feb79e0f2f935997bfbb636d39af98f2ec91270e1f99f88aa122"),
	(105, "21c6d53c9ed117c2125a75bad45c267f", 110, "Pedro Henrique", "2026-01-03 20:17:44", "1", "d461feb79e0f2f935997bfbb636d39af98f2ec91270e1f99f88aa122"),
	(106, "960925804656e4e33e50679e6f848e8f", 110, "Pedro Henrique", "2026-01-03 21:45:41", "1", "d461feb79e0f2f935997bfbb636d39af98f2ec91270e1f99f88aa122"),
	(107, "5fd08a984a9fa4eba3cad45b0590a18a", 110, "Pedro Henrique", "2026-01-04 00:15:06", "1", "d461feb79e0f2f935997bfbb636d39af98f2ec91270e1f99f88aa122"),
	(108, "50dc4af555f588ca9d2579b1bef45644", 110, "Pedro Henrique", "2026-01-04 13:00:19", "1", "d461feb79e0f2f935997bfbb636d39af98f2ec91270e1f99f88aa122"),
	(109, "8fb04cf0edef98c15d67a3c89017b1f7", 110, "Pedro Henrique", "2026-01-04 15:43:40", "1", "d461feb79e0f2f935997bfbb636d39af98f2ec91270e1f99f88aa122"),
	(110, "a80038ae5d83f3a18355bccd965244ec", 110, "Pedro Henrique", "2026-01-04 17:13:06", "1", "d461feb79e0f2f935997bfbb636d39af98f2ec91270e1f99f88aa122"),
	(111, "3f213aeda34666c399f3f4da417c2670", 110, "Pedro Henrique", "2026-01-04 19:02:24", "1", "d461feb79e0f2f935997bfbb636d39af98f2ec91270e1f99f88aa122"),
	(112, "590ecdb60ec3675f8e209cd2c7384e11", 110, "Pedro Henrique", "2026-01-04 22:39:59", "1", "d461feb79e0f2f935997bfbb636d39af98f2ec91270e1f99f88aa122"),
	(113, "9e744de14246dd4a96b4c24bfc6ef68d", 110, "Pedro Henrique", "2026-01-05 08:16:39", "1", "d461feb79e0f2f935997bfbb636d39af98f2ec91270e1f99f88aa122");

/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;

INSERT INTO `status` (`id`, `status`) VALUES
	(1, "Feito"),
	(2, "Em Progresso"),
	(3, "Em teste"),
	(4, "Negado"),
	(5, "Atribuido"),
	(6, "Em análise");

/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `active` char(191) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_activity` timestamp NULL DEFAULT NULL,
  `admin` char(1) DEFAULT '0',
  `avatar` varchar(191) DEFAULT NULL,
  `grupo_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `active`, `remember_token`, `created_at`, `updated_at`, `last_activity`, `admin`, `avatar`, `grupo_id`) VALUES
	(110, "Pedro Henrique", "pedrodeuss@aol.com", NULL, "$2y$12$J7jtQzDFvunM1JqmBCBocea1UsGr5Qzo65kB0/K1//CH168jSs7Fe", "1", NULL, "2025-08-20 16:07:55", NULL, NULL, "1", "62e481ceddfafeb359b8747e7fb55f4c.jpeg", NULL),
	(112, "Klauss", "Klauss@dotorg.com", "2025-10-28 14:06:30", "$2y$12$oo9LUt8Wsc6vIy20sKpoVe5KzSR0JAbLsINmcui0L9F9Rm.mtZQ1O", "1", NULL, "2025-10-28 14:06:30", NULL, NULL, "0", "377e50456e9bc34cb6ad8f36b1fa4b77.jpeg", 11),
	(113, "Laney Hodkiewicz", "alessandra.runolfsson@example.net", "2025-10-30 13:01:06", "$2y$12$mwpdzyrD9pON.xlaTq22v.MOvgsqsfvNdx6/Y89ZuAUPpdiv0DCOu", "1", "26f5a9082a", "2025-04-19 00:13:40", NULL, NULL, "0", NULL, NULL),
	(116, "Judah O\'Reilly", "moberbrunner@example.com", "2025-10-30 13:01:07", "$2y$12$KmZgr3nptNMBQPzwE.6JCOGmmWeeFNrKBKdon9Ug/Hxu.z5g3JPaq", "0", "17a35be9ca", "2025-02-19 17:55:00", NULL, NULL, "0", NULL, NULL),
	(117, "Miss Isobel Kovacek II", "ullrich.mozelle@example.org", "2025-10-30 13:01:07", "$2y$12$UOtx0Zq1ocUdFowSGb95OOSRFSE9Q6TUFbmCKpyinIK.KzczO.EP.", "1", "b2133e242b", "2025-04-29 20:02:23", NULL, NULL, "0", NULL, NULL),
	(118, "Estrella Greenfelder", "colby.bruen@example.net", "2025-10-30 13:01:07", "$2y$12$KdBt.GpIoV8J/h/nljroz.jJfAovft4cIMDhzaC1/m0ahrQZYMP9q", "1", "580e0a297b", "2025-08-15 01:25:52", NULL, NULL, "0", NULL, NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of views
# ------------------------------------------------------------

# Creating temporary tables to overcome VIEW dependency errors


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# Dump completed on 2026-01-05T09:45:41-03:00
