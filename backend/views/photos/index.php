<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use backend\grid\GridView;
use backend\grid\ActionColumn;
use common\components\BaseConfig;
use backend\models\Article;

$showPicture = function($url, $model, $uniqid) {
    return Html::a('<i class="fa fa-image"></i> ' . Yii::t('app', 'View'), 'javacript:;', [
        'title' => Yii::t('app', 'View'),
        'class' => 'btn btn-white btn-sm',
        'id' => 'show_picture',
        'data-id' => $model->id,
        'data-fids' => $model->photo_file_ids,
    ]);	
}

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
									'enableSorting' => false,
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
                                    'template' => '{showPicture}{update}{delete}',
                                    'buttons' => ['showPicture' => $showPicture],
                                ],
                            ]
                        ]); ?>
                            </div>
                    </div>
    </div>
</div>
<?php
	$url = Url::toRoute(['photos/show-pictures']);
	$this->registerJs(<<<EOT
		$("#show_picture").on('click', function(event) {
			if (!$(this).data('fids')) {
				layer.tips('暂无图片', this, {
				  tips: [1, '#3595CC'],
				  time: 4000
				});
				return;
			}
			jQuery.ajax({
				type: 'GET',
				url: "$url",
				data: {id: $(this).data('id')},
				dataType: 'JSON',
				success: function(responseData) {
					if (responseData.data) {
						layer.photos({
							photos: responseData,
							anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
						});
					}
				}
			});
		});
EOT
);	
?>



