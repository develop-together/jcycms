<?php 
namespace api\models;
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

	public function fields()
	{
		return [
			'id',
			'category_id',
			'category_name' => function($model) {
				return $model->category->name;
			},
			'title',
			'summary',
			'img_url' => 'thumb',
			'content',
			'update_at' => function($model) {
				 return date('Y-m-d H:i:s', $model->updated_at);
			}
		];
	}
}