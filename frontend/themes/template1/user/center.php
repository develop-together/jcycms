  <?php
    use yii\helpers\Html;
    use yii\helpers\Url;

    \yii\bootstrap\BootstrapAsset::register($this);

    $t1 = Yii::t('frontend', 'Are you sure you want to leave?');
    $t2 = Yii::t('frontend', 'Log out');
    $t3 = Yii::t('common', 'cancel');
   ?>
   <style type="text/css">
    .profile {
        padding-top: 30px;
    }
    .panel .panel-heading {
        background: #FCFCFC;
        border-bottom: #eee solid 1px;
    }
    .panel .panel-heading .panel-title {
        margin: 0;
        font-size: 14px;
        display: inline;
    }
    .img-rounded {
        display: inline-block;
        border-radius: 6px;
    }
    .panel ul {
        padding: 0;
        margin: 0;
    }
    .nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
        background-color: #00a65a;
    }
    .nav > li:after {
        content: "";
        width: 0;
        height: 5px;
        background: #34c9dd;
        position: absolute;
        bottom: 0;
        left: 0;
        transition: all 0.5s ease 0s;
    }
    .nav > li:hover:after {
        width: 100%;
    }
    .user-info li {
        line-height: 2em;
    }
   </style>
  <div class="profile">
   <div class="row">
    <div class="col-md-3">
     <div class="panel panel-default">
      <div class="panel-heading">
       <h3 class="panel-title"> <img src="http://gulin.boyuntong.com/assets/3ff4ae47/avatars/avatar_24x24.png" class="img-rounded" alt="冯晨祥" width="24" height="24" /> 冯晨祥 </h3>
      </div>
      <div class="panel-body">
       <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="<?= Url::to(['user/center']) ?>">个人信息</a></li>
        <li><a href="<?= Url::to(['user/avatar-setting']) ?>">头像设置</a></li>
        <li><a href="<?= Url::to(['user/safety-setting']) ?>">安全设置</a></li>
        <li><a href="javascript:;" data-url="<?= Url::to(['site/logout']) ?>" class="logout">退出登录</a></li>
       </ul>
      </div>
     </div>
    </div>
    <div class="col-md-9">
     <div class="panel panel-default">
      <div class="panel-heading">
       <div class="panel-title">
        <span>个人信息</span>
       </div>
      </div>
      <div class="panel-body">
       <ul class="user-info">
        <li> <i style="font-size:18px;" class="fa fa-smile-o fa-fw"></i> 我的积分： <span style="color:green; font-size:16px; font-weight: bold"> 300分 </span> </li>
        <li><i class="fa fa-phone fa-fw"></i> 手机：13408175078</li>
        <li><i class="fa fa-envelope-o fa-fw"></i> 邮箱：440255678@163.com</li>
        <li><i class="fa fa-map-marker fa-fw"></i> 所在地： 护家镇豁达大度多多多多多多多多大所</li>
        <li><i class="fa fa-sign-in fa-fw"></i> 最后登录：4秒前</li>
       </ul>
      </div>
     </div>
    </div>
   </div>
  </div>
  <?php
    $this->registerJs(<<<JS
        $("div.profile").on('click', '.logout', function() {
            var self = this
            var confirmLayer = layer.confirm('{$t1}', {
              btn: ['{$t2}','{$t3}'] //按钮
            }, function(){
                window.location.href = self.getAttribute('data-url');
            }, function(){
                layer.close(confirmLayer);
            });
        })
JS
);
  ?>