-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 06:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datn2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `img_banner` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `banner_position` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `offer_text` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `img_banner`, `link`, `banner_position`, `created_at`, `updated_at`, `deleted_at`, `offer_text`, `title`, `description`) VALUES
(1, 'public/slider/38cl8IqtZuGCeSsfWWy5JiVvQ2Jb3JMfcVqpEdTf.png', NULL, '1', NULL, '2024-12-17 18:33:38', NULL, 'LỄ HỘI MÙA ĐÔNG', 'Thời gian có hạn', 'Từ ngày 17/12 đến 25/12'),
(2, 'public/banner/dszuenjnhplXBHdE6lPjm5m9vGvUwRN6xYzoX9Qu.jpg', NULL, '3', NULL, '2024-12-18 16:45:49', NULL, NULL, NULL, NULL),
(3, 'public/banner/BjNK3TfrSzEX0MIKC4ZUjBRNO5chZCkj0Dsa72aa.png', NULL, '3', NULL, '2024-12-18 16:48:10', NULL, NULL, NULL, NULL),
(4, 'public/banner/48KIWcLNMfnmaddS5jD1EIPrXHvc90PiJRPC52fJ.png', NULL, '4', NULL, '2024-12-18 16:48:40', NULL, NULL, NULL, NULL),
(5, 'public/slider/yBuOzjAePL7zzzRv8AbNFO5NRZQWY9J3MNknpQLP.png', NULL, '1', NULL, NULL, NULL, 'Sale sập sàn', 'Mùa đông không lạnh', 'Từ ngày 16/12 đến 28/12');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_amount` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 5, 0, '2024-12-18 20:05:19', '2024-12-18 20:05:44');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_image` longtext DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` bigint(20) UNSIGNED DEFAULT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `image_cover` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `note`, `image_cover`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Áo', 'ao', 'Ghi chú danh mục Áo', 'https://studiovietnam.com/wp-content/uploads/2022/12/mau-anh-chup-ao-thun-nam-21.jpg', NULL, NULL, NULL),
(2, 'Quần', 'quan', 'Ghi chú danh mục Quần', 'https://studiovietnam.com/wp-content/uploads/2022/12/mau-anh-chup-ao-thun-nam-21.jpg', NULL, NULL, NULL),
(3, 'Váy', 'vay', 'Ghi chú danh mục Váy', 'https://studiovietnam.com/wp-content/uploads/2022/12/mau-anh-chup-ao-thun-nam-21.jpg', NULL, NULL, NULL),
(4, 'Túi sách', 'tui-sach', 'Ghi chú danh mục Túi sách', 'https://studiovietnam.com/wp-content/uploads/2022/12/mau-anh-chup-ao-thun-nam-21.jpg', NULL, NULL, NULL),
(5, 'Trang phục truyền thống', 'trang-phuc-truyen-thong', 'Bao gồm áo dài, trang phục dân tộc', NULL, '2024-12-17 06:05:16', '2024-12-17 06:05:16', NULL),
(6, 'Áo Nam', 'ao-nam', 'Chưa cập nhật mô tả chi tiết!', 'categories/CntNlJ0S1XrSZKeRjYOdBz8QSFWxt0HdhYTCnv4x.jpg', '2024-12-18 19:32:16', '2024-12-18 19:32:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `color_attributes`
--

CREATE TABLE `color_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color_value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `color_attributes`
--

INSERT INTO `color_attributes` (`id`, `color_value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '#FF0000', NULL, NULL, NULL),
(2, '#0000FF', NULL, NULL, NULL),
(3, '#FFFF00', NULL, NULL, NULL),
(4, '#FFFFFF', NULL, NULL, NULL),
(5, '#000000', NULL, NULL, NULL),
(6, '#FFA500', NULL, NULL, NULL),
(7, '#800080', NULL, NULL, NULL),
(8, '#FFC0CB', NULL, NULL, NULL),
(9, '#808080', NULL, NULL, NULL),
(10, '#A52A2A', NULL, NULL, NULL),
(11, '#f3eae6', NULL, NULL, NULL),
(12, '#03b0a1', NULL, NULL, NULL),
(13, '#252c4c', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `products_id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `comments` text NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `comment_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `products_id`, `users_id`, `comments`, `rating`, `comment_date`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 2, 5, 'Sản phẩm chất vãi ò 1', 2, '2024-12-17 12:47:21', NULL, NULL, NULL, 2),
(2, 3, 5, 'Sản phẩm chất vãi ò 2', 5, '2024-12-17 12:47:21', NULL, NULL, NULL, 2),
(3, 3, 4, 'Sản phẩm chất vãi ò 3', 3, '2024-12-17 12:47:21', NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `discount_amount` int(11) NOT NULL,
  `discount_type` enum('percent','fixed') NOT NULL,
  `quantity` int(11) NOT NULL,
  `minimum_spend` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `date_start`, `date_end`, `code`, `description`, `discount_amount`, `discount_type`, `quantity`, `minimum_spend`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Coupon 1', '2024-12-17 12:47:21', '2025-01-16 12:47:21', 'GIAMGIA1', 'Mô tả mã giảm giá 1', 22, 'percent', 100, 102948, NULL, NULL, NULL),
(2, 'Coupon 2', '2024-12-17 12:47:21', '2025-01-16 12:47:21', 'GIAMGIA2', 'Mô tả mã giảm giá 2', 28, 'percent', 100, 381898, NULL, NULL, NULL),
(3, 'Coupon 3', '2024-12-17 12:47:21', '2025-01-16 12:47:21', 'GIAMGIA3', 'Mô tả mã giảm giá 3', 16, 'percent', 100, 455059, NULL, NULL, NULL),
(4, 'Coupon 4', '2024-12-17 12:47:21', '2025-01-16 12:47:21', 'GIAMGIA4', 'Mô tả mã giảm giá 4', 29, 'percent', 100, 333573, NULL, NULL, NULL),
(5, 'Coupon 5', '2024-12-17 12:47:21', '2025-01-16 12:47:21', 'GIAMGIA5', 'Mô tả mã giảm giá 5', 44, 'percent', 100, 138003, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_supports`
--

CREATE TABLE `customer_supports` (
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_title` varchar(255) NOT NULL,
  `ticket_content` text NOT NULL,
  `ticket_status` tinyint(4) NOT NULL DEFAULT 1,
  `ticket_priority` tinyint(4) NOT NULL DEFAULT 1,
  `ticket_category` varchar(255) NOT NULL,
  `ticket_attachment` varchar(255) DEFAULT NULL,
  `ticket_ai_analyze` text DEFAULT NULL,
  `ticket_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_support_detail`
--

CREATE TABLE `customer_support_detail` (
  `ticket_detail_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_reply` text NOT NULL,
  `ticket_reply_attachment` varchar(255) DEFAULT NULL,
  `ticket_reply_by` varchar(255) NOT NULL,
  `ticket_reply_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ticket_auto_reply_ai` tinyint(4) NOT NULL DEFAULT 0,
  `mark_as_spam` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2020_12_15_224331_create_permission_tables', 1),
(6, '2024_10_04_030750_create_color_attributes_table', 1),
(7, '2024_10_04_030750_create_size_attributes_table', 1),
(8, '2024_10_04_061402_create_categories_table', 1),
(9, '2024_10_04_061402_create_users_table', 1),
(10, '2024_10_04_061403_create_coupons_table', 1),
(11, '2024_10_04_061403_create_sub_categories_table', 1),
(12, '2024_10_04_061404_create_banners_table', 1),
(13, '2024_10_04_061405_create_products_table', 1),
(14, '2024_10_04_061406_create_comments_table', 1),
(15, '2024_10_04_061407_create_orders_table', 1),
(16, '2024_10_04_061407_create_product_variants_table', 1),
(17, '2024_10_04_061408_create_order_details_table', 1),
(18, '2024_10_04_061409_create_product_image_table', 1),
(19, '2024_10_18_081646_create_tags_table', 1),
(20, '2024_10_18_134014_product_tag', 1),
(21, '2024_10_19_143532_create_posts_table', 1),
(22, '2024_10_21_152901_add_status_to_comments_table', 1),
(23, '2024_10_21_164336_create_customer_supports_table', 1),
(24, '2024_10_21_165059_create_customer_support_detail_table', 1),
(25, '2024_10_24_155748_update_default_status_in_comments_table', 1),
(26, '2024_10_29_063137_create_notifications_table', 1),
(27, '2024_10_29_140353_add_table_banner_desc_to_banners', 1),
(28, '2024_11_17_044854_create_carts_table', 1),
(29, '2024_11_17_045052_create_cart_items_table', 1),
(30, '2024_11_17_232632_create_wallet_table', 1),
(31, '2024_11_17_232644_create_withdraw_request', 1),
(32, '2024_11_17_232652_create_trx_history', 1),
(33, '2024_11_17_232705_create_trx_history_detail_table', 1),
(34, '2024_11_17_232725_create_user_wallet_logging_table', 1),
(35, '2024_11_17_232757_create_trusted_devices_table', 1),
(36, '2024_11_18_173555_create_user_wallet_detail_table', 1),
(37, '2024_11_23_224652_add_admin_note_to_wallet_table', 1),
(38, '2024_11_29_231316_create_otp_table', 1),
(39, '2024_12_04_205454_create_user_shipping_table', 1),
(40, '2024_12_11_155136_create_wishlists_table', 1),
(41, '2024_12_29_163611_add_webauthn', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `is_read`, `read_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Notification Title 1', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(2, NULL, 'Notification Title 2', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(3, NULL, 'Notification Title 3', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(4, NULL, 'Notification Title 4', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(5, NULL, 'Notification Title 5', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(6, NULL, 'Notification Title 6', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(7, NULL, 'Notification Title 7', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(8, NULL, 'Notification Title 8', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(9, NULL, 'Notification Title 9', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(10, NULL, 'Notification Title 10', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, NULL, '2024-12-17 05:47:21', NULL),
(11, NULL, 'Notification Title 11', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, NULL, '2024-12-17 05:47:21', NULL),
(12, NULL, 'Notification Title 12', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(13, NULL, 'Notification Title 13', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(14, NULL, 'Notification Title 14', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(15, NULL, 'Notification Title 15', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(16, NULL, 'Notification Title 16', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, NULL, '2024-12-17 05:47:21', NULL),
(17, NULL, 'Notification Title 17', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, NULL, '2024-12-17 05:47:21', NULL),
(18, NULL, 'Notification Title 18', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, NULL, '2024-12-17 05:47:21', NULL),
(19, NULL, 'Notification Title 19', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, NULL, '2024-12-17 05:47:21', NULL),
(20, NULL, 'Notification Title 20', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(21, NULL, 'Notification Title 21', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(22, NULL, 'Notification Title 22', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(23, NULL, 'Notification Title 23', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(24, NULL, 'Notification Title 24', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(25, NULL, 'Notification Title 25', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(26, NULL, 'Notification Title 26', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, NULL, '2024-12-17 05:47:21', NULL),
(27, NULL, 'Notification Title 27', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(28, NULL, 'Notification Title 28', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, NULL, '2024-12-17 05:47:21', NULL),
(29, NULL, 'Notification Title 29', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(30, NULL, 'Notification Title 30', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(31, NULL, 'Notification Title 31', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, NULL, '2024-12-17 05:47:21', NULL),
(32, NULL, 'Notification Title 32', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(33, NULL, 'Notification Title 33', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(34, NULL, 'Notification Title 34', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(35, NULL, 'Notification Title 35', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(36, NULL, 'Notification Title 36', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(37, NULL, 'Notification Title 37', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, NULL, '2024-12-17 05:47:21', NULL),
(38, NULL, 'Notification Title 38', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(39, NULL, 'Notification Title 39', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(40, NULL, 'Notification Title 40', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(41, NULL, 'Notification Title 41', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(42, NULL, 'Notification Title 42', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, NULL, '2024-12-17 05:47:21', NULL),
(43, NULL, 'Notification Title 43', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(44, NULL, 'Notification Title 44', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(45, NULL, 'Notification Title 45', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(46, NULL, 'Notification Title 46', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(47, NULL, 'Notification Title 47', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(48, NULL, 'Notification Title 48', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(49, NULL, 'Notification Title 49', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(50, NULL, 'Notification Title 50', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(51, NULL, 'Notification Title 51', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, NULL, '2024-12-17 05:47:21', NULL),
(52, NULL, 'Notification Title 52', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, NULL, '2024-12-17 05:47:21', NULL),
(53, NULL, 'Notification Title 53', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, NULL, '2024-12-17 05:47:21', NULL),
(54, NULL, 'Notification Title 54', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(55, NULL, 'Notification Title 55', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(56, NULL, 'Notification Title 56', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, NULL, '2024-12-17 05:47:21', NULL),
(57, NULL, 'Notification Title 57', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(58, NULL, 'Notification Title 58', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 0, '2024-12-17 05:47:21', '2024-12-17 05:47:21', NULL),
(59, NULL, 'Notification Title 59', '{\"order_id\":8,\"user_id\":6,\"full_name\":\"Nguy\\u1ec5n Trung Xuy\\u00ean\",\"message\":\"n\\u1ed9i dung th\\u00f4ng b\\u00e1o m\\u1edbi\"}', 1, NULL, '2024-12-17 05:47:21', NULL),
(60, NULL, 'Thông báo tài khoản khách hàng mới', '{\"order_id\":null,\"user_id\":6,\"full_name\":\"\\u0110\\u1ed7 Ph\\u01b0\\u01a1ng Uy\",\"message\":\"T\\u00e0i kho\\u1ea3n kh\\u00e1ch h\\u00e0ng m\\u1edbi \"}', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_phone` varchar(15) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `ship_user_name` varchar(100) NOT NULL,
  `ship_user_phone` varchar(15) NOT NULL,
  `ship_user_email` varchar(100) NOT NULL,
  `ship_user_address` varchar(255) NOT NULL,
  `ship_user_note` varchar(255) DEFAULT NULL,
  `status_order` enum('Đặt lại hàng','Chờ xác nhận','Đã xác nhận','Đang giao hàng','Đã nhận hàng','Đơn hàng bị hủy') NOT NULL,
  `payment_method` enum('Thanh toán khi nhận hàng','Thanh toán visa','Thanh toán ví tiền','Thanh toán qua VNpay') NOT NULL,
  `status_payment` enum('Đã thanh toán','Chưa thanh toán') NOT NULL,
  `total_price` int(11) NOT NULL,
  `date_create_order` datetime NOT NULL,
  `discount` int(11) NOT NULL,
  `shipping_method` enum('Giao hàng nhanh','Giao hàng tiết kiệm','Giao hàng miễn phí') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `users_id`, `user_name`, `user_phone`, `user_email`, `user_address`, `ship_user_name`, `ship_user_phone`, `ship_user_email`, `ship_user_address`, `ship_user_note`, `status_order`, `payment_method`, `status_payment`, `total_price`, `date_create_order`, `discount`, `shipping_method`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'uy8', '0987654326', 'uy9@gmail.com', 'Hà Nội 1', 'Đô 1', '0987654321', 'do12341@gmail.com', 'Địa chỉ người nhận 1', 'lêu lêu 1', 'Chờ xác nhận', 'Thanh toán qua VNpay', 'Đã thanh toán', 4588108, '2024-12-17 12:47:21', 0, 'Giao hàng tiết kiệm', NULL, NULL, NULL),
(2, 3, 'uy1', '0987654323', 'uy1@gmail.com', 'Hà Nội 2', 'Đô 2', '0987654321', 'do12342@gmail.com', 'Địa chỉ người nhận 2', 'lêu lêu 2', 'Đặt lại hàng', 'Thanh toán qua VNpay', 'Chưa thanh toán', 2816432, '2024-12-17 12:47:21', 0, 'Giao hàng tiết kiệm', NULL, NULL, NULL),
(3, 2, 'uy1', '09876543210', 'uy3@gmail.com', 'Hà Nội 3', 'Đô 3', '0987654321', 'do12343@gmail.com', 'Địa chỉ người nhận 3', 'lêu lêu 3', 'Đặt lại hàng', 'Thanh toán qua VNpay', 'Đã thanh toán', 1818533, '2024-12-17 12:47:21', 0, 'Giao hàng tiết kiệm', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_sku` varchar(100) NOT NULL,
  `product_avatar` varchar(255) NOT NULL,
  `product_price_final` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_variant_id`, `product_name`, `product_sku`, `product_avatar`, `product_price_final`, `product_quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 1, 'Áo Cộc 1', 'ao-coc-1-xyz1', 'https://product.hstatic.net/1000392326/product/fas33679__k__968k_-_fjd31170__b__998k__1__f3577eb828354bdd9dd4dd48d632ea87_master.jpg', 412041, 5, NULL, NULL, NULL),
(2, 1, 3, 1, 'Áo Cộc 2', 'ao-coc-1-xyz2', 'https://product.hstatic.net/1000392326/product/fas33679__k__968k_-_fjd31170__b__998k__1__f3577eb828354bdd9dd4dd48d632ea87_master.jpg', 425827, 5, NULL, NULL, NULL),
(3, 2, 2, 2, 'Áo Cộc 1', 'ao-coc-1-xyz1', 'https://product.hstatic.net/1000392326/product/fas33679__k__968k_-_fjd31170__b__998k__1__f3577eb828354bdd9dd4dd48d632ea87_master.jpg', 104425, 1, NULL, NULL, NULL),
(4, 2, 3, 2, 'Áo Cộc 2', 'ao-coc-1-xyz2', 'https://product.hstatic.net/1000392326/product/fas33679__k__968k_-_fjd31170__b__998k__1__f3577eb828354bdd9dd4dd48d632ea87_master.jpg', 411087, 2, NULL, NULL, NULL),
(5, 3, 2, 2, 'Áo Cộc 1', 'ao-coc-1-xyz1', 'https://product.hstatic.net/1000392326/product/fas33679__k__968k_-_fjd31170__b__998k__1__f3577eb828354bdd9dd4dd48d632ea87_master.jpg', 440094, 1, NULL, NULL, NULL),
(6, 3, 1, 2, 'Áo Cộc 3', 'ao-coc-1-xyz3', 'https://product.hstatic.net/1000392326/product/fas33679__k__968k_-_fjd31170__b__998k__1__f3577eb828354bdd9dd4dd48d632ea87_master.jpg', 361814, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `otp_code` int(11) NOT NULL,
  `expired_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'comment.edit', 'web', '2024-12-17 05:47:18', '2024-12-17 05:47:18'),
(2, 'comment.view', 'web', '2024-12-17 05:47:18', '2024-12-17 05:47:18'),
(3, 'comment.approve', 'web', '2024-12-17 05:47:18', '2024-12-17 05:47:18'),
(4, 'comment.hide', 'web', '2024-12-17 05:47:18', '2024-12-17 05:47:18'),
(5, 'comment.unhide', 'web', '2024-12-17 05:47:18', '2024-12-17 05:47:18'),
(6, 'coupon.create', 'web', '2024-12-17 05:47:18', '2024-12-17 05:47:18'),
(7, 'coupon.view', 'web', '2024-12-17 05:47:18', '2024-12-17 05:47:18'),
(8, 'coupon.edit', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(9, 'coupon.delete', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(10, 'category.create', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(11, 'category.view', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(12, 'category.edit', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(13, 'category.delete', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(14, 'post.create', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(15, 'post.view', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(16, 'post.edit', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(17, 'post.delete', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(18, 'product.create', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(19, 'product.view', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(20, 'product.edit', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(21, 'product.delete', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(22, 'product.restore', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(23, 'attribute.create', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(24, 'attribute.view', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(25, 'attribute.edit', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(26, 'attribute.delete', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(27, 'tag.create', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(28, 'tag.view', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(29, 'tag.delete', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(30, 'ticket.create', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(31, 'ticket.view', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(32, 'ticket.chat', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(33, 'ticket.update', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(34, 'banner.create', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(35, 'banner.view', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(36, 'banner.edit', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(37, 'banner.delete', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(38, 'order.view', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(39, 'order.update', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(40, 'order.detail', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(41, 'order.updateshipping', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(42, 'wallet.view', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(43, 'wallet.withdraw', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(44, 'wallet.account', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(45, 'wallet.userapprove', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(46, 'superuser.create', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(47, 'superuser.view', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(48, 'superuser.edit', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(49, 'superuser.delete', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(50, 'customer.view', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(51, 'stastical.view', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` mediumtext NOT NULL,
  `slug_post` varchar(255) NOT NULL,
  `image_post` varchar(255) DEFAULT NULL,
  `content` longtext NOT NULL,
  `published_id` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `short_description`, `slug_post`, `image_post`, `content`, `published_id`, `created_at`, `updated_at`) VALUES
(1, 'Xu Hướng Thời Trang Thập Niên 1960 Trở Lại: Hoài Niệm Nhưng Không Cũ Kỹ', 'Thời trang thập niên 1960 đang quay trở lại mạnh mẽ, mang theo hơi thở hoài niệm nhưng vẫn rất hiện đại và thời thượng. Những thiết kế retro như váy chữ A, họa tiết hình học, gam màu nổi bật và chất liệu vải tweed đặc trưng được “thổi hồn” mới bằng kỹ thuật may và cách phối đồ sáng tạo.\r\n\r\nXu hướng này không chỉ tôn vinh vẻ đẹp thanh lịch, cổ điển mà còn phù hợp với gu thẩm mỹ đương đại, tạo nên phong cách vừa hoài cổ vừa cá tính, hoàn toàn không cũ kỹ. Các phụ kiện như mũ beret, bốt cao cổ và kính mắt mèo cũng trở thành điểm nhấn hoàn hảo trong xu hướng này.', 'xu-huong-thoi-trang-thap-nien-1960-tro-lai-hoai-niem-nhung-khong-cu-ky', 'uploads/listPost/JzFHO4NT8jjEiTrUZXBRuMcQcx89lripuC8MBNPs.jpg', '<p class=\"MsoNormal\"><strong>1. Giới Thiệu Xu Hướng</strong></p>\r\n<p class=\"MsoNormal\">Năm 2024, thời trang tiếp tục chứng kiến sự hồi sinh mạnh mẽ của c&aacute;c phong c&aacute;ch cổ điển, đặc biệt l&agrave; những thiết kế từ thập ni&ecirc;n 1960. Với sự s&aacute;ng tạo v&agrave; tinh chỉnh, c&aacute;c nh&agrave; thiết kế danh tiếng đ&atilde; mang phong c&aacute;ch n&agrave;y trở lại đầy quyến rũ, nhưng kh&ocirc;ng hề nh&agrave;m ch&aacute;n.</p>\r\n<p class=\"MsoNormal\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"data:image/jpeg;base64,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\" alt=\"Thời trang thập ni&ecirc;n 1960 hot trở lại - B&aacute;o VnExpress Giải tr&iacute;\"></p>\r\n<p class=\"MsoNormal\"><strong>2. Đặc Điểm Ch&iacute;nh Của Thời Trang Thập Ni&ecirc;n 1960</strong></p>\r\n<p class=\"MsoNormal\">Thập ni&ecirc;n 1960 l&agrave; thời kỳ của những thiết kế t&aacute;o bạo, c&aacute; t&iacute;nh v&agrave; đầy cảm hứng. V&aacute;y chữ A, họa tiết chấm bi v&agrave; gam m&agrave;u neon l&agrave; những đặc điểm ti&ecirc;u biểu. Sự kết hợp n&agrave;y kh&ocirc;ng chỉ t&ocirc;n l&ecirc;n vẻ trẻ trung m&agrave; c&ograve;n gi&uacute;p người mặc nổi bật trong mọi ho&agrave;n cảnh.</p>\r\n<p class=\"MsoNormal\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMTEhUTEhMWFRUXGB4aGBgXFxobGhobHR4bGRkaGhoaHSggHRolHRoaITEhJSkrLi4uHSAzODMtNygtLisBCgoKDg0OGxAQGy0lHyUvLS8tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAKgBLAMBIgACEQEDEQH/xAAcAAACAgMBAQAAAAAAAAAAAAAFBgMEAAIHAQj/xABDEAABAwIDBQYDBgMHAwUBAAABAgMRACEEEjEFBkFRYRMicYGRoTKxwQcjQlLR8BRi4SQzQ4KSwvFTctIWY3OishX/xAAaAQACAwEBAAAAAAAAAAAAAAACAwABBAUG/8QAKhEAAgICAQQCAQMFAQAAAAAAAAECEQMhMQQSMkETIlFhcbEVM0JSoQX/2gAMAwEAAhEDEQA/AGgGtiKw1grGMPKqYk1bKaUtobyglQZKAEmAVXKjxIA0T1qN0XGDm9BV6uV7a/vnf/kV8zT3gNslZ+8KI0lM28ZpNxeFU4XHUIWpvtFDPEIkk2BOtFCSbGxg48i65XVPsjH9meP/AL3+xP60ijYxWFZdQJEGbcZB+Y0roX2UtFOEczAgl4mCI/AiKc5Ji5rR0TCDuip8tUXMe2w0Fuqyj3JvYDiaBsfaBh1GzT0TBMIPsFkmhtIpRbWhpqRF6rM4lDiQtBCkqEgj969KkSqrKFH7TE2Y8V/7KSGxYxrFqePtIV3WPFf+yk7DpEEQDa39KuXiXj8iNhBUQCgeINj9KsoSltchChHETB9eFeBlK/iSpPLKbD11qZCUNqjtFTyM/Ss7NaMw4BkpWoRzSKn7ZUABxJPGRry4V63Jk5kK8R8zFTYRgLJQGg4sa5TlSkcMyr3I/CL0AapldlClKhaB/wBySPoa1KWtFAjxF/CrrO2WSsNvshogxIMp8CoQfWrm0tmgJKmnRGuUyYHGJm0fs1GyqF3F4JsSk6x/xrVJWy29csg6x/xRkIWbKCFW/wCOVaNIKbdnlEycsR4xVlAB7d9on4COo09qgVsdaP7t9YA4Zj9aaVJMGFW8I+t68KDorIoxN4HC1WpNeyNJ8oUlLxTWUlQUmR8SY9xFdox202y6rLmVoJShRB84iudpaMgONEDgUqnwHWuobPwSSc61jMFmxi8HremRk3yInFLgCv4lSj3G1ptzRPHgTI15VQ2m660ntCCBMd4kzaYAgA2HOuhpNv6RQveLDJfZU0FJzm6JI+IadYOh6E0VAWczTtdcSk94n4TPEiAOERPKLX4Ud3fccxC+zUsImSROpEfDY9ap7K2e2h4nEAZ2ipEfhKgfi4SIiBxmmhvHYdjO+QmzZlQgEgXiSYkxHCbVZRYRuqj8SyfNR9s0e1WcPu5h0aJk84TPqAKUXftYY/w2Ss8s4H0q9sDfN/EvNJOGDbThUM/aBSrJUoRlP8tTtK7hubwDY0R6kn6mp22EjRCB4AVr5Hz/AOaH7xYhbWFfcahK0NqUkm8ECRIi9QgW/SvZ8fKuUrxePWtpC8eQHF5SWm4I7hXIuZuIph3KYcRiXQ5iHnpYbV97wKlLnKMot3RRUUN2IeSCJST6frQ3FlSlEgADkT5cqIYlbYI7Q34TP0FCcWpJWSicto9BzoGEgSE1KhNRTVloWk8BNLQDBG8jikYZ5SAcwbMRrJtb1pW2TsJoMtwUpVcu9o2SuCZidU5dDIpr21tFTeXIlRRMLcQAchtAPLW6rxbnQTamGQyUuBJLLxK4BEtum64zAjIqSYOhnpC8kvSNeCDS2Le8uw+ybW8hTYGcZAlSu8mdFBXGLyNeVX9gqxD2BSlKUFLpWk51ZY1OdPmTaOHCiO0d1DiBdakpSklKQZOciAVqOoHIAceFKW6mNSgraxCuzSmBMGTBskEW1HnaDVuP0CU05VZDjWmMM4QZdCFggA9LgnWJinrdHbTAZcUo5My80XNykCEpubZfCTXPt6MGS4XG091QH6SKvbAYUlslQIkmxEG39aO/qpXsGUbfaxt3udONbaDLbvcKpAF1JP5bxw4/SqyN0znbytKQnKCpRdT3NbEHXXhU7OIUIIUqPGtmMcy2me2zdEpgdSoxrwgGOlK7mw4xSVBDcvGfwyXmcQoJQHD2SgCcw0VYTGgV4qNNWG2qy4YQ4knlMHyBpCRtNTmZQnIFkDMhMcFQm1xCgb39q3w+LKVpUEpkER3QPlTVllF0xMsae0MO+2AW8Gg2JjOTeLdz9KU0bPKFFL0tkJkWn5U2b64koDRSlJJDie9wBCZ4e2lhSgh5SlKASEgJASmSRYAannE+tPn4icfkSggRlXnvyj2J0q0TwIT7VAhFx3AdJF7VP/DAklSbeP0NZWjZFr2VMa52LbjhRZKSe7N450MwW9LuHwzQQ333CVFawTnJJkgDrbyAoriGG1JW0oLhSYPKOnWpMFhkOIaGRTqUAdmTEJTAiRlAAjr5VL7UFGPdwBNvYlcJeW2RnAKuvA+qTRvdXaZs0YUk2SVXt+UzxAPz5VPvW0FYdWbSLCkjdvFkuITwKx5W/SaV5Rb/AAN1Y64pBQ4oZIgnmYHC9QnEiLtqFXMSDmJJJ6+1V3ZA1IHOmoQRlwCQF+2lRqV+bs1d23C/CrJVaZ9RNRKCeIRp0B6VdkpmMtyUgtkAaKSqRzA48a6RgMO2SFFzvBZgSNQbW1Nc5ZQJHdlM8FEwa6JgmmpzKXC89gD6WijgKyAzfzBJd/hkrUcvaKBhRbt2a1RmEHVI9KFbsbEYQ+VpQCpDxCT2q1ECG9JsfiVc8zR3fAKP8OEOKbV2pheTMR907MJi8iR5zwoVsHCO9upSsS8sB4yns0pSsw1JV3RGosCPhHO7lwZ3yDN4MX9+6FCwWfGJIBHI2A9KSd7n0rDTfbKQlS+8ALnkTJi19NSRTfgm0uuFTt8xVb2j/wDRpe362alosrZAltQUlJMyQqYv4RQXQdWCMRuCMwDa3pyhQUQIuJFwBW/2X43FN7TZZUFKTmUFCPhhCwVTHAetNGy9uOOoK3AEtk9whUqUNIygWihu4mPB2sZtK1JHTuqAn1jzqKb4YyeKK2jtgPj8qF72K/sWJsf7pfy8aI5up9P6UJ3tP9ixGv8AdKqChKXtYqeYKWMSoh2QCAgq+7IhJBsePhTRue64rEvFbKmSGGQAtYWSJdhUg2B5dKCPKUMRh7L/AL1WqgDZs8Umxpk2AP7U9afuMPqsr4vcT8qY+AEHsVhUrIK1RHKB86A49QS4UpV3REaHgONGMbs8uKBkJgRpP6UFxbeRakSDHGI4A8+tKkMiVAKq7dwyltlKD94UkJBUQLlIUbEaC83sDAOhtpN6pbYxYaew63E9ycua9lKICdBaCBc27x5UHomPyF/abBUtTLjpbOQZywHAlU6dsMpg5YPEwbzwr7exTbuGDLWVPZhSl9lJGWMqcgk51AEArMXgGLwfxai4pxTjCJTKypMd5PeQlOXKZUAMwVIMgcJgFhnmOxQopW2hKcwCVKClN9pBlyIBzLJy65SBHeFCavX6nm728pS0WhkytK7NK1zKkhWVMJsSY5aSBFqXMWzh3O0LeZeRSFZmxMFU5pzFJN7RYCttpNfwj85AVleYgG2Qk5oywYnSBwOlNW6i0uNqKmUIW4FhCUIKAUtkKQMwFjMgkweSYo/1MbdMErwvb4UxLeWR30qTlMeHw/zaWN7VFiGWn15nVloJCAoZklMFAUXEg5SUEEAEaZbjiC+Dw6Sp27qRKGu4CpCZCkd1SgIaiFRlIuRzFVt+8O40kZDLYTlMKIIgNtJKgDChP8ogp1oIxrQbyyk0C8bhMGy+EsuKcAEEyLqItkFpjmbeMXp/wSkwhxRAJJzCCkK5lJ1APvNqsNZwlJBUkkSCDrqNfUetZg0KgIVBCzYqIIgyDIOhBvPMUePN2b9nRz9F3KO/rXPt/uSYR7IEsZitQJVmSlRKlLuZIm4FraQaYN1sIlTgL/aBKinswsj4iJixm5EgH/kbiNldkkLEZSSAQoEykwTA0FUX8e4pYUVkqTGU2tGkeFLc05uQ1dL8mKMYNVVXw7Hb7Q1EBjX8egB/JzIpTwZJzBUi0ddaZd+cR2jWFc0C0qV4SlBilrAfEqPy/UVql4nGhqVG5QRH3igDpb+tX+2kwFGbDS1aXEfAfEC9W2W1qWEpSlROgBEzWZmxUVsTiSltZKtEmNZ/fCge7+9ziS3heyBJURmBvclWhHCY1ohvY92SgyQgkkdoUz3QDOvGOPnQnc3B9pjULGiZOmnAdNTNSlwy/VoflbHLrZzr4aRXNWNnHDvhJmUOiOSkHLp5GfWu3hogRnPoP/Gqj+7uHeMupzKBBCgSCI001FzYyKNYq1EWs/8AsKWi8sKg3zTYe1SKQNM2hphxe66pKm3Z6G3vpPpS28oIJQ4SFA3CtaGUWuSRkpcGjrgEjMBHSq7qRxyKtPLz1q0pOsFPpUC1jRXZ2T1/cUF2MaaN8EhSSBlGXjBHU/OuhYJDGaSr7zOYF9ZtwrnjZmCQjTunPHtPMV0TANs5pUPvM5y687cYpkBOQpb4YlKDh8ygIcJurLbsnRMi4uQPOKE7J2o0HFnOk/eqIAUskiGri/8AKb9DTq7hkqMqTPjFDdqstBBGWNJItEEHXypydCKsXNg7IL7o7pCJJJESLzbqTx60T3o3BZxCR3nBlIMJNykapvaTOvCrOzXlM4J/EMtZlXKEJBKlJSblIuSbqgcSOVQfZ/vc7jG1B1CQ4hakrKRl0AvlMwb6cKKMVWynNp6EH7Xtw2cKyxisCC2QoNlIJk90lKhecwCSDzpf2TuxjsK2raS0gIbcSVm+bUSvKJlIJGbSNeBp0+2PbhVi8FgWk51lSXI6rUUDzgK8ia6Zj9ntus9irutZSkgWEG3eHEG9utE1YKlRRwGJLiApQykgSDHETY8RVXeVhbuFdaa7y1pygEgC+pNabIfLWHSyZdWytTRKbykXQrXTIU0RYxMqgpKY4nT98aU1Qy7EhW7+LUtC+xYTlKjBKiDmTlgwnhrTFuxs19tx1b/Z99DaEhoKEBvPczxOajvap/On1FU3duYZKyhWIQFDVOZMibj2qWVRJtDCuLUOzJAi8qIvNBMThyFEKEkG5196Jv7XSTLboUI1BBv6eFDcQ6FKJJUSeIn6VTCRC2L0L3rabWWW3ElXaZwlIzGSAFaJ1IgeAJNGUC9IP2ibxrDyGsOtSC0DnUk6qVEp6gAep6UKjeiYtyKW0E4grAKkpm5cEkqAJJ72qVQbgEiLazNrAYdh4KdWoBtsKCwBBSQkrMkqg/eAKuFAiQOVJT+2MQpSVqczKToqAFcoKgLjxnU1OdsJLagUK7RRUVEZcpkpKRaDYip2M03ou7x4pClNhtQ7gbb7uYkpEqGtzrMcx0o3sXbCsHJXJ7RYczEm6kgQgk90AZTlufK0AdhAhrEvJHcQ0lBVMx2qwlcdSgrEcM1T7L2iwor7fKBnSsFQWsGJBIRBPKQVREADjUaMknbscsJtZXaLYKSjJIStASUdjZQdJUe612KpjTlpS5vntda28riQHHVza2VCVFaUnWTccevKiLO2GQw4w3icxUJAUoQCTBTCoTklROTMMolU8aRsVh5NyCRPwqJT8RHdJJtEHwiqXIWOPdJILbOxkDKbwbT1v8yT5mizuIcW2VqJKRlbEiBaVAWEGL63vS5steVSgqTEA5TqJ0kcf0ou6kKzFNkpNsxAUQbC3loJjnSpqmd7DPvSSjr8mxx5Otz1v0qshRKiYIFo1vYSfWt0KKTlVmyn4gCQYMSQJgyANeVNe19k9jgtnulJVZQWBJP3kvDTikZqkY2mTLn+OSTWv+cFXaj5Xg8GVEkgvJJOvxJ+hFDtnK7yjE9369KsY/GoWy02hJGRSlElROYqCJJnQyNKg2dqufy6+YrV/gcKarM9VstpSDYokeJ+VM+6Wz0Ba3QiCBlB8bn2j1pdaGZIhXDUa2p13dw+TDgme8Sq/Ww9gKXDbGZHUTnu9ICcU+GzmWTqod1BUJPib0f+zXZeXOs3GgJ1J1UT4yKEbbwy1Y3KgT2itQOKr34TlB8QK6XsbAJZaSgcNfGhhG536DyzrGl7ZeFSCtJrZK61oxMixFqVN7WxLbh4gpNpmLj2J9KYtprIyiRdXDpQjeRBLKYiyxqJ4Gk5Npobi00xVSRfvj3t7VskovdJJFj051sUGLFA8uPpVdxzvFOZAMaRfx0rPRruzZTUlOfsyOGvX609MNGc1wQZHjrpwpJw6gIKshHWmxe+CDrBnpRQoXlTLqsYoGC4udePz08qAbRwj7hUC9DZMiPiiZINo6TV070s8Uo/01X/APVWH/IPemWJpjVu/jCjDtpUAMoyiFWhNhcgVOF4cqUpLaQpV1KQACrqogCdBrSa/vMyYygpi4gwJPIacKCbe3vSAEqdcvfKgcNImwmxvbXzJ99IqOJzdJDXtTd7DN7RG0FLU64pBQhvunLEAlMXmCR5mgWPx213nFN4fDu5UqVDqsraFD8NlAq7ukibiaH7N+0xLfdLKyn80gnzE6edMuz/ALQmXLJebt+EoUg+QVc+U1FNPdhz6bJBU4g3Ymzse0p0YpPclJSvtSqVRlsmIPdSLmCIAEgmCGISUgHvHoNfcirj+8GGcupxU9LD0ioF47CqP98oeI/Sqk7YuKorNur/AOm56p/86HYxKA7ncQRmTAzAG4NiCDrAjzo12zX4XknxzD6mpE4OT3kJXy7/ANBQhGuBw4DaZBEniAPbhVgpA0t516lhzQIMeZ9xUamnZ+A+hqEKuKxoaZW8fwJnxPAeZgVxTFOFSipV1KJJPMm5966R9oO0QhhLI1cMn/tT/WPSubmjihvTx+tlJQrWaldN+VaJTRjKGXbDn8NgmMGCMzv9oeI5H+5TOh7oBPUDnS5Na9spZlRJICUieSQEJHkkAeVeqoaMEuTYKpx+zbd3D4xx0Plf3aUqSlKsoUCSFZiBNoToRrSWBTLuA+pOLASYzIUk69FD3AoXpEi2noe/tE3ewWHw6FstBp0qCUlFpESoqn4oA1kGTXPkBWue/hyvTJvzj+1dQgE5W0c5GZWsdICaVhY1sw44uKbQnJnyJuMZMnLZOqyZ42rp2OxAxmxytPxtJEjWFNRm/wBSJPgquYIBps3CxykqdYk5VpzRwMd1U+IUPSp1GOKg2kTBmn8i7nYu4cgi2vHl5VcwF1KAHDjW+KwXZOrSB3dUngR+oiD68aiwR7xjlFYof2zo9RNTz935r+ArhG1nKhOWVEDhxMC1P+0Vdm2EgWAAHypX3NwqC4VKSAUiR4m0/vnTXtXA9oghtWVREamDOsjwq4R+ti8kl3ULm7D5ViHgACCEkEnWJTI6a1W2xvvCy1hwlSkqUlZXISMtlARfX8WkwBM1SxqXsO26MO0oKUnLmJSCkBXekqULkTGUW15Un4ZKFQlztEIAKiDlSpepAjS8i5Olr8axP6h5ovuv1r+A/upv2W1KQ+kIzLKrQBJvx0iwvaw0rpys0Aggg35VzfY2wGluhx0pGUJU2hxMq0BBWEwkxw58tCXHBbYcCyHHEqE2CEGY5q4J96ksiTplfE2rRPtPFkOMoPHMr0gD5mt9tgnDLIiQUm+moB9ia9dw7eJUHMxStvlcQb3HlrV/H4UFlaAZJQR+nvVpXbFvTSObuYhRV8SOoiw66V45iDN1N3vpw4cK8WpA/IDHMWNR59Cez9OHKs5qRYafEC6LjgnjeNRzqy9lC0oASSdbaCDf2oY66hEZsonhGvtV3ZmHPaqK15lXuCoj1jSiigMjPMcAkCwkmAIN6q4wAQAkSdLHzqzicGS/Mk6Wiw6XPnVXF4D71XxTF9I04UdC7Itl4TO58KfTlQredqHyn8oSPUZvrTlu/hgFjwPypP3tVONf/lIHohIoMnBu/wDO3lf7AkJrdsQZFjzrEqrF0g7lI6DsFpOIaCxAOihAsRr+vnRP/wDko5jyg0k7mbc/h3gFGGnO6qdAfwq8tD0J5V1sNmb8q0wdo871mD4smuHwKONwARFpmeQ5dKhGHVchJED8x+lNbuEzTfzNRLDaZSAVqiCBRUZLBLGyxlTJVJFzmN69Oyx19f6UTaWMqZI05+NYq/KoQ5HvbtHtsSsgylJyp8Bb3Mmg014tVeN6001w1ohxPWomlcKnxQtVVJ71WSWpGN6nxqZxNFMLu+taGnAoQ9ni3wltWUg3vYpPnV1/dR+MwyETxMG5idNKXLJFOmzJLDNu0hdRxo9uYsjGMwJklMROqVChGFwazJimjcrYL7r6Hm8gQw6guKUqLDvEAAXsI/zCo2noBwkttEm3FhWKeiwCssHhlASR6g1TLQqEYjMor/OSs+KiVH3NWhefCupiVRSOdkbcmyApF7V7s9Q7dsKJCVLCVEcld3614vj4VQxC5STyg+hBqZFaaLxunY77z7ODXZgLWoHPZRJiMsRJtrQTZ/xRpIOmtEdu43OhhUzKSeveCetVMGzDiAnKCZOZQ7unHpXKj4UdFeSYQwuOU1DgcMDukG+bofSaYWN7EEd5KumW/wA4qlh9lv6hbIB/KIE89Lmpcds1wJlSwdAAOZMCguUUPqMnQubc24kKzpbUrtJWEuRA01GYjUyLH2pcxakOL7VRV2k3JczCOWWBFxppRTarQDqgkyEHIDH5THzk1QUkiJA48DzoVV2bIx+uy3g9vPN37QrEaKV+s8qnc3leiEhII4kzqOVh7UJDny5HrUzS5OvselU1Hmg6sZ90d43QlQdvBkqGpkWJ8+XS1ML28g7M5ZUqIFiOVzPhS5u2Uh0BwSF90SkxJ09xTcMO2DAQmjjLRjzQUZCcVk6oTFaNqXHwg+A+sU8IYT+RI8h+le2HACpSA7hGW0skSiQOGWmjYjICvI0SKvCtsDstSFmSAZNqtAydgx9n78+XyFVMYz94rwHypjxODSk51X0HLwqDHJQO9lvYT0mI96sEH7Eb748K5ttl3PiMQvm6v0BIHsBXUdlph0gaCYoUfs+YIJ7V6SYuUc4k9y9BOLfBu6LPjxNuZzZvSpeFEMDssIcWy/IWg5TFh0UOhFx41vtXYyUFK0qUUaKSTaeB9jS/ifs6H9QxpaTZDsbYOIxJhps5ZjOqQgf5ouegk12XZOHWhlttxYWtKYKgImNNTygTx1obubhinCNAINwV8AO+Sr5EUdDf5o8B9TTYQUTldT1cs2qpIpYpkqMZoTxjU9BVlvCpQBPdSfwjVXj8+VWktkJKyJjQUMxGIJMm5PtyA6UZlK2JxMSBCADYC2sceNVBi1/mPzogtQAsDJ1kC9Uso4pHpQthdpy7aO6GLbv2RcT+Zvvew73tQhWCcQe+2tHLMhSfHUV3Jh7gTy0gaVFtxKHEpkAkTbyGtzUnl7VYWLI3JJnCcQbHwqlxrre8TOHXhy0UJCiRBCRmFxMHnE1R2FuNg3GgtztCSox3ynugwOHMGpjzqQ3K62ypuk7n2e6mJLD4cF/wrSlKvko+VH2lhaDxBEUS2Xu1h8O26liYdACpWVSBmHG34lac6CbPdASQTHKs3UU5Wi8MrTFjAICW1TzPtT1s1P8AC7JdgQtbbiyf5nEwgeIGQeVKeBYCilBvncgj/NBFPO9jC3sMttoSpSkgAEAkBQVE6cCImnYfLYPVSpUcoVqOlXsIZzeA+tTObvYkasr0mQJt5VUwiyi5QvKr8QGkcxr6CuwssE9tHG+KclpM2UL0Ke/u1/8AaaL2UsBBClEwAm5J0iBeZ4V61utjHApCcO4CqQCtJSnzUoACrnJfkqEZLlDbuThGnMGhy2cEpJ1ggyBfoU0TWgH1/flQ7dPYuIwjKm3wkAqzAJUDwAVMeAowjSuZlq9HRx8bPGZnUx41ri4ztJJtmKj4JFp8yK3BrnW39qvOdoSrujPAFoSLAWMkyJk0iTo14YObf6GrxKlG6hJNwU8yarKaHF08eI5/1qZppCgCQkyJvc+9bObLbMd0cdEnnVmtFQtpH+Jw5jr0r0MpP+JF+Y5Vh2SOFhHXr08Kkb2UBNgb8+nhVE2EthlaHElKisSOIIsePKnWTnVHSuf4NsJWCEga8TzjlXQEfGaKJm6j0T59Y416HCajQe8TwrYG1WZTMxkUVxGK+8RMCSflQielD8E4t3EELlQTIGUiD1zET/xVlBja+0BASJUpRAAF+MnShO1scsrS2QAPiUAQVCLgEDTneiD+ypdSpaQhKbDKRxj4iTM1Li8O2330Jk2BuYuQOYnyFWQj2IO+PA0eS3GptM+80G2ZAdMaXpgaZzagge5qyjnu/OzbfxbfxN2cA4tzr/lJJ8CeVBEu9q0pA4pt48Peuq4vBoAWhUQpJTxOoiPeuBbubQISnUxY/vwqUHCXo+gdmNFTTYROTInLyiBHtRRrBQO9/wAUs7jbZ7TCpgTkUpI8LH/dFHl4snU1YDRDtPEWyjSh7TStePUVJi5UqBUiEgWJ8r0LLRWUUnXXppWuQfm9TVgNA8PetFMDmaEKyAPGRC1eANU9p4kmZJMWEmakZZdH+HI8RPSDNC9qLi3Wk5+Ei+nX2FraAUpxI1/Efkn6+tOmyFKS2hOYwEzFv05mlBCpdP70pxwWDeSBKCRlEXEzqePlVYeRvUvSRbdxBSkqK4CUkk6AQCZM9BSQtohOae7EzwEamju9/ajBYklBALRF+AMBXHSPrXFM5ggExy4U6WLvEYsvx+hz3W2i2vENArBUpywyq1NxqI1rqJbI5f6Ef+NcT3HaKsdhgkSe0CoH8oKj7Cu3uIc/6Z8oNoPXwo+xR4Knkc3bB+1XChlRBEkZR3EfiMG+XqaS3hBM6AEnypw3gQoM95JHeHDrz4Un7TcytOK/lIHie6PnWfJ5UacHiU9xsPmxDazE5p046/OusVzrcDDHOkgTF7DlXRwDyVryP6U6PsV1HkihtUwmY4H6UEw+MlJJgc+lFtug5QIPGxGtJGPEwkWE8P3ejoShlQ6DMEVz7bDIbdcbOkkjwV3h7GPKmXZ7pSTOhqttbDMOkKX8QAFjBjkaXPH3GrBn+NtsWNlYjuAaRYjj3TH0oqy5pqb8h1PKqu1cEhkpDRMESeN+PDwrVhZ4z6x05+NSSNOOVouPYckd1RFuEcIHCqToeH4j6frFEWFKNhr4+fPlVbE4p5JjL1kXn50IxkWzVFS0iZuPc+NdAMA0j7KUtTiM35hYADj4U8NpvejijH1L2j0rE6VqHotV5LIvppVBzDGbEUfaZrMS6aOBltlxKUAqCiRGY2jUZjr5X8aX/wCFM3J8BTT/AAecpJ/DPQDx/Qe1URlfHlSxltFuiRcHz/dqkbwuYd7Q8x9P1q24wAPDj+nKhyscPwm3Pn4VCi0gJQ4mw5GTfodaurxnBPr+9KW8diSopyjKJ4G5gcTxog0qrIU98MV2eGdcmClpZBGoOUxHnXzts/aXZSCmR0MEV2r7VcSU7Pdg3VlSPAqTPtNcQZaBBkXF/I/v3o4LQEm09HavsZ2j2mGeEQUvTHQpSNfFJp/cIA1vXIPsdx0OqZsM6bcLi/yzV2FtiImCeXD3uf3rQy0w47RJg8PxOp/YH751Hi2jOkirqV62vrNRKJ4H3oSwfkNemeZqd5B4iq5mqLFMsJ0jpxj99K8xjRUsDgPperL+BdCDKQLi5KSJkZZHjyvUeEdUpZllQypKiSU5UxxCs30pGSNtIPE6TYFwTUqPjFSP4ZIiRAsJiDpaJtb1qxshaVwlq6iCqFSgxzGcCYmYFXsds506BJvN1JHkROg+ulTHF0Xnf2oVNpYXM24NVdmqJ4ahJv14dKQDpXYXNkuExKY6rTxi0VyHEMlKlJ/Kop8wYrTjM8g7uPh82Ik6JSfVUJHzOtPKsCjNyvy4nU2uQSZt1oV9muzVdi64I7zgTCiASECddQO+RbrTSrZz0/C3B6ieI5XvB/c1JK2ROgW7hkhCyBJBF9Trc/vn6hNuA9iOq0j2UfpTTtPBOtsrVlSqALZgLSOPO56aUs7TxSShtLoDMuAjOtFwAqdCQBJTqaTKP2NOGWhh3MwuVBURwgH5/OjZQJgC0QTe5sbcDx8I9Ndl4BQZSEwZAVqONxpwjKaspwDkSUgnj3o/d/l50yKpCckrk2VsW0AkBN7c58P31oXhtkz8U87R9RRnFMqSBnAGsAGfGq38alI1H78KMFWBcXs5IJkqH7tQ1zBqzQnvJ56UyrxoWYSkqt4AiqhwbxMBsAcyYFSyxd2tsl1eUhSTEzJA1jlVFOxnUkAgGeIVax408tbKVbMpI5gX+dSObLRB7xJ4EkQD4VUot8DYZ+3XoVsLu66dS2PMngB+WptrbKcbbzKAUAY7puJ0kEC0xRPBvHQ6i1FQAtBQdCI/rWXuZs7mKextgunK9YCZAOvEeFMzeGXxWkeU1Fsd09kmTEFQjlCiIq0pQrZGCSOfkyOTNAyOLijz0FbpDY0HqahIr1KKKkLssB3y8KZsfi0NDva/hSOPlSoPGiC2Se8oyo8aGYUTTE4hbnxWHBPTrUIbvep1G9aOKgUBZTxk5k+f0oo3J0F40/fCqjuBcVCu6BB1N+HAUSQAABB6zxP6DhUbLSEb7XsKo4EFJEB5OeTBIhQAA494gx0nnSZuTuqcTgcc6EysQGeZUjvrAnmIT50f+2nFZlYdoKPdQtxSZtchCD4yFe/Omz7NWw1szDpIuoKUecqUo38oorqINXI43uhtLsMUy5MALTPge6fYmvo9xw2j1/rxr5236wKcPj30NkFJOcAfhzjNlPKCfQiu67FxqXWW3UEgKSDHzHrIqZPTJj9oLpQQPHW/pURWanD0ioivnQBm4UYrVSjyFeIdBrfMOPyqEFNh1IUAowTOUHienzoRvViYyCYBIzeEjXpUG2sSUZFlJyX72WwJ8eNhQgJ7VK1LC/vJynKsgiI1vaZ40uULaYyFKFjliMGMjZIlMXmov4dBE6W4kxFxPLlfxpWwW9r5QlClZri2UZj0kRE6c6YcXiFiMrTqiT/0le+YCDpUhFpUyZ4dru+SHHtiQYzWGh0SNSeJukDUa1ytxUzyJmuj7QeezLAZeykAA9mrkbHiLmCfnSLCEpWSO8LZYkW1uVW9DTo6M8tjPuUyhTKp+IOGZ0jKCDPmR5U2DZiMoGUEmR1g3t4RoaUNzHMyl9klUlIKsqQAFTaLnu3NOCmnYgIVeDwi1zrx/Tzq3yUVncEkGQmIiOR5nx04carDD9piQkiwazf6lER/9aXd9H3mHMOoDswkrKdIvlJsnzt1oaxvRiWXC4F5kOglOcBRgEp6Ed4G1rcKCWJy2h0MiiqOq4XANgwlAAAAsBr9OGlXEspvIFuFr/oP0oZu5iHnsK24tJKlpkkZUzJgGAeVEuydAshRPim/vRVQlsixGEQIzA+AtPjzH9axKWxogedRY5xaQnOkp1ibnhOlU1YwUyKVFWwsMWBYACoXHieNDF4mte1XHEgdL/1oiBFbnWtC9Q/tprM/WoWUdo4pIfIBvAKh4zHyopgMWCKRNq4oox6iogN9mEnxsb+tWjthCB3XARyBrDljUzo4twQ7uTNoHH1ufesSuKG7v44OtFXJUX5ACKIKWkDhWyHijBkVSaJhiBXhcSelVMpUZSk/Ie9TIwqj8RCfC5owDYuijK9BQlOFQNbnqfppRFUqsASelLmFEiccvapRh4IKp105ePWrmEwYR1UePAc469asqRApYZpkFRPqI8KkJt3Tp+9alWzIqEOD76OnFvPuAyQQhKeTbcifNZJ9K7DsPCdnhmU/lbQD4hIn3pTwn2elLgLq0lsGVZQQtyDISonQTcwb05vJJtwopNPQMU07OJ/aNhf7e+rKoAlJJi10gAjhfKfToadPsg2+lba8Ko95JzIn8psoeAMH/MaI707GLmHeSEypSbT+YXT7gVz7cjK3iASVNvtmcqhGmoI10kHoaJfZUC9Ss7yQK0Aqvg9pIdQFp0V5xwI9bVcSUnQj9+NJGkahzE15HU1IRGteK8Y8qhAajCocTkcbQpJixSCPfhV5nDIQAhKEAACwQIAA5RpWVlWxIOOw8MXAssMZgrMohpE2vaIGaYM3q66+ToeExlHrp9aysqWS7PCZsTJj8qfkRVJW62EzFRw7MzJ+6QfUZYmvKyishPh8E00qGW22yoT3G0JkD80JHPSpXArn8voL1lZUIDtrbHYfAS8hLkEWKZIJNrgSnxqm7ubhDlHZI7oiyQDHiPnfjWVlWmQv4Njs0JQiUIACUp0gQBFjaJjxBqWVCJWfWsrKhAXtpBOUZzxgEzy/pVJGGHGT++lZWU2PBRO20OAjyqSYrKyrIiniG5Mix9j4j61XSsmxsR+9eIrKyqLEPea+IdHKI8kpBoQEnkfSsrKzy5N+PhD7uOoFtxKibEH1EfSmtpCQbJA6x9a9rKbj8UZs/myxNaqNZWU0zmhR186PYdISITcnU8+g5D51lZSsgyBN7HpW6ESedZWUsMkCL2qF0mYtWVlQhhbPjW6GgeB86ysqEB2PgnKNB86F4rYWGeUFPMoWoaEi/qLx0rKygsOgm2ylKQlIAAEACwrVYrKyqLN0PqGiv351sMWrikfvzrKyoQ//2Q==\" alt=\"Thời trang thập ni&ecirc;n 1960: Dấu son x&ocirc; đổ mọi chuẩn mực truyền thống |  Vietnam+ (VietnamPlus)\" width=\"379\" height=\"212\"></p>\r\n<p class=\"MsoNormal\">Phong c&aacute;ch thời trang của thập ni&ecirc;n 1960 được biết đến với sự s&aacute;ng tạo v&agrave; t&aacute;o bạo. C&aacute;c đặc điểm nổi bật bao gồm:</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>V&aacute;y chữ A</strong>: Phom d&aacute;ng v&aacute;y x&ograve;e nhẹ từ eo, mang lại vẻ trẻ trung v&agrave; thanh tho&aacute;t.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Họa tiết chấm bi</strong>: Biểu tượng của sự tinh nghịch, trẻ trung v&agrave; đầy sức sống.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>M&agrave;u sắc nổi bật</strong>: C&aacute;c gam m&agrave;u rực rỡ như cam, v&agrave;ng, xanh l&aacute; v&agrave; hồng neon.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Phụ kiện to bản</strong>: Từ k&iacute;nh m&aacute;t, v&ograve;ng cổ đến b&ocirc;ng tai, tất cả đều c&oacute; k&iacute;ch thước lớn v&agrave; kiểu d&aacute;ng nổi bật​.</p>\r\n<p class=\"MsoNormal\"><strong>3. Sự Trở Lại Đầy Cảm Hứng Năm 2024<br><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"data:image/jpeg;base64,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\" alt=\"Thời trang thập ni&ecirc;n 1960: Dấu son x&ocirc; đổ mọi chuẩn mực truyền thống |  Vietnam+ (VietnamPlus)\" width=\"450\" height=\"225\"><br></strong></p>\r\n<p class=\"MsoNormal\">Xu hướng thời trang thập ni&ecirc;n 1960 quay lại với diện mạo mới, mang đến sự hiện đại v&agrave; ph&ugrave; hợp hơn cho cuộc sống hiện nay. Tại c&aacute;c s&agrave;n diễn thời trang lớn, như New York, Paris v&agrave; Milan, nhiều nh&agrave; mốt danh tiếng đ&atilde; tr&igrave;nh l&agrave;ng những thiết kế lấy cảm hứng từ thập ni&ecirc;n n&agrave;y:</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Bubble Hem</strong>: Gấu v&aacute;y bong b&oacute;ng, hay c&ograve;n gọi l&agrave; \"đầm quả b&iacute;\", xuất hiện trong c&aacute;c bộ sưu tập của Cecilie Bahnsen v&agrave; Antonio Marras​</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Đầm mini d&aacute;ng chữ A</strong>: Phong c&aacute;ch n&agrave;y được cập nhật với chất liệu cao cấp hơn, ph&ugrave; hợp cả khi đi l&agrave;m v&agrave; dự tiệc.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Nơ to bản</strong>: Một phụ kiện mang đậm dấu ấn của thời đại, nay được th&ecirc;m v&agrave;o c&aacute;c thiết kế v&aacute;y, &aacute;o v&agrave; thậm ch&iacute; l&agrave; t&uacute;i x&aacute;ch​</p>\r\n<p class=\"MsoNormal\"><strong>4. V&igrave; Sao Phong C&aacute;ch N&agrave;y Được Ưa Chuộng?<br><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://vcdn1-giaitri.vnecdn.net/2023/10/17/thap-nien-60-9-1697515372.jpg?w=460&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=nf1v7ky9lbNduxITDNFR3A\" alt=\"Thời trang thập ni&ecirc;n 1960 hot trở lại - B&aacute;o VnExpress Giải tr&iacute;\" width=\"213\" height=\"320\"><br></strong></p>\r\n<p class=\"p\">Sự trở lại của xu hướng thập ni&ecirc;n 1960 kh&ocirc;ng chỉ l&agrave; tr&agrave;o lưu nhất thời m&agrave; c&ograve;n đến từ những gi&aacute; trị bền vững v&agrave; khả năng ứng dụng cao trong đời sống. Kh&ocirc;ng chỉ ph&ugrave; hợp với nhiều ho&agrave;n cảnh, c&aacute;c thiết kế c&ograve;n gi&uacute;p người mặc tự tin hơn với v&oacute;c d&aacute;ng của m&igrave;nh. Đ&acirc;y l&agrave; lựa chọn ho&agrave;n hảo cho những ai muốn l&agrave;m mới tủ đồ.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>T&iacute;nh thanh lịch v&agrave; trẻ trung</strong>: C&aacute;c thiết kế dễ d&agrave;ng l&agrave;m nổi bật v&oacute;c d&aacute;ng v&agrave; che giấu khuyết điểm, ph&ugrave; hợp với nhiều độ tuổi.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Cảm gi&aacute;c ho&agrave;i cổ</strong>: Trong thời đại bận rộn, những yếu tố cổ điển mang lại sự thoải m&aacute;i v&agrave; cảm gi&aacute;c gần gũi.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Dễ d&agrave;ng phối đồ</strong>: Với kiểu d&aacute;ng đơn giản nhưng tinh tế, phong c&aacute;ch n&agrave;y gi&uacute;p bạn dễ d&agrave;ng tạo ra những bộ outfit ph&ugrave; hợp cho cả c&ocirc;ng việc lẫn sự kiện​</p>\r\n<p class=\"MsoNormal\"><strong>5. C&aacute;ch &Aacute;p Dụng Phong C&aacute;ch Thập Ni&ecirc;n 1960 Trong Thực Tiễn</strong></p>\r\n<p class=\"p\">Dễ d&agrave;ng &aacute;p dụng phong c&aacute;ch thập ni&ecirc;n 1960 v&agrave;o trang phục h&agrave;ng ng&agrave;y chỉ với một v&agrave;i chi tiết nhỏ. V&aacute;y chữ A, họa tiết chấm bi hoặc phụ kiện retro đều c&oacute; thể kết hợp linh hoạt. Bạn sẽ ngạc nhi&ecirc;n với sự thay đổi đ&aacute;ng kể trong diện mạo của m&igrave;nh khi thử những gợi &yacute; n&agrave;y.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>V&aacute;y chữ A kết hợp c&ugrave;ng bốt cao cổ</strong>: Phong c&aacute;ch l&yacute; tưởng cho những buổi đi dạo hoặc tụ tập bạn b&egrave;.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Sử dụng họa tiết chấm bi</strong>: &Aacute;o sơ mi hoặc v&aacute;y chấm bi kết hợp c&ugrave;ng gi&agrave;y b&uacute;p b&ecirc; l&agrave; lựa chọn ho&agrave;n hảo để t&ocirc;n l&ecirc;n vẻ nữ t&iacute;nh.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Chọn phụ kiện retro</strong>: T&uacute;i x&aacute;ch c&oacute; quai ngắn, k&iacute;nh mắt m&egrave;o hoặc v&ograve;ng cổ ngọc trai sẽ l&agrave; điểm nhấn th&uacute; vị.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><strong>6. Những Nh&agrave; Mốt Đứng Sau Xu Hướng N&agrave;y</strong></p>\r\n<p class=\"p\">C&aacute;c thương hiệu lớn như Dolce &amp; Gabbana, Balmain, v&agrave; Cecilie Bahnsen đang ti&ecirc;n phong mang phong c&aacute;ch thập ni&ecirc;n 1960 trở lại. Từ v&aacute;y chữ A cổ điển đến phụ kiện hiện đại, mỗi nh&agrave; mốt đều c&oacute; c&aacute;ch biến tấu ri&ecirc;ng. Đ&acirc;y ch&iacute;nh l&agrave; nguồn cảm hứng cho những ai y&ecirc;u th&iacute;ch sự pha trộn giữa cổ điển v&agrave; hiện đại.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Dolce &amp; Gabbana</strong>: Kết hợp họa tiết chấm bi với c&aacute;c chất liệu ren v&agrave; lụa, mang lại vẻ gợi cảm v&agrave; sang trọng.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Balmain</strong>: Tập trung v&agrave;o v&aacute;y chữ A với chi tiết nơ to bản, tạo sự thanh lịch v&agrave; ph&aacute; c&aacute;ch.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Cecilie Bahnsen</strong>: L&agrave;m mới c&aacute;c thiết kế với kỹ thuật cắt may độc đ&aacute;o, nhấn mạnh gấu v&aacute;y bong b&oacute;ng​</p>\r\n<p class=\"MsoNormal\"><strong>7. Những Sai Lầm Cần Tr&aacute;nh</strong></p>\r\n<p class=\"p\">D&ugrave; phong c&aacute;ch thập ni&ecirc;n 1960 rất hấp dẫn, người mặc cần tr&aacute;nh c&aacute;c sai lầm như phối qu&aacute; nhiều phụ kiện hoặc chọn m&agrave;u sắc kh&ocirc;ng ph&ugrave; hợp. Việc lạm dụng c&aacute;c yếu tố retro c&oacute; thể khiến tổng thể trở n&ecirc;n rườm r&agrave;. B&iacute; quyết l&agrave; giữ mọi thứ c&acirc;n bằng v&agrave; h&agrave;i h&ograve;a để tạo n&ecirc;n một diện mạo ho&agrave;n hảo.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Qu&aacute; lạm dụng phụ kiện</strong>: Sự kết hợp qu&aacute; nhiều chi tiết lớn sẽ khiến trang phục trở n&ecirc;n rườm r&agrave;.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Chọn sai m&agrave;u sắc</strong>: Nếu bạn kh&ocirc;ng tự tin với m&agrave;u rực rỡ, h&atilde;y chọn những gam pastel hoặc trung t&iacute;nh để dễ d&agrave;ng phối đồ hơn.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Kh&ocirc;ng c&acirc;n đối tỉ lệ</strong>: Đảm bảo c&aacute;c m&oacute;n đồ phối hợp h&agrave;i h&ograve;a để tr&aacute;nh tạo cảm gi&aacute;c nặng nề​</p>\r\n<p class=\"MsoNormal\"><strong>8. Xu Hướng Thập Ni&ecirc;n 1960 V&agrave; Tương Lai</strong></p>\r\n<p class=\"MsoNormal\">Với sự ủng hộ từ c&aacute;c nh&agrave; thiết kế v&agrave; cộng đồng thời trang, phong c&aacute;ch thập ni&ecirc;n 1960 hứa hẹn sẽ kh&ocirc;ng chỉ l&agrave; xu hướng m&agrave; c&ograve;n trở th&agrave;nh một biểu tượng l&acirc;u d&agrave;i. C&aacute;c yếu tố bền vững, kết hợp với sự s&aacute;ng tạo trong thiết kế, sẽ tiếp tục định h&igrave;nh thời trang to&agrave;n cầu.</p>\r\n<p class=\"MsoNormal\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://dep.com.vn/wp-content/uploads/2020/05/phong-cach-vintage-14.jpg\" alt=\"Vintage - Xu hướng thời trang khoe trọn vẻ thanh xu&acirc;n ngọt ng&agrave;o - Tạp ch&iacute;  Đẹp\" width=\"381\" height=\"381\"></p>\r\n<p class=\"MsoNormal\"><strong>Kết Luận</strong></p>\r\n<p class=\"MsoNormal\">Xu hướng thời trang thập ni&ecirc;n 1960 kh&ocirc;ng chỉ mang lại l&agrave;n gi&oacute; mới cho ng&agrave;nh thời trang hiện đại m&agrave; c&ograve;n l&agrave; c&aacute;ch để mỗi người tự khẳng định phong c&aacute;ch c&aacute; nh&acirc;n. H&atilde;y thử kết hợp c&aacute;c yếu tố của phong c&aacute;ch n&agrave;y v&agrave;o tủ đồ của bạn v&agrave; tận hưởng sự kh&aacute;c biệt m&agrave; n&oacute; mang lại.</p>', 1, '2024-12-17 05:47:21', '2024-12-19 02:38:17');
INSERT INTO `posts` (`id`, `title`, `short_description`, `slug_post`, `image_post`, `content`, `published_id`, `created_at`, `updated_at`) VALUES
(2, 'Gorpcore: Xu Hướng Thời Trang Thoải Mái Và Thiết Thực Dành Cho Người Hiện Đại', 'Gorpcore là xu hướng thời trang lấy cảm hứng từ trang phục dã ngoại, leo núi với ưu tiên sự thoải mái và tính ứng dụng cao. Các thiết kế tập trung vào chất liệu bền bỉ, chống thấm nước và phom dáng rộng rãi, như áo khoác gió, quần cargo, giày hiking và balo tiện ích.\r\n\r\nMàu sắc chủ đạo là các tông trung tính và tự nhiên như xanh lá, nâu đất, và xám, mang đậm tinh thần hòa mình với thiên nhiên. Dù mang hơi hướng outdoor, Gorpcore vẫn thể hiện sự cá tính, hiện đại và dễ dàng kết hợp trong trang phục thường ngày của người thành thị.', 'gorpcore-xu-huong-thoi-trang-thoai-mai-va-thiet-thuc-danh-cho-nguoi-hien-dai', 'uploads/listPost/VYbWSRGBYwDy6lxKe6Sj258Fk3gs5eSdGteJ1hKu.jpg', '<p class=\"MsoNormal\"><strong>1. Gorpcore L&agrave; G&igrave;?</strong></p>\r\n<p class=\"MsoNormal\">Trong bối cảnh thế giới đang ch&uacute; trọng đến sự bền vững v&agrave; tiện &iacute;ch, <strong>Gorpcore</strong>&nbsp;nhanh ch&oacute;ng trở th&agrave;nh một trong những xu hướng thời trang được y&ecirc;u th&iacute;ch nhất. Lấy cảm hứng từ trang phục ngo&agrave;i trời như &aacute;o gi&oacute;, quần hiking, gi&agrave;y trekking v&agrave; balo cỡ lớn, Gorpcore kết hợp giữa <strong>chức năng thực tiễn</strong>&nbsp;v&agrave; <strong>phong c&aacute;ch c&aacute; nh&acirc;n</strong>. T&ecirc;n gọi n&agrave;y xuất ph&aacute;t từ cụm từ &ldquo;Gorp&rdquo; (Good Ol&rsquo; Raisins and Peanuts) &ndash; m&oacute;n ăn vặt thường thấy trong c&aacute;c chuyến leo n&uacute;i​.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><strong>2. Đặc Điểm Ch&iacute;nh Của Gorpcore</strong></p>\r\n<p class=\"MsoNormal\">Phong c&aacute;ch Gorpcore nổi bật với c&aacute;c trang phục kỹ thuật cao như &aacute;o gi&oacute;, quần chống thấm v&agrave; gi&agrave;y trekking. Điểm nhấn l&agrave; t&iacute;nh linh hoạt v&agrave; thiết kế tối giản, kết hợp c&aacute;c gam m&agrave;u trung t&iacute;nh như x&aacute;m, xanh r&ecirc;u v&agrave; be. Đ&acirc;y l&agrave; lựa chọn l&yacute; tưởng cho những ai y&ecirc;u th&iacute;ch thời trang nhưng kh&ocirc;ng qu&ecirc;n yếu tố tiện dụng.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Trang phục chống nước, chống gi&oacute;</strong>: &Aacute;o kho&aacute;c Gore-Tex, quần chống thấm hay &aacute;o phao nhẹ.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>M&agrave;u sắc tự nhi&ecirc;n</strong>: C&aacute;c gam m&agrave;u trung t&iacute;nh như x&aacute;m, xanh r&ecirc;u, be v&agrave; đen thường được ưu &aacute;i.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Phụ kiện lớn</strong>: Balo đa năng, gi&agrave;y hiking, v&agrave; mũ len đặc trưng.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Chất liệu kỹ thuật cao</strong>: Được thiết kế để chịu được thời tiết khắc nghiệt, nhưng vẫn nhẹ v&agrave; dễ vận động​</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><strong>3. Tại Sao Gorpcore Lại Phổ Biến?</strong></p>\r\n<p class=\"MsoNormal\">Gorpcore đang chiếm trọn cảm t&igrave;nh của giới trẻ nhờ t&iacute;nh ứng dụng cao v&agrave; sự thoải m&aacute;i trong mọi ho&agrave;n cảnh. B&ecirc;n cạnh đ&oacute;, phong c&aacute;ch n&agrave;y phản &aacute;nh xu hướng sống tối giản v&agrave; bền vững. Được c&aacute;c thương hiệu lớn v&agrave; người nổi tiếng ưa chuộng, Gorpcore nhanh ch&oacute;ng trở th&agrave;nh t&acirc;m điểm của thời trang hiện đại.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>T&iacute;nh ứng dụng cao</strong>: Ph&ugrave; hợp cả khi đi du lịch, tham gia c&aacute;c hoạt động ngo&agrave;i trời lẫn sinh hoạt h&agrave;ng ng&agrave;y.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Sự tiện lợi</strong>: Dễ phối đồ v&agrave; kh&ocirc;ng đ&ograve;i hỏi nhiều phụ kiện phức tạp.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>T&ocirc;n vinh sự tối giản</strong>: Thời trang kh&ocirc;ng chỉ để l&agrave;m đẹp m&agrave; c&ograve;n phục vụ cho nhu cầu thực tiễn.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Sự ủng hộ của c&aacute;c thương hiệu lớn</strong>: Những nh&agrave; mốt như Patagonia, The North Face, v&agrave; Arc&rsquo;teryx đ&atilde; đẩy mạnh việc ph&aacute;t triển c&aacute;c sản phẩm thời trang ngo&agrave;i trời với phong c&aacute;ch trẻ trung hơn​</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><strong>4. Sự Trỗi Dậy Của Gorpcore Tr&ecirc;n S&agrave;n Diễn</strong></p>\r\n<p class=\"MsoNormal\">Từ s&agrave;n diễn thời trang cao cấp đến phong c&aacute;ch đường phố, Gorpcore đ&atilde; chứng minh sức h&uacute;t mạnh mẽ của m&igrave;nh. C&aacute;c nh&agrave; mốt danh tiếng như Balenciaga, Prada v&agrave; Gucci biến xu hướng n&agrave;y th&agrave;nh một tuy&ecirc;n ng&ocirc;n thời trang. Đặc biệt, sự s&aacute;ng tạo trong c&aacute;ch phối đồ đ&atilde; mang đến một l&agrave;n gi&oacute; mới cho ng&agrave;nh c&ocirc;ng nghiệp thời trang.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Balenciaga</strong>&nbsp;v&agrave; <strong>Gucci</strong>&nbsp;đ&atilde; lồng gh&eacute;p phong c&aacute;ch n&agrave;y v&agrave;o c&aacute;c bộ sưu tập thời thượng với &aacute;o kho&aacute;c oversized v&agrave; gi&agrave;y hiking cao cấp.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Prada</strong>&nbsp;v&agrave; <strong>Louis Vuitton</strong>&nbsp;cũng tham gia cuộc chơi với việc biến những chất liệu kỹ thuật th&agrave;nh trang phục đẳng cấp​</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><strong>5. Phong C&aacute;ch Gorpcore D&agrave;nh Cho Mọi Người</strong></p>\r\n<p class=\"MsoNormal\">D&ugrave; bạn l&agrave; người y&ecirc;u th&iacute;ch sự năng động hay cần trang phục thoải m&aacute;i cho c&ocirc;ng việc, Gorpcore đều c&oacute; thể đ&aacute;p ứng. Phong c&aacute;ch n&agrave;y kh&ocirc;ng chỉ ph&ugrave; hợp với hoạt động ngo&agrave;i trời m&agrave; c&ograve;n dễ d&agrave;ng ứng dụng v&agrave;o đời sống thường ng&agrave;y. Một chiếc &aacute;o kho&aacute;c nhẹ hoặc đ&ocirc;i gi&agrave;y trekking c&oacute; thể l&agrave;m mới to&agrave;n bộ tủ đồ của bạn.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Cho ng&agrave;y thường</strong>: Phối &aacute;o kho&aacute;c Gore-Tex c&ugrave;ng quần cargo v&agrave; gi&agrave;y thể thao chunky.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Cho hoạt động ngo&agrave;i trời</strong>: &Aacute;o phao nhẹ, quần chống thấm v&agrave; balo đa năng l&agrave; lựa chọn kh&ocirc;ng thể thiếu.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Đi l&agrave;m</strong>: Một chiếc &aacute;o gi&oacute; thiết kế tinh tế kết hợp c&ugrave;ng quần t&acirc;y v&agrave; gi&agrave;y oxford cho vẻ ngo&agrave;i lịch l&atilde;m nhưng vẫn tiện dụng.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><strong>6. Những Thương Hiệu Đang Dẫn Đầu Xu Hướng Gorpcore</strong></p>\r\n<p class=\"MsoNormal\">C&aacute;c thương hiệu nổi tiếng như Patagonia, Arc\'teryx v&agrave; The North Face đang ti&ecirc;n phong trong phong c&aacute;ch Gorpcore. Với sự tập trung v&agrave;o chất lượng v&agrave; thiết kế bền vững, họ mang đến những sản phẩm vừa thời thượng vừa hữu dụng. Đ&acirc;y ch&iacute;nh l&agrave; nguồn cảm hứng cho những t&iacute;n đồ thời trang y&ecirc;u th&iacute;ch sự tối giản.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Patagonia</strong>: Tập trung v&agrave;o c&aacute;c sản phẩm bền vững v&agrave; th&acirc;n thiện với m&ocirc;i trường.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Arc\'teryx</strong>: Nổi bật với chất liệu kỹ thuật cao v&agrave; thiết kế tối giản.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>The North Face</strong>: Đưa trang phục ngo&agrave;i trời v&agrave;o đời sống h&agrave;ng ng&agrave;y một c&aacute;ch s&aacute;ng tạo.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Uniqlo</strong>: Cung cấp c&aacute;c sản phẩm Gorpcore gi&aacute; phải chăng nhưng vẫn đảm bảo chất lượng​</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\">7. Sai Lầm Cần Tr&aacute;nh Khi Phối Đồ Gorpcore</p>\r\n<p class=\"MsoNormal\">Mặc Gorpcore tưởng chừng dễ d&agrave;ng, nhưng nếu kh&ocirc;ng kh&eacute;o l&eacute;o bạn c&oacute; thể mắc phải một số sai lầm. Phối đồ qu&aacute; nhiều lớp hoặc chọn phụ kiện kh&ocirc;ng ph&ugrave; hợp c&oacute; thể khiến tổng thể mất c&acirc;n đối. B&iacute; quyết l&agrave; giữ mọi thứ đơn giản, tập trung v&agrave;o c&aacute;c chi tiết tinh tế v&agrave; chọn đồ vừa vặn.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Qu&aacute; nhiều lớp đồ</strong>: Điều n&agrave;y c&oacute; thể khiến bạn tr&ocirc;ng rườm r&agrave; v&agrave; nặng nề.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Kh&ocirc;ng c&acirc;n đối m&agrave;u sắc</strong>: Ưu ti&ecirc;n phối m&agrave;u theo tone trung t&iacute;nh, tr&aacute;nh sự l&ograve;e loẹt.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Phụ kiện thiếu sự đồng nhất</strong>: H&atilde;y chọn c&aacute;c phụ kiện c&oacute; phong c&aacute;ch tương tự để tạo cảm gi&aacute;c h&agrave;i h&ograve;a .</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<h3><strong><span class=\"15\">8. Gorpcore V&agrave; Tương Lai Của Thời Trang</span></strong></h3>\r\n<p class=\"MsoNormal\">Gorpcore kh&ocirc;ng chỉ l&agrave; một xu hướng nhất thời m&agrave; c&ograve;n đ&aacute;nh dấu sự thay đổi trong c&aacute;ch mọi người tiếp cận thời trang. Với sự ch&uacute; trọng v&agrave;o t&iacute;nh thực dụng v&agrave; bền vững, phong c&aacute;ch n&agrave;y hứa hẹn sẽ tiếp tục chiếm lĩnh thị trường thời trang to&agrave;n cầu. Thậm ch&iacute;, Gorpcore c&ograve;n truyền cảm hứng cho c&aacute;c nh&agrave; thiết kế trẻ trong việc s&aacute;ng tạo c&aacute;c sản phẩm vừa đẹp mắt, vừa hữu dụng.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><strong>Kết Luận</strong></p>\r\n<p class=\"MsoNormal\">Gorpcore l&agrave; minh chứng cho sự thay đổi trong quan điểm thời trang hiện đại: đề cao chức năng, t&iacute;nh ứng dụng v&agrave; sự bền vững. Với sự linh hoạt v&agrave; dễ phối hợp, Gorpcore kh&ocirc;ng chỉ l&agrave; một phong c&aacute;ch m&agrave; c&ograve;n l&agrave; lối sống, ph&ugrave; hợp với những ai y&ecirc;u th&iacute;ch sự thoải m&aacute;i v&agrave; thực tiễn. H&atilde;y thử &aacute;p dụng phong c&aacute;ch n&agrave;y v&agrave; cảm nhận sự kh&aacute;c biệt!</p>', 1, '2024-12-17 05:47:21', '2024-12-17 06:33:53'),
(3, 'Dopamine Dressing: Thời Trang Mang Lại Niềm Vui', 'Dopamine Dressing là xu hướng thời trang tập trung vào việc kích thích cảm xúc tích cực thông qua màu sắc rực rỡ và thiết kế tươi vui. Những gam màu nổi bật như hồng, vàng, xanh neon và cam được kết hợp sáng tạo để nâng cao tinh thần và tạo sự tự tin cho người mặc.\r\n\r\nPhong cách này khuyến khích sự tự do và phá cách, sử dụng các họa tiết độc đáo, chất liệu thoải mái cùng những phụ kiện bắt mắt, giúp mỗi bộ trang phục trở thành một tuyên ngôn vui tươi và đầy năng lượng.', 'dopamine-dressing-thoi-trang-mang-lai-niem-vui', 'uploads/listPost/4g5cGvfFBrmJ8eXmtj2AanN9QRf2EvveOEWQZVW0.jpg', '<p class=\"MsoNormal\"><strong>1. Dopamine Dressing L&agrave; G&igrave;?</strong></p>\r\n<p class=\"MsoNormal\">Dopamine Dressing, hay \"thời trang dopamine,\" l&agrave; xu hướng sử dụng trang phục để k&iacute;ch th&iacute;ch cảm gi&aacute;c hạnh ph&uacute;c v&agrave; lạc quan. Tr&agrave;o lưu n&agrave;y nhấn mạnh v&agrave;o việc chọn quần &aacute;o với m&agrave;u sắc, họa tiết, v&agrave; phong c&aacute;ch tạo n&ecirc;n niềm vui cho người mặc. C&aacute;i t&ecirc;n \"Dopamine Dressing\" bắt nguồn từ dopamine &ndash; một chất dẫn truyền thần kinh li&ecirc;n quan đến cảm gi&aacute;c vui vẻ v&agrave; động lực.</p>\r\n<p class=\"MsoNormal\">Xu hướng n&agrave;y kh&ocirc;ng chỉ l&agrave; phong c&aacute;ch thời trang, m&agrave; c&ograve;n l&agrave; phương ph&aacute;p gi&uacute;p cải thiện t&acirc;m trạng, đặc biệt trong thời kỳ bất ổn như hậu đại dịch COVID-19. Việc chọn lựa m&agrave;u sắc rực rỡ hoặc c&aacute;c m&oacute;n đồ gắn liền với kỷ niệm vui vẻ c&oacute; thể gi&uacute;p giải tỏa căng thẳng v&agrave; tạo cảm gi&aacute;c t&iacute;ch cực.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><strong>2. Đặc Điểm Ch&iacute;nh Của Dopamine Dressing</strong></p>\r\n<p class=\"MsoNormal\">Dopamine Dressing tập trung v&agrave;o những m&agrave;u sắc rực rỡ, họa tiết độc đ&aacute;o v&agrave; chất liệu thoải m&aacute;i. Phong c&aacute;ch n&agrave;y kh&ocirc;ng chỉ tạo n&ecirc;n sự nổi bật m&agrave; c&ograve;n gi&uacute;p người mặc cảm thấy tự tin hơn. Sự tự do trong c&aacute;ch kết hợp đồ ch&iacute;nh l&agrave; điểm hấp dẫn khiến xu hướng n&agrave;y được ưa chuộng:</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>M&agrave;u sắc rực rỡ</strong>: C&aacute;c m&agrave;u tươi s&aacute;ng như v&agrave;ng, hồng, xanh l&aacute; v&agrave; cam thường được sử dụng để k&iacute;ch th&iacute;ch thị gi&aacute;c v&agrave; mang lại năng lượng.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Họa tiết sống động</strong>: Từ chấm bi, hoa l&aacute; đến c&aacute;c h&igrave;nh khối độc đ&aacute;o, tất cả đều tạo n&ecirc;n sự vui nhộn v&agrave; kh&aacute;c biệt.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Chất liệu thoải m&aacute;i</strong>: Những chất liệu nhẹ nh&agrave;ng như cotton, lụa, hoặc satin thường được ưu &aacute;i v&igrave; mang lại cảm gi&aacute;c dễ chịu khi mặc.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Phong c&aacute;ch t&aacute;o bạo</strong>: C&aacute;c thiết kế oversized, phối m&agrave;u tương phản hoặc phụ kiện nổi bật gi&uacute;p người mặc tự tin thể hiện c&aacute; t&iacute;nh​</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><strong>3. Dopamine Dressing: Tại Sao Lại Phổ Biến?</strong></p>\r\n<p class=\"MsoNormal\">Sau đại dịch, mọi người t&igrave;m kiếm niềm vui từ những điều đơn giản, v&agrave; Dopamine Dressing trở th&agrave;nh lựa chọn ho&agrave;n hảo. Xu hướng n&agrave;y kh&ocirc;ng chỉ phản &aacute;nh khao kh&aacute;t t&iacute;ch cực m&agrave; c&ograve;n được th&uacute;c đẩy bởi truyền th&ocirc;ng x&atilde; hội. Với khả năng n&acirc;ng cao t&acirc;m trạng, Dopamine Dressing nhanh ch&oacute;ng chiếm lĩnh thị trường thời trang.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong><span style=\"font-family: Times New Roman;\">Ảnh hưởng từ đại dịch</span></strong>: Sau khoảng thời gian d&agrave;i bị ảnh hưởng bởi COVID-19, mọi người khao kh&aacute;t những điều t&iacute;ch cực hơn trong cuộc sống. Thời trang trở th&agrave;nh phương tiện dễ d&agrave;ng để lan tỏa năng lượng n&agrave;y.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>T&aacute;c động t&acirc;m l&yacute;</strong>: Nghi&ecirc;n cứu khoa học đ&atilde; chứng minh rằng m&agrave;u sắc v&agrave; phong c&aacute;ch c&oacute; thể t&aacute;c động đến cảm x&uacute;c của con người. Mặc m&agrave;u sắc tươi s&aacute;ng c&oacute; thể k&iacute;ch th&iacute;ch t&acirc;m trạng v&agrave; cải thiện động lực.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Truyền th&ocirc;ng x&atilde; hội</strong>: C&aacute;c nền tảng như Instagram v&agrave; TikTok th&uacute;c đẩy Dopamine Dressing nhờ c&aacute;c b&agrave;i đăng v&agrave; video nổi bật về c&aacute;ch phối đồ s&aacute;ng tạo.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><strong>4. M&agrave;u Sắc V&agrave; &Yacute; Nghĩa Trong Dopamine Dressing</strong></p>\r\n<p class=\"MsoNormal\">M&agrave;u sắc đ&oacute;ng vai tr&ograve; quan trọng trong Dopamine Dressing, mỗi gam m&agrave;u mang đến th&ocirc;ng điệp ri&ecirc;ng. Từ sắc v&agrave;ng đầy năng lượng đến hồng ngọt ng&agrave;o v&agrave; xanh l&aacute; c&acirc;n bằng, mỗi lựa chọn đều khơi dậy cảm x&uacute;c. Kết hợp m&agrave;u sắc một c&aacute;ch tinh tế kh&ocirc;ng chỉ l&agrave;m nổi bật c&aacute; t&iacute;nh m&agrave; c&ograve;n tạo hiệu ứng t&acirc;m l&yacute; t&iacute;ch cực.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>M&agrave;u v&agrave;ng</strong>: Đại diện cho hạnh ph&uacute;c, năng lượng v&agrave; sự lạc quan.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>M&agrave;u hồng</strong>: Gợi l&ecirc;n sự ngọt ng&agrave;o, dịu d&agrave;ng v&agrave; cảm gi&aacute;c y&ecirc;u đời.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>M&agrave;u cam</strong>: Thể hiện sự s&aacute;ng tạo v&agrave; tr&agrave;n đầy sức sống.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>M&agrave;u xanh l&aacute;</strong>: Tạo cảm gi&aacute;c c&acirc;n bằng v&agrave; gần gũi với thi&ecirc;n nhi&ecirc;n.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>M&agrave;u t&iacute;m</strong>: Tượng trưng cho sự b&iacute; ẩn, sang trọng v&agrave; s&aacute;ng tạo.</p>\r\n<p class=\"MsoNormal\">Kết hợp c&aacute;c m&agrave;u sắc n&agrave;y kh&ocirc;ng chỉ mang lại cảm gi&aacute;c tươi mới m&agrave; c&ograve;n gi&uacute;p người mặc cảm thấy tự tin v&agrave; y&ecirc;u đời hơn​.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><strong>5. Dopamine Dressing D&agrave;nh Cho Ai?</strong></p>\r\n<p class=\"MsoNormal\">Phong c&aacute;ch Dopamine Dressing ph&ugrave; hợp với mọi lứa tuổi v&agrave; phong c&aacute;ch sống. Giới trẻ y&ecirc;u th&iacute;ch sự t&aacute;o bạo, người đi l&agrave;m ưa chuộng sự tinh tế, trong khi người lớn tuổi chọn c&aacute;ch thể hiện nhẹ nh&agrave;ng hơn. Đ&acirc;y l&agrave; xu hướng kh&ocirc;ng giới hạn, mang đến niềm vui cho bất cứ ai &aacute;p dụng.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Giới trẻ</strong>: C&oacute; thể thử nghiệm c&aacute;c phong c&aacute;ch t&aacute;o bạo với m&agrave;u neon v&agrave; phụ kiện độc lạ.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Người đi l&agrave;m</strong>: Phối hợp m&agrave;u sắc rực rỡ với trang phục c&ocirc;ng sở để vừa nổi bật vừa lịch sự.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Người lớn tuổi</strong>: Chọn c&aacute;c gam m&agrave;u pastel hoặc họa tiết nhẹ nh&agrave;ng để giữ vẻ thanh lịch nhưng vẫn tươi mới.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\"><strong>6. Dopamine Dressing Tr&ecirc;n S&agrave;n Diễn Thời Trang</strong></p>\r\n<p class=\"MsoNormal\">Dopamine Dressing đ&atilde; lan tỏa mạnh mẽ từ đường phố đến s&agrave;n diễn cao cấp. C&aacute;c thương hiệu lớn như Gucci v&agrave; Prada biến xu hướng n&agrave;y th&agrave;nh tuy&ecirc;n ng&ocirc;n nghệ thuật. Sự pha trộn m&agrave;u sắc v&agrave; phong c&aacute;ch s&aacute;ng tạo đ&atilde; đưa Dopamine Dressing l&ecirc;n đỉnh cao của ng&agrave;nh thời trang.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Gucci</strong>&nbsp;v&agrave; <strong>Versace</strong>&nbsp;thường xuy&ecirc;n giới thiệu c&aacute;c bộ sưu tập với m&agrave;u sắc rực rỡ v&agrave; thiết kế t&aacute;o bạo.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Dior</strong>&nbsp;v&agrave; <strong>Chanel</strong>&nbsp;tập trung v&agrave;o sự kết hợp giữa phong c&aacute;ch thanh lịch v&agrave; gam m&agrave;u pastel nhẹ nh&agrave;ng.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Prada</strong>&nbsp;sử dụng c&aacute;c họa tiết h&igrave;nh học độc đ&aacute;o, tạo điểm nhấn thị gi&aacute;c đầy mới lạ​</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<p class=\"MsoNormal\">&nbsp;<strong>7. C&aacute;ch Phối Đồ Theo Xu Hướng Dopamine Dressing</strong><br>Dopamine Dressing cho ph&eacute;p bạn thoải m&aacute;i s&aacute;ng tạo với m&agrave;u sắc v&agrave; họa tiết. Từ phối m&agrave;u tương phản đến chọn phụ kiện nổi bật, mọi lựa chọn đều c&oacute; thể trở th&agrave;nh điểm nhấn. B&iacute; quyết l&agrave; tự tin thử nghiệm v&agrave; để niềm vui dẫn lối trong c&aacute;ch bạn mặc đồ.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Phối đồ monochrome</strong>: Chọn một m&agrave;u chủ đạo v&agrave; phối c&aacute;c sắc th&aacute;i kh&aacute;c nhau của m&agrave;u đ&oacute;.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Kết hợp tương phản</strong>: Phối c&aacute;c m&agrave;u đối lập như xanh l&aacute; v&agrave; cam để tạo sự nổi bật.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Chọn phụ kiện bắt mắt</strong>: T&uacute;i x&aacute;ch, gi&agrave;y hoặc trang sức s&aacute;ng m&agrave;u sẽ gi&uacute;p bộ trang phục th&ecirc;m phần ấn tượng.</p>\r\n<p class=\"MsoNormal\"><!-- [if !supportLists]--><span style=\"mso-list: Ignore;\">&middot;&nbsp;</span><!--[endif]--><strong>Đừng ngại thử nghiệm</strong>: H&atilde;y tự tin phối c&aacute;c m&agrave;u sắc hoặc kiểu d&aacute;ng m&agrave; bạn y&ecirc;u th&iacute;ch, miễn l&agrave; ch&uacute;ng mang lại niềm vui.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<h4><strong><span class=\"15\">8. Dopamine Dressing V&agrave; Tương Lai Của Thời Trang</span></strong></h4>\r\n<p class=\"p\">Dopamine Dressing kh&ocirc;ng chỉ l&agrave; một xu hướng, m&agrave; c&ograve;n l&agrave; c&aacute;ch thể hiện c&aacute; t&iacute;nh v&agrave; cảm x&uacute;c qua thời trang. Tr&agrave;o lưu n&agrave;y đang thay đổi c&aacute;ch mọi người tiếp cận thời trang: từ chỗ coi trang phục l&agrave; nhu cầu cơ bản, giờ đ&acirc;y ch&uacute;ng trở th&agrave;nh c&ocirc;ng cụ cải thiện t&acirc;m trạng.</p>\r\n<p class=\"p\">C&aacute;c thương hiệu lớn đang đẩy mạnh sản xuất c&aacute;c bộ sưu tập với m&agrave;u sắc v&agrave; thiết kế mang t&iacute;nh \"liệu ph&aacute;p t&acirc;m l&yacute;.\" Trong tương lai, Dopamine Dressing c&oacute; thể kết hợp với c&ocirc;ng nghệ th&ocirc;ng minh để tạo ra c&aacute;c sản phẩm tự điều chỉnh m&agrave;u sắc v&agrave; phong c&aacute;ch theo t&acirc;m trạng của người mặc.</p>\r\n<p class=\"MsoNormal\">(Ảnh)</p>\r\n<h3><strong><span class=\"15\">Kết Luận</span></strong></h3>\r\n<p class=\"p\">Dopamine Dressing kh&ocirc;ng chỉ gi&uacute;p bạn trở n&ecirc;n thời thượng m&agrave; c&ograve;n mang lại niềm vui, sự tự tin v&agrave; cảm gi&aacute;c t&iacute;ch cực. Đ&acirc;y l&agrave; xu hướng ph&ugrave; hợp với mọi người, mọi phong c&aacute;ch, v&agrave; mọi ho&agrave;n cảnh. H&atilde;y thử &aacute;p dụng v&agrave; cảm nhận sức mạnh của \"thời trang hạnh ph&uacute;c\" ngay h&ocirc;m nay!</p>', 1, '2024-12-17 05:47:21', '2024-12-17 06:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image_avatar` varchar(255) NOT NULL,
  `price_regular` int(11) NOT NULL,
  `price_sale` int(11) DEFAULT NULL,
  `discount_percent` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `material` text DEFAULT NULL,
  `views` bigint(20) NOT NULL DEFAULT 0,
  `quantity` bigint(20) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sub_category_id`, `name`, `sku`, `slug`, `image_avatar`, `price_regular`, `price_sale`, `discount_percent`, `description`, `material`, `views`, `quantity`, `start_date`, `end_date`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Áo Cộc 1', 'ao-coc-1-xyz1', 'ao-coc12323-1', 'https://via.placeholder.com/640x480.png/00dd22?text=ad', 811072, 887553, 49, 'Sản phẩm chất lắm thề 1', 'Chất liệu: vải thô 1', 74, 35, '2024-12-17 12:47:21', '2025-01-16 12:47:21', 1, NULL, '2024-12-17 13:01:47', '2024-12-17 13:01:47'),
(2, 1, 'Áo Cộc 2', 'ao-coc-1-xyz2', 'ao-coc12323-2', 'https://via.placeholder.com/640x480.png/003311?text=earum', 181734, 403916, 18, 'Sản phẩm chất lắm thề 2', 'Chất liệu: vải thô 2', 65, 41, '2024-12-17 12:47:21', '2025-01-16 12:47:21', 1, NULL, '2024-12-17 13:08:24', '2024-12-17 13:08:24'),
(3, 1, 'Áo Cộc 3', 'ao-coc-1-xyz3', 'ao-coc12323-3', 'https://via.placeholder.com/640x480.png/008866?text=totam', 312613, 357597, 28, 'Sản phẩm chất lắm thề 3', 'Chất liệu: vải thô 3', 43, 32, '2024-12-17 12:47:21', '2025-01-16 12:47:21', 1, NULL, '2024-12-18 10:52:48', '2024-12-18 10:52:48'),
(6, 3, 'CRUSASDASD', 'PRD#88729750-U8IRMGTA-202412171434', 'crusasdasd', 'products/image_avatar/vay/Y07JFi5tL6MSUw6DvCrjRcpbTtatXHdbvjqxH1B8.jpg', 200000, 100000, 50, '<p>&Aacute;saS&aacute;S</p>', '<p>Đ&Acirc;SDASDAD</p>', 0, 0, '2024-12-17 00:00:00', '2024-12-21 00:00:00', 0, '2024-12-17 07:34:47', '2024-12-18 10:52:56', '2024-12-18 10:52:56'),
(7, 3, 'Áo dài cách tân Phượng Hồng', 'PRD#8451089-J1H4VXAV-202412172133', 'ao-dai-cach-tan-phuong-hong', 'products/image_avatar/vay/gbnFxsUKMqagSF5caCNr5B7AcvFE62zpx9ZlVhM1.webp', 1500000, 1200000, NULL, '<p><strong>M&ocirc; tả sản phẩm</strong>:<br>&Aacute;o d&agrave;i c&aacute;ch t&acirc;n <strong>Phượng Hồng</strong> mang n&eacute;t đẹp giao thoa giữa truyền thống v&agrave; hiện đại. Thiết kế c&aacute;ch t&acirc;n với phom d&aacute;ng gọn g&agrave;ng, t&agrave; &aacute;o ngắn hơn so với &aacute;o d&agrave;i truyền thống, gi&uacute;p người mặc dễ d&agrave;ng di chuyển v&agrave; thoải m&aacute;i trong mọi hoạt động.</p>\r\n<p><strong>Điểm nhấn thiết kế</strong>:</p>\r\n<ul>\r\n<li>T&agrave; &aacute;o c&aacute;ch t&acirc;n ngắn ngang gối hoặc d&agrave;i qua gối kết hợp với quần ống su&ocirc;ng hoặc ch&acirc;n v&aacute;y.</li>\r\n<li>Họa tiết th&ecirc;u hoa <strong>Phượng Hồng</strong> tinh tế, t&ocirc;n l&ecirc;n n&eacute;t dịu d&agrave;ng v&agrave; thanh tho&aacute;t của người phụ nữ.</li>\r\n<li>M&agrave;u sắc trang nh&atilde;, ph&ugrave; hợp với nhiều độ tuổi v&agrave; ho&agrave;n cảnh như đi chơi, dự tiệc hay du xu&acirc;n.</li>\r\n</ul>\r\n<p>&Aacute;o d&agrave;i c&aacute;ch t&acirc;n <strong>Phượng Hồng</strong> l&agrave; lựa chọn ho&agrave;n hảo để t&ocirc;n l&ecirc;n vẻ đẹp duy&ecirc;n d&aacute;ng, vừa giữ n&eacute;t truyền thống nhưng vẫn hiện đại v&agrave; tiện dụng.</p>', '<p><strong>Chất liệu</strong>:</p>\r\n<ul>\r\n<li><strong>Lụa tơ tằm cao cấp</strong>: Mềm mại, tho&aacute;ng m&aacute;t, tạo cảm gi&aacute;c dễ chịu v&agrave; nhẹ nh&agrave;ng khi mặc.</li>\r\n<li><strong>Gấm th&ecirc;u họa tiết nổi</strong>: Hoa văn được th&ecirc;u tỉ mỉ, mang đến n&eacute;t sang trọng, thanh lịch.</li>\r\n<li><strong>Voan phối nhẹ</strong>: Tăng th&ecirc;m vẻ nữ t&iacute;nh v&agrave; mềm mại, tạo độ bồng bềnh cho t&agrave; &aacute;o.</li>\r\n</ul>', 0, 0, '2024-11-25 00:00:00', '2024-12-31 00:00:00', 1, '2024-12-17 14:33:52', '2024-12-17 14:33:52', NULL),
(8, 3, 'Áo dài cách tân Phương Tử', 'PRD#89603361-RUWSMIMY-202412172141', 'ao-dai-cach-tan-phuong-tu', 'products/image_avatar/vay/5B2I2BGEHG4LHrfMZjICeUbG039nRa6XKnGDaCin.webp', 1400000, 1150000, NULL, '<p><strong>M&ocirc; tả sản phẩm</strong>:<br>&Aacute;o d&agrave;i c&aacute;ch t&acirc;n <strong>Phương Tử</strong> mang phong c&aacute;ch thanh lịch v&agrave; hiện đại, t&ocirc;n l&ecirc;n vẻ đẹp dịu d&agrave;ng, sang trọng nhưng vẫn đảm bảo sự thoải m&aacute;i v&agrave; tiện lợi cho người mặc. Thiết kế c&aacute;ch t&acirc;n ph&ugrave; hợp với nhiều ho&agrave;n cảnh như dạo phố, dự tiệc hay c&aacute;c dịp lễ truyền thống.</p>\r\n<p><strong>Điểm nhấn thiết kế</strong>:</p>\r\n<ul>\r\n<li>Phần t&agrave; &aacute;o ngắn tr&ecirc;n gối hoặc d&agrave;i qua gối, ph&ugrave; hợp phối c&ugrave;ng quần ống rộng hoặc ch&acirc;n v&aacute;y.</li>\r\n<li>Họa tiết hoa văn <strong>Phương Tử</strong> được in hoặc th&ecirc;u tỉ mỉ tr&ecirc;n t&agrave; &aacute;o, mang n&eacute;t tinh tế v&agrave; độc đ&aacute;o.</li>\r\n<li>Phom d&aacute;ng chuẩn, t&ocirc;n l&ecirc;n đường n&eacute;t cơ thể nhưng vẫn giữ được sự thoải m&aacute;i khi mặc.</li>\r\n</ul>\r\n<p>&nbsp;</p>', '<p><strong>Chất liệu</strong>:</p>\r\n<ul>\r\n<li><strong>Gấm cao cấp</strong>: Chất vải d&agrave;y dặn, mềm mịn với c&aacute;c họa tiết ch&igrave;m tinh tế, sang trọng v&agrave; bền đẹp.</li>\r\n<li><strong>Lụa satin b&oacute;ng nhẹ</strong>: Mềm mại, c&oacute; độ b&oacute;ng nhẹ gi&uacute;p t&ocirc;n l&ecirc;n sự qu&yacute; ph&aacute;i v&agrave; tạo n&eacute;t nổi bật cho người mặc.</li>\r\n<li><strong>Vải voan phối tay</strong>: Tay &aacute;o được phối với vải voan mỏng tạo sự tho&aacute;ng m&aacute;t v&agrave; nhẹ nh&agrave;ng, l&agrave;m nổi bật n&eacute;t thanh tho&aacute;t v&agrave; nữ t&iacute;nh.</li>\r\n</ul>', 0, 0, '2024-11-25 00:00:00', '2024-12-31 00:00:00', 1, '2024-12-17 14:41:50', '2024-12-17 14:41:50', NULL),
(9, 3, 'Áo dài cách tân 2 tà thêu hoa', 'PRD#43942864-OMP9RCKU-202412172150', 'ao-dai-cach-tan-2-ta-theu-hoa', 'products/image_avatar/vay/9IqlTiSML26vdQLobGByjV6c5Bl3KFH1jaEejInJ.webp', 1600000, 1300000, NULL, '<div class=\"flex-shrink-0 flex flex-col relative items-end\">\r\n<div>\r\n<div class=\"pt-0\">\r\n<div class=\"gizmo-shadow-stroke flex h-8 w-8 items-center justify-center overflow-hidden rounded-full\">\r\n<div class=\"h-full w-full\">\r\n<div class=\"gizmo-shadow-stroke overflow-hidden rounded-full\"><img class=\"h-full w-full bg-token-main-surface-secondary\" src=\"https://chatgpt.com/backend-api/content?id=file-hbxowtiyxew901FywZXTcb4V&amp;gizmo_id=g-2DQzU5UZl&amp;ts=481790&amp;p=gpp&amp;sig=47dc886a0708e43d0003d04f3b29fef1e3b00e19b43c28c2b7c47ec7521b9483&amp;v=0\" alt=\"GPT Icon\" width=\"80\" height=\"80\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"group/conversation-turn relative flex w-full min-w-0 flex-col agent-turn\">\r\n<div class=\"flex-col gap-1 md:gap-3\">\r\n<div class=\"flex max-w-full flex-col flex-grow\">\r\n<div class=\"min-h-8 text-message flex w-full flex-col items-end gap-2 whitespace-normal break-words text-start [.text-message+&amp;]:mt-5\" dir=\"auto\" data-message-author-role=\"assistant\" data-message-id=\"8d0a07a2-0b70-4d6c-8656-760e79168ddb\" data-message-model-slug=\"gpt-4o\">\r\n<div class=\"flex w-full flex-col gap-1 empty:hidden first:pt-[3px]\">\r\n<div class=\"markdown prose w-full break-words dark:prose-invert dark\">\r\n<h3><strong>&Aacute;o d&agrave;i c&aacute;ch t&acirc;n 2 t&agrave; th&ecirc;u hoa</strong></h3>\r\n<p><strong>M&ocirc; tả sản phẩm</strong>:<br>&Aacute;o d&agrave;i c&aacute;ch t&acirc;n <strong>2 t&agrave; th&ecirc;u hoa</strong> l&agrave; sự kết hợp ho&agrave;n hảo giữa n&eacute;t truyền thống v&agrave; hiện đại. Thiết kế 2 t&agrave; trẻ trung, c&aacute;ch điệu mang đến sự thoải m&aacute;i v&agrave; tiện lợi, ph&ugrave; hợp cho nhiều dịp như lễ hội, sự kiện hay dạo phố.</p>\r\n<p><strong>Điểm nhấn thiết kế</strong>:</p>\r\n<ul>\r\n<li>Phần t&agrave; &aacute;o được c&aacute;ch t&acirc;n với kiểu d&aacute;ng <strong>2 t&agrave;</strong>, tạo độ bồng nhẹ v&agrave; thanh tho&aacute;t khi di chuyển.</li>\r\n<li>Họa tiết hoa th&ecirc;u nổi bật ở ngực hoặc dọc t&agrave; &aacute;o, mang lại vẻ tinh tế v&agrave; trang nh&atilde;.</li>\r\n<li>Dễ d&agrave;ng kết hợp c&ugrave;ng <strong>quần su&ocirc;ng</strong>, <strong>ch&acirc;n v&aacute;y lụa</strong> hoặc phụ kiện truyền thống, l&agrave;m nổi bật n&eacute;t đẹp dịu d&agrave;ng v&agrave; hiện đại.</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '<p><strong>Chất liệu</strong>:</p>\r\n<ul>\r\n<li><strong>Lụa cao cấp</strong>: Mềm mại, nhẹ nh&agrave;ng, tho&aacute;ng m&aacute;t, mang lại cảm gi&aacute;c dễ chịu khi mặc.</li>\r\n<li><strong>Gấm phối nhẹ</strong>: Tạo độ sang trọng, với họa tiết ch&igrave;m t&ocirc;n l&ecirc;n n&eacute;t tinh tế của &aacute;o.</li>\r\n<li><strong>Th&ecirc;u hoa thủ c&ocirc;ng</strong>: Hoa văn được th&ecirc;u tỉ mỉ tr&ecirc;n t&agrave; &aacute;o, gi&uacute;p tạo điểm nhấn duy&ecirc;n d&aacute;ng v&agrave; thanh lịch.</li>\r\n</ul>', 0, 0, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 1, '2024-12-17 14:50:10', '2024-12-17 14:50:10', NULL),
(10, 3, 'Áo dài cách tân 1 tà can bèo vạt', 'PRD#16483811-8KWWE2BU-202412172152', 'ao-dai-cach-tan-1-ta-can-beo-vat', 'products/image_avatar/vay/zBB8FKRDe8hIJulQcXtQ0HO7t8ZujM0nW0SM7a1W.jpg', 1400000, 1150000, NULL, '<p><strong>M&ocirc; tả sản phẩm</strong>:<br>&Aacute;o d&agrave;i c&aacute;ch t&acirc;n <strong>1 t&agrave; can b&egrave;o vạt</strong> mang đến sự độc đ&aacute;o v&agrave; mới lạ với thiết kế tối giản nhưng đầy tinh tế. Phần can b&egrave;o mềm mại ở vạt &aacute;o tạo điểm nhấn duy&ecirc;n d&aacute;ng, t&ocirc;n l&ecirc;n n&eacute;t đẹp thanh tho&aacute;t v&agrave; nhẹ nh&agrave;ng cho người mặc.</p>\r\n<p><strong>Điểm nhấn thiết kế</strong>:</p>\r\n<ul>\r\n<li>Thiết kế <strong>1 t&agrave; c&aacute;ch t&acirc;n</strong> độc đ&aacute;o gi&uacute;p tạo sự trẻ trung v&agrave; hiện đại.</li>\r\n<li>Phần vạt <strong>can b&egrave;o mềm mại</strong> tạo điểm nhấn tinh tế, tăng th&ecirc;m sự duy&ecirc;n d&aacute;ng khi di chuyển.</li>\r\n<li>Phom &aacute;o su&ocirc;ng nhẹ, thoải m&aacute;i v&agrave; dễ kết hợp với <strong>quần su&ocirc;ng</strong> hoặc <strong>ch&acirc;n v&aacute;y midi</strong>.</li>\r\n</ul>', '<p><strong>Chất liệu</strong>:</p>\r\n<ul>\r\n<li><strong>Lụa satin cao cấp</strong>: Chất vải b&oacute;ng nhẹ, mềm mại, tạo cảm gi&aacute;c tho&aacute;ng m&aacute;t v&agrave; thoải m&aacute;i.</li>\r\n<li><strong>Voan phối b&egrave;o</strong>: Mang lại sự bồng bềnh, nhẹ nh&agrave;ng v&agrave; nữ t&iacute;nh cho phần vạt &aacute;o</li>\r\n</ul>', 0, 0, '2024-11-25 00:00:00', '2024-11-25 00:00:00', 1, '2024-12-17 14:52:54', '2024-12-17 14:52:54', NULL),
(11, 4, 'Trang Phục Dân Tộc Lự', 'PRD#60178989-YTLFO4OC-202412172157', 'trang-phuc-dan-toc-lu', 'products/image_avatar/tui-sach/VNvdcnxDTSp4IDLT2gOXqG3YmnsZDB1ZUHOvIyRT.jpg', 2000000, 1700000, NULL, '<p><strong>M&ocirc; tả sản phẩm</strong>:<br>Trang phục d&acirc;n tộc <strong>Lự</strong> l&agrave; sự kết tinh của văn h&oacute;a truyền thống đặc sắc, mang đậm dấu ấn bản sắc của người d&acirc;n tộc Lự v&ugrave;ng T&acirc;y Bắc Việt Nam. Thiết kế tinh tế với họa tiết thủ c&ocirc;ng tỉ mỉ, kết hợp gam m&agrave;u nổi bật, t&ocirc;n l&ecirc;n vẻ đẹp độc đ&aacute;o, giản dị nhưng đầy ấn tượng.</p>\r\n<p><strong>Điểm nhấn thiết kế</strong>:</p>\r\n<ul>\r\n<li>Họa tiết th&ecirc;u tay v&agrave; dệt hoa văn <strong>độc đ&aacute;o</strong> thể hiện sự tinh xảo v&agrave; &yacute; nghĩa văn h&oacute;a của d&acirc;n tộc.</li>\r\n<li>Trang phục gồm <strong>&aacute;o ngắn cổ vu&ocirc;ng</strong>, kết hợp <strong>v&aacute;y ống d&agrave;i</strong> với c&aacute;c dải hoa văn sắc n&eacute;t.</li>\r\n<li>M&agrave;u sắc chủ đạo l&agrave; <strong>đen</strong>, phối c&ugrave;ng c&aacute;c m&agrave;u nổi như đỏ, xanh, v&agrave;ng để l&agrave;m điểm nhấn.</li>\r\n</ul>', '<p><strong>Chất liệu</strong>:</p>\r\n<ul>\r\n<li><strong>Vải thổ cẩm dệt tay</strong>: Chất liệu truyền thống, bền chắc với c&aacute;c họa tiết v&agrave; hoa văn được dệt thủ c&ocirc;ng, tỉ mỉ.</li>\r\n<li><strong>Sợi cotton tự nhi&ecirc;n</strong>: Mềm mại, tho&aacute;ng kh&iacute;, ph&ugrave; hợp với mọi điều kiện thời tiết.</li>\r\n</ul>', 0, 0, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 1, '2024-12-17 14:57:28', '2024-12-17 14:57:28', NULL),
(12, 4, 'Trang Phục Dân Tộc Chăm', 'PRD#55971345-5OE7NICA-202412172204', 'trang-phuc-dan-toc-cham', 'products/image_avatar/tui-sach/y4zxoBf1dtpjaiASMXc4KTp0f3zKfXvTxNsnHo5G.webp', 1800000, 1500000, NULL, '<p><strong>M&ocirc; tả sản phẩm</strong>:<br>Trang phục <strong>d&acirc;n tộc Chăm</strong> mang vẻ đẹp thanh tho&aacute;t, tinh tế v&agrave; đậm đ&agrave; bản sắc văn h&oacute;a của người Chăm. Thiết kế nhẹ nh&agrave;ng, mềm mại, t&ocirc;n l&ecirc;n đường n&eacute;t duy&ecirc;n d&aacute;ng v&agrave; n&eacute;t đẹp truyền thống của người phụ nữ, đồng thời thể hiện sự sang trọng v&agrave; trang nh&atilde;.</p>\r\n<p><strong>iểm nhấn thiết kế</strong>:</p>\r\n<ul>\r\n<li>&Aacute;o d&agrave;i cổ cao hoặc cổ tr&ograve;n đặc trưng của người Chăm, với phom d&aacute;ng &ocirc;m nhẹ nh&agrave;ng gi&uacute;p t&ocirc;n l&ecirc;n vẻ đẹp thanh lịch.</li>\r\n<li><strong>Dải thắt lưng</strong> được l&agrave;m từ vải thổ cẩm, thắt ngang eo tạo điểm nhấn nổi bật.</li>\r\n<li>Kết hợp <strong>khăn cho&agrave;ng hoặc khăn đội đầu</strong> với họa tiết truyền thống v&agrave; m&agrave;u sắc nhẹ nh&agrave;ng.</li>\r\n<li>M&agrave;u sắc chủ đạo l&agrave; c&aacute;c gam m&agrave;u <strong>trắng, đỏ sẫm, v&agrave;ng đồng</strong> mang &yacute; nghĩa truyền thống v&agrave; h&agrave;i h&ograve;a.</li>\r\n</ul>', '<p><strong>Chất liệu</strong>:</p>\r\n<ul>\r\n<li><strong>Vải lụa hoặc vải cotton tự nhi&ecirc;n</strong>: Tho&aacute;ng m&aacute;t, mềm mại v&agrave; tạo sự thoải m&aacute;i khi mặc.</li>\r\n<li><strong>Vải dệt thủ c&ocirc;ng</strong>: Chất liệu được dệt tỉ mỉ, kết hợp hoa văn truyền thống độc đ&aacute;o mang &yacute; nghĩa văn h&oacute;a s&acirc;u sắc.</li>\r\n</ul>', 0, 0, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 1, '2024-12-17 15:04:29', '2024-12-17 15:04:29', NULL),
(13, 4, 'Trang phục dân tộc Mường', 'PRD#90006973-NWL5DMEJ-202412172207', 'trang-phuc-dan-toc-muong', 'products/image_avatar/tui-sach/DRPqaP6zzNoyxe2AYyO4DrCiVTX1v9Qg3snKTTnJ.webp', 1900000, 1600000, NULL, '<p><strong>M&ocirc; tả sản phẩm</strong>:<br>Trang phục <strong>d&acirc;n tộc Mường</strong> mang đậm n&eacute;t văn h&oacute;a truyền thống của d&acirc;n tộc Mường với thiết kế h&agrave;i h&ograve;a, tinh tế v&agrave; gi&agrave;u &yacute; nghĩa. Bộ trang phục vừa thể hiện vẻ đẹp mộc mạc, giản dị, vừa t&ocirc;n l&ecirc;n sự duy&ecirc;n d&aacute;ng v&agrave; n&eacute;t mềm mại của người phụ nữ Mường.</p>\r\n<p><strong>Điểm nhấn thiết kế</strong>:</p>\r\n<ul>\r\n<li><strong>&Aacute;o ngắn xẻ ngực (&Aacute;o Pắn)</strong>: Thiết kế cổ truyền với phom d&aacute;ng vừa vặn, tạo sự thoải m&aacute;i.</li>\r\n<li><strong>Ch&acirc;n v&aacute;y dệt họa tiết</strong>: V&aacute;y ống d&agrave;i được dệt bằng kỹ thuật thủ c&ocirc;ng với hoa văn độc đ&aacute;o v&agrave; những đường viền nổi bật, mang &yacute; nghĩa phong tục văn h&oacute;a của d&acirc;n tộc Mường.</li>\r\n<li>Kết hợp với <strong>dải thắt lưng thổ cẩm</strong>, tạo điểm nhấn ở eo, l&agrave;m t&ocirc;n l&ecirc;n v&oacute;c d&aacute;ng v&agrave; n&eacute;t đẹp truyền thống.</li>\r\n<li>M&agrave;u sắc chủ đạo l&agrave; <strong>đen, trắng v&agrave; c&aacute;c t&ocirc;ng m&agrave;u rực rỡ</strong> như đỏ, xanh l&aacute;, v&agrave;ng điểm xuyết tr&ecirc;n v&aacute;y v&agrave; &aacute;o.</li>\r\n</ul>', '<p><strong>Chất liệu</strong>:</p>\r\n<ul>\r\n<li><strong>Vải thổ cẩm dệt tay</strong>: Chất liệu truyền thống với c&aacute;c họa tiết hoa văn được dệt tinh xảo, bền đẹp.</li>\r\n<li><strong>Sợi cotton tự nhi&ecirc;n</strong>: Tho&aacute;ng m&aacute;t, nhẹ nh&agrave;ng, mang lại cảm gi&aacute;c thoải m&aacute;i khi mặc.</li>\r\n</ul>', 0, 0, '2024-11-25 00:00:00', '2024-11-25 00:00:00', 1, '2024-12-17 15:07:51', '2024-12-17 15:07:51', NULL),
(14, 4, 'Trang phục dân tộc Tày', 'PRD#41753568-MJQLIPIE-202412172212', 'trang-phuc-dan-toc-tay', 'products/image_avatar/khong-phan-loai/3XjqVShcrp7C5pfJB1mV6lGgGfXrdNtxJl38tAx9.webp', 1800000, 1500000, NULL, '<p><strong>M&ocirc; tả sản phẩm</strong>:<br>Trang phục <strong>d&acirc;n tộc T&agrave;y</strong> mang vẻ đẹp giản dị, tinh tế nhưng đầy &yacute; nghĩa truyền thống. Với thiết kế đơn giản, nhẹ nh&agrave;ng v&agrave; gam m&agrave;u đặc trưng, bộ trang phục thể hiện r&otilde; n&eacute;t văn h&oacute;a mộc mạc v&agrave; thanh lịch của người T&agrave;y v&ugrave;ng n&uacute;i ph&iacute;a Bắc.</p>\r\n<p><strong>Điểm nhấn thiết kế</strong>:</p>\r\n<ul>\r\n<li><strong>&Aacute;o d&agrave;i 5 th&acirc;n</strong> (&Aacute;o Cỏm): Thiết kế d&aacute;ng su&ocirc;ng nhẹ, tay d&agrave;i, cổ tr&ograve;n hoặc cổ t&agrave;u k&iacute;n đ&aacute;o, ph&ugrave; hợp với mọi v&oacute;c d&aacute;ng.</li>\r\n<li><strong>Quần ống đứng đen</strong>: Đơn giản, tạo sự thoải m&aacute;i trong di chuyển.</li>\r\n<li>Kết hợp với <strong>thắt lưng vải thổ cẩm</strong> điểm nhẹ ở eo để tạo điểm nhấn thanh tho&aacute;t.</li>\r\n<li>Phụ kiện đi k&egrave;m: <strong>khăn vấn đầu</strong> m&agrave;u đen đơn giản, t&ocirc;n l&ecirc;n vẻ đẹp truyền thống mộc mạc.</li>\r\n</ul>', '<p><strong>Chất liệu</strong>:</p>\r\n<ul>\r\n<li><strong>Vải nhuộm ch&agrave;m</strong>: Được dệt thủ c&ocirc;ng v&agrave; nhuộm tự nhi&ecirc;n bằng l&aacute; ch&agrave;m, tạo n&ecirc;n m&agrave;u <strong>xanh đen</strong> trầm đặc trưng.</li>\r\n<li><strong>Sợi cotton tự nhi&ecirc;n</strong>: Tho&aacute;ng m&aacute;t, mềm mại, đem lại cảm gi&aacute;c thoải m&aacute;i v&agrave; tiện lợi khi mặc.</li>\r\n</ul>', 0, 48, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 1, '2024-12-17 15:12:08', '2024-12-18 04:43:06', NULL),
(15, 10, 'Áo Giữ Nhiệt Trẻ Em', 'PRD#28011474-EVYNECWN-202412181928', 'ao-giu-nhiet-tre-em', 'products/image_avatar/khong-phan-loai/aj2L0R5gXnZQE5zkREsK4UIQEzgy79k3QjucsBDU.webp', 179000, 89500, NULL, '<p><strong>Đặc điểm nổi bật:</strong></p>\r\n<ul>\r\n<li>&Aacute;o giữ nhiệt trẻ em l&agrave; sản phẩm chuy&ecirc;n dụng được thiết kế để giữ ấm cơ thể trong những ng&agrave;y lạnh gi&aacute;.</li>\r\n<li>Với thiết kế gọn nhẹ, co gi&atilde;n tốt, &aacute;o &ocirc;m s&aacute;t vừa vặn, gi&uacute;p bảo vệ b&eacute; y&ecirc;u trước c&aacute;c cơn gi&oacute; lạnh m&agrave; vẫn đảm bảo sự thoải m&aacute;i suốt cả ng&agrave;y.<br>\r\n<p><strong>Lợi &iacute;ch:</strong></p>\r\n<ul>\r\n<li>Giữ ấm cơ thể hiệu quả.</li>\r\n<li>Đảm bảo sự thoải m&aacute;i khi vận động nhờ chất liệu co gi&atilde;n linh hoạt.</li>\r\n<li>Dễ d&agrave;ng phối hợp với &aacute;o kho&aacute;c v&agrave; phụ kiện kh&aacute;c cho b&eacute; phong c&aacute;ch hơn.</li>\r\n</ul>\r\n</li>\r\n</ul>', '<ul>\r\n<li>\r\n<p><strong>Chất liệu ch&iacute;nh:</strong></p>\r\n<ul>\r\n<li><strong>Polyester pha Spandex:</strong> Mang đến khả năng giữ nhiệt tối ưu, co gi&atilde;n 4 chiều v&agrave; mềm mại khi chạm v&agrave;o da.</li>\r\n<li>Tỷ lệ pha l&yacute; tưởng giữa Polyester v&agrave; Spandex đảm bảo t&iacute;nh bền bỉ, chịu m&agrave;i m&ograve;n tốt v&agrave; kh&ocirc;ng x&ugrave; l&ocirc;ng sau nhiều lần giặt.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Lớp vải b&ecirc;n trong:</strong></p>\r\n<ul>\r\n<li>L&oacute;t l&ocirc;ng nhẹ hoặc chất liệu nỉ mềm gi&uacute;p c&aacute;ch nhiệt v&agrave; mang lại cảm gi&aacute;c ấm &aacute;p, &ecirc;m &aacute;i khi tiếp x&uacute;c với da.</li>\r\n<li>Đặc t&iacute;nh th&acirc;n thiện với l&agrave;n da nhạy cảm của trẻ em.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Khả năng tho&aacute;ng kh&iacute;:</strong></p>\r\n<ul>\r\n<li>Lớp vải được xử l&yacute; để vừa giữ ấm, vừa kh&ocirc;ng g&acirc;y b&iacute; b&aacute;ch, đảm bảo sự kh&ocirc; tho&aacute;ng ngay cả khi b&eacute; vận động.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>T&iacute;nh năng chống thấm nhẹ:</strong></p>\r\n<ul>\r\n<li>Một số mẫu &aacute;o giữ nhiệt được phủ lớp chống thấm nhẹ b&ecirc;n ngo&agrave;i, ph&ugrave; hợp với thời tiết mưa ph&ugrave;n.</li>\r\n</ul>\r\n</li>\r\n</ul>', 0, 112, '2024-12-02 00:00:00', '2024-12-18 00:00:00', 1, '2024-12-18 12:28:42', '2024-12-19 01:35:59', NULL),
(16, 5, 'Áo Khoác Gió Nam 2 Lớp Siêu Co Giãn', 'PRD#10146953-HFEWZMLZ-202412181931', 'ao-khoac-gio-nam-2-lop-sieu-co-gian', 'products/image_avatar/trang-phuc-truyen-thong/wfOfiUOdP1pZVrqCEgGWdnzOlQ8dQwfaLDYmIJbL.webp', 769000, 692100, NULL, '<p><strong>Đặc điểm nổi bật:</strong></p>\r\n<ul>\r\n<li>Thiết kế hiện đại, trẻ trung ph&ugrave; hợp với nhiều phong c&aacute;ch từ năng động, thể thao đến c&ocirc;ng sở.</li>\r\n<li>Lớp bảo vệ k&eacute;p gi&uacute;p chống gi&oacute; v&agrave; giữ ấm hiệu quả trong thời tiết se lạnh hoặc mưa ph&ugrave;n nhẹ.</li>\r\n<li>Khả năng co gi&atilde;n vượt trội, đem lại sự thoải m&aacute;i v&agrave; linh hoạt cho c&aacute;c hoạt động h&agrave;ng ng&agrave;y.<br><br>\r\n<p><strong>Lợi &iacute;ch:</strong></p>\r\n<ul>\r\n<li>Chống gi&oacute; v&agrave; giữ ấm cơ thể hiệu quả.</li>\r\n<li>Vải si&ecirc;u co gi&atilde;n mang đến sự thoải m&aacute;i tối đa.</li>\r\n<li>Ph&ugrave; hợp với nhiều ho&agrave;n cảnh, từ đi l&agrave;m, đi chơi, đến du lịch hoặc hoạt động thể thao ngo&agrave;i trời.</li>\r\n</ul>\r\n</li>\r\n</ul>', '<p><strong>M&ocirc; tả chất liệu:</strong></p>\r\n<ol>\r\n<li>\r\n<p><strong>Lớp ngo&agrave;i:</strong></p>\r\n<ul>\r\n<li><strong>Chất liệu Polyester cao cấp:</strong> Khả năng chống gi&oacute;, kh&aacute;ng nước nhẹ, bền m&agrave;u v&agrave; chống b&aacute;m bẩn tốt.</li>\r\n<li>Bề mặt vải được xử l&yacute; đặc biệt gi&uacute;p &aacute;o kh&ocirc;ng chỉ chống gi&oacute; m&agrave; c&ograve;n chống ẩm mốc trong m&ocirc;i trường ẩm ướt.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Lớp trong:</strong></p>\r\n<ul>\r\n<li><strong>Vải l&oacute;t Microfiber hoặc Mesh tho&aacute;ng kh&iacute;:</strong> Mang lại sự mềm mại khi tiếp x&uacute;c với da v&agrave; tạo kh&ocirc;ng gian th&ocirc;ng tho&aacute;ng b&ecirc;n trong &aacute;o.</li>\r\n<li>Lớp l&oacute;t kh&ocirc;ng g&acirc;y hầm n&oacute;ng, gi&uacute;p c&acirc;n bằng nhiệt độ cơ thể ngay cả khi vận động nhiều.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Đặc t&iacute;nh co gi&atilde;n:</strong></p>\r\n<ul>\r\n<li>Sự pha trộn của Spandex v&agrave;o lớp ngo&agrave;i hoặc lớp vải dệt b&ecirc;n trong tăng cường độ co gi&atilde;n v&agrave; linh hoạt của &aacute;o.</li>\r\n<li>Đ&aacute;p ứng nhu cầu vận động mạnh hoặc sử dụng h&agrave;ng ng&agrave;y m&agrave; kh&ocirc;ng g&acirc;y b&oacute; cứng hay mất d&aacute;ng &aacute;o.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Khả năng chống thấm nhẹ:</strong></p>\r\n<ul>\r\n<li>Bề mặt &aacute;o c&oacute; thể chống được mưa nhỏ hoặc mưa ph&ugrave;n, gi&uacute;p bạn y&ecirc;n t&acirc;m khi di chuyển trong điều kiện thời tiết kh&ocirc;ng thuận lợi.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Đường may kỹ thuật cao:</strong></p>\r\n<ul>\r\n<li>C&ocirc;ng nghệ may &eacute;p nhiệt hoặc may kh&ocirc;ng lộ đường chỉ, tăng t&iacute;nh thẩm mỹ v&agrave; đảm bảo độ bền d&agrave;i l&acirc;u.</li>\r\n</ul>\r\n</li>\r\n</ol>', 0, 105, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 1, '2024-12-18 12:31:39', '2024-12-19 01:37:03', NULL),
(17, 5, 'Áo Khoác Gió Nữ 3C Plus Năng Động', 'PRD#66711228-UZEFYYZH-202412181934', 'ao-khoac-gio-nu-3c-plus-nang-ong', 'products/image_avatar/trang-phuc-truyen-thong/OF6DBsVscKjrkpjlE5wTw4qnKNG3UvPI2FKaIB74.webp', 499000, NULL, 80, '<p><strong>Đặc điểm nổi bật:</strong></p>\r\n<ul>\r\n<li>Thiết kế trẻ trung, thanh lịch, dễ d&agrave;ng phối đồ trong nhiều ho&agrave;n cảnh.</li>\r\n<li>C&ocirc;ng nghệ 3C Plus với 3 ti&ecirc;u ch&iacute; nổi bật: <strong>Chống gi&oacute;</strong>, <strong>Chống thấm nhẹ</strong>, v&agrave; <strong>Co gi&atilde;n thoải m&aacute;i</strong>.</li>\r\n<li>Tối ưu cho c&aacute;c hoạt động ngo&agrave;i trời v&agrave; thời tiết thay đổi bất thường<br>\r\n<p><strong>Lợi &iacute;ch:</strong></p>\r\n<ul>\r\n<li>Chống gi&oacute; v&agrave; thấm nước nhẹ cho c&aacute;c ng&agrave;y mưa ph&ugrave;n hoặc gi&oacute; lớn.</li>\r\n<li>Si&ecirc;u co gi&atilde;n v&agrave; thoải m&aacute;i, l&yacute; tưởng cho cả vận động ngo&agrave;i trời lẫn di chuyển thường ng&agrave;y.</li>\r\n<li>Dễ phối đồ, từ trang phục thể thao năng động đến phong c&aacute;ch casual hằng ng&agrave;y.</li>\r\n</ul>\r\n</li>\r\n</ul>', '<ul>\r\n<li>\r\n<p><strong>Lớp ngo&agrave;i:</strong></p>\r\n<ul>\r\n<li><strong>Polyester pha Nylon cao cấp:</strong> Chống gi&oacute; ho&agrave;n hảo, chịu nước nhẹ, đồng thời c&oacute; độ bền cao, giảm b&aacute;m bụi v&agrave; bẩn.</li>\r\n<li>Bề mặt được xử l&yacute; c&ocirc;ng nghệ DWR (<strong>Durable Water Repellent</strong>): Ngăn nước mưa nhỏ lăn tr&ecirc;n bề mặt &aacute;o m&agrave; kh&ocirc;ng thấm v&agrave;o vải.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Lớp trong:</strong></p>\r\n<ul>\r\n<li><strong>Vải l&oacute;t Mesh tho&aacute;ng kh&iacute;:</strong> Tạo kh&ocirc;ng gian tho&aacute;ng m&aacute;t, giảm hầm n&oacute;ng khi mặc trong thời gian d&agrave;i.</li>\r\n<li>Chất liệu mềm mịn, an to&agrave;n với da, đảm bảo cảm gi&aacute;c dễ chịu khi sử dụng.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>C&ocirc;ng nghệ co gi&atilde;n 4 chiều:</strong></p>\r\n<ul>\r\n<li>T&iacute;ch hợp Spandex v&agrave;o lớp vải ch&iacute;nh, mang lại độ linh hoạt vượt trội, cho ph&eacute;p cử động tự do m&agrave; kh&ocirc;ng lo bị b&oacute; chặt.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Khả năng c&aacute;ch nhiệt nhẹ:</strong></p>\r\n<ul>\r\n<li>Được thiết kế để giữ nhiệt cơ thể, gi&uacute;p duy tr&igrave; sự ấm &aacute;p khi gi&oacute; lạnh k&eacute;o đến, nhưng kh&ocirc;ng g&acirc;y b&iacute; b&aacute;ch khi trời m&aacute;t.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Chi tiết bổ sung:</strong></p>\r\n<ul>\r\n<li><strong>Kh&oacute;a k&eacute;o YKK</strong> cao cấp: Độ bền v&agrave; mượt khi sử dụng l&acirc;u d&agrave;i.</li>\r\n<li><strong>T&uacute;i zip an to&agrave;n:</strong> Ngăn chống nước giữ vật dụng c&aacute; nh&acirc;n như điện thoại, ch&igrave;a kh&oacute;a kh&ocirc;ng bị ướt.</li>\r\n</ul>\r\n</li>\r\n</ul>', 0, 65, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 1, '2024-12-18 12:34:19', '2024-12-19 01:39:09', NULL),
(18, 5, 'Áo Khoác Jeans Nữ Crop Mỏng Nhẹ', 'PRD#97662187-YV9UCBSN-202412181936', 'ao-khoac-jeans-nu-crop-mong-nhe', 'products/image_avatar/trang-phuc-truyen-thong/lIjWN0nl8XRKItNKrr63Xxy4nFPJzVCKeR609UtN.webp', 369000, NULL, 70, '<p><strong>Đặc điểm nổi bật:</strong></p>\r\n<ul>\r\n<li>Thiết kế <strong>crop trẻ trung</strong> ph&ugrave; hợp với xu hướng thời trang hiện đại.</li>\r\n<li>Kiểu d&aacute;ng mỏng nhẹ, dễ phối với nhiều phong c&aacute;ch kh&aacute;c nhau từ năng động, c&aacute; t&iacute;nh đến nữ t&iacute;nh.</li>\r\n<li>Th&iacute;ch hợp sử dụng trong thời tiết m&aacute;t mẻ hoặc l&agrave;m điểm nhấn thời trang.<br>\r\n<p><strong>Lợi &iacute;ch:</strong></p>\r\n<ul>\r\n<li>Thoải m&aacute;i v&agrave; nhẹ nh&agrave;ng, ph&ugrave; hợp cho c&aacute;c hoạt động cả ng&agrave;y.</li>\r\n<li>Dễ d&agrave;ng phối với ch&acirc;n v&aacute;y, quần short, hoặc quần jeans để tạo ra nhiều phong c&aacute;ch kh&aacute;c nhau.</li>\r\n<li>Th&iacute;ch hợp cho thời tiết m&aacute;t mẻ hoặc khi cần một chiếc &aacute;o kho&aacute;c thời trang m&agrave; kh&ocirc;ng cần qu&aacute; d&agrave;y.</li>\r\n</ul>\r\n</li>\r\n</ul>', '<ul>\r\n<li>\r\n<p><strong>Chất liệu vải ch&iacute;nh:</strong></p>\r\n<ul>\r\n<li><strong>Denim mỏng nhẹ:</strong> L&agrave;m từ cotton pha sợi tổng hợp, gi&uacute;p vải mềm mại, tho&aacute;ng m&aacute;t nhưng vẫn giữ được vẻ bề ngo&agrave;i bụi bặm của chất liệu jeans.</li>\r\n<li>Trọng lượng vải nhẹ hơn so với jeans truyền thống, mang lại sự thoải m&aacute;i, kh&ocirc;ng g&acirc;y cảm gi&aacute;c nặng nề khi mặc l&acirc;u.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Độ mềm mại:</strong></p>\r\n<ul>\r\n<li>Chất liệu được giặt m&agrave;i hoặc xử l&yacute; enzyme (<strong>enzyme wash</strong>) gi&uacute;p l&agrave;m mềm vải, mang lại cảm gi&aacute;c dễ chịu khi mặc, kh&ocirc;ng g&acirc;y k&iacute;ch ứng cho da.</li>\r\n<li>Dễ tạo nếp nhăn tự nhi&ecirc;n, mang lại phong c&aacute;ch vintage.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Độ co gi&atilde;n:</strong></p>\r\n<ul>\r\n<li>C&oacute; thể pha th&ecirc;m Spandex để tăng độ co gi&atilde;n nhẹ, ph&ugrave; hợp với c&aacute;c cử động thường ng&agrave;y.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Khả năng tho&aacute;ng kh&iacute;:</strong></p>\r\n<ul>\r\n<li>Chất liệu vải thấm h&uacute;t tốt, đảm bảo tho&aacute;ng m&aacute;t trong c&aacute;c điều kiện thời tiết kh&aacute;c nhau, đặc biệt l&yacute; tưởng cho thời tiết m&ugrave;a xu&acirc;n hoặc thu.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>M&agrave;u sắc v&agrave; xử l&yacute;:</strong></p>\r\n<ul>\r\n<li>Thường c&oacute; m&agrave;u sắc đa dạng từ xanh nhạt, xanh cổ điển, đến t&ocirc;ng trầm như đen hoặc x&aacute;m.</li>\r\n<li>Sử dụng kỹ thuật nhuộm v&agrave; m&agrave;i c&aacute;t tạo hiệu ứng bạc m&agrave;u tự nhi&ecirc;n hoặc r&aacute;ch nghệ thuật.</li>\r\n</ul>\r\n</li>\r\n</ul>', 0, 45, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 1, '2024-12-18 12:36:16', '2024-12-19 01:40:21', NULL),
(19, 5, 'Áo Khoác Nỉ Thể Thao', 'PRD#769060-PO67SGIP-202412181938', 'ao-khoac-ni-the-thao', 'products/image_avatar/trang-phuc-truyen-thong/2e5Mlf2k0Lac28rtjzwiv53RaFzJiUzVDNzivV7S.webp', 599000, NULL, 10, '<p><strong>Đặc điểm nổi bật:</strong></p>\r\n<ul>\r\n<li>Thiết kế khỏe khoắn, năng động, ph&ugrave; hợp cho cả nam v&agrave; nữ.</li>\r\n<li>Dễ d&agrave;ng sử dụng trong c&aacute;c hoạt động thể thao, dạo phố hay l&agrave;m lớp giữ ấm nhẹ trong thời tiết m&aacute;t mẻ.</li>\r\n<li>Mang lại sự thoải m&aacute;i, linh hoạt v&agrave; phong c&aacute;ch trẻ trung.<br>\r\n<p><strong>Lợi &iacute;ch:</strong></p>\r\n<ul>\r\n<li>Ph&ugrave; hợp cho cả tập luyện thể thao lẫn trang phục h&agrave;ng ng&agrave;y.</li>\r\n<li>Nhẹ nh&agrave;ng, thoải m&aacute;i, giữ nhiệt tốt m&agrave; kh&ocirc;ng g&acirc;y b&iacute; b&aacute;ch.</li>\r\n<li>Dễ d&agrave;ng phối với quần jogger, quần legging hoặc gi&agrave;y thể thao để ho&agrave;n thiện phong c&aacute;ch năng động.</li>\r\n</ul>\r\n</li>\r\n</ul>', '<ul>\r\n<li>\r\n<p><strong>Chất liệu ch&iacute;nh:</strong></p>\r\n<ul>\r\n<li><strong>Vải nỉ (French Terry hoặc Fleece):</strong>\r\n<ul>\r\n<li>Bề mặt vải b&ecirc;n ngo&agrave;i phẳng mịn, b&ecirc;n trong c&oacute; lớp l&ocirc;ng xốp mềm hoặc lớp v&ograve;ng chỉ thấm h&uacute;t tốt.</li>\r\n<li>Chất liệu n&agrave;y c&oacute; độ d&agrave;y vừa phải, gi&uacute;p giữ nhiệt cơ thể v&agrave; tho&aacute;ng kh&iacute;, đảm bảo sự dễ chịu khi mặc trong thời gian d&agrave;i.</li>\r\n</ul>\r\n</li>\r\n<li>Thường được l&agrave;m từ sợi cotton tự nhi&ecirc;n hoặc cotton pha Polyester, kết hợp sự mềm mại v&agrave; bền bỉ.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Khả năng giữ nhiệt:</strong></p>\r\n<ul>\r\n<li>Với lớp b&ecirc;n trong b&ocirc;ng nỉ, &aacute;o giữ ấm cơ thể hiệu quả khi trời se lạnh hoặc buổi s&aacute;ng sớm.</li>\r\n<li>Độ d&agrave;y vừa phải gi&uacute;p duy tr&igrave; nhiệt độ m&agrave; kh&ocirc;ng g&acirc;y hầm n&oacute;ng trong c&aacute;c hoạt động thể chất.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Độ co gi&atilde;n:</strong></p>\r\n<ul>\r\n<li>Chất liệu được dệt th&ecirc;m Spandex (nếu c&oacute;) hoặc xử l&yacute; đặc biệt gi&uacute;p tăng độ co gi&atilde;n, hỗ trợ thoải m&aacute;i trong vận động như chạy bộ, gym, hay c&aacute;c b&agrave;i tập thể thao.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Thấm h&uacute;t mồ h&ocirc;i:</strong></p>\r\n<ul>\r\n<li>Cotton trong vải nỉ c&oacute; khả năng thấm h&uacute;t mồ h&ocirc;i tốt, mang lại sự kh&ocirc; tho&aacute;ng khi vận động nhiều.</li>\r\n<li>Polyester hỗ trợ nhanh kh&ocirc; v&agrave; chống b&aacute;m bẩn.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Chi tiết bổ sung:</strong></p>\r\n<ul>\r\n<li><strong>Kh&oacute;a k&eacute;o chất lượng cao:</strong> Thường sử dụng kh&oacute;a YKK hoặc tương tự, chống kẹt, vận h&agrave;nh trơn tru.</li>\r\n<li><strong>T&uacute;i tiện &iacute;ch:</strong> C&oacute; t&uacute;i lớn hoặc t&uacute;i kh&oacute;a k&eacute;o để đựng c&aacute;c vật dụng nhỏ an to&agrave;n.</li>\r\n<li>Cổ tay v&agrave; gấu &aacute;o c&oacute; chun co gi&atilde;n để giữ form &aacute;o v&agrave; chống gi&oacute; hiệu quả.</li>\r\n</ul>\r\n</li>\r\n</ul>', 0, 80, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 1, '2024-12-18 12:38:43', '2024-12-19 01:41:26', NULL),
(20, 5, 'Áo Khoác Thể Thao Nữ Siêu Nhẹ Siêu Co Giãn Chống Tia Uv', 'PRD#84418596-ZTGVNRXK-202412181941', 'ao-khoac-the-thao-nu-sieu-nhe-sieu-co-gian-chong-tia-uv', 'products/image_avatar/trang-phuc-truyen-thong/kETUj8hOY2S7zuUIrWlhjORtkS0kIhUAX0kuBglD.webp', 599000, 539000, NULL, '<p><strong>Đặc điểm nổi bật:</strong></p>\r\n<ul>\r\n<li>Thiết kế hiện đại, t&ocirc;n d&aacute;ng, ph&ugrave; hợp cho c&aacute;c hoạt động thể thao ngo&agrave;i trời v&agrave; sử dụng hằng ng&agrave;y.</li>\r\n<li>Si&ecirc;u nhẹ, si&ecirc;u co gi&atilde;n, gi&uacute;p tối ưu h&oacute;a sự thoải m&aacute;i v&agrave; linh hoạt khi vận động.</li>\r\n<li>T&iacute;ch hợp khả năng chống tia UV, bảo vệ l&agrave;n da hiệu quả dưới &aacute;nh nắng mặt trời.<br><br></li>\r\n<li>\r\n<p><strong>C&acirc;n bằng giữa hiệu suất v&agrave; thời trang:</strong></p>\r\n<ul>\r\n<li>Kiểu d&aacute;ng &ocirc;m nhẹ, thời trang v&agrave; dễ d&agrave;ng phối đồ với c&aacute;c trang phục thể thao kh&aacute;c.</li>\r\n<li>M&agrave;u sắc đa dạng, hiện đại, thường tập trung v&agrave;o c&aacute;c gam m&agrave;u trung t&iacute;nh hoặc pastel thanh lịch.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Si&ecirc;u nhẹ:</strong></p>\r\n<ul>\r\n<li>Được l&agrave;m từ chất liệu vải mỏng nhưng chắc chắn, tạo cảm gi&aacute;c nhẹ nh&agrave;ng khi mặc, ph&ugrave; hợp cho vận động cả ng&agrave;y.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Khả năng bảo vệ chống nắng:</strong></p>\r\n<ul>\r\n<li>C&ocirc;ng nghệ xử l&yacute; đặc biệt gi&uacute;p vải chống tia UV <strong>UPF 40+</strong>, bảo vệ l&agrave;n da dưới t&aacute;c hại của &aacute;nh nắng mặt trời.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>T&iacute;nh năng vận động tối ưu:</strong></p>\r\n<ul>\r\n<li>Co gi&atilde;n tốt, kh&ocirc;ng g&acirc;y hạn chế trong c&aacute;c động t&aacute;c chạy bộ, yoga hoặc chơi thể thao ngo&agrave;i trời.</li>\r\n</ul>\r\n</li>\r\n</ul>', '<ul>\r\n<li>\r\n<p><strong>Lớp vải ch&iacute;nh:</strong></p>\r\n<ul>\r\n<li><strong>Polyester pha Spandex cao cấp:</strong>\r\n<ul>\r\n<li><strong>Polyester:</strong> Cung cấp độ bền, giữ d&aacute;ng &aacute;o tốt, c&oacute; khả năng chống nhăn v&agrave; tho&aacute;t ẩm nhanh.</li>\r\n<li><strong>Spandex:</strong> Đem lại độ co gi&atilde;n vượt trội, hỗ trợ sự linh hoạt trong c&aacute;c hoạt động thể chất.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Khả năng chống tia UV:</strong></p>\r\n<ul>\r\n<li>Vải được phủ lớp bảo vệ UV hoặc dệt với cấu tr&uacute;c chống tia cực t&iacute;m tự nhi&ecirc;n, gi&uacute;p giảm t&aacute;c động của &aacute;nh nắng.</li>\r\n<li>Đạt chỉ số <strong>UPF 40+</strong> hoặc cao hơn, tối ưu h&oacute;a khả năng bảo vệ l&agrave;n da nhạy cảm.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Khả năng tho&aacute;t ẩm v&agrave; l&agrave;m m&aacute;t:</strong></p>\r\n<ul>\r\n<li>Cơ chế tho&aacute;t ẩm nhanh giữ cơ thể lu&ocirc;n kh&ocirc; tho&aacute;ng, hạn chế cảm gi&aacute;c ẩm ướt khi đổ mồ h&ocirc;i.</li>\r\n<li>Bề mặt vải mềm mịn v&agrave; m&aacute;t mẻ khi chạm v&agrave;o da, ph&ugrave; hợp cho thời tiết n&oacute;ng bức.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Khả năng chống nhăn v&agrave; giữ form:</strong></p>\r\n<ul>\r\n<li>Chất liệu kh&ocirc;ng dễ nhăn, duy tr&igrave; độ mới d&ugrave; qua nhiều lần sử dụng v&agrave; giặt.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Kh&oacute;a k&eacute;o v&agrave; đường may:</strong></p>\r\n<ul>\r\n<li><strong>Kh&oacute;a k&eacute;o nhẹ v&agrave; bền:</strong> Dễ d&agrave;ng sử dụng, kh&ocirc;ng gỉ, gia tăng độ bền cho sản phẩm.</li>\r\n<li><strong>Đường may phẳng hoặc &eacute;p nhiệt:</strong> Hạn chế cọ x&aacute;t với da, tăng t&iacute;nh thẩm mỹ v&agrave; cảm gi&aacute;c dễ chịu.</li>\r\n</ul>\r\n</li>\r\n</ul>', 0, 40, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 1, '2024-12-18 12:41:30', '2024-12-19 01:42:47', NULL),
(21, 6, 'Áo Polo In Tràn', 'PRD#28258891-FZYOTWIE-202412181944', 'ao-polo-in-tran', 'products/image_avatar/khong-phan-loai/IYjz8rvbBg1n6kMIWYzBF13rHDKaKVdveFbQMgyY.webp', 469000, 422100, NULL, '<p><strong>Đặc điểm nổi bật:</strong></p>\r\n<ul>\r\n<li>Thiết kế <strong>in tr&agrave;n họa tiết độc đ&aacute;o</strong> từ cổ đến gấu &aacute;o, gi&uacute;p bạn nổi bật v&agrave; thể hiện c&aacute; t&iacute;nh ri&ecirc;ng.</li>\r\n<li>Kiểu d&aacute;ng cổ bẻ cổ điển của &aacute;o polo, kết hợp với c&ocirc;ng nghệ in sắc n&eacute;t hiện đại, mang lại vẻ thời trang vừa lịch l&atilde;m vừa năng động.</li>\r\n<li>Ph&ugrave; hợp cho cả nam v&agrave; nữ trong nhiều ho&agrave;n cảnh như đi l&agrave;m, dạo phố, sự kiện, hoặc c&aacute;c hoạt động thể thao nhẹ.<br><br></li>\r\n<li>\r\n<p><strong>Thiết kế:</strong></p>\r\n<ul>\r\n<li><strong>Họa tiết in tr&agrave;n:</strong>\r\n<ul>\r\n<li>C&ocirc;ng nghệ in kỹ thuật số hoặc in chuyển nhiệt to&agrave;n bộ mặt &aacute;o, tạo h&igrave;nh ảnh sắc n&eacute;t v&agrave; m&agrave;u sắc rực rỡ.</li>\r\n<li>C&aacute;c họa tiết thường bao gồm hoa văn, phong cảnh, hoặc thiết kế trừu tượng hiện đại.</li>\r\n</ul>\r\n</li>\r\n<li><strong>Kiểu cổ điển:</strong> Cổ bẻ đặc trưng gi&uacute;p &aacute;o vẫn mang phong c&aacute;ch lịch sự v&agrave; dễ d&agrave;ng phối đồ.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Đa dạng phong c&aacute;ch:</strong></p>\r\n<ul>\r\n<li>Th&iacute;ch hợp cho m&ocirc;i trường b&aacute;n-c&ocirc;ng sở, dạo phố, hoặc khi cần một bộ trang phục vừa thoải m&aacute;i vừa ấn tượng.</li>\r\n<li>Thiết kế unisex, dễ d&agrave;ng vừa vặn với nhiều d&aacute;ng người.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>M&agrave;u sắc bền l&acirc;u:</strong></p>\r\n<ul>\r\n<li>C&ocirc;ng nghệ in chất lượng cao gi&uacute;p m&agrave;u sắc v&agrave; họa tiết kh&ocirc;ng phai qua thời gian, giữ &aacute;o lu&ocirc;n như mới.</li>\r\n</ul>\r\n</li>\r\n</ul>', '<ul>\r\n<li>\r\n<p><strong>Vải ch&iacute;nh:</strong></p>\r\n<ul>\r\n<li><strong>Polyester hoặc Polyester pha Spandex:</strong>\r\n<ul>\r\n<li><strong>Polyester:</strong> Chống nhăn tốt, kh&ocirc;ng co r&uacute;t sau khi giặt v&agrave; c&oacute; bề mặt s&aacute;ng, gi&uacute;p họa tiết in nổi bật hơn.</li>\r\n<li><strong>Spandex (t&ugrave;y chọn):</strong> Tăng độ co gi&atilde;n, tạo cảm gi&aacute;c thoải m&aacute;i, kh&ocirc;ng g&acirc;y g&ograve; b&oacute; khi mặc.</li>\r\n</ul>\r\n</li>\r\n<li>Một số sản phẩm c&oacute; thể pha cotton để tăng khả năng thấm h&uacute;t mồ h&ocirc;i v&agrave; độ mềm mại.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Bề mặt vải:</strong></p>\r\n<ul>\r\n<li>Trơn nhẵn v&agrave; mịn, ph&ugrave; hợp với c&ocirc;ng nghệ in họa tiết phức tạp, đảm bảo họa tiết được t&aacute;i hiện sắc n&eacute;t v&agrave; r&otilde; r&agrave;ng.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>T&iacute;nh năng tho&aacute;ng kh&iacute;:</strong></p>\r\n<ul>\r\n<li>Vải tho&aacute;t ẩm nhanh, giữ cơ thể lu&ocirc;n kh&ocirc; tho&aacute;ng ngay cả trong điều kiện n&oacute;ng bức.</li>\r\n<li>C&oacute; khả năng chống m&ugrave;i nhẹ nhờ c&aacute;c c&ocirc;ng nghệ xử l&yacute; vải ti&ecirc;n tiến.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Độ bền:</strong></p>\r\n<ul>\r\n<li>Chất liệu vải bền bỉ, c&oacute; khả năng chịu được nhiều lần giặt m&agrave; kh&ocirc;ng l&agrave;m phai họa tiết in.</li>\r\n<li>Giữ form d&aacute;ng ổn định, kh&ocirc;ng nh&atilde;o hoặc chảy xệ sau nhiều lần sử dụng.</li>\r\n</ul>\r\n</li>\r\n</ul>', 0, 84, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 1, '2024-12-18 12:44:44', '2024-12-19 01:43:53', NULL),
(22, 6, 'Áo Polo Nam Chân Nẹp Chéo', 'PRD#19488631-M1QVUV7W-202412181948', 'ao-polo-nam-chan-nep-cheo', 'products/image_avatar/khong-phan-loai/xwiFsdWB4QwbS4Uxg0YXP51Puvu2yNDXWDOR9UAc.webp', 399000, 79000, NULL, '<p><strong>Đặc điểm nổi bật:</strong></p>\r\n<ul>\r\n<li>Thiết kế cổ điển của &aacute;o polo được l&agrave;m mới với chi tiết ch&acirc;n nẹp ch&eacute;o độc đ&aacute;o, tạo điểm nhấn nổi bật v&agrave; phong c&aacute;ch lịch l&atilde;m.</li>\r\n<li>Đường cắt tinh tế, vừa vặn cơ thể, t&ocirc;n d&aacute;ng người mặc.</li>\r\n<li>Ph&ugrave; hợp cho nhiều ho&agrave;n cảnh: đi l&agrave;m, họp mặt, dạo phố hoặc tham gia c&aacute;c sự kiện quan trọng.<br><br></li>\r\n<li>\r\n<p><strong>Thiết kế:</strong></p>\r\n<ul>\r\n<li><strong>Ch&acirc;n nẹp ch&eacute;o:</strong>\r\n<ul>\r\n<li>Thiết kế ph&aacute; c&aacute;ch ở phần ch&acirc;n nẹp (nẹp vải ở c&uacute;c &aacute;o), tạo sự kh&aacute;c biệt độc đ&aacute;o so với c&aacute;c kiểu &aacute;o polo truyền thống.</li>\r\n<li>Đường may chắc chắn v&agrave; thẩm mỹ, mang lại cảm gi&aacute;c sang trọng.</li>\r\n</ul>\r\n</li>\r\n<li><strong>Cổ &aacute;o v&agrave; tay &aacute;o:</strong>\r\n<ul>\r\n<li>Cổ bẻ cổ điển phối m&agrave;u hoặc viền tinh tế, tạo cảm gi&aacute;c khỏe khoắn v&agrave; trang nh&atilde;.</li>\r\n<li>Tay &aacute;o được bo nhẹ, gi&uacute;p giữ form m&agrave; kh&ocirc;ng g&acirc;y kh&oacute; chịu.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Kiểu d&aacute;ng:</strong></p>\r\n<ul>\r\n<li>&Ocirc;m nhẹ nhưng kh&ocirc;ng b&oacute; s&aacute;t, đảm bảo thoải m&aacute;i khi vận động.</li>\r\n<li>Độ d&agrave;i ph&ugrave; hợp, vừa đủ để sơ vin hoặc thả ngo&agrave;i quần đều đẹp.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Chi tiết m&agrave;u sắc:</strong></p>\r\n<ul>\r\n<li>Gam m&agrave;u đa dạng, từ t&ocirc;ng trung t&iacute;nh (trắng, đen, xanh navy) đến c&aacute;c t&ocirc;ng nổi bật hơn như đỏ đ&ocirc;, xanh cổ vịt, gi&uacute;p người mặc dễ d&agrave;ng chọn lựa.</li>\r\n</ul>\r\n</li>\r\n</ul>', '<ul>\r\n<li>\r\n<p><strong>Chất liệu ch&iacute;nh:</strong></p>\r\n<ul>\r\n<li><strong>Vải thun c&aacute; sấu cao cấp (Pique Cotton):</strong>\r\n<ul>\r\n<li>Sự kết hợp giữa sợi cotton tự nhi&ecirc;n v&agrave; polyester gi&uacute;p &aacute;o vừa mềm mại, thấm h&uacute;t mồ h&ocirc;i tốt, vừa giữ d&aacute;ng v&agrave; chống nhăn hiệu quả.</li>\r\n<li>Bề mặt vải dệt lỗ nhỏ, tạo sự tho&aacute;ng kh&iacute; v&agrave; mang lại cảm gi&aacute;c m&aacute;t mẻ khi mặc.</li>\r\n<li>Ph&ugrave; hợp với thời tiết cả n&oacute;ng lẫn se lạnh nhờ khả năng c&aacute;ch nhiệt tự nhi&ecirc;n của cotton.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Độ co gi&atilde;n:</strong></p>\r\n<ul>\r\n<li>Thường pha th&ecirc;m Spandex hoặc sợi co gi&atilde;n, tăng độ đ&agrave;n hồi v&agrave; linh hoạt, ph&ugrave; hợp cho c&aacute;c hoạt động h&agrave;ng ng&agrave;y hoặc thể thao nhẹ.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Khả năng bền m&agrave;u:</strong></p>\r\n<ul>\r\n<li>Chất liệu được xử l&yacute; để giữ m&agrave;u sắc l&acirc;u d&agrave;i, chống phai m&agrave;u sau nhiều lần giặt.</li>\r\n<li>Bề mặt vải chống x&ugrave; l&ocirc;ng, giữ &aacute;o lu&ocirc;n mới sau thời gian sử dụng.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Ch&acirc;n nẹp:</strong></p>\r\n<ul>\r\n<li>Sử dụng vải cotton mềm phối với polyester, đường nẹp ch&eacute;o bền chắc, kh&ocirc;ng bị nhăn hoặc gi&atilde;n sau thời gian d&agrave;i sử dụng.</li>\r\n</ul>\r\n</li>\r\n</ul>', 0, 79, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 1, '2024-12-18 12:48:23', '2024-12-19 01:44:38', NULL),
(23, 6, 'Áo Polo Nam In Thân Sau Phối Bo', 'PRD#61958829-D32RMLUS-202412181950', 'ao-polo-nam-in-than-sau-phoi-bo', 'products/image_avatar/khong-phan-loai/7AaPL2msyKF7c1zPtyDGkMP4svFDzAETndYJSNqL.webp', 299000, 79800, NULL, '<p><strong>Đặc điểm nổi bật:</strong></p>\r\n<ul>\r\n<li>Thiết kế độc đ&aacute;o với chi tiết in họa tiết <strong>th&acirc;n sau nổi bật</strong> kết hợp phần <strong>bo viền tinh tế</strong>, tạo n&ecirc;n sự ph&aacute; c&aacute;ch v&agrave; phong c&aacute;ch trẻ trung.</li>\r\n<li>Kiểu d&aacute;ng cổ polo cổ điển được l&agrave;m mới, ph&ugrave; hợp cho nhiều hoạt động như đi l&agrave;m, dạo phố, hay tham gia sự kiện.</li>\r\n<li>Dễ d&agrave;ng kết hợp với quần jeans, chinos, hay quần short để tạo n&ecirc;n nhiều phong c&aacute;ch kh&aacute;c nhau.<br><br></li>\r\n<li>\r\n<p><strong>Thiết kế:</strong></p>\r\n<ul>\r\n<li><strong>Th&acirc;n sau in họa tiết:</strong>\r\n<ul>\r\n<li>Họa tiết được thiết kế độc quyền, tạo điểm nhấn s&aacute;ng tạo ph&iacute;a sau lưng &aacute;o.</li>\r\n<li>Sử dụng c&ocirc;ng nghệ in ti&ecirc;n tiến (in kỹ thuật số hoặc in chuyển nhiệt), đảm bảo h&igrave;nh ảnh sắc n&eacute;t, m&agrave;u sắc tươi s&aacute;ng v&agrave; kh&ocirc;ng bị bong tr&oacute;c qua thời gian.</li>\r\n</ul>\r\n</li>\r\n<li><strong>Phối bo:</strong>\r\n<ul>\r\n<li>Cổ &aacute;o v&agrave; tay &aacute;o được phối bo dệt ribbed tạo sự chắc chắn, giữ form v&agrave; mang lại vẻ gọn g&agrave;ng.</li>\r\n<li>Thường phối m&agrave;u tương phản nhẹ với th&acirc;n &aacute;o để tăng th&ecirc;m sự nổi bật v&agrave; hiện đại.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Kiểu d&aacute;ng:</strong></p>\r\n<ul>\r\n<li>Form &aacute;o slim-fit hoặc regular-fit, &ocirc;m nhẹ nhưng vẫn thoải m&aacute;i khi vận động.</li>\r\n<li>Độ d&agrave;i vừa phải, ph&ugrave; hợp để mặc thả hoặc sơ vin t&ugrave;y phong c&aacute;ch.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>M&agrave;u sắc:</strong></p>\r\n<ul>\r\n<li>Kết hợp giữa gam m&agrave;u th&acirc;n &aacute;o trung t&iacute;nh hoặc cơ bản (đen, trắng, x&aacute;m, xanh navy) với họa tiết nổi bật ở lưng, tạo n&ecirc;n sự h&agrave;i h&ograve;a v&agrave; c&aacute; t&iacute;nh.</li>\r\n</ul>\r\n</li>\r\n</ul>', '<ul>\r\n<li>\r\n<p><strong>Chất liệu ch&iacute;nh:</strong></p>\r\n<ul>\r\n<li><strong>Vải thun c&aacute; sấu cao cấp (Pique Cotton):</strong>\r\n<ul>\r\n<li>Th&agrave;nh phần ch&iacute;nh từ sợi cotton tự nhi&ecirc;n: mềm mại, tho&aacute;ng kh&iacute; v&agrave; thấm h&uacute;t mồ h&ocirc;i hiệu quả, ph&ugrave; hợp mặc trong nhiều điều kiện thời tiết.</li>\r\n<li>Pha th&ecirc;m polyester để tăng độ bền, khả năng chống nhăn v&agrave; giữ form sau nhiều lần sử dụng.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Khả năng co gi&atilde;n:</strong></p>\r\n<ul>\r\n<li>T&iacute;ch hợp Spandex trong th&agrave;nh phần vải, gi&uacute;p &aacute;o co gi&atilde;n tốt, hỗ trợ cử động linh hoạt v&agrave; kh&ocirc;ng g&acirc;y b&oacute; chặt.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Độ bền:</strong></p>\r\n<ul>\r\n<li>Chất liệu được xử l&yacute; c&ocirc;ng nghệ chống co r&uacute;t v&agrave; x&ugrave; l&ocirc;ng, giữ &aacute;o bền đẹp qua nhiều lần giặt.</li>\r\n<li>Phần in họa tiết được phủ lớp bảo vệ chống phai m&agrave;u, gi&uacute;p họa tiết bền bỉ theo thời gian.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Cổ &aacute;o v&agrave; tay &aacute;o:</strong></p>\r\n<ul>\r\n<li>Bo dệt từ cotton pha poly co gi&atilde;n, gi&uacute;p phần cổ v&agrave; tay &aacute;o giữ d&aacute;ng tốt nhưng kh&ocirc;ng g&acirc;y kh&oacute; chịu khi mặc.</li>\r\n<li>Đường may tinh tế, chắc chắn, tr&aacute;nh bong hoặc bai d&atilde;o sau thời gian sử dụng.</li>\r\n</ul>\r\n</li>\r\n</ul>', 0, 40, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 1, '2024-12-18 12:50:12', '2024-12-19 01:45:25', NULL);
INSERT INTO `products` (`id`, `sub_category_id`, `name`, `sku`, `slug`, `image_avatar`, `price_regular`, `price_sale`, `discount_percent`, `description`, `material`, `views`, `quantity`, `start_date`, `end_date`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(24, 6, 'Áo Polo Nữ Chân Nẹp Chéo', 'PRD#90188315-HOV2JSEQ-202412181952', 'ao-polo-nu-chan-nep-cheo', 'products/image_avatar/khong-phan-loai/yXXi1YhfJMLv3M4PgXsfaYEcCOsp7JyLc1RwTe48.webp', 269000, 80700, NULL, '<p><strong>Đặc điểm nổi bật:</strong></p>\r\n<ul>\r\n<li>&Aacute;o Polo nữ với thiết kế <strong>ch&acirc;n nẹp ch&eacute;o độc đ&aacute;o</strong>, mang đến sự tinh tế v&agrave; điểm nhấn kh&aacute;c biệt so với c&aacute;c kiểu &aacute;o polo truyền thống.</li>\r\n<li>Ph&ugrave; hợp với nhiều ho&agrave;n cảnh: đi l&agrave;m, dạo phố, chơi thể thao, hay tham dự sự kiện năng động.</li>\r\n<li>Kết hợp giữa t&iacute;nh năng linh hoạt của &aacute;o polo v&agrave; sự duy&ecirc;n d&aacute;ng, nữ t&iacute;nh nhờ chi tiết cắt may kh&eacute;o l&eacute;o.<br><br></li>\r\n<li>\r\n<p><strong>Thiết kế:</strong></p>\r\n<ul>\r\n<li><strong>Ch&acirc;n nẹp ch&eacute;o:</strong>\r\n<ul>\r\n<li>Phần nẹp ch&eacute;o may tinh tế, kết hợp đường cắt ph&aacute; c&aacute;ch gi&uacute;p l&agrave;m mới kiểu d&aacute;ng polo truyền thống.</li>\r\n<li>L&agrave; điểm nhấn nổi bật, gi&uacute;p tăng t&iacute;nh thời trang v&agrave; thu h&uacute;t.</li>\r\n</ul>\r\n</li>\r\n<li><strong>Cổ &aacute;o v&agrave; tay &aacute;o:</strong>\r\n<ul>\r\n<li>Cổ bẻ ti&ecirc;u chuẩn phối m&agrave;u hoặc th&ecirc;m viền nhẹ, tạo n&eacute;t thanh lịch.</li>\r\n<li>Tay &aacute;o d&aacute;ng bo nhẹ &ocirc;m s&aacute;t, l&agrave;m tăng sự gọn g&agrave;ng, trang nh&atilde;.</li>\r\n</ul>\r\n</li>\r\n<li><strong>Form d&aacute;ng:</strong>\r\n<ul>\r\n<li>Thiết kế slim-fit, vừa vặn với d&aacute;ng người, gi&uacute;p t&ocirc;n v&oacute;c d&aacute;ng nữ giới.</li>\r\n<li>Ph&ugrave; hợp với mọi hoạt động m&agrave; vẫn đảm bảo thoải m&aacute;i khi mặc.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Chi tiết m&agrave;u sắc:</strong></p>\r\n<ul>\r\n<li>Gam m&agrave;u đa dạng, từ t&ocirc;ng pastel nhẹ nh&agrave;ng (trắng, hồng nhạt, xanh mint) đến c&aacute;c m&agrave;u đậm c&aacute; t&iacute;nh (đen, đỏ, xanh navy).</li>\r\n</ul>\r\n</li>\r\n</ul>', '<p>&nbsp;</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>\r\n<p><strong>Chất liệu vải ch&iacute;nh:</strong></p>\r\n<ul>\r\n<li><strong>Vải thun c&aacute; sấu cao cấp (Pique Cotton):</strong>\r\n<ul>\r\n<li>Cotton tự nhi&ecirc;n mềm mại, tho&aacute;ng kh&iacute;, thấm h&uacute;t mồ h&ocirc;i tốt.</li>\r\n<li>Pha th&ecirc;m polyester gi&uacute;p &aacute;o giữ form l&acirc;u d&agrave;i, chống nhăn v&agrave; dễ bảo quản.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Đặc t&iacute;nh:</strong></p>\r\n<ul>\r\n<li><strong>Co gi&atilde;n nhẹ:</strong> Pha Spandex tạo sự co gi&atilde;n linh hoạt, gi&uacute;p &aacute;o &ocirc;m nhẹ cơ thể m&agrave; kh&ocirc;ng g&acirc;y kh&oacute; chịu.</li>\r\n<li><strong>Tho&aacute;ng kh&iacute;:</strong> Duy tr&igrave; cảm gi&aacute;c m&aacute;t mẻ ngay cả trong m&ocirc;i trường nắng n&oacute;ng hoặc vận động ngo&agrave;i trời.</li>\r\n<li><strong>Khả năng giữ d&aacute;ng:</strong> C&ocirc;ng nghệ xử l&yacute; vải ti&ecirc;n tiến gi&uacute;p &aacute;o kh&ocirc;ng bị bai nh&atilde;o hay chảy xệ sau thời gian sử dụng.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Bo viền:</strong></p>\r\n<ul>\r\n<li>Phần bo cổ v&agrave; tay &aacute;o được l&agrave;m từ cotton pha poly co gi&atilde;n, tạo sự chắc chắn m&agrave; vẫn mềm mại, kh&ocirc;ng g&acirc;y cấn hoặc ngứa khi mặc.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Ch&acirc;n nẹp ch&eacute;o:</strong></p>\r\n<ul>\r\n<li>Phần nẹp may từ c&ugrave;ng chất liệu với &aacute;o hoặc c&oacute; phối hợp vải contrast, đảm bảo độ bền v&agrave; tinh tế trong từng đường may.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>', 0, 35, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 1, '2024-12-18 12:52:37', '2024-12-19 01:46:33', NULL),
(25, 11, 'Áo Sơ Mi Kẻ Cổ Đức Dài Tay Slim Cotton 3181', 'PRD#18403192-ZXIZSDIZ-202412181954', 'ao-so-mi-ke-co-uc-dai-tay-slim-cotton-3181', 'products/image_avatar/khong-phan-loai/Cre7qqzeEZd0eVuui5AkWpIDitzwnkYqfqMFDwpn.jpg', 299000, NULL, NULL, '<ul>\r\n<li>\r\n<p><strong>Thiết kế</strong>: &Aacute;o sơ mi kẻ cổ đức, d&agrave;i tay với phong c&aacute;ch slim fit, tạo vẻ ngo&agrave;i lịch l&atilde;m v&agrave; trẻ trung. Đường kẻ tinh tế v&agrave; tỉ mỉ, gi&uacute;p &aacute;o trở n&ecirc;n nổi bật v&agrave; thời trang.</p>\r\n</li>\r\n<li>\r\n<p><strong>Đường may</strong>: &Aacute;o được may chắc chắn với c&aacute;c đường may tỉ mỉ, kh&ocirc;ng bị bung r&aacute;ch sau thời gian sử dụng d&agrave;i.</p>\r\n</li>\r\n<li>\r\n<p><strong>Cổ &aacute;o</strong>: Thiết kế cổ đức truyền thống, mang lại vẻ chuy&ecirc;n nghiệp nhưng vẫn thoải m&aacute;i.</p>\r\n</li>\r\n<li>\r\n<p><strong>Khuy &aacute;o</strong>: Khuy &aacute;o chắc chắn, dễ sử dụng, gi&uacute;p &aacute;o lu&ocirc;n v&agrave;o form chuẩn khi mặc.</p>\r\n<h3>M&agrave;u sắc:</h3>\r\n<ul>\r\n<li>\r\n<p>Đa dạng m&agrave;u sắc như kẻ xanh, kẻ đen, kẻ trắng, kẻ đỏ,&hellip; dễ d&agrave;ng phối hợp với nhiều loại trang phục kh&aacute;c nhau.</p>\r\n</li>\r\n</ul>\r\n<h3>T&iacute;nh năng đặc biệt:</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Thấm h&uacute;t mồ h&ocirc;i tốt</strong>: Chất liệu cotton c&oacute; khả năng thấm h&uacute;t mồ h&ocirc;i vượt trội, ph&ugrave; hợp cho mọi hoạt động h&agrave;ng ng&agrave;y.</p>\r\n</li>\r\n<li>\r\n<p><strong>Độ bền cao</strong>: Chất liệu bền bỉ, c&oacute; thể sử dụng trong thời gian d&agrave;i m&agrave; kh&ocirc;ng lo lắng về việc phai m&agrave;u hay hỏng h&oacute;c.</p>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>', '<ul>\r\n<li>\r\n<p><strong>Chất liệu ch&iacute;nh</strong>: 100% cotton cao cấp, mang lại cảm gi&aacute;c tho&aacute;ng m&aacute;t v&agrave; mềm mại khi tiếp x&uacute;c với da. Cotton l&agrave; chất liệu thấm h&uacute;t mồ h&ocirc;i tốt, gi&uacute;p bạn lu&ocirc;n cảm thấy kh&ocirc; tho&aacute;ng.</p>\r\n</li>\r\n<li>\r\n<p><strong>Độ co gi&atilde;n</strong>: Chất liệu cotton c&oacute; độ co gi&atilde;n tự nhi&ecirc;n, kh&ocirc;ng g&ograve; b&oacute;, dễ d&agrave;ng vận động.</p>\r\n</li>\r\n<li>\r\n<p><strong>Khả năng giữ form</strong>: Chất liệu d&agrave;y dặn gi&uacute;p &aacute;o giữ form tốt sau nhiều lần giặt. Đặc biệt, &aacute;o &iacute;t nhăn v&agrave; dễ l&agrave; ủi.</p>\r\n</li>\r\n<li>\r\n<p><strong>Th&acirc;n thiện với da</strong>: Cotton l&agrave; chất liệu th&acirc;n thiện với da, kh&ocirc;ng g&acirc;y k&iacute;ch ứng, an to&agrave;n cho người mặc, ngay cả với những người c&oacute; l&agrave;n da nhạy cảm.</p>\r\n</li>\r\n</ul>', 0, 60, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 1, '2024-12-18 12:54:28', '2024-12-19 01:48:38', NULL),
(26, 7, 'Quần Âu Nữ Suông Kèm Đai Lệch Cá Tính', 'PRD#26125678-CMZSD5BM-202412181955', 'quan-au-nu-suong-kem-ai-lech-ca-tinh', 'products/image_avatar/khong-phan-loai/c7dMuzKrvLY57WFjRlMDr6h1JmyYs1wTrYMni1oJ.webp', 399000, 269000, NULL, '<p data-sourcepos=\"1:1-1:206\">Tuyệt vời! Quần &Acirc;u Nữ Su&ocirc;ng K&egrave;m Đai Lệch C&aacute; T&iacute;nh l&agrave; một item đang rất được y&ecirc;u th&iacute;ch hiện nay. Để gi&uacute;p bạn hiểu r&otilde; hơn về sản phẩm n&agrave;y, m&igrave;nh sẽ cung cấp một m&ocirc; tả chi tiết, kết hợp cả h&igrave;nh ảnh minh họa nh&eacute;.</p>\r\n<p data-sourcepos=\"3:1-3:19\"><strong>M&ocirc; tả sản phẩm:</strong></p>\r\n<p data-sourcepos=\"5:1-5:318\">Quần &Acirc;u Nữ Su&ocirc;ng K&egrave;m Đai Lệch C&aacute; T&iacute;nh l&agrave; sự kết hợp ho&agrave;n hảo giữa phong c&aacute;ch thanh lịch v&agrave; hiện đại. Với thiết kế ống rộng thoải m&aacute;i, quần gi&uacute;p che đi khuyết điểm ở đ&ocirc;i ch&acirc;n v&agrave; tạo cảm gi&aacute;c năng động, trẻ trung. Điểm nhấn của sản phẩm ch&iacute;nh l&agrave; chiếc đai lệch độc đ&aacute;o, mang đến vẻ ngo&agrave;i c&aacute; t&iacute;nh v&agrave; thu h&uacute;t mọi &aacute;nh nh&igrave;n.</p>\r\n<ul data-sourcepos=\"7:1-11:0\">\r\n<li data-sourcepos=\"7:1-7:93\"><strong>Ống rộng:</strong> Tạo sự thoải m&aacute;i tối đa khi vận động, đồng thời gi&uacute;p ch&acirc;n tr&ocirc;ng thon gọn hơn.</li>\r\n<li data-sourcepos=\"8:1-8:72\"><strong>Đai lệch:</strong> Chi tiết độc đ&aacute;o, tạo điểm nhấn cho tổng thể trang phục.</li>\r\n<li data-sourcepos=\"9:1-9:133\"><strong>Chất liệu:</strong> Thường được l&agrave;m từ c&aacute;c chất liệu cao cấp như vải tu&yacute;t si, kaki,... mang đến cảm gi&aacute;c mềm mại, tho&aacute;ng m&aacute;t v&agrave; bền đẹp.</li>\r\n<li data-sourcepos=\"10:1-11:0\"><strong>Phong c&aacute;ch:</strong> Linh hoạt, c&oacute; thể kết hợp với nhiều kiểu &aacute;o kh&aacute;c nhau để tạo n&ecirc;n nhiều phong c&aacute;ch kh&aacute;c nhau, từ c&ocirc;ng sở đến dạo phố.</li>\r\n</ul>', '<p data-sourcepos=\"14:1-14:97\">Chất liệu của quần &Acirc;u Nữ Su&ocirc;ng K&egrave;m Đai Lệch C&aacute; T&iacute;nh thường được sử dụng l&agrave; vải tu&yacute;t si hoặc kaki.</p>\r\n<ul data-sourcepos=\"16:1-18:0\">\r\n<li data-sourcepos=\"16:1-16:98\"><strong>Vải tu&yacute;t si:</strong> Loại vải c&oacute; độ cứng vừa phải, tạo form d&aacute;ng quần đứng d&aacute;ng, bền m&agrave;u v&agrave; &iacute;t nhăn.</li>\r\n<li data-sourcepos=\"17:1-18:0\"><strong>Vải kaki:</strong> Mềm mại, tho&aacute;ng m&aacute;t, c&oacute; độ bền cao v&agrave; &iacute;t bị bai d&atilde;o.</li>\r\n</ul>', 0, 20, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 1, '2024-12-18 12:55:49', '2024-12-19 01:49:58', NULL),
(27, 12, 'Quần Jean Nam Slim Fit Wash Vintage', 'PRD#1737919-0ATQ6YXE-202412181958', 'quan-jean-nam-slim-fit-wash-vintage', 'products/image_avatar/khong-phan-loai/f7LYktKXxaf7KgIXdslOtysjMD8tIriPZQVKBXEC.webp', 399000, 269000, NULL, '<strong class=\"text-warning\">Hiện chưa cập nhật mô tả cụ thể cho sản phẩm!</strong>', '<strong class=\"text-warning\">Hiện chưa cập nhật chất liệu cho sản phẩm!</strong>', 0, 0, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 1, '2024-12-18 12:58:23', '2024-12-18 12:58:23', NULL),
(28, 8, 'Quần Nỉ Thể Thao Nam Can Thân Phối Khoá', 'PRD#59896870-UKHEJVM1-202412182003', 'quan-ni-the-thao-nam-can-than-phoi-khoa', 'products/image_avatar/khong-phan-loai/RZAzpeoSu1EjOOQv2FCrUbOQ2mAoVGYtlra57mii.webp', 399000, 389000, NULL, '<strong class=\"text-warning\">Hiện chưa cập nhật mô tả cụ thể cho sản phẩm!</strong>', '<strong class=\"text-warning\">Hiện chưa cập nhật chất liệu cho sản phẩm!</strong>', 0, 0, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 1, '2024-12-18 13:03:04', '2024-12-18 13:03:04', NULL),
(29, 13, 'Quần Short Nam Kaki Nam Túi Hộp', 'PRD#29363234-AH9TZDAL-202412182005', 'quan-short-nam-kaki-nam-tui-hop', 'products/image_avatar/khong-phan-loai/66MQ3dhaRkuOC1bGBkRKJ0vZMAZPqdp1CGpndN2L.webp', 599000, NULL, NULL, '<strong class=\"text-warning\">Hiện chưa cập nhật mô tả cụ thể cho sản phẩm!</strong>', '<strong class=\"text-warning\">Hiện chưa cập nhật chất liệu cho sản phẩm!</strong>', 0, 0, NULL, NULL, 1, '2024-12-18 13:05:24', '2024-12-18 13:05:24', NULL),
(30, 14, 'Áo nỉ nữ basic cổ tròn', 'PRD#54523659-JXQSEYII-202412190045', 'ao-ni-nu-basic-co-tron', 'products/image_avatar/khong-phan-loai/52Wt7GBGbsfV7rL9vLBODTlnOgKEzzDmZTZFV62S.png', 249000, 79000, 63, '<div class=\"item active\" data-v-fb55b90e=\"\">\r\n<div class=\"item-content\" data-v-fb55b90e=\"\">&Aacute;o nỉ d&agrave;i tay d&aacute;ng regular, thiết kế đơn giản, mặc thoải m&aacute;i v&agrave; dễ kết hợp với nhiều loại trang phục.</div>\r\n<div class=\"item-content\" data-v-fb55b90e=\"\">&nbsp;</div>\r\n</div>\r\n<div class=\"item active\" data-v-fb55b90e=\"\">\r\n<div class=\"item-title\" data-v-fb55b90e=\"\"><strong>Hướng dẫn sử dụng</strong></div>\r\n<div class=\"item-content\" data-v-fb55b90e=\"\">Giặt m&aacute;y ở chế độ nhẹ, nhiệt độ thường.<br>Kh&ocirc;ng sử dụng h&oacute;a chất tẩy c&oacute; chứa Clo.<br>Phơi trong b&oacute;ng m&aacute;t.Kh&ocirc;ng sử dụng m&aacute;y sấy.<br>L&agrave; ở nhiệt độ thấp 110 độ C.<br>Giặt ri&ecirc;ng quần &aacute;o tối m&agrave;u. Kh&ocirc;ng ng&acirc;m. Sản phẩm dễ tạo xơ v&oacute;n, loại bỏ bằng k&eacute;o hoặc m&aacute;y cạo xơ.</div>\r\n</div>', '<p>Chất liệu 100% polyester.</p>', 0, 0, '2024-12-18 00:00:00', '2024-12-30 00:00:00', 1, '2024-12-18 17:45:44', '2024-12-18 17:45:44', NULL),
(31, 13, 'Quần Short Thể Thao Nam', 'PRD#34264959-3EFWZZZI-202412190055', 'quan-short-the-thao-nam', 'products/image_avatar/khong-phan-loai/jpCK3tZPRgfypLQtK3cpGUyhkVzc8XfMmFTvjlzC.jpg', 329000, 129000, NULL, '<p><strong>Quần short nam</strong>&nbsp;<strong>5S Sport</strong>&nbsp;l&agrave; sản phẩm&nbsp;<a href=\"https://5sfashion.vn/danh-muc/quan-short-the-thao-nam\"><strong>quần short thể thao nam</strong></a>&nbsp;nằm trong&nbsp;<strong>BST True Sport</strong>&nbsp;của&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S Fashion</strong></a>. Quần c&oacute; hai m&agrave;u Đen v&agrave; T&iacute;m than - tone m&agrave;u tối giản dễ mặc, dễ phối đồ. Thiết kế basic - item kh&ocirc;ng thể thiếu trong tủ đồ của nam giới.</p>\r\n<p>- Quần được may với phom d&aacute;ng&nbsp;<strong>Regular Fit</strong>&nbsp;- thoải m&aacute;i nhưng vẫn đảm bảo sự gọn g&agrave;ng khi vận động v&agrave; t&ocirc;n d&aacute;ng người mặc</p>\r\n<p>- Cạp chun chắc chắn co gi&atilde;n d&acirc;y r&uacute;t mặt trong kh&ocirc;ng lộ, dễ d&agrave;ng điều chỉnh cho bạn cảm gi&aacute;c dễ chịu v&agrave; thoải m&aacute;i nhất</p>\r\n<p>- T&uacute;i hai b&ecirc;n c&oacute; kh&oacute;a k&eacute;o s&acirc;u rộng tiện lợi c&oacute; l&oacute;t lưới tho&aacute;ng kh&iacute;, t&uacute;i hậu may bo viền tinh tế</p>\r\n<p>- In sọc &eacute;p nhiệt cao cấp, bền bỉ nổi bật, bắt mắt</p>\r\n<p>- Đường may đều, tỉ mỉ, kh&ocirc;ng chỉ thừa.</p>\r\n<p>Tổng thể thiết kế dễ mặc mang lại cho ph&aacute;i mạnh vẻ ngo&agrave;i mạnh mẽ, thể thao v&agrave; khỏe khoắn, bạn c&oacute; thể mặc ở nh&agrave;, đi chơi, đi dạo v&agrave; đặc biệt ph&ugrave; hợp cho c&aacute;c hoạt động vận động thể thao.</p>\r\n<ul>\r\n<li><strong>Chất liệu thể thao cao cấp:&nbsp;</strong></li>\r\n</ul>\r\n<p><strong>100% Polyester</strong>: chất liệu tổng hợp cao cấp ứng dụng c&ocirc;ng nghệ l&agrave;m m&aacute;t, c&aacute;c sợi vải được chuốt mảnh với&nbsp;cấu tr&uacute;c dệt lưới tạo r&atilde;nh tho&aacute;ng kh&iacute; gi&uacute;p nhiệt v&agrave; độ ẩm lưu th&ocirc;ng nhanh ch&oacute;ng, khuếch t&aacute;n ra b&ecirc;n ngo&agrave;i. Nhờ đ&oacute; người mặc sẽ lu&ocirc;n c&oacute; cảm gi&aacute;c m&aacute;t lạnh khi chạm v&agrave;o, cảm nhận được sự tho&aacute;ng m&aacute;t, kh&ocirc;ng bết d&iacute;nh v&agrave; cực k&igrave; nhẹ nh&agrave;ng, &ecirc;m &aacute;i.</p>\r\n<ul>\r\n<li><strong>M&agrave;u sắc</strong>&nbsp;: Đen, T&iacute;m than</li>\r\n<li><strong>Size</strong>: S, M, L, XL, 2XL, 3XL</li>\r\n<li><strong>C&aacute;ch sử dụng</strong>:</li>\r\n</ul>\r\n<p>- N&ecirc;n giặt tay/giặt m&aacute;y với nhiệt độ kh&ocirc;ng qu&aacute; 30 độ ở chu k&igrave; trung b&igrave;nh v&agrave; v&ograve;ng quay ngắn</p>\r\n<p>- Sử dụng bột giặt/nước giặt trung t&iacute;nh</p>\r\n<p>- Phơi sản phẩm ở nơi kh&ocirc; r&aacute;o tho&aacute;ng m&aacute;t v&agrave; tr&aacute;nh &aacute;nh nắng trực tiếp</p>\r\n<ul>\r\n<li><strong>C&aacute;ch bảo quản:</strong></li>\r\n</ul>\r\n<p>- N&ecirc;n lộn tr&aacute;i khi phơi</p>\r\n<p>- Bảo quản nơi kh&ocirc; r&aacute;o, tr&aacute;nh những nơi ẩm thấp</p>\r\n<p>- L&agrave; (ủi) ở nhiệt độ trung b&igrave;nh</p>\r\n<p><strong>Sắm ngay tại</strong>&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S FASHION</strong></a>.</p>', '<div class=\"col-6 item-feature\">\r\n<div class=\"label\">PHOM REGULAR FIT</div>\r\n<div class=\"desc\">Thoải m&aacute;i vận động, t&ocirc;n d&aacute;ng người mặc</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">CHẤT LIỆU POLY C&Ocirc;NG NGHỆ</div>\r\n<div class=\"desc\">Mềm mịn, nhẹ m&aacute;t, tho&aacute;ng kh&iacute;</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">C&Ocirc;NG NGHỆ QUICK-DRY</div>\r\n<div class=\"desc\">Tho&aacute;t ẩm tốt, nhanh kh&ocirc;</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">THIẾT KẾ CẠP CHUN</div>\r\n<div class=\"desc\">Co gi&atilde;n dễ d&agrave;ng điều chỉnh</div>\r\n</div>', 0, 0, NULL, NULL, 1, '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(32, 15, 'Váy liền nữ cotton USA cổ polo dài tay', 'PRD#99427827-CCPVH1MC-202412190059', 'vay-lien-nu-cotton-usa-co-polo-dai-tay', 'products/image_avatar/khong-phan-loai/WPmd6kbZ6GNZB0Myqvano97T3E96MoxGHZDh7EaI.png', 699000, 211000, 61, '<p>V&aacute;y dệt kim polo nữ d&agrave;i tay, d&aacute;ng &ocirc;m vừa, thoải m&aacute;i, ph&ugrave; hợp với thời tiết giao m&ugrave;a, ho&agrave;n cảnh sử dụng linh hoạt.<br>Chất liệu cotton pha, đ&agrave;n hồi, tạo cảm gi&aacute;c thoải m&aacute;i ấm &aacute;p cho người mặc.</p>\r\n<div class=\"item-title\" data-v-fb55b90e=\"\"><strong>Hướng dẫn sử dụng</strong></div>\r\n<div class=\"item-content\" data-v-fb55b90e=\"\">Giặt m&aacute;y ở chế độ nhẹ, nhiệt độ thường.<br>Kh&ocirc;ng sử dụng h&oacute;a chất tẩy c&oacute; chứa Clo.<br>Phơi trong b&oacute;ng m&aacute;t.<br>Sấy kh&ocirc; ở nhiệt độ thấp.<br>L&agrave; ở nhiệt độ thấp 110 độ C.<br>Giặt với sản phẩm c&ugrave;ng m&agrave;u.<br>Kh&ocirc;ng l&agrave; l&ecirc;n chi tiết trang tr&iacute;.</div>', '<div class=\"item active\" data-v-fb55b90e=\"\">\r\n<div class=\"item-content\" data-v-fb55b90e=\"\">73% cotton 23% polyester 4% spandex</div>\r\n</div>\r\n<div class=\"item\" data-v-fb55b90e=\"\">&nbsp;</div>', 0, 0, '2024-12-19 00:00:00', '2024-12-31 00:00:00', 1, '2024-12-18 17:59:20', '2024-12-18 17:59:20', NULL),
(33, 16, 'Áo Thun Nam Lót Trong 5S Fashion Chất Cotton Phom Slimfit ATL24056', 'PRD#25573276-PFOJ2PCG-202412190300', 'ao-thun-nam-lot-trong-5s-fashion-chat-cotton-phom-slimfit-atl24056', 'products/image_avatar/khong-phan-loai/jbMSbD340YTxb9hHbDPC7iH4BmTYJfoq0YVboBFx.jpg', 129000, 79000, 39, '<p><a href=\"https://5sfashion.vn/san-pham/ao-thun-nam-lot-trong-5s-fashion-chat-cotton-phom-slimfit-atl24056\"><strong>&Aacute;o Thun Nam L&oacute;t Trong 5S Fashion Trơn Basic ATL24056</strong></a>&nbsp;l&agrave; sản phẩm mới trong BST Xu&acirc;n h&egrave; mới nhất của&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S Fashion</strong></a>. Đ&acirc;y l&agrave; item basic mặc l&oacute;t trong tiện dụng, đặc biệt ph&ugrave; hợp cho ng&agrave;y h&egrave; n&oacute;ng bức</p>\r\n<ul>\r\n<li><strong>Thiết kế</strong><strong>:</strong></li>\r\n</ul>\r\n<p>-&nbsp;<strong><a href=\"https://5sfashion.vn/danh-muc/ao-thun-nam\">&Aacute;o thun nam</a>&nbsp;</strong>ATL24056&nbsp;c&oacute; form&nbsp;<strong>Slimfit</strong>&nbsp;vừa vặn, t&ocirc;n d&aacute;ng nhưng vẫn đảm bảo độ thoải m&aacute;i khi chuyển động</p>\r\n<p>- Thiết kế trơn basic với m&agrave;u trắng cơ bản</p>\r\n<p>- Cổ tr&ograve;n bo cổ nhỏ co gi&atilde;n</p>\r\n<p>- Trọng lượng nhẹ, mềm mỏng ph&ugrave; hợp mặc l&oacute;t trong</p>\r\n<p>- Đường may chắc chắn, tỉ mỉ, kh&ocirc;ng chỉ thừa</p>\r\n<p>&Aacute;o thun l&oacute;t ATL24056 l&agrave; d&ograve;ng sản phẩm th&iacute;ch hợp để mặc l&oacute;t trong bởi đồ mềm mỏng mịn tinh tế. &Aacute;o thường được sử dụng để mặc ở nh&agrave;, hoặc mặc trong c&aacute;c loại &aacute;o sơ mi gi&uacute;p thấm h&uacute;t mồ h&ocirc;i tốt tạo cảm gi&aacute;c thoải m&aacute;i, m&aacute;t mẻ khi mặc.</p>\r\n<ul>\r\n<li><strong>Chất liệu:</strong></li>\r\n</ul>\r\n<p>-<strong>&nbsp;100% Cotton tự nhi&ecirc;n</strong>: Bề mặt vải mềm mịn, c&oacute; độ thấm h&uacute;t cực tốt, co gi&atilde;n, an to&agrave;n th&acirc;n thiện với da</p>\r\n<ul>\r\n<li><strong>M&agrave;u sắc:&nbsp;</strong>Trắng</li>\r\n<li><strong>Size</strong>: S, M, L, XL, 2XL, 3XL</li>\r\n<li><strong>C&aacute;ch sử dụng:</strong></li>\r\n</ul>\r\n<p>- N&ecirc;n giặt tay/giặt m&aacute;y với nhiệt độ kh&ocirc;ng qu&aacute; 30 độ ở chu k&igrave; trung b&igrave;nh v&agrave; v&ograve;ng quay ngắn</p>\r\n<p>- Sử dụng bột giặt/nước giặt trung t&iacute;nh</p>\r\n<p>- Phơi sản phẩm ở nơi kh&ocirc; r&aacute;o tho&aacute;ng m&aacute;t v&agrave; tr&aacute;nh &aacute;nh nắng trực tiếp</p>\r\n<ul>\r\n<li><strong>C&aacute;ch bảo quản:</strong></li>\r\n</ul>\r\n<p>- N&ecirc;n lộn tr&aacute;i khi phơi</p>\r\n<p>- Bảo quản nơi kh&ocirc; r&aacute;o, tr&aacute;nh những nơi ẩm thấp</p>\r\n<p>- L&agrave; (ủi) ở nhiệt độ trung b&igrave;nh</p>\r\n<p><strong>Sắm ngay tại&nbsp;</strong><a href=\"https://5sfashion.vn/\"><strong>5S FASHION</strong></a>.</p>\r\n<p><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/Df7Y7BhgkXpa4kKJeM9K4J4QAbCirJCe.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/pAlis0CpiOWNNOnm2jkqQUbXqXOOIRlj.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/uNVSnWYrIGvKQVlN3qqbdoT88z2DEGHE.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/M63DDSEQukysVDFHSm6BYgMQxTBOeXBU.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/4IyhYkp01tCGctT5YIMqsV1CkKb0blkt.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/NRjb3akNKE5hjHbyJgwwfQky2KbVfRRj.webp\" alt=\"\"><img class=\"entered loading\" src=\"https://5sfashion.vn/storage/editor/WLCovb7aW3JLopbn63DAqaydo31GqWFL.webp\" alt=\"\" data-ll-status=\"loading\"></p>', '<div class=\"col-6 item-feature\">\r\n<div class=\"label\">\r\n<h2 class=\"title\">Đặc điểm nổi bật</h2>\r\n<div class=\"row list-feature\">\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">PHOM SLIMFIT</div>\r\n<div class=\"desc\">Vừa vặn, gọn g&agrave;ng</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">CHẤT LIỆU 100% COTTON</div>\r\n<div class=\"desc\">Mềm mịn, th&acirc;n thiện với da</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">THẤM H&Uacute;T VƯỢT TRỘI</div>\r\n<div class=\"desc\">Ưu điểm của vải cotton</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">CO GI&Atilde;N ĐA CHIỀU</div>\r\n<div class=\"desc\">Tự do thoải m&aacute;i vận động</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', 0, 0, '2024-12-19 00:00:00', '2025-02-01 00:00:00', 1, '2024-12-18 20:00:30', '2024-12-18 20:02:42', NULL),
(34, 16, 'Áo Thun Nam Ngắn Tay Họa Tiết Phom Casual Fit ATS24006', 'PRD#11047119-JVSZEL44-202412190313', 'ao-thun-nam-ngan-tay-hoa-tiet-phom-casual-fit-ats24006', 'products/image_avatar/khong-phan-loai/HSa0fLs3fZ7Hc1ByAKANCpoz7W0BCaMFULdIlQaT.jpg', 249000, 149000, 40, '<p><a href=\"https://5sfashion.vn/san-pham/ao-thun-nam-ngan-tay-hoa-tiet-phom-casual-fit-ats24006\"><strong>&Aacute;o thun nam tay ngắn họa tiết phom Casual Fit ATS24006</strong></a></p>\r\n<p><a href=\"https://5sfashion.vn/danh-muc/ao-thun-nam\"><strong>&Aacute;o thun nam</strong></a>&nbsp;ATS24006 họa tiết l&agrave; sản phẩm &aacute;o thun nằm trong&nbsp;<strong>BST True Summer</strong>&nbsp;<strong>2024&nbsp;</strong>của&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S Fashion</strong></a>. &Aacute;o gồm 4 m&agrave;u cơ bản, dễ mặc dễ phối đồ lấy chủ đề m&ugrave;a H&egrave; tươi m&aacute;t với thiết kế h&ograve;a hợp với thi&ecirc;n nhi&ecirc;n nổi bật, lịch l&atilde;m v&agrave; phong c&aacute;ch.</p>\r\n<p>- &Aacute;o thun ATS24006 được may với phom d&aacute;ng&nbsp;<strong>Casual Fit</strong>&nbsp;sự kết hợp ho&agrave;n hảo của Slimfit v&agrave; Regular vừa t&ocirc;n d&aacute;ng vừa thoải m&aacute;i mang phong th&aacute;i ph&oacute;ng kho&aacute;ng, tiện lợi, linh hoạt</p>\r\n<p>- Thiết kế nổi bật trẻ trung với phần họa tiết in tr&agrave;n tượng h&igrave;nh- c&ocirc;ng nghệ dệt họa tiết trực tiếp tr&ecirc;n bề mặt vải gi&uacute;p họa tiết bền m&agrave;u hơn v&agrave; kh&ocirc;ng bong tr&oacute;c.</p>\r\n<p>- Cổ &aacute;o tr&ograve;n bọc d&acirc;y dệt hai lớp d&agrave;y dặn, giữ phom, co gi&atilde;n thoải m&aacute;i.</p>\r\n<p>- Đường may đều, tỉ mỉ, kh&ocirc;ng chỉ thừa.</p>\r\n<p>- Tay &aacute;o tho&aacute;ng m&aacute;t, rộng r&atilde;i dễ d&agrave;ng trong mọi chuyển động.&nbsp;</p>\r\n<ul>\r\n<li><strong>Chất liệu&nbsp;cao cấp&nbsp;gi&uacute;p người mặc lu&ocirc;n cảm nhận được sự thoải m&aacute;i khi mặc:&nbsp;</strong></li>\r\n</ul>\r\n<p>-<strong>&nbsp;95% Cotton tự nhi&ecirc;n:&nbsp;</strong>Th&agrave;nh phần chủ yếu của &aacute;o - sợi c&oacute; cấu tr&uacute;c nhỏ d&agrave;i, dai bền hơn gi&uacute;p thấm h&uacute;t mồ h&ocirc;i cực tốt, tho&aacute;ng kh&iacute; tạo cảm gi&aacute;c m&aacute;t mẻ, kh&ocirc;ng bết d&iacute;nh khi mặc.</p>\r\n<p>-&nbsp;<strong>5% Spandex</strong>: co gi&atilde;n dễ chịu, ngo&agrave;i ra sợi c&ograve;n c&oacute; t&iacute;nh chất đ&agrave;n hồi trở về trạng th&aacute;i ban đầu ngay khi bị t&aacute;c động k&eacute;o gi&atilde;n gi&uacute;p hạn chế bai gi&atilde;o hiệu quả.</p>\r\n<ul>\r\n<li><strong>M&agrave;u sắc</strong>&nbsp;: Trắng, Đen, Xanh x&aacute;m, Ghi đậm</li>\r\n<li><strong>Size</strong>: S, M, L, XL, 2XL, 3XL</li>\r\n<li><strong>C&aacute;ch sử dụng</strong>:</li>\r\n</ul>\r\n<p>- N&ecirc;n giặt tay/giặt m&aacute;y với nhiệt độ kh&ocirc;ng qu&aacute; 30 độ ở chu k&igrave; trung b&igrave;nh v&agrave; v&ograve;ng quay ngắn</p>\r\n<p>- Sử dụng bột giặt/nước giặt trung t&iacute;nh</p>\r\n<p>- Phơi sản phẩm ở nơi kh&ocirc; r&aacute;o tho&aacute;ng m&aacute;t v&agrave; tr&aacute;nh &aacute;nh nắng trực tiếp</p>\r\n<ul>\r\n<li><strong>C&aacute;ch bảo quản:</strong></li>\r\n</ul>\r\n<p>- N&ecirc;n lộn tr&aacute;i khi phơi</p>\r\n<p>- Bảo quản nơi kh&ocirc; r&aacute;o, tr&aacute;nh những nơi ẩm thấp</p>\r\n<p>- L&agrave; (ủi) ở nhiệt độ trung b&igrave;nh</p>\r\n<p><strong>Sắm ngay tại</strong>&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S FASHION</strong></a>.</p>\r\n<p><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/WfeEI5srWuz6nh6CzT4M4b22Ud90eTNh.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/TyZ67ZdztoShlDmYVIbE973cNjxxFg85.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/JLsNhW3reX9mIZO25uT82GGeI5rorgSm.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/B0JNlmrpQwg4JOqNIkVeRDTs6ImFIvg8.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/P4JUuxrLhy0iVcLJ9FZq0oqrgQNh2qKA.webp\" alt=\"\"><img class=\"entered loading\" src=\"https://5sfashion.vn/storage/editor/MKQTVpZwOoqYdUWjAYIAnl9jtknmoFRe.webp\" alt=\"\" data-ll-status=\"loading\"><img class=\"entered loading\" src=\"https://5sfashion.vn/storage/editor/RVtBP7LbA2xzr3MjokokZciK0mdPlEdS.webp\" alt=\"\" data-ll-status=\"loading\"></p>', '<div class=\"col-6 item-feature\">\r\n<div class=\"label\">PHOM CASUAL FIT</div>\r\n<div class=\"desc\">Thoải m&aacute;i, t&ocirc;n d&aacute;ng, linh hoạt</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">THẤM H&Uacute;T VƯỢT TRỘI</div>\r\n<div class=\"desc\">Ưu điểm của sợi Cotton tự nhi&ecirc;n</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">THIẾT KẾ IN TR&Agrave;N</div>\r\n<div class=\"desc\">Nổi bật, thu h&uacute;t, trẻ trung</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">CO GI&Atilde;N ĐA CHIỀU</div>\r\n<div class=\"desc\">Tự do thoải m&aacute;i vận động</div>\r\n</div>', 0, 0, '2024-12-19 00:00:00', '2025-03-01 00:00:00', 1, '2024-12-18 20:13:41', '2024-12-18 20:13:41', NULL),
(35, 16, 'Áo Thun Nam Ngắn Tay In Chữ Phối Hình In Phom Casual ATS24027', 'PRD#37756683-BF1AUNRZ-202412190317', 'ao-thun-nam-ngan-tay-in-chu-phoi-hinh-in-phom-casual-ats24027', 'products/image_avatar/khong-phan-loai/zcAEiUSReozvvLNsawwGTlnRgSN8WIxXIvrbnj4r.jpg', 229000, 137000, 40, '<p><a href=\"https://5sfashion.vn/san-pham/ao-thun-nam-ngan-tay-in-chu-phoi-hinh-in-phom-casual-ats24027\"><strong>&Aacute;o thun nam tay ngắn họa tiết phom Casual Fit ATS24027</strong></a></p>\r\n<p><a href=\"https://5sfashion.vn/danh-muc/ao-thun-nam\"><strong>&Aacute;o thun nam</strong></a>&nbsp;ATS24027 in chữ phối h&igrave;nh in l&agrave; sản phẩm &aacute;o thun nằm trong&nbsp;<strong>BST True Summer</strong>&nbsp;<strong>2024&nbsp;</strong>của&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S Fashion</strong></a>. &Aacute;o gồm 3 m&agrave;u cơ bản, dễ mặc dễ phối đồ lấy chủ đề m&ugrave;a H&egrave; tươi m&aacute;t với thiết kế đơn giản nhưng nổi bật v&agrave; phong c&aacute;ch.</p>\r\n<p>- &Aacute;o thun ATS24027 được may với phom d&aacute;ng&nbsp;<strong>Casual Fit</strong>&nbsp;- sự cải tiến phom th&ocirc;ng minh vừa t&ocirc;n d&aacute;ng vừa thoải m&aacute;i mang phong th&aacute;i ph&oacute;ng kho&aacute;ng, tiện lợi, linh hoạt</p>\r\n<p>- Thiết kế nổi bật trẻ trung với phần chữ VACATIONS in lớn phối h&igrave;nh in trước ngực bền bỉ, ph&ugrave; hợp mặc đi du lịch, đi chơi, cafe,...</p>\r\n<p>- Cổ &aacute;o tr&ograve;n bọc d&acirc;y dệt hai lớp d&agrave;y dặn, giữ phom, co gi&atilde;n thoải m&aacute;i.</p>\r\n<p>- Đường may đều, tỉ mỉ, kh&ocirc;ng chỉ thừa.</p>\r\n<p>- Tay &aacute;o tho&aacute;ng m&aacute;t, rộng r&atilde;i dễ d&agrave;ng trong mọi chuyển động.&nbsp;</p>\r\n<ul>\r\n<li><strong>Chất liệu&nbsp;cao cấp&nbsp;gi&uacute;p người mặc lu&ocirc;n cảm nhận được sự thoải m&aacute;i khi mặc:&nbsp;</strong></li>\r\n</ul>\r\n<p>-<strong>&nbsp;95% Cotton tự nhi&ecirc;n:&nbsp;</strong>Th&agrave;nh phần chủ yếu của &aacute;o - sợi c&oacute; cấu tr&uacute;c nhỏ d&agrave;i, dai bền hơn gi&uacute;p thấm h&uacute;t mồ h&ocirc;i cực tốt, tho&aacute;ng kh&iacute; tạo cảm gi&aacute;c m&aacute;t mẻ, kh&ocirc;ng bết d&iacute;nh khi mặc.</p>\r\n<p>-&nbsp;<strong>5% Spandex</strong>: co gi&atilde;n dễ chịu, ngo&agrave;i ra sợi c&ograve;n c&oacute; t&iacute;nh chất đ&agrave;n hồi trở về trạng th&aacute;i ban đầu ngay khi bị t&aacute;c động k&eacute;o gi&atilde;n gi&uacute;p hạn chế bai gi&atilde;o hiệu quả.</p>\r\n<ul>\r\n<li><strong>M&agrave;u sắc</strong>&nbsp;: Trắng, Đen, Xanh ngọc lam</li>\r\n<li><strong>Size</strong>: S, M, L, XL, 2XL, 3XL</li>\r\n<li><strong>C&aacute;ch sử dụng</strong>:</li>\r\n</ul>\r\n<p>- N&ecirc;n giặt tay/giặt m&aacute;y với nhiệt độ kh&ocirc;ng qu&aacute; 30 độ ở chu k&igrave; trung b&igrave;nh v&agrave; v&ograve;ng quay ngắn</p>\r\n<p>- Sử dụng bột giặt/nước giặt trung t&iacute;nh</p>\r\n<p>- Phơi sản phẩm ở nơi kh&ocirc; r&aacute;o tho&aacute;ng m&aacute;t v&agrave; tr&aacute;nh &aacute;nh nắng trực tiếp</p>\r\n<ul>\r\n<li><strong>C&aacute;ch bảo quản:</strong></li>\r\n</ul>\r\n<p>- N&ecirc;n lộn tr&aacute;i khi phơi</p>\r\n<p>- Bảo quản nơi kh&ocirc; r&aacute;o, tr&aacute;nh những nơi ẩm thấp</p>\r\n<p>- L&agrave; (ủi) ở nhiệt độ trung b&igrave;nh</p>\r\n<p><strong>Sắm ngay tại</strong>&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S FASHION</strong></a>.</p>\r\n<p><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/8CsPlSHC9xthEXCc3WYbUM523CPX822S.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/jxt0oNdrHYvHrul9mzlv5k8WmjYpjOAy.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/Nett8zp9Uvd8LcdvYtdKmNvI4cfJ3rEq.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/GoFpvGOhD5DGupYbrQC0ngJAWqSkeftL.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/aFYLsayRww2FzOnbAYz1aGOBXmBStqae.webp\" alt=\"\"><img class=\"entered loading\" src=\"https://5sfashion.vn/storage/editor/2vhdwPckPrqjB36N4DohXJF1uUFCBG1W.webp\" alt=\"\" data-ll-status=\"loading\"><img class=\"entered loading\" src=\"https://5sfashion.vn/storage/editor/0R2MXAWFs1xlqyvzuK697g7jSwulrZre.webp\" alt=\"\" data-ll-status=\"loading\"></p>', '<div class=\"col-6 item-feature\">\r\n<div class=\"label\">PHOM CASUAL FIT</div>\r\n<div class=\"desc\">Thoải m&aacute;i, t&ocirc;n d&aacute;ng, linh hoạt</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">THẤM H&Uacute;T VƯỢT TRỘI</div>\r\n<div class=\"desc\">Ưu điểm của sợi Cotton tự nhi&ecirc;n</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">THIẾT KẾ H&Igrave;NH IN PHỐI CHỮ</div>\r\n<div class=\"desc\">Nổi bật, trẻ trung, phong c&aacute;ch</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">CO GI&Atilde;N ĐA CHIỀU</div>\r\n<div class=\"desc\">Tự do thoải m&aacute;i vận động</div>\r\n</div>', 0, 0, NULL, NULL, 1, '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(36, 16, 'Áo Thun Nam 5S Fashion Cotton Basic Phom Regular ATS24034', 'PRD#62598442-7WOV6WCQ-202412190321', 'ao-thun-nam-5s-fashion-cotton-basic-phom-regular-ats24034', 'products/image_avatar/khong-phan-loai/VaxGOKnjo0KpHURqi0bAewQHy8E7KLJwmgLAfmv2.jpg', 209000, 125000, 40, '<div class=\"col-6 item-feature\">\r\n<div class=\"label\">\r\n<p><a href=\"https://5sfashion.vn/san-pham/ao-thun-nam-5s-fashion-cotton-basic-phom-regular-ats24034\"><strong>&Aacute;o Thun Nam Ngắn Tay 5S Fashion Basic In Chữ Đơn Giản Regular ATS24034</strong></a></p>\r\n<p>&Aacute;o Thun Nam Ngắn Tay 5S Fashion ATS24034 l&agrave; chiếc&nbsp;<strong><a href=\"https://5sfashion.vn/danh-muc/ao-thun-nam\">&aacute;o thun nam</a></strong>&nbsp;basic in chữ nhỏ nằm trong BST True Man - True Summer của&nbsp;<strong><a href=\"https://5sfashion.vn/\">5S Fashion</a>.&nbsp;</strong>Sản phẩm được lấy cảm hứng từ những tone m&agrave;u của m&ugrave;a H&egrave;, ho&agrave; hợp với thi&ecirc;n nhi&ecirc;n với 5 m&agrave;u đa dạng, trẻ trung, dễ mặc.</p>\r\n<ul>\r\n<li><strong>Form d&aacute;ng</strong>:&nbsp;<strong>Regular</strong>&nbsp;gi&uacute;p che khuyết điểm hiệu quả, thoải m&aacute;i cho mọi vận động.</li>\r\n<li><strong>Thiết kế</strong>:&nbsp;</li>\r\n</ul>\r\n<p>-<strong>&nbsp;</strong>Thiết kế tối giản với họa tiết chữ in nhỏ ngang ngực mang tới phong c&aacute;ch trẻ trung, khỏe khoắn với khả năng ứng dụng cao, ph&ugrave; hợp với mọi ho&agrave;n cảnh như mặc thường ng&agrave;y, chơi thể thao...</p>\r\n<p>- Dễ d&agrave;ng kết hợp với c&aacute;c trang phục như diện trong &aacute;o sơ mi, &aacute;o kho&aacute;c leo n&uacute;i... hay mặc trơn để đi chơi, đi cafe, dạo phố...</p>\r\n<p>-&nbsp;Thiết kế cổ tr&ograve;n c&ugrave;ng bảng m&agrave;u đa dạng với bảng m&agrave;u trẻ trung, nam t&iacute;nh dễ d&agrave;ng phối kết hợp với nhiều trang phục.</p>\r\n<p>- Đường may sắc n&eacute;t, tinh tế</p>\r\n<p>- Cổ &aacute;o bo dệt d&agrave;y dặn, giữ phom, kh&ocirc;ng bai gi&atilde;o</p>\r\n<p>- Tay &aacute;o thoải m&aacute;i, dễ dạng vận động, tho&aacute;ng m&aacute;t.</p>\r\n<ul>\r\n<li><strong>Chất liệu:</strong></li>\r\n</ul>\r\n<p><strong>- 95% Cotton</strong>: Bề mặt mềm mại, tho&aacute;ng kh&iacute;, thấm h&uacute;t mồ h&ocirc;i tốt v&agrave; đặc biệt th&acirc;n thiệt với l&agrave;n da người mặc.</p>\r\n<p><strong>- 5% Spandex</strong>: Tăng độ đ&agrave;n hồi, co gi&atilde;n nhẹ gi&uacute;p dễ d&agrave;ng vận động.</p>\r\n<ul>\r\n<li><strong>M&agrave;u sắc</strong>: Ghi, Đen, T&iacute;m than đậm, Xanh cổ vịt, Xanh đ&aacute;</li>\r\n<li><strong>Size</strong>: S,M,L,XL,2XL,3XL</li>\r\n<li><strong>C&aacute;ch sử dụng</strong>:</li>\r\n</ul>\r\n<p>Kh&ocirc;ng n&ecirc;n ng&acirc;m qu&aacute; l&acirc;u trong lần đầu giặt.&nbsp;</p>\r\n<p>Sử dụng bột giặt/nước giặt trung t&iacute;nh</p>\r\n<p>Phơi sản phẩm ở nơi kh&ocirc; r&aacute;o tho&aacute;ng m&aacute;t v&agrave; tr&aacute;nh &aacute;nh nắng trực tiếp</p>\r\n<ul>\r\n<li><strong>C&aacute;ch bảo quản:</strong></li>\r\n</ul>\r\n<p>N&ecirc;n lộn tr&aacute;i khi phơi</p>\r\n<p>Bảo quản nơi tho&aacute;ng m&aacute;t, kh&ocirc; r&aacute;o</p>\r\n<p>L&agrave; (ủi) ở nhiệt độ trung b&igrave;nh</p>\r\n<p><strong>Sắm ngay tại</strong>&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S FASHION</strong></a>.</p>\r\n<p><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/L2SMfeJodKd8jLUKwqiKDucHxhUAfEuo.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/4fgFyIULIdBxjbuNHeNCkQt3M6bEsCG6.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/9eWRlqSxC46qi8dLfXEssTeiApyYjeH4.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/jlQXN9pbP9UI8Nm2Z1JkAU7X5FAQFftu.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/hFj9jobjew5kIenUGqtB2nLZGNZyNm0q.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/dGk8SnrQwKJnsDmu4fzebwotFIgHauzD.webp\" alt=\"\"><img class=\"entered loading\" src=\"https://5sfashion.vn/storage/editor/vdVzQ9l4QyTzceG6NOJekqJGvdTOBvk3.webp\" alt=\"\" data-ll-status=\"loading\"><img class=\"entered loading\" src=\"https://5sfashion.vn/storage/editor/4dBbysREzNzGLCDbcWUC52AkUtc3WQTK.webp\" alt=\"\" data-ll-status=\"loading\"></p>\r\n</div>\r\n</div>', '<div class=\"col-6 item-feature\">\r\n<div class=\"label\">PHOM D&Aacute;NG REGULAR</div>\r\n<div class=\"desc\">Thoải m&aacute;i, che khuyết điểm, linh hoạt</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">THẤM H&Uacute;T MỒ H&Ocirc;I VƯỢT TRỘI</div>\r\n<div class=\"desc\">Gi&uacute;p cơ thể kh&ocirc; tho&aacute;ng, dễ chịu</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">THO&Aacute;NG M&Aacute;T, &Ecirc;M &Aacute;I</div>\r\n<div class=\"desc\">Ưu điểm của sợi Cotton tự nhi&ecirc;n</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">THIẾT KẾ BASIC</div>\r\n<div class=\"desc\">Dễ mặc, dễ phối, trẻ trung</div>\r\n</div>', 0, 0, '2024-12-19 00:00:00', '2025-02-08 00:00:00', 1, '2024-12-18 20:21:49', '2024-12-18 20:21:49', NULL),
(37, 16, 'Áo Thun Nam 5S Fashion Siêu Nhẹ Mát In Chữ Phom Slimfit ATS24061', 'PRD#31338822-XX6HYLR8-202412190324', 'ao-thun-nam-5s-fashion-sieu-nhe-mat-in-chu-phom-slimfit-ats24061', 'products/image_avatar/khong-phan-loai/MN3fYeyqTThqNeq18Q3Iid4JIpGjOY9AGxWU6QNs.jpg', 279000, 167000, 40, '<p><a href=\"https://5sfashion.vn/san-pham/ao-thun-nam-5s-fashion-sieu-nhe-mat-in-chu-phom-slimfit-ats24061\"><strong>&Aacute;o thun nam tay ngắn in chữ phom Slimfit ATS24061</strong></a></p>\r\n<p><a href=\"https://5sfashion.vn/danh-muc/ao-thun-nam\"><strong>&Aacute;o thun nam</strong></a>&nbsp;<strong>ATS24061</strong>&nbsp;l&agrave; sản phẩm &aacute;o thun nằm trong&nbsp;<strong>BST True Sport</strong>&nbsp;<strong>2024</strong>&nbsp;của&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S Fashion</strong></a>. &Aacute;o gồm 3 m&agrave;u sắc tone lạnh, lấy cảm hứng từ m&ugrave;a H&egrave; tươi m&aacute;t mang lại cảm gi&aacute;c dễ chịu cho người mặc đồng thời cũng dễ d&agrave;ng phối đồ mặc được nhiều dịp đi dạo, đi du lịch, cafe, đặc biệt th&iacute;ch hợp cho c&aacute;c hoạt động thể thao...</p>\r\n<p>- &Aacute;o được may với phom d&aacute;ng&nbsp;<strong>Slimfit</strong>&nbsp;&ocirc;m vừa vặn, gọn g&agrave;ng, t&ocirc;n d&aacute;ng nhưng vẫn đảm bảo sự thoải m&aacute;i khi vận động.</p>\r\n<p>- Bề mặt dệt hiệu ứng đục lỗ tạo s&oacute;ng ngang bắt mắt, tho&aacute;ng kh&iacute;</p>\r\n<p>- Thiết kế nổi bật với phần chữ cao cấp trước ngực mang lại vẻ ngo&agrave;i trẻ trung, phong c&aacute;ch v&agrave; khỏe khoắn</p>\r\n<p>- Cổ &aacute;o tr&ograve;n bo hai lớp giữ phom, co gi&atilde;n thoải m&aacute;i.</p>\r\n<p>- Đường may đều, tỉ mỉ, kh&ocirc;ng chỉ thừa.</p>\r\n<p>- Tay &aacute;o tho&aacute;ng m&aacute;t, rộng r&atilde;i dễ d&agrave;ng trong mọi chuyển động.&nbsp;</p>\r\n<ul>\r\n<li><strong>Chất liệu&nbsp;cao cấp&nbsp;gi&uacute;p người mặc lu&ocirc;n cảm nhận được sự thoải m&aacute;i khi mặc:&nbsp;</strong></li>\r\n</ul>\r\n<p>-<strong>&nbsp;93% Nylon l&agrave;m m&aacute;t</strong>: được l&agrave;m từ chất liệu Nylon cao cấp ứng dụng c&ocirc;ng nghệ l&agrave;m m&aacute;t sợi, c&aacute;c sợi vải được chuốt mảnh kết hợp sử dụng&nbsp;kiểu dệt&nbsp;<strong>Mesh</strong>&nbsp;với cấu tr&uacute;c dệt lưới tạo r&atilde;nh tho&aacute;ng kh&iacute; gi&uacute;p nhiệt v&agrave; độ ẩm lưu th&ocirc;ng nhanh ch&oacute;ng, khuếch t&aacute;n ra b&ecirc;n ngo&agrave;i. Nhờ đ&oacute; người mặc sẽ lu&ocirc;n c&oacute; cảm gi&aacute;c m&aacute;t lạnh khi chạm v&agrave;o, cảm nhận được sự tho&aacute;ng m&aacute;t, kh&ocirc;ng bết d&iacute;nh v&agrave; cực k&igrave; nhẹ nh&agrave;ng, &ecirc;m &aacute;i.</p>\r\n<p>-&nbsp;<strong>7% Spandex</strong>: co gi&atilde;n dễ chịu, ngo&agrave;i ra sợi c&ograve;n c&oacute; t&iacute;nh chất đ&agrave;n hồi trở về trạng th&aacute;i ban đầu ngay khi bị t&aacute;c động k&eacute;o gi&atilde;n gi&uacute;p hạn chế bai gi&atilde;o hiệu quả.</p>\r\n<ul>\r\n<li><strong>M&agrave;u sắc</strong>&nbsp;: Đen, Trắng, Xanh da trời nhạt</li>\r\n<li><strong>Size</strong>: S, M, L, XL, 2XL, 3XL</li>\r\n<li><strong>C&aacute;ch sử dụng</strong>:</li>\r\n</ul>\r\n<p>- N&ecirc;n giặt tay/giặt m&aacute;y với nhiệt độ kh&ocirc;ng qu&aacute; 30 độ ở chu k&igrave; trung b&igrave;nh v&agrave; v&ograve;ng quay ngắn</p>\r\n<p>- Sử dụng bột giặt/nước giặt trung t&iacute;nh</p>\r\n<p>- Phơi sản phẩm ở nơi kh&ocirc; r&aacute;o tho&aacute;ng m&aacute;t v&agrave; tr&aacute;nh &aacute;nh nắng trực tiếp</p>\r\n<ul>\r\n<li><strong>C&aacute;ch bảo quản:</strong></li>\r\n</ul>\r\n<p>- N&ecirc;n lộn tr&aacute;i khi phơi</p>\r\n<p>- Bảo quản nơi kh&ocirc; r&aacute;o, tr&aacute;nh những nơi ẩm thấp</p>\r\n<p>- L&agrave; (ủi) ở nhiệt độ trung b&igrave;nh</p>\r\n<p><strong>Sắm ngay tại</strong>&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S FASHION</strong></a>.</p>\r\n<p><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/VmdXVFdpg8vAdZNNrUkmEr3AV1B1Z17W.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/nZ31nblgKQ56kTHtlXX0axyKNI0A6BGX.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/OpaMCxy4ec5xhjRNGztxsvjul8UeLShO.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/7dNGKZm6u61wRBmyk7ZK3haTpSEj6NOh.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/RsBQVJfZy4sm75xJiLFjvbegSJKONq2D.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/KGJhim79jTiA9XQmIkI8V2lH7MS7nyqZ.webp\" alt=\"\"><img class=\"entered loading\" src=\"https://5sfashion.vn/storage/editor/3NpYtNkpFMLn2NSAdxlXA9C5MgTljNpT.webp\" alt=\"\" data-ll-status=\"loading\"><img class=\"entered loading\" src=\"https://5sfashion.vn/storage/editor/NcJp835fPJLGqvXQIQvydePRGwHM4XXw.webp\" alt=\"\" data-ll-status=\"loading\"></p>', '<div class=\"col-6 item-feature\">\r\n<div class=\"label\">FORM SLIM FIT</div>\r\n<div class=\"desc\">&Ocirc;m vừa vặn, t&ocirc;n đ&aacute;ng</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">SỢI NYLON C&Ocirc;NG NGHỆ</div>\r\n<div class=\"desc\">Thấm h&uacute;t tức th&igrave;, kh&ocirc;ng bết d&iacute;nh</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">CO GI&Atilde;N ĐA CHIỀU</div>\r\n<div class=\"desc\">Tự do thoải m&aacute;i vận động</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">IN &Eacute;P NHIỆT</div>\r\n<div class=\"desc\">Nổi bật, cao cấp, bền bỉ</div>\r\n</div>', 0, 0, '2024-12-19 00:00:00', '2025-02-08 00:00:00', 1, '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(38, 16, 'Áo Thun Nam 5S Fashion Chất Liệu Thể Thao Phom Slimfit ATS24039', 'PRD#66412628-AJOKLDW5-202412190329', 'ao-thun-nam-5s-fashion-chat-lieu-the-thao-phom-slimfit-ats24039', 'products/image_avatar/khong-phan-loai/ZVenO1jKmyonDtABg9ZOOCP6kKZK8ot9FWdPGifF.jpg', 239000, 143000, 40, '<p><a href=\"https://5sfashion.vn/san-pham/ao-thun-nam-5s-fashion-chat-lieu-the-thao-phom-slimfit-ats24039\"><strong>&Aacute;o thun nam thể thao tay ngắn phom Slimfit ATS24039</strong></a></p>\r\n<p><a href=\"https://5sfashion.vn/danh-muc/ao-thun-nam\"><strong>&Aacute;o thun nam</strong></a>&nbsp;<strong>ATS24039</strong>&nbsp;l&agrave; sản phẩm &aacute;o thun nằm trong&nbsp;<strong>BST True Sport</strong>&nbsp;<strong>2024</strong>&nbsp;của&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S Fashion</strong></a>. &Aacute;o gồm 4 m&agrave;u sắc tone lạnh, lấy cảm hứng từ m&ugrave;a H&egrave; tươi m&aacute;t mang lại cảm gi&aacute;c dễ chịu cho người mặc đồng thời cũng dễ d&agrave;ng phối đồ mặc được nhiều dịp đi dạo, đi du lịch, cafe, đặc biệt th&iacute;ch hợp cho c&aacute;c hoạt động thể thao...</p>\r\n<p>- &Aacute;o được may với phom d&aacute;ng&nbsp;<strong>Slimfit</strong>&nbsp;&ocirc;m vừa vặn, gọn g&agrave;ng, t&ocirc;n d&aacute;ng nhưng vẫn đảm bảo sự thoải m&aacute;i khi vận động.</p>\r\n<p>- Bề mặt dệt hiệu ứng bắt mắt, tho&aacute;ng kh&iacute;</p>\r\n<p>- Thiết kế nổi bật với phần in &eacute;p nhiệt hai b&ecirc;n cầu vai mang lại vẻ ngo&agrave;i trẻ trung, phong c&aacute;ch v&agrave; khỏe khoắn</p>\r\n<p>- Cổ &aacute;o tr&ograve;n bo hai lớp giữ phom, co gi&atilde;n thoải m&aacute;i.</p>\r\n<p>- Đường may đều, tỉ mỉ, kh&ocirc;ng chỉ thừa.</p>\r\n<p>- Tay &aacute;o tho&aacute;ng m&aacute;t, rộng r&atilde;i dễ d&agrave;ng trong mọi chuyển động.&nbsp;</p>\r\n<ul>\r\n<li><strong>Chất liệu&nbsp;cao cấp&nbsp;gi&uacute;p người mặc lu&ocirc;n cảm nhận được sự thoải m&aacute;i khi mặc:&nbsp;</strong></li>\r\n</ul>\r\n<p>-&nbsp;<strong>49.1% Polyester c&ocirc;ng nghệ</strong>: Sợi tổng hợp cao cấp, kh&aacute;c với sợi Poly th&ocirc;ng thường kh&aacute;c bởi c&ocirc;ng nghệ l&agrave;m m&aacute;t v&agrave; kiểu dệt Mesh với cấu tr&uacute;c dạng lưới, tạo c&aacute;c r&atilde;nh tr&ecirc;n bề mặt vải, gi&uacute;p khuếch t&aacute;n nhiệt nhanh ch&oacute;ng, kh&ocirc; nhanh, m&aacute;t hơn, tho&aacute;ng kh&iacute; hơn.</p>\r\n<p>-<strong>&nbsp;36.2% Nylon</strong>:&nbsp;Mang lại c&aacute;c t&iacute;nh năng tuyệt vời như độ bền cao, l&ecirc;n m&agrave;u sắc n&eacute;t, trọng lượng cực nhẹ, hạn chế nhăn nh&agrave;u hiệu quả, chống co r&uacute;t.</p>\r\n<p>-&nbsp;<strong>14.7% Spandex</strong>: co gi&atilde;n dễ chịu, ngo&agrave;i ra sợi c&ograve;n c&oacute; t&iacute;nh chất đ&agrave;n hồi trở về trạng th&aacute;i ban đầu ngay khi bị t&aacute;c động k&eacute;o gi&atilde;n gi&uacute;p hạn chế bai gi&atilde;o hiệu quả.</p>\r\n<ul>\r\n<li><strong>M&agrave;u sắc</strong>&nbsp;: Đen, Trắng, T&iacute;m than, Xanh x&aacute;m nhạt</li>\r\n<li><strong>Size</strong>: S, M, L, XL, 2XL, 3XL</li>\r\n<li><strong>C&aacute;ch sử dụng</strong>:</li>\r\n</ul>\r\n<p>- N&ecirc;n giặt tay/giặt m&aacute;y với nhiệt độ kh&ocirc;ng qu&aacute; 30 độ ở chu k&igrave; trung b&igrave;nh v&agrave; v&ograve;ng quay ngắn</p>\r\n<p>- Sử dụng bột giặt/nước giặt trung t&iacute;nh</p>\r\n<p>- Phơi sản phẩm ở nơi kh&ocirc; r&aacute;o tho&aacute;ng m&aacute;t v&agrave; tr&aacute;nh &aacute;nh nắng trực tiếp</p>\r\n<ul>\r\n<li><strong>C&aacute;ch bảo quản:</strong></li>\r\n</ul>\r\n<p>- N&ecirc;n lộn tr&aacute;i khi phơi</p>\r\n<p>- Bảo quản nơi kh&ocirc; r&aacute;o, tr&aacute;nh những nơi ẩm thấp</p>\r\n<p>- L&agrave; (ủi) ở nhiệt độ trung b&igrave;nh</p>\r\n<p><strong>Sắm ngay tại</strong>&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S FASHION</strong></a>.</p>\r\n<p><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/a0XwO8SDz8tdmkd2yCS4f8Pgb2EooXJD.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/Gw13Uv3kmecaRG0MlWE9XT9o4K3ERHJw.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/NSKLjbjUXoaFYjpFCQXRdYMYz4Cv8jnz.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/IY6NjtYxOnv5CwUxGyQFjsvroNh2uoWc.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/2oRS3lhcD7riZu6POY808qXtV144QDSW.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/2zWHqymuW6naC8YeoZAcE2eXsQ0eV3vc.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/bNhzaYzo7GS7XGeOIIysfJcZNaEIqiBY.webp\" alt=\"\"><img class=\"entered loading\" src=\"https://5sfashion.vn/storage/editor/Nx5GZVx3K469nW5TMcnUZyCUehgDCa01.webp\" alt=\"\" data-ll-status=\"loading\"></p>', '<h2 class=\"title\">Đặc điểm nổi bật</h2>\r\n<div class=\"row list-feature\">\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">PHOM D&Aacute;NG SLIMIT</div>\r\n<div class=\"desc\">Vừa vặn, gọn g&agrave;ng, t&ocirc;n d&aacute;ng</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">SI&Ecirc;U NHẸ, &Ecirc;M &Aacute;I</div>\r\n<div class=\"desc\">Trọng lượng &aacute;o cực nhẹ, mềm mịn, m&aacute;t lạnh dễ chịu</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">KH&Ocirc; NHANH, THO&Aacute;NG KH&Iacute;</div>\r\n<div class=\"desc\">Vải c&ocirc;ng nghệ với kiểu dệt Mesh cao cấp</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">IN &Eacute;P NHIỆT CAO CẤP</div>\r\n<div class=\"desc\">Nổi bật, khỏe khoắn, trẻ trung</div>\r\n</div>\r\n</div>', 0, 0, '2024-12-19 00:00:00', '2025-02-22 00:00:00', 1, '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL);
INSERT INTO `products` (`id`, `sub_category_id`, `name`, `sku`, `slug`, `image_avatar`, `price_regular`, `price_sale`, `discount_percent`, `description`, `material`, `views`, `quantity`, `start_date`, `end_date`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(39, 16, 'Áo Thun Nam Ngắn Tay 5S Fashion In Basic Casual ATS24003', 'PRD#71580675-Y9NS44TT-202412190335', 'ao-thun-nam-ngan-tay-5s-fashion-in-basic-casual-ats24003', 'products/image_avatar/khong-phan-loai/zEHkjKju3l6r9R5bysxpdxJOesctRn8ZXZLu5BR7.jpg', 369000, 221000, 40, '<p><a href=\"https://5sfashion.vn/san-pham/ao-thun-nam-ngan-tay-5s-fashion-in-basic-casual-ats24003\"><strong>&Aacute;o thun nam ngắn tay Basic phom Casual Fit ATS24003</strong></a></p>\r\n<p><a href=\"https://5sfashion.vn/danh-muc/ao-thun-nam\"><strong>&Aacute;o thun nam</strong></a>&nbsp;<strong>ATS24003</strong>&nbsp;l&agrave; sản phẩm &aacute;o thun nằm trong&nbsp;<strong><a href=\"https://5sfashion.vn/danh-muc/bo-suu-tap-xuan-he\">BST Xu&acirc;n H&egrave; 2024</a></strong>&nbsp;của&nbsp;<strong>5S Fashion</strong>. &Aacute;o c&oacute; 3 m&agrave;u với c&aacute;c gam m&agrave;u cơ bản gi&uacute;p bạn dễ d&agrave;ng phối đồ để tr&ocirc;ng thật nổi bật v&agrave; phong c&aacute;ch.</p>\r\n<p>- &Aacute;o thun ATS24003 được may với phom d&aacute;ng&nbsp;<strong>Casual Fit</strong>&nbsp;sự kết hợp ho&agrave;n hảo của Slimfit v&agrave; Regular vừa t&ocirc;n d&aacute;ng vừa thoải m&aacute;i mang phong th&aacute;i ph&oacute;ng kho&aacute;ng, tiện lợi, linh hoạt</p>\r\n<p>- &Aacute;o thiết kế basic, nổi bật phần họa tiết in trước ngực &eacute;p nhiệt bền bỉ, tạo điểm nhấn</p>\r\n<p>- Cổ &aacute;o được bọc d&acirc;y dệt d&agrave;y dặn, giữ phom, co gi&atilde;n thoải m&aacute;i</p>\r\n<p>- Đường may tỉ mỉ, sắc n&eacute;t, kh&ocirc;ng chỉ thừa.</p>\r\n<p>- Tay &aacute;o tho&aacute;ng m&aacute;t, rộng r&atilde;i gi&uacute;p người mặc cảm thấy dễ chịu v&agrave; dễ d&agrave;ng trong mọi chuyển động.</p>\r\n<ul>\r\n<li><strong>Chất liệu cao cấp với tỉ lệ ho&agrave;n hảo:&nbsp;</strong></li>\r\n</ul>\r\n<p>-&nbsp;<strong>63% Sợi Cotton tự nhi&ecirc;n</strong>: mềm mịn, tho&aacute;ng m&aacute;t v&agrave; thấm h&uacute;t vượt trội.</p>\r\n<p>-<strong>&nbsp;29% Polyester</strong>: Sợi tổng hợp cao cấp, kh&aacute;c với sợi Poly th&ocirc;ng thường kh&aacute;c bởi c&ocirc;ng nghệ l&agrave;m m&aacute;t, tạo c&aacute;c r&atilde;nh tr&ecirc;n bề mặt gi&uacute;p khuếch t&aacute;n nhiệt nhanh ch&oacute;ng, m&aacute;t hơn, tho&aacute;ng kh&iacute; hơn. Th&ecirc;m v&agrave;o đ&oacute; với sự kết hợp của Poly c&ograve;n mang lại c&aacute;c t&iacute;nh năng tuyệt vời như cực bền bỉ từ m&agrave;u sắc đến bề mặt vải, nhẹ hơn, hạn chế nhăn nh&agrave;u hiệu quả, chống co r&uacute;t.</p>\r\n<p>-&nbsp;<strong>8% Spandex</strong>: co gi&atilde;n, tạo cảm gi&aacute;c dễ chịu cho người mặc, ngo&agrave;i ra sợi c&ograve;n c&oacute; t&iacute;nh chất đ&agrave;n hồi trở về trạng th&aacute;i ban đầu ngay khi bị t&aacute;c động k&eacute;o gi&atilde;n gi&uacute;p hạn chế bai gi&atilde;o hiệu quả.</p>\r\n<ul>\r\n<li><strong>M&agrave;u sắc</strong>&nbsp;: Đen, Cổ vịt đậm, Ghi nhạt</li>\r\n<li><strong>Size</strong>: S, M, L, XL, 2XL, 3XL</li>\r\n<li><strong>C&aacute;ch sử dụng</strong>:</li>\r\n</ul>\r\n<p>- N&ecirc;n giặt tay/giặt m&aacute;y với nhiệt độ kh&ocirc;ng qu&aacute; 30 độ ở chu k&igrave; trung b&igrave;nh v&agrave; v&ograve;ng quay ngắn</p>\r\n<p>- Sử dụng bột giặt/nước giặt trung t&iacute;nh</p>\r\n<p>- Phơi sản phẩm ở nơi kh&ocirc; r&aacute;o tho&aacute;ng m&aacute;t v&agrave; tr&aacute;nh &aacute;nh nắng trực tiếp</p>\r\n<ul>\r\n<li><strong>C&aacute;ch bảo quản:</strong></li>\r\n</ul>\r\n<p>- N&ecirc;n lộn tr&aacute;i khi phơi</p>\r\n<p>- Bảo quản nơi kh&ocirc; r&aacute;o, tr&aacute;nh những nơi ẩm thấp</p>\r\n<p>- L&agrave; (ủi) ở nhiệt độ trung b&igrave;nh</p>\r\n<p><strong>Sắm ngay tại</strong>&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S FASHION</strong></a>.</p>\r\n<p><img class=\"entered loaded\" src=\"https://5sfashion.vn/storage/editor/wPEDZ4Yo9PdZeDpIUjqWJifzLkqtOCLc.webp\" alt=\"\" data-ll-status=\"loaded\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/bTlaiSZPL4aiOsrKEQEaIssgpgWXO35e.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/jm7imbY7SIClD1dwHQ6ruOAhfNBbhIMh.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/iUOzpv3zSKeL0saVRdiExW0UcWtWXqnB.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/LpDFJZoZMFOm3LR88AITJ6EJPUb2dFMr.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/w7akbRHUe0MEVA8eDpqJfxPhxM6Hrth9.webp\" alt=\"\"><img class=\"entered loading\" src=\"https://5sfashion.vn/storage/editor/F2xdxHq79IBGFjKFZdwn7MwO5GibbOun.webp\" alt=\"\" data-ll-status=\"loading\"><img class=\"entered loading\" src=\"https://5sfashion.vn/storage/editor/Q2BglK9ElioYoJETBTVXCaQOvMfX3FhY.webp\" alt=\"\" data-ll-status=\"loading\"></p>', '<div class=\"col-6 item-feature\">\r\n<div class=\"label\">PHOM D&Aacute;NG CASUAL FIT</div>\r\n<div class=\"desc\">Thoải m&aacute;i, linh hoạt, t&ocirc;n d&aacute;ng</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">THẤM H&Uacute;T VƯỢT TRỘI</div>\r\n<div class=\"desc\">Ưu điểm của sợi Cotton tự nhi&ecirc;n</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">BỀN NHẸ, THO&Aacute;NG KH&Iacute;</div>\r\n<div class=\"desc\">Sợi Poly c&ocirc;ng nghệ cải tiến mới</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">THIẾT KẾ IN &Eacute;P NHIỆT</div>\r\n<div class=\"desc\">Nổi bật, cao cấp, bền bỉ</div>\r\n</div>', 0, 0, '2024-12-19 00:00:00', '2025-02-08 00:00:00', 1, '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(40, 16, 'Áo Thun Nam Trơn 5S Fashion Dệt Gân Tăm Casual ATS24046', 'PRD#49764117-S08DDNY8-202412190340', 'ao-thun-nam-tron-5s-fashion-det-gan-tam-casual-ats24046', 'products/image_avatar/khong-phan-loai/8uqNwEfvTwq7CVhR1QSce4PYdXEprxOiQougaVYm.jpg', 399000, 239000, 40, '<p><a href=\"https://5sfashion.vn/san-pham/ao-thun-nam-tron-5s-fashion-det-gan-tam-casual-ats24046\"><strong>&Aacute;o T-shirt nam ngắn tay dệt kẻ ATS24046</strong></a>&nbsp;l&agrave; sản phẩm thuộc d&ograve;ng &aacute;o thun mới ra mắt trong&nbsp;<strong><a href=\"https://5sfashion.vn/danh-muc/bo-suu-tap-xuan-he\">BST Xu&acirc;n H&egrave; 2024</a>&nbsp;</strong>của&nbsp;<strong>5S Fashion</strong>. &Aacute;o c&oacute; 3 m&agrave;u cơ bản - tone m&agrave;u của sự tối giản&nbsp;gi&uacute;p c&aacute;c ch&agrave;ng dễ d&agrave;ng phối đồ theo phong c&aacute;ch ri&ecirc;ng của m&igrave;nh.</p>\r\n<p>-&nbsp;<a href=\"https://5sfashion.vn/danh-muc/ao-thun-nam\"><strong>&Aacute;o thun nam</strong></a>&nbsp;ATS24046 được may với phom d&aacute;ng&nbsp;<strong>Casual Fit</strong>,&nbsp;sự kết hợp ho&agrave;n hảo của Slimfit v&agrave; Regular vừa t&ocirc;n d&aacute;ng vừa thoải m&aacute;i mang phong th&aacute;i ph&oacute;ng kho&aacute;ng, tiện lợi v&agrave; đậm dấu ấn c&aacute; nh&acirc;n c&ugrave;ng t&iacute;nh đơn giản, linh hoạt.</p>\r\n<p>- Thiết kế nổi bật với phần bề mặt vải dệt hiểu ứng g&acirc;n tăm nổi tinh tế, trẻ trung, phong c&aacute;ch</p>\r\n<p>- Đường may tỉ mỉ, sắc n&eacute;t, kh&ocirc;ng chỉ thừa.</p>\r\n<p>- Tay &aacute;o tho&aacute;ng m&aacute;t, rộng r&atilde;i gi&uacute;p người mặc cảm thấy dễ chịu v&agrave; dễ d&agrave;ng trong mọi chuyển động.</p>\r\n<ul>\r\n<li>Ngo&agrave;i thiết kế bắt mắt,&nbsp;<strong>5S Fashion</strong>&nbsp;c&ograve;n mang đến cho người mặc trải nghiệm tuyệt vời về chất liệu mới:</li>\r\n</ul>\r\n<p>-&nbsp;<strong>80%&nbsp;Nylon thấm h&uacute;t</strong>: Kh&aacute;c với c&aacute;c loại Nylon th&ocirc;ng thường kh&aacute;c, sợi Nylon thấm h&uacute;t được sản xuất với c&ocirc;ng nghệ cao cấp bằng phương ph&aacute;p chuốt sợi kỹ hơn l&agrave;m cho cấu tr&uacute;c mảnh v&agrave; mịn nhưng phần bề mặt sợi vẫn giữ được cấu tạo gồm c&aacute;c r&atilde;nh nhỏ li ti gi&uacute;p thấm h&uacute;t độ ẩm tức th&igrave;. Sợi Nylon thấm h&uacute;t hoạt động với cơ chế hấp thụ mồ h&ocirc;i cơ thể nhanh ch&oacute;ng, sau đ&oacute; khuếch t&aacute;n ra xung quanh v&agrave; bay hơi ra ngo&agrave;i. Th&ecirc;m v&agrave;o loại vải n&agrave;y c&ograve;n mang lại c&aacute;c t&iacute;nh năng tuyệt vời như bền bỉ từ m&agrave;u sắc đến bề mặt vải, nhẹ hơn, hạn chế nhăn nh&agrave;u hiệu quả, chống co r&uacute;t.</p>\r\n<p>-&nbsp;<strong>20%</strong>&nbsp;<strong>Spandex</strong>: Co gi&atilde;n tạo cảm gi&aacute;c dễ chịu cho người mặc, ngo&agrave;i ra t&iacute;nh đ&agrave;n hồi của sợi vải n&agrave;y c&ograve;n gi&uacute;p &aacute;o hạn chế t&igrave;nh trạng bai gi&atilde;o.</p>\r\n<ul>\r\n<li><strong>M&agrave;u sắc</strong>&nbsp;: Đen, Trắng, Xanh x&aacute;m nhạt</li>\r\n<li><strong>Size</strong>: S, M, L, XL, 2XL, 3XL</li>\r\n<li><strong>C&aacute;ch sử dụng</strong>:</li>\r\n</ul>\r\n<p>- N&ecirc;n giặt tay/giặt m&aacute;y với nhiệt độ kh&ocirc;ng qu&aacute; 30 độ ở chu k&igrave; trung b&igrave;nh v&agrave; v&ograve;ng quay ngắn</p>\r\n<p>- Sử dụng bột giặt/nước giặt trung t&iacute;nh</p>\r\n<p>- Phơi sản phẩm ở nơi kh&ocirc; r&aacute;o tho&aacute;ng m&aacute;t v&agrave; tr&aacute;nh &aacute;nh nắng trực tiếp</p>\r\n<ul>\r\n<li><strong>C&aacute;ch bảo quản:</strong></li>\r\n</ul>\r\n<p>- N&ecirc;n lộn tr&aacute;i khi phơi</p>\r\n<p>- Bảo quản nơi kh&ocirc; r&aacute;o, tr&aacute;nh những nơi ẩm thấp</p>\r\n<p>- L&agrave; (ủi) ở nhiệt độ trung b&igrave;nh</p>\r\n<p><strong>Sắm ngay tại</strong>&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S FASHION</strong></a>.</p>\r\n<p><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/B8J2MYle3TEgmj5KdcnYz2wexVxHMRXE.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/I7VA1Z22TBKygYwwEIE3MlEoDZMnbVj6.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/wGes2s3fCRoYXb0fcX32FGQuJYdPPd5p.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/HhmPqtl4RTqEFkmfDi0oLWV4IZ4XIjv9.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/xhCEqfvurZqxP0CK9HldW1agcdFlE9iv.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/XpIDOcCMXkdhemWilwJliOphtQSp1XfU.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/GqWwi9fkPTStAr8bHn0GrFvTCZCbvZsE.webp\" alt=\"\"><img class=\"entered loading\" src=\"https://5sfashion.vn/storage/editor/mjNGymKprlqLRQwRFhfPzCfB3dMx8Sqx.webp\" alt=\"\" data-ll-status=\"loading\"></p>', '<div class=\"col-6 item-feature\">\r\n<div class=\"label\">PHOM D&Aacute;NG CASUAL FIT</div>\r\n<div class=\"desc\">T&ocirc;n d&aacute;ng, thoải m&aacute;i, linh hoạt</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">THẤM H&Uacute;T VƯỢT TRỘI</div>\r\n<div class=\"desc\">Sợi nylon c&ocirc;ng nghệ cải tiến mới</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">THIẾT KẾ DỆT G&Acirc;N TĂM NỔI</div>\r\n<div class=\"desc\">Thu h&uacute;t, phong c&aacute;ch, thời trang</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">CO GI&Atilde;N ĐA CHIỀU</div>\r\n<div class=\"desc\">Thoải m&aacute;i vận đ&ocirc;ng</div>\r\n</div>', 0, 0, '2024-12-19 00:00:00', '2025-03-08 00:00:00', 1, '2024-12-18 20:40:01', '2024-12-18 20:40:01', NULL),
(41, 16, 'Áo Thun Nam Ngắn Tay 5S Fashion In Chữ Protect Slimfit ATS24011', 'PRD#71704033-ZPFLMPCS-202412190342', 'ao-thun-nam-ngan-tay-5s-fashion-in-chu-protect-slimfit-ats24011', 'products/image_avatar/khong-phan-loai/DBGdH4Od1WHjUpzCJiGdxmvtsMbtca3qGyoEMmx5.jpg', 299000, 179000, 40, '<p><a href=\"https://5sfashion.vn/san-pham/ao-thun-nam-ngan-tay-5s-fashion-in-chu-protect-slimfit-ats24011\"><strong>&Aacute;o thun nam tay ngắn thể thao phom Slimfit ATS24011</strong></a></p>\r\n<p><a href=\"https://5sfashion.vn/danh-muc/ao-thun-nam\"><strong>&Aacute;o thun nam</strong></a>&nbsp;Protect l&agrave; sản phẩm &aacute;o thun nằm trong&nbsp;<strong>BST True Sport</strong>&nbsp;<strong>2024</strong>&nbsp;của&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S Fashion</strong></a>. &Aacute;o gồm c&aacute;c m&agrave;u sắc tone lạnh, lấy cảm hứng từ m&ugrave;a H&egrave; tươi m&aacute;t mang lại cảm gi&aacute;c dễ chịu cho người mặc đồng thời cũng dễ d&agrave;ng phối đồ mặc được nhiều dịp đi dạo, đi du lịch, cafe, đặc biệt th&iacute;ch hợp cho c&aacute;c hoạt động thể thao...</p>\r\n<p>- &Aacute;o được may với phom d&aacute;ng&nbsp;<strong>Slimfit</strong>&nbsp;&ocirc;m vừa vặn, gọn g&agrave;ng, t&ocirc;n d&aacute;ng nhưng vẫn đảm bảo sự thoải m&aacute;i khi vận động.</p>\r\n<p>- Thiết kế nổi bật với mặt trước in chữ PROTECT cao cấp bền bỉ</p>\r\n<p>- Mặt sau &aacute;o in họa tiết phối đường line can cắt gi&uacute;p người mặc tr&ocirc;ng thật khỏe khoắn v&agrave; năng động</p>\r\n<p>- Bề mặt vải dệt hiệu ứng với kiểu dệt Mesh si&ecirc;u tho&aacute;ng kh&iacute;</p>\r\n<p>- Cổ &aacute;o tr&ograve;n c&oacute; bo hai lớp d&agrave;y dặn, giữ phom, co gi&atilde;n thoải m&aacute;i.</p>\r\n<p>- Đường may đều, tỉ mỉ, kh&ocirc;ng chỉ thừa.</p>\r\n<p>- Tay &aacute;o tho&aacute;ng m&aacute;t, rộng r&atilde;i dễ d&agrave;ng trong mọi chuyển động.&nbsp;</p>\r\n<ul>\r\n<li><strong>Chất liệu&nbsp;cao cấp&nbsp;gi&uacute;p người mặc lu&ocirc;n cảm nhận được sự thoải m&aacute;i khi mặc:&nbsp;</strong></li>\r\n</ul>\r\n<p>-&nbsp;<strong>90% Recycled Polyester</strong>: Sợi tổng hợp cao cấp được t&aacute;i chế từ c&aacute;c chai nhựa g&oacute;p phần bảo vệ m&ocirc;i trường, sợi vải được xử l&yacute; với c&ocirc;ng nghệ l&agrave;m m&aacute;t v&agrave; kiểu dệt Mesh c&oacute; cấu tr&uacute;c dạng lưới, tạo c&aacute;c r&atilde;nh tho&aacute;ng kh&iacute; tr&ecirc;n bề mặt vải, gi&uacute;p khuếch t&aacute;n nhiệt nhanh ch&oacute;ng, kh&ocirc; nhanh, m&aacute;t hơn. Th&ecirc;m v&agrave;o đ&oacute; vải Poly c&ograve;n mang lại c&aacute;c t&iacute;nh năng tuyệt vời như độ bền cao, l&ecirc;n m&agrave;u sắc n&eacute;t, trọng lượng cực nhẹ, hạn chế nhăn nh&agrave;u hiệu quả, chống co r&uacute;t.</p>\r\n<p>-&nbsp;<strong>10% Spandex</strong>: co gi&atilde;n, đ&agrave;n hồi, tạo cảm gi&aacute;c dễ chịu cho người mặc, ngo&agrave;i ra sợi c&ograve;n c&oacute; t&iacute;nh chất đ&agrave;n hồi trở về trạng th&aacute;i ban đầu ngay khi bị t&aacute;c động k&eacute;o gi&atilde;n gi&uacute;p hạn chế bai gi&atilde;o hiệu quả.</p>\r\n<ul>\r\n<li><strong>M&agrave;u sắc</strong>&nbsp;: Ghi đậm, Trắng, T&iacute;m than nhạt, Xanh ch&igrave;</li>\r\n<li><strong>Size</strong>: S, M, L, XL, 2XL, 3XL</li>\r\n<li><strong>C&aacute;ch sử dụng</strong>:</li>\r\n</ul>\r\n<p>- N&ecirc;n giặt tay/giặt m&aacute;y với nhiệt độ kh&ocirc;ng qu&aacute; 30 độ ở chu k&igrave; trung b&igrave;nh v&agrave; v&ograve;ng quay ngắn</p>\r\n<p>- Sử dụng bột giặt/nước giặt trung t&iacute;nh</p>\r\n<p>- Phơi sản phẩm ở nơi kh&ocirc; r&aacute;o tho&aacute;ng m&aacute;t v&agrave; tr&aacute;nh &aacute;nh nắng trực tiếp</p>\r\n<ul>\r\n<li><strong>C&aacute;ch bảo quản:</strong></li>\r\n</ul>\r\n<p>- N&ecirc;n lộn tr&aacute;i khi phơi</p>\r\n<p>- Bảo quản nơi kh&ocirc; r&aacute;o, tr&aacute;nh những nơi ẩm thấp</p>\r\n<p>- L&agrave; (ủi) ở nhiệt độ trung b&igrave;nh</p>\r\n<p><strong>Sắm ngay tại</strong>&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S FASHION</strong></a>.</p>\r\n<p><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/m6ViMOlNZeejSgnjUYtcy4aQJsyvih02.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/uGcFF3ZM7Y0mae7tQp8bl9x74DlG450Z.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/PgL0n7Lmg5MgipTY8tOHYFmqrZmrFT8r.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/4u9mTuojVWHlnjZ0W4TFJ7bLmTeq20YD.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/GK5NHkTRA4AvF70NIy3hryqGibRj1Piu.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/CRxc8wAUECd3OANWCRuiL7gZY7Y8lA8M.webp\" alt=\"\"><img class=\"entered loading\" src=\"https://5sfashion.vn/storage/editor/4DM8oNDu9p7tKUbRyEjmjMJAnQ8z0ya8.webp\" alt=\"\" data-ll-status=\"loading\"></p>', '<div class=\"col-6 item-feature\">\r\n<div class=\"label\">SI&Ecirc;U NHẸ, &Ecirc;M &Aacute;I</div>\r\n<div class=\"desc\">Trọng lượng &aacute;o cực nhẹ, mềm mịn, m&aacute;t lạnh dễ chịu</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">KH&Ocirc; NHANH, THO&Aacute;NG KH&Iacute; TUYỆT ĐỐI</div>\r\n<div class=\"desc\">Vải polo t&aacute;i chế c&ocirc;ng nghệ cao cấp</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">ĐỘ BỀN CAO</div>\r\n<div class=\"desc\">Chống nhăn, kh&ocirc;ng bai gi&atilde;o</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">THIẾT KẾ CAN CẮT</div>\r\n<div class=\"desc\">Khỏe khoắn, năng động</div>\r\n</div>', 0, 0, '2024-12-19 00:00:00', '2025-01-11 00:00:00', 1, '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(42, 16, 'Áo Thun Nam Ngắn Tay 5S Fashion In Chữ Slimfit ATS24030', 'PRD#20138341-BCDK5UPK-202412190344', 'ao-thun-nam-ngan-tay-5s-fashion-in-chu-slimfit-ats24030', 'products/image_avatar/khong-phan-loai/JE6bo5inYdXU2Wjc5DPAc0jtp8ekHIG9OMlZqBbj.jpg', 329000, 197000, 40, '<p><a href=\"https://5sfashion.vn/san-pham/ao-thun-nam-ngan-tay-5s-fashion-in-chu-slimfit-ats24030\"><strong>&Aacute;o thun nam tay ngắn in chữ lớn phom Slimfit ATS24030</strong></a></p>\r\n<p><a href=\"https://5sfashion.vn/danh-muc/ao-thun-nam\"><strong>&Aacute;o thun nam</strong></a>&nbsp;Protect active l&agrave; sản phẩm &aacute;o thun nằm trong&nbsp;<strong>BST True Sport</strong>&nbsp;<strong>2024</strong>&nbsp;của&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S Fashion</strong></a>. &Aacute;o gồm c&aacute;c m&agrave;u sắc tone lạnh, lấy cảm hứng từ m&ugrave;a H&egrave; tươi m&aacute;t mang lại cảm gi&aacute;c dễ chịu cho người mặc đồng thời cũng dễ d&agrave;ng phối đồ mặc được nhiều dịp đi dạo, đi du lịch, cafe, đặc biệt th&iacute;ch hợp cho c&aacute;c hoạt động thể thao...</p>\r\n<p>- &Aacute;o được may với phom d&aacute;ng&nbsp;<strong>Slimfit</strong>&nbsp;&ocirc;m vừa vặn, gọn g&agrave;ng, t&ocirc;n d&aacute;ng nhưng vẫn đảm bảo sự thoải m&aacute;i khi vận động.</p>\r\n<p>- Thiết kế nổi bật với phần chữ phối họa tiết in &eacute;p nhiệt cao cấp trước ngực mang lại vẻ ngo&agrave;i trẻ trung, phong c&aacute;ch v&agrave; khỏe khoắn</p>\r\n<p>- Cổ &aacute;o tr&ograve;n c&oacute; bo hai lớp d&agrave;y dặn, giữ phom, co gi&atilde;n thoải m&aacute;i.</p>\r\n<p>- Đường may đều, tỉ mỉ, kh&ocirc;ng chỉ thừa.</p>\r\n<p>- Tay &aacute;o tho&aacute;ng m&aacute;t, rộng r&atilde;i dễ d&agrave;ng trong mọi chuyển động.&nbsp;</p>\r\n<ul>\r\n<li><strong>Chất liệu&nbsp;cao cấp&nbsp;gi&uacute;p người mặc lu&ocirc;n cảm nhận được sự thoải m&aacute;i khi mặc:&nbsp;</strong></li>\r\n</ul>\r\n<p>-<strong>&nbsp;87% Nylon l&agrave;m m&aacute;t</strong>: được l&agrave;m từ chất liệu Nylon cao cấp ứng dụng c&ocirc;ng nghệ l&agrave;m m&aacute;t sợi, c&aacute;c sợi vải được chuốt mảnh kết hợp sử dụng&nbsp;kiểu dệt&nbsp;<strong>Mesh</strong>&nbsp;với cấu tr&uacute;c dệt lưới tạo r&atilde;nh tho&aacute;ng kh&iacute; gi&uacute;p nhiệt v&agrave; độ ẩm lưu th&ocirc;ng nhanh ch&oacute;ng, khuếch t&aacute;n ra b&ecirc;n ngo&agrave;i. Nhờ đ&oacute; người mặc sẽ lu&ocirc;n c&oacute; cảm gi&aacute;c m&aacute;t lạnh khi chạm v&agrave;o, cảm nhận được sự tho&aacute;ng m&aacute;t, kh&ocirc;ng bết d&iacute;nh v&agrave; cực k&igrave; nhẹ nh&agrave;ng, &ecirc;m &aacute;i.</p>\r\n<p>-&nbsp;<strong>13% Spandex</strong>: co gi&atilde;n dễ chịu, ngo&agrave;i ra sợi c&ograve;n c&oacute; t&iacute;nh chất đ&agrave;n hồi trở về trạng th&aacute;i ban đầu ngay khi bị t&aacute;c động k&eacute;o gi&atilde;n gi&uacute;p hạn chế bai gi&atilde;o hiệu quả.</p>\r\n<ul>\r\n<li><strong>M&agrave;u sắc</strong>&nbsp;: Đen, Trắng, Cổ vịt đậm, Cổ vịt nhạt</li>\r\n<li><strong>Size</strong>: S, M, L, XL, 2XL, 3XL</li>\r\n<li><strong>C&aacute;ch sử dụng</strong>:</li>\r\n</ul>\r\n<p>- N&ecirc;n giặt tay/giặt m&aacute;y với nhiệt độ kh&ocirc;ng qu&aacute; 30 độ ở chu k&igrave; trung b&igrave;nh v&agrave; v&ograve;ng quay ngắn</p>\r\n<p>- Sử dụng bột giặt/nước giặt trung t&iacute;nh</p>\r\n<p>- Phơi sản phẩm ở nơi kh&ocirc; r&aacute;o tho&aacute;ng m&aacute;t v&agrave; tr&aacute;nh &aacute;nh nắng trực tiếp</p>\r\n<ul>\r\n<li><strong>C&aacute;ch bảo quản:</strong></li>\r\n</ul>\r\n<p>- N&ecirc;n lộn tr&aacute;i khi phơi</p>\r\n<p>- Bảo quản nơi kh&ocirc; r&aacute;o, tr&aacute;nh những nơi ẩm thấp</p>\r\n<p>- L&agrave; (ủi) ở nhiệt độ trung b&igrave;nh</p>\r\n<p><strong>Sắm ngay tại</strong>&nbsp;<a href=\"https://5sfashion.vn/\"><strong>5S FASHION</strong></a>.</p>\r\n<p><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/Gu3BVJBtPTI94N2jtTCeydbP4gPtwI3T.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/4baYHnxH2Z9ERzQfLcrA8ziruda0zoaW.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/PeuepvZxDsAhyLyV46H74BaZonh9MM44.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/4eHwycJ4UIIgbEzD3sBQsdOMqyrKaFJo.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/MWj7xMtQMdCM2ehYmrEmV1ocRKdG7dvg.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/G1D3S3pGVgLmVpKOdnxiJhFDCZ7oZLf8.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/weRAxSGM2MA2zwAfm5n5QuqE8Ld8g0cE.webp\" alt=\"\"><img class=\"entered exited\" src=\"https://5sfashion.vn/storage/editor/yxQNrgi50xXrj78wBD7g4yfxRSegRjp2.webp\" alt=\"\"><img class=\"entered loading\" src=\"https://5sfashion.vn/storage/editor/wySt65i5HqN6oyISsra7yTzogEc5OxAV.webp\" alt=\"\" data-ll-status=\"loading\"></p>', '<div class=\"col-6 item-feature\">\r\n<div class=\"label\">FORM SLIM FIT</div>\r\n<div class=\"desc\">&Ocirc;m vừa vặn, t&ocirc;n đ&aacute;ng</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">SỢI NYLON C&Ocirc;NG NGHỆ</div>\r\n<div class=\"desc\">Thấm h&uacute;t tức th&igrave;, kh&ocirc;ng bết d&iacute;nh</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">CO GI&Atilde;N ĐA CHIỀU</div>\r\n<div class=\"desc\">Tự do thoải m&aacute;i vận động</div>\r\n</div>\r\n<div class=\"col-6 item-feature\">\r\n<div class=\"label\">IN &Eacute;P NHIỆT</div>\r\n<div class=\"desc\">Nổi bật, cao cấp, bền bỉ</div>\r\n</div>', 0, 0, '2024-12-19 00:00:00', '2025-01-18 00:00:00', 1, '2024-12-18 20:44:58', '2024-12-18 20:44:58', NULL),
(43, 5, 'Áo Khoác Gió Nam Thông Minh Trượt Nước', 'PRD#87534729-BJBIV6F3-202412190923', 'ao-khoac-gio-nam-thong-minh-truot-nuoc', 'products/image_avatar/trang-phuc-truyen-thong/lXMSQv5grcFZ3Mo29wHaWzfRGeBS3aOyCRXWYrZu.webp', 539000, NULL, NULL, '<p data-sourcepos=\"5:1-5:112\">&Aacute;o kho&aacute;c gi&oacute; nam th&ocirc;ng minh trượt nước l&agrave; một chiếc &aacute;o kho&aacute;c đa năng, được thiết kế với nhiều t&iacute;nh năng ưu việt:</p>\r\n<ul data-sourcepos=\"7:1-11:0\">\r\n<li data-sourcepos=\"7:1-7:145\"><strong>Khả năng chống nước:</strong> Nhờ c&ocirc;ng nghệ xử l&yacute; vải hiện đại, &aacute;o c&oacute; khả năng chống thấm nước hiệu quả, gi&uacute;p bạn lu&ocirc;n kh&ocirc; r&aacute;o trong những ng&agrave;y mưa.</li>\r\n<li data-sourcepos=\"8:1-8:134\"><strong>Gọn nhẹ:</strong> &Aacute;o được thiết kế gọn nhẹ, dễ d&agrave;ng gấp gọn v&agrave; mang theo b&ecirc;n m&igrave;nh, rất tiện lợi khi đi du lịch hoặc hoạt động ngo&agrave;i trời.</li>\r\n<li data-sourcepos=\"9:1-9:144\"><strong>Th&ocirc;ng tho&aacute;ng:</strong> Chất liệu vải thường được l&agrave;m từ c&aacute;c sợi tổng hợp c&oacute; khả năng thấm h&uacute;t mồ h&ocirc;i tốt, gi&uacute;p bạn lu&ocirc;n cảm thấy thoải m&aacute;i khi mặc.</li>\r\n<li data-sourcepos=\"10:1-11:0\"><strong>Phong c&aacute;ch:</strong> &Aacute;o kho&aacute;c gi&oacute; nam c&oacute; nhiều kiểu d&aacute;ng v&agrave; m&agrave;u sắc kh&aacute;c nhau, ph&ugrave; hợp với nhiều phong c&aacute;ch thời trang kh&aacute;c nhau, từ thể thao đến c&aacute; t&iacute;nh.</li>\r\n</ul>', '<p data-sourcepos=\"12:1-12:20\">&nbsp;</p>\r\n<p data-sourcepos=\"14:1-14:76\">Chất liệu của &aacute;o kho&aacute;c gi&oacute; nam thường được l&agrave;m từ c&aacute;c loại vải tổng hợp như:</p>\r\n<ul data-sourcepos=\"16:1-19:0\">\r\n<li data-sourcepos=\"16:1-16:81\"><strong>Polyester:</strong> Loại vải n&agrave;y nhẹ, bền, chống nhăn v&agrave; c&oacute; khả năng chống nước tốt.</li>\r\n<li data-sourcepos=\"17:1-17:104\"><strong>Nylon:</strong> Tương tự như polyester, nylon cũng nhẹ, bền v&agrave; chống nước tốt, đồng thời c&oacute; độ đ&agrave;n hồi cao.</li>\r\n<li data-sourcepos=\"18:1-19:0\"><strong>Gore-Tex:</strong> Đ&acirc;y l&agrave; một loại vải cao cấp, c&oacute; khả năng chống nước tuyệt đối nhưng vẫn đảm bảo độ tho&aacute;ng kh&iacute;.</li>\r\n</ul>', 0, 0, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 1, '2024-12-19 02:23:46', '2024-12-19 02:23:46', NULL),
(44, 11, 'Áo Sơ Mi Dài Tay Nam Siêu Co Giãn', 'PRD#55375168-PUJ7HNK7-202412190926', 'ao-so-mi-dai-tay-nam-sieu-co-gian', 'products/image_avatar/khong-phan-loai/Vv1wi1SMU6UnexgR8to8CMl6bOFfq4uCb6KXKf6T.webp', 109000, NULL, NULL, '<p>&Aacute;o sơ mi d&agrave;i tay nam si&ecirc;u co gi&atilde;n được thiết kế với form d&aacute;ng vừa vặn, &ocirc;m s&aacute;t cơ thể, t&ocirc;n l&ecirc;n v&oacute;c d&aacute;ng nam t&iacute;nh. &Aacute;o thường c&oacute; cổ &aacute;o truyền thống hoặc cổ &aacute;o trụ, tay d&agrave;i v&agrave; c&oacute; thể c&oacute; c&aacute;c chi tiết như t&uacute;i ngực, đường may tinh tế. Đặc biệt, điểm nổi bật của &aacute;o sơ mi n&agrave;y ch&iacute;nh l&agrave; khả năng co gi&atilde;n tối đa, gi&uacute;p người mặc thoải m&aacute;i vận động m&agrave; kh&ocirc;ng bị g&ograve; b&oacute;.</p>', '<p data-sourcepos=\"1:1-1:224\">Tuyệt vời! &Aacute;o sơ mi d&agrave;i tay nam si&ecirc;u co gi&atilde;n l&agrave; một item kh&ocirc;ng thể thiếu trong tủ đồ của c&aacute;c qu&yacute; &ocirc;ng hiện đại. Với thiết kế tinh tế v&agrave; chất liệu co gi&atilde;n thoải m&aacute;i, &aacute;o sơ mi n&agrave;y mang đến sự tự tin v&agrave; phong c&aacute;ch cho người mặc.</p>\r\n<p data-sourcepos=\"3:1-3:19\"><strong>M&ocirc; tả sản phẩm:</strong></p>\r\n<p data-sourcepos=\"5:1-5:354\">&Aacute;o sơ mi d&agrave;i tay nam si&ecirc;u co gi&atilde;n được thiết kế với form d&aacute;ng vừa vặn, &ocirc;m s&aacute;t cơ thể, t&ocirc;n l&ecirc;n v&oacute;c d&aacute;ng nam t&iacute;nh. &Aacute;o thường c&oacute; cổ &aacute;o truyền thống hoặc cổ &aacute;o trụ, tay d&agrave;i v&agrave; c&oacute; thể c&oacute; c&aacute;c chi tiết như t&uacute;i ngực, đường may tinh tế. Đặc biệt, điểm nổi bật của &aacute;o sơ mi n&agrave;y ch&iacute;nh l&agrave; khả năng co gi&atilde;n tối đa, gi&uacute;p người mặc thoải m&aacute;i vận động m&agrave; kh&ocirc;ng bị g&ograve; b&oacute;.</p>\r\n<p data-sourcepos=\"7:1-7:20\"><strong>M&ocirc; tả chất liệu:</strong></p>\r\n<p data-sourcepos=\"9:1-9:92\">Chất liệu của &aacute;o sơ mi d&agrave;i tay nam si&ecirc;u co gi&atilde;n thường l&agrave; c&aacute;c loại vải tổng hợp cao cấp như:</p>\r\n<ul data-sourcepos=\"11:1-14:0\">\r\n<li data-sourcepos=\"11:1-11:125\"><strong>Cotton pha spandex:</strong> Kết hợp giữa sự mềm mại của cotton v&agrave; độ co gi&atilde;n của spandex, tạo cảm gi&aacute;c thoải m&aacute;i v&agrave; tho&aacute;ng m&aacute;t.</li>\r\n<li data-sourcepos=\"12:1-12:86\"><strong>Polyester pha spandex:</strong> Vải nhẹ, bền, &iacute;t nhăn v&agrave; c&oacute; khả năng thấm h&uacute;t mồ h&ocirc;i tốt.</li>\r\n<li data-sourcepos=\"13:1-14:0\"><strong>Vải thun lạnh:</strong> Mang đến cảm gi&aacute;c m&aacute;t mẻ, dễ chịu khi mặc.</li>\r\n</ul>', 0, 0, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 1, '2024-12-19 02:26:46', '2024-12-19 02:26:46', NULL),
(45, 11, 'Sơ Mi Dài Tay Nữ Cotton Thô Casual', 'PRD#51275942-QS17HN5O-202412190929', 'so-mi-dai-tay-nu-cotton-tho-casual', 'products/image_avatar/khong-phan-loai/c5qKgAnzrCQ42crzYAZ9f9xKWSs2CIMofFdU5Zej.webp', 499000, NULL, NULL, '<p><strong>Thiết kế:</strong></p>\r\n<ul data-sourcepos=\"6:5-9:65\">\r\n<li data-sourcepos=\"6:5-6:36\">Form d&aacute;ng rộng r&atilde;i, thoải m&aacute;i.</li>\r\n<li data-sourcepos=\"7:5-7:37\">Cổ &aacute;o đa dạng: tr&ograve;n, chữ V, bẻ.</li>\r\n<li data-sourcepos=\"8:5-8:43\">Tay &aacute;o d&agrave;i đến khuỷu tay hoặc cổ tay.</li>\r\n<li data-sourcepos=\"9:5-9:65\">Chi tiết đơn giản nhưng tinh tế: t&uacute;i ngực, đường may tỉ mỉ.<br><br></li>\r\n<li data-sourcepos=\"16:1-20:36\"><strong>Ưu điểm:</strong>\r\n<ul data-sourcepos=\"17:5-20:36\">\r\n<li data-sourcepos=\"17:5-17:33\">Thoải m&aacute;i, dễ chịu khi mặc.</li>\r\n<li data-sourcepos=\"18:5-18:53\">Phong c&aacute;ch đa dạng: casual, vintage, năng động.</li>\r\n<li data-sourcepos=\"19:5-19:47\">Dễ phối đồ với nhiều loại quần, ch&acirc;n v&aacute;y.</li>\r\n<li data-sourcepos=\"20:5-20:36\">Th&iacute;ch hợp cho nhiều hoạt động.</li>\r\n</ul>\r\n</li>\r\n<li data-sourcepos=\"21:1-24:76\"><strong>C&aacute;ch phối đồ:</strong>\r\n<ul data-sourcepos=\"22:5-24:76\">\r\n<li data-sourcepos=\"22:5-22:80\"><strong>Phong c&aacute;ch casual:</strong> Kết hợp với quần jeans, gi&agrave;y sneaker, t&uacute;i đeo ch&eacute;o.</li>\r\n<li data-sourcepos=\"23:5-23:77\"><strong>Phong c&aacute;ch vintage:</strong> Kết hợp với ch&acirc;n v&aacute;y midi, gi&agrave;y b&uacute;p b&ecirc;, mũ c&oacute;i.</li>\r\n<li data-sourcepos=\"24:5-24:76\"><strong>Phong c&aacute;ch năng động:</strong> Kết hợp với quần short, gi&agrave;y thể thao, balo.</li>\r\n</ul>\r\n</li>\r\n<li data-sourcepos=\"25:1-29:0\"><strong>Lời khuy&ecirc;n khi chọn mua:</strong>\r\n<ul data-sourcepos=\"26:5-29:0\">\r\n<li data-sourcepos=\"26:5-26:41\">Chọn size ph&ugrave; hợp với số đo cơ thể.</li>\r\n<li data-sourcepos=\"27:5-27:56\">Lựa chọn m&agrave;u sắc ph&ugrave; hợp với m&agrave;u da v&agrave; phong c&aacute;ch.</li>\r\n<li data-sourcepos=\"28:5-29:0\">Kiểm tra chất liệu vải cotton th&ocirc; c&oacute; độ d&agrave;y vừa phải.</li>\r\n</ul>\r\n</li>\r\n</ul>', '<p>Cotton th&ocirc;:</p>\r\n<ul data-sourcepos=\"12:9-15:41\">\r\n<li data-sourcepos=\"12:9-12:30\">Mềm mại, tho&aacute;ng m&aacute;t.</li>\r\n<li data-sourcepos=\"13:9-13:30\">Thấm h&uacute;t mồ h&ocirc;i tốt.</li>\r\n<li data-sourcepos=\"14:9-14:40\">Bền bỉ, th&acirc;n thiện với l&agrave;n da.</li>\r\n<li data-sourcepos=\"15:9-15:41\">Tạo cảm gi&aacute;c tự nhi&ecirc;n, mộc mạc.</li>\r\n</ul>', 0, 0, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 1, '2024-12-19 02:29:57', '2024-12-19 02:29:57', NULL),
(46, 11, 'Áo Sơ Mi Tay Dài Nữ Ôm Knit Tay Cơi Cài Cúc', 'PRD#93433178-W0I8WCSR-202412190934', 'ao-so-mi-tay-dai-nu-om-knit-tay-coi-cai-cuc', 'products/image_avatar/khong-phan-loai/R6g6Elz52g5vsgs6htCUMWNHrirnaOFSNHhpTl8u.webp', 399000, 79000, NULL, '<strong class=\"text-warning\">Hiện chưa cập nhật mô tả cụ thể cho sản phẩm!</strong>', '<strong class=\"text-warning\">Hiện chưa cập nhật chất liệu cho sản phẩm!</strong>', 0, 0, '2024-11-25 00:00:00', '2024-11-25 00:00:00', 1, '2024-12-19 02:34:52', '2024-12-19 02:34:52', NULL),
(47, 18, 'Váy Nữ Xoè Cổ Yếm', 'PRD#13541110-XH7YJJFI-202412191128', 'vay-nu-xoe-co-yem', 'products/image_avatar/khong-phan-loai/rni7aKa3Vz2KkFrmleYKAVh9hw3mBfNOXcaWG2EQ.webp', 399000, NULL, NULL, '<strong class=\"text-warning\">Hiện chưa cập nhật mô tả cụ thể cho sản phẩm!</strong>', '<strong class=\"text-warning\">Hiện chưa cập nhật chất liệu cho sản phẩm!</strong>', 0, 0, '2024-12-01 00:00:00', '2024-12-31 00:00:00', 1, '2024-12-19 04:28:41', '2024-12-19 04:28:41', NULL),
(48, 6, 'Áo Polo Thể Thao Nữ Trụ Áo Ép Sim', 'PRD#62206672-GTFTYU1I-202412191131', 'ao-polo-the-thao-nu-tru-ao-ep-sim', 'products/image_avatar/ao-nam/ht72gAYYsLnsIKVCTO7kpTYJSluBUIpFzzJ8c11F.webp', 269000, NULL, NULL, '<strong class=\"text-warning\">Hiện chưa cập nhật mô tả cụ thể cho sản phẩm!</strong>', '<strong class=\"text-warning\">Hiện chưa cập nhật chất liệu cho sản phẩm!</strong>', 0, 0, NULL, NULL, 1, '2024-12-19 04:31:08', '2024-12-19 04:31:08', NULL),
(49, 12, 'Quần Jeans Nữ Ống Đứng Cao Cạp 2 Cúc', 'PRD#55979138-ZDJESDX8-202412191132', 'quan-jeans-nu-ong-ung-cao-cap-2-cuc', 'products/image_avatar/khong-phan-loai/GbtVua7gepoDv8A6S8YnKElRTwGc7VHkyNVHB9BM.webp', 369000, NULL, NULL, '<strong class=\"text-warning\">Hiện chưa cập nhật mô tả cụ thể cho sản phẩm!</strong>', '<strong class=\"text-warning\">Hiện chưa cập nhật chất liệu cho sản phẩm!</strong>', 0, 0, NULL, NULL, 1, '2024-12-19 04:32:52', '2024-12-19 04:32:52', NULL),
(50, 11, 'Áo Sơ Mi Tay Dài Nữ Suông Kèm Nơ', 'PRD#80822008-BCUP0NEY-202412191134', 'ao-so-mi-tay-dai-nu-suong-kem-no', 'products/image_avatar/khong-phan-loai/Xxv3hwKzlMgJoGT3wiJwLIY0MDp1bqU7OCC74Icm.webp', 599000, NULL, NULL, '<strong class=\"text-warning\">Hiện chưa cập nhật mô tả cụ thể cho sản phẩm!</strong>', '<strong class=\"text-warning\">Hiện chưa cập nhật chất liệu cho sản phẩm!</strong>', 0, 0, NULL, NULL, 1, '2024-12-19 04:34:51', '2024-12-19 04:34:51', NULL),
(51, 6, 'Áo Polo Nữ Mắt Chim Bo Hiệu Ứng Dệt Nổi', 'PRD#72113277-RDXOLZGT-202412191137', 'ao-polo-nu-mat-chim-bo-hieu-ung-det-noi', 'products/image_avatar/ao-nam/XYjYh6rHF8HyYioYGC8AcePlqC6LSLTGq3NGdPVk.webp', 369000, NULL, NULL, '<strong class=\"text-warning\">Hiện chưa cập nhật mô tả cụ thể cho sản phẩm!</strong>', '<strong class=\"text-warning\">Hiện chưa cập nhật chất liệu cho sản phẩm!</strong>', 0, 0, NULL, NULL, 1, '2024-12-19 04:37:05', '2024-12-19 04:37:05', NULL),
(52, 6, 'Polo Nam Cafe Dệt Tổ Ong Mickey Phi Hành Gia', 'PRD#86059752-YC8DC14X-202412191138', 'polo-nam-cafe-det-to-ong-mickey-phi-hanh-gia', 'products/image_avatar/ao-nam/8Lj2AkxeOhhSLQ5ChwWAQqm5jlvVCqCDNiE2YrAk.webp', 269000, NULL, NULL, '<strong class=\"text-warning\">Hiện chưa cập nhật mô tả cụ thể cho sản phẩm!</strong>', '<strong class=\"text-warning\">Hiện chưa cập nhật chất liệu cho sản phẩm!</strong>', 0, 0, NULL, NULL, 1, '2024-12-19 04:38:48', '2024-12-19 04:38:48', NULL),
(53, 6, 'Polo Nam Cafe Dệt Tổ Ong Phối Bo Nổi Bật', 'PRD#91970825-Q7NQH9VA-202412191140', 'polo-nam-cafe-det-to-ong-phoi-bo-noi-bat', 'products/image_avatar/ao-nam/XZJ98AaFCEjLIxeRW89pC9NcLBOxoZUpPQ6i8rDq.webp', 299000, NULL, NULL, '<strong class=\"text-warning\">Hiện chưa cập nhật mô tả cụ thể cho sản phẩm!</strong>', '<strong class=\"text-warning\">Hiện chưa cập nhật chất liệu cho sản phẩm!</strong>', 0, 0, NULL, NULL, 1, '2024-12-19 04:40:34', '2024-12-19 04:40:34', NULL),
(54, 6, 'Polo Nam Yody Sport Tay Raglan Xẻ Tà', 'PRD#83653031-FJ2CACUB-202412191142', 'polo-nam-yody-sport-tay-raglan-xe-ta', 'products/image_avatar/ao-nam/T5f9ZffCCBqN6KShcevPVoHcj59tWDr9SixR1xDK.webp', 199000, NULL, NULL, '<strong class=\"text-warning\">Hiện chưa cập nhật mô tả cụ thể cho sản phẩm!</strong>', '<strong class=\"text-warning\">Hiện chưa cập nhật chất liệu cho sản phẩm!</strong>', 0, 0, NULL, NULL, 1, '2024-12-19 04:42:27', '2024-12-19 04:42:27', NULL),
(55, 13, 'Quần Short Thể Thao Nam Cắt Lazer Yody Sport', 'PRD#48976025-HRFIYZPS-202412191144', 'quan-short-the-thao-nam-cat-lazer-yody-sport', 'products/image_avatar/khong-phan-loai/Cn7GJ20GfcIdvGL0fYzqrI5k8KlK3jtXHx8RlQQw.webp', 269000, NULL, NULL, '<strong class=\"text-warning\">Hiện chưa cập nhật mô tả cụ thể cho sản phẩm!</strong>', '<strong class=\"text-warning\">Hiện chưa cập nhật chất liệu cho sản phẩm!</strong>', 0, 0, NULL, NULL, 1, '2024-12-19 04:44:15', '2024-12-19 04:44:15', NULL),
(56, 7, 'Quần Âu Nam Golf', 'PRD#70349381-RIYHMXYR-202412191146', 'quan-au-nam-golf', 'products/image_avatar/khong-phan-loai/DeRvytMsrimI7Vu8Py1rYJvZQy0okdUoij8mmfze.webp', 199000, NULL, NULL, '<strong class=\"text-warning\">Hiện chưa cập nhật mô tả cụ thể cho sản phẩm!</strong>', '<strong class=\"text-warning\">Hiện chưa cập nhật chất liệu cho sản phẩm!</strong>', 0, 0, NULL, NULL, 1, '2024-12-19 04:46:06', '2024-12-19 04:46:06', NULL),
(57, 13, 'Quần Short Nam Ống Đứng Trẻ Trung', 'PRD#52179135-WHNVSZYP-202412191147', 'quan-short-nam-ong-ung-tre-trung', 'products/image_avatar/khong-phan-loai/4ef0nx2vGYHfaH50QA4iXI2U3gILDpGSDBnhVOMB.webp', 199000, NULL, NULL, '<strong class=\"text-warning\">Hiện chưa cập nhật mô tả cụ thể cho sản phẩm!</strong>', '<strong class=\"text-warning\">Hiện chưa cập nhật chất liệu cho sản phẩm!</strong>', 0, 0, NULL, NULL, 1, '2024-12-19 04:47:26', '2024-12-19 04:47:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 'products/image_galleries/vay/ZJEUggGOGlwsvlqihOIiH0662ugfabRr8iH04Scn.webp', '2024-12-17 06:12:25', '2024-12-17 06:12:25', NULL),
(2, 4, 'products/image_galleries/vay/se6Hu9N5g0wsp7DQOUqlrPseEaySxBEkZAsikknh.webp', '2024-12-17 06:12:25', '2024-12-17 06:12:25', NULL),
(3, 4, 'products/image_galleries/vay/Hk7CDlscUQG8VDAQFN7q5cv5YZB9KYAxh1t5LFX7.webp', '2024-12-17 06:12:25', '2024-12-17 06:12:25', NULL),
(4, 4, 'products/image_galleries/vay/Mgw8nCMRHAFyYMOoZ56eV9nZGKLhwxRcq2Is5POW.webp', '2024-12-17 06:12:25', '2024-12-17 06:12:25', NULL),
(5, 4, 'products/image_galleries/vay/DDvxDTUsMhs0fwc2TwHTK1Y4DmCmqVKCL1YRvPOi.webp', '2024-12-17 06:12:25', '2024-12-17 06:12:25', NULL),
(6, 4, 'products/image_galleries/vay/78MY5eVOsGzXiXOn84Hm3E9MwU5gzfj0vyOrR8Uz.webp', '2024-12-17 06:12:25', '2024-12-17 06:12:25', NULL),
(7, 5, 'products/image_galleries/vay/qZG0HIF831TIZnDA2hOfVNNgxk4rhUmD2CDE87mx.webp', '2024-12-17 06:21:10', '2024-12-17 06:21:10', NULL),
(8, 5, 'products/image_galleries/vay/FaIzfBsB7zUh4LNkkLIeBKzKX8QjUvu5kjITNkcz.webp', '2024-12-17 06:21:10', '2024-12-17 06:21:10', NULL),
(9, 5, 'products/image_galleries/vay/3LrgiKqvGpvKitlnqjvKwlzMPXVhr1EMC2Yosvhs.webp', '2024-12-17 06:21:10', '2024-12-17 06:21:10', NULL),
(10, 5, 'products/image_galleries/vay/oJ6cjV6WBL2gsBKu3Ck1xmTyDB2hPY4RxznwRg78.webp', '2024-12-17 06:21:10', '2024-12-17 06:21:10', NULL),
(11, 5, 'products/image_galleries/vay/7XobrvT5kgfzUyFqYhBNyJjZg4oEAUKcP52TY841.webp', '2024-12-17 06:21:10', '2024-12-17 06:21:10', NULL),
(12, 5, 'products/image_galleries/vay/uZVriMfvnsFliMwzsZ2VPhsBAwUUugRhc7k0rOOX.webp', '2024-12-17 06:21:10', '2024-12-17 06:21:10', NULL),
(13, 6, 'products/image_galleries/vay/MEKItBTdVub6scmLMBKcfZ8CqQ7KOSzR3SdPxYA9.jpg', '2024-12-17 07:34:47', '2024-12-17 07:34:47', NULL),
(14, 6, 'products/image_galleries/vay/xIkMheo1648iXWKjxtRZ7sF1qiNPx71TYnsIToIf.jpg', '2024-12-17 07:34:47', '2024-12-17 07:34:47', NULL),
(15, 6, 'products/image_galleries/vay/JVrQQVqZrCbE0AfS7jrzIRm9rWgeaKZFn8cExGxt.jpg', '2024-12-17 07:34:47', '2024-12-17 07:34:47', NULL),
(16, 7, 'products/image_galleries/vay/nz6hECNTzd4Md9bjDsi5cHSorlVtAoEzIZ4pjIl9.webp', '2024-12-17 14:33:52', '2024-12-17 14:33:52', NULL),
(17, 7, 'products/image_galleries/vay/6GhIquuV8lxRcHgAMrNsLi4cvfXifmWwDDqyBKPK.webp', '2024-12-17 14:33:52', '2024-12-17 14:33:52', NULL),
(18, 7, 'products/image_galleries/vay/rNtj4CYdptw6BPzLPIZPAMv7yL0e5kAHhQB9Y3WB.webp', '2024-12-17 14:33:52', '2024-12-17 14:33:52', NULL),
(19, 7, 'products/image_galleries/vay/PTCAAQP4XRZJ54o6qwChoSac6ZI6T91huTwQm83f.webp', '2024-12-17 14:33:52', '2024-12-17 14:33:52', NULL),
(20, 7, 'products/image_galleries/vay/pef9isL9gt3FvKYPh11Z6rX2SDXpDAeTrkOTR1nQ.webp', '2024-12-17 14:33:52', '2024-12-17 14:33:52', NULL),
(21, 7, 'products/image_galleries/vay/J9GtvGQ7GLf4cL6iaVGZDhYhTLWyYe761IVrcDKK.webp', '2024-12-17 14:33:52', '2024-12-17 14:33:52', NULL),
(22, 8, 'products/image_galleries/vay/GcQoX4zMGjEa3trgK9y3jpUpcatKNxVBkrT0U73p.webp', '2024-12-17 14:41:50', '2024-12-17 14:41:50', NULL),
(23, 8, 'products/image_galleries/vay/rVbxRAyM4BtK0rzKaKI3SEuZGvW8NFwYyED3br0t.webp', '2024-12-17 14:41:50', '2024-12-17 14:41:50', NULL),
(24, 8, 'products/image_galleries/vay/KtFn55KevxwjeVSZv0iRR8Bp2bIC7kjTJHh69AyQ.webp', '2024-12-17 14:41:50', '2024-12-17 14:41:50', NULL),
(25, 8, 'products/image_galleries/vay/WMqrNfFU8sHXgfgVhILRmh21yqtYQEJNjxH85xSU.webp', '2024-12-17 14:41:50', '2024-12-17 14:41:50', NULL),
(26, 8, 'products/image_galleries/vay/OIg8qavd7C2BgCG58EoSbL2x3sQFhxJH50d5dPai.webp', '2024-12-17 14:41:50', '2024-12-17 14:41:50', NULL),
(27, 8, 'products/image_galleries/vay/qeKyvb8HpoJQLe1HJjy41NOoeOKpXTMvwOr6Vicq.webp', '2024-12-17 14:41:50', '2024-12-17 14:41:50', NULL),
(28, 9, 'products/image_galleries/vay/Tt186JK5VxJ9LOvPH0qlDXhJuYll3EBZI6tnxfkp.webp', '2024-12-17 14:50:10', '2024-12-17 14:50:10', NULL),
(29, 10, 'products/image_galleries/vay/BqkrHZR8kMFvHAiQTRmMjvLR5Q137w6leuxic8ZC.jpg', '2024-12-17 14:52:54', '2024-12-17 14:52:54', NULL),
(30, 10, 'products/image_galleries/vay/Rg6pOlZR1wz1RUrLGp63Ys0J5HmJHuQHVo0bRKO7.jpg', '2024-12-17 14:52:54', '2024-12-17 14:52:54', NULL),
(31, 10, 'products/image_galleries/vay/yOcHzpJn8FFnP3Nr3l6g1esO5jJs8lNhBaEMjrWv.jpg', '2024-12-17 14:52:54', '2024-12-17 14:52:54', NULL),
(32, 10, 'products/image_galleries/vay/C7boTqSh2yus18fq4d6AdUDRGRT3nt1Ehby4jAdv.webp', '2024-12-17 14:52:54', '2024-12-17 14:52:54', NULL),
(33, 10, 'products/image_galleries/vay/ASV2cKOmnQGYcrJqXOd5L7w6uAXgNCFocyBdXX8T.webp', '2024-12-17 14:52:54', '2024-12-17 14:52:54', NULL),
(34, 10, 'products/image_galleries/vay/fQWvJPhYvVzmzxv3v2u7ncOP4qJ8TanrK0pOI9i2.jpg', '2024-12-17 14:52:54', '2024-12-17 14:52:54', NULL),
(35, 11, 'products/image_galleries/tui-sach/QNHX2w1sPQVM9tCFbI1S03WbsA2Xrs9Ewdrt6nWe.jpg', '2024-12-17 14:57:28', '2024-12-17 14:57:28', NULL),
(36, 11, 'products/image_galleries/tui-sach/oeLORHeuU0gjaa7Dgz6uq7Ygm2vKZN38mqUSbXQt.jpg', '2024-12-17 14:57:28', '2024-12-17 14:57:28', NULL),
(37, 11, 'products/image_galleries/tui-sach/enj6zCTpTvkRzZJgfWe1fEJ349m3EPD2z8f9KaDJ.jpg', '2024-12-17 14:57:28', '2024-12-17 14:57:28', NULL),
(38, 12, 'products/image_galleries/tui-sach/gwgyRZau8Gd7jpNou0Jqh5badKT8lBSQ2AQ2ZwAH.jpg', '2024-12-17 15:04:29', '2024-12-17 15:04:29', NULL),
(39, 12, 'products/image_galleries/tui-sach/ShVkZimxtxkehIgKYip9QnyQGBilECFtU6feoufY.jpg', '2024-12-17 15:04:29', '2024-12-17 15:04:29', NULL),
(40, 12, 'products/image_galleries/tui-sach/6Gb3fFVYdcPHTlTkTsv5GnnG1SuBCCyLMsQUobOH.jpg', '2024-12-17 15:04:29', '2024-12-17 15:04:29', NULL),
(41, 12, 'products/image_galleries/tui-sach/81LXHTSZ6w1VqNXuzzCMx0hMVaVVV3NZfvNovrTj.webp', '2024-12-17 15:04:29', '2024-12-17 15:04:29', NULL),
(42, 13, 'products/image_galleries/tui-sach/dJJ6U1aeDwLcY3YLQHdutVXzAh8Kzx5w9S2T7mfa.jpg', '2024-12-17 15:07:51', '2024-12-17 15:07:51', NULL),
(43, 13, 'products/image_galleries/tui-sach/LWGcZeFJxpVeuau05GGzKc323Q6oTzRI0CcvY4f9.jpg', '2024-12-17 15:07:51', '2024-12-17 15:07:51', NULL),
(44, 13, 'products/image_galleries/tui-sach/zhO95tA8Kwv00Bwp8DU5ehHEGE8CEJNNtuUo1wH2.webp', '2024-12-17 15:07:51', '2024-12-17 15:07:51', NULL),
(45, 13, 'products/image_galleries/tui-sach/0Q4FrrVT9fErNshnkI7Rs0BS1idRi7At5r452qEd.webp', '2024-12-17 15:07:51', '2024-12-17 15:07:51', NULL),
(46, 14, 'products/image_galleries/tui-sach/QPiCgYpLikznRckdaWxDtn2Tf0ATXLran293nwM7.webp', '2024-12-17 15:12:08', '2024-12-17 15:12:08', NULL),
(47, 14, 'products/image_galleries/tui-sach/kjyh47CYa7w8KDntkCpNNHnYPOSfXghlPebUv2hr.webp', '2024-12-17 15:12:08', '2024-12-17 15:12:08', NULL),
(48, 14, 'products/image_galleries/tui-sach/p7Vi7P2RQF3xxsO3epYD93MbYMvzOKy9ufU3EDJH.webp', '2024-12-17 15:12:08', '2024-12-17 15:12:08', NULL),
(49, 14, 'products/image_galleries/tui-sach/GcMKwgJddYBDchHTByS3eFMH0u6Lllq9wYlNk3oc.jpg', '2024-12-17 15:12:08', '2024-12-17 15:12:08', NULL),
(50, 14, 'products/image_galleries/tui-sach/5RJtF60vHUPqF0IyQamZt0JQMlw0Dlb484or0zfx.jpg', '2024-12-17 15:12:08', '2024-12-17 15:12:08', NULL),
(51, 14, 'products/image_galleries/tui-sach/Nut8CL9Ru21jCl6VBRWidWQUQ1FoHVCwRukvDYBj.jpg', '2024-12-17 15:12:08', '2024-12-17 15:12:08', NULL),
(52, 15, 'products/image_galleries/khong-phan-loai/vGgAWYIXYUSA1kBJLkG3hLsfcHGF6MJaRpPinrHx.webp', '2024-12-18 12:28:42', '2024-12-18 12:28:42', NULL),
(53, 15, 'products/image_galleries/khong-phan-loai/58zi9JTA1kYyCqOFSTYxDSt5yyshuDTc9JePQRpv.webp', '2024-12-18 12:28:42', '2024-12-18 12:28:42', NULL),
(54, 15, 'products/image_galleries/khong-phan-loai/qTLLyQYb2NpFz6Mpb5N1Pbo6z9bkYbqO96jCdtbO.webp', '2024-12-18 12:28:42', '2024-12-18 12:28:42', NULL),
(55, 15, 'products/image_galleries/khong-phan-loai/dahDAuocXTfVbBG3GCOPKQMWab9dgR6C8HvuoXro.webp', '2024-12-18 12:28:42', '2024-12-18 12:28:42', NULL),
(56, 15, 'products/image_galleries/khong-phan-loai/cZinbk8MegMpkf9p5fRuTiI5e2eWkfbu6OXsIPdD.webp', '2024-12-18 12:28:42', '2024-12-18 12:28:42', NULL),
(57, 15, 'products/image_galleries/khong-phan-loai/aFGdhdfoxYiLkThJ6IEPUZssoUjAgtd4qbq67gms.webp', '2024-12-18 12:28:42', '2024-12-18 12:28:42', NULL),
(58, 15, 'products/image_galleries/khong-phan-loai/HTDrcOy3OZerm4m1zPXG7kGjqCpfDNXmH8eUWfLO.webp', '2024-12-18 12:28:42', '2024-12-18 12:28:42', NULL),
(59, 16, 'products/image_galleries/trang-phuc-truyen-thong/kt9CFygu7e1WHxObx0XJjG2QqNBASbBAgtQ4DxhG.webp', '2024-12-18 12:31:39', '2024-12-18 12:31:39', NULL),
(60, 16, 'products/image_galleries/trang-phuc-truyen-thong/DHPWoQItOOAQHErxtpHZjlEo353ytnuOoXV2U9Oj.webp', '2024-12-18 12:31:39', '2024-12-18 12:31:39', NULL),
(61, 16, 'products/image_galleries/trang-phuc-truyen-thong/ajYsAZHdHYUAP6dAQIPrJyeLF72eEahA2ndOdhXh.webp', '2024-12-18 12:31:39', '2024-12-18 12:31:39', NULL),
(62, 16, 'products/image_galleries/trang-phuc-truyen-thong/8cYsI14t7r4YlIXNg39FqroQ1Ljc6KxOn3Vskzsc.webp', '2024-12-18 12:31:39', '2024-12-18 12:31:39', NULL),
(63, 16, 'products/image_galleries/trang-phuc-truyen-thong/xVN54HbyHFXx3DZfB4U8MSq8sKq1mxkWLwJJ1Kya.webp', '2024-12-18 12:31:39', '2024-12-18 12:31:39', NULL),
(64, 16, 'products/image_galleries/trang-phuc-truyen-thong/qDqMskQPquOQpKicRJemIVYps2X2rBtnLNkR6bt4.webp', '2024-12-18 12:31:39', '2024-12-18 12:31:39', NULL),
(65, 17, 'products/image_galleries/trang-phuc-truyen-thong/YqjBumUnkeU7Xdv5n7md4RZwqv118DOs6mMAg2qt.webp', '2024-12-18 12:34:19', '2024-12-18 12:34:19', NULL),
(66, 17, 'products/image_galleries/trang-phuc-truyen-thong/aWJJThNm1e8FeIffeQwjvL8crg93B5hApsyzpBJr.webp', '2024-12-18 12:34:19', '2024-12-18 12:34:19', NULL),
(67, 17, 'products/image_galleries/trang-phuc-truyen-thong/Y0F6niG6Ds5IKmKYC8R1dsTQM2YhOa0d4MgSJpqZ.webp', '2024-12-18 12:34:19', '2024-12-18 12:34:19', NULL),
(68, 17, 'products/image_galleries/trang-phuc-truyen-thong/kRvhYInH2sC9jdfLWRdrfAlArFoOU7gYLWJUKaM1.webp', '2024-12-18 12:34:19', '2024-12-18 12:34:19', NULL),
(69, 18, 'products/image_galleries/trang-phuc-truyen-thong/aG89Oneq80pnk4csJL6ndCudFEhFG5ADTGKih6tD.webp', '2024-12-18 12:36:16', '2024-12-18 12:36:16', NULL),
(70, 18, 'products/image_galleries/trang-phuc-truyen-thong/nqrFv1ZjkkG9rlwAt1QsJDbfffTsTpMqOsQkdzwZ.webp', '2024-12-18 12:36:16', '2024-12-18 12:36:16', NULL),
(71, 18, 'products/image_galleries/trang-phuc-truyen-thong/uQmXbtTWSJXovws7CyHrihZ9mQ2K7zSOJbDeGJmf.webp', '2024-12-18 12:36:16', '2024-12-18 12:36:16', NULL),
(72, 18, 'products/image_galleries/trang-phuc-truyen-thong/aeyM9x9SQk6ja8Jb8ss3ONJV4hrWzre016Nw1Jfn.webp', '2024-12-18 12:36:16', '2024-12-18 12:36:16', NULL),
(73, 19, 'products/image_galleries/trang-phuc-truyen-thong/SEWp48pWnK6TI6qefJECowB5Iqph5MNJVF1AfkCm.webp', '2024-12-18 12:38:43', '2024-12-18 12:38:43', NULL),
(74, 19, 'products/image_galleries/trang-phuc-truyen-thong/ngzWNpYKIUENnyVmtpkyGgJ6b5zXkS7bFJSshTrw.webp', '2024-12-18 12:38:43', '2024-12-18 12:38:43', NULL),
(75, 19, 'products/image_galleries/trang-phuc-truyen-thong/OFWAox6uNbJ3PgowZw7l57LNvvDz8exIz0P82vJe.webp', '2024-12-18 12:38:43', '2024-12-18 12:38:43', NULL),
(76, 19, 'products/image_galleries/trang-phuc-truyen-thong/ygRyvo4D1BoKZLNO3Sq2nNxAauNg1AxtGsFJbCpn.webp', '2024-12-18 12:38:43', '2024-12-18 12:38:43', NULL),
(77, 19, 'products/image_galleries/trang-phuc-truyen-thong/ZqDqnnpSiufL78nsJJYfbmZrSXvQWhPD9RZwRX1J.webp', '2024-12-18 12:38:43', '2024-12-18 12:38:43', NULL),
(78, 19, 'products/image_galleries/trang-phuc-truyen-thong/rmo9wATrlsHnkbDCVXYPsHLp3ixml7CJluZ1wIsG.webp', '2024-12-18 12:38:43', '2024-12-18 12:38:43', NULL),
(79, 20, 'products/image_galleries/trang-phuc-truyen-thong/je8XTcuFfzqER8s7mzUWP648iVAgRmZSrGUeZIDz.webp', '2024-12-18 12:41:30', '2024-12-18 12:41:30', NULL),
(80, 20, 'products/image_galleries/trang-phuc-truyen-thong/UmO0tzbabKViRACBrkD8TTwa6BBrL2JCjp9C4293.webp', '2024-12-18 12:41:30', '2024-12-18 12:41:30', NULL),
(81, 20, 'products/image_galleries/trang-phuc-truyen-thong/62cGieJpIjJYVlwrz1BpPwHyEh7ZqvsHgZdUs3vY.webp', '2024-12-18 12:41:30', '2024-12-18 12:41:30', NULL),
(82, 20, 'products/image_galleries/trang-phuc-truyen-thong/w9BSzFPQBCBdRavVbjLMwFknxz4XjRAvxcNwAxVz.webp', '2024-12-18 12:41:30', '2024-12-18 12:41:30', NULL),
(83, 21, 'products/image_galleries/khong-phan-loai/0IiE4ZfxB04ThXDUKjUjEgSeaCJi62r89ODZdquw.webp', '2024-12-18 12:44:45', '2024-12-18 12:44:45', NULL),
(84, 21, 'products/image_galleries/khong-phan-loai/u1lEPmTpyRZZYXZ9kqcYexHlM4uQ6rspTcqfKPwz.webp', '2024-12-18 12:44:45', '2024-12-18 12:44:45', NULL),
(85, 21, 'products/image_galleries/khong-phan-loai/StzCFPYdi7gDxJ2KvG5ZGdob9HxvUB1TQIQmtDxn.webp', '2024-12-18 12:44:45', '2024-12-18 12:44:45', NULL),
(86, 21, 'products/image_galleries/khong-phan-loai/wWnmbjziqI0C2CknFKkkdlXUaHUnDEeabx2dT6Dt.webp', '2024-12-18 12:44:45', '2024-12-18 12:44:45', NULL),
(87, 22, 'products/image_galleries/khong-phan-loai/HWtRbeQqGHhPpvG5Q74LCDXzCgsph3y1OxgTANh4.webp', '2024-12-18 12:48:23', '2024-12-18 12:48:23', NULL),
(88, 22, 'products/image_galleries/khong-phan-loai/4JMi3g8qS0bh8r5wFyuOmX39FhKu6nWxOMN7SFUX.webp', '2024-12-18 12:48:23', '2024-12-18 12:48:23', NULL),
(89, 22, 'products/image_galleries/khong-phan-loai/cRNLCzApeDaQPAmaDrTAolxsqXt03H3dTgDh3poG.webp', '2024-12-18 12:48:23', '2024-12-18 12:48:23', NULL),
(90, 22, 'products/image_galleries/khong-phan-loai/PNpSo4PyH2UzmMoEED8B64pyiPIrZGBwwcufNEs3.webp', '2024-12-18 12:48:23', '2024-12-18 12:48:23', NULL),
(91, 22, 'products/image_galleries/khong-phan-loai/sFjCm2B06XrMEIgOIlzSSp2ckCzVpor4MSIixl15.webp', '2024-12-18 12:48:23', '2024-12-18 12:48:23', NULL),
(92, 22, 'products/image_galleries/khong-phan-loai/p01AEX6k2XCPGUZekuGq1lCrdwhHGgCfG9uJELrn.webp', '2024-12-18 12:48:23', '2024-12-18 12:48:23', NULL),
(93, 22, 'products/image_galleries/khong-phan-loai/KHlCvOKjY8UJgbdwYfcf4RCMS5PQnYBfmeV1LM3h.webp', '2024-12-18 12:48:23', '2024-12-18 12:48:23', NULL),
(94, 22, 'products/image_galleries/khong-phan-loai/vQEn5DCRVCmS6kTwoqKsPn9xH6L4ouF1XKNJhLj9.webp', '2024-12-18 12:48:23', '2024-12-18 12:48:23', NULL),
(95, 23, 'products/image_galleries/khong-phan-loai/qjJaheMyD3Sl7kaQXH7IXulpYKRZ3GYNdPvEFfqX.webp', '2024-12-18 12:50:12', '2024-12-18 12:50:12', NULL),
(96, 23, 'products/image_galleries/khong-phan-loai/hyWkKa1JxlvHRnoIaqldNG11cHfaizfm44g0E6Pv.webp', '2024-12-18 12:50:12', '2024-12-18 12:50:12', NULL),
(97, 23, 'products/image_galleries/khong-phan-loai/fJbnXsONpB1IIn8Nm5zSCLxrd3lrop2pRvA0pcSQ.webp', '2024-12-18 12:50:12', '2024-12-18 12:50:12', NULL),
(98, 23, 'products/image_galleries/khong-phan-loai/oORl0yDeCQkUpx1FdzfI8nZtuoYMtrnLZNwwtr3o.webp', '2024-12-18 12:50:12', '2024-12-18 12:50:12', NULL),
(99, 24, 'products/image_galleries/khong-phan-loai/VDlEevx7VFosnE0soNFFUSQMrZj5th8zKU3BsBCN.webp', '2024-12-18 12:52:37', '2024-12-18 12:52:37', NULL),
(100, 24, 'products/image_galleries/khong-phan-loai/vZwvUNkHHM1b5lDcp3hrhcJJagQQiERGgTcJFgdK.webp', '2024-12-18 12:52:37', '2024-12-18 12:52:37', NULL),
(101, 24, 'products/image_galleries/khong-phan-loai/nOt6M6tBWZRk9VRUtnyBp89CkozrSFaoTmCt6r07.webp', '2024-12-18 12:52:37', '2024-12-18 12:52:37', NULL),
(102, 24, 'products/image_galleries/khong-phan-loai/A6zLf75S9JSrEUZT03MyZcckTZqCJikXMxcKm2SS.webp', '2024-12-18 12:52:37', '2024-12-18 12:52:37', NULL),
(103, 24, 'products/image_galleries/khong-phan-loai/Pz0Dk1dHbHjb9KqQZi30qoDOkgUOd57sV2xO9xWD.webp', '2024-12-18 12:52:37', '2024-12-18 12:52:37', NULL),
(104, 24, 'products/image_galleries/khong-phan-loai/VmyOWDLCt0XVqwoo6HoBjkhz5L63WP8QtJRot77D.webp', '2024-12-18 12:52:37', '2024-12-18 12:52:37', NULL),
(105, 24, 'products/image_galleries/khong-phan-loai/P2r6Vpte2YnNRrvDh6gUALjGWMB31EJw9aFTnT7d.webp', '2024-12-18 12:52:37', '2024-12-18 12:52:37', NULL),
(106, 25, 'products/image_galleries/khong-phan-loai/5F5TNmdp0oJoZosbus1X8N36mu6nlDQiOpVw0Fxb.jpg', '2024-12-18 12:54:28', '2024-12-18 12:54:28', NULL),
(107, 25, 'products/image_galleries/khong-phan-loai/jMknTBT2SXLfTOL8z0vsGoAKwt0IJh6xXBL1bh0r.jpg', '2024-12-18 12:54:28', '2024-12-18 12:54:28', NULL),
(108, 25, 'products/image_galleries/khong-phan-loai/npSCBeWk5WXp1PT8YyEFrckiqYSKAN6Ovu77Nat1.jpg', '2024-12-18 12:54:28', '2024-12-18 12:54:28', NULL),
(109, 25, 'products/image_galleries/khong-phan-loai/j1S5y5aYvT3Gg3yiAP5ctT8ROXYB92EYE37IT2lS.jpg', '2024-12-18 12:54:28', '2024-12-18 12:54:28', NULL),
(110, 26, 'products/image_galleries/khong-phan-loai/4GHRyKXGJI2PsjqYB7aZltNAbNkrAw6wPVss9gxL.webp', '2024-12-18 12:55:49', '2024-12-18 12:55:49', NULL),
(111, 26, 'products/image_galleries/khong-phan-loai/MClsBGQHpQPLCDVTPQFGpStUjiXFuqTphRvWxpQv.webp', '2024-12-18 12:55:49', '2024-12-18 12:55:49', NULL),
(112, 26, 'products/image_galleries/khong-phan-loai/1t5oTbvo0gYLIUTX2i4HPgW0ttESZ5BiecNkvyOu.webp', '2024-12-18 12:55:49', '2024-12-18 12:55:49', NULL),
(113, 26, 'products/image_galleries/khong-phan-loai/NHMSRuzlFvWencXlxV0GZn8LvGMN3rxTjfqh43u8.webp', '2024-12-18 12:55:49', '2024-12-18 12:55:49', NULL),
(114, 27, 'products/image_galleries/khong-phan-loai/F5ow6IGFXOhXwpaScw61zr5sCTQzEIlIfubVXWSP.webp', '2024-12-18 12:58:23', '2024-12-18 12:58:23', NULL),
(115, 27, 'products/image_galleries/khong-phan-loai/n7GGvWxfpjA4VvoKjiSDlnCcHwWRY5QNf05PbNvN.webp', '2024-12-18 12:58:23', '2024-12-18 12:58:23', NULL),
(116, 27, 'products/image_galleries/khong-phan-loai/j5xePC2iNbtB2VR36So4VAJg69gml1GI6oz5Isqj.webp', '2024-12-18 12:58:23', '2024-12-18 12:58:23', NULL),
(117, 27, 'products/image_galleries/khong-phan-loai/fsGlMvJg6UO4iod3O9imUSiQpWTHBZuM2hhoHnLM.webp', '2024-12-18 12:58:23', '2024-12-18 12:58:23', NULL),
(118, 29, 'products/image_galleries/khong-phan-loai/kYJumNMyPUjdKljgiAExlmH2guULqLd8u0L29KgM.webp', '2024-12-18 13:05:24', '2024-12-18 13:05:24', NULL),
(119, 29, 'products/image_galleries/khong-phan-loai/IRRADI8qbf1Xuc8n55LQiJDuiOPnqlzML3JtJbCD.webp', '2024-12-18 13:05:24', '2024-12-18 13:05:24', NULL),
(120, 29, 'products/image_galleries/khong-phan-loai/kXTsP28SOBh2upwT3UBuOVUL5Ny0Yj4oMhpYuCmh.webp', '2024-12-18 13:05:24', '2024-12-18 13:05:24', NULL),
(121, 29, 'products/image_galleries/khong-phan-loai/NCUGGEQmATAcRu09IvZlP1r70QoCbfDxLhVFF0QT.webp', '2024-12-18 13:05:24', '2024-12-18 13:05:24', NULL),
(122, 29, 'products/image_galleries/khong-phan-loai/qTvTEfoV7zwVLyiuZdo8dpFFnhCAhNUXqbR4yMJ7.webp', '2024-12-18 13:05:24', '2024-12-18 13:05:24', NULL),
(123, 29, 'products/image_galleries/khong-phan-loai/1Hd8ksQOJ3IPPgaYBizuHIuRVwgEWhvuBZKkahlk.webp', '2024-12-18 13:05:24', '2024-12-18 13:05:24', NULL),
(124, 30, 'products/image_galleries/khong-phan-loai/AGVAJdpUQdUJPyYFDg13tngmdguq1uSFcpVLX7Yh.png', '2024-12-18 17:45:44', '2024-12-18 17:45:44', NULL),
(125, 30, 'products/image_galleries/khong-phan-loai/ftA8m2mYgrswvmC68kJUOz1jJ8cZ9eNzjFcJjhJm.png', '2024-12-18 17:45:44', '2024-12-18 17:45:44', NULL),
(126, 31, 'products/image_galleries/khong-phan-loai/75JgsFwMohysNhsYIBRqYOMMGA9XOw37ofaxIMcD.jpg', '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(127, 31, 'products/image_galleries/khong-phan-loai/uYZyRzHUonOo2J6JU9tmVxLLXtRm7k3vJKee5v54.jpg', '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(128, 31, 'products/image_galleries/khong-phan-loai/SBf2sXDqoQI0TgG2uwNXRCMbZtepp1sUQ25bfLQI.jpg', '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(129, 31, 'products/image_galleries/khong-phan-loai/PKcqNjSlmzUld3jkvp9jkRKPHe06WXwqFcFoBc4C.jpg', '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(130, 31, 'products/image_galleries/khong-phan-loai/6sL3bL1MZXRsRjvlkjx2GgmvRcokxT4ukAK5c6FA.jpg', '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(131, 31, 'products/image_galleries/khong-phan-loai/Qd6dmCVtFUXR8hrcxff9P4Gr3r7T1tg5b6dVDCD8.jpg', '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(132, 31, 'products/image_galleries/khong-phan-loai/qEJz6bZ9Df5ROEX5HLCHAAk1F12E22u9A5QHnm9r.jpg', '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(133, 31, 'products/image_galleries/khong-phan-loai/gqJukCLLfeKuCYfSO9SKgveAgnK8cceGC1kPfWnj.jpg', '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(134, 32, 'products/image_galleries/khong-phan-loai/aXoFlzcrAguZMAj41Xe9zSGu0TiiyECsAjv581V2.png', '2024-12-18 17:59:20', '2024-12-18 17:59:20', NULL),
(135, 32, 'products/image_galleries/khong-phan-loai/1WhUM5b4vPZ9R4fWOZqp2bpJXuoybuU5KU2T5xVF.png', '2024-12-18 17:59:20', '2024-12-18 17:59:20', NULL),
(136, 32, 'products/image_galleries/khong-phan-loai/pqkFMalUpuwE9l8pV9vBqSvMvZYfMb4n9KT9NGUl.png', '2024-12-18 17:59:20', '2024-12-18 17:59:20', NULL),
(137, 33, 'products/image_galleries/khong-phan-loai/xkl1Nz9ZlF5nJB0NKA6bgpI2uN3xq4eVbDSgUNLb.jpg', '2024-12-18 20:00:30', '2024-12-18 20:00:30', NULL),
(138, 33, 'products/image_galleries/khong-phan-loai/1Y0JqNuGAbG6LXPLeI5xZb6mObXz3A0UDcX12jfr.jpg', '2024-12-18 20:00:30', '2024-12-18 20:00:30', NULL),
(139, 33, 'products/image_galleries/khong-phan-loai/nzkzo3bRtnSF1OIuATvdNuYTxGR4HOihFFe536eD.jpg', '2024-12-18 20:00:30', '2024-12-18 20:00:30', NULL),
(140, 33, 'products/image_galleries/khong-phan-loai/XlGsfgc7ifECvcta5v3zkKxt0L5F1YLRAJuyloaI.jpg', '2024-12-18 20:00:30', '2024-12-18 20:00:30', NULL),
(141, 33, 'products/image_galleries/khong-phan-loai/94vzcdqIRjbhxboS91fDlyOnPn16jDb360GMzH6J.jpg', '2024-12-18 20:00:30', '2024-12-18 20:00:30', NULL),
(142, 33, 'products/image_galleries/khong-phan-loai/yccGmZAkSWv0d71v3VUmj9TrDWNzJ3TwZqaHcvqw.jpg', '2024-12-18 20:00:30', '2024-12-18 20:00:30', NULL),
(143, 33, 'products/image_galleries/khong-phan-loai/bN4hEhIEA9NbxwH9LbLr3PPuz6D5O3QG5tyA8UK9.jpg', '2024-12-18 20:00:30', '2024-12-18 20:00:30', NULL),
(144, 34, 'products/image_galleries/khong-phan-loai/sBhlwkzjgN7lXyzQRs0NWio0lYBfKyAlhfmHtC7p.jpg', '2024-12-18 20:13:41', '2024-12-18 20:13:41', NULL),
(145, 35, 'products/image_galleries/khong-phan-loai/z6zn3psudpEWu7rW2t4Tijjs7dvHSy9PlvcQha9V.jpg', '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(146, 35, 'products/image_galleries/khong-phan-loai/ltYIQz24mLREcYBJwPDxSOx7rC0cEKNgisNC0j7T.jpg', '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(147, 35, 'products/image_galleries/khong-phan-loai/vFBakcg0V96inofJSjPRBtXHeXfvBFggdxVrJWyB.jpg', '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(148, 35, 'products/image_galleries/khong-phan-loai/tpWyAWe4WYXDm53dSjjrCpk1tbBlZ3fLF0IeP6ku.jpg', '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(149, 35, 'products/image_galleries/khong-phan-loai/RqRzJVVi3a3wjCMyoAIKnmYQ8NhSfnB5wKW6ITPX.jpg', '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(150, 35, 'products/image_galleries/khong-phan-loai/QZa1plg3kPwKqAfPIIDLREMdssU3BjFI9N6jEimV.jpg', '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(151, 35, 'products/image_galleries/khong-phan-loai/p5mNLAaQNx8uxx2LXtetWIirFq2at50FBb9FrsaZ.jpg', '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(152, 35, 'products/image_galleries/khong-phan-loai/oHnBwaEFqdSrVLyVwOgI9TW40nIHm5sRZa6Bw8TY.jpg', '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(153, 35, 'products/image_galleries/khong-phan-loai/vVOAnDzq3T5bp4ie05gUSpIAGnbKuOgEeURwx0CW.jpg', '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(154, 35, 'products/image_galleries/khong-phan-loai/oovCuB6zFP3P9SgQ43Yu7Kpv5FDxIC0qMkTJvYK6.jpg', '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(155, 36, 'products/image_galleries/khong-phan-loai/iW2yEROYl6ecQU4OQJqbfRt9RvA6IEmQKXDwnkBZ.jpg', '2024-12-18 20:21:49', '2024-12-18 20:21:49', NULL),
(156, 36, 'products/image_galleries/khong-phan-loai/Kw4ToCyIXPKq8WKwvdWewELT10j0C6OhJzNPJUPs.jpg', '2024-12-18 20:21:49', '2024-12-18 20:21:49', NULL),
(157, 36, 'products/image_galleries/khong-phan-loai/OpiyCohwKISaSRWr7tKDehhIlFdzZARRWCSHMILW.jpg', '2024-12-18 20:21:49', '2024-12-18 20:21:49', NULL),
(158, 36, 'products/image_galleries/khong-phan-loai/Z28HV8vXJ5ZGmh80z78tjXX59NJtVpnLALxyo7cv.jpg', '2024-12-18 20:21:49', '2024-12-18 20:21:49', NULL),
(159, 36, 'products/image_galleries/khong-phan-loai/DM77yXOQ3xWm9bZGscQp8rngXW6MTzR2cY2gSgQq.jpg', '2024-12-18 20:21:49', '2024-12-18 20:21:49', NULL),
(160, 36, 'products/image_galleries/khong-phan-loai/k8oD8v0nZsCBMPyIKhxYw63n3uE3746a4fAX72on.jpg', '2024-12-18 20:21:49', '2024-12-18 20:21:49', NULL),
(161, 36, 'products/image_galleries/khong-phan-loai/wpTuHnHJU6YH8GLg9cpjOWiMsviUwMOyJXX2g2zd.jpg', '2024-12-18 20:21:49', '2024-12-18 20:21:49', NULL),
(162, 36, 'products/image_galleries/khong-phan-loai/dSFaQ5OHya4E1EdRgd75sIHiesWiYLgKc7dlgu3b.jpg', '2024-12-18 20:21:49', '2024-12-18 20:21:49', NULL),
(163, 36, 'products/image_galleries/khong-phan-loai/ZUYbxqmugCtlD5wD82BagsEg8ZAGMNavkrcTzr1K.jpg', '2024-12-18 20:21:49', '2024-12-18 20:21:49', NULL),
(164, 36, 'products/image_galleries/khong-phan-loai/cljLSPf0OIwRgbNGa6Lny68zeBGldymWbL6Snowd.jpg', '2024-12-18 20:21:50', '2024-12-18 20:21:50', NULL),
(165, 36, 'products/image_galleries/khong-phan-loai/IKVUyG4pWfhaivkUgRaaDHYG66V4QTQGffUJ12Ho.jpg', '2024-12-18 20:21:50', '2024-12-18 20:21:50', NULL),
(166, 37, 'products/image_galleries/khong-phan-loai/FgxS47OyMyJBSjKrM3868d41woWEw6eFONKOQZs7.jpg', '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(167, 37, 'products/image_galleries/khong-phan-loai/tDX0htq4UcOsNlo08050Loi5oreOPZISVV1q5Hia.jpg', '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(168, 37, 'products/image_galleries/khong-phan-loai/22mNUUZiaFE2T87BfIzanFytQLdyjf8GwKyhJUUA.jpg', '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(169, 37, 'products/image_galleries/khong-phan-loai/jXP28jOVdIQouOwOwHzAG2xQyOz0KNtPA8OrNG80.jpg', '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(170, 37, 'products/image_galleries/khong-phan-loai/7PrprBz6UUQ5CfdF3TbIFanuk2Eyv7UG9jYMTsU2.jpg', '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(171, 37, 'products/image_galleries/khong-phan-loai/kbvSP8YgTxRl1y10dZjd7PUCHwY0LOqelJSlmAMy.jpg', '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(172, 37, 'products/image_galleries/khong-phan-loai/6opVnihdjM6VPj6VljI2JqkCpM85FfY4SUYBeIIh.jpg', '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(173, 37, 'products/image_galleries/khong-phan-loai/ZqhuQK64hehaRhNkM9GEvUdzerclMYGiBRsgirqw.jpg', '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(174, 37, 'products/image_galleries/khong-phan-loai/uT4Wl42DqoWFuCpPWZWCfdYrUEIFpPTgRp1z9ZiA.jpg', '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(175, 38, 'products/image_galleries/khong-phan-loai/K2J60Y07u73nkdlF03TTfjrHToI5WqACszwO1ROU.jpg', '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL),
(176, 38, 'products/image_galleries/khong-phan-loai/LPbwjp58uxOtAV7InzRjJxHInIWonB1Mlsoh4fdh.jpg', '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL),
(177, 38, 'products/image_galleries/khong-phan-loai/KYyWXfiua82bqwxs8FmzqMxuKdhtdDiCQfPOuTKT.jpg', '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL),
(178, 38, 'products/image_galleries/khong-phan-loai/l3kfQJyBkJCh7YX9LUUnD16wlWLT1nM8TJSkKp3E.jpg', '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL),
(179, 38, 'products/image_galleries/khong-phan-loai/8qvKdN61jKGKhwwltFrgi6zRXmiLr3cplXa2ifln.jpg', '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL),
(180, 38, 'products/image_galleries/khong-phan-loai/QoJRxaEdjq0OUsGWsEwh1pWQyptRr5MA1QzEiLBb.jpg', '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL),
(181, 38, 'products/image_galleries/khong-phan-loai/6HTzpM6AHMjdhyfD4Bt71MEOuyKUGrdm4LHaQicq.jpg', '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL),
(182, 38, 'products/image_galleries/khong-phan-loai/SoW5ksz4s75MfejShEYX7OSQ5z7VDdxQ8gmOOV5B.jpg', '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL),
(183, 38, 'products/image_galleries/khong-phan-loai/ke2in3gkpjMcuoi5ysT9Fk9AIMaTjKel8JU2Ed9C.jpg', '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL),
(184, 39, 'products/image_galleries/khong-phan-loai/6uNMt2T2swLMXvTK8yIcEghXR28PDjmZbsf1lq3y.jpg', '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(185, 39, 'products/image_galleries/khong-phan-loai/zhL1wLo0iG95OjY1EwDny7DuLQ4O0J445UvH0RtO.jpg', '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(186, 39, 'products/image_galleries/khong-phan-loai/zIpBqB6THwYqSNN48q8SswadI88BCezqNpE1mxi4.jpg', '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(187, 39, 'products/image_galleries/khong-phan-loai/Ec2tcPrN7a42PMiHcN13ctmH54wsk0ZLGGTL3Ldz.jpg', '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(188, 39, 'products/image_galleries/khong-phan-loai/by6iAUWAlBTguDAaeswkU88pa8R66lKNkh0v8OCy.jpg', '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(189, 39, 'products/image_galleries/khong-phan-loai/BlTD1lRVyYbUCX7D5EdFBAhlp5AmFTmU0cqMZCip.jpg', '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(190, 39, 'products/image_galleries/khong-phan-loai/HBziBn0IB1OYD1cxl9Wb5YnKHxiKxNKmZi8YS1wu.jpg', '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(191, 39, 'products/image_galleries/khong-phan-loai/Tr0Ie8BCNsgpQRan7YYONb94PkGsI0tBLOngEB16.jpg', '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(192, 39, 'products/image_galleries/khong-phan-loai/guaWBdSC5xjW6YZCtGclFWzSquScbC8Zw1ZKispj.jpg', '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(193, 39, 'products/image_galleries/khong-phan-loai/N49Z9fHLkhWFygbpSR2gJuhT91G2uvjuHCa9Q3D6.jpg', '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(194, 39, 'products/image_galleries/khong-phan-loai/YBumbJgbXf9bZlH4bMzuJNTUEkYf0KVoHhkhQAP7.jpg', '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(195, 40, 'products/image_galleries/khong-phan-loai/tCVyvXJHG1nBeQ91IME9Ewh2D2budT3mtUZqHpVY.jpg', '2024-12-18 20:40:01', '2024-12-18 20:40:01', NULL),
(196, 40, 'products/image_galleries/khong-phan-loai/0XumgMoUHIoneJccEfJTMMPvjQCXl1ICzEqeGzZK.jpg', '2024-12-18 20:40:01', '2024-12-18 20:40:01', NULL),
(197, 40, 'products/image_galleries/khong-phan-loai/c4hQoPKU899V78zNzFIHEYrq3OGgW3GbLpLeEGXH.jpg', '2024-12-18 20:40:01', '2024-12-18 20:40:01', NULL),
(198, 40, 'products/image_galleries/khong-phan-loai/irrElgzRG75p6i1Fz5jlP1GVVhJadtF3QzDFA3bX.jpg', '2024-12-18 20:40:01', '2024-12-18 20:40:01', NULL),
(199, 40, 'products/image_galleries/khong-phan-loai/4k0FzsWEFiXSLcJdPk4hdDTEf8wkgtwRUdKCpeV1.jpg', '2024-12-18 20:40:01', '2024-12-18 20:40:01', NULL),
(200, 40, 'products/image_galleries/khong-phan-loai/tcuFJ5ihtZo5r8jpQegNbe41JzBvo6suNMFH6P2S.jpg', '2024-12-18 20:40:01', '2024-12-18 20:40:01', NULL),
(201, 40, 'products/image_galleries/khong-phan-loai/3k3v9DxKDnT5WrxCX7KLJZTObgA5F5NLJyxvCLes.jpg', '2024-12-18 20:40:01', '2024-12-18 20:40:01', NULL),
(202, 40, 'products/image_galleries/khong-phan-loai/ROSKOd9yG1tRVgJGKIUDVKt9zvoKoXHnPv1JtwJg.jpg', '2024-12-18 20:40:02', '2024-12-18 20:40:02', NULL),
(203, 40, 'products/image_galleries/khong-phan-loai/66SmZjhqE1OlBS3uKw1lhHrq9kiev7k7zVmfQda1.jpg', '2024-12-18 20:40:02', '2024-12-18 20:40:02', NULL),
(204, 40, 'products/image_galleries/khong-phan-loai/UcduUpHOk8UHOrzcULqgDrG6lvMwj5xgOJGE1SOb.jpg', '2024-12-18 20:40:02', '2024-12-18 20:40:02', NULL),
(205, 41, 'products/image_galleries/khong-phan-loai/J2aKrGgC4C0FucMGSHcWcPmTFn6BkYMH0a7QQtFC.jpg', '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(206, 41, 'products/image_galleries/khong-phan-loai/keeD8U6bYj7DnltKSmyyHug1KrApsMi3vZpHs0wR.jpg', '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(207, 41, 'products/image_galleries/khong-phan-loai/IT2fsHf5Sg1FxLLUxX1yhughMs349cT7ILtNUEq9.jpg', '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(208, 41, 'products/image_galleries/khong-phan-loai/wMktdBWWtI7RuNdgFRqIkxlpamxej8VY0wdUqzsc.jpg', '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(209, 41, 'products/image_galleries/khong-phan-loai/zMvkvk3Jxf1jK8azi0Kreqn0FxcOhSNxjxmNtaoV.jpg', '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(210, 41, 'products/image_galleries/khong-phan-loai/UQBMgMtcM9dNKrp6x89LWrWLrWlqDRuVRIHGXdaG.jpg', '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(211, 41, 'products/image_galleries/khong-phan-loai/D50zUS5ToyGdWSnkBevd3fOP3GpNpCJxqWPyci2J.jpg', '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(212, 41, 'products/image_galleries/khong-phan-loai/vpMji3xC09sRID6CPkwVlHMyeoUOIKSPZQ9spUoI.jpg', '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(213, 41, 'products/image_galleries/khong-phan-loai/k7IvDO107ryEHjbHuPAgSEdZKRV5CjyiWnCglwk7.jpg', '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(214, 41, 'products/image_galleries/khong-phan-loai/UfskqPkbBD0l5OIwBrOml9yJpa5kLXhaNo93c1Rw.jpg', '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(215, 41, 'products/image_galleries/khong-phan-loai/wGTshk7vQY7noFVlwNm8STfvIhpA4KjzMKFnWn8t.jpg', '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(216, 41, 'products/image_galleries/khong-phan-loai/shPisANlOUK2SRo6pdOSkQyEQlWynbR1Kz8LkpSO.jpg', '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(217, 41, 'products/image_galleries/khong-phan-loai/8clLPVu73YOiHQR33zpRyol6W2TFkjR1wsCYZjNC.jpg', '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(218, 42, 'products/image_galleries/khong-phan-loai/EUDmzK4JB7RNK0V9gkTvQJxFU6VnnID8Z4QDlXO9.jpg', '2024-12-18 20:44:58', '2024-12-18 20:44:58', NULL),
(219, 42, 'products/image_galleries/khong-phan-loai/SNBM8uR16z11Gg4vPw5JgjaLWu0f0iihhI8OPATz.jpg', '2024-12-18 20:44:58', '2024-12-18 20:44:58', NULL),
(220, 42, 'products/image_galleries/khong-phan-loai/rxyLWpIACeFTQSUEzWVHjPCVHPp6PgeNnCmOlsDE.jpg', '2024-12-18 20:44:58', '2024-12-18 20:44:58', NULL),
(221, 42, 'products/image_galleries/khong-phan-loai/Yp7w8beNo9oArxMc07VlgJUJ7G9K2Tf0YScxOe3q.jpg', '2024-12-18 20:44:58', '2024-12-18 20:44:58', NULL),
(222, 42, 'products/image_galleries/khong-phan-loai/djCx8iayVBQJdhBDoJhAy6afSnlFuDlzYvV4vFJf.jpg', '2024-12-18 20:44:58', '2024-12-18 20:44:58', NULL),
(223, 42, 'products/image_galleries/khong-phan-loai/VfJfAGZbkeYPi2c43kjJG4eQ110sKt0a99Km4DDs.jpg', '2024-12-18 20:44:58', '2024-12-18 20:44:58', NULL),
(224, 42, 'products/image_galleries/khong-phan-loai/yS9sLmbpLcAA1cmoiayKfcWukKjEfRLkSmtDnyPB.jpg', '2024-12-18 20:44:58', '2024-12-18 20:44:58', NULL),
(225, 42, 'products/image_galleries/khong-phan-loai/ZNU7JmhVsPhiSYyRzcngXbxofOhf1dSZdHvdozFV.jpg', '2024-12-18 20:44:58', '2024-12-18 20:44:58', NULL),
(226, 42, 'products/image_galleries/khong-phan-loai/ZMrc2MjTrTavOCfo6PNgkU4AeFLPq31MeODOMeTY.jpg', '2024-12-18 20:44:58', '2024-12-18 20:44:58', NULL),
(227, 42, 'products/image_galleries/khong-phan-loai/xPTwSNEHOrDEjLBL1H3yFCsFBfimcrooZUY9rQlH.jpg', '2024-12-18 20:44:58', '2024-12-18 20:44:58', NULL),
(228, 43, 'products/image_galleries/trang-phuc-truyen-thong/MNaITlvk6h89qQU7UMnncVE4rQVRvQVwpDraWfPQ.webp', '2024-12-19 02:23:46', '2024-12-19 02:23:46', NULL),
(229, 43, 'products/image_galleries/trang-phuc-truyen-thong/DQ55mGh4QMBLjC346I6gXKeLtBqaizW30YN98utE.webp', '2024-12-19 02:23:46', '2024-12-19 02:23:46', NULL),
(230, 43, 'products/image_galleries/trang-phuc-truyen-thong/ajShaF6YdsASba5N8hKrZfWnH203HyhQuo7HBdja.webp', '2024-12-19 02:23:46', '2024-12-19 02:23:46', NULL),
(231, 43, 'products/image_galleries/trang-phuc-truyen-thong/TAycSeFJYu0Ml2EqyQjINuZkECnRm0OBabwCD2ug.webp', '2024-12-19 02:23:46', '2024-12-19 02:23:46', NULL),
(232, 44, 'products/image_galleries/khong-phan-loai/ua4Cl5JMbkR9OPgwfOwZY6z9buFfcgF32177QSP6.webp', '2024-12-19 02:26:46', '2024-12-19 02:26:46', NULL),
(233, 44, 'products/image_galleries/khong-phan-loai/isnN6CEjPb7pbANCOC7N0ZBSzSTAxgPsGKDf04XC.webp', '2024-12-19 02:26:46', '2024-12-19 02:26:46', NULL),
(234, 44, 'products/image_galleries/khong-phan-loai/7N0nyKa7KrMXf4UcuCmuKO3Su3JwWwP6OyXY8vmW.webp', '2024-12-19 02:26:46', '2024-12-19 02:26:46', NULL),
(235, 44, 'products/image_galleries/khong-phan-loai/ndULSaHl644w0zPLcXntRNPQ4mt0AAQnU9Xlv6YU.webp', '2024-12-19 02:26:46', '2024-12-19 02:26:46', NULL),
(236, 45, 'products/image_galleries/khong-phan-loai/Se42KR1QLRTHmGvortHJhq1J4BozZEN9L1rywJu0.webp', '2024-12-19 02:29:57', '2024-12-19 02:29:57', NULL),
(237, 45, 'products/image_galleries/khong-phan-loai/WPDWXqQEU1JhxSVN9LFdxKvc6QWEBiuP4jrEkfR4.webp', '2024-12-19 02:29:57', '2024-12-19 02:29:57', NULL),
(238, 45, 'products/image_galleries/khong-phan-loai/rsrFUd9acNqoc61aOt45W2m0GHcyMAijUgYg715S.webp', '2024-12-19 02:29:57', '2024-12-19 02:29:57', NULL),
(239, 46, 'products/image_galleries/khong-phan-loai/Rdute2yiSROHAnwmPgSxpliVI4aYN9MKRgONfTXS.webp', '2024-12-19 02:34:52', '2024-12-19 02:34:52', NULL),
(240, 46, 'products/image_galleries/khong-phan-loai/0rsxA2o8dDY0ukbKUEeF33aBs8i7mzzqBrQWBIVo.webp', '2024-12-19 02:34:52', '2024-12-19 02:34:52', NULL),
(241, 46, 'products/image_galleries/khong-phan-loai/VOcii42gKHOo5n5339f7oatAygkngIEtU6qNjGnI.webp', '2024-12-19 02:34:52', '2024-12-19 02:34:52', NULL),
(242, 46, 'products/image_galleries/khong-phan-loai/EdEQJvPQxIn98NLmyxDkJHEX6P3E7xWrzQhv9bup.webp', '2024-12-19 02:34:52', '2024-12-19 02:34:52', NULL),
(243, 47, 'products/image_galleries/khong-phan-loai/5YQm2nqYzznnZ0hniHSZwUjV4mmHZh5Xsa9t5UkH.webp', '2024-12-19 04:28:41', '2024-12-19 04:28:41', NULL),
(244, 47, 'products/image_galleries/khong-phan-loai/rYq3RRgRRFcIwvTi3rpVlANb1jPJh8XkiQRDPpgZ.webp', '2024-12-19 04:28:41', '2024-12-19 04:28:41', NULL),
(245, 47, 'products/image_galleries/khong-phan-loai/gvXZ8EebPxeNlsbm5s5jE9sdMAIz28jSgKSw6vJj.webp', '2024-12-19 04:28:41', '2024-12-19 04:28:41', NULL),
(246, 47, 'products/image_galleries/khong-phan-loai/9V41UpBMlEq0XdoqRqchLz7ojtiP65kdTzzVBa22.webp', '2024-12-19 04:28:41', '2024-12-19 04:28:41', NULL),
(247, 48, 'products/image_galleries/ao-nam/Q86uH6bTLUstDQ72HeRTxm1zv9GN08WH0UcswhGA.webp', '2024-12-19 04:31:08', '2024-12-19 04:31:08', NULL),
(248, 48, 'products/image_galleries/ao-nam/gZkfZqU9nL5zeMPQWbP30RofPyjWS8E8erJ1bnoC.webp', '2024-12-19 04:31:08', '2024-12-19 04:31:08', NULL),
(249, 48, 'products/image_galleries/ao-nam/iyFRjnSmJS65hyZPMeKr5gNP4Vtg7NituzFLrXOf.webp', '2024-12-19 04:31:08', '2024-12-19 04:31:08', NULL),
(250, 48, 'products/image_galleries/ao-nam/VlR7OUqBGnrWGwQ0ZX7jzNdLnSYWGRXC77zbKvnL.webp', '2024-12-19 04:31:08', '2024-12-19 04:31:08', NULL),
(251, 48, 'products/image_galleries/ao-nam/WesOMJSSbZMcVR2ghcSt5EqDGYrDn94W5C4s3m1P.webp', '2024-12-19 04:31:08', '2024-12-19 04:31:08', NULL),
(252, 49, 'products/image_galleries/khong-phan-loai/KzY4zRfsiG3gy976SBwTlxWiUVsE7NbpG6bLcT9l.webp', '2024-12-19 04:32:52', '2024-12-19 04:32:52', NULL),
(253, 49, 'products/image_galleries/khong-phan-loai/Ji2ZwEwdkbyzEIm0oR579psQ6LmMPqzo76v1jFnp.webp', '2024-12-19 04:32:52', '2024-12-19 04:32:52', NULL),
(254, 49, 'products/image_galleries/khong-phan-loai/jX3MuD6N2VSoOt0QVK17gTP1ziqzvV6UuFPQABlb.webp', '2024-12-19 04:32:52', '2024-12-19 04:32:52', NULL),
(255, 49, 'products/image_galleries/khong-phan-loai/Fh5a1qkEz4h9Nud42sebrT2ojgsJ4olBmOSL33iS.webp', '2024-12-19 04:32:52', '2024-12-19 04:32:52', NULL),
(256, 49, 'products/image_galleries/khong-phan-loai/Vhjwepl7trkbZQqs8DdVLdIfGEVudo19qx1kbso2.webp', '2024-12-19 04:32:52', '2024-12-19 04:32:52', NULL),
(257, 50, 'products/image_galleries/khong-phan-loai/toyZLZ1DFVYV2RO0tenwjfc6rAH6zwC3qENsHxpG.webp', '2024-12-19 04:34:51', '2024-12-19 04:34:51', NULL),
(258, 50, 'products/image_galleries/khong-phan-loai/uCu76apWCrdhdzMBM8RAUY3ioJZohYwrzHPU0eXZ.webp', '2024-12-19 04:34:51', '2024-12-19 04:34:51', NULL),
(259, 50, 'products/image_galleries/khong-phan-loai/ZvknL29IOcfGVoCPA6b33squMsnTXSqhx4g6LdxK.webp', '2024-12-19 04:34:51', '2024-12-19 04:34:51', NULL),
(260, 50, 'products/image_galleries/khong-phan-loai/djfzFwMgV8Dg03EktXd1SiFWyolGldz6o6aigYen.webp', '2024-12-19 04:34:51', '2024-12-19 04:34:51', NULL),
(261, 50, 'products/image_galleries/khong-phan-loai/jInHB7W3bLRbC412UbAL3UedYJAeaHTyAan3fnRc.webp', '2024-12-19 04:34:51', '2024-12-19 04:34:51', NULL),
(262, 51, 'products/image_galleries/ao-nam/o18DoarZlYKqfhVTkO1gYGMOvJOWLK4DkMLNH1kh.webp', '2024-12-19 04:37:05', '2024-12-19 04:37:05', NULL),
(263, 51, 'products/image_galleries/ao-nam/xKXLgWO3O5rZ6NeMeAMp1pXutZ1vqktr4uywLIQh.webp', '2024-12-19 04:37:05', '2024-12-19 04:37:05', NULL),
(264, 51, 'products/image_galleries/ao-nam/ObhLi78cVP5YeBeb3uQFiHqBCHOyy3cXsyugLc1K.webp', '2024-12-19 04:37:05', '2024-12-19 04:37:05', NULL),
(265, 51, 'products/image_galleries/ao-nam/btnuFNS0MYCBRJ7HzBONJUUWuJ8pkVln0ZQIVgNz.webp', '2024-12-19 04:37:05', '2024-12-19 04:37:05', NULL),
(266, 51, 'products/image_galleries/ao-nam/uhNxGu0gnKPK2jpWg3vIgF1ooYhdUww4kS9RHIUD.webp', '2024-12-19 04:37:05', '2024-12-19 04:37:05', NULL),
(267, 51, 'products/image_galleries/ao-nam/OEPL5MYVzR9rhOerTLys1j3T9wY4odwyL1Vk9mmN.webp', '2024-12-19 04:37:05', '2024-12-19 04:37:05', NULL),
(268, 51, 'products/image_galleries/ao-nam/y2OBZxF3qGNXYGwXjxCdytRiBwzS1ZU7OuksH7mN.webp', '2024-12-19 04:37:05', '2024-12-19 04:37:05', NULL),
(269, 52, 'products/image_galleries/ao-nam/Zth8goRc01L0kq41dTGd5ErszfN7x8VruiVXUzLg.webp', '2024-12-19 04:38:48', '2024-12-19 04:38:48', NULL),
(270, 52, 'products/image_galleries/ao-nam/jtmW2thxw8f81bbGj3Z9XdBAiOT4uvGhT6Z4gQ4r.webp', '2024-12-19 04:38:48', '2024-12-19 04:38:48', NULL),
(271, 52, 'products/image_galleries/ao-nam/ZUgOdmauZmzUZRuESkKdzFCIIRsBrPkvu6h34ujv.webp', '2024-12-19 04:38:48', '2024-12-19 04:38:48', NULL),
(272, 52, 'products/image_galleries/ao-nam/QMd20m2E8yh48bnx2FL4Gq5kkqYOjUdvryqtAlyn.webp', '2024-12-19 04:38:48', '2024-12-19 04:38:48', NULL),
(273, 52, 'products/image_galleries/ao-nam/dQKBlWxpMfPLtDGaY4Pc6IFneKGs0UH5BtllBFom.webp', '2024-12-19 04:38:48', '2024-12-19 04:38:48', NULL),
(274, 53, 'products/image_galleries/ao-nam/G70ftpcnuiG69ro3E8XKz7sbbyOg5ixvwyFEpT2j.webp', '2024-12-19 04:40:34', '2024-12-19 04:40:34', NULL),
(275, 53, 'products/image_galleries/ao-nam/dM7qHEyfjr8nIS5T8KwoEsjFqrk5UDqObN4YjVH8.webp', '2024-12-19 04:40:34', '2024-12-19 04:40:34', NULL),
(276, 53, 'products/image_galleries/ao-nam/8G2nFusu21aDidVOD88yyD7PVsFfIXTCP2BE4g5B.webp', '2024-12-19 04:40:34', '2024-12-19 04:40:34', NULL),
(277, 53, 'products/image_galleries/ao-nam/xUcY71pgxz2EcL6ZTCnqT5X36Pt3QfpuVpvqUQGM.webp', '2024-12-19 04:40:34', '2024-12-19 04:40:34', NULL),
(278, 54, 'products/image_galleries/ao-nam/7V92Tl7Hu1Ozmf23LcG5MF5tmQ94ya5DLtfTEgrL.webp', '2024-12-19 04:42:27', '2024-12-19 04:42:27', NULL),
(279, 54, 'products/image_galleries/ao-nam/FNFPBkkErixWMlDXNgPLXKxQLGY7EwHCkPjyHXa7.webp', '2024-12-19 04:42:27', '2024-12-19 04:42:27', NULL),
(280, 54, 'products/image_galleries/ao-nam/bIjnklEtIImaWrd7qsmCmH74mQSNQBoxdiGakK2n.webp', '2024-12-19 04:42:27', '2024-12-19 04:42:27', NULL),
(281, 54, 'products/image_galleries/ao-nam/dD3XzeEQKyW6eFaWBVV0lZKNuv259RVaiSaaIRCb.webp', '2024-12-19 04:42:27', '2024-12-19 04:42:27', NULL),
(282, 55, 'products/image_galleries/khong-phan-loai/nF54kaTTCFCACp8LD9YqK8NmXjmUvcZ4Oik1VJUw.webp', '2024-12-19 04:44:15', '2024-12-19 04:44:15', NULL),
(283, 55, 'products/image_galleries/khong-phan-loai/o8HUz9VPuaiqJWZSN6FDSsEeHGtKVZudE4ciL1CT.webp', '2024-12-19 04:44:15', '2024-12-19 04:44:15', NULL),
(284, 55, 'products/image_galleries/khong-phan-loai/n7mslESsDO9TVjPEChkeiGxKnhT1wv1Ak0rh6dLY.webp', '2024-12-19 04:44:15', '2024-12-19 04:44:15', NULL),
(285, 55, 'products/image_galleries/khong-phan-loai/JxULfGrtZGVinO5a6MjZxJVyIjbmGumWJrscaOwW.webp', '2024-12-19 04:44:15', '2024-12-19 04:44:15', NULL),
(286, 55, 'products/image_galleries/khong-phan-loai/jgqNlkgTNqzWEjJnTvPbvzytytg3j2CGk8wCRwDN.webp', '2024-12-19 04:44:15', '2024-12-19 04:44:15', NULL),
(287, 56, 'products/image_galleries/khong-phan-loai/zW39NQODKvsUNLYN7W8vkdcI72veX21XHxst9Z5n.webp', '2024-12-19 04:46:06', '2024-12-19 04:46:06', NULL),
(288, 56, 'products/image_galleries/khong-phan-loai/mzhsmJ4Ckqyv8LC7zYeHAxHGvBa57hTRMnFYRqxH.webp', '2024-12-19 04:46:06', '2024-12-19 04:46:06', NULL),
(289, 56, 'products/image_galleries/khong-phan-loai/ux8iQ1g8Fp3bbQwNtbsvGqiajTZU8BPa3AtUpyHv.webp', '2024-12-19 04:46:06', '2024-12-19 04:46:06', NULL),
(290, 56, 'products/image_galleries/khong-phan-loai/FmcoKHdYkvShUJGD5skjISrzM1JCvkkNt8bnEuw4.webp', '2024-12-19 04:46:06', '2024-12-19 04:46:06', NULL),
(291, 57, 'products/image_galleries/khong-phan-loai/JON9EMj1zlNMdGwHQRAiCs1Sa3StxtAbgIHvkw69.webp', '2024-12-19 04:47:26', '2024-12-19 04:47:26', NULL),
(292, 57, 'products/image_galleries/khong-phan-loai/PhNnpQgwwskP1cwCYeSKpk3bNzXiNZXy28Njrxus.webp', '2024-12-19 04:47:26', '2024-12-19 04:47:26', NULL),
(293, 57, 'products/image_galleries/khong-phan-loai/PZ4WWclTk6XffPRD26UYCUdVS8jGrjugZrVUPY9w.webp', '2024-12-19 04:47:26', '2024-12-19 04:47:26', NULL),
(294, 57, 'products/image_galleries/khong-phan-loai/JGs9w3jc7vMVycK7Oj7Bw18z6HHD9qRmSTVXpjnF.webp', '2024-12-19 04:47:26', '2024-12-19 04:47:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE `product_tag` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_tag`
--

INSERT INTO `product_tag` (`product_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(4, 2, NULL, NULL),
(4, 3, NULL, NULL),
(5, 2, NULL, NULL),
(5, 3, NULL, NULL),
(6, 2, NULL, NULL),
(7, 2, NULL, NULL),
(7, 3, NULL, NULL),
(8, 2, NULL, NULL),
(8, 3, NULL, NULL),
(9, 2, NULL, NULL),
(9, 3, NULL, NULL),
(10, 2, NULL, NULL),
(10, 3, NULL, NULL),
(11, 1, NULL, NULL),
(11, 4, NULL, NULL),
(12, 1, NULL, NULL),
(12, 4, NULL, NULL),
(13, 1, NULL, NULL),
(13, 4, NULL, NULL),
(14, 1, NULL, NULL),
(14, 4, NULL, NULL),
(30, 1, NULL, NULL),
(32, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_attribute_id` bigint(20) UNSIGNED NOT NULL,
  `color_attribute_id` bigint(20) UNSIGNED NOT NULL,
  `price_default` bigint(20) DEFAULT NULL,
  `price_sale` bigint(20) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `size_attribute_id`, `color_attribute_id`, `price_default`, `price_sale`, `start_date`, `end_date`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 3, 996206, 432193, '2024-12-17 12:47:21', '2025-01-16 12:47:21', 72, NULL, NULL, NULL),
(2, 2, 3, 2, 650067, 864074, '2024-12-17 12:47:21', '2025-01-16 12:47:21', 34, NULL, NULL, NULL),
(3, 3, 1, 1, 300061, 819142, '2024-12-17 12:47:21', '2025-01-16 12:47:21', 75, NULL, NULL, NULL),
(4, 4, 1, 8, 1500000, 1200000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 23, '2024-12-17 06:12:25', '2024-12-17 06:13:10', NULL),
(5, 4, 2, 8, 1500000, 1200000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 26, '2024-12-17 06:12:25', '2024-12-17 06:13:10', NULL),
(6, 4, 3, 8, 1500000, 1200000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 26, '2024-12-17 06:12:25', '2024-12-17 06:13:10', NULL),
(7, 4, 4, 8, 1500000, 1200000, '2024-12-25 00:00:00', '2024-12-25 00:00:00', 25, '2024-12-17 06:12:25', '2024-12-17 06:13:10', NULL),
(8, 5, 1, 2, 1400000, 1150000, '2024-11-25 00:00:00', '2024-12-24 00:00:00', 10, '2024-12-17 06:21:10', '2024-12-17 06:26:18', NULL),
(9, 5, 3, 2, 1400000, 1150000, '2024-11-25 00:00:00', '2024-12-24 00:00:00', 20, '2024-12-17 06:21:10', '2024-12-17 06:26:18', NULL),
(10, 5, 4, 2, 1400000, 1150000, '2024-11-25 00:00:00', '2024-12-24 00:00:00', 30, '2024-12-17 06:21:10', '2024-12-17 06:26:18', NULL),
(11, 5, 2, 7, 1400000, 1150000, '2024-11-25 00:00:00', '2024-12-24 00:00:00', 40, '2024-12-17 06:21:10', '2024-12-17 06:26:18', NULL),
(12, 5, 3, 7, 1400000, 1150000, '2024-11-25 00:00:00', '2024-12-24 00:00:00', 50, '2024-12-17 06:21:10', '2024-12-17 06:26:18', NULL),
(13, 5, 4, 7, 1400000, 1150000, '2024-11-25 00:00:00', '2024-12-24 00:00:00', 10, '2024-12-17 06:21:10', '2024-12-17 06:26:18', NULL),
(14, 6, 2, 1, 200000, 100000, '2024-12-17 00:00:00', '2024-12-19 00:00:00', 10, '2024-12-17 07:34:47', '2024-12-17 07:34:47', NULL),
(15, 6, 2, 2, 200000, 100000, '2024-12-17 00:00:00', '2024-12-19 00:00:00', 10, '2024-12-17 07:34:47', '2024-12-17 07:34:47', NULL),
(16, 7, 2, 8, 1500000, 1200000, '2024-11-25 00:00:00', '2024-12-31 00:00:00', 10, '2024-12-17 14:33:52', '2024-12-17 14:33:52', NULL),
(17, 7, 3, 8, 1500000, 1200000, '2024-11-25 00:00:00', '2024-12-31 00:00:00', 20, '2024-12-17 14:33:52', '2024-12-17 14:33:52', NULL),
(18, 7, 4, 8, 1500000, 1200000, '2024-11-25 00:00:00', '2024-12-31 00:00:00', 30, '2024-12-17 14:33:52', '2024-12-17 14:33:52', NULL),
(19, 8, 2, 2, 1400000, 1150000, '2024-11-25 00:00:00', '2024-12-24 00:00:00', 5, '2024-12-17 14:41:50', '2024-12-17 14:41:50', NULL),
(20, 8, 3, 2, 1400000, 1150000, '2024-11-25 00:00:00', '2024-12-24 00:00:00', 10, '2024-12-17 14:41:50', '2024-12-17 14:41:50', NULL),
(21, 8, 4, 2, 1400000, 1150000, '2024-11-25 00:00:00', '2024-12-24 00:00:00', 15, '2024-12-17 14:41:50', '2024-12-17 14:41:50', NULL),
(22, 8, 1, 7, 1400000, 1150000, '2024-11-25 00:00:00', '2024-12-24 00:00:00', 20, '2024-12-17 14:41:50', '2024-12-17 14:41:50', NULL),
(23, 8, 3, 7, 1400000, 1150000, '2024-11-25 00:00:00', '2024-12-24 00:00:00', 25, '2024-12-17 14:41:50', '2024-12-17 14:41:50', NULL),
(24, 8, 4, 7, 1400000, 1150000, '2024-11-25 00:00:00', '2024-12-24 00:00:00', 30, '2024-12-17 14:41:50', '2024-12-17 14:41:50', NULL),
(25, 9, 1, 1, 1600000, 1300000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 5, '2024-12-17 14:50:10', '2024-12-17 14:50:10', NULL),
(26, 9, 2, 1, 1600000, 1300000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 15, '2024-12-17 14:50:10', '2024-12-17 14:50:10', NULL),
(27, 9, 3, 1, 1600000, 1300000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 10, '2024-12-17 14:50:10', '2024-12-17 14:50:10', NULL),
(28, 9, 4, 1, 1600000, 1300000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 20, '2024-12-17 14:50:10', '2024-12-17 14:50:10', NULL),
(29, 10, 1, 4, 1400000, 1150000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 10, '2024-12-17 14:52:54', '2024-12-17 14:52:54', NULL),
(30, 10, 2, 4, 1400000, 1150000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 15, '2024-12-17 14:52:54', '2024-12-17 14:52:54', NULL),
(31, 10, 3, 4, 1400000, 1150000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 20, '2024-12-17 14:52:54', '2024-12-17 14:52:54', NULL),
(32, 10, 4, 4, 1400000, 1150000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 5, '2024-12-17 14:52:54', '2024-12-17 14:52:54', NULL),
(33, 11, 1, 5, 2000000, 1700000, '2024-11-25 00:00:00', '2024-11-25 00:00:00', 15, '2024-12-17 14:57:28', '2024-12-17 14:57:28', NULL),
(34, 11, 2, 5, 2000000, 1700000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 5, '2024-12-17 14:57:28', '2024-12-17 14:57:28', NULL),
(35, 11, 3, 5, 2000000, 1700000, '2024-11-25 00:00:00', '2024-11-25 00:00:00', 30, '2024-12-17 14:57:28', '2024-12-17 14:57:28', NULL),
(36, 12, 1, 4, 1800000, 1500000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 10, '2024-12-17 15:04:29', '2024-12-17 15:04:29', NULL),
(37, 12, 2, 4, 1800000, 1500000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 10, '2024-12-17 15:04:29', '2024-12-17 15:04:29', NULL),
(38, 12, 3, 4, 1800000, 1500000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 15, '2024-12-17 15:04:29', '2024-12-17 15:04:29', NULL),
(39, 12, 4, 4, 1800000, 1500000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 10, '2024-12-17 15:04:29', '2024-12-17 15:04:29', NULL),
(40, 13, 2, 4, 1900000, 1600000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 15, '2024-12-17 15:07:51', '2024-12-17 15:07:51', NULL),
(41, 13, 3, 4, 1900000, 1600000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 15, '2024-12-17 15:07:51', '2024-12-17 15:07:51', NULL),
(42, 13, 4, 4, 1900000, 1600000, '2024-11-25 00:00:00', '2024-11-25 00:00:00', 15, '2024-12-17 15:07:51', '2024-12-17 15:07:51', NULL),
(43, 14, 2, 5, 1800000, 1500000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 18, '2024-12-17 15:12:08', '2024-12-17 15:23:11', NULL),
(44, 14, 3, 5, 1800000, 1500000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 19, '2024-12-17 15:12:08', '2024-12-17 15:23:11', NULL),
(45, 14, 4, 5, 1800000, 1500000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 11, '2024-12-17 15:12:08', '2024-12-17 15:23:11', NULL),
(46, 15, 1, 4, 179000, 89500, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 10, '2024-12-18 12:28:42', '2024-12-19 01:35:59', NULL),
(47, 15, 2, 4, 179000, 89500, '2024-12-02 00:00:00', '2024-12-25 00:00:00', 10, '2024-12-18 12:28:42', '2024-12-19 01:35:59', NULL),
(48, 15, 2, 5, 179000, 89500, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 15, '2024-12-18 12:28:42', '2024-12-19 01:35:59', NULL),
(49, 15, 3, 5, 179000, 89500, '2024-12-02 00:00:00', '2024-12-25 00:00:00', 13, '2024-12-18 12:28:42', '2024-12-19 01:35:59', NULL),
(50, 15, 2, 8, 179000, 89500, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 19, '2024-12-18 12:28:42', '2024-12-19 01:35:59', NULL),
(51, 15, 3, 8, 179000, 89500, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 13, '2024-12-18 12:28:42', '2024-12-19 01:35:59', NULL),
(52, 15, 2, 9, 179000, 89500, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 21, '2024-12-18 12:28:42', '2024-12-19 01:35:59', NULL),
(53, 15, 3, 9, 179000, 89500, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 11, '2024-12-18 12:28:42', '2024-12-19 01:35:59', NULL),
(54, 16, 3, 2, 769000, 692100, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 20, '2024-12-18 12:31:39', '2024-12-19 01:37:03', NULL),
(55, 16, 4, 2, 769000, 692100, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 13, '2024-12-18 12:31:39', '2024-12-19 01:37:03', NULL),
(56, 16, 3, 4, 769000, 692100, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 15, '2024-12-18 12:31:39', '2024-12-19 01:37:03', NULL),
(57, 16, 4, 4, 769000, 692100, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 17, '2024-12-18 12:31:39', '2024-12-19 01:37:03', NULL),
(58, 16, 3, 5, 769000, 692100, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 19, '2024-12-18 12:31:39', '2024-12-19 01:37:03', NULL),
(59, 16, 4, 5, 769000, 692100, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 21, '2024-12-18 12:31:39', '2024-12-19 01:37:03', NULL),
(60, 17, 3, 1, 499000, 0, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 20, '2024-12-18 12:34:19', '2024-12-19 01:39:09', NULL),
(61, 17, 4, 1, 499000, 0, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 13, '2024-12-18 12:34:19', '2024-12-19 01:39:09', NULL),
(62, 17, 3, 2, 499000, 0, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 15, '2024-12-18 12:34:19', '2024-12-19 01:39:09', NULL),
(63, 17, 4, 2, 499000, 0, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 17, '2024-12-18 12:34:19', '2024-12-19 01:39:09', NULL),
(64, 18, 2, 2, 369000, 0, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 15, '2024-12-18 12:36:16', '2024-12-19 01:40:21', NULL),
(65, 18, 3, 2, 369000, 0, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 13, '2024-12-18 12:36:16', '2024-12-19 01:40:21', NULL),
(66, 18, 4, 2, 369000, 0, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 17, '2024-12-18 12:36:16', '2024-12-19 01:40:21', NULL),
(67, 19, 3, 2, 599000, 0, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 10, '2024-12-18 12:38:43', '2024-12-19 01:41:26', NULL),
(68, 19, 4, 2, 599000, 0, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 20, '2024-12-18 12:38:43', '2024-12-19 01:41:26', NULL),
(69, 19, 3, 4, 599000, 0, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 20, '2024-12-18 12:38:43', '2024-12-19 01:41:26', NULL),
(70, 19, 4, 4, 599000, 0, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 10, '2024-12-18 12:38:43', '2024-12-19 01:41:26', NULL),
(71, 19, 3, 5, 599000, 0, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 5, '2024-12-18 12:38:43', '2024-12-19 01:41:26', NULL),
(72, 19, 4, 5, 599000, 0, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 15, '2024-12-18 12:38:43', '2024-12-19 01:41:26', NULL),
(73, 20, 2, 4, 599000, 539000, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 7, '2024-12-18 12:41:30', '2024-12-19 01:42:47', NULL),
(74, 20, 3, 4, 599000, 539000, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 13, '2024-12-18 12:41:30', '2024-12-19 01:42:47', NULL),
(75, 20, 2, 8, 599000, 539000, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 17, '2024-12-18 12:41:30', '2024-12-19 01:42:47', NULL),
(76, 20, 3, 8, 599000, 539000, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 3, '2024-12-18 12:41:30', '2024-12-19 01:42:47', NULL),
(77, 21, 2, 4, 469000, 422100, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 12, '2024-12-18 12:44:45', '2024-12-19 01:43:53', NULL),
(78, 21, 3, 4, 469000, 422100, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 19, '2024-12-18 12:44:45', '2024-12-19 01:43:53', NULL),
(79, 21, 4, 4, 469000, 422100, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 24, '2024-12-18 12:44:45', '2024-12-19 01:43:53', NULL),
(80, 21, 2, 5, 469000, 422100, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 11, '2024-12-18 12:44:45', '2024-12-19 01:43:53', NULL),
(81, 21, 3, 5, 469000, 422100, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 18, '2024-12-18 12:44:45', '2024-12-19 01:43:53', NULL),
(82, 22, 3, 2, 399000, 79000, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 7, '2024-12-18 12:48:23', '2024-12-19 01:44:38', NULL),
(83, 22, 3, 4, 399000, 79000, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 8, '2024-12-18 12:48:23', '2024-12-19 01:44:38', NULL),
(84, 22, 4, 4, 399000, 79000, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 27, '2024-12-18 12:48:23', '2024-12-19 01:44:38', NULL),
(85, 22, 4, 5, 399000, 79000, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 13, '2024-12-18 12:48:23', '2024-12-19 01:44:38', NULL),
(86, 22, 3, 9, 399000, 79000, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 24, '2024-12-18 12:48:23', '2024-12-19 01:44:38', NULL),
(87, 23, 3, 9, 299000, 79800, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 12, '2024-12-18 12:50:12', '2024-12-19 01:45:25', NULL),
(88, 23, 4, 9, 299000, 79800, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 28, '2024-12-18 12:50:12', '2024-12-19 01:45:25', NULL),
(89, 24, 2, 4, 269000, 80700, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 5, '2024-12-18 12:52:37', '2024-12-19 01:46:33', NULL),
(90, 24, 3, 4, 269000, 80700, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 14, '2024-12-18 12:52:37', '2024-12-19 01:46:33', NULL),
(91, 24, 2, 8, 269000, 80700, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 13, '2024-12-18 12:52:37', '2024-12-19 01:46:33', NULL),
(92, 24, 3, 8, 269000, 80700, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 3, '2024-12-18 12:52:37', '2024-12-19 01:46:33', NULL),
(93, 25, 3, 4, 3181, 0, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 23, '2024-12-18 12:54:28', '2024-12-19 01:48:38', NULL),
(94, 25, 4, 4, 3181, 0, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 37, '2024-12-18 12:54:28', '2024-12-19 01:48:38', NULL),
(95, 26, 2, 5, 399000, 269000, '2024-12-01 00:00:00', '2024-12-25 00:00:00', 12, '2024-12-18 12:55:49', '2024-12-19 01:49:58', NULL),
(96, 26, 3, 5, 399000, 269000, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 8, '2024-12-18 12:55:49', '2024-12-19 01:49:58', NULL),
(97, 27, 2, 5, 399000, 269000, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 5, '2024-12-18 12:58:23', '2024-12-18 12:58:23', NULL),
(98, 27, 3, 5, 399000, 269000, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 9, '2024-12-18 12:58:23', '2024-12-18 12:58:23', NULL),
(99, 27, 4, 5, 399000, 269000, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 6, '2024-12-18 12:58:23', '2024-12-18 12:58:23', NULL),
(100, 28, 2, 2, 399000, NULL, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 4, '2024-12-18 13:03:04', '2024-12-18 13:03:04', NULL),
(101, 28, 3, 2, 399000, NULL, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 9, '2024-12-18 13:03:04', '2024-12-18 13:03:04', NULL),
(102, 28, 2, 5, 399000, NULL, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 15, '2024-12-18 13:03:04', '2024-12-18 13:03:04', NULL),
(103, 28, 3, 5, 399000, NULL, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 19, '2024-12-18 13:03:04', '2024-12-18 13:03:04', NULL),
(104, 28, 4, 5, 399000, NULL, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 28, '2024-12-18 13:03:04', '2024-12-18 13:03:04', NULL),
(105, 29, 3, 2, 599000, NULL, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 29, '2024-12-18 13:05:24', '2024-12-18 13:05:24', NULL),
(106, 29, 4, 2, 599000, NULL, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 14, '2024-12-18 13:05:24', '2024-12-18 13:05:24', NULL),
(107, 29, 3, 9, 599000, NULL, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 18, '2024-12-18 13:05:24', '2024-12-18 13:05:24', NULL),
(108, 29, 4, 9, 599000, NULL, '2024-12-01 00:00:00', '2025-01-11 00:00:00', 20, '2024-12-18 13:05:24', '2024-12-18 13:05:24', NULL),
(109, 30, 1, 5, 249000, 79000, NULL, NULL, 100, '2024-12-18 17:45:44', '2024-12-18 17:45:44', NULL),
(110, 30, 2, 5, 249000, 79000, NULL, NULL, 100, '2024-12-18 17:45:44', '2024-12-18 17:45:44', NULL),
(111, 30, 3, 5, 249000, 79000, NULL, NULL, 100, '2024-12-18 17:45:44', '2024-12-18 17:45:44', NULL),
(112, 30, 4, 5, 249000, 79000, NULL, NULL, 100, '2024-12-18 17:45:44', '2024-12-18 17:45:44', NULL),
(113, 30, 1, 11, 249000, 84000, NULL, NULL, 100, '2024-12-18 17:45:44', '2024-12-18 17:45:44', NULL),
(114, 30, 2, 11, 249000, 84000, NULL, NULL, 100, '2024-12-18 17:45:44', '2024-12-18 17:45:44', NULL),
(115, 30, 1, 12, 249000, 79000, NULL, NULL, 100, '2024-12-18 17:45:44', '2024-12-18 17:45:44', NULL),
(116, 31, 1, 2, 329000, 129000, NULL, NULL, 99, '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(117, 31, 2, 2, 329000, 129000, NULL, NULL, 100, '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(118, 31, 3, 2, 329000, 129000, NULL, NULL, 100, '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(119, 31, 4, 2, 329000, 129000, NULL, NULL, 100, '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(120, 31, 5, 2, 329000, 129000, NULL, NULL, 100, '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(121, 31, 1, 5, 329000, 129000, NULL, NULL, 100, '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(122, 31, 2, 5, 329000, 129000, NULL, NULL, 100, '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(123, 31, 3, 5, 329000, 129000, NULL, NULL, 100, '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(124, 31, 4, 5, 329000, 129000, NULL, NULL, 100, '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(125, 31, 5, 5, 329000, 129000, NULL, NULL, 100, '2024-12-18 17:55:06', '2024-12-18 17:55:06', NULL),
(126, 32, 2, 8, 699000, 199000, NULL, NULL, 100, '2024-12-18 17:59:20', '2024-12-18 17:59:20', NULL),
(127, 32, 2, 13, 699000, 199000, NULL, NULL, 20, '2024-12-18 17:59:20', '2024-12-18 17:59:20', NULL),
(128, 32, 4, 13, 699000, 199000, '2024-12-19 00:00:00', '2024-12-31 00:00:00', 40, '2024-12-18 17:59:20', '2024-12-18 17:59:20', NULL),
(129, 33, 2, 4, 0, 0, NULL, NULL, 100, '2024-12-18 20:00:30', '2024-12-18 20:02:42', NULL),
(130, 33, 3, 4, 0, 0, NULL, NULL, 100, '2024-12-18 20:00:30', '2024-12-18 20:02:42', NULL),
(131, 34, 1, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:13:41', '2024-12-18 20:13:41', NULL),
(132, 34, 2, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:13:41', '2024-12-18 20:13:41', NULL),
(133, 34, 3, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:13:41', '2024-12-18 20:13:41', NULL),
(134, 34, 4, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:13:41', '2024-12-18 20:13:41', NULL),
(135, 34, 1, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:13:41', '2024-12-18 20:13:41', NULL),
(136, 34, 2, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:13:41', '2024-12-18 20:13:41', NULL),
(137, 34, 3, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:13:41', '2024-12-18 20:13:41', NULL),
(138, 34, 4, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:13:41', '2024-12-18 20:13:41', NULL),
(139, 34, 1, 13, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:13:41', '2024-12-18 20:13:41', NULL),
(140, 34, 2, 13, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:13:41', '2024-12-18 20:13:41', NULL),
(141, 34, 3, 13, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:13:41', '2024-12-18 20:13:41', NULL),
(142, 34, 4, 13, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:13:41', '2024-12-18 20:13:41', NULL),
(143, 35, 1, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(144, 35, 2, 4, NULL, NULL, NULL, NULL, NULL, '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(145, 35, 3, 4, NULL, NULL, NULL, NULL, NULL, '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(146, 35, 4, 4, NULL, NULL, NULL, NULL, NULL, '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(147, 35, 5, 4, NULL, NULL, NULL, NULL, NULL, '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(148, 35, 1, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(149, 35, 2, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(150, 35, 3, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(151, 35, 4, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(152, 35, 5, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(153, 35, 1, 13, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(154, 35, 2, 13, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(155, 35, 3, 13, NULL, NULL, NULL, NULL, 99, '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(156, 35, 4, 13, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(157, 35, 5, 13, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:17:03', '2024-12-18 20:17:03', NULL),
(158, 36, 4, 5, NULL, NULL, NULL, NULL, 99, '2024-12-18 20:21:50', '2024-12-18 20:21:50', NULL),
(159, 36, 4, 13, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:21:50', '2024-12-18 20:21:50', NULL),
(160, 37, 1, 2, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(161, 37, 2, 2, NULL, NULL, NULL, NULL, 98, '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(162, 37, 3, 2, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(163, 37, 4, 2, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(164, 37, 1, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(165, 37, 2, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(166, 37, 3, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(167, 37, 4, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:24:35', '2024-12-18 20:24:35', NULL),
(168, 38, 2, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL),
(169, 38, 3, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL),
(170, 38, 4, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL),
(171, 38, 5, 5, NULL, NULL, NULL, NULL, 99, '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL),
(172, 38, 2, 13, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL),
(173, 38, 3, 13, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL),
(174, 38, 4, 13, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL),
(175, 38, 5, 13, NULL, NULL, NULL, NULL, 99, '2024-12-18 20:29:56', '2024-12-18 20:29:56', NULL),
(176, 39, 1, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(177, 39, 2, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(178, 39, 4, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(179, 39, 5, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(180, 39, 1, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(181, 39, 2, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(182, 39, 4, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(183, 39, 5, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:35:35', '2024-12-18 20:35:35', NULL),
(184, 40, 1, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:40:02', '2024-12-18 20:40:02', NULL),
(185, 40, 3, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:40:02', '2024-12-18 20:40:02', NULL),
(186, 40, 4, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:40:02', '2024-12-18 20:40:02', NULL),
(187, 40, 1, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:40:02', '2024-12-18 20:40:02', NULL),
(188, 40, 3, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:40:02', '2024-12-18 20:40:02', NULL),
(189, 40, 4, 5, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:40:02', '2024-12-18 20:40:02', NULL),
(190, 41, 1, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(191, 41, 4, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(192, 41, 1, 13, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(193, 41, 4, 13, NULL, NULL, NULL, NULL, 99, '2024-12-18 20:42:18', '2024-12-18 20:42:18', NULL),
(194, 42, 1, 4, NULL, NULL, NULL, NULL, 1000, '2024-12-18 20:44:58', '2024-12-18 20:44:58', NULL),
(195, 42, 2, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:44:58', '2024-12-18 20:44:58', NULL),
(196, 42, 5, 4, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:44:58', '2024-12-18 20:44:58', NULL),
(197, 42, 1, 13, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:44:58', '2024-12-18 20:44:58', NULL),
(198, 42, 2, 13, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:44:58', '2024-12-18 20:44:58', NULL),
(199, 42, 5, 13, NULL, NULL, NULL, NULL, 100, '2024-12-18 20:44:58', '2024-12-18 20:44:58', NULL),
(200, 43, 3, 1, 539000, NULL, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 13, '2024-12-19 02:23:46', '2024-12-19 02:23:46', NULL),
(201, 43, 4, 1, 539000, NULL, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 24, '2024-12-19 02:23:46', '2024-12-19 02:23:46', NULL),
(202, 43, 3, 2, 539000, NULL, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 39, '2024-12-19 02:23:46', '2024-12-19 02:23:46', NULL),
(203, 43, 4, 2, 539000, NULL, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 34, '2024-12-19 02:23:46', '2024-12-19 02:23:46', NULL),
(204, 44, 2, 4, 109000, NULL, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 34, '2024-12-19 02:26:46', '2024-12-19 02:26:46', NULL),
(205, 44, 3, 4, 108999, NULL, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 61, '2024-12-19 02:26:46', '2024-12-19 02:26:46', NULL),
(206, 44, 4, 4, 109000, NULL, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 38, '2024-12-19 02:26:46', '2024-12-19 02:26:46', NULL),
(207, 45, 1, 4, 499000, NULL, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 54, '2024-12-19 02:29:57', '2024-12-19 02:29:57', NULL),
(208, 45, 2, 4, 499000, NULL, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 69, '2024-12-19 02:29:57', '2024-12-19 02:29:57', NULL),
(209, 45, 3, 4, 499000, NULL, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 73, '2024-12-19 02:29:57', '2024-12-19 02:29:57', NULL),
(210, 46, 1, 2, 399000, 79000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 19, '2024-12-19 02:34:52', '2024-12-19 02:34:52', NULL),
(211, 46, 2, 2, 399000, 79000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 26, '2024-12-19 02:34:52', '2024-12-19 02:34:52', NULL),
(212, 46, 3, 2, 399000, 79000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 19, '2024-12-19 02:34:52', '2024-12-19 02:34:52', NULL),
(213, 46, 4, 2, 399000, 79000, '2024-11-25 00:00:00', '2024-12-25 00:00:00', 19, '2024-12-19 02:34:52', '2024-12-19 02:34:52', NULL),
(214, 47, 1, 6, 399000, NULL, NULL, NULL, 29, '2024-12-19 04:28:41', '2024-12-19 04:28:41', NULL),
(215, 47, 2, 6, 399000, NULL, NULL, NULL, 19, '2024-12-19 04:28:41', '2024-12-19 04:28:41', NULL),
(216, 47, 3, 6, 399000, NULL, NULL, NULL, 45, '2024-12-19 04:28:41', '2024-12-19 04:28:41', NULL),
(217, 48, 1, 5, 269000, NULL, NULL, NULL, 19, '2024-12-19 04:31:08', '2024-12-19 04:31:08', NULL),
(218, 48, 2, 5, 269000, NULL, NULL, NULL, 34, '2024-12-19 04:31:08', '2024-12-19 04:31:08', NULL),
(219, 48, 3, 5, 269000, NULL, NULL, NULL, 12, '2024-12-19 04:31:08', '2024-12-19 04:31:08', NULL),
(220, 49, 2, 2, 369000, NULL, NULL, NULL, 19, '2024-12-19 04:32:52', '2024-12-19 04:32:52', NULL),
(221, 49, 3, 2, 369000, NULL, NULL, NULL, 30, '2024-12-19 04:32:52', '2024-12-19 04:32:52', NULL),
(222, 49, 4, 2, 369000, NULL, NULL, NULL, 28, '2024-12-19 04:32:52', '2024-12-19 04:32:52', NULL),
(223, 50, 1, 12, 599000, NULL, NULL, NULL, 39, '2024-12-19 04:34:51', '2024-12-19 04:34:51', NULL),
(224, 50, 2, 12, 599000, NULL, NULL, NULL, 21, '2024-12-19 04:34:51', '2024-12-19 04:34:51', NULL),
(225, 50, 3, 12, 599000, NULL, NULL, NULL, 55, '2024-12-19 04:34:51', '2024-12-19 04:34:51', NULL),
(226, 50, 4, 12, 599000, NULL, NULL, NULL, 10, '2024-12-19 04:34:51', '2024-12-19 04:34:51', NULL),
(227, 51, 1, 5, 369000, NULL, NULL, NULL, 19, '2024-12-19 04:37:05', '2024-12-19 04:37:05', NULL),
(228, 51, 2, 5, 369000, NULL, NULL, NULL, 42, '2024-12-19 04:37:05', '2024-12-19 04:37:05', NULL),
(229, 51, 3, 5, 369000, NULL, NULL, NULL, 34, '2024-12-19 04:37:05', '2024-12-19 04:37:05', NULL),
(230, 51, 4, 5, 369000, NULL, NULL, NULL, 55, '2024-12-19 04:37:05', '2024-12-19 04:37:05', NULL),
(231, 52, 3, 6, 269000, NULL, NULL, NULL, 55, '2024-12-19 04:38:48', '2024-12-19 04:38:48', NULL),
(232, 52, 4, 6, 269000, NULL, NULL, NULL, 37, '2024-12-19 04:38:48', '2024-12-19 04:38:48', NULL),
(233, 53, 2, 4, 299000, NULL, NULL, NULL, 19, '2024-12-19 04:40:34', '2024-12-19 04:40:34', NULL),
(234, 53, 3, 4, 299000, NULL, NULL, NULL, 17, '2024-12-19 04:40:34', '2024-12-19 04:40:34', NULL),
(235, 53, 4, 4, 299000, NULL, NULL, NULL, 29, '2024-12-19 04:40:34', '2024-12-19 04:40:34', NULL),
(236, 54, 3, 5, 199000, NULL, NULL, NULL, 29, '2024-12-19 04:42:27', '2024-12-19 04:42:27', NULL),
(237, 54, 4, 5, 199000, NULL, NULL, NULL, 37, '2024-12-19 04:42:27', '2024-12-19 04:42:27', NULL),
(238, 55, 2, 5, 269000, NULL, NULL, NULL, 19, '2024-12-19 04:44:15', '2024-12-19 04:44:15', NULL),
(239, 55, 3, 5, 269000, NULL, NULL, NULL, 20, '2024-12-19 04:44:15', '2024-12-19 04:44:15', NULL),
(240, 55, 4, 5, 269000, NULL, NULL, NULL, 31, '2024-12-19 04:44:15', '2024-12-19 04:44:15', NULL),
(241, 56, 2, 5, 199000, NULL, NULL, NULL, 34, '2024-12-19 04:46:06', '2024-12-19 04:46:06', NULL),
(242, 56, 3, 5, 199000, NULL, NULL, NULL, 42, '2024-12-19 04:46:06', '2024-12-19 04:46:06', NULL),
(243, 56, 4, 5, 199000, NULL, NULL, NULL, 37, '2024-12-19 04:46:06', '2024-12-19 04:46:06', NULL),
(244, 57, 2, 9, 199000, NULL, NULL, NULL, 20, '2024-12-19 04:47:26', '2024-12-19 04:47:26', NULL),
(245, 57, 3, 9, 199000, NULL, NULL, NULL, 26, '2024-12-19 04:47:26', '2024-12-19 04:47:26', NULL),
(246, 57, 4, 9, 199000, NULL, NULL, NULL, 19, '2024-12-19 04:47:26', '2024-12-19 04:47:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(2, 'comment_manager', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(3, 'coupon_manager', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(4, 'category_manager', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(5, 'post_manager', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(6, 'product_manager', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(7, 'attribute_manager', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(8, 'tag_manager', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(9, 'ticket_manager', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(10, 'banner_manager', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(11, 'order_manager', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(12, 'wallet_manager', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(13, 'customer_manager', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(14, 'statistical_viewer', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19'),
(15, 'user', 'web', '2024-12-17 05:47:19', '2024-12-17 05:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 3),
(7, 1),
(7, 3),
(8, 1),
(8, 3),
(9, 1),
(9, 3),
(10, 1),
(10, 4),
(11, 1),
(11, 4),
(12, 1),
(12, 4),
(13, 1),
(13, 4),
(14, 1),
(14, 5),
(15, 1),
(15, 5),
(16, 1),
(16, 5),
(17, 1),
(17, 5),
(18, 1),
(18, 6),
(19, 1),
(19, 6),
(20, 1),
(20, 6),
(21, 1),
(21, 6),
(22, 1),
(22, 6),
(23, 1),
(23, 7),
(24, 1),
(24, 7),
(25, 1),
(25, 7),
(26, 1),
(26, 7),
(27, 1),
(27, 8),
(28, 1),
(28, 8),
(29, 1),
(29, 8),
(30, 1),
(30, 9),
(31, 1),
(31, 9),
(32, 1),
(32, 9),
(33, 1),
(33, 9),
(34, 1),
(34, 10),
(35, 1),
(35, 10),
(36, 1),
(36, 10),
(37, 1),
(37, 10),
(38, 1),
(38, 11),
(39, 1),
(39, 11),
(40, 1),
(40, 11),
(41, 1),
(41, 11),
(42, 1),
(42, 12),
(43, 1),
(43, 12),
(44, 1),
(44, 12),
(45, 1),
(45, 12),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(50, 13),
(51, 1),
(51, 14);

-- --------------------------------------------------------

--
-- Table structure for table `size_attributes`
--

CREATE TABLE `size_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size_value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size_attributes`
--

INSERT INTO `size_attributes` (`id`, `size_value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'S', NULL, NULL, NULL),
(2, 'M', NULL, NULL, NULL),
(3, 'L', NULL, NULL, NULL),
(4, 'XL', NULL, NULL, NULL),
(5, 'XXL', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `slug`, `note`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'Orlo Dooley', 'ea-corporis-molestiae-provident-dolor-numquam', 'Ghi chú danh mục phụ 0', NULL, NULL, NULL),
(2, 4, 'Emmalee Dibbert', 'inventore-nostrum-vitae-provident-praesentium-repellat-autem', 'Ghi chú danh mục phụ 1', NULL, NULL, NULL),
(3, 5, 'Áo dài cách tân', 'ao-dai-cach-tan', 'Chưa cập nhật ghi chú chi tiết!', NULL, '2024-12-17 06:05:32', '2024-12-17 06:05:32'),
(4, 5, 'Trang phục dân tộc', 'trang-phuc-dan-toc', 'Chưa cập nhật ghi chú chi tiết!', NULL, '2024-12-17 14:54:42', '2024-12-17 14:54:42'),
(5, 1, 'Áo khoác', 'ao-khoac', 'Chưa cập nhật ghi chú chi tiết!', NULL, '2024-12-18 12:19:59', '2024-12-18 12:19:59'),
(6, 1, 'Áo Polo', 'ao-polo', 'Chưa cập nhật ghi chú chi tiết!', NULL, '2024-12-18 12:20:11', '2024-12-18 12:20:11'),
(7, 2, 'Quần âu', 'quan-au', 'Chưa cập nhật ghi chú chi tiết!', NULL, '2024-12-18 12:20:41', '2024-12-18 12:20:41'),
(8, 2, 'Quần nỉ', 'quan-ni', 'Chưa cập nhật ghi chú chi tiết!', NULL, '2024-12-18 12:20:48', '2024-12-18 12:20:48'),
(9, 2, 'Quần thể thao', 'quan-the-thao', 'Chưa cập nhật ghi chú chi tiết!', NULL, '2024-12-18 12:21:41', '2024-12-18 12:21:41'),
(10, 1, 'Áo trẻ em', 'ao-tre-em', 'Chưa cập nhật ghi chú chi tiết!', NULL, '2024-12-18 12:23:06', '2024-12-18 12:23:06'),
(11, 1, 'Áo Sơ Mi', 'ao-so-mi', 'Chưa cập nhật ghi chú chi tiết!', NULL, '2024-12-18 12:53:19', '2024-12-18 12:53:19'),
(12, 2, 'Quần Jean', 'quan-jean', 'Chưa cập nhật ghi chú chi tiết!', NULL, '2024-12-18 12:56:32', '2024-12-18 12:56:32'),
(13, 2, 'Quần Short', 'quan-short', 'Chưa cập nhật ghi chú chi tiết!', NULL, '2024-12-18 13:03:36', '2024-12-18 13:03:36'),
(14, 1, 'Áo nữ', 'ao-nu', 'Chưa cập nhật ghi chú chi tiết!', NULL, '2024-12-18 17:31:56', '2024-12-18 17:31:56'),
(15, 3, 'váy ngắn', 'vay-ngan', 'Chưa cập nhật ghi chú chi tiết!', NULL, '2024-12-18 17:48:17', '2024-12-18 17:48:17'),
(16, 6, 'Áo Thun', 'ao-thun', 'Chưa cập nhật ghi chú chi tiết!', NULL, '2024-12-18 19:32:49', '2024-12-18 19:32:49'),
(17, 4, 'Túi sách Furla', 'tui-sach-furla', 'Chưa cập nhật ghi chú chi tiết!', NULL, '2024-12-19 04:24:39', '2024-12-19 04:24:39'),
(18, 3, 'Váy xòe', 'vay-xoe', 'Chưa cập nhật ghi chú chi tiết!', NULL, '2024-12-19 04:27:50', '2024-12-19 04:27:50');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Trang phục truyền thống', 'trang-phuc-truyen-thong', '2024-12-17 06:05:56', '2024-12-17 06:05:56', NULL),
(2, 'Áo dài', 'ao-dai', '2024-12-17 06:06:04', '2024-12-17 06:06:04', NULL),
(3, 'Áo dài cách tân', 'ao-dai-cach-tan', '2024-12-17 06:06:13', '2024-12-17 06:06:13', NULL),
(4, 'Trang phục dân tộc', 'trang-phuc-dan-toc', '2024-12-17 14:53:28', '2024-12-17 14:53:28', NULL),
(5, 'Trang phục hiện đại', 'trang-phuc-hien-dai', '2024-12-18 17:49:39', '2024-12-18 17:49:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trusted_devices`
--

CREATE TABLE `trusted_devices` (
  `device_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` bigint(20) UNSIGNED NOT NULL,
  `device_identifier` varchar(255) NOT NULL,
  `device_name` varchar(255) DEFAULT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `last_used` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trx_history`
--

CREATE TABLE `trx_history` (
  `trx_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_account_id` varchar(255) NOT NULL,
  `trx_type` varchar(255) NOT NULL,
  `trx_from` varchar(255) DEFAULT NULL,
  `trx_to` varchar(255) DEFAULT NULL,
  `trx_amount` int(11) NOT NULL,
  `trx_balance_available` int(11) NOT NULL,
  `trx_hash_request` varchar(255) DEFAULT NULL,
  `trx_status` tinyint(4) NOT NULL DEFAULT 0,
  `withdraw_request_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trx_history_detail`
--

CREATE TABLE `trx_history_detail` (
  `trx_history_detail_id` bigint(20) UNSIGNED NOT NULL,
  `trx_id` bigint(20) UNSIGNED NOT NULL,
  `trx_detail_desc` text DEFAULT NULL,
  `trx_date_issue` date NOT NULL,
  `vnp_BankTranNo` varchar(255) DEFAULT NULL,
  `vnp_SecureHash` varchar(255) DEFAULT NULL,
  `vnp_ResponseCode` varchar(255) DEFAULT NULL,
  `vnp_TxnRef` varchar(255) DEFAULT NULL,
  `vnp_TransactionNo` varchar(255) DEFAULT NULL,
  `vnp_PayDate` date DEFAULT NULL,
  `vnp_CardType` varchar(255) DEFAULT NULL,
  `BankCode` varchar(255) DEFAULT NULL,
  `charge_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_image` text DEFAULT NULL,
  `roles_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `verify` tinyint(1) NOT NULL,
  `status` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `phone`, `email`, `google_id`, `password`, `address`, `user_image`, `roles_id`, `full_name`, `verify`, `status`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Uy0', '0987654320', 'dophuonguy0@gmail.com', NULL, '$2y$10$IG8LM.Ht2cpTmiugGGX6lOVr3wSGL21EM8q4hTKvfO4NtV96pODh6', 'Ba Vì 0', 'https://mcdn.coolmate.me/image/January2023/pho-thoi-trang-870_220.jpg', 15, 'Đỗ Phương Uy 0', 1, 'active', NULL, NULL, NULL, NULL, NULL),
(2, 'Uy1', '0987654321', 'dophuonguy1@gmail.com', NULL, '$2y$10$Iu4kjDHVmais.GGvGg4/gOAh1iArFI/LboQoEqn8xjLAf/ClKo0eW', 'Ba Vì 1', 'https://mcdn.coolmate.me/image/January2023/pho-thoi-trang-870_220.jpg', 15, 'Đỗ Phương Uy 1', 1, 'active', NULL, NULL, NULL, NULL, NULL),
(3, 'Uy2', '0987654322', 'dophuonguy2@gmail.com', NULL, '$2y$10$8tmGmfu4FkXvjw9GNYysuOCYxeHDs2WD/UJwFKJ4tfhvPAuw1zkuS', 'Ba Vì 2', 'https://mcdn.coolmate.me/image/January2023/pho-thoi-trang-870_220.jpg', 15, 'Đỗ Phương Uy 2', 1, 'active', NULL, NULL, NULL, NULL, NULL),
(4, 'Uy3', '0987654323', 'dophuonguy3@gmail.com', NULL, '$2y$10$3y7Dv1yZ.PuT/y14A9q7pObCRmjq5Ir7suJBb300PkvFcuHtopE2S', 'Ba Vì 3', 'https://mcdn.coolmate.me/image/January2023/pho-thoi-trang-870_220.jpg', 15, 'Đỗ Phương Uy 3', 1, 'active', NULL, NULL, NULL, NULL, NULL),
(5, 'Admin', '0987654324', 'admin@webmaster.dev', NULL, '$2y$10$VD6E3AMO0dyE7gRt7QP5I.0A7uUj5H4uRE6We3QdEXsKMqWyvDBQ.', 'Ba Vì 4', 'users_image/du42cqN0ZRnGQmatfzbWiksoYG606z1RplBh0TtX.jpg', 1, 'Đỗ Phương Uy 4', 1, 'active', NULL, 'Ep3D4CQTpdHExyKxkZgNNYuFcevfuzniKILliR2iREyQa8Hd05tEXwVDalnY', NULL, '2024-12-17 07:32:59', NULL),
(6, NULL, NULL, 'dophuonguy1209@gmail.com', NULL, '$2y$10$r5RQ1kj1XoCs.6XCGpjNg.v/gtP7k6QitOnItc6Hjf8kAah2M.NTK', NULL, NULL, 15, 'Đỗ Phương Uy', 1, 'deactive', NULL, NULL, '2024-12-18 18:12:23', '2024-12-18 18:12:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_shipping`
--

CREATE TABLE `user_shipping` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `latitude` double(8,2) DEFAULT NULL,
  `longitude` double(8,2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_wallet_detail`
--

CREATE TABLE `user_wallet_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `id_card_image_front` longtext DEFAULT NULL,
  `id_card_image_back` longtext DEFAULT NULL,
  `id_card_face` longtext DEFAULT NULL,
  `id_number` text DEFAULT NULL,
  `frist_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `place_of_residence` varchar(255) DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `date_of_expiry` date DEFAULT NULL,
  `place_of_issue` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `gender` enum('MALE','FEMALE') DEFAULT NULL,
  `status` enum('PENDING_FILLED','COMPLETED','APROVED','REJECTED','PENDING_APROVED','COMPLETED_BASIC') NOT NULL DEFAULT 'PENDING_FILLED',
  `fillstep` enum('ADDRESS','EKYC','TOS','COMPLETED') NOT NULL DEFAULT 'ADDRESS',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_wallet_logging`
--

CREATE TABLE `user_wallet_logging` (
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_action` varchar(255) NOT NULL,
  `action_status` varchar(255) NOT NULL,
  `user_ip` varchar(45) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `user_payment_method` varchar(255) DEFAULT NULL,
  `vnp_BankTranNo` varchar(255) DEFAULT NULL,
  `vnp_SecureHash` varchar(255) DEFAULT NULL,
  `vnp_ResponseCode` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `last4` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `date_issuing` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `wallet_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_account_id` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_balance_available` int(11) NOT NULL DEFAULT 0,
  `wallet_status` int(11) NOT NULL DEFAULT 0,
  `wallet_user_level` int(11) NOT NULL DEFAULT 0,
  `wallet_trust_device_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `webauthn_keys`
--

CREATE TABLE `webauthn_keys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'key',
  `credentialId` mediumtext NOT NULL,
  `type` varchar(255) NOT NULL,
  `transports` text NOT NULL,
  `attestationType` varchar(255) NOT NULL,
  `trustPath` text NOT NULL,
  `aaguid` text NOT NULL,
  `credentialPublicKey` text NOT NULL,
  `counter` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_request`
--

CREATE TABLE `withdraw_request` (
  `withdraw_request_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_account_id` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `bank_account_number` varchar(255) NOT NULL,
  `bank_account_name` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `description` varchar(255) DEFAULT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_response_date` timestamp NULL DEFAULT NULL,
  `admin_note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `color_attributes`
--
ALTER TABLE `color_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_products_id_foreign` (`products_id`),
  ADD KEY `comments_users_id_foreign` (`users_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_supports`
--
ALTER TABLE `customer_supports`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `customer_supports_user_id_foreign` (`user_id`);

--
-- Indexes for table `customer_support_detail`
--
ALTER TABLE `customer_support_detail`
  ADD PRIMARY KEY (`ticket_detail_id`),
  ADD KEY `customer_support_detail_ticket_id_foreign` (`ticket_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_users_id_foreign` (`users_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`),
  ADD KEY `order_details_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_post_unique` (`slug_post`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`product_id`,`tag_id`),
  ADD KEY `product_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`),
  ADD KEY `product_variants_size_attribute_id_foreign` (`size_attribute_id`),
  ADD KEY `product_variants_color_attribute_id_foreign` (`color_attribute_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `size_attributes`
--
ALTER TABLE `size_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_categories_slug_unique` (`slug`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_name_unique` (`name`);

--
-- Indexes for table `trusted_devices`
--
ALTER TABLE `trusted_devices`
  ADD PRIMARY KEY (`device_id`),
  ADD KEY `trusted_devices_wallet_id_foreign` (`wallet_id`);

--
-- Indexes for table `trx_history`
--
ALTER TABLE `trx_history`
  ADD PRIMARY KEY (`trx_id`);

--
-- Indexes for table `trx_history_detail`
--
ALTER TABLE `trx_history_detail`
  ADD PRIMARY KEY (`trx_history_detail_id`),
  ADD KEY `trx_history_detail_trx_id_foreign` (`trx_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_roles_id_foreign` (`roles_id`);

--
-- Indexes for table `user_shipping`
--
ALTER TABLE `user_shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wallet_detail`
--
ALTER TABLE `user_wallet_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wallet_logging`
--
ALTER TABLE `user_wallet_logging`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `user_wallet_logging_user_id_foreign` (`user_id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`wallet_id`);

--
-- Indexes for table `webauthn_keys`
--
ALTER TABLE `webauthn_keys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `webauthn_keys_user_id_foreign` (`user_id`),
  ADD KEY `credential_index` (`credentialId`(255));

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_request`
--
ALTER TABLE `withdraw_request`
  ADD PRIMARY KEY (`withdraw_request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `color_attributes`
--
ALTER TABLE `color_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_supports`
--
ALTER TABLE `customer_supports`
  MODIFY `ticket_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_support_detail`
--
ALTER TABLE `customer_support_detail`
  MODIFY `ticket_detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `size_attributes`
--
ALTER TABLE `size_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trusted_devices`
--
ALTER TABLE `trusted_devices`
  MODIFY `device_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trx_history`
--
ALTER TABLE `trx_history`
  MODIFY `trx_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trx_history_detail`
--
ALTER TABLE `trx_history_detail`
  MODIFY `trx_history_detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_shipping`
--
ALTER TABLE `user_shipping`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_wallet_detail`
--
ALTER TABLE `user_wallet_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_wallet_logging`
--
ALTER TABLE `user_wallet_logging`
  MODIFY `event_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `wallet_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `webauthn_keys`
--
ALTER TABLE `webauthn_keys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_request`
--
ALTER TABLE `withdraw_request`
  MODIFY `withdraw_request_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_products_id_foreign` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `comments_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `customer_supports`
--
ALTER TABLE `customer_supports`
  ADD CONSTRAINT `customer_supports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `customer_support_detail`
--
ALTER TABLE `customer_support_detail`
  ADD CONSTRAINT `customer_support_detail_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `customer_supports` (`ticket_id`);

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
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_details_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
