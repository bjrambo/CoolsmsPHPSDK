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
		if (is_array($options->to))
		{
			$message = array();
			$i = 0;
			foreach ($options->to as $key => $phoneNumber)
			{
				$message[$key] = new \stdClass();
				$message[$key]->text = $options->text;
				$message[$key]->type = $options->type;
				$message[$key]->to = $phoneNumber;
				$message[$key]->from = $options->from;
				$i++;
			}

			$args = new \stdClass();
			$args->messages = json_encode($message);
		}
		else
		{
			$message = new \stdClass();
			$message->text = $options->text;
			$message->type = $options->type;
			$message->to = $options->to;
			$message->from = $options->from;

			$args = new \stdClass();
			$args->messages = json_encode(array($message));
		}

		return self::request('PUT', "messages/v4/groups/{$groupId}/messages", $args);
	}

	public static function sendGroupMessages($groupId)
	{
		return self::request('POST', "messages/v4/groups/{$groupId}/send");
	}

	/**
	 * @param $groupId
	 * @param $date string : ISO 8601 형식의 발송할 시간
	 * @return mixed
	 */
	public static function scheduleGroupMessage($groupId, $date)
	{
		$args = new \stdClass();
		$args->scheduledDate = $date;
		return self::request('POST', "messages/v4/groups/{$groupId}/schedule", $args);
	}

	public static function cancelScheduledGroupMessage($groupId)
	{
		return self::request('DELETE', "messages/v4/groups/{$groupId}/schedule");
	}
}
