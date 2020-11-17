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
  `change_id` int(11)  NULL,
  `user_id` int(11) NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci  NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci  NULL,
  `description` text COLLATE utf8_unicode_ci,
  `meta` text NULL,
  `created_at` timestamp,
  `updated_at` timestamp,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.attachments: ~12 rows (approximately)
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
INSERT INTO `attachments` (`id`, `change_id`, `user_id`, `name`, `path`, `description`, `meta`, `created_at`, `updated_at`) VALUES
	(1, 28, 1, 'cmail-can-bang-vi.png', 'attachments/202008/uZiRGuJdpKHSTYMLOHOkebS3WG4m8XaJl1SVBEdn.png', NULL, '{"size": 640238, "time": 1597480721, "mime_type": "image/png", "original_name": "cmail-can-bang-vi.png"}', '2020-08-15 15:38:41', '2020-08-15 15:38:41'),
	(3, 28, 1, 'robusta-honey.png', 'attachments/202008/YhHbfwM8T7QlJB3lSGqod0SXXStppjiDJ9lDR0cv.png', NULL, '{"size": 841916, "time": 1597480721, "mime_type": "image/png", "original_name": "robusta-honey.png"}', '2020-08-15 15:38:41', '2020-08-15 15:38:41'),
	(5, 32, 1, 'Screen Shot 2020-07-27 at 08.11.10.png', 'attachments/202008/lT5rqLxYiuqtzNJwx6C7Oco2pMQiHHYEeFcur2kL.png', NULL, '{"size": 1976225, "time": 1597511391, "mime_type": "image/png", "original_name": "Screen Shot 2020-07-27 at 08.11.10.png"}', '2020-08-16 00:09:51', '2020-08-16 00:09:51'),
	(6, 39, 1, 'san-pham-cmail-mat-ong.png', 'attachments/202008/zxH9abhBuv7ovkDDPRZDbcEaRv6KyvKrXycjQcpV.png', NULL, '{"size": 1374277, "time": 1597543992, "mime_type": "image/png", "original_name": "san-pham-cmail-mat-ong.png"}', '2020-08-16 09:13:12', '2020-08-16 09:13:12'),
	(7, 39, 1, 'san-pham-cmail-dam-da.png', 'attachments/202008/ddl3uPHXWspN8pESbFbJz1NzIPu0JLQDBKZam04Y.png', NULL, '{"size": 1265777, "time": 1597543992, "mime_type": "image/png", "original_name": "san-pham-cmail-dam-da.png"}', '2020-08-16 09:13:12', '2020-08-16 09:13:12'),
	(8, 39, 1, 'san-pham-cacao.png', 'attachments/202008/vCiZItxtUGcwLtXwjORnlSdBqwn5ii1mC7LYeNAG.png', NULL, '{"size": 1411836, "time": 1597543992, "mime_type": "image/png", "original_name": "san-pham-cacao.png"}', '2020-08-16 09:13:12', '2020-08-16 09:13:12'),
	(9, 39, 1, 'cmail-can-bang-vi.png', 'attachments/202008/Wb8L0TJqxPqceJRHZJjXuU91JlcUBhh0ACpX6W8G.png', NULL, '{"size": 640238, "time": 1597544132, "mime_type": "image/png", "original_name": "cmail-can-bang-vi.png"}', '2020-08-16 09:15:32', '2020-08-16 09:15:32'),
	(10, 32, 1, 'Screen Shot 2020-07-27 at 08.25.15.png', 'attachments/202008/JfdId6ZjKtsCiNYryWtI6pCyqMGCVBG9CEPtMe6i.png', NULL, '{"size": 354076, "time": 1597548890, "mime_type": "image/png", "original_name": "Screen Shot 2020-07-27 at 08.25.15.png"}', '2020-08-16 10:34:50', '2020-08-16 10:34:50'),
	(11, 32, 1, 'san-pham-cmail-mat-ong.png', 'attachments/202008/oSanM5SG5FxLfdxpDStXtjVeAgzzjW5rozXWELmM.png', NULL, '{"size": 1374277, "time": 1597548890, "mime_type": "image/png", "original_name": "san-pham-cmail-mat-ong.png"}', '2020-08-16 10:34:50', '2020-08-16 10:34:50'),
	(12, 32, 1, 'Screen Shot 2020-07-27 at 08.11.10.png', 'attachments/202008/nZmFrwHOTgDe4ctJ5MyEa8t404Kz9kQHyT1I4Ctl.png', NULL, '{"size": 1976225, "time": 1597548890, "mime_type": "image/png", "original_name": "Screen Shot 2020-07-27 at 08.11.10.png"}', '2020-08-16 10:34:50', '2020-08-16 10:34:50'),
	(13, 32, 1, 'Screen Shot 2020-07-24 at 12.32.33.png', 'attachments/202008/oNzBVrFgtyCBABAJKrk5eVTq4FDADuhRcZ5FFPME.png', NULL, '{"size": 2503854, "time": 1597548890, "mime_type": "image/png", "original_name": "Screen Shot 2020-07-24 at 12.32.33.png"}', '2020-08-16 10:34:50', '2020-08-16 10:34:50'),
	(14, 32, 1, 'Spotlight Ảnh hưởng kinh tế của SARS Cov2 và các chính sách kinh tế hỗ trợ.pdf', 'attachments/202008/pDLXFsGRzLmikjUdRK8TMUYyg3330OjVy1CYg16B.pdf', NULL, '{"size": 1248137, "time": 1597548933, "mime_type": "application/pdf", "original_name": "Spotlight Ảnh hưởng kinh tế của SARS Cov2 và các chính sách kinh tế hỗ trợ.pdf"}', '2020-08-16 10:35:33', '2020-08-16 10:35:33'),
	(15, 41, 1, 'cpro_dev (2).sql', 'attachments/202010/1I4nxsoczWjSDuR3py3JOf3W1CdKCSL5mc5iEQRh.txt', NULL, '{"size": 2381426, "time": 1602343077, "mime_type": "text/plain", "original_name": "cpro_dev (2).sql"}', '2020-10-10 22:17:57', '2020-10-10 22:17:57'),
	(16, 32, 1, 'cpro_dev_bk.sql', 'attachments/202010/zdqAfmImoJmmztzmhzchXVpW7y5hHljOU89oIYu7.txt', NULL, '{"size": 4480092, "time": 1602343465, "mime_type": "text/plain", "original_name": "cpro_dev_bk.sql"}', '2020-10-10 22:24:25', '2020-10-10 22:24:25'),
	(17, 52, 17, 'PTI_ShortWorkflow.xlsx', 'attachments/202011/dTRQismhlfJdrRTJnXPSykSC8rRifQGbenPsTyoQ.xlsx', NULL, '{"size": 7373924, "time": 1604717450, "mime_type": "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "original_name": "PTI_ShortWorkflow.xlsx"}', '2020-11-07 09:50:50', '2020-11-07 09:50:50');
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;

