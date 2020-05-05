<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\grid\GridView;
use backend\grid\ActionColumn;

?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('@backend/views//widgets/_ibox-index-title') ?>
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
                        'name',
                        [
                            'attribute' => 'group_id',
                            'value' => 'group.name',
                        ],
                        [
                            'attribute' => 'cid',
                            'value' => 'category.name',
                        ],
                        [
                            'attribute' => 'data_type',
                            'value' => function ($model) {
                                return $model->dataTypeFormat;
                            },
                        ],
                        [
                            'attribute' => 'segments',
                            'value' => function ($model) {
                                return $model->getIsSelectDis() ? '' : $model->segments;
                            },
                        ],
                         'unit',
                        [
                            'attribute' => 'generic',
                            'value' => function ($model) {
                                return $model->genericFormat;
                            },
                        ],
                        [
                            'attribute' => 'searching',
                            'value' => function ($model) {
                                return $model->searchingFormat;
                            },
                        ],
                         'sort',
                        'created_at:datetime',
                        'updated_at:datetime',
                        [
                            'class' => 'backend\grid\ActionColumn',
                            'template' => '{update}{delete}',
                        ],
                    ]
                ]); ?>
            </div>
        </div>
    </div>
</div>


