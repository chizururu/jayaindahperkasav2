-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jun 2023 pada 06.14
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jayasuksesmandiridb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksis`
--

CREATE TABLE `detail_transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaksi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_transaksis`
--

INSERT INTO `detail_transaksis` (`id`, `transaksi_id`, `nama_barang`, `harga_barang`, `jumlah_barang`, `sub_total`, `created_at`, `updated_at`) VALUES
(1, 1, 'Handgrip Sepeda UNITED', 50000, 10, 500000, '2023-06-24 00:55:50', '2023-06-24 00:55:50'),
(2, 1, 'Handgrip Sepeda Fixie', 30000, 9, 270000, '2023-06-24 00:55:50', '2023-06-24 00:55:50'),
(3, 2, 'Kunci Gembok Kabel Sepeda GENIO besar', 45000, 1, 45000, '2023-06-24 01:14:42', '2023-06-24 01:14:42'),
(4, 3, 'Kunci Gembok Kabel Sepeda UNITED', 100000, 1, 100000, '2023-06-24 01:16:11', '2023-06-24 01:16:11'),
(5, 4, 'Kunci Gembok Kabel Sepeda UNITED', 100000, 4, 400000, '2023-06-24 01:57:39', '2023-06-24 01:57:39'),
(6, 4, 'Kunci Gembok Kode Sepeda UNITED', 110000, 4, 440000, '2023-06-24 01:57:39', '2023-06-24 01:57:39'),
(7, 4, 'Kunci Gembok Rantai Kabel Sepeda GENIO', 30000, 2, 60000, '2023-06-24 01:57:39', '2023-06-24 01:57:39'),
(8, 6, 'Kunci Gembok Kabel Sepeda UNITED', 100000, 100, 10000000, '2023-06-24 04:11:53', '2023-06-24 04:11:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategoris`
--

