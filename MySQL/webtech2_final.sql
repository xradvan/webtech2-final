-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2018 at 07:59 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `pouzivatelia`
--

CREATE TABLE `pouzivatelia` (
  `id` int(11) NOT NULL,
  `meno` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `priezvisko` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_slovak_ci NOT NULL,
  `stredna_skola` varchar(40) COLLATE utf8_slovak_ci NOT NULL,
  `stredna_skola_adresa` varchar(60) COLLATE utf8_slovak_ci NOT NULL,
  `ulica` varchar(40) COLLATE utf8_slovak_ci NOT NULL,
  `psc` varchar(10) COLLATE utf8_slovak_ci NOT NULL,
  `obec` varchar(40) COLLATE utf8_slovak_ci NOT NULL,
  `rola` varchar(10) COLLATE utf8_slovak_ci NOT NULL DEFAULT 'user'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `pouzivatelia`
--

INSERT INTO `pouzivatelia` (`id`, `meno`, `priezvisko`, `email`, `stredna_skola`, `stredna_skola_adresa`, `ulica`, `psc`, `obec`, `rola`) VALUES
(1, 'Petor', 'Retvar', 'petorko@gmail.com', 'GCM', 'Farska 10', 'Lipova', '95193', 'TPK', 'user'),
(2, 'Marcel', 'Boldis', 'marcelko@pekny.sk', 'Nedokoncena', 'Gymnazium Vrable', 'Skolska', '84321', 'Vozokany', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pouzivatelia`
--
ALTER TABLE `pouzivatelia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pouzivatelia`
--
ALTER TABLE `pouzivatelia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
