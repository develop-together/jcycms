<?php 
namespace common\components;
use Yii;
use backend\models\User;
use backend\models\AdminRoleUser;
use backend\models\Menu;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class UserAcl
{
	/**
	 * 公共权限
	 * @return array 
	 */
	public static function publicAclList()
	{
		return [
			'site/index:GET',
			'site/desktop:GET', 
			'site/test:GET',
			'public/captcha:GET',
			'public/logout:GET',
			'public/login:GET',
			'public/login:POST',
			'admin-user/info:GET',
			'admin-user/info:POST',
		];
	}	

	public static function hasAcl($acl, $userId=0)
	{
		empty($userId) && $userId = Yii::$app->user->id;
		if (Yii::$app->user->id == User::SUPER_MANAGER) {
			return true;
		}		

		$user = User::findOne($userId);

		return !empty($user) && $user->hasAcl($acl);
	}

	/**
	 * 当前登录用户拥有的权限列表 
	 * @return [type] [description]
	 */
	public static function filterAclist($userId=0)
	{
		empty($userId) && $userId = Yii::$app->user->id;
		return self::getBackendMenus($userId);
	}

	/**
	 * 当前登录用户拥有的权限列表----格式化 
	 * @return [type] [description]
	 */
	public static function filterAclListFormat($userId=0) 
	{
		$user = User::findOne($userId);
		return $user->aclList;
	}

	public static function getBackendMenus($userId=0)
	{
		!$userId && $userId = Yii::$app->user->id;
		$query = Menu::getBackendQuery(true);
		$data = $query->orderBy(['sort' => SORT_ASC, 'id' => SORT_DESC])->asArray()->all();
		$tree = new TreeHelper($data, true, 2);
		if ($userId != User::SUPER_MANAGER && $data) {
			$user = User::findOne($userId);
			$newData = [];
			foreach ($data as $key => $value) {
				if (empty($value['url']) || (strpos($value['url'], 'javascript') !== false) || ($value['url'] === '/')) {
					continue;
				}
				$route = $value['url'] . ':GET';
				if ($user->hasAcl($route)) {
					$parentTree = $tree->spanningParentTree($value['id'], $data);
					$newData = array_merge($newData, $parentTree);
				}
			}
		}

       	return self::recurrenceCreateMenu(Utils::tree_bulid(Utils::mult_unique($newData), 'id', 'parent_id'));
	}

	private static function recurrenceCreateMenu($tree)
	{
		$str = '';
		foreach ($tree as $list) {
			$childrenStr = $listr = '';
			if ($list['parent_id'] > 0) {
				continue;
			}

			$url = Menu::generateUrl($list['url'], $list['is_absolute_url']);
			$listr .= '<li><a  class="J_menuItem" href=" '. $url . ' "><i class="fa ' . $list['icon'] . '"></i><span class="nav-label">' . $list['name'] . '</span>';
			if(isset($list['children'])) {
				 $listr = str_replace($url, 'javascript:;', $listr);
				 $listr = str_replace('J_menuItem', '', $listr);
				 $listr .= '<span class="fa arrow"></span>';
				 $childrenStr = self::recurrenceCreateSubMenu($list['children']);
			}

			$str .= $listr .= '</a>' . $childrenStr . '</li>';
		}

		return $str;
	}

	private static function recurrenceCreateSubMenu($tree, $deep=2)
	{
		$childrenStr = '';
		$levelArray = ['2' => 'second', '3' => 'third', '4' => 'fourth', '5' =>'fifth'];
		$level = $levelArray[$deep];
		$collapse = $deep > 2 ? 'collapse' : '';
		$childrenStr .= '<ul class="nav nav-' . $level . '-level ' . $collapse . '">';
		foreach ($tree as $value) {
			$url = Menu::generateUrl($value['url'], $value['is_absolute_url']);
			$childrenStr .= '<li><a class="J_menuItem" href="' . $url . '" data-index="' . $deep . '">' . $value['name'];
			if(isset($value['children'])) {
				$childrenStr = str_replace($url, 'javascript:;', $childrenStr);
				// $childrenStr = str_replace('class="J_menuItem"', '', $childrenStr);
				$childrenStr .= '<span class="fa arrow"></span>';
				$childrenStr .= '</a>' . self::recurrenceCreateSubMenu($value['children'], $deep+1) . '</li>';
			} else {
				$childrenStr .= '</a></li>';
			}
			
		}
		return $childrenStr .= '</ul>';
	}

    public static function getRoleId($uid = '')
    {
        $uid = empty($uid) ? yii::$app->user->id : $uid;

        return AdminRoleUser::findOne(['user_id' => $uid])->role->id;
    }

}
