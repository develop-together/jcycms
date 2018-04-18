<?php 
namespace common\components;

use Yii;
use common\models\Config;

/**
 * 邮件操作
 */
 class BaseMail 
 {
 	private $_instance = null;

 	public static function Instance()
 	{
 		if (!self::$_instance instanceof self) {
 			self::$_instance = new self();
 		}

 		return self::$_instance;
 	}

 	public static function init()
 	{
        $config = Config::loadData();
        foreach ($config as &$v) {
            $v = trim($v);
        }

        Yii::$app->set('mailer', [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
                'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => $config['smtp_sender']
            ],
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => $config['smtp_server'],
                'username' => $config['smtp_user'],
                'password' => $config['smtp_password'],
                'port' => $config['smtp_port'],
                'encryption' => Yii::$app->params['mailerEncryption'],
            ],
        ]); 		
 	}

 	public static function send($email, $subject, $message)
 	{
 		self::init();
 		$mailer = Yii::$app->mailer;
        try {
            $result = $mailer->compose()
                ->setTo($email)
                ->setSubject($subject)
                ->setHtmlBody($message)
                ->send();
            return [true, null];
        } catch(\Exception $e) {
            return [false, Yii::t('app', 'Send a failure, please confirm whether the mailbox exists!')];
        }		
 	}
 }