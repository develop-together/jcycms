<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use common\components\FrontendController;
use frontend\models\LoginForm;
use common\components\BaseConfig;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends FrontendController
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $renderParams = ['configData' => $this->configData];
        if ($this->_themeId === BaseConfig::WEB_TEMPLATE_BASE) {
            $signupModel = new SignupForm();
            $loginModel = new LoginForm();
            $resetModel = new PasswordResetRequestForm();
            $renderParams = array_merge($renderParams, [
                'signupModel' => $signupModel,
                'loginModel' => $loginModel,
                'resetModel' => $resetModel
            ]);
        } elseif ($this->_themeId === BaseConfig::WEB_TEMPLATE_ONE) {

        } elseif ($this->_themeId === BaseConfig::WEB_TEMPLATE_TWO) {

        }

        return $this->render('index', $renderParams);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if (!($model->load(Yii::$app->request->post()) && $model->login())) {
            $errs = '';
            if ($model->errors) {
                foreach ($model->errors as $error) {
                    $errs .= $error[0] . ',';
                }
                $errs = rtrim($errs, ',');
            } 
            Yii::$app->session->setFlash('error', Yii::t('common', 'Login Failed') . '(' . $errs . ')');
        }

        return $this->goBack();
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            } else {
                $errors = [];
                foreach ($user->errors as $error) {
                    $errors[] = $error[0];
                }
                Yii::$app->getSession()->setFlash('error', implode(',', $errors));
                return $this->goHome();
            }
        }
    }

    public function actionColumns()
    {
        return $this->render('columns');
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', Yii::t('frontend', 'Check your email for further instructions.'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('frontend', 'Sorry, we are unable to reset password for the provided email address.'));
            }
        }

        return $this->goHome();
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

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', Yii::t('frontend', 'New password saved.'));

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
