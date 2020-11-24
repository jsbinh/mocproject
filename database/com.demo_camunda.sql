-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for demo_camunda
CREATE DATABASE IF NOT EXISTS `demo_camunda` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `demo_camunda`;

-- Dumping structure for table demo_camunda.attachments
CREATE TABLE IF NOT EXISTS `attachments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `change_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.attachments: ~12 rows (approximately)
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;

-- Dumping structure for table demo_camunda.changes
CREATE TABLE IF NOT EXISTS `changes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `change_id` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status_id` int(11) DEFAULT NULL,
  `assignee_id` int(11) DEFAULT NULL,
  `approver_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `wf_instance_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wf_task_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `justification` text COLLATE utf8_unicode_ci,
  `factory` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `system` int(11) NOT NULL,
  `flow` json DEFAULT NULL,
  `color` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.changes: ~14 rows (approximately)
/*!40000 ALTER TABLE `changes` DISABLE KEYS */;
/*!40000 ALTER TABLE `changes` ENABLE KEYS */;

-- Dumping structure for table demo_camunda.change_statuses
CREATE TABLE IF NOT EXISTS `change_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `change_statuses_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.change_statuses: ~9 rows (approximately)
/*!40000 ALTER TABLE `change_statuses` DISABLE KEYS */;
INSERT INTO `change_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Initial', '2020-11-07 10:18:24', '2020-11-07 10:18:24'),
	(2, 'Screening', '2020-11-07 10:18:24', '2020-11-07 10:18:24'),
	(3, 'Design', '2020-11-07 10:18:24', '2020-11-07 10:18:24'),
	(4, 'Design Review/Approve', '2020-11-07 10:18:24', '2020-11-07 10:18:24'),
	(5, 'Implement', '2020-11-07 10:18:24', '2020-11-07 10:18:24'),
	(6, 'Implement Review/Approve', '2020-11-07 10:18:24', '2020-11-07 10:18:24'),
	(7, 'Closeout', '2020-11-07 10:18:24', '2020-11-07 10:18:24'),
	(8, 'Closeout Review/Approve', '2020-11-07 10:18:24', '2020-11-07 10:18:24'),
	(9, 'Closed/Cancelled', '2020-11-07 10:18:24', '2020-11-07 10:18:24');
/*!40000 ALTER TABLE `change_statuses` ENABLE KEYS */;

-- Dumping structure for table demo_camunda.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `change_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.comments: ~15 rows (approximately)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Dumping structure for table demo_camunda.config
CREATE TABLE IF NOT EXISTS `config` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `config_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.config: ~0 rows (approximately)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- Dumping structure for table demo_camunda.factories
CREATE TABLE IF NOT EXISTS `factories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_name` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `factories_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.factories: ~2 rows (approximately)
/*!40000 ALTER TABLE `factories` DISABLE KEYS */;
/*!40000 ALTER TABLE `factories` ENABLE KEYS */;

-- Dumping structure for table demo_camunda.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table demo_camunda.filters
CREATE TABLE IF NOT EXISTS `filters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `filter` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `filters_user_id_index` (`user_id`),
  CONSTRAINT `filters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.filters: ~0 rows (approximately)
/*!40000 ALTER TABLE `filters` DISABLE KEYS */;
/*!40000 ALTER TABLE `filters` ENABLE KEYS */;

