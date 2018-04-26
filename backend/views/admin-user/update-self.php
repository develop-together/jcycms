<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\AdminRoles;
use backend\models\User;
use common\widgets\fileUploadInput\FileUploadInputWidget;
$this->title = $model->username;

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

                <?= $form->field($model, 'username')->textInput(['maxlength' => 64, 'readonly' => true, 'disabled' => true]) ?>

                <div class="hr-line-dashed"></div>

                <?= $form->field($model, 'avatar')->widget(FileUploadInputWidget::className(),[
                    'type' => 'image'
                ]); ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => 64]) ?>

                <div class="hr-line-dashed"></div>

                <?= $form->field($model, 'password')->passwordInput(['maxlength' => 512, 'placeholder' => Yii::t('app', 'Not to fill, by default do not modify')]) ?>

                <div class="hr-line-dashed"></div>

			    <div class="form-group">
			    	<div class="col-sm-4 col-sm-offset-2">
			        	<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>

			        	<?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']);?>   			    		
			    	</div>
			    </div>

			    <?php ActiveForm::end(); ?>            		
        	</div>    	
        </div>
    </div>
</div>
