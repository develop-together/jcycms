<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->id;
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Collect Task'), 'url' =>  Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
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
                        [
                            'attribute' => 'user_id',
                            'value' => function($model) {
                                return $model->user->username;
                            }
                        ],
                        'name',
                        [
                            'attribute' => 'status',
                            'value' => function($model) {
                                return $model->getStatusFormat();
                            }
                        ],
                        'url:url',
                        'rule',
                        'created_at:datetime',
                        'updated_at:datetime',
                    ],
]) ?>  
            </div>
        </div>
    </div>
</div>

