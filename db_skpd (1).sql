-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2025 at 04:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_skpd`
--

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` int(11) NOT NULL,
  `nama_fakultas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`) VALUES
(1, 'FIKSI'),
(2, 'FTI'),
(3, 'FTSP'),
(4, 'FASOS'),
(8, 'FE'),
(9, 'FMIPA');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_kuisioner`
--

CREATE TABLE `hasil_kuisioner` (
  `id` int(100) NOT NULL,
  `kode_subkriteria` varchar(5) NOT NULL,
  `nilai` varchar(10) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `id_semester` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kritik_saran`
--

CREATE TABLE `kritik_saran` (
  `id` int(11) NOT NULL,
  `isi` varchar(1000) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `nim` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kuisioner`
--

CREATE TABLE `kuisioner` (
  `id_kuisioner` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `aktif` enum('Y','N') NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `matkul` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kuisioner`
--

INSERT INTO `kuisioner` (`id_kuisioner`, `id_semester`, `tgl_mulai`, `tgl_selesai`, `aktif`, `nama_dosen`, `matkul`) VALUES
(2, 5, '2025-01-01', '2025-01-31', 'Y', 'Abdul', 'arsitektur sistem informasi'),
(3, 5, '2025-01-01', '2025-01-31', 'Y', 'Abdul', 'arsitektur sistem informasi'),
(4, 5, '2025-01-01', '2025-01-31', 'Y', 'Abdul', 'arsitektur sistem informasi'),
(5, 5, '2025-01-01', '2025-01-31', 'Y', 'Abdul', 'arsitektur sistem informasi'),
(6, 5, '2025-01-01', '2025-01-31', 'Y', 'Abdul', 'arsitektur sistem informasi'),
(7, 3, '2025-02-01', '2025-02-28', 'Y', 'test dosen', 'HRIS'),
(8, 3, '2025-01-19', '2025-01-26', 'Y', 'Abdullah', 'Pemrograman'),
(9, 5, '2025-02-01', '2025-02-28', 'Y', 'dosen pintar', 'Pemrograman');

-- --------------------------------------------------------

--
-- Table structure for table `master_dosen`
--

CREATE TABLE `master_dosen` (
  `nip` varchar(18) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('Pria','Wanita') NOT NULL,
  `alamat` text NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_dosen`
--

INSERT INTO `master_dosen` (`nip`, `nama_depan`, `nama_belakang`, `tgl_lahir`, `jk`, `alamat`, `nohp`, `email`, `id_prodi`, `id_user`) VALUES
('12345678', 'dosen', 'pintar', '0000-00-00', 'Pria', 'jl. lieurrrrr', '082130045786', 'gilang.ramadhan0403@gmail.com', 4, 12345678);

-- --------------------------------------------------------

--
-- Table structure for table `master_kriteria`
--

CREATE TABLE `master_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `jenis` enum('Mahasiswa','Prodi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_kriteria`
--

INSERT INTO `master_kriteria` (`id_kriteria`, `nama_kriteria`, `jenis`) VALUES
(1, 'Proses Belajar Mengajar', 'Mahasiswa'),
(2, 'Kompetensi Dosen', 'Mahasiswa'),
(3, 'test 1', 'Mahasiswa'),
(7, 'Gaya Mengajar Dosen', 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `master_mahasiswa`
--

CREATE TABLE `master_mahasiswa` (
  `nim` int(11) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('Pria','Wanita') NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_prodi`
--

CREATE TABLE `master_prodi` (
  `id_prodi` int(11) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL,
  `id_fakultas` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_prodi`
--

INSERT INTO `master_prodi` (`id_prodi`, `nama_prodi`, `id_fakultas`) VALUES
(1, 'Sistem Informasi', 1),
(2, 'Teknik Informatika', 1),
(3, 'Teknik Elektro', 2),
(4, 'Teknik Industri', 2),
(5, 'Teknik Mesin', 2),
(6, 'Teknik Lingkungan', 3),
(7, 'Arsitektur', 3),
(8, 'Ilmu Komunikasi', 4),
(9, 'Sastra Inggris', 4),
(10, 'Management', 8),
(11, 'Matematika', 9),
(12, 'Fisika', 9);

-- --------------------------------------------------------

--
-- Table structure for table `master_rektor`
--

CREATE TABLE `master_rektor` (
  `nip` varchar(18) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('Pria','Wanita') NOT NULL,
  `alamat` text NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_semester`
--

CREATE TABLE `master_semester` (
  `id_semester` int(11) NOT NULL,
  `semester` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_semester`
--

INSERT INTO `master_semester` (`id_semester`, `semester`) VALUES
(1, 'Semester 1'),
(2, 'Semester 2'),
(3, 'Semester 3'),
(4, 'Semester 4'),
(5, 'Semester 5'),
(6, 'Semester 6'),
(7, 'Semester 7'),
(8, 'Semester 8');

-- --------------------------------------------------------

--
-- Table structure for table `master_subkriteria`
--

CREATE TABLE `master_subkriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `kode_subkriteria` varchar(5) NOT NULL,
  `nama_subkriteria` varchar(100) NOT NULL,
  `bobot` float NOT NULL,
  `id_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_subkriteria`
--

INSERT INTO `master_subkriteria` (`id_subkriteria`, `kode_subkriteria`, `nama_subkriteria`, `bobot`, `id_kriteria`) VALUES
(2, 'C2', 'test 456', 95, 1),
(4, 'C3', 'PBM', 100, 1),
(5, 'C4', 'PBM', 80, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_profil`
--

CREATE TABLE `tb_profil` (
  `id_profil` int(11) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('Pria','Wanita') NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_profil`
--

INSERT INTO `tb_profil` (`id_profil`, `nama_depan`, `nama_belakang`, `tgl_lahir`, `jk`, `alamat`, `email`, `kontak`, `foto`, `id_user`) VALUES
(1, 'Gilang', 'Ramadhan', '0000-00-00', 'Pria', 'Jl. CIhampelas', 'gilang.ramadhan0403@gmail.com', '082130045786', '', 1),
(2, 'Gilang', 'Ramadhan', '0000-00-00', 'Pria', 'Jl. CIhampelas', 'gilang.ramadhan0403@gmail.com', '082130045786', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Mahasiswa','Dosen','Rektor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`) VALUES
(1, 'Gilang', 'admin', 'admin123', 'Admin'),
(9, 'agus buntung', 'agus99', '$2y$10$0gV1y3/i48rKQWtX7ypS8OEbrwuXobvlXF/IlQze2bOAShlaGjh5q', 'Mahasiswa'),
(26, 'Gilang', '20221320033', '$2y$10$GtEq7DFOr6/vaHNzkS/UU.wrc9kCzs4D.yz3QVttaR8C.2QNnLmVW', 'Mahasiswa'),
(28, 'Gilang Ramadhan', 'doyskiii', '$2y$10$a6kPs8k0TvZpvBimp6964O9I0OB4U/XGpKoWm7Xpq5rO3vvWe.B8C', 'Admin'),
(31, 'dosen1', 'dosen1', '$2y$10$WtJRUxK3cifRvoLI4/ajqunfAKohYh.xu4rKQuQlWastzkNqePbc.', 'Dosen'),
(32, 'tester1234', 'test1234', '$2y$10$TBeLcnxp8K.hARrFd/qXFOvGAFjWNbtUnYdfDMeycGVq6UVfHEaDK', 'Mahasiswa'),
(34, 'test5', 'test5', '$2y$10$HiQeN4nc1MTbDnbOUW6dw.M3ovp9A9hysE4S2wOdJKxGV0OjdtFeq', 'Mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indexes for table `hasil_kuisioner`
--
ALTER TABLE `hasil_kuisioner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_subkriteria` (`kode_subkriteria`),
  ADD KEY `id_prodi` (`id_prodi`),
  ADD KEY `nim` (`nim`),
  ADD KEY `nip` (`nip`),
  ADD KEY `id_semester` (`id_semester`);

--
-- Indexes for table `kritik_saran`
--
ALTER TABLE `kritik_saran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip` (`nip`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `kuisioner`
--
ALTER TABLE `kuisioner`
  ADD PRIMARY KEY (`id_kuisioner`),
  ADD KEY `id_semester` (`id_semester`);

--
-- Indexes for table `master_dosen`
--
ALTER TABLE `master_dosen`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_fakultas` (`id_prodi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `master_kriteria`
--
ALTER TABLE `master_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `master_mahasiswa`
--
ALTER TABLE `master_mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `id_prodi` (`id_prodi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `master_prodi`
--
ALTER TABLE `master_prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `nama_fakultas` (`id_fakultas`);

--
-- Indexes for table `master_rektor`
--
ALTER TABLE `master_rektor`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_prodi` (`id_prodi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `master_semester`
--
ALTER TABLE `master_semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `master_subkriteria`
--
ALTER TABLE `master_subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `tb_profil`
--
ALTER TABLE `tb_profil`
  ADD PRIMARY KEY (`id_profil`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kuisioner`
--
ALTER TABLE `kuisioner`
  MODIFY `id_kuisioner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `master_kriteria`
--
ALTER TABLE `master_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `master_prodi`
--
ALTER TABLE `master_prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `master_semester`
--
ALTER TABLE `master_semester`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `master_subkriteria`
--
ALTER TABLE `master_subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_profil`
--
ALTER TABLE `tb_profil`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kuisioner`
--
ALTER TABLE `kuisioner`
  ADD CONSTRAINT `kuisioner_ibfk_1` FOREIGN KEY (`id_semester`) REFERENCES `master_semester` (`id_semester`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `master_dosen`
--
ALTER TABLE `master_dosen`
  ADD CONSTRAINT `master_dosen_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `fakultas` (`id_fakultas`);

--
-- Constraints for table `master_subkriteria`
--
ALTER TABLE `master_subkriteria`
  ADD CONSTRAINT `master_subkriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `master_kriteria` (`id_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
