<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

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
            [['carousel_id'], 'required'],
            [['carousel_id', 'status', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['url', 'caption', 'image'], 'string', 'max' => 255],
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
            'url' => 'Url',
            'caption' => 'Caption',
            'image' => 'Image',
            'status' => 'Status',
            'sort' => 'Sort',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarousel()
    {
        return $this->hasOne(Carousel::className(), ['id' => 'carousel_id']);
    }
}
