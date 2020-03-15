<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $alias
 * @property string $sort
 * @property string $remark
 * @property string $created_at
 * @property string $updated_at
 */
class Category extends \common\components\BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id', 'parent_id', 'sort', 'created_at', 'updated_at', 'type'], 'integer'],
            [['name', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent Id'),
            'name' => Yii::t('app', 'Name'),
            'sort' => Yii::t('app', 'Sort'),
            'type' => Yii::t('app', 'Type'),
            'remark' => Yii::t('app', 'Remark'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ]);
    }

    public function getNameFormat()
    {
        return $this->parent_id ? '　├' . $this->name : $this->name;
    }

    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }

    public static function findCate($name)
    {
        return self::findOne(['name' => $name]);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->parent_id == NULL || $this->parent_id == '') {
            $this->parent_id = 0;
        }

        return true;
    }
}
