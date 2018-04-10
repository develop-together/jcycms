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
								'category_id',
								'type',
								'title',
								'sub_title',
								// 'summary',
								// 'thumb',
								// 'seo_title',
								// 'seo_keywords',
								// 'seo_description',
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


