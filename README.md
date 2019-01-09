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

 1. 使用本系统之前先安装composer工具
 2. 把本项目克隆下来
 3. 运行 `composer install`,然后再在项目根目录运行 `php init` 进行项目初始化配置
 4. 导入数据库文件，数据库文件在jcycms下的data/yii2_jcycms-2018-11-30.sql，直接导入，如不是最新数据结构请查看data/updata.sql日志更新数据表
 5. 修改数据库配置
 6. 部署好之后需要配置Nginx或者Apache项 此处有好多人不会设置，其实就是把Nginx或者Apache解析到项目的backend/web目录下面。
 7. 装好之后的演示账号：demo 密码：123456  默认管理员账号可先删除数据表byt_admin_user表的admin（此时我也忘记admin密码了，就换个法子）那行记录，然后执行php yii init/createAdministrator(具体看console代码)创建新管理员