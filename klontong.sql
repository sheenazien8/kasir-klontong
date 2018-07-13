-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 23 Jun 2018 pada 19.49
-- Versi server: 5.7.22-0ubuntu0.16.04.1
-- Versi PHP: 7.1.16-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `point-of-sale`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL,
  `kode_barang` varchar(5) NOT NULL,
  `barang_nama` varchar(100) NOT NULL,
  `barang_stok` int(11) NOT NULL,
  `barang_modal` double NOT NULL,
  `barang_laba` double NOT NULL,
  `barang_tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`barang_id`, `kode_barang`, `barang_nama`, `barang_stok`, `barang_modal`, `barang_laba`, `barang_tanggal`) VALUES
(1, 'BR145', 'Choko Choki', 99, 800, 200, '2018-06-21'),
(2, 'BR166', 'Torabika Mocca', 30, 2400, 100, '2018-06-21'),
(3, 'BR189', 'Mi Cepek', 45, 1800, 200, '2018-06-21'),
(4, 'BR208', 'Sarimi Merah', 68, 2200, 200, '2018-06-21'),
(5, 'BR212', 'Chocolatos', 50, 900, 100, '2018-06-21'),
(6, 'BR249', 'Kecap', 29, 2900, 100, '2018-06-21'),
(7, 'BR292', 'Sedap Rebus', 50, 1800, 200, '2018-06-21'),
(8, 'BR335', 'Sosis Kimbo', 50, 900, 200, '2018-06-21'),
(9, 'BR346', 'Kecap Bangau', 40, 900, 100, '2018-06-21'),
(10, 'BR431', 'Pop Mie', 20, 7200, 300, '2018-06-21'),
(11, 'BR443', 'Slai Olai', 49, 1700, 300, '2018-06-21'),
(12, 'BR444', 'Roma Kelapa', 30, 7200, 300, '2018-06-21'),
(13, 'BR473', 'Sedap Goreng', 48, 2300, 200, '2018-06-21'),
(14, 'BR483', 'Kinder Joy', 20, 9800, 200, '2018-06-21'),
(15, 'BR505', 'Pop Ice', 90, 2300, 200, '2018-06-21'),
(16, 'BR525', 'Whitecofee', 17, 2300, 200, '2018-06-21'),
(17, 'BR611', 'Sirup ABC Jeruk', 28, 2400, 300, '2018-06-21'),
(18, 'BR688', 'Sirup ABC', 20, 7200, 300, '2018-06-21'),
(19, 'BR787', 'Indomie Goreng Duo', 50, 2300, 300, '2018-06-21'),
(21, 'BR932', 'Mi Fajar', 50, 800, 200, '2018-06-21'),
(22, 'BR956', 'Tora Cafe', 30, 2200, 200, '2018-06-21'),
(23, 'BR978', 'Cofeemix', 18, 2200, 300, '2018-06-21'),
(24, 'BR133', 'Kukubima', 90, 2300, 200, '2018-06-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `kode_barang` varchar(5) NOT NULL,
  `masuk_jumlah` int(11) NOT NULL,
  `masuk_tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`kode_barang`, `masuk_jumlah`, `masuk_tanggal`) VALUES
('BR444', 20, '2018-06-21'),
('BR505', 50, '2018-06-21'),
('BR208', 20, '2018-06-21');

--
-- Trigger `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `stok_masuk` AFTER INSERT ON `barang_masuk` FOR EACH ROW BEGIN
UPDATE barang SET barang_stok = barang_stok + NEW.masuk_jumlah WHERE kode_barang = NEW.kode_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_terjual`
--

