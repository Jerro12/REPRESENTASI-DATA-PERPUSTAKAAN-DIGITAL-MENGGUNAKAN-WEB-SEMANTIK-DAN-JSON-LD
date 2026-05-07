-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2026 at 02:57 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_buku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bahasa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subjek` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `jumlah_halaman` int(11) DEFAULT NULL,
  `stok_buku` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `kode_buku`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `isbn`, `bahasa`, `category_id`, `deskripsi`, `subjek`, `file_path`, `cover`, `status`, `jumlah_halaman`, `stok_buku`, `created_at`, `updated_at`, `deleted_at`) VALUES
(101, 'BK-S-001', 'Sejarah Perkembangan Ilmu Komputer dari Masa ke Masa', 'Raditya Dika', 'Gramedia Pustaka', 2019, '978-602-000-111-1', 'Indonesia', 1, 'Buku sejarah lengkap mengenai awal mula komputer ditemukan hingga era modern saat ini.', 'Ilmu Komputer, Sejarah', 'files/sejarah-komputer.pdf', 'covers/sejarah-komputer.jpg', 'aktif', 350, 0, '2026-04-24 10:47:44', '2026-04-24 10:47:44', NULL),
(102, 'BK-S-002', 'Kalkulus Lanjut dan Matematika Diskrit', 'Prof. Arya Matematika', 'Penerbit ITB', 2021, '978-602-000-222-2', 'Indonesia', 13, 'Buku matematika yang sangat relevan dengan komputasi.', 'Matematika', 'files/kalkulus.pdf', 'covers/kalkulus.jpg', 'aktif', 210, 0, '2026-04-24 10:47:44', '2026-04-24 10:47:44', NULL),
(103, 'BK-S-003', 'Mastering Pemrograman Web Fullstack', 'Eko Kurniawan', 'Programmer Zaman Now', 2023, '978-602-000-333-3', 'Indonesia', 10, 'Buku terbaru untuk belajar teknik dasar hingga profesional framework Laravel & Vue.', 'Pemrograman Web', 'files/web-fullstack.pdf', 'covers/web-fullstack.jpg', 'aktif', 420, 0, '2026-04-24 10:47:44', '2026-04-24 10:47:44', NULL),
(104, 'BK-S-004', 'Machine Learning & Kecerdasan Buatan Terapan', 'Tere Liye', 'Republika', 2020, '978-602-000-444-4', 'Indonesia', 8, 'Pendekatan AI dan implementasi machine learning dengan python.', 'Artificial Intelligence', 'files/ai-ml.pdf', 'covers/ai-ml.jpg', 'aktif', 500, 0, '2026-04-24 10:47:44', '2026-04-24 10:47:44', NULL),
(105, 'BK-S-005', 'Seni Keamanan Jaringan dan Kriptografi', 'Budi Rahardjo', 'Informatika Bandung', 2015, '978-602-000-555-5', 'Indonesia', 6, 'Buku klasik terkait pengamanan firewall dan enkripsi data.', 'Keamanan Informasi', 'files/kripto.pdf', 'covers/kripto.jpg', 'aktif', 300, 0, '2026-04-24 10:47:44', '2026-04-24 10:47:44', NULL),
(106, 'BK-S-006', 'Data Science for Business Insight', 'Dwi Handoko', 'Erlangga', 2022, '978-602-000-666-6', 'Inggris', 9, 'Panduan eksekutif dalam memanfaatkan data analitik.', 'Data Science', 'files/ds-business.pdf', 'covers/ds-business.jpg', 'aktif', 280, 0, '2026-04-24 10:47:44', '2026-04-24 10:47:44', NULL),
(107, 'BK-S-007', 'Manajemen Proyek TI dan Scrum Framework', 'Habiburrahman El Shirazy', 'Andi Offset', 2018, '978-602-000-777-7', 'Indonesia', 15, 'Metodologi Agile dan teknik SCRUM komprehensif.', 'Manajemen Proyek TI', 'files/scrum.pdf', 'covers/scrum.jpg', 'aktif', 600, 0, '2026-04-24 10:47:44', '2026-04-24 10:47:44', NULL),
(108, 'BK-S-008', 'Don\'t Make Me Think: Revolusi UI/UX', 'Steve Krug', 'Elex Media', 2014, '978-602-000-888-8', 'Indonesia', 18, 'Dasar usability engineer pada website dan aplikasi mobile.', 'Desain UI/UX', 'files/ui-ux.pdf', 'covers/ui-ux.jpg', 'aktif', 150, 0, '2026-04-24 10:47:44', '2026-04-24 10:47:44', NULL),
(109, 'BK-S-009', 'Etika Sosial dalam Era Literasi Digital', 'Fiersa Besari', 'Kawah Media', 2024, '978-602-000-999-9', 'Indonesia', 20, 'Berkomunikasi santun dan anti hoaks di internet (Buku Terbaru).', 'Literasi Digital', 'files/literasi.pdf', 'covers/literasi.jpg', 'aktif', 180, 0, '2026-04-24 10:47:44', '2026-04-24 10:47:44', NULL),
(110, 'BK-S-010', 'Pemrograman Sistem Informasi Rumah Sakit', 'Romi Satria Wahono', 'Ilmukomputer.com', 2020, '978-602-000-110-0', 'Indonesia', 3, 'Panduan lengkap merancang SIMRS berbassis web modern.', 'Sistem Informasi', 'files/simrs.pdf', 'covers/simrs.jpg', 'aktif', 460, 0, '2026-04-24 10:47:44', '2026-04-24 10:47:44', NULL),
(151, 'BK001', '20 Sifat Allah', 'Nur Khoiro Ummatin', 'Cempaka Putih', 2008, '9789796623105', 'Indonesia', 23, 'Membahas sifat wajib, mustahil, dan jaiz bagi Allah.', 'Aqidah', NULL, 'covers/azrDJl361r1zwESUJwE47YxY7qlQ1qqsWgHcYfkN.jpg', 'aktif', 68, 0, '2026-04-25 09:23:06', '2026-04-25 09:23:06', NULL),
(152, 'BK002', 'Amalan yang Dicintai Allah', 'Fathur Rahman', 'Insan Madani', 2010, '9786021234567', 'Indonesia', 23, 'Berisi amalan-amalan yang dicintai Allah dalam kehidupan sehari-hari.', 'Ibadah, Amal', NULL, 'covers/4DDWw1z4qn4EDfjlZ2jMRfiod6NjZswJoH7BF0rb.jpg', 'aktif', 120, 2, '2026-04-25 09:56:04', '2026-05-04 00:30:35', NULL),
(153, 'BK003', 'Al-Zakat', 'Mamlualul Maghfiroh', 'Insan Madani', 2011, '9786022345678', 'Indonesia', 23, 'Membahas hukum, jenis, dan pelaksanaan zakat dalam Islam.', 'Fiqih, Zakat', NULL, 'covers/ZFHQV17onNz6K7NSZOyGwwzC8vszlXOA2ElzowvQ.jpg', 'aktif', 100, 1, '2026-04-25 10:01:43', '2026-05-04 00:29:56', NULL),
(154, 'BK004', '9 Karakter Guru Efektif', 'Rusman', 'Erlangga', 2012, '9786022410635', 'Indonesia', 24, 'Menjelaskan karakter yang harus dimiliki guru agar pembelajaran efektif.', 'Pendidikan, Guru', NULL, 'covers/F41R32sXPX36WmqbyKNfD78qFveDkG74zKTPj5pv.jpg', 'aktif', 192, 5, '2026-04-25 10:04:25', '2026-05-04 00:17:19', NULL),
(155, 'BK005', 'Menjadi Guru Profesional', 'Drs. Asep Jihad, M.Pd', 'Remaja Rosdakarya', 2010, '9789791234567', 'Indonesia', 24, 'Panduan menjadi guru profesional dan kompeten.', 'Guru, Profesional', NULL, 'covers/iOIQnwoEMFXk2tUvebUdwuQGzhrfMSutTnSmu2yf.jpg', 'aktif', 150, 4, '2026-04-25 10:10:20', '2026-05-04 00:28:52', NULL),
(156, 'BK006', 'Etos Keguruan', 'Jansen Sinamo', 'Erlangga', 2009, '9786023456789', 'Indonesia', 24, 'Etika dan profesionalisme guru', 'Pendidikan, Guru', NULL, 'covers/UxptlzvKZu5GJJQQWsIteZ9cL5t6QgINm4TytcgU.jpg', 'aktif', 180, 3, '2026-04-25 10:16:13', '2026-05-04 00:28:09', NULL),
(157, 'BK007', 'Akuntansi', 'M. Sabashon', 'Trans Mandiri Abadi', 2010, '9789799876543', 'Indonesia', 25, 'Dasar pencatatan keuangan.', 'Akuntansi', NULL, 'covers/WBAu24qXzZXU5sot2fX9lkFXpqQqn3HovlJbm31Z.jpg', 'aktif', 200, 3, '2026-04-25 10:20:49', '2026-05-04 00:27:32', NULL),
(158, 'BK008', 'Akuntansi Keuangan Lanjutan', 'Goldrido Karyawati', 'Erlangga', 2012, '9786024567890', 'Indonesia', 25, 'Akuntansi tingkat lanjutan.', 'Akuntansi', NULL, 'covers/ncpGP1aI3GnQl5i8fXUic7CO8hHYdQV4HJVsjEw1.jpg', 'aktif', 250, 3, '2026-04-25 10:24:44', '2026-05-04 00:26:14', NULL),
(159, 'BK009', 'Asyik Merakit Perangkat Keras Komputer', 'Ariyono', 'MKS PT.Multi Kreasi Satudelapan', 2011, '9789798765432', 'Indonesia', 26, 'Panduan merakit komputer.', 'Komputer', NULL, 'covers/z1u200OQOb649ANu3KrZ59zhw5iEG0N8tYLhDXrf.jpg', 'aktif', 115, 1, '2026-04-25 10:29:07', '2026-05-04 00:25:50', NULL),
(160, 'BK010', 'Mengenal Jaringan Komputer', 'Muhammad Hasim', 'Adhi Aksara', 2013, '9786025678901', 'Indonesia', 26, 'Dasar jaringan komputer.', 'Jaringan', NULL, 'covers/DS8V5LLcIBXjLYpNa5IOmgjY8h7bYpINA0pmFgvr.jpg', 'aktif', 140, 2, '2026-04-25 10:32:36', '2026-05-04 00:25:23', NULL),
(161, 'BK011', 'Abu Bakar Ash-Shiddiq', 'Iwan Budhi Santoso', 'Insan Madani', 2010, '9786026789012', 'Indonesia', 27, 'Biografi khalifah pertama.', 'Tokoh Islam', NULL, 'covers/pMvcpNujagCmPxGOx53JPb3AAlOSaKj78KPfTMyz.jpg', 'aktif', 114, 5, '2026-04-25 10:35:37', '2026-05-04 00:22:56', NULL),
(162, 'BK012', 'Ali bin Abi Thalib', 'Dzikry el-Han', 'Insan Madani', 2011, '9786027890123', 'Indonesia', 27, 'Biografi khalifah keempat.', 'Tokoh Agama', NULL, 'covers/ch2pUaAJ8ltYOwHvHVKuIFJZIYXD039AzuRsEfUG.jpg', 'aktif', 130, 1, '2026-04-25 10:39:42', '2026-05-04 00:19:12', NULL),
(163, 'BK013', 'Aku Bukan Generasi Narkoba', 'Naya Salsabila', 'CV.Rahma Media Pustaka', 2014, '9786028901234', 'Indonesia', 28, 'Edukasi bahaya narkoba.', 'Narkoba', NULL, 'covers/TpuVt4FX4eVnwNW30Layen5IP6Q4HQczQ8DM6a47.jpg', 'aktif', 85, 1, '2026-04-25 10:42:46', '2026-05-04 00:18:41', NULL),
(164, 'BK014', 'Dampak Narkoba', 'Eddy Junaedy', 'CV.Suara Media Sejahtera', 2013, '9786029012345', 'Indonesia', 28, 'Dampak penyalahgunaan narkoba.', 'Narkoba', NULL, 'covers/v3RRKT5VlgnHsSGHRbXwrxBAX3H7Pi5kAHOytqpQ.jpg', 'aktif', 110, 1, '2026-04-25 10:47:31', '2026-05-04 00:18:11', NULL),
(165, 'BK015', 'Alat Musik Tradisional di Indonesia', 'Risma Dewi', 'Adhi Baskara', 2012, '9786020123456', 'Indonesia', 29, 'Pengenalan alat musik tradisional Indonesia.', 'Seni', NULL, 'covers/g4t6J2LQ8xJG8PWHTDzXcsUAmdkTiHSFUhuI3ptE.jpg', 'aktif', 100, 2, '2026-04-25 10:51:29', '2026-05-02 11:38:15', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_kode_buku_unique` (`kode_buku`),
  ADD UNIQUE KEY `books_isbn_unique` (`isbn`),
  ADD KEY `books_category_id_foreign` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
