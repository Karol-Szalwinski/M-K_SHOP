-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 06 Lut 2017, 22:13
-- Wersja serwera: 5.5.50-0ubuntu0.14.04.1
-- Wersja PHP: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `M-K_SHOP`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Admin`
--

CREATE TABLE IF NOT EXISTS `Admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `Admin`
--

INSERT INTO `Admin` (`id`, `name`, `email`, `hashed_password`) VALUES
(2, 'Admin', 'admin@admin', '$2y$10$u2w3q9.yWVirbzN9WWD2jOBqi2EKxrrpnUQi69EQcy8kE/MM2fQuq');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Groups`
--

CREATE TABLE IF NOT EXISTS `Groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Zrzut danych tabeli `Groups`
--

INSERT INTO `Groups` (`id`, `group_name`) VALUES
(17, 'Karty Graficzne'),
(19, 'Dyski SSD'),
(20, 'Procesory'),
(21, 'Dyski HDD');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Messages`
--

CREATE TABLE IF NOT EXISTS `Messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_receiver` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text_message` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_sender` (`id_sender`),
  KEY `id_receiver` (`id_receiver`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `Messages`
--

INSERT INTO `Messages` (`id`, `id_receiver`, `id_sender`, `title`, `text_message`, `creation_date`) VALUES
(1, 18, 2, 'ZamÃ³wienie nr 32', 'No sory ale poczekasz Johnie na ten sprzÄ™t bo paleta nam na magazynie spadÅ‚a i siÄ™ potÅ‚ukÅ‚y.', '2017-02-06 21:06:28');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Orders`
--

CREATE TABLE IF NOT EXISTS `Orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `payment_method` varchar(100) NOT NULL,
  `amount` float NOT NULL,
  `adress_street` varchar(100) NOT NULL,
  `adress_local` varchar(100) NOT NULL,
  `postal_code` varchar(100) NOT NULL,
  `adress_city` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Zrzut danych tabeli `Orders`
--

INSERT INTO `Orders` (`id`, `id_user`, `status`, `creation_date`, `payment_method`, `amount`, `adress_street`, `adress_local`, `postal_code`, `adress_city`) VALUES
(32, 18, 1, '2017-02-06 21:05:05', '1', 1994, 'Winterfell', '99', '00-000', 'Westeros'),
(33, 18, 0, '2017-02-06 21:05:05', '', 0, '', '', '', ''),
(34, 19, 2, '2017-02-06 21:12:55', '3', 1699.64, 'Casterly Rock', '1', '00-001', 'Westeros'),
(35, 19, 0, '2017-02-06 21:12:26', '', 3238, '', '', '', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Photos`
--

CREATE TABLE IF NOT EXISTS `Photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `path` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Zrzut danych tabeli `Photos`
--

INSERT INTO `Photos` (`id`, `id_product`, `path`) VALUES
(1, 12, '../images/dysk1.jpeg'),
(2, 13, '../images/dysk_ssd_2.png'),
(3, 13, '../images/dysk_ssd_2b.png'),
(4, 14, '../images/dysk_ssd_3a.jpeg'),
(5, 15, '../images/gpu_1a.jpeg'),
(6, 15, '../images/gpu_1b.jpeg'),
(7, 15, '../images/gpu_1c.jpeg'),
(8, 16, '../images/gpu_1a.jpeg'),
(9, 16, '../images/gpu_1b.jpeg'),
(10, 16, '../images/gpu_1c.jpeg'),
(11, 17, '../images/gpu_1a.jpeg'),
(12, 17, '../images/gpu_1b.jpeg'),
(13, 17, '../images/gpu_1c.jpeg'),
(14, 18, '../images/cpu_1.jpeg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Product`
--

CREATE TABLE IF NOT EXISTS `Product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_group` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `availability` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_group` (`id_group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Zrzut danych tabeli `Product`
--

