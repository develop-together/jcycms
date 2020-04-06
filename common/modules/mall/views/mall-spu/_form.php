<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\ActiveForm AS BAF;

/* @var $this yii\web\View */
/* @var $model common\models\MallSpu */
/* @var $form common\widgets\ActiveForm */
\backend\assets\BootstrapAsset::register($this);
?>
<style>
    /*::-webkit-scrollbar-thumb {*/
    /*    background: rgba(0, 0, 0, 0.4);*/
    /*    padding: 0;*/
    /*    border: none;*/
    /*}*/
    /*::-webkit-scrollbar-thumb {*/
    /*    background-color: rgba(180, 180, 180, 0.2);*/
    /*    border-radius: 12px;*/
    /*    background-clip: padding-box;*/
    /*    border: 1px solid rgba(180, 180, 180, 0.4);*/
    /*    min-height: 28px;*/
    /*}*/
    body {
        overflow-y: hidden;
    }

    .fixed-footer {
        position: fixed;
        bottom: 0px;
        right: 60px;
        z-index: 999;
        width: auto;
        margin: 0px;
    }

    .fixed-footer button[type='reset'] {
        margin-right: 60px;
    }

    .form-scroll {
        overflow-y: scroll;
        max-height: 450px;
    }

    .upload-kit-input {
        width: 78px;
        height: 78px;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('@backend/views/widgets/_ibox-title') ?>
            <?php $form = BAF::begin(); ?>
            <div class="ibox-content  form-scroll">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1"
                                              aria-expanded="true"><?= Yii::t('mall', 'Basic Information') ?></a>
                        </li>
                        <li class=""><a data-toggle="tab" href="#tab-2"
                                        aria-expanded="false"><?= Yii::t('mall', 'Goods Attribute') ?></a>
                        </li>
                        <li class=""><a data-toggle="tab" href="#tab-3"
                                        aria-expanded="false"><?= Yii::t('mall', 'Goods Setting') ?></a>
                        <li class=""><a data-toggle="tab" href="#tab-4"
                                        aria-expanded="false"><?= Yii::t('mall', 'Details') ?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-1">
                            <div class="panel-body">
                                <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

                                <div class="hr-line-dashed"></div>
                                <?= $form->field($model, 'sub_title')->textInput(['maxlength' => true]); ?>

                                <div class="hr-line-dashed"></div>


                                <div class="form-group field-mallspu-weight required">
                                    <?php //echo $form->field($model, 'weight')->textInput(['maxlength' => true]); ?>
                                    <label class="col-sm-2 control-label"
                                           for="mallspu-weight"><?= $model->getAttributeLabel('weight') ?></label>
                                    <div class="col-sm-10 input-group m-b">
                                        <input type="text" id="mallspu-weight" class="form-control"
                                               name="MallSpu[weight]" aria-invalid="false">
                                        <span class="input-group-addon"><?= Yii::t('mall', 'G') ?></span>
                                        <div class="help-block m-b-none"></div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <?= $form->field($model, 'spu_code')->textInput(['maxlength' => true, 'readonly' => true]); ?>
                                <div class="hr-line-dashed"></div>
                                <?= $form->field($model, 'cid3')->dropDownList(['placeHolder' => Yii::t('mall', 'Please select {attribute}', [
                                    'attribute' => Yii::t('mall', 'Category')
                                ])]); ?>

                                <div class="hr-line-dashed"></div>
                                <?= $form->field($model, 'brand_id')->dropDownList(['placeHolder' => Yii::t('mall', 'Please select {attribute}', [
                                    'attribute' => Yii::t('mall', 'Brand')
                                ])]); ?>
                                <div class="hr-line-dashed"></div>

                                <?= $form->field($model, 'keyword')->textInput(['maxlength' => true, 'placeholder' => Yii::t('mall', 'Multiple keywords are separated by ","')]); ?>

                                <div class="hr-line-dashed"></div>
                                <?= $form->field($model, 'image_ids')->widget(\common\widgets\fileUploadInput\FileUploadInputWidget::className(), [
                                    'type' => 'images',
                                    'widgetOptions' => ['notes' => '（展示图最多上传五张，建议上传500px*500px的图片，主图未设置则默认第一张）']
                                ]); ?>
                            </div>
                        </div>
                        <div class="tab-pane " id="tab-2">
                            <div class="panel-body">
                                <div class="form-group field-mallspu-cost_price required">
                                    <label class="col-sm-2 control-label" for="mallspu-cost_price">
                                        <?= $model->getAttributeLabel('cost_price') ?>
                                    </label>
                                    <div class="col-sm-10 input-group m-b">
                                        <span class="input-group-addon">¥</span>
                                        <input type="text" id="mallspu-cost_price" class="form-control"
                                               name="MallSpu[cost_price]"
                                               placeholder="<?= Yii::t('mall', 'Please set the default cost price of the commodity') ?>"
                                               aria-invalid="false">
                                        <span class="input-group-addon">.00</span>
                                        <div class="help-block m-b-none"></div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group field-mallspu-price required">
                                    <label class="col-sm-2 control-label" for="mallspu-price">
                                        <?= $model->getAttributeLabel('price') ?>
                                    </label>
                                    <div class="col-sm-10 input-group m-b">
                                        <span class="input-group-addon">¥</span>
                                        <input type="text" id="mallspu-price" class="form-control" name="MallSpu[price]"
                                               placeholder="<?= Yii::t('mall', 'Please set the default selling price of the goods') ?>"
                                               aria-invalid="false">
                                        <span class="input-group-addon">.00</span>
                                        <div class="help-block m-b-none"></div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <?= $form->field($model, 'unit')->chosenSelect(\common\components\BaseConfig::getMallUnits(), false, ['prompt' => Yii::t('mall', 'Please select a unit')]) ?>
                                <div class="hr-line-dashed"></div>
                                <?= $form->field($model, 'stock')->textInput(['placeholder' => Yii::t('mall', 'Please set the default inventory of goods')]); ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="mallspu-price">
                                        <?= $model->getAttributeLabel('mallAttributes') ?>
                                    </label>
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-success">添加属性</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="tab-3">
                            <div class="panel-body">
                                <?= $form->field($model, 'min_stock')->textInput(['maxlength' => true, 'placeholder' => '当前库存量小于改值时，商品库存报警
（可在库存列表中查看明细，预警数据将以红色加粗显示）']); ?>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group ">
                                    <label class="col-sm-2 control-label">显示标签</label>
                                    <div class="col-sm-10 input-group m-b">
                                        <!--                                        <input type="radio" class="i-checks checkbox-inline">-->
                                        <?= $form->field($model, 'flag_saleable')->checkbox(); ?>
                                        <?= $form->field($model, 'flag_new')->checkbox(); ?>
                                        <?= $form->field($model, 'flag_hot')->checkbox(); ?>
                                        <?= $form->field($model, 'flag_recommend')->checkbox(); ?>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                            </div>
                        </div>
                        <div class="tab-pane " id="tab-4">
                            <div class="panel-body">
                                <?= $form->field($model, 'content')->widget(\common\widgets\Ueditor::class, [
                                    'config' => [
                                        'toolbars' => [
                                            ['fullscreen', 'source', '|', 'undo', 'redo', '|',
                                                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                                                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                                                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                                                'directionalityltr', 'directionalityrtl', 'indent', '|',
                                                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                                                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                                                'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'insertframe', 'webapp', 'pagebreak', 'template', 'background', '|',
                                                'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',
                                                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
                                                'print', 'preview', 'searchreplace', 'help', 'drafts']
                                        ]
                                    ]
                                ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fixed-footer">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                    <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']); ?>
                </div>
            </div>
            <?php BAF::end(); ?>
        </div>
    </div>
</div>

