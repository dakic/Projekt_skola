-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2014 at 08:59 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `skola_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `grupa`
--

CREATE TABLE IF NOT EXISTS `grupa` (
  `id_grupa` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `oznaka` varchar(10) NOT NULL,
  `cijena` decimal(18,2) NOT NULL,
  `id_smjer_fk` int(11) unsigned DEFAULT NULL,
  `max_br_pol` int(3) NOT NULL,
  `min_br_pol` int(3) NOT NULL,
  PRIMARY KEY (`id_grupa`),
  KEY `id_smjer_fk` (`id_smjer_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `grupa`
--

INSERT INTO `grupa` (`id_grupa`, `oznaka`, `cijena`, `id_smjer_fk`, `max_br_pol`, `min_br_pol`) VALUES
(9, 'JS1', '1000.00', 9, 10, 2),
(10, 'JS2', '2000.00', 9, 10, 2),
(11, 'PHP1', '3000.00', 10, 5, 2),
(12, 'DJ1', '4000.00', 11, 8, 1),
(13, 'DJ2', '5000.00', 11, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `id_korisnik` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `id_tip_korisnik_fk` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_korisnik`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id_korisnik`, `username`, `pass`, `id_tip_korisnik_fk`) VALUES
(1, 'Admin', '123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id_media` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  PRIMARY KEY (`id_media`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id_media`, `name`) VALUES
(7, 'file-874-slika1.jpg'),
(8, 'file-835-slika2.jpg'),
(9, 'file-454-slika3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `polaznik`
--

CREATE TABLE IF NOT EXISTS `polaznik` (
  `ID_polaznik` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `adresa` varchar(70) DEFAULT NULL,
  `oib` char(11) NOT NULL,
  `slika` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`ID_polaznik`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `polaznik`
--

INSERT INTO `polaznik` (`ID_polaznik`, `ime`, `prezime`, `adresa`, `oib`, `slika`) VALUES
(52, 'Ime1', 'Prezime1', 'Adresa1', '11111111111', NULL),
(53, 'Ime2', 'Prezime2', 'Adresa2', '22222222222', NULL),
(54, 'Ime3', 'Prezime3', 'Adresa3', '33333333333', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `polaznik_media`
--

CREATE TABLE IF NOT EXISTS `polaznik_media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_polaznik_fk` int(11) unsigned NOT NULL,
  `id_media_fk` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_polaznik_fk` (`id_polaznik_fk`),
  KEY `id_media_fk` (`id_media_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `polaznik_media`
--

INSERT INTO `polaznik_media` (`id`, `id_polaznik_fk`, `id_media_fk`) VALUES
(7, 52, 7),
(8, 53, 8),
(9, 54, 9);

-- --------------------------------------------------------

--
-- Table structure for table `smjer`
--

CREATE TABLE IF NOT EXISTS `smjer` (
  `id_smjer` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) NOT NULL,
  `ur_broj` varchar(50) NOT NULL,
  PRIMARY KEY (`id_smjer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `smjer`
--

INSERT INTO `smjer` (`id_smjer`, `naziv`, `ur_broj`) VALUES
(9, 'JavaScript', '123js'),
(10, 'php', '123php'),
(11, 'Django', '123dj');

-- --------------------------------------------------------

--
-- Table structure for table `upis`
--

CREATE TABLE IF NOT EXISTS `upis` (
  `id_polaznik_fk` int(11) unsigned NOT NULL,
  `id_grupa_fk` int(11) unsigned NOT NULL,
  `datum_upis` date NOT NULL,
  `iznos` decimal(18,2) NOT NULL,
  KEY `id_polaznik_fk` (`id_polaznik_fk`),
  KEY `id_grupa_pk` (`id_grupa_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `upis`
--

INSERT INTO `upis` (`id_polaznik_fk`, `id_grupa_fk`, `datum_upis`, `iznos`) VALUES
(52, 9, '2014-11-01', '1000.00'),
(53, 11, '2014-11-02', '2700.00'),
(53, 13, '2014-11-04', '4000.00'),
(54, 11, '2014-11-20', '2850.00'),
(54, 12, '2014-11-30', '3000.00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grupa`
--
ALTER TABLE `grupa`
  ADD CONSTRAINT `grupa_ibfk_1` FOREIGN KEY (`id_smjer_fk`) REFERENCES `smjer` (`id_smjer`);

--
-- Constraints for table `polaznik_media`
--
ALTER TABLE `polaznik_media`
  ADD CONSTRAINT `polaznik_media_ibfk_1` FOREIGN KEY (`id_polaznik_fk`) REFERENCES `polaznik` (`ID_polaznik`),
  ADD CONSTRAINT `polaznik_media_ibfk_2` FOREIGN KEY (`id_media_fk`) REFERENCES `media` (`id_media`);

--
-- Constraints for table `upis`
--
ALTER TABLE `upis`
  ADD CONSTRAINT `upis_ibfk_1` FOREIGN KEY (`id_polaznik_fk`) REFERENCES `polaznik` (`ID_polaznik`),
  ADD CONSTRAINT `upis_ibfk_2` FOREIGN KEY (`id_grupa_fk`) REFERENCES `grupa` (`id_grupa`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
