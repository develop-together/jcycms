<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->id;
$this->params['breadcrumbs'] = [
['label' => Yii::t('app', '<?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>'), 'url' =>  Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
['label' => $this->title],
];

?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= '<?=' ?> $this->render('@backend/views/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= "<?= " ?>DetailView::widget([
                'model' => $model,
                'attributes' => [
                <?php
                    $i = 0;
                    if (($tableSchema = $generator->getTableSchema()) === false) {
                        foreach ($generator->getColumnNames() as $name) {
                            echo ($i++ > 0 ? "\t\t\t\t\t\t'" : "\t\t'") . $name . "',\n";
                        }
                    } else {
                        foreach ($generator->getTableSchema()->columns as $column) {
                            $format = $generator->generateColumnFormat($column);
                            echo ($i++ > 0 ? "\t\t\t\t\t\t'" : "\t\t'") . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                        }
                    }
                ?>
                ],
                ]) ?>
            </div>
        </div>
    </div>
</div>

