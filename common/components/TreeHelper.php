<?php

/**
 * @description: 树相关操作助手类
 * @param _array 需要生成树的数组
 * @param _create 仅当为true是会创建树
 * @param _createMode 生成树的方式
 * @param _tree 树
 * @param _options 生成树需要的配置 比如上级id的键
 * @createdAt 2018-08-01 22:33:00
 * @author: jcy
 */

namespace common\components;

use yii\helpers\ArrayHelper;

class TreeHelper
{

    private $_array = [];
    private $_create = true;
    private $_createMode = 1;
    private $_tree = [];
    private $_options = [
        'fpid' => null,
        'pk' => 'id',
        'pidKey' => 'parent_id',
        'childKey' => 'children',
        'root' => 0,
    ];

    public function __construct($array, $create = true, $createMode = 1, $options = [])
    {
        $this->_create = $create;
        $this->_createMode = (int)$createMode;
        if (!$this->_create) {
            $this->_tree = $array;
        } else {
            $this->_array = $array;
            !empty($options) && $this->_options = ArrayHelper::merge($this->_options, $options);
            $this->_tree = $this->createTree();
        }

    }

    public function __set($proName, $proVal)
    {
        $this->proName = $proVal;
    }

    public function __get($proNanme)
    {
        if (!isset($proNanme)) {
            return $this->proNanme;
        }

        return null;
    }

    public function getTree()
    {
        return $this->_tree;
    }

    public function setTree($tree)
    {
        $this->_tree = $tree;
    }

    /**
     * 生成树
     * @return [Array] [树的结果]
     */
    public function createTree()
    {
        $options = $this->_options;
        if ($this->_createMode === 1) {
            return Utils::reference_delivery_tree($this->_array, $options['pk'], $options['pidKey'], $options['childKey'], $options['root']);
        } elseif ($this->_createMode === 2) {
            return $this->spanningTree($this->_array, $options['fpid'], $options['root']);
        } elseif ($this->_createMode === 3) {
            return $this->spanningObjectTree($this->_array, $options['fpid'], $options['root']);
        } elseif ($this->_createMode === 4) {
            return $this->createObjectTree($this->_array, $options['fpid'], $options['root']);
        }

        return [];
    }

    /**
     * [递归创建子孙树]
     * @param  [Array]  $data      [数据源]
     * @param  [int]  $parent_id [默认从最远的根开始]
     * @param integer $lv [排序]
     * @return [Array]             [tree]
     */
    public function spanningTree($data, $parent_id = null, $lv = 0)
    {
        $result = [];
        // $pidKey = isset($this->options['pidKey']) ? $this->options['pidKey'] 'parent_id';
        foreach ($data as $key => $value) {
            if ($value[$this->_options['pidKey']] == $parent_id) {
                $value['lv'] = $lv;
                $result[] = $value;
                $result = array_merge($result, $this->spanningTree($data, $value['id'], $lv + 1));
            }
        }

        return $result;
    }

    /**
     * [递归创建子孙树-对象]
     * @param  [Object]  $object      [数据源]
     * @param  [int]  $parent_id [默认从最远的根开始]
     * @param integer $lv [排序]
     * @return [Array Object]             [对象数组]
     */
    public function spanningObjectTree($object, $parent_id, $lv = 0)
    {
        $result = [];
        foreach ($object as $obj) {
            if ($obj->parent_id == $parent_id) {
                $obj->lv = $lv;
                $result[] = $obj;
                $result = array_merge($result, $this->spanningObjectTree($object, $obj->id, $lv + 1));
            }
        }

        return $result;
    }

    /**
     * [递归创建子孙树-对象 2]
     * @param  [type] $object    [数据源]
     * @param  [type] $parent_id [默认从最远的根开始]
     * @param  [type] $lv        [排序]
     * @return [type]            [对象数组]
     */
    public function createObjectTree($object, $parent_id, $lv)
    {
        $result = [];
        foreach ($object as $obj) {
            if ($obj->parent_id == $parent_id) {
                $obj->lv = $lv;
                $result[] = $obj;
                $obj->childrens = $this->createObjectTree($object, $obj->id, $lv + 1);
            }
        }

        return $result;
    }

    /**
     * [递归创建家谱树]
     * @param  [Array] $data [数据源]
     * @param  [type] $id   [description]
     * @return [Array]       [description]
     */
    public function spanningParentTree($id, $data = [])
    {
        !$data && $data = $this->_array;
        $result = [];
        foreach ($data as $key => $da) {
            if ($da['id'] == $id) {
                $result[] = $da;// 这种结果是从到自己祖父节点
                if ($da['parent_id']) {
                    $result = array_merge($result, $this->spanningParentTree($da['parent_id'], $data));
                }
                // $result[] = $da;// 这种结果是从祖父节点到自己
            }
        }

        return $result;
    }
}
