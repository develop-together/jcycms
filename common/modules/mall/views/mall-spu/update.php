<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\MallSpu */

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Mall Spu'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Update') . Yii::t('app', 'Mall Spu')],
];
?>

<?= $this->render('_form', ['model' => $model]) ?>
