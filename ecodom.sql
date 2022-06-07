-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Cze 2022, 10:12
-- Wersja serwera: 10.1.36-MariaDB
-- Wersja PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ecodom`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mieszkania`
--

CREATE TABLE `mieszkania` (
  `id` int(6) UNSIGNED NOT NULL,
  `nazwa` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `id_uzytkownika` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `mieszkania`
--

INSERT INTO `mieszkania` (`id`, `nazwa`, `id_uzytkownika`) VALUES
(1, 'Moja villa', 1),
(2, 'chatka puchatka', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pomieszczenia`
--

CREATE TABLE `pomieszczenia` (
  `id` int(6) UNSIGNED NOT NULL,
  `nazwa` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `id_mieszkania` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pomieszczenia`
--

INSERT INTO `pomieszczenia` (`id`, `nazwa`, `id_mieszkania`) VALUES
(1, 'salon', 1),
(2, 'kuchnia', 1),
(3, 'jadalnia', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `urzadzenia`
--

CREATE TABLE `urzadzenia` (
  `id` int(6) UNSIGNED NOT NULL,
  `nazwa` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `zuzycie_energii` int(10) UNSIGNED NOT NULL,
  `id_mieszkania` int(10) UNSIGNED NOT NULL,
  `id_pomieszczenia` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `urzadzenia`
--

INSERT INTO `urzadzenia` (`id`, `nazwa`, `zuzycie_energii`, `id_mieszkania`, `id_pomieszczenia`) VALUES
(1, 'toster', 120, 1, 2),
(2, 'tv', 500, 1, 1),
(3, 'konsola', 300, 1, 1),
(4, 'miodnik', 20, 2, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(6) UNSIGNED NOT NULL,
  `login` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `password`, `email`) VALUES
(1, 'test', 'qwerty', 'test@o2.pl'),
(2, 'test123', 'Qwerty1', 'lol@o2.pl');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `mieszkania`
--
ALTER TABLE `mieszkania`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`);

--
-- Indeksy dla tabeli `pomieszczenia`
--
ALTER TABLE `pomieszczenia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mieszkania` (`id_mieszkania`);

--
-- Indeksy dla tabeli `urzadzenia`
--
ALTER TABLE `urzadzenia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mieszkania` (`id_mieszkania`),
  ADD KEY `id_pomieszczenia` (`id_pomieszczenia`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `mieszkania`
--
ALTER TABLE `mieszkania`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `pomieszczenia`
--
ALTER TABLE `pomieszczenia`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `urzadzenia`
--
ALTER TABLE `urzadzenia`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `mieszkania`
--
ALTER TABLE `mieszkania`
  ADD CONSTRAINT `mieszkania_ibfk_1` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id`);

--
-- Ograniczenia dla tabeli `pomieszczenia`
--
ALTER TABLE `pomieszczenia`
  ADD CONSTRAINT `pomieszczenia_ibfk_1` FOREIGN KEY (`id_mieszkania`) REFERENCES `mieszkania` (`id`);

--
-- Ograniczenia dla tabeli `urzadzenia`
--
ALTER TABLE `urzadzenia`
  ADD CONSTRAINT `urzadzenia_ibfk_1` FOREIGN KEY (`id_mieszkania`) REFERENCES `mieszkania` (`id`),
  ADD CONSTRAINT `urzadzenia_ibfk_2` FOREIGN KEY (`id_pomieszczenia`) REFERENCES `pomieszczenia` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
