-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 12 月 13 日 18:18
-- 服务器版本: 5.5.53
-- PHP 版本: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `yii2advanced`
--

-- --------------------------------------------------------

--
-- 表的结构 `byt_admin_user`
--

CREATE TABLE IF NOT EXISTS `byt_admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `byt_admin_user`
--

INSERT INTO `byt_admin_user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `avatar`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '3BoSV_vFHI5YkXQAhgBO1Yv-LI3yl8k3', '$2y$13$IroOLoSaWnzCG8OClIwW1uH0QC5ACocDIZdVwe6/LrJUi2Hj4Kulq', NULL, 'admin@168.com', '', 10, 1513140415, 1513140415);

-- --------------------------------------------------------

--
-- 表的结构 `byt_migration`
--

CREATE TABLE IF NOT EXISTS `byt_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `byt_migration`
--

INSERT INTO `byt_migration` (`version`, `apply_time`) VALUES
('m130524_201442_init', 1513135598);

-- --------------------------------------------------------

--
-- 表的结构 `byt_user`
--

CREATE TABLE IF NOT EXISTS `byt_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `yii2advanced`.`byt_admin_roles` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` INT(11) NOT NULL DEFAULT 0,
  `role_name` VARCHAR(255) NOT NULL,
  `remark` VARCHAR(255) NULL,
  `created_at` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE `yii2advanced`.`byt_admin_role_user` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `role_id` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE TABLE `yii2advanced`.`byt_attachment` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL DEFAULT 0,
  `table_id` INT(11) NULL DEFAULT 0 COMMENT '关联表id',
  `filename` VARCHAR(255) NULL COMMENT '文件名称',
  `filetype` VARCHAR(45) NULL DEFAULT NULL COMMENT '文件类型',
  `extension` VARCHAR(45) NULL DEFAULT NULL COMMENT '文件后缀名',
  `filesize` INT(11) NULL DEFAULT 0,
  `filesizecn` VARCHAR(30) NULL DEFAULT NULL COMMENT '文件大小中文面描述(1KB,1MB...)',
  `filepath` VARCHAR(255) NULL DEFAULT NULL COMMENT '文件保存路径',
  `ip` VARCHAR(30) NULL DEFAULT NULL COMMENT '上传的IP',
  `web` VARCHAR(255) NULL DEFAULT NULL COMMENT '上传的环境',
  `downci` INT(11) NULL DEFAULT 0 COMMENT '文件下载次数',
  `created_at` INT(10) NULL,
  `updated_at` INT(10) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC),
  UNIQUE INDEX `table_id_UNIQUE` (`table_id` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = '附件表';