<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\components\BaseConfig;

/**
 * This is the model class for table "{{%carousel_item}}".
 *
 * @property integer $id
 * @property integer $carousel_id
 * @property string $url
 * @property string $caption
 * @property string $image
 * @property integer $status
 * @property integer $sort
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Carousel $carousel
 */
class CarouselItem extends \common\components\BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%carousel_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['carousel_id', 'url', 'status', 'image'], 'required'],
            [['carousel_id', 'status', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['url', 'caption'], 'string', 'max' => 255],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg,gif,bmp,png', 'message' => Yii::t('common', 'Please select the picture file')],
            [['carousel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carousel::className(), 'targetAttribute' => ['carousel_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => 'ID',
            'carousel_id' => 'Carousel ID',
            'url' => Yii::t('app', 'Url'),
            'caption' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
            'status' => Yii::t('common', 'Active'),
            'sort' => Yii::t('app', 'Sort'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarousel()
    {
        return $this->hasOne(Carousel::className(), ['id' => 'carousel_id']);
    }

    public function getStatusFormat()
    {
        return BaseConfig::getYesNoItems($this->status);
    }

    public function beforeValidate()
    {
        $this->image = $this->uploadOpreate('image', '@banner/', 'Image');

        return parent::beforeValidate();
    }

    // public function beforeSave($insert) 
    // {
    //     if (!parent::beforeSave($insert)) {
    //         return false;
    //     }

        

    //     return true;
    // }
}
