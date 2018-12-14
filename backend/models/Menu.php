<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\components\Utils;
use common\components\TreeHelper;
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

	const DEFAULT_URL = 'javascript:;';

	public $isAddRoute = 0;

	protected function chilrdenDatas($data, $parent_id, $lv = 0)
	{
		$tree = new TreeHelper($data, true, 2, [
			'fpid' => $parent_id,
			'root' => $lv
		]);

		return $tree->getTree();

	}

	protected function chilrdenDatasToObject($object, $parent_id, $lv = 0)
	{
		$tree = new TreeHelper($object, true, 3,  [
			'fpid' => $parent_id,
			'root' => $lv
		]);

		return $tree->getTree();
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

	public static function loadMenus($adminRolePermissionLists = [], $role_id)
	{
		$query = self::getBackendQuery();
        $menuData =  Utils::tree_bulid($query->orderBy(['sort' => SORT_ASC])                       
                    ->asArray()
                    ->all(), 'id', 'parent_id');

        return self::getMenuZtree($adminRolePermissionLists, $role_id, $menuData);
	}

	protected static function getMenuZtree($adminRolePermissionLists = [], $role_id = 0, &$tree = [], $url = '', $mode = 'roles')
	{
        foreach ($tree as $key => $value) {
            // $value['data-url'] = isset($value['url']) && !empty($value['url']) ? $value['url'] : $url;
            $value['url'] = 'javascript:;';
            // $value['open'] = false;
            if ($mode == 'roles' && $role_id == AdminRoles::SUPER_ROLE_ID) {
            	// $value['chkDisabled'] = true;
            	$value['checked'] = true;
            } elseif ($adminRolePermissionLists) {
            	foreach ($adminRolePermissionLists as $list) {
            		if ($list['menu_id'] == $value['id']) {
            			$value['checked'] = true;
            		}
            	}
            }
            $value['roles'] = self::findOne($value['id'])->roles;
            if (isset($value['children'])) {
                self::getMenuZtree($adminRolePermissionLists, $role_id, $value['children']);
            }  
            unset($value['icon']);
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

	public function getRoles()
	{
		return $this->hasMany(AuthItem::className(), ['menu_id' => 'id']);
	}

    public function afterSave($insert, $changedAttributes)
    {

        if ($this->isAddRoute && !$this->isCorrect) {
            $rabcModel = AuthItem::findOne(['menu_id' => $this->id]);
            $rabcModel = $rabcModel ? $rabcModel : new AuthItem();
            $rabcModel->menu_id = $this->id;
            $rabcModel->rule_name = Url::toRoute($this->url);
            $rabcModel->method = strtoupper($this->methodFormat);
            $rabcModel->rule_format = $rabcModel->rule_name  . ':' . $rabcModel->method;
            $rabcModel->description = $this->name . '(查看)';
            $rabcModel->save();
        }        

        parent::afterSave($insert, $changedAttributes);
    }
}
