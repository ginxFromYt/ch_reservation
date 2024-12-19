-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 02:38 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ch_reservattion`
--

-- --------------------------------------------------------

--
-- Table structure for table `baptism_details`
--

CREATE TABLE `baptism_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `event_id` varchar(225) DEFAULT NULL,
  `reservation_id` varchar(225) DEFAULT NULL,
  `child_name` varchar(255) DEFAULT NULL,
  `child_bday` varchar(225) DEFAULT NULL,
  `child_birthcert` varchar(225) DEFAULT NULL,
  `child_birthplace` varchar(225) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `mother_bday` varchar(225) DEFAULT NULL,
  `mother_birthplace` varchar(225) DEFAULT NULL,
  `mother_religion` varchar(225) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `father_bday` varchar(225) DEFAULT NULL,
  `father_birthplace` varchar(225) DEFAULT NULL,
  `father_religion` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `contact_number` varchar(225) DEFAULT NULL,
  `sponsor_female` varchar(255) DEFAULT NULL,
  `sponsor_male` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `baptism_details`
--

INSERT INTO `baptism_details` (`id`, `user_id`, `event_id`, `reservation_id`, `child_name`, `child_bday`, `child_birthcert`, `child_birthplace`, `mother_name`, `mother_bday`, `mother_birthplace`, `mother_religion`, `father_name`, `father_bday`, `father_birthplace`, `father_religion`, `address`, `contact_number`, `sponsor_female`, `sponsor_male`, `created_at`, `updated_at`) VALUES
(1, '2', '3', '2', 'Shabe Burr', '2023-12-02', 'child_birthcerts/Ww6mMFWYUpBPlWaSRR0iYkq52vihtPy27LOaFlRA.jpg', 'Aparri, Cagayan', 'Shang Burr', '1996-12-02', 'Gaddang, Aparri, Cagayan', 'Catholic', 'Shano Burr', '1996-12-02', 'Tug. City', 'Catholic', 'Centro 15, Aparri, Cagayan', '1231231231', 'Alice Guo', 'Apollo Quiboloy', '2024-12-16 06:23:49', '2024-12-16 06:23:49');

-- --------------------------------------------------------

--
-- Table structure for table `burial_details`
--

