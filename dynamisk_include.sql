-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Vært: 127.0.0.1
-- Genereringstid: 02. 10 2016 kl. 16:33:48
-- Serverversion: 10.1.10-MariaDB
-- PHP-version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dynamisk_include`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `sider`
--

CREATE TABLE `sider` (
  `side_id` smallint(5) UNSIGNED NOT NULL,
  `side_url_navn` varchar(50) COLLATE utf8_danish_ci NOT NULL,
  `side_titel` varchar(50) COLLATE utf8_danish_ci NOT NULL,
  `side_text` text COLLATE utf8_danish_ci,
  `side_include_fil` varchar(50) COLLATE utf8_danish_ci DEFAULT NULL,
  `side_vis_i_menu` tinyint(1) UNSIGNED NOT NULL COMMENT '0=Nej, 1=Ja',
  `side_status` tinyint(1) UNSIGNED NOT NULL COMMENT '0=Inaktiv, 1=Aktiv'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Data dump for tabellen `sider`
--

INSERT INTO `sider` (`side_id`, `side_url_navn`, `side_titel`, `side_text`, `side_include_fil`, `side_vis_i_menu`, `side_status`) VALUES
(1, '', 'Forside', 'Forside tekst...', NULL, 1, 1),
(2, 'garanti', 'Garanti', 'Garanti tekst her...', NULL, 1, 1),
(3, 'kontakt', 'Kontakt', 'Kontakt tekst her...', 'kontakt.php', 1, 1);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `sider`
--
ALTER TABLE `sider`
  ADD PRIMARY KEY (`side_id`),
  ADD UNIQUE KEY `side_url_navn` (`side_url_navn`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `sider`
--
ALTER TABLE `sider`
  MODIFY `side_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
