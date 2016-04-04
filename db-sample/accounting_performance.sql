-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 04 2016 г., 15:04
-- Версия сервера: 5.6.28-0ubuntu0.15.10.1
-- Версия PHP: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `accounting_performance`
--

-- --------------------------------------------------------

--
-- Структура таблицы `exams`
--

CREATE TABLE IF NOT EXISTS `exams` (
  `id` int(11) NOT NULL,
  `exam_title` varchar(45) DEFAULT NULL,
  `exam_type` enum('Зачёт','Экзамен') DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `exam_teacher` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `exams`
--

INSERT INTO `exams` (`id`, `exam_title`, `exam_type`, `exam_date`, `exam_teacher`) VALUES
(0, 'Физика', 'Экзамен', '2016-03-02', 'Иванов'),
(17, 'Экология', 'Зачёт', '2016-03-09', 'Петров'),
(23, 'История', 'Зачёт', '2016-03-16', 'Семенова'),
(34, 'Менеджмент', 'Экзамен', '2016-03-08', 'Семенович'),
(51525, 'Программирование на языке "РНР"', 'Экзамен', '2016-11-11', 'Чикунов');

-- --------------------------------------------------------

--
-- Структура таблицы `exams_eval`
--

CREATE TABLE IF NOT EXISTS `exams_eval` (
  `exam_id` int(11) DEFAULT NULL,
  `student` int(11) DEFAULT NULL,
  `exam_eval` varchar(45) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `exams_eval`
--

INSERT INTO `exams_eval` (`exam_id`, `student`, `exam_eval`, `id`) VALUES
(0, 1, '2', 1),
(0, 6, '5', 3),
(0, 3, '4', 4),
(34, 9, '3', 5),
(34, 10, '3', 6),
(17, 2, '3', 7),
(0, 9, '4', 10),
(23, 3, '0', 11),
(34, 3, '3', 20),
(34, 13, '2', 22);

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `group_number` int(11) NOT NULL,
  `formation_date` date NOT NULL,
  `is_delete` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`group_number`, `formation_date`, `is_delete`) VALUES
(0, '0000-00-00', ''),
(3, '2014-09-01', ''),
(5, '2015-09-01', ''),
(16, '2015-09-01', ''),
(141322, '0009-09-09', '');

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `oname` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `gradebook_number` int(11) NOT NULL,
  `income_year` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `name`, `sname`, `oname`, `birthday`, `gradebook_number`, `income_year`) VALUES
(1, 'Артур', 'Иванов', 'Иванович', '1993-01-21', 3242, '2015-09-01'),
(2, 'Василий', 'Петров', 'Алексеевич', '1992-03-04', 3475, '2015-09-01'),
(3, 'Лев', 'Толстой', 'Николаевич', '1994-01-13', 1234, '2015-09-01'),
(6, 'Илья', 'Кондаков', 'Арькадиевич', '1995-01-01', 1233, '2015-09-01'),
(9, 'Адольф', 'Ерохов', 'Леонидович', '1989-12-12', 4560, '2015-09-01'),
(10, 'Ярослав', 'Алёхин', 'Васильевич', '1994-12-12', 3952, '2015-09-01'),
(12, 'Марк', 'Ерёмин', 'Сергеевич', '1996-10-10', 4035, '2015-09-01'),
(13, 'Дмитрий', 'Медведев', 'Алексеевич', '1991-12-12', 6683, '2014-09-01');

-- --------------------------------------------------------

--
-- Структура таблицы `students_groups`
--

CREATE TABLE IF NOT EXISTS `students_groups` (
  `student` int(11) NOT NULL,
  `student_group` int(11) DEFAULT NULL,
  `starosta` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students_groups`
--

INSERT INTO `students_groups` (`student`, `student_group`, `starosta`) VALUES
(1, 5, NULL),
(2, 16, NULL),
(3, 5, NULL),
(9, 3, NULL),
(10, 16, NULL),
(12, 5, NULL),
(13, 3, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_exams_tea_idx` (`exam_teacher`);

--
-- Индексы таблицы `exams_eval`
--
ALTER TABLE `exams_eval`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_exams_eval_stu_idx` (`student`),
  ADD KEY `fk_exams_eval_exa` (`exam_id`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_number`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `students_groups`
--
ALTER TABLE `students_groups`
  ADD PRIMARY KEY (`student`),
  ADD KEY `fk_students_groups_group_idx` (`student_group`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `exams_eval`
--
ALTER TABLE `exams_eval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `exams_eval`
--
ALTER TABLE `exams_eval`
  ADD CONSTRAINT `fk_exams_eval_exa` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_exams_eval_stu` FOREIGN KEY (`student`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `students_groups`
--
ALTER TABLE `students_groups`
  ADD CONSTRAINT `fk_students_groups_group` FOREIGN KEY (`student_group`) REFERENCES `groups` (`group_number`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_students_groups_std` FOREIGN KEY (`student`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
