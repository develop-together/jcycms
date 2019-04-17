<?php
namespace frontend\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use common\components\Utils;
use common\models\Comment as CommonComment;

class Comment extends CommonComment
{

	public function beforeSave($insert)
	{
		if ($insert) {
			if ((int)Yii::$app->jcore->open_comment_verify === 1) {
				$this->status = self::STATUS_INIT;
			} else {
				$this->status = self::STATUS_PASSED;
			}

			$this->ip = Yii::$app->getRequest()->getUserIP();
			if (!Yii::$app->user->isGuest) {
				$this->user_id = Yii::$app->user->id;
				$this->nickname = Yii::$app->user->identity->username;
			} else {
				$this->user_id = 0;
				$this->nickname = Yii::t('frontend', 'Guest');
			}
		}

		$this->contents = Html::encode($this->contents);
		return parent::beforeSave($insert);
	}

	public function saveData($params)
	{
		if ($this->load($params) && $this->save()) {
			// $this->afterFind();
			return ['code' => 10002, 'data' => [
					'id' => $this->id,
					'article_id' => $this->article_id,
					'username' => $this->nickname,
					'create_time' => $this->created_at,//Utils::tranDateTime(),
					'avator' => $this->getAvator(),
					'like_count' => $this->like_count,
					'content' => $this->contents,
					'zf_count' => $this->repeat_count
				]
			];
		}

		return ['code' => 10001, 'message' => implode('<br>', $this->getErrorFormat())];
	}

	public function afterSave($insert, $changedAttributes)
	{
		if ($insert) {
			$articleModel = Article::findOne($this->article_id);
			$articleModel->comment_count += 1;
			$articleModel->save(false, ['comment_count', 'updated_at']);
		}
	}

}