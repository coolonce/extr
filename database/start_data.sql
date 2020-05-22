-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 22 2020 г., 13:39
-- Версия сервера: 5.6.34
-- Версия PHP: 5.6.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_extr`
--

--
-- Дамп данных таблицы `types_of_details`
--

INSERT INTO `types_of_details` (`name`, `type`) VALUES
('Нижняя колба', 1),
('Верхняя колба', 2),
('Обратный холодильник', 3);


--
-- Дамп данных таблицы `characts`
--

INSERT INTO `characts` (`cname`, `citem`) VALUES
('346', 235),
('346', 235);

--
-- Дамп данных таблицы `coolants`
--

INSERT INTO `coolants` (`name`, `start_viscosity`, `start_density`, `c`) VALUES
('Вода', 0.000001006, 997, 4183);

--
-- Дамп данных таблицы `details`
--

INSERT INTO `details` (`name`, `type_id`, `link`, `thin_section`, `diameter`, `volume`) VALUES
('Плоскодонная колба 500 мл', 1, '1', '29/32', 40, 0.5),
('Шариковый холодильник', 3, '3', '29/32', NULL, NULL),
('Экстрактор Сокслета-01', 2, '2', '29/32', NULL, NULL);

--
-- Дамп данных таблицы `extractors`
--

INSERT INTO `extractors` (`ename`, `inv_number`) VALUES
('1', 1);

--
-- Дамп данных таблицы `extragents`
--

INSERT INTO `extragents` (`name`, `V`, `T_vaporization`, `T_condinsasion`, `viscosity`, `density`, `molecular_mass_vap`) VALUES
('Ортоксилол', 0.5, 144, 144, 0.878, 0.76, 106.17);

--
-- Дамп данных таблицы `heaters`
--

INSERT INTO `heaters` (`id`, `type`, `power`, `effective_heating_area`, `efficiency`) VALUES
(1, 'Плитка электрическая', 1000, 15.2, '65.00');

--
-- Дамп данных таблицы `source`
--

INSERT INTO `source` (`name`, `percents`, `mass`, `average_radius`, `layer_porosity`) VALUES
('Сырье 1', 65.5, 0.05, 0.007, 0.005);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;