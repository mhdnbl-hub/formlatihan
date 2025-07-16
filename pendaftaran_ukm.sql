-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2025 at 05:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pendaftaran_ukm`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `nama`, `email`, `password`, `role`) VALUES
(2, 'Muhammad Nabil', 'nabilhdfz98@gmail.com', '$2y$10$TG5FKf00GyBtuFJeJwP/F.G3UQiIBkUvX9U3Q.gsea8lEErcfLrTe', 'user'),
(7, 'Admin UKMate', 'admin@ukmate.com', '$2y$10$qrkbTYkLXn/UQ4tUTMslpuVCrC6SE6g.II9uOTIr4CbNQ.Dzs/j/u', 'admin'),
(8, 'Habil Arrahman', 'habil@gmail.com', '$2y$10$bGfF7AgZWZAJiS3LZwnJ5OEGX1BZrbJU60bH3ibOHXPRUSJ4ogthe', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_ukm` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `prodi` varchar(100) DEFAULT NULL,
  `tanggal_daftar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `id_user`, `id_ukm`, `nama_lengkap`, `nim`, `prodi`, `tanggal_daftar`) VALUES
(1, 8, 12, 'Habil Arrahman', '2401082000', 'Akuntansi', '2025-07-01'),
(2, 2, 8, 'Muhammad Nabil al-Hafiz', '2401082008', 'Teknik Komputer', '2025-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `ukm`
--

CREATE TABLE `ukm` (
  `id` int(11) NOT NULL,
  `nama_ukm` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ukm`
--

INSERT INTO `ukm` (`id`, `nama_ukm`, `deskripsi`) VALUES
(1, 'UKM Seni Rupa', 'Tempat untuk menuangkan kreativitas lewat lukisan, ilustrasi, dan pameran kampus.'),
(2, 'UKM Bahasa Inggris', 'Asah kemampuan speaking & debate kamu sambil seru-seruan bareng native speakers.'),
(3, 'UKM Kewirausahaan', 'Belajar membangun bisnis dari nol, bikin produk & event bazar kampus.'),
(4, 'UKM e-Sport', 'Komunitas gamer kompetitif dari Mobile Legends, Valorant, hingga FIFA.'),
(5, 'UKM Fotografi', 'Belajar teknik fotografi, editing, hingga hunting outdoor & lomba foto.'),
(6, 'UKM Teater', 'Latihan drama, naskah, dan pertunjukan teater kampus secara profesional.'),
(7, 'UKM Bela Diri', 'Karate, Taekwondo, Pencak Silat—untuk kamu yang ingin sehat & disiplin.'),
(8, 'UKM Musik', 'Tempat berkumpulnya pecinta musik kampus. Tersedia band, akustik, dan orkestra mini.'),
(9, 'UKM Jurnalistik', 'Menyalurkan aspirasi dan informasi lewat media kampus dan opini mahasiswa.'),
(10, 'UKM Pecinta Alam', 'Eksplorasi alam bebas, konservasi lingkungan, dan petualangan pegunungan.'),
(11, 'UKM Robotika', 'Tempat mahasiswa teknik dan sains eksplor robot & teknologi terkini.'),
(12, 'UKM Bahasa Jepang', 'Belajar bahasa dan budaya Jepang dari nol hingga fasih sambil seru-seruan.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_ukm` (`id_ukm`);

--
-- Indexes for table `ukm`
--
ALTER TABLE `ukm`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ukm`
--
ALTER TABLE `ukm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `akun` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`id_ukm`) REFERENCES `ukm` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
