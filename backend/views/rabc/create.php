<?php

use yii\helpers\Url;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Permission'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Create') . Yii::t('app', 'Permission')],
];

?>

<?= $this->render('_form', ['model' => $model, 'pid' => isset($pid) ? $pid : '']) ?>
