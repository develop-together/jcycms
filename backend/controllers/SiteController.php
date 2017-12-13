<?php
namespace backend\controllers;

use backend\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller {
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['login', 'error', 'captcha'], //为access rules的actions增加captcha方法可访问。
						'allow' => true,
					],
					[
						'actions' => ['logout', 'index'],
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
	public function actions() {
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
	public function actionIndex() {
		$this->layout = false;

		return $this->render('index');
	}

	/**
	 * Login action.
	 *
	 * @return string
	 */
	public function actionLogin() {
		$this->layout = false;
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		} else {
			return $this->render('login', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Logout action.
	 *
	 * @return string
	 */
	public function actionLogout() {
		Yii::$app->user->logout();

		return $this->goHome();
	}
}
