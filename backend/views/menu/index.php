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
                        'layout' => '{items}',
                        'columns' => [
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
                                    'class' => ActionColumn::className(),
                                    'options' => ['width' => 400],
                                    'buttons' => [
                                        'rabc' => function($url, $model, $key) {
                                            if ($model->isCorrect) {
                                                return '';
                                            }
                                            
                                            return Html::a('<i class="fa fa-bars" aria-hidden="true"></i> ' . Yii::t('app', 'Permission Manage'), Url::toRoute(['rabc/list', 'id' => $model->id]), ['class' => 'btn btn-white btn-sm ']); 
                                        },
/*                                        'create' => function($url, $model, $key) {
                                            return Html::a('<i class="fa fa-bars" aria-hidden="true"></i> ' . Yii::t('app', 'Create'), Url::toRoute(['menu/create-children', 'id' => $model->id]), ['class' => 'btn btn-white btn-sm']);  
                                        }*/
                                    ],
                                    'template' => '{rabc}{create}{update}{delete}{view}',
                                ],
                            ]
                        ]); ?>
                            </div>
        </div>
    </div>


</div>


