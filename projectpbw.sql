-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2016 at 07:34 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectpbw`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `catatan`
--

CREATE TABLE `catatan` (
  `idcatatan` int(11) NOT NULL,
  `pembuat` varchar(255) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catatan`
--

INSERT INTO `catatan` (`idcatatan`, `pembuat`, `catatan`) VALUES
(21, '222', 'gagagagaga'),
(22, '222', 'asasasas'),
(24, '222', 'Catatan hari inifdfdfd');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `about` text NOT NULL,
  `award` text NOT NULL,
  `misc` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `password`, `nama`, `gender`, `email`, `foto`, `deskripsi`, `about`, `award`, `misc`, `status`) VALUES
('00000', '00000', 'dosen tes', 'male', '', '1.jpg', 'as', 'as', 'as', 'as', 'UNAVAILABLE'),
('11111', '11111', 'Dr. Taufik F.A,S.Si,M.Tech', '', '', '11111.jpg', 'Ketua Puksi', 'I completed my Ph.D in Computer Science from North Dakota State University, USA, in 2006 under the supervision of Prof. Dr. William Perrizo and finished Master degree in Computer Science from Royal Melbourne Institute of Technology, Australia, in 2000. I had been a Senior Software Engineer at Ask.com, one of the U.S. core search engine companies, developing algorithms and implementing efficient production-level programs to improve web search results.', '08-08-2000, Comm. Tech Communications Industry Price (Computing) for Academic Excellent, Given by RMIT University, Melbourne, Australia.', '', 'UNAVAILABLE'),
('121212', '121212', 'dosen Baru', 'female', '', '6.jpg', 'asas', 'asas', 'asas', 'asas', ''),
('12345', '12345', 'Viska M, S.Sn, M.IT.', 'male', '', '12345.jpg', 'Dosen yang ramah', 'I am one of lecturer in Informatics (Computer Science) Department at the Faculty of Mathematics and Natural Science of Syiah Kuala University, Banda Aceh. I received both B.IT. and M.IT. degree in Computer Science from Universiti Kebangsaan Malaysia (The National University of Malaysia) , Malaysia. I completed my bachelor in 2003 with final project related to Malay-English dictionary for mobile phone. Then I completed my master in 2007 with master thesis related to jawi image segmentation by using Voronoi diagram. ', 'anugerah Pencinta Ilmu, Tun Seri Lanang Library, Universiti Kebangsaan Malaysia, Universiti Kebangsaan Malaysia, Malaysia.', '', 'AVAILABLE'),
('4', '4', 'Abdullah', '', '', '4.jpg', 'dosen 4', '', '', '', 'BUSY'),
('5', '5', 'Budi', '', '', '5.jpg', 'dosen 5', '', '', '', 'UNAVAILABLE'),
('6', '6', 'Nurlela', '', '', '6.jpg', 'dosen 6', '', '', '', 'BUSY'),
('61426714', '61426714', 'tes lagi', 'female', '', '4.jpg', 'ss', 'ss', 'ss', 'ss', 'UNAVAILABLE'),
('67890', '67890', 'Razief P.F.A,S.Si.,M.Sc', '', '', '67890.jpg', 'Dosen Rajin', 'Menyelesaikan pendidikan Sarjana pada Jurusan Matematika Fakultas Matematika dan Ilmu Pengetahuan Alam pada tahun 2007. Pada tahun 2011 menyelesaikan studi di Program Master Communication and Media Engineering, University of Applied Science, Offenburg, Germany. Mulai aktif sebagai staf pengajar jurusan Informatika Unsyiah sejak tahun 2012 sampai sekarang. Aktif membimbing mahasiswa untuk bidang Networking dan Information, Communication and Technology for Development (ICT4D). Saat ini juga aktif membantu pengembangan beberapa sistem informasi yang berbasis Usaha Kecil, Menengah dan Mikro (UMKM) dengan bekerjasama dengan berbagai pihak terkait.', '', '', 'AVAILABLE');

