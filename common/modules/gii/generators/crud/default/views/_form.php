<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\ActiveForm AS BAF;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form common\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= '<?='; ?> $this->render('@backend/views/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= "<?php " ?>$form = BAF::begin(); ?>    
                <?php foreach ($generator->getColumnNames() as $attribute) {
                    if (in_array($attribute, $safeAttributes) && !in_array($attribute, ['created_at', 'updated_at'])) {
                ?>
                    <?= "<?= " . $generator->generateActiveField($attribute)."; ?>\n\n"; ?>
                    <div class="hr-line-dashed"></div>
                <?php } } ?>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <?= '<?='; ?> Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        
                        <?= '<?='; ?> Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']);?>                        
                    </div>
                </div>
                <?= "<?php " ?> BAF::end(); ?>            
            </div>
        </div>
    </div>
</div>

