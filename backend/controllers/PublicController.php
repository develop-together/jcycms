<?php 
 namespace backend\controllers;
 
 use Yii;
 use backend\models\LoginForm;
 use common\components\FrontendController;

 class PublicController extends FrontendController
 {

    public function actionIndex()
    {
        return $this->render('index');
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