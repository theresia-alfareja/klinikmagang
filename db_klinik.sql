-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2021 at 05:34 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `id_dokter` varchar(255) NOT NULL,
  `nama_dokter` varchar(30) NOT NULL,
  `id_poli` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `agama` enum('Islam','Kristen','Katolik','Budha','Hindu','Konghucu') NOT NULL,
  `nomor_telepon_dokter` varchar(13) NOT NULL,
  `tgl_lahir_dokter` varchar(30) NOT NULL,
  `usia` int(10) NOT NULL,
  `alamat_dokter` text NOT NULL,
  `jadwal_praktek` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_dokter`
--

INSERT INTO `tb_dokter` (`id_dokter`, `nama_dokter`, `id_poli`, `jenis_kelamin`, `agama`, `nomor_telepon_dokter`, `tgl_lahir_dokter`, `usia`, `alamat_dokter`, `jadwal_praktek`) VALUES
('DR01', 'Faiq', 'PK03', 'Pria', 'Islam', '0852352353', '1998-10-14', 32, 'Gang Duren Sawit', 'Senin - Kamis'),
('DR02', 'Veronika', 'PK01', 'Wanita', 'Kristen', '093274374842', '1995-09-27', 29, 'Gang Pisangan Batu', 'Sabtu - Minggu <br>\r\n10.00 - 13.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_layanan`
--

