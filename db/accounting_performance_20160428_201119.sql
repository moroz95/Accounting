-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE DATABASE "accounting_performance" ----------------
CREATE DATABASE IF NOT EXISTS `accounting_performance` CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `accounting_performance`;
-- ---------------------------------------------------------


-- CREATE TABLE "exams" ------------------------------------
CREATE TABLE `exams` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`exam_title` VarChar( 45 ) NULL,
	`exam_type` Enum( 'Зачёт', 'Экзамен' ) NULL,
	`exam_date` Date NULL,
	`exam_teacher` VarChar( 60 ) NULL,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 51526;
-- ---------------------------------------------------------


-- CREATE TABLE "exams_eval" -------------------------------
CREATE TABLE `exams_eval` ( 
	`exam_id` Int( 11 ) NULL,
	`student` Int( 11 ) NULL,
	`exam_eval` VarChar( 45 ) NULL,
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 29;
-- ---------------------------------------------------------


-- CREATE TABLE "groups" -----------------------------------
CREATE TABLE `groups` ( 
	`group_number` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`formation_date` Date NOT NULL,
	`is_delete` VarChar( 5 ) NOT NULL,
	PRIMARY KEY ( `group_number` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 141323;
-- ---------------------------------------------------------


-- CREATE TABLE "students" ---------------------------------
CREATE TABLE `students` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 255 ) NOT NULL,
	`sname` VarChar( 255 ) NOT NULL,
	`oname` VarChar( 255 ) NOT NULL,
	`birthday` Date NOT NULL,
	`gradebook_number` Int( 11 ) NOT NULL,
	`income_year` Date NULL,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 16;
-- ---------------------------------------------------------


-- CREATE TABLE "students_groups" --------------------------
CREATE TABLE `students_groups` ( 
	`student` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`student_group` Int( 11 ) NULL,
	`starosta` VarChar( 5 ) NULL,
	PRIMARY KEY ( `student` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 14;
-- ---------------------------------------------------------


-- Dump data of "exams" ------------------------------------
INSERT INTO `exams`(`id`,`exam_title`,`exam_type`,`exam_date`,`exam_teacher`) VALUES ( '0', 'Физика', 'Экзамен', '2016-03-02', 'Иванов' );
INSERT INTO `exams`(`id`,`exam_title`,`exam_type`,`exam_date`,`exam_teacher`) VALUES ( '17', 'Экология', 'Зачёт', '2016-03-09', 'Петров' );
INSERT INTO `exams`(`id`,`exam_title`,`exam_type`,`exam_date`,`exam_teacher`) VALUES ( '23', 'История', 'Зачёт', '2016-03-16', 'Семенова' );
INSERT INTO `exams`(`id`,`exam_title`,`exam_type`,`exam_date`,`exam_teacher`) VALUES ( '34', 'Менеджмент', 'Экзамен', '2016-03-08', 'Семенович' );
INSERT INTO `exams`(`id`,`exam_title`,`exam_type`,`exam_date`,`exam_teacher`) VALUES ( '51525', 'Программирование на языке "РНР"', 'Экзамен', '2016-11-11', 'Чикунов' );
-- ---------------------------------------------------------


-- Dump data of "exams_eval" -------------------------------
INSERT INTO `exams_eval`(`exam_id`,`student`,`exam_eval`,`id`) VALUES ( '0', '1', '2', '1' );
INSERT INTO `exams_eval`(`exam_id`,`student`,`exam_eval`,`id`) VALUES ( '0', '6', '5', '3' );
INSERT INTO `exams_eval`(`exam_id`,`student`,`exam_eval`,`id`) VALUES ( '0', '3', '4', '4' );
INSERT INTO `exams_eval`(`exam_id`,`student`,`exam_eval`,`id`) VALUES ( '34', '9', '3', '5' );
INSERT INTO `exams_eval`(`exam_id`,`student`,`exam_eval`,`id`) VALUES ( '34', '10', '3', '6' );
INSERT INTO `exams_eval`(`exam_id`,`student`,`exam_eval`,`id`) VALUES ( '17', '2', '3', '7' );
INSERT INTO `exams_eval`(`exam_id`,`student`,`exam_eval`,`id`) VALUES ( '0', '9', '4', '10' );
INSERT INTO `exams_eval`(`exam_id`,`student`,`exam_eval`,`id`) VALUES ( '23', '3', '0', '11' );
INSERT INTO `exams_eval`(`exam_id`,`student`,`exam_eval`,`id`) VALUES ( '34', '3', '3', '20' );
INSERT INTO `exams_eval`(`exam_id`,`student`,`exam_eval`,`id`) VALUES ( '34', '13', '2', '22' );
-- ---------------------------------------------------------


-- Dump data of "groups" -----------------------------------
INSERT INTO `groups`(`group_number`,`formation_date`,`is_delete`) VALUES ( '0', '0000-00-00', '' );
INSERT INTO `groups`(`group_number`,`formation_date`,`is_delete`) VALUES ( '3', '2014-09-01', '' );
INSERT INTO `groups`(`group_number`,`formation_date`,`is_delete`) VALUES ( '5', '2015-09-01', '' );
INSERT INTO `groups`(`group_number`,`formation_date`,`is_delete`) VALUES ( '16', '2015-09-01', '' );
INSERT INTO `groups`(`group_number`,`formation_date`,`is_delete`) VALUES ( '141322', '0009-09-09', '' );
-- ---------------------------------------------------------


-- Dump data of "students" ---------------------------------
INSERT INTO `students`(`id`,`name`,`sname`,`oname`,`birthday`,`gradebook_number`,`income_year`) VALUES ( '1', 'Артур', 'Иванов', 'Иванович', '1993-01-21', '3242', '2015-09-01' );
INSERT INTO `students`(`id`,`name`,`sname`,`oname`,`birthday`,`gradebook_number`,`income_year`) VALUES ( '2', 'Василий', 'Петров', 'Алексеевич', '1992-03-04', '3475', '2015-09-01' );
INSERT INTO `students`(`id`,`name`,`sname`,`oname`,`birthday`,`gradebook_number`,`income_year`) VALUES ( '3', 'Лев', 'Толстой', 'Николаевич', '1994-01-13', '1234', '2015-09-01' );
INSERT INTO `students`(`id`,`name`,`sname`,`oname`,`birthday`,`gradebook_number`,`income_year`) VALUES ( '6', 'Илья', 'Кондаков', 'Арькадиевич', '1995-01-01', '1233', '2015-09-01' );
INSERT INTO `students`(`id`,`name`,`sname`,`oname`,`birthday`,`gradebook_number`,`income_year`) VALUES ( '9', 'Адольф', 'Ерохов', 'Леонидович', '1989-12-12', '4560', '2015-09-01' );
INSERT INTO `students`(`id`,`name`,`sname`,`oname`,`birthday`,`gradebook_number`,`income_year`) VALUES ( '10', 'Ярослав', 'Алёхин', 'Васильевич', '1994-12-12', '3952', '2015-09-01' );
INSERT INTO `students`(`id`,`name`,`sname`,`oname`,`birthday`,`gradebook_number`,`income_year`) VALUES ( '12', 'Марк', 'Ерёмин', 'Сергеевич', '1996-10-10', '4035', '2015-09-01' );
INSERT INTO `students`(`id`,`name`,`sname`,`oname`,`birthday`,`gradebook_number`,`income_year`) VALUES ( '13', 'Дмитрий', 'Медведев', 'Алексеевич', '1991-12-12', '6683', '2014-09-01' );
-- ---------------------------------------------------------


-- Dump data of "students_groups" --------------------------
INSERT INTO `students_groups`(`student`,`student_group`,`starosta`) VALUES ( '1', '5', NULL );
INSERT INTO `students_groups`(`student`,`student_group`,`starosta`) VALUES ( '2', '16', NULL );
INSERT INTO `students_groups`(`student`,`student_group`,`starosta`) VALUES ( '3', '5', NULL );
INSERT INTO `students_groups`(`student`,`student_group`,`starosta`) VALUES ( '9', '3', NULL );
INSERT INTO `students_groups`(`student`,`student_group`,`starosta`) VALUES ( '10', '16', NULL );
INSERT INTO `students_groups`(`student`,`student_group`,`starosta`) VALUES ( '12', '5', NULL );
INSERT INTO `students_groups`(`student`,`student_group`,`starosta`) VALUES ( '13', '3', NULL );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_exams_tea_idx" -------------------------
CREATE INDEX `fk_exams_tea_idx` USING BTREE ON `exams`( `exam_teacher` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_exams_eval_exa" ------------------------
CREATE INDEX `fk_exams_eval_exa` USING BTREE ON `exams_eval`( `exam_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_exams_eval_stu_idx" --------------------
CREATE INDEX `fk_exams_eval_stu_idx` USING BTREE ON `exams_eval`( `student` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_students_groups_group_idx" -------------
CREATE INDEX `fk_students_groups_group_idx` USING BTREE ON `students_groups`( `student_group` );
-- ---------------------------------------------------------


-- CREATE LINK "fk_exams_eval_exa" -------------------------
ALTER TABLE `exams_eval`
	ADD CONSTRAINT `fk_exams_eval_exa` FOREIGN KEY ( `exam_id` )
	REFERENCES `exams`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_exams_eval_stu" -------------------------
ALTER TABLE `exams_eval`
	ADD CONSTRAINT `fk_exams_eval_stu` FOREIGN KEY ( `student` )
	REFERENCES `students`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_students_groups_group" ------------------
ALTER TABLE `students_groups`
	ADD CONSTRAINT `fk_students_groups_group` FOREIGN KEY ( `student_group` )
	REFERENCES `groups`( `group_number` )
	ON DELETE No Action
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "fk_students_groups_std" --------------------
ALTER TABLE `students_groups`
	ADD CONSTRAINT `fk_students_groups_std` FOREIGN KEY ( `student` )
	REFERENCES `students`( `id` )
	ON DELETE Cascade
	ON UPDATE No Action;
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


