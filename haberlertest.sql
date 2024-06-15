-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 13 Haz 2024, 15:36:04
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `haberlertest`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `haberler`
--

CREATE TABLE `haberler` (
  `id` int(10) NOT NULL,
  `title` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `image_url` varchar(300) NOT NULL,
  `publish_date` date NOT NULL,
  `author` varchar(30) NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `kategori_id` int(11) NOT NULL,
  `kategori_adi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`kategori_id`, `kategori_adi`) VALUES
(1, 'EKONOMİ'),
(4, 'GÜNDEM'),
(5, 'MAGAZİN'),
(2, 'SİYASET'),
(3, 'SPOR');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `kullaniciID` int(11) NOT NULL,
  `kullaniciAdi` varchar(65) NOT NULL,
  `mail` varchar(65) NOT NULL,
  `accountState` varchar(10) NOT NULL,
  `password` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`kullaniciID`, `kullaniciAdi`, `mail`, `accountState`, `password`) VALUES
(30, 'hasko', 'hasko@outlook.com', 'yazar', '$2y$10$qT/Tdvu.7xVqKVNIoaPO8uSfBBi2Z6rzom5Gmyjkx623tlc4BVyYe'),
(47, 'omeromer', 'omeromer@yandex.com', 'admin', '$2y$10$rkECW/baIBTZTEuJNI6WxekF/osviOBshIhPvB1BMcv4VZ08rEUiu'),
(48, 'admin', 'admin@testadmin.com', 'admin', '$2y$10$KbDTrR.sHW2/u06NJMUCkOfcZBbJTSy1GCQBJRay9Ayq81uyfDwuW');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `manset`
--

CREATE TABLE `manset` (
  `mansetId` int(11) NOT NULL,
  `haberID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `manset`
--

INSERT INTO `manset` (`mansetId`, `haberID`) VALUES
(1, NULL),
(2, NULL),
(3, NULL),
(4, NULL),
(5, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesajlar`
--

CREATE TABLE `mesajlar` (
  `mesaj_id` int(11) NOT NULL,
  `isim` varchar(100) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `konu` varchar(150) NOT NULL,
  `mesaj` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `yorum_id` int(10) NOT NULL,
  `yorum_author` varchar(50) NOT NULL,
  `yorum_content` text NOT NULL,
  `haber_id` int(10) NOT NULL,
  `onaylı` varchar(10) DEFAULT NULL,
  `yorum_tarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `haberler`
--
ALTER TABLE `haberler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`),
  ADD KEY `kategori` (`kategori`);

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`kategori_id`),
  ADD UNIQUE KEY `kategori_adi` (`kategori_adi`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`kullaniciID`),
  ADD UNIQUE KEY `kullaniciAdi` (`kullaniciAdi`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Tablo için indeksler `manset`
--
ALTER TABLE `manset`
  ADD PRIMARY KEY (`mansetId`),
  ADD KEY `haberID` (`haberID`);

--
-- Tablo için indeksler `mesajlar`
--
ALTER TABLE `mesajlar`
  ADD PRIMARY KEY (`mesaj_id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`yorum_id`),
  ADD KEY `haber_id` (`haber_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `haberler`
--
ALTER TABLE `haberler`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `kullaniciID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Tablo için AUTO_INCREMENT değeri `manset`
--
ALTER TABLE `manset`
  MODIFY `mansetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `mesajlar`
--
ALTER TABLE `mesajlar`
  MODIFY `mesaj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `yorum_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `haberler`
--
ALTER TABLE `haberler`
  ADD CONSTRAINT `haberler_ibfk_1` FOREIGN KEY (`author`) REFERENCES `kullanicilar` (`kullaniciAdi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `haberler_ibfk_2` FOREIGN KEY (`kategori`) REFERENCES `kategoriler` (`kategori_adi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `manset`
--
ALTER TABLE `manset`
  ADD CONSTRAINT `manset_ibfk_1` FOREIGN KEY (`haberID`) REFERENCES `haberler` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD CONSTRAINT `yorumlar_ibfk_1` FOREIGN KEY (`haber_id`) REFERENCES `haberler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
