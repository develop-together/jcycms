<?php
/**
 * @author Atuxe <atuxe@atuxe.com>
 */

namespace api\models;
use api\models\User;

class UserAccessToken extends \common\models\UserAccessToken
{
    public function getUser() {
        return User::findOne(['id' => $this->user_id]);
    }
}