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

    /**
     * Coolsms constructor.
     * @param $apiKey
     * @param $apiSecret
     * @param bool $basecamp
     */
    public function __construct($apiKey, $apiSecret, $basecamp = false)
    {
        self::$apiKey = $apiKey;
        self::$apiSecret = $apiSecret;

        if(isset($_SERVER['HTTP_USER_AGENT']))
        {
            self::$userAgent = $_SERVER['HTTP_USER_AGENT'];
        }

        if($basecamp)
        {
            self::$basecamp = true;
        }
    }

    public static function getAPIKey()
    {
        return  self::$apiKey;
    }

    public static function getSignature()
    {
        self::$salt = uniqid();
        self::$date = date('c');
        self::$signature = hash_hmac('SHA256', self::$date . self::$salt, self::$apiSecret);

        return true;
    }

    public static function request($type, $options)
    {
        $ch = curl_init();

        $url =  self::HOST_URL . 'messages/v4/send';

        $bool = self::getSignature();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // check SSL certificate
        curl_setopt($ch, CURLOPT_POST, 1); // POST GET method


        $header = array(
            "Content-Type: application/json",
            'Authorization: HMAC-SHA256 apiKey=' . self::$apiKey . ', date=' . self::$date .', salt=' . self::$salt . ', signature=' . self::$signature
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $options);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // TimeOut value
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // curl_exec() result output (1 = true, 0 = false)

        $result = json_decode(curl_exec($ch));

        return $result;
    }
}
