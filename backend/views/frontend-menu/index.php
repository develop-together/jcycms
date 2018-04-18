<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\grid\GridView;
use backend\grid\ActionColumn;

$createSub = function ($url, $model) {
    return Html::a('<i class="fa fa-plus"></i> ' . yii::t('app', 'Create'), Url::toRoute(['frontend-menu/create', 'parent_id' => $model->id]), [
        'title' => 'create',
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
                                'class' => 'yii\grid\CheckboxColumn'
                            ],
                            [
                                'attribute' => 'name',
                                'format' => 'html',
                                'enableSorting' => false,
                                'value' => function($model) {
                                    return $model->nameFormat;
                                }
                            ],
                            [
                                'attribute' => 'icon',
                                'format' => 'html',
                                'enableSorting' => false,
                                'value' => function ($model) {
                                    return $model->iconFormat;
                                }
                            ],
                            [
                                'attribute' =>'url',
                                'enableSorting' => false,
                            ],
                            'sort',
                            [
                                'attribute' => 'is_display',
                                'enableSorting' => false,
                                'value' => function($model) {
                                    return $model->displayFormat;
                                }
                            ],
                            [
                                'attribute' => 'target',
                                'enableSorting' => false,
                            ],
                            'created_at:date',
                            'updated_at:date',
                            [
                                'class' => 'backend\grid\ActionColumn',
                                'template' => '{createSub}{update}{delete}',
                                'buttons' => ['createSub' => $createSub],
                            ],
                        ]
                    ]); ?>
            </div>
        </div>
    </div>


</div>


