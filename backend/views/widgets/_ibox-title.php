<?php


use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

?>
<style type="text/css">
    ul.breadcrumb > li:first-child {
        color: green;
    }
</style>
<div class="ibox-title">
    <?= Breadcrumbs::widget([
        'homeLink' => false,
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ])
    ?>
</div>