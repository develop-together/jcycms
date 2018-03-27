<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\components\Utils;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property integer $type
 * @property string $parent_id
 * @property string $name
 * @property string $url
 * @property string $icon
 * @property string $byt_menucol
 * @property string $sort
 * @property string $target
 * @property integer $is_absolute_url
 * @property integer $is_display
 * @property integer $method
 * @property string $created_at
 * @property string $updated_at
 */
class Menu extends \common\models\Menu
{

	public static function getDrowDownList($tree=[], &$result=[], $deep=0, $separator = "　　")
	{
		$deep++;
		foreach ($tree as $list) {

			$result[$list['id']] = $deep == 1 ? str_repeat($separator, $deep-1) . $list['name'] : str_repeat($separator, $deep-1) . '├' . $list['name'];
			if (isset($list['children'])) {
				self::getDrowDownList($list['children'], $result, $deep);
			}
		}

		return $result;
	}

	private function chilrdenDatas($data, $parent_id, $lv=0)
	{
		$result = [];
		foreach ($data as $key => $value) {
			if ($value['parent_id'] == $parent_id) {
				$value['lv'] = $lv;
				$result[] = $value;
				$result = array_merge($result, $this->chilrdenDatas($data, $value['id'], $lv+1));
			}
		}

		return $result;
	}

	public function scenarios()
	{
		return parent::scenarios();
	}

	public static function getBackendMenus()
	{
		$data = self::find()
			->where(['is_display' => self::DISPLAY_SHOW, 'type' => self::MENU_TYPE_BACKEND])
			->orderBy(['id' => SORT_ASC, 'sort' => SORT_DESC])
			->asArray()
			->all();

       return self::recurrenceCreateMenu(Utils::tree_bulid($data, 'id', 'parent_id'));
	}

	private static function recurrenceCreateMenu($tree)
	{
		$listr = '';
		foreach ($tree as $list) {
			$childrenStr = '';
			if ($list['parent_id'] > 0) {
				continue;
			}

			$url = self::generateUrl($list['url'], $list['is_absolute_url']);
			$listr .= '<li><a href=" '. $url . ' " class="J_menuItem"><i class="fa ' . $list['icon'] . '"></i><span class="nav-label">' . $list['name'] . '</span>';
			if(isset($list['children'])) {
				 $listr = str_replace($url, 'javascript:;', $listr);
				 $listr .= '<span class="fa arrow"></span>';
				 $childrenStr = self::recurrenceCreateSubMenu($list['children']);
			}

			$listr .= '</a>' . $childrenStr . '</li>';
		}

		return $listr;
	}

	private static function recurrenceCreateSubMenu($tree, $deep=2)
	{
		$childrenStr = '';
		$levelArray = ['2' => 'second', '3' => 'third', '4' => 'fourth', '5' =>'fifth'];
		$level = $levelArray[$deep];
		$collapse = $deep > 2 ? 'collapse' : '';
		$childrenStr .= '<ul class="nav nav-' . $level . '-level ' . $collapse . '">';
		foreach ($tree as $value) {
			$url = self::generateUrl($value['url'], $value['is_absolute_url']);
			$childrenStr .= '<li><a class="J_menuItem" href="' . $url . '" data-index="' . $deep . '">' . $value['name'];
			if(isset($value['children'])) {
				$childrenStr = str_replace($url, 'javascript:;', $childrenStr);
				$childrenStr .= '<span class="fa arrow"></span>';
				$childrenStr .= '</a>' . self::recurrenceCreateSubMenu($value['children'], $deep+1) . '</li>';
			} else {
				$childrenStr .= '</a></li>';
			}
			
		}
		return $childrenStr .= '</ul>';
	}

	private static function generateUrl($url, $is_absolute_url=0)
	{
		if($url == '')
		{
			return '';
		} elseif($is_absolute_url == 1) {
			return $url;
		} else {
			return Url::toRoute([$url]);
		}
	}

	public static function getMenuZtree(&$tree = [], $url = '')
	{
        foreach ($tree as $key => $value) {
            $value['data-url'] = isset($value['url']) && !empty($value['url']) ? $value['url'] : $url;
            $value['url'] = 'javascript:;';
            $value['open'] = true;
            if (isset($value['children'])) {
                self::getMenuZtree($value['children']);
            }  

            $tree[$key] = $value;        
        }

        return $tree;
	}
}
