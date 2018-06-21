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

	public $lv = 0;

	protected function chilrdenDatas($data, $parent_id, $lv = 0)
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

	protected function chilrdenDatasToObject($object, $parent_id, $lv = 0)
	{
		$result = [];
		foreach ($object as $obj) {
			if ($obj->parent_id == $parent_id) {
				$obj->lv = $lv;
				$result[] = $obj;
				$result = array_merge($result, $this->chilrdenDatas($object, $obj->id, $lv+1));
			}
		}

		return $result;
	}

	public static function getBackendQuery($display=false)
	{
		$where = $display ? ['is_display' => self::DISPLAY_SHOW, 'type' => Menu::MENU_TYPE_BACKEND] : ['type' => Menu::MENU_TYPE_BACKEND];
		return self::find()->where($where);
	}

	public static function getFrontendQuery($display=false)
	{
		$where = $display ? ['is_display' => self::DISPLAY_SHOW, 'type' => Menu::MENU_TYPE_FRONTEND] : ['type' => Menu::MENU_TYPE_FRONTEND];
		return self::find()->where($where);
	}

	public static function generateUrl($url, $is_absolute_url=0)
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

	public static function getMenuZtree($adminRolePermissionLists = [], $role_id = 0,&$tree = [], $url = '', $mode = 'roles')
	{
        foreach ($tree as $key => $value) {
            $value['data-url'] = isset($value['url']) && !empty($value['url']) ? $value['url'] : $url;
            $value['url'] = 'javascript:;';
            $value['open'] = false;
            if ($mode == 'roles' && $role_id == AdminRoles::SUPER_ROLE_ID) {
            	$value['chkDisabled'] = true;
            	$value['checked'] = true;
            } elseif ($adminRolePermissionLists) {
            	foreach ($adminRolePermissionLists as $list) {
            		if ($list['menu_id'] == $value['id']) {
            			$value['checked'] = true;
            		}
            	}
            }
            if (isset($value['children'])) {
                self::getMenuZtree($adminRolePermissionLists, $role_id, $value['children']);
            }  

            $tree[$key] = $value;        
        }

        return $tree;
	}

	public function getSubMenus_format()
	{
		$datas = Yii::$app->db->createCommand("SELECT id,name,url FROM {{%menu}} WHERE is_display = '" . self::NOT_DISPLAY_SHOW . "' AND url like '" . $this->url . "/%'")->queryAll();
		$str = '';
		if ($datas) {
			foreach($datas as $data) {
				$str .= '<span style="cursor: pointer;"  title="' . $data['url'] . '">' . $data['name'] . '</span>，';
			}
		}

		return rtrim($str, '，');
	}
}
