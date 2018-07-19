<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->name;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'AD'), 'url' =>  Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
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
                        [
                            'attribute' => 'name',
                            'enableSorting' => false,
                        ],
                        [
                            'attribute' => 'input_type',
                            'value' => function($model) {
                                return $model->adTypeFormat;
                            }
                        ],
                        [
                            'attribute' => 'imgUrl',
                            'format' => 'raw',
                            'value' => function($model) {
                                return $model->imgFormat;
                            }
                        ],
                        'url',
                        'description',
                        [
                            'attribute' => 'status',
                            'value' => function($model) {
                                return $model->statusFormat;
                            }
                        ],
                        'sort',
                        'created_at:datetime',
                        'updated_at:datetime',
                    ],
]) ?>  
            </div>
        </div>
    </div>
</div>

