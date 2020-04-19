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

#2018-04-18

ALTER TABLE `byt_config`
ADD UNIQUE INDEX `variable_UNIQUE` (`variable` ASC);

#2018-05-07
ALTER TABLE  `byt_article`
ADD  `photo_file_ids` CHAR( 16 ) NULL DEFAULT NULL COMMENT  '相册文件' AFTER  `tag`

#2018-06-02
ALTER TABLE `byt_config`
ENGINE=InnoDB;

#2018-06-06
INSERT INTO `byt_config` (`scope`, `variable`, `value`, `description`) VALUES ('base', 'system_notes', NULL, '系统描述'), ('base', 'tel', '', '');
INSERT INTO `byt_config` (`scope`, `variable`, `value`, `description`) VALUES ('base', 'email', '', '');

#2018-06-09

ALTER TABLE `byt_admin_user` ADD `last_login_ip` CHAR(16) NULL DEFAULT NULL AFTER `status`;

ALTER TABLE `byt_admin_user` ADD `lat_login_at` INT(11) NOT NULL DEFAULT '0' AFTER `last_login_ip`;

ALTER TABLE `byt_admin_user` ADD `login_count` INT(11) NOT NULL DEFAULT '0' AFTER `last_login_ip`;

ALTER TABLE `byt_admin_user` CHANGE `lat_login_at` `last_login_at` INT(11) NOT NULL DEFAULT '0';

#2018-06-16

ALTER TABLE `byt_user`
ADD COLUMN `login_count`  int(10) NOT NULL DEFAULT 0 COMMENT '登陆次数' AFTER `status`,
ADD COLUMN `last_login_ip`  char(16) NOT NULL DEFAULT '' COMMENT '最后登录IP' AFTER `login_count`,
ADD COLUMN `last_login_at`  int(11) NOT NULL DEFAULT 0 COMMENT '最后登录时间' AFTER `last_login_ip`;

#2018-06-19

ALTER TABLE `byt_user` ADD `avatar` VARCHAR(255) NULL DEFAULT NULL AFTER `email`;

#2018-06-26

CREATE TABLE `byt_options` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `type` TINYINT(2) NOT NULL DEFAULT '0' COMMENT '类型.0系统,1自定义,2banner,3广告' , `name` VARCHAR(255) NOT NULL COMMENT '标识符' , `value` TEXT NOT NULL COMMENT '值' , `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '状态' , `sort` INT(11) NOT NULL DEFAULT '0' COMMENT '排序' , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `byt_options` ADD `created_at` INT(11) NOT NULL COMMENT '创建时间' AFTER `sort`;

ALTER TABLE `byt_options` ADD `updated_at` INT(11) NOT NULL DEFAULT '0' COMMENT '修改时间' AFTER `created_at`;

#2018-07-05

ALTER TABLE `byt_carousel_item`
MODIFY COLUMN `carousel_id`  int(11) NOT NULL COMMENT '父级' AFTER `id`,
MODIFY COLUMN `url`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT '链接地址' AFTER `carousel_id`,
MODIFY COLUMN `caption`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT '描述' AFTER `url`,
MODIFY COLUMN `image`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT '图片' AFTER `caption`,
MODIFY COLUMN `status`  smallint(6) NOT NULL DEFAULT 0 COMMENT '是否启用' AFTER `image`,
MODIFY COLUMN `sort`  int(11) NULL DEFAULT 0 COMMENT '排序' AFTER `status`;

ALTER TABLE `byt_carousel_item` ADD CONSTRAINT `carousel` FOREIGN KEY (`carousel_id`) REFERENCES `byt_carousel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `byt_carousel`
MODIFY COLUMN `key`  varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '键值' AFTER `id`,
MODIFY COLUMN `title`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '描述' AFTER `key`,
MODIFY COLUMN `status`  smallint(6) NULL DEFAULT 0 COMMENT '是否开启' AFTER `title`;

#2018-07-09

