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
                                    'value' => function($model) {
                                        return $model->nameFormat;
                                    }
                                ],
								[
                                    'attribute' => 'icon',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        return "<i class=\"fa {$model->icon}\"></i>";
                                    }
                                ],
								'url:url',
								'sort',
                                [
                                    'attribute' => 'method',
                                    'value' => function($model) {
                                        return $model->methodFormat;
                                    }
                                ],
                                [
                                    'attribute' => 'is_display',
                                    'value' => function($model) {
                                        return $model->displayFormat;
                                    }
                                ],
								'target',
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