-- Dumping structure for table demo_camunda.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.migrations: ~18 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_09_28_130641_create_failed_jobs_table', 1),
	(4, '2020_05_23_121116_create_filters_table', 1),
	(5, '2020_05_23_122515_create_config_table', 1),
	(6, '2020_06_25_164623_create_tags_table', 1),
	(7, '2020_06_25_173015_create_slugs_table', 1),
	(8, '2020_06_29_125058_create_change_statuses_table', 2),
	(9, '2020_06_29_145401_create_changes_table', 3),
	(10, '2020_06_30_161219_add_wf_to_changes_table', 4),
	(11, '2020_08_01_100821_create_factories_table', 5),
	(37, '2020_08_01_100932_create_units_table', 6),
	(38, '2020_08_01_100941_create_systems_table', 6),
	(39, '2020_08_04_111627_alter_nullable_status_description_on_changes_table', 6),
	(40, '2020_08_04_120238_add_more_general_fields_to_changes_table', 6),
	(44, '2020_08_15_094118_create_attachments_table', 7),
	(45, '2020_08_15_141206_create_comments_table', 7),
	(47, '2020_08_16_040327_add_creator_flow_to_changes_table', 8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table demo_camunda.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table demo_camunda.slugs
CREATE TABLE IF NOT EXISTS `slugs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slugs_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.slugs: ~0 rows (approximately)
/*!40000 ALTER TABLE `slugs` DISABLE KEYS */;
/*!40000 ALTER TABLE `slugs` ENABLE KEYS */;

-- Dumping structure for table demo_camunda.systems
CREATE TABLE IF NOT EXISTS `systems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_name` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `factory_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `systems_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.systems: ~2 rows (approximately)
/*!40000 ALTER TABLE `systems` DISABLE KEYS */;
/*!40000 ALTER TABLE `systems` ENABLE KEYS */;

-- Dumping structure for table demo_camunda.tags
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.tags: ~0 rows (approximately)
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;

-- Dumping structure for table demo_camunda.units
CREATE TABLE IF NOT EXISTS `units` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_name` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `unit_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `units_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.units: ~3 rows (approximately)
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
/*!40000 ALTER TABLE `units` ENABLE KEYS */;

-- Dumping structure for table demo_camunda.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.users: ~8 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `is_admin`, `password`, `email_verified_at`, `remember_token`, `status_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(40, 'Initiator DiMC', 'di.mc.initiator@gmail.com', 0, '$2y$10$U5Zk7RfFwIeX.dRHskE9ReQympYpUJfpNH0O4Lgh0ZPX5C0aJlV8K', '2020-11-07 10:18:23', NULL, 1, '2020-11-07 10:18:23', NULL, NULL),
	(41, 'Screening DiMC', 'di.mc.screening@gmail.com', 0, '$2y$10$R8KthOGZ9UllAJayUy46M.YioXA.BiNC/v6QI.vnrtV4xnPX6deDa', '2020-11-07 10:18:23', NULL, 2, '2020-11-07 10:18:23', NULL, NULL),
	(42, 'Design DiMC', 'di.mc.design@gmail.com', 0, '$2y$10$7fwKRUnptc1ehqXAHmcRnOTREI0DOoJM6rHaP0C23earSmK0gEr/y', '2020-11-07 10:18:23', NULL, 3, '2020-11-07 10:18:23', NULL, NULL),
	(43, 'DesignApprove DiMC', 'di.mc.designapprove@gmail.com', 0, '$2y$10$AOpJExhSU7fNo0UrO1YjGu58volA0Hyp2irK3VDYw7E3fa6a535SC', '2020-11-07 10:18:23', NULL, 4, '2020-11-07 10:18:23', NULL, NULL),
	(44, 'Implement DiMC', 'di.mc.implement@gmail.com', 0, '$2y$10$bHQ9Hc41s75nVyoQd.BRluzO/3VpmMjt/BQ4k7i65LNLvV4z.g9ke', '2020-11-07 10:18:23', NULL, 5, '2020-11-07 10:18:23', NULL, NULL),
	(45, 'ImplementApprove DiMC', 'di.mc.implementapprove@gmail.com', 0, '$2y$10$pjWR6sTSCKA4ZTSi1CXo2O7TAPzhk0v6VeEWC9AlD54jW/MDyyj6K', '2020-11-07 10:18:24', NULL, 6, '2020-11-07 10:18:24', NULL, NULL),
	(46, 'Closeout DiMC', 'di.mc.closeout@gmail.com', 0, '$2y$10$6Q/LA0H7QOA4jeNTK8ZWPejM0Ab0brb4vGWwQVnnOIjgg2zgVS3JS', '2020-11-07 10:18:24', NULL, 7, '2020-11-07 10:18:24', NULL, NULL),
	(47, 'CloseoutApprove DiMC', 'di.mc.closeoutapprove@gmail.com', 0, '$2y$10$OMCPWtoS/2709V9RzjA2YOpOsPNjx5w12MRerGJtHdkWKAy9b5zMu', '2020-11-07 10:18:24', NULL, 8, '2020-11-07 10:18:24', NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
