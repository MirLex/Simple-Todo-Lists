-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Хост: localhost:8889
-- Время создания: Сен 13 2016 г., 09:27
-- Версия сервера: 5.5.42
-- Версия PHP: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `SQL_tasks`
--

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `name`) VALUES
(1, 'project 1'),
(2, 'project 2'),
(3, 'project 3'),
(4, 'nbeginning'),
(5, 'Nbeginning'),
(6, 'without tAsks'),
(7, 'letterAletter'),
(8, 'Garage');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('new','viewed','postponed','completed') NOT NULL,
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `status`, `project_id`) VALUES
(1, 'task 1', 'completed', 1),
(2, 'task 2', 'new', 7),
(3, 'task 3', 'postponed', 2),
(4, 'task 4', 'completed', NULL),
(5, 'task 5', 'viewed', 1),
(6, 'Nbeginning', 'new', 4),
(7, 'nbeginning', 'viewed', 5),
(8, 'duplicate', 'new', 1),
(9, 'duplicate', 'completed', NULL),
(10, 'Completed task', 'completed', 8),
(11, 'Completed task', 'completed', 8),
(12, 'Completed task', 'completed', 8),
(13, 'Completed task', 'completed', 8),
(14, 'Completed task', 'completed', 8),
(15, 'Completed task', 'completed', 8),
(16, 'Completed task', 'completed', 8),
(17, 'Completed task', 'completed', 8),
(18, 'Completed task', 'completed', 8),
(19, 'Completed task', 'completed', 8),
(20, 'Completed task', 'completed', 1),
(21, 'Completed task', 'completed', 1),
(22, 'Completed task', 'completed', 1),
(23, 'Completed task', 'completed', 1),
(24, 'Completed task', 'completed', 1),
(25, 'Completed task', 'completed', 1),
(26, 'Completed task', 'completed', 1),
(27, 'Completed task', 'completed', 1),
(28, 'Completed task', 'completed', 1),
(29, 'Completed task', 'completed', 1),
(30, 'New Task', 'new', 8),
(31, 'New Task_', 'new', 8),
(32, 'Viewed task', 'viewed', 8),
(33, 'Viewed task', 'viewed', 8),
(34, 'Viewed task', 'viewed', 8),
(35, 'Postponed Task', 'postponed', 8),
(36, 'Postponed Task', 'postponed', 8),
(37, 'Postponed Task', 'postponed', 8),
(38, 'Postponed Task', 'postponed', 8);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);
