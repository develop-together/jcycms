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
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <div class="panel-title">
                    <h3><?= $model->title ?></h3>
                </div>
                <div class="align-content-center modal-content" style="text-indent: 1em">
                     <?= $model->content ?> 
                 </div> 
            </div>
        </div>
    </div>
</div>

