<?php
namespace backend\controllers;

use backend\models\LoginForm;
use Yii;
use backend\models\Article;
use backend\models\User;
use common\models\FriendLink;
use common\components\ServerInfo;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\components\BackendController;
use yii\db\Query;
use yii\helpers\Url;

/**
 * Site controller
 */
class SiteController extends BackendController 
{
	/**
	 * @inheritdoc
	 */
	public function behaviors() 
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['login', 'error', 'captcha'], //为access rules的actions增加captcha方法可访问。
						'allow' => true,
					],
					[
						'actions' => ['logout', 'index', 'desktop'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['get'],
				],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
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
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex() 
	{
		$this->layout = false;

		return $this->render('index');
	}

	public function actionDesktop()
	{
		// echo date('Y-m-d H:i:s', strtotime(date('Y-m-01 23:59:59') . " +1 month -1 day"));
		// 文章（总数量）当月与上月相比的变化率
		// 评论（总数量）当日与昨日相比的变化率
		// 前台用户（总数量）当月与上月相比的变化率
		// 友情链接（总数量）当月与上月相比的变化率
		$countData = [
			'article' => [
				'countName' => yii::t('app', 'Articles'),
				'type' => 'Month',
				'url' => Url::to(['article/index']),
				'countNumber' => Article::find()->where(['type' => Article::ARTICLE])->count('id'),
			],
			'comment' => [
				'countName' => yii::t('app', 'Comments'),
				'type' => 'Today',
				'url' => 'javascript:;',
				'countNumber' => 0,
			],
			'frontendUser' => [
				'countName' => yii::t('app', 'Users'),
				'type' => 'Month',
				'url' => 'javascript:;',
				'countNumber' => 0,
			],
			'friendLink' => [
				'countName' => yii::t('app', 'Friendly Links'),
				'type' => 'Month',
				'url' => Url::to(['friend-link/index']),
				'countNumber' => friendLink::find()->count('id'),
			],
		];
		$countData['article']['proportion'] = $countData['article']['countNumber'] == 0 ? 0 : number_format(
				Article::find()
					->where(['type' => Article::ARTICLE])
					->andWhere(['between', 'created_at', 
						strtotime(date('Y-m-01')), 
						strtotime(date('Y-m-01 23:59:59') . " +1 month -1 day")
					])->count('id') / $countData['article']['countNumber'] * 100, 2);
		$countData['comment']['proportion'] = 0;
		$countData['frontendUser']['proportion'] = 0;
		$countData['friendLink']['proportion'] = $countData['friendLink']['countNumber'] == 0 ? 0 : number_format(
				friendLink::find()
					->where(['between', 'created_at', 
						strtotime(date('Y-m-01')), 
						strtotime(date('Y-m-01 23:59:59') . " +1 month -1 day")
					])->count('id') / $countData['friendLink']['countNumber'] * 100, 2);

		// 系统运行环境信息Environment
		$dbInfo = 'Unknown';
		$driverName = strtolower(Yii::$app->getDb()->driverName);
		if ($driverName == 'mysql') {
			// 原生语句select version();\status;\mysql --help | grep Distrib 
			$dbInfo = 'MYSQL ' . (new Query())->select('version() as m_version')->one()['m_version'];
		} elseif ($driverName == 'pgsql') {
			$dbInfo = (new Query())->select('version() as m_version')->one()['m_version'];
		}
		$enviromentInfo = [
			'opreating_enviroment' => PHP_OS . ' '. Yii::$app->request->serverName,
			'php_run_mode' => php_sapi_name(),/*PHP_SAPI */
			'db_info' => $dbInfo,
			'program_version' => Yii::$app->version,
			'upload_max_filesize' => ini_get('upload_max_filesize'),/*获取php.ini配置信息，配套函数ini_set(参数key，参数value)设置参数的值*/
			'max_execution_time' => ini_get('max_execution_time') . 's',
		];
		$serverInfo = ServerInfo::getinfo();
		$serverStatics = [
           'disk_space' => [
                'num' => ceil( $serverInfo['diskTotal'] - $serverInfo['freeSpace'] ) . 'G' . ' / ' . ceil($serverInfo['diskTotal']) . 'G',
                'percentage' => (floatval($serverInfo['diskTotal']) != 0) ? round(($serverInfo['diskTotal'] - $serverInfo['freeSpace']) / $serverInfo['diskTotal'] * 100, 2) : 0,
            ],
            'mem' => [
                'num' => $serverInfo["UsedMemory"] . ' / ' . $serverInfo['TotalMemory'],
                'percentage' => $serverInfo["memPercent"],
            ],
            'real_mem' => [
                'num' => $serverInfo["memRealUsed"] . "(Cached {$serverInfo['CachedMemory']})" . ' / ' . $serverInfo['TotalMemory'],
                'percentage' => $serverInfo['memRealPercent'] . '%',
            ],
		];

		return $this->render('desktop', [
			'countData' => $countData,
			'enviromentInfo' => $enviromentInfo,
			'serverStatics' => $serverStatics,
		]);
	}

	/**
	 * Login action.
	 *
	 * @return string
	 */
	public function actionLogin() 
	{
		$this->layout = false;
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if (Yii::$app->request->getIsPost()) {
			if ($model->load(Yii::$app->request->post()) && $model->login()) {
				return $this->goBack();
			} else {
				$errors = $model->getErrors();
				$err = [];
				foreach ($errors as $error) {
					$err[] = $error[0];
				}

				Yii::$app->session->setFlash('error', implode('<br>', $err));
			}
		}

		return $this->render('login', [
			'model' => $model,
		]);		
	}

	/**
	 * Logout action.
	 *
	 * @return string
	 */
	public function actionLogout() 
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}

}
