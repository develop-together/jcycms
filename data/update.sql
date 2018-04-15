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
CREATE TABLE IF NOT EXISTS `byt_admin_role_permission` (
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

ALTER TABLE `byt_admin_role_permission` ADD `opt_id` INT(11) UNSIGNED NULL DEFAULT '0' COMMENT '操作者id' AFTER `menu_id`;

#2018-04-10

CREATE TABLE `byt_article` (
  `id` INT(11) UNSIGNED NOT NULL,
  `category_id` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '分类',
  `type` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '类型',
  `title` VARCHAR(255) NOT NULL COMMENT '标题',
  `sub_title` VARCHAR(255) NULL DEFAULT '' COMMENT '副标题',
  `summary` VARCHAR(255) NULL DEFAULT '' COMMENT '概述',
  `thumb` VARCHAR(255) NULL DEFAULT '' COMMENT '缩略图',
  `seo_title` VARCHAR(255) NULL DEFAULT '' COMMENT 'seo标题',
  `seo_keywords` VARCHAR(255) NULL DEFAULT '' COMMENT 'seo关键字',
  `seo_description` VARCHAR(255) NULL DEFAULT '' COMMENT 'seo描述',
  `status` SMALLINT(6) UNSIGNED NULL DEFAULT 1 COMMENT '状态[1=>发布,2=>草稿]',
  `sort` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '排序',
  `user_id` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '作者',
  `scan_count` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '阅读量',
  `can_comment` SMALLINT(6) UNSIGNED NULL DEFAULT 1 COMMENT '是否评论[1=>是,2=>否]',
  `visibility` SMALLINT(6) UNSIGNED NULL DEFAULT 1 COMMENT '可见[1=>公开,2=>评论]',
  `tag` VARCHAR(255) NULL DEFAULT '' COMMENT '标签',
  `flag_headline` SMALLINT(6) UNSIGNED NULL DEFAULT 0 COMMENT '头条',
  `flag_recommend` SMALLINT(6) UNSIGNED NULL DEFAULT 0,
  `flag_slide_show` SMALLINT(6) UNSIGNED NULL DEFAULT 0,
  `flag_special_recommend` SMALLINT(6) UNSIGNED NULL DEFAULT 0,
  `flag_roll` SMALLINT(6) UNSIGNED NULL DEFAULT 0,
  `flag_bold` SMALLINT(6) UNSIGNED NULL DEFAULT 0,
  `flag_picture` SMALLINT(6) UNSIGNED NULL DEFAULT 0,
  `created_at` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT(11) UNSIGNED NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `index_title` (`title` ASC, `category_id` ASC, `tag` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COMMENT = '内容表';

ALTER TABLE `byt_article` 
CHANGE COLUMN `flag_recommend` `flag_recommend` SMALLINT(6) UNSIGNED NULL DEFAULT '0' COMMENT '推荐' ,
CHANGE COLUMN `flag_slide_show` `flag_slide_show` SMALLINT(6) UNSIGNED NULL DEFAULT '0' COMMENT '幻灯' ,
CHANGE COLUMN `flag_special_recommend` `flag_special_recommend` SMALLINT(6) UNSIGNED NULL DEFAULT '0' COMMENT '特别推荐' ,
CHANGE COLUMN `flag_roll` `flag_roll` SMALLINT(6) UNSIGNED NULL DEFAULT '0' COMMENT '滚动' ,
CHANGE COLUMN `flag_bold` `flag_bold` SMALLINT(6) UNSIGNED NULL DEFAULT '0' COMMENT '加粗' ,
CHANGE COLUMN `flag_picture` `flag_picture` SMALLINT(6) UNSIGNED NULL DEFAULT '0' COMMENT '图片' ;

CREATE TABLE `byt_category` (
  `id` INT(11) UNSIGNED NOT NULL,
  `parent_id` INT(11) UNSIGNED NULL DEFAULT 0,
  `name` VARCHAR(255) NOT NULL COMMENT '名称',
  `alias` VARCHAR(255) NOT NULL COMMENT '别名',
  `sort` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '排序',
  `remark` VARCHAR(255) NULL DEFAULT '' COMMENT '备注',
  `created_at` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` INT(11) UNSIGNED NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE `byt_article_content` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '文章表ID',
  `content` TEXT NULL DEFAULT NULL COMMENT '内容',
  PRIMARY KEY (`id`),
  INDEX `fk_aid_idx` (`article_id` ASC),
  CONSTRAINT `fk_aid`
    FOREIGN KEY (`article_id`)
    REFERENCES `byt_article` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

ALTER TABLE `byt_category` 
DROP COLUMN `alias`;

ALTER TABLE `byt_category` 
CHANGE COLUMN `id` `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ;

#2018-04-12

ALTER TABLE `byt_article` 
CHANGE COLUMN `id` `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ;

ALTER TABLE `byt_article_content` 
DROP FOREIGN KEY `fk_aid`;

#2018-04-15

ALTER TABLE `byt_article`
MODIFY COLUMN `type`  int(11) UNSIGNED NULL DEFAULT 0 COMMENT '类型[0|文章，2|单页]' AFTER `category_id`;

CREATE TABLE `byt_friend_link` (
`id`  int(11) UNSIGNED NULL AUTO_INCREMENT ,
`name`  varchar(255) NULL COMMENT '名称' ,
`image`  varchar(255) NOT NULL DEFAULT '' COMMENT '图片' ,
`url`  varchar(255) NOT NULL COMMENT '链接地址' ,
`target`  varchar(255) NULL DEFAULT '_blank' COMMENT '打开方式' ,
`sort`  int(11) NULL DEFAULT 0 ,
`status`  tinyint(1) NULL DEFAULT 0 ,
`created_at`  int(11) NOT NULL ,
`updated_at`  int(11) NULL DEFAULT 0 ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
COMMENT='友情链接表'
;

ALTER TABLE  `byt_friend_link` ADD  `user_id` INT( 11 ) NULL DEFAULT  '0' COMMENT  '操作人' AFTER  `id`

CREATE TABLE `byt_admin_log` (
`id`  int(11) NULL AUTO_INCREMENT ,
`user_id`  int(11) NOT NULL DEFAULT 0 ,
`route`  varchar(255) NULL ,
`description`  text NULL ,
`created_at`  int(11) NOT NULL ,
`updated_at`  int(11) NULL DEFAULT 0 ,
PRIMARY KEY (`id`),
CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `byt_admin_user` (`id`) ON DELETE CASCADE
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
COMMENT='系统操作日志'
;


CREATE TABLE IF NOT EXISTS `byt_config` (
  `scope` char(20) NOT NULL DEFAULT '' COMMENT '类型',
  `variable` varchar(50) NOT NULL COMMENT '变量',
  `value` text COMMENT '值',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  PRIMARY KEY (`variable`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统配置';












