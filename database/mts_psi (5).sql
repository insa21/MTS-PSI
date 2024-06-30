-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jun 2024 pada 16.31
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mts_psi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `kode_kriteria` varchar(50) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `jenis_kriteria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`kode_kriteria`, `nama_kriteria`, `jenis_kriteria`) VALUES
('C1', 'Nilai rata2 semester', 'Cost'),
('C11', 'Nilai Non-Akademik (Lomba)', 'Benefit'),
('C2', 'Ekstrakulikuler', 'Benefit'),
('C3', 'Presensi', 'Benefit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian_siswa`
--

CREATE TABLE `penilaian_siswa` (
  `id_penilaian` int(11) NOT NULL,
  `kode_siswa` varchar(50) NOT NULL,
  `kode_kriteria` varchar(50) NOT NULL,
  `id_sub_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penilaian_siswa`
--

INSERT INTO `penilaian_siswa` (`id_penilaian`, `kode_siswa`, `kode_kriteria`, `id_sub_kriteria`) VALUES
(153, 'A133', 'C1', 9),
(154, 'A133', 'C2', 12),
(155, 'A133', 'C3', 19),
(157, 'A3', 'C1', 9),
(158, 'A3', 'C2', 15),
(159, 'A3', 'C3', 19),
(167, 'A133', 'C11', 33),
(168, 'A3', 'C11', 31),
(189, '4', 'C1', 9),
(190, '4', 'C11', 33),
(191, '4', 'C2', 12),
(192, '4', 'C3', 18),
(193, '928', 'C1', 10),
(194, '928', 'C11', 31),
(195, '928', 'C2', 14),
(196, '928', 'C3', 18),
(197, '1', 'C1', 8),
(198, '1', 'C11', 32),
(199, '1', 'C2', 14),
(200, '1', 'C3', 19),
(201, 'A133a', 'C1', 7),
(202, 'A133a', 'C11', 31),
(203, 'A133a', 'C2', 13),
(204, 'A133a', 'C3', 18),
(205, '099', 'C1', 7),
(206, '099', 'C11', 33),
(207, '099', 'C2', 13),
(208, '099', 'C3', 17),
(209, '12345666', 'C1', 7),
(210, '12345666', 'C11', 32),
(211, '12345666', 'C2', 15),
(212, '12345666', 'C3', 18),
(213, '123ww', 'C1', 9),
(214, '123ww', 'C11', 33),
(215, '123ww', 'C2', 14),
(216, '123ww', 'C3', 18),
(217, '8484', 'C1', 10),
(218, '8484', 'C11', 34),
(219, '8484', 'C2', 12),
(220, '8484', 'C3', 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `kode_siswa` varchar(50) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `orang_tua_wali` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`kode_siswa`, `nisn`, `nama_siswa`, `kelas`, `jenis_kelamin`, `alamat`, `no_telp`, `orang_tua_wali`) VALUES
('099', '123444ss', 'jowooo', 'RPL 1', 'Perempuan', 'kka', 'ss', 'aa'),
('1', '12345', 'adib', 'RPL 1 123', 'Laki-laki', 'Kp. mekarwangi Desa. Sundawenang Kec. Salawu Kab.Tasikmalaya', '098', '12'),
('12345666', '123444', 'jowooo', 'RPL 1', 'Perempuan', 'kodi', 'ss', 'aa'),
('123ww', 'sa', 'sas', 'jsjs', 'Laki-laki', 'sass', 'sas', 'sas'),
('4', '0001', 'ss', 'sd', 'Laki-laki', 'ss', 'ss', 'a'),
('8484', 'nssn', 'sasa', 'sa', 'Laki-laki', 'saasa', 'sasas', '00'),
('928', '33', 'juwandii', '4', 'Laki-laki', 'saa', 'asas', 'sa'),
('A133', '123 ', 'joko', 'RPL 1 123', 'Laki-laki', 'Kp. mekarwangi Desa. Sundawenang Kec. Salawu Kab.Tasikmalaya', '089655', 'joni'),
('A133a', '21221', 'ari', '+628965502', 'Laki-laki', 'sss', 'saa', 'ss'),
('A3', '21221s', 'ooowiiiiii', '+628965502', 'Laki-laki', 'Kp. mekarwangi Desa. Sundawenang Kec. Salawu Kab.Tasikmalaya', '089655', 'jono');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(50) DEFAULT NULL,
  `sub_kriteria` varchar(255) DEFAULT NULL,
  `bobot_sub_kriteria` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `kode_kriteria`, `sub_kriteria`, `bobot_sub_kriteria`) VALUES
(6, 'C3', 'Baik Sekali', 5),
(7, 'C1', 'sangat buruk', 1),
(8, 'C1', 'Buruk', 2),
(9, 'C1', 'sedang', 3),
(10, 'C1', 'Baik', 4),
(11, 'C1', 'Sangat Baik', 5),
(12, 'C2', 'Sangat Baik', 5),
(13, 'C2', 'Baik', 4),
(14, 'C2', 'sedang', 3),
(15, 'C2', 'Buruk', 2),
(16, 'C2', 'sangat buruk', 1),
(17, 'C3', 'sedang', 3),
(18, 'C3', 'Buruk', 2),
(19, 'C3', 'sangat buruk', 1),
(26, 'C3', 'Baik', 4),
(30, 'C11', 'Baik', 4),
(31, 'C11', 'Sedang', 3),
(32, 'C11', 'sangat buruk', 1),
(33, 'C11', 'Buruk', 2),
(34, 'C11', 'Sangat baik', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`) VALUES
(1, 'admin xx12', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indeks untuk tabel `penilaian_siswa`
--
ALTER TABLE `penilaian_siswa`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `kode_siswa` (`kode_siswa`),
  ADD KEY `kode_kriteria` (`kode_kriteria`),
  ADD KEY `fk_penilaian_siswa_sub_kriteria` (`id_sub_kriteria`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`kode_siswa`);

--
-- Indeks untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `idx_kode_kriteria` (`kode_kriteria`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `penilaian_siswa`
--
ALTER TABLE `penilaian_siswa`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `penilaian_siswa`
--
ALTER TABLE `penilaian_siswa`
  ADD CONSTRAINT `fk_penilaian_siswa_kriteria` FOREIGN KEY (`kode_kriteria`) REFERENCES `kriteria` (`kode_kriteria`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_penilaian_siswa_siswa` FOREIGN KEY (`kode_siswa`) REFERENCES `siswa` (`kode_siswa`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `fk_sub_kriteria_kriteria` FOREIGN KEY (`kode_kriteria`) REFERENCES `kriteria` (`kode_kriteria`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
