<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
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
}