CREATE TABLE `barang_terjual` (
  `kode_barang` varchar(5) NOT NULL,
  `terjual_jumlah` int(11) NOT NULL,
  `terjual_tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_terjual`
--

INSERT INTO `barang_terjual` (`kode_barang`, `terjual_jumlah`, `terjual_tanggal`) VALUES
('BR145', 1, '2018-06-21'),
('BR978', 2, '2018-06-21'),
('BR346', 4, '2018-06-21'),
('BR346', 4, '2018-06-21'),
('BR189', 5, '2018-06-21'),
('BR208', 2, '2018-06-21'),
('BR473', 1, '2018-06-21'),
('BR473', 1, '2018-06-21'),
('BR346', 1, '2018-06-23'),
('BR525', 1, '2018-06-23'),
('BR346', 1, '2018-06-23'),
('BR444', 20, '2018-06-23'),
('BR611', 5, '2018-06-23'),
('BR611', 5, '2018-06-23'),
('BR611', 5, '2018-06-23'),
('BR611', 5, '2018-06-23'),
('BR525', 11, '2018-06-23'),
('BR444', 19, '2018-06-23'),
('BR443', 1, '2018-06-23'),
('BR611', 1, '2018-06-23'),
('BR611', 1, '2018-06-23'),
('BR444', 1, '2018-06-23');

--
-- Trigger `barang_terjual`
--
DELIMITER $$
CREATE TRIGGER `barang_terjual` AFTER INSERT ON `barang_terjual` FOR EACH ROW BEGIN
UPDATE barang SET barang_stok = barang_stok - NEW.terjual_jumlah WHERE kode_barang = NEW.kode_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_pesanan` varchar(10) NOT NULL,
  `waktu_pesanan` time NOT NULL,
  `uang_masuk` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `tanggal`, `kode_pesanan`, `waktu_pesanan`, `uang_masuk`) VALUES
(1, '2018-06-23', 'KDP3763432', '08:28:31', 27500),
(2, '2018-06-23', 'KDP3819899', '08:28:42', 142500),
(3, '2018-06-23', 'KDP5065716', '09:13:28', 4700),
(4, '2018-06-23', 'KDP7959367', '09:14:39', 2700),
(5, '2018-06-23', 'KDP8035388', '09:15:41', 125000),
(6, '2018-06-23', 'KDP8237566', '12:05:40', 7500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `uang_keluar`
--

CREATE TABLE `uang_keluar` (
  `uang_keluar_id` int(11) NOT NULL,
  `kode_barang` varchar(5) NOT NULL,
  `barang_modal` double NOT NULL,
  `stok` int(11) NOT NULL,
  `uang_tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `uang_keluar`
--

INSERT INTO `uang_keluar` (`uang_keluar_id`, `kode_barang`, `barang_modal`, `stok`, `uang_tanggal_keluar`) VALUES
(1, 'BR145', 80000, 100, '2018-06-21'),
(2, 'BR444', 360000, 50, '2018-06-21'),
(3, 'BR443', 85000, 50, '2018-06-21'),
(4, 'BR688', 144000, 20, '2018-06-21'),
(6, 'BR787', 115000, 50, '2018-06-21'),
(7, 'BR473', 115000, 50, '2018-06-21'),
(8, 'BR208', 110000, 50, '2018-06-21'),
(9, 'BR611', 120000, 50, '2018-06-21'),
(10, 'BR346', 45000, 50, '2018-06-21'),
(12, 'BR292', 90000, 50, '2018-06-21'),
(13, 'BR189', 90000, 50, '2018-06-21'),
(14, 'BR932', 40000, 50, '2018-06-21'),
(15, 'BR611', 40000, 50, '2018-06-21'),
(16, 'BR208', 44000, 20, '2018-06-21'),
(17, 'BR956', 66000, 30, '2018-06-21'),
(18, 'BR335', 45000, 50, '2018-06-21'),
(19, 'BR431', 144000, 20, '2018-06-21'),
(20, 'BR483', 196000, 20, '2018-06-21'),
(21, 'BR212', 45000, 50, '2018-06-21'),
(22, 'BR978', 44000, 20, '2018-06-21'),
(23, 'BR166', 72000, 30, '2018-06-21'),
(24, 'BR249', 84100, 29, '2018-06-21'),
(26, 'BR505', 92000, 40, '2018-06-21'),
(27, 'BR525', 66700, 29, '2018-06-21'),
(28, 'BR133', 207000, 90, '2018-06-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `uang_masuk`
--

CREATE TABLE `uang_masuk` (
  `uang_masuk_id` int(11) NOT NULL,
  `kode_barang` varchar(5) NOT NULL,
  `barang_modal` double NOT NULL,
  `barang_laba` double NOT NULL,
  `stok` int(11) NOT NULL,
  `uang_tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `uang_masuk`
--

INSERT INTO `uang_masuk` (`uang_masuk_id`, `kode_barang`, `barang_modal`, `barang_laba`, `stok`, `uang_tanggal_masuk`) VALUES
(1, 'BR525', 25300, 2200, 11, '2018-06-23'),
(2, 'BR444', 136800, 5700, 19, '2018-06-23'),
(3, 'BR443', 1700, 300, 1, '2018-06-23'),
(4, 'BR611', 2400, 300, 1, '2018-06-23'),
(5, 'BR611', 2400, 300, 1, '2018-06-23'),
(7, 'BR444', 7200, 300, 1, '2018-06-23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD UNIQUE KEY `barang_id` (`kode_barang`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `barang_terjual`
--
ALTER TABLE `barang_terjual`
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD UNIQUE KEY `kode_pesanan` (`kode_pesanan`);

--
-- Indeks untuk tabel `uang_keluar`
--
ALTER TABLE `uang_keluar`
  ADD PRIMARY KEY (`uang_keluar_id`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `uang_masuk`
--
ALTER TABLE `uang_masuk`
  ADD PRIMARY KEY (`uang_masuk_id`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `uang_keluar`
--
ALTER TABLE `uang_keluar`
  MODIFY `uang_keluar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `uang_masuk`
--
ALTER TABLE `uang_masuk`
  MODIFY `uang_masuk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_terjual`
--
ALTER TABLE `barang_terjual`
  ADD CONSTRAINT `barang_terjual_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `uang_keluar`
--
ALTER TABLE `uang_keluar`
  ADD CONSTRAINT `uang_keluar_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `uang_masuk`
--
ALTER TABLE `uang_masuk`
  ADD CONSTRAINT `uang_masuk_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
