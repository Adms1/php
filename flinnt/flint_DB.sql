-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2019 at 07:41 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flint`
--

-- --------------------------------------------------------

--
-- Table structure for table `str_admin`
--

CREATE TABLE `str_admin` (
  `admin_id` int(20) UNSIGNED NOT NULL,
  `admin_name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` bigint(20) NOT NULL,
  `country_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `pin` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `email_verified_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_admin`
--

INSERT INTO `str_admin` (`admin_id`, `admin_name`, `email`, `password`, `remember_token`, `address1`, `address2`, `city`, `state_id`, `country_id`, `status_id`, `pin`, `phone`, `is_active`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(1, 'ADM Systems', 'flinnt@admin.com', '$2y$10$e5uahzb4gwMF8NzEDhnebOPYF9G2/72dlWJLN0E6G5iwNtFQKvaI.', 'CcMaa9zvRQ8Cy5krNSpubAHTQz5ViDSpsCwgj5nXy4RC94yGEAuewYIBy8h4', 'Iscon elegance', NULL, 'Ahmedabad', 12, 1, 1, NULL, NULL, 1, '2018-10-15 18:30:00', '2018-10-15 07:30:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `str_attribute`
--

CREATE TABLE `str_attribute` (
  `attribute_id` int(11) UNSIGNED NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `product_type` enum('book','other') NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `str_attribute`
--

INSERT INTO `str_attribute` (`attribute_id`, `attribute_name`, `product_type`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Paperback', 'book', 1, '2018-11-14 01:40:02', '2019-04-10 12:20:52'),
(2, 'ASIN', 'book', 1, '2018-11-14 01:40:51', '2018-11-14 01:40:51'),
(3, 'Product Dimensions', 'book', 1, '2018-11-14 01:41:01', '2018-11-14 01:41:01'),
(4, 'Mass Market Paperback', 'book', 1, '2018-11-14 01:42:37', '2018-11-14 01:42:37'),
(5, 'Reading level', 'book', 1, '2018-12-05 01:00:54', '2018-12-05 01:08:02'),
(6, 'Print Length', 'book', 1, '2019-02-28 02:02:08', '2019-02-28 02:02:28'),
(7, 'Build Quality', 'book', 1, '2019-02-28 04:24:57', '2019-02-28 04:25:11'),
(8, 'Pages', 'book', 1, '2019-04-10 06:06:28', '2019-04-10 06:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `str_audits`
--

CREATE TABLE `str_audits` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint(20) UNSIGNED NOT NULL,
  `old_values` text COLLATE utf8mb4_unicode_ci,
  `new_values` text COLLATE utf8mb4_unicode_ci,
  `url` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_audits`
--

INSERT INTO `str_audits` (`id`, `user_type`, `user_id`, `event`, `auditable_type`, `auditable_id`, `old_values`, `new_values`, `url`, `ip_address`, `user_agent`, `tags`, `created_at`, `updated_at`) VALUES
(13, 'App\\Entities\\Admin', 1, 'updated', 'App\\Entities\\Attribute', 1, '{\"attribute_name\":\"Paperback\"}', '{\"attribute_name\":\"Paperbacks\"}', 'http://localhost/flinnt/public/admin/attribute/update/1?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-10 11:15:13', '2019-04-10 11:15:13'),
(14, 'App\\Entities\\Admin', 1, 'updated', 'App\\Entities\\Attribute', 1, '{\"attribute_name\":\"Paperbacks\"}', '{\"attribute_name\":\"Paperback\"}', 'http://localhost/flinnt/public/admin/attribute/update/1?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-10 11:15:19', '2019-04-10 11:15:19'),
(15, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Author', 1, '{\"author_name\":\"Amish Tripathi\"}', '{\"author_name\":\"Amish Tripathis\"}', 'http://localhost/flinnt/public/admin/author/update/1?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-10 11:15:55', '2019-04-10 11:15:55'),
(16, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Author', 1, '{\"author_name\":\"Amish Tripathis\"}', '{\"author_name\":\"Amish Tripathi\"}', 'http://localhost/flinnt/public/admin/author/update/1?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-10 11:16:01', '2019-04-10 11:16:01'),
(17, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"B40WCK22oKAoIRX9rRHzFIorsjhUFtYevz70YoWAQ7JuLGelfIlCI3YFEL60\"}', '{\"remember_token\":\"XjwzuC3H18kt7vhszgeKTYDBFTMu4fhEGlyR9MDBI9kMgh7sV3G0DI5cVHo1\"}', 'http://localhost/flinnt/public/admin/logout?_token=rCk3egfFaKmphLNYFAJN7FOA2UCPfhtdYrl51Cl7', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-10 11:16:46', '2019-04-10 11:16:46'),
(18, 'App\\Entities\\Institution', 15, 'updated', 'App\\Entities\\Bookset', 4, '{\"book_set_name\":\"Book set for standard 1\"}', '{\"book_set_name\":\"Book set for standard 12\"}', 'http://localhost/flinnt/public/admin/bookset/update/4?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-10 11:17:34', '2019-04-10 11:17:34'),
(19, 'App\\Entities\\Institution', 15, 'updated', 'App\\Entities\\Bookset', 4, '{\"book_set_name\":\"Book set for standard 12\"}', '{\"book_set_name\":\"Book set for standard 1\"}', 'http://localhost/flinnt/public/admin/bookset/update/4?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-10 11:17:53', '2019-04-10 11:17:53'),
(20, 'App\\Entities\\Institution', 15, 'updated', 'App\\Entities\\Institution', 15, '{\"remember_token\":\"n0RSsoF1WHyxsjXptWgqXeSFNNJZtythH7OZWOsDZzmoIOKBqLJumagqXHIX\"}', '{\"remember_token\":\"kFX1RYCShhiqc3tIwS5sLPwcTxVtWYl7vGyJXpAyGH42R7n51Rx4nNkQNglq\"}', 'http://localhost/flinnt/public/admin/logout?_token=IusbppE3YdeVOEGocgXNJUOdqVK6ijkMwbmqsgx9', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-10 11:19:03', '2019-04-10 11:19:03'),
(21, NULL, NULL, 'updated', 'App\\Entities\\User', 7107, '{\"user_name\":\"Flinnt Community\"}', '{\"user_name\":\"Flinnt Communitys\"}', 'http://localhost/flinnt/public/user/profileUpdate?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-10 11:19:57', '2019-04-10 11:19:57'),
(22, 'App\\Entities\\User', 7107, 'updated', 'App\\Entities\\User', 7107, '{\"user_name\":\"Flinnt Communitys\"}', '{\"user_name\":\"Flinnt Community\"}', 'http://localhost/flinnt/public/user/profileUpdate?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-10 11:20:45', '2019-04-10 11:20:45'),
(23, 'App\\Entities\\User', 7107, 'updated', 'App\\Entities\\User', 7107, '{\"remember_token\":\"C3ByjEutk7aQtZZ3MuZfE9muic34zSzN58zRziNA9LELsBqQam5x2eQx8qHJ\"}', '{\"remember_token\":\"uXsOlys7tyPh8Z5CvnHZ4FsFLgb9kRGkNeAjhuZShdv98RbCtGwF3Hsrti4N\"}', 'http://localhost/flinnt/public/user/logout?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-10 11:50:30', '2019-04-10 11:50:30'),
(24, 'App\\Entities\\User', 7107, 'updated', 'App\\Entities\\User', 7107, '{\"remember_token\":\"uXsOlys7tyPh8Z5CvnHZ4FsFLgb9kRGkNeAjhuZShdv98RbCtGwF3Hsrti4N\"}', '{\"remember_token\":\"OKczRin3bCNJjgAOcaSbeKl8bekQdd2N6Dy6Fa7QCzp0tT6BgtxB8EixC2vm\"}', 'http://localhost/flinnt/public/user/logout?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-10 11:50:44', '2019-04-10 11:50:44'),
(25, 'App\\Entities\\Admin', 1, 'updated', 'App\\Entities\\Attribute', 1, '{\"attribute_name\":\"Paperbacks\"}', '{\"attribute_name\":\"Paperback\"}', 'http://localhost/flinnt/public/admin/attribute/update/1?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', 'Paperback', '2019-04-10 12:20:52', '2019-04-10 12:20:52'),
(26, 'App\\Entities\\User', 7107, 'updated', 'App\\Entities\\User', 7107, '{\"remember_token\":\"OKczRin3bCNJjgAOcaSbeKl8bekQdd2N6Dy6Fa7QCzp0tT6BgtxB8EixC2vm\"}', '{\"remember_token\":\"gx8kOg5UDNGh7YCUgEGsrZw8Etak0f3TsWfjAw0PuIxOewvfBH3YVhl6tAzW\"}', 'http://localhost/flinnt/public/user/logout?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-11 04:36:03', '2019-04-11 04:36:03'),
(27, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"XjwzuC3H18kt7vhszgeKTYDBFTMu4fhEGlyR9MDBI9kMgh7sV3G0DI5cVHo1\"}', '{\"remember_token\":\"3skXgYs4OYYhLlvmvYn7At1lIQEUEQNYlg2ppEw5cud6albN8SS4OxRMizBs\"}', 'http://localhost/flinnt/public/admin/logout?_token=t4LvWAvSLxTQctudMmw2SuK7yurPXRIg3UGKdAT6', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-11 04:37:09', '2019-04-11 04:37:09'),
(28, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"3skXgYs4OYYhLlvmvYn7At1lIQEUEQNYlg2ppEw5cud6albN8SS4OxRMizBs\"}', '{\"remember_token\":\"l8dPbbKdHJUpE6uJgx95vvFCJv5DpYbGYYB9aHWjbTBsSzCs9dqmD44PjJmm\"}', 'http://localhost/flinnt/public/admin/logout?_token=B14aS4aLBDW6sjT4dVSsUcdVnDpFlj1FiZD650c2', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', NULL, '2019-04-11 04:57:08', '2019-04-11 04:57:08'),
(29, 'App\\Entities\\User', 7107, 'created', 'App\\Entities\\Order', 25, '[]', '{\"user_id\":7107,\"institution_id\":15,\"shipping_address_id\":\"10\",\"order_number\":\"190509120004\",\"order_qty\":1,\"order_total_price\":\"1000.00\",\"transaction_id\":1557383404,\"order_status\":1,\"order_date\":{\"date\":\"2019-05-09 12:00:04.958023\",\"timezone_type\":3,\"timezone\":\"Asia\\/Kolkata\"},\"is_active\":1,\"order_id\":25}', 'http://localhost/flinnt/public/order/checkout/process?terms=on&shipping_address_id=10&place_order=Place%20order', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Mobile Safari/537.36', NULL, '2019-05-09 06:30:05', '2019-05-09 06:30:05'),
(30, 'App\\Entities\\User', 7107, 'created', 'App\\Entities\\OrderDetail', 34, '[]', '{\"order_id\":25,\"product_id\":\"4\",\"vendor_id\":4,\"product_name\":\"Book set for standard 1\",\"product_type\":2,\"sale_price\":1000,\"qty\":1,\"discount_id\":1,\"discount_price\":0,\"final_price\":\"1000.00\",\"order_detail_id\":34}', 'http://localhost/flinnt/public/order/checkout/process?terms=on&shipping_address_id=10&place_order=Place%20order', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Mobile Safari/537.36', NULL, '2019-05-09 06:30:05', '2019-05-09 06:30:05'),
(31, 'App\\Entities\\User', 7107, 'updated', 'App\\Entities\\User', 7107, '{\"remember_token\":\"gx8kOg5UDNGh7YCUgEGsrZw8Etak0f3TsWfjAw0PuIxOewvfBH3YVhl6tAzW\"}', '{\"remember_token\":\"ydXIVMQXsEwMtym1jIxhqT8XQyFXiWgmSg5nxg2gmQvbZz2jbmFr4ubkymCC\"}', 'http://localhost/flinnt/public/user/logout?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', NULL, '2019-05-09 06:32:14', '2019-05-09 06:32:14'),
(32, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"l8dPbbKdHJUpE6uJgx95vvFCJv5DpYbGYYB9aHWjbTBsSzCs9dqmD44PjJmm\"}', '{\"remember_token\":\"hjZWNIIRFThTjF4a3uRSgwmI6CDbgSkxjeg5YUwvdatT7D8HGG3HLbejQ5ky\"}', 'http://localhost/flinnt/public/admin/logout?_token=lwR8AOvbnDEVdOhmuHKGKhUiE01FGpMKuWSHfrko', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', NULL, '2019-05-09 06:34:04', '2019-05-09 06:34:04'),
(33, 'App\\Entities\\Institution', 1, 'updated', 'App\\Entities\\Institution', 1, '{\"remember_token\":\"Bf7qmRDBfgJ3cbaIYg5iJ8Y2AGDz2B39xqQlM3BpmYbTFMJToSuD9f0f0YT9\"}', '{\"remember_token\":\"svEtAjVbuLP3oPjyDewFJALpl6hF5YtTALd48aiOwLUbe2X0Wtj0iG5X7a0O\"}', 'http://localhost/flinnt/public/admin/logout?_token=ubq8iuK4cQIjT15AvQAMvZEMWQ0pDmMyFu2KtbTP', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', NULL, '2019-05-17 13:44:10', '2019-05-17 13:44:10'),
(34, 'App\\Entities\\Institution', 1, 'updated', 'App\\Entities\\Institution', 1, '{\"remember_token\":\"svEtAjVbuLP3oPjyDewFJALpl6hF5YtTALd48aiOwLUbe2X0Wtj0iG5X7a0O\"}', '{\"remember_token\":\"07coljYVFfmMtbG42uvZEcb8HIU4oPu7TCvYLYrIiVmiYJGylfTEtftj7Epa\"}', 'http://localhost/flinnt/public/admin/logout?_token=ltXDMdRPXMz5494KWrqTNVrtb6TrHGZI3nnfonKS', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36', NULL, '2019-05-23 11:44:18', '2019-05-23 11:44:18'),
(35, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\OrderCourier', 1, '{\"deliver_at\":\"2019-03-07 11:36:31\"}', '{\"deliver_at\":{\"date\":\"2019-05-23 17:14:41.994905\",\"timezone_type\":3,\"timezone\":\"Asia\\/Kolkata\"}}', 'http://localhost/flinnt/public/admin/courier/update?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36', NULL, '2019-05-23 11:44:42', '2019-05-23 11:44:42'),
(36, 'App\\Entities\\Vendor', 1, 'created', 'App\\Entities\\OrderCourier', 3, '[]', '{\"order_id\":\"21\",\"courier_id\":\"3\",\"docket_number\":\"12212\",\"status_id\":\"1\",\"user_id\":7108,\"vendor_id\":1,\"send_at\":{\"date\":\"2019-05-23 17:14:57.568462\",\"timezone_type\":3,\"timezone\":\"Asia\\/Kolkata\"},\"order_courier_id\":3}', 'http://localhost/flinnt/public/admin/courier/update?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36', NULL, '2019-05-23 11:44:57', '2019-05-23 11:44:57'),
(37, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\OrderCourier', 3, '{\"docket_number\":\"12212\",\"send_at\":\"2019-05-23 17:14:57\"}', '{\"docket_number\":\"12213\",\"send_at\":{\"date\":\"2019-05-23 17:15:12.978902\",\"timezone_type\":3,\"timezone\":\"Asia\\/Kolkata\"}}', 'http://localhost/flinnt/public/admin/courier/update?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36', NULL, '2019-05-23 11:45:13', '2019-05-23 11:45:13'),
(38, 'App\\Entities\\Institution', 1, 'updated', 'App\\Entities\\Institution', 1, '{\"remember_token\":\"07coljYVFfmMtbG42uvZEcb8HIU4oPu7TCvYLYrIiVmiYJGylfTEtftj7Epa\"}', '{\"remember_token\":\"YOs0xCwTm3c8tIhmcwJcPpjCgKbocNDn5DtswQvsXcL9FmsAaXZ57nHxfNiX\"}', 'http://localhost/flinnt/public/admin/logout?_token=0GnHQJOpnRLEnMNgekju8WijyxFxwdG7jhXUS2OJ', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36', NULL, '2019-05-23 12:17:17', '2019-05-23 12:17:17'),
(39, 'App\\Entities\\Institution', 1, 'updated', 'App\\Entities\\Institution', 1, '{\"remember_token\":\"YOs0xCwTm3c8tIhmcwJcPpjCgKbocNDn5DtswQvsXcL9FmsAaXZ57nHxfNiX\"}', '{\"remember_token\":\"cOrhpw8EivYRtdnHi4tkRvforykc8MoWAU0hCsmCDhk010JVrDQbp1ZJIdVY\"}', 'http://localhost/flinnt/public/admin/logout?_token=YALOsoUu9C0NOSjgbT5ftAtBvo0GUHp61ESmVjEK', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-24 04:10:11', '2019-05-24 04:10:11'),
(40, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"hjZWNIIRFThTjF4a3uRSgwmI6CDbgSkxjeg5YUwvdatT7D8HGG3HLbejQ5ky\"}', '{\"remember_token\":\"DSMXFmnhZ0aBag69sTm4m3VwhUR9fZC2KNDTxdMKTPHuEtNkgpP4k6ZjbFND\"}', 'http://localhost/flinnt/public/admin/logout?_token=UBVx3Bk1BpD9XXWI9pjJuc3ADyD39ZNkMXnOr1Px', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-24 06:49:36', '2019-05-24 06:49:36'),
(41, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"DSMXFmnhZ0aBag69sTm4m3VwhUR9fZC2KNDTxdMKTPHuEtNkgpP4k6ZjbFND\"}', '{\"remember_token\":\"VPI1wZiKQzVKaoV9NFzhibZvrOjqfJEeOVne9rKgEamSnOT3uw3xm7vX77DM\"}', 'http://localhost/flinnt/public/admin/logout?_token=KNn42jOYUbMu7uYeuGxlIWLQiUEQ3lz3miGJN3uO', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-24 06:50:41', '2019-05-24 06:50:41'),
(42, 'App\\Entities\\Institution', 1, 'updated', 'App\\Entities\\Institution', 1, '{\"remember_token\":\"cOrhpw8EivYRtdnHi4tkRvforykc8MoWAU0hCsmCDhk010JVrDQbp1ZJIdVY\"}', '{\"remember_token\":\"SUaFH0jEfevz6orI8mDqmCxCw5nxw0vH5KmkhmjGEYcr2K9BSFMiLpyIUKYr\"}', 'http://localhost/flinnt/public/admin/logout?_token=fZWm6IWTw5wkOlFEid2MrAjC6MrhElU7pcfKXrwK', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-24 06:51:26', '2019-05-24 06:51:26'),
(43, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"VPI1wZiKQzVKaoV9NFzhibZvrOjqfJEeOVne9rKgEamSnOT3uw3xm7vX77DM\"}', '{\"remember_token\":\"h6oCFOSfqbatx3KAiZOtk9TR1rzTkLj9ejvtE280h7AyIqP1DyBbKENpy1kn\"}', 'http://localhost/flinnt/public/admin/logout?_token=rra82XdWQ8WaGQZ9UtmoOwbS8aVG3tu5v11Xz2bR', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-24 10:33:48', '2019-05-24 10:33:48'),
(44, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\OrderCourier', 1, '{\"vendor_id\":1,\"deliver_at\":\"2019-05-23 17:14:41\"}', '{\"vendor_id\":null,\"deliver_at\":{\"date\":\"2019-05-24 16:10:31.012979\",\"timezone_type\":3,\"timezone\":\"Asia\\/Kolkata\"}}', 'http://localhost/flinnt/public/admin/courier/update?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-24 10:40:31', '2019-05-24 10:40:31'),
(45, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\OrderCourier', 1, '{\"vendor_id\":0,\"status_id\":2,\"send_at\":\"2019-03-07 11:36:31\"}', '{\"vendor_id\":null,\"status_id\":\"1\",\"send_at\":{\"date\":\"2019-05-24 16:10:44.738765\",\"timezone_type\":3,\"timezone\":\"Asia\\/Kolkata\"}}', 'http://localhost/flinnt/public/admin/courier/update?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-24 10:40:44', '2019-05-24 10:40:44'),
(46, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\OrderCourier', 1, '{\"vendor_id\":0,\"status_id\":1,\"deliver_at\":\"2019-05-24 16:10:31\"}', '{\"vendor_id\":null,\"status_id\":\"2\",\"deliver_at\":{\"date\":\"2019-05-24 16:10:49.577041\",\"timezone_type\":3,\"timezone\":\"Asia\\/Kolkata\"}}', 'http://localhost/flinnt/public/admin/courier/update?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-24 10:40:49', '2019-05-24 10:40:49'),
(47, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\OrderCourier', 1, '{\"vendor_id\":0,\"deliver_at\":\"2019-05-24 16:10:49\"}', '{\"vendor_id\":null,\"deliver_at\":{\"date\":\"2019-05-24 16:11:00.243651\",\"timezone_type\":3,\"timezone\":\"Asia\\/Kolkata\"}}', 'http://localhost/flinnt/public/admin/courier/update?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-24 10:41:00', '2019-05-24 10:41:00'),
(48, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\OrderCourier', 3, '{\"vendor_id\":1,\"send_at\":\"2019-05-23 17:15:12\"}', '{\"vendor_id\":null,\"send_at\":{\"date\":\"2019-05-24 16:13:47.791235\",\"timezone_type\":3,\"timezone\":\"Asia\\/Kolkata\"}}', 'http://localhost/flinnt/public/admin/courier/update?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-24 10:43:47', '2019-05-24 10:43:47'),
(49, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"h6oCFOSfqbatx3KAiZOtk9TR1rzTkLj9ejvtE280h7AyIqP1DyBbKENpy1kn\"}', '{\"remember_token\":\"OxOHyBSj5IDW1dwEkvKibQb4PNbm3r6OS6Hr55uPBuBXo2D2KOhMFdfqNIMb\"}', 'http://localhost/flinnt/public/admin/logout?_token=PkDcvQCNba6yW0i81WzPnJTCyrfs9tlI7jzvnuZc', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-24 11:49:23', '2019-05-24 11:49:23'),
(50, 'App\\Entities\\Institution', 1, 'updated', 'App\\Entities\\Institution', 1, '{\"remember_token\":\"SUaFH0jEfevz6orI8mDqmCxCw5nxw0vH5KmkhmjGEYcr2K9BSFMiLpyIUKYr\"}', '{\"remember_token\":\"AqmeoiSI9yMkISTJxCwZUfqf3oi0EUaobxPHMwTSafp0cF4pi5sJxariPNKA\"}', 'http://localhost/flinnt/public/admin/logout?_token=1xmcxk1dRXeSL1ihIhiArqANULQy0WeW7nAPGwow', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-24 13:34:28', '2019-05-24 13:34:28'),
(51, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"OxOHyBSj5IDW1dwEkvKibQb4PNbm3r6OS6Hr55uPBuBXo2D2KOhMFdfqNIMb\"}', '{\"remember_token\":\"NysEnWVvDuriQbLaRtewjbkgWQm4W54eRgc1MQDxGQADLTFEBou90sdM7LUR\"}', 'http://localhost/flinnt/public/admin/logout?_token=3qrvilgjBmdDqhv4Jbzoq2w1uqvCQl6jpDU37LMh', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-24 13:45:54', '2019-05-24 13:45:54'),
(52, 'App\\Entities\\Institution', 1, 'updated', 'App\\Entities\\Institution', 1, '{\"remember_token\":\"AqmeoiSI9yMkISTJxCwZUfqf3oi0EUaobxPHMwTSafp0cF4pi5sJxariPNKA\"}', '{\"remember_token\":\"x0w4jfysFtI0ZeGT43AOr9d2xbWk0dmppOebyB3K2cHEBWKMQZBQdmOs3rpX\"}', 'http://localhost/flinnt/public/admin/logout?_token=gOHE7rN2NBV9GnpVie0xWSoOwf4BosmAaCaGBv18', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-27 09:06:25', '2019-05-27 09:06:25'),
(53, 'App\\Entities\\Institution', 1, 'updated', 'App\\Entities\\Institution', 1, '{\"remember_token\":\"x0w4jfysFtI0ZeGT43AOr9d2xbWk0dmppOebyB3K2cHEBWKMQZBQdmOs3rpX\"}', '{\"remember_token\":\"qQVSRyauReiwDWdmhK9tqpn9UhsCwY5ra9EjvAjF4hmpQFXvB6rusSx6f1KI\"}', 'http://localhost/flinnt/public/admin/logout?_token=hXxpIM6Z8H9zB9HJfApyMGH7palXcSIwcwSHQGEy', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-28 03:53:38', '2019-05-28 03:53:38'),
(54, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"NysEnWVvDuriQbLaRtewjbkgWQm4W54eRgc1MQDxGQADLTFEBou90sdM7LUR\"}', '{\"remember_token\":\"z2i7N0GYUhwaXbtPxEAIiShNVshGvA2BKijgXSfWHur5KrCW4Q8L9hHBqUN4\"}', 'http://localhost/flinnt/public/admin/logout?_token=H1j0zjEoaAV0RKXi2D2beVSnlCejzQchDIJYsB7q', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-28 09:58:33', '2019-05-28 09:58:33'),
(55, 'App\\Entities\\Institution', 1, 'updated', 'App\\Entities\\Institution', 1, '{\"remember_token\":\"qQVSRyauReiwDWdmhK9tqpn9UhsCwY5ra9EjvAjF4hmpQFXvB6rusSx6f1KI\"}', '{\"remember_token\":\"UPNqnOZ7KOEzUftXQqMqpIfW7KSssnkGiAfiUr2624ax0QREUB6fvdr6MAI5\"}', 'http://localhost/flinnt/public/admin/logout?_token=uWEeBNtW7Qa5tGIhcUOxhyRj1yXhiqP9EVUxMY9B', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-28 12:09:19', '2019-05-28 12:09:19'),
(56, 'App\\Entities\\User', 7107, 'updated', 'App\\Entities\\Order', 23, '{\"transaction_id\":\"1554298424\"}', '{\"transaction_id\":1559047640}', 'http://localhost/flinnt/public/order/tryAgain/23?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-28 12:47:20', '2019-05-28 12:47:20'),
(57, 'App\\Entities\\User', 7107, 'updated', 'App\\Entities\\User', 7107, '{\"remember_token\":\"ydXIVMQXsEwMtym1jIxhqT8XQyFXiWgmSg5nxg2gmQvbZz2jbmFr4ubkymCC\"}', '{\"remember_token\":\"TFHzHqo7XOAJ6Y4v6uLwyWBsolwdZgvOS7St8G1fyzDsAdU4wF2AU9TNIp7u\"}', 'http://localhost/flinnt/public/admin/login?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-28 13:02:58', '2019-05-28 13:02:58'),
(58, 'App\\Entities\\User', 7107, 'created', 'App\\Entities\\Order', 26, '[]', '{\"user_id\":7107,\"institution_id\":15,\"shipping_address_id\":\"15\",\"order_number\":\"190529112953\",\"order_qty\":1,\"order_total_price\":\"1099.00\",\"transaction_id\":1559109593,\"order_status\":1,\"order_date\":{\"date\":\"2019-05-29 11:29:53.190204\",\"timezone_type\":3,\"timezone\":\"Asia\\/Kolkata\"},\"is_active\":1,\"order_id\":26}', 'http://localhost/flinnt/public/order/checkout/process?terms=on&shipping_address_id=15&place_order=Place%20order', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-29 05:59:53', '2019-05-29 05:59:53'),
(59, 'App\\Entities\\User', 7107, 'created', 'App\\Entities\\OrderDetail', 35, '[]', '{\"order_id\":26,\"product_id\":\"12\",\"vendor_id\":4,\"product_name\":\"Mittal product for gujarat board standard 1\",\"product_type\":1,\"sale_price\":1099,\"qty\":\"1\",\"discount_id\":1,\"discount_price\":0,\"final_price\":\"1099.00\",\"order_detail_id\":35}', 'http://localhost/flinnt/public/order/checkout/process?terms=on&shipping_address_id=15&place_order=Place%20order', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-29 05:59:53', '2019-05-29 05:59:53'),
(60, 'App\\Entities\\User', 7107, 'created', 'App\\Entities\\Order', 27, '[]', '{\"user_id\":7107,\"institution_id\":15,\"shipping_address_id\":\"15\",\"order_number\":\"190529113822\",\"order_qty\":1,\"order_total_price\":\"1099.00\",\"transaction_id\":1559110102,\"order_status\":1,\"order_date\":{\"date\":\"2019-05-29 11:38:22.710282\",\"timezone_type\":3,\"timezone\":\"Asia\\/Kolkata\"},\"is_active\":1,\"order_id\":27}', 'http://localhost/flinnt/public/order/checkout/process?terms=on&shipping_address_id=15&place_order=Place%20order', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-29 06:08:22', '2019-05-29 06:08:22'),
(61, 'App\\Entities\\User', 7107, 'created', 'App\\Entities\\OrderDetail', 36, '[]', '{\"order_id\":27,\"product_id\":\"12\",\"vendor_id\":4,\"product_name\":\"Mittal product for gujarat board standard 1\",\"product_type\":1,\"sale_price\":1099,\"qty\":1,\"discount_id\":1,\"discount_price\":0,\"final_price\":\"1099.00\",\"order_detail_id\":36}', 'http://localhost/flinnt/public/order/checkout/process?terms=on&shipping_address_id=15&place_order=Place%20order', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-29 06:08:22', '2019-05-29 06:08:22'),
(62, 'App\\Entities\\User', 7107, 'updated', 'App\\Entities\\User', 7107, '{\"remember_token\":\"TFHzHqo7XOAJ6Y4v6uLwyWBsolwdZgvOS7St8G1fyzDsAdU4wF2AU9TNIp7u\"}', '{\"remember_token\":\"UKXBjDZhLj64rRIRM8D0bMvcv4nZ8gFWppPpLg5UbXF7iIKMaD06506I2HBj\"}', 'http://localhost/flinnt/public/admin/login?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-29 09:20:51', '2019-05-29 09:20:51'),
(63, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"z2i7N0GYUhwaXbtPxEAIiShNVshGvA2BKijgXSfWHur5KrCW4Q8L9hHBqUN4\"}', '{\"remember_token\":\"1acEBqmYkvvX42mBjjo21lPwzWHcEknRnR8NFkgJSCDDTiglpajiThlM58c1\"}', 'http://localhost/flinnt/public/admin/logout?_token=1zTAKo26kWKFqWoMho5ryGU1t7Meu1vJL0ZBJi6J', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-29 09:21:10', '2019-05-29 09:21:10'),
(64, 'App\\Entities\\User', 7107, 'updated', 'App\\Entities\\User', 7107, '{\"remember_token\":\"UKXBjDZhLj64rRIRM8D0bMvcv4nZ8gFWppPpLg5UbXF7iIKMaD06506I2HBj\"}', '{\"remember_token\":\"g1mM1pqYewQAKjHucmIVILkZtrjruym1jwVItHnjOu9dVZ2y9MAW314pacrb\"}', 'http://localhost/flinnt/public/admin/login?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-29 10:45:47', '2019-05-29 10:45:47'),
(65, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"1acEBqmYkvvX42mBjjo21lPwzWHcEknRnR8NFkgJSCDDTiglpajiThlM58c1\"}', '{\"remember_token\":\"lb0cbOIlN72kUDEr6Wpq4KqegnrwZ7aQEJCiqLwDxiEJr5m7LLqUjyrvkKNA\"}', 'http://localhost/flinnt/public/admin/logout?_token=2oISyItXfiOlTMQk55bShOfzqMPzn5UOOiNAg672', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-29 10:50:53', '2019-05-29 10:50:53'),
(66, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"lb0cbOIlN72kUDEr6Wpq4KqegnrwZ7aQEJCiqLwDxiEJr5m7LLqUjyrvkKNA\"}', '{\"remember_token\":\"ifnfVVQIwBTAYJRv4LRO8Sx5qtZ16xYh75lkXZIfFzACMl5kbO0ClEEOGUv4\"}', 'http://localhost/flinnt/public/admin/logout?_token=FLFWurhmM5emNwdWvulx1F2ozQAtGBeOOVOwXDGa', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-29 11:42:34', '2019-05-29 11:42:34'),
(67, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"ifnfVVQIwBTAYJRv4LRO8Sx5qtZ16xYh75lkXZIfFzACMl5kbO0ClEEOGUv4\"}', '{\"remember_token\":\"LGU10tQDDvPXaNRJmQneGf3bmwEx7FO45pzx2ZNWDx8RmILX7XEjeiwVkKnY\"}', 'http://localhost/flinnt/public/admin/logout?_token=CP8LyYCuLIpDiZzOayyCAfvKNgoZrqu0cMjaZn13', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-29 13:33:39', '2019-05-29 13:33:39'),
(68, 'App\\Entities\\User', 7107, 'updated', 'App\\Entities\\User', 7107, '{\"remember_token\":\"g1mM1pqYewQAKjHucmIVILkZtrjruym1jwVItHnjOu9dVZ2y9MAW314pacrb\"}', '{\"remember_token\":\"bFz49acL3WbhxHmmTHFBn7nWbUuZ5TC1pqUIRDJ3Gp1RKiDdrDioTC1hwJny\"}', 'http://localhost/flinnt/public/admin/login?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-29 13:43:45', '2019-05-29 13:43:45'),
(69, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"LGU10tQDDvPXaNRJmQneGf3bmwEx7FO45pzx2ZNWDx8RmILX7XEjeiwVkKnY\"}', '{\"remember_token\":\"YfdYxBhXfro3o06hUr1aXWTtLTfYywxKqtv2pM2BDXYZijB8RA6gLLHJUej9\"}', 'http://localhost/flinnt/public/admin/logout?_token=SOJ4VjVN25SFTVN2XskOApRGn5vYXg5jPzICgmeC', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-30 11:37:58', '2019-05-30 11:37:58'),
(70, 'App\\Entities\\Institution', 1, 'updated', 'App\\Entities\\Institution', 1, '{\"remember_token\":\"UPNqnOZ7KOEzUftXQqMqpIfW7KSssnkGiAfiUr2624ax0QREUB6fvdr6MAI5\"}', '{\"remember_token\":\"WkWh3rbcaPKkb2f0hCk4v6LAyYjmFLsTK4jIk5Ug9yANQ1tEIUxGOZjGSDj9\"}', 'http://localhost/flinnt/public/admin/logout?_token=1PGMyCfOQPdb3lfCg6aKT28yBQP2FaMKDd0uiKgc', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-30 13:15:47', '2019-05-30 13:15:47'),
(71, 'App\\Entities\\User', 7107, 'updated', 'App\\Entities\\User', 7107, '{\"remember_token\":\"bFz49acL3WbhxHmmTHFBn7nWbUuZ5TC1pqUIRDJ3Gp1RKiDdrDioTC1hwJny\"}', '{\"remember_token\":\"CFfuzgDBXWdNLkqfOs6gOd56LPvtZDutxDRyaqBtzqZ1gn6u3SxNbLA3eeAQ\"}', 'http://localhost/flinnt/public/user/logout?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-05-31 09:13:46', '2019-05-31 09:13:46'),
(72, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"YfdYxBhXfro3o06hUr1aXWTtLTfYywxKqtv2pM2BDXYZijB8RA6gLLHJUej9\"}', '{\"remember_token\":\"H97UtaHlItbpsSL9a4xVpbUSr6xgw3Jtmn83dVdXnRfGvEkFwCTz0Gh0tpld\"}', 'http://localhost/flinnt/public/admin/logout?_token=yBnwGc5cvlAqIScZLRTXdHgWaJAr87goI9Jin9hq', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-03 04:32:02', '2019-06-03 04:32:02'),
(73, 'App\\Entities\\Institution', 1, 'updated', 'App\\Entities\\Institution', 1, '{\"remember_token\":\"WkWh3rbcaPKkb2f0hCk4v6LAyYjmFLsTK4jIk5Ug9yANQ1tEIUxGOZjGSDj9\"}', '{\"remember_token\":\"dlFv68GCxglCFxkz9zLE4yYtg1Wr2dsSC017lHk1w2dBD3qwJQWJKQ7Ix72j\"}', 'http://localhost/flinnt/public/admin/logout?_token=d7XrIRk8PPC2Ddm7L7tg4zwlmMBIyObmIEOOXRHt', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-03 11:16:53', '2019-06-03 11:16:53'),
(74, 'App\\Entities\\Institution', 1, 'updated', 'App\\Entities\\Institution', 1, '{\"remember_token\":\"dlFv68GCxglCFxkz9zLE4yYtg1Wr2dsSC017lHk1w2dBD3qwJQWJKQ7Ix72j\"}', '{\"remember_token\":\"TAe7W87jybbD4EY7gldaUI9fku1z92I3aq8JJVKmf4juVUVydiJMgVWtRbtW\"}', 'http://localhost/flinnt/public/admin/logout?_token=G4CYBbeSIRFfkuwg0WoQLTLUKOTW6VULR1HQDinc', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-04 04:27:12', '2019-06-04 04:27:12'),
(75, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"H97UtaHlItbpsSL9a4xVpbUSr6xgw3Jtmn83dVdXnRfGvEkFwCTz0Gh0tpld\"}', '{\"remember_token\":\"OsxzFEIPHbKXX9dZu6KOgLo1uepwiX0TlkNMI6ZJOy776T59ZfZLvnHUFy6f\"}', 'http://localhost/flinnt/public/admin/logout?_token=gfaVWFqx54HUh5ikpeJONAQvZEVNTNBpOUyYY8gX', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-04 06:47:30', '2019-06-04 06:47:30'),
(76, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"OsxzFEIPHbKXX9dZu6KOgLo1uepwiX0TlkNMI6ZJOy776T59ZfZLvnHUFy6f\"}', '{\"remember_token\":\"fN5800BlvYr7SwSoJCxB9kuXanJ8NKwO4cY9s1YMU1K3R0eUfGteYry7FtI5\"}', 'http://localhost/flinnt/public/admin/logout?_token=3nruV2MJvyMAsy0Sbsb9bssn3GOhedClPUOuL46W', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-04 08:54:08', '2019-06-04 08:54:08'),
(77, 'App\\Entities\\Institution', 1, 'updated', 'App\\Entities\\Institution', 1, '{\"remember_token\":\"TAe7W87jybbD4EY7gldaUI9fku1z92I3aq8JJVKmf4juVUVydiJMgVWtRbtW\"}', '{\"remember_token\":\"s4lscZkuYO3AstaVUQeJgM3LaxBp5nn2uyihSp4NObNrRRdsIbYrJou8TI6f\"}', 'http://localhost/flinnt/public/admin/logout?_token=nMeb2CkwHEDa8Ga4ifd3POASFL51fU4S5PFiGthy', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-04 13:07:56', '2019-06-04 13:07:56'),
(78, 'App\\Entities\\Institution', 1, 'updated', 'App\\Entities\\Institution', 1, '{\"remember_token\":\"s4lscZkuYO3AstaVUQeJgM3LaxBp5nn2uyihSp4NObNrRRdsIbYrJou8TI6f\"}', '{\"remember_token\":\"ZYyaqLFE2PtvWzyO4DMQf00pnywoPlSwMY9t8NtmU6BA7zTpHGJUQavphrcq\"}', 'http://localhost/flinnt/public/admin/logout?_token=WfYa4reZ5J5FV9XgfEpwxGJ7sFUeH04v06OBGyBC', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-05 11:48:05', '2019-06-05 11:48:05'),
(79, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"fN5800BlvYr7SwSoJCxB9kuXanJ8NKwO4cY9s1YMU1K3R0eUfGteYry7FtI5\"}', '{\"remember_token\":\"iWHAIRvIBnXABrH6sCsYs2nKAEa7rK4f9dH0S9VqFqS5SzWuKfLkkrmmc5N7\"}', 'http://localhost/flinnt/public/admin/logout?_token=qbTQpLfpakwmdBPgfFj5OkcjvYaL70rS5cUmXCi0', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-06 04:06:53', '2019-06-06 04:06:53'),
(80, 'App\\Entities\\Vendor', 1, 'created', 'App\\Entities\\BookCategoryTree', 385, '[]', '{\"book_id\":\"23\",\"category_tree_id\":\"2\",\"book_category_tree_id\":385}', 'http://localhost/flinnt/public/admin/product/update/23?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-06 04:42:21', '2019-06-06 04:42:21'),
(81, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"iWHAIRvIBnXABrH6sCsYs2nKAEa7rK4f9dH0S9VqFqS5SzWuKfLkkrmmc5N7\"}', '{\"remember_token\":\"IcA33iVchjuTlZF6AHPOjGrV8f54bVZGkI3SFKRWXGlQSJ0FISPNG9IipXWG\"}', 'http://localhost/flinnt/public/admin/logout?_token=GDZScw0xD2QLSvCwfiWcrV4baiPKJ1wbxetuAQFW', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-06 05:04:25', '2019-06-06 05:04:25'),
(82, 'App\\Entities\\Institution', 1, 'updated', 'App\\Entities\\Institution', 1, '{\"remember_token\":\"ZYyaqLFE2PtvWzyO4DMQf00pnywoPlSwMY9t8NtmU6BA7zTpHGJUQavphrcq\"}', '{\"remember_token\":\"8lUzjj9T6oV8TEFgNShBZMwIcTIKnUu0xh9x0RjOxiGzjsWb5Oq7wiIveWjU\"}', 'http://localhost/flinnt/public/admin/logout?_token=YXb1sSyiqmL9yU3dqB2CM1ze0G7Fq8MQvBUN8Pe4', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-06 06:19:59', '2019-06-06 06:19:59'),
(83, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"IcA33iVchjuTlZF6AHPOjGrV8f54bVZGkI3SFKRWXGlQSJ0FISPNG9IipXWG\"}', '{\"remember_token\":\"7GfcKtxBzzCWMh88sUmqpR2ncLZoMwpl31VN0SxGDB0N6WnyBFOF06BV3T3W\"}', 'http://localhost/flinnt/public/admin/logout?_token=ZptOh5TxMJKSA8ire2W0nAa3xna6cpKNS0m1bVB8', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-07 04:20:08', '2019-06-07 04:20:08'),
(84, 'App\\Entities\\Vendor', 1, 'created', 'App\\Entities\\BookAttribute', 17, '[]', '{\"book_id\":\"21\",\"attribute_id\":\"1\",\"attribute_value\":\"ww\",\"book_attribute_id\":17}', 'http://localhost/flinnt/public/admin/attribute_ajaxstore/21?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', NULL, '2019-07-09 09:04:41', '2019-07-09 09:04:41'),
(85, 'App\\Entities\\Vendor', 1, 'deleted', 'App\\Entities\\BookAttribute', 17, '{\"book_attribute_id\":17,\"book_id\":21,\"attribute_id\":1,\"attribute_value\":\"ww\",\"is_active\":1}', '[]', 'http://localhost/flinnt/public/admin/attribute_ajaxdelete?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', NULL, '2019-07-09 09:04:50', '2019-07-09 09:04:50'),
(86, 'App\\Entities\\Vendor', 1, 'created', 'App\\Entities\\BookAttribute', 18, '[]', '{\"book_id\":\"21\",\"attribute_id\":\"1\",\"attribute_value\":\"21\",\"book_attribute_id\":18}', 'http://localhost/flinnt/public/admin/attribute_ajaxstore/21?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', NULL, '2019-07-09 09:11:53', '2019-07-09 09:11:53'),
(87, 'App\\Entities\\Vendor', 1, 'deleted', 'App\\Entities\\BookAttribute', 18, '{\"book_attribute_id\":18,\"book_id\":21,\"attribute_id\":1,\"attribute_value\":\"21\",\"is_active\":1}', '[]', 'http://localhost/flinnt/public/admin/attribute_ajaxdelete?', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', NULL, '2019-07-09 09:11:56', '2019-07-09 09:11:56'),
(88, 'App\\Entities\\Vendor', 1, 'updated', 'App\\Entities\\Vendor', 1, '{\"remember_token\":\"7GfcKtxBzzCWMh88sUmqpR2ncLZoMwpl31VN0SxGDB0N6WnyBFOF06BV3T3W\"}', '{\"remember_token\":\"EsHIBdAVVs4lT5rNuXF6l2TE05xqvGNgDquoi2ZaNlrIJoeVg7tTrnF7aX1U\"}', 'http://localhost/flinnt/public/admin/logout?_token=Lydqn1PEfXkpnVfygBbjKR0ylmdUzzyg6WRRVjv8', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', NULL, '2019-07-17 06:33:52', '2019-07-17 06:33:52');

-- --------------------------------------------------------

--
-- Table structure for table `str_author`
--

CREATE TABLE `str_author` (
  `author_id` int(10) UNSIGNED NOT NULL,
  `author_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_author` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_author`
--

INSERT INTO `str_author` (`author_id`, `author_name`, `about_author`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Amish Tripathi', 'Amish Tripathi', 1, '2018-10-23 04:53:32', '2019-04-10 11:16:01'),
(2, 'Napoleon Hill', 'Napoleon Hill', 1, '2018-10-23 06:11:08', '2018-10-23 06:11:08'),
(3, 'Chetan Bhagat', 'Chetan Bhagat', 1, '2018-10-23 06:11:14', '2018-10-23 06:11:14'),
(4, 'Manohar Pandey', 'Manohar Pandey', 1, '2018-10-23 06:11:22', '2018-10-23 06:11:22'),
(5, 'Robert T Kiyosaki', 'Robert T Kiyosaki', 1, '2018-10-23 06:11:35', '2018-10-23 06:11:35'),
(6, 'A. P. J. Abdul Kalam', 'A. P. J. Abdul Kalam', 1, '2018-10-23 06:11:46', '2018-10-23 06:11:46'),
(7, 'Robin Sharma', 'Robin Sharma', 1, '2018-10-23 06:11:57', '2018-10-23 06:11:57'),
(8, 'Kevin Missal', NULL, 1, '2018-11-15 06:53:31', '2018-11-15 06:53:31'),
(9, 'Vineet Aggarwa', NULL, 0, '2018-11-15 07:10:30', '2018-12-04 23:21:19'),
(10, 'asd', NULL, 0, '2018-12-05 01:00:31', '2018-12-05 01:00:33'),
(11, 'Ram Sivasankaran', NULL, 1, '2018-12-05 02:01:00', '2018-12-05 02:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `str_board`
--

CREATE TABLE `str_board` (
  `board_id` int(11) NOT NULL,
  `board_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_board`
--

INSERT INTO `str_board` (`board_id`, `board_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'CBSE', 1, '2018-10-23 04:54:24', '2018-10-23 04:54:24'),
(2, 'CISCE', 1, '2018-10-23 06:18:21', '2018-10-23 06:18:21'),
(3, 'Gujarat Board', 1, '2018-10-23 06:18:25', '2018-10-23 06:18:25'),
(4, 'IB', 1, '2018-10-23 06:18:35', '2018-10-23 06:18:35'),
(5, 'NTSE', 1, '2018-10-23 06:18:47', '2018-10-23 06:18:47'),
(6, 'sssss', 0, '2018-12-05 00:59:59', '2018-12-05 01:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `str_book`
--

CREATE TABLE `str_book` (
  `book_id` int(20) UNSIGNED NOT NULL,
  `publisher_id` int(10) UNSIGNED NOT NULL,
  `covertype_id` int(10) UNSIGNED DEFAULT NULL,
  `language_id` int(10) UNSIGNED DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `book_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isbn` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `series` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `format` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `book_guid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hs_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `is_academic` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `book_width` decimal(10,0) DEFAULT NULL,
  `book_length` decimal(10,0) DEFAULT NULL,
  `book_height` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_book`
--

INSERT INTO `str_book` (`book_id`, `publisher_id`, `covertype_id`, `language_id`, `subject_id`, `book_name`, `isbn`, `series`, `format`, `book_guid`, `hs_code`, `is_active`, `is_academic`, `book_width`, `book_length`, `book_height`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1, 1, 'AN INTRODUCTION TO DRAWI', '123213', '2018', 'paperback', '', 'HSCODE', 1, 0, NULL, NULL, NULL, '2018-10-23 04:56:19', '2018-12-28 05:28:03'),
(2, 2, NULL, 1, 3, 'CBSE Computer Science Chapterwise Solved Papers Class 12th', '123213', '2018', 'paperback', '', 'HSCODE', 1, 1, NULL, NULL, NULL, '2018-10-23 06:30:19', '2019-01-10 01:41:41'),
(3, 5, NULL, 2, 1, 'Rich Dad Poor Dad', '123213', '2002', 'paperback', '', 'HSCODE', 1, 1, NULL, NULL, NULL, '2018-10-23 06:32:08', '2018-12-24 00:01:34'),
(4, 2, NULL, 2, 1, 'Product 9', '348798327498237', '2002', 'paperback', '', 'HSCODE', 1, 1, NULL, NULL, NULL, '2018-10-23 06:55:41', '2018-12-24 00:01:22'),
(5, 2, NULL, 2, 0, 'Think and Grow Rich', '234234234234', '2010', '', '', 'HSCODE', 0, 1, NULL, NULL, NULL, '2018-10-24 04:03:23', '2018-10-24 04:06:06'),
(6, 2, NULL, 2, 0, 'Think and Grow Rich', '234234234234', '2010', '', '', 'HSCODE', 0, 1, NULL, NULL, NULL, '2018-10-24 04:03:54', '2018-10-24 04:06:03'),
(7, 2, NULL, 2, 1, 'Think and Grow Rich', '234234234234', '2010', 'paperback', '', 'HSCODE', 1, 1, NULL, NULL, NULL, '2018-10-24 04:04:18', '2018-12-17 03:18:49'),
(8, 1, NULL, 4, 0, 'The Power of your Subconscious Mind', '4234324324', '2015', '', '', 'HSCODE', 1, 1, NULL, NULL, NULL, '2018-10-24 07:13:57', '2018-10-24 07:13:57'),
(9, 4, NULL, 1, 1, 'Ashoka: Satrap of Taxila', '123213', '2213', 'paperback', '', '11', 1, 1, NULL, NULL, NULL, '2018-10-26 07:39:07', '2018-12-05 00:15:55'),
(10, 3, NULL, 4, 1, 'test', '123213', '112', 'paperback', '', '11', 1, 1, NULL, NULL, NULL, '2018-10-26 08:01:55', '2018-12-24 00:00:39'),
(11, 1, NULL, 1, 2, 'Satyayoddha Kalki: Eye of Brahma', '9388369157', '2018', 'paperback', '', '4649388369157', 1, 1, NULL, NULL, NULL, '2018-11-15 07:00:01', '2018-12-24 00:00:24'),
(12, 1, NULL, 1, 4, 'Bharat: The Man Who Built a Nation', '0143439987', '2017', 'kindal', '', '978-0143439981', 1, 1, NULL, NULL, NULL, '2018-11-15 07:12:12', '2019-01-25 04:32:47'),
(13, 12, NULL, 2, 1, 'The Peshwa: War of the Deceivers', '93875786582', '2018', 'paperback', '', '978-9387578654', 1, 0, NULL, NULL, NULL, '2018-12-05 02:02:21', '2018-12-05 02:02:21'),
(14, 12, NULL, 2, 1, 'The Peshwa: War of the Deceivers', '93875786582', '2018', 'paperback', '', '978-9387578654', 1, 0, NULL, NULL, NULL, '2018-12-05 02:07:26', '2018-12-05 02:07:26'),
(15, 12, NULL, 1, 1, 'The Peshwa: War of the Deceivers', '9387578658', '2018', 'paperback', '', '12', 0, 0, NULL, NULL, NULL, '2018-12-05 02:10:10', '2018-12-05 02:12:03'),
(16, 12, NULL, 1, 1, 'The Peshwa: War of the Deceivers', '9387578658', '2018', 'paperback', '', '12', 0, 0, NULL, NULL, NULL, '2018-12-05 02:10:38', '2018-12-05 02:12:07'),
(17, 12, NULL, 1, 2, 'The Peshwa: War of the Deceivers', '9387578658', '2018', 'paperback', '', '12', 1, 1, NULL, NULL, NULL, '2018-12-05 02:11:08', '2018-12-20 01:24:52'),
(18, 2, NULL, 1, 1, 'Jack Ma: A Biography of the Alibaba Billionaire', '197968815X', '2018', 'paperback', '', 'HSCODE', 1, 0, NULL, NULL, NULL, '2018-12-05 05:24:43', '2018-12-05 05:24:43'),
(19, 5, NULL, 1, 1, 'Warren Buffett: The Life and Business Lessons of Warren Buffett', '197968815X', '2018', 'hardcover', '', 'HSCODE', 1, 0, NULL, NULL, NULL, '2018-12-05 06:11:00', '2018-12-05 06:11:00'),
(20, 3, NULL, 1, 1, 'The Peshwa: The Lion and The Stallion', '123213', '2018', 'paperback', '', '11', 1, 0, NULL, NULL, NULL, '2018-12-17 03:24:32', '2018-12-17 07:27:55'),
(21, 12, NULL, 1, 1, 'ADM Systems', '123213', '2018', 'paperback', '', '11', 1, 1, NULL, NULL, NULL, '2018-12-17 07:58:47', '2018-12-17 08:30:55'),
(22, 2, NULL, 3, 1, 'ADM Systems test', '123213', '2018', 'paperback', '', '12', 1, 0, NULL, NULL, NULL, '2018-12-17 08:05:38', '2018-12-28 07:45:53'),
(23, 1, NULL, 2, 2, 'Mittal product for gujarat board standard 1', '123213', '2018', 'hardcover', '', '12', 1, 1, NULL, NULL, NULL, '2018-12-20 01:35:41', '2018-12-28 07:47:12'),
(24, 1, NULL, 4, 1, 'ADM Systems', '123213', '2018', 'kindal', '', 'HSCODE', 0, 0, NULL, NULL, NULL, '2019-02-18 03:42:51', '2019-02-18 05:20:13'),
(25, 12, NULL, 1, 1, 'admin@mailinator.com', '123213', '2018', 'paperback', '', 'HSCODE', 0, 0, NULL, NULL, NULL, '2019-02-18 05:02:55', '2019-02-18 05:23:16'),
(26, 1, NULL, 1, 1, 'Admin', '123213', '2018', 'paperback', '', '11', 1, 1, NULL, NULL, NULL, '2019-02-18 05:23:49', '2019-02-18 05:53:05'),
(27, 1, NULL, 1, 1, 'Admin', '123213', '2018', 'paperback', '', '11', 0, 0, NULL, NULL, NULL, '2019-02-18 05:24:11', '2019-02-18 05:34:02');

-- --------------------------------------------------------

--
-- Table structure for table `str_book_attribute`
--

CREATE TABLE `str_book_attribute` (
  `book_attribute_id` int(11) NOT NULL,
  `book_id` int(11) UNSIGNED NOT NULL,
  `attribute_id` int(11) UNSIGNED NOT NULL,
  `attribute_value` varchar(55) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `str_book_attribute`
--

INSERT INTO `str_book_attribute` (`book_attribute_id`, `book_id`, `attribute_id`, `attribute_value`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 8, 1, '216 pages', 1, '2018-11-14 01:44:51', '2018-11-14 01:44:51'),
(2, 2, 2, '9386867788', 1, '2018-11-14 01:45:13', '2018-11-14 01:45:13'),
(3, 4, 3, '21.5 x 14 x 1.4 cm', 1, '2018-11-14 01:45:30', '2018-11-14 01:45:30'),
(4, 4, 2, '1321313132123', 1, '2018-11-14 01:45:38', '2018-11-14 01:45:38'),
(5, 7, 1, '116 pages', 1, '2018-11-14 01:46:01', '2018-11-14 01:46:01'),
(6, 9, 1, '190 pages', 1, '2018-11-14 01:47:45', '2018-11-14 01:47:45'),
(7, 3, 1, '490 pages', 1, '2018-11-14 01:48:05', '2018-11-14 01:48:05'),
(8, 12, 1, '420 pages', 1, '2018-11-16 04:21:58', '2018-11-16 04:21:58'),
(16, 21, 1, '322', 1, '2018-12-24 05:24:54', '2018-12-24 05:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `str_book_author`
--

CREATE TABLE `str_book_author` (
  `book_author_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_book_author`
--

INSERT INTO `str_book_author` (`book_author_id`, `book_id`, `author_id`, `is_active`, `created_at`, `updated_at`) VALUES
(16, 5, 3, 1, '2018-10-24 04:03:23', '2018-10-24 04:03:23'),
(17, 6, 3, 1, '2018-10-24 04:03:54', '2018-10-24 04:03:54'),
(103, 8, 2, 1, '2018-11-16 03:41:41', '2018-11-16 03:41:41'),
(125, 15, 11, 1, '2018-12-05 02:10:10', '2018-12-05 02:10:10'),
(126, 16, 11, 1, '2018-12-05 02:10:38', '2018-12-05 02:10:38'),
(190, 18, 6, 1, '2018-12-05 06:06:49', '2018-12-05 06:06:49'),
(194, 19, 3, 1, '2018-12-17 02:05:24', '2018-12-17 02:05:24'),
(195, 7, 3, 1, '2018-12-17 03:18:49', '2018-12-17 03:18:49'),
(200, 20, 5, 1, '2018-12-17 07:27:55', '2018-12-17 07:27:55'),
(223, 17, 11, 1, '2018-12-20 01:27:08', '2018-12-20 01:27:08'),
(226, 21, 1, 1, '2018-12-20 08:15:46', '2018-12-20 08:15:46'),
(230, 11, 8, 1, '2018-12-24 00:00:24', '2018-12-24 00:00:24'),
(231, 10, 6, 1, '2018-12-24 00:00:39', '2018-12-24 00:00:39'),
(232, 9, 6, 1, '2018-12-24 00:00:50', '2018-12-24 00:00:50'),
(233, 4, 2, 1, '2018-12-24 00:01:22', '2018-12-24 00:01:22'),
(234, 4, 5, 1, '2018-12-24 00:01:22', '2018-12-24 00:01:22'),
(235, 4, 6, 1, '2018-12-24 00:01:22', '2018-12-24 00:01:22'),
(241, 1, 1, 1, '2018-12-28 05:28:09', '2018-12-28 05:28:09'),
(371, 2, 2, 1, '2019-01-10 01:41:41', '2019-01-10 01:41:41'),
(372, 2, 4, 1, '2019-01-10 01:41:41', '2019-01-10 01:41:41'),
(374, 22, 6, 1, '2019-01-22 04:01:37', '2019-01-22 04:01:37'),
(375, 3, 5, 1, '2019-01-22 04:03:09', '2019-01-22 04:03:09'),
(377, 12, 6, 1, '2019-01-25 04:32:47', '2019-01-25 04:32:47'),
(378, 24, 7, 1, '2019-02-18 03:42:51', '2019-02-18 03:42:51'),
(379, 25, 5, 1, '2019-02-18 05:02:55', '2019-02-18 05:02:55'),
(381, 27, 6, 1, '2019-02-18 05:24:11', '2019-02-18 05:24:11'),
(383, 26, 6, 1, '2019-02-18 05:54:11', '2019-02-18 05:54:11'),
(386, 23, 2, 1, '2019-06-06 04:42:21', '2019-06-06 04:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `str_book_board`
--

CREATE TABLE `str_book_board` (
  `book_board_id` int(10) UNSIGNED NOT NULL,
  `book_id` int(10) UNSIGNED NOT NULL,
  `board_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_book_board`
--

INSERT INTO `str_book_board` (`book_board_id`, `book_id`, `board_id`, `created_at`, `updated_at`) VALUES
(100, 8, 2, '2018-11-16 03:41:41', '2018-11-16 03:41:41'),
(114, 7, 2, '2018-12-17 03:18:50', '2018-12-17 03:18:50'),
(118, 17, 1, '2018-12-20 01:27:09', '2018-12-20 01:27:09'),
(121, 21, 1, '2018-12-20 08:15:47', '2018-12-20 08:15:47'),
(124, 11, 1, '2018-12-24 00:00:25', '2018-12-24 00:00:25'),
(125, 10, 2, '2018-12-24 00:00:39', '2018-12-24 00:00:39'),
(126, 9, 2, '2018-12-24 00:00:51', '2018-12-24 00:00:51'),
(127, 9, 4, '2018-12-24 00:00:51', '2018-12-24 00:00:51'),
(128, 4, 1, '2018-12-24 00:01:23', '2018-12-24 00:01:23'),
(129, 4, 2, '2018-12-24 00:01:23', '2018-12-24 00:01:23'),
(130, 4, 3, '2018-12-24 00:01:23', '2018-12-24 00:01:23'),
(135, 1, 1, '2018-12-24 00:01:59', '2018-12-24 00:01:59'),
(200, 2, 1, '2019-01-10 01:41:41', '2019-01-10 01:41:41'),
(201, 2, 2, '2019-01-10 01:41:41', '2019-01-10 01:41:41'),
(202, 2, 3, '2019-01-10 01:41:41', '2019-01-10 01:41:41'),
(205, 3, 4, '2019-01-22 04:03:09', '2019-01-22 04:03:09'),
(206, 3, 5, '2019-01-22 04:03:09', '2019-01-22 04:03:09'),
(208, 12, 1, '2019-01-25 04:32:47', '2019-01-25 04:32:47'),
(209, 12, 3, '2019-01-25 04:32:47', '2019-01-25 04:32:47'),
(211, 26, 1, '2019-02-18 05:54:12', '2019-02-18 05:54:12'),
(214, 23, 3, '2019-06-06 04:42:21', '2019-06-06 04:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `str_book_category_tree`
--

CREATE TABLE `str_book_category_tree` (
  `book_category_tree_id` bigint(20) UNSIGNED NOT NULL,
  `category_tree_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_book_category_tree`
--

INSERT INTO `str_book_category_tree` (`book_category_tree_id`, `category_tree_id`, `book_id`) VALUES
(14, 3, 5),
(15, 3, 6),
(104, 4, 8),
(105, 3, 8),
(126, 3, 15),
(127, 3, 16),
(190, 2, 18),
(194, 2, 19),
(195, 3, 7),
(200, 3, 20),
(223, 3, 17),
(226, 1, 21),
(230, 3, 11),
(231, 1, 10),
(232, 3, 9),
(233, 1, 4),
(234, 2, 4),
(235, 4, 4),
(240, 1, 1),
(370, 4, 2),
(372, 1, 22),
(373, 3, 3),
(375, 3, 12),
(376, 2, 24),
(377, 4, 24),
(378, 1, 25),
(380, 1, 27),
(382, 1, 26),
(385, 2, 23);

-- --------------------------------------------------------

--
-- Table structure for table `str_book_description`
--

CREATE TABLE `str_book_description` (
  `book_description_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `description_order` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_book_description`
--

INSERT INTO `str_book_description` (`book_description_id`, `book_id`, `description`, `description_order`, `is_active`, `created_at`, `updated_at`) VALUES
(15, 5, 'Think And Grow Rich has earned itself the reputation of being considered a textbook for actionable', 1, 1, '2018-10-24 04:03:24', '2018-10-24 04:03:24'),
(16, 5, '<p>Think And Grow Rich has earned itself the reputation of being considered a textbook for actionable techniques that can help one get better at doing anything, not just by rich and wealthy, but also by people doing wonderful work in their respective fields. There are hundreds and thousands of successful people in the world who can vouch for the contents of this book. At the time of author&rsquo;s death, about 20 million copies had already been sold. Numerous revisions have been made in the book, from time to time, to&nbsp;</p>', 2, 1, '2018-10-24 04:03:24', '2018-10-24 04:03:24'),
(17, 6, 'Think And Grow Rich has earned itself the reputation of being considered a textbook for actionable', 1, 1, '2018-10-24 04:03:54', '2018-10-24 04:03:54'),
(18, 6, '<p>Think And Grow Rich has earned itself the reputation of being considered a textbook for actionable techniques that can help one get better at doing anything, not just by rich and wealthy, but also by people doing wonderful work in their respective fields. There are hundreds and thousands of successful people in the world who can vouch for the contents of this book. At the time of author&rsquo;s death, about 20 million copies had already been sold. Numerous revisions have been made in the book, from time to time, to&nbsp;</p>', 2, 1, '2018-10-24 04:03:54', '2018-10-24 04:03:54'),
(159, 8, 'Did you know that your mind has a \'mind\' of its own? Yes! Without even realizing, our mind is often governed by another entity which is called the sub-conscious mind.', 1, 1, '2018-11-16 03:41:41', '2018-11-16 03:41:41'),
(160, 8, '<ul>\r\n	<li>ICICI and Citi: 10% off up to Rs. 2000 on min order of Rs. 2,000. Get instant discount on ICICI Credit/Debit cards and EMIs. Get cashback (by Jan 28, 2019) on Citi Credit cards and EMIs.&nbsp;<a href=\"https://www.amazon.in/gp/promotions/details/popup/A3S65GP06NKVCC\" onclick=\"return amz_js_PopWin(this.href,\'AmazonHelp\',\'width=450,height=600,resizable=1,scrollbars=1,toolbar=1,status=1\');\" target=\"AmazonHelp\">Here&#39;s how</a>&nbsp;(terms and conditions apply)</li>\r\n	<li>ICICI and Citi Bonus offer: Additional 10% cashback (by Jan 28, 2019) up to Rs. 8,000 on total purchases above Rs. 50,000 with ICICI Debit/Credit cards, EMIs and Citi Credit cards and EMIs.&nbsp;<a href=\"https://www.amazon.in/gp/promotions/details/popup/A3NDBK2966PXGB\" onclick=\"return amz_js_PopWin(this.href,\'AmazonHelp\',\'width=450,height=600,resizable=1,scrollbars=1,toolbar=1,status=1\');\" target=\"AmazonHelp\">Here&#39;s how</a>&nbsp;(terms and conditions apply)</li>\r\n	<li>No cost EMI on select credit cards(ICICI, Citi, HDFC &amp; Axis) on orders above Rs.3000, HDFC debit cards on orders above Rs.10,000 and Bajaj Finserv EMI cards on orders above Rs.4500&nbsp;<a href=\"https://www.amazon.in/gp/promotions/details/popup/A3BPP24PHDYK8N\" onclick=\"return amz_js_PopWin(this.href,\'AmazonHelp\',\'width=450,height=600,resizable=1,scrollbars=1,toolbar=1,status=1\');\" target=\"AmazonHelp\">Here&#39;s how</a>&nbsp;(terms and conditions apply)</li>\r\n	<li>Add Rs.1000 or more to your Amazon Pay balance and get 10% back upto Rs.200. Offer valid on 24th Oct 2018 only.&nbsp;<a href=\"https://www.amazon.in/gp/sva/addmoney?ref_=aps\">ADD BALANCE NOW</a>&nbsp;<a href=\"https://www.amazon.in/gp/promotions/details/popup/A1ZTHR27C37GZ1\" onclick=\"return amz_js_PopWin(this.href,\'AmazonHelp\',\'width=450,height=600,resizable=1,scrollbars=1,toolbar=1,status=1\');\" target=\"AmazonHelp\">Here&#39;s how</a>&nbsp;(terms and conditions apply)</li>\r\n	<li>Get offers for up to ₹2000 back on MakeMyTrip, Swiggy, Freshmenu &amp; EazyDiner. Shop on the Amazon app during Great Indian Festival (no min order value) &amp; pay through any prepaid payment method to become eligible | Valid from 24th - 28th Oct&#39;18&nbsp;<a href=\"https://www.amazon.in/gp/promotions/details/popup/A2MIXCQE5E0NFP\" onclick=\"return amz_js_PopWin(this.href,\'AmazonHelp\',\'width=450,height=600,resizable=1,scrollbars=1,toolbar=1,status=1\');\" target=\"AmazonHelp\">Here&#39;s how</a>&nbsp;(terms and conditions apply)</li>\r\n</ul>', 2, 1, '2018-11-16 03:41:41', '2018-11-16 03:41:41'),
(197, 15, 'Seven years have passed since Peshwa Bajirao Bhat annihilated the Nizam’s armies at Fort Mandu. The two forces have been engaged in attacks and skirmishes ever since', 1, 1, '2018-12-05 02:10:10', '2018-12-05 02:10:10'),
(198, 16, 'Seven years have passed since Peshwa Bajirao Bhat annihilated the Nizam’s armies at Fort Mandu. The two forces have been engaged in attacks and skirmishes ever since', 1, 1, '2018-12-05 02:10:38', '2018-12-05 02:10:38'),
(199, 16, NULL, 2, 1, '2018-12-05 02:10:38', '2018-12-05 02:10:38'),
(326, 18, 'Jack Ma is a Chinese business magnate who is the founder and executive chairman of Alibaba Group, a conglomerate of Internet-based businesses.', 1, 1, '2018-12-05 06:06:49', '2018-12-05 06:06:49'),
(327, 18, '<p>Jack Ma is a Chinese business magnate who is the founder and executive chairman of Alibaba Group, a conglomerate of Internet-based businesses.<br />\r\n<br />\r\nHe is one of China&#39;s richest men, as well as one of the wealthiest people in Asia. He has become a global icon in business and entrepreneurship, one of the world&#39;s most influential businessmen, and a philanthropist known for expounding his philosophy of business.<br />\r\n<br />\r\nMa is one of the world&#39;s most powerful people, and has been a global inspirer and role model to many, he also gave numerous lectures, enlightenments and advices throughout his life career.</p>', 2, 1, '2018-12-05 06:06:50', '2018-12-05 06:06:50'),
(334, 19, 'This book offers an introduction to Buffett, his business success and the lessons that we can learn from him. This is not a text book nor a biography, but more of a cheat sheet for reading on the bus or in the bathroom,', 1, 1, '2018-12-17 02:05:25', '2018-12-17 02:05:25'),
(335, 19, '<p>This book offers an introduction to Buffett, his business success and the lessons that we can learn from him. This is not a text book nor a biography, but more of a cheat sheet for reading on the bus or in the bathroom, so that you can pick out the most significant points without having to carry around a bag of weighty tomes. You can read it all in one sitting, or look up specific case studies as and when you are looking for inspiration or direction. You will learn the most significant skills and qualities that made him the most successful investor ever, plus some of his greatest investing tips.</p>', 2, 1, '2018-12-17 02:05:25', '2018-12-17 02:05:25'),
(336, 7, 'Think And Grow Rich has earned itself the reputation of being considered a textbook for actionable', 1, 1, '2018-12-17 03:18:49', '2018-12-17 03:18:49'),
(337, 7, '<p>Think And Grow Rich has earned itself the reputation of being considered a textbook for actionable techniques that can help one get better at doing anything, not just by rich and wealthy, but also by people doing wonderful work in their respective fields. There are hundreds and thousands of successful people in the world who can vouch for the contents of this book. At the time of author&rsquo;s death, about 20 million copies had already been sold. Numerous revisions have been made in the book, from time to time, to&nbsp;</p>', 2, 1, '2018-12-17 03:18:49', '2018-12-17 03:18:49'),
(346, 20, 'An introduction to drawi', 1, 1, '2018-12-17 07:27:55', '2018-12-17 07:27:55'),
(347, 20, '<p>It is the 18th century and despite the dominant Mughal rule, the Maratha Confederacy has established itself as a force to be reckoned with in the Indian Subcontinent. The fragile peace between the two powers is threatened when Balaji Vishvanath Bhat, Peshwa of the Confederacy, foils the plans of Nizam Ul Mulk of the Mughal Empire, and asserts the power of the Marathas. However, little does the Peshwa know that he has dealt the Nizam an unintended wound&mdash;one with roots in his mysterious past and one that he would seek to avenge till his last breath.</p>\r\n\r\n<p>When the Peshwa surrenders his life to a terminal illness dark clouds gather over the Confederacy as it is threatened by a Mughal invasion as well as an internal rebellion.</p>\r\n\r\n<p>All the while a passive spectator, the Peshwa&rsquo;s son, Bajirao Bhat, now needs to rise beyond the grief of his father&rsquo;s passing, his scant military and administrative experience, and his intense love for his wife and newborn son to rescue everything he holds dear. Will the young man be able to protect the Confederacy from internal strife and crush the armies of the Empire all while battling inner demons? Will he live up to his title of Peshwa?</p>', 2, 1, '2018-12-17 07:27:56', '2018-12-17 07:27:56'),
(392, 17, 'Seven years have passed since Peshwa Bajirao Bhat annihilated the Nizam’s armies at Fort Mandu. The two forces have been engaged in attacks and skirmishes ever since', 1, 1, '2018-12-20 01:27:08', '2018-12-20 01:27:08'),
(393, 17, NULL, 2, 1, '2018-12-20 01:27:08', '2018-12-20 01:27:08'),
(398, 21, 'An introduction to drawi', 1, 1, '2018-12-20 08:15:47', '2018-12-20 08:15:47'),
(399, 21, NULL, 2, 1, '2018-12-20 08:15:47', '2018-12-20 08:15:47'),
(406, 11, 'Kevin Missal is a twenty-two year old graduate of St. Stephen’s College. He has previously released the first book of the Kalki Trilogy, Dharmayoddha Kalki: Avatar of Vishnu, which became a National best-seller and received praise from newspapers such as Millennium Post and Sunday Guardian who have termed it as \"2017’s mythological phenomenon\". Kevin loves reading, watching films, and building stories in his mind. He lives in New Delhi.', 1, 1, '2018-12-24 00:00:24', '2018-12-24 00:00:24'),
(407, 11, '<p>After a defeat at the hands of Lord Kali, Kalki Hari must journey towards the Mahendragiri mountains with his companions to finally become the avatar he is destined to be. But the road ahead is not without peril . . .</p>\r\n\r\n<p>Not only is he trapped by the cannibalistic armies of the Pisach, he is also embroiled in the civil war of the Vanars. And in midst of all this, he meets a face from the legends.</p>\r\n\r\n<p>Meanwhile, Manasa, the sister of the late Vasuki, plots to overthrow Lord Kali by bringing a massive war to his kingdom. But Naagpuri, her homeland, has been infiltrated by their sworn enemy, the Suparns. Not only does she need to protect her kingdom from the Suparns, she must also protect her close ones from the league of conspirators at her own home. Who can she really trust? And will she be able to put an end to Lord Kali&rsquo;s rule?</p>\r\n\r\n<p>As the plot thickens and Lord Kali sees his ambition crushed right before his eyes, he comes to know about his race and its history that threatens to destroy the very fabric of this world&rsquo;s reality. Kalyug has begun.</p>\r\n\r\n<p><br />\r\nCan Kalki become the avatar in time before it finally unfolds?&nbsp;<br />\r\nWill Manasa fight through the internal politics to bring an invasion against Lord Kali?&nbsp;<br />\r\nCan the secret that changes everything change Lord Kali as a person too?</p>', 2, 1, '2018-12-24 00:00:24', '2018-12-24 00:00:24'),
(408, 10, '121', 1, 1, '2018-12-24 00:00:39', '2018-12-24 00:00:39'),
(409, 10, '<p>21</p>', 2, 1, '2018-12-24 00:00:39', '2018-12-24 00:00:39'),
(410, 9, 'Ashoka has been dispatched to accompany his brother Sushim to Taxila. But when he sees the brutality and disrespect to Mauryavansh by the Pashtun rebels, he cannot stay silent. His sword is as quick as his temper, and the result is swift and bloody justice. Taxila is saved—but the Emperor is furious.', 1, 1, '2018-12-24 00:00:51', '2018-12-24 00:00:51'),
(411, 9, '<ul>\r\n	<li>ICICI and Citi: 10% off up to Rs. 2000 on min order of Rs. 2,000. Get instant discount on ICICI Credit/Debit cards and EMIs. Get cashback (by Jan 28, 2019) on Citi Credit cards and EMIs.&nbsp;<a href=\"https://www.amazon.in/gp/promotions/details/popup/A3S65GP06NKVCC\" onclick=\"return amz_js_PopWin(this.href,\'AmazonHelp\',\'width=450,height=600,resizable=1,scrollbars=1,toolbar=1,status=1\');\" target=\"AmazonHelp\">Here&#39;s how</a>&nbsp;(terms and conditions apply)</li>\r\n	<li>ICICI and Citi Bonus offer: Additional 10% cashback (by Jan 28, 2019) up to Rs. 8,000 on total purchases above Rs. 50,000 with ICICI Debit/Credit cards, EMIs and Citi Credit cards and EMIs.&nbsp;<a href=\"https://www.amazon.in/gp/promotions/details/popup/A3NDBK2966PXGB\" onclick=\"return amz_js_PopWin(this.href,\'AmazonHelp\',\'width=450,height=600,resizable=1,scrollbars=1,toolbar=1,status=1\');\" target=\"AmazonHelp\">Here&#39;s how</a>&nbsp;(terms and conditions apply)</li>\r\n	<li>No cost EMI on select credit cards(ICICI, Citi, HDFC &amp; Axis) on orders above Rs.3000, HDFC debit cards on orders above Rs.10,000 and Bajaj Finserv EMI cards on orders above Rs.4500&nbsp;<a href=\"https://www.amazon.in/gp/promotions/details/popup/A3BPP24PHDYK8N\" onclick=\"return amz_js_PopWin(this.href,\'AmazonHelp\',\'width=450,height=600,resizable=1,scrollbars=1,toolbar=1,status=1\');\" target=\"AmazonHelp\">Here&#39;s how</a>&nbsp;(terms and conditions apply)</li>\r\n	<li>Get offers for up to ₹2000 back on MakeMyTrip, Swiggy, Freshmenu &amp; EazyDiner. Shop on the Amazon app during Great Indian Festival (no min order value) &amp; pay through any prepaid payment method to become eligible | Valid from 24th - 28th Oct&#39;18&nbsp;<a href=\"https://www.amazon.in/gp/promotions/details/popup/A2MIXCQE5E0NFP\" onclick=\"return amz_js_PopWin(this.href,\'AmazonHelp\',\'width=450,height=600,resizable=1,scrollbars=1,toolbar=1,status=1\');\" target=\"AmazonHelp\">Here&#39;s how</a>&nbsp;(terms and conditions apply)</li>\r\n	<li>Go Cashless: Get 50% cashback up to Rs. 100 on your first online payment. Pay using ATM card or credit card. Offer period 1st October to 31st October. Cashback will be credited as Amazon Pay balance within 15 days from purchase.&nbsp;<a href=\"https://www.amazon.in/gp/promotions/details/popup/A937BTP3W9NO4\" onclick=\"return amz_js_PopWin(this.href,\'AmazonHelp\',\'width=450,height=600,resizable=1,scrollbars=1,toolbar=1,status=1\');\" target=\"AmazonHelp\">Here&#39;s how</a>&nbsp;(terms and conditions apply)</li>\r\n	<li>Go Cashless: Get 10% cashback up to Rs. 50 using BHIM UPI or RuPay cards. Offer period October 1st to October 31st. Cashback will be credited as Amazon Pay balance within 15 calendar days from purchase.&nbsp;<a href=\"https://www.amazon.in/gp/promotions/details/popup/A1B2PKLW15U7W5\" onclick=\"return amz_js_PopWin(this.href,\'AmazonHelp\',\'width=450,height=600,resizable=1,scrollbars=1,toolbar=1,status=1\');\" target=\"AmazonHelp\">Here&#39;s how</a>&nbsp;(terms and conditions apply)</li>\r\n</ul>', 2, 1, '2018-12-24 00:00:51', '2018-12-24 00:00:51'),
(412, 4, 'TEst', 1, 1, '2018-12-24 00:01:22', '2018-12-24 00:01:22'),
(413, 4, '<p>test</p>', 2, 1, '2018-12-24 00:01:22', '2018-12-24 00:01:22'),
(422, 1, 'An introduction to drawi', 1, 1, '2018-12-28 05:28:09', '2018-12-28 05:28:09'),
(423, 1, '<p>An introduction to drawi</p>', 2, 1, '2018-12-28 05:28:09', '2018-12-28 05:28:09'),
(682, 2, 'CBSE Computer Science Chapterwise Solved Papers Class 12th  (English, Paperback, Arihant Expert)', 1, 1, '2019-01-10 01:41:41', '2019-01-10 01:41:41'),
(683, 2, '<p>CBSE Computer Science Chapterwise Solved Papers Class 12th &nbsp;(English, Paperback, Arihant Expert)</p>', 2, 1, '2019-01-10 01:41:41', '2019-01-10 01:41:41'),
(686, 22, 'An introduction to drawi', 1, 1, '2019-01-22 04:01:37', '2019-01-22 04:01:37'),
(687, 22, NULL, 2, 1, '2019-01-22 04:01:37', '2019-01-22 04:01:37'),
(688, 3, 'Rich Dad Poor Dad: What the Rich Teach their Kids About Money that the Poor and Middle Class Do Not!', 1, 1, '2019-01-22 04:03:09', '2019-01-22 04:03:09'),
(689, 3, '<h1>Rich Dad Poor Dad: What the Rich Teach their Kids About Money that the Poor and Middle Class Do Not!&nbsp;</h1>', 2, 1, '2019-01-22 04:03:09', '2019-01-22 04:03:09'),
(692, 12, 'After Vishwamitra and The Legend of Parshu-Raam, comes the epic saga of the king of Bharatvarsh! The kingdoms of Nabhi-varsh lie scattered in the wake of Parshu-Raam\'s assault on corrupt Kshatriyas.', 1, 1, '2019-01-25 04:32:47', '2019-01-25 04:32:47'),
(693, 12, '<p>After Vishwamitra and The Legend of Parshu-Raam, comes the epic saga of the king of Bharatvarsh!<br />\r\nThe kingdoms of Nabhi-varsh lie scattered in the wake of Parshu-Raam&#39;s assault on corrupt Kshatriyas. While evil has been wiped out from the land, the important task of nation-building remains. In the forest of Naimish-Aranya, the stunned king of Hastinapur watches a young boy play with lion cubs. Who is this fearless child? How does his destiny entwine with that of this ancient kingdom? Will he be able to bring order to the nation and defend it against the invaders lining up at its borders? Reimagined brilliantly, this novel tells the story of the son of Dushyant and Shakuntala, the grandson of Brahmarishi Vishwamitra, the man who changed the destiny of our country and gave it a brand new name-Bharat!</p>', 2, 1, '2019-01-25 04:32:47', '2019-01-25 04:32:47'),
(694, 24, 'An introduction to drawi', 1, 1, '2019-02-18 03:42:51', '2019-02-18 03:42:51'),
(695, 24, NULL, 2, 1, '2019-02-18 03:42:51', '2019-02-18 03:42:51'),
(696, 25, 'An introduction to drawi', 1, 1, '2019-02-18 05:02:55', '2019-02-18 05:02:55'),
(697, 25, NULL, 2, 1, '2019-02-18 05:02:55', '2019-02-18 05:02:55'),
(700, 27, 'Standard 1\'s subjects are English and math', 1, 1, '2019-02-18 05:24:11', '2019-02-18 05:24:11'),
(701, 27, NULL, 2, 1, '2019-02-18 05:24:11', '2019-02-18 05:24:11'),
(704, 26, 'Standard 1\'s subjects are English and math', 1, 1, '2019-02-18 05:54:11', '2019-02-18 05:54:11'),
(705, 26, NULL, 2, 1, '2019-02-18 05:54:11', '2019-02-18 05:54:11'),
(710, 23, 'Standard 1\'s subjects are hindi and math', 1, 1, '2019-06-06 04:42:21', '2019-06-06 04:42:21'),
(711, 23, '<p>Standard 1&#39;s subjects are hindi and math</p>', 2, 1, '2019-06-06 04:42:21', '2019-06-06 04:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `str_book_image`
--

CREATE TABLE `str_book_image` (
  `book_image_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `book_image_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_image_path` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_image_order` int(11) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Yes, 0 = No',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_book_image`
--

INSERT INTO `str_book_image` (`book_image_id`, `book_id`, `book_image_name`, `book_image_path`, `book_image_order`, `is_primary`, `is_active`, `created_at`, `updated_at`) VALUES
(76, 10, '1542351408.jpg', '10/1542351408.jpg', 1, 0, 1, '2018-11-16 01:26:49', '2018-11-16 03:43:40'),
(81, 7, '1542351564.jpeg', '7/1542351564.jpeg', 1, 0, 1, '2018-11-16 01:29:24', '2018-11-16 03:41:55'),
(90, 11, '1542359443.jpg', '11/1542359443.jpg', 1, 1, 1, '2018-11-16 03:40:43', '2018-11-16 03:40:43'),
(91, 9, '1542359481.jpg', '9/1542359481.jpg', 1, 1, 1, '2018-11-16 03:41:21', '2018-11-16 03:41:21'),
(92, 8, '1542359501.jpg', '8/1542359501.jpg', 1, 1, 1, '2018-11-16 03:41:41', '2018-11-16 03:41:41'),
(93, 7, '1542359515.png', '7/1542359515.png', 1, 1, 1, '2018-11-16 03:41:55', '2018-11-16 03:41:55'),
(94, 4, '1542359528.png', '4/1542359528.png', 1, 1, 1, '2018-11-16 03:42:08', '2018-11-16 03:42:08'),
(95, 2, '1542359552.jpeg', '2/1542359552.jpeg', 1, 1, 1, '2018-11-16 03:42:33', '2018-11-16 03:42:33'),
(96, 3, '1542359568.jpeg', '3/1542359568.jpeg', 1, 1, 1, '2018-11-16 03:42:48', '2018-11-16 03:42:48'),
(97, 1, '1542359593.jpg', '1/1542359593.jpg', 1, 1, 1, '2018-11-16 03:43:13', '2018-11-16 03:43:13'),
(98, 10, '1542359620.jpeg', '10/1542359620.jpeg', 1, 1, 1, '2018-11-16 03:43:40', '2018-11-16 03:43:40'),
(100, 12, '1542360224.jpg', '12/1542360224.jpg', 1, 0, 1, '2018-11-16 03:53:44', '2018-11-16 03:53:52'),
(101, 12, '1542360232.jpg', '12/1542360232.jpg', 1, 1, 1, '2018-11-16 03:53:52', '2018-11-16 03:53:52'),
(104, 17, '1544001753.jpg', '17/1544001753.jpg', 1, 0, 1, '2018-12-05 03:52:33', '2018-12-05 03:52:59'),
(105, 17, '1544001766.jpg', '17/1544001766.jpg', 1, 0, 1, '2018-12-05 03:52:46', '2018-12-05 03:52:59'),
(106, 17, '1544001779.jpg', '17/1544001779.jpg', 1, 1, 1, '2018-12-05 03:52:59', '2018-12-05 03:52:59'),
(107, 18, '1544007304.jpg', '18/1544007304.jpg', 1, 1, 1, '2018-12-05 05:25:04', '2018-12-05 05:25:04'),
(108, 19, '1544010071.jpg', '19/1544010071.jpg', 1, 1, 1, '2018-12-05 06:11:11', '2018-12-05 06:11:11'),
(110, 20, '1545036882.jpg', '20/1545036882.jpg', 1, 1, 1, '2018-12-17 03:24:42', '2018-12-17 03:24:42'),
(112, 21, '1545313546.jpg', '21/1545313546.jpg', 1, 1, 1, '2018-12-20 08:15:46', '2018-12-20 08:15:46'),
(113, 22, '1545313599.png', '22/1545313599.png', 1, 1, 1, '2018-12-20 08:16:39', '2018-12-20 08:16:39'),
(204, 23, '1546499217.jpeg', '23/1546499217.jpeg', 1, 1, 1, '2019-01-03 01:36:57', '2019-01-03 01:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `str_book_review`
--

CREATE TABLE `str_book_review` (
  `book_review_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `book_review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_stars` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `str_book_set`
--

CREATE TABLE `str_book_set` (
  `book_set_id` int(20) UNSIGNED NOT NULL,
  `institution_id` int(11) NOT NULL,
  `book_set_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_set_guid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_book_set`
--

INSERT INTO `str_book_set` (`book_set_id`, `institution_id`, `book_set_name`, `book_set_guid`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'book set 1', NULL, 1, '2018-12-19 05:31:28', '2018-12-19 05:31:28'),
(2, 1, 'Flinnt', NULL, 1, '2018-12-19 06:01:55', '2018-12-19 06:01:55'),
(3, 1, 'Test 3', NULL, 1, '2018-12-20 01:28:57', '2019-01-03 05:19:31'),
(4, 15, 'Book set for standard 1', NULL, 1, '2018-12-22 00:03:15', '2019-04-10 11:17:53'),
(5, 1, 'Bookset for Grade 10', NULL, 1, '2018-12-28 07:56:54', '2018-12-28 07:56:54'),
(6, 1, 'Standard 3', NULL, 1, '2019-01-04 00:20:04', '2019-01-04 00:20:49'),
(7, 1, 'Bookset for CBSE grade 9', NULL, 1, '2019-02-18 03:57:07', '2019-02-18 03:57:07'),
(8, 1, 'testing 123', NULL, 1, '2019-04-02 11:54:13', '2019-04-02 11:54:13'),
(9, 1, 'Tests 3231', NULL, 1, '2019-04-02 11:57:21', '2019-04-02 11:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `str_book_set_book`
--

CREATE TABLE `str_book_set_book` (
  `book_set_book_id` int(20) UNSIGNED NOT NULL,
  `book_set_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `vendor_id` int(10) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_book_set_book`
--

INSERT INTO `str_book_set_book` (`book_set_book_id`, `book_set_id`, `book_id`, `subject_id`, `vendor_id`, `is_active`, `created_at`, `updated_at`) VALUES
(486, 6, 12, 4, 1, 1, '2019-01-10 06:05:19', '2019-01-10 06:05:19'),
(493, 1, NULL, 1, NULL, 1, '2019-01-22 04:05:42', '2019-01-22 04:05:42'),
(497, 1, NULL, 5, NULL, 1, '2019-01-22 04:05:42', '2019-01-22 04:05:42'),
(498, 1, NULL, 6, NULL, 1, '2019-01-22 04:05:42', '2019-01-22 04:05:42'),
(499, 1, 2, 3, 1, 1, '2019-01-22 04:05:42', '2019-01-22 04:05:42'),
(500, 1, 12, 4, 1, 1, '2019-01-22 04:05:42', '2019-01-22 04:05:42'),
(501, 1, 23, 2, 1, 1, '2019-01-22 04:05:42', '2019-01-22 04:05:42'),
(502, 1, 23, 2, 4, 1, '2019-01-22 04:05:42', '2019-01-22 04:05:42'),
(503, 5, NULL, 1, NULL, 1, '2019-01-22 04:06:07', '2019-01-22 04:06:07'),
(507, 5, NULL, 5, NULL, 1, '2019-01-22 04:06:07', '2019-01-22 04:06:07'),
(508, 5, NULL, 6, NULL, 1, '2019-01-22 04:06:07', '2019-01-22 04:06:07'),
(509, 5, 2, 3, 1, 1, '2019-01-22 04:06:07', '2019-01-22 04:06:07'),
(510, 5, 12, 4, 1, 1, '2019-01-22 04:06:07', '2019-01-22 04:06:07'),
(511, 5, 23, 2, 1, 1, '2019-01-22 04:06:07', '2019-01-22 04:06:07'),
(512, 5, 23, 2, 4, 1, '2019-01-22 04:06:07', '2019-01-22 04:06:07'),
(513, 3, NULL, 1, NULL, 1, '2019-01-22 04:06:52', '2019-01-22 04:06:52'),
(517, 3, NULL, 5, NULL, 1, '2019-01-22 04:06:52', '2019-01-22 04:06:52'),
(518, 3, NULL, 6, NULL, 1, '2019-01-22 04:06:52', '2019-01-22 04:06:52'),
(519, 3, 2, 3, 1, 1, '2019-01-22 04:06:52', '2019-01-22 04:06:52'),
(520, 3, 12, 4, 1, 1, '2019-01-22 04:06:52', '2019-01-22 04:06:52'),
(521, 3, 23, 2, 1, 1, '2019-01-22 04:06:52', '2019-01-22 04:06:52'),
(522, 3, 23, 2, 4, 1, '2019-01-22 04:06:52', '2019-01-22 04:06:52'),
(523, 7, NULL, 6, NULL, 1, '2019-02-18 03:57:07', '2019-02-18 03:57:07'),
(537, 8, NULL, 4, NULL, 1, '2019-04-02 11:54:44', '2019-04-02 11:54:44'),
(538, 8, NULL, 5, NULL, 1, '2019-04-02 11:54:44', '2019-04-02 11:54:44'),
(539, 9, NULL, 6, NULL, 1, '2019-04-02 11:57:21', '2019-04-02 11:57:21'),
(568, 4, NULL, 1, NULL, 1, '2019-04-10 11:17:53', '2019-04-10 11:17:53'),
(570, 4, NULL, 3, NULL, 1, '2019-04-10 11:17:53', '2019-04-10 11:17:53'),
(571, 4, NULL, 4, NULL, 1, '2019-04-10 11:17:53', '2019-04-10 11:17:53'),
(572, 4, NULL, 5, NULL, 1, '2019-04-10 11:17:53', '2019-04-10 11:17:53'),
(573, 4, NULL, 6, NULL, 1, '2019-04-10 11:17:53', '2019-04-10 11:17:53'),
(574, 4, 23, 2, 4, 1, '2019-04-10 11:17:53', '2019-04-10 11:17:53'),
(600, 2, NULL, 5, NULL, 1, '2019-06-05 12:49:40', '2019-06-05 12:49:40'),
(601, 2, NULL, 6, NULL, 1, '2019-06-05 12:49:40', '2019-06-05 12:49:40'),
(602, 2, 23, 2, 4, 1, '2019-06-05 12:49:40', '2019-06-05 12:49:40'),
(603, 2, 12, 4, 1, 1, '2019-06-05 12:49:40', '2019-06-05 12:49:40'),
(604, 2, 4, 1, 1, 1, '2019-06-05 12:49:41', '2019-06-05 12:49:41'),
(605, 2, 2, 3, 1, 1, '2019-06-05 12:49:41', '2019-06-05 12:49:41'),
(606, 2, 23, 2, 1, 1, '2019-06-05 12:49:41', '2019-06-05 12:49:41');

-- --------------------------------------------------------

--
-- Table structure for table `str_book_set_description`
--

CREATE TABLE `str_book_set_description` (
  `book_set_description_id` int(20) UNSIGNED NOT NULL,
  `book_set_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `description_order` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_book_set_description`
--

INSERT INTO `str_book_set_description` (`book_set_description_id`, `book_set_id`, `description`, `description_order`, `is_active`, `created_at`, `updated_at`) VALUES
(293, 6, 'An introduction to drawi', 1, 1, '2019-01-10 06:05:19', '2019-01-10 06:05:19'),
(294, 6, NULL, 2, 1, '2019-01-10 06:05:19', '2019-01-10 06:05:19'),
(297, 1, 'book set 1book set 1book set 1', 1, 1, '2019-01-22 04:05:42', '2019-01-22 04:05:42'),
(298, 1, '<p>book set 1book set 1book set 1book set 1book set 1book set 1book set 1</p>', 2, 1, '2019-01-22 04:05:42', '2019-01-22 04:05:42'),
(299, 5, 'Bookset for Grade 10', 1, 1, '2019-01-22 04:06:07', '2019-01-22 04:06:07'),
(300, 5, '<p>Bookset for Grade 10</p>', 2, 1, '2019-01-22 04:06:07', '2019-01-22 04:06:07'),
(301, 3, 'An introduction to drawi', 1, 1, '2019-01-22 04:06:52', '2019-01-22 04:06:52'),
(302, 3, '<p>An introduction to drawi</p>', 2, 1, '2019-01-22 04:06:52', '2019-01-22 04:06:52'),
(303, 7, 'Standard 1\'s subjects are English and math', 1, 1, '2019-02-18 03:57:07', '2019-02-18 03:57:07'),
(304, 7, NULL, 2, 1, '2019-02-18 03:57:07', '2019-02-18 03:57:07'),
(309, 8, 'Standard 1\'s subjects are English and math', 1, 1, '2019-04-02 11:54:44', '2019-04-02 11:54:44'),
(310, 8, '<p>Hello</p>', 2, 1, '2019-04-02 11:54:44', '2019-04-02 11:54:44'),
(311, 9, 'Bookset for Grade 10', 1, 1, '2019-04-02 11:57:21', '2019-04-02 11:57:21'),
(312, 9, '<p>2</p>', 2, 1, '2019-04-02 11:57:21', '2019-04-02 11:57:21'),
(321, 4, 'Standard 1\'s subjects are hindi and math', 1, 1, '2019-04-10 11:17:53', '2019-04-10 11:17:53'),
(322, 4, '<p>Standard 1&#39;s subjects are hindi and math</p>', 2, 1, '2019-04-10 11:17:53', '2019-04-10 11:17:53'),
(327, 2, 'An introduction to drawi', 1, 1, '2019-06-05 12:49:40', '2019-06-05 12:49:40'),
(328, 2, '<p>An introduction to drawi&nbsp;An introduction to drawi</p>', 2, 1, '2019-06-05 12:49:40', '2019-06-05 12:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `str_book_set_image`
--

CREATE TABLE `str_book_set_image` (
  `book_set_image_id` int(20) UNSIGNED NOT NULL,
  `book_set_id` bigint(20) UNSIGNED NOT NULL,
  `book_set_image_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_set_image_path` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_set_image_order` int(11) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Yes, 0 = No',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_book_set_image`
--

INSERT INTO `str_book_set_image` (`book_set_image_id`, `book_set_id`, `book_set_image_name`, `book_set_image_path`, `book_set_image_order`, `is_primary`, `is_active`, `created_at`, `updated_at`) VALUES
(4, 3, '1545314596.jpg', '3/1545314596.jpg', 1, 1, 1, '2018-12-20 08:33:16', '2018-12-20 08:33:16'),
(5, 4, '1545456886.jpg', '4/1545456886.jpg', 1, 1, 1, '2018-12-22 00:04:47', '2018-12-22 00:04:47'),
(6, 1, '1546003561.jpg', '1/1546003561.jpg', 1, 1, 1, '2018-12-28 07:56:02', '2018-12-28 07:56:02'),
(7, 5, '1546003625.jpg', '5/1546003625.jpg', 1, 1, 1, '2018-12-28 07:57:05', '2018-12-28 07:57:05'),
(8, 6, '1547120110.jpg', '6/1547120110.jpg', 1, 1, 1, '2019-01-10 06:05:11', '2019-01-10 06:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `str_book_standard`
--

CREATE TABLE `str_book_standard` (
  `book_standard_id` int(10) UNSIGNED NOT NULL,
  `book_id` int(10) UNSIGNED NOT NULL,
  `standard_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_book_standard`
--

INSERT INTO `str_book_standard` (`book_standard_id`, `book_id`, `standard_id`, `created_at`, `updated_at`) VALUES
(151, 8, 1, '2018-11-16 03:41:42', '2018-11-16 03:41:42'),
(152, 8, 2, '2018-11-16 03:41:42', '2018-11-16 03:41:42'),
(153, 8, 3, '2018-11-16 03:41:42', '2018-11-16 03:41:42'),
(173, 7, 3, '2018-12-17 03:18:51', '2018-12-17 03:18:51'),
(177, 17, 1, '2018-12-20 01:27:09', '2018-12-20 01:27:09'),
(180, 21, 1, '2018-12-20 08:15:47', '2018-12-20 08:15:47'),
(183, 11, 1, '2018-12-24 00:00:25', '2018-12-24 00:00:25'),
(184, 11, 2, '2018-12-24 00:00:25', '2018-12-24 00:00:25'),
(185, 11, 3, '2018-12-24 00:00:25', '2018-12-24 00:00:25'),
(186, 10, 2, '2018-12-24 00:00:40', '2018-12-24 00:00:40'),
(187, 9, 4, '2018-12-24 00:00:51', '2018-12-24 00:00:51'),
(188, 9, 6, '2018-12-24 00:00:51', '2018-12-24 00:00:51'),
(189, 4, 2, '2018-12-24 00:01:23', '2018-12-24 00:01:23'),
(190, 4, 4, '2018-12-24 00:01:23', '2018-12-24 00:01:23'),
(191, 4, 6, '2018-12-24 00:01:23', '2018-12-24 00:01:23'),
(199, 1, 1, '2018-12-24 00:01:59', '2018-12-24 00:01:59'),
(273, 2, 1, '2019-01-10 01:41:41', '2019-01-10 01:41:41'),
(274, 2, 2, '2019-01-10 01:41:41', '2019-01-10 01:41:41'),
(275, 2, 3, '2019-01-10 01:41:41', '2019-01-10 01:41:41'),
(276, 2, 4, '2019-01-10 01:41:41', '2019-01-10 01:41:41'),
(277, 2, 5, '2019-01-10 01:41:41', '2019-01-10 01:41:41'),
(278, 2, 6, '2019-01-10 01:41:41', '2019-01-10 01:41:41'),
(279, 2, 7, '2019-01-10 01:41:41', '2019-01-10 01:41:41'),
(280, 2, 8, '2019-01-10 01:41:41', '2019-01-10 01:41:41'),
(281, 2, 9, '2019-01-10 01:41:41', '2019-01-10 01:41:41'),
(282, 2, 10, '2019-01-10 01:41:41', '2019-01-10 01:41:41'),
(293, 3, 2, '2019-01-22 04:03:09', '2019-01-22 04:03:09'),
(294, 3, 4, '2019-01-22 04:03:09', '2019-01-22 04:03:09'),
(295, 3, 7, '2019-01-22 04:03:09', '2019-01-22 04:03:09'),
(296, 3, 9, '2019-01-22 04:03:09', '2019-01-22 04:03:09'),
(307, 12, 1, '2019-01-25 04:32:48', '2019-01-25 04:32:48'),
(308, 12, 2, '2019-01-25 04:32:48', '2019-01-25 04:32:48'),
(309, 12, 3, '2019-01-25 04:32:48', '2019-01-25 04:32:48'),
(310, 12, 4, '2019-01-25 04:32:48', '2019-01-25 04:32:48'),
(311, 12, 5, '2019-01-25 04:32:48', '2019-01-25 04:32:48'),
(312, 12, 6, '2019-01-25 04:32:48', '2019-01-25 04:32:48'),
(313, 12, 7, '2019-01-25 04:32:48', '2019-01-25 04:32:48'),
(314, 12, 8, '2019-01-25 04:32:48', '2019-01-25 04:32:48'),
(315, 12, 9, '2019-01-25 04:32:48', '2019-01-25 04:32:48'),
(316, 12, 10, '2019-01-25 04:32:48', '2019-01-25 04:32:48'),
(318, 26, 1, '2019-02-18 05:54:12', '2019-02-18 05:54:12'),
(339, 23, 1, '2019-06-06 04:42:21', '2019-06-06 04:42:21'),
(340, 23, 2, '2019-06-06 04:42:21', '2019-06-06 04:42:21'),
(341, 23, 3, '2019-06-06 04:42:21', '2019-06-06 04:42:21'),
(342, 23, 4, '2019-06-06 04:42:21', '2019-06-06 04:42:21'),
(343, 23, 5, '2019-06-06 04:42:21', '2019-06-06 04:42:21'),
(344, 23, 6, '2019-06-06 04:42:21', '2019-06-06 04:42:21'),
(345, 23, 7, '2019-06-06 04:42:21', '2019-06-06 04:42:21'),
(346, 23, 8, '2019-06-06 04:42:21', '2019-06-06 04:42:21'),
(347, 23, 9, '2019-06-06 04:42:21', '2019-06-06 04:42:21'),
(348, 23, 10, '2019-06-06 04:42:21', '2019-06-06 04:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `str_book_vendor`
--

CREATE TABLE `str_book_vendor` (
  `book_vendor_id` int(10) UNSIGNED NOT NULL,
  `book_id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_book_vendor`
--

INSERT INTO `str_book_vendor` (`book_vendor_id`, `book_id`, `vendor_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2018-10-23 04:56:19', '2018-10-23 04:56:19'),
(2, 2, 1, '2018-10-23 06:30:19', '2018-10-23 06:30:19'),
(3, 3, 1, '2018-10-23 06:32:09', '2018-10-23 06:32:09'),
(4, 4, 1, '2018-10-23 06:55:41', '2018-10-23 06:55:41'),
(5, 5, 1, '2018-10-24 04:03:23', '2018-10-24 04:03:23'),
(6, 6, 1, '2018-10-24 04:03:54', '2018-10-24 04:03:54'),
(7, 7, 1, '2018-10-24 04:04:18', '2018-10-24 04:04:18'),
(8, 8, 2, '2018-10-24 07:13:57', '2018-10-24 07:13:57'),
(9, 9, 1, '2018-10-26 07:39:07', '2018-10-26 07:39:07'),
(10, 10, 1, '2018-10-26 08:01:55', '2018-10-26 08:01:55'),
(11, 1, 2, '2018-10-30 01:23:06', '2018-10-30 01:23:06'),
(15, 2, 2, '2018-10-30 01:25:31', '2018-10-30 01:25:31'),
(16, 11, 1, '2018-11-15 07:00:01', '2018-11-15 07:00:01'),
(17, 12, 1, '2018-11-15 07:12:12', '2018-11-15 07:12:12'),
(18, 15, 1, '2018-12-05 02:10:10', '2018-12-05 02:10:10'),
(19, 16, 1, '2018-12-05 02:10:38', '2018-12-05 02:10:38'),
(20, 17, 1, '2018-12-05 02:11:08', '2018-12-05 02:11:08'),
(21, 18, 1, '2018-12-05 05:24:44', '2018-12-05 05:24:44'),
(22, 19, 1, '2018-12-05 06:11:00', '2018-12-05 06:11:00'),
(23, 20, 1, '2018-12-17 03:24:32', '2018-12-17 03:24:32'),
(24, 21, 1, '2018-12-17 07:58:47', '2018-12-17 07:58:47'),
(25, 22, 1, '2018-12-17 08:05:38', '2018-12-17 08:05:38'),
(26, 17, 4, '2018-12-20 01:24:18', '2018-12-20 01:24:18'),
(27, 23, 4, '2018-12-20 01:35:41', '2018-12-20 01:35:41'),
(28, 23, 1, '2018-12-26 04:52:25', '2018-12-26 04:52:25'),
(29, 24, 1, '2019-02-18 03:42:51', '2019-02-18 03:42:51'),
(30, 25, 2, '2019-02-18 05:02:55', '2019-02-18 05:02:55'),
(31, 26, 2, '2019-02-18 05:23:49', '2019-02-18 05:23:49'),
(32, 27, 2, '2019-02-18 05:24:11', '2019-02-18 05:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `str_category`
--

CREATE TABLE `str_category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_category`
--

INSERT INTO `str_category` (`category_id`, `category_name`, `category_image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Books', '1540560330.png', 1, '2018-10-23 04:53:18', '2019-05-16 12:53:17'),
(2, 'Educational And Professional Books', '1540789568.jpg', 1, '2018-10-23 06:01:51', '2018-10-28 23:36:08'),
(3, 'Historical Fiction', '1545046807.jpg', 1, '2018-10-23 06:03:11', '2018-12-17 06:10:07'),
(4, 'Academic Texts Books', '1545046815.png', 1, '2018-10-23 06:03:58', '2018-12-17 06:10:15'),
(5, 'Stationery', '1545046823.jpg', 1, '2018-10-23 06:04:31', '2018-12-17 06:10:23'),
(6, 'Games', '1545046838.png', 0, '2018-10-26 03:42:51', '2019-05-16 12:58:29'),
(7, 'Toys', '1545046928.png', 1, '2018-10-26 04:18:39', '2018-12-18 01:07:01'),
(8, 'Electronic Toys', '1545046856.jpg', 1, '2018-10-26 04:20:34', '2018-12-17 06:10:56'),
(9, 'Note Book', '1543984419.jpg', 1, '2018-12-04 23:03:39', '2019-05-16 12:58:21'),
(10, 'Comic', '1543992994.jpg', 1, '2018-12-05 01:26:34', '2018-12-05 01:26:46'),
(11, 'Exam Central', '1543993550.jpg', 1, '2018-12-05 01:34:42', '2018-12-17 05:29:15'),
(12, 'Children\'s books', '1543993531.jpeg', 1, '2018-12-05 01:35:30', '2018-12-18 01:05:48'),
(13, 'test book', '1543993623.jpg', 0, '2018-12-05 01:37:02', '2018-12-05 01:37:03'),
(14, 'Society & Social Sciences', '1545649896.jpg', 1, '2018-12-24 05:41:36', '2018-12-24 05:41:37'),
(24, 'Electronic & Mobile', '1546431391.png', 1, '2019-01-02 06:46:31', '2019-01-02 22:50:00'),
(25, 'Engineering Books', '1546489483.png', 1, '2019-01-02 22:54:43', '2019-01-02 22:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `str_category_tree`
--

CREATE TABLE `str_category_tree` (
  `category_tree_id` int(10) UNSIGNED NOT NULL,
  `child_category_id` int(10) UNSIGNED NOT NULL,
  `parent_category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_category_tree`
--

INSERT INTO `str_category_tree` (`category_tree_id`, `child_category_id`, `parent_category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '2018-10-23 04:53:18', '2018-10-23 04:53:18'),
(2, 2, 1, '2018-10-23 06:01:51', '2018-10-23 06:01:51'),
(3, 3, 1, '2018-10-23 06:03:11', '2018-10-23 06:03:11'),
(4, 4, 2, '2018-10-23 06:03:58', '2018-10-23 06:03:58'),
(5, 5, 0, '2018-10-23 06:04:31', '2018-10-23 06:04:31'),
(6, 6, 0, '2018-10-26 03:42:51', '2018-10-26 03:42:51'),
(7, 7, 0, '2018-10-26 04:18:39', '2018-10-26 04:18:39'),
(8, 8, 7, '2018-10-26 04:20:34', '2018-10-26 04:20:34'),
(9, 9, 6, '2018-12-04 23:03:39', '2018-12-04 23:03:39'),
(10, 10, 1, '2018-12-05 01:26:34', '2018-12-05 01:26:34'),
(11, 11, 2, '2018-12-05 01:34:42', '2018-12-05 01:34:42'),
(12, 12, 1, '2018-12-05 01:35:31', '2018-12-05 01:35:31'),
(13, 13, 12, '2018-12-05 01:37:03', '2018-12-05 01:37:03'),
(14, 14, 2, '2018-12-24 05:41:36', '2018-12-24 05:41:36'),
(27, 24, 0, '2019-01-02 06:46:31', '2019-01-02 06:46:31'),
(28, 25, 1, '2019-01-02 22:54:43', '2019-01-02 22:54:43'),
(29, 25, 2, '2019-01-02 22:54:43', '2019-01-02 22:54:43'),
(30, 25, 4, '2019-01-02 22:54:43', '2019-01-02 22:54:43'),
(31, 25, 11, '2019-01-02 22:54:43', '2019-01-02 22:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `str_condition`
--

CREATE TABLE `str_condition` (
  `condition_id` int(11) UNSIGNED NOT NULL,
  `condition_name` varchar(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `str_condition`
--

INSERT INTO `str_condition` (`condition_id`, `condition_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Free condition', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `str_country`
--

CREATE TABLE `str_country` (
  `country_id` int(10) UNSIGNED NOT NULL,
  `sortname` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_country`
--

INSERT INTO `str_country` (`country_id`, `sortname`, `name`, `phonecode`) VALUES
(1, 'IN', 'India', 91);

-- --------------------------------------------------------

--
-- Table structure for table `str_courier`
--

CREATE TABLE `str_courier` (
  `courier_id` int(11) NOT NULL,
  `courier_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tracking_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_courier`
--

INSERT INTO `str_courier` (`courier_id`, `courier_name`, `tracking_url`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Indian Postal Services', 'https://www.indiapost.gov.in/vas/Pages/IndiaPostHome.aspx', 1, NULL, NULL),
(2, 'FedEx', 'https://www.fedex.com/apps/fedextrack/?action=track', 1, NULL, NULL),
(3, 'DTDC', 'http://www.dtdc.in/tracking/shipment-tracking.asp', 1, NULL, NULL),
(4, 'Shree Maruti Courier Service', 'https://www.shreemaruticourier.com/', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `str_institution`
--

CREATE TABLE `str_institution` (
  `institution_id` int(20) UNSIGNED NOT NULL,
  `institution_name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` bigint(20) NOT NULL,
  `country_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `pin` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institution_image` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `email_verified_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_institution`
--

INSERT INTO `str_institution` (`institution_id`, `institution_name`, `contact_name`, `email`, `password`, `remember_token`, `address1`, `address2`, `city`, `state_id`, `country_id`, `status_id`, `pin`, `phone`, `institution_image`, `is_active`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(1, 'Satellite Institution', 'ADMS', 'institution@mailinator.com', '$2y$10$atssQKHYMft/rZtlXIe8QurXpD5x6MOuQR8B1pHJiJXtmKhTjAi.e', '8lUzjj9T6oV8TEFgNShBZMwIcTIKnUu0xh9x0RjOxiGzjsWb5Oq7wiIveWjU', '604 Iscon Elegance', 'Ahmedabad', 'Ahmedabad', 4, 1, 1, '380015', '7966168834', '1545900896.png', 1, NULL, '2018-12-05 03:32:55', '2019-02-19 23:32:50'),
(15, 'Krushnam Institution', 'ADMS', 'raj@mailinator.com', '$2y$10$cPhYMF.pZx8KDI5ZZKbPuu5wGoBacvlhnPO6ddFclRSlAYyEPAevy', 'kFX1RYCShhiqc3tIwS5sLPwcTxVtWYl7vGyJXpAyGH42R7n51Rx4nNkQNglq', '604 Iscon Elegance', NULL, 'Ahmedabad', 12, 1, 1, '380015', '7966168834', '1543916103.png', 1, NULL, '2018-12-04 02:21:51', '2018-12-04 04:05:03'),
(16, 'SBP Academy', 'David', 'raja@mailinator.com', '$2y$10$cPhYMF.pZx8KDI5ZZKbPuu5wGoBacvlhnPO6ddFclRSlAYyEPAevy', NULL, '604 Iscon Elegance', NULL, 'Ahmedabad', 12, 1, 2, '380015', '7966168834', '1543916166.png', 1, NULL, '2018-12-04 04:06:06', '2018-12-26 08:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `str_institution_board_standard`
--

CREATE TABLE `str_institution_board_standard` (
  `institution_board_standard_id` int(10) UNSIGNED NOT NULL,
  `institution_id` int(10) UNSIGNED NOT NULL,
  `board_id` int(10) UNSIGNED NOT NULL,
  `standard_id` int(10) UNSIGNED NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `str_institution_board_standard`
--

INSERT INTO `str_institution_board_standard` (`institution_board_standard_id`, `institution_id`, `board_id`, `standard_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 1, '2018-12-18 07:51:56', '2018-12-18 23:38:51'),
(2, 1, 3, 2, 1, '2018-12-18 07:51:56', '2018-12-20 02:06:55'),
(3, 1, 3, 10, 1, '2018-12-18 08:25:52', '2018-12-18 08:25:52'),
(4, 15, 3, 1, 1, '2018-12-22 00:02:13', '2018-12-22 00:02:13');

-- --------------------------------------------------------

--
-- Table structure for table `str_institution_board_standard_bookset`
--

CREATE TABLE `str_institution_board_standard_bookset` (
  `institution_board_standard_bookset_id` int(20) UNSIGNED NOT NULL,
  `institution_board_standard_id` int(11) NOT NULL,
  `book_set_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_institution_board_standard_bookset`
--

INSERT INTO `str_institution_board_standard_bookset` (`institution_board_standard_bookset_id`, `institution_board_standard_id`, `book_set_id`, `is_active`, `created_at`, `updated_at`) VALUES
(147, 2, 6, 1, '2019-01-10 06:05:19', '2019-01-10 06:05:19'),
(149, 3, 1, 1, '2019-01-22 04:05:42', '2019-01-22 04:05:42'),
(150, 3, 5, 1, '2019-01-22 04:06:07', '2019-01-22 04:06:07'),
(151, 1, 3, 1, '2019-01-22 04:06:52', '2019-01-22 04:06:52'),
(152, 2, 7, 1, '2019-02-18 03:57:07', '2019-02-18 03:57:07'),
(155, 2, 8, 1, '2019-04-02 11:54:44', '2019-04-02 11:54:44'),
(156, 1, 9, 1, '2019-04-02 11:57:21', '2019-04-02 11:57:21'),
(161, 4, 4, 1, '2019-04-10 11:17:53', '2019-04-10 11:17:53'),
(164, 2, 2, 1, '2019-06-05 12:49:40', '2019-06-05 12:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `str_institution_board_standard_subject`
--

CREATE TABLE `str_institution_board_standard_subject` (
  `institution_board_standard_subject_id` int(10) UNSIGNED NOT NULL,
  `institution_id` int(10) UNSIGNED NOT NULL,
  `board_id` int(10) UNSIGNED NOT NULL,
  `standard_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `str_institution_board_standard_subject`
--

INSERT INTO `str_institution_board_standard_subject` (`institution_board_standard_subject_id`, `institution_id`, `board_id`, `standard_id`, `subject_id`, `is_active`, `created_at`, `updated_at`) VALUES
(22, 15, 3, 1, 1, 1, '2018-12-22 00:02:13', '2018-12-22 00:02:13'),
(23, 15, 3, 1, 2, 1, '2018-12-22 00:02:13', '2018-12-22 00:02:13'),
(24, 15, 3, 1, 3, 1, '2018-12-22 00:02:13', '2018-12-22 00:02:13'),
(25, 15, 3, 1, 4, 1, '2018-12-22 00:02:13', '2018-12-22 00:02:13'),
(26, 15, 3, 1, 5, 1, '2018-12-22 00:02:13', '2018-12-22 00:02:13'),
(27, 15, 3, 1, 6, 1, '2018-12-22 00:02:13', '2018-12-22 00:02:13'),
(40, 1, 3, 10, 1, 1, '2019-01-03 06:31:58', '2019-01-03 06:31:58'),
(41, 1, 3, 10, 2, 1, '2019-01-03 06:31:58', '2019-01-03 06:31:58'),
(42, 1, 3, 10, 3, 1, '2019-01-03 06:31:58', '2019-01-03 06:31:58'),
(43, 1, 3, 10, 4, 1, '2019-01-03 06:31:58', '2019-01-03 06:31:58'),
(44, 1, 3, 10, 5, 1, '2019-01-03 06:31:58', '2019-01-03 06:31:58'),
(45, 1, 3, 10, 6, 1, '2019-01-03 06:31:58', '2019-01-03 06:31:58'),
(46, 1, 3, 1, 1, 1, '2019-01-22 04:05:19', '2019-01-22 04:05:19'),
(47, 1, 3, 1, 2, 1, '2019-01-22 04:05:19', '2019-01-22 04:05:19'),
(48, 1, 3, 1, 3, 1, '2019-01-22 04:05:19', '2019-01-22 04:05:19'),
(49, 1, 3, 1, 4, 1, '2019-01-22 04:05:19', '2019-01-22 04:05:19'),
(50, 1, 3, 1, 5, 1, '2019-01-22 04:05:19', '2019-01-22 04:05:19'),
(51, 1, 3, 1, 6, 1, '2019-01-22 04:05:19', '2019-01-22 04:05:19'),
(52, 1, 3, 2, 1, 1, '2019-06-06 05:22:07', '2019-06-06 05:22:07'),
(53, 1, 3, 2, 2, 1, '2019-06-06 05:22:07', '2019-06-06 05:22:07'),
(54, 1, 3, 2, 3, 1, '2019-06-06 05:22:07', '2019-06-06 05:22:07'),
(55, 1, 3, 2, 4, 1, '2019-06-06 05:22:07', '2019-06-06 05:22:07'),
(56, 1, 3, 2, 5, 1, '2019-06-06 05:22:07', '2019-06-06 05:22:07'),
(57, 1, 3, 2, 6, 1, '2019-06-06 05:22:07', '2019-06-06 05:22:07');

-- --------------------------------------------------------

--
-- Table structure for table `str_institution_bookset_vendor_price`
--

CREATE TABLE `str_institution_bookset_vendor_price` (
  `institution_book_set_vendor_id` int(20) UNSIGNED NOT NULL,
  `institution_id` int(20) NOT NULL,
  `book_set_id` int(20) NOT NULL,
  `vendor_id` int(20) NOT NULL,
  `condition_id` int(11) NOT NULL,
  `list_price` decimal(10,0) NOT NULL,
  `sale_price` decimal(10,0) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `is_preffered` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `str_institution_bookset_vendor_price`
--

INSERT INTO `str_institution_bookset_vendor_price` (`institution_book_set_vendor_id`, `institution_id`, `book_set_id`, `vendor_id`, `condition_id`, `list_price`, `sale_price`, `is_active`, `is_preffered`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 4, 1, '0', '1050', 1, 0, '2018-12-27 06:18:46', '2019-01-23 07:46:26'),
(3, 1, 3, 4, 1, '1099', '999', 1, 1, '2018-12-27 07:47:39', '2019-06-03 13:50:25'),
(4, 15, 4, 4, 1, '1099', '1000', 1, 1, '2018-12-27 07:47:58', '2019-01-09 05:53:27'),
(5, 1, 3, 1, 1, '0', '1050', 1, 0, '2019-01-03 08:12:48', '2019-06-03 13:50:25'),
(6, 1, 2, 1, 1, '909', '900', 1, 1, '2019-01-10 03:24:33', '2019-01-23 07:46:26'),
(7, 1, 6, 1, 1, '100', '95', 1, 0, '2019-01-22 06:57:33', '2019-01-22 06:57:33'),
(8, 1, 1, 1, 1, '610', '599', 1, 1, '2019-01-22 06:57:41', '2019-06-04 12:54:27'),
(9, 1, 5, 1, 1, '610', '600', 1, 0, '2019-01-22 06:57:50', '2019-01-22 06:57:50'),
(10, 1, 1, 4, 1, '1099', '999', 1, 0, '2019-01-22 07:01:19', '2019-06-04 12:54:26'),
(11, 1, 5, 4, 1, '1099', '950', 1, 0, '2019-01-22 07:01:35', '2019-01-22 07:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `str_institution_book_vendor_price`
--

CREATE TABLE `str_institution_book_vendor_price` (
  `institution_book_vendor_id` int(20) UNSIGNED NOT NULL,
  `institution_id` int(20) UNSIGNED NOT NULL,
  `book_id` int(20) UNSIGNED NOT NULL,
  `vendor_id` int(20) UNSIGNED NOT NULL,
  `condition_id` int(11) UNSIGNED NOT NULL,
  `list_price` decimal(10,0) NOT NULL,
  `sale_price` decimal(10,0) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `is_preffered` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `str_institution_book_vendor_price`
--

INSERT INTO `str_institution_book_vendor_price` (`institution_book_vendor_id`, `institution_id`, `book_id`, `vendor_id`, `condition_id`, `list_price`, `sale_price`, `is_active`, `is_preffered`, `created_at`, `updated_at`) VALUES
(4, 1, 17, 1, 1, '120', '120', 1, 1, '2018-12-05 03:33:20', '2018-12-05 04:08:42'),
(5, 1, 18, 1, 1, '850', '750', 1, 1, '2018-12-05 05:24:44', '2018-12-05 06:06:50'),
(6, 1, 19, 1, 1, '2509', '1999', 1, 1, '2018-12-05 06:11:00', '2018-12-17 02:05:25'),
(7, 1, 7, 1, 1, '120', '150', 1, 1, '2018-12-17 03:18:49', '2018-12-17 03:18:49'),
(8, 1, 20, 1, 1, '210', '199', 1, 1, '2018-12-17 03:24:32', '2018-12-17 07:27:56'),
(9, 1, 21, 1, 1, '120', '150', 1, 1, '2018-12-17 07:58:47', '2018-12-20 08:15:47'),
(10, 1, 22, 1, 1, '120', '150', 1, 1, '2018-12-17 08:05:39', '2019-01-22 04:01:37'),
(11, 1, 17, 4, 1, '120', '150', 1, 1, '2018-12-20 01:24:18', '2018-12-20 01:27:09'),
(12, 1, 23, 4, 1, '1000', '1099', 1, 1, '2018-12-20 01:35:42', '2019-01-03 01:36:57'),
(13, 1, 12, 1, 1, '120', '100', 1, 1, '2018-12-24 00:00:06', '2019-01-25 04:32:47'),
(14, 1, 11, 1, 1, '245', '215', 1, 1, '2018-12-24 00:00:25', '2018-12-24 00:00:25'),
(15, 1, 10, 1, 1, '110', '99', 1, 1, '2018-12-24 00:00:39', '2018-12-24 00:00:39'),
(16, 1, 9, 1, 1, '134', '110', 1, 1, '2018-12-24 00:00:51', '2018-12-24 00:00:51'),
(17, 1, 4, 1, 1, '342', '299', 1, 1, '2018-12-24 00:01:22', '2018-12-24 00:01:22'),
(18, 1, 3, 1, 1, '199', '155', 1, 1, '2018-12-24 00:01:34', '2019-01-22 04:03:09'),
(19, 1, 2, 1, 1, '354', '311', 1, 1, '2018-12-24 00:01:47', '2019-01-10 01:41:41'),
(20, 1, 1, 1, 1, '112', '99', 1, 1, '2018-12-24 00:01:59', '2018-12-28 05:28:09'),
(21, 1, 23, 1, 1, '212', '199', 1, 1, '2018-12-26 04:52:25', '2019-06-06 04:42:21'),
(22, 1, 24, 1, 1, '212', '199', 1, 0, '2019-02-18 03:42:51', '2019-02-18 03:42:51'),
(23, 1, 25, 2, 1, '120', '150', 1, 0, '2019-02-18 05:02:55', '2019-02-18 05:02:55'),
(24, 1, 26, 2, 1, '120', '199', 1, 0, '2019-02-18 05:23:49', '2019-02-18 05:54:11'),
(25, 1, 27, 2, 1, '120', '199', 1, 0, '2019-02-18 05:24:11', '2019-02-18 05:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `str_institution_vendor`
--

CREATE TABLE `str_institution_vendor` (
  `institution_vendor_id` int(10) UNSIGNED NOT NULL,
  `institution_id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `str_institution_vendor`
--

INSERT INTO `str_institution_vendor` (`institution_vendor_id`, `institution_id`, `vendor_id`, `created_at`, `updated_at`) VALUES
(40, 15, 4, '2018-12-22 00:01:18', '2018-12-22 00:01:18'),
(54, 1, 1, '2019-03-08 03:34:20', '2019-03-08 03:34:20'),
(55, 1, 2, '2019-03-08 03:34:20', '2019-03-08 03:34:20'),
(56, 1, 4, '2019-03-08 03:34:20', '2019-03-08 03:34:20'),
(57, 1, 5, '2019-03-08 03:34:20', '2019-03-08 03:34:20');

-- --------------------------------------------------------

--
-- Table structure for table `str_language`
--

CREATE TABLE `str_language` (
  `language_id` int(10) UNSIGNED NOT NULL,
  `language_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_language`
--

INSERT INTO `str_language` (`language_id`, `language_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'English', 1, '2018-10-23 04:54:40', '2018-10-23 04:54:40'),
(2, 'Hindi', 1, '2018-10-23 06:19:39', '2018-10-23 06:19:39'),
(3, 'Gujarati', 1, '2018-10-23 06:19:48', '2018-10-23 06:19:48'),
(4, 'Tamil', 1, '2018-10-23 06:19:53', '2018-10-23 06:19:53'),
(5, 'Telugu', 1, '2018-10-23 06:19:59', '2018-10-23 06:19:59'),
(6, 'a', 0, '2018-12-05 00:42:27', '2018-12-05 00:42:30');

-- --------------------------------------------------------

--
-- Table structure for table `str_migrations`
--

CREATE TABLE `str_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_migrations`
--

INSERT INTO `str_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_10_23_062112_create_str_author_table', 1),
(2, '2018_10_23_062112_create_str_board_table', 1),
(3, '2018_10_23_062112_create_str_book_author_table', 1),
(4, '2018_10_23_062112_create_str_book_board_table', 1),
(5, '2018_10_23_062112_create_str_book_category_tree_table', 1),
(6, '2018_10_23_062112_create_str_book_description_table', 1),
(7, '2018_10_23_062112_create_str_book_image_table', 1),
(8, '2018_10_23_062112_create_str_book_review_table', 1),
(9, '2018_10_23_062112_create_str_book_standard_table', 1),
(10, '2018_10_23_062112_create_str_book_table', 1),
(11, '2018_10_23_062112_create_str_book_vendor_table', 1),
(12, '2018_10_23_062112_create_str_category_table', 1),
(13, '2018_10_23_062112_create_str_category_tree_table', 1),
(14, '2018_10_23_062112_create_str_country_table', 1),
(15, '2018_10_23_062112_create_str_language_table', 1),
(16, '2018_10_23_062112_create_str_publisher_table', 1),
(17, '2018_10_23_062112_create_str_standard_table', 1),
(18, '2018_10_23_062112_create_str_state_table', 1),
(19, '2018_10_23_062112_create_str_vendor_table', 1),
(20, '2018_10_23_062114_add_foreign_keys_to_str_book_table', 2),
(21, '2018_10_23_062114_add_foreign_keys_to_str_category_tree_table', 2),
(22, '2018_10_24_060602_create_institutions_table', 3),
(23, '2018_11_13_094621_create_attributes_table', 3),
(24, '2018_11_21_052349_create_shoppingcart_table', 3),
(25, '2018_11_22_104240_create_subjects_table', 4),
(26, '2018_11_27_061540_create_shoppingcart_table', 4),
(27, '2018_12_18_071643_create_booksets_table', 5),
(28, '2018_12_28_091755_create_tags_table', 5),
(29, '2019_01_18_085820_create_orders_table', 5),
(30, '2019_02_20_103426_create_homes_table', 5),
(31, '2019_02_22_093134_create_reports_table', 5),
(32, '2019_03_06_100447_create_couriers_table', 5),
(33, '2019_04_09_193140_create_audits_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `str_order`
--

CREATE TABLE `str_order` (
  `order_id` int(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `institution_id` int(11) UNSIGNED NOT NULL,
  `shipping_address_id` int(11) UNSIGNED NOT NULL,
  `order_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_qty` int(10) UNSIGNED DEFAULT NULL,
  `order_total_price` decimal(18,2) DEFAULT NULL,
  `transaction_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Pending, 2 = Success, 3 = Fail',
  `order_date` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_order`
--

INSERT INTO `str_order` (`order_id`, `user_id`, `institution_id`, `shipping_address_id`, `order_number`, `order_qty`, `order_total_price`, `transaction_id`, `payment_id`, `order_status`, `order_date`, `is_active`, `created_at`, `updated_at`) VALUES
(16, 7107, 1, 10, '1551098200', 2, '349.00', '1554286220', '1', 1, '2019-02-25 07:06:40', 1, '2019-02-25 07:06:40', '2019-04-03 10:10:20'),
(17, 7107, 1, 10, '1551103212', 4, '863.00', '1551103212', '1', 2, '2019-02-25 08:30:12', 1, '2019-02-25 08:30:12', '2019-02-25 08:30:12'),
(18, 7107, 1, 10, '1551242379', 3, '597.00', '1551242379', '1', 1, '2019-02-26 23:09:39', 1, '2019-02-26 23:09:39', '2019-02-26 23:09:39'),
(19, 7110, 15, 11, '190306053657', 4, '396.00', '1551850617', NULL, 2, '2019-03-06 00:06:57', 1, '2019-03-06 00:06:57', '2019-03-06 00:06:57'),
(20, 7107, 1, 10, '190312164104', 2, '300.00', '1552389064', NULL, 1, '2019-03-12 11:11:04', 1, '2019-03-12 11:11:04', '2019-03-12 11:11:04'),
(21, 7108, 1, 14, '190328185502', 1, '199.00', '1553779502', '1553779502', 2, '2019-03-28 13:25:02', 1, '2019-03-28 13:25:02', '2019-03-28 13:25:02'),
(22, 7107, 15, 10, '190402192953', 2, '2198.00', '1554213593', NULL, 1, '2019-04-02 13:59:53', 1, '2019-04-02 13:59:53', '2019-04-02 13:59:53'),
(23, 7107, 15, 10, '190403190344', 2, '1249.00', '1559047640', NULL, 1, '2019-04-03 13:33:44', 1, '2019-04-03 13:33:44', '2019-05-28 12:47:20'),
(24, 7107, 15, 10, '190410144742', 2, '300.00', '1554887862', NULL, 1, '2019-04-10 09:17:42', 1, '2019-04-10 09:17:42', '2019-04-10 09:17:42'),
(25, 7107, 15, 10, '190509120004', 1, '1000.00', '1557383404', NULL, 1, '2019-05-09 06:30:04', 1, '2019-05-09 06:30:04', '2019-05-09 06:30:04'),
(26, 7107, 15, 15, '190529112953', 1, '1099.00', '1559109593', NULL, 1, '2019-05-29 05:59:53', 1, '2019-05-29 05:59:53', '2019-05-29 05:59:53'),
(27, 7107, 15, 15, '190529113822', 1, '1099.00', '1559110102', NULL, 1, '2019-05-29 06:08:22', 1, '2019-05-29 06:08:22', '2019-05-29 06:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `str_order_courier`
--

CREATE TABLE `str_order_courier` (
  `order_courier_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `courier_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `docket_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Processed, 2 = Delivered',
  `send_at` timestamp NULL DEFAULT NULL,
  `deliver_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_order_courier`
--

INSERT INTO `str_order_courier` (`order_courier_id`, `order_id`, `courier_id`, `user_id`, `vendor_id`, `docket_number`, `status_id`, `send_at`, `deliver_at`, `created_at`, `updated_at`) VALUES
(1, 19, 4, 7110, 1, '12212', 2, '2019-05-24 10:40:44', '2019-05-24 10:41:00', '2019-03-07 01:52:51', '2019-05-24 10:41:00'),
(2, 17, 2, 7107, 2, '32143', 2, '2019-03-07 06:06:57', '2019-03-11 12:11:18', '2019-03-07 05:29:49', '2019-03-11 12:11:18'),
(3, 21, 3, 7108, 1, '12213', 1, '2019-05-24 10:43:47', NULL, '2019-05-23 11:44:57', '2019-05-24 10:43:47');

-- --------------------------------------------------------

--
-- Table structure for table `str_order_detail`
--

CREATE TABLE `str_order_detail` (
  `order_detail_id` int(20) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Book, 2 = Bookset, 3 = Stationary',
  `sale_price` decimal(18,2) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `discount_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `discount_price` decimal(18,2) DEFAULT NULL,
  `final_price` decimal(18,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_order_detail`
--

INSERT INTO `str_order_detail` (`order_detail_id`, `order_id`, `product_id`, `vendor_id`, `product_name`, `product_type`, `sale_price`, `qty`, `discount_id`, `discount_price`, `final_price`, `created_at`, `updated_at`) VALUES
(20, 16, 24, 1, 'Admin', 1, '199.00', 1, 1, '0.00', '199.00', '2019-02-25 07:06:40', '2019-02-25 07:06:40'),
(21, 16, 9, 1, 'ADM Systems', 1, '150.00', 1, 1, '0.00', '150.00', '2019-02-25 07:06:40', '2019-02-25 07:06:40'),
(22, 17, 14, 2, 'Satyayoddha Kalki: Eye of Brahma', 1, '215.00', 1, 1, '0.00', '215.00', '2019-02-25 08:30:12', '2019-02-25 08:30:12'),
(23, 17, 17, 2, 'Product 9', 1, '299.00', 1, 1, '0.00', '299.00', '2019-02-25 08:30:12', '2019-02-25 08:30:12'),
(24, 17, 24, 2, 'Admin', 1, '199.00', 1, 1, '0.00', '199.00', '2019-02-25 08:30:12', '2019-02-25 08:30:12'),
(25, 17, 11, 2, 'The Peshwa: War of the Deceivers', 1, '150.00', 1, 1, '0.00', '150.00', '2019-02-25 08:30:12', '2019-02-25 08:30:12'),
(26, 18, 21, 1, 'Mittal product for gujarat board standard 1', 1, '199.00', 3, 1, '0.00', '597.00', '2019-02-26 23:09:39', '2019-02-26 23:09:39'),
(27, 19, 15, 1, 'test', 1, '99.00', 4, 1, '0.00', '396.00', '2019-03-06 00:06:57', '2019-03-06 00:06:57'),
(28, 20, 11, 4, 'The Peshwa: War of the Deceivers', 1, '150.00', 2, 1, '0.00', '300.00', '2019-03-12 11:11:04', '2019-03-12 11:11:04'),
(29, 21, 21, 1, 'Mittal product for gujarat board standard 1', 1, '199.00', 1, 1, '0.00', '199.00', '2019-03-28 13:25:02', '2019-03-28 13:25:02'),
(30, 22, 12, 4, 'Mittal product for gujarat board standard 1', 1, '1099.00', 2, 1, '0.00', '2198.00', '2019-04-02 13:59:53', '2019-04-02 13:59:53'),
(31, 23, 11, 4, 'The Peshwa: War of the Deceivers', 1, '150.00', 1, 1, '0.00', '150.00', '2019-04-03 13:33:44', '2019-04-03 13:33:44'),
(32, 23, 12, 4, 'Mittal product for gujarat board standard 1', 1, '1099.00', 1, 1, '0.00', '1099.00', '2019-04-03 13:33:44', '2019-04-03 13:33:44'),
(33, 24, 11, 4, 'The Peshwa: War of the Deceivers', 1, '150.00', 2, 1, '0.00', '300.00', '2019-04-10 09:17:42', '2019-04-10 09:17:42'),
(34, 25, 4, 4, 'Book set for standard 1', 2, '1000.00', 1, 1, '0.00', '1000.00', '2019-05-09 06:30:05', '2019-05-09 06:30:05'),
(35, 26, 12, 4, 'Mittal product for gujarat board standard 1', 1, '1099.00', 1, 1, '0.00', '1099.00', '2019-05-29 05:59:53', '2019-05-29 05:59:53'),
(36, 27, 12, 4, 'Mittal product for gujarat board standard 1', 1, '1099.00', 1, 1, '0.00', '1099.00', '2019-05-29 06:08:22', '2019-05-29 06:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `str_publisher`
--

CREATE TABLE `str_publisher` (
  `publisher_id` int(10) UNSIGNED NOT NULL,
  `publisher_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_publisher`
--

INSERT INTO `str_publisher` (`publisher_id`, `publisher_name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Pattanaik Devd', 'Pattanaik Devd', 1, '2018-10-23 04:54:17', '2018-10-23 04:54:17'),
(2, 'Penguin Ananda', 'Penguin Ananda', 1, '2018-10-23 06:13:41', '2018-10-23 06:13:41'),
(3, 'Harper Collins', 'Harper Collins', 1, '2018-10-23 06:13:59', '2018-10-23 06:13:59'),
(4, 'Plata Publishing', 'Plata Publishing', 1, '2018-10-23 06:14:32', '2018-10-23 06:14:32'),
(5, 'Universities Press', 'Universities Press', 1, '2018-10-23 06:14:50', '2018-10-23 06:14:50'),
(6, 'Fingerprint! Publishing', NULL, 0, '2018-11-15 06:53:04', '2018-12-05 01:04:00'),
(7, 'Penguin Random House India', NULL, 0, '2018-11-15 07:10:45', '2018-12-04 23:21:09'),
(8, 'asda', NULL, 0, '2018-12-05 01:00:21', '2018-12-05 01:00:24'),
(9, 'asd', 'asdasd', 0, '2018-12-05 01:04:48', '2018-12-05 01:05:06'),
(10, 'asdasas', 'asdasd', 0, '2018-12-05 01:04:52', '2018-12-05 01:04:56'),
(11, 'as', NULL, 0, '2018-12-05 01:06:40', '2018-12-05 01:06:48'),
(12, 'Amazing_Buy', NULL, 1, '2018-12-05 02:00:51', '2018-12-05 02:00:51');

-- --------------------------------------------------------

--
-- Table structure for table `str_role`
--

CREATE TABLE `str_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `str_role`
--

INSERT INTO `str_role` (`role_id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Vendor', NULL, NULL),
(3, 'Institution', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `str_role_vendor`
--

CREATE TABLE `str_role_vendor` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `str_role_vendor`
--

INSERT INTO `str_role_vendor` (`id`, `role_id`, `vendor_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 2, 3, NULL, NULL),
(4, 2, 4, NULL, NULL),
(5, 3, 5, NULL, NULL),
(6, 2, 6, '2018-10-24 07:39:02', '2018-10-24 07:39:02'),
(7, 3, 1, '2018-12-04 02:04:58', '2018-12-04 02:04:58'),
(8, 3, 2, '2018-12-04 02:06:35', '2018-12-04 02:06:35'),
(9, 3, 3, '2018-12-04 02:10:51', '2018-12-04 02:10:51'),
(10, 3, 4, '2018-12-04 02:12:24', '2018-12-04 02:12:24'),
(11, 3, 5, '2018-12-04 02:12:44', '2018-12-04 02:12:44'),
(12, 3, 6, '2018-12-04 02:13:26', '2018-12-04 02:13:26'),
(13, 3, 7, '2018-12-04 02:14:56', '2018-12-04 02:14:56'),
(14, 3, 8, '2018-12-04 02:16:20', '2018-12-04 02:16:20'),
(15, 3, 9, '2018-12-04 02:18:14', '2018-12-04 02:18:14'),
(16, 3, 10, '2018-12-04 02:19:04', '2018-12-04 02:19:04'),
(17, 3, 11, '2018-12-04 02:19:44', '2018-12-04 02:19:44'),
(18, 3, 12, '2018-12-04 02:20:53', '2018-12-04 02:20:53'),
(19, 3, 13, '2018-12-04 02:21:06', '2018-12-04 02:21:06'),
(20, 3, 14, '2018-12-04 02:21:08', '2018-12-04 02:21:08'),
(21, 3, 15, '2018-12-04 02:21:51', '2018-12-04 02:21:51'),
(22, 3, 16, '2018-12-04 04:06:06', '2018-12-04 04:06:06'),
(23, 2, 7, '2018-12-04 23:28:48', '2018-12-04 23:28:48'),
(24, 3, 17, '2018-12-05 03:32:55', '2018-12-05 03:32:55'),
(25, 2, 8, '2019-02-28 04:46:55', '2019-02-28 04:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `str_shoppingcart`
--

CREATE TABLE `str_shoppingcart` (
  `identifier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_shoppingcart`
--

INSERT INTO `str_shoppingcart` (`identifier`, `instance`, `content`, `created_at`, `updated_at`) VALUES
('_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', NULL, NULL),
('1_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', NULL, NULL),
('234234234_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:1:{s:32:\"fec57c984b7ca79891ddeec1760023d8\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":8:{s:5:\"rowId\";s:32:\"fec57c984b7ca79891ddeec1760023d8\";s:2:\"id\";s:1:\"4\";s:3:\"qty\";s:1:\"2\";s:4:\"name\";s:23:\"Book set for standard 1\";s:5:\"price\";d:1000;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":1:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:41:\"images/bookset/thumbnail/4/1545456886.jpg\";s:4:\"type\";s:7:\"bookset\";}}s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";s:11:\"App\\Product\";s:41:\"\0Gloudemans\\Shoppingcart\\CartItem\0taxRate\";i:0;}}}', NULL, NULL),
('701_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', NULL, NULL),
('71010_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:1:{s:32:\"0769811645066c74258174f761d336d1\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":8:{s:5:\"rowId\";s:32:\"0769811645066c74258174f761d336d1\";s:2:\"id\";s:2:\"17\";s:3:\"qty\";i:1;s:4:\"name\";s:9:\"Product 9\";s:5:\"price\";d:299;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":1:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:41:\"images/product/thumbnail/4/1542359528.png\";s:4:\"type\";s:4:\"book\";}}s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";s:11:\"App\\Product\";s:41:\"\0Gloudemans\\Shoppingcart\\CartItem\0taxRate\";i:0;}}}', NULL, NULL),
('71011_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', NULL, NULL),
('71012_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', NULL, NULL),
('7107_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', NULL, NULL),
('7107324_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:1:{s:32:\"0a900723e5108c68085dbb8fb34f410a\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":8:{s:5:\"rowId\";s:32:\"0a900723e5108c68085dbb8fb34f410a\";s:2:\"id\";s:2:\"13\";s:3:\"qty\";i:1;s:4:\"name\";s:34:\"Bharat: The Man Who Built a Nation\";s:5:\"price\";d:100;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":1:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:42:\"images/product/thumbnail/12/1542360232.jpg\";s:4:\"type\";s:4:\"book\";}}s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";s:11:\"App\\Product\";s:41:\"\0Gloudemans\\Shoppingcart\\CartItem\0taxRate\";i:0;}}}', NULL, NULL),
('710784_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', NULL, NULL),
('7108_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', NULL, NULL),
('7109_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:3:{s:32:\"c30c80db61e866d8859a93b231a8ecec\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":8:{s:5:\"rowId\";s:32:\"c30c80db61e866d8859a93b231a8ecec\";s:2:\"id\";s:1:\"4\";s:3:\"qty\";i:1;s:4:\"name\";s:32:\"The Peshwa: War of the Deceivers\";s:5:\"price\";d:120;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":1:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:42:\"images/product/thumbnail/17/1544001779.jpg\";s:4:\"type\";s:4:\"book\";}}s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";s:11:\"App\\Product\";s:41:\"\0Gloudemans\\Shoppingcart\\CartItem\0taxRate\";i:0;}s:32:\"32e0a8269a98bbabe3e6313bd6f6c750\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":8:{s:5:\"rowId\";s:32:\"32e0a8269a98bbabe3e6313bd6f6c750\";s:2:\"id\";s:2:\"21\";s:3:\"qty\";i:1;s:4:\"name\";s:43:\"Mittal product for gujarat board standard 1\";s:5:\"price\";d:199;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":1:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:43:\"images/product/thumbnail/23/1546499217.jpeg\";s:4:\"type\";s:4:\"book\";}}s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";s:11:\"App\\Product\";s:41:\"\0Gloudemans\\Shoppingcart\\CartItem\0taxRate\";i:0;}s:32:\"90151c234021eddf27493783d7168f79\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":8:{s:5:\"rowId\";s:32:\"90151c234021eddf27493783d7168f79\";s:2:\"id\";s:2:\"19\";s:3:\"qty\";i:1;s:4:\"name\";s:58:\"CBSE Computer Science Chapterwise Solved Papers Class 12th\";s:5:\"price\";d:311;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":1:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:42:\"images/product/thumbnail/2/1542359552.jpeg\";s:4:\"type\";s:4:\"book\";}}s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";s:11:\"App\\Product\";s:41:\"\0Gloudemans\\Shoppingcart\\CartItem\0taxRate\";i:0;}}}', NULL, NULL),
('7110_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:0:{}}', NULL, NULL),
('7114_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:1:{s:32:\"0a900723e5108c68085dbb8fb34f410a\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":8:{s:5:\"rowId\";s:32:\"0a900723e5108c68085dbb8fb34f410a\";s:2:\"id\";s:2:\"13\";s:3:\"qty\";i:1;s:4:\"name\";s:34:\"Bharat: The Man Who Built a Nation\";s:5:\"price\";d:100;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":1:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:42:\"images/product/thumbnail/12/1542360232.jpg\";s:4:\"type\";s:4:\"book\";}}s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";s:11:\"App\\Product\";s:41:\"\0Gloudemans\\Shoppingcart\\CartItem\0taxRate\";i:0;}}}', NULL, NULL),
('71234324_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:6:{s:32:\"f62de08aa7983cc87d16166e77f27b98\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":8:{s:5:\"rowId\";s:32:\"f62de08aa7983cc87d16166e77f27b98\";s:2:\"id\";s:1:\"9\";s:3:\"qty\";i:1;s:4:\"name\";s:11:\"ADM Systems\";s:5:\"price\";d:150;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":1:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:42:\"images/product/thumbnail/21/1545313546.jpg\";s:4:\"type\";s:4:\"book\";}}s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";s:11:\"App\\Product\";s:41:\"\0Gloudemans\\Shoppingcart\\CartItem\0taxRate\";i:0;}s:32:\"a0c27682f0bf80487ff3101fedc3f3eb\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":8:{s:5:\"rowId\";s:32:\"a0c27682f0bf80487ff3101fedc3f3eb\";s:2:\"id\";s:2:\"11\";s:3:\"qty\";i:1;s:4:\"name\";s:32:\"The Peshwa: War of the Deceivers\";s:5:\"price\";d:150;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":1:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:42:\"images/product/thumbnail/17/1544001779.jpg\";s:4:\"type\";s:4:\"book\";}}s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";s:11:\"App\\Product\";s:41:\"\0Gloudemans\\Shoppingcart\\CartItem\0taxRate\";i:0;}s:32:\"0a900723e5108c68085dbb8fb34f410a\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":8:{s:5:\"rowId\";s:32:\"0a900723e5108c68085dbb8fb34f410a\";s:2:\"id\";s:2:\"13\";s:3:\"qty\";i:1;s:4:\"name\";s:34:\"Bharat: The Man Who Built a Nation\";s:5:\"price\";d:100;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":1:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:42:\"images/product/thumbnail/12/1542360232.jpg\";s:4:\"type\";s:4:\"book\";}}s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";s:11:\"App\\Product\";s:41:\"\0Gloudemans\\Shoppingcart\\CartItem\0taxRate\";i:0;}s:32:\"96a8f8afd9a5fa274078c5f51f301775\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":8:{s:5:\"rowId\";s:32:\"96a8f8afd9a5fa274078c5f51f301775\";s:2:\"id\";s:2:\"14\";s:3:\"qty\";i:1;s:4:\"name\";s:32:\"Satyayoddha Kalki: Eye of Brahma\";s:5:\"price\";d:215;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":1:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:42:\"images/product/thumbnail/11/1542359443.jpg\";s:4:\"type\";s:4:\"book\";}}s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";s:11:\"App\\Product\";s:41:\"\0Gloudemans\\Shoppingcart\\CartItem\0taxRate\";i:0;}s:32:\"32e0a8269a98bbabe3e6313bd6f6c750\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":8:{s:5:\"rowId\";s:32:\"32e0a8269a98bbabe3e6313bd6f6c750\";s:2:\"id\";s:2:\"21\";s:3:\"qty\";i:1;s:4:\"name\";s:43:\"Mittal product for gujarat board standard 1\";s:5:\"price\";d:199;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":1:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:43:\"images/product/thumbnail/23/1546499217.jpeg\";s:4:\"type\";s:4:\"book\";}}s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";s:11:\"App\\Product\";s:41:\"\0Gloudemans\\Shoppingcart\\CartItem\0taxRate\";i:0;}s:32:\"102beaf1cb2f1ff191a08ef2908a95f5\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":8:{s:5:\"rowId\";s:32:\"102beaf1cb2f1ff191a08ef2908a95f5\";s:2:\"id\";s:2:\"12\";s:3:\"qty\";i:1;s:4:\"name\";s:43:\"Mittal product for gujarat board standard 1\";s:5:\"price\";d:1099;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":1:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:43:\"images/product/thumbnail/23/1546499217.jpeg\";s:4:\"type\";s:4:\"book\";}}s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";s:11:\"App\\Product\";s:41:\"\0Gloudemans\\Shoppingcart\\CartItem\0taxRate\";i:0;}}}', NULL, NULL),
('712343243_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:1:{s:32:\"0a900723e5108c68085dbb8fb34f410a\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":8:{s:5:\"rowId\";s:32:\"0a900723e5108c68085dbb8fb34f410a\";s:2:\"id\";s:2:\"13\";s:3:\"qty\";s:1:\"1\";s:4:\"name\";s:34:\"Bharat: The Man Who Built a Nation\";s:5:\"price\";d:100;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":1:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:42:\"images/product/thumbnail/12/1542360232.jpg\";s:4:\"type\";s:4:\"book\";}}s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";s:11:\"App\\Product\";s:41:\"\0Gloudemans\\Shoppingcart\\CartItem\0taxRate\";i:0;}}}', NULL, NULL),
('7232323_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:1:{s:32:\"32e0a8269a98bbabe3e6313bd6f6c750\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":8:{s:5:\"rowId\";s:32:\"32e0a8269a98bbabe3e6313bd6f6c750\";s:2:\"id\";s:2:\"21\";s:3:\"qty\";i:1;s:4:\"name\";s:43:\"Mittal product for gujarat board standard 1\";s:5:\"price\";d:199;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":1:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:43:\"images/product/thumbnail/23/1546499217.jpeg\";s:4:\"type\";s:4:\"book\";}}s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";s:11:\"App\\Product\";s:41:\"\0Gloudemans\\Shoppingcart\\CartItem\0taxRate\";i:0;}}}', NULL, NULL),
('76767_cart', 'cartlist', 'O:29:\"Illuminate\\Support\\Collection\":1:{s:8:\"\0*\0items\";a:1:{s:32:\"a0c27682f0bf80487ff3101fedc3f3eb\";O:32:\"Gloudemans\\Shoppingcart\\CartItem\":8:{s:5:\"rowId\";s:32:\"a0c27682f0bf80487ff3101fedc3f3eb\";s:2:\"id\";s:2:\"11\";s:3:\"qty\";i:1;s:4:\"name\";s:32:\"The Peshwa: War of the Deceivers\";s:5:\"price\";d:150;s:7:\"options\";O:39:\"Gloudemans\\Shoppingcart\\CartItemOptions\":1:{s:8:\"\0*\0items\";a:2:{s:5:\"image\";s:42:\"images/product/thumbnail/17/1544001779.jpg\";s:4:\"type\";s:4:\"book\";}}s:49:\"\0Gloudemans\\Shoppingcart\\CartItem\0associatedModel\";s:11:\"App\\Product\";s:41:\"\0Gloudemans\\Shoppingcart\\CartItem\0taxRate\";i:0;}}}', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `str_standard`
--

CREATE TABLE `str_standard` (
  `standard_id` int(11) NOT NULL,
  `standard_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_standard`
--

INSERT INTO `str_standard` (`standard_id`, `standard_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '1', 1, '2018-10-23 04:54:30', '2018-10-23 04:54:30'),
(2, '2', 1, '2018-10-23 06:19:04', '2018-10-23 06:19:04'),
(3, '3', 1, '2018-10-23 06:19:07', '2018-10-23 06:19:07'),
(4, '4', 1, '2018-10-23 06:19:09', '2018-10-23 06:19:09'),
(5, '5', 1, '2018-10-23 06:19:12', '2018-10-23 06:19:12'),
(6, '6', 1, '2018-10-23 06:19:14', '2018-10-23 06:19:14'),
(7, '7', 1, '2018-10-23 06:19:16', '2018-10-23 06:19:16'),
(8, '8', 1, '2018-10-23 06:19:18', '2018-10-23 06:19:18'),
(9, '9', 1, '2018-10-23 06:19:20', '2018-10-23 06:19:20'),
(10, '10', 1, '2018-10-23 06:19:24', '2018-10-23 06:19:24'),
(11, 'as', 0, '2018-12-05 00:57:21', '2018-12-05 00:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `str_state`
--

CREATE TABLE `str_state` (
  `state_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_state`
--

INSERT INTO `str_state` (`state_id`, `name`, `country_id`) VALUES
(1, 'Andaman and Nicobar Islands', 1),
(2, 'Andhra Pradesh', 1),
(3, 'Arunachal Pradesh', 1),
(4, 'Assam', 1),
(5, 'Bihar', 1),
(6, 'Chandigarh', 1),
(7, 'Chhattisgarh', 1),
(8, 'Dadra and Nagar Haveli', 1),
(9, 'Daman and Diu', 1),
(10, 'Delhi', 1),
(11, 'Goa', 1),
(12, 'Gujarat', 1),
(13, 'Haryana', 1),
(14, 'Himachal Pradesh', 1),
(15, 'Jammu and Kashmir', 1),
(16, 'Jharkhand', 1),
(17, 'Karnataka', 1),
(18, 'Kenmore', 1),
(19, 'Kerala', 1),
(20, 'Lakshadweep', 1),
(21, 'Madhya Pradesh', 1),
(22, 'Maharashtra', 1),
(23, 'Manipur', 1),
(24, 'Meghalaya', 1),
(25, 'Mizoram', 1),
(26, 'Nagaland', 1),
(27, 'Narora', 1),
(28, 'Natwar', 1),
(29, 'Odisha', 1),
(30, 'Paschim Medinipur', 1),
(31, 'Pondicherry', 1),
(32, 'Punjab', 1),
(33, 'Rajasthan', 1),
(34, 'Sikkim', 1),
(35, 'Tamil Nadu', 1),
(36, 'Telangana', 1),
(37, 'Tripura', 1),
(38, 'Uttar Pradesh', 1),
(39, 'Uttarakhand', 1),
(40, 'Vaishali', 1),
(41, 'West Bengal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `str_status`
--

CREATE TABLE `str_status` (
  `status_id` int(11) UNSIGNED NOT NULL,
  `status_name` varchar(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `str_status`
--

INSERT INTO `str_status` (`status_id`, `status_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Active', 1, NULL, NULL),
(2, 'In-Active', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `str_subject`
--

CREATE TABLE `str_subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `str_subject`
--

INSERT INTO `str_subject` (`subject_id`, `subject_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'English Literature', 1, '2018-11-22 05:42:07', '2018-11-22 05:42:07'),
(2, 'Hindi', 1, '2018-11-22 05:42:26', '2018-11-22 05:42:26'),
(3, 'Mathematics', 1, '2018-11-22 05:42:34', '2018-11-22 05:42:34'),
(4, 'Social Studies', 1, '2018-11-22 05:42:52', '2018-11-22 05:42:52'),
(5, 'Computer', 1, '2018-11-22 05:43:01', '2018-11-22 05:43:01'),
(6, 'Science', 1, '2018-11-22 05:43:09', '2018-11-22 05:43:09'),
(7, 'French', 0, '2018-11-22 05:43:21', '2018-11-22 05:43:43'),
(8, 'asd', 0, '2018-12-05 00:58:40', '2018-12-05 00:58:43'),
(9, 'ads', 0, '2018-12-05 01:00:09', '2018-12-05 01:00:12'),
(10, 'a', 0, '2018-12-05 01:03:24', '2018-12-05 01:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `str_user`
--

CREATE TABLE `str_user` (
  `user_id` int(20) UNSIGNED NOT NULL,
  `institution_id` int(11) UNSIGNED DEFAULT NULL,
  `board_id` int(11) UNSIGNED DEFAULT NULL,
  `standard_id` int(11) UNSIGNED DEFAULT NULL,
  `user_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` bigint(20) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `pin` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `email_verified_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_user`
--

INSERT INTO `str_user` (`user_id`, `institution_id`, `board_id`, `standard_id`, `user_name`, `email`, `password`, `remember_token`, `address1`, `address2`, `city`, `state_id`, `country_id`, `status_id`, `pin`, `phone`, `is_active`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(701, NULL, NULL, NULL, NULL, NULL, NULL, 'LeH75KL5aRogkPpgFR7omVggtSc1SPloYceAnGehIpJu02QWZaybJujd2Hdg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2019-03-11 12:31:51', '2019-03-11 12:31:51'),
(7107, 15, 3, 1, 'Flinnt Community', 'raj@mailinator.com', NULL, 'CFfuzgDBXWdNLkqfOs6gOd56LPvtZDutxDRyaqBtzqZ1gn6u3SxNbLA3eeAQ', '604 Iscon Elegance', 'Ahmedabad', 'Ahmedabad', 12, NULL, NULL, '380015', '98765456798', 1, NULL, '2019-01-17 06:29:45', '2019-04-10 11:20:45'),
(7108, 1, 3, 1, 'Test', 'satellite@gmail.com', NULL, 'dlh6RZUa8XY0tmN06nghd0IVWLGvu3aq7QKnHai6vBblH4aWgM6M7f1iAnJ9', '604 Iscon Elegance', 'Ahmedabad', 'Ahmedabad', 12, NULL, NULL, '380015', '32323232323', 1, NULL, '2019-03-01 01:34:51', '2019-03-28 13:24:19'),
(7109, NULL, NULL, NULL, NULL, NULL, NULL, 'ZK1s1A19cExWmra8kNRwf3fZwuVzYh36EtLe1wv0rmmjDJI6zidDA0ma2bIi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2019-03-05 08:09:03', '2019-03-05 08:09:03'),
(7110, 15, 3, 5, 'Demo Salvetor', 'demon@mailinator.com', NULL, '4QLyduwpjKzv6162ezhyghKiQq9BkQeY8VQlSpo5mN4xURfc78aV254PLFqG', '684 Abernathy Rd NE,', 'Sandy Springs,', 'Georgia', 11, NULL, NULL, '322212', '9897654367', 1, NULL, '2019-03-05 08:09:26', '2019-03-06 00:06:29'),
(7112, NULL, NULL, NULL, NULL, NULL, NULL, 'PxG95aO5BWnKCXIfLZ5CVkz1IkP6bFLMvwjU13gMcwi0rQ6oBoNuiZa0X4Ko', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2019-03-05 08:18:00', '2019-03-05 08:18:00'),
(7114, NULL, NULL, NULL, NULL, NULL, NULL, 'Dms2sDgUKnX9iMNnnZbYqsvpYziXwSNo5RczP5Uz9C8gJOn5y4PqNXppLU2R', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2019-03-05 08:21:45', '2019-03-05 08:21:45'),
(71010, NULL, NULL, NULL, NULL, NULL, NULL, 'VkFumEX7KWgpMsAYsAFzuVAKPx5QV9J3m42BE9BTBoTqV3wMgWrP9yVM2XGY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2019-03-05 08:16:17', '2019-03-05 08:16:17'),
(71011, NULL, NULL, NULL, NULL, NULL, NULL, 'v6GByA5BmRllrh2G9P7OYmPZulIJpjQy8UzZATrO0T1IiithRQJHfXO6fZJj', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2019-03-05 08:11:14', '2019-03-05 08:11:14'),
(71012, NULL, NULL, NULL, NULL, NULL, NULL, 'LOkwvGAjhSogA45zHUKytxKNDaeCBNSJictpquSI8mTASE8az7qwqx8OOm2V', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2019-03-05 08:21:32', '2019-03-05 08:21:32'),
(71014, NULL, NULL, NULL, NULL, NULL, NULL, 'Kd2eLS9P7ltsRQT1isPEFk4MiyKpkRQcLjSJP8Oj6wbmaYZGLmv9LF1jaeuu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2019-03-05 08:29:59', '2019-03-05 08:29:59'),
(76767, NULL, NULL, NULL, NULL, NULL, NULL, 'j0p8WVMyvJvkKYmm391NjHCT6VRx3aTkUzlFTRGXnrhkYrwyHAU9fYbsTLkC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2019-03-12 11:53:33', '2019-03-12 11:53:33'),
(710784, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2019-03-19 12:05:10', '2019-03-19 12:05:10'),
(7107324, 1, 3, 1, 'Extra User', 'extra@mailinator.com', NULL, 'tPmqZkY0MLNgtHZLV21LfaC8ghLZf9OI1V2nvLg31C1bN6vcco8ITKKx9jPK', 'Ahmedabad', 'Ahmedabad', 'Ahmedabad', 12, NULL, NULL, '84794870', '98749879847', 1, NULL, '2019-03-19 07:08:54', '2019-03-19 07:12:53'),
(7232323, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2019-03-18 13:06:10', '2019-03-18 13:06:10'),
(71234324, NULL, NULL, NULL, NULL, NULL, NULL, 'rKaWKHnqqBPS7fiSUn6y9TZ0uI1hKI1QXWuIl2hcuVICAxmPqSqfpC5N4rCJ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2019-03-19 04:47:18', '2019-03-19 04:47:18'),
(234234234, 15, 1, 1, 'User 234', 'user@mailinator.com', NULL, 'UGkp1umq5qLFK57gN1YrchjJ66aXR1J7nomKrzj3U4zSS3t9hjDoY0Zuo1b9', 'Ahmedabad', 'Ahmedabad', 'Ahmedabad', 10, NULL, NULL, '380015', '123123213123', 1, NULL, '2019-03-19 07:14:00', '2019-03-19 11:59:52'),
(712343243, NULL, NULL, NULL, NULL, NULL, NULL, 'x4n3OHmsIuBmb5jOFnkP37j1RfPPw2IyQtarfY4kToFZWgGvEKYzoewwyW6G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2019-03-19 06:12:58', '2019-03-19 06:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `str_user_address`
--

CREATE TABLE `str_user_address` (
  `user_address_id` int(20) UNSIGNED NOT NULL,
  `user_id` int(20) UNSIGNED NOT NULL,
  `fullname` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `address1` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` bigint(20) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `address_type` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `pin` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_user_address`
--

INSERT INTO `str_user_address` (`user_address_id`, `user_id`, `fullname`, `address1`, `address2`, `city`, `state_id`, `country_id`, `status_id`, `address_type`, `pin`, `phone`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'iscon elegance', NULL, 'Ahmedabad', 12, 1, NULL, NULL, NULL, NULL, 1, '2019-01-31 03:40:46', '2019-01-31 03:40:46'),
(2, 1, NULL, 'iscon elegance', NULL, 'Ahmedabad', 12, 1, NULL, NULL, NULL, NULL, 1, '2019-01-31 03:56:45', '2019-01-31 03:56:45'),
(3, 1, 'chirag', 'iscon elegance', NULL, 'Ahmedabad', 12, 1, NULL, 'home', NULL, '22222222', 1, '2019-02-04 05:44:18', '2019-02-04 05:44:18'),
(4, 7107, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, '2019-02-06 02:21:29', '2019-02-06 02:21:29'),
(10, 7107, 'chirag', 'iscon elegance', 'ahmedabad', 'Ahmedabad', 12, 1, NULL, 'school', '362150', '9876543210', 1, '2019-02-07 06:20:44', '2019-04-08 07:20:09'),
(11, 7110, 'Satellite', '604 Iscon Elegance', 'Ahmedabad', 'Ahmedabad', 12, 1, NULL, 'school', '380015', '7966168834', 1, '2019-03-05 23:05:41', '2019-03-05 23:05:41'),
(12, 76767, 'ADM Systems', '604 Iscon Elegance', 'Ahmedabad', 'Ahmedabad', 10, 1, NULL, 'school', '380015', '098765434', 1, '2019-03-12 11:54:02', '2019-03-12 11:54:02'),
(13, 71234324, 'ADM', '604 Iscon Elegance', 'Ahmedabad', 'Ahmedabad', 12, 1, NULL, 'home', '380015', '1234123123', 1, '2019-03-19 04:51:00', '2019-03-19 04:51:00'),
(14, 7108, 'ADM Systems', '604 Iscon Elegance, Ahmedabad', 'Ahmedabad', 'Ahmedabad', 12, 1, NULL, 'home', '380015', '9888867567', 1, '2019-03-28 13:24:55', '2019-03-28 13:24:55'),
(15, 7107, 'chirag', 'iscon elegance', NULL, 'Ahmedabad', 12, 1, NULL, 'home', NULL, '22222222', 1, '2019-04-08 07:17:41', '2019-04-08 07:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `str_vendor`
--

CREATE TABLE `str_vendor` (
  `vendor_id` int(20) UNSIGNED NOT NULL,
  `vendor_name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_address1` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_address2` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_city` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_state_id` bigint(20) NOT NULL,
  `vendor_country_id` int(11) NOT NULL,
  `vendor_status_id` int(11) NOT NULL,
  `vendor_pin` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_gst_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flint_charge` int(11) NOT NULL,
  `vendor_phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `email_verified_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `str_vendor`
--

INSERT INTO `str_vendor` (`vendor_id`, `vendor_name`, `email`, `password`, `remember_token`, `vendor_address1`, `vendor_address2`, `vendor_city`, `vendor_state_id`, `vendor_country_id`, `vendor_status_id`, `vendor_pin`, `vendor_gst_number`, `flint_charge`, `vendor_phone`, `is_active`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(1, 'ADM Systems', 'admin@admin.com', '$2y$10$e5uahzb4gwMF8NzEDhnebOPYF9G2/72dlWJLN0E6G5iwNtFQKvaI.', 'EsHIBdAVVs4lT5rNuXF6l2TE05xqvGNgDquoi2ZaNlrIJoeVg7tTrnF7aX1U', '604 Iscon Elegance', 'Ahmedabad', 'Ahmedabad', 12, 1, 1, '380015', 'ASD434234', 5, '07966168834', 1, '2018-10-15 18:30:00', '2018-10-15 13:00:00', '2019-04-10 07:32:38'),
(2, 'Chirag', 'chirag@mailinator.com', '$2y$10$s1AR9q3m05nJ.UWXBVEyFuf.K/7vusfsWipL07gnvGDKPZ3Z2kNE6', 'Y62Uzy8dyrdhpxad7t0avZ1f4NTaDi1C4g5qCGRIy4WG8GkNtEsfV1ItGQKg', 'Ghuma gam', 'Ahmedabad', 'Ahmedabad', 12, 1, 1, '380015', 'CHIRAGGSTN', 1, '07966168834', 1, NULL, '2018-10-23 04:45:17', '2018-12-04 07:58:48'),
(3, 'Westland lications Limited', 'westland.lications@mailinator.com', '$2y$10$mGOuq5VQbfnPEut1i3x2POZ9BRlpw8Y7eT.uSWt0Ia45uLRK9jp5a', NULL, '604 Iscon Elegance', NULL, 'Ahmedabad', 12, 1, 2, '380015', 'GHUMAGST', 5, '07966168834', 0, NULL, '2018-10-23 04:47:01', '2018-12-04 04:26:16'),
(4, 'Mittal Books India', 'mittal@mailinator.com', '$2y$10$86.v8S/UMB4zREgwGODAZ.Ff77.JhFoy3PqzGHFnTKy3SKZ386sOu', 'hkmzWaQkCDQWLuSqKCYc4JBCOVOHQQSwUpx25pzFnTzfyx5djTBBHTyo0Jbu', '604 Iscon Elegance', 'Ahmedabad', 'Ahmedabad', 12, 1, 1, '380015', 'MITTALGST', 5, '07966168834', 1, NULL, '2018-10-23 06:06:03', '2019-01-01 23:20:15'),
(5, 'School', 'institution@mailinator.com', '$2y$10$pyOV9eeKngiWypYLTAagG.PBOWGZp3Y82ME7dVeNLsZEmwGjDMkvO', 'YkAGr7G8z8pHsZNcsnPzgnwJuFfTw1JFD2GX0BYAdjCXQ6THRZyIbzzndErs', 'S.G.Road', NULL, 'Rajkot', 12, 1, 1, '380015', 'SCHOOLGST', 5, '07966168834', 1, NULL, '2018-10-24 07:23:06', '2018-12-04 23:46:05'),
(6, 'Cloudtail India', 'india@mailinator.com', '$2y$10$r1Cwf42xQlQVROKhPPjI.O76r2glUCDGOaNPCumOKW0PcDo//Orqm', 'SbPQqcSseKWTZJI2C5yc71FNC8N5bRQuxjc5lAJ3OMDUnWpJ19InVZFtKmVe', '604 Iscon Elegance', NULL, 'Ahmedabad', 12, 1, 1, '380015', 'BHAGAVATIGST', 5, '07966168834', 1, NULL, '2018-10-24 07:39:02', '2019-01-04 06:30:20'),
(7, 'VBD BOOKS DISTRIBUTORS', 'new@mailinator.com', '$2y$10$z84A.hiKQOlCDnJjxIF.p.BNX9X01IMy8T/X7vx1hB7NL64PNxObG', NULL, '604 Iscon Elegance', NULL, 'Ahmedabad', 1, 1, 2, '380015', 'BHAGAVATIGST', 5, '07966168834', 0, NULL, '2018-12-04 23:28:48', '2018-12-05 01:09:44'),
(8, 'CrossWord', 'raj@mailinator.com', '$2y$10$gBuugkSBvq/ud2y1kKQ5g.mA99sJ3PwLryLXjiCIdRDedBVhfV5Ma', NULL, '604 Iscon Elegance', 'Ahmedabad', 'Ahmedabad', 12, 1, 1, '380015', '23', 5, '+917966168834', 1, NULL, '2019-02-28 04:46:55', '2019-02-28 04:46:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `str_admin`
--
ALTER TABLE `str_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `str_attribute`
--
ALTER TABLE `str_attribute`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `str_audits`
--
ALTER TABLE `str_audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  ADD KEY `audits_user_id_user_type_index` (`user_id`,`user_type`);

--
-- Indexes for table `str_author`
--
ALTER TABLE `str_author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `str_board`
--
ALTER TABLE `str_board`
  ADD PRIMARY KEY (`board_id`);

--
-- Indexes for table `str_book`
--
ALTER TABLE `str_book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `FK_book_publisher_publisher_id` (`publisher_id`),
  ADD KEY `FK_book_language_language_id` (`language_id`);

--
-- Indexes for table `str_book_attribute`
--
ALTER TABLE `str_book_attribute`
  ADD PRIMARY KEY (`book_attribute_id`),
  ADD KEY `FK_book_attribute_attribute_id` (`attribute_id`),
  ADD KEY `FK_book_attribute_book_id` (`book_id`);

--
-- Indexes for table `str_book_author`
--
ALTER TABLE `str_book_author`
  ADD PRIMARY KEY (`book_author_id`);

--
-- Indexes for table `str_book_board`
--
ALTER TABLE `str_book_board`
  ADD PRIMARY KEY (`book_board_id`);

--
-- Indexes for table `str_book_category_tree`
--
ALTER TABLE `str_book_category_tree`
  ADD PRIMARY KEY (`book_category_tree_id`);

--
-- Indexes for table `str_book_description`
--
ALTER TABLE `str_book_description`
  ADD PRIMARY KEY (`book_description_id`);

--
-- Indexes for table `str_book_image`
--
ALTER TABLE `str_book_image`
  ADD PRIMARY KEY (`book_image_id`);

--
-- Indexes for table `str_book_review`
--
ALTER TABLE `str_book_review`
  ADD PRIMARY KEY (`book_review_id`);

--
-- Indexes for table `str_book_set`
--
ALTER TABLE `str_book_set`
  ADD PRIMARY KEY (`book_set_id`);

--
-- Indexes for table `str_book_set_book`
--
ALTER TABLE `str_book_set_book`
  ADD PRIMARY KEY (`book_set_book_id`);

--
-- Indexes for table `str_book_set_description`
--
ALTER TABLE `str_book_set_description`
  ADD PRIMARY KEY (`book_set_description_id`);

--
-- Indexes for table `str_book_set_image`
--
ALTER TABLE `str_book_set_image`
  ADD PRIMARY KEY (`book_set_image_id`);

--
-- Indexes for table `str_book_standard`
--
ALTER TABLE `str_book_standard`
  ADD PRIMARY KEY (`book_standard_id`);

--
-- Indexes for table `str_book_vendor`
--
ALTER TABLE `str_book_vendor`
  ADD PRIMARY KEY (`book_vendor_id`);

--
-- Indexes for table `str_category`
--
ALTER TABLE `str_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `str_category_tree`
--
ALTER TABLE `str_category_tree`
  ADD PRIMARY KEY (`category_tree_id`),
  ADD KEY `FK_category_tree_child_category_id` (`child_category_id`);

--
-- Indexes for table `str_condition`
--
ALTER TABLE `str_condition`
  ADD PRIMARY KEY (`condition_id`);

--
-- Indexes for table `str_country`
--
ALTER TABLE `str_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `str_courier`
--
ALTER TABLE `str_courier`
  ADD PRIMARY KEY (`courier_id`);

--
-- Indexes for table `str_institution`
--
ALTER TABLE `str_institution`
  ADD PRIMARY KEY (`institution_id`);

--
-- Indexes for table `str_institution_board_standard`
--
ALTER TABLE `str_institution_board_standard`
  ADD PRIMARY KEY (`institution_board_standard_id`);

--
-- Indexes for table `str_institution_board_standard_bookset`
--
ALTER TABLE `str_institution_board_standard_bookset`
  ADD PRIMARY KEY (`institution_board_standard_bookset_id`);

--
-- Indexes for table `str_institution_board_standard_subject`
--
ALTER TABLE `str_institution_board_standard_subject`
  ADD PRIMARY KEY (`institution_board_standard_subject_id`);

--
-- Indexes for table `str_institution_bookset_vendor_price`
--
ALTER TABLE `str_institution_bookset_vendor_price`
  ADD PRIMARY KEY (`institution_book_set_vendor_id`);

--
-- Indexes for table `str_institution_book_vendor_price`
--
ALTER TABLE `str_institution_book_vendor_price`
  ADD PRIMARY KEY (`institution_book_vendor_id`),
  ADD KEY `FK_institution_book_vendor_price_book_id` (`book_id`),
  ADD KEY `FK_institution_book_vendor_price_condition_id` (`condition_id`),
  ADD KEY `FK_institution_book_vendor_price_vendor_id` (`vendor_id`),
  ADD KEY `FK_institution_book_vendor_price_institution_id` (`institution_id`);

--
-- Indexes for table `str_institution_vendor`
--
ALTER TABLE `str_institution_vendor`
  ADD PRIMARY KEY (`institution_vendor_id`);

--
-- Indexes for table `str_language`
--
ALTER TABLE `str_language`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `str_migrations`
--
ALTER TABLE `str_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `str_order`
--
ALTER TABLE `str_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `str_order_courier`
--
ALTER TABLE `str_order_courier`
  ADD PRIMARY KEY (`order_courier_id`);

--
-- Indexes for table `str_order_detail`
--
ALTER TABLE `str_order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `str_publisher`
--
ALTER TABLE `str_publisher`
  ADD PRIMARY KEY (`publisher_id`);

--
-- Indexes for table `str_role`
--
ALTER TABLE `str_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `str_role_vendor`
--
ALTER TABLE `str_role_vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `str_shoppingcart`
--
ALTER TABLE `str_shoppingcart`
  ADD PRIMARY KEY (`identifier`,`instance`);

--
-- Indexes for table `str_standard`
--
ALTER TABLE `str_standard`
  ADD PRIMARY KEY (`standard_id`);

--
-- Indexes for table `str_state`
--
ALTER TABLE `str_state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `str_status`
--
ALTER TABLE `str_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `str_subject`
--
ALTER TABLE `str_subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `str_user`
--
ALTER TABLE `str_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `str_user_address`
--
ALTER TABLE `str_user_address`
  ADD PRIMARY KEY (`user_address_id`);

--
-- Indexes for table `str_vendor`
--
ALTER TABLE `str_vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `str_admin`
--
ALTER TABLE `str_admin`
  MODIFY `admin_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `str_attribute`
--
ALTER TABLE `str_attribute`
  MODIFY `attribute_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `str_audits`
--
ALTER TABLE `str_audits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `str_author`
--
ALTER TABLE `str_author`
  MODIFY `author_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `str_board`
--
ALTER TABLE `str_board`
  MODIFY `board_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `str_book`
--
ALTER TABLE `str_book`
  MODIFY `book_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `str_book_attribute`
--
ALTER TABLE `str_book_attribute`
  MODIFY `book_attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `str_book_author`
--
ALTER TABLE `str_book_author`
  MODIFY `book_author_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=387;
--
-- AUTO_INCREMENT for table `str_book_board`
--
ALTER TABLE `str_book_board`
  MODIFY `book_board_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;
--
-- AUTO_INCREMENT for table `str_book_category_tree`
--
ALTER TABLE `str_book_category_tree`
  MODIFY `book_category_tree_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;
--
-- AUTO_INCREMENT for table `str_book_description`
--
ALTER TABLE `str_book_description`
  MODIFY `book_description_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=712;
--
-- AUTO_INCREMENT for table `str_book_image`
--
ALTER TABLE `str_book_image`
  MODIFY `book_image_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;
--
-- AUTO_INCREMENT for table `str_book_review`
--
ALTER TABLE `str_book_review`
  MODIFY `book_review_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `str_book_set`
--
ALTER TABLE `str_book_set`
  MODIFY `book_set_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `str_book_set_book`
--
ALTER TABLE `str_book_set_book`
  MODIFY `book_set_book_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=607;
--
-- AUTO_INCREMENT for table `str_book_set_description`
--
ALTER TABLE `str_book_set_description`
  MODIFY `book_set_description_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=329;
--
-- AUTO_INCREMENT for table `str_book_set_image`
--
ALTER TABLE `str_book_set_image`
  MODIFY `book_set_image_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `str_book_standard`
--
ALTER TABLE `str_book_standard`
  MODIFY `book_standard_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=349;
--
-- AUTO_INCREMENT for table `str_book_vendor`
--
ALTER TABLE `str_book_vendor`
  MODIFY `book_vendor_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `str_category`
--
ALTER TABLE `str_category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `str_category_tree`
--
ALTER TABLE `str_category_tree`
  MODIFY `category_tree_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `str_condition`
--
ALTER TABLE `str_condition`
  MODIFY `condition_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `str_country`
--
ALTER TABLE `str_country`
  MODIFY `country_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `str_courier`
--
ALTER TABLE `str_courier`
  MODIFY `courier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `str_institution`
--
ALTER TABLE `str_institution`
  MODIFY `institution_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `str_institution_board_standard`
--
ALTER TABLE `str_institution_board_standard`
  MODIFY `institution_board_standard_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `str_institution_board_standard_bookset`
--
ALTER TABLE `str_institution_board_standard_bookset`
  MODIFY `institution_board_standard_bookset_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT for table `str_institution_board_standard_subject`
--
ALTER TABLE `str_institution_board_standard_subject`
  MODIFY `institution_board_standard_subject_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `str_institution_bookset_vendor_price`
--
ALTER TABLE `str_institution_bookset_vendor_price`
  MODIFY `institution_book_set_vendor_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `str_institution_book_vendor_price`
--
ALTER TABLE `str_institution_book_vendor_price`
  MODIFY `institution_book_vendor_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `str_institution_vendor`
--
ALTER TABLE `str_institution_vendor`
  MODIFY `institution_vendor_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `str_language`
--
ALTER TABLE `str_language`
  MODIFY `language_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `str_migrations`
--
ALTER TABLE `str_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `str_order`
--
ALTER TABLE `str_order`
  MODIFY `order_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `str_order_courier`
--
ALTER TABLE `str_order_courier`
  MODIFY `order_courier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `str_order_detail`
--
ALTER TABLE `str_order_detail`
  MODIFY `order_detail_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `str_publisher`
--
ALTER TABLE `str_publisher`
  MODIFY `publisher_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `str_role`
--
ALTER TABLE `str_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `str_role_vendor`
--
ALTER TABLE `str_role_vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `str_standard`
--
ALTER TABLE `str_standard`
  MODIFY `standard_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `str_state`
--
ALTER TABLE `str_state`
  MODIFY `state_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `str_status`
--
ALTER TABLE `str_status`
  MODIFY `status_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `str_subject`
--
ALTER TABLE `str_subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `str_user`
--
ALTER TABLE `str_user`
  MODIFY `user_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=712343244;
--
-- AUTO_INCREMENT for table `str_user_address`
--
ALTER TABLE `str_user_address`
  MODIFY `user_address_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `str_vendor`
--
ALTER TABLE `str_vendor`
  MODIFY `vendor_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `str_book`
--
ALTER TABLE `str_book`
  ADD CONSTRAINT `FK_book_language_language_id` FOREIGN KEY (`language_id`) REFERENCES `str_language` (`language_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_book_publisher_publisher_id` FOREIGN KEY (`publisher_id`) REFERENCES `str_publisher` (`publisher_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `str_book_attribute`
--
ALTER TABLE `str_book_attribute`
  ADD CONSTRAINT `FK_book_attribute_attribute_id` FOREIGN KEY (`attribute_id`) REFERENCES `str_attribute` (`attribute_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_book_attribute_book_id` FOREIGN KEY (`book_id`) REFERENCES `str_book` (`book_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `str_category_tree`
--
ALTER TABLE `str_category_tree`
  ADD CONSTRAINT `FK_category_tree_child_category_id` FOREIGN KEY (`child_category_id`) REFERENCES `str_category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `str_institution_book_vendor_price`
--
ALTER TABLE `str_institution_book_vendor_price`
  ADD CONSTRAINT `FK_institution_book_vendor_price_book_id` FOREIGN KEY (`book_id`) REFERENCES `str_book` (`book_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_institution_book_vendor_price_condition_id` FOREIGN KEY (`condition_id`) REFERENCES `str_condition` (`condition_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_institution_book_vendor_price_institution_id` FOREIGN KEY (`institution_id`) REFERENCES `str_institution` (`institution_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_institution_book_vendor_price_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `str_vendor` (`vendor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
