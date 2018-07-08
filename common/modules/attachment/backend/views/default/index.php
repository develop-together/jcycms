<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\grid\GridView;
use backend\grid\ActionColumn;

?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?php //echo $this->render('@backend/views/widgets/_ibox-index-title') ?>
            <div class="ibox-content">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                            'id',
                            [
                                'attribute' => 'filename',
                                'enableSorting' => false,
                                'format' => 'raw',
                                'value' => function($model) {
                                    return $model->fileFormat;
                                }
                            ],
                            [
                                'attribute' => 'fileinfo',
                                'format' => 'raw',
                                'value' => function($model) {
                                    return $model->fileInfoFormat;
                                }
                            ],
                            'filesizecn',   
                            'created_at:datetime',                         
                            [
                                'class' => 'backend\grid\ActionColumn',
                                'template' => '{delete}',
                            ],
                        ]
                    ]); ?>
            </div>
        </div>
    </div>


</div>


