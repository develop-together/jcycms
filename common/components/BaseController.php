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
                    'logout' => ['POST'],
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
                'backColor' => 0xffffff,
                'foreColor' => 0x105C9A,
                'transparent' => true,
                'maxLength' => 4,
                'minLength' => 4,
                'offset' => 1,
                'height' => 33,
                'width' => 80,
            ],
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