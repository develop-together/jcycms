<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminRoles */

$this->title = $model->role_name;

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
                        'role_name',
                        'remark',
                        'created_at',
                    ],
                ]) ?>               
            </div>      
        </div>
    </div>
</div>
