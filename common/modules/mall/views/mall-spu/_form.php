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
            font-size: 14px;
        }

        .selectItem {
            cursor: pointer;
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
            max-height: 100px;
            overflow-y: scroll;
        }

        .formInputDiv .active {
            position: relative;
            background: #0880FF;
            color: #fff !important;
        }

        .formInputDiv li:hover {
            color: #0880FF;
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
                            <div class="tab-pane fade in active" id="tab-1">
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
                                                        <option selected="selected" value="0">请选择商品类别</option>
                                                    </select>
                                                    <div id="div_text"></div>
                                                </div>
                                                <div id="selectData" class="formInputDiv" style="display: none;">
                                                    <ul id="selectData_1"></ul>
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
                            <div class="tab-pane fade" id="tab-2">
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
                                            <button type="button" class="btn btn-success"
                                                    data-url="<?= Url::to(['mall-spu/chose-attr']) ?>" id="addAttribute">
                                                添加属性
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-3">
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
                            <div class="tab-pane fade" id="tab-4">
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
                        <?= Html::button(Yii::t('app', 'Next Step'), ['class' => 'btn btn-primary', 'id' => 'nextStep', 'data-next' => 1]) ?>
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
            selectTextDom: $('.selectDiv').find("div#div_text"),
            selectDelSelDom: $('.del_sel'),
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
                            // console.log('response:', response);
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
                } else {
                    that.selectDataDom.css('display', 'none');
                }
            },
            createLiList: function (dom, data, key, vKey) {
                key = key || 'id';
                vKey = vKey || 'value';
                var that = this || selectDiv;
                var str = '';
                if (data.length) {
                    for (var i = 0; i < data.length; i++) {
                        var da = data[i];
                        var classStr = i === 0 ? 'selectDataOneLi active' : 'selectDataOneLi';
                        str += "<li class='" + classStr + "' data-cid='" + da[key] + "' data-level='" + da['level'] + "' onclick='selectDiv.choseCatalog(this)'>" + da[vKey] + "</li>";
                    }
                    $(dom).append(str);
                    // that.bindCatalogLiEvent(dom);
                } else {
                    $(dom).empty();
                }
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
            bindCatalogLiEvent: function (parentDom) {
                var that = this || selectDiv;
                $(parentDom).children('li').on('click', function () {
                    that.choseCatalog(this);
                })
            },
            choseCatalog: function (me, level, cid, type) {
                var that = this || selectDiv;
                type = type || '';
                var data = $(me).data();
                var text = $(me).html();
                var txtNum = that.selectTextDom.find('>p').length;
                if (data.hasOwnProperty('cid')) {
                    cid = data['cid'];
                }
                if (data.hasOwnProperty('level')) {
                    level = data['level'];
                }
                that.selectDivDom.find('option').text('').attr('val', cid);
                $(this).addClass('active').siblings().removeClass('active');
                var brandId = that.brandDom.find('option:selected').val();
                var num = that.selectDataOneDom.find('ul').length;
                if (that.selectFlag && that.choseClass) {
                    var url = that.selectDivDom.data('url');
                    that.choseClass = false;
                    that.request(url, 'GET', {
                        cid: cid,
                        brandId: brandId
                    }, function (response) {
                        if (response.code === 10002) {
                            that.brandDom.empty();
                            that.selectDataOneDom.empty();
                            var catalogList = response.catalogList;
                            var brandList = response.brandList;
                            var str = '';
                            var selectP = that.selectTextDom;
                            if (type === '') {
                                if (txtNum - 2 == level) {// 当切换一级分类时，先取消之前的选择，在加载新的一级分类
                                    var txtNum1 = txtNum - 1;
                                    var parent = selectP.get(0);
                                    var son0 = document.getElementById("p" + txtNum);
                                    var son1 = document.getElementById("p" + txtNum1);
                                    son0 && parent.removeChild(son0);
                                    son1 && parent.removeChild(son1);
                                    that.appendSelectText(catalogList.length, selectP, cid, level, text, txtNum1);
                                } else {
                                    that.appendSelectText(catalogList.length, selectP, cid, level, text, txtNum);
                                }
                            }

                            that.createLiList(that.selectDataOneDom, catalogList, 'id', 'name');
                            that.createOptions(that.brandDom, brandList, 'id', 'name', null, '请选择品牌');
                        }
                    }, function (XHR, TS) {
                        that.choseClass = true;
                    })
                }
            },
            appendSelectText: function (catalogLen, selectP, cid, level, text, txtNum) {
                var that = this || selectDiv;
                var str = '';
                if (catalogLen == 0) {// 该分类没有下级
                    if (selectP.html() === '') {
                        str = `<p class='selectItem' id='p1' tyid='${cid}' onclick='selectDiv.delSel(this,${level},${cid})'>${text}</p><p class='selectItem del_sel' id='p2' onclick='selectDiv.delSel(this)'></p>`;
                    } else {
                        $('.del_sel').remove();
                        str = `<p class='selectItem' id="p${txtNum}" tyid='${cid}' onclick='selectDiv.delSel(this, ${level}, ${cid})'><span>&gt;</span>${text}</p><p class='selectItem del_sel' id='p${txtNum + 1}' onclick='selectDiv.delSel(this)'></p>`;
                    }
                    that.selectDataDom.css('display', 'none');
                } else {
                    if (selectP.html() === '') {
                        str = `<p class='selectItem' id='p1' tyid='${cid}' onclick='selectDiv.delSel(this,${level}, ${cid})'>${text}</p><p class='selectItem del_sel' id='p2' onclick='selectDiv.delSel(this)'><span>&gt;</span>请选择</p>`;
                    } else {
                        $('.del_sel').remove();
                        str = `<p class='selectItem' id="p${txtNum}" tyid='${cid}' onclick='selectDiv.delSel(this, ${level},${cid})'><span>&gt;</span>${text}</p><p class='selectItem del_sel' id="p${txtNum + 1}" onclick='selectDiv.delSel(this)'><span>&gt;</span>请选择</p>`
                    }
                }

                selectP.append(str);
            },
            delSel: function (me, level, cid) {
                // 删除选中的类别
                // 如果有选择的分类，重置为请选择状态，此时当前的分类id为上级id，然后在选择
                var that = this || selectDiv;
                if (cid) {
                    if (level == 0) {
                        var cid1 = 0;
                        that.choseCatalog(me, level, cid1, 'type');
                    } else {
                        var cid1 = $('#p' + level).eq(0).attr('tyid');
                        that.choseCatalog(me, level - 1, cid1, 'type');
                    }
                    $(me).nextAll().remove();
                    $(me).remove();
                    if (that.selectTextDom.html() == '') {
                        that.selectDivDom.find('option').text('请选择商品类别').attr('value', 0);
                    } else {
                        if (cid1 == 0) {
                            that.selectDivDom.find('option').text('请选择商品类别').attr('value', cid1);
                        } else {
                            that.selectDivDom.find('option').text('').attr('value', cid1);
                            that.selectTextDom.append(`<p class='selectItem del_sel' onclick='selectDiv.delSel(this)'><span>&gt;</span>请选择</p>`);
                        }
                    }

                    if (level) {
                        event.stopPropagation();
                    }
                }
            },
            request: function (url, type, data, successCallback, completeCallBack) {
                var that = this || selectDiv;
                type = type || 'GET';
                data = data || {};
                successCallback = successCallback || function (response) {
                };
                completeCallBack = completeCallBack || function (XHR, TS) {
                };
                $.ajax({
                    type: type,
                    url: url,
                    data: data,
                    success: successCallback,
                    complete: completeCallBack
                });

            }
        }

        // tab切换-标签页显示时触发,但是必须在某个标签页已经显示之后
        var currentTabIndex = 0;
        var prevTxt = '<?= Yii::t('app', 'Previous Step') ?>';
        var nextTxt = '<?= Yii::t('app', 'Next Step') ?>';
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            // 获取已激活的标签页的名称e.target
            // 获取前一个激活的标签页的名称 e.relatedTarget
            var href = $(e.target).attr('href');
            var tabId = parseInt(href.replace('#tab-', ''));
            if (tabId === 4) {
                $("#nextStep").attr('data-next', 0);
                $("#nextStep").text(prevTxt);
            } else if (tabId === 1) {
                $("#nextStep").attr('data-next', 1);
                $("#nextStep").text(nextTxt);
            }
            currentTabIndex = tabId - 1;
        });

        // 下一步
        $("#nextStep").on('click', function () {
            var isNext = parseInt($(this).attr('data-next'));
            if (isNext) {
                currentTabIndex += 1;
            } else {
                currentTabIndex -= 1;
            }

            $('ul.nav-tabs li:eq(' + currentTabIndex + ') a').tab('show');
        })

        // 添加属性
        $('#addAttribute').bind('click', function () {
            var url = $(this).data('url');
            layer.open({
                type: 2,
                title: false,
                closeBtn: 1, //不显示关闭按钮
                // shade: [0],// 遮罩
                area: ['680px', '454px'],
                // area: ['340px', '215px'],//'893px', '600px'
                // offset: 'rb', //右下角弹出
                // time: 2000, //2秒后自动关闭
                anim: 2,
                shadeClose: true,
                content: [url, 'no'], //iframe的url，no代表不显示滚动条
                btn: ['添加'],
                yes: function (index, layero) {
                    //按钮【按钮一】的回调
                    var body = layer.getChildFrame('body', index);
                    var attributes = body.find("select#attributes option:selected").val();
                    layer.close(index)
                },
                end: function () { //此处用于演示
                }
            });
        })
    </script>
<?php JsBlock::end(); ?>