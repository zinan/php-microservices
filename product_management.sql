-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: mariadb
-- Üretim Zamanı: 27 Haz 2019, 09:59:08
-- Sunucu sürümü: 10.4.6-MariaDB-1:10.4.6+maria~bionic
-- PHP Sürümü: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `product_management`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_category` int(10) UNSIGNED DEFAULT NULL,
  `product_summary` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_price` float UNSIGNED DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_category`, `product_summary`, `product_price`, `is_active`) VALUES
(1, 'Sample Product', 1, 'Sample Product', 10, 1),
(2, 'Sample New Product', 1, 'Hot Sale!!!', 99.9, 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
