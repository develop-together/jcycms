<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use common\widgets\ActiveForm AS BAF;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form common\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">

    <?= "<?php " ?>$form = BAF::begin([
        'action' => ['index'],
        'method' => 'post',
        'options' => ['class' => 'form-inline'],
        'fieldConfig' => [
            'template' =>"{label}\n{input}\n{error}\n{hint}",
            'labelOptions' => ['class' => 'control-label'],                          
        ],
    ]); ?>

<?php
$count = 0;
foreach ($generator->getColumnNames() as $attribute) {
    if (++$count < 6) {
        echo "    <?= " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
    } else {
        echo "    <?php // echo " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
    }
}
?>
    <div class="form-group" style="padding-bottom:10px;">
        <?= "<?= " ?>Html::submitButton('<?= Yii::t('app', 'Search') ?>', ['class' => 'btn btn-primary']) ?>
        <?= "<?= " ?>Html::resetButton('<i class="fa fa-undo"></i> <?= Yii::t('app', 'Clear Query') ?>', ['class' => 'btn btn-default clear-search']) ?>
    </div>

    <?= "<?php " ?>BAF::end(); ?>

</div>
