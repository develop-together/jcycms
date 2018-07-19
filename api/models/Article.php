<?php 
namespace api\models;

use Yii;
use api\components\ActiveQuery;
use common\models\Article AS CommArticle;

class Article extends CommArticle 
{
    public function beforeSave($insert)
    {	
        if(!parent::beforeSave($insert)) {
            return false;
        }

        $this->thumb = $this->uploadOpreate();

        return true;
    }

    public static function find()
    {
        return Yii::createObject(ActiveQuery::className(), [get_called_class()]);
    }

	public function fields()
	{
		return [
			'id',
			'category_id',
			'category_name' => function($model) {
				return $model->category ? $model->category->name : '暂无分类';
			},
			'title',
			'summary',
			'scan_count',
			'img_url' => function($model) {
				return $model->thumb ? '/' . $model->thumb : '';
			},
			'content',
			'created_at' => function($model) {
				 return date('Y-m-d H:i:s', $model->created_at);
			},
			'updated_at' => function($model) {
				 return date('Y-m-d H:i:s', $model->updated_at);
			}
		];
	}
}