<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->caption;

$this->params['breadcrumbs'] = [
    ['label' => 'Banner', 'url' => Url::previous('BackendDynamic-list-' . Yii::$app->controller->id)],
    ['label' => $this->title],
];

?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title', ['pid' => $model->carousel_id]) ?>
            <div class="ibox-content">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        [
                            'attribute' => 'carousel_id',
                            'value' => function($model) {
                                return $model->carousel->title;
                            }
                        ],
                        'url',
                        'caption',
                        [
                            'attribute' => 'image',
                            'format' => 'raw',
                            'value' => function($model) {
                                return $model->image('image', ['width' => 200, 'height' => 100]);
                            }
                        ],                        
                        [
                            'attribute' => 'status',
                            'value' => function($model) {
                                return $model->statusFormat;
                            }
                        ],
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

