<?php

use yii\helpers\Url;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Friendly Links'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Create') . Yii::t('app', 'Friendly Links')],
];

?>

<?= $this->render('_form', ['model' => $model]) ?>
