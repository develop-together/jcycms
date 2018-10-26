<?php 

namespace api\controllers;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

/**
 * summary
 */
class BaseRestController extends \yii\rest\ActiveController
{
    public function behaviors()  
    {  
        $behaviors = parent::behaviors();  
        $behaviors['contentNegotiator']['formats'] = ['application/json' => \yii\web\Response::FORMAT_JSON];  
        // $behaviors['authenticator'] = [
        //     'class' => HttpBasicAuth::className(),
        // ];
        return $behaviors;  
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);

        return $actions;
    }
}