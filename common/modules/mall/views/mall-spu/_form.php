<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\ActiveForm AS BAF;
use common\widgets\JsBlock;

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

        /*selectDiv*/
        .selectDiv {
            position: relative;
            width: 300px;
            height: 36px;
        }

        .selectDiv > div {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            padding-left: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding-right: 15px;
        }

        .selectDiv p {
            margin-bottom: 0;
        }

        .selectItem span {
            margin: 0 5px;
        }

        .formInputDiv {
            /*display: flex;*/
            width: 300px;
            border: 1px solid #D5DBE8;
        }

        .formInputDiv ul {
            width: 300px;
            margin: 0;
            padding: 0;
            max-height: 120px;
            overflow-y: scroll;
        }

        .formInputDiv .active {
            position: relative;
            background: #0880FF;
            color: #fff !important;
        }

        .formInputDiv li {
            height: 30px;
            line-height: 30px;
            cursor: pointer;
            font-size: 14px;
            color: #6A7076;
            user-select: none;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            padding: 0 12px;
        }

        /*selectDiv*/
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
                                    <div class="form-group field-mallspu-cid3 required">
                                        <label class="col-sm-2 control-label" for="mallspu-cid3">
                                            <?= $model->getAttributeLabel('cid3') ?>
                                        </label>
                                        <div class="col-sm-10">
                                            <div class="formInputSD">
                                                <div onclick="selectDiv.selectClass()" class="selectDiv"
                                                     data-url="<?= Url::to(['mall-spu/ajax-catalog']) ?>">
                                                    <select name="MallSpu[cid3]" readonly="readonly"
                                                            class="form-control"
                                                            aria-required="true"
                                                            style="margin-right: 0px;">
                                                        <!--                                                        <option selected="selected" value="309"></option>-->
                                                        <option selected="selected" value="0">请选择商品类别</option>
                                                    </select>
                                                    <div id="div_text">
                                                        <!--                                                        <p class="selectItem" id="p1" tyid="309"-->
                                                        <!--                                                           onclick="del_sel(this,0,309)">精美箱包-->
                                                        <!--                                                        </p>-->
                                                        <!--                                                        <p class="selectItem del_sel" id="p2" onclick="del_sel(this)">-->
                                                        <!--                                                            <span>&gt;</span>请选择</p>-->
                                                    </div>
                                                </div>
                                                <div id="selectData" class="formInputDiv" style="display: none;">
                                                    <ul id="selectData_1">
                                                        <!--                                                        <li value="34" onclick="class_level(this,1,34,'')">女包</li>-->
                                                        <!--                                                        <li value="165" onclick="class_level(this,1,165,'')">男包</li>-->
                                                        <!--                                                        <li value="167" onclick="class_level(this,1,167,'')">旅行箱包</li>-->
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="help-block m-b-none"></div>
                                        </div>
                                    </div>
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
                                            <input type="text" id="mallspu-price" class="form-control"
                                                   name="MallSpu[price]"
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
<?php JsBlock::begin(); ?>
    <script>
        function selectBrand() {
            var class_str = $("[name=product_class]").val();
            if (class_str == '' || class_str <= 0) {
                layer.msg("请先选择商品类别！", {
                    time: 2000
                });
            }
        }

        // 点击分类框
        var selectDiv = {
            selectFlag: true,//判断点击分类框请求有没有完成,没完成继续点击不会再次请求
            choseClass: true,//判断选择分类请求有没有完成,没完成继续点击不会再次请求
            selectDivDom: $('.selectDiv'),
            selectDataDom: $("#selectData"),
            selectDataOneDom: $("#selectData_1"),
            brandDom: $("#mallspu-brand_id"),
            selectClass: function () {
                var that = this || selectDiv;
                var cid = that.selectDivDom.find(" select option:selected").val();
                cid = cid || 0;
                var brandId = that.brandDom.find("option:selected").val();
                brandId = brandId || 0;
                if (that.selectDataDom.css('display') == 'none') {
                    that.selectDataDom.css('display', 'flex');
                    if (that.selectFlag && that.choseClass) {
                        that.selectFlag = false;
                        var url = that.selectDivDom.data('url');
                        that.request(url, 'GET', {
                            cid: cid,
                            brandId: brandId
                        }, function (response) {
                            console.log('response:', response);
                            if (response.code === 10002) {
                                that.brandDom.empty();
                                that.selectDataOneDom.empty();
                                var catalogList = response.catalogList;
                                var brandList = response.brandList;
                                that.createLiList(that.selectDataOneDom, catalogList, 'id', 'name');
                                that.createOptions(that.brandDom, brandList, 'id', 'name', null, '请选择品牌');
                            }
                        }, function (XHR, TS) {
                            that.selectFlag = true
                        })
                    }
                }
            },
            createLiList: function (dom, data, key, vKey) {
                key = key || 'id';
                vKey = vKey || 'value';
                var str = '';
                for (var i = 0; i < data.length; i++) {
                    var da = data[i];
                    var classStr = i === 0 ? 'selectDataOneLi active' : 'selectDataOneLi';
                    str += "<li class='" + classStr + "' value='" + da[key] + "' '+selectedStr+'>" + da[vKey] + "</li>";
                }
                $(dom).append(str);
            },
            createOptions: function (dom, data, key, vKey, selected, tips) {
                key = key || 'id';
                vKey = vKey || 'value';
                selected = selected || null;
                tips = tips || null;
                var str = '';
                if (tips) str = '<option value="">' + tips + '</option>';
                for (var i = 0; i < data.length; i++) {
                    var da = data[i];
                    var selectedStr = da[key] === selected ? 'selected' : '';
                    str += "<option value='" + da[key] + "' '+selectedStr+'>" + da[vKey] + "</option>";
                }

                $(dom).append(str);
            },
            request: function (url, type, data, successCallback, completeCallBack) {
                var that = this || selectDiv;
                type = type || 'GET';
                data = data || {};
                // {
                //     'class_str': class_str,
                //     'brand_str': brand_str
                // }
                successCallback = successCallback || function (response) {
                };
                // function (msg) {
                //     $('#brand_class').empty()
                //     $('#selectData_1').empty()
                //     obj = JSON.parse(msg)
                //     var brand_list = obj.brand_list
                //     var class_list = obj.class_list
                //     var rew = '';
                //     if (class_list.length != 0) {
                //         var num = class_list.length - 1;
                //         display(class_list[num])
                //     }
                //
                //     for (var i = 0; i < brand_list.length; i++) {
                //         if (brand_list[i].status == true) {
                //             rew += `<option selected value="${brand_list[i].brand_id}">${brand_list[i].brand_name}</option>`;
                //         } else {
                //             rew += `<option value="${brand_list[i].brand_id}">${brand_list[i].brand_name}</option>`;
                //         }
                //     }
                //     $('#brand_class').append(rew)
                // }
                completeCallBack = completeCallBack || function (XHR, TS) {
                };
                // (XHR, TS) {
                //     // 无论请求成功还是失败,都要把判断条件改回去
                //     that.selectFlag = true
                // }
                $.ajax({
                    type: type,
                    url: url,
                    data: data,
                    success: successCallback,
                    complete: completeCallBack
                });

            }
        }


        // var selectFlag = true
        // var choose_class = true
        // function select_class() {
        //     var class_str = $('.selectDiv option').val()
        //     var brand_str = $("#brand_class option:selected").val();
        //     if ($('#selectData').css('display') == 'none') {
        //         $('#selectData').css('display', 'flex')
        //
        //         if (selectFlag && choose_class) {
        //             selectFlag = false
        //         }
        //     } else {
        //         $('#selectData').css('display', 'none')
        //     }
        // }

        // 选择分类
        function class_level(obj, level, cid, type) {
        }
    </script>
<?php JsBlock::end(); ?>