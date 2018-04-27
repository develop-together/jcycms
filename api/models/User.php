<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-04-02 10:30
 */

namespace api\models;

use yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use common\models\meta\QuestionsMetaLike;

class User extends \common\models\User
{

    public $password;

    public $repassword;

    public $old_password;

    public function getUserAccessToken() {
        return UserAccessToken::findOne(['user_id' => $this->id, 'app_key' => Yii::$app->appClient->getAppKey()]);
    }

    public function getUserRefreshToken() {
        return UserRefreshToken::findOne(['user_id' => $this->id, 'app_key' => Yii::$app->appClient->getAppKey()]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $userAccessToken = UserAccessToken::findOne(['access_token' => $token, 'app_key' => Yii::$app->appClient->getAppKey()]);
        if ($userAccessToken === null) {
            throw new \yii\web\UnauthorizedHttpException("token is invalid.");
        }
        $expire = Yii::$app->params['user.accessTokenExpire'];
        $isValid = $userAccessToken->created_at + $expire >= time();
        if (!$isValid) {
            throw new \yii\web\UnauthorizedHttpException("token has expired...");
        }
        return $userAccessToken->getUser();
    }

    /**
     * 生成 access_token
     */
    public function generateAccessToken()
    {
        $this->access_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * 校验access_token是否有效
     */
    public static function accessTokenIsValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $userAccessToken = UserAccessToken::findOne(['access_token' => $token, 'app_key' => Yii::$app->appClient->getAppKey()]);
        if ($userAccessToken === null) {
            return false;
        }
        $timestamp = $userAccessToken->created_at;
        $expire = Yii::$app->params['user.accessTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function fields()
    {
        return [
            'id',
            'username',
            'status',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'repassword', 'password_hash'], 'string'],
            [['avatar'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif, webp'],
            [['username', 'email'], 'unique'],
            ['email', 'email'],
            [['repassword'], 'compare', 'compareAttribute' => 'password'],
            [['status'], 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['username', 'email', 'password', 'repassword'], 'required', 'on' => ['create']],
            [['username', 'email'], 'required', 'on' => ['update']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'create' => ['username', 'email', 'password', 'avatar', 'repassword', 'status'],
            'update' => ['username', 'email', 'password', 'repassword', 'avatar', 'status'],
            'self-update' => ['username', 'email', 'password', 'repassword', 'old_password', 'avatar'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => yii::t('app', 'Username'),
            'email' => yii::t('app', 'Email'),
            'old_password' => yii::t('app', 'Old Password'),
            'password' => yii::t('app', 'Password'),
            'repassword' => yii::t('app', 'Repeat Password'),
            'avatar' => yii::t('app', 'Avatar'),
            'status' => yii::t('app', 'Status'),
            'created_at' => yii::t('app', 'Created At'),
            'updated_at' => yii::t('app', 'Updated At'),
        ];
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_ACTIVE => yii::t('app', 'Normal'),
            self::STATUS_DELETED => yii::t('app', 'Disabled'),
        ];
    }

    public static function getQuestions()
    {
        return Questions::findAll(['author_id' => Yii::$app->user->identity->id]);
    }

    public static function getAnswers()
    {
        return QuestionsAnswers::findAll(['uid' => Yii::$app->user->identity->id]);
    }

    public static function getLikes()
    {
        return QuestionsMetaLike::findAll(['uid' => Yii::$app->user->identity->id]);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->created_at = time();
            $this->generateAuthKey();
            $this->setPassword($this->password);
            $this->updated_at = 0;
        } else {
            $this->updated_at = time();
            if (isset($this->password) && $this->password != '') {
                if ($this->getScenario() == 'self-update') {
                    if ($this->repassword == '') {
                        $this->addError('repassword', yii::t('frontend', 'repassword cannot be blank.'));
                        return false;
                    }
                    if ($this->old_password == '') {
                        $this->addError('old_password', yii::t('frontend', 'Old password cannot be blank.'));
                        return false;
                    }
                    if (! $this->validatePassword($this->old_password)) {
                        $this->addError('old_password', yii::t('frontend', 'Old password is incorrect.'));
                        return false;
                    }
                } else {
                    if ($this->getScenario() == 'update') {
                        if ($this->repassword == '') {
                            $this->addError('repassword', yii::t('frontend', 'repassword cannot be blank.'));
                            return false;
                        }
                    }
                }
                $this->setPassword($this->password);
            }
        }
        $upload = UploadedFile::getInstance($this, 'avatar');
        if ($upload !== null) {
            $uploadPath = yii::getAlias('@frontend/web/uploads/avatar/');
            if (! FileHelper::createDirectory($uploadPath)) {
                $this->addError('avatar', "Create directory failed " . $uploadPath);
                return false;
            }
            $fullName = $uploadPath . uniqid() . '.' . $upload->extension;
            if (! $upload->saveAs($fullName)) {
                $this->addError('avatar', yii::t('app', 'Upload {attribute} error: ' . $upload->error, ['attribute' => yii::t('app', 'avatar')]) . ': ' . $fullName);
                return false;
            }
            $avatar = $this->getOldAttribute('avatar');
            if(!empty($avatar)) {
                $file = yii::getAlias('@frontend/web') . $this->getOldAttribute('avatar');
                if(file_exists($file)) unlink($file);
            }
            $this->avatar = str_replace(yii::getAlias('@frontend/web'), '', $fullName);
        } else {
            $this->avatar = $this->getOldAttribute('avatar');
        }
        return true;
    }

}