<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\User;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property string $id
 * @property string $category_id
 * @property string $type
 * @property string $title
 * @property string $sub_title
 * @property string $summary
 * @property string $thumb
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 * @property integer $status
 * @property string $sort
 * @property string $user_id
 * @property string $scan_count
 * @property integer $can_comment
 * @property integer $visibility
 * @property string $tag
 * @property integer $flag_headline
 * @property integer $flag_recommend
 * @property integer $flag_slide_show
 * @property integer $flag_special_recommend
 * @property integer $flag_roll
 * @property integer $flag_bold
 * @property integer $flag_picture
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ArticleContent[] $articleContents
 */
class Article extends \common\components\BaseModel
{
    const ARTICLE = 0;/*文章*/
    const SINGLE_PAGE = 2;/*单页*/
    const PHOTOS_PAGE = 3;/*相册*/
    const ARTICLE_PUBLISHED = 1;
    const ARTICLE_DRAFT = 0;
    
    public $content = '';
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'status'], 'required'],
            [['id', 'category_id', 'type', 'status', 'sort', 'user_id', 'scan_count', 'can_comment', 'visibility', 'flag_headline', 'flag_recommend', 'flag_slide_show', 'flag_special_recommend', 'flag_roll', 'flag_bold', 'flag_picture', 'created_at', 'updated_at'], 'integer'],
            [['title', 'sub_title', 'summary', 'seo_title', 'seo_keywords', 'seo_description', 'tag'], 'string', 'max' => 255],
             // [['file'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png',],  
             // [['file'], 'file', 'maxFiles' => 10,'extensions'=>'jpg,png,gif'], 
            [['content'], 'string'],
            [['thumb', 'photo_file_ids'], 'safe'],
            [
                [
                    'flag_headline',
                    'flag_recommend',
                    'flag_slide_show',
                    'flag_special_recommend',
                    'flag_roll',
                    'flag_bold',
                    'flag_picture',
                    'status',
                    'can_comment'
                ],
                'in',
                'range' => [0, 1]
            ],
            [['visibility'], 'in', 'range' => [1, 2, 3]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $parentScenarios = parent::scenarios();
        
        return array_merge($parentScenarios, [
            'article' => [
                'category_id',
                'type',
                'title',
                'sub_title',
                'summary',
                'content',
                'thumb',
                'seo_title',
                'seo_keywords',
                'seo_description',
                'status',
                'sort',
                'user_id',
                'created_at',
                'updated_at',
                'scan_count',
                'can_comment',
                'visibility',
                'tag',
                'flag_headline',
                'flag_recommend',
                'flag_slide_show',
                'flag_special_recommend',
                'flag_roll',
                'flag_bold',
                'flag_picture'
            ],
            'page' => [
                'type',
                'title',
                'sub_title',
                'summary',
                'seo_title',
                'content',
                'seo_keywords',
                'seo_description',
                'status',
                'can_comment',
                'visibility',
                'tag',
                'sort'
            ],
            'photos' => [
                'type',
                'category_id',
                'title',
                'sub_title',
                'summary',
                'seo_title',
                'seo_keywords',
                'seo_description',
                'status',
                'can_comment',
                'visibility',
                'tag',
                'sort',
                'photo_file_ids',
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category'),
            'type' => Yii::t('app', 'Type'),
            'title' => Yii::t('app', 'Title'),
            'sub_title' => Yii::t('app', 'Sub Title'),
            'summary' => Yii::t('app', 'Summary'),
            'thumb' => Yii::t('app', 'Thumb'),
            'content' => Yii::t('app', 'Content'),
            'seo_title' => Yii::t('app', 'Seo Title'),
            'seo_keywords' => Yii::t('app', 'Seo Keywords'),
            'seo_description' => Yii::t('app', 'Seo Description'),
            'status' => Yii::t('app', 'Status'),
            'sort' => Yii::t('app', 'Sort'),
            'user_id' => Yii::t('app', 'Author'),
            'scan_count' => Yii::t('app', 'Scan Count'),
            'can_comment' => Yii::t('app', 'Can Comment'),
            'visibility' => Yii::t('app', 'Visibility'),
            'tag' => Yii::t('app', 'Tag'),
            'photo_file_ids' => Yii::t('app', 'Photo Album'),
            'flag_headline' => Yii::t('app', 'Is Headline'),
            'flag_recommend' => Yii::t('app', 'Is Recommend'),
            'flag_slide_show' => Yii::t('app', 'Is Slide Show'),
            'flag_special_recommend' => Yii::t('app', 'Is Special Recommend'),
            'flag_roll' => Yii::t('app', 'Is Roll'),
            'flag_bold' => Yii::t('app', 'Is Bold'),
            'flag_picture' => Yii::t('app', 'Is Picture'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'linkUrl' => Yii::t('app', 'Url'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleContents()
    {
        return $this->hasMany(ArticleContent::className(), ['article_id' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getLinkUrl()
    {
        return Yii::$app->params['site']['url'] . '/page/' . $this->sub_title;
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        // 删除该文章的所有评论
        if (($articleContentModel = ArticleContent::findOne(['article_id' => $this->id])) != null) {
            $articleContentModel->delete();
        }

        return parent::beforeDelete();
    }
    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        parent::afterFind();
        $this->content = ArticleContent::findOne(['article_id' => $this->id])['content'];
    }

    public function saveArticle()
    {
        if (!$this->save()) {
            $errs = [];
            foreach ($this->getErrors() as $error) {
                $errs[] = $error[0];
            }

            throw new \yii\web\BadRequestHttpException(implode('<br>', $errs));
        }

        $articleContentModel = new ArticleContent();
        $articleContentModel->article_id = $this->id;
        $articleContentModel->content = $this->content;
        if (!$articleContentModel->save()) {
            $articleContentErrs = [];
            foreach ($articleContentModel->getErrors() as $aError) {
                $articleContentErrs[] = $aError[0];
            }

            throw new \yii\web\BadRequestHttpException(implode('<br>', $articleContentErrs));
        }

        return true;
    }

    public function beforeSave($insert)
    {
        if(!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->flag_headline == null) {
            $this->flag_headline = 0;
        }

        if ($this->flag_recommend == null) {
            $this->flag_recommend = 0;
        }

        if ($this->flag_slide_show == null) {
            $this->flag_slide_show = 0;
        }

        if ($this->flag_special_recommend == null) {
            $this->flag_special_recommend = 0;
        }

        if ($this->flag_roll == null) {
            $this->flag_roll = 0;
        }

        if ($this->flag_bold == null) {
            $this->flag_bold = 0;
        }

        if ($this->flag_picture == null) {
            $this->flag_picture = 0;
        }

        $this->tag = str_replace('，', ',', $this->tag);
        $this->seo_keywords = str_replace('，', ',', $this->seo_keywords);

        return true;
    }
}
