<?php

namespace Coolsms\message\Api;

use Coolsms\Coolsms;

class GroupMessage extends Coolsms
{
	public static function createGroup()
	{
		return self::request('POST', 'createMessageGroup', null);
	}

	/**
	 * @param bool|object $options
	 * @return mixed
	 */
	public static function getGroupList($options = false)
	{
		return self::request('GET', 'getGroupList', $options);
	}

	public static function getGroupInfo($groupId)
	{
		$args = new \stdClass();
		$args->groupId = $groupId;
		return self::request('GET', 'getMessageGroupInfo', $args);
	}

	public static function deleteGroup($groupId)
	{
		$args = new \stdClass();
		$args->groupId = $groupId;
		return self::request('DELETE', 'deleteMessageGroup', $args);
	}

	public static function addGroupMessages($groupId, $options)
	{
		$options->groupId = $groupId;
		print_r($options);

		return self::request('PUT', 'addGroupMessages', $options);
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
