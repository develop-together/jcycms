<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->title;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Friendly Links'), 'url' =>  Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => $this->title],
];

?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
            'name',
            'image',
            'url:url',
            'target',
            'sort',
            'status',
            'created_at',
            'updated_at',
                    ],
]) ?>  
            </div>
        </div>
    </div>
</div>

