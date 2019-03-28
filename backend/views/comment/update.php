<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Comment'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Update') . Yii::t('app', 'Comment')],
];
?>

<?= $this->render('_form', ['model' => $model]) ?>
