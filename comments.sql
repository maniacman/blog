-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 21 2019 г., 00:46
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
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` char(255) NOT NULL,
  `access` varchar(10) NOT NULL,
  `datecomment` int(11) NOT NULL,
  `login` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `comment`, `access`, `datecomment`, `login`) VALUES
(25, 'Повседневная практика показывает, что сложившаяся структура организации позволяет оценить значение направлений прогрессивного развития. Таким образом дальнейшее развитие различных форм деятельности играет важную роль в формировании позиций, занимаемы', 'allowed', 1566334140, 'guest'),
(26, 'Повседневная практика показывает, что сложившаяся структура организации позволяет оценить значение направлений прогрессивного развития. Таким образом дальнейшее развитие различных форм деятельности играет важную роль в формировании позиций, занимаемы', 'allowed', 1566334172, 'guest'),
(27, 'Кто будет писать глупости, вычислю по айпи и забаню', 'allowed', 1566334639, 'ФедяКрузенштерн'),
(28, 'jvu', 'allowed', 1566337437, '777');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
