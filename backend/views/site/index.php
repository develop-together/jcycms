<?php

use backend\assets\IndexAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\Menu;

IndexAsset::register($this);
$this->title = yii::t('app', 'Backend Manage System');
?>
<?php $this->beginPage();?>
<!DOCTYPE html>
<html>
	<head>
	    <meta charset="<?=Yii::$app->charset?>">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="renderer" content="webkit">
	    <?=Html::csrfMetaTags()?>
	    <title><?=Html::encode($this->title)?></title>
	    <?php $this->head()?>
	    <link rel="icon" href="<?=yii::$app->getRequest()->hostInfo?>/favicon.ico" type="image/x-icon"/>
	</head>
    <body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    	<?php $this->beginBody();?>
   <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span><img alt="image" class="img-circle" src="<?=Yii::$app->getUser()->getIdentity()->avatar ?  Yii::$app->request->baseUrl.'/' .Yii::$app->params['uploadSaveFilePath'] . '/' .Yii::$app->getUser()->getIdentity()->avatar : 'static/img/profile_small.jpg'?>" width="64" height="64"/></span>
                             <a data-toggle="dropdown" class="dropdown-toggle" href="#" data-target="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <span class="clear">
                                        <span class="block m-t-xs">
                                            <strong class="font-bold">超级管理员</strong>
                                        </span>
                                        <span class="text-muted text-xs block">
                                            <?=\yii::$app->getUser()->getIdentity()->username?>
                                            <b class="caret"></b>
                                        </span>
                                    </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="J_menuItem"
                                       href="javascript:;"><?=yii::t('app', 'Profile')?></a>
                                </li>
                                <li><a class="J_menuItem"
                                       href="javascript:;"><?=yii::t('app', 'Articles')?></a>
                                </li>
                                <li><a target="_blank"
                                       href="javascript:;"><?=yii::t('app', 'Frontend')?></a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="<?=Url::toRoute(['site/logout'])?>"><?=yii::t('app', 'Logout')?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">H+
                        </div>
                    </li>
                    <!--动态菜单配置开始-->
                        <?php 
                            // 设置缓存依赖（重新缓存取决于它是否被修改过）
                            // $cacheDependencyObject = yii::createObject([
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
                            //     ],                                
                            // ])){
                            //     echo Menu::getBackendMenus();
                            //     $this->endCache();
                            // }
                            echo Menu::getBackendMenus();
                         ?>
                    <!--动态菜单配置结束-->
                <li><a href="gii/default" class="J_menuItem"><i class="fa fa-bolt"></i><span class="nav-label">GII</span></a></li>
                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li class="m-t-xs">
                                    <div class="dropdown-messages-box">
                                        <a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="static/img/a7.jpg">
                                        </a>
                                        <div class="media-body">
                                            <small class="pull-right">46小时前</small>
                                            <strong>小四</strong> 这个在日本投降书上签字的军官，建国后一定是个不小的干部吧？
                                            <br>
                                            <small class="text-muted">3天前 2014.11.8</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="static/img/a4.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right text-navy">25小时前</small>
                                            <strong>国民岳父</strong> 如何看待“男子不满自己爱犬被称为狗，刺伤路人”？——这人比犬还凶
                                            <br>
                                            <small class="text-muted">昨天</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a class="J_menuItem" href="mailbox.html">
                                            <i class="fa fa-envelope"></i> <strong> 查看所有消息</strong>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="mailbox.html">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> 您有16条未读消息
                                            <span class="pull-right text-muted small">4分钟前</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="profile.html">
                                        <div>
                                            <i class="fa fa-qq fa-fw"></i> 3条新回复
                                            <span class="pull-right text-muted small">12分钟钱</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a class="J_menuItem" href="notifications.html">
                                            <strong>查看所有 </strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="hidden-xs">
                            <a href="<?=yii::$app->params['site']['url']?>" target='_blank'><i
                                        class="fa fa-internet-explorer"></i> <?=yii::t('app', 'Frontend')?></a>
                        </li>
                        <li class="hidden-xs">
                            <a href="javascript:void(0)" onclick="reloadIframe()"><i
                                        class="fa fa-refresh"></i> <?=yii::t('app', 'Refresh')?></a>
                        </li>
                        <li class="hidden-xs">
                            <a href="http://cms.feehi.com/help" class="J_menuItem" data-index="0"><i
                                        class="fa fa-cart-arrow-down"></i> <?=yii::t('app', 'Support')?></a>
                        </li>
                        <li class="dropdown hidden-xs">
                            <a class="right-sidebar-toggle" aria-expanded="false">
                                <i class="fa fa-tasks"></i> <?=yii::t('app', 'Theme')?>
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
                        <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">首页</a>
                    </div>
                </nav>
                <button class="roll-nav roll-right J_tabRight" style="right:60px;"><i class="fa fa-forward"></i>
                </button>
                <a href="<?=Url::toRoute(['site/logout'])?>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
                <!--                 <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                </button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                <li class="J_tabShowActive"><a>定位当前选项卡</a>
                </li>
                <li class="divider"></li>
                <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                </li>
                <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                </li>
                </ul>
                </div> -->                
            </div>
            <!--Tab面板结束-->
            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="javascript:;" frameborder="0" data-id="index_v1.html" seamless></iframe>
            </div>
            <div class="footer">
                <div class="pull-right">&copy; 2016-<?=date('Y')?> <a href="https://www.cnblogs.com/YangJieCheng/" target="_blank">yangboom's blog</a>
                </div>
            </div>
        </div>
        <!--右侧部分结束-->
        <!--右侧边栏开始-->
        <div id="right-sidebar">
        </div>
        <!--右侧边栏结束-->
    </div>
    	<?php $this->endBody();?>
    </body>
    <style type="text/css">
        .jcymenu{
            position: absolute;
            z-index: 9999;
            top: 91px;
            left: 281px;
        }
        .jcymenuli{
            background: rgb(255, 255, 255);
            width: 150px;
            border: 1px #eeeeee ;
        }
    </style>
    <script>
        function reloadIframe() {
            var current_iframe = $("iframe:visible");
            current_iframe[0].contentWindow.location.reload();
            return false;
        }         
    </script>
</html>
<?php $this->endPage();?>
