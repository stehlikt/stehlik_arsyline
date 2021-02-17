-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 18. úno 2021, 00:34
-- Verze serveru: 10.4.8-MariaDB
-- Verze PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `stehlik_arsyline`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `gender` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `posts`
--

INSERT INTO `posts` (`id`, `name`, `description`, `gender`, `country`, `question`) VALUES
(1, 'Tomáš Stehlík', 'Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum', 'male', '', 0),
(2, 'Tomáš Stehlík', 'Lorem IpSum Dolorum Lorem IpSum Dolorum Lorem IpSum Dolorum Lorem IpSum Dolorum ', 'male', '', 0),
(3, 'Tomáš Stehlík', 'Lorem IpSum Dolorum Lorem IpSum Dolorum Lorem IpSum Dolorum Lorem IpSum Dolorum ', 'male', 'CZ SK', 1),
(4, 'Tomáš Stehlík', 'Lorem IpSum Dolorum Lorem IpSum Dolorum Lorem IpSum Dolorum Lorem IpSum Dolorum ', 'male', 'CZ SK', 1),
(5, 'Tomáš Stehlík', 'Lorem IpSum Dolorum Lorem IpSum Dolorum Lorem IpSum Dolorum Lorem IpSum Dolorum ', 'male', 'CZ SK', 1),
(6, 'Tomáš Stehlík', 'Lorem IpSum Dolorum Lorem IpSum Dolorum Lorem IpSum Dolorum Lorem IpSum Dolorum ', 'male', 'SK GB ?', 0),
(7, 'test', 'test', 'male', 'CZ', 2);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
