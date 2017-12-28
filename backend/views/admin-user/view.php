<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = "Admin";
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'username',
                        'email:email',
                        [
                            'attribute' => 'avatar',
                            'format' => 'raw',
                            'value' => function($model) {
                                return Html::img($model->getAvatarFormat(), ['width' => 100, 'height' => 100]);
                            }
                        ],
                        'status',
                        'created_at',
                        'updated_at',
                    ],
                ]) ?>                 
            </div>      
        </div>
    </div>
</div>

