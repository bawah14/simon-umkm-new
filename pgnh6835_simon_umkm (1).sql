-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 05, 2021 at 08:39 AM
-- Server version: 10.2.37-MariaDB-cll-lve
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pgnh6835_simon_umkm`
--

-- --------------------------------------------------------

--
-- Table structure for table `binaan`
--

CREATE TABLE `binaan` (
  `id_binaan` int(11) NOT NULL,
  `nama_binaan` varchar(32) NOT NULL,
  `lokasi_binaan` text NOT NULL,
  `keterangan_binaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE `diskon` (
  `id_diskon` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_diskon` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(32) NOT NULL,
  `keterangan_kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `keterangan_kategori`) VALUES
(1, 'Makanan', ''),
(2, 'Minuman', ''),
(3, 'Acc dan Kerajinan', ''),
(4, 'Pakaian', ''),
(5, 'Batik', ''),
(6, 'Sepatu', ''),
(7, 'Olahan Ikan ', '');

-- --------------------------------------------------------

--
-- Table structure for table `perizinan`
--

CREATE TABLE `perizinan` (
  `id_perizinan` int(11) NOT NULL,
  `id_umkm` int(11) NOT NULL,
  `unit_pengolahan_perizinan` int(2) NOT NULL,
  `halal_perizinan` int(2) NOT NULL,
  `skp_perizinan` int(2) NOT NULL,
  `nib_perizinan` int(2) NOT NULL,
  `pirt_perizinan` int(2) NOT NULL,
  `iumk_perizinan` int(2) NOT NULL,
  `tduphp_perizinan` int(2) NOT NULL,
  `upload_halal_perizinan` text DEFAULT NULL,
  `upload_skp_perizinan` text DEFAULT NULL,
  `upload_nib_perizinan` text DEFAULT NULL,
  `upload_pirt_perizinan` text DEFAULT NULL,
  `upload_iumk_perizinan` text DEFAULT NULL,
  `upload_tduphp_perizinan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(45) DEFAULT NULL,
  `foto_produk` varchar(255) DEFAULT NULL,
  `harga_produk` int(11) DEFAULT NULL,
  `produksi_produk` int(11) DEFAULT NULL,
  `satuan_produk` varchar(45) DEFAULT NULL,
  `kategori_produk` int(11) NOT NULL,
  `id_umkm` int(11) NOT NULL,
  `status_produk` int(11) NOT NULL DEFAULT 0,
  `stok_produk` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id_purchase` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_barang_purchase` int(11) NOT NULL,
  `harga_satuan_barang_purchase` int(11) NOT NULL,
  `harga_total_purchase` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL DEFAULT 0,
  `jenis_purchase` varchar(2) NOT NULL,
  `tanggal_purchase` datetime NOT NULL DEFAULT current_timestamp(),
  `keterangan_purchase` text DEFAULT NULL,
  `diskon_purchase` int(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_stok` int(11) NOT NULL DEFAULT 0,
  `jumlah_stok_awal` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal_transaksi` datetime DEFAULT current_timestamp(),
  `jenis_transaksi` varchar(8) DEFAULT NULL,
  `harga_total_transaksi` int(11) DEFAULT NULL,
  `keterangan_transaksi` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `pembayaran_transaksi` int(16) NOT NULL DEFAULT 0,
  `diskon_transaksi` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `umkm`
--

CREATE TABLE `umkm` (
  `id_umkm` int(11) NOT NULL,
  `nama_umkm` varchar(45) DEFAULT NULL,
  `nama_pemilik_umkm` varchar(45) DEFAULT NULL,
  `nik_umkm` varchar(45) DEFAULT NULL,
  `umur_umkm` int(4) NOT NULL,
  `jenis_kelamin_umkm` varchar(16) NOT NULL,
  `no_hp_umkm` varchar(16) DEFAULT NULL,
  `kategori_umkm` varchar(32) DEFAULT NULL,
  `sub_kategori_umkm` int(11) NOT NULL,
  `alamat_ktp_umkm` text DEFAULT NULL,
  `gang_blok_umkm` varchar(32) NOT NULL,
  `rt_umkm` int(11) NOT NULL,
  `rw_umkm` int(11) NOT NULL,
  `kelurahan_umkm` varchar(32) NOT NULL,
  `kecamatan_umkm` varchar(32) NOT NULL,
  `no_rumah_umkm` varchar(8) NOT NULL,
  `jenis_izin_usaha_umkm` varchar(16) DEFAULT NULL,
  `omset_perbulan_umkm` int(11) DEFAULT NULL,
  `tahun_berdiri_umkm` int(11) DEFAULT NULL,
  `binaan_umkm` int(11) NOT NULL,
  `foto_pemilik_umkm` varchar(255) DEFAULT NULL,
  `foto_ktp_pemilik_umkm` varchar(255) DEFAULT NULL,
  `foto_ttd_umkm` text DEFAULT NULL,
  `anggota_umkm` int(11) NOT NULL DEFAULT 0,
  `pemasaran_umkm` varchar(16) NOT NULL,
  `produksi_umkm` text NOT NULL,
  `pelatihan_umkm` text NOT NULL,
  `seminar_umkm` text NOT NULL,
  `foto_produk_umkm` text NOT NULL,
  `produk_unggulan_umkm` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(64) NOT NULL,
  `password_user` text NOT NULL,
  `role_user` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `password_user`, `role_user`) VALUES
(1, 'test', '333c94c626650d7d15db8c5a1ec1c6fa', 'petugas'),
(2, 'sholichin', '01cfcd4f6b8770febfb40cb906715822', 'pendataan'),
(3, 'kasir', '333c94c626650d7d15db8c5a1ec1c6fa', 'kasir');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id_voucher` int(11) NOT NULL,
  `kode_voucher` text NOT NULL,
  `tanggal_voucher` date NOT NULL,
  `potongan_voucher` int(11) NOT NULL,
  `status_voucher` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `binaan`
--
ALTER TABLE `binaan`
  ADD PRIMARY KEY (`id_binaan`);

--
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`id_diskon`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `perizinan`
--
ALTER TABLE `perizinan`
  ADD PRIMARY KEY (`id_perizinan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id_purchase`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `umkm`
--
ALTER TABLE `umkm`
  ADD PRIMARY KEY (`id_umkm`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id_voucher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `binaan`
--
ALTER TABLE `binaan`
  MODIFY `id_binaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diskon`
--
ALTER TABLE `diskon`
  MODIFY `id_diskon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `perizinan`
--
ALTER TABLE `perizinan`
  MODIFY `id_perizinan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id_purchase` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `umkm`
--
ALTER TABLE `umkm`
  MODIFY `id_umkm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id_voucher` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
