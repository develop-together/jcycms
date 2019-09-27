<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\grid\GridView;
use backend\grid\ActionColumn;

?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-index-title') ?>
            <div class="ibox-content">
                <div class="mail-tools tooltip-demo m-t-md" style="padding-bottom: 10px;">
                    <?= $this->render('_search', ['model' => $searchModel]) ?>
                </div>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        [
                            'class' => 'yii\grid\CheckboxColumn'
                        ],
                        'id',
                        'key',
                        [
                            'attribute' => 'title',
                            'enableSorting' => false,
                        ],
                        [
                            'attribute' => 'image-list',
                            'format' => 'raw',
                            'enableSorting' => false,
                            'value' => function ($model) {
                                return $model->layerPhotos;
                            }
                        ],
                        [
                            'attribute' => 'status',
                            'value' => function ($model) {
                                return $model->statusFormat;
                            }
                        ],
                        [
                            'class' => 'backend\grid\ActionColumn',
                            'buttons' => [
                                'entry' => function ($url, $model, $key) {
                                    return Html::a('<i class="fa fa-bars" aria-hidden="true"></i> ' . Yii::t('app', 'Entry'), Url::toRoute(['carousel-item/list', 'id' => $model->id]), ['class' => 'btn btn-white btn-sm']);
                                }
                            ],
                            'template' => '{entry}{update}{delete}',
                        ],
                    ]
                ]); ?>
            </div>
        </div>
    </div>


</div>


