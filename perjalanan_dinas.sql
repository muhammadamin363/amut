-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Agu 2025 pada 09.50
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perjalanan_dinas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dinas`
--

CREATE TABLE `dinas` (
  `id` int(11) NOT NULL,
  `no_surat_tugas` varchar(50) DEFAULT NULL,
  `no_sppd` varchar(50) DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `pangkat_gol` varchar(50) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `uraian` text DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dinas`
--

INSERT INTO `dinas` (`id`, `no_surat_tugas`, `no_sppd`, `tanggal_surat`, `nama`, `pangkat_gol`, `jabatan`, `uraian`, `tujuan`) VALUES
(31, '800.1.11.1/01/CAU', '01', '2025-08-05', 'ASTIANA ROSANTI, S.IP., M.AP', 'PEMBINA / IVa', 'Camat', 'FGD Penyusunan Dokumen Rencana Kontijensi Banjir', 'Ruang Rapat Kerja Membangun'),
(32, '800.1.11.1/02/CAU', '02', '2025-08-06', 'BAHTIAR, S.IP', 'PENATA TK. I / III/d', 'Kepala Seksi Ketenteraman, Ketertiban dan Pendapatan', 'Monitoring Pelaksanaan Penyaluran BLT – DD Tahun 2025 ', 'Kantor Kepala Desa Panangkalaan Hulu'),
(33, '800.1.11.1/03/CAU', '03', '2025-08-06', 'FADLIAH', 'PENATA TK. I / III/d', 'Kepala Seksi Pelayanan, Perekonomian dan Kesejahteraan Sosial', 'Monitoring Pelaksanaan Penyaluran BLT – DD Tahun 2025 ', 'Kantor Kepala Desa Teluk Daun'),
(34, '800.1.11.1/04/CAU', '04', '2025-08-06', 'MINA OLFAH', 'PENGATUR TK.I/ IId', 'Pengolah Data dan Informasi', 'Monitoring Pelaksanaan Penyaluran BLT – DD Tahun 2025 ', 'Kantor Kepala Desa Pakacangan'),
(35, '800.1.11.1/05/CAU', '05', '2025-08-06', 'NITA LIANI YOENINGSYIH, S.Sos.', 'PENATA MUDA TK. I / III/b', 'Kepala Sub Bagian Keuangan dan Tata Usaha', 'Monitoring Pelaksanaan Penyaluran BLT – DD Tahun 2025 ', 'Kantor Kepala Desa Tayur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `pangkat` varchar(50) NOT NULL,
  `jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama`, `pangkat`, `jabatan`) VALUES
