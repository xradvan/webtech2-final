-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Pi 18.Máj 2018, 14:55
-- Verzia serveru: 10.1.32-MariaDB
-- Verzia PHP: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `webtech2_final`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `aktuality`
--

CREATE TABLE `aktuality` (
  `id` int(11) NOT NULL,
  `titulok` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `obsah` varchar(500) COLLATE utf8_slovak_ci NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `aktuality`
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
-- Štruktúra tabuľky pre tabuľku `pouzivatelia`
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
  `nazovtimu` varchar(50) COLLATE utf8_slovak_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `pouzivatelia`
--

INSERT INTO `pouzivatelia` (`id`, `meno`, `priezvisko`, `email`, `heslo`, `stredna_skola`, `stredna_skola_adresa`, `ulica`, `psc`, `obec`, `rola`, `odoberatel`, `prve_prihlasenie`, `nazovtimu`) VALUES
(4, 'Peter', 'Radvan', 'peterradvan@gmail.com', '$2y$10$Wlyw5xYwJsQfm/rd7N9msecqHdMSeLAwGnmoCCgvxfcaEfrLXtdDG', 'GCM', 'Farska 10, Nitra', 'Lipova 19', '95193', 'Topolcianky', 'admin', 0, 0, 'Trpaslíci'),
(8, 'Marek', 'Blaha', 'blaha.marcus@gmail.com', '$2y$10$Wlyw5xYwJsQfm/rd7N9msecqHdMSeLAwGnmoCCgvxfcaEfrLXtdDG', 'GSM', 'Nizna revuca 36', 'nizna revuca 36', '034 74', 'Liptovske Revuce', 'user', 0, 0, 'Trpaslíci'),
(9, 'Marcel', 'Boldiš', 'marcelboldis@gmail.com', '$2y$10$Wlyw5xYwJsQfm/rd7N9msecqHdMSeLAwGnmoCCgvxfcaEfrLXtdDG', 'Gymnázium Vráble', 'Vráble', 'Veľké Vozokany', '95182', 'Veľké Vozokany', 'user', 0, 0, 'Elfovia'),
(10, 'Nika', 'Čarnogurská', 'nika@gmail.com', '$2y$10$Wlyw5xYwJsQfm/rd7N9msecqHdMSeLAwGnmoCCgvxfcaEfrLXtdDG', 'Topolčany', 'Topolčany', 'Topolčany', '596', 'Topolčany', 'user', 0, 0, 'Ľudia'),
(11, 'Matúš', 'Bubelíny', 'matus@gmail.com', '$2y$10$Wlyw5xYwJsQfm/rd7N9msecqHdMSeLAwGnmoCCgvxfcaEfrLXtdDG', 'Brezno', 'Brezno', 'Brezno', '9535', 'Brezno', 'admin', 0, 0, 'Hobiti');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `trasa`
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
-- Sťahujem dáta pre tabuľku `trasa`
--

INSERT INTO `trasa` (`id`, `start_nazov`, `start_lat`, `start_long`, `ciel_nazov`, `ciel_lat`, `ciel_long`, `celkove_km`, `datum_vytvorenia`, `mod_trasy`, `id_user`, `vytvoril`) VALUES
(55, 'Bratislava, Slovensko', '48.1485965', '17.10774779999997', 'Košice, Slovensko', '48.7163857', '21.26107460000003', 403.63, '2018-05-17 23:00:52', 'privátny', 4, 'Peter Radvan'),
(56, 'Málaga, Španielsko', '36.721261', '-4.421265500000004', 'Madrid, Španielsko', '40.4167754', '-3.7037901999999576', 529.388, '2018-05-17 23:01:43', 'verejný', 4, 'Peter Radvan');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `trasa_pouzivatel`
--

CREATE TABLE `trasa_pouzivatel` (
  `id` int(11) NOT NULL,
  `id_pouzivatel` int(11) NOT NULL,
  `id_trasa` int(11) NOT NULL,
  `prejdene_km` int(11) NOT NULL,
  `aktivna_trasa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `trasa_pouzivatel`
--

INSERT INTO `trasa_pouzivatel` (`id`, `id_pouzivatel`, `id_trasa`, `prejdene_km`, `aktivna_trasa`) VALUES
(7, 4, 55, 0, 0),
(8, 4, 56, 0, 0),
(9, 5, 56, 0, 0),
(10, 6, 56, 0, 0),
(11, 7, 56, 0, 0);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `aktuality`
--
ALTER TABLE `aktuality`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `pouzivatelia`
--
ALTER TABLE `pouzivatelia`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `trasa`
--
ALTER TABLE `trasa`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `trasa_pouzivatel`
--
ALTER TABLE `trasa_pouzivatel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `aktuality`
--
ALTER TABLE `aktuality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pre tabuľku `pouzivatelia`
--
ALTER TABLE `pouzivatelia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pre tabuľku `trasa`
--
ALTER TABLE `trasa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pre tabuľku `trasa_pouzivatel`
--
ALTER TABLE `trasa_pouzivatel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
