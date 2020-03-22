<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\MallSpecParam */

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('mall', 'Mall Spec Param'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Create') . Yii::t('mall', 'Mall Spec Param')],
];
?>

<?= $this->render('_form', ['model' => $model]) ?>
