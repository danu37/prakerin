-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 08, 2026 at 02:36 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prakerin`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CekSiswa` (IN `input_nis` VARCHAR(20))   BEGIN
    SELECT nis, nama_siswa, kelas, jurusan 
    FROM siswa 
    WHERE nis = input_nis;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `TambahJurnal` (IN `p_id_penempatan` INT, IN `p_tanggal` DATE, IN `p_kegiatan` TEXT)   BEGIN
    INSERT INTO jurnal(id_penempatan, tanggal, kegiatan)
    VALUES(p_id_penempatan, p_tanggal, p_kegiatan);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `industri`
--

CREATE TABLE `industri` (
  `id_industri` int NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `alamat` text,
  `bidang_usaha` varchar(50) DEFAULT NULL,
  `pembimbing_lapangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `industri`
--

INSERT INTO `industri` (`id_industri`, `nama_perusahaan`, `alamat`, `bidang_usaha`, `pembimbing_lapangan`) VALUES
(1, 'PT. Teknologi Maju', 'Jl. Digital No. 10, Jakarta', 'Software House', 'Budi Santoso'),
(2, 'CV. Kreatif Desain', 'Jl. Seni No. 5, Bandung', 'Desain Grafis', 'Siti Aminah'),
(3, 'PT. Jaringan Nusantara', 'Jl. Merdeka No. 1, Surabaya', 'Network Engineer', 'Joko Susilo');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `id_jurnal` int NOT NULL,
  `id_penempatan` int DEFAULT NULL,
  `tanggal_kegiatan` date DEFAULT NULL,
  `kegiatan` text,
  `paraf_pembimbing` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`id_jurnal`, `id_penempatan`, `tanggal_kegiatan`, `kegiatan`, `paraf_pembimbing`) VALUES
(1, 1, '2024-01-02', 'Instalasi sistem operasi Linux dan konfigurasi web server', 0),
(2, 1, '2024-01-03', 'Membuat layout database menggunakan MySQL Workbench', 0);

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id_log` int NOT NULL,
  `aksi` varchar(50) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id_log`, `aksi`, `keterangan`, `waktu`) VALUES
(1, 'INSERT SISWA', 'Siswa baru ditambahkan: Budi Santoso', '2026-05-08 08:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `log_penempatan`
--

CREATE TABLE `log_penempatan` (
  `id_log` int NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `waktu_kejadian` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `log_penempatan`
--

INSERT INTO `log_penempatan` (`id_log`, `keterangan`, `waktu_kejadian`) VALUES
(1, 'Siswa dengan NIS 2122003 ditempatkan di Industri ID 1', '2026-05-08 07:24:43');

-- --------------------------------------------------------

--
-- Table structure for table `penempatan`
--

CREATE TABLE `penempatan` (
  `id_penempatan` int NOT NULL,
  `nis` char(10) DEFAULT NULL,
  `id_industri` int DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `status` enum('Aktif','Selesai','Batal') DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penempatan`
--

INSERT INTO `penempatan` (`id_penempatan`, `nis`, `id_industri`, `tanggal_mulai`, `tanggal_selesai`, `status`) VALUES
(1, '2122001', 1, '2024-01-01', '2024-04-01', 'Aktif'),
(3, '2122001', 2, '2024-05-01', '2024-08-01', 'Aktif'),
(4, '2122003', 1, '2024-06-01', '2024-09-01', 'Aktif');

--
-- Triggers `penempatan`
--
DELIMITER $$
CREATE TRIGGER `AfterInsertPenempatan` AFTER INSERT ON `penempatan` FOR EACH ROW BEGIN
    INSERT INTO log_penempatan (keterangan, waktu_kejadian) 
    VALUES (CONCAT('Siswa dengan NIS ', NEW.nis, ' ditempatkan di Industri ID ', NEW.id_industri), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AfterUpdateStatus` AFTER UPDATE ON `penempatan` FOR EACH ROW BEGIN
    IF NEW.status = 'Selesai' THEN
        INSERT INTO log_penempatan(keterangan)
        VALUES(CONCAT('Penempatan NIS ', OLD.nis, ' Telah Selesai'));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` char(10) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama_siswa`, `kelas`, `jurusan`, `no_hp`) VALUES
('2122001', 'Ahmad Fauzi', 'XII RPL 1', 'Rekayasa Perangkat Lunak', '08123456789'),
('2122002', 'Larasati', 'XII RPL 1', 'Rekayasa Perangkat Lunak', '08987654321'),
('2122003', 'Citra Kirana', 'XII RPL 2', 'Rekayasa Perangkat Lunak', '08555666777'),
('2122004', 'Budi Santoso', 'XII TKJ 1', 'Teknik Komputer Jaringan', '0811223344');

--
-- Triggers `siswa`
--
DELIMITER $$
CREATE TRIGGER `AfterInsertSiswa` AFTER INSERT ON `siswa` FOR EACH ROW BEGIN
    
    INSERT INTO log_aktivitas (aksi, keterangan, waktu) 
    VALUES ('INSERT SISWA', CONCAT('Siswa baru ditambahkan: ', NEW.nama_siswa), NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_laporan_prakerin`
-- (See below for the actual view)
--
CREATE TABLE `view_laporan_prakerin` (
`kelas` varchar(10)
,`nama_perusahaan` varchar(100)
,`nama_siswa` varchar(100)
,`nis` char(10)
,`status` enum('Aktif','Selesai','Batal')
,`tanggal_mulai` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_rekap_jurnal`
-- (See below for the actual view)
--
CREATE TABLE `view_rekap_jurnal` (
`kegiatan` text
,`nama_perusahaan` varchar(100)
,`nama_siswa` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `view_laporan_prakerin`
--
DROP TABLE IF EXISTS `view_laporan_prakerin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_laporan_prakerin`  AS SELECT `s`.`nis` AS `nis`, `s`.`nama_siswa` AS `nama_siswa`, `s`.`kelas` AS `kelas`, `i`.`nama_perusahaan` AS `nama_perusahaan`, `p`.`tanggal_mulai` AS `tanggal_mulai`, `p`.`status` AS `status` FROM ((`penempatan` `p` join `siswa` `s` on((`p`.`nis` = `s`.`nis`))) join `industri` `i` on((`p`.`id_industri` = `i`.`id_industri`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_rekap_jurnal`
--
DROP TABLE IF EXISTS `view_rekap_jurnal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_rekap_jurnal`  AS SELECT `s`.`nama_siswa` AS `nama_siswa`, `i`.`nama_perusahaan` AS `nama_perusahaan`, `j`.`kegiatan` AS `kegiatan` FROM (((`jurnal` `j` join `penempatan` `p` on((`j`.`id_penempatan` = `p`.`id_penempatan`))) join `siswa` `s` on((`p`.`nis` = `s`.`nis`))) join `industri` `i` on((`p`.`id_industri` = `i`.`id_industri`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `industri`
--
ALTER TABLE `industri`
  ADD PRIMARY KEY (`id_industri`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id_jurnal`),
  ADD KEY `id_penempatan` (`id_penempatan`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `log_penempatan`
--
ALTER TABLE `log_penempatan`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `penempatan`
--
ALTER TABLE `penempatan`
  ADD PRIMARY KEY (`id_penempatan`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_industri` (`id_industri`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `industri`
--
ALTER TABLE `industri`
  MODIFY `id_industri` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id_jurnal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `log_penempatan`
--
ALTER TABLE `log_penempatan`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penempatan`
--
ALTER TABLE `penempatan`
  MODIFY `id_penempatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `jurnal_ibfk_1` FOREIGN KEY (`id_penempatan`) REFERENCES `penempatan` (`id_penempatan`) ON DELETE CASCADE;

--
-- Constraints for table `penempatan`
--
ALTER TABLE `penempatan`
  ADD CONSTRAINT `penempatan_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE,
  ADD CONSTRAINT `penempatan_ibfk_2` FOREIGN KEY (`id_industri`) REFERENCES `industri` (`id_industri`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
