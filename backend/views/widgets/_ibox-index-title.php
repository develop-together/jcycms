<?php


use yii\helpers\Url;
use yii\helpers\Html;

$controller = strtolower(Yii::$app->controller->id);

?>
<div class="ibox-title">
    <div class="mail-tools tooltip-demo m-t-md">
        <a href="<?=Url::toRoute(['refresh'])?>" class="btn btn-primary btn-sm refresh" title="<?= Yii::t('app', 'Refresh');?>" data-pjax="0">
            <i class="fa fa-refresh"></i> <?= Yii::t('app', 'Refresh');?>
        </a>
        <a href="<?= Url::toRoute(['create']) ?>" class="btn  btn-sm btn-success" title="<?= Yii::t('app', 'Create');?>" data-pjax="0">
            <i class="fa fa-plus"></i> <?= Yii::t('app', 'Create');?>
        </a>   
        <a href="<?=Url::toRoute(['delete'])?>" data-confirm="<?= yii::t('app', 'Realy to delete?')?>" class="btn btn-danger btn-sm multi-operate" title="<?= Yii::t('app', 'BatchDelete');?>" data-pjax="0">
            <i class="fa fa-trash-o" ></i> <?= Yii::t('app', 'BatchDelete');?>
        </a>        
        <div class="pull-right" style="padding-top: 6px"><h5><?= Yii::t('app', $this->title) ?></h5></div>
    </div>
</div>