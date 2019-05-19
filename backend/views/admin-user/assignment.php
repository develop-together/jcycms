<?php

use backend\models\AdminRoles;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Assign Roles');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
        	<div class="ibox-content">
                <div class="form-group">
                    <?php if ($roleLists): ?>
                        <?php foreach ($roleLists as $key => $role): ?>
                            <label><input type="radio" name="assignmentRoles" value="<?= $key ?>"  <?= $key == @$model->userRole->role_id ? 'checked' : '' ?>/><?= $role ?></label>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
			    <div class="form-group">
			    	<div class="col-sm-4 col-sm-offset-2">
			        	<?= Html::Button(Yii::t('app', 'Assign Roles'), ['id' => 'assigned_' . Yii::$app->controller->_uniqid, 'class' => 'btn btn-primary', 'disabled' => @$model->userRole->role_id == AdminRoles::SUPER_ROLE_ID ? true : false]) ?>
			    	</div>
			    </div>
        	</div>
        </div>
    </div>
</div>
<?php
    $uniqid = Yii::$app->controller->_uniqid;
    $url = Url::toRoute(['assignment', 'id' => $model->id]);
    $jsStr = <<<JS
        $("#assigned_$uniqid").on('click', function(event) {
                var event = window.event || event;
                var role_id = $("input[name='assignmentRoles']:checked").val();
                jcms.ajax('POST', "$url", {role_id: role_id}, 'JSON', function(response) {
                    // console.log('我是回调函数哦', response);
                    jcms.callback(response.message, response.statusCode, true);
                });
        });
JS;

$this->registerJs($jsStr);
?>
