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
                        <?= (isset($searchModel)) ? $this->render('_search', ['model' => $searchModel]) : '' ?>
                    </div>     

                    <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                             'columns' => [
                                    [
                                        'class' => 'yii\grid\CheckboxColumn'
                                    ],
                                    'id',
								'menu_id',
								'rule_name',
								'method',
								'description:ntext',
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


