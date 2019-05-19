<?php
namespace backend\models;

use yii;
use common\components\Utils;

class PageArticle extends \common\models\Article
{
    public function scenarios()
    {
        return [
            'default' => [
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
            ]
        ];
    }
}