-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Хост: localhost:8889
-- Время создания: Сен 01 2016 г., 12:54
-- Версия сервера: 5.5.42
-- Версия PHP: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `demo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `name`) VALUES
(2, 47, 'project_2'),
(5, 64, '123 asD asd as D Asd  asd'),
(6, 64, 'ASD'),
(7, 64, 'ASD QWE Q'),
(8, 64, 'ASD QWE Q QWE QW'),
(9, 64, 'ASD QWE Q QWE QWa sdf a DS asd aS'),
(10, 64, 'ASD QWE Q QWE QWa sdf a DS asd aS  asD'),
(11, 64, 'asd'),
(12, 64, 'asD'),
(13, 64, 'asdas asd'),
(14, 64, 'asD  ASd'),
(15, 64, 'asd'),
(16, 64, 'sdfsadf'),
(17, 64, 'asD'),
(18, 64, 'asDasd'),
(19, 64, 'asdasd'),
(20, 64, 'AsdasD'),
(21, 64, 'AsdasD SDF ASDF'),
(22, 64, 'AsdasD SDF ASDF DSF as'),
(23, 64, 'asD'),
(24, 64, 'ASDASD'),
(25, 64, 'ASDASD ASD'),
(26, 64, 'ASDASD ASD  SAd'),
(27, 64, 'ASDASD ASD  SAd  asd'),
(28, 64, 'ASDASD ASD  SAd  asd 4444asd'),
(29, 64, 'ASDASD ASD  SAd  asd 4444 asd'),
(30, 64, 'ASDASD ASD  SAd  asd 4444 asd  asD'),
(31, 64, 'ASD'),
(32, 64, 'ASD ASD'),
(33, 64, 'aSD'),
(34, 64, 'aSD aDAS a'),
(35, 64, 'asD'),
(36, 64, 'asD ASD'),
(37, 64, 'asD ASD  asd'),
(38, 64, 'asdasD'),
(39, 64, 'ASDAsd'),
(41, 64, 'RRRR'),
(42, 64, 'qweqwe'),
(43, 64, 'ffff'),
(44, 64, 'ggg'),
(45, 64, 'asd Sf a'),
(46, 64, 'asDAsd asd a asD as asD Asd'),
(47, 64, 'asdasd'),
(48, 64, 'AsdasD Sf sa'),
(57, 64, 'asd asD asd aSDas dasD'),
(58, 64, 'asD'),
(59, 64, 'sa'),
(60, 64, 'asDAsd'),
(61, 64, 'asDASD'),
(62, 64, 'asDAsd'),
(63, 64, 'asDasD'),
(64, 64, 'AsdasD'),
(65, 64, 'asdasD'),
(66, 64, 'ASDASD'),
(67, 64, 'asDasd'),
(68, 64, 'asDAsd'),
(69, 64, 'asDAsd'),
(70, 64, 'asdasD'),
(71, 64, 'asdf'),
(72, 64, 'asdfasdf'),
(73, 64, 'dasDAsd'),
(74, 64, 'werwerwer'),
(75, 64, 'asdfasdf'),
(76, 64, 'dsf asdf'),
(77, 64, 'asDAsd'),
(78, 64, 'asDasd'),
(79, 64, 'asDAsd'),
(80, 64, 'asdasD'),
(82, 64, 'asdfasdf'),
(83, 64, 'qweqwe'),
(84, 64, 'ww'),
(85, 64, 'qwe'),
(86, 64, 'aSDasd'),
(87, 64, 'qweq'),
(91, 64, 'asd as asD'),
(92, 64, 'ASD Asd'),
(93, 64, 'as dasD'),
(94, 64, 'asDAsd'),
(95, 64, 'ASDAsd asd asD'),
(96, 64, 'asDAsd'),
(97, 64, 'asdasD'),
(100, 47, 'rrr'),
(102, 47, 'qweqwe');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('new','completed') NOT NULL,
  `project_id` int(11) NOT NULL,
  `deadline` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `status`, `project_id`, `deadline`) VALUES
(3, 'task name er', 'completed', 2, NULL),
(6, 'WWWWW', 'new', 33, NULL),
(7, 'asDAsd', 'new', 71, NULL),
(8, 'sadfasdf', 'new', 72, NULL),
(9, 'sadfasdf sdf asdf', 'new', 72, NULL),
(10, 'sadfasdf sdf asdf  sfsa dasD', 'new', 72, NULL),
(11, 'asDAsd', 'new', 73, NULL),
(12, 'werwer', 'new', 74, NULL),
(13, 'werwer', 'new', 74, NULL),
(14, 'asdfsadf', 'new', 74, NULL),
(15, 'dfgasdfasdf', 'new', 74, NULL),
(16, '1111', 'new', 74, NULL),
(17, 'asdfsadf', 'new', 75, NULL),
(18, 'asdf', 'new', 75, NULL),
(19, 'sad fasdf', 'new', 76, NULL),
(20, 'sad f', 'new', 76, NULL),
(21, 'asDasd', 'new', 77, NULL),
(22, 'asdasD', 'new', 77, NULL),
(23, 'asdasD', 'new', 77, NULL),
(24, 'RRR Asd aS ASD asd asD Asd', 'new', 78, NULL),
(25, 'ERER asd asD', 'new', 78, NULL),
(26, '3333 asd aSD ASD asd', 'new', 78, NULL),
(27, 'asDad asD asd asD', 'new', 78, NULL),
(28, 'asDASDasd  sad', 'new', 79, NULL),
(29, 'asd asd asD', 'new', 79, NULL),
(30, 'Asd asD asd', 'new', 80, NULL),
(31, 'asd asD asd  ASD asd', 'new', 80, NULL),
(32, 'asd', 'new', 80, NULL),
(37, 'sdafsadfsdaf', 'new', 82, NULL),
(38, 'sadf', 'new', 82, NULL),
(39, '1111', 'new', 83, NULL),
(40, '2222', 'new', 83, NULL),
(41, '3333', 'new', 83, NULL),
(42, '1', 'new', 84, NULL),
(43, '2', 'new', 84, NULL),
(44, '3', 'new', 84, NULL),
(45, 'qweqwe', 'new', 85, NULL),
(46, 'sdfsadfasdf', 'new', 86, NULL),
(54, 'asdasd', 'new', 94, NULL),
(55, 'asdasD', 'new', 94, NULL),
(56, 'ASDasd', 'new', 97, NULL),
(57, 'asdaSD', 'new', 97, NULL),
(58, 'SADFSADF', 'new', 96, NULL),
(61, 'qweqwe', 'new', 102, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`) VALUES
(1, 'username2', 'password2', 'salt2'),
(2, 'username', 'password', 'salt'),
(3, 'username3', 'password', 'salt'),
(15, 'username5', 'password', 'salt'),
(16, 'username7', 'password', 'salt'),
(18, 'wer', 'wer$passre=wer', 'salt'),
(19, 'qwe', 'qwe$passre=', 'salt'),
(20, 'sadf', 'dsfg$passre=fgdh', 'salt'),
(22, 'ertert', 'sdfgeqrtqert$passre=dfghqertqert', 'salt'),
(23, '1212', '1212$passre=1212', 'salt'),
(25, 'ertert22222', 'rtyrty$passre=qweqwe', 'salt'),
(29, 'ertert22222e', 'rtyrty$passre=qweqwe', 'salt'),
(31, '1', '1', 'salt'),
(32, 'ws', 'aa1784424d3217732c53b4d4d2c1ba16', '57c470d96328c'),
(33, 'ee', '4b237e11e194192b5b99f129d361eeb6', '57c4712462fd0'),
(34, 'tt', 'd89dda6694109bac7b5ade4e8176cc79', '57c471c4613a8'),
(35, '12', 'a0936413d839045773b764caff2ad956', '57c475fcbe973'),
(36, '2w', 'f0ce4f6f4f3cbe3eeb7d6fde3491ecb6', '57c47630bca78'),
(37, 'dc', 'ae3fcbd30d31b1bcbd0b9dad0b3e7619', '57c476a2f26b1'),
(40, 'ff', '3d00eb9705d80841672fe1853a00e199', '57c47cf457841'),
(41, 'qweww', '5ca7c19c5cb9f544f1d14e60c7506fe7', '57c47ebfe9609'),
(42, 'cdcd', '0b8ac37e3bb39e6dd1112d9d7004eb73', '57c47f249ce0d'),
(43, 'cdss', '618d69d07deab45a35fe30c05341a55f', '57c4808ea8ecc'),
(44, 'wd', 'df726bbdb99c987da029ee7a30059f17', '57c4892179dc7'),
(45, 'vv', '54f0d72c0eb5591d86e7f19c5459ba4e', '57c48a00e2bcd'),
(46, 'ff3', 'e24ed8266ccdf89ad818694a82d6e721', '57c48ba494354'),
(47, 'ww', 'a16439914a669b5db640f8ff287d7755', '57c4916595c7d'),
(48, '12124', '6905374309b79dc3f724b2cd49f9d748', '57c534f556772'),
(49, 'rfrf', '150f2b6b138346de4d9b418c377bf518', '57c5360dbe02a'),
(50, 'cc', 'faf66c38b7aad236e010c19c7fb09f88', '57c5553b45744'),
(51, 'sdsd', '12cff365b545ee266823752f7853cd96', '57c5567a7f154'),
(52, 'cd', '264ac02d29a1ca324bf87604abbd2721', '57c58955495d1'),
(53, 'vfvf', '73b1e9a31de7afed1386d46d2901980a', '57c58986c4855'),
(54, 'asdf', 'bb92b62c2ab2c3c375eae899f3419cf8', '57c58a3dea473'),
(55, 'fffg', 'fa5495a21df01970def270c30af6813d', '57c58ad99c11e'),
(56, 'vvdfs', 'd4d87eac5892e17dc4b7c64068a4be83', '57c58b0cbc43c'),
(57, 'Miirlusky@gmail.Com', 'd7226a9734673f8783045e393d26372f', '57c5cfd06d61c'),
(58, 'Miirlusqweqweky@gmail.Com', '4441197166218e605b8045acaec88873', '57c6d9cb4dd13'),
(59, 'ededed', 'f0700094b2f7877e9a7858a8f50761c5', '57c6db575d32e'),
(60, '1Miirlusky@gmail.Com', '4eb1be4a16d088e775e042a1920b2dca', '57c6dd549457c'),
(61, '11', '699e17c1f9db3597fed5d5cf20bc5416', '57c747f09f88c'),
(62, 'fg', '31f66746e82742260a58e4c3004273aa', '57c752fbdca49'),
(63, 'dfg', 'a885abfb00203e492c03df56dc41d9aa', '57c753d1c6765'),
(64, '232323', 'c88a5c550e518a7c0b98c15623472314', '57c7b4a3776bb'),
(65, 'tttttttt', '825c13ebcf2ff2cb0e2f7e0ce95b107c', '57c8073c497f3');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;