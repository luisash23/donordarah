-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 31, 2026 at 03:35 AM
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
-- Database: `darahdonor`
--

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi_donor`
--

CREATE TABLE `konfirmasi_donor` (
  `idKonfirmasi` int NOT NULL,
  `idUser` int NOT NULL,
  `kodeTiket` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `lokasiRS` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggalDonor` date NOT NULL,
  `waktuDonor` time NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_general_ci DEFAULT 'Terkonfirmasi',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konfirmasi_donor`
--

INSERT INTO `konfirmasi_donor` (`idKonfirmasi`, `idUser`, `kodeTiket`, `lokasiRS`, `tanggalDonor`, `waktuDonor`, `status`, `createdAt`) VALUES
(1, 1, '7F23EE27949C', 'Bank Darah Rumah Sakit Pusat', '2026-02-04', '11:00:00', 'Terkonfirmasi', '2026-03-31 02:59:22'),
(4, 2, 'F1B80F9042CC', 'Bank Darah Rumah Sakit Pusat', '2026-02-04', '11:00:00', 'Terkonfirmasi', '2026-03-31 03:27:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUser` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `gmail` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nohp` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `tinggiBadan` int NOT NULL,
  `beratBadan` int NOT NULL,
  `golonganDarah` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `username`, `gmail`, `nohp`, `tinggiBadan`, `beratBadan`, `golonganDarah`, `password`) VALUES
(1, 'luis', 'luis.spt90@gmail.com', '6285116424', 170, 110, 'A', 'luis2009'),
(2, 'caca cimut', 'caca2@gmail.com', '0', 152, 55, 'O', '123456'),
(3, 'james oppa', 'james@gmail.com', '0', 170, 60, 'O', '123456'),
(4, 'luis2', 'luis.spt@gmail.com', '85117011', 180, 80, 'B', 'luis20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `konfirmasi_donor`
--
ALTER TABLE `konfirmasi_donor`
  ADD PRIMARY KEY (`idKonfirmasi`),
  ADD KEY `fk_user_konfirmasi` (`idUser`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konfirmasi_donor`
--
ALTER TABLE `konfirmasi_donor`
  MODIFY `idKonfirmasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `konfirmasi_donor`
--
ALTER TABLE `konfirmasi_donor`
  ADD CONSTRAINT `fk_user_konfirmasi` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
