<?php

namespace Coolsms\message\Api;

use Coolsms\Coolsms;

class GroupMessage extends Coolsms
{
	public static function createGroup()
	{
		return self::request('POST', 'createMessageGroup', null);
	}

	public static function getGroupList()
	{

	}

	public static function getGroupInfo()
	{

	}

	public static function deleteGroup()
	{

	}

	public static function addGroupMessages($groupId, $options)
	{
		$options->groupId = $groupId;
		print_r($options);

		return self::request('PUT', 'addGroupMessages', $options, );
	}

	public static function sendGroupMessages($groupId)
	{
		$args = new \stdClass();
		$args->groupId = $groupId;
		return self::request('POST', 'sendGroupMessages', $args);
	}

	public static function scheduleGroupMessage()
	{

	}

	public static function cancelScheduledGroupMessage()
	{

	}
}
