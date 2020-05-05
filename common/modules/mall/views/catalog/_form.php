<?php

use yii\helpers\Html;
use common\models\MallCategory;
use yii\widgets\ActiveForm AS BAF;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */

$categoryTree = MallCategory::loadDataTree();
?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('@backend/views/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?php $form = BAF::begin([
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-sm-10\">{input}\n{error}</div>\n{hint}",
                        'labelOptions' => ['class' => 'col-sm-2 control-label'],
                        'options' => ['class' => 'form-group'],
                        'inputOptions' => ['class' => 'form-control'],
                        'errorOptions' => ['class' => 'help-block m-b-none'],
                    ],
                    'options' => ['class' => 'form-horizontal'],
                ]); ?>

                <?= $form->field($model, 'parent_id')->dropDownList(MallCategory::getDrowDownList($categoryTree), ['prompt' => '请选择', 'disabled' => $model->isNewRecord && $model->parent_id ? true : false]) ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'sort')->textInput(['maxlength' => true]); ?>
                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'remark')->textarea(['style' => 'min-height:160px;']); ?>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']); ?>
                    </div>
                </div>
                <?php BAF::end(); ?>
            </div>
        </div>
    </div>
</div>

