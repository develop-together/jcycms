<?php

use backend\models\AdminRoles;
use yii\helpers\Html;
$this->title = "分配角色";
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
        	<div class="ibox-content">
                <div class="form-group">
                    <?php if ($roleLists): ?>
                        <?php foreach ($roleLists as $key => $role): ?>
                            <input type="radio" name="assignment[role][]" value="<?= $key ?>"  <?= $key == @$model->userRole->role_id ? 'checked' : '' ?>/><?= $role ?>
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
    $jsStr = <<<JS
        $("#assigned_$uniqid").on('click', function(event) {
                var event = window.event || event;
                jcms.callback('操作成功');
        }
JS;
$this->registerJs($jsStr);
?>
