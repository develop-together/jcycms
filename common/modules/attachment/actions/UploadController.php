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
/*            'redactor-files-get' => [
                'class' => GetAction::className(),
                'type' => 'files',
            ],
            'redactor-image-upload' => [
                'class' => UploadAction::className(),
                'path' => date('Ymd'),
                'callback' => function($result) {
                    return !isset($result['files'][0]['error']) ? [
                        'filelink' => $result['files'][0]['url']
                    ] : [
                        'error' => $result['files'][0]['error']
                    ];
                }
            ],
            'redactor-images-get' => [
                'class' => GetAction::className(),
                'type' => 'images',
            ],
            'redactor-file-upload' => [
                'class' => UploadAction::className(),
                'path' => date('Ymd'),
                'uploadOnlyImage' => false,
                'callback' => function($result) {
                    return !isset($result['files'][0]['error']) ? [
                        'filelink' => $result['files'][0]['url'],
                        'filename' => $result['files'][0]['filename']
                    ] : [
                        'error' => $result['files'][0]['error']
                    ];
                }
            ],
            'avatar-upload' => [
                'class' => UploadAction::className(),
                'path' => 'avatar/' . Yii::$app->user->id,
                'validatorOptions' => ['minWidth' => 100, 'minHeight' => 100, 'maxWidth' => 200, 'maxHeight' => 200, 'underWidth' => '图片宽高不要小于100x100', 'underHeight' => '图片宽高不要小于100x100', 'overWidth' => '图片宽高不要大于100x100', 'overHeight' => '图片宽高不要大于100x100']
            ],            
            'md-image-upload' => [
                'class' => UploadAction::className(),
                'path' => date('Ymd'),
                'callback' => function($result) {
                    return !isset($result['files'][0]['error']) ? [
                        'success' => 1,
                        'url' => $result['files'][0]['url']
                    ] : [
                        'success' => 0,
                        'message' => $result['files'][0]['error']
                    ];
                }
            ],
            'im-image-upload' => [
                'class' => UploadAction::className(),
                'path' => date('Ymd'),
                'callback' => function($result) {
                    return !isset($result['files'][0]['error']) ? [
                        'code' => 0,
                        'msg' => '',
                        'data' => [
                            'src' => $result['files'][0]['url']
                        ]
                    ] : [
                        'code' => 0,
                        'msg' => $result['files'][0]['error'],
                        'data' => (object)[]
                    ];
                }
            ],
            'im-file-upload' => [
                'class' => UploadAction::className(),
                'path' => date('Ymd'),
                'uploadOnlyImage' => false,
                'callback' => function($result) {
                    return !isset($result['files'][0]['error']) ? [
                        'code' => 0,
                        'msg' => '',
                        'data' => [
                            'src' => $result['files'][0]['url'],
                            'name' => $result['files'][0]['filename']
                        ]
                    ] : [
                        'code' => 0,
                        'msg' => $result['files'][0]['error'],
                        'data' => (object)[]
                    ];
                }
            ],
            'ueditor' => [
                'class' => 'common\modules\attachment\actions\UEditorAction',
                'config' => [
                ],
            ],
            'ueditor-catch' => [
                'class' => CatchAction::className(),
                'path' => date('Ymd'),
            ],
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
            ]*/
        ];
    }

    public function actionDelete()
    {
        //TODO AttachmentIndex里没有该attachment_id就可以把attachment删了
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            $model = $this->findModel($post['fileId']);
            $filePath = Yii::getAlias('@backend') . '/web/' . $post['filepath'];
            $transaction = Yii::$app->db->beginTransaction();
            try{
                if ($model->delete() && @unlink($filePath)) {
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
