  <?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use common\components\Utils;

    \yii\bootstrap\BootstrapAsset::register($this);

    $user = Yii::$app->user->identity;
    $t1 = Yii::t('frontend', 'Are you sure you want to leave?');
    $t2 = Yii::t('frontend', 'Log out');
    $t3 = Yii::t('common', 'cancel');
   ?>
  <div class="profile">
   <div class="row">
    <?php echo $this->render('/widgets/userCenterLeft', ['user' => $user]) ?>
    <?php if ('default' === $tpl): ?>
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
            <!-- <li><i class="fa fa-phone fa-fw"></i> 手机：</li> -->
            <li><i class="fa fa-envelope-o fa-fw"></i> <?= Yii::t('frontend', 'Email') ?>：<?= $user->email ?></li>
            <li><i class="fa fa-plus fa-fw"></i> <?= Yii::t('frontend', 'Login Count') ?>： <?= $user->login_count ?></li>
            <li><i class="fa fa-map-marker fa-fw"></i> <?= Yii::t('frontend', 'Last Login Address') ?>： <?= $user->getLoginAddress() ?></li>
            <li><i class="fa fa-sign-in fa-fw"></i> <?= Yii::t('frontend', 'Last Login Time') ?>：<?= Utils::tranDateTime($user->last_login_at) ?></li>
           </ul>
          </div>
         </div>
        </div>
    <?php elseif ('avatar-setting' === $tpl): ?>
        <?= $this->render('avatar-setting', ['user' => $user]) ?>
    <?php else: ?>
        <?= $this->render('safety-setting', ['user' => $user]) ?>
    <?php endif ?>
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