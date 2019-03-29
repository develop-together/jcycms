<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use common\components\BaseConfig;

/**
 * This is the model class for table "{{%carousel}}".
 *
 * @property integer $id
 * @property string $key
 * @property string $title
 * @property integer $status
 *
 * @property CarouselItem[] $carouselItems
 */
class Carousel extends \common\components\BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%carousel}}';
    }
    
    public function behaviors()
    {

    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'title'], 'required'],
            ['key', 'unique'],
            [['status'], 'integer'],
            [['key'], 'string', 'max' => 128],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => 'ID',
            'key' => Yii::t('common', 'Name'),
            'title' => Yii::t('common', 'Description'),
            'status' => Yii::t('common', 'Active'),
            'image-list' => Yii::t('common', 'Image List'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarouselItems()
    {
        return $this->hasMany(CarouselItem::className(), ['carousel_id' => 'id']);
    }

    public function getStatusFormat()
    {
        return BaseConfig::getYesNoItems($this->status);
    }

    public function getLayerPhotos()
    {
        $carouselItems = $this->carouselItems;
        $imgs = [];
        $fPhoto = '';
        if ($carouselItems) {
            foreach ($carouselItems as $key => $photo) {
                $key == 0 && $fPhoto = Yii::$app->request->baseUrl . '/' . $photo->image;
                $imgs[] = ['alt' => $photo->caption, 'pid' => $key, "src" => Yii::$app->request->baseUrl . '/' . $photo->image, "thumb" => Yii::$app->request->baseUrl . '/' . $photo->image];
            } 

            $imgs_arr = ['title' => '(' . $this->title . ')','id' => $this->id, 'start' => 0, 'data' => $imgs]; 

            return '<div class="photos_list" data=\'' . Json::htmlEncode($imgs_arr) . '\'><img src="' . $fPhoto . '" style="width:200px;height:100px;"><div class="photos_list_count">共' . ($key + 1) . '张图</div></div>';       
        } else {
            return '<div style="font-size: 20px"><i class="fa-con fa fa-image" ></i></div>';
        }
    }

    public function beforeDelete()
    {
        if ($this->carouselItems) {
            $this->addError('id', Yii::t('app', 'Allowed not to be deleted, sub level exsited.'));
            return false;
        }

        return true;
    }
}
