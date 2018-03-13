<?php

use yii\helpers\Html;
use backend\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = yii::t('app', 'Roles');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-index-title') ?>
             <div class="ibox-content">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'class' => '\yii\grid\CheckboxColumn',
                    ],                    
                    'role_name',
                    'remark',
                    'created_at:datetime',
                    ['class' => 'backend\grid\ActionColumn'],
                ],
            ]); ?>                 
             </div>
        </div>
    </div>
</div>