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
			->where(['type' => self::MENU_TYPE_BACKEND])
			->orderBy(['id' => SORT_ASC, 'sort' => SORT_DESC])
			->asArray()
			->all();
/*        <li>
            <a href="#">
                <i class="fa fa-users"></i>
                <span class="nav-label">用户</span> 
                <span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level">
                <li>
                    <a class="J_menuItem" href="javascript:;" >前台用户</a>
                </li>
                <li>
                <a class="J_menuItem" href="">后台用户<span class="fa arrow"></span></a>
                <ul class="nav nav-third-level collapse">
                    <li>
                        <a class="J_menuItem" href="<?=url::toRoute(['admin-user/index'])?>" >管理员</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?=url::toRoute(['admin-roles/index'])?>">角色</a>
                    </li>
                </ul>
                </li>
            </ul>

        </li>*/
       return self::_recurrenceCreateMenu(Utils::tree_bulid($data, 'id', 'parent_id'));
	}

	private static function _recurrenceCreateMenu($tree, &$listr='')
	{
		foreach ($tree as $list) {
			$url = Url::toRoute([$list['url']]);
			$listr .= '<li><a href=" '. $url .' "><i class="fa ' . $list['icon'] . '"></i><span class="nav-label">' . $list['name'] . '</span>';
			$childrenStr = '';
			if (isset($list['children'])) {
				$listr = str_replace($url, 'javascript:;', $listr);
				$listr .= '<span class="fa arrow"></span>';
				// self::_recurrenceCreateMenu($list['children']);
				$childrenStr .= '<ul class="nav nav-second-level">';
				foreach ($list['children'] as $value) {
					$childrenStr .= '<li><a class="J_menuItem" href="">' . $value['name']. '</a></li>';
				}

				$childrenStr .= '</ul>';
			}

			$listr .= '</a></li>';
		}

		return $listr;
	}

}
