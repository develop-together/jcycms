<?php
/**
 * @author Atuxe <atuxe@atuxe.com>
 */

namespace api\models;


class UserRefreshToken extends \common\models\UserRefreshToken
{
    public function getUser() {
        return User::findOne(['id' => $this->user_id]);
    }
}