CREATE TABLE `burial_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `event_id` varchar(255) DEFAULT NULL,
  `reservation_id` varchar(255) DEFAULT NULL,
  `name_deceased` varchar(255) NOT NULL,
  `date_birth` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `cause_of_death` varchar(255) DEFAULT NULL,
  `place_of_burial` varchar(255) DEFAULT NULL,
  `date_burial` varchar(225) DEFAULT NULL COMMENT 'must be date of reservation\r\n',
  `time_burial` varchar(225) DEFAULT NULL,
  `date_death` varchar(225) DEFAULT NULL,
  `time_death` varchar(225) DEFAULT NULL,
  `cert_death` varchar(225) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `relationship` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `burial_details`
--

INSERT INTO `burial_details` (`id`, `user_id`, `event_id`, `reservation_id`, `name_deceased`, `date_birth`, `age`, `civil_status`, `cause_of_death`, `place_of_burial`, `date_burial`, `time_burial`, `date_death`, `time_death`, `cert_death`, `contact_person`, `relationship`, `address`, `contact_number`, `email`, `created_at`, `updated_at`) VALUES
(1, '2', '5', '3', 'serf', '1987-12-02', '28', 'married', 'adewfnjk', 'jandfjk', '2024-12-26', NULL, '2024-12-12', '08:25', 'death_certs/zJa5RwAWVayhqqQzKWOBTAzrdlQNXheE5CWYXRJV.png', 'testing', 'wife', NULL, 'erfgse', NULL, '2024-12-16 23:29:36', '2024-12-16 23:29:36');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('902ba3cda1883801594b6e1b452790cc53948fda', 'i:1;', 1734534993),
('902ba3cda1883801594b6e1b452790cc53948fda:timer', 'i:1734534993;', 1734534993),
('fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f', 'i:1;', 1734537558),
('fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f:timer', 'i:1734537558;', 1734537558),
('samuel@mail.com|127.0.0.1', 'i:1;', 1734347107),
('samuel@mail.com|127.0.0.1:timer', 'i:1734347107;', 1734347107),
('test2@mail.com|127.0.0.1', 'i:1;', 1728479313),
('test2@mail.com|127.0.0.1:timer', 'i:1728479313;', 1728479313),
('user1234@mail.com|127.0.0.1', 'i:1;', 1734399680),
('user1234@mail.com|127.0.0.1:timer', 'i:1734399680;', 1734399680),
('user2@example.com|127.0.0.1', 'i:1;', 1734347219),
('user2@example.com|127.0.0.1:timer', 'i:1734347219;', 1734347219);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Sunday Mass', 'A weekly mass service for all parishioners.', '2024-09-16 22:02:51', '2024-09-16 22:02:51'),
(2, 'Wedding Ceremony', 'A holy matrimony service for couples.', '2024-09-16 22:02:51', '2024-09-16 22:02:51'),
(3, 'Baptism', 'A baptism ceremony for infants and adults.', '2024-09-16 22:02:51', '2024-09-16 22:02:51'),
(4, 'Christmas Eve Mass', 'A special mass service held on the eve of Christmas.', '2024-09-16 22:02:51', '2024-09-16 22:02:51'),
(5, 'Burial Mass', 'A mass service held in remembrance of a deceased loved one.', '2024-09-16 22:02:51', '2024-09-16 22:02:51');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_09_17_001425_create_roles_table', 2),
(5, '2024_09_17_001645_create_role_users_table', 3),
(6, '2024_09_17_051711_create_events_table', 4),
(7, '2024_09_17_060559_create_reservations_table', 5),
(8, '2024_09_20_021123_create_baptism_details_table', 6),
(9, '2024_09_20_024416_create_wedding_details_table', 7),
(10, '2024_09_21_054018_create_burial_details_table', 8),
(11, '2024_09_21_081628_create_wedding_details_table', 9);

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
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reservation_date` varchar(225) DEFAULT NULL,
  `reservation_time` varchar(225) DEFAULT NULL,
  `status` enum('pending','approved','rejected','lapsed/finished') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `event_id`, `user_id`, `reservation_date`, `reservation_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 5, '2024-12-16', '9:30 AM', 'lapsed/finished', '2024-12-16 03:35:08', '2024-12-17 07:14:00'),
(2, 3, 2, '2024-12-21', '9:30 AM', 'pending', '2024-12-16 06:23:49', '2024-12-17 06:15:03'),
(3, 5, 2, '2024-12-26', '8:00 AM', 'approved', '2024-12-16 23:29:36', '2024-12-18 07:27:08'),
(4, 2, 7, '2024-12-29', '2:00 PM', 'pending', '2024-12-18 09:10:18', '2024-12-18 09:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '2024-09-16 16:31:34', '2024-09-16 16:31:34'),
(2, 'User', 'user', '2024-09-16 16:31:34', '2024-09-16 16:31:34');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL),
(3, 2, NULL, NULL),
(4, 2, NULL, NULL),
(5, 2, NULL, NULL),
(6, 2, NULL, NULL),
(7, 2, NULL, NULL),
(8, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BLc4K3jCiAvZddGwfemCud9v2H5Ip3Bqn2z4QDle', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZUQ1clBBTlh6d3ZWZU9xSTRHTnBtUDJZd3daWm05MnBCbG9lalZPRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2Jvb2tyZXNlcnZhdGlvbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjc7czozOiJ1cmwiO2E6MDp7fX0=', 1734542205),
('g90qK2QHq1RWnQAJJVsN2yAmIRjcjj8uDe9uOXUM', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoienNiYVVZaUpDR0xXMmE3ZGw4RG5Kc3I4M0MwcFhXMWZSSGVqaVVzRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1734542203),
('KAJXqhQiXMSXvr47uDd6MSMxqYqxBMyhSI7Yb1tY', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRG42MzdxVlpIRWJRbE9VSGliY2s3bGwwakg3VDh0NDdlaWZLUjZmbSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkP21vbnRoPTIwMjUtMDEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3O30=', 1734542204),
('m56ZF6gWfLAqRKiFWsPP4nzZnv3NTQ0paTJ8vJ3F', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoic2dnTWxmZUhJaFZHeWRlNk5QMFd0ZlRjRzR5RFA4MHRWYWlzdlhVdyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdXNlci9ib29rcmVzZXJ2YXRpb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo4O30=', 1734542278),
('RNOiGw2Bu3uu4XlZHnnk8OqQGCWjOWjn4GGaxsCL', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWE1ycmRuWnpLOU5VMnI4Q1RWQkZvZ1g4alBxVmlycW9PWW84RmFlRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo4O3M6MzoidXJsIjthOjA6e319', 1734542205);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'churchadmin@gmail.com', '2024-09-16 19:21:13', '$2y$12$l341EVII7vfPG/NIXLlYnO37lDObzas4Sr3n4lR2skVRuEt3geqWy', NULL, '2024-09-16 19:21:13', '2024-09-16 19:21:13'),
(2, 'Test User', 'user@example.com', '2024-09-16 19:21:13', '$2y$12$IBO5TIP9oqC6nU0y0ernJ.seNWVxnlIv126/wn9vHgRNzJ6MmJqfK', NULL, '2024-09-16 19:21:13', '2024-09-16 19:21:13'),
(3, 'test', 'test@mail.com', '2024-10-09 06:43:12', '$2y$12$hvy5O2fQ8Bar8PCkoWgAVuDxNmh9xyNWu7zIQVNLOePy07OQgSVPm', NULL, '2024-09-16 19:26:11', '2024-09-16 19:26:11'),
(4, 'test3', 'test3@mail.com', NULL, '$2y$12$NMZLJUZpORo/mNTre.V4gOKOEBikPUWLCTWM1.OfgAtQd6t.EUbQ.', NULL, '2024-10-08 23:19:44', '2024-10-08 23:19:44'),
(5, 'teting1234', 'test1234@mail.com', NULL, '$2y$12$qXN9apzoTRjAEUWAd0B/OOWdNz5OWfgZ0mP36nkb41Q/zjFgkXEqG', NULL, '2024-12-16 03:06:48', '2024-12-16 03:06:48'),
(6, 'fvrsgthn', 'centro5@mail.com', NULL, '$2y$12$5Scmoh8qct15bfdUPEy8.ux5yNHweUEIIIdWDQlYBjjSc97vSC9Jy', NULL, '2024-12-18 07:09:32', '2024-12-18 07:09:32'),
(7, 'Gino Carlo', 'darkangelgino@gmail.com', '2024-12-18 07:15:33', '$2y$12$70UtuwBhcQ0urB2cDtQbr.TLmfrJe3ZzjK2t.oFGrHko5ClpiGP.e', NULL, '2024-12-18 07:10:43', '2024-12-18 07:15:33'),
(8, 'Ruby T Girna', 'rubygirna18@gmail.com', '2024-12-18 07:58:18', '$2y$12$bOrb3friOVS5sainYIfi3OeEkq3ioshG10TdTzXy.WUJr93YEStgS', NULL, '2024-12-18 07:55:47', '2024-12-18 07:58:18');

-- --------------------------------------------------------

--
-- Table structure for table `wedding_details`
--

CREATE TABLE `wedding_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `event_id` varchar(225) DEFAULT NULL,
  `reservation_id` varchar(225) DEFAULT NULL,
  `groom_name` varchar(225) DEFAULT NULL,
  `groom_birth_date` varchar(225) DEFAULT NULL,
  `groom_age` varchar(225) DEFAULT NULL,
  `groom_birth_place` varchar(255) DEFAULT NULL,
  `groom_address` varchar(255) DEFAULT NULL,
  `groom_father_name` varchar(255) DEFAULT NULL,
  `groom_mother_name` varchar(255) DEFAULT NULL,
  `groom_religion` varchar(100) DEFAULT NULL,
  `groom_job` varchar(100) DEFAULT NULL,
  `bride_name` varchar(255) DEFAULT NULL,
  `bride_birth_date` varchar(225) DEFAULT NULL,
  `bride_age` varchar(225) DEFAULT NULL,
  `bride_birth_place` varchar(255) DEFAULT NULL,
  `bride_address` varchar(255) DEFAULT NULL,
  `bride_father_name` varchar(255) DEFAULT NULL,
  `bride_mother_name` varchar(255) DEFAULT NULL,
  `bride_religion` varchar(100) DEFAULT NULL,
  `bride_job` varchar(100) DEFAULT NULL,
  `marriage_file` varchar(255) DEFAULT NULL,
  `wedding_participants` int(11) DEFAULT NULL,
  `wedding_notes` text DEFAULT NULL,
  `sponsor_ninong1` varchar(255) DEFAULT NULL,
  `sponsor_ninang1` varchar(255) DEFAULT NULL,
  `sponsor_ninong2` varchar(255) DEFAULT NULL,
  `sponsor_ninang2` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wedding_details`
--

INSERT INTO `wedding_details` (`id`, `user_id`, `event_id`, `reservation_id`, `groom_name`, `groom_birth_date`, `groom_age`, `groom_birth_place`, `groom_address`, `groom_father_name`, `groom_mother_name`, `groom_religion`, `groom_job`, `bride_name`, `bride_birth_date`, `bride_age`, `bride_birth_place`, `bride_address`, `bride_father_name`, `bride_mother_name`, `bride_religion`, `bride_job`, `marriage_file`, `wedding_participants`, `wedding_notes`, `sponsor_ninong1`, `sponsor_ninang1`, `sponsor_ninong2`, `sponsor_ninang2`, `created_at`, `updated_at`) VALUES
(1, '5', '2', '1', 'serg', '1996-12-02', '28', 'sdfg', 'sdfg', 'srdfg', 'serfg', 'sedrfg', 'sretg', 'sergf', '1996-12-02', '28', 'sergf', 'serg', 'sergt', 'serfg', 'ser', 'sertfg', 'marriage_file/wdrZAsnEaXTW687AW7EDeIWuCW4CD15RdRKz3etK.jpg', NULL, NULL, 'serg', 'sertw', 'ftdyjf', 'fytj', '2024-12-16 03:35:08', '2024-12-16 03:35:08'),
(2, '7', '2', '4', 'Shano Barukbuk', '9966-12-02', '99', 'sdfgvase', 'esdfesf', 'awefawef', 'asdfa', 'dfgh', 'dfgh', 'shane burr', '1996-12-02', '99', 'def', 'aef', 'awef', 'awefd', 'awef', 'awef', 'marriage_file/LS5nTRcKZXZqaOWl3UBCt8ga4AnpeBb8xGyI9LFM.png', NULL, NULL, 'awef', 'awef', 'aewrf', 'fewa', '2024-12-18 09:10:18', '2024-12-18 09:10:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baptism_details`
--
ALTER TABLE `baptism_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `burial_details`
--
ALTER TABLE `burial_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_event_id_foreign` (`event_id`),
  ADD KEY `reservations_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_role_unique` (`role`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_users_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wedding_details`
--
ALTER TABLE `wedding_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baptism_details`
--
ALTER TABLE `baptism_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `burial_details`
--
ALTER TABLE `burial_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wedding_details`
--
ALTER TABLE `wedding_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
