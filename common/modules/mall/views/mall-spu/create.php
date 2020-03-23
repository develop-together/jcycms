<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\MallSpu */

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('mall', 'Goods'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Create') . Yii::t('mall', 'Goods')],
];
?>

<?= $this->render('_form', ['model' => $model]) ?>
