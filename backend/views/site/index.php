<?php

use backend\assets\IndexAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\User;
use common\components\UserAcl;

IndexAsset::register($this);

$this->title = Yii::t('app', 'Backend Manage System');

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="icon" href="<?= Yii::$app->getRequest()->hostInfo ?>/favicon.ico" type="image/x-icon"/>
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<?php $this->beginBody(); ?>
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i></div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div id="dropdown-control" class="dropdown profile-element">
                        <span><img alt="image" class="img-circle"
                                   src="<?= Yii::$app->getUser()->getIdentity()->avatar ? Yii::$app->request->baseUrl . '/' . Yii::$app->getUser()->getIdentity()->avatar : 'static/img/profile_small.jpg' ?>"
                                   width="64" height="64"/></span>
                        <a id="control-btn" data-toggle="dropdown" class="dropdown-toggle" href="#" data-target="#"
                           role="button" aria-haspopup="true" aria-expanded="false">
                                            <span class="clear">
                                                <span class="block m-t-xs">
                                                    <strong class="font-bold"><?= @\Yii::$app->getUser()->getIdentity()->userRole->role->role_name ?></strong>
                                                </span>
                                                <span class="text-muted text-xs block">
                                                    <?= \Yii::$app->getUser()->getIdentity()->username ?>
                                                    <b class="caret"></b>
                                                </span>
                                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="self-click J_menuItem"
                                   href="<?= Url::toRoute(['admin-user/update-self']) ?>"><?= Yii::t('app', 'Profile') ?></a>
                            </li>
                            <li><a class="self-click J_menuItem"
                                   href="<?= Url::toRoute(['article/index']) ?>"><?= Yii::t('app', 'Articles') ?></a>
                            </li>
                            <li><a target="_blank"
                                   href="<?= Yii::$app->params['site']['url'] ?>"><?= Yii::t('app', 'Frontend') ?></a>
                            </li>
                            <li class="divider"></li>
                            <li><a class="self-click"
                                   href="<?= Url::toRoute(['public/logout']) ?>"><?= Yii::t('app', 'Logout') ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="logo-element">JCY
                    </div>
                </li>
                <!--动态菜单配置开始-->
                <?php
                // 设置缓存依赖（重新缓存取决于它是否被修改过）
                // $cacheDependencyObject = Yii::createObject([
                //     'class' => 'common\components\FileDependencyHelper',
                //     'fileName' => 'backend_menu.log',
                // ]);
                // $dependency = [
                //     'class' => 'yii\caching\FileDependency',
                //     'fileName' => $cacheDependencyObject->createFile(),
                // ];
                // if ($this->beginCache('backend_menu', [
                //     'variations' => [
                //         Yii::$app->language,
                //         UserAcl::getRoleId(),
                //     ],
                // ])) {
                //     echo UserAcl::getBackendMenus();
                //     $this->endCache();
                // }
                echo UserAcl::getBackendMenus();
                ?>
                <!--动态菜单配置结束-->
                <?php if (YII_ENV_DEV && User::checkSuperManager()): ?>
                    <li><a href="<?= Url::toRoute(['gii/default/index']) ?>" class="J_menuItem"><i
                                    class="fa fa-bolt"></i><span class="nav-label">GII</span></a></li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                                class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                        </a>
                    </li>
                    <li class="hidden-xs">
                        <a href="<?= Yii::$app->params['site']['url'] ?>" target='_blank'><i
                                    class="fa fa-internet-explorer"></i> <?= Yii::t('app', 'Frontend') ?></a>
                    </li>
                    <li class="hidden-xs">
                        <a href="javascript:void(0)" onclick="reloadIframe()"><i
                                    class="fa fa-refresh"></i> <?= Yii::t('app', 'Refresh') ?></a>
                    </li>
                    <li class="hidden-xs">
                        <a href="javascript:;" data-index="0" target="_blank"><i
                                    class="fa fa-cart-arrow-down"></i> <?= Yii::t('app', 'Support') ?></a>
                    </li>
                    <li class="dropdown hidden-xs">
                        <a class="right-sidebar-toggle" aria-expanded="false">
                            <i class="fa fa-tasks"></i> <?= Yii::t('app', 'Theme') ?>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <!--Tab面板开始-->
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active J_menuTab"
                       data-id="<?= Url::toRoute(['site/desktop']) ?>"><?= Yii::t('app', 'Home') ?></a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight" style="right:140px;"><i class="fa fa-forward"></i>
            </button>
            <a href="javascript:;" id="stepOut" class="roll-nav roll-right J_tabExit" style="width:80px;right: 60px;"><i
                        class="fa fa-lock"></i> <?= Yii::t('app', 'step out') ?></a>
            <a href="<?= Url::toRoute(['public/logout']) ?>" class="roll-nav roll-right J_tabExit"><i
                        class="fa fa-sign-out"></i> <?= Yii::t('app', 'Logout') ?></a>
            <!--                         <div class="btn-group roll-nav roll-right">
                            <button class="dropdown J_tabClose" data-toggle="dropdown">
                                <?php //echo Yii::t('app', 'Close') ?><span class="caret"></span>
                            </button>
                            <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                <li class="J_tabShowActive">
                                    <a><?php //echo Yii::t('app', 'Locate Current Tab') ?></a>
                                </li>
                                <li class="divider"></li>
                                <li class="J_tabCloseAll">
                                    <a><?php //echo Yii::t('app', 'Close All Tab') ?></a>
                                </li>
                                <li class="J_tabCloseOther">
                                    <a><?php //echo Yii::t('app', 'Close Other Tab') ?></a>
                                </li>
                            </ul>
                        </div>  -->
        </div>
        <!--Tab面板结束-->
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%"
                    src="<?= Url::toRoute(['site/desktop']) ?>" frameborder="0"
                    data-id="<?= Url::toRoute(['site/desktop']) ?>" seamless></iframe>
        </div>
        <div class="footer">
            <div class="pull-right">&copy; 2016-<?= date('Y') ?> <a href="https://www.cnblogs.com/YangJieCheng/"
                                                                    target="_blank">yangboom's blog</a>
            </div>
        </div>
    </div>
    <!--右侧部分结束-->
    <!--右侧边栏开始-->
    <div id="right-sidebar">
        <div class="sidebar-container">

            <ul class="nav nav-tabs navs-3">

                <li class="active">
                    <a data-toggle="tab" href="#tab-1">
                        <i class="fa fa-gear"></i> 主题
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="sidebar-title">
                        <h3><i class="fa fa-comments-o"></i> 主题设置</h3>
                        <small><i class="fa fa-tim"></i> 你可以从这里选择和预览主题的布局和样式，这些设置会被保存在本地，下次打开的时候会直接应用这些设置。</small>
                    </div>
                    <div class="skin-setttings">
                        <div class="title">主题设置</div>
                        <div class="setings-item">
                            <span>收起左侧菜单</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox"
                                           id="collapsemenu">
                                    <label class="onoffswitch-label" for="collapsemenu">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>固定顶部</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox"
                                           id="fixednavbar">
                                    <label class="onoffswitch-label" for="fixednavbar">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>固定宽度</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox"
                                           id="boxedlayout">
                                    <label class="onoffswitch-label" for="boxedlayout">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="title">皮肤选择</div>
                        <div class="setings-item default-skin nb">
                            <span class="skin-name "><a href="#" class="s-skin-0">默认皮肤</a></span>
                        </div>
                        <div class="setings-item blue-skin nb">
                            <span class="skin-name "><a href="#" class="s-skin-1">蓝色主题 </a></span>
                        </div>
                        <div class="setings-item yellow-skin nb">
                            <span class="skin-name "><a href="#" class="s-skin-3">黄色/紫色主题</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--右侧边栏结束-->
