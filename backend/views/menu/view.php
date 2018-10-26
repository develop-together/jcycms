<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->name;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Backend Menus'), 'url' =>  Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
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
                        'name',
                        [
                            'attribute' => 'url',
                            'value' => $model->urlFormat,
                        ],
                        [
                            'attribute' => 'icon',
                            'format' => 'html',
                            'value' => $model->iconFormat,
                        ],
                        'target',
                        [
                            'attribute' =>  'is_absolute_url',
                            'value' => $model->absoluteUrlFormat,
                        ],
                        [
                            'attribute' => 'is_display',
                            'value' => $model->displayFormat,
                        ],
                        [
                            'attribute' => 'method',
                            'value' => $model->methodFormat,
                        ],
                        'created_at:datetime',
                        'updated_at:datetime',
                        'subMenus_format:raw',
                    ],
]) ?>  
            </div>
        </div>
    </div>
</div>

