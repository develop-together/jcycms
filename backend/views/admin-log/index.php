<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\grid\GridView;
use backend\grid\ActionColumn;
use yii\widgets\Pjax;

?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <div class="ibox-content">
                <div class="mail-tools tooltip-demo m-t-md" style="padding-bottom: 10px;">
                    <?= $this->render('_search', ['model' => $searchModel])?>
                </div>
                <?php Pjax::begin(['id' => 'adminLog-pjax', 'enablePushState' => false, 'options' => ['class' => 'pjax-reload']]); ?>
                    <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                            [
                                'class' => 'yii\grid\CheckboxColumn'
                            ],
                            'id',
							[
                                'attribute' => 'user_id',
                                'value' => function($model) {
                                    return $model->user->username;
                                }
                            ],
							'route',
							'description:raw',
							'created_at:datetime',
                            [
                                'class' => 'backend\grid\ActionColumn',
                                'template' => '{view}{delete}',
                            ],
                        ]
                    ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>



