<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%friend_link}}".
 *
 * @property string $id
 * @property string $name
 * @property string $image
 * @property string $url
 * @property string $target
 * @property integer $sort
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class FriendLink extends \common\components\BaseModel
{
    const TARGET_BLANK = '_blank';
    const TARGET_SELF = '_self';
    const TAGET_PARENT = '_parent';
    const TAGET_TOP = '_top';
    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%friend_link}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['sort', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['name', 'image', 'url', 'target'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1],
        ];
    }

    public static function loadTragetOptions()
    {
        return [
            self::TARGET_BLANK => '新窗口中打开被链接文档(_blank)',
            self::TARGET_SELF => '相同的框架中打开被链接文档(_slef)',
            self::TAGET_PARENT => '父框架集中打开被链接文档(_parent)',
            self::TAGET_TOP => '整个窗口中打开被链接文档(_top)',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'Opreator'),
            'name' => Yii::t('app', 'Name'),
            'image' => Yii::t('app', 'Image'),
            'url' => Yii::t('app', 'Url'),
            'target' => Yii::t('app', 'Target'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Is Display'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ]);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->image = $this->uploadOpreate('image', '@friendlylink/', 'Image');

        return true;
    }
}
