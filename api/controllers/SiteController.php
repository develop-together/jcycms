<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-03-15 21:16
 */

namespace api\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\HttpException;
use api\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * api doc 登陆
     * @return [type] [description]
     */
    public function actionApiLogin()
    {
        Yii::$app->session->open();
        $username = Yii::$app->params['api_username'];
        $password = Yii::$app->params['api_password'];
        if (Yii::$app->session->get('api-user') == $username) {
            return $this->redirect(\yii\helpers\Url::toRoute('/v1/docs'));
        }

        $params = Yii::$app->request->post();
        if (isset($params['username']) && isset($params['password'])) {
            $verifyPassword = password_verify($params['password'], $password);
            if ($params['username'] == $username && $verifyPassword) {
                Yii::$app->session->set('api-user', $username);
                Yii::$app->session->close();
                return $this->redirect(\yii\helpers\Url::toRoute('/v1/docs'));
            }
        }
        
        return $this->renderPartial('api-login');
    }

    public function actionApiLogout()
    {
        Yii::$app->session->remove('api-user');
        return $this->redirect(\yii\helpers\Url::toRoute('api-login'));
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (! Yii::$app->getUser()->getIsGuest()) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->renderPartial('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->getUser()->logout(false);

        return $this->redirect('login');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->getRequest()->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()
                    ->setFlash('success', yii::t('app', 'Check your email for further instructions.'));

                return $this->goHome();
            } else {
                Yii::$app->getSession()
                    ->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', yii::t('app', 'New password was saved.'));

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * 网站进入维护模式时
     * 即在后台网站设置中关闭了网站执行此操作
     *
     */
    public function actionOffline()
    {
        Yii::$app->getResponse()->statusCode = 503;
        yii::$app->getResponse()->content = "sorry, the site is temporary unserviceable";
        yii::$app->getResponse()->send();
    }


    /**
     * 切换网站视图
     * 请开发其他网站视图模版，并参照yii2文档配置
     *
     */
    public function actionView()
    {
        $view = Yii::$app->getRequest()->get('type');
        if (isset($view)) {
            Yii::$app->session['view'] = $view;
        }
        $this->goBack( Yii::$app->getRequest()->getHeaders()->get('referer') );
    }

    /**
     * 切换语言版本
     *
     */
    public function actionLanguage()
    {
        $language = Yii::$app->getRequest()->get('lang');
        if (isset($language)) {
            Yii::$app->session['language'] = $language;
        }
        $this->redirect( Yii::$app->getRequest()->getHeaders()->get('referer') );
    }

    /**
     * http异常捕捉后处理
     *
     * @return string
     */
    public function actionError()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            // action has been invoked not from error handler, but by direct route, so we display '404 Not Found'
            $exception = new HttpException(404, Yii::t('yii', 'Page not found.'));
        }

        if ($exception instanceof HttpException) {
            $code = $exception->statusCode;
        } else {
            $code = $exception->getCode();
        }
        //if ($exception instanceof Exception) {
        $name = $exception->getName();
        //} else {
        //$name = $this->defaultName ?: Yii::t('yii', 'Error');
        //}
        if ($code) {
            $name .= " (#$code)";
        }

        //if ($exception instanceof UserException) {
        $message = $exception->getMessage();
        //} else {
        //$message = $this->defaultMessage ?: Yii::t('yii', 'An internal server error occurred.');
        //}
        $statusCode = $exception->statusCode ? $exception->statusCode : 500;
        if (Yii::$app->getRequest()->getIsAjax()) {
            return "$name: $message";
        } else {
            return $this->render('error', [
                'code' => $statusCode,
                'name' => $name,
                'message' => $message,
                'exception' => $exception,
            ]);
        }
    }

}
