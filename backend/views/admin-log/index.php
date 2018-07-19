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
            <?php //Pjax::begin(['id' => 'adminLog', 'enablePushState' => false]); ?>
                <div class="ibox-content">
                    <div class="mail-tools tooltip-demo m-t-md" style="padding-bottom: 10px;">
                        <?= $this->render('_search', ['model' => $searchModel])?>
                    </div>
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
                </div>
            <?php //Pjax::end(); ?>
        </div>
    </div>


</div>


