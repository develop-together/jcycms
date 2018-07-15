<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\grid\GridView;
use backend\grid\ActionColumn;

$this->title = Yii::t('app', 'Permission Manage');
?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <div class="ibox-title">
                <div class="mail-tools tooltip-demo m-t-md">
                    <a href="<?=Url::toRoute(['refresh'])?>" class="btn btn-primary btn-sm refresh" title="<?= Yii::t('app', 'Refresh');?>" data-pjax="0">
                        <i class="fa fa-refresh"></i> <?= Yii::t('app', 'Refresh');?>
                    </a>
                    <a href="<?=Url::toRoute(['create', 'pid' => $menuId])?>" class="btn  btn-sm btn-success" title="<?= Yii::t('app', 'Create');?>" data-pjax="0">
                        <i class="fa fa-plus"></i> <?= Yii::t('app', 'Create');?>
                    </a>   
                    <a href="<?=Url::toRoute(['delete'])?>" data-confirm="<?= yii::t('app', 'Realy to delete?')?>" class="btn btn-danger btn-sm multi-operate" title="<?= Yii::t('app', 'BatchDelete');?>" data-pjax="0">
                        <i class="fa fa-trash-o" ></i> <?= Yii::t('app', 'BatchDelete');?>
                    </a>        
                    <div class="pull-right" style="padding-top: 6px">                     
                        <?= Html::a(Yii::t('app', 'Back'),  Url::to(['menu/index']), ['class' => 'btn btn-primary btn-xs']) ?>
                        <span><?= $this->title ?></span>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                    <div class="mail-tools tooltip-demo m-t-md" style="padding-bottom: 10px;">
                        <?= (isset($searchModel)) ? $this->render('_search', ['model' => $searchModel]) : '' ?>
                    </div>     

                    <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                             'columns' => [
                                    [
                                        'class' => 'yii\grid\CheckboxColumn'
                                    ],
                                    'id',
    								[
                                        'attribute' => 'menu_id',
                                        'enableSorting' => false,
                                        'value' => function($model) {
                                            return $model->menuFormat;
                                        }
                                    ],
    								[
                                        'attribute' => 'rule_name',
                                        'enableSorting' => false,
                                    ],
                                    [
                                        'attribute' => 'method',
                                        'enableSorting' => false,
                                    ],
    								[
                                        'attribute' => 'description',
                                        'format' => 'ntext',
                                        'enableSorting' => false,
                                    ],
                                    'sort',
    								'created_at:datetime',
    								'updated_at:datetime',
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


