<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\grid\GridView;
use backend\grid\ActionColumn;

?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('@backend/views/widgets/_ibox-index-title') ?>
            <div class="ibox-content">
                <div class="mail-tools tooltip-demo m-t-md" style="padding-bottom: 10px;">
                    <?= $this->render('_search', ['model' => $searchModel]) ?>
                </div>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'layout' => '{items}',
                    'columns' => [
                        [
                            'class' => 'yii\grid\CheckboxColumn',
                            'options' => ['style' => 'width:90px'],
                        ],
                        [
                            'attribute' => 'name',
                            'format' => 'html',
                            'options' => ['style' => 'width:180px'],
                            'enableSorting' => false,
                            'value' => function ($model) {
                                return $model->nameFormat;
                            }
                        ],
                        [
                            'attribute' => 'sort',
                            'options' => ['style' => 'width:90px']
                        ],
                        [
                            'attribute' => 'remark',
                            'contentOptions' => [
                            ],
                            'format' => function($value, $formatter) {
                                /* @var \yii\i18n\Formatter $formatter */
                                return \yii\helpers\StringHelper::truncate($value, 32);
                            },
                            'options' => ['style' => 'width:180px']
                        ],
                        [
                            'class' => 'backend\grid\ActionColumn',
                            'width' => '250px',
                            'buttons' => [
                                'add-sub' => function ($url, $model) {
                                    $title = Yii::t('app', 'Add subordinate');
                                    return '<a href="' . Url::to(['create', 'pid' => $model->id]) . '" class="btn  btn-sm btn-white" title="' . $title . '" data-pjax="0"><i class="fa fa-plus"></i> ' . $title . ' </a>';
                                }
                            ],
                            'template' => '{add-sub}{view}{update}{delete}',
                        ],
                    ]
                ]); ?>
            </div>
        </div>
    </div>


</div>


