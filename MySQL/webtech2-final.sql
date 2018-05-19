-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: So 19.Máj 2018, 16:55
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
-- Databáza: `webtech2-final`
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
  `id_timu` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `pouzivatelia`
--

INSERT INTO `pouzivatelia` (`id`, `meno`, `priezvisko`, `email`, `heslo`, `stredna_skola`, `stredna_skola_adresa`, `ulica`, `psc`, `obec`, `rola`, `odoberatel`, `prve_prihlasenie`, `id_timu`) VALUES
(4, 'Peter', 'Radvan', 'peterradvan@gmail.com', '$2y$10$Wlyw5xYwJsQfm/rd7N9msecqHdMSeLAwGnmoCCgvxfcaEfrLXtdDG', 'GCM', 'Farska 10, Nitra', 'Lipova 19', '95193', 'Topolcianky', 'admin', 0, 0, 1),
(8, 'Marek', 'Blaha', 'blaha.marcus@gmail.com', '$2y$10$Wlyw5xYwJsQfm/rd7N9msecqHdMSeLAwGnmoCCgvxfcaEfrLXtdDG', 'GSM', 'Nizna revuca 36', 'nizna revuca 36', '034 74', 'Liptovske Revuce', 'user', 0, 0, 1),
(9, 'Marcel', 'Boldiš', 'marcelboldis@gmail.com', '$2y$10$Wlyw5xYwJsQfm/rd7N9msecqHdMSeLAwGnmoCCgvxfcaEfrLXtdDG', 'Gymnázium Vráble', 'Vráble', 'Veľké Vozokany', '95182', 'Veľké Vozokany', 'user', 0, 0, 0),
(10, 'Nika', 'Čarnogurská', 'nika@gmail.com', '$2y$10$Wlyw5xYwJsQfm/rd7N9msecqHdMSeLAwGnmoCCgvxfcaEfrLXtdDG', 'Topolčany', 'Topolčany', 'Topolčany', '596', 'Topolčany', 'user', 0, 0, 0),
(11, 'Matúš', 'Bubelíny', 'matus@gmail.com', '$2y$10$Wlyw5xYwJsQfm/rd7N9msecqHdMSeLAwGnmoCCgvxfcaEfrLXtdDG', 'Brezno', 'Brezno', 'Brezno', '9535', 'Brezno', 'admin', 0, 0, 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tim`
--

CREATE TABLE `tim` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazov` varchar(50) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `tim`
--

INSERT INTO `tim` (`id`, `nazov`) VALUES
(1, 'tim'),
(2, 'hovno'),
(3, 'tri');

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
(63, 'Bratislava, Slovensko', '48.1485965', '17.10774779999997', 'Košice, Slovensko', '48.7163857', '21.26107460000003', 403.63, '2018-05-18 19:08:45', 'privátny', 4, 'Peter Radvan'),
(64, 'Severná Kórea', '40.339852', '127.51009299999998', 'Pchjongjang, Severná Kórea', '39.0392193', '125.76252410000006', 354.397, '2018-05-18 19:09:02', 'verejný', 4, 'Peter Radvan'),
(65, 'Vancouver, Britská Kolumbia, Kanada', '49.2827291', '-123.12073750000002', 'Toronto, Ontário, Kanada', '43.653226', '-79.38318429999998', 4382.303, '2018-05-18 19:09:38', 'štafetový', 4, 'Peter Radvan'),
(66, 'Štokholm, Švédsko', '59.32932349999999', '18.068580800000063', 'Helsinki, Fínsko', '60.16985569999999', '24.93837910000002', 484.309, '2018-05-18 23:35:07', 'štafetový', 4, 'Peter Radvan'),
(67, 'Madrid, Španielsko', '40.4167754', '-3.7037901999999576', 'Barcelona, Španielsko', '41.38506389999999', '2.1734034999999494', 624.627, '2018-05-18 23:35:58', 'štafetový', 4, 'Peter Radvan'),
(68, 'Madrid, Španielsko', '40.4167754', '-3.7037901999999576', 'Barcelona, Španielsko', '41.38506389999999', '2.1734034999999494', 624.627, '2018-05-18 23:36:40', 'štafetový', 4, 'Peter Radvan'),
(69, 'Martin, Slovensko', '49.06166129999999', '18.91902349999998', 'Púchov, Slovensko', '49.12356539999999', '18.324120300000004', 81.574, '2018-05-18 23:38:11', 'štafetový', 4, 'Peter Radvan'),
(70, 'Hovnorsbacken, Djurhamn, Švédsko', '59.28617029999999', '18.65284810000003', 'Hovnoret, Švédsko', '59.291667', '18.66388900000004', 1.337, '2018-05-19 01:42:58', 'privátny', 4, 'Peter Radvan'),
(71, 'Uzbekistan', '41.377491', '64.58526200000006', 'Kazachstan', '48.019573', '66.92368399999998', 1599.058, '2018-05-19 14:19:31', 'štafetový', 4, 'Peter Radvan');

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
(24, 4, 63, 136, 1),
(25, 4, 64, 200, 0),
(26, 8, 64, 0, 0),
(27, 9, 64, 0, 0),
(28, 10, 64, 0, 0),
(29, 11, 64, 0, 0),
(30, 4, 65, 1570, 0),
(31, 8, 65, 150, 0),
(32, 4, 66, 0, 0),
(33, 8, 66, 0, 0),
(34, 4, 67, 0, 0),
(35, 8, 67, 0, 0),
(36, 4, 68, 0, 0),
(37, 8, 68, 0, 0),
(38, 4, 69, 120, 0),
(39, 8, 69, 0, 0),
(40, 4, 70, 1, 0),
(41, 4, 71, 1100, 0),
(42, 8, 71, 0, 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `trasa_tim`
--

CREATE TABLE `trasa_tim` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_tim` int(11) NOT NULL,
  `id_trasa` int(11) NOT NULL,
  `odbehnute_km` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `trasa_tim`
--

INSERT INTO `trasa_tim` (`id`, `id_tim`, `id_trasa`, `odbehnute_km`) VALUES
(2, 1, 68, 0),
(3, 2, 68, 0),
(4, 3, 68, 0),
(5, 1, 69, 120),
(6, 2, 69, 0),
(7, 3, 69, 0),
(8, 1, 71, 1100),
(9, 2, 71, 0),
(10, 3, 71, 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `trening`
--

CREATE TABLE `trening` (
  `id` int(11) NOT NULL,
  `id_trasa_pouzivatel` int(11) NOT NULL,
  `odbehnute_km` double NOT NULL,
  `den_treningu` date DEFAULT NULL,
  `zaciatok_treningu` time DEFAULT NULL,
  `koniec_treningu` time DEFAULT NULL,
  `lat_trening` double DEFAULT NULL,
  `lng_trening` double DEFAULT NULL,
  `hodnotenie` int(11) DEFAULT NULL,
  `poznamka` varchar(2000) COLLATE utf8_slovak_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `trening`
--

INSERT INTO `trening` (`id`, `id_trasa_pouzivatel`, `odbehnute_km`, `den_treningu`, `zaciatok_treningu`, `koniec_treningu`, `lat_trening`, `lng_trening`, `hodnotenie`, `poznamka`) VALUES
(9, 24, 20, '2018-01-01', '00:00:00', '00:01:00', 1, 2, 2, 'poznamka'),
(10, 24, 100, '2018-01-01', '00:00:00', '00:01:00', 1, 2, 2, 'sadsa'),
(15, 25, 100, '2000-01-01', '00:00:00', '00:01:00', 1, 2, 2, 'asd'),
(16, 25, 100, '2000-01-01', '00:00:00', '00:01:00', 1, 2, 2, 'asd'),
(17, 30, 150, '2018-01-01', '00:00:00', '00:00:00', 1, 1, 2, 'as'),
(18, 30, 100, '2018-01-01', '00:00:00', '00:01:00', 1, 2, 2, 'sa'),
(19, 30, 250, '2018-01-01', '00:00:00', '00:00:00', 1, 2, 1, 'sa'),
(20, 30, 250, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0'),
(21, 30, 250, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0'),
(22, 30, 250, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0'),
(23, 30, 50, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0'),
(24, 30, 50, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0'),
(25, 30, 50, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0'),
(26, 30, 50, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0'),
(27, 30, 50, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0'),
(28, 38, 30, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0'),
(29, 38, 30, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0'),
(30, 38, 30, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0'),
(31, 38, 30, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0'),
(32, 24, 16, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0'),
(33, 30, 20, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0'),
(34, 40, 5, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0'),
(35, 30, 50, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0'),
(36, 41, 100, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0'),
(37, 41, 1000, '0000-00-00', '00:00:00', '00:00:00', 0, 0, 1, '0');

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
-- Indexy pre tabuľku `tim`
--
ALTER TABLE `tim`
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
-- Indexy pre tabuľku `trasa_tim`
--
ALTER TABLE `trasa_tim`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `trening`
--
ALTER TABLE `trening`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_trasa_pouzivatel` (`id_trasa_pouzivatel`);

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
-- AUTO_INCREMENT pre tabuľku `tim`
--
ALTER TABLE `tim`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pre tabuľku `trasa`
--
ALTER TABLE `trasa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pre tabuľku `trasa_pouzivatel`
--
ALTER TABLE `trasa_pouzivatel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pre tabuľku `trasa_tim`
--
ALTER TABLE `trasa_tim`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pre tabuľku `trening`
--
ALTER TABLE `trening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `trening`
--
ALTER TABLE `trening`
  ADD CONSTRAINT `trening_ibfk_1` FOREIGN KEY (`id_trasa_pouzivatel`) REFERENCES `trasa_pouzivatel` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