CREATE TABLE `byt_auth_item` (
`id`  int(11) NULL AUTO_INCREMENT ,
`menu_id`  int(11) NOT NULL DEFAULT 0 ,
`rule_name`  varchar(64) NOT NULL COMMENT 'rule名称' ,
`method`  varchar(64) NOT NULL COMMENT 'rule请求方法(POST\\GET\\PUT\\DELETE....)' ,
`description`  text NULL ,
`created_at`  int(11) NULL DEFAULT 0 ,
`updated_at`  int(11) NULL DEFAULT 0 ,
PRIMARY KEY (`id`),
UNIQUE INDEX `rule_unqiue` (`rule_name`) USING BTREE
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8
COMMENT='权限规则表'
;

#2018-07-10

ALTER TABLE `byt_auth_item` ADD `sort` INT(11) NULL DEFAULT '0' AFTER `method`;

ALTER TABLE `byt_auth_item` ADD `pid` INT(11) NULL DEFAULT '0' COMMENT '上级ID' AFTER `id`;

ALTER TABLE `byt_auth_item`
ADD COLUMN `rule_format`  varchar(100) NOT NULL COMMENT 'rule' AFTER `rule_name`,
DROP INDEX `rule_unqiue` ,
ADD UNIQUE INDEX `rule_unqiue` (`rule_format`) USING BTREE ;

#2018-07-15

ALTER TABLE `byt_auth_item`
MODIFY COLUMN `menu_id`  int(11) NULL DEFAULT 0 AFTER `pid`;

ALTER TABLE `byt_options`
ADD COLUMN `input_type`  tinyint(2) NULL DEFAULT 0 COMMENT '输入类型' AFTER `type`;

ALTER TABLE `byt_options`
ADD COLUMN `title`  varchar(255) NOT NULL COMMENT '名称' AFTER `input_type`;

#2018-07-17

ALTER TABLE `byt_article`
ADD COLUMN `original`  varchar(255) NULL COMMENT '原图地址' AFTER `summary`;

#2018-07-27

ALTER TABLE `byt_admin_role_permission`
MODIFY COLUMN `menu_id`  int(11) UNSIGNED NULL COMMENT '菜单Id' AFTER `role_id`;

#2018-07-30

ALTER TABLE `byt_admin_role_permission`
ADD COLUMN `auth_id`  int(11) NOT NULL DEFAULT 0 COMMENT '权限Id' AFTER `role_id`;


#2018-12-13

CREATE TABLE `byt_collect_task` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(10) NOT NULL DEFAULT 0 COMMENT '创建人',
  `name` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '任务名称',
  `status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '状态（1：启用，2：禁用）',
  `url` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '采集地址',
  `rule` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '采集规则【主要是正则】',
  `created_at` INT(11) NOT NULL DEFAULT 0,
  `updated_at` INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
COMMENT = '内容采集任务表';


#2019-01-09

CREATE TABLE `byt_article_meta` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `aid` int(11) UNSIGNED NOT NULL COMMENT '文章id',
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'tag名',
  `value` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'tag值',
  `created_at` int(11) UNSIGNED NOT NULL COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `byt_article_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_aid` (`aid`),
  ADD KEY `index_key` (`key`);

ALTER TABLE `byt_article_meta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id';

ALTER TABLE `byt_article_meta`
  ADD CONSTRAINT `fk_byt_article_meta_aid` FOREIGN KEY (`aid`) REFERENCES `byt_article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `byt_admin_user`
ADD COLUMN `penname` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' AFTER `username`,
COMMENT = '笔名';

#2019 03-28
/*show create table tableName*/
CREATE TABLE `byt_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `article_id` int(10) NOT NULL DEFAULT '0',
  `parent_id` int(10) NOT NULL DEFAULT '0' COMMENT '回复的评论id，默认回复文章的评论为0',
  `nickname` varchar(32) NOT NULL DEFAULT '' COMMENT '回复人名称',
  `admin_id` int(10) NOT NULL DEFAULT '0' COMMENT '管理员回复id',
  `ip` varchar(32) NOT NULL DEFAULT '' COMMENT '回复者ip',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1:yes,2:no',
  `like_count` int(10) NOT NULL DEFAULT '0',
  `repeat_count` int(10) DEFAULT '0' COMMENT '转发量',
  `contents` varchar(255) NOT NULL DEFAULT '',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='评论表';

ALTER TABLE `byt_comment`
MODIFY COLUMN `parent_id` int(10) NOT NULL DEFAULT 0 COMMENT '回复的评论id，默认回复文章的评论为0' AFTER `article_id`,
ADD COLUMN `nickname` varchar(32) NOT NULL DEFAULT '' COMMENT '回复人名称' AFTER `parent_id`,
ADD COLUMN `admin_id` int(10) NOT NULL DEFAULT 0 COMMENT '管理员回复id' AFTER `nickname`,
ADD COLUMN `ip` varchar(32) NOT NULL DEFAULT '' COMMENT '回复者ip' AFTER `admin_id`;

ALTER TABLE `byt_article`
ADD COLUMN `comment_count` int(10) NOT NULL COMMENT '评论条数' AFTER `user_id`;

#2019/06/21
ALTER TABLE `byt_attachment` 
ADD COLUMN `filehash` CHAR(32) NULL DEFAULT '' COMMENT '文件散列值' AFTER `filepath`;

ALTER TABLE `byt_user` 
CHANGE COLUMN `avatar` `avatar` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT '' COMMENT '头像' ;

#2019/06/24
ALTER TABLE `byt_article` 
CHANGE COLUMN `photo_file_ids` `photo_file_ids` VARCHAR(100) NULL DEFAULT NULL COMMENT '相册文件' ;

#2020-03-06

ALTER TABLE `byt_category` ADD `type` TINYINT(2) NOT NULL DEFAULT '1' COMMENT '类型：1：技术，2：产品' AFTER `name`;


#2020-03-15

CREATE TABLE `byt_mall_spec_group` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cid` INT(10) NOT NULL DEFAULT 0 COMMENT '商品分类id，一个分类下有多个模板，指定该组在哪个分类下',
  `name` VARCHAR(45) NOT NULL COMMENT '该规格组的名称',
  `created_at` INT(11) NOT NULL,
  `updated_at` INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
COMMENT = '参数规格分组表';

CREATE TABLE `byt_mall_spec_param` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cid` INT(10) NOT NULL DEFAULT 0 COMMENT '商品分类',
  `group_id` INT(10) NOT NULL DEFAULT 0 COMMENT '参数规格分组id',
  `name` VARCHAR(255) NOT NULL COMMENT '参数名',
  `numeric` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '是否是数字类型参数(0:否，1：是)',
  `unit` VARCHAR(16) NULL DEFAULT '' COMMENT '数字类型参数的单位，非数字类型可以为空',
  `generic` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '是否是sku通用属性(0否：1是)（规格参数中有一部分是 SKU的通用属性，一部分是SKU的特有属性，而且其中会有一些将来用作搜索过滤，这些信息都需要标记出来）',
  `searching` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '是否用于搜索过滤（0：否，1：是）',
  `segments` VARCHAR(500) NULL COMMENT '值类型参数，如果需要搜索，则添加分段间隔值，如CPU频率间隔：0.5-1.0',
  PRIMARY KEY (`id`),
  INDEX `key_group` (`group_id` ASC),
  INDEX `key_category` (`cid` ASC))
