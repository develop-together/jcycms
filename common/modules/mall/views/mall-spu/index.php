<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\grid\GridView;
use backend\grid\ActionColumn;

?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('@backend/views/widgets/_ibox-index-title') ?>
                        <div class="ibox-content">
                <div class="mail-tools tooltip-demo m-t-md" style="padding-bottom: 10px;">
                    <?= (isset($searchModel)) ? $this->render('_search', ['model' => $searchModel]) : '' ?>
                </div>
                                    <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'columns' => [
                                        [
                                            'class' => 'yii\grid\CheckboxColumn'
                                        ],
                                        'id',
										'spu_code',
										'title',
										'sub_title',
										'cid1',
										// 'cid2',
										// 'cid3',
										// 'brand_id',
										// 'brand_name',
										// 'weight',
										// 'dim',
										// 'saleable',
										// 'valid',
										// 'image_ids',
										// 'sort',
										// 'created_at',
										// 'updated_at',
										// 'deleted_at',
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


