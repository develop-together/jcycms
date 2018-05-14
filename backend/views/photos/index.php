<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\grid\GridView;
use backend\grid\ActionColumn;
use common\components\BaseConfig;
use backend\models\Article;

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
								[
									'attribute' => 'category_id',
									'enableSorting' => false,
									'value' => function($model) {
										return  $model->category->name;
									},
								],
								[
									'attribute' => 'user_id',
									'enableSorting' => false,
									'value' => function($model) {
										return  $model->user->username;
									},
								],
								'title',
		                        [
		                            'attribute' => 'status',
		                            'format' => 'raw',
		                            'value' => function ($model, $key, $index, $column) {
		                                if ($model->status == Article::ARTICLE_PUBLISHED) {
		                                    $url = Url::to([
		                                        'status',
		                                        'id' => $model->id,
		                                        'status' => 0,
		                                        'field' => 'status'
		                                    ]);
		                                    $class = 'btn btn-info btn-xs btn-rounded';
		                                    $confirm = Yii::t('app', 'Are you sure you want to cancel release?');
		                                } else {
		                                    $url = Url::to([
		                                        'status',
		                                        'id' => $model->id,
		                                        'status' => 1,
		                                        'field' => 'status'
		                                    ]);
		                                    $class = 'btn btn-default btn-xs btn-rounded';
		                                    $confirm = Yii::t('app', 'Are you sure you want to publish?');
		                                }
		                                return Html::a(BaseConfig::getArticleStatus($model->status), $url, [
		                                    'class' => $class,
		                                    'data-confirm' => $confirm,
		                                    'data-method' => 'post',
		                                    'data-pjax' => '0',
		                                ]);

		                            },
		                            'filter' => BaseConfig::getArticleStatus(),
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


