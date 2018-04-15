<?php 
namespace common\components;

use yii;
use yii\base\Component;
use backend\components\AdminLog;
use common\models\Options;
use yii\caching\FileDependency;
use yii\base\Event;
use yii\db\BaseActiveRecord;
use yii\web\Response;

class BaseRequest extends Component
{

	public function init()
	{
		parent::init();
	}

	public static function frontendInit()
	{

	}

    public static function backendInit()
    {
        Event::on(BaseActiveRecord::className(), BaseActiveRecord::EVENT_AFTER_INSERT, [
            AdminLog::className(), 'create']);
        Event::on(BaseActiveRecord::className(), BaseActiveRecord::EVENT_AFTER_UPDATE, [
            AdminLog::className(), 'update']);
        Event::on(BaseActiveRecord::className(), BaseActiveRecord::EVENT_AFTER_DELETE, [
            AdminLog::className(), 'delete']);

        if (isset(Yii::$app->session['language'])) {
            Yii::$app->language = Yii::$app->session['language'];
        }
    }	
}