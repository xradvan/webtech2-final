-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2018 at 02:41 PM
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
-- Database: `webtech2_final`
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
  `odoberatel` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `pouzivatelia`
--

INSERT INTO `pouzivatelia` (`id`, `meno`, `priezvisko`, `email`, `heslo`, `stredna_skola`, `stredna_skola_adresa`, `ulica`, `psc`, `obec`, `rola`, `odoberatel`) VALUES
(5, 'Marek', 'Blaha', 'blaha.marcus@gmail.com', '$2y$10$NyDMP1WJtI.xAasNonHgGO2BY2HjefsbnG11.AUpSc2XK1EF9BPea', 'GYM', 'Štefana Moyzesa 21, 034 01, Ružomberok', 'Nizna Revuca, 36', '03474', 'Liptovske Revuce', 'user', 0),
(4, 'Peter', 'Radvan', 'peterradvan@gmail.com', '$2y$10$Wlyw5xYwJsQfm/rd7N9msecqHdMSeLAwGnmoCCgvxfcaEfrLXtdDG', 'GCM', 'Farska 10, Nitra', 'Lipova 19', '95193', 'Topolcianky', 'admin', 0),
(6, 'Matus', 'Bubeliny', 'matusbubeliny@gmail.com', '1234', 'Gym', 'Sturova 13', 'Sturova 13', '977 03', 'Brezno', 'user', 1),
(7, 'Nika', 'Carno', 'carnogurska.n@gmail.com', '1234', 'fdbhsjnklô', 'fjdklwm', 'gjnwmkôl', '97777', 'bjhdwnsqklmô', 'user', 1);

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
  `prejdene_km` double NOT NULL,
  `celkove_km` double NOT NULL,
  `aktivna_trasa` tinyint(1) NOT NULL,
  `datum_vytvorenia` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

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
-- Indexes for table `trasa`
--
ALTER TABLE `trasa`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trasa`
--
ALTER TABLE `trasa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE `zoznamtimov` (
  `id` int(10) UNSIGNED NOT NULL,
  `idUzivatela` int(11) NOT NULL,
  `nazovTimu` varchar(40) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `zoznamtimov`
--

INSERT INTO `zoznamtimov` (`id`, `idUzivatela`, `nazovTimu`) VALUES
(31, 1, 'krtkovia'),
(32, 2, 'krtkovia'),
(34, 5, 'krtkovia'),
(42, 4, 'tim'),
(43, 1, 'tim'),
(44, 2, 'tim'),
(46, 4, 'Team'),
(47, 1, 'Team');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `zoznamtimov`
--
ALTER TABLE `zoznamtimov`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `zoznamtimov`
--
ALTER TABLE `zoznamtimov`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
