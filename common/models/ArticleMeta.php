<?php
/**
 * 
 * @Authors jiechengyang (2064320087@qq.com)
 * @Link    http://www.boomyang.cn
 * @addTime    2019-01-28 11:11:20
 */
namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%article_meta}}".
 *
 * @property string $id
 * @property string $aid
 * @property string $key
 * @property string $value
 * @property string $created_at
 *
 * @property Article $a
 */
class ArticleMeta extends \common\components\BaseModel
{

    public $keyName = 'tag';

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_meta}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid', 'value'], 'required'],
            [['aid', 'created_at'], 'integer'],
            [['value'], 'string'],
            [['key'], 'string', 'max' => 255],
            [['aid'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['aid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => Yii::t('app', 'ID'),
            'aid' => Yii::t('app', 'Aid'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
            'created_at' => Yii::t('app', 'Created At'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'aid']);
    }

    public function getTagsByArticle(int $aid): array
    {
        $data = self::find()->select(['value'])->where(['key' => $this->keyName, 'aid' => $aid])->asArray()->all();
        return ! $data ? [] : ArrayHelper::getColumn($data, 'value');
    }

    public static function getArticleByTag(string $keyName, string $tag): array
    {
        $data = self::find()->select(['aid'])->where(['key' => $keyName, 'value' => $tag])->asArray()->all();
        return ! $data ? [] : ArrayHelper::getColumn($data, 'aid');
    }

    public function setArticleTags($aid, $tags)
    {
        $tags = !$tags && [];
        if (is_string($tags)) {
            $tags = str_replace('，', ',', $tags);
            $tags = explode(',', $tags);
        }

        $oldTags = $this->getTagsByArticle($aid);
        $addTags = array_diff($tags, $oldTags);
        $removeTags = array_diff($oldTags, $tags);
        foreach ($addTags as $value) {
            //初始化带参数，具体给追踪到\yii\base\BaseObject __construct方法，yii2里面model、controller、compoent等操作都支持实例化带参，参数都由Yii::configure($this, $config)处理
            $model = new self(['key' => $this->keyName, 'aid' => $aid, 'value' => $value]);
            $model->save();
        }
        
        if ($removeTags) {
            self::deleteAll(['value' => $removeTags, 'key' => $this->keyName, 'aid' => $aid]);
        }
    }
}
