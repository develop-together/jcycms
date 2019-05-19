<?php

namespace backend\models;

use yii;
//use frontend\models\Comment;
use common\components\Utils;
use common\models\ArticleMeta;

class Article extends \common\models\Article
{

    public $width = 160;

    public $height = 220;


    public function scenarios()
    {
        return [
            'default' => [
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
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->thumb = $this->uploadOpreate();

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $metaModel = new ArticleMeta();
        $metaModel->setArticleTags($this->id, $this->tag);

        parent::afterSave($insert, $changedAttributes);
    }

    // 上周阅读排行
    public static function getReadRanking($limit = 5)
    {
        // $weeks = Utils::getBetweenWeek();
        return self::find()
            ->select(['id', 'title', 'sub_title', 'scan_count'])
            ->article()
            // ->where(['>=', 'created_at', $weeks[0]])
            // ->andFilterWhere(['<=', 'created_at', $weeks[1]])
            ->orderBy('scan_count DESC, created_at DESC')
            ->limit($limit)
            ->all();
    }

    // 上周评论排行
    public static function getCommentRanking($limit = 5)
    {
        // $weeks = Utils::getBetweenWeek();
        return self::find()
            ->select(['id', 'title', 'sub_title', 'comment_count'])
            ->article()
            // ->where(['>=', 'created_at', $weeks[0]])
            // ->andFilterWhere(['<=', 'created_at', $weeks[1]])
            ->orderBy('comment_count DESC, created_at DESC')
            ->limit($limit)
            ->all();
    }

    public function getTagFormat()
    {
        return explode(',', $this->tag);
    }
}