<?php

use yii\helpers\Url;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Banner'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Create') . Yii::t('app', 'Banner')],
];

?>

<?= $this->render('_form', ['model' => $model]) ?>
