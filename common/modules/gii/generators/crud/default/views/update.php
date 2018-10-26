<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', '<?=Inflector::camel2words(StringHelper::basename($generator->modelClass))?>'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Update') . Yii::t('app', '<?=Inflector::camel2words(StringHelper::basename($generator->modelClass))?>')],
];
?>

<?= "<?= " ?>$this->render('_form', ['model' => $model]) ?>
