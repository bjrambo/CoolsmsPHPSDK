<?php

namespace Coolsms\message\Api;

use Coolsms\Coolsms;

class SimpleMessage extends Coolsms
{

	public static function sendMessage($optionData)
	{
		$jsonData = json_encode($optionData);

		return self::request('POST', 'messages/v4/send', $jsonData);
	}
}
