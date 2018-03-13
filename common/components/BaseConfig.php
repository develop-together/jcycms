<?php 

namespace common\components;

/**
* 基础数据配置类
* @author atuxe <atuxe@boyuntong.com>
*/
class BaseConfig
{

	public static function statusOption()
	{
		return ['1'=>'激活', '2'=>'锁定',];
	}

	/**
	 * 权限与action对应列表
	 * @return array
	 */
	public static function aclList()
	{
		return [];
	}
}
