<?php
/**
 * Created by PhpStorm.
 * User: yidashi
 * Date: 16/7/16
 * Time: 上午1:46
 */

namespace common\modules\attachment\actions;


use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use common\modules\attachment\models\Attachment;
use yii\web\NotFoundHttpException;


class UploadController extends Controller
{
    public $enableCsrfValidation = false;

    public function actions()
    {
        return [
            'image-upload' => [
                'class' => UploadAction::className(),
                'path' => date('Ymd'),
            ],

            'file-upload' => [
                'class' => UploadAction::className(),
                'path' => date('Ymd'),
                'uploadOnlyImage' => false
            ],
            'images-upload' => [
                'class' => UploadAction::className(),
                'path' => date('Ymd'),
                'multiple' => true,
            ],
            'backend-files-upload' => [
                'class' => UploadAction::className(),
                'path' => date('Ymd'),
                'multiple' => true,
                'uploadOnlyImage' => false,
                'itemCallback' => function ($result) {
                    $result['updateUrl'] = Url::to(['/attachment/update', 'id' => $result['id']]);
                    return $result;
                }
            ],            
            'ueditor' => [
                'class' => 'common\modules\attachment\actions\UeditorAction',
                'config' => [
                    "imageAllowFiles" => Yii::$app->params['imageAllowFiles'], //上传限制格式
                ],
            ],
            // 'ueditor-catch' => [
            //     'class' => CatchAction::className(),
            //     'path' => date('Ymd'),
            // ],
            'ueditor-image-upload' => [
                'class' => UploadAction::className(),
                'path' => date('Ymd'),
                'uploadParam' => 'upfile',
                'callback' => function($result) {
                    return !isset($result['files'][0]['error']) ? [
                        'state' => 'SUCCESS',
                        'url' => $result['files'][0]['url'],
                        'title' => $result['files'][0]['name'],
                        'original' => $result['files'][0]['name'],
                        'type' => $result['files'][0]['type'],
                        'size' => $result['files'][0]['size'],
                    ] : [
                        'error' => $result['files'][0]['error']
                    ];
                }
            ]
        ];
    }

    public function actionDelete()
    {
        //TODO AttachmentIndex里没有该attachment_id就可以把attachment删了
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            $model = $this->findModel($post['fileId']);
            $filePath = Yii::getAlias('@backend') . '/web/' . Yii::$app->params['uploadSaveFilePath'] . '/' . $post['filepath'];
            $filePath = str_replace('', "\\", $filePath);
            $transaction = Yii::$app->db->beginTransaction();
            try{
                if ((file_exists($filePath) && $model->delete() && @unlink($filePath)) || $model->delete()) {
                    return ['code' => 200 , 'message' => '删除成功!'];
                } else{
                    throw new \yii\web\BadRequestHttpException('操作失败！');
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                return ['code' => 300 , 'message' => $e->getMessage()];
            }
        }
    }

    protected function findModel($id)
    {
        $model = Attachment::findOne($id);
        if ($model) {
            return $model;
        } else {
             throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
