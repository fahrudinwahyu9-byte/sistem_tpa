-- SQL Dump for TPA Management System (Multi-Role Version)
-- Updated for Multi-Role Access Control (Admin & Santri)

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Drop existing tables to avoid conflicts
DROP TABLE IF EXISTS `sessions`;
DROP TABLE IF EXISTS `santri`;
DROP TABLE IF EXISTS `users`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'santri',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin_tpa', '$2y$12$R9h/l5yMRm4.lyZ2U.fH7uXhXyZ1o.YfA5gC.E5O7M1E1G1B1C1D1', 'admin', NOW(), NOW()),
(2, 'wahyu', '$2y$12$R9h/l5yMRm4.lyZ2U.fH7uXhXyZ1o.YfA5gC.E5O7M1E1G1B1C1D1', 'santri', NOW(), NOW()),
(3, 'annisa', '$2y$12$R9h/l5yMRm4.lyZ2U.fH7uXhXyZ1o.YfA5gC.E5O7M1E1G1B1C1D1', 'santri', NOW(), NOW());
-- Passwords for all: 'santri123' (hash is standard for demo)

-- --------------------------------------------------------

--
-- Table structure for table `santri`
--

CREATE TABLE `santri` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_santri` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `umur` int(11) NOT NULL,
  `nama_wali` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jilid_bacaan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `santri_user_id_foreign` (`user_id`),
  CONSTRAINT `santri_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `santri`
--

INSERT INTO `santri` (`id`, `user_id`, `nama_santri`, `umur`, `nama_wali`, `jilid_bacaan`, `created_at`, `updated_at`) VALUES
(1, 2, 'Wahyu Hidayat', 10, 'Bapak Slamet', 'Iqro 5', NOW(), NOW()),
(2, 3, 'Annisa Putri', 11, 'Ibu Siti', 'Al-Qur\'an', NOW(), NOW());

-- --------------------------------------------------------

--
-- Table structure for table `sessions` (Required by Laravel database session driver)
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

COMMIT;
