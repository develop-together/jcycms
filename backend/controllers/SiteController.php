<?php
namespace backend\controllers;

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
use yii\helpers\Json;
use common\components\Utils;

/**
 * Site controller
 */
class SiteController extends BackendController 
{
	/**
	 * @inheritdoc
	 */
	// public function behaviors() 
	// {
	// 	return [
	// 		'access' => [
	// 			'class' => AccessControl::className(),
	// 			'rules' => [
	// 				[
	// 					'actions' => ['login', 'error', 'captcha'], //为access rules的actions增加captcha方法可访问。
	// 					'allow' => true,
	// 				],
	// 				[
	// 					'actions' => ['logout', 'index', 'desktop'],
	// 					'allow' => true,
	// 					'roles' => ['@'],
	// 				],
	// 			],
	// 		],
	// 		'verbs' => [
	// 			'class' => VerbFilter::className(),
	// 			'actions' => [
	// 				'logout' => ['get'],
	// 			],
	// 		],
	// 	];
	// }

    public function actions()
    {
        return parent::actions();
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
				'countName' => Yii::t('app', 'Articles'),
				'type' => 'Month',
				'url' => Url::to(['article/index']),
				'countNumber' => Article::find()->where(['type' => Article::ARTICLE])->count('id'),
			],
			'comment' => [
				'countName' => Yii::t('app', 'Comments'),
				'type' => 'Today',
				'url' => 'javascript:;',
				'countNumber' => 0,
			],
			'frontendUser' => [
				'countName' => Yii::t('app', 'Users'),
				'type' => 'Month',
				'url' => 'javascript:;',
				'countNumber' => 0,
			],
			'friendLink' => [
				'countName' => Yii::t('app', 'Friendly Links'),
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

		// 当周新增数量统计图
		$echartsData = $xAxis = $articleData = $frontendUserData = [];
		$echartsData['legend'] = [Yii::t('app', 'Articles'), Yii::t('app', 'Users')];
	    $echartsData['legends'] = Json::encode(array_values($echartsData['legend']));;
	    $series = $articleCount = $userCount = [];
		$nWeek = date('w');
		$nWeek > 0 && $nWeek -= 1;
		for ($i = 0 ; $i <= $nWeek; $i++) {
			$day = $i  == 0 ? '日' : Utils::numberToChinese($i);
			$xAxis[] = '周' . $day;
			$startTime = strtotime(date('Y-m-d 00:00:00', strtotime('-' . ($nWeek-$i) . 'day')));
			$endTime = strtotime(date('Y-m-d 23:59:59', strtotime('-' . ($nWeek-$i) . 'day')));
			$articleCount[] = Article::find()
				->where(['type' => ARTICLE])
				->andWhere(['between', 'created_at', $startTime, $endTime])
				->count();
			$userCount[] = $i + mt_rand(0, 10);

		}

		$series[0] = [
			'type' => 'line', 
			'stack' => '总量', 
			'areaStyle' => ['normal' => []],
			'name' => $echartsData['legend'][0], 
			'data' => $articleCount
		];
		$series[1] = [
			'type' => 'line', 
			'stack' => '总量', 
			'areaStyle' => ['normal' => []],
			'name' => $echartsData['legend'][1], 
			'data' => $userCount
		];
		$echartsData['series'] = Json::encode($series);
		$echartsData['xAxis'] = Json::encode(array_values($xAxis));
		return $this->render('desktop', [
			'countData' => $countData,
			'enviromentInfo' => $enviromentInfo,
			'serverStatics' => $serverStatics,
			'echartsData' => $echartsData,
		]);
	}
}
