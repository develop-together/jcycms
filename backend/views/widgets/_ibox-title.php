<?php


use yii\helpers\Url;
use yii\helpers\Html;

$controller = strtolower(Yii::$app->controller->id);
$action = strtolower(Yii::$app->controller->action->id);
$prefixTitle = '';
if ($action == 'index') {
    if (! isset($buttons) && ! isset($defaultButtons)) {
        $buttons = [];
    }    
} else {
    if (! isset($buttons) && ! isset($defaultButtons)) {
        $buttons = [
            [
                'name' => Yii::t('app', 'Back'),
                'url' => (isset($pid)) ? ['list', 'id' => $pid] : ['index'],//$controller === 'carousel-item' && 
                'options' => [
                    'class' => 'btn btn-primary btn-xs',
                ]
            ],
        ];
    }
}

switch ($action) {
    case "index":
        break;
    case "create":
        $prefixTitle = Yii::t('app', 'Create');
        break;
    case "update":
        $prefixTitle = Yii::t('app', 'Update');
        break;
    case "view":
        $prefixTitle = Yii::t('app', 'View');

        break;        
    default:
        break;
}

?>
<div class="ibox-title">
    <h5><?= $prefixTitle . Yii::t('app', $this->title) ?></h5>
     <div class="ibox-tools">
        <?php
            foreach ($buttons as $button) {
            echo Html::a(Yii::t('app', $button['name']), Url::to($button['url']), $button['options']);
        }
        ?>
    </div>
</div>