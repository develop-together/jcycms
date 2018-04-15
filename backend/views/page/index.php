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
								'title',
								[
									'attribute' => 'user_id',
									'value' => function($model) {
										return $model->user->username;
									}
 								],
 								[
 									'attribute' => 'linkUrl',
 									'format' => 'raw',
 									'value' => function($model) {
 										return Html::a($model->linkUrl, $model->linkUrl, ['target' => '_blank']);
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


