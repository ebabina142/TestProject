CREATE DATABASE `testDB`  DEFAULT CHARACTER SET cp1251;
--

--
-- Структура таблицы `territory`
--

CREATE TABLE IF NOT EXISTS `territory` (
  `id_terr` int(5) NOT NULL,
  `name_terr` varchar(100) NOT NULL,
  `type_terr` int(1) NOT NULL,
  `id_parent_terr` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_terr`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `territory`
--

INSERT INTO `territory` (`id_terr`, `name_terr`, `type_terr`, `id_parent_terr`) VALUES
(1, 'Kharkiv state', 1, NULL),
(2, 'Kiev state', 1, NULL),
(3, 'Poltava state', 1, NULL),
(4, 'Kharkiv', 2, 1),
(5, 'Chuguev', 2, 1),
(6, 'Kiev', 2, 2),
(7, 'Belaya Tcerkov', 2, 2),
(8, 'Poltava', 2, 3),
(9, 'Mirgorod', 2, 3),
(10, 'Kholodnogorskiy', 3, 4),
(11, 'Moskovskiy', 3, 4),
(12, 'Industrialny', 3, 4),
(13, 'Obolonsky', 3, 6),
(14, 'Podolskiy', 3, 6),
(15, 'Pecherskiy', 3, 6),
(16, 'Kievskiy', 3, 8),
(17, 'Shevchenkovskiy', 3, 8),
(18, 'Chuguevskiy', 3, 5),
(19, 'Belotcerkovskiy', 3, 7),
(20, 'Mirgorodskiy', 3, 9);


-- --------------------------------------------------------
--
-- Структура таблицы `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id_pers` int(5) NOT NULL AUTO_INCREMENT,
  `name_pers` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_state` int(5) NOT NULL,
  `id_city` int(5) NOT NULL,
  `id_distr` int(5) NOT NULL,
  PRIMARY KEY (`id_pers`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;



