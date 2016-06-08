-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2016 at 06:39 PM
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
(23, '123', 'presentasi');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `foto` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `password`, `nama`, `foto`, `deskripsi`, `status`) VALUES
('1', '1', 'Reki', '1.jpg', 'dosen 1', 'AVAILABLE'),
('2', '2', 'Aulia', '2.jpg', 'dosen 2', 'BUSY'),
('3', '3', 'Aga', '3.jpg', 'dosen 3', 'UNAVAILABLE'),
('4', '4', 'Pompom', '4.jpg', 'dosen 4', 'BUSY'),
('5', '5', 'Dafik', '5.jpg', 'dosen 5', 'UNAVAILABLE'),
('6', '6', 'Mr. Ayi', '4.jpg', 'dosen 6', 'BUSY');

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
(17, '123', '1'),
(20, '123', '2'),
(29, '222', '1'),
(30, '123', '3'),
(38, '222', '2'),
(39, '222', '3');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `password`, `nama`, `foto`, `deskripsi`) VALUES
('123', '123', 'Agus', '1.jpg', 'Leting 2014'),
('222', '222', 'Budi', '2.jpg', 'namaku budi');

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
(1, 'Pemograman Berbasi Web', '1', 'sdsdsdsd', '2016-06-08', '222', '', '0000-00-00'),
(2, 'Jaringan Komputer', '4', 'Besok kuliah di Ruang 204', '2016-06-21', '222', '', '0000-00-00');

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
(1, '1', '222', 'dari dosen', 'haha', '2016-06-15', 'READ', 'FAVORITE'),
(2, '123', '222', 'HAHA', 'hahaha', '2016-06-04', 'READ', 'FAVORITE'),
(4, '123', '222', 'UHUT', 'hsgdsjdfshgdfsg', '2016-06-19', 'READ', 'FAVORITE'),
(5, '222', '123', 'JAJAJA', 'shdgshdfhsgdf', '2016-06-13', 'UNREAD', 'FAVORITE'),
(7, '1', '123', 'TES KE 123', '<p><i><u>asasasas</u></i></p>', '2016-06-08', 'UNREAD', 'UNFAVORITE');

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
(1, '222', 1, 'APPROVED'),
(2, '123', 1, 'APPROVED'),
(3, '222', 2, 'PENDING'),
(4, '123', 2, 'APPROVED');

--
-- Indexes for dumped tables
--

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
  MODIFY `idcatatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `favorit`
--
ALTER TABLE `favorit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `idpelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `idpesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
