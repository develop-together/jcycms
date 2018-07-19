<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->title;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Photos'), 'url' =>  Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
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
                        'category_id',
                        'type',
                        'title',
                        'sub_title',
                        'summary',
                        'thumb',
                        'seo_title',
                        'seo_keywords',
                        'seo_description',
                        'status',
                        'sort',
                        'user_id',
                        'scan_count',
                        'can_comment',
                        'visibility',
                        'tag',
                        'flag_headline',
                        'flag_recommend',
                        'flag_slide_show',
                        'flag_special_recommend',
                        'flag_roll',
                        'flag_bold',
                        'flag_picture',
                        'created_at',
                        'updated_at',
                    ],
]) ?>  
            </div>
        </div>
    </div>
</div>

