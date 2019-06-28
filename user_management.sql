-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: mariadb
-- Üretim Zamanı: 27 Haz 2019, 09:59:13
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
-- Veritabanı: `user_management`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `realname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `last_login_ip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) DEFAULT 0,
  `token` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `realname`, `last_login_date`, `last_login_ip`, `level`, `token`) VALUES
(1, 'admin', '$2y$10$GwSPNnrYIVmGGhymZ23/seBbuSc052lHWBENKI6QSkjsSI3AFEtdW', 'Admin User', '2019-06-27 12:47:27', '172.28.0.1', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE1NjE2Mjg4NDcsImV4cCI6MTU2MTYzMDY0NywianRpIjoiNHJTVUlMMGoxZ1huSW5hYit2VFZtUT09IiwiaXNzIjoiaHR0cHM6XC9cL2Rldi5zaW5hbnR1cmd1dC5jb20udHIiLCJzdWIiOiJhZG1pbiJ9.B-9x3NWym2WN5TJKJLCx3nMcUVuEs9r2V-eRxNzqkuA'),
(2, 'user', '$2y$10$GwSPNnrYIVmGGhymZ23/seBbuSc052lHWBENKI6QSkjsSI3AFEtdW', 'John Doe', NULL, NULL, 0, NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
