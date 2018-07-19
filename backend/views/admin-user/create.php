<?php

use yii\helpers\Url;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Administrators'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Create') . Yii::t('app', 'Administrators')],
];

?>
<?= $this->render('_form', [
    'model' => $model,
    'rolesModel' => $rolesModel,
]) ?>
