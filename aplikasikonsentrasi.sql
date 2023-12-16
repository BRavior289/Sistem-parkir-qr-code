-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2023 pada 11.10
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasikonsentrasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_admin`
--

CREATE TABLE `data_admin` (
  `id_admin` int(3) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_admin`
--

INSERT INTO `data_admin` (`id_admin`, `nama`, `email`, `username`, `password`) VALUES
(1, 'nana', 'bravior289@gmail.coma', 'admin', 'admin'),
(3, 'aaa', 'aali@gmail.com', 'a', 'a');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jenis_kendaraan`
--

CREATE TABLE `data_jenis_kendaraan` (
  `id_jenis_kendaraan` int(11) NOT NULL,
  `jenis_kendaraan` varchar(20) NOT NULL,
  `tarif` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_jenis_kendaraan`
--

INSERT INTO `data_jenis_kendaraan` (`id_jenis_kendaraan`, `jenis_kendaraan`, `tarif`) VALUES
(1, 'Motor', 2000),
(2, 'mobil', 5000),
(4, 'Truk', 7000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_parkir_keluar`
--

CREATE TABLE `data_parkir_keluar` (
  `id_karcis` int(7) NOT NULL,
  `no_plat` varchar(8) NOT NULL,
  `tanggal_jam_masuk` datetime NOT NULL,
  `tanggal_jam_keluar` datetime NOT NULL,
  `jenis_kendaraan` varchar(20) NOT NULL,
  `lama_parkir` int(20) NOT NULL,
  `tarif` int(7) NOT NULL,
  `total_bayar` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_parkir_keluar`
--

INSERT INTO `data_parkir_keluar` (`id_karcis`, `no_plat`, `tanggal_jam_masuk`, `tanggal_jam_keluar`, `jenis_kendaraan`, `lama_parkir`, `tarif`, `total_bayar`) VALUES
(2, 'DD7432QA', '2023-11-12 15:55:54', '2023-11-12 15:56:01', 'Motor', 1, 2000, 2000),
(3, 'DD7432QA', '2023-11-12 15:56:10', '2023-11-12 15:56:32', 'Truk', 1, 7000, 7000),
(5, 'DD3234RR', '2023-11-18 14:43:01', '2023-11-18 14:43:40', 'Motor', 1, 2000, 2000),
(7, 'DD7432QQ', '2023-11-18 14:50:25', '2023-11-18 14:50:56', 'Motor', 1, 2000, 2000),
(8, 'DD3234RR', '2023-11-18 15:51:16', '2023-11-19 10:26:51', 'Motor', 19, 2000, 38000),
(9, 'DD7432QQ', '2023-11-18 15:52:21', '2023-11-19 10:36:29', 'Motor', 19, 2000, 38000),
(10, 'DD7432QA', '2023-11-19 10:26:24', '2023-11-22 05:55:03', 'mobil', 68, 5000, 340000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_parkir_masuk`
--

CREATE TABLE `data_parkir_masuk` (
  `id_karcis` int(7) NOT NULL,
  `tanggal_jam_masuk` datetime NOT NULL,
  `jenis_kendaraan` varchar(20) NOT NULL,
  `no_plat` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_parkir_masuk`
--

INSERT INTO `data_parkir_masuk` (`id_karcis`, `tanggal_jam_masuk`, `jenis_kendaraan`, `no_plat`) VALUES
(11, '2023-11-19 13:05:24', 'Motor', 'DD3234RR'),
(12, '2023-11-22 03:47:40', 'Truk', 'DD7432QQ'),
(13, '2023-11-22 05:45:11', 'mobil', 'DD7432QA');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_admin`
--
ALTER TABLE `data_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `data_jenis_kendaraan`
--
ALTER TABLE `data_jenis_kendaraan`
  ADD PRIMARY KEY (`id_jenis_kendaraan`);

--
-- Indeks untuk tabel `data_parkir_keluar`
--
ALTER TABLE `data_parkir_keluar`
  ADD PRIMARY KEY (`id_karcis`);

--
-- Indeks untuk tabel `data_parkir_masuk`
--
ALTER TABLE `data_parkir_masuk`
  ADD PRIMARY KEY (`id_karcis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_admin`
--
ALTER TABLE `data_admin`
  MODIFY `id_admin` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `data_jenis_kendaraan`
--
ALTER TABLE `data_jenis_kendaraan`
  MODIFY `id_jenis_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `data_parkir_masuk`
--
ALTER TABLE `data_parkir_masuk`
  MODIFY `id_karcis` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
