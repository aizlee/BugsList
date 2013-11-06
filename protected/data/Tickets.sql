-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 06 2013 г., 16:30
-- Версия сервера: 5.5.34-0ubuntu0.13.04.1
-- Версия PHP: 5.4.9-4ubuntu2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `Tickets`
--

-- --------------------------------------------------------

--
-- Структура таблицы `AuthAssignment`
--

CREATE TABLE IF NOT EXISTS `AuthAssignment` (
  `itemname` varchar(64) CHARACTER SET latin1 NOT NULL,
  `userid` varchar(64) CHARACTER SET latin1 NOT NULL,
  `bizrule` text CHARACTER SET latin1,
  `data` text CHARACTER SET latin1,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `AuthAssignment`
--

INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admin', '1', NULL, 'N;'),
('Authenticated', '3', NULL, 'N;'),
('Authenticated', '4', NULL, 'N;'),
('Employee', '2', NULL, 'N;');

-- --------------------------------------------------------

--
-- Структура таблицы `AuthItem`
--

CREATE TABLE IF NOT EXISTS `AuthItem` (
  `name` varchar(64) CHARACTER SET latin1 NOT NULL,
  `type` int(11) NOT NULL,
  `description` text CHARACTER SET latin1,
  `bizrule` text CHARACTER SET latin1,
  `data` text CHARACTER SET latin1,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `AuthItem`
--

INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
(' MyModel.*', 1, NULL, NULL, 'N;'),
('Admin', 2, 'Administrator', NULL, 'N;'),
('Authenticated', 2, 'Authenticated user', NULL, 'N;'),
('Bugs.*', 1, NULL, NULL, 'N;'),
('Comments.Comment.*', 1, NULL, NULL, 'N;'),
('Comments.Comment.Admin', 0, NULL, NULL, 'N;'),
('Comments.Comment.Approve', 0, NULL, NULL, 'N;'),
('Comments.Comment.Delete', 0, NULL, NULL, 'N;'),
('Comments.Comment.PostComment', 0, NULL, NULL, 'N;'),
('Employee', 2, 'Employee', NULL, 'N;'),
('File.*', 1, NULL, NULL, 'N;'),
('Files.File.*', 1, NULL, NULL, 'N;'),
('Guest', 2, 'Guest', NULL, 'N;'),
('Site.Index', 0, NULL, NULL, 'N;'),
('Tickets.*', 1, NULL, NULL, 'N;'),
('Tickets.AddClient', 0, NULL, NULL, 'N;'),
('Tickets.AddToArchive', 0, NULL, NULL, 'N;'),
('Tickets.Archive', 0, NULL, NULL, 'N;'),
('Tickets.CompleteBug', 0, NULL, NULL, 'N;'),
('Tickets.Create', 0, NULL, NULL, 'N;'),
('Tickets.Delete', 0, NULL, NULL, 'N;'),
('Tickets.GetBug', 0, NULL, NULL, 'N;'),
('Tickets.Index', 0, NULL, NULL, 'N;'),
('Tickets.MyBugs', 0, NULL, NULL, 'N;'),
('Tickets.ReturnToWork', 0, NULL, NULL, 'N;'),
('Tickets.SendMail', 0, NULL, NULL, 'N;'),
('Tickets.Update', 0, NULL, NULL, 'N;'),
('Tickets.View', 0, NULL, NULL, 'N;'),
('Upload.*', 1, NULL, NULL, 'N;'),
('Upload.Fileupload', 0, NULL, NULL, 'N;'),
('Upload.ImageUpload', 0, NULL, NULL, 'N;'),
('Upload.Listfiles', 0, NULL, NULL, 'N;'),
('Upload.Listimages', 0, NULL, NULL, 'N;'),
('User.Login.Login', 0, NULL, NULL, 'N;'),
('User.Logout.*', 1, NULL, NULL, 'N;'),
('User.Logout.Logout', 0, NULL, NULL, 'N;'),
('User.Profile.*', 1, NULL, NULL, 'N;'),
('User.Profile.Changepassword', 0, NULL, NULL, 'N;'),
('User.Profile.Edit', 0, NULL, NULL, 'N;'),
('User.Profile.Profile', 0, NULL, NULL, 'N;'),
('User.Registration.*', 1, NULL, NULL, 'N;'),
('User.Registration.Registration', 0, NULL, NULL, 'N;');

-- --------------------------------------------------------

--
-- Структура таблицы `AuthItemChild`
--

CREATE TABLE IF NOT EXISTS `AuthItemChild` (
  `parent` varchar(64) CHARACTER SET latin1 NOT NULL,
  `child` varchar(64) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `AuthItemChild`
--

INSERT INTO `AuthItemChild` (`parent`, `child`) VALUES
('Employee', 'Bugs.*'),
('Employee', 'Tickets.AddClient'),
('Employee', 'Tickets.AddToArchive'),
('Employee', 'Tickets.Archive'),
('Employee', 'Tickets.CompleteBug'),
('Employee', 'Tickets.Create'),
('Employee', 'Tickets.GetBug'),
('Employee', 'Tickets.Index'),
('Employee', 'Tickets.MyBugs'),
('Employee', 'Tickets.ReturnToWork'),
('Employee', 'Tickets.SendMail'),
('Employee', 'Tickets.Update'),
('Authenticated', 'Tickets.View'),
('Employee', 'Tickets.View'),
('Authenticated', 'Upload.*'),
('Employee', 'Upload.*'),
('Authenticated', 'Upload.Fileupload'),
('Employee', 'Upload.Fileupload'),
('Authenticated', 'Upload.ImageUpload'),
('Employee', 'Upload.ImageUpload'),
('Authenticated', 'Upload.Listfiles'),
('Employee', 'Upload.Listfiles'),
('Authenticated', 'Upload.Listimages'),
('Employee', 'Upload.Listimages'),
('Employee', 'User.Logout.*'),
('Employee', 'User.Profile.Profile'),
('Guest', 'User.Registration.*'),
('Employee', 'User.Registration.Registration'),
('Guest', 'User.Registration.Registration');

-- --------------------------------------------------------

--
-- Структура таблицы `bugs`
--

CREATE TABLE IF NOT EXISTS `bugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_employee` int(11) DEFAULT NULL COMMENT 'Сотрудник',
  `id_client` int(11) DEFAULT NULL COMMENT 'Отправитель',
  `id_creator` int(11) DEFAULT NULL,
  `address` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `receive_date` date NOT NULL COMMENT 'Дата поступления',
  `post` varchar(256) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Описание',
  `start_date` date DEFAULT NULL COMMENT 'Дата принятия',
  `complete_date` date DEFAULT NULL COMMENT 'Дата закрытия',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT 'Статус',
  PRIMARY KEY (`id`),
  KEY `FK_id_employee` (`id_employee`),
  KEY `id_client` (`id_client`),
  KEY `id_creator` (`id_creator`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=66 ;

--
-- Дамп данных таблицы `bugs`
--

INSERT INTO `bugs` (`id`, `id_employee`, `id_client`, `id_creator`, `address`, `receive_date`, `post`, `start_date`, `complete_date`, `status`) VALUES
(63, NULL, NULL, 2, 'llllkkkk.com', '2013-11-01', '<p>Ouch!!!</p>', NULL, NULL, 0),
(64, 2, 17, NULL, 'xcv', '2013-11-06', '<p><img src="/BugListSoap/uploads/bugs/post/b7f7c6503ab8535f97bfd8bdbf23cc75.png" style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px;"></p>', '2013-11-06', '2013-11-06', 3),
(65, 2, 17, NULL, 'dfgd', '2013-11-06', '<p><img src="/BugListSoap/uploads/bugs/post/5527f23bf42434026f77a6c639ec8757.png" style="font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif; font-size: 15px;">dgdfgdfg</p>', '2013-11-06', NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email',
  `last_name` char(128) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Фамилия',
  `first_name` char(128) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Имя',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `email`, `last_name`, `first_name`) VALUES
(17, 'newax90@gmail.com', 'Client', 'Client');

-- --------------------------------------------------------

--
-- Структура таблицы `Rights`
--

CREATE TABLE IF NOT EXISTS `Rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_comments`
--

CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `owner_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` int(12) NOT NULL,
  `comment_id` int(12) NOT NULL AUTO_INCREMENT,
  `parent_comment_id` int(12) DEFAULT NULL,
  `creator_id` int(12) DEFAULT NULL,
  `user_name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment_text` text COLLATE utf8_unicode_ci,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`),
  KEY `owner_name` (`owner_name`,`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `tbl_comments`
--

INSERT INTO `tbl_comments` (`owner_name`, `owner_id`, `comment_id`, `parent_comment_id`, `creator_id`, `user_name`, `user_email`, `comment_text`, `create_time`, `update_time`, `status`) VALUES
('Tickets', 43, 1, 0, 1, NULL, NULL, 'xczxc', 1383299003, NULL, 1),
('Tickets', 43, 3, 0, 2, NULL, NULL, 'cvb', 1383299090, NULL, 0),
('Tickets', 43, 4, 0, 2, NULL, NULL, 'ouch', 1383622354, NULL, 0),
('Tickets', 42, 5, NULL, NULL, 'admin', 'webmaster@example.com', 'Hi', 1383712380, NULL, 0),
('Tickets', 42, 6, NULL, NULL, 'admin', 'webmaster@example.com', 'Hi', 1383712424, NULL, 0),
('Tickets', 42, 7, NULL, NULL, 'admin', 'webmaster@example.com', 'fg', 1383712567, NULL, 0),
('Tickets', 42, 8, NULL, NULL, 'admin', 'webmaster@example.com', 'vc', 1383712593, NULL, 0),
('Tickets', 42, 9, NULL, NULL, 'admin', 'webmaster@example.com', '3', 1383712630, NULL, 0),
('Tickets', 42, 10, NULL, NULL, 'admin', 'webmaster@example.com', 'df', 1383712718, NULL, 0),
('Tickets', 42, 11, 0, 2, NULL, NULL, 'xcvxxx', 1383713017, NULL, 0),
('Tickets', 64, 12, 0, 2, NULL, NULL, 'Hi', 1383719724, NULL, 0),
('Tickets', 64, 13, NULL, NULL, 'demo', 'newax90@gmail.com', 'Q', 1383719737, 1383725409, 1),
('Tickets', 64, 14, 0, 1, NULL, NULL, 'cxvxv', 1383721989, NULL, 1),
('Tickets', 64, 15, NULL, NULL, 'demo', 'newax90@gmail.com', 'OK', 1383722687, 1383725402, 1),
('Tickets', 64, 16, NULL, NULL, 'demo', 'newax90@gmail.com', 'OK', 1383722715, NULL, 0),
('Tickets', 64, 17, NULL, NULL, 'demo', 'newax90@gmail.com', '!!!', 1383722935, NULL, 0),
('Tickets', 64, 18, NULL, NULL, 'demo', 'newax90@gmail.com', '!!!', 1383722988, NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1380704855),
('m110805_153437_installYiiUser', 1380704878),
('m110810_162301_userTimestampFix', 1380704880);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_profiles`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_profiles`
--

INSERT INTO `tbl_profiles` (`user_id`, `first_name`, `last_name`) VALUES
(1, 'Administrator', 'Admin'),
(2, 'Vasia', 'Ivanov');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_profiles_fields`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `field_type` varchar(50) NOT NULL DEFAULT '',
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` text,
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` text,
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_profiles_fields`
--

INSERT INTO `tbl_profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'first_name', 'First Name', 'VARCHAR', 255, 3, 2, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'last_name', 'Last Name', 'VARCHAR', 255, 3, 2, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 2, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  `email` varchar(128) NOT NULL DEFAULT '',
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_username` (`username`),
  UNIQUE KEY `user_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `email`, `activkey`, `superuser`, `status`, `create_at`, `lastvisit_at`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webmaster@example.com', '3475c2269e81343bb8bf9fdb39b3e50d', 1, 1, '2013-10-02 09:07:58', '2013-11-06 08:40:54'),
(2, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'newax90@gmail.com', 'efca963fdd94377d4547803f5cbbbd76', 0, 1, '2013-10-18 03:12:44', '2013-11-06 09:28:17');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `AuthAssignment`
--
ALTER TABLE `AuthAssignment`
  ADD CONSTRAINT `AuthAssignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `AuthItemChild`
--
ALTER TABLE `AuthItemChild`
  ADD CONSTRAINT `AuthItemChild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AuthItemChild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `bugs`
--
ALTER TABLE `bugs`
  ADD CONSTRAINT `bugs_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bugs_ibfk_3` FOREIGN KEY (`id_creator`) REFERENCES `tbl_profiles` (`user_id`),
  ADD CONSTRAINT `FK_id_employee` FOREIGN KEY (`id_employee`) REFERENCES `tbl_profiles` (`user_id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Rights`
--
ALTER TABLE `Rights`
  ADD CONSTRAINT `Rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tbl_profiles`
--
ALTER TABLE `tbl_profiles`
  ADD CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
