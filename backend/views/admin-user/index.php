<?php

use yii\helpers\Html;
use backend\grid\GridView;
use backend\models\User;
use backend\grid\ActionColumn;
use yii\helpers\Url;

$this->title = 'Admin';
$assignment = function ($url, $model) {
    return Html::a('<i class="fa fa-tablet"></i> ' . yii::t('app', 'Assign Roles'), Url::to([
        'assign',
        'uid' => $model['id']
    ]), [
        'title' => 'assignment',
        'class' => 'btn btn-white btn-sm'
    ]);
};
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
                                'class' => '\yii\grid\CheckboxColumn',
                            ],
                            [
                                'attribute' => 'username',
                                'filter' => '',
                            ],
                            [
                                'attribute' => 'email',
                                'format' => 'email',
                                'filter' => '',
                            ],
                            [
                                    'attribute' => 'status',
                                    'filter' => '',//User::loadStatusOptions()
                                    'value' => function ($model) {
                                        return $model->statusFormat;
                                    },
                                    'enableSorting' => true,
                            ],
                            [
                                    'attribute' => 'created_at',
                                    'format' => 'datetime',
                                    'filter' => '',
                            ],

                            [
                                'class' => ActionColumn::className(),
                                'template' => '{assignment}{view}{update}{delete}',
                                'buttons' => ['assignment' => $assignment],
                            ],
                        ],
                    ]); ?>         
            </div>            
        </div>
    </div>
</div>
