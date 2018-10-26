<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$this->title = $model->username;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Administrators'), 'url' =>  Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
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
                        'username',
                        'email:email',
                        [
                            'attribute' => 'avatar',
                            'format' => 'raw',
                            'value' => function($model) {
                                return Html::img($model->getAvatarFormat(), ['width' => 100, 'height' => 100]);
                            }
                        ],
                        [
                                'attribute' => 'status',
                                'filter' => '',//User::loadStatusOptions()
                                'value' => function ($model) {
                                    return $model->statusFormat;
                                },
                                'enableSorting' => true,
                        ],
                        'created_at',
                        'updated_at',
                    ],
                ]) ?>                 
            </div>      
        </div>
    </div>
</div>

