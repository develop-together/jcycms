<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\CollectTask */

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Collect Task'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Update') . Yii::t('app', 'Collect Task')],
];
?>

<?= $this->render('_form', ['model' => $model]) ?>
