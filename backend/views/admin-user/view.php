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
                        'avatar',
                        'status',
                        'created_at',
                        'updated_at',
                    ],
                ]) ?>                 
            </div>      
        </div>
    </div>
</div>

