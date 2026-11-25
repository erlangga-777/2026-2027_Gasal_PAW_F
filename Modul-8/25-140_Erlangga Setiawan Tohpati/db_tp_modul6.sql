-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Nov 2026 pada 23.28
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
-- Database: `db_tp_modul6`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_barang`
--

CREATE TABLE `penjualan_barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan_barang`
--

INSERT INTO `penjualan_barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'B001', 'Buku', 5000, 100, 1),
(2, 'P001', 'Penggaris', 3000, 100, 2),
(3, 'BG01', 'Buku Gambar', 6000, 100, 3),
(4, 'PN01', 'Pensil', 2000, 100, 4),
(5, 'PH01', 'Penghapus', 1500, 100, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_pelanggan`
--

CREATE TABLE `penjualan_pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan_pelanggan`
--

INSERT INTO `penjualan_pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('PLG001', 'Andi', 'L', '081211112222', 'Surabaya'),
('PLG002', 'Budi', 'L', '081333334444', 'Surabaya'),
('PLG003', 'Suci', 'P', '085755556666', 'Gresik'),
('PLG004', 'Dewi', 'P', '087877778888', 'Sidoarjo'),
('PLG005', 'Eko', 'L', '081999990000', 'Malang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_pembayaran`
--

CREATE TABLE `penjualan_pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') NOT NULL,
  `transaksi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan_pembayaran`
--

INSERT INTO `penjualan_pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2026-11-01 08:30:00', 8000, 'TUNAI', 1),
(2, '2026-11-01 10:15:00', 5000, 'TRANSFER', 2),
(3, '2026-11-02 11:00:00', 11000, 'TUNAI', 3),
(4, '2026-11-03 13:20:00', 4000, 'TUNAI', 4),
(5, '2026-11-04 15:45:00', 1500, 'TRANSFER', 5),
(6, '2026-11-05 09:10:00', 10000, 'TUNAI', 6),
(7, '2026-11-06 14:00:00', 6000, 'TUNAI', 7),
(8, '2026-11-07 16:30:00', 3500, 'TUNAI', 8),
(9, '2026-11-08 10:05:00', 5000, 'TRANSFER', 9),
(10, '2026-11-09 11:25:00', 7500, 'TUNAI', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_supplier`
--

CREATE TABLE `penjualan_supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan_supplier`
--

INSERT INTO `penjualan_supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'Distributor1', '081234567890', 'Surabaya'),
(2, 'Distributor2', '082198765432', 'Gresik'),
(3, 'Distributor3', '085611223344', 'Lamongan'),
(4, 'Distributor4', '087855443322', 'Sidoarjo'),
(5, 'Distributor5', '081399887766', 'Malang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_transaksi`
--

CREATE TABLE `penjualan_transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) NOT NULL,
  `pelanggan_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan_transaksi`
--

INSERT INTO `penjualan_transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-11-01', 'Lunas', 8000, 'PLG001'),
(2, '2026-11-01', 'Lunas', 5000, 'PLG002'),
(3, '2026-11-02', 'Lunas', 11000, 'PLG003'),
(4, '2026-11-03', 'Lunas', 4000, 'PLG004'),
(5, '2026-11-04', 'Lunas', 1500, 'PLG005'),
(6, '2026-11-05', 'Lunas', 10000, 'PLG001'),
(7, '2026-11-06', 'Lunas', 6000, 'PLG002'),
(8, '2026-11-07', 'Lunas', 3500, 'PLG003'),
(9, '2026-11-08', 'Lunas', 5000, 'PLG004'),
(10, '2026-11-09', 'Lunas', 7500, 'PLG005');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_transaksi_detail`
--

CREATE TABLE `penjualan_transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan_transaksi_detail`
--

INSERT INTO `penjualan_transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 5000, 1),
(1, 2, 3000, 1),
(2, 1, 5000, 1),
(3, 1, 5000, 1),
(3, 3, 6000, 1),
(4, 4, 2000, 2),
(5, 5, 1500, 1),
(6, 1, 5000, 2),
(7, 3, 6000, 1),
(8, 4, 2000, 1),
(8, 5, 1500, 1),
(9, 1, 5000, 1),
(10, 2, 3000, 1),
(10, 3, 6000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_user`
--

CREATE TABLE `penjualan_user` (
  `id_user` tinyint(4) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan_user`
--

INSERT INTO `penjualan_user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Admin', 'Bangkalan', '081122334455', 1),
(2, 'kasir1', '5f4dcc3b5aa765d61d8327deb882cf99', 'Kasir1', 'Bangkalan', '082233445566', 2),
(3, 'kasir2', '5f4dcc3b5aa765d61d8327deb882cf99', 'Kasir2', 'Surabaya', '083344556677', 2),
(4, 'gudang', '5f4dcc3b5aa765d61d8327deb882cf99', 'Gudang', 'Sidoarjo', '084455667788', 2),
(5, 'owner', '5f4dcc3b5aa765d61d8327deb882cf99', 'Pemilik', 'Malang', '085566778899', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `penjualan_barang`
--
ALTER TABLE `penjualan_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indeks untuk tabel `penjualan_pelanggan`
--
ALTER TABLE `penjualan_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan_pembayaran`
--
ALTER TABLE `penjualan_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indeks untuk tabel `penjualan_supplier`
--
ALTER TABLE `penjualan_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan_transaksi`
--
ALTER TABLE `penjualan_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indeks untuk tabel `penjualan_transaksi_detail`
--
ALTER TABLE `penjualan_transaksi_detail`
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `penjualan_user`
--
ALTER TABLE `penjualan_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `penjualan_barang`
--
ALTER TABLE `penjualan_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `penjualan_pembayaran`
--
ALTER TABLE `penjualan_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `penjualan_supplier`
--
ALTER TABLE `penjualan_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `penjualan_transaksi`
--
ALTER TABLE `penjualan_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `penjualan_user`
--
ALTER TABLE `penjualan_user`
  MODIFY `id_user` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `penjualan_barang`
--
ALTER TABLE `penjualan_barang`
  ADD CONSTRAINT `penjualan_barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `penjualan_supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penjualan_pembayaran`
--
ALTER TABLE `penjualan_pembayaran`
  ADD CONSTRAINT `penjualan_pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `penjualan_transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penjualan_transaksi`
--
ALTER TABLE `penjualan_transaksi`
  ADD CONSTRAINT `penjualan_transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `penjualan_pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penjualan_transaksi_detail`
--
ALTER TABLE `penjualan_transaksi_detail`
  ADD CONSTRAINT `penjualan_transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `penjualan_transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `penjualan_barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