-- Dumping structure for table demo_camunda.changes
CREATE TABLE IF NOT EXISTS `changes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `change_id` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status_id` int(11)  NULL,
  `assignee_id` int(11) NULL,
  `approver_id` int(11)  NULL,
  `created_at` timestamp NULL  NULL,
  `updated_at` timestamp NULL  NULL,
  `wf_instance_id` varchar(100) COLLATE utf8_unicode_ci  NULL,
  `wf_task_id` varchar(100) COLLATE utf8_unicode_ci  NULL,
  `justification` text COLLATE utf8_unicode_ci,
  `factory` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `system` int(11) NOT NULL,
  `flow` text  NULL,
  `color` varchar(100) COLLATE utf8_unicode_ci  NULL,
  `created_by_id` int(11)  NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.comments: ~7 rows (approximately)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `change_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
	(1, 28, 1, 'Test note', '2020-08-15 15:30:29', '2020-08-15 15:30:29'),
	(2, 28, 1, 'Test note \n123\n123', '2020-08-15 15:30:53', '2020-08-15 15:30:53'),
	(3, 28, 1, 'Hello hello\nEm nên làm thế này...', '2020-08-15 15:38:20', '2020-08-15 15:38:20'),
	(4, 28, 1, 'hello \nhello \nhello hello \nhello \nhello \nhello \nhello \nhello', '2020-08-15 15:39:03', '2020-08-15 15:39:03'),
	(5, 32, 1, 'Yêu cầu làm lại\nCần phải làm như sau:\n1. 123\n2. 456', '2020-08-16 00:10:42', '2020-08-16 00:10:42'),
	(6, 39, 1, 'comment', '2020-08-16 09:13:01', '2020-08-16 09:13:01'),
	(7, 35, 1, 'lam lai', '2020-08-16 10:22:17', '2020-08-16 10:22:17');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.factories: ~2 rows (approximately)
/*!40000 ALTER TABLE `factories` DISABLE KEYS */;
INSERT INTO `factories` (`id`, `name`, `short_name`, `created_at`, `updated_at`) VALUES
	(1, 'Factory #1', 'FAC', '2020-08-01 10:19:07', '2020-08-01 10:19:07'),
	(2, 'Factory #2', 'FAC', '2020-08-01 10:19:39', '2020-08-01 10:19:39'),
	(3, 'Test', 'TES', '2020-10-13 22:04:34', '2020-10-13 22:04:34');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.systems: ~2 rows (approximately)
/*!40000 ALTER TABLE `systems` DISABLE KEYS */;
INSERT INTO `systems` (`id`, `name`, `short_name`, `factory_id`, `created_at`, `updated_at`) VALUES
	(1, 'System #1', 'SYS', 0, '2020-08-04 13:27:15', '2020-08-04 13:27:15'),
	(2, 'System #2', 'SYS', 0, '2020-08-04 13:27:19', '2020-08-04 13:27:19');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table demo_camunda.units: ~3 rows (approximately)
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` (`id`, `name`, `short_name`, `unit_id`, `created_at`, `updated_at`) VALUES
	(1, 'Unit #1', 'UNI', 0, '2020-08-04 13:27:05', '2020-08-04 13:27:05'),
	(2, 'Unit Demo', 'UNI', 0, '2020-08-04 13:27:09', '2020-08-16 10:41:44'),
	(3, 'Unit 2', 'UNI', 0, '2020-10-10 22:26:40', '2020-10-10 22:26:40'),
	(4, 'ERWEFA332', 'ADR', 0, '2020-10-24 08:55:37', '2020-10-24 08:55:37');
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
