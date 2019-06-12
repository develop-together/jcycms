<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\components\ImageHelper;

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

    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => false,
                'updatedAtAttribute' => false
            ]
        ];
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

    public function beforeSave($insert)
    {
        // if ($insert && preg_match('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i', $this->content, $match)) {
        //     $src = $match[2];
        //     $configData = Config::loadData();
        //     if (isset($configData['watermark_img']) && $configData['watermark_img']) {
        //         $imgInfo = ImageHelper::imgInfo(Yii::getAlias('@backend/web/') . $src);
        //         ImageHelper::watermark($src, str_replace("\\", '/', Yii::getAlias('@backend/web/') . $configData['system_logo']), $configData['watermark_style'], [$imgInfo['width'], $imgInfo['height'], $configData['watermark_location']]);
        //     }
        // }

        return parent::beforeSave($insert);
    }
}
