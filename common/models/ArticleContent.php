<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%article_content}}".
 *
 * @property string $id
 * @property string $article_id
 * @property string $content
 *
 * @property Article $article
 */
class ArticleContent extends \common\components\BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id'], 'integer'],
            [['content'], 'string'],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => Yii::t('app', 'ID'),
            'article_id' => Yii::t('app', 'Article ID'),
            'content' => Yii::t('app', 'Content'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }
}
