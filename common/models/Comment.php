<?php

namespace common\models;

use Yii;
use common\components\Utils;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Html;
use common\components\TreeHelper;

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
    const STATUS_INIT = 0;
    const STATUS_PASSED = 1;
    const STATUS_UNPASS = 2;
    public $avator;
    public $lv = 0;
    public $childrens = [];

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
            ['parent_id', function($attribute, $params) {
                $this->$attribute = (int)$this->$attribute;
                if ($this->$attribute !== 0) {
                    if (self::findOne($this->$attribute) === null) {
                        $this->addError($attribute, Yii::t('common', 'The comment you made does not exist!'));
                        return false;
                    }

                    return true;
                }

                return true;
            }]
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

    public function getUser()
    {
        return $this->hasone(User::className(), ['id' => 'user_id']);
    }

    public function getAvator()
    {
        return $this->user ? $this->user->avatar : Yii::$app->request->baseUrl . '/static/common/images/face.jpg';
    }

    public static function chilrdenDatas($datas, $parent_id, $lv = 0)
    {
        $tree = new TreeHelper($datas, true, 4, [
            'fpid' => $parent_id,
            'root' => $lv
        ]);

        return $tree->getTree();
    }

    public function afterFind()
    {
        parent::afterFind();
        if (!Yii::$app->cache->get('__comment_emotions')) {
            $emotions = Json::decode(Yii::$app->params['emotionsJson'], true);
            $phrases = array_column($emotions, 'phrase');
            $icons = array_column($emotions, 'icon');
            $emotions = array_combine($phrases, $icons);
            Yii::$app->cache->set('__comment_emotions', Json::encode($emotions));
        } else {
            $emotions = Json::decode(Yii::$app->cache->get('__comment_emotions'), true);
        }

        $this->created_at = Utils::tranDateTime($this->created_at);
        $this->contents = preg_replace_callback("/\[.*?\]/i", function($matches) use ($emotions) {
            foreach ($matches as &$match) {
                $match = isset($emotions[$match]) ? "<img src=\"{$emotions[$match]}\" height=\"22\" width=\"22\" />" : $match;
            }
            return implode('', $matches);
        }, $this->contents);
        $this->contents = Html::decode($this->contents);
    }
}
