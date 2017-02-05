-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 18 Sie 2013, 13:00
-- Wersja serwera: 5.5.32-MariaDB-log
-- Wersja PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `waxing`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wx_categories`
--

CREATE TABLE IF NOT EXISTS `wx_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(20) NOT NULL,
  `category_gender` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `wx_categories`
--

INSERT INTO `wx_categories` (`category_id`, `category_name`, `category_gender`) VALUES
(1, 'Kategoria1', 0),
(2, 'Kategoria2', 1),
(3, 'Kategoria3', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wx_clients`
--

CREATE TABLE IF NOT EXISTS `wx_clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(25) NOT NULL,
  `client_surname` varchar(25) NOT NULL,
  `client_gender` tinyint(1) NOT NULL DEFAULT '0',
  `client_foreigner` tinyint(1) NOT NULL DEFAULT '0',
  `client_doubled` tinyint(1) NOT NULL DEFAULT '0',
  `client_address` varchar(255) NOT NULL,
  `client_mail` varchar(25) DEFAULT NULL,
  `client_phone` int(20) NOT NULL,
  `client_number` mediumint(25) NOT NULL,
  `client_password` varchar(255) NOT NULL,
  `client_regdate` date NOT NULL,
  `client_points` mediumint(7) NOT NULL,
  `client_visit_count` tinyint(1) NOT NULL DEFAULT '0',
  `client_visit_sum` smallint(2) NOT NULL DEFAULT '0',
  `client_newsletter` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Zrzut danych tabeli `wx_clients`
--

INSERT INTO `wx_clients` (`client_id`, `client_name`, `client_surname`, `client_gender`, `client_foreigner`, `client_doubled`, `client_address`, `client_mail`, `client_phone`, `client_number`, `client_password`, `client_regdate`, `client_points`, `client_visit_count`, `client_visit_sum`, `client_newsletter`) VALUES
(1, 'Maria', 'Kowalska', 0, 0, 0, 'konwaliowa 5', 'doman18@tlen.pl', 777777777, 11, 'kowalska', '2013-07-23', 0, 1, 185, 1),
(2, 'Doman', 'Panda', 1, 0, 0, '', NULL, 0, 22, '', '0000-00-00', 0, 0, 0, 0),
(6, 'Maria', 'Kowalska', 0, 0, 1, '', NULL, 0, 222, '', '2013-07-23', 0, 0, 0, 0),
(7, 'Imie', 'Nazwisko', 0, 0, 0, '', NULL, 0, 667, '', '0000-00-00', 0, 0, 0, 0),
(8, 'ksionc', 'natanek', 1, 1, 0, '', 'doman180@gmail.com', 0, 0, '', '0000-00-00', 0, 0, 0, 1),
(9, 'kaka', 'natanek', 0, 0, 0, '', NULL, 0, 0, '', '0000-00-00', 0, 0, 0, 0),
(10, 'asdf', 'fdsasd', 1, 0, 0, '', NULL, 0, 1111111, '', '0000-00-00', 0, 0, 0, 0),
(16, 'Doman', 'Panda', 0, 0, 0, '', NULL, 0, 0, '', '2013-07-30', 0, 0, 0, 1),
(17, 'Dorotka', 'Siedmiogrodowa', 0, 0, 0, '', NULL, 0, 123123, '', '2013-07-31', 0, 0, 0, 0),
(18, 'Lolek', 'Lolkowski', 1, 0, 0, '', NULL, 0, 121212, '', '2013-07-31', 0, 0, 0, 0),
(19, 'Józef', 'Śmałków', 1, 0, 0, '', NULL, 0, 55555, '', '2013-07-31', 0, 0, 0, 0),
(20, 'Darek', 'Koparek', 0, 0, 0, '', NULL, 0, 0, '', '0000-00-00', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wx_client_notes`
--

CREATE TABLE IF NOT EXISTS `wx_client_notes` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `note_client` int(11) NOT NULL,
  `note_content` text NOT NULL,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `wx_client_notes`
--

INSERT INTO `wx_client_notes` (`note_id`, `note_client`, `note_content`) VALUES
(1, 16, 'ddfghfghggzmia'),
(2, 1, 'notatka marii'),
(3, 2, 'astasga');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wx_offers`
--

CREATE TABLE IF NOT EXISTS `wx_offers` (
  `offer_id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_name` varchar(25) NOT NULL,
  `offer_category` int(11) NOT NULL,
  `offer_price` smallint(4) NOT NULL,
  `offer_points` smallint(4) NOT NULL,
  `offer_points_price` smallint(4) NOT NULL,
  `offer_min_time` smallint(3) NOT NULL,
  `offer_max_time` smallint(3) NOT NULL,
  PRIMARY KEY (`offer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `wx_offers`
--

INSERT INTO `wx_offers` (`offer_id`, `offer_name`, `offer_category`, `offer_price`, `offer_points`, `offer_points_price`, `offer_min_time`, `offer_max_time`) VALUES
(4, 'Oferta 1 kategorii 1', 1, 100, 0, 0, 15, 20),
(5, 'Oferta 1 kategorii 2', 2, 150, 0, 0, 15, 20),
(6, 'Oferta 1 kategorii 3', 3, 70, 0, 0, 8, 15),
(7, 'Oferta 2 kategorii 2', 2, 50, 0, 0, 12, 18),
(8, 'Oferta 2 kategorii 1', 1, 85, 0, 0, 10, 15);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wx_procedures`
--

CREATE TABLE IF NOT EXISTS `wx_procedures` (
  `proced_id` int(11) NOT NULL AUTO_INCREMENT,
  `proced_visit` int(11) NOT NULL,
  `proced_offer` int(11) NOT NULL,
  `proced_offer_n` varchar(30) NOT NULL,
  `proced_change` tinyint(4) NOT NULL,
  PRIMARY KEY (`proced_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `wx_procedures`
--

INSERT INTO `wx_procedures` (`proced_id`, `proced_visit`, `proced_offer`, `proced_offer_n`, `proced_change`) VALUES
(5, 11, 5, 'Oferta 1 kategorii 2', 1),
(6, 12, 4, 'Oferta 1 kategorii 1', 2),
(7, 12, 6, 'Oferta 1 kategorii 3', 1),
(8, 12, 8, 'Oferta 2 kategorii 1', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wx_salons`
--

CREATE TABLE IF NOT EXISTS `wx_salons` (
  `salon_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `salon_name` varchar(20) NOT NULL,
  PRIMARY KEY (`salon_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `wx_salons`
--

INSERT INTO `wx_salons` (`salon_id`, `salon_name`) VALUES
(1, 'Ursynów'),
(2, 'Centrum');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wx_smtp_sett`
--

CREATE TABLE IF NOT EXISTS `wx_smtp_sett` (
  `smtp_id` int(2) NOT NULL AUTO_INCREMENT,
  `smtp_user` varchar(35) NOT NULL,
  `smtp_pass` varchar(25) NOT NULL,
  `smtp_host` varchar(15) NOT NULL,
  `smtp_port` smallint(6) NOT NULL,
  `smtp_crypto` varchar(6) NOT NULL,
  PRIMARY KEY (`smtp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `wx_smtp_sett`
--

INSERT INTO `wx_smtp_sett` (`smtp_id`, `smtp_user`, `smtp_pass`, `smtp_host`, `smtp_port`, `smtp_crypto`) VALUES
(1, 'biuro@waxingstudio.pl', 'tajemniczehaslo', 'smtp.1and1.pl', 587, 'tls');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wx_visits`
--

CREATE TABLE IF NOT EXISTS `wx_visits` (
  `visit_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_place` tinyint(3) NOT NULL,
  `visit_client` int(11) NOT NULL,
  `visit_worker` int(11) NOT NULL,
  `visit_worker_n` varchar(25) NOT NULL,
  `visit_proced_num` tinyint(2) NOT NULL,
  `visit_proced_sum` smallint(4) NOT NULL,
  `visit_min_time` tinyint(3) NOT NULL,
  `visit_max_time` tinyint(3) NOT NULL,
  `visit_start` time NOT NULL,
  `visit_stop` time NOT NULL,
  `visit_time_diff` smallint(3) NOT NULL COMMENT 'Difference between time suggested and actual time',
  `visit_cdate` date NOT NULL,
  PRIMARY KEY (`visit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Zrzut danych tabeli `wx_visits`
--

INSERT INTO `wx_visits` (`visit_id`, `visit_place`, `visit_client`, `visit_worker`, `visit_worker_n`, `visit_proced_num`, `visit_proced_sum`, `visit_min_time`, `visit_max_time`, `visit_start`, `visit_stop`, `visit_time_diff`, `visit_cdate`) VALUES
(11, 2, 2, 3, 'eugenia centr', 2, 200, 27, 38, '15:00:10', '17:28:30', 110, '2013-08-05'),
(12, 2, 1, 3, 'eugenia centr', 2, 185, 25, 35, '12:50:17', '17:53:10', 268, '2013-08-06');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wx_workers`
--

CREATE TABLE IF NOT EXISTS `wx_workers` (
  `worker_id` int(11) NOT NULL AUTO_INCREMENT,
  `worker_name` varchar(25) NOT NULL,
  `worker_surname` varchar(25) NOT NULL,
  `worker_address` varchar(255) NOT NULL,
  `worker_mail` varchar(20) NOT NULL,
  `worker_phone` int(20) NOT NULL,
  `worker_number` varchar(25) NOT NULL,
  `worker_password` varchar(30) NOT NULL,
  `worker_regdate` datetime NOT NULL,
  `worker_place` tinyint(3) NOT NULL,
  PRIMARY KEY (`worker_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `wx_workers`
--

INSERT INTO `wx_workers` (`worker_id`, `worker_name`, `worker_surname`, `worker_address`, `worker_mail`, `worker_phone`, `worker_number`, `worker_password`, `worker_regdate`, `worker_place`) VALUES
(1, 'Kasiaa', 'Kowalska', 'hirszfelda 5', 'kasia@kowalska.pl', 111111111, '1111', 'kowalska', '2013-07-24 00:00:00', 1),
(3, 'eugenia', 'centr', '', '', 0, '12', 'centralna', '2013-07-29 17:06:56', 2);
