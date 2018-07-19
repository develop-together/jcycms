<?php

use yii\helpers\Url;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Banner'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Update') . Yii::t('app', 'Banner')],
];

?>

<?= $this->render('_form', ['model' => $model]) ?>
