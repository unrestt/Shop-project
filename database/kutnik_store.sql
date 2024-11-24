-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 24, 2024 at 01:15 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kutnik_store`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `firma` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `kolor` varchar(50) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `rekomendacja` tinyint(1) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `image_url_1` varchar(255) NOT NULL,
  `image_url_2` varchar(255) NOT NULL,
  `image_url_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `firma`, `model`, `kolor`, `nazwa`, `rekomendacja`, `cena`, `image_url_1`, `image_url_2`, `image_url_3`) VALUES
(1, 'Nike', 'Air Force 1', 'White', 'Nike Air Force 1', 1, 529.99, 'assets/images/database_images/shoes/Nike/Air_Force_1/White/airforce1_white_1.png\r\n', 'assets/images/database_images/shoes/Nike/Air_Force_1/White/airforce1_white_2.png', 'assets/images/database_images/shoes/Nike/Air_Force_1/White/airforce1_white_3.png'),
(2, 'Nike', 'Air Force 1', 'Black', 'Nike Air Force 1', 0, 529.99, 'assets/images/database_images/shoes/Nike/Air_Force_1/Black/airforce1_black_1.png', 'assets/images/database_images/shoes/Nike/Air_Force_1/Black/airforce1_black_2.png', 'assets/images/database_images/shoes/Nike/Air_Force_1/Black/airforce1_black_3.png'),
(3, 'Nike', 'Air Jordan 1', 'Light Smoke Gray', 'Nike Air Jordan 1', 1, 1399.99, 'assets/images/database_images/shoes/Nike/Air_Jordan_1/Light_Smoke_Gray/AirJordan1_LightSmokeGray_1.png', 'assets/images/database_images/shoes/Nike/Air_Jordan_1/Light_Smoke_Gray/AirJordan1_LightSmokeGray_2.png', 'assets/images/database_images/shoes/Nike/Air_Jordan_1/Light_Smoke_Gray/AirJordan1_LightSmokeGray_3.png'),
(4, 'Nike', 'Air Jordan 1', 'Red Black', 'Nike Air Jordan 1', 0, 1399.99, 'assets/images/database_images/shoes/Nike/Air_Jordan_1/Red_Black/AirJordan1_RedBlack_1.png', 'assets/images/database_images/shoes/Nike/Air_Jordan_1/Red_Black/AirJordan1_RedBlack_2.png', 'assets/images/database_images/shoes/Nike/Air_Jordan_1/Red_Black/AirJordan1_RedBlack_3.png'),
(5, 'Nike', 'Air Jordan 4', 'Military Black', 'Nike Air Jordan 4', 1, 2699.99, 'assets/images/database_images/shoes/Nike/Air_Jordan_4/Military_Black/AirJordan4_MilitaryBlack_1.png', 'assets/images/database_images/shoes/Nike/Air_Jordan_4/Military_Black/AirJordan4_MilitaryBlack_2.png', 'assets/images/database_images/shoes/Nike/Air_Jordan_4/Military_Black/AirJordan4_MilitaryBlack_3.png'),
(6, 'Nike', 'Air Jordan 4', 'Yellow Thunder', 'Nike Air Jordan 4', 0, 1499.99, 'assets/images/database_images/shoes/Nike/Air_Jordan_4/Yellow_Thunder/AirJordan4_YellowThunder_1.png', 'assets/images/database_images/shoes/Nike/Air_Jordan_4/Yellow_Thunder/AirJordan4_YellowThunder_2.png', 'assets/images/database_images/shoes/Nike/Air_Jordan_4/Yellow_Thunder/AirJordan4_YellowThunder_3.png'),
(7, 'Nike', 'Dunk', 'Grey Fog', 'Nike Dunk', 1, 529.99, 'assets/images/database_images/shoes\\Nike/Dunk/Grey_Fog/Dunk_GreyFog_1.png', 'assets/images/database_images/shoes\\Nike/Dunk/Grey_Fog/Dunk_GreyFog_2.png', 'assets/images/database_images/shoes\\Nike/Dunk/Grey_Fog/Dunk_GreyFog_3.png'),
(8, 'Nike', 'Dunk', 'Panda', 'Nike Dunk', 0, 529.99, 'assets/images/database_images/shoes\\Nike/Dunk/Panda/Dunk_Panda_1.png', 'assets/images/database_images/shoes\\Nike/Dunk/Panda/Dunk_Panda_2.png', 'assets/images/database_images/shoes\\Nike/Dunk/Panda/Dunk_Panda_3.png'),
(11, 'Adidas', 'Campus 00s', 'Black', 'Adidas Campus 00s', 0, 549.99, 'assets/images/database_images/shoes/Adidas/Campus00s/Black/campus00s_black_1.png', 'assets/images/database_images/shoes/Adidas/Campus00s/Black/campus00s_black_2.png', 'assets/images/database_images/shoes/Adidas/Campus00s/Black/campus00s_black_3.png'),
(12, 'Adidas', 'Campus 00s', 'Grey', 'Adidas Campus 00s', 1, 549.99, 'assets/images/database_images/shoes/Adidas/Campus00s/Grey/campus00s_grey_1.png', 'assets/images/database_images/shoes/Adidas/Campus00s/Grey/campus00s_grey_2.png', 'assets/images/database_images/shoes/Adidas/Campus00s/Grey/campus00s_grey_3.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontakt`
--

CREATE TABLE `kontakt` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `imie` varchar(50) DEFAULT NULL,
  `nazwisko` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `numer_tel` varchar(20) DEFAULT NULL,
  `wiadomosc` text DEFAULT NULL,
  `data_wiadomosci` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

CREATE TABLE `koszyk` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `rozmiar` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przedmioty_zamowione`
--

CREATE TABLE `przedmioty_zamowione` (
  `id` int(11) NOT NULL,
  `zamowienie_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `cena` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `data_zamowienia` date NOT NULL,
  `calk_kwota` decimal(10,2) NOT NULL,
  `status` enum('w trakcie','ukonczone','anulowane') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `kontakt`
--
ALTER TABLE `kontakt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_item_size` (`user_id`,`item_id`,`rozmiar`),
  ADD KEY `koszyk_ibfk_2` (`item_id`);

--
-- Indeksy dla tabeli `przedmioty_zamowione`
--
ALTER TABLE `przedmioty_zamowione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `przedmioty_zamowione_ibfk_1` (`item_id`),
  ADD KEY `przedmioty_zamowione_ibfk_2` (`zamowienie_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zamowienia_ibfk_1` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kontakt`
--
ALTER TABLE `kontakt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `koszyk`
--
ALTER TABLE `koszyk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `przedmioty_zamowione`
--
ALTER TABLE `przedmioty_zamowione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kontakt`
--
ALTER TABLE `kontakt`
  ADD CONSTRAINT `kontakt_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `koszyk`
--
ALTER TABLE `koszyk`
  ADD CONSTRAINT `koszyk_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `koszyk_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `przedmioty_zamowione`
--
ALTER TABLE `przedmioty_zamowione`
  ADD CONSTRAINT `przedmioty_zamowione_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `przedmioty_zamowione_ibfk_2` FOREIGN KEY (`zamowienie_id`) REFERENCES `zamowienia` (`id`);

--
-- Constraints for table `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `zamowienia_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