INSERT INTO `kategoris` (`id`, `kategori`, `created_at`, `updated_at`) VALUES
(2, 'Kunci Gembok', '2023-06-22 14:55:50', '2023-06-22 14:57:41'),
(3, 'Lampu', '2023-06-22 14:56:00', '2023-06-22 14:58:14'),
(4, 'Standar', '2023-06-22 14:58:33', '2023-06-22 14:58:33'),
(5, 'Bel', '2023-06-22 14:58:56', '2023-06-22 14:58:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lapormasukans`
--

CREATE TABLE `lapormasukans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `pemasukan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lapormasukans`
--

INSERT INTO `lapormasukans` (`id`, `produk_id`, `pemasukan`, `created_at`, `updated_at`) VALUES
(3, 3, 9, '2023-06-22 15:04:58', '2023-06-22 15:04:58'),
(4, 4, 5, '2023-06-22 15:06:26', '2023-06-22 15:06:26'),
(5, 5, 35, '2023-06-22 15:07:14', '2023-06-22 15:07:14'),
(6, 6, 40, '2023-06-22 15:08:06', '2023-06-22 15:08:06'),
(7, 7, 2, '2023-06-22 15:09:27', '2023-06-22 15:09:27'),
(8, 8, 100, '2023-06-22 15:10:24', '2023-06-22 15:10:24'),
(9, 9, 10, '2023-06-22 15:11:02', '2023-06-22 15:11:02'),
(10, 10, 160, '2023-06-22 15:11:52', '2023-06-22 15:11:52'),
(11, 11, 7, '2023-06-22 15:12:38', '2023-06-22 15:12:38'),
(12, 12, 150, '2023-06-22 15:13:42', '2023-06-22 15:13:42'),
(13, 13, 100, '2023-06-22 15:14:26', '2023-06-22 15:14:26'),
(14, 14, 150, '2023-06-22 15:15:08', '2023-06-22 15:15:08'),
(15, 15, 200, '2023-06-22 15:15:45', '2023-06-22 15:15:45'),
(16, 16, 200, '2023-06-22 15:16:40', '2023-06-22 15:16:40'),
(17, 17, 50, '2023-06-22 15:17:09', '2023-06-22 15:17:09'),
(18, 18, 270, '2023-06-22 15:17:52', '2023-06-22 15:17:52'),
(19, 4, 100, '2023-06-24 04:07:17', '2023-06-24 04:07:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lapor_pengeluarans`
--

CREATE TABLE `lapor_pengeluarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `pengeluaran` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lapor_pengeluarans`
--

INSERT INTO `lapor_pengeluarans` (`id`, `produk_id`, `pengeluaran`, `created_at`, `updated_at`) VALUES
(3, 6, 1, '2023-06-24 01:14:42', '2023-06-24 01:14:42'),
(4, 4, 1, '2023-06-24 01:16:11', '2023-06-24 01:16:11'),
(5, 4, 4, '2023-06-24 01:57:39', '2023-06-24 01:57:39'),
(6, 5, 4, '2023-06-24 01:57:39', '2023-06-24 01:57:39'),
(7, 7, 2, '2023-06-24 01:57:39', '2023-06-24 01:57:39'),
(8, 4, 100, '2023-06-24 04:11:53', '2023-06-24 04:11:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(161, '2014_10_12_000000_create_users_table', 1),
(162, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(163, '2014_10_12_100000_create_password_resets_table', 1),
(164, '2019_08_19_000000_create_failed_jobs_table', 1),
(165, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(166, '2023_06_19_083433_create_produks_table', 1),
(167, '2023_06_19_083604_create_lapormasukans_table', 1),
(168, '2023_06_19_085238_add_id_produk_foreign_to_lapormasukans_tabel', 1),
(169, '2023_06_19_090217_create_kategoris_table', 1),
(170, '2023_06_19_090243_add_id_kategori_foreign_to_produks_tabel', 1),
(171, '2023_06_20_032625_create_lapor_pengeluarans_table', 1),
(172, '2023_06_20_124123_add_id_produk_foreign_id_to_laporanpengeluarans_table', 1),
(173, '2023_06_20_205217_create_transaksis_table', 1),
(174, '2023_06_21_222533_create_detail_transaksis_table', 1),
(175, '2023_06_21_222708_add_id_transaksi_foreign_id_to_detail_transaksis_table', 1),
(177, '2023_06_22_084431_add_id_produk_foreign_id_to_detail_transaksi_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `produks`
--

CREATE TABLE `produks` (
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
-- Dumping data untuk tabel `produks`
--

INSERT INTO `produks` (`id`, `kategori_id`, `nama_barang`, `harga_beli`, `harga_jual`, `jumlah_stok`, `satuan`, `created_at`, `updated_at`) VALUES
(3, 2, 'Kunci L Sepeda', 40000, 60000, 9, '1 pcs', '2023-06-22 15:04:58', '2023-06-22 15:04:58'),
(4, 2, 'Kunci Gembok Kabel Sepeda UNITED', 80000, 100000, 0, '1 pcs', '2023-06-22 15:06:26', '2023-06-24 04:11:53'),
(5, 2, 'Kunci Gembok Kode Sepeda UNITED', 95000, 110000, 31, '1 pcs', '2023-06-22 15:07:14', '2023-06-24 01:57:39'),
(6, 2, 'Kunci Gembok Kabel Sepeda GENIO besar', 35000, 45000, 39, '1 pcs', '2023-06-22 15:08:06', '2023-06-24 01:14:42'),
(7, 2, 'Kunci Gembok Rantai Kabel Sepeda GENIO', 25000, 30000, 0, '1 pcs', '2023-06-22 15:09:27', '2023-06-24 01:57:39'),
(8, 3, 'Lampu Sepeda Silikon', 5000, 15000, 100, '1 pcs', '2023-06-22 15:10:24', '2023-06-22 15:10:24'),
(9, 3, 'Lampu Sepeda USB', 85000, 100000, 10, '1 pcs', '2023-06-22 15:11:02', '2023-06-22 15:11:02'),
(10, 3, 'Lampu Sepeda Laser Tall Light', 60000, 70000, 160, '1 pcs', '2023-06-22 15:11:52', '2023-06-22 15:11:52'),
(11, 3, 'Lampu Sepeda GENIO 5 Led 3 Functions Set', 80000, 100000, 7, '1 pcs', '2023-06-22 15:12:38', '2023-06-22 15:12:38'),
(12, 4, 'Standar Paddock Sepeda', 55000, 80000, 140, '1 pcs', '2023-06-22 15:13:42', '2023-06-22 15:51:58'),
(13, 4, 'Standar MTB Aloy', 35000, 45000, 100, '1 pcs', '2023-06-22 15:14:26', '2023-06-22 15:14:26'),
(14, 4, 'Standar Double Sepeda UNITED', 40000, 55000, 150, '1 pcs', '2023-06-22 15:15:08', '2023-06-22 15:15:08'),
(15, 5, 'Bel Sepeda UNITED', 20000, 25000, 200, '1 pcs', '2023-06-22 15:15:45', '2023-06-22 15:15:45'),
(16, 5, 'Bel Sepeda Bola', 20000, 25000, 200, '1 pcs', '2023-06-22 15:16:40', '2023-06-22 15:16:40'),
(17, 5, 'Bel Sepeda Abu', 10000, 15000, 50, '1 pcs', '2023-06-22 15:17:09', '2023-06-22 15:17:09'),
(18, 5, 'Bel Sepeda Kuba Masjid', 20000, 25000, 270, '1 pcs', '2023-06-22 15:17:52', '2023-06-22 15:17:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `no_telepon` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `total_harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksis`
--

INSERT INTO `transaksis` (`id`, `nama_pelanggan`, `no_telepon`, `alamat`, `total_harga`, `created_at`, `updated_at`) VALUES
(1, 'Kevin Pratama', '082177979924', '-', 770000, '2023-06-24 00:55:49', '2023-06-24 00:55:49'),
(2, 'Stephanie', '082177979924', '-', 45000, '2023-06-24 01:14:42', '2023-06-24 01:14:42'),
(3, 'Kevin Pratama', '089507022116', '-', 100000, '2023-06-24 01:16:11', '2023-06-24 01:16:11'),
(4, 'Rendi', '082177979924', '-', 900000, '2023-06-24 01:57:39', '2023-06-24 01:57:39'),
(5, 'Juan', '082177979924', '-', 1000000, '2023-06-24 04:08:42', '2023-06-24 04:08:42'),
(6, 'Kevin Pratama', '082177979924', '-', 10000000, '2023-06-24 04:11:53', '2023-06-24 04:11:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'eddytjhai', 'eddytjhai74@gmail.com', NULL, 'eddytjhai', '2', NULL, '2023-06-23 06:51:22', '2023-06-23 06:51:22'),
(4, 'Stephanie', 'stephanietjhai@mhs.mdp.ac.id', NULL, '2024250070', '1', NULL, '2023-06-23 06:52:05', '2023-06-23 06:52:05');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_transaksis_transaksi_id_foreign` (`transaksi_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lapormasukans`
--
ALTER TABLE `lapormasukans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lapormasukans_produk_id_foreign` (`produk_id`);

--
-- Indeks untuk tabel `lapor_pengeluarans`
--
ALTER TABLE `lapor_pengeluarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lapor_pengeluarans_produk_id_foreign` (`produk_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produks_kategori_id_foreign` (`kategori_id`);

--
-- Indeks untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `lapormasukans`
--
ALTER TABLE `lapormasukans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `lapor_pengeluarans`
--
ALTER TABLE `lapor_pengeluarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  ADD CONSTRAINT `detail_transaksis_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `lapormasukans`
--
ALTER TABLE `lapormasukans`
  ADD CONSTRAINT `lapormasukans_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `lapor_pengeluarans`
--
ALTER TABLE `lapor_pengeluarans`
  ADD CONSTRAINT `lapor_pengeluarans_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produks`
--
ALTER TABLE `produks`
  ADD CONSTRAINT `produks_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
