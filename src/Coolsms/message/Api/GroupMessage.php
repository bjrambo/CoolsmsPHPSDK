<?php

namespace Coolsms\message\Api;

use Coolsms\Coolsms;

class GroupMessage extends Coolsms
{
	public static function createGroup()
	{
		return self::request('POST', 'messages/v4/groups', null);
	}

	/**
	 * @param bool|object $options
	 * @return mixed
	 */
	public static function getGroupList($options = false)
	{
		return self::request('GET', 'messages/v4/groups', $options);
	}

	public static function getGroupInfo($groupId)
	{
		return self::request('GET', "messages/v4/groups/{$groupId}");
	}

	public static function deleteGroup($groupId)
	{
		return self::request('DELETE', "messages/v4/groups/{$groupId}");
	}

	public static function addGroupMessages($groupId, $options)
	{
		return self::request('PUT', "messages/v4/groups/{$groupId}/messages", $options);
	}

	public static function sendGroupMessages($groupId)
	{
		return self::request('POST', "messages/v4/groups/{$groupId}/send");
	}

	public static function scheduleGroupMessage()
	{

	}

	public static function cancelScheduledGroupMessage()
	{

	}
}
