<?php


use yii\helpers\Url;
use yii\helpers\Html;

$controller = strtolower(Yii::$app->controller->id);
$pjax = isset($pjax) ?? false;

?>
<div class="ibox-title">
    <div class="mail-tools tooltip-demo m-t-md">
        <?php if(!$pjax): ?>
        <a href="<?php echo Url::toRoute(['refresh'])?>" class="btn btn-primary btn-sm  refresh" title="<?= Yii::t('app', 'Refresh');?>" data-pjax="0">
            <i class="fa fa-refresh"></i> <?= Yii::t('app', 'Refresh');?>
        </a>
        <?php else: ?>
            <a href="javascript:;" class="btn btn-primary btn-sm pjax-refresh" title="<?= Yii::t('app', 'Refresh');?>" data-pjax="0">
                <i class="fa fa-refresh"></i> <?= Yii::t('app', 'Refresh');?>
            </a>
        <?php endif; ?>
        <?php if (!isset($noAdd) || !$noAdd): ?>
            <a href="<?= Url::toRoute(['create']) ?>" class="btn  btn-sm btn-success" title="<?= Yii::t('app', 'Create');?>" data-pjax="0">
                <i class="fa fa-plus"></i> <?= Yii::t('app', 'Create');?>
            </a>               
        <?php endif ?>

        <a href="<?=Url::toRoute(['delete'])?>" data-confirm="<?= Yii::t('app', 'Realy to delete?')?>" class="btn btn-danger btn-sm multi-operate" title="<?= Yii::t('app', 'BatchDelete');?>" data-pjax="0">
            <i class="fa fa-trash-o" ></i> <?= Yii::t('app', 'BatchDelete');?>
        </a>        
        <div class="pull-right" style="padding-top: 6px"><h5><?= Yii::t('app', $this->title) ?></h5></div>
    </div>
</div>