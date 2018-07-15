<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\components\Utils;

class Ad extends \common\models\Options
{

	const INPUT_TYPE_IMAGE = 1;
	const INPUT_TYPE_VIDEO = 2;

	public $description;
	public $url;
	public $imgUrl;
	public $size;
	public $width;
	public $height;
	public $target;
    
    public function rules()
    {
        return [
            [['title', 'imgUrl', 'url', 'name'], 'required'],
            [['type', 'input_type', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1],
        ];
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
        	'name' => Yii::t('app', 'Advertisement Flag'),
        	'title' => Yii::t('app', 'Advertisement Name'),
        	'input_type' => Yii::t('app', 'Advertisement Type'),
        	'description' => Yii::t('app', 'Description'),
        	'url' => Yii::t('app', 'Url'),
        	'imgUrl' => Yii::t('app', 'Image'),
        	'size' => Yii::t('app', 'Size'),
        	'width' => Yii::t('app', 'Width'),
        	'height' => Yii::t('app', 'Height'),
        	'target' => Yii::t('app', 'Target'),
        ]);
    }

    public static function loadAdTypes()
    {
    	return [
    		self::INPUT_TYPE_IMAGE => 'image',
    		self::INPUT_TYPE_VIDEO => 'video'
    	];
    }

    public function getAdTypeFormat()
    {
        $items = self::loadAdTypes();

        return key_exists($this->input_type, $items) ? $items[$this->input_type] : $this->input_type;
    }

    public function beforeSave($insert)
    {
    	if (!parent::beforeSave($insert)) {
    		return false;
    	}

    	if (!$insert) {
    		$this->type = self::TYPE_AD;
    	}

    	return true;
    }
}
