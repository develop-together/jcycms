<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->id;
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Comment'), 'url' =>  Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => $this->title],
];

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
                        'user_id',
                        [
                            'attribute' => 'article_id',
                            'format' => 'raw',
                            'value' => function($model) {
                                return $model->article->title;
                            }
                        ],
                        [
                            'attribute' => 'parent_id',
                            'format' => 'raw',
                            'value' => function($model) {
                                return $model->parent ? $model->parent->contents :'';
                            }
                        ],
                        'nickname',
                        'ip',
                        'status',
                        'like_count',
                        'repeat_count',
                        'contents:raw',
                        'created_at',
                    ],
]) ?>
            </div>
        </div>
    </div>
</div>

