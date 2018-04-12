<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\grid\GridView;
use backend\grid\ActionColumn;
use common\components\BaseConfig;

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
								[
									'attribute' => 'title',
									'enableSorting' => false,
								],
								[
									'attribute' => 'thumb',
									'enableSorting' => false,
									'value' => function($model) {
										return $model->thumb ? '有' : '无';
									}
								],
		                        [
		                            'attribute' => 'flag_headline',
		                            'format' => 'raw',
		                            'value' => function ($model, $key, $index, $column) {
		                                if ($model->flag_headline) {
		                                    $url = Url::to([
		                                        'status',
		                                        'id' => $model->id,
		                                        'status' => 0,
		                                        'field' => 'flag_headline'
		                                    ]);
		                                    $class = 'btn btn-info btn-xs btn-rounded';
		                                    $confirm = Yii::t('app', 'Are you sure you want to disable this item?');
		                                } else {
		                                    $url = Url::to([
		                                        'status',
		                                        'id' => $model->id,
		                                        'status' => 1,
		                                        'field' => 'flag_headline'
		                                    ]);
		                                    $class = 'btn btn-default btn-xs btn-rounded';
		                                    $confirm = Yii::t('app', 'Are you sure you want to enable this item?');
		                                }
		                                return Html::a(BaseConfig::getYesNoItems($model->flag_headline), $url, [
		                                    'class' => $class,
		                                    'data-confirm' => $confirm,
		                                    'data-method' => 'post',
		                                    'data-pjax' => '0',
		                                ]);
		                            },
		                        ],
								// 'status',
								// 'sort',
								// 'user_id',
								// 'scan_count',
								// 'can_comment',
								// 'visibility',
								// 'tag',
								// 'flag_headline',
								// 'flag_recommend',
								// 'flag_slide_show',
								// 'flag_special_recommend',
								// 'flag_roll',
								// 'flag_bold',
								// 'flag_picture',
								// 'created_at',
								// 'updated_at',
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


