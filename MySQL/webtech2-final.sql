-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Út 15.Máj 2018, 21:47
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
(18, 'mxcmx cmxc', 'x cmxc mxc xm', '2018-05-15'),
(19, 'zxcnxjncc', 'knckxcnkxnc', '2018-05-15'),
(20, 'jxnvjcvnc', 'xncxkvnxk', '2018-05-15');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `pouzivatelia`
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
-- Sťahujem dáta pre tabuľku `pouzivatelia`
--

INSERT INTO `pouzivatelia` (`id`, `meno`, `priezvisko`, `email`, `stredna_skola`, `stredna_skola_adresa`, `ulica`, `psc`, `obec`, `rola`) VALUES
(1, 'Petor', 'Retvar', 'petorko@gmail.com', 'GCM', 'Farska 10', 'Lipova', '95193', 'TPK', 'user'),
(2, 'Marcel', 'Boldis', 'marcelko@pekny.sk', 'Nedokoncena', 'Gymnazium Vrable', 'Skolska', '84321', 'Vozokany', 'admin'),
(3, 'Nikola', 'Carnogurska', 'carnogurska.n@gmail.com', 'sjbjksandsa', 'zcnkxzc', 'dnckxcnx', '95625', 'Topolcany', 'user');

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
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `aktuality`
--
ALTER TABLE `aktuality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pre tabuľku `pouzivatelia`
--
ALTER TABLE `pouzivatelia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
