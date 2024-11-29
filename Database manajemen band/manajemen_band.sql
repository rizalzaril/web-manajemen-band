-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Nov 2024 pada 10.03
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manajemen_band`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `band`
--

CREATE TABLE `band` (
  `id_band` int(11) NOT NULL,
  `nama_band` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `contact_band` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `band`
--

INSERT INTO `band` (`id_band`, `nama_band`, `genre`, `contact_band`) VALUES
(21, 'Tony q', 'reggae', '085123123123'),
(22, 'Fourtwenty', 'indie', '1231231'),
(23, 'J-rock', 'rock', '34234234234'),
(24, 'Bernadya', 'pop', '085623526322'),
(25, 'The paps', 'reggae', '0876123123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_manggung`
--

CREATE TABLE `jadwal_manggung` (
  `id_jadwal` int(11) NOT NULL,
  `id_user_admin` int(11) NOT NULL,
  `id_tempat_manggung` int(11) NOT NULL,
  `id_band` int(11) NOT NULL,
  `id_jenis_konser` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` enum('Pending','Terkonfirmasi','Batal hadir','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_manggung`
--

INSERT INTO `jadwal_manggung` (`id_jadwal`, `id_user_admin`, `id_tempat_manggung`, `id_band`, `id_jenis_konser`, `date`, `time`, `status`) VALUES
(18, 4, 21, 25, 5, '2024-11-29', '11:00:00', 'Selesai'),
(19, 4, 21, 23, 6, '2024-11-29', '14:00:00', 'Pending'),
(20, 4, 22, 24, 1, '2024-11-29', '15:36:00', 'Pending'),
(21, 4, 13, 22, 6, '2024-11-29', '15:36:00', 'Batal hadir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_konser`
--

CREATE TABLE `jenis_konser` (
  `id_jenis_konser` int(11) NOT NULL,
  `nama_konser` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_konser`
--

INSERT INTO `jenis_konser` (`id_jenis_konser`, `nama_konser`) VALUES
(1, 'Konser musik live'),
(2, 'Event komunitas'),
(3, 'Festival musik'),
(4, 'Private party'),
(5, 'Konser tour'),
(6, 'Konser amal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempat_manggung`
--

CREATE TABLE `tempat_manggung` (
  `id_tempat_manggung` int(11) NOT NULL,
  `nama_tempat_manggung` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `contact` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tempat_manggung`
--

INSERT INTO `tempat_manggung` (`id_tempat_manggung`, `nama_tempat_manggung`, `provinsi`, `kota`, `alamat`, `contact`) VALUES
(12, 'cafe clay', '6', '152', 'Jl. Kampung Kepu GG.V no.249', '0895615113534'),
(13, 'Kaizen Cafe', '6', '152', 'Jl. Letjen Suprapto', '1231231'),
(20, 'Pantai Ancol', '6', '155', 'Jl. Pademangan ', '08123123123'),
(21, 'Jiexpo Kemayoran', '6', '155', 'Jl. Pademangan raya', '086234124'),
(22, 'Manji cafe', '6', '152', 'Kemayoran gempol', '123123123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_admin`
--

CREATE TABLE `user_admin` (
  `id_user_admin` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_admin`
--

INSERT INTO `user_admin` (`id_user_admin`, `name`, `username`, `password`, `created_at`) VALUES
(4, 'admin web', 'adminweb2024', '$2y$10$ZqNc.DK0SBQxEVps6X893.4lufIe4q3M79tY0zVg2P/JVMCr59yCa', '2024-11-27 04:52:54');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `band`
--
ALTER TABLE `band`
  ADD PRIMARY KEY (`id_band`);

--
-- Indeks untuk tabel `jadwal_manggung`
--
ALTER TABLE `jadwal_manggung`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_tempat_manggung` (`id_tempat_manggung`),
  ADD KEY `id_band` (`id_band`),
  ADD KEY `id_user_admin` (`id_user_admin`),
  ADD KEY `id_jenis_konser` (`id_jenis_konser`);

--
-- Indeks untuk tabel `jenis_konser`
--
ALTER TABLE `jenis_konser`
  ADD PRIMARY KEY (`id_jenis_konser`);

--
-- Indeks untuk tabel `tempat_manggung`
--
ALTER TABLE `tempat_manggung`
  ADD PRIMARY KEY (`id_tempat_manggung`);

--
-- Indeks untuk tabel `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id_user_admin`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `band`
--
ALTER TABLE `band`
  MODIFY `id_band` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `jadwal_manggung`
--
ALTER TABLE `jadwal_manggung`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `jenis_konser`
--
ALTER TABLE `jenis_konser`
  MODIFY `id_jenis_konser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tempat_manggung`
--
ALTER TABLE `tempat_manggung`
  MODIFY `id_tempat_manggung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id_user_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jadwal_manggung`
--
ALTER TABLE `jadwal_manggung`
  ADD CONSTRAINT `jadwal_manggung_ibfk_1` FOREIGN KEY (`id_tempat_manggung`) REFERENCES `tempat_manggung` (`id_tempat_manggung`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_manggung_ibfk_2` FOREIGN KEY (`id_band`) REFERENCES `band` (`id_band`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_manggung_ibfk_3` FOREIGN KEY (`id_user_admin`) REFERENCES `user_admin` (`id_user_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_manggung_ibfk_4` FOREIGN KEY (`id_jenis_konser`) REFERENCES `jenis_konser` (`id_jenis_konser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
