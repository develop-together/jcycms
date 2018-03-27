#2018-02-27

CREATE TABLE `byt_admin_log` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL DEFAULT 0 COMMENT '操作人',
  `route` VARCHAR(255) NULL DEFAULT NULL COMMENT '路由',
  `description` TEXT NULL COMMENT '描述',
  `created_at` INT(11) NOT NULL DEFAULT 0 COMMENT '添加时间',
  `updated_at` INT(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COMMENT = '操作日志';

#2018-03-09

CREATE TABLE `byt_menu` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `type` TINYINT(2) UNSIGNED NULL DEFAULT 0,
  `parent_id` INT(11) UNSIGNED NULL DEFAULT 0,
  `name` VARCHAR(255) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `icon` VARCHAR(255) NULL DEFAULT NULL,
  `byt_menucol` VARCHAR(45) NULL,
  `sort` INT(11) UNSIGNED NULL DEFAULT 0,
  `target` VARCHAR(45) NULL DEFAULT '_blank',
  `is_absolute_url` SMALLINT(6) UNSIGNED NULL DEFAULT 0,
  `is_display` SMALLINT(6) UNSIGNED NULL DEFAULT '1',
  `method` SMALLINT(6) UNSIGNED NULL DEFAULT 1,
  `created_at` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT(11) UNSIGNED NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

ALTER TABLE `byt_menu` 
CHANGE COLUMN `type` `type` TINYINT(2) UNSIGNED NULL DEFAULT '0' COMMENT '类型' ,
CHANGE COLUMN `name` `name` VARCHAR(255) NOT NULL COMMENT '名称' ,
CHANGE COLUMN `url` `url` VARCHAR(255) NOT NULL COMMENT '地址' ,
CHANGE COLUMN `icon` `icon` VARCHAR(255) NULL DEFAULT NULL COMMENT '图标' ,
CHANGE COLUMN `sort` `sort` INT(11) UNSIGNED NULL DEFAULT '0' COMMENT '排序' ,
CHANGE COLUMN `target` `target` VARCHAR(45) NULL DEFAULT '_blank' COMMENT '链接打开方式' ,
CHANGE COLUMN `is_absolute_url` `is_absolute_url` SMALLINT(6) UNSIGNED NULL DEFAULT '0' COMMENT '绝对地址' ,
CHANGE COLUMN `is_display` `is_display` SMALLINT(6) UNSIGNED NULL DEFAULT '1' COMMENT '是否显示' ,
CHANGE COLUMN `method` `method` SMALLINT(6) UNSIGNED NULL DEFAULT '1' COMMENT '请求方式' ;

ALTER TABLE `byt_menu` 
DROP COLUMN `byt_menucol`;

#2018-03-28
CREATE TABLE IF NOT EXISTS `admin_role_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) unsigned NOT NULL,
  `menu_id` int(11) unsigned NOT NULL,
  `created_at` int(11) unsigned NOT NULL,
  `updated_at` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_menu_id` (`menu_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `byt_menu`
DEFAULT CHARACTER SET=utf8;


