<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\helpers\FileHelper;
use common\components\Utils;
use common\components\BaseConfig;
use common\components\ImageHelper;

class Ad extends \common\models\Options
{

	const INPUT_TYPE_IMAGE = 1;
	const INPUT_TYPE_VIDEO = 2;

	public $description;
	public $url;
	public $imgUrl;
    public $thumbUrl = '';
	public $size;
	public $width;
	public $height;
	public $target;
    
    public function rules()
    {
        return [
            [['title', 'name'], 'required'],
            [['type', 'input_type', 'created_at', 'updated_at'], 'integer'],
            [['name', 'target', 'description', 'url'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1],
            [['width', 'height'], 'safe'],
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
    		// self::INPUT_TYPE_VIDEO => 'video'
    	];
    }

    public function getAdTypeFormat()
    {
        $items = self::loadAdTypes();

        return key_exists($this->input_type, $items) ? $items[$this->input_type] : $this->input_type;
    }

    public function getImgFormat()
    {
        $src = Yii::$app->request->baseUrl  . '/' . $this->imgUrl;
        if ($this->thumbUrl) {
            $src = Yii::$app->request->baseUrl  . '/' . $this->thumbUrl;
        }

        return Html::img($src, ['width' => 200]);
    }

    public function getStatusFormat()
    {
        return BaseConfig::getStatusItems($this->status);
    }

    public function beforeSave($insert)
    {
    	if (!parent::beforeSave($insert)) {
    		return false;
    	}

        $this->imgUrl = $this->uploadOperate('imgUrl', '@ad' . '/' . date('Ymd') . '/', 'Image');
        if (!$insert) {
            $imgUrl = $this->getOldAttribute('imgUrl');
            $thumbUrl = $this->getOldAttribute('thumbUrl');
            $imgPath = Yii::getAlias('@backend') . '/web/' . $imgUrl;
            $thumbPath = Yii::getAlias('@backend') . '/web/' . $thumbUrl;
            if ($thumbUrl && file_exists($thumbPath)) {
                FileHelper::unlink($thumbPath); 
                $this->thumbUrl = '';
            }

            if ((!empty($this->width) && $this->width != $this->getOldAttribute('width')) || (!empty($this->height) && $this->height != $this->getOldAttribute('height'))) {
                $imageHelper = new ImageHelper();
                $this->thumbUrl = $imageHelper->thumbnail($imgPath, $this->width, $this->height); 
            }

            if ($imgUrl && $imgUrl != $this->imgUrl && file_exists($imgPath)) {
                FileHelper::unlink($imgPath);  
            }
        }

        if (empty($this->imgUrl)) {
            return false;
        }

    	if ($insert) {
    		$this->type = self::TYPE_AD;
    	}

        $values = [
            'description' => $this->description,
            'url' => $this->url,
            'imgUrl' => $this->imgUrl,
            'thumbUrl' => $this->thumbUrl,
            'target' => $this->target,
            'width' => $this->width,
            'height' => $this->height,
        ];

        $this->value = Json::encode($values);

    	return true;
    }

    public function afterFind()
    {
        $value = Json::decode($this->value, false);

        $this->imgUrl = $value->imgUrl;
        $this->url = $value->url;
        $this->description = $value->description;
        $this->imgUrl = trim($value->imgUrl);
        $this->thumbUrl = trim($value->thumbUrl);
        $this->target = $value->target;
        $this->width = $value->width;
        $this->height = $value->height;

        $this->setOldAttributes([
            'id' => $this->id,
            'name' => $this->name,
            'title' => $this->title,
            'input_type' => $this->input_type,
            'sort' => $this->sort,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'imgUrl' => $value->imgUrl,
            'thumbUrl' => $value->thumbUrl,
            'url' => $value->url,
            'description' => $value->description,
            'target' => $value->target,
            'width' => $value->width,
            'height' => $value->height,
        ]);
    }
}
