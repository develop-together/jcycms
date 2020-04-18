<?php
declare(strict_types=1);

/**
 * Created by PhpStorm
 * User: Administrator
 * Author: JieChengYang
 * Date: 2020-04-15
 * Time: 23:34
 */

use common\widgets\JsBlock;

/* @var $this yii\web\View */

//$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css', ['depends' => \backend\assets\AppAsset::class]);
//$this->registerJsFile('https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js', ['depends' => \backend\assets\AppAsset::class]);
?>
<style>
    .attr-size {
        width: 90px;
        height: 36px;
        line-height: 36px;
        text-align: center;
        font-size: 14px;
        color: #2890FF;
        border: 1px solid #2890FF;
        border-radius: 2px;
        margin: 20px 0;
    }

    .form_new_r {
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .form_new_r .ra1 {
        height: 36px;
        position: relative;
        display: flex;
        justify-content: center;
    }

    .form_new_r .ra1 input {
        width: 65px !important;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    input[type=checkbox] {
        visibility: hidden;
    }

    .form_new_r .ra1 .inputC + label {
        border: 0;
        position: relative;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }

    .form_new_r .ra1 label {
        min-width: 65px;
        max-width: 77px;
        padding-left: 20px;
        margin: auto;
        height: 36px;
        display: block;
        line-height: 36px;
        overflow: hidden;
    }

    .form_new_r .ra1 .inputC + label:after {
        border: 1px solid #B2BCD1;
        width: 14px;
        height: 14px;
        border-radius: 2px;
        content: "";
        left: 0px;
        top: 11px;
        position: absolute;
        z-index: 11;
    }

    .inputC:checked + label::before {
        display: block;
        width: 12px;
        height: 12px;
        box-sizing: border-box;
        position: absolute;
        top: 0;
        left: 0;
        font-family: "FontAwesome";
        content: "\f00c";
        line-height: normal;
    }

    .form_new_r .ra1 .inputC:checked + label:before {
        position: absolute;
        border-radius: 2px;
        width: 14px;
        height: 14px;
        top: 11px;
        left: 0;
        z-index: 22;
    }

    .clear {
        clear: both;
    }

    .attributes {
        width: 320px;
    }

    .attr-list {
        max-height: 240px;
        overflow-y: scroll;
    }

</style>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <div class="ibox-title">
                <h3>添加属性</h3>
            </div>
            <div class="ibox-content">
                <div>
                    <div class="pull-left" style="width: 120px;height: 34px;line-height: 34px;">
                        <label for="">请选择属性名称：</label>
                    </div>
                    <div class="pull-left">
                        <select class="attributes" multiple>
                            <option value="">请选择属性</option>
                            <?php if ($attributes): ?>
                                <?php foreach ($attributes as $gid => $attribute): ?>
                                    <optgroup label="<?= $attribute['name'] ?>" data-gid="<?= $gid ?>">
                                        <?php foreach ($attribute['attributes'] as $key => $option): ?>
                                            <option value="<?= $option['id'] ?>"
                                                    data-display='<?= $option['display_type'] ?>'
                                                    data-unit='<?= $option['unit'] ?>'
                                                    data-segments='<?= $option['segments'] ?>'
                                                    <?= empty($option['segments']) ? 'disabled' : '' ?>><?= $option['name'] ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="attr-list"></div>
                <!--                <div class="form-group attr-group">-->
                <!--                    <div class="attr-size" id="attribute_0">颜色</div>-->
                <!--                    <div class="form_new_r" id="attribute-0" style="margin-left: 2px;">-->
                <!--                        <div class="ra1">-->
                <!--                            <input name="attribute[]" id="attribute_0-0" type="checkbox" value="蓝色" title="颜色"-->
                <!--                                   class="inputC">-->
                <!--                            <label for="attribute_0-0">蓝色</label>-->
                <!--                        </div>-->
                <!--                        <div class="ra1">-->
                <!--                            <input name="attribute[]" id="attribute_0-1" type="checkbox" value="黑色" title="颜色"-->
                <!--                                   class="inputC">-->
                <!--                            <label for="attribute_0-1">黑色</label>-->
                <!--                        </div>-->
                <!--                        <div class="ra1">-->
                <!--                            <input name="attribute[]" id="attribute_0-2" type="checkbox" value="红色" title="颜色"-->
                <!--                                   class="inputC">-->
                <!--                            <label for="attribute_0-2">红色</label>-->
                <!--                        </div>-->
                <!--                        <div class="ra1">-->
                <!--                            <input name="attribute[]" id="attribute_0-3" type="checkbox" value="黄色" title="颜色"-->
                <!--                                   class="inputC">-->
                <!--                            <label for="attribute_0-3">黄色</label>-->
                <!--                        </div>-->
                <!--                        <div class="ra1">-->
                <!--                            <input name="attribute[]" id="attribute_0-4" type="checkbox" value="粉色" title="颜色"-->
                <!--                                   class="inputC">-->
                <!--                            <label for="attribute_0-4">粉色</label>-->
                <!--                        </div>-->
                <!--                        <div class="ra1">-->
                <!--                            <input name="attribute[]" id="attribute_0-5" type="checkbox" value="天蓝" title="颜色"-->
                <!--                                   class="inputC">-->
                <!--                            <label for="attribute_0-5">天蓝</label>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
            </div>
        </div>
    </div>
</div>
<?php JsBlock::begin(); ?>
<script>
    $(".form_new_r .ra1 input:checkbox").on('click', function () {
        if ($(this).is(':checked')) {
            $(this).attr('checked', '');
        } else {
            $(this).attr('checked', 'checked');
        }
    });

    $('.attributes').chosen({
        no_results_text: "没有找到结果！",//搜索无结果时显示的提示
        search_contains: true,   //关键字模糊搜索。设置为true，只要选项包含搜索词就会显示；设置为false，则要求从选项开头开始匹配
        allow_single_deselect: true, //单选下拉框是否允许取消选择。如果允许，选中选项会有一个x号可以删除选项
        disable_search: false, //禁用搜索。设置为true，则无法搜索选项。
        disable_search_threshold: 0, //当选项少等于于指定个数时禁用搜索。
        inherit_select_classes: true, //是否继承原下拉框的样式类，此处设为继承
        placeholder_text_single: '选择属性', //单选选择框的默认提示信息，当选项为空时会显示。如果原下拉框设置了data-placeholder，会覆盖这里的值。
        // width: '400px', //设置chosen下拉框的宽度。即使原下拉框本身设置了宽度，也会被width覆盖。
        max_shown_results: 1000, //下拉框最大显示选项数量
        placeholder_text_multiple: '请选择属性',
        display_disabled_options: false,
        single_backstroke_delete: false, //false表示按两次删除键才能删除选项，true表示按一次删除键即可删除
        case_sensitive_search: false, //搜索大小写敏感。此处设为不敏感
        group_search: true, //选项组是否可搜。此处搜索不可搜
        include_group_label_in_selected: true //选中选项是否显示选项分组。false不显示，true显示。默认false。
    }).change(function (event, params) {
        chosenAttr(this, params)
    });


    // 属性选择
    function chosenAttr(el, params) {
        var selected = true;
        if (params.hasOwnProperty('deselected')) {
            selected = false;
            var attrId = params.deselected;
        }
        if (params.hasOwnProperty('selected')) {
            selected = true;
            attrId = params.selected;
        }

        if (attrId) {
            if (selected) {
                createDiv(el, attrId);
            } else {
                $("#attr_group_" + attrId).remove();
            }
        } else {
            $('.attr-list').empty();
        }
    }

    function createDiv(el, attrId) {
        var $select = $(el).find('option[value="' + attrId + '"]');
        var params = $select.data('segments');
        if (!params) return;
        var displayType = $select.data('display');
        var unit = $select.data('unit');
        var attrName = $select.text();
        var idStr = 'attribute_' + attrId;
        var gidStr = 'attr_group_' + attrId;
        var str = '<div class="form-group attr-group" id="' + gidStr + '">' +
            '<div class="attr-size" id="">' + attrName + '</div>' +
            '<div class="form_new_r" id="' + idStr + '" style="margin-left: 2px;">';
        if (displayType !== 'select') {
            params = [{index: 0, sort: 0, name: params + unit}];
        }
        for (var i = 0; i < params.length; i++) {
            var param = params[i];
            var sid = idStr + '-' + param.index;
            str += '<div class="ra1">' +
                '<input name="attribute[]" id="' + sid + '" type="checkbox" value="黑色" title="颜色" class = "inputC" > ' +
                '<label for="' + sid + '">' + param.name + '</label>' +
                '</div>';
        }

        str += '</div></div>';
        $('.attr-list').append($(str));
    }
</script>
<?php JsBlock::end(); ?>
