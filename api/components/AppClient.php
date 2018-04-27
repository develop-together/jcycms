<?php
/**
 * @author Atuxe <atuxe@atuxe.com>
 */

namespace api\components;


use api\models\UserAccessToken;
use api\models\UserRefreshToken;
use yii\base\Component;
use yii\base\InvalidValueException;

class AppClient extends Component
{
    public $clientClass;
    private $_client;
    private $_accessToken;
    private $_refreshToken;

    public function getAccessToken() {
        return $this->_client;
    }

    public function setAccessToken($accessToken) {
        if ($accessToken instanceof UserAccessToken) {
            $this->_accessToken = $accessToken;
        } else {
            throw new InvalidValueException('The access token object must implement UserAccessToken');
        }
    }

    public function getRefreshToken() {
        return $this->_client;
    }

    public function setRefreshToken($refreshToken) {
        if ($refreshToken instanceof UserRefreshToken) {
            $this->_refreshToken = $refreshToken;
        } else {
            throw new InvalidValueException('The access token object must implement UserRefreshToken');
        }
    }

    public function getClient() {
        return $this->_client;
    }

    public function setClient($client) {
        if ($client instanceof AppClientInterface) {
            $this->_client = $client;
        } else {
            throw new InvalidValueException('The client object must implement AppClientInterface.');
        }
    }

    public function getAppKey() {
        $client = $this->getClient();
        return $client !== null ? $client->getAppKey() : null;
    }

}