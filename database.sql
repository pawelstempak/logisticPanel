-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 10 Cze 2022, 13:12
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `logpanel`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address1` varchar(200) NOT NULL,
  `address2` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `code` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `email`, `phone`, `address1`, `address2`, `city`, `code`) VALUES
(15, 'Hurtownia Motoryzacyjna', 'biuro@motoexpert.pl', '0', '', '0', '0', '0'),
(17, 'Paweł Stempak', 'pawelstempak@gmail.com', '0', '', '0', '0', '0'),
(23, 'Tomasz Rokosz', 'tomaszrokosz@gmal.com', '0', '', '0', '0', '0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `tracking` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sender_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_sub` tinyint(1) NOT NULL,
  `recipient_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `recipient_sub` tinyint(1) DEFAULT NULL,
  `customer_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_sub` tinyint(1) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id`, `tracking`, `sender_number`, `sender_id`, `sender_sub`, `recipient_number`, `recipient_id`, `recipient_sub`, `customer_number`, `customer_id`, `customer_sub`, `status`) VALUES
(31, 'GK123456789', 'SN123456789', 24, 1, 'RN123456789', 0, NULL, 'CN123456789', NULL, NULL, 1),
(33, 'GK987654321', 'SN987654321', 17, 0, 'RN987654321', 1, NULL, 'CN987654321', NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recipients`
--

CREATE TABLE `recipients` (
  `recipient_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address1` varchar(200) NOT NULL,
  `address2` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `code` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `recipients`
--

INSERT INTO `recipients` (`recipient_id`, `name`, `email`, `phone`, `address1`, `address2`, `city`, `code`) VALUES
(15, 'Hurtownia Motoryzacyjna', 'biuro@motoexpert.pl', '0', '', '0', '0', '0'),
(17, 'Paweł Stempak', 'pawelstempak@gmail.com', '0', '', '0', '0', '0'),
(23, 'Tomasz Rokosz', 'tomaszrokosz@gmal.com', '0', '', '0', '0', '0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `senders`
--

CREATE TABLE `senders` (
  `sender_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address1` varchar(200) NOT NULL,
  `address2` varchar(200) DEFAULT NULL,
  `city` varchar(200) NOT NULL,
  `code` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `senders`
--

INSERT INTO `senders` (`sender_id`, `name`, `email`, `phone`, `address1`, `address2`, `city`, `code`) VALUES
(15, 'Hurtownia Motoryzacyjna', 'biuro@motoexpert.pl', '+48456857895', 'Lwowska 32', '', 'Przemyśl', '37-700'),
(17, 'Paweł Stempak', 'pawelstempak@gmail.com', '+484568597458', 'Tarnowska 5/1', '', 'Rzeszów', '47-856'),
(23, 'Tomasz Rokosz', 'tomaszrokosz@gmal.com', '+32956874589', 'Bauch Strasse 45 m.5', 'Landendzonen', 'Berlin', '788-485'),
(24, 'Piotr Litwin', 'piotrlitwin@gmail.com', '+48304059694', 'Siemiradzkiego 5/11', '', 'Przemyśl', '37-700'),
(31, 'Grzegorz Woźny', 'gwozny@gmail.com', '43439284932', 'Tarnawskiego 5/11', NULL, 'Przemyśl', '37-700');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`) VALUES
(1, 'Paweł', 'Stempak', 'admin@domainname.com', '123456');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `recipients`
--
ALTER TABLE `recipients`
  ADD PRIMARY KEY (`recipient_id`);

--
-- Indeksy dla tabeli `senders`
--
ALTER TABLE `senders`
  ADD PRIMARY KEY (`sender_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT dla tabeli `recipients`
--
ALTER TABLE `recipients`
  MODIFY `recipient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT dla tabeli `senders`
--
ALTER TABLE `senders`
  MODIFY `sender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
