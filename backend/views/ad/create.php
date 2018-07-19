<?php 

use yii\helpers\Url;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'AD'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Create') . Yii::t('app', 'AD')],
];

?>

<?= $this->render('_form', ['model' => $model]) ?>
