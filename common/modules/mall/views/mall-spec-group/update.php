<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\MallSpecGroup */

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('mall', 'Mall Spec Group'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => Yii::t('app', 'Update') . Yii::t('mall', 'Mall Spec Group')],
];
?>

<?= $this->render('_form', ['model' => $model, 'categoryTree' => $categoryTree]) ?>