CREATE TABLE `tb_layanan` (
  `id_layanan` varchar(255) NOT NULL,
  `id_pasien` varchar(255) NOT NULL,
  `id_poli` varchar(255) NOT NULL,
  `keluhan` text NOT NULL,
  `diagnosa` varchar(50) NOT NULL,
  `perawatan` text NOT NULL,
  `id_tindakan` varchar(255) NOT NULL,
  `id_obat` text NOT NULL,
  `pembayaran` enum('Umum','BPJS') NOT NULL,
  `tgl_berobat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_layanan`
--

INSERT INTO `tb_layanan` (`id_layanan`, `id_pasien`, `id_poli`, `keluhan`, `diagnosa`, `perawatan`, `id_tindakan`, `id_obat`, `pembayaran`, `tgl_berobat`) VALUES
('RM001', 'PSN002', 'PK01', 'kkk', 'll', 'lkj', 'ACT02', 'OBT001', 'Umum', '2021-08-06 15:33:14'),
('RM001', 'PSN002', 'PK01', 'kkk', 'll', 'lkj', 'ACT02', 'OBT001', 'Umum', '2021-08-06 15:33:21'),
('RM001', 'PSN002', 'PK01', 'kkk', 'll', 'lkj', 'ACT02', 'OBT001', 'Umum', '2021-08-06 15:33:23'),
('RM001', 'PSN002', 'PK01', 'kkk', 'll', 'lkj', 'ACT02', 'OBT001', 'Umum', '2021-08-06 15:33:26');

-- --------------------------------------------------------

--
-- Table structure for table `tb_level_user`
--

CREATE TABLE `tb_level_user` (
  `id_level_user` int(10) NOT NULL,
  `level_user` varchar(20) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_level_user`
--

INSERT INTO `tb_level_user` (`id_level_user`, `level_user`, `keterangan`) VALUES
(1, 'Admin utama', 'Memiliki hak akses ke seluruh menu <br>\r\nDapat memanipulasi data-data klinik seperti : menambah, edit dan menghapus.'),
(2, 'Operator', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_merk_obat`
--

CREATE TABLE `tb_merk_obat` (
  `id_merk_obat` varchar(255) NOT NULL,
  `nama_merk` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_merk_obat`
--

INSERT INTO `tb_merk_obat` (`id_merk_obat`, `nama_merk`) VALUES
('M01', 'Curcuma'),
('M02', 'Sanbe'),
('M03', 'Suspensi'),
('M04', 'Generik'),
('M05', 'Meiji');

-- --------------------------------------------------------

--
-- Table structure for table `tb_obat`
--

CREATE TABLE `tb_obat` (
  `id_obat` varchar(255) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `id_merk_obat` varchar(100) NOT NULL,
  `satuan_obat` enum('Tablet','Kapsul','Sirup') NOT NULL,
  `stok` int(50) NOT NULL,
  `harga_beli` int(100) NOT NULL,
  `harga_jual` int(100) NOT NULL,
  `manfaat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_obat`
--

INSERT INTO `tb_obat` (`id_obat`, `nama_obat`, `id_merk_obat`, `satuan_obat`, `stok`, `harga_beli`, `harga_jual`, `manfaat`) VALUES
('OBT001', 'Sucralfat Dispepsia', 'M03', 'Sirup', 20, 85000, 90000, 'Ampuh dalam meredakan asam lambung yang berlebih'),
('OBT002', 'Ranitidine', 'M02', 'Tablet', 30, 10000, 12500, 'Meredakan mual dan pusing'),
('OBT003', 'Propelix', 'M02', 'Tablet', 300, 10000, 10000, 'Meningkatkan kekebalan tubuh');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `id_pasien` varchar(255) NOT NULL,
  `nama_pasien` varchar(30) NOT NULL,
  `tgl_lahir_pasien` varchar(30) NOT NULL,
  `usia` int(10) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `pekerjaan` varchar(30) NOT NULL,
  `pembayaran` varchar(20) NOT NULL,
  `nomor_handphone` varchar(13) NOT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `tgl_daftar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pasien`
--

INSERT INTO `tb_pasien` (`id_pasien`, `nama_pasien`, `tgl_lahir_pasien`, `usia`, `jenis_kelamin`, `pekerjaan`, `pembayaran`, `nomor_handphone`, `no_ktp`, `tgl_daftar`) VALUES
('PSN001', 'Bellinda Simatupang', '1978-07-10', 45, 'Wanita', 'Ibu Rumah Tangga', 'BPJS', '085475285232', '938572937583920', '2021-08-02 12:26:00'),
('PSN002', 'Gen', '2013-09-23', 14, 'Pria', 'Siswa SMP', 'Umum', '084756475623', '849227495794758', '2021-08-02 12:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `tb_poliklinik`
--

CREATE TABLE `tb_poliklinik` (
  `id_poli` varchar(255) NOT NULL,
  `nama_poli` varchar(30) NOT NULL,
  `nama_ruang` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_poliklinik`
--

INSERT INTO `tb_poliklinik` (`id_poli`, `nama_poli`, `nama_ruang`) VALUES
('PK01', 'Poli Anak', 'Ruang Dahlia 04'),
('PK02', 'Poli  Jantung', 'Ruang Mawar'),
('PK03', 'Poli Gigi', 'Ruang Mawar 01'),
('PK04', 'Poli Penyakit Dalam', 'Ruang Melati');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tindakan`
--

CREATE TABLE `tb_tindakan` (
  `id_tindakan` varchar(255) NOT NULL,
  `nama_tindakan` varchar(50) NOT NULL,
  `harga_tindakan` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_tindakan`
--

INSERT INTO `tb_tindakan` (`id_tindakan`, `nama_tindakan`, `harga_tindakan`) VALUES
('ACT01', 'Endoskopi', 165000),
('ACT02', 'Cek Kolesterol', 60000),
('ACT03', 'Cek Rontgen', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `nama_lengkap_user` varchar(30) NOT NULL,
  `level_user` enum('Admin Utama','Operator','Kasir','Apoteker') NOT NULL,
  `alamat_user` text NOT NULL,
  `nomor_telepon_user` varchar(13) NOT NULL,
  `password` varchar(30) NOT NULL,
  `tgl_daftar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `nama_lengkap_user`, `level_user`, `alamat_user`, `nomor_telepon_user`, `password`, `tgl_daftar`) VALUES
(2, 'alfa11', 'Theresia Avila', 'Admin Utama', 'Heaven', '0896521348', 'tesa', '2021-08-06 02:27:23'),
(3, 'Sas123', 'Gabriel', 'Operator', 'JLN.Monas, Jakarta Pusat', '0808080880808', 'gabriel', '2021-08-05 12:13:39'),
(4, 'Candy8', 'Gulali Galileo', 'Apoteker', 'Wonderland', '0897483393', 'candy', '2021-08-06 03:40:19'),
(5, 'klinik', 'Klinik Bekasi', 'Admin Utama', 'Wisma Asri', '09989283', 'klinik', '2021-08-06 03:42:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `tb_level_user`
--
ALTER TABLE `tb_level_user`
  ADD PRIMARY KEY (`id_level_user`);

--
-- Indexes for table `tb_merk_obat`
--
ALTER TABLE `tb_merk_obat`
  ADD PRIMARY KEY (`id_merk_obat`);

--
-- Indexes for table `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`id_obat`),
  ADD KEY `id_merk_obat` (`id_merk_obat`);

--
-- Indexes for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `tb_poliklinik`
--
ALTER TABLE `tb_poliklinik`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indexes for table `tb_tindakan`
--
ALTER TABLE `tb_tindakan`
  ADD PRIMARY KEY (`id_tindakan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_level_user`
--
ALTER TABLE `tb_level_user`
  MODIFY `id_level_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
