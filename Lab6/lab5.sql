-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Час створення: Бер 15 2025 р., 13:28
-- Версія сервера: 8.0.41-0ubuntu0.24.04.1
-- Версія PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `lab5`
--

-- --------------------------------------------------------

--
-- Структура таблиці `tov`
--

CREATE TABLE `tov` (
  `ID` int NOT NULL,
  `Name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Cost` int NOT NULL,
  `Kol` int NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `tov`
--

INSERT INTO `tov` (`ID`, `Name`, `Cost`, `Kol`, `Date`) VALUES
(1, 'Хліб чорний', 20, 200, '2025-03-10'),
(2, 'Ковбаса Салямі', 45, 80, '2025-02-20'),
(3, 'Сир Чедер', 80, 45, '2025-03-12'),
(4, 'Сир Камамбер', 100, 25, '2025-03-10'),
(5, 'Сир Гауда', 95, 30, '2025-03-05'),
(6, 'Хліб Бердичівський', 22, 175, '2025-03-09'),
(7, 'Масло Ферма', 60, 120, '2025-03-11'),
(8, 'Молоко Рудь', 45, 122, '2025-03-11'),
(9, 'Молоко Галичина', 83, 102, '2025-03-11'),
(10, 'Печиво вівсяне', 40, 55, '2025-03-08'),
(11, 'Батон Житомирський', 30, 205, '2025-03-10'),
(12, 'Печиво шоколадне', 60, 190, '2025-03-12'),
(13, 'Часник', 12, 500, '2025-03-13'),
(16, 'Помідори', 40, 123, '2025-03-05');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `ID` int NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LastName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `City` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `About` text COLLATE utf8mb4_unicode_ci,
  `BirthDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`ID`, `Name`, `LastName`, `Country`, `Password`, `City`, `Login`, `Avatar`, `About`, `BirthDate`) VALUES
(1, 'Admin', 'Admin', 'Zhytomyr', '123', NULL, 'Admin', NULL, 'I am Admin', NULL);

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `tov`
--
ALTER TABLE `tov`
  ADD PRIMARY KEY (`ID`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `tov`
--
ALTER TABLE `tov`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
