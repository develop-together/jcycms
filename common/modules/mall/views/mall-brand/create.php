<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\MallBrand */

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Mall Brand'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Create') . Yii::t('app', 'Mall Brand')],
];
?>

<?= $this->render('_form', ['model' => $model]) ?>
