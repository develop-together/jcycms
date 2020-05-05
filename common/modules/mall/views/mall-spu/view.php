<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->id;
$this->params['breadcrumbs'] = [
['label' => Yii::t('app', 'Mall Spu'), 'url' =>  Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
['label' => $this->title],
];

?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('@backend/views/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                		'id',
						'spu_code',
						'title',
						'sub_title',
						'cid1',
						'cid2',
						'cid3',
						'brand_id',
						'brand_name',
						'weight',
						'dim',
						'flag_saleable',
						'flag_valid',
						'sort',
						'created_at',
						'updated_at',
						'deleted_at',
                ],
                ]) ?>
            </div>
        </div>
    </div>
</div>

