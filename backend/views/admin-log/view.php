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
                        'description:raw',
                    ],
                    'template' => '<tr><td colspan="2" text-align="center">{value}</td></tr>',
                ]) ?>  
            </div>
        </div>
    </div>
</div>

