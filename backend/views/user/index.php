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
                    <?= $this->render('_search', ['model' => $searchModel])?>
                </div>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                                [
                                    'class' => 'yii\grid\CheckboxColumn'
                                ],
                                'id',
								'username',
                                [
                                    'attribute' => 'avatar',
                                    'format' => 'raw',
                                    'value' => function($model) {
                                        return Html::img($model->getAvatarFormat(), ['width' => '100' , 'height' => '100']);
                                    },
                                    'options' => ['width' => '100' , 'height' => '100'],
                                    'filter' => '',
                                    'enableSorting' => false,
                                ],
								'email:email',
								[
                                    'attribute' => 'status',
                                    'value' => function($model) {
                                        return $model->statusFormat;
                                    }
                                ],
								[
                                    'attribute' => 'login_count',
                                    'enableSorting' => false,
                                    'filter' => '',
                                    'value' => function($model) {
                                        return $model->login_count . '次';
                                    }
                                ],
								[
                                    'attribute' => 'last_login_ip',
                                    'enableSorting' => false,
                                ],
                                [
                                    'attribute' => 'last_login_at',
                                    'value' => function($model) {
                                        return $model->last_login_at ? date('Y-m-d H:i:s', $model->last_login_at) : '';
                                    }
                                ],
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


