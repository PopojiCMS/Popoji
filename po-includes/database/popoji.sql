-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 13, 2019 at 11:19 PM
-- Server version: 5.7.14
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `popoji`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seotitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `seotitle`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Pure', 'pure', 'Y', 1, 1, '2019-10-11 02:59:19', '2019-10-11 02:59:47'),
(2, 'Plain', 'plain', 'Y', 1, 1, '2019-10-11 02:59:56', '2019-10-11 02:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seotitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent`, `title`, `seotitle`, `picture`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 0, 'Sport', 'sport', NULL, 'Y', 1, 1, '2019-10-08 21:09:54', '2019-10-08 21:11:51'),
(2, 0, 'Otomotif', 'otomotif', NULL, 'Y', 1, 1, '2019-10-08 21:11:36', '2019-10-08 21:46:59'),
(3, 0, 'Travel', 'travel', NULL, 'Y', 1, 1, '2019-10-08 21:12:03', '2019-10-08 21:12:03'),
(4, 0, 'Food', 'food', NULL, 'Y', 1, 1, '2019-10-08 21:12:09', '2019-10-08 22:12:09'),
(5, 0, 'Health', 'health', NULL, 'Y', 1, 1, '2019-10-08 21:12:30', '2019-10-08 22:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL DEFAULT '0',
  `post_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `status` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `parent`, `post_id`, `name`, `email`, `content`, `active`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Dwira Survivor', 'djenuar@yahoo.co.id', 'Mungkin saja melihat MU masih ragu-ragu untuk mengganti pelatih yang sekarang.', 'Y', 'Y', 2, 2, '2019-10-16 16:00:00', '2019-10-16 21:57:07'),
(2, 1, 1, 'Super Admin', 'super@popojicms.org', 'Kita lihat saja perkembangannya nanti. Terima kasih sudah mengomentari berita ini.', 'Y', 'Y', 2, 2, '2019-10-16 21:56:02', '2019-10-16 21:56:02'),
(3, 0, 5, 'Jenuar Dalapang', 'djenuar@gmail.com', 'Ujung Indonesia itu indah-indah yaa ternyata...menajubkan sekali.', 'Y', 'Y', 1, 1, '2019-11-12 20:14:45', '2019-11-12 20:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `components`
--

DROP TABLE IF EXISTS `components`;
CREATE TABLE IF NOT EXISTS `components` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'component',
  `active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`id`, `title`, `author`, `folder`, `type`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Gallery', 'Dwira Survivor', 'gallery', 'component', 'Y', 1, 1, '2019-10-10 19:25:05', '2019-10-10 19:25:47'),
(2, 'Contact', 'Dwira Survivor', 'contact', 'component', 'Y', 1, 1, '2019-10-10 19:25:17', '2019-10-10 19:25:42');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Jenuar Dalapang', 'djenuar@gmail.com', 'Welcome POPOJI', 'Welcome the New POPOJI : Engine Management System for You.', 'Y', 1, 1, '2019-10-11 01:32:31', '2019-10-11 01:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallerys`
--

DROP TABLE IF EXISTS `gallerys`;
CREATE TABLE IF NOT EXISTS `gallerys` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `album_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallerys`
--

INSERT INTO `gallerys` (`id`, `album_id`, `title`, `content`, `picture`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Coloration', NULL, 'coloration.jpg', 1, 1, '2019-10-15 19:03:08', '2019-10-15 19:03:08'),
(2, 2, 'Legs On Table', NULL, 'legs-on-table.jpg', 1, 1, '2019-10-15 19:03:39', '2019-10-15 19:03:39'),
(3, 1, 'Shop Counter', NULL, 'shop-counter.jpg', 1, 1, '2019-10-15 19:04:08', '2019-10-15 19:04:08'),
(4, 2, 'Work Desk', NULL, 'work-desk.jpg', 1, 1, '2019-10-15 19:04:34', '2019-10-15 19:04:34'),
(5, 1, 'City From Sky', NULL, 'city-from-sky.jpg', 1, 1, '2019-10-15 19:05:26', '2019-10-15 19:05:26'),
(6, 2, 'Traction', NULL, 'traction.jpg', 1, 1, '2019-10-15 19:05:46', '2019-10-15 19:05:46'),
(7, 1, 'Still Life White', NULL, 'still-life-white.jpg', 1, 1, '2019-10-15 19:06:06', '2019-10-15 19:06:06'),
(8, 2, 'Coffee In Heart', NULL, 'coffee-in-heart.jpg', 1, 1, '2019-10-15 19:06:28', '2019-10-15 19:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL DEFAULT '0',
  `group` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent`, `group`, `title`, `url`, `class`, `target`, `position`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Home', '/', NULL, 'none', 1, 1, 1, '2019-10-14 15:23:50', '2019-10-14 16:15:31'),
(2, 0, 1, 'About Us', 'pages/about-us', NULL, 'none', 2, 1, 1, '2019-10-14 16:14:58', '2019-10-14 16:31:12'),
(3, 2, 1, 'Services', 'pages/services', NULL, 'none', 3, 1, 1, '2019-10-14 16:20:41', '2019-10-14 16:31:13'),
(4, 0, 1, 'Sport', 'category/sport', NULL, 'none', 4, 1, 1, '2019-10-14 16:29:31', '2019-10-14 16:31:13'),
(5, 0, 1, 'Otomotif', 'category/otomotif', NULL, 'none', 5, 1, 1, '2019-10-14 16:30:16', '2019-10-14 16:31:13'),
(6, 0, 1, 'Travel', 'category/travel', NULL, 'none', 6, 1, 1, '2019-10-14 16:30:36', '2019-10-14 16:31:13'),
(7, 0, 1, 'Food', 'category/food', NULL, 'none', 7, 1, 1, '2019-10-14 16:30:51', '2019-10-14 16:31:13'),
(8, 0, 1, 'Health', 'category/health', NULL, 'none', 8, 1, 1, '2019-10-14 16:31:05', '2019-10-14 16:31:13'),
(9, 0, 1, 'Gallery', 'album/all', NULL, 'none', 9, 1, 1, '2019-10-14 16:31:34', '2019-10-14 16:31:40'),
(10, 0, 1, 'Contact Us', 'contact', NULL, 'none', 10, 1, 1, '2019-10-14 16:34:14', '2019-10-14 16:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_09_22_084207_create_activity_log_table', 1),
(5, '2019_09_22_084507_create_permission_tables', 1),
(6, '2019_10_03_031736_create_settings_table', 2),
(7, '2019_10_08_114314_create_tags_table', 3),
(8, '2019_10_09_042443_create_categories_table', 4),
(9, '2019_10_10_081154_create_comments_table', 5),
(10, '2019_10_10_113552_create_themes_table', 6),
(11, '2019_10_11_030739_create_components_table', 7),
(12, '2019_10_11_090451_create_contacts_table', 8),
(13, '2019_10_11_100436_create_gallerys_table', 9),
(14, '2019_10_11_100452_create_albums_table', 9),
(15, '2019_10_11_221843_create_pages_table', 10),
(16, '2019_10_14_042900_create_posts_table', 11),
(17, '2019_10_14_043042_create_post_gallerys_table', 11),
(18, '2019_10_14_222137_create_menus_table', 12),
(19, '2019_10_15_055433_create_subscribes_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(3, 'App\\User', 3),
(4, 'App\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seotitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `seotitle`, `content`, `picture`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'about-us', '<p>PopojiCMS is a EngineManagement System that is made with a very interesting concept and easy to use. PopojiCMS made its appearance bootstarp responsive to the base and it is also equipped with a lot of jQuery plugins.<br /><br />PopojiCMS built on a Laravel version 6.0, so the developer can easily to use. Hopefully PopojiCMS can answer all your needs on the web.<br /><br /><br />Thank you,<br /><br /><strong>Jenuar Dwi Putra Dalapang a.k.a Dwira Survivor</strong></p>', NULL, 'Y', 1, 1, '2019-10-13 00:27:10', '2019-11-07 00:19:18'),
(2, 'Services', 'services', '<p>Popoji has developed into a major Engine Management System over the past 6 years, a variety of input and improvements here and there have made Popoji ready to answer the needs of your web, broad community support and a reliable web security course is ready you get.</p>\r\n<p>With furnished by jQuery and Bootstrap, Popoji more vivid brings the features previously unimaginable.</p>\r\n<p>Popoji made its appearance responsive so that it can be opened on the screen size anytime and anywhere.<br />Popoji designed with a modern look that is beautiful that attract web users to always visit.<br />Popoji made with Laravel core so that developers can custom easily its flavor.</p>', NULL, 'Y', 1, 1, '2019-10-14 22:26:46', '2019-10-14 22:26:46');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create-users', 'web', '2019-10-04 19:32:00', '2019-10-04 19:32:00'),
(2, 'read-users', 'web', '2019-10-04 19:32:00', '2019-10-04 19:32:00'),
(3, 'update-users', 'web', '2019-10-04 19:32:00', '2019-10-04 19:32:00'),
(4, 'delete-users', 'web', '2019-10-04 19:32:00', '2019-10-04 19:32:00'),
(5, 'create-roles', 'web', '2019-10-04 19:32:07', '2019-10-04 19:32:07'),
(6, 'read-roles', 'web', '2019-10-04 19:32:07', '2019-10-04 19:32:07'),
(7, 'update-roles', 'web', '2019-10-04 19:32:07', '2019-10-04 19:32:07'),
(8, 'delete-roles', 'web', '2019-10-04 19:32:08', '2019-10-04 19:32:08'),
(9, 'create-permissions', 'web', '2019-10-04 19:32:22', '2019-10-04 19:32:22'),
(10, 'read-permissions', 'web', '2019-10-04 19:32:22', '2019-10-04 19:32:22'),
(11, 'update-permissions', 'web', '2019-10-04 19:32:22', '2019-10-04 19:32:22'),
(12, 'delete-permissions', 'web', '2019-10-04 19:32:22', '2019-10-04 19:32:22'),
(13, 'create-settings', 'web', '2019-10-05 19:53:03', '2019-10-05 19:53:03'),
(14, 'read-settings', 'web', '2019-10-05 19:53:03', '2019-10-05 19:53:03'),
(15, 'update-settings', 'web', '2019-10-05 19:53:03', '2019-10-05 19:53:03'),
(16, 'delete-settings', 'web', '2019-10-05 19:53:03', '2019-10-05 19:53:03'),
(17, 'create-posts', 'web', '2019-10-08 04:14:28', '2019-10-08 04:14:28'),
(18, 'read-posts', 'web', '2019-10-08 04:14:28', '2019-10-08 04:14:28'),
(19, 'update-posts', 'web', '2019-10-08 04:14:28', '2019-10-08 04:14:28'),
(20, 'delete-posts', 'web', '2019-10-08 04:14:28', '2019-10-08 04:14:28'),
(21, 'create-categories', 'web', '2019-10-08 04:14:38', '2019-10-08 04:14:38'),
(22, 'read-categories', 'web', '2019-10-08 04:14:38', '2019-10-08 04:14:38'),
(23, 'update-categories', 'web', '2019-10-08 04:14:38', '2019-10-08 04:14:38'),
(24, 'delete-categories', 'web', '2019-10-08 04:14:38', '2019-10-08 04:14:38'),
(25, 'create-tags', 'web', '2019-10-08 04:14:44', '2019-10-08 04:14:44'),
(26, 'read-tags', 'web', '2019-10-08 04:14:44', '2019-10-08 04:14:44'),
(27, 'update-tags', 'web', '2019-10-08 04:14:44', '2019-10-08 04:14:44'),
(28, 'delete-tags', 'web', '2019-10-08 04:14:44', '2019-10-08 04:14:44'),
(29, 'create-comments', 'web', '2019-10-08 04:14:57', '2019-10-08 04:14:57'),
(30, 'read-comments', 'web', '2019-10-08 04:14:57', '2019-10-08 04:14:57'),
(31, 'update-comments', 'web', '2019-10-08 04:14:57', '2019-10-08 04:14:57'),
(32, 'delete-comments', 'web', '2019-10-08 04:14:58', '2019-10-08 04:14:58'),
(33, 'create-pages', 'web', '2019-10-08 04:15:03', '2019-10-08 04:15:03'),
(34, 'read-pages', 'web', '2019-10-08 04:15:03', '2019-10-08 04:15:03'),
(35, 'update-pages', 'web', '2019-10-08 04:15:03', '2019-10-08 04:15:03'),
(36, 'delete-pages', 'web', '2019-10-08 04:15:03', '2019-10-08 04:15:03'),
(37, 'create-themes', 'web', '2019-10-08 04:15:10', '2019-10-08 04:15:10'),
(38, 'read-themes', 'web', '2019-10-08 04:15:10', '2019-10-08 04:15:10'),
(39, 'update-themes', 'web', '2019-10-08 04:15:10', '2019-10-08 04:15:10'),
(40, 'delete-themes', 'web', '2019-10-08 04:15:10', '2019-10-08 04:15:10'),
(41, 'create-menumanager', 'web', '2019-10-08 04:15:31', '2019-10-08 04:15:31'),
(42, 'read-menumanager', 'web', '2019-10-08 04:15:31', '2019-10-08 04:15:31'),
(43, 'update-menumanager', 'web', '2019-10-08 04:15:31', '2019-10-08 04:15:31'),
(44, 'delete-menumanager', 'web', '2019-10-08 04:15:31', '2019-10-08 04:15:31'),
(45, 'create-components', 'web', '2019-10-08 04:15:50', '2019-10-08 04:15:50'),
(46, 'read-components', 'web', '2019-10-08 04:15:50', '2019-10-08 04:15:50'),
(47, 'update-components', 'web', '2019-10-08 04:15:50', '2019-10-08 04:15:50'),
(48, 'delete-components', 'web', '2019-10-08 04:15:50', '2019-10-08 04:15:50'),
(49, 'create-contacts', 'web', '2019-10-11 01:22:14', '2019-10-11 01:22:14'),
(50, 'read-contacts', 'web', '2019-10-11 01:22:14', '2019-10-11 01:22:14'),
(51, 'update-contacts', 'web', '2019-10-11 01:22:14', '2019-10-11 01:22:14'),
(52, 'delete-contacts', 'web', '2019-10-11 01:22:14', '2019-10-11 01:22:14'),
(53, 'create-gallerys', 'web', '2019-10-11 01:22:23', '2019-10-11 01:22:23'),
(54, 'read-gallerys', 'web', '2019-10-11 01:22:23', '2019-10-11 01:22:23'),
(55, 'update-gallerys', 'web', '2019-10-11 01:22:23', '2019-10-11 01:22:23'),
(56, 'delete-gallerys', 'web', '2019-10-11 01:22:23', '2019-10-11 01:22:23'),
(57, 'create-subscribes', 'web', '2019-10-14 22:00:09', '2019-10-14 22:00:09'),
(58, 'read-subscribes', 'web', '2019-10-14 22:00:09', '2019-10-14 22:00:09'),
(59, 'update-subscribes', 'web', '2019-10-14 22:00:09', '2019-10-14 22:00:09'),
(60, 'delete-subscribes', 'web', '2019-10-14 22:00:09', '2019-10-14 22:00:09'),
(61, 'create-clark', 'web', '2019-10-14 22:00:54', '2019-10-14 22:00:54'),
(62, 'read-clark', 'web', '2019-10-14 22:00:54', '2019-10-14 22:00:54'),
(63, 'update-clark', 'web', '2019-10-14 22:00:54', '2019-10-14 22:00:54'),
(64, 'delete-clark', 'web', '2019-10-14 22:00:54', '2019-10-14 22:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seotitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('general','pagination','picture','video') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `headline` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `comment` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `hits` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `title`, `seotitle`, `content`, `meta_description`, `picture`, `picture_description`, `tag`, `type`, `active`, `headline`, `comment`, `hits`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mungkinkah Man United Degradasi di Akhir Musim?', 'mungkinkah-man-united-degradasi-di-akhir-musim', '<p><strong>Jakarta</strong> - Manchester United sedang mengalami fase terburuknya di Liga Inggris sejak ditinggal Sir Alex Ferguson. Mungkinkah mereka terdegradasi di akhir musim?</p>\r\n<p>Laju MU di awal musim ini memang jauh dari harapan. Marcus Rashford dkk kini berada di posisi ke-12 klasemen Liga Inggris dengan raihan 9 poin, hasil dua kali menang, 3 kali seri, dan menelan tiga kekalahan. Ironisnya, sebagai klub \'papan atas\' Inggris, saat ini mereka lebih dekat dengan zona degradasi.</p>\r\n<p>Dengan perolehan 9 poin, MU hanya terpaut 2 poin dari Everton yang kini berada di posisi ke-18 atau zona merah. Sedangkan dengan Leicester City yang ada di peringkat keempat atau zona Liga Champions, mereka terpaut lima poin.</p>\r\n<p>Jika tren negatif ini terus berlanjut, bukan tak mungkin The Red Devils akan mengalami kemungkinan terburuk, yakni terdegradasi. Sepanjang sejarah, MU memang sudah pernah turun kasta.</p>\r\n<p>Masa kelam itu terjadi pada musim 1973/7194, sewaktu masih ditangani Thomas Docherty. Seperti halnya di musim ini, MU saat itu mengawali musim dengan hasil buruk, dengan hanya meraih 3 kemenangan dalam 10 laga.</p>\r\n<p>Meski terdegradasi, manajemen MU kala itu tetap mempertahankan Docherty, yang berhasil membawa MU kembali promosi di musim berikutnya. Tapi hal serupa tampak mustahil dilakukan direksi MU saat ini pada manajer mereka, Ole Gunnar Solskjaer. Apa kata dunia jika MU sampai turun kasta?</p>\r\n<p>Labilnya penampilan MU saat ini membuat mereka diragukan untuk bisa merangkak ke papan atas. Terlebih banyaknya persoalan yang dihadapi, mulai dari krisis cedera, minim stok penyerang, hingga sulit mencetak lebih dari satu gol di tiap laga.</p>\r\n<p>Meski terlalu dini, kemungkinan degradasi itu nyata. Ole pun diprediksi akan dipecat jika MU terus gagal meraih kemenangan.</p>\r\n<p>Tagar #OleOut sudah ramai di media sosial selepas MU takluk 0-1 dari Newcastle, Minggu (6/10). Sejumlah nama secara liar sudah dimunculkan media-media Inggris untuk menggantikannya, mulai dari Max Allegri hingga Arsene Wenger.</p>\r\n<p>Tak sepeti Docherty, Ole harus berbenah dengan waktu yang tak banyak. Jeda internasional kali ini harus dipakainya untuk menambal lubang-lubang yang ada dalam permainan MU agar kembali tampil efektif dan meraih kemenangan. Apalagi MU akan berjumpa dengan pemuncak klasemen, Liverpool, tepat seusai jeda internasional, Minggu (20/10).</p>\r\n<p>Bila berhasil meraih kemenangan dan terus mendapat hasil baik sampai akhir tahun, Ole bisa menggunakan bursa transfer Januari untuk kembali membangun tim. Jika hasil negatif terus menyelimuti MU, bisa saja ia harus menikmati Natal sebagai seorang pengangguran.</p>', 'Manchester United sedang mengalami fase terburuknya di Liga Inggris sejak ditinggal Sir Alex Ferguson.', 'mungkinkah-man-united-degradasi-di-akhir-musim.jpg', 'Manchester United mungkinkah terdegradasi di akhir musim nanti? (Scott Heppell / Reuters)', 'PopojiCMS,CMS Indonesia', 'general', 'Y', 'Y', 'Y', 1, 2, 1, '2019-10-13 22:11:45', '2019-11-13 15:09:47'),
(2, 1, 'Tiket MotoGP Indonesia Dijual Mulai November 2019', 'tiket-motogp-indonesia-dijual-mulai-november-2019', '<p><strong>Jakarta</strong> - MotoGP Indonesia baru akan digelar pada tahun 2021. Namun, penjualan tiketnya akan mulai dilakukan mulai bulan depan.</p>\r\n<p>Dikonfirmasi detikSport kepada VP Corporate Secretary Indonesia Tourism Development Corporation (ITDC), Miranti Rendranti, pihaknya merencanakan penjualan tiket pada awal atau akhir November 2019.</p>\r\n<p>\"Per akhir November 2019 hingga Agustus 2020 akan dilakukan kegiatan Pre-Booking tiket MotoGP Mandalika 2021 untuk sejumlah 20.000 pemegang hak mendapat tiket, melalui pemesanan online,\" ujar Miranti lewat pesan singkat Whatsapp.</p>\r\n<p>Diketahui, Indonesia mendapat slot dari Dorna untuk menggelar MotoGP per musim 2021. Kontrak berdurasi tiga tahun disebut sudah dikantongi.</p>\r\n<p>Adapun sirkuit yang dipakai adalah sirkuit jalan raya kawasan wisata Mandalika di Lombok, Nusa Tenggara Barat.</p>\r\n<p>Sejauh ini pembangunan Mandalika Street Circuit, yang akan digunakan untuk penyelenggaraan MotoGP 2021, telah menyelesaikan proses pengukuran topografi dan penyelidikan tanah.</p>\r\n<p>Tahap land clearing dan pemagaran sekeliling area sirkuit sepanjang 6,25 km, telah terbangun 2,5 km atau sekitar 42%. Sementara land clearing mencapai 98.000 m2 dari rencana 432.000 m2.</p>\r\n<p>\"Kami pastikan pembangunan Mandalika Street Circuit saat ini berjalan sesuai dengan rencana, yaitu memulai konstruksi pada Oktober 2019. Selain kegiatan di lapangan yang fokus kepada area sirkuit berupa pemagaran yang hampir mencapai 50% dan land clearing, proses homologasi desain Mandalika Street Circuit juga telah menyepakati Center Line desain sirkuit, artinya telah menyepakati titik-titik koordinat, panjang, dan lengkung lintasan satu dengan yang lainnya,\" kata Direktur Utama ITDC Abdulbar M Mansoer dalam keterangannya kepada detikcom.</p>', 'MotoGP Indonesia baru akan digelar pada tahun 2021. Namun, penjualan tiketnya akan mulai dilakukan mulai bulan depan.', 'tiket-motogp-indonesia-dijual-mulai-november-2019.jpg', 'Gambaran proyek Sirkuit Mandalika. (Foto: MotoGP.com)', 'PopojiCMS,CMS Indonesia', 'general', 'Y', 'N', 'Y', 1, 2, 1, '2019-10-14 22:32:09', '2019-11-13 15:03:35'),
(3, 2, 'Bocor, Ini Penampakan Toyota Yaris Versi 2020', 'bocor-ini-penampakan-toyota-yaris-versi-2020', '<p><strong>Jakarta</strong> - Foto-foto yang diduga Toyota Yaris 2020 tersebar di dunia maya baru-baru ini. Toyota Yaris versi penyegaran itu disebut-sebut akan diluncurkan di pameran Tokyo Motor Show (TMS) 2019, di penghujung bulan ini.</p>\r\n<p>Secara garis besar, Toyota Yaris 2020 mendapat ubahan signifikan di area fascia-nya. Bentuk grille sekarang terlihat lebih besar. Yaris 2020 menggunakan lampu LED, dilengkapi dengan DRL. Dan untuk lampu kabutnya dibuat lebih minimalis.</p>\r\n<p>Ubahan juga dilakukan di bagian buritan. Toyota Yaris 2020 kini dilengkapi lampu LED, lengkap dengan reflektor panjang yang menyambung. Mirip seperti konsep yang ada di Honda BR-V.</p>\r\n<p>Yang menarik lagi, kesan crossover pada hatchback pesaing Honda Jazz ini makin terasa berkat penggunaan bemper belakang yang besar. Selain itu, area difuser juga ditinggikan, sehingga menambah kesan sporty.</p>\r\n<p>Toyota Yaris 2020 juga akan mendapatkan pelek palang dengan motif baru. Model ini masih mempertahankan antena shark fin, dan desain atap yang seolah melayang (floating roof).</p>', 'Foto-foto yang diduga Toyota Yaris 2020 tersebar di dunia maya baru-baru ini.', 'bocor-ini-penampakan-toyota-yaris-versi-2020.jpg', 'Foto: pandulaju.com.my', 'PopojiCMS,CMS Indonesia', 'general', 'Y', 'Y', 'Y', 1, 2, 1, '2019-10-14 22:44:44', '2019-11-12 21:34:06'),
(4, 2, 'Dijual Rp 70 Juta, Intip Fitur di Dalam Mobil Termurah Suzuki', 'dijual-rp-70-juta-intip-fitur-di-dalam-mobil-termurah-suzuki', '<p><strong>Jakarta</strong> - Suzuki belum lama ini merilis mobil paling murahnya di India. Mobil itu disapa Maruti S-Presso. Kabarnya mobil bakal dijual mulai Rp 70 jutaan.</p>\r\n<p>Meski dibanderol dengan harga murah di bawah Rp 100 jutaan, Suzuki tak absen menghadirkan fitur-fitur keamanan dan keselamatan buat penumpang dan pengendara di dalamnya.</p>\r\n<p>Seperti diberitakan sebelumnya, Suzuki S-Presso ini akan dilengkapi dengan dua airbag, sistem pengereman ABS dan EBD, sensor parkir di bagian belakang, pedestrian protection, crash compliance dan peringatan saat dipacu dalam kecepatan tinggi.</p>\r\n<p>Kemudian di bagian sistem hiburan terdapat Call Assistant, AHA Radio, Navigasi, informasi kendaraan, dan juga peringatan untuk pintu yang tak tertutup dengan rapat.</p>\r\n<p>Mengusung mesin K10B dengan kapasitas 998cc mobil memiliki tenaga setara 50 kW pada putaran 5.500 rpm dan torsi maksimum 90 Nm pada putaran 3.500 rpm.</p>\r\n<p>Suzuki mengusung tenaga penggerak roda depan pada S-Presso dan juga transmisi manual lima percepatan.</p>\r\n<p>Sayangnya buat orang Indonesia yang menginginkan mobil murah ini belum bisa mendapatkannya. Suzuki menegaskan belum berencana memboyong mobil murah itu dalam waktu dekat ke Tanah Air. Di Indonesia, mobil-mobil mungil dengan banderol harga miring memang cukup banyak ditawarkan di India.</p>\r\n<p>Mobil-mobil dengan model seperti itu cukup menarik bagi masyarakat India. Namun bisa jadi saat masuk ke pasar Indonesia mobil justru tak dilirik karena tak sesuai selera masyarakat.</p>', 'Suzuki belum lama ini merilis mobil paling murahnya di India. Mobil itu disapa Maruti S-Presso.', 'dijual-rp-70-juta-intip-fitur-di-dalam-mobil-termurah-suzuki.jpg', 'Suzuki S-Presso. Foto: Indianautosblog', 'PopojiCMS,CMS Indonesia', 'general', 'Y', 'N', 'Y', 1, 2, 1, '2019-10-14 22:46:22', '2019-11-13 15:09:37'),
(5, 3, 'Mengenal Area Lintas Batas Negara di Utara Indonesia', 'mengenal-area-lintas-batas-negara-di-utara-indonesia', '<p><strong>Miangas</strong> - Miangas di Kabupaten Talaud, Sulawesi Utara bukan cuma sekedar pulau eksotis. Berada di ujung utara Indonesia, Miangas jadi perbatasan dengan Filipina.</p>\r\n<p>detikcom bersama Bank BRI melakukan ekspedisi Miangas untuk melihat kehidupan masyarakat di perbatasan. Bukan cuma sekedar perbatasan negara, Miangas adalah Border Cross Area.</p>\r\n<p>Mari mulai dengan kedekatan Miangas dan Filipina sejak dulu. Sebagai pulau yang lebih dekat dengan Filipina, Miangas cukup bergantung pada Filipina.&nbsp;</p>\r\n<p>Tak hanya sekedar berdagang dan memenuhi kebutuhan bahan pokok, Miangas dan Filipina sudah menali persaudaraan lewat perkawinan. Namun kegiatan ini mulai berkurang sejak ditetapkannya Border Cross Area.</p>\r\n<p>\"Border Crossing Area (BCA) atau Daerah Lintas Batas, untuk Kabupaten Talaud, Miangas menjadi check poinnya,\" ujar Sepno Lantaa, Camat Khusus Miangas.</p>\r\n<p>Unsur dari BCA adalah camat, angkatan laut, imigrasi, bea cukai dan karantina. BCA mulai berdiri di Indonesia sejak 1975. Tugas utama dari BCA adalah mengawasi lalu lintas manusia dan perdagangan barang.</p>\r\n<p>Sejak itu lalu lintas dan perdagangan mulai ketat. Dalam seminggu hanya ada satu-dua pelintas yang datang dengan menggunakan pamboat atau perahu motor tempel.</p>\r\n<p>Untuk masuk ke dalam daerah lintas batas atau BCA pun tak sembarangan, traveler. Kalau biasanya kamu hanya butuh paspor untuk kunjungan ke luar negeri, BCA membutuhkan lebih dari itu yaitu Kartu Lintas Batas (KLB).</p>\r\n<p>Kartu Lintas Batas adalah surat ijin untuk tinggal di Border Cross Area. Kartu ini dibagi ke dalam 3 masa tenggang, 13 hari, 30 hari dan 59 hari. Kartu ini bukan bisa digunakan sekali atau PP.</p>\r\n<p>\"Biasanya kegiatan yang dilakukan oleh pelintas batas Filipina adalah kunjungan keluarga, dagang atau transaksi barter,\" jelas Sepno.</p>\r\n<p>Angka pernikahan campuran sudah mulai menurun di Miangas. Namun transaksi dagang dan barter masih terus dilakukan. Kedekatan jarak antara Miangas dan Filipina menjadi satu-satunya jalan mencari kebutuhan pokok jika cuaca ekstrem datang.</p>\r\n<p>\"Saat ada keterlambatan dari kapal perintis atau penumpang, masyarakat yang kehabisan bahan pokok akan mencarinya lewat Filipina,\" cerita Sepno.</p>\r\n<p>Bagaimana cara Miangas dan Filipina berkomunikasi?</p>\r\n<p>Filipina punya seorang perwakilan negara yang ditempatkan di area lintas batas Miangas. Begitu pula perwakilan Indonesia di Filipina.&nbsp;</p>\r\n<p>Filipina diwakilkan oleh Albert Lopez dan tinggal di Miangas. Sayangnya, saat detikcom berkunjung, Albert Lopez sedang dalam masa cuti dan kembali ke Filipina.</p>\r\n<p>Dari sinilah kebutuhan-kebutuhan Miangas didapatkan. Jika ada warga Filipina yang ingin barter atau dagang ke Miangas, Lopez akan segera memberitahu bahan-bahan apa saja yang diperlukan.</p>\r\n<p>\"Yang dicari kebutuhan 9 bahan pokok, seperti beras, sayur sampai daging,\" tambah Sepno.</p>\r\n<p>Lantas seberapa penting adanya jalur lintas batas ini?</p>\r\n<p>\"Merujuk dari tahun 2002 dalam Border Trait Area, bahwa implikasi perdagangan bebas ini sebenarnya dirasakan apabila diberdayakan. Sebelum adanya pengetatan hukum di tahun 70an, masyarakat sering melakukan perdagangan ke Filipina,\" tutur Sepno.</p>\r\n<p>Masalah atau kendala yang seringkali dihadapi oleh BCA Miangas biasanya adalah surat ijin tinggal. Ini sudah lazim terjadi, karena sejak dulu Filipina bisa masuk dengan mudah ke Miangas.</p>\r\n<p>\"Kalau ada pelintas batas yang sakit di Miangas, maka ia akan dirujuk ke rumah sakit terdekat dengan aturan standar yang sudah ditetapkan,\" lanjut Sepno.</p>\r\n<p>TNI yang betugas di BCA bukan cuma mengawasi lalu lintas warga Filipina dan Miangas. Mereka juga melakukan pengecekan dokumen bersama pihak imigrasi.</p>\r\n<p>detikcom bersama Bank BRI mengadakan program Tapal Batas yang mengulas mengenai perkembangan infrastruktur, ekonomi, hingga wisata di beberapa wilayah terdepan.</p>', 'Miangas di Kabupaten Talaud, Sulawesi Utara bukan cuma sekedar pulau eksotis. Berada di ujung utara Indonesia, Miangas jadi perbatasan dengan Filipina.', 'mengenal-area-lintas-batas-negara-di-utara-indonesia.jpg', 'Border Cross Area di Miangas (Muhammad Ridho)', 'PopojiCMS,CMS Indonesia', 'general', 'Y', 'Y', 'Y', 1, 2, 1, '2019-10-14 22:55:02', '2019-11-12 21:25:38'),
(6, 3, 'Pantai Mera, Si Cantik dari Pulau Miangas', 'pantai-mera-si-cantik-dari-pulau-miangas', '<p><strong>Miangas</strong> - Lambaian nyiur, pasir putih, dan dinginnya air laut menjadi salah satu daya tarik wisata di Miangas. Santai sejenak dan hilangkan penat, selamat datang di Pantai Mera.</p>\r\n<p>Miangas memang punya arti menangis. Meski dihadapkan dengan kehidupan yang keras, alam Miangas sungguhlah kaya.</p>\r\n<p>detikcom bersama Bank BRI melakukan ekspedisi di pulau perbatasan ini. Pulau seluas 3,2 km persegi ini menyimpan potensi wisata yang mendalam.</p>\r\n<p>Inilah Pantai Mera, area wisata yang jauh dari pemukiman warga ini siap untuk dijelajahi. Pantai Mera berada di arah utara Pulau Miangas.&nbsp;</p>\r\n<p>Kalau menggunakan motor, pantai ini bisa dicapai sekitar 10 menit. Tapi karena jarangnya kendaraan, kamu bisa sampai di pantai ini dengan waktu 20 menit dengan berjalan kaki.</p>\r\n<p>Masih sangat alami, kamu mesti berhati-hati untuk masuk ke pantai ini. Bekas tebangan kelapa dan talud menyembunyikan keindahan Mera.</p>\r\n<p>Teriknya pulau ini menjadi satu alasan buat kamu untuk main ke Pantai Mera. Pasirnya putih halus dan air laut yang dingin akan menyegarkan badan yang penuh dengan peluh.</p>\r\n<p>Berkarakter karang, kamu yang mau berenang tetap haru hati-hati. Belum lagi ombak besar yang bisa datang tiba-tiba. Asal waspada, kamu bisa menikmati Pantai Mera dengan maksimal.</p>\r\n<p>Karena sedikitnya angka kunjungan wisatawan ke pulau ini, tak perlu takut untuk kehabisan spot foto. Sepanjang garis pantai ini akan jadi milikmu seorang.</p>\r\n<p>Serasa di pulau pribadi, Miangas menjadi salah satu tempat wisata seksi untuk traveler. Lihat saja foto-foto pantai ini yang begitu kosong.</p>\r\n<p>Namun tetap jaga kelakuan dan tidak membuang sampah sembarangan ya. Selain menjadi tempat wisata, Pantai Mera juga jadi tempat pertahanan leluhur Miangas.</p>\r\n<p>Sehingga adat sopan dan santun harus selalu dijaga dalam tiap jengkal pulau ini. Kamu boleh piknik di pantai ini asal membawa kembali sampahmu.</p>\r\n<p>Gratis dan terbuka untuk umum, wisatawan tak perlu takut untuk datang ke Pantai Mera. Bicara soal transaksi liburan, traveler bisa tarik tunai di satu-satunya bank Miangas, BRI. Liburan jadi lebih mudah.</p>\r\n<p>detikcom bersama Bank BRI mengadakan program Tapal Batas yang mengulas mengenai perkembangan infrastruktur, ekonomi, hingga wisata di beberapa wilayah terdepan.</p>', 'Lambaian nyiur, pasir putih, dan dinginnya air laut menjadi salah satu daya tarik wisata di Miangas.', 'pantai-mera-si-cantik-dari-pulau-miangas.jpg', 'Pantai Mera (Bonauli/detikcom)', 'PopojiCMS,CMS Indonesia', 'general', 'Y', 'N', 'Y', 1, 2, 1, '2019-10-14 22:58:26', '2019-11-13 15:00:11'),
(7, 4, '7 Kuliner Khas Manado yang Dijamin Bikin Ketagihan!', '7-kuliner-khas-manado-yang-dijamin-bikin-ketagihan', '<p><strong>Manado</strong> - Kota Manado dikenal mempunyai objek-objek wisata yang sangat indah. Karena itu, banyak sekali pengunjung baik dari dalam maupun luar negeri yang berbondong-bondong datang ke kota yang satu ini.</p>\r\n<p>Saat mendengar kota Manado, mungkin benak anda langsung terlintas tentang taman laut Bunaken dan Monumen Yesus Memberkati, sebagai objek wisata paling iconic di Manado.\\</p>\r\n<p>Namun, dari sekian banyak hal yang dicari, kamu wajib mencoba kuliner khas Manado yang dijamin bakal membuat kamu ketagihan. Berikut ini adalah 7 makanan khas Manado yang harus kamu coba saat berkunjung ke Manado.</p>\r\n<p><strong>1. Tinutuan (Bubur Manado)</strong></p>\r\n<p>Tinutuan atau bubur Manado merupakan makanan yang khas dari Manado yang tak hanya di kenal di Manado, tetapi juga terkenal di seluruh Indonesia.</p>\r\n<p>Makanan ini sering disebut makanan yang sangat sehat karena komposisinya yang mengandung banyak sayur dan zat baik yang berguna untuk tubuh. Biasanya tinutuan disajikan bersama ikan, aneka gorengan, sambal, dan pelengkap lainnya.</p>\r\n<hr />\r\n<p><strong>2. Cakalang Fufu Saos</strong></p>\r\n<p>Cakalang fufu adalah ikan khas Manado yang sangat enak. Cakalang juga diketahui merupakan jenis ikan yang tidak hanya enak, tetapi juga banyak manfaat bagi tubuh kita. Kandungan cakalang diketahui mampu untuk meningkatkan kecerdasan dan daya ingat otak serta membantu pemulihan depresi.</p>\r\n<p>Cakalang saos ini merupakan makanan khas Manado yang bercita rasa pedas dan kaya akan bumbu. Saos yang dicampurkan mirip seperti bumbu balado.</p>\r\n<hr />\r\n<p><strong>3. Ikan Woku</strong></p>\r\n<p>Makanan yang satu ini juga kaya akan bumbu. Biasanya, woku bisa dimasak dengan berbagai jenis ikan sesuai dengan selera. Jenis ikan yang sering dipakai dalam masakan ini adalah tuna, cakalang dan mujair.</p>\r\n<p>Rasa bumbu woku sangat kaya akan rempah seperti sereh, daun lemon, kemangi, kunyit, dll, sehingga kamu bakal ketagihan.</p>\r\n<hr />\r\n<p><strong>4. Sambal Roa</strong></p>\r\n<p>Dari bermacam-macam sambal yang ada, sambal roa adalah sambal khas Manado yang paling terkenal dan laris saat dijual. Biasanya sambal roa dihidangkan dengan berbagai jenis makanan ataupun gorengan. Bahkan banyak orang juga memakan sambal roa hanya dengan seporsi nasi panas.</p>\r\n<p>Sambal roa sendiri dibuat dari ikan roa yang telah di asap dan dijemur berhari-hari sampai kering, kemudian dihaluskan dan dicampur dengan bumbu sambal racikan khas Manado. Dijamin susah lupa deh sama Manado!</p>\r\n<hr />\r\n<p><strong>5. Pisang Goroho Goreng</strong></p>\r\n<p>Mungkin kamu banyak menjumpai pisang goreng yang pada umumnya dipotong seperti jari-jari dan dilabur tepung. Tetapi, kamu hanya bisa menemukan pisang goreng dari pisang jenis goroho di Manado. Rasa dari pisang goroho sangat enak.</p>\r\n<p>Pisang ini digoreng dengan irisan yang tipis sehingga gurih untuk dimakan. Kamu juga bisa makan pisang ini dengan mencelupkannya kedalam sambal roa atau jenis sambal lainnya. Lebih nikmat lagi jika pisang goroho ini disajikan dengan segelas teh atau kopi.</p>\r\n<hr />\r\n<p><strong>6. Klapertart</strong></p>\r\n<p>Makanan yang satu ini merupakan jenis dessert terkenal khas Manado. Bahan dasar klapertart adalah kelapa muda yang masih fresh kemudian dicampur dengan kismis, keju, kenari dan bahan adonan lainnya. Tekstur dari klapertart sangat kental dan cita rasanya yang creamy mampu membuat anda ketagihan.</p>\r\n<hr />\r\n<p><strong>7. Gohu&nbsp;</strong></p>\r\n<p>Gohu merupakan asinan buah yang sangat digemari oleh orang Manado. Gohu dibuat dengan menggunakan buah pepaya, timun ataupun nenas dan dicampurkan kedalam campuran air, cuka atau lemon, cabe rawit, jahe, gula merah dan garam secukupnya.</p>\r\n<p>Lebih nikmat jika kamu menyantapnya dalam keadaan dingin. Biasanya, banyak tempat makan yang menyediakan asinan ini baik yang dingin ataupun yang biasa.</p>\r\n<p>Itulah 7 kuliner yang harus kamu cicipi saat berkunjung ke Manado. Dijamin pasti enak dan ketagihan!</p>', 'Kota Manado dikenal mempunyai objek-objek wisata yang sangat indah. Karena itu, banyak sekali pengunjung baik dari dalam maupun luar negeri yang berbondong-bondong datang ke kota yang satu ini.', '7-kuliner-khas-manado-yang-dijamin-bikin-ketagihan.jpg', 'Masak Itu Gampang Bakal susah move on sama Manado nih', 'PopojiCMS,CMS Indonesia,Manado', 'pagination', 'Y', 'Y', 'Y', 4, 2, 1, '2019-10-14 23:07:35', '2019-11-13 15:16:08'),
(8, 4, 'Woku Balanga dan Tinoransak Disajikan di Java', 'woku-balanga-dan-tinoransak-disajikan-di-java', '<p><strong>Jakarta</strong> - Tinoransak yang dibalut dengan bumbu menyengat ini dijamin bakal bikin keringat berlelehan. Cocok buat lidah para penyuka hidangan Manado yang terkenal pedas. Untuk penggemar dabu-dabu jangan lupa cobain Udang bakar Dabu-Dabu yang bisa bikin ketagihan. Mau?</p>\r\n<p>Setelah sukses dengan rangkaian promo \'Pasar Senggol\' yang menghadirkan beragam kuliner tradisional dari seluruh Indonesia, seperti Sumatera, Jawa, dan Bali. Kini Java Restaurant menghadirkan makanan bercita rasa hot &amp; spicy asal Manado. Hidangan yang memiliki penggemar tersendiri ini bakal digelar hingga akhir Juli 2011.</p>\r\n<p>Masakan Manado memang terkenal dengan citarasanya yang hot &amp; spicy. Selain itu hidangan Manado juga terkenal royal dalam pemakaian bumbu sehingga sedap rasanya. Misalkan saja ayam woku blanga yang banyak disajikan di berbagai restoran Manado atau Tonoransak yang pedas mengigit.</p>\r\n<p>Tinotuan alias bubur Manado sendiri bakal diracik dan disajikan sesaat setelah dipesan. Selain itu tak lengkap rasanya jika belum menikmati Cakalang Pampis, Ayam Woku Belanga, Tumis Bunga Pepaya dan Bruinnebon. Jajanan khas Manado yang ditawarkan oleh Java Restaurant yang terletak di lanta 2, InterContinental Jakarta MidPlaza ini juga sayang untuk dilewatkan.</p>\r\n<p>Ada panada yang berisi ikan cakalang dengan sensasi rasa pedas. Kue khas Manado yang ini tak hanya aromanya yang wangi tetapi juga enak rasanya. Selain itu pengunjung juga bisa mencicipi lalampa, klapertart yang manis, dan kue bugis yang manis-manis gurih.</p>\r\n<p>Kesemua hidangan buffet tersebut dapat dinikmati sepuas hati cukup dengan membayar Rp 188.000++ per orang. Gimana, sudah tak sabar ingin merasakan sengatan masakan Manado yang pedas ini? Sebelum datang berkunjung ada baiknya melakukan reservasi terlebih dahulu di 021-2510888. Mari makan joo!</p>', 'Tinoransak yang dibalut dengan bumbu menyengat ini dijamin bakal bikin keringat berlelehan.', 'woku-balanga-dan-tinoransak-disajikan-di-java.jpg', 'Rasa bumbu woku sangat kaya akan rempah', 'PopojiCMS,CMS Indonesia,Manado', 'general', 'Y', 'N', 'Y', 1, 2, 1, '2019-10-14 23:10:16', '2019-11-13 14:57:02'),
(9, 5, 'Sensasi Kebas Tisu Magic, Diyakini Bikin \'Ngegas\' dan Tahan Lama', 'sensasi-kebas-tisu-magic-diyakini-bikin-ngegas-dan-tahan-lama', '<p><strong>Jakarta</strong> - OS (28), wanita pekerja seks komersial (PSK) online di Kabupaten Karawang, Jawa Barat dibunuh oleh Ridwan Solihin alias Emen. Ia mengaku menggunakan tisu magic sebelum berhubungan intim dengan OS.</p>\r\n<p>Tisu magic merupakan sebutan populer dari salah satu produk tisu khusus pria dewasa. Biasanya tisu magic ini dijual bersama kondom dan diklaim sebagai salah satu cara memperbaiki vitalitas pria.</p>\r\n<p>Pakar andrologi dan seksologi Profesor Dr dr Wimpie Pangkahila, SpAnd, FAACS pernah mengatakan, tisu magic sering dianggap sebagai \'obat kuat\' karena sifatnya yang bisa seperti anestesi lokal. Dengan demikian diharapkan para pria bisa ereksi lebih lama serta mencegah terjadinya ejakulasi dini.</p>\r\n<p>\"Harapannya adalah tidak cepat mengalami ejakulasi karena kulit sekitar area sensitif telah kebas atau mati rasa. Pada beberapa orang mungkin ada efeknya, tapi tidak mengatasi persoalan yang sebenarnya. Jika memang mengalami ejakulasi dini pergilah berobat yang benar supaya masalah segera teratasi,\" kata Prof Wimpie pada detikcom beberapa waktu lalu.</p>\r\n<p>Efek anastesi lokal yang terjadi karena tisu magic berfungsi seperti bius pada ujung penis. Dengan kulit yang mati rasa atau kebas selama kurun waktu tertentu, pria berharap bisa ereksi lebih lama. Padahal, ejakulasi dini tak hanya diakibatkan minimnya sensitivitas kulit pada area sensitif pria.</p>\r\n<p>\"Namanya juga usaha untuk mengatasi ejakulasi dini, tentu boleh mengusahakan berbagai cara. Namun efeknya tidak akan lama bagi yang sudah merasakan manfaatnya. Sedangkan bagi yang lain mungkin tidak merasakan manfaatnya, karena memang ejakulasi dini tidak bisa diatasi hanya dengan tisu magic,\" jelas Prof Wimpie.</p>\r\n<p>Hal yang disebut Prof Wimpie tercermin dari cerita pengalaman beberapa netizen yang mencoba tisu magic. Hilman (26) dari Ciputat misalnya mengaku memang bisa merasa jadi dua kali lebih lama saat bercinta. Namun bagi Adi (33) hal sebaliknya terjadi karena malah jadi kesulitan ereksi karena saking kebasnya.</p>\r\n<p>\"Dibungkus paling beberapa detik doang tapi digosok sampai rata. Enggak bisa (ereksi -red),\" kata Adi.</p>', 'Tisu magic merupakan sebutan populer dari salah satu produk tisu khusus pria dewasa. Biasanya tisu magic ini dijual bersama kondom dan diklaim sebagai salah satu cara memperbaiki vitalitas pria.', 'sensasi-kebas-tisu-magic-diyakini-bikin-ngegas-dan-tahan-lama.jpg', 'Ilustrasi tisu magic. Foto: iStock', 'PopojiCMS,CMS Indonesia', 'general', 'Y', 'Y', 'Y', 1, 2, 1, '2019-10-14 23:13:56', '2019-11-13 15:09:52'),
(10, 5, 'Apa Benar Minum Air dengan Lemon Bisa Menguruskan Badan?', 'apa-benar-minum-air-dengan-lemon-bisa-menguruskan-badan', '<p><strong>Jakarta</strong> - Sudah sering kita dengarkan anjuran untuk segera meminum segelas air dengan perasan atau potongan buah lemon saat bangun tidur. Anjuran ini biasanya dilakukan mereka yang sedang berusaha menurunkan berat badan.</p>\r\n<p>Segelas air lemon dalam perut kosong bisa membantu membuang lemak. Namun benarkah hal ini sebenarnya?</p>\r\n<p>Situs Times of India menyebutkan para ahli tidak menyetujui adanya pemikiran lemon segar yang diperas ke dalam air akan membantu menurunkan berat badan. Akan tetapi, jika kamu menggunakan minuman ini sebagai minuman pengganti yang banyak kalori seperi susu atau jus buah, maka bisa membantumu untuk mengurangi jumlah kalori untuk menurunkan badan.</p>\r\n<p>\"Menjaga tubuh tetap terhidrasi juga menjadi salah satu komponen penting saat menurunkan berat badan. Hal ini disebabkan tubuh kita kadang mengartikan haus sebagai rasa lapar sehingga kita menjadi makan lebih banyak dari kalori yang kita butuhkan. Air lemon membantu kita tetap terhidrasi,\" demikian dilaporkan situs tersebut.</p>\r\n<p>Sebuah studi yang dipublikasikan dalam Journal of Clinical Biochemistry and Nutrition menemukan bahwa polifenol atau senyawa tumbuhan yang berperan seperti antioksidan dalam jus lemon dan juga kulitnya yang bisa menstimulasi hati atau liver untuk membakar lemak.</p>\r\n<p>Studi tersebut dilakukan pada tikus percobaan yang telah diberi makan tinggi lemak sehingga hasilnya tidak terlalu benar-benar bisa dikaitkan dengan manusia kecuali melakukan diet ketogentik.</p>\r\n<p>Tak ada minuman yang secara ajaib bisa membantu menurunkan berat badan dan menjadi langsing. Untuk mendapatkannya setidaknya ubah pola makan menjadi sehat dan tetap aktif untuk menurunkan bobot dengan cara yang seimbang dan sehat. Dan perlu diingat bahwa lemon mengandung asam yang bisa mengganggu pencernaanmu saat kosong.</p>', 'Situs Times of India menyebutkan para ahli tidak menyetujui adanya pemikiran lemon segar yang diperas ke dalam air akan membantu menurunkan berat badan.', 'apa-benar-minum-air-dengan-lemon-bisa-menguruskan-badan.jpg', 'Air lemon disebut bisa membantu menurunkan berat badan (Foto: iStock)', 'PopojiCMS,CMS Indonesia', 'general', 'Y', 'N', 'Y', 1, 2, 1, '2019-10-14 23:15:50', '2019-11-13 15:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `post_gallerys`
--

DROP TABLE IF EXISTS `post_gallerys`;
CREATE TABLE IF NOT EXISTS `post_gallerys` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2019-10-04 18:58:36', '2019-10-04 18:58:36'),
(2, 'admin', 'web', '2019-10-04 18:58:54', '2019-10-04 18:58:54'),
(3, 'editor', 'web', '2019-10-04 18:59:08', '2019-10-04 18:59:08'),
(4, 'member', 'web', '2019-10-04 18:59:16', '2019-10-04 18:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(55, 2),
(56, 2),
(57, 2),
(58, 2),
(59, 2),
(60, 2),
(61, 2),
(62, 2),
(63, 2),
(64, 2),
(2, 3),
(3, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(34, 3),
(35, 3),
(36, 3),
(49, 3),
(50, 3),
(51, 3),
(52, 3),
(2, 4),
(3, 4),
(17, 4),
(18, 4),
(19, 4),
(20, 4);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `groups` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `groups`, `options`, `value`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'General', 'web_name', 'PopojiCMS - Engine Management System Indonesia, Buat Sendiri Rasa Webmu', 1, 1, '2019-10-05 20:48:11', '2019-10-05 21:02:02'),
(2, 'General', 'web_url', 'https://www.popojicms.org', 1, 1, '2019-10-05 21:12:28', '2019-10-05 21:12:28'),
(3, 'General', 'web_description', 'PopojiCMS - CMS Indonesia, buat sendiri rasa webmu, menawarankan konsep web yang menarik dan simpel tentunya, bisa dijadikan alternatif engine web anda, karena kami adalah CMS Gratis Indonesia', 1, 1, '2019-10-05 21:13:01', '2019-10-05 21:13:01'),
(4, 'General', 'web_keyword', 'popojicms buat sendiri rasa webmu', 1, 1, '2019-10-05 21:13:42', '2019-10-05 21:13:42'),
(5, 'General', 'web_author', 'PopojiCMS', 1, 1, '2019-10-05 21:13:56', '2019-10-05 21:13:56'),
(6, 'General', 'email', 'info@popojicms.org', 1, 1, '2019-10-05 21:14:09', '2019-10-05 21:14:09'),
(7, 'General', 'telephone', '0895801846132', 1, 1, '2019-10-05 21:14:26', '2019-10-05 21:14:26'),
(8, 'General', 'fax', '000-0000-0000', 1, 1, '2019-10-05 21:14:38', '2019-10-05 21:14:38'),
(9, 'General', 'address', 'DKI Jakarta, Indonesia', 1, 1, '2019-10-05 21:14:50', '2019-10-05 21:14:50'),
(10, 'General', 'latitude', '-6.1753871', 1, 1, '2019-10-05 21:15:21', '2019-10-05 21:15:21'),
(11, 'General', 'longitude', '106.8249641', 1, 1, '2019-10-05 21:15:54', '2019-10-05 21:15:54'),
(12, 'General', 'facebook', 'https://www.facebook.com/dwira.survivor', 1, 1, '2019-10-05 21:16:37', '2019-10-05 21:16:37'),
(13, 'General', 'twitter', 'https://www.twitter.com/DwiraSurvivor', 1, 1, '2019-10-05 21:16:57', '2019-10-05 21:16:57'),
(14, 'General', 'youtube', 'https://www.youtube.com', 1, 1, '2019-10-05 21:17:12', '2019-10-05 21:17:12'),
(15, 'Image', 'favicon', 'favicon.png', 1, 1, '2019-10-05 21:17:38', '2019-10-05 21:20:17'),
(16, 'Image', 'logo', 'logo-inews.png', 1, 1, '2019-10-05 21:20:27', '2019-10-31 15:24:50'),
(17, 'Image', 'medium_size', '640x480', 1, 1, '2019-10-05 21:23:00', '2019-10-05 21:23:00'),
(18, 'Config', 'maintenance_mode', 'N', 1, 1, '2019-10-05 21:33:27', '2019-10-05 21:34:46'),
(19, 'Config', 'member_registration', 'N', 1, 1, '2019-10-05 21:33:54', '2019-10-05 21:34:53'),
(20, 'Config', 'comment', 'Y', 1, 1, '2019-10-05 21:34:21', '2019-10-05 21:35:01'),
(21, 'Config', 'item_per_page', '5', 1, 1, '2019-10-05 21:34:40', '2019-10-05 21:35:09'),
(22, 'Config', 'google_analytics_id', '-', 1, 1, '2019-10-05 21:35:45', '2019-10-05 21:35:45'),
(23, 'Config', 'recaptcha_key', '6LckEgETAAAAAPdqrQSY_boMDLZRL1vpkAatVqKf', 1, 1, '2019-10-05 21:36:15', '2019-10-05 21:36:46'),
(24, 'Config', 'recaptcha_secret', '6LckEgETAAAAAHqx4VFD4zNL96P9UEikD8BHfT28', 1, 1, '2019-10-05 21:36:40', '2019-10-05 21:36:40'),
(25, 'Mail', 'mail_protocol', 'SMTP', 1, 1, '2019-10-05 21:37:27', '2019-10-05 21:37:27'),
(26, 'Mail', 'mail_hostname', 'mail.popojicms.org', 1, 1, '2019-10-05 21:37:51', '2019-10-05 21:37:51'),
(27, 'Mail', 'mail_username', 'noreply@popojicms.org', 1, 1, '2019-10-05 21:39:13', '2019-10-05 21:39:13'),
(28, 'Mail', 'mail_password', '-', 1, 1, '2019-10-05 21:39:33', '2019-10-05 21:39:33'),
(29, 'Mail', 'mail_port', '465', 1, 1, '2019-10-05 21:39:51', '2019-10-05 21:39:51'),
(30, 'Other', 'sitemap', 'sitemap.xml', 1, 1, '2019-10-15 20:01:21', '2019-10-15 20:01:21'),
(31, 'Other', 'sitemap_priority', '0.8', 1, 1, '2019-10-15 20:08:49', '2019-10-16 19:18:58'),
(32, 'Other', 'sitemap_frequency', 'monthly', 1, 1, '2019-10-16 19:25:16', '2019-10-16 19:25:16'),
(33, 'Other', 'backup', 'backup', 1, 1, '2019-10-16 19:32:50', '2019-10-16 19:32:50'),
(34, 'Image', 'logo_footer', 'logo-inews-white.png', 1, 1, '2019-10-31 15:26:25', '2019-10-31 15:27:48'),
(35, 'Config', 'slug', 'detailpost/slug', 1, 1, '2019-11-13 14:32:55', '2019-11-13 15:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `subscribes`
--

DROP TABLE IF EXISTS `subscribes`;
CREATE TABLE IF NOT EXISTS `subscribes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `follow` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribes`
--

INSERT INTO `subscribes` (`id`, `name`, `email`, `follow`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Jenuar', 'djenuar@gmail.com', 'Y', 1, 1, '2019-10-14 22:15:33', '2019-10-14 22:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seotitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`, `seotitle`, `count`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'CMS Indonesia', 'cms-indonesia', 23, 1, 1, '2019-10-08 05:26:34', '2019-11-12 21:30:26'),
(2, 'PopojiCMS', 'popojicms', 24, 1, 1, '2019-10-08 05:26:34', '2019-11-12 21:30:26'),
(3, 'Manado', 'manado', 14, 1, 1, '2019-10-23 00:37:34', '2019-11-12 21:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `title`, `author`, `folder`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'INews', 'Dwira Survivor', 'inews', 'Y', 1, 1, '2019-10-30 20:55:25', '2019-10-30 20:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `block` enum('Y','N') COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `telp`, `bio`, `block`, `picture`, `remember_token`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin', 'super@popojicms.org', NULL, '$2y$10$c8E.t7.iivVy6wPxd/OILOJ7MKCcFHWWne4hZK.remhqn0jc4llDG', NULL, NULL, 'N', NULL, NULL, 1, 1, '2019-09-22 00:56:35', '2019-10-04 19:50:43'),
(2, 'Administrator', 'administrator', 'admin@popojicms.org', NULL, '$2y$10$23AX8B49BGmTz6ZjWJFNVuXJfg15A5wTREae5tBXl.xBC1JJHqW0K', NULL, NULL, 'N', '', NULL, 1, 1, '2019-10-15 00:36:38', '2019-10-15 00:36:48'),
(3, 'Editor', 'editor', 'editor@popojicms.org', NULL, '$2y$10$kBIdL1HlyetuidKQaU.KO.gCy/qC0BhXMAXfcWcGfAQjqM89ffWs2', NULL, NULL, 'N', '', NULL, 1, 1, '2019-10-15 00:37:15', '2019-10-15 00:37:15'),
(4, 'Member', 'member', 'member@popojicms.org', NULL, '$2y$10$1.gM.DcgTJvt9DEzAfT93edYiBQlOiFByKIXT/iUFOeSzwDgNDfGi', NULL, NULL, 'N', '', NULL, 1, 1, '2019-10-15 00:37:45', '2019-10-15 00:37:45');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