</div>
<?php $this->endBody(); ?>
</body>
<style type="text/css">
    .jcymenu {
        position: absolute;
        z-index: 9999;
        top: 91px;
        left: 281px;
    }

    .jcymenuli {
        background: rgb(255, 255, 255);
        width: 150px;
        border: 1px #eeeeee;
    }
</style>
<script>
    var global_pass = '';

    function reloadIframe() {
        var current_iframe = $("iframe:visible");
        current_iframe[0].contentWindow.location.reload();
        return false;
    }

    (function () {
        //数字0-9，大写字母，小写字母，ASCII或UNICODE编码（十进制），共62个
        var charCodeIndex = [[48, 57], [65, 90], [97, 122]];
        var charCodeArr = [];

        function getBetweenRound(min, max) {
            return Math.floor(min + Math.random() * (max - min));
        };

        function getCharCode() {
            for (var i = 0, len = 3; i < len; i++) {
                var thisArr = charCodeIndex[i];
                for (var j = thisArr[0], thisLen = thisArr[1]; j <= thisLen; j++) {
                    charCodeArr.push(j);
                }
            }
        }

        function ranStr(slen) {
            slen = slen || 20;
            charCodeArr.length < 62 && getCharCode();

            var res = [];
            for (var i = 0; i < slen; i++) {
                var index = getBetweenRound(0, 61);
                res.push(String.fromCharCode(charCodeArr[index]));
            }
            return res.join('');
        };

        this.ranStr = ranStr;
    })();

    $("#stepOut").bind('click', function () {
        var randstr = ranStr(6);
        layer.prompt({
            title: '输入口令<span style="color:red">' + randstr + '</span>，并确认',
            formType: 1,
            cancel: function (index) {
                if (global_pass !== randstr) {
                    return false;
                }
            }
        }, function (pass, index, elem) {
            if (pass === randstr) {
                global_pass = pass;
                layer.close(index);
            }
        });
    })

    $("a.self-click").bind('click', function (event) {
        $("#dropdown-control").removeClass('open');
        $("#control-btn").attr('aria-expanded', false);
    })
</script>
</html>
<?php $this->endPage(); ?>
