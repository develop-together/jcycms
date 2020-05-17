<?php

/**
 * @var $this yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use yii\helpers\Html;
use yii\helpers\Url;
use backend\grid\GridView;
use common\widgets\JsBlock;

?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('@backend/views/widgets/_ibox-index-title') ?>
            <div class="ibox-content">
                <div class="mail-tools tooltip-demo m-t-md" style="padding-bottom: 10px;">
                    <?= (isset($searchModel)) ? $this->render('_search', ['model' => $searchModel]) : '' ?>
                </div>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        [
                            'class' => 'yii\grid\CheckboxColumn'
                        ],
                        'spu_code',
                        [
                            'attribute' => 'images',
                            'format' => 'raw',
                            'enableSorting' => false,
                            'value' => function ($searchModel) {
                                return $searchModel->layerPhotos;
                            }
                        ],
                        'title',
                        [
                            'attribute' => 'cid3',
                            'value' => function($searchModel) {
                                return $searchModel->cname;
                            },
                        ],
                        'brand_name',
                        'stock',
                        [
                            'attribute' => 'flag_saleable',
                            'class' => \backend\grid\StatusColumn::className(),
                        ],
                        'weight',
                        'dim',
                        // 'saleable',
                        // 'valid',
                        // 'image_ids',
                        // 'sort',
                        'created_at',
                        // 'updated_at',
                        // 'deleted_at',
                        [
                            'class' => 'backend\grid\ActionColumn',
                            'template' => '{update}{copy}{delete}',
                            'buttons' => [
                                'copy' => function ($url, $searchModel) {
                                    return Html::a('<i class="fa fa-copy"></i> ' . Yii::t('app', 'Copy'), Url::toRoute(['mall-spu/copy', 'id' => $searchModel->id]), [
                                        'title' => Yii::t('app', 'Copy'),
                                        'class' => 'btn btn-white btn-sm',
                                    ]);
                                }
                            ]
                        ],
                    ]
                ]); ?>
            </div>
        </div>
    </div>
</div>
<style>
    .photos_list_count {
        left: 65px;
        margin-bottom: -15px;
    }
</style>
<?php JsBlock::begin(); ?>
<script>
    // 点击分类框
    var selectDiv = {
        selectFlag: true,//判断点击分类框请求有没有完成,没完成继续点击不会再次请求
        choseClass: true,//判断选择分类请求有没有完成,没完成继续点击不会再次请求
        selectDivDom: $('.selectDiv'),
        selectDataDom: $("#selectData"),
        selectDataOneDom: $("#selectData_1"),
        selectTextDom: $('.selectDiv').find("div#div_text"),
        selectDelSelDom: $('.del_sel'),
        brandDom: $("#mallspusearch-brand_id"),
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
        initCateBrand: function () {
            var that = this;
            var cid = parseInt('<?= $searchModel->cid3 ?>');
            var brandId = parseInt('<?= $searchModel->brand_id?>');
            var url = that.selectDivDom.data('url');
            if (cid) {
                that.selectDivDom.find('option').text('').attr('value', cid);
                $(this).addClass('active').siblings().removeClass('active');
                that.request(url, 'GET', {
                    cid: cid,
                    brandId: brandId
                }, function (response) {
                    if (response.code === 10002) {
                        that.brandDom.empty();
                        that.selectDataOneDom.empty();
                        var catalogList = response.catalogList;
                        var brandList = response.brandList;
                        that.createLiList(that.selectDataOneDom, catalogList, 'id', 'name');
                        that.createOptions(that.brandDom, brandList, 'id', 'name', brandId, '请选择品牌');
                    }
                }, function (XHR, TS) {
                    that.choseClass = true;
                })
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
            $(dom).empty();
            key = key || 'id';
            vKey = vKey || 'value';
            selected = selected || null;
            tips = tips || null;
            var str = '';
            if (tips) str = '<option value="">' + tips + '</option>';
            for (var i = 0; i < data.length; i++) {
                var da = data[i];
                var selectedStr = da[key] == selected ? 'selected' : '';
                str += "<option value='" + da[key] + "' " + selectedStr + ">" + da[vKey] + "</option>";
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
            that.selectDivDom.find('option').text('').attr('value', cid);
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


    // 初始化分类和品牌
    selectDiv.initCateBrand();
</script>
<?php JsBlock::end(); ?>

