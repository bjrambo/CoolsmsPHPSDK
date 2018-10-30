<?php

namespace Coolsms\OAuth\Api;

use CoolsmsOAuth\CoolsmsOAuth;

class OAuthLogin extends CoolsmsOAuth
{
	public static function getLoginUrl($redirect_url)
	{
		$params = array(
			'client_id'     => self::$clientData->client_id,
			'response_type' => 'code',
			'scope'         => 'users:read users.profile:read',
			'redirect_uri'  => $redirect_url,
			'state'         => self::generateRandomString(),
		);
		return self::$coolsmsOauthUrl . http_build_query($params, '', '&');
	}

	public static function generateRandomString($length = 10)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for($i = 0; $i < $length; $i++)
		{
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public static function getAccessToken($redirect_url)
	{
		$url = self::$coolsmsAccessTokenUrl;

		$args = new \stdClass();
		$args->grant_type = 'authorization_code';
		$args->client_id = self::$clientData->client_id;
		$args->client_secret = self::$clientData->client_secret;
		$args->redirect_uri = $redirect_url;
		$args->code = $_GET['code'];
		$jsonString = json_encode($args);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonString);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		$result = curl_exec($ch);

		$src_data = json_decode($result);
		return $src_data;
	}
}
