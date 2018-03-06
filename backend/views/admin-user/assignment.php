<?php

use backend\models\AdminRoles;
use yii\helpers\Html;
$this->title = "分配角色";

?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
        	<?= $this->render('/widgets/_ibox-title') ?>
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
			        	<?= Html::submitButton(Yii::t('app', 'Assign Roles'), ['class' => 'btn btn-primary', 'disabled' => @$model->userRole->role_id == AdminRoles::SUPER_ROLE_ID ? true : false]) ?>

			        	<?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']);?>   			    		
			    	</div>
			    </div>        		
        	</div>    	
        </div>
    </div>
</div>
