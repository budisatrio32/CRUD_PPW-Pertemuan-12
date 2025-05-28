-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2025 at 11:01 AM
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
-- Database: `proyekjadwalsepakbola`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `ID_FEEDBACK` int(11) NOT NULL,
  `NAMA_USER` varchar(50) NOT NULL,
  `STATUS_PEKERJAAN` varchar(50) DEFAULT NULL,
  `PESAN` text NOT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `liga`
--

CREATE TABLE `liga` (
  `ID_LIGA` char(5) NOT NULL,
  `NAMA_LIGA` varchar(50) NOT NULL,
  `LOGO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `liga`
--

INSERT INTO `liga` (`ID_LIGA`, `NAMA_LIGA`, `LOGO`) VALUES
('LIG01', 'La Liga', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `musim`
--

CREATE TABLE `musim` (
  `ID_MUSIM` char(5) NOT NULL,
  `ID_LIGA` char(5) NOT NULL,
  `TAHUN_MULAI` int(4) NOT NULL,
  `TAHUN_SELESAI` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `musim`
--

INSERT INTO `musim` (`ID_MUSIM`, `ID_LIGA`, `TAHUN_MULAI`, `TAHUN_SELESAI`) VALUES
('MSM01', 'LIG01', 2024, 2025);

-- --------------------------------------------------------

--
-- Table structure for table `pemain`
--

CREATE TABLE `pemain` (
  `ID_PEMAIN` char(5) NOT NULL,
  `ID_TIM` char(5) NOT NULL,
  `NAMA_PEMAIN` varchar(50) NOT NULL,
  `NOMOR_PUNGGUNG` int(11) DEFAULT NULL,
  `POSISI` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemain`
--

INSERT INTO `pemain` (`ID_PEMAIN`, `ID_TIM`, `NAMA_PEMAIN`, `NOMOR_PUNGGUNG`, `POSISI`) VALUES
('PLB01', 'TIM02', 'Marc-André ter Stegen', 1, 'Goalkeeper'),
('PLB02', 'TIM02', 'Pau Cubarsí', 2, 'Defender'),
('PLB03', 'TIM02', 'Alejandro Balde', 3, 'Defender'),
('PLB04', 'TIM02', 'Ronald Araújo', 4, 'Defender'),
('PLB05', 'TIM02', 'Iñigo Martínez', 5, 'Defender'),
('PLB06', 'TIM02', 'Gavi', 6, 'Midfielder'),
('PLB07', 'TIM02', 'Ferran Torres', 7, 'Forward'),
('PLB08', 'TIM02', 'Pedri', 8, 'Midfielder'),
('PLB09', 'TIM02', 'Robert Lewandowski', 9, 'Forward'),
('PLB10', 'TIM02', 'Ansu Fati', 10, 'Forward'),
('PLB11', 'TIM02', 'Raphinha', 11, 'Forward'),
('PLB12', 'TIM02', 'Iñaki Peña', 13, 'Goalkeeper'),
('PLB13', 'TIM02', 'Pablo Torre', 14, 'Midfielder'),
('PLB14', 'TIM02', 'Andreas Christensen', 15, 'Defender'),
('PLB15', 'TIM02', 'Fermín López', 16, 'Midfielder'),
('PLB16', 'TIM02', 'Marc Casadó', 17, 'Midfielder'),
('PLB17', 'TIM02', 'Pau Víctor', 18, 'Forward'),
('PLB18', 'TIM02', 'Lamine Yamal', 19, 'Forward'),
('PLB19', 'TIM02', 'Dani Olmo', 20, 'Midfielder'),
('PLB20', 'TIM02', 'Frenkie de Jong', 21, 'Midfielder'),
('PLB21', 'TIM02', 'Jules Koundé', 23, 'Defender'),
('PLB22', 'TIM02', 'Eric García', 24, 'Defender'),
('PLB23', 'TIM02', 'Wojciech Szczęsny', 25, 'Goalkeeper'),
('PLR01', 'TIM01', 'Thibaut Courtois', 1, 'Goalkeeper'),
('PLR02', 'TIM01', 'Fran García', 2, 'Defender'),
('PLR03', 'TIM01', 'Éder Militão', 3, 'Defender'),
('PLR04', 'TIM01', 'David Alaba', 4, 'Defender'),
('PLR05', 'TIM01', 'Luka Modrić', 5, 'Midfielder'),
('PLR06', 'TIM01', 'Eduardo Camavinga', 6, 'Midfielder'),
('PLR07', 'TIM01', 'Vinícius Jr.', 7, 'Forward'),
('PLR08', 'TIM01', 'Aurélien Tchouaméni', 8, 'Midfielder'),
('PLR09', 'TIM01', 'Kylian Mbappé', 9, 'Forward'),
('PLR10', 'TIM01', 'Dani Ceballos', 10, 'Midfielder'),
('PLR11', 'TIM01', 'Rodrygo', 11, 'Forward'),
('PLR12', 'TIM01', 'Andriy Lunin', 13, 'Goalkeeper'),
('PLR13', 'TIM01', 'Aurelien Tchouameni', 14, 'Midfielder'),
('PLR14', 'TIM01', 'Federico Valverde', 15, 'Midfielder'),
('PLR15', 'TIM01', 'Endrick', 16, 'Forward'),
('PLR16', 'TIM01', 'Lucas Vázquez', 17, 'Defender'),
('PLR17', 'TIM01', 'Jesús Vallejo', 18, 'Defender'),
('PLR18', 'TIM01', 'Jude Bellingham', 19, 'Midfielder'),
('PLR19', 'TIM01', 'Ferland Mendy', 20, 'Defender'),
('PLR20', 'TIM01', 'Brahim Díaz', 21, 'Forward'),
('PLR21', 'TIM01', 'Antonio Rüdiger', 22, 'Defender'),
('PLR22', 'TIM01', 'Arda Güler', 23, 'Midfielder');

-- --------------------------------------------------------

--
-- Table structure for table `pertandingan`
--

CREATE TABLE `pertandingan` (
  `ID_PERTANDINGAN` char(5) NOT NULL,
  `TANGGAL` date NOT NULL,
  `WAKTU` time NOT NULL,
  `ID_AWAYTEAM` char(5) NOT NULL,
  `ID_HOMETEAM` char(5) NOT NULL,
  `ID_STADION` char(5) NOT NULL,
  `ID_LIGA` char(5) NOT NULL,
  `ID_MUSIM` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stadion`
--

CREATE TABLE `stadion` (
  `ID_STADION` char(5) NOT NULL,
  `NAMA_STADION` varchar(50) NOT NULL,
  `LOKASI` varchar(50) NOT NULL,
  `KAPASITAS` int(11) DEFAULT NULL,
  `FOTO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stadion`
--

INSERT INTO `stadion` (`ID_STADION`, `NAMA_STADION`, `LOKASI`, `KAPASITAS`, `FOTO`) VALUES
('STD01', 'Santiago Bernabéu', 'Madrid, Spanyol', 81044, NULL),
('STD02', 'Camp Nou', 'Barcelona, Spanyol', 99354, NULL),
('STD03', 'Wanda Metropolitano', 'Madrid, Spanyol', 68456, NULL),
('STD04', 'Ramón Sánchez Pizjuán', 'Sevilla, Spanyol', 43883, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tim`
--

CREATE TABLE `tim` (
  `ID_TIM` char(5) NOT NULL,
  `ID_LIGA` char(5) NOT NULL,
  `ID_STADION` char(5) NOT NULL,
  `LOGO_TIM` varchar(255) DEFAULT NULL,
  `NAMA_TIM` varchar(50) NOT NULL,
  `PELATIH` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tim`
--

INSERT INTO `tim` (`ID_TIM`, `ID_LIGA`, `ID_STADION`, `LOGO_TIM`, `NAMA_TIM`, `PELATIH`) VALUES
('TIM01', 'LIG01', 'STD01', NULL, 'Real Madrid', 'Carlo Ancelotti'),
('TIM02', 'LIG01', 'STD02', NULL, 'FC Barcelona', 'Xavi Hernández'),
('TIM04', 'LIG01', 'STD04', NULL, 'Sevilla FC', 'José Luis Mendilibar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`ID_FEEDBACK`);

--
-- Indexes for table `liga`
--
ALTER TABLE `liga`
  ADD PRIMARY KEY (`ID_LIGA`);

--
-- Indexes for table `musim`
--
ALTER TABLE `musim`
  ADD PRIMARY KEY (`ID_MUSIM`),
  ADD KEY `ID_LIGA` (`ID_LIGA`);

--
-- Indexes for table `pemain`
--
ALTER TABLE `pemain`
  ADD PRIMARY KEY (`ID_PEMAIN`),
  ADD KEY `ID_TIM` (`ID_TIM`);

--
-- Indexes for table `pertandingan`
--
ALTER TABLE `pertandingan`
  ADD PRIMARY KEY (`ID_PERTANDINGAN`),
  ADD KEY `ID_AWAYTEAM` (`ID_AWAYTEAM`),
  ADD KEY `ID_HOMETEAM` (`ID_HOMETEAM`),
  ADD KEY `ID_STADION` (`ID_STADION`),
  ADD KEY `ID_LIGA` (`ID_LIGA`),
  ADD KEY `ID_MUSIM` (`ID_MUSIM`);

--
-- Indexes for table `stadion`
--
ALTER TABLE `stadion`
  ADD PRIMARY KEY (`ID_STADION`);

--
-- Indexes for table `tim`
--
ALTER TABLE `tim`
  ADD PRIMARY KEY (`ID_TIM`),
  ADD KEY `ID_LIGA` (`ID_LIGA`),
  ADD KEY `ID_STADION` (`ID_STADION`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID_FEEDBACK` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `musim`
--
ALTER TABLE `musim`
  ADD CONSTRAINT `musim_ibfk_1` FOREIGN KEY (`ID_LIGA`) REFERENCES `liga` (`ID_LIGA`);

--
-- Constraints for table `pemain`
--
ALTER TABLE `pemain`
  ADD CONSTRAINT `pemain_ibfk_1` FOREIGN KEY (`ID_TIM`) REFERENCES `tim` (`ID_TIM`);

--
-- Constraints for table `pertandingan`
--
ALTER TABLE `pertandingan`
  ADD CONSTRAINT `pertandingan_ibfk_1` FOREIGN KEY (`ID_AWAYTEAM`) REFERENCES `tim` (`ID_TIM`),
  ADD CONSTRAINT `pertandingan_ibfk_2` FOREIGN KEY (`ID_HOMETEAM`) REFERENCES `tim` (`ID_TIM`),
  ADD CONSTRAINT `pertandingan_ibfk_3` FOREIGN KEY (`ID_STADION`) REFERENCES `stadion` (`ID_STADION`),
  ADD CONSTRAINT `pertandingan_ibfk_4` FOREIGN KEY (`ID_LIGA`) REFERENCES `liga` (`ID_LIGA`),
  ADD CONSTRAINT `pertandingan_ibfk_5` FOREIGN KEY (`ID_MUSIM`) REFERENCES `musim` (`ID_MUSIM`);

--
-- Constraints for table `tim`
--
ALTER TABLE `tim`
  ADD CONSTRAINT `tim_ibfk_1` FOREIGN KEY (`ID_LIGA`) REFERENCES `liga` (`ID_LIGA`),
  ADD CONSTRAINT `tim_ibfk_2` FOREIGN KEY (`ID_STADION`) REFERENCES `stadion` (`ID_STADION`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
