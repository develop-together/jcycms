<?php
declare(strict_types=1);
/**
 * Created by PhpStorm
 * User: Administrator
 * Author: JieChengYang
 * Date: 2020-04-15
 * Time: 23:34
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <div class="ibox-title">
                <h3>添加属性</h3>
            </div>
            <div class="ibox-content">
                <div class="form-group">
                   <div class="pull-left" style="width: 120px;height: 34px;line-height: 34px;">
                       <label for="">请选择属性名称：</label>
                   </div>
                    <div class="pull-left">
                        <select name="" id="attributes" class="form-control" style="width:280px">
                            <optgroup label="衣服-裤子-鞋子">
                                <option value="颜色">颜色</option>
                                <option value="尺码">尺码</option>
                            </optgroup>
                            <optgroup label="手机">
                                <option value="CPU">CPU</option>
                                <option value="内存">内存</option>
                            </optgroup>
                            <optgroup label="未分类">
                                <option value="U盘规格">U盘规格</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
