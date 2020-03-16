<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\helpers\Url;
use <?= $generator->indexWidgetType === 'grid' ? "backend\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
use backend\grid\ActionColumn;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= '<?=' ?> $this->render('@backend/views//widgets/_ibox-index-title') ?>
            <?= $generator->enablePjax ? "<?php Pjax::begin(['options' => ['class' => 'pjax-reload']]); ?>\n" : '' ?>
            <div class="ibox-content">
                <div class="mail-tools tooltip-demo m-t-md" style="padding-bottom: 10px;">
                    <?= '<?=' ?> (isset($searchModel)) ? $this->render('_search', ['model' => $searchModel]) : '' ?>
                </div>
                <?php if ($generator->indexWidgetType === 'grid'): ?>
                    <?= "<?= " ?>GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'columns' => [
                                        [
                                            'class' => 'yii\grid\CheckboxColumn'
                                        ],
                                        <?php
                                        $count = 0;
                                        if (($tableSchema = $generator->getTableSchema()) === false) {
                                            foreach ($generator->getColumnNames() as $name) {
                                                if (++$count == 1) {
                                                    $name = "'" . $name . "',\n";
                                                } elseif ($count < 6) {
                                                    $tab = $count === 1 ? '' : "\t\t\t\t\t\t";
                                                    $name = "{$tab}'" . $name . "',\n";
                                                } else {
                                                    $name = "\t\t\t\t\t\t// '" . $name . "',\n";
                                                }
                                                echo $name;
                                            }
                                        } else {
                                            foreach ($tableSchema->columns as $column) {
                                                $format = $generator->generateColumnFormat($column);
                                                if (++$count == 1) {
                                                    $name = "'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                                } elseif ($count < 6) {
                                                    $tab = $count === 1 ? '' : "\t\t\t\t\t\t\t\t\t\t";
                                                    $name = "{$tab}'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                                } else {
                                                    $name = "\t\t\t\t\t\t\t\t\t\t// '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                                }
                                                echo $name;
                                            }
                                        }
                                        ?>
                                        [
                                        'class' => 'backend\grid\ActionColumn',
                                        'template' => '{view}{update}{delete}',
                                        ],
                            ]
                    ]); ?>
                <?php else: ?>
                    <?= "<?= " ?>ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemOptions' => ['class' => 'item'],
                    'itemView' => function ($model, $key, $index, $widget) {
                    return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
                    },
                    ]) ?>
                <?php endif; ?>
            </div>
            <?= $generator->enablePjax ? "    <?php Pjax::end(); ?>\n" : '' ?>
        </div>
    </div>
</div>


