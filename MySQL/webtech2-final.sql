-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2018 at 06:49 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webtech2-final`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktuality`
--

CREATE TABLE `aktuality` (
  `id` int(11) NOT NULL,
  `titulok` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `obsah` varchar(500) COLLATE utf8_slovak_ci NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `aktuality`
--

INSERT INTO `aktuality` (`id`, `titulok`, `obsah`, `datum`) VALUES
(15, 'jdnfcjdncx', 'cxjvnjcv', '2018-05-15'),
(20, 'jxnvjcvnc', 'xncxkvnxk', '2018-05-15'),
(21, 'TEST', 'TEST', '2018-05-16'),
(22, 'TEST', 'TEST', '2018-05-16'),
(23, 'aaa', 'aaaa', '2018-05-16'),
(24, 'djnsksfbdjnkslabn', 'gfdsckbvkaxjmz', '2018-05-16'),
(25, 'kokotina', 'kokotina', '2018-05-16'),
(26, 'test', 'test', '2018-05-16'),
(27, 'test', 'test', '2018-05-16'),
(28, 'aaaa', 'aaaa', '2018-05-16'),
(29, 'aaaa', 'aaaa', '2018-05-16'),
(30, 'ttt', 'tttt', '2018-05-16'),
(31, 'h', 'h', '2018-05-16'),
(32, 'Dôležitá informácia', 'Vážený používateľ,\r\n\r\nz dôvodu neaktivity vyššej ako 3 (slovom tri) hodiny ste boli vylúčený z tímu Webtech2-final.\r\n\r\nAk chcete byť znovu prijatý, uhradte penále vo výške 10 000 € (slovom desaťtisíc) v 5 (slovom päť ) eurových bankovkách.', '2018-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `pouzivatelia`
--

CREATE TABLE `pouzivatelia` (
  `id` int(11) NOT NULL,
  `meno` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `priezvisko` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_slovak_ci NOT NULL,
  `heslo` varchar(60) COLLATE utf8_slovak_ci NOT NULL,
  `stredna_skola` varchar(40) COLLATE utf8_slovak_ci NOT NULL,
  `stredna_skola_adresa` varchar(60) COLLATE utf8_slovak_ci NOT NULL,
  `ulica` varchar(40) COLLATE utf8_slovak_ci NOT NULL,
  `psc` varchar(10) COLLATE utf8_slovak_ci NOT NULL,
  `obec` varchar(40) COLLATE utf8_slovak_ci NOT NULL,
  `rola` varchar(10) COLLATE utf8_slovak_ci NOT NULL DEFAULT 'user',
  `odoberatel` tinyint(1) NOT NULL DEFAULT '0',
  `prve_prihlasenie` int(11) NOT NULL DEFAULT '0',
  `id_timu` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `pouzivatelia`
--

INSERT INTO `pouzivatelia` (`id`, `meno`, `priezvisko`, `email`, `heslo`, `stredna_skola`, `stredna_skola_adresa`, `ulica`, `psc`, `obec`, `rola`, `odoberatel`, `prve_prihlasenie`, `id_timu`) VALUES
(4, 'Peter', 'Radvan', 'peterradvan@gmail.com', '$2y$10$Wlyw5xYwJsQfm/rd7N9msecqHdMSeLAwGnmoCCgvxfcaEfrLXtdDG', 'GCM', 'Farska 10, Nitra', 'Lipova 19', '95193', 'Topolcianky', 'admin', 0, 0, 1),
(8, 'Marek', 'Blaha', 'blaha.marcus@gmail.com', '$2y$10$Wlyw5xYwJsQfm/rd7N9msecqHdMSeLAwGnmoCCgvxfcaEfrLXtdDG', 'GSM', 'Nizna revuca 36', 'nizna revuca 36', '034 74', 'Liptovske Revuce', 'user', 0, 0, 1),
(9, 'Marcel', 'Boldiš', 'marcelboldis@gmail.com', '$2y$10$Wlyw5xYwJsQfm/rd7N9msecqHdMSeLAwGnmoCCgvxfcaEfrLXtdDG', 'Gymnázium Vráble', 'Vráble', 'Veľké Vozokany', '95182', 'Veľké Vozokany', 'user', 0, 0, 0),
(10, 'Nika', 'Čarnogurská', 'nika@gmail.com', '$2y$10$Wlyw5xYwJsQfm/rd7N9msecqHdMSeLAwGnmoCCgvxfcaEfrLXtdDG', 'Topolčany', 'Topolčany', 'Topolčany', '596', 'Topolčany', 'user', 0, 0, 0),
(11, 'Matúš', 'Bubelíny', 'matus@gmail.com', '$2y$10$Wlyw5xYwJsQfm/rd7N9msecqHdMSeLAwGnmoCCgvxfcaEfrLXtdDG', 'Brezno', 'Brezno', 'Brezno', '9535', 'Brezno', 'admin', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tim`
--

CREATE TABLE `tim` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazov` varchar(50) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `tim`
--

INSERT INTO `tim` (`id`, `nazov`) VALUES
(1, 'tim');

-- --------------------------------------------------------

--
-- Table structure for table `trasa`
--

CREATE TABLE `trasa` (
  `id` int(10) UNSIGNED NOT NULL,
  `start_nazov` varchar(50) COLLATE utf8_slovak_ci NOT NULL,
  `start_lat` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `start_long` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `ciel_nazov` varchar(50) COLLATE utf8_slovak_ci NOT NULL,
  `ciel_lat` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `ciel_long` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `celkove_km` double NOT NULL,
  `datum_vytvorenia` datetime NOT NULL,
  `mod_trasy` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `vytvoril` varchar(100) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `trasa`
--

INSERT INTO `trasa` (`id`, `start_nazov`, `start_lat`, `start_long`, `ciel_nazov`, `ciel_lat`, `ciel_long`, `celkove_km`, `datum_vytvorenia`, `mod_trasy`, `id_user`, `vytvoril`) VALUES
(55, 'Bratislava, Slovensko', '48.1485965', '17.10774779999997', 'Košice, Slovensko', '48.7163857', '21.26107460000003', 403.63, '2018-05-17 23:00:52', 'privátny', 4, 'Peter Radvan'),
(56, 'Málaga, Španielsko', '36.721261', '-4.421265500000004', 'Madrid, Španielsko', '40.4167754', '-3.7037901999999576', 529.388, '2018-05-17 23:01:43', 'verejný', 4, 'Peter Radvan'),
(57, 'Liptovský Mikuláš, Slovensko', '49.0811487', '19.61920669999995', 'Liptovské Revúce, Slovensko', '48.9232669', '19.182118599999967', 46.3, '2018-05-18 16:16:02', 'privátny', 8, 'Marek Blaha'),
(58, 'Brno, Česko', '49.1950602', '16.606837100000007', 'Praha, Česko', '50.0755381', '14.43780049999998', 205.735, '2018-05-18 18:10:43', 'štafetový', 4, 'Peter Radvan');

-- --------------------------------------------------------

--
-- Table structure for table `trasa_pouzivatel`
--

CREATE TABLE `trasa_pouzivatel` (
  `id` int(11) NOT NULL,
  `id_pouzivatel` int(11) NOT NULL,
  `id_trasa` int(11) NOT NULL,
  `prejdene_km` int(11) NOT NULL,
  `aktivna_trasa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `trasa_pouzivatel`
--

INSERT INTO `trasa_pouzivatel` (`id`, `id_pouzivatel`, `id_trasa`, `prejdene_km`, `aktivna_trasa`) VALUES
(7, 4, 55, 0, 0),
(8, 4, 56, 140, 0),
(9, 5, 56, 0, 0),
(10, 6, 56, 0, 0),
(11, 7, 56, 0, 0),
(12, 8, 57, 20, 0),
(13, 4, 58, 0, 0),
(14, 8, 58, 0, 0),
(15, 9, 58, 0, 1),
(16, 10, 58, 0, 0),
(17, 11, 58, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `trasa_tim`
--

CREATE TABLE `trasa_tim` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_tim` int(11) NOT NULL,
  `id_trasa` int(11) NOT NULL,
  `odbehnute_km` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trasa_tim`
--

INSERT INTO `trasa_tim` (`id`, `id_tim`, `id_trasa`, `odbehnute_km`) VALUES
(1, 1, 58, 20);

-- --------------------------------------------------------

--
-- Table structure for table `trening`
--

CREATE TABLE `trening` (
  `id` int(11) NOT NULL,
  `id_trasa_pouzivatel` int(11) NOT NULL,
  `odbehnute_km` double NOT NULL,
  `den_treningu` date NOT NULL,
  `zaciatok_treningu` time NOT NULL,
  `koniec_treningu` time NOT NULL,
  `lat_trening` double NOT NULL,
  `lng_trening` double NOT NULL,
  `hodnotenie` int(11) NOT NULL,
  `poznamka` varchar(2000) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `trening`
--

INSERT INTO `trening` (`id`, `id_trasa_pouzivatel`, `odbehnute_km`, `den_treningu`, `zaciatok_treningu`, `koniec_treningu`, `lat_trening`, `lng_trening`, `hodnotenie`, `poznamka`) VALUES
(1, 7, 0, '2018-05-16', '11:33:10', '20:18:07', 15.11, 41.11, 1, 'Totalny trening'),
(2, 8, 0, '2020-02-02', '01:01:00', '02:01:00', 4, 6, 2, 'as15'),
(3, 8, 0, '2018-01-01', '00:00:00', '01:00:00', 1, 3, 4, 'malaga'),
(4, 7, 0, '2019-01-01', '00:01:00', '02:04:00', 14, 16, 5, 'Bratislava'),
(5, 7, 0, '2020-01-01', '00:00:00', '01:01:00', 2, 4, 3, 'hata pata'),
(6, 8, 40, '2018-01-01', '00:00:00', '01:01:00', 1, 3, 5, 'na hovno'),
(7, 8, 100, '2018-01-02', '01:01:00', '02:02:00', 1, 2, 3, 'stale na hovno'),
(8, 12, 20, '2018-01-01', '00:00:00', '01:01:00', 1, 2, 2, 'prvy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktuality`
--
ALTER TABLE `aktuality`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pouzivatelia`
--
ALTER TABLE `pouzivatelia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tim`
--
ALTER TABLE `tim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trasa`
--
ALTER TABLE `trasa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trasa_pouzivatel`
--
ALTER TABLE `trasa_pouzivatel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trasa_tim`
--
ALTER TABLE `trasa_tim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trening`
--
ALTER TABLE `trening`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_trasa_pouzivatel` (`id_trasa_pouzivatel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktuality`
--
ALTER TABLE `aktuality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pouzivatelia`
--
ALTER TABLE `pouzivatelia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tim`
--
ALTER TABLE `tim`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trasa`
--
ALTER TABLE `trasa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `trasa_pouzivatel`
--
ALTER TABLE `trasa_pouzivatel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `trasa_tim`
--
ALTER TABLE `trasa_tim`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trening`
--
ALTER TABLE `trening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `trening`
--
ALTER TABLE `trening`
  ADD CONSTRAINT `trening_ibfk_1` FOREIGN KEY (`id_trasa_pouzivatel`) REFERENCES `trasa_pouzivatel` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
