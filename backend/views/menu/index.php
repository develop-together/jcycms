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
								[
                                    'attribute' => 'name',
                                    'format' => 'html',
                                    'enableSorting' => false,
                                    'value' => function($model) {
                                        return $model->nameFormat;
                                    }
                                ],
								[
                                    'attribute' => 'icon',
                                    'format' => 'html',
                                    'enableSorting' => false,
                                    'value' => function ($model) {
                                        return $model->iconFormat;
                                    }
                                ],
                                [
                                    'attribute' =>'url',
                                    'value' => function($model) {
                                        return $model->urlFormat;
                                    },
                                    'enableSorting' => false,
                                ],
								'sort',
                                [
                                    'attribute' => 'method',
                                    'enableSorting' => false,
                                    'value' => function($model) {
                                        return $model->methodFormat;
                                    }
                                ],
                                [
                                    'attribute' => 'is_display',
                                    'enableSorting' => false,
                                    'value' => function($model) {
                                        return $model->displayFormat;
                                    }
                                ],
								[
                                    'attribute' => 'target',
                                    'enableSorting' => false,
                                ],
								'created_at:date',
								'updated_at:date',
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


