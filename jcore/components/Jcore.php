<?php
/**
 *
 * @Authors jiechengyang (2064320087@qq.com)
 * @Link    http://www.boomyang.cn
 * @addTime    2019-01-29 18:30:39
 */
namespace jcore\components;

use Yii;
use common\models\Config;
use backend\components\AdminLog;
use yii\base\Component;
use yii\base\Event;
use yii\db\BaseActiveRecord;
use yii\web\Response;

class Jcore extends Component
{
	public function __get($name)
	{
		return isset($this->$name) ?? '';
	}

	public function __set($name, $value)
	{
		$this->$name = $value;
	}

	public function init()
	{
		parent::init();
		// 系统参数
		$configData = Config::loadData();
		foreach ($configData as $key => $value) {
			$this->{$key} = $value;
		}
	}

	private static function mailInit()
	{
        Yii::$app->set('mailer', [
            'class' => \yii\swiftmailer\Mailer::className(),
            'viewPath' => '@common/mail',
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => Yii::$app->jcore->smtp_sender
            ],
            'useFileTransport' => false,// false,//false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => Yii::$app->jcore->smtp_server,
                'username' => Yii::$app->jcore->smtp_user,
                'password' => Yii::$app->jcore->smtp_password,
                'port' => Yii::$app->jcore->smtp_port,
                'encryption' => Yii::$app->params['mailerEncryption'],
            ],
        ]);
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

        self::mailInit();
    }

    public static function frontendBeforeSend($event)
    {
        $response = $event->sender;
        if (is_string($response->data) && !empty($response->data)) {
            $response->data = preg_replace(
                "/(<img.*?src=[\"|\']?)(\/?)uploads((.*?)[\"|\']?\s.*?>)/i",
                '$1' . Yii::$app->params['backendUrl'] . '/uploads$3',
                $response->data);
        }

        //TODO: ajax or pjax Yii::$app->request->getIsPjax()
        if (is_string($response->content) && !empty($response->content)) {
            $response->content = preg_replace(
                "/(<img.*?src=[\"|\']?)(\/?)uploads((.*?)[\"|\']?\s.*?>)/i",
                '$1' . Yii::$app->params['backendUrl'] . '/uploads$3',
                $response->content);
        }

        if ($response->format === 'json') {
            $response->data = json_encode($response->data);
            $response->data = preg_replace('/uploads/i', Yii::$app->params['backendUrl'] . '/uploads', $response->data);
            $response->data = json_decode($response->data);
        }
    }
}