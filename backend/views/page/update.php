<?php

use yii\helpers\Url;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Pages'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Update') . Yii::t('app', 'Pages')],
];

?>

<?= $this->render('_form', ['model' => $model]) ?>
