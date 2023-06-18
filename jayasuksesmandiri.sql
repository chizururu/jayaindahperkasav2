-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2023 at 09:50 AM
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
-- Database: `jayasuksesmandiri`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailtransaksis`
--

CREATE TABLE `detailtransaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inventaris_id` bigint(20) UNSIGNED NOT NULL,
  `transaksi_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `jumlah_stok` int(11) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`id`, `kategori_id`, `nama_barang`, `harga_beli`, `harga_jual`, `jumlah_stok`, `satuan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kunci Gembok Kabel Sepeda GENIO', 30000, 45000, 40, '1 pcs', '2023-06-18 07:20:24', '2023-06-18 07:20:24'),
(2, 1, 'Kunci Gembok Kabel Sepeda UNITED', 90000, 100000, 5, '1 pcs', '2023-06-18 07:21:39', '2023-06-18 07:21:39'),
(3, 1, 'Kunci Gembok Kode Sepeda UNITED', 90000, 110000, 35, '1 pcs', '2023-06-18 07:22:31', '2023-06-18 07:22:31'),
(4, 2, 'Wheelset Velg Racing Bintang 26 Alloy MTB', 1350000, 1500000, 3, '1 pcs', '2023-06-18 07:24:24', '2023-06-18 07:24:24'),
(5, 2, 'Velg Aloy 20 Lipat Hap Jangkrik RAZE PRO', 1200000, 1450000, 8, '1 pcs', '2023-06-18 07:25:25', '2023-06-18 07:25:25'),
(6, 3, 'Standar Paddock Sepeda', 60000, 80000, 150, '1 pcs', '2023-06-18 07:27:20', '2023-06-18 07:27:20'),
(7, 3, 'Standar MTB Aloy', 38000, 45000, 100, '1 pcs', '2023-06-18 07:29:11', '2023-06-18 07:29:11'),
(8, 3, 'Standar Double Sepeda UNITED', 35000, 45000, 150, '1 pcs', '2023-06-18 07:30:17', '2023-06-18 07:30:17'),
(9, 4, 'Hangrip UNITED', 20000, 25000, 12, '1 pcs', '2023-06-18 07:32:28', '2023-06-18 07:32:28'),
(10, 4, 'Hangrip Fixie', 25000, 30000, 9, '1 pcs', '2023-06-18 07:33:23', '2023-06-18 07:33:23'),
(11, 6, 'Bel Sepeda Bola', 20000, 25000, 200, '1 pcs', '2023-06-18 07:35:25', '2023-06-18 07:35:25'),
(12, 6, 'Bel Sepeda Abu', 10000, 15000, 50, '1 pcs', '2023-06-18 07:36:08', '2023-06-18 07:36:08'),
(13, 6, 'Bel Sepeda Kuba Masjid', 15000, 25000, 270, '1 pcs', '2023-06-18 07:36:52', '2023-06-18 07:36:52'),
(14, 5, 'Lampu Sepeda Silikon', 5000, 15000, 100, '1 pcs', '2023-06-18 07:37:51', '2023-06-18 07:37:51'),
(15, 5, 'Lampu Sepeda USB', 90000, 100000, 10, '1 pcs', '2023-06-18 07:38:30', '2023-06-18 07:38:30'),
(16, 5, 'Lampu Sepeda Laser Tall Light', 50000, 70000, 160, '1 pcs', '2023-06-18 07:39:19', '2023-06-18 07:39:19'),
(17, 5, 'Lampu Sepeda GENIO 5 Led 3 Functions Set', 90000, 100000, 7, '1 pcs', '2023-06-18 07:40:19', '2023-06-18 07:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `kategori`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Kunci Gembok', '-', '2023-06-18 07:18:35', '2023-06-18 07:18:35'),
(2, 'Velg', '-', '2023-06-18 07:23:19', '2023-06-18 07:23:19'),
(3, 'Standar', '-', '2023-06-18 07:25:55', '2023-06-18 07:25:55'),
(4, 'Hangrip', '-', '2023-06-18 07:31:19', '2023-06-18 07:31:19'),
(5, 'Lampu', '-', '2023-06-18 07:34:16', '2023-06-18 07:34:16'),
(6, 'Bel', '-', '2023-06-18 07:34:25', '2023-06-18 07:34:25');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_04_25_005328_create_inventaris_table', 1),
(7, '2023_04_25_013929_create_transaksis_table', 1),
(8, '2023_04_25_015937_create_detailtransaksis_table', 1),
(9, '2023_04_26_062251_add_inventaris_id_to_detailtransaksis_table', 1),
(10, '2023_04_26_062335_add_transaksi_id_to_detailtransaksis_table', 1),
(11, '2023_04_28_135112_create_kategoris_table', 1),
(12, '2023_04_28_164706_add_kategori_id_to_inventaris_table', 1);

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
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `no_telepon` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Stephanie', 'stephanietjhai@mhs.mdp.ac.id', NULL, 'stephanie492', 1, NULL, '2023-06-18 07:14:16', '2023-06-18 07:14:16'),
(2, 'Jaya Sukses Mandiri', 'jayasuksesmandiri74@gmail.com', NULL, 'jayasuksesmandiri', 1, NULL, '2023-06-18 07:15:16', '2023-06-18 07:15:16'),
(3, 'Kevin Pratama', 'kevinpratama161000@mhs.mdp.ac.id', NULL, '2024250070', 1, NULL, '2023-06-18 07:15:57', '2023-06-18 07:15:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailtransaksis`
--
ALTER TABLE `detailtransaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detailtransaksis_inventaris_id_foreign` (`inventaris_id`),
  ADD KEY `detailtransaksis_transaksi_id_foreign` (`transaksi_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventaris_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
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
-- AUTO_INCREMENT for table `detailtransaksis`
--
ALTER TABLE `detailtransaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailtransaksis`
--
ALTER TABLE `detailtransaksis`
  ADD CONSTRAINT `detailtransaksis_inventaris_id_foreign` FOREIGN KEY (`inventaris_id`) REFERENCES `inventaris` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailtransaksis_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD CONSTRAINT `inventaris_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
