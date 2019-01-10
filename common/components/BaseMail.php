<?php 
namespace common\components;

use Yii;
use common\models\Config;

/**
 * 邮件操作
 */
 class BaseMail 
 {
 	private static $_instance = null;

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
            'class' => yii\swiftmailer\Mailer::className(),
            'viewPath' => '@common/mail',
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => $config['smtp_sender']
            ],
            'useFileTransport' => false,// false,//false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
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

 	public static function send($email, $subject, $message, $compose = [])
 	{
 		self::init();
 		$mailer = Yii::$app->mailer;
        $view = null;
        $params = [];
        if (isset($compose[0])) {
            $view = $compose[0];
        }

        if (isset($compose[1])) {
            $params = $compose[1];
        }

        try {
            if(empty($compose) && !empty($message)) {
                $result = $mailer->compose()
                    ->setTo($email)
                    ->setSubject($subject)
                    ->setHtmlBody($message)
                    ->send();
            } else {
                $result = $mailer->compose($view , $params)
                    ->setTo($email)
                    ->setSubject($subject)
                    ->send();                
            }
            
            return [$result, null];
        } catch(\Exception $e) {
            return [false, Yii::t('app', 'Send a failure, please confirm whether the mailbox exists!')];
        }		
 	}
 }