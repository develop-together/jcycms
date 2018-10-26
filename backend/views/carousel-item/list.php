<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\grid\GridView;
use backend\grid\ActionColumn;

$this->title = 'Item';

?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <div class="ibox-title">
                <div class="mail-tools tooltip-demo m-t-md">
                    <a href="<?=Url::toRoute(['refresh'])?>" class="btn btn-primary btn-sm refresh" title="<?= Yii::t('app', 'Refresh');?>" data-pjax="0">
                        <i class="fa fa-refresh"></i> <?= Yii::t('app', 'Refresh');?>
                    </a>
                    <a href="<?=Url::toRoute(['create', 'pid' => $id])?>" class="btn  btn-sm btn-success" title="<?= Yii::t('app', 'Create');?>" data-pjax="0">
                        <i class="fa fa-plus"></i> <?= Yii::t('app', 'Create');?>
                    </a>   
                    <a href="<?=Url::toRoute(['delete'])?>" data-confirm="<?= Yii::t('app', 'Realy to delete?')?>" class="btn btn-danger btn-sm multi-operate" title="<?= Yii::t('app', 'BatchDelete');?>" data-pjax="0">
                        <i class="fa fa-trash-o" ></i> <?= Yii::t('app', 'BatchDelete');?>
                    </a>        
                    <div class="pull-right" style="padding-top: 6px"><?= Html::a(Yii::t('app', 'Back'),  Url::to(['carousel/index']), ['class' => 'btn btn-primary btn-xs']) ?></div>
                </div>
            </div>
            <div class="ibox-content">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                            [
                                'class' => 'yii\grid\CheckboxColumn'
                            ],
                            'id',
                            [
                                'attribute' => 'caption',
                                'enableSorting' => false,
                            ],
                            [
                                'attribute' => 'url',
                                'enableSorting' => false,
                            ],
                            [
                                'attribute' => 'image',
                                'enableSorting' => false,
                                'format' => 'html',
                                'value' => function($model) {
                                    return $model->image('image', ['width' => 200, 'height' => 100]);
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function($model) {
                                    return $model->statusFormat;
                                }
                            ],
                            [
                                'class' => 'backend\grid\ActionColumn',
                                'template' => '{view}{update}{delete}',
                            ],
                        ]
                    ]); ?>
            </div>
        </div>
    </div>


</div>


