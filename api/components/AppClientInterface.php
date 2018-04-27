<?php
/**
 * @author Atuxe <atuxe@atuxe.com>
 */

namespace api\components;


interface AppClientInterface
{
    public function getAppKey();

    public function getAppSecret();
}