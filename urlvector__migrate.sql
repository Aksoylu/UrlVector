-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 08 Şub 2022, 18:31:32
-- Sunucu sürümü: 10.4.17-MariaDB
-- PHP Sürümü: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `urlvector`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urls`
--

CREATE TABLE `urls` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `issuing_date` datetime NOT NULL,
  `password` varchar(32) NOT NULL,
  `navigation_url` varchar(128) NOT NULL,
  `navigation_delay` int(11) NOT NULL,
  `navigation_text` varchar(150) NOT NULL,
  `is_intranet_domain` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urls`
--

INSERT INTO `urls` (`id`, `name`, `issuing_date`, `password`, `navigation_url`, `navigation_delay`, `navigation_text`, `is_intranet_domain`) VALUES
(1, 'aksoylu', '2022-02-06 10:58:20', '4c56ff4ce4aaf9573aa5dff913df997a', 'http://umit.space', 3, 'Ümit Aksoylu\'s Personal Website and Blog', 0),
(2, 'google', '2022-02-06 10:58:20', '4c56ff4ce4aaf9573aa5dff913df997a', 'http://google.com', 0, '', 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `urls`
--
ALTER TABLE `urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