COMMENT = '参数规格参数信息表';

CREATE TABLE `byt_mall_brand` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL COMMENT '品牌名称',
  `brand_code` CHAR(16) NOT NULL COMMENT '品牌编码',
  `image` VARCHAR(255) NULL DEFAULT '' COMMENT '品牌图片地址',
  `letter` CHAR(1) NULL DEFAULT '' COMMENT '品牌的首字母',
  `sort` INT(10) NOT NULL DEFAULT 0,
  `created_at` INT(11) NOT NULL DEFAULT 0,
  `updated_at` INT(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`))
COMMENT = '品牌表';

CREATE TABLE `byt_mall_category_brand` (
  `category_id` INT(11) NOT NULL COMMENT '商品类目id',
  `brand_id` INT(11) NOT NULL COMMENT '品牌id',
  PRIMARY KEY (`category_id`))
COMMENT = '商品分类和品牌的中间表';

CREATE TABLE `byt_mall_sku` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `spu_id` INT(10) NOT NULL COMMENT 'spu的id',
  `sku_code` CHAR(16) NOT NULL COMMENT 'SKU唯一码',
  `title` VARCHAR(100) NOT NULL COMMENT '商品的标题',
  `cost_price` DECIMAL(6,2) NOT NULL DEFAULT 0 COMMENT '成本价',
  `price` DECIMAL(6,2) NOT NULL COMMENT '销售价',
  `special_price` DECIMAL(6,2) NULL DEFAULT 0 COMMENT '销售特价',
  `images` VARCHAR(500) NULL DEFAULT '' COMMENT '商品的图片，多个图片以\',\'分开（可以存放attachment ID）',
  `indexes` VARCHAR(255) NULL DEFAULT '',
  `own_spec` TEXT NULL COMMENT 'sku的特有规格参数键值对，json格式,保证有序',
  `enable` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '是否有效，0无效，1有效',
  `sort` INT(10) NOT NULL DEFAULT 0,
  `created_at` INT(11) NOT NULL DEFAULT 0,
  `updated_at` INT(11) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `sku_code_UNIQUE` (`sku_code` ASC))
COMMENT = 'sku表(表示具体的商品实体,如黑色的 64g的iphone 8)';

ALTER TABLE `byt_mall_sku`
ADD COLUMN `stock` INT(10) NOT NULL DEFAULT 0 COMMENT '库存' AFTER `special_price`,
ADD COLUMN `weight` DECIMAL(4,2) NULL DEFAULT 0 COMMENT '重量' AFTER `stock`;

CREATE TABLE `byt_mall_spu` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `spu_code` CHAR(16) NOT NULL COMMENT 'spu唯一码',
  `title` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '标题',
  `sub _title` VARCHAR(200) NULL DEFAULT '' COMMENT '子标题',
  `cid1` INT(10) NOT NULL DEFAULT 0 COMMENT '一级目录id',
  `cid2` INT(10) NULL DEFAULT 0 COMMENT '二级目录id',
  `cid3` INT(10) NULL DEFAULT 0 COMMENT '三级目录id',
  `brand_id` INT(10) NULL DEFAULT 0 COMMENT '商品所属品牌id',
  `brand_name` VARCHAR(100) NULL DEFAULT '' COMMENT '商品所属品牌名称',
  `weight` DECIMAL(4,2) NULL DEFAULT 0 COMMENT '毛重\\重量(KG)',
  `dim` VARCHAR(200) NULL DEFAULT '' COMMENT '产地',
  `saleable` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '是否上架(0下架，1上架)',
  `valid` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '是否有效，0已删除，1有效',
  `sort` INT(10) NOT NULL DEFAULT 0,
  `created_at` INT(11) NOT NULL DEFAULT 0,
  `updated_at` INT(11) NULL DEFAULT 0,
  `deleted_at` INT(11) NULL DEFAULT 0 COMMENT '删除时间',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `spu_code_UNIQUE` (`spu_code` ASC))
COMMENT = '抽象性的商品表(如 iphone8)';


#2020-04-06
ALTER TABLE `byt_mall_spu`
CHANGE COLUMN `saleable` `flag_saleable` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '是否上架(0下架，1上架)' ,
CHANGE COLUMN `valid` `flag_valid` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '是否有效，0已删除，1有效' ,
CHANGE COLUMN `sort` `sort` INT(10) NOT NULL DEFAULT '0' COMMENT '排序' ,
ADD COLUMN `flag_new` SMALLINT(6) NULL COMMENT '新品' AFTER `flag_saleable`,
ADD COLUMN `flag_hot` SMALLINT(6) NULL COMMENT '热销' AFTER `flag_new`,
ADD COLUMN `flag_recommend` SMALLINT(6) NULL COMMENT '推荐' AFTER `flag_hot`,
ADD COLUMN `min_stock` INT(10) NULL COMMENT '库存预警' AFTER `flag_valid`,
ADD COLUMN `content` TEXT NULL COMMENT '内容' AFTER `image_ids`;

ALTER TABLE `byt_mall_spu`
ADD COLUMN `cost_price` DECIMAL(6,2) NULL DEFAULT 0 COMMENT '成本价' AFTER `brand_name`,
ADD COLUMN `price` DECIMAL(6,2) NULL DEFAULT 0 COMMENT '销售价' AFTER `cost_price`,
ADD COLUMN `unit` CHAR(4) NULL DEFAULT '' COMMENT '单位' AFTER `weight`;

ALTER TABLE `byt_mall_spu`
ADD COLUMN `stock` INT(10) NULL DEFAULT 0 COMMENT '库存' AFTER `flag_valid`;

#2020-04-13
ALTER TABLE `byt_category`
ADD COLUMN `path` VARCHAR(45) NULL DEFAULT '' COMMENT '面包屑路径' AFTER `type`;

#2020-04-19

ALTER TABLE `byt_mall_sku`
ADD COLUMN `bar_code` CHAR(16) NULL DEFAULT '' COMMENT '条形码' AFTER `sku_code`;
