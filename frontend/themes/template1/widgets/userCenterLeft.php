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
        <li class="<?= 'center' === $this->context->action->id ? 'active' : '' ?>"><a href="<?= Url::to(['user/center']) ?>"><?= Yii::t('frontend', 'Personal information') ?></a></li>
        <li class="<?= 'avatar-setting' === $this->context->action->id ? 'active' : '' ?>"><a href="<?= Url::to(['user/avatar-setting']) ?>"><?= Yii::t('frontend', 'Avatar setting') ?></a></li>
        <li class="<?= 'safety-setting' === $this->context->action->id ? 'active' : '' ?>"><a href="<?= Url::to(['user/safety-setting']) ?>"><?= Yii::t('frontend', 'Security settings') ?></a></li>
        <li class="<?= 'reading-record' === $this->context->action->id ? 'active' : '' ?>"><a href="<?= Url::to(['user/reading-record']) ?>"><?= Yii::t('frontend', 'Reading record') ?></a></li>
        <li class="<?= 'like-record' === $this->context->action->id ? 'active' : '' ?>"><a href="<?= Url::to(['user/like-record']) ?>"><?= Yii::t('frontend', 'Like record') ?></a></li>
        <li class="<?= 'comment-record' === $this->context->action->id ? 'active' : '' ?>"><a href="<?= Url::to(['user/comment-record']) ?>"><?= Yii::t('frontend', 'Comment record') ?></a></li>
        <li ><a href="javascript:;" data-url="<?= Url::to(['site/logout']) ?>" class="logout">退出登录</a></li>
       </ul>
      </div>
   </div>
</div>