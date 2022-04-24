-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 24 2022 г., 18:48
-- Версия сервера: 8.0.24
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `messenger_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `chat_id` int UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `message_id` int UNSIGNED NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `chat_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` int UNSIGNED NOT NULL,
  `login` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `avatar_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `user_chat`
--

CREATE TABLE `user_chat` (
  `chat_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `chat_id` (`chat_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `chat_id_2` (`chat_id`,`user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `name` (`login`);

--
-- Индексы таблицы `user_chat`
--
ALTER TABLE `user_chat`
  ADD UNIQUE KEY `user_chat_id` (`chat_id`,`user_id`),
  ADD KEY `chat_id` (`chat_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`chat_id`,`user_id`) REFERENCES `user_chat` (`chat_id`, `user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `user_chat`
--
ALTER TABLE `user_chat`
  ADD CONSTRAINT `user_chat_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`chat_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_chat_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
