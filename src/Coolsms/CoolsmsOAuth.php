<?php

namespace CoolsmsOAuth;

class CoolsmsOAuth
{
	protected static $clientData;

	private static $salt;
	private static $date;
	private static $signature;

	protected static $coolsmsOauthUrl = 'https://rest.coolsms.co.kr/oauth2/v1/authorize?';
	protected static $coolsmsAccessTokenUrl = 'https://rest.coolsms.co.kr/oauth2/v1/access_token?';

	public function __construct($clientData)
	{
		self::$clientData = $clientData;
	}

	public static function getSignature()
	{
		self::$salt = uniqid();
		self::$date = date('c');
		self::$signature = hash_hmac('SHA256', self::$date . self::$salt, self::$apiSecret);

		//HACK: 이 실행이 모두 마무리가 된 이후 사용할 수 있도록 만듬
		return true;
	}
}
