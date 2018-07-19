<?php

use yii\helpers\Url;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Frontend Menus'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Update') . Yii::t('app', 'Frontend Menus')],
];

?>

<?= $this->render('_form', ['model' => $model]) ?>