('19680301 198912 2 004', 'FADLIAH', 'PENATA TK. I / III/d', 'Kepala Seksi Pelayanan, Perekonomian dan Kesejahteraan Sosial'),
('19680303 200701 1 043', 'NAPHANI', 'PENATA MUDA / III/a', 'Pengadministrasi Perkantoran'),
('19680403 198803 1 003', 'BAHTIAR, S.IP', 'PENATA TK. I / III/d', 'Kepala Seksi Ketenteraman, Ketertiban dan Pendapatan'),
('19690108 200701 1 025', 'RUSTAM', 'PENGATUR / IIc', 'Pengadministrasi Perkantoran'),
('19701004 200701 1 041', 'RAHMAIDI', 'PENGATUR / IIc', 'Pengadministrasi Perkantoran'),
('19720415 200701 1 43', 'MUHAMAD YUSUF', 'PENGATUR MUDA TK.I / IIb', 'Pengadministrasi Perkantoran'),
('19720817 200701 1 048', 'MUHAMMAD DAHLAN', 'PENATA MUDA / III/a', 'Pengadministrasi Perkantoran'),
('19730505 200901 1 006', 'FAKHRUJIDINOOR', 'PENGATUR TK.I/ IId', 'Pengadministrasi Perkantoran'),
('19750308 199403 2 003', 'NOOR AIDA HAYATI, S. Sos', 'PENATA TK. I / III/d', 'Kepala Seksi Pemerintahan, Pembangunan dan Pemberdayaan Masyarakat'),
('19770625 200701 1 021', 'HAMIDI', 'PENATA MUDA / III/a', 'Pengadministrasi Perkantoran'),
('19780614 201001 1 002', 'SAPRUDIN, S.AP', 'PENATA MUDA TK. I / III/b', 'Kepala Sub Bagian Program dan Data'),
('19811120 200801 2 016', 'NITA LIANI YOENINGSYIH, S.Sos.', 'PENATA MUDA TK. I / III/b', 'Kepala Sub Bagian Keuangan dan Tata Usaha'),
('19830310 201001 2008', 'MINA OLFAH', 'PENGATUR TK.I/ IId', 'Pengolah Data dan Informasi'),
('19880401 200701 2 002', 'ASTIANA ROSANTI, S.IP., M.AP', 'PEMBINA / IVa', 'Camat'),
('19900315 202521 2 007', 'SAHIDA', 'PENGATUR MUDA / IIa', 'Pengadministrasi Perkantoran'),
('19920719 202521 2 008', 'KHAIRUN NISA', 'PENGATUR MUDA / IIa', 'Pengadministrasi Perkantoran'),
('19940519 202505 1 001', 'MUHAMMAD AMIN, S.Kom', 'PENATA MUDA / III/a', 'Penata Kelola Sistem dan Teknologi Informasi'),
('19990904 202505 1 002', 'RAIHAN KHUZAMY, S.Ak', 'PENATA MUDA / III/a', 'Fasilitator Pemerintahan'),
('20000415 202505 2 002', 'NOR AZIJAH, S.AP', 'PENATA MUDA / III/a', 'Pamong Pemerintahan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sppd`
--

CREATE TABLE `sppd` (
  `id` int(11) NOT NULL,
  `no_sppd` varchar(5) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `pangkat_gol` varchar(50) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `no_surat_tugas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sppd`
--

INSERT INTO `sppd` (`id`, `no_sppd`, `nip`, `nama`, `pangkat_gol`, `jabatan`, `no_surat_tugas`) VALUES
(28, '01', '19920719 202521 2 00', 'KHAIRUN NISA', 'PENGATUR MUDA / IIa', 'Pengadministrasi Perkantoran', '800.1.11.1/01/CAU'),
(29, '02', '19830310 201001 2008', 'MINA OLFAH', 'PENGATUR TK.I/ IId', 'Pengolah Data dan Informasi', '800.1.11.1/01/CAU'),
(30, '03', '19940519 202505 1 00', 'MUHAMMAD AMIN, S.Kom', 'PENATA MUDA / III/a', 'Penata Kelola Sistem dan Teknologi Informasi', '800.1.11.1/02/CAU'),
(31, '04', '19990904 202505 1 00', 'RAIHAN KHUZAMY, S.Ak', 'PENATA MUDA / III/a', 'Fasilitator Pemerintahan', '800.1.11.1/02/CAU'),
(32, '05', '20000415 202505 2 00', 'NOR AZIJAH, S.AP', 'PENATA MUDA / III/a', 'Pamong Pemerintahan', '800.1.11.1/02/CAU'),
(33, '06', '19900315 202521 2 00', 'SAHIDA', 'PENGATUR MUDA / IIa', 'Pengadministrasi Perkantoran', '800.1.11.1/02/CAU'),
(35, '07', '19690108 200701 1 02', 'RUSTAM', 'PENGATUR / IIc', 'Pengadministrasi Perkantoran', '800.1.11.1/03/CAU');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_tugas`
--

CREATE TABLE `surat_tugas` (
  `no_surat_tugas` varchar(50) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `uraian` text NOT NULL,
  `tujuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_tugas`
--

INSERT INTO `surat_tugas` (`no_surat_tugas`, `tanggal_surat`, `uraian`, `tujuan`) VALUES
('800.1.11.1/01/CAU', '2025-08-06', 'Monitoring Pelaksanaan Penyaluran BLT – DD Tahun 2025 ', 'Kantor Kepala Desa Teluk Daun'),
('800.1.11.1/02/CAU', '2025-08-06', 'Monitoring Pelaksanaan Penyaluran BLT – DD Tahun 2025 ', 'Kantor Kepala Desa Pakacangan'),
('800.1.11.1/03/CAU', '2025-08-06', 'Monitoring Pelaksanaan Penyaluran BLT – DD Tahun 2025 ', 'Kantor Kepala Desa Tayur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_plain` varchar(255) DEFAULT NULL,
  `role` enum('admin','operator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `password_plain`, `role`) VALUES
(1, 'Admin', 'admin123', NULL, 'admin'),
(4, 'operator', 'operator123', NULL, 'operator');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dinas`
--
ALTER TABLE `dinas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `sppd`
--
ALTER TABLE `sppd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_surat_tugas` (`no_surat_tugas`);

--
-- Indeks untuk tabel `surat_tugas`
--
ALTER TABLE `surat_tugas`
  ADD PRIMARY KEY (`no_surat_tugas`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dinas`
--
ALTER TABLE `dinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `sppd`
--
ALTER TABLE `sppd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `sppd`
--
ALTER TABLE `sppd`
  ADD CONSTRAINT `sppd_ibfk_1` FOREIGN KEY (`no_surat_tugas`) REFERENCES `surat_tugas` (`no_surat_tugas`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
