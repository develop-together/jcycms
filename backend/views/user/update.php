<?php

use yii\helpers\Url;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Frontend Users'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Update') . Yii::t('app', 'Frontend Users')],
];

?>

<?= $this->render('_form', ['model' => $model]) ?>
