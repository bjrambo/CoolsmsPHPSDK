<?php

namespace Coolsms;

class Coolsms
{
    const SDK_VERSION = '4';

    public static $hostUrl = '';

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
}
