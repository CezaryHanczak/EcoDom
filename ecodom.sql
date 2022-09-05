-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Wrz 2022, 17:43
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
-- Baza danych: `ecodom`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `fotowoltaika`
--

CREATE TABLE `fotowoltaika` (
  `id` int(11) NOT NULL,
  `mieszkanie_id` int(11) NOT NULL,
  `uzytkownik_id` int(11) NOT NULL,
  `ilosc_paneli` int(11) NOT NULL,
  `powierzchnia_panela` int(11) NOT NULL,
  `moc_panela` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `fotowoltaika`
--

INSERT INTO `fotowoltaika` (`id`, `mieszkanie_id`, `uzytkownik_id`, `ilosc_paneli`, `powierzchnia_panela`, `moc_panela`) VALUES
(1, 1, 1, 20, 150, 250);

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
-- Struktura tabeli dla tabeli `prad`
--

CREATE TABLE `prad` (
  `id` int(11) NOT NULL,
  `cena_za_kWh` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `prad`
--

INSERT INTO `prad` (`id`, `cena_za_kWh`) VALUES
(1, 0.67);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `urzadzenia`
--

CREATE TABLE `urzadzenia` (
  `id` int(6) UNSIGNED NOT NULL,
  `nazwa` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `zuzycie_energii` int(10) UNSIGNED NOT NULL,
  `id_mieszkania` int(10) UNSIGNED NOT NULL,
  `id_pomieszczenia` int(10) UNSIGNED NOT NULL,
  `sredni_czas_pracy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `urzadzenia`
--

INSERT INTO `urzadzenia` (`id`, `nazwa`, `zuzycie_energii`, `id_mieszkania`, `id_pomieszczenia`, `sredni_czas_pracy`) VALUES
(1, 'toster', 120, 1, 2, 0),
(2, 'tv', 500, 1, 1, 0),
(3, 'konsola', 300, 1, 1, 0),
(4, 'miodnik', 20, 2, 3, 0),
(6, 'PC', 650, 1, 1, 0),
(7, 'PC', 650, 1, 1, 5),
(8, 'lodowka', 1200, 1, 1, 3),
(9, 'suszarka', 450, 1, 1, 4),
(10, 'lodowka', 1500, 2, 3, 24);

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
-- Indeksy dla tabeli `fotowoltaika`
--
ALTER TABLE `fotowoltaika`
  ADD PRIMARY KEY (`id`);

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
-- Indeksy dla tabeli `prad`
--
ALTER TABLE `prad`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `fotowoltaika`
--
ALTER TABLE `fotowoltaika`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT dla tabeli `prad`
--
ALTER TABLE `prad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `urzadzenia`
--
ALTER TABLE `urzadzenia`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
