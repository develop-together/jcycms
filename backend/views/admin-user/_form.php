<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\AdminRoles;
use backend\models\User;
use common\widgets\fileUploadInput\FileUploadInputWidget;
$this->title = "Admin";

?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
        	<?= $this->render('/widgets/_ibox-title') ?>
        	<div class="ibox-content">
                <?php $form = ActiveForm::begin([
                            'id' => 'user-form',
                            'fieldConfig' => [
                                'template' =>"{label}\n<div class=\"col-sm-10\">{input}\n{error}</div>\n{hint}",
                                'labelOptions' => ['class' => 'col-sm-2 control-label'],
                                'options' => ['class' => 'form-group'],    
                                'inputOptions' => ['class' => 'form-control'],
                                'errorOptions' => ['class' => 'help-block m-b-none'],                              
                            ],
                            'options' => [
                                'class' => 'form-horizontal',
                                'enctype' => 'multipart/form-data',
                            ]
                        ]);
                        ?>

                <?= $form->field($model, 'username')->textInput(['maxlength' => 64]) ?>

                <div class="hr-line-dashed"></div>

                <?= $form->field($model, 'avatar')->widget(FileUploadInputWidget::className(),[
                    'type' => 'image'
                ]); ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => 64]) ?>

                <div class="hr-line-dashed"></div>

                <?= $form->field($model, 'password')->passwordInput(['value' => '', 'maxlength' => 512, 'placeHolder' => $model->isNewRecord ? '' : Yii::t('app', 'Not to fill, by default do not modify')]) ?>

                <div class="hr-line-dashed"></div>

                <?= $form->field($model, 'status')->radioList( User::loadStatusOptions() ) ?>

                <div class="hr-line-dashed"></div>
                
                <?= $form->field($rolesModel, 'role_id', [
                    'labelOptions' => [
                        'label' => yii::t('app', 'Roles'),
                    ]
                ])->radioList(AdminRoles::loadRolesOptions()) ?>

			    <div class="form-group">
			    	<div class="col-sm-4 col-sm-offset-2">
			        	<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'disabled' => @$model->userRole->role_id == AdminRoles::SUPER_ROLE_ID ? true : false]) ?>

			        	<?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']);?>   			    		
			    	</div>
			    </div>

			    <?php ActiveForm::end(); ?>            		
        	</div>    	
        </div>
    </div>
</div>
