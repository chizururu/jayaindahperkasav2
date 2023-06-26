-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jun 2023 pada 09.18
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
(2, 'Kunci Gembok', '2023-06-22 07:55:50', '2023-06-22 07:57:41'),
(3, 'Lampu', '2023-06-22 07:56:00', '2023-06-22 07:58:14'),
(4, 'Standar', '2023-06-22 07:58:33', '2023-06-22 07:58:33'),
(5, 'Bel', '2023-06-22 07:58:56', '2023-06-22 07:58:56'),
(6, 'Handgrip', '2023-06-26 06:58:32', '2023-06-26 07:11:53'),
(7, 'Velg', '2023-06-26 06:59:07', '2023-06-26 06:59:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lapormasukans`
--

CREATE TABLE `lapormasukans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `pemasukan` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lapormasukans`
--

INSERT INTO `lapormasukans` (`id`, `produk_id`, `pemasukan`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 'Menambahkan Barang Baru', '2023-06-26 04:22:41', '2023-06-26 04:22:41'),
(2, 1, 10, 'Penambahan Stok Barang', '2023-06-26 04:23:02', '2023-06-26 04:23:02'),
(3, 1, 100, 'Penambahan Stok Barang', '2023-06-26 04:27:00', '2023-06-26 04:27:00'),
(4, 1, 10, 'Penambahan Stok Barang', '2023-06-26 04:27:42', '2023-06-26 04:27:42'),
(5, 2, 5, 'Menambahkan Barang Baru', '2023-06-26 07:00:38', '2023-06-26 07:00:38'),
(6, 3, 35, 'Menambahkan Barang Baru', '2023-06-26 07:02:05', '2023-06-26 07:02:05'),
(7, 4, 40, 'Menambahkan Barang Baru', '2023-06-26 07:03:21', '2023-06-26 07:03:21'),
(8, 5, 2, 'Menambahkan Barang Baru', '2023-06-26 07:03:51', '2023-06-26 07:03:51'),
(9, 6, 100, 'Menambahkan Barang Baru', '2023-06-26 07:04:36', '2023-06-26 07:04:36'),
(10, 7, 10, 'Menambahkan Barang Baru', '2023-06-26 07:05:07', '2023-06-26 07:05:07'),
(11, 8, 160, 'Menambahkan Barang Baru', '2023-06-26 07:05:42', '2023-06-26 07:05:42'),
(12, 9, 7, 'Menambahkan Barang Baru', '2023-06-26 07:06:06', '2023-06-26 07:06:06'),
(13, 10, 150, 'Menambahkan Barang Baru', '2023-06-26 07:07:04', '2023-06-26 07:07:04'),
(14, 11, 100, 'Menambahkan Barang Baru', '2023-06-26 07:07:50', '2023-06-26 07:07:50'),
(15, 12, 150, 'Menambahkan Barang Baru', '2023-06-26 07:08:21', '2023-06-26 07:08:21'),
(16, 13, 200, 'Menambahkan Barang Baru', '2023-06-26 07:09:05', '2023-06-26 07:09:05'),
(17, 14, 50, 'Menambahkan Barang Baru', '2023-06-26 07:09:45', '2023-06-26 07:09:45'),
(18, 15, 270, 'Menambahkan Barang Baru', '2023-06-26 07:10:10', '2023-06-26 07:10:10'),
(19, 16, 9, 'Menambahkan Barang Baru', '2023-06-26 07:13:12', '2023-06-26 07:13:12'),
(20, 17, 9, 'Menambahkan Barang Baru', '2023-06-26 07:13:45', '2023-06-26 07:13:45'),
(21, 18, 3, 'Menambahkan Barang Baru', '2023-06-26 07:15:12', '2023-06-26 07:15:12'),
(22, 19, 8, 'Menambahkan Barang Baru', '2023-06-26 07:16:07', '2023-06-26 07:16:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lapor_pengeluarans`
--

CREATE TABLE `lapor_pengeluarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `pengeluaran` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lapor_pengeluarans`
--

INSERT INTO `lapor_pengeluarans` (`id`, `produk_id`, `pengeluaran`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 'Pengurangan Stok Barang', '2023-06-26 04:23:13', '2023-06-26 04:23:13'),
(2, 1, 100, 'Pengurangan Stok Barang', '2023-06-26 04:27:31', '2023-06-26 04:27:31');

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
(226, '2014_10_12_000000_create_users_table', 1),
(227, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(228, '2014_10_12_100000_create_password_resets_table', 1),
(229, '2019_08_19_000000_create_failed_jobs_table', 1),
(230, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(231, '2023_06_19_083433_create_produks_table', 1),
(232, '2023_06_19_083604_create_lapormasukans_table', 1),
(233, '2023_06_19_085238_add_id_produk_foreign_to_lapormasukans_tabel', 1),
(234, '2023_06_19_090217_create_kategoris_table', 1),
(235, '2023_06_19_090243_add_id_kategori_foreign_to_produks_tabel', 1),
(236, '2023_06_20_032625_create_lapor_pengeluarans_table', 1),
(237, '2023_06_20_124123_add_id_produk_foreign_id_to_laporanpengeluarans_table', 1),
(238, '2023_06_20_205217_create_transaksis_table', 1),
(239, '2023_06_21_222533_create_detail_transaksis_table', 1),
(240, '2023_06_21_222708_add_id_transaksi_foreign_id_to_detail_transaksis_table', 1),
(241, '2023_06_22_084431_add_id_produk_foreign_id_to_detail_transaksi_table', 1);

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
(1, 2, 'Kunci L Sepeda', 40000, 60000, 20, '1 pcs', '2023-06-26 04:22:41', '2023-06-26 04:27:42'),
(2, 2, 'Kunci Gembok Kabel Sepeda UNITED', 80000, 100000, 5, '1 pcs', '2023-06-26 07:00:38', '2023-06-26 07:00:38'),
(3, 2, 'Kunci Gembok Kode Sepeda UNITED', 85000, 110000, 35, '1 pcs', '2023-06-26 07:02:05', '2023-06-26 07:02:05'),
(4, 2, 'Kunci Gembok Kabel Sepeda GENIO besar', 30000, 45000, 40, '1 pcs', '2023-06-26 07:03:21', '2023-06-26 07:03:21'),
(5, 2, 'Kunci Gembok Rantai Kabel Sepeda GENIO', 20000, 30000, 2, '1 pcs', '2023-06-26 07:03:50', '2023-06-26 07:03:50'),
(6, 3, 'Lampu Sepeda Silikon', 5000, 15000, 100, '1 pcs', '2023-06-26 07:04:36', '2023-06-26 07:04:36'),
(7, 3, 'Lampu Sepeda USB', 80000, 100000, 10, '1 pcs', '2023-06-26 07:05:07', '2023-06-26 07:05:07'),
(8, 3, 'Lampu Sepeda Laser Tall Light', 60000, 70000, 160, '1 pcs', '2023-06-26 07:05:42', '2023-06-26 07:05:42'),
(9, 3, 'Lampu Sepeda GENIO 5 Led 3 Functions Set', 80000, 100000, 7, '1 pcs', '2023-06-26 07:06:06', '2023-06-26 07:06:06'),
(10, 4, 'Standar Paddock Sepeda', 65000, 80000, 150, '1 pcs', '2023-06-26 07:07:04', '2023-06-26 07:07:04'),
(11, 4, 'Standar MTB Aloy', 45000, 55000, 100, '1 pcs', '2023-06-26 07:07:50', '2023-06-26 07:07:50'),
(12, 4, 'Standar Double Sepeda UNITED', 45000, 55000, 150, '1 pcs', '2023-06-26 07:08:21', '2023-06-26 07:08:21'),
(13, 5, 'Bel Sepeda Bola', 15000, 25000, 200, '1 pcs', '2023-06-26 07:09:05', '2023-06-26 07:09:05'),
(14, 5, 'Bel Sepeda Abu', 10000, 15000, 50, '1 pcs', '2023-06-26 07:09:45', '2023-06-26 07:09:45'),
(15, 5, 'Bel Sepeda Kuba Masjid', 15000, 25000, 270, '1 pcs', '2023-06-26 07:10:10', '2023-06-26 07:10:10'),
(16, 6, 'Handgrip Sepeda Fixie', 17000, 30000, 9, '1 pcs', '2023-06-26 07:13:12', '2023-06-26 07:13:12'),
(17, 6, 'Handgrip Sepeda UNITED', 35000, 50000, 9, '1 pcs', '2023-06-26 07:13:45', '2023-06-26 07:13:45'),
(18, 7, 'Velg Wheelset Racing Bintang 26 Alloy MTB', 1400000, 1500000, 3, '1 pcs', '2023-06-26 07:15:12', '2023-06-26 07:15:12'),
(19, 7, 'Velg Aloy 20 Lipat Hap Jangkrik RAZE PRO', 1000000, 1450000, 8, '1 pcs', '2023-06-26 07:16:07', '2023-06-26 07:16:07');

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
(1, 'Eddy Tjhai', 'eddytjhai74@gmail.com', NULL, '$2y$10$48xAQRasNOidojhzZ/Y0Z.mMDjQAtPtiUHPQWWdyoaBSQnQGs/yqG', '2', NULL, '2023-06-26 04:21:14', '2023-06-26 04:21:14');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `lapormasukans`
--
ALTER TABLE `lapormasukans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `lapor_pengeluarans`
--
ALTER TABLE `lapor_pengeluarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
