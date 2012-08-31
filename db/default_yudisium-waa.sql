-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 30. Agustus 2012 jam 11:41
-- Versi Server: 5.5.16
-- Versi PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sisfoft`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `default_yudisium`
--

CREATE TABLE IF NOT EXISTS `default_yudisium` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `date_in` datetime DEFAULT NULL,
  `nim` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `department` int(11) NOT NULL,
  `pa` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `place_of_birth` varchar(35) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `date_of_birth` date DEFAULT NULL,
  `religion` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sex` enum('L','P') COLLATE utf8_unicode_ci DEFAULT 'L',
  `meriage` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parrent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parrent_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parrental` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `soo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `school` enum('SMA','SMK','DIII','MAN DLL') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'SMA',
  `school_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sma` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graduation` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `sks` int(11) NOT NULL,
  `ipk` double(3,2) NOT NULL,
  `thesis` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `thesis_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lecture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `finish` date NOT NULL,
  `vacation` enum('0','1','2','3','4') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `yudisium_date` date NOT NULL,
  `phone` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `email` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `printed` enum('1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '2',
  `printed_repo` enum('1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '2',
  `antidatir` enum('0','1','2','3','4') COLLATE utf8_unicode_ci NOT NULL DEFAULT '2',
  `records` enum('1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  KEY `department` (`department`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='yudisium' AUTO_INCREMENT=270 ;

--
-- Dumping data untuk tabel `default_yudisium`
--

INSERT INTO `default_yudisium` (`id`, `date`, `date_in`, `nim`, `name`, `department`, `pa`, `place_of_birth`, `date_of_birth`, `religion`, `sex`, `meriage`, `address`, `parrent`, `parrent_address`, `parrental`, `soo`, `school`, `school_address`, `sma`, `graduation`, `sks`, `ipk`, `thesis`, `thesis_title`, `lecture`, `start`, `finish`, `vacation`, `yudisium_date`, `phone`, `status`, `email`, `printed`, `printed_repo`, `antidatir`, `records`) VALUES
(17, '2012-07-09 04:56:38', '0000-00-00 00:00:00', '09519131006', 'Ksaktiana Marantika', 8, '198', 'BOYOLALI', '1991-10-01', '3', 'P', 'Belum Kawin', 'TEGAL ARUM 07/02, BENDAN, BANYUDONO, BOYOLALI, JAWA TENGAH', 'HARTONO', 'TEGAL ARUM 07/02, BENDAN, BANYUDONO, BOYOLALI, JAWA TENGAH', 'UTUL', 'SMK NEGERI 4 SURAKARTA', 'SMK', 'JL. ADISUCIPTO 40 SURAKARTA', '0', '2012-05-03', 114, 3.44, 'D3', 'TATA RIAS KARAKTER TOKOH ANASTASIA DALAM DONGENG CINDERELA PADA PERGELARAN FAIRY TALES OF FANTASY', '104', '2012-03-17', '2012-05-03', '0', '2012-07-26', '085642103250', '1', 'ksaktianamarantika@yahoo.co.id', '1', '1', '2', '1'),
(46, '2012-07-10 04:51:04', '0000-00-00 00:00:00', '06511241027', 'Marlia Nurcahyati', 16, '109', 'Bantul', '1987-03-21', '1', 'P', 'Belum Kawin', 'Kasongan Rt. 04 Bangunjiwa Kasihan Bantul  Yogyakarta 55184', 'Warjimin', 'Kasongan Rt. 04 Bangunjiwa Kasihan Bantul  Yogyakarta 55184', 'UTUL', 'SMAN 10 Yogyakarta', 'SMA', 'Jalan Gadean No.5 Ngupasan Yogyakarta', 'IPS', '2012-06-14', 144, 3.17, 'Skripsi', 'Meningkatkan Prestasi Belajar Pengolahan Makanan Kontinental Melalui Penerapan Metode Make A Match pada Siswa Kelas X di SMK BOPKRI 2 Yogyakarta', '140', '2012-02-01', '2012-06-14', '0', '2012-07-26', '083840015908', '1', 'marlianurcahyati@gmail.com', '1', '2', '2', '1');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `default_yudisium`
--
ALTER TABLE `default_yudisium`
  ADD CONSTRAINT `default_yudisium_ibfk_1` FOREIGN KEY (`department`) REFERENCES `default_department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
