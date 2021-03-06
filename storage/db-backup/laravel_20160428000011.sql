-- MySQL dump 10.16  Distrib 10.1.11-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	10.1.11-MariaDB

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
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cart_user_id_unique` (`user_id`),
  CONSTRAINT `cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL,
  `level` tinyint(3) unsigned NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `node` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `tab_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_index` (`parent_id`),
  KEY `categories_name_index` (`name`),
  KEY `categories_node_index` (`node`(255))
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,0,1,'root',',1,','','2016-04-22 13:47:17','2016-04-22 13:47:17'),(2,1,2,'民商类',',1,2,','ms','2016-04-22 13:47:17','2016-04-22 13:47:17'),(3,1,2,'刑事类',',1,3,','xs','2016-04-22 13:47:17','2016-04-22 13:47:17'),(4,1,2,'行政类',',1,4,','xz','2016-04-22 13:47:17','2016-04-22 13:47:17'),(5,2,3,'婚姻家庭',',1,2,5,','','2016-04-22 13:47:17','2016-04-22 13:47:17'),(6,2,3,'房产',',1,2,6,','','2016-04-22 13:47:17','2016-04-22 13:47:17'),(7,2,3,'债务',',1,2,7,','','2016-04-22 13:47:17','2016-04-22 13:47:17'),(8,2,3,'劳动争议',',1,2,8,','','2016-04-22 13:47:17','2016-04-22 13:47:17'),(9,2,3,'合同纠纷',',1,2,9,','','2016-04-22 13:47:17','2016-04-22 13:47:17'),(10,2,3,'损害赔偿',',1,2,10,','','2016-04-22 13:47:17','2016-04-22 13:47:17'),(11,2,3,'医疗纠纷',',1,2,11,','','2016-04-22 13:47:17','2016-04-22 13:47:17'),(12,2,3,'建设工程',',1,2,12,','','2016-04-22 13:47:17','2016-04-22 13:47:17'),(13,2,3,'著作权',',1,2,13,','','2016-04-22 13:47:17','2016-04-22 13:47:17'),(14,2,3,'商标权',',1,2,14,','','2016-04-22 13:47:17','2016-04-22 13:47:17'),(15,2,3,'专利权',',1,2,15,','','2016-04-22 13:47:17','2016-04-22 13:47:17'),(16,2,3,'土地',',1,2,16,','','2016-04-22 13:47:17','2016-04-22 13:47:17'),(17,2,3,'股权',',1,2,17,','','2016-04-22 13:47:17','2016-04-22 13:47:17'),(18,3,3,'刑事辩护',',1,3,18,','','2016-04-22 13:47:17','2016-04-22 13:47:17'),(19,4,3,'行政复议',',1,4,19,','','2016-04-22 13:47:17','2016-04-22 13:47:17'),(20,4,3,'行政诉讼',',1,4,20,','','2016-04-22 13:47:17','2016-04-22 13:47:17');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` decimal(20,2) DEFAULT NULL,
  `discount` decimal(3,2) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_code_unique` (`code`),
  KEY `coupons_code_expires_at_index` (`code`,`expires_at`),
  KEY `coupons_code_active_index` (`code`,`active`),
  KEY `coupons_code_active_expires_at_index` (`code`,`active`,`expires_at`),
  KEY `coupons_sku_index` (`sku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_actives`
--

DROP TABLE IF EXISTS `email_actives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_actives` (
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `email_actives_email_index` (`email`),
  KEY `email_actives_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_actives`
--

LOCK TABLES `email_actives` WRITE;
/*!40000 ALTER TABLE `email_actives` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_actives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `cart_id` bigint(20) unsigned DEFAULT NULL,
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` smallint(6) NOT NULL,
  `tax` decimal(20,2) NOT NULL DEFAULT '0.00',
  `shipping` decimal(20,2) NOT NULL DEFAULT '0.00',
  `currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `location_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `items_sku_cart_id_unique` (`sku`,`cart_id`),
  UNIQUE KEY `items_sku_order_id_unique` (`sku`,`order_id`),
  KEY `items_cart_id_foreign` (`cart_id`),
  KEY `items_user_id_sku_index` (`user_id`,`sku`),
  KEY `items_user_id_sku_cart_id_index` (`user_id`,`sku`,`cart_id`),
  KEY `items_user_id_sku_order_id_index` (`user_id`,`sku`,`order_id`),
  KEY `items_reference_id_index` (`reference_id`),
  CONSTRAINT `items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laravel_sms`
--

DROP TABLE IF EXISTS `laravel_sms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laravel_sms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `to` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `temp_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `data` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `voice_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `fail_times` mediumint(9) NOT NULL DEFAULT '0',
  `last_fail_time` int(10) unsigned NOT NULL DEFAULT '0',
  `sent_time` int(10) unsigned NOT NULL DEFAULT '0',
  `result_info` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laravel_sms`
--

LOCK TABLES `laravel_sms` WRITE;
/*!40000 ALTER TABLE `laravel_sms` DISABLE KEYS */;
/*!40000 ALTER TABLE `laravel_sms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likeable_like_counters`
--

DROP TABLE IF EXISTS `likeable_like_counters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likeable_like_counters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `likable_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `likable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `likeable_counts` (`likable_id`,`likable_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likeable_like_counters`
--

LOCK TABLES `likeable_like_counters` WRITE;
/*!40000 ALTER TABLE `likeable_like_counters` DISABLE KEYS */;
/*!40000 ALTER TABLE `likeable_like_counters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likeable_likes`
--

DROP TABLE IF EXISTS `likeable_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likeable_likes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `likable_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `likable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `likeable_likes_unique` (`likable_id`,`likable_type`,`user_id`),
  KEY `likeable_likes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likeable_likes`
--

LOCK TABLES `likeable_likes` WRITE;
/*!40000 ALTER TABLE `likeable_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likeable_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `locations_user_id_foreign` (`user_id`),
  CONSTRAINT `locations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,3,'home','北京市石景山区聚兴园小区','2016-04-26 16:41:34','2016-04-26 16:41:34'),(2,3,'work','北京市朝阳区三元桥幸福大厦','2016-04-26 16:41:34','2016-04-26 16:41:34');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2015_01_15_105324_create_roles_table',1),('2015_01_15_114412_create_role_user_table',1),('2015_01_26_115212_create_permissions_table',1),('2015_01_26_115523_create_permission_role_table',1),('2015_02_09_132439_create_permission_user_table',1),('2015_03_07_311070_create_tracker_paths_table',1),('2015_03_07_311071_create_tracker_queries_table',1),('2015_03_07_311072_create_tracker_queries_arguments_table',1),('2015_03_07_311073_create_tracker_routes_table',1),('2015_03_07_311074_create_tracker_routes_paths_table',1),('2015_03_07_311075_create_tracker_route_path_parameters_table',1),('2015_03_07_311076_create_tracker_agents_table',1),('2015_03_07_311077_create_tracker_cookies_table',1),('2015_03_07_311078_create_tracker_devices_table',1),('2015_03_07_311079_create_tracker_domains_table',1),('2015_03_07_311080_create_tracker_referers_table',1),('2015_03_07_311081_create_tracker_geoip_table',1),('2015_03_07_311082_create_tracker_sessions_table',1),('2015_03_07_311083_create_tracker_errors_table',1),('2015_03_07_311084_create_tracker_system_classes_table',1),('2015_03_07_311085_create_tracker_log_table',1),('2015_03_07_311086_create_tracker_events_table',1),('2015_03_07_311087_create_tracker_events_log_table',1),('2015_03_07_311088_create_tracker_sql_queries_table',1),('2015_03_07_311089_create_tracker_sql_query_bindings_table',1),('2015_03_07_311090_create_tracker_sql_query_bindings_parameters_table',1),('2015_03_07_311091_create_tracker_sql_queries_log_table',1),('2015_03_07_311092_create_tracker_connections_table',1),('2015_03_07_311093_create_tracker_tables_relations',1),('2015_03_13_311094_create_tracker_referer_search_term_table',1),('2015_03_13_311095_add_tracker_referer_columns',1),('2015_10_24_10000_create_ratings_table',1),('2015_11_23_311096_add_tracker_referer_column_to_log',1),('2015_12_21_111514_create_sms_table',1),('2016_03_18_033623_create_email_actives_table',1),('2016_03_28_151757_shop_setup_tables',1),('2016_03_28_215331_create_categories_table',1),('2016_03_30_135842_create_locations_table',1),('2016_03_31_175605_create_pois_table',1),('2016_03_31_220930_create_profiles_table',1),('2016_04_01_115432_create_user_category_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_status` (
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_status`
--

LOCK TABLES `order_status` WRITE;
/*!40000 ALTER TABLE `order_status` DISABLE KEYS */;
INSERT INTO `order_status` VALUES ('accepted','Accepted','律师已接单','0000-00-00 00:00:00','0000-00-00 00:00:00'),('canceled','Canceled','顾客取消订单','0000-00-00 00:00:00','0000-00-00 00:00:00'),('completed','Completed','订单已完成','0000-00-00 00:00:00','0000-00-00 00:00:00'),('failed','Failed','Failed order. Payment or other process failed.','0000-00-00 00:00:00','0000-00-00 00:00:00'),('in_creation','In creation','订单创建成功','0000-00-00 00:00:00','0000-00-00 00:00:00'),('in_process','In process','一方已签到','0000-00-00 00:00:00','0000-00-00 00:00:00'),('payed','Payed','顾客订单已付款','0000-00-00 00:00:00','0000-00-00 00:00:00'),('pending','Pending','顾客尚未付款','0000-00-00 00:00:00','0000-00-00 00:00:00'),('rejected','Rejected','律师已拒单','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `order_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `statusCode` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `billing_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_no` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refunded` tinyint(1) NOT NULL DEFAULT '0',
  `attach` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `orders_statuscode_foreign` (`statusCode`),
  KEY `orders_user_id_statuscode_index` (`user_id`,`statusCode`),
  KEY `orders_id_user_id_statuscode_index` (`id`,`user_id`,`statusCode`),
  CONSTRAINT `orders_statuscode_foreign` FOREIGN KEY (`statusCode`) REFERENCES `order_status` (`code`) ON UPDATE CASCADE,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (4,2,1,'2016-04-25 08:36:45','2016-04-25 08:36:45'),(5,2,3,'2016-04-25 08:36:45','2016-04-25 08:36:45'),(6,2,4,'2016-04-25 08:36:45','2016-04-25 08:36:45'),(7,2,5,'2016-04-25 08:36:45','2016-04-25 08:36:45');
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_index` (`permission_id`),
  KEY `permission_user_user_id_index` (`user_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_user`
--

LOCK TABLES `permission_user` WRITE;
/*!40000 ALTER TABLE `permission_user` DISABLE KEYS */;
INSERT INTO `permission_user` VALUES (1,2,3,'2016-04-22 13:53:04','2016-04-22 13:53:04'),(2,3,3,'2016-04-22 13:53:04','2016-04-22 13:53:04');
/*!40000 ALTER TABLE `permission_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (2,'oo user','oo.user','asdfsa',NULL,'2016-04-22 13:53:04','2016-04-25 08:36:45'),(3,'xx user','xx.user',NULL,NULL,'2016-04-22 13:53:04','2016-04-22 13:53:04'),(5,'查看用户','show.user','查看用户',NULL,'2016-04-24 15:53:32','2016-04-24 15:53:32'),(6,'修改用户','edit.user','修改用户',NULL,'2016-04-24 15:55:03','2016-04-24 15:55:03'),(7,'关闭台灯','xx.deng','asd',NULL,'2016-04-24 15:58:57','2016-04-24 15:58:57');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `places`
--

DROP TABLE IF EXISTS `places`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `places` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `price` smallint(5) unsigned NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attach` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `places`
--

LOCK TABLES `places` WRITE;
/*!40000 ALTER TABLE `places` DISABLE KEYS */;
/*!40000 ALTER TABLE `places` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pois`
--

DROP TABLE IF EXISTS `pois`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pois` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `poi_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pois`
--

LOCK TABLES `pois` WRITE;
/*!40000 ALTER TABLE `pois` DISABLE KEYS */;
/*!40000 ALTER TABLE `pois` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rating` int(11) NOT NULL,
  `ratingable_id` int(10) unsigned NOT NULL,
  `ratingable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  `author_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `ratings_ratingable_id_ratingable_type_index` (`ratingable_id`,`ratingable_type`),
  KEY `ratings_author_id_author_type_index` (`author_id`,`author_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,1,'2016-04-22 13:47:43','2016-04-22 13:47:43'),(3,3,3,'2016-04-22 13:47:43','2016-04-22 13:47:43'),(4,1,3,'2016-04-22 13:47:43','2016-04-22 13:47:43');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'大律师','lawyer','律师',2,'2016-04-22 13:47:43','2016-04-24 16:03:12'),(3,'管理员','admin','管理员',2,'2016-04-22 13:47:43','2016-04-24 10:12:24'),(4,'付费用户','payment','付费用户',1,'2016-04-24 16:03:48','2016-04-24 16:03:48'),(5,'VIP','vip','vip',1,'2016-04-24 16:04:50','2016-04-24 16:04:50');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_agents`
--

DROP TABLE IF EXISTS `tracker_agents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_agents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `browser` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `browser_version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tracker_agents_name_unique` (`name`),
  KEY `tracker_agents_browser_index` (`browser`),
  KEY `tracker_agents_created_at_index` (`created_at`),
  KEY `tracker_agents_updated_at_index` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_agents`
--

LOCK TABLES `tracker_agents` WRITE;
/*!40000 ALTER TABLE `tracker_agents` DISABLE KEYS */;
INSERT INTO `tracker_agents` VALUES (1,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36','Chrome','45.0.2454','2016-04-22 13:47:42','2016-04-22 13:47:42'),(2,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36','Chrome','49.0.2623','2016-04-22 13:53:41','2016-04-22 13:53:41'),(3,'Mozilla/5.0 (Linux; Android 4.4.2; PE-TL10 Build/HuaweiPE-TL10) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/37.0.0.0 Mobile MQQBrowser/6.2 TBS/036215 Safari/537.36 MicroMessenger/6.3.16.49_r03ae324.780 NetType/3gnet Language/zh_CN','Chrome Mobile','37.0.0','2016-04-25 08:37:14','2016-04-25 08:37:14'),(4,'Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9b4) Gecko/2008030317 Firefox/3.0b4','Firefox Beta','3.0.b4','2016-04-25 08:37:17','2016-04-25 08:37:17'),(5,'Mozilla/5.0 (Linux; U; Android 4.0.2; en-us; Galaxy Nexus Build/ICL53F) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30','Android','4.0.2','2016-04-25 08:43:49','2016-04-25 08:43:49'),(6,'Other','Other','','2016-04-25 09:48:51','2016-04-25 09:48:51'),(7,'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:11.0) Gecko/20100101 Firefox/11.0','Firefox','11.0','2016-04-25 13:56:05','2016-04-25 13:56:05');
/*!40000 ALTER TABLE `tracker_agents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_connections`
--

DROP TABLE IF EXISTS `tracker_connections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_connections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_connections_name_index` (`name`),
  KEY `tracker_connections_created_at_index` (`created_at`),
  KEY `tracker_connections_updated_at_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_connections`
--

LOCK TABLES `tracker_connections` WRITE;
/*!40000 ALTER TABLE `tracker_connections` DISABLE KEYS */;
/*!40000 ALTER TABLE `tracker_connections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_cookies`
--

DROP TABLE IF EXISTS `tracker_cookies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_cookies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tracker_cookies_uuid_unique` (`uuid`),
  KEY `tracker_cookies_created_at_index` (`created_at`),
  KEY `tracker_cookies_updated_at_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_cookies`
--

LOCK TABLES `tracker_cookies` WRITE;
/*!40000 ALTER TABLE `tracker_cookies` DISABLE KEYS */;
/*!40000 ALTER TABLE `tracker_cookies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_devices`
--

DROP TABLE IF EXISTS `tracker_devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_devices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kind` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `platform` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `platform_version` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `is_mobile` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tracker_devices_kind_model_platform_platform_version_unique` (`kind`,`model`,`platform`,`platform_version`),
  KEY `tracker_devices_kind_index` (`kind`),
  KEY `tracker_devices_model_index` (`model`),
  KEY `tracker_devices_platform_index` (`platform`),
  KEY `tracker_devices_platform_version_index` (`platform_version`),
  KEY `tracker_devices_created_at_index` (`created_at`),
  KEY `tracker_devices_updated_at_index` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_devices`
--

LOCK TABLES `tracker_devices` WRITE;
/*!40000 ALTER TABLE `tracker_devices` DISABLE KEYS */;
INSERT INTO `tracker_devices` VALUES (1,'Computer','WebKit','Windows 10','',0,'2016-04-22 13:47:42','2016-04-22 13:47:42'),(2,'Phone','WebKit','Android','4.4.2',1,'2016-04-25 08:37:14','2016-04-25 08:37:14'),(3,'Phone','0','Windows XP','',1,'2016-04-25 08:37:17','2016-04-25 08:37:17'),(4,'Phone','Nexus','Android','4.0.2',1,'2016-04-25 08:43:49','2016-04-25 08:43:49'),(5,'Computer','0','Other','',0,'2016-04-25 09:48:51','2016-04-25 09:48:51'),(6,'Computer','0','Ubuntu','',0,'2016-04-25 13:56:05','2016-04-25 13:56:05');
/*!40000 ALTER TABLE `tracker_devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_domains`
--

DROP TABLE IF EXISTS `tracker_domains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_domains` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_domains_name_index` (`name`),
  KEY `tracker_domains_created_at_index` (`created_at`),
  KEY `tracker_domains_updated_at_index` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_domains`
--

LOCK TABLES `tracker_domains` WRITE;
/*!40000 ALTER TABLE `tracker_domains` DISABLE KEYS */;
INSERT INTO `tracker_domains` VALUES (1,'33.160','2016-04-22 13:48:37','2016-04-22 13:48:37'),(2,'exingdong.com','2016-04-25 08:36:32','2016-04-25 08:36:32');
/*!40000 ALTER TABLE `tracker_domains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_errors`
--

DROP TABLE IF EXISTS `tracker_errors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_errors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_errors_code_index` (`code`),
  KEY `tracker_errors_message_index` (`message`),
  KEY `tracker_errors_created_at_index` (`created_at`),
  KEY `tracker_errors_updated_at_index` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_errors`
--

LOCK TABLES `tracker_errors` WRITE;
/*!40000 ALTER TABLE `tracker_errors` DISABLE KEYS */;
INSERT INTO `tracker_errors` VALUES (1,'404','','2016-04-22 13:48:11','2016-04-22 13:48:11'),(2,'1','Call to a member function find() on null','2016-04-24 15:05:11','2016-04-24 15:05:11'),(3,'1','Class \'App\\Traits\\Role\' not found','2016-04-24 15:44:55','2016-04-24 15:44:55'),(4,'23000','SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry \'xx.user\' for key \'permissions_slug_unique\' (SQL: update `permissions` set `slug` = xx.user, `updated_at` = 2016-04-24 15:56:19 where `id` = 6)','2016-04-24 15:56:19','2016-04-24 15:56:19');
/*!40000 ALTER TABLE `tracker_errors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_events`
--

DROP TABLE IF EXISTS `tracker_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_events_name_index` (`name`),
  KEY `tracker_events_created_at_index` (`created_at`),
  KEY `tracker_events_updated_at_index` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_events`
--

LOCK TABLES `tracker_events` WRITE;
/*!40000 ALTER TABLE `tracker_events` DISABLE KEYS */;
INSERT INTO `tracker_events` VALUES (1,'bootstrapped: Illuminate\\Foundation\\Bootstrap\\RegisterProviders','2016-04-22 13:47:42','2016-04-22 13:47:42'),(2,'bootstrapping: Illuminate\\Foundation\\Bootstrap\\BootProviders','2016-04-22 13:47:42','2016-04-22 13:47:42'),(3,'bootstrapped: Illuminate\\Foundation\\Bootstrap\\BootProviders','2016-04-22 13:47:42','2016-04-22 13:47:42'),(4,'cache.hit','2016-04-22 13:47:42','2016-04-22 13:47:42'),(5,'kernel.handled','2016-04-22 13:47:43','2016-04-22 13:47:43'),(6,'cache.write','2016-04-22 13:47:43','2016-04-22 13:47:43'),(7,'auth.logout','2016-04-22 13:48:38','2016-04-22 13:48:38'),(8,'auth.attempt','2016-04-22 13:48:59','2016-04-22 13:48:59'),(9,'cache.delete','2016-04-22 13:48:59','2016-04-22 13:48:59'),(10,'auth.login','2016-04-22 13:48:59','2016-04-22 13:48:59'),(11,'cache.missed','2016-04-22 15:39:22','2016-04-22 15:39:22');
/*!40000 ALTER TABLE `tracker_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_events_log`
--

DROP TABLE IF EXISTS `tracker_events_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_events_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint(20) unsigned NOT NULL,
  `class_id` bigint(20) unsigned DEFAULT NULL,
  `log_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_events_log_event_id_index` (`event_id`),
  KEY `tracker_events_log_class_id_index` (`class_id`),
  KEY `tracker_events_log_log_id_index` (`log_id`),
  KEY `tracker_events_log_created_at_index` (`created_at`),
  KEY `tracker_events_log_updated_at_index` (`updated_at`),
  CONSTRAINT `tracker_events_log_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `tracker_system_classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tracker_events_log_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `tracker_events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tracker_events_log_log_id_foreign` FOREIGN KEY (`log_id`) REFERENCES `tracker_log` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1280 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_events_log`
--

LOCK TABLES `tracker_events_log` WRITE;
/*!40000 ALTER TABLE `tracker_events_log` DISABLE KEYS */;
INSERT INTO `tracker_events_log` VALUES (1,1,1,1,'2016-04-22 13:47:42','2016-04-22 13:47:42'),(2,2,1,1,'2016-04-22 13:47:42','2016-04-22 13:47:42'),(3,3,1,1,'2016-04-22 13:47:42','2016-04-22 13:47:42'),(4,4,2,1,'2016-04-22 13:47:42','2016-04-22 13:47:42'),(5,5,3,1,'2016-04-22 13:47:43','2016-04-22 13:47:43'),(6,6,2,1,'2016-04-22 13:47:43','2016-04-22 13:47:43'),(7,1,1,2,'2016-04-22 13:47:53','2016-04-22 13:47:53'),(8,2,1,2,'2016-04-22 13:47:53','2016-04-22 13:47:53'),(9,3,1,2,'2016-04-22 13:47:53','2016-04-22 13:47:53'),(10,4,2,2,'2016-04-22 13:47:53','2016-04-22 13:47:53'),(11,1,1,3,'2016-04-22 13:48:06','2016-04-22 13:48:06'),(12,2,1,3,'2016-04-22 13:48:06','2016-04-22 13:48:06'),(13,3,1,3,'2016-04-22 13:48:06','2016-04-22 13:48:06'),(14,4,2,3,'2016-04-22 13:48:06','2016-04-22 13:48:06'),(15,5,3,3,'2016-04-22 13:48:06','2016-04-22 13:48:06'),(16,6,2,3,'2016-04-22 13:48:06','2016-04-22 13:48:06'),(17,1,1,4,'2016-04-22 13:48:10','2016-04-22 13:48:10'),(18,2,1,4,'2016-04-22 13:48:10','2016-04-22 13:48:10'),(19,3,1,4,'2016-04-22 13:48:10','2016-04-22 13:48:10'),(20,4,2,4,'2016-04-22 13:48:10','2016-04-22 13:48:10'),(21,5,3,4,'2016-04-22 13:48:11','2016-04-22 13:48:11'),(22,6,2,4,'2016-04-22 13:48:11','2016-04-22 13:48:11'),(23,1,1,5,'2016-04-22 13:48:29','2016-04-22 13:48:29'),(24,2,1,5,'2016-04-22 13:48:29','2016-04-22 13:48:29'),(25,3,1,5,'2016-04-22 13:48:29','2016-04-22 13:48:29'),(26,4,2,5,'2016-04-22 13:48:29','2016-04-22 13:48:29'),(27,5,3,5,'2016-04-22 13:48:30','2016-04-22 13:48:30'),(28,6,2,5,'2016-04-22 13:48:30','2016-04-22 13:48:30'),(29,1,1,6,'2016-04-22 13:48:37','2016-04-22 13:48:37'),(30,2,1,6,'2016-04-22 13:48:37','2016-04-22 13:48:37'),(31,3,1,6,'2016-04-22 13:48:37','2016-04-22 13:48:37'),(32,4,2,6,'2016-04-22 13:48:38','2016-04-22 13:48:38'),(33,7,4,6,'2016-04-22 13:48:38','2016-04-22 13:48:38'),(34,5,3,6,'2016-04-22 13:48:38','2016-04-22 13:48:38'),(35,6,2,6,'2016-04-22 13:48:38','2016-04-22 13:48:38'),(36,1,1,7,'2016-04-22 13:48:42','2016-04-22 13:48:42'),(37,2,1,7,'2016-04-22 13:48:42','2016-04-22 13:48:42'),(38,3,1,7,'2016-04-22 13:48:42','2016-04-22 13:48:42'),(39,4,2,7,'2016-04-22 13:48:42','2016-04-22 13:48:42'),(40,5,3,7,'2016-04-22 13:48:43','2016-04-22 13:48:43'),(41,6,2,7,'2016-04-22 13:48:43','2016-04-22 13:48:43'),(42,1,1,8,'2016-04-22 13:48:52','2016-04-22 13:48:52'),(43,2,1,8,'2016-04-22 13:48:52','2016-04-22 13:48:52'),(44,3,1,8,'2016-04-22 13:48:52','2016-04-22 13:48:52'),(45,4,2,8,'2016-04-22 13:48:52','2016-04-22 13:48:52'),(46,5,3,8,'2016-04-22 13:48:52','2016-04-22 13:48:52'),(47,6,2,8,'2016-04-22 13:48:52','2016-04-22 13:48:52'),(48,1,1,9,'2016-04-22 13:48:58','2016-04-22 13:48:58'),(49,2,1,9,'2016-04-22 13:48:58','2016-04-22 13:48:58'),(50,3,1,9,'2016-04-22 13:48:58','2016-04-22 13:48:58'),(51,4,2,9,'2016-04-22 13:48:58','2016-04-22 13:48:58'),(52,8,5,9,'2016-04-22 13:48:59','2016-04-22 13:48:59'),(53,9,2,9,'2016-04-22 13:48:59','2016-04-22 13:48:59'),(54,10,4,9,'2016-04-22 13:48:59','2016-04-22 13:48:59'),(55,5,3,9,'2016-04-22 13:48:59','2016-04-22 13:48:59'),(56,6,6,9,'2016-04-22 13:48:59','2016-04-22 13:48:59'),(57,1,1,10,'2016-04-22 13:49:03','2016-04-22 13:49:03'),(58,2,1,10,'2016-04-22 13:49:03','2016-04-22 13:49:03'),(59,3,1,10,'2016-04-22 13:49:03','2016-04-22 13:49:03'),(60,4,6,10,'2016-04-22 13:49:03','2016-04-22 13:49:03'),(61,5,3,10,'2016-04-22 13:49:04','2016-04-22 13:49:04'),(62,6,6,10,'2016-04-22 13:49:04','2016-04-22 13:49:04'),(63,1,1,11,'2016-04-22 13:53:03','2016-04-22 13:53:03'),(64,2,1,11,'2016-04-22 13:53:03','2016-04-22 13:53:03'),(65,3,1,11,'2016-04-22 13:53:03','2016-04-22 13:53:03'),(66,4,6,11,'2016-04-22 13:53:03','2016-04-22 13:53:03'),(67,5,3,11,'2016-04-22 13:53:04','2016-04-22 13:53:04'),(68,6,6,11,'2016-04-22 13:53:04','2016-04-22 13:53:04'),(69,1,1,12,'2016-04-22 13:53:24','2016-04-22 13:53:24'),(70,2,1,12,'2016-04-22 13:53:24','2016-04-22 13:53:24'),(71,3,1,12,'2016-04-22 13:53:24','2016-04-22 13:53:24'),(72,4,6,12,'2016-04-22 13:53:24','2016-04-22 13:53:24'),(73,5,3,12,'2016-04-22 13:53:25','2016-04-22 13:53:25'),(74,6,6,12,'2016-04-22 13:53:25','2016-04-22 13:53:25'),(75,1,1,13,'2016-04-22 13:53:41','2016-04-22 13:53:41'),(76,2,1,13,'2016-04-22 13:53:41','2016-04-22 13:53:41'),(77,3,1,13,'2016-04-22 13:53:41','2016-04-22 13:53:41'),(78,4,7,13,'2016-04-22 13:53:41','2016-04-22 13:53:41'),(79,1,1,14,'2016-04-22 13:53:57','2016-04-22 13:53:57'),(80,2,1,14,'2016-04-22 13:53:57','2016-04-22 13:53:57'),(81,3,1,14,'2016-04-22 13:53:57','2016-04-22 13:53:57'),(82,4,7,14,'2016-04-22 13:53:57','2016-04-22 13:53:57'),(83,5,3,14,'2016-04-22 13:53:58','2016-04-22 13:53:58'),(84,6,7,14,'2016-04-22 13:53:58','2016-04-22 13:53:58'),(85,1,1,15,'2016-04-22 13:58:44','2016-04-22 13:58:44'),(86,2,1,15,'2016-04-22 13:58:44','2016-04-22 13:58:44'),(87,3,1,15,'2016-04-22 13:58:44','2016-04-22 13:58:44'),(88,4,6,15,'2016-04-22 13:58:44','2016-04-22 13:58:44'),(89,1,1,16,'2016-04-22 13:58:58','2016-04-22 13:58:58'),(90,2,1,16,'2016-04-22 13:58:58','2016-04-22 13:58:58'),(91,3,1,16,'2016-04-22 13:58:58','2016-04-22 13:58:58'),(92,4,7,16,'2016-04-22 13:58:58','2016-04-22 13:58:58'),(93,1,1,17,'2016-04-22 15:39:22','2016-04-22 15:39:22'),(94,2,1,17,'2016-04-22 15:39:22','2016-04-22 15:39:22'),(95,3,1,17,'2016-04-22 15:39:22','2016-04-22 15:39:22'),(96,11,8,17,'2016-04-22 15:39:22','2016-04-22 15:39:22'),(97,5,3,17,'2016-04-22 15:39:23','2016-04-22 15:39:23'),(98,6,8,17,'2016-04-22 15:39:23','2016-04-22 15:39:23'),(99,1,1,18,'2016-04-22 15:41:20','2016-04-22 15:41:20'),(100,2,1,18,'2016-04-22 15:41:20','2016-04-22 15:41:20'),(101,3,1,18,'2016-04-22 15:41:20','2016-04-22 15:41:20'),(102,4,8,18,'2016-04-22 15:41:20','2016-04-22 15:41:20'),(103,5,3,18,'2016-04-22 15:41:21','2016-04-22 15:41:21'),(104,6,8,18,'2016-04-22 15:41:21','2016-04-22 15:41:21'),(105,1,1,19,'2016-04-22 15:41:31','2016-04-22 15:41:31'),(106,2,1,19,'2016-04-22 15:41:32','2016-04-22 15:41:32'),(107,3,1,19,'2016-04-22 15:41:32','2016-04-22 15:41:32'),(108,4,8,19,'2016-04-22 15:41:32','2016-04-22 15:41:32'),(109,5,3,19,'2016-04-22 15:41:32','2016-04-22 15:41:32'),(110,6,8,19,'2016-04-22 15:41:32','2016-04-22 15:41:32'),(111,1,1,20,'2016-04-22 15:41:37','2016-04-22 15:41:37'),(112,2,1,20,'2016-04-22 15:41:37','2016-04-22 15:41:37'),(113,3,1,20,'2016-04-22 15:41:37','2016-04-22 15:41:37'),(114,4,8,20,'2016-04-22 15:41:37','2016-04-22 15:41:37'),(115,5,3,20,'2016-04-22 15:41:37','2016-04-22 15:41:37'),(116,6,8,20,'2016-04-22 15:41:38','2016-04-22 15:41:38'),(117,1,1,21,'2016-04-24 09:46:27','2016-04-24 09:46:27'),(118,2,1,21,'2016-04-24 09:46:27','2016-04-24 09:46:27'),(119,3,1,21,'2016-04-24 09:46:27','2016-04-24 09:46:27'),(120,11,9,21,'2016-04-24 09:46:27','2016-04-24 09:46:27'),(121,5,3,21,'2016-04-24 09:46:27','2016-04-24 09:46:27'),(122,6,9,21,'2016-04-24 09:46:27','2016-04-24 09:46:27'),(123,1,1,22,'2016-04-24 09:46:39','2016-04-24 09:46:39'),(124,2,1,22,'2016-04-24 09:46:39','2016-04-24 09:46:39'),(125,3,1,22,'2016-04-24 09:46:39','2016-04-24 09:46:39'),(126,4,9,22,'2016-04-24 09:46:39','2016-04-24 09:46:39'),(127,5,3,22,'2016-04-24 09:46:39','2016-04-24 09:46:39'),(128,6,9,22,'2016-04-24 09:46:39','2016-04-24 09:46:39'),(129,1,1,23,'2016-04-24 09:47:21','2016-04-24 09:47:21'),(130,2,1,23,'2016-04-24 09:47:21','2016-04-24 09:47:21'),(131,3,1,23,'2016-04-24 09:47:21','2016-04-24 09:47:21'),(132,4,9,23,'2016-04-24 09:47:21','2016-04-24 09:47:21'),(133,5,3,23,'2016-04-24 09:47:21','2016-04-24 09:47:21'),(134,6,9,23,'2016-04-24 09:47:21','2016-04-24 09:47:21'),(135,1,1,24,'2016-04-24 09:47:24','2016-04-24 09:47:24'),(136,2,1,24,'2016-04-24 09:47:24','2016-04-24 09:47:24'),(137,3,1,24,'2016-04-24 09:47:24','2016-04-24 09:47:24'),(138,4,9,24,'2016-04-24 09:47:24','2016-04-24 09:47:24'),(139,5,3,24,'2016-04-24 09:47:25','2016-04-24 09:47:25'),(140,6,9,24,'2016-04-24 09:47:25','2016-04-24 09:47:25'),(141,1,1,25,'2016-04-24 09:47:35','2016-04-24 09:47:35'),(142,2,1,25,'2016-04-24 09:47:35','2016-04-24 09:47:35'),(143,3,1,25,'2016-04-24 09:47:35','2016-04-24 09:47:35'),(144,4,9,25,'2016-04-24 09:47:35','2016-04-24 09:47:35'),(145,5,3,25,'2016-04-24 09:47:35','2016-04-24 09:47:35'),(146,6,9,25,'2016-04-24 09:47:35','2016-04-24 09:47:35'),(147,1,1,26,'2016-04-24 10:09:33','2016-04-24 10:09:33'),(148,2,1,26,'2016-04-24 10:09:33','2016-04-24 10:09:33'),(149,3,1,26,'2016-04-24 10:09:33','2016-04-24 10:09:33'),(150,4,9,26,'2016-04-24 10:09:33','2016-04-24 10:09:33'),(151,5,3,26,'2016-04-24 10:09:33','2016-04-24 10:09:33'),(152,6,9,26,'2016-04-24 10:09:33','2016-04-24 10:09:33'),(153,1,1,27,'2016-04-24 10:09:37','2016-04-24 10:09:37'),(154,2,1,27,'2016-04-24 10:09:37','2016-04-24 10:09:37'),(155,3,1,27,'2016-04-24 10:09:37','2016-04-24 10:09:37'),(156,4,9,27,'2016-04-24 10:09:37','2016-04-24 10:09:37'),(157,5,3,27,'2016-04-24 10:09:38','2016-04-24 10:09:38'),(158,6,9,27,'2016-04-24 10:09:38','2016-04-24 10:09:38'),(159,1,1,28,'2016-04-24 10:09:42','2016-04-24 10:09:42'),(160,2,1,28,'2016-04-24 10:09:42','2016-04-24 10:09:42'),(161,3,1,28,'2016-04-24 10:09:42','2016-04-24 10:09:42'),(162,4,9,28,'2016-04-24 10:09:42','2016-04-24 10:09:42'),(163,5,3,28,'2016-04-24 10:09:43','2016-04-24 10:09:43'),(164,6,9,28,'2016-04-24 10:09:43','2016-04-24 10:09:43'),(165,1,1,29,'2016-04-24 10:09:51','2016-04-24 10:09:51'),(166,2,1,29,'2016-04-24 10:09:51','2016-04-24 10:09:51'),(167,3,1,29,'2016-04-24 10:09:51','2016-04-24 10:09:51'),(168,4,9,29,'2016-04-24 10:09:51','2016-04-24 10:09:51'),(169,5,3,29,'2016-04-24 10:09:52','2016-04-24 10:09:52'),(170,6,9,29,'2016-04-24 10:09:52','2016-04-24 10:09:52'),(171,1,1,30,'2016-04-24 10:09:55','2016-04-24 10:09:55'),(172,2,1,30,'2016-04-24 10:09:55','2016-04-24 10:09:55'),(173,3,1,30,'2016-04-24 10:09:55','2016-04-24 10:09:55'),(174,4,9,30,'2016-04-24 10:09:55','2016-04-24 10:09:55'),(175,5,3,30,'2016-04-24 10:09:55','2016-04-24 10:09:55'),(176,6,9,30,'2016-04-24 10:09:55','2016-04-24 10:09:55'),(177,1,1,31,'2016-04-24 10:10:45','2016-04-24 10:10:45'),(178,2,1,31,'2016-04-24 10:10:45','2016-04-24 10:10:45'),(179,3,1,31,'2016-04-24 10:10:45','2016-04-24 10:10:45'),(180,4,9,31,'2016-04-24 10:10:45','2016-04-24 10:10:45'),(181,5,3,31,'2016-04-24 10:10:46','2016-04-24 10:10:46'),(182,6,9,31,'2016-04-24 10:10:46','2016-04-24 10:10:46'),(183,1,1,32,'2016-04-24 10:10:53','2016-04-24 10:10:53'),(184,2,1,32,'2016-04-24 10:10:53','2016-04-24 10:10:53'),(185,3,1,32,'2016-04-24 10:10:53','2016-04-24 10:10:53'),(186,4,9,32,'2016-04-24 10:10:53','2016-04-24 10:10:53'),(187,5,3,32,'2016-04-24 10:10:53','2016-04-24 10:10:53'),(188,6,9,32,'2016-04-24 10:10:53','2016-04-24 10:10:53'),(189,1,1,33,'2016-04-24 10:11:44','2016-04-24 10:11:44'),(190,2,1,33,'2016-04-24 10:11:44','2016-04-24 10:11:44'),(191,3,1,33,'2016-04-24 10:11:44','2016-04-24 10:11:44'),(192,4,9,33,'2016-04-24 10:11:44','2016-04-24 10:11:44'),(193,5,3,33,'2016-04-24 10:11:44','2016-04-24 10:11:44'),(194,6,9,33,'2016-04-24 10:11:44','2016-04-24 10:11:44'),(195,1,1,34,'2016-04-24 10:11:47','2016-04-24 10:11:47'),(196,2,1,34,'2016-04-24 10:11:47','2016-04-24 10:11:47'),(197,3,1,34,'2016-04-24 10:11:47','2016-04-24 10:11:47'),(198,4,9,34,'2016-04-24 10:11:47','2016-04-24 10:11:47'),(199,5,3,34,'2016-04-24 10:11:47','2016-04-24 10:11:47'),(200,6,9,34,'2016-04-24 10:11:47','2016-04-24 10:11:47'),(201,1,1,35,'2016-04-24 10:11:56','2016-04-24 10:11:56'),(202,2,1,35,'2016-04-24 10:11:56','2016-04-24 10:11:56'),(203,3,1,35,'2016-04-24 10:11:56','2016-04-24 10:11:56'),(204,4,9,35,'2016-04-24 10:11:56','2016-04-24 10:11:56'),(205,5,3,35,'2016-04-24 10:11:56','2016-04-24 10:11:56'),(206,6,9,35,'2016-04-24 10:11:56','2016-04-24 10:11:56'),(207,1,1,36,'2016-04-24 10:12:05','2016-04-24 10:12:05'),(208,2,1,36,'2016-04-24 10:12:05','2016-04-24 10:12:05'),(209,3,1,36,'2016-04-24 10:12:05','2016-04-24 10:12:05'),(210,4,9,36,'2016-04-24 10:12:05','2016-04-24 10:12:05'),(211,5,3,36,'2016-04-24 10:12:05','2016-04-24 10:12:05'),(212,6,9,36,'2016-04-24 10:12:05','2016-04-24 10:12:05'),(213,1,1,37,'2016-04-24 10:12:08','2016-04-24 10:12:08'),(214,2,1,37,'2016-04-24 10:12:08','2016-04-24 10:12:08'),(215,3,1,37,'2016-04-24 10:12:08','2016-04-24 10:12:08'),(216,4,9,37,'2016-04-24 10:12:08','2016-04-24 10:12:08'),(217,5,3,37,'2016-04-24 10:12:09','2016-04-24 10:12:09'),(218,6,9,37,'2016-04-24 10:12:09','2016-04-24 10:12:09'),(219,1,1,38,'2016-04-24 10:12:13','2016-04-24 10:12:13'),(220,2,1,38,'2016-04-24 10:12:13','2016-04-24 10:12:13'),(221,3,1,38,'2016-04-24 10:12:13','2016-04-24 10:12:13'),(222,4,9,38,'2016-04-24 10:12:14','2016-04-24 10:12:14'),(223,5,3,38,'2016-04-24 10:12:14','2016-04-24 10:12:14'),(224,6,9,38,'2016-04-24 10:12:14','2016-04-24 10:12:14'),(225,1,1,39,'2016-04-24 10:12:23','2016-04-24 10:12:23'),(226,2,1,39,'2016-04-24 10:12:23','2016-04-24 10:12:23'),(227,3,1,39,'2016-04-24 10:12:23','2016-04-24 10:12:23'),(228,4,9,39,'2016-04-24 10:12:23','2016-04-24 10:12:23'),(229,5,3,39,'2016-04-24 10:12:24','2016-04-24 10:12:24'),(230,6,9,39,'2016-04-24 10:12:24','2016-04-24 10:12:24'),(231,1,1,40,'2016-04-24 10:12:27','2016-04-24 10:12:27'),(232,2,1,40,'2016-04-24 10:12:27','2016-04-24 10:12:27'),(233,3,1,40,'2016-04-24 10:12:27','2016-04-24 10:12:27'),(234,4,9,40,'2016-04-24 10:12:27','2016-04-24 10:12:27'),(235,5,3,40,'2016-04-24 10:12:27','2016-04-24 10:12:27'),(236,6,9,40,'2016-04-24 10:12:27','2016-04-24 10:12:27'),(237,1,1,41,'2016-04-24 10:12:49','2016-04-24 10:12:49'),(238,2,1,41,'2016-04-24 10:12:49','2016-04-24 10:12:49'),(239,3,1,41,'2016-04-24 10:12:49','2016-04-24 10:12:49'),(240,4,9,41,'2016-04-24 10:12:49','2016-04-24 10:12:49'),(241,5,3,41,'2016-04-24 10:12:49','2016-04-24 10:12:49'),(242,6,9,41,'2016-04-24 10:12:49','2016-04-24 10:12:49'),(243,1,1,42,'2016-04-24 10:12:58','2016-04-24 10:12:58'),(244,2,1,42,'2016-04-24 10:12:58','2016-04-24 10:12:58'),(245,3,1,42,'2016-04-24 10:12:58','2016-04-24 10:12:58'),(246,4,9,42,'2016-04-24 10:12:58','2016-04-24 10:12:58'),(247,5,3,42,'2016-04-24 10:12:59','2016-04-24 10:12:59'),(248,6,9,42,'2016-04-24 10:12:59','2016-04-24 10:12:59'),(249,1,1,43,'2016-04-24 10:13:02','2016-04-24 10:13:02'),(250,2,1,43,'2016-04-24 10:13:02','2016-04-24 10:13:02'),(251,3,1,43,'2016-04-24 10:13:02','2016-04-24 10:13:02'),(252,4,9,43,'2016-04-24 10:13:02','2016-04-24 10:13:02'),(253,5,3,43,'2016-04-24 10:13:02','2016-04-24 10:13:02'),(254,6,9,43,'2016-04-24 10:13:02','2016-04-24 10:13:02'),(255,1,1,44,'2016-04-24 10:43:48','2016-04-24 10:43:48'),(256,2,1,44,'2016-04-24 10:43:48','2016-04-24 10:43:48'),(257,3,1,44,'2016-04-24 10:43:48','2016-04-24 10:43:48'),(258,4,9,44,'2016-04-24 10:43:48','2016-04-24 10:43:48'),(259,5,3,44,'2016-04-24 10:43:48','2016-04-24 10:43:48'),(260,6,9,44,'2016-04-24 10:43:48','2016-04-24 10:43:48'),(261,1,1,45,'2016-04-24 10:43:57','2016-04-24 10:43:57'),(262,2,1,45,'2016-04-24 10:43:57','2016-04-24 10:43:57'),(263,3,1,45,'2016-04-24 10:43:58','2016-04-24 10:43:58'),(264,4,9,45,'2016-04-24 10:43:58','2016-04-24 10:43:58'),(265,5,3,45,'2016-04-24 10:43:58','2016-04-24 10:43:58'),(266,6,9,45,'2016-04-24 10:43:58','2016-04-24 10:43:58'),(267,1,1,46,'2016-04-24 10:44:03','2016-04-24 10:44:03'),(268,2,1,46,'2016-04-24 10:44:03','2016-04-24 10:44:03'),(269,3,1,46,'2016-04-24 10:44:03','2016-04-24 10:44:03'),(270,4,9,46,'2016-04-24 10:44:03','2016-04-24 10:44:03'),(271,5,3,46,'2016-04-24 10:44:04','2016-04-24 10:44:04'),(272,6,9,46,'2016-04-24 10:44:04','2016-04-24 10:44:04'),(273,1,1,47,'2016-04-24 10:44:45','2016-04-24 10:44:45'),(274,2,1,47,'2016-04-24 10:44:45','2016-04-24 10:44:45'),(275,3,1,47,'2016-04-24 10:44:45','2016-04-24 10:44:45'),(276,4,9,47,'2016-04-24 10:44:45','2016-04-24 10:44:45'),(277,5,3,47,'2016-04-24 10:44:46','2016-04-24 10:44:46'),(278,6,9,47,'2016-04-24 10:44:46','2016-04-24 10:44:46'),(279,1,1,48,'2016-04-24 10:44:51','2016-04-24 10:44:51'),(280,2,1,48,'2016-04-24 10:44:51','2016-04-24 10:44:51'),(281,3,1,48,'2016-04-24 10:44:51','2016-04-24 10:44:51'),(282,4,9,48,'2016-04-24 10:44:52','2016-04-24 10:44:52'),(283,5,3,48,'2016-04-24 10:44:52','2016-04-24 10:44:52'),(284,6,9,48,'2016-04-24 10:44:52','2016-04-24 10:44:52'),(285,1,1,49,'2016-04-24 15:04:37','2016-04-24 15:04:37'),(286,2,1,49,'2016-04-24 15:04:37','2016-04-24 15:04:37'),(287,3,1,49,'2016-04-24 15:04:37','2016-04-24 15:04:37'),(288,11,10,49,'2016-04-24 15:04:37','2016-04-24 15:04:37'),(289,5,3,49,'2016-04-24 15:04:37','2016-04-24 15:04:37'),(290,6,10,49,'2016-04-24 15:04:37','2016-04-24 15:04:37'),(291,1,1,50,'2016-04-24 15:05:10','2016-04-24 15:05:10'),(292,2,1,50,'2016-04-24 15:05:10','2016-04-24 15:05:10'),(293,3,1,50,'2016-04-24 15:05:10','2016-04-24 15:05:10'),(294,11,11,50,'2016-04-24 15:05:10','2016-04-24 15:05:10'),(295,1,1,51,'2016-04-24 15:06:48','2016-04-24 15:06:48'),(296,2,1,51,'2016-04-24 15:06:48','2016-04-24 15:06:48'),(297,3,1,51,'2016-04-24 15:06:48','2016-04-24 15:06:48'),(298,11,12,51,'2016-04-24 15:06:48','2016-04-24 15:06:48'),(299,5,3,51,'2016-04-24 15:06:49','2016-04-24 15:06:49'),(300,6,12,51,'2016-04-24 15:06:49','2016-04-24 15:06:49'),(301,1,1,52,'2016-04-24 15:08:55','2016-04-24 15:08:55'),(302,2,1,52,'2016-04-24 15:08:55','2016-04-24 15:08:55'),(303,3,1,52,'2016-04-24 15:08:55','2016-04-24 15:08:55'),(304,4,12,52,'2016-04-24 15:08:55','2016-04-24 15:08:55'),(305,5,3,52,'2016-04-24 15:08:55','2016-04-24 15:08:55'),(306,6,12,52,'2016-04-24 15:08:55','2016-04-24 15:08:55'),(307,1,1,53,'2016-04-24 15:09:37','2016-04-24 15:09:37'),(308,2,1,53,'2016-04-24 15:09:37','2016-04-24 15:09:37'),(309,3,1,53,'2016-04-24 15:09:37','2016-04-24 15:09:37'),(310,4,12,53,'2016-04-24 15:09:38','2016-04-24 15:09:38'),(311,5,3,53,'2016-04-24 15:09:38','2016-04-24 15:09:38'),(312,6,12,53,'2016-04-24 15:09:38','2016-04-24 15:09:38'),(313,1,1,54,'2016-04-24 15:10:12','2016-04-24 15:10:12'),(314,2,1,54,'2016-04-24 15:10:12','2016-04-24 15:10:12'),(315,3,1,54,'2016-04-24 15:10:12','2016-04-24 15:10:12'),(316,4,12,54,'2016-04-24 15:10:12','2016-04-24 15:10:12'),(317,5,3,54,'2016-04-24 15:10:12','2016-04-24 15:10:12'),(318,6,12,54,'2016-04-24 15:10:12','2016-04-24 15:10:12'),(319,1,1,55,'2016-04-24 15:10:41','2016-04-24 15:10:41'),(320,2,1,55,'2016-04-24 15:10:41','2016-04-24 15:10:41'),(321,3,1,55,'2016-04-24 15:10:41','2016-04-24 15:10:41'),(322,4,12,55,'2016-04-24 15:10:41','2016-04-24 15:10:41'),(323,5,3,55,'2016-04-24 15:10:42','2016-04-24 15:10:42'),(324,6,12,55,'2016-04-24 15:10:42','2016-04-24 15:10:42'),(325,1,1,56,'2016-04-24 15:10:48','2016-04-24 15:10:48'),(326,2,1,56,'2016-04-24 15:10:48','2016-04-24 15:10:48'),(327,3,1,56,'2016-04-24 15:10:48','2016-04-24 15:10:48'),(328,4,12,56,'2016-04-24 15:10:48','2016-04-24 15:10:48'),(329,5,3,56,'2016-04-24 15:10:49','2016-04-24 15:10:49'),(330,6,12,56,'2016-04-24 15:10:49','2016-04-24 15:10:49'),(331,1,1,57,'2016-04-24 15:11:20','2016-04-24 15:11:20'),(332,2,1,57,'2016-04-24 15:11:20','2016-04-24 15:11:20'),(333,3,1,57,'2016-04-24 15:11:20','2016-04-24 15:11:20'),(334,4,12,57,'2016-04-24 15:11:20','2016-04-24 15:11:20'),(335,5,3,57,'2016-04-24 15:11:20','2016-04-24 15:11:20'),(336,6,12,57,'2016-04-24 15:11:20','2016-04-24 15:11:20'),(337,1,1,58,'2016-04-24 15:11:35','2016-04-24 15:11:35'),(338,2,1,58,'2016-04-24 15:11:35','2016-04-24 15:11:35'),(339,3,1,58,'2016-04-24 15:11:35','2016-04-24 15:11:35'),(340,4,12,58,'2016-04-24 15:11:35','2016-04-24 15:11:35'),(341,1,1,59,'2016-04-24 15:11:49','2016-04-24 15:11:49'),(342,2,1,59,'2016-04-24 15:11:49','2016-04-24 15:11:49'),(343,3,1,59,'2016-04-24 15:11:49','2016-04-24 15:11:49'),(344,4,12,59,'2016-04-24 15:11:50','2016-04-24 15:11:50'),(345,5,3,59,'2016-04-24 15:11:50','2016-04-24 15:11:50'),(346,6,12,59,'2016-04-24 15:11:50','2016-04-24 15:11:50'),(347,1,1,60,'2016-04-24 15:13:24','2016-04-24 15:13:24'),(348,2,1,60,'2016-04-24 15:13:24','2016-04-24 15:13:24'),(349,3,1,60,'2016-04-24 15:13:24','2016-04-24 15:13:24'),(350,4,12,60,'2016-04-24 15:13:24','2016-04-24 15:13:24'),(351,1,1,61,'2016-04-24 15:14:08','2016-04-24 15:14:08'),(352,2,1,61,'2016-04-24 15:14:08','2016-04-24 15:14:08'),(353,3,1,61,'2016-04-24 15:14:08','2016-04-24 15:14:08'),(354,4,12,61,'2016-04-24 15:14:08','2016-04-24 15:14:08'),(355,5,3,61,'2016-04-24 15:14:09','2016-04-24 15:14:09'),(356,6,12,61,'2016-04-24 15:14:09','2016-04-24 15:14:09'),(357,1,1,62,'2016-04-24 15:14:31','2016-04-24 15:14:31'),(358,2,1,62,'2016-04-24 15:14:31','2016-04-24 15:14:31'),(359,3,1,62,'2016-04-24 15:14:31','2016-04-24 15:14:31'),(360,4,12,62,'2016-04-24 15:14:31','2016-04-24 15:14:31'),(361,5,3,62,'2016-04-24 15:14:32','2016-04-24 15:14:32'),(362,6,12,62,'2016-04-24 15:14:32','2016-04-24 15:14:32'),(363,1,1,63,'2016-04-24 15:39:16','2016-04-24 15:39:16'),(364,2,1,63,'2016-04-24 15:39:16','2016-04-24 15:39:16'),(365,3,1,63,'2016-04-24 15:39:16','2016-04-24 15:39:16'),(366,4,12,63,'2016-04-24 15:39:16','2016-04-24 15:39:16'),(367,5,3,63,'2016-04-24 15:39:17','2016-04-24 15:39:17'),(368,6,12,63,'2016-04-24 15:39:17','2016-04-24 15:39:17'),(369,1,1,64,'2016-04-24 15:39:23','2016-04-24 15:39:23'),(370,2,1,64,'2016-04-24 15:39:23','2016-04-24 15:39:23'),(371,3,1,64,'2016-04-24 15:39:23','2016-04-24 15:39:23'),(372,4,12,64,'2016-04-24 15:39:23','2016-04-24 15:39:23'),(373,5,3,64,'2016-04-24 15:39:24','2016-04-24 15:39:24'),(374,6,12,64,'2016-04-24 15:39:24','2016-04-24 15:39:24'),(375,1,1,65,'2016-04-24 15:39:27','2016-04-24 15:39:27'),(376,2,1,65,'2016-04-24 15:39:27','2016-04-24 15:39:27'),(377,3,1,65,'2016-04-24 15:39:27','2016-04-24 15:39:27'),(378,4,12,65,'2016-04-24 15:39:27','2016-04-24 15:39:27'),(379,5,3,65,'2016-04-24 15:39:27','2016-04-24 15:39:27'),(380,6,12,65,'2016-04-24 15:39:27','2016-04-24 15:39:27'),(381,1,1,66,'2016-04-24 15:39:51','2016-04-24 15:39:51'),(382,2,1,66,'2016-04-24 15:39:51','2016-04-24 15:39:51'),(383,3,1,66,'2016-04-24 15:39:51','2016-04-24 15:39:51'),(384,4,12,66,'2016-04-24 15:39:51','2016-04-24 15:39:51'),(385,5,3,66,'2016-04-24 15:39:52','2016-04-24 15:39:52'),(386,6,12,66,'2016-04-24 15:39:52','2016-04-24 15:39:52'),(387,1,1,67,'2016-04-24 15:39:57','2016-04-24 15:39:57'),(388,2,1,67,'2016-04-24 15:39:57','2016-04-24 15:39:57'),(389,3,1,67,'2016-04-24 15:39:57','2016-04-24 15:39:57'),(390,4,12,67,'2016-04-24 15:39:57','2016-04-24 15:39:57'),(391,5,3,67,'2016-04-24 15:39:58','2016-04-24 15:39:58'),(392,6,12,67,'2016-04-24 15:39:58','2016-04-24 15:39:58'),(393,1,1,68,'2016-04-24 15:41:17','2016-04-24 15:41:17'),(394,2,1,68,'2016-04-24 15:41:17','2016-04-24 15:41:17'),(395,3,1,68,'2016-04-24 15:41:17','2016-04-24 15:41:17'),(396,4,12,68,'2016-04-24 15:41:17','2016-04-24 15:41:17'),(397,5,3,68,'2016-04-24 15:41:17','2016-04-24 15:41:17'),(398,6,12,68,'2016-04-24 15:41:17','2016-04-24 15:41:17'),(399,1,1,69,'2016-04-24 15:41:42','2016-04-24 15:41:42'),(400,2,1,69,'2016-04-24 15:41:42','2016-04-24 15:41:42'),(401,3,1,69,'2016-04-24 15:41:42','2016-04-24 15:41:42'),(402,4,12,69,'2016-04-24 15:41:42','2016-04-24 15:41:42'),(403,5,3,69,'2016-04-24 15:41:42','2016-04-24 15:41:42'),(404,6,12,69,'2016-04-24 15:41:42','2016-04-24 15:41:42'),(405,1,1,70,'2016-04-24 15:44:47','2016-04-24 15:44:47'),(406,2,1,70,'2016-04-24 15:44:47','2016-04-24 15:44:47'),(407,3,1,70,'2016-04-24 15:44:47','2016-04-24 15:44:47'),(408,4,12,70,'2016-04-24 15:44:47','2016-04-24 15:44:47'),(409,5,3,70,'2016-04-24 15:44:48','2016-04-24 15:44:48'),(410,6,12,70,'2016-04-24 15:44:48','2016-04-24 15:44:48'),(411,1,1,71,'2016-04-24 15:44:54','2016-04-24 15:44:54'),(412,2,1,71,'2016-04-24 15:44:54','2016-04-24 15:44:54'),(413,3,1,71,'2016-04-24 15:44:54','2016-04-24 15:44:54'),(414,4,12,71,'2016-04-24 15:44:55','2016-04-24 15:44:55'),(415,1,1,72,'2016-04-24 15:45:32','2016-04-24 15:45:32'),(416,2,1,72,'2016-04-24 15:45:32','2016-04-24 15:45:32'),(417,3,1,72,'2016-04-24 15:45:32','2016-04-24 15:45:32'),(418,4,12,72,'2016-04-24 15:45:32','2016-04-24 15:45:32'),(419,5,3,72,'2016-04-24 15:45:32','2016-04-24 15:45:32'),(420,6,12,72,'2016-04-24 15:45:32','2016-04-24 15:45:32'),(421,1,1,73,'2016-04-24 15:45:36','2016-04-24 15:45:36'),(422,2,1,73,'2016-04-24 15:45:36','2016-04-24 15:45:36'),(423,3,1,73,'2016-04-24 15:45:36','2016-04-24 15:45:36'),(424,4,12,73,'2016-04-24 15:45:36','2016-04-24 15:45:36'),(425,5,3,73,'2016-04-24 15:45:36','2016-04-24 15:45:36'),(426,6,12,73,'2016-04-24 15:45:36','2016-04-24 15:45:36'),(427,1,1,74,'2016-04-24 15:45:47','2016-04-24 15:45:47'),(428,2,1,74,'2016-04-24 15:45:47','2016-04-24 15:45:47'),(429,3,1,74,'2016-04-24 15:45:47','2016-04-24 15:45:47'),(430,4,12,74,'2016-04-24 15:45:47','2016-04-24 15:45:47'),(431,5,3,74,'2016-04-24 15:45:47','2016-04-24 15:45:47'),(432,6,12,74,'2016-04-24 15:45:47','2016-04-24 15:45:47'),(433,1,1,75,'2016-04-24 15:46:24','2016-04-24 15:46:24'),(434,2,1,75,'2016-04-24 15:46:24','2016-04-24 15:46:24'),(435,3,1,75,'2016-04-24 15:46:24','2016-04-24 15:46:24'),(436,4,12,75,'2016-04-24 15:46:24','2016-04-24 15:46:24'),(437,5,3,75,'2016-04-24 15:46:24','2016-04-24 15:46:24'),(438,6,12,75,'2016-04-24 15:46:24','2016-04-24 15:46:24'),(439,1,1,76,'2016-04-24 15:46:27','2016-04-24 15:46:27'),(440,2,1,76,'2016-04-24 15:46:27','2016-04-24 15:46:27'),(441,3,1,76,'2016-04-24 15:46:27','2016-04-24 15:46:27'),(442,4,12,76,'2016-04-24 15:46:27','2016-04-24 15:46:27'),(443,5,3,76,'2016-04-24 15:46:27','2016-04-24 15:46:27'),(444,6,12,76,'2016-04-24 15:46:27','2016-04-24 15:46:27'),(445,1,1,77,'2016-04-24 15:46:36','2016-04-24 15:46:36'),(446,2,1,77,'2016-04-24 15:46:36','2016-04-24 15:46:36'),(447,3,1,77,'2016-04-24 15:46:36','2016-04-24 15:46:36'),(448,4,12,77,'2016-04-24 15:46:36','2016-04-24 15:46:36'),(449,5,3,77,'2016-04-24 15:46:36','2016-04-24 15:46:36'),(450,6,12,77,'2016-04-24 15:46:37','2016-04-24 15:46:37'),(451,1,1,78,'2016-04-24 15:46:54','2016-04-24 15:46:54'),(452,2,1,78,'2016-04-24 15:46:54','2016-04-24 15:46:54'),(453,3,1,78,'2016-04-24 15:46:54','2016-04-24 15:46:54'),(454,4,12,78,'2016-04-24 15:46:54','2016-04-24 15:46:54'),(455,5,3,78,'2016-04-24 15:46:54','2016-04-24 15:46:54'),(456,6,12,78,'2016-04-24 15:46:54','2016-04-24 15:46:54'),(457,1,1,79,'2016-04-24 15:46:59','2016-04-24 15:46:59'),(458,2,1,79,'2016-04-24 15:46:59','2016-04-24 15:46:59'),(459,3,1,79,'2016-04-24 15:46:59','2016-04-24 15:46:59'),(460,4,12,79,'2016-04-24 15:46:59','2016-04-24 15:46:59'),(461,5,3,79,'2016-04-24 15:47:00','2016-04-24 15:47:00'),(462,6,12,79,'2016-04-24 15:47:00','2016-04-24 15:47:00'),(463,1,1,80,'2016-04-24 15:48:49','2016-04-24 15:48:49'),(464,2,1,80,'2016-04-24 15:48:49','2016-04-24 15:48:49'),(465,3,1,80,'2016-04-24 15:48:49','2016-04-24 15:48:49'),(466,4,12,80,'2016-04-24 15:48:49','2016-04-24 15:48:49'),(467,5,3,80,'2016-04-24 15:48:49','2016-04-24 15:48:49'),(468,6,12,80,'2016-04-24 15:48:49','2016-04-24 15:48:49'),(469,1,1,81,'2016-04-24 15:48:52','2016-04-24 15:48:52'),(470,2,1,81,'2016-04-24 15:48:52','2016-04-24 15:48:52'),(471,3,1,81,'2016-04-24 15:48:52','2016-04-24 15:48:52'),(472,4,12,81,'2016-04-24 15:48:52','2016-04-24 15:48:52'),(473,5,3,81,'2016-04-24 15:48:53','2016-04-24 15:48:53'),(474,6,12,81,'2016-04-24 15:48:53','2016-04-24 15:48:53'),(475,1,1,82,'2016-04-24 15:49:00','2016-04-24 15:49:00'),(476,2,1,82,'2016-04-24 15:49:00','2016-04-24 15:49:00'),(477,3,1,82,'2016-04-24 15:49:00','2016-04-24 15:49:00'),(478,4,12,82,'2016-04-24 15:49:00','2016-04-24 15:49:00'),(479,5,3,82,'2016-04-24 15:49:00','2016-04-24 15:49:00'),(480,6,12,82,'2016-04-24 15:49:00','2016-04-24 15:49:00'),(481,1,1,83,'2016-04-24 15:49:05','2016-04-24 15:49:05'),(482,2,1,83,'2016-04-24 15:49:05','2016-04-24 15:49:05'),(483,3,1,83,'2016-04-24 15:49:05','2016-04-24 15:49:05'),(484,4,12,83,'2016-04-24 15:49:05','2016-04-24 15:49:05'),(485,5,3,83,'2016-04-24 15:49:06','2016-04-24 15:49:06'),(486,6,12,83,'2016-04-24 15:49:06','2016-04-24 15:49:06'),(487,1,1,84,'2016-04-24 15:49:28','2016-04-24 15:49:28'),(488,2,1,84,'2016-04-24 15:49:28','2016-04-24 15:49:28'),(489,3,1,84,'2016-04-24 15:49:28','2016-04-24 15:49:28'),(490,4,12,84,'2016-04-24 15:49:28','2016-04-24 15:49:28'),(491,5,3,84,'2016-04-24 15:49:29','2016-04-24 15:49:29'),(492,6,12,84,'2016-04-24 15:49:29','2016-04-24 15:49:29'),(493,1,1,85,'2016-04-24 15:49:36','2016-04-24 15:49:36'),(494,2,1,85,'2016-04-24 15:49:36','2016-04-24 15:49:36'),(495,3,1,85,'2016-04-24 15:49:36','2016-04-24 15:49:36'),(496,4,12,85,'2016-04-24 15:49:36','2016-04-24 15:49:36'),(497,5,3,85,'2016-04-24 15:49:37','2016-04-24 15:49:37'),(498,6,12,85,'2016-04-24 15:49:37','2016-04-24 15:49:37'),(499,1,1,86,'2016-04-24 15:49:40','2016-04-24 15:49:40'),(500,2,1,86,'2016-04-24 15:49:40','2016-04-24 15:49:40'),(501,3,1,86,'2016-04-24 15:49:40','2016-04-24 15:49:40'),(502,4,12,86,'2016-04-24 15:49:40','2016-04-24 15:49:40'),(503,5,3,86,'2016-04-24 15:49:40','2016-04-24 15:49:40'),(504,6,12,86,'2016-04-24 15:49:40','2016-04-24 15:49:40'),(505,1,1,87,'2016-04-24 15:49:51','2016-04-24 15:49:51'),(506,2,1,87,'2016-04-24 15:49:51','2016-04-24 15:49:51'),(507,3,1,87,'2016-04-24 15:49:51','2016-04-24 15:49:51'),(508,4,12,87,'2016-04-24 15:49:51','2016-04-24 15:49:51'),(509,5,3,87,'2016-04-24 15:49:51','2016-04-24 15:49:51'),(510,6,12,87,'2016-04-24 15:49:51','2016-04-24 15:49:51'),(511,1,1,88,'2016-04-24 15:52:56','2016-04-24 15:52:56'),(512,2,1,88,'2016-04-24 15:52:56','2016-04-24 15:52:56'),(513,3,1,88,'2016-04-24 15:52:56','2016-04-24 15:52:56'),(514,4,12,88,'2016-04-24 15:52:56','2016-04-24 15:52:56'),(515,5,3,88,'2016-04-24 15:52:57','2016-04-24 15:52:57'),(516,6,12,88,'2016-04-24 15:52:57','2016-04-24 15:52:57'),(517,1,1,89,'2016-04-24 15:53:02','2016-04-24 15:53:02'),(518,2,1,89,'2016-04-24 15:53:02','2016-04-24 15:53:02'),(519,3,1,89,'2016-04-24 15:53:02','2016-04-24 15:53:02'),(520,4,12,89,'2016-04-24 15:53:02','2016-04-24 15:53:02'),(521,5,3,89,'2016-04-24 15:53:02','2016-04-24 15:53:02'),(522,6,12,89,'2016-04-24 15:53:02','2016-04-24 15:53:02'),(523,1,1,90,'2016-04-24 15:53:08','2016-04-24 15:53:08'),(524,2,1,90,'2016-04-24 15:53:08','2016-04-24 15:53:08'),(525,3,1,90,'2016-04-24 15:53:08','2016-04-24 15:53:08'),(526,4,12,90,'2016-04-24 15:53:08','2016-04-24 15:53:08'),(527,5,3,90,'2016-04-24 15:53:08','2016-04-24 15:53:08'),(528,6,12,90,'2016-04-24 15:53:08','2016-04-24 15:53:08'),(529,1,1,91,'2016-04-24 15:53:11','2016-04-24 15:53:11'),(530,2,1,91,'2016-04-24 15:53:11','2016-04-24 15:53:11'),(531,3,1,91,'2016-04-24 15:53:11','2016-04-24 15:53:11'),(532,4,12,91,'2016-04-24 15:53:12','2016-04-24 15:53:12'),(533,5,3,91,'2016-04-24 15:53:12','2016-04-24 15:53:12'),(534,6,12,91,'2016-04-24 15:53:12','2016-04-24 15:53:12'),(535,1,1,92,'2016-04-24 15:53:18','2016-04-24 15:53:18'),(536,2,1,92,'2016-04-24 15:53:18','2016-04-24 15:53:18'),(537,3,1,92,'2016-04-24 15:53:18','2016-04-24 15:53:18'),(538,4,12,92,'2016-04-24 15:53:18','2016-04-24 15:53:18'),(539,5,3,92,'2016-04-24 15:53:18','2016-04-24 15:53:18'),(540,6,12,92,'2016-04-24 15:53:18','2016-04-24 15:53:18'),(541,1,1,93,'2016-04-24 15:53:32','2016-04-24 15:53:32'),(542,2,1,93,'2016-04-24 15:53:32','2016-04-24 15:53:32'),(543,3,1,93,'2016-04-24 15:53:32','2016-04-24 15:53:32'),(544,4,12,93,'2016-04-24 15:53:32','2016-04-24 15:53:32'),(545,5,3,93,'2016-04-24 15:53:33','2016-04-24 15:53:33'),(546,6,12,93,'2016-04-24 15:53:33','2016-04-24 15:53:33'),(547,1,1,94,'2016-04-24 15:53:36','2016-04-24 15:53:36'),(548,2,1,94,'2016-04-24 15:53:36','2016-04-24 15:53:36'),(549,3,1,94,'2016-04-24 15:53:36','2016-04-24 15:53:36'),(550,4,12,94,'2016-04-24 15:53:36','2016-04-24 15:53:36'),(551,5,3,94,'2016-04-24 15:53:36','2016-04-24 15:53:36'),(552,6,12,94,'2016-04-24 15:53:36','2016-04-24 15:53:36'),(553,1,1,95,'2016-04-24 15:55:03','2016-04-24 15:55:03'),(554,2,1,95,'2016-04-24 15:55:03','2016-04-24 15:55:03'),(555,3,1,95,'2016-04-24 15:55:03','2016-04-24 15:55:03'),(556,4,12,95,'2016-04-24 15:55:03','2016-04-24 15:55:03'),(557,5,3,95,'2016-04-24 15:55:04','2016-04-24 15:55:04'),(558,6,12,95,'2016-04-24 15:55:04','2016-04-24 15:55:04'),(559,1,1,96,'2016-04-24 15:55:42','2016-04-24 15:55:42'),(560,2,1,96,'2016-04-24 15:55:42','2016-04-24 15:55:42'),(561,3,1,96,'2016-04-24 15:55:42','2016-04-24 15:55:42'),(562,4,12,96,'2016-04-24 15:55:42','2016-04-24 15:55:42'),(563,5,3,96,'2016-04-24 15:55:43','2016-04-24 15:55:43'),(564,6,12,96,'2016-04-24 15:55:43','2016-04-24 15:55:43'),(565,1,1,97,'2016-04-24 15:55:52','2016-04-24 15:55:52'),(566,2,1,97,'2016-04-24 15:55:52','2016-04-24 15:55:52'),(567,3,1,97,'2016-04-24 15:55:52','2016-04-24 15:55:52'),(568,4,12,97,'2016-04-24 15:55:52','2016-04-24 15:55:52'),(569,5,3,97,'2016-04-24 15:55:53','2016-04-24 15:55:53'),(570,6,12,97,'2016-04-24 15:55:53','2016-04-24 15:55:53'),(571,1,1,98,'2016-04-24 15:56:00','2016-04-24 15:56:00'),(572,2,1,98,'2016-04-24 15:56:00','2016-04-24 15:56:00'),(573,3,1,98,'2016-04-24 15:56:00','2016-04-24 15:56:00'),(574,4,12,98,'2016-04-24 15:56:00','2016-04-24 15:56:00'),(575,5,3,98,'2016-04-24 15:56:01','2016-04-24 15:56:01'),(576,6,12,98,'2016-04-24 15:56:01','2016-04-24 15:56:01'),(577,1,1,99,'2016-04-24 15:56:09','2016-04-24 15:56:09'),(578,2,1,99,'2016-04-24 15:56:09','2016-04-24 15:56:09'),(579,3,1,99,'2016-04-24 15:56:09','2016-04-24 15:56:09'),(580,4,12,99,'2016-04-24 15:56:09','2016-04-24 15:56:09'),(581,5,3,99,'2016-04-24 15:56:09','2016-04-24 15:56:09'),(582,6,12,99,'2016-04-24 15:56:09','2016-04-24 15:56:09'),(583,1,1,100,'2016-04-24 15:56:19','2016-04-24 15:56:19'),(584,2,1,100,'2016-04-24 15:56:19','2016-04-24 15:56:19'),(585,3,1,100,'2016-04-24 15:56:19','2016-04-24 15:56:19'),(586,4,12,100,'2016-04-24 15:56:19','2016-04-24 15:56:19'),(587,5,3,100,'2016-04-24 15:56:19','2016-04-24 15:56:19'),(588,6,12,100,'2016-04-24 15:56:19','2016-04-24 15:56:19'),(589,1,1,101,'2016-04-24 15:56:24','2016-04-24 15:56:24'),(590,2,1,101,'2016-04-24 15:56:24','2016-04-24 15:56:24'),(591,3,1,101,'2016-04-24 15:56:24','2016-04-24 15:56:24'),(592,4,12,101,'2016-04-24 15:56:24','2016-04-24 15:56:24'),(593,5,3,101,'2016-04-24 15:56:25','2016-04-24 15:56:25'),(594,6,12,101,'2016-04-24 15:56:25','2016-04-24 15:56:25'),(595,1,1,102,'2016-04-24 15:58:18','2016-04-24 15:58:18'),(596,2,1,102,'2016-04-24 15:58:18','2016-04-24 15:58:18'),(597,3,1,102,'2016-04-24 15:58:18','2016-04-24 15:58:18'),(598,4,12,102,'2016-04-24 15:58:18','2016-04-24 15:58:18'),(599,5,3,102,'2016-04-24 15:58:18','2016-04-24 15:58:18'),(600,6,12,102,'2016-04-24 15:58:18','2016-04-24 15:58:18'),(601,1,1,103,'2016-04-24 15:58:25','2016-04-24 15:58:25'),(602,2,1,103,'2016-04-24 15:58:25','2016-04-24 15:58:25'),(603,3,1,103,'2016-04-24 15:58:25','2016-04-24 15:58:25'),(604,4,12,103,'2016-04-24 15:58:26','2016-04-24 15:58:26'),(605,5,3,103,'2016-04-24 15:58:26','2016-04-24 15:58:26'),(606,6,12,103,'2016-04-24 15:58:26','2016-04-24 15:58:26'),(607,1,1,104,'2016-04-24 15:58:57','2016-04-24 15:58:57'),(608,2,1,104,'2016-04-24 15:58:57','2016-04-24 15:58:57'),(609,3,1,104,'2016-04-24 15:58:57','2016-04-24 15:58:57'),(610,4,12,104,'2016-04-24 15:58:57','2016-04-24 15:58:57'),(611,5,3,104,'2016-04-24 15:58:57','2016-04-24 15:58:57'),(612,6,12,104,'2016-04-24 15:58:57','2016-04-24 15:58:57'),(613,1,1,105,'2016-04-24 15:59:08','2016-04-24 15:59:08'),(614,2,1,105,'2016-04-24 15:59:08','2016-04-24 15:59:08'),(615,3,1,105,'2016-04-24 15:59:08','2016-04-24 15:59:08'),(616,4,12,105,'2016-04-24 15:59:08','2016-04-24 15:59:08'),(617,5,3,105,'2016-04-24 15:59:08','2016-04-24 15:59:08'),(618,6,12,105,'2016-04-24 15:59:09','2016-04-24 15:59:09'),(619,1,1,106,'2016-04-24 16:02:16','2016-04-24 16:02:16'),(620,2,1,106,'2016-04-24 16:02:16','2016-04-24 16:02:16'),(621,3,1,106,'2016-04-24 16:02:16','2016-04-24 16:02:16'),(622,4,12,106,'2016-04-24 16:02:16','2016-04-24 16:02:16'),(623,5,3,106,'2016-04-24 16:02:16','2016-04-24 16:02:16'),(624,6,12,106,'2016-04-24 16:02:16','2016-04-24 16:02:16'),(625,1,1,107,'2016-04-24 16:02:45','2016-04-24 16:02:45'),(626,2,1,107,'2016-04-24 16:02:45','2016-04-24 16:02:45'),(627,3,1,107,'2016-04-24 16:02:45','2016-04-24 16:02:45'),(628,4,12,107,'2016-04-24 16:02:45','2016-04-24 16:02:45'),(629,5,3,107,'2016-04-24 16:02:46','2016-04-24 16:02:46'),(630,6,12,107,'2016-04-24 16:02:46','2016-04-24 16:02:46'),(631,1,1,108,'2016-04-24 16:02:49','2016-04-24 16:02:49'),(632,2,1,108,'2016-04-24 16:02:49','2016-04-24 16:02:49'),(633,3,1,108,'2016-04-24 16:02:49','2016-04-24 16:02:49'),(634,4,12,108,'2016-04-24 16:02:49','2016-04-24 16:02:49'),(635,5,3,108,'2016-04-24 16:02:49','2016-04-24 16:02:49'),(636,6,12,108,'2016-04-24 16:02:49','2016-04-24 16:02:49'),(637,1,1,109,'2016-04-24 16:03:01','2016-04-24 16:03:01'),(638,2,1,109,'2016-04-24 16:03:01','2016-04-24 16:03:01'),(639,3,1,109,'2016-04-24 16:03:01','2016-04-24 16:03:01'),(640,4,12,109,'2016-04-24 16:03:01','2016-04-24 16:03:01'),(641,5,3,109,'2016-04-24 16:03:02','2016-04-24 16:03:02'),(642,6,12,109,'2016-04-24 16:03:02','2016-04-24 16:03:02'),(643,1,1,110,'2016-04-24 16:03:11','2016-04-24 16:03:11'),(644,2,1,110,'2016-04-24 16:03:11','2016-04-24 16:03:11'),(645,3,1,110,'2016-04-24 16:03:11','2016-04-24 16:03:11'),(646,4,12,110,'2016-04-24 16:03:12','2016-04-24 16:03:12'),(647,5,3,110,'2016-04-24 16:03:12','2016-04-24 16:03:12'),(648,6,12,110,'2016-04-24 16:03:12','2016-04-24 16:03:12'),(649,1,1,111,'2016-04-24 16:03:15','2016-04-24 16:03:15'),(650,2,1,111,'2016-04-24 16:03:15','2016-04-24 16:03:15'),(651,3,1,111,'2016-04-24 16:03:15','2016-04-24 16:03:15'),(652,4,12,111,'2016-04-24 16:03:15','2016-04-24 16:03:15'),(653,5,3,111,'2016-04-24 16:03:15','2016-04-24 16:03:15'),(654,6,12,111,'2016-04-24 16:03:15','2016-04-24 16:03:15'),(655,1,1,112,'2016-04-24 16:03:23','2016-04-24 16:03:23'),(656,2,1,112,'2016-04-24 16:03:23','2016-04-24 16:03:23'),(657,3,1,112,'2016-04-24 16:03:23','2016-04-24 16:03:23'),(658,4,12,112,'2016-04-24 16:03:23','2016-04-24 16:03:23'),(659,5,3,112,'2016-04-24 16:03:23','2016-04-24 16:03:23'),(660,6,12,112,'2016-04-24 16:03:23','2016-04-24 16:03:23'),(661,1,1,113,'2016-04-24 16:03:47','2016-04-24 16:03:47'),(662,2,1,113,'2016-04-24 16:03:47','2016-04-24 16:03:47'),(663,3,1,113,'2016-04-24 16:03:47','2016-04-24 16:03:47'),(664,4,12,113,'2016-04-24 16:03:47','2016-04-24 16:03:47'),(665,5,3,113,'2016-04-24 16:03:48','2016-04-24 16:03:48'),(666,6,12,113,'2016-04-24 16:03:48','2016-04-24 16:03:48'),(667,1,1,114,'2016-04-24 16:03:51','2016-04-24 16:03:51'),(668,2,1,114,'2016-04-24 16:03:51','2016-04-24 16:03:51'),(669,3,1,114,'2016-04-24 16:03:51','2016-04-24 16:03:51'),(670,4,12,114,'2016-04-24 16:03:51','2016-04-24 16:03:51'),(671,5,3,114,'2016-04-24 16:03:51','2016-04-24 16:03:51'),(672,6,12,114,'2016-04-24 16:03:51','2016-04-24 16:03:51'),(673,1,1,115,'2016-04-24 16:04:26','2016-04-24 16:04:26'),(674,2,1,115,'2016-04-24 16:04:26','2016-04-24 16:04:26'),(675,3,1,115,'2016-04-24 16:04:26','2016-04-24 16:04:26'),(676,4,12,115,'2016-04-24 16:04:26','2016-04-24 16:04:26'),(677,5,3,115,'2016-04-24 16:04:26','2016-04-24 16:04:26'),(678,6,12,115,'2016-04-24 16:04:26','2016-04-24 16:04:26'),(679,1,1,116,'2016-04-24 16:04:35','2016-04-24 16:04:35'),(680,2,1,116,'2016-04-24 16:04:35','2016-04-24 16:04:35'),(681,3,1,116,'2016-04-24 16:04:35','2016-04-24 16:04:35'),(682,4,12,116,'2016-04-24 16:04:35','2016-04-24 16:04:35'),(683,5,3,116,'2016-04-24 16:04:35','2016-04-24 16:04:35'),(684,6,12,116,'2016-04-24 16:04:35','2016-04-24 16:04:35'),(685,1,1,117,'2016-04-24 16:04:49','2016-04-24 16:04:49'),(686,2,1,117,'2016-04-24 16:04:49','2016-04-24 16:04:49'),(687,3,1,117,'2016-04-24 16:04:49','2016-04-24 16:04:49'),(688,4,12,117,'2016-04-24 16:04:49','2016-04-24 16:04:49'),(689,5,3,117,'2016-04-24 16:04:50','2016-04-24 16:04:50'),(690,6,12,117,'2016-04-24 16:04:50','2016-04-24 16:04:50'),(691,1,1,118,'2016-04-24 16:04:53','2016-04-24 16:04:53'),(692,2,1,118,'2016-04-24 16:04:53','2016-04-24 16:04:53'),(693,3,1,118,'2016-04-24 16:04:53','2016-04-24 16:04:53'),(694,4,12,118,'2016-04-24 16:04:53','2016-04-24 16:04:53'),(695,5,3,118,'2016-04-24 16:04:53','2016-04-24 16:04:53'),(696,6,12,118,'2016-04-24 16:04:53','2016-04-24 16:04:53'),(697,1,1,119,'2016-04-24 16:05:02','2016-04-24 16:05:02'),(698,2,1,119,'2016-04-24 16:05:02','2016-04-24 16:05:02'),(699,3,1,119,'2016-04-24 16:05:02','2016-04-24 16:05:02'),(700,4,12,119,'2016-04-24 16:05:02','2016-04-24 16:05:02'),(701,5,3,119,'2016-04-24 16:05:03','2016-04-24 16:05:03'),(702,6,12,119,'2016-04-24 16:05:03','2016-04-24 16:05:03'),(703,1,1,120,'2016-04-24 16:27:41','2016-04-24 16:27:41'),(704,2,1,120,'2016-04-24 16:27:41','2016-04-24 16:27:41'),(705,3,1,120,'2016-04-24 16:27:41','2016-04-24 16:27:41'),(706,4,12,120,'2016-04-24 16:27:41','2016-04-24 16:27:41'),(707,5,3,120,'2016-04-24 16:27:42','2016-04-24 16:27:42'),(708,6,12,120,'2016-04-24 16:27:42','2016-04-24 16:27:42'),(709,1,1,121,'2016-04-24 16:27:58','2016-04-24 16:27:58'),(710,2,1,121,'2016-04-24 16:27:58','2016-04-24 16:27:58'),(711,3,1,121,'2016-04-24 16:27:58','2016-04-24 16:27:58'),(712,4,12,121,'2016-04-24 16:27:58','2016-04-24 16:27:58'),(713,5,3,121,'2016-04-24 16:27:59','2016-04-24 16:27:59'),(714,6,12,121,'2016-04-24 16:27:59','2016-04-24 16:27:59'),(715,1,1,122,'2016-04-24 16:30:19','2016-04-24 16:30:19'),(716,2,1,122,'2016-04-24 16:30:19','2016-04-24 16:30:19'),(717,3,1,122,'2016-04-24 16:30:19','2016-04-24 16:30:19'),(718,4,12,122,'2016-04-24 16:30:19','2016-04-24 16:30:19'),(719,5,3,122,'2016-04-24 16:30:19','2016-04-24 16:30:19'),(720,6,12,122,'2016-04-24 16:30:19','2016-04-24 16:30:19'),(721,1,1,123,'2016-04-25 13:53:20','2016-04-25 13:53:20'),(722,2,1,123,'2016-04-25 13:53:20','2016-04-25 13:53:20'),(723,3,1,123,'2016-04-25 13:53:20','2016-04-25 13:53:20'),(724,11,13,123,'2016-04-25 13:53:20','2016-04-25 13:53:20'),(725,5,3,123,'2016-04-25 13:53:21','2016-04-25 13:53:21'),(726,6,13,123,'2016-04-25 13:53:21','2016-04-25 13:53:21'),(727,1,1,124,'2016-04-25 13:53:44','2016-04-25 13:53:44'),(728,2,1,124,'2016-04-25 13:53:44','2016-04-25 13:53:44'),(729,3,1,124,'2016-04-25 13:53:44','2016-04-25 13:53:44'),(730,11,14,124,'2016-04-25 13:53:44','2016-04-25 13:53:44'),(731,5,3,124,'2016-04-25 13:53:44','2016-04-25 13:53:44'),(732,6,14,124,'2016-04-25 13:53:44','2016-04-25 13:53:44'),(733,1,1,125,'2016-04-25 13:53:48','2016-04-25 13:53:48'),(734,2,1,125,'2016-04-25 13:53:48','2016-04-25 13:53:48'),(735,3,1,125,'2016-04-25 13:53:48','2016-04-25 13:53:48'),(736,4,14,125,'2016-04-25 13:53:48','2016-04-25 13:53:48'),(737,5,3,125,'2016-04-25 13:53:48','2016-04-25 13:53:48'),(738,6,14,125,'2016-04-25 13:53:48','2016-04-25 13:53:48'),(739,1,1,126,'2016-04-25 13:53:51','2016-04-25 13:53:51'),(740,2,1,126,'2016-04-25 13:53:51','2016-04-25 13:53:51'),(741,3,1,126,'2016-04-25 13:53:51','2016-04-25 13:53:51'),(742,4,14,126,'2016-04-25 13:53:51','2016-04-25 13:53:51'),(743,5,3,126,'2016-04-25 13:53:52','2016-04-25 13:53:52'),(744,6,14,126,'2016-04-25 13:53:52','2016-04-25 13:53:52'),(745,1,1,127,'2016-04-25 13:54:25','2016-04-25 13:54:25'),(746,2,1,127,'2016-04-25 13:54:25','2016-04-25 13:54:25'),(747,3,1,127,'2016-04-25 13:54:25','2016-04-25 13:54:25'),(748,4,14,127,'2016-04-25 13:54:25','2016-04-25 13:54:25'),(749,5,3,127,'2016-04-25 13:54:25','2016-04-25 13:54:25'),(750,6,14,127,'2016-04-25 13:54:25','2016-04-25 13:54:25'),(751,1,1,128,'2016-04-25 13:54:44','2016-04-25 13:54:44'),(752,2,1,128,'2016-04-25 13:54:44','2016-04-25 13:54:44'),(753,3,1,128,'2016-04-25 13:54:44','2016-04-25 13:54:44'),(754,4,14,128,'2016-04-25 13:54:44','2016-04-25 13:54:44'),(755,5,3,128,'2016-04-25 13:54:44','2016-04-25 13:54:44'),(756,6,14,128,'2016-04-25 13:54:44','2016-04-25 13:54:44'),(757,1,1,129,'2016-04-25 13:55:39','2016-04-25 13:55:39'),(758,2,1,129,'2016-04-25 13:55:39','2016-04-25 13:55:39'),(759,3,1,129,'2016-04-25 13:55:39','2016-04-25 13:55:39'),(760,4,14,129,'2016-04-25 13:55:39','2016-04-25 13:55:39'),(761,5,3,129,'2016-04-25 13:55:39','2016-04-25 13:55:39'),(762,6,14,129,'2016-04-25 13:55:39','2016-04-25 13:55:39'),(763,1,1,130,'2016-04-25 13:58:31','2016-04-25 13:58:31'),(764,2,1,130,'2016-04-25 13:58:31','2016-04-25 13:58:31'),(765,3,1,130,'2016-04-25 13:58:31','2016-04-25 13:58:31'),(766,4,14,130,'2016-04-25 13:58:31','2016-04-25 13:58:31'),(767,5,3,130,'2016-04-25 13:58:31','2016-04-25 13:58:31'),(768,6,14,130,'2016-04-25 13:58:31','2016-04-25 13:58:31'),(769,1,1,131,'2016-04-25 13:59:12','2016-04-25 13:59:12'),(770,2,1,131,'2016-04-25 13:59:12','2016-04-25 13:59:12'),(771,3,1,131,'2016-04-25 13:59:12','2016-04-25 13:59:12'),(772,4,14,131,'2016-04-25 13:59:12','2016-04-25 13:59:12'),(773,5,3,131,'2016-04-25 13:59:13','2016-04-25 13:59:13'),(774,6,14,131,'2016-04-25 13:59:13','2016-04-25 13:59:13'),(775,1,1,132,'2016-04-25 14:00:13','2016-04-25 14:00:13'),(776,2,1,132,'2016-04-25 14:00:13','2016-04-25 14:00:13'),(777,3,1,132,'2016-04-25 14:00:13','2016-04-25 14:00:13'),(778,4,14,132,'2016-04-25 14:00:13','2016-04-25 14:00:13'),(779,5,3,132,'2016-04-25 14:00:13','2016-04-25 14:00:13'),(780,6,14,132,'2016-04-25 14:00:13','2016-04-25 14:00:13'),(781,1,1,133,'2016-04-25 14:01:35','2016-04-25 14:01:35'),(782,2,1,133,'2016-04-25 14:01:35','2016-04-25 14:01:35'),(783,3,1,133,'2016-04-25 14:01:35','2016-04-25 14:01:35'),(784,4,14,133,'2016-04-25 14:01:35','2016-04-25 14:01:35'),(785,5,3,133,'2016-04-25 14:01:35','2016-04-25 14:01:35'),(786,6,14,133,'2016-04-25 14:01:35','2016-04-25 14:01:35'),(787,1,1,134,'2016-04-25 14:01:42','2016-04-25 14:01:42'),(788,2,1,134,'2016-04-25 14:01:42','2016-04-25 14:01:42'),(789,3,1,134,'2016-04-25 14:01:42','2016-04-25 14:01:42'),(790,4,14,134,'2016-04-25 14:01:43','2016-04-25 14:01:43'),(791,5,3,134,'2016-04-25 14:01:43','2016-04-25 14:01:43'),(792,6,14,134,'2016-04-25 14:01:43','2016-04-25 14:01:43'),(793,1,1,135,'2016-04-25 14:01:52','2016-04-25 14:01:52'),(794,2,1,135,'2016-04-25 14:01:52','2016-04-25 14:01:52'),(795,3,1,135,'2016-04-25 14:01:52','2016-04-25 14:01:52'),(796,4,14,135,'2016-04-25 14:01:53','2016-04-25 14:01:53'),(797,8,5,135,'2016-04-25 14:01:53','2016-04-25 14:01:53'),(798,9,14,135,'2016-04-25 14:01:53','2016-04-25 14:01:53'),(799,10,4,135,'2016-04-25 14:01:53','2016-04-25 14:01:53'),(800,5,3,135,'2016-04-25 14:01:53','2016-04-25 14:01:53'),(801,6,15,135,'2016-04-25 14:01:53','2016-04-25 14:01:53'),(802,1,1,136,'2016-04-25 14:01:56','2016-04-25 14:01:56'),(803,2,1,136,'2016-04-25 14:01:56','2016-04-25 14:01:56'),(804,3,1,136,'2016-04-25 14:01:56','2016-04-25 14:01:56'),(805,4,15,136,'2016-04-25 14:01:56','2016-04-25 14:01:56'),(806,5,3,136,'2016-04-25 14:01:57','2016-04-25 14:01:57'),(807,6,15,136,'2016-04-25 14:01:57','2016-04-25 14:01:57'),(808,1,1,137,'2016-04-25 14:02:07','2016-04-25 14:02:07'),(809,2,1,137,'2016-04-25 14:02:07','2016-04-25 14:02:07'),(810,3,1,137,'2016-04-25 14:02:07','2016-04-25 14:02:07'),(811,4,15,137,'2016-04-25 14:02:07','2016-04-25 14:02:07'),(812,5,3,137,'2016-04-25 14:02:08','2016-04-25 14:02:08'),(813,6,15,137,'2016-04-25 14:02:08','2016-04-25 14:02:08'),(814,1,1,138,'2016-04-25 14:05:36','2016-04-25 14:05:36'),(815,2,1,138,'2016-04-25 14:05:36','2016-04-25 14:05:36'),(816,3,1,138,'2016-04-25 14:05:36','2016-04-25 14:05:36'),(817,4,15,138,'2016-04-25 14:05:36','2016-04-25 14:05:36'),(818,5,3,138,'2016-04-25 14:05:36','2016-04-25 14:05:36'),(819,6,15,138,'2016-04-25 14:05:36','2016-04-25 14:05:36'),(820,1,1,139,'2016-04-25 14:07:45','2016-04-25 14:07:45'),(821,2,1,139,'2016-04-25 14:07:45','2016-04-25 14:07:45'),(822,3,1,139,'2016-04-25 14:07:45','2016-04-25 14:07:45'),(823,4,15,139,'2016-04-25 14:07:45','2016-04-25 14:07:45'),(824,5,3,139,'2016-04-25 14:07:46','2016-04-25 14:07:46'),(825,6,15,139,'2016-04-25 14:07:46','2016-04-25 14:07:46'),(826,1,1,140,'2016-04-25 08:36:12','2016-04-25 08:36:12'),(827,2,1,140,'2016-04-25 08:36:12','2016-04-25 08:36:12'),(828,3,1,140,'2016-04-25 08:36:12','2016-04-25 08:36:12'),(829,11,16,140,'2016-04-25 08:36:12','2016-04-25 08:36:12'),(830,5,3,140,'2016-04-25 08:36:13','2016-04-25 08:36:13'),(831,6,16,140,'2016-04-25 08:36:13','2016-04-25 08:36:13'),(832,1,1,141,'2016-04-25 08:36:26','2016-04-25 08:36:26'),(833,2,1,141,'2016-04-25 08:36:26','2016-04-25 08:36:26'),(834,3,1,141,'2016-04-25 08:36:26','2016-04-25 08:36:26'),(835,4,16,141,'2016-04-25 08:36:26','2016-04-25 08:36:26'),(836,5,3,141,'2016-04-25 08:36:26','2016-04-25 08:36:26'),(837,6,16,141,'2016-04-25 08:36:26','2016-04-25 08:36:26'),(838,1,1,142,'2016-04-25 08:36:32','2016-04-25 08:36:32'),(839,2,1,142,'2016-04-25 08:36:32','2016-04-25 08:36:32'),(840,3,1,142,'2016-04-25 08:36:32','2016-04-25 08:36:32'),(841,4,16,142,'2016-04-25 08:36:32','2016-04-25 08:36:32'),(842,5,3,142,'2016-04-25 08:36:32','2016-04-25 08:36:32'),(843,6,16,142,'2016-04-25 08:36:32','2016-04-25 08:36:32'),(844,1,1,143,'2016-04-25 08:36:33','2016-04-25 08:36:33'),(845,2,1,143,'2016-04-25 08:36:33','2016-04-25 08:36:33'),(846,3,1,143,'2016-04-25 08:36:33','2016-04-25 08:36:33'),(847,4,16,143,'2016-04-25 08:36:33','2016-04-25 08:36:33'),(848,5,3,143,'2016-04-25 08:36:33','2016-04-25 08:36:33'),(849,6,16,143,'2016-04-25 08:36:33','2016-04-25 08:36:33'),(850,1,1,144,'2016-04-25 08:36:36','2016-04-25 08:36:36'),(851,2,1,144,'2016-04-25 08:36:36','2016-04-25 08:36:36'),(852,3,1,144,'2016-04-25 08:36:36','2016-04-25 08:36:36'),(853,4,16,144,'2016-04-25 08:36:36','2016-04-25 08:36:36'),(854,5,3,144,'2016-04-25 08:36:36','2016-04-25 08:36:36'),(855,6,16,144,'2016-04-25 08:36:36','2016-04-25 08:36:36'),(856,1,1,145,'2016-04-25 08:36:45','2016-04-25 08:36:45'),(857,2,1,145,'2016-04-25 08:36:45','2016-04-25 08:36:45'),(858,3,1,145,'2016-04-25 08:36:45','2016-04-25 08:36:45'),(859,4,16,145,'2016-04-25 08:36:45','2016-04-25 08:36:45'),(860,5,3,145,'2016-04-25 08:36:45','2016-04-25 08:36:45'),(861,6,16,145,'2016-04-25 08:36:45','2016-04-25 08:36:45'),(862,1,1,146,'2016-04-25 08:36:46','2016-04-25 08:36:46'),(863,2,1,146,'2016-04-25 08:36:46','2016-04-25 08:36:46'),(864,3,1,146,'2016-04-25 08:36:46','2016-04-25 08:36:46'),(865,4,16,146,'2016-04-25 08:36:46','2016-04-25 08:36:46'),(866,5,3,146,'2016-04-25 08:36:46','2016-04-25 08:36:46'),(867,6,16,146,'2016-04-25 08:36:46','2016-04-25 08:36:46'),(868,1,1,147,'2016-04-25 08:37:02','2016-04-25 08:37:02'),(869,2,1,147,'2016-04-25 08:37:02','2016-04-25 08:37:02'),(870,3,1,147,'2016-04-25 08:37:02','2016-04-25 08:37:02'),(871,4,16,147,'2016-04-25 08:37:02','2016-04-25 08:37:02'),(872,5,3,147,'2016-04-25 08:37:02','2016-04-25 08:37:02'),(873,6,16,147,'2016-04-25 08:37:02','2016-04-25 08:37:02'),(874,1,1,148,'2016-04-25 08:37:14','2016-04-25 08:37:14'),(875,2,1,148,'2016-04-25 08:37:14','2016-04-25 08:37:14'),(876,3,1,148,'2016-04-25 08:37:14','2016-04-25 08:37:14'),(877,11,17,148,'2016-04-25 08:37:14','2016-04-25 08:37:14'),(878,5,3,148,'2016-04-25 08:37:15','2016-04-25 08:37:15'),(879,6,17,148,'2016-04-25 08:37:15','2016-04-25 08:37:15'),(880,1,1,149,'2016-04-25 08:37:17','2016-04-25 08:37:17'),(881,2,1,149,'2016-04-25 08:37:17','2016-04-25 08:37:17'),(882,3,1,149,'2016-04-25 08:37:17','2016-04-25 08:37:17'),(883,11,18,149,'2016-04-25 08:37:17','2016-04-25 08:37:17'),(884,5,3,149,'2016-04-25 08:37:17','2016-04-25 08:37:17'),(885,6,18,149,'2016-04-25 08:37:17','2016-04-25 08:37:17'),(886,1,1,150,'2016-04-25 08:43:49','2016-04-25 08:43:49'),(887,2,1,150,'2016-04-25 08:43:50','2016-04-25 08:43:50'),(888,3,1,150,'2016-04-25 08:43:50','2016-04-25 08:43:50'),(889,11,19,150,'2016-04-25 08:43:50','2016-04-25 08:43:50'),(890,5,3,150,'2016-04-25 08:43:50','2016-04-25 08:43:50'),(891,6,19,150,'2016-04-25 08:43:50','2016-04-25 08:43:50'),(892,1,1,151,'2016-04-25 09:38:38','2016-04-25 09:38:38'),(893,2,1,151,'2016-04-25 09:38:38','2016-04-25 09:38:38'),(894,3,1,151,'2016-04-25 09:38:38','2016-04-25 09:38:38'),(895,4,16,151,'2016-04-25 09:38:38','2016-04-25 09:38:38'),(896,5,3,151,'2016-04-25 09:38:38','2016-04-25 09:38:38'),(897,6,16,151,'2016-04-25 09:38:38','2016-04-25 09:38:38'),(898,1,1,152,'2016-04-25 09:48:51','2016-04-25 09:48:51'),(899,2,1,152,'2016-04-25 09:48:51','2016-04-25 09:48:51'),(900,3,1,152,'2016-04-25 09:48:51','2016-04-25 09:48:51'),(901,11,20,152,'2016-04-25 09:48:51','2016-04-25 09:48:51'),(902,5,3,152,'2016-04-25 09:48:51','2016-04-25 09:48:51'),(903,6,20,152,'2016-04-25 09:48:51','2016-04-25 09:48:51'),(904,1,1,153,'2016-04-25 13:56:05','2016-04-25 13:56:05'),(905,2,1,153,'2016-04-25 13:56:05','2016-04-25 13:56:05'),(906,3,1,153,'2016-04-25 13:56:05','2016-04-25 13:56:05'),(907,11,21,153,'2016-04-25 13:56:05','2016-04-25 13:56:05'),(908,5,3,153,'2016-04-25 13:56:05','2016-04-25 13:56:05'),(909,6,21,153,'2016-04-25 13:56:05','2016-04-25 13:56:05'),(910,1,1,154,'2016-04-26 16:39:21','2016-04-26 16:39:21'),(911,2,1,154,'2016-04-26 16:39:21','2016-04-26 16:39:21'),(912,3,1,154,'2016-04-26 16:39:21','2016-04-26 16:39:21'),(913,4,22,154,'2016-04-26 16:39:21','2016-04-26 16:39:21'),(914,5,3,154,'2016-04-26 16:39:22','2016-04-26 16:39:22'),(915,6,22,154,'2016-04-26 16:39:22','2016-04-26 16:39:22'),(916,1,1,155,'2016-04-26 16:39:35','2016-04-26 16:39:35'),(917,2,1,155,'2016-04-26 16:39:35','2016-04-26 16:39:35'),(918,3,1,155,'2016-04-26 16:39:35','2016-04-26 16:39:35'),(919,4,22,155,'2016-04-26 16:39:35','2016-04-26 16:39:35'),(920,5,3,155,'2016-04-26 16:39:36','2016-04-26 16:39:36'),(921,6,22,155,'2016-04-26 16:39:36','2016-04-26 16:39:36'),(922,1,1,156,'2016-04-26 16:39:59','2016-04-26 16:39:59'),(923,2,1,156,'2016-04-26 16:39:59','2016-04-26 16:39:59'),(924,3,1,156,'2016-04-26 16:39:59','2016-04-26 16:39:59'),(925,4,22,156,'2016-04-26 16:39:59','2016-04-26 16:39:59'),(926,5,3,156,'2016-04-26 16:39:59','2016-04-26 16:39:59'),(927,6,22,156,'2016-04-26 16:39:59','2016-04-26 16:39:59'),(928,1,1,157,'2016-04-26 16:41:25','2016-04-26 16:41:25'),(929,2,1,157,'2016-04-26 16:41:25','2016-04-26 16:41:25'),(930,3,1,157,'2016-04-26 16:41:25','2016-04-26 16:41:25'),(931,4,22,157,'2016-04-26 16:41:25','2016-04-26 16:41:25'),(932,5,3,157,'2016-04-26 16:41:26','2016-04-26 16:41:26'),(933,6,22,157,'2016-04-26 16:41:26','2016-04-26 16:41:26'),(934,1,1,158,'2016-04-26 16:41:34','2016-04-26 16:41:34'),(935,2,1,158,'2016-04-26 16:41:34','2016-04-26 16:41:34'),(936,3,1,158,'2016-04-26 16:41:34','2016-04-26 16:41:34'),(937,4,22,158,'2016-04-26 16:41:34','2016-04-26 16:41:34'),(938,5,3,158,'2016-04-26 16:41:34','2016-04-26 16:41:34'),(939,6,22,158,'2016-04-26 16:41:34','2016-04-26 16:41:34'),(940,1,1,159,'2016-04-26 16:41:37','2016-04-26 16:41:37'),(941,2,1,159,'2016-04-26 16:41:37','2016-04-26 16:41:37'),(942,3,1,159,'2016-04-26 16:41:37','2016-04-26 16:41:37'),(943,4,22,159,'2016-04-26 16:41:38','2016-04-26 16:41:38'),(944,5,3,159,'2016-04-26 16:41:38','2016-04-26 16:41:38'),(945,6,22,159,'2016-04-26 16:41:38','2016-04-26 16:41:38'),(946,1,1,160,'2016-04-26 16:41:43','2016-04-26 16:41:43'),(947,2,1,160,'2016-04-26 16:41:43','2016-04-26 16:41:43'),(948,3,1,160,'2016-04-26 16:41:43','2016-04-26 16:41:43'),(949,4,22,160,'2016-04-26 16:41:43','2016-04-26 16:41:43'),(950,5,3,160,'2016-04-26 16:41:43','2016-04-26 16:41:43'),(951,6,22,160,'2016-04-26 16:41:43','2016-04-26 16:41:43'),(952,1,1,161,'2016-04-26 16:41:46','2016-04-26 16:41:46'),(953,2,1,161,'2016-04-26 16:41:46','2016-04-26 16:41:46'),(954,3,1,161,'2016-04-26 16:41:46','2016-04-26 16:41:46'),(955,4,22,161,'2016-04-26 16:41:47','2016-04-26 16:41:47'),(956,5,3,161,'2016-04-26 16:41:47','2016-04-26 16:41:47'),(957,6,22,161,'2016-04-26 16:41:47','2016-04-26 16:41:47'),(958,1,1,162,'2016-04-26 16:41:53','2016-04-26 16:41:53'),(959,2,1,162,'2016-04-26 16:41:53','2016-04-26 16:41:53'),(960,3,1,162,'2016-04-26 16:41:53','2016-04-26 16:41:53'),(961,4,22,162,'2016-04-26 16:41:53','2016-04-26 16:41:53'),(962,5,3,162,'2016-04-26 16:41:55','2016-04-26 16:41:55'),(963,6,22,162,'2016-04-26 16:41:55','2016-04-26 16:41:55'),(964,1,1,163,'2016-04-26 16:41:58','2016-04-26 16:41:58'),(965,2,1,163,'2016-04-26 16:41:58','2016-04-26 16:41:58'),(966,3,1,163,'2016-04-26 16:41:58','2016-04-26 16:41:58'),(967,4,22,163,'2016-04-26 16:41:58','2016-04-26 16:41:58'),(968,5,3,163,'2016-04-26 16:41:58','2016-04-26 16:41:58'),(969,6,22,163,'2016-04-26 16:41:58','2016-04-26 16:41:58'),(970,1,1,164,'2016-04-26 16:46:43','2016-04-26 16:46:43'),(971,2,1,164,'2016-04-26 16:46:43','2016-04-26 16:46:43'),(972,3,1,164,'2016-04-26 16:46:43','2016-04-26 16:46:43'),(973,4,22,164,'2016-04-26 16:46:43','2016-04-26 16:46:43'),(974,5,3,164,'2016-04-26 16:46:44','2016-04-26 16:46:44'),(975,6,22,164,'2016-04-26 16:46:44','2016-04-26 16:46:44'),(976,1,1,165,'2016-04-26 16:47:39','2016-04-26 16:47:39'),(977,2,1,165,'2016-04-26 16:47:39','2016-04-26 16:47:39'),(978,3,1,165,'2016-04-26 16:47:39','2016-04-26 16:47:39'),(979,4,22,165,'2016-04-26 16:47:39','2016-04-26 16:47:39'),(980,5,3,165,'2016-04-26 16:47:40','2016-04-26 16:47:40'),(981,6,22,165,'2016-04-26 16:47:40','2016-04-26 16:47:40'),(982,1,1,166,'2016-04-26 16:48:54','2016-04-26 16:48:54'),(983,2,1,166,'2016-04-26 16:48:54','2016-04-26 16:48:54'),(984,3,1,166,'2016-04-26 16:48:54','2016-04-26 16:48:54'),(985,4,22,166,'2016-04-26 16:48:55','2016-04-26 16:48:55'),(986,5,3,166,'2016-04-26 16:48:56','2016-04-26 16:48:56'),(987,6,22,166,'2016-04-26 16:48:56','2016-04-26 16:48:56'),(988,1,1,167,'2016-04-26 16:48:59','2016-04-26 16:48:59'),(989,2,1,167,'2016-04-26 16:48:59','2016-04-26 16:48:59'),(990,3,1,167,'2016-04-26 16:48:59','2016-04-26 16:48:59'),(991,4,22,167,'2016-04-26 16:48:59','2016-04-26 16:48:59'),(992,5,3,167,'2016-04-26 16:49:00','2016-04-26 16:49:00'),(993,6,22,167,'2016-04-26 16:49:00','2016-04-26 16:49:00'),(994,1,1,168,'2016-04-26 16:49:25','2016-04-26 16:49:25'),(995,2,1,168,'2016-04-26 16:49:25','2016-04-26 16:49:25'),(996,3,1,168,'2016-04-26 16:49:25','2016-04-26 16:49:25'),(997,4,22,168,'2016-04-26 16:49:25','2016-04-26 16:49:25'),(998,5,3,168,'2016-04-26 16:49:26','2016-04-26 16:49:26'),(999,6,22,168,'2016-04-26 16:49:26','2016-04-26 16:49:26'),(1000,1,1,169,'2016-04-26 16:49:27','2016-04-26 16:49:27'),(1001,2,1,169,'2016-04-26 16:49:27','2016-04-26 16:49:27'),(1002,3,1,169,'2016-04-26 16:49:27','2016-04-26 16:49:27'),(1003,4,22,169,'2016-04-26 16:49:27','2016-04-26 16:49:27'),(1004,5,3,169,'2016-04-26 16:49:27','2016-04-26 16:49:27'),(1005,6,22,169,'2016-04-26 16:49:27','2016-04-26 16:49:27'),(1006,1,1,170,'2016-04-26 16:49:28','2016-04-26 16:49:28'),(1007,2,1,170,'2016-04-26 16:49:28','2016-04-26 16:49:28'),(1008,3,1,170,'2016-04-26 16:49:28','2016-04-26 16:49:28'),(1009,4,22,170,'2016-04-26 16:49:28','2016-04-26 16:49:28'),(1010,5,3,170,'2016-04-26 16:49:29','2016-04-26 16:49:29'),(1011,6,22,170,'2016-04-26 16:49:29','2016-04-26 16:49:29'),(1012,1,1,171,'2016-04-26 16:49:32','2016-04-26 16:49:32'),(1013,2,1,171,'2016-04-26 16:49:32','2016-04-26 16:49:32'),(1014,3,1,171,'2016-04-26 16:49:32','2016-04-26 16:49:32'),(1015,4,22,171,'2016-04-26 16:49:32','2016-04-26 16:49:32'),(1016,5,3,171,'2016-04-26 16:49:33','2016-04-26 16:49:33'),(1017,6,22,171,'2016-04-26 16:49:33','2016-04-26 16:49:33'),(1018,1,1,172,'2016-04-26 16:49:38','2016-04-26 16:49:38'),(1019,2,1,172,'2016-04-26 16:49:38','2016-04-26 16:49:38'),(1020,3,1,172,'2016-04-26 16:49:38','2016-04-26 16:49:38'),(1021,4,22,172,'2016-04-26 16:49:38','2016-04-26 16:49:38'),(1022,5,3,172,'2016-04-26 16:49:41','2016-04-26 16:49:41'),(1023,6,22,172,'2016-04-26 16:49:41','2016-04-26 16:49:41'),(1024,1,1,173,'2016-04-26 16:49:44','2016-04-26 16:49:44'),(1025,2,1,173,'2016-04-26 16:49:44','2016-04-26 16:49:44'),(1026,3,1,173,'2016-04-26 16:49:44','2016-04-26 16:49:44'),(1027,4,22,173,'2016-04-26 16:49:45','2016-04-26 16:49:45'),(1028,5,3,173,'2016-04-26 16:49:45','2016-04-26 16:49:45'),(1029,6,22,173,'2016-04-26 16:49:45','2016-04-26 16:49:45'),(1030,1,1,174,'2016-04-26 16:49:58','2016-04-26 16:49:58'),(1031,2,1,174,'2016-04-26 16:49:58','2016-04-26 16:49:58'),(1032,3,1,174,'2016-04-26 16:49:58','2016-04-26 16:49:58'),(1033,4,22,174,'2016-04-26 16:49:58','2016-04-26 16:49:58'),(1034,5,3,174,'2016-04-26 16:49:58','2016-04-26 16:49:58'),(1035,6,22,174,'2016-04-26 16:49:58','2016-04-26 16:49:58'),(1036,1,1,175,'2016-04-26 16:50:09','2016-04-26 16:50:09'),(1037,2,1,175,'2016-04-26 16:50:09','2016-04-26 16:50:09'),(1038,3,1,175,'2016-04-26 16:50:09','2016-04-26 16:50:09'),(1039,4,22,175,'2016-04-26 16:50:10','2016-04-26 16:50:10'),(1040,5,3,175,'2016-04-26 16:50:11','2016-04-26 16:50:11'),(1041,6,22,175,'2016-04-26 16:50:11','2016-04-26 16:50:11'),(1042,1,1,176,'2016-04-26 16:50:14','2016-04-26 16:50:14'),(1043,2,1,176,'2016-04-26 16:50:14','2016-04-26 16:50:14'),(1044,3,1,176,'2016-04-26 16:50:14','2016-04-26 16:50:14'),(1045,4,22,176,'2016-04-26 16:50:14','2016-04-26 16:50:14'),(1046,5,3,176,'2016-04-26 16:50:15','2016-04-26 16:50:15'),(1047,6,22,176,'2016-04-26 16:50:15','2016-04-26 16:50:15'),(1048,1,1,177,'2016-04-26 16:50:19','2016-04-26 16:50:19'),(1049,2,1,177,'2016-04-26 16:50:19','2016-04-26 16:50:19'),(1050,3,1,177,'2016-04-26 16:50:19','2016-04-26 16:50:19'),(1051,4,22,177,'2016-04-26 16:50:19','2016-04-26 16:50:19'),(1052,5,3,177,'2016-04-26 16:50:21','2016-04-26 16:50:21'),(1053,6,22,177,'2016-04-26 16:50:21','2016-04-26 16:50:21'),(1054,1,1,178,'2016-04-26 16:50:24','2016-04-26 16:50:24'),(1055,2,1,178,'2016-04-26 16:50:24','2016-04-26 16:50:24'),(1056,3,1,178,'2016-04-26 16:50:24','2016-04-26 16:50:24'),(1057,4,22,178,'2016-04-26 16:50:24','2016-04-26 16:50:24'),(1058,5,3,178,'2016-04-26 16:50:25','2016-04-26 16:50:25'),(1059,6,22,178,'2016-04-26 16:50:25','2016-04-26 16:50:25'),(1060,1,1,179,'2016-04-26 16:50:34','2016-04-26 16:50:34'),(1061,2,1,179,'2016-04-26 16:50:34','2016-04-26 16:50:34'),(1062,3,1,179,'2016-04-26 16:50:34','2016-04-26 16:50:34'),(1063,4,22,179,'2016-04-26 16:50:34','2016-04-26 16:50:34'),(1064,5,3,179,'2016-04-26 16:50:35','2016-04-26 16:50:35'),(1065,6,22,179,'2016-04-26 16:50:35','2016-04-26 16:50:35'),(1066,1,1,180,'2016-04-26 16:50:38','2016-04-26 16:50:38'),(1067,2,1,180,'2016-04-26 16:50:38','2016-04-26 16:50:38'),(1068,3,1,180,'2016-04-26 16:50:38','2016-04-26 16:50:38'),(1069,4,22,180,'2016-04-26 16:50:39','2016-04-26 16:50:39'),(1070,5,3,180,'2016-04-26 16:50:39','2016-04-26 16:50:39'),(1071,6,22,180,'2016-04-26 16:50:39','2016-04-26 16:50:39'),(1072,1,1,181,'2016-04-26 17:44:12','2016-04-26 17:44:12'),(1073,2,1,181,'2016-04-26 17:44:12','2016-04-26 17:44:12'),(1074,3,1,181,'2016-04-26 17:44:12','2016-04-26 17:44:12'),(1075,11,23,181,'2016-04-26 17:44:12','2016-04-26 17:44:12'),(1076,11,24,181,'2016-04-26 17:44:12','2016-04-26 17:44:12'),(1077,1,1,182,'2016-04-26 17:44:42','2016-04-26 17:44:42'),(1078,2,1,182,'2016-04-26 17:44:42','2016-04-26 17:44:42'),(1079,3,1,182,'2016-04-26 17:44:42','2016-04-26 17:44:42'),(1080,11,25,182,'2016-04-26 17:44:42','2016-04-26 17:44:42'),(1081,11,24,182,'2016-04-26 17:44:42','2016-04-26 17:44:42'),(1082,1,1,183,'2016-04-26 17:48:50','2016-04-26 17:48:50'),(1083,2,1,183,'2016-04-26 17:48:50','2016-04-26 17:48:50'),(1084,3,1,183,'2016-04-26 17:48:50','2016-04-26 17:48:50'),(1085,11,26,183,'2016-04-26 17:48:50','2016-04-26 17:48:50'),(1086,5,3,183,'2016-04-26 17:48:51','2016-04-26 17:48:51'),(1087,6,26,183,'2016-04-26 17:48:51','2016-04-26 17:48:51'),(1088,1,1,184,'2016-04-26 17:48:56','2016-04-26 17:48:56'),(1089,2,1,184,'2016-04-26 17:48:56','2016-04-26 17:48:56'),(1090,3,1,184,'2016-04-26 17:48:56','2016-04-26 17:48:56'),(1091,4,26,184,'2016-04-26 17:48:56','2016-04-26 17:48:56'),(1092,5,3,184,'2016-04-26 17:48:57','2016-04-26 17:48:57'),(1093,6,26,184,'2016-04-26 17:48:57','2016-04-26 17:48:57'),(1094,1,1,185,'2016-04-26 17:50:42','2016-04-26 17:50:42'),(1095,2,1,185,'2016-04-26 17:50:42','2016-04-26 17:50:42'),(1096,3,1,185,'2016-04-26 17:50:42','2016-04-26 17:50:42'),(1097,4,26,185,'2016-04-26 17:50:42','2016-04-26 17:50:42'),(1098,5,3,185,'2016-04-26 17:50:42','2016-04-26 17:50:42'),(1099,6,26,185,'2016-04-26 17:50:42','2016-04-26 17:50:42'),(1100,1,1,186,'2016-04-26 17:50:45','2016-04-26 17:50:45'),(1101,2,1,186,'2016-04-26 17:50:45','2016-04-26 17:50:45'),(1102,3,1,186,'2016-04-26 17:50:45','2016-04-26 17:50:45'),(1103,4,26,186,'2016-04-26 17:50:45','2016-04-26 17:50:45'),(1104,5,3,186,'2016-04-26 17:50:46','2016-04-26 17:50:46'),(1105,6,26,186,'2016-04-26 17:50:46','2016-04-26 17:50:46'),(1106,1,1,187,'2016-04-26 17:50:54','2016-04-26 17:50:54'),(1107,2,1,187,'2016-04-26 17:50:54','2016-04-26 17:50:54'),(1108,3,1,187,'2016-04-26 17:50:54','2016-04-26 17:50:54'),(1109,4,26,187,'2016-04-26 17:50:54','2016-04-26 17:50:54'),(1110,5,3,187,'2016-04-26 17:50:55','2016-04-26 17:50:55'),(1111,6,26,187,'2016-04-26 17:50:55','2016-04-26 17:50:55'),(1112,1,1,188,'2016-04-26 17:50:58','2016-04-26 17:50:58'),(1113,2,1,188,'2016-04-26 17:50:58','2016-04-26 17:50:58'),(1114,3,1,188,'2016-04-26 17:50:58','2016-04-26 17:50:58'),(1115,4,26,188,'2016-04-26 17:50:58','2016-04-26 17:50:58'),(1116,5,3,188,'2016-04-26 17:50:58','2016-04-26 17:50:58'),(1117,6,26,188,'2016-04-26 17:50:58','2016-04-26 17:50:58'),(1118,1,1,189,'2016-04-26 17:51:15','2016-04-26 17:51:15'),(1119,2,1,189,'2016-04-26 17:51:15','2016-04-26 17:51:15'),(1120,3,1,189,'2016-04-26 17:51:15','2016-04-26 17:51:15'),(1121,4,26,189,'2016-04-26 17:51:15','2016-04-26 17:51:15'),(1122,5,3,189,'2016-04-26 17:51:15','2016-04-26 17:51:15'),(1123,6,26,189,'2016-04-26 17:51:15','2016-04-26 17:51:15'),(1124,1,1,190,'2016-04-26 17:54:12','2016-04-26 17:54:12'),(1125,2,1,190,'2016-04-26 17:54:12','2016-04-26 17:54:12'),(1126,3,1,190,'2016-04-26 17:54:12','2016-04-26 17:54:12'),(1127,4,26,190,'2016-04-26 17:54:12','2016-04-26 17:54:12'),(1128,5,3,190,'2016-04-26 17:54:12','2016-04-26 17:54:12'),(1129,6,26,190,'2016-04-26 17:54:12','2016-04-26 17:54:12'),(1130,1,1,191,'2016-04-26 17:57:11','2016-04-26 17:57:11'),(1131,2,1,191,'2016-04-26 17:57:11','2016-04-26 17:57:11'),(1132,3,1,191,'2016-04-26 17:57:11','2016-04-26 17:57:11'),(1133,4,26,191,'2016-04-26 17:57:11','2016-04-26 17:57:11'),(1134,5,3,191,'2016-04-26 17:57:12','2016-04-26 17:57:12'),(1135,6,26,191,'2016-04-26 17:57:12','2016-04-26 17:57:12'),(1136,1,1,192,'2016-04-26 17:57:15','2016-04-26 17:57:15'),(1137,2,1,192,'2016-04-26 17:57:15','2016-04-26 17:57:15'),(1138,3,1,192,'2016-04-26 17:57:15','2016-04-26 17:57:15'),(1139,4,26,192,'2016-04-26 17:57:15','2016-04-26 17:57:15'),(1140,5,3,192,'2016-04-26 17:57:15','2016-04-26 17:57:15'),(1141,6,26,192,'2016-04-26 17:57:15','2016-04-26 17:57:15'),(1142,1,1,193,'2016-04-26 17:57:21','2016-04-26 17:57:21'),(1143,2,1,193,'2016-04-26 17:57:21','2016-04-26 17:57:21'),(1144,3,1,193,'2016-04-26 17:57:21','2016-04-26 17:57:21'),(1145,4,26,193,'2016-04-26 17:57:21','2016-04-26 17:57:21'),(1146,5,3,193,'2016-04-26 17:57:21','2016-04-26 17:57:21'),(1147,6,26,193,'2016-04-26 17:57:21','2016-04-26 17:57:21'),(1148,1,1,194,'2016-04-26 17:57:24','2016-04-26 17:57:24'),(1149,2,1,194,'2016-04-26 17:57:24','2016-04-26 17:57:24'),(1150,3,1,194,'2016-04-26 17:57:24','2016-04-26 17:57:24'),(1151,4,26,194,'2016-04-26 17:57:24','2016-04-26 17:57:24'),(1152,5,3,194,'2016-04-26 17:57:25','2016-04-26 17:57:25'),(1153,6,26,194,'2016-04-26 17:57:25','2016-04-26 17:57:25'),(1154,1,1,195,'2016-04-26 17:57:38','2016-04-26 17:57:38'),(1155,2,1,195,'2016-04-26 17:57:38','2016-04-26 17:57:38'),(1156,3,1,195,'2016-04-26 17:57:38','2016-04-26 17:57:38'),(1157,4,26,195,'2016-04-26 17:57:38','2016-04-26 17:57:38'),(1158,5,3,195,'2016-04-26 17:57:38','2016-04-26 17:57:38'),(1159,6,26,195,'2016-04-26 17:57:38','2016-04-26 17:57:38'),(1160,1,1,196,'2016-04-26 17:57:44','2016-04-26 17:57:44'),(1161,2,1,196,'2016-04-26 17:57:44','2016-04-26 17:57:44'),(1162,3,1,196,'2016-04-26 17:57:44','2016-04-26 17:57:44'),(1163,4,26,196,'2016-04-26 17:57:44','2016-04-26 17:57:44'),(1164,5,3,196,'2016-04-26 17:57:44','2016-04-26 17:57:44'),(1165,6,26,196,'2016-04-26 17:57:44','2016-04-26 17:57:44'),(1166,1,1,197,'2016-04-26 17:57:56','2016-04-26 17:57:56'),(1167,2,1,197,'2016-04-26 17:57:56','2016-04-26 17:57:56'),(1168,3,1,197,'2016-04-26 17:57:56','2016-04-26 17:57:56'),(1169,4,26,197,'2016-04-26 17:57:56','2016-04-26 17:57:56'),(1170,4,24,197,'2016-04-26 17:57:56','2016-04-26 17:57:56'),(1171,1,1,198,'2016-04-26 17:58:23','2016-04-26 17:58:23'),(1172,2,1,198,'2016-04-26 17:58:23','2016-04-26 17:58:23'),(1173,3,1,198,'2016-04-26 17:58:23','2016-04-26 17:58:23'),(1174,4,26,198,'2016-04-26 17:58:23','2016-04-26 17:58:23'),(1175,5,3,198,'2016-04-26 17:58:24','2016-04-26 17:58:24'),(1176,6,26,198,'2016-04-26 17:58:24','2016-04-26 17:58:24'),(1177,1,1,199,'2016-04-26 17:59:01','2016-04-26 17:59:01'),(1178,2,1,199,'2016-04-26 17:59:01','2016-04-26 17:59:01'),(1179,3,1,199,'2016-04-26 17:59:01','2016-04-26 17:59:01'),(1180,4,26,199,'2016-04-26 17:59:01','2016-04-26 17:59:01'),(1181,5,3,199,'2016-04-26 17:59:02','2016-04-26 17:59:02'),(1182,6,26,199,'2016-04-26 17:59:02','2016-04-26 17:59:02'),(1183,1,1,200,'2016-04-26 17:59:46','2016-04-26 17:59:46'),(1184,2,1,200,'2016-04-26 17:59:46','2016-04-26 17:59:46'),(1185,3,1,200,'2016-04-26 17:59:46','2016-04-26 17:59:46'),(1186,4,26,200,'2016-04-26 17:59:46','2016-04-26 17:59:46'),(1187,5,3,200,'2016-04-26 17:59:46','2016-04-26 17:59:46'),(1188,6,26,200,'2016-04-26 17:59:46','2016-04-26 17:59:46'),(1189,1,1,201,'2016-04-26 18:00:22','2016-04-26 18:00:22'),(1190,2,1,201,'2016-04-26 18:00:22','2016-04-26 18:00:22'),(1191,3,1,201,'2016-04-26 18:00:22','2016-04-26 18:00:22'),(1192,4,26,201,'2016-04-26 18:00:22','2016-04-26 18:00:22'),(1193,4,24,201,'2016-04-26 18:00:22','2016-04-26 18:00:22'),(1194,1,1,202,'2016-04-27 08:25:17','2016-04-27 08:25:17'),(1195,2,1,202,'2016-04-27 08:25:17','2016-04-27 08:25:17'),(1196,3,1,202,'2016-04-27 08:25:17','2016-04-27 08:25:17'),(1197,11,27,202,'2016-04-27 08:25:18','2016-04-27 08:25:18'),(1198,5,3,202,'2016-04-27 08:25:18','2016-04-27 08:25:18'),(1199,6,27,202,'2016-04-27 08:25:18','2016-04-27 08:25:18'),(1200,1,1,203,'2016-04-27 08:25:27','2016-04-27 08:25:27'),(1201,2,1,203,'2016-04-27 08:25:27','2016-04-27 08:25:27'),(1202,3,1,203,'2016-04-27 08:25:27','2016-04-27 08:25:27'),(1203,4,27,203,'2016-04-27 08:25:27','2016-04-27 08:25:27'),(1204,5,3,203,'2016-04-27 08:25:27','2016-04-27 08:25:27'),(1205,6,27,203,'2016-04-27 08:25:28','2016-04-27 08:25:28'),(1206,1,1,204,'2016-04-27 08:25:33','2016-04-27 08:25:33'),(1207,2,1,204,'2016-04-27 08:25:33','2016-04-27 08:25:33'),(1208,3,1,204,'2016-04-27 08:25:33','2016-04-27 08:25:33'),(1209,4,27,204,'2016-04-27 08:25:33','2016-04-27 08:25:33'),(1210,5,3,204,'2016-04-27 08:25:33','2016-04-27 08:25:33'),(1211,6,27,204,'2016-04-27 08:25:33','2016-04-27 08:25:33'),(1212,1,1,205,'2016-04-27 08:27:39','2016-04-27 08:27:39'),(1213,2,1,205,'2016-04-27 08:27:39','2016-04-27 08:27:39'),(1214,3,1,205,'2016-04-27 08:27:39','2016-04-27 08:27:39'),(1215,4,27,205,'2016-04-27 08:27:39','2016-04-27 08:27:39'),(1216,5,3,205,'2016-04-27 08:27:39','2016-04-27 08:27:39'),(1217,6,27,205,'2016-04-27 08:27:39','2016-04-27 08:27:39'),(1218,1,1,206,'2016-04-27 08:27:46','2016-04-27 08:27:46'),(1219,2,1,206,'2016-04-27 08:27:46','2016-04-27 08:27:46'),(1220,3,1,206,'2016-04-27 08:27:46','2016-04-27 08:27:46'),(1221,4,27,206,'2016-04-27 08:27:46','2016-04-27 08:27:46'),(1222,11,28,206,'2016-04-27 08:27:46','2016-04-27 08:27:46'),(1223,1,1,207,'2016-04-27 08:28:32','2016-04-27 08:28:32'),(1224,2,1,207,'2016-04-27 08:28:32','2016-04-27 08:28:32'),(1225,3,1,207,'2016-04-27 08:28:32','2016-04-27 08:28:32'),(1226,4,27,207,'2016-04-27 08:28:32','2016-04-27 08:28:32'),(1227,11,28,207,'2016-04-27 08:28:33','2016-04-27 08:28:33'),(1228,1,1,208,'2016-04-27 08:28:50','2016-04-27 08:28:50'),(1229,2,1,208,'2016-04-27 08:28:50','2016-04-27 08:28:50'),(1230,3,1,208,'2016-04-27 08:28:50','2016-04-27 08:28:50'),(1231,4,27,208,'2016-04-27 08:28:50','2016-04-27 08:28:50'),(1232,4,28,208,'2016-04-27 08:28:50','2016-04-27 08:28:50'),(1233,1,1,209,'2016-04-27 08:29:12','2016-04-27 08:29:12'),(1234,2,1,209,'2016-04-27 08:29:12','2016-04-27 08:29:12'),(1235,3,1,209,'2016-04-27 08:29:12','2016-04-27 08:29:12'),(1236,4,27,209,'2016-04-27 08:29:12','2016-04-27 08:29:12'),(1237,9,28,209,'2016-04-27 08:29:12','2016-04-27 08:29:12'),(1238,11,28,209,'2016-04-27 08:29:12','2016-04-27 08:29:12'),(1239,1,1,210,'2016-04-27 08:32:19','2016-04-27 08:32:19'),(1240,2,1,210,'2016-04-27 08:32:19','2016-04-27 08:32:19'),(1241,3,1,210,'2016-04-27 08:32:19','2016-04-27 08:32:19'),(1242,4,27,210,'2016-04-27 08:32:19','2016-04-27 08:32:19'),(1243,9,28,210,'2016-04-27 08:32:19','2016-04-27 08:32:19'),(1244,11,28,210,'2016-04-27 08:32:19','2016-04-27 08:32:19'),(1245,1,1,211,'2016-04-27 08:32:47','2016-04-27 08:32:47'),(1246,2,1,211,'2016-04-27 08:32:47','2016-04-27 08:32:47'),(1247,3,1,211,'2016-04-27 08:32:47','2016-04-27 08:32:47'),(1248,4,27,211,'2016-04-27 08:32:47','2016-04-27 08:32:47'),(1249,4,28,211,'2016-04-27 08:32:47','2016-04-27 08:32:47'),(1250,1,1,212,'2016-04-27 08:32:54','2016-04-27 08:32:54'),(1251,2,1,212,'2016-04-27 08:32:54','2016-04-27 08:32:54'),(1252,3,1,212,'2016-04-27 08:32:54','2016-04-27 08:32:54'),(1253,4,27,212,'2016-04-27 08:32:54','2016-04-27 08:32:54'),(1254,9,28,212,'2016-04-27 08:32:54','2016-04-27 08:32:54'),(1255,11,28,212,'2016-04-27 08:32:54','2016-04-27 08:32:54'),(1256,1,1,213,'2016-04-27 08:32:59','2016-04-27 08:32:59'),(1257,2,1,213,'2016-04-27 08:32:59','2016-04-27 08:32:59'),(1258,3,1,213,'2016-04-27 08:32:59','2016-04-27 08:32:59'),(1259,4,27,213,'2016-04-27 08:32:59','2016-04-27 08:32:59'),(1260,11,28,213,'2016-04-27 08:32:59','2016-04-27 08:32:59'),(1261,1,1,214,'2016-04-27 08:33:12','2016-04-27 08:33:12'),(1262,2,1,214,'2016-04-27 08:33:12','2016-04-27 08:33:12'),(1263,3,1,214,'2016-04-27 08:33:12','2016-04-27 08:33:12'),(1264,4,27,214,'2016-04-27 08:33:12','2016-04-27 08:33:12'),(1265,4,28,214,'2016-04-27 08:33:12','2016-04-27 08:33:12'),(1266,1,1,215,'2016-04-27 13:39:24','2016-04-27 13:39:24'),(1267,2,1,215,'2016-04-27 13:39:24','2016-04-27 13:39:24'),(1268,3,1,215,'2016-04-27 13:39:24','2016-04-27 13:39:24'),(1269,11,29,215,'2016-04-27 13:39:24','2016-04-27 13:39:24'),(1270,1,1,216,'2016-04-27 13:41:46','2016-04-27 13:41:46'),(1271,2,1,216,'2016-04-27 13:41:46','2016-04-27 13:41:46'),(1272,3,1,216,'2016-04-27 13:41:46','2016-04-27 13:41:46'),(1273,11,30,216,'2016-04-27 13:41:46','2016-04-27 13:41:46'),(1274,1,1,217,'2016-04-27 15:11:42','2016-04-27 15:11:42'),(1275,2,1,217,'2016-04-27 15:11:42','2016-04-27 15:11:42'),(1276,3,1,217,'2016-04-27 15:11:42','2016-04-27 15:11:42'),(1277,11,31,217,'2016-04-27 15:11:42','2016-04-27 15:11:42'),(1278,5,3,217,'2016-04-27 15:11:43','2016-04-27 15:11:43'),(1279,6,31,217,'2016-04-27 15:11:43','2016-04-27 15:11:43');
/*!40000 ALTER TABLE `tracker_events_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_geoip`
--

DROP TABLE IF EXISTS `tracker_geoip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_geoip` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `country_code` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_code3` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area_code` bigint(20) DEFAULT NULL,
  `dma_code` double DEFAULT NULL,
  `metro_code` double DEFAULT NULL,
  `continent_code` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_geoip_latitude_index` (`latitude`),
  KEY `tracker_geoip_longitude_index` (`longitude`),
  KEY `tracker_geoip_country_code_index` (`country_code`),
  KEY `tracker_geoip_country_code3_index` (`country_code3`),
  KEY `tracker_geoip_country_name_index` (`country_name`),
  KEY `tracker_geoip_city_index` (`city`),
  KEY `tracker_geoip_created_at_index` (`created_at`),
  KEY `tracker_geoip_updated_at_index` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_geoip`
--

LOCK TABLES `tracker_geoip` WRITE;
/*!40000 ALTER TABLE `tracker_geoip` DISABLE KEYS */;
INSERT INTO `tracker_geoip` VALUES (1,35,105,'CN',NULL,'China','AS',NULL,NULL,NULL,NULL,NULL,'AS','2016-04-25 08:36:12','2016-04-25 08:36:12'),(2,39.1422,117.1767,'CN',NULL,'China','AS','Tianjin',NULL,NULL,NULL,NULL,'AS','2016-04-25 08:37:14','2016-04-25 08:37:14'),(3,30.2936,120.1614,'CN',NULL,'China','AS','Hangzhou',NULL,NULL,NULL,NULL,'AS','2016-04-25 08:43:49','2016-04-25 08:43:49'),(4,30.011,120.5715,'CN',NULL,'China','AS','Shaoxing',NULL,NULL,NULL,NULL,'AS','2016-04-25 09:48:51','2016-04-25 09:48:51'),(5,56.85,53.2333,'RU',NULL,'Russia','EU','Izhevsk','426003',NULL,NULL,NULL,'EU','2016-04-25 13:56:05','2016-04-25 13:56:05');
/*!40000 ALTER TABLE `tracker_geoip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_log`
--

DROP TABLE IF EXISTS `tracker_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` bigint(20) unsigned NOT NULL,
  `path_id` bigint(20) unsigned DEFAULT NULL,
  `query_id` bigint(20) unsigned DEFAULT NULL,
  `method` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `route_path_id` bigint(20) unsigned DEFAULT NULL,
  `is_ajax` tinyint(1) NOT NULL,
  `is_secure` tinyint(1) NOT NULL,
  `is_json` tinyint(1) NOT NULL,
  `wants_json` tinyint(1) NOT NULL,
  `error_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `referer_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tracker_log_session_id_index` (`session_id`),
  KEY `tracker_log_path_id_index` (`path_id`),
  KEY `tracker_log_query_id_index` (`query_id`),
  KEY `tracker_log_method_index` (`method`),
  KEY `tracker_log_route_path_id_index` (`route_path_id`),
  KEY `tracker_log_error_id_index` (`error_id`),
  KEY `tracker_log_created_at_index` (`created_at`),
  KEY `tracker_log_updated_at_index` (`updated_at`),
  KEY `tracker_log_referer_id_index` (`referer_id`),
  CONSTRAINT `tracker_log_error_id_foreign` FOREIGN KEY (`error_id`) REFERENCES `tracker_errors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tracker_log_path_id_foreign` FOREIGN KEY (`path_id`) REFERENCES `tracker_paths` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tracker_log_query_id_foreign` FOREIGN KEY (`query_id`) REFERENCES `tracker_queries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tracker_log_route_path_id_foreign` FOREIGN KEY (`route_path_id`) REFERENCES `tracker_route_paths` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tracker_log_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `tracker_sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_log`
--

LOCK TABLES `tracker_log` WRITE;
/*!40000 ALTER TABLE `tracker_log` DISABLE KEYS */;
INSERT INTO `tracker_log` VALUES (1,1,1,NULL,'GET',1,0,0,0,0,NULL,'2016-04-22 13:47:42','2016-04-22 13:47:43',NULL),(2,2,2,NULL,'GET',2,0,0,0,0,NULL,'2016-04-22 13:47:53','2016-04-22 13:47:54',NULL),(3,3,3,NULL,'GET',3,0,0,0,0,NULL,'2016-04-22 13:48:06','2016-04-22 13:48:06',NULL),(4,4,4,NULL,'GET',NULL,0,0,0,0,1,'2016-04-22 13:48:10','2016-04-22 13:48:11',NULL),(5,5,5,NULL,'GET',4,0,0,0,0,NULL,'2016-04-22 13:48:29','2016-04-22 13:48:29',NULL),(6,6,6,NULL,'GET',5,0,0,0,0,NULL,'2016-04-22 13:48:37','2016-04-22 13:48:38',1),(7,7,5,NULL,'GET',4,0,0,0,0,NULL,'2016-04-22 13:48:42','2016-04-22 13:48:42',1),(8,8,3,NULL,'GET',3,0,0,0,0,NULL,'2016-04-22 13:48:52','2016-04-22 13:48:52',NULL),(9,9,3,NULL,'POST',6,0,0,0,0,NULL,'2016-04-22 13:48:58','2016-04-22 13:48:59',2),(10,10,5,NULL,'GET',4,0,0,0,0,NULL,'2016-04-22 13:49:03','2016-04-22 13:49:04',2),(11,11,7,NULL,'GET',7,0,0,0,0,NULL,'2016-04-22 13:53:03','2016-04-22 13:53:03',NULL),(12,12,8,NULL,'GET',8,0,0,0,0,NULL,'2016-04-22 13:53:24','2016-04-22 13:53:25',NULL),(13,13,9,NULL,'GET',9,0,0,0,0,NULL,'2016-04-22 13:53:41','2016-04-22 13:53:41',NULL),(14,14,8,NULL,'GET',8,0,0,0,0,NULL,'2016-04-22 13:53:57','2016-04-22 13:53:57',NULL),(15,15,9,NULL,'GET',9,0,0,0,0,NULL,'2016-04-22 13:58:44','2016-04-22 13:58:44',NULL),(16,16,9,NULL,'GET',9,0,0,0,0,NULL,'2016-04-22 13:58:58','2016-04-22 13:58:58',NULL),(17,17,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-22 15:39:22','2016-04-22 15:39:23',NULL),(18,18,11,NULL,'GET',11,0,0,0,0,NULL,'2016-04-22 15:41:20','2016-04-22 15:41:20',3),(19,19,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-22 15:41:31','2016-04-22 15:41:32',NULL),(20,20,12,NULL,'GET',12,0,0,0,0,NULL,'2016-04-22 15:41:37','2016-04-22 15:41:37',3),(21,21,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-24 09:46:27','2016-04-24 09:46:27',NULL),(22,22,12,NULL,'GET',12,0,0,0,0,NULL,'2016-04-24 09:46:38','2016-04-24 09:46:39',3),(23,23,11,NULL,'PUT',13,0,0,0,0,NULL,'2016-04-24 09:47:21','2016-04-24 09:47:21',4),(24,24,12,NULL,'GET',12,0,0,0,0,NULL,'2016-04-24 09:47:24','2016-04-24 09:47:24',4),(25,25,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-24 09:47:35','2016-04-24 09:47:35',NULL),(26,26,13,NULL,'GET',14,0,0,0,0,NULL,'2016-04-24 10:09:33','2016-04-24 10:09:33',3),(27,27,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-24 10:09:37','2016-04-24 10:09:37',NULL),(28,28,12,NULL,'GET',12,0,0,0,0,NULL,'2016-04-24 10:09:42','2016-04-24 10:09:42',3),(29,29,11,NULL,'PUT',13,0,0,0,0,NULL,'2016-04-24 10:09:51','2016-04-24 10:09:51',4),(30,30,12,NULL,'GET',12,0,0,0,0,NULL,'2016-04-24 10:09:55','2016-04-24 10:09:55',4),(31,31,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-24 10:10:45','2016-04-24 10:10:46',NULL),(32,32,13,NULL,'GET',14,0,0,0,0,NULL,'2016-04-24 10:10:53','2016-04-24 10:10:53',3),(33,33,14,NULL,'PUT',15,0,0,0,0,NULL,'2016-04-24 10:11:44','2016-04-24 10:11:44',5),(34,34,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-24 10:11:47','2016-04-24 10:11:47',5),(35,35,15,NULL,'GET',16,0,0,0,0,NULL,'2016-04-24 10:11:55','2016-04-24 10:11:56',3),(36,36,16,NULL,'PUT',17,0,0,0,0,NULL,'2016-04-24 10:12:05','2016-04-24 10:12:05',6),(37,37,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-24 10:12:08','2016-04-24 10:12:09',6),(38,38,15,NULL,'GET',16,0,0,0,0,NULL,'2016-04-24 10:12:13','2016-04-24 10:12:14',3),(39,39,16,NULL,'PUT',17,0,0,0,0,NULL,'2016-04-24 10:12:23','2016-04-24 10:12:23',6),(40,40,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-24 10:12:26','2016-04-24 10:12:27',6),(41,41,13,NULL,'GET',14,0,0,0,0,NULL,'2016-04-24 10:12:49','2016-04-24 10:12:49',3),(42,42,14,NULL,'PUT',15,0,0,0,0,NULL,'2016-04-24 10:12:58','2016-04-24 10:12:58',5),(43,43,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-24 10:13:02','2016-04-24 10:13:02',5),(44,44,11,NULL,'GET',11,0,0,0,0,NULL,'2016-04-24 10:43:47','2016-04-24 10:43:48',3),(45,45,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-24 10:43:57','2016-04-24 10:43:58',5),(46,46,16,NULL,'GET',18,0,0,0,0,NULL,'2016-04-24 10:44:03','2016-04-24 10:44:03',3),(47,47,17,NULL,'GET',19,0,0,0,0,NULL,'2016-04-24 10:44:45','2016-04-24 10:44:45',NULL),(48,48,17,1,'GET',19,0,0,0,0,NULL,'2016-04-24 10:44:51','2016-04-24 10:44:52',7),(49,49,18,NULL,'GET',NULL,0,0,0,0,1,'2016-04-24 15:04:36','2016-04-24 15:04:37',NULL),(50,50,19,NULL,'GET',20,0,0,0,0,2,'2016-04-24 15:05:10','2016-04-24 15:05:11',NULL),(51,51,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:06:48','2016-04-24 15:06:49',NULL),(52,52,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:08:54','2016-04-24 15:08:55',NULL),(53,53,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:09:37','2016-04-24 15:09:38',NULL),(54,54,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:10:11','2016-04-24 15:10:12',NULL),(55,55,20,NULL,'GET',21,0,0,0,0,NULL,'2016-04-24 15:10:41','2016-04-24 15:10:41',8),(56,56,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:10:48','2016-04-24 15:10:49',NULL),(57,57,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:11:20','2016-04-24 15:11:20',NULL),(58,58,21,NULL,'GET',22,0,0,0,0,2,'2016-04-24 15:11:35','2016-04-24 15:11:36',8),(59,59,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:11:49','2016-04-24 15:11:50',NULL),(60,60,21,NULL,'GET',22,0,0,0,0,2,'2016-04-24 15:13:24','2016-04-24 15:13:25',8),(61,61,21,NULL,'GET',22,0,0,0,0,NULL,'2016-04-24 15:14:08','2016-04-24 15:14:09',8),(62,62,20,NULL,'PUT',23,0,0,0,0,NULL,'2016-04-24 15:14:31','2016-04-24 15:14:31',9),(63,63,21,NULL,'GET',22,0,0,0,0,NULL,'2016-04-24 15:39:16','2016-04-24 15:39:16',8),(64,64,20,NULL,'PUT',23,0,0,0,0,NULL,'2016-04-24 15:39:23','2016-04-24 15:39:23',9),(65,65,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:39:26','2016-04-24 15:39:27',9),(66,66,17,NULL,'GET',19,0,0,0,0,NULL,'2016-04-24 15:39:51','2016-04-24 15:39:51',NULL),(67,67,17,1,'GET',19,0,0,0,0,NULL,'2016-04-24 15:39:57','2016-04-24 15:39:57',7),(68,68,21,NULL,'GET',22,0,0,0,0,NULL,'2016-04-24 15:41:17','2016-04-24 15:41:17',8),(69,69,20,NULL,'PUT',23,0,0,0,0,NULL,'2016-04-24 15:41:42','2016-04-24 15:41:42',9),(70,70,21,NULL,'GET',22,0,0,0,0,NULL,'2016-04-24 15:44:47','2016-04-24 15:44:47',8),(71,71,20,NULL,'PUT',23,0,0,0,0,3,'2016-04-24 15:44:54','2016-04-24 15:44:55',9),(72,72,20,NULL,'PUT',23,0,0,0,0,NULL,'2016-04-24 15:45:32','2016-04-24 15:45:32',9),(73,73,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:45:35','2016-04-24 15:45:36',9),(74,74,22,NULL,'GET',24,0,0,0,0,NULL,'2016-04-24 15:45:47','2016-04-24 15:45:47',8),(75,75,19,NULL,'POST',25,0,0,0,0,NULL,'2016-04-24 15:46:24','2016-04-24 15:46:24',10),(76,76,22,NULL,'GET',24,0,0,0,0,NULL,'2016-04-24 15:46:27','2016-04-24 15:46:27',10),(77,77,17,1,'GET',19,0,0,0,0,NULL,'2016-04-24 15:46:36','2016-04-24 15:46:36',7),(78,78,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:46:53','2016-04-24 15:46:54',NULL),(79,79,23,NULL,'GET',26,0,0,0,0,NULL,'2016-04-24 15:46:59','2016-04-24 15:47:00',8),(80,80,24,NULL,'PUT',27,0,0,0,0,NULL,'2016-04-24 15:48:49','2016-04-24 15:48:49',11),(81,81,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:48:52','2016-04-24 15:48:53',11),(82,82,21,NULL,'GET',22,0,0,0,0,NULL,'2016-04-24 15:48:59','2016-04-24 15:49:00',8),(83,83,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:49:05','2016-04-24 15:49:05',11),(84,84,23,NULL,'GET',26,0,0,0,0,NULL,'2016-04-24 15:49:28','2016-04-24 15:49:29',8),(85,85,24,NULL,'PUT',27,0,0,0,0,NULL,'2016-04-24 15:49:36','2016-04-24 15:49:36',11),(86,86,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:49:40','2016-04-24 15:49:40',11),(87,87,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:49:51','2016-04-24 15:49:51',11),(88,88,21,NULL,'GET',22,0,0,0,0,NULL,'2016-04-24 15:52:56','2016-04-24 15:52:56',8),(89,89,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:53:02','2016-04-24 15:53:02',11),(90,90,24,NULL,'DELETE',28,0,0,0,0,NULL,'2016-04-24 15:53:08','2016-04-24 15:53:08',8),(91,91,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:53:11','2016-04-24 15:53:12',8),(92,92,22,NULL,'GET',24,0,0,0,0,NULL,'2016-04-24 15:53:17','2016-04-24 15:53:18',8),(93,93,19,NULL,'POST',25,0,0,0,0,NULL,'2016-04-24 15:53:32','2016-04-24 15:53:32',10),(94,94,22,NULL,'GET',24,0,0,0,0,NULL,'2016-04-24 15:53:35','2016-04-24 15:53:36',10),(95,95,19,NULL,'POST',25,0,0,0,0,NULL,'2016-04-24 15:55:03','2016-04-24 15:55:03',10),(96,96,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:55:42','2016-04-24 15:55:43',NULL),(97,97,25,NULL,'GET',29,0,0,0,0,NULL,'2016-04-24 15:55:52','2016-04-24 15:55:52',8),(98,98,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:56:00','2016-04-24 15:56:00',NULL),(99,99,25,NULL,'GET',29,0,0,0,0,NULL,'2016-04-24 15:56:09','2016-04-24 15:56:09',8),(100,100,26,NULL,'PUT',30,0,0,0,0,4,'2016-04-24 15:56:19','2016-04-24 15:56:19',12),(101,101,25,NULL,'GET',29,0,0,0,0,NULL,'2016-04-24 15:56:24','2016-04-24 15:56:24',8),(102,102,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:58:17','2016-04-24 15:58:18',NULL),(103,103,22,NULL,'GET',24,0,0,0,0,NULL,'2016-04-24 15:58:25','2016-04-24 15:58:26',8),(104,104,19,NULL,'POST',25,0,0,0,0,NULL,'2016-04-24 15:58:57','2016-04-24 15:58:57',10),(105,105,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 15:59:08','2016-04-24 15:59:08',NULL),(106,106,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-24 16:02:16','2016-04-24 16:02:16',NULL),(107,107,14,NULL,'DELETE',31,0,0,0,0,NULL,'2016-04-24 16:02:45','2016-04-24 16:02:46',3),(108,108,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-24 16:02:49','2016-04-24 16:02:49',3),(109,109,12,NULL,'GET',12,0,0,0,0,NULL,'2016-04-24 16:03:01','2016-04-24 16:03:01',3),(110,110,11,NULL,'PUT',13,0,0,0,0,NULL,'2016-04-24 16:03:11','2016-04-24 16:03:12',4),(111,111,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-24 16:03:15','2016-04-24 16:03:15',4),(112,112,27,NULL,'GET',32,0,0,0,0,NULL,'2016-04-24 16:03:23','2016-04-24 16:03:23',3),(113,113,10,NULL,'POST',33,0,0,0,0,NULL,'2016-04-24 16:03:47','2016-04-24 16:03:47',13),(114,114,27,NULL,'GET',32,0,0,0,0,NULL,'2016-04-24 16:03:50','2016-04-24 16:03:51',13),(115,115,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-24 16:04:26','2016-04-24 16:04:26',NULL),(116,116,27,NULL,'GET',32,0,0,0,0,NULL,'2016-04-24 16:04:34','2016-04-24 16:04:35',3),(117,117,10,NULL,'POST',33,0,0,0,0,NULL,'2016-04-24 16:04:49','2016-04-24 16:04:50',13),(118,118,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-24 16:04:53','2016-04-24 16:04:53',13),(119,119,11,NULL,'GET',11,0,0,0,0,NULL,'2016-04-24 16:05:02','2016-04-24 16:05:03',3),(120,120,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-24 16:27:41','2016-04-24 16:27:42',13),(121,121,11,NULL,'GET',11,0,0,0,0,NULL,'2016-04-24 16:27:58','2016-04-24 16:27:59',3),(122,122,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-24 16:30:19','2016-04-24 16:30:19',NULL),(123,123,5,NULL,'GET',34,0,0,0,0,NULL,'2016-04-25 13:53:20','2016-04-25 13:53:21',NULL),(124,124,5,NULL,'GET',35,0,0,0,0,NULL,'2016-04-25 13:53:44','2016-04-25 13:53:44',NULL),(125,125,28,NULL,'GET',NULL,0,0,0,0,1,'2016-04-25 13:53:48','2016-04-25 13:53:48',14),(126,126,29,NULL,'GET',NULL,0,0,0,0,1,'2016-04-25 13:53:51','2016-04-25 13:53:52',14),(127,127,5,NULL,'GET',35,0,0,0,0,NULL,'2016-04-25 13:54:25','2016-04-25 13:54:25',NULL),(128,128,5,NULL,'GET',35,0,0,0,0,NULL,'2016-04-25 13:54:44','2016-04-25 13:54:44',NULL),(129,129,5,NULL,'GET',35,0,0,0,0,NULL,'2016-04-25 13:55:39','2016-04-25 13:55:39',NULL),(130,130,5,NULL,'GET',35,0,0,0,0,NULL,'2016-04-25 13:58:31','2016-04-25 13:58:31',NULL),(131,131,5,NULL,'GET',35,0,0,0,0,NULL,'2016-04-25 13:59:12','2016-04-25 13:59:13',NULL),(132,132,5,NULL,'GET',35,0,0,0,0,NULL,'2016-04-25 14:00:13','2016-04-25 14:00:13',NULL),(133,133,5,NULL,'GET',35,0,0,0,0,NULL,'2016-04-25 14:01:34','2016-04-25 14:01:35',NULL),(134,134,3,NULL,'GET',3,0,0,0,0,NULL,'2016-04-25 14:01:42','2016-04-25 14:01:43',NULL),(135,135,3,NULL,'POST',6,0,0,0,0,NULL,'2016-04-25 14:01:52','2016-04-25 14:01:53',2),(136,136,5,NULL,'GET',35,0,0,0,0,NULL,'2016-04-25 14:01:56','2016-04-25 14:01:57',2),(137,137,30,NULL,'GET',36,0,0,0,0,NULL,'2016-04-25 14:02:07','2016-04-25 14:02:07',NULL),(138,138,5,NULL,'GET',35,0,0,0,0,NULL,'2016-04-25 14:05:36','2016-04-25 14:05:36',NULL),(139,139,5,NULL,'GET',35,0,0,0,0,NULL,'2016-04-25 14:07:45','2016-04-25 14:07:46',NULL),(140,140,10,NULL,'GET',10,0,0,0,0,NULL,'2016-04-25 08:36:12','2016-04-25 08:36:13',NULL),(141,141,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-25 08:36:26','2016-04-25 08:36:26',NULL),(142,142,20,NULL,'DELETE',37,0,0,0,0,NULL,'2016-04-25 08:36:32','2016-04-25 08:36:32',15),(143,143,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-25 08:36:33','2016-04-25 08:36:33',15),(144,144,31,NULL,'GET',38,0,0,0,0,NULL,'2016-04-25 08:36:36','2016-04-25 08:36:36',15),(145,145,32,NULL,'PUT',39,0,0,0,0,NULL,'2016-04-25 08:36:45','2016-04-25 08:36:45',16),(146,146,19,NULL,'GET',20,0,0,0,0,NULL,'2016-04-25 08:36:46','2016-04-25 08:36:46',16),(147,147,33,NULL,'GET',40,0,0,0,0,NULL,'2016-04-25 08:37:02','2016-04-25 08:37:02',NULL),(148,148,11,NULL,'GET',11,0,0,0,0,NULL,'2016-04-25 08:37:14','2016-04-25 08:37:14',NULL),(149,149,5,NULL,'GET',41,0,0,0,0,NULL,'2016-04-25 08:37:17','2016-04-25 08:37:17',NULL),(150,150,5,NULL,'GET',41,0,0,0,0,NULL,'2016-04-25 08:43:49','2016-04-25 08:43:50',NULL),(151,151,33,NULL,'GET',40,0,0,0,0,NULL,'2016-04-25 09:38:38','2016-04-25 09:38:38',NULL),(152,152,34,NULL,'HEAD',NULL,0,0,0,0,1,'2016-04-25 09:48:51','2016-04-25 09:48:51',NULL),(153,153,5,NULL,'GET',41,0,0,0,0,NULL,'2016-04-25 13:56:05','2016-04-25 13:56:05',NULL),(154,154,30,NULL,'GET',36,0,0,0,0,NULL,'2016-04-26 16:39:21','2016-04-26 16:39:21',NULL),(155,155,35,NULL,'GET',NULL,0,0,0,0,1,'2016-04-26 16:39:35','2016-04-26 16:39:36',NULL),(156,156,36,NULL,'GET',42,0,0,0,0,NULL,'2016-04-26 16:39:59','2016-04-26 16:39:59',NULL),(157,157,37,NULL,'GET',43,0,0,0,0,NULL,'2016-04-26 16:41:25','2016-04-26 16:41:26',NULL),(158,158,37,NULL,'POST',44,0,0,0,0,NULL,'2016-04-26 16:41:34','2016-04-26 16:41:34',17),(159,159,30,NULL,'GET',36,0,0,0,0,NULL,'2016-04-26 16:41:37','2016-04-26 16:41:38',17),(160,160,38,NULL,'GET',45,0,0,0,0,NULL,'2016-04-26 16:41:43','2016-04-26 16:41:43',18),(161,161,30,NULL,'GET',36,0,0,0,0,NULL,'2016-04-26 16:41:46','2016-04-26 16:41:47',18),(162,162,39,NULL,'GET',46,0,0,0,0,NULL,'2016-04-26 16:41:53','2016-04-26 16:41:54',18),(163,163,40,NULL,'GET',47,0,0,0,0,NULL,'2016-04-26 16:41:58','2016-04-26 16:41:58',18),(164,164,40,NULL,'GET',47,0,0,0,0,NULL,'2016-04-26 16:46:43','2016-04-26 16:46:44',18),(165,165,30,NULL,'GET',36,0,0,0,0,NULL,'2016-04-26 16:47:39','2016-04-26 16:47:39',NULL),(166,166,41,NULL,'GET',48,0,0,0,0,NULL,'2016-04-26 16:48:54','2016-04-26 16:48:55',18),(167,167,30,NULL,'GET',36,0,0,0,0,NULL,'2016-04-26 16:48:59','2016-04-26 16:49:00',18),(168,168,38,NULL,'GET',45,0,0,0,0,NULL,'2016-04-26 16:49:25','2016-04-26 16:49:25',18),(169,169,42,NULL,'GET',49,0,0,0,0,NULL,'2016-04-26 16:49:26','2016-04-26 16:49:27',18),(170,170,43,NULL,'GET',50,0,0,0,0,NULL,'2016-04-26 16:49:28','2016-04-26 16:49:29',18),(171,171,30,NULL,'GET',36,0,0,0,0,NULL,'2016-04-26 16:49:32','2016-04-26 16:49:33',18),(172,172,39,NULL,'GET',46,0,0,0,0,NULL,'2016-04-26 16:49:38','2016-04-26 16:49:39',18),(173,173,40,NULL,'GET',47,0,0,0,0,NULL,'2016-04-26 16:49:44','2016-04-26 16:49:45',18),(174,174,30,NULL,'GET',36,0,0,0,0,NULL,'2016-04-26 16:49:58','2016-04-26 16:49:58',NULL),(175,175,41,NULL,'GET',48,0,0,0,0,NULL,'2016-04-26 16:50:09','2016-04-26 16:50:10',18),(176,176,30,NULL,'GET',36,0,0,0,0,NULL,'2016-04-26 16:50:14','2016-04-26 16:50:14',18),(177,177,44,NULL,'GET',51,0,0,0,0,NULL,'2016-04-26 16:50:19','2016-04-26 16:50:20',18),(178,178,30,NULL,'GET',36,0,0,0,0,NULL,'2016-04-26 16:50:24','2016-04-26 16:50:25',18),(179,179,45,NULL,'GET',52,0,0,0,0,NULL,'2016-04-26 16:50:34','2016-04-26 16:50:34',18),(180,180,30,NULL,'GET',36,0,0,0,0,NULL,'2016-04-26 16:50:38','2016-04-26 16:50:39',18),(181,181,46,NULL,'GET',53,0,0,0,0,NULL,'2016-04-26 17:44:11','2016-04-26 17:44:12',NULL),(182,182,46,NULL,'GET',53,0,0,0,0,NULL,'2016-04-26 17:44:42','2016-04-26 17:44:42',NULL),(183,183,17,NULL,'GET',19,0,0,0,0,NULL,'2016-04-26 17:48:50','2016-04-26 17:48:51',NULL),(184,184,17,1,'GET',19,0,0,0,0,NULL,'2016-04-26 17:48:56','2016-04-26 17:48:57',7),(185,185,17,2,'GET',19,0,0,0,0,NULL,'2016-04-26 17:50:42','2016-04-26 17:50:42',19),(186,186,17,NULL,'GET',19,0,0,0,0,NULL,'2016-04-26 17:50:45','2016-04-26 17:50:45',19),(187,187,17,3,'GET',19,0,0,0,0,NULL,'2016-04-26 17:50:54','2016-04-26 17:50:55',7),(188,188,17,NULL,'GET',19,0,0,0,0,NULL,'2016-04-26 17:50:58','2016-04-26 17:50:58',7),(189,189,17,NULL,'GET',19,0,0,0,0,NULL,'2016-04-26 17:51:15','2016-04-26 17:51:15',7),(190,190,17,NULL,'GET',19,0,0,0,0,NULL,'2016-04-26 17:54:12','2016-04-26 17:54:12',7),(191,191,17,2,'GET',19,0,0,0,0,NULL,'2016-04-26 17:57:11','2016-04-26 17:57:12',7),(192,192,17,NULL,'GET',19,0,0,0,0,NULL,'2016-04-26 17:57:15','2016-04-26 17:57:15',7),(193,193,17,3,'GET',19,0,0,0,0,NULL,'2016-04-26 17:57:20','2016-04-26 17:57:21',7),(194,194,17,NULL,'GET',19,0,0,0,0,NULL,'2016-04-26 17:57:24','2016-04-26 17:57:24',7),(195,195,17,NULL,'GET',19,0,0,0,0,NULL,'2016-04-26 17:57:38','2016-04-26 17:57:38',7),(196,196,17,1,'GET',19,0,0,0,0,NULL,'2016-04-26 17:57:44','2016-04-26 17:57:44',7),(197,197,46,NULL,'GET',53,0,0,0,0,NULL,'2016-04-26 17:57:56','2016-04-26 17:57:56',NULL),(198,198,17,1,'GET',19,0,0,0,0,NULL,'2016-04-26 17:58:23','2016-04-26 17:58:23',7),(199,199,17,1,'GET',19,0,0,0,0,NULL,'2016-04-26 17:59:01','2016-04-26 17:59:01',7),(200,200,17,1,'GET',19,0,0,0,0,NULL,'2016-04-26 17:59:46','2016-04-26 17:59:46',7),(201,201,46,NULL,'GET',53,0,0,0,0,NULL,'2016-04-26 18:00:22','2016-04-26 18:00:22',NULL),(202,202,5,NULL,'GET',35,0,0,0,0,NULL,'2016-04-27 08:25:17','2016-04-27 08:25:18',NULL),(203,203,17,NULL,'GET',19,0,0,0,0,NULL,'2016-04-27 08:25:27','2016-04-27 08:25:27',NULL),(204,204,17,1,'GET',19,0,0,0,0,NULL,'2016-04-27 08:25:33','2016-04-27 08:25:33',7),(205,205,47,NULL,'GET',NULL,0,0,0,0,1,'2016-04-27 08:27:39','2016-04-27 08:27:39',NULL),(206,206,46,NULL,'GET',53,0,0,0,0,NULL,'2016-04-27 08:27:46','2016-04-27 08:27:46',NULL),(207,207,46,NULL,'GET',53,0,0,0,0,NULL,'2016-04-27 08:28:32','2016-04-27 08:28:32',NULL),(208,208,46,NULL,'GET',53,0,0,0,0,NULL,'2016-04-27 08:28:50','2016-04-27 08:28:50',NULL),(209,209,48,NULL,'GET',54,0,0,0,0,NULL,'2016-04-27 08:29:11','2016-04-27 08:29:12',NULL),(210,210,48,NULL,'GET',54,0,0,0,0,NULL,'2016-04-27 08:32:19','2016-04-27 08:32:19',NULL),(211,211,46,NULL,'GET',53,0,0,0,0,NULL,'2016-04-27 08:32:47','2016-04-27 08:32:47',NULL),(212,212,48,NULL,'GET',54,0,0,0,0,NULL,'2016-04-27 08:32:54','2016-04-27 08:32:54',NULL),(213,213,46,NULL,'GET',53,0,0,0,0,NULL,'2016-04-27 08:32:59','2016-04-27 08:32:59',NULL),(214,214,46,NULL,'GET',53,0,0,0,0,NULL,'2016-04-27 08:33:12','2016-04-27 08:33:12',NULL),(215,215,46,NULL,'GET',53,0,0,0,0,NULL,'2016-04-27 13:39:24','2016-04-27 13:39:24',NULL),(216,216,46,NULL,'GET',53,0,0,0,0,NULL,'2016-04-27 13:41:46','2016-04-27 13:41:47',NULL),(217,217,47,NULL,'GET',NULL,0,0,0,0,1,'2016-04-27 15:11:42','2016-04-27 15:11:43',NULL);
/*!40000 ALTER TABLE `tracker_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_paths`
--

DROP TABLE IF EXISTS `tracker_paths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_paths` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_paths_path_index` (`path`),
  KEY `tracker_paths_created_at_index` (`created_at`),
  KEY `tracker_paths_updated_at_index` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_paths`
--

LOCK TABLES `tracker_paths` WRITE;
/*!40000 ALTER TABLE `tracker_paths` DISABLE KEYS */;
INSERT INTO `tracker_paths` VALUES (1,'test/account','2016-04-22 13:47:42','2016-04-22 13:47:42'),(2,'test/role_perms/admin','2016-04-22 13:47:53','2016-04-22 13:47:53'),(3,'login/email','2016-04-22 13:48:06','2016-04-22 13:48:06'),(4,'home','2016-04-22 13:48:10','2016-04-22 13:48:10'),(5,'/','2016-04-22 13:48:29','2016-04-22 13:48:29'),(6,'logout','2016-04-22 13:48:37','2016-04-22 13:48:37'),(7,'test/bind','2016-04-22 13:53:03','2016-04-22 13:53:03'),(8,'test/blade','2016-04-22 13:53:24','2016-04-22 13:53:24'),(9,'test/can','2016-04-22 13:53:41','2016-04-22 13:53:41'),(10,'role','2016-04-22 15:39:22','2016-04-22 15:39:22'),(11,'role/1','2016-04-22 15:41:20','2016-04-22 15:41:20'),(12,'role/1/edit','2016-04-22 15:41:37','2016-04-22 15:41:37'),(13,'role/2/edit','2016-04-24 10:09:33','2016-04-24 10:09:33'),(14,'role/2','2016-04-24 10:11:43','2016-04-24 10:11:43'),(15,'role/3/edit','2016-04-24 10:11:55','2016-04-24 10:11:55'),(16,'role/3','2016-04-24 10:12:05','2016-04-24 10:12:05'),(17,'tool/logs','2016-04-24 10:44:45','2016-04-24 10:44:45'),(18,'permisson','2016-04-24 15:04:36','2016-04-24 15:04:36'),(19,'permission','2016-04-24 15:05:10','2016-04-24 15:05:10'),(20,'permission/1','2016-04-24 15:10:41','2016-04-24 15:10:41'),(21,'permission/1/edit','2016-04-24 15:11:35','2016-04-24 15:11:35'),(22,'permission/create','2016-04-24 15:45:47','2016-04-24 15:45:47'),(23,'permission/4/edit','2016-04-24 15:46:59','2016-04-24 15:46:59'),(24,'permission/4','2016-04-24 15:48:49','2016-04-24 15:48:49'),(25,'permission/6/edit','2016-04-24 15:55:52','2016-04-24 15:55:52'),(26,'permission/6','2016-04-24 15:56:19','2016-04-24 15:56:19'),(27,'role/create','2016-04-24 16:03:23','2016-04-24 16:03:23'),(28,'fonts/fontawesome/fontawesome.woff','2016-04-25 13:53:48','2016-04-25 13:53:48'),(29,'fonts/fontawesome/fontawesome.ttf','2016-04-25 13:53:51','2016-04-25 13:53:51'),(30,'category','2016-04-25 14:02:07','2016-04-25 14:02:07'),(31,'permission/2/edit','2016-04-25 08:36:36','2016-04-25 08:36:36'),(32,'permission/2','2016-04-25 08:36:45','2016-04-25 08:36:45'),(33,'test/code','2016-04-25 08:37:02','2016-04-25 08:37:02'),(34,'editors/fckeditor/editor','2016-04-25 09:48:51','2016-04-25 09:48:51'),(35,'test/items','2016-04-26 16:39:35','2016-04-26 16:39:35'),(36,'test/list','2016-04-26 16:39:59','2016-04-26 16:39:59'),(37,'address/bind','2016-04-26 16:41:25','2016-04-26 16:41:25'),(38,'category/bind/5','2016-04-26 16:41:43','2016-04-26 16:41:43'),(39,'consult/build','2016-04-26 16:41:53','2016-04-26 16:41:53'),(40,'test/dc','2016-04-26 16:41:58','2016-04-26 16:41:58'),(41,'category/unbind/5','2016-04-26 16:48:54','2016-04-26 16:48:54'),(42,'category/bind/6','2016-04-26 16:49:26','2016-04-26 16:49:26'),(43,'category/bind/7','2016-04-26 16:49:28','2016-04-26 16:49:28'),(44,'category/unbind/6','2016-04-26 16:50:19','2016-04-26 16:50:19'),(45,'category/unbind/7','2016-04-26 16:50:34','2016-04-26 16:50:34'),(46,'test/token','2016-04-26 17:44:11','2016-04-26 17:44:11'),(47,'test/cache','2016-04-27 08:27:39','2016-04-27 08:27:39'),(48,'test/d_token','2016-04-27 08:29:11','2016-04-27 08:29:11');
/*!40000 ALTER TABLE `tracker_paths` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_queries`
--

DROP TABLE IF EXISTS `tracker_queries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_queries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `query` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_queries_query_index` (`query`),
  KEY `tracker_queries_created_at_index` (`created_at`),
  KEY `tracker_queries_updated_at_index` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_queries`
--

LOCK TABLES `tracker_queries` WRITE;
/*!40000 ALTER TABLE `tracker_queries` DISABLE KEYS */;
INSERT INTO `tracker_queries` VALUES (1,'l=bGFyYXZlbC5sb2c=','2016-04-24 10:44:51','2016-04-24 10:44:51'),(2,'del=bGFyYXZlbC5sb2c=','2016-04-26 17:50:42','2016-04-26 17:50:42'),(3,'del=d2VjaGF0LmxvZw==','2016-04-26 17:50:54','2016-04-26 17:50:54');
/*!40000 ALTER TABLE `tracker_queries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_query_arguments`
--

DROP TABLE IF EXISTS `tracker_query_arguments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_query_arguments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `query_id` bigint(20) unsigned NOT NULL,
  `argument` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_query_arguments_query_id_index` (`query_id`),
  KEY `tracker_query_arguments_argument_index` (`argument`),
  KEY `tracker_query_arguments_value_index` (`value`),
  KEY `tracker_query_arguments_created_at_index` (`created_at`),
  KEY `tracker_query_arguments_updated_at_index` (`updated_at`),
  CONSTRAINT `tracker_query_arguments_query_id_foreign` FOREIGN KEY (`query_id`) REFERENCES `tracker_queries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_query_arguments`
--

LOCK TABLES `tracker_query_arguments` WRITE;
/*!40000 ALTER TABLE `tracker_query_arguments` DISABLE KEYS */;
INSERT INTO `tracker_query_arguments` VALUES (1,1,'l','bGFyYXZlbC5sb2c=','2016-04-24 10:44:51','2016-04-24 10:44:51'),(2,2,'del','bGFyYXZlbC5sb2c=','2016-04-26 17:50:42','2016-04-26 17:50:42'),(3,3,'del','d2VjaGF0LmxvZw==','2016-04-26 17:50:54','2016-04-26 17:50:54');
/*!40000 ALTER TABLE `tracker_query_arguments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_referers`
--

DROP TABLE IF EXISTS `tracker_referers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_referers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `domain_id` bigint(20) unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `host` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `medium` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `search_terms_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tracker_referers_domain_id_index` (`domain_id`),
  KEY `tracker_referers_url_index` (`url`),
  KEY `tracker_referers_created_at_index` (`created_at`),
  KEY `tracker_referers_updated_at_index` (`updated_at`),
  KEY `tracker_referers_medium_index` (`medium`),
  KEY `tracker_referers_source_index` (`source`),
  KEY `tracker_referers_search_terms_hash_index` (`search_terms_hash`),
  CONSTRAINT `tracker_referers_domain_id_foreign` FOREIGN KEY (`domain_id`) REFERENCES `tracker_domains` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_referers`
--

LOCK TABLES `tracker_referers` WRITE;
/*!40000 ALTER TABLE `tracker_referers` DISABLE KEYS */;
INSERT INTO `tracker_referers` VALUES (1,1,'http://192.168.33.160/','192.168.33.160','2016-04-22 13:48:37','2016-04-22 13:48:37',NULL,NULL,NULL),(2,1,'http://192.168.33.160/login/email','192.168.33.160','2016-04-22 13:48:58','2016-04-22 13:48:58',NULL,NULL,NULL),(3,1,'http://192.168.33.160/role','192.168.33.160','2016-04-22 15:41:20','2016-04-22 15:41:20',NULL,NULL,NULL),(4,1,'http://192.168.33.160/role/1/edit','192.168.33.160','2016-04-24 09:47:20','2016-04-24 09:47:20',NULL,NULL,NULL),(5,1,'http://192.168.33.160/role/2/edit','192.168.33.160','2016-04-24 10:11:43','2016-04-24 10:11:43',NULL,NULL,NULL),(6,1,'http://192.168.33.160/role/3/edit','192.168.33.160','2016-04-24 10:12:05','2016-04-24 10:12:05',NULL,NULL,NULL),(7,1,'http://192.168.33.160/tool/logs','192.168.33.160','2016-04-24 10:44:51','2016-04-24 10:44:51',NULL,NULL,NULL),(8,1,'http://192.168.33.160/permission','192.168.33.160','2016-04-24 15:10:41','2016-04-24 15:10:41',NULL,NULL,NULL),(9,1,'http://192.168.33.160/permission/1/edit','192.168.33.160','2016-04-24 15:14:31','2016-04-24 15:14:31',NULL,NULL,NULL),(10,1,'http://192.168.33.160/permission/create','192.168.33.160','2016-04-24 15:46:24','2016-04-24 15:46:24',NULL,NULL,NULL),(11,1,'http://192.168.33.160/permission/4/edit','192.168.33.160','2016-04-24 15:48:49','2016-04-24 15:48:49',NULL,NULL,NULL),(12,1,'http://192.168.33.160/permission/6/edit','192.168.33.160','2016-04-24 15:56:19','2016-04-24 15:56:19',NULL,NULL,NULL),(13,1,'http://192.168.33.160/role/create','192.168.33.160','2016-04-24 16:03:47','2016-04-24 16:03:47',NULL,NULL,NULL),(14,1,'http://192.168.33.160/css/component.css','192.168.33.160','2016-04-25 13:53:48','2016-04-25 13:53:48',NULL,NULL,NULL),(15,2,'http://exingdong.com/permission','exingdong.com','2016-04-25 08:36:32','2016-04-25 08:36:32',NULL,NULL,NULL),(16,2,'http://exingdong.com/permission/2/edit','exingdong.com','2016-04-25 08:36:45','2016-04-25 08:36:45',NULL,NULL,NULL),(17,1,'http://192.168.33.160/address/bind','192.168.33.160','2016-04-26 16:41:34','2016-04-26 16:41:34',NULL,NULL,NULL),(18,1,'http://192.168.33.160/category','192.168.33.160','2016-04-26 16:41:43','2016-04-26 16:41:43',NULL,NULL,NULL),(19,1,'http://192.168.33.160/tool/logs?l=bGFyYXZlbC5sb2c=','192.168.33.160','2016-04-26 17:50:42','2016-04-26 17:50:42',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tracker_referers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_referers_search_terms`
--

DROP TABLE IF EXISTS `tracker_referers_search_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_referers_search_terms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `referer_id` bigint(20) unsigned NOT NULL,
  `search_term` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_referers_search_terms_referer_id_index` (`referer_id`),
  KEY `tracker_referers_search_terms_search_term_index` (`search_term`),
  KEY `tracker_referers_search_terms_created_at_index` (`created_at`),
  KEY `tracker_referers_search_terms_updated_at_index` (`updated_at`),
  CONSTRAINT `tracker_referers_referer_id_fk` FOREIGN KEY (`referer_id`) REFERENCES `tracker_referers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_referers_search_terms`
--

LOCK TABLES `tracker_referers_search_terms` WRITE;
/*!40000 ALTER TABLE `tracker_referers_search_terms` DISABLE KEYS */;
/*!40000 ALTER TABLE `tracker_referers_search_terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_route_path_parameters`
--

DROP TABLE IF EXISTS `tracker_route_path_parameters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_route_path_parameters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `route_path_id` bigint(20) unsigned NOT NULL,
  `parameter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_route_path_parameters_route_path_id_index` (`route_path_id`),
  KEY `tracker_route_path_parameters_parameter_index` (`parameter`),
  KEY `tracker_route_path_parameters_value_index` (`value`),
  KEY `tracker_route_path_parameters_created_at_index` (`created_at`),
  KEY `tracker_route_path_parameters_updated_at_index` (`updated_at`),
  CONSTRAINT `tracker_route_path_parameters_route_path_id_foreign` FOREIGN KEY (`route_path_id`) REFERENCES `tracker_route_paths` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_route_path_parameters`
--

LOCK TABLES `tracker_route_path_parameters` WRITE;
/*!40000 ALTER TABLE `tracker_route_path_parameters` DISABLE KEYS */;
INSERT INTO `tracker_route_path_parameters` VALUES (1,2,'name','admin','2016-04-22 13:47:54','2016-04-22 13:47:54'),(2,11,'role','1','2016-04-22 15:41:20','2016-04-22 15:41:20'),(3,12,'role','1','2016-04-22 15:41:37','2016-04-22 15:41:37'),(4,13,'role','1','2016-04-24 09:47:21','2016-04-24 09:47:21'),(5,14,'role','2','2016-04-24 10:09:33','2016-04-24 10:09:33'),(6,15,'role','2','2016-04-24 10:11:44','2016-04-24 10:11:44'),(7,16,'role','3','2016-04-24 10:11:56','2016-04-24 10:11:56'),(8,17,'role','3','2016-04-24 10:12:05','2016-04-24 10:12:05'),(9,18,'role','3','2016-04-24 10:44:03','2016-04-24 10:44:03'),(10,21,'permission','1','2016-04-24 15:10:41','2016-04-24 15:10:41'),(11,22,'permission','1','2016-04-24 15:11:35','2016-04-24 15:11:35'),(12,23,'permission','1','2016-04-24 15:14:31','2016-04-24 15:14:31'),(13,26,'permission','4','2016-04-24 15:47:00','2016-04-24 15:47:00'),(14,27,'permission','4','2016-04-24 15:48:49','2016-04-24 15:48:49'),(15,28,'permission','4','2016-04-24 15:53:08','2016-04-24 15:53:08'),(16,29,'permission','6','2016-04-24 15:55:52','2016-04-24 15:55:52'),(17,30,'permission','6','2016-04-24 15:56:19','2016-04-24 15:56:19'),(18,31,'role','2','2016-04-24 16:02:46','2016-04-24 16:02:46'),(19,37,'permission','1','2016-04-25 08:36:32','2016-04-25 08:36:32'),(20,38,'permission','2','2016-04-25 08:36:36','2016-04-25 08:36:36'),(21,39,'permission','2','2016-04-25 08:36:45','2016-04-25 08:36:45'),(22,45,'id','5','2016-04-26 16:41:43','2016-04-26 16:41:43'),(23,48,'id','5','2016-04-26 16:48:55','2016-04-26 16:48:55'),(24,49,'id','6','2016-04-26 16:49:27','2016-04-26 16:49:27'),(25,50,'id','7','2016-04-26 16:49:29','2016-04-26 16:49:29'),(26,51,'id','6','2016-04-26 16:50:20','2016-04-26 16:50:20'),(27,52,'id','7','2016-04-26 16:50:34','2016-04-26 16:50:34');
/*!40000 ALTER TABLE `tracker_route_path_parameters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_route_paths`
--

DROP TABLE IF EXISTS `tracker_route_paths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_route_paths` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `route_id` bigint(20) unsigned NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_route_paths_route_id_index` (`route_id`),
  KEY `tracker_route_paths_path_index` (`path`),
  KEY `tracker_route_paths_created_at_index` (`created_at`),
  KEY `tracker_route_paths_updated_at_index` (`updated_at`),
  CONSTRAINT `tracker_route_paths_route_id_foreign` FOREIGN KEY (`route_id`) REFERENCES `tracker_routes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_route_paths`
--

LOCK TABLES `tracker_route_paths` WRITE;
/*!40000 ALTER TABLE `tracker_route_paths` DISABLE KEYS */;
INSERT INTO `tracker_route_paths` VALUES (1,1,'test/account','2016-04-22 13:47:43','2016-04-22 13:47:43'),(2,2,'test/role_perms/admin','2016-04-22 13:47:54','2016-04-22 13:47:54'),(3,3,'login/email','2016-04-22 13:48:06','2016-04-22 13:48:06'),(4,4,'/','2016-04-22 13:48:29','2016-04-22 13:48:29'),(5,5,'logout','2016-04-22 13:48:38','2016-04-22 13:48:38'),(6,6,'login/email','2016-04-22 13:48:59','2016-04-22 13:48:59'),(7,7,'test/bind','2016-04-22 13:53:03','2016-04-22 13:53:03'),(8,8,'test/blade','2016-04-22 13:53:25','2016-04-22 13:53:25'),(9,9,'test/can','2016-04-22 13:53:41','2016-04-22 13:53:41'),(10,10,'role','2016-04-22 15:39:23','2016-04-22 15:39:23'),(11,11,'role/1','2016-04-22 15:41:20','2016-04-22 15:41:20'),(12,12,'role/1/edit','2016-04-22 15:41:37','2016-04-22 15:41:37'),(13,13,'role/1','2016-04-24 09:47:21','2016-04-24 09:47:21'),(14,12,'role/2/edit','2016-04-24 10:09:33','2016-04-24 10:09:33'),(15,13,'role/2','2016-04-24 10:11:44','2016-04-24 10:11:44'),(16,12,'role/3/edit','2016-04-24 10:11:56','2016-04-24 10:11:56'),(17,13,'role/3','2016-04-24 10:12:05','2016-04-24 10:12:05'),(18,11,'role/3','2016-04-24 10:44:03','2016-04-24 10:44:03'),(19,14,'tool/logs','2016-04-24 10:44:45','2016-04-24 10:44:45'),(20,15,'permission','2016-04-24 15:05:11','2016-04-24 15:05:11'),(21,16,'permission/1','2016-04-24 15:10:41','2016-04-24 15:10:41'),(22,17,'permission/1/edit','2016-04-24 15:11:35','2016-04-24 15:11:35'),(23,18,'permission/1','2016-04-24 15:14:31','2016-04-24 15:14:31'),(24,19,'permission/create','2016-04-24 15:45:47','2016-04-24 15:45:47'),(25,20,'permission','2016-04-24 15:46:24','2016-04-24 15:46:24'),(26,17,'permission/4/edit','2016-04-24 15:47:00','2016-04-24 15:47:00'),(27,18,'permission/4','2016-04-24 15:48:49','2016-04-24 15:48:49'),(28,21,'permission/4','2016-04-24 15:53:08','2016-04-24 15:53:08'),(29,17,'permission/6/edit','2016-04-24 15:55:52','2016-04-24 15:55:52'),(30,18,'permission/6','2016-04-24 15:56:19','2016-04-24 15:56:19'),(31,22,'role/2','2016-04-24 16:02:46','2016-04-24 16:02:46'),(32,23,'role/create','2016-04-24 16:03:23','2016-04-24 16:03:23'),(33,24,'role','2016-04-24 16:03:47','2016-04-24 16:03:47'),(34,25,'/','2016-04-25 13:53:21','2016-04-25 13:53:21'),(35,26,'/','2016-04-25 13:53:44','2016-04-25 13:53:44'),(36,27,'category','2016-04-25 14:02:07','2016-04-25 14:02:07'),(37,21,'permission/1','2016-04-25 08:36:32','2016-04-25 08:36:32'),(38,17,'permission/2/edit','2016-04-25 08:36:36','2016-04-25 08:36:36'),(39,18,'permission/2','2016-04-25 08:36:45','2016-04-25 08:36:45'),(40,28,'test/code','2016-04-25 08:37:02','2016-04-25 08:37:02'),(41,29,'/','2016-04-25 08:37:17','2016-04-25 08:37:17'),(42,30,'test/list','2016-04-26 16:39:59','2016-04-26 16:39:59'),(43,31,'address/bind','2016-04-26 16:41:26','2016-04-26 16:41:26'),(44,32,'address/bind','2016-04-26 16:41:34','2016-04-26 16:41:34'),(45,33,'category/bind/5','2016-04-26 16:41:43','2016-04-26 16:41:43'),(46,34,'consult/build','2016-04-26 16:41:54','2016-04-26 16:41:54'),(47,35,'test/dc','2016-04-26 16:41:58','2016-04-26 16:41:58'),(48,36,'category/unbind/5','2016-04-26 16:48:55','2016-04-26 16:48:55'),(49,33,'category/bind/6','2016-04-26 16:49:27','2016-04-26 16:49:27'),(50,33,'category/bind/7','2016-04-26 16:49:29','2016-04-26 16:49:29'),(51,36,'category/unbind/6','2016-04-26 16:50:20','2016-04-26 16:50:20'),(52,36,'category/unbind/7','2016-04-26 16:50:34','2016-04-26 16:50:34'),(53,37,'test/token','2016-04-26 17:44:12','2016-04-26 17:44:12'),(54,38,'test/d_token','2016-04-27 08:29:12','2016-04-27 08:29:12');
/*!40000 ALTER TABLE `tracker_route_paths` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_routes`
--

DROP TABLE IF EXISTS `tracker_routes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_routes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_routes_name_index` (`name`),
  KEY `tracker_routes_action_index` (`action`),
  KEY `tracker_routes_created_at_index` (`created_at`),
  KEY `tracker_routes_updated_at_index` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_routes`
--

LOCK TABLES `tracker_routes` WRITE;
/*!40000 ALTER TABLE `tracker_routes` DISABLE KEYS */;
INSERT INTO `tracker_routes` VALUES (1,'','App\\Http\\Controllers\\TestController@accountSystem','2016-04-22 13:47:43','2016-04-22 13:47:43'),(2,'','App\\Http\\Controllers\\TestController@rolePerms','2016-04-22 13:47:54','2016-04-22 13:47:54'),(3,'','App\\Http\\Controllers\\Auth\\AuthController@getEmailLogin','2016-04-22 13:48:06','2016-04-22 13:48:06'),(4,'','closure','2016-04-22 13:48:29','2016-04-22 13:48:29'),(5,'','App\\Http\\Controllers\\Auth\\AuthController@getLogout','2016-04-22 13:48:38','2016-04-22 13:48:38'),(6,'','App\\Http\\Controllers\\Auth\\AuthController@postEmailLogin','2016-04-22 13:48:59','2016-04-22 13:48:59'),(7,'','App\\Http\\Controllers\\TestController@createPermission','2016-04-22 13:53:03','2016-04-22 13:53:03'),(8,'','App\\Http\\Controllers\\TestController@blade','2016-04-22 13:53:25','2016-04-22 13:53:25'),(9,'','App\\Http\\Controllers\\TestController@cando','2016-04-22 13:53:41','2016-04-22 13:53:41'),(10,'role.index','App\\Http\\Controllers\\RoleController@index','2016-04-22 15:39:23','2016-04-22 15:39:23'),(11,'role.show','App\\Http\\Controllers\\RoleController@show','2016-04-22 15:41:20','2016-04-22 15:41:20'),(12,'role.edit','App\\Http\\Controllers\\RoleController@edit','2016-04-22 15:41:37','2016-04-22 15:41:37'),(13,'role.update','App\\Http\\Controllers\\RoleController@update','2016-04-24 09:47:21','2016-04-24 09:47:21'),(14,'','\\Rap2hpoutre\\LaravelLogViewer\\LogViewerController@index','2016-04-24 10:44:45','2016-04-24 10:44:45'),(15,'permission.index','App\\Http\\Controllers\\PermissionController@index','2016-04-24 15:05:11','2016-04-24 15:05:11'),(16,'permission.show','App\\Http\\Controllers\\PermissionController@show','2016-04-24 15:10:41','2016-04-24 15:10:41'),(17,'permission.edit','App\\Http\\Controllers\\PermissionController@edit','2016-04-24 15:11:35','2016-04-24 15:11:35'),(18,'permission.update','App\\Http\\Controllers\\PermissionController@update','2016-04-24 15:14:31','2016-04-24 15:14:31'),(19,'permission.create','App\\Http\\Controllers\\PermissionController@create','2016-04-24 15:45:47','2016-04-24 15:45:47'),(20,'permission.store','App\\Http\\Controllers\\PermissionController@store','2016-04-24 15:46:24','2016-04-24 15:46:24'),(21,'permission.destroy','App\\Http\\Controllers\\PermissionController@destroy','2016-04-24 15:53:08','2016-04-24 15:53:08'),(22,'role.destroy','App\\Http\\Controllers\\RoleController@destroy','2016-04-24 16:02:46','2016-04-24 16:02:46'),(23,'role.create','App\\Http\\Controllers\\RoleController@create','2016-04-24 16:03:23','2016-04-24 16:03:23'),(24,'role.store','App\\Http\\Controllers\\RoleController@store','2016-04-24 16:03:47','2016-04-24 16:03:47'),(25,'','App\\Http\\Controllers\\WebController@list','2016-04-25 13:53:21','2016-04-25 13:53:21'),(26,'','App\\Http\\Controllers\\WebController@index','2016-04-25 13:53:44','2016-04-25 13:53:44'),(27,'','App\\Http\\Controllers\\LawyerController@getCategories','2016-04-25 14:02:07','2016-04-25 14:02:07'),(28,'','App\\Http\\Controllers\\TestController@scanQrCode','2016-04-25 08:37:02','2016-04-25 08:37:02'),(29,'','App\\Http\\Controllers\\WebController@welcome','2016-04-25 08:37:17','2016-04-25 08:37:17'),(30,'','App\\Http\\Controllers\\TestController@lists','2016-04-26 16:39:59','2016-04-26 16:39:59'),(31,'','App\\Http\\Controllers\\LocationController@getBindLocation','2016-04-26 16:41:26','2016-04-26 16:41:26'),(32,'','App\\Http\\Controllers\\LocationController@postBindLocation','2016-04-26 16:41:34','2016-04-26 16:41:34'),(33,'','App\\Http\\Controllers\\LawyerController@bindCategory','2016-04-26 16:41:43','2016-04-26 16:41:43'),(34,'','App\\Http\\Controllers\\ConsultController@building','2016-04-26 16:41:54','2016-04-26 16:41:54'),(35,'','App\\Http\\Controllers\\TestController@drawCategory','2016-04-26 16:41:58','2016-04-26 16:41:58'),(36,'','App\\Http\\Controllers\\LawyerController@unbindCategory','2016-04-26 16:48:55','2016-04-26 16:48:55'),(37,'','App\\Http\\Controllers\\TestController@getToken','2016-04-26 17:44:12','2016-04-26 17:44:12'),(38,'','App\\Http\\Controllers\\TestController@eraseCache','2016-04-27 08:29:12','2016-04-27 08:29:12');
/*!40000 ALTER TABLE `tracker_routes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_sessions`
--

DROP TABLE IF EXISTS `tracker_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_sessions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `device_id` bigint(20) unsigned DEFAULT NULL,
  `agent_id` bigint(20) unsigned DEFAULT NULL,
  `client_ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `referer_id` bigint(20) unsigned DEFAULT NULL,
  `cookie_id` bigint(20) unsigned DEFAULT NULL,
  `geoip_id` bigint(20) unsigned DEFAULT NULL,
  `is_robot` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tracker_sessions_uuid_unique` (`uuid`),
  KEY `tracker_sessions_user_id_index` (`user_id`),
  KEY `tracker_sessions_device_id_index` (`device_id`),
  KEY `tracker_sessions_agent_id_index` (`agent_id`),
  KEY `tracker_sessions_client_ip_index` (`client_ip`),
  KEY `tracker_sessions_referer_id_index` (`referer_id`),
  KEY `tracker_sessions_cookie_id_index` (`cookie_id`),
  KEY `tracker_sessions_geoip_id_index` (`geoip_id`),
  KEY `tracker_sessions_created_at_index` (`created_at`),
  KEY `tracker_sessions_updated_at_index` (`updated_at`),
  CONSTRAINT `tracker_sessions_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `tracker_agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tracker_sessions_cookie_id_foreign` FOREIGN KEY (`cookie_id`) REFERENCES `tracker_cookies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tracker_sessions_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `tracker_devices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tracker_sessions_geoip_id_foreign` FOREIGN KEY (`geoip_id`) REFERENCES `tracker_geoip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tracker_sessions_referer_id_foreign` FOREIGN KEY (`referer_id`) REFERENCES `tracker_referers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_sessions`
--

LOCK TABLES `tracker_sessions` WRITE;
/*!40000 ALTER TABLE `tracker_sessions` DISABLE KEYS */;
INSERT INTO `tracker_sessions` VALUES (1,'406bebd3-0c20-4980-b6c3-cf750587895d',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-22 13:47:42','2016-04-22 13:47:42'),(2,'261eceb0-3cef-45b4-982e-962702aaf6fb',3,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-22 13:47:53','2016-04-22 13:47:53'),(3,'bda4bd0f-2acd-406c-b4b3-36c709549d09',3,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-22 13:48:06','2016-04-22 13:48:06'),(4,'6bb47f6f-d3bf-4005-a92d-e5022e15b35e',3,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-22 13:48:10','2016-04-22 13:48:11'),(5,'a92c3929-a980-48c2-a693-27a789f40b27',3,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-22 13:48:29','2016-04-22 13:48:29'),(6,'86b1737c-5c02-44cc-afa5-d58fb3d96138',3,1,1,'192.168.33.1',1,NULL,NULL,0,'2016-04-22 13:48:37','2016-04-22 13:48:38'),(7,'9ba046d1-e2f2-4075-8c7c-79611e887963',NULL,1,1,'192.168.33.1',1,NULL,NULL,0,'2016-04-22 13:48:42','2016-04-22 13:48:42'),(8,'21a93333-83d7-420d-a6ee-5b5ce72d91f3',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-22 13:48:52','2016-04-22 13:48:52'),(9,'13bd9903-c2f5-4775-91ea-b6ab327e643c',NULL,1,1,'192.168.33.1',2,NULL,NULL,0,'2016-04-22 13:48:58','2016-04-22 13:48:58'),(10,'dd2fef19-fdb0-4707-aab0-703941d4d3c1',3,1,1,'192.168.33.1',2,NULL,NULL,0,'2016-04-22 13:49:03','2016-04-22 13:49:04'),(11,'8e082149-ed13-4b83-abd1-e8d7a7503724',3,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-22 13:53:03','2016-04-22 13:53:03'),(12,'0d0d7214-414c-49e9-bf13-1d225a5c6f49',3,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-22 13:53:24','2016-04-22 13:53:24'),(13,'315142df-2b64-42b6-820f-8691243af440',2,1,2,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-22 13:53:41','2016-04-22 13:53:41'),(14,'a675871e-66bc-4571-99c7-f8be32d652ee',2,1,2,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-22 13:53:57','2016-04-22 13:53:57'),(15,'f494ceed-cc6a-41da-a6ec-a0750880edd6',3,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-22 13:58:44','2016-04-22 13:58:44'),(16,'263a99c0-1609-494f-9533-70872073d1b4',2,1,2,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-22 13:58:58','2016-04-22 13:58:58'),(17,'0d87dc59-cf34-43ff-b448-7304b1900e6a',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-22 15:39:22','2016-04-22 15:39:22'),(18,'57427870-3ecc-4b43-965a-04af77e6fee1',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-22 15:41:20','2016-04-22 15:41:20'),(19,'679f6324-f815-4787-8581-b04433d588d1',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-22 15:41:31','2016-04-22 15:41:31'),(20,'a9afe90d-e3cf-46d1-a7c5-f0015a6b6470',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-22 15:41:37','2016-04-22 15:41:37'),(21,'e4405b8a-b192-43ee-b999-e2467f698174',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 09:46:27','2016-04-24 09:46:27'),(22,'f47e7fdf-b263-463d-bab8-a86669eaf1b4',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-24 09:46:38','2016-04-24 09:46:38'),(23,'3d6578eb-79ed-4ee0-87ad-7ffd6ddbc412',NULL,1,1,'192.168.33.1',4,NULL,NULL,0,'2016-04-24 09:47:21','2016-04-24 09:47:21'),(24,'4689f2cb-f496-4168-82e6-632f8ab87f78',NULL,1,1,'192.168.33.1',4,NULL,NULL,0,'2016-04-24 09:47:24','2016-04-24 09:47:24'),(25,'23457250-5261-4867-a23b-768e06160796',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 09:47:35','2016-04-24 09:47:35'),(26,'015bfe8e-205b-44ac-aece-eb3de62b8051',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-24 10:09:32','2016-04-24 10:09:33'),(27,'fca6d1bd-ddaa-40c4-8c94-72684c333218',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 10:09:37','2016-04-24 10:09:37'),(28,'afd89c70-d2b2-47d3-9ef8-1d386bc2c93d',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-24 10:09:42','2016-04-24 10:09:42'),(29,'4c2db392-a77d-4756-9aae-7f15dab8a7e5',NULL,1,1,'192.168.33.1',4,NULL,NULL,0,'2016-04-24 10:09:51','2016-04-24 10:09:51'),(30,'11d53286-5e2f-4576-8f5d-ac925e5a7b8e',NULL,1,1,'192.168.33.1',4,NULL,NULL,0,'2016-04-24 10:09:55','2016-04-24 10:09:55'),(31,'bfbbee50-8cbb-4e5a-83d6-c71a8787c7df',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 10:10:45','2016-04-24 10:10:45'),(32,'a1460c81-3e0d-4358-9c24-c42be0c94b16',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-24 10:10:53','2016-04-24 10:10:53'),(33,'741eae44-8137-491f-b2d4-cf92daa58076',NULL,1,1,'192.168.33.1',5,NULL,NULL,0,'2016-04-24 10:11:43','2016-04-24 10:11:43'),(34,'e9f06180-a8f9-4a03-b146-0607ff81ff5e',NULL,1,1,'192.168.33.1',5,NULL,NULL,0,'2016-04-24 10:11:47','2016-04-24 10:11:47'),(35,'3e818b24-2ef7-4604-9b53-b7f886bef5bf',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-24 10:11:55','2016-04-24 10:11:55'),(36,'4a156a12-f8a2-4dcc-8d77-73001bf5f5db',NULL,1,1,'192.168.33.1',6,NULL,NULL,0,'2016-04-24 10:12:05','2016-04-24 10:12:05'),(37,'1b3d0e6c-77d6-4cd8-b55e-ea4e5fbe239e',NULL,1,1,'192.168.33.1',6,NULL,NULL,0,'2016-04-24 10:12:08','2016-04-24 10:12:08'),(38,'271d3d2e-5ff4-407b-ac9e-0ca8bdf55d9a',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-24 10:12:13','2016-04-24 10:12:13'),(39,'500bb5c4-33c8-45a0-b35b-be1670b4a695',NULL,1,1,'192.168.33.1',6,NULL,NULL,0,'2016-04-24 10:12:23','2016-04-24 10:12:23'),(40,'96895019-2ff6-46f5-a2ea-1ccd48127cbe',NULL,1,1,'192.168.33.1',6,NULL,NULL,0,'2016-04-24 10:12:26','2016-04-24 10:12:26'),(41,'8c891d38-3868-4835-9c4a-201b7b759256',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-24 10:12:48','2016-04-24 10:12:48'),(42,'c2b67b77-bd52-4192-b107-5caf5c46ce7b',NULL,1,1,'192.168.33.1',5,NULL,NULL,0,'2016-04-24 10:12:58','2016-04-24 10:12:58'),(43,'310863a4-ad1c-4509-b9e3-4c04fb99fc0a',NULL,1,1,'192.168.33.1',5,NULL,NULL,0,'2016-04-24 10:13:02','2016-04-24 10:13:02'),(44,'22dd6781-bebb-4f57-ad81-9c4fdd2a1e77',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-24 10:43:47','2016-04-24 10:43:47'),(45,'5a9c6f15-5ad1-4370-a345-913c667a0304',NULL,1,1,'192.168.33.1',5,NULL,NULL,0,'2016-04-24 10:43:57','2016-04-24 10:43:57'),(46,'31c444c2-dc56-468e-9889-88b550018816',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-24 10:44:03','2016-04-24 10:44:03'),(47,'0dc386fa-78ee-4786-912f-ce3078e162d4',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 10:44:45','2016-04-24 10:44:45'),(48,'3d8beca6-08bd-4260-bfd5-31f815db7972',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-24 10:44:51','2016-04-24 10:44:51'),(49,'f461012f-72f0-4278-b254-5b3156c0bf0f',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 15:04:36','2016-04-24 15:04:36'),(50,'72c66f95-0ab7-4952-97ab-bd8291001a69',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 15:05:10','2016-04-24 15:05:10'),(51,'1a592da0-428d-442d-8314-b61ccb83d3bb',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 15:06:48','2016-04-24 15:06:48'),(52,'ad5aecf1-6584-40ea-9595-61f992ce98d9',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 15:08:54','2016-04-24 15:08:54'),(53,'4f4702c4-4816-40ef-a432-1611b990d718',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 15:09:37','2016-04-24 15:09:37'),(54,'55644ec2-ac3a-40fc-9c4b-ef336e9d272f',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 15:10:11','2016-04-24 15:10:11'),(55,'9258ac43-980a-4281-b62a-b6d121a8435d',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:10:41','2016-04-24 15:10:41'),(56,'961022cd-4987-482e-9466-9637c8a4204a',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 15:10:48','2016-04-24 15:10:48'),(57,'ad8d3056-84ba-4a6b-99ac-01b1a8b917a4',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 15:11:20','2016-04-24 15:11:20'),(58,'1b5c2c05-e6c6-4351-af3e-6a5e1b0ad983',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:11:35','2016-04-24 15:11:35'),(59,'65a0646a-a038-4995-85be-d79e7ae57c74',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 15:11:49','2016-04-24 15:11:49'),(60,'69e34338-4117-409d-975e-0e1e67c0c133',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:13:24','2016-04-24 15:13:24'),(61,'59a39c9f-bb39-4cd3-8524-2f7196484dde',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:14:08','2016-04-24 15:14:08'),(62,'263e2ce4-d5eb-42dc-be1b-7c97248416ea',NULL,1,1,'192.168.33.1',9,NULL,NULL,0,'2016-04-24 15:14:31','2016-04-24 15:14:31'),(63,'8ceb8a9f-3431-4b4a-8438-eb4a7c0f264e',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:39:16','2016-04-24 15:39:16'),(64,'82d8d23d-2ec6-4142-95b3-a65bd7906024',NULL,1,1,'192.168.33.1',9,NULL,NULL,0,'2016-04-24 15:39:23','2016-04-24 15:39:23'),(65,'76a3abd2-7425-4499-92e0-fc93d3192d86',NULL,1,1,'192.168.33.1',9,NULL,NULL,0,'2016-04-24 15:39:26','2016-04-24 15:39:26'),(66,'4d3a59c4-6357-454d-b9c8-16f5941e5069',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 15:39:51','2016-04-24 15:39:51'),(67,'94e9b910-48c0-4477-a7dc-3dc6ba61533e',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-24 15:39:57','2016-04-24 15:39:57'),(68,'001692e0-2074-46c1-a04d-068c4f47482b',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:41:17','2016-04-24 15:41:17'),(69,'a6e587bd-38eb-488a-8f94-1937d8c02061',NULL,1,1,'192.168.33.1',9,NULL,NULL,0,'2016-04-24 15:41:42','2016-04-24 15:41:42'),(70,'bbbb9c0f-2dd8-4e94-bce2-f097dee1dc0e',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:44:47','2016-04-24 15:44:47'),(71,'fba500cd-01a1-454d-8bb9-3c3d771e1065',NULL,1,1,'192.168.33.1',9,NULL,NULL,0,'2016-04-24 15:44:54','2016-04-24 15:44:54'),(72,'35938bd7-56b4-4ab8-8f85-6b6dd1b0efd6',NULL,1,1,'192.168.33.1',9,NULL,NULL,0,'2016-04-24 15:45:32','2016-04-24 15:45:32'),(73,'aa44ac6a-96cb-47bb-ac01-5824e2724830',NULL,1,1,'192.168.33.1',9,NULL,NULL,0,'2016-04-24 15:45:35','2016-04-24 15:45:35'),(74,'ce26e0ec-62a3-4841-993a-d7d9dc1ebbf1',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:45:47','2016-04-24 15:45:47'),(75,'debd98d9-2b51-4056-94fe-f6e2b3a3e4f4',NULL,1,1,'192.168.33.1',10,NULL,NULL,0,'2016-04-24 15:46:24','2016-04-24 15:46:24'),(76,'6eeb072a-71d7-49bb-bff3-727d1329dbf7',NULL,1,1,'192.168.33.1',10,NULL,NULL,0,'2016-04-24 15:46:27','2016-04-24 15:46:27'),(77,'c41f90bf-4d9c-4570-9a51-2021a3722de3',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-24 15:46:36','2016-04-24 15:46:36'),(78,'7d401482-d6d3-4d10-a970-299eb953afdc',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 15:46:53','2016-04-24 15:46:53'),(79,'0f9743fa-92f3-4b91-af9d-6c2b2d976096',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:46:59','2016-04-24 15:46:59'),(80,'18424d44-40c3-45a2-a71c-aa8d4cbcee97',NULL,1,1,'192.168.33.1',11,NULL,NULL,0,'2016-04-24 15:48:49','2016-04-24 15:48:49'),(81,'d7c3c545-7b43-44d8-9886-32b9bc9a0ecb',NULL,1,1,'192.168.33.1',11,NULL,NULL,0,'2016-04-24 15:48:52','2016-04-24 15:48:52'),(82,'16538de4-6df1-4063-917e-44bebdc6a09c',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:48:59','2016-04-24 15:48:59'),(83,'d431040d-fb84-4b39-809d-fb34c383e48c',NULL,1,1,'192.168.33.1',11,NULL,NULL,0,'2016-04-24 15:49:05','2016-04-24 15:49:05'),(84,'9b07872a-9df5-49ca-ade0-cad497d6219e',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:49:28','2016-04-24 15:49:28'),(85,'d6237c9e-14d8-46d0-8c74-ddbed53f0074',NULL,1,1,'192.168.33.1',11,NULL,NULL,0,'2016-04-24 15:49:36','2016-04-24 15:49:36'),(86,'0359379a-3b0d-4443-80d3-20680b3562d0',NULL,1,1,'192.168.33.1',11,NULL,NULL,0,'2016-04-24 15:49:39','2016-04-24 15:49:39'),(87,'c858cdc4-c2d4-4b5e-afec-56797c31dde1',NULL,1,1,'192.168.33.1',11,NULL,NULL,0,'2016-04-24 15:49:51','2016-04-24 15:49:51'),(88,'bb3bceaa-dd45-4c60-9d0c-11bc51a10aaa',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:52:56','2016-04-24 15:52:56'),(89,'06632fb8-4fe1-4a5c-8bfe-2cc9d0356636',NULL,1,1,'192.168.33.1',11,NULL,NULL,0,'2016-04-24 15:53:01','2016-04-24 15:53:01'),(90,'e4bd1e75-7e8e-4a66-970f-1a0dfea55645',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:53:08','2016-04-24 15:53:08'),(91,'b633eccd-d32e-4f89-91b5-681cad9eccbd',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:53:11','2016-04-24 15:53:11'),(92,'fdda4714-a5d7-478a-a086-960d4823d434',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:53:17','2016-04-24 15:53:17'),(93,'5ed427b3-7319-4083-b7ff-b866d8ce0e1f',NULL,1,1,'192.168.33.1',10,NULL,NULL,0,'2016-04-24 15:53:32','2016-04-24 15:53:32'),(94,'b89c31fc-7b48-4fd8-905d-f5e79811f076',NULL,1,1,'192.168.33.1',10,NULL,NULL,0,'2016-04-24 15:53:35','2016-04-24 15:53:35'),(95,'67b4416e-034e-415d-a4bc-1b07200341ea',NULL,1,1,'192.168.33.1',10,NULL,NULL,0,'2016-04-24 15:55:03','2016-04-24 15:55:03'),(96,'de361382-800c-4837-bfa9-d9f0fc7ec8e4',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 15:55:42','2016-04-24 15:55:42'),(97,'75b614d8-ba9c-4d47-ba47-b5de96d02053',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:55:52','2016-04-24 15:55:52'),(98,'175adc20-ed5c-4c73-883e-15c8953522a5',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 15:56:00','2016-04-24 15:56:00'),(99,'7ad99a5a-e013-44a3-8a01-d674d52f1c26',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:56:09','2016-04-24 15:56:09'),(100,'478a44ca-b229-402e-ba2f-69904d6caa0c',NULL,1,1,'192.168.33.1',12,NULL,NULL,0,'2016-04-24 15:56:19','2016-04-24 15:56:19'),(101,'775505da-69df-4e75-be1c-4d5ce29433ee',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:56:24','2016-04-24 15:56:24'),(102,'481701a9-2551-4a59-98f0-9a69773c614f',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 15:58:17','2016-04-24 15:58:17'),(103,'d5faa48a-08a3-40e3-a2c6-8f64652b8f73',NULL,1,1,'192.168.33.1',8,NULL,NULL,0,'2016-04-24 15:58:25','2016-04-24 15:58:25'),(104,'8cdde8a7-5a20-40c7-a5ae-a3f401cf61e1',NULL,1,1,'192.168.33.1',10,NULL,NULL,0,'2016-04-24 15:58:57','2016-04-24 15:58:57'),(105,'cbd5babd-4559-4677-9279-92245917c1da',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 15:59:08','2016-04-24 15:59:08'),(106,'5366c954-76ee-40dc-95dc-e420e5bbcbb1',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 16:02:16','2016-04-24 16:02:16'),(107,'5fbe9f39-62ff-48fa-8ced-d189717b2c65',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-24 16:02:45','2016-04-24 16:02:45'),(108,'f8a747c4-961a-4a55-aa57-431e87905915',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-24 16:02:49','2016-04-24 16:02:49'),(109,'e63f28d0-67fb-423c-b91b-b1858c829de0',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-24 16:03:01','2016-04-24 16:03:01'),(110,'b1f2f1f4-8bc5-4160-969d-2913d06a312e',NULL,1,1,'192.168.33.1',4,NULL,NULL,0,'2016-04-24 16:03:11','2016-04-24 16:03:11'),(111,'05e64f2c-a39e-45ff-b842-e67860963995',NULL,1,1,'192.168.33.1',4,NULL,NULL,0,'2016-04-24 16:03:15','2016-04-24 16:03:15'),(112,'d489f94f-9a71-45d0-b3a1-e155b783ce1f',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-24 16:03:23','2016-04-24 16:03:23'),(113,'511f42b1-0657-4887-b87b-779bb7b63906',NULL,1,1,'192.168.33.1',13,NULL,NULL,0,'2016-04-24 16:03:47','2016-04-24 16:03:47'),(114,'4400e0a2-1c96-46a1-9c35-ecc09ed7a6a4',NULL,1,1,'192.168.33.1',13,NULL,NULL,0,'2016-04-24 16:03:50','2016-04-24 16:03:50'),(115,'9150ecc5-f2e6-4e85-af1e-c3177e5b31b6',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 16:04:26','2016-04-24 16:04:26'),(116,'e8e17e38-6c3c-47b1-864a-e00e0aed2294',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-24 16:04:34','2016-04-24 16:04:34'),(117,'a5505c72-b25d-40e4-b15b-f31036719ded',NULL,1,1,'192.168.33.1',13,NULL,NULL,0,'2016-04-24 16:04:49','2016-04-24 16:04:49'),(118,'cc9610e5-00b9-403e-ac2d-19cc1c11bef0',NULL,1,1,'192.168.33.1',13,NULL,NULL,0,'2016-04-24 16:04:53','2016-04-24 16:04:53'),(119,'c9d5aeac-f245-4608-8524-2473c729ffa1',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-24 16:05:02','2016-04-24 16:05:02'),(120,'f13c884e-d851-44c1-9e29-4ffd14d8881a',NULL,1,1,'192.168.33.1',13,NULL,NULL,0,'2016-04-24 16:27:41','2016-04-24 16:27:41'),(121,'6e6e3951-1520-47dc-aeb4-e273c15ea2e7',NULL,1,1,'192.168.33.1',3,NULL,NULL,0,'2016-04-24 16:27:58','2016-04-24 16:27:58'),(122,'2dc0dc7e-b9f4-4ec4-802e-d4651a2c81b6',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-24 16:30:19','2016-04-24 16:30:19'),(123,'d62773a3-22e9-4b0d-abbc-478bc4d6ed59',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-25 13:53:20','2016-04-25 13:53:20'),(124,'32586299-6258-41a8-bdcd-515ecf33fcb0',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-25 13:53:44','2016-04-25 13:53:44'),(125,'9e54e83e-0517-4c01-8357-5abbc880da73',NULL,1,1,'192.168.33.1',14,NULL,NULL,0,'2016-04-25 13:53:48','2016-04-25 13:53:48'),(126,'545b6c72-bfe5-4d77-93b1-13467b52754c',NULL,1,1,'192.168.33.1',14,NULL,NULL,0,'2016-04-25 13:53:51','2016-04-25 13:53:51'),(127,'78dc3e14-7c82-49f6-a8af-3f5ca26034c7',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-25 13:54:25','2016-04-25 13:54:25'),(128,'345777ab-af7d-4f63-bf37-3e803f18a019',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-25 13:54:44','2016-04-25 13:54:44'),(129,'a7d15463-f288-4866-b107-b0eb186f5d79',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-25 13:55:39','2016-04-25 13:55:39'),(130,'baf770f7-2cb8-482c-8253-213fe6b78004',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-25 13:58:31','2016-04-25 13:58:31'),(131,'09849671-147a-4b08-8a62-ef387b47ea07',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-25 13:59:12','2016-04-25 13:59:12'),(132,'acfac6a8-76db-4242-82f7-f1b17b61db5e',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-25 14:00:13','2016-04-25 14:00:13'),(133,'79eb3112-213a-4366-8446-ed222e6db209',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-25 14:01:34','2016-04-25 14:01:34'),(134,'0984850f-9bb7-4f01-966e-0089ccd301a0',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-25 14:01:42','2016-04-25 14:01:42'),(135,'6ae855aa-917e-44c0-869e-80529099153a',NULL,1,1,'192.168.33.1',2,NULL,NULL,0,'2016-04-25 14:01:52','2016-04-25 14:01:52'),(136,'aa32dd60-15be-436e-afb2-92924ac18a04',3,1,1,'192.168.33.1',2,NULL,NULL,0,'2016-04-25 14:01:56','2016-04-25 14:01:56'),(137,'025b3147-a4c0-4934-b176-648535de3b7e',3,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-25 14:02:07','2016-04-25 14:02:07'),(138,'046aa7b8-68f1-47d9-9e1a-eb636f145f98',3,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-25 14:05:36','2016-04-25 14:05:36'),(139,'d9dbefe3-f287-4030-b55c-c5bf245b9790',3,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-25 14:07:45','2016-04-25 14:07:46'),(140,'1f9e2ef3-94d9-4cd9-95bd-a808d1b9b8e8',NULL,1,1,'223.71.245.118',NULL,NULL,1,0,'2016-04-25 08:36:12','2016-04-25 08:36:12'),(141,'f081bbc3-2ff2-4d89-820c-84fc77291e06',NULL,1,1,'223.71.245.118',NULL,NULL,1,0,'2016-04-25 08:36:26','2016-04-25 08:36:26'),(142,'f0ef6116-9148-47dd-b3ce-4d2f713e01e4',NULL,1,1,'223.71.245.118',15,NULL,1,0,'2016-04-25 08:36:32','2016-04-25 08:36:32'),(143,'5c19f0d9-0846-4118-9e5a-71060079ca1f',NULL,1,1,'223.71.245.118',15,NULL,1,0,'2016-04-25 08:36:33','2016-04-25 08:36:33'),(144,'6aa62bc4-e2d4-4a2e-bbf2-7c076e4f6128',NULL,1,1,'223.71.245.118',15,NULL,1,0,'2016-04-25 08:36:36','2016-04-25 08:36:36'),(145,'63580ea1-7c3f-475f-9f73-76cf2f70977e',NULL,1,1,'223.71.245.118',16,NULL,1,0,'2016-04-25 08:36:45','2016-04-25 08:36:45'),(146,'8d46b99e-6493-498e-99b8-d151c714cbdb',NULL,1,1,'223.71.245.118',16,NULL,1,0,'2016-04-25 08:36:46','2016-04-25 08:36:46'),(147,'e016b939-5915-467f-a1c8-eb471c8bbef5',NULL,1,1,'223.71.245.118',NULL,NULL,1,0,'2016-04-25 08:37:02','2016-04-25 08:37:02'),(148,'c472e04e-4586-4377-a6a6-49426737ff50',NULL,2,3,'111.161.57.31',NULL,NULL,2,0,'2016-04-25 08:37:14','2016-04-25 08:37:14'),(149,'d733315f-260d-4e55-bdd8-a601dce380b4',NULL,3,4,'111.161.59.195',NULL,NULL,2,0,'2016-04-25 08:37:17','2016-04-25 08:37:17'),(150,'2eaee005-a824-4697-8a77-560db7b57187',NULL,4,5,'42.120.161.18',NULL,NULL,3,0,'2016-04-25 08:43:49','2016-04-25 08:43:49'),(151,'611a597f-0d9f-4020-87ea-55281fe1162c',NULL,1,1,'223.71.245.118',NULL,NULL,1,0,'2016-04-25 09:38:38','2016-04-25 09:38:38'),(152,'836d59a5-7cc0-40fb-b7bd-34a48686796b',NULL,5,6,'115.231.218.4',NULL,NULL,4,0,'2016-04-25 09:48:51','2016-04-25 09:48:51'),(153,'df80bff2-2b2e-4e37-8dd1-84ed496f1f5d',NULL,6,7,'92.241.245.126',NULL,NULL,5,0,'2016-04-25 13:56:05','2016-04-25 13:56:05'),(154,'524c9579-99a8-46a8-b17e-cd77c3206ef9',3,1,2,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-26 16:39:21','2016-04-26 16:39:21'),(155,'a876ed75-8b90-44f2-9672-a245f5e3c0bb',3,1,2,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-26 16:39:35','2016-04-26 16:39:36'),(156,'80fddd0d-ec31-4f6c-b16a-d74a108e3095',3,1,2,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-26 16:39:59','2016-04-26 16:39:59'),(157,'0b6c4694-8498-4543-b0ac-13818e44b4f2',3,1,2,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-26 16:41:25','2016-04-26 16:41:26'),(158,'3ed70c17-7191-4793-916e-c6130359ab7a',3,1,2,'192.168.33.1',17,NULL,NULL,0,'2016-04-26 16:41:34','2016-04-26 16:41:34'),(159,'8d2d0dbc-e13d-4fa5-bec6-2702dd13b83b',3,1,2,'192.168.33.1',17,NULL,NULL,0,'2016-04-26 16:41:37','2016-04-26 16:41:38'),(160,'df04492e-a28a-44ba-b17c-70141c9ab73e',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:41:43','2016-04-26 16:41:43'),(161,'d704802d-630b-4916-8829-52efadb59daa',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:41:46','2016-04-26 16:41:47'),(162,'fbe61a78-986c-472a-8b3b-3f31f47fdd6c',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:41:53','2016-04-26 16:41:54'),(163,'707005c6-fffb-41ef-b95b-ea8cb835d9a5',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:41:58','2016-04-26 16:41:58'),(164,'ee4e925e-3a59-4c1f-adba-66d082db1448',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:46:43','2016-04-26 16:46:44'),(165,'f01fbe09-9a8e-4130-ade4-1b9f08e28e4d',3,1,2,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-26 16:47:39','2016-04-26 16:47:39'),(166,'43ed4181-b74a-4cff-8dd1-3e8c91f5e66a',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:48:54','2016-04-26 16:48:55'),(167,'3c8bbcc6-ca9f-4310-950e-3cbc9d2cc806',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:48:59','2016-04-26 16:48:59'),(168,'1a027b1d-8672-44f1-8585-a7a5ff3cd32c',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:49:25','2016-04-26 16:49:25'),(169,'d9436f02-0910-4f42-8ae9-dd62e360cb28',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:49:26','2016-04-26 16:49:27'),(170,'88398792-dc33-4abc-8489-7cc170404f67',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:49:28','2016-04-26 16:49:29'),(171,'591927d5-ce1e-4b24-ba98-4790df4063bd',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:49:32','2016-04-26 16:49:33'),(172,'d93dff86-bd3a-4a8a-9e02-51c7852f5253',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:49:38','2016-04-26 16:49:39'),(173,'926d0f60-3f6f-4d6b-b332-2681dc3629fa',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:49:44','2016-04-26 16:49:45'),(174,'0f6c0714-3b09-4d7e-9f0c-f63e3f6e8f62',3,1,2,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-26 16:49:58','2016-04-26 16:49:58'),(175,'5505eeba-97e0-44c0-8c15-e1447415e533',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:50:09','2016-04-26 16:50:10'),(176,'6185f03c-7ab3-402e-be9d-775040c7714f',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:50:14','2016-04-26 16:50:14'),(177,'1db308ee-582d-40c7-9fa4-38cf059a11cf',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:50:19','2016-04-26 16:50:20'),(178,'568845a0-08dc-4c71-9795-ee2e526ea108',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:50:24','2016-04-26 16:50:24'),(179,'3ef78f78-24f8-4140-8a25-576d182ccc7d',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:50:34','2016-04-26 16:50:34'),(180,'f7b87fde-95bc-4550-9784-96bab617cced',3,1,2,'192.168.33.1',18,NULL,NULL,0,'2016-04-26 16:50:38','2016-04-26 16:50:39'),(181,'bdaf0736-97a4-4bf0-bbd2-f0207623b6a1',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-26 17:44:11','2016-04-26 17:44:11'),(182,'60b22519-0255-445d-94e7-4fd128b951df',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-26 17:44:42','2016-04-26 17:44:42'),(183,'1be847aa-b7f6-4a6b-af38-a10924126e9b',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-26 17:48:50','2016-04-26 17:48:50'),(184,'461ae069-cf47-4a5f-a581-a5fe362a0e30',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-26 17:48:56','2016-04-26 17:48:56'),(185,'81392ea2-8d7b-49c3-8661-c97ab0bcfd49',NULL,1,1,'192.168.33.1',19,NULL,NULL,0,'2016-04-26 17:50:42','2016-04-26 17:50:42'),(186,'ecb1bb4d-090d-4cc6-bc8b-23ebada36668',NULL,1,1,'192.168.33.1',19,NULL,NULL,0,'2016-04-26 17:50:45','2016-04-26 17:50:45'),(187,'d97ad93f-a239-44d6-a4a3-2fa42ecfdb6a',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-26 17:50:54','2016-04-26 17:50:54'),(188,'cbc4cf6b-4890-4895-9e89-02343e27d9c2',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-26 17:50:58','2016-04-26 17:50:58'),(189,'5aee3a39-457d-4e2e-96de-f2484d04efa4',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-26 17:51:15','2016-04-26 17:51:15'),(190,'472e9953-56bd-46dd-af22-393640cfa44b',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-26 17:54:12','2016-04-26 17:54:12'),(191,'e6c59d3e-e3c1-40be-9743-62c3b2b8c7a5',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-26 17:57:11','2016-04-26 17:57:11'),(192,'f59b0bad-5b60-42b3-bb57-47226a37fe5a',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-26 17:57:15','2016-04-26 17:57:15'),(193,'d03f766d-b0ad-44e9-94d9-320b654e60eb',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-26 17:57:20','2016-04-26 17:57:20'),(194,'55f88011-3613-402d-bebb-268b0d925253',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-26 17:57:24','2016-04-26 17:57:24'),(195,'e6412938-d5d7-46db-b3f5-b09200941082',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-26 17:57:38','2016-04-26 17:57:38'),(196,'27e8bec5-e6ec-4d11-98fa-9e180dca0752',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-26 17:57:44','2016-04-26 17:57:44'),(197,'1e2d6c09-2d27-4f52-a354-0b0b39745f79',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-26 17:57:56','2016-04-26 17:57:56'),(198,'199b23b0-7480-4ab6-86b5-2f5669e737f1',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-26 17:58:23','2016-04-26 17:58:23'),(199,'fc4c00d8-2364-4ccc-ae34-93bfe13f949e',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-26 17:59:01','2016-04-26 17:59:01'),(200,'4a6a6685-66fd-4b5a-8e16-0248e520c605',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-26 17:59:46','2016-04-26 17:59:46'),(201,'fa1c8336-bc80-4f87-90be-b9cda657909a',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-26 18:00:22','2016-04-26 18:00:22'),(202,'b1ec5bde-83cd-4c91-a7b8-f606df2d477d',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-27 08:25:17','2016-04-27 08:25:17'),(203,'019fe292-224c-4bb1-89ca-689342264d7d',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-27 08:25:27','2016-04-27 08:25:27'),(204,'fc081adf-ff56-4fe3-8941-5a0afaf292ce',NULL,1,1,'192.168.33.1',7,NULL,NULL,0,'2016-04-27 08:25:33','2016-04-27 08:25:33'),(205,'99c81e9b-7e9a-47eb-b7ba-14a592e298ca',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-27 08:27:39','2016-04-27 08:27:39'),(206,'5aa7c4cf-61a7-4dd4-bdd1-70c47b63af2b',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-27 08:27:46','2016-04-27 08:27:46'),(207,'25be84d5-f1b8-4e28-8fdd-314cb4aa8250',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-27 08:28:32','2016-04-27 08:28:32'),(208,'5eec3870-ef58-475f-951b-4bd3192af652',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-27 08:28:50','2016-04-27 08:28:50'),(209,'b3a903f9-bc54-40ed-b27c-40c5d9308366',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-27 08:29:11','2016-04-27 08:29:11'),(210,'3f2965a6-75b7-4a07-a26c-02c84c88cc08',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-27 08:32:19','2016-04-27 08:32:19'),(211,'c56cc27c-034d-411c-a108-2e60683e3f93',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-27 08:32:47','2016-04-27 08:32:47'),(212,'c1bce7da-6063-483a-84ed-8b5692f50fac',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-27 08:32:54','2016-04-27 08:32:54'),(213,'13821244-6ae6-4efd-9c0f-b962307fdd7b',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-27 08:32:59','2016-04-27 08:32:59'),(214,'3955a3e4-0d81-4796-b3e7-e6f6fb698ff8',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-27 08:33:12','2016-04-27 08:33:12'),(215,'1e8ba3b7-cc81-4992-80dd-9fb989e32b57',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-27 13:39:24','2016-04-27 13:39:24'),(216,'f9aeb835-4c1a-4268-a85e-3b6da43e4b7a',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-27 13:41:46','2016-04-27 13:41:46'),(217,'cf3d16cc-a7a9-4a53-a17b-8d166185a116',NULL,1,1,'192.168.33.1',NULL,NULL,NULL,0,'2016-04-27 15:11:42','2016-04-27 15:11:42');
/*!40000 ALTER TABLE `tracker_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_sql_queries`
--

DROP TABLE IF EXISTS `tracker_sql_queries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_sql_queries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sha1` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `statement` text COLLATE utf8_unicode_ci NOT NULL,
  `time` double NOT NULL,
  `connection_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_sql_queries_sha1_index` (`sha1`),
  KEY `tracker_sql_queries_time_index` (`time`),
  KEY `tracker_sql_queries_created_at_index` (`created_at`),
  KEY `tracker_sql_queries_updated_at_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_sql_queries`
--

LOCK TABLES `tracker_sql_queries` WRITE;
/*!40000 ALTER TABLE `tracker_sql_queries` DISABLE KEYS */;
/*!40000 ALTER TABLE `tracker_sql_queries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_sql_queries_log`
--

DROP TABLE IF EXISTS `tracker_sql_queries_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_sql_queries_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_id` bigint(20) unsigned NOT NULL,
  `sql_query_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_sql_queries_log_log_id_index` (`log_id`),
  KEY `tracker_sql_queries_log_sql_query_id_index` (`sql_query_id`),
  KEY `tracker_sql_queries_log_created_at_index` (`created_at`),
  KEY `tracker_sql_queries_log_updated_at_index` (`updated_at`),
  CONSTRAINT `tracker_sql_queries_log_log_id_foreign` FOREIGN KEY (`log_id`) REFERENCES `tracker_log` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tracker_sql_queries_log_sql_query_id_foreign` FOREIGN KEY (`sql_query_id`) REFERENCES `tracker_sql_queries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_sql_queries_log`
--

LOCK TABLES `tracker_sql_queries_log` WRITE;
/*!40000 ALTER TABLE `tracker_sql_queries_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tracker_sql_queries_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_sql_query_bindings`
--

DROP TABLE IF EXISTS `tracker_sql_query_bindings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_sql_query_bindings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sha1` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `serialized` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_sql_query_bindings_sha1_index` (`sha1`),
  KEY `tracker_sql_query_bindings_created_at_index` (`created_at`),
  KEY `tracker_sql_query_bindings_updated_at_index` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_sql_query_bindings`
--

LOCK TABLES `tracker_sql_query_bindings` WRITE;
/*!40000 ALTER TABLE `tracker_sql_query_bindings` DISABLE KEYS */;
/*!40000 ALTER TABLE `tracker_sql_query_bindings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_sql_query_bindings_parameters`
--

DROP TABLE IF EXISTS `tracker_sql_query_bindings_parameters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_sql_query_bindings_parameters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sql_query_bindings_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_sql_query_bindings_parameters_name_index` (`name`),
  KEY `tracker_sql_query_bindings_parameters_created_at_index` (`created_at`),
  KEY `tracker_sql_query_bindings_parameters_updated_at_index` (`updated_at`),
  KEY `tracker_sqlqb_parameters` (`sql_query_bindings_id`),
  CONSTRAINT `tracker_sqlqb_parameters` FOREIGN KEY (`sql_query_bindings_id`) REFERENCES `tracker_sql_query_bindings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_sql_query_bindings_parameters`
--

LOCK TABLES `tracker_sql_query_bindings_parameters` WRITE;
/*!40000 ALTER TABLE `tracker_sql_query_bindings_parameters` DISABLE KEYS */;
/*!40000 ALTER TABLE `tracker_sql_query_bindings_parameters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracker_system_classes`
--

DROP TABLE IF EXISTS `tracker_system_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracker_system_classes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tracker_system_classes_name_index` (`name`),
  KEY `tracker_system_classes_created_at_index` (`created_at`),
  KEY `tracker_system_classes_updated_at_index` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracker_system_classes`
--

LOCK TABLES `tracker_system_classes` WRITE;
/*!40000 ALTER TABLE `tracker_system_classes` DISABLE KEYS */;
INSERT INTO `tracker_system_classes` VALUES (1,'Illuminate\\Foundation\\Application','2016-04-22 13:47:42','2016-04-22 13:47:42'),(2,'7d2e1ab242b11c47cda266a76c45fbf2f54cbb38','2016-04-22 13:47:42','2016-04-22 13:47:42'),(3,'Illuminate\\Http\\Request','2016-04-22 13:47:43','2016-04-22 13:47:43'),(4,'App\\User','2016-04-22 13:48:38','2016-04-22 13:48:38'),(5,'a:2:{s:5:\"email\";s:15:\"admin@lawood.cn\";s:8:\"password\";s:8:\"20022002\";}','2016-04-22 13:48:59','2016-04-22 13:48:59'),(6,'647466d8fcc4c9136e19f9f1b608b6ac5e623abe','2016-04-22 13:48:59','2016-04-22 13:48:59'),(7,'ee66af2b3e9d17164d35f369cf3687b39ea7bafd','2016-04-22 13:53:41','2016-04-22 13:53:41'),(8,'90e0f818a3584930da9fad7008afe00edd992716','2016-04-22 15:39:22','2016-04-22 15:39:22'),(9,'f2857b743d03a5e603bcb860cc54099f3b100988','2016-04-24 09:46:27','2016-04-24 09:46:27'),(10,'bb5723513c2f219d0cdc37ab2464b8fce4a726f6','2016-04-24 15:04:37','2016-04-24 15:04:37'),(11,'e3c12dfaa9e8a9b4cc6128cfa03584d2ba79394a','2016-04-24 15:05:10','2016-04-24 15:05:10'),(12,'46210429d8539ced14c72eb18cbf6bd567d01f03','2016-04-24 15:06:48','2016-04-24 15:06:48'),(13,'4e972d0f8faab6482ea543f7317c8cb37f6a87e1','2016-04-25 13:53:20','2016-04-25 13:53:20'),(14,'3eac1103007fe2d5359297a67735d87dad005599','2016-04-25 13:53:44','2016-04-25 13:53:44'),(15,'8086427e3472da889f7c28c62b69796de32580a8','2016-04-25 14:01:53','2016-04-25 14:01:53'),(16,'0c2159ac59ccd6f9284e977ae46a8f4d585734c7','2016-04-25 08:36:12','2016-04-25 08:36:12'),(17,'d3c4653358f1249b62cf8790f0f38bbe5160419d','2016-04-25 08:37:14','2016-04-25 08:37:14'),(18,'7ddae733d431d74b047dd30ab0569c4953d4505d','2016-04-25 08:37:17','2016-04-25 08:37:17'),(19,'41cd3f80a9899cd8fdaed534c02c66f66649589f','2016-04-25 08:43:50','2016-04-25 08:43:50'),(20,'161bdaac230291561209b66b09b65e0b34769012','2016-04-25 09:48:51','2016-04-25 09:48:51'),(21,'0790d5b05b0ea5072279993667e120b39cf93ac2','2016-04-25 13:56:05','2016-04-25 13:56:05'),(22,'941434affbdb523d701c1fd11c2f057fda4da50a','2016-04-26 16:39:21','2016-04-26 16:39:21'),(23,'c3f49cc74fd1c614b96bbe87b972db52ae6f9dd2','2016-04-26 17:44:12','2016-04-26 17:44:12'),(24,'access_token','2016-04-26 17:44:12','2016-04-26 17:44:12'),(25,'83ce31b7a81e67da6f12ad67dc915f5a3bf7e1e9','2016-04-26 17:44:42','2016-04-26 17:44:42'),(26,'fe0b346bb84f44a17bb73019ca5b0ccd3812a4ab','2016-04-26 17:48:50','2016-04-26 17:48:50'),(27,'467ca60617f4c0ec3b3594eec2608d3e90fe5cbd','2016-04-27 08:25:18','2016-04-27 08:25:18'),(28,'wx_access_token','2016-04-27 08:27:46','2016-04-27 08:27:46'),(29,'c6222f051ad5f295eb4d7295e2db0674dae113f7','2016-04-27 13:39:24','2016-04-27 13:39:24'),(30,'d67aa4047825f9eb37c999ed369b3b3ce8a089d7','2016-04-27 13:41:46','2016-04-27 13:41:46'),(31,'a4cf21f95b07f284a166a6ac862cbc99fb6b3bf2','2016-04-27 15:11:42','2016-04-27 15:11:42');
/*!40000 ALTER TABLE `tracker_system_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `gateway` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `transactions_order_id_index` (`order_id`),
  KEY `transactions_gateway_transaction_id_index` (`gateway`,`transaction_id`),
  KEY `transactions_order_id_token_index` (`order_id`,`token`),
  CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_category`
--

DROP TABLE IF EXISTS `user_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_category` (
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`category_id`),
  KEY `user_category_category_id_foreign` (`category_id`),
  CONSTRAINT `user_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_category_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_category`
--

LOCK TABLES `user_category` WRITE;
/*!40000 ALTER TABLE `user_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nick_name` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `real_name` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wx_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_active` tinyint(1) NOT NULL DEFAULT '0',
  `role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  UNIQUE KEY `users_wx_id_unique` (`wx_id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_name_index` (`name`),
  KEY `users_nick_name_index` (`nick_name`),
  KEY `users_real_name_index` (`real_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,NULL,NULL,NULL,NULL,'lawyer@lawood.cn',0,NULL,NULL,0,'$2y$10$.Ify1zbsm0oIpATh66.mtesx.xtO85PRNln40bCu39qnO3lHR6p7.',NULL,'2016-04-22 13:47:43','2016-04-22 13:47:43'),(2,NULL,NULL,NULL,NULL,NULL,'client@lawood.cn',0,NULL,NULL,0,'$2y$10$216Cr8AK6/SHf6jSnNVnXO3tkM4VeVQJppNdBK1jQZmzoeXd0gZDK',NULL,'2016-04-22 13:47:43','2016-04-22 13:47:43'),(3,NULL,NULL,NULL,NULL,NULL,'admin@lawood.cn',0,NULL,NULL,0,'$2y$10$p/sg1OawH60zrmutFlJI1et7rh5B9.Q0f3jqmmPdChWFVIVMUF0nW','TBRHLZA3NHN6VmzbSvou517Som4BJadI6djLFvhP91IORzWWBEQqRiDfeTc7','2016-04-22 13:47:43','2016-04-22 13:48:38');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-27 16:00:11
