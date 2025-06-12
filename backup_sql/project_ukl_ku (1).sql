-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jun 2025 pada 14.10
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_ukl_ku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `reading_time` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `articles`
--

INSERT INTO `articles` (`id`, `title`, `description`, `image`, `tags`, `url`, `text`, `source`, `reading_time`) VALUES
(3, 'Pengelolaan Sumberdaya Alam dan Pelestarian Lingkungan Hidup melalui Hukum Adat SASI di Indonesia', 'Artikel ini bertujuan untuk mengklasifikasikan artikel ilmiah yang berkaitan dengan pengelolaan sumber daya alam dan pelestarian lingkungan hidup di Indonesia, dengan fokus pada hukum adat SASI. Hukum adat ini melarang pengambilan hasil sumber daya alam tertentu dalam jangka waktu tertentu untuk menjaga keberlanjutan.', 'BGR UKL.JPG', 'Artikel', 'https://egas.pubmedia.id/index.php/rei/article/view/1', 'Penelitian ini menggunakan metode Systematic Literature Review (SLR) untuk menganalisis data dari database ilmiah selama 2019–2023. Dari 199 artikel, hanya 15 yang relevan membahas pengelolaan sumber daya, pelestarian lingkungan, integrasi hukum adat dalam agama, dan tantangan implementasi hukum adat SASI. Penelitian ini menyoroti pentingnya pengelolaan berkelanjutan untuk mencegah eksploitasi sumber daya alam Indonesia yang kaya keanekaragaman hayati.', 'Pubmedia', '10 menit baca'),
(5, 'Pilar Sumber Daya Alam Dan Lingkungan', 'Jurnal ini menguraikan berbagai jenis sumber daya alam, termasuk sumber daya perpetu, terbarukan, tidak terbarukan, dan potensi. Selain itu, jurnal ini juga menyoroti peran sumber daya manusia dalam pengelolaan SDA serta pentingnya konservasi untuk menjaga kelestarian lingkungan. UNNES berkomitmen untuk menerapkan prinsip-prinsip konservasi dalam berbagai kegiatan akademik dan sosial.', 'DISPERKIMTA.JPG', 'Jurnal', 'https://unnes.ac.id/konservasi/id/pilar-sumber-daya-alam-dan-lingkungan', 'Membahas pengelolaan bijaksana terhadap berbagai jenis sumber daya alam untuk mencapai pembangunan berkelanjutan. Jurnal ini menekankan peran sumber daya manusia dalam konservasi dan kegiatan UNNES, seperti penghijauan dan pengembangan produk ramah lingkungan. Selain itu, pendekatan arsitektur hijau diterapkan untuk meminimalkan dampak negatif terhadap lingkungan, menggarisbawahi pentingnya integrasi pendidikan dan praktik konservasi.', 'UNNES', '25 Menit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `price`, `image`, `description`) VALUES
(2, 'Ekonomi Sumber Daya Alam dan Lingkungan', 'Wahyunindyawati & Dyanasari', 20.00, 'buku1.jpg', 'Buku ini membahas hubungan antara aktivitas ekonomi dengan sumber daya alam dan lingkungan, termasuk dampak pencemaran, konservasi, kebijakan lingkungan, dan pembangunan berkelanjutan. Materi disajikan dengan bahasa yang mudah dipahami, cocok untuk mahasiswa dan praktisi.'),
(3, 'Pengantar Ekonomi Lingkungan dan Sumber Daya Alam (SDA): Konsep dan Aplikasi Studi Kasus di Indonesia', 'Albert Hasudungan', 40.00, 'buku2.jpg', 'Buku ini memberikan landasan dasar analisis masalah lingkungan dari perspektif ekonomi, membahas kegagalan pasar, insentif konservasi, valuasi lingkungan, analisis biaya manfaat, dan pembangunan berkelanjutan dengan studi kasus di Indonesia.'),
(4, 'Ekonomi Sumberdaya Alam dan Lingkungan - Suatu Pendekatan Teoritis', 'Suparmoko', 30.00, 'buku3.jpg', 'Buku ini lebih banyak membahas teori ekonomi sumber daya alam dan lingkungan, termasuk konsep konservasi, kelangkaan sumber daya, pengelolaan sumber daya yang dapat diperbaharui dan tidak, serta kebijakan pengelolaan sumber daya alam yang bertanggung jawab.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `checkout_presets`
--

CREATE TABLE `checkout_presets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `checkout_presets`
--

INSERT INTO `checkout_presets` (`id`, `user_id`, `full_name`, `email`, `phone`, `address`, `city`, `postal_code`, `payment_method`, `created_at`) VALUES
(3, 38, 'Muhammad Fardan', NULL, '081334097813', 'Jl. Pecantingan, Sekardangan Indah, Sekardangan, Kec. Sidoarjo\r\nPerumahan Alana Regency Cemandi,Tambakcemandi,Sedati', 'Sidoarjo', '61215', NULL, '2025-06-12 11:12:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `donations`
--

INSERT INTO `donations` (`id`, `name`, `email`, `message`, `amount`, `payment_method`, `created_at`, `user_id`) VALUES
(11, 'Panjip', 'panji@gmail.com', 'Kerenn', 5000.00, 'Dana', '2025-05-21 13:22:53', 0),
(12, 'Ren', 'Ren@gmail.com', 'Keren bro', 25000.00, 'Dana', '2025-05-30 23:15:33', 0),
(13, 'Panji', 'Panji@gmail.com', 'Cool', 10000.00, 'Transfer Bank', '2025-06-01 00:52:09', 0),
(14, 'Yono', 'yuno@gmail.com', 'Keep Up', 10000.00, 'GoPay', '2025-06-02 11:01:26', 0),
(15, 'Zexx', 'mafrdhan@gmail.com', '', 5000.00, 'GoPay', '2025-06-03 02:47:01', 0),
(16, 'jaguar', 'jaguar@gmail.com', 'pp', 25000.00, 'GoPay', '2025-06-11 01:48:41', 0),
(17, 'Ren', 'mafrdhan@gmail.com', 'KKL', 25000.00, 'GoPay', '2025-06-11 03:29:40', 0),
(18, 'Panji', 'panji@gmail.com', 'Semangat', 5000.00, 'GoPay', '2025-06-11 03:53:10', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `user_email`, `full_name`, `phone`, `address`, `city`, `postal_code`, `payment_method`, `total_price`, `order_date`) VALUES
(30, 38, NULL, 'Muhammad Fardan', '081334097813', 'Jl. Pecantingan, Sekardangan Indah, Sekardangan, Kec. SidoarjoPerumahan Alana Regency Cemandi,Tambakcemandi,Sedati', 'Sidoarjo', '61215', 3, 20.00, '2025-06-12 18:12:28'),
(31, 38, NULL, 'Muhammad Fardan', '081334097813', 'Jl. Pecantingan, Sekardangan Indah, Sekardangan, Kec. SidoarjoPerumahan Alana Regency Cemandi,Tambakcemandi,Sedati', 'Sidoarjo', '61215', 1, 70.00, '2025-06-12 19:08:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `book_id`, `quantity`, `price`) VALUES
(36, 30, 2, 1, 20.00),
(37, 31, 3, 1, 40.00),
(38, 31, 4, 1, 30.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `method_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `method_name`) VALUES
(3, 'COD'),
(2, 'E-Wallet'),
(1, 'Transfer Bank');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan_web`
--

CREATE TABLE `ulasan_web` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `komentar` text NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ulasan_web`
--

INSERT INTO `ulasan_web` (`id`, `nama`, `komentar`, `rating`, `user_id`, `email`) VALUES
(15, 'grok', 'halo', 1, NULL, 'Ren@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`) VALUES
(37, 'Panji', 'Panji@gmail.com', '123', 'user'),
(38, 'Ren', 'Ren@gmail.com', '9007', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `checkout_presets`
--
ALTER TABLE `checkout_presets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_method` (`payment_method`);

--
-- Indeks untuk tabel `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_payment_method` (`payment_method`),
  ADD KEY `fk_orders_user` (`user_id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order` (`order_id`),
  ADD KEY `fk_book` (`book_id`);

--
-- Indeks untuk tabel `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `method_name` (`method_name`);

--
-- Indeks untuk tabel `ulasan_web`
--
ALTER TABLE `ulasan_web`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `checkout_presets`
--
ALTER TABLE `checkout_presets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ulasan_web`
--
ALTER TABLE `ulasan_web`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `checkout_presets`
--
ALTER TABLE `checkout_presets`
  ADD CONSTRAINT `checkout_presets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `checkout_presets_ibfk_2` FOREIGN KEY (`payment_method`) REFERENCES `payment_methods` (`id`);

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_payment_method` FOREIGN KEY (`payment_method`) REFERENCES `payment_methods` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
