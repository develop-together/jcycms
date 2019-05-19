<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->title;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Article'), 'url' => Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => $this->title],
];

?>
<style type="text/css" media="screen">
.article-title {
    text-align: center;
    margin: 60px 0 40px 0;
}
</style>
<div class="wrapper wrapper-content  animated fadeInRight article">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox">
                <?= $this->render('/widgets/_ibox-title') ?>
                <div class="ibox-content">
                    <?php if ($model->tagFormat): ?>
                        <div class="pull-right">
                        <?php foreach ($model->tagFormat as $tag): ?>
                            <button class="btn btn-white btn-xs" type="button"><?= $tag ?></button>
                        <?php endforeach ?>
                        </div>
                    <?php endif ?>
                    <div class="text-center article-title">
                        <h1><?= $model->title ?></h1>
                    </div>
                    <?= $model->content ?>
<!--                     <div class="align-content-center modal-content" style="text-indent: 1em">

                     </div> -->
                </div>
            </div>
        </div>
    </div>
</div>


