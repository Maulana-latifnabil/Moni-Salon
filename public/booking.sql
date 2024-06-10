-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2024 at 04:32 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `barber_id` bigint UNSIGNED NOT NULL,
  `additional_notes` text COLLATE utf8mb4_unicode_ci,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `full_name`, `phone_number`, `address`, `booking_date`, `booking_time`, `barber_id`, `additional_notes`, `payment_method`, `snap_token`, `created_at`, `updated_at`, `status`, `user_id`) VALUES
(1, 'Customer', '087778610193', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-06-07', '09:00:00', 2, NULL, 'cash', NULL, '2024-06-07 07:30:13', '2024-06-07 07:31:48', 'waiting', NULL),
(2, 'Customer', '087778610193', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-06-07', '09:00:00', 2, '...', 'cash', NULL, '2024-06-07 07:31:17', '2024-06-07 07:31:50', 'waiting', NULL),
(3, 'Customer', '087778610193', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-06-08', '09:00:00', 2, NULL, 'cash', NULL, '2024-06-07 08:12:22', '2024-06-07 08:12:31', 'waiting', NULL),
(4, 'Customer', '087778610193', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-06-22', '09:00:00', 2, NULL, 'cash', NULL, '2024-06-07 08:13:37', '2024-06-07 08:13:40', 'waiting', NULL),
(5, 'Customer', '087778610193', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-06-30', '09:00:00', 2, NULL, 'cash', NULL, '2024-06-07 08:15:30', '2024-06-07 08:16:55', 'waiting', NULL),
(6, 'Customer', '087778610193', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-06-27', '09:00:00', 2, NULL, 'cash', NULL, '2024-06-07 08:16:51', '2024-06-07 08:17:33', 'waiting', NULL),
(7, 'Customer', '087778610193', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-07-06', '09:00:00', 2, 'ada', 'cash', NULL, '2024-06-07 08:17:28', '2024-06-07 08:17:30', 'waiting', NULL),
(8, 'Customer', '087778610193', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-07-09', '09:00:00', 2, NULL, 'cash', NULL, '2024-06-07 08:22:07', '2024-06-07 08:22:13', 'waiting', NULL),
(9, 'Customer', '087778610193', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-07-29', '09:00:00', 2, NULL, 'cash', NULL, '2024-06-07 08:22:43', '2024-06-07 08:22:46', 'waiting', NULL),
(10, 'Customer', '087778610193', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-07-31', '09:00:00', 2, NULL, 'cash', NULL, '2024-06-07 08:28:26', '2024-06-07 08:28:29', 'waiting', NULL),
(11, 'Customer', '087778610193', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-07-27', '09:00:00', 2, NULL, 'cash', NULL, '2024-06-07 08:29:10', '2024-06-07 08:29:13', 'waiting', NULL),
(12, 'Wagyu', '08121320452', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-06-07', '10:00:00', 2, '1', 'cash', NULL, '2024-06-07 08:44:56', '2024-06-07 08:45:00', 'waiting', 4),
(13, 'Wagyu', '08121320452', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-06-07', '11:00:00', 2, '2', 'cash', NULL, '2024-06-07 08:45:34', '2024-06-07 08:45:36', 'waiting', 4),
(14, 'Wagyu', '08121320452', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-06-07', '12:00:00', 2, '3', 'cash', NULL, '2024-06-07 08:46:07', '2024-06-07 08:46:10', 'waiting', 4),
(15, 'Wagyu', '08121320452', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-06-07', '14:00:00', 2, '4', 'cash', NULL, '2024-06-07 08:46:44', '2024-06-07 08:46:48', 'waiting', 4),
(16, 'Wagyu', '08121320452', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-06-07', '15:00:00', 2, '5', 'cash', NULL, '2024-06-07 08:47:23', '2024-06-07 08:47:27', 'waiting', 4),
(17, 'Wagyu', '08121320452', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-06-07', '16:00:00', 2, '6', 'cash', NULL, '2024-06-07 08:48:34', '2024-06-07 08:48:44', 'waiting', 4),
(18, 'Wagyu', '08121320452', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-06-07', '18:00:00', 2, NULL, 'cash', NULL, '2024-06-07 08:49:56', '2024-06-07 08:50:04', 'waiting', 4),
(19, 'Wagyu', '08121320452', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-06-07', '19:00:00', 2, '...', 'cash', NULL, '2024-06-07 09:05:02', '2024-06-07 09:05:06', 'waiting', 4),
(20, 'Wagyu', '08121320452', 'jl.Pramuka RT02/01, Bunder Jatiluhur Purwakarta', '2024-06-08', '10:00:00', 2, '1', 'cash', NULL, '2024-06-07 09:14:28', '2024-06-07 09:14:31', 'waiting', 4);

-- --------------------------------------------------------

--
-- Table structure for table `booking_service`
--

CREATE TABLE `booking_service` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_service`
--

INSERT INTO `booking_service` (`id`, `booking_id`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 3, 2, NULL, NULL),
(5, 4, 2, NULL, NULL),
(6, 5, 1, NULL, NULL),
(7, 6, 1, NULL, NULL),
(8, 6, 2, NULL, NULL),
(9, 7, 1, NULL, NULL),
(10, 7, 2, NULL, NULL),
(11, 8, 1, NULL, NULL),
(12, 8, 2, NULL, NULL),
(13, 9, 1, NULL, NULL),
(14, 9, 2, NULL, NULL),
(15, 10, 1, NULL, NULL),
(16, 10, 2, NULL, NULL),
(17, 11, 1, NULL, NULL),
(18, 11, 2, NULL, NULL),
(19, 12, 1, NULL, NULL),
(20, 12, 2, NULL, NULL),
(21, 13, 2, NULL, NULL),
(22, 14, 1, NULL, NULL),
(23, 15, 1, NULL, NULL),
(24, 16, 1, NULL, NULL),
(25, 17, 2, NULL, NULL),
(26, 18, 2, NULL, NULL),
(27, 19, 1, NULL, NULL),
(28, 20, 1, NULL, NULL);

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
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2024_05_28_033139_create_services_table', 1),
(8, '2024_05_28_045559_create_permission_tables', 1),
(9, '2024_05_28_154606_create_bookings_table', 1),
(10, '2024_06_03_031418_create_booking_service_table', 1),
(11, '2024_06_06_090314_add_status_to_bookings_table', 1),
(12, '2024_06_07_071456_add_duration_to_services_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage users', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(2, 'create users', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(3, 'edit users', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(4, 'delete users', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(5, 'assign roles', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(6, 'manage roles', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(7, 'create roles', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(8, 'edit roles', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(9, 'delete roles', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(10, 'manage permissions', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(11, 'assign permissions', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(12, 'view bookings', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(13, 'manage bookings', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(14, 'create services', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(15, 'edit services', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(16, 'delete services', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(17, 'view services', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(18, 'create bookings', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(19, 'edit bookings', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(20, 'cancel bookings', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(21, 'view own bookings', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(22, 'katalog customer', 'web', '2024-06-07 07:20:59', '2024-06-07 07:20:59'),
(23, 'katalog admin', 'web', '2024-06-07 07:21:11', '2024-06-07 07:21:11'),
(24, 'katalog barber', 'web', '2024-06-07 07:21:26', '2024-06-07 07:21:26');

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(2, 'Barber', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(3, 'Customer', 'web', '2024-06-07 07:19:36', '2024-06-07 07:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
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
(23, 1),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(24, 2),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(8,2) NOT NULL,
  `duration` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`, `duration`, `created_at`, `updated_at`) VALUES
(1, 'Hair Color', 'Mewarnai rambut sesuai keinginan', '200000.00', 120, '2024-06-07 07:23:43', '2024-06-07 07:23:43'),
(2, 'Haircut Dewasa', 'Potong rambut pria dewasa', '50000.00', 60, '2024-06-07 07:24:08', '2024-06-07 07:24:08');

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
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$JDVrCBb7jk0gJf1EJoLtUO6wmlDKa/sRcZQo0Z5uLST5OIRSTSQbG', NULL, NULL, NULL, '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(2, 'Ujang', 'ujang@gmail.com', NULL, '$2y$10$6oGvYF6pXlO2Tt/bBYEMGeV5sz.ZBt4WRoXCxxK3GMWyDJEcKtRpW', NULL, NULL, NULL, '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(3, 'Customer', 'customer@gmail.com', NULL, '$2y$10$Zd03IOswYu07goBOKS6i0eHInfK2EHKUnOWZ.kvGHcBhvcVdV9Yju', NULL, NULL, NULL, '2024-06-07 07:19:36', '2024-06-07 07:19:36'),
(4, 'Wagyu', 'wagyu@gmai.com', NULL, '$2y$10$JIsMkwmG.9uBBztIwAkipe3ghCu3V2yul6ItxOoYpxlGU08PdzYPW', NULL, NULL, NULL, '2024-06-07 08:44:26', '2024-06-07 08:44:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_barber_id_foreign` (`barber_id`);

--
-- Indexes for table `booking_service`
--
ALTER TABLE `booking_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_service_booking_id_foreign` (`booking_id`),
  ADD KEY `booking_service_service_id_foreign` (`service_id`);

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
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `booking_service`
--
ALTER TABLE `booking_service`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
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
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_barber_id_foreign` FOREIGN KEY (`barber_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_service`
--
ALTER TABLE `booking_service`
  ADD CONSTRAINT `booking_service_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_service_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

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
