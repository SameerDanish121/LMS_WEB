<?php
namespace App\Services;

use Illuminate\Support\Facades\Cache;

class ApiConfig
{
    public static $apiBaseUrl; // Static variable

    // Initialize the static property from cache
    public static function init()
    {
        if (!self::$apiBaseUrl) { // Load only if not set
            self::$apiBaseUrl = Cache::get('api_base_url', 'http://127.0.0.1:8000/'); 
        }
    }
    public static function setApiBaseUrl($url)
    {
        self::$apiBaseUrl = $url;
        Cache::forever('api_base_url', $url); // Store in cache
    }

    public static function getApiBaseUrl()
    {
        return self::$apiBaseUrl;
    }
}