-- --------------------------------------------------------

--
-- Table structure for table `favorit`
--

CREATE TABLE `favorit` (
  `id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorit`
--

INSERT INTO `favorit` (`id`, `nim`, `nip`) VALUES
(17, '123', '12345'),
(20, '123', '67890'),
(29, '222', '12345'),
(30, '123', '11111'),
(38, '222', '67890'),
(41, '222', '11111');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nohp` varchar(255) NOT NULL,
  `jeniskelamin` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tanggallahir` date NOT NULL,
  `foto` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `statusmhs` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `password`, `nama`, `nohp`, `jeniskelamin`, `jurusan`, `email`, `tanggallahir`, `foto`, `deskripsi`, `statusmhs`) VALUES
('123', '123', 'Agus', '', '', '', '', '0000-00-00', '1.jpg', 'Leting 2014', 'APPROVED'),
('222', '222', 'BUDI', '', 'Laki-Laki', 'Informatika', 'infodosenapp@yahoo.com', '2016-06-16', '222.jpg', 'mahasiswa rajin', 'APPROVED'),
('333', '333', '333', '', 'Laki-Laki', 'Informatika', 'sdjgshdg@gmail.com', '2016-12-31', '', '', 'APPROVED'),
('444', '444', '444', '', 'Laki-Laki', 'Informatika', 'sdjgshdg@gmail.com', '2016-12-31', '', '', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `idpelajaran` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `pengajar` varchar(255) NOT NULL,
  `pesandosen` text NOT NULL,
  `tanggaldosen` date NOT NULL,
  `komting` varchar(30) NOT NULL,
  `pesankomting` text NOT NULL,
  `tanggalkomting` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`idpelajaran`, `nama`, `pengajar`, `pesandosen`, `tanggaldosen`, `komting`, `pesankomting`, `tanggalkomting`) VALUES
(1, 'Pemograman Berbasis Web', '12345', 'kita presentasi HARI INI', '2016-06-09', '123', 'dari agus di PBW', '2016-06-09'),
(2, 'Jaringan Komputer', '67890', 'Besok kuliah di Ruang 204', '2016-06-21', '222', 'tested', '2016-06-15'),
(3, 'Pemograman', '11111', 'Mulai semester depan ya', '2016-06-09', '', '', '0000-00-00'),
(4, 'Basis Data', '12345', '', '0000-00-00', '', '', '0000-00-00'),
(5, 'mk tes', '00000', '', '0000-00-00', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `idpesan` int(11) NOT NULL,
  `pengirim` varchar(255) NOT NULL,
  `penerima` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `isipesan` text NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `favorit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`idpesan`, `pengirim`, `penerima`, `subject`, `isipesan`, `tanggal`, `status`, `favorit`) VALUES
(2, '123', '222', 'HAHA', 'hahaha', '2016-06-04', 'READ', 'UNFAVORITE'),
(10, '12345', '222', 'Dari Dosen', '<p><b>hari ini kita presentasi</b></p>', '2016-06-09', 'READ', 'UNFAVORITE'),
(11, '12345', '222', 'Dari Dosen', '<p>kita presentasi</p>', '2016-06-09', 'UNREAD', 'UNFAVORITE'),
(12, '222', '67890', 'Laporan ', '<p>Laporan oh laporan</p>', '2016-06-09', 'UNREAD', 'UNFAVORITE');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `nim` varchar(30) NOT NULL,
  `pelajaran` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id`, `nim`, `pelajaran`, `status`) VALUES
(3, '123', 1, 'APPROVED'),
(13, '123', 2, 'PENDING'),
(14, '222', 1, 'PENDING'),
(15, '222', 2, 'APPROVED');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`idcatatan`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`idpelajaran`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`idpesan`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catatan`
--
ALTER TABLE `catatan`
  MODIFY `idcatatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `favorit`
--
ALTER TABLE `favorit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `idpelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `idpesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
