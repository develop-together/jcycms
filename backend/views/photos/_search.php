<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm AS BAF;
use common\models\Category;
use common\components\Utils;

/* @var $this yii\web\View */
/* @var $model backend\models\Search\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
$categoryTree = Utils::reference_delivery_tree(Category::find()->asArray()->all(), 'id', 'parent_id');

?>

<div class="article-search">

    <?php $form = BAF::begin([
        'action' => ['index'],
        'method' => 'post',
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <?= $form->field($model, 'category_id')->dropDownList(Category::getDrowDownList($categoryTree), ['prompt' => '请选择', 'style' => 'width:200px']) ?>

    <?= $form->field($model, 'title') ?>

    <div class="form-group" style="padding-bottom:10px;">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('<i class="fa fa-undo"></i>' . Yii::t('app', 'Clear Query'), ['class' => 'btn btn-default clear-search']) ?>
    </div>

    <?php BAF::end(); ?>

</div>
