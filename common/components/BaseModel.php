<?php

namespace common\components;

use Yii;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\behaviors\TimestampBehavior;

/**
 * base model
 */
class BaseModel extends \yii\db\ActiveRecord {

	public static function getDb()
	{
		return Yii::$app->get('db');
	}

	public function behaviors() {
		$behaviors = [];
		if ($this->hasAttribute('created_at') && $this->hasAttribute('updated_at')) {
			$behaviors[] = TimestampBehavior::className();
		}
		return $behaviors;
	}

	public function attributeLabels()
	{
		return [
			'create_at' => '创建时间',
			'update_at' => '修改时间',
		];
	}

    public function image($attribute = '', $htmlOptions = [])
    {
        $src = $this->path($attribute);
        $alt = isset($htmlOptions['alt']) ? $htmlOptions['alt'] : '';
        return Html::image($src, $alt, $htmlOptions);
    }

    /**
     * 系统上传的图片、文件地址
     * @param  string $attribute 
     * @return string            
     */
    public function path($attribute = '')
    {
        return Utils::photoUrl($this->$attribute);
    }

	/**
     * 验证有错误时输出给前端回调函数
     * @return [type] [description]
     */
    public function afterValidate()
    {
    	if ($this->hasErrors()) {
    		$message = '<strong>以下表单填写有误:</strong><br>';
			foreach ($this->getErrors() as $value) {
				$message .= implode(",", $value) . '<br>';
			}

			Yii::$app->getSession()->setFlash('error', $message);  

    	}
    }

    /**
     * 保存数据前统一处理
     * @return boolean true为可保存， false不可保存
     */
    public function beforeSave($insert) 
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        return true;
    }

    public function getStatusFormat()
    {
        $statusOption = BaseConfig::statusOption();
        if ($this->hasAttribute('status')) {
            return $statusOption[$this->status];
        }
    }	

}