<?php

namespace common\components;

use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\components\Utils;

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class BaseController extends Controller
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	// public $layout=false;

    public $_uniqid;
    
    /**
     * navTab前辍
     * @var [type]
     */
    public $_tabPrefix;
    
	public function init()
	{
		parent::init();
        $this->_uniqid = uniqid();
        $this->_tabPrefix = str_replace('/', '-', $this->uniqueId);
	}

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST', 'GET'],
                    'logout' => ['GET'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor' => 0x66b3ff, //背景颜色
                'maxLength' => 4, //最大显示个数
                'minLength' => 4, //最少显示个数
                'padding' => 6, //验证码字体大小，数值越小字体越大
                'height' => 34, //高度
                'width' => 100, //宽度
                'foreColor' => 0xffffff, //字体颜色
                'offset' => 13, //设置字符偏移量
                //'controller'=>'login',        //拥有这个动作的controller
            ],
            // 'captcha' => [
            //     'class' => 'yii\captcha\CaptchaAction',
            //     'backColor' => 0xffffff,
            //     'foreColor' => 0x105C9A,
            //     'transparent' => true,
            //     'maxLength' => 4,
            //     'minLength' => 4,
            //     'offset' => 1,
            //     'height' => 33,
            //     'width' => 80,
            // ],
        ];
    }

    /**
     * 生成非转码的URL
     * @param  [type] $route     [description]
     * @param  array  $params    [description]
     * @param  string $ampersand [description]
     * @return [type]            [description]
     */
    public function createDecodeUrl($route, $params=array())
    {
        array_unshift($params, $route);
        return urldecode(Url::toRoute($params));
    }
}