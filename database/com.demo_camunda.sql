-- -------------------------------------------------------------
-- TablePlus 3.7.1(332)
--
-- https://tableplus.com/
--
-- Database: com.demo_camunda
-- Generation Time: 2020-08-18 16:14:12.3210
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `attachments`;
CREATE TABLE `attachments` (
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `change_statuses`;
CREATE TABLE `change_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `change_statuses_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `changes`;
CREATE TABLE `changes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `created_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `change_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
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

DROP TABLE IF EXISTS `factories`;
CREATE TABLE `factories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `factories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `filters`;
CREATE TABLE `filters` (
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

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `slugs`;
CREATE TABLE `slugs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slugs_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `systems`;
CREATE TABLE `systems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `systems_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `units`;
CREATE TABLE `units` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `units_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `attachments` (`id`, `change_id`, `user_id`, `name`, `path`, `description`, `meta`, `created_at`, `updated_at`) VALUES
('1', '28', '1', 'cmail-can-bang-vi.png', 'attachments/202008/uZiRGuJdpKHSTYMLOHOkebS3WG4m8XaJl1SVBEdn.png', NULL, '{\"size\": 640238, \"time\": 1597480721, \"mime_type\": \"image/png\", \"original_name\": \"cmail-can-bang-vi.png\"}', '2020-08-15 15:38:41', '2020-08-15 15:38:41'),
('3', '28', '1', 'robusta-honey.png', 'attachments/202008/YhHbfwM8T7QlJB3lSGqod0SXXStppjiDJ9lDR0cv.png', NULL, '{\"size\": 841916, \"time\": 1597480721, \"mime_type\": \"image/png\", \"original_name\": \"robusta-honey.png\"}', '2020-08-15 15:38:41', '2020-08-15 15:38:41'),
('5', '32', '1', 'Screen Shot 2020-07-27 at 08.11.10.png', 'attachments/202008/lT5rqLxYiuqtzNJwx6C7Oco2pMQiHHYEeFcur2kL.png', NULL, '{\"size\": 1976225, \"time\": 1597511391, \"mime_type\": \"image/png\", \"original_name\": \"Screen Shot 2020-07-27 at 08.11.10.png\"}', '2020-08-16 00:09:51', '2020-08-16 00:09:51'),
('6', '39', '1', 'san-pham-cmail-mat-ong.png', 'attachments/202008/zxH9abhBuv7ovkDDPRZDbcEaRv6KyvKrXycjQcpV.png', NULL, '{\"size\": 1374277, \"time\": 1597543992, \"mime_type\": \"image/png\", \"original_name\": \"san-pham-cmail-mat-ong.png\"}', '2020-08-16 09:13:12', '2020-08-16 09:13:12'),
('7', '39', '1', 'san-pham-cmail-dam-da.png', 'attachments/202008/ddl3uPHXWspN8pESbFbJz1NzIPu0JLQDBKZam04Y.png', NULL, '{\"size\": 1265777, \"time\": 1597543992, \"mime_type\": \"image/png\", \"original_name\": \"san-pham-cmail-dam-da.png\"}', '2020-08-16 09:13:12', '2020-08-16 09:13:12'),
('8', '39', '1', 'san-pham-cacao.png', 'attachments/202008/vCiZItxtUGcwLtXwjORnlSdBqwn5ii1mC7LYeNAG.png', NULL, '{\"size\": 1411836, \"time\": 1597543992, \"mime_type\": \"image/png\", \"original_name\": \"san-pham-cacao.png\"}', '2020-08-16 09:13:12', '2020-08-16 09:13:12'),
('9', '39', '1', 'cmail-can-bang-vi.png', 'attachments/202008/Wb8L0TJqxPqceJRHZJjXuU91JlcUBhh0ACpX6W8G.png', NULL, '{\"size\": 640238, \"time\": 1597544132, \"mime_type\": \"image/png\", \"original_name\": \"cmail-can-bang-vi.png\"}', '2020-08-16 09:15:32', '2020-08-16 09:15:32'),
('10', '32', '1', 'Screen Shot 2020-07-27 at 08.25.15.png', 'attachments/202008/JfdId6ZjKtsCiNYryWtI6pCyqMGCVBG9CEPtMe6i.png', NULL, '{\"size\": 354076, \"time\": 1597548890, \"mime_type\": \"image/png\", \"original_name\": \"Screen Shot 2020-07-27 at 08.25.15.png\"}', '2020-08-16 10:34:50', '2020-08-16 10:34:50'),
('11', '32', '1', 'san-pham-cmail-mat-ong.png', 'attachments/202008/oSanM5SG5FxLfdxpDStXtjVeAgzzjW5rozXWELmM.png', NULL, '{\"size\": 1374277, \"time\": 1597548890, \"mime_type\": \"image/png\", \"original_name\": \"san-pham-cmail-mat-ong.png\"}', '2020-08-16 10:34:50', '2020-08-16 10:34:50'),
('12', '32', '1', 'Screen Shot 2020-07-27 at 08.11.10.png', 'attachments/202008/nZmFrwHOTgDe4ctJ5MyEa8t404Kz9kQHyT1I4Ctl.png', NULL, '{\"size\": 1976225, \"time\": 1597548890, \"mime_type\": \"image/png\", \"original_name\": \"Screen Shot 2020-07-27 at 08.11.10.png\"}', '2020-08-16 10:34:50', '2020-08-16 10:34:50'),
('13', '32', '1', 'Screen Shot 2020-07-24 at 12.32.33.png', 'attachments/202008/oNzBVrFgtyCBABAJKrk5eVTq4FDADuhRcZ5FFPME.png', NULL, '{\"size\": 2503854, \"time\": 1597548890, \"mime_type\": \"image/png\", \"original_name\": \"Screen Shot 2020-07-24 at 12.32.33.png\"}', '2020-08-16 10:34:50', '2020-08-16 10:34:50'),
('14', '32', '1', 'Spotlight Ảnh hưởng kinh tế của SARS Cov2 và các chính sách kinh tế hỗ trợ.pdf', 'attachments/202008/pDLXFsGRzLmikjUdRK8TMUYyg3330OjVy1CYg16B.pdf', NULL, '{\"size\": 1248137, \"time\": 1597548933, \"mime_type\": \"application/pdf\", \"original_name\": \"Spotlight Ảnh hưởng kinh tế của SARS Cov2 và các chính sách kinh tế hỗ trợ.pdf\"}', '2020-08-16 10:35:33', '2020-08-16 10:35:33');

INSERT INTO `change_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
('1', 'Draft', '2020-06-29 14:48:31', '2020-06-29 16:04:56'),
('2', 'Open', '2020-06-29 14:48:42', '2020-06-29 14:48:42'),
('3', 'Screening progress', '2020-06-29 14:49:07', '2020-06-29 14:49:07'),
('4', 'Screening approved', '2020-06-29 14:52:14', '2020-06-29 14:52:14'),
('5', 'Screening not approved', '2020-06-29 14:52:20', '2020-06-29 14:52:20'),
('6', 'Design progress', '2020-06-29 14:52:20', '2020-06-29 14:52:20'),
('7', 'Cancel progress', '2020-06-29 14:52:20', '2020-06-29 14:52:20'),
('8', 'Cancelled', '2020-06-29 14:52:20', '2020-06-29 14:52:20'),
('9', 'Technical reviewal progress', '2020-08-15 15:56:19', '2020-08-15 15:56:19'),
('10', 'Technical reviewed ok', '2020-08-15 15:56:28', '2020-08-15 15:56:28'),
('11', 'Technical reviewed not ok', '2020-08-15 15:56:35', '2020-08-15 15:56:35'),
('12', 'Implementation progress', '2020-08-15 15:56:42', '2020-08-15 15:56:42'),
('13', 'Waiting for manager approval', '2020-08-15 15:56:48', '2020-08-15 15:56:48'),
('15', 'Waiting for technical reviewal', '2020-08-15 15:57:07', '2020-08-15 15:57:07'),
('16', 'Manager approval progress', '2020-08-15 15:57:21', '2020-08-15 15:57:21'),
('17', 'Manager approved', '2020-08-15 15:57:26', '2020-08-15 15:57:26'),
('18', 'Manager not approved', '2020-08-15 15:57:30', '2020-08-15 15:57:30'),
('19', 'Update documents progress', '2020-08-15 15:57:35', '2020-08-15 15:57:35'),
('20', 'Close out', '2020-08-15 15:57:40', '2020-08-15 15:57:40'),
('23', 'Close out progress', '2020-08-15 15:58:19', '2020-08-15 15:58:19'),
('24', 'Closed', '2020-08-15 15:58:32', '2020-08-15 15:58:32'),
('25', 'Close out not approved', '2020-08-15 15:58:39', '2020-08-15 15:58:39'),
('28', 'Close out approved', '2020-08-16 06:04:42', '2020-08-16 06:04:42');

INSERT INTO `changes` (`id`, `title`, `description`, `status_id`, `assignee_id`, `approver_id`, `created_at`, `updated_at`, `wf_instance_id`, `wf_task_id`, `justification`, `factory`, `unit`, `system`, `flow`, `created_by_id`) VALUES
('2', 'Change số 1 ABC XYZ', 'Change #1', '1', '1', '1', '2020-06-29 16:05:37', '2020-07-19 09:34:05', NULL, NULL, NULL, '0', '0', '0', NULL, NULL),
('3', 'test obsever 3', 'test obsever 3', '2', '2', NULL, '2020-06-30 11:16:30', '2020-06-30 11:19:19', NULL, NULL, NULL, '0', '0', '0', NULL, NULL),
('4', 'test 123456', 'test 123456', '1', '2', '1', '2020-06-30 11:21:42', '2020-06-30 11:22:11', NULL, NULL, NULL, '0', '0', '0', NULL, NULL),
('5', 'abcxyz456', 'abcxyz456', '2', '2', '1', '2020-06-30 11:24:15', '2020-06-30 11:28:51', NULL, NULL, NULL, '0', '0', '0', NULL, NULL),
('6', '12345678994678234343', 'agfddgdsf', '2', '2', '1', '2020-06-30 12:09:04', '2020-06-30 12:14:32', NULL, NULL, NULL, '0', '0', '0', NULL, NULL),
('7', 'Test wf', 'Test wf', '1', NULL, NULL, '2020-06-30 15:58:49', '2020-06-30 15:58:49', NULL, NULL, NULL, '0', '0', '0', NULL, NULL),
('8', 'test wf 132', 'test wf 132', '1', NULL, NULL, '2020-06-30 16:03:09', '2020-06-30 16:03:09', NULL, NULL, NULL, '0', '0', '0', NULL, NULL),
('9', 'hello', 'hello', '1', NULL, NULL, '2020-06-30 16:08:20', '2020-06-30 16:08:20', NULL, NULL, NULL, '0', '0', '0', NULL, NULL),
('10', 'wf abc', 'wf abc', '2', NULL, NULL, '2020-06-30 16:20:39', '2020-06-30 16:40:53', 'f737b6b4-bab2-11ea-83a5-560006158818', 'f73b393d-bab2-11ea-83a5-560006158818', NULL, '0', '0', '0', NULL, NULL),
('11', 'abc xyz kakak', 'abc xyz', '4', '2', '1', '2020-06-30 16:43:41', '2020-06-30 16:48:45', '2ee699bb-bab6-11ea-83a5-560006158818', 'e33113f6-bab6-11ea-83a5-560006158818', NULL, '0', '0', '0', NULL, NULL),
('12', 'hello222', 'hello222', '6', '2', '1', '2020-06-30 16:58:32', '2020-06-30 17:01:45', '41d41bf7-bab8-11ea-83a5-560006158818', 'ac8d4731-bab8-11ea-83a5-560006158818', NULL, '0', '0', '0', NULL, NULL),
('13', 'Finish', 'Finish', '5', NULL, '1', '2020-06-30 17:04:35', '2020-06-30 17:11:17', '1a477d05-bab9-11ea-83a5-560006158818', 'ff8f031c-bab9-11ea-83a5-560006158818', NULL, '0', '0', '0', NULL, NULL),
('14', 'returned', 'returned', '6', NULL, '1', '2020-06-30 17:12:13', '2020-06-30 17:22:19', '2b0ce4a0-baba-11ea-83a5-560006158818', '7535289a-babb-11ea-83a5-560006158818', NULL, '0', '0', '0', NULL, NULL),
('15', 'send mail 123', 'send mail 123', '8', '2', '1', '2020-06-30 17:34:31', '2020-07-04 16:08:58', '48b0259a-babd-11ea-83a5-560006158818', '50e1c506-babd-11ea-83a5-560006158818', NULL, '0', '0', '0', NULL, NULL),
('16', 'Full workflow', 'Full workflow', '5', '2', '1', '2020-07-04 16:10:17', '2020-07-04 16:44:08', '2dc5cc5f-bdd6-11ea-8d9d-a6dbb80cb3f0', '57bdd17a-bdd6-11ea-8d9d-a6dbb80cb3f0', NULL, '0', '0', '0', NULL, NULL),
('17', 'làm abc', 'cụ thể là làm:\r\n1. ffff\r\n\r\n-- toi da lam xong', '5', '2', '1', '2020-07-05 09:42:26', '2020-07-05 09:45:59', '29f9c656-be69-11ea-8d9d-a6dbb80cb3f0', '6a0928e1-be69-11ea-8d9d-a6dbb80cb3f0', NULL, '0', '0', '0', NULL, NULL),
('18', 'test vuejs', 'desc vuejs', '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL),
('19', 'test vuejs', 'desc vuejs', '12', NULL, NULL, '2020-08-04 11:29:18', '2020-08-04 11:29:18', NULL, NULL, NULL, '0', '0', '0', NULL, NULL),
('20', 'test vuejs', 'desc vuejs', '13', NULL, NULL, '2020-08-04 11:29:25', '2020-08-04 11:29:25', NULL, NULL, NULL, '0', '0', '0', NULL, NULL),
('21', 'hahaha', NULL, '14', NULL, NULL, '2020-08-04 11:30:09', '2020-08-04 11:30:09', NULL, NULL, NULL, '0', '0', '0', NULL, NULL),
('22', 'update ne fffff', NULL, '17', NULL, NULL, '2020-08-04 11:30:18', '2020-08-04 11:41:02', NULL, NULL, NULL, '0', '0', '0', NULL, NULL),
('23', 'hahaha', NULL, '20', NULL, NULL, '2020-08-04 11:31:19', '2020-08-04 11:31:19', NULL, NULL, NULL, '0', '0', '0', NULL, NULL),
('24', 'Test 0002', NULL, '20', NULL, NULL, '2020-08-04 11:33:29', '2020-08-14 05:39:08', NULL, NULL, 'ffffff', '1', '1', '2', NULL, NULL),
('25', 'Test 0003', NULL, '5', NULL, NULL, '2020-08-04 11:37:45', '2020-08-14 05:39:18', NULL, NULL, 'fffff', '1', '1', '2', NULL, NULL),
('26', 'Test 0006', 'Test 0006', '1', NULL, NULL, '2020-08-04 11:38:32', '2020-08-14 06:18:27', NULL, NULL, 'Test 0006', '2', '2', '2', NULL, NULL),
('27', 'Test 0005', NULL, '20', NULL, NULL, '2020-08-04 11:40:46', '2020-08-14 06:18:07', NULL, NULL, 'HEllo', '1', '2', '2', NULL, NULL),
('28', 'Test 0000', 'Test model', '22', NULL, NULL, '2020-08-04 13:15:53', '2020-08-15 15:44:50', NULL, NULL, 'fffff', '2', '2', '1', NULL, NULL),
('29', 'Test 0004', 'Test form 212', '21', NULL, NULL, '2020-08-04 13:27:46', '2020-08-14 06:18:00', NULL, NULL, 'Test 0004', '1', '1', '2', NULL, NULL),
('30', 'Test 0001', 'ffffff', '10', NULL, NULL, '2020-08-13 11:33:03', '2020-08-15 15:45:04', NULL, NULL, 'fffff', '2', '1', '1', NULL, NULL),
('31', 'Test 0005', 'Test 0004', '12', NULL, NULL, '2020-08-13 11:34:12', '2020-08-14 06:18:17', NULL, NULL, 'test ddddd', '2', '1', '1', NULL, NULL),
('32', 'New Change - Title', 'New Change Description', '15', NULL, NULL, '2020-08-13 11:57:32', '2020-08-14 05:38:31', NULL, NULL, 'New Change Justification', '1', '1', '1', NULL, NULL),
('33', 'Test workflow', 'Test workflow', '20', '2', NULL, '2020-08-16 04:33:57', '2020-08-16 05:55:36', '06b61090-df3f-11ea-925e-aa6bd8af1db1', '9ec9b563-df48-11ea-925e-aa6bd8af1db1', 'Test workflow', '1', '1', '1', '{\"next_action\": \"send_mail_close_out_progress\", \"next_status\": \"Close out progress\", \"next_assignee\": \"tltkiet@gmail.com\", \"allowed_statuses\": \"Close out\"}', '1'),
('34', 'Test workflow #2', 'test workflow #2', '28', '2', NULL, '2020-08-16 04:57:40', '2020-08-16 06:04:52', '56dd9856-df42-11ea-925e-aa6bd8af1db1', 'd033c8dd-df4a-11ea-925e-aa6bd8af1db1', 'test workflow #2', '1', '1', '1', '{\"next_action\": \"send_mail_close_out_progress\", \"next_status\": \"Close out progress\", \"next_assignee\": \"tltkiet@gmail.com\", \"allowed_statuses\": \"Close out approved,Close out not approved\"}', '1'),
('35', 'Test workflow #3', 'Test workflow #3', '9', '2', NULL, '2020-08-16 06:06:00', '2020-08-16 06:07:52', 'e2a0c69e-df4b-11ea-925e-aa6bd8af1db1', '236632e3-df4c-11ea-925e-aa6bd8af1db1', 'Test workflow #3', '1', '1', '1', '{\"next_action\": \"send_mail_technical_reviewal_progress\", \"next_status\": \"Technical reviewal progress\", \"next_assignee\": \"tltkiet@gmail.com\", \"allowed_statuses\": \"Technical reviewed ok,Technical reviewed not ok\"}', '1'),
('36', 'Test workflow #4', 'Test workflow #4', '24', '2', NULL, '2020-08-16 06:10:04', '2020-08-16 06:10:46', '740b301b-df4c-11ea-925e-aa6bd8af1db1', '891f9c80-df4c-11ea-925e-aa6bd8af1db1', 'Test workflow #4', '1', '1', '1', '{\"next_action\": \"send_mail_close_out_progress\", \"next_status\": \"Close out progress\", \"next_assignee\": \"tltkiet@gmail.com\", \"allowed_statuses\": \"Closed,Close out not approved\"}', '1'),
('37', 'Test workflow #5', 'Test workflow #5', '8', '2', NULL, '2020-08-16 06:17:33', '2020-08-16 06:17:50', '7f72b09b-df4d-11ea-925e-aa6bd8af1db1', '8480a301-df4d-11ea-925e-aa6bd8af1db1', 'Test workflow #5', '1', '1', '1', '{\"next_action\": \"send_mail_cancel_progress\", \"next_status\": \"Cancel progress\", \"next_assignee\": \"tltkiet@gmail.com\", \"allowed_statuses\": \"Cancelled,Draft\"}', '1'),
('38', 'Test workflow #6', 'Test workflow #6', '1', NULL, NULL, '2020-08-16 06:32:22', '2020-08-16 06:32:22', '91613a86-df4f-11ea-925e-aa6bd8af1db1', '9162e855-df4f-11ea-925e-aa6bd8af1db1', 'Test workflow #6', '1', '1', '1', NULL, '1'),
('39', 'test 123 456', 'description 123 456', '24', '2', NULL, '2020-08-16 09:11:58', '2020-08-16 09:18:39', 'ddcf4234-df65-11ea-9b35-32baf87e0838', 'c6609cfd-df66-11ea-9b35-32baf87e0838', 'justification 123 456', '2', '1', '2', '{\"next_action\": \"send_mail_close_out_progress\", \"next_status\": \"Close out progress\", \"next_assignee\": \"tltkiet@gmail.com\", \"allowed_statuses\": \"Closed,Close out not approved\"}', '1'),
('40', 'Test Final', 'Test Final', '3', '3', NULL, '2020-08-18 15:33:46', '2020-08-18 15:33:58', '88f84046-e12d-11ea-86f0-0ac7a649545c', '8da4ffbb-e12d-11ea-86f0-0ac7a649545c', 'Test Final', '1', '1', '1', '{\"next_action\": \"send_mail_screening_progress\", \"next_status\": \"Screening progress\", \"next_assignee\": \"camunda.u1@gmail.com\", \"allowed_statuses\": \"Screening approved,Screening not approved\"}', '3');

INSERT INTO `comments` (`id`, `change_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
('1', '28', '1', 'Test note', '2020-08-15 15:30:29', '2020-08-15 15:30:29'),
('2', '28', '1', 'Test note \n123\n123', '2020-08-15 15:30:53', '2020-08-15 15:30:53'),
('3', '28', '1', 'Hello hello\nEm nên làm thế này...', '2020-08-15 15:38:20', '2020-08-15 15:38:20'),
('4', '28', '1', 'hello \nhello \nhello hello \nhello \nhello \nhello \nhello \nhello', '2020-08-15 15:39:03', '2020-08-15 15:39:03'),
('5', '32', '1', 'Yêu cầu làm lại\nCần phải làm như sau:\n1. 123\n2. 456', '2020-08-16 00:10:42', '2020-08-16 00:10:42'),
('6', '39', '1', 'comment', '2020-08-16 09:13:01', '2020-08-16 09:13:01'),
('7', '35', '1', 'lam lai', '2020-08-16 10:22:17', '2020-08-16 10:22:17');

INSERT INTO `factories` (`id`, `name`, `created_at`, `updated_at`) VALUES
('1', 'Factory #1', '2020-08-01 10:19:07', '2020-08-01 10:19:07'),
('2', 'Factory #2', '2020-08-01 10:19:39', '2020-08-01 10:19:39');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
('1', '2014_10_12_000000_create_users_table', '1'),
('2', '2014_10_12_100000_create_password_resets_table', '1'),
('3', '2019_09_28_130641_create_failed_jobs_table', '1'),
('4', '2020_05_23_121116_create_filters_table', '1'),
('5', '2020_05_23_122515_create_config_table', '1'),
('6', '2020_06_25_164623_create_tags_table', '1'),
('7', '2020_06_25_173015_create_slugs_table', '1'),
('8', '2020_06_29_125058_create_change_statuses_table', '2'),
('9', '2020_06_29_145401_create_changes_table', '3'),
('10', '2020_06_30_161219_add_wf_to_changes_table', '4'),
('11', '2020_08_01_100821_create_factories_table', '5'),
('37', '2020_08_01_100932_create_units_table', '6'),
('38', '2020_08_01_100941_create_systems_table', '6'),
('39', '2020_08_04_111627_alter_nullable_status_description_on_changes_table', '6'),
('40', '2020_08_04_120238_add_more_general_fields_to_changes_table', '6'),
('44', '2020_08_15_094118_create_attachments_table', '7'),
('45', '2020_08_15_141206_create_comments_table', '7'),
('47', '2020_08_16_040327_add_creator_flow_to_changes_table', '8');

INSERT INTO `systems` (`id`, `name`, `created_at`, `updated_at`) VALUES
('1', 'System #1', '2020-08-04 13:27:15', '2020-08-04 13:27:15'),
('2', 'System #2', '2020-08-04 13:27:19', '2020-08-04 13:27:19');

INSERT INTO `units` (`id`, `name`, `created_at`, `updated_at`) VALUES
('1', 'Unit #1', '2020-08-04 13:27:05', '2020-08-04 13:27:05'),
('2', 'Unit Demo', '2020-08-04 13:27:09', '2020-08-16 10:41:44');

INSERT INTO `users` (`id`, `name`, `email`, `is_admin`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
('1', 'admin', 'tuankiet1708@gmail.com', '1', '$2y$10$Jp3dh1rReafVdc8Q0GOjD.qOYr4tiyuMPXROn.CXfJh3QlWa7qkVu', '2020-08-18 15:12:19', 'AeaQxorxHez8nFozdsoFTZyuyRBn8vCluigTAQ4rzWNDrGvUxA2muVsfknpr', '2020-06-28 11:03:41', '2020-06-29 17:11:35', NULL),
('2', 'Kiet Tran', 'tltkiet@gmail.com', '1', '$2y$10$Jp3dh1rReafVdc8Q0GOjD.qOYr4tiyuMPXROn.CXfJh3QlWa7qkVu', '2020-08-18 15:12:19', 'e09C4q2UT7B0K0loJSmXjlatsGpFJ8zmDaBsvq7XHnJHDCj4fXh3IK1OeqDt', '2020-06-29 17:16:21', '2020-06-29 17:16:21', NULL),
('3', '1', 'camunda.u1@gmail.com', '1', '$2y$10$8GDDZ3TQEraPk5nloSBbROKVuFAv4gMvRN92JOxdaN7IoJC/UUsPi', '2020-08-18 15:12:19', NULL, '2020-08-18 15:10:21', '2020-08-18 15:10:21', NULL),
('4', '2', 'camunda.u2@gmail.com', '1', '$2y$10$76.x3GnZU2V3YS6uSYZWp.MMlSx1mwutZZ1o8QXV1VOQdgzfm0nnG', '2020-08-18 15:12:19', NULL, '2020-08-18 15:10:54', '2020-08-18 15:10:54', NULL),
('5', '3', 'camunda.u3@gmail.com', '1', '$2y$10$MShwHv5FdiIKJg5NzstSrOba/.jegU5jkw3BEqhS90h3M4YOAkkBS', '2020-08-18 15:12:19', NULL, '2020-08-18 15:11:15', '2020-08-18 15:11:15', NULL),
('6', '4', 'camunda.u4@gmail.com', '1', '$2y$10$s3zVDpWL4jnOu4jDecJnXuwZtLVcuAvYG2e1T62lFLKN1Kd2VIHri', '2020-08-18 15:12:19', NULL, '2020-08-18 15:11:33', '2020-08-18 15:11:33', NULL),
('7', '5', 'camunda.u5@gmail.com', '1', '$2y$10$Db7kR0ZhvBzWxH7Zy0VvHujOPjbWhvGN45./RBEQ7kP5q4bSjQ.yO', '2020-08-18 15:12:19', NULL, '2020-08-18 15:11:48', '2020-08-18 15:12:19', NULL);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;