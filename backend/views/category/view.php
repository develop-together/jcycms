<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->name;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Category'), 'url' =>  Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
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
                            'attribute' => 'parent_id',
                            'value' => @$model->parent->name,
                        ],
                        'name',
                        'sort',
                        'remark',
                        'created_at:datetime',
                        'updated_at:datetime',
                    ],
]) ?>  
            </div>
        </div>
    </div>
</div>

