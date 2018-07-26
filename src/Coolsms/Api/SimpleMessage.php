<?php

namespace Coolsms\Api;

use Coolsms\Coolsms;

class SimpleMessage extends Coolsms
{

    public static function sendMessage($optionData)
    {
        $jsonData = json_encode($optionData);

        return self::request('SimpleMessage', $jsonData);
    }
}
