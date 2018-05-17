-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2018 at 02:51 PM
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
-- Table structure for table `zoznamtimov`
--

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
