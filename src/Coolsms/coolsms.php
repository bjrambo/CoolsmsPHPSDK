<?php

namespace Coolsms;

class Coolsms
{
	const SDK_VERSION = '4';
	const HOST_URL = 'https://rest.coolsms.co.kr/';

	private static $apiKey;
	private static $date;
	private static $salt;
	private static $apiSecret;
	private static $resource;
	private static $isPost;
	private static $result;
	private static $basecamp;
	private static $userAgent;
	private static $content;
	private static $signature;
	private static $accessToken;

	/**
	 * Coolsms constructor.
	 * @param $apiKey
	 * @param $apiSecret
	 * @param bool $basecamp
	 */
	public function __construct($apiKey = null, $apiSecret = null, $accessToken = null)
	{
		self::$apiKey = $apiKey;
		self::$apiSecret = $apiSecret;

		if (!$apiKey || !$apiSecret)
		{
			if (!$accessToken)
			{
				return false;
			}
			self::$accessToken = $accessToken;
		}

		if (isset($_SERVER['HTTP_USER_AGENT']))
		{
			self::$userAgent = $_SERVER['HTTP_USER_AGENT'];
		}

	}

	public static function getSignature()
	{
		self::$salt = uniqid();
		self::$date = date('c');
		self::$signature = hash_hmac('SHA256', self::$date . self::$salt, self::$apiSecret);

		//HACK: 이 실행이 모두 마무리가 된 이후 사용할 수 있도록 만듬
		return self::$signature;
	}

	/**
	 * @param $method
	 * @param $type
	 * @param bool|Object $options
	 * @return mixed
	 */
	public static function request($method, $type, $options = false)
	{
		$ch = curl_init();

		$endPoint = 'messages/v4/send';

		switch ($type)
		{
			case 'SimpleMessage':
				$endPoint = 'messages/v4/send';
				break;
			case 'createMessageGroup':
				$endPoint = 'messages/v4/groups';
				break;
			case 'getGroupList':
				$endPoint = 'messages/v4/groups';
				break;
			case 'getMessageGroupInfo':
				$endPoint = "messages/v4/groups/{$options->groupId}";
				$options = false;
				break;
			case 'deleteMessageGroup':
				$endPoint = "messages/v4/groups/{$options->groupId}";
				$options = false;
				break;
			case '':
				break;
			case 'addGroupMessages':
				$endPoint = "messages/v4/groups/{$options->groupId}/messages";
				unset($options->groupId);
				break;
			case 'sendGroupMessages':
				$endPoint = "messages/v4/groups/{$options->groupId}/send";
				$options = false;
				break;
			case '':
				break;
			case '':
				break;
			case '':
				break;
			case '':
				break;
			case '':
				break;
			case '':
				break;
			case '':
				break;
			case '':
				break;


			default:
				break;
		}

		$url = self::HOST_URL . $endPoint;

		if (self::$accessToken !== null)
		{
			$header = array(
				"Content-Type: application/json",
				'Authorization: bearer ' . self::$accessToken
			);
		}
		else
		{
			$header = array(
				"Content-Type: application/json",
				'Authorization: HMAC-SHA256 apiKey=' . self::$apiKey . ', date=' . self::$date . ', salt=' . self::$salt . ', signature=' . self::getSignature()
			);
		}

		switch ($method)
		{
			case "POST":
				if ($options)
				{
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($options));
				}
				break;
			case "PUT":
				if ($options)
				{
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($options));
				}
				break;
			case "DELETE":
				if ($options)
				{
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($options));
				}
				break;
			default:
				if ($options)
				{
					$url = sprintf("%s?%s", $url, http_build_query($options));
				}
				break;
		}
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // check SSL certificate
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); // TimeOut value
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if (curl_error($ch))
		{
			print_r(curl_error($ch));
		}

		$result = json_decode(curl_exec($ch));
		return $result;
	}
}
