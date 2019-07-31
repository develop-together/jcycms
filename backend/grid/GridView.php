<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-03-21 18:45
 */

namespace backend\grid;

use yii;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;
use backend\assets\GridViewAsset;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\BaseListView;

/**
 * @inheritdoc
 */
class GridView extends \yii\grid\GridView
{

    public $options = ['class' => 'fixed-table-header', 'style' => 'margin-right: 0px;'];

    public $tableOptions = ['class' => 'table table-hover table-bordered'];

    // public $layout = "{items}\n{pager}";
    public $layout = "{items}\n<div class='row'><div class='col-sm-3' style='height: 74px;line-height: 74px;'>{summary}</div><div class='col-sm-6' style='height: 74px;line-height: 74px;'><div class='dataTables_paginate paging_simple_numbers'>{pager}</div></div><div class='col-sm-3' style='height: 74px;line-height: 74px;'>{changePage}</div></div>";

    public $changePageOptions = [5, 10, 20, 50];

    public $pagerOptions = [
        'firstPageLabel' => '首页',
        'lastPageLabel' => '尾页',
        'prevPageLabel' => '上一页',
        'nextPageLabel' => '下一页',
        'options' => [
            'class' => 'pagination',
        ],
    ];

    public $filterRow;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $changePageHtml = '';
        $params = Yii::$app->request->get();
        $pageSize = isset($params['pageSize']) ? $params['pageSize'] : 10;
        foreach ($this->changePageOptions as $option) {
            $selected = $pageSize == $option ? 'selected' : '';
            $changePageHtml .= '<option value=\'' . $option . '\' ' . $selected . '>' . $option . '</option>';
        }

        $this->layout = str_replace('{changePage}', "<div class='pull-right' ><span>" . Yii::t('app', 'Each page') . "" . Yii::t('app', 'Display') . "</span><select class='form-control change-page-size' style='width:100px;display:inline !important'>{$changePageHtml}</select><span>" . Yii::t('app', 'Bar') . "</span></div>", $this->layout);

        $this->pagerOptions = [
            'firstPageLabel' => Yii::t('app', 'first'),
            'lastPageLabel' => Yii::t('app', 'last'),
            'prevPageLabel' => Yii::t('app', 'previous'),
            'nextPageLabel' => Yii::t('app', 'next'),
            'options' => [
                'class' => 'pagination',
            ],
        ];
        parent::init();

        $this->rowOptions = function ($model, $key, $index, $grid) {
            if ($index % 2 === 0) {
                return ['class' => 'odd'];
            } else {
                return ['class' => 'even'];
            }
        };
        $this->pagerOptions = [
            'firstPageLabel' => Yii::t('app', 'first'),
            'lastPageLabel' => Yii::t('app', 'last'),
            'prevPageLabel' => Yii::t('app', 'previous'),
            'nextPageLabel' => Yii::t('app', 'next'),
            'options' => [
                'class' => 'pagination',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function renderTableRow($model, $key, $index)
    {
        if ($this->filterRow !== null && call_user_func($this->filterRow, $model, $key, $index, $this) === false) {
            return '';
        }
        return parent::renderTableRow($model, $key, $index);
    }

    /**
     * @inheritdoc
     */
    public function renderPager()
    {
        $pagination = $this->dataProvider->getPagination();
        if ($pagination === false || $this->dataProvider->getCount() <= 0) {
            return '';
        }
        /* @var $class LinkPager */
        $pager = $this->pager;
        $class = ArrayHelper::remove($pager, 'class', LinkPager::className());
        $pager['pagination'] = $pagination;
        $pager['view'] = $this->getView();
        $pager = array_merge($pager, $this->pagerOptions);
        return $class::widget($pager);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $id = $this->options['id'];
        $options = Json::htmlEncode($this->getClientOptions());
        $view = $this->getView();
        GridViewAsset::register($view);
        // $url = Url::current();
        $view->registerJs(<<<JS
            jQuery('#$id').yiiGridView($options);
            jQuery('select.change-page-size').bind('change', function() {
                var html = document.getElementsByTagName("html");
                html[0].innerHTML = '';
                var pageSize = parseInt($(this).val());
                var url = window.location.href;
                if (url.indexOf('?') > -1) {
                    var query = url.split('?');
                    url = query[0] + '?page=1&pageSize=' + pageSize;
                } else {
                    url += '?page=1&pageSize=' + pageSize;
                }

                // console.log(url);
                // jQuery(document).pjax({url: url, container: '#adminLog-pjax'});
                window.location.href = url;
                // jQuery.ajax({
                //     type: 'GET',
                //     url: '',
                //     data: {pageSize:pageSize, page: 1},
                //     success: function(response) {
                //         html[0].innerHTML = response;
                //     }
                // });
            });
JS
        );
        BaseListView::run();
    }

}