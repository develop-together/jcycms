<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\ActiveForm AS BAF;
use common\widgets\JsBlock;

/* @var $this yii\web\View */
/* @var $model common\models\MallSpecParam */
/* @var $form common\widgets\ActiveForm */
?>
<style>
    fieldset {
        padding: 3px 5px 10px 3px;
        margin: 0 0 5px 0;
        border: 1px dotted #B8D0D6;
    }

    fieldset legend {
        padding: 2px;
        border: 1px dotted #009688;
        font-weight: bold;
        font-size: 14px;
        color: #009688;
        width: auto;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('@backend/views/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?php $form = BAF::begin(); ?>
                <fieldset>
                    <legend>基本信息</legend>
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'style' => 'width:50%']); ?>
                            <?= $form->field($model, 'unit')->textInput(['maxlength' => true, 'style' => 'width:50%']); ?>
                            <?= $form->field($model, 'group_id')->dropDownList(\common\models\MallSpecGroup::loadData(), [
                                'style' => 'width:50%',
                                'prompt' => Yii::t('app', 'Please select')
                            ]); ?>

                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'data_type')->dropDownList(\common\components\BaseConfig::getDataTypes(), [
                                'style' => 'width:50%'
                            ]); ?>
                            <?= $form->field($model, 'generic')->checkbox(); ?>

                            <?= $form->field($model, 'searching')->checkbox(); ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>属性信息</legend>
                    <div class="form-group">
                        <div id="toolbar" class="pull-left" style="width: 90px;margin-left: 20px">
                            <button id="insertRow" class="btn btn-secondary" disabled
                                    type="button"><?= Yii::t('mall', 'InsertRow') ?></button>
                        </div>
                        <div class="pull-left">
                            <?= $form->field($model, 'display_type', [
                                'template' => "{input}"
                            ])->dropDownList(\common\components\BaseConfig::getSpecParDisType(), [
                                'style' => 'width:120px',
                                'disabled' => !$model->isNewRecord
                            ]); ?>
                        </div>
                    </div>
                    <?= $form->field($model, 'segments', ['options' => ['id' => 'segments']])->textInput(['maxlength' => true, 'style' => 'width:50%', 'value' => $model->getIsSelectDis() ? '' : $model->segments]); ?>
                    <div style="margin: 0 auto;width: 80%">
                        <table id="mall-spec-params" style="width: 300px"></table>
                    </div>
                </fieldset>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']); ?>
                    </div>
                </div>

                <?php BAF::end(); ?>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerCssFile(Yii::$app->request->baseUrl . '/static/js/plugins/bootstrap-table/dist/bootstrap-table.min.css');
$this->registerJsFile(Yii::$app->request->baseUrl . '/static/js/plugins/bootstrap-table/dist/bootstrap-table.js', [
    'depends' => \backend\assets\AppAsset::class,
    'position' => $this::POS_END
]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/static/js/plugins/bootstrap-table/dist/locale/bootstrap-table-en-US.min.js', [
    'depends' => \backend\assets\AppAsset::class,
    'position' => $this::POS_END
]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/static/js/plugins/bootstrap-table/dist/locale/bootstrap-table-zh-CN.min.js', [
    'depends' => \backend\assets\AppAsset::class,
    'position' => $this::POS_END
]);
?>
<?php JsBlock::begin() ?>
<script type="application/javascript">
    var $table = $('#mall-spec-params');
    var locale = "<?= Yii::$app->language ?>";
    var id = parseInt("<?= $model->id ?>");
    var segments = '<?= $model->segments ?>';
    var data = [
        {
            sort: 1,
            name: ''
        }
    ];
    if (segments) {
        data = JSON.parse(segments);
    }
    window.operateEvents = {
        'click .remove': function (e, value, row, index) {
            if ($table.bootstrapTable('getData').length <= 1) {
                layer.alert("最后一项无法删除");
                return false;
            }
            row['index'] = index;
            $table.bootstrapTable('remove', {field: "index", values: [index]});
        }
    };

    function initTable(data) {
        $("#insertRow").attr('disabled', false);
        $("#segments").addClass('hide');
        data = data || [];
        var params = {
            pagination: false,
            search: false,
            locale: locale,
            columns: [
                {
                    field: 'sort',
                    title: '<?= Yii::t('app', 'Sort') ?>',
                    formatter: function (value, row, index) {
                        return '<input type="number" data-filed="sort" min="0" style="width: 80px"  name="MallSpecParam[items][sort][' + index + ']" class="form-control" value="' + value + '" onblur="changeData(' + index + ', this);" />';
                    }
                },
                {
                    field: 'name',
                    title: '<?= Yii::t('mall', 'Item Name') ?>',
                    formatter: function (value, row, index) {
                        return '<input type="text" data-filed="name" style="width: 120px"  name="MallSpecParam[items][name][' + index + ']" class="form-control" value="' + value + '" onblur="changeData(' + index + ', this);" />';
                    }
                },
                {
                    field: 'operate',
                    title: '<?= Yii::t('app', 'Action') ?>',
                    align: 'center',
                    clickToSelect: false,
                    events: window.operateEvents,
                    formatter: operateFormatter
                }],
            data: data
        };
        $table.bootstrapTable('destroy').bootstrapTable(params)
    }

    function clearTable() {
        $table.bootstrapTable('destroy');
    }

    function reloadRowData(index, obj) {
        var dataRows = $table.bootstrapTable('getData');
        var row = dataRows[index];
        var key = $(obj).attr('data-filed');
        row[key] = $(obj).val();
        row['index'] = index;
        $table.bootstrapTable('getData').splice(index, 1, row);
    }

    function changeData(index, obj) {
        // reloadRowData(index, obj);
        var value = $(obj).val();
        var filed = $(obj).attr('data-filed');
        //通过 index 获取指定的行
        var dataRows = $table.bootstrapTable('getData');
        var row = dataRows[index];
        row['index'] = index;
        //将 input 的值存进 row 中
        row[filed] = value;
        //更新指定的行，调用 'updateRow' 则会将 row 数据更新到 data 中，然后再重新加载
        $table.bootstrapTable('updateRow', {index: index, row: row});
        // $table.bootstrapTable('refresh');
    }

    function detailFormatter(index, row) {
        var html = [];
        $.each(row, function (key, value) {
            html.push('<p><b>' + key + ':</b> ' + value + '</p>')
        })
        return html.join('')
    }

    function operateFormatter(value, row, index) {
        return [
            // '<a class="like" href="javascript:void(0)" title="Like">',
            // '<i class="fa fa-heart"></i>',
            // '</a>  ',
            '<a class="remove" href="javascript:void(0)" title="Remove">',
            '<i class="fa fa-trash"></i>',
            '</a>'
        ].join('')
    }

    $("#mallspecparam-display_type").bind('change', function () {
        var type = $(this).val();
        if ('select' === type) {
            initTable(data);
        } else {
            $("#insertRow").attr('disabled', true);
            $("#segments").removeClass('hide');
            clearTable();
        }
    });

    $("#insertRow").bind('click', function () {
        $table.bootstrapTable('insertRow', {
            index: 0,
            row: {
                sort: $table.bootstrapTable('getData').length ? $table.bootstrapTable('getData').length + 1 : 1,
                name: '',
            }
        })
    });

    if  (id && data) {
        initTable(data);
    }
</script>
<?php JsBlock::end() ?>
