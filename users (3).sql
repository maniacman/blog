-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 16 2019 г., 23:16
-- Версия сервера: 5.6.38
-- Версия PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(150) NOT NULL,
  `filename` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `filename`) VALUES
(1, 'ФедяКрузенштерн', 'manilo.83@mail.ru', '$2y$10$1GUb3EQHAP.rFXWrKGXjI.Yg4Tq.r6RbcBOckdajHJ9TmpNOFKqCG', '537941a644969b34bbc59bbb84386569.jpg'),
(2, 'Валерон', '1@1.r', '$2y$10$5Rzq23brzH/DAG4C.ldf0eSXWuhzS3yXF4nU9uuUK/TXHtctdUrCm', ''),
(3, 'Валера', '1@1.r1', '$2y$10$sR2RBwbjTVwA3fTUi/TIdu9i0oPzbI.spr6Hra2c2yiT1H5IFYxXq', ''),
(4, 'Валера1', '1@1.r2', '$2y$10$nxp11EhRJSFs50aIOhTkSeskh7rIPed4anQdLdjTQWBDJ8VAprPB.', ''),
(5, 'Валера11', '1@1.r22', '$2y$10$uSdmOZINXRalXudg0jwGJ.WddZKj3SPt8xjR07JUXGY6rjLbxmpUm', ''),
(6, 'Леонардо', 'leo@mail.ru', '$2y$10$dJ5uzo.CtuNCLzFJQyWz4..YShPSXKlGRDhFFSLjGiKYp.NFOqRqu', '72202cdb3a301eb13bfac36e86f48a2f.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
