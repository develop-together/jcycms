-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-07-05 15:14:06
-- 服务器版本： 5.5.53
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jcycms`
--

-- --------------------------------------------------------

--
-- 表的结构 `byt_admin_log`
--

CREATE TABLE `byt_admin_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '操作人',
  `route` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '路由',
  `description` text CHARACTER SET utf8mb4 COMMENT '描述',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `updated_at` int(11) DEFAULT '0' COMMENT '修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='操作日志';

--
-- 转存表中的数据 `byt_admin_log`
--

INSERT INTO `byt_admin_log` (`id`, `user_id`, `route`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'friend-link/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\FriendLink [ {{%friend_link}} ]  {{%UPDATED%}} {{%ID%}} 3 {{%RECORD%}}: <br>最后更新(updated_at) : 1523794935=>1523802101', 1523802102, 1523802102),
(2, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 18 {{%RECORD%}}: <br>父分类Id(parent_id) : 0=>,<br>地址(url) : log/index=>admin-log/index,<br>排序(sort) : 9=>0,<br>最后更新(updated_at) : 1488804401=>1523802402', 1523802402, 1523802402),
(3, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>地址(url) : setting/website=>config/index,<br>排序(sort) : 1=>0,<br>最后更新(updated_at) : 1488802684=>1523978816', 1523978817, 1523978817),
(4, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 3 {{%RECORD%}}: <br>地址(url) : setting/smtp=>config/smtp,<br>排序(sort) : 3=>0,<br>最后更新(updated_at) : 1488802721=>1523978835', 1523978835, 1523978835),
(5, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 4 {{%RECORD%}}: <br>地址(url) : setting/custom=>config/custom,<br>排序(sort) : 5=>0,<br>最后更新(updated_at) : 1488802781=>1523978848', 1523978848, 1523978848),
(6, 1, 'admin-user/update-self', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : cqPcDcIZReMvKklIPgmCY5HIWCZfNPR8=>BnsrUDqCemKXM0yTDMEmy5PGvR_0Zh-z,<br>Password Hash(password_hash) : $2y$13$hBEvJJrnEj07OuPH/GHZ..BB2hYQ8wtc1Lm.M4g9xZA90pKIjNZ/m=>$2y$13$CsbYy3W4AUf5RM8vjp9CYO/Jiz.gw5jCUwAYyCOoela.SYARrbINS,<br>最后更新(updated_at) : 1521864627=>1524760337', 1524760337, 1524760337),
(7, 1, 'admin-user/update-self', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : BnsrUDqCemKXM0yTDMEmy5PGvR_0Zh-z=>xJWWW3Ogm_NUuA7Mv3vFf0gVgsYoyg9R,<br>Password Hash(password_hash) : $2y$13$CsbYy3W4AUf5RM8vjp9CYO/Jiz.gw5jCUwAYyCOoela.SYARrbINS=>$2y$13$jqgDCLFPQWaOAQ.yJymqKeA0upi877Qiqpq4zfQkuCLo0sTI4/zfu,<br>最后更新(updated_at) : 1524760337=>1524760390', 1524760390, 1524760390),
(8, 1, 'admin-user/update-self', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : xJWWW3Ogm_NUuA7Mv3vFf0gVgsYoyg9R=>kA4IfulEqmR1AwyMaOlIorWmESPiJLk9,<br>Password Hash(password_hash) : $2y$13$jqgDCLFPQWaOAQ.yJymqKeA0upi877Qiqpq4zfQkuCLo0sTI4/zfu=>$2y$13$JGcJ0RS8x4HFqGDk84IE4OtBDjZ/dl7ZdWAOOo9sUUIcW8H/AeQqO,<br>最后更新(updated_at) : 1524760390=>1524760425', 1524760425, 1524760425),
(9, 1, 'admin-user/update-self', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : kA4IfulEqmR1AwyMaOlIorWmESPiJLk9=>koSKSl6bxaB1BbhmKE3bk8TluKsvVPVa,<br>Password Hash(password_hash) : $2y$13$JGcJ0RS8x4HFqGDk84IE4OtBDjZ/dl7ZdWAOOo9sUUIcW8H/AeQqO=>$2y$13$..EYQULuWiEDksO4qHZG5OJRaQM6vHCYjOTbXJL2v5reqYk0n186e,<br>最后更新(updated_at) : 1524760425=>1524760514', 1524760514, 1524760514),
(10, 1, 'admin-user/update-self', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : koSKSl6bxaB1BbhmKE3bk8TluKsvVPVa=>T331AK6RyhJ6bzUw4aammYHUXYHmJoC0,<br>Password Hash(password_hash) : $2y$13$..EYQULuWiEDksO4qHZG5OJRaQM6vHCYjOTbXJL2v5reqYk0n186e=>$2y$13$8G0fTBWQBvtMXNof.CfkKe4er5B5QKmFBFulo7B8/bqzSIy7tzgAS,<br>最后更新(updated_at) : 1524760514=>1524760548', 1524760548, 1524760548),
(11, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 9 {{%RECORD%}}: <br>名称(name) : 资讯=>文章,<br>最后更新(updated_at) : 1507707569=>1525142500', 1525142500, 1525142500),
(12, 1, 'admin-user/update-self', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : ynCvTiVcD_LU-rUsW39IjvbuTFWLLt1I=>mHitkn5ulf0ImOVZxKm0HdKK_kJeUDmY,<br>Password Hash(password_hash) : $2y$13$A3ztSFzEE5JqdVTt3FdNoOtF9r.73KG/oqBcNqqxOTSDaIBD2Xnda=>$2y$13$zmPR/hbJPRQ6Ec5iimDVMO1c194sFggXBmJa37aBMuW4mEnhbX27C,<br>最后更新(updated_at) : 1524760548=>1525537158', 1525537158, 1525537158),
(13, 1, 'menu/delete', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%DELETED%}} {{%ID%}} 4 {{%RECORD%}}: <br>序号(id) => 4,<br>类型(type) => 0,<br>父分类Id(parent_id) => 1,<br>名称(name) => 自定义设置,<br>地址(url) => config/custom,<br>图标(icon) => ,<br>排序(sort) => 0,<br>窗口打开方式(target) => _blank,<br>绝对地址(is_absolute_url) => 0,<br>是否显示(is_display) => 1,<br>请求方式(method) => 1,<br>创建时间(created_at) => 1470064600,<br>最后更新(updated_at) => 1523978848', 1525537751, 1525537751),
(14, 1, 'upload/images-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 15 {{%RECORD%}}: <br>编号(id) => 15,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a1.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 40994,<br>文件大小(filesizecn) => 40.03 KB,<br>文件路径(filepath) => 20180506/56d57a01fa9a5aae36b77006b51ef034.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525611637,<br>最后更新(updated_at) => 1525611637', 1525611638, 1525611638),
(15, 1, 'upload/images-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 16 {{%RECORD%}}: <br>编号(id) => 16,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => 20180506/ff2bfeee47618745d3ba184f1e666e15.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525611666,<br>最后更新(updated_at) => 1525611666', 1525611667, 1525611667),
(16, 1, 'upload/images-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 17 {{%RECORD%}}: <br>编号(id) => 17,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => 20180506/4548fa1a7845e1aa28628f8ca4280e4e.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525611668,<br>最后更新(updated_at) => 1525611668', 1525611668, 1525611668),
(17, 1, 'upload/images-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 18 {{%RECORD%}}: <br>编号(id) => 18,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => 20180506/36eb76977367dc34e5fd65b117e25c4c.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525612646,<br>最后更新(updated_at) => 1525612646', 1525612647, 1525612647),
(18, 1, 'upload/images-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 19 {{%RECORD%}}: <br>编号(id) => 19,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => 20180506/1deac3234366babe3d8889ead79feb2f.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525612648,<br>最后更新(updated_at) => 1525612648', 1525612648, 1525612648),
(19, 1, 'upload/images-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 20 {{%RECORD%}}: <br>编号(id) => 20,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => 20180506/6cae1179ff4fd8943384e06c544dc7a9.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525612740,<br>最后更新(updated_at) => 1525612740', 1525612740, 1525612740),
(20, 1, 'upload/images-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 21 {{%RECORD%}}: <br>编号(id) => 21,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => 20180506/f94ebd5f8e74c720ace083881ab9f613.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525612742,<br>最后更新(updated_at) => 1525612742', 1525612742, 1525612742),
(21, 1, 'upload/images-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 22 {{%RECORD%}}: <br>编号(id) => 22,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => 20180506/610147e95f4a8c5160a0f763e24042f3.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525612840,<br>最后更新(updated_at) => 1525612840', 1525612840, 1525612840),
(22, 1, 'upload/images-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 23 {{%RECORD%}}: <br>编号(id) => 23,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => 20180506/aa8f41f5bc0717650b20323e6f95ff51.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525612841,<br>最后更新(updated_at) => 1525612841', 1525612842, 1525612842),
(23, 1, 'upload/images-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 24 {{%RECORD%}}: <br>编号(id) => 24,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => 20180506/e9d375872bf0a99fde6516e84987b3a7.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525612912,<br>最后更新(updated_at) => 1525612912', 1525612912, 1525612912),
(24, 1, 'upload/images-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 25 {{%RECORD%}}: <br>编号(id) => 25,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => 20180506/8a10b642eda006e480860d3deb2206fa.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525612914,<br>最后更新(updated_at) => 1525612914', 1525612914, 1525612914),
(25, 1, 'upload/images-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 26 {{%RECORD%}}: <br>编号(id) => 26,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => 20180506/e630a5b6136d9ba6b0002fb9448620db.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525613083,<br>最后更新(updated_at) => 1525613083', 1525613083, 1525613083),
(26, 1, 'upload/images-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 27 {{%RECORD%}}: <br>编号(id) => 27,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => 20180506/ed22cc6fe8f3a3c94993de5a7d1dbab9.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525613084,<br>最后更新(updated_at) => 1525613084', 1525613084, 1525613084),
(27, 1, 'upload/images-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 28 {{%RECORD%}}: <br>编号(id) => 28,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => 20180506/c91dea819af94c7c5a34e53455965f74.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525613662,<br>最后更新(updated_at) => 1525613662', 1525613663, 1525613663),
(28, 1, 'upload/images-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 29 {{%RECORD%}}: <br>编号(id) => 29,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => 20180506/fa5d78e9c5b1bb1dc7fd03c1db67faa9.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525613664,<br>最后更新(updated_at) => 1525613664', 1525613664, 1525613664),
(29, 1, 'upload/images-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 30 {{%RECORD%}}: <br>编号(id) => 30,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => 20180506/6626244df1c686bc947be2072c4117b9.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525614327,<br>最后更新(updated_at) => 1525614327', 1525614327, 1525614327),
(30, 1, 'upload/images-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 31 {{%RECORD%}}: <br>编号(id) => 31,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => 20180506/1bef34d66b63e3046c7767cb76b494a3.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525614329,<br>最后更新(updated_at) => 1525614329', 1525614329, 1525614329),
(31, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 32 {{%RECORD%}}: <br>编号(id) => 32,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a1.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 40994,<br>文件大小(filesizecn) => 40.03 KB,<br>文件路径(filepath) => 20180506/1eb40aa67c51782442dc1634ce503ef2.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525614755,<br>最后更新(updated_at) => 1525614755', 1525614755, 1525614755),
(33, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 33 {{%RECORD%}}: <br>编号(id) => 33,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a1.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 40994,<br>文件大小(filesizecn) => 40.03 KB,<br>文件路径(filepath) => 20180506/69d21257c7d60d20b05ee688236ba918.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525614913,<br>最后更新(updated_at) => 1525614913', 1525614913, 1525614913),
(34, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 34 {{%RECORD%}}: <br>编号(id) => 34,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => 20180506/6577f97a7e2f26ad095e0f83f0bb4106.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525614930,<br>最后更新(updated_at) => 1525614930', 1525614931, 1525614931),
(35, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 35 {{%RECORD%}}: <br>编号(id) => 35,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a1.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 40994,<br>文件大小(filesizecn) => 40.03 KB,<br>文件路径(filepath) => 20180506/b8003435e2a3a6810b60c48fb4dc761e.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525616844,<br>最后更新(updated_at) => 1525616844', 1525616844, 1525616844),
(36, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 36 {{%RECORD%}}: <br>编号(id) => 36,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a3.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 50346,<br>文件大小(filesizecn) => 49.17 KB,<br>文件路径(filepath) => 20180506/50228543dfba01ea50ddb3e90d93fcb7.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525616851,<br>最后更新(updated_at) => 1525616851', 1525616851, 1525616851),
(37, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 37 {{%RECORD%}}: <br>编号(id) => 37,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a5.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 16274,<br>文件大小(filesizecn) => 15.89 KB,<br>文件路径(filepath) => 20180506/89ffd865b629c5e7fe049d5ee4d6f3b2.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525617039,<br>最后更新(updated_at) => 1525617039', 1525617039, 1525617039),
(38, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 38 {{%RECORD%}}: <br>编号(id) => 38,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => login-background.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 142718,<br>文件大小(filesizecn) => 139.37 KB,<br>文件路径(filepath) => 20180506/d9e9ff5ad201a14834521027e415299d.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525617278,<br>最后更新(updated_at) => 1525617278', 1525617278, 1525617278),
(39, 1, 'menu/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%CREATED%}} {{%ID%}} 115 {{%RECORD%}}: <br>序号(id) => 115,<br>类型(type) => ,<br>父分类Id(parent_id) => 8,<br>名称(name) => 相册,<br>地址(url) => photos/index,<br>图标(icon) => fa-photo,<br>排序(sort) => 3,<br>窗口打开方式(target) => _blank,<br>绝对地址(is_absolute_url) => 0,<br>是否显示(is_display) => 1,<br>请求方式(method) => 1,<br>创建时间(created_at) => 1525705021,<br>最后更新(updated_at) => 1525705021', 1525705021, 1525705021),
(40, 1, 'menu/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%CREATED%}} {{%ID%}} 116 {{%RECORD%}}: <br>序号(id) => 116,<br>类型(type) => ,<br>父分类Id(parent_id) => 8,<br>名称(name) => 相册:创建,<br>地址(url) => photos/create,<br>图标(icon) => ,<br>排序(sort) => 3,<br>窗口打开方式(target) => _blank,<br>绝对地址(is_absolute_url) => 0,<br>是否显示(is_display) => 1,<br>请求方式(method) => 1,<br>创建时间(created_at) => 1525705610,<br>最后更新(updated_at) => 1525705610', 1525705610, 1525705610),
(41, 1, 'menu/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%CREATED%}} {{%ID%}} 117 {{%RECORD%}}: <br>序号(id) => 117,<br>类型(type) => ,<br>父分类Id(parent_id) => 8,<br>名称(name) => 相册:修改,<br>地址(url) => photos/update,<br>图标(icon) => ,<br>排序(sort) => ,<br>窗口打开方式(target) => ,<br>绝对地址(is_absolute_url) => 0,<br>是否显示(is_display) => 1,<br>请求方式(method) => 1,<br>创建时间(created_at) => 1525705957,<br>最后更新(updated_at) => 1525705957', 1525705957, 1525705957),
(42, 1, 'menu/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%CREATED%}} {{%ID%}} 118 {{%RECORD%}}: <br>序号(id) => 118,<br>类型(type) => ,<br>父分类Id(parent_id) => 8,<br>名称(name) => 相册:删除,<br>地址(url) => photos/delete,<br>图标(icon) => ,<br>排序(sort) => ,<br>窗口打开方式(target) => ,<br>绝对地址(is_absolute_url) => 0,<br>是否显示(is_display) => 1,<br>请求方式(method) => 1,<br>创建时间(created_at) => 1525706024,<br>最后更新(updated_at) => 1525706024', 1525706024, 1525706024),
(43, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 115 {{%RECORD%}}: <br>排序(sort) : 3=>201,<br>最后更新(updated_at) : 1525705021=>1525706374', 1525706374, 1525706374),
(44, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 116 {{%RECORD%}}: <br>排序(sort) : 3=>201,<br>最后更新(updated_at) : 1525705610=>1525706408', 1525706408, 1525706408),
(45, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 117 {{%RECORD%}}: <br>排序(sort) : 0=>201,<br>最后更新(updated_at) : 1525705957=>1525706519', 1525706519, 1525706519),
(46, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 118 {{%RECORD%}}: <br>排序(sort) : 0=>201,<br>最后更新(updated_at) : 1525706024=>1525706534', 1525706534, 1525706534),
(47, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 118 {{%RECORD%}}: <br>最后更新(updated_at) : 1525706534=>1525706787', 1525706787, 1525706787),
(48, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 118 {{%RECORD%}}: <br>最后更新(updated_at) : 1525706787=>1525706851', 1525706851, 1525706851),
(49, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 118 {{%RECORD%}}: <br>最后更新(updated_at) : 1525706851=>1525706874', 1525706874, 1525706874),
(50, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 118 {{%RECORD%}}: <br>最后更新(updated_at) : 1525706874=>1525706922', 1525706923, 1525706923),
(51, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 118 {{%RECORD%}}: <br>最后更新(updated_at) : 1525706922=>1525707003', 1525707003, 1525707003),
(52, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 118 {{%RECORD%}}: <br>最后更新(updated_at) : 1525707003=>1525707028', 1525707028, 1525707028),
(53, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 118 {{%RECORD%}}: <br>最后更新(updated_at) : 1525707028=>1525707052', 1525707052, 1525707052),
(54, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 118 {{%RECORD%}}: <br>最后更新(updated_at) : 1525707052=>1525707097', 1525707097, 1525707097),
(55, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 118 {{%RECORD%}}: <br>最后更新(updated_at) : 1525707097=>1525707123', 1525707123, 1525707123),
(56, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 289 {{%RECORD%}}: <br>序号(id) => 289,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 8,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(57, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 290 {{%RECORD%}}: <br>序号(id) => 290,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 9,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(58, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 291 {{%RECORD%}}: <br>序号(id) => 291,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 98,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(59, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 292 {{%RECORD%}}: <br>序号(id) => 292,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 47,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(60, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 293 {{%RECORD%}}: <br>序号(id) => 293,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 48,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(61, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 294 {{%RECORD%}}: <br>序号(id) => 294,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 49,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(62, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 295 {{%RECORD%}}: <br>序号(id) => 295,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 50,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(63, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 296 {{%RECORD%}}: <br>序号(id) => 296,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 51,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(64, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 297 {{%RECORD%}}: <br>序号(id) => 297,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 103,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(65, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 298 {{%RECORD%}}: <br>序号(id) => 298,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 10,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(66, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 299 {{%RECORD%}}: <br>序号(id) => 299,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 52,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(67, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 300 {{%RECORD%}}: <br>序号(id) => 300,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 53,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(68, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 301 {{%RECORD%}}: <br>序号(id) => 301,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 99,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(69, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 302 {{%RECORD%}}: <br>序号(id) => 302,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 54,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(70, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 303 {{%RECORD%}}: <br>序号(id) => 303,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 55,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(71, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 304 {{%RECORD%}}: <br>序号(id) => 304,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 56,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(72, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 305 {{%RECORD%}}: <br>序号(id) => 305,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 57,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(73, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 306 {{%RECORD%}}: <br>序号(id) => 306,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 58,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(74, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 307 {{%RECORD%}}: <br>序号(id) => 307,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 59,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(75, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 308 {{%RECORD%}}: <br>序号(id) => 308,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 104,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(76, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 309 {{%RECORD%}}: <br>序号(id) => 309,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 60,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(77, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 310 {{%RECORD%}}: <br>序号(id) => 310,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 61,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(78, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 311 {{%RECORD%}}: <br>序号(id) => 311,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 62,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(79, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 312 {{%RECORD%}}: <br>序号(id) => 312,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 63,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(80, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 313 {{%RECORD%}}: <br>序号(id) => 313,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 64,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(81, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 314 {{%RECORD%}}: <br>序号(id) => 314,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 100,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(82, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 315 {{%RECORD%}}: <br>序号(id) => 315,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 12,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(83, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 316 {{%RECORD%}}: <br>序号(id) => 316,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 11,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(84, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 317 {{%RECORD%}}: <br>序号(id) => 317,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 13,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(85, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 318 {{%RECORD%}}: <br>序号(id) => 318,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 25,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(86, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 319 {{%RECORD%}}: <br>序号(id) => 319,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 15,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1522688117,<br>最后更新(updated_at) => 1522688117', 1525707171, 1525707171),
(87, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 320 {{%RECORD%}}: <br>序号(id) => 320,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 8,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(88, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 321 {{%RECORD%}}: <br>序号(id) => 321,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 9,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(89, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 322 {{%RECORD%}}: <br>序号(id) => 322,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 98,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(90, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 323 {{%RECORD%}}: <br>序号(id) => 323,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 47,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(91, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 324 {{%RECORD%}}: <br>序号(id) => 324,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 48,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(92, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 325 {{%RECORD%}}: <br>序号(id) => 325,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 49,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(93, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 326 {{%RECORD%}}: <br>序号(id) => 326,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 50,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(94, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 327 {{%RECORD%}}: <br>序号(id) => 327,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 51,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(95, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 328 {{%RECORD%}}: <br>序号(id) => 328,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 103,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(96, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 329 {{%RECORD%}}: <br>序号(id) => 329,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 10,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(97, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 330 {{%RECORD%}}: <br>序号(id) => 330,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 52,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(98, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 331 {{%RECORD%}}: <br>序号(id) => 331,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 53,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(99, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 332 {{%RECORD%}}: <br>序号(id) => 332,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 99,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(100, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 333 {{%RECORD%}}: <br>序号(id) => 333,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 54,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(101, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 334 {{%RECORD%}}: <br>序号(id) => 334,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 55,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(102, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 335 {{%RECORD%}}: <br>序号(id) => 335,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 56,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(103, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 336 {{%RECORD%}}: <br>序号(id) => 336,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 57,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(104, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 337 {{%RECORD%}}: <br>序号(id) => 337,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 58,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(105, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 338 {{%RECORD%}}: <br>序号(id) => 338,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 59,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(106, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 339 {{%RECORD%}}: <br>序号(id) => 339,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 104,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(107, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 340 {{%RECORD%}}: <br>序号(id) => 340,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 60,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(108, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 341 {{%RECORD%}}: <br>序号(id) => 341,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 61,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(109, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 342 {{%RECORD%}}: <br>序号(id) => 342,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 62,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(110, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 343 {{%RECORD%}}: <br>序号(id) => 343,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 63,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(111, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 344 {{%RECORD%}}: <br>序号(id) => 344,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 64,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(112, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 345 {{%RECORD%}}: <br>序号(id) => 345,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 100,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(113, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 346 {{%RECORD%}}: <br>序号(id) => 346,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 12,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(114, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 347 {{%RECORD%}}: <br>序号(id) => 347,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 11,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(115, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 348 {{%RECORD%}}: <br>序号(id) => 348,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 115,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(116, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 349 {{%RECORD%}}: <br>序号(id) => 349,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 116,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(117, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 350 {{%RECORD%}}: <br>序号(id) => 350,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 117,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(118, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 351 {{%RECORD%}}: <br>序号(id) => 351,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 118,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(119, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 352 {{%RECORD%}}: <br>序号(id) => 352,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 13,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(120, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 353 {{%RECORD%}}: <br>序号(id) => 353,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 25,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(121, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 354 {{%RECORD%}}: <br>序号(id) => 354,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 15,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707171, 1525707171),
(122, 1, 'menu/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%CREATED%}} {{%ID%}} 119 {{%RECORD%}}: <br>序号(id) => 119,<br>类型(type) => ,<br>父分类Id(parent_id) => 13,<br>名称(name) => 相册:创建:确定,<br>地址(url) => photos/create,<br>图标(icon) => ,<br>排序(sort) => 201,<br>窗口打开方式(target) => ,<br>绝对地址(is_absolute_url) => 0,<br>是否显示(is_display) => 1,<br>请求方式(method) => 1,<br>创建时间(created_at) => 1525707251,<br>最后更新(updated_at) => 1525707251', 1525707251, 1525707251),
(123, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 119 {{%RECORD%}}: <br>是否显示(is_display) : 1=>0,<br>最后更新(updated_at) : 1525707251=>1525707293', 1525707294, 1525707294),
(124, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 118 {{%RECORD%}}: <br>是否显示(is_display) : 1=>0,<br>最后更新(updated_at) : 1525707123=>1525707303', 1525707304, 1525707304),
(125, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 116 {{%RECORD%}}: <br>是否显示(is_display) : 1=>0,<br>最后更新(updated_at) : 1525706408=>1525707317', 1525707317, 1525707317);
INSERT INTO `byt_admin_log` (`id`, `user_id`, `route`, `description`, `created_at`, `updated_at`) VALUES
(126, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 117 {{%RECORD%}}: <br>是否显示(is_display) : 1=>0,<br>最后更新(updated_at) : 1525706519=>1525707388', 1525707388, 1525707388),
(127, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 119 {{%RECORD%}}: <br>请求方式(method) : 1=>2,<br>最后更新(updated_at) : 1525707293=>1525707406', 1525707406, 1525707406),
(128, 1, 'menu/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%CREATED%}} {{%ID%}} 120 {{%RECORD%}}: <br>序号(id) => 120,<br>类型(type) => ,<br>父分类Id(parent_id) => 8,<br>名称(name) => 相册:修改:确定,<br>地址(url) => photos/update,<br>图标(icon) => ,<br>排序(sort) => 201,<br>窗口打开方式(target) => ,<br>绝对地址(is_absolute_url) => 0,<br>是否显示(is_display) => 0,<br>请求方式(method) => 2,<br>创建时间(created_at) => 1525707461,<br>最后更新(updated_at) => 1525707461', 1525707461, 1525707461),
(129, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 119 {{%RECORD%}}: <br>父分类Id(parent_id) : 13=>8,<br>最后更新(updated_at) : 1525707406=>1525707592', 1525707592, 1525707592),
(130, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 320 {{%RECORD%}}: <br>序号(id) => 320,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 8,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(131, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 321 {{%RECORD%}}: <br>序号(id) => 321,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 9,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(132, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 322 {{%RECORD%}}: <br>序号(id) => 322,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 98,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(133, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 323 {{%RECORD%}}: <br>序号(id) => 323,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 47,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(134, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 324 {{%RECORD%}}: <br>序号(id) => 324,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 48,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(135, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 325 {{%RECORD%}}: <br>序号(id) => 325,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 49,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(136, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 326 {{%RECORD%}}: <br>序号(id) => 326,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 50,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(137, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 327 {{%RECORD%}}: <br>序号(id) => 327,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 51,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(138, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 328 {{%RECORD%}}: <br>序号(id) => 328,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 103,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(139, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 329 {{%RECORD%}}: <br>序号(id) => 329,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 10,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(140, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 330 {{%RECORD%}}: <br>序号(id) => 330,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 52,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(141, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 331 {{%RECORD%}}: <br>序号(id) => 331,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 53,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(142, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 332 {{%RECORD%}}: <br>序号(id) => 332,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 99,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(143, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 333 {{%RECORD%}}: <br>序号(id) => 333,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 54,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(144, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 334 {{%RECORD%}}: <br>序号(id) => 334,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 55,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(145, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 335 {{%RECORD%}}: <br>序号(id) => 335,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 56,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(146, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 336 {{%RECORD%}}: <br>序号(id) => 336,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 57,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(147, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 337 {{%RECORD%}}: <br>序号(id) => 337,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 58,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(148, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 338 {{%RECORD%}}: <br>序号(id) => 338,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 59,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(149, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 339 {{%RECORD%}}: <br>序号(id) => 339,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 104,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(150, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 340 {{%RECORD%}}: <br>序号(id) => 340,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 60,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(151, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 341 {{%RECORD%}}: <br>序号(id) => 341,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 61,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(152, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 342 {{%RECORD%}}: <br>序号(id) => 342,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 62,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(153, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 343 {{%RECORD%}}: <br>序号(id) => 343,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 63,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(154, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 344 {{%RECORD%}}: <br>序号(id) => 344,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 64,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(155, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 345 {{%RECORD%}}: <br>序号(id) => 345,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 100,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(156, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 346 {{%RECORD%}}: <br>序号(id) => 346,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 12,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(157, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 347 {{%RECORD%}}: <br>序号(id) => 347,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 11,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(158, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 348 {{%RECORD%}}: <br>序号(id) => 348,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 115,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(159, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 349 {{%RECORD%}}: <br>序号(id) => 349,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 116,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(160, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 350 {{%RECORD%}}: <br>序号(id) => 350,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 117,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(161, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 351 {{%RECORD%}}: <br>序号(id) => 351,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 118,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(162, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 352 {{%RECORD%}}: <br>序号(id) => 352,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 13,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(163, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 353 {{%RECORD%}}: <br>序号(id) => 353,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 25,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(164, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%DELETED%}} {{%ID%}} 354 {{%RECORD%}}: <br>序号(id) => 354,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 15,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707171,<br>最后更新(updated_at) => 1525707171', 1525707609, 1525707609),
(165, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 355 {{%RECORD%}}: <br>序号(id) => 355,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 8,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(166, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 356 {{%RECORD%}}: <br>序号(id) => 356,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 9,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(167, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 357 {{%RECORD%}}: <br>序号(id) => 357,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 98,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(168, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 358 {{%RECORD%}}: <br>序号(id) => 358,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 47,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(169, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 359 {{%RECORD%}}: <br>序号(id) => 359,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 48,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(170, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 360 {{%RECORD%}}: <br>序号(id) => 360,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 49,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(171, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 361 {{%RECORD%}}: <br>序号(id) => 361,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 50,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(172, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 362 {{%RECORD%}}: <br>序号(id) => 362,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 51,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(173, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 363 {{%RECORD%}}: <br>序号(id) => 363,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 103,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(174, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 364 {{%RECORD%}}: <br>序号(id) => 364,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 10,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(175, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 365 {{%RECORD%}}: <br>序号(id) => 365,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 52,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(176, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 366 {{%RECORD%}}: <br>序号(id) => 366,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 53,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(177, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 367 {{%RECORD%}}: <br>序号(id) => 367,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 99,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(178, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 368 {{%RECORD%}}: <br>序号(id) => 368,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 54,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(179, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 369 {{%RECORD%}}: <br>序号(id) => 369,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 55,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(180, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 370 {{%RECORD%}}: <br>序号(id) => 370,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 56,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(181, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 371 {{%RECORD%}}: <br>序号(id) => 371,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 57,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(182, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 372 {{%RECORD%}}: <br>序号(id) => 372,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 58,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(183, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 373 {{%RECORD%}}: <br>序号(id) => 373,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 59,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(184, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 374 {{%RECORD%}}: <br>序号(id) => 374,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 104,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(185, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 375 {{%RECORD%}}: <br>序号(id) => 375,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 60,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(186, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 376 {{%RECORD%}}: <br>序号(id) => 376,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 61,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(187, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 377 {{%RECORD%}}: <br>序号(id) => 377,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 62,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(188, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 378 {{%RECORD%}}: <br>序号(id) => 378,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 63,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(189, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 379 {{%RECORD%}}: <br>序号(id) => 379,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 64,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(190, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 380 {{%RECORD%}}: <br>序号(id) => 380,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 100,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(191, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 381 {{%RECORD%}}: <br>序号(id) => 381,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 12,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(192, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 382 {{%RECORD%}}: <br>序号(id) => 382,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 11,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(193, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 383 {{%RECORD%}}: <br>序号(id) => 383,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 115,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(194, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 384 {{%RECORD%}}: <br>序号(id) => 384,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 116,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(195, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 385 {{%RECORD%}}: <br>序号(id) => 385,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 117,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(196, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 386 {{%RECORD%}}: <br>序号(id) => 386,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 118,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(197, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 387 {{%RECORD%}}: <br>序号(id) => 387,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 119,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(198, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 388 {{%RECORD%}}: <br>序号(id) => 388,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 120,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(199, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 389 {{%RECORD%}}: <br>序号(id) => 389,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 13,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(200, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 390 {{%RECORD%}}: <br>序号(id) => 390,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 25,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(201, 1, 'admin-roles/assign', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\AdminRolePermission [ {{%admin_role_permission}} ]  {{%CREATED%}} {{%ID%}} 391 {{%RECORD%}}: <br>序号(id) => 391,<br>Role Id(role_id) => 2,<br>Menu Id(menu_id) => 15,<br>使用ID(opt_id) => 1,<br>创建时间(created_at) => 1525707609,<br>最后更新(updated_at) => 1525707609', 1525707609, 1525707609),
(202, 1, 'category/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Category [ {{%category}} ]  {{%CREATED%}} {{%ID%}} 6 {{%RECORD%}}: <br>序号(id) => 6,<br>父分类Id(parent_id) => 0,<br>名称(name) => 明星,<br>排序(sort) => 4,<br>备注(remark) => ,<br>创建时间(created_at) => 1525709831,<br>最后更新(updated_at) => 1525709831', 1525709831, 1525709831),
(203, 1, 'category/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\Category [ {{%category}} ]  {{%CREATED%}} {{%ID%}} 7 {{%RECORD%}}: <br>序号(id) => 7,<br>父分类Id(parent_id) => 0,<br>名称(name) => 美女,<br>排序(sort) => 5,<br>备注(remark) => ,<br>创建时间(created_at) => 1525709853,<br>最后更新(updated_at) => 1525709853', 1525709853, 1525709853),
(218, 1, 'photos/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 9 {{%RECORD%}}: <br>编号(id) => 9,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a7.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 10399,<br>文件大小(filesizecn) => 10.16 KB,<br>文件路径(filepath) => /uploads/thumb/20180511/1525968791-5af46f97c3dee_a7.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525968791,<br>最后更新(updated_at) => 1525968791', 1525968791, 1525968791),
(219, 1, 'photos/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 10 {{%RECORD%}}: <br>编号(id) => 10,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a8.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 10758,<br>文件大小(filesizecn) => 10.51 KB,<br>文件路径(filepath) => /uploads/thumb/20180511/1525968791-5af46f97cde19_a8.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525968791,<br>最后更新(updated_at) => 1525968791', 1525968791, 1525968791),
(220, 1, 'photos/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\PhotosArticle [ {{%article}} ]  {{%CREATED%}} {{%ID%}} 8 {{%RECORD%}}: <br>序号(id) => 8,<br>分类(category_id) => ,<br>类型(type) => 3,<br>标题(title) => 赵丽颖,<br>副标题(sub_title) => 大腕,<br>概述(summary) => ,<br>缩略图(thumb) => ,<br>seo标题(seo_title) => 赵丽颖,<br>seo关键字(seo_keywords) => 赵丽颖,明星,<br>seo描述(seo_description) => 关于赵丽颖的照片,<br>状态(status) => 1,<br>排序(sort) => ,<br>作者(user_id) => 1,<br>Scan Count(scan_count) => ,<br>评论(can_comment) => 1,<br>可见(visibility) => 1,<br>标签(tag) => ,<br>相册图片(photo_file_ids) => 9,10,<br>头条(flag_headline) => 0,<br>推荐(flag_recommend) => 0,<br>幻灯(flag_slide_show) => 0,<br>特别推荐(flag_special_recommend) => 0,<br>滚动(flag_roll) => 0,<br>加粗(flag_bold) => 0,<br>图片(flag_picture) => 0,<br>创建时间(created_at) => 1525968791,<br>最后更新(updated_at) => 1525968791', 1525968791, 1525968791),
(221, 1, 'photos/delete', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\PhotosArticle [ {{%article}} ]  {{%DELETED%}} {{%ID%}} 8 {{%RECORD%}}: <br>序号(id) => 8,<br>分类(category_id) => 0,<br>类型(type) => 3,<br>标题(title) => 赵丽颖,<br>副标题(sub_title) => 大腕,<br>概述(summary) => ,<br>缩略图(thumb) => ,<br>seo标题(seo_title) => 赵丽颖,<br>seo关键字(seo_keywords) => 赵丽颖,明星,<br>seo描述(seo_description) => 关于赵丽颖的照片,<br>状态(status) => 1,<br>排序(sort) => 0,<br>作者(user_id) => 1,<br>Scan Count(scan_count) => 0,<br>评论(can_comment) => 1,<br>可见(visibility) => 1,<br>标签(tag) => ,<br>相册图片(photo_file_ids) => 9,10,<br>头条(flag_headline) => 0,<br>推荐(flag_recommend) => 0,<br>幻灯(flag_slide_show) => 0,<br>特别推荐(flag_special_recommend) => 0,<br>滚动(flag_roll) => 0,<br>加粗(flag_bold) => 0,<br>图片(flag_picture) => 0,<br>创建时间(created_at) => 1525968791,<br>最后更新(updated_at) => 1525968791', 1525968816, 1525968816),
(222, 1, 'article/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>编号(id) => 1,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => index_4.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 44651,<br>文件大小(filesizecn) => 43.60 KB,<br>文件路径(filepath) => /uploads/thumb/1525968893-5af46ffd5ad80_index_4.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525968893,<br>最后更新(updated_at) => 1525968893', 1525968893, 1525968893),
(223, 1, 'article/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Article [ {{%article}} ]  {{%CREATED%}} {{%ID%}} 9 {{%RECORD%}}: <br>序号(id) => 9,<br>分类(category_id) => 1,<br>类型(type) => ,<br>标题(title) => yii2多文件上传,<br>副标题(sub_title) => 多文件上传,<br>概述(summary) => yii2多文件上传,<br>缩略图(thumb) => /uploads/thumb/1525968893-5af46ffd5ad80_index_4.jpg,<br>seo标题(seo_title) => yii2多文件上传,<br>seo关键字(seo_keywords) => yii2多文件上传,<br>seo描述(seo_description) => yii2多文件上传,<br>状态(status) => 1,<br>排序(sort) => 2,<br>作者(user_id) => 1,<br>Scan Count(scan_count) => ,<br>评论(can_comment) => 1,<br>可见(visibility) => 1,<br>标签(tag) => yii2多文件上传,<br>相册图片(photo_file_ids) => ,<br>头条(flag_headline) => 0,<br>推荐(flag_recommend) => 0,<br>幻灯(flag_slide_show) => 0,<br>特别推荐(flag_special_recommend) => 0,<br>滚动(flag_roll) => 0,<br>加粗(flag_bold) => 0,<br>图片(flag_picture) => 0,<br>创建时间(created_at) => 1525968893,<br>最后更新(updated_at) => 1525968893', 1525968893, 1525968893),
(224, 1, 'article/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\ArticleContent [ {{%article_content}} ]  {{%CREATED%}} {{%ID%}} 10 {{%RECORD%}}: <br>序号(id) => 10,<br>Article ID(article_id) => 9,<br>正文内容(content) => <p>yii2多文件上传</p>', 1525968893, 1525968893),
(225, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>编号(id) => 2,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a9.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 15909,<br>文件大小(filesizecn) => 15.54 KB,<br>文件路径(filepath) => uploads/20180511/63a49a4407cdab3872b1d8a2f43a76ab.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525968966,<br>最后更新(updated_at) => 1525968966', 1525968967, 1525968967),
(226, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 3 {{%RECORD%}}: <br>编号(id) => 3,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a1.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 40994,<br>文件大小(filesizecn) => 40.03 KB,<br>文件路径(filepath) => uploads/20180511/928da55f85222e7f4d29c8358fb7ba87.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525970440,<br>最后更新(updated_at) => 1525970440', 1525970440, 1525970440),
(227, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 4 {{%RECORD%}}: <br>编号(id) => 4,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a5.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 16274,<br>文件大小(filesizecn) => 15.89 KB,<br>文件路径(filepath) => uploads/20180511/6fbf16156b5e4ada34cb39030652e402.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525970522,<br>最后更新(updated_at) => 1525970522', 1525970522, 1525970522),
(228, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>Auth Key(auth_key) : ynCvTiVcD_LU-rUsW39IjvbuTFWLLt1I=>vOBLuDNY98NrdfkrpT01u-L2BAf9_vZJ,<br>Password Hash(password_hash) : $2y$13$A3ztSFzEE5JqdVTt3FdNoOtF9r.73KG/oqBcNqqxOTSDaIBD2Xnda=>$2y$13$RGS49G.4b5dbhU58kOOzYunmqC7u4ZlFzWPMlvyf6OnwwoWNPGtDC,<br>头像(avatar) : 20180328/3bb6936c3cd294c8cec41e3629cbd3de.jpg=>20180511/6fbf16156b5e4ada34cb39030652e402.jpg,<br>最后更新(updated_at) : 1522170904=>1525970546', 1525970546, 1525970546),
(229, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 5 {{%RECORD%}}: <br>编号(id) => 5,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a8.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 10758,<br>文件大小(filesizecn) => 10.51 KB,<br>文件路径(filepath) => uploads/20180511/feb3e895c803b7ce559540d115ba14d4.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525971002,<br>最后更新(updated_at) => 1525971002', 1525971002, 1525971002),
(231, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 6 {{%RECORD%}}: <br>编号(id) => 6,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a6.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 18357,<br>文件大小(filesizecn) => 17.93 KB,<br>文件路径(filepath) => uploads/20180511/2b263d900e9053bf2b3a480ca296effc.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525971020,<br>最后更新(updated_at) => 1525971020', 1525971020, 1525971020),
(232, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 4 {{%RECORD%}}: <br>Auth Key(auth_key) : 7Ocogz6G6vbMR89XsktUEvAb2NewZRVJ=>NAiGf5vjuHj18IzW0f1ovPioJVn-LR8s,<br>Password Hash(password_hash) : $2y$13$NsZ5LDhXsre4TnqmjtYdbeeTwb7Sp1abUGyZ8IpMxoSswW5cA.YVK=>$2y$13$5xfJvsABP4WNI59PW/oQie0AA9Wu3zaGaxdP.//YjP9hNFd8vDX1i,<br>头像(avatar) : 20180324/27aa70bd7ad8d7287702101c35f2df2f.jpg=>20180511/2b263d900e9053bf2b3a480ca296effc.jpg,<br>最后更新(updated_at) : 1521865824=>1525971031', 1525971031, 1525971031),
(233, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 7 {{%RECORD%}}: <br>编号(id) => 7,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a4.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 8039,<br>文件大小(filesizecn) => 7.85 KB,<br>文件路径(filepath) => uploads/20180511/5496a92bed8e0d1978fcbfaa91fceff0.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525971302,<br>最后更新(updated_at) => 1525971302', 1525971302, 1525971302),
(234, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 8 {{%RECORD%}}: <br>编号(id) => 8,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => profile.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 38520,<br>文件大小(filesizecn) => 37.62 KB,<br>文件路径(filepath) => uploads/20180511/936278cf9850eb56a0fa8138de9059f3.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525971377,<br>最后更新(updated_at) => 1525971377', 1525971377, 1525971377),
(235, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 9 {{%RECORD%}}: <br>编号(id) => 9,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => profile.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 38520,<br>文件大小(filesizecn) => 37.62 KB,<br>文件路径(filepath) => uploads/20180511/69ce949bd3856796f6587f306834f33e.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1525971631,<br>最后更新(updated_at) => 1525971631', 1525971631, 1525971631),
(236, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 10 {{%RECORD%}}: <br>编号(id) => 10,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a9.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 15909,<br>文件大小(filesizecn) => 15.54 KB,<br>文件路径(filepath) => uploads/20180514/704e86ae602badddb4da17075fa2cd4c.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526307638,<br>最后更新(updated_at) => 1526307638', 1526307638, 1526307638),
(237, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 11 {{%RECORD%}}: <br>编号(id) => 11,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a9.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 15909,<br>文件大小(filesizecn) => 15.54 KB,<br>文件路径(filepath) => uploads/20180514/4ea7a9c0793274626d2e4d6d55adde20.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526307671,<br>最后更新(updated_at) => 1526307671', 1526307671, 1526307671),
(238, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>Auth Key(auth_key) : vOBLuDNY98NrdfkrpT01u-L2BAf9_vZJ=>qPd8IHzF_hIRNeyTpOigPTb4clCDyFTT,<br>Password Hash(password_hash) : $2y$13$RGS49G.4b5dbhU58kOOzYunmqC7u4ZlFzWPMlvyf6OnwwoWNPGtDC=>$2y$13$kn51gJPAF4A9NuGw9FWBfuYH7a3fMkAt7Xde3jvR0Mkx5R.8rjIGK,<br>头像(avatar) : 20180511/6fbf16156b5e4ada34cb39030652e402.jpg=>20180514/4ea7a9c0793274626d2e4d6d55adde20.jpg,<br>最后更新(updated_at) : 1525970546=>1526307675', 1526307675, 1526307675),
(239, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 12 {{%RECORD%}}: <br>编号(id) => 12,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => profile.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 38520,<br>文件大小(filesizecn) => 37.62 KB,<br>文件路径(filepath) => uploads/20180514/f6abfcdf5d69a6e72470d7dbb16b0229.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526307694,<br>最后更新(updated_at) => 1526307694', 1526307694, 1526307694),
(240, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 3 {{%RECORD%}}: <br>Auth Key(auth_key) : 1kEoXy9Xz8YVawv45duIv3Ox3LHO3MVt=>tCoHDuxQ0LDB8odmeP4MG_eoVb6VrNQC,<br>Password Hash(password_hash) : $2y$13$DUGZw/0TtCG7PVXsbQqMEOG/t1sUCW7DNXp/AuO7tFoFGQl8HxL/C=>$2y$13$ZrR6JqUjA1dzN2qOMkqFUOUPxbxVlJj38e6uyIyyBgG16qtMmA9FK,<br>头像(avatar) : 20180324/e819e4828d0461b96a68a49fb13c4ef7.jpg=>20180514/f6abfcdf5d69a6e72470d7dbb16b0229.jpg,<br>最后更新(updated_at) : 1521865422=>1526307697', 1526307697, 1526307697),
(241, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 13 {{%RECORD%}}: <br>编号(id) => 13,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a1.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 40994,<br>文件大小(filesizecn) => 40.03 KB,<br>文件路径(filepath) => uploads/20180514/9b18d7af221b2a941c3593e7802b1ffc.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526308351,<br>最后更新(updated_at) => 1526308351', 1526308351, 1526308351),
(242, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 14 {{%RECORD%}}: <br>编号(id) => 14,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a1.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 40994,<br>文件大小(filesizecn) => 40.03 KB,<br>文件路径(filepath) => uploads/20180514/8b3bace3714be91d6fdfd4865672e207.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526308546,<br>最后更新(updated_at) => 1526308546', 1526308546, 1526308546),
(243, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>Auth Key(auth_key) : qPd8IHzF_hIRNeyTpOigPTb4clCDyFTT=>M9MMSQ07sCIRbOF1qhZeMTdm73M8Uqks,<br>Password Hash(password_hash) : $2y$13$kn51gJPAF4A9NuGw9FWBfuYH7a3fMkAt7Xde3jvR0Mkx5R.8rjIGK=>$2y$13$Hj6FmkprNrjLNmP/5z/Yx.I8W8/AH/j7oZ4v9TriMYa7Q0Gj2C6Py,<br>头像(avatar) : =>/uploads/20180514/8b3bace3714be91d6fdfd4865672e207.jpg,<br>最后更新(updated_at) : 1526307675=>1526308555', 1526308555, 1526308555),
(244, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 15 {{%RECORD%}}: <br>编号(id) => 15,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => uploads/20180514/c4db147dbce13316c98342689a11b874.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526308700,<br>最后更新(updated_at) => 1526308700', 1526308701, 1526308701),
(245, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 16 {{%RECORD%}}: <br>编号(id) => 16,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => uploads/20180514/d79ef9203832eac0798959fac9498859.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526308732,<br>最后更新(updated_at) => 1526308732', 1526308732, 1526308732),
(246, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 17 {{%RECORD%}}: <br>编号(id) => 17,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a1.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 40994,<br>文件大小(filesizecn) => 40.03 KB,<br>文件路径(filepath) => uploads/20180514/9cb3b80c154cc7a8bae11f2b92d95a74.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526308876,<br>最后更新(updated_at) => 1526308876', 1526308876, 1526308876),
(248, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 18 {{%RECORD%}}: <br>编号(id) => 18,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 13416,<br>文件大小(filesizecn) => 13.10 KB,<br>文件路径(filepath) => uploads/20180514/517fb1e8f38d136fa09247d96c06ffb7.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526308891,<br>最后更新(updated_at) => 1526308891', 1526308891, 1526308891),
(249, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 3 {{%RECORD%}}: <br>Auth Key(auth_key) : tCoHDuxQ0LDB8odmeP4MG_eoVb6VrNQC=>SFfUVAf7-1PcojJ0pO-C5uGdSjeGHrZL,<br>Password Hash(password_hash) : $2y$13$ZrR6JqUjA1dzN2qOMkqFUOUPxbxVlJj38e6uyIyyBgG16qtMmA9FK=>$2y$13$FZyiuGsBH1p1VUwpOAVac.HCjm6zXx/SzM4tVa8qzwSVSHjD9uhce,<br>头像(avatar) : =>uploads/20180514/517fb1e8f38d136fa09247d96c06ffb7.jpg,<br>最后更新(updated_at) : 1526307697=>1526308896', 1526308896, 1526308896),
(250, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 19 {{%RECORD%}}: <br>编号(id) => 19,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a3.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 50346,<br>文件大小(filesizecn) => 49.17 KB,<br>文件路径(filepath) => uploads/20180514/103b72f3b4b3d3fa901593e30b4c6dc2.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526308945,<br>最后更新(updated_at) => 1526308945', 1526308945, 1526308945),
(251, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 20 {{%RECORD%}}: <br>编号(id) => 20,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a6.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 18357,<br>文件大小(filesizecn) => 17.93 KB,<br>文件路径(filepath) => uploads/20180514/274de2560845cad55f566ec37c4e1793.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526308952,<br>最后更新(updated_at) => 1526308952', 1526308952, 1526308952),
(252, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 21 {{%RECORD%}}: <br>编号(id) => 21,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a8.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 10758,<br>文件大小(filesizecn) => 10.51 KB,<br>文件路径(filepath) => uploads/20180514/631bb972f09183e32a3d9bc653823686.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526308977,<br>最后更新(updated_at) => 1526308977', 1526308978, 1526308978),
(253, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 22 {{%RECORD%}}: <br>编号(id) => 22,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a8.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 10758,<br>文件大小(filesizecn) => 10.51 KB,<br>文件路径(filepath) => uploads/20180514/148289530d408d1be1595d464b15b770.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526308990,<br>最后更新(updated_at) => 1526308990', 1526308990, 1526308990);
INSERT INTO `byt_admin_log` (`id`, `user_id`, `route`, `description`, `created_at`, `updated_at`) VALUES
(254, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 4 {{%RECORD%}}: <br>Auth Key(auth_key) : NAiGf5vjuHj18IzW0f1ovPioJVn-LR8s=>FPyu0ONx0PVAOepNtKLUAT9sHTofwkxp,<br>Password Hash(password_hash) : $2y$13$5xfJvsABP4WNI59PW/oQie0AA9Wu3zaGaxdP.//YjP9hNFd8vDX1i=>$2y$13$iHuRQR4okLMOyo7wSjZaxuHUL.YnF0BDeoIjHWfmU2pCZkkHkqur.,<br>头像(avatar) : =>uploads/20180514/148289530d408d1be1595d464b15b770.jpg,<br>最后更新(updated_at) : 1525971031=>1526308996', 1526308996, 1526308996),
(255, 1, 'article/delete', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\ArticleContent [ {{%article_content}} ]  {{%DELETED%}} {{%ID%}} 10 {{%RECORD%}}: <br>序号(id) => 10,<br>Article ID(article_id) => 9,<br>正文内容(content) => <p>yii2多文件上传</p>', 1526309111, 1526309111),
(256, 1, 'article/delete', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Article [ {{%article}} ]  {{%DELETED%}} {{%ID%}} 9 {{%RECORD%}}: <br>序号(id) => 9,<br>分类(category_id) => 1,<br>类型(type) => 0,<br>标题(title) => yii2多文件上传,<br>副标题(sub_title) => 多文件上传,<br>概述(summary) => yii2多文件上传,<br>缩略图(thumb) => uploads/thumb/1525968893-5af46ffd5ad80_index_4.jpg,<br>seo标题(seo_title) => yii2多文件上传,<br>seo关键字(seo_keywords) => yii2多文件上传,<br>seo描述(seo_description) => yii2多文件上传,<br>状态(status) => 1,<br>排序(sort) => 2,<br>作者(user_id) => 1,<br>Scan Count(scan_count) => 0,<br>评论(can_comment) => 1,<br>可见(visibility) => 1,<br>标签(tag) => yii2多文件上传,<br>相册图片(photo_file_ids) => ,<br>头条(flag_headline) => 0,<br>推荐(flag_recommend) => 0,<br>幻灯(flag_slide_show) => 0,<br>特别推荐(flag_special_recommend) => 0,<br>滚动(flag_roll) => 0,<br>加粗(flag_bold) => 0,<br>图片(flag_picture) => 0,<br>创建时间(created_at) => 1525968893,<br>最后更新(updated_at) => 1525968893', 1526309111, 1526309111),
(257, 1, 'article/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 23 {{%RECORD%}}: <br>编号(id) => 23,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => a5.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 16274,<br>文件大小(filesizecn) => 15.89 KB,<br>文件路径(filepath) => uploads/thumb/1526309317-5af9a1c5b39f6_a5.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526309317,<br>最后更新(updated_at) => 1526309317', 1526309317, 1526309317),
(258, 1, 'article/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Article [ {{%article}} ]  {{%CREATED%}} {{%ID%}} 10 {{%RECORD%}}: <br>序号(id) => 10,<br>分类(category_id) => 1,<br>类型(type) => ,<br>标题(title) => yii2多文件上传,<br>副标题(sub_title) => 文件上传,<br>概述(summary) => yii2多文件上传,<br>缩略图(thumb) => uploads/thumb/1526309317-5af9a1c5b39f6_a5.jpg,<br>seo标题(seo_title) => yii2多文件上传,<br>seo关键字(seo_keywords) => yii2,多文件上传,file,uploads,<br>seo描述(seo_description) => yii2文件上传操作,<br>状态(status) => 1,<br>排序(sort) => 2,<br>作者(user_id) => 1,<br>Scan Count(scan_count) => ,<br>评论(can_comment) => 1,<br>可见(visibility) => 1,<br>标签(tag) => yii2多文件上传,<br>相册图片(photo_file_ids) => ,<br>头条(flag_headline) => 1,<br>推荐(flag_recommend) => 0,<br>幻灯(flag_slide_show) => 0,<br>特别推荐(flag_special_recommend) => 0,<br>滚动(flag_roll) => 0,<br>加粗(flag_bold) => 0,<br>图片(flag_picture) => 0,<br>创建时间(created_at) => 1526309317,<br>最后更新(updated_at) => 1526309317', 1526309317, 1526309317),
(259, 1, 'article/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\models\\ArticleContent [ {{%article_content}} ]  {{%CREATED%}} {{%ID%}} 11 {{%RECORD%}}: <br>序号(id) => 11,<br>Article ID(article_id) => 10,<br>正文内容(content) => <p>yii2多文件上传</p><p>&nbsp;&nbsp;&nbsp;&nbsp;包括了多次文件上传---html5+ajax+jquery<br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;一次上传多个文件<br/></p>', 1526309317, 1526309317),
(260, 1, 'photos/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 24 {{%RECORD%}}: <br>编号(id) => 24,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => 1.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 40039,<br>文件大小(filesizecn) => 39.10 KB,<br>文件路径(filepath) => uploads/thumb/20180514/1526309482-5af9a26ad9a5c_1.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526309482,<br>最后更新(updated_at) => 1526309482', 1526309482, 1526309482),
(261, 1, 'photos/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 25 {{%RECORD%}}: <br>编号(id) => 25,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => 2.jpeg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpeg,<br>文件大小(filesize) => 151295,<br>文件大小(filesizecn) => 147.75 KB,<br>文件路径(filepath) => uploads/thumb/20180514/1526309482-5af9a26ae1b46_2.jpeg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526309482,<br>最后更新(updated_at) => 1526309482', 1526309482, 1526309482),
(262, 1, 'photos/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 26 {{%RECORD%}}: <br>编号(id) => 26,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => 2.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 135883,<br>文件大小(filesizecn) => 132.70 KB,<br>文件路径(filepath) => uploads/thumb/20180514/1526309482-5af9a26ae2ae6_2.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526309482,<br>最后更新(updated_at) => 1526309482', 1526309482, 1526309482),
(263, 1, 'photos/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\PhotosArticle [ {{%article}} ]  {{%CREATED%}} {{%ID%}} 11 {{%RECORD%}}: <br>序号(id) => 11,<br>分类(category_id) => ,<br>类型(type) => 3,<br>标题(title) => 赵丽颖,<br>副标题(sub_title) => 颖宝,<br>概述(summary) => ,<br>缩略图(thumb) => ,<br>seo标题(seo_title) => 赵丽颖,<br>seo关键字(seo_keywords) => 赵丽颖,<br>seo描述(seo_description) => 赵丽颖,<br>状态(status) => 1,<br>排序(sort) => ,<br>作者(user_id) => 1,<br>Scan Count(scan_count) => ,<br>评论(can_comment) => 1,<br>可见(visibility) => 1,<br>标签(tag) => ,<br>相册图片(photo_file_ids) => 24,25,26,<br>头条(flag_headline) => 0,<br>推荐(flag_recommend) => 0,<br>幻灯(flag_slide_show) => 0,<br>特别推荐(flag_special_recommend) => 0,<br>滚动(flag_roll) => 0,<br>加粗(flag_bold) => 0,<br>图片(flag_picture) => 0,<br>创建时间(created_at) => 1526309482,<br>最后更新(updated_at) => 1526309482', 1526309482, 1526309482),
(264, 1, 'photos/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\PhotosArticle [ {{%article}} ]  {{%UPDATED%}} {{%ID%}} 11 {{%RECORD%}}: <br>分类(category_id) : 0=>6,<br>相册图片(photo_file_ids) : 24,25,26=>,24,25,26,<br>最后更新(updated_at) : 1526309482=>1526309863', 1526309863, 1526309863),
(265, 1, 'photos/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 27 {{%RECORD%}}: <br>编号(id) => 27,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => 9.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 45319,<br>文件大小(filesizecn) => 44.26 KB,<br>文件路径(filepath) => uploads/thumb/20180514/1526311696-5af9ab10c518f_9.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526311696,<br>最后更新(updated_at) => 1526311696', 1526311696, 1526311696),
(266, 1, 'photos/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\PhotosArticle [ {{%article}} ]  {{%UPDATED%}} {{%ID%}} 11 {{%RECORD%}}: <br>相册图片(photo_file_ids) : 24,25,26=>27,24,25,26,<br>最后更新(updated_at) : 1526309863=>1526311696', 1526311697, 1526311697),
(267, 1, 'photos/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 28 {{%RECORD%}}: <br>编号(id) => 28,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => 12.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 92064,<br>文件大小(filesizecn) => 89.91 KB,<br>文件路径(filepath) => uploads/thumb/20180514/1526312599-5af9ae97dc735_12.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526312599,<br>最后更新(updated_at) => 1526312599', 1526312600, 1526312600),
(268, 1, 'photos/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\PhotosArticle [ {{%article}} ]  {{%UPDATED%}} {{%ID%}} 11 {{%RECORD%}}: <br>相册图片(photo_file_ids) : 27,24,25,26=>28,27,24,25,26,<br>最后更新(updated_at) : 1526311696=>1526312599', 1526312600, 1526312600),
(269, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 29 {{%RECORD%}}: <br>编号(id) => 29,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => 6.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 131072,<br>文件大小(filesizecn) => 128.00 KB,<br>文件路径(filepath) => uploads/20180516/5053b5d9341cb70a39d3f01b074dff34.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1526483708,<br>最后更新(updated_at) => 1526483708', 1526483708, 1526483708),
(270, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 30 {{%RECORD%}}: <br>编号(id) => 30,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => logo.png,<br>文件类型(filetype) => image/png,<br>后缀(extension) => png,<br>文件大小(filesize) => 8503,<br>文件大小(filesizecn) => 8.30 KB,<br>文件路径(filepath) => uploads/20180606/09033a20eb0f694dd54927e16c0a54d2.png,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1528289307,<br>最后更新(updated_at) => 1528289307', 1528289307, 1528289307),
(272, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 31 {{%RECORD%}}: <br>编号(id) => 31,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => 1527927262pzsn3t.png,<br>文件类型(filetype) => image/png,<br>后缀(extension) => png,<br>文件大小(filesize) => 9295,<br>文件大小(filesizecn) => 9.08 KB,<br>文件路径(filepath) => uploads/20180606/76c8ab93eb0fcf650f5a84ce7ef7d82a.png,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1528290020,<br>最后更新(updated_at) => 1528290020', 1528290020, 1528290020),
(273, 1, 'public/login', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : mHitkn5ulf0ImOVZxKm0HdKK_kJeUDmY=>60YdMhR85nZ2hp5PkUnHfsmLVMPLkPHQ,<br>Password Hash(password_hash) : $2y$13$zmPR/hbJPRQ6Ec5iimDVMO1c194sFggXBmJa37aBMuW4mEnhbX27C=>$2y$13$WKqBrU7.RGmjhpX/HcVZ3e5tV1.YoB1DnUcuWGZzWC5DjLm5GWX4u,<br>登录IP(last_login_ip) : =>127.0.0.1,<br>登录次数(login_count) : 0=>1,<br>最后登录时间(last_login_at) : 0=>1528551904,<br>最后更新(updated_at) : 1525537158=>1528551904', 1528551905, 1528551905),
(274, 1, 'public/login', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : 60YdMhR85nZ2hp5PkUnHfsmLVMPLkPHQ=>b7hJNMBGPSaPhDPNlWAGnC2UHSILz5EG,<br>Password Hash(password_hash) : $2y$13$WKqBrU7.RGmjhpX/HcVZ3e5tV1.YoB1DnUcuWGZzWC5DjLm5GWX4u=>$2y$13$XFGKrvJvPBRsAfErP6kf7uhPenj6biVnVK4YVvMdYb.UQDYySZRLe,<br>登录次数(login_count) : 1=>2,<br>最后登录时间(last_login_at) : 1528551904=>1528901993,<br>最后更新(updated_at) : 1528551904=>1528901994', 1528901994, 1528901994),
(275, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 32 {{%RECORD%}}: <br>编号(id) => 32,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => face.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 42225,<br>文件大小(filesizecn) => 41.24 KB,<br>文件路径(filepath) => uploads/20180613/ae25d30cd2db2e5cac912338e2df4f51.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1528902129,<br>最后更新(updated_at) => 1528902129', 1528902129, 1528902129),
(276, 1, 'admin-user/update-self', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : b7hJNMBGPSaPhDPNlWAGnC2UHSILz5EG=>hdIPJ4pPkyl0QK4s9S5wPXtXb2x6l2kf,<br>Password Hash(password_hash) : $2y$13$XFGKrvJvPBRsAfErP6kf7uhPenj6biVnVK4YVvMdYb.UQDYySZRLe=>$2y$13$T0874xc3agJYoXTurLSUUeQFGXjqsahMsFQpLOLCK4lxhYOmz4pgO,<br>头像(avatar) : =>uploads/20180613/ae25d30cd2db2e5cac912338e2df4f51.jpg,<br>最后更新(updated_at) : 1528901994=>1528902149', 1528902149, 1528902149),
(277, 1, 'public/login', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : hdIPJ4pPkyl0QK4s9S5wPXtXb2x6l2kf=>5_mCWyoctrbnaLYX5VDl-fzWCMT60Zk4,<br>Password Hash(password_hash) : $2y$13$T0874xc3agJYoXTurLSUUeQFGXjqsahMsFQpLOLCK4lxhYOmz4pgO=>$2y$13$ToQD1Gy1EdGBcUK7IdIjRefrW98vRAfPkksQXRDvNjP9tXHy/BSvO,<br>登录次数(login_count) : 2=>3,<br>最后登录时间(last_login_at) : 1528901993=>1528902738,<br>最后更新(updated_at) : 1528902149=>1528902738', 1528902739, 1528902739),
(278, 2, 'public/login', '{{%ADMIN_USER%}} [ news_worker ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>Auth Key(auth_key) : M9MMSQ07sCIRbOF1qhZeMTdm73M8Uqks=>LTLkDiiTiNwSxT99Om8XCWxTzhoU0Hmi,<br>Password Hash(password_hash) : $2y$13$Hj6FmkprNrjLNmP/5z/Yx.I8W8/AH/j7oZ4v9TriMYa7Q0Gj2C6Py=>$2y$13$W2KL2arOQUrBqjsUF/t/teflBQpWnNI0j/9xiznwWiEIX7NzM2z3e,<br>登录IP(last_login_ip) : =>127.0.0.1,<br>登录次数(login_count) : 0=>1,<br>最后登录时间(last_login_at) : 0=>1528903364,<br>最后更新(updated_at) : 1526308555=>1528903365', 1528903365, 1528903365),
(279, 1, 'public/login', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : M9MMSQ07sCIRbOF1qhZeMTdm73M8Uqks=>jrc4T3v3PV9kXst-lRXPEO2T0_mOe3VO,<br>Password Hash(password_hash) : $2y$13$W2KL2arOQUrBqjsUF/t/teflBQpWnNI0j/9xiznwWiEIX7NzM2z3e=>$2y$13$eYHh54mFP8BaoGJhZv3j3eiZBo4UODfvLmxg3kMYQMJdx4Xcyb5QS,<br>登录次数(login_count) : 3=>4,<br>最后登录时间(last_login_at) : 1528902738=>1528903400,<br>最后更新(updated_at) : 1528902738=>1528903401', 1528903401, 1528903401),
(280, 1, 'admin-user/update-self', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : jrc4T3v3PV9kXst-lRXPEO2T0_mOe3VO=>r2VrR2S6jSyY6CkvNp3w5NG6Vi6ujDdV,<br>Password Hash(password_hash) : $2y$13$eYHh54mFP8BaoGJhZv3j3eiZBo4UODfvLmxg3kMYQMJdx4Xcyb5QS=>$2y$13$5FxxM9R2ayyxNgNVQzUBaucyq/V8vTRcXQa1flZHe3wa8cc6jhxEe,<br>最后更新(updated_at) : 1528903401=>1528903426', 1528903426, 1528903426),
(281, 1, 'public/login', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : r2VrR2S6jSyY6CkvNp3w5NG6Vi6ujDdV=>c1RPQ_apmZPFAt2h4N9DWYNsZQOoad2B,<br>Password Hash(password_hash) : $2y$13$5FxxM9R2ayyxNgNVQzUBaucyq/V8vTRcXQa1flZHe3wa8cc6jhxEe=>$2y$13$7qXY4flH4LGMcS7U5/HM9eP2XTWVZL7uaP9iUylI/H6TpGuZPc40.,<br>登录次数(login_count) : 4=>5,<br>最后登录时间(last_login_at) : 1528903400=>1528903444,<br>最后更新(updated_at) : 1528903426=>1528903445', 1528903445, 1528903445),
(282, 1, 'public/login', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : c1RPQ_apmZPFAt2h4N9DWYNsZQOoad2B=>9ynInr8CbaUMUuTi0KVGK0L7gmxojq_C,<br>Password Hash(password_hash) : $2y$13$7qXY4flH4LGMcS7U5/HM9eP2XTWVZL7uaP9iUylI/H6TpGuZPc40.=>$2y$13$erbMoq9x6u5sJWfxnR0c1OP2KbTJpuG1etcK8HxThFsALSPeeqKoy,<br>登录次数(login_count) : 5=>6,<br>最后登录时间(last_login_at) : 1528903444=>1529118186,<br>最后更新(updated_at) : 1528903445=>1529118187', 1529118187, 1529118187),
(283, 1, 'admin-user/update-self', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : 9ynInr8CbaUMUuTi0KVGK0L7gmxojq_C=>FuKNniQKIt5np8HiGtChdJCIaOZFqCiU,<br>Password Hash(password_hash) : $2y$13$erbMoq9x6u5sJWfxnR0c1OP2KbTJpuG1etcK8HxThFsALSPeeqKoy=>$2y$13$1dBoYlc/qvXyan5cPHupVeD6NvAx.NVpdQq4fc9EZNqF2fYIYA3xm,<br>最后更新(updated_at) : 1529118187=>1529118201', 1529118201, 1529118201),
(284, 1, 'public/login', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : FuKNniQKIt5np8HiGtChdJCIaOZFqCiU=>wEdwv40ZfSJ5svQOt5aWYZ67ymbv6yn2,<br>Password Hash(password_hash) : $2y$13$1dBoYlc/qvXyan5cPHupVeD6NvAx.NVpdQq4fc9EZNqF2fYIYA3xm=>$2y$13$/sdAybXelAzorDZ1QU2.pOQYY1xqTXZRdDFILQnKpKpcHRcZNTXLm,<br>登录次数(login_count) : 6=>7,<br>最后登录时间(last_login_at) : 1529118186=>1529118229,<br>最后更新(updated_at) : 1529118201=>1529118230', 1529118230, 1529118230),
(285, 1, 'public/login', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : wEdwv40ZfSJ5svQOt5aWYZ67ymbv6yn2=>uVLNVkWMbG3qNSKcUvnhtkEQAdwY3U1-,<br>Password Hash(password_hash) : $2y$13$/sdAybXelAzorDZ1QU2.pOQYY1xqTXZRdDFILQnKpKpcHRcZNTXLm=>$2y$13$ef2Ic9DCFdei3hIXfLK48uNyzFhP4giARDpNsbDgB0O54Pf5ODtHa,<br>登录次数(login_count) : 7=>8,<br>最后登录时间(last_login_at) : 1529118229=>1529310652,<br>最后更新(updated_at) : 1529118230=>1529310652', 1529310653, 1529310653),
(286, 1, 'admin-user/update-self', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : uVLNVkWMbG3qNSKcUvnhtkEQAdwY3U1-=>2NQr3qrTsDzy9H3bsOZLJWg45EWdqcln,<br>Password Hash(password_hash) : $2y$13$ef2Ic9DCFdei3hIXfLK48uNyzFhP4giARDpNsbDgB0O54Pf5ODtHa=>$2y$13$8ysIkzoIVmTrfxKXM3ON/OL/gGqY2RGH3fU2CzOKEFm3JrIF55zgu,<br>最后更新(updated_at) : 1529310652=>1529310773', 1529310773, 1529310773),
(287, 1, 'public/login', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : 2NQr3qrTsDzy9H3bsOZLJWg45EWdqcln=>o_5Bi_XG_i80qTKVHoDakqRxXJLDboVu,<br>Password Hash(password_hash) : $2y$13$8ysIkzoIVmTrfxKXM3ON/OL/gGqY2RGH3fU2CzOKEFm3JrIF55zgu=>$2y$13$hJpZTELzY6eKb0fIdx1gGOXWe9hG3K.lSwTPI9wskYfBkO5NNaKvC,<br>登录次数(login_count) : 8=>9,<br>最后登录时间(last_login_at) : 1529310652=>1529310850,<br>最后更新(updated_at) : 1529310773=>1529310851', 1529310851, 1529310851),
(288, 1, 'public/login', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : o_5Bi_XG_i80qTKVHoDakqRxXJLDboVu=>8pg3l7tTq4mHv4yqLU6nbwwJfvylSTrz,<br>Password Hash(password_hash) : $2y$13$hJpZTELzY6eKb0fIdx1gGOXWe9hG3K.lSwTPI9wskYfBkO5NNaKvC=>$2y$13$HjCnwxx.VaeewN6jwfn.J.uG2iKx7YUFC2pYvL.3NEcnpvHOzR6RC,<br>登录次数(login_count) : 9=>10,<br>最后登录时间(last_login_at) : 1529310850=>1529312608,<br>最后更新(updated_at) : 1529310851=>1529312609', 1529312609, 1529312609),
(289, 1, 'admin-user/update-self', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : 8pg3l7tTq4mHv4yqLU6nbwwJfvylSTrz=>f33C_SMrwRTEqjV3HSTDpDEzXrTfbLZ5,<br>Password Hash(password_hash) : $2y$13$HjCnwxx.VaeewN6jwfn.J.uG2iKx7YUFC2pYvL.3NEcnpvHOzR6RC=>$2y$13$CYvxxrHpVvANK3vLhGx4UuMlfeSMQw/qe8VrjEk4aBRGe5/.kznSe,<br>最后更新(updated_at) : 1529312609=>1529312809', 1529312809, 1529312809),
(290, 1, 'public/login', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : f33C_SMrwRTEqjV3HSTDpDEzXrTfbLZ5=>erUOSw76AhPlMpzlZ58KieWcQebinmND,<br>Password Hash(password_hash) : $2y$13$CYvxxrHpVvANK3vLhGx4UuMlfeSMQw/qe8VrjEk4aBRGe5/.kznSe=>$2y$13$XZRU57KqgQ.RMil35IKxTuxXjsNc46Z98bUPkhtuDCSOm0tlJSF3e,<br>登录次数(login_count) : 10=>11,<br>最后登录时间(last_login_at) : 1529312608=>1529312931,<br>最后更新(updated_at) : 1529312809=>1529312932', 1529312932, 1529312932),
(291, 1, 'admin-user/update-self', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>Auth Key(auth_key) : erUOSw76AhPlMpzlZ58KieWcQebinmND=>1TK5QuneTxFZxTyZRK-VZTX_bnPi8f1V,<br>Password Hash(password_hash) : $2y$13$XZRU57KqgQ.RMil35IKxTuxXjsNc46Z98bUPkhtuDCSOm0tlJSF3e=>$2y$13$DmhZ20zSUC8mhNnS2jL8oe.A5f7JBQVZvhQ0XuNi1fm4qSS1brz/y,<br>最后更新(updated_at) : 1529312932=>1529313165', 1529313165, 1529313165),
(292, 1, 'user/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%CREATED%}} {{%ID%}} 3 {{%RECORD%}}: <br>ID(id) => 3,<br>用户名(username) => 11111,<br>Auth Key(auth_key) => mIx3usrnUwv69ddSQPUzbMSFgF6o6qTT,<br>Password Hash(password_hash) => $2y$13$Ze40vpddCilRxdWnIju8SOPYs1/5xA.Ib7OR50nZw5uIGnFyjrZBi,<br>Password Reset Token(password_reset_token) => ,<br>电子邮件(email) => 2222@qq.com,<br>头像(avatar) => ,<br>状态(status) => 10,<br>登录次数(login_count) => ,<br>登录IP(last_login_ip) => ,<br>最后登录时间(last_login_at) => ,<br>创建时间(created_at) => 1529420504,<br>最后更新(updated_at) => 1529420504', 1529420504, 1529420504),
(293, 1, 'user/delete', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%DELETED%}} {{%ID%}} 3 {{%RECORD%}}: <br>ID(id) => 3,<br>用户名(username) => 11111,<br>Auth Key(auth_key) => mIx3usrnUwv69ddSQPUzbMSFgF6o6qTT,<br>Password Hash(password_hash) => $2y$13$Ze40vpddCilRxdWnIju8SOPYs1/5xA.Ib7OR50nZw5uIGnFyjrZBi,<br>Password Reset Token(password_reset_token) => ,<br>电子邮件(email) => 2222@qq.com,<br>头像(avatar) => ,<br>状态(status) => 10,<br>登录次数(login_count) => 0,<br>登录IP(last_login_ip) => ,<br>最后登录时间(last_login_at) => 0,<br>创建时间(created_at) => 1529420504,<br>最后更新(updated_at) => 1529420504', 1529420514, 1529420514),
(294, 1, 'user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>最后更新(updated_at) : 1529125477=>1529421141', 1529421141, 1529421141),
(295, 1, 'user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>Auth Key(auth_key) : 9c2kB0koBEBlFWlqW7wT3dg-pv-jdAjC=>EiiMA-Pyu_IzWdhHALFedtLsQZAYGUQf,<br>Password Hash(password_hash) : $2y$13$T3V7o8SHuzKYM8nsl0jiTeBocihROUGw/mAflgfmNSzIgtp9ToGR.=>$2y$13$P6zu56.fHJXsD4VY97rT4uy9R.x/hyW4mDFTRMbT72e4VStWfEcGG,<br>最后更新(updated_at) : 1529421141=>1529421447', 1529421447, 1529421447),
(296, 1, 'user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>最后更新(updated_at) : 1529421447=>1529421477', 1529421477, 1529421477),
(297, 1, 'user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>最后更新(updated_at) : 1529318389=>1529421554', 1529421554, 1529421554),
(298, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 33 {{%RECORD%}}: <br>编号(id) => 33,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => diaochan.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 4752,<br>文件大小(filesizecn) => 4.64 KB,<br>文件路径(filepath) => uploads/20180619/61330e1aa1e6b4f576cdd927fa444be4.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1529421645,<br>最后更新(updated_at) => 1529421645', 1529421645, 1529421645),
(299, 1, 'user/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%CREATED%}} {{%ID%}} 4 {{%RECORD%}}: <br>ID(id) => 4,<br>用户名(username) => backend_to_frontend_user,<br>Auth Key(auth_key) => ,<br>Password Hash(password_hash) => ,<br>Password Reset Token(password_reset_token) => ,<br>电子邮件(email) => 305443997@qq.com,<br>头像(avatar) => uploads/20180619/61330e1aa1e6b4f576cdd927fa444be4.jpg,<br>状态(status) => 10,<br>登录次数(login_count) => ,<br>登录IP(last_login_ip) => ,<br>最后登录时间(last_login_at) => ,<br>创建时间(created_at) => 1529421698,<br>最后更新(updated_at) => 1529421698', 1529421698, 1529421698),
(300, 1, 'user/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%CREATED%}} {{%ID%}} 5 {{%RECORD%}}: <br>ID(id) => 5,<br>用户名(username) => 11111,<br>Auth Key(auth_key) => ,<br>Password Hash(password_hash) => ,<br>Password Reset Token(password_reset_token) => ,<br>电子邮件(email) => 2222@qq.com,<br>头像(avatar) => ,<br>状态(status) => 0,<br>登录次数(login_count) => ,<br>登录IP(last_login_ip) => ,<br>最后登录时间(last_login_at) => ,<br>创建时间(created_at) => 1529422224,<br>最后更新(updated_at) => 1529422224', 1529422224, 1529422224),
(301, 1, 'user/delete', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%DELETED%}} {{%ID%}} 5 {{%RECORD%}}: <br>ID(id) => 5,<br>用户名(username) => 11111,<br>Auth Key(auth_key) => ,<br>Password Hash(password_hash) => ,<br>Password Reset Token(password_reset_token) => ,<br>电子邮件(email) => 2222@qq.com,<br>头像(avatar) => ,<br>状态(status) => 0,<br>登录次数(login_count) => 0,<br>登录IP(last_login_ip) => ,<br>最后登录时间(last_login_at) => 0,<br>创建时间(created_at) => 1529422224,<br>最后更新(updated_at) => 1529422224', 1529422234, 1529422234),
(302, 1, 'user/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%CREATED%}} {{%ID%}} 6 {{%RECORD%}}: <br>ID(id) => 6,<br>用户名(username) => 11111,<br>Auth Key(auth_key) => ,<br>Password Hash(password_hash) => ,<br>Password Reset Token(password_reset_token) => ,<br>电子邮件(email) => 2222@qq.com,<br>头像(avatar) => ,<br>状态(status) => 0,<br>登录次数(login_count) => ,<br>登录IP(last_login_ip) => ,<br>最后登录时间(last_login_at) => ,<br>创建时间(created_at) => 1529422283,<br>最后更新(updated_at) => 1529422283', 1529422283, 1529422283),
(303, 1, 'user/delete', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%DELETED%}} {{%ID%}} 6 {{%RECORD%}}: <br>ID(id) => 6,<br>用户名(username) => 11111,<br>Auth Key(auth_key) => ,<br>Password Hash(password_hash) => ,<br>Password Reset Token(password_reset_token) => ,<br>电子邮件(email) => 2222@qq.com,<br>头像(avatar) => ,<br>状态(status) => 0,<br>登录次数(login_count) => 0,<br>登录IP(last_login_ip) => ,<br>最后登录时间(last_login_at) => 0,<br>创建时间(created_at) => 1529422283,<br>最后更新(updated_at) => 1529422283', 1529422358, 1529422358),
(304, 1, 'user/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%CREATED%}} {{%ID%}} 7 {{%RECORD%}}: <br>ID(id) => 7,<br>用户名(username) => 11111,<br>Auth Key(auth_key) => ,<br>Password Hash(password_hash) => ,<br>Password Reset Token(password_reset_token) => ,<br>电子邮件(email) => 2222@qq.com,<br>头像(avatar) => ,<br>状态(status) => 0,<br>登录次数(login_count) => ,<br>登录IP(last_login_ip) => ,<br>最后登录时间(last_login_at) => ,<br>创建时间(created_at) => 1529422428,<br>最后更新(updated_at) => 1529422428', 1529422428, 1529422428),
(305, 1, 'user/delete', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%DELETED%}} {{%ID%}} 7 {{%RECORD%}}: <br>ID(id) => 7,<br>用户名(username) => 11111,<br>Auth Key(auth_key) => ,<br>Password Hash(password_hash) => ,<br>Password Reset Token(password_reset_token) => ,<br>电子邮件(email) => 2222@qq.com,<br>头像(avatar) => ,<br>状态(status) => 0,<br>登录次数(login_count) => 0,<br>登录IP(last_login_ip) => ,<br>最后登录时间(last_login_at) => 0,<br>创建时间(created_at) => 1529422428,<br>最后更新(updated_at) => 1529422428', 1529422446, 1529422446),
(306, 1, 'user/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%CREATED%}} {{%ID%}} 8 {{%RECORD%}}: <br>ID(id) => 8,<br>用户名(username) => 111222,<br>Auth Key(auth_key) => ,<br>Password Hash(password_hash) => ,<br>Password Reset Token(password_reset_token) => ,<br>电子邮件(email) => 222@qq.com,<br>头像(avatar) => ,<br>状态(status) => 0,<br>登录次数(login_count) => ,<br>登录IP(last_login_ip) => ,<br>最后登录时间(last_login_at) => ,<br>创建时间(created_at) => 1529422571,<br>最后更新(updated_at) => 1529422571', 1529422571, 1529422571),
(307, 1, 'user/delete', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%DELETED%}} {{%ID%}} 8 {{%RECORD%}}: <br>ID(id) => 8,<br>用户名(username) => 111222,<br>Auth Key(auth_key) => ,<br>Password Hash(password_hash) => ,<br>Password Reset Token(password_reset_token) => ,<br>电子邮件(email) => 222@qq.com,<br>头像(avatar) => ,<br>状态(status) => 0,<br>登录次数(login_count) => 0,<br>登录IP(last_login_ip) => ,<br>最后登录时间(last_login_at) => 0,<br>创建时间(created_at) => 1529422571,<br>最后更新(updated_at) => 1529422571', 1529422580, 1529422580),
(308, 1, 'user/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%CREATED%}} {{%ID%}} 9 {{%RECORD%}}: <br>ID(id) => 9,<br>用户名(username) => 111222,<br>Auth Key(auth_key) => ,<br>Password Hash(password_hash) => ,<br>Password Reset Token(password_reset_token) => ,<br>电子邮件(email) => 222@qq.com,<br>头像(avatar) => ,<br>状态(status) => 0,<br>登录次数(login_count) => ,<br>登录IP(last_login_ip) => ,<br>最后登录时间(last_login_at) => ,<br>创建时间(created_at) => 1529422664,<br>最后更新(updated_at) => 1529422664', 1529422664, 1529422664),
(309, 1, 'user/delete', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%DELETED%}} {{%ID%}} 9 {{%RECORD%}}: <br>ID(id) => 9,<br>用户名(username) => 111222,<br>Auth Key(auth_key) => ,<br>Password Hash(password_hash) => ,<br>Password Reset Token(password_reset_token) => ,<br>电子邮件(email) => 222@qq.com,<br>头像(avatar) => ,<br>状态(status) => 0,<br>登录次数(login_count) => 0,<br>登录IP(last_login_ip) => ,<br>最后登录时间(last_login_at) => 0,<br>创建时间(created_at) => 1529422664,<br>最后更新(updated_at) => 1529422664', 1529422671, 1529422671),
(310, 1, 'user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%UPDATED%}} {{%ID%}} 4 {{%RECORD%}}: <br>状态(status) : 10=>0,<br>最后更新(updated_at) : 1529421698=>1529422685', 1529422685, 1529422685),
(311, 1, 'user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%UPDATED%}} {{%ID%}} 4 {{%RECORD%}}: <br>状态(status) : 0=>10,<br>最后更新(updated_at) : 1529422685=>1529423175', 1529423175, 1529423175),
(312, 1, 'user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%UPDATED%}} {{%ID%}} 4 {{%RECORD%}}: <br>Auth Key(auth_key) : =>mcBvlMXdymsm8jkTXyh9kOZmrWc56e08,<br>Password Hash(password_hash) : =>$2y$13$rX1hxyNK4lfbhc.00Ijlte3/D2hN0S6eIZhoYWOxo4XeW5X4Faa2W,<br>最后更新(updated_at) : 1529423175=>1529423424', 1529423424, 1529423424),
(313, 1, 'user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%UPDATED%}} {{%ID%}} 4 {{%RECORD%}}: <br>最后更新(updated_at) : 1529423424=>1529423582', 1529423582, 1529423582),
(314, 1, 'user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%UPDATED%}} {{%ID%}} 4 {{%RECORD%}}: <br>Auth Key(auth_key) : mcBvlMXdymsm8jkTXyh9kOZmrWc56e08=>FUslpzG3n3jDAQmc7qS7Ch_N4JLmbaSe,<br>Password Hash(password_hash) : $2y$13$rX1hxyNK4lfbhc.00Ijlte3/D2hN0S6eIZhoYWOxo4XeW5X4Faa2W=>$2y$13$/UoxxiWyk02yJTjliUfpEe624tiLB92aUeix5P0z9owNLpu18uGOe,<br>最后更新(updated_at) : 1529423582=>1529423602', 1529423602, 1529423602),
(315, 1, 'user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} frontend\\models\\User [ {{%user}} ]  {{%UPDATED%}} {{%ID%}} 4 {{%RECORD%}}: <br>最后更新(updated_at) : 1529423602=>1529423634', 1529423635, 1529423635),
(316, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>Auth Key(auth_key) : LTLkDiiTiNwSxT99Om8XCWxTzhoU0Hmi=>3J1Fk2avipRzGk3pdiCYz1oQuLNBgEMS,<br>Password Hash(password_hash) : $2y$13$W2KL2arOQUrBqjsUF/t/teflBQpWnNI0j/9xiznwWiEIX7NzM2z3e=>$2y$13$V2y6O6FtV5CrQD.O/daxH.EXyrEg6oNsjT2mrn2FS0QvDSctF1BdO,<br>最后更新(updated_at) : 1528903365=>1529423661', 1529423661, 1529423661),
(317, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>Auth Key(auth_key) : 3J1Fk2avipRzGk3pdiCYz1oQuLNBgEMS=>ok0fzmGQKdEw1WV51fivBcU8OxMsCDcr,<br>Password Hash(password_hash) : $2y$13$V2y6O6FtV5CrQD.O/daxH.EXyrEg6oNsjT2mrn2FS0QvDSctF1BdO=>$2y$13$9fDvLaRAz/yK.0xXY01zF.CgPLPOz8JYuaF5/m62YSeUtmRqABjpO,<br>最后更新(updated_at) : 1529423661=>1529423729', 1529423729, 1529423729),
(318, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>Auth Key(auth_key) : ok0fzmGQKdEw1WV51fivBcU8OxMsCDcr=>OeA0BgeAv-PhpxVp4YaSoVmRIJMG8gnn,<br>Password Hash(password_hash) : $2y$13$9fDvLaRAz/yK.0xXY01zF.CgPLPOz8JYuaF5/m62YSeUtmRqABjpO=>$2y$13$2./F77OTCiP260b3PYunS.UGOvvbmGQ1xMtPBQXhptumzU/OAnqeS,<br>最后更新(updated_at) : 1529423729=>1529423917', 1529423917, 1529423917),
(319, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>最后更新(updated_at) : 1529423917=>1529423933', 1529423933, 1529423933),
(320, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>最后更新(updated_at) : 1529423933=>1529423947', 1529423947, 1529423947),
(321, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>Auth Key(auth_key) : OeA0BgeAv-PhpxVp4YaSoVmRIJMG8gnn=>Iuu0KNs4LdiubunygmD44RXQvreBBleu,<br>Password Hash(password_hash) : $2y$13$2./F77OTCiP260b3PYunS.UGOvvbmGQ1xMtPBQXhptumzU/OAnqeS=>$2y$13$o/AthsmmkX32X0r3Ci57oOdXvRwxBDWo44TdK5qxX00tlWRuBVS2O,<br>最后更新(updated_at) : 1529423947=>1529423963', 1529423963, 1529423963),
(322, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>状态(status) : 10=>0,<br>最后更新(updated_at) : 1529423963=>1529424187', 1529424187, 1529424187),
(323, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>Auth Key(auth_key) : Iuu0KNs4LdiubunygmD44RXQvreBBleu=>09XQYdhgMLPOB0-SXMBcB3BWuye4YbP5,<br>Password Hash(password_hash) : $2y$13$o/AthsmmkX32X0r3Ci57oOdXvRwxBDWo44TdK5qxX00tlWRuBVS2O=>$2y$13$Ox/eVcmOa4nw.C10n9QRs.5GE.lzcqDXr.4iAwcF42n5vD/q1ot26,<br>最后更新(updated_at) : 1529424187=>1529424226', 1529424226, 1529424226),
(324, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>Auth Key(auth_key) : 09XQYdhgMLPOB0-SXMBcB3BWuye4YbP5=>Sbw0XZxFbWica28AW1a8g8M3aw1KRb-U,<br>Password Hash(password_hash) : $2y$13$Ox/eVcmOa4nw.C10n9QRs.5GE.lzcqDXr.4iAwcF42n5vD/q1ot26=>$2y$13$HlHEjbglsCF5trmqlGYTXO.he.0gw.a5k5htdfW5H4hAh5Jgi/f66,<br>最后更新(updated_at) : 1529424226=>1529424373', 1529424373, 1529424373),
(325, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>Auth Key(auth_key) : Sbw0XZxFbWica28AW1a8g8M3aw1KRb-U=>h1YP5cI-meOuUuVxRQPYY_VwrAFryYZH,<br>Password Hash(password_hash) : $2y$13$HlHEjbglsCF5trmqlGYTXO.he.0gw.a5k5htdfW5H4hAh5Jgi/f66=>$2y$13$ZqkMrefux1XhxjT6RJ8YauHPcVTSgFIqNsE3Y4Xg6NXF2I2g.sXnu,<br>最后更新(updated_at) : 1529424373=>1529424580', 1529424580, 1529424580),
(326, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>Auth Key(auth_key) : h1YP5cI-meOuUuVxRQPYY_VwrAFryYZH=>VnztzJiSKR6sw2LtQVeqzMno9tG3HTJJ,<br>Password Hash(password_hash) : $2y$13$ZqkMrefux1XhxjT6RJ8YauHPcVTSgFIqNsE3Y4Xg6NXF2I2g.sXnu=>$2y$13$Y1/W7BNkQuKWRa3.i5hcVOmXc50SCKMNvCPBafM9elAnorBm56v82,<br>最后更新(updated_at) : 1529424580=>1529425026', 1529425026, 1529425026),
(327, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>状态(status) : 0=>10,<br>最后更新(updated_at) : 1529425026=>1529425167', 1529425168, 1529425168),
(328, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>状态(status) : 10=>0,<br>最后更新(updated_at) : 1529425167=>1529425200', 1529425200, 1529425200),
(329, 1, 'admin-user/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\User [ {{%admin_user}} ]  {{%UPDATED%}} {{%ID%}} 2 {{%RECORD%}}: <br>状态(status) : 0=>10,<br>最后更新(updated_at) : 1529425200=>1529425230', 1529425230, 1529425230),
(330, 1, 'menu/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%CREATED%}} {{%ID%}} 121 {{%RECORD%}}: <br>序号(id) => 121,<br>类型(type) => ,<br>父分类Id(parent_id) => ,<br>名称(name) => 组件,<br>地址(url) => /cms-component/cms-component,<br>图标(icon) => fa-cubes,<br>排序(sort) => 0,<br>窗口打开方式(target) => ,<br>绝对地址(is_absolute_url) => 0,<br>是否显示(is_display) => 1,<br>请求方式(method) => 1,<br>创建时间(created_at) => 1529589097,<br>最后更新(updated_at) => 1529589097', 1529589098, 1529589098),
(331, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 121 {{%RECORD%}}: <br>排序(sort) : 0=>5,<br>最后更新(updated_at) : 1529589097=>1529589130', 1529589130, 1529589130),
(332, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 1 {{%RECORD%}}: <br>父分类Id(parent_id) : 0=>,<br>图标(icon) : fa fa fa-cogs=>fa-asterisk,<br>最后更新(updated_at) : 1477317443=>1529589979', 1529589979, 1529589979),
(333, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 17 {{%RECORD%}}: <br>父分类Id(parent_id) : 0=>121,<br>图标(icon) : fa fa-link=>fa-link,<br>最后更新(updated_at) : 1488805061=>1529595813', 1529595813, 1529595813),
(334, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 84 {{%RECORD%}}: <br>父分类Id(parent_id) : 0=>121,<br>最后更新(updated_at) : 1488804725=>1529595838', 1529595838, 1529595838),
(335, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 85 {{%RECORD%}}: <br>父分类Id(parent_id) : 0=>121,<br>最后更新(updated_at) : 1488804715=>1529595878', 1529595878, 1529595878),
(336, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 86 {{%RECORD%}}: <br>父分类Id(parent_id) : 0=>121,<br>最后更新(updated_at) : 1488804699=>1529595899', 1529595900, 1529595900),
(337, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 87 {{%RECORD%}}: <br>父分类Id(parent_id) : 0=>121,<br>最后更新(updated_at) : 1488804688=>1529595935', 1529595935, 1529595935),
(338, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 88 {{%RECORD%}}: <br>父分类Id(parent_id) : 0=>121,<br>最后更新(updated_at) : 1488804736=>1529595963', 1529595963, 1529595963),
(339, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 105 {{%RECORD%}}: <br>父分类Id(parent_id) : 0=>121,<br>最后更新(updated_at) : 1502973661=>1529595996', 1529595996, 1529595996),
(340, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 18 {{%RECORD%}}: <br>排序(sort) : 0=>6,<br>最后更新(updated_at) : 1523802402=>1529596118', 1529596118, 1529596118),
(341, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 13 {{%RECORD%}}: <br>父分类Id(parent_id) : 0=>,<br>图标(icon) : fa fa-users=>fa-users,<br>排序(sort) : 4=>2,<br>最后更新(updated_at) : 1488805038=>1529596316', 1529596316, 1529596316),
(342, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 5 {{%RECORD%}}: <br>父分类Id(parent_id) : 0=>,<br>图标(icon) : fa fa fa-th-list=>fa-list-ol,<br>排序(sort) : 2=>3,<br>最后更新(updated_at) : 1476070842=>1529596357', 1529596357, 1529596357),
(343, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 8 {{%RECORD%}}: <br>父分类Id(parent_id) : 0=>,<br>图标(icon) : fa fa fa-edit=>fa-edit,<br>排序(sort) : 3=>4,<br>最后更新(updated_at) : 1476070842=>1529596412', 1529596412, 1529596412),
(344, 1, 'menu/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%CREATED%}} {{%ID%}} 122 {{%RECORD%}}: <br>序号(id) => 122,<br>类型(type) => ,<br>父分类Id(parent_id) => 121,<br>名称(name) => 广告管理,<br>地址(url) => ad,<br>图标(icon) => ,<br>排序(sort) => 6,<br>窗口打开方式(target) => ,<br>绝对地址(is_absolute_url) => 0,<br>是否显示(is_display) => 1,<br>请求方式(method) => 1,<br>创建时间(created_at) => 1529598437,<br>最后更新(updated_at) => 1529598437', 1529598437, 1529598437),
(345, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 122 {{%RECORD%}}: <br>地址(url) : ad=>/ad,<br>最后更新(updated_at) : 1529598437=>1529598469', 1529598469, 1529598469),
(346, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 122 {{%RECORD%}}: <br>地址(url) : /ad=>/ad/index,<br>最后更新(updated_at) : 1529598469=>1529598501', 1529598501, 1529598501),
(347, 1, 'menu/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%CREATED%}} {{%ID%}} 123 {{%RECORD%}}: <br>序号(id) => 123,<br>类型(type) => ,<br>父分类Id(parent_id) => 121,<br>名称(name) => Banner管理,<br>地址(url) => /banner/index,<br>图标(icon) => ,<br>排序(sort) => 7,<br>窗口打开方式(target) => ,<br>绝对地址(is_absolute_url) => 0,<br>是否显示(is_display) => 1,<br>请求方式(method) => 1,<br>创建时间(created_at) => 1529598540,<br>最后更新(updated_at) => 1529598540', 1529598540, 1529598540),
(348, 1, 'menu/create', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%CREATED%}} {{%ID%}} 124 {{%RECORD%}}: <br>序号(id) => 124,<br>类型(type) => ,<br>父分类Id(parent_id) => 121,<br>名称(name) => 附件管理,<br>地址(url) => /attachment/index,<br>图标(icon) => ,<br>排序(sort) => 8,<br>窗口打开方式(target) => ,<br>绝对地址(is_absolute_url) => 0,<br>是否显示(is_display) => 1,<br>请求方式(method) => 1,<br>创建时间(created_at) => 1529598633,<br>最后更新(updated_at) => 1529598633', 1529598633, 1529598633),
(349, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 124 {{%RECORD%}}: <br>最后更新(updated_at) : 1529598633=>1529598681', 1529598682, 1529598682),
(350, 1, 'menu/update', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} backend\\models\\Menu [ {{%menu}} ]  {{%UPDATED%}} {{%ID%}} 122 {{%RECORD%}}: <br>地址(url) : /ad/index=>/options/index,<br>最后更新(updated_at) : 1529598501=>1529943453', 1529943453, 1529943453),
(351, 1, 'upload/image-upload', '{{%ADMIN_USER%}} [ admin ] {{%BY%}} common\\modules\\attachment\\models\\Attachment [ {{%attachment}} ]  {{%CREATED%}} {{%ID%}} 34 {{%RECORD%}}: <br>编号(id) => 34,<br>Uid(user_id) => 1,<br>关联表ID(table_id) => ,<br>文件(filename) => 007.jpg,<br>文件类型(filetype) => image/jpeg,<br>后缀(extension) => jpg,<br>文件大小(filesize) => 250522,<br>文件大小(filesizecn) => 244.65 KB,<br>文件路径(filepath) => uploads/20180702/2f59542c2b69be5ff650b0b40697ae2a.jpg,<br>Ip(ip) => 127.0.0.1,<br>Web(web) => Chrome,<br>下载次数(downci) => ,<br>创建时间(created_at) => 1530545894,<br>最后更新(updated_at) => 1530545894', 1530545894, 1530545894);

-- --------------------------------------------------------

--
-- 表的结构 `byt_admin_roles`
--

CREATE TABLE `byt_admin_roles` (
  `id` int(11) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `role_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `byt_admin_roles`
--

INSERT INTO `byt_admin_roles` (`id`, `parent_id`, `role_name`, `remark`, `created_at`, `updated_at`) VALUES
(1, 0, '超级管理员', '', 1519657453, 1519657453),
(2, 0, '编辑部', '负责发布文章', 1521864679, 1521864679),
(3, 0, '宣传部', '负责发布活动，上传文化图片和视频', 1521865794, 1521865794);

-- --------------------------------------------------------

--
-- 表的结构 `byt_admin_role_permission`
--

CREATE TABLE `byt_admin_role_permission` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) UNSIGNED NOT NULL COMMENT '角色Id',
  `menu_id` int(11) UNSIGNED NOT NULL COMMENT '菜单Id',
  `opt_id` int(11) UNSIGNED NOT NULL COMMENT '操作者Id',
  `created_at` int(11) UNSIGNED NOT NULL COMMENT '创建时间',
  `updated_at` int(11) UNSIGNED DEFAULT '0' COMMENT '修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `byt_admin_role_permission`
--

INSERT INTO `byt_admin_role_permission` (`id`, `role_id`, `menu_id`, `opt_id`, `created_at`, `updated_at`) VALUES
(221, 3, 17, 1, 1522254012, 1522254012),
(222, 3, 84, 1, 1522254012, 1522254012),
(223, 3, 85, 1, 1522254012, 1522254012),
(224, 3, 86, 1, 1522254012, 1522254012),
(225, 3, 87, 1, 1522254012, 1522254012),
(226, 3, 88, 1, 1522254012, 1522254012),
(227, 3, 89, 1, 1522254012, 1522254012),
(228, 3, 105, 1, 1522254012, 1522254012),
(229, 3, 90, 1, 1522254012, 1522254012),
(230, 3, 91, 1, 1522254012, 1522254012),
(355, 2, 8, 1, 1525707609, 1525707609),
(356, 2, 9, 1, 1525707609, 1525707609),
(357, 2, 98, 1, 1525707609, 1525707609),
(358, 2, 47, 1, 1525707609, 1525707609),
(359, 2, 48, 1, 1525707609, 1525707609),
(360, 2, 49, 1, 1525707609, 1525707609),
(361, 2, 50, 1, 1525707609, 1525707609),
(362, 2, 51, 1, 1525707609, 1525707609),
(363, 2, 103, 1, 1525707609, 1525707609),
(364, 2, 10, 1, 1525707609, 1525707609),
(365, 2, 52, 1, 1525707609, 1525707609),
(366, 2, 53, 1, 1525707609, 1525707609),
(367, 2, 99, 1, 1525707609, 1525707609),
(368, 2, 54, 1, 1525707609, 1525707609),
(369, 2, 55, 1, 1525707609, 1525707609),
(370, 2, 56, 1, 1525707609, 1525707609),
(371, 2, 57, 1, 1525707609, 1525707609),
(372, 2, 58, 1, 1525707609, 1525707609),
(373, 2, 59, 1, 1525707609, 1525707609),
(374, 2, 104, 1, 1525707609, 1525707609),
(375, 2, 60, 1, 1525707609, 1525707609),
(376, 2, 61, 1, 1525707609, 1525707609),
(377, 2, 62, 1, 1525707609, 1525707609),
(378, 2, 63, 1, 1525707609, 1525707609),
(379, 2, 64, 1, 1525707609, 1525707609),
(380, 2, 100, 1, 1525707609, 1525707609),
(381, 2, 12, 1, 1525707609, 1525707609),
(382, 2, 11, 1, 1525707609, 1525707609),
(383, 2, 115, 1, 1525707609, 1525707609),
(384, 2, 116, 1, 1525707609, 1525707609),
(385, 2, 117, 1, 1525707609, 1525707609),
(386, 2, 118, 1, 1525707609, 1525707609),
(387, 2, 119, 1, 1525707609, 1525707609),
(388, 2, 120, 1, 1525707609, 1525707609),
(389, 2, 13, 1, 1525707609, 1525707609),
(390, 2, 25, 1, 1525707609, 1525707609),
(391, 2, 15, 1, 1525707609, 1525707609);

-- --------------------------------------------------------

--
-- 表的结构 `byt_admin_role_user`
--

CREATE TABLE `byt_admin_role_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `role_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `updated_at` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `byt_admin_role_user`
--

INSERT INTO `byt_admin_role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1521864627, 1521864627),
(2, 2, 2, 1521865223, 1521996768),
(3, 3, 2, 1521865422, 1521865422),
(4, 4, 3, 1521865824, 1521865824);

-- --------------------------------------------------------

--
-- 表的结构 `byt_admin_user`
--

CREATE TABLE `byt_admin_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `last_login_ip` char(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_count` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `byt_admin_user`
--

INSERT INTO `byt_admin_user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `avatar`, `status`, `last_login_ip`, `login_count`, `last_login_at`, `created_at`, `updated_at`) VALUES
(1, 'admin', '1TK5QuneTxFZxTyZRK-VZTX_bnPi8f1V', '$2y$13$DmhZ20zSUC8mhNnS2jL8oe.A5f7JBQVZvhQ0XuNi1fm4qSS1brz/y', NULL, 'admin@168.com', 'uploads/20180613/ae25d30cd2db2e5cac912338e2df4f51.jpg', 10, '127.0.0.1', 17, 1529939328, 1513140415, 1529313165),
(2, 'news_worker', 'VnztzJiSKR6sw2LtQVeqzMno9tG3HTJJ', '$2y$13$Y1/W7BNkQuKWRa3.i5hcVOmXc50SCKMNvCPBafM9elAnorBm56v82', NULL, 'news_worker@sina.cn', 'uploads/20180514/8b3bace3714be91d6fdfd4865672e207.jpg', 10, '127.0.0.1', 5, 1529425239, 1521864733, 1529425230),
(3, 'ruanwen', 'SFfUVAf7-1PcojJ0pO-C5uGdSjeGHrZL', '$2y$13$FZyiuGsBH1p1VUwpOAVac.HCjm6zXx/SzM4tVa8qzwSVSHjD9uhce', NULL, 'ruanwen@sina.cn', 'uploads/20180514/517fb1e8f38d136fa09247d96c06ffb7.jpg', 10, NULL, 0, 0, 1521865422, 1526308896),
(4, 'xuanchuan', 'FPyu0ONx0PVAOepNtKLUAT9sHTofwkxp', '$2y$13$iHuRQR4okLMOyo7wSjZaxuHUL.YnF0BDeoIjHWfmU2pCZkkHkqur.', NULL, 'xuanchuan@sina.cn', 'uploads/20180514/148289530d408d1be1595d464b15b770.jpg', 10, '127.0.0.1', 1, 1529425131, 1521865824, 1526308996);

-- --------------------------------------------------------

--
-- 表的结构 `byt_article`
--

CREATE TABLE `byt_article` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED DEFAULT '0' COMMENT '分类',
  `type` int(11) UNSIGNED DEFAULT '0' COMMENT '类型[0|文章，2|单页]',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `sub_title` varchar(255) DEFAULT '' COMMENT '副标题',
  `summary` varchar(255) DEFAULT '' COMMENT '概述',
  `thumb` varchar(255) DEFAULT '' COMMENT '缩略图',
  `seo_title` varchar(255) DEFAULT '' COMMENT 'seo标题',
  `seo_keywords` varchar(255) DEFAULT '' COMMENT 'seo关键字',
  `seo_description` varchar(255) DEFAULT '' COMMENT 'seo描述',
  `status` smallint(6) UNSIGNED DEFAULT '1' COMMENT '状态[1=>发布,2=>草稿]',
  `sort` int(11) UNSIGNED DEFAULT '0' COMMENT '排序',
  `user_id` int(11) UNSIGNED DEFAULT '0' COMMENT '作者',
  `scan_count` int(11) UNSIGNED DEFAULT '0' COMMENT '阅读量',
  `can_comment` smallint(6) UNSIGNED DEFAULT '1' COMMENT '是否评论[1=>是,2=>否]',
  `visibility` smallint(6) UNSIGNED DEFAULT '1' COMMENT '可见[1=>公开,2=>评论]',
  `tag` varchar(255) DEFAULT '' COMMENT '标签',
  `photo_file_ids` char(16) DEFAULT NULL COMMENT '相册文件',
  `flag_headline` smallint(6) UNSIGNED DEFAULT '0' COMMENT '头条',
  `flag_recommend` smallint(6) UNSIGNED DEFAULT '0' COMMENT '推荐',
  `flag_slide_show` smallint(6) UNSIGNED DEFAULT '0' COMMENT '幻灯',
  `flag_special_recommend` smallint(6) UNSIGNED DEFAULT '0' COMMENT '特别推荐',
  `flag_roll` smallint(6) UNSIGNED DEFAULT '0' COMMENT '滚动',
  `flag_bold` smallint(6) UNSIGNED DEFAULT '0' COMMENT '加粗',
  `flag_picture` smallint(6) UNSIGNED DEFAULT '0' COMMENT '图片',
  `created_at` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `updated_at` int(11) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='内容表';

--
-- 转存表中的数据 `byt_article`
--

INSERT INTO `byt_article` (`id`, `category_id`, `type`, `title`, `sub_title`, `summary`, `thumb`, `seo_title`, `seo_keywords`, `seo_description`, `status`, `sort`, `user_id`, `scan_count`, `can_comment`, `visibility`, `tag`, `photo_file_ids`, `flag_headline`, `flag_recommend`, `flag_slide_show`, `flag_special_recommend`, `flag_roll`, `flag_bold`, `flag_picture`, `created_at`, `updated_at`) VALUES
(3, 4, 0, '使用vue-cli引入bootstrap', 'vue-cli引入bootstrap', '对于刚刚进入vuejs的队伍中的小白来讲，很多都是模糊的，js操作dom节点的思想萦绕，还不能自由切换在二者之间\r\n', '', 'vuejs 使用vue-cli引入bootstrap', 'vuejs,vuecli', 'vuejs 使用vue-cli引入bootstrap', 1, 0, 1, 0, 1, 1, '', NULL, 1, 1, 0, 0, 0, 0, 0, 1523762424, 1523777321),
(4, 5, 0, '关于防火墙的规则', '防火墙的规则', '防火墙的规则的指定', 'uploads/thumb/5ad3002543ca4_timg (1).jpg', '防火墙', '防火墙,firewall', '防火墙,firewall', 1, 2, 1, 0, 0, 1, '防火墙', NULL, 0, 0, 0, 0, 0, 1, 1, 1523777573, 1523777573),
(5, 0, 2, '联系方式', 'contact', '', '', '', '', '', 1, 0, 1, 0, 1, 1, '', NULL, 0, 0, 0, 0, 0, 0, 0, 1523779761, 1523779761),
(6, 0, 2, '关于我们', 'about', '', '', '​JCYCMS', '​JCYCMS,yjc,cms', '基于yii2的cms管理系统', 1, 0, 1, 0, 1, 1, '', NULL, 0, 0, 0, 0, 0, 0, 0, 1523780535, 1523781607),
(7, 1, 0, 'php签名认证', 'php sign', '开年第一篇，该篇主要讲述了接口开发中，如何安全认证、如何用php签名认证。', 'uploads/thumb/5ad33ad9977a2_1-1G01G63RK58.jpg', 'php签名认证', 'php,签名认证,sign', 'php,签名认证,sign', 1, 0, 1, 0, 1, 1, 'php', NULL, 1, 1, 0, 0, 0, 0, 0, 1523792601, 1523792601),
(10, 1, 0, 'yii2多文件上传', '文件上传', 'yii2多文件上传', 'uploads/thumb/1526309317-5af9a1c5b39f6_a5.jpg', 'yii2多文件上传', 'yii2,多文件上传,file,uploads', 'yii2文件上传操作', 1, 2, 1, 0, 1, 1, 'yii2多文件上传', NULL, 1, 0, 0, 0, 0, 0, 0, 1526309317, 1526309317),
(11, 6, 3, '赵丽颖', '颖宝', '', '', '赵丽颖', '赵丽颖', '赵丽颖', 1, 0, 1, 0, 1, 1, '', '28,27,24,25,26', 0, 0, 0, 0, 0, 0, 0, 1526309482, 1526312599);

-- --------------------------------------------------------

--
-- 表的结构 `byt_article_content`
--

CREATE TABLE `byt_article_content` (
  `id` int(11) UNSIGNED NOT NULL,
  `article_id` int(11) UNSIGNED DEFAULT '0' COMMENT '文章表ID',
  `content` text COMMENT '内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `byt_article_content`
--

INSERT INTO `byt_article_content` (`id`, `article_id`, `content`) VALUES
(3, 3, '<p>想要在vue中引入bootstrap，引入的时候需要按照如下的步骤进行。</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;</p><p>1、引入jquery&nbsp;2、引入bootstrap</p><p>阅读本文前，应该能够搭建环境，使用vue-cli进行项目的创建，可以参考文章：<a title=\"vue-cli项目搭建\" href=\"http://www.cnblogs.com/YangJieCheng/p/%E6%83%B3%E8%A6%81%E5%9C%A8vue%E4%B8%AD%E5%BC%95%E5%85%A5bootstrap%EF%BC%8C%E5%BC%95%E5%85%A5%E7%9A%84%E6%97%B6%E5%80%99%E9%9C%80%E8%A6%81%E6%8C%89%E7%85%A7%E5%A6%82%E4%B8%8B%E7%9A%84%E6%AD%A5%E9%AA%A4%E8%BF%9B%E8%A1%8C%E3%80%82%20%201%E3%80%81%E5%BC%95%E5%85%A5jquery%20%202%E3%80%81%E5%BC%95%E5%85%A5bootstrap%20%20%20%20%20%E9%98%85%E8%AF%BB%E6%9C%AC%E6%96%87%E5%89%8D%EF%BC%8C%E5%BA%94%E8%AF%A5%E8%83%BD%E5%A4%9F%E6%90%AD%E5%BB%BA%E7%8E%AF%E5%A2%83%EF%BC%8C%E4%BD%BF%E7%94%A8vue-cli%E8%BF%9B%E8%A1%8C%E9%A1%B9%E7%9B%AE%E7%9A%84%E5%88%9B%E5%BB%BA%EF%BC%8C%E5%8F%AF%E4%BB%A5%E5%8F%82%E8%80%83%E6%96%87%E7%AB%A0%EF%BC%9A%20%20http://blog.csdn.net/wild46cat/article/details/76360229%20%20%20%20%20%E5%A5%BD%EF%BC%8C%E4%B8%8B%E9%9D%A2%E4%B8%8A%E8%B4%A7%E3%80%82%20%201%E3%80%81%E9%A6%96%E5%85%88%E6%8C%89%E7%85%A7%E4%B8%8A%E9%9D%A2%E6%96%87%E7%AB%A0%E4%B8%AD%E7%9A%84%E5%86%85%E5%AE%B9%EF%BC%8C%E6%96%B0%E5%BB%BA%E4%B8%80%E4%B8%AAvue%E5%B7%A5%E7%A8%8B%E3%80%82%20%20%20%20%202%E3%80%81%E4%BD%BF%E7%94%A8%E5%91%BD%E4%BB%A4npm%20install%20jquery%20--save-dev%20%E5%BC%95%E5%85%A5jquery%E3%80%82%20%20%20%20%203%E3%80%81%E5%9C%A8webpack.base.conf.js%E4%B8%AD%E6%B7%BB%E5%8A%A0%E5%A6%82%E4%B8%8B%E5%86%85%E5%AE%B9%EF%BC%9A\" target=\"_blank\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0);\">http://blog.csdn.net/wild46cat/article/details/76360229</a></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">：</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;1、通过npm view 模块名 versions来查看模块目前的版本，安装也可以选择版本安装。例如：cnpm install jquery@11.7 --save-dev</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;2、 安装参数 --save 与 --save-dev 区别在于--save-dev安装于开发环境中（更多百度“npm”）　</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;3、使用命令npm install jquery --save-dev（或者 cnpm install jquery --save-dev） 引入jquery。</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;4、在webpack.base.conf.js（<span style=\"margin: 0px; padding: 0px; color: rgb(255, 0, 0);\">如果是是开发[dev]环境则在webpack.dev.conf.js；两个文件都在bulid目录下；请一定注意，我在操作的时候就是找错了文件，半天都没有弄对；</span>）中添加如下内容：</p><pre class=\"brush:js;toolbar:false\">var&nbsp;webpack&nbsp;=&nbsp;require(&#39;webpack&#39;)\r\n\r\n\r\n//和\r\n\r\nplugins:&nbsp;[\r\n&nbsp;&nbsp;new&nbsp;webpack.ProvidePlugin({\r\n&nbsp;&nbsp;&nbsp;&nbsp;$:&nbsp;&quot;jquery&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;jQuery:&nbsp;&quot;jquery&quot;\r\n&nbsp;&nbsp;})\r\n],</pre><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><img src=\"https://images2018.cnblogs.com/blog/990003/201803/990003-20180319105539973-2124747542.png\" alt=\"\" style=\"margin: 0px auto; padding: 0px; border: none; max-width: 800px; display: block;\"/></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><img src=\"https://images2018.cnblogs.com/blog/990003/201803/990003-20180319105550929-1799348791.png\" alt=\"\" style=\"margin: 0px auto; padding: 0px; border: none; max-width: 800px; display: block;\"/></p><p style=\"text-align: left;\"><span style=\"color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">5、在main.js中添加内容:</span></p><pre class=\"brush:js;toolbar:false\">import&nbsp;$&nbsp;from&nbsp;&#39;jquery&#39;</pre><p style=\"text-align: left;\"><span style=\"color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\"></span></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">6、安装bootstrap，使用命令cnpm install bootstrap --save-dev</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">7、安装成功后，能够在package.json文件夹中看到bootstrap这个模块。这时候需要在main.js中添加如下内容:</p><pre class=\"brush:js;toolbar:false\">import&nbsp;&#39;bootstrap/dist/css/bootstrap.min.css&#39;\r\nimport&nbsp;&#39;bootstrap/dist/js/bootstrap.min&#39;</pre><p style=\"text-align: left;\"><span style=\"color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">8、添加完成后，重新启动程序，cnpm run dev(重启的过程中可能会出现如下图的错误：跟着错误提示，你需要安装 axios popper.js）</span></p><p style=\"text-align: left;\"></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><img src=\"https://images2018.cnblogs.com/blog/990003/201803/990003-20180319110216431-117288794.png\" alt=\"\" style=\"margin: 0px auto; padding: 0px; border: none; max-width: 800px; display: block;\"/></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">9、测试jquery、与boostrap安装是否成功</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><img src=\"https://images2018.cnblogs.com/blog/990003/201803/990003-20180319110352560-679959470.png\" alt=\"\" style=\"margin: 0px auto; padding: 0px; border: none; max-width: 800px; display: block;\"/></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; background-color: rgb(204, 255, 255);\"><span style=\"margin: 0px; padding: 0px; background-color: rgb(255, 255, 255);\">&nbsp;　 &nbsp;<strong style=\"margin: 0px; padding: 0px;\"><span style=\"margin: 0px; padding: 0px; font-size: 14pt;\">后记：</span></strong></span></span></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; background-color: rgb(255, 153, 204);\"><span style=\"margin: 0px; padding: 0px;\">　　　　　　结合着官方文档，进入了条件渲染，偶然发现样式太丑，于是就想着如何把bootstrap引入进来，看着好看些，于是百度了，找到了文章，可也还是遇到了一些问题，感觉这些问题比较容易出现，所以就记录一笔随笔。</span><br style=\"margin: 0px; padding: 0px;\"/></span></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; background-color: rgb(204, 255, 255);\"><span style=\"margin: 0px; padding: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; background-color: rgb(255, 153, 204);\">　　　　　　如果是php程序员，你会发现node项目开发和phpcomposer开发是几乎一样的，据说是php学习的npm^_^</span></span></span></p><p style=\"text-align: left;\"><span style=\"color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\"><br/></span><br/></p>'),
(4, 3, '<p>dddddd想要在vue中引入bootstrap，引入的时候需要按照如下的步骤进行。</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;</p><p>1、引入jquery&nbsp;2、引入bootstrap</p><p>阅读本文前，应该能够搭建环境，使用vue-cli进行项目的创建，可以参考文章：<a title=\"vue-cli项目搭建\" href=\"http://www.cnblogs.com/YangJieCheng/p/%E6%83%B3%E8%A6%81%E5%9C%A8vue%E4%B8%AD%E5%BC%95%E5%85%A5bootstrap%EF%BC%8C%E5%BC%95%E5%85%A5%E7%9A%84%E6%97%B6%E5%80%99%E9%9C%80%E8%A6%81%E6%8C%89%E7%85%A7%E5%A6%82%E4%B8%8B%E7%9A%84%E6%AD%A5%E9%AA%A4%E8%BF%9B%E8%A1%8C%E3%80%82%20%201%E3%80%81%E5%BC%95%E5%85%A5jquery%20%202%E3%80%81%E5%BC%95%E5%85%A5bootstrap%20%20%20%20%20%E9%98%85%E8%AF%BB%E6%9C%AC%E6%96%87%E5%89%8D%EF%BC%8C%E5%BA%94%E8%AF%A5%E8%83%BD%E5%A4%9F%E6%90%AD%E5%BB%BA%E7%8E%AF%E5%A2%83%EF%BC%8C%E4%BD%BF%E7%94%A8vue-cli%E8%BF%9B%E8%A1%8C%E9%A1%B9%E7%9B%AE%E7%9A%84%E5%88%9B%E5%BB%BA%EF%BC%8C%E5%8F%AF%E4%BB%A5%E5%8F%82%E8%80%83%E6%96%87%E7%AB%A0%EF%BC%9A%20%20http://blog.csdn.net/wild46cat/article/details/76360229%20%20%20%20%20%E5%A5%BD%EF%BC%8C%E4%B8%8B%E9%9D%A2%E4%B8%8A%E8%B4%A7%E3%80%82%20%201%E3%80%81%E9%A6%96%E5%85%88%E6%8C%89%E7%85%A7%E4%B8%8A%E9%9D%A2%E6%96%87%E7%AB%A0%E4%B8%AD%E7%9A%84%E5%86%85%E5%AE%B9%EF%BC%8C%E6%96%B0%E5%BB%BA%E4%B8%80%E4%B8%AAvue%E5%B7%A5%E7%A8%8B%E3%80%82%20%20%20%20%202%E3%80%81%E4%BD%BF%E7%94%A8%E5%91%BD%E4%BB%A4npm%20install%20jquery%20--save-dev%20%E5%BC%95%E5%85%A5jquery%E3%80%82%20%20%20%20%203%E3%80%81%E5%9C%A8webpack.base.conf.js%E4%B8%AD%E6%B7%BB%E5%8A%A0%E5%A6%82%E4%B8%8B%E5%86%85%E5%AE%B9%EF%BC%9A\" target=\"_blank\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0);\">http://blog.csdn.net/wild46cat/article/details/76360229</a></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">：</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;1、通过npm view 模块名 versions来查看模块目前的版本，安装也可以选择版本安装。例如：cnpm install jquery@11.7 --save-dev</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;2、 安装参数 --save 与 --save-dev 区别在于--save-dev安装于开发环境中（更多百度“npm”）　</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;3、使用命令npm install jquery --save-dev（或者 cnpm install jquery --save-dev） 引入jquery。</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;4、在webpack.base.conf.js（<span style=\"margin: 0px; padding: 0px; color: rgb(255, 0, 0);\">如果是是开发[dev]环境则在webpack.dev.conf.js；两个文件都在bulid目录下；请一定注意，我在操作的时候就是找错了文件，半天都没有弄对；</span>）中添加如下内容：</p><pre class=\"brush:js;toolbar:false\">var&nbsp;webpack&nbsp;=&nbsp;require(&#39;webpack&#39;)\r\n\r\n\r\n//和\r\n\r\nplugins:&nbsp;[\r\n&nbsp;&nbsp;new&nbsp;webpack.ProvidePlugin({\r\n&nbsp;&nbsp;&nbsp;&nbsp;$:&nbsp;&quot;jquery&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;jQuery:&nbsp;&quot;jquery&quot;\r\n&nbsp;&nbsp;})\r\n],</pre><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><img src=\"https://images2018.cnblogs.com/blog/990003/201803/990003-20180319105539973-2124747542.png\" alt=\"\" style=\"margin: 0px auto; padding: 0px; border: none; max-width: 800px; display: block;\"/></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><img src=\"https://images2018.cnblogs.com/blog/990003/201803/990003-20180319105550929-1799348791.png\" alt=\"\" style=\"margin: 0px auto; padding: 0px; border: none; max-width: 800px; display: block;\"/></p><p style=\"text-align: left;\"><span style=\"color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">5、在main.js中添加内容:</span></p><pre class=\"brush:js;toolbar:false\">import&nbsp;$&nbsp;from&nbsp;&#39;jquery&#39;</pre><p style=\"text-align: left;\"><span style=\"color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\"></span></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">6、安装bootstrap，使用命令cnpm install bootstrap --save-dev</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">7、安装成功后，能够在package.json文件夹中看到bootstrap这个模块。这时候需要在main.js中添加如下内容:</p><pre class=\"brush:js;toolbar:false\">import&nbsp;&#39;bootstrap/dist/css/bootstrap.min.css&#39;\r\nimport&nbsp;&#39;bootstrap/dist/js/bootstrap.min&#39;</pre><p style=\"text-align: left;\"><span style=\"color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">8、添加完成后，重新启动程序，cnpm run dev(重启的过程中可能会出现如下图的错误：跟着错误提示，你需要安装 axios popper.js）</span></p><p style=\"text-align: left;\"><br/></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><img src=\"https://images2018.cnblogs.com/blog/990003/201803/990003-20180319110216431-117288794.png\" alt=\"\" style=\"margin: 0px auto; padding: 0px; border: none; max-width: 800px; display: block;\"/></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">9、测试jquery、与boostrap安装是否成功</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><img src=\"https://images2018.cnblogs.com/blog/990003/201803/990003-20180319110352560-679959470.png\" alt=\"\" style=\"margin: 0px auto; padding: 0px; border: none; max-width: 800px; display: block;\"/></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">&nbsp;</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; background-color: rgb(204, 255, 255);\"><span style=\"margin: 0px; padding: 0px; background-color: rgb(255, 255, 255);\">&nbsp;　 &nbsp;<strong style=\"margin: 0px; padding: 0px;\"><span style=\"margin: 0px; padding: 0px; font-size: 14pt;\">后记：</span></strong></span></span></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; background-color: rgb(255, 153, 204);\"><span style=\"margin: 0px; padding: 0px;\">　　　　　　结合着官方文档，进入了条件渲染，偶然发现样式太丑，于是就想着如何把bootstrap引入进来，看着好看些，于是百度了，找到了文章，可也还是遇到了一些问题，感觉这些问题比较容易出现，所以就记录一笔随笔。</span><br style=\"margin: 0px; padding: 0px;\"/></span></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; background-color: rgb(204, 255, 255);\"><span style=\"margin: 0px; padding: 0px; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; background-color: rgb(255, 153, 204);\">　　　　　　如果是php程序员，你会发现node项目开发和phpcomposer开发是几乎一样的，据说是php学习的npm^_^</span></span></span></p><p style=\"text-align: left;\"><span style=\"color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\"><br/></span><br/></p>'),
(5, 4, '<p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">防火墙入站规则：别人电脑访问自己电脑的规则；</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">防火墙出站规则：自己电脑访问别人电脑的规则。</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">简单的说 出站就是你访问外网 入站就是外网访问你 用户可以创建入站和出站规则，从而阻挡或者允许特定程序或者端口进行连接; 可以使用预先设置的规则，也可以创建自定义规则，“新建规则向导”可以帮用户逐步完成创建规则的步骤；用户可以将规则应用于一组程序、端口或者服务，也可 以将规则应用于所有程序或者某个特定程序；可以阻挡某个软件进行所有连接、允许所有连接，或者只允许安全连接，并要求使用加密来保护通过该连接发送的数据 的安全性; 可以为入站和出站流量配置源IP地址及目的地IP地址，同样还可以为源TCP和UDP端口及目的地TCP和UPD端口配置</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">以下是关于ubuntu的规则配置</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">sudo ufw status(如果你是root，则去掉sudo，ufw status)可检查防火墙的状态，我的返回的是：inactive(默认为不活动)。<br style=\"margin: 0px; padding: 0px;\"/>sudo ufw version防火墙版本：&nbsp;<br style=\"margin: 0px; padding: 0px;\"/>ufw 0.29-4ubuntu1&nbsp;<br style=\"margin: 0px; padding: 0px;\"/>Copyright 2008-2009 Canonical Ltd.<br style=\"margin: 0px; padding: 0px;\"/>ubuntu 系统默认已安装ufw.</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><strong style=\"margin: 0px; padding: 0px;\">1.安装</strong></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">sudo apt-get install ufw</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><strong style=\"margin: 0px; padding: 0px;\">2.启用</strong></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">sudo ufw enable<br style=\"margin: 0px; padding: 0px;\"/>sudo ufw default deny<br style=\"margin: 0px; padding: 0px;\"/>运行以上两条命令后，开启了防火墙，并在系统启动时自动开启。关闭所有外部对本机的访问，但本机访问外部正常。</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><strong style=\"margin: 0px; padding: 0px;\">3.开启/禁用</strong></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">sudo ufw allow|deny [service]<br style=\"margin: 0px; padding: 0px;\"/>打开或关闭某个端口，例如：<br style=\"margin: 0px; padding: 0px;\"/>sudo ufw allow smtp　允许所有的外部IP访问本机的25/tcp (smtp)端口<br style=\"margin: 0px; padding: 0px;\"/>sudo ufw allow 22/tcp 允许所有的外部IP访问本机的22/tcp (ssh)端口<br style=\"margin: 0px; padding: 0px;\"/>这个很重要，ssh远程登录用于SecureCRT等软件建议开启。或者不要开防火墙。<br style=\"margin: 0px; padding: 0px;\"/>sudo ufw allow 53 允许外部访问53端口(tcp/udp)<br style=\"margin: 0px; padding: 0px;\"/>sudo ufw allow from 192.168.1.100 允许此IP访问所有的本机端口<br style=\"margin: 0px; padding: 0px;\"/>sudo ufw allow proto udp 192.168.0.1 port 53 to 192.168.0.2 port 53<br style=\"margin: 0px; padding: 0px;\"/>sudo ufw deny smtp 禁止外部访问smtp服务<br style=\"margin: 0px; padding: 0px;\"/>sudo ufw delete allow smtp 删除上面建立的某条规则</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><strong style=\"margin: 0px; padding: 0px;\">4.查看防火墙状态</strong></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">sudo ufw status<br style=\"margin: 0px; padding: 0px;\"/>一般用户，只需如下设置：<br style=\"margin: 0px; padding: 0px;\"/>sudo apt-get install ufw<br style=\"margin: 0px; padding: 0px;\"/>sudo ufw enable<br style=\"margin: 0px; padding: 0px;\"/>sudo ufw default deny<br style=\"margin: 0px; padding: 0px;\"/>以上三条命令已经足够安全了，如果你需要开放某些服务，再使用sudo ufw allow开启。<br style=\"margin: 0px; padding: 0px;\"/>开启/关闭防火墙 (默认设置是’disable’)<br style=\"margin: 0px; padding: 0px;\"/>sudo ufw enable|disable<br style=\"margin: 0px; padding: 0px;\"/>转换日志状态<br style=\"margin: 0px; padding: 0px;\"/>sudo ufw logging on|off<br style=\"margin: 0px; padding: 0px;\"/>设置默认策略 (比如 “mostly open” vs “mostly closed”)<br style=\"margin: 0px; padding: 0px;\"/>sudo ufw default allow|deny<br style=\"margin: 0px; padding: 0px;\"/>许 可或者屏蔽端口 (可以在“status” 中查看到服务列表)。可以用“协议：端口”的方式指定一个存在于/etc/services中的服务名称，也可以通过包的meta-data。 ‘allow’ 参数将把条目加入 /etc/ufw/maps ，而 ‘deny’ 则相反。基本语法如下：<br style=\"margin: 0px; padding: 0px;\"/>sudo ufw allow|deny [service]<br style=\"margin: 0px; padding: 0px;\"/>显示防火墙和端口的侦听状态，参见 /var/lib/ufw/maps。括号中的数字将不会被显示出来。<br style=\"margin: 0px; padding: 0px;\"/>sudo ufw status<br style=\"margin: 0px; padding: 0px;\"/>UFW 使用范例：<br style=\"margin: 0px; padding: 0px;\"/>允许 53 端口<br style=\"margin: 0px; padding: 0px;\"/>$ sudo ufw allow 53<br style=\"margin: 0px; padding: 0px;\"/>禁用 53 端口<br style=\"margin: 0px; padding: 0px;\"/>$ sudo ufw delete allow 53<br style=\"margin: 0px; padding: 0px;\"/>允许 80 端口<br style=\"margin: 0px; padding: 0px;\"/>$ sudo ufw allow 80/tcp<br style=\"margin: 0px; padding: 0px;\"/>禁用 80 端口<br style=\"margin: 0px; padding: 0px;\"/>$ sudo ufw delete allow 80/tcp<br style=\"margin: 0px; padding: 0px;\"/>允许 smtp 端口<br style=\"margin: 0px; padding: 0px;\"/>$ sudo ufw allow smtp<br style=\"margin: 0px; padding: 0px;\"/>删除 smtp 端口的许可<br style=\"margin: 0px; padding: 0px;\"/>$ sudo ufw delete allow smtp<br style=\"margin: 0px; padding: 0px;\"/>允许某特定 IP<br style=\"margin: 0px; padding: 0px;\"/>$ sudo ufw allow from 192.168.254.254<br style=\"margin: 0px; padding: 0px;\"/>删除上面的规则<br style=\"margin: 0px; padding: 0px;\"/>$ sudo ufw delete allow from 192.168.254.254<br style=\"margin: 0px; padding: 0px;\"/>linux 2.4内核以后提供了一个非常优秀的防火墙工具：netfilter/iptables,他免费且功能强大，可以对流入、流出的信息进行细化控制，它可以 实现防火墙、NAT（网络地址翻译）和数据包的分割等功能。netfilter工作在内核内部，而iptables则是让用户定义规则集的表结构。</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">但是iptables的规则稍微有些“复杂”，因此ubuntu提供了ufw这个设定工具，以简化iptables的某些设定，其后台仍然是 iptables。ufw 即uncomplicated firewall的简称，一些复杂的设定还是要去iptables。</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><strong style=\"margin: 0px; padding: 0px;\">ufw相关的文件和文件夹有：</strong></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">/etc /ufw/：里面是一些ufw的环境设定文件，如 before.rules、after.rules、sysctl.conf、ufw.conf，及 for ip6 的 before6.rule 及 after6.rules。这些文件一般按照默认的设置进行就ok。</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">若开启ufw之 后，/etc/ufw/sysctl.conf会覆盖默认的/etc/sysctl.conf文件，若你原来的/etc/sysctl.conf做了修 改，启动ufw后，若/etc/ufw/sysctl.conf中有新赋值，则会覆盖/etc/sysctl.conf的，否则还以/etc /sysctl.conf为准。当然你可以通过修改/etc/default/ufw中的“IPT_SYSCTL=”条目来设置使用哪个 sysctrl.conf.</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">/var/lib/ufw/user.rules 这个文件中是我们设置的一些防火墙规则，打开大概就能看明白，有时我们可以直接修改这个文件，不用使用命令来设定。修改后记得ufw reload重启ufw使得新规则生效。</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><strong style=\"margin: 0px; padding: 0px;\">下面是ufw命令行的一些示例：</strong></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">ufw enable/disable:打开/关闭ufw<br style=\"margin: 0px; padding: 0px;\"/>ufw status：查看已经定义的ufw规则<br style=\"margin: 0px; padding: 0px;\"/>ufw default allow/deny:外来访问默认允许/拒绝<br style=\"margin: 0px; padding: 0px;\"/>ufw allow/deny 20：允许/拒绝 访问20端口,20后可跟/tcp或/udp，表示tcp或udp封包。<br style=\"margin: 0px; padding: 0px;\"/>ufw allow/deny servicename:ufw从/etc/services中找到对应service的端口，进行过滤。<br style=\"margin: 0px; padding: 0px;\"/>ufw allow proto tcp from 10.0.1.0/10 to 本机ip port 25:允许自10.0.1.0/10的tcp封包访问本机的25端口。<br style=\"margin: 0px; padding: 0px;\"/>ufw delete allow/deny 20:删除以前定义的&quot;允许/拒绝访问20端口&quot;的规则</p><p><br/></p>'),
(6, 5, '<p style=\"white-space: normal;\">QQ:2064320087</p><p style=\"white-space: normal;\">Email:2064320087#qq.com(请将@替换成＃)</p><p><br/></p>'),
(7, 6, '<p>&nbsp;&nbsp;&nbsp;&nbsp;JCYCMS是基于yii2框架开发的一套cms系统，功能代码简单基础，纯yii2框架代码风格，适合初级开发者学习参考。<br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;该系统主要有后台管理（rabc、支持前端模板选择【使用者可以使用系统内置的几套模板任意切换使用】）模块、前端数据展示（含用户登录注册）模块、api接口（提供文章内容数据接口，供其它终端和系统使用）。</p><p>&nbsp;&nbsp; &nbsp; 该系统完全开源，开发者可自由更改；非开发者使用系统可联系作者，作者支持功能制作以及前端模板替换（前提：模板均由你们提供），开发费用根据功能难易程度收取费用。</p>'),
(8, 6, '<p>&nbsp;&nbsp;&nbsp;&nbsp;JCYCMS是基于yii2框架开发的一套cms系统，功能代码简单基础，纯yii2框架代码风格，适合初级开发者学习参考。<br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;该系统主要有后台管理（rabc、支持前端模板选择【使用者可以使用系统内置的几套模板任意切换使用】）模块、前端数据展示（含用户登录注册）模块、api接口（提供文章内容数据接口，供其它终端和系统使用）。</p><p>&nbsp; &nbsp; 系统完全开源，欢迎大家提出宝贵的意见。对于开发者们可自由更改，对于非开发者使用系统可联系作者，作者支持新功能制作以及前端模板替换（前提：模板均由你们提供），开发费用根据功能难易程度收取费用。</p>');
INSERT INTO `byt_article_content` (`id`, `article_id`, `content`) VALUES
(9, 7, '<h1 style=\"margin: 10px 0px; padding: 0px; font-size: 28px; line-height: 1.5; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">一、概述</h1><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　　　　　　　开年第一篇，该篇主要讲述了接口开发中，如何安全认证、如何用php签名认证。</p><h1 style=\"margin: 10px 0px; padding: 0px; font-size: 28px; line-height: 1.5; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">　　二、说说历史</h1><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　　　　　　　签名认证是什么？为什么要做签名认证？签名认证哪里会用到？no、no、no.....是不是，是不是，一下子疑问就这么多了！没事儿，通过追溯历史，我们来明白这些。</p><h2 style=\"margin: 20px 0px; padding: 0px; font-size: 21px; line-height: 1.5; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">　　　　　1、签名认证是什么？</h2><p>　　　　　　　　数字签名是一种类似写在纸上的普通的物理签名，但是使用了公钥加密领域的技术实现，用于鉴别数字信息的方法。一套数字签名通常定义两种互补的运算，一个用于签名，另一个用于验证。</p><p>数字签名，就是只有信息的发送者才能产生的别人无法伪造的一段数字串，这段数字串同时也是对信息的发送者发送信息真实性的一个有效证明。</p><p>　　　　　　　　在这个以“数据为生命”的时代，每一个开发商都尽可能的收集客户的数据建立自己的BI库，各系统、各平台间数据的传输和调用变得非常普遍且非常重要；那么作为开发人员，我们不但要防止系统被攻击被入侵，我们还要确保数据的安全和完整</p><h2 class=\"para\" style=\"margin: 20px 0px; padding: 0px; font-size: 21px; line-height: 1.5; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">　　　　 &nbsp; 2、为什么要做签名认证？</h2><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　　　　　　　在使用http或者soap传输数据的时候，签名作为其中一个参数，可以起到关键作用：1、鉴权（通过客户的密钥，服务端的密钥匹配）；2、数据防篡改（参数是明文传输，将参数及密钥加密作为签名与服务器匹配）；下面来分析下具体的方式：&nbsp;<br style=\"margin: 0px; padding: 0px;\"/><br style=\"margin: 0px; padding: 0px;\"/>　　　　　　　　将请求参数中的各个键值对按照key的字符串顺序升序排列（大小写敏感），把key和value拼成一串之后最后加上密钥，组成key1value1key2value2PRIVATEKEY的格式，转成utf-8编码的字节序列后计算md5，作为请求的签名。计算出来的签名串应当全为小写形式。如果某个参数的值为空，则此参数不参与签名。&nbsp;</p><h2 style=\"margin: 20px 0px; padding: 0px; font-size: 21px; line-height: 1.5; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">　　　　 &nbsp;3、签名认证哪里会用到？</h2><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　　　　　　　最常见的使我们在开发接口的时候，为了不被非法访问，往往我们会做签名认证，比如支付接口......</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　　　　　　　然后就是第三方平台的开发，比如微信公众平台......</p><h1 style=\"margin: 10px 0px; padding: 0px; font-size: 28px; line-height: 1.5; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">　　三、流程分析</h1><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　　　　　客户端：首先我们为提供给用户一份接口文档，文档里面我们给用户提供api地址、签名算法解析过程、数据说明。</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　　　　 &nbsp; 服务端：进行客户端检验，通常就是参数个数、格式验证，app_key验证（这个是博主这里使用的，这个app_key会交给用户，用户访问接口的时候必须带上该app_key），签名结果验证。</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　　　　　以我这次写的为例子来描述一下整个流程：</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　　　　　　　用户参照我们提供的接口文档，请求我们的接口，用户按照我们接口说明的签名算法生成签名串作为参数，然后带上必要的参数（GET、POST），如果服务端验证成功，则返回真实数据。</p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　　　<img src=\"https://images2018.cnblogs.com/blog/990003/201803/990003-20180306163607582-246972988.png\" alt=\"\" style=\"margin: 0px auto; padding: 0px; border: none; max-width: 800px; display: block;\"/></p><p style=\"margin: 10px auto; padding: 0px; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">　　　　　　　　在服务端：我们首要验证提交参数的个数、格式是否正确，然后我们通过提交的参数用签名算法生成一个签名串，最后服务端生成的签名串和客户端提交过来的签名串进行比较，成功返回真实数据。</p><h1 style=\"margin: 10px 0px; padding: 0px; font-size: 28px; line-height: 1.5; color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">四、上代码</h1><pre class=\"brush:php;toolbar:false\">&lt;?php&nbsp;\r\nnamespace&nbsp;ceshi;\r\n\r\n/**\r\n&nbsp;*&nbsp;签名认证算法\r\n&nbsp;*&nbsp;HMAC-SHA256加密方式\r\n&nbsp;*&nbsp;登录认证加入access_token:access-token通过登录接口去获取，通过刷新接口去刷新，需要注意返回的过期时间，要在过期时间之前刷新重新获取access-token。目前约定所有接口都必须传access-token，也就是用户必须先登录才可以看到相关内容\r\n&nbsp;*&nbsp;随机函数可换更好的方法-本实例随机函数比较简单，随机性不够\r\n&nbsp;*&nbsp;ApiSign类作为服务端，类以外的代码作为客户端示例代码\r\n&nbsp;*&nbsp;author&nbsp;jiechengyang&nbsp;https://www.cnblogs.com/YangJieCheng/\r\n&nbsp;*/\r\nclass&nbsp;ApiSign&nbsp;\r\n{\r\n&nbsp;&nbsp;&nbsp;&nbsp;CONST&nbsp;DELAY_TIME&nbsp;=&nbsp;2000;\r\n&nbsp;&nbsp;&nbsp;&nbsp;CONST&nbsp;ACCESS_TOCEN_PATH&nbsp;=&nbsp;&#39;./access_token&#39;;\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;$_config&nbsp;=&nbsp;[];\r\n&nbsp;&nbsp;&nbsp;&nbsp;protected&nbsp;$AppKey&nbsp;=&nbsp;&#39;voBVVQxfMxDmhuxV70&#39;;\r\n&nbsp;&nbsp;&nbsp;&nbsp;protected&nbsp;$AppSecret&nbsp;=&nbsp;&#39;QJF5P8qWFJakF9Ve89ZcIstHKbkt5fVA&#39;;\r\n&nbsp;&nbsp;&nbsp;&nbsp;protected&nbsp;$timeout&nbsp;=&nbsp;300;\r\n&nbsp;&nbsp;&nbsp;&nbsp;protected&nbsp;$algo&nbsp;=&nbsp;&#39;sha256&#39;;\r\n&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;$loginCheck&nbsp;=&nbsp;false;\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;__construct($config,&nbsp;$loginCheck)\r\n&nbsp;&nbsp;&nbsp;&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;_config&nbsp;=&nbsp;$config;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;empty($this-&gt;AppKey)&nbsp;&amp;&amp;&nbsp;$this-&gt;AppKey&nbsp;=&nbsp;$this-&gt;generateRandomString();\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;empty($this-&gt;AppSecret)&nbsp;&amp;&amp;&nbsp;$this-&gt;AppSecret&nbsp;=&nbsp;$this-&gt;generateRangeNum();\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;loginCheck&nbsp;=&nbsp;$loginCheck;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($this-&gt;init())&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&#39;&lt;span&nbsp;style=&quot;color:red&quot;&nbsp;id=&quot;sign_success&quot;&gt;恭喜，签名认证成功&lt;/span&gt;&lt;script&nbsp;type=&quot;text/javascript&quot;&gt;&lt;/script&gt;&#39;;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;&lt;&lt;&lt;JS\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;script&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;colors&nbsp;=&nbsp;[&#39;#ffff00&#39;,&nbsp;&#39;#ff66ff&#39;,&nbsp;&#39;#99cc33&#39;,&nbsp;&#39;#66ff33&#39;,&nbsp;&#39;#000000&#39;,&nbsp;&#39;#FF83FA&#39;,&nbsp;&#39;#CAE1FF&#39;];\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;tmp&nbsp;=&nbsp;0;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var&nbsp;timer&nbsp;=&nbsp;setInterval(colorChanage,&nbsp;1000);\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;function&nbsp;colorChanage()\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(tmp&nbsp;==&nbsp;colors.length)&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tmp&nbsp;=&nbsp;0;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;document.getElementById(&#39;sign_success&#39;).style.color&nbsp;=&nbsp;colors[tmp++];\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/script&gt;\r\nJS;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\r\n&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;protected&nbsp;function&nbsp;init()\r\n&nbsp;&nbsp;&nbsp;&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(!isset($this-&gt;_config[&#39;_key&#39;])&nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;!isset($this-&gt;_config[&#39;_sign&#39;])\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;!isset($this-&gt;_config[&#39;_time&#39;])\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;!isset($this-&gt;_config[&#39;_nonce&#39;])\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;strlen($this-&gt;_config[&#39;_nonce&#39;])&nbsp;!==&nbsp;32\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;!is_numeric($this-&gt;_config[&#39;_time&#39;]))&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;callback([&#39;message&#39;&nbsp;=&gt;&nbsp;&#39;请求参数不全,&nbsp;或参数不规范&#39;],&nbsp;&#39;error&#39;);\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(!isset($this-&gt;_config[&#39;_time&#39;])&nbsp;||&nbsp;$this-&gt;getIsTimeOut())&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;callback([&#39;message&#39;&nbsp;=&gt;&nbsp;&#39;请求超时&#39;],&nbsp;&#39;error&#39;);\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;客户端验证\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$requestSignature&nbsp;=&nbsp;$this-&gt;_config[&#39;_sign&#39;];\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$requestSignature&nbsp;=&nbsp;str_replace(&#39;&nbsp;&#39;,&nbsp;&#39;+&#39;,&nbsp;$requestSignature);\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if($this-&gt;_config[&#39;_key&#39;]&nbsp;!==&nbsp;$this-&gt;AppKey)&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;callback([&#39;message&#39;&nbsp;=&gt;&nbsp;&#39;非法的app_key&#39;],&nbsp;&#39;error&#39;);\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$signature&nbsp;=&nbsp;$this-&gt;generateSign($this-&gt;_config);\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($requestSignature&nbsp;!=&nbsp;$signature)&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;callback([&#39;message&#39;&nbsp;=&gt;&nbsp;&#39;签名错误&#39;],&nbsp;&#39;error&#39;);\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$accessToken&nbsp;=&nbsp;$this-&gt;getAccessToken();\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;用户登录token验证\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($this-&gt;loginCheck&nbsp;&amp;&amp;&nbsp;$accessToken&nbsp;!=&nbsp;$this-&gt;_config[&#39;access_token&#39;])&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this-&gt;callback([&#39;message&#39;&nbsp;=&gt;&nbsp;&#39;access_token错误&#39;],&nbsp;&#39;error&#39;);\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;true;\r\n&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;function&nbsp;callback($json=[],&nbsp;$status=&#39;ok&#39;)\r\n&nbsp;&nbsp;&nbsp;&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$config&nbsp;=&nbsp;[\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;ok&#39;&nbsp;=&gt;&nbsp;[200,&nbsp;&#39;操作成功&#39;],\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;error&#39;&nbsp;=&gt;&nbsp;[300,&nbsp;&#39;操作失败&#39;],\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;timeout&#39;&nbsp;=&gt;&nbsp;[300,&nbsp;&#39;操作超时&#39;],\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;];\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$json[&#39;statusCode&#39;]&nbsp;=&nbsp;$config[$status][0];\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;!isset($json[&#39;message&#39;])&nbsp;&amp;&amp;&nbsp;$json[&#39;message&#39;]&nbsp;=&nbsp;$config[$status][1];\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;json_encode($json);\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;exit;\r\n&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;function&nbsp;getIsTimeOut()\r\n&nbsp;&nbsp;&nbsp;&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(abs($this-&gt;_config[&#39;_time&#39;]&nbsp;-&nbsp;time())&nbsp;&gt;&nbsp;$this-&gt;timeout)&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;true;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;false;\r\n&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;/**\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;生成随便数\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/\r\n&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;&nbsp;function&nbsp;generateRangeNum($length&nbsp;=&nbsp;32,&nbsp;$isToLower&nbsp;=&nbsp;false)\r\n&nbsp;&nbsp;&nbsp;&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$str&nbsp;=&nbsp;$this-&gt;generateRandomString($length);\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($isToLower)&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$str&nbsp;=&nbsp;strtolower($str);\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$str;\r\n&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;function&nbsp;generateRandomString($length&nbsp;=&nbsp;10)&nbsp;{&nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$characters&nbsp;=&nbsp;&#39;0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ&#39;;&nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$randomString&nbsp;=&nbsp;&#39;&#39;;&nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for&nbsp;($i&nbsp;=&nbsp;0;&nbsp;$i&nbsp;&lt;&nbsp;$length;&nbsp;$i++)&nbsp;{&nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$randomString&nbsp;.=&nbsp;$characters[rand(0,&nbsp;strlen($characters)&nbsp;-&nbsp;1)];&nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$randomString;&nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;protected&nbsp;function&nbsp;generateSign($params)\r\n&nbsp;&nbsp;&nbsp;&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(isset($params[&#39;_sign&#39;]))&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;unset($params[&#39;_sign&#39;]);\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if($this-&gt;loginCheck&nbsp;&amp;&amp;&nbsp;isset($params[&#39;access_token&#39;]))&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;unset($params[&#39;access_token&#39;]);\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ksort($params);\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$str&nbsp;=&nbsp;&#39;&#39;;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach&nbsp;($params&nbsp;as&nbsp;$key&nbsp;=&gt;&nbsp;$value)&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$str&nbsp;.=&nbsp;$key&nbsp;.&nbsp;&#39;=&#39;&nbsp;.&nbsp;$value&nbsp;.&nbsp;&#39;&amp;&#39;;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$str&nbsp;=&nbsp;rtrim($str,&nbsp;&#39;&amp;&#39;);\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;hash_hmac($this-&gt;algo,&nbsp;$str,&nbsp;$this-&gt;AppSecret,&nbsp;false);\r\n&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;&nbsp;function&nbsp;getAccessToken()\r\n&nbsp;&nbsp;&nbsp;&nbsp;{\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(!file_exists(self::ACCESS_TOCEN_PATH))&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$json&nbsp;=&nbsp;[&#39;value&#39;&nbsp;=&gt;&nbsp;$this-&gt;_config[&#39;access_token&#39;],&nbsp;&#39;expires_in&#39;&nbsp;=&gt;&nbsp;7200,&nbsp;&#39;time&#39;&nbsp;=&gt;&nbsp;time()];\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;file_put_contents(self::ACCESS_TOCEN_PATH,&nbsp;json_encode($json));\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$this-&gt;_config[&#39;access_token&#39;];\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$accessToken&nbsp;=&nbsp;json_decode(file_get_contents(self::ACCESS_TOCEN_PATH),&nbsp;true);\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(time()&nbsp;-&nbsp;$accessToken[&#39;time&#39;]&nbsp;&gt;&nbsp;$accessToken[&#39;expires_in&#39;]&nbsp;-&nbsp;self::DELAY_TIME)&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$json&nbsp;=&nbsp;[&#39;value&#39;&nbsp;=&gt;&nbsp;$this-&gt;_config[&#39;access_token&#39;],&nbsp;&#39;expires_in&#39;&nbsp;=&gt;&nbsp;7200,&nbsp;&#39;time&#39;&nbsp;=&gt;&nbsp;time()];\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;file_put_contents(self::ACCESS_TOCEN_PATH,&nbsp;json_encode($json));\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$this-&gt;_config[&#39;access_token&#39;];\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;&nbsp;&nbsp;&nbsp;\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$accessToken[&#39;value&#39;];&nbsp;&nbsp;&nbsp;&nbsp;\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;}\r\n}\r\n\r\n/**\r\n&nbsp;*&nbsp;生成随便数\r\n&nbsp;*/\r\nfunction&nbsp;generateRangeNum($length&nbsp;=&nbsp;32,&nbsp;$isToLower&nbsp;=&nbsp;false)\r\n{\r\n&nbsp;&nbsp;&nbsp;&nbsp;$str&nbsp;=&nbsp;generateRandomString($length);\r\n&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;($isToLower)&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$str&nbsp;=&nbsp;strtolower($str);\r\n&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$str;\r\n}\r\n\r\nfunction&nbsp;generateRandomString($length&nbsp;=&nbsp;10)&nbsp;{&nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;$characters&nbsp;=&nbsp;&#39;0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ&#39;;&nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;$randomString&nbsp;=&nbsp;&#39;&#39;;&nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;for&nbsp;($i&nbsp;=&nbsp;0;&nbsp;$i&nbsp;&lt;&nbsp;$length;&nbsp;$i++)&nbsp;{&nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$randomString&nbsp;.=&nbsp;$characters[rand(0,&nbsp;strlen($characters)&nbsp;-&nbsp;1)];&nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;$randomString;&nbsp;\r\n}\r\n\r\nfunction&nbsp;generateSign($algo,&nbsp;$params,&nbsp;$AppSecret)\r\n{\r\n&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(isset($params[&#39;_sign&#39;]))&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;unset($params[&#39;_sign&#39;]);\r\n&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;ksort($params);\r\n&nbsp;&nbsp;&nbsp;&nbsp;$str&nbsp;=&nbsp;&#39;&#39;;\r\n&nbsp;&nbsp;&nbsp;&nbsp;foreach&nbsp;($params&nbsp;as&nbsp;$key&nbsp;=&gt;&nbsp;$value)&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$str&nbsp;.=&nbsp;$key&nbsp;.&nbsp;&#39;=&#39;&nbsp;.&nbsp;$value&nbsp;.&nbsp;&#39;&amp;&#39;;\r\n&nbsp;&nbsp;&nbsp;&nbsp;}\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;$str&nbsp;=&nbsp;rtrim($str,&nbsp;&#39;&amp;&#39;);\r\n\r\n&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;hash_hmac($algo,&nbsp;$str,&nbsp;$AppSecret,&nbsp;false);\r\n}\r\n\r\nheader(&quot;content-type:text/html;charset:utf-8&quot;);\r\n$algo&nbsp;=&nbsp;&#39;sha256&#39;;\r\n$AppKey&nbsp;=&nbsp;&#39;voBVVQxfMxDmhuxV70&#39;;\r\n$AppKey&nbsp;=&nbsp;&#39;Rd1bW719zRbCXOBx3L&#39;;//---用于公司项目测试\r\n$AppSecret&nbsp;=&nbsp;&#39;QJF5P8qWFJakF9Ve89ZcIstHKbkt5fVA&#39;;\r\n$AppSecret&nbsp;=&nbsp;&#39;73ZBAnbwVPDu0dvdlYE0RMvzsbhehejd&#39;;//---用于公司项目测试\r\n$nonce&nbsp;=&nbsp;generateRangeNum(32);\r\n$nonce&nbsp;=&nbsp;&#39;kj4ESP2Qcngaj3eAjpnrhCQR9g4yKnTM&#39;;//---用于公司项目测试\r\n$loginCheck&nbsp;=&nbsp;false;\r\n$params&nbsp;=&nbsp;[\r\n&nbsp;&nbsp;&nbsp;&nbsp;&#39;_key&#39;&nbsp;=&gt;&nbsp;$AppKey,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&#39;_time&#39;&nbsp;=&gt;&nbsp;time(),\r\n&nbsp;&nbsp;&nbsp;&nbsp;&#39;_nonce&#39;&nbsp;=&gt;&nbsp;$nonce,\r\n];\r\n$sign&nbsp;=&nbsp;generateSign($algo,&nbsp;$params,&nbsp;$AppSecret);\r\necho&nbsp;$params[&#39;_time&#39;],&#39;&lt;hr/&gt;&#39;;//---用于公司项目测试\r\necho&nbsp;$sign;exit;//---用于公司项目测试\r\n$params[&#39;_sign&#39;]&nbsp;=&nbsp;$sign;\r\n\r\n$loginCheck&nbsp;&amp;&amp;&nbsp;$params[&#39;access_token&#39;]&nbsp;=&nbsp;generateRangeNum(16);\r\n//&nbsp;echo&nbsp;&#39;&lt;pre&gt;&#39;;print_r($params);\r\n$apiSignModel&nbsp;=&nbsp;new&nbsp;ApiSign($params,&nbsp;$loginCheck);</pre><p><br/></p>'),
(11, 10, '<p>yii2多文件上传</p><p>&nbsp;&nbsp;&nbsp;&nbsp;包括了多次文件上传---html5+ajax+jquery<br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;一次上传多个文件<br/></p>');

-- --------------------------------------------------------

--
-- 表的结构 `byt_attachment`
--

CREATE TABLE `byt_attachment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `table_id` int(11) UNSIGNED DEFAULT '0' COMMENT '关联表id',
  `filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '文件名称',
  `filetype` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '文件类型',
  `extension` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '文件后缀名',
  `filesize` int(11) DEFAULT '0',
  `filesizecn` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '文件大小中文面描述(1KB,1MB...)',
  `filepath` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '文件保存路径',
  `ip` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '上传的IP',
  `web` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '上传的环境',
  `downci` int(11) DEFAULT '0' COMMENT '文件下载次数',
  `created_at` int(10) DEFAULT NULL,
  `updated_at` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='附件表';

--
-- 转存表中的数据 `byt_attachment`
--

INSERT INTO `byt_attachment` (`id`, `user_id`, `table_id`, `filename`, `filetype`, `extension`, `filesize`, `filesizecn`, `filepath`, `ip`, `web`, `downci`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'index_4.jpg', 'image/jpeg', 'jpg', 44651, '43.60 KB', '/uploads/thumb/1525968893-5af46ffd5ad80_index_4.jpg', '127.0.0.1', 'Chrome', 0, 1525968893, 1525968893),
(2, 1, 0, 'a9.jpg', 'image/jpeg', 'jpg', 15909, '15.54 KB', 'uploads/20180511/63a49a4407cdab3872b1d8a2f43a76ab.jpg', '127.0.0.1', 'Chrome', 0, 1525968966, 1525968966),
(3, 1, 0, 'a1.jpg', 'image/jpeg', 'jpg', 40994, '40.03 KB', 'uploads/20180511/928da55f85222e7f4d29c8358fb7ba87.jpg', '127.0.0.1', 'Chrome', 0, 1525970440, 1525970440),
(4, 1, 0, 'a5.jpg', 'image/jpeg', 'jpg', 16274, '15.89 KB', 'uploads/20180511/6fbf16156b5e4ada34cb39030652e402.jpg', '127.0.0.1', 'Chrome', 0, 1525970522, 1525970522),
(5, 1, 0, 'a8.jpg', 'image/jpeg', 'jpg', 10758, '10.51 KB', 'uploads/20180511/feb3e895c803b7ce559540d115ba14d4.jpg', '127.0.0.1', 'Chrome', 0, 1525971002, 1525971002),
(6, 1, 0, 'a6.jpg', 'image/jpeg', 'jpg', 18357, '17.93 KB', 'uploads/20180511/2b263d900e9053bf2b3a480ca296effc.jpg', '127.0.0.1', 'Chrome', 0, 1525971020, 1525971020),
(7, 1, 0, 'a4.jpg', 'image/jpeg', 'jpg', 8039, '7.85 KB', 'uploads/20180511/5496a92bed8e0d1978fcbfaa91fceff0.jpg', '127.0.0.1', 'Chrome', 0, 1525971302, 1525971302),
(8, 1, 0, 'profile.jpg', 'image/jpeg', 'jpg', 38520, '37.62 KB', 'uploads/20180511/936278cf9850eb56a0fa8138de9059f3.jpg', '127.0.0.1', 'Chrome', 0, 1525971377, 1525971377),
(9, 1, 0, 'profile.jpg', 'image/jpeg', 'jpg', 38520, '37.62 KB', 'uploads/20180511/69ce949bd3856796f6587f306834f33e.jpg', '127.0.0.1', 'Chrome', 0, 1525971631, 1525971631),
(10, 1, 0, 'a9.jpg', 'image/jpeg', 'jpg', 15909, '15.54 KB', 'uploads/20180514/704e86ae602badddb4da17075fa2cd4c.jpg', '127.0.0.1', 'Chrome', 0, 1526307638, 1526307638),
(11, 1, 0, 'a9.jpg', 'image/jpeg', 'jpg', 15909, '15.54 KB', 'uploads/20180514/4ea7a9c0793274626d2e4d6d55adde20.jpg', '127.0.0.1', 'Chrome', 0, 1526307671, 1526307671),
(12, 1, 0, 'profile.jpg', 'image/jpeg', 'jpg', 38520, '37.62 KB', 'uploads/20180514/f6abfcdf5d69a6e72470d7dbb16b0229.jpg', '127.0.0.1', 'Chrome', 0, 1526307694, 1526307694),
(13, 1, 0, 'a1.jpg', 'image/jpeg', 'jpg', 40994, '40.03 KB', 'uploads/20180514/9b18d7af221b2a941c3593e7802b1ffc.jpg', '127.0.0.1', 'Chrome', 0, 1526308351, 1526308351),
(14, 1, 0, 'a1.jpg', 'image/jpeg', 'jpg', 40994, '40.03 KB', 'uploads/20180514/8b3bace3714be91d6fdfd4865672e207.jpg', '127.0.0.1', 'Chrome', 0, 1526308546, 1526308546),
(15, 1, 0, 'a2.jpg', 'image/jpeg', 'jpg', 13416, '13.10 KB', 'uploads/20180514/c4db147dbce13316c98342689a11b874.jpg', '127.0.0.1', 'Chrome', 0, 1526308700, 1526308700),
(16, 1, 0, 'a2.jpg', 'image/jpeg', 'jpg', 13416, '13.10 KB', 'uploads/20180514/d79ef9203832eac0798959fac9498859.jpg', '127.0.0.1', 'Chrome', 0, 1526308732, 1526308732),
(17, 1, 0, 'a1.jpg', 'image/jpeg', 'jpg', 40994, '40.03 KB', 'uploads/20180514/9cb3b80c154cc7a8bae11f2b92d95a74.jpg', '127.0.0.1', 'Chrome', 0, 1526308876, 1526308876),
(18, 1, 0, 'a2.jpg', 'image/jpeg', 'jpg', 13416, '13.10 KB', 'uploads/20180514/517fb1e8f38d136fa09247d96c06ffb7.jpg', '127.0.0.1', 'Chrome', 0, 1526308891, 1526308891),
(19, 1, 0, 'a3.jpg', 'image/jpeg', 'jpg', 50346, '49.17 KB', 'uploads/20180514/103b72f3b4b3d3fa901593e30b4c6dc2.jpg', '127.0.0.1', 'Chrome', 0, 1526308945, 1526308945),
(20, 1, 0, 'a6.jpg', 'image/jpeg', 'jpg', 18357, '17.93 KB', 'uploads/20180514/274de2560845cad55f566ec37c4e1793.jpg', '127.0.0.1', 'Chrome', 0, 1526308952, 1526308952),
(21, 1, 0, 'a8.jpg', 'image/jpeg', 'jpg', 10758, '10.51 KB', 'uploads/20180514/631bb972f09183e32a3d9bc653823686.jpg', '127.0.0.1', 'Chrome', 0, 1526308977, 1526308977),
(22, 1, 0, 'a8.jpg', 'image/jpeg', 'jpg', 10758, '10.51 KB', 'uploads/20180514/148289530d408d1be1595d464b15b770.jpg', '127.0.0.1', 'Chrome', 0, 1526308990, 1526308990),
(23, 1, 0, 'a5.jpg', 'image/jpeg', 'jpg', 16274, '15.89 KB', 'uploads/thumb/1526309317-5af9a1c5b39f6_a5.jpg', '127.0.0.1', 'Chrome', 0, 1526309317, 1526309317),
(24, 1, 0, '1.jpg', 'image/jpeg', 'jpg', 40039, '39.10 KB', 'uploads/thumb/20180514/1526309482-5af9a26ad9a5c_1.jpg', '127.0.0.1', 'Chrome', 0, 1526309482, 1526309482),
(25, 1, 0, '2.jpeg', 'image/jpeg', 'jpeg', 151295, '147.75 KB', 'uploads/thumb/20180514/1526309482-5af9a26ae1b46_2.jpeg', '127.0.0.1', 'Chrome', 0, 1526309482, 1526309482),
(26, 1, 0, '2.jpg', 'image/jpeg', 'jpg', 135883, '132.70 KB', 'uploads/thumb/20180514/1526309482-5af9a26ae2ae6_2.jpg', '127.0.0.1', 'Chrome', 0, 1526309482, 1526309482),
(27, 1, 0, '9.jpg', 'image/jpeg', 'jpg', 45319, '44.26 KB', 'uploads/thumb/20180514/1526311696-5af9ab10c518f_9.jpg', '127.0.0.1', 'Chrome', 0, 1526311696, 1526311696),
(28, 1, 0, '12.jpg', 'image/jpeg', 'jpg', 92064, '89.91 KB', 'uploads/thumb/20180514/1526312599-5af9ae97dc735_12.jpg', '127.0.0.1', 'Chrome', 0, 1526312599, 1526312599),
(29, 1, 0, '6.jpg', 'image/jpeg', 'jpg', 131072, '128.00 KB', 'uploads/20180516/5053b5d9341cb70a39d3f01b074dff34.jpg', '127.0.0.1', 'Chrome', 0, 1526483708, 1526483708),
(30, 1, 0, 'logo.png', 'image/png', 'png', 8503, '8.30 KB', 'uploads/20180606/09033a20eb0f694dd54927e16c0a54d2.png', '127.0.0.1', 'Chrome', 0, 1528289307, 1528289307),
(31, 1, 0, '1527927262pzsn3t.png', 'image/png', 'png', 9295, '9.08 KB', 'uploads/20180606/76c8ab93eb0fcf650f5a84ce7ef7d82a.png', '127.0.0.1', 'Chrome', 0, 1528290020, 1528290020),
(32, 1, 0, 'face.jpg', 'image/jpeg', 'jpg', 42225, '41.24 KB', 'uploads/20180613/ae25d30cd2db2e5cac912338e2df4f51.jpg', '127.0.0.1', 'Chrome', 0, 1528902129, 1528902129),
(33, 1, 0, 'diaochan.jpg', 'image/jpeg', 'jpg', 4752, '4.64 KB', 'uploads/20180619/61330e1aa1e6b4f576cdd927fa444be4.jpg', '127.0.0.1', 'Chrome', 0, 1529421645, 1529421645),
(34, 1, 0, '007.jpg', 'image/jpeg', 'jpg', 250522, '244.65 KB', 'uploads/20180702/2f59542c2b69be5ff650b0b40697ae2a.jpg', '127.0.0.1', 'Chrome', 0, 1530545894, 1530545894);

-- --------------------------------------------------------

--
-- 表的结构 `byt_carousel`
--

CREATE TABLE `byt_carousel` (
  `id` int(11) NOT NULL,
  `key` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `byt_carousel_item`
--

CREATE TABLE `byt_carousel_item` (
  `id` int(11) NOT NULL,
  `carousel_id` int(11) NOT NULL,
  `url` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caption` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `byt_category`
--

CREATE TABLE `byt_category` (
  `id` int(11) UNSIGNED NOT NULL,
  `parent_id` int(11) UNSIGNED DEFAULT '0',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `sort` int(11) UNSIGNED DEFAULT '0' COMMENT '排序',
  `remark` varchar(255) DEFAULT '' COMMENT '备注',
  `created_at` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `updated_at` int(11) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `byt_category`
--

INSERT INTO `byt_category` (`id`, `parent_id`, `name`, `sort`, `remark`, `created_at`, `updated_at`) VALUES
(1, 0, 'php', 0, '', 1523462093, 1523462093),
(2, 0, 'javascript', 1, '', 1523462112, 1523462121),
(3, 0, '星晴', 2, '', 1523462149, 1523462149),
(4, 2, 'VUEJS', 1, '', 1523761624, 1523761624),
(5, 0, 'Windows相关', 3, '主要与windows相关的知识（blos，bat编程....）', 1523777408, 1523777408),
(6, 0, '明星', 4, '', 1525709831, 1525709831),
(7, 0, '美女', 5, '', 1525709853, 1525709853);

-- --------------------------------------------------------

--
-- 表的结构 `byt_config`
--

CREATE TABLE `byt_config` (
  `scope` char(20) NOT NULL DEFAULT '' COMMENT '范围',
  `variable` varchar(50) NOT NULL COMMENT '变量',
  `value` text COMMENT '值',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统配置';

--
-- 转存表中的数据 `byt_config`
--

INSERT INTO `byt_config` (`scope`, `variable`, `value`, `description`) VALUES
('base', 'company_name', '自定义', ''),
('base', 'company_url', 'blog.yjcweb.tk', ''),
('base', 'email', '2064320087@qq.com', ''),
('base', 'icp', NULL, ''),
('base', 'open_comment', '1', ''),
('base', 'open_comment_verify', '1', ''),
('base', 'seo_description', '免费开源的基于yii2的cms系统，适合初级php程序员', ''),
('base', 'seo_keyword', 'yii2,cms,开源', ''),
('base', 'smtp_password', 'mrioqbknnbtcechg', ''),
('base', 'smtp_port', '587', ''),
('base', 'smtp_sender', '2064320087@qq.com', ''),
('base', 'smtp_server', 'smtp.qq.com', ''),
('base', 'smtp_user', '2064320087@qq.com', ''),
('base', 'system_logo', 'uploads/20180606/76c8ab93eb0fcf650f5a84ce7ef7d82a.png', ''),
('base', 'system_name', 'JCYCMS', ''),
('base', 'system_notes', '这是一个基于yii2框架开发的一套cms系统。本系统目前支持两套模板切换，一套个人博客，一套内容丰富的cms网站。最重要的是系统完全开源！\r\n系统对于初学者和刚入行的或者刚进入yii2的朋友起到一定作用', ''),
('base', 'tel', '028-xxxxxx', ''),
('base', 'web_templates', 'template1', '');

-- --------------------------------------------------------

--
-- 表的结构 `byt_friend_link`
--

CREATE TABLE `byt_friend_link` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT '0' COMMENT '操作人',
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `url` varchar(255) NOT NULL COMMENT '链接地址',
  `target` varchar(255) DEFAULT '_blank' COMMENT '打开方式',
  `sort` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='友情链接表';

--
-- 转存表中的数据 `byt_friend_link`
--

INSERT INTO `byt_friend_link` (`id`, `user_id`, `name`, `image`, `url`, `target`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '飞嗨网', '/uploads/friendlylink/5ad3208120196_logo.png', 'http://www.feehi.com', '_blank', 1, 1, 1523785400, 1523786142),
(2, 1, 'YangJieCheng\'Blog', '/uploads/friendlylink/5ad33b648db2e_QQ截图20180415194523.png', 'http://www.cnblogs.com/YangJieCheng/', '_blank', 0, 1, 1523792740, 1523794480),
(3, 1, 'YangJieCheng\'GitHub', '/uploads/friendlylink/5ad343f717e7d_6159252dd42a2834b1c7cf5b59b5c9ea15cebf79.jpg', 'https://github.com/jiechengyang', '_blank', 0, 1, 1523794935, 1523802101);

-- --------------------------------------------------------

--
-- 表的结构 `byt_menu`
--

CREATE TABLE `byt_menu` (
  `id` int(11) NOT NULL,
  `type` tinyint(2) UNSIGNED DEFAULT '0' COMMENT '类型',
  `parent_id` int(11) UNSIGNED DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 NOT NULL COMMENT '名称',
  `url` varchar(255) CHARACTER SET utf8mb4 NOT NULL COMMENT '地址',
  `icon` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '图标',
  `sort` int(11) UNSIGNED DEFAULT '0' COMMENT '排序',
  `target` varchar(45) CHARACTER SET utf8mb4 DEFAULT '_blank' COMMENT '链接打开方式',
  `is_absolute_url` smallint(6) UNSIGNED DEFAULT '0' COMMENT '绝对地址',
  `is_display` smallint(6) UNSIGNED DEFAULT '1' COMMENT '是否显示',
  `method` smallint(6) UNSIGNED DEFAULT '1' COMMENT '请求方式',
  `created_at` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `updated_at` int(11) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `byt_menu`
--

INSERT INTO `byt_menu` (`id`, `type`, `parent_id`, `name`, `url`, `icon`, `sort`, `target`, `is_absolute_url`, `is_display`, `method`, `created_at`, `updated_at`) VALUES
(1, 0, NULL, '设置', 'setting', 'fa-asterisk', 1, '_blank', 0, 1, 0, 1470064425, 1529589979),
(2, 0, 1, '网站设置', 'config/index', '', 0, '_blank', 0, 1, 1, 1470064528, 1523978816),
(3, 0, 1, 'SMTP设置', 'config/smtp', '', 0, '_blank', 0, 1, 1, 1470064574, 1523978835),
(5, 0, NULL, '菜单', 'menu', 'fa-list-ol', 3, '_blank', 0, 1, 0, 1470064761, 1529596357),
(6, 0, 5, '前台菜单', 'frontend-menu/index', '', 1, '_blank', 0, 1, 1, 1470064785, 1488803243),
(7, 0, 5, '后台菜单', 'menu/index', '', 10, '_blank', 0, 1, 1, 1470064803, 1488804983),
(8, 0, NULL, '内容', 'article', 'fa-edit', 4, '_blank', 0, 1, 0, 1470064850, 1529596412),
(9, 0, 8, '文章', 'article/index', '', 1, '_blank', 0, 1, 1, 1470065005, 1525142500),
(10, 0, 8, '评论', 'comment/index', '', 10, '_blank', 0, 1, 1, 1470065043, 1488803859),
(11, 0, 8, '单页', 'page/index', '', 200, '_blank', 0, 1, 1, 1470065084, 1507773527),
(12, 0, 8, '分类', 'category/index', '', 100, '_blank', 0, 1, 1, 1470065111, 1505356769),
(13, 0, NULL, '用户', 'user/index', 'fa-users', 2, '_blank', 0, 1, 0, 1470065584, 1529596316),
(15, 0, 25, '管理员', 'admin-user/index', '', 1, '_blank', 0, 1, 1, 1470065672, 1488804338),
(16, 0, 25, '角色', 'admin-roles/index', '', 10, '_blank', 0, 1, 1, 1470065689, 1488804907),
(17, 0, 121, '友情链接', 'friend-link/index', 'fa-link', 5, '_blank', 0, 1, 0, 1470065784, 1529595813),
(18, 0, NULL, '日志', 'admin-log/index', 'fa fa-history', 6, '_blank', 0, 1, 1, 1470065819, 1529596118),
(19, 1, 0, '首页', '/', '', 0, '_self', 0, 1, 0, 1470111187, 1478347757),
(24, 0, 13, '前台用户', 'user/index', '', 1, '_self', 0, 1, 1, 1476711715, 1488804296),
(25, 0, 13, '后台用户', '', '', 2, '_self', 0, 1, 0, 1476711746, 1488805123),
(26, 0, 0, '缓存', 'clear', 'fa fa-file', 8, '_self', 0, 1, 0, 1476711824, 1488805098),
(27, 0, 26, '清除前台', 'clear/frontend', '', 0, '_self', 0, 1, 1, 1476711849, 1488804425),
(28, 0, 26, '清除后台', 'clear/backend', '', 0, '_self', 0, 1, 1, 1476711875, 1488804416),
(29, 0, 1, '网站设置:修改', 'setting/website', '', 2, '_blank', 0, 0, 2, 1477317515, 1488802701),
(30, 0, 1, 'smtp设置:修改', 'setting/smtp', '', 4, '_blank', 0, 0, 2, 1477317553, 1488802744),
(31, 0, 1, '自定义设置:修改', 'setting/custom', '', 6, '_blank', 0, 0, 2, 1478347894, 1488802797),
(32, 0, 1, '自定义设置:添加配置项:确定', 'setting/custom-create', '', 7, '_blank', 0, 0, 2, 1478349191, 1488802821),
(33, 0, 1, '自定义设置:修改配置项', 'setting/custom-update', '', 8, '_blank', 0, 0, 1, 1478354871, 1488802841),
(34, 0, 1, '自定义设置:修改配置项:修改', 'setting/custom-update', '', 9, '_blank', 0, 0, 2, 1478354930, 1488802854),
(35, 0, 1, '自定义设置:删除', 'setting/delete', '', 10, '_blank', 0, 0, 1, 1478355030, 1488805270),
(36, 0, 5, '前台菜单:创建', 'frontend-menu/create', '', 2, '_blank', 0, 0, 1, 1478359098, 1488803289),
(37, 0, 5, '前台菜单:创建:确定', 'frontend-menu/create', '', 3, '_blank', 0, 0, 2, 1478359146, 1488803306),
(38, 0, 5, '前台菜单:修改', 'frontend-menu/update', '', 4, '_blank', 0, 0, 1, 1478359187, 1488803338),
(39, 0, 5, '前台菜单:修改:确定', 'frontend-menu/update', '', 5, '_blank', 0, 0, 2, 1478359227, 1488803353),
(40, 0, 5, '前台菜单:删除', 'frontend-menu/delete', '', 6, '_blank', 0, 0, 1, 1478359312, 1488805308),
(41, 0, 5, '后台菜单:创建', 'menu/create', '', 11, '_blank', 0, 0, 1, 1478359369, 1488803391),
(42, 0, 5, '后台菜单:创建:确定', 'menu/create', '', 12, '_blank', 0, 0, 2, 1478359409, 1488803409),
(43, 0, 5, '后台菜单:修改', 'menu/update', '', 13, '_blank', 0, 0, 1, 1478359427, 1488803427),
(44, 0, 5, '后台菜单:修改:确定', 'menu/update', '', 14, '_blank', 0, 0, 2, 1478359509, 1488803459),
(45, 0, 5, '后台菜单:删除', 'menu/delete', '', 15, '_blank', 0, 0, 1, 1478359537, 1488805333),
(46, 0, 8, '文章:创建', 'article/create', '', 3, '_blank', 0, 0, 1, 1478359682, 1488803732),
(47, 0, 8, '文章:创建:确定', 'article/create', '', 4, '_blank', 0, 0, 2, 1478359712, 1488803752),
(48, 0, 8, '文章:修改', 'article/update', '', 5, '_blank', 0, 0, 1, 1478359746, 1488803769),
(49, 0, 8, '文章:修改:确定', 'article/update', '', 6, '_blank', 0, 0, 2, 1478359801, 1488803786),
(50, 0, 8, '文章:删除', 'article/delete', '', 7, '_blank', 0, 0, 1, 1478359819, 1488803812),
(51, 0, 8, '文章:排序', 'article/sort', '', 8, '_blank', 0, 0, 2, 1478359858, 1488803834),
(52, 0, 8, '评论:审核', 'comment/status', '', 11, '_blank', 0, 0, 1, 1478360032, 1502973019),
(53, 0, 8, '评论:删除', 'comment/delete', '', 12, '_blank', 0, 0, 1, 1478360060, 1488803936),
(54, 0, 8, '单页:创建', 'page/create', '', 22, '_blank', 0, 0, 1, 1478360090, 1488804039),
(55, 0, 8, '单页:创建:确定', 'page/create', '', 23, '_blank', 0, 0, 2, 1478360124, 1488804053),
(56, 0, 8, '单页:修改', 'page/update', '', 24, '_blank', 0, 0, 1, 1478360149, 1488804067),
(57, 0, 8, '单页:修改:确定', 'page/update', '', 25, '_blank', 0, 0, 2, 1478360185, 1488804084),
(58, 0, 8, '单页:删除', 'page/delete', '', 26, '_blank', 0, 0, 1, 1478360202, 1488804097),
(59, 0, 8, '单页:排序', 'page/sort', '', 27, '_blank', 0, 0, 2, 1478360250, 1488804137),
(60, 0, 8, '分类:创建', 'category/create', '', 31, '_blank', 0, 0, 1, 1478360302, 1488804177),
(61, 0, 8, '分类:创建:确定', 'category/create', '', 32, '_blank', 0, 0, 2, 1478360332, 1488804195),
(62, 0, 8, '分类:修改', 'category/update', '', 33, '_blank', 0, 0, 1, 1478360357, 1488804212),
(63, 0, 8, '分类:修改:确定', 'category/update', '', 34, '_blank', 0, 0, 2, 1478360381, 1488804234),
(64, 0, 8, '分类:删除', 'category/delete', '', 35, '_blank', 0, 0, 1, 1478360399, 1488804247),
(65, 0, 13, '前台用户:创建', 'user/create', '', 2, '_blank', 0, 0, 1, 1478360452, 1488804799),
(66, 0, 13, '前台用户:创建:确定', 'user/create', '', 3, '_blank', 0, 0, 2, 1478360487, 1488804789),
(67, 0, 13, '前台用户:修改', 'user/update', '', 4, '_blank', 0, 0, 1, 1478360516, 1488804778),
(68, 0, 13, '前台用户:修改:确定', 'user/update', '', 5, '_blank', 0, 0, 2, 1478360546, 1488804766),
(69, 0, 13, '前台用户:删除', 'user/delete', '', 6, '_blank', 0, 0, 1, 1478360586, 1488804756),
(70, 0, 25, '管理员:创建', 'admin-user/create', '', 2, '_blank', 0, 0, 1, 1478361007, 1488804350),
(71, 0, 25, '管理员:创建:确定', 'admin-user/create', '', 3, '_blank', 0, 0, 2, 1478361050, 1488804360),
(72, 0, 25, '管理员:修改', 'admin-user/update', '', 4, '_blank', 0, 0, 1, 1478361084, 1488804955),
(73, 0, 25, '管理员:修改:确定', 'admin-user/update', '', 5, '_blank', 0, 0, 2, 1478361123, 1488804944),
(74, 0, 25, '管理员:删除', 'admin-user/delete', '', 6, '_blank', 0, 0, 1, 1478361166, 1488804935),
(75, 0, 25, '角色:创建', 'admin-roles/create', '', 11, '_blank', 0, 0, 1, 1478361243, 1488804895),
(76, 0, 25, '角色:创建:确定', 'admin-roles/create', '', 12, '_blank', 0, 0, 2, 1478361278, 1488804886),
(77, 0, 25, '角色:修改', 'admin-roles/update', '', 13, '_blank', 0, 0, 1, 1478361366, 1488804856),
(78, 0, 25, '角色:修改:确定', 'admin-roles/update', '', 14, '_blank', 0, 0, 2, 1478361398, 1488804841),
(79, 0, 25, '角色:删除', 'admin-roles/delete', '', 15, '_blank', 0, 0, 1, 1478361435, 1488804831),
(80, 0, 25, '角色:分配权限', 'admin-roles/assign', '', 16, '_blank', 0, 0, 1, 1478361489, 1488804820),
(81, 0, 25, '角色:分配权限:确定', 'admin-roles/assign', '', 17, '_blank', 0, 0, 2, 1478361523, 1488804811),
(82, 0, 25, '管理员:分配角色', 'admin-user/assign', '', 7, '_blank', 0, 0, 1, 1478361568, 1488804925),
(83, 0, 25, '管理员:分配角色:确定', 'admin-user/assign', '', 8, '_blank', 0, 0, 2, 1478361601, 1488804916),
(84, 0, 121, '友情链接:创建', 'friend-link/create', '', 5, '_blank', 0, 0, 1, 1478393905, 1529595838),
(85, 0, 121, '友情链接:创建:确定', 'friend-link/create', '', 5, '_blank', 0, 0, 2, 1478393952, 1529595878),
(86, 0, 121, '友情链接:修改', 'friend-link/update', '', 5, '_blank', 0, 0, 1, 1478393989, 1529595899),
(87, 0, 121, '友情链接:修改:确定', 'friend-link/update', '', 5, '_blank', 0, 0, 2, 1478394021, 1529595935),
(88, 0, 121, '友情链接:删除', 'friend-link/delete', '', 5, '_blank', 0, 0, 1, 1478394046, 1529595963),
(89, 0, 0, '友情链接:排序', 'friend-link/sort', '', 6, '_blank', 0, 0, 2, 1478394070, 1488804649),
(90, 0, 0, '附件管理:查看', 'file/view-layer', '', 7, '_blank', 0, 0, 1, 1478394351, 1488804456),
(91, 0, 0, '附件管理:删除', 'file/delete', '', 7, '_blank', 0, 0, 1, 1478394368, 1488804446),
(92, 0, 0, '日志:查看', 'log/view-layer', '', 9, '_blank', 0, 0, 1, 1478394503, 1488804393),
(93, 0, 0, '日志:删除', 'log/delete', '', 9, '_blank', 0, 0, 1, 1478394525, 1488804384),
(95, 0, 1, 'smtp设置:测试', 'setting/test-smtp', '', 4, '_blank', 0, 0, 2, 1478399012, 1488802767),
(98, 0, 8, '文章:查看', 'article/view-layer', '', 2, '_blank', 0, 0, 1, 1478402492, 1488803523),
(99, 0, 8, '单页:查看', 'page/view-layer', '', 21, '_blank', 0, 0, 1, 1478402805, 1488804006),
(100, 0, 8, '分类:排序', 'category/sort', '', 36, '_blank', 0, 0, 2, 1478404112, 1488804264),
(101, 0, 5, '前台菜单:更改状态', 'frontend-menu/status', '', 7, '_blank', 0, 0, 1, 1502972780, 1502973470),
(102, 0, 5, '后台菜单:更改状态', 'menu/status', '', 16, '_blank', 0, 0, 1, 1502972808, 1502973499),
(103, 0, 8, '文章:更改状态', 'article/status', '', 9, '_blank', 0, 0, 1, 1502972981, 1502973527),
(104, 0, 8, '单页:更改状态', 'page/status', '', 28, '_blank', 0, 0, 1, 1502973066, 1502973584),
(105, 0, 121, '友情链接:更改状态', 'friend-link/status', '', 6, '_blank', 0, 0, 1, 1502973196, 1529595996),
(114, 0, 8, '文章采集', 'collection/index', '', 80, '_blank', 0, 1, 1, 1507773491, 1507773491),
(115, 0, 8, '相册', 'photos/index', 'fa-photo', 201, '_blank', 0, 1, 1, 1470065043, 1525706374),
(116, 0, 8, '相册:创建', 'photos/create', '', 201, '_blank', 0, 0, 1, 1525705610, 1525707317),
(117, 0, 8, '相册:修改', 'photos/update', '', 201, '_blank', 0, 0, 1, 1525705957, 1525707388),
(118, 0, 8, '相册:删除', 'photos/delete', '', 201, '', 0, 0, 1, 1525706024, 1525707303),
(119, 0, 8, '相册:创建:确定', 'photos/create', '', 201, '', 0, 0, 2, 1525707251, 1525707592),
(120, 0, 8, '相册:修改:确定', 'photos/update', '', 201, '', 0, 0, 2, 1525707461, 1525707461),
(121, 0, NULL, '组件', '/cms-component/cms-component', 'fa-cubes', 5, '', 0, 1, 1, 1529589097, 1529589130),
(122, 0, 121, '广告管理', '/options/index', '', 6, '', 0, 1, 1, 1529598437, 1529943453),
(123, 0, 121, 'Banner管理', '/banner/index', '', 7, '', 0, 1, 1, 1529598540, 1529598540),
(124, 0, 121, '附件管理', '/attachment/index', '', 8, '', 0, 1, 1, 1529598633, 1529598681);

-- --------------------------------------------------------

--
-- 表的结构 `byt_migration`
--

CREATE TABLE `byt_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `byt_migration`
--

INSERT INTO `byt_migration` (`version`, `apply_time`) VALUES
('m130524_201442_init', 1513135598);

-- --------------------------------------------------------

--
-- 表的结构 `byt_options`
--

CREATE TABLE `byt_options` (
  `id` int(11) NOT NULL,
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '类型.0系统,1自定义,2banner,3广告',
  `name` varchar(255) NOT NULL COMMENT '标识符',
  `value` text NOT NULL COMMENT '值',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `byt_user`
--

CREATE TABLE `byt_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `login_count` int(10) NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `last_login_ip` char(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `last_login_at` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `byt_user`
--

INSERT INTO `byt_user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `avatar`, `status`, `login_count`, `last_login_ip`, `last_login_at`, `created_at`, `updated_at`) VALUES
(1, 'testuser', 'pzKXds0zos1zUed3vyrfHmnASSuzyxc6', '$2y$13$yozuZcs.sf1EN3Iv.jaSBuz.yzOgVa94WMzJbTY2tNpLr2Bj54lhC', NULL, '2064320087@qq.com', '', 10, 3, '127.0.0.1', 1529318416, 1529122287, 1529421554),
(2, 'user2', 'EiiMA-Pyu_IzWdhHALFedtLsQZAYGUQf', '$2y$13$P6zu56.fHJXsD4VY97rT4uy9R.x/hyW4mDFTRMbT72e4VStWfEcGG', NULL, '2397482854@qq.com', '', 10, 2, '127.0.0.1', 1529421494, 1529125477, 1529421477),
(4, 'backend_to_frontend_user', 'FUslpzG3n3jDAQmc7qS7Ch_N4JLmbaSe', '$2y$13$/UoxxiWyk02yJTjliUfpEe624tiLB92aUeix5P0z9owNLpu18uGOe', NULL, '305443997@qq.com', 'uploads/20180619/61330e1aa1e6b4f576cdd927fa444be4.jpg', 10, 1, '127.0.0.1', 1529423623, 1529421698, 1529423634);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `byt_admin_log`
--
ALTER TABLE `byt_admin_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `byt_admin_roles`
--
ALTER TABLE `byt_admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `byt_admin_role_permission`
--
ALTER TABLE `byt_admin_role_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menu_id` (`menu_id`),
  ADD KEY `fk_role_id` (`role_id`);

--
-- Indexes for table `byt_admin_role_user`
--
ALTER TABLE `byt_admin_role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `byt_admin_user`
--
ALTER TABLE `byt_admin_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `byt_article`
--
ALTER TABLE `byt_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_title` (`title`(191),`category_id`,`tag`(191));

--
-- Indexes for table `byt_article_content`
--
ALTER TABLE `byt_article_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_aid_idx` (`article_id`);

--
-- Indexes for table `byt_attachment`
--
ALTER TABLE `byt_attachment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `byt_carousel`
--
ALTER TABLE `byt_carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `byt_carousel_item`
--
ALTER TABLE `byt_carousel_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `byt_category`
--
ALTER TABLE `byt_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `byt_config`
--
ALTER TABLE `byt_config`
  ADD PRIMARY KEY (`variable`),
  ADD UNIQUE KEY `variable_UNIQUE` (`variable`);

--
-- Indexes for table `byt_friend_link`
--
ALTER TABLE `byt_friend_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `byt_menu`
--
ALTER TABLE `byt_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `byt_migration`
--
ALTER TABLE `byt_migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `byt_options`
--
ALTER TABLE `byt_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `byt_user`
--
ALTER TABLE `byt_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `byt_admin_log`
--
ALTER TABLE `byt_admin_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- 使用表AUTO_INCREMENT `byt_admin_roles`
--
ALTER TABLE `byt_admin_roles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `byt_admin_role_permission`
--
ALTER TABLE `byt_admin_role_permission`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=392;

--
-- 使用表AUTO_INCREMENT `byt_admin_role_user`
--
ALTER TABLE `byt_admin_role_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `byt_admin_user`
--
ALTER TABLE `byt_admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `byt_article`
--
ALTER TABLE `byt_article`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用表AUTO_INCREMENT `byt_article_content`
--
ALTER TABLE `byt_article_content`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用表AUTO_INCREMENT `byt_attachment`
--
ALTER TABLE `byt_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- 使用表AUTO_INCREMENT `byt_carousel`
--
ALTER TABLE `byt_carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `byt_carousel_item`
--
ALTER TABLE `byt_carousel_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `byt_category`
--
ALTER TABLE `byt_category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `byt_friend_link`
--
ALTER TABLE `byt_friend_link`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `byt_menu`
--
ALTER TABLE `byt_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- 使用表AUTO_INCREMENT `byt_options`
--
ALTER TABLE `byt_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `byt_user`
--
ALTER TABLE `byt_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 限制导出的表
--

--
-- 限制表 `byt_admin_log`
--
ALTER TABLE `byt_admin_log`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `byt_admin_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
