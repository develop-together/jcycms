<?php


use yii\helpers\Url;
use yii\helpers\Html;

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
                    'name' => yii::t('app', 'Back'),
                    'url' => ['index'],
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
        $prefixTitle = yii::t('app', 'Create');
        break;
    case "update":
        $prefixTitle = yii::t('app', 'Update');
        break;
    case "view":
        $prefixTitle = yii::t('app', 'View');

        break;        
    default:
        break;
}
?>
<div class="ibox-title">
    <h5><?= $prefixTitle . yii::t('app', $this->title) ?></h5>
 <div class="ibox-tools">
    <?php
        foreach ($buttons as $button) {
        echo Html::a(yii::t('app', $button['name']), Url::to($button['url']), $button['options']);
    }
    ?>
</div>
</div>