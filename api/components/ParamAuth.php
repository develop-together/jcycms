<?php
/**
 * @author Atuxe <atuxe@atuxe.com>
 */

namespace api\components;


use yii\filters\auth\AuthMethod;

class ParamAuth extends AuthMethod
{
    /**
     * @var string the parameter name for passing the access token
     */
    public $tokenParam = 'access-token';


    /**
     * @inheritdoc
     */
    public function authenticate($user, $request, $response)
    {
        $accessToken = $request->get($this->tokenParam, $request->post($this->tokenParam));
        if (is_string($accessToken)) {
            $identity = $user->loginByAccessToken($accessToken, get_class($this));
            if ($identity !== null) {
                return $identity;
            }
        }
        if ($accessToken !== null) {
            $this->handleFailure($response);
        }

        return null;
    }
}