<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->description;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Permission'), 'url' =>  Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
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
                            'attribute' => 'menu_id',
                            'enableSorting' => false,
                            'value' => function($model) {
                                return $model->menuFormat;
                            }
                        ],
                        'rule_format',
                        'description:ntext',
                        'created_at:datetime',
                        'updated_at:datetime',
                    ],
]) ?>  
            </div>
        </div>
    </div>
</div>

