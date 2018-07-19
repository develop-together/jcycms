<?php

use yii\helpers\Url;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Backend Menus'), 'url' =>  Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Update') . Yii::t('app', 'Backend Menus')],
];

?>

<?= $this->render('_form', ['model' => $model]) ?>
