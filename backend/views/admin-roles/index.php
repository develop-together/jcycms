<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = yii::t('app', 'Roles');
$assign = function ($url, $model) {
    $url = !empty($url) ? $url : Url::toRoute(['admin-roles/assign', 'id' => $model['id']]);
    return Html::a('<i class="fa fa-tablet"></i> ' . yii::t('app', 'Assign Permission'), $url, [
        'title' => 'assign',
        'class' => 'btn btn-white btn-sm',
    ]);
};
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
                    [
                        'class' => 'backend\grid\ActionColumn',
                        'template' => '{assign}{update}{delete}',
                        'buttons' => ['assign' => $assign],
                    ],
                ],
            ]); ?>                 
             </div>
        </div>
    </div>
</div>
