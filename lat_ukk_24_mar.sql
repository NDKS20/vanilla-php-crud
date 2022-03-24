-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2022 at 09:28 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lat_ukk_24_mar`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbguru`
--

CREATE TABLE `tbguru` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_jurusan` varchar(255) NOT NULL,
  `id_kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbguru`
--

INSERT INTO `tbguru` (`id`, `nama`, `id_jurusan`, `id_kelas`) VALUES
('AA', 'Ana', '1', 'tkj'),
('AB', 'Ana Budi', '2', 'akl');

-- --------------------------------------------------------

--
-- Table structure for table `tbjurusan`
--

CREATE TABLE `tbjurusan` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbjurusan`
--

INSERT INTO `tbjurusan` (`id`, `nama`) VALUES
('akl', 'Akutansi Keuangan dan Lembaga'),
('bdp', 'Bisnis Daring dan Pemasaran'),
('tkj', 'Teknik Komputer dan Jaringan');

-- --------------------------------------------------------

--
-- Table structure for table `tbkelas`
--

CREATE TABLE `tbkelas` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_guru` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbkelas`
--

INSERT INTO `tbkelas` (`id`, `nama`, `id_guru`) VALUES
('1', '10 TKJ 1', 'AA'),
('2', '10 TKJ 2', 'AB');

-- --------------------------------------------------------

--
-- Table structure for table `tbmapel`
--

CREATE TABLE `tbmapel` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_guru` varchar(255) NOT NULL,
  `id_kelas` varchar(255) NOT NULL,
  `id_jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbmapel`
--

INSERT INTO `tbmapel` (`id`, `nama`, `id_guru`, `id_kelas`, `id_jurusan`) VALUES
('2', 'PKN', 'AB', '2', 'akl');

-- --------------------------------------------------------

--
-- Table structure for table `tbsiswa`
--

CREATE TABLE `tbsiswa` (
  `nis` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `id_jurusan` varchar(255) NOT NULL,
  `id_kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbsiswa`
--

INSERT INTO `tbsiswa` (`nis`, `nama`, `tgl_lahir`, `tempat_lahir`, `jenis_kelamin`, `id_jurusan`, `id_kelas`) VALUES
('123', 'asa', '2022-03-11', 'Pontianak', 'L', 'akl', '1'),
('6700', 'Erick', '2022-03-01', 'Pontianak', 'L', 'tkj', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbjurusan`
--
ALTER TABLE `tbjurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbkelas`
--
ALTER TABLE `tbkelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbmapel`
--
ALTER TABLE `tbmapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbsiswa`
--
ALTER TABLE `tbsiswa`
  ADD PRIMARY KEY (`nis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
