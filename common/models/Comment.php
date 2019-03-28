<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property string $id
 * @property integer $user_id
 * @property integer $article_id
 * @property integer $parent_id
 * @property string $nickname
 * @property integer $admin_id
 * @property string $ip
 * @property integer $status
 * @property integer $like_count
 * @property integer $repeat_count
 * @property string $contents
 * @property integer $created_at
 * @property integer $updated_at
 */
class Comment extends \common\components\BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'article_id', 'parent_id', 'admin_id', 'like_count', 'repeat_count', 'created_at', 'updated_at'], 'integer'],
            [['nickname', 'ip'], 'string', 'max' => 32],
            [['status'], 'string', 'max' => 2],
            [['contents'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'article_id' => Yii::t('app', 'Article ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'nickname' => Yii::t('app', 'Nickname'),
            'admin_id' => Yii::t('app', 'Admin ID'),
            'ip' => Yii::t('app', 'Ip'),
            'status' => Yii::t('app', 'Status'),
            'like_count' => Yii::t('app', 'Like Count'),
            'repeat_count' => Yii::t('app', 'Repeat Count'),
            'contents' => Yii::t('app', 'Contents'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ]);
    }
}
