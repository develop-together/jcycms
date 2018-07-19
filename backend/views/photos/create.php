<?php

use yii\helpers\Url;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Photos'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Create') . Yii::t('app', 'Photos')],
];

?>

<?= $this->render('_form', ['model' => $model]) ?>
