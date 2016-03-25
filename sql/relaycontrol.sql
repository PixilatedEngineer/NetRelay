-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 25 2016 г., 18:01
-- Версия сервера: 5.5.45
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `relaycontrol`
--

-- --------------------------------------------------------

--
-- Структура таблицы `boards`
--

CREATE TABLE IF NOT EXISTS `boards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `boards`
--

INSERT INTO `boards` (`id`, `ip`, `name`, `slug`, `location`) VALUES
(1, '192.168.100.111', 'Relay Board for storage room', 'relay_board_for_storage_room', 'storage room'),
(2, '192.168.100.12', 'Relay Board for garage', 'relay_board_for_garage', 'garage');

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` varchar(15) NOT NULL,
  `days` varchar(100) NOT NULL,
  `state` varchar(3) NOT NULL,
  `relay_id` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`id`, `time`, `days`, `state`, `relay_id`, `board_id`) VALUES
(1, '23:30', '["Mon","Tue","Wen","Fri"]', 'on', 1, 1),
(2, '12:00', '["Mon","Tue","Wen","Fri"]', 'off', 2, 1),
(3, '10:00', '["Mon","Tue","Wen","Fri"]', 'on', 3, 1),
(7, '23:40:30', '["Wed","Thu","Sat"]', 'off', 1, 1),
(8, '11:11:11', '["Mon","Sat"]', 'off', 4, 1),
(9, '11:11:11', '["Mon","Tue","Wed","Thu","Fri","Sat","Sun"]', 'on', 3, 1),
(14, '11:11:10', '["Tue","Fri","Sun"]', 'on', 11, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `relays`
--

CREATE TABLE IF NOT EXISTS `relays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `relay_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `board_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Дамп данных таблицы `relays`
--

INSERT INTO `relays` (`id`, `relay_id`, `name`, `slug`, `board_id`) VALUES
(1, 1, 'Relay name 1', 'relay_name_1', 1),
(2, 2, 'Relay name 2', 'relay_name_2', 1),
(3, 3, 'Relay name 3', 'relay_name_3', 1),
(4, 4, 'Relay name 4', 'relay_name_4', 1),
(5, 1, 'Relay name 1', 'relay_name_1', 2),
(6, 2, 'Relay name 2', 'relay_name_2', 2),
(7, 3, 'Relay name 3', 'relay_name_3', 2),
(8, 4, 'Relay name 4', 'relay_name_4', 2),
(9, 5, 'Relay name 5', 'relay_name_5', 2),
(10, 6, 'Relay name 6', 'relay_name_6', 2),
(11, 7, 'Relay name 7', 'relay_name_7', 2),
(12, 8, 'Relay name 8', 'relay_name_8', 2),
(17, 1, 'rn1test 123 ', '', 7),
(18, 2, 'rn2test sdf ads', '', 7),
(19, 3, 'rn3test fgh', '', 7),
(20, 4, 'rn4test a asdf', '', 7),
(21, 1, 'MyNewRele1', '', 8),
(22, 2, 'MyNewRele2', '', 8),
(23, 3, 'MyNewRele3', '', 8),
(24, 4, 'MyNewRele4', '', 8),
(25, 5, 'MyNewRele5', '', 8),
(26, 6, 'MyNewRele6', '', 8),
(27, 7, 'MyNewRele7', '', 8),
(28, 8, 'MyNewRele8', '', 8);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
