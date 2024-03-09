-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 10, 2024 at 05:29 PM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exercisetwo`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `image`, `title`, `content`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(18, 'assets/img/announcements/165bccdb44c4c2selectboxbutton.png', 'One', '<p>Hello</p>', 2, 1, '2024-02-02 11:10:44', '2024-02-02 11:10:44'),
(19, 'assets/img/announcements/165bcce2b9ce9cselectboxbutton.png', 'Two', '<p>Hello</p>', 3, 1, '2024-02-02 11:12:43', '2024-02-02 11:12:43');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `classdate` date NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `attcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `classdate`, `post_id`, `attcode`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2023-12-18', 2, 'EFG', 1, '2023-12-16 12:01:36', '2023-12-16 12:01:36'),
(2, '2023-12-16', 2, 'EFG', 2, '2023-12-16 12:02:15', '2023-12-16 12:02:15'),
(3, '2023-12-16', 2, 'EFG', 3, '2023-12-16 12:02:58', '2023-12-16 12:02:58'),
(4, '2023-12-16', 2, 'EFG', 4, '2023-12-16 12:03:43', '2023-12-16 12:03:43'),
(5, '2024-01-03', 4, 'EE', 2, '2024-01-03 01:16:02', '2024-01-03 01:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `user_id`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'test 1', 'test-1', 1, 3, '2024-01-12 09:17:36', '2024-01-30 11:34:26'),
(2, 'test 2', 'test-2', 1, 3, '2024-01-12 09:18:01', '2024-01-30 11:34:26'),
(3, 'test 3', 'test-3', 1, 3, '2024-01-12 09:18:09', '2024-01-12 09:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `slug`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Yangon', 'yangon', 1, '2023-12-09 10:57:58', '2023-12-09 10:57:58'),
(2, 'Mandalay', 'mandalay', 1, '2023-12-09 10:58:05', '2023-12-09 10:58:05'),
(3, 'Mawlamying', 'mawlamying', 1, '2023-12-09 10:58:14', '2023-12-09 10:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `commentable_id` bigint UNSIGNED NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `description`, `user_id`, `commentable_id`, `commentable_type`, `created_at`, `updated_at`) VALUES
(1, 'Hello Nice Class 1', 1, 2, 'App\\Models\\Post', '2023-12-09 11:01:54', '2023-12-09 11:01:54'),
(2, 'Hello Nice Class 2', 1, 2, 'App\\Models\\Post', '2023-12-09 11:02:06', '2023-12-09 11:02:06'),
(3, 'Hello', 1, 15, 'App\\Models\\Announcement', '2024-02-02 11:00:18', '2024-02-02 11:00:18'),
(4, 'How Are You', 1, 15, 'App\\Models\\Announcement', '2024-02-02 11:00:25', '2024-02-02 11:00:25');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `relative_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `firstname`, `lastname`, `birthday`, `relative_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Aung', 'Kyaw', '2024-01-01', 4, 1, '2024-01-14 13:02:59', '2024-01-14 13:02:59'),
(2, 'Zaw', 'Myo', '2024-01-16', 0, 1, '2024-01-14 13:05:58', '2024-01-17 01:08:16'),
(5, 'Hla', 'Hla', '2024-01-16', 8, 1, '2024-01-17 01:09:59', '2024-01-17 01:09:59'),
(6, 'Myo', 'Myo', '2024-01-16', 6, 1, '2024-01-17 01:10:36', '2024-01-17 01:10:36'),
(7, 'Hla', 'Maung', NULL, 12, 1, '2024-01-17 01:13:59', '2024-01-17 01:13:59'),
(8, 'Myo', 'Ko', NULL, 13, 1, '2024-01-17 01:14:08', '2024-01-17 01:14:08'),
(9, 'Myint', 'Myint', NULL, 0, 1, '2024-01-17 01:14:17', '2024-01-17 01:14:17'),
(10, 'Zaw', 'Myo', '2024-01-17', 12, 1, '2024-01-17 01:14:41', '2024-01-17 01:14:41'),
(11, 'Kyaw', 'Myint', '2024-01-10', 0, 1, '2024-01-17 01:15:06', '2024-01-17 01:15:06'),
(12, 'Hla Maung', 'Ko', '2024-01-15', 10, 1, '2024-01-17 01:15:20', '2024-01-17 01:15:20'),
(13, 'Hla Myo', 'Hlaing', NULL, 9, 1, '2024-01-17 01:40:29', '2024-01-17 01:40:29'),
(14, 'Myo', 'Hlaing Kyaw', '2024-01-09', 9, 1, '2024-01-17 01:40:59', '2024-01-17 01:40:59'),
(15, 'Tun', 'Kyaw', '2024-01-09', 9, 1, '2024-01-17 01:41:13', '2024-01-17 01:41:13'),
(16, 'Thu', 'Zar', '2024-01-16', 9, 1, '2024-01-17 01:41:27', '2024-01-17 01:41:27'),
(17, 'Hnin Hnin', 'Khaing', '2024-01-15', 9, 1, '2024-01-17 01:41:45', '2024-01-17 01:41:45'),
(18, 'Hla Myint', 'Maung', '2024-01-10', 9, 1, '2024-01-17 01:41:58', '2024-01-17 01:41:58'),
(19, 'Aung', 'Kyaw', '2024-02-02', 4, 1, '2024-02-02 12:04:43', '2024-02-02 12:04:43'),
(20, 'Honey', 'Nway Oo', '2024-02-07', 5, 2, '2024-02-02 12:08:43', '2024-02-02 12:08:43'),
(21, 'U Ba', 'Aye', '2024-02-08', 13, 1, '2024-02-02 12:42:54', '2024-02-02 12:42:54'),
(22, 'U Ba', 'Aye', '2024-02-08', 13, 1, '2024-02-02 12:43:10', '2024-02-02 12:43:10'),
(23, 'U Ba', 'Aye', '2024-02-08', 13, 1, '2024-02-02 12:45:24', '2024-02-02 12:45:24'),
(24, 'U Ba', 'Aye', '2024-02-08', 13, 1, '2024-02-02 12:45:40', '2024-02-02 12:45:40'),
(25, 'U Ba', 'Aye', '2024-02-08', 13, 1, '2024-02-02 12:45:53', '2024-02-02 12:45:53'),
(26, 'U Ba', 'Aye', '2024-02-08', 13, 1, '2024-02-02 12:46:30', '2024-02-02 12:46:30'),
(27, 'U Ba', 'Aye', '2024-02-07', 7, 1, '2024-02-02 12:48:00', '2024-02-02 12:48:00'),
(28, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 12:54:49', '2024-02-02 12:54:49'),
(29, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 12:56:34', '2024-02-02 12:56:34'),
(30, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 12:56:53', '2024-02-02 12:56:53'),
(31, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 12:57:04', '2024-02-02 12:57:04'),
(32, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 12:57:11', '2024-02-02 12:57:11'),
(33, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 12:57:23', '2024-02-02 12:57:23'),
(34, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 12:58:40', '2024-02-02 12:58:40'),
(35, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 12:58:48', '2024-02-02 12:58:48'),
(36, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 12:58:55', '2024-02-02 12:58:55'),
(37, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 12:59:11', '2024-02-02 12:59:11'),
(38, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 12:59:29', '2024-02-02 12:59:29'),
(39, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 12:59:49', '2024-02-02 12:59:49'),
(40, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:00:03', '2024-02-02 13:00:03'),
(41, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:00:13', '2024-02-02 13:00:13'),
(42, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:01:23', '2024-02-02 13:01:23'),
(43, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:01:31', '2024-02-02 13:01:31'),
(44, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:01:50', '2024-02-02 13:01:50'),
(45, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:02:01', '2024-02-02 13:02:01'),
(46, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:03:50', '2024-02-02 13:03:50'),
(47, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:03:54', '2024-02-02 13:03:54'),
(48, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:04:37', '2024-02-02 13:04:37'),
(49, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:04:58', '2024-02-02 13:04:58'),
(50, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:05:08', '2024-02-02 13:05:08'),
(51, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:05:12', '2024-02-02 13:05:12'),
(52, 'U Myint', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:05:13', '2024-02-02 13:05:13'),
(53, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:05:51', '2024-02-02 13:05:51'),
(54, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:06:46', '2024-02-02 13:06:46'),
(55, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:07:08', '2024-02-02 13:07:08'),
(56, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:07:26', '2024-02-02 13:07:26'),
(57, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:07:30', '2024-02-02 13:07:30'),
(58, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:07:38', '2024-02-02 13:07:38'),
(59, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:07:41', '2024-02-02 13:07:41'),
(60, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:07:50', '2024-02-02 13:07:50'),
(61, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:07:57', '2024-02-02 13:07:57'),
(62, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:08:22', '2024-02-02 13:08:22'),
(63, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:08:29', '2024-02-02 13:08:29'),
(64, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:08:40', '2024-02-02 13:08:40'),
(65, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:08:52', '2024-02-02 13:08:52'),
(66, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:09:27', '2024-02-02 13:09:27'),
(67, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:09:56', '2024-02-02 13:09:56'),
(68, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:10:15', '2024-02-02 13:10:15'),
(69, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:10:24', '2024-02-02 13:10:24'),
(70, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:10:28', '2024-02-02 13:10:28'),
(71, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:10:38', '2024-02-02 13:10:38'),
(72, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:10:46', '2024-02-02 13:10:46'),
(73, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:10:50', '2024-02-02 13:10:50'),
(74, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:10:55', '2024-02-02 13:10:55'),
(75, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:11:00', '2024-02-02 13:11:00'),
(76, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:11:05', '2024-02-02 13:11:05'),
(77, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:11:08', '2024-02-02 13:11:08'),
(78, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:11:18', '2024-02-02 13:11:18'),
(79, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:11:26', '2024-02-02 13:11:26'),
(80, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:11:35', '2024-02-02 13:11:35'),
(81, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:11:40', '2024-02-02 13:11:40'),
(82, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:11:45', '2024-02-02 13:11:45'),
(83, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:11:54', '2024-02-02 13:11:54'),
(84, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:12:01', '2024-02-02 13:12:01'),
(85, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:12:18', '2024-02-02 13:12:18'),
(86, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:12:23', '2024-02-02 13:12:23'),
(87, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:12:45', '2024-02-02 13:12:45'),
(88, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:13:03', '2024-02-02 13:13:03'),
(89, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:13:22', '2024-02-02 13:13:22'),
(90, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:13:54', '2024-02-02 13:13:54'),
(91, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:13:58', '2024-02-02 13:13:58'),
(92, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:14:19', '2024-02-02 13:14:19'),
(93, 'U Hla', 'Aye', '2024-02-02', 5, 1, '2024-02-02 13:16:11', '2024-02-02 13:16:11'),
(94, 'U Hla', 'Aye', '2024-02-02', 7, 1, '2024-02-02 13:17:36', '2024-02-02 13:17:36'),
(95, 'Aye Mya', 'Thu', '2024-02-07', 12, 1, '2024-02-07 00:57:10', '2024-02-07 00:57:10'),
(96, 'Aye Mye', 'Phyu', '2024-02-08', 9, 1, '2024-02-07 00:59:17', '2024-02-07 00:59:17'),
(97, 'Hla Myint', 'Ko', '2024-02-07', 7, 1, '2024-02-07 01:01:47', '2024-02-07 01:01:47'),
(98, 'Thura', 'Myint', '2024-02-07', 9, 1, '2024-02-07 01:03:00', '2024-02-07 01:03:00'),
(99, 'Aung', 'Myint', '2024-02-07', 9, 1, '2024-02-07 01:06:23', '2024-02-07 01:06:23'),
(100, 'Hla Myint', 'Aye', '2024-02-07', 8, 1, '2024-02-07 01:10:32', '2024-02-07 01:10:32'),
(101, 'Hla Myint', 'Aye', '2024-02-07', 9, 1, '2024-02-07 01:13:42', '2024-02-07 01:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `slug`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Myanmar', 'myanmar', 1, '2023-12-09 10:58:31', '2023-12-09 10:58:31'),
(2, 'Thailand', 'thailand', 1, '2023-12-09 10:58:39', '2024-01-09 08:43:24'),
(3, 'Indonesia', 'indonesia', 1, '2023-12-09 10:58:50', '2023-12-09 10:58:50');

-- --------------------------------------------------------

--
-- Table structure for table `dayables`
--

CREATE TABLE `dayables` (
  `day_id` int NOT NULL,
  `dayable_id` int NOT NULL,
  `dayable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dayables`
--

INSERT INTO `dayables` (`day_id`, `dayable_id`, `dayable_type`) VALUES
(2, 1, 'App\\Models\\Post'),
(3, 1, 'App\\Models\\Post'),
(1, 2, 'App\\Models\\Post'),
(2, 2, 'App\\Models\\Post'),
(3, 2, 'App\\Models\\Post'),
(4, 2, 'App\\Models\\Post'),
(6, 2, 'App\\Models\\Post'),
(1, 3, 'App\\Models\\Post'),
(2, 3, 'App\\Models\\Post'),
(4, 3, 'App\\Models\\Post'),
(7, 3, 'App\\Models\\Post'),
(1, 4, 'App\\Models\\Post'),
(2, 4, 'App\\Models\\Post'),
(3, 4, 'App\\Models\\Post'),
(4, 4, 'App\\Models\\Post'),
(5, 4, 'App\\Models\\Post'),
(6, 4, 'App\\Models\\Post'),
(7, 4, 'App\\Models\\Post'),
(2, 5, 'App\\Models\\Post'),
(3, 5, 'App\\Models\\Post'),
(4, 5, 'App\\Models\\Post'),
(5, 5, 'App\\Models\\Post'),
(6, 5, 'App\\Models\\Post'),
(7, 5, 'App\\Models\\Post');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `name`, `slug`, `status_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Sunday', 'sunday', 4, 1, '2023-12-09 10:54:10', '2024-01-30 11:27:38'),
(2, 'Monday', 'monday', 3, 1, '2023-12-09 10:54:17', '2024-01-30 11:19:43'),
(3, 'Tuesday', 'tuesday', 3, 1, '2023-12-09 10:54:35', '2024-01-30 11:20:31'),
(4, 'Wednesday', 'wednesday', 3, 1, '2023-12-09 10:54:45', '2024-01-30 11:20:35'),
(5, 'Thursday', 'thursday', 3, 1, '2023-12-09 10:54:55', '2024-01-30 11:20:36'),
(6, 'Friday', 'friday', 3, 1, '2023-12-09 10:55:03', '2023-12-09 10:55:03'),
(7, 'Saturday', 'saturday', 3, 1, '2023-12-09 10:55:11', '2023-12-09 10:55:11');

-- --------------------------------------------------------

--
-- Table structure for table `edulinks`
--

CREATE TABLE `edulinks` (
  `id` bigint UNSIGNED NOT NULL,
  `classdate` date NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `edulinks`
--

INSERT INTO `edulinks` (`id`, `classdate`, `post_id`, `url`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2024-01-01', 1, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:18:17', '2024-01-12 12:18:17'),
(2, '2024-01-02', 2, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:51:32', '2024-01-12 12:51:32'),
(3, '2024-01-03', 3, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:51:41', '2024-01-12 12:51:41'),
(4, '2024-01-04', 4, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:51:48', '2024-01-12 12:51:48'),
(5, '2024-01-05', 4, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:52:08', '2024-01-12 12:52:08'),
(6, '2024-01-06', 1, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:52:16', '2024-01-12 12:52:16'),
(7, '2024-01-07', 4, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:52:25', '2024-01-12 12:52:25'),
(8, '2024-01-08', 4, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:52:33', '2024-01-12 12:52:33'),
(9, '2024-01-09', 1, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:52:38', '2024-01-12 12:52:38'),
(10, '2024-01-10', 4, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:52:45', '2024-01-12 12:52:45'),
(11, '2024-01-11', 2, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:52:53', '2024-01-12 12:52:53'),
(12, '2024-01-12', 2, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:53:03', '2024-01-12 12:53:03'),
(13, '2024-01-13', 3, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:53:11', '2024-01-12 12:53:11'),
(14, '2024-01-14', 4, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:53:23', '2024-01-12 12:53:23'),
(15, '2024-01-15', 3, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:53:34', '2024-01-12 12:53:34'),
(16, '2024-01-05', 3, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:53:47', '2024-01-12 12:53:47'),
(17, '2024-01-15', 3, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:53:58', '2024-01-12 12:53:58'),
(18, '2024-01-10', 2, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:54:19', '2024-01-12 12:54:19'),
(19, '2024-01-10', 2, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:54:24', '2024-01-12 12:54:24'),
(20, '2024-01-02', 3, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:54:31', '2024-01-12 12:54:31'),
(21, '2024-01-08', 2, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:54:45', '2024-01-12 12:54:45'),
(22, '2024-01-03', 4, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:54:52', '2024-01-12 12:54:52'),
(23, '2024-01-04', 4, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:54:59', '2024-01-12 12:54:59'),
(24, '2024-01-09', 1, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:55:06', '2024-01-12 12:55:06'),
(25, '2024-01-09', 3, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:55:18', '2024-01-12 12:55:18'),
(26, '2024-01-10', 4, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:55:48', '2024-01-13 14:16:27'),
(27, '2024-01-06', 3, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:55:57', '2024-01-12 12:55:57'),
(28, '2024-01-08', 4, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-12 12:56:03', '2024-01-13 14:16:16'),
(29, '2024-01-20', 4, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-13 14:17:09', '2024-01-13 14:17:09'),
(30, '2024-01-20', 4, 'https://www.mediafire.com/file/y30la0qm6n43zq7/12Nov2022MYSQL2.mp4', 1, '2024-01-13 14:21:47', '2024-01-13 14:21:47');

-- --------------------------------------------------------

--
-- Table structure for table `enrolls`
--

CREATE TABLE `enrolls` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `stage_id` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2' COMMENT '0 = Approved, 2 = Pending , 3 = Reject',
  `remark` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrolls`
--

INSERT INTO `enrolls` (`id`, `image`, `post_id`, `user_id`, `stage_id`, `remark`, `created_at`, `updated_at`) VALUES
(1, 'assets/img/enrolls/16594ba20db997viber_image_2022-08-11_06-46-44-901.jpg', 1, 1, '2', 'Hello Sir', '2024-01-03 01:36:32', '2024-01-03 01:36:32'),
(2, NULL, 4, 2, '2', 'Hello Aung Aung', '2024-01-06 09:05:00', '2024-01-06 09:05:00'),
(3, NULL, 3, 2, '2', 'Hello Aung Aung', '2024-01-06 09:05:18', '2024-01-06 09:05:18'),
(4, NULL, 2, 2, '2', 'Hello Aung Aung', '2024-01-06 09:05:35', '2024-01-06 09:05:35'),
(5, NULL, 4, 3, '2', 'Hello Su Su', '2024-01-06 09:06:15', '2024-01-06 09:06:15'),
(6, NULL, 4, 3, '2', 'Hello Su Su', '2024-01-06 09:06:16', '2024-01-06 09:06:16'),
(7, NULL, 3, 3, '2', 'Hello Su Su', '2024-01-06 09:06:32', '2024-01-06 09:06:32'),
(8, NULL, 2, 3, '1', 'Hello How Are You', '2024-01-06 09:06:49', '2024-01-06 10:51:44'),
(9, NULL, 2, 3, '2', 'Hello Su SU', '2024-01-06 09:06:50', '2024-01-06 09:06:50'),
(10, NULL, 4, 1, '2', 'Hello Admin', '2024-01-06 09:07:40', '2024-01-06 09:07:40'),
(11, NULL, 3, 1, '1', NULL, '2024-01-06 09:07:54', '2024-01-06 10:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follower_user`
--

CREATE TABLE `follower_user` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `follower_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follower_user`
--

INSERT INTO `follower_user` (`id`, `user_id`, `follower_id`, `created_at`, `updated_at`) VALUES
(3, 2, 1, '2024-02-10 12:48:47', '2024-02-10 12:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `name`, `slug`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Male', 'male', 1, '2023-12-09 10:57:28', '2023-12-09 10:57:28'),
(2, 'Female', 'female', 1, '2023-12-09 10:57:33', '2023-12-09 10:57:33'),
(3, 'Other', 'other', 1, '2023-12-09 10:57:39', '2023-12-09 10:57:39');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `tag` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stage_id` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2' COMMENT '1 = Approved, 2 = Pending , 3 = Reject',
  `authorize_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `post_id`, `startdate`, `enddate`, `tag`, `title`, `content`, `image`, `stage_id`, `authorize_id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 3, '2024-01-16', '2024-01-15', 2, 'Hello', '<p>Hello</p>', 'assets/img/leaves/165ae33a97c342AAO_photo.jpg', '3', NULL, 1, '2024-01-22 09:21:45', '2024-01-27 11:09:51'),
(5, 1, '2024-01-16', '2024-01-18', 2, 'Hello Class', '<p>Hi</p>', NULL, '2', NULL, 1, '2024-01-22 09:22:13', '2024-01-27 11:04:36'),
(6, 3, '2024-01-21', '2024-01-21', 3, 'Helllo Hi', '<p>Hello</p>', 'assets/img/leaves/165ae33e695953AAO_photo.jpg', '1', NULL, 1, '2024-01-22 09:22:46', '2024-01-22 15:38:42'),
(8, 3, '2024-01-25', '2024-01-30', 1, 'Hello Sir', '<p>Hello</p>', NULL, '2', NULL, 1, '2024-01-31 01:31:02', '2024-01-31 01:31:02'),
(9, 4, '2024-01-24', '2024-01-25', 3, 'Hello Sir Nice', 'Hi Say Somethig', NULL, '2', NULL, 2, '2024-01-31 01:54:21', '2024-01-31 01:54:21'),
(10, 3, '2024-01-24', '2024-01-24', 1, 'Hello Sir', 'Hello Sir Nice', NULL, '2', NULL, 2, '2024-01-31 01:55:10', '2024-01-31 01:55:10'),
(11, 3, '2024-01-31', '2024-01-31', 2, 'Hello Sir', '<p>Geeel</p>', NULL, '2', NULL, 1, '2024-01-31 01:56:30', '2024-01-31 01:56:30'),
(12, 1, '2024-01-31', '2024-01-31', 2, 'Hello', '<p>Hello</p>', NULL, '2', NULL, 1, '2024-01-31 02:13:36', '2024-01-31 02:13:36'),
(13, 1, '2024-01-31', '2024-01-31', 2, 'Hello', '<p>Hello</p>', NULL, '2', NULL, 1, '2024-01-31 02:14:10', '2024-01-31 02:14:10'),
(14, 1, '2024-01-31', '2024-01-31', 2, 'Hello', '<p>Hello</p>', NULL, '2', NULL, 1, '2024-01-31 02:14:33', '2024-01-31 02:14:33'),
(15, 1, '2024-01-31', '2024-01-31', 2, 'Hello', '<p>Hello</p>', NULL, '2', NULL, 1, '2024-01-31 02:14:51', '2024-01-31 02:14:51'),
(16, 1, '2024-01-31', '2024-01-31', 2, 'Hello', '<p>Hello</p>', NULL, '2', NULL, 1, '2024-01-31 02:15:01', '2024-01-31 02:15:01'),
(17, 1, '2024-01-31', '2024-01-31', 2, 'Hello', '<p>Hello</p>', NULL, '2', NULL, 1, '2024-01-31 02:17:47', '2024-01-31 02:17:47'),
(18, 1, '2024-01-31', '2024-01-31', 2, 'Hello', '<p>Hello</p>', NULL, '2', NULL, 1, '2024-01-31 02:18:24', '2024-01-31 02:18:24'),
(19, 3, '2024-01-31', '2024-01-31', 2, 'Hello Aung AUng', '<p>Hello Aung AUng</p>', NULL, '2', NULL, 1, '2024-01-31 02:24:31', '2024-01-31 02:24:31'),
(20, 3, '2024-02-01', '2024-02-01', 1, 'Hello Admin', '<p>Hello Admin</p>', NULL, '2', NULL, 1, '2024-02-01 01:00:24', '2024-02-01 01:00:24'),
(21, 3, '2024-02-01', '2024-02-01', 1, 'Hello Admin', '<p>Hello Admin</p>', NULL, '2', NULL, 2, '2024-02-01 01:02:29', '2024-02-01 01:02:29'),
(22, 3, '2024-02-01', '2024-02-01', 1, 'Hello Admin 1', '<p>Hello Admin</p>', NULL, '2', NULL, 2, '2024-02-01 01:04:15', '2024-02-01 01:04:15'),
(23, 2, '2024-02-01', '2024-02-01', 1, 'Hello Admin', '<p>Hello Admin</p>', NULL, '2', NULL, 2, '2024-02-01 01:23:10', '2024-02-01 01:23:10'),
(24, 4, '2024-02-01', '2024-02-01', 1, 'Hello Admin', '<p>Hello</p>', NULL, '2', NULL, 2, '2024-02-01 01:27:17', '2024-02-01 01:27:17'),
(25, 4, '2024-02-01', '2024-02-01', 1, 'Hello Admin 1', '<p>Hello</p>', NULL, '2', NULL, 2, '2024-02-01 01:27:45', '2024-02-01 01:27:45'),
(26, 2, '2024-02-01', '2024-02-01', 1, 'Hello Admin', '<p>Hello&nbsp;</p>', NULL, '2', NULL, 2, '2024-02-01 01:40:47', '2024-02-01 01:40:47'),
(27, 3, '2024-02-02', '2024-02-02', 2, 'Hello Aung Aung', '<p>Hi</p>', 'assets/img/leaves/165bcceca339faselectboxbutton.png', '2', NULL, 1, '2024-02-02 11:15:22', '2024-02-02 11:15:22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_28_135443_create_students_table', 1),
(6, '2023_10_28_135558_create_statuses_table', 1),
(7, '2023_11_18_211209_create_roles_table', 1),
(8, '2023_11_19_093636_create_cities_table', 1),
(9, '2023_11_19_103300_create_countries_table', 1),
(10, '2023_11_19_110019_create_genders_table', 1),
(11, '2023_11_20_165012_create_tags_table', 1),
(12, '2023_11_20_175621_create_categories_table', 1),
(13, '2023_11_22_072228_create_types_table', 1),
(14, '2023_11_23_074159_create_posts_table', 1),
(15, '2023_11_23_075816_create_attendances_table', 1),
(16, '2023_11_25_205533_create_comments_table', 1),
(17, '2023_11_25_214640_create_days_table', 1),
(18, '2023_12_02_183557_create_dayables_table', 1),
(19, '2023_12_09_191436_create_stages_table', 2),
(20, '2023_12_09_193447_create_enrolls_table', 3),
(21, '2024_01_12_180942_create_edulinks_table', 4),
(22, '2024_01_14_183655_create_relatives_table', 5),
(23, '2024_01_14_183844_create_contacts_table', 5),
(25, '2024_01_20_181547_create_leaves_table', 6),
(26, '2024_01_31_073259_create_notifications_table', 7),
(27, '2024_02_02_071110_create_announcements_table', 8),
(28, '2024_02_07_071537_create_jobs_table', 9),
(29, '2024_02_09_181612_create_post_like_table', 10),
(31, '2024_02_10_183529_create_follower_user_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('00367661-47bf-493b-a047-cfb0b3731039', 'App\\Notifications\\AnnouncementNotify', 'App\\Models\\User', 4, '{\"id\":18,\"title\":\"One\",\"image\":\"assets\\/img\\/announcements\\/165bccdb44c4c2selectboxbutton.png\"}', NULL, '2024-02-02 11:10:44', '2024-02-02 11:10:44'),
('3ec8d071-cf70-4cb8-9611-08778676e0fb', 'App\\Notifications\\AnnouncementNotify', 'App\\Models\\User', 2, '{\"id\":18,\"title\":\"One\",\"image\":\"assets\\/img\\/announcements\\/165bccdb44c4c2selectboxbutton.png\"}', '2024-02-02 11:15:26', '2024-02-02 11:10:44', '2024-02-02 11:10:44'),
('63bc36bb-23d6-4562-aba5-df4968695072', 'App\\Notifications\\AnnouncementNotify', 'App\\Models\\User', 3, '{\"id\":19,\"title\":\"Two\",\"image\":\"assets\\/img\\/announcements\\/165bcce2b9ce9cselectboxbutton.png\"}', NULL, '2024-02-02 11:12:43', '2024-02-02 11:12:43'),
('803ee2f7-81bb-4052-8bbd-a27c468b1954', 'App\\Notifications\\AnnouncementNotify', 'App\\Models\\User', 2, '{\"id\":19,\"title\":\"Two\",\"image\":\"assets\\/img\\/announcements\\/165bcce2b9ce9cselectboxbutton.png\"}', '2024-02-02 12:07:31', '2024-02-02 11:12:43', '2024-02-02 11:12:43'),
('a0461fcf-f180-48d6-9187-ba187a7190d4', 'App\\Notifications\\LeaveNotify', 'App\\Models\\User', 2, '{\"id\":27,\"title\":\"Hello Aung Aung\",\"studentId\":\"WDF1001\"}', '2024-02-02 11:18:14', '2024-02-02 11:15:22', '2024-02-02 11:15:22'),
('aca6391b-6012-45c9-81a5-ae1d4abda99a', 'App\\Notifications\\AnnouncementNotify', 'App\\Models\\User', 4, '{\"id\":19,\"title\":\"Two\",\"image\":\"assets\\/img\\/announcements\\/165bcce2b9ce9cselectboxbutton.png\"}', NULL, '2024-02-02 11:12:43', '2024-02-02 11:12:43'),
('b0bdfb03-75a1-40e9-9b21-36b7fad0ef5c', 'App\\Notifications\\AnnouncementNotify', 'App\\Models\\User', 4, '{\"id\":17,\"title\":\"One\",\"image\":\"assets\\/img\\/announcements\\/165bccd78bd807selectboxbutton.png\"}', NULL, '2024-02-02 11:09:44', '2024-02-02 11:09:44'),
('d5e4968a-b071-48ba-8dc9-ed2c49af6ca5', 'App\\Notifications\\AnnouncementNotify', 'App\\Models\\User', 3, '{\"id\":17,\"title\":\"One\",\"image\":\"assets\\/img\\/announcements\\/165bccd78bd807selectboxbutton.png\"}', NULL, '2024-02-02 11:09:44', '2024-02-02 11:09:44'),
('e539147f-6947-4f63-8abb-01c48ffde529', 'App\\Notifications\\AnnouncementNotify', 'App\\Models\\User', 3, '{\"id\":18,\"title\":\"One\",\"image\":\"assets\\/img\\/announcements\\/165bccdb44c4c2selectboxbutton.png\"}', NULL, '2024-02-02 11:10:44', '2024-02-02 11:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` decimal(8,2) NOT NULL DEFAULT '0.00',
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `type_id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL,
  `attshow` bigint UNSIGNED NOT NULL DEFAULT '4',
  `status_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `image`, `title`, `slug`, `content`, `fee`, `startdate`, `enddate`, `starttime`, `endtime`, `type_id`, `tag_id`, `attshow`, `status_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'assets/img/posts/1657448db43350Screenshot (1).png', 'WDF batch 2', 'wdf-batch-2', 'Hello Sir', '0.00', '2023-12-06', '2023-12-11', '19:30:00', '21:30:00', 1, 1, 3, 7, 1, '2023-12-09 11:00:43', '2023-12-09 13:21:20'),
(2, 'assets/img/posts/16574490c1e34dScreenshot (1).png', 'CSS Immediate', 'css-immediate', 'Hello Sir', '50000.00', '2023-12-07', '2023-12-13', '20:31:00', '22:31:00', 2, 2, 3, 7, 1, '2023-12-09 11:01:32', '2023-12-09 11:01:32'),
(3, 'assets/img/posts/1657d857e4dfb2656c04d5757ef1701577941logobo.jpg', 'Js Small App(batch-2)', 'js-small-appbatch-2', 'Hello Sir', '50000.00', '2023-12-16', '2023-12-19', '20:39:00', '20:39:00', 2, 3, 3, 7, 1, '2023-12-16 11:09:50', '2023-12-16 11:09:50'),
(4, 'assets/img/posts/16592105b6b911viber_image_2022-08-11_06-46-44-901.jpg', 'Ubuntu Linux Batch 2', 'ubuntu-linux-batch-2', '<p><span style=\"color: rgb(104, 116, 127); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">The fastest way to get </span><span style=\"font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 0);\">Summernot</span><span style=\"color: rgb(104, 116, 127); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">e is to download the <a href=\"https:www.google.com\" target=\"_blank\">precompiled</a> and minified versions of our CSS and JavaScript. No<b> documentation </b>or origina<u>l source code files </u>are included.</span><span style=\"background-color: rgb(255, 255, 255); color: rgb(104, 116, 127); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">The fastest way to get </span><span style=\"color: rgb(104, 116, 127); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); background-color: rgb(0, 0, 255);\">Summernote</span><span style=\"background-color: rgb(255, 255, 255); color: rgb(104, 116, 127); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\"> is to download the</span><span style=\"background-color: rgb(255, 255, 255); color: rgb(104, 116, 127); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; text-align: var(--bs-body-text-align);\"><b> precompiled </b></span><span style=\"background-color: rgb(255, 255, 255); color: rgb(104, 116, 127); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">and minified versions of our CSS and JavaScript. No documentation or original source code files are included.</span><span style=\"background-color: rgb(255, 255, 255); color: rgb(104, 116, 127); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">The fastest way to get Summernote is to download the precompiled and minified versions of our CSS and JavaScript. No documentation or original source code files are included.</span><span style=\"background-color: rgb(255, 255, 255); color: rgb(104, 116, 127); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">The fastest way to get Summernote is to download the precompiled and minified versions of our CSS and JavaScript. No documentation or original source code files are included.</span><br></p>', '2500.00', '2024-01-01', '2024-01-01', '07:35:00', '07:36:00', 2, 6, 3, 7, 1, '2024-01-01 01:07:39', '2024-01-01 01:07:39'),
(5, 'assets/img/posts/165c619d551a47Screenshot from 2024-02-07 13-59-10.png', 'PHP Batch 2', 'php-batch-2', '35000', '35000.00', '2024-02-14', '2024-02-20', '20:55:00', '21:55:00', 1, 2, 3, 7, 1, '2024-02-09 12:25:57', '2024-02-09 12:25:57');

-- --------------------------------------------------------

--
-- Table structure for table `post_like`
--

CREATE TABLE `post_like` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_like`
--

INSERT INTO `post_like` (`id`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '2024-02-09 12:12:03', '2024-02-09 12:12:03'),
(8, 5, 1, '2024-02-09 12:30:42', '2024-02-09 12:30:42');

-- --------------------------------------------------------

--
-- Table structure for table `relatives`
--

CREATE TABLE `relatives` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `relatives`
--

INSERT INTO `relatives` (`id`, `name`, `slug`, `status_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Mother', 'mother', 4, 1, '2023-11-21 15:45:34', '2024-02-10 17:28:48'),
(2, 'Father', 'father', 3, 1, '2024-01-15 12:33:24', '2024-01-14 12:33:24'),
(3, 'Parents', 'parents', 3, 1, '2023-11-24 11:33:52', '2023-11-24 13:21:53'),
(4, 'Brother', 'brother', 3, 1, '2023-11-24 13:21:53', '2023-11-24 11:33:52'),
(5, 'Sister', 'sister', 3, 1, '2023-12-03 04:08:37', '2023-11-24 08:01:00'),
(6, 'Son', 'son', 3, 1, '2023-11-24 08:01:00', '2023-11-24 08:01:00'),
(7, 'Daughter', 'daughter', 3, 1, '2024-01-02 12:34:03', '2024-01-08 12:34:03'),
(8, 'Child', 'child', 3, 1, '2024-01-09 12:35:38', '2024-01-08 12:35:38'),
(9, 'Friend', 'friend', 3, 1, '2024-01-08 12:35:38', '2024-01-08 12:35:38'),
(10, 'Spouse', 'spouse', 3, 1, '2024-01-15 12:35:38', '2024-01-09 12:35:38'),
(11, 'Partner', 'partner', 3, 1, '2024-01-15 12:35:38', '2024-01-16 12:35:38'),
(12, 'Assistant', 'assistant', 3, 1, '2024-01-08 12:35:38', '2024-01-09 12:35:38'),
(13, 'Manager', 'manager', 3, 1, '2024-01-08 12:35:38', '2024-01-10 12:35:38'),
(14, 'Other', 'other', 3, 1, '2024-01-08 12:35:38', '2024-01-08 12:35:38'),
(15, 'Sweet Heart', 'sweet-heart', 3, 1, '2024-01-08 12:35:38', '2024-01-08 12:35:38');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `image`, `name`, `slug`, `status_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'assets/img/roles/1659d1065cba77viber_image_2022-08-11_06-46-44-901.jpg', 'Admin', 'admin', 3, 1, '2024-01-09 09:22:45', '2024-01-30 11:46:32'),
(2, 'assets/img/roles/1659d10750a298viber_image_2022-08-11_06-46-44-901.jpg', 'Teacher', 'teacher', 3, 1, '2024-01-09 09:23:01', '2024-01-30 11:46:32'),
(3, 'assets/img/roles/1659d1083f0e47viber_image_2022-08-11_06-46-44-901.jpg', 'Student', 'student', 3, 1, '2024-01-09 09:23:15', '2024-01-30 11:46:34'),
(4, 'assets/img/roles/1659d10900c026viber_image_2022-08-11_06-46-44-901.jpg', 'Guest', 'guest', 3, 1, '2024-01-09 09:23:28', '2024-01-30 11:46:36');

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE `stages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `name`, `slug`, `user_id`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'Approved', 'approved', 1, 4, '2023-12-09 12:58:07', '2024-02-10 16:08:18'),
(2, 'Pending', 'pending', 1, 3, '2023-12-09 12:58:17', '2023-12-09 12:58:17'),
(3, 'Reject', 'reject', 1, 3, '2023-12-09 12:58:25', '2023-12-09 12:58:25'),
(4, 'Complete', 'complete', 1, 3, '2023-12-09 12:58:36', '2024-01-27 12:16:31'),
(5, 'Incomplete', 'incomplete', 1, 3, '2023-12-09 12:58:43', '2023-12-09 12:58:43'),
(6, 'Loading', 'loading', 1, 3, '2023-12-09 12:58:52', '2023-12-09 12:58:52'),
(7, 'Processing', 'processing', 1, 4, '2023-12-09 12:59:06', '2024-01-30 11:16:59'),
(8, 'Passed', 'passed', 1, 3, '2023-12-09 12:59:22', '2023-12-09 12:59:22'),
(9, 'Request', 'request', 1, 3, '2023-12-09 12:59:32', '2023-12-09 12:59:32'),
(10, 'Waiting', 'waiting', 1, 3, '2023-12-09 12:59:43', '2023-12-09 12:59:43'),
(11, 'Verifying', 'verifying', 1, 3, '2023-12-09 12:59:57', '2023-12-09 12:59:57'),
(12, 'Verified', 'verified', 1, 3, '2023-12-09 13:00:07', '2023-12-09 13:00:07');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `slug`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Active', 'active', 1, '2023-12-09 10:51:24', '2023-12-09 10:51:24'),
(2, 'Inactive', 'inactive', 1, '2023-12-09 10:51:31', '2023-12-09 10:51:31'),
(3, 'On', 'on', 1, '2023-12-09 10:51:38', '2023-12-09 10:51:38'),
(4, 'Off', 'off', 1, '2023-12-09 10:51:44', '2023-12-09 10:51:44'),
(5, 'Online', 'online', 1, '2023-12-09 10:51:51', '2023-12-09 10:51:51'),
(6, 'Offline', 'offline', 1, '2023-12-09 10:51:58', '2023-12-09 10:51:58'),
(7, 'Public', 'public', 1, '2023-12-09 10:52:04', '2023-12-09 10:52:04'),
(8, 'Private', 'private', 1, '2023-12-09 10:52:12', '2023-12-09 10:52:12'),
(9, 'Friend Only', 'friend-only', 1, '2023-12-09 10:52:23', '2023-12-09 10:52:23'),
(10, 'Member Only', 'member-only', 1, '2023-12-09 10:52:35', '2023-12-09 10:52:35'),
(11, 'Only Me', 'only-me', 1, '2023-12-09 10:52:44', '2023-12-09 10:52:44'),
(12, 'Enable', 'enable', 1, '2023-12-09 10:52:58', '2023-12-09 10:52:58'),
(13, 'Disable', 'disable', 1, '2023-12-09 10:53:09', '2023-12-09 10:53:09'),
(14, 'Ban', 'ban', 1, '2023-12-09 10:53:15', '2023-12-09 10:53:15'),
(15, 'Unban', 'unban', 1, '2023-12-09 10:53:22', '2023-12-09 10:53:22'),
(16, 'Block', 'block', 1, '2023-12-09 10:53:28', '2023-12-09 10:53:28'),
(17, 'Unblock', 'unblock', 1, '2023-12-09 10:53:47', '2023-12-09 10:53:47'),
(18, 'Terminate', 'terminate', 1, '2023-12-09 10:53:56', '2023-12-09 10:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `regnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `status_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `regnumber`, `firstname`, `lastname`, `slug`, `remark`, `status_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'WDF1001', 'Admin', 'Bot', 'adminbot', 'dolores recusandae doloremque dignissimos officia itaque possimus incidunt delectus, obcaecati officiis ullam, consequuntur pariatur nam. Quos sit maxime eius.', 1, 1, '2023-12-16 11:54:00', '2023-12-16 11:54:01'),
(2, 'WDF1002', 'Aung', 'Aung', 'aungaung', 'dolores recusandae doloremque dignissimos officia itaque possimus incidunt delectus, obcaecati officiis ullam, consequuntur pariatur nam. Quos sit maxime eius.', 1, 2, '2023-12-16 11:54:00', '2023-12-16 11:54:01'),
(3, 'WDF1003', 'Su', 'Su', 'susu', 'dolores recusandae doloremque dignissimos officia itaque possimus incidunt delectus, obcaecati officiis ullam, consequuntur pariatur nam. Quos sit maxime eius.', 1, 3, '2023-12-16 11:54:00', '2023-12-16 11:54:01'),
(4, 'WDF1004', 'Yu', 'Yu', 'yuyu', 'dolores recusandae doloremque dignissimos officia itaque possimus incidunt delectus, obcaecati officiis ullam, consequuntur pariatur nam. Quos sit maxime eius.', 1, 4, '2023-12-16 11:54:00', '2023-12-16 11:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `status_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'WDF', 'wdf', 4, 1, '2023-12-09 10:56:06', '2024-01-30 11:38:28'),
(2, 'CSS immedirate', 'css-immedirate', 3, 1, '2023-12-09 10:56:29', '2023-12-09 10:56:29'),
(3, 'Jquery', 'jquery', 3, 1, '2023-12-09 10:56:38', '2024-01-12 09:18:56'),
(4, 'Javascript Small App', 'javascript-small-app', 3, 1, '2023-12-09 10:56:45', '2024-01-12 09:19:11'),
(5, 'Bootstrap Projects', 'bootstrap-projects', 3, 1, '2023-12-09 10:56:53', '2024-01-12 09:19:33'),
(6, 'Mysql', 'mysql', 3, 1, '2024-01-01 01:04:20', '2024-01-12 09:19:46'),
(7, 'Tailwind CSS', 'tailwind-css', 3, 1, '2024-01-12 09:20:00', '2024-01-12 09:20:00'),
(8, 'JSON & Firebase', 'json-firebase', 3, 1, '2024-01-12 09:20:14', '2024-01-12 09:20:14'),
(9, 'ES 6', 'es-6', 3, 1, '2024-01-12 09:20:22', '2024-01-12 09:20:22'),
(10, 'PHP', 'php', 3, 1, '2024-01-12 09:20:28', '2024-01-12 09:20:28'),
(11, 'Laravel', 'laravel', 3, 1, '2024-01-12 09:20:54', '2024-01-12 09:20:54'),
(12, 'React', 'react', 3, 1, '2024-01-12 09:21:00', '2024-01-12 09:21:00'),
(13, 'Node', 'node', 3, 1, '2024-01-12 09:21:07', '2024-01-12 09:21:07'),
(14, 'Linux (Ubuntu)', 'linux-ubuntu', 3, 1, '2024-01-12 09:21:15', '2024-01-12 09:21:15'),
(15, 'AWS', 'aws', 3, 1, '2024-01-12 09:21:20', '2024-01-12 09:21:20'),
(16, 'News', 'news', 3, 1, '2024-01-12 09:21:25', '2024-01-12 09:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `slug`, `status_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Free', 'free', 4, 1, '2023-12-09 10:55:32', '2024-01-30 11:38:40'),
(2, 'Paid', 'paid', 3, 1, '2023-12-09 10:55:40', '2024-01-27 12:03:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'ninthprogramming.9p.hotmail@gmail.com', NULL, '$2y$10$1IJOPwzRt17qan.mQ1tcAOzoE1EuPKk5Um9990vart4nJ9KD2fiJK', 'RXkfjCWWMss4cci547PGQ7HblzUJc05jl3vRpcH4MFZQIl2EUnuOoy1qC30B', '2023-12-09 10:50:23', '2023-12-09 10:50:23'),
(2, 'aung aung', 'aungaung@gmail.com', NULL, '$2y$10$1IJOPwzRt17qan.mQ1tcAOzoE1EuPKk5Um9990vart4nJ9KD2fiJK', 'YDDb7fYAqGzs2fDHO2SDI7Z1cr8PjBqcJVKVwzjXXUWw2mRyN2egIlNMXirE', '2023-12-09 10:50:23', '2023-12-09 10:50:23'),
(3, 'su su', 'susu@gmail.com', NULL, '$2y$10$1IJOPwzRt17qan.mQ1tcAOzoE1EuPKk5Um9990vart4nJ9KD2fiJK', 'gVRYzSL0dWfef463EykskN1uA1KgJeGYYCwODGKHNk0dgzNCHDcBK8OtSxZz', '2023-12-09 10:50:23', '2023-12-09 10:50:23'),
(4, 'yu yu', 'yuyu@gmail.com', NULL, '$2y$10$1IJOPwzRt17qan.mQ1tcAOzoE1EuPKk5Um9990vart4nJ9KD2fiJK', 'qtmkq8krJU4NFL29WzPsFY2lZ0pm6SuHM5pVBK23zYvB3zk4Rsi1B7bG44aq', '2023-12-09 10:50:23', '2023-12-09 10:50:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_users_id` (`user_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `days_name_unique` (`name`);

--
-- Indexes for table `edulinks`
--
ALTER TABLE `edulinks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrolls`
--
ALTER TABLE `enrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `follower_user`
--
ALTER TABLE `follower_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follower_user_user_id_foreign` (`user_id`),
  ADD KEY `users_follower_id` (`follower_id`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_like`
--
ALTER TABLE `post_like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_like_post_id_foreign` (`post_id`),
  ADD KEY `posts_user_id` (`user_id`);

--
-- Indexes for table `relatives`
--
ALTER TABLE `relatives`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `relatives_name_unique` (`name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_regnumber_unique` (`regnumber`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `types_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `edulinks`
--
ALTER TABLE `edulinks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `enrolls`
--
ALTER TABLE `enrolls`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follower_user`
--
ALTER TABLE `follower_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post_like`
--
ALTER TABLE `post_like`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `relatives`
--
ALTER TABLE `relatives`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stages`
--
ALTER TABLE `stages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `follower_user`
--
ALTER TABLE `follower_user`
  ADD CONSTRAINT `follower_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_follower_id` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_like`
--
ALTER TABLE `post_like`
  ADD CONSTRAINT `post_like_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