INSERT INTO `Product` (`id`, `id_group`, `name`, `price`, `description`, `availability`, `deleted`) VALUES
(12, 21, 'Dysk Seagate 1TB 3,5', 239, 'Dyski twarde Seagate Desktop HDD o pojemnoÅ›ci 1 TB na talerz dysponujÄ… teraz zaawansowanymi trybami zasilania, pozwalajÄ…cymi oszczÄ™dzaÄ‡ wiÄ™cej energii, bez pogarszania wydajnoÅ›ci w trybie bezczynnoÅ›ci.\r\n\r\nDyski twarde Desktop sÄ… wytwarzane w najbardziej zaawansowanym procesie produkcyjnym w branÅ¼y, w ktÃ³rym nacisk kÅ‚adzie siÄ™ na ochronÄ™ Å›rodowiska.\r\n\r\nDyski Desktop sÄ… zgodne z dyrektywÄ… RoHS (Ograniczenie okreÅ›lonych substancji niebezpiecznych) i dobrowolnie ograniczajÄ… zwiÄ…zki halogenowe\r\n70% lub wiÄ™cej materiaÅ‚Ã³w uÅ¼ytych w konstrukcji dyskÃ³w twardych Desktop nadaje siÄ™ do ponownego wykorzystania\r\nNiski pobÃ³r mocy', 45, 0),
(13, 19, 'Dysk SSD Samsung 850', 625, 'Podstawowe cechy:\r\nSzybkoÅ›Ä‡ zapisu [MB/s]: 520\r\nPojemnoÅ›Ä‡ dysku: 256 GB\r\nSzyfrowanie sprzÄ™towe: Tak\r\nInterfejs: SATA III (6 Gb/s)\r\nSzybkoÅ›Ä‡ odczytu [MB/s]: 550', 100, 0),
(14, 19, 'Dysk SSD GoodRam Iri', 379, 'Podstawowe cechy:\r\nPojemnoÅ›Ä‡ dysku: 240 GB\r\nSzyfrowanie sprzÄ™towe: Nie\r\nInterfejs: SATA III (6 Gb/s)\r\nSzybkoÅ›Ä‡ zapisu [MB/s]: 530\r\nSzybkoÅ›Ä‡ odczytu [MB/s]: 560', 6, 0),
(15, 17, 'Karta graficzna MSI ', 491.32, 'Podstawowe cechy:\r\nÅÄ…czenie kart: Nie\r\nSzyna danych [bit]: 128\r\nIloÅ›Ä‡ pamiÄ™ci RAM: 2 GB\r\nRodzaj pamiÄ™ci RAM: GDDR5\r\nD-Sub: 1x D-Sub', 0, 1),
(16, 17, 'Karta graficzna MSI GeForce GTX 750Ti 2GB GDDR5 (1', 491.32, 'Podstawowe cechy:\r\nÅÄ…czenie kart: Nie\r\nSzyna danych [bit]: 128\r\nIloÅ›Ä‡ pamiÄ™ci RAM: 2 GB\r\nRodzaj pamiÄ™ci RAM: GDDR5\r\nD-Sub: 1x D-Sub', 0, 1),
(17, 17, 'Karta graficzna MSI GeForce GTX 750Ti 2GB GDDR5 (128 bit) DVI, HDMI, VGA', 491.32, 'Podstawowe cechy:\r\nÅÄ…czenie kart: Nie\r\nSzyna danych [bit]: 128\r\nIloÅ›Ä‡ pamiÄ™ci RAM: 2 GB\r\nRodzaj pamiÄ™ci RAM: GDDR5\r\nD-Sub: 1x D-Sub', 17, 0),
(18, 20, 'Procesor Intel Core i7-6700K, 4.0GHz, 8MB, BOX', 1619, 'Podstawowe cechy:\r\nLiczba rdzeni: 4\r\nLinia: Core i7\r\nOdblokowany mnoÅ¼nik: tak\r\nTyp gniazda: Socket 1151\r\nTDP [W]: 91', 98, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Product_orders`
--

CREATE TABLE IF NOT EXISTS `Product_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_orders` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `real_price` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_orders` (`id_orders`),
  KEY `id_product` (`id_product`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `Product_orders`
--

INSERT INTO `Product_orders` (`id`, `id_orders`, `id_product`, `quantity`, `real_price`) VALUES
(1, 32, 12, 2, 239),
(2, 32, 14, 4, 379),
(3, 34, 12, 3, 239),
(4, 34, 17, 2, 491.32),
(5, 35, 18, 2, 1619);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Statuses`
--

CREATE TABLE IF NOT EXISTS `Statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `status_name` (`status_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `Statuses`
--

INSERT INTO `Statuses` (`id`, `status_name`) VALUES
(0, 'oczekujace'),
(2, 'oplacone'),
(1, 'zlozone'),
(3, 'zrealizowane');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adress_street` varchar(255) NOT NULL,
  `adress_local` varchar(20) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `adress_city` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Zrzut danych tabeli `Users`
--

INSERT INTO `Users` (`id`, `name`, `surname`, `hashed_password`, `email`, `adress_street`, `adress_local`, `postal_code`, `adress_city`) VALUES
(18, 'John', 'Snow', '$2y$10$YThJNzJ9vx.rmrPmaCvW5.kjcR9WlwJkfoUWHhTdNGhF03r6sI2te', 'john.snow@game.thrones', 'Winterfell', '99', '00-000', 'Westeros'),
(19, 'Tyrion', 'Lannister', '$2y$10$fwRJIqg/qP0qNT.1BqsJOuOkDOEvvWUTFOuk5aQGitOR0VO51nWm6', 'tyrion.lannister@game.thrones', 'Casterly Rock', '1', '00-001', 'Westeros');

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `Messages_ibfk_1` FOREIGN KEY (`id_sender`) REFERENCES `Admin` (`id`),
  ADD CONSTRAINT `Messages_ibfk_2` FOREIGN KEY (`id_receiver`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Orders_ibfk_2` FOREIGN KEY (`status`) REFERENCES `Statuses` (`id`);

--
-- Ograniczenia dla tabeli `Product`
--
ALTER TABLE `Product`
  ADD CONSTRAINT `Product_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `Groups` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `Product_orders`
--
ALTER TABLE `Product_orders`
  ADD CONSTRAINT `Product_orders_ibfk_1` FOREIGN KEY (`id_orders`) REFERENCES `Orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Product_orders_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `Product` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
