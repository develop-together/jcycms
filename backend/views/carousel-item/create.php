<?php

use yii\helpers\Url;

$this->params['breadcrumbs'] = [
    ['label' => 'Banner', 'url' => Url::previous('BackendDynamic-list-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Create') . 'Banner'],
];

?>

<?= $this->render('_form', ['model' => $model, 'pid' => $pid]) ?>
