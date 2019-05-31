<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\ActiveForm AS BAF;

?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <div class="ibox-content">
                <?php $form = BAF::begin(); ?>
                    <?= $form->field($model, 'status')->radioList($model->getCommentStatusItems(null, true)); ?>
<!--                     <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <?php //echo Html::submitButton(Yii::t('app', 'Verify') , ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                            <?php //echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']);?>
                        </div>
                </div> -->
                <?php  BAF::end(); ?>
            </div>
        </div>
    </div>
</div>

