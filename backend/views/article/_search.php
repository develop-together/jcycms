<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm AS BAF;

/* @var $this yii\web\View */
/* @var $model backend\models\search\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = BAF::begin([
        'action' => ['index'],
        'method' => 'post',
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'sub_title') ?>

    <?php // echo $form->field($model, 'summary') ?>

    <?php // echo $form->field($model, 'thumb') ?>

    <?php // echo $form->field($model, 'seo_title') ?>

    <?php // echo $form->field($model, 'seo_keywords') ?>

    <?php // echo $form->field($model, 'seo_description') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'scan_count') ?>

    <?php // echo $form->field($model, 'can_comment') ?>

    <?php // echo $form->field($model, 'visibility') ?>

    <?php // echo $form->field($model, 'tag') ?>

    <?php // echo $form->field($model, 'flag_headline') ?>

    <?php // echo $form->field($model, 'flag_recommend') ?>

    <?php // echo $form->field($model, 'flag_slide_show') ?>

    <?php // echo $form->field($model, 'flag_special_recommend') ?>

    <?php // echo $form->field($model, 'flag_roll') ?>

    <?php // echo $form->field($model, 'flag_bold') ?>

    <?php // echo $form->field($model, 'flag_picture') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php BAF::end(); ?>

</div>
