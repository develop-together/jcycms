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
        -moz-user-select:none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }

    .form_new_r .ra1 label {
        width: 65px !important;
        padding-left: 20px;
        margin: auto;
        height: 36px;
        display: block;
        line-height: 36px;
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

    .clear:after {
        content: "";
        display: block;
        height: 0;
        clear: both;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <div class="ibox-title">
                <h3>添加属性</h3>
            </div>
            <div class="ibox-content">
                <div class="form-group clear">
                    <div class="pull-left" style="width: 120px;height: 34px;line-height: 34px;">
                        <label for="">请选择属性名称：</label>
                    </div>
                    <div class="pull-left">
                        <select name="" id="attributes" class="form-control" style="width:280px">
                            <?php if ($attributes): ?>
                                <?php foreach ($attributes as $gid => $attribute): ?>
                                    <optgroup label="<?= $attribute['name'] ?>" data-gid="<?= $gid ?>">
                                        <?php foreach ($attribute['attributes'] as $key => $option): ?>
                                            <option value="<?= $option['id'] ?>"
                                                    data-segments="<?= $option['segments'] ?>"><?= $option['name'] ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="attr-size" id="attribute_0">颜色</div>
                    <div class="form_new_r" id="attribute-0" style="margin-left: 2px;">
                        <div class="ra1">
                            <input name="attribute[]" id="attribute_0-0" type="checkbox" value="蓝色" title="颜色"
                                   class="inputC">
                            <label for="attribute_0-0">蓝色</label>
                        </div>
                        <div class="ra1">
                            <input name="attribute[]" id="attribute_0-1" type="checkbox" value="黑色" title="颜色"
                                   class="inputC">
                            <label for="attribute_0-1">黑色</label>
                        </div>
                        <div class="ra1">
                            <input name="attribute[]" id="attribute_0-2" type="checkbox" value="红色" title="颜色"
                                   class="inputC">
                            <label for="attribute_0-2">红色</label>
                        </div>
                        <div class="ra1">
                            <input name="attribute[]" id="attribute_0-3" type="checkbox" value="黄色" title="颜色"
                                   class="inputC">
                            <label for="attribute_0-3">黄色</label>
                        </div>
                        <div class="ra1">
                            <input name="attribute[]" id="attribute_0-4" type="checkbox" value="粉色" title="颜色"
                                   class="inputC">
                            <label for="attribute_0-4">粉色</label>
                        </div>
                        <div class="ra1">
                            <input name="attribute[]" id="attribute_0-5" type="checkbox" value="天蓝" title="颜色"
                                   class="inputC">
                            <label for="attribute_0-5">天蓝</label>
                        </div>
                    </div>
                </div>
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
    })
</script>
<?php JsBlock::end(); ?>
