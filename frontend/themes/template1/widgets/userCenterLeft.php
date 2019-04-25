<?php
  use yii\helpers\Url;
 ?>
<div class="col-md-3">
   <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"> <img src="<?= $user->getAvatarFormat() ?>" class="img-rounded" alt="<?= $user->username ?>" width="24" height="24" /> <?= $user->username ?> </h3>
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