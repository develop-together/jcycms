本框架基于YII2+H+，后端主要集成了如下功能：
> * RBAC权限控制
> * 前台用户管理
> * 前台主题模板切换【目前有3套】
> * 系统参数配置
> * 前后台菜单配置
> * 系统访问日志
> * 内容管理【文章、相册、广告....】
> * 待开发功能........

[查看演示站点-账号：demo 666666][1]

系统目录结构如下
DIRECTORY STRUCTURE
-------------------

```
api
    compoents/          自定义组件(没写标准，根据yii2规则来说:compoents里面的都必须继承\\yii\\base\\Compoent才能是组件)
    config/             配置文件
    controllers/        控制器文件
    messages/           国际化配置
    models/             模型文件
    runtime/            运行缓存
    views/              视图文件
    web/                入口目录
common
    compoents/          公共组件
    config/             配置文件
    fixtures/           待开发【单元测试用到】
    libs/               工具类【网上开源代码...】
    models/             模型文件
    mail/               邮件模板
    modules/            模块文件
        attachment/     附件【记录所有上传文件】
            actions     独立操作【也叫外联操作】
            assets/     资源发布文件
            backed/     后台附件相关
                controllers 控制器文件
                views   视图文件
            Module.php  模块
        gii/            自定义gii
            assets/     资源发布文件
            backed/     后台gii相关
                controllers 控制器文件
                views   视图文件
            genratros/  自定义gii模板
                crud    增删改查模板
                form    表格模板
                model   model模板
            Module.php  模块
    Module.php  模块
console
    config/             配置文件
    controllers/        控制器文件
    helpers/            助手类
        collects/       网页爬虫【待完成，正则太垃圾了，在学习下】
    migrations/         数据库迁移文件
    models/             模型文件
    runtime/            运行缓存
data/                   备份的数据库文件...
backend
    actions             独立操作
    assets/             资源发布文件
    compoents/          自定义组件
    config/             配置文件
    controllers/        控制器文件
    grid/               自定义Grid
    helpers/            助手类
    messages/           国际化配置
    models/             模型文件
    runtime/            运行缓存
    views/              视图
    web/                入口文件
    widgets/            插件
frontend
    assets/             资源发布文件
    compoents/          自定义组件
    config/             配置文件
    controllers/        控制器文件
    models/             模型文件
    runtime/            运行缓存
    themes/             主题
    web/                入口文件
    widgets/            插件
vagrant/                虚拟机工具【yii2自带】
vendor/                 composer安装文件
environments/           环境文件
```
**安装教程**

 1. 使用本系统之前先安装composer工具,记得换成阿里云镜像
 2. 把本项目克隆下来
 3. 运行 `composer install -vvv` ,然后再在项目根目录运行 `php init` 进行项目初始化配置
 4. 导入数据库文件，数据库文件在jcycms下的data/yii2_jcycms-2018-11-30.sql，直接导入，如不是最新数据结构请查看data/updata.sql日志更新数据表
 5. 修改数据库配置
 6. 部署好之后需要配置Nginx或者Apache项 此处有好多人不会设置，其实就是把Nginx或者Apache解析到项目的backend/web目录下面。下面提供了两个yii2nginx站点的常用配置方式，作参考
 ```shell
 server {
        listen       80;
        server_name  www.yiifrontend.com.cn;
        root   "E:\wwwroot\jcycms\frontend\web";
        location / {
            index  index.html index.htm index.php;
            #autoindex  on;
            try_files $uri $uri/ /index.php?$args;
        }
        
        location ~ \.php(.*)$ {
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            fastcgi_param  PATH_INFO  $fastcgi_path_info;
            fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
            include        fastcgi_params;
            try_files $uri =404;
        }
        location ~ ^/assets/.*\.php$ {
            deny all;
        }
}
 ```
 ```shell
 server {
        listen       80;
        server_name  crops-tracker.com.cn;
        set $base_root "E:\wwwroot\crops-tracker\frontend\web";
        root $base_root;
        index  index.html index.htm index.php;
        #root   "E:\wwwroot\crops-tracker\frontend\web";
        location / {
            #autoindex  on;
            root $base_root;
            #try_files $uri $uri/ /frontend/web/index.php$is_args$args;
            try_files $uri $uri/ /index.php?$args;
        }
        location /admin {
            try_files $uri $uri/ /admin/index.php?$args;
        }
        location /api {
            try_files $uri $uri/ /api/index.php?$args;
        }
        location ~ \.php(.*)$ {
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            fastcgi_param  PATH_INFO  $fastcgi_path_info;
            fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
            include        fastcgi_params;
            try_files $uri =404;
        }
        location ~ ^/assets/.*\.php$ {
            deny all;
        }
}
 ```
 7. 装好之后的演示账号：demo 密码：`123456 ` 默认管理员账号可先删除数据表`byt_admin_user`表的admin（此时我也忘记admin密码了，就换个法子）那行记录，然后执行`php yii init/createAdministrator`(具体看console代码)创建新管理员

 8. 2019-12-27：最近发现系统存在一个bug，出现bug的原因是：由于系统里面的列表搜索都是POST提交，而列表默认的action是index，因此我在权限检测的时候作了处理，但是有个历史因素是系统设置的action也是index，这样就导致系统设置提交保存权限被泄露了。对于这个问题，我过滤了系统设置的action，目前最好的方法是查询改成get请求，但是出于get的限制，我建议还是post，这样的话就需要使用者建立action时，一定是需要查询的列表的action用index，其它地方建议不使用

9. 2019-12-27：感觉忙了好久了，细想还是不忙的嘛，主要是懒了，好久都没学习新知识，开源新东西了。总结下这段时间忙的事吧：

    >做c#.net项目了，目前只会crud
    >workerman写office转pdf服务，workerman还要深入学习
    >学习使用swoole，用swoole写了一个简单聊天室，用easyswoole写公司项目api（写了一部分），swoole还要继续学习
    
    >写了一个yii2组件：[https://github.com/jiechengyang/i-secure-center/]
    
    >公司项目：Yii2、Yii1、nodejs切换着做
    

写完公司项目，对Yii2理解又多了许多，觉得新年重写这个cms系统，全部使用独立action，然后修改文件结构，然后完善接口
