<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\grid\GridView;
use backend\grid\ActionColumn;
use common\components\BaseConfig;
use backend\models\Article;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Article');

?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-index-title') ?>
            <div class="ibox-content">
                <div class="mail-tools tooltip-demo m-t-md" style="padding-bottom: 10px;">
                    <?= $this->render('_search', ['model' => $searchModel])?>
                </div>
                <?php Pjax::begin(['id' => 'article-pjax', 'enablePushState' => false, 'options' => ['class' => 'pjax-reload']]); ?>
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
											return  $model->catename;
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
			                            'format' => 'html',
			                            'enableSorting' => false,
			                            'value' => function ($model, $key, $index, $column) {
			                                return Html::a($model->title, 'javascript:void(0)', [
			                                    'title' => $model->thumb ? Yii::$app->request->baseUrl . '/' . $model->thumb : '',
			                                    'class' => 'title'
			                                ]);
			                            }
			                        ],
                                    'scan_count',
                                    'can_comment'
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
			                        [
			                            'attribute' => 'flag_recommend',
			                            'format' => 'raw',
			                            'value' => function ($model, $key, $index, $column) {
			                                if ($model->flag_recommend) {
			                                    $url = Url::to([
			                                        'status',
			                                        'id' => $model->id,
			                                        'status' => 0,
			                                        'field' => 'flag_recommend'
			                                    ]);
			                                    $class = 'btn btn-info btn-xs btn-rounded';
			                                    $confirm = Yii::t('app', 'Are you sure you want to disable this item?');
			                                } else {
			                                    $url = Url::to([
			                                        'status',
			                                        'id' => $model->id,
			                                        'status' => 1,
			                                        'field' => 'flag_recommend'
			                                    ]);
			                                    $class = 'btn btn-default btn-xs btn-rounded';
			                                    $confirm = Yii::t('app', 'Are you sure you want to enable this item?');
			                                }
			                                
			                                return Html::a(BaseConfig::getYesNoItems($model->flag_recommend), $url, [
			                                    'class' => $class,
			                                    'data-confirm' => $confirm,
			                                    'data-method' => 'post',
			                                    'data-pjax' => '0',
			                                ]);
			                            },
			                        ],
			                        [
			                            'attribute' => 'flag_slide_show',
			                            'format' => 'raw',
			                            'value' => function ($model, $key, $index, $column) {
			                                if ($model->flag_slide_show) {
			                                    $url = Url::to([
			                                        'status',
			                                        'id' => $model->id,
			                                        'status' => 0,
			                                        'field' => 'flag_slide_show'
			                                    ]);
			                                    $class = 'btn btn-info btn-xs btn-rounded';
			                                    $confirm = Yii::t('app', 'Are you sure you want to disable this item?');
			                                } else {
			                                    $url = Url::to([
			                                        'status',
			                                        'id' => $model->id,
			                                        'status' => 1,
			                                        'field' => 'flag_slide_show'
			                                    ]);
			                                    $class = 'btn btn-default btn-xs btn-rounded';
			                                    $confirm = Yii::t('app', 'Are you sure you want to enable this item?');
			                                }
			                                
			                                return Html::a(BaseConfig::getYesNoItems($model->flag_slide_show), $url, [
			                                    'class' => $class,
			                                    'data-confirm' => $confirm,
			                                    'data-method' => 'post',
			                                    'data-pjax' => '0',
			                                ]);
			                            },
			                        ],
			                        [
			                            'attribute' => 'flag_special_recommend',
			                            'filter' => BaseConfig::getYesNoItems(),
			                            'format' => 'raw',
			                            'value' => function ($model, $key, $index, $column) {
			                                if ($model->flag_special_recommend) {
			                                    $url = Url::to([
			                                        'status',
			                                        'id' => $model->id,
			                                        'status' => 0,
			                                        'field' => 'flag_special_recommend'
			                                    ]);
			                                    $class = 'btn btn-info btn-xs btn-rounded';
			                                    $confirm = Yii::t('app', 'Are you sure you want to disable this item?');
			                                } else {
			                                    $url = Url::to([
			                                        'status',
			                                        'id' => $model->id,
			                                        'status' => 1,
			                                        'field' => 'flag_special_recommend'
			                                    ]);
			                                    $class = 'btn btn-default btn-xs btn-rounded';
			                                    $confirm = Yii::t('app', 'Are you sure you want to enable this item?');
			                                }
			                                return Html::a(BaseConfig::getYesNoItems($model->flag_special_recommend), $url, [
			                                    'class' => $class,
			                                    'data-confirm' => $confirm,
			                                    'data-method' => 'post',
			                                    'data-pjax' => '0',
			                                ]);
			                            },
			                        ],
			                        [
			                            'attribute' => 'flag_roll',
			                            'filter' => BaseConfig::getYesNoItems(),
			                            'format' => 'raw',
			                            'value' => function ($model, $key, $index, $column) {
			                                if ($model->flag_roll) {
			                                    $url = Url::to([
			                                        'status',
			                                        'id' => $model->id,
			                                        'status' => 0,
			                                        'field' => 'flag_roll'
			                                    ]);
			                                    $class = 'btn btn-info btn-xs btn-rounded';
			                                    $confirm = Yii::t('app', 'Are you sure you want to disable this item?');
			                                } else {
			                                    $url = Url::to([
			                                        'status',
			                                        'id' => $model->id,
			                                        'status' => 1,
			                                        'field' => 'flag_roll'
			                                    ]);
			                                    $class = 'btn btn-default btn-xs btn-rounded';
			                                    $confirm = Yii::t('app', 'Are you sure you want to enable this item?');
			                                }
			                                return Html::a(BaseConfig::getYesNoItems($model->flag_roll), $url, [
			                                    'class' => $class,
			                                    'data-confirm' => $confirm,
			                                    'data-method' => 'post',
			                                    'data-pjax' => '0',
			                                ]);
			                            },
			                        ],
			                        [
			                            'attribute' => 'flag_bold',
			                            'filter' => BaseConfig::getYesNoItems(),
			                            'format' => 'raw',
			                            'value' => function ($model, $key, $index, $column) {
			                                if ($model->flag_bold) {
			                                    $url = Url::to([
			                                        'status',
			                                        'id' => $model->id,
			                                        'status' => 0,
			                                        'field' => 'flag_bold'
			                                    ]);
			                                    $class = 'btn btn-info btn-xs btn-rounded';
			                                    $confirm = Yii::t('app', 'Are you sure you want to disable this item?');
			                                } else {
			                                    $url = Url::to([
			                                        'status',
			                                        'id' => $model->id,
			                                        'status' => 1,
			                                        'field' => 'flag_bold'
			                                    ]);
			                                    $class = 'btn btn-default btn-xs btn-rounded';
			                                    $confirm = Yii::t('app', 'Are you sure you want to enable this item?');
			                                }
			                                return Html::a(BaseConfig::getYesNoItems($model->flag_bold), $url, [
			                                    'class' => $class,
			                                    'data-confirm' => $confirm,
			                                    'data-method' => 'post',
			                                    'data-pjax' => '0',
			                                ]);
			                            },
			                        ],
			                        [
			                            'attribute' => 'flag_picture',
			                            'filter' => BaseConfig::getYesNoItems(),
			                            'format' => 'raw',
			                            'value' => function ($model, $key, $index, $column) {
			                                if ($model->flag_picture) {
			                                    $url = Url::to([
			                                        'status',
			                                        'id' => $model->id,
			                                        'status' => 0,
			                                        'field' => 'flag_picture'
			                                    ]);
			                                    $class = 'btn btn-info btn-xs btn-rounded';
			                                    $confirm = Yii::t('app', 'Are you sure you want to disable this item?');
			                                } else {
			                                    $url = Url::to([
			                                        'status',
			                                        'id' => $model->id,
			                                        'status' => 1,
			                                        'field' => 'flag_picture'
			                                    ]);
			                                    $class = 'btn btn-default btn-xs btn-rounded';
			                                    $confirm = Yii::t('app', 'Are you sure you want to enable this item?');
			                                }
			                                return Html::a(BaseConfig::getYesNoItems($model->flag_picture), $url, [
			                                    'class' => $class,
			                                    'data-confirm' => $confirm,
			                                    'data-method' => 'post',
			                                    'data-pjax' => '0',
			                                ]);
			                            },
			                        ],
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
                <?php Pjax::end(); ?>
            </div>
       	</div>
    </div>
</div>
<?php 
// $noPic = Yii::t('app', 'No picture');
// $this->registerJs(<<<EOT
// 	var timer;
//     $('table tr td a.title').hover(function() {
// 		showImage(this);
//     }, 
//     function(){
//     	// debugger;
//         clearTimeout(timer);
//     });

//     // var container = $('#pjax');
//     // container.on('pjax:send',function(args){
//     //     layer.load(2);
//     // });
//     // container.on('pjax:complete',function(args){
//     //     layer.closeAll('loading');
//     //     $('table tr td a.title').bind('mouseover mouseout', function() {
//     //     	showImage(this);
//     //     });
//     // });

// 	function showImage(obj)
// 	{
// 		timer = setTimeout(function() {
// 			var node = $(obj).attr('title');
// 			// console.log($(obj));return;
// 			if (node.length) {
// 				layer.tips('<img src="' + node + '" width="100" height="100">', $(obj), {
// 					tips: [2, '#3595CC'],
// 				});
// 			} else {
// 				layer.tips('$noPic', $(obj), {
// 					tips: [2, '#3595CC'],
// 				});
// 			}
// 		}, 200);
// 	}
// EOT
// );
 ?>

