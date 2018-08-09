<?php 

 namespace api\models;

 use Yii;

 class User extends \backend\models\User
 {
 	public $repassword;

    public function fields()
    {
        return [
            'id',
            'username',
            'email',
            'status',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'repassword'], 'string'],
            [['username', 'email'], 'unique'],
            ['email', 'email'],
            // [['repassword'], 'compare', 'compareAttribute' => 'password'],
            [['status'], 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['username', 'email', 'password', 'repassword'], 'required', 'on' => ['create']],
            [['username', 'email'], 'required', 'on' => ['update']],
        ];
    }
 } 