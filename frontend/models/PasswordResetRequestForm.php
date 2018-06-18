<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\components\BaseMail;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with this email address.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => Yii::t('common', 'Email'),
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }
        
        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        return BaseMail::send($this->email, 'Password reset for ' . Yii::$app->name, '请点击该链接：<br>', [
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            ]
        );
        // return Yii::$app
        //     ->mailer
        //     ->compose(
        //         ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
        //         ['user' => $user]
        //     )
        //     ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
        //     ->setTo($this->email)
        //     ->setSubject('Password reset for ' . Yii::$app->name)
        //     ->send();
    }
}
