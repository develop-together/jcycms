<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->id;
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Mall Spec Group'), 'url' =>  Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
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
            'cid',
            'name',
            'created_at',
            'updated_at',
                    ],
]) ?>  
            </div>
        </div>
    </div>
</div>

