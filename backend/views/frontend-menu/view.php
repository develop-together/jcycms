<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->name;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Role'), 'url' =>  Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
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
                        'type',
                        'name',
                        'url',
                        'icon',
                        'sort',
                        'target',
                        'is_absolute_url:url',
                        'is_display',
                        'method',
                        'created_at',
                        'updated_at',
                    ],
]) ?>  
            </div>
        </div>
    </div>
</div>

