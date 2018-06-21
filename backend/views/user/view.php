<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'username',
                        'email:email',
                        [
                            'attribute' => 'status',
                            'value' => function($model) {
                                return $model->statusFormat;
                            }
                        ],
                        [
                            'attribute' => 'login_count',
                            'value' => function($model) {
                                return $model->login_count . '次';
                            }
                        ],
                        'last_login_ip',
                        [
                            'attribute' => 'last_login_at',
                            'value' => function($model) {
                                return $model->last_login_at ? date('Y-m-d H:i:s', $model->last_login_at) : '';
                            }
                        ],
                        'created_at:datetime',
                        'updated_at:datetime',
                    ],
]) ?>  
            </div>
        </div>
    </div>
</div>

