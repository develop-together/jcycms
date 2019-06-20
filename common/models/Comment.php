<?php

namespace common\models;

use Yii;
use common\components\Utils;
use common\components\BaseConfig;
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

    public  function getCommentStatusItems($key = null, $delDefault = false)
    {
        $items = [
            self::STATUS_INIT => Yii::t('app', 'Not Audited'),
            self::STATUS_PASSED => Yii::t('app', 'Passed'),
            self::STATUS_UNPASS => Yii::t('app', 'Unpassed'),
        ];
        if ($delDefault) unset($items[self::STATUS_INIT]);
        return BaseConfig::getItems($items, $key);
    }


    public function getStatusFormat()
    {
        $class = 'badge badge-rounded ';
        $value = $this->getCommentStatusItems($this->status);
        if ( self::STATUS_PASSED === $this->status ) {
            $class .= 'badge-success';
        } elseif ( self::STATUS_UNPASS === $this->status ) {
            $class .= 'badge-danger';
        } else {
            $class .= 'badge-info';
        }

        return '<span class="' . $class . '">' . $value . '</span>';
    }

    public function getCreated_at_format()
    {
        return  Utils::tranDateTime($this->created_at);
    }

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
            ['status', 'in', 'range' => [self::STATUS_INIT, self::STATUS_PASSED, self::STATUS_UNPASS]],
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
            'user_id' => Yii::t('common', 'Username'),
            'article_id' => Yii::t('app', 'Article'),
            'parent_id' => Yii::t('common', 'Superior comment'),
            'nickname' => Yii::t('app', 'Nickname'),
            'admin_id' => Yii::t('common', 'Admin user'),
            'ip' => Yii::t('app', 'Ip'),
            'status' => Yii::t('app', 'Status'),
            'like_count' => Yii::t('common', 'Like Count'),
            'repeat_count' => Yii::t('common', 'Repeat Count'),
            'contents' => Yii::t('app', 'Comments'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ]);
    }

    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }

    public function getArticle()
    {
        return $this->hasOne(Article::class, ['id' => 'article_id']);
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

        $this->contents = preg_replace_callback("/\[.*?\]/i", function($matches) use ($emotions) {
            foreach ($matches as &$match) {
                $match = isset($emotions[$match]) ? "<img src=\"{$emotions[$match]}\" height=\"22\" width=\"22\" />" : $match;
            }
            return implode('', $matches);
        }, $this->contents);
        $this->contents = Html::decode($this->contents);
    }
}
