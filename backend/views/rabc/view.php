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
            'menu_id',
            'rule_name',
            'method',
            'description:ntext',
            'created_at',
            'updated_at',
                    ],
]) ?>  
            </div>
        </div>
    </div>
</div>